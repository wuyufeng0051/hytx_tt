<?php
/**
 * 店铺管理 新建店铺
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
$templates = "waimaiShopAdd.html";

//表单提交
if($_POST){

    //获取表单数据
    $id                      = (int)$id;
    $sort                    = (int)$sort;
    $typeid                  = $typeid;
    $category                = (int)$category;
    $weeks                   = isset($weeks) ? join(',',$weeks) : '';
    $delivery_radius         = (float)$delivery_radius;
    $delivery_fee_mode       = (int)$delivery_fee_mode;
    $basicprice              = (float)$basicprice;
    $delivery_fee            = (float)$delivery_fee;
    $delivery_fee_type       = (int)$delivery_fee_type;
    $delivery_fee_value      = (float)$delivery_fee_value;
    $open_range_delivery_fee = (int)$open_range_delivery_fee;
    $shop_notice_used        = (int)$shop_notice_used;
    $linktype                = (int)$linktype;
    $callshow                = (int)$callshow;
    $unitshow                = (int)$unitshow;
    $opencomment             = (int)$opencomment;
    $showtype                = (int)$showtype;
    $food_showtype           = (int)$food_showtype;
    $showsales               = (int)$showsales;
    $show_basicprice         = (int)$show_basicprice;
    $show_delivery           = (int)$show_delivery;
    $show_range              = (int)$show_range;
    $show_area               = (int)$show_area;
    $show_delivery_service   = (int)$show_delivery_service;
    $paytype                 = isset($paytype) ? join(',',$paytype) : '';
    $offline_limit           = (int)$offline_limit;
    $pay_offline_limit       = (float)$pay_offline_limit;
    $is_first_discount       = (int)$is_first_discount;
    $first_discount          = (float)$first_discount;
    $is_discount             = (int)$is_discount;
    $discount_value          = (float)$discount_value;
    $open_promotion          = (int)$open_promotion;
    $smsvalid                = (int)$smsvalid;
    $emailvalid              = (int)$emailvalid;
    $weixinvalid             = (int)$weixinvalid;
    $customerid              = (int)$customerid;
    $auto_printer            = (int)$auto_printer;
    $showordernum            = (int)$showordernum;
    $open_addservice         = (int)$open_addservice;
    $bind_print              = (int)$bind_print;
	$fencheng_foodprice      = (int)$fencheng_foodprice;
    $fencheng_delivery       = (int)$fencheng_delivery;
    $fencheng_dabao          = (int)$fencheng_dabao;
    $fencheng_addservice     = (int)$fencheng_addservice;
    $fencheng_discount       = (int)$fencheng_discount;
    $fencheng_promotion      = (int)$fencheng_promotion;
    $fencheng_firstdiscount  = (int)$fencheng_firstdiscount;
    $fencheng_offline        = (int)$fencheng_offline;
    $manager                 = $manager;
    $jointime                = GetMkTime(time());



    //不同距离不同外送费和起送价
    $range_delivery_fee_value = array();
    if($rangedeliveryfee){
        foreach ($rangedeliveryfee['start'] as $key => $value) {
            array_push($range_delivery_fee_value, array(
                $value, $rangedeliveryfee['stop'][$key], $rangedeliveryfee['value'][$key], $rangedeliveryfee['minvalue'][$key]
            ));
        }
    }
    $range_delivery_fee_value = serialize($range_delivery_fee_value);


    //预设选项

    //负数或者false表示第一个参数应该在前
    function sort_by($x, $y){
      return strcasecmp($x[1],$y[1]);
    }

    $preset = array();
    if($field){
        foreach ($field['name'] as $key => $value) {
            array_push($preset, array(
                $field['type'][$key], $field['sort'][$key], $value, $field['content'][$key]
            ));
        }
    }
    uasort($preset, 'sort_by');
    $preset = serialize($preset);


    //满减
    $promotionsArr = array();
    if($promotions){
        foreach ($promotions as $key => $value) {
            array_push($promotionsArr, array(
                (int)$value['amount'], (int)$value['discount']
            ));
        }
    }
    $promotions = serialize($promotionsArr);


    //增值服务
    $addserviceArr = array();
    if($addservice){
        foreach ($addservice as $key => $value) {
            array_push($addserviceArr, array(
                $value['name'], $value['start'], $value['stop'], $value['price']
            ));
        }
    }
    $addservice = serialize($addserviceArr);


    //自定义显示内容
    $selfdefineArr = array();
    if($selfdefine){
        foreach ($selfdefine['type'] as $key => $value) {
            array_push($selfdefineArr, array(
                $value, $selfdefine['name'][$key], $selfdefine['content'][$key]
            ));
        }
    }
    $selfdefine = serialize($selfdefineArr);


    //打印机
    $printArr = array();
    if($print_config){
        foreach ($print_config['partner'] as $key => $value) {
            array_push($printArr, array(
                "partner" => $value,
                "apikey"  => $print_config['apikey'][$key],
                "mcode"  => $print_config['mcode'][$key],
                "msign"  => $print_config['msign'][$key]
            ));
        }
    }
    $print_config = serialize($printArr);


    $service_area_data = array();
    $serviceAreaData = json_decode($_POST['service_area_data'], true);
    if($serviceAreaData){
        foreach ($serviceAreaData as $key => $value) {
            array_push($service_area_data, array(
                "peisong" => $value['peisong'],
                "qisong"  => $value['qisong'],
                "points"  => $value['points']
            ));
        }
    }
    $service_area_data = serialize($service_area_data);


    //店铺名称
    if(trim($shopname) == ""){
		echo '{"state": 200, "info": "请输入店铺名称"}';
		exit();
	}

    //店铺分类
    if(empty($typeid)){
        echo '{"state": 200, "info": "请选择店铺分类"}';
        exit();
    }else{

        $typeid = join(",", $typeid);
    }

    //验证店铺名称是否存在
    if($id){

        //先验证店铺是否存在
        $sql = $dsql->SetQuery("SELECT `id` FROM `#@__$dbname` WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "totalCount");
        if($ret <= 0){
            echo '{"state": 200, "info": "店铺不存在或已经删除！"}';
			exit();
        }

        $sql = $dsql->SetQuery("SELECT `id` FROM `#@__$dbname` WHERE `shopname` = '$shopname' AND `id` != '$id'");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			echo '{"state": 200, "info": "店铺名称已经存在！"}';
			exit();
		}

    }else{
        $sql = $dsql->SetQuery("SELECT `id` FROM `#@__$dbname` WHERE `shopname` = '$shopname'");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			echo '{"state": 200, "info": "店铺名称已经存在！"}';
			exit();
		}
    }


    //修改
    if($id){

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET
            `sort` = '$sort',
            `shopname` = '$shopname',
            `typeid` = '$typeid',
            `category` = '$category',
            `phone` = '$phone',
            `address` = '$address',
            `qq` = '$qq',
            `description` = '$description',
            `coordX` = '$coordX',
            `coordY` = '$coordY',
            `status` = '$status',
            `closeinfo` = '$closeinfo',
            `ordervalid` = '$ordervalid',
            `closeorder` = '$closeorder',
            `merchant_deliver` = '$merchant_deliver',
            `selftake` = '$selftake',
            `cancelorder` = '$cancelorder',
            `weeks` = '$weeks',
            `start_time1` = '$start_time1',
            `end_time1` = '$end_time1',
            `start_time2` = '$start_time2',
            `end_time2` = '$end_time2',
            `start_time3` = '$start_time3',
            `end_time3` = '$end_time3',
            `delivery_radius` = '$delivery_radius',
            `delivery_area` = '$delivery_area',
            `delivery_fee_mode` = '$delivery_fee_mode',
            `service_area_data` = '$service_area_data',
            `basicprice` = '$basicprice',
            `delivery_fee` = '$delivery_fee',
            `delivery_fee_type` = '$delivery_fee_type',
            `delivery_fee_value` = '$delivery_fee_value',
            `open_range_delivery_fee` = '$open_range_delivery_fee',
            `range_delivery_fee_value` = '$range_delivery_fee_value',
            `shop_notice` = '$shop_notice',
            `shop_notice_used` = '$shop_notice_used',
            `buy_notice` = '$buy_notice',
            `linktype` = '$linktype',
            `callshow` = '$callshow',
            `unitshow` = '$unitshow',
            `opencomment` = '$opencomment',
            `showtype` = '$showtype',
            `food_showtype` = '$food_showtype',
            `showsales` = '$showsales',
            `show_basicprice` = '$show_basicprice',
            `show_delivery` = '$show_delivery',
            `show_range` = '$show_range',
            `show_area` = '$show_area',
            `show_delivery_service` = '$show_delivery_service',
            `delivery_service` = '$delivery_service',
            `memo_hint` = '$memo_hint',
            `address_hint` = '$address_hint',
            `order_prefix` = '$order_prefix',
            `paytype` = '$paytype',
            `offline_limit` = '$offline_limit',
            `pay_offline_limit` = '$pay_offline_limit',
            `preset` = '$preset',
            `is_first_discount` = '$is_first_discount',
            `first_discount` = '$first_discount',
            `is_discount` = '$is_discount',
            `discount_value` = '$discount_value',
            `open_promotion` = '$open_promotion',
            `promotions` = '$promotions',
            `smsvalid` = '$smsvalid',
            `sms_phone` = '$sms_phone',
            `emailvalid` = '$emailvalid',
            `email_address` = '$email_address',
            `weixinvalid` = '$weixinvalid',
            `customerid` = '$customerid',
            `auto_printer` = '$auto_printer',
            `showordernum` = '$showordernum',
            `shop_banner` = '$shop_banner',
            `open_addservice` = '$open_addservice',
            `addservice` = '$addservice',
            `selfdefine` = '$selfdefine',
            `share_title` = '$share_title',
            `share_pic` = '$share_pic',
            `bind_print` = '$bind_print',
            `print_config` = '$print_config',
            `fencheng_foodprice` = '$fencheng_foodprice',
            `fencheng_delivery` = '$fencheng_delivery',
            `fencheng_dabao` = '$fencheng_dabao',
            `fencheng_addservice` = '$fencheng_addservice',
            `fencheng_discount` = '$fencheng_discount',
            `fencheng_promotion` = '$fencheng_promotion',
            `fencheng_firstdiscount` = '$fencheng_firstdiscount',
            `fencheng_offline` = '$fencheng_offline'
          WHERE `id` = $id
        ");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){

			echo '{"state": 100, "info": '.json_encode("保存成功！").'}';

            // 管理会员
            if(!empty($manager)){
                $pubdate = GetMkTime(time());
                // 先删除
                $sql = $dsql->SetQuery("DELETE FROM `#@__waimai_shop_manager` WHERE `shopid` = $id");
                $dsql->dsqlOper($sql, "update");
                $manager = array_unique(explode(",", $manager));
                foreach ($manager as $key => $value) {
                    if(is_numeric($value)){
                        $sql = $dsql->SetQuery("INSERT INTO `#@__waimai_shop_manager` (`userid`, `shopid`, `pubdate`) VALUES ('$value', '$id', '$pubdate')");
                        $dsql->dsqlOper($sql, "lastid");
                    }
                }
            }
		}else{
			echo '{"state": 200, "info": "数据更新失败，请检查填写的信息是否合法！"}';
		}
        die;


    //新增
    }else{

        //保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__$dbname` (
            `sort`,
            `shopname`,
            `typeid`,
            `category`,
            `phone`,
            `address`,
            `qq`,
            `description`,
            `coordX`,
            `coordY`,
            `status`,
            `closeinfo`,
            `ordervalid`,
            `closeorder`,
            `merchant_deliver`,
            `selftake`,
            `cancelorder`,
            `weeks`,
            `start_time1`,
            `end_time1`,
            `start_time2`,
            `end_time2`,
            `start_time3`,
            `end_time3`,
            `delivery_radius`,
            `delivery_area`,
            `delivery_fee_mode`,
            `service_area_data`,
            `basicprice`,
            `delivery_fee`,
            `delivery_fee_type`,
            `delivery_fee_value`,
            `open_range_delivery_fee`,
            `range_delivery_fee_value`,
            `shop_notice`,
            `shop_notice_used`,
            `buy_notice`,
            `linktype`,
            `callshow`,
            `unitshow`,
            `opencomment`,
            `showtype`,
            `food_showtype`,
            `showsales`,
            `show_basicprice`,
            `show_delivery`,
            `show_range`,
            `show_area`,
            `show_delivery_service`,
            `delivery_service`,
            `memo_hint`,
            `address_hint`,
            `order_prefix`,
            `paytype`,
            `offline_limit`,
            `pay_offline_limit`,
            `preset`,
            `is_first_discount`,
            `first_discount`,
            `is_discount`,
            `discount_value`,
            `open_promotion`,
            `promotions`,
            `smsvalid`,
            `sms_phone`,
            `emailvalid`,
            `email_address`,
            `weixinvalid`,
            `customerid`,
            `auto_printer`,
            `showordernum`,
            `shop_banner`,
            `open_addservice`,
            `addservice`,
            `selfdefine`,
            `share_title`,
            `share_pic`,
            `jointime`,
            `bind_print`,
            `print_config`,
            `fencheng_foodprice`,
            `fencheng_delivery`,
            `fencheng_dabao`,
            `fencheng_addservice`,
            `fencheng_discount`,
            `fencheng_promotion`,
            `fencheng_firstdiscount`,
            `fencheng_offline`
        ) VALUES (
            '$sort',
            '$shopname',
            '$typeid',
            '$category',
            '$phone',
            '$address',
            '$qq',
            '$description',
            '$coordX',
            '$coordY',
            '$status',
            '$closeinfo',
            '$ordervalid',
            '$closeorder',
            '$merchant_deliver',
            '$selftake',
            '$cancelorder',
            '$weeks',
            '$start_time1',
            '$end_time1',
            '$start_time2',
            '$end_time2',
            '$start_time3',
            '$end_time3',
            '$delivery_radius',
            '$delivery_area',
            '$delivery_fee_mode',
            '$service_area_data',
            '$basicprice',
            '$delivery_fee',
            '$delivery_fee_type',
            '$delivery_fee_value',
            '$open_range_delivery_fee',
            '$range_delivery_fee_value',
            '$shop_notice',
            '$shop_notice_used',
            '$buy_notice',
            '$linktype',
            '$callshow',
            '$unitshow',
            '$opencomment',
            '$showtype',
            '$food_showtype',
            '$showsales',
            '$show_basicprice',
            '$show_delivery',
            '$show_range',
            '$show_area',
            '$show_delivery_service',
            '$delivery_service',
            '$memo_hint',
            '$address_hint',
            '$order_prefix',
            '$paytype',
            '$offline_limit',
            '$pay_offline_limit',
            '$preset',
            '$is_first_discount',
            '$first_discount',
            '$is_discount',
            '$discount_value',
            '$open_promotion',
            '$promotions',
            '$smsvalid',
            '$sms_phone',
            '$emailvalid',
            '$email_address',
            '$weixinvalid',
            '$customerid',
            '$auto_printer',
            '$showordernum',
            '$shop_banner',
            '$open_addservice',
            '$addservice',
            '$selfdefine',
            '$share_title',
            '$share_pic',
            '$jointime',
            '$bind_print',
            '$print_config',
            '$fencheng_foodprice',
            '$fencheng_delivery',
            '$fencheng_dabao',
            '$fencheng_addservice',
            '$fencheng_discount',
            '$fencheng_promotion',
            '$fencheng_firstdiscount',
            '$fencheng_offline'
        )");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if($aid){
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';

            // 管理会员
            if(!empty($manager)){
                $manager = explode(",", $manager);
                foreach ($manager as $key => $value) {
                    if(is_numeric($value)){
                        $sql = $dsql->SetQuery("INSERT INTO `#@__waimai_shop_manager` (`userid`, `shopid`, `pubdate`) VALUES ('$value', '$aid', '$pubdate')");
                        $dsql->dsqlOper($sql, "lastid");
                    }
                }
            }
		}else{
			echo '{"state": 200, "info": "数据插入失败，请检查填写的信息是否合法！"}';
		}
		die;

    }

}


//验证模板文件
if(file_exists($tpl."/".$templates)){

    //css
	$cssFile = array(
		'admin/bootstrap1.css',
        'ui/jquery.chosen.css',
        'admin/chosen.min.css',
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
		'admin/waimai/waimaiShopAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));


    $huoniaoTag->assign('shop_banner', '[]');

    $typeArr = array();
    $sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_shop_type` ORDER BY `sort` DESC, `id` DESC");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        foreach ($ret as $key => $value) {
            $typeArr[$key]['id'] = $value['id'];
            $typeArr[$key]['title'] = $value['title'];
        }
    }
    $huoniaoTag->assign('typeArr', $typeArr);

    //获取信息内容
    if($id){
        $sql = $dsql->SetQuery("SELECT * FROM `#@__$dbname` WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "results");
        if($ret){

            foreach ($ret[0] as $key => $value) {

                //不同距离不同的外送费和起送价
                if($key == "range_delivery_fee_value"){
                    $value = unserialize($value);
                }

                //预设选项
                if($key == "preset"){
                    $value = unserialize($value);
                }

                //满减
                if($key == "promotions"){
                    $value = unserialize($value);
                }

                //增值服务
                if($key == "addservice"){
                    $value = unserialize($value);
                }

                //自定义显示内容
                if($key == "selfdefine"){
                    $value = unserialize($value);
                }

                //店铺图片
                if($key == "shop_banner"){
                    $value = !empty($value) ? json_encode(explode(",", $value)) : "[]";
                }

                //打印机
                if($key == "print_config"){
                    $value = unserialize($value);
                }

				//服务区域
                if($key == "service_area_data"){
                    $value = !empty($value) ? unserialize($value) : array();
                }

                //店铺分类
                if($key == "typeid"){
                    $value = explode(",", $value);
                }

                $huoniaoTag->assign($key, $value);
            }

            // 查询管理会员
            $sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_shop_manager` WHERE `shopid` = $id");
            $ret = $dsql->dsqlOper($sql, "results");
            $manager = array();
            if($ret){
                foreach ($ret as $key => $val ) {
                    array_push($manager, $val['userid']);
                }
            }
            $huoniaoTag->assign('manager', join(",", $manager));

        }else{
            showMsg("没有找到相关信息！", "-1");
            die;
        }
    }

	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
