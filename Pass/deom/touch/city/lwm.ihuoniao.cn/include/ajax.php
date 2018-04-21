<?php
//接口API测试

//系统核心配置文件
require_once('../include/common.inc.php');

if(empty($service)) return;

//引入配置文件
if($service != "system" && $service != "member"){
	require_once(HUONIAOINC."/config/".$service.".inc.php");
}

$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);

//声明以下均为接口类
$handler = true;

//拼接请求参数
$param = array();
foreach ($_GET as $key => $value) {
	if($key != "service" && $key != "action" && $key != "callback" && $key != "_"){
		$param[$key] = $value;
	}
}
foreach ($_POST as $key => $value) {
	if($key != "service" && $key != "action" && $key != "callback" && $key != "_"){
		$param[$key] = $value;
	}
}

// foreach ($_REQUEST as $key => $value) {
// 	if($key != "service" && $key != "action" && $key != "callback" && $key != "_"){
// 		$param[$key] = $value;
// 	}
// }

//获取服务器时间
if($action == "getSysTime"){

	$now      = GetMkTime(time());
	$today    = GetMkTime(date("Y-m-d"));
	$nextHour = GetMkTime(date("Y-m-d H", $now + 3600).":00:00");
	$nextDay  = GetMkTime(date("Y-m-d", strtotime("+1 day")));
	$return = array(
		"now"      => $now,
		"today"    => $today,
		"nextHour" => $nextHour,
		"nextDay"  => $nextDay
	);


//获取登录用户信息
}elseif($action == "getMemberID"){

	die($userLogin->getMemberID());


//微信登录
}elseif($action == "checkWxlogin"){

	if($state){

		//查询临时表
		$sql = $dsql->SetQuery("SELECT `uid` FROM `#@__site_wxlogin` WHERE `state` = '$state'");
		$ret = $dsql->dsqlOper($sql, "results");

		//查询登录用户信息
		if($ret){
			$uid = $ret[0]['uid'];

			if($uid){
				$sql = $dsql->SetQuery("SELECT `id`, `username` FROM `#@__member` WHERE `state` = 1 AND `id` = $uid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){

					//登录
					global $cfg_cookiePath;
					global $cfg_onlinetime;
					$RenrenCrypt = new RenrenCrypt();
					$userid = base64_encode($RenrenCrypt->php_encrypt($uid));
					PutCookie("login_user", $userid, $cfg_onlinetime * 60 * 60, $cfg_cookiePath);

					//论坛同步
					global $cfg_bbsState;
					global $cfg_bbsType;
					if($cfg_bbsState == 1 && $cfg_bbsType != ""){

						$username = $ret[0]['username'];
						$password = substr($state, 0, 20);

						$data['username'] = $username;
						$data['uPwd']     = $password;
						$userLogin->bbsSync($data, "synlogin");
					}

					$sql = $dsql->SetQuery("DELETE FROM `#@__site_wxlogin` WHERE `state` = '$state'");
					$dsql->dsqlOper($sql, "update");

					if($callback){
						echo $callback."(".json_encode(array("state" => 100, "info" => "登录成功！")).")";
					}else{
						echo json_encode(array("state" => 100, "info" => "登录成功！"));
					}

				}else{
					if($callback){
						echo $callback."(".json_encode(array("state" => 101, "info" => "会员状态验证错误，登录失败！")).")";
					}else{
						echo json_encode(array("state" => 101, "info" => "会员状态验证错误，登录失败！"));
					}
				}
			}else{
				if($callback){
					echo $callback."(".json_encode(array("state" => 101, "info" => "等待扫描！")).")";
				}else{
					echo json_encode(array("state" => 101, "info" => "等待扫描！"));
				}
			}
		}else{
			if($callback){
				echo $callback."(".json_encode(array("state" => 101, "info" => "登录失败，请重试！")).")";
			}else{
				echo json_encode(array("state" => 101, "info" => "登录失败，请重试！"));
			}
		}

	}else{
		if($callback){
			echo $callback."(".json_encode(array("state" => 101, "info" => "请求错误，请重试！")).")";
		}else{
			echo json_encode(array("state" => 101, "info" => "请求错误，请重试！"));
		}
	}
	die;


//首次加载Geetest极验验证
}elseif($action == "geetest"){

	global $handler;
	$handler = false;
	if($terminal == "mobile"){
		$GtSdk = new geetestlib($cfg_geetest_mobile_id, $cfg_geetest_mobile_key);
	}else{
		$GtSdk = new geetestlib($cfg_geetest_pc_id, $cfg_geetest_pc_key);
	}
	$userid = $userLogin->getMemberID();
	$status = $GtSdk->pre_process($userid);
	$_SESSION['gtserver'] = $status;
	$_SESSION['user_id'] = $userid;
	echo $GtSdk->get_response_str();die;


}else{
	//获取接口数据
	$handels = new handlers($service, $action);
	$return = $handels->getHandle($param);

	if($pageInfo == 1 && $return['state'] == 100){
		$return = $return['info']['pageInfo'];
	}
}

//输出到浏览器
if($callback){
	echo $callback."(".json_encode($return).")";
}else{
	echo json_encode($return);
}
