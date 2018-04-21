<?php
/**
 * 添加管理员
 *
 * @version        $Id: adminListAdd.php 2014-1-1 上午0:10:16 $
 * @package        HuoNiao.Member
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("adminListAdd");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/member";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "adminListAdd.html";

$tab = "member";
$dopost = $dopost == "" ? "add" : $dopost;        //操作类型 save添加 edit修改

if($submit == "提交"){
	if($token == "") die('token传递失败！');
}

//新增
if($dopost == "add"){
	
	//表单提交
	if($submit == "提交"){
		
		//表单二次验证
		if(trim($username) == ''){
			echo '{"state": 200, "info": "请输入用户名！"}';
			exit();
		}
		if(trim($password) == ''){
			echo '{"state": 200, "info": "请输入密码！"}';
			exit();
		}
		if(trim($nickname) == ''){
			echo '{"state": 200, "info": "请输入真实姓名！"}';
			exit();
		}
		if(trim($mgroupid) == ''){
			echo '{"state": 200, "info": "请选择所属管理组！"}';
			exit();
		}
		
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `username` = '$username'");
		$return = $dsql->dsqlOper($archives, "results");
		if($return){
			echo '{"state": 200, "info": "此用户名已经存在，请重新填写！"}';
			exit();
		}
		
		$password = $userLogin->_getSaltedHash($password);
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`mtype`, `username`, `password`, `nickname`, `mgroupid`, `state`, `regtime`, `regip`) VALUES (0, '$username', '$password', '$nickname', $mgroupid, $state, ".GetMkTime(time()).", '".GetIP()."')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增管理员", $username);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//表单二次验证
		if(trim($username) == ''){
			echo '{"state": 200, "info": "请输入用户名！"}';
			exit();
		}
		if(trim($nickname) == ''){
			echo '{"state": 200, "info": "请输入真实姓名！"}';
			exit();
		}
		if(trim($mgroupid) == ''){
			echo '{"state": 200, "info": "请选择所属管理组！"}';
			exit();
		}
		
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `username` = '$username' AND `id` != $id");
		$return = $dsql->dsqlOper($archives, "results");
		if($return){
			echo '{"state": 200, "info": "此用户名已经存在，请重新填写！"}';
			exit();
		}
		
		//保存到主表
		if($password == ""){
			$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `username` = '$username', `nickname` = '$nickname', `mgroupid` = $mgroupid, `state` = $state WHERE `id` = ".$id);
		}else{
			$password = $userLogin->_getSaltedHash($password);
			$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `username` = '$username', `password` = '$password', `nickname` = '$nickname', `mgroupid` = $mgroupid, `state` = $state WHERE `id` = ".$id);
		}
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改管理员", $username);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}else{
			echo $return;
		}
		die;
		
	}else{
		if(!empty($id)){
			
			//主表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			
			if(!empty($results)){
				
				$username     = $results[0]['username'];
				$nickname     = $results[0]['nickname'];
				$mgroupid     = $results[0]['mgroupid'];
				$state        = $results[0]['state'];
				
			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}
			
		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}
	
}


//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'admin/member/adminListAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('id', $id);
	$huoniaoTag->assign('username', $username);
	$huoniaoTag->assign('nickname', $nickname);
	
	$archives = $dsql->SetQuery("SELECT `id`, `groupname` FROM `#@__admingroup`");
	$results = $dsql->dsqlOper($archives, "results");
	
	$huoniaoTag->assign('groupList', json_encode($results));
	$huoniaoTag->assign('mgroupid', empty($mgroupid) ? "''" : $mgroupid);
	
	//状态-单选
	$huoniaoTag->assign('stateList', array('0', '1'));
	$huoniaoTag->assign('stateName',array('正常','锁定'));
	$huoniaoTag->assign('state', $state == "" ? 0 : $state);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/member";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}