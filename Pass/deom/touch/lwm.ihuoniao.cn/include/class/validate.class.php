<?php  if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 验证插件
 *
 * @version        $Id: validate.class.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

//邮箱格式检查
if (!function_exists('CheckEmail')){
    function CheckEmail($email){
        if (!empty($email)){
            return preg_match('/^[a-z0-9]+([\+_\-\.]?[a-z0-9]+)*@([a-z0-9]+[\-]?[a-z0-9]+\.)+[a-z]{2,6}$/i', $email);
        }
        return FALSE;
    }
}