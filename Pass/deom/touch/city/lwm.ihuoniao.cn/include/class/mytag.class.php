<?php  if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 模板标签插件
 *
 * @version        $Id: mytag.class.php 2014-5-14 下午14:03:13 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

function mytagFunction($args, $content, &$smarty){
	global $config;
	global $module;
	global $do;
	global $handler;
	
    $handels = new handlers($module, $do);
	$return = $handels->getHandle($config);
	if($return['state'] != 100){
		$list = $return['info']."<br />";
	}else{
		$list = $return['info']['list'];
	}
	$smarty->assign('list', $list);
	return $content;
}