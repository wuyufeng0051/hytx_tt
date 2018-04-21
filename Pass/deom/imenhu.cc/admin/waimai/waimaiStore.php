<?php
/**
 * 外卖餐厅管理
 *
 * @version        $Id: waimaiStore.php 2014-10-21 上午09:37:15 $
 * @package        HuoNiao.Waimai
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("waimaiStore");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "waimai_store";

if($dopost != ""){
	$templates = "waimaiStoreAdd.html";

	//js
	$jsFile = array(
		'ui/bootstrap-datetimepicker.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/waimai/waimaiStoreAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "waimaiStore.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/waimai/waimaiStore.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$typeid     = isset($typeid) ? join(',',$typeid) : '';
	$online     = (int)$online;
	$supfapiao  = (int)$supfapiao;
	$fapiao     = (int)$fapiao;
	$fapiaonote = cn_substrR($fapiaonote, 20);
	$pubdate    = GetMkTime(time());       //发布时间

	//二次验证
	if($userid == 0 && trim($user) == ''){
		echo '{"state": 200, "info": "请选择管理会员"}';
		exit();
	}else{
		if($userid == 0){
			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` = '".$user."'");
			$userResult = $dsql->dsqlOper($userSql, "results");
			if(!$userResult){
				echo '{"state": 200, "info": "会员不存在，请重新选择"}';
				exit();
			}
			$userid = $userResult[0]['id'];
		}else{
			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `id` = ".$userid);
			$userResult = $dsql->dsqlOper($userSql, "results");
			if(!$userResult){
				echo '{"state": 200, "info": "会员不存在，请在联想列表中选择"}';
				exit();
			}
		}
	}

	//检测是否已经注册
	if($dopost == "Add"){

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = '".$userid."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它餐厅！"}';
			exit();
		}

	}else{

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = '".$userid."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它餐厅！"}';
			exit();
		}

	}

	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入餐厅名称"}';
		exit();
	}

	if(empty($typeid)){
		echo '{"state": 200, "info": "请选择所属菜系"}';
		exit();
	}

	if(trim($litpic) == ""){
		echo '{"state": 200, "info": "请上传餐厅logo"}';
		exit();
	}

	if(empty($start1) || empty($end1) || empty($start2) || empty($end2)){
		echo '{"state": 200, "info": "请选择营业时间"}';
		exit();
	}

	if(empty($times)){
		echo '{"state": 200, "info": "请选择平均送达时间"}';
		exit();
	}

	if(empty($addr)){
		echo '{"state": 200, "info": "请选择餐厅所在区域"}';
		exit();
	}

	if(empty($address)){
		echo '{"state": 200, "info": "请输入餐厅地址"}';
		exit();
	}

	if(empty($lnglat)){
		echo '{"state": 200, "info": "请选择餐厅地图坐标"}';
		exit();
	}

	if(empty($tel)){
		echo '{"state": 200, "info": "请输入餐厅电话"}';
		exit();
	}

	if(empty($range)){
		echo '{"state": 200, "info": "请选择配送区域"}';
		exit();
	}

	if(empty($note)){
		echo '{"state": 200, "info": "请输入餐厅介绍"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}

	if($sType != ""){
		$where .= " AND FIND_IN_SET($sType, `typeid`)";
	}

	if($sAddr != ""){
		if($dsql->getTypeList($sAddr, "waimai_addr")){
			$lower = arr_foreach($dsql->getTypeList($sAddr, "waimai_addr"));
			$lower = $sAddr.",".join(',',$lower);
		}else{
			$lower = $sAddr;
		}
		$where .= " AND `addr` in ($lower)";
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
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `logo`, `online`, `supfapiao`, `userid`, `start1`, `end1`, `start2`, `end2`, `addr`, `tel`, `yingye`, `weisheng`, `price`, `state` , `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["online"] = $value["online"];
			$list[$key]["supfapiao"] = $value["supfapiao"];

			$list[$key]["logo"] = $value["logo"];

			$list[$key]["userid"] = $value["userid"];
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value['userid']);
			$username = $dsql->getTypeName($userSql);
			if($username){
				$list[$key]["username"] = $username[0]["username"];
			}else{
				$list[$key]["username"] = '无';
			}

			$list[$key]["yingyeshijian"] = $value["start1"]."-".$value["end1"]."<br />".$value["start2"]."-".$value["end2"];

			$list[$key]["addrid"] = $value["addr"];
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__waimai_addr` WHERE `id` = ". $value["addr"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$list[$key]["addrName"] = $itemResult[0]['typename'];

			$list[$key]["tel"] = $value["tel"];
			$list[$key]["yingye"] = $value["yingye"];
			$list[$key]["weisheng"] = $value["weisheng"];
			$list[$key]["state"] = $value["state"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"     => "waimai",
				"template"    => "shop",
				"id"          => $value['id']
			);
			$list[$key]['url'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "waimaiStore": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//新增
}elseif($dopost == "Add"){
	checkPurview("waimaiStoreAdd");

	$pagetitle = "添加新餐厅";

	//表单提交
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`userid`, `title`, `typeid`, `logo`, `start1`, `end1`, `start2`, `end2`, `times`, `addr`, `address`, `lnglat`, `tel`, `range`, `price`, `peisong`, `online`, `sale`, `supfapiao`, `fapiao`, `fapiaonote`, `note`, `notice`, `yingye`, `yingyezhizhao`, `weisheng`, `weishengxuke`, `state`, `pubdate`) VALUES ('$userid', '$title', '$typeid', '$litpic', '$start1', '$end1', '$start2', '$end2', '$times', '$addr', '$address', '$lnglat', '$tel', '$range', '$price', '$peisong', '$online', '$sale', '$supfapiao', '$fapiao', '$fapiaonote', '$note', '$notice', '$yingye', '$yingyezhizhao', '$weisheng', '$weishengxuke', '$state', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if($aid){
			adminLog("添加新餐厅", $title);

			$param = array(
				"service"     => "waimai",
				"template"    => "shop",
				"id"          => $aid
			);
			$url = getUrlPath($param);

			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").', "url": "'.$url.'"}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("waimaiStoreEdit");

	$pagetitle = "修改餐厅";

	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `userid` = '$userid', `title` = '$title', `typeid` = '$typeid', `logo` = '$litpic', `start1` = '$start1', `end1` = '$end1', `start2` = '$start2', `end2` = '$end2', `times` = '$times', `addr` = '$addr', `address` = '$address', `lnglat` = '$lnglat', `tel` = '$tel', `range` = '$range', `price` = '$price', `peisong` = '$peisong', `online` = '$online', `sale` = '$sale', `supfapiao` = '$supfapiao', `fapiao` = '$fapiao', `fapiaonote` = '$fapiaonote', `note` = '$note', `notice` = '$notice', `yingye` = '$yingye', `yingyezhizhao` = '$yingyezhizhao', `weisheng` = '$weisheng', `weishengxuke` = '$weishengxuke', `state` = '$state' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			adminLog("修改餐厅", $title);

			$param = array(
				"service"     => "waimai",
				"template"    => "shop",
				"id"          => $id
			);
			$url = getUrlPath($param);
			echo '{"state": 100, "info": '.json_encode("修改成功！").', "url": "'.$url.'"}';
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

				$userid        = $results[0]['userid'];
				$title         = $results[0]['title'];
				$typeid        = $results[0]['typeid'];
				$logo          = $results[0]['logo'];
				$start1        = $results[0]['start1'];
				$end1          = $results[0]['end1'];
				$start2        = $results[0]['start2'];
				$end2          = $results[0]['end2'];
				$times         = $results[0]['times'];
				$addr          = $results[0]['addr'];
				$address       = $results[0]['address'];
				$lnglat        = $results[0]['lnglat'];
				$tel           = $results[0]['tel'];
				$range         = $results[0]['range'];
				$price         = $results[0]['price'];
				$peisong       = $results[0]['peisong'];
				$online        = $results[0]['online'];
				$sale          = $results[0]['sale'];
				$supfapiao     = $results[0]['supfapiao'];
				$fapiao        = $results[0]['fapiao'];
				$fapiaonote    = $results[0]['fapiaonote'];
				$note          = $results[0]['note'];
				$notice        = $results[0]['notice'];
				$yingye        = $results[0]['yingye'];
				$yingyezhizhao = $results[0]['yingyezhizhao'];
				$weisheng      = $results[0]['weisheng'];
				$weishengxuke  = $results[0]['weishengxuke'];
				$state         = $results[0]['state'];

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
	if(!testPurview("waimaiStoreDel")){
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
			delPicFile($results[0]['logo'], "delThumb", "waimai");
			delPicFile($results[0]['yingyezhizhao'], "delCard", "waimai");
			delPicFile($results[0]['weishengxuke'], "delCard", "waimai");

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
			adminLog("删除餐厅", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;

	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("waimaiStoreEdit")){
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
			adminLog("更新餐厅状态", $id."=>".$state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;

//管理应用分类
}elseif($dopost == "getType"){
	if(empty($store)) die;
	$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_".$action."_type` WHERE `store` = $store ORDER BY `weight` ASC, `id` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$types = array();
	if($results){
		foreach($results as $key => $val){
			$types[$key]['id'] = $val['id'];
			$types[$key]['val'] = $val['typename'];
		}
	}
	echo json_encode($types);
	die;

//修改应用分类
}elseif($dopost == "updateType"){
	if(empty($store)) die;
	$data = str_replace("\\", '', $_POST['data']);
	if($data == "") die;
	$json = json_decode($data);

	$json = objtoarr($json);
	foreach($json as $key => $val){
		if($val['id'] != ""){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_".$action."_type` WHERE `id` = ".$val['id']);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$where = array();
				if($results[0]['weight'] != $val['weight']){
					$where[] = '`weight` = '.$val['weight'];
				}
				if($results[0]['typename'] != $val['val']){
					$where[] = '`typename` = "'.$val['val'].'"';
				}
				if(!empty($where)){
					$archives = $dsql->SetQuery("UPDATE `#@__waimai_".$action."_type` SET ".join(",", $where)." WHERE `id` = ".$val['id']);
					$dsql->dsqlOper($archives, "update");
				}
			}
		}else{
			if(!empty($val['val'])){
				$archives = $dsql->SetQuery("INSERT INTO `#@__waimai_".$action."_type` (`store`, `typename`, `weight`) VALUES ($store, '".$val['val']."', ".$val['weight'].")");
				$dsql->dsqlOper($archives, "update");
			}
		}
	}
	$appstypeList = array();
	array_push($appstypeList, array("id" => 0, "name" => "请选择"));
	$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_".$action."_type` WHERE `store` = $store ORDER BY `weight` ASC, `id` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	if($results){
		foreach($results as $key => $val){
			array_push($appstypeList, $val);
		}
	}
	echo json_encode($appstypeList);
	die;

//删除分类
}elseif($dopost == "delType"){
	if(!empty($id)){
		//删除分类
		$archives = $dsql->SetQuery("DELETE FROM `#@__waimai_".$action."_type` WHERE `id` = ".$id);
		$dsql->dsqlOper($archives, "update");
	}
	die;

//根据关键字获取餐厅
}elseif($dopost == "checkWaimaiStore"){
	$key = trim($_POST['key']);
	if(!empty($key)){
		$sql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__waimai_store` WHERE `title` like '%$key%' LIMIT 0, 10");
		$result = $dsql->dsqlOper($sql, "results");
		echo json_encode($result);
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	require_once(HUONIAOINC."/config/waimai.inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_thumbSize;
		global $custom_thumbType;
		$huoniaoTag->assign('thumbSize', $custom_thumbSize);
		$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
	}
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('mapCity', $cfg_mapCity);
	$huoniaoTag->assign('addr', (int)$addr);

	if($dopost != ""){

		if($dopost == "edit"){

			//会员信息
			$huoniaoTag->assign('userid', $userid);
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
			$username = $dsql->getTypeName($userSql);
			$huoniaoTag->assign('username', $username[0]['username']);

			$huoniaoTag->assign('id', $id);
			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('logo', $logo);
			$huoniaoTag->assign('start1', $start1);
			$huoniaoTag->assign('end1', $end1);
			$huoniaoTag->assign('start2', $start2);
			$huoniaoTag->assign('end2', $end2);
			$huoniaoTag->assign('times', $times);
			$huoniaoTag->assign('address', $address);
			$huoniaoTag->assign('lnglat', $lnglat);
			$huoniaoTag->assign('tel', $tel);
			$huoniaoTag->assign('range', $range);
			$huoniaoTag->assign('price', $price);
			$huoniaoTag->assign('peisong', $peisong);
			$huoniaoTag->assign('fapiao', $fapiao);

			if(!empty($sale)){
				$saleHtml = "";
				$saleArr = explode("$$", $sale);
				foreach ($saleArr as $key => $value) {
					$sval = explode(",", $value);
					$saleHtml .= '<div class="input-prepend input-append" style="display: block;"><span class="add-on">满</span><input class="input-mini j1" type="text" value="'.$sval[0].'"><span class="add-on">减</span><input class="input-mini j2" type="text" value="'.$sval[1].'"><span class="add-on"><a href="javascript:;" class="del"><i class="icon-trash"></i></a></span></div>';
				}
				$huoniaoTag->assign('sale', $saleHtml);
			}

			$huoniaoTag->assign('fapiaonote', $fapiaonote);
			$huoniaoTag->assign('note', $note);
			$huoniaoTag->assign('notice', $notice);
			$huoniaoTag->assign('yingyezhizhao', $yingyezhizhao);
			$huoniaoTag->assign('weishengxuke', $weishengxuke);

		}

		//菜系
		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_type` ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = $val = array();
		foreach($results as $value){
			$list[] = $value['typename'];
			$val[] = $value['id'];
		}
		$huoniaoTag->assign('typeList', $list);
		$huoniaoTag->assign('typeValue', $val);
		$huoniaoTag->assign('type', $typeid == "" ? 0 : explode(",", $typeid));

		$huoniaoTag->assign('online', (int)$online);
		$huoniaoTag->assign('supfapiao', (int)$supfapiao);

		//认证
		$huoniaoTag->assign('rzopt', array('0', '1', '2'));
		$huoniaoTag->assign('rznames',array('待认证','已认证','认证拒绝'));

		$huoniaoTag->assign('yingye', (int)$yingye);
		$huoniaoTag->assign('weisheng', (int)$weisheng);

		//显示状态
		$huoniaoTag->assign('stateopt', array('0', '1', '2'));
		$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
		$huoniaoTag->assign('state', $state == "" ? 1 : $state);
	}

	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, "waimai_type")));
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "waimai_addr")));

	$huoniaoTag->assign('notice', $notice);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/waimai";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
