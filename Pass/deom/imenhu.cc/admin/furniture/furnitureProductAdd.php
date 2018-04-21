<?php
/**
 * 添加家具商品
 *
 * @version        $Id: furnitureProductAdd.php 2014-3-1 下午23:59:19 $
 * @package        HuoNiao.Furniture
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/furniture";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "furnitureProductAdd.html";

$tab = "furniture_product";
$dopost = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改
if($dopost == "edit"){
	$pagetitle = "修改家具商品";
	checkPurview("furnitureProductEdit");
}else{
	$pagetitle = "添加家具商品";
	checkPurview("furnitureProductAdd");
}

if(empty($weight)) $weight = 1;
if(empty($state)) $state = 0;
if(empty($click)) $click = 0;

if($_POST['submit'] == "提交"){

	if($token == "") die('token传递失败！');
	//二次验证
	if(empty($title)){
		echo '{"state": 200, "info": "请输入商品名！"}';
		exit();
	}

	if($company == ""){
		echo '{"state": 200, "info": "请选择所属公司！"}';
		exit();
	}

	if(empty($type)){
		echo '{"state": 200, "info": "请选择商品分类！"}';
		exit();
	}

	if(empty($litpic)){
		echo '{"state": 200, "info": "请上传商品缩略图！"}';
		exit();
	}

	$mprice   = (float)$mprice;
	$price    = (float)$price;
	$click    = (int)$click;
	$weight   = (int)$weight;
	$inventory = (int)$inventory;
	$property = isset($property) ? join(',',$property) : '';
	$btime    = !empty($btime) ? GetMkTime($btime) : 0;
	$etime    = !empty($etime) ? GetMkTime($etime) : 0;

}

if($dopost == "save" && $submit == "提交"){
	//保存到表
	$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`title`, `company`, `type`, `brand`, `mprice`, `price`, `logistic`, `litpic`, `model`, `specifi`, `weight`, `click`, `inventory`, `state`, `property`, `btime`, `etime`, `pics`, `body`, `mbody`, `pubdate`) VALUES ('$title', '$company', '$type', '$brand', '$mprice', '$price', '$logistic', '$litpic', '$model', '$specifi', '$weight', '$click', '$inventory', '$state', '$property', '$btime', '$etime', '$imglist', '$body', '$mbody', '".GetMkTime(time())."')");
	$aid = $dsql->dsqlOper($archives, "lastid");

	if($aid){
		adminLog("添加家具商品", $title);

		$param = array(
			"service"  => "furniture",
			"template" => "detail",
			"id"       => $aid
		);
		$url = getUrlPath($param);

		echo '{"state": 100, "url": "'.$url.'"}';die;
	}else{
		echo '{"state": 200, "info": '.json_encode("保存到数据库失败！").'}';
	}
	die;
}elseif($dopost == "edit"){

	if($submit == "提交"){
		//保存到表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `company` = '$company', `type` = '$type', `brand` = '$brand', `mprice` = '$mprice', `price` = '$price', `logistic` = '$logistic', `litpic` = '$litpic', `model` = '$model', `specifi` = '$specifi', `weight` = '$weight', `click` = '$click', `inventory` = '$inventory', `state` = '$state', `property` = '$property', `btime` = '$btime', `etime` = '$etime', `pics` = '$imglist', `body` = '$body', `mbody` = '$mbody' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results == "ok"){
			adminLog("修改家具商品", $title);

			$param = array(
				"service"  => "furniture",
				"template" => "detail",
				"id"       => $_POST['id']
			);
			$url = getUrlPath($param);

			echo '{"state": 100, "info": "修改成功！", "url": "'.$url.'"}';die;
		}else{
			echo '{"state": 200, "info": '.json_encode('修改失败！').'}';
		}
		die;
	}

	if(!empty($id)){

		//主表信息
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if(!empty($results)){

			$title     = $results[0]['title'];
			$company   = $results[0]['company'];
			$type      = $results[0]['type'];
			$brand     = $results[0]['brand'];
			$mprice    = $results[0]['mprice'];
			$price     = $results[0]['price'];
			$logistic  = $results[0]['logistic'];
			$litpic    = $results[0]['litpic'];
			$model     = $results[0]['model'];
			$specifi   = $results[0]['specifi'];
			$weight    = $results[0]['weight'];
			$click     = $results[0]['click'];
			$inventory = $results[0]['inventory'];
			$state     = $results[0]['state'];
			$property  = $results[0]['property'];
			$btime     = $results[0]['btime'];
			$etime     = $results[0]['etime'];
			$pics      = $results[0]['pics'];
			$body      = $results[0]['body'];
			$mbody     = $results[0]['mbody'];

		}else{
			ShowMsg('要修改的信息不存在或已删除！', "-1");
			die;
		}

	}else{
		ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
		die;
	}

//获取品牌
}elseif($dopost == "getBrand"){
	if(!empty($id)){
		$typeSql = $dsql->SetQuery("SELECT `parentid` FROM `#@__furniture_industry` WHERE `id` = ".$id);
		$typeResult = $dsql->dsqlOper($typeSql, "results");
		if($typeResult){
			$brandSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__furniture_brand` WHERE `type` = ".$typeResult[0]['parentid']." ORDER BY `weight`");
			$brandResult = $dsql->dsqlOper($brandSql, "results");
			if(!$brandResult){
				echo 200;
			}else{
				echo json_encode($brandResult);
			}
		}
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap-datetimepicker.min.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		'publicUpload.js',
		'admin/furniture/furnitureProductAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('pagetitle', $pagetitle);
	require_once(HUONIAOINC."/config/furniture.inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_thumbSize;
		global $custom_thumbType;
		$huoniaoTag->assign('thumbSize', $custom_thumbSize);
		$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
		$huoniaoTag->assign('atlasSize', $custom_atlasSize);
		$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
	}
	$huoniaoTag->assign('id', $id);
	$huoniaoTag->assign('title', $title);

	//公司Array
	$companyList = array();
	array_push($companyList, '<option value="0">官方直营</option>');
	$archives = $dsql->SetQuery("SELECT `id`, `company` FROM `#@__furniture_store` ORDER BY `weight`");
	$results = $dsql->dsqlOper($archives, "results");
	if($results){
		foreach($results as $key => $val){
			$selected = "";
			if($val["id"] == $company){
				$selected = " selected";
			}
			array_push($companyList, '<option value="'.$val["id"].'"'.$selected.'>'.$val["company"].'</option>');
		}
	}
	$huoniaoTag->assign('companyList', join("", $companyList));

	//分类Array
	$typeOption = array();
	array_push($typeOption, '<option value="">请选择</option>');
	$archives = $dsql->SetQuery("SELECT * FROM `#@__furniture_industry` WHERE `parentid` = 0 ORDER BY `weight`");
	$results = $dsql->dsqlOper($archives, "results");
	if($results){
		foreach($results as $key => $val){
			$archives_ = $dsql->SetQuery("SELECT * FROM `#@__furniture_industry` WHERE `parentid` = ".$val['id']." ORDER BY `weight`");
			$results_ = $dsql->dsqlOper($archives_, "results");
			$typeitem = array();
			if($results_){
				foreach($results_ as $key_ => $val_){
					$selected = "";
					if($val_['id'] == $type){
						$selected = " selected";
					}
					array_push($typeitem, '<option value="'.$val_['id'].'"'.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;|--'.$val_['typename'].'</option>');
				}
				if(!empty($typeitem)){
					array_push($typeOption, '<optgroup label="|--'.$val["typename"].'"></optgroup>');
					array_push($typeOption, join("", $typeitem));
				}
			}
		}
	}
	$huoniaoTag->assign('typeOption', join("", $typeOption));

	//品牌
	$brandOption = array();
	if(!empty($type)){
		$typeSql = $dsql->SetQuery("SELECT `parentid` FROM `#@__furniture_industry` WHERE `id` = ".$type);
		$typeResult = $dsql->dsqlOper($typeSql, "results");
		if($typeResult){
			$brandSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__furniture_brand` WHERE `type` = ".$typeResult[0]['parentid']." ORDER BY `weight`");
			$brandResult = $dsql->dsqlOper($brandSql, "results");
			if($brandResult){
				array_push($brandOption, '<option value="0">请选择</option>');
				foreach($brandResult as $key => $val){
					$selected = "";
					if($val['id'] == $brand){
						$selected = "selected";
					}
					array_push($brandOption, '<option value="'.$val['id'].'"'.$selected.'>'.$val['title'].'</option>');
				}
			}
		}
	}else{
		array_push($brandOption, '<option value="0">请先选择分类</option>');
	}
	$huoniaoTag->assign('brandOption', join("", $brandOption));

	$huoniaoTag->assign('mprice', $mprice);
	$huoniaoTag->assign('price', $price);
	$huoniaoTag->assign('logistic', $logistic);
	$huoniaoTag->assign('litpic', $litpic);
	$huoniaoTag->assign('model', $model);
	$huoniaoTag->assign('specifi', $specifi);
	$huoniaoTag->assign('click', $click);
	$huoniaoTag->assign('weight', $weight);
	$huoniaoTag->assign('inventory', $inventory);

	//商品状态
	$huoniaoTag->assign('stateopt', array('0', '1', '2'));
	$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
	$huoniaoTag->assign('state', $state == "" ? 1 : $state);

	//商品属性
	$huoniaoTag->assign('propertylist', array('推荐', '促销', '新品', '热卖', '限时抢'));
	$huoniaoTag->assign('propertyval', array('r','c','n','h','q'));
	$huoniaoTag->assign('property', explode(",", $property));

	$huoniaoTag->assign('btime', !empty($btime) ? date("Y-m-d H:i:s", $btime) : "");
	$huoniaoTag->assign('etime', !empty($etime) ? date("Y-m-d H:i:s", $etime) : "");

	$huoniaoTag->assign('imglist', json_encode(!empty($pics) ? explode(",", $pics) : array()));

	$huoniaoTag->assign('body', $body);
	$huoniaoTag->assign('mbody', $mbody);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/furniture";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
