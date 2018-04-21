<?php
/**
 * 订单详细
 *
 * @version        $Id: orderDetail.php 2017-5-25 上午10:16:21 $
 * @package        HuoNiao.Order
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "../" );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/";
$tpl = isMobile() ? $tpl."touch/order" : $tpl."order";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$dbname = "waimai_order";
$templates = "waimaiOrderDetail.html";

if(empty($id)){
    die;
}

$where = " AND `sid` in ($managerIds)";

$sql = $dsql->SetQuery("SELECT * FROM `#@__$dbname` WHERE `id` = $id".$where);
$ret = $dsql->dsqlOper($sql, "results");
if($ret){

    foreach ($ret[0] as $key => $value) {

        //店铺
        if($key == "sid"){
            $sql = $dsql->SetQuery("SELECT `shopname` FROM `#@__waimai_shop` WHERE `id` = $value");
            $ret = $dsql->dsqlOper($sql, "results");
            if($ret){
                $huoniaoTag->assign("shopname", $ret[0]['shopname']);
            }
        }

        //用户
        if($key == "uid"){
            $userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value);
            $username = $dsql->dsqlOper($userSql, "results");
            if(count($username) > 0){
                $huoniaoTag->assign("username", $username[0]['username']);
            }
        }

        //商品、预设字段、费用详细
        if($key == "food" || $key == "preset" || $key == "priceinfo"){
            $value = unserialize($value);
        }

        //支付方式
        if($key == "paytype"){
            // $value = $value == "wxpay" ? "微信支付" : ($value == "alipay" ? "支付宝" : $value);
            $value = $value == "wxpay" ? "微信支付" : ($value == "alipay" ? "支付宝" : ($value == "money" ? "余额支付" : ($value == "delivery" ? "货到付款" : $value) ) );
        }

        //配送员
        if($key == "peisongid"){
            $sql = $dsql->SetQuery("SELECT `name` FROM `#@__waimai_courier` WHERE `id` = $value");
            $ret = $dsql->dsqlOper($sql, "results");
            if($ret){
                $huoniaoTag->assign("peisong", $ret[0]['name']);
            }
        }

        $huoniaoTag->assign($key, $value);
    }

}else{
    die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
    $jsFile = array(
        'shop/waimaiOrderDetail.js'
    );
    $huoniaoTag->assign('jsFile', $jsFile);

    $huoniaoTag->assign('HUONIAOADMIN', HUONIAOADMIN);
    $huoniaoTag->assign('templets_skin', 'http://'.$cfg_basehost."/wmsj/templates/".(isMobile() ? "touch/" : ""));  //模块路径
    $huoniaoTag->display($templates);
}else{
    echo $templates."模板文件未找到！";
}
