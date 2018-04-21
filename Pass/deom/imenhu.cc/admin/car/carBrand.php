<?php
/**
 * 管理汽车品牌
 *
 * @version        $Id: carBrand.php 2014-8-20 下午22:22:18 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carBrand");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "carBrand.html";

$action = "car_brand";

//获取指定ID信息详情
if($dopost == "getTypeDetail"){
	if($id == "") die;
	$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	echo json_encode($results);die;
	
//修改分类
}else if($dopost == "updateType"){
	if($id == "") die;
	$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	
	if(!empty($results)){
		
		if($typename == "") die('{"state": 101, "info": '.json_encode('请输入品牌名').'}');
		if($type == "single"){
			
			if($results[0]['typename'] != $typename){
				
				//保存到主表
				$letter = getFirstCharter($typename);
				$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `typename` = '$typename', `letter` = '$letter' WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "update");
				
			}else{
				//分类没有变化
				echo '{"state": 101, "info": '.json_encode('无变化！').'}';
				die;
			}
			
		}else{
			//对字符进行处理
			$typename    = cn_substrR($typename,30);
			$letter = getFirstCharter($typename);
			
			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `letter` = '$letter', `typename` = '$typename', `logo` = '$logo', `brandStory` = '$brandStory', `logoStory` = '$logoStory' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");
		}
		
		if($results != "ok"){
			echo '{"state": 101, "info": '.json_encode('分类修改失败，请重试！').'}';
			exit();
		}else{
			adminLog("修改汽车品牌", $typename);
			echo '{"state": 100, "info": '.json_encode('修改成功！').'}';
			exit();
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode('要修改的信息不存在或已删除！').'}';
		die;
	}

//删除分类
}else if($dopost == "del"){

	if($id == "") die;

	$idsArr = array();
	$idexp = explode(",", $id);

	//获取所有子级
	foreach ($idexp as $k => $id) {		
		$childArr = $dsql->getTypeList($id, $action, 1);
		if(is_array($childArr)){
			$idsArr = array_merge($idsArr, array_reverse(parent_foreach($childArr, "id")));
		}
		$idsArr[] = $id;
	}

	//删除分类下的信息
	foreach ($idsArr as $kk => $id) {
		$archives = $dsql->SetQuery("SELECT `parentid`, `logo` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			if($results[0]['parentid'] == 0 && !empty($results[0]['logo'])){
				delPicFile($results[0]['logo'], "delbrandLogo", "car");
			}
		}		
	}

	$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` in (".join(",", $idsArr).")");
	$dsql->dsqlOper($archives, "update");
	
	adminLog("删除汽车品牌", join(",", $idsArr));
	die('{"state": 100, "info": '.json_encode('删除成功！').'}');

//更新
}else if($dopost == "typeAjax"){
	$data = str_replace("\\", '', $_POST['data']);
	if($data == "") die;
	$json = json_decode($data);
	
	$json = objtoarr($json);
	$json = brandTypeAjax($json, 0, $action);
	echo $json;	
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'ui/jquery-ui-sortable.js',
		'admin/car/carBrand.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('typeListArr', json_encode(getBrandTypeList(0, $action)));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//更新分类
function brandTypeAjax($json, $pid = 0, $tab){
	global $dsql;
	for($i = 0; $i < count($json); $i++){
		$id = $json[$i]["id"];
		$name = $json[$i]["name"];
		
		//如果ID为空则向数据库插入下级分类
		if($id == "" || $id == 0){
			$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`parentid`, `letter`, `typename`, `weight`, `pubdate`) VALUES ('$pid', '".getFirstCharter($name)."', '$name', '$i', '".GetMkTime(time())."')");
			$id = $dsql->dsqlOper($archives, "lastid");
			adminLog("添加汽车品牌", $model."=>".$name);
		}
		//其它为数据库已存在的分类需要验证分类名是否有改动，如果有改动则UPDATE
		else{
			$archives = $dsql->SetQuery("SELECT `typename`, `weight`, `parentid` FROM `#@__".$tab."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if(!empty($results)){
				//if($results[0]["parentid"] != 0){
					//验证分类名
					if($results[0]["typename"] != $name){
						$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `typename` = '$name', `letter` = '".getFirstCharter($name)."' WHERE `id` = ".$id);
						$results = $dsql->dsqlOper($archives, "update");
					}
					
					//验证排序
					if($results[0]["weight"] != $i){
						$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `weight` = '$i' WHERE `id` = ".$id);
						$results = $dsql->dsqlOper($archives, "update");
					}
					adminLog("修改汽车品牌", $model."=>".$id);
				//}
			}
		}
		if(is_array($json[$i]["lower"])){
			brandTypeAjax($json[$i]["lower"], $id, $tab);
		}
	}
	return '{"state": 100, "info": "保存成功！"}';
}

//获取分类列表
function getBrandTypeList($id, $tab){
	global $dsql;
	$sql = $dsql->SetQuery("SELECT `id`, `parentid`, `typename`, `logo` FROM `#@__".$tab."` WHERE `parentid` = $id ORDER BY `weight`");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){//如果有子类 
		foreach($results as $key => $value){
			$results[$key]["lower"] = getBrandTypeList($value['id'], $tab);
		}
		return $results; 
	}else{
		return "";
	}
}