<?php
/**
 * 团购券管理
 *
 * @version        $Id: tuanQuanList.php 2013-12-16 下午16:27:16 $
 * @package        HuoNiao.Tuan
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("tuanQuanList");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/tuan";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "tuanQuanList.html";

$action = "tuanquan";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if($sKeyword != ""){
		$where = " AND `cardnum` like '%$sKeyword%'";
		
		$proid = array();
		$proSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__tuanlist` WHERE `title` like '%$sKeyword%'");
		$proResult = $dsql->dsqlOper($proSql, "results");
		if($proResult){
			foreach($proResult as $key => $pro){
				array_push($proid, $pro['id']);
			}
		}
		
		$w = "";
		if(!empty($proid)){
			$w = ' AND `proid` in ('.join(",", $proid).')';
		}else{
			$w = " AND `ordernum` like '%$sKeyword%'";
		}
		
		if($start != ""){
			$w .= " AND `orderdate` >= ". GetMkTime($start);
		}
		
		if($end != ""){
			$w .= " AND `orderdate` <= ". GetMkTime($end);
		}
		
		$orderSql = $dsql->SetQuery("SELECT `id`, `ordernum` FROM `#@__tuan_order` WHERE 1 = 1".$w);
		$orderResult = $dsql->dsqlOper($orderSql, "results");
		if($orderResult){
			$orderid = array();
			foreach($orderResult as $key => $order){
				array_push($orderid, $order['id']);
			}
			if(!empty($orderid)){
				$where .= " OR `orderid` in (".join(",", $orderid).")";
			}
		}
		
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."` WHERE 1 = 1".$where);

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//可使用
	$effective = $dsql->dsqlOper($archives." AND `usedate` = 0 AND (`expireddate` = 0 OR `expireddate` >= ".GetMkTime(time()).")", "totalCount");
	//已过期
	$expired = $dsql->dsqlOper($archives." AND `usedate` = 0 AND `expireddate` < ".GetMkTime(time()), "totalCount");
	//已消费
	$spend = $dsql->dsqlOper($archives." AND `usedate` != 0", "totalCount");
	
	if($state != ""){
		if($state == 0){
			$where .= " AND `usedate` = 0 AND (`expireddate` = 0 OR `expireddate` >= ".GetMkTime(time()).")";
			$totalPage = ceil($effective/$pagestep);

		}elseif($state == 1){
			$where .= " AND `usedate` = 0 AND `expireddate` < ".GetMkTime(time());
			$totalPage = ceil($expired/$pagestep);

		}elseif($state == 2){
			$where .= " AND `usedate` != 0";
			$totalPage = ceil($spend/$pagestep);

		}

	}
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `orderid`, `cardnum`, `carddate`, `usedate`, `expireddate` FROM `#@__".$action."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["cardnum"] = $value["cardnum"];
			$list[$key]["carddate"] = $value["carddate"];
			$list[$key]["usedate"] = date('Y-m-d H:i:s', $value["usedate"]);
			$list[$key]["expireddate"] = $value["expireddate"] == 0 ? "无期限" : date('Y-m-d', $value["expireddate"]);
			
			if($value["usedate"] == 0){
				if($value["expireddate"] == 0 || $value["expireddate"] >= GetMkTime(time())){
					$list[$key]["state"] = 0;
				}else{
					$list[$key]["state"] = 1;
				}
			}else{
				$list[$key]["state"] = 2;
			}
			
			$list[$key]["orderid"] = $value["orderid"];
			
			//团购订单
			$orderSql = $dsql->SetQuery("SELECT `ordernum`, `proid`, `orderdate`, `orderprice` FROM `#@__tuan_order` WHERE `id` = ". $value["orderid"]);
			$orderResult = $dsql->dsqlOper($orderSql, "results");
			if(count($orderResult) > 0){
				$list[$key]["ordernum"] = $orderResult[0]['ordernum'];
				$list[$key]["orderdate"] = date('Y-m-d H:i:s', $orderResult[0]['orderdate']);
				$list[$key]["orderprice"] = sprintf("%.2f", $orderResult[0]["orderprice"]);
				$proid = $orderResult[0]['proid'];
			}else{
				$list[$key]["ordernum"] = "未知";
				$list[$key]["orderdate"] = "";
				$list[$key]["orderprice"] = "";
				$proid = 0;
			}
			
			$list[$key]["proid"] = $proid;
			
			//团购商品
			$proSql = $dsql->SetQuery("SELECT `title` FROM `#@__tuanlist` WHERE `id` = ". $proid);
			$proname = $dsql->dsqlOper($proSql, "results");
			if(count($proname) > 0){
				$list[$key]["proname"] = $proname[0]['title'];
			}else{
				$list[$key]["proname"] = "未知";
			}
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "effective": '.$effective.', "expired": '.$expired.', "spend": '.$spend.'}, "tuanQuanList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "effective": '.$effective.', "expired": '.$expired.', "spend": '.$spend.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "effective": '.$effective.', "expired": '.$expired.', "spend": '.$spend.'}}';
	}
	die;
	
//登记
}elseif($dopost == "reg"){
	if(!testPurview("tuanQuanOpera")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){
		$updateSql = $dsql->SetQuery("UPDATE `#@__tuanquan` SET `usedate` = ".GetMkTime(time())." WHERE `id` = ".$val." AND `usedate` = 0 AND (`expireddate` = 0 OR `expireddate` >= ".GetMkTime(time()).")");
		$dsql->dsqlOper($updateSql, "update");

		//查询订单信息
		$sql = $dsql->SetQuery("SELECT q.`orderid`, o.`orderprice`, o.`ordernum`, s.`uid` FROM `#@__tuanquan` q LEFT JOIN `#@__tuan_order` o ON o.`id` = q.`orderid` LEFT JOIN `#@__tuanlist` l ON l.`id` = o.`proid` LEFT JOIN `#@__tuan_store` s ON s.`id` = l.`sid` WHERE q.`id` = ".$val);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$orderid    = $ret[0]['orderid'];
			$orderprice = $ret[0]['orderprice'];
			$ordernum   = $ret[0]['ordernum'];
			$uid        = $ret[0]['uid'];

			//将费用转至商家帐户
			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$orderprice' WHERE `id` = '$uid'");
			$dsql->dsqlOper($archives, "update");

			//保存操作日志
			$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '1', '$orderprice', '团购券消费：$ordernum', ".GetMkTime(time()).")");
			$dsql->dsqlOper($archives, "update");

			//更新订单状态，如果券都用掉了，就更新订单状态为已使用
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__tuanquan` WHERE `orderid` = (SELECT `orderid` FROM `#@__tuanquan` WHERE `id` = ".$val.") AND `usedate` = 0");
			$ret = $dsql->dsqlOper($sql, "totalCount");
			if($ret == 0){
				$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 3, `ret-state` = 0 WHERE `id` = '$orderid'");
				$dsql->dsqlOper($sql, "update");
			}

		}

	}
	adminLog("消费登记团购券", $id);
	echo '{"state": 100, "info": '.json_encode("操作成功！").'}';
	die;
	
//取消登记
}elseif($dopost == "cangelreg"){
	if(!testPurview("tuanQuanOpera")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){

		$archives = $dsql->SetQuery("SELECT q.`cardnum`, q.`orderid`, o.`orderprice`, s.`uid` FROM `#@__tuanquan` q LEFT JOIN `#@__tuan_order` o ON o.`id` = q.`orderid` LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE q.`id` = ".$val);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$orderid    = $results[0]['orderid'];
			$cardnum    = $results[0]['cardnum'];
			$orderprice = $results[0]['orderprice'];
			$uid        = $results[0]['uid'];

			$sql = $dsql->SetQuery("SELECT `money` FROM `#@__member` WHERE `id` = ". $uid);
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret) die('{"state": 200, "info": '.json_encode("商家不存在，无法继续退款！").'}');
			if($ret[0]['money'] < $orderprice) die('{"state": 200, "info": '.json_encode("商家帐户余额不足，请先充值！").'}');

			//从商家帐户减去相应金额
			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - '$orderprice' WHERE `id` = ".$uid);
			$dsql->dsqlOper($archives, "update");

			//保存操作日志
			$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$orderprice', '撤消团购券：$cardnum', ".GetMkTime(time()).")");
			$dsql->dsqlOper($archives, "update");


			//将团购券状态更改为未使用
			$sql = $dsql->SetQuery("UPDATE `#@__tuanquan` SET `usedate` = 0 WHERE `id` = '$val'");
			$dsql->dsqlOper($sql, "update");

			//更新订单状态
			$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 1 WHERE `id` = ".$orderid);
			$dsql->dsqlOper($sql, "update");
		}

	}
	adminLog("取消登记消费团购券", $id);
	echo '{"state": 100, "info": '.json_encode("操作成功！").'}';
	die;
	
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		'admin/tuan/tuanQuanList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/tuan";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}