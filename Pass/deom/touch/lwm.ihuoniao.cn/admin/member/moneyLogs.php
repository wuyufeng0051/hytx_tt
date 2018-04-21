<?php
/**
 * 现金消费记录
 *
 * @version        $Id: moneyLogs.php 2015-11-11 上午09:37:12 $
 * @package        HuoNiao.Member
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("moneyLogs");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/member";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "moneyLogs.html";

$action = "member_money";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";

	//关键词
	if(!empty($sKeyword)){
		$where1 = array();
		$where1[] = "`info` like '%$sKeyword%'";

		$userSql = $dsql->SetQuery("SELECT `id`, `username` FROM `#@__member` WHERE `username` like '%$sKeyword%'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where1[] = "`userid` in (".join(",", $userid).")";
			}
		}

		$where .= " AND (".join(" OR ", $where1).")";

	}

	if($start != ""){
		$where .= " AND `date` >= ". GetMkTime($start." 00:00:00");
	}
	
	if($end != ""){
		$where .= " AND `date` <= ". GetMkTime($end." 23:59:59");
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."` WHERE 1 = 1".$where);

	//总支出
	$state0 = $dsql->dsqlOper($archives.$where." AND `type` = 0", "totalCount");
	//总收入
	$state1 = $dsql->dsqlOper($archives.$where." AND `type` = 1", "totalCount");

	//总收入
	$add = $dsql->SetQuery("SELECT SUM(`amount`) AS amount FROM `#@__".$action."` WHERE `type` = 1".$where);
	$totalAdd = $dsql->dsqlOper($add, "results");
	$totalAdd = (float)$totalAdd[0]['amount'];

	//总支出
	$less = $dsql->SetQuery("SELECT SUM(`amount`) AS amount FROM `#@__".$action."` WHERE `type` = 0".$where);
	$totalLess = $dsql->dsqlOper($less, "results");
	$totalLess = (float)$totalLess[0]['amount'];
	
	//类型
	if($type != ""){
		$where .= " AND `type` = '$type'";
	}
	$where .= " order by `id` desc";

	//总条数
	$totalCount = $dsql->dsqlOper($archives, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	if($type != ""){

		if($type == 0){
			$totalPage = ceil($state0/$pagestep);
		}elseif($type == 1){
			$totalPage = ceil($state1/$pagestep);
		}

	}
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `userid`, `type`, `amount`, `info`, `date` FROM `#@__".$action."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");
	
	$list = array();

	if(count($results) > 0){
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["userid"] = $value["userid"];
			
			//用户名
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["userid"]);
			$username = $dsql->dsqlOper($userSql, "results");
			if(count($username) > 0){
				$list[$key]["username"] = $username[0]['username'];
			}else{
				$list[$key]["username"] = "未知";
			}
		
			$list[$key]["type"] = $value["type"];
			$list[$key]["amount"] = $value["amount"];
			$list[$key]["date"] = date('Y-m-d H:i:s', $value["date"]);
			$list[$key]["info"] = $value["info"];

		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state1": '.$state1.'}, "totalAdd": '.$totalAdd.', "totalLess": '.$totalLess.', "list": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state1": '.$state1.'}, "totalAdd": '.$totalAdd.', "totalLess": '.$totalLess.'}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state1": '.$state1.'}, "totalAdd": '.$totalAdd.', "totalLess": '.$totalLess.'}';
	}
	die;
	
//删除
}elseif($dopost == "del"){
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){		
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("删除现金消费记录", $id);
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
	}
	die;
	
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		'admin/member/moneyLogs.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/member";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}