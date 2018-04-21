<?php
/**
 * 管理商家列表
 *
 * @version        $Id: businessList.php 2013-12-9 下午21:11:13 $
 * @package        HuoNiao.Tuan
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("businessList");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/business";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "businessList.html";

global $handler;
$handler = true;

$action = "business";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){

		$sidArr = array();
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` like '%$sKeyword%' OR `nickname` like '%$sKeyword%' OR `phone` like '%$sKeyword%' OR `company` like '%$sKeyword%'");
		$results = $dsql->dsqlOper($userSql, "results");
		foreach ($results as $key => $value) {
			$sidArr[$key] = $value['id'];
		}

		if(!empty($sidArr)){
			$where .= " AND (`title` like '%$sKeyword%' OR `address` like '%$sKeyword%' OR `tel` like '%$sKeyword%' OR `uid` in (".join(",",$sidArr)."))";
		}else{
			$where .= " AND (`title` like '%$sKeyword%' OR `address` like '%$sKeyword%' OR `tel` like '%$sKeyword%')";
		}

	}

	if($sType != ""){
		if($dsql->getTypeList($sType, $action."_type")){
			global $arr_data;
			$arr_data = array();
			$lower = arr_foreach($dsql->getTypeList($sType, $action."_type"));
			$lower = $sType.",".join(',',$lower);
		}else{
			$lower = $sType;
		}

		$where .= " AND `typeid` in (".$lower.")";
	}

	if($sAddr != ""){

		if($dsql->getTypeList($sAddr, $action."_addr")){
			global $arr_data;
			$arr_data = array();
			$lower = arr_foreach($dsql->getTypeList($sAddr, $action."_addr"));
			$lower = $sAddr.",".join(',',$lower);
		}else{
			$lower = $sAddr;
		}

		$where .= " AND `addrid` in (".$lower.")";
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."_list` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待审核
	$totalGray = $dsql->dsqlOper($archives." AND `state` = 0".$where, "totalCount");
	//已审核
	$totalAudit = $dsql->dsqlOper($archives." AND `state` = 1".$where, "totalCount");
	//拒绝审核
	$totalRefuse = $dsql->dsqlOper($archives." AND `state` = 2".$where, "totalCount");

	if($state != ""){
		$where .= " AND `state` = $state";

		if($state == 0){
			$totalPage = ceil($totalGray/$pagestep);
		}elseif($state == 1){
			$totalPage = ceil($totalAudit/$pagestep);
		}elseif($state == 2){
			$totalPage = ceil($totalRefuse/$pagestep);
		}
	}

	$where .= " order by `pubdate` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `uid`, `title`, `logo`, `typeid`, `addrid`, `tel`, `qq`, `pubdate`, `authattr`, `state` FROM `#@__".$action."_list` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		$i = 0;
		foreach ($results as $key=>$value) {
			$list[$i]["id"] = $value["id"];
			$list[$i]["uid"] = $value["uid"];

			$user = "";
			$sql = $dsql->SetQuery("SELECT `nickname`, `company` FROM `#@__member` WHERE `id` = ".$value['uid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				if($ret[0]['company']){
					$user = $ret[0]['company'];
				}else{
					$user = $ret[0]['nickname'];
				}
			}
			$list[$i]['user'] = $user;

			$list[$i]["title"] = $value["title"];
			$list[$i]["logo"] = getFilePath($value["logo"]);

			//分类
			$list[$i]["typeid"] = $value["typeid"];
			$typename = "";
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__".$action."_type` WHERE `id` = ".$value['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typename = $ret[0]['typename'];
			}
			$list[$i]['typename'] = $typename;

			//区域
			$list[$i]["addrid"] = $value["addrid"];
			$addrname = "";
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__".$action."_addr` WHERE `id` = ".$value['addrid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$addrname = $ret[0]['typename'];
			}
			$list[$i]['addrname'] = $addrname;

			$list[$i]["tel"] = $value["tel"];
			$list[$i]["qq"] = $value["qq"];
			$list[$i]["pubdate"] = date("Y-m-d H:i:s", $value["pubdate"]);
			$list[$i]["state"] = $value['state'];

			$auth = array();
			if($value['authattr']){
				$authattr = explode(",", $value['authattr']);
				foreach ($authattr as $k => $v) {
					$sql = $dsql->SetQuery("SELECT `jc`, `typename` FROM `#@__business_authattr` WHERE `id` = $v");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						array_push($auth, array("jc" => $ret[0]['jc'], "typename" => $ret[0]['typename']));
					}
				}
			}
			$list[$i]["auth"] = $auth;

			$param = array(
				"service"     => "business",
				"template"    => "detail",
				"id"          => $value['id']
			);
			$list[$i]["url"] = getUrlPath($param);
			$i++;
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "businessList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){

		//查询信息之前的状态
		$sql = $dsql->SetQuery("SELECT `title`, `state`, `pubdate`, `uid` FROM `#@__".$action."_list` WHERE `id` = $val");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$title    = $ret[0]['title'];
			$state    = $ret[0]['state'];
			$pubdate  = $ret[0]['pubdate'];
			$userid   = $ret[0]['uid'];

			//会员消息通知
			if($arcrank != $state){

				$status = "";

				//等待审核
				if($arcrank == 0){
					$status = "进入等待审核状态。";

				//已审核
				}elseif($arcrank == 1){
					$status = "已经通过审核。";

				//审核失败
				}elseif($arcrank == 2){
					$status = "审核失败。";
				}

				$param = array(
					"service"  => "member",
					"template" => "config",
					"action"   => "business"
				);

				//获取会员名
				$username = "";
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $userid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}

				updateMemberNotice($userid, "会员-店铺审核通知", $param, array("username" => $username, "title" => $title, "status" => $status, "date" => date("Y-m-d H:i:s", $pubdate)));

			}

		}



		$archives = $dsql->SetQuery("UPDATE `#@__".$action."_list` SET `state` = $arcrank WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("更新商家状态", $id."=>".$arcrank);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if($id == "") die;

	$each = explode(",", $id);
	$error = array();
	$title = array();
	foreach($each as $val){

		//删除介绍
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_about` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除动态分类
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_news_type` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除动态
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_news` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除相册分类
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_albums_type` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除相册
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_albums` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除视频
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_video` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除全景
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_panor` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除点评
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_comment` WHERE `bid` = ".$val);
		$dsql->dsqlOper($archives, "update");

		//删除表
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_list` WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("删除商家信息", join(", ", $title));
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/business/businessList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, $action."_type")));
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, $action."_addr")));
	$huoniaoTag->assign('notice', $notice);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/business";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
