<?php
/**
 * 家具品牌
 *
 * @version        $Id: furnitureBrand.php 2014-2-10 下午21:32:58 $
 * @package        HuoNiao.Furniture
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/furniture";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "furniture_brand";

checkPurview("furnitureBrand");

if($dopost != ""){
	$templates = "furnitureBrandAdd.html";

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/furniture/furnitureBrandAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "furnitureBrand.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/furniture/furnitureBrand.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

$pagetitle = "品牌管理";

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate     = GetMkTime(time());       //发布时间
}

//列表
if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	if($sType != ""){
		$where .= " AND `type` = $sType";
	}

	$where .= " order by `weight` desc, `pubdate` desc";

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `type`, `title`, `logo`, `weight`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["typeid"] = $value["type"];

			//分类
			$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__furniture_industry` WHERE `id` = ". $value["type"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["type"] = $typename[0]['typename'];

			$list[$key]["title"] = $value["title"];
			$list[$key]["logo"] = $value["logo"];
			$list[$key]["weight"] = $value["weight"];
			$list[$key]["pubdate"] = date("Y-m-d H:i:s", $value["pubdate"]);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "furnitureBrandList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
	}
	die;

//新增
}elseif($dopost == "Add"){

	$pagetitle     = "新增品牌";

	//表单提交
	if($submit == "提交"){

		//表单二次验证
		if(trim($typeid) == ''){
			echo '{"state": 200, "info": "请选择分类"}';
			exit();
		}

		if(trim($title) == ''){
			echo '{"state": 200, "info": "请填写品牌名称"}';
			exit();
		}

		if(trim($litpic) == ''){
			echo '{"state": 200, "info": "请上传品牌logo"}';
			exit();
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`type`, `title`, `logo`, `weight`, `pubdate`) VALUES ($typeid, '$title', '$litpic', $weight, $pubdate)");
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			adminLog("新增家具品牌", $title);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "Edit"){

	$pagetitle = "修改品牌";

	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){

		//表单二次验证
		if(trim($typeid) == ''){
			echo '{"state": 200, "info": "请选择分类"}';
			exit();
		}

		if(trim($title) == ''){
			echo '{"state": 200, "info": "请填写品牌名称"}';
			exit();
		}

		if(trim($litpic) == ''){
			echo '{"state": 200, "info": "请上传品牌logo"}';
			exit();
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `type` = $typeid, `title` = '$title', `logo` = '$litpic', `weight` = $weight WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			adminLog("修改家具品牌", $title);
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

				$type        = $results[0]['type'];
				$title       = $results[0]['title'];
				$logo        = $results[0]['logo'];
				$weight      = $results[0]['weight'];

			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}

		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}

}elseif($dopost == "del"){
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			delPicFile($results[0]['logo'], "delBrand", "furniture");

			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除家具品牌", $id);
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('typeListArr', json_encode(getTypeList(0, "furniture_industry")));

	if($dopost != ""){
		$huoniaoTag->assign('id', $id);
		$huoniaoTag->assign('typeid', (int)$type);
		$huoniaoTag->assign('title', $title);
		$huoniaoTag->assign('litpic', $logo);
		$huoniaoTag->assign('weight', $weight == "" ? 1 : $weight);
	}
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/furniture";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//获取分类列表
function getTypeList($id, $tab){
	global $dsql;
	$sql = $dsql->SetQuery("SELECT `id`, `parentid`, `typename` FROM `#@__".$tab."` WHERE `parentid` = $id ORDER BY `weight`");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		return $results;
	}else{
		return '';
	}
}
