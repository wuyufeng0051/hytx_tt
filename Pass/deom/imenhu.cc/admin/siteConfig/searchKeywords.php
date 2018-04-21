<?php
/**
 * 搜索关键词
 *
 * @version        $Id: searchKeywords.php 2015-02-09 上午11:05:15 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("searchKeywords");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/siteConfig";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$pagetitle     = "搜索关键词";

$tab = "site_search";

$templates = "searchKeywords.html";

//js
$jsFile = array(
	'ui/bootstrap.min.js',
	'admin/siteConfig/searchKeywords.js'
);
$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

//列表
if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if($sKeyword != ""){
		$where .= " AND `keyword` like '%$sKeyword%'";
	}

	if($sType != ""){
		$where .= " AND `module` = '$sType'";
	}
	
	if($orderby == "count"){
		$where .= " order by `count` desc";
	}else{
		$where .= " order by `id` desc";
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");
	
	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `module`, `keyword`, `count`, `lasttime` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"]       = $value["id"];

			$sql = $dsql->SetQuery("SELECT `title` FROM `#@__site_module` WHERE `name` = '".$value['module']."'");
			$results = $dsql->dsqlOper($sql, "results");
			if($results){
				$list[$key]["module"]   = $results[0]["title"];
			}else{
				$list[$key]["module"]   = $value["module"];
			}

			$list[$key]["keyword"]  = $value["keyword"];
			$list[$key]["count"]    = $value["count"];
			$list[$key]["lasttime"] = date('Y-m-d H:i:s', $value["lasttime"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "searchKeywords": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
	}
	die;
	
}elseif($dopost == "del"){
	if($id != ""){
		
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			
			array_push($title, $results[0]['module']." => ".$results[0]['keyword']);

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
			adminLog("删除搜索关键词", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
		
	}
	die;
}


//验证模板文件
if(file_exists($tpl."/".$templates)){
	$huoniaoTag->assign('pagetitle', $pagetitle);
	
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
			$i = 0;
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