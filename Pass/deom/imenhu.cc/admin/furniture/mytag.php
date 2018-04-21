<?php
/**
 * 模板标记
 *
 * @version        $Id: mytag.php 2014-5-12 上午08:58:21 $
 * @package        HuoNiao.Furniture
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/furniture";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "mytag.html";

$action = "furniture";

//js
$jsFile = array(
	'ui/bootstrap.min.js',
	'ui/jquery-ui-selectable.js',
	'admin/'.$action.'/mytag.js'
);

checkPurview("mytag".$action);

//预览
if($submit == "预览"){
	
	$data = array();
	$handler = true;
	if(!empty($typeid))  $data["typeid"]  = $typeid;
	if($store != "")  $data["store"]  = $store;
	if(!empty($price) && $price != ",")  $data["price"] = $price;
	if($flag != "")  $data["flag"]  = $flag;
	if(!empty($orderby)) $data["orderby"] = $orderby;

	$handels = new handlers($action, "flist");
	$return = $handels->getHandle($data);
	echo json_encode($return);
	die;
}

if($dopost == "getList"){
	
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = " WHERE `module` = '".$action."'";
	
	if($sKeyword != ""){
		$where .= " AND `name` like '%$sKeyword%'";
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__mytag`".$where);

	//总条数
	$totalCount = $dsql->dsqlOper($archives, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//暂停
	$totalPause = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
	//正常
	$totalNormal = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
	
	if($state != ""){
		$where .= " AND `state` = $state";
	}
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `name`, `module`, `start`, `end`, `state`, `pubdate` FROM `#@__mytag`".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"]      = $value["id"];
			$list[$key]["name"]    = $value["name"];
			$list[$key]["module"]  = $value["module"];
			$list[$key]["start"]   = !empty($value["start"]) ? date('Y-m-d', $value["start"]) : "";
			$list[$key]["end"]     = !empty($value["end"]) ? date('Y-m-d', $value["end"]) : "";
			$list[$key]["state"]   = $value["state"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalPause": '.$totalPause.', "totalNormal": '.$totalNormal.'}, "mytag": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalPause": '.$totalPause.', "totalNormal": '.$totalNormal.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalPause": '.$totalPause.', "totalNormal": '.$totalNormal.'}}';
	}
	die;
	
//新增标记
}elseif($dopost == "save"){
	checkPurview("add".$action."Mytag");
	
	if($submit == "提交"){
		if($token == "") die('{"state": 200, "info": "token传递失败！"}');

		$data = array();
		if(!empty($typeid))  $data["typeid"]  = $typeid;
		if($store != "")    $data["store"]  = $store;
		if(!empty($price))   $data["price"]   = $price;
		if(!empty($flag))    $data["flag"]    = $flag;
		if(!empty($orderby)) $data["orderby"] = $orderby;
		$start = !empty($start) ? GetMkTime($start) : 0;
		$end   = !empty($end) ? GetMkTime($end) : 0;
		
		$data = serialize($data);
		
		$archives = $dsql->SetQuery("INSERT INTO `#@__mytag` (`name`, `module`, `type`, `start`, `end`, `config`, `expbody`, `state`, `pubdate`) VALUES ('$name', '$action', 'flist', '$start', '$end', '$data', '$expbody', '$state', '".GetMkTime(time())."')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("生成模板标签", $action . " => " . $name);
			echo '{"state": 100, "info": "生成成功！"}';
		}else{
			echo '{"state": 200, "info": "保存失败！"}';
		}
		
		die;
	}
	
	
	$templates = "mytagAdd.html";
	//js
	$jsFile = array(
		'ui/bootstrap-datetimepicker.min.js',
		'admin/'.$action.'/mytagAdd.js'
	);
	
	$huoniaoTag->assign('typeid', 0);
	$huoniaoTag->assign('dopost', "save");
	$huoniaoTag->assign('state', 1);

	
//修改标记
}elseif($dopost == "edit"){
	checkPurview("edit".$action."Mytag");
	$templates = "mytagAdd.html";
	//js
	$jsFile = array(
		'ui/bootstrap-datetimepicker.min.js',
		'admin/'.$action.'/mytagAdd.js'
	);
	
	$huoniaoTag->assign("dopost", "edit");
	
	if($submit == "提交"){
		if(empty($token)) die('{"state": 200, "info": "token传递失败！"}');
		if(empty($id)) die('{"state": 200, "info": "要修改的信息ID传递失败！"}');
		
		$data = array();
		if(!empty($typeid))  $data["typeid"]  = $typeid;
		if($store != "")    $data["store"]  = $store;
		if(!empty($price))   $data["price"]   = $price;
		if(!empty($flag))    $data["flag"]    = $flag;
		if(!empty($orderby)) $data["orderby"] = $orderby;
		$start = !empty($start) ? GetMkTime($start) : 0;
		$end   = !empty($end) ? GetMkTime($end) : 0;
		
		$data = serialize($data);
		
		$archives = $dsql->SetQuery("UPDATE `#@__mytag` SET `name` = '$name', `start` = '$start', `end` = '$end', `config` = '$data', `expbody` = '$expbody', `state` = '$state' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改模板标签", $action . " => " . $name);
			echo '{"state": 100, "info": "修改成功！"}';
		}else{
			echo '{"state": 200, "info": "修改失败！"}';
		}
		
		die;
	}
	
	if(empty($id)) die('要修改的信息ID传递失败！');
	$archives = $dsql->SetQuery("SELECT * FROM `#@__mytag` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");
	
	if(!empty($results)){
		$name     = $results[0]['name'];
		$start    = $results[0]['start'];
		$end      = $results[0]['end'];
		$config   = unserialize($results[0]['config']);
		$expbody  = $results[0]['expbody'];
		$state    = $results[0]['state'];
		
		$huoniaoTag->assign("id", $id);
		$huoniaoTag->assign("name", $name);
		$huoniaoTag->assign("start", !empty($start) ? date("Y-m-d", $start) : "");
		$huoniaoTag->assign("end", !empty($end) ? date("Y-m-d", $end) : "");
		$huoniaoTag->assign("expbody", $expbody);
		$huoniaoTag->assign("state", $state);
		$huoniaoTag->assign('typeid', 0);
		$store = "";
		
		if(!empty($config)){
			foreach($config as $key => $val){
				if($key == "price"){
					$v = explode(",", $val);
					$huoniaoTag->assign($key."1", $v[0]);
					$huoniaoTag->assign($key."2", $v[1]);
				}elseif($key == "store"){
					$store = $val;
				}elseif($key == "flag"){
					$huoniaoTag->assign($key, explode(",", $val));
				}else{
					$$key = $val;
					$huoniaoTag->assign($key, $val);
				}
			}
		}
		
	}else{
		die('信息不存在或已删除！');
	}
	
	
//删除标记
}elseif($dopost == "del"){
	checkPurview("del".$action."Mytag");
	
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("DELETE FROM `#@__mytag` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除模板标签", $action ." => ". $id);
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
	}
	
	die;
	
//更新状态
}elseif($dopost == "updateState"){
	checkPurview("edit".$action."Mytag");
	
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__mytag` SET `state` = $state WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新模板标签状态", $action ." => ". $state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->assign('module', $action);
	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, $action."_industry")));
	
	//店铺Array
	$storeOption = array();
	$selected = "";
	if($store == 0){
		$selected = " selected";
	}
	array_push($storeOption, '<option value="">不限</option><option value="0"'.$selected.'>官方直营</option>');
	$archives = $dsql->SetQuery("SELECT `id`, `company` FROM `#@__".$action."_store` ORDER BY `weight`");
	$results = $dsql->dsqlOper($archives, "results");
	if($results){
		foreach($results as $key => $val){
			$selected = "";
			if($val["id"] == $store){
				$selected = " selected";
			}
			array_push($storeOption, '<option value="'.$val["id"].'"'.$selected.'>'.$val["company"].'</option>');
		}
	}
	$huoniaoTag->assign('storeOption', join("", $storeOption));
	
	//自定义属性-多选
	$huoniaoTag->assign('flagopt',array('r', 'c', 'n', 'h'));
	$huoniaoTag->assign('flagList',array('推荐','促销','新品','热卖'));
	
	//排序
	$huoniaoTag->assign('orderbyList', array(0 => '默认排序', 1 => '价格升序', 2 => '价格降序', 3 => '时间降序', 4 => '人气降序'));
	
	//状态
	$huoniaoTag->assign('stateopt', array('0', '1'));
	$huoniaoTag->assign('statenames',array('暂停','正常'));

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/".$action;  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}