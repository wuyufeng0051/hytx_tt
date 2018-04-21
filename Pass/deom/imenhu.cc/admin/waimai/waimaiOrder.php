<?php
/**
 * 管理外卖订单
 *
 * @version        $Id: waimaiOrder.php 2014-10-23 下午15:06:10 $
 * @package        HuoNiao.Waimai
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("waimaiOrder");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$action = "waimai_order";

if($dopost != ""){
	$templates = "waimaiOrderEdit.html";

	//js
	$jsFile = array(
		'admin/waimai/waimaiOrderEdit.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "waimaiOrder.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		'admin/waimai/waimaiOrder.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){

		$where .= " AND `ordernum` like '%$sKeyword%' OR `people` like '%$sKeyword%' OR `contact` like '%$sKeyword%'";

		$proSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__waimai_store` WHERE `title` like '%$sKeyword%'");
		$proResult = $dsql->dsqlOper($proSql, "results");
		if($proResult){
			$proid = array();
			foreach($proResult as $key => $pro){
				array_push($proid, $pro['id']);
			}
			if(!empty($proid)){
				$where .= " OR `store` in (".join(",", $proid).")";
			}
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `username` FROM `#@__member` WHERE `username` like '%$sKeyword%'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where .= " OR `userid` in (".join(",", $userid).")";
			}
		}

	}

	if($start != ""){
		$where .= " AND `orderdate` >= ". GetMkTime($start);
	}

	if($end != ""){
		$where .= " AND `orderdate` <= ". GetMkTime($end);
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."` WHERE 1 = 1".$where);

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待付款
	$state0 = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
	//已付款
	$state1 = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
	//已发货
	$state2 = $dsql->dsqlOper($archives." AND `state` = 2", "totalCount");
	//订单完成
	$state3 = $dsql->dsqlOper($archives." AND `state` = 3", "totalCount");

	if($state != ""){
		$where .= " AND `state` = $state";

		if($state == 0){
			$totalPage = ceil($state0/$pagestep);
		}elseif($state == 1){
			$totalPage = ceil($state1/$pagestep);
		}elseif($state == 2){
			$totalPage = ceil($state2/$pagestep);
		}elseif($state == 3){
			$totalPage = ceil($state3/$pagestep);
		}
	}

	$where .= " order by `id` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `ordernum`, `userid`, `store`, `price`, `paytype`, `peisong`, `state`, `people`, `contact`, `orderdate` FROM `#@__".$action."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["ordernum"] = $value["ordernum"];
			$list[$key]["userid"] = $value["userid"];

			//用户名
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["userid"]);
			$username = $dsql->dsqlOper($userSql, "results");
			$list[$key]["username"] = $username[0]['username'];

			//餐厅
			$list[$key]["storeid"] = $value["store"];
			$storeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_store` WHERE `id` = ". $value['store']);
			$storename = $dsql->getTypeName($storeSql);
			$list[$key]["storename"] = $storename[0]["title"];

			$list[$key]["price"] = $value["price"];

			$paytype = $value["paytype"];
			if(empty($paytype)){
				$list[$key]["paytype"] = "到付";
			}else{
				//主表信息
				$sql = $dsql->SetQuery("SELECT `pay_name` FROM `#@__site_payment` WHERE `pay_code` = '$paytype'");
				$ret = $dsql->dsqlOper($sql, "results");
				if(!empty($ret)){
					$list[$key]["paytype"] = $ret[0]['pay_name'];
				}else{
					$list[$key]["paytype"] = $paytype;
				}
			}

			$list[$key]["peisong"] = $value["peisong"];
			$list[$key]["state"] = $value["state"];
			$list[$key]["people"] = $value["people"];
			$list[$key]["contact"] = $value["contact"];

			$list[$key]["orderdate"] = date('Y-m-d H:i:s', $value["orderdate"]);

			$param = array(
				"service"     => "waimai",
				"template"    => "shop",
				"id"          => $value['store']
			);
			$list[$key]['url'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state3": '.$state3.', "state2": '.$state2.', "state1": '.$state1.'}, "waimaiOrder": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state3": '.$state3.', "state2": '.$state2.', "state1": '.$state1.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state3": '.$state3.', "state2": '.$state2.', "state1": '.$state1.'}}';
	}
	die;

//修改
}elseif($dopost == "edit"){
	checkPurview("waimaiOrderEdit");
	$pagetitle = "修改外卖订单";
	if($id == "") die('要修改的信息ID传递失败！');

	//主表信息
	$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	if(!empty($results)){

		$ordernum  = $results[0]['ordernum'];
		$userid    = $results[0]['userid'];
		$store     = $results[0]['store'];
		$menus     = $results[0]['menus'];
		$price     = $results[0]['price'];
		$peisong   = $results[0]['peisong'];
		$offer     = $results[0]['offer'];
		$paytype   = $results[0]['paytype'];
		$people    = $results[0]['people'];
		$contact   = $results[0]['contact'];
		$address   = $results[0]['address'];
		$note      = $results[0]['note'];
		$orderdate = $results[0]['orderdate'];
		$state     = $results[0]['state'];
		$paydate     = $results[0]['paydate'];
		$songdate    = $results[0]['songdate'];
		$confirm     = $results[0]['confirm'];
		$peisong_note = $results[0]['peisong_note'];

		$priceTotal = sprintf("%.2f", $price + $peisong - $offer);

		//订单内容
		$menuList = array();
		$sql = $dsql->SetQuery("SELECT `pid`, `pname`, `price`, `count` FROM `#@__waimai_order_product` WHERE `orderid` = $id");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			foreach ($ret as $key => $value) {

				array_push($menuList, '<tr data-id="'.$value['pid'].'">');
				array_push($menuList, '<td>'.$value['pname'].'</td>');
				array_push($menuList, '<td>&yen;'.sprintf("%.2f", $value['price']).'</td>');
				array_push($menuList, '<td>'.$value['count'].'</td>');
				array_push($menuList, '<td>&yen;'.sprintf("%.2f", $value['price'] * $value['count']).'</td>');
				array_push($menuList, '</tr>');
			}
		}
		$huoniaoTag->assign('menuList', join("", $menuList));


		//商家链接
		$param = array(
			"service"     => "waimai",
			"template"    => "shop",
			"id"          => $store
		);
		$huoniaoTag->assign('url', getUrlPath($param));


	}else{
		ShowMsg('要修改的信息不存在或已删除！', "-1");
		die;
	}



//删除
}elseif($dopost == "del"){

	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}

		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_product` WHERE `orderid` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("删除外卖订单", $id);
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	if($dopost == "edit"){
		$huoniaoTag->assign('id', (int)$id);
		$huoniaoTag->assign('ordernum', $ordernum);

		//用户名
		$huoniaoTag->assign('userid', $userid);
		$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
		$username = $dsql->dsqlOper($userSql, "results");
		$huoniaoTag->assign('username', $username[0]['username']);

		//餐厅
		$huoniaoTag->assign('storeid', $store);
		$storeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_store` WHERE `id` = ". $store);
		$storename = $dsql->getTypeName($storeSql);
		$huoniaoTag->assign('storename', $storename[0]["title"]);

		$huoniaoTag->assign('menus', $menus);
		$huoniaoTag->assign('price', $price);
		$huoniaoTag->assign('peisong', $peisong);
		$huoniaoTag->assign('offer', $offer);

		if(empty($paytype)){
			$huoniaoTag->assign('paytype', "到付");
		}else{
			//主表信息
			$sql = $dsql->SetQuery("SELECT `pay_name` FROM `#@__site_payment` WHERE `pay_code` = '$paytype'");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!empty($ret)){
				$huoniaoTag->assign('paytype', $ret[0]['pay_name']);
			}else{
				$huoniaoTag->assign('paytype', $paytype);
			}
		}

		$huoniaoTag->assign('people', $people);
		$huoniaoTag->assign('contact', $contact);
		$huoniaoTag->assign('address', $address);
		$huoniaoTag->assign('note', $note);
		$huoniaoTag->assign('orderdate', date("Y-m-d h:i:s", $orderdate));
		$huoniaoTag->assign('paydate', date("Y-m-d h:i:s", $paydate));
		$huoniaoTag->assign('priceTotal', $priceTotal);
		$huoniaoTag->assign('state', $state);
		$huoniaoTag->assign('songdate',date("Y-m-d h:i:s", $songdate));
		$huoniaoTag->assign('confirm', date("Y-m-d h:i:s", $confirm));
		$huoniaoTag->assign('peisong_note', $peisong_note);
	}

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/waimai";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
