<?php
/**
 * 管理家具公司
 *
 * @version        $Id: furnitureStoreList.php 2014-3-1 上午00:45:05 $
 * @package        HuoNiao.Furniture
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("furnitureStoreList");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/furniture";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "furnitureStoreList.html";

$tab = "furniture_store";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND `company` like '%$sKeyword%'";
	}

	if($sAddr != ""){
		if($dsql->getTypeList($sAddr, "furnitureaddr")){
			$lower = arr_foreach($dsql->getTypeList($sAddr, "furnitureaddr"));
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

	$where .= " order by `weight` desc, `pubdate` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `company`, `logo`, `addrid`, `userid`, `contact`, `state`, `weight`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["company"] = $value["company"];
			$list[$key]["logo"] = $value["logo"];

			$list[$key]["addrid"] = $value["addrid"];

			//地区
			$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__furnitureaddr` WHERE `id` = ". $value["addrid"]);
			$typename = $dsql->getTypeName($typeSql);
			$list[$key]["addr"] = $typename[0]['typename'];

			$list[$key]["userid"] = $value["userid"];
			if($value["userid"] == 0){
				$list[$key]["username"] = $value["username"];
			}else{
				$userSql = $dsql->SetQuery("SELECT `id`, `username` FROM `#@__member` WHERE `id` = ". $value['userid']);
				$username = $dsql->getTypeName($userSql);
				$list[$key]["username"] = $username[0]["username"];
			}

			$list[$key]["contact"] = $value["contact"];
			$list[$key]["state"] = $value["state"];
			$list[$key]["weight"] = $value["weight"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"  => "furniture",
				"template" => "store-detail",
				"id"       => $value['id']
			);
			$list[$key]["url"] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "furnitureStoreList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if(!testPurview("furnitureStoreDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			//删除下属商品 start
			$archives = $dsql->SetQuery("SELECT * FROM `#@__furniture_product` WHERE `company` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			foreach($results as $k => $v){
				//删除评论
				$archives = $dsql->SetQuery("DELETE FROM `#@__furniture_common` WHERE `aid` = ".$v['id']);
				$dsql->dsqlOper($archives, "update");

				//删除缩略图
				delPicFile($v['litpic'], "delThumb", "furniture");

				//删除图集
				$pics = explode(",", $v['pics']);
				foreach($pics as $k_ => $v_){
					delPicFile($v_, "delAtlas", "furniture");
				}

				//删除内容图片
				$body = $v['body'];
				if(!empty($body)){
					delEditorPic($body, "furniture");
				}

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__furniture_product` WHERE `id` = ".$v['id']);
				$dsql->dsqlOper($archives, "update");
			}
			//删除下属商品 end

			//删除促销活动
			$archives = $dsql->SetQuery("SELECT * FROM `#@__furniture_sale` WHERE `company` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $v){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__furniture_sale` WHERE `id` = ".$v['id']);
				$results = $dsql->dsqlOper($archives, "results");
				array_push($title, $results[0]['title']);
				//删除内容图片
				$body = $results[0]['body'];
				if(!empty($body)){
					delEditorPic($body, "furniture");
				}

				//删除资讯
				$archives = $dsql->SetQuery("DELETE FROM `#@__furniture_sale` WHERE `id` = ".$val);
				$results = $dsql->dsqlOper($archives, "update");
			}

			//删除留言
			$archives = $dsql->SetQuery("DELETE FROM `#@__furniture_guest` WHERE `company` = ".$val);
			$dsql->dsqlOper($archives, "update");

			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			//删除缩略图
			array_push($title, $results[0]['title']);
			delPicFile($results[0]['logo'], "delLogo", "furniture");

			//删除域名配置
			$archives = $dsql->SetQuery("DELETE FROM `#@__domain` WHERE `module` = 'furniture' AND `part` = '$tab' AND `iid` = ".$val);
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
			adminLog("删除家具公司", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;

	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("furnitureStoreEdit")){
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
			adminLog("更新家具公司状态", $id."=>".$state);
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
		'admin/furniture/furnitureStoreList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->assign('notice', $notice);

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "furnitureaddr")));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/furniture";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
