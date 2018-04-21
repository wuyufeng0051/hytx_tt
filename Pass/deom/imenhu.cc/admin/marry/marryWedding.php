<?php
/**
 * 管理婚嫁摄影
 *
 * @version        $Id: marryWedding.php 2014-8-2 下午14:20:21 $
 * @package        HuoNiao.Marry
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("marryWedding");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/marry";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "marry_wedding";

if($dopost != ""){
	$templates = "marryWeddingAdd.html";

	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		'swfupload/swfupload.js',
		'swfupload/handlers.js',
		'admin/marry/marryWeddingAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "marryWedding.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/marry/marryWedding.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$special = isset($special) ? ",".join(',',$special)."," : '';
	$pubdate = GetMkTime(time());       //发布时间
	if(!empty($property)) $property = join(",", $property);

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

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__marry_wedding` WHERE `userid` = '".$userid."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它公司！"}';
			exit();
		}

	}else{

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__marry_wedding` WHERE `userid` = '".$userid."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它公司！"}';
			exit();
		}

	}

	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入公司名称"}';
		exit();
	}

	if($domaintype != 0){
		if(empty($domain)){
			echo '{"state": 200, "info": "请输入要绑定的域名！"}';
			exit();
		}

		//验证域名是否被使用
		if(!operaDomain('check', $domain, 'marry', $tab, $id, GetMkTime($domainexp)))
		die('{"state": 200, "info": '.json_encode("域名已被占用，请重试！").'}');
	}

	if(empty($litpic)){
		echo '{"state": 200, "info": "请上传公司LOGO"}';
		exit();
	}

	if(empty($levaltype)){
		echo '{"state": 200, "info": "请选择公司类型"}';
		exit();
	}

	if(empty($addr)){
		echo '{"state": 200, "info": "请选择公司所在区域"}';
		exit();
	}

	if(empty($address)){
		echo '{"state": 200, "info": "请输入摄影详细地址"}';
		exit();
	}

	if(empty($contact)){
		echo '{"state": 200, "info": "请输入摄影联系方式"}';
		exit();
	}

	if(empty($people)){
		echo '{"state": 200, "info": "请输入摄影详细人"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND (`title` like '%$sKeyword%' OR `address` like '%$sKeyword%' OR `contact` like '%$sKeyword%')";
	}

	if($sType != ""){
		$where .= " AND `levaltype` = ".$sType;
	}

	if($sAddr != ""){
		if($dsql->getTypeList($sAddr, "marry_addr")){
			$lower = arr_foreach($dsql->getTypeList($sAddr, "marry_addr"));
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
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `userid`, `logo`, `state`, `levaltype`, `addr`, `address`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
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

			$list[$key]["litpic"] = $value["logo"];
			$list[$key]["state"] = $value["state"];

			//摄影类型
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__marry_item` WHERE `id` = ". $value["levaltype"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$list[$key]["levaltype"] = $itemResult[0]['typename'];

			//所在区域
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__marry_addr` WHERE `id` = ". $value["addr"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$list[$key]["addr"] = $itemResult[0]['typename'];

			$list[$key]["address"] = $value["address"];
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);

			$param = array(
				"service"     => "marry",
				"template"    => "wedding",
				"id"          => $value['id']
			);
			$url = getUrlPath($param);
			$list[$key]['url'] = $url;
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}, "marryWedding": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "totalGray": '.$totalGray.', "totalAudit": '.$totalAudit.', "totalRefuse": '.$totalRefuse.'}}';
	}
	die;

//新增
}elseif($dopost == "Add"){
	checkPurview("marryWeddingAdd");

	$pagetitle = "新增婚纱摄影";

	//表单提交
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`userid`, `title`, `domaintype`, `levaltype`, `logo`, `worktime`, `addr`, `address`, `lnglat`, `special`, `contact`, `people`, `qq`, `website`, `gift`, `content`, `pics`, `click`, `weight`, `state`, `property`, `pubdate`) VALUES ('$userid', '$title', '$domaintype', '$levaltype', '$litpic', '$worktime', '$addr', '$address', '$lnglat', '$special', '$contact', '$people', '$qq', '$website', '$gift', '$content', '$imglist', '$click', '$weight', '$state', '$property', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if($aid){
			//域名操作
			operaDomain('update', $domain, 'marry', $tab, $aid, GetMkTime($domainexp), $domaintip);

			adminLog("新增婚纱摄影", $title);

			$param = array(
				"service"     => "marry",
				"template"    => "wedding",
				"id"          => $aid
			);
			$url = getUrlPath($param);

			echo '{"state": 100, "url": "'.$url.'", "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("marryWeddingEdit");

	$pagetitle = "修改婚纱摄影信息";

	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `userid` = '$userid', `title` = '$title', `domaintype` = '$domaintype', `levaltype` = '$levaltype', `logo` = '$litpic', `worktime` = '$worktime', `addr` = '$addr', `address` = '$address', `lnglat` = '$lnglat', `special` = '$special', `contact` = '$contact', `people` = '$people', `qq` = '$qq', `website` = '$website', `gift` = '$gift', `content` = '$content', `pics` = '$imglist', `click` = '$click', `weight` = '$weight', `state` = '$state', `property` = '$property' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			//域名操作
			operaDomain('update', $domain, 'marry', $tab, $id, GetMkTime($domainexp), $domaintip);

			adminLog("修改婚纱摄影信息", $title);

			$param = array(
				"service"     => "marry",
				"template"    => "wedding",
				"id"          => $id
			);
			$url = getUrlPath($param);

			echo '{"state": 100, "url": "'.$url.'"}';
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
				$domaintype = $results[0]['domaintype'];

				//获取域名信息
				$domainInfo = getDomain('marry', $tab, $id);
				$domain      = $domainInfo['domain'];
				$domainexp   = $domainInfo['expires'];
				$domaintip   = $domainInfo['note'];

				$levaltype  = $results[0]['levaltype'];
				$litpic       = $results[0]['logo'];
				$worktime   = $results[0]['worktime'];
				$addr       = $results[0]['addr'];
				$address    = $results[0]['address'];
				$lnglat     = $results[0]['lnglat'];
				$special    = $results[0]['special'];
				$contact    = $results[0]['contact'];
				$people     = $results[0]['people'];
				$qq         = $results[0]['qq'];
				$website    = $results[0]['website'];
				$gift       = $results[0]['gift'];
				$content    = $results[0]['content'];
				$pics       = $results[0]['pics'];
				$click      = $results[0]['click'];
				$weight     = $results[0]['weight'];
				$state      = $results[0]['state'];
				$property   = $results[0]['property'];

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
	if(!testPurview("marryWeddingDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			//删除精品折扣 start
			$archives = $dsql->SetQuery("SELECT `id`, `litpic` FROM `#@__marry_sale` WHERE `action` = 'wedding' AND `cid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $hall){
				//删除缩略图
				delPicFile($hall['litpic'], "delThumb", "marry");

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__marry_sale` WHERE `id` = ".$hall['id']);
				$results = $dsql->dsqlOper($archives, "update");
			}
			//删除精品折扣 end

			//删除优惠活动 start
			$archives = $dsql->SetQuery("SELECT `id`, `litpic` FROM `#@__marry_deal` WHERE `action` = 'wedding' AND `cid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $hall){
				//删除缩略图
				delPicFile($hall['litpic'], "delThumb", "marry");

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__marry_deal` WHERE `id` = ".$hall['id']);
				$results = $dsql->dsqlOper($archives, "update");
			}
			//删除优惠活动 end

			//删除作品精选 start
			$archives = $dsql->SetQuery("SELECT `id`, `litpic` FROM `#@__marry_works` WHERE `action` = 'wedding' AND `cid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $hall){
				//删除缩略图
				delPicFile($hall['litpic'], "delThumb", "marry");

				//删除照片集
				delPicFile($hall['pics'], "delAtlas", "marry");

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__marry_works` WHERE `id` = ".$hall['id']);
				$results = $dsql->dsqlOper($archives, "update");
			}
			//删除作品精选 end

			//删除案例展示 start
			$archives = $dsql->SetQuery("SELECT `id`, `litpic` FROM `#@__marry_case` WHERE `action` = 'wedding' AND `cid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $hall){
				//删除缩略图
				delPicFile($hall['litpic'], "delThumb", "marry");

				//删除照片集
				delPicFile($hall['pics'], "delAtlas", "marry");

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__marry_case` WHERE `id` = ".$hall['id']);
				$results = $dsql->dsqlOper($archives, "update");
			}
			//删除案例展示 end

			//删除视频展示 start
			$archives = $dsql->SetQuery("SELECT `id`, `typeid`, `video` FROM `#@__marry_video` WHERE `action` = 'wedding' AND `cid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $hall){

				//删除视频
				if($hall['typeid'] == 0){
					delPicFile($hall['video'], "delVideo", "marry");
				}

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__marry_video` WHERE `id` = ".$hall['id']);
				$results = $dsql->dsqlOper($archives, "update");
			}
			//删除视频展示 end

			//删除电子优惠券 start
			$archives = $dsql->SetQuery("SELECT `id`, `litpic` FROM `#@__marry_coupon` WHERE `action` = 'wedding' AND `cid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			foreach($results as $hall){
				//删除缩略图
				delPicFile($hall['litpic'], "delThumb", "marry");

				//删除领取记录
				$archives = $dsql->SetQuery("DELETE FROM `#@__marry_coupon_diary` WHERE `did` = ".$hall['id']);
				$results = $dsql->dsqlOper($archives, "update");

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__marry_coupon` WHERE `id` = ".$hall['id']);
				$results = $dsql->dsqlOper($archives, "update");
			}
			//删除电子优惠券 end

			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			//删除缩略图
			array_push($title, $results[0]['title']);
			delPicFile($results[0]['logo'], "delLogo", "marry");

			//删除实景
			delPicFile($results[0]['pics'], "delAtlas", "marry");

			//删除域名配置
			$archives = $dsql->SetQuery("DELETE FROM `#@__domain` WHERE `module` = 'marry' AND `part` = '$tab' AND `iid` = ".$val);
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
			adminLog("删除婚纱摄影", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;

	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	if(!testPurview("marryWeddingEdit")){
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
			adminLog("更新婚纱摄影状态", $id."=>".$state);
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	require_once(HUONIAOINC."/config/marry.inc.php");
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
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('mapCity', $cfg_mapCity);
	$huoniaoTag->assign('basehost', $cfg_basehost);

	if($dopost != ""){
		//获取域名信息
		$domainInfo = getDomain('marry', 'config');
		$huoniaoTag->assign('subdomain', $domainInfo['domain']);

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);
			$huoniaoTag->assign('title', $title);

			//会员信息
			$huoniaoTag->assign('userid', $userid);
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
			$username = $dsql->getTypeName($userSql);
			$huoniaoTag->assign('username', $username[0]['username']);

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

		$huoniaoTag->assign('litpic', $litpic);

		//摄影类型
		$archives = $dsql->SetQuery("SELECT * FROM `#@__marry_item` WHERE `parentid` = 3 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('levaltypeList', $list);
		$huoniaoTag->assign('levaltype', $levaltype == "" ? 0 : $levaltype);

		$huoniaoTag->assign('worktime', $worktime);
		$huoniaoTag->assign('addr', empty($addr) ? 0 : $addr);
		$huoniaoTag->assign('address', $address);
		$huoniaoTag->assign('lnglat', $lnglat);

		//摄影特色
		$archives = $dsql->SetQuery("SELECT * FROM `#@__marry_item` WHERE `parentid` = 33 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = $val = array();
		foreach($results as $value){
			$list[] = $value['typename'];
			$val[] = $value['id'];
		}
		$huoniaoTag->assign('specialList', $list);
		$huoniaoTag->assign('specialValue', $val);
		$huoniaoTag->assign('special', $special == "" ? 0 : explode(",", $special));

		$huoniaoTag->assign('contact', $contact);
		$huoniaoTag->assign('people', $people);
		$huoniaoTag->assign('qq', $qq);
		$huoniaoTag->assign('website', $website);
		$huoniaoTag->assign('gift', $gift);
		$huoniaoTag->assign('content', $content);
		$huoniaoTag->assign('imglist', json_encode(!empty($pics) ? explode(",", $pics) : array()));
		$huoniaoTag->assign('click', !empty($click) ? $click : 1);
		$huoniaoTag->assign('weight', !empty($weight) ? $weight : 1);

		//显示状态
		$huoniaoTag->assign('stateopt', array('0', '1', '2'));
		$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
		$huoniaoTag->assign('state', $state == "" ? 1 : $state);

		//属性
		$huoniaoTag->assign('propertyVal',array('r','h'));
		$huoniaoTag->assign('propertyList',array('推荐','热门'));
		$huoniaoTag->assign('property', !empty($property) ? explode(",", $property) : "");
	}
	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(3, "marry_item")));
	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "marry_addr")));

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/marry";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
