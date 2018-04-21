<?php
/**
 * 频道模块管理
 *
 * @version        $Id: moduleList.php 2013-12-20 下午14:49:03 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("moduleList");
$dsql = new dsql($dbo);
$tpl  = dirname(__FILE__)."/../templates/siteConfig";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "moduleList.html";

//跳转到一下页的JS
$gotojs = "\r\nfunction GotoNextPage(){
    document.gonext."."submit();
}"."\r\nset"."Timeout('GotoNextPage()',500);";

$dojs = "<script language='javascript'>$gotojs\r\n</script>";

$action = "site_module";
$dopost = $_REQUEST['dopost'] ? $_REQUEST['dopost'] : "";

//获取指定ID信息说明
if($dopost == "getNote"){
	$id = $_POST['id'];
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT `note` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		echo json_encode($results);die;
	}
	die;

//获取指定ID信息详情
}else if($dopost == "getDetail"){
	$id = $_POST['id'];
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT `parentid`, `title`, `name`, `icon`, `state`, `weight` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		echo json_encode($results);
	}
	die;

//修改模块基本信息
}else if($dopost == "updateModule"){
	if(!testPurview("modifyMoudule")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	};
	$id = $_REQUEST['id'];

	if($id != ""){
		$title       = $_POST['title'];
		$icon        = $_POST['icon'];
		$parentid    = (int)$_POST['parentid'];
		$state       = (int)$_POST['state'];
		$weight      = (int)$_POST['weight'];

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `title` = '$title', `icon` = '$icon', `parentid` = '$parentid', `state` = '$state', `weight` = '$weight' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results != "ok"){
			echo '{"state": 101, "info": '.json_encode('修改失败，请重试！').'}';
			exit();
		}else{

			adminLog("修改".$title."模块信息", $title);

			echo '{"state": 100, "info": '.json_encode('修改成功！').'}';
			exit();
		}
	}
	die;

//停用
}else if($dopost == "disable"){
	if(!testPurview("modifyMoudule")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	};
	$id = $_POST['id'];
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT `title` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		$title = $results[0]['title'];

		$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `state` = 1 WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			adminLog("停用网站模块！", $title);
			die('{"state": 100, "info": '.json_encode('操作成功！').'}');
		}else{
			die('{"state": 200, "info": '.json_encode('操作失败！').'}');
		}
	}
	die;

//启用
}else if($dopost == "enable"){
	if(!testPurview("modifyMoudule")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	};
	$id = $_POST['id'];
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT `title` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		$title = $results[0]['title'];

		$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `state` = 0 WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			adminLog("启用网站模块！", $title);
			die('{"state": 100, "info": '.json_encode('操作成功！').'}');
		}else{
			die('{"state": 200, "info": '.json_encode('操作失败！').'}');
		}
	}
	die;

//删除目录
}else if($dopost == "del"){
	if(!testPurview("uninstallMoudule")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	};
	$id = $_POST['id'];
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if(!empty($results)){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `parentid` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if(!empty($results)){
				die('{"state": 200, "info": '.json_encode('该目录下含有已安装模块<br />请先卸载(或转移至其它目录下)！').'}');
			}else{
				$title = $results[0]['title'];
				$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "update");
				if($results != "ok"){
					die('{"state": 200, "info": '.json_encode('删除失败，请重试！').'}');
				}
				adminLog("删除模块目录", $title);
				die('{"state": 100, "info": '.json_encode('删除成功！').'}');
			}
		}else{
			die('{"state": 200, "info": '.json_encode('要删除的目录不存在或已删除！').'}');
		}
	}
	die;

//更新信息分类
}else if($dopost == "typeAjax"){
	if(!testPurview("modifyMoudule")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	};
	if($_POST['data'] != ""){
		$json = json_decode($_POST['data']);

		$json = objtoarr($json);
		$json = moduleOpera($json, 0, $action);
		echo $json;
	}
	die;

//卸载
}else if($dopost == "uninstall"){
	checkPurview("uninstallMoudule");
	$id = $_GET['id'];
	$startpos = (int)$_POST['startpos'];
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		if(!empty($results)){
			$title    = $results[0]['title'];
			$name     = $results[0]['name'];
			$icon     = $results[0]['icon'];
			$filelist = $results[0]['filelist'];
			$filelist = explode("\r\n",$filelist);
			$delsql   = $results[0]['delsql'];
			$delsql   = explode("\r\n",$delsql);

			$tmsg = "";
			$pos  = 0;
			if($startpos == 0){
				$tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 0%;'>0%</div></div>\r\n";
				$tmsg .= "<font color='green'>正在执行卸载程序，请稍候...</font>\r\n";
				$pos  = 1;
			}elseif($startpos == 1){

				//删除相关文件
				@unlink(HUONIAOROOT.$icon);
				foreach($filelist as $v){
					if(!is_dir($v)){
						@unlink($v);
					}else{
						deldir($v);
					}
				}

				$tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 50%;'>50%</div></div>\r\n";
				$tmsg .= "<font color='green'>模块文件删除成功，继续卸载数据库文件...</font>\r\n";
				$pos  = 2;
			}elseif($startpos == 2){

				//执行数据表删除语句
				foreach($delsql as $v){
					$archives = $dsql->SetQuery($v);
					$dsql->dsqlOper($archives, "update");
				}

				$tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 100%;'>100%</div></div>\r\n";
				$tmsg .= "<font color='green'>数据库信息删除成功，继续卸载配置文件...</font>\r\n";
				$pos  = 3;
			}else{

				//删除模块配置表
				$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");

				//删除域名配置
				$archives = $dsql->SetQuery("DELETE FROM `#@__domain` WHERE `module` = '$name'");
				$dsql->dsqlOper($archives, "update");

				//删除附件表相关信息
				$archives = $dsql->SetQuery("DELETE FROM `#@__attachment` WHERE `path` like '/$name/%'");
				$dsql->dsqlOper($archives, "update");

				//删除广告相关信息
				$archives = $dsql->SetQuery("DELETE FROM `#@__advtype` WHERE `model` = '$name'");
				$dsql->dsqlOper($archives, "update");
				$archives = $dsql->SetQuery("DELETE FROM `#@__advlist` WHERE `model` = '$name'");
				$dsql->dsqlOper($archives, "update");

				adminLog("卸载网站模块", $title);
				ShowMsg($title.'模块卸载完成！', '../index.php?gotopage=siteConfig/moduleList.php');
				exit();
			}

			$doneForm  = "<form name='gonext' method='post' action='moduleList.php?dopost=uninstall&id=$id'>\r\n";
			$doneForm .= "  <input type='hidden' name='startpos' value='".$pos."' />\r\n</form>\r\n{$dojs}";
			PutInfo($tmsg, $doneForm);
			exit();

		}
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'ui/jquery-ui-sortable.js',
		'admin/siteConfig/moduleList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('cfg_defaultindex', $cfg_defaultindex);
	$huoniaoTag->assign('moduleList', json_encode(getModuleList(0, $action)));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/siteConfig";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//获取模块数据
function getModuleList($id=0, $tab){
	global $dsql;
	$sql = $dsql->SetQuery("SELECT `id`, `parentid`, `icon`, `title`, `name`, `state`, `weight`, `version` FROM `#@__".$tab."` WHERE `parentid` = $id ORDER BY `weight`, `id`");
	try{
		$result = $dsql->dsqlOper($sql, "results");

		if($result){//如果有子类
			foreach($result as $key => $value){

				$results[$key]["id"] = $value['id'];
				$results[$key]["parentid"] = $value['parentid'];
				$results[$key]["title"] = $value['title'];

				if($results[$key]["parentid"] != 0){
					$results[$key]["icon"] = $value['icon'];
					$results[$key]["name"] = $value['name'];
					$results[$key]["state"] = $value['state'];
					$results[$key]["version"] = $value['version'];
				}

				$results[$key]["lower"] = getModuleList($value['id'], $tab);
			}
			return $results;
		}else{
			return "";
		}

	}catch(Exception $e){
		die("模块数据获取失败！");
	}
}

//模块操作
function moduleOpera($arr, $pid = 0, $dopost){
	global $dsql;

	if (!is_array($arr) && $arr != NULL) {
		return '{"state": 200, "info": "保存失败！"}';
	}
	for($i = 0; $i < count($arr); $i++){
		$id = $arr[$i]["id"];
		$name = $arr[$i]["name"];

		//如果ID为空则向数据库插入下级分类
		if($id == "" || $id == 0){
			$archives = $dsql->SetQuery("INSERT INTO `#@__".$dopost."` (`parentid`, `title`, `weight`, `date`) VALUES ('$pid', '$name', '$i', '".GetMkTime(time())."')");
			$id = $dsql->dsqlOper($archives, "lastid");

			adminLog("添加模块分类", $name);
		}
		//其它为数据库已存在的分类需要验证分类名是否有改动，如果有改动则UPDATE
		else{
			$archives = $dsql->SetQuery("SELECT `parentid`, `title`, `weight` FROM `#@__".$dopost."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				if($results[0]["parentid"] == 0){
					//验证分类名
					if($results[0]["title"] != $name){
						$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."` SET `title` = '$name' WHERE `id` = ".$id);
						$dsql->dsqlOper($archives, "update");

						adminLog("修改模块分类名", $dopost."=>".$name);
					}
				}

				//验证排序
				if($results[0]["weight"] != $i){
					$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."` SET `weight` = '$i' WHERE `id` = ".$id);
					$results = $dsql->dsqlOper($archives, "update");

					adminLog("修改模块分类排序", $dopost."=>".$name."=>".$i);
				}
			}
		}
		if(is_array($arr[$i]["lower"])){
			moduleOpera($arr[$i]["lower"], $id, $dopost);
		}
	}
	return '{"state": 100, "info": "保存成功！"}';
}

function PutInfo($msg1,$msg2){
	$htmlhead  = "<html>\r\n<head>\r\n<title>温馨提示</title>\r\n";
	$htmlhead .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$GLOBALS['cfg_soft_lang']."\" />\r\n";
	$htmlhead .= "<link rel='stylesheet' rel='stylesheet' href='".HUONIAOADMIN."/../static/css/admin/bootstrap.css?v=4' />";
	$htmlhead .= "<link rel='stylesheet' rel='stylesheet' href='".HUONIAOADMIN."/../static/css/admin/common.css?v=1111' />";
    $htmlhead .= "<base target='_self'/>\r\n</head>\r\n<body>\r\n";
    $htmlfoot  = "</body>\r\n</html>";
	$rmsg  = "<div class='s-tip'><div class='s-tip-head'><h1>".$GLOBALS['cfg_soft_enname']." 提示：</h1></div>\r\n";
    $rmsg .= "<div class='s-tip-body'>".str_replace("\"","“",$msg1)."\r\n".$msg2."\r\n";
    $msginfo = $htmlhead.$rmsg.$htmlfoot;
    echo $msginfo;
}
