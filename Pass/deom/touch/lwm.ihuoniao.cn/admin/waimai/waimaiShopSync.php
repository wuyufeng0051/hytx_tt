<?php
/**
 * 店铺管理 同步店铺
 *
 * @version        $Id: add.php 2017-4-25 上午11:19:16 $
 * @package        HuoNiao.Shop
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', ".." );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$dbname = "waimai_shop";
$templates = "waimaiShopSync.html";

//表单提交
if($_POST){

    //获取表单数据
    $from = (int)$courier_id;               // 源店铺
    $config = $SetShop;                      // 需要同步的设置
    $objIds = $SetShop_ids;             // 需要同步的店铺列表 array
    $shoptype = (int)$shop_type;            // 需要同步的店铺分类

    if(empty($from)) die('{"state": 200, "info": "请选择源店铺！"}');

    $syncType = $config['syn_type'];        // 同步方式
    if(empty($syncType)) die('{"state": 200, "info": "请选择同步方式！"}');

    if(count($config) == 1) die('{"state": 200, "info": "请选择需要同步的设置！"}');

    $where = "";
    // 全部店铺
    if($syncType == 1){
        $where = " `id` != $from";
    }elseif($syncType == 2){
        if(in_array($from, $objIds)) die('{"state": 200, "info": "需要同步到的店铺不能包含源店铺"}');

        $where = " `id` in (".join(",", $objIds).")";
    }elseif($syncType == 3){
        if(empty($syncType)) die('{"state": 200, "info": "需要同步的店铺分类！"}');
        $where = " `typeid` = $shoptype";
    }else{
        die('{"state": 200, "info": "参数错误！"}');
    }

    $archives = $dsql->SetQuery("SELECT * FROM `#@__$dbname` WHERE `id` = $from");
    $results  = $dsql->dsqlOper($archives, "results");
    if($results){

        $fromData = $results[0];

        $fields = array();

        // 支付方式
        if(isset($config['paytype'])){
            array_push($fields, "paytype");
            array_push($fields, "offline_limit");
            array_push($fields, "pay_offline_limit");
        }

        // 店铺活动
        if(isset($config['active'])){
            array_push($fields, "is_first_discount");
            array_push($fields, "first_discount");
            array_push($fields, "is_discount");
            array_push($fields, "discount_value");
            array_push($fields, "open_promotion");
            array_push($fields, "promotions");
        }

        // 预设选项
        if(isset($config['options'])){
            array_push($fields, "preset");
        }

        // 增值服务
        if(isset($config['addservice'])){
            array_push($fields, "open_addservice");
            array_push($fields, "addservice");
        }

        // 营业星期
        if(isset($config['weeks'])){
            array_push($fields, "weeks");
            array_push($fields, "addservice");
        }

        // 营业时间段
        if(isset($config['shop_active_time'])){
            array_push($fields, "start_time1");
            array_push($fields, "end_time1");
            array_push($fields, "start_time2");
            array_push($fields, "end_time2");
            array_push($fields, "start_time3");
            array_push($fields, "end_time3");
            array_push($fields, "delivery_radius");
            array_push($fields, "delivery_area");
        }

        // 配送时间
        /*if(isset($config['deliver'])){
            array_push($fields, "weeks");
            array_push($fields, "addservice");
        }*/

        // 起送价、配送费模式
        if(isset($config['delivery_mode'])){
            array_push($fields, "delivery_fee_mode");
        }

        // 固定配送费
        if(isset($config['delivery_fee'])){
            array_push($fields, "delivery_fee");
        }

        // 固定起送价
        if(isset($config['basicprice'])){
            array_push($fields, "basicprice");
        }

        // 固定满免配送费金额
        if(isset($config['no_delivery_fee_value'])){
            array_push($fields, "delivery_fee_type");
            array_push($fields, "delivery_fee_value");
        }

        // 按距离计算外送费规则
        if(isset($config['juli_data'])){
            array_push($fields, "range_delivery_fee_value");
        }

        // 按区域计算外送费规则
        if(isset($config['area_data'])){
            array_push($fields, "service_area_data");
        }

        // 订单语音提醒
        if(isset($config['order_voice_remind'])){
            array_push($fields, "smsvalid");
            array_push($fields, "sms_phone");
            array_push($fields, "emailvalid");
            array_push($fields, "email_address");
            array_push($fields, "weixinvalid");
            array_push($fields, "customerid");
            array_push($fields, "auto_printer");
            array_push($fields, "showordernum");
        }

        $fieldList = array();
        foreach ($fields as $key => $value) {
            array_push($fieldList, "`$value` = '".$fromData[$value]."'");
        }

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET " . join(",", $fieldList) . " WHERE " . $where);
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "同步成功！"}';
        }else{
            echo '{"state": 200, "info": "同步失败！"}';
        }


    }else{
        echo '{"state": 200, "info": "源店铺不存在！"}';
    }

    exit();

}

$list = array();
$sql = $dsql->SetQuery("SELECT s.`id`, s.`shopname` FROM `#@__$dbname` s WHERE 1 = 1");
$ret = $dsql->dsqlOper($sql, "results");
if($ret){
    $list = $ret;
}
$huoniaoTag->assign('list', $list);

$type = array();
$sql = $dsql->SetQuery("SELECT t.`id`, t.`title` FROM `#@__waimai_shop_type` t WHERE 1 = 1");
$ret = $dsql->dsqlOper($sql, "results");
if($ret){
    $type = $ret;
}
$huoniaoTag->assign('type', $type);

//验证模板文件
if(file_exists($tpl."/".$templates)){

    //css
	$cssFile = array(
        'ui/jquery.chosen.css',
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
		'ui/jquery-ui.min.js',
		'ui/jquery.form.js',
		'ui/jquery-ui-timepicker-addon.js',
		'ui/jquery.dragsort-0.5.1.min.js',
        'ui/chosen.jquery.min.js',
		'publicUpload.js',
		'admin/waimai/waimaiShopSync.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
