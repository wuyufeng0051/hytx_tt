<?php
/**
 * 汽车口碑管理
 *
 * @version        $Id: carKoubei.php 2014-8-30 上午11:54:21 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carKoubei");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_koubei";

if($dopost != ""){
	$templates = "carKoubeiAdd.html";
	
	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/car/carKoubeiAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carKoubei.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carKoubei.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if(empty($pid)){
		echo '{"state": 200, "info": "请选择车型"}';
		exit();
	}
	
	if(empty($title)){
		echo '{"state": 200, "info": "请输入标题"}';
		exit();
	}
	
	if(empty($rating)){
		echo '{"state": 200, "info": "请选择评分"}';
		exit();
	}
	
	if(empty($review)){
		echo '{"state": 200, "info": "请输入综合点评内容"}';
		exit();
	}
	
	if(empty($waiguan)){
		echo '{"state": 200, "info": "请输入外观点评"}';
		exit();
	}
	
	if(empty($waiguanrating)){
		echo '{"state": 200, "info": "请选择外观评分"}';
		exit();
	}
	
	if(empty($neishi)){
		echo '{"state": 200, "info": "请输入内饰点评"}';
		exit();
	}
	
	if(empty($neishirating)){
		echo '{"state": 200, "info": "请选择内饰评分"}';
		exit();
	}
	
	if(empty($kongjian)){
		echo '{"state": 200, "info": "请输入空间点评"}';
		exit();
	}
	
	if(empty($kongjianrating)){
		echo '{"state": 200, "info": "请选择空间评分"}';
		exit();
	}
	
	if(empty($dongli)){
		echo '{"state": 200, "info": "请输入动力点评"}';
		exit();
	}
	
	if(empty($donglirating)){
		echo '{"state": 200, "info": "请选择动力评分"}';
		exit();
	}
	
	if(empty($caokong)){
		echo '{"state": 200, "info": "请输入操控点评"}';
		exit();
	}
	
	if(empty($caokongrating)){
		echo '{"state": 200, "info": "请选择操控评分"}';
		exit();
	}
	
	if(empty($peizhi)){
		echo '{"state": 200, "info": "请输入配置点评"}';
		exit();
	}
	
	if(empty($peizhirating)){
		echo '{"state": 200, "info": "请选择配置评分"}';
		exit();
	}
	
	if(empty($shushi)){
		echo '{"state": 200, "info": "请输入舒适度点评"}';
		exit();
	}
	
	if(empty($shushirating)){
		echo '{"state": 200, "info": "请选择舒适度评分"}';
		exit();
	}
	
	if(empty($xingjiabi)){
		echo '{"state": 200, "info": "请输入性欲比点评"}';
		exit();
	}
	
	if(empty($xingjiabirating)){
		echo '{"state": 200, "info": "请选择性欲比评分"}';
		exit();
	}

	if(empty($fuel)){
		echo '{"state": 200, "info": "请输入油耗"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($pid)){
		$where .= " AND `pid` = ".$pid;
	}
	
	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `uid`, `pid`, `title`, `fuel`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["uid"] = $value["uid"];

			//会员信息
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["uid"]);
			$userResult = $dsql->getTypeName($userSql);
			$list[$key]["username"] = $userResult[0]['username'];

			$list[$key]["title"] = $value["title"];
			$list[$key]["pid"] = $value["pid"];

			//所属车系
			$pSql = $dsql->SetQuery("SELECT `cid`, `title` FROM `#@__car_param` WHERE `id` = ". $value["pid"]);
			$pResult = $dsql->getTypeName($pSql);
			$list[$key]["paramName"] = $pResult[0]['title'];

			//所属车型
			$list[$key]["cid"] = $pResult[0]['cid'];
			$cSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $pResult[0]["cid"]);
			$cResult = $dsql->getTypeName($cSql);
			$list[$key]["cName"] = $cResult[0]['title'];

			$list[$key]["fuel"] = $value["fuel"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carKoubei": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carKoubeiAdd");

	$pagetitle = "新增汽车口碑";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`uid`, `pid`, `title`, `rating`, `review`, `pics`, `waiguan`, `waiguanrating`, `neishi`, `neishirating`, `kongjian`, `kongjianrating`, `dongli`, `donglirating`, `caokong`, `caokongrating`, `peizhi`, `peizhirating`, `shushi`, `shushirating`, `xingjiabi`, `xingjiabirating`, `year`, `month`, `price`, `mileage`, `fuel`, `costs`, `click`, `pubdate`) VALUES ('$uid', '$pid', '$title', '$rating', '$review', '$pics', '$waiguan', '$waiguanrating', '$neishi', '$neishirating', '$kongjian', '$kongjianrating', '$dongli', '$donglirating', '$caokong', '$caokongrating', '$peizhi', '$peizhirating', '$shushi', '$shushirating', '$xingjiabi', '$xingjiabirating', '$year', '$month', '$price', '$mileage', '$fuel', '$costs', '$click', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增汽车口碑", $title);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carKoubeiEdit");
	
	$pagetitle = "修改汽车口碑";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `uid` = '$uid', `pid` = '$pid', `title` = '$title', `rating` = '$rating', `review` = '$review', `pics` = '$pics', `waiguan` = '$waiguan', `waiguanrating` = '$waiguanrating', `neishi` = '$neishi', `neishirating` = '$neishirating', `kongjian` = '$kongjian', `kongjianrating` = '$kongjianrating', `dongli` = '$dongli', `donglirating` = '$donglirating', `caokong` = '$caokong', `caokongrating` = '$caokongrating', `peizhi` = '$peizhi', `peizhirating` = '$peizhirating', `shushi` = '$shushi', `shushirating` = '$shushirating', `xingjiabi` = '$xingjiabi', `xingjiabirating` = '$xingjiabirating', `year` = '$year', `month` = '$month', `price` = '$price', `mileage` = '$mileage', `fuel` = '$fuel', `costs` = '$costs', `click` = '$click' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车口碑", $id."=>".$title);
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
				
				$uid             = $results[0]['uid'];
				$pid             = $results[0]['pid'];
				$title           = $results[0]['title'];
				$rating          = $results[0]['rating'];
				$review          = $results[0]['review'];
				$pics            = $results[0]['pics'];
				$waiguan         = $results[0]['waiguan'];
				$waiguanrating   = $results[0]['waiguanrating'];
				$neishi          = $results[0]['neishi'];
				$neishirating    = $results[0]['neishirating'];
				$kongjian        = $results[0]['kongjian'];
				$kongjianrating  = $results[0]['kongjianrating'];
				$dongli          = $results[0]['dongli'];
				$donglirating    = $results[0]['donglirating'];
				$caokong         = $results[0]['caokong'];
				$caokongrating   = $results[0]['caokongrating'];
				$peizhi          = $results[0]['peizhi'];
				$peizhirating    = $results[0]['peizhirating'];
				$shushi          = $results[0]['shushi'];
				$shushirating    = $results[0]['shushirating'];
				$xingjiabi       = $results[0]['xingjiabi'];
				$xingjiabirating = $results[0]['xingjiabirating'];
				$year            = $results[0]['year'];
				$month           = $results[0]['month'];
				$price           = $results[0]['price'];
				$mileage         = $results[0]['mileage'];
				$fuel            = $results[0]['fuel'];
				$costs           = $results[0]['costs'];
				$click           = $results[0]['click'];
				
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
	if(!testPurview("carKoubeiDel")){
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
			delPicFile($results[0]['pics'], "delAtlas", "car");
			
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
			adminLog("删除汽车口碑", join(", ", $title));
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
		global $custom_atlasSize;
		global $custom_atlasType;
		$huoniaoTag->assign('atlasSize', $custom_atlasSize);
		$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
	}
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('brandid', 0);
	$huoniaoTag->assign('brandName', "请选择品牌");
	$huoniaoTag->assign('cid', 0);
	$huoniaoTag->assign('cname', "请选择车系");
	$huoniaoTag->assign('pid', 0);
	$huoniaoTag->assign('pname', "请选择车型");
	$huoniaoTag->assign('imglist', json_encode(!empty($pics) ? explode(",", $pics) : array()));
	
	if($dopost != ""){

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);

			$huoniaoTag->assign('uid', $uid);
		
			//会员
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $uid);
			$username = $dsql->getTypeName($userSql);
			$username = $username[0]['username'];
			$huoniaoTag->assign('username', $username);

			//车型名称
			$huoniaoTag->assign('pid', $pid);
			$pSql = $dsql->SetQuery("SELECT `cid`, `title` FROM `#@__car_param` WHERE `id` = ". $pid);
			$pResult = $dsql->getTypeName($pSql);
			$huoniaoTag->assign('pname', $pResult[0]["title"]);

			$huoniaoTag->assign('cid', $pResult[0]["cid"]);
			//车辆名称
			$carSql = $dsql->SetQuery("SELECT `title`, `brand` FROM `#@__car_list` WHERE `id` = ". $pResult[0]["cid"]);
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

			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('rating', $rating);
			$huoniaoTag->assign('review', $review);
			$huoniaoTag->assign('waiguan', $waiguan);
			$huoniaoTag->assign('waiguanrating', $waiguanrating);
			$huoniaoTag->assign('neishi', $neishi);
			$huoniaoTag->assign('neishirating', $neishirating);
			$huoniaoTag->assign('kongjian', $kongjian);
			$huoniaoTag->assign('kongjianrating', $kongjianrating);
			$huoniaoTag->assign('dongli', $dongli);
			$huoniaoTag->assign('donglirating', $donglirating);
			$huoniaoTag->assign('caokong', $caokong);
			$huoniaoTag->assign('caokongrating', $caokongrating);
			$huoniaoTag->assign('peizhi', $peizhi);
			$huoniaoTag->assign('peizhirating', $peizhirating);
			$huoniaoTag->assign('shushi', $shushi);
			$huoniaoTag->assign('shushirating', $shushirating);
			$huoniaoTag->assign('xingjiabi', $xingjiabi);
			$huoniaoTag->assign('xingjiabirating', $xingjiabirating);
			$huoniaoTag->assign('year', $year);
			$huoniaoTag->assign('month', $month);
			$huoniaoTag->assign('price', $price);
			$huoniaoTag->assign('mileage', $mileage);
			$huoniaoTag->assign('fuel', $fuel);
			$huoniaoTag->assign('costs', $costs);
			$huoniaoTag->assign('click', $click);
		}

	}
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}