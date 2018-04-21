<?php
//页面跳转同步通知页面路径

require_once(dirname(__FILE__)."/../../include/common.inc.php");

$code    = !empty($_REQUEST['code']) ? trim($_REQUEST['code']) : '';
$module = !empty($_REQUEST['module']) ? trim($_REQUEST['module']) : '';
$sn      = !empty($_REQUEST['sn']) ? trim($_REQUEST['sn']) : '';

if(empty($code)) die('PayCode Request Error!');
if(empty($module)) die('Service Request Error!');
if(empty($sn)) die('OrderSN Request Error!');

//引入配置文件
require_once(dirname(__FILE__)."/$code/$code.php");
$payRequest = new $code();

if($module == "member"){
	$param = array(
		"service"  => $module,
		"type"		 => "user",
		"template" => "record"
	);
}else{
	$param = array(
		"service"  => $module,
		"template" => "payreturn",
		"ordernum" => $sn
	);
}
$url = getUrlPath($param);

if($payRequest->respond()){

	// echo "支付成功！";
	header("location:".$url);

}else{
	// echo "支付失败！";
	header("location:".$url);
}
