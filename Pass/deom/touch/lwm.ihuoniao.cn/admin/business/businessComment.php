<?php
/**
 * 管理商家评论
 *
 * @version        $Id: businessComment.php 2017-3-24 下午17:41:26 $
 * @package        HuoNiao.Business
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("businessComment");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/business";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "businessComment.html";

global $handler;
$handler = true;

$action = "business";

if($dopost == "getDetail"){
	if($id == "") die;
	$archives = $dsql->SetQuery("SELECT `bid`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `rating`, `reply`, `rtime`, `ischeck` FROM `#@__".$action."_comment` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){

		$typeSql = $dsql->SetQuery("SELECT p.`title` FROM `#@__".$action."_list` p WHERE p.`id` = ". $results[0]["bid"]);
		$typename = $dsql->getTypeName($typeSql);
		$results[0]["storeTitle"] = $typename[0]['title'];

		$param = array(
			"service"  => "business",
			"template" => "detail",
			"id"       => $results[0]['bid']
		);
		$results[0]["storeUrl"] = getUrlPath($param);

		if($results[0]["userid"] == 0 || $results[0]["userid"] == -1){
			$username = "游客";
		}else{
			$archives = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ".$results[0]["userid"]);
			$member = $dsql->dsqlOper($archives, "results");
			$username = $member[0]["username"];
		}
		$results[0]["username"] = $username;
		echo json_encode($results);

	}else{
		echo '{"state": 200, "info": '.json_encode("评论信息获取失败！").'}';
	}
	die;

//更新评论信息
}else if($dopost == "updateDetail"){
	if($id == "") die;
	$content = $_POST["content"];
	$dtime   = GetMkTime($_POST["time"]);
	$ip      = $_POST["ip"];
	$rating  = $_POST["rating"];
	$reply   = $_POST["reply"];
	$rtime   = GetMkTime($_POST["rtime"]);
	$ischeck = $_POST["isCheck"];
	$ipAddr = getIpAddr($ip);

	//会员通知
	$sql = $dsql->SetQuery("SELECT l.`id`, l.`title`, l.`pubdate`, l.`uid`, c.`userid`, c.`ischeck`, c.`dtime` FROM `#@__".$action."_comment` c LEFT JOIN `#@__".$action."_list` l ON l.`id` = c.`bid` WHERE c.`id` = $id");
	$ret = $dsql->dsqlOper($sql, "results");
	if($ret){
		$aid     = $ret[0]['id'];
		$title   = $ret[0]['title'];
		$pubdate = $ret[0]['pubdate'];
		$uid     = $ret[0]['uid'];
		$userid  = $ret[0]['userid'];
		$ischeck_ = $ret[0]['ischeck'];
		$dtime   = $ret[0]['dtime'];

		//验证评论状态
		if($ischeck_ != $isCheck){

			$param = array(
				"service"  => $action,
				"template" => "detail",
				"id"       => $aid
			);

			//只有审核通过的信息才发通知
			if($isCheck == 1){

				//获取会员名
				$username = "";
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $userid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}

				updateMemberNotice($userid, "会员-评论审核通过", $param, array("username" => $username, "title" => $title, "date" => date("Y-m-d H:i:s", $dtime)));

				//获取会员名
				$username = "";
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}

				updateMemberNotice($uid, "会员-新评论通知", $param, array("username" => $username, "title" => $title, "date" => date("Y-m-d H:i:s", $pubdate)));

			}

		}
	}

	$archives = $dsql->SetQuery("UPDATE `#@__".$action."_comment` SET `content` = '$content', `dtime` = '$dtime', `ip` = '$ip', `reply` = '$reply', `rtime` = '$rtime', `ischeck` = '$isCheck', `rating` = '$rating' WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "update");
	if($results != "ok"){
		echo $results;
	}else{
		adminLog("更新商家评论", $id);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}
	die;

//更新评论状态
}else if($dopost == "updateState"){
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){


		//会员通知
		$sql = $dsql->SetQuery("SELECT l.`id`, l.`title`, l.`pubdate`, l.`uid`, c.`userid`, c.`ischeck`, c.`dtime` FROM `#@__".$action."_comment` c LEFT JOIN `#@__".$action."_list` l ON l.`id` = c.`bid` WHERE c.`id` = $val");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$aid     = $ret[0]['id'];
			$title   = $ret[0]['title'];
			$pubdate = $ret[0]['pubdate'];
			$uid     = $ret[0]['uid'];
			$userid  = $ret[0]['userid'];
			$ischeck = $ret[0]['ischeck'];
			$dtime   = $ret[0]['dtime'];

			//验证评论状态
			if($ischeck != $arcrank){

				$param = array(
					"service"  => $action,
					"template" => "detail",
					"id"       => $aid
				);

				//只有审核通过的信息才发通知
				if($arcrank == 1){

					//获取会员名
					$username = "";
					$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $userid");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						$username = $ret[0]['username'];
					}

					updateMemberNotice($userid, "会员-评论审核通过", $param, array("username" => $username, "title" => $title, "date" => date("Y-m-d H:i:s", $dtime)));

					//获取会员名
					$username = "";
					$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						$username = $ret[0]['username'];
					}

					updateMemberNotice($uid, "会员-新评论通知", $param, array("username" => $username, "title" => $title, "date" => date("Y-m-d H:i:s", $pubdate)));

				}

			}
		}



		$archives = $dsql->SetQuery("UPDATE `#@__".$action."_comment` SET `ischeck` = $arcrank WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("更新商家评论状态", $id."=>".$arcrank);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}
	die;

//删除评论
}else if($dopost == "delComment"){
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_comment` WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("删除商家评论", $id);
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
	}
	die;

//获取评论列表
}else if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		//按评论内容搜索
		if($sType == 0){
			$where .= " AND `content` like '%$sKeyword%'";

		//按信息标题搜索
		}elseif($sType == "1"){
			$archives = $dsql->SetQuery("SELECT l.`id` FROM `#@__".$action."_list` l WHERE l.`title` like '%$sKeyword%'");
			$results = $dsql->dsqlOper($archives, "results");
			if(count($results) > 0){
				$list = array();
				foreach ($results as $key=>$value) {
					$list[] = $value["id"];
				}
				$idList = join(",", $list);
				$where .= " AND `bid` in ($idList)";
			}else{
				echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": 0, "totalCount": 0, "totalGray": 0, "totalAudit": 0, "totalRefuse": 0}}';die;
			}

		//按评论人搜索
		}elseif($sType == "2"){
			if($sKeyword == "游客"){
				$where .= " AND (`userid` = 0 OR `userid` = -1)";
			}else{
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` like '%$sKeyword%'");
				$results = $dsql->dsqlOper($archives, "results");

				if(count($results) > 0){
					$list = array();
					foreach ($results as $key=>$value) {
						$list[] = $value["id"];
					}
					$idList = join(",", $list);

					$where .= " AND `userid` in ($idList)";

				}else{
					echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": 0, "totalCount": 0, "totalGray": 0, "totalAudit": 0, "totalRefuse": 0}}';die;
				}
			}

		//按IP搜索
		}elseif($sType == "3"){
			$where .= " AND `ip` like '%$sKeyword%'";
		}
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."_comment`");

	//总条数
	$totalCount = $dsql->dsqlOper($archives." WHERE 1 = 1".$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待审核
	$totalGray = $dsql->dsqlOper($archives." WHERE `ischeck` = 0".$where, "totalCount");
	//已审核
	$totalAudit = $dsql->dsqlOper($archives." WHERE `ischeck` = 1".$where, "totalCount");
	//拒绝审核
	$totalRefuse = $dsql->dsqlOper($archives." WHERE `ischeck` = 2".$where, "totalCount");

	if($state != ""){
		$where .= " AND `ischeck` = $state";

		if($state == 0){
			$totalPage = ceil($totalGray/$pagestep);
		}elseif($state == 1){
			$totalPage = ceil($totalAudit/$pagestep);
		}elseif($state == 2){
			$totalPage = ceil($totalRefuse/$pagestep);
		}
	}
	$where .= " order by `id` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `bid`, `userid`, `content`, `dtime`, `reply`, `rtime`, `ip`, `ipaddr`, `ischeck` FROM `#@__".$action."_comment` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["bid"] = $value["bid"];

			$typeSql = $dsql->SetQuery("SELECT `title` FROM `#@__".$action."_list` WHERE `id` = ". $value["bid"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["storeTitle"] = $typename[0]['title'];

			$param = array(
				"service"  => "business",
				"template" => "detail",
				"id"       => $value['bid']
			);
			$list[$key]["storeUrl"] = getUrlPath($param);

			$list[$key]["userid"] = $value["userid"];
			$member = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ".$value["userid"]);
			$username = $dsql->dsqlOper($member, "results");
			$list[$key]["username"]  = $username[0]["username"] == null ? "游客" : $username[0]["username"];

			$list[$key]["content"] = cn_substrR(strip_tags($value["content"]), 30)."...";
			$list[$key]["time"] = date('Y-m-d H:i:s', $value["dtime"]);
			$list[$key]["rtime"] = date('Y-m-d H:i:s', $value["rtime"]);
			$list[$key]["reply"] = $value["reply"];
			$list[$key]["ip"] = $value["ip"];
			$list[$key]["ipAddr"] = $value["ipaddr"];

			$state = "";
			switch($value["ischeck"]){
				case "0":
					$state = "等待审核";
					break;
				case "1":
					$state = "审核通过";
					break;
				case "2":
					$state = "审核拒绝";
					break;
			}

			$list[$key]["isCheck"] = $state;
		}
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "commonList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;
}


//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/business/businessComment.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/business";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
