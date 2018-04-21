<?php
/**
 * 汽车保养管理
 *
 * @version        $Id: carBaoyang.php 2014-9-4 下午15:27:10 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carBaoyang");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_baoyang";

if($dopost != ""){
	$templates = "carBaoyangAdd.html";
	
	//js
	$jsFile = array(
		'admin/car/carBaoyangAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carBaoyang.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carBaoyang.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if(empty($cid)){
		echo '{"state": 200, "info": "请选择车系"}';
		exit();
	}
	
	if(empty($shoubao)){
		echo '{"state": 200, "info": "请输入首保里程"}';
		exit();
	}
	
	if(empty($baoyang)){
		echo '{"state": 200, "info": "请输入保养周期"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($cid)){
		$where .= " AND `cid` = ".$cid;
	}

	if(!empty($pid)){
		$where .= " AND `pid` = ".$pid;
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `cid`, `pid`, `shoubao`, `baoyang`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			//所属车型
			$list[$key]["cid"] = $value['cid'];
			$cSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $value["cid"]);
			$cResult = $dsql->getTypeName($cSql);
			$list[$key]["cName"] = $cResult[0]['title'];

			//所属车系
			$list[$key]["pid"] = $value['pid'];
			$pSql = $dsql->SetQuery("SELECT `cid`, `title` FROM `#@__car_param` WHERE `id` = ". $value["pid"]);
			$pResult = $dsql->getTypeName($pSql);
			if($pResult){
				$list[$key]["paramName"] = $pResult[0]['title'];
			}else{
				$list[$key]["paramName"] = '全系';
			}

			$list[$key]["shoubao"] = $value["shoubao"];
			$list[$key]["baoyang"] = $value["baoyang"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carBaoyang": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carBaoyangAdd");

	$pagetitle = "新增汽车保养";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`cid`, `pid`, `shoubao`, `baoyang`, `cycle`, `price`, `pubdate`) VALUES ('$cid', '$pid', '$shoubao', '$baoyang', '$cycle', '$price', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增汽车保养");
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carBaoyangEdit");
	
	$pagetitle = "修改汽车保养";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `cid` = '$cid', `pid` = '$pid', `shoubao` = '$shoubao', `baoyang` = '$baoyang', `cycle` = '$cycle', `price` = '$price' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车保养");
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
				
				$cid     = $results[0]['cid'];
				$pid     = $results[0]['pid'];
				$shoubao = $results[0]['shoubao'];
				$baoyang = $results[0]['baoyang'];
				$cycle   = $results[0]['cycle'];
				$price   = $results[0]['price'];
				
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
	if(!testPurview("carBaoyangDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		
		//删除表
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` in (".$id.")");
		$results = $dsql->dsqlOper($archives, "update");

		adminLog("删除汽车保养");
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		
	}
	die;

//获取保养周期表和价格表
}elseif($dopost == "getMain"){
	if(!empty($pid)){
		$return = array();
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `pid` = ".$pid);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$return['cycle'] = $results[0]['cycle'];
			$return['price'] = $results[0]['price'];
		}else{
			if(!empty($cid)){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `cid` = ".$cid);
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					$return['cycle'] = $results[0]['cycle'];
					$return['price'] = $results[0]['price'];
				}
			}
		}
		echo json_encode($return);
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('brandid', 0);
	$huoniaoTag->assign('brandName', "请选择品牌");
	$huoniaoTag->assign('cid', 0);
	$huoniaoTag->assign('cname', "请选择车系");
	$huoniaoTag->assign('pid', 0);
	$huoniaoTag->assign('pname', "请选择车型");
	
	if($dopost != ""){

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);

			//车型名称
			if($pid){
				$huoniaoTag->assign('pid', (int)$pid);
				$pSql = $dsql->SetQuery("SELECT `cid`, `title` FROM `#@__car_param` WHERE `id` = ". $pid);
				$pResult = $dsql->getTypeName($pSql);
				$huoniaoTag->assign('pname', $pResult[0]["title"]);
			}else{
				$huoniaoTag->assign('pname', '请选择车型');
			}

			$huoniaoTag->assign('cid', $cid);
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

			$huoniaoTag->assign('shoubao', $shoubao);
			$huoniaoTag->assign('baoyang', $baoyang);
			$huoniaoTag->assign('cycle', $cycle);
			$huoniaoTag->assign('price', $price);
		}

	}
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}