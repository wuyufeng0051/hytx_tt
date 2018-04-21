<?php
/**
 * 管理汽车经销商顾问
 *
 * @version        $Id: carDealerAdvisor.php 2014-9-14 下午18:32:13 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carDealerAdvisor");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_dealer_advisor";

if($dopost != ""){
	$templates = "carDealerAdvisorAdd.html";
	
	//js
	$jsFile = array(
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/car/carDealerAdvisorAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carDealerAdvisor.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carDealerAdvisor.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
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

	if(empty($name)){
		echo '{"state": 200, "info": "请输入顾问名称"}';
		exit();
	}
	
	if(empty($litpic)){
		echo '{"state": 200, "info": "请上传顾问头像"}';
		exit();
	}
	
	if(empty($duty)){
		echo '{"state": 200, "info": "请输入顾问职务"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($aid)){
		$where .= " AND `aid` = ".$aid;
	}

	if(!empty($sKeyword)){
		$where .= " AND `name` like '%$sKeyword%'";
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `pubdate` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `aid`, `name`, `litpic`, `duty`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["name"] = $value["name"];

			//经销商
			$list[$key]["aid"] = $value["aid"];
			$aSql = $dsql->SetQuery("SELECT `subtitle` FROM `#@__car_dealer` WHERE `id` = ". $value["aid"]);
			$aResult = $dsql->getTypeName($aSql);
			$list[$key]["aName"] = $aResult[0]['subtitle'];
			
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["duty"] = $value["duty"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carDealerAdvisor": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carDealerAdvisorAdd");

	$pagetitle = "新增经销商顾问";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`aid`, `name`, `litpic`, `duty`, `pubdate`) VALUES ('$aid', '$name', '$litpic', '$duty', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");
		
		if($aid){
			adminLog("新增汽车经销商顾问", $name);
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carDealerAdvisorEdit");
	
	$pagetitle = "修改汽车经销商顾问信息";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `aid` = '$aid', `name` = '$name', `litpic` = '$litpic', `duty` = '$duty' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车经销商顾问信息", $name);
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
				$name    = $results[0]['name']; 
				$litpic  = $results[0]['litpic']; 
				$duty    = $results[0]['duty'];
				
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
	if(!testPurview("carDealerAdvisorDel")){
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
			delPicFile($results[0]['litpic'], "delPhoto", "car");
			
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
			adminLog("删除汽车经销商顾问", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
		
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	global $cfg_photoSize;
	global $cfg_photoType;
	$huoniaoTag->assign('photoSize', $cfg_photoSize);
	$huoniaoTag->assign('photoType', "*.".str_replace("|", ";*.", $cfg_photoType));

	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);

	$huoniaoTag->assign('aid', 0);
	$huoniaoTag->assign('aname', "请选择经销商");
	
	if($dopost != ""){		
		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);

			//经销商
			$huoniaoTag->assign('aid', $aid);
			$aSql = $dsql->SetQuery("SELECT `subtitle` FROM `#@__car_dealer` WHERE `id` = ". $aid);
			$aResult = $dsql->getTypeName($aSql);
			$huoniaoTag->assign('aname', $aResult[0]["subtitle"]);
			
			$huoniaoTag->assign('name', $name);
			$huoniaoTag->assign('litpic', $litpic);
			$huoniaoTag->assign('duty', $duty);
		}
	}

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "car_addr")));

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}