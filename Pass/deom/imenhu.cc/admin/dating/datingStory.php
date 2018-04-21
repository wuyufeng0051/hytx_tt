<?php
/**
 * 交友成功故事
 *
 * @version        $Id: datingStory.php 2014-7-21 下午15:55:10 $
 * @package        HuoNiao.Dating
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("datingStory");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/dating";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "datingStory.html";

$tab = "dating_story";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE (`username` like '%$sKeyword%' OR `email` like '%$sKeyword%')");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where .= " AND (`fid` in (".join(",", $userid).") OR `tid` in (".join(",", $userid).") OR `title` like '%".$sKeyword."%')";
			}else{
				$where .= " AND `title` like '%".$sKeyword."%'";
			}
		}else{
			$where .= " AND `title` like '%".$sKeyword."%'";
		}
	}

	if($sType != ""){
		$where .= " AND `process` = ".$sType;
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

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

	$where .= " order by `id` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `fid`, `tid`, `litpic`, `process`, `title`, `state`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["fid"] = $value["fid"];
			$list[$key]["tid"] = $value["tid"];

			//会员信息
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["fid"]);
			$userResult = $dsql->getTypeName($userSql);
			$list[$key]["fidname"] = $userResult[0]['username'];

			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["tid"]);
			$userResult = $dsql->getTypeName($userSql);
			$list[$key]["tidname"] = $userResult[0]['username'];

			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["process"] = $value["process"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["state"] = $value["state"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"     => "dating",
				"template"    => "story",
				"id"          => $value['id']
			);
			$list[$key]['url'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "datingStory": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			array_push($title, $results[0]['title']);

			//删除缩略图
			delPicFile($results[0]['litpic'], "delThumb", "dating");

			//删除图集
			delPicFile($results[0]['pics'], "delAtlas", "dating");

			//删除表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除交友成功故事", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;

	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `state` = ".$state." WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新交友成功故事状态", $id."=>".$state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/dating/datingStory.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/dating";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}