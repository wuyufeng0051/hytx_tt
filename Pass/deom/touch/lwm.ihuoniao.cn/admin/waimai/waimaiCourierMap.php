<?php
/**
 * 配送员位置
 *
 * @version        $Id: waimaiCourierMap.php 2017-5-26 上午12:23:11 $
 * @package        HuoNiao.Courier
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', ".." );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$dbname = "waimai_courier";
$templates = "waimaiCourierMap.html";

//验证模板文件
if(file_exists($tpl."/".$templates)){

    //css
	$cssFile = array(
		'admin/bootstrap1.css',
		'admin/jquery-ui.css',
		'admin/styles.css',
		'admin/chosen.min.css',
		'admin/ace-fonts.min.css',
		'admin/select.css',
		'admin/ace.min.css',
		'admin/animate.css',
		'admin/font-awesome.min.css',
		'admin/simple-line-icons.css',
		'admin/font.css',
		// 'admin/app.css'
	);
	$huoniaoTag->assign('cssFile', includeFile('css', $cssFile));

    //js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/waimai/waimaiCourierMap.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));


    $list = array();
    $sql = $dsql->SetQuery("SELECT * FROM `#@__$dbname`");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        foreach ($ret as $key => $value) {
            array_push($list, array(
                "name" => $value['name'],
                "lng"  => $value['lng'],
                "lat"  => $value['lat'],
				"state" => $value['state']
            ));
        }
    }
    $huoniaoTag->assign("list", json_encode($list));

	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
