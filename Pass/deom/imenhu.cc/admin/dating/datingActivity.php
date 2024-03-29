<?php
/**
 * 交友相亲活动
 *
 * @version        $Id: datingActivity.php 2014-7-24 上午09:41:25 $
 * @package        HuoNiao.Dating
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("datingActivity");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/dating";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$tab = "dating_activity";

if($dopost != ""){
	$templates = "datingActivityAdd.html";

	//js
	$jsFile = array(
	    'ui/bootstrap-datetimepicker.min.js',
	    'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/dating/datingActivityAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "datingActivity.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/dating/datingActivity.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate = GetMkTime(time());       //发布时间

	//二次验证
	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入活动标题"}';
		exit();
	}

	if(trim($litpic) == ""){
		echo '{"state": 200, "info": "请上传活动图片"}';
		exit();
	}

	if(trim($deadline) == ""){
		echo '{"state": 200, "info": "请输入活动截止时间"}';
		exit();
	}

	if(trim($content) == ""){
		echo '{"state": 200, "info": "请输入活动详情"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND (`title` like '%".$sKeyword."%' OR `address` like '%".$sKeyword."%' OR `else` like '%".$sKeyword."%')";
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	$where .= " order by `id` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `litpic`, `btime`, `address`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["btime"] = $value["btime"];
			$list[$key]["address"] = $value["address"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"     => "dating",
				"template"    => "activity",
				"id"          => $value['id']
			);
			$list[$key]['url'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "datingActivity": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;

//新增
}elseif($dopost == "add"){

	$pagetitle = "新增交友相亲活动";

	//表单提交
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`title`, `litpic`, `btime`, `deadline`, `address`, `lnglat`, `pcount`, `money`, `else`, `content`, `pubdate`) VALUES ('$title', '$litpic', '$btime', '".GetMkTime($deadline)."', '$address', '$lnglat', '$pcount', '$money', '$else', '$content', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			adminLog("新增交友相亲活动", $title);

			$param = array(
				"service"     => "dating",
				"template"    => "activity",
				"id"          => $aid
			);
			$url = getUrlPath($param);
			echo '{"state": 100, "url": "'.$url.'"}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){

	$pagetitle = "修改交友相亲活动信息";

	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `litpic` = '$litpic', `btime` = '$btime', `deadline` = '".GetMkTime($deadline)."', `address` = '$address', `lnglat` = '$lnglat', `pcount` = '$pcount', `money` = '$money', `else` = '$else', `content` = '$content' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			adminLog("修改交友相亲活动信息", $title);

			$param = array(
				"service"     => "dating",
				"template"    => "activity",
				"id"          => $id
			);
			$url = getUrlPath($param);
			echo '{"state": 100, "url": "'.$url.'"}';
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

				$title    = $results[0]['title'];
				$litpic   = $results[0]['litpic'];
				$btime    = $results[0]['btime'];
				$deadline = $results[0]['deadline'] == "" ? "" : date("Y-m-d H:i:s", $results[0]['deadline']);
				$address  = $results[0]['address'];
				$lnglat   = $results[0]['lnglat'];
				$pcount   = $results[0]['pcount'];
				$money    = $results[0]['money'];
				$else     = $results[0]['else'];
				$content  = $results[0]['content'];

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
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			array_push($title, $results[0]['title']);

			//删除缩略图
			delPicFile($results[0]['litpic'], "delThumb", "dating");

			$body = $results[0]['content'];
			if(!empty($body)){
				delEditorPic($body, "dating");
			}

			//删除报名
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."_take` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

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
			adminLog("删除交友相亲活动", join(", ", $title));
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
	$huoniaoTag->assign('mapCity', $cfg_mapCity);
	$huoniaoTag->assign('id', $id);

	$huoniaoTag->assign('title', $title);
	$huoniaoTag->assign('litpic', $litpic);
	$huoniaoTag->assign('btime', $btime);
	$huoniaoTag->assign('deadline', $deadline);
	$huoniaoTag->assign('address', $address);
	$huoniaoTag->assign('lnglat', $lnglat);
	$huoniaoTag->assign('pcount', $pcount);
	$huoniaoTag->assign('money', $money);
	$huoniaoTag->assign('else', $else);
	$huoniaoTag->assign('content', $content);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/dating";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
