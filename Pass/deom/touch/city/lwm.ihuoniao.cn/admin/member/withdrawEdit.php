<?php
/**
 * 查看修改提现详细信息
 *
 * @version        $Id: withdrawEdit.php 2013-12-11 上午10:53:46 $
 * @package        HuoNiao.Member
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("withdraw");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/member";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "withdrawEdit.html";

$action     = "member_withdraw";
$pagetitle  = "提现详细信息";
$dopost     = $dopost ? $dopost : "edit";

if($dopost != ""){
	//对字符进行处理
	$note   = cn_substrR($note,200);
	$time   = GetMkTime(time());
}

if($dopost == "edit"){

	$pagetitle = "修改团购订单信息";

	if($submit == "提交"){

		//表单二次验证
		if(trim($state) == ''){
			echo '{"state": 200, "info": "请选择更新到的状态"}';
			exit();
		}
		if(trim($note) == ''){
			echo '{"state": 200, "info": "请输入提现结果"}';
			exit();
		}

		//保存
		$archives = $dsql->SetQuery("UPDATE `#@__".$action."` SET `note` = '$note', `state` = '$state', `rdate` = '$time' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results != "ok"){
			echo '{"state": 200, "info": "保存失败！"}';
			exit();
		}


		$sql = $dsql->SetQuery("SELECT `uid`, `amount` FROM `#@__".$action."` WHERE `id` = ".$id);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$uid    = $ret[0]['uid'];
			$amount = $ret[0]['amount'];

			$param = array(
				"service"  => "member",
				"type"     => "user",
				"template" => "withdraw_log_detail",
				"id"       => $id
			);

			//查询会员信息
			$username = "";
			$sql = $dsql->SetQuery("SELECT `username`, `mtype` FROM `#@__member` WHERE `id` = $uid");
			$results = $dsql->dsqlOper($sql, "results");
			if($results){
				$username = $results[0]['username'];
				if($results[0]['mtype'] == 2){
					$param = array(
						"service"  => "member",
						"template" => "withdraw_log_detail",
						"id"       => $id
					);
				}
			}

			//提现成功，减少会员的冻结金额，并且增加明细日志
			if($state == 1){

				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `freeze` = `freeze` - '$amount' WHERE `id` = '$uid'");
				$dsql->dsqlOper($archives, "update");

				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '提现', '$time')");
				$aid = $dsql->dsqlOper($archives, "lastid");

				updateMemberNotice($uid, "会员-提现申请审核通过", $param, array("username" => $username, "amount" => $amount, "date" => date("Y-m-d H:i:s", $time), "info" => $note));


			//提现失败，减少会员的冻结金额，增加可用余额
			}elseif($state == 2){

				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$amount', `freeze` = `freeze` - '$amount' WHERE `id` = '$uid'");
				$dsql->dsqlOper($archives, "update");

				updateMemberNotice($uid, "会员-提现申请审核失败", $param, array("username" => $username, "amount" => $amount, "date" => date("Y-m-d H:i:s", $time), "info" => $note));

			}

		}



		adminLog("更新提现状态", $id);

		echo '{"state": 100, "info": "修改成功！"}';
		exit();

	}else{
		if(!empty($id)){

			//主表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$action."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){

				$uid = $results[0]["uid"];

				//用户名
				$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $uid);
				$username = $dsql->dsqlOper($userSql, "results");
				if(count($username) > 0){
					$username = $username[0]['username'];
				}else{
					$username = "未知";
				}

				$bank   = $results[0]["bank"];
				$cardnum   = $results[0]["cardnum"];
				$cardname   = $results[0]["cardname"];
				$amount   = $results[0]["amount"];
				$tdate = date('Y-m-d H:i:s', $results[0]["tdate"]);
				$state = $results[0]["state"];
				$rdate = $results[0]["rdate"];
				$note = $results[0]["note"];

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
		'admin/member/withdrawEdit.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('id', $id);
	$huoniaoTag->assign('uid', $uid);
	$huoniaoTag->assign('username', $username);
	$huoniaoTag->assign('bank', $bank);
	$huoniaoTag->assign('cardnum', $cardnum);
	$huoniaoTag->assign('cardname', $cardname);
	$huoniaoTag->assign('amount', $amount);
	$huoniaoTag->assign('tdate', $tdate);
	$huoniaoTag->assign('state', $state);
	$huoniaoTag->assign('note', $note);
	$huoniaoTag->assign('rdate', $rdate == 0 ? 0 : date("Y-m-d H:i:s", $rdate));

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/member";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
