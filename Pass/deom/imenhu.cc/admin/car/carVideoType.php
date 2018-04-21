<?php
/**
 * 汽车视频分类
 *
 * @version        $Id: carVideoType.php 2014-8-29 下午17:41:20 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carVideoType");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "carVideoType.html";

$action = "car_video_type";

//获取指定ID信息详情
if($dopost == "getTypeDetail"){
	if($id == "") die;
	$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	echo json_encode($results);die;
	
//修改分类
}else if($dopost == "updateType"){
	if(!testPurview("carVideoType")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	if($id == "") die;
	$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	
	if(!empty($results)){
		
		if($typename == "") die('{"state": 101, "info": '.json_encode('请输入分类名').'}');
		if($type == "single"){
			
			if($results[0]['typename'] != $typename){
				
				//保存到主表
				$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `typename` = '$typename' WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "update");
				
			}else{
				//分类没有变化
				echo '{"state": 101, "info": '.json_encode('无变化！').'}';
				die;
			}
			
		}else{
			//对字符进行处理
			$typename    = cn_substrR($typename,30);
			
			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `typename` = '$typename' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");
		}
		
		if($results != "ok"){
			echo '{"state": 101, "info": '.json_encode('分类修改失败，请重试！').'}';
			exit();
		}else{
			adminLog("修改汽车视频分类", $typename);
			echo '{"state": 100, "info": '.json_encode('修改成功！').'}';
			exit();
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode('要修改的信息不存在或已删除！').'}';
		die;
	}

//删除分类
}else if($dopost == "del"){
	if(!testPurview("carVideoType")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	if($id == "") die;
	$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	
	if(!empty($results)){
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `parentid` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		if(!empty($results)){
			echo '{"state": 200, "info": '.json_encode('该分类下含有子级分类，请先删除(或转移)子级内容！').'}';
			die;
		}else{
			
			//查询此分类下所有信息ID
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__car_video` WHERE `typeid` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			
			if(count($results) > 0){
				$idList = array();
				foreach($results as $key => $val){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__car_video` WHERE `id` = ".$val['id']);
					$results = $dsql->dsqlOper($archives, "results");
					
					delPicFile($results[0]['litpic'], "delThumb", "car");
					if($results[0]['category'] == 0){
						delPicFile($results[0]['video'], "delVideo", "car");
					}
					
					//删除表
					$archives = $dsql->SetQuery("DELETE FROM `#@__car_video` WHERE `id` = ".$val['id']);
					$dsql->dsqlOper($archives, "update");
				}
			}
			
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				echo '{"state": 200, "info": '.json_encode('删除失败，请重试！').'}';
				die;
			}
			
			adminLog("删除汽车视频分类", $id);
			echo '{"state": 100, "info": '.json_encode('删除成功！').'}';
			die;
		}
	}else{
		echo '{"state": 200, "info": '.json_encode('要删除的信息不存在或已删除！').'}';
		die;
	}

//更新信息分类
}else if($dopost == "typeAjax"){
	if(!testPurview("carVideoType")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	$data = str_replace("\\", '', $_POST['data']);
	if($data == "") die;
	$json = json_decode($data);
	
	$json = objtoarr($json);
	$json = typeAjax($json, 0, $action);
	echo $json;	
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'ui/jquery-ui-sortable.js',
		'admin/car/carVideoType.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, $action)));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}