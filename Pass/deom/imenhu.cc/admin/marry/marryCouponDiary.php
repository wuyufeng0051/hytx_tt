<?php
/**
 * 管理电子优惠券领取记录
 *
 * @version        $Id: marryCouponDiary.php 2014-8-4 下午18:08:15 $
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
if(empty($did)) die("信息ID传递失败，请检查！");

checkPurview("marry".$action."CouponDiary");

$tab = "marry_coupon_diary";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	//验证是否过期
	$dSql = $dsql->SetQuery("SELECT `end` FROM `#@__marry_coupon` WHERE `id` = ". $did);
	$results = $dsql->dsqlOper($dSql, "results");
	if($results){
		if(GetMkTime(time()) > $results[0]['end']){
			$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `state` = 2 WHERE `did` = ".$did);
			$results = $dsql->dsqlOper($archives, "update");
		}
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `action` = '".$action."' AND `cid` = ".$cid." AND `did` = ".$did);

	//总条数
	$totalCount = $dsql->dsqlOper($archives, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `did`, `people`, `contact`, `state`, `pubdate` FROM `#@__".$tab."` WHERE `action` = '".$action."' AND `cid` = ".$cid." AND `did` = ".$did.$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["people"] = $value["people"];
			$list[$key]["contact"] = $value["contact"];
			$list[$key]["state"] = $value["state"];
			$list[$key]["pubdate"] = date("Y-m-d H:i:s", $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "marryCouponDiary": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//删除
}elseif($dopost == "del"){
	if(!testPurview("marry".$action."CouponDiaryDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		//删除表
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` in (".$id.")");
		$results = $dsql->dsqlOper($archives, "update");

		adminLog("删除婚嫁电子优惠券领取记录", $id);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}
	die;
	
//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("marry".$action."CouponDiaryEdit")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `state` = ".$state." WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新婚嫁电子优惠券领取记录状态", $id."=>".$state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;
	
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	$templates = "marryCouponDiary.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/marry/marryCouponDiary.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
	require_once(HUONIAOINC."/config/marry.inc.php");
	
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('cid', $cid);
	$huoniaoTag->assign('did', $did);
	
	//公司信息
	$hotelSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__marry_".$action."` WHERE `id` = ". $cid);
	$hotelResult = $dsql->getTypeName($hotelSql);
	if(!$hotelResult)die('公司不存在！');
	$huoniaoTag->assign('cid', $hotelResult[0]['id']);
	$huoniaoTag->assign('cname', $hotelResult[0]['title']);
	
	//优惠券信息
	$hotelSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__marry_coupon` WHERE `id` = ". $did);
	$hotelResult = $dsql->getTypeName($hotelSql);
	if(!$hotelResult)die('优惠券不存在！');
	$huoniaoTag->assign('dname', $hotelResult[0]['title']);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/marry";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}