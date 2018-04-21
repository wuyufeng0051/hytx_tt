<?php
/**
 * 外卖评论管理
 *
 * @version        $Id: waimaiReview.php 2014-10-55 上午10:55:21 $
 * @package        HuoNiao.Waimai
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("waimaiReview");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "waimai_review";

if($dopost != ""){
	$templates = "waimaiReviewAdd.html";
	
	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/waimai/waimaiReviewAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "waimaiReview.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/waimai/waimaiReview.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if($userid == 0 && trim($user) == ''){
		echo '{"state": 200, "info": "请选择管理会员"}';
		exit();
	}else{
		if($userid == 0){
			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` = '".$user."'");
			$userResult = $dsql->dsqlOper($userSql, "results");
			if(!$userResult){
				echo '{"state": 200, "info": "会员不存在，请重新选择"}';
				exit();
			}
			$userid = $userResult[0]['id'];
		}else{
			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `id` = ".$userid);
			$userResult = $dsql->dsqlOper($userSql, "results");
			if(!$userResult){
				echo '{"state": 200, "info": "会员不存在，请在联想列表中选择"}';
				exit();
			}
		}
	}

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

	if(trim($rating) == ""){
		echo '{"state": 200, "info": "请选择总体评论"}';
		exit();
	}
	
	if(empty($note)){
		echo '{"state": 200, "info": "请输入评论内容"}';
		exit();
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
				$where .= " AND `store` in (".join(",", $storeid).")";
			}else{
				$where .= " AND 1 = 2";
			}
		}else{
			$where .= " AND 1 = 2";
		}
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `pubdate` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `userid`, `store`, `rating`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			$list[$key]["userid"] = $value["userid"];
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value['userid']);
			$username = $dsql->getTypeName($userSql);
			if($username){
				$list[$key]["username"] = $username[0]["username"];
			}else{
				$list[$key]["username"] = '无';
			}

			$list[$key]["storeid"] = $value["store"];
			$storeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_store` WHERE `id` = ". $value['store']);
			$storename = $dsql->getTypeName($storeSql);
			$list[$key]["storename"] = $storename[0]["title"];
			
			$list[$key]["rating"] = $value["rating"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "waimaiReview": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("waimaiReviewAdd");

	$pagetitle = "添加新评论";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`userid`, `store`, `rating`, `note`, `pics`, `pubdate`) VALUES ('$userid', '$store', '$rating', '$note', '$pics', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("添加新评论", $userid ."=>". $store);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("waimaiReviewEdit");
	
	$pagetitle = "修改评论";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `userid` = '$userid', `store` = '$store', `rating` = '$rating', `note` = '$note', `pics` = '$pics' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改评论", $title);
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
				
				$userid = $results[0]['userid'];
				$store  = $results[0]['store'];
				$rating = $results[0]['rating'];
				$note   = $results[0]['note'];
				$pics   = $results[0]['pics'];
				
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
	if(!testPurview("waimaiReviewDel")){
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
			delPicFile($results[0]['pics'], "delAtlas", "waimai");

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
			adminLog("删除外卖评论");
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
	
	if($dopost != ""){

		if($dopost == "edit"){

			//会员信息
			$huoniaoTag->assign('userid', $userid);
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
			$username = $dsql->getTypeName($userSql);
			$huoniaoTag->assign('username', $username[0]['username']);

			//餐厅信息
			$huoniaoTag->assign('store', $store);
			$storeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_store` WHERE `id` = ". $store);
			$storeName = $dsql->getTypeName($storeSql);
			$huoniaoTag->assign('storeName', $storeName[0]['title']);

			$huoniaoTag->assign('id', $id);
			$huoniaoTag->assign('rating', $rating);
			$huoniaoTag->assign('note', $note);

		}

		$huoniaoTag->assign('imglist', json_encode(!empty($pics) ? explode(",", $pics) : array()));
	}
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/waimai";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}