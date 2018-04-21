<?php
/**
 * 管理后台首页主体
 *
 * @version        $Id: index_body.php 2013-7-13 下午12:52:05 $
 * @package        HuoNiao.Administrator
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "." );
require_once(dirname(__FILE__)."/inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/templates";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

include_once(HUONIAOINC.'/config/siteConfig.inc.php');
include_once(HUONIAOINC.'/dbinfo.inc.php');

//获取数据库尺寸
if($dopost == "getMysqlSize"){
	$archives = $dsql->SetQuery('SELECT
CONCAT(sum(ROUND(((DATA_LENGTH + INDEX_LENGTH - DATA_FREE) / 1024 / 1024),2))," MB") AS Size
FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA like "%'.$DB_NAME.'%"');
	$results  = $dsql->dsqlOper($archives, "results");
	$size = 0;
	if($results){
		$size = $results[0]['Size'];
	}
	echo '{"state": 100, "mysqlSize": "'.$size.'"}';
	die;
}

//验证模板文件
$templates = "index_body.html";
if(file_exists($tpl."/".$templates)){

	//js
	$huoniaoTag->assign('jsFile', includeFile('js'));

	$huoniaoTag->assign("cfg_basehost", $cfg_basehost);
	$huoniaoTag->assign("server_port", $_SERVER['SERVER_PORT']);

	$softVersion = getSoftVersion();
	$siteVersion  = explode("\n", $softVersion);  // 0：版本号  1：升级时间
	$version = trim($siteVersion[0]);

	$huoniaoTag->assign("update_version", $version);
	$huoniaoTag->assign("php_uname_s", php_uname('s'));
	$huoniaoTag->assign("php_uname_r", php_uname('r'));
	$huoniaoTag->assign("server_software", $_SERVER["SERVER_SOFTWARE"]);
	$huoniaoTag->assign("PHP_VERSION", PHP_VERSION);

	$huoniaoTag->assign("mysqlinfo", $dsql->getDriverVersion());

	$max_upload = ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled";
	$huoniaoTag->assign("max_upload", $max_upload);

	$huoniaoTag->assign("DB_CHARSET", $DB_CHARSET);

	$huoniaoTag->assign("cfg_bbsState", $cfg_bbsState);
	$huoniaoTag->assign("cfg_bbsType", $cfg_bbsType);

	//在线支付接口接入情况
	//查询数据库中启用的支付方式
    $pay_list = array();
	$archives = $dsql->SetQuery("SELECT * FROM `#@__site_payment` ORDER BY `weight`, `id`");
	$results  = $dsql->dsqlOper($archives, "results");
	foreach($results as $key => $val){
		$pay_list[$val['pay_code']] = $results[$key];
	}

    //取得文件中的支付方式
	$payPath = '../api/payment/';
	$paydir = @opendir($payPath);
    $set_modules = true;
    $payment = $installArr = $uninstallArr = array();

    while(false !== ($subdir = @readdir($paydir))){
		if(is_dir($payPath.$subdir) && $subdir != ".." && $subdir != "."){
            @include_once($payPath . $subdir. '/' . $subdir. '.php');
        }
    }
    @closedir($paydir);

    foreach ($payment as $key => $value){
        ksort($payment[$key]);
    }
    ksort($payment);

    for($i = 0; $i < count($payment); $i++){
        $code = $payment[$i]['pay_code'];
        /* 如果数据库中有，取数据库中的名称和描述 */
        if(isset($pay_list[$code])){
			$in = isset($installArr) ? count($installArr) : 0;
            $installArr[] = $pay_list[$code]['pay_name'];
        }else{
			$un = isset($uninstallArr) ? count($uninstallArr) : 0;
            $uninstallArr[] = $payment[$i]['pay_name'];
        }
    }

	$install = join("<span style='color:#2672ec;'>[已集成]</span>、", $installArr);
	$install = !empty($install) ? $install."<span style='color:#2672ec;'>[已集成]</span>" : "";

	$uninstall = join("<span>[NO]</span>、", $uninstallArr);
	$uninstall = !empty($uninstall) ? $uninstall."<span>[NO]</span>" : "";
	$uninstall = !empty($install) && !empty($uninstall) ? "、".$uninstall : "";

	$huoniaoTag->assign('installPayment', $install);
	$huoniaoTag->assign('uninstallPayment', $uninstall);

	//第三方登录接口接入情况
	//查询数据库中启用的登录方式
    $login_list = array();
	$archives = $dsql->SetQuery("SELECT * FROM `#@__site_loginconnect` ORDER BY `weight`, `id`");
	$results  = $dsql->dsqlOper($archives, "results");
	foreach($results as $key => $val){
		$login_list[$val['code']] = $results[$key];
	}

    //取得文件中的支付方式
	$loginPath = '../api/login/';
	$paydir = @opendir($loginPath);
    $set_modules = true;
    $login = $installArr = $uninstallArr = array();

    while(false !== ($subdir = @readdir($paydir))){
		if(is_dir($loginPath.$subdir) && $subdir != ".." && $subdir != "."){
            @include_once($loginPath . $subdir. '/' . $subdir. '.php');
        }
    }
    @closedir($paydir);

    foreach ($login as $key => $value){
        ksort($login[$key]);
    }
    ksort($login);

    for($i = 0; $i < count($login); $i++){
        $code = $login[$i]['code'];
        /* 如果数据库中有，取数据库中的名称和描述 */
        if(isset($login_list[$code])){
			$in = isset($installArr) ? count($installArr) : 0;
            $installArr[] = "<img src='".$loginPath.$code."/img/16.png' class='icon' />".$login_list[$code]['name'];
        }else{
			$un = isset($uninstallArr) ? count($uninstallArr) : 0;
            $uninstallArr[] = "<img src='".$loginPath.$code."/img/16.png' class='icon' />".$login[$i]['name'];
        }
    }

	$install = join("<span style='color:#2672ec;'>[已集成]</span>、", $installArr);
	$install = !empty($install) ? $install."<span style='color:#2672ec;'>[已集成]</span>" : "";

	$uninstall = join("<span>[NO]</span>、", $uninstallArr);
	$uninstall = !empty($uninstall) ? $uninstall."<span>[NO]</span>" : "";
	$uninstall = !empty($install) && !empty($uninstall) ? "、".$uninstall : "";

	$huoniaoTag->assign('installLogin', $install);
	$huoniaoTag->assign('uninstallLogin', $uninstall);


	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
