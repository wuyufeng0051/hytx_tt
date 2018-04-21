<?php
/**
 * 系统核心函数存放文件
 *
 * @version        $Id: common.func.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.Libraries
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

if(!defined('HUONIAOINC')) exit('Request Error!');

/**
 *  系统默认载入插件
 *
 * @access    public
 * @param     mix   $plug  插件名称,可以是数组,可以是单个字符串
 * @return    void
 */
$_plugs = array();
function loadPlug($plugs){
    //如果是数组,则进行递归操作
    if (is_array($plugs)){
        foreach($plugs as $huoniao)
        {
            loadPlug($huoniao);
        }
        return;
    }

    if (isset($_plugs[$plugs])){
        continue;
    }
    if (file_exists(HUONIAOINC.'/class/'.$plugs.'.class.php')){
        include_once(HUONIAOINC.'/class/'.$plugs.'.class.php');
        $_plugs[$plugs] = TRUE;
    }
    //无法载入插件
    if ( ! isset($_plugs[$plugs])){
        exit('Unable to load the requested file: class/'.$plugs.'.class.php');
    }
}

/**
 *  短消息函数,可以在某个动作处理后友好的提示信息
 *
 * @param     string  $msg        消息提示信息
 * @param     string  $gourl      跳转地址
 * @param     int     $onlymsg    仅显示信息
 * @param     int     $limittime  限制时间
 * @return    void
 */
function ShowMsg($msg, $gourl, $onlymsg=0, $limittime=0){
    $htmlhead  = "<html>\r\n<head>\r\n<title>温馨提示</title>\r\n";
	$htmlhead .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$GLOBALS['cfg_soft_lang']."\" />\r\n";
	$htmlhead .= "<link rel='stylesheet' rel='stylesheet' href='".HUONIAOADMIN."/../static/css/admin/bootstrap.css?v=4' />";
	$htmlhead .= "<link rel='stylesheet' rel='stylesheet' href='".HUONIAOADMIN."/../static/css/admin/common.css?v=1' />";
    $htmlhead .= "<base target='_self'/>\r\n</head>\r\n<body>\r\n<script>\r\n";
    $htmlfoot  = "\r\n</script>\r\n</body>\r\n</html>\r\n";

    $litime = ($limittime==0 ? 1000 : $limittime);
    $func = '';

    if($gourl=='-1'){
        if($limittime==0) $litime = 5000;
        $gourl = "javascript:history.go(-1);";
    }

    if($gourl=='' || $onlymsg==1){
        $msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
    }else{
        //当网址为:close::objname 时, 关闭父框架的id=objname元素
        if(preg_match('/close::/',$gourl)){
            $tgobj = trim(preg_replace('/close::/', '', $gourl));
            $gourl = 'javascript:;';
            $func .= "window.parent.document.getElementById('{$tgobj}').style.display='none';\r\n";
        }

        $func .= "	var pgo=0;\r\n";
		$func .= "	function JumpUrl(){\r\n";
		$func .= "		if(pgo==0){ location='$gourl'; pgo=1; }\r\n";
		$func .= "	}\r\n";
        $rmsg  = $func;
        $rmsg .= "	document.write(\"<div class='s-tip'><div class='s-tip-head'><h1>".$GLOBALS['cfg_soft_enname']." 提示：</h1></div>\");\r\n";
        $rmsg .= "	document.write(\"<div class='s-tip-body'>".str_replace("\"","“",$msg)."\");\r\n";
        $rmsg .= "	document.write(\"";

        if($onlymsg==0){
            if($gourl != 'javascript:;' && $gourl != ''){
                $rmsg .= "<br /><a href='{$gourl}'>如果您的浏览器没有自动跳转，请点击这里</a></div>\");\r\n";
                $rmsg .= "	setTimeout('JumpUrl()',$litime);";
            }else{
                $rmsg .= "<br /></div>\");\r\n";
            }
        }else{
            $rmsg .= "<br /><br /></div>\");\r\n";
        }
        $msg  = $htmlhead.$rmsg.$htmlfoot;
    }
    echo $msg;
}

/*
 * 获取软件当前版本
 */
function getSoftVersion(){
	$m_file = HUONIAODATA."/admin/version.txt";
	$version = "";
	if(filesize($m_file)>0){
		$fp = fopen($m_file,'r');
		$version = fread($fp,filesize($m_file));
		fclose($fp);
	}
	return $version;
}

/**
 * 检查功能模块状态
 *
 * @param array $config
 * @return string
 */
function checkModuleState($config = array()){
  if($config['visitState']){
    die($config['visitMessage']);
  }
  if($config['channelSwitch']){
		die($config['closeCause']);
	}
}

/**
 *  获取验证码的session值
 *
 * @return    string
 */
function GetCkVdValue(){
	@session_id($_COOKIE['PHPSESSID']);
    return isset($_SESSION['huoniao_vdimg_value']) ? $_SESSION['huoniao_vdimg_value'] : '';
}

/**
 *  PHP某些版本有Bug，不能在同一作用域中同时读session并改注销它，因此调用后需执行本函数
 *
 * @return    void
 */
function ResetVdValue(){
    $_SESSION['huoniao_vdimg_value'] = '';
}

//获取用户真实地址
function GetIP(){
    static $realip = NULL;
    if ($realip !== NULL){
        return $realip;
    }
    if (isset($_SERVER)){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            /* 取X-Forwarded-For中第x个非unknown的有效IP字符? */
            foreach ($arr as $ip){
                $ip = trim($ip);
                if ($ip != 'unknown'){
                    $realip = $ip;
                    break;
                }
            }
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])){
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }else{
            if (isset($_SERVER['REMOTE_ADDR'])){
                $realip = $_SERVER['REMOTE_ADDR'];
            }else{
                $realip = '0.0.0.0';
            }
        }
    }else{
        if (getenv('HTTP_X_FORWARDED_FOR')){
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }elseif (getenv('HTTP_CLIENT_IP')){
            $realip = getenv('HTTP_CLIENT_IP');
        }else{
            $realip = getenv('REMOTE_ADDR');
        }
    }
    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = ! empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
    return $realip;
}

//获取IP真实地址
function getIpAddr($ip){

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "http://wap.ip138.com/ip_search138.asp?ip=$ip");
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 1);
  $con = curl_exec($curl);
  curl_close($curl);

  $preg="/\<\/b\>\<br\/\>\<b\>(.*)\<\/b\>/U";
	preg_match_all($preg,$con,$arr);
	return $arr[1][0];


}

//检查IP段
function checkIpAccess($ip, $accesslist) {
	return preg_match("/^(".str_replace(array("\r\n", ' '), array('|', ''), preg_quote($accesslist, '/')).")/", $ip);
}

//获取手机归属地
function getTelAddr($tel){
	$curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "http://wap.ip138.com/sim_search138.asp?mobile=$tel");
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 5);
  $con = curl_exec($curl);
  curl_close($curl);

	//$con = iconv("gb2312","utf-8//IGNORE",$con);
	$preg="/归属地：(.*)\<br\/\>/U";
	preg_match_all($preg,$con,$arr);
	return $arr[1][0];
}

//转换编码，将Unicode编码转换成可以浏览的utf-8编码
function unicode_decode($name){
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches)){
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++){
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0){
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }else{
                $name .= $str;
            }
        }
    }
    return $name;
}

/**
 * 获得当前的脚本网址
 *
 * @return    string
 */
function GetCurUrl(){
	if(!empty($_SERVER["REQUEST_URI"])){
		$scriptName = $_SERVER["REQUEST_URI"];
		$nowurl = $scriptName;
	}else{
		$scriptName = $_SERVER["PHP_SELF"];
		if(empty($_SERVER["QUERY_STRING"])) {
			$nowurl = $scriptName;
		}else{
			$nowurl = $scriptName."?".$_SERVER["QUERY_STRING"];
		}
	}
	return $nowurl;
}

/*
 * 函数名称：create_sess_id()
 * 函数作用：产生以个随机的会话ID
 * 参   数：$len: 需要会话字符串的长度，默认为32位，不要低于16位
 * 返 回 值：返回会话ID
 */
function create_sess_id($len=32){
	//校验提交的长度是否合法
	if(!is_numeric($len) || ($len>32) || ($len<16)) {return;}
	//获取当前时间的微秒
	list($u, $s) = explode(' ', microtime());
	$time = (float)$u + (float)$s;
	//产生一个随机数
	$rand_num = rand(100000, 999999);
	$rand_num = rand($rand_num, $time);
	mt_srand($rand_num);
	$rand_num = mt_rand();
	//产生SessionID
	$sess_id = md5( md5($time). md5($rand_num) );
	//截取指定需要长度的SessionID
	$sess_id = substr($sess_id, 0, $len);
	return $sess_id;
}

/*
 * 函数名称：create_check_code()
 * 函数作用：产生以个随机的校验码
 * 参   数：$len: 需要校验码的长度, 请不要长于16位,缺省为4位
 * 返 回 值：返回指定长度的校验码
 */
function create_check_code($len=4){
 if(!is_numeric($len) || ($len>15) || ($len<1)) {return;}

 $check_code = substr(create_sess_id(), 16, $len);
 return strtoupper($check_code);
}


/**
 * 生成订单号
 * @return string
 */
function create_ordernum(){
	return intval(date('y')).
					strtoupper(dechex(date('m'))).date('d').
					substr(time(),-5).substr(microtime(),2,4).sprintf('%02d',rand(0,99));
}


/**
 * 生成指定数量的随机字符
 * $len 长度
 * $type 类型 1 数字  2 字母  3混合
 */
function genSecret($len = 6, $type = 1){
	$secret = '';
	for($i = 0; $i < $len;  $i++) {
		if($type == 1){
			if(0 == $i){
				$secret .= chr(rand(49, 57));
			}else {
				$secret .= chr(rand(48, 57));
			}
		}else if($type == 2){
			$secret .= chr(rand(65, 90));
		}else{
			if (0 == $i){
				$secret .= chr(rand(65, 90));
			} else {
				$secret .= (0 == rand(0,1)) ? chr(rand(65, 90)) : chr(rand(48,57));
			}
		}
	}
	return $secret;
}



/**
 * 遍历多维数组为一维数组
 *
 * @param array 传入的多维数组
 * @return array 返回一维数组
 */
function arr_foreach($arr) {
	global $arr_data;
	if (!is_array ($arr) && $arr != NULL) {
		return $arr_data;
	}
	foreach ($arr as $key => $val ) {
		if (is_array ($val)) {
			arr_foreach ($val);
		} else {
			if($val != NULL && $key == "id"){
				$arr_data[]=$val;
			}
		}
	}
	return $arr_data;
}

//stdClass Object对象转普通数组
function objtoarr($obj){
	$ret = array();
	if(!$obj) return false;
	foreach($obj as $key => $value){
		if(gettype($value) == 'array' || gettype($value) == 'object'){
			$ret[$key] = objtoarr($value);
		}else{
			$ret[$key] = $value;
		}
	}
	return $ret;
}

//二维数组排序
function array_sort($arr, $keys, $type='asc'){
	$keysvalue = $new_array = array();
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array;
}

//分类操作
function typeAjax($arr, $pid = 0, $dopost){
	$dsql = new dsql($dbo);

	if (!is_array($arr) && $arr != NULL) {
		return '{"state": 200, "info": "保存失败！"}';
	}
	for($i = 0; $i < count($arr); $i++){
		$id = $arr[$i]["id"];
		$name = $arr[$i]["name"];
		$longitude = $arr[$i]["longitude"];
		$latitude = $arr[$i]["latitude"];

		//如果ID为空则向数据库插入下级分类
		if($id == "" || $id == 0){

      //新闻频道包含拼音、拼音首字母
      if($dopost == "articletype" || $dopost == "pictype"){
        $pinyin = GetPinyin($name);
        $py     = GetPinyin($name, 1);

        $archives = $dsql->SetQuery("INSERT INTO `#@__".$dopost."` (`parentid`, `typename`, `pinyin`, `py`, `weight`, `pubdate`) VALUES ('$pid', '$name', '$pinyin', '$py', '$i', '".GetMkTime(time())."')");

			//房产频道特殊字段
      }elseif($dopost == "houseaddr"){
				$archives = $dsql->SetQuery("INSERT INTO `#@__".$dopost."` (`parentid`, `typename`, `weight`, `pubdate`, `longitude`, `latitude`) VALUES ('$pid', '$name', '$i', '".GetMkTime(time())."', '$longitude', '$latitude')");

      //其他
			}else{
				$archives = $dsql->SetQuery("INSERT INTO `#@__".$dopost."` (`parentid`, `typename`, `weight`, `pubdate`) VALUES ('$pid', '$name', '$i', '".GetMkTime(time())."')");
			}
			$id = $dsql->dsqlOper($archives, "lastid");

			adminLog("添加分类", $dopost."=>".$name);
		}
		//其它为数据库已存在的分类需要验证分类名是否有改动，如果有改动则UPDATE
		else{
      //房产频道特殊字段
			if($dopost == "houseaddr"){
  	     $archives = $dsql->SetQuery("SELECT `typename`, `weight`, `longitude`, `latitude` FROM `#@__".$dopost."` WHERE `id` = ".$id);
      }else{
         $archives = $dsql->SetQuery("SELECT `typename`, `weight` FROM `#@__".$dopost."` WHERE `id` = ".$id);
      }
			$results = $dsql->dsqlOper($archives, "results");
			if(!empty($results)){
				//验证分类名
				if($results[0]["typename"] != $name){

          //新闻频道包含拼音、拼音首字母
          if($dopost == "article" || $dopost == "pic"){
            $pinyin = GetPinyin($name);
  					$py     = GetPinyin($name, 1);
  					$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."` SET `typename` = '$name', `pinyin` = '$pinyin', `py` = '$py' WHERE `id` = ".$id);
          }else{
            $archives = $dsql->SetQuery("UPDATE `#@__".$dopost."` SET `typename` = '$name' WHERE `id` = ".$id);
          }
					$dsql->dsqlOper($archives, "update");

					adminLog("修改分类名", $dopost."=>".$name);
				}

				//验证排序
				if($results[0]["weight"] != $i){
					$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."` SET `weight` = '$i' WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					adminLog("修改分类排序", $dopost."=>".$name."=>".$i);
				}


				//房产频道特殊字段
				if($dopost == "houseaddr"){
					if($results[0]["longitude"] != $longitude || $results[0]["latitude"] != $latitude){
						$archives = $dsql->SetQuery("UPDATE `#@__".$dopost."` SET `longitude` = '$longitude', `latitude` = '$latitude' WHERE `id` = ".$id);
						$dsql->dsqlOper($archives, "update");
						adminLog("修改房产区域坐标", $dopost."=>".$name."=>".$longitude.",".$latitude);
					}

				}


			}
		}
		if(is_array($arr[$i]["lower"])){
			typeAjax($arr[$i]["lower"], $id, $dopost);
		}
	}
	return '{"state": 100, "info": "保存成功！"}';
}

/* 获取分类信息 */
function getTypeInfo($params){
	extract($params);
	$typeHandels = new handlers($service, "typeDetail");
	$typeConfig  = $typeHandels->getHandle($typeid);

	if(is_array($typeConfig) && $typeConfig['state'] == 100){
		$typeConfig  = $typeConfig['info'];
		if(is_array($typeConfig)){
			foreach ($typeConfig[0] as $key => $value) {
				if($key == $return){
					return $value;
				}
			}
		}
	}
}

/* 获取分类名称 */
function getTypeName($params){
	$params['return'] = "typename";
	return getTypeInfo($params);
}

/**
 * 删除文件
 *
 * @param $picpath string 要删除的图片路径
 * @param $type string 要删除的图片类型
 * @param $mod string 要删除的模块
 * @return array
 */
function delPicFile($picpath, $type, $mod){
	global $cfg_ftpState;
	global $cfg_ftpType;
	global $cfg_ftpSSL;
	global $cfg_ftpPasv;
	global $cfg_ftpUrl;
	global $cfg_uploadDir;
	global $cfg_ftpServer;
	global $cfg_ftpPort;
	global $cfg_ftpDir;
	global $cfg_ftpUser;
	global $cfg_ftpPwd;
	global $cfg_ftpTimeout;
	global $cfg_OSSUrl;
	global $cfg_OSSBucket;
	global $cfg_OSSKeyID;
	global $cfg_OSSKeySecret;
	global $cfg_fileUrl;
	global $cfg_basedir;

	$dsql = new dsql($dbo);

	$picpathArr = $picpathArr_ = array();
	$picpath = explode(",", $picpath);

	foreach($picpath as $val){
		$RenrenCrypt = new RenrenCrypt();
		$id = $RenrenCrypt->php_decrypt(base64_decode($val));

		if(!is_numeric($id)) return;

		$attachment = $dsql->SetQuery("SELECT `path` FROM `#@__attachment` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($attachment, "results");

		if(!$results) return;  //数据不存在
		$picpath = $results[0]['path'];

		$picpathArr_[] = $picpath;
		if($type == "editor"){
			if(strpos($picpath, "file") !== false){
				$picpath = explode("file/", $picpath);
			}elseif(strpos($picpath, "remote") !== false){
				$picpath = explode("remote/", $picpath);
			}else{
				$picpath = explode("image/", $picpath);
			}
		}elseif($type == "delFile" || $type == "delfile"){
			$picpath = explode("file/", $picpath);
		}else{
			$picpath = explode("large/", $picpath);
		}
		$picpathArr[] = $picpath[1];

		$attachment = $dsql->SetQuery("DELETE FROM `#@__attachment` WHERE `id` = ".$id);
		$dsql->dsqlOper($attachment, "update");

	}
	$picpath = join(",", $picpathArr);

	if(!empty($picpath)){
		if($mod != "siteConfig"){
			require(HUONIAOINC."/config/".$mod.".inc.php");

			if(empty($customFtp)) {global $customFtp;}
			if(empty($custom_ftpState)) {global $custom_ftpState;}
			if(empty($custom_ftpServer)) {global $custom_ftpServer;}
			if(empty($custom_ftpPort)) {global $custom_ftpPort;}
			if(empty($custom_ftpUser)) {global $custom_ftpUser;}
			if(empty($custom_ftpPwd)) {global $custom_ftpPwd;}
			if(empty($custom_ftpTimeout)) {global $custom_ftpTimeout;}
			if(empty($custom_ftpSSL)) {global $custom_ftpSSL;}
			if(empty($custom_ftpPasv)) {global $custom_ftpPasv;}
			if(empty($custom_ftpDir)) {global $custom_ftpDir;}
			if(empty($custom_ftpUrl)) {global $custom_ftpUrl;}
			if(empty($custom_uploadDir)) {global $custom_uploadDir;}
			if(empty($custom_ftpType)) {global $custom_ftpType;}
			if(empty($custom_OSSUrl)) {global $custom_OSSUrl;}
			if(empty($custom_OSSBucket)) {global $custom_OSSBucket;}
			if(empty($custom_OSSKeyID)) {global $custom_OSSKeyID;}
			if(empty($custom_OSSKeySecret)) {global $custom_OSSKeySecret;}

			//默认FTP帐号
			if($customFtp == 0){
				$custom_ftpState = $cfg_ftpState;
				$custom_ftpType = $cfg_ftpType;
				$custom_ftpSSL = $cfg_ftpSSL;
				$custom_ftpPasv = $cfg_ftpPasv;
				$custom_ftpUrl = $cfg_ftpUrl;
				$custom_uploadDir = $cfg_uploadDir;
				$custom_ftpServer = $cfg_ftpServer;
				$custom_ftpPort = $cfg_ftpPort;
				$custom_ftpDir = $cfg_ftpDir;
				$custom_ftpUser = $cfg_ftpUser;
				$custom_ftpPwd = $cfg_ftpPwd;
				$custom_ftpTimeout = $cfg_ftpTimeout;
				$custom_OSSUrl = $cfg_OSSUrl;
				$custom_OSSBucket = $cfg_OSSBucket;
				$custom_OSSKeyID = $cfg_OSSKeyID;
				$custom_OSSKeySecret = $cfg_OSSKeySecret;
			}

			//自定义FTP配置
			if($customFtp == 1){
				//阿里云OSS
				if($custom_ftpType == 1){
					if(strpos($custom_OSSUrl, "http://") !== false){
						$site_fileUrl = $custom_OSSUrl;
					}else{
						$site_fileUrl = "http://".$custom_OSSUrl;
					}
				//普通FTP
				}elseif($custom_ftpState == 1){
					$site_fileUrl = $custom_ftpUrl.str_replace(".", "", $custom_ftpDir);
				//本地
				}else{
					if($customUpload == 1){
						$site_fileUrl = $custom_uploadDir;
					}else{
						$site_fileUrl = $cfg_uploadDir;
					}
				}
			//系统默认
			}else{
				//阿里云OSS
				if($cfg_ftpType == 1){
					if(strpos($cfg_OSSUrl, "http://") !== false){
						$site_fileUrl = $cfg_OSSUrl;
					}else{
						$site_fileUrl = "http://".$cfg_OSSUrl;
					}
				//普通FTP
				}elseif($cfg_ftpState == 1){
					$site_fileUrl = $custom_ftpDir;
				//本地
				}else{
					$site_fileUrl = $cfg_uploadDir;
				}
			}

			//模块自定义情况
			//普通FTP模式
			if($customFtp == 1 && $custom_ftpType == 0 && $custom_ftpState == 1){
				$cfg_ftpType = 0;
				$cfg_ftpState = 1;
				$cfg_ftpDir = $custom_ftpDir;

			//阿里云OSS
			}elseif($customFtp == 1 && $custom_ftpType == 1){
				$cfg_ftpType = 1;
				$cfg_ftpState = 0;
				$cfg_ftpDir = $custom_uploadDir;

			//本地
			}elseif($customFtp == 1 && $custom_ftpType == 0 && $custom_ftpState == 0){
				$cfg_ftpType = 2;
				$cfg_ftpState = 0;
				$cfg_ftpDir = $custom_uploadDir;

			}

		}else{
			//阿里云OSS
			if($cfg_ftpType == 1){
				if(strpos($cfg_OSSUrl, "http://") !== false){
					$site_fileUrl = $cfg_OSSUrl;
				}else{
					$site_fileUrl = "http://".$cfg_OSSUrl;
				}
			//普通FTP
			}elseif($cfg_ftpState == 1){
				$site_fileUrl = $cfg_ftpDir;
			//本地
			}else{
				$site_fileUrl = $cfg_uploadDir;
			}
		}

		//列出要删除的文件类型
		if($type == "delThumb" || $type == "delthumb"){
			$pathType = "thumb";
			$pathModel = array("small", "middle", "large", "o_large");
		}else if($type == "delAtlas" || $type == "delatlas"){
			$pathType = "atlas";
			$pathModel = array("small", "large");
		}else if($type == "delConfig" || $type == "delconfig"){
			$pathType = "config";
			$pathModel = array("large");
		}else if($type == "delFriendLink" || $type == "delfriendLink"){
			$pathType = "friendlink";
			$pathModel = array("large");
		}else if($type == "delAdv" || $type == "deladv"){
			$pathType = "adv";
			$pathModel = array("large");
		}else if($type == "delCard" || $type == "delcard"){
			$pathType = "card";
			$pathModel = array("large");
		}else if($type == "delLogo" || $type == "dellogo"){
			$pathType = "logo";
			$pathModel = array("large");
		}else if($type == "delBrand" || $type == "delbrand"){
			$pathType = "brand";
			$pathModel = array("large");
		}else if($type == "delbrandLogo" || $type == "delbrandlogo"){
			$pathType = "brandLogo";
			$pathModel = array("small", "middle", "large");
		}else if($type == "delFile" || $type == "delfile"){
			$pathType = "file";
			$pathModel = array("large");
		}else if($type == "delVideo"  || $type == "delvideo"){
			$pathType = "video";
			$pathModel = array("large");
		}else if($type == "delFlash" || $type == "delflash"){
			$pathType = "flash";
			$pathModel = array("large");
		}else if($type == "delPhoto" || $type == "delphoto"){
			$pathType = "photo";
			$pathModel = array("small", "middle", "large");
		}

		//编辑器附件
		if($type == "editor"){
			//阿里云OSS
			if($cfg_ftpType == 1){
				$OSSConfig = array();
				if($mod != "siteConfig"){
					$OSSConfig = array(
						"bucketName" => $custom_OSSBucket,
						"accessKey" => $custom_OSSKeyID,
						"accessSecret" => $custom_OSSKeySecret
					);
				}

				$aliyunOSS = new aliyunOSS($OSSConfig);

				foreach($picpathArr_ as $val){
					$aliyunOSS->delete($val);
					$ossError .= $aliyunOSS->error();
				}

				if($ossError){
					$error = $ossError;
				}

			//普通FTP模式
			}elseif($cfg_ftpType === 0 && $cfg_ftpState === 1){
				$ftpConfig = array();
				if($mod != "siteConfig" && $customFtp == 1 && $custom_ftpState == 1){
					$ftpConfig = array(
						"on" => $custom_ftpState, //是否开启
						"host" => $custom_ftpServer, //FTP服务器地址
						"port" => $custom_ftpPort, //FTP服务器端口
						"username" => $custom_ftpUser, //FTP帐号
						"password" => $custom_ftpPwd,  //FTP密码
						"attachdir" => $custom_ftpDir,  //FTP上传目录
						"attachurl" => $custom_ftpUrl,  //远程附件地址
						"timeout" => $custom_ftpTimeout,  //FTP超时
						"ssl" => $custom_ftpSSL,  //启用SSL连接
						"pasv" => $custom_ftpPasv  //被动模式连接
					);
				}

				$autoload = false;
				$huoniao_ftp = new ftp($ftpConfig);
				$huoniao_ftp->connect();
				if($huoniao_ftp->connectid) {
					foreach($picpathArr_ as $val){
						$filePath = $cfg_ftpDir.$val;
						if(!$huoniao_ftp->ftp_delete($filePath)){
							$error = "要删除的文件不存在";
						}
					}
				}

			//本地附件
			}else{
				foreach($picpathArr_ as $val){
					$filePath = HUONIAOROOT.$site_fileUrl.$val;
					if(file_exists($filePath)){
						unlink($filePath);
					}else{
						$error = "要删除的文件不存在";
					}
				}
			}

			//输出错误信息
			if(!empty($error)){
				//echo '{"state":"ERROR","info":"'.$error.'"}';
			}

		//缩略图、图集、附件
		}else{
			if(!empty($pathModel)){
				//循环操作相关文件
				foreach($pathModel as $key => $value){
					$imgPath = explode(",", $picpath);
					foreach($imgPath as $val){

						//阿里云OSS
						if($cfg_ftpType == 1){
							$OSSConfig = array();
							if($mod != "siteConfig"){
								$OSSConfig = array(
									"bucketName" => $custom_OSSBucket,
									"accessKey" => $custom_OSSKeyID,
									"accessSecret" => $custom_OSSKeySecret
								);
							}

							$aliyunOSS = new aliyunOSS($OSSConfig);
							$aliyunOSS->delete($mod."/".$pathType."/".$value."/".$val);
							$ossError = $aliyunOSS->error();

							if($ossError){
								$error = $ossError;
							}

						//普通FTP模式
						}elseif($cfg_ftpType == 0 && $cfg_ftpState == 1){
							$ftpConfig = array();
							if($mod != "siteConfig" && $customFtp == 1 && $custom_ftpState == 1){
								$ftpConfig = array(
									"on" => $custom_ftpState, //是否开启
									"host" => $custom_ftpServer, //FTP服务器地址
									"port" => $custom_ftpPort, //FTP服务器端口
									"username" => $custom_ftpUser, //FTP帐号
									"password" => $custom_ftpPwd,  //FTP密码
									"attachdir" => $custom_ftpDir,  //FTP上传目录
									"attachurl" => $custom_ftpUrl,  //远程附件地址
									"timeout" => $custom_ftpTimeout,  //FTP超时
									"ssl" => $custom_ftpSSL,  //启用SSL连接
									"pasv" => $custom_ftpPasv  //被动模式连接
								);
							}

							$autoload = false;
							$huoniao_ftp = new ftp($ftpConfig);
							$huoniao_ftp->connect();
							if($huoniao_ftp->connectid) {
								$filePath = $cfg_ftpDir."/".$mod."/".$pathType."/".$value."/".$val;
								if(!$huoniao_ftp->ftp_delete($filePath)){
									$error = "要删除的文件不存在";
								}
							}

						//本地附件
						}else{
							$filePath = HUONIAOROOT.$site_fileUrl."/".$mod."/".$pathType."/".$value."/".$val;
							if(!unlinkFile($filePath)){
								$error = "要删除的文件不存在";
							}
						}
					}

				}

				//输出错误信息
				if(!empty($error)){
					//echo '{"state":"ERROR","info":"'.$error.'"}';
				}

			}else{
				//echo '{"state":"ERROR","info":"PathModel Is Wrong!"}';
			}
		}

	}else{
		//echo '{"state":"ERROR","info":"Empty Path!"}';
	}
}

//提取内容图片并删除
function delEditorPic($body, $dopost){
	global $cfg_attachment;
	$attachment = substr($cfg_attachment, 1, strlen($cfg_attachment));

    global $cfg_basehost;
    $attachment = str_replace("http://".$cfg_basehost, "", $cfg_attachment);
    $attachment = substr($attachment, 1, strlen($attachment));

	$attachment = str_replace("/", "\/", $attachment);
	$attachment = str_replace(".", "\.", $attachment);
	$attachment = str_replace("?", "\?", $attachment);
	$attachment = str_replace("=", "\=", $attachment);

	preg_match_all("/$attachment(.*)[\"|'| ]/isU",$body,$picList);
	$picList = array_unique($picList[1]);

	//删除内容图片
	if(!empty($picList)){
		$editorPic = array();
		foreach($picList as $v_){
			$editorPic[] = $v_;
		}
		$editorPic = !empty($editorPic) ? join(",", $editorPic) : "";
		if(!empty($editorPic)){
			delPicFile($editorPic, "editor", $dopost);
		}
	}
}

//获取分类所有父级
function getParentArr($tab, $typeid){
	global $dsql;
	if(!empty($typeid)){
		$archives = $dsql->SetQuery("SELECT `id`, `parentid`, `typename` FROM `#@__".$tab."` WHERE `id` = ".$typeid);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			if($results[0]['parentid'] != 0){
				$results[]["lower"] = getParentArr($tab, $results[0]['parentid']);
			}
		}
		return $results;
	}
}

//只取数组中的分类名
function parent_foreach($arr, $type) {
	global $data;
	if(!empty($arr)){
		if (!is_array ($arr) && $arr != NULL) {
			return $data;
		}
		foreach ($arr as $key => $val){
			if (is_array ($val)){
				parent_foreach($val, $type);
			} else {
				if($val != NULL && $key == $type){
					$data[]=$val;
				}
			}
		}
		return $data;
	}else{
		return array();
	}
}

//笛卡尔集
function descartes() {
	$t = func_get_args();
	if(func_num_args() == 1) return call_user_func_array(__FUNCTION__, $t[0]);
	$a = array_shift($t);
	if(!is_array($a)) $a = array($a);
	$a = array_chunk($a, 1);
	do{
		$r = array();
		$b = array_shift($t);
		if(!is_array($b)) $b = array($b);
		foreach($a as $p)
		foreach(array_chunk($b, 1) as $q)
		$r[] = array_merge($p, $q);
		$a = $r;
	}while($t);
	return $r;
}

/**
 * 记录操作日志
 *
 * @param $name string 运作
 * @param $note string 其它
 */
function adminLog($name = "", $note = ""){
	$dsql = new dsql($dbo);
	$userLogin = new userLogin($dbo);

	$archives = $dsql->SetQuery("INSERT INTO `#@__sitelog` (`admin`, `name`, `note`, `ip`, `pubdate`) VALUES (".$userLogin->getUserID().", '$name', '".str_replace("'", "\'", $note)."', '".GetIP()."', '".GetMkTime(time())."')");
	$result = $dsql->dsqlOper($archives, "update");
	if($result != "ok"){
		//echo "管理员日志记录失败！";
	}
}

/*
 * 邮件发送函数
 * @param $email      string 收件人
 * @param $mailtitle  string 主题
 * @param $mailbody   string 内容
 */
function sendmail($email, $mailtitle, $mailbody){
	global $cfg_mail, $cfg_mailServer, $cfg_mailPort, $cfg_mailFrom, $cfg_mailUser, $cfg_mailPass, $cfg_webname;
	$mailServer = explode(",", $cfg_mailServer);
	$mailPort   = explode(",", $cfg_mailPort);
	$mailFrom   = explode(",", $cfg_mailFrom);
	$mailUser   = explode(",", $cfg_mailUser);
	$mailPass   = explode(",", $cfg_mailPass);

	$c_mailServer = $c_mailPort = $c_mailFrom = $c_mailUser = $c_mailPass = "";
	foreach ($mailServer as $key => $value) {
		if($key == $cfg_mail){
			$c_mailServer = $mailServer[$key];
			$c_mailPort   = $mailPort[$key];
			$c_mailFrom   = $mailFrom[$key];
			$c_mailUser   = $mailUser[$key];
			$c_mailPass   = $mailPass[$key];
		}
	}


    if(!empty($c_mailServer)){

        require_once(HUONIAOINC . '/class/PHPMailer.class.php');

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = $c_mailServer;
        $mail->SMTPAuth = true;
        $mail->Username = $c_mailUser;
        $mail->Password = $c_mailPass;
        if($c_mailPort == "465"){
            $mail->SMTPSecure = 'ssl';
        }
        $mail->Port = $c_mailPort;

        $mail->setFrom($c_mailFrom);
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = $mailtitle;
        $mail->Body = htmlspecialchars_decode($mailbody);

        if(!$mail->send()) {
            return $mail->ErrorInfo;
        }

	}else{
		return '邮件发送失败，ErrCode: 邮件配置2';exit();
	}

	// if(!empty($c_mailServer)){
	// 	$mailtype = 'HTML';
	// 	require_once(HUONIAOINC.'/class/mail.class.php');
	// 	$smtp = new smtp($c_mailServer, $c_mailPort, true, $c_mailFrom, $c_mailPass);
	// 	$smtp->debug = false;
	// 	if(!$smtp->smtp_sockopen($c_mailServer)){
	// 		return '邮件发送失败，ErrCode: 邮件配置1';exit();
	// 	}
	// 	$smtp->sendmail($email, $cfg_webname, $c_mailFrom, $mailtitle, htmlspecialchars_decode($mailbody), $mailtype);
	// }else{
	// 	return '邮件发送失败，ErrCode: 邮件配置2';exit();
	// }

}

/*
 * 短信发送函数
 * @param $phone          string   接收手机号码
 * @param $id             string   短信模板ID（如果类型为数字则代表当前系统的数据ID，如果为其他则代表其他平台的营销型短信模板）
 * @param $code           int      变量内容
 * @param $type           string   类型
 * @param $has            boolean  是否已经存在
 * @param $promotion      boolean  是否为营销型短信
 * @
 */
function sendsms($phone, $id, $code, $type = "", $has = false, $promotion = false, $notify = "", $config = array()){

    global $dsql;
    global $userLogin;
    global $cfg_smsAlidayu;
    global $handler;
    $handler = false;

    $uid = $userLogin->getMemberID();
    $ip  = GetIP();
    $now = GetMkTime(time());

    //前台未登录的获取后台登录帐号
    if($uid == -1){
        $uid = $userLogin->getUserID();
    }

    //获取短信内容
    $tempid = "";
    $content = "";
    if(is_numeric($id) && $id == 1 && $notify){
        $config['code'] = $code;
        $contentTpl = getInfoTempContent("sms", $notify, $config);
        if($contentTpl){
            $tempid  = $contentTpl['title'];
            $content = $contentTpl['content'];
        }

        if($tempid == "" && $content == ""){
            return array("state" => 200, "info" => "短信通知未开启，发送失败！");
        }
    }else{
        //如果是营销型短信或重新发送短信，短信内容则为ID
        if($promotion){
            $content = $id;
        }else{
            $content = "您的短信验证码：".$code;
        }
    }

    //如果是阿里大于
    if($cfg_smsAlidayu){

        $archives = $dsql->SetQuery("SELECT * FROM `#@__sitesms` WHERE `state` = 1");
        $results = $dsql->dsqlOper($archives, "results");
        if($results){

            $data = $results[0];
            $username = $data['username'];
            $password = $data['password'];
            $signCode = $data['signCode'];

            //如果是数据
            if(is_numeric($id) && $id == 1 && $notify){
                // $sql = $dsql->SetQuery("SELECT `tempid` FROM `#@__site_smstemp` WHERE `id` = $id");
                // $ret = $dsql->dsqlOper($sql, "results");
                // if($ret){
                //     $tempid = $ret[0]['tempid'];
                // }else{
                //     //阿里大鱼测试模板
                //     $tempid   = "SMS_10652302";
                //     $signCode = "大鱼测试";
                // }
            }else{
                $tempid = $id;
            }

            if($tempid){

                $c = new TopClient();
                $c->appkey = $username;
                $c->secretKey = $password;
                $req = new AlibabaAliqinFcSmsNumSendRequest();
                $req->setSmsType("normal");
                $req->setSmsFreeSignName($signCode);
                //测试短信不需要传递变量
                if(is_numeric($id) && $id == 1 && $notify){
                    $paramData = array();
                    foreach ($config as $key => $value) {
                        if($key != "url"){
                            array_push($paramData, $key.":'".$value."'");
                        }
                    }
                    $req->setSmsParam("{".join(",", $paramData)."}");
                }else{
                    $req->setSmsParam("{customer: '火鸟客服'}");
                }
                $req->setRecNum($phone);
                $req->setSmsTemplateCode($tempid);
                $resp = objtoarr($c->execute($req));

                if($resp['result'] && $resp['result']['success']){
                    $return = "ok";
                }else{
                    $return = "发送失败，CODE[".$resp['code']."]，MSG[".$resp['msg']."], SUB_MSG[".$resp['sub_msg']."]";
                }

            }else{
                $return = "短信模板ID未设置！";
            }

        }else{
            $return = "发送失败，短信平台未配置！";
        }


    //其他普通短信平台
    }else{
        $sms = new sms($dbo);
        $return = $sms->send($phone, $content);
    }

    if($return == "ok"){
        if($has){
            $archives = $dsql->SetQuery("UPDATE `#@__site_messagelog` SET `code` = '$code', `body` = '$content', `pubdate` = '$now', `ip` = '$ip' WHERE `type` = 'phone' AND `lei` = '$type' AND `user` = '$phone'");
            $results  = $dsql->dsqlOper($archives, "update");
        }else{
            messageLog("phone", $type, $phone, $title, $content, $uid, 0, $code, $tempid);
        }
        return "ok";

    }else{
        messageLog("phone", $type, $phone, $title, $content, $uid, 1, $code, $tempid);
        return array("state" => 200, "info" => $return);
    }

}

/*
 * 记录信息发送日志
 * @param $type    string 信息类型
 * @param $lei     string 类别
 * @param $user    string 收件人
 * @param $title   string 主题
 * @param $body    string 信息内容
 * @param $by      int    操作人
 * @param $state   int    状态
 * @param $code    string 验证关键字
 */
function messageLog($type, $lei, $user, $title, $body, $by, $state, $code = "", $tempid = ""){
	$dsql = new dsql($dbo);
	$userLogin = new userLogin($dbo);
	$ip = GetIP();

	$archives = $dsql->SetQuery("INSERT INTO `#@__site_messagelog` (`type`, `lei`, `user`, `title`, `body`, `code`, `tempid`, `by`, `state`, `pubdate`, `ip`) VALUES ('$type', '$lei', '$user', '$title', '$body', '$code', '$tempid', $by, $state, '".GetMkTime(time())."', '$ip')");
	$result = $dsql->dsqlOper($archives, "update");
	if($result != "ok"){
		//echo "信息发送日志记录失败！";
	}
}


/*
 * 获取邮件、短信发送内容
 * @param string $type 类型 sms: 短信  mail: 邮件
 * @param int $id   模板ID
 * @param array config 系统配置参数
 * @return string
 */
function getInfoTempContent($type, $notify, $config = array()){
  global $dsql;
  global $cfg_basehost;
  global $cfg_webname;
  global $cfg_shortname;
  global $cfg_attachment;
  global $cfg_weblogo;
  global $cfg_hotline;
  $time = date("Y-m-d H:i:s", time());

  if(empty($type) || empty($notify)) return "";

  $configArr = array(
    "basehost"  => $cfg_basehost,
    "webname"   => $cfg_webname,
    "shortname" => $cfg_shortname,
    "weblogo"   => $cfg_attachment.$cfg_weblogo,
    "hotline"   => $cfg_hotline,
    "time"      => $time
  );

  if($config){
    foreach ($config as $key => $value) {
      $configArr[$key] = $value;
    }
  }

  $return = array();

  //获取通知模板
  $sql = $dsql->SetQuery("SELECT * FROM `#@__site_notify` WHERE `title` = '$notify' AND `state` = 1");
  $ret = $dsql->dsqlOper($sql, "results");
  if($ret){

      $data = $ret[0];

      $title = "";
      $content = "";

      //邮件模板
      if($type == "mail" && $data['email_state']){
          $title = $data['email_title'];
          $content = $data['email_body'];
      }

      //短信模板
      if($type == "sms" && $data['sms_state']){
          $title = $data['sms_tempid'];
          $content = $data['sms_body'];
      }

      //短信模板
      if($type == "wechat" && $data['wechat_state']){
          $title = $data['wechat_tempid'];
          $content = $data['wechat_body'];
      }

      //网页即时消息
      if($type == "site" && $data['site_state']){
          $title = $data['site_title'];
          $content = $data['site_body'];
      }

      //APP推送
      if($type == "app" && $data['app_state']){
          $title = $data['app_title'];
          $content = $data['app_body'];
      }

      if($title || $content){
          foreach ($configArr as $key => $value) {
            if($title){
                $title = str_replace("$".$key, $value, $title);
            }
            if($content){
                $content = str_replace("$".$key, $value, $content);
            }
          }
      }

      return array("title" => $title, "content" => $content);

  }else{
      return array("title" => "", "content" => "");
  }

}


/*
 * 载入脚本、样式
 * @param $type   string 文件类型
 * @param $file   array  文件列表
 */
function includeFile($type, $file = array()){
	global $cfg_attachment;
  global $cfg_basehost;
	$v = "63";
	$f = !empty($file) ? '&f='.join(",", $file) : "";
	$hs = 'http://'.$cfg_basehost.'/include/include.inc.php?t='.$type.$f;
	if($type == 'css'){
		$fileArr = array();
		$fileArr[] = "<link rel='stylesheet' type='text/css' href='http://".$cfg_basehost."/static/css/admin/datetimepicker.css?v=$v' />";
		$fileArr[] = "<link rel='stylesheet' type='text/css' href='http://".$cfg_basehost."/static/css/admin/common.css?v=$v' />";
		$fileArr[] = "<link rel='stylesheet' type='text/css' href='http://".$cfg_basehost."/static/css/admin/bootstrap.css?v=$v' />";
        foreach ($file as $key => $value) {
			$fileArr[] = "<link rel='stylesheet' type='text/css' href='http://".$cfg_basehost."/static/css/".$value."?v=$v' />";
		}
		return join("\r\n", $fileArr)."\r\n<script>var cfg_attachment = '".$cfg_attachment."';</script>";
		//return "<link rel='stylesheet' type='text/css' href='".$hs."' />\r\n<script>var cfg_attachment = '".$cfg_attachment."';</script>";
	}elseif($type == 'js'){
		$fileArr = array();
    // $fileArr[] = "<script>document.domain = '".$cfg_basehost."';</script>";
		$fileArr[] = "<script type='text/javascript' src='http://".$cfg_basehost."/static/js/core/jquery-1.8.3.min.js?v=$v'></script>";
		$fileArr[] = "<script type='text/javascript' src='http://".$cfg_basehost."/static/js/admin/common.js?v=$v'></script>";
		$fileArr[] = "<script type='text/javascript' src='http://".$cfg_basehost."/static/js/ui/jquery.dialog-4.2.0.js?v=$v'></script>";
		foreach ($file as $key => $value) {
			$fileArr[] = "<script type='text/javascript' src='http://".$cfg_basehost."/static/js/".$value."?v=$v'></script>";
		}
		return join("\r\n", $fileArr);

		//return "<script type='text/javascript' src='".$hs."'></script>";
	}elseif($type == 'editor'){
		return "<script type='text/javascript' src='http://".$cfg_basehost."/include/ueditor/ueditor.config.js?v=11'></script>\r\n<script type='text/javascript' src='http://".$cfg_basehost."/include/ueditor/ueditor.all.js?v=11'></script>";
		//return '<script type="text/javascript" src="../../include/include.inc.php?t=include&f=ueditor/ueditor.config.js,ueditor/ueditor.all.js"></script>  <!-- editor -->';
	}
}

/**
 *  清除指定后缀的模板缓存或编译文件
 *
 * @access  public
 * @param  bool       $is_cache  是否清除缓存还是清出编译文件
 * @param  string     $ext       模块名
 *
 * @return int        返回清除的文件个数
 */
function clear_tpl_files($is_cache = true, $admin = false, $ext = ''){
    $dirs = array();

    if ($is_cache){
        $dirs[] = HUONIAOROOT."/templates_c/caches/";
    }else{
		if($admin){
        	$dirs[] = HUONIAOROOT."/templates_c/admin/";
		}
        $dirs[] = HUONIAOROOT."/templates_c/compiled/";
    }

    $str_len = strlen($ext);
    $count   = 0;

    foreach ($dirs AS $dir){
        $folder = @opendir($dir);

        if ($folder === false){
            continue;
        }

        while ($file = readdir($folder)){

            if ($file == '.' || $file == '..' || $file == 'index.htm' || $file == 'index.html'){
                continue;
            }

			if($file == $ext){
				deldir($dir . $file);
				$count++;
			}

        }
        closedir($folder);
    }

    return $count;
}

/**
 * 清除模版编译文件
 *
 * @access  public
 * @param   mix     $ext    模块名
 * @return  void
 */
function clear_compiled_files($ext = '', $admin = false){
    return clear_tpl_files(false, $admin, $ext);
}

/**
 * 清除模板缓存文件
 *
 * @access  public
 * @param   mix     $ext    模块名
 * @return  void
 */
function clear_cache_files($ext = '', $admin = false){
    return clear_tpl_files(true, $admin, $ext);
}

/**
 * 清除模版编译和缓存文件
 *
 * @access  public
 * @param   mix     $ext    模块名
 * @return  void
 */
function clear_all_files($ext = '', $admin = false){
    return clear_tpl_files(false, $admin, $ext) + clear_tpl_files(true, $admin, $ext);
}

//换行格式化
function RpLine($str){
    $str = str_replace("\r", "\\r", $str);
    $str = str_replace("\n", "\\n", $str);
    return $str;
}

/**
 * 域名操作
 *
 * @param string $opera   操作类型  check: 检测是否可用, update: 更新/新增
 * @param string $domain  域名
 * @param string $module  模块
 * @param string $part    栏目
 * @param int    $id      信息ID域名
 * @param int    $expires 过期时间
 * @param string $note    过期提示
 * @return void
 */
function operaDomain($opera, $domain, $module, $part, $id = 0, $expires = 0, $note = ""){

	if(!empty($domain) && !empty($module) && !empty($part)){
		global $cfg_basehost;
		global $dsql;
		global $cfg_holdsubdomain;

		$expires = !empty($expires) ? $expires : 0;

		if($cfg_basehost == $domain) die('{"state": 200, "info": '.json_encode("设置的域名与系统网站域名冲突，请重新输入！").'}');

		$hold = explode("|", $cfg_holdsubdomain);
		if(in_array($domain, $hold)) die('{"state": 200, "info": '.json_encode("设置的域名属于系统保留域名，请重新输入！").'}');

		if(!preg_match("/^([0-9a-z][0-9a-z-.]{0,49})?[0-9a-z]$/", $domain)){
			die('{"state": 2001, "info": '.json_encode("不符合域名规则，请重新输入！<br /><br />提示：<br />1. 域名可由英文字母（不区分大小写）、数字、\"-\"构成；<br />2. 不能使用空格及特殊字符（如!、$、&、?等）；<br />3. \"-\"不能单独填写，不能放在开头或结尾。").'}');
		}

		$dsql = new dsql($dbo);

		//检查是否可用
		if($opera == "check"){

			$archives = $dsql->SetQuery("SELECT `module`, `part`, `iid` FROM `#@__domain` WHERE `domain` = '$domain'");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				if($results[0]['iid'] == $id && $results[0]['module'] == $module && $results[0]['art'] == $art){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
			die;


		//更新/新增
		}elseif($opera == "update"){

			$where = "";
			if(!empty($id)){
				$where = " AND `iid` = ".$id;
			}

			//先检查数据库是否存在
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__domain` WHERE `module` = '$module' AND `part` = '$part'".$where);
			$results = $dsql->dsqlOper($archives, "results");
			//存在
			if($results){

				//更新数据库
				$archives = $dsql->SetQuery("UPDATE `#@__domain` SET `domain` = '$domain', `expires` = '$expires', `note` = '$note' WHERE `module` = '$module' AND `part` = '$part' AND `iid` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					return true;
				}else{
					die('{"state": 200, "info": '.json_encode("系统错误，域名操作失败！").'}');
				}

			//不存在
			}else{

				//新增
				$archives = $dsql->SetQuery("INSERT INTO `#@__domain` (`domain`, `module`, `part`, `iid`, `expires`, `note`) VALUES ('$domain', '$module', '$part', '$id', '$expires', '$note')");
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					return true;
				}else{
					die('{"state": 200, "info": '.json_encode("系统错误，域名操作失败！").'}');
				}

			}

		}

	}else{
		return false;
	}

}

/**
 * 获取指定模块的域名
 * @param string $module  模块
 * @param string $part    栏目
 * @param int    $id      信息ID
 * @return array
 **/
function getDomain($module, $part, $id = 0){

	if(!empty($module) && !empty($part)){
		global $dsql;

		$where = "";
		if(!empty($id)){
			$where = " AND `iid` = ".$id;
		}

		$archives = $dsql->SetQuery("SELECT `domain`, `expires`, `note` FROM `#@__domain` WHERE `module` = '$module' AND `part` = '$part'".$where);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results[0];
		}else{
			return array("domain" => "", "expires" => "", "note" => "");
		}

	}

}

/**
 * 检测用户名是否可注册
 * @param string $username
 * @return string
 **/
function checkMember($username){
	global $cfg_holduser;
	$hold = explode("|", $cfg_holduser);
	if(in_array($username, $hold)) die('{"state": 200, "info": '.json_encode("该用户名归系统保留，请重新输入！").'}');

	$dsql = new dsql($dbo);
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` = '$username'");
	$results = $dsql->dsqlOper($archives, "results");
	if($results){
		return false;
	}else{
		return true;
	}
}

/**
 * 远程抓取
 * @param $uri
 * @param $config
 */
function getRemoteImage($uri, $config, $type, $dirname, $smallImg = false){

    global $customFtp;
    global $custom_ftpState;
    global $custom_ftpDir;
    global $custom_ftpServer;
    global $custom_ftpPort;
    global $custom_ftpUser;
    global $custom_ftpPwd;
    global $custom_ftpUrl;
    global $custom_ftpTimeout;
    global $custom_ftpSSL;
    global $custom_ftpPasv;
    global $custom_OSSBucket;
    global $custom_OSSKeyID;
    global $custom_OSSKeySecret;

    global $editor_uploadDir;
    global $editor_ftpState;
    global $editor_ftpDir;
    global $editor_ftpType;

    if($smallImg){
    	global $cfg_photoSmallWidth;
			global $cfg_photoSmallHeight;
			global $cfg_photoMiddleWidth;
			global $cfg_photoMiddleHeight;
			global $cfg_photoLargeWidth;
			global $cfg_photoLargeHeight;
			global $cfg_photoCutType;
			global $cfg_photoCutPostion;
			global $cfg_quality;
    }

    //忽略抓取时间限制
    set_time_limit(3);
    //ue_separate_ue  ue用于传递数据分割符号
    //$imgUrls = explode("ue_separate_ue", $uri);
    $tmpNames = array();
    foreach ($uri as $imgUrl) {

        $imgUrl = htmlspecialchars($imgUrl);
        $imgUrl = str_replace("&amp;", "&", $imgUrl);

        //http开头验证
        if(strpos($imgUrl, "http") !== 0) {
          //ERROR_HTTP_LINK";
          array_push($tmpNames, array(
            "url" => $imgUrl
          ));
          continue;
        }

        preg_match('/(^https*:\/\/[^:\/]+)/', $imgUrl, $matches);
        $host_with_protocol = count($matches) > 1 ? $matches[1] : '';

        //判断是否是合法 url
        if(!filter_var($host_with_protocol, FILTER_VALIDATE_URL)) {
          //INVALID_URL;
          array_push($tmpNames, array(
            "url" => $imgUrl
          ));
          continue;
        }

        preg_match('/^https*:\/\/(.+)/', $host_with_protocol, $matches);
        $host_without_protocol = count($matches) > 1 ? $matches[1] : '';

        // 此时提取出来的可能是 ip 也有可能是域名，先获取 ip
        $ip = gethostbyname($host_without_protocol);
        // 判断是否是私有 ip
        if(!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
          //INVALID_IP;
          array_push($tmpNames, array(
            "url" => $imgUrl
          ));
          continue;
        }

        //获取请求头并检测死链
        // $heads = @get_headers($imgUrl, 1);
        // if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
        //   //ERROR_DEAD_LINK;
        //   array_push($tmpNames, array(
        //     "url" => $imgUrl
        //   ));
        //   continue;
        // }

        //格式验证(扩展名验证和Content-Type验证)
        // 显示此段将会影响微信头像的抓取，因为微信头像没有后缀，by: guozi 20170505
        $fileType = str_replace(".", "", strtolower(strrchr($imgUrl, '.')));
        $fileType = (empty($fileType) || strlen($fileType) > 4) ? "png" : $fileType;
        // if (!in_array($fileType, $config['allowFiles']) || !isset($heads['Content-Type']) || !stristr($heads['Content-Type'], "image")) {
        //   //ERROR_HTTP_CONTENTTYPE;
        //   array_push($tmpNames, array(
        //     "url" => $imgUrl
        //   ));
        //   continue;
        // }

        //读取文件内容
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $imgUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        $img = curl_exec($curl);
        curl_close($curl);

        if($img === false){
            echo 'Curl error: ' . curl_error($curl) . '<br />' . $imgUrl;die;
        }


        //大小验证
        $uriSize = strlen($img); //得到图片大小
        $allowSize = 1024 * $config['maxSize'];
        if ($uriSize > $allowSize) {
            array_push($tmpNames, array(
                "url" => $imgUrl
            ));
            continue;
        }
        //创建保存位置
        $savePath = $config['savePath'];

        if (!file_exists($savePath)) {
            if(!mkdir("$savePath", 0777, true)){
            	continue;
            };
        }
        //写入文件
        $filename = rand(1, 10000) . time() . '.' . $fileType;
        $tmpName = $savePath . $filename;
        try {
            $fp2 = @fopen($tmpName, "a");
            @fwrite($fp2 , $img);
            @fclose($fp2);

            $filePath = str_replace($dirname.$editor_uploadDir, "", $tmpName);

            //缩小图片
            if($smallImg){
            	$remote = array();
							$imgInfo = array();

							//获取文件信息
							$imageInfo = @getimagesize($tmpName); // 获取文件大小
							$imgInfo["width"] = $imageInfo[0];   // 获取文件宽度
							$imgInfo["height"] = $imageInfo[1];  // 获取文件高度
							$imgInfo["type"] = $imageInfo[2];    // 获取文件类型
							$imgInfo["name"] = $filename;        // 获取文件名称

							$remote['imgInfo']  = $imgInfo;
							$remote['fullName'] = $tmpName;
							$remote['savePath'] = "..".$editor_uploadDir."/siteConfig/photo";

							$up = new upload("" , null, false, true);
							$small  = $up->smallImg($cfg_photoSmallWidth, $cfg_photoSmallHeight, "small", $cfg_quality, $remote);
							$middle = $up->smallImg($cfg_photoMiddleWidth, $cfg_photoMiddleHeight, "middle", $cfg_quality, $remote);
							$large  = $up->smallImg($cfg_photoLargeWidth, $cfg_photoLargeHeight, "large", $cfg_quality, $remote);
            }

            //普通FTP模式
            if($editor_ftpType == 0 && $editor_ftpState == 1){
                $ftpConfig = array();
                if($type != "siteConfig" && $customFtp == 1 && $custom_ftpState == 1){
                    $ftpConfig = array(
                        "on" => $custom_ftpState, //是否开启
                        "host" => $custom_ftpServer, //FTP服务器地址
                        "port" => $custom_ftpPort, //FTP服务器端口
                        "username" => $custom_ftpUser, //FTP帐号
                        "password" => $custom_ftpPwd,  //FTP密码
                        "attachdir" => $custom_ftpDir,  //FTP上传目录
                        "attachurl" => $custom_ftpUrl,  //远程附件地址
                        "timeout" => $custom_ftpTimeout,  //FTP超时
                        "ssl" => $custom_ftpSSL,  //启用SSL连接
                        "pasv" => $custom_ftpPasv  //被动模式连接
                    );
                }

                $huoniao_ftp = new ftp($ftpConfig);
                $huoniao_ftp->connect();
                if($huoniao_ftp->connectid) {
                    $huoniao_ftp->upload(HUONIAOROOT.$editor_uploadDir.$filePath, $editor_ftpDir.$filePath);

                    if($smallImg){
                    	$middleFile = str_replace("large", "middle", $filePath);
											$fileRootUrl = HUONIAOROOT.$editor_uploadDir.$middleFile;
											$huoniao_ftp->upload($fileRootUrl, $editor_ftpDir.$middleFile);

											$smallFile = str_replace("large", "small", $filePath);
											$fileRootUrl = HUONIAOROOT.$editor_uploadDir.$smallFile;
											$huoniao_ftp->upload($fileRootUrl, $editor_ftpDir.$smallFile);
                    }
                }

            //阿里云OSS
            }elseif($editor_ftpType == 1){
                $OSSConfig = array();
                if($type != "siteConfig"){
                    $OSSConfig = array(
                        "bucketName" => $custom_OSSBucket,
                        "accessKey" => $custom_OSSKeyID,
                        "accessSecret" => $custom_OSSKeySecret
                    );
                }

                $aliyunOSS = new aliyunOSS($OSSConfig);
                $aliyunOSS->upload($filePath, HUONIAOROOT.$editor_uploadDir.$filePath);
            }

            global $autoload;
            $autoload = false;
            $dsql = new dsql($dbo);
            $userLogin = new userLogin($dbo);
            $userid = $userLogin->getUserID();

            $attachment = $dsql->SetQuery("INSERT INTO `#@__attachment` (`userid`, `filename`, `filetype`, `filesize`, `path`, `pubdate`) VALUES ('$userid', '".$filename."', 'image', '".$uriSize."', '".$filePath."', '".GetMkTime(time())."')");
            $aid = $dsql->dsqlOper($attachment, "lastid");
            if(!$aid) die('{"state":"数据写入失败！"}');

            $RenrenCrypt = new RenrenCrypt();
            $fid = base64_encode($RenrenCrypt->php_encrypt($aid));


            global $cfg_basehost;
            global $cfg_attachment;
				    $attachmentPath = str_replace("http://".$cfg_basehost, "", $cfg_attachment);
				    $path = $attachmentPath.$fid;

            array_push($tmpNames, array(
                "state" => "SUCCESS",
                "url" => $path,
                "turl" => getFilePath($fid),
                "fid" => $fid,
                "size" => $uriSize,
                "path" => $tmpName,
                "filename" => $filename,
                "source" => htmlspecialchars($imgUrl)
            ));

        } catch (Exception $e) {
            array_push($tmpNames, array(
                "url" => $imgUrl
            ));
        }
    }

    $state = count($tmpNames) ? 'SUCCESS':'ERROR';

    $returnArr = json_encode(array(
        'state'=> $state,
        'list'=> $tmpNames
    ));

    return $returnArr;
}


/**
 * 获取附件的真实地址
 * @param string $file 文件ID
 * @return string *
 */
function getRealFilePath($file){

	global $dsql;
  global $cfg_basehost;
  global $cfg_fileUrl;
  global $cfg_uploadDir;
  global $editor_uploadDir;
  global $cfg_ftpType;
  global $cfg_ftpState;
  global $cfg_ftpUrl;
  global $cfg_ftpDir;
  global $cfg_OSSUrl;

  if(strstr($file, "http")){
	return $file;
  }

  if(strstr($file, ".jpg") || strstr($file, ".jpeg") || strstr($file, ".gif") || strstr($file, ".png") || strstr($file, ".bmp")){
  	return "http://".$cfg_basehost.$cfg_uploadDir.$file;
  }

	$RenrenCrypt = new RenrenCrypt();
	$fid = $RenrenCrypt->php_decrypt(base64_decode($file));

  //如果不是数字类型，则直接返回字段内容，主要用于兼容数据导入
	if(!is_numeric($fid)) return "http://".$cfg_basehost.$cfg_uploadDir.$file;

	$archives = $dsql->SetQuery("SELECT `path` FROM `#@__attachment` WHERE `id` = '$fid'");
	$results = $dsql->dsqlOper($archives, "results");
	if($results){

		$path = $results[0]['path'];
		$module = explode("/", $path);
		$module = $module[1];

		if(empty($editor_uploadDir)){
			$editor_uploadDir = $cfg_uploadDir;
		}

		$incFile = HUONIAOINC."/config/".$module.".inc.php";
		if(!file_exists($incFile)) return;
		require $incFile;

		//模块自定义配置
		if($customFtp == 1){

			//普通FTP模式
			if($custom_ftpType == 0){

				//启用远程FTP
				if($custom_ftpState == 1){
					$site_fileUrl = $custom_ftpUrl.$custom_ftpDir;

				//本地模式
				}else{
					$site_fileUrl = $customUpload == 1 ? "http://".$cfg_basehost.$custom_uploadDir : "http://".$cfg_basehost.$editor_uploadDir;
				}

			//阿里云
			}elseif($custom_ftpType == 1){
				$site_fileUrl = "http://".$custom_OSSUrl;
			}

		//系统默认
		}else{

			//普通FTP模式
			if($cfg_ftpType == 0){

				//启用远程FTP
				if($cfg_ftpState ==1){
					$site_fileUrl = $cfg_ftpUrl.$cfg_ftpDir;

				//本地模式
				}else{
					$site_fileUrl = "http://".$cfg_basehost.$editor_uploadDir;
				}

			//阿里云
			}elseif($cfg_ftpType == 1){
				$site_fileUrl = "http://".$cfg_OSSUrl;
			}

		}

		return $site_fileUrl.$path;

	}

}


/**
 * 获取附件的真实地址
 * @param string $file 文件ID
 * @return string *
 */
function getFilePath($file){
	if(empty($file)) return false;
	global $cfg_hideUrl;
	if($cfg_hideUrl == 1){
		global $cfg_attachment;
		return $cfg_attachment.$file;
	}elseif($cfg_hideUrl == 0){
		return getRealFilePath($file);
	}
}


/**
 * 获取附件不同尺寸
 * @param string $url   文件地址
 * @param string $type  要转换的类型
 * @return string *
 */
function changeFileSize($params){
	extract($params);
	if(empty($url)) return false;
	if(empty($type)) return $url;
	global $cfg_hideUrl;
	if($cfg_hideUrl == 1){
		return $url."&type=".$type;
	}else{
		$file = str_replace("large", $type, $url);
        //判断文件是否存在，如果不存在直接访问原文件
        // if(@fopen($file, 'r')){
        // 	return $file;
        // }else{
        // 	return $url;
        // }
        return $file;
	}
}


/**
 * 判断是否为手机端
 * @return bool
 */
function isMobile(){
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match("/iphone|ios|android|mini|mobile|mobi|Nokia|Symbian|iPod|iPad|Windows\s+Phone|MQQBrowser|wp7|wp8|UCBrowser7|UCWEB|360\s+Aphone\s+Browser|AppleWebKit/", $useragent)){
		return true;
	}else{
		return false;
	}
}

/**
 * 获取URL指定参数值
 * @param string $url 要处理的字符串（默认为当前页面地址）
 * @param string $key 要获取的key值
 * @return string
 */
function getUrlQuery($url, $key) {
	$conf = explode("?", ($url ? $url : $_SERVER['REQUEST_URI']));
	$conf = $conf[1];
	$arr = $conf ? explode("&", $conf) : array();
	foreach($arr as $k => $v){
		$query = explode("=", $arr[$k]);
		if ($query[0] == $key) {
			return $query[1];
		}
	}
	return false;
}

/**
 * 根据出生日期计算年龄
 * @param string $birth 要计算的出生日期（格式：1970-1-1）
 * @return int
 */
function getBirthAge($birth){
	if($birth){
		list($by,$bm,$bd) = explode('-',$birth);
		$cm = date('n');
		$cd = date('j');
		$age = date('Y') - $by - 1;
		if ($cm > $bm || $cm == $bm && $cd > $bd) $age++;
		return $age;
	}
}

/**
 * 取得URL链接地址
 * @param array $params 参数集
 * @return string
 */
function getUrlPath($params){
	extract($params);
  global $dsql;
	global $cfg_urlRewrite;
	global $cfg_basehost;

	//$configInc = HUONIAOINC.'/config/'.$service.'.inc.php';
	$configInc = HUONIAOINC.'/siteModuleDomain.inc.php';

	if(!file_exists($configInc) && $service != "member"){
		return "";
	}

	//系统模块
	if($service == "siteConfig"){
		$domain = "http://".$cfg_basehost;

	}elseif($service != "member"){
		//引入频道配置
		include $configInc;

		$serviceName = $service . "Domain";
		$domain = $$serviceName;

		//获取指定模块的域名
		// $date = GetMkTime(time());
		// $part = !empty($part) ? $part : "config";
		// $domainData = getDomain($service, $part, 0);
		// $domainName = $domainData['domain'];
		// $domain = "http://";

		// //主域名
		// if($customSubDomain == 0){
		// 	$domain .= $domainName;
		// //子域名
		// }elseif($customSubDomain == 1){
		// 	$domain .= $domainName . "." . $cfg_basehost;
		// //子目录
		// }elseif($customSubDomain == 2){
		// 	$domain .= $cfg_basehost . "/" .$domainName;
		// }

    //新闻频道自定义URL
    if($service == "article" || $service == "image"){
      $ser = $service;

      $claFile =  HUONIAOROOT.'/api/handlers/'.$ser.'.class.php';
      if(is_file($claFile)){
          include_once $claFile;
      }else{
          return;
      }

			$articleService = new $ser();
			$articleConfig = $articleService->config();
			$listRule = $articleConfig['listRule'];
			$detailRule = $articleConfig['detailRule'];

      //验证不是跳转类型
      $flag1 = explode(",", $flag);
      if(!in_array("t", $flag1)){

        if($template == "list"){

          $after = "";
      		if(!empty($params['param'])){
      			$after = "?".$params['param'];
      		}

          if(!empty($typeid) && is_numeric($typeid)){

            //查询分类信息
            $sql = $dsql->SetQuery("SELECT `pinyin`, `py` FROM `#@__".$ser."type` WHERE `id` = $typeid");
            $ret = $dsql->dsqlOper($sql, "results");
            if($ret){

              $pinyin = $ret[0]['pinyin'];
              $py     = $ret[0]['py'];

              //分类全拼
              if($listRule == 1){
                return $domain . "/" . $pinyin . "/" . $after;

              //分类首字母
              }elseif($listRule == 2){
                return $domain . "/" . $py . "/" . $after;

              }

            }

          }
        }elseif($template == "detail"){

          //查询分类信息
          $folder = "";
          $sql = $dsql->SetQuery("SELECT t.`pinyin`, t.`py` FROM `#@__".$ser."type` t LEFT JOIN `#@__".$ser."list` l ON l.`typeid` = t.`id` WHERE l.`id` = $id");
          $ret = $dsql->dsqlOper($sql, "results");
          if($ret){
            $pinyin = $ret[0]['pinyin'];
            $py     = $ret[0]['py'];

            //分类全拼
            if($listRule == 1){
              $folder = "/" . $pinyin;

            //分类首字母
            }elseif($listRule == 2){
              $folder = "/" . $py;
            }
          }

          //不需要前缀
          if($detailRule == 1){
            return $domain . $folder . "/" . $id . ".html";
          }else{
            return $domain . $folder . "/detail-" . $id . ".html";
          }

        }

      }


    }

		//团购频道域名配置
		if($service == "tuan"){

			include_once HUONIAOROOT.'/api/handlers/tuan.class.php';

            //团购商品详细页链接，需要根据商品相关信息获取相应的URL
            if(!empty($id) && is_numeric($id)){

                $sql = $dsql->SetQuery("SELECT d.`domain` FROM `#@__tuanlist` l LEFT JOIN `#@__tuan_store` s ON s.`id` = l.`sid` LEFT JOIN `#@__site_area` a ON a.`id` = s.`addrid` LEFT JOIN `#@__tuan_city` c ON c.`cid` = a.`parentid` LEFT JOIN `#@__domain` d ON d.`iid` = c.`id` WHERE d.`module` = 'tuan' AND d.`part` = 'city' AND l.`id` = $id");
                $ret = $dsql->dsqlOper($sql, "results");
                if($ret){

                    global $city;
                    $city = $ret[0]['domain'];
                    $tuanService = new tuan();
        			$domainInfo = $tuanService->getCity();
        			$tuanDomain = $domainInfo['url'];
        			$domain = $tuanDomain;

                }else{

                    //其他例外情况，比如获取商家链接
                    global $city;
                    $tuanService = new tuan();
        			$domainInfo = $tuanService->getCity();
        			$tuanDomain = $domainInfo['url'];
        			$domain = $tuanDomain;

                }

            }else{

                //重置自定义配置
    			$subDomain = $customSubDomain;
    			global $customSubDomain;
    			$customSubDomain = $subDomain;
    			$tuanService = new tuan();
    			$domainInfo = $tuanService->getCity();
    			$tuanDomain = $domainInfo['url'];
    			$domain = $tuanDomain;

            }


      // 此处少验证一种情况
      // 当cookie中没有城市信息时，domain输出为空，这里需要调整为：
      // 如果template为detail时，需要根据传过来的商品ID所属商家的所在城市输出相应的domain


		}

	//会员链接
	}else{

		global $handler;
		$handler = true;
		$configHandels = new handlers("member", "config");
		$moduleConfig  = $configHandels->getHandle();
		if(is_array($moduleConfig) && $moduleConfig['state'] == 100){
			$moduleConfig  = $moduleConfig['info'];
			global $cfg_userSubDomain;
			global $cfg_busiSubDomain;

			$domain = $type == "user" ? $moduleConfig['userDomain'] : $moduleConfig['busiDomain'];
			// if($type == "user"){
			// 	$sub = "";
			// 	if($cfg_userSubDomain == 1){
			// 		$sub = "/u";
			// 	}
			// 	$domain = $moduleConfig['userDomain'].$sub;
			// }else{
			// 	$sub = "";
			// 	if($cfg_busiSubDomain == 1){
			// 		$sub = "/b";
			// 	}
			// 	$domain = $moduleConfig['busiDomain'].$sub;
			// }

			unset($params['type']);

		}else{
			$domain = "http://".$cfg_basehost."/".$service;
		}
	}

	//如果是列表页面，判断页码值是否存在，如果不存在则初始化
	if($template == "list" && empty($page)){
		// $params['page'] = 1;
	}

	$flag = explode(",", $flag);
	//跳转类型
	if(in_array("t", $flag) && $redirecturl){
		return $redirecturl.'" target="_blank';

	//站内类型
	}else{
		$param = array();
		$paramRewrite = array();
		foreach ($params as $key => $value) {
			if($key != "flag" && $key != "redirecturl"){
				if($key == "param"){
					$param[] = $value;
				}else{
					$param[] = $key."=".$value;
				}
				if(($cfg_urlRewrite || $service == "member") && $key != "service" && $key != "param"){
					$paramRewrite[] = $value;
				}
			}
		}

		$after = "";
		if(!empty($params['param'])){
			$after = "?".$params['param'];
		}

		//伪静态
		if($cfg_urlRewrite || $service == "member"){
			if(!empty($paramRewrite)){
                if($service == "website" && (strstr($template, "preview") || strstr($template, "site"))){
                    return $domain."/".$template.($alias ? "/" . $alias . ".html" : "").$after;
                }else {
                    return $domain."/".join("-", $paramRewrite).".html".$after;
                }
			}else{
				return $domain;
			}

		//动态
		}else{
            if($service == "website" && (strstr($template, "preview") || strstr($template, "site"))){
                if(strstr($template, "preview")){
                    return 'http://'.$cfg_basehost.'/website.php?type=template&id='.str_replace("preview", "", $template).($alias ? "&alias=".$alias : "");
                }elseif(strstr($template, "site")){
                    return 'http://'.$cfg_basehost.'/website.php?id='.str_replace("site", "", $template).($alias ? "&alias=".$alias : "");
                }
            }else{
                return 'http://'.$cfg_basehost.'/index.php?'.join("&", $param);
            }
		}
	}

}


/**
 * 取得URL链接地址
 * @param array $params 参数集
 * @param $url  域名前缀 格式：http://domain.com/list.html
 * @param $data 现有参数 格式：a=1&b=2&c=3
 * @param $item 组合参数 格式：item=1:a;2:aa;3:aaa 一组有两个值，用冒号隔开，多个组之间用分号隔开
 * @param $specification 组合参数 格式：specification=1;2;3  多个值之间用分号隔开
 * @param 新参数 a=2 (数组格式)   返回结果会把$data中的a=1更新为a=2
 * @return string
 */
function getUrlParam($params){
	extract($params);
  $paramData = array();

  $ljf = strpos($url, ".html") !== false ? "?" : "&";

  //现有参数
  if($data){
    parse_str($data, $nData);
    foreach ($nData as $k => $v) {
      if($v !== ""){
        $paramData[$k] =$v;
      }
    }
  }


  //新参数&&覆盖旧参数
  // print_r($params);
  foreach ($params as $key => $value) {
    if($key != "url" && $key != "data" && $key != "item" && $key != "specification"){
      if($value !== ""){  //flag为属性值，有为0的情况，这里要排除限制
        $paramData[$key] = $value;
      }else{
        unset($paramData[$key]);
      }
    }
  }


  //特殊情况 item
  //更新：当现有值为：1:a;2:aa;3:aaa时，新传过来的值为：1:b，此时要更新1:a的值为：1:b
  //新增：当现有值为：1:a;2:aa;3:aaa时，新传过来的值为：4:aaaa，此时要更新现有值为：1:a;2:aa;3:aaa;4:aaaa
  //删除：当现有值为：1:a;2:aa;3:aaa时，新传过来的值为：2:0，此时要更新现有值为：1:a;3:aaa;4:aaaa
  if($item !== ""){
    $nItem = explode(":", $item);
    $pItem = $paramData['item'];
    $pItem = !empty($nItem[1]) ? (($pItem ? $pItem . ";" : "") . $item) : $pItem;
    $pItemArr = explode(";", $pItem);
    $pItemArr = array_flip(array_flip($pItemArr));   //去除相同元素
    sort($pItemArr);

    //更新相同级别的选项值
    $nItemArr = array();
    foreach ($pItemArr as $key => $value) {
      $vArr = explode(":", $value);
      if($vArr[0] == $nItem[0]){
        $nItemArr[$vArr[0]] = $nItem[1];
      }else{
        $nItemArr[$vArr[0]] = $vArr[1];
      }
    }

    //组合新的选项值
    $newArr = array();
    foreach ($nItemArr as $key => $value) {
      if(!empty($value)){
        array_push($newArr, $key.":".$value);
      }
    }
    $paramData['item'] = join(";", $newArr);
  }else{
    $paramData['item'] = "";
  }


  //特殊情况 specification
  //情况参考上面的item
  if($specification !== ""){
    $nSpe = explode(":", $specification);
    $pSpe = $paramData['specification'];
    $pSpe = !empty($nSpe[1]) ? (($pSpe ? $pSpe . ";" : "") . $specification) : $pSpe;
    $pSpeArr = explode(";", $pSpe);
    $pSpeArr = array_flip(array_flip($pSpeArr));   //去除相同元素
    sort($pSpeArr);

    //更新相同级别的选项值
    $nSpeArr = array();
    foreach ($pSpeArr as $key => $value) {
      $vArr = explode(":", $value);
      if($vArr[0] == $nSpe[0]){
        $nSpeArr[$vArr[0]] = $nSpe[1];
      }else{
        $nSpeArr[$vArr[0]] = $vArr[1];
      }
    }

    //组合新的选项值
    $newArr = array();
    foreach ($nSpeArr as $key => $value) {
      if(!empty($value)){
        array_push($newArr, $key.":".$value);
      }
    }
    $paramData['specification'] = join(";", $newArr);
  }else{
    $paramData['specification'] = "";
  }

  $param = array();
  if($paramData){
    foreach ($paramData as $key => $value) {
      if($value !== ""){
        array_push($param, $key."=".$value);
      }
    }
  }

  //sort($param);
  $param = $ljf.join("&", $param);
  return $url.$param;
}



/**
 * 打印分页html
 * @param array $params 参数集
 * @return string
 */
function getPageList($params){
	extract($params);

	//引入分页类
	include_once(HUONIAOINC.'/class/pagelist.class.php');

	//获取pageInfo
	global $pageInfo;
	global $typeid;

	$page       = (int)$pageInfo['page'];
	$pageSize   = (int)$pageInfo['pageSize'];
	$totalPage  = (int)$pageInfo['totalPage'];
	$totalCount = (int)$pageInfo['totalCount'];

	$param = array();
	foreach ($params as $key => $value) {
    if($key != "pageType"){
  		$param[$key] = $value;
    }
	}

	if (!array_key_exists("typeid", $params)){
		//$param['typeid'] = $typeid;
	}

  if($pageType != "dynamic"){
  	$param['page'] = "#page#";
  }

	$pageConfig = array(
            'total_rows'=> $totalCount,
            'method'    => 'html',
            'parameter' => getUrlPath($param),
            'now_page'  => $page,
            'list_rows' => $pageSize,
	);
	$page = new pagelist($pageConfig);
	echo  $page->show();

}

/* 内容分页 */
function bodyPageList($params) {
	extract($params);
	global $all;
  $pagesss = '_huoniao_page_break_tag_';  //设定分页标签
  $a = strpos($body, $pagesss);
  if($a && !$all){
	  $con = explode($pagesss, $body);
	  $cons = count($con);
	  @$p = ceil($page);
	  if(!$p || $p<0) $p = 1;
	  // $url = $_SERVER["REQUEST_URI"];
	  // $parse_url = parse_url($url);
	  // $url_query = $parse_url["query"];
	  // if($url_query){
		 //  $url_query = ereg_replace("(^|&)p=$p", "", $url_query);
		 //  $url = str_replace($parse_url["query"], $url_query, $url);
	  // 	if($url_query) $url .= "&p"; else $url .= "p";
	  // }else {
	  // 	$url .= "?p";
	  // }
	  if($cons <= 1) return false;//只有一页时不显示分页
	  $pagenav = '<div class="page fn-clear"><ul>';
	  if($p == 1){
  		$pagenav .= '<li><span class="disabled">上一页</span></li>';
  	}else{
  		$pagenav .= "<li><a href='?p=".($p-1)."'>上一页</a></li>";
  	}
	  for($i = 1; $i <= $cons; $i++){
      if($i == $p){
      	$pagenav .= '<li><span>'.$i.'</span></li>';
      }else{
      	$pagenav .= "<li><a href='?p=$i'>$i</a></li>";
      }
	  }
    if($p == $cons){
  		$pagenav .= '<li><span class="disabled">下一页</span></li>';
  	}else{
  		$pagenav .= "<li><a href='?p=".($p+1)."'>下一页</a></li>";
  	}
  	$pagenav .= "<li><a href='?all=1'>显示全文</a></li>";
	  $pagenav .= "</ul></div>";
	  return $pagenav;
  }
}

/* 打印导航 */
function getChannel($params){
	extract($params);
	global $typeid;
	$pid = 0;
	if($tab){
		$typeName = getParentArr($tab, $typeid);
		$typeName = !empty($typeName) ? array_reverse(parent_foreach($typeName, "id")) : 1;
		$pid = $typeName[0];
	}
	$params['son'] = "1";
	$handler = true;
	$channel = "";
	$moduleHandels = new handlers($service, "type");
	$moduleReturn  = $moduleHandels->getHandle($params);
	if($moduleReturn['state'] == 100 && is_array($moduleReturn['info'])){
		$channel = printChannel($moduleReturn['info'], $pid);
	}
	return $channel;
}

function printChannel($data, $pid = 0){
	$return = "";
	if($data){
		foreach ($data as $key => $value) {
			$lower = $value['lower'];
			$cla = array();
			if($lower){
				$cla[] = "sub";
			}
			if($pid == $value['id']){
				$cla[] = 'on';
			}
			$clas = $cla ? ' class="'.join(" ", $cla).'"' : '';
			$return .= '<li'.$clas.'>';
			$return .= '<a href="'.$value['url'].'">'.$value['typename'].'</a>';
			if($lower){
				$return .= '<ul>';
				$return .= printChannel($lower);
				$return .= '</ul>';
			}
			$return .= '</li>';
		}
	}
	return $return;
}

/* 获取附件后缀名 */
function getAttachType($id){
	if(!empty($id)){
		global $dsql;
		$RenrenCrypt = new RenrenCrypt();
		$id = $RenrenCrypt->php_decrypt(base64_decode($id));

    if(is_numeric($id)){
  		$attachment = $dsql->SetQuery("SELECT `filename` FROM `#@__attachment` WHERE `id` = ".$id);
  		$results = $dsql->dsqlOper($attachment, "results");
  		if($results){
  			$filename = $results[0]['filename'];
  			$filetype = strtolower(strrchr($filename, '.'));
  			return $filetype;
  		}
    }
	}
}

/* 根据文件类型输出不同的内容 */
function getAttachHtml($id = "", $href = "", $title = "", $width = 0, $height = 0, $exp = false, $insert = ""){
	$html = "";
	$width  = !empty($width) ? $width : "100%";
	$height = !empty($height) ? $height : "100%";
	$src    = getFilePath($id); //附件路径

	//验证附件后缀
	global $cfg_hideUrl;
	if($cfg_hideUrl == 1){
		$filetype = getAttachType($id);
	}else{
		$filetype = strtolower(strrchr($src, '.'));
	}

	if($filetype == ".swf"){
		$html = '<embed width="'.$width.'" height="'.$height.'" src="'.$src.'" type="application/x-shockwave-flash" quality="high" wmode="opaque">';
	}else{
		if($href == ""){
			$html = '<a href="javascript:;" style="cursor:default;"><img src="'.$src.'" width="'.$width.'" height="'.$height.'" alt="'.$title.'" />'.(!empty($insert) ? $insert : "").'</a>';
			if($exp){
				$html .= '<p>'.$title.'</p>';
			}
		}else{
			$html = '<a href="'.$href.'" target="_blank"><img src="'.$src.'" width="'.$width.'" height="'.$height.'" alt="'.$title.'" />'.(!empty($insert) ? $insert : "").'</a>';
			if($exp){
				$html .= '<p>'.$title.'<a href="'.$href.'" target="_blank">【详情】</a></p>';
			}
		}
	}
	return $html;
}

/* 静态页面获取当前时间 */
function getMyTime($params, $smarty){
	if(empty($params["format"])) {
    $format = "%b %e, %Y";
  } else {
    $format = $params["format"];
  }

  $rtime = strftime($format, time());

  if($params["type"] == "nongli"){
  	require_once HUONIAOINC.'/class/lunar.class.php';
  	$lunar = new lunar();
  	$rtime = $lunar->S2L($rtime);
  	$rtime = explode("年", $rtime);
  	$rtime = $rtime[1];
  }
  return $rtime;
}

/* 静态页面获取当前星期几 */
function getMyWeek($params, $smarty){
	$prefix = $params['prefix'];
	$week   = !empty($params['date']) ? date("w", strtotime($params['date'])) : date("w");
	$weekarray = array("日","一","二","三","四","五","六");
  return $prefix.$weekarray[$week];
}

/* 天气数据 */
function getWeather($params, $smarty){
	extract($params);
	global $cfg_basehost;

	$day = $day < 1 ? 1 : $day;
	$day = $day > 6 ? 6 : $day;

	$imgUrl = "http://".$cfg_basehost."/static/images/ui/weather/".$skin."/";

	//如果没有传城市名称
	if(empty($city)){

		//先判断系统默认城市
		global $cfg_weatherCity;
		if(!empty($cfg_weatherCity)){
			$city = $cfg_weatherCity;

		//如果系统默认城市为空，则自动获取当前城市
		}else{
			$cityData = getIpAddr(GetIP());
			if($cityData == "本地局域网"){
				$city = "北京";
			}else{
				$cityData = explode("省", $cityData);
				$cityData = explode("市", $cityData[1]);
				$city = $cityData[0];
			}
		}
	}

	//根据城市名获取数据库中的编码
	global $dsql;
	$sql = $dsql->SetQuery("SELECT * FROM `#@__site_area` WHERE `typename` = '$city' AND `weather_code` <> ''");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		$code = $results[count($results)-1]['weather_code'];
	}else{
		$code = '101010100';
	}

	$weatherArr = array();

	// 360
	$url = "http://cdn.weather.hao.360.cn/sed_api_weather_info.php?app=360chrome&code=$code";

	$curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 5);
  $con = curl_exec($curl);
  curl_close($curl);

  if($con){
  	$con = str_replace("callback(", "", $con);
  	$con = str_replace(");", "", $con);
	  $weatherinfo = json_decode($con, true);
	  if(is_array($weatherinfo)){
		  $weatherinfo = $weatherinfo['weather'];
		  for($i = 0; $i < $day; $i++) {
		  	$f = $i + 1;

		  	$info  = $weatherinfo[$i]['info'];

		  	$bday   = $info['day'];
		  	$night = $info['night'];

		  	//白天
		  	$dimg     = $bday[0];
		  	$dweather = $bday[1];
		  	$dtemp    = $bday[2];
		  	$dwind    = $bday[3] == "无持续风向" ? $bday[4] : $bday[3];

		  	//晚上
		  	$nimg     = $night[0];
		  	$nweather = $night[1];
		  	$ntemp    = $night[2];
		  	$nwind    = $night[3] == "无持续风向" ? $night[4] : $night[3];

		  	$weather = $dweather . ($nweather == $dweather ? "" : "转".$nweather);
		  	$temp    = ($ntemp == $dtemp ? "" : $ntemp . "-") . $dtemp . "°C";
		  	$wind    = $dwind . ($nwind == $dwind ? "" : "转".$nwind);

		  	$img = ($dimg !== "" ? '<img src="'.$imgUrl.$dimg.'.png" class="wd" />' : "").($nimg !== "" ? '<img src="'.$imgUrl.$nimg.'.png" class="wn" />' : "");
		  	if($dimg == $nimg){
		  		$img = $dimg !== "" ? '<img src="'.$imgUrl.$dimg.'.png" class="w0" />' : "";
		  	}

		  	$param = array(
		  		"date"   => $weatherinfo['date'],
		  		"prefix" => "周"
		  	);
		  	$date = getMyWeek($param, $smarty);

		  	if($f == 1){
		  		$date = "今天";
		  	}else if($f == 2){
		  		$date = "明天";
		  	}else if($f == 3){
		  		$date = "后天";
		  	}

		  	$weatherArr[$i] = '<li class="weather'.$f.'">
		  		<span class="date">'.$date.'</span>
		  		<span class="pic" title="'.$weather.'">'.$img.'</span>
		  		<span class="weather">'.$weather.'</span>
		  		<span class="temp">'.$temp.'</span>
		  		<span class="wind">'.$wind.'</span>
		  	</li>';
		  }

		}
	}


	// 小米
	// $url = "http://weatherapi.market.xiaomi.com/wtr-v2/weather?cityId=$code";

	// $curl = curl_init();
 //  curl_setopt($curl, CURLOPT_URL, $url);
 //  curl_setopt($curl, CURLOPT_HEADER, 0);
 //  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 //  curl_setopt($curl, CURLOPT_TIMEOUT, 5);
 //  $con = curl_exec($curl);
 //  curl_close($curl);

 //  if($con){
	//   $weatherinfo = json_decode($con, true);
	//   if(is_array($weatherinfo)){
	// 	  $weatherinfo = $weatherinfo['forecast'];
	// 	  for($i = 0; $i < $day; $i++) {
	// 	  	$f = $i + 1;
	// 	  	$d = $i*2+1;
	// 	  	$n = $i*2+2;

	// 	  	$weather = $weatherinfo['weather'.$f];
	// 	  	$temp    = $weatherinfo['temp'.$f];
	// 	  	$wind    = $weatherinfo['wind'.$f];
	// 	  	$dimg    = getWeatherIcon($weatherinfo['img_title'.$d]);
	// 	  	$nimg    = getWeatherIcon($weatherinfo['img_title'.$n]);

	// 	  	$img = ($dimg !== "" ? '<img src="'.$imgUrl.$dimg.'.png" class="wd" />' : "").($nimg !== "" ? '<img src="'.$imgUrl.$nimg.'.png" class="wn" />' : "");
	// 	  	if($dimg == $nimg){
	// 	  		$img = $dimg !== "" ? '<img src="'.$imgUrl.$dimg.'.png" class="w0" />' : "";
	// 	  	}

	// 	  	$param = array(
	// 	  		"date"   => date("Y-m-d", strtotime("+".$i." day")),
	// 	  		"prefix" => "周"
	// 	  	);
	// 	  	$date = getMyWeek($param, $smarty);

	// 	  	if($f == 1){
	// 	  		$date = "今天";
	// 	  	}else if($f == 2){
	// 	  		$date = "明天";
	// 	  	}else if($f == 3){
	// 	  		$date = "后天";
	// 	  	}

	// 	  	$weatherArr[$i] = '<li class="weather'.$f.'">
	// 	  		<span class="date">'.$date.'</span>
	// 	  		<span class="pic" title="'.$weather.'">'.$img.'</span>
	// 	  		<span class="weather">'.$weather.'</span>
	// 	  		<span class="temp">'.$temp.'</span>
	// 	  		<span class="wind">'.$wind.'</span>
	// 	  	</li>';
	// 	  }

	// 	}
	// }

	return join(" ", $weatherArr);
}

//根据天气名称返回相应的图标名
function getWeatherIcon($tit){
	$code = 0;
	switch ($tit) {
		case '晴': $code = 0; break;
		case '多云': $code = 1;	break;
		case '阴': $code = 2; break;
		case '阵雨': $code = 3;	break;
		case '雷阵雨': $code = 4;	break;
		case '雷阵雨伴有冰雹': $code = 5;	break;
		case '雨夹雪': $code = 6;	break;
		case '小雨': $code = 7; break;
		case '中雨': $code = 8;	break;
		case '大雨': $code = 9;	break;
		case '暴雨': $code = 10; break;
		case '大暴雪': $code = 11; break;
		case '特大暴雪': $code = 12; break;
		case '阵雪': $code = 13; break;
		case '小雪': $code = 14; break;
		case '中雪': $code = 15; break;
		case '大雪': $code = 16; break;
		case '暴雪': $code = 17; break;
		case '雾': $code = 18; break;
		case '冻雨': $code = 19; break;
		case '沙尘暴': $code = 20; break;
		case '小雨-中雨': $code = 21; break;
		case '中雨-大雨': $code = 22;	break;
		case '大雨-暴雨':	$code = 23;	break;
		case '暴雨-大暴雨':	$code = 24;	break;
		case '大暴雨-特大暴雨':	$code = 25;	break;
		case '小雪-中雪':	$code = 26;	break;
		case '中雪-大雪':	$code = 27;	break;
		case '大雪-暴雪':	$code = 28;	break;
		case '浮尘': $code = 29; break;
		case '扬沙': $code = 30; break;
		case '强沙尘暴': $code = 31; break;
		case '飑': $code = 32; break;
		case '龙卷风': $code = 33; break;
		case '弱高吹雪': $code = 34; break;
		case '轻雾': $code = 35; break;
		default: $code = 0;	break;
	}
	return $code;
}


/**
 * 数字大小写转换
 *
 */
function numberDaxie($params){
	extract($params);
	$number = substr($number, 0, 2);
	$arr = array("零", "一", "二", "三", "四", "五", "六", "七", "八", "九");
	if(strlen($number) == 1){
		$result = $arr[$number];
	}else{
		if($number == 10){
			$result = "十";
		}else{
			if($number < 20){
				$result = "十";
			}else{
				$result = $arr[substr($number, 0, 1)]."十";
			}
			if(substr($number, 1, 1) != "0"){
				$result .= $arr[substr($number, 1, 1)];
			}
		}
	}
	return $result;
}



/**
 * 获取等比缩放后的值
 * @param int $pic_width   原图宽
 * @param int $pic_height  原图高
 * @param int $maxwidth    最大宽
 * @param int $maxheight   最大高
 *
 */
function resizeImage($pic_width, $pic_height, $maxwidth, $maxheight){
	if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)){
		if($maxwidth && $pic_width > $maxwidth){
			$widthratio = $maxwidth / $pic_width;
			$resizewidth_tag = true;
		}

		if($maxheight && $pic_height > $maxheight){
			$heightratio = $maxheight / $pic_height;
			$resizeheight_tag = true;
		}

		if($resizewidth_tag && $resizeheight_tag){
			if($widthratio < $heightratio){
				$ratio = $widthratio;
			}else{
				$ratio = $heightratio;
			}
		}

		if($resizewidth_tag && !$resizeheight_tag){
			$ratio = $widthratio;
		}
		if($resizeheight_tag && !$resizewidth_tag){
			$ratio = $heightratio;
		}

		$newSize = array(
			"width" => intval($pic_width * $ratio),
			"height" => intval($pic_height * $ratio)
		);

    if($return){
      return $newSize[$return];
    }else{
  		return $newSize;
    }

	}else{
    if($return == "width"){
      return $pic_width;
    }elseif($return == "height"){
      return $pic_height;
    }else{
  		return array("width" => $pic_width, "height" => $pic_height);
    }
  }
}


function resizeImageSize($params){
  extract($params);
  $arr =  resizeImage($pic_width, $pic_height, $maxwidth, $maxheight);
  if($return == "width"){
    return $arr['width'];
  }elseif($return == "height"){
    return $arr['height'];
  }else{
    return $arr;
  }
}


/**
 * 根据图片路径、指定宽度，获取等比缩放后的高度
 * @param string $src   图片路径
 * @param int $width    最大宽度
 */
function getImgHeightByGeometric($params){
  extract($params);
  if(!empty($src) && !empty($width)){
    $img = getimagesize($src);
    $imgSize = resizeImage($img[0], $img[1], $width, $img[1]);
    if($imgSize){
      return $imgSize['height'];
    }
  }
}


/**
	* 对内容进行敏感词过虑
	* @param string $body  需要处理的内容
	* @return string
	*/
function filterSensitiveWords($body){
	if(empty($body)) return "";
	global $cfg_replacestr;
    if(!empty($cfg_replacestr)){
        $replacestr = explode("|", $cfg_replacestr);
    	$badword = array_combine($replacestr, array_fill(0, count($replacestr), '***'));
        return strtr($body, $badword);
    }else{
        return $body;
    }

}


/**
 * 判断点是否在多边形区域内
 * @param array $polygon   多边形坐标集
 * @param array $lnglat    指定坐标点
 * @param return $boolean
 */
function isPointInPolygon($polygon,$lnglat){
  $c = 0;
  $i = $j = 0;
  for ($j = count($polygon) - 1; $i < count($polygon); $j = $i++){
    if (((($polygon[$i][1] <= $lnglat[1]) && ($lnglat[1] < $polygon[$j][1])) ||
      (($polygon[$j][1] <= $lnglat[1]) && ($lnglat[1] < $polygon[$i][1])))
      && ($lnglat[0] < ($polygon[$j][0] - $polygon[$i][0]) * ($lnglat[1] - $polygon[$i][1])/($polygon[$j][1] - $polygon[$i][1]) + $polygon[$i][0]))
    {
      $c = 1;
    }
  }
  return $c;
}



/**
 * 判断一个坐标是否在一个多边形内（由多个坐标围成的）
 * 基本思想是利用射线法，计算射线与多边形各边的交点，如果是偶数，则点在多边形外，否则
 * 在多边形内。还会考虑一些特殊情况，如点在多边形顶点上，点在多边形边上等特殊情况。
 * @param $point 指定点坐标
 * @param $pts 多边形坐标 顺时针方向
 */
function is_point_in_polygon($point, $pts) {
    $N = count($pts);
    $boundOrVertex = true; //如果点位于多边形的顶点或边上，也算做点在多边形内，直接返回true
    $intersectCount = 0;//cross points count of x
    $precision = 2e-10; //浮点类型计算时候与0比较时候的容差
    $p1 = 0;//neighbour bound vertices
    $p2 = 0;
    $p = $point; //测试点

    $p1 = $pts[0];//left vertex
    for ($i = 1; $i <= $N; ++$i) {//check all rays
        // dump($p1);
        if ($p['lng'] == $p1['lng'] && $p['lat'] == $p1['lat']) {
            return $boundOrVertex;//p is an vertex
        }

        $p2 = $pts[$i % $N];//right vertex
        if ($p['lat'] < min($p1['lat'], $p2['lat']) || $p['lat'] > max($p1['lat'], $p2['lat'])) {//ray is outside of our interests
            $p1 = $p2;
            continue;//next ray left point
        }

        if ($p['lat'] > min($p1['lat'], $p2['lat']) && $p['lat'] < max($p1['lat'], $p2['lat'])) {//ray is crossing over by the algorithm (common part of)
            if($p['lng'] <= max($p1['lng'], $p2['lng'])){//x is before of ray
                if ($p1['lat'] == $p2['lat'] && $p['lng'] >= min($p1['lng'], $p2['lng'])) {//overlies on a horizontal ray
                    return $boundOrVertex;
                }

                if ($p1['lng'] == $p2['lng']) {//ray is vertical
                    if ($p1['lng'] == $p['lng']) {//overlies on a vertical ray
                        return $boundOrVertex;
                    } else {//before ray
                        ++$intersectCount;
                    }
                } else {//cross point on the left side
                    $xinters = ($p['lat'] - $p1['lat']) * ($p2['lng'] - $p1['lng']) / ($p2['lat'] - $p1['lat']) + $p1['lng'];//cross point of lng
                    if (abs($p['lng'] - $xinters) < $precision) {//overlies on a ray
                        return $boundOrVertex;
                    }

                    if ($p['lng'] < $xinters) {//before ray
                        ++$intersectCount;
                    }
                }
            }
        } else {//special case when ray is crossing through the vertex
            if ($p['lat'] == $p2['lat'] && $p['lng'] <= $p2['lng']) {//p crossing over p2
                $p3 = $pts[($i+1) % $N]; //next vertex
                if ($p['lat'] >= min($p1['lat'], $p3['lat']) && $p['lat'] <= max($p1['lat'], $p3['lat'])) { //p.lat lies between p1.lat & p3.lat
                    ++$intersectCount;
                } else {
                    $intersectCount += 2;
                }
            }
        }
        $p1 = $p2;//next ray left point
    }

    if ($intersectCount % 2 == 0) {//偶数在多边形外
        return false;
    } else { //奇数在多边形内
        return true;
    }
}



//获取会员详情
function getMemberDetail($id){
    $detail = array();
    $handlers = true;
    $memberHandels = new handlers("member", "detail");
    $memberConfig  = $memberHandels->getHandle($id);
    if(is_array($memberConfig) && $memberConfig['state'] == 100){
    $memberConfig  = $memberConfig['info'];
       $detail = $memberConfig;
    }
    return $detail;
}

//验证信息是否已经收藏
function checkIsCollect($param){
    $handlers = true;
    $Handels = new handlers("member", "collect");
    $return  = $Handels->getHandle($param);
    if(is_array($return) && $return['state'] == 100){
        $returns = $return['info'];
        return $returns;
    }
}



/**
 * 后台消息通知
 * @param $module 模块
 * @param $part   栏目
 */
function updateAdminNotice($module, $part){

    global $dsql;
    $sql = $dsql->SetQuery("INSERT INTO `#@__site_admin_notice` (`module`, `part`) VALUES ('$module', '$part')");
    $dsql->dsqlOper($sql, "update");

}



/**
 * 前台会员消息通知
 * @param $module 模块
 * @param $part   栏目
 */
function updateMemberNotice($uid, $notify, $param = array(), $config = array()){
    global $dsql;
    if(!$uid) return;

    //查询会员信息
    $sql = $dsql->SetQuery("SELECT `phone`, `phoneCheck`, `email`, `emailCheck`, `wechat_openid` FROM `#@__member` WHERE `id` = $uid AND `state` = 1");
    $ret = $dsql->dsqlOper($sql, "results");
    if(!$ret) return;

    $phone = $ret[0]['phone'];
    $phoneCheck = $ret[0]['phoneCheck'];
    $email = $ret[0]['email'];
    $emailCheck = $ret[0]['emailCheck'];
    $wechat_openid = $ret[0]['wechat_openid'];

    //信息URL
    $url = "";
    if($param){
        $url = getUrlPath($param);
        $config['url'] = $url;
    }

    //邮件通知
    if($email && $emailCheck){
        $cArr = getInfoTempContent("mail", $notify, $config);
        $title = $cArr['title'];
        $content = $cArr['content'];
        if($title || $content){
            sendmail($email, $title, $content);
        }
    }

    //短信通知
    if($phone && $phoneCheck){
        sendsms($phone, 1, "", "", false, false, $notify, $config);
    }

    //微信公众号
    if($wechat_openid){
        $cArr = getInfoTempContent("wechat", $notify, $config);
        $title = $cArr['title'];
        $content = $cArr['content'];
        if($title || $content){
            sendwechat($wechat_openid, $title, $content, $url);
        }
    }

    //网页即时消息
    $cArr = getInfoTempContent("site", $notify, $config);
    $title = $cArr['title'];
    $content = $cArr['content'];
    if($title != "" || $content != ""){
        $time = GetMkTime(time());
        $urlParam = serialize($param);
        $log = $dsql->SetQuery("INSERT INTO `#@__member_letter` (`admin`, `type`, `title`, `body`, `urlParam`, `success`, `date`) VALUE ('0', '0', '$title', '$content', '$urlParam', 1, '$time')");
        $lid = $dsql->dsqlOper($log, "lastid");
        if(!is_numeric($lid)) return;

        $sql = $dsql->SetQuery("INSERT INTO `#@__member_letter_log` (`lid`, `uid`, `state`, `date`) VALUE ('$lid', '$uid', 0, 0)");
        $ret = $dsql->dsqlOper($sql, "update");
    }

    //APP推送
    $cArr = getInfoTempContent("app", $notify, $config);
    $title = $cArr['title'];
    $content = $cArr['content'];
    if($title || $content){
        sendapppush($uid, $title, $content, $url);
    }

}



/**
 * 发送微信模板消息
 * @param $conn    会员绑定的微信公众平台唯一ID
 * @param $tempid  微信消息模板ID
 * @param $config  配置数据
 * @param $url     点击后跳转的位置
 */
function sendwechat($conn, $tempid, $config, $url){

    $msgData = '{"touser":"'.$conn.'", "template_id":"'.$tempid.'", "url":"'.$url.'", "data": '.$config.'}';

    //引入配置文件
	$wechatConfig = HUONIAOINC."/config/wechatConfig.inc.php";
	if(!file_exists($wechatConfig)) return '{"state": 200, "info": "请先设置微信开发者信息！"}';
	require($wechatConfig);

	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$cfg_wechatAppid&secret=$cfg_wechatAppsecret";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $output = curl_exec($ch);
    curl_close($ch);
    if(empty($output)){
		return '{"state": 200, "info": "Token获取失败，请检查微信开发者帐号配置信息！"}';
	}
    $result = json_decode($output, true);
	if(isset($result['errcode'])) {
		return '{"state": 200, "info": "'.$result['errcode']."：".$result['errmsg'].'"}';
	}

    $token = $result['access_token'];

    //发送模板消息
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $msgData);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $output = curl_exec($ch);
    curl_close($ch);
	if(empty($output)){
		return '{"state": 200, "info": "请求失败，请稍候重试！"}';
	}
	$result = json_decode($output, true);
    if(isset($result['errcode'])) {
		return '{"state": 200, "info": "'.getWechatMsgErrCode($result['errcode']).'"}';
	}

	return '{"state": 100, "info": "发送成功！"}';
}


//根据返回码取中文说明
function getWechatMsgErrCode($code){
	$info = "未知错误！";
	switch ($code) {
        case -1: $info = "系统繁忙"; break;
        case 0: $info = "请求成功"; break;
        case 40001: $info = "验证失败"; break;
        case 40002: $info = "不合法的凭证类型"; break;
        case 40003: $info = "不合法的OpenID"; break;
        case 40004: $info = "不合法的媒体文件类型"; break;
        case 40005: $info = "不合法的文件类型"; break;
        case 40006: $info = "不合法的文件大小"; break;
        case 40007: $info = "不合法的媒体文件id"; break;
        case 40008: $info = "不合法的消息类型"; break;
        case 40009: $info = "不合法的图片文件大小"; break;
        case 40010: $info = "不合法的语音文件大小"; break;
        case 40011: $info = "不合法的视频文件大小"; break;
        case 40012: $info = "不合法的缩略图文件大小"; break;
        case 40013: $info = "不合法的APPID"; break;
        case 41001: $info = "缺少access_token参数"; break;
        case 41002: $info = "缺少appid参数"; break;
        case 41003: $info = "缺少refresh_token参数"; break;
        case 41004: $info = "缺少secret参数"; break;
        case 41005: $info = "缺少多媒体文件数据"; break;
        case 41006: $info = "access_token超时"; break;
        case 42001: $info = "需要GET请求"; break;
        case 43002: $info = "需要POST请求"; break;
        case 43003: $info = "需要HTTPS请求"; break;
        case 44001: $info = "多媒体文件为空"; break;
        case 44002: $info = "POST的数据包为空"; break;
        case 44003: $info = "图文消息内容为空"; break;
        case 45001: $info = "多媒体文件大小超过限制"; break;
        case 45002: $info = "消息内容超过限制"; break;
        case 45003: $info = "标题字段超过限制"; break;
        case 45004: $info = "描述字段超过限制"; break;
        case 45005: $info = "链接字段超过限制"; break;
        case 45006: $info = "图片链接字段超过限制"; break;
        case 45007: $info = "语音播放时间超过限制"; break;
        case 45008: $info = "图文消息超过限制"; break;
        case 45009: $info = "接口调用超过限制"; break;
        case 46001: $info = "不存在媒体数据"; break;
        case 47001: $info = "解析JSON/XML内容错误"; break;
	}
	return $info;
}



/**
 * APP推送消息
 * @param $uid     会员id
 * @param $title   消息标题
 * @param $body    消息内容
 * @param $url     跳转地址
 */
function sendapppush($uid, $title, $body, $url){
    if(!$uid || $uid < 1) return;

    global $dsql;

    //推送消息给骑手
    aliyunPush($uid, $title, $body, "default", $url);
    return;

    //查询会员未读消息数量
    $sql = $dsql->SetQuery("SELECT log.`id` FROM `#@__member_letter_log` log LEFT JOIN `#@__member_letter` l ON l.`id` = log.`lid` WHERE log.`state` = 0 AND l.`type` = 0 AND log.`uid` = $uid");
    $msgnum = $dsql->dsqlOper($sql, "totalCount");

    //查询推送配置
    $android_access_id = $android_access_key = $android_secret_key = $ios_access_id = $ios_access_key = $ios_secret_key = "";
    $sql = $dsql->SetQuery("SELECT * FROM `#@__app_push_config` LIMIT 0, 1");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        $data = $ret[0];
        $android_access_id = $data['android_access_id'];
        $android_access_key =  $data['android_access_key'];
        $android_secret_key =  $data['android_secret_key'];
        $ios_access_id =  $data['ios_access_id'];
        $ios_access_key =  $data['ios_access_key'];
        $ios_secret_key = $data['ios_secret_key'];
    }

    require_once(HUONIAOINC . '/class/umeng/AndroidCustomizedcast.php');
    require_once(HUONIAOINC . '/class/umeng/IOSCustomizedcast.php');

    //安卓推送
    $customizedcast = new AndroidCustomizedcast();
    $customizedcast->setAppMasterSecret($android_secret_key);
    $customizedcast->setPredefinedKeyValue("appkey", $android_access_key);
    $customizedcast->setPredefinedKeyValue("timestamp", strval(time()));
    $customizedcast->setPredefinedKeyValue("alias", $uid);
    $customizedcast->setPredefinedKeyValue("alias_type", "userID");
    $customizedcast->setPredefinedKeyValue("ticker", $title);
    $customizedcast->setPredefinedKeyValue("title", $title);
    $customizedcast->setPredefinedKeyValue("text", $body);
    $customizedcast->setPredefinedKeyValue("after_open", "go_app");
    $customizedcast->setExtraField("url", $url);
    $customizedcast->send();

    //ios推送
    $customizedcast = new IOSCustomizedcast();
    $customizedcast->setAppMasterSecret($ios_secret_key);
    $customizedcast->setPredefinedKeyValue("appkey", $ios_access_key);
    $customizedcast->setPredefinedKeyValue("timestamp", strval(time()));
    $customizedcast->setPredefinedKeyValue("alias", $uid);
    $customizedcast->setPredefinedKeyValue("alias_type", "userID");
    $customizedcast->setPredefinedKeyValue("alert", $body);
    $customizedcast->setPredefinedKeyValue("badge", $msgnum);
    $customizedcast->setPredefinedKeyValue("sound", "chime");
    $customizedcast->setPredefinedKeyValue("production_mode", "true");
    $customizedcast->setCustomizedField("url", $url);
    $customizedcast->send();
}



/**
 * 创建支付中转页面
 * @param $service  所属频道
 * @param $ordernum 订单号
 * @param $price    订单金额
 * @param $paytype  支付方式
 * @return html
 */
function createPayForm($service, $ordernum, $price, $paytype, $subject){
	if(!empty($service) && !empty($ordernum) && !empty($price) && !empty($paytype)){

		global $cfg_shortname;
		global $dsql;
		global $userLogin;

		$paytype = explode("$", $paytype);
		$paycode = $paytype[0];
		$bank = $paytype[1];

		$paymentFile = HUONIAOROOT."/api/payment/$paycode/$paycode.php";

		//验证支付类文件是否存在
		if(file_exists($paymentFile)){
			require_once($paymentFile);

			$archives = $dsql->SetQuery("SELECT `pay_config` FROM `#@__site_payment` WHERE `pay_code` = '$paycode' AND `state` = 1");
			$payment   = $dsql->dsqlOper($archives, "results");
			if($payment){

				$pay_config = unserialize($payment[0]['pay_config']);
				$paymentArr = array();

				//验证配置
				foreach ($pay_config as $key => $value) {
					if(!empty($value['value'])){
						$paymentArr[$value['name']] = $value['value'];
					}
				}

				if(!empty($paymentArr)){
        //   global $autoload;
        //   $autoload = true;
					$pay = new $paycode();
					$order = array();
					$order_sn = create_ordernum();

					$order['service']      = $service;
					$order['order_amount'] = $price;
					$order['order_sn']     = $order_sn;
					$order['subject']      = $cfg_shortname."_".$subject;
					$order['bank']         = $bank;

					//向数据库插入记录
					$userid = $userLogin->getMemberID();

					//删除当前订单没有支付的历史记录
					$sql = $dsql->SetQuery("DELETE FROM `#@__pay_log` WHERE `body` = '$ordernum' AND `state` = 0");
					$dsql->dsqlOper($sql, "update");


					$date = GetMkTime(time());
					$archives = $dsql->SetQuery("INSERT INTO `#@__pay_log` (`ordertype`, `ordernum`, `uid`, `body`, `amount`, `paytype`, `state`, `pubdate`) VALUES ('$service', '$order_sn', '$userid', '$ordernum', '$price', '$paycode', 0, $date)");
					$dsql->dsqlOper($archives, "results");

					echo $pay->get_code($order, $paymentArr);die;

				}else{
					die("配置错误，请联系管理员000！");
				}


			}else{
				die("支付方式不存在，001！");
			}

		}else{
			die("支付方式不存在，002！");
		}


	}else{
    die("配置错误，请联系管理员003！");
  }

}



/**
 * 数组排序
 * @param $arrays     要操作的数组
 * @param $sort_key   指定的键值
 * @param $sort_order 排列顺序  SORT_ASC、SORT_DESC
 * @param $sort_type  排序类型  SORT_REGULAR、SORT_NUMERIC、SORT_STRING
 * @return array
 */
function array_sortby($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC){
  if(is_array($arrays)){
    foreach ($arrays as $array){
      if(is_array($array)){
        $key_arrays[] = $array[$sort_key];
      }else{
        return false;
      }
    }
  }else{
    return false;
  }
  array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
  return $arrays;
}



/**
 * 拼接运费详细
 * @param $bearFreight           是否包邮 0：自定义  1：免费
 * @param $valuation             计价方式 0：按件  1：按重量  2：按体积
 * @param $express_start         默认运费几件以内
 * @param $express_postage       默认运费
 * @param $express_plus          递增数量
 * @param $express_postageplus   递增费用
 * @param $preferentialStandard  超过数量免费
 * @param $preferentialMoney     超过费用免费
 * @return string
 */
function getPriceDetail($bearFreight, $valuation, $express_start, $express_postage, $express_plus, $express_postageplus, $preferentialStandard, $preferentialMoney){
	$ret = "";
	if($bearFreight == 0){

		$val = "";
		switch ($valuation) {
			case 0:
				$val = "件";
				break;
			case 1:
				$val = "kg";
				break;
			case 2:
				$val = "m³";
				break;
		}

		$ret = "运费：".$express_start.$val."内".$express_postage."元";

    if($express_plus > 0){
      $ret .= "，每增加".$express_plus.$val."，加".$express_postageplus."元";
    }

		if($preferentialStandard > 0 && $preferentialMoney > 0){
			$ret .= "（满".$preferentialStandard.$val."，并且满".$preferentialMoney."元免邮费）";
		}elseif($preferentialStandard > 0){
			$ret .= "（满".$preferentialStandard.$val."免邮费）";
		}elseif($preferentialMoney > 0){
			$ret .= "（满".$preferentialMoney."元免邮费）";
		}

	}else{
		$ret = "免邮费";
	}
	return $ret;
}



/**
 * 计算运费
 * @param $config: 运费配置信息
 * @param $price: 单价
 * @param $count: 商品数量
 * @param $volume: 体积
 * @param $weight: 重量
 * @return int
 */
function getLogisticPrice($config, $price, $count, $volume, $weight){

	$bearFreight          = $config['bearFreight'];
	$valuation            = $config['valuation'];
	$express_start        = $config['express_start'];
	$express_postage      = $config['express_postage'];
	$express_plus         = $config['express_plus'];
	$express_postageplus  = $config['express_postageplus'];
	$preferentialStandard = $config['preferentialStandard'];
	$preferentialMoney    = $config['preferentialMoney'];

	if($bearFreight == 1) return 0;

	//总价
	$totalPrice = $price * $count;

	$logistic = 0;

	//计费对象
	$obj = $count;
	$ncount = $count;

	//按重量
	if($valuation == 1){
		$obj = $weight * $count;
		$ncount = $count * $weight;

	//按体积
	}elseif($valuation == 2){
		$obj = $volume * $count;
		$ncount = $count * $volume;
	}

	//默认运费
	$logistic += $express_postage;

	//续加
	if($express_start > 0){
		$postage = $obj - $express_start;
		if($postage > 0 && $express_plus > 0){
			$logistic += floor($postage/$express_plus) * $express_postageplus;
		}
	}

	//免费政策
	if(!empty($preferentialStandard) && $ncount >= $preferentialStandard && !empty($preferentialMoney) && $totalPrice >= $preferentialMoney){
		$logistic = 0;
	}elseif(($preferentialStandard > 0 && $ncount >= $preferentialStandard && $preferentialMoney == 0) || ($preferentialMoney > 0 && $totalPrice >= $preferentialMoney && $preferentialStandard == 0)){
		$logistic = 0;
	}

	return $logistic;

}



/**
  * 更新htaccess静态规则文件
  */
function updateHtaccess(){

  global $dsql;
  global $cfg_basehost;
  global $cfg_userSubDomain;
  global $cfg_busiSubDomain;
  global $handler;

  $handler = true;

  //规则组合文件
  //1. 系统默认  defaultRules.text
  //2. 会员模块  一级、二级域名：domainRules.txt  子目录：catalogRules.txt
  //3. 其他模块规则需查询数据库   一级、二级域名：domainRules   子目录：catalogRules

  $htaccess = '';

  //系统默认
  $defaultRules = HUONIAODATA."/admin/defaultRules.txt";
	if(filesize($defaultRules)>0){
		$fp = fopen($defaultRules,'r');
		$str = fread($fp, filesize($defaultRules));

    $nw_domain = str_replace("www.", "", $cfg_basehost);
    $str = preg_replace("/\#nw_domain\#/", $nw_domain, $str);

    $htaccess .= "#系统默认\r\n".$str;
		fclose($fp);
	}

    //商家
  	$configHandels = new handlers("business", "config");
  	$moduleConfig  = $configHandels->getHandle();
  	$moduleConfig  = $moduleConfig['info'];

    //域名
    $channelDomain = $moduleConfig['channelDomain'];
    $cfg_basehost_ = str_replace("www.", "", $cfg_basehost);
    $domain = str_replace($cfg_basehost_, "", str_replace("http://", "", $channelDomain));

    //绑定子域名需要将www.删除
    if($moduleConfig['subDomain']){
      $domain = str_replace("www.", "", $domain);
    }

    //域名类型
    $subDomain = $moduleConfig['subDomain'];
    if($subDomain) $domain = preg_replace("/[\.\/]/", "", $domain);
    if($subDomain == 1) $domain .= '.'.$cfg_basehost_;

    if($subDomain == 0 || $subDomain == 1){
        $businessDomainRules = HUONIAODATA."/admin/businessDomainRules.txt";
    }else{
        $businessDomainRules = HUONIAODATA."/admin/businessCatalogRules.txt";
    }
    if(filesize($businessDomainRules)>0){
		$fp = fopen($businessDomainRules, 'r');
		$str = fread($fp, filesize($businessDomainRules));
        $str = preg_replace("/\#domain\#/", $domain, $str);
        $htaccess .= "\r\n"."#商家\r\n".$str;
		fclose($fp);
	}



    //会员
	$configHandels = new handlers("member", "config");
	$moduleConfig  = $configHandels->getHandle();
	$moduleConfig  = $moduleConfig['info'];



  //兼容主域名是带www的情况
  $cfg_basehost_ = str_replace("www.", "", $cfg_basehost);
  $userDomain = str_replace($cfg_basehost_, "", str_replace("http://", "", str_replace("www.", "", $moduleConfig['userDomain'])));
	$busiDomain = str_replace($cfg_basehost_, "", str_replace("http://", "", str_replace("www.", "", $moduleConfig['busiDomain'])));

  //删除二级域名、子目录名称中的 .
	if($cfg_userSubDomain) $userDomain = preg_replace("/[\.\/]/", "", $userDomain);
	if($cfg_busiSubDomain) $busiDomain = preg_replace("/[\.\/]/", "", $busiDomain);

  //二级域名的情况拼接成完整域名
  if($cfg_userSubDomain == 1) $userDomain .= '.'.$cfg_basehost_;
  if($cfg_busiSubDomain == 1) $busiDomain .= '.'.$cfg_basehost_;


  //企业会员伪静态规则
  if($cfg_busiSubDomain == 0 || $cfg_busiSubDomain == 1){
    $busiDomainRules = HUONIAODATA."/admin/busiDomainRules.txt";
  }else{
    $busiDomainRules = HUONIAODATA."/admin/busiCatalogRules.txt";
  }
	if(filesize($busiDomainRules)>0){
		$fp = fopen($busiDomainRules,'r');
		$str = fread($fp, filesize($busiDomainRules));
        $str = preg_replace("/\#busi\#/", $busiDomain, $str);
        $htaccess .= "\r\n"."#企业会员\r\n".$str;
		fclose($fp);
	}

  //个人会员伪静态规则
  if($cfg_userSubDomain == 0 || $cfg_userSubDomain == 1){
    $userDomainRules = HUONIAODATA."/admin/userDomainRules.txt";
  }else{
    $userDomainRules = HUONIAODATA."/admin/userCatalogRules.txt";
  }
	if(filesize($userDomainRules)>0){
		$fp = fopen($userDomainRules,'r');
		$str = fread($fp, filesize($userDomainRules));
    $str = preg_replace("/\#user\#/", $userDomain, $str);
    $htaccess .= "\r\n"."#个人会员\r\n".$str;
		fclose($fp);
	}


  //频道模块伪静态规则
  $sql = $dsql->SetQuery("SELECT `title`, `name`, `domainRules`, `catalogRules` FROM `#@__site_module` WHERE `state` = 0 AND `name` != '' ORDER BY `weight` ASC");
  $ret = $dsql->dsqlOper($sql, "results");
  if($ret){
    foreach ($ret as $key => $value) {

      $sTitle       = $value['title'];
      $sName        = $value['name'];
      $domainRules  = $value['domainRules'];
      $catalogRules = $value['catalogRules'];

      //获取功能模块配置参数
      $configHandels = new handlers($sName, "config");
      $moduleConfig  = $configHandels->getHandle();

      if(is_array($moduleConfig) && $moduleConfig['state'] == 100){
        $moduleConfig  = $moduleConfig['info'];

        //域名
        $channelDomain = $moduleConfig['channelDomain'];
        $cfg_basehost_ = str_replace("www.", "", $cfg_basehost);
        $domain = str_replace($cfg_basehost_, "", str_replace("http://", "", $channelDomain));

        //绑定子域名需要将www.删除
        if($moduleConfig['subDomain']){
          $domain = str_replace("www.", "", $domain);
        }

        //域名类型
        $subDomain = $moduleConfig['subDomain'];
        if($subDomain) $domain = preg_replace("/[\.\/]/", "", $domain);
        if($subDomain == 1) $domain .= '.'.$cfg_basehost_;


        //新闻模块自定义URL
        if($sName == "article" || $sName == "image"){

          //列表页自定义
          $listRule = $moduleConfig['listRule'];

          //分类全拼||首字母
          if($listRule == 1 || $listRule == 2){

            $pinyin = $listRule == 2 ? "py" : "pinyin";

            if($subDomain == 0 || $subDomain == 1){
              $domainRules = str_replace("^list-(\d+)-(\d+).html$", "^(?!.*php)(?!.*html)(.*)/?$", $domainRules);
              $domainRules = str_replace("^list-(\d+).html$", "^(.*)/index.html$", $domainRules);

              $domainRules = str_replace("&typeid=$1&page=$2", "&".$pinyin."=$1", $domainRules);
              $domainRules = str_replace("&typeid=$1", "&".$pinyin."=$1", $domainRules);

            }else{
              $catalogRules = str_replace("list-(\d+)-(\d+).html$", "(?!.*php)(?!.*html)(.*)/?$", $catalogRules);
              $catalogRules = str_replace("list-(\d+).html$", "(.*)/index.html$", $catalogRules);

              $catalogRules = str_replace("&typeid=$1&page=$2", "&".$pinyin."=$1", $catalogRules);
              $catalogRules = str_replace("&typeid=$1", "&".$pinyin."=$1", $catalogRules);
            }

          }

          //文章页
          $detailRule = $moduleConfig['detailRule'];
          if($detailRule == 1){

            if($subDomain == 0 || $subDomain == 1){
              $domainRules = str_replace("^detail-(\d+).html$", "^(\d+).html$", $domainRules);
            }else{
              $catalogRules = str_replace("detail-(\d+).html$", "(\d+).html$", $catalogRules);
            }

          }

        }


        //一级、二级域名
        if($subDomain == 0 || $subDomain == 1){
          $str = preg_replace("/\#domain\#/", $domain, $domainRules);
        }else{
          $str = preg_replace("/\#domain\#/", $domain, $catalogRules);
        }

        $htaccess .= "\r\n\r\n"."#".$sTitle."\r\n".$str;

      }

      //新闻频道增加图片频道
    //   if($sName == "article"){
    //     $sTitle = "图片频道";
    //     $sName = "pic";
      //
    //     //获取功能模块配置参数
    //     $configHandels = new handlers($sName, "config");
    //     $moduleConfig  = $configHandels->getHandle();
      //
    //     if(is_array($moduleConfig) && $moduleConfig['state'] == 100){
    //       $moduleConfig  = $moduleConfig['info'];
      //
    //       //域名
    //       $channelDomain = $moduleConfig['channelDomain'];
    //       $cfg_basehost_ = str_replace("www.", "", $cfg_basehost);
    //       $domain = str_replace($cfg_basehost_, "", str_replace("http://", "", $channelDomain));
      //
    //       if($moduleConfig['subDomain']){
    //         $domain = str_replace("www.", "", $domain);
    //       }
      //
    //       //域名类型
    //       $subDomain = $moduleConfig['subDomain'];
    //       if($subDomain) $domain = preg_replace("/[\.\/]/", "", $domain);
    //       if($subDomain == 1) $domain .= '.'.$cfg_basehost_;
      //
    //       //一级、二级域名
    //       if($subDomain == 0 || $subDomain == 1){
    //         $str = preg_replace("/\#domain\#/", $domain, $domainRules);
    //         $str = preg_replace("/service=article/", "service=pic", $domainRules);
    //       }else{
    //         $str = preg_replace("/\#domain\#/", $domain, $catalogRules);
    //         $str = preg_replace("/service=article/", "service=pic", $catalogRules);
    //       }
      //
    //       $htaccess .= "\r\n\r\n"."#".$sTitle."\r\n".$str;
      //
    //     }
    //   }


    }
  }

  $customIncFile = HUONIAOROOT."/.htaccess";
  $fp = @fopen($customIncFile, "w");
  //$str = fread($fp, filesize($customIncFile));
  @fwrite($fp, $htaccess);
  @fclose($fp);

}



//Geetest 极验验证码验证
function verifyGeetest($challenge, $validate, $seccode, $type = "pc"){
    global $cfg_geetest_pc_id;
    global $cfg_geetest_pc_key;
    global $cfg_geetest_mobile_id;
    global $cfg_geetest_mobile_key;
    global $userLogin;

    $userid = $_SESSION['user_id'];

	global $handler;
	$handler = false;

    if($type == "pc"){
        $GtSdk = new geetestlib($cfg_geetest_pc_id, $cfg_geetest_pc_key);
    }else{
        $GtSdk = new geetestlib($cfg_geetest_mobile_id, $cfg_geetest_mobile_key);
    }

    //服务器正常
    if($_SESSION['gtserver'] == 1) {
        $result = $GtSdk->success_validate($challenge, $validate, $seccode, $userid);
        if ($result) {
            return '{"status":"success"}';
        } else{
            return '{"status":"fail"}';
        }
    }else{  //服务器宕机,走failback模式
        if ($GtSdk->fail_validate($challenge, $validate, $seccode)) {
            return '{"status":"success"}';
        }else{
            return '{"status":"fail"}';
        }
    }


}



//更新APP配置文件
function updateAppConfig(){

    global $dsql;
    global $cfg_basehost;
    global $cfg_webname;
    global $cfg_shortname;

    //引导页
    $android_guide = array();
    $ios_guide = array();

    //广告
    $ad_pic = $ad_link = $ad_time = "";

    //登录
    $qq_appid = $qq_appkey = $wechat_appid = $wechat_appsecret = $sina_akey = $sina_skey = "";

    //APP配置参数
    $sql = $dsql->SetQuery("SELECT * FROM `#@__app_config` LIMIT 1");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        $data = $ret[0];

        $android           = $data['android_guide'];
        $ios               = $data['ios_guide'];
        $android_index     = $data['android_index'];
        $ios_index         = $data['ios_index'];
        $map_baidu_android = $data['map_baidu_android'];
        $map_baidu_ios     = $data['map_baidu_ios'];
        $map_google        = $data['map_google'];
        $map_set           = $data['map_set'];

        //安卓引导页
        if(!empty($android)){
            $androidArr = explode(",", $android);
            foreach ($androidArr as $key => $value) {
                array_push($android_guide, getFilePath($value));
            }
        }

        //IOS引导页
        if(!empty($ios)){
            $iosArr = explode(",", $ios);
            foreach ($iosArr as $key => $value) {
                array_push($ios_guide, getFilePath($value));
            }
        }

        $ad_pic = $data['ad_pic'] ? getFilePath($data['ad_pic']) : "";
        $ad_link = $data['ad_link'];
        $ad_time = $data['ad_time'];
    }

    //登录配置参数
    $sql = $dsql->SetQuery("SELECT `code`, `config` FROM `#@__site_loginconnect` WHERE `state` = 1");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        foreach ($ret as $key => $value) {
            $config = unserialize($value['config']);

            $configArr = array();
            foreach ($config as $k => $v) {
                $configArr[$v['name']] = $v['value'];
            }

            //QQ
            if($value['code'] == 'qq'){
                $qq_appid = $configArr['app_appid'];
                $qq_appkey = $configArr['app_appkey'];

            //微信
            }elseif($value['code'] == 'wechat'){
                $wechat_appid = $configArr['appid_app'];
                $wechat_appsecret = $configArr['appsecret_app'];

            //新浪
            }elseif($value['code'] == 'sina'){
                $sina_akey = $configArr['akey_app'];
                $sina_skey = $configArr['skey_app'];
            }
        }
    }

    //推送
    $android_access_id = $android_access_key = $android_secret_key = $ios_access_id = $ios_access_key = $ios_secret_key = "";
    $sql = $dsql->SetQuery("SELECT * FROM `#@__app_push_config` LIMIT 1");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        $data = $ret[0];

        $android_access_id  = $data['android_access_id'];
        $android_access_key = $data['android_access_key'];
        $android_secret_key = $data['android_secret_key'];
        $ios_access_id      = $data['ios_access_id'];
        $ios_access_key     = $data['ios_access_key'];
        $ios_secret_key     = $data['ios_secret_key'];
    }

    //基本设置文件内容
    $customInc = "{";
    //基本设置
    $customInc .= "\"cfg_basehost\": \"http://$cfg_basehost\",";
    $customInc .= "\"cfg_ios_index\": \"".$ios_index."\",";
    $customInc .= "\"cfg_android_index\": \"".$android_index."\",";
    $customInc .= "\"cfg_webname\": ".json_encode($cfg_webname).",";
    $customInc .= "\"cfg_shortname\": ".json_encode($cfg_shortname).",";
    $customInc .= "\"cfg_guide\": {";
    $customInc .= "\"android\": ".json_encode($android_guide).",";
    $customInc .= "\"ios\": ".json_encode($ios_guide)."";
    $customInc .= "},";
    $customInc .= "\"cfg_startad\": {";
    $customInc .= "\"time\": \"$ad_time\",";
    $customInc .= "\"src\": \"$ad_pic\",";
    $customInc .= "\"link\": \"$ad_link\"";
    $customInc .= "},";
    $customInc .= "\"cfg_umeng\": {";
    $customInc .= "\"android\": \"$android_access_key\",";
    $customInc .= "\"ios\": \"$ios_access_key\"";
    $customInc .= "},";
    $customInc .= "\"cfg_loginconnect\": {";
    $customInc .= "\"qq\": {";
    $customInc .= "\"appid\": \"$qq_appid\",";
    $customInc .= "\"appkey\": \"$qq_appkey\"";
    $customInc .= "},";
    $customInc .= "\"wechat\": {";
    $customInc .= "\"appid\": \"$wechat_appid\",";
    $customInc .= "\"appsecret\": \"$wechat_appsecret\"";
    $customInc .= "},";
    $customInc .= "\"sina\": {";
    $customInc .= "\"akey\": \"$sina_akey\",";
    $customInc .= "\"skey\": \"$sina_skey\"";
    $customInc .= "}";
    $customInc .= "},";

    //此处只为信鸽配置，由于将推送换成了友盟，此处就不需要了  by: 20170621  guozi
    // $customInc .= "\"cfg_push\":{";
    // $customInc .= "\"android\":{";
    // $customInc .= "\"access_id\": \"$android_access_id\",";
    // $customInc .= "\"access_key\": \"$android_access_key\",";
    // $customInc .= "\"secret_key\": \"$android_secret_key\"";
    // $customInc .= "},";
    // $customInc .= "\"ios\":{";
    // $customInc .= "\"access_id\": \"$ios_access_id\",";
    // $customInc .= "\"access_key\": \"$ios_access_key\",";
    // $customInc .= "\"secret_key\": \"$ios_secret_key\"";
    // $customInc .= "}";
    // $customInc .= "},";

    // global $cfg_map;
    $map_current = "";
    if($map_set == 1){
        $map_current = "google";
    }elseif($map_set == 2){
        $map_current = "baidu";
    }elseif($map_set == 3){
        $map_current = "qq";
    }elseif($map_set == 4){
        $map_current = "amap";
    }
    $customInc .= "\"cfg_map_current\":\"$map_current\",";

    $customInc .= "\"cfg_map\":{";
    $customInc .= "\"baidu\":{";
    $customInc .= "\"android\": \"".$map_baidu_android."\",";
    $customInc .= "\"ios\": \"".$map_baidu_ios."\"";
    $customInc .= "},";
    $customInc .= "\"google\":\"".$map_google."\"";
    $customInc .= "}";

    $customInc .= "}";

    $customIncFile = HUONIAOROOT."/api/appConfig.json";
    $fp = fopen($customIncFile, "w") or die('{"state": 200, "info": '.json_encode("写入文件 $customIncFile 失败，请检查权限！").'}');
    fwrite($fp, $customInc);
    fclose($fp);
}



/**
    * 根据指定表、指定ID获取相关信息
    * @return array
    */
function getPublicParentInfo($params){
    extract($params);
    if(empty($tab) || empty($id)) return;

    $type = $type ? $type : "id";
    $split = $split ? $split : ",";

    global $data;
    $data = "";
    $typeArr = getParentArr($tab, $id);
    $arr = array_reverse(parent_foreach($typeArr, $type));

    return join($split, $arr);

}


/**
*  @desc 根据两点间的经纬度计算距离
*  @param float $lat 纬度值
*  @param float $lng 经度值
*/
 function getDistance($lat1, $lng1, $lat2, $lng2){
     $earthRadius = 6367000; //approximate radius of earth in meters

     /*
       Convert these degrees to radians
       to work with the formula
     */

     $lat1 = ($lat1 * pi() ) / 180;
     $lng1 = ($lng1 * pi() ) / 180;

     $lat2 = ($lat2 * pi() ) / 180;
     $lng2 = ($lng2 * pi() ) / 180;

     /*
       Using the
       Haversine formula

       http://en.wikipedia.org/wiki/Haversine_formula

       calculate the distance
     */

     $calcLongitude = $lng2 - $lng1;
     $calcLatitude = $lat2 - $lat1;
     $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
     $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
     $calculatedDistance = $earthRadius * $stepTwo;

     return round($calculatedDistance);
 }



 //打印
 // pp 为强制打印，不需要验证是否开启自动打印外卖新订单选项
 function printerWaimaiOrder($id, $pp = false){
     global $cfg_shortname;
     global $dsql;

     $date = GetMkTime(date("Y-m-d"));

     //消息通知
     $sql = $dsql->SetQuery("SELECT
         s.`shopname`, s.`smsvalid`, s.`sms_phone`, s.`auto_printer`, s.`showordernum`, s.`bind_print`, s.`print_config`, s.`print_state`, o.`state`, o.`ordernum`, o.`ordernumstore`, o.`food`, o.`person`, o.`tel`, o.`address`, o.`paytype`, o.`amount`, o.`priceinfo`, o.`preset`, o.`note`, o.`pubdate`, o.`uid`
         FROM `#@__waimai_shop` s LEFT JOIN `#@__waimai_order` o ON o.`sid` = s.`id` WHERE o.`id` = $id");
     $ret = $dsql->dsqlOper($sql, "results");
     if($ret){
         $data         = $ret[0];
         $shopname     = $data['shopname'];
         $smsvalid     = $data['smsvalid'];
         $sms_phone    = $data['sms_phone'];
         $auto_printer = $data['auto_printer'];
         $showordernum = $data['showordernum'];
         $bind_print   = $data['bind_print'];
         $print_config = $data['print_config'];
         $print_state  = $data['print_state'];

         $state     = $data['state'];
         $ordernum  = $data['ordernum'];
         $ordernumstore  = $data['ordernumstore'];
         $food      = unserialize($data['food']);
         $person    = $data['person'];
         $tel       = $data['tel'];
         $address   = $data['address'];
         $paytype   = $data['paytype'];
         $amount    = $data['amount'];
         $priceinfo = unserialize($data['priceinfo']);
         $preset    = unserialize($data['preset']);
         $note      = $data['note'];
         $pubdate   = $data['pubdate'];
         $uid       = $data['uid'];
         $count     = explode("-", $ordernumstore);
         $count     = $showordernum ? $count[1] : 0;

         $amountInfo = $paytype == "delivery" ? "货到付款：".$amount : "已付款：".$amount;

         //短信通知
         if($smsvalid && $sms_phone && !$pp){
             sendsms($sms_phone, 1, "", "", false, false, "会员-商家新订单通知", array("title" => ""));
         }


         //微信通知买家
         if($state == 3){
             $foods = array();
             foreach ($food as $key => $value) {
                 array_push($foods, $value['title'] . " " . $value['count'] . "份");
             }

             $param = array(
                 "service"  => "member",
                 "type"     => "user",
                 "template" => "orderdetail",
                 "module"   => "waimai",
                 "id"       => $id
             );
             updateMemberNotice($uid, "会员-订单确认提醒", $param, array("ordernum" => $shopname.$ordernumstore, "orderdate" => date("Y-m-d H:i:s", $pubdate), "orderinfo" => join(" ", $foods), "orderprice" => $amount));
         }



         //计算

         if(($auto_printer || $pp) && $bind_print && $print_config && $print_state == 1){
             $print_config = unserialize($print_config);


             $num = "";
             if($count){
                 $num = " #".$count;
             }

             //预设内容
             $presets = "";
             $presetArr = array();
             if($preset){
                 foreach ($preset as $key => $value) {
                     if(!empty($value['value'])){
                         array_push($presetArr, "<FH>".$value['title'] . "：" . $value['value'] . "</FH>\r");
                     }
                 }
             }
             if($presetArr){
                 $presets = join("", $presetArr) . "********************************";
             }

             //菜单内容
             $foods = array();
             if($food){
                 foreach ($food as $key => $value) {
                     $title = $value['title'];
                     if($value['ntitle']){
                         $title .= "（".$value['ntitle']."）";
                     }
                     array_push($foods, "<FH>".$title."\r                 ×<FB>".$value['count']."</FB>     ".(sprintf('%.2f', $value['price'] * $value['count']))."</FH>");
                     // array_push($foods, "<tr><td>".$title."</td><td>*".$value['count']."</td><td>".(sprintf('%.2f', $value['price'] * $value['count']))."</td></tr>");
                 }
             }
             $foods = join("\r", $foods);

             //费用详细
             $prices = "";
             $priceArr = array();
             if($priceinfo){
                 array_push($priceArr, "<table><tr><td></td><td></td><td></td></tr>");
                 foreach ($priceinfo as $key => $value) {
                     $oper = "";
                     if($value['type'] == "youhui" || $value['type'] == "manjian" || $value['type'] == "shoudan"){
                         $oper = "-";
                     }
                     array_push($priceArr, "<tr><td>".$value['body']."</td><td></td><td>".$oper.$value['amount']."</td></tr>");
                 }
                 array_push($priceArr, "</table>");
             }
             if($priceArr){
                 $prices = join("", $priceArr) . "\r********************************";
             }


             $noteText = !empty($note) ? "<FH><FW><FB>$note</FB></FW></FH>" . "\r********************************" : "";


 $content = "<FB><FH2><center>".$shopname.$num."</center></FH2></FB>
********************************
<FH>单号：$ordernumstore</FH>
<FH>时间：".date("Y-m-d H:i:s", $pubdate)."</FH>
<FH>地址：$address</FH>
<FH>姓名：$person</FH>
<FH>电话：$tel</FH>
********************************
$presets
<FH>商品名           数量    小计</FH>
********************************
$foods
$prices
$noteText
<FH2><FW>".$amountInfo."元</FW></FH2>
\r\n
<center>".$cfg_shortname."祝您购物愉快".$num.($num ? "完" : "")."</center>";

 // $content = "<FB2><FH2><center>".$cfg_shortname.$num."</center></FH2></FB2>
 // ********************************
 // <FH>单号：$ordernum</FH>
 // <FH>时间：".date("Y-m-d H:i:s", $pubdate)."</FH>
 // <FH>地址：$address</FH>
 // <FH>姓名：$person</FH>
 // <FH>电话：$tel</FH>
 // ********************************
 // $presets
 // <table>
 // <tr><td>商品名</td><td>数量</td><td>小计</td></tr>
 // $foods
 // </table>
 // ********************************
 // $prices
 // <FH><FW>$note</FW></FH>
 // ********************************
 // <FH2><FW>已付款：".$amount."元</FW></FH2>
 //
 //
 // \r\n\r\n\r\n";
 //
 // echo $content;die;


             foreach ($print_config as $k => $v) {
                 $partner = $v['partner'];
                 $apikey  = $v['apikey'];
                 $mcode   = $v['mcode'];
                 $msign   = $v['msign'];

                 if($partner && $apikey && $mcode && $msign && $content){

                     require_once(HUONIAOINC . '/class/waimaiPrint.class.php');
                     $print = new waimaiPrint();
                     $report = $print->action_print($partner, $mcode, $content, $apikey, $msign);
                     $report = json_decode($report, true);

                     //打印成功后更新订单打印接口id
                     if($report['state'] == 1){
                         $print_dataid = $report['id'];

                         $sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `print_dataid` = '$print_dataid' WHERE `id` = $id");
                         $dsql->dsqlOper($sql, "update");
                     }

                 }
             }




             // printerWaimaiOrder($print_config, $ordernum, $food, $person, $tel, $address, $amount, $priceinfo, $preset, $note, $pubdate, 10);
         }

     }
 }




 include_once HUONIAOINC . '/class/push/aliyun/aliyun-php-sdk-core/Config.php';
 include HUONIAOINC . '/class/push/aliyun/aliyun-php-sdk-push/Push/Request/V20160801/PushRequest.php';
 use \Push\Request\V20160801 as Push;


//阿里云-移动推送
function aliyunPush($id, $title, $body, $music = "default", $url = ""){
    global $cfg_basehost;
    global $dsql;

    $url = empty($url) ? "http://$cfg_basehost/?service=waimai&do=courier&state=4,5" : $url;

    //查询推送配置
    $android_access_id = $android_access_key = $android_secret_key = $ios_access_id = $ios_access_key = $ios_secret_key = "";

    $sql = $dsql->SetQuery("SELECT * FROM `#@__app_push_config` LIMIT 0, 1");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
        $data = $ret[0];
        $android_access_id = $data['android_access_id'];
        $android_access_key =  $data['android_access_key'];
        $android_secret_key =  $data['android_secret_key'];
        $ios_access_id =  $data['ios_access_id'];
        $ios_access_key =  $data['ios_access_key'];
        $ios_secret_key = $data['ios_secret_key'];
    }

    //配送员版
    if($music == "peisongordercancel" || $music == "newfenpeiorder"){
        $android_access_key = "24324205";
    }

    $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $android_access_id, $android_secret_key);
    $client = new DefaultAcsClient($iClientProfile);
    $request = new Push\PushRequest();

    // 推送目标
    $request->setAppKey($android_access_key);
    $request->setTarget("ACCOUNT"); //推送目标: DEVICE:推送给设备; ACCOUNT:推送给指定帐号,TAG:推送给自定义标签; ALL: 推送给全部
    $request->setTargetValue($id); //根据Target来设定，如Target=device, 则对应的值为 设备id1,设备id2. 多个值使用逗号分隔.(帐号与设备有一次最多100个的限制)
    $request->setDeviceType("ALL"); //设备类型 ANDROID iOS ALL.
    $request->setPushType("NOTICE"); //消息类型 MESSAGE NOTICE
    $request->setTitle($title); // 消息的标题
    $request->setBody($body); // 消息的内容

    // 推送配置: iOS
    $request->setiOSSilentNotification("true");//是否开启静默通知
    $request->setiOSMusic($music.".m4a"); // iOS通知声音
    $request->setiOSApnsEnv("DEV");//iOS的通知是通过APNs中心来发送的，需要填写对应的环境信息。"DEV" : 表示开发环境 "PRODUCT" : 表示生产环境
    $request->setiOSRemind("false"); // 推送时设备不在线（既与移动推送的服务端的长连接通道不通），则这条推送会做为通知，通过苹果的APNs通道送达一次(发送通知时,Summary为通知的内容,Message不起作用)。注意：离线消息转通知仅适用于生产环境
    $request->setiOSRemindBody("iOSRemindBody");//iOS消息转通知时使用的iOS通知内容，仅当iOSApnsEnv=PRODUCT && iOSRemind为true时有效
    $request->setiOSExtParameters("{\"url\":\"$url\"}"); //自定义的kv结构,开发者扩展用 针对iOS设备


    // 推送配置: Android
    $request->setAndroidNotifyType("BOTH");//通知的提醒方式 "VIBRATE" : 震动 "SOUND" : 声音 "BOTH" : 声音和震动 NONE : 静音
    $request->setAndroidNotificationBarType(1);//通知栏自定义样式0-100
    $request->setAndroidOpenType("APPLICATION");//点击通知后动作 "APPLICATION" : 打开应用 "ACTIVITY" : 打开AndroidActivity "URL" : 打开URL "NONE" : 无跳转
    $request->setAndroidMusic($music);//Android通知音乐
    $request->setAndroidExtParameters("{\"music\": \"$music\", \"url\":\"$url\"}"); // 设定android类型设备通知的扩展属性

    $response = $client->getAcsResponse($request);
}
