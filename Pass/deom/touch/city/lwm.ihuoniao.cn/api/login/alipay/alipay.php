<?php
/**
 * 支付宝快捷登录
 *
 * @version        $Id: alipay.php $v1.0 2015-2-14 下午14:24:15 $
 * @package        HuoNiao.Login
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

if(!defined('HUONIAOINC')) exit('Request Error!');

$logincode = basename(__FILE__, '.php');

/* 基本信息 */
if(isset($set_modules) && $set_modules == TRUE){
	
    $i = isset($login) ? count($login) : 0;

    /* 代码 */
    $login[$i]['code'] = $logincode;
	
	/* 名称 */
    $login[$i]['name'] = "支付宝快捷登录";

    /* 回调地址 */
    $login[$i]['callback'] = "http://".$cfg_basehost."/api/login.php?action=back&type=alipay";
	
    /* 版本号 */
    $login[$i]['version']  = '1.0.0';

    /* 描述 */
    $login[$i]['desc'] = '让6亿支付宝会员直接用支付宝账号登录您的网站，简单快捷的购物操作将帮助您获得更多订单！';

    /* 作者 */
    $login[$i]['author']   = '火鸟软件';

    /* 网址 */
    $login[$i]['website']  = 'http://www.huoniao.co';

    /* 配置信息 */
    $login[$i]['config'] = array(
		array('title' => 'partner',  'name' => 'partner',  'type' => 'text'),
		array('title' => 'key',      'name' => 'key',      'type' => 'text')
    );

    return;
}

/**
 * 类
 */
class Loginalipay {
	
	/**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */

    function __construct(){
        $this->Loginalipay();
    }
	
    function Loginalipay(){}

    /**
     * 跳转到登录地址
     * @param   array   $data  配置信息
     */
    function login($data){

        $alipay_config['partner']       = $data['partner'];
        $alipay_config['key']           = $data['key'];

        $alipay_config['sign_type']     = strtoupper('MD5');
        $alipay_config['input_charset'] = strtolower('utf-8');
        $alipay_config['cacert']        = dirname(__FILE__).'\cacert.pem';
        $alipay_config['transport']     = 'http';

        require_once("lib/alipay_submit.class.php");

        $target_service    = "user.auth.quick.login";
        $return_url        = $data['callback'];
        $anti_phishing_key = "";
        $exter_invoke_ip   = "";

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service"           => "alipay.auth.authorize",
            "partner"           => trim($alipay_config['partner']),
            "target_service"    => $target_service,
            "return_url"        => $return_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip"   => $exter_invoke_ip,
            "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "正在跳转到支付宝授权中心，请稍候...");
        echo $html_text;
    }
	
	/**
	 * 登录成功返回
     * @param array $data 配置信息
     * @param array $return 返回信息
	 */
	function back($data, $return){

        $alipay_config['partner']       = $data['partner'];
        $alipay_config['key']           = $data['key'];

        $alipay_config['sign_type']     = strtoupper('MD5');
        $alipay_config['input_charset'] = strtolower('utf-8');
        $alipay_config['cacert']        = dirname(__FILE__).'\cacert.pem';
        $alipay_config['transport']     = 'http';

        require_once("lib/alipay_notify.class.php");

        global $logincode;

        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);

        unset($return['action']);
        unset($return['type']);
        unset($return['PHPSESSID']);
        $verify_result = $alipayNotify->verifyReturn($return);
        
        if($verify_result) {//验证成功

            //登录验证
            $userLogin = new userLogin($dbo);

            $data = array(
                "code"     => $logincode,
                "key"      => $return['user_id'],
                "nickname" => $return['real_name'],
                "photo"    => "",
                "gender"   => "男"
            );

            $userLogin->loginConnect($data);

        }else{
            die("接口连接错误！");
        }
        
    }
	
}