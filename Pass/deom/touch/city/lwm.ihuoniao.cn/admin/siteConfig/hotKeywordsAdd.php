<?php
/**
 * 添加热门关键字
 *
 * @version        $Id: hotKeywordsAdd.php 2015-02-09 下午15:05:12 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("hotKeyword");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/siteConfig";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "hotKeywordsAdd.html";

$action     = "site_hotkeywords";
$pagetitle  = "新增热门关键字";

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	//表单二次验证
	if($module == ''){
		echo '{"state": 200, "info": "请选择所属模块"}';
		exit();
	}

	if($keyword == ''){
		echo '{"state": 200, "info": "请输入关键字"}';
		exit();
	}

	$pubdate = GetMkTime(time()); //发布时间
}

if($dopost == "edit"){

	$pagetitle = "修改热门关键字";
	if($submit == "提交"){
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `module` = '$module', `keyword` = '$keyword', `href` = '$href', `color` = '$color', `target` = '$target', `blod` = '$blod', `weight` = '$weight', `state` = '$state' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results != "ok"){
			echo '{"state": 200, "info": "修改失败！"}';
			exit();
		}

		adminLog("修改热门关键字", $keyword);
		echo '{"state": 100, "info": "修改成功！"}';
		exit();

	}else{
		if(!empty($id)){

			//主表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){

				$module  = $results[0]['module'];
				$keyword = $results[0]['keyword'];
				$href    = $results[0]['href'];
				$color   = $results[0]['color'];
				$target  = $results[0]['target'];
				$blod    = $results[0]['blod'];
				$weight  = $results[0]['weight'];
				$state   = $results[0]['state'];

			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}

		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}
}elseif($dopost == "" || $dopost == "save"){
	$dopost = "save";

	//表单提交
	if($submit == "提交"){
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$action."` (`module`, `keyword`, `href`, `color`, `target`, `blod`, `weight`, `state`, `pubdate`) VALUES ('$module', '$keyword', '$href', '$color', '$target', '$blod', '$weight', '$state', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			adminLog("新增热门关键字", $keyword);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/jquery.colorPicker.js',
		'admin/siteConfig/hotKeywordsAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('id', $id);

	//所属模块
	$sql = $dsql->SetQuery("SELECT `title`, `name` FROM `#@__site_module` WHERE `parentid` != 0 ORDER BY `weight`, `id`");
	$result = $dsql->dsqlOper($sql, "results");
	$moduleList = array("请选择");
	$moduleVal = array("0");
	if($result){
		array_push($moduleList, "首页");
		array_push($moduleVal, "index");
		foreach ($result as $key => $value) {
			array_push($moduleList, $value['title']);
			array_push($moduleVal, $value['name']);
			if($value['name'] == "article"){
				array_push($moduleList, "图片");
				array_push($moduleVal, "pic");
			}
		}
	}
	$huoniaoTag->assign('moduleList', $moduleList);
	$huoniaoTag->assign('moduleVal', $moduleVal);
	$huoniaoTag->assign('module', $module);

	$huoniaoTag->assign('keyword', $keyword);
	$huoniaoTag->assign('href', $href);
	$huoniaoTag->assign('color', $color);

	//打开方式
	$huoniaoTag->assign('targetopt', array('0', '1'));
	$huoniaoTag->assign('targetnames',array('新窗口','当前窗口'));
	$huoniaoTag->assign('target', $target == "" ? 0 : $target);

	//加粗
	$huoniaoTag->assign('blodopt', array('0', '1'));
	$huoniaoTag->assign('blodnames',array('不加粗','加粗'));
	$huoniaoTag->assign('blod', $blod == "" ? 0 : $blod);

	$huoniaoTag->assign('weight', $weight == "" ? "1" : $weight);

	//显示状态
	$huoniaoTag->assign('stateopt', array('0', '1'));
	$huoniaoTag->assign('statenames',array('显示','隐藏'));
	$huoniaoTag->assign('state', $state == "" ? 0 : $state);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/siteConfig";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
