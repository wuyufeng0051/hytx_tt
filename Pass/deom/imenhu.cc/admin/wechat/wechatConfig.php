<?php
/**
 * 微信基本设置
 *
 * @version        $Id: wechatConfig.php 2017-2-23 上午12:05:11 $
 * @package        HuoNiao.Wechat
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("wechatConfig");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/wechat";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "wechatConfig.html";

if($_POST){
	if($token == "") die('token传递失败！');

	//站点信息
	$cfg_wechatType      = (int)$wechatType;
	$cfg_wechatToken     = $wechatToken ? $wechatToken : substr(md5(time()), 8, 16);
	$cfg_wechatAppid     = $wechatAppid;
	$cfg_wechatAppsecret = $wechatAppsecret;
	$cfg_wechatName      = $wechatName;
	$cfg_wechatCode      = $wechatCode;
	$cfg_wechatQr        = $wechatQr;

	//站点信息文件内容
	$configFile = "<"."?php\r\n";
	$configFile .= "\$cfg_wechatType = '".$cfg_wechatType."';\r\n";
	$configFile .= "\$cfg_wechatToken = '".$cfg_wechatToken."';\r\n";
	$configFile .= "\$cfg_wechatAppid = '".$cfg_wechatAppid."';\r\n";
	$configFile .= "\$cfg_wechatAppsecret = '".$cfg_wechatAppsecret."';\r\n";
	$configFile .= "\$cfg_wechatName = '"._RunMagicQuotes($cfg_wechatName)."';\r\n";
	$configFile .= "\$cfg_wechatCode = '"._RunMagicQuotes($cfg_wechatCode)."';\r\n";
	$configFile .= "\$cfg_wechatQr = '"._RunMagicQuotes($cfg_wechatQr)."';\r\n";
	$configFile .= "\$cfg_wechatSubscribeType = '".(int)$cfg_wechatSubscribeType."';\r\n";
	$configFile .= "\$cfg_wechatSubscribe = '".$cfg_wechatSubscribe."';\r\n";
	$configFile .= "\$cfg_wechatSubscribeMedia = '".$cfg_wechatSubscribeMedia."';\r\n";
	$configFile .= "?".">";

	$configIncFile = HUONIAOINC.'/config/wechatConfig.inc.php';
	$fp = fopen($configIncFile, "w") or die('{"state": 200, "info": '.json_encode("写入文件 $configIncFile 失败，请检查权限！").'}');
	fwrite($fp, $configFile);
	fclose($fp);

	adminLog("修改微信基本设置");
	die('{"state": 100, "info": '.json_encode("配置成功！").'}');
	exit;

}

//配置参数
require_once(HUONIAOINC.'/config/wechatConfig.inc.php');

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/wechat/wechatConfig.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$wechatToken = substr(md5(time()), 8, 16);
	$huoniaoTag->assign('wechatToken', $cfg_wechatToken ? $cfg_wechatToken : $wechatToken);
	$huoniaoTag->assign('wechatAppid', $cfg_wechatAppid);
	$huoniaoTag->assign('wechatAppsecret', $cfg_wechatAppsecret);
	$huoniaoTag->assign('wechatName', $cfg_wechatName);
	$huoniaoTag->assign('wechatCode', $cfg_wechatCode);
	$huoniaoTag->assign('wechatQr', $cfg_wechatQr);

	//登录确认
	$huoniaoTag->assign('typeState', array('1', '0'));
	$huoniaoTag->assign('typeStateNames',array('需要确认','无需确认直接登录'));
	$huoniaoTag->assign('typeStateChecked', (int)$cfg_wechatType);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/wechat";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
