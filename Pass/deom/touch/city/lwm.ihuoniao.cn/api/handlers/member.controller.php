<?php

/**
 * huoniaoTag模板标签函数插件-会员中心
 *
 * @param $params array 参数集
 * @return array
 */
function member($params, $content = "", &$smarty = array(), &$repeat = array()){
	$service = "member";
	extract ($params);
	if(empty($action)) return '';

	global $huoniaoTag;
	global $dsql;
	global $userLogin;
	global $cfg_basehost;
	global $template;
	global $cfg_errLoginCount;
	global $cfg_loginLock;

	$loginCount = $cfg_errLoginCount;   //登录错误次数限制
	$loginTimes = $cfg_loginLock;       //登录错误次数太多后需要等待的时间（单位：分钟）

	//登录页面
	if($action == "login" || $action == "login_popup"){

		$url = $furl ? urldecode($furl) : $_SERVER['HTTP_REFERER'];
		if(strstr($url, "logout.html") || strstr($url, "login.html") || empty($url)){
			$url = "http://".$cfg_basehost;
		}

		//检验用户登录状态
		if($userLogin->getMemberID() > -1){

			if($action == "login"){
				header('location:'.$url);
			}

			$huoniaoTag->assign('isLogin', 1);
		}

		global $cfg_seccodestatus;
		$seccodestatus = explode(",", $cfg_seccodestatus);
		$loginCode = "";
		if(in_array("login", $seccodestatus)){
			$loginCode = 1;
		}
		$huoniaoTag->assign('loginCode', $loginCode);
		$huoniaoTag->assign("redirectUrl", $url);
		$huoniaoTag->assign('site', $site);

		$_SESSION['loginRedirect'] = $url;
		return;

	//单点登录页面
	}elseif($action == "sso"){

		//单点登录、退出
		if($do == "sso"){

			$userinfo = "";
			if($userid){
				$RenrenCrypt = new RenrenCrypt();
				$uid = $RenrenCrypt->php_decrypt(base64_decode($userid));
				$uinfo = $userLogin->getMemberInfo($uid);

				$userinfo['uid']      = $userid;
				$userinfo['userid']   = $uinfo['userid'];
				$userinfo['userType'] = $uinfo['userType'];
				$userinfo['username'] = $uinfo['username'];
				$userinfo['nickname'] = $uinfo['nickname'];
				$userinfo['photo']    = $uinfo['photo'];
				$userinfo['message']  = $uinfo['message'];

				//根据会员类型不同，返回不同的域名
				global $userDomain;
				global $busiDomain;
				$domain = $userDomain;
				if($uinfo['userType'] == 2){
					$domain = $busiDomain;
				}
				$userinfo['userDomain'] = $domain;

				$userinfo = json_encode($userinfo);
			}
			$huoniaoTag->assign('do', $do);
			$huoniaoTag->assign('userArr', $userinfo);

		}else{

			//获取主站用户信息
			$userid = "";
			$mid = $userLogin->getMemberID();
			if($mid > -1){
				$RenrenCrypt = new RenrenCrypt();
				$userid = base64_encode($RenrenCrypt->php_encrypt($mid));
			}

			$huoniaoTag->assign('site', $site);
			$huoniaoTag->assign('userid', $userid);

		}
		return;


	//判断登录
	}elseif($action == "loginCheck"){

		//判断是否提交
		if(empty($_GET)) {
			header('location:http://'.$cfg_basehost);
			die();
		}

		//检验用户登录状态
		if($userLogin->getMemberID() != -1){

			echo '<span style="display:none;">1001</span>';
			die;

		}else{

			//判断验证码
			global $cfg_seccodestatus;
			$seccodestatus = explode(",", $cfg_seccodestatus);
			if(in_array("login", $seccodestatus)){
				if(strtolower($vericode) != $_SESSION['huoniao_vdimg_value']){
					echo "202|验证码输入错误，请重试！";
					die;
				}
			}

			$ip = GetIP();
			$ipaddr = getIpAddr($ip);
			$archives = $dsql->SetQuery("SELECT * FROM `#@__failedlogin` WHERE `ip` = '$ip'");
			$results = $dsql->dsqlOper($archives, "results");

			//登录前验证
			if($results){
				$count = $results[0]['count'];
				$timedifference = GetMkTime(time()) - $results[0]['date'];
				if($timedifference/60 < $loginTimes && $count >= $loginCount && $loginCount > 0 && $loginTimes > 0){
					echo '201|您错误的次数太多，请'.ceil($loginTimes-$timedifference/60).'分钟后重试！';
					die;
				}
			}

			$res = $userLogin->memberLogin($username, $password);

			//success
			if($res == 1){
				$userid = $userLogin->getMemberID();

				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `logincount` = `logincount` + 1, `lastlogintime` = ".GetMkTime(time()).", `lastloginip` = '".$ip."', `lastloginipaddr` = '".$ipaddr."' WHERE `id` = ".$userid);
				$dsql->dsqlOper($archives, "update");

				//保存到主表
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_login` (`userid`, `logintime`, `loginip`, `ipaddr`) VALUES ('$userid', '".GetMkTime(time())."', '$ip', '$ipaddr')");
				$dsql->dsqlOper($archives, "update");

				echo '<span style="display:none;">100</span>';
				die;

			//error
			}else if($res == -1 || $res == -2){

				//如果有记录则错误次数加1
				if($results){
					//计算最后一次错误是否是在$loginTimes分钟之前，如果是则重置错误次数
					if($timedifference/60 > $loginTimes){
						$count = 1;
					}else{
						$count = $results[0]['count'] >= $loginCount ? 0 : $results[0]['count'];
						$count++;
					}
					$archives = $dsql->SetQuery("UPDATE `#@__failedlogin` SET `count` = ".$count.", `date` = ".GetMkTime(time())." WHERE `ip` = '".$ip."'");
					$results = $dsql->dsqlOper($archives, "update");

				//没有记录则新增一条
				}else{
					$count = 1;
					$archives = $dsql->SetQuery("INSERT INTO `#@__failedlogin` (`ip`, `count`, `date`) VALUES ('$ip', $count, ".GetMkTime(time()).")");
					$results = $dsql->dsqlOper($archives, "update");
				}

				echo '201|用户名或密码错误，请重试！';
				die;

			}
		}
		return;

	//退出登录
	}elseif($action == "logout"){

		$userLogin->exitMember();
		$url = $_SERVER['HTTP_REFERER'];
		if(strstr($url, "logout.html") || strstr($url, "fpwd.html") || strstr($url, "register.html") || empty($url)){
			$url = "http://".$cfg_basehost;
		}

		//判断是否开启论坛同步，如果开启则显示退出过程，如果没有开启，程序自动跳走
		global $cfg_bbsState;
		global $cfg_bbsType;
		if($cfg_bbsState == 1 && $cfg_bbsType != ""){
			$huoniaoTag->assign("redirectUrl", $url);
		}else{
			header('location:'.$url);
			die;
		}
		return;

	//注册页面
	}elseif($action == "register"){

		//检验用户登录状态
		if($userLogin->getMemberID() > -1){
			global $cfg_basehost;
			$url = "http://".$cfg_basehost;
			header('location:'.$url);
			die;
		}

		global $cfg_seccodestatus;
		global $cfg_regstatus;
		global $cfg_regclosemessage;
		if($cfg_regstatus == 0){
			die($cfg_regclosemessage);
		}

		$seccodestatus = explode(",", $cfg_seccodestatus);
		$regCode = "";
		if(in_array("reg", $seccodestatus)){
			$regCode = 1;
		}
		$huoniaoTag->assign('regCode', $regCode);

		global $cfg_secqaastatus;
		$secqaastatus = explode(",", $cfg_secqaastatus);
		$regQa = "";
		if(in_array("reg", $secqaastatus)){
			$regQa = 1;
		}
		$huoniaoTag->assign('regQa', $regQa);

		//随机选择一条问题
		$archives = $dsql->SetQuery("SELECT * FROM `#@__safeqa` ORDER BY RAND() LIMIT 1");
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$huoniaoTag->assign('question', $results[0]['id']);
			$huoniaoTag->assign('regQuestion', $results[0]['question']);
		}

		return;

	//判断注册
	}elseif($action == "registerCheck"){

		global $cfg_regstatus;
		global $cfg_regclosemessage;
		if($cfg_regstatus == 0){
			die('200|'.$cfg_regclosemessage);
		}

		//验证用户名
		if(empty($username)){
			die('201|请输入用户名！');
		}
		preg_match("/^[a-zA-Z]{1}[0-9a-zA-Z_]{4,15}$/iu", $username, $matchUsername);
		if(!$matchUsername){
			die('201|用户名格式有误！<br />英文字母、数字、下划线以内的5-20个字！<br />并且只能以字母开头！');
		}
		if(!checkMember($username)){
			die('201|用户名已存在！');
		}

		//验证密码
		if(empty($password)){
			die('202|请输入密码');
		}
		preg_match('/^.{5,}$/', $password, $matchPassword);
		if(!$matchPassword){
			die('202|密码长度最少为5位！');
		}

		//真实姓名
		if(empty($nickname)){
			die('203|请输入真实姓名');
		}
		preg_match('/^[a-z\/ ]{2,20}$/iu', $nickname, $matchNickname);
		preg_match('/^[\x{4e00}-\x{9fa5} ]{2,20}$/iu', $nickname, $matchNickname1);
		if(!$matchNickname && !$matchNickname1){
			die('203|真实姓名格式有误！<br />中文、英文字母、空格、反斜线(/)以内的2-20个字！<br />如：刘德华、刘 德华、Last/Frist Middle');
		}

		//邮箱
		if(empty($email)){
			die('204|请输入邮箱！');
		}
		preg_match('/\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/', $email, $matchEmail);
		if(!$matchEmail){
			die('204|邮箱格式有误！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `email` = '$email'");
		$return = $dsql->dsqlOper($archives, "results");
		if($return){
			die('204|此邮箱已被注册！');
		}

		//手机
		if(empty($phone)){
			die('205|请输入手机号码');
		}
		preg_match('/0?(13|14|15|17|18)[0-9]{9}/', $phone, $matchPhone);
		if(!$matchPhone){
			die('205|手机格式有误');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `phone` = '$phone'");
		$return = $dsql->dsqlOper($archives, "results");
		if($return){
			die('205|此手机号已被注册');
		}

		if($mtype == 2){
			if(empty($company)){
				die('206|请输入公司名称');
			}
		}

		//判断安全问题
		global $cfg_secqaastatus;
		$secqaastatus = explode(",", $cfg_secqaastatus);
		if(in_array("reg", $secqaastatus)){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__safeqa` WHERE `id` = $question AND `answer` = '".$answer."'");
			$results = $dsql->dsqlOper($archives, "results");
			if(!$results){
				die('207|安全问题输入错误，请重试！');
			}
		}

		//判断验证码
		global $cfg_seccodestatus;
		$seccodestatus = explode(",", $cfg_seccodestatus);
		if(in_array("reg", $seccodestatus)){
			if(strtolower($vericode) != $_SESSION['huoniao_vdimg_value']){
				die('208|验证码输入错误，请重试！');
			}
		}

		$passwd   = $userLogin->_getSaltedHash($password);
		$regtime  = GetMkTime(time());
		$regip    = GetIP();
		$regipaddr = getIpAddr($regip);

		$archives = $dsql->SetQuery("SELECT `regtime` FROM `#@__member` WHERE `regip` = '$regip' ORDER BY `id` DESC LIMIT 0, 1");
		$return = $dsql->dsqlOper($archives, "results");
		if($return){
			global $cfg_regtime;
			if(round(($regtime - $return[0]['regtime'])/60) < $cfg_regtime){
				die('200|本站限制每次注册间隔时间为'.$cfg_regtime.'分钟，请稍后再注册。');
			}
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__member` (`mtype`, `username`, `password`, `nickname`, `email`, `emailCheck`, `phone`, `phoneCheck`, `company`, `regtime`, `regip`, `regipaddr`, `state`) VALUES ('$mtype', '$username', '$passwd', '$nickname', '$email', '0', '$phone', '0', '$company', '$regtime', '$regip', '$regipaddr', '0')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if($aid){

			//论坛同步
			$data['username'] = $username;
			$data['password'] = $password;
			$data['email']    = $email;
			$userLogin->bbsSync($data, "register");

			//自动登录
			$ureg = $userLogin->memberLogin($username, $password);

			$RenrenCrypt = new RenrenCrypt();
			$userid = base64_encode($RenrenCrypt->php_encrypt($aid));

			//注册验证
			global $cfg_regverify;

			//不验证
			if($cfg_regverify == 0){
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `state` = 1 WHERE `id` = '$aid'");
				$dsql->dsqlOper($archives, "update");

				// die('100|http://'.$cfg_basehost.'/registerSuccess.html');
				die('100|http://'.$cfg_basehost);

			//邮箱验证
			}elseif($cfg_regverify == 1){
				die('100|http://'.$cfg_basehost.'/registerVerifyEmail.html?userid='.$userid);

			//手机验证
			}elseif($cfg_regverify == 2){
				die('100|http://'.$cfg_basehost.'/registerVerifyPhone.html?userid='.$userid);

			}

		}else{
			die('200|注册失败，请稍候重试！');
		}
		return;


	//判断注册用户名、邮件、手机
	}elseif($action == "registerCheck_v1"){

		$mtype = !empty($mtype) ? $mtype : 1;
		$regtime  = GetMkTime(time());
		$regip    = GetIP();
		$regipaddr = getIpAddr($regip);

		$archives = $dsql->SetQuery("SELECT `regtime` FROM `#@__member` WHERE `regip` = '$regip' ORDER BY `id` DESC LIMIT 0, 1");
		$return = $dsql->dsqlOper($archives, "results");
		if($return){
			global $cfg_regtime;
			if(round(($regtime - $return[0]['regtime'])/60) < $cfg_regtime){
				die('200|本站限制每次注册间隔时间为'.$cfg_regtime.'分钟，请稍后再注册。');
			}
		}

		$passwd    = $userLogin->_getSaltedHash($password);

		//用户名
		if($rtype == 1){

			if(empty($username)) die('201|请输入用户名！');
			if(empty($password)) die('201|请输入登录密码！');
			if(empty($vericode)) die('201|请输入验证码！');

			if(!checkMember($username)){
				die('201|用户名已存在！');
			}

			if(strtolower($vericode) != $_SESSION['huoniao_vdimg_value']){
				die('201|验证码输入错误，请重试！');
			}

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__member` (`mtype`, `username`, `password`, `nickname`, `regtime`, `regip`, `regipaddr`, `state`) VALUES ('$mtype', '$username', '$passwd', '$username', '$regtime', '$regip', '$regipaddr', '1')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if($aid){

				//自动登录
				$ureg = $userLogin->memberLogin($username, $password);
				die('100|http://'.$cfg_basehost);

			}else{
				die('200|注册失败，请稍候重试！');
			}

		}


		//邮箱
		if($rtype == 2){

			if(empty($account)) die('201|请输入邮箱地址！');
			if(empty($vcode)) die('201|请输入邮箱验证码！');
			if(empty($password)) die('201|请输入登录密码！');

			preg_match('/\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/', $account, $matchEmail);
			if(!$matchEmail){
				die('204|邮箱格式有误！');
			}

			$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `email` = '$account'");
			$return = $dsql->dsqlOper($archives, "results");
			if($return){
				die('204|此邮箱已被注册！');
			}


			//验证输入的验证码
			$archives = $dsql->SetQuery("SELECT `id`, `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'email' AND `lei` = 'signup' AND `user` = '$account' AND `code` = '$vcode'");
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				die('204|验证码输入错误，请重试！');
			}else{

				//5分钟有效期
				if(round(($regtime - $results[0]['pubdate'])/3600) > 24) die('204|验证码已过期，请重新获取！');

				//验证通过删除发送的验证码
				$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'email' AND `lei` = 'signup' AND `user` = '$account' AND `code` = '$vcode'");
				$dsql->dsqlOper($archives, "update");
			}


			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__member` (`mtype`, `username`, `password`, `nickname`, `email`, `emailCheck`, `regtime`, `regip`, `regipaddr`, `state`) VALUES ('$mtype', '$account', '$passwd', '$account', '$account', '1', '$regtime', '$regip', '$regipaddr', '1')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if($aid){

				//论坛同步
				$accountData = explode("@", $account);
				$data['username'] = $accountData[0];
				$data['password'] = $password;
				$data['email']    = $account;
				$userLogin->bbsSync($data, "register");

				//自动登录
				$ureg = $userLogin->memberLogin($account, $password);
				die('100|http://'.$cfg_basehost);


			}else{
				die('200|注册失败，请稍候重试！');
			}


		}


		//手机
		if($rtype == 3){

			if(empty($account)) die('201|请输入手机号码！');
			if(empty($vcode)) die('201|请输入短信验证码！');
			if(empty($password)) die('201|请输入登录密码！');

			if(empty($account)){
				die('205|请输入手机号码');
			}
			preg_match('/0?(13|14|15|17|18)[0-9]{9}/', $account, $matchPhone);
			if(!$matchPhone){
				die('205|手机格式有误');
			}

			$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `phone` = '$account'");
			$return = $dsql->dsqlOper($archives, "results");
			if($return){
				die('205|此手机号已被注册');
			}


			//验证输入的验证码
			$archives = $dsql->SetQuery("SELECT `id`, `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'signup' AND `user` = '$account' AND `code` = '$vcode'");
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				die('205|验证码输入错误，请重试！');
			}else{

				//5分钟有效期
				if($regtime - $results[0]['pubdate'] > 300) die('205|验证码已过期，请重新获取！');

				//验证通过删除发送的验证码
				$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'signup' AND `user` = '$account' AND `code` = '$vcode'");
				$dsql->dsqlOper($archives, "update");
			}


			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__member` (`mtype`, `username`, `password`, `nickname`, `phone`, `phoneCheck`, `regtime`, `regip`, `regipaddr`, `state`) VALUES ('$mtype', '$account', '$passwd', '$account', '$account', '1', '$regtime', '$regip', '$regipaddr', '1')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if($aid){

				//自动登录
				$ureg = $userLogin->memberLogin($account, $password);
				die('100|http://'.$cfg_basehost);


			}else{
				die('200|注册失败，请稍候重试！');
			}

		}
		return;


	//注册成功，不需要验证
	}elseif($action == "registerSuccess"){

		$memberId = $userLogin->getMemberID();
		if($memberId > -1){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `id` = '$memberId'");
			$return = $dsql->dsqlOper($archives, "results");
			if($return){

				$huoniaoTag->assign('username', $return[0]['username']);
				$huoniaoTag->assign('email', $return[0]['email']);
				$huoniaoTag->assign('phone', $return[0]['phone']);

			}else{
				die('会员不存在！');
			}

		}else{
			$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			header('location:http://'.$cfg_basehost.'/login.html?furl='.$furl);
		}
		return;

	//注册成功，邮箱验证
	}elseif($action == "registerVerifyEmail"){

		$RenrenCrypt = new RenrenCrypt();
		$uid = $RenrenCrypt->php_decrypt(base64_decode($userid));

		if(!empty($userid)){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `id` = '$uid'");
			$return = $dsql->dsqlOper($archives, "results");
			if($return){

				$username   = $return[0]['username'];
				$email      = $return[0]['email'];
				$state      = $return[0]['state'];

				global $cfg_webname;
				global $cfg_basehost;

				if(empty($return[0]['sendEmail'])){
					if($state == 0){

						//获取邮件内容
						$cArr = getInfoTempContent("mail", '会员-帐号激活-发送邮件', array("email" => $email, "userid" => $userid));
						$title = $cArr['title'];
						$content = $cArr['content'];

						if($title == "" && $content == ""){
							// showMsg("邮件通知功能未开启，邮件发送失败！", "login.html?furl=".$furl);
						}

						sendmail($email, $title, $content);

						$now = GetMkTime(time());
						$archives = $dsql->SetQuery("UPDATE `#@__member` SET `sendEmail` = ".$now." WHERE `id` = '$uid'");
						$dsql->dsqlOper($archives, "update");

					}else{
						$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
						showMsg("您已完成邮箱验证，请登录！", "login.html?furl=".$furl);
						die;
					}
				}

				$huoniaoTag->assign('email', $email);

			}else{
				die('会员不存在！');
			}

		}else{
			$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			header('location:http://'.$cfg_basehost.'/login.html?furl='.$furl);
		}
		return;

	//邮箱验证
	}elseif($action == "memberVerifyEmail"){

		$RenrenCrypt = new RenrenCrypt();
		$uid = $RenrenCrypt->php_decrypt(base64_decode($userid));

		if(!empty($userid)){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `id` = '$uid'");
			$return = $dsql->dsqlOper($archives, "results");
			if($return){

				$username   = $return[0]['username'];
				$email      = $return[0]['email'];
				$state      = $return[0]['state'];
				$sendEmail  = $return[0]['sendEmail'];

				if($state != 0){
					$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					showMsg("您已完成邮箱验证，请登录！", "login.html?furl=".$furl);
					die;
				}

				$regtime  = GetMkTime(time());
				if(round(($regtime - $sendEmail)/3600) > 24){

					$archives = $dsql->SetQuery("DELETE FROM `#@__member` WHERE `id` = ".$uid);
					$dsql->dsqlOper($archives, "update");

					showMsg("您的邮件验证已超过24小时的有效时间，请重新注册！", "register.html");
					die;
				}

				global $cfg_webname;
				global $cfg_basehost;

				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `state` = 1, `emailCheck` = 1 WHERE `id` = '$uid'");
				$dsql->dsqlOper($archives, "update");

				$huoniaoTag->assign('username', $username);
				$huoniaoTag->assign('email', $email);

				global $cfg_cookiePath;
				global $cfg_onlinetime;
				PutCookie("login_user", $userid, $cfg_onlinetime * 60 * 60, $cfg_cookiePath);

			}else{
				die('会员不存在！');
			}

		}else{
			$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			header('location:http://'.$cfg_basehost.'/login.html?furl='.$furl);
		}
		return;

	//获取登录用户信息
	}elseif($action == "getUserInfo"){

		$userinfo = array();
		if($userLogin->getMemberID() > -1){
			$userinfo = $userLogin->getMemberInfo();
		}
		if($userinfo){
			if($callback){
				echo $callback.'('.json_encode($userinfo).')';
			}else{
				echo json_encode($userinfo);
			}
		}
		die;

	//站内消息
	}elseif($action == "message"){

		$userLogin->checkUserIsLogin();

		$page = empty($page) ? 1 : $page;
		$huoniaoTag->assign('atpage', $page);
		$huoniaoTag->assign('state', $state);

	//站内消息详细信息
	}elseif($action == "message_detail"){

		$userLogin->checkUserIsLogin();
		$userid = $userLogin->getMemberID();

		$id = (int)$id;
		if(empty($id)){
			header('location:http://'.$cfg_basehost.'/404.html');
			die;
		}

		$sql = $dsql->SetQuery("SELECT log.`state`, l.`title`, l.`body`, l.`urlParam`, l.`date` FROM `#@__member_letter_log` log LEFT JOIN `#@__member_letter` l ON l.`id` = log.`lid` WHERE l.`type` = 0 AND log.`id` = $id AND log.`uid` = $userid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$data = $ret[0];

			//更新状态
			if($data['state'] == 0){
				$sql = $dsql->SetQuery("UPDATE `#@__member_letter_log` SET `state` = 1 WHERE `id` = $id");
				$dsql->dsqlOper($sql, "update");
			}

			//跳转
			if(!empty($data['urlParam'])){
				$param = unserialize($data['urlParam']);
				header("location:".getUrlPath($param));
			}

			$huoniaoTag->assign('title', $data['title']);
			$huoniaoTag->assign('body', $data['body']);
			$huoniaoTag->assign('date', date("Y-m-d H:i:s", $data['date']));

		}else{
			header('location:http://'.$cfg_basehost.'/404.html');
			die;
		}
		return;


	//房产经纪人
	}elseif($action == "config-house"){

		$userLogin->checkUserIsLogin();
		$userid = $userLogin->getMemberID();
		$jjr = 0;

		$sql = $dsql->SetQuery("SELECT * FROM `#@__house_zjuser` WHERE `userid` = $userid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$jjr = 1;

			$contorllerFile = dirname(__FILE__).'/house.controller.php';
			if(file_exists($contorllerFile)){
				//声明以下均为接口类
				$handler = true;
				require_once($contorllerFile);

				$param = array(
					"action" => "broker-detail",
					"id"     => $ret[0]['id'],
					"u"      => 1
				);
				house($param);
			}
		}
		$huoniaoTag->assign("jjr", $jjr);


	//管理发布的信息
	}elseif($action == "manage" || $action == "fabu"|| $action == "order" || $action == "team" || $action == "teamAdd" || $action == "albums" || $action == "albumsAdd" || $action == "case" || $action == "caseAdd" || $action == "booking" || $action == "post" || $action == "collections" || $action == "invitation" || $action == "resume" || $action == "house-broker"){

		$userLogin->checkUserIsLogin();
		$userid = $userLogin->getMemberID();

		$huoniaoTag->assign('module', $module);

		$page = empty($page) ? 1 : $page;
		$huoniaoTag->assign('atpage', $page);
		$huoniaoTag->assign('state', $state);
		$huoniaoTag->assign('type', $type);
		$huoniaoTag->assign('do', $do);
		$huoniaoTag->assign('id', (int)$id);
		$huoniaoTag->assign('typeid', (int)$typeid);
		$huoniaoTag->assign('userid', (int)$userid);

		if($action == "fabu"){
			//获取图片配置参数
			require(HUONIAOINC."/config/".$module.".inc.php");

			if($customUpload == 1){
				$huoniaoTag->assign('thumbSize', $custom_thumbSize);
				$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
				$huoniaoTag->assign('atlasSize', $custom_atlasSize);
				$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
			}

			//房产单独配置
			if($module == "house"){
				if($type == "sale"){
					$customAtlasMax = $custom_houseSale_atlasMax;
				}elseif($type == "zu"){
					$customAtlasMax = $custom_houseZu_atlasMax;
				}elseif($type == "xzl"){
					$customAtlasMax = $custom_houseXzl_atlasMax;
				}elseif($type == "sp"){
					$customAtlasMax = $custom_houseSp_atlasMax;
				}elseif($type == "cf"){
					$customAtlasMax = $custom_houseCf_atlasMax;
				}
			}

			$huoniaoTag->assign('atlasMax', (int)$customAtlasMax);

			$contorllerFile = dirname(__FILE__).'/'.$module.'.controller.php';
			if(file_exists($contorllerFile)){

				//声明以下均为接口类
				$handler = true;
				require_once($contorllerFile);

				if($do == "edit"){
					global $do;
					global $oper;
					$do = "edit";
					$oper = "user";
					$param = array(
						"action" => "detail",
						"type"   => $type,
						"id"     => $id
					);
					$module($param);
				}

				if($module == "info"){
					$param = array(
						"action" => "fabu",
						"typeid" => $typeid
					);
					$module($param);
				}

				if($module == "tuan"){
					$param = array(
						"action" => "fabu",
						"id"     => $id
					);
					$module($param);
				}

				if($module == "shop"){
					$param = array(
						"action" => "fabu",
						"typeid" => $typeid
					);
					$module($param);
				}

				if($module == "build"){
					$param = array(
						"action" => "fabu"
					);
					$module($param);
				}

				if($module == "furniture"){
					$param = array(
						"action" => "fabu"
					);
					$module($param);
				}

				if($module == "home"){
					$param = array(
						"action" => "fabu"
					);
					$module($param);
				}

				if($module == "waimai"){
					$param = array(
						"action" => "fabu",
						"id" => $id
					);
					$module($param);
				}

				if($module == "website"){
					$param = array(
						"action" => "fabu",
						"act" => $type,
						"id" => $id
					);
					$module($param);
				}

				if($module == "business"){
					$param = array(
						"action" => "fabu",
						"act" => $type,
						"id" => $id
					);
					$module($param);
				}

			}

		//团队
		}elseif($action == "teamAdd"){

			if(!empty($id)){
				$param = array(
					"id"     => $id,
					"action" => "designer-detail"
				);
				$module($param);
			}

		//效果图
		}elseif($action == "albumsAdd"){

			if(!empty($id)){
				$param = array(
					"id"     => $id,
					"action" => "albums-detail"
				);
				$module($param);
			}

			require(HUONIAOINC."/config/renovation.inc.php");

			if($customUpload == 1){
				$huoniaoTag->assign('thumbSize', $custom_thumbSize);
				$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
				$huoniaoTag->assign('atlasSize', $custom_atlasSize);
				$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
			}

			$huoniaoTag->assign('atlasMax', (int)$custom_case_atlasMax);

			$param = array("action" => "getDesignerByEnter");
			$module($param);

		//案例
		}elseif($action == "caseAdd"){

			if(!empty($id)){
				$param = array(
					"id"     => $id,
					"action" => "case-detail"
				);
				$module($param);
			}

			require(HUONIAOINC."/config/renovation.inc.php");

			if($customUpload == 1){
				$huoniaoTag->assign('thumbSize', $custom_thumbSize);
				$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
				$huoniaoTag->assign('atlasSize', $custom_atlasSize);
				$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
			}

			$huoniaoTag->assign('atlasMax', (int)$custom_diary_atlasMax);

			$param = array("action" => "getDesignerByEnter");
			$module($param);

		//职位
		}elseif($action == "post" && ($do == "add" || $do == "edit")){

			$module = "job";

			if(!empty($id)){

				global $oper;
				$oper = "user";

				$param = array(
					"id"     => $id,
					"action" => "job"
				);
				$module($param);
			}else{
				$userLogin->checkUserIsLogin();
				$userid = $userLogin->getMemberID();
				$sql = $dsql->SetQuery("SELECT `contact`, `email` FROM `#@__job_company` WHERE `userid` = $userid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$huoniaoTag->assign('job_tel', $ret[0]['contact']);
					$huoniaoTag->assign('job_email', $ret[0]['email']);
				}
			}

		//房产经纪人
		}elseif($action == "house-broker"){

			$comid = 0;
			$userid = $userLogin->getMemberID();
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `userid` = $userid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$comid = $ret[0]['id'];
			}
			$huoniaoTag->assign('comid', $comid);

		}

		return;

	//商铺配置
	}elseif($action == "config"){

		$userLogin->checkUserIsLogin();
		$huoniaoTag->assign('module', $module);

		$contorllerFile = dirname(__FILE__).'/'.$module.'.controller.php';
		if(file_exists($contorllerFile)){
			//声明以下均为接口类
			$handler = true;
			require_once($contorllerFile);

			$param = array(
				"action" => "storeDetail"
			);
			$module($param);
		}

	//店铺商品分类
	}elseif($action == "category"){

		$userLogin->checkUserIsLogin();
		$huoniaoTag->assign('module', $module);

		global $userLogin;
		$userid = $userLogin->getMemberID();
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__shop_store` WHERE `userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$huoniaoTag->assign('storeid', $ret[0]['id']);
		}

		$detailHandels = new handlers($module, "category");
		$detailConfig  = $detailHandels->getHandle(array("son" => 1));

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				$huoniaoTag->assign('typeList', $detailConfig);

			}
		}
		return;

	//运费模板
	}elseif($action == "logistic"){

		$userLogin->checkUserIsLogin();
		$huoniaoTag->assign('module', $module);
		$huoniaoTag->assign('do', $do);
		$huoniaoTag->assign('id', (int)$id);

		$contorllerFile = dirname(__FILE__).'/'.$module.'.controller.php';
		if(file_exists($contorllerFile)){
			//声明以下均为接口类
			$handler = true;
			require_once($contorllerFile);

			if($id != 0){
				$param = array(
					"action" => "logisticDetail",
					"id"     => $id
				);
				$module($param);
			}else{
				$param = array(
					"action" => "logistic"
				);
				$module($param);
			}
		}

	//首页
	}elseif($template == "index"){

		//手机版首页不需要验证是否登录 by:20161231 guozi
		if(!isMobile()){
			$userLogin->checkUserIsLogin();
		}

		//获取自定义封面背景图片
		$userinfo = $userLogin->getMemberInfo();
		$tempbg = $userinfo['tempbg'];
		if(!empty($tempbg)){
			$archives = $dsql->SetQuery("SELECT `big` FROM `#@__member_coverbg` WHERE `id` = ".$tempbg);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$huoniaoTag->assign('bannerUrl', getFilePath($results[0]['big']));
			}
		}
		return;

	//其它需要验证登录的页面
	}elseif($template == "order"          		//管理订单
			 || $template == "withdraw"		//提现
			 || $template == "record"		//交易记录
			 || $template == "collect" 		//我的收藏
			 || $template == "message" 		//系统消息
			 || $template == "profile" 		//基本资料
			 || $template == "portrait"		//修改头像
			 || $template == "connect"		//社交帐号绑定
			 || $template == "loginrecord"	//登录记录
			 || $template == "point"		//积分记录
			 || $template == "coupon"		//优惠券
			 || $template == "address"		//收货地址
			 || $template == "business-about"   //商家介绍
			 || $template == "business-news"    //商家动态
			 || $template == "business-albums"  //商家相册
			 || $template == "business-video"   //商家视频
			 || $template == "business-panor"   //商家全景
			 || $template == "business-comment" //商家点评
		 ){

		$userLogin->checkUserIsLogin();

		$huoniaoTag->assign('module', $module);

		if($template != "address") return;

	//帐户充值
	}elseif($template == "deposit" || $template == "convert"){

		$userLogin->checkUserIsLogin();

		$userinfo = $userLogin->getMemberInfo();
		$totalMoney = number_format($userinfo['money'], 2);
		$huoniaoTag->assign('totalMoney', $totalMoney);
		return;

	//安全中心
	}elseif($template == "security"){

		$userLogin->checkUserIsLogin();

		$huoniaoTag->assign('doget', $doget);

		//获取会员的安全保护问题
		$question1 = $question2 = "";
		$archives = $dsql->SetQuery("SELECT `question` FROM `#@__member_security` WHERE `uid` = '".$userLogin->getMemberID()."'");
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$question = explode("$$", $results[0]['question']);
			$question1 = $question[0];
			$question2 = $question[1];
		}
		$huoniaoTag->assign('question1', $question1);
		$huoniaoTag->assign('question2', $question2);

		return;

	//发布举报
	}elseif($action == "complain" && !empty($_POST)){

		$return = "";
		$desc = filterSensitiveWords(cn_substrR(addslashes($desc), 200));

		if(empty($type) || empty($vdimgck) || empty($module) || empty($dopost) || empty($aid)){
			$return = array("state" => 200, "info" => "必填项不能为空！");
		}

		if(empty($return)){
			if(strtolower($vdimgck) != $_SESSION['huoniao_vdimg_value']) $return = array("state" => 200, "info" => '验证码输入错误');
		}

		if(empty($return)){
			//获取用户ID
			$uid    = $userLogin->getMemberID();
			$ip     = GetIP();
			$ipAddr = getIpAddr($ip);

			if($uid == -1){
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_complain` WHERE `module` = '$module' AND `action` = '$dopost' AND `aid` = '$aid' AND `ip` = '$ip'");
				$count = $dsql->dsqlOper($archives, "totalCount");
			}else{
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_complain` WHERE `module` = '$module' AND `action` = '$dopost' AND `aid` = '$aid' AND `userid` = '$uid'");
				$count = $dsql->dsqlOper($archives, "totalCount");
			}
			if($count == 0){
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_complain` (`module`, `action`, `aid`, `type`, `desc`, `userid`, `ip`, `ipaddr`, `pubdate`, `state`) VALUES ('$module', '$dopost', '$aid', '$type', '$desc', '$uid', '$ip', '$ipAddr', ".GetMkTime(time()).", 0)");
				$dsql->dsqlOper($archives, "update");

				$return = array("state" => 100, "info" => "举报成功！");
			}else{
				$return = array("state" => 101, "info" => "您已经举报过此条信息，无需再次提交！");
			}
		}

		if($callback){
			echo $callback."(".json_encode($return).")";
		}else{
			echo json_encode($return);
		}
		die;

	//邮箱绑定返回页面
	}elseif($template == "bindemail"){

		$userLogin->checkUserIsLogin();

		$state = 0;
		if(empty($data)){
			$content = "绑定失败，请检查链接地址是否完整！";
		}else{

			//数据解密
			$mid = $userLogin->getMemberID();
			$RenrenCrypt = new RenrenCrypt();
			$data = $RenrenCrypt->php_decrypt(base64_decode($data));
			$arr = explode("$$", $data);
			$uid  = $arr[0];
			$ip   = $arr[1];
			$time = $arr[2];

			$param = array(
				"service"  => "member",
				"type"     => "user",
				"template" => "security",
				"doget"    => "chemail"
			);
			$bindUrl = getUrlPath($param);

			if(!is_numeric($uid) || !is_numeric($time)){
				$content = "绑定失败，链接地址失效，请回到【<a href='".$bindUrl."'>绑定页面</a>】重新操作！";
			}else{

				//判断是否同一帐号
				if($mid != $uid){
					$content = "绑定失败，请确认 <u>当前登录用户</u> 与 <u>邮箱链接中的用户</u> 是否一致！";
				}else{

					//验证是否过期
					$now = GetMkTime(time());
					if($now - $time > 24 * 3600){
						$content = "绑定失败，邮件链接已超过24小时的有效时间，请【<a href='".$bindUrl."'>重新绑定</a>】！";
					}else{

						//验证会员
						$archives = $dsql->SetQuery("SELECT `id`, `emailCheck` FROM `#@__member` WHERE `id` = '$uid'");
						$user = $dsql->dsqlOper($archives, "results");
						if(!$user){
							$content = "绑定失败，会员不存在或已经删除，请确认后重试！";
						}else{

							$state = 1;
							if($user[0]['emailCheck'] == 1){
								$content = "您已经成功绑定，无须再次提交！";
							}else{

								//验证通过删除发送的验证码
								$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'email' AND `lei` = 'bind' AND `by` = '$uid'");
								$dsql->dsqlOper($archives, "update");

								//更新用户状态
								$archives = $dsql->SetQuery("UPDATE `#@__member` SET `emailCheck` = 1 WHERE `id` = '$uid'");
								$dsql->dsqlOper($archives, "update");

								$content = "恭喜您，绑定成功！";
							}

						}

					}
				}

			}

		}

		$huoniaoTag->assign('state', $state);
		$huoniaoTag->assign('content', $content);
		return;


	//重置密码
	}elseif($template == "resetpwd"){

		if(empty($data)){
			$huoniaoTag->assign("empty", "yes");
			return;
		}

		//验证安全链接
		$RenrenCrypt = new RenrenCrypt();
		$dataCode = $RenrenCrypt->php_decrypt(base64_decode($data));

		$dataArr = explode("$$", $dataCode);
		if(count($dataArr) != 4){
			$huoniaoTag->assign("empty", "yes");
			return;
		}

		if($dataArr[0] == 1){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `email` = '".$dataArr[1]."'");
		}elseif($dataArr[0] == 2){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `phone` = '".$dataArr[1]."'");
		}
		$results  = $dsql->dsqlOper($archives, "totalCount");
		if($results == 0){
			$huoniaoTag->assign("empty", "yes");
			return;
		}

		$now = GetMkTime(time());
		if($now - $dataArr[3] > 24 * 3600){
			$huoniaoTag->assign("empty", "yes");
			return;
		}

		$huoniaoTag->assign("data", $data);


	//提现详细信息
	}elseif($template == "withdraw_log_detail"){

		$userLogin->checkUserIsLogin();
		$userid = $userLogin->getMemberID();

		if(empty($id)){
			header('location:http://'.$cfg_basehost.'/404.html');
			die;
		}

		$sql = $dsql->SetQuery("SELECT * FROM `#@__member_withdraw` WHERE `id` = $id AND `uid` = $userid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$results = $ret[0];
			$huoniaoTag->assign('bank', $results['bank']);
			if($results['bank'] == "alipay"){
				$huoniaoTag->assign('cardnum', $results['cardnum']);
			}else{
				$cardnum = str_split($results['cardnum'], 4);
				$huoniaoTag->assign('cardnum', join(" ", $cardnum));
			}
			$huoniaoTag->assign('cardname', $results['cardname']);
			$huoniaoTag->assign('amount', $results['amount']);
			$huoniaoTag->assign('tdate', date("Y-m-d H:i:s", $results['tdate']));
			$huoniaoTag->assign('state', $results['state']);
			$huoniaoTag->assign('note', $results['note']);
			$huoniaoTag->assign('rdate', date("Y-m-d H:i:s", $results['rdate']));

		}else{
			header('location:http://'.$cfg_basehost.'/404.html');
			die;
		}
		return;


	//订单详情页面
	}elseif($action == "orderdetail"){

		global $userLogin;
		global $cfg_thumbType;
		global $cfg_atlasType;
		$userid = $userLogin->getMemberID();

		if($userid == -1){
			$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			header("location:http://".$cfg_basehost."/login.html?furl=".$furl);
		}else{
			$huoniaoTag->assign('module', $module);

			$detailHandels = new handlers($module, "orderDetail");
			$detailConfig  = $detailHandels->getHandle($id);

			if(is_array($detailConfig) && $detailConfig['state'] == 100){
				$detailConfig  = $detailConfig['info'];
				if(is_array($detailConfig)){

					foreach ($detailConfig as $key => $value) {
						$huoniaoTag->assign('detail_'.$key, $value);
					}


					//已完成订单输出上传配置参数
					// if($key == "orderstate" && $value == 3){
						//获取图片配置参数
						require(HUONIAOINC."/config/".$module.".inc.php");

						if($customUpload == 1){
							$huoniaoTag->assign('thumbSize', $custom_thumbSize);
							$huoniaoTag->assign('thumbType', str_replace("|", ",", $custom_thumbType));
							$huoniaoTag->assign('atlasSize', $custom_atlasSize);
							$huoniaoTag->assign('atlasType', str_replace("|", ",", $custom_atlasType));
						}else{
							$huoniaoTag->assign('thumbType', str_replace("|", ",", $cfg_thumbType));
							$huoniaoTag->assign('atlasType', str_replace("|", ",", $cfg_atlasType));
						}
						$huoniaoTag->assign('atlasMax', (int)$customAtlasMax);
					// }

				}


				$huoniaoTag->assign('rates', (int)$rates);
				$huoniaoTag->assign('id', (int)$id);


			}else{
				header("location:http://".$cfg_basehost."/404.html");
			}
		}
		return;

	//评价
	}elseif($action == "write-comment"){

		global $userLogin;
		global $cfg_thumbType;
		global $cfg_atlasType;
		$userid = $userLogin->getMemberID();

		if($userid == -1){
			$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			header("location:http://".$cfg_basehost."/login.html?furl=".$furl);
		}else{
			$huoniaoTag->assign('module', $module);
			$huoniaoTag->assign('id', (int)$id);

			//获取图片配置参数
			require(HUONIAOINC."/config/".$module.".inc.php");

			if($customUpload == 1){
				$huoniaoTag->assign('thumbSize', $custom_thumbSize);
				$huoniaoTag->assign('thumbType', str_replace("|", ",", $custom_thumbType));
				$huoniaoTag->assign('atlasSize', $custom_atlasSize);
				$huoniaoTag->assign('atlasType', str_replace("|", ",", $custom_atlasType));
			}else{
				$huoniaoTag->assign('thumbType', str_replace("|", ",", $cfg_thumbType));
				$huoniaoTag->assign('atlasType', str_replace("|", ",", $cfg_atlasType));
			}


			$detailHandels = new handlers($module, "orderDetail");
			$detailConfig  = $detailHandels->getHandle($id);


			if(is_array($detailConfig) && $detailConfig['state'] == 100){
				$detailConfig  = $detailConfig['info'];
				if(is_array($detailConfig)){

					// 区分外卖
					if($module == 'waimai'){

						// 修改评论使用
						$sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_common` WHERE `oid` = $id AND `uid` = $userid");
						$ret = $dsql->dsqlOper($sql, 'results');
						$common = array();
						if($ret){
							$pics = $ret[0]['pics'];
							if($pics != "") $ret[0]['pics'] = explode(",", $pics);
							$common = $ret[0];
						}else{
							$common = array("id" => "", "isanony" => 0, "star" => 0, "starps" => 0, "content" => "", "contentps" => "", "litpic" => "");
						}
						$huoniaoTag->assign('common', $common);

					}else{

						if($detailConfig['orderstate'] == 3){

							$huoniaoTag->assign('product', $detailConfig['product']);

						}else{

							$param = array(
								"service"  => "member",
								"type"     => "user",
								"template" => "orderdetail",
								"module"   => $module,
								"id"       => $id
							);

							header("location:".getUrlPath($param));
						}

					}

				}
			}else{
				header("location:http://".$cfg_basehost."/404.html");
			}


		}
		return;

	//招聘求职
	}elseif($action == "job"){

		$userLogin->checkUserIsLogin();
		$huoniaoTag->assign('module', $module);

		//简历
		if($module == "resume"){
			global $cfg_photoSize;
			global $cfg_photoType;
			$huoniaoTag->assign('photoSize', $cfg_photoSize);
			$huoniaoTag->assign('photoType', str_replace("|", ",", $cfg_photoType));

			$detailHandels = new handlers($action, "resumeDetail");
			$detailConfig  = $detailHandels->getHandle();

			if(is_array($detailConfig) && $detailConfig['state'] == 100){
				$detailConfig  = $detailConfig['info'];
				if(is_array($detailConfig)){

					foreach ($detailConfig as $key => $value) {
						$huoniaoTag->assign('detail_'.$key, $value);
					}
				}
			}

		}

	//交友资料
	}elseif($action == "dating-profile"){

		$userLogin->checkUserIsLogin();
		$uid = $userLogin->getMemberID();

		//获取交友会员ID
		$mid = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__dating_member` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$mid = $ret[0]['id'];
		}

		require(HUONIAOINC."/config/dating.inc.php");
		$huoniaoTag->assign('tagsLength', (int)$tagsLength);
		$huoniaoTag->assign('mid', $mid);

		$detailHandels = new handlers("dating", "memberInfo");
		$detailConfig  = $detailHandels->getHandle($mid);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}
			}
		}

	//交友私信
	}elseif($action == "dating-review"){
		$userLogin->checkUserIsLogin();

	//交友私信详细
	}elseif($action == "dating-review-detail"){

		$userLogin->checkUserIsLogin();
		$uid = $userLogin->getMemberID();
		$minfo = $userLogin->getMemberInfo();

		//获取交友会员ID
		$mid = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__dating_member` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$mid = $ret[0]['id'];
		}

		//登录会员信息
		$param = array(
			"service"  => "dating",
			"template" => "u",
			"id"       => $mid
		);
		$url = getUrlPath($param);
		$huoniaoTag->assign('id', $id);
		$huoniaoTag->assign('mid', $mid);
		$huoniaoTag->assign('minfo', json_encode(array(
			"nickname" => $minfo['nickname'],
			"photo"    => $minfo['photo'],
			"url"      => $url
		)));

		//更新私信状态
		$sql = $dsql->SetQuery("SELECT `to` FROM `#@__dating_review_list` WHERE `rid` = $id ORDER BY `id` DESC");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			if($ret[0]['to'] == $mid){
				$sql = $dsql->SetQuery("UPDATE `#@__dating_review_list` SET `isread` = 1 WHERE `rid` = $id");
				$dsql->dsqlOper($sql, "update");
			}
		}

		//对方信息
		$tid = 0;
		$tinfo = array(
			"nickname" => "",
			"photo"    => "",
			"url"      => ""
		);

		if(!empty($id)){
			$sql = $dsql->SetQuery("SELECT `ufrom`, `uto` FROM `#@__dating_review` WHERE `id` = $id AND (`ufrom` = $mid OR `uto` = $mid)");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$ufrom = $ret[0]['ufrom'];
				$uto   = $ret[0]['uto'];

				$tid = $ufrom == $mid ? $uto : $ufrom;

				//获取对方会员ID
				$sql = $dsql->SetQuery("SELECT `userid` FROM `#@__dating_member` WHERE `id` = $tid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$tinfo = $userLogin->getMemberInfo($ret[0]['userid']);
				}
			}
		}

		$huoniaoTag->assign('tid', $tid);
		$huoniaoTag->assign('tname', $tinfo['nickname']);
		$param = array(
			"service"  => "dating",
			"template" => "u",
			"id"       => $tid
		);
		$url = getUrlPath($param);
		$huoniaoTag->assign('tinfo', json_encode(array(
			"nickname" => $tinfo['nickname'],
			"photo"    => $tinfo['photo'],
			"url"      => $url
		)));

	//交友人气
	}elseif($action == "dating-visit" || $action == "dating-follow" || $action == "dating-meet"){
		$userLogin->checkUserIsLogin();
		if(empty($oper)){
			$oper = "visit";
		}
		if(empty($do)){
			$do = "in";
		}
		$huoniaoTag->assign("do", $do);
		$huoniaoTag->assign("oper", $oper);

	//交友相册
	}elseif($action == "dating-album-add"){
		//获取图片配置参数
		require(HUONIAOINC."/config/dating.inc.php");

		if($customUpload == 1){
			$huoniaoTag->assign('atlasSize', $custom_atlasSize);
			$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
		}
		$huoniaoTag->assign('atlasMax', (int)$customAtlasMax);

	//外卖菜单
	}elseif($action == "waimai-menus" || $action == "waimai-albums" || $action == "waimai-albums-add"){

		$userLogin->checkUserIsLogin();
		$huoniaoTag->assign('module', $module);

		global $userLogin;
		$userid = $userLogin->getMemberID();
		$storeid = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$storeid = $ret[0]['id'];
		}
		$huoniaoTag->assign('storeid', $storeid);
		return;

	//活动报名
	}elseif($action == "huodong-reg"){
		$userLogin->checkUserIsLogin();

		$id = (int)$id;
		$huoniaoTag->assign("id", $id);

	//自助建站设计
	}elseif($action == "dressup-website"){
		$userLogin->checkUserIsLogin();
		$userid = $userLogin->getMemberID();

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__website` WHERE `state` = 1 AND `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			$param = array(
				"service"  => "member",
				"template" => "config",
				"action"   => "website"
			);
			header('location:'.getUrlPath($param));
		}

		$site = $userResult[0]['id'];
		$huoniaoTag->assign('PROJECTID', $site);

	}


	global $template;
	if(empty($smarty)) return;

	if(!isset($return))
		$return = 'row'; //返回的变量数组名

	//注册一个block的索引，照顾smarty的版本
  if(method_exists($smarty, 'get_template_vars')){
      $_bindex = $smarty->get_template_vars('_bindex');
  }else{
      $_bindex = $smarty->getVariable('_bindex')->value;
  }

  if(!$_bindex){
      $_bindex = array();
  }

  if($return){
      if(!isset($_bindex[$return])){
          $_bindex[$return] = 1;
      }else{
          $_bindex[$return] ++;
      }
  }


  $smarty->assign('_bindex', $_bindex);

	//对象$smarty上注册一个数组以供block使用
	if(!isset($smarty->block_data)){
		$smarty->block_data = array();
	}

	//得一个本区块的专属数据存储空间
	$dataindex = md5(__FUNCTION__.md5(serialize($params)));
	$dataindex = substr($dataindex, 0, 16);

	//使用$smarty->block_data[$dataindex]来存储
	if(!$smarty->block_data[$dataindex]){
		//取得指定动作名
		$moduleHandels = new handlers($service, $action);
		$moduleReturn  = $moduleHandels->getHandle($params);
		if(!is_array($moduleReturn) || $moduleReturn['state'] != 100) return '';

		$moduleReturn  = $moduleReturn['info'];  //返回数据

		$pageInfo_ = $moduleReturn['pageInfo'];
		if($pageInfo_){

			//如果有分页数据则提取list键
			$moduleReturn  = $moduleReturn['list'];

			//把pageInfo定义为global变量
			global $pageInfo;
			$pageInfo = $pageInfo_;

			$smarty->assign("pageInfo", $pageInfo);
		}

		$smarty->block_data[$dataindex] = $moduleReturn;  //存储数据
	}

	//果没有数据，直接返回null,不必再执行了
	if(!$smarty->block_data[$dataindex]) {
		$repeat = false;
		return '';
	}

	if($action=="type"){
		//print_r($smarty->block_data[$dataindex]);die;
	}

	//一条数据出栈，并把它指派给$return，重复执行开关置位1
	if(list($key, $item) = each($smarty->block_data[$dataindex])){
		$smarty->assign($return, $item);
		$repeat = true;
	}

	//如果已经到达最后，重置数组指针，重复执行开关置位0
	if(!$item) {
		reset($smarty->block_data[$dataindex]);
		$repeat = false;
	}

	//打印内容
	print $content;
}
