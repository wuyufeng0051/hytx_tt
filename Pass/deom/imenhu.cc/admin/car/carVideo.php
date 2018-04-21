<?php
/**
 * 汽车视频
 *
 * @version        $Id: carVideo.php 2014-8-29 下午16:29:11 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carVideo");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$pagetitle     = "汽车视频管理";

$tab    = "car_video";

if($dopost != ""){
	$templates = "carVideoAdd.html";
	
	//js
	$jsFile = array(
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/car/carVideoAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	
}else{
	$templates = "carVideo.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carVideo.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate       = GetMkTime(time());       //发布时间

	//表单二次验证
	if(empty($cid)){
		echo '{"state": 200, "info": "请选择车型"}';
		exit();
	}

	if(empty($typeid)){
		echo '{"state": 200, "info": "请选择视频分类"}';
		exit();
	}

	if(trim($title) == ''){
		echo '{"state": 200, "info": "标题不能为空"}';
		exit();
	}

	if(trim($litpic_) == ''){
		echo '{"state": 200, "info": "请上传视频缩略图"}';
		exit();
	}

	if($category == 0){
		$video = $litpic;
		if(trim($video) == ''){
			echo '{"state": 200, "info": "请上传视频"}';
			exit();
		}
	}else{
		$video = $videoUrl;
		if(trim($video) == ''){
			echo '{"state": 200, "info": "请输入视频地址"}';
			exit();
		}
	}
	
	//对字符进行处理
	$title = cn_substrR($title,60);
}

//列表
if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	if(!empty($sCid)){
		$where .= " AND `cid` = ".$sCid;
	}
	if($sType != ""){
		if($dsql->getTypeList($sType, "car_video_type")){
			$lower = arr_foreach($dsql->getTypeList($sType, "car_video_type"));
			$lower = $sType.",".join(',',$lower);
		}else{
			$lower = $sType;
		}
		$where .= " AND `typeid` in ($lower)";
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");
	
	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待审核
	$totalGray = $dsql->dsqlOper($archives.$where." AND `state` = 0".$where, "totalCount");
	//已审核
	$totalAudit = $dsql->dsqlOper($archives.$where." AND `state` = 1".$where, "totalCount");
	//拒绝审核
	$totalRefuse = $dsql->dsqlOper($archives.$where." AND `state` = 2".$where, "totalCount");
	
	if($state != ""){
		$where .= " AND `state` = $state";
	}
	
	$where .= " order by `pubdate` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `cid`, `title`, `typeid`, `litpic`, `click`, `state`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["typeid"] = $value["typeid"];

			$list[$key]["cid"] = $value["cid"];

			//车辆名称
			$carSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $value["cid"]);
			$carResult = $dsql->getTypeName($carSql);
			$list[$key]["cname"] = $carResult[0]["title"];
			
			//分类
			$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_video_type` WHERE `id` = ". $value["typeid"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["type"] = $typename[0]['typename'];
			
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["click"] = $value["click"];
			$list[$key]["state"] = $value["state"];			
			$list[$key]["date"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "carVideoList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//新增
}elseif($dopost == "Add"){
	
	$pagetitle = "新增汽车视频";
	
	//表单提交
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`cid`, `typeid`, `title`, `litpic`, `category`, `video`, `click`, `note`, `state`, `pubdate`) VALUES ('$cid', '$typeid', '$title', '$litpic_', '$category', '$video', '$click', '$note', '$state', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增汽车视频", $title);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	
	$pagetitle = "修改汽车视频";

	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `cid` = '$cid', `typeid` = '$typeid', `title` = '$title', `litpic` = '$litpic_', `category` = '$category', `video` = '$video', `click` = '$click', `note` = '$note', `state` = '$state' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车视频", $title);
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
				
				$cid      = $results[0]['cid'];
				$typeid   = $results[0]['typeid'];
				$title    = $results[0]['title'];
				$litpic   = $results[0]['litpic'];
				$category = $results[0]['category'];
				$video    = $results[0]['video'];
				$click    = $results[0]['click'];
				$note     = $results[0]['note'];
				$state    = $results[0]['state'];
				
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
	if($id == "") die;
	
	$each = explode(",", $id);
	$error = array();
	$title = array();
	foreach($each as $val){
		
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "results");
		
		array_push($title, $results[0]['title']);
		delPicFile($results[0]['litpic'], "delThumb", "car");
		if($results[0]['category'] == 0){
			delPicFile($results[0]['video'], "delVideo", "car");
		}
		
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
		adminLog("删除汽车视频", join(", ", $title));
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("carVideoEdit")){
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
			adminLog("更新视频状态", $id."=>".$state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;
}


//验证模板文件
if(file_exists($tpl."/".$templates)){
	global $cfg_videoSize;
	global $cfg_videoType;
	$huoniaoTag->assign('videoSize', $cfg_videoSize);
	$huoniaoTag->assign('videoType', "*.".str_replace("|", ";*.", $cfg_videoType));

	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);

	$huoniaoTag->assign('brandid', 0);
	$huoniaoTag->assign('brandName', "请选择品牌");
	$huoniaoTag->assign('cid', 0);
	$huoniaoTag->assign('cname', "请选择车系");

	if($dopost == "edit"){
		if($cid){
			//车辆名称
			$carSql = $dsql->SetQuery("SELECT `title`, `brand` FROM `#@__car_list` WHERE `id` = ". $cid);
			$carResult = $dsql->getTypeName($carSql);
			$huoniaoTag->assign('cname', $carResult[0]["title"]);
			$huoniaoTag->assign('brandid', $carResult[0]["brand"]);
			//品牌名称
			$brandSql = $dsql->SetQuery("SELECT `parentid`, `typename` FROM `#@__car_brand` WHERE `id` = ". $carResult[0]["brand"]);
			$brandResult = $dsql->getTypeName($brandSql);
			if($brandResult[0]["parentid"] != 0){
				$huoniaoTag->assign('brandid', $brandResult[0]["parentid"]);
				$brandSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_brand` WHERE `id` = ". $brandResult[0]["parentid"]);
				$brandResult = $dsql->getTypeName($brandSql);
				$huoniaoTag->assign('brandName', $brandResult[0]["typename"]);
			}else{
				$huoniaoTag->assign('brandName', $brandResult[0]["typename"]);
			}
		}
	}

	$huoniaoTag->assign('id', $id);
	$huoniaoTag->assign('cid', empty($cid) ? 0 : $cid);
	$huoniaoTag->assign('typeid', empty($typeid) ? 0 : $typeid);
	$huoniaoTag->assign('title', $title);
	$huoniaoTag->assign('litpic', $litpic);
	$huoniaoTag->assign('video', $video);
	$huoniaoTag->assign('click', $click);
	$huoniaoTag->assign('note', $note);
	
	//视频类型
	$huoniaoTag->assign('categoryList', array('0', '1'));
	$huoniaoTag->assign('categoryName',array('本地','外站调用'));
	$huoniaoTag->assign('category', $category == "" ? 0 : $category);

	//状态
	$huoniaoTag->assign('stateList', array('0', '1', '2'));
	$huoniaoTag->assign('stateName',array('待审核','已审核','拒绝审核'));
	$huoniaoTag->assign('state', $state == "" ? 1 : $state);

	$huoniaoTag->assign('pubdate', empty($pubdate) ? date("Y-m-d H:i:s",time()) : $pubdate);
	
	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, "car_video_type")));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}