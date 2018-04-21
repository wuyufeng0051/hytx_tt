<?php
/**
 * 添加家居公司
 *
 * @version        $Id: homeStoreAdd.php 2016-4-26 下午16:44:20 $
 * @package        HuoNiao.Home
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/home";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "homeStoreAdd.html";

$tab = "home_store";
$dopost = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改
if($dopost == "edit"){
	$pagetitle = "修改家居店铺";
	checkPurview("homeStoreEdit");
}else{
	$pagetitle = "添加家居店铺";
	checkPurview("homeStoreAdd");
}

if(empty($domaintype)) $domaintype = 0;
if(empty($domainexp)) $domainexp = 0;
$domainexp = empty($domainexp) ? 0 : GetMkTime($domainexp);
if(empty($userid)) $userid = 0;
if(empty($weight)) $weight = 1;
if(empty($state)) $state = 0;
if(empty($certi)) $certi = 0;
if(empty($click)) $click = 0;
$rec    = (int)$rec;

if($_POST['submit'] == "提交"){

	if($token == "") die('token传递失败！');
	//二次验证
	if(empty($title)){
		echo '{"state": 200, "info": "请输入店铺名称！"}';
		exit();
	}

	if($domaintype != 0){
		if(empty($domain)){
			echo '{"state": 200, "info": "请输入要绑定的域名！"}';
			exit();
		}

		//验证域名是否被使用
		if(!operaDomain('check', $domain, 'home', $tab, $id, GetMkTime($domainexp)))
		die('{"state": 200, "info": '.json_encode("域名已被占用，请重试！").'}');
	}

	if(empty($company)){
		echo '{"state": 200, "info": "请输入公司名！"}';
		exit();
	}

	if(empty($addrid)){
		echo '{"state": 200, "info": "请选择所在区域！"}';
		exit();
	}

	if(empty($typeid)){
		echo '{"state": 200, "info": "请选择经营行业！"}';
		exit();
	}

	if(empty($project)){
		echo '{"state": 200, "info": "请输入主营项目！"}';
		exit();
	}

	if(empty($litpic)){
		echo '{"state": 200, "info": "请上传店铺logo！"}';
		exit();
	}

	if($userid == 0 && trim($user) == ''){
		echo '{"state": 200, "info": "请选择会员名"}';
		exit();
	}
	if($userid == 0){
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` = '".$user."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			echo '{"state": 200, "info": "会员不存在，请在联想列表中选择"}';
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

	if(empty($people)){
		echo '{"state": 200, "info": "请输入联系人！"}';
		exit();
	}

	if(empty($contact)){
		echo '{"state": 200, "info": "请输入联系电话！"}';
		exit();
	}

	if(empty($tel)){
		echo '{"state": 200, "info": "请输入客服电话！"}';
		exit();
	}

	//检测是否已经注册
	if($dopost == "save"){

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `title` = '".$title."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "店铺名称已存在，不可以重复添加！"}';
			exit();
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `company` = '".$company."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "公司名称已注册其它店铺，不可以重复添加！"}';
			exit();
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `userid` = '".$userid."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它店铺，一个会员不可以管理多个店铺！"}';
			exit();
		}

	}else{

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `title` = '".$title."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "店铺名称已存在，不可以重复添加！"}';
			exit();
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `company` = '".$company."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "公司名称已注册其它店铺，不可以重复添加！"}';
			exit();
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `userid` = '".$userid."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它店铺，一个会员不可以管理多个店铺！"}';
			exit();
		}
	}

}

if($dopost == "save" && $submit == "提交"){
	//保存到表
	$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`title`, `domaintype`, `company`, `addrid`, `address`, `typeid`, `project`, `logo`, `userid`, `people`, `contact`, `tel`, `qq`, `click`, `weight`, `state`, `certi`, `rec`, `pubdate`) VALUES ('$title', '$domaintype', '$company', '$addrid', '$address', '$typeid', '$project', '$litpic', '$userid', '$people', '$contact', '$tel', '$qq', '$click', '$weight', '$state', '$certi', '$rec', '".GetMkTime(time())."')");
	$aid = $dsql->dsqlOper($archives, "lastid");

	if($aid){
		//域名操作
		operaDomain('update', $domain, 'home', $tab, $aid, GetMkTime($domainexp), $domaintip);

		adminLog("添加家居店铺", $title);

		$param = array(
			"service"  => "home",
			"template" => "store-detail",
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
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `domaintype` = '$domaintype', `company` = '$company', `addrid` = '$addrid', `address` = '$address', `typeid` = '$typeid', `project` = '$project', `logo` = '$litpic', `userid` = '$userid', `people` = '$people', `contact` = '$contact', `tel` = '$tel', `qq` = '$qq', `click` = '$click', `weight` = '$weight', `state` = '$state', `certi` = '$certi', `rec` = '$rec' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results == "ok"){
			//域名操作
			operaDomain('update', $domain, 'home', $tab, $id, GetMkTime($domainexp), $domaintip);

			adminLog("修改家居店铺", $title);

			$param = array(
				"service"  => "home",
				"template" => "store-detail",
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
			$domaintype   = $results[0]['domaintype'];
			//获取域名信息
			$domainInfo   = getDomain('home', $tab, $id);
			$domain       = $domainInfo['domain'];
			$domainexp    = $domainInfo['expires'];
			$domaintip    = $domainInfo['note'];
			$company      = $results[0]['company'];
			$addrid       = $results[0]['addrid'];
			$address      = $results[0]['address'];
			$typeid     = $results[0]['typeid'];
			$project      = $results[0]['project'];
			$logo         = $results[0]['logo'];
			$userid       = $results[0]['userid'];
			$people       = $results[0]['people'];
			$contact      = $results[0]['contact'];
			$tel          = $results[0]['tel'];
			$qq           = $results[0]['qq'];
			$note         = $results[0]['note'];
			$click        = $results[0]['click'];
			$weight       = $results[0]['weight'];
			$state        = $results[0]['state'];
			$certi        = $results[0]['certi'];
			$rec          = $results[0]['rec'];

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
		'ui/bootstrap-datetimepicker.min.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/home/homeStoreAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('pagetitle', $pagetitle);
	require_once(HUONIAOINC."/config/home.inc.php");
	global $cfg_basehost;
	global $customChannelDomain;
	global $customUpload;
	if($customUpload == 1){
		global $custom_thumbSize;
		global $custom_thumbType;
		$huoniaoTag->assign('thumbSize', $custom_thumbSize);
		$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
	}
	$huoniaoTag->assign('basehost', $cfg_basehost);
	//获取域名信息
	$domainInfo = getDomain('home', 'config');
	$huoniaoTag->assign('subdomain', $domainInfo['domain']);
	$huoniaoTag->assign('id', $id);

	$huoniaoTag->assign('title', $title);

	global $customSubDomain;
	$huoniaoTag->assign('customSubDomain', $customSubDomain);
	if($customSubDomain != 2){
		$huoniaoTag->assign('domaintype', array('0', '1', '2'));
		$huoniaoTag->assign('domaintypeNames',array('默认','绑定主域名','绑定子域名'));
	}else{
		$huoniaoTag->assign('domaintype', array('0', '1'));
		$huoniaoTag->assign('domaintypeNames',array('默认','绑定主域名'));
	}
	if($customSubDomain == 2 && $domaintype == 2) $domaintype = 0;

	$huoniaoTag->assign('domaintypeChecked', $domaintype == "" ? 0 : $domaintype);
	$huoniaoTag->assign('domain', $domain);
	$huoniaoTag->assign('domainexp', $domainexp == 0 ? "" : date("Y-m-d H:i:s", $domainexp));
	$huoniaoTag->assign('domaintip', $domaintip);

	$huoniaoTag->assign('company', $company);
	$huoniaoTag->assign('addrid', $addrid == "" ? 0 : $addrid);
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "homeaddr")));
	$huoniaoTag->assign('address', $address);
	$huoniaoTag->assign('typeid', $typeid == "" ? 0 : $typeid);
	$huoniaoTag->assign('typeidListArr', json_encode(getTypeList(0, "home_industry")));
	$huoniaoTag->assign('project', $project);
	$huoniaoTag->assign('litpic', $logo);

	$huoniaoTag->assign('userid', $userid);
	$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
	$username = $dsql->getTypeName($userSql);
	$huoniaoTag->assign('username', $username[0]['username']);

	$huoniaoTag->assign('people', $people);
	$huoniaoTag->assign('contact', $contact);
	$huoniaoTag->assign('tel', $tel);
	$huoniaoTag->assign('qq', $qq);
	$huoniaoTag->assign('note', $note);
	$huoniaoTag->assign('click', $click == "" ? "1" : $click);
	$huoniaoTag->assign('weight', $weight == "" ? "1" : $weight);

	//显示状态
	$huoniaoTag->assign('stateopt', array('0', '1', '2'));
	$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
	$huoniaoTag->assign('state', $state == "" ? 1 : $state);

	//属性
	$huoniaoTag->assign('certiopt', array('0', '1', '2'));
	$huoniaoTag->assign('certinames',array('待认证','已认证','认证失败'));
	$huoniaoTag->assign('certi', $certi == "" ? 1 : $certi);

	$huoniaoTag->assign('rec', $rec);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/home";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//获取行业分类列表
function getTypeList($id, $tab){
	global $dsql;
	$sql = $dsql->SetQuery("SELECT `id`, `parentid`, `typename` FROM `#@__".$tab."` WHERE `parentid` = $id ORDER BY `weight`");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		return $results;
	}else{
		return '';
	}
}
