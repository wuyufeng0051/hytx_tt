<?php
/**
 * 微信扫码支付主文件
 *
 * @version        $Id: wxpay.php $v1.0 2015-12-10 下午23:35:11 $
 * @package        HuoNiao.Payment
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

if(!defined('HUONIAOINC')) exit('Request Error!');

/* 基本信息 */
if(isset($set_modules) && $set_modules == TRUE){

    $i = isset($payment) ? count($payment) : 0;

    /* 代码 */
    $payment[$i]['pay_code'] = "wxpay";

	/* 名称 */
    $payment[$i]['pay_name'] = "微信扫码支付";

    /* 版本号 */
    $payment[$i]['version']  = '1.0.0';

    /* 描述 */
    $payment[$i]['pay_desc'] = '用户使用微信“扫一扫”扫描二维码后，引导用户完成支付。';

    /* 作者 */
    $payment[$i]['author']   = '火鸟软件';

    /* 网址 */
    $payment[$i]['website']  = 'http://www.huoniao.co';

    /* 配置信息 */
    $payment[$i]['config'] = array(
        array('title' => '网页支付',  'type' => 'split'),
		array('title' => 'APPID',     'name' => 'APPID',      'type' => 'text'),
		array('title' => '商户号',     'name' => 'MCHID',     'type' => 'text'),
		array('title' => 'KEY',       'name' => 'KEY',        'type' => 'text'),
		array('title' => 'APPSECRET', 'name' => 'APPSECRET',  'type' => 'text'),
        array('title' => 'APP支付',    'type' => 'split'),
		array('title' => 'APPID',     'name' => 'APP_APPID',     'type' => 'text'),
		array('title' => '商户号',     'name' => 'APP_MCHID',     'type' => 'text'),
		array('title' => 'KEY',       'name' => 'APP_KEY',       'type' => 'text'),
		array('title' => 'APPSECRET', 'name' => 'APP_APPSECRET', 'type' => 'text')
    );

    return;
}

/**
 * 类
 */
class wxpay {

	/**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */

    function __construct(){
        $this->wxpay();
    }

    function wxpay(){}

    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment){

        // 加载支付方式操作函数
        loadPlug("payment");

        global $app;  //是否为客户端app支付
        global $huoniaoTag;
        global $cfg_basehost;
        global $cfg_staticPath;
		global $cfg_soft_lang;
        $cfg_basehost = 'http://'.$cfg_basehost;
        $notify_url = $cfg_basehost.'/api/payment/wxpayNotify.php';

        require_once "WxPay.Api.php";

        if($app){
            define('APPID', $payment['APP_APPID']);
            define('MCHID', $payment['APP_MCHID']);
            define('KEY', $payment['APP_KEY']);
            define('APPSECRET', $payment['APP_APPSECRET']);
        }else{
            define('APPID', $payment['APPID']);
            define('MCHID', $payment['MCHID']);
            define('KEY', $payment['KEY']);
            define('APPSECRET', $payment['APPSECRET']);
        }

        //客户端APP支付
        if($app){

            $input = new WxPayUnifiedOrder();
            $input->SetBody($order['subject']."：".$order['order_sn']);
            $input->SetAttach("huoniaoCMS");
            $input->SetOut_trade_no($order['order_sn']);
            $input->SetTotal_fee($order['order_amount'] * 100);
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag("huoniaoCMS");
            $input->SetNotify_url($cfg_basehost.'/api/payment/wxpayAppNotify.php');
            $input->SetTrade_type("APP");
            $order = WxPayApi::unifiedOrder($input);
            if($order['return_code'] == "FAIL"){
                die($order['return_msg']);
            }

            $param["appid"]     =  $order["appid"];
            $param["partnerid"]    =  $order["mch_id"];
            $param["noncestr"] =  $order["nonce_str"];
            $param["package"]   =  "Sign=WXPay";
            $param["prepayid"] =  $order["prepay_id"];
            $param["timestamp"] =  time();
            ksort($param);

            $paramStr = "";
            foreach ($param as $key => $val){
                $paramStr .= $key."=".$val."&";
            }
            $param["sign"] = strtoupper(md5($paramStr."key=".$payment['APP_KEY']));

            //对数据重新拼装
            $orderInfo = array(
                "appId" => $param['appid'],
                "partnerId" => $param['partnerid'],
                "nonceStr"  => $param['noncestr'],
                "package"   => $param['package'],
                "prepayId"  => $param['prepayid'],
                "timeStamp" => $param['timestamp'],
                "sign"      => $param['sign']
            );

            //配置页面信息
            $tpl = HUONIAOROOT."/templates/member/touch/";
            $templates = "public-app-pay.html";
            if(file_exists($tpl.$templates)){
                $huoniaoTag->template_dir = $tpl;
                $huoniaoTag->assign('cfg_basehost', $cfg_basehost);
                $huoniaoTag->assign('cfg_staticPath', $cfg_staticPath);
                $huoniaoTag->assign('appCall', "wechatPay");
                $huoniaoTag->assign('service', $order['service']);
                global $ordernum;
                $huoniaoTag->assign('ordernum', $ordernum);
                $huoniaoTag->assign('orderInfo', json_encode($orderInfo));
                $huoniaoTag->display($templates);
            }

            die;
        }




        //无线支付
        if(isMobile()){

          //根据支付订单号查询商品订单号
          global $dsql;
          $sql = $dsql->SetQuery("SELECT `body` FROM `#@__pay_log` WHERE `ordernum` = '".$order['order_sn']."'");
          $ret = $dsql->dsqlOper($sql, "results");
          if($ret){

            $RenrenCrypt = new RenrenCrypt();
            $encodeid = base64_encode($RenrenCrypt->php_encrypt($ret[0]['body']));

            if($order['service'] == "member"){
                $param = array(
                  "service"  => $order['service'],
                  "type"     => "user",
                  "template" => "record"
                );
            }else{
                $param = array(
                  "service"  => $order['service'],
                  "template" => "payreturn",
                  "ordernum" => $order['order_sn']
                );
            }
            $returnUrl = getUrlPath($param);
          }else{
            $returnUrl = $cfg_basehost;
          }

          require_once "WxPay.JsApiPay.php";

          //①、获取用户openid
          $tools = new JsApiPay();
          $openId = $tools->GetOpenid();

          //②、统一下单
          $input = new WxPayUnifiedOrder();
          $input->SetBody($order['subject']."：".$order['order_sn']);
          $input->SetAttach("huoniaoCMS");
          $input->SetOut_trade_no($order['order_sn']);
          $input->SetTotal_fee($order['order_amount'] * 100);
          $input->SetTime_start(date("YmdHis"));
          $input->SetTime_expire(date("YmdHis", time() + 600));
          $input->SetGoods_tag("huoniaoCMS");
          $input->SetNotify_url($notify_url);
          $input->SetTrade_type("JSAPI");
          $input->SetOpenid($openId);
          $order = WxPayApi::unifiedOrder($input);
          if($order['return_code'] == "FAIL"){
              die($order['return_msg']);
          }
          $jsApiParameters = $tools->GetJsApiParameters($order);

          //配置页面信息
          $tpl = HUONIAOROOT."/templates/siteConfig/";
          $templates = "wxpayTouch.html";
          if(file_exists($tpl.$templates)){
              global $huoniaoTag;
              global $cfg_staticPath;
              $huoniaoTag->template_dir = $tpl;
              $huoniaoTag->assign('cfg_basehost', $cfg_basehost);
              $huoniaoTag->assign('cfg_staticPath', $cfg_staticPath);
              $huoniaoTag->assign('ordernum', $order['order_sn']);
              $huoniaoTag->assign('returnUrl', $returnUrl);
              $huoniaoTag->assign('jsApiParameters', $jsApiParameters);
              $huoniaoTag->display($templates);
          }


        //PC端支付
        }else{


            //=======【curl代理设置】===================================
            /**
             * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
             * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
             * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
             * @var unknown_type
             */
            define('CURL_PROXY_HOST', "0.0.0.0");
            define('CURL_PROXY_PORT', 0);

            //=======【上报信息配置】===================================
            /**
             * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
             * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
             * 开启错误上报。
             * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
             * @var int
             */
            define('REPORT_LEVENL', 1);

            require_once "WxPay.NativePay.php";


            //组合付款参数，并生成付款URL
            $notify = new NativePay();
            $input = new WxPayUnifiedOrder();
            $input->SetBody($order['subject']."：".$order['order_sn']);
            $input->SetOut_trade_no($order['order_sn']);
            $input->SetTotal_fee($order['order_amount'] * 100);
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));

            $input->SetNotify_url($notify_url);
            $input->SetTrade_type("NATIVE");
            $input->SetProduct_id($order['subject']);
            $result = $notify->GetPayUrl($input);
            if($result['return_code'] == "FAIL"){
                die($result['return_msg']);
            }
            $url = $result["code_url"];


            //配置页面信息
            $tpl = HUONIAOROOT."/templates/siteConfig/";
            $templates = "wxpay.html";
            if(file_exists($tpl.$templates)){
                global $huoniaoTag;
                global $cfg_staticPath;
                $huoniaoTag->template_dir = $tpl;
                $huoniaoTag->assign('cfg_staticPath', $cfg_staticPath);
                $huoniaoTag->assign('url', $url);
                $huoniaoTag->assign('order', $order);
                $huoniaoTag->display($templates);
            }else{
                echo '<img src="/include/qrcode.php?data='.urlencode($url).'" style="width:150px;height:150px;"/>';
            }

        }


    }


}
