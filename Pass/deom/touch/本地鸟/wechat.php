<?php
ini_set('display_errors','Off');
include_once(dirname(__FILE__) . "/WechatJSSDK.php");
$jssdk = new WechatJSSDK($_GET['id'], $_GET['secret'], $_GET['url']);
$signPackage = $jssdk->GetSignPackage();
echo json_encode($signPackage);
