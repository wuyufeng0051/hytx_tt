<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 短信操作类
 *
 * @version        $Id: sms.class.php 2015-08-06 下午12:51:11 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
class sms extends db_connect{
    // 公有变量
    var $title;
    var $username;
    var $password;
    var $charset;
    var $sendUrl;
    var $sendCode;
    var $accountUrl;
    var $accountCode;

    function __construct($db = NULL, $config = array()){
        parent::__construct($db);
        if(!empty($config)){
            $this->title    = $config['title'];
            $this->username    = $config['username'];
            $this->password    = $config['password'];
            $this->charset     = $config['charset'];
            $this->sendUrl     = $config['sendUrl'];
            $this->sendCode    = $config['sendCode'];
            $this->accountUrl  = $config['accountUrl'];
            $this->accountCode = $config['accountCode'];
        }else{
            $archives = $this->SetQuery("SELECT * FROM `#@__sitesms` WHERE `state` = 1");
            $results = $this->db->prepare($archives);
            $results->execute();
            $results = $results->fetchAll(PDO::FETCH_ASSOC);
            if($results){
                $data = $results[0];
                $this->title       = $data['title'];
                $this->username    = $data['username'];
                $this->password    = $data['password'];
                $this->charset     = $data['charset'];
                $this->sendUrl     = $data['sendUrl'];
                $this->sendCode    = $data['sendCode'];
                $this->accountUrl  = $data['accountUrl'];
                $this->accountCode = $data['accountCode'];
            }else{
                return "error";
            }
        }
    }


    /**
     *  发送短信
     *  @return  string
     */
    function send($mobile = "", $content = ""){

        if(empty($this->username) && empty($this->password)){
            return "fail";
        }

        global $cfg_soft_lang;
        $charset = $this->charset == 0 ? "utf-8" : "gb2312";

        $sendUrl = str_replace('{$username$}', $this->username, $this->sendUrl);
        $sendUrl = str_replace('{$password$}', $this->password, $sendUrl);
        $sendUrl = str_replace('{$mobile$}', $mobile, $sendUrl);
        $sendUrl = str_replace('{$content$}', mb_convert_encoding($content, $charset, $cfg_soft_lang), $sendUrl);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL,$sendUrl);
        $result = curl_exec($ch);
        curl_close($ch);

        $ischeck = explode($this->sendCode, $result);
        if(count($ischeck) > 1){
            return "ok";
        }else{
            return "fail";
        }
    }


    /**
     *  检查剩余量
     *  @return  string
     */
    function check(){

        $accountUrl = str_replace('{$username$}', $this->username, $this->accountUrl);
        $accountUrl = str_replace('{$password$}', $this->password, $accountUrl);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL,$accountUrl);
        $result = curl_exec($ch);
        curl_close($ch);

        if(!empty($result)){
            $arr = explode('{$num$}', $this->accountCode);

            $reArr = explode($arr[0], $result);
            $result = str_replace($reArr[0], "", $result);

            foreach ($arr as $key => $value) {
                $result = str_replace($value, "", $result);
            }
            return $result;
        }else{
            return 0;
        }
    }

}//End Class
