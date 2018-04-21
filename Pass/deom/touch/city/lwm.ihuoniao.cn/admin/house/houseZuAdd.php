<?php
/**
 * 添加出租房
 *
 * @version        $Id: houseZuAdd.php 2014-1-8 下午16:34:13 $
 * @package        HuoNiao.House
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/house";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "houseZuAdd.html";

$tab = "house_zu";
$dopost = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改
if($dopost == "edit"){
	$pagetitle = "修改出租房";
	checkPurview("houseZuEdit");
}else{
	$pagetitle = "添加出租房";
	checkPurview("houseZuAdd");
}

if(empty($communityid)) $communityid = 0;
if(empty($addrid)) $addrid = 0;
if(empty($price)) $price = 0;
if(empty($bno)) $bno = 0;
if(empty($floor)) $floor = 0;
if(empty($buildage)) $buildage = 0;
if(empty($weight)) $weight = 1;
if(empty($state)) $state = 0;
if(empty($userid)) $userid = 0;
if(!empty($config)) $config = join(",", $config);

if($_POST['submit'] == "提交"){

	if($token == "") die('token传递失败！');
	//二次验证
	if(empty($title)){
		echo '{"state": 200, "info": "请输入出租房名称！"}';
		exit();
	}

	if(trim($communityid) != 0){
		$communitySql = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `id` = ".$communityid);
		$communityResult = $dsql->dsqlOper($communitySql, "results");
		if(!$communityResult){
			echo '{"state": 200, "info": "小区不存在，请在联想列表中选择"}';
			exit();
		}
	}else{
		if(empty($community)){
			echo '{"state": 200, "info": "请输入小区名称！"}';
			exit();
		}
		if(empty($addrid)){
			echo '{"state": 200, "info": "请选择小区所处区域！"}';
			exit();
		}
		if(empty($address)){
			echo '{"state": 200, "info": "请输入小区详细地址！"}';
			exit();
		}
	}

	if($usertype == 0){
		if(empty($username)){
			echo '{"state": 200, "info": "请输入联系人！"}';
			exit();
		}
		if(empty($contact)){
			echo '{"state": 200, "info": "请输入联系电话！"}';
			exit();
		}
	}else{
		if($userid == 0 && trim($user) == ''){
			echo '{"state": 200, "info": "请选择中介"}';
			exit();
		}
		if($userid == 0){
			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` = '".$user."'");
			$userResult = $dsql->dsqlOper($userSql, "results");
			if(!$userResult){
				echo '{"state": 200, "info": "会员不存在，请重新选择"}';
				exit();
			}
			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = '".$userResult[0]['id']."'");
			$userResult = $dsql->dsqlOper($userSql, "results");
			if(!$userResult){
				echo '{"state": 200, "info": "经纪人不存在，请在联想列表中选择"}';
				exit();
			}

			$userid = $userResult[0]['id'];
		}else{
			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `id` = ".$userid);
			$userResult = $dsql->dsqlOper($userSql, "results");
			if(!$userResult){
				echo '{"state": 200, "info": "经纪人不存在，请在联想列表中选择"}';
				exit();
			}
		}
	}

	if(trim($note) == ""){
		echo '{"state": 200, "info": "请输入房源介绍"}';
		exit();
	}

}

if($dopost == "save" && $submit == "提交"){
	//保存到表
	$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`title`, `communityid`, `community`, `addrid`, `address`, `litpic`, `price`, `paytype`, `rentype`, `protype`, `room`, `hall`, `guard`, `sharetype`, `sharesex`, `bno`, `floor`, `area`, `direction`, `zhuangxiu`, `buildage`, `config`, `usertype`, `userid`, `username`, `contact`, `note`, `mbody`, `weight`, `state`, `pubdate`) VALUES ('$title', '$communityid', '$community', '$addrid', '$address', '$litpic', '$price', '$paytype', '$rentype', '$protype', '$room', '$hall', '$guard', '$sharetype', '$sharesex', '$bno', '$floor', '$area', '$direction', '$zhuangxiu', '$buildage', '$config', '$usertype', '$userid', '$username', '$contact', '$note', '$mbody', '$weight', '$state', '".GetMkTime(time())."')");
	$aid = $dsql->dsqlOper($archives, "lastid");

	//保存图集表
	if($imglist != ""){
		$picList = explode(",",$imglist);
		foreach($picList as $k => $v){
			$picInfo = explode("|", $v);
			$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housezu', '$aid', '$picInfo[0]', '$picInfo[1]')");
			$dsql->dsqlOper($pics, "update");
		}
	}

	if($aid){
		adminLog("添加出租房信息", $title);
		$param = array(
			"service"  => "house",
			"template" => "zu-detail",
			"id"       => $aid
		);
		$url = getUrlPath($param);

		echo '{"state": 100, "url": "'.$url.'"}';
	}else{
		echo '{"state": 200, "info": '.json_encode("保存到数据库失败！").'}';
	}
	die;
}elseif($dopost == "edit"){

	if($submit == "提交"){
		//保存到表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `communityid` = '$communityid', `community` = '$community', `addrid` = '$addrid', `address` = '$address', `litpic` = '$litpic', `price` = '$price', `paytype` = '$paytype', `rentype` = '$rentype', `protype` = '$protype', `room` = '$room', `hall` = '$hall', `guard` = '$guard', `sharetype` = '$sharetype', `sharesex` = '$sharesex', `bno` = '$bno', `floor` = '$floor', `area` = '$area', `direction` = '$direction', `zhuangxiu` = '$zhuangxiu', `buildage` = '$buildage', `config` = '$config', `usertype` = '$usertype', `userid` = '$userid', `username` = '$username', `contact` = '$contact', `note` = '$note', `mbody` = '$mbody', `weight` = '$weight', `state` = '$state', `pubdate` = '".GetMkTime(time())."' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		//先删除文档所属图集
		$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$id);
		$dsql->dsqlOper($archives, "update");

		//保存图集表
		if($imglist != ""){
			$picList = explode(",", $imglist);
			foreach($picList as $k => $v){
				$picInfo = explode("|", $v);
				$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housezu', '$id', '$picInfo[0]', '$picInfo[1]')");
				$dsql->dsqlOper($pics, "update");
			}
		}

		if($results == "ok"){
			adminLog("修改出租房信息", $title);
			$param = array(
				"service"  => "house",
				"template" => "zu-detail",
				"id"       => $id
			);
			$url = getUrlPath($param);

			echo '{"state": 100, "info": '.json_encode('修改成功！').', "url": "'.$url.'"}';
		}else{
			echo '{"state": 200, "info": '.json_encode('修改失败！').'}';
		}
		die;
	}

	if(!empty($id)){

		//主表信息
		$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if(!empty($results)){

			$title        = $results[0]['title'];
			$communityid  = $results[0]['communityid'];
			$community    = $results[0]['community'];
			$addrid       = $results[0]['addrid'];
			$address      = $results[0]['address'];
			$litpic       = $results[0]['litpic'];
			$price        = $results[0]['price'];
			$paytype      = $results[0]['paytype'];
			$rentype      = $results[0]['rentype'];
			$protype      = $results[0]['protype'];
			$room         = $results[0]['room'];
			$hall         = $results[0]['hall'];
			$guard        = $results[0]['guard'];
			$sharetype    = $results[0]['sharetype'];
			$sharesex     = $results[0]['sharesex'];
			$bno          = $results[0]['bno'];
			$floor        = $results[0]['floor'];
			$area         = $results[0]['area'];
			$direction    = $results[0]['direction'];
			$zhuangxiu    = $results[0]['zhuangxiu'];
			$buildage     = $results[0]['buildage'];
			$config       = $results[0]['config'];
			$usertype     = $results[0]['usertype'];
			$userid       = $results[0]['userid'];
			$username     = $results[0]['username'];
			$contact      = $results[0]['contact'];
			$note         = $results[0]['note'];
			$mbody        = $results[0]['mbody'];
			$weight       = $results[0]['weight'];
			$state        = $results[0]['state'];

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$id." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $key => $value){
					$imglist[$key]["path"] = $value["picPath"];
					$imglist[$key]["info"] = $value["picInfo"];
				}
				$imglist = json_encode($imglist);
			}else{
				$imglist = "''";
			}

		}else{
			ShowMsg('要修改的信息不存在或已删除！', "-1");
			die;
		}

	}else{
		ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
		die;
	}

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/house/houseZuAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('dopost', $dopost);
	require_once(HUONIAOINC."/config/house.inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_thumbSize;
		global $custom_thumbType;
		global $custom_atlasSize;
		global $custom_atlasType;
		$huoniaoTag->assign('thumbSize', $custom_thumbSize);
		$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
		$huoniaoTag->assign('atlasSize', $custom_atlasSize);
		$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
	}
	$huoniaoTag->assign('id', $id);

	$huoniaoTag->assign('title', $title);
	$huoniaoTag->assign('communityid', $communityid);
	if($communityid == 0){
		$huoniaoTag->assign('community', $community);
	}else{
		$communitySql = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `id` = ".$communityid);
		$communityResult = $dsql->dsqlOper($communitySql, "results");
		$huoniaoTag->assign('community', $community);
	}
	$huoniaoTag->assign('address', $address);
	//区域
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "houseaddr")));
	$huoniaoTag->assign('addrid', $addrid == "" ? 0 : $addrid);

	$huoniaoTag->assign('litpic', $litpic);

	//出租方式
	$huoniaoTag->assign('rentypeopt', array('0', '1'));
	$huoniaoTag->assign('rentypenames',array('整租','合租'));
	$huoniaoTag->assign('rentype', $rentype == "" ? 0 : $rentype);

	$huoniaoTag->assign('price', $price == 0 ? "" : $price);

	//付款方式
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 5 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('paytypeList', $list);
	$huoniaoTag->assign('paytype', $paytype == "" ? 0 : $paytype);

	//物业类型
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 1 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('protypeList', $list);
	$huoniaoTag->assign('protype', $protype == "" ? 0 : $protype);

	//室
	$list = array();
	for($i = 1; $i < 11; $i++){
		$list[$i] = $i;
	}
	$huoniaoTag->assign('roomList', $list);
	$huoniaoTag->assign('room', $room == "" ? 0 : $room);
	//厅
	$list = array();
	for($i = 0; $i < 11; $i++){
		$list[$i] = $i;
	}
	$huoniaoTag->assign('hallList', $list);
	$huoniaoTag->assign('hall', $hall == "" ? 0 : $hall);
	//卫
	$list = array();
	for($i = 0; $i < 11; $i++){
		$list[$i] = $i;
	}
	$huoniaoTag->assign('guardList', $list);
	$huoniaoTag->assign('guard', $guard == "" ? 0 : $guard);

	//出租间
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 7 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('sharetypeList', $list);
	$huoniaoTag->assign('sharetype', $sharetype == "" ? 0 : $sharetype);

	//男女限制
	$huoniaoTag->assign('sharesexList', array(0 => '男女不限', 1 => '限男生', 2 => '限女生'));
	$huoniaoTag->assign('sharesex', $sharesex == "" ? 0 : $sharesex);

	$huoniaoTag->assign('bno', $bno == 0 ? "" : $bno);
	$huoniaoTag->assign('floor', $floor == 0 ? "" : $floor);
	$huoniaoTag->assign('area', $area);

	//房屋朝向
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 4 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$directionList = array(0 => '请选择');
	foreach($results as $value){
		$directionList[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('directionList', $directionList);
	$huoniaoTag->assign('direction', $direction == "" ? 0 : $direction);

	//装修情况
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 2 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('zhuangxiuList', $list);
	$huoniaoTag->assign('zhuangxiu', $zhuangxiu == "" ? 0 : $zhuangxiu);

	$huoniaoTag->assign('buildage', $buildage == 0 ? "" : $buildage);

	//房源性质
	$huoniaoTag->assign('typeopt', array('0', '1'));
	$huoniaoTag->assign('typenames',array('个人','中介'));
	$huoniaoTag->assign('usertype', $usertype == "" ? 0 : $usertype);

	$huoniaoTag->assign('userid', $userid);
	$huoniaoTag->assign('contact', $contact);
	if($usertype == 0){
		$huoniaoTag->assign('username', $username);
	}else{
		//会员
		$userSql = $dsql->SetQuery("SELECT `userid` FROM `#@__house_zjuser` WHERE `id` = ". $userid);
		$username = $dsql->getTypeName($userSql);
		if($username){
			$userSql = $dsql->SetQuery("SELECT `username`, `phone` FROM `#@__member` WHERE `id` = ". $username[0]["userid"]);
			$username = $dsql->getTypeName($userSql);
			$huoniaoTag->assign('username', $username[0]["username"]);
		}
	}

	//配置
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 6 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$configlist = array();
	$configval  = array();
	foreach($results as $value){
		array_push($configlist, $value['typename']);
		array_push($configval, $value['id']);
	}
	$huoniaoTag->assign('configlist', $configlist);
	$huoniaoTag->assign('configval', $configval);
	$huoniaoTag->assign('config', explode(",", $config));

	$huoniaoTag->assign('note', $note);
	$huoniaoTag->assign('mbody', $mbody);
	$huoniaoTag->assign('weight', $weight == "" ? "50" : $weight);

	//显示状态
	$huoniaoTag->assign('stateopt', array('0', '1', '2'));
	$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
	$huoniaoTag->assign('state', $state == "" ? 1 : $state);

	$huoniaoTag->assign('imglist', empty($imglist) ? "''" : $imglist);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/house";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
