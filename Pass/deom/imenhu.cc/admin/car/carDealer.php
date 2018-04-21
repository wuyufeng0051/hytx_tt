<?php
/**
 * 管理汽车经销商
 *
 * @version        $Id: carDealer.php 2014-9-10 下午13:57:21 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carDealer");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_dealer";

if($dopost != ""){
	$templates = "carDealerAdd.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap-datetimepicker.min.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/car/carDealerAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carDealer.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carDealer.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$rec     = (int)$rec;
	$pubdate = GetMkTime(time());       //发布时间
	
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
		
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__car_dealer` WHERE `userid` = '".$userid."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它经销商！"}';
			exit();
		}
		
	}else{
		
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__car_dealer` WHERE `userid` = '".$userid."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它经销商！"}';
			exit();
		}
		
	}
	
	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入经销商名称"}';
		exit();
	}
	
	if(trim($subtitle) == ""){
		echo '{"state": 200, "info": "请输入经销商简称"}';
		exit();
	}
	
	if($domaintype != 0){
		if(empty($domain)){
			echo '{"state": 200, "info": "请输入要绑定的域名！"}';
			exit();
		}
		
		//验证域名是否被使用
		if(!operaDomain('check', $domain, 'car', $tab, $id, GetMkTime($domainexp)))
		die('{"state": 200, "info": '.json_encode("域名已被占用，请重试！").'}');
	}
	
	if(empty($litpic)){
		echo '{"state": 200, "info": "请上传经销商Logo"}';
		exit();
	}
	
	if(empty($brand)){
		echo '{"state": 200, "info": "请选择主营品牌"}';
		exit();
	}
	
	if(empty($tel)){
		echo '{"state": 200, "info": "请输入联系电话"}';
		exit();
	}
	
	if(empty($addr)){
		echo '{"state": 200, "info": "请选择经销商所在区域"}';
		exit();
	}
	
	if(empty($address)){
		echo '{"state": 200, "info": "请输入经销商详细地址"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($sKeyword)){
		$where .= " AND (`title` like '%$sKeyword%' OR `address` like '%$sKeyword%' OR `tel` like '%$sKeyword%')";
	}

	if(!empty($sBrand)){
		$where .= " AND `brand` like '%,".$sBrand.",%'";
	}
	
	if(!empty($sType)){
		$where .= " AND `levaltype` = ".$sType;
	}
	
	if(!empty($sAddr)){
		if($dsql->getTypeList($sAddr, "car_addr")){
			$lower = arr_foreach($dsql->getTypeList($sAddr, "car_addr"));
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
	}
	
	$where .= " order by `weight` desc, `pubdate` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `userid`, `litpic`, `state`, `levaltype`, `addr`, `address`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			
			$list[$key]["userid"] = $value["userid"];
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value['userid']);
			$username = $dsql->getTypeName($userSql);
			if($username){
				$list[$key]["username"] = $username[0]["username"];
			}else{
				$list[$key]["username"] = '无';
			}
			
			$list[$key]["litpic"] = $value["litpic"];
			$list[$key]["state"] = $value["state"];
			
			//经销商类型
			$typename = "";
			switch ($value['levaltype']) {
				case '1':
					$typename = "4S店";
					break;
				case '2':
					$typename = "特许店";
					break;
				case '3':
					$typename = "综合店";
					break;
			}
			$list[$key]["levaltype"] = $typename;
			
			//所在区域
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_addr` WHERE `id` = ". $value["addr"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$list[$key]["addr"] = $itemResult[0]['typename'];
			
			$list[$key]["address"] = $value["address"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "carDealer": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carDealerAdd");

	$pagetitle = "新增汽车经销商";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`userid`, `title`, `subtitle`, `domaintype`, `levaltype`, `litpic`, `brand`, `website`, `xiaoshou`, `tel`, `fax`, `email`, `addr`, `address`, `lnglat`, `postcode`, `note`, `weight`, `state`, `rec`, `pubdate`) VALUES ('$userid', '$title', '$subtitle', '$domaintype', '$levaltype', '$litpic', '$brand', '$website', '$xiaoshou', '$tel', '$fax', '$email', '$addr', '$address', '$lnglat', '$postcode', '$note', '$weight', '$state', '$rec', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");
		
		if($aid){
			//域名操作
			operaDomain('update', $domain, 'car', $tab, $aid, GetMkTime($domainexp), $domaintip);
		
			adminLog("新增汽车经销商", $title);
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carDealerEdit");
	
	$pagetitle = "修改汽车经销商信息";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `userid` = '$userid', `title` = '$title', `subtitle` = '$subtitle', `domaintype` = '$domaintype', `levaltype` = '$levaltype', `litpic` = '$litpic', `brand` = '$brand', `website` = '$website', `xiaoshou` = '$xiaoshou', `tel` = '$tel', `fax` = '$fax', `email` = '$email', `addr` = '$addr', `address` = '$address', `lnglat` = '$lnglat', `postcode` = '$postcode', `note` = '$note', `weight` = '$weight', `state` = '$state', `rec` = '$rec' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			//域名操作
			operaDomain('update', $domain, 'car', $tab, $id, GetMkTime($domainexp), $domaintip);
			
			adminLog("修改汽车经销商信息", $title);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
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
				
				$userid     = $results[0]['userid'];
				$title      = $results[0]['title'];
				$subtitle   = $results[0]['subtitle'];
				$domaintype = $results[0]['domaintype'];
				
				//获取域名信息
				$domainInfo = getDomain('car', $tab, $id);
				$domain     = $domainInfo['domain'];
				$domainexp  = $domainInfo['expires'];
				$domaintip  = $domainInfo['note'];
				
				$levaltype  = $results[0]['levaltype'];
				$litpic     = $results[0]['litpic'];
				$brand      = $results[0]['brand'];
				$website    = $results[0]['website'];
				$xiaoshou   = $results[0]['xiaoshou'];
				$tel        = $results[0]['tel'];
				$fax        = $results[0]['fax'];
				$email      = $results[0]['email'];
				$addr       = $results[0]['addr'];
				$address    = $results[0]['address'];
				$lnglat     = $results[0]['lnglat'];
				$postcode   = $results[0]['postcode'];
				$note       = $results[0]['note'];
				$weight     = $results[0]['weight'];
				$state      = $results[0]['state'];
				$rec        = $results[0]['rec'];
				
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
	if(!testPurview("carDealerDel")){
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
			
			//删除Logo
			delPicFile($results[0]['litpic'], "delLogo", "car");
			
			//删除域名配置
			$archives = $dsql->SetQuery("DELETE FROM `#@__domain` WHERE `module` = 'car' AND `part` = '$tab' AND `iid` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");

			//删除报价
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_dealer_offer` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除活动
			$archives = $dsql->SetQuery("SELECT * FROM `#@__car_dealer_event` WHERE `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach ($results as $key => $value) {
					delPicFile($value['litpic'], "delThumb", "car");
					$body = $value['content'];
					if(!empty($body)){
						delEditorPic($body, "car");
					}
				}
			}
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_dealer_event` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除新闻
			$archives = $dsql->SetQuery("SELECT * FROM `#@__car_dealer_news` WHERE `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach ($results as $key => $value) {
					$body = $value['content'];
					if(!empty($body)){
						delEditorPic($body, "car");
					}
				}
			}
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_dealer_news` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除询价
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_dealer_inquiry` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除试驾
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_dealer_booking` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除留言
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_dealer_guest` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除顾问
			$archives = $dsql->SetQuery("SELECT * FROM `#@__car_dealer_advisor` WHERE `aid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach ($results as $key => $value) {
					delPicFile($value['litpic'], "delPhoto", "car");
				}
			}
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_dealer_advisor` WHERE `aid` = ".$val);
			$dsql->dsqlOper($archives, "update");
			
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
			adminLog("删除汽车经销商", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
		
	}
	die;
	
//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("carDealerEdit")){
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
			adminLog("更新汽车经销商状态", $id."=>".$state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;

//根据品牌和区域获取经销商
}elseif($dopost == "getDealer"){
	$where = "";
	if(!empty($cid)){
		$where .= " AND `brand` like '%,".$cid.",%'";
	}
	
	if(!empty($addr)){
		if($dsql->getTypeList($addr, "car_addr")){
			$lower = arr_foreach($dsql->getTypeList($addr, "car_addr"));
			$lower = $addr.",".join(',',$lower);
		}else{
			$lower = $addr;
		}
		$where .= " AND `addr` in ($lower)";
	}

	$archives = $dsql->SetQuery("SELECT `id`, `title`, `subtitle` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");
	if($results){
		echo json_encode($results);
	}
	die;

//获取经销商主营品牌
}elseif($dopost == "getBrand"){
	if(!empty($id)){
		$archives = $dsql->SetQuery("SELECT `brand` FROM `#@__".$tab."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$brandArr = array();
			$i = 0;
			$brand = $results[0]['brand'];
			$brand = explode(",", $brand);
			foreach ($brand as $key => $value) {
				if(!empty($value)){
					$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__car_brand` WHERE `id` = ".$value);
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						$brandArr[$i]['id'] = $results[0]['id'];
						$brandArr[$i]['typename'] = $results[0]['typename'];
						$i++;
					}
				}
			}
			echo json_encode($brandArr);
		}
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	require_once(HUONIAOINC."/config/car.inc.php");
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
	$huoniaoTag->assign('basehost', $cfg_basehost);
	
	if($dopost != ""){
		//获取域名信息
		$domainInfo = getDomain('car', 'config');
		$huoniaoTag->assign('subdomain', $domainInfo['domain']);
		
		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);
			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('subtitle', $subtitle);
			
			//会员信息
			$huoniaoTag->assign('userid', $userid);
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
			$username = $dsql->getTypeName($userSql);
			$huoniaoTag->assign('username', $username[0]['username']);

			//主营品牌
			$brandSelected = "";
			$huoniaoTag->assign('brand', $brand);
			$brand = explode(",", $brand);
			foreach ($brand as $key => $value) {
				if(!empty($value)){
					$brandSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_brand` WHERE `id` = ". $value);
					$brandName = $dsql->getTypeName($brandSql);
					$brandSelected .= '<span data-id="'.$value.'">'.$brandName[0]['typename'].'<a href="javascript:;">×</a></span>';
				}
			}
			$huoniaoTag->assign('brandSelected', $brandSelected);
		}
		
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
		
		//经销商类型
		$huoniaoTag->assign('levaltypeList', array(1 => '4S店', 2 => '特许店', 3 => '综合店'));
		$huoniaoTag->assign('levaltype', $levaltype == "" ? 1 : $levaltype);
		
		$huoniaoTag->assign('litpic', $litpic);
		$huoniaoTag->assign('website', $website);

		//销售区域
		$huoniaoTag->assign('xiaoshouList', array(1 => '售全国', 2 => '售本省', 3 => '售本市'));
		$huoniaoTag->assign('xiaoshou', $xiaoshou == "" ? 1 : $xiaoshou);

		$huoniaoTag->assign('tel', $tel);
		$huoniaoTag->assign('fax', $fax);
		$huoniaoTag->assign('email', $email);
		$huoniaoTag->assign('addr', empty($addr) ? 0 : $addr);
		$huoniaoTag->assign('address', $address);
		$huoniaoTag->assign('lnglat', $lnglat);
		
		$huoniaoTag->assign('postcode', $postcode);
		$huoniaoTag->assign('note', $note);
		$huoniaoTag->assign('weight', !empty($weight) ? $weight : 1);
		
		//显示状态
		$huoniaoTag->assign('stateopt', array('0', '1', '2'));
		$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
		$huoniaoTag->assign('state', $state == "" ? 1 : $state);
		
		$huoniaoTag->assign('rec', $rec);
	}
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "car_addr")));
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}