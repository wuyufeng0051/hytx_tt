<?php  if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * Cookie处理插件
 *
 * @version        $Id: cookie.class.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

/**
 *  设置Cookie记录
 *
 * @param     string  $key    键
 * @param     string  $value  值
 * @param     string  $kptime  保持时间
 * @param     string  $pa     保存路径
 * @return    void
 */
if (!function_exists('PutCookie')){
    function PutCookie($key, $value, $kptime=0, $pa="/"){
        global $cfg_cookiePath, $cfg_cookieDomain, $cfg_cookiePre;
        setcookie($cfg_cookiePre.$key, $value, time()+$kptime, $cfg_cookiePath, $cfg_cookieDomain);
    }
}

/**
 *  清除Cookie记录
 *
 * @param     $key   键名
 * @return    void
 */
if (!function_exists('DropCookie')){
    function DropCookie($key){
        global $cfg_cookieDomain, $cfg_cookiePath, $cfg_cookiePre;
        setcookie($cfg_cookiePre.$key, '', time()-360000, $cfg_cookiePath, $cfg_cookieDomain);
    }
}

/**
 *  获取Cookie记录
 *
 * @param     $key   键名
 * @return    string
 */
if (!function_exists('GetCookie')){
    function GetCookie($key){
        global $cfg_cookiePath, $cfg_cookieDomain, $cfg_cookiePre;
        if(!isset($_COOKIE[$cfg_cookiePre.$key])){
            return '';
        }else{
        	return $_COOKIE[$cfg_cookiePre.$key];
        }
    }
}
