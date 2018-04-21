<?php   if(!defined('HUONIAOINC')) exit('Request Error!');

/**
 *  检验用户是否有权使用某功能
 *  CheckPurview函数只是对他回值的一个处理过程
 *
 * @access    public
 * @param     string  $n  功能名称
 * @return    mix  如果具有则返回TRUE
 */
function testPurview($n){
	$rs = FALSE;
	global $userLogin;
		$purview = $userLogin->getPurview();
		if(preg_match('/founder/i', $purview)){
			return TRUE;
		}
		if($n == ''){
			return TRUE;
		}
		$ns = explode(',', $n);
		foreach($ns as $n){
			//只要找到一个匹配的权限，即可认为用户有权访问此页面
			if($n == ''){
				continue;
			}
			if(in_array($n, explode(',',$purview))){
				$rs = TRUE;
				break;
			}
		}
		return $rs;
}

/**
 *  对权限检测后返回操作对话框
 *
 * @access    public
 * @param     string  $n  功能名称
 * @return    string
 */
function checkPurview($n){
	if(!testPurview($n)){
		ShowMsg("对不起，您无权使用此功能！", 'javascript:;');
		exit();
	}
}

/**
 * 管理员登陆类
 *
 * @version        $Id: userlogin.class.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class userLogin extends db_connect{
	var $userName = '';
	var $userPwd = '';
	var $userID = '';
	var $userPurview = '';
	var $keepUserID = 'admin_auth';
	var $keepMemberID = 'login_user';
	var $keepUserPurview = 'keepuserpurview';

	private $_saltLength = 7;

	/**
	 * 保存或生成一个DB对象，设定盐的长度
	 *
	 * @param object $db 数据库对象
	 * @param int $saltLength 密码盐的长度
	 */
	function __construct($db = NULL, $saltLength = NULL){
		global $admin_path;

		parent::__construct($db);

		/*
		 * 若传入一个整数，则用它来设定saltLength的值
		 */
		if(is_int($saltLength)){
			$this->_saltLength = $saltLength;
		}

		if(isset($_SESSION[$this->keepUserID])){
			$this->userID = $_SESSION[$this->keepUserID];
		}

		if(isset($_SESSION[$this->keepUserPurview])){
			$this->userPurview = $_SESSION[$this->keepUserPurview];
		}
	}

	function userLogin(){
		$this->__construct();
	}

	/**
	 *  检验用户是否正确
	 *
	 * @access    public
	 * @param     string    $username  用户名
	 * @param     string    $userpwd  密码
	 * @return    string
	 */
	function checkUser($username, $userpwd, $admin = false){
		//只允许用户名和密码用0-9,a-z,A-Z,'@','_','.','-'这些字符
		// $this->userName = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $username);
		// $this->userPwd = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $userpwd);
		$this->userName = $username;
		$this->userPwd = $userpwd;

		$ip = GetIP();
		$archives = $this->SetQuery("SELECT * FROM `#@__failedlogin` WHERE `ip` = '$ip'");
		$results = $this->db->prepare($archives);
		$results->execute();
		$results = $results->fetchAll(PDO::FETCH_ASSOC);
		if($results){
			//验证错误次数，并且上次登录错误是在15分钟之内
			if($results[0]['count'] >= 5){
				$timedifference = GetMkTime(time()) - $results[0]['date'];
				if($timedifference/60 < 15){
					return -1;
				}
			}
		}

		$where = " AND member.`mtype` != 0";
		if($admin) $where = " AND member.`mtype` = 0";

		$sql = $this->SetQuery("SELECT member.*,admin.purviews FROM `#@__member` member LEFT JOIN `#@__admingroup` admin ON admin.id = member.mgroupid WHERE member.username = '".$this->userName."' AND member.mgroupid != ''".$where." LIMIT 1");

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$param = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$user = array_shift($param);
			$stmt->closeCursor();
		}catch(Exception $e){
			die($e->getMessage());
		}
		//根据用户输入的密码生成散列后的密码
		$hash = $this->_getSaltedHash($this->userPwd, $user['password']);

		//若用户名在数据库中不存在则返回出错信息
		if(!isset($user)){
			return -1;
		}

		if($user['state'] == 1){
			return -3;
		}

		//检查散列后的密码是否与数据库中保存的密码一致
		if($user['password'] == $hash){
			$this->userID = $user['id'];
			$this->userPurview = $user['purviews'];
			$this->keepUser();
			return 1;
		}

		//如果密码不正确返回出错信息
		else{
			return -2;
		}
	}

	/**
	 * 验证用户是否存在
	 * @param  int  $udi  用户ID
	 * @return  boolean
	 *
	 */
	function checkUserNull($uid){
		if($uid){
			if(!is_numeric($uid)){
				$RenrenCrypt = new RenrenCrypt();
				$uid = $RenrenCrypt->php_decrypt(base64_decode($uid));
			}
			$sql = $this->SetQuery("SELECT `id` FROM `#@__member` WHERE (`state` = 1 OR `mtype` = 0) AND `id` = ".$uid);
			$res = $this->db->prepare($sql);
			$res->execute();
			$res = $res->fetchAll(PDO::FETCH_ASSOC);
			if($res[0]){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	/**
	 *  检验用户是否正确
	 *
	 * @access    public
	 * @param     string    $username  用户名
	 * @param     string    $userpwd  密码
	 * @return    string
	 */
	function memberLogin($username, $userpwd){
		$this->userName = $username;
		$this->userPwd = $userpwd;

		$ip = GetIP();
		$archives = $this->SetQuery("SELECT * FROM `#@__failedlogin` WHERE `ip` = '$ip'");
		$results = $this->db->prepare($archives);
		$results->execute();
		$results = $results->fetchAll(PDO::FETCH_ASSOC);
		if($results){
			//验证错误次数，并且上次登录错误是在15分钟之内
			if($results[0]['count'] >= 5){
				$timedifference = GetMkTime(time()) - $results[0]['date'];
				if($timedifference/60 < 15){
					return -1;
				}
			}
		}

		$sql = $this->SetQuery("SELECT * FROM `#@__member` WHERE (`username` = '".$this->userName."' OR `email` = '".$this->userName."' OR `phone` = '".$this->userName."') AND `mtype` != 0 LIMIT 1");

		try{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$param = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$user = array_shift($param);
			$stmt->closeCursor();
		}catch(Exception $e){
			die($e->getMessage());
		}
		//根据用户输入的密码生成散列后的密码
		$hash = $this->_getSaltedHash($this->userPwd, $user['password']);

		//若用户名在数据库中不存在则返回出错信息
		if(!isset($user)){
			return -1;
		}

		//会员状态
		if($user['state'] != 1){
			return -1;
		}

		$data = $user;
		$data['uPwd'] = $this->userPwd;

		//验证论坛是否可以登录
		global $cfg_bbsState;
		global $cfg_bbsType;
		$bbsID = $this->bbsSync($data, "login");
		if($cfg_bbsState == 1 && $cfg_bbsType != ""){
			if($bbsID > 0){
				//如果验证通过，则返回成功
				$this->keepUserID = $this->keepMemberID;
				$this->userID = $user['id'];
				$this->keepUser();

				//登录成功，重置登录失败次数
				$ip = GetIP();
				$archives = $this->SetQuery("UPDATE `#@__failedlogin` SET `count` = 0 WHERE `ip` = '$ip'");
				$results = $this->db->prepare($archives);
				$results->execute();

				//如果是通过论坛验证的，则更新主站密码
				$npass = $this->_getSaltedHash($this->userPwd);
				$archives = $this->SetQuery("UPDATE `#@__member` SET `password` = '$npass' WHERE `id` = ".$user['id']);
				$results = $this->db->prepare($archives);
				$results->execute();

				//论坛同步操作
				$this->bbsSync($data, "synlogin");
				return 1;

			}else{

				//如果论坛用户不存在或已删除，再与主站数据进行匹配
				if($user['password'] == $hash){
					$this->keepUserID = $this->keepMemberID;
					$this->userID = $user['id'];
					$this->keepUser();

					//登录成功，重置登录失败次数
					$ip = GetIP();
					$archives = $this->SetQuery("UPDATE `#@__failedlogin` SET `count` = 0 WHERE `ip` = '$ip'");
					$results = $this->db->prepare($archives);
					$results->execute();

					//更新论坛密码
					$update['username'] = $user['username'];
					$update['newpw'] = $this->userPwd;
					$this->bbsSync($update, "edit");

					//论坛同步操作
					$this->bbsSync($data, "synlogin");

					return 1;

				//如果密码不正确返回出错信息
				}else{
					return -2;
				}
			}

		//验证本站数据
		}else{

			//检查散列后的密码是否与数据库中保存的密码一致
			if($user['password'] == $hash){
				$this->keepUserID = $this->keepMemberID;
				$this->userID = $user['id'];
				$this->keepUser();

				//登录成功，重置登录失败次数
				$ip = GetIP();
				$archives = $this->SetQuery("UPDATE `#@__failedlogin` SET `count` = 0 WHERE `ip` = '$ip'");
				$results = $this->db->prepare($archives);
				$results->execute();

				//更新论坛密码
				$update['username'] = $user['username'];
				$update['newpw'] = $this->userPwd;
				$this->bbsSync($update, "edit");

				//论坛同步操作
				$this->bbsSync($data, "synlogin");

				return 1;

			//如果密码不正确返回出错信息
			}else{
				return -2;
			}

		}

	}


	/**
	 * 获取登录用户信息
	 * @return array
	 */
	function getMemberInfo($uid = ''){
		$mid = empty($uid) ? $this->getMemberID() : $uid;
		$memberInfo = array();

		if($mid > -1){
			$handlers = true;
			$handels = new handlers("member", "detail");
			$memberInfo = $handels->getHandle(array("id" => $mid));
			$memberInfo = $memberInfo["info"];
		}
		return $memberInfo;
	}


	/**
	 * 整合第三方登录
	 * @param    string    $code      类型
	 * @param    string    $key       唯一值
	 * @param    string    $nickname  昵称
	 * @param    string    $photo     头像
	 * @return   array
	 */
	function loginConnect($params){

		extract($params);
		global $cfg_basehost;
		$cfg_basehost = "http://".$cfg_basehost;
		$loginRedirect = $_SESSION['loginRedirect'];
		$loginRedirect = $loginRedirect ? $loginRedirect : $cfg_basehost;

		$uid = $this->getMemberID();
		//判断是否为已经登录的用户，如果是则绑定此社交账号
		if($uid > -1){

			$archives = $this->SetQuery("SELECT `id`, `username` FROM `#@__member` WHERE `id` = '$uid'");
			$results = $this->db->prepare($archives);
			$results->execute();
			$results = $results->fetchAll(PDO::FETCH_ASSOC);

			if(!$results){
				if(!$noRedir){
					die('要绑定社交账号的用户不存在！');
				}
			}else{

				$username = $results[0]['username'];

				//如果是扫码登录
				if($state){

					$this->keepUserID = $this->keepMemberID;
					$this->userID = $uid;
					$this->keepUser();

					$archives_ = $this->SetQuery("UPDATE `#@__site_wxlogin` SET `uid` = '$uid' WHERE `state` = '$state'");
					$results_ = $this->db->prepare($archives_);
					$results_->execute();

					//论坛同步
					global $cfg_bbsState;
					global $cfg_bbsType;
					if($cfg_bbsState == 1 && $cfg_bbsType != ""){
						$data['username'] = $username;
						$data['uPwd']     = md5(uniqid(rand(), TRUE));
						$this->bbsSync($data, "synlogin");
					}
					die('<meta charset="UTF-8"><script type="text/javascript">window.close();top.location="'.$loginRedirect.'";</script>');


				}else{
					$archives = $this->SetQuery("SELECT `id` FROM `#@__member` WHERE `".$code."_conn` = '$key'");
					$results = $this->db->prepare($archives);
					$results->execute();
					$results = $results->fetchAll(PDO::FETCH_ASSOC);
					if($results){
						if(!$noRedir){
							die('您的帐号已经绑定其他用户！');
						}
					}else{
						$archives = $this->SetQuery("UPDATE `#@__member` SET `".$code."_conn` = '$key' WHERE `id` = '$uid'");
						$results = $this->db->prepare($archives);
						$results->execute();
						if(!$noRedir){
							die('<meta charset="UTF-8"><script type="text/javascript">window.close();top.location="'.$loginRedirect.'";</script>');
							// echo '<script type="text/javascript">setTimeout(function(){window.close();}, 500);</script>绑定成功！';
						}
					}
				}
			}

			return;
		}

		if(!$noRedir){
			if(empty($key)) die('<meta charset="UTF-8"><script type="text/javascript">setTimeout(function(){window.close();top.location="'.$loginRedirect.'";}, 5000);</script>登录失败1！');
		}


		//生成用户名【昵称+随机】
		$chcode = strtolower(create_check_code(8));
		$username = $chcode."@".(strlen($code) > 6 ? substr($code, 0, 5) : $code);
		$nickname = $nickname ? $nickname : $chcode;
		$password = substr($key, 0, 20);

		$ip   = GetIP();
		$ipaddr = getIpAddr($ip);
		$time = GetMkTime(time());

		//验证用户是否已存在
		$archives = $this->SetQuery("SELECT `id`, `username` FROM `#@__member` WHERE `".$code."_conn` = '$key'");
		$results = $this->db->prepare($archives);
		$results->execute();
		$results = $results->fetchAll(PDO::FETCH_ASSOC);

		//如果已经存在，则自动登录
		if($results){
			$userid = $results[0]['id'];
			$this->keepUserID = $this->keepMemberID;
			$this->userID = $userid;
			$this->keepUser();

			//如果是微信扫码登录，需要更新临时登录日志
			if($state){
				$archives_ = $this->SetQuery("UPDATE `#@__site_wxlogin` SET `uid` = '$userid' WHERE `state` = '$state'");
				$results_ = $this->db->prepare($archives_);
				$results_->execute();
			}


			$username = $results[0]['username'];

			//登录成功，重置登录失败次数
			$archives = $this->SetQuery("UPDATE `#@__failedlogin` SET `count` = 0 WHERE `ip` = '$ip'");
			$results = $this->db->prepare($archives);
			$results->execute();

			$archives = $this->SetQuery("UPDATE `#@__member` SET `logincount` = `logincount` + 1, `lastlogintime` = '$time', `lastloginip` = '$ip', `lastloginipaddr` = '$ipaddr', `online` = '$time' WHERE `id` = ".$userid);
			$results = $this->db->prepare($archives);
			$results->execute();

			//保存到主表
			$archives = $this->SetQuery("INSERT INTO `#@__member_login` (`userid`, `logintime`, `loginip`, `ipaddr`) VALUES ('$userid', '$time', '$ip', '$ipaddr')");
			$results = $this->db->prepare($archives);
			$results->execute();

			//论坛同步
			global $cfg_bbsState;
			global $cfg_bbsType;
			if($cfg_bbsState == 1 && $cfg_bbsType != ""){
				$data['username'] = $username;
				$data['uPwd']     = $password;
				$this->bbsSync($data, "synlogin");
			}

			if(!$noRedir || $state){
				if($notclose){
					die('<meta charset="UTF-8"><script type="text/javascript">top.location="'.$loginRedirect.'";</script>');
				}else{
					die('<meta charset="UTF-8"><script type="text/javascript">window.close();top.location="'.$loginRedirect.'";</script>');
				}
			}
			// echo '<script type="text/javascript">setTimeout(function(){window.close();}, 500);</script>授权成功！';

		//如果不存在则新建用户
		}else{

			$pwd = $this->_getSaltedHash($password);
			$sex = $gender == "男" ? 1 : 0;

			//头像
			if(!empty($photo)){

				require_once(HUONIAOINC."/config/siteConfig.inc.php");

				global $cfg_attachment;
				global $cfg_uploadDir;
				global $cfg_photoSize;
				global $cfg_atlasType;
				global $editor_uploadDir;
				global $cfg_ftpType;
				global $editor_ftpType;
				global $cfg_ftpState;
				global $editor_ftpState;
				global $cfg_ftpDir;
				global $editor_ftpDir;

				global $cfg_photoSmallWidth;
				global $cfg_photoSmallHeight;
				global $cfg_photoMiddleWidth;
				global $cfg_photoMiddleHeight;
				global $cfg_photoLargeWidth;
				global $cfg_photoLargeHeight;
				global $cfg_photoCutType;
				global $cfg_photoCutPostion;
				global $cfg_quality;

				$editor_uploadDir = $cfg_uploadDir;
				$editor_ftpType = $cfg_ftpType;
				$editor_ftpState = $cfg_ftpState;
				$editor_ftpDir = $cfg_ftpDir;

				/* 上传配置 */
				$config = array(
				    "savePath" => ($noRedir ? "../" : "")."..".$cfg_uploadDir."/siteConfig/photo/large/".date( "Y" )."/".date( "m" )."/".date( "d" )."/",
				    "maxSize" => $cfg_photoSize,
				    "allowFiles" => explode("|", $cfg_atlasType)
				);

				$photoList = array();
				array_push($photoList, $photo);

				$pic = "";
				$photoArr = getRemoteImage($photoList, $config, "siteConfig", ($noRedir ? "../" : "")."..", true);
				if($photoArr){
					$photoArr = json_decode($photoArr, true);
					if(is_array($photoArr) && $photoArr['state'] == "SUCCESS"){
						$pic = $photoArr['list'][0]['fid'];
					}
				}
			}

			//保存到主表
			if($code == "wechat"){
				$archives = $this->SetQuery("INSERT INTO `#@__member` (`mtype`, `username`, `password`, `nickname`, `emailCheck`, `phoneCheck`, `sex`, `photo`, `regtime`, `logincount`, `lastlogintime`, `lastloginip`, `lastloginipaddr`, `regip`, `regipaddr`, `state`, `".$code."_conn`, `wechat_openid`) VALUES (1, '$username', '$pwd', '$nickname', '0', '0', '$sex', '$pic', '$time', '1', '$time', '$ip', '$ipaddr', '$ip', '$ipaddr', '1', '$key', '$openid')");
			}else{
				$archives = $this->SetQuery("INSERT INTO `#@__member` (`mtype`, `username`, `password`, `nickname`, `emailCheck`, `phoneCheck`, `sex`, `photo`, `regtime`, `logincount`, `lastlogintime`, `lastloginip`, `lastloginipaddr`, `regip`, `regipaddr`, `state`, `".$code."_conn`) VALUES (1, '$username', '$pwd', '$nickname', '0', '0', '$sex', '$pic', '$time', '1', '$time', '$ip', '$ipaddr', '$ip', '$ipaddr', '1', '$key')");
			}
			$results = $this->db->prepare($archives);
			$results->execute();
			$aid = $this->db->lastInsertId();

			if($aid){

				//保存到主表
				$archives = $this->SetQuery("INSERT INTO `#@__member_login` (`userid`, `logintime`, `loginip`, `ipaddr`) VALUES ('$aid', '$time', '$ip', '$ipaddr')");
				$results = $this->db->prepare($archives);
				$results->execute();

				//如果是微信扫码登录，需要更新临时登录日志
				if($state){
					$archives = $this->SetQuery("UPDATE `#@__site_wxlogin` SET `uid` = '$aid' WHERE `state` = '$state'");
					$results = $this->db->prepare($archives);
					$results->execute();
				}

				//论坛同步
				global $cfg_bbsState;
				global $cfg_bbsType;
				if($cfg_bbsState == 1 && $cfg_bbsType != ""){
					$data['username'] = $username;
					$data['password'] = $password;
					$data['email']    = $chcode."@qq.com";
					$this->bbsSync($data, "register");
				}

				//站点登录
				$this->keepUserID = $this->keepMemberID;
				$this->userID = $aid;
				$this->keepUser();

				//论坛登录
				$data['username'] = $username;
				$data['uPwd']     = $password;
				$this->bbsSync($data, "synlogin");

				if(!$noRedir || $state){
					if($notclose){
						die('<meta charset="UTF-8"><script type="text/javascript">top.location="'.$loginRedirect.'";</script>');
					}else{
						die('<meta charset="UTF-8"><script type="text/javascript">window.close();top.location="'.$loginRedirect.'";</script>');
						// echo '<script type="text/javascript">setTimeout(function(){window.close();}, 500);</script>授权成功！';
					}
				}

			}else{

				if(!$noRedir || $state){
					if($notclose){
						die('<meta charset="UTF-8"><script type="text/javascript">top.location="'.$loginRedirect.'";</script>');
					}else{
						die('<meta charset="UTF-8"><script type="text/javascript">setTimeout(function(){window.close();top.location="'.$loginRedirect.'";}, 5000);</script>登录失败2！');
						// die("登录失败！");
					}
				}
			}

		}

	}


  /**
   *  保持用户的会话状态
   *
   * @access    public
   * @return    int    成功返回 1 ，失败返回 -1
   */
	function keepUser(){
		$time = GetMkTime(time());
		if($this->userID != '' && $this->checkUserNull($this->userID)){
			global $cfg_cookiePath;
			global $cfg_onlinetime;
			$RenrenCrypt = new RenrenCrypt();
			$userid = base64_encode($RenrenCrypt->php_encrypt($this->userID));
			PutCookie($this->keepUserID, $userid, $cfg_onlinetime * 60 * 60, $cfg_cookiePath);

			$archives = $this->SetQuery("UPDATE `#@__member` SET `online` = '$time' WHERE `id` = ".$this->userID);
			$results = $this->db->prepare($archives);
			$results->execute();

			return 1;
		}else{
			if(GetCookie($this->keepUserID) != '' && $this->checkUserNull(GetCookie($this->keepUserID))){
				global $cfg_cookiePath;
				global $cfg_onlinetime;

				$RenrenCrypt = new RenrenCrypt();
				$userid = $RenrenCrypt->php_decrypt(base64_decode(GetCookie($this->keepUserID)));

				$archives = $this->SetQuery("UPDATE `#@__member` SET `online` = '$time' WHERE `id` = ".$userid);
				$results = $this->db->prepare($archives);
				$results->execute();

				PutCookie($this->keepUserID, GetCookie($this->keepUserID), $cfg_onlinetime * 60 * 60, $cfg_cookiePath);
				return 1;
			}else{
				return -1;
			}
		}
	}

  /**
   *  结束用户的会话状态
   *
   * @access    public
   * @return    void
   */
	function exitUser(){
		unset($_SESSION[$this->keepUserID]);
		DropCookie($this->keepUserID);
		//$_SESSION = array();
	}

  /**
   *  结束用户的会话状态
   *
   * @access    public
   * @return    void
   */
	function exitMember(){
		unset($_SESSION[$this->keepMemberID]);

		$RenrenCrypt = new RenrenCrypt();
		$userid = $RenrenCrypt->php_decrypt(base64_decode(GetCookie($this->keepMemberID)));

		if($userid){
			$archives = $this->SetQuery("UPDATE `#@__member` SET `online` = 0 WHERE `id` = ".$userid);
			$results = $this->db->prepare($archives);
			$results->execute();
		}


		DropCookie($this->keepMemberID);

		global $cfg_bbsState;
		global $cfg_bbsType;
		if($cfg_bbsState == 1 && $cfg_bbsType != ""){
			$this->bbsSync($this->keepMemberID, "logout");
		}
		//$_SESSION = array();
	}

  /**
   *  获得用户的ID
   *
   * @access    public
   * @return    int
   */
	function getUserID(){
		// if($this->userID != '' && $this->checkUserNull($this->userID)){
		// 	return $this->userID;
		// }else{
		// 	if(GetCookie($this->keepUserID) != '' && $this->checkUserNull(GetCookie($this->keepUserID))){
		// 		$RenrenCrypt = new RenrenCrypt();
		// 		$userid = $RenrenCrypt->php_decrypt(base64_decode(GetCookie($this->keepUserID)));
		// 		return $userid;
		// 	}else{
		// 		return -1;
		// 	}
		// }
		if($this->userID != ''){
			return $this->userID;
		}else{
			if(GetCookie($this->keepUserID) != ''){
				$RenrenCrypt = new RenrenCrypt();
				$userid = $RenrenCrypt->php_decrypt(base64_decode(GetCookie($this->keepUserID)));
				return $userid;
			}else{
				return -1;
			}
		}
	}

  /**
   *  获得用户的ID
   *
   * @access    public
   * @return    int
   */
	function getMemberID(){
		if($this->userID != '' && $this->checkUserNull($this->userID)){
			return $this->userID;
		}else{
			if(GetCookie($this->keepMemberID) != '' && $this->checkUserNull(GetCookie($this->keepMemberID))){
				$RenrenCrypt = new RenrenCrypt();
				$userid = $RenrenCrypt->php_decrypt(base64_decode(GetCookie($this->keepMemberID)));
				return $userid;
			}else{
				unset($_SESSION[$this->keepMemberID]);
				//$this->exitMember();
				return -1;
			}
		}
	}

	/**
   *  获得用户的权限值
   *
   * @access    public
   * @return    int
   */
	function getPurview(){
		if($this->userPurview != ''){
			return $this->userPurview;
		}else{
			if(GetCookie($this->keepUserID) != ''){
				$RenrenCrypt = new RenrenCrypt();
				$userid = $RenrenCrypt->php_decrypt(base64_decode(GetCookie($this->keepUserID)));

				$sql = $this->SetQuery("SELECT member.*,admin.purviews FROM `#@__member` member LEFT JOIN `#@__admingroup` admin ON admin.id = member.mgroupid WHERE member.id = '".$userid."' AND member.mgroupid != '' LIMIT 1");

				try{
					$stmt = $this->db->prepare($sql);
					$stmt->execute();
					$param = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$user = array_shift($param);
					$stmt->closeCursor();
				}catch(Exception $e){
					die($e->getMessage());
				}

				return $user['purviews'];
			}else{
				$this->exitUser();
				header("location:".HUONIAOADMIN."/login.php");
				die;
			}
		}
	}

	/**
	 * 为给定的字符串生成一个加“盐”的散列值
	 *
	 * @param string $string 即将被散列的字符串
	 * @param string $salt 从这个串中提取“盐”
	 * @return string 加“盐”之后的散列值
	 */
	function _getSaltedHash($string, $salt=NULL){

		//如果没有传入“盐”，则生成一个“盐”
		if($salt == NULL){
			$salt = substr(md5(time()), 0, $this->_saltLength);

		//如果传入了salt，则从中提取真正的"盐"
		}else{
			$salt = substr($salt, 0, $this->_saltLength);
		}
		//将“盐”添加到散列之前并返回散列值
		return $salt.sha1($salt.$string);

	}


	/**
	 * 判断会员是否已经登录，如果没有登录，则根据会员类型跳转到不同的登录页面
	 *
	 */
	function checkUserIsLogin(){

		global $dirDomain;     //当前页面
		global $cfg_basehost;
		global $template;

		$param = array("service"  => "member");
		$busiDomain = getUrlPath($param);     //商家会员域名

		$basehost = "http://".$cfg_basehost;  //网站首页域名

		$ischeck = explode($busiDomain, $dirDomain);

		//如果没有登录，根据访问地址进入不同的登录页面
		if($this->getMemberID() == -1){

			$url = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			if(count($ischeck) > 1){
				$basehost = $busiDomain;
			}
			header("location:".$basehost."/login.html?furl=".urlencode($dirDomain));
			die;

		//如果已经登录，判断用户类型是否符合进入当前页面
		}else{

			$param = array("service" => "member",	"type" => "user");
			$userDomain = getUrlPath($param);     //个人会员域名

			$userinfo = $this->getMemberInfo();  //当前登录会员信息

			//个人会员不得进入商家会员中心，如果在商家会员的页面，则自动跳转至开通页面
			if($userinfo['userType'] == 1){
				$ischeck = explode($userDomain, $dirDomain);
				if(count($ischeck) <= 1 && $template != "bindemail"){
					$param = array("service" => "member",	"template" => "business");
					$business = getUrlPath($param);
					header("location:".$business);
					die;
				}

			//商家会员不得进入个人中心页面，否则自动跳转商家会员首页
			}elseif($userinfo['userType'] == 2){
				$ischeck = explode($busiDomain, $dirDomain);
				if(count($ischeck) <= 1){
					//header("location:".$busiDomain);
					//die;
				}

			//其它情况，跳转到网站个人登录页面
			}else{
				$url = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
				header("location:".$basehost."/login.html?furl=".$url);
				die;
			}

		}

	}


	/**
	 * 论坛同步操作
	 * @param array $data     要操作的会员数据
	 * @param string $action  动作
	 * @return null
	 */
	function bbsSync($data, $action){
		global $cfg_bbsState;
		global $cfg_bbsType;
		if($cfg_bbsState == 1 && $cfg_bbsType != "" && $data){

			//discuz
			//if($cfg_bbsType == "discuz"){
				include_once(HUONIAOROOT."/api/bbs/".$cfg_bbsType."/config.inc.php");
				include_once(HUONIAOROOT."/api/bbs/discuz/uc_client/client.php");

				//判断登录
				if($action == "login"){
					$username = $data['username'];
					$password = $data['uPwd'];
					list($uid, $uname, $pword, $email_) = uc_user_login($username, $password);
					return $uid;

				//同步登录
				}elseif($action == "synlogin"){
					$username = $data['username'];
					$password = $data['uPwd'];
					list($uid, $uname, $pword, $email_) = uc_user_login($username, $password);
					if($uid > 0) {
						$ucsynlogin = uc_user_synlogin($uid);
						echo $ucsynlogin;
					}

				//同步退出
				}elseif($action == "logout"){
					$ucsynlogout = uc_user_synlogout();
					echo $ucsynlogout;

				//同步注册
				}elseif($action == "register"){
					$username = $data['username'];
					$password = $data['password'];
					$email    = $data['email'];
					$nickname = $data['nickname'];
					$phone    = $data['phone'];
					$qq       = $data['qq'];
					$sex      = $data['sex'];
					$birthday = $data['birthday'];
					$uid = uc_user_register($username, $password, $email, $nickname, $phone, $qq, $sex, $birthday);
					if($uid <= 0) {
						if($uid == -1) {
							return '用户名不合法';
						} elseif($uid == -2) {
							return '包含要允许注册的词语';
						} elseif($uid == -3) {
							return '用户名已经存在';
						} elseif($uid == -4) {
							return 'Email 格式有误';
						} elseif($uid == -5) {
							return 'Email 不允许注册';
						} elseif($uid == -6) {
							return '该 Email 已经被注册';
						} else {
							return '未定义';
						}
					}else {
						$username = $username;
					}
					if($username) {
						return '同步成功';
					}

				//同步删除
				}elseif($action == "delete"){
					//根据用户名查询UCenter用户ID
					$info = uc_get_user($data);
					$ucsyndelete = uc_user_delete($info[0]);

				//同步修改
				}elseif($action == "edit"){
					$username = $data['username'];
					$newpw    = $data['newpw'];
					$email    = $data['email'];
					$ucresult = uc_user_edit($username, "", $newpw, $email, 1);

				}

			//phpwind
			//}elseif($cfg_bbsType == "phpwind"){

			//}

		}
	}
}
