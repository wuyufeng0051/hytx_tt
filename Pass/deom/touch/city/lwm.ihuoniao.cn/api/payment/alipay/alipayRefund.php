<?php
/**
 * 支付宝退款主文件
 *
 * @version        $Id: alipay.php $v1.0 2014-3-12 下午17:19:21 $
 * @package        HuoNiao.Payment
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

if(!defined('HUONIAOINC')) exit('Request Error!');



/* 基本信息 */
if(isset($set_modules) && $set_modules == TRUE){

    $i = isset($payment) ? count($payment) : 0;

    /* 代码 */
    $payment[$i]['pay_code'] = "alipay";

	/* 名称 */
    $payment[$i]['pay_name'] = "支付宝退款";

    /* 版本号 */
    $payment[$i]['version']  = '1.0.0';

    /* 描述 */
    $payment[$i]['pay_desc'] = '国内先进的网上支付平台。三种支付接口：担保交易，即时到账，双接口。在线即可开通，零预付，免年费，单笔阶梯费率，无流量限制。';

    /* 作者 */
    $payment[$i]['author']   = '火鸟软件';

    /* 网址 */
    $payment[$i]['website']  = 'http://www.huoniao.co';

    /* 配置信息 */
    $payment[$i]['config'] = array(
        'title' => '网页支付',
		'title' => '支付宝帐户'
    );

    return;
}

/**
 * 类
 */
class alipayRefund {

	/**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */

    public $appId;

    public $rsaPrivateKey;

    public $alipayrsaPublicKey;

    function __construct(){
        $this->alipayRefund();
    }

    function alipayRefund(){
        /*global $dsql;

        $archive = $dsql->SetQuery("SELECT `pay_config` FROM `#@__site_payment` WHERE `pay_code` = 'alipay'");
        $results = $dsql->dsqlOper($archive, "results");

        $payConfig = unserialize($results[0]['pay_config']);

        foreach ($payConfig as $key => $value) {
            if($value['name'] == 'partner'){
                $this->appId = $value['value'];
            }
        }*/

        $this->appId = "2016070401580631";

        $this->rsaPrivateKey = "MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDJo14GkAJC+spt9t5zZaFGfHjk1+1nKEN2SNWulfcsV/PQ0Fu3yBnjkX1Kv8WwB5p0thNXgi64rSrySVm7o3olGo/aZTVfU9AGbyKf+K2phY1fwg3E1bD37rQK7kntr1rFYNKTIkaa9IjBV3w2dKWt/JZ6koYyWhwHUtnAej//6nzMxime/XJod+2m0I8rIaE0JHlpHjIP6FLybwMUvB4vL8/zerHh8WDDAmfQZ/uM73yoCH53zBWv/GzHB9pF4UQyGs1M54q6EirhE+4lRE+S6RlJaMHVANkzb3JtmADvRNyzxyYgKnXKDT+EKDgURhH9RN6SL/iHaXdW+1X3wlUTAgMBAAECggEBALDI1eAlFIaLAT4mKmS8XwjAivIAyrkd2P/03bvi6cHsHu0eMLvR6bjWzyXhOz6Ze/cFx7F6huINmVCxtMXJj4bGYgdVotTAU+vANnhQ/FlbqVaieZXw0OafVyUaRKDqlEfnGtg7PfIPoXL59AJ+hOAlS/2NR7EPxfE514Zk6IXDDUslHSLoS+SrDopLn/jrvouVGFzUrngC4HgPX/sw2/HEv3UM7tWqnmDuVe9HLay0IZiyYoiQ90h+f/HHCkDgd5FqgvIGewAzJjKXXKN3fDwsoh4v6Z+DbsT8EEk0gRt5c17YeoVQLv42ppdNDJBIdOWUW/yT20Qw00aXz7Tq4tECgYEA+6nQAM/4yOisjCyVzYuwPpVveycLhFHLWAKUBr1bFGBVScPeVki1olUReIoUYXcq5KJ+/XvzdwVHK2890GR2yL73q4RggnrAM2hRJKaF8GwTNJsBLzuKFUNEWr79T4dnbHQrySbdOCLpL2KkjHkkEf1hXCX5wRvnVpocRKyGNpkCgYEAzRzfrSwun5zpD7c7P+uxa399bkZc/z7oLX8dC4XLrTEdAF7Tq+dR/mIxk/SCDJRD33oxEGkf8jht4zIXsfoRkt8+96av6zoDYIH9aNmy9n4ZPldvnYtbqGOMnnJAxhHaGiN5+kQ3Hl/jVifnqG2HGr6wHnHlwzBFAd6G1RuWMIsCgYAH+M0Z+XyMALLWjeMA69fdY6ZwZEA9JMooM4y02fK0poiNGaNFYHBAgClZhCY5ICk/rNYQ+Ygw0P38Jj3zB/urSEFYMY1NFM5Z0ogffRbpEsNY+0ACWwR4v/S+WyZzCnsAOH3alVyUlqaEVb+Yo4289CXNYXaT42pkl+UlV8G4oQKBgCKXxQ2izvYyc4goAgEk0hZsOQ5ZJaQSyvupXY+s8A30o4yFcbOjXsvFadEnQqu2ccAGDrJS2IV0iOvxbdehckdQCYGhBjho31rucXu2g51Y5Q8Dlhp+/2Vl7LhoUo5VQnB4HUFdMeKYj3HfZw2b81ZKZM+tq++Ae5L2Ic1dSrZDAoGBAIFOaDHhfTLSku3uEkDF97cell8yTYl/vNtbgVPoTM7kKSNAA2rdH59YfHxVBDLa0HWoMvqn6+dIghwWSFVui7hMPbVzSl84jrzX99rPcCgVpOaONNQ2+CPJvP+Y0pklr3QMA6iNfZNUudxHxdQCR3Eel+u82ej4WH8PP0heqPXn";

        $this->alipayrsaPublicKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAneeHzjxW9EpT25tvOXJO6tIT9IAPV6jPJUNcHuxFjristepwdL4K+u8OHxAJnMbOdcQzbJt6tl9jnpoJ5vlYnAlN7pxnJXKSMlQ1j5TqtqvqYKZ6X6J0KKYbQ64tJCNS/nbNqrmenNH+K9VgoTlvJjHR8k66Ga40eSK4MbP/NA07EIvj4XG7WA1HknEAPbaWi5FAqN2fNm4CPGbGnSQVw9LyAGf2KUSEKPutOBYb01/KZLTHeC4dD1/cVI8pXCU0pJsGZkB8rIE/tHg6N+sr1ucHon49bUYQ3ehuNsS9ecW5/Qp5kKm2WBpodxZItb3Urttv9LiAsHtj7d2cUSLXPwIDAQAB";
        
    }

    function refund($order){

        require_once ("aop/AopClient.php");
        require_once ("aop/request/AlipayTradeRefundRequest.php");

        $appId = $this->appId;
        $rsaPrivateKey = $this->rsaPrivateKey;
        $alipayrsaPublicKey = $this->alipayrsaPublicKey;

        // ----------订单信息
        // 交易号
        $trade_no = "";
        // 商户订单号
        $out_trade_no = $order['ordernum'];
        // 退款金额
        $refund_amount = $order['amount'];

        // 标志一次退款请求 格式为：退款日期（8位）+流水号（3～24位）。不可重复，且退款日期必须是当天日期。流水号可以接受数字或英文字符，建议使用数字，但不可接受“000”
        $out_request_no = date(YmdHis).$out_trade_no;

        $aop = new AopClient ();
        $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $aop->appId = $appId;
        $aop->rsaPrivateKey = $rsaPrivateKey;
        $aop->alipayrsaPublicKey = $alipayrsaPublicKey;
        $aop->apiVersion = '1.0';
        $aop->signType = 'RSA2';
        $aop->postCharset='UTF-8';
        $aop->format='json';
        $request = new AlipayTradeRefundRequest ();
        $request->setBizContent("{" .
        "\"out_trade_no\":\"" . $out_trade_no . "\"," .
        "\"trade_no\":\"". $trade_no . "\"," .
        "\"refund_amount\":" . $refund_amount . "," .
        "\"refund_reason\":\"正常退款\"," .
        "\"out_request_no\":\"" . $out_request_no . "\"," .
        "\"operator_id\":\"\"," .
        "\"store_id\":\"\"," .
        "\"terminal_id\":\"\"" .
        "  }");

        $result = $aop->execute ( $request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode) && $resultCode == 10000){
            return array("state" => 100, "date" => $result->$responseNode->gmt_refund_pay, "trade_no" => $out_request_no);
        } else {
            return array("state" => 200, "code" => "$resultCode");
        }


    }

}
