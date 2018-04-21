<?php
/**
 * 外卖相册管理
 *
 * @version        $Id: waimaiAlbum.php 2014-10-22 下午19:28:11 $
 * @package        HuoNiao.Waimai
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("waimaiAlbum");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "waimai_album";

if($dopost != ""){
	$templates = "waimaiAlbumAdd.html";

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/waimai/waimaiAlbumAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "waimaiAlbum.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/waimai/waimaiAlbum.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate = GetMkTime(time());       //发布时间

	//二次验证
	if($store == 0 && trim($storeName) == ''){
		echo '{"state": 200, "info": "请选择所属餐厅"}';
		exit();
	}else{
		if($store == 0){
			$storeSql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `title` = '".$storeName."'");
			$storeResult = $dsql->dsqlOper($storeSql, "results");
			if(!$storeResult){
				echo '{"state": 200, "info": "餐厅不存在，请重新选择"}';
				exit();
			}
			$store = $storeResult[0]['id'];
		}else{
			$storeSql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `id` = ".$store);
			$storeResult = $dsql->dsqlOper($storeSql, "results");
			if(!$storeResult){
				echo '{"state": 200, "info": "餐厅不存在，请在联想列表中选择"}';
				exit();
			}
		}
	}

	if(empty($typeid)){
		echo '{"state": 200, "info": "请选择所属分类"}';
		exit();
	}

	if($dopost == "Add"){
		if(empty($pics)){
			echo '{"state": 200, "info": "请上传图片！"}';
			exit();
		}
	}elseif($dopost == "edit"){
		if(trim($title) == ""){
			echo '{"state": 200, "info": "请输入图片名称"}';
			exit();
		}

		if(empty($litpic)){
			echo '{"state": 200, "info": "请上传图片！"}';
			exit();
		}
	}

}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$storeSql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `title` like '%$sKeyword%'");
		$storeResult = $dsql->dsqlOper($storeSql, "results");
		if($storeResult){
			$storeid = array();
			foreach($storeResult as $key => $store){
				array_push($storeid, $store['id']);
			}
			if(!empty($storeid)){
				$where .= " AND (`store` in (".join(",", $storeid).") OR `title` like '%$sKeyword%')";
			}else{
				$where .= " AND `title` like '%$sKeyword%'";
			}
		}else{
			$where .= " AND `title` like '%$sKeyword%'";
		}
	}

	if($sType != "" && $sType != 0){
		$where .= " AND `typeid` = $sType";
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	$where .= " order by `pubdate` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `store`, `typeid`, `title`, `path`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			$list[$key]["storeid"] = $value["storeid"];
			$storeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_store` WHERE `id` = ". $value['store']);
			$storename = $dsql->getTypeName($storeSql);
			$list[$key]["storename"] = $storename[0]["title"];

			$list[$key]["typeid"] = $value["typeid"];
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__waimai_album_type` WHERE `id` = ". $value["typeid"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$list[$key]["typeName"] = $itemResult[0]['typename'];

			$list[$key]["title"] = $value["title"];
			$list[$key]["path"] = $value["path"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"     => "waimai",
				"template"    => "shop",
				"id"          => $value['store']
			);
			$list[$key]['url'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "waimaiAlbum": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;

//新增
}elseif($dopost == "Add"){
	checkPurview("waimaiAlbumAdd");

	$pagetitle = "添加新相册";

	//表单提交
	if($submit == "提交"){

		//保存到主表
		$title = array();
		$pics = explode("###", $pics);
		foreach ($pics as $key => $pic) {
			$val = explode("||", $pic);
			$title[] = $val[1];
			$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`store`, `typeid`, `title`, `path`, `pubdate`) VALUES ('$store', '$typeid', '".$val[1]."', '".$val[0]."', '$pubdate')");
			$dsql->dsqlOper($archives, "results");
		}

		adminLog("添加新相册", $store ."=>". join(",", $title));
		echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("waimaiAlbumEdit");

	$pagetitle = "修改相册";

	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `store` = '$store', `typeid` = '$typeid', `title` = '$title', `path` = '$litpic' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			adminLog("修改相册", $store ."=>". $title);
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

				$store  = $results[0]['store'];
				$typeid = $results[0]['typeid'];
				$title  = $results[0]['title'];
				$path   = $results[0]['path'];

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
	if(!testPurview("waimaiAlbumDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			//删除图集
			array_push($title, $results[0]['store']."=>".$results[0]['title']);
			delPicFile($results[0]['path'], "delAtlas", "waimai");

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
			adminLog("删除相册", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;

	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	require_once(HUONIAOINC."/config/waimai.inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_atlasSize;
		global $custom_atlasType;
		$huoniaoTag->assign('atlasSize', $custom_atlasSize);
		$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
	}
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('typeid', (int)$typeid);

	if($dopost != ""){

		$huoniaoTag->assign('typeList', '<option value="0">请输入餐厅名称</option>');

		if($dopost == "edit"){

			$huoniaoTag->assign('id', $id);

			//餐厅信息
			$huoniaoTag->assign('store', $store);
			$storeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_store` WHERE `id` = ". $store);
			$storeName = $dsql->getTypeName($storeSql);
			$huoniaoTag->assign('storeName', $storeName[0]['title']);

			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('path', $path);

		}

	}

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/waimai";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
