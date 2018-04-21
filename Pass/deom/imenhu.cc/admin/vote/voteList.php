<?php
/**
 * 管理投票信息
 *
 * @version        $Id: voteList.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.Vote
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

$action = "vote";
$actioncap = "Vote";
$actiontxt = "投票";

define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview($action."List");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/".$action;
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = $action."List.html";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."_list` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待审核
	$totalGray = $dsql->dsqlOper($archives." AND `arcrank` = 0".$where, "totalCount");
	//已审核
	$totalAudit = $dsql->dsqlOper($archives." AND `arcrank` = 1".$where, "totalCount");
	//拒绝审核
	$totalRefuse = $dsql->dsqlOper($archives." AND `arcrank` = 2".$where, "totalCount");
	//取消显示
	$totalNoshow = $dsql->dsqlOper($archives." AND `arcrank` = 3".$where, "totalCount");
	//报名结束
	$now = GetMkTime(time());
	$totalBaomingEnd = $dsql->dsqlOper($archives." AND (`baomingend` <> 0 AND`baomingend` < ".$now.")".$where, "totalCount");
	//已结束
	$totalEnd = $dsql->dsqlOper($archives." AND (`end` < ".$now.")".$where, "totalCount");

	if($state != "" && $state != 4){
		$where .= " AND `arcrank` = $state";

		if($state == 0){
			$totalPage = ceil($totalGray/$pagestep);
		}elseif($state == 1){
			$totalPage = ceil($totalAudit/$pagestep);
		}elseif($state == 2){
			$totalPage = ceil($totalRefuse/$pagestep);
		}elseif($state == 3){
			$totalPage = ceil($totalNoshow/$pagestep);
		}
	}
	//筛选报名已截止信息
	if($state == 4){
		$now = GetMkTime(time());
		$where .= " AND (`baomingend` <> 0 AND`baomingend` < ".$now.")";

		$totalPage = ceil($totalBaomingEnd/$pagestep);
	}
	//筛选报名已截止的信息
	elseif($state == 5){
		$now = GetMkTime(time());
		$where .= " AND (`end` < ".$now.")";

		$totalPage = ceil($totalEnd/$pagestep);
	}

	$where .= " order by `pubdate` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `color`, `began`, `end`, `baomingend`, `pubdate`, `arcrank` FROM `#@__".$action."_list` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");
	if(count($results) > 0){
		$list = array();
		$now  = GetMkTime(time());
		foreach ($results as $key=>$value) {
			$list[$key]["id"]      = $value["id"];
			$list[$key]["title"]   = $value["title"];
			$list[$key]["color"]   = $value["color"];
			$list[$key]["color"]   = $value["color"];
			$list[$key]["arcrank"] = $value["arcrank"];
			$list[$key]["began"]     = date("Y-m-d H:i:s",$value["began"]);
			$list[$key]["end"]     = date("Y-m-d H:i:s",$value["end"]);
			$list[$key]["date"]    = date("Y-m-d H:i:s",$value["pubdate"]);

			$state = "";
			switch($value["arcrank"]){
				case "0":
					$state = "等待审核";
					break;
				case "1":
					$state = "审核通过";
					break;
				case "2":
					$state = "审核拒绝";
					break;
				case "3":
					$state = "取消显示";
					break;
			}

			$list[$key]["state"] = $state;

			// 活动进行状态 0:未开始,1:进行中,2:报名结束,3:活动结束
			if($now < $value["began"]){
				$list[$key]["statetime"] = "0";
			}elseif($now > $value["end"]){
				$list[$key]["statetime"] = "3";
			}elseif($value['baomingend'] != 0 && $now > $value['baomingend']){
				$list[$key]["statetime"] = "2";
			}else{
				$list[$key]["statetime"] = "1";
			}

			$param = array(
				"service"     => $action,
				"template"    => "detail",
				"id"          => $value['id']
			);
			$list[$key]['url'] = getUrlPath($param);

			// 查询报名选手
			$sql = $dsql->SetQuery("SELECT COUNT(`id`) total FROM `#@__".$action."_user` WHERE `tid` = ".$value["id"]);
            $ret = $dsql->dsqlOper($sql, "results");
            if($ret){
            	$list[$key]['usercount'] = $ret[0]['total'];
            }else{
            	$list[$key]['usercount'] = 0;
            }
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.', "totalNoshow": '.$totalNoshow.', "totalBaomingEnd": '.$totalBaomingEnd.', "totalEnd": '.$totalEnd.'}, "infoList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.', "totalNoshow": '.$totalNoshow.', "totalNoshow": '.$totalNoshow.', "totalBaomingEnd": '.$totalBaomingEnd.', "totalEnd": '.$totalEnd.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.', "totalNoshow": '.$totalNoshow.', "totalNoshow": '.$totalNoshow.', "baomingend": '.$totalBaomingEnd.', "end": '.$totalEnd.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if(!testPurview("del".$actioncap)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			//删除评论
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_common` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除缩略图
			delPicFile($results[0]['litpic'], "delThumb", $action);
			//删除正文图片
			delEditorPic($value['body'], $action);
			delEditorPic($value['mbody'], $action);

			//删除主表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_list` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除".$actiontxt."信息", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
	}
	die;

//删除所有待审核信息
}elseif($dopost == "delAllGray"){
	if(!testPurview("del".$actioncap)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};

	$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."_list` WHERE `arcrank` = 0");
	$results = $dsql->dsqlOper($archives, "results");
	if($results){
		foreach ($results as $key => $value) {

			//删除评论
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_common` WHERE `aid` = ".$value['id']);
			$dsql->dsqlOper($archives, "update");

			//删除缩略图
			delPicFile($results[0]['litpic'], "delThumb", $action);
			//删除正文图片
			delEditorPic($value['body'], $action);
			delEditorPic($value['mbody'], $action);

			//删除表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_list` WHERE `id` = ".$value['id']);
			$dsql->dsqlOper($archives, "update");

		}

	}
	die;



//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("edit".$actioncap)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$action."_list` SET `arcrank` = ".$arcrank." WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新分类信息状态", $id."=>".$arcrank);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;

//更新时间
}elseif($dopost == "updateTime"){
	if(!testPurview("edit".$actioncap)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$action."_list` SET `pubdate` = ".GetMkTime(time())." WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新分类信息时间", $id);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/'.$action.'/'.$action.'List.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('actiontxt', $actiontxt);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/".$action;  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}