<?php
/**
 * 添加团购商家
 *
 * @version        $Id: tuanStoreAdd.php 2015-8-13 下午15:35:21 $
 * @package        HuoNiao.Tuan
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/tuan";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "tuanStoreAdd.html";

$tab = "tuan_store";
$dopost = $dopost ? $dopost : "save";        //操作类型 save添加 edit修改
if($dopost == "edit"){
	$pagetitle = "修改团购商家";
	checkPurview("zjComEdit");
}else{
	$pagetitle = "添加团购商家";
	checkPurview("tuanStoreAdd");
}


//模糊匹配会员
if($action == "checkUser"){

	$key = $_POST['key'];
	if(!empty($key)){
		$where = "";
		if(!empty($id)){
			$where = " AND `id` != $id";
		}
		$userSql = $dsql->SetQuery("SELECT `id`, `username`, `company` FROM `#@__member` WHERE (`username` like '%$key%' OR `company` like '%$key%') AND `mtype` = 2".$where." LIMIT 0, 10");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo json_encode($userResult);
		}
	}
	die;

//获取商圈
}elseif($action == "getCircle"){

	if(!empty($addrid)){

		$sql = $dsql->SetQuery("SELECT * FROM `#@__tuan_circle` WHERE `qid` = $addrid");
		$ret = $dsql->dsqlOper($sql, "results");

		echo json_encode($ret);
	}

	die;

}

if(empty($uid)) $uid = 0;
$circle = isset($circle) ? join(',', $circle) : '';
if(empty($weight)) $weight = 1;
if(empty($state)) $state = 0;
if(empty($click)) $click = mt_rand(50, 200);

if($_POST['submit'] == "提交"){

	if($token == "") die('token传递失败！');

	//二次验证
	if($uid == 0 && trim($company) == ''){
		echo '{"state": 200, "info": "请选择中介"}';
		exit();
	}
	if($uid == 0){
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `company` = '".$company."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			echo '{"state": 200, "info": "会员不存在，请在联想列表中选择"}';
			exit();
		}
		$uid = $userResult[0]['id'];
	}else{
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `id` = ".$uid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			echo '{"state": 200, "info": "会员不存在，请在联想列表中选择"}';
			exit();
		}
	}

	//检测是否已经注册
	if($dopost == "save"){

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `uid` = '".$uid."'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它商家，一个会员不可以管理多个商家！"}';
			exit();
		}

	}else{

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `uid` = '".$uid."' AND `id` != ". $id);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			echo '{"state": 200, "info": "此会员已授权管理其它商家，一个会员不可以管理多个商家！"}';
			exit();
		}
	}


	if(empty($stype)){
		echo '{"state": 200, "info": "请选择商家类型！"}';
		exit();
	}

	if(empty($addrid)){
		echo '{"state": 200, "info": "请选择商家所在地区！"}';
		exit();
	}

	if(empty($circle)){
		echo '{"state": 200, "info": "请选择商家所在商圈！"}';
		exit();
	}

	if(empty($address)){
		echo '{"state": 200, "info": "请输入商家详细地址！"}';
		exit();
	}

	if(empty($tel)){
		echo '{"state": 200, "info": "请输入商家联系电话！"}';
		exit();
	}

	if(empty($openStart)){
		echo '{"state": 200, "info": "请选择营业开始时间！"}';
		exit();
	}

	if(empty($openEnd)){
		echo '{"state": 200, "info": "请选择营业结束时间！"}';
		exit();
	}

	$openStart = str_replace(":", "", $openStart);
	$openEnd   = str_replace(":", "", $openEnd);

}

if($dopost == "save" && $submit == "提交"){

	//保存到表
	$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`uid`, `stype`, `addrid`, `address`, `circle`, `subway`, `lnglat`, `tel`, `openStart`, `openEnd`, `note`, `body`, `jointime`, `click`, `weight`, `state`) VALUES ('$uid', '$stype', '$addrid', '$address', '$circle', '$subway', '$lnglat', '$tel', '$openStart', '$openEnd', '$note', '$body', '".GetMkTime(time())."', '$click', '$weight', '$state')");
	$aid = $dsql->dsqlOper($archives, "lastid");

	if($aid){
		adminLog("添加团购商家信息", $title);
		echo '{"state": 100, "id": "'.$aid.'"}';
	}else{
		echo '{"state": 200, "info": '.json_encode("保存到数据库失败！").'}';
	}
	die;
}elseif($dopost == "edit"){

	if($submit == "提交"){


		//查询信息之前的状态
		$sql = $dsql->SetQuery("SELECT `state` FROM `#@__".$tab."` WHERE `id` = $id");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$state_ = $ret[0]['state'];

			//会员消息通知
			if($state != $state_){

				$status = "";

				//等待审核
				if($state == 0){
					$status = "进入等待审核状态。";

				//已审核
				}elseif($state == 1){
					$status = "已经通过审核。";

				//审核失败
				}elseif($state == 2){
					$status = "审核失败，请检查您填写的资料。";
				}

				$param = array(
					"service"  => "member",
					"template" => "config",
					"action"   => "tuan"
				);

				//获取会员名
				$username = "";
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}

				updateMemberNotice($uid, "会员-店铺审核通知", $param, array("username" => $username, "title" => $title, 'status' => $status, "date" => date("Y-m-d H:i:s", time())));

			}

		}


		//保存到表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `uid` = '$uid', `stype` = '$stype', `addrid` = '$addrid', `address` = '$address', `circle` = '$circle', `subway` = '$subway', `lnglat` = '$lnglat', `tel` = '$tel', `openStart` = '$openStart', `openEnd` = '$openEnd', `note` = '$note', `body` = '$body', `click` = '$click', `weight` = '$weight', `state` = '$state' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results == "ok"){
			adminLog("修改团购商家信息", $title);
			echo '{"state": 100, "info": '.json_encode('修改成功！').'}';
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

			$uid       = $results[0]['uid'];
			$stype     = $results[0]['stype'];
			$addrid    = $results[0]['addrid'];
			$address   = $results[0]['address'];
			$circle    = $results[0]['circle'];
			$subway    = $results[0]['subway'];
			$lnglat    = $results[0]['lnglat'];
			$tel       = $results[0]['tel'];
			$openStart = $results[0]['openStart'];
			$openEnd   = $results[0]['openEnd'];
			$note      = $results[0]['note'];
			$body      = $results[0]['body'];
			$score     = $results[0]['score'];
			$click     = $results[0]['click'];
			$weight    = $results[0]['weight'];
			$state     = $results[0]['state'];

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
		'ui/bootstrap.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		'admin/tuan/tuanStoreAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('mapCity', $cfg_mapCity);


	$huoniaoTag->assign('id', $id);

	if($dopost == "edit"){
		//会员
		$huoniaoTag->assign('uid', $uid);
		$userSql = $dsql->SetQuery("SELECT `id`, `company` FROM `#@__member` WHERE `id` = ". $uid);
		$username = $dsql->getTypeName($userSql);
		$huoniaoTag->assign('company', $username[0]["company"]);

		//区域
		$huoniaoTag->assign('addrid', $addrid);
		$addrSql = $dsql->SetQuery("SELECT `typename` FROM `#@__site_area` WHERE `id` = ". $addrid);
		$addrname = $dsql->getTypeName($addrSql);
		$huoniaoTag->assign('addrname', $addrname[0]["typename"]);

		//分类
		$huoniaoTag->assign('stype', $stype);
		$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__tuantype` WHERE `id` = ". $stype);
		$typename = $dsql->getTypeName($typeSql);
		$huoniaoTag->assign('typename', $typename[0]["typename"]);

		//附近地铁站
		$huoniaoTag->assign('subway', $subway);
		$subwaySelected = "";
		if(!empty($subway)){
			$subway = explode(",", $subway);
			foreach($subway as $val){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__site_subway_station` WHERE `id` = $val");
				$results = $dsql->dsqlOper($archives, "results");
				$name = $results ? $results[0]['title'] : "";
				$subwaySelected .= '<span data-id="'.$val.'">'.$name.'<a href="javascript:;">×</a></span>';
			}
		}
		$huoniaoTag->assign('subwaySelected', $subwaySelected);

		$open1 = substr($openStart, 0, 2);
		$open2 = substr($openStart, 2);
		$huoniaoTag->assign('openStart', $open1.":".$open2);

		$end1 = substr($openEnd, 0, 2);
		$end2 = substr($openEnd, 2);
		$huoniaoTag->assign('openEnd', $end1.":".$end2);
	}else{
		$huoniaoTag->assign('uid', 0);
		$huoniaoTag->assign('company', "");
		$huoniaoTag->assign('addrid', 0);
		$huoniaoTag->assign('addrname', "选择地区");
		$huoniaoTag->assign('stype', 0);
		$huoniaoTag->assign('typename', "选择分类");
	}

	$huoniaoTag->assign('address', $address);
	$huoniaoTag->assign('circle', !empty($circle) ? json_encode(explode(",", $circle)) : "[]");
	$huoniaoTag->assign('lnglat', $lnglat);
	$huoniaoTag->assign('tel', $tel);

	$huoniaoTag->assign('note', $note);
	$huoniaoTag->assign('body', $body);

	$huoniaoTag->assign('click', $click);
	$huoniaoTag->assign('weight', $weight == "" ? "50" : $weight);

	//显示状态
	$huoniaoTag->assign('stateopt', array('0', '1', '2'));
	$huoniaoTag->assign('statenames',array('待审核','已审核','审核拒绝'));
	$huoniaoTag->assign('state', $state == "" ? 1 : $state);

	$huoniaoTag->assign('typeListArr', json_encode($dsql->getTypeList(0, "tuantype")));


	//区域
	$addrListArr = array();
	$sql = $dsql->SetQuery("SELECT c.*, a.`typename` FROM `#@__tuan_city` c LEFT JOIN `#@__site_area` a ON a.`id` = c.`cid` ORDER BY c.`id`");
	$ret = $dsql->dsqlOper($sql, "results");
	if($ret){
		foreach ($ret as $key => $value) {
			$addrListArr[$key]['id'] = $value['cid'];
			$addrListArr[$key]['typename'] = $value['typename'];

			$sql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__site_area` WHERE `parentid` = ".$value['cid']." ORDER BY `weight`");
			$res = $dsql->dsqlOper($sql, "results");
			$addrListArr[$key]['lower'] = $res;
		}
	}

	$huoniaoTag->assign('addrListArr', json_encode($addrListArr));
	// $huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "tuanaddr", false)));

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/tuan";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
