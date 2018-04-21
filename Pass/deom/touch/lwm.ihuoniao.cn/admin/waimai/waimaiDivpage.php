<?php
/**
 * 微页面
 *
 * @version        $Id: index.php 2017-5-9 下午15:46:15 $
 * @package        HuoNiao.Divpage
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "../" );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "waimaiDivpage.html";

$dbname = "waimai_system";


//提交
if(!empty($_POST)){

    //页面标题
    if($type == "title"){

        if(empty($title)){
            echo '{"state": 200, "info": "请输入页面标题"}';
    		exit();
        }


        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `title` = '$title', `description` = '$description', `tel` = '$tel', `share_pic` = '$share_pic'");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "保存成功"}';
        }else{
            echo '{"state": 200, "info": "保存失败，请重试！"}';
        }
        die;

    //banner
    }elseif($type == "banner"){

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `index_banner` = '$banner'");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "保存成功"}';
        }else{
            echo '{"state": 200, "info": "保存失败，请重试！"}';
        }
        die;

    //tubiao_nav
    }elseif($type == "tubiao_nav"){

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `tubiao_nav` = '$tubiao_nav'");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "保存成功"}';
        }else{
            echo '{"state": 200, "info": "保存失败，请重试！"}';
        }
        die;

    //ad1
    }elseif($type == "ad1"){

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `ad1` = '$ad1'");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "保存成功"}';
        }else{
            echo '{"state": 200, "info": "保存失败，请重试！"}';
        }
        die;

    //huodong_nav
    }elseif($type == "huodong_nav"){

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `huodong_nav` = '$huodong_nav'");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "保存成功"}';
        }else{
            echo '{"state": 200, "info": "保存失败，请重试！"}';
        }
        die;

    //店铺
    }elseif($type == "shop"){

        $shop = isset($shop) ? join(',',$shop) : '';

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `shop` = '$shop'");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "保存成功"}';
        }else{
            echo '{"state": 200, "info": "保存失败，请重试！"}';
        }
        die;

    }

}



//验证模板文件
if(file_exists($tpl."/".$templates)){


    //css
	$cssFile = array(
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
		'ui/jquery.chosen.css'
	);
	$huoniaoTag->assign('cssFile', includeFile('css', $cssFile));

    //js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/chosen.jquery.min.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/waimai/waimaiDivpage.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));




    $huoniaoTag->assign('type', $type);

    //选择店铺
    $shopList = array();
    $sql = $dsql->SetQuery("SELECT `id`, `shopname` FROM `#@__waimai_shop` ORDER BY `sort` DESC, `id` DESC");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        $shopList = $ret;
    }
    $huoniaoTag->assign('shopList', $shopList);


    //获取信息内容
    $huoniaoTag->assign('index_banner', '[]');
    $sql = $dsql->SetQuery("SELECT * FROM `#@__$dbname` LIMIT 0, 1");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        foreach ($ret[0] as $key => $value) {
            if($key == "shop"){
                $value = explode(",", $value);
            }
            $huoniaoTag->assign($key, $value);
        }
    }


	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
