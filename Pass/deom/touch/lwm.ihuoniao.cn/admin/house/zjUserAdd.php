<?php
/**
 * 添加经纪人
 *
 * @version        $Id: zjUserAdd.php 2014-1-20 上午00:21:14 $
 * @package        HuoNiao.House
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/house";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "zjUserAdd.html";

$tab = "house_zjuser";
$dopost = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改
if($dopost == "edit"){
	$pagetitle = "修改经纪人";
	checkPurview("zjUserEdit");
}else{
	$pagetitle = "添加经纪人";
	checkPurview("zjUserAdd");
}

if(empty($comid)) $comid = 0;
if(empty($userid)) $userid = 0;
if(empty($weight)) $weight = 1;
if(empty($state)) $state = 0;
if(empty($click)) $click = mt_rand(50, 200);

if($_POST['submit'] == "提交"){

	if($token == "") die('token传递失败！');
	//二次验证
	if($comid == 0 && trim($comid) == ''){
		echo '{"state": 200, "info": "请选择中介公司"}';
		exit();
	}
	if($comid == 0){
		$comSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `title` = '".$zjcom."'");
		$comResult = $dsql->dsqlOper($comSql, "results");
		if(!$comResult){
			echo '{"state": 200, "info": "中介公司不存在，请在联想列表中选择"}';
			exit();
		}
		$comid = $comResult[0]['id'];
	}else{
		$comSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `id` = ".$comid);
		$comResult = $dsql->dsqlOper($comSql, "results");
		if(!$comResult){
			echo '{"state": 200, "info": "中介公司不存在，请在联想列表中选择"}';
			exit();
		}
	}

	if($userid == 0 && trim($user) == ''){
		echo '{"state": 200, "info": "请选择会员"}';
		exit();
	}
	if($userid == 0){
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` = '".$user."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			echo '{"state": 200, "info": "会员不存在，请在联想列表中选择"}';
			exit();
		}
		$userid = $userResult[0]['id'];
	}else{
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `id` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			echo '{"state": 200, "info": "会员不存在，请在联想列表中选择"}';
			exit();
		}
	}

	//检测是否已经注册
	if($dopost == "save"){

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = '".$userid."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已经加入其它中介公司，不可以重复添加！"}';
			exit();
		}

	}else{

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = '".$userid."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已经加入其它中介公司，不可以重复添加！"}';
			exit();
		}

	}

}

if($dopost == "save" && $submit == "提交"){
	//保存到表
	$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`userid`, `zjcom`, `store`, `addr`, `community`, `litpic`, `note`, `weight`, `click`, `state`, `flag`, `pubdate`) VALUES ('$userid', '$comid', '$store', '$addr', '$community', '$litpic', '$note', '$weight', '$click', '$state', '$flag', '".GetMkTime(time())."')");
	$aid = $dsql->dsqlOper($archives, "lastid");

	if($aid){
		adminLog("添加经纪人", $userid);
		$param = array(
			"service"  => "house",
			"template" => "broker-detail",
			"id"       => $aid
		);
		$url = getUrlPath($param);

		echo '{"state": 100, "url": "'.$url.'"}';
	}else{
		echo '{"state": 200, "info": '.json_encode("保存到数据库失败！").'}';
	}
	die;
}elseif($dopost == "edit"){

	if($submit == "提交"){
		//保存到表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `userid` = '$userid', `zjcom` = '$comid', `store` = '$store', `addr` = '$addr', `community` = '$community', `litpic` = '$litpic', `note` = '$note', `weight` = '$weight', `click` = '$click', `state` = '$state', `flag` = '$flag' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results == "ok"){
			adminLog("修改经纪人信息", $id);

			$param = array(
				"service"  => "house",
				"template" => "broker-detail",
				"id"       => $id
			);
			$url = getUrlPath($param);

			echo '{"state": 100, "info": '.json_encode('修改成功！').', "url": "'.$url.'"}';
		}else{
			echo '{"state": 200, "info": '.json_encode('修改失败！').'}';
		}
		die;
	}

	if(!empty($id)){

		//主表信息
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if(!empty($results)){

			$userid      = $results[0]['userid'];
			$zjcom       = $results[0]['zjcom'];
			$store       = $results[0]['store'];
			$addr        = $results[0]['addr'];
			$community   = $results[0]['community'];
			$litpic      = $results[0]['litpic'];
			$note        = $results[0]['note'];
			$weight      = $results[0]['weight'];
			$click       = $results[0]['click'];
			$state       = $results[0]['state'];
			$flag        = $results[0]['flag'];

		}else{
			ShowMsg('要修改的信息不存在或已删除！', "-1");
			die;
		}

	}else{
		ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
		die;
	}

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/house/zjUserAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('dopost', $dopost);
	require_once(HUONIAOINC."/config/house.inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_thumbSize;
		global $custom_thumbType;
		$huoniaoTag->assign('thumbSize', $custom_thumbSize);
		$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
	}

	if($id != ""){
		$huoniaoTag->assign('id', $id);

		$huoniaoTag->assign('userid', $userid);
		$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
		$username = $dsql->getTypeName($userSql);
		$huoniaoTag->assign('username', $username[0]['username']);

		$huoniaoTag->assign('comid', $zjcom);
		$comSql = $dsql->SetQuery("SELECT `title` FROM `#@__house_zjcom` WHERE `id` = ". $zjcom);
		$comname = $dsql->getTypeName($comSql);
		$huoniaoTag->assign('zjcom', $comname[0]['title']);

		$huoniaoTag->assign('store', $store);
		$huoniaoTag->assign('litpic', $litpic);
		$huoniaoTag->assign('note', $note);
	}

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "houseaddr")));
	$huoniaoTag->assign('addr', $addr == "" ? 0 : $addr);

	$huoniaoTag->assign('community', $community);
	$huoniaoTag->assign('weight', $weight == "" ? "50" : $weight);
	$huoniaoTag->assign('click', $click);

	//显示状态
	$huoniaoTag->assign('stateopt', array('0', '1', '2'));
	$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
	$huoniaoTag->assign('state', $state == "" ? 1 : $state);

	//属性
	$huoniaoTag->assign('flagopt', array('0', '1', '2'));
	$huoniaoTag->assign('flagnames',array('待认证','已认证','认证失败'));
	$huoniaoTag->assign('flag', $flag == "" ? 1 : $flag);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/house";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
