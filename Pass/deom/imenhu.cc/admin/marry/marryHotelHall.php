<?php
/**
 * 管理酒店宴会厅
 *
 * @version        $Id: marryHotelHall.php 2014-8-1 上午09:49:21 $
 * @package        HuoNiao.Marry
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("marryHotelHall");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/marry";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
if(empty($hotelid)) die("酒店ID传递失败，请检查！");

$tab = "marry_hall";

if($dopost != ""){
	$templates = "marryHotelHallAdd.html";
	
	//js
	$jsFile = array(
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/marry/marryHotelHallAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "marryHotelHall.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/marry/marryHotelHall.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate     = GetMkTime(time());       //发布时间
	
	//二次验证
	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入宴会厅名称"}';
		exit();
	}
	if(trim($litpic) == ""){
		echo '{"state": 200, "info": "请上传宴会厅图片"}';
		exit();
	}
	if(trim($height) == ""){
		echo '{"state": 200, "info": "请输入宴会厅层高"}';
		exit();
	}
	if(trim($desk) == ""){
		echo '{"state": 200, "info": "请输入宴会厅可容纳桌子数量"}';
		exit();
	}
	
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `hotel` = ".$hotelid);

	//总条数
	$totalCount = $dsql->dsqlOper($archives, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `weight` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `litpic`, `height`, `desk`, `weight` FROM `#@__".$tab."` WHERE `hotel` = ".$hotelid.$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["height"] = $value["height"];
			$list[$key]["desk"] = $value["desk"];
			$list[$key]["weight"] = $value["weight"];
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "marryHotelHall": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){

	$pagetitle = "新增婚宴酒店";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`hotel`, `title`, `litpic`, `height`, `desk`, `area`, `shape`, `low`, `weight`, `note`) VALUES ('$hotelid', '$title', '$litpic', '$height', '$desk', '$area', '$shape', '$low', '$weight', '$note')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增婚宴酒店宴会厅", $title);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	
	$pagetitle = "修改婚宴酒店信息";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `litpic` = '$litpic', `height` = '$height', `desk` = '$desk', `area` = '$area', `shape` = '$shape', `low` = '$low', `weight` = '$weight', `note` = '$note' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改婚宴酒店宴会厅信息", $title);
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
				
				$title    = $results[0]['title'];
				$litpic   = $results[0]['litpic'];
				$height   = $results[0]['height'];
				$desk     = $results[0]['desk'];
				$area     = $results[0]['area'];
				$shape    = $results[0]['shape'];
				$low      = $results[0]['low'];
				$weight   = $results[0]['weight'];
				$note     = $results[0]['note'];
				
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
	if($id != ""){
		
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			
			//删除缩略图
			array_push($title, $results[0]['title']);
			delPicFile($results[0]['litpic'], "delThumb", "marry");
			
			//删除宴会厅表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除酒店宴会厅信息", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
		die;
		
	}
	die;
	
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	require_once(HUONIAOINC."/config/marry.inc.php");
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
	$huoniaoTag->assign('hoteid', $hoteid);
	
	if($dopost != ""){
		$huoniaoTag->assign('id', $id);
		$huoniaoTag->assign('title', $title);
		$huoniaoTag->assign('litpic', $litpic);
		$huoniaoTag->assign('height', $height);
		$huoniaoTag->assign('desk', $desk);
		$huoniaoTag->assign('area', $area);
		$huoniaoTag->assign('shape', $shape);
		$huoniaoTag->assign('low', $low);
		$huoniaoTag->assign('weight', $weight);
		$huoniaoTag->assign('note', $note);
	}
	
	//酒店信息
	$hotelSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__marry_hotel` WHERE `id` = ". $hotelid);
	$hotelResult = $dsql->getTypeName($hotelSql);
	if(!$hotelResult)die('酒店不存在！');
	$huoniaoTag->assign('hotelid', $hotelResult[0]['id']);
	$huoniaoTag->assign('hotelname', $hotelResult[0]['title']);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/marry";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}