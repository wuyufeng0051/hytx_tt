<?php
/**
 * 管理汽车经销商公司新闻
 *
 * @version        $Id: carDealerNews.php 2014-9-16 上午00:17:21 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carDealerNews");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_dealer_news";

if($dopost != ""){
	$templates = "carDealerNewsAdd.html";
	
	//js
	$jsFile = array(
		'admin/car/carDealerNewsAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carDealerNews.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carDealerNews.js'
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

	if(empty($title)){
		echo '{"state": 200, "info": "请输入公司新闻名称"}';
		exit();
	}
	
	if(empty($content)){
		echo '{"state": 200, "info": "请选择新闻内容"}';
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
	$archives = $dsql->SetQuery("SELECT `id`, `aid`, `title`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			//经销商
			$list[$key]["aid"] = $value["aid"];
			$aSql = $dsql->SetQuery("SELECT `subtitle` FROM `#@__car_dealer` WHERE `id` = ". $value["aid"]);
			$aResult = $dsql->getTypeName($aSql);
			$list[$key]["aName"] = $aResult[0]['subtitle'];
			
			$list[$key]["title"] = $value["title"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carDealerNews": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carDealerNewsAdd");

	$pagetitle = "新增经销商公司新闻";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`aid`, `title`, `content`, `pubdate`) VALUES ('$aid', '$title', '$content', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");
		
		if($aid){
			adminLog("新增汽车经销商公司新闻", $title);
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carDealerNewsEdit");
	
	$pagetitle = "修改汽车经销商公司新闻信息";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `aid` = '$aid', `title` = '$title', `content` = '$content' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车经销商公司新闻信息", $title);
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
				$content = $results[0]['content'];
				
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
	if(!testPurview("carDealerNewsDel")){
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
			adminLog("删除汽车经销商公司新闻", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
		
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
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
			
			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('content', $content);
		}
	}

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "car_addr")));
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}