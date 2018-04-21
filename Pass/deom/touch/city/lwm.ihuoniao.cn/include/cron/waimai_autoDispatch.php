<?php
if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 外卖自动派单
 *
 * 规则：
 * 1. 自动分配所有已确认的订单
 * 2. 按照骑手离商家位置最近并且手上没有订单时优先派送
 * 3. 如果骑手手上有订单，则将新订单分派给其他骑手
 *
 * @version        $Id: waimai_autoDispatch.php 2017-6-8 下午16:55:10 $
 * @package        HuoNiao.cron
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */


//派单前的计算
function autoDispatch(){
    global $dsql;

    //查询骑手信息及订单量
    $sql = $dsql->SetQuery("SELECT c.`id`, c.`lng`, c.`lat` FROM `#@__waimai_courier` c WHERE c.`state` = 1");
    $courierArr = $dsql->dsqlOper($sql, "results");

    //查询订单信息
    $sql = $dsql->SetQuery("SELECT o.`id`, s.`coordX`, s.`coordY` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`state` = 3");
    $orderArr = $dsql->dsqlOper($sql, "results");

    $treeArr = array();
    foreach ($orderArr as $key => $value) {
        foreach ($courierArr as $k => $v) {
            array_push($treeArr, array(
                "courierID"  => $v['id'],
                "courierLng" => $v['lng'],
                "courierLat" => $v['lat'],
                "orderID"    => $value['id'],
                "shopLng"    => $value['coordX'],
                "shopLat"    => $value['coordY'],
                "juli"       => getDistance($v['lat'], $v['lng'], $value['coordY'], $value['coordX'])
            ));
        }
    }

    //将相同订单号的数组拼接
    $newArr = array();
    foreach ($treeArr as $key => $value) {
        if(!$newArr[$value['orderID']]){
            $newArr[$value['orderID']] = array();
        }
        array_push($newArr[$value['orderID']], $value);
    }

    //将相同订单的数组分配给最合适的骑手
    foreach ($newArr as $key => $value) {
        autoDispatchCourier($value);
    }

}


//派单给骑手
function autoDispatchCourier($arr){
    global $dsql;

    if($arr){
        $oArr = array();
        //这次主要计算骑手当前手上有多少订单
        foreach ($arr as $key => $value) {
            $sql = $dsql->SetQuery("SELECT count(`id`) count FROM `#@__waimai_order` WHERE (`state` = 4 OR `state` = 5) AND `peisongid` = " . $value['courierID']);
            $ret = $dsql->dsqlOper($sql, "results");
            $value['orderCount'] = $ret[0]['count'];
            array_push($oArr, $value);
        }

        $kindex = 0;
        $currArr = $oArr[0];
        if(count($oArr) > 1){
            foreach ($oArr as $key => $value) {
                if($key > 0 && ($value['juli'] < $currArr['juli'] && ($value['orderCount'] < $currArr['orderCount'] || $value['orderCount'] == 0))){
                    $kindex = $key;
                    $currArr = $value;
                }
            }
        }

        //每个配送员最多分配5个订单，并且是10公里范围以内的订单
        if($currArr['orderCount'] < 5 && $currArr['juli'] < 10000){
            $courier = $currArr['courierID'];
            $orderid = $currArr['orderID'];
            $sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 4, `peisongid` = '$courier' WHERE `state` = 3 AND `id` = $orderid");
            $ret = $dsql->dsqlOper($sql, "update");

            if($ret == "ok"){

                //消息通知用户
                $sql_ = $dsql->SetQuery("SELECT o.`uid`, o.`ordernumstore`, o.`pubdate`, o.`food`, o.`amount`, s.`shopname`, c.`name`, c.`phone` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` LEFT JOIN `#@__waimai_courier` c ON c.`id` = o.`peisongid` WHERE o.`id` = $orderid");
                $ret_ = $dsql->dsqlOper($sql_, "results");
                if($ret_){
                    $data = $ret_[0];

                    $uid           = $data['uid'];
                    $ordernumstore = $data['ordernumstore'];
                    $pubdate       = $data['pubdate'];
                    $food          = unserialize($data['food']);
                    $amount        = $data['amount'];
                    $shopname      = $data['shopname'];
                    $name          = $data['name'];
                    $phone         = $data['phone'];

                    $foods = array();
                    foreach ($food as $key => $value) {
                        array_push($foods, $value['title'] . " " . $value['count'] . "份");
                    }

                    $param = array(
                        "service"  => "member",
                        "type"     => "user",
                        "template" => "orderdetail",
                        "module"   => "waimai",
                        "id"       => $orderid
                    );

                    updateMemberNotice($uid, "会员-订单配送提醒", $param, array("ordernum" => $shopname.$ordernumstore, "orderdate" => date("Y-m-d H:i:s", $pubdate), "orderinfo" => join(" ", $foods), "orderprice" => $amount, "peisong" => $name . "，" . $phone));
                }

                //推送消息给骑手
                aliyunPush($courier, "您有新的配送订单", "点击查看", "newfenpeiorder");

            }

        }else{
            array_splice($arr, $kindex, 1);
            autoDispatchCourier($arr);
        }

    }
}


autoDispatch();







/**
 * 二维数组根据字段进行排序
 * @params array $array 需要排序的数组
 * @params string $field 排序的字段
 * @params string $sort 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
 */
 function arraySequence($array, $field, $sort = 'SORT_DESC'){
    $arrSort = array();
    foreach ($array as $uniqid => $row) {
        foreach ($row as $key => $value) {
            $arrSort[$key][$uniqid] = $value;
        }
    }
    array_multisort($arrSort[$field], constant($sort), $array);
    return $array;
}
