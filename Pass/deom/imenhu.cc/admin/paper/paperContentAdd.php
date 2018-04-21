<?php
/**
 * 添加报刊内容
 *
 * @version        $Id: paperContentAdd.php 2014-3-16 上午00:53:17 $
 * @package        HuoNiao.Paper
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/paper";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "paperContentAdd.html";

if(empty($forum)) die('版面不存在！');

$tab = "paper_content";

$archives = $dsql->SetQuery("SELECT `id`, `litpic` FROM `#@__paper_forum` WHERE `id` = ".$forum);
$companyReturns = $dsql->dsqlOper($archives, "results");
if(!$companyReturns) die('版面不存在或已删除，请确认后重试！');

$dopost = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改
if($dopost == "edit"){
	$pagetitle = "修改报刊内容";
	checkPurview("paperContentEdit");
}else{
	$pagetitle = "添加报刊内容";
	checkPurview("paperContentAdd");
}

if(empty($weight)) $weight = 1;
if(empty($state)) $state = 0;

if($_POST['submit'] == "提交"){
	
	if($token == "") die('token传递失败！');
	//二次验证
	if(empty($title)){
		echo '{"state": 200, "info": "请输入内容标题！"}';
		exit();
	}
	
	if(empty($body)){
		echo '{"state": 200, "info": "请输入内容！"}';
		exit();
	}
	
	if(empty($width) || empty($height)){
		echo '{"state": 200, "info": "请选择内容区域！"}';
		exit();
	}
	
	$coor = $xAxis.",".$yAxis.",".$width.",".$height;
}

if($dopost == "save" && $submit == "提交"){
	//保存到表
	$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`forum`, `title`, `author`, `from`, `coor`, `body`, `weight`, `state`, `pubdate`) VALUES ('$forum', '$title', '$author', '$from', '$coor', '$body', '$weight', '$state', '".GetMkTime(time())."')");
	$aid = $dsql->dsqlOper($archives, "lastid");
	
	if($aid){
		adminLog("添加报刊内容", $title);
		echo '{"state": 100, "id": "'.$aid.'"}';
	}else{
		echo '{"state": 200, "info": '.json_encode("保存到数据库失败！").'}';
	}
	die;
}elseif($dopost == "edit"){
	
	if($submit == "提交"){
		//保存到表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `author` = '$author', `from` = '$from', `coor` = '$coor', `body` = '$body', `weight` = '$weight', `state` = '$state' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");
		
		if($results == "ok"){
			adminLog("修改报刊内容", $title);
			echo '{"state": 100, "info": '.json_encode('修改成功！').'}';
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
			
			$forum     = $results[0]['forum'];
			$title     = $results[0]['title'];
			$author    = $results[0]['author'];
			$from      = $results[0]['from'];
			$coor      = $results[0]['coor'];
			$body      = $results[0]['body'];
			$weight    = $results[0]['weight'];
			$state     = $results[0]['state'];
			
		}else{
			ShowMsg('要修改的信息不存在或已删除！', "-1");
			die;
		}
		
	}else{
		ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
		die;
	}
	
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'ui/jquery.Jcrop.js',
		'admin/paper/paperContentAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('forum', $forum);
	$huoniaoTag->assign('id', $id);

	$huoniaoTag->assign('title', $title);
	$huoniaoTag->assign('author', $author);
	$huoniaoTag->assign('from', $from);
	
	$huoniaoTag->assign('litpic', str_replace("large", "o_large", $companyReturns[0]['litpic']));
	
	$xAxis = $yAxis = $width = $height = 0;
	if(!empty($coor)){
		$coor = explode(",", $coor);
		$xAxis = $coor[0];
		$yAxis = $coor[1];
		$width = $coor[2];
		$height = $coor[3];
	}
	
	$huoniaoTag->assign('xAxis', $xAxis);
	$huoniaoTag->assign('yAxis', $yAxis);
	$huoniaoTag->assign('width', $width);
	$huoniaoTag->assign('height', $height);
	$huoniaoTag->assign('body', $body);
	
	$huoniaoTag->assign('weight', $weight == "" ? "1" : $weight);
	
	//显示状态
	$huoniaoTag->assign('stateopt', array('0', '1', '2'));
	$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
	$huoniaoTag->assign('state', $state == "" ? 1 : $state);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/paper";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}