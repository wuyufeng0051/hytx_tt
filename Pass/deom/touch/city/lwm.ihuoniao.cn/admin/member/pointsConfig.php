<?php
/**
 * 积分设置
 *
 * @version        $Id: pointsConfig.php 2015-8-4 下午15:09:11 $
 * @package        HuoNiao.Member
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("pointsConfig");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/member";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "pointsConfig.html";
$dir       = "../../templates/member"; //当前目录

if(!empty($_POST)){
	if($token == "") die('token传递失败！');

	$cfg_pointName  = $pointName;
	$cfg_pointRatio = (float)$pointRatio;
	$cfg_pointFee   = (float)$pointFee;
			
	adminLog("修改积分设置");

	
	//站点信息文件内容
	$configFile = "<"."?php\r\n";
	$configFile .= "\$cfg_pointName = '".$cfg_pointName."';\r\n";
	$configFile .= "\$cfg_pointRatio = ".$cfg_pointRatio.";\r\n";
	$configFile .= "\$cfg_pointFee = ".$cfg_pointFee.";\r\n";
	$configFile .= "?".">";
	
	$configIncFile = HUONIAOINC.'/config/pointsConfig.inc.php';
	$fp = fopen($configIncFile, "w") or die('{"state": 200, "info": '.json_encode("写入文件 $configIncFile 失败，请检查权限！").'}');
	fwrite($fp, $configFile);
	fclose($fp);
	
	die('{"state": 100, "info": '.json_encode("配置成功！").'}');
	exit;
		
}

//配置参数
require_once(HUONIAOINC.'/config/pointsConfig.inc.php');

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/member/pointsConfig.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
	$huoniaoTag->assign('pointName', $cfg_pointName);
	$huoniaoTag->assign('pointRatio', $cfg_pointRatio);
	$huoniaoTag->assign('pointFee', $cfg_pointFee);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/pointsConfig";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}