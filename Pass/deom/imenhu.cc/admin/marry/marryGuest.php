<?php
/**
 * 婚嫁留言
 *
 * @version        $Id: marryGuest.php 2014-8-1 下午16:02:11 $
 * @package        HuoNiao.Marry
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("marryGuest");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/marry";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "marryGuest.html";

if(empty($action)) die("栏目标识传递失败！");

$tab = "marry_guest";

if($dopost == "getDetail"){
	if($id == "") die;
	$archives = $dsql->SetQuery("SELECT `aid`, `people`, `contact`, `qq`, `ip`, `ipaddr`, `content`, `reply`, `state`, `pubdate` FROM `#@__".$tab."` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	
	if(count($results) > 0){
		
		$archives = $dsql->SetQuery("SELECT `title` FROM `#@__marry_".$action."` WHERE `id` = ".$results[0]["aid"]);
		$dsqlInfo = $dsql->dsqlOper($archives, "results");
		
		$results[0]["aname"] = $dsqlInfo[0]["title"];

		echo json_encode($results);
		
	}else{
		echo '{"state": 200, "info": '.json_encode("信息获取失败！").'}';
	}
	die;
	
//更新评论信息
}else if($dopost == "updateDetail"){
	if($id == "") die;
	$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `content` = '$content', `reply` = '$reply', `state` = '$state', `rtime` = '".GetMkTime(time())."' WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "update");
	if($results != "ok"){
		echo $results;
	}else{
		adminLog("更新婚嫁留言", $action ."=>". $id);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}
	die;
	
//更新评论状态
}else if($dopost == "updateState"){
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `state` = $arcrank WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("更新婚嫁留言状态", $action."=>".$id."=>".$arcrank);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}
	die;
	
//删除评论
}else if($dopost == "delGuest"){
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("删除婚嫁留言", $action."=>".$id);
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
	}
	die;
	
//获取评论列表
}else if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = " AND `action` = '".$action."'";
	
	if($sKeyword != ""){
		$storeSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__marry_".$action."` WHERE `title` like '%$sKeyword%'");
		$storeResult = $dsql->dsqlOper($storeSql, "results");
		if($storeResult){
			$storeid = array();
			foreach($storeResult as $key => $store){
				array_push($storeid, $store['id']);
			}
			if(!empty($storeid)){
				$where .= " AND ((`people` like '%$sKeyword%' OR `contact` like '%$sKeyword%' OR `ip` like '%$sKeyword%') OR `aid` in (".join(",", $storeid)."))";
			}else{
				$where .= " AND `people` like '%$sKeyword%' OR `contact` like '%$sKeyword%' OR `ip` like '%$sKeyword%'";
			}
		}else{
			$where .= " AND `people` like '%$sKeyword%' OR `contact` like '%$sKeyword%' OR `ip` like '%$sKeyword%'";
		}
	}
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."`");
	
	//总条数
	$totalCount = $dsql->dsqlOper($archives." WHERE 1 = 1".$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待审核
	$totalGray = $dsql->dsqlOper($archives." WHERE `state` = 0".$where, "totalCount");
	//已审核
	$totalAudit = $dsql->dsqlOper($archives." WHERE `state` = 1".$where, "totalCount");
	//拒绝审核
	$totalRefuse = $dsql->dsqlOper($archives." WHERE `state` = 2".$where, "totalCount");
	
	if($state != ""){
		$where .= " AND `state` = $state";
	}
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `aid`, `people`, `contact`, `ip`, `ipaddr`, `state`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");
	
	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["aid"] = $value["aid"];
			
			$typeSql = $dsql->SetQuery("SELECT `title` FROM `#@__marry_".$action."` WHERE `id` = ". $value["aid"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["aname"] = $typename[0]['title'];
			
			$list[$key]["people"] = $value["people"];
			$list[$key]["contact"] = $value["contact"];
			$list[$key]["ip"] = $value["ip"];
			$list[$key]["people"] = $value["people"];
			$list[$key]["ipaddr"] = $value["ipaddr"];
			$list[$key]["state"] = $value["state"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "guestList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/marry/marryGuest.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/marry";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}