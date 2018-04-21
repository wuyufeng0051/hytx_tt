<?php
/**
 * 房产问答分类
 *
 * @version        $Id: houseFaqType.php 2016-11-26 下午13:20:10 $
 * @package        HuoNiao.House
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("houseFaqType");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/house";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "houseFaqType.html";

$action = "house_faq";

//获取指定ID信息详情
if($dopost == "getTypeDetail"){
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."type` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		echo json_encode($results);
	}
	die;

//修改分类
}else if($dopost == "updateType"){
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."type` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if(!empty($results)){

			if($typename == "") die('{"state": 101, "info": '.json_encode('请输入分类名').'}');
			if($type == "single"){

				if($results[0]['typename'] != $typename){

					//保存到主表
					$archives = $dsql->SetQuery("UPDATE `#@__".$action."type` SET `typename` = '$typename' WHERE `id` = ".$id);
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
				$archives = $dsql->SetQuery("UPDATE `#@__".$action."type` SET `typename` = '$typename' WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "update");
			}

			if($results != "ok"){
				echo '{"state": 101, "info": '.json_encode('分类修改失败，请重试！').'}';
				exit();
			}else{
				adminLog("修改房产问答分类", $typename);
				echo '{"state": 100, "info": '.json_encode('修改成功！').'}';
				exit();
			}

		}else{
			echo '{"state": 101, "info": '.json_encode('要修改的信息不存在或已删除！').'}';
			die;
		}
	}
	die;

//删除分类
}else if($dopost == "del"){

	if($id != ""){

		$idsArr = array();
		$idexp = explode(",", $id);

		//获取所有子级
		foreach ($idexp as $k => $id) {
			$childArr = $dsql->getTypeList($id, $action."addr", 1);
			if(is_array($childArr)){
				$idsArr = array_merge($idsArr, array_reverse(parent_foreach($childArr, "id")));
			}
			$idsArr[] = $id;
		}

		//删除分类下的信息
		foreach ($idsArr as $key => $id) {

				$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `typeid` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");
				foreach($results as $val){

					//删除缩略图
					delPicFile($val['litpic'], "delThumb", "house");

					//删除内容图片
					$body = $val['body'];
					if(!empty($body)){
						delEditorPic($body, "house");
					}
				}

		}


		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `typeid` in (".join(",", $idsArr).")");
		$dsql->dsqlOper($archives, "update");

		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."type` WHERE `id` in (".join(",", $idsArr).")");
		$dsql->dsqlOper($archives, "update");

		adminLog("删除房产问答分类", $id);
		echo '{"state": 100, "info": '.json_encode('删除成功！').'}';
		die;


	}
	die;

//更新信息分类
}else if($dopost == "typeAjax"){
	$data = str_replace("\\", '', $_POST['data']);
	if($data != ""){
		$json = json_decode($data);

		$json = objtoarr($json);
		$json = typeAjax($json, 0, $action."type");
		echo $json;
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'ui/jquery-ui-sortable.js',
		'admin/house/houseFaqType.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, $action."type")));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/house";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
