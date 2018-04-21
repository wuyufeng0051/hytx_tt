<?php  if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 支付方式处理函数
 *
 * @version        $Id: payment.class.php 2014-3-11 下午15:39:24 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

/**
 * 页面跳转同步通知页面路径
 * @param   string  $code   支付方式代码
 */
function return_url($code, $param = ""){
	global $cfg_basehost;
    return 'http://'.$cfg_basehost . '/api/payment/return.php?code='.$code.$param;
}

/**
 * 服务器异步通知页面路径
 * @param   string  $code   支付方式代码
 */
function notify_url($code, $param = ""){
	global $cfg_basehost;
    return 'http://'.$cfg_basehost . '/api/payment/notify.php?code='.$code.$param;
}

/**
 *  取得某支付方式信息
 *  @param  string  $code   支付方式代码
 */
function get_payment($code){
	$dsql = new dsql($dbo);
	$archives = $dsql->SetQuery("SELECT * FROM `#@__site_payment` WHERE `pay_code` = '$code'");
	$results = $dsql->dsqlOper($archives, "results");
    // print_r($results);die;
    if ($results){
        $config_list = unserialize($results[0]['pay_config']);
        foreach ($config_list AS $config){
            $results[$config['name']] = $config['value'];
        }
    }

    return $results;
}

/**
 * 检查支付的金额是否与订单相符
 *
 * @access  public
 * @param   string   $log_id      支付编号
 * @param   float    $money       支付接口返回的金额
 * @return  true
 */
function check_money($log_id, $money){
    //根据订单号查询数据库
    $dsql = new dsql($dbo);
    $archives = $dsql->SetQuery("SELECT `amount` FROM `#@__pay_log` WHERE `ordernum` = '$log_id' AND `state` = 0");
    $results = $dsql->dsqlOper($archives, "results");
    if($money == $results[0]['amount']){
        return true;
    }else{
        return false;
    }
}

/**
 * 修改订单的支付状态
 *
 * @access  public
 * @param   string  $log_id     支付编号
 * @param   integer $pay_status 状态
 * @param   string  $note       备注
 * @return  void
 */
function order_paid($log_id){
    /* 取得支付编号 */
    if (!empty($log_id)){
        /* 取得订单类型 */
        $dsql = new dsql($dbo);
		$archives = $dsql->SetQuery("SELECT * FROM `#@__pay_log` WHERE `ordernum` = '$log_id' AND `state` = 0");
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$ordertype = $results[0]['ordertype'];
            $body      = $results[0]['body'];
            $paytype   = $results[0]['paytype'];
			if(!empty($ordertype) && !empty($body)){

                $data['ordernum'] = $body;
                $data['paytype']  = $paytype;

                //更新支付状态
                $archives = $dsql->SetQuery("UPDATE `#@__pay_log` SET `state` = 1 WHERE `ordernum` = '$log_id' AND `state` = 0");
                $dsql->dsqlOper($archives, "update");
                
				//更新订单状态
                global $handler;
                $handler = true;
                $handels = new handlers($ordertype, "paySuccess");
                $handels->getHandle($data);
			}
		}
    }
}