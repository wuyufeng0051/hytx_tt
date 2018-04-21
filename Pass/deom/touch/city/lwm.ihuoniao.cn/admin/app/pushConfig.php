<?php
/**
 * APP推送配置
 *
 * @version        $Id: pushConfig.php 2017-4-18 下午13:41:20 $
 * @package        HuoNiao.App
 * @copyright      Copyright (c) 2013 - 2017, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("pushConfig");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/app";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "pushConfig.html";

//异步提交
if(!empty($_POST)){
	if($token == "") die('token传递失败！');

	$sql = $dsql->SetQuery("SELECT `android_access_id` FROM `#@__app_push_config`");
	$ret = $dsql->dsqlOper($sql, "totalCount");

	//存在则更新，不存在插入
	if($ret){
		$sql = $dsql->SetQuery("UPDATE `#@__app_push_config` SET `android_access_id` = '$android_access_id', `android_access_key` = '$android_access_key', `android_secret_key` = '$android_secret_key', `ios_access_id` = '$ios_access_id', `ios_access_key` = '$ios_access_key', `ios_secret_key` = '$ios_secret_key'");
	}else{
		$sql = $dsql->SetQuery("INSERT INTO `#@__app_push_config` (`android_access_id`, `android_access_key`, `android_secret_key`, `ios_access_id`, `ios_access_key`, `ios_secret_key`) VALUES ('$android_access_id', '$android_access_key', '$android_secret_key', '$ios_access_id', '$ios_access_key', '$ios_secret_key')");
	}

	$ret = $dsql->dsqlOper($sql, "update");
	if($ret == "ok"){
		updateAppConfig();  //更新APP配置文件
		die('{"state": 100, "info": '.json_encode("配置成功！").'}');
	}else{
		die('{"state": 200, "info": '.json_encode("配置失败，请联系管理员！").'}');
	}
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/app/pushConfig.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	//查询当前配置
	$sql = $dsql->SetQuery("SELECT * FROM `#@__app_push_config` LIMIT 1");
	$ret = $dsql->dsqlOper($sql, "results");
	if($ret){
		$data = $ret[0];

		$huoniaoTag->assign('android_access_id', $data['android_access_id']);
		$huoniaoTag->assign('android_access_key', $data['android_access_key']);
		$huoniaoTag->assign('android_secret_key', $data['android_secret_key']);
		$huoniaoTag->assign('ios_access_id', $data['ios_access_id']);
		$huoniaoTag->assign('ios_access_key', $data['ios_access_key']);
		$huoniaoTag->assign('ios_secret_key', $data['ios_secret_key']);
	}

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/app";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
