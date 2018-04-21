<?php
/**
 * 管理案例展示
 *
 * @version        $Id: marryCase.php 2014-8-4 下午17:23:11 $
 * @package        HuoNiao.Marry
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/marry";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
if(empty($action)) die("类型参数传递失败，请检查！");
if(empty($cid)) die("公司ID传递失败，请检查！");

checkPurview("marry".$action."Case");

$tab = "marry_case";

if($dopost != ""){
	$templates = "marryCaseAdd.html";
	
	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/marry/marryCaseAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "marryCase.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/marry/marryCase.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate     = GetMkTime(time());       //发布时间
	
	//二次验证
	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入作品名称"}';
		exit();
	}
	if(trim($litpic) == ""){
		echo '{"state": 200, "info": "请上传缩略图"}';
		exit();
	}
	if(trim($imglist) == ""){
		echo '{"state": 200, "info": "请上传作品照片"}';
		exit();
	}
	
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `action` = '".$action."' AND `cid` = ".$cid);

	//总条数
	$totalCount = $dsql->dsqlOper($archives, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `litpic`, `click`, `pics`, `pubdate` FROM `#@__".$tab."` WHERE `action` = '".$action."' AND `cid` = ".$cid.$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["litpic"] = $value["litpic"];
			
			$pics = explode(",", $value["pics"]);
			
			$list[$key]["count"] = count($pics);
			$list[$key]["click"] = $value["click"];
			$list[$key]["pubdate"] = date("Y-m-d H:i:s", $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "marryCase": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){

	$pagetitle = "新增案例展示";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`action`, `cid`, `title`, `litpic`, `pics`, `note`, `click`, `pubdate`) VALUES ('$action', '$cid', '$title', '$litpic', '$imglist', '$note', '$click', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增婚嫁案例展示", $title);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	
	$pagetitle = "修改案例展示信息";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `litpic` = '$litpic', `note` = '$note', `pics` = '$imglist', `click` = '$click' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改婚嫁案例展示", $title);
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
				$note     = $results[0]['note'];
				$pics     = $results[0]['pics'];
				$click    = $results[0]['click'];
				
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
			
			//删除照片集
			delPicFile($results[0]['pics'], "delAtlas", "marry");
			
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
			adminLog("删除婚嫁案例展示", join(", ", $title));
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
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('cid', $cid);
	
	if($dopost != ""){
		$huoniaoTag->assign('id', $id);
		$huoniaoTag->assign('title', $title);
		$huoniaoTag->assign('litpic', $litpic);
		$huoniaoTag->assign('note', $note);
		$huoniaoTag->assign('imglist', json_encode(!empty($pics) ? explode(",", $pics) : array()));
		$huoniaoTag->assign('click', $click);
	}
	
	//公司信息
	$hotelSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__marry_".$action."` WHERE `id` = ". $cid);
	$hotelResult = $dsql->getTypeName($hotelSql);
	if(!$hotelResult)die('公司不存在！');
	$huoniaoTag->assign('cid', $hotelResult[0]['id']);
	$huoniaoTag->assign('cname', $hotelResult[0]['title']);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/marry";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}