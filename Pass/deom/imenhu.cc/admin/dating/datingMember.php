<?php
/**
 * 交友会员管理
 *
 * @version        $Id: datingMember.php 2014-7-20 上午11:24:18 $
 * @package        HuoNiao.Dating
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("datingMember");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/dating";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "dating_member";

if($dopost != ""){
	$templates = "datingMemberAdd.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/dating/datingMemberAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "datingMember.html";

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/dating/datingMember.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

$pagetitle = "交友会员管理";

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate     = GetMkTime(time());       //发布时间
	if(!empty($property)) $property = join(",", $property);

	//二次验证
	if($userid == 0 && trim($user) == ''){
		echo '{"state": 200, "info": "请选择所属会员"}';
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

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__dating_member` WHERE `userid` = '".$userid."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已经开通交友功能！"}';
			exit();
		}

	}else{

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__dating_member` WHERE `userid` = '".$userid."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已经开通交友功能！"}';
			exit();
		}

	}

	if(trim($purpose) == ""){
		echo '{"state": 200, "info": "请选择交友目的"}';
		exit();
	}
}

//列表
if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		//性别
		$sex = "";
		if($sType != ""){
			$sex = " AND `sex` = $sType";
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE (`username` like '%$sKeyword%' OR `email` like '%$sKeyword%')".$sex);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where .= " AND `userid` in (".join(",", $userid).")";
			}
		}else{
			$where .= " AND 1 = 2";
		}
	}else{
		//性别
		$sex = "";
		if($sType != ""){
			$sex = " WHERE `sex` = $sType";
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member`".$sex);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where .= " AND `userid` in (".join(",", $userid).")";
			}
		}else{
			$where .= " AND 1 = 2";
		}
	}

	$where .= " order by `id` desc";

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `userid`, `purpose`, `jointime` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["userid"] = $value["userid"];

			//会员信息
			$userSql = $dsql->SetQuery("SELECT `nickname`, `email`, `photo`, `sex` FROM `#@__member` WHERE `id` = ". $value["userid"]);
			$userResult = $dsql->getTypeName($userSql);
			$list[$key]["username"] = $userResult[0]['nickname'];
			$list[$key]["email"] = $userResult[0]['email'];
			$list[$key]["photo"] = $userResult[0]['photo'];
			$list[$key]["sex"] = $userResult[0]['sex'] == 0 ? "女" : "男";

			//交友目的
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__dating_item` WHERE `id` = ". $value["purpose"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$list[$key]["purpose"] = $itemResult[0]['typename'];

			$list[$key]["pubdate"] = date("Y-m-d H:i:s", $value["jointime"]);

			$param = array(
				"service"     => "dating",
				"template"    => "u",
				"id"          => $value['id']
			);
			$list[$key]['url'] = getUrlPath($param);
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "datingMember": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
	}
	die;

//新增
}elseif($dopost == "Add"){

	$pagetitle = "新增交友会员";

	//表单提交
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`userid`, `purpose`, `typeid`, `fromage`, `toage`, `tags`, `addrid`, `grasp`, `learn`, `lnglat`, `sign`, `note`, `marriage`, `height`, `bodytype`, `housetag`, `workstatus`, `income`, `education`, `smoke`, `drink`, `workandrest`, `cartag`, `maxconsume`, `romance`, `jointime`, `dfage`, `dtage`, `dfheight`, `dtheight`, `addr`, `dmarriage`, `dhousetag`, `deducation`, `dincome`, `property`) VALUES ('$userid', '$purpose', '$typeid', '$fromage', '$toage', '$tags', '$addrid', '$grasp', '$learn', '$lnglat', '$sign', '$note', '$marriage', '$height', '$bodytype', '$housetag', '$workstatus', '$income', '$education', '$smoke', '$drink', '$workandrest', '$cartag', '$maxconsume', '$romance', '$pubdate', '$dfage', '$dtage', '$dfheight', '$dtheight', '$addr', '$dmarriage', '$dhousetag', '$deducation', '$dincome', '$property')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			adminLog("新增交友会员", $userid."=>".$user);

			$param = array(
				"service"     => "dating",
				"template"    => "u",
				"id"          => $aid
			);
			$url = getUrlPath($param);
			echo '{"state": 100, "url": "'.$url.'"}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){

	$pagetitle = "修改交友会员信息";

	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `userid` = '$userid', `purpose` = '$purpose', `typeid` = '$typeid', `fromage` = '$fromage', `toage` = '$toage', `tags` = '$tags', `addrid` = '$addrid', `grasp` = '$grasp', `learn` = '$learn', `lnglat` = '$lnglat', `sign` = '$sign', `note` = '$note', `marriage` = '$marriage', `height` = '$height', `bodytype` = '$bodytype', `housetag` = '$housetag', `workstatus` = '$workstatus', `income` = '$income', `education` = '$education', `smoke` = '$smoke', `drink` = '$drink', `workandrest` = '$workandrest', `cartag` = '$cartag', `maxconsume` = '$maxconsume', `romance` = '$romance', `dfage` = '$dfage', `dtage` = '$dtage', `dfheight` = '$dfheight', `dtheight` = '$dtheight', `addr` = '$addr', `dmarriage` = '$dmarriage', `dhousetag` = '$dhousetag', `deducation` = '$deducation', `dincome` = '$dincome', `property` = '$property' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");

		if($return == "ok"){
			adminLog("修改交友会员", $userid."=>".$user);

			$param = array(
				"service"     => "dating",
				"template"    => "u",
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

				$userid       = $results[0]['userid'];
				$purpose      = $results[0]['purpose'];
				$typeid      = $results[0]['typeid'];
				$fromage      = $results[0]['fromage'];
				$toage        = $results[0]['toage'];
				$tags         = $results[0]['tags'];
				$addrid       = $results[0]['addrid'];
				$grasp        = $results[0]['grasp'];
				$learn        = $results[0]['learn'];
				$lnglat       = $results[0]['lnglat'];
				$sign         = $results[0]['sign'];
				$note         = $results[0]['note'];
				$marriage     = $results[0]['marriage'];
				$height       = $results[0]['height'];
				$bodytype     = $results[0]['bodytype'];
				$housetag     = $results[0]['housetag'];
				$workstatus   = $results[0]['workstatus'];
				$income       = $results[0]['income'];
				$education    = $results[0]['education'];
				$smoke        = $results[0]['smoke'];
				$drink        = $results[0]['drink'];
				$workandrest  = $results[0]['workandrest'];
				$cartag       = $results[0]['cartag'];
				$maxconsume   = $results[0]['maxconsume'];
				$romance      = $results[0]['romance'];
				$dfage        = $results[0]['dfage'];
				$dtage        = $results[0]['dtage'];
				$dfheight     = $results[0]['dfheight'];
				$dtheight     = $results[0]['dtheight'];
				$addr         = $results[0]['addr'];
				$dmarriage    = $results[0]['dmarriage'];
				$dhousetag    = $results[0]['dhousetag'];
				$deducation   = $results[0]['deducation'];
				$dincome      = $results[0]['dincome'];
				$property     = $results[0]['property'];

			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}

		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}

//删除会员
}elseif($dopost == "del"){
	$each = explode(",", $id);
	$error = array();
	if($id != ""){
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT `userid` FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$userid = $results[0]['userid'];
				$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
				$results = $dsql->dsqlOper($archives, "update");
				if($results != "ok"){
					$error[] = $val;
				}

				//删除私信
				$archives = $dsql->SetQuery("DELETE FROM `#@__dating_review` WHERE `ufrom` = ".$val." OR `uto` = ".$val);
				$dsql->dsqlOper($archives, "update");

				//删除相册分类
				$archives = $dsql->SetQuery("DELETE FROM `#@__dating_album_type` WHERE `uid` = ".$val);
				$dsql->dsqlOper($archives, "update");

				//删除相册
				$archives = $dsql->SetQuery("SELECT `id`, `path` FROM `#@__dating_album` WHERE `uid` = ".$val);
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					foreach($each as $info){
						delPicFile($info['path'], "delAtlas", "dating");

						//删除评论
						$archives = $dsql->SetQuery("DELETE FROM `#@__dating_album_review` WHERE `aid` = ".$info['id']);
						$dsql->dsqlOper($archives, "update");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__dating_album` WHERE `uid` = ".$val);
					$dsql->dsqlOper($archives, "update");
				}

				//删除故事
				$archives = $dsql->SetQuery("SELECT `litpic`, `pics` FROM `#@__dating_story` WHERE `fid` = ".$val);
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					foreach($each as $info){
						delPicFile($info['litpic'], "delThumb", "dating");
						delPicFile($info['pics'], "delAtlas", "dating");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__dating_story` WHERE `fid` = ".$val);
					$dsql->dsqlOper($archives, "update");
				}

				//删除人气
				$archives = $dsql->SetQuery("DELETE FROM `#@__dating_visit` WHERE `ufrom` = ".$val." OR `uto` = ".$val);
				$dsql->dsqlOper($archives, "update");

				//删除活动报名
				$archives = $dsql->SetQuery("DELETE FROM `#@__dating_activity_take` WHERE `uid` = ".$val);
				$dsql->dsqlOper($archives, "update");
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除交友会员", $id);
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
	}
	die;

//获取交友标签
}elseif($dopost == "gettags"){
	echo json_encode($dsql->getTypeList(0, "dating_tags"));
	die;

//获取技能
}elseif($dopost == "getgrasp" || $dopost == "getlearn"){
	echo json_encode($dsql->getTypeList(0, "dating_skill"));
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	require_once(HUONIAOINC."/config/dating.inc.php");

	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('mapCity', $cfg_mapCity);

	$huoniaoTag->assign('tagsLength', (int)$tagsLength);
	$huoniaoTag->assign('graspLength', (int)$graspLength);
	$huoniaoTag->assign('learnLength', (int)$learnLength);

	if($dopost == "edit"){
		$huoniaoTag->assign('id', $id);
		$huoniaoTag->assign('userid', $userid);

		//会员
		$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $userid);
		$username = $dsql->getTypeName($userSql);
		$username = $username[0]['username'];
		$huoniaoTag->assign('username', $username);

		$huoniaoTag->assign('purpose', $purpose);
		$huoniaoTag->assign('typeid', $typeid);
		$huoniaoTag->assign('fromage', $fromage);
		$huoniaoTag->assign('toage', $toage);
		$huoniaoTag->assign('tags', $tags);
		$huoniaoTag->assign('addrid', $addrid);

		//区域
		global $data;
		$data = "";
		$addrArr = getParentArr("datingaddr", $addrid);
		if($addrArr){
			$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
			$huoniaoTag->assign('addre', join(" > ", $addrArr));
		}else{
			$huoniaoTag->assign('addre', "选择区域");
		}

		$tagsSelected = "";
		if(!empty($tags)){
			$tags = explode(",", $tags);
			foreach($tags as $val){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_tags` WHERE `id` = $val");
				$results = $dsql->dsqlOper($archives, "results");
				$name = $results ? $results[0]['typename'] : "";
				$tagsSelected .= '<span data-id="'.$val.'">'.$name.'<a href="javascript:;">×</a></span>';
			}
		}
		$huoniaoTag->assign('tagsSelected', $tagsSelected);

		$huoniaoTag->assign('grasp', $grasp);

		$graspSelected = "";
		if(!empty($grasp)){
			$grasp = explode(",", $grasp);
			foreach($grasp as $val){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_skill` WHERE `id` = $val");
				$results = $dsql->dsqlOper($archives, "results");
				$name = $results ? $results[0]['typename'] : "";
				$graspSelected .= '<span data-id="'.$val.'">'.$name.'<a href="javascript:;">×</a></span>';
			}
		}
		$huoniaoTag->assign('graspSelected', $graspSelected);

		$huoniaoTag->assign('learn', $learn);

		$learnSelected = "";
		if(!empty($learn)){
			$learn = explode(",", $learn);
			foreach($learn as $val){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_skill` WHERE `id` = $val");
				$results = $dsql->dsqlOper($archives, "results");
				$name = $results ? $results[0]['typename'] : "";
				$learnSelected .= '<span data-id="'.$val.'">'.$name.'<a href="javascript:;">×</a></span>';
			}
		}
		$huoniaoTag->assign('learnSelected', $learnSelected);

		$huoniaoTag->assign('lnglat', $lnglat);
		$huoniaoTag->assign('sign', $sign);
		$huoniaoTag->assign('note', $note);
		$huoniaoTag->assign('marriage', $marriage);
		$huoniaoTag->assign('height', $height);
		$huoniaoTag->assign('bodytype', $bodytype);
		$huoniaoTag->assign('housetag', $housetag);
		$huoniaoTag->assign('workstatus', $workstatus);
		$huoniaoTag->assign('income', $income);
		$huoniaoTag->assign('education', $education);
		$huoniaoTag->assign('smoke', $smoke);
		$huoniaoTag->assign('drink', $drink);
		$huoniaoTag->assign('workandrest', $workandrest);
		$huoniaoTag->assign('cartag', $cartag);
		$huoniaoTag->assign('maxconsume', $maxconsume);
		$huoniaoTag->assign('romance', $romance);
		$huoniaoTag->assign('dfage', $dfage);
		$huoniaoTag->assign('dtage', $dtage);
		$huoniaoTag->assign('dfheight', $dfheight);
		$huoniaoTag->assign('dtheight', $dtheight);
		$huoniaoTag->assign('dmarriage', $dmarriage);
		$huoniaoTag->assign('dhousetag', $dhousetag);
		$huoniaoTag->assign('deducation', $deducation);
		$huoniaoTag->assign('dincome', $dincome);
	}

	//交友目的
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 1 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('purposeList', $list);

	//会员类型
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 143 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('typeList', $list);

	$list = array();
	for($i = 18; $i < 56; $i++){
		$list[$i] = $i;
	}
	$huoniaoTag->assign('fromageList', $list);
	$huoniaoTag->assign('toageList', $list);

	//婚姻情况
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 2 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('marriageList', $list);

	$list = array();
	for($i = 130; $i < 227; $i++){
		$list[$i] = $i;
	}
	$huoniaoTag->assign('heightList', $list);

	//体型
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 3 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('bodytypeList', $list);

	//居住情况
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 4 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('housetagList', $list);

	//工作状态
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 5 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('workstatusList', $list);

	//收入
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 6 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('incomeList', $list);

	//学历
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 7 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('educationList', $list);

	//吸烟
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 8 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('smokeList', $list);

	//饮酒
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 9 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('drinkList', $list);

	//作息时间
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 10 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('workandrestList', $list);

	//购车情况
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 11 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('cartagList', $list);

	//最大消费
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 12 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('maxconsumeList', $list);

	//制造浪漫
	$archives = $dsql->SetQuery("SELECT * FROM `#@__dating_item` WHERE `parentid` = 13 ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($archives, "results");
	$list = array(0 => '请选择');
	foreach($results as $value){
		$list[$value['id']] = $value['typename'];
	}
	$huoniaoTag->assign('romanceList', $list);

	//属性
	$huoniaoTag->assign('propertyVal',array('r'));
	$huoniaoTag->assign('propertyList',array('推荐'));
	$huoniaoTag->assign('property', !empty($property) ? explode(",", $property) : "");

	$huoniaoTag->assign('addr', (int)$addr);
	$huoniaoTag->assign('addrListArr', $dsql->getTypeList(0, "datingaddr", false));

	//区域
	global $data;
	$data = "";
	$addrArr = getParentArr("datingaddr", $addr);
	if($addrArr){
		$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
		$huoniaoTag->assign('addrName', join(" > ", $addrArr));
	}else{
		$huoniaoTag->assign('addrName', "选择区域");
	}

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/dating";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
