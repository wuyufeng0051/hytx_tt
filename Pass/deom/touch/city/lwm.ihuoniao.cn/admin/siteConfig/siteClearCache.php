<?php
/**
 * 清除页面缓存
 *
 * @version        $Id: siteClearCache.php 2014-3-19 上午10:23:13 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("siteClearCache");
$dsql = new dsql($dbo);
$tpl  = dirname(__FILE__)."/../templates/siteConfig";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "siteClearCache.html";

if($action == "do"){
	if(count($module) > 0){
		foreach($module as $m){
			$admin = $type ? 1 : 0;
			clear_all_files($m, $admin);
		}
	}
	adminLog("清除页面缓存", join(",", $module));
	ShowMsg("页面缓存已经清除成功。", "siteClearCache.php");
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'admin/siteConfig/siteClearCache.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('moduleList', getModuleList());
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/siteConfig";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//获取模块数据
function getModuleList(){
	global $dsql;
	$sql = $dsql->SetQuery("SELECT `title`, `name` FROM `#@__site_module` WHERE `parentid` != 0 ORDER BY `weight`, `id`");
	try{
		$result = $dsql->dsqlOper($sql, "results");

		$list = array();

		if($result){//如果有子类
			foreach($result as $key => $value){

				array_push($list, array(
					"title" => $value['title'],
					"name" => $value['name']
				));

				//新闻频道增加图片频道
				// if($value['name'] == "article"){
				// 	array_push($list, array(
				// 		"title" => '图片',
				// 		"name" => 'pic'
				// 	));
				// }

			}
			return $list;
		}else{
			return "";
		}

	}catch(Exception $e){
		//die("模块数据获取失败！");
	}
}
