<?php
/**
 * 文章模块JSON
 *
 * @version        $Id: articleJson.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.Article
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql  = new dsql($dbo);

$dotitle = $dopost == "article" ? "新闻" : "图片";

//列表
if($action == ""){

	if(!testPurview("articleList")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};

	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$del = 0;
	if($aType != ""){
		$del = 1;
	}

	$where = "";

	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	if($sType != ""){
		if($dsql->getTypeList($sType, $dopost."type")){
			$lower = arr_foreach($dsql->getTypeList($sType, $dopost."type"));
			$lower = $sType.",".join(',',$lower);
		}else{
			$lower = $sType;
		}
		$where .= " AND `typeid` in ($lower)";
	}
	if($property != ""){
		$where .= " AND `flag` LIKE '%$property%'";
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$dopost."list` WHERE `del` = $del");

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

	if($state != ""){
		$where .= " AND `arcrank` = $state";

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
	if($dopost == "pic"){
		$archives = $dsql->SetQuery("SELECT `id`, `title`, `litpic`, `color`, `flag`, `redirecturl`, `typeid`, `weight`, `admin`, `arcrank`, `pubdate` FROM `#@__".$dopost."list` WHERE `del` = $del".$where);
	}else{
		$archives = $dsql->SetQuery("SELECT `id`, `title`, `color`, `flag`, `redirecturl`, `typeid`, `weight`, `admin`, `arcrank`, `pubdate` FROM `#@__".$dopost."list` WHERE `del` = $del".$where);
	}
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = htmlentities($value["title"], ENT_NOQUOTES, "utf-8");
			if($dopost == "pic"){
				$list[$key]["litpic"] = $value["litpic"];
			}
			$list[$key]["color"] = $value["color"];

			$append = $value["flag"];
			$append = str_replace("h", "头", $append);
			$append = str_replace("r", "推", $append);
			$append = str_replace("b", "粗", $append);
			$append = str_replace("t", "跳", $append);
			$append = str_replace("p", "图", $append);

			$list[$key]["append"] = $append;
			$list[$key]["typeid"] = $value["typeid"];

			$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__".$dopost."type` WHERE `id` = ". $value["typeid"]);
			$typename = $dsql->getTypeName($typeSql);

			$list[$key]["type"] = $typename[0]['typename'];
			$list[$key]["sort"] = $value["weight"];

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
			}

			$list[$key]["state"] = $state;
			$list[$key]["date"] = date('y-m-d H:i:s', $value["pubdate"]);

			$admin = $value['admin'];
			$adminame = "";
			$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $admin");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$adminame = $ret[0]['username'];
			}
			$list[$key]['admin'] = $admin;
			$list[$key]['adminame'] = $adminame;

			$param = array(
				"service"     => $dopost,
				"template"    => "detail",
				"id"          => $value['id'],
				"flag"        => $value['flag'],
				"redirecturl" => $value['redirecturl']
			);
			$list[$key]['url']        = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "articleList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}

//删除
}else if($action == "del"){

	if(!testPurview("del".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};

	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."list` SET `del` = 1 WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("转移".$dowtitle."信息至回收站", $id);
			echo '{"state": 100, "info": '.json_encode("所选信息已转移至回收站！").'}';
		}
	}

//彻底删除
}else if($action == "fullyDel"){
	if(!testPurview("del".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			//删除评论
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$dopost."common` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$dopost."list` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			array_push($title, $results[0]['title']);

			//删除缩略图
			delPicFile($results[0]['litpic'], "delThumb", $dopost);

			//删除内容图片
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$dopost."` WHERE `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			$body = $results[0]['body'];
			if(!empty($body)){
				delEditorPic($body, $dopost);
			}

			//删除图集
			$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__".$dopost."pic` WHERE `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			//删除图片文件
			if(!empty($results)){
				$atlasPic = "";
				foreach($results as $key => $value){
					$atlasPic .= $value['picPath'].",";
				}
				delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", $dopost);
			}

			$archives = $dsql->SetQuery("DELETE FROM `#@__".$dopost."pic` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$dopost."list` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除".$dotitle."信息", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
	}
	die;

//还原
}else if($action == "revert"){
	if(!testPurview("del".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."list` SET `del` = 0 WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("还原".$dowtitle."信息", $id);
			echo '{"state": 100, "info": '.json_encode("所选信息还原成功！").'}';
		}
	}

//添加属性
}else if($action == "addProperty"){
	if(!testPurview("edit".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT `flag` FROM `#@__".$dopost."list` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			$flag = $results[0]["flag"] == "" ? $attr : $results[0]["flag"] . "," . $attr;

			if(strpos($results[0]["flag"], "p") !== false){
				$flag .= ",p";
			}

			$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."list` SET `flag` = '$flag' WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");

			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("添加".$dowtitle."信息属性", $attr);
			echo '{"state": 100, "info": '.json_encode("属性添加成功！").'}';
		}
	}

//删除属性
}else if($action == "delProperty"){
	if(!testPurview("edit".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT `flag` FROM `#@__".$dopost."list` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			$flag = $results[0]["flag"];

			if(trim($flag) != ''){
				$flags  = explode(',', $flag);
				$okflags = array();
				foreach($flags as $f){
					if(!strstr($attr, $f)) $okflags[] = $f;
				}

				$flag = trim(join(',', $okflags));

				$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."list` SET `flag` = '$flag' WHERE `id` = ".$val);
				$results = $dsql->dsqlOper($archives, "update");

				if($results != "ok"){
					$error[] = $val;
				}
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除".$dowtitle."信息属性", $attr);
			echo '{"state": 100, "info": '.json_encode("属性删除成功！").'}';
		}
	}

//移动分类
}else if($action == "move"){
	if(!testPurview("edit".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."list` SET `typeid` = $typeid WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("转移".$dowtitle."信息", $id."=>".$typeid);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}

//更新状态
}else if($action == "updateState"){
	if(!testPurview("edit".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();

	global $handler;
	$handler = true;

	if($id != ""){
		foreach($each as $val){

			//会员消息通知
			memberNotice($val, $arcrank);

			//更新记录状态
			$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."list` SET `arcrank` = $arcrank WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新".$dowtitle."信息状态", $id."=>".$arcrank);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}

//获取指定ID信息详情
}else if($action == "getArticleDetail"){
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT `typeid`, `title`, `subtitle`, `flag`, `arcrank` FROM `#@__".$dopost."list` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		echo json_encode($results);
	}

//更新快速编辑信息
}else if($action == "updateDetail"){
	if(!testPurview("edit".$dopost)){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$flags    = isset($flags) ? join(',',$flags) : '';

	if($id == "") die('要修改的信息ID传递失败！');
	//对字符进行处理
	$title       = cn_substrR($title,60);
	$subtitle    = cn_substrR($subtitle,36);

	//表单二次验证
	if(trim($title) == ''){
		echo '{"state": 101, "info": '.json_encode("标题不能为空！").'}';
		exit();
	}

	if($typeid == ''){
		echo '{"state": 101, "info": '.json_encode("请选择文章分类！").'}';
		exit();
	}

	//会员消息通知
	memberNotice($id, $arcrank);

	$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."list` SET `typeid` = $typeid, `title` = '$title', `subtitle` = '$subtitle', `flag` = '$flags', `arcrank` = $arcrank WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "update");
	if($results != "ok"){
		echo $results;
	}else{
		adminLog("快速编辑".$dowtitle."信息", $id);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}

//更新文章分类
}else if($action == "typeAjax"){
	if(!testPurview("articleType")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$data = str_replace("\\", '', $_POST['data']);
	if($data != ""){
		$json = json_decode($data);

		$json = objtoarr($json);
		$json = typeAjax($json, 0, $dopost."type");
		echo $json;
	}

//获取评论详细信息
}else if($action == "getArticleCommonDetail"){
	if($id != ""){
		$archives = $dsql->SetQuery("SELECT `aid`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `ischeck` FROM `#@__".$dopost."common` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if(count($results) > 0){

			$archives = $dsql->SetQuery("SELECT `title` FROM `#@__".$dopost."list` WHERE `id` = ".$results[0]["aid"]);
			$dsqlInfo = $dsql->dsqlOper($archives, "results");

			$title = $dsqlInfo[0]["title"];
			$results[0]["title"] = $title;

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
	}

//更新评论信息
}else if($action == "updateCommonDetail"){

	if(!testPurview("edit".$dopost."Common")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};

	$dtime   = GetMkTime($commonTime);
	$ipAddr = getIpAddr($ip);

	if($id == "") die('要修改的信息ID传递失败！');

	//会员通知
	$sql = $dsql->SetQuery("SELECT l.`title`, l.`admin`, l.`pubdate`, c.`aid`, c.`userid`, c.`ischeck`, c.`dtime` FROM `#@__".$dopost."common` c LEFT JOIN `#@__".$dopost."list` l ON l.`id` = c.`aid` WHERE c.`id` = $id");
	$ret = $dsql->dsqlOper($sql, "results");
	if($ret){
		$title   = $ret[0]['title'];
		$admin   = $ret[0]['admin'];
		$pubdate = $ret[0]['pubdate'];
		$aid     = $ret[0]['aid'];
		$userid  = $ret[0]['userid'];
		$ischeck = $ret[0]['ischeck'];
		$dtime   = $ret[0]['dtime'];

		//验证评论状态
		if($ischeck != $commonIsCheck){

			$param = array(
				"service"  => $dopost,
				"template" => "detail",
				"id"       => $aid
			);

			//只有审核通过的信息才发通知
			if($commonIsCheck == 1){

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
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $admin");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}

				updateMemberNotice($admin, "会员-新评论通知", $param, array("username" => $username, "title" => $title, "date" => date("Y-m-d H:i:s", $pubdate)));
			}

		}
	}

	$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."common` SET `content` = '$commonContent', `dtime` = '".GetMkTime($commonTime)."', `ip` = '$commonIp', `good` = '$commonGood', `bad` = '$commonBad', `ischeck` = '$commonIsCheck' WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($archives, "update");
	if($results != "ok"){
		echo $results;
	}else{
		adminLog("更新".$dowtitle."评论信息", $id);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}

//更新评论状态
}else if($action == "updateCommonState"){

	if(!testPurview("edit".$dopost."Common")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};

	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){

			//会员通知
			$sql = $dsql->SetQuery("SELECT l.`title`, l.`admin`, l.`pubdate`, c.`aid`, c.`userid`, c.`ischeck`, c.`dtime` FROM `#@__".$dopost."common` c LEFT JOIN `#@__".$dopost."list` l ON l.`id` = c.`aid` WHERE c.`id` = $val");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$title   = $ret[0]['title'];
				$admin   = $ret[0]['admin'];
				$pubdate = $ret[0]['pubdate'];
				$aid     = $ret[0]['aid'];
				$userid  = $ret[0]['userid'];
				$ischeck = $ret[0]['ischeck'];
				$dtime   = $ret[0]['dtime'];

				//验证评论状态
				if($ischeck != $arcrank){

					$param = array(
						"service"  => $dopost,
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
						$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $admin");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$username = $ret[0]['username'];
						}

						updateMemberNotice($admin, "会员-新评论通知", $param, array("username" => $username, "title" => $title, "date" => date("Y-m-d H:i:s", $pubdate)));

					}

				}
			}

			$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."common` SET `ischeck` = $arcrank WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新".$dowtitle."评论信息状态", $id."=>".$arcrank);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}

//删除评论
}else if($action == "delArticleCommon"){

	if(!testPurview("del".$dopost."Common")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};

	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$dopost."common` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除".$dowtitle."评论", $id);
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
	}

//获取评论列表
}else if($action == "getCommonList"){

	if(!testPurview("articleCommon")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};

	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		//按评论内容搜索
		if($sType == 0){
			$where .= " AND `content` like '%$sKeyword%'";

		//按文章标题搜索
		}elseif($sType == "1"){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$dopost."list` WHERE `title` like '%$sKeyword%'");
			$results = $dsql->dsqlOper($archives, "results");
			if(count($results) > 0){
				$list = array();
				foreach ($results as $key=>$value) {
					$list[] = $value["id"];
				}
				$idList = join(",", $list);
				$where .= " AND `aid` in ($idList)";
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

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$dopost."common`");

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
	$archives = $dsql->SetQuery("SELECT `id`, `aid`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `ischeck` FROM `#@__".$dopost."common` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["articleId"] = $value["aid"];

			$typeSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__".$dopost."list` WHERE `id` = ". $value["aid"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["articleTitle"] = $typename[0]['title'];

			$param = array(
				"service"  => "article",
				"template" => "detail",
				"id"       => $typename[0]['id']
			);
			$list[$key]["articleUrl"] = getUrlPath($param);

			$list[$key]["commonUserId"] = $value["userid"];
			$list[$key]["commonUser"]  = $value["userid"];

			$member = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ".$value["userid"]);
			$username = $dsql->dsqlOper($member, "results");
			$list[$key]["commonUserName"]  = $username[0]["username"] == null ? "游客" : $username[0]["username"];

			$list[$key]["commonContent"] = $value["content"];
			$list[$key]["commonTime"] = date('Y-m-d H:i:s', $value["dtime"]);
			$list[$key]["commonIp"] = $value["ip"];
			$list[$key]["commonIpAddr"] = $value["ipaddr"];

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

			$list[$key]["commonIsCheck"] = $state;
		}
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "commonList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}

//选择来源、作者
}elseif ($action == "chooseData"){
	if($type != ""){
		$m_file = HUONIAODATA."/admin/".$type.".txt";
		$list = array();
		if(filesize($m_file)>0){
			$fp = fopen($m_file,'r');
			$str = fread($fp,filesize($m_file));
			fclose($fp);
			$strs = explode(',',$str);
			foreach($strs as $str){
				$str = trim($str);
				if($str!=""){
					array_push($list, $str);
				}
			}
		}
		echo json_encode($list);
	}

//保存来源、作者
}elseif ($action == "saveChooseData"){
	if($type != ""){
		$m_file = HUONIAODATA."/admin/".$type.".txt";
		adminLog("更新".$type."信息", $type.".txt");

		$fp = fopen($m_file, "w") or die("写入文件 $m_file 失败，请检查权限！");
		fwrite($fp, $val);
		fclose($fp);
	}

//配置站内链接
}elseif ($action == "allowurl"){
	$m_file = HUONIAODATA."/admin/allowurl.txt";
	$list = array();
	if(filesize($m_file)>0){
		$fp = fopen($m_file,'r');
		$str = fread($fp,filesize($m_file));
		fclose($fp);
	}
	echo $str;

//保存站内链接
}elseif ($action == "saveAllowurl"){
	$m_file = HUONIAODATA."/admin/allowurl.txt";
	adminLog("更新站内允许链接", "allowurl.txt");

	$fp = fopen($m_file, "w") or die("写入文件 $m_file 失败，请检查权限！");
	fwrite($fp, $val);
	fclose($fp);

}else{
	echo '{"state": 200, "info": '.json_encode("操作失败，参数错误！").'}';
}






//会员消息通知
function memberNotice($id, $arcrank){
	global $dsql;
	global $userLogin;
	global $handler;
	global $dopost;
	$handler = true;

	//查询信息之前的状态
	$sql = $dsql->SetQuery("SELECT `title`, `arcrank`, `admin`, `pubdate` FROM `#@__".$dopost."list` WHERE `id` = $id");
	$ret = $dsql->dsqlOper($sql, "results");
	if($ret){

		$title    = $ret[0]['title'];
		$arcrank_ = $ret[0]['arcrank'];
		$admin    = $ret[0]['admin'];
		$pubdate  = $ret[0]['pubdate'];

		//会员消息通知
		if($arcrank != $arcrank_){

			$state = "";
			$status = "";

			//等待审核
			if($arcrank == 0){
				$state = 0;
				$status = "进入等待审核状态。";

			//已审核
			}elseif($arcrank == 1){
				$state = 1;
				$status = "已经通过审核。";

			//审核失败
			}elseif($arcrank == 2){
				$state = 2;
				$status = "审核失败。";
			}

			$param = array(
				"service"  => "member",
				"type"     => "user",
				"template" => "manage",
				"action"   => "article"
			);

			//会员信息
			if($admin){
				$uinfo = $userLogin->getMemberInfo($admin);
				if($uinfo['userType'] == 2){
					$param = array(
						"service"  => "member",
						"template" => "manage",
						"action"   => "article"
					);
				}
			}

			$param['param'] = "state=".$state;

			//获取会员名
			$username = "";
			$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $admin");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$username = $ret[0]['username'];
			}

			updateMemberNotice($admin, "会员-发布信息审核通知", $param, array("username" => $username, "title" => $title, "status" => $status, "date" => date("Y-m-d H:i:s", $pubdate)));

		}

	}
}
