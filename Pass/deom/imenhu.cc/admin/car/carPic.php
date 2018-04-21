<?php
/**
 * 汽车图片管理
 *
 * @version        $Id: carPic.php 2014-8-28 上午09:29:11 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carPic");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_pic";

if($dopost != ""){
	$templates = "carPicAdd.html";
	
	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/car/carPicAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carPic.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carPic.js'
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
	
	if(empty($type)){
		echo '{"state": 200, "info": "请选择分类"}';
		exit();
	}

	if($type < 4 && $type > 0){
		if(trim($year) == ""){
			echo '{"state": 200, "info": "请选择年款"}';
			exit();
		}
		
		if(empty($color)){
			echo '{"state": 200, "info": "请选择颜色"}';
			exit();
		}
	}
	
	if($dopost == "Add"){
		if(empty($pics)){
			echo '{"state": 200, "info": "请上传图片！"}';
			exit();
		}
	}elseif($dopost == "edit"){
		if(trim($title) == ""){
			echo '{"state": 200, "info": "请输入图片名称"}';
			exit();
		}
		
		if(empty($litpic)){
			echo '{"state": 200, "info": "请上传图片！"}';
			exit();
		}
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($pid)){
		$where .= " AND `pid` = ".$pid;
	}
	
	if(!empty($sType)){
		$where .= " AND `type` = ".$sType;
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `pic`, `pid`, `year`, `color`, `type`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["pic"] = $value["pic"];
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

			$type = "";
			switch ($value["type"]) {
				case '1':
					$type = "外观";
					break;
				case '2':
					$type = "内饰";
					break;
				case '3':
					$type = "空间";
					break;
				case '4':
					$type = "图解";
					break;
				case '5':
					$type = "官方图";
					break;
				case '6':
					$type = "车展";
					break;
			}
			$list[$key]["type"] = $type;

			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carPic": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carPicAdd");

	$pagetitle = "新增汽车图片";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$title = array();
		$pics = explode("###", $pics);
		foreach ($pics as $key => $pic) {
			$val = explode("||", $pic);
			$title[] = $val[1];
			$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`pid`, `year`, `color`, `type`, `title`, `pic`, `pubdate`) VALUES ('$pid', '$year', '$color', '$type', '".$val[1]."', '".$val[0]."', '$pubdate')");
			$dsql->dsqlOper($archives, "results");
		}
		
		adminLog("新增汽车图片", $pid."=>".join(",", $title));
		echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carPicEdit");
	
	$pagetitle = "修改汽车图片";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `pid` = '$pid', `year` = '$year', `color` = '$color', `type` = '$type', `title` = '$title', `pic` = '$litpic', `pubdate` = '$pubdate' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车图片", $pid."=>".$title);
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
				
				$pid   = $results[0]['pid'];
				$year  = $results[0]['year'];
				$color = $results[0]['color'];
				$type  = $results[0]['type'];				
				$title = $results[0]['title'];
				$pic   = $results[0]['pic'];
				
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
	if(!testPurview("carPicDel")){
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
			delPicFile($results[0]['pic'], "delAtlas", "car");
			
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
			adminLog("删除汽车图片", join(", ", $title));
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
	
	if($dopost != ""){

		$huoniaoTag->assign('typeList', array(0 => '请选择', 1 => '外观', 2 => '内饰', 3 => '空间', 4 => '图解', 5 => '官方图', 6 => '车展'));
		$huoniaoTag->assign('type', $type == "" ? 0 : $type);

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);

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


			$huoniaoTag->assign('pid', $pid);
			$huoniaoTag->assign('year', $year);
			$huoniaoTag->assign('color', $color);
			$huoniaoTag->assign('type', $type);
			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('pic', $pic);
		}

	}
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}