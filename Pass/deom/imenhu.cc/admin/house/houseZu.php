<?php
/**
 * 管理出租房
 *
 * @version        $Id: houseZu.php 2014-1-16 下午22:23:15 $
 * @package        HuoNiao.House
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("houseZu");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/house";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "houseZu.html";

$tab = "house_zu";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}

	if($sAddr != ""){
		if($dsql->getTypeList($sAddr, "houseaddr")){
			$lower = arr_foreach($dsql->getTypeList($sAddr, "houseaddr"));
			$lower = $sAddr.",".join(',',$lower);
		}else{
			$lower = $sAddr;
		}
		$where .= " AND `addrid` in ($lower)";
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//待审核
	$totalGray = $dsql->dsqlOper($archives." AND `state` = 0".$where, "totalCount");
	//已审核
	$totalAudit = $dsql->dsqlOper($archives." AND `state` = 1".$where, "totalCount");
	//拒绝审核
	$totalRefuse = $dsql->dsqlOper($archives." AND `state` = 2".$where, "totalCount");

	if($state != ""){
		$where .= " AND `state` = $state";

		if($state == 0){
			$totalPage = ceil($totalGray/$pagestep);
		}elseif($state == 1){
			$totalPage = ceil($totalAudit/$pagestep);
		}elseif($state == 2){
			$totalPage = ceil($totalRefuse/$pagestep);
		}
	}

	$where .= " order by `pubdate` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `litpic`, `communityid`, `community`, `price`, `usertype`, `userid`, `username`, `contact`, `state`, `weight`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["litpic"] = $value["litpic"];

			//小区
			$list[$key]["communityid"] = $value["communityid"];
			if($value['communityid'] == 0){
				$list[$key]["community"] = $value["community"];
			}else{
				$communitySql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__house_community` WHERE `id` = ". $value["communityid"]);
				$communityResult = $dsql->getTypeName($communitySql);
				if(!$communityResult){
					$list[$key]["community"] = "小区不存在";
				}else{
					$list[$key]["community"] = $communityResult[0]["title"];
				}
			}

			$param = array(
				"service"   => "house",
				"tempalter" => "community-detail",
				"id"        => $value['communityid']
			);
			$list[$key]['communityUrl'] = getUrlPath($param);

			$list[$key]["price"] = $value["price"];

			$list[$key]["usertype"] = $value["usertype"];
			$list[$key]["userid"] = $value["userid"];

			$username = $contact = "无";
			if($value['userid'] != 0 && $value['usertype'] == 1){
				//会员
				$userSql = $dsql->SetQuery("SELECT `userid` FROM `#@__house_zjuser` WHERE `id` = ". $value['userid']);
				$username = $dsql->getTypeName($userSql);
				if($username){
					$userSql = $dsql->SetQuery("SELECT `username`, `phone` FROM `#@__member` WHERE `id` = ". $username[0]["userid"]);
					$username = $dsql->getTypeName($userSql);
					$contact = $username[0]["phone"];
					$username = $username[0]["username"];
				}
			}else{
				//会员
				//$userSql = $dsql->SetQuery("SELECT `username`, `contact` FROM `#@__house_zjuser` WHERE `id` = ". $value['userid']);
				//$username = $dsql->getTypeName($userSql);
				//$contact = $username[0]["contact"];
				//$username = $username[0]["username"];
				$contact = $value["contact"];
				$username = $value["username"];
			}
			$list[$key]["username"] = $username;
			$list[$key]["contact"] = $contact;

			$list[$key]["state"] = $value["state"];
			$list[$key]["weight"] = $value["weight"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"  => "house",
				"template" => "zu-detail",
				"id"       => $value['id']
			);
			$list[$key]['url'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "houseZu": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if(!testPurview("houseZuDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			//删除缩略图
			array_push($title, $results[0]['title']);
			delPicFile($results[0]['litpic'], "delThumb", "house");

			//删除内容图片
			$body = $results[0]['note'];
			if(!empty($body)){
				delEditorPic($body, "house");
			}

			//图集
			$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			//删除图片文件
			if(!empty($results)){
				$atlasPic = "";
				foreach($results as $key => $value){
					$atlasPic .= $value['picPath'].",";
				}
				delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
			}

			$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");

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
			adminLog("删除出租房信息", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
		die;

	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("houseZuEdit")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `state` = ".$state." WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("更新出租房状态", $id."=>".$state);
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
		'admin/house/houseZu.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->assign('notice', $notice);

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "houseaddr")));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/house";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
