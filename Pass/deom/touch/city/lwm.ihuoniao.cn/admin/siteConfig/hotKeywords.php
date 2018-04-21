<?php
/**
 * 管理热门关键字
 *
 * @version        $Id: hotKeywords.php 2015-2-9 下午14:23:18 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("hotKeywords");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/siteConfig";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "hotKeywords.html";

$action = "site_hotkeywords";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	if($sKeyword != ""){
		$where .= " AND `keyword` like '%$sKeyword%'";
	}

	if($sType != ""){
		$where .= " AND `module` = '$sType'";
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	$where .= " order by `weight` desc, `pubdate` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `module`, `keyword`, `color`, `href`, `blod`, `weight`, `state` FROM `#@__".$action."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			$sql = $dsql->SetQuery("SELECT `title` FROM `#@__site_module` WHERE `name` = '".$value['module']."'");
			$results = $dsql->dsqlOper($sql, "results");
			if($results){
				$list[$key]["module"]   = $results[0]["title"];
			}else{
				$list[$key]["module"]   = $value["module"] == "index" ? "首页" : $value['module'];
			}

			$list[$key]["keyword"] = $value["keyword"];
			$list[$key]["color"] = $value["color"];
			$list[$key]["href"] = !empty($value["href"]) ? $value["href"] : "站内链接";
			$list[$key]["blod"] = $value["blod"];
			$list[$key]["weight"] = $value["weight"];
			$list[$key]["state"] = $value["state"];
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "keywordsList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除热门关键字", $id);
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/siteConfig/hotKeywords.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->assign('moduleList', getModuleList());
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/siteConfig";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//获取模块数据
function getModuleList(){
	global $dsql;
	$sql = $dsql->SetQuery("SELECT `title`, `name` FROM `#@__site_module` WHERE `parentid` != 0 ORDER BY `weight`, `id`");
	try{
		$result = $dsql->dsqlOper($sql, "results");

		if($result){//如果有子类

			$results[0] = array(
				"title" => "首页",
				"name"  => "index"
			);

			$i = 1;
			foreach($result as $key => $value){
				$results[$i]["title"] = $value['title'];
				$results[$i]["name"] = $value['name'];

				if($value['name'] == "article"){
					$i++;
					$results[$i]["title"] = "图片";
					$results[$i]["name"] = "pic";
				}

				$i++;
			}
			return $results;
		}else{
			return "";
		}

	}catch(Exception $e){
		//die("模块数据获取失败！");
	}
}
