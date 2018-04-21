<?php
/**
 * 后台管理配置文件
 *
 * @version        $Id: config.inc.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.Administrator
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
require_once(HUONIAOADMIN.'/../include/common.inc.php');
require_once(HUONIAOINC.'/class/userLogin.class.php');
$huoniaoTag->caching         = FALSE;                             //是否使用缓存，后台不需要开启
$huoniaoTag->compile_dir     = HUONIAOROOT."/templates_c/admin";  //设置编译目录
$huoniaoTag->template_dir = dirname(__FILE__)."/templates";       //设置后台模板目录
$userLogin = new userLogin($dbo);

//header('Cache-Control:private');

//获取当前地址
$Nowurl = $s_scriptName = '';
$path = array();

$Nowurl = GetCurUrl();
$Nowurls = explode('/', $Nowurl);
for($i = 2; $i < count($Nowurls); $i++){
	array_push($path, $Nowurls[$i]);
}

$s_scriptName = join("/", $path);

//检验用户登录状态
if($userLogin->getUserID()==-1){
    header("location:".HUONIAOADMIN."/login.php?gotopage=".urlencode($s_scriptName));
    exit();
}

$userLogin->keepUser();

$huoniaoTag->assign("adminPath", HUONIAOADMIN."/");
//css
$huoniaoTag->assign('cssFile', includeFile('css'));