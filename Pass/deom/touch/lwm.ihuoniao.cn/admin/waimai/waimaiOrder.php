<?php
/**
 * 订单管理
 *
 * @version        $Id: order.php 2017-5-25 上午10:16:21 $
 * @package        HuoNiao.Order
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', ".." );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$dbname = "waimai_order";
$templates = "waimaiOrder.html";


//确认订单
if($action == "confirm"){
    if(!empty($id)){

      $ids = explode(",", $id);
      foreach ($ids as $key => $value) {
          $date = GetMkTime(time());
          $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `state` = 3, `confirmdate` = '$date' WHERE `state` = 2 AND `id` = $value");
          $ret = $dsql->dsqlOper($sql, "update");

          //消息通知 & 打印
          printerWaimaiOrder($value);
      }

      echo '{"state": 100, "info": "操作成功！"}';
      die;

    }else{
      echo '{"state": 200, "info": "信息ID传输失败！"}';
		  exit();
    }

}


//打印订单
if($action == "print"){
    if(!empty($id)){
        $ids = explode(",", $id);
        foreach ($ids as $key => $value) {
            printerWaimaiOrder($value, true);
        }

        echo '{"state": 100, "info": "操作成功！"}';
        die;
    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


//成功订单
if($action == "ok"){
    if(!empty($id)){

        $date = GetMkTime(time());

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `state` = 1, `okdate` = '$date' WHERE (`state` = 3 OR `state` = 4 OR `state` = 5) AND `id` in ($id)");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){

            //消息通知用户
            $ids = explode(",", $id);
            foreach ($ids as $key => $value) {
                $sql_ = $dsql->SetQuery("SELECT o.`uid`, o.`ordernumstore`, o.`okdate`, s.`shopname` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`id` = $value");
                $ret_ = $dsql->dsqlOper($sql_, "results");
                if($ret_){
                    $data = $ret_[0];

                    $uid           = $data['uid'];
                    $ordernumstore = $data['shopname'].$data['ordernumstore'];
                    $okdate        = $data['okdate'];

                    $param = array(
                        "service"  => "member",
                        "type"     => "user",
                        "template" => "orderdetail",
                        "module"   => "waimai",
                        "id"       => $id
                    );

                    updateMemberNotice($uid, "会员-订单完成通知", $param, array("ordernum" => $ordernumstore, "date" => date("Y-m-d H:i:s", $okdate)));
                }
            }


            echo '{"state": 100, "info": "操作成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "操作失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


//无效订单
if($action == "failed"){
    if(!empty($id)){

      $ids = explode(",", $id);
      foreach ($ids as $key => $value) {
        $sql = $dsql->SetQuery("SELECT o.`peisongid`, o.`ordernumstore`, s.`shopname` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`id` = $value AND (o.`state` = 2 OR o.`state` = 3 OR o.`state` = 4 OR o.`state` = 5)");
        $ret = $dsql->dsqlOper($sql, "results");
        if($ret){
          $peisongid = $ret[0]['peisongid'];
          if($peisongid > 0){
            $ordernumstore = $ret[0]['ordernumstore'];
            $shopname      = $ret[0]['shopname'];
            aliyunPush($peisongid, "您有一笔订单已取消，不必配送！", "订单号：".$shopname.$ordernumstore, "peisongordercancel");
          }
        }

        //消息通知用户
        $sql_ = $dsql->SetQuery("SELECT o.`uid`, o.`ordernumstore`, o.`okdate`, s.`shopname` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`id` = $value");
        $ret_ = $dsql->dsqlOper($sql_, "results");
        if($ret_){
            $data = $ret_[0];

            $uid           = $data['uid'];
            $ordernumstore = $data['shopname'].$data['ordernumstore'];

            $param = array(
                "service"  => "member",
                "type"     => "user",
                "template" => "orderdetail",
                "module"   => "waimai",
                "id"       => $id
            );

            updateMemberNotice($uid, "会员-订单取消通知", $param, array("ordernum" => $ordernumstore, "date" => date("Y-m-d H:i:s"), "info" => $note));
        }

      }

      $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `state` = 7, `failed` = '$note', `failedadmin` = 1 WHERE `id` in ($id)");
      $ret = $dsql->dsqlOper($sql, "update");
      if($ret == "ok"){
        echo '{"state": 100, "info": "操作成功！"}';
  		  exit();
      }else{
        echo '{"state": 200, "info": "操作失败！"}';
  		  exit();
      }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		    exit();
    }
}


//设置配送员
if($action == "setCourier"){
    if(!empty($id) && $courier){

        $ids = explode(",", $id);

        $now = GetMkTime(time());
        $date = date("Y-m-d H:i:s", $now);

        $err = array();
        foreach ($ids as $key => $value) {

            $sql = $dsql->SetQuery("SELECT o.`sid`, o.`ordernum`, o.`ordernumstore`, o.`peisongid`, o.`peisongidlog`, s.`shopname` FROM `#@__$dbname` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`id` = $value");
            $ret = $dsql->dsqlOper($sql, "results");
            if(!$ret) break;

            $sid           = $ret[0]['sid'];
            $shopname      = $ret[0]['shopname'];
            $ordernum      = $ret[0]['ordernum'];
            $ordernumstore = $ret[0]['ordernumstore'];
            $peisongid     = $ret[0]['peisongid'];
            $peisongidlog  = $ret[0]['peisongidlog'];

            // 没有变更
            if($courier == $peisongid) continue;

            $sql = $dsql->SetQuery("SELECT `id`, `name`, `phone` FROM `#@__waimai_courier` WHERE `id` = $peisongid || `id` = $courier");
            $ret = $dsql->dsqlOper($sql, "results");
            if($ret){
                foreach ($ret as $k => $v) {
                    if($v['id'] == $peisongid){
                        $peisongname_ = $v['name'];
                        $peisongtel_ = $v['phone'];
                    }else{
                        $peisongname = $v['name'];
                        $peisongtel = $v['phone'];
                    }
                }
            }

            if($peisongid){
                // 骑手变更记录
                $pslog = "此订单在 ".$date." 重新分配了配送员，原配送员是：".$peisongname_."（".$peisongtel_."），新配送员是:".$peisongname."（".$peisongtel."）<hr>" . $peisongidlog;
            }else{
                $pslog = "";
            }

            $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `state` = 4, `peisongid` = '$courier', `peisongidlog` = '$pslog' WHERE (`state` = 3 OR `state` = 4 OR `state` = 5) AND `id` = $value");
            $ret = $dsql->dsqlOper($sql, "update");
            if($ret == "ok"){

                //推送消息给骑手
                aliyunPush($courier, "您有新的配送订单", "订单号：".$shopname.$ordernumstore, "newfenpeiorder");

                if($peisongid){
                    aliyunPush($peisongid, "您有订单被其他骑手派送", "订单号：".$shopname.$ordernumstore, "peisongordercancel");
                }

                //消息通知用户
                $sql_ = $dsql->SetQuery("SELECT o.`uid`, o.`ordernumstore`, o.`pubdate`, o.`food`, o.`amount`, s.`shopname`, c.`name`, c.`phone` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` LEFT JOIN `#@__waimai_courier` c ON c.`id` = o.`peisongid` WHERE o.`id` = $value");
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
                        "id"       => $value
                    );

                    updateMemberNotice($uid, "会员-订单配送提醒", $param, array("ordernum" => $shopname.$ordernumstore, "orderdate" => date("Y-m-d H:i:s", $pubdate), "orderinfo" => join(" ", $foods), "orderprice" => $amount, "peisong" => $name . "，" . $phone));
                }


            }else{
                array_push($err, $value);
            }

        }

        if($err){
            echo '{"state": 200, "info": "操作失败！"}';
            exit();
        }else{
            echo '{"state": 100, "info": "操作成功！"}';
            exit();
        }



    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


//取消配送员
if($action == "cancelCourier"){
    if(!empty($id)){

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `state` = 3, `peisongid` = '0' WHERE (`state` = 4 OR `state` = 5) AND `id` in ($id)");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "操作成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "操作失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


// 退款
if($action == "refund"){

  $userid = $userLogin->getUserID();
  if($userid == -1){
    echo '{"state": 200, "info": "登陆超时"}';
    exit();
  }

  if(empty($id)){
    echo '{"state": 200, "info": "参数错误"}';
    exit();
  }

  $sql = $dsql->SetQuery("SELECT o.`paytype`, o.`uid`, o.`amount`, o.`ordernumstore`, l.`ordernum`, s.`shopname` FROM `#@__waimai_order` o LEFT JOIN `#@__pay_log` l ON l.`body` = o.`ordernum` LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`state` = 7 AND o.`paytype` != 'delivery' AND o.`refrundstate` = 0 AND o.`amount` > 0 AND o.`id` = $id");
  // echo $sql;die;
  $ret = $dsql->dsqlOper($sql, "results");

  if($ret){

    $value = $ret[0];
    $date  = GetMkTime(time());

    $uid           = $value['uid'];
    $paytype       = $value['paytype'];
    $amount        = $value['amount'];
    $ordernum      = $value['ordernum'];
    $shopname      = $value['shopname'];
    $ordernumstore = $value['ordernumstore'];

    $sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `refrundstate` = 1, `refrunddate` = '$date', `refrundadmin` = $userid, `refrundfailed` = '' WHERE `id` = $id");
    $ret = $dsql->dsqlOper($sql, "update");
    if($ret != "ok"){
      echo '{"state": 200, "info": "操作失败！"}';
      exit();
    }

    $r = true;

    // 余额支付
    if($paytype == "money"){

        $sql = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + $amount WHERE `id` = $uid");
        $dsql->dsqlOper($sql, "update");

    // 支付宝
    }elseif($paytype == "alipay"){

      $order = array(
        "ordernum" => $ordernum,
        "amount" => $amount
      );

      require_once(HUONIAOROOT."/api/payment/alipay/alipayRefund.php");
      $alipayRefund = new alipayRefund();

      $return = $alipayRefund->refund($order);

      // 成功
      if($return['state'] == 100){

        $sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `refrunddate` = '".GetMkTime($return['date'])."', `refrundno` = '".$return['trade_no']."' WHERE `id` = $id");

      }else{

        $sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `refrundstate` = 0, `refrundfailed` = '".$return['code']."' WHERE `id` = $id");
        $r = false;

      }
      $ret = $dsql->dsqlOper($sql, "update");

    // 微信
    }elseif($paytype == "wxpay"){
      $r = false;
    }

    if($r){
      //保存操作日志
      $archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '1', '$amount', '外卖退款：".$shopname.$ordernumstore."', '$date')");
      $dsql->dsqlOper($archives, "update");

      $sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
      $user = $dsql->dsqlOper($sql, "results");
      if($user){
        $param = array(
          "service" => "member",
          "type" => "user",
          "template" => "record"
        );
        updateMemberNotice($uid, "会员-订单退款成功", $param, array("username" => $user['username'], "order" => $shopname.$ordernumstore, 'amount' => $amount));
      }

      echo '{"state": 100, "info": "退款操作成功！"}';
    }else{
      echo '{"state": 200, "info": "退款失败，错误码：'.$return['code'].'"}';
    }

    exit();

  }else{
    echo '{"state": 200, "info": "操作失败，请检查订单状态！"}';
    exit();
  }

}



$where = "";

$state = empty($state) ? 2 : $state;

//订单编号
if(!empty($ordernum)){
  $where .= " AND o.`ordernum` like '%$ordernum%'";
}

//店铺名称
if(!empty($shopname)){
  $where .= " AND s.`shopname` like '%$shopname%'";
}

//姓名
if(!empty($person)){
  $where .= " AND o.`person` = '%$person%'";
}

//电话
if(!empty($tel)){
  $where .= " AND o.`tel` like '%$tel%'";
}

//地址
if(!empty($address)){
  $where .= " AND o.`address` like '%$address%'";
}

//订单金额
if(!empty($amount)){
  $where .= " AND o.`amount` = '$amount'";
}

//订单状态
if($state !== ""){
    $where .= " AND o.`state` = '$state'";
    /*// 未处理订单需要显示货到付款的订单
    if($state == 2){
        $where .= " AND (o.`state` = '2' || (o.`state` = 0 && o.`paytype` = 'delivery'))";
    }else{
        $where .= " AND o.`state` = '$state'";
    }*/
}

$pageSize = 15;

$sql = $dsql->SetQuery("SELECT o.`id`, o.`uid`, o.`sid`, o.`ordernum`, o.`ordernumstore`, o.`state`, o.`food`, o.`person`, o.`tel`, o.`address`, o.`paytype`, o.`preset`, o.`note`, o.`pubdate`, o.`okdate`, o.`amount`, o.`peisongid`, o.`peisongidlog`, o.`failed`, o.`refrundstate`, o.`refrunddate`, o.`refrundno`, o.`refrundfailed`, o.`refrundadmin`, s.`shopname` FROM `#@__$dbname` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE 1 = 1".$where." ORDER BY o.`id` DESC");
// echo $sql;die;

//总条数
$totalCount = $dsql->dsqlOper($sql, "totalCount");
//总分页数
$totalPage = ceil($totalCount/$pageSize);

$p = (int)$p == 0 ? 1 : (int)$p;
$atpage = $pageSize * ($p - 1);
$results = $dsql->dsqlOper($sql." LIMIT $atpage, $pageSize", "results");

$list = array();
foreach ($results as $key => $value) {
  $list[$key]['id']         = $value['id'];
  $list[$key]['uid']        = $value['uid'];

  //用户名
  $userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["uid"]);
  $username = $dsql->dsqlOper($userSql, "results");
  if(count($username) > 0){
      $list[$key]["username"] = $username[0]['username'];
  }else{
      $list[$key]["username"] = "未知";
  }

  $list[$key]['sid']           = $value['sid'];
  $list[$key]['shopname']      = $value['shopname'];
  $list[$key]['ordernum']      = $value['ordernum'];
  $list[$key]['ordernumstore'] = $value['ordernumstore'];
  $list[$key]['state']         = $value['state'];
  $list[$key]['food']          = unserialize($value['food']);
  $list[$key]['person']        = $value['person'];
  $list[$key]['tel']           = $value['tel'];
  $list[$key]['address']       = $value['address'];
  // $list[$key]['paytype']       = $value['paytype'] == "wxpay" ? "微信支付" : ($value['paytype'] == "alipay" ? "支付宝" : $value['paytype']);
  $list[$key]['paytype']      = $value['paytype'] == "wxpay" ? "微信支付" : ($value['paytype'] == "alipay" ? "支付宝" : ($value['paytype'] == "money" ? "余额支付" : ($value['paytype'] == "delivery" ? "货到付款" : $value['paytype']) ) );
  $list[$key]['preset']        = unserialize($value['preset']);
  $list[$key]['note']          = $value['note'];
  $list[$key]['pubdate']       = $value['pubdate'];
  $list[$key]['okdate']        = $value['okdate'];
  $list[$key]['amount']        = $value['amount'];
  $list[$key]['peisongid']     = $value['peisongid'];
  $list[$key]['peisongidlog']  = $value['peisongidlog'] ? substr($value['peisongidlog'], 0, -4) : "";
  $list[$key]['failed']        = $value['failed'];
  $list[$key]['refrundstate']  = $value['refrundstate'];
  $list[$key]['refrunddate']   = $value['refrunddate'];
  $list[$key]['refrundno']     = $value['refrundno'];
  $list[$key]['refrundfailed'] = $value['refrundfailed'];

  $sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ".$value['refrundadmin']);
  $ret = $dsql->dsqlOper($sql, "results");
  if($ret){
    $list[$key]['refrundadmin'] = $ret[0]['username'];
  }else{
    $list[$key]['refrundadmin'] = $value['refrundadmin'];
  }




  $sql = $dsql->SetQuery("SELECT `name`, `phone` FROM `#@__waimai_courier` WHERE `id` = ".$value['peisongid']);
  $ret = $dsql->dsqlOper($sql, "results");
  if($ret){
      $list[$key]['peisongname'] = $ret[0]['name'];
      $list[$key]['peisongtel'] = $ret[0]['phone'];
  }
}

$huoniaoTag->assign("state", $state);
$huoniaoTag->assign("list", $list);

$pagelist = new pagelist(array(
  "list_rows"   => $pageSize,
  "total_pages" => $totalPage,
  "total_rows"  => $totalCount,
  "now_page"    => $p
));
$huoniaoTag->assign("pagelist", $pagelist->show());


//查询待确认的订单
$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `state` = 2");
$ret = $dsql->dsqlOper($sql, "totalCount");
$huoniaoTag->assign("state2", $ret);



//验证模板文件
if(file_exists($tpl."/".$templates)){

    //css
	$cssFile = array(
		'ui/jquery.chosen.css',
		'admin/jquery-ui.css',
		'admin/styles.css',
		'admin/chosen.min.css',
		'admin/ace-fonts.min.css',
		'admin/select.css',
		'admin/ace.min.css',
		'admin/animate.css',
		'admin/font-awesome.min.css',
		'admin/simple-line-icons.css',
		'admin/font.css',
		// 'admin/app.css'
	);
	$huoniaoTag->assign('cssFile', includeFile('css', $cssFile));

    //配送员
    $courier = array();
    $sql = $dsql->SetQuery("SELECT `id`, `name` FROM `#@__waimai_courier` WHERE `state` = 1 ORDER BY `id` ASC");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        foreach ($ret as $key => $value) {
            array_push($courier, array(
                "id" => $value['id'],
                "name" => $value['name']
            ));
        }
    }
    $huoniaoTag->assign("courier", $courier);

    //js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/chosen.jquery.min.js',
		'admin/waimai/waimaiOrder.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}