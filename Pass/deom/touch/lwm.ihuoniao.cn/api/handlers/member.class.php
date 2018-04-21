<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 会员模块API接口
 *
 * @version        $Id: member.class.php 2015-6-11 上午10:19:21 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class member {
	private $param;  //参数

	/**
		* 构造函数
		*
    * @param string $action 动作名
    */
	public function __construct($param = array()){
		$this->param = $param;
	}

	/**
     * 基本参数
     * @return array
     */
	public function config(){

		global $cfg_basehost;          //系统主域名

		global $cfg_userSubDomain;     //个人会员
		global $cfg_busiSubDomain;     //企业会员

		$params = !empty($this->param) && !is_array($this->param) ? explode(',',$this->param) : "";

		//个人会员
		// $userDomainInfo = getDomain('member', 'user');
		// $userChannelDomain = $userDomainInfo['domain'];
		// if($cfg_userSubDomain == 0){
		// 	$userChannelDomain = "http://".$userChannelDomain;
		// }elseif($cfg_userSubDomain == 1){
		// 	$userChannelDomain = "http://".$userChannelDomain.".".$cfg_basehost;
		// }elseif($cfg_userSubDomain == 2){
		// 	$userChannelDomain = "http://".$cfg_basehost."/".$userChannelDomain;
		// }

		//企业会员
		// $busiDomainInfo = getDomain('member', 'busi');
		// $busiChannelDomain = $busiDomainInfo['domain'];
		// if($cfg_busiSubDomain == 0){
		// 	$busiChannelDomain = "http://".$busiChannelDomain;
		// }elseif($cfg_busiSubDomain == 1){
		// 	$busiChannelDomain = "http://".$busiChannelDomain.".".$cfg_basehost;
		// }elseif($cfg_busiSubDomain == 2){
		// 	$busiChannelDomain = "http://".$cfg_basehost."/".$busiChannelDomain;
		// }

		include HUONIAOINC.'/siteModuleDomain.inc.php';
		$userChannelDomain = $userDomain;
		$busiChannelDomain = $busiDomain;

		$return = array();
		if(!empty($params) > 0){

			foreach($params as $key => $param){
				if($param == "userDomain"){
					$return['userDomain'] = $userChannelDomain;
				}elseif($param == "busiDomain"){
					$return['busiDomain'] = $busiChannelDomain;
				}
			}

		}else{
			$return['userDomain'] = $userChannelDomain;
			$return['busiDomain'] = $busiChannelDomain;
		}

		return $return;

	}


	/**
     * 会员信息详情
     * @return array
     */
	public function detail(){
		global $dsql;
		$detail = array();
		$id = $this->param;

		$id = is_array($id) ? $id['id'] : $id;

		if($id == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `state` = 1 AND `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$detail['userid'] = $results[0]['id'];
			$detail['userType'] = $results[0]['mtype'];
			$detail['username'] = $results[0]['username'];
			if($results[0]['mtype'] == 2){
				$detail['nickname'] = !empty($results[0]['company']) ? $results[0]['company'] : $results[0]['nickname'];
				$detail['person'] = $results[0]['realname'];
			}else{
				$detail['nickname'] = $results[0]['nickname'];
			}
			$detail['certifyState'] = $results[0]['certifyState'];
			$detail['certifyInfo'] = $results[0]['certifyInfo'];
			$detail['idcard'] = preg_replace('/([0-9]{5})[0-9]{11}(.*?)/is',"$1*************$2", $results[0]['idcard']);
			$detail['paypwdCheck'] = $results[0]['paypwdCheck'];
			$detail['email'] = $results[0]['email'];
			$detail['emailEncrypt'] = preg_replace('/([0-9a-zA-Z]{3})(.*?)@(.*?)/is',"$1***@$3", $results[0]['email']);
			$detail['emailCheck'] = $results[0]['emailCheck'];
			$detail['phone'] = $results[0]['phone'];
			$detail['phoneEncrypt'] = preg_replace('/(1[34578]{1}[0-9])[0-9]{4}([0-9]{4})/is',"$1****$2", $results[0]['phone']);
			$detail['phoneCheck'] = $results[0]['phoneCheck'];
			$detail['qq'] = $results[0]['qq'];
			$detail['photo'] = getFilePath($results[0]['photo']);
			$detail['photoSource'] = $results[0]['photo'];
			$detail['sex'] = $results[0]['sex'];
			$detail['birthday'] = $results[0]['birthday'];

			$sql = $dsql->SetQuery("SELECT log.`id` FROM `#@__member_letter_log` log LEFT JOIN `#@__member_letter` l ON l.`id` = log.`lid` WHERE log.`state` = 0 AND l.`type` = 0 AND log.`uid` = $id");
			$msgnum = $dsql->dsqlOper($sql, "totalCount");

			$detail['message']  = $msgnum;
			$detail['money']  = $results[0]['money'];
			$detail['freeze']  = $results[0]['freeze'];
			$detail['point']  = $results[0]['point'];
			$detail['regtime']  = date("Y-m-d H:i:s", $results[0]['regtime']);
			$detail['regip']  = $results[0]['regip'];
			$detail['regipaddr']  = $results[0]['regipaddr'];
			$detail['lastlogintime']  = $results[0]['lastlogintime'] ? date("Y-m-d H:i:s", $results[0]['lastlogintime']) : "";
			$detail['lastloginip']  = $results[0]['lastloginip'];
			$detail['lastloginipaddr']  = $results[0]['lastloginipaddr'];
			$detail['tempbg']  = $results[0]['tempbg'];
			$detail['online']  = $results[0]['online'];

			//区域
			$detail['addrid'] = $results[0]['addr'];
			global $data;
			$data = "";
			$addrArr = getParentArr("site_area", $results[0]['addr']);
			if($addrArr){
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$detail['addrName'] = join(" > ", $addrArr);
			}else{
				$detail['addrName'] = "";
			}

			if($results[0]['mtype'] == 2){
				$detail['company'] = $results[0]['company'];
				$detail['address'] = $results[0]['address'];
				$detail['licenseState'] = $results[0]['licenseState'];
				$detail['licenseInfo'] = $results[0]['licenseInfo'];
			}

			$total = 100;
			//验证支付密码
			if(empty($results[0]['paypwd'])){
				$total -= 20;
			}
			//验证实名
			if($results[0]['mtype'] == 1 && $results[0]['certifyState'] != 1){
				$total -= 20;
			}elseif($results[0]['mtype'] == 2 && $results[0]['licenseState'] != 1){
				$total -= 20;
			}
			//验证手机
			if($results[0]['phoneCheck'] != 1){
				$total -= 20;
			}
			//验证邮箱
			if($results[0]['emailCheck'] != 1){
				$total -= 20;
			}
			//验证密保问题
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_security` WHERE `uid` = ".$id);
			$security = $dsql->dsqlOper($archives, "totalCount");
			if($security < 1){
				$total -= 20;
				$detail['question']  = 0;
			}else{
				$detail['question']  = 1;
			}

			$detail['security'] = $total;
		}
		return $detail;
	}


	//站内消息
	public function message(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$state = $notice = $page = $pageSize = 0;

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$state    = $this->param['state'];
				$notice   = $this->param['notice'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$uid = $userLogin->getMemberID();

		if(!is_numeric($uid)) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT log.`id`, log.`state`, l.`title`, l.`date` FROM `#@__member_letter_log` log LEFT JOIN `#@__member_letter` l ON l.`id` = log.`lid` WHERE log.`uid` = ".$uid);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//未读
		$unread     = $dsql->dsqlOper($archives." AND log.`state` = 0", "totalCount");
		//已读
		$read       = $dsql->dsqlOper($archives." AND log.`state` = 1", "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$where = "";
		if($state != ""){
			$where = " AND log.`state` = '$state'";

			if($state == 0){
				$totalPage = ceil($unread/$pageSize);
			}elseif($state == 1){
				$totalPage = ceil($read/$pageSize);
			}
		}

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount,
			"unread" => $unread,
			"read" => $read
		);

		$atpage = $pageSize*($page-1);
		$results = $dsql->dsqlOper($archives.$where." ORDER BY log.`id` DESC LIMIT $atpage, $pageSize", "results");

		$uinfo = $userLogin->getMemberInfo();
		if($results){
			foreach($results as $key => $val){
				$list[$key]['date']  = date("Y-m-d H:i:s", $val['date']);
				$list[$key]['state'] = $val['state'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['id']    = $val['id'];

				if($uinfo['userType'] == 2){
					$param = array(
						"service"     => "member",
						"template"    => "message_detail",
						"id"          => $val['id']
					);
				}else{
					$param = array(
						"service"     => "member",
						"type"        => "user",
						"template"    => "message_detail",
						"id"          => $val['id']
					);
				}

				$list[$key]['url'] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	//查询未通知的新消息
	public function getNewNotice(){

		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		//查询消息通知
		$sql = $dsql->SetQuery("SELECT count(`id`) c FROM `#@__member_letter_log` WHERE `uid` = $uid AND `notice` = 0");
		$ret = $dsql->dsqlOper($sql, "results");
		$hasnew = $ret[0]['c'];

		return $hasnew;
	}


	//清除未通知的新消息
	public function clearNewNotice(){

		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		//查询消息通知
		$sql = $dsql->SetQuery("UPDATE `#@__member_letter_log` SET `notice` = 1 WHERE `uid` = $uid");
		$ret = $dsql->dsqlOper($sql, "update");
		if($ret == "ok"){
			return true;
		}
	}


	//删除站内信
	public function delMessage(){
		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$id = $this->param['id'];

		if(empty($id)) return array("state" => 200, "info" => '没有要删除的信息！');

		$archives = $dsql->SetQuery("DELETE FROM `#@__member_letter_log` WHERE `id` in (".$id.") AND `uid` = '$uid'");
		$dsql->dsqlOper($archives, "update");

		return "删除成功！";

	}


	//设置站内信为已读
	public function setMessageRead(){
		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$id = $this->param['id'];

		if(empty($id)) return array("state" => 200, "info" => '没有要操作的信息！');

		$archives = $dsql->SetQuery("UPDATE `#@__member_letter_log` SET `state` = 1 WHERE `id` in (".$id.") AND `uid` = '$uid'");
		$dsql->dsqlOper($archives, "update");

		return "设置成功！";

	}


	//验证用户身份
	public function authentication(){
		global $dsql;
		global $userLogin;
		$id = $userLogin->getMemberID();

		if($id == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$param = $this->param;
		$do    = $param['do'];
		$opera = $param['opera'];

		$uinfo = $userLogin->getMemberInfo();

		//使用手机验证
		if($do == "authPhone"){

			if($uinfo['phoneCheck'] != 1) return array("state" => 200, "info" => '您的手机暂未认证，请使用其它方式验证！');

			$phone   = $uinfo['phone'];
			$vdimgck = $param['vdimgck'];

			//验证输入的验证码
			$archives = $dsql->SetQuery("SELECT `id`, `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'auth' AND `user` = '$phone' AND `code` = '$vdimgck'");
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '验证码输入错误，请重试！');
			}else{

				//5分钟有效期
				$now = GetMkTime(time());
				if($now - $results[0]['pubdate'] > 300) return array("state" => 200, "info" => '验证码已过期，请重新获取！');

				//验证通过删除发送的验证码
				$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'auth' AND `user` = '$phone' AND `code` = '$vdimgck'");
				$dsql->dsqlOper($archives, "update");

				//执行接下来的操作
				$this->doAuthOpera($id, $opera);

				return "验证通过！";
			}

		//使用邮箱验证
		}elseif($do == "authEmail"){

			if($uinfo['emailCheck'] != 1) return array("state" => 200, "info" => '您的邮箱暂未认证，请使用其它方式验证！');

			$email   = $uinfo['email'];
			$vdimgck = $param['vdimgck'];

			//验证输入的验证码
			$archives = $dsql->SetQuery("SELECT `id`, `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'email' AND `lei` = 'auth' AND `user` = '$email' AND `code` = '$vdimgck'");
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '验证码输入错误，请重试！');
			}else{

				//5分钟有效期
				$now = GetMkTime(time());
				if(round(($now - $results[0]['pubdate'])/3600) > 24) return array("state" => 200, "info" => '验证码已过期，请重新获取！');

				//验证通过删除发送的验证码
				$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'email' AND `lei` = 'auth' AND `user` = '$email' AND `code` = '$vdimgck'");
				$dsql->dsqlOper($archives, "update");

				//执行接下来的操作
				$this->doAuthOpera($id, $opera);

				return "验证通过！";
			}

		//使用安全保护问题
		}elseif($do == "authQuestion"){

			if($uinfo['question'] == 0) return array("state" => 200, "info" => '您还没有启用安全保护问题，请使用其它方式验证！');

			$answer   = $param['answer'];

			//验证输入的验证码
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_security` WHERE `uid` = '$id' AND `answer` = '$answer'");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results == 0){
				return array("state" => 200, "info" => '您输入的答案不正确，请重试！');
			}else{

				//执行接下来的操作
				$this->doAuthOpera($id, $opera);

				return "验证通过！";
			}

		}

	}

	public function doAuthOpera($id, $type){

		if(empty($type)) return;

		global $dsql;

		//重置支付密码
		if($type == "paypwd"){
			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `paypwd` = '', `paypwdCheck` = 0 WHERE `id` = '$id'");
			$dsql->dsqlOper($archives, "update");

		//修改手机号码
		}elseif($type == "changePhone"){
			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `phone` = '', `phoneCheck` = 0 WHERE `id` = '$id'");
			$dsql->dsqlOper($archives, "update");

		//修改邮箱
		}elseif($type == "changeEmail"){
			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `email` = '', `emailCheck` = 0 WHERE `id` = '$id'");
			$dsql->dsqlOper($archives, "update");

		//修改安全保护问题
		}elseif($type == "changeQuestion"){
			$archives = $dsql->SetQuery("DELETE FROM `#@__member_security` WHERE `uid` = '$id'");
			$dsql->dsqlOper($archives, "update");
		}

	}

	//修改基本资料
	public function updateProfile(){
		global $dsql;
		global $userLogin;
		$return = array();
		$id = $userLogin->getMemberID();
		$uinfo = $userLogin->getMemberInfo();
		if($id == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$param    = $this->param;
		$sex      = (int)$param['sex'];
		$qq       = (int)$param['qq'];
		$addr     = (int)$param['addr'];
		$birthday = $param['birthday'];
		$birthday = !empty($birthday) ? GetMkTime($birthday) : 0;

		$params = '';

		if($qq){
			$params .= ", `qq` = '$qq'";
		}
		if($addr){
			$params .= ", `addr` = '$addr'";
		}
		if($birthday){
			$params .= ", `birthday` = '$birthday'";
		}

		if($uinfo['userType'] == 2){
			$company = !empty($param['company']) ? $param['company'] : $param['nickname'];
			$address = $param['address'];
			$nickname = $param['person'];

			if($company){
				$params .= ", `company` = '$company'";
			}
			if($nickname){
				$params .= ", `nickname` = '$nickname'";
			}
			if($address){
				$params .= ", `address` = '$address'";
			}

		}else{

			$nickname = $param['nickname'];
			if($nickname){
				$params .= ", `nickname` = '$nickname'";
			}
		}

		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `sex` = '$sex'".$params." WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			return "修改成功！";
		}else{
			return array("state" => 200, "info" => '修改失败！');
		}

	}


	//找回密码
	public function backpassword(){
		global $dsql;
		global $cfg_basehost;
		global $cfg_webname;
		global $cfg_geetest;
		$param = $this->param;

		if(empty($param)) return array("state" => 200, "info" => '格式错误！');

		$type     = $param['type'];    //类型，1邮箱，2手机
		$email    = $param['email'];    //邮箱
		$phone    = $param['phone'];    //手机
		$vericode = $param['vericode']; //验证码
		$vdimgck  = $param['vdimgck'];  //手机验证码
		$isend    = $param['isend'];

		//如果没有开启了极验
		if(!$cfg_geetest){
			if(strtolower($vericode) != $_SESSION['huoniao_vdimg_value'] && !$isend) return array("state" => 200, "info" => '验证码输入错误，请重试！');
		}

		$ip = GetIP();
		$now = GetMkTime(time());
		$RenrenCrypt = new RenrenCrypt();

		//邮箱
		if($type == 1){

			if($cfg_geetest){
				$geetest_challenge = $param['geetest_challenge'];
				$geetest_validate  = $param['geetest_validate'];
				$geetest_seccode   = $param['geetest_seccode'];
				$terminal          = $param['terminal'];
				$terminal = empty($terminal) ? "pc" : $terminal;

				$verifyGeetest = json_decode(verifyGeetest($geetest_challenge, $geetest_validate, $geetest_seccode, $terminal), true);
				if(!is_array($verifyGeetest) || $verifyGeetest['status'] == 'fail'){
					return array("state" => 200, "info" => '图形验证错误，请重试！');
				}
			}

			if(empty($email)) return array("state" => 200, "info" => '请输入邮箱地址！');
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `email` = '$email'");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results == 0) return array("state" => 200, "info" => '该邮箱地址没有注册过会员！');

			$data = base64_encode($RenrenCrypt->php_encrypt("1$$".$email."$$".$ip."$$".$now));

			$link = "http://".$cfg_basehost."/resetpwd.html?data=".$data;

			//获取邮件内容
			$cArr = getInfoTempContent("mail", '会员-找回密码-发送验证码', array("link" => $link));
			$title = $cArr['title'];
			$content = $cArr['content'];

			if($title == "" && $content == ""){
				return array("state" => 200, "info" => '邮件通知功能未开启，发送失败！');
			}

			// $title = "找回密码-".$cfg_webname;
			// $content = "请点击下面的链接去重置密码：<br /><a href='".$link."'>".$link."</a><br />（如果点击链接没反应，请复制激活链接，粘贴到浏览器地址栏后访问）<br /><br />为了保障您帐号的安全性，请在24小时内完成重置，超时需要重新获取邮件。<br /><br />".$cfg_webname."<br />".date("Y-m-d", time())."<br /><br />如您错误的收到了此邮件，请不要点击链接。<br />这是一封系统自动发出的邮件，请不要直接回复。";

			$replay = sendmail($email, $title, $content);

			if(!empty($replay)){
				messageLog("email", "fpwd", $email, $title, addslashes($content), 0, 1);
				return array("state" => 200, "info" => '邮件发送失败，请稍候重试！');
			}else{
				messageLog("email", "fpwd", $email, $title, addslashes($content), 0, 0);
				return "邮件发送成功，请在24小时内点击邮件中的链接继续操作！";
			}

		//手机
		}elseif($type == 2){

			if(empty($phone)) return array("state" => 200, "info" => '请输入手机号码！');
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `phone` = '$phone'");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results == 0) return array("state" => 200, "info" => '该手机号码没有注册过会员！');



			//验证输入的验证码
			$archives = $dsql->SetQuery("SELECT `id`, `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'fpwd' AND `user` = '$phone' AND `code` = '$vdimgck'");
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '短信验证码输入错误！');
			}else{

				//5分钟有效期
				$now = GetMkTime(time());
				if($now - $results[0]['pubdate'] > 300) return array("state" => 200, "info" => '验证码已过期，请重新获取！');

				//验证通过删除发送的验证码
				$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'fpwd' AND `user` = '$phone' AND `code` = '$vdimgck'");
				$dsql->dsqlOper($archives, "update");

				$data = base64_encode($RenrenCrypt->php_encrypt("2$$".$phone."$$".$ip."$$".$now));
				return "http://".$cfg_basehost."/resetpwd.html?data=".$data;
			}

		}


	}


	//重置密码
	public function resetpwd(){
		global $dsql;
		global $userLogin;
		$param = $this->param;

		$data = $param['data'];    //安全验证数据
		$npwd = $param['npwd'];    //新密码

		if(empty($data)) return array("state" => 200, "info" => '非法请求！');


		//验证安全链接
		$RenrenCrypt = new RenrenCrypt();
		$data = $RenrenCrypt->php_decrypt(base64_decode($data));

		$dataArr = explode("$$", $data);
		if(count($dataArr) != 4) return array("state" => 200, "info" => '非法请求！');

		if($dataArr[0] == 1){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `email` = '".$dataArr[1]."'");
		}elseif($dataArr[0] == 2){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `phone` = '".$dataArr[1]."'");
		}
		$results  = $dsql->dsqlOper($archives, "totalCount");
		if($results == 0) return array("state" => 200, "info" => '会员不存在！');

		$now = GetMkTime(time());
		if($now - $dataArr[3] > 24 * 3600) return array("state" => 200, "info" => '重置链接超时，请重新获取！');


		//新密码
		if(empty($npwd)) return array("state" => 200, "info" => '请输入新密码！');
		preg_match('/^.{5,}$/', $npwd, $matchPassword);
		if(!$matchPassword) return array("state" => 200, "info" => '新密码太过简单，请重新输入，最少5位！');


		$ret  = $dsql->dsqlOper($archives, "results");
		$uid = $ret[0]['id'];

		$newPass = $userLogin->_getSaltedHash($npwd);

		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `password` = '$newPass' WHERE `id` = ".$uid);
		$results = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			return "重置成功！";
		}else{
			return array("state" => 200, "info" => '重置失败！');
		}

	}



	//修改用户信息
	public function updateAccount(){
		global $dsql;
		global $userLogin;
		$return = array();
		$id = $userLogin->getMemberID();
		if($id == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$param = $this->param;
		$do = $param['do'];

		//修改昵称
		if($do == "nick"){

			$name = $param['name'];
			if(empty($name) || $name == "undefined") return array("state" => 200, "info" => '请输入新的昵称！');
			$name = cn_substrR($name, 10);

			$memberInfo = $userLogin->getMemberInfo();
			if($memberInfo['userType'] == 2){
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `nickname` = '$name', `company` = '$name' WHERE `id` = ".$id);
			}else{
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `nickname` = '$name' WHERE `id` = ".$id);
			}

			$results = $dsql->dsqlOper($archives, "update");
			if($results == "ok"){
				return "修改成功！";
			}else{
				return array("state" => 200, "info" => '修改失败！');
			}

		//修改密码
		}elseif($do == "password"){

			$old = $param['old'];
			$new = $param['new'];
			$confirm = $param['confirm'];

			if(empty($old) || $old == "undefined" || empty($new) || $new == "undefined" || empty($confirm) || $confirm == "undefined") return array("state" => 200, "info" => '请输入完整！');

			if(strlen($new) < 6) return array("state" => 200, "info" => '新密码太过简单，请重新输入！');

			$archives = $dsql->SetQuery("SELECT `password` FROM `#@__member` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			$uinfo = $results[0];

			$hash = $userLogin->_getSaltedHash($old, $uinfo['password']);
			if($hash != $uinfo['password']) return array("state" => 200, "info" => '您输入的当前密码不正确，请确认后重试，<br />或者使用【密码找回】功能！');

			if($new != $confirm) return array("state" => 200, "info" => '两次输入的新密码不一致，请重新输入！');
			$newPass = $userLogin->_getSaltedHash($new);

			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `password` = '$newPass' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");
			if($results == "ok"){
				return "修改成功！";
			}else{
				return array("state" => 200, "info" => '修改失败！');
			}

		//设置支付密码
		}elseif($do == "paypwdAdd"){

			$pay1 = $param['pay1'];
			$pay2 = $param['pay2'];

			if(empty($pay1) || $pay1 == "undefined" || empty($pay2) || $pay2 == "undefined") return array("state" => 200, "info" => '请输入完整！');

			if(strlen($pay1) < 6) return array("state" => 200, "info" => '支付密码太过简单，请重新输入！');

			$paypwd = $userLogin->_getSaltedHash($pay1);

			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `paypwd` = '$paypwd', `paypwdCheck` = 1 WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");
			if($results == "ok"){
				return "设置成功！";
			}else{
				return array("state" => 200, "info" => '设置失败！');
			}

		//修改支付密码
		}elseif($do == "paypwdEdit"){

			$old = $param['old'];
			$new = $param['new'];
			$confirm = $param['confirm'];

			if(empty($old) || $old == "undefined" || empty($new) || $new == "undefined" || empty($confirm) || $confirm == "undefined") return array("state" => 200, "info" => '请输入完整！');

			if(strlen($new) < 6) return array("state" => 200, "info" => '新的支付密码太过简单，请重新输入！');

			$archives = $dsql->SetQuery("SELECT `paypwd` FROM `#@__member` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			$uinfo = $results[0];

			$hash = $userLogin->_getSaltedHash($old, $uinfo['paypwd']);
			if($hash != $uinfo['paypwd']) return array("state" => 200, "info" => '您输入的当前密码不正确，请确认后重试，<br />或者使用【重置】功能重置支付密码！');

			if($new != $confirm) return array("state" => 200, "info" => '两次输入的新密码不一致，请重新输入！');
			$newPass = $userLogin->_getSaltedHash($new);

			$archives = $dsql->SetQuery("UPDATE `#@__member` SET `paypwd` = '$newPass' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");
			if($results == "ok"){
				return "修改成功！";
			}else{
				return array("state" => 200, "info" => '修改失败！');
			}

		//实名认证
		}elseif($do == "certify"){

			$memberInfo    = $userLogin->getMemberInfo();
			$realname = $param['realname'];
			$idcard   = $param['idcard'];
			$front    = $param['front'];
			$back     = $param['back'];
			$license  = $param['license'];

			$realname = cn_substrR($realname, 10);
			$idcard = cn_substrR($idcard, 18);

			if(empty($realname) || $realname == "undefined" || empty($idcard) || $idcard == "undefined" || empty($front) || $front == "undefined" || empty($back) || $back == "undefined") return array("state" => 200, "info" => '请输入完整！');

			//企业
			if($memberInfo['userType'] == 2){
				if(empty($license)) return array("state" => 200, "info" => '请上传营业执照！');

				$archives = $dsql->SetQuery("SELECT `licenseState` FROM `#@__member` WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");
				$uinfo = $results[0];
				if($uinfo['licenseState'] == 1) return array("state" => 200, "info" => '您的企业认证已经通过审核！');
				if($uinfo['licenseState'] == 3) return array("state" => 200, "info" => '您的企业认证信息已经提交，请等待工作人员审核！');
			}

			//个人
			if($memberInfo['userType'] == 1){
				$archives = $dsql->SetQuery("SELECT `certifyState` FROM `#@__member` WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");
				$uinfo = $results[0];
				if($uinfo['certifyState'] == 1) return array("state" => 200, "info" => '您的实名认证已经通过审核！');
				if($uinfo['certifyState'] == 3) return array("state" => 200, "info" => '您的实名认证信息已经提交，请等待工作人员审核！');
			}


			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `idcard` = '$idcard' AND `id` != ".$id);
			$results = $dsql->dsqlOper($archives, "totalCount");
			global $cfg_hotline;
			if($results > 0) return array("state" => 200, "info" => '您输入的身份证号码已经被其他帐号绑定，如需申诉请致电【'.$cfg_hotline.'】处理！');


			if($memberInfo['userType'] == 1){
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `realname` = '$realname', `idcard` = '$idcard', `idcardFront` = '$front', `idcardBack` = '$back', `certifyState` = 3 WHERE `id` = ".$id);
			}
			if($memberInfo['userType'] == 2){
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `realname` = '$realname', `idcard` = '$idcard', `idcardFront` = '$front', `idcardBack` = '$back', `license` = '$license', `certifyState` = 3, `licenseState` = 3 WHERE `id` = ".$id);
			}

			$results = $dsql->dsqlOper($archives, "update");
			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("member", "certify");

				return "提交成功，请等待工作人员审核！";
			}else{
				return array("state" => 200, "info" => '设置失败！');
			}

		//获取实名认证信息
		}elseif($do == "getCerfityData"){

			$return = array();
			$archives = $dsql->SetQuery("SELECT `mtype`, `certifyState`, `certifyInfo`, `realname`, `idcard`, `idcardFront`, `idcardBack`, `license`, `licenseState`, `licenseInfo` FROM `#@__member` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			$uinfo = $results[0];

			if($uinfo['mtype'] == 1){
				if($uinfo['certifyState'] == 0) return array("state" => 200, "info" => '获取失败，您还未提交实名认证信息！');
				if($uinfo['certifyState'] == 2) return array("state" => 200, "info" => $uinfo['certifyInfo']);
			}

			if($uinfo['mtype'] == 2){
				if($uinfo['licenseState'] == 0) return array("state" => 200, "info" => '获取失败，您还未提交公司认证信息！');
				if($uinfo['licenseState'] == 2) return array("state" => 200, "info" => $uinfo['licenseInfo']);

				$return['license'] = getFilePath($uinfo['license']);
			}

			$return['realname'] = $uinfo['realname'];
			$return['idcard']   = $uinfo['idcard'];
			$return['front']    = getFilePath($uinfo['idcardFront']);
			$return['back']     = getFilePath($uinfo['idcardBack']);
			return $return;

		//手机绑定
		}elseif($do == "chphone"){

			$phone   = $param['phone'];
			$vdimgck = $param['vdimgck'];
			global $cfg_hotline;

			if(!preg_match("/1[34578]{1}\d{9}$/", $phone)){
				return array("state" => 200, "info" => '请输入正确的手机号码！');
			}

			//判断手机号码是否已经被绑定
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `phone` = '$phone' AND `id` <> $id");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results > 0) {
				$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'verify' AND `user` = '$phone'");
				$dsql->dsqlOper($archives, "update");

				return array("state" => 200, "info" => '您输入的手机号码已经被其他帐号绑定，如需申诉请致电【'.$cfg_hotline.'】处理！');
			}

			//验证输入的验证码
			$archives = $dsql->SetQuery("SELECT `id`, `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'verify' AND `user` = '$phone' AND `code` = '$vdimgck'");
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '验证码输入错误，请重试！');
			}else{

				//5分钟有效期
				$now = GetMkTime(time());
				if($now - $results[0]['pubdate'] > 300) return array("state" => 200, "info" => '验证码已过期，请重新获取！');

				//验证通过删除发送的验证码
				$archives = $dsql->SetQuery("DELETE FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `lei` = 'verify' AND `user` = '$phone' AND `code` = '$vdimgck'");
				$dsql->dsqlOper($archives, "update");

				//更新用户状态
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `phone` = '$phone', `phoneCheck` = 1 WHERE `id` = '$id'");
				$dsql->dsqlOper($archives, "update");

				return "验证通过！";
			}

		//邮箱绑定
		}elseif($do == "chemail"){

			$email = $param['email'];
			global $cfg_hotline;
			global $cfg_basehost;
			global $cfg_webname;

			if(!CheckEmail($email)){
				return array("state" => 200, "info" => '请输入正确的邮箱地址！');
			}

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `email` = '$email' AND `id` <> $id");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results > 0) return array("state" => 200, "info" => '您输入的邮箱已经被其他帐号绑定，如需申诉请致电【'.$cfg_hotline.'】处理！');

			$ip = GetIP();
			$now = GetMkTime(time());
			global $cfg_webname;

			//URL地址加密
			$RenrenCrypt = new RenrenCrypt();
			$data = base64_encode($RenrenCrypt->php_encrypt($id."$$".$ip."$$".$now));

			$link = "http://".$cfg_basehost."/index.php?service=member&template=bindemail&data=".$data;

			//获取邮件内容
			$cArr = getInfoTempContent("mail", '会员-手机邮箱绑定-发送验证码', array("link" => $link));
			$title = $cArr['title'];
			$content = $cArr['content'];

			if($title == "" && $content == ""){
				return array("state" => 200, "info" => '邮件通知功能未开启，发送失败！');
			}

			// $title = $cfg_webname."-邮箱绑定";
			// $content = "请点击下面的链接完成绑定<br /><a href='".$link."'>".$link."</a><br />（如果点击链接没反应，请复制激活链接，粘贴到浏览器地址栏后访问）<br /><br />为了保障您帐号的安全性，请在 48小时内完成绑定，此链接将在您绑定过后失效！<br />激活邮件将在您激活一次后失效。<br /><br />".$cfg_webname."<br />".date("Y-m-d", time())."<br /><br />如您错误的收到了此邮件，请不要点击绑定按钮。<br />这是一封系统自动发出的邮件，请不要直接回复。";

			$replay = sendmail($email, $title, $content);

			if(!empty($replay)){
				messageLog("email", "bind", $email, $title, addslashes($content), $id, 1);
				return array("state" => 200, "info" => '邮件发送失败，请稍候重试！');
			}else{
				//更新用户状态
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `email` = '$email' WHERE `id` = '$id'");
				$dsql->dsqlOper($archives, "update");

				messageLog("email", "bind", $email, $title, addslashes($content), $id, 0);
				return "邮件发送成功，请在24小时内点击邮件中的链接继续绑定！";
			}

		//设置安全保护问题
		}elseif($do == "question"){

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_security` WHERE `uid` = '$id'");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results > 0){
				return array("state" => 200, "info" => '您已经设置过安全保护问题！');
			}

			$q1     = $param['q1'];
			$q2     = $param['q2'];
			$answer = $param['answer'];

			if(empty($q1)) return array("state" => 200, "info" => '请选择问题一！');
			if(empty($q2)) return array("state" => 200, "info" => '请选择问题二！');
			if(empty($answer)) return array("state" => 200, "info" => '请输入您的问题答案！');

			$question = $q1."$$".$q2;

			$archives = $dsql->SetQuery("INSERT INTO `#@__member_security` (`uid`, `question`, `answer`) VALUES ('$id', '$question', '$answer')");
			$return = $dsql->dsqlOper($archives, "update");
			if($return == "ok"){
				return "设置成功！";
			}else{
				return array("state" => 200, "info" => '设置失败，请刷新页面重试！');
			}

		}

	}


	//安全体检
	public function riskAdvicePolicy(){
		global $dsql;
		global $userLogin;
		$return = array();
		$id = $userLogin->getMemberID();

		if($id == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `state` = 1 AND `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$total = 100;
			//验证支付密码
			if(empty($results[0]['paypwd'])){
				$return['paypwd'] = "false";
			}else{
				$return['paypwd'] = "ok";
			}
			//验证实名
			if($results[0]['mtype'] == 1 && $results[0]['certifyState'] != 1){
				$return['certifyState'] = "false";
			}elseif($results[0]['mtype'] == 2 && $results[0]['licenseState'] != 1){
				$return['certifyState'] = "false";
			}else{
				$return['certifyState'] = "ok";
			}
			//验证手机
			if($results[0]['phoneCheck'] != 1){
				$return['phoneCheck'] = "false";
			}else{
				$return['phoneCheck'] = "ok";
			}
			//验证邮箱
			if($results[0]['emailCheck'] != 1){
				$return['emailCheck'] = "false";
			}else{
				$return['emailCheck'] = "ok";
			}
			//验证密保问题
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_security` WHERE `uid` = ".$id);
			$security = $dsql->dsqlOper($archives, "totalCount");
			if($security < 1){
				$return['security'] = "false";
			}else{
				$return['security'] = "ok";
			}
		}
		return $return;
	}


	/**
     * 交易明细
     * @return array
     */
	public function record(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$type = $page = $pageSize = 0;

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type     = $this->param['type'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$uid = $userLogin->getMemberID();

		if(!is_numeric($uid)) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member_money` WHERE `userid` = ".$uid);

		$where = "";
		if($type != ""){
			$where = " AND `type` = '$type'";
		}

		//总条数
		$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
		//总收入
		$add = $dsql->SetQuery("SELECT SUM(`amount`) AS amount FROM `#@__member_money` WHERE `userid` = ".$uid." AND `type` = 1");
		$totalAdd = $dsql->dsqlOper($add, "results");
		//总支出
		$less = $dsql->SetQuery("SELECT SUM(`amount`) AS amount FROM `#@__member_money` WHERE `userid` = ".$uid." AND `type` = 0");
		$totalLess = $dsql->dsqlOper($less, "results");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount,
			"totalAdd" => (float)$totalAdd[0]['amount'],
			"totalLess" => (float)$totalLess[0]['amount']
		);

		$atpage = $pageSize*($page-1);
		$results = $dsql->dsqlOper($archives.$where." ORDER BY `date` DESC LIMIT $atpage, $pageSize", "results");

		if($results){
			foreach($results as $key => $val){
				$flag = explode(",", $val['flag']);
				$list[$key]['date'] = date("Y-m-d H:i:s", $val['date']);
				$list[$key]['type']   = $val['type'];
				$list[$key]['amount'] = $val['amount'];
				$list[$key]['info'] = $val['info'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 积分明细
     * @return array
     */
	public function point(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$type = $page = $pageSize = 0;

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type     = $this->param['type'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$uid = $userLogin->getMemberID();

		if(!is_numeric($uid)) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member_point` WHERE `userid` = ".$uid);

		$where = "";
		if($type != ""){
			$where = " AND `type` = '$type'";
		}

		//总条数
		$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
		//总收入
		$add = $dsql->SetQuery("SELECT SUM(`amount`) AS amount FROM `#@__member_point` WHERE `userid` = ".$uid." AND `type` = 1");
		$totalAdd = $dsql->dsqlOper($add, "results");
		//总支出
		$less = $dsql->SetQuery("SELECT SUM(`amount`) AS amount FROM `#@__member_point` WHERE `userid` = ".$uid." AND `type` = 0");
		$totalLess = $dsql->dsqlOper($less, "results");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount,
			"totalAdd" => (int)$totalAdd[0]['amount'],
			"totalLess" => (int)$totalLess[0]['amount']
		);

		$atpage = $pageSize*($page-1);
		$results = $dsql->dsqlOper($archives.$where." ORDER BY `date` DESC LIMIT $atpage, $pageSize", "results");

		if($results){
			foreach($results as $key => $val){
				$flag = explode(",", $val['flag']);
				$list[$key]['date'] = date("Y-m-d H:i:s", $val['date']);
				$list[$key]['type']   = $val['type'];
				$list[$key]['amount'] = $val['amount'];
				$list[$key]['info'] = $val['info'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 登录记录
     * @return array
     */
	public function loginrecord(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$page = $pageSize = 0;

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$uid = $userLogin->getMemberID();

		if(!is_numeric($uid)) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member_login` WHERE `userid` = ".$uid." ORDER BY `logintime` DESC");

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['time'] = date("Y-m-d H:i:s", $val['logintime']);
				$list[$key]['ip']   = $val['loginip'];
				$list[$key]['addr'] = $val['ipaddr'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 自定义封面图片列表
     * @return array
     */
	public function customCoverBg(){
		global $dsql;
		global $userLogin;
		$pageinfo = $typeList = $list = array();
		$loadtype = $typeid = $page = $pageSize = 0;

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$loadtype = $this->param['loadtype'];
				$typeid   = $this->param['typeid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = "";
		if(!empty($typeid)){
			if($typeid == "rec"){
				$where = " AND `rec` = 1";
			}else{
				$where = " AND `typeid` = $typeid";
			}
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member_coverbg` WHERE 1 = 1".$where." ORDER BY `id` DESC");

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");


		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']     = $val['id'];
				$list[$key]['title']  = $val['title'];
				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['big']    = getFilePath($val['big']);
			}
		}

		if($loadtype){
			$typeList = $dsql->getTypeList(0, "member_coverbg_type");
		}

		return array("pageInfo" => $pageinfo, "typeList" => $typeList, "list" => $list);

	}


	//更新自定义封面图片
	public function updateCoverBg(){
		global $dsql;
		global $userLogin;
		$return = array();
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$id = $this->param['id'];
		if(empty($id)) return array("state" => 200, "info" => '请选择要设置的图片！');

		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `tempbg` = '$id' WHERE `id` = '$uid'");
		$dsql->dsqlOper($archives, "update");
		return "ok";

	}


	/**
     * 收货地址
     * @return array
     */
	public function address(){
		global $dsql;
		global $userLogin;
		$list = array();

		$uid = $userLogin->getMemberID();
		if($uid == -1) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member_address` WHERE `uid` = ".$uid." ORDER BY `id` DESC");

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		$pageinfo = array("totalCount" => $totalCount);

		$results = $dsql->dsqlOper($archives.$where, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']      = $val['id'];
				$list[$key]['addrid']  = $val['addrid'];
				$list[$key]['addrids'] = "";

				if($val['addrid'] == 0){
					$list[$key]['addrid']  = "未知";
				}else{
					$addrName = getParentArr("site_area", $val['addrid']);
					global $data;
					$data = "";
					$addrNameArr = array_reverse(parent_foreach($addrName, "typename"));
					$list[$key]['addrname']  = join(" ", $addrNameArr);

					global $data;
					$data = "";
					$addrIdArr = array_reverse(parent_foreach($addrName, "id"));
					$list[$key]['addrids']  = join(" ", $addrIdArr);
				}

				$list[$key]['address'] = $val['address'];
				$list[$key]['person']  = $val['person'];
				$list[$key]['mobile']  = $val['mobile'];
				$list[$key]['tel']     = $val['tel'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}



	/**
     * 添加收货地址
     * @return array
     */
	public function addressAdd(){
		global $dsql;
		global $userLogin;

		$uid = $userLogin->getMemberID();
		if($uid == -1) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		$id      = $this->param['id'];
		$addrid  = $this->param['addrid'];
		$address = $this->param['address'];
		$person  = $this->param['person'];
		$mobile  = $this->param['mobile'];
		$tel     = $this->param['tel'];

		if(empty($addrid)) return array("state" => 200, "info" => '请选择所在区域！');
		if(empty($address)) return array("state" => 200, "info" => '请输入详细地址！');
		if(empty($person)) return array("state" => 200, "info" => '请输入收货人姓名！');
		if(empty($mobile) && empty($tel)) return array("state" => 200, "info" => '手机号码和固定电话至少输入一项');

		$address = cn_substrR($address, 100);
		$person  = cn_substrR($person, 25);
		$mobile  = !empty($mobile) ? cn_substrR($mobile, 11) : "";
		$tel     = !empty($tel) ? cn_substrR($tel, 100) : "";

		if(empty($id)){
			$archives = $dsql->SetQuery("INSERT INTO `#@__member_address` (`uid`, `addrid`, `address`, `person`, `mobile`, `tel`) VALUES ('$uid', '$addrid', '$address', '$person', '$mobile', '$tel')");
			$return = $dsql->dsqlOper($archives, "lastid");
			if(is_numeric($return)){
				return $return;
			}else{
				return array("state" => 200, "info" => '操作失败，请重试！');
			}
		}else{
			$archives = $dsql->SetQuery("UPDATE `#@__member_address` SET `addrid` = '$addrid', `address` = '$address', `person` = '$person', `mobile` = '$mobile', `tel` = '$tel' WHERE `uid` = '$uid' AND `id` = ".$id);
			$return = $dsql->dsqlOper($archives, "update");
			if($return == "ok"){
				return '操作成功！';
			}else{
				return array("state" => 200, "info" => '操作失败，请重试！');
			}
		}

	}


	//删除收货地址
	public function addressDel(){
		global $dsql;
		global $userLogin;
		$return = array();
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$id = $this->param['id'];
		if(empty($id)) return array("state" => 200, "info" => '请选择要删除的信息！');

		$archives = $dsql->SetQuery("DELETE FROM `#@__member_address` WHERE `uid` = '$uid' AND `id` = '$id'");
		$return = $dsql->dsqlOper($archives, "update");
		if($return == "ok"){
			return "ok";
		}else{
			array("state" => 200, "info" => '删除失败，请重试！');
		}

	}


	//解绑社交帐号
	public function unbindConnect(){
		global $dsql;
		global $userLogin;
		$return = array();
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$id = $this->param['id'];
		if(empty($id)) return array("state" => 200, "info" => '请选择要解绑的社交帐号！');

		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `".$id."_conn` = '' WHERE `id` = '$uid'");
		$return = $dsql->dsqlOper($archives, "update");
		if($return == "ok"){
			return "ok";
		}else{
			array("state" => 200, "info" => '操作失败，请重试！');
		}

	}



	/**
     * 添加、删除、判断收藏信息
     * @return array
     */
	public function collect(){
		global $dsql;
		global $userLogin;

		$module = $this->param['module'];
		$temp   = $this->param['temp'];
		$id     = $this->param['id'];
		$type   = $this->param['type'];
		$check  = $this->param['check'];

		$userid = $userLogin->getMemberID();

		if(!empty($module) && !empty($temp) && !empty($id) && $userid > -1){

			//多个ID
			if(strstr($id, ",")){
				$id = explode(",", $id);

				foreach ($id as $k => $v) {

					//新增收藏，先验证是否已经收藏过
					if($type == "add"){
						$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_collect` WHERE `module` = '$module' AND `action` = '$temp' AND `aid` = '$v' AND `userid` = '$userid'");
						$return = $dsql->dsqlOper($archives, "totalCount");

						if($return == 0){
							$archives = $dsql->SetQuery("INSERT INTO `#@__member_collect` (`module`, `action`, `aid`, `userid`, `pubdate`) VALUES ('$module', '$temp', '$v', '$userid', ".GetMkTime(time()).")");
							$dsql->dsqlOper($archives, "update");
						}

					//删除收藏
					}elseif($type == "del"){
						$archives = $dsql->SetQuery("DELETE FROM `#@__member_collect` WHERE `module` = '$module' AND `action` = '$temp' AND `aid` = '$v' AND `userid` = '$userid'");
						$dsql->dsqlOper($archives, "update");
					}

				}
				return "ok";

			}else{
				//新增收藏，先验证是否已经收藏过
				if($type == "add"){
					$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member_collect` WHERE `module` = '$module' AND `action` = '$temp' AND `aid` = '$id' AND `userid` = '$userid'");
					$return = $dsql->dsqlOper($archives, "totalCount");

					if($return == 0){
						if($check == 1){
							return "no";
						}
						$archives = $dsql->SetQuery("INSERT INTO `#@__member_collect` (`module`, `action`, `aid`, `userid`, `pubdate`) VALUES ('$module', '$temp', '$id', '$userid', ".GetMkTime(time()).")");
						$dsql->dsqlOper($archives, "update");
					}else{
						return "has";
					}
					return "ok";

				//删除收藏
				}elseif($type == "del"){
					$archives = $dsql->SetQuery("DELETE FROM `#@__member_collect` WHERE `module` = '$module' AND `action` = '$temp' AND `aid` = '$id' AND `userid` = '$userid'");
					$dsql->dsqlOper($archives, "update");
					return "ok";
				}
			}
		}

	}


	//收藏列表
	public function collectList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$module = $temp = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$module   = $this->param['module'];
				$temp     = $this->param['temp'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$uid = $userLogin->getMemberID();
		if(!is_numeric($uid)) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		if(!empty($module)){
			$where .= " AND `module` = '$module'";
		}

		if(!empty($temp)){
			$where .= " AND `action` = '$temp'";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `aid`, `module`, `action`, `pubdate` FROM `#@__member_collect` WHERE `userid` = ".$uid.$where);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$results = $dsql->dsqlOper($archives." ORDER BY `id` DESC LIMIT $atpage, $pageSize", "results");

		if($results){

			global $handler;
			$handler = true;

			foreach($results as $key => $val){

				$module = $val['module'];
				$action = $val['action'];

				$list[$key]['id'] = $val['id'];
				$list[$key]['aid'] = $val['aid'];
				$list[$key]['pubdate'] = date("Y-m-d H:i:s", $val['pubdate']);

				//主要用于获取信息URL，具体值以模板名称、模块的class文件、URL规则为主
				$act = $action;
				$act = $act == "loupan_detail" ? "loupan-detail" : $act;
				$act = $act == "sale_detail" ? "sale-detail" : $act;
				$act = $act == "zu_detail" ? "zu-detail" : $act;
				$act = $act == "xzl_detail" ? "xzl-detail" : $act;
				$act = $act == "sp_detail" ? "sp-detail" : $act;
				$act = $act == "cf_detail" ? "cf-detail" : $act;
				$act = $module == "waimai" ? "buy" : $act;

				$param = array(
					"service"     => $module,
					"template"    => $act,
					"id"          => $val['aid']
				);

				//主要用于读取信息详细信息，具体值以模块的class文件为主
				$act = $action;
				$act = $act == "loupan_detail" ? "loupanDetail" : $act;
				$act = $act == "sale_detail" ? "saleDetail" : $act;
				$act = $act == "zu_detail" ? "zuDetail" : $act;
				$act = $act == "xzl_detail" ? "xzlDetail" : $act;
				$act = $act == "sp_detail" ? "spDetail" : $act;
				$act = $act == "cf_detail" ? "cfDetail" : $act;
				$act = $act == "store-detail" ? "storeDetail" : $act;
				$act = $act == "case-detail" ? "diaryDetail" : $act;
				$act = $act == "company-detail" ? "storeDetail" : $act;
				$act = $act == "designer-detail" ? "teamDetail" : $act;
				$act = $act == "shop" && $module == "waimai" ? "storeDetail" : $act;

				$handels = new handlers($module, $act);
				$detail  = $handels->getHandle($val['aid']);

				if(is_array($detail) && $detail['state'] == 100){
					$detail  = $detail['info'];
					if(is_array($detail)){
						$list[$key]['detail'] = $detail;

						//装修公司
						if($action == "company-detail"){
							$list[$key]['detail']['title'] = $detail['company'];
						}

						//设计师
						if($action == "designer-detail"){
							$list[$key]['detail']['title'] = $detail['name'];
						}

						//简历
						if($action == "resume"){
							$list[$key]['detail']['title'] = $detail['name'];
						}

						if(!$detail['url']){
							$list[$key]['detail']['url'] = getUrlPath($param);
						}
					}
				}else{
					$handels = new handlers($module, $action."Detail");
					$detail  = $handels->getHandle($val['aid']);

					if(is_array($detail) && $detail['state'] == 100){
						$detail  = $detail['info'];
						if(is_array($detail)){
							$list[$key]['detail'] = $detail;

							//装修公司
							if($action == "company-detail"){
								$list[$key]['detail']['title'] = $detail['company'];
							}

							//设计师
							if($action == "designer-detail"){
								$list[$key]['detail']['title'] = $detail['name'];
							}

							//简历
							if($action == "resume"){
								$list[$key]['detail']['title'] = $detail['name'];
							}

							if(!$detail['url']){
								$list[$key]['detail']['url'] = getUrlPath($param);
							}
						}
					}
				}

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	//删除收藏
	public function delCollect(){
		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$id = $this->param['id'];

		if(empty($id)) return array("state" => 200, "info" => '没有要删除的信息！');

		$archives = $dsql->SetQuery("DELETE FROM `#@__member_collect` WHERE `id` in (".$id.") AND `userid` = '$uid'");
		$dsql->dsqlOper($archives, "update");

		return "删除成功！";

	}



	/**
	 * 充值
	 * @return array
	 */
	public function deposit(){

		$param =  $this->param;
		$amount = $param['amount'];
		$paytype = $param['paytype'];

		global $userLogin;

		if($userLogin->getMemberID() == -1) die('登录超时，请重新登录！');

		if($amount <= 0){
			die('充值金额必须为整数或小数，小数点后不超过2位。');
		}
		if(empty($paytype)){
			die('请选择支付方式！');
		}

		$ordernum = create_ordernum();

		createPayForm("member", $ordernum, $amount, $paytype, "账户充值");

	}


	/**
	 * 查询订单状态
	 * 付款等待页面，隔时查询待付款的订单状态，如果已经支付成功，则返回成功后要跳转的页面
	 *
	 */
	public function tradePayResult(){
		$param = $this->param;

		if(empty($param)) return array("state" => 200, "info" => '格式错误！');

		$order = $param['order'];

		//如果type == 1，则$order为商品订单号，否则$order为支付订单号
		//如果type == 2，则代表会员充值页面，不需要指定订单号，只需要查询最后一笔ordertype为member的订单状态即可
		$checktype = $param['type'];

		if(empty($order) && $checktype != 2) return array("state" => 200, "info" => '格式错误！');

		global $dsql;

		if($checktype == 1){
			$archives = $dsql->SetQuery("SELECT `ordertype`, `body`, `state` FROM `#@__pay_log` WHERE `body` = '$order'");
		}elseif($checktype == 2){
			$archives = $dsql->SetQuery("SELECT `ordertype`, `body`, `state` FROM `#@__pay_log` WHERE `ordertype` = 'member' ORDER BY `id` DESC LIMIT 0, 1");
		}else{
			$archives = $dsql->SetQuery("SELECT `ordertype`, `body`, `state` FROM `#@__pay_log` WHERE `ordernum` = '$order'");
		}
		$results = $dsql->dsqlOper($archives, "results");
		if($results){

			$ordertype = $results[0]['ordertype'];
			$body      = $results[0]['body'];
			$state     = $results[0]['state'];

			if($state == 1){

				$date = array();
				$orderArr = explode(",", $body);

				//如果是多个订单，则跳转到订单列表
				if(count($orderArr) > 1){
					$data = array(
						"service"  => "member",
						"type"     => "user",
						"template" => "order",
						"module"   => $ordertype
					);
				}else{

					//如果是会员充值，则跳转到消费记录页面
					if($ordertype == "member"){

						$data = array(
							"service"  => "member",
							"type"     => "user",
							"template" => "record"
						);

					//如果是打赏，则跳转到打赏结果页面
					//如果是信息竞价，则跳转到支付结果页面
					}elseif($ordertype == "article" || $ordertype == "info" || $ordertype == "house"){

						$data = array(
							"service"  => $ordertype,
							"template" => "payreturn",
							"ordernum" => $order
						);


					//外卖频道支付成功页面单独配置
					}elseif($ordertype == "waimai"){

						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__".$ordertype."_order` WHERE `ordernum` = '$body'");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$data = array(
								"service"  => $ordertype,
								"template" => "orderdetail",
								"id"       => $ret[0]['id']
							);
						}else{
							return array("state" => 200, "info" => '订单不存在！');
						}

					//单个订单跳转到订单详细页
					}else{

						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__".$ordertype."_order` WHERE `ordernum` = '$body'");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){

							$data = array(
								"service"  => "member",
								"type"     => "user",
								"template" => "orderdetail",
								"module"   => $ordertype,
								"id"       => $ret[0]['id']
							);

						}else{
							return array("state" => 200, "info" => '订单不存在！');
						}

					}

				}

				$url = getUrlPath($data);
				return $url;

			}else{
				 return array("state" => 200, "info" => '交易没有支付成功');
			}

		}else{
			 return array("state" => 200, "info" => '订单不存在！');
		}


	}


	/**
	 * 支付成功
	 * 此处进行支付成功后的操作，例如发送短信等服务
	 *
	 */
	public function paySuccess(){
		$param = $this->param;

		// print_r($param);die;
		if(!empty($param)){
			global $dsql;

			$paytype  = $param['paytype'];
			$ordernum = $param['ordernum'];

			$archives = $dsql->SetQuery("SELECT `amount`, `uid` FROM `#@__pay_log` WHERE `body` = '$ordernum'");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){

				$amount = $results[0]['amount'];
				$uid    = $results[0]['uid'];
				$date   = GetMkTime(time());

				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$amount' WHERE `id` = '$uid'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '1', '$amount', '账户充值;$paytype', '$date')");
				$dsql->dsqlOper($archives, "update");

			}

		}

	}


	/**
	 * 提现卡号记录
	 * @return array
	 */
	public function withdraw_card(){

		$param =  $this->param;
		$type  = $param['type'];

		global $dsql;
		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$where = " AND `bank` != 'alipay'";
		if($type == "alipay"){
			$where = " AND `bank` = 'alipay'";
		}

		$sql = $dsql->SetQuery("SELECT `id`, `bank`, `cardnum`, `cardname` FROM `#@__member_withdraw_card` WHERE `uid` = '$userid'".$where." ORDER BY `id` DESC");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret) return $ret;

	}


	/**
	 * 删除提现卡号记录
	 * @return array
	 */
	public function withdraw_card_del(){

		$param =  $this->param;
		$id  = $param['id'];
		if(empty($id)) return array("state" => 200, "info" => '请选择要删除的历史记录');

		global $dsql;
		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$sql = $dsql->SetQuery("DELETE FROM `#@__member_withdraw_card` WHERE `uid` = '$userid' AND `id` = $id");
		$dsql->dsqlOper($sql, "update");

	}




	/**
	 * 提现
	 * @return array
	 */
	public function withdraw(){

		$param    =  $this->param;
		$bank     = $param['bank'];
		$cardnum  = $param['cardnum'];
		$cardname = $param['cardname'];
		$amount   = $param['amount'];
		$date     = GetMkTime(time());

		global $dsql;
		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$this->param['id'] = $userid;
		$detail = $this->detail();
		if($detail['money'] < $amount) return array("state" => 200, "info" => '帐户余额不足，提现失败！');

		//判断银行卡是否存在
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__member_withdraw_card` WHERE `uid` = '$userid' AND `bank` = '$bank' AND `cardnum` = '$cardnum' AND `cardname` = '$cardname'");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$cid = $ret[0]['id'];
		}else{
			//添加银行卡
			$sql = $dsql->SetQuery("INSERT INTO `#@__member_withdraw_card` (`uid`, `bank`, `cardnum`, `cardname`, `date`) VALUES ('$userid', '$bank', '$cardnum', '$cardname', '$date')");
			$cid = $dsql->dsqlOper($sql, "lastid");
		}

		if(is_numeric($cid)){

			//生成提现记录
			$sql = $dsql->SetQuery("INSERT INTO `#@__member_withdraw` (`uid`, `bank`, `cardnum`, `cardname`, `amount`, `tdate`, `state`) VALUES ('$userid', '$bank', '$cardnum', '$cardname', '$amount', '$date', 0)");
			$wid = $dsql->dsqlOper($sql, "lastid");

			if(is_numeric($wid)){

				//减去余额、冻结金额
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - '$amount', `freeze` = `freeze` + '$amount' WHERE `id` = '$userid'");
				$dsql->dsqlOper($archives, "update");

				return $wid;
			}else{
				return array("state" => 200, "info" => '提交失败！错误代码：201');
			}

		}else{
			return array("state" => 200, "info" => '提交失败！错误代码：200');
		}

	}


	/**
	 * 提现记录
	 * @return array
	 */
	public function withdraw_log(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$state = $page = $pageSize = 0;

		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$state     = $this->param['state'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = "";
		if($state != ""){
			$where = " AND `state` = $state";
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member_withdraw` WHERE `uid` = $userid".$where." ORDER BY `id` DESC");

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");

		$param = array(
			"service"  => "member",
			"type"     => "user",
			"template" => "withdraw_log_detail",
			"id"       => "%id"
		);
		$url = getUrlPath($param);

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']       = $val['id'];
				$list[$key]['bank']     = $val['bank'];
				$list[$key]['cardnum']  = $val['cardnum'];
				$list[$key]['cardname'] = $val['cardname'];
				$list[$key]['amount']   = $val['amount'];
				$list[$key]['tdate']    = $val['tdate'];
				$list[$key]['state']    = $val['state'];
				$list[$key]['url']      = str_replace("%id", $val['id'], $url);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);

	}


	/**
	 * 现金与积分兑换
	 * @return array
	 */
	public function convert(){
		global $dsql;
		global $userLogin;
		$param =  $this->param;
		$amount = $param['amount'];
		$paypwd = $param['paypwd'];

		$date = GetMkTime(time());

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		if($amount <= 0){
			die('兑换金额必须为整数或小数，小数点后不超过2位。');
		}

		$this->param['id'] = $userid;
		$detail = $this->detail();
		if($detail['money'] < $amount) return array("state" => 200, "info" => '帐户余额不足，兑换失败！');

		if(empty($paypwd)){
			die('请输入支付密码！');
		}

		//验证支付密码
		$archives = $dsql->SetQuery("SELECT `id`, `paypwd` FROM `#@__member` WHERE `id` = '$userid'");
		$results  = $dsql->dsqlOper($archives, "results");
		$res = $results[0];
		$hash = $userLogin->_getSaltedHash($paypwd, $res['paypwd']);
		if($res['paypwd'] != $hash) return array("state" => 200, "info" => "支付密码输入错误，请重试！");


		global $cfg_pointRatio;
		$totalConvert = $amount * $cfg_pointRatio;

		//扣除金额
		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - '$amount' WHERE `id` = '$userid'");
		$dsql->dsqlOper($archives, "update");

		//保存操作日志
		$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$amount', '现金兑换福券：$amount', '$date')");
		$dsql->dsqlOper($archives, "update");


		//增加积分
		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `point` = `point` + '$totalConvert' WHERE `id` = '$userid'");
		$dsql->dsqlOper($archives, "update");

		//保存操作日志
		$archives = $dsql->SetQuery("INSERT INTO `#@__member_point` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '1', '$totalConvert', '现金兑换：$amount', '$date')");
		$dsql->dsqlOper($archives, "update");

		return "兑换成功！";

	}


	/**
	 * 积分转赠
	 * @return array
	 */
	public function transfer(){
		global $dsql;
		global $userLogin;
		global $cfg_pointFee;

		$param =  $this->param;
		$user   = $param['user'];
		$amount = $param['amount'];
		$paypwd = $param['paypwd'];

		$date = GetMkTime(time());

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		//验证会员
		$toUser = 0;
		$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` = '$user'");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$toUser = $results[0]['id'];
		}else{
			return array("state" => 200, "info" => '对方会员不存在，请确认后重试！');
		}

		if($userid == $toUser) return array("state" => 200, "info" => '不可以转赠给自己！');

		if($amount <= 0) return array("state" => 200, "info" => '转赠数量必须为整数或小数，小数点后不超过2位。');

		$this->param['id'] = $userid;
		$detail = $this->detail();
		$username = $detail['username'];
		if($detail['point'] < $amount) return array("state" => 200, "info" => '帐户福券不足，转赠失败！');

		if(empty($paypwd)) return array("state" => 200, "info" => '请输入支付密码！');

		//验证支付密码
		$archives = $dsql->SetQuery("SELECT `id`, `paypwd` FROM `#@__member` WHERE `id` = '$userid'");
		$results  = $dsql->dsqlOper($archives, "results");
		$res = $results[0];
		$hash = $userLogin->_getSaltedHash($paypwd, $res['paypwd']);
		if($res['paypwd'] != $hash) return array("state" => 200, "info" => "支付密码输入错误，请重试！");


		global $cfg_pointRatio;
		$totalTransfer = $amount - $amount * $cfg_pointFee / 100;

		//减少积分
		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `point` = `point` - '$amount' WHERE `id` = '$userid'");
		$dsql->dsqlOper($archives, "update");

		//保存操作日志
		$archives = $dsql->SetQuery("INSERT INTO `#@__member_point` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$amount', '转出给会员：$user => $amount', '$date')");
		$dsql->dsqlOper($archives, "update");

		//增加积分
		$archives = $dsql->SetQuery("UPDATE `#@__member` SET `point` = `point` + '$totalTransfer' WHERE `id` = '$toUser'");
		$dsql->dsqlOper($archives, "update");

		//保存操作日志
		$archives = $dsql->SetQuery("INSERT INTO `#@__member_point` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$toUser', '1', '$totalTransfer', '$username 转赠 => $totalTransfer', '$date')");
		$dsql->dsqlOper($archives, "update");

		return "转赠成功！";

	}


	/**
	 * 交友会员注册
	 * @return array
	 */
	public function regDating(){
		global $dsql;
		global $userLogin;
		global $cfg_regstatus;
		global $cfg_regclosemessage;
		if($cfg_regstatus == 0){
			die('200|'.$cfg_regclosemessage);
		}

		$type   = (int)$this->param['type'];
		$mobile = $this->param['mobile'];
		$email = $this->param['email'];
		$password = $this->param['password'];
		$sex   = (int)$this->param['sex'];
		$year  = (int)$this->param['year'];
		$month = (int)$this->param['month'];
		$day   = (int)$this->param['day'];
		$addr  = (int)$this->param['addr'];

		$username = "";

		if($type == 1){
			//手机
			if(empty($mobile)){
				die('205|请输入手机号码！');
			}
			preg_match('/0?(13|14|15|17|18)[0-9]{9}/', $mobile, $matchPhone);
			if(!$matchPhone){
				die('205|手机号码格式错误！');
			}

			$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `phone` = '$mobile'");
			$return = $dsql->dsqlOper($archives, "results");
			if($return){
				die('205|此手机号码已被注册！');
			}

			$username = $mobile;

		}elseif($type == 2){

			//邮箱
			if(empty($email)){
				die('204|请输入邮箱地址！');
			}
			preg_match('/\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/', $email, $matchEmail);
			if(!$matchEmail){
				die('204|邮箱地址格式错误！');
			}

			$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `email` = '$email'");
			$return = $dsql->dsqlOper($archives, "results");
			if($return){
				die('204|此邮箱地址已被注册！');
			}

			$username = $email;

		}else{
			die('204|请选择注册方式！');
		}

		//验证密码
		if(empty($password)){
			die('202|请输入密码！');
		}
		preg_match('/^.{5,}$/', $password, $matchPassword);
		if(!$matchPassword){
			die('202|密码长度最少为5位！');
		}

		//验证区域
		if(empty($addr)){
			die('202|请选择所在区域！');
		}

		$birthday = GetMkTime($year."-".$month."-".$day);

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
		$archives = $dsql->SetQuery("INSERT INTO `#@__member` (`mtype`, `username`, `password`, `nickname`, `email`, `emailCheck`, `phone`, `phoneCheck`, `regtime`, `regip`, `regipaddr`, `state`) VALUES ('1', '$username', '$passwd', '$username', '$email', '0', '$mobile', '0', '$regtime', '$regip', '$regipaddr', '1')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if($aid){

			//论坛同步
			if($type == 2){
				$data['username'] = $username;
				$data['password'] = $password;
				$data['email']    = $email;
				$userLogin->bbsSync($data, "register");
			}

			//自动登录
			$ureg = $userLogin->memberLogin($username, $password);

			//注册交友会员
			$sql = $dsql->SetQuery("INSERT INTO `#@__dating_member` (`userid`, `addrid`, `jointime`) VALUES ('$aid', '$addr', '$regtime')");
			$ret = $dsql->dsqlOper($sql, "update");

			die('100|注册成功！');

		}else{
			die('200|注册失败，请稍候重试！');
		}
		return;

	}



}
