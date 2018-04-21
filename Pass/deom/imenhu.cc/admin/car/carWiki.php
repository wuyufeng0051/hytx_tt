<?php
/**
 * 汽车百科
 *
 * @version        $Id: carWiki.php 2014-9-4 下午22:54:13 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carWiki");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$pagetitle = "汽车百科";

$tab = "car_Wiki";

if($dopost != ""){
	$templates = "carWikiAdd.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/car/carWikiAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carWikiList.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carWikiList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate       = GetMkTime(time());       //发布时间
	
	//对字符进行处理
	$title       = cn_substrR($title,60);
	$keyword     = cn_substrR($keyword,50);
	$description = cn_substrR($description,150);

	// $body = AnalyseHtmlBody($body, $description, $keyword);
	$keyword = strlen($keyword) > 50 ? substr($keyword, 0, 49) : $keyword;
}

if(empty($click)) $click = mt_rand(50, 200);

//列表
if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	if($sType != ""){
		if($dsql->getTypeList($sType, $tab."type")){
			$lower = arr_foreach($dsql->getTypeList($sType, $tab."type"));
			$lower = $sType.",".join(',',$lower);
		}else{
			$lower = $sType;
		}
		$where .= " AND `typeid` in ($lower)";
	}
	
	$where .= " order by `weight` desc, `pubdate` desc";
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");
	
	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `typeid`, `weight`, `arcrank`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["typeid"] = $value["typeid"];
			
			//分类
			$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__".$tab."type` WHERE `id` = ". $value["typeid"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["type"] = $typename[0]['typename'];
			
			$list[$key]["weight"] = $value["weight"];
			
			$state = "";
			switch($value["arcrank"]){
				case "0":
					$state = "显示";
					break;
				case "1":
					$state = "隐藏";
					break;
			}
			
			$list[$key]["state"] = $state;
			
			$list[$key]["date"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carWiki": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
	}
	die;

//新增
}elseif($dopost == "Add"){
	
	$pagetitle     = "新增汽车百科";
	
	//表单提交
	if($submit == "提交"){
		
		//表单二次验证
		if(trim($title) == ''){
			echo '{"state": 200, "info": "标题不能为空"}';
			exit();
		}
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`title`, `typeid`, `click`, `weight`, `source`, `writer`, `keyword`, `description`, `body`, `arcrank`, `pubdate`) VALUES ('$title', '$typeid', '$click', '$weight', '$source', '$writer', '$keyword', '$description', '$body', '$arcrank', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增汽车百科", $title);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "Edit"){
	
	$pagetitle = "修改汽车百科";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//表单二次验证
		if(trim($title) == '')
		{
			echo '{"state": 200, "info": "标题不能为空"}';
			die;
		}
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `typeid` = $typeid, `click` = '$click', `weight` = '$weight', `source` = '$source', `writer` = '$writer', `keyword` = '$keyword', `description` = '$description', `body` = '$body', `arcrank` = '$arcrank' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车百科", $title);
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
				
				$title       = $results[0]['title'];
				$typeid      = $results[0]['typeid'];
				$click       = $results[0]['click'];
				$weight      = $results[0]['weight'];
				$source      = $results[0]['source'];
				$writer      = $results[0]['writer'];
				$keyword     = $results[0]['keyword'];
				$description = $results[0]['description'];
				$body        = $results[0]['body'];
				$arcrank     = $results[0]['arcrank'];

				$typename = getParentArr($tab."type", $results[0]['typeid']);
				$typename = join(" > ", array_reverse(parent_foreach($typename, "typename")));
				
			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}
			
		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}
	
}elseif($dopost == "del"){
	if($id != ""){
		
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			
			array_push($title, $results[0]['title']);
			//删除内容图片
			$body = $results[0]['body'];
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
			adminLog("删除汽车百科", join(", ", $title));
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
	$huoniaoTag->assign('id', $id);
	$huoniaoTag->assign('title', $title);
	$huoniaoTag->assign('typeid', empty($typeid) ? "0" : $typeid);
	$huoniaoTag->assign('typename', empty($typename) ? "选择分类" : $typename);
	$huoniaoTag->assign('click', $click);
	$huoniaoTag->assign('weight', $weight == "" ? 1 : $weight);
	$huoniaoTag->assign('source', $source);
	$huoniaoTag->assign('writer', $writer);
	$huoniaoTag->assign('keyword', $keyword);
	$huoniaoTag->assign('description', $description);
	$huoniaoTag->assign('body', $body);
	
	//阅读权限-单选
	$huoniaoTag->assign('arcrankList', array('0', '1'));
	$huoniaoTag->assign('arcrankName',array('显示','隐藏'));
	$huoniaoTag->assign('arcrank', $arcrank == "" ? 0 : $arcrank);
	$huoniaoTag->assign('pubdate', empty($pubdate) ? date("Y-m-d H:i:s",time()) : $pubdate);
	
	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, $tab."type")));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}