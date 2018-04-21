<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 更新已结束的竞价信息
 *
 *
 * @version        $Id: info_updateBidState.php 2016-10-13 下午15:25:11 $
 * @package        HuoNiao.cron
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

$time = GetMkTime(time());

$sql = $dsql->SetQuery("UPDATE `#@__infolist` SET `isbid` = 0 WHERE `bid_end` < $time");
$dsql->dsqlOper($sql, "update");
