<?php
/**
 * 管理商家介绍
 *
 * @version        $Id: businessAbout.php 2017-03-24 下午15:38:25 $
 * @package        HuoNiao.Business
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("businessAbout");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/business";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "businessAbout.html";

$tab = "business";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$userSql = $dsql->SetQuery("SELECT m.`id` FROM `#@__member` m LEFT JOIN `#@__".$tab."_list` l ON l.`uid` = m.`id` WHERE m.`phone` like '%$sKeyword%' OR m.`company` like '%$sKeyword%' OR l.`title` like '%$sKeyword%'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where .= " AND `uid` in (".join(",", $userid).") OR `title` like '%$sKeyword%'";
			}
		}

		if(empty($userid)){
			$where .= " AND `title` like '%$sKeyword%'";
		}
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."_about` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	$where .= " order by `id` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `uid`, `title`, `weight`, `click`, `pubdate` FROM `#@__".$tab."_about` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			$list[$key]["uid"] = $value["uid"];
			$userSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__".$tab."_list` WHERE `uid` = ". $value['uid']);
			$username = $dsql->getTypeName($userSql);
			$list[$key]["store"] = $username[0]["title"];

			$list[$key]["title"] = $value["title"];
			$list[$key]["weight"] = $value["weight"];
			$list[$key]["click"] = $value["click"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"  => "business",
				"template" => "intro",
				"business" => $username[0]["id"],
				"id"       => $value['id']
			);
			$list[$key]['url'] = getUrlPath($param);

			$param = array(
				"service"  => "business",
				"template" => "detail",
				"business" => $username[0]["id"]
			);
			$list[$key]['storeUrl'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "businessAbout": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."_about` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			//删除缩略图
			array_push($title, $results[0]['title']);

			//删除内容图片
			$body = $results[0]['body'];
			if(!empty($body)){
				delEditorPic($body, "business");
			}

			//删除表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."_about` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除商家介绍信息", $id."：".join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
		die;

	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/business/businessAbout.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/business";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
