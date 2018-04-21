<?php
/**
 * APP基本配置
 *
 * @version        $Id: appConfig.php 2017-04-12 下午15:07:11 $
 * @package        HuoNiao.APP
 * @copyright      Copyright (c) 2013 - 2017, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("appConfig");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/app";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "appConfig.html";

//异步提交
if(!empty($_POST)){
	if($token == "") die('token传递失败！');

	$sql = $dsql->SetQuery("SELECT `android_download` FROM `#@__app_config`");
	$ret = $dsql->dsqlOper($sql, "totalCount");

	//存在则更新，不存在插入
	if($ret){
		$map_set = empty($map_set) ? 1 : $map_set;
		$sql = $dsql->SetQuery("UPDATE `#@__app_config` SET `logo` = '$logo', `android_version` = '$android_version', `ios_version` = '$ios_version', `android_download` = '$android_download', `ios_download` = '$ios_download', `android_guide` = '$android_guide', `ios_guide` = '$ios_guide', `ad_pic` = '$ad_pic', `ad_link` = '$ad_link', `ad_time` = '$ad_time', `android_index` = '$android_index', `ios_index` = '$ios_index', `map_baidu_android` = '$map_baidu_android', `map_baidu_ios` = '$map_baidu_ios', `map_google` = '$map_google', `map_set` = '$map_set'");
	}else{
		$sql = $dsql->SetQuery("INSERT INTO `#@__app_config` (`logo`, `android_version`, `ios_version`, `android_download`, `ios_download`, `android_guide`, `ios_guide`, `ad_pic`, `ad_link`, `ad_time`, `android_index`, `ios_index`, `map_baidu_android`, `map_baidu_ios`, `map_google`, `map_set`) VALUES ('$logo', '$android_version', '$ios_version', '$android_download', '$ios_download', '$android_guide', '$ios_guide', '$ad_pic', '$ad_link', '$ad_time', '$android_index', '$ios_index', '$map_baidu_android', '$map_baidu_ios', '$map_google', `$map_set`)");
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
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/app/appConfig.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	//查询当前配置
	$sql = $dsql->SetQuery("SELECT * FROM `#@__app_config` LIMIT 1");
	$ret = $dsql->dsqlOper($sql, "results");
	if($ret){
		$data = $ret[0];

		$huoniaoTag->assign('logo', $data['logo']);
		$huoniaoTag->assign('android_version', $data['android_version']);
		$huoniaoTag->assign('ios_version', $data['ios_version']);
		$huoniaoTag->assign('android_download', $data['android_download']);
		$huoniaoTag->assign('ios_download', $data['ios_download']);
		$huoniaoTag->assign('android_guide', json_encode(explode(",", $data['android_guide'])));
		$huoniaoTag->assign('ios_guide', json_encode(explode(",", $data['ios_guide'])));
		$huoniaoTag->assign('ad_pic', $data['ad_pic']);
		$huoniaoTag->assign('ad_link', $data['ad_link']);
		$huoniaoTag->assign('ad_time', $data['ad_time']);
		$huoniaoTag->assign('android_index', $data['android_index']);
		$huoniaoTag->assign('ios_index', $data['ios_index']);
		$huoniaoTag->assign('map_baidu_android', $data['map_baidu_android']);
		$huoniaoTag->assign('map_baidu_ios', $data['map_baidu_ios']);
		$huoniaoTag->assign('map_google', $data['map_google']);
		$huoniaoTag->assign('map_set', empty($data['map_set']) ? 1 : $data['map_set']);
	}else{
		$huoniaoTag->assign('android_guide', '[]');
		$huoniaoTag->assign('ios_guide', '[]');
	}

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/app";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
