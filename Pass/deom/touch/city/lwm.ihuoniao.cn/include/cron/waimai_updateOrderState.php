<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 外卖定时更新订单状态
 *
 * 半小时未支付的订单，更新状态为：6，取消支付
 *
 * @version        $Id: waimai_updateOrderState.php 2015-10-21 下午15:02:21 $
 * @package        HuoNiao.cron
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

 $time = time() - 1800;

 $sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 6 WHERE `state` = 0 AND `pubdate` < $time");
 $dsql->dsqlOper($sql, "update");
