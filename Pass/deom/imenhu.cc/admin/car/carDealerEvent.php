<?php
/**
 * 管理汽车经销商促销活动
 *
 * @version        $Id: carDealerEvent.php 2014-9-14 下午17:26:50 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carDealerEvent");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_dealer_event";

if($dopost != ""){
	$templates = "carDealerEventAdd.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap-datetimepicker.min.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/car/carDealerEventAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carDealerEvent.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carDealerEvent.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	if(!empty($property)) $property = join(",", $property);
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if(empty($aid)){
		echo '{"state": 200, "info": "请选择经销商"}';
		exit();
	}else{
		$dealerSql = $dsql->SetQuery("SELECT `id` FROM `#@__car_dealer` WHERE `id` = ".$aid);
		$dealerResult = $dsql->dsqlOper($dealerSql, "results");
		if(!$dealerResult){
			echo '{"state": 200, "info": "经销商不存在，请重新选择！"}';
			exit();
		}
	}

	if(empty($title)){
		echo '{"state": 200, "info": "请输入促销活动名称"}';
		exit();
	}
	
	if(empty($litpic)){
		echo '{"state": 200, "info": "请上传促销活动缩略图"}';
		exit();
	}
	
	if(empty($start)){
		echo '{"state": 200, "info": "请选择活动开始时间！"}';
		exit();
	}
	
	if(empty($end)){
		echo '{"state": 200, "info": "请选择活动结束时间！"}';
		exit();
	}
	
	if(empty($cid)){
		echo '{"state": 200, "info": "请选择活动车系"}';
		exit();
	}
	
	if(empty($pid)){
		echo '{"state": 200, "info": "请选择活动车型"}';
		exit();
	}

	$start = GetMkTime($start);
	$end   = GetMkTime($end);
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($aid)){
		$where .= " AND `aid` = ".$aid;
	}

	if(!empty($sKeyword)){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `pubdate` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `aid`, `cid`, `title`, `litpic`, `start`, `end`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];

			//经销商
			$list[$key]["aid"] = $value["aid"];
			$aSql = $dsql->SetQuery("SELECT `subtitle` FROM `#@__car_dealer` WHERE `id` = ". $value["aid"]);
			$aResult = $dsql->getTypeName($aSql);
			$list[$key]["aName"] = $aResult[0]['subtitle'];

			//车系名称
			$list[$key]["cid"] = $value["cid"];
			$cSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $value["cid"]);
			$cResult = $dsql->getTypeName($cSql);
			$list[$key]["cName"] = $cResult[0]['title'];
			
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["start"] = date("Y-m-d", $value["start"]);
			$list[$key]["end"] = date("Y-m-d", $value["end"]);
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carDealerEvent": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carDealerEventAdd");

	$pagetitle = "新增经销商促销活动";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`aid`, `cid`, `title`, `litpic`, `start`, `end`, `pid`, `note`, `content`, `property`, `pubdate`) VALUES ('$aid', '$cid', '$title', '$litpic', '$start', '$end', '$pid', '$note', '$content', '$property', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");
		
		if($aid){
			adminLog("新增汽车经销商促销活动", $title);
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carDealerEventEdit");
	
	$pagetitle = "修改汽车经销商促销活动信息";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `aid` = '$aid', `cid` = '$cid', `title` = '$title', `litpic` = '$litpic', `start` = '$start', `end` = '$end', `pid` = '$pid', `note` = '$note', `content` = '$content', `property` = '$property' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车经销商促销活动信息", $title);
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
				
				$aid     = $results[0]['aid']; 
				$title   = $results[0]['title']; 
				$litpic  = $results[0]['litpic']; 
				$start   = $results[0]['start']; 
				$end     = $results[0]['end']; 
				$cid     = $results[0]['cid'];  
				$pid     = $results[0]['pid']; 
				$note    = $results[0]['note']; 
				$content = $results[0]['content'];
				$property = $results[0]['property'];
				
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
	if(!testPurview("carDealerEventDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			array_push($title, $results[0]['title']);
			
			//删除缩略图
			delPicFile($results[0]['litpic'], "delThumb", "car");
			//删除内容图片
			$body = $results[0]['content'];
			if(!empty($body)){
				delEditorPic($body, "car");
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
			adminLog("删除汽车经销商促销活动", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
		
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	require_once(HUONIAOINC."/config/car.inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_thumbSize;
		global $custom_thumbType;
		$huoniaoTag->assign('thumbSize', $custom_thumbSize);
		$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
	}
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);

	$huoniaoTag->assign('aid', 0);
	$huoniaoTag->assign('aname', "请选择经销商");
	$huoniaoTag->assign('bid', 0);
	$huoniaoTag->assign('bname', "请选择品牌");
	$huoniaoTag->assign('cid', 0);
	$huoniaoTag->assign('cname', "请选择车系");
	
	if($dopost != ""){		
		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);

			//经销商
			$huoniaoTag->assign('aid', $aid);
			$aSql = $dsql->SetQuery("SELECT `subtitle` FROM `#@__car_dealer` WHERE `id` = ". $aid);
			$aResult = $dsql->getTypeName($aSql);
			$huoniaoTag->assign('aname', $aResult[0]["subtitle"]);

			//车辆名称
			$huoniaoTag->assign('cid', $cid);
			$carSql = $dsql->SetQuery("SELECT `title`, `brand` FROM `#@__car_list` WHERE `id` = ". $cid);
			$carResult = $dsql->getTypeName($carSql);
			$huoniaoTag->assign('cname', $carResult[0]["title"]);

			//品牌名称
			$huoniaoTag->assign('bid', $carResult[0]["brand"]);
			$brandSql = $dsql->SetQuery("SELECT `parentid`, `typename` FROM `#@__car_brand` WHERE `id` = ". $carResult[0]["brand"]);
			$brandResult = $dsql->getTypeName($brandSql);
			$huoniaoTag->assign('bname', $brandResult[0]["typename"]);

			
			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('litpic', $litpic);
			$huoniaoTag->assign('start', date("Y-m-d", $start));
			$huoniaoTag->assign('end', date("Y-m-d", $end));
			
			$huoniaoTag->assign('cid', $cid);
			$huoniaoTag->assign('pid', $pid);
			$huoniaoTag->assign('note', $note);
			$huoniaoTag->assign('content', $content);
		}

		//属性
		$huoniaoTag->assign('propertyVal',array('r'));
		$huoniaoTag->assign('propertyList',array('推荐'));
		$huoniaoTag->assign('property', !empty($property) ? explode(",", $property) : "");
	}

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "car_addr")));
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}