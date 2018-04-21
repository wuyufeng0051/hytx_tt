<?php
/**
 * 管理建材行业分类
 *
 * @version        $Id: buildIndustry.php 2014-2-28 下午13:40:21 $
 * @package        HuoNiao.Build
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("buildIndustry");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/build";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "buildIndustry.html";

$action = "build_industry";

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
		
		if($typename == "") die('{"state": 101, "info": '.json_encode('请输入行业分类名').'}');
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
			adminLog("修改建材行业分类", $typename);
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

		//删除行业品牌
		$archives = $dsql->SetQuery("SELECT `parentid` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if($results){

			//只有顶级才有品牌
			if($results[0]['parentid'] == 0){

				//查询此分类下的品牌
				$archives = $dsql->SetQuery("SELECT `id`, `logo` FROM `#@__build_brand` WHERE `type` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");
				
				//删除Logo
				if(count($results) > 0){
					foreach($results as $key => $val){	
						delPicFile($val['logo'], "delBrand", "build");
					}
				}

			}

		}

		$archives = $dsql->SetQuery("DELETE FROM `#@__build_brand` WHERE `type` = ".$id);
		$dsql->dsqlOper($archives, "update");
		
	}

	$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` in (".join(",", $idsArr).")");
	$dsql->dsqlOper($archives, "update");
	
	adminLog("删除建材行业分类", join(",", $idsArr));
	die('{"state": 100, "info": '.json_encode('删除成功！').'}');

//更新
}else if($dopost == "typeAjax"){
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
		'admin/build/buildIndustry.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, $action)));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/build";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}