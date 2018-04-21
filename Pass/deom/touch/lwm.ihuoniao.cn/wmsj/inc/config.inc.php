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
require_once(HUONIAOADMIN.'/function/waimai.fun.php');
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
for($i = 1; $i < count($Nowurls); $i++){
	array_push($path, $Nowurls[$i]);
}

$s_scriptName = join("/", $path);

//检验用户登录状态
$userid = $userLogin->getMemberID();
if($userid==-1){
    header("location:/login.html?furl=".urlencode($s_scriptName));
    exit();

// 判断用户权限
}else{
    $sql = $dsql->SetQuery("SELECT `shopid` FROM `#@__waimai_shop_manager` WHERE `userid` = $userid");
    $ret = $dsql->dsqlOper($sql, "results");
    if(!$ret){
        $param = array("service" => "member");
        $busiDomain = getUrlPath($param);
        showMsg("抱歉，你没有任何外卖店铺可以管理，请联系管理员！", $busiDomain);
        die;
    }

    $manager = array();
    foreach ($ret as $key => $value) {
        array_push($manager, $value['shopid']);
    }
    $managerIds = join(",", $manager);

}

$userLogin->keepUser();

$huoniaoTag->assign("adminPath", HUONIAOADMIN."../");

// 可管理店铺id数组
/*$huoniaoTag->assign("manager", $manager);
$huoniaoTag->assign("managerIds", $managerIds);*/
