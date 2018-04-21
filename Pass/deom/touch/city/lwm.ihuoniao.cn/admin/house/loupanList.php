<?php
/**
 * 管理楼盘
 *
 * @version        $Id: loupanList.php 2014-1-9 下午20:53:13 $
 * @package        HuoNiao.House
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("loupanList");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/house";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "loupanList.html";

$tab = "house_loupan";

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

	if($property !== ""){
		if(is_numeric($property)){
			$where .= " AND `salestate` = $property";
		}elseif($property == "hot"){
			$where .= " AND `hot` = 1";
		}elseif($property == "rec"){
			$where .= " AND `rec` = 1";
		}elseif($property == "tuan"){
			$where .= " AND `tuan` = 1";
		}

		$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
		$totalPage = ceil($totalCount/$pagestep);
	}

	$where .= " order by `id` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `litpic`, `addrid`, `userid`, `weight`, `price`, `ptype`, `views`, `state`, `salestate`, `pubdate`, `hot`, `rec`, `tuan` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["addrid"] = $value["addrid"];

			//地区
			$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__houseaddr` WHERE `id` = ". $value["addrid"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["addr"] = $typename[0]['typename'];

			$list[$key]["userid"] = $value["userid"];

			$username = "无";
			if($value['userid'] != 0){
				//会员
				$gwSql = $dsql->SetQuery("SELECT `userid` FROM `#@__house_gw` WHERE `id` = ". $value["userid"]);
				$gwname = $dsql->getTypeName($gwSql);
				if($gwname){
					$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $gwname[0]['userid']);
					$username = $dsql->getTypeName($userSql);
					$username = $username[0]['username'];
				}
			}
			$list[$key]["username"] = $username;

			$list[$key]["weight"] = $value["weight"];
			$list[$key]["price"] = $value["price"];
			$list[$key]["ptype"] = $value["ptype"];
			$list[$key]["views"] = $value["views"];
			$list[$key]["state"] = $value["state"];
			$list[$key]["salestate"] = $value["salestate"];
			$list[$key]["hot"] = $value["hot"];
			$list[$key]["rec"] = $value["rec"];
			$list[$key]["tuan"] = $value["tuan"];
			$list[$key]["date"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"  => "house",
				"template" => "loupan-detail",
				"id"       => $value['id']
			);
			$list[$key]["url"] = getUrlPath($param);

		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "loupanList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if(!testPurview("loupanDel")){
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

			//删除楼盘缩略图
			delPicFile($results[0]['litpic'], "delThumb", "house");

			//删除房源
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_listing` WHERE `loupan` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $listing){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__house_listing` WHERE `id` = ".$listing['id']);
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
				$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'listing' AND `aid` = ".$listing['id']);
				$results = $dsql->dsqlOper($archives, "results");

				//删除图片文件
				if(!empty($results)){
					$atlasPic = "";
					foreach($results as $key => $value){
						$atlasPic .= $value['picPath'].",";
					}
					delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
				}

				$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'listing' AND `aid` = ".$listing['id']);
				$results = $dsql->dsqlOper($archives, "update");

				//删除降价通知
				$archives = $dsql->SetQuery("DELETE FROM `#@__house_notice` WHERE `action` = 'loupan' AND `htype` = 1 AND `aid` = ".$listing['id']);
				$results = $dsql->dsqlOper($archives, "update");

				//删除房源表
				$archives = $dsql->SetQuery("DELETE FROM `#@__house_listing` WHERE `id` = ".$listing['id']);
				$results = $dsql->dsqlOper($archives, "update");
			}

			//删除户型
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_apartment` WHERE `action` = 'loupan' AND `loupan` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $apartment){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__house_apartment` WHERE `id` = ".$apartment['id']);
					$results = $dsql->dsqlOper($archives, "results");

					//删除缩略图
					array_push($title, $results[0]['title']);
					delPicFile($results[0]['litpic'], "delThumb", "house");

					//图集
					$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'apartmentloupan' AND `aid` = ".$apartment['id']);
					$results = $dsql->dsqlOper($archives, "results");

					//删除图片文件
					if(!empty($results)){
						$atlasPic = "";
						foreach($results as $key => $value){
							$atlasPic .= $value['picPath'].",";
						}
						delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'apartmentloupan' AND `aid` = ".$apartment['id']);
					$results = $dsql->dsqlOper($archives, "update");

					//删除户型表
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_apartment` WHERE `id` = ".$apartment['id']);
					$results = $dsql->dsqlOper($archives, "update");
				}
			}

			//删除相册
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_album` WHERE `action` = 'loupan' AND `loupan` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $album){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__house_album` WHERE `id` = ".$album['id']);
					$results = $dsql->dsqlOper($archives, "results");

					//删除缩略图
					array_push($title, $results[0]['title']);
					delPicFile($results[0]['litpic'], "delThumb", "house");

					//图集
					$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'albumloupan' AND `aid` = ".$album['id']);
					$results = $dsql->dsqlOper($archives, "results");

					//删除图片文件
					if(!empty($results)){
						$atlasPic = "";
						foreach($results as $key => $value){
							$atlasPic .= $value['picPath'].",";
						}
						delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'albumloupan' AND `aid` = ".$album['id']);
					$results = $dsql->dsqlOper($archives, "update");

					//删除相册表
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_album` WHERE `id` = ".$album['id']);
					$results = $dsql->dsqlOper($archives, "update");
				}
			}

			//删除评论
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__housecommon` WHERE `action` = 'loupan' AND `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $common){
					$archives = $dsql->SetQuery("DELETE FROM `#@__housecommon` WHERE `id` = ".$common['id']);
					$results = $dsql->dsqlOper($archives, "update");
				}
			}

			//删除资讯
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_loupannews` WHERE `loupan` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $news){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__house_loupannews` WHERE `id` = ".$news['id']);
					$results = $dsql->dsqlOper($archives, "results");

					//删除内容图片
					$body = $results[0]['body'];
					if(!empty($body)){
						delEditorPic($body, "house");
					}

					//删除资讯
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_loupannews` WHERE `id` = ".$news['id']);
					$results = $dsql->dsqlOper($archives, "update");
				}
			}

			//删除降价通知
			$archives = $dsql->SetQuery("DELETE FROM `#@__house_notice` WHERE `action` = 'loupan' AND `htype` = 0 AND `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");

			//删除团购报名
			$archives = $dsql->SetQuery("DELETE FROM `#@__house_loupantuan` WHERE `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");

			//删除楼盘
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除楼盘信息", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;

	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("loupanEdit")){
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
			adminLog("更新楼盘状态", $id."=>".$state);
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
		'admin/house/loupanList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "houseaddr")));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/house";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
