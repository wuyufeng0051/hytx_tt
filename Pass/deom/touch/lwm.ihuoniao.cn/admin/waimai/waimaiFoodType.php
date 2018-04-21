<?php
/**
 * 店铺管理 商品分类
 *
 * @version        $Id: list_type.php 2017-4-25 上午10:16:21 $
 * @package        HuoNiao.Shop
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "../" );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "waimaiFoodType.html";

$dbname = "waimai_list_type";

//更新分类状态
if($action == "updateStatus"){
    if(!empty($id)){

        $val = (int)$val;

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `status` = $val WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "更新成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "更新失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


//更新开启星期显示状态
if($action == "updateWeekShow"){
    if(!empty($id)){

        $val = (int)$val;

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `weekshow` = $val WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "更新成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "更新失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


//删除店铺
if($action == "delete"){
    if(!empty($id)){

        $sql = $dsql->SetQuery("DELETE FROM `#@__$dbname` WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "删除成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "删除失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}



if(empty($sid)){
    header("location:list.php");
    die;
}

$sql = $dsql->SetQuery("SELECT `shopname` FROM `#@__waimai_shop` WHERE `id` = $sid");
$ret = $dsql->dsqlOper($sql, "results");
if(!$ret){
    header("location:waimaiList.php");
    die;
}
$shop = $ret[0];

$shopname = $shop['shopname'];


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
		// 'admin/app.css'
	);
	$huoniaoTag->assign('cssFile', includeFile('css', $cssFile));

    //js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/waimai/waimaiFoodType.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));


    $list = array();
    $sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_list_type` WHERE `sid` = $sid ORDER BY `sort` DESC, `id` DESC");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        foreach ($ret as $key => $value) {
            $list[$key]['id'] = $value['id'];
            $list[$key]['title'] = $value['title'];
            $list[$key]['sort'] = $value['sort'];
            $list[$key]['status'] = $value['status'];
            $list[$key]['start_time'] = $value['start_time'];
            $list[$key]['end_time'] = $value['end_time'];
            $list[$key]['weekshow'] = $value['weekshow'];
            $list[$key]['week'] = $value['week'] ? "星期" . str_replace(",", "、星期", strtr($value['week'], array("1" => "一", "2" => "二", "3" => "三", "4" => "四", "5" => "五", "6" => "六", "7" => "七"))) : "";
        }
    }

    $huoniaoTag->assign('sid', $sid);
    $huoniaoTag->assign('shopname', $shopname);
    $huoniaoTag->assign('list', $list);

	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
