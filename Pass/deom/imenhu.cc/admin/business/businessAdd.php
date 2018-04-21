<?php
/**
 * 修改商家信息
 *
 * @version        $Id: businessAdd.php 2017-3-24 上午10:04:10 $
 * @package        HuoNiao.Business
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("businessList");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/business";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "businessAdd.html";

global $handler;
$handler = true;

$action     = "business";
$pagetitle  = "修改商家信息";
$dopost     = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改

$authattr = isset($authattr) ? join(',',$authattr) : '';

if($dopost == "edit"){

	if($submit == "提交"){
		if($token == "") die('token传递失败！');
		//表单二次验证
		if($title == ''){
			echo '{"state": 200, "info": "请输入店铺名称"}';
			exit();
		}

		if(trim($logo) == ''){
			echo '{"state": 200, "info": "请上传店铺LOGO"}';
			exit();
		}

		if(trim($typeid) == ''){
			echo '{"state": 200, "info": "请选择经营品类"}';
			exit();
		}

		if(trim($addrid) == ''){
			echo '{"state": 200, "info": "请选择所在区域"}';
			exit();
		}

		//查询信息之前的状态
		$sql = $dsql->SetQuery("SELECT `state`, `uid`, `pubdate` FROM `#@__".$action."_list` WHERE `id` = $id");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$state_  = $ret[0]['state'];
			$uid     = $ret[0]['uid'];
			$pubdate = $ret[0]['pubdate'];

			//会员消息通知
			if($state != $state_){

				$state = "";
				$status = "";

				//等待审核
				if($state == 0){
					$state = 0;
					$status = "进入等待审核状态。";

				//已审核
				}elseif($state == 1){
					$state = 1;
					$status = "已经通过审核。";

					//审核失败
				}elseif($state == 2){
					$state = 2;
					$status = "审核失败。";
				}

				$param = array(
					"service"  => "member",
					"template" => "config",
					"action"   => "business"
				);

				//获取会员名
				$username = "";
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}

				updateMemberNotice($uid, "会员-店铺审核通知", $param, array("username" => $username, "title" => $title, "status" => $status, "date" => date("Y-m-d H:i:s", time())));
			}
		}

		$lnglat = explode(",", $lnglat);
		$lng = $lnglat[0];
		$lat = $lnglat[1];

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$action."_list` SET `title` = '$title', `logo` = '$logo', `typeid` = '$typeid', `addrid` = '$addrid', `address` = '$address', `lng` = '$lng', `lat` = '$lat', `wechatname` = '$wechatname', `wechatcode` = '$wechatcode', `wechatqr` = '$wechatqr', `tel` = '$tel', `qq` = '$qq', `pics` = '$pics', `banner` = '$banner', `license` = '$license', `certify` = '$certify', `opentime` = '$opentime', `amount` = '$amount', `parking` = '$parking', `wifi` = '$wifi', `wifiname` = '$wifiname', `wifipasswd` = '$wifipasswd', `authattr` = '$authattr', `state` = '$state' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results != "ok"){
			echo '{"state": 200, "info": "主表保存失败！"}';
			exit();
		}

		adminLog("修改商家信息", $title);

		$param = array(
			"service"     => "business",
			"template"    => "detail",
			"id"          => $id
		);
		$url = getUrlPath($param);

		echo '{"state": 100, "url": "'.$url.'"}';die;

	}else{
		if(!empty($id)){

			//主表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."_list` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){

				$title      = $results[0]['title'];
				$logo       = $results[0]['logo'];
				$typeid     = $results[0]['typeid'];
				$addrid     = $results[0]['addrid'];
				$address    = $results[0]['address'];
				$lng        = $results[0]['lng'];
				$lat        = $results[0]['lat'];
				$wechatname = $results[0]['wechatname'];
				$wechatcode = $results[0]['wechatcode'];
				$wechatqr   = $results[0]['wechatqr'];
				$tel        = $results[0]['tel'];
				$qq         = $results[0]['qq'];
				$pics       = $results[0]['pics'];
				$banner     = $results[0]['banner'];
				$license    = $results[0]['license'];
				$certify    = $results[0]['certify'];
				$opentime   = $results[0]['opentime'];
				$amount     = $results[0]['amount'];
				$parking    = $results[0]['parking'];
				$wifi       = $results[0]['wifi'];
				$wifiname   = $results[0]['wifiname'];
				$wifipasswd = $results[0]['wifipasswd'];
				$authattr   = $results[0]['authattr'];
				$pubdate    = $results[0]['pubdate'];
				$state      = $results[0]['state'];
				$stateinfo  = $results[0]['stateinfo'];

			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}

		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/business/businessAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	require_once(HUONIAOINC."/config/".$action.".inc.php");
	global $customUpload;
	if($customUpload == 1){
		global $custom_atlasSize;
		global $custom_atlasType;
		$huoniaoTag->assign('atlasSize', $custom_atlasSize);
		$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
	}

	$huoniaoTag->assign('mapCity', $cfg_mapCity);
	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('id', $id);
	$huoniaoTag->assign('title', $title);
	$huoniaoTag->assign('logo', $logo);
	$huoniaoTag->assign('typeid', $typeid);
	$huoniaoTag->assign('addrid', $addrid);
	$huoniaoTag->assign('address', $address);
	$huoniaoTag->assign('lnglat', $lng.",".$lat);
	$huoniaoTag->assign('wechatname', $wechatname);
	$huoniaoTag->assign('wechatcode', $wechatcode);
	$huoniaoTag->assign('wechatqr', $wechatqr);
	$huoniaoTag->assign('tel', $tel);
	$huoniaoTag->assign('qq', $qq);
	$huoniaoTag->assign('banner', json_encode(explode(",", $banner)));
	$huoniaoTag->assign('pics', json_encode(explode(",", $pics)));
	$huoniaoTag->assign('license', $license);
	$huoniaoTag->assign('certify', json_encode(explode(",", $certify)));
	$huoniaoTag->assign('opentime', $opentime);
	$huoniaoTag->assign('amount', $amount);
	$huoniaoTag->assign('parking', $parking);
	$huoniaoTag->assign('wifi', $wifi);
	$huoniaoTag->assign('wifiname', $wifiname);
	$huoniaoTag->assign('wifipasswd', $wifipasswd);
	$huoniaoTag->assign('pubdate', $pubdate);
	$huoniaoTag->assign('state', $state);
	$huoniaoTag->assign('stateinfo', $stateinfo);
	$huoniaoTag->assign('authattr', explode(",", $authattr));

	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, $action."_type")));
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, $action."_addr")));

	//认证信息
	$authArr = array();
	$sql = $dsql->SetQuery("SELECT * FROM `#@__business_authattr` ORDER BY `weight`");
	$ret = $dsql->dsqlOper($sql, "results");
	if($ret){
		foreach ($ret as $key => $value) {
			array_push($authArr, array(
				"id" => $value['id'],
				"jc" => $value['jc'],
				"typename" => $value['typename']
			));
		}
	}
	$huoniaoTag->assign('authArr', $authArr);


	//阅读权限-下拉菜单
	$huoniaoTag->assign('stateList', array(0 => '等待审核', 1 => '审核通过', 2 => '审核拒绝'));
	$huoniaoTag->assign('state', $state);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/business";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
