<?php
/**
 * 汽车车辆管理
 *
 * @version        $Id: carList.php 2014-8-21 下午16:45:21 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carList");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_list";

if($dopost != ""){
	$templates = "carAdd.html";
	
	//js
	$jsFile = array(
		'ui/jquery.colorPicker.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/car/carAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carList.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$displacement = isset($displacement) ? ",".join(',',$displacement)."," : '';
	$gearbox = isset($gearbox) ? ",".join(',',$gearbox)."," : '';
	$else = isset($else) ? ",".join(',',$else)."," : '';
	if(!empty($property)) $property = join(",", $property);
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入车辆名称"}';
		exit();
	}

	if(trim($subtitle) == ""){
		echo '{"state": 200, "info": "请输入简称"}';
		exit();
	}
	
	if(empty($brand)){
		echo '{"state": 200, "info": "请选择所属品牌"}';
		exit();
	}
	
	if(empty($typeid)){
		echo '{"state": 200, "info": "请选择所属级别"}';
		exit();
	}
	
	if(empty($litpic)){
		echo '{"state": 200, "info": "请上传缩略图"}';
		exit();
	}
	
	if(empty($guide)){
		echo '{"state": 200, "info": "请输入官方指导价"}';
		exit();
	}
	
	if(empty($carbody)){
		echo '{"state": 200, "info": "请选择车身级别"}';
		exit();
	}
	
	if(empty($country)){
		echo '{"state": 200, "info": "请选择所属国别"}';
		exit();
	}
	
	if(empty($warranty)){
		echo '{"state": 200, "info": "请输入保修信息"}';
		exit();
	}
	
	if(empty($driver)){
		echo '{"state": 200, "info": "请选择驱动类别"}';
		exit();
	}
	
	if(empty($fuel)){
		echo '{"state": 200, "info": "请选择燃料类型"}';
		exit();
	}
	
	if(empty($color)){
		echo '{"state": 200, "info": "请上传车身颜色"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	
	if($sType != ""){
		$where .= " AND `typeid` = ".$sType;
	}
	
	if($brand != ""){
		if($dsql->getTypeList($brand, "car_brand")){
			$lower = arr_foreach($dsql->getTypeList($brand, "car_brand"));
			$lower = $brand.",".join(',',$lower);
		}else{
			$lower = $brand;
		}
		$where .= " AND `brand` in ($lower)";
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待审核
	$totalGray = $dsql->dsqlOper($archives." AND `state` = 0".$where, "totalCount");
	//已审核
	$totalAudit = $dsql->dsqlOper($archives." AND `state` = 1".$where, "totalCount");
	//拒绝审核
	$totalRefuse = $dsql->dsqlOper($archives." AND `state` = 2".$where, "totalCount");
	
	if($state != ""){
		$where .= " AND `state` = $state";
	}
	
	$where .= " order by `weight` desc, `pubdate` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `brand`, `typeid`, `litpic`, `minprice`, `maxprice`, `state` , `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["brand"] = $value["brand"];

			//遍历品牌名称，输出格式：分类名 > 分类名
			global $data;
			$data = "";
			$brandType = getParentArr("car_brand", $value["brand"]);
			$brandType = array_reverse(parent_foreach($brandType, "typename"));
			$list[$key]["brandName"] = join(" > ", $brandType);
			
			$list[$key]["typeid"] = $value["typeid"];
			//级别
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_item` WHERE `id` = ". $value["typeid"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$list[$key]["typeName"] = $itemResult[0]['typename'];
			
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["guide"] = $value["minprice"]."万-".$value["maxprice"]."万";
			$list[$key]["state"] = $value["state"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "carList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carAdd");

	$pagetitle = "添加新车型";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`title`, `subtitle`, `brand`, `typeid`, `litpic`, `guide`, `carbody`, `country`, `displacement`, `gearbox`, `warranty`, `driver`, `fuel`, `else`, `color`, `weight`, `state`, `property`, `pubdate`) VALUES ('$title', '$subtitle', '$brand', '$typeid', '$litpic', '$guide', '$carbody', '$country', '$displacement', '$gearbox', '$warranty', '$driver', '$fuel', '$else', '$color', '$weight', '$state', '$property', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");
		
		if($aid){		
			adminLog("添加新车型", $title);
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carEdit");
	
	$pagetitle = "修改车型";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `subtitle` = '$subtitle', `brand` = '$brand', `typeid` = '$typeid', `litpic` = '$litpic', `guide` = '$guide', `carbody` = '$carbody', `country` = '$country', `displacement` = '$displacement', `gearbox` = '$gearbox', `warranty` = '$warranty', `driver` = '$driver', `fuel` = '$fuel', `else` = '$else', `color` = '$color', `weight` = '$weight', `state` = '$state', `property` = '$property' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改车型", $title);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}else{
			echo $return;
		}
		die;
		
	}else{
		if(!empty($id)){
			
			//主表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			
			if(!empty($results)){
				
				$title        = $results[0]['title'];
				$subtitle     = $results[0]['subtitle'];
				$brand        = $results[0]['brand'];
				$typeid       = $results[0]['typeid'];				
				$litpic       = $results[0]['litpic'];
				$guide        = $results[0]['guide'];
				$carbody      = $results[0]['carbody'];
				$country      = $results[0]['country'];
				$displacement = $results[0]['displacement'];
				$gearbox      = $results[0]['gearbox'];
				$warranty     = $results[0]['warranty'];
				$driver       = $results[0]['driver'];
				$fuel         = $results[0]['fuel'];
				$else         = $results[0]['else'];
				$color        = $results[0]['color'];
				$weight       = $results[0]['weight'];
				$state        = $results[0]['state'];
				$property     = $results[0]['property'];
				
			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}
			
		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}
	
//删除
}elseif($dopost == "del"){
	if(!testPurview("carDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			
			//删除缩略图
			array_push($title, $results[0]['title']);
			delPicFile($results[0]['litpic'], "delThumb", "car");
			
			//删除车身颜色
			$color = $results[0]['color'];
			if(!empty($color)){
				$color = explode("###", $color);
				foreach ($color as $key => $value) {
					$col = explode("||", $value);
					if(!empty($col[0])){
						delPicFile($col[0], "delThumb", "car");
					}
				}
			}

			//删除配置
			$archives = $dsql->SetQuery("SELECT * FROM `#@__car_param` WHERE `cid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach ($results as $key => $value) {
					$pid = $value['id'];

					//删除图片
					$archives = $dsql->SetQuery("SELECT * FROM `#@__car_pic` WHERE `pid` = ".$pid);
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						foreach ($results as $key => $value) {
							delPicFile($value['pic'], "delAtlas", "car");
						}
					}
					$archives = $dsql->SetQuery("DELETE FROM `#@__car_pic` WHERE `pid` = ".$pid);
					$dsql->dsqlOper($archives, "update");

					//删除口碑
					$archives = $dsql->SetQuery("SELECT * FROM `#@__car_koubei` WHERE `pid` = ".$pid);
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						foreach ($results as $key => $value) {
							delPicFile($value['pics'], "delAtlas", "car");
						}
					}
					$archives = $dsql->SetQuery("DELETE FROM `#@__car_koubei` WHERE `pid` = ".$pid);
					$dsql->dsqlOper($archives, "update");

					//删除油耗
					$archives = $dsql->SetQuery("DELETE FROM `#@__car_youhao` WHERE `pid` = ".$pid);
					$dsql->dsqlOper($archives, "update");

					//删除保养
					$archives = $dsql->SetQuery("DELETE FROM `#@__car_baoyang` WHERE `pid` = ".$pid);
					$dsql->dsqlOper($archives, "update");
				}
			}
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_param` WHERE `cid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除车型", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
		
	}
	die;
	
//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("carListEdit")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `state` = ".$state." WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新车型状态", $id."=>".$state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	require_once(HUONIAOINC."/config/car.inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_thumbSize;
		global $custom_thumbType;
		global $custom_atlasSize;
		global $custom_atlasType;
		$huoniaoTag->assign('thumbSize', $custom_thumbSize);
		$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
		$huoniaoTag->assign('atlasSize', $custom_atlasSize);
		$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
	}
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('basehost', $cfg_basehost);

	$huoniaoTag->assign('brandid', 0);
	$huoniaoTag->assign('brandName', "请选择一级品牌");
	$huoniaoTag->assign('subid', 0);
	$huoniaoTag->assign('subname', "请选择二级品牌");

	$typeList = array();
	$typeSql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__car_item` WHERE `parentid` = 1 ORDER BY `weight` ASC");
	$typeResult = $dsql->getTypeName($typeSql);
	if($typeResult){
		foreach($typeResult as $value){
			$typeList[$value['id']] = $value['typename'];
		}
	}
	$huoniaoTag->assign('typeList', $typeList);
	
	if($dopost != ""){

		$huoniaoTag->assign('colorList', '[]');

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);
			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('subtitle', $subtitle);
			$huoniaoTag->assign('litpic', $litpic);
			$huoniaoTag->assign('guide', $guide);
			$huoniaoTag->assign('warranty', $warranty);
			$huoniaoTag->assign('else', $else);
			$huoniaoTag->assign('color', $color);
			$huoniaoTag->assign('weight', $weight);
			$huoniaoTag->assign('state', $state);
		
			//品牌
			$huoniaoTag->assign('brand', $brand == "" ? 0 : $brand);

			$archives = $dsql->SetQuery("SELECT `id`, `parentid`, `typename` FROM `#@__car_brand` WHERE `id` = ".$brand);
			$results = $dsql->dsqlOper($archives, "results");
			if($results[0]['parentid'] != 0){
				$huoniaoTag->assign('subid', $brand);
				$huoniaoTag->assign('subname', $results[0]['typename']);

				$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__car_brand` WHERE `id` = ".$results[0]['parentid']);
				$results = $dsql->dsqlOper($archives, "results");
				$huoniaoTag->assign('brandid', $results[0]['id']);
				$huoniaoTag->assign('brandName', $results[0]['typename']);
			}else{
				$huoniaoTag->assign('brandid', $brand);
				$huoniaoTag->assign('brandName', $results[0]['typename']);
				$huoniaoTag->assign('subid', $brand);
				$huoniaoTag->assign('subname', $results[0]['typename']);
			}	

			if(!empty($color)){
				$colorArr = array();
				$color = explode("###", $color);
				foreach ($color as $key => $value) {
					$val = explode("||", $value);
					$colorArr[$key] = $val;
				}
				$huoniaoTag->assign('colorList', json_encode($colorArr));
			}

		}	

		//级别
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 1 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('typeList', $list);
		$huoniaoTag->assign('typeid', $typeid == "" ? 0 : $typeid);

		//车身类别
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 2 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('carbodyList', $list);
		$huoniaoTag->assign('carbody', $carbody == "" ? 0 : $carbody);

		//国别
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 3 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('countryList', $list);
		$huoniaoTag->assign('country', $country == "" ? 0 : $country);

		//变速箱
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 4 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = $val = array();
		foreach($results as $value){
			$list[] = $value['typename'];
			$val[] = $value['id'];
		}
		$huoniaoTag->assign('gearboxList', $list);
		$huoniaoTag->assign('gearboxValue', $val);
		$huoniaoTag->assign('gearbox', $gearbox == "" ? 0 : explode(",", $gearbox));

		//排量
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 5 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = $val = array();
		foreach($results as $value){
			$list[] = $value['typename'];
			$val[] = $value['id'];
		}
		$huoniaoTag->assign('displacementList', $list);
		$huoniaoTag->assign('displacementValue', $val);
		$huoniaoTag->assign('displacement', $displacement == "" ? 0 : explode(",", $displacement));

		//驱动
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 6 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('driverList', $list);
		$huoniaoTag->assign('driver', $driver == "" ? 0 : $driver);

		//燃料
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 7 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('fuelList', $list);
		$huoniaoTag->assign('fuel', $fuel == "" ? 0 : $fuel);

		//其它参数
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 8 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = $val = array();
		foreach($results as $value){
			$list[] = $value['typename'];
			$val[] = $value['id'];
		}
		$huoniaoTag->assign('elseList', $list);
		$huoniaoTag->assign('elseValue', $val);
		$huoniaoTag->assign('else', $else == "" ? 0 : explode(",", $else));

		
		$huoniaoTag->assign('weight', !empty($weight) ? $weight : 1);
		
		//显示状态
		$huoniaoTag->assign('stateopt', array('0', '1', '2'));
		$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
		$huoniaoTag->assign('state', $state == "" ? 1 : $state);
		
		//属性
		$huoniaoTag->assign('propertyVal',array('r','h','n'));
		$huoniaoTag->assign('propertyList',array('推荐','热门','新车'));
		$huoniaoTag->assign('property', !empty($property) ? explode(",", $property) : "");
	}
	$huoniaoTag->assign('brandTypeList', json_encode($dsql->getTypeList(0, "car_brand")));
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}