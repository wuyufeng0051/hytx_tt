<?php
/**
 * 添加商铺
 *
 * @version        $Id: houseSpAdd.php 2014-1-18 下午14:01:21 $
 * @package        HuoNiao.House
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/house";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "houseSpAdd.html";

$tab = "house_sp";
$dopost = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改
if($dopost == "edit"){
	$pagetitle = "修改商铺";
	checkPurview("houseSpEdit");
}else{
	$pagetitle = "添加商铺";
	checkPurview("houseSpAdd");
}

if(empty($industry)) $industry = 0;
if(empty($addrid)) $addrid = 0;
if(empty($price)) $price = 0;
if(empty($proprice)) $proprice = 0;
if(empty($transfer)) $transfer = 0;
if(empty($weight)) $weight = 1;
if(empty($state)) $state = 0;
if(empty($userid)) $userid = 0;
if(empty($zhuangxiu)) $zhuangxiu = 0;
if(empty($bno)) $bno = 0;
if(empty($floor)) $floor = 0;
if(!empty($config)) $config = join(",", $config);

if($_POST['submit'] == "提交"){

	if($token == "") die('token传递失败！');
	//二次验证
	if(empty($title)){
		echo '{"state": 200, "info": "请输入商铺名称！"}';
		exit();
	}
	if(empty($addrid)){
		echo '{"state": 200, "info": "请选择所处区域！"}';
		exit();
	}
	if(empty($address)){
		echo '{"state": 200, "info": "请输入详细地址！"}';
		exit();
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
	$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`type`, `industry`, `title`, `addrid`, `address`, `nearby`, `litpic`, `proprice`, `protype`, `area`, `price`, `transfer`, `usertype`, `userid`, `username`, `contact`, `zhuangxiu`, `bno`, `floor`, `config`, `suitable`, `note`, `mbody`, `weight`, `state`, `pubdate`) VALUES ('$type', '$industry', '$title', '$addrid', '$address', '$nearby', '$litpic', '$proprice', '$protype', '$area', '$price', '$transfer', '$usertype', '$userid', '$username', '$contact', '$zhuangxiu', '$bno', '$floor', '$config', '$suitable', '$note', '$mbody', '$weight', '$state', '".GetMkTime(time())."')");
	$aid = $dsql->dsqlOper($archives, "lastid");

	//保存图集表
	if($imglist != ""){
		$picList = explode(",",$imglist);
		foreach($picList as $k => $v){
			$picInfo = explode("|", $v);
			$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housesp', '$aid', '$picInfo[0]', '$picInfo[1]')");
			$dsql->dsqlOper($pics, "update");
		}
	}

	if($aid){
		adminLog("添加商铺信息", $title);
		$param = array(
			"service"  => "house",
			"template" => "sp-detail",
			"id"       => $aid
		);
		$url = getUrlPath($param);

		echo '{"state": 100, "url": "'.$url.'"}';
	}else{
		echo '{"state": 200, "info": '.json_encode("保存到数据库失败！").'}';
	}
	die;

//获取行业分类
}elseif($dopost == "getIndustry"){
	echo json_encode($dsql->getTypeList(0, "house_industry", false));
	die;

}elseif($dopost == "edit"){

	if($submit == "提交"){
		//保存到表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `type` = '$type', `industry` = '$industry', `title` = '$title', `addrid` = '$addrid', `address` = '$address', `nearby` = '$nearby', `litpic` = '$litpic', `proprice` = '$proprice', `protype` = '$protype', `area` = '$area', `price` = '$price', `transfer` = '$transfer', `usertype` = '$usertype', `userid` = '$userid', `username` = '$username', `contact` = '$contact', `zhuangxiu` = '$zhuangxiu', `bno` = '$bno', `floor` = '$floor', `config` = '$config', `suitable` = '$suitable', `note` = '$note', `mbody` = '$mbody', `weight` = '$weight', `state` = '$state', `pubdate` = '".GetMkTime(time())."' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		//先删除文档所属图集
		$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housesp' AND `aid` = ".$id);
		$dsql->dsqlOper($archives, "update");

		//保存图集表
		if($imglist != ""){
			$picList = explode(",", $imglist);
			foreach($picList as $k => $v){
				$picInfo = explode("|", $v);
				$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housesp', '$id', '$picInfo[0]', '$picInfo[1]')");
				$dsql->dsqlOper($pics, "update");
			}
		}

		if($results == "ok"){
			adminLog("修改商铺信息", $title);
			$param = array(
				"service"  => "house",
				"template" => "sp-detail",
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

			$type      = $results[0]['type'];
			$industry  = $results[0]['industry'];
			$title     = $results[0]['title'];
			$addrid    = $results[0]['addrid'];
			$address   = $results[0]['address'];
			$nearby    = $results[0]['nearby'];
			$litpic    = $results[0]['litpic'];
			$proprice  = $results[0]['proprice'];
			$protype   = $results[0]['protype'];
			$area      = $results[0]['area'];
			$price     = $results[0]['price'];
			$transfer  = $results[0]['transfer'];
			$usertype  = $results[0]['usertype'];
			$userid    = $results[0]['userid'];
			$username  = $results[0]['username'];
			$contact   = $results[0]['contact'];
			$zhuangxiu = $results[0]['zhuangxiu'];
			$bno       = $results[0]['bno'];
			$floor     = $results[0]['floor'];
			$config    = $results[0]['config'];
			$suitable  = $results[0]['suitable'];
			$note      = $results[0]['note'];
			$mbody     = $results[0]['mbody'];
			$weight    = $results[0]['weight'];
			$state     = $results[0]['state'];

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housesp' AND `aid` = ".$id." ORDER BY `id` ASC");
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
		'admin/house/houseSpAdd.js'
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

	//供求方式
	$huoniaoTag->assign('typeopt', array('0', '1', '2'));
	$huoniaoTag->assign('typenames',array('商铺出租','商铺出售','生意转让'));
	$huoniaoTag->assign('type', $type == "" ? 0 : $type);

	//行业分类
	$huoniaoTag->assign('industryArr', json_encode($dsql->getTypeList(0, "house_industry")));
	$huoniaoTag->assign('industry', $industry == "" ? 0 : $industry);

	$huoniaoTag->assign('title', $title);

	//区域
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "houseaddr")));
	$huoniaoTag->assign('addrid', $addrid == "" ? 0 : $addrid);
	$huoniaoTag->assign('address', $address);
	$huoniaoTag->assign('nearby', $nearby);

	$huoniaoTag->assign('litpic', $litpic);
	$huoniaoTag->assign('price', $price == 0 ? "" : $price);
	$huoniaoTag->assign('proprice', $proprice == 0 ? "" : $proprice);
	$huoniaoTag->assign('transfer', $transfer == 0 ? "" : $transfer);

	//物业类型
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 9 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array();
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('protypeList', $list);
	$huoniaoTag->assign('protype', $protype == "" ? 0 : $protype);

	$huoniaoTag->assign('regcom', $regcom);
	$huoniaoTag->assign('area', $area);
	$huoniaoTag->assign('suitable', $suitable);

	$suitableSelected = "";
	if(!empty($suitable)){
		$suitable = explode(",", $suitable);
		foreach($suitable as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_industry` WHERE `id` = $val");
			$results = $dsql->dsqlOper($archives, "results");
			$name = $results ? $results[0]['typename'] : "";
			$suitableSelected .= '<span data-id="'.$val.'">'.$name.'<a href="javascript:;">×</a></span>';
		}
	}
	$huoniaoTag->assign('suitableSelected', $suitableSelected);

	//房源性质
	$huoniaoTag->assign('usertypeopt', array('0', '1'));
	$huoniaoTag->assign('usertypenames',array('个人','中介'));
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

	//装修情况
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 2 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('zhuangxiuList', $list);
	$huoniaoTag->assign('zhuangxiu', $zhuangxiu == "" ? 0 : $zhuangxiu);

	$huoniaoTag->assign('bno', $bno);
	$huoniaoTag->assign('floor', $floor);

	$huoniaoTag->assign('note', $note);
	$huoniaoTag->assign('mbody', $mbody);
	$huoniaoTag->assign('weight', $weight == "" ? "50" : $weight);

	//配置
	$archives = $dsql->SetQuery("SELECT * FROM `#@__houseitem` WHERE `parentid` = 83 ORDER BY `weight` ASC");
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
