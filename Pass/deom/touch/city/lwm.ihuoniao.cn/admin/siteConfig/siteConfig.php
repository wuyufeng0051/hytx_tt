<?php
/**
 * 系统基本参数
 *
 * @version        $Id: siteConfig.php 2013-9-21 下午10:59:36 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("siteConfig");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/siteConfig";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "siteConfig.html";
$dir       = "../../templates/siteConfig"; //当前目录

if($action != ""){
	if($token == "") die('token传递失败！');

	//删除模板文件夹
	if($action == "delTpl"){
		if(empty($floder)) die('请选择要删除的模板！');

		$floder = $dir."/".iconv('utf-8', 'gbk', $floder);
		$deldir = deldir($floder);
		if($deldir){
			adminLog("修改系统基本参数", "删除模板：".$floder);

			die('{"state": 100, "info": '.json_encode("删除成功！").'}');
		}else{
			die('{"state": 200, "info": '.json_encode("删除失败！").'}');
		}

	}else{
		if($action == "site"){
			//站点信息
			$cfg_basehost        = $basehost;
			$cfg_webname         = $webname;
			$cfg_shortname       = $shortname;
			$cfg_weblogo         = $litpic;
			$cfg_keywords        = $keywords;
			$cfg_description     = $description;
			$cfg_beian           = $beian;
			$cfg_hotline         = $hotline;
			$cfg_powerby         = $powerby;
			$cfg_statisticscode  = $statisticscode;
			$cfg_visitState      = $visitState;
			$cfg_visitMessage    = $visitMessage;
			$cfg_timeZone        = $timeZone;
			$cfg_mapCity         = $mapCity;

			//地图配置
			$cfg_map             = $map;
			$cfg_map_google      = $mapkey_google;
			$cfg_map_baidu       = $mapkey_baidu;
			$cfg_map_qq          = $mapkey_qq;
			$cfg_map_amap        = $mapkey_amap;

			//天气
			$cfg_weatherCity     = $weatherCity;

			$cfg_onlinetime      = $onlinetime;
			$cfg_cookiePath      = $cookiePath;
			$cfg_cookieDomain    = $cookieDomain;
			$cfg_cookiePre       = $cookiePre;
			$cfg_cache_lifetime  = $cache_lifetime;
			$cfg_urlRewrite      = $urlRewrite;
			$cfg_hideUrl         = $hideUrl;

			$cfg_visitState = $cfg_visitState == "" ? 0 : $cfg_visitState;
			$cfg_timeZone   = $cfg_timeZone == "" ? 8 : $cfg_timeZone;
			$cfg_onlinetime = $cfg_onlinetime == "" ? 30 : $cfg_onlinetime;
			$cfg_cache_lifetime = $cfg_cache_lifetime == "" ? 60 : $cfg_cache_lifetime;
			$cfg_urlRewrite = $cfg_urlRewrite == "" ? 0 : $cfg_urlRewrite;
			$cfg_hideUrl    = $cfg_hideUrl == "" ? 0 : $cfg_hideUrl;

			if($cfg_basehost == "" || $cfg_webname == "" || $cfg_weblogo == "")
			die('{"state": 200, "info": '.json_encode("请填写完整！").'}');

			adminLog("修改系统基本参数", "站点信息");

		}elseif($action == "temp"){
			//模板风格
			$cfg_template = $template;
			$cfg_touchTemplate = $touchTemplate;

			adminLog("修改系统基本参数", "站点风格");

		}elseif($action == "upload"){
			//上传设置
			$cfg_uploadDir         = $uploadDir;
			$cfg_softSize          = $softSize;
			$cfg_softType          = $softType;
			$cfg_thumbSize         = $thumbSize;
			$cfg_thumbType         = $thumbType;
			$cfg_atlasSize         = $atlasSize;
			$cfg_atlasType         = $atlasType;
			$cfg_editorSize        = $editorSize;
			$cfg_editorType        = $editorType;
			$cfg_photoSize         = $photoSize;
			$cfg_photoType         = $photoType;
			$cfg_flashSize         = $flashSize;
			$cfg_audioSize         = $audioSize;
			$cfg_audioType         = $audioType;
			$cfg_videoSize         = $videoSize;
			$cfg_videoType         = $videoType;
			$cfg_thumbSmallWidth   = $thumbSmallWidth;
			$cfg_thumbSmallHeight  = $thumbSmallHeight;
			$cfg_thumbMiddleWidth  = $thumbMiddleWidth;
			$cfg_thumbMiddleHeight = $thumbMiddleHeight;
			$cfg_thumbLargeWidth   = $thumbLargeWidth;
			$cfg_thumbLargeHeight  = $thumbLargeHeight;
			$cfg_atlasSmallWidth   = $atlasSmallWidth;
			$cfg_atlasSmallHeight  = $atlasSmallHeight;
			$cfg_photoSmallWidth   = $photoSmallWidth;
			$cfg_photoSmallHeight  = $photoSmallHeight;
			$cfg_photoMiddleWidth  = $photoMiddleWidth;
			$cfg_photoMiddleHeight = $photoMiddleHeight;
			$cfg_photoLargeWidth   = $photoLargeWidth;
			$cfg_photoLargeHeight  = $photoLargeHeight;
			$cfg_meditorPicWidth   = $meditorPicWidth;
			$cfg_photoCutType      = $photoCutType;
			$cfg_photoCutPostion   = $photoCutPostion;
			$cfg_quality           = $quality;

			$cfg_softSize = $cfg_softSize == "" ? 10240 : $cfg_softSize;
			$cfg_thumbSize = $cfg_thumbSize == "" ? 1024 : $cfg_thumbSize;
			$cfg_atlasSize = $cfg_atlasSize == "" ? 2048 : $cfg_atlasSize;
			$cfg_editorSize = $cfg_editorSize == "" ? 2048 : $cfg_editorSize;
			$cfg_photoSize = $cfg_photoSize == "" ? 1024 : $cfg_photoSize;
			$cfg_flashSize = $cfg_flashSize == "" ? 1024 : $cfg_flashSize;
			$cfg_audioSize = $cfg_audioSize == "" ? 1024 : $cfg_audioSize;
			$cfg_videoSize = $cfg_videoSize == "" ? 10240 : $cfg_videoSize;
			$cfg_thumbSmallWidth = $cfg_thumbSmallWidth == "" ? 104 : $cfg_thumbSmallWidth;
			$cfg_thumbSmallHeight = $cfg_thumbSmallHeight == "" ? 80 : $cfg_thumbSmallHeight;
			$cfg_thumbMiddleWidth = $cfg_thumbMiddleWidth == "" ? 240 : $cfg_thumbMiddleWidth;
			$cfg_thumbMiddleHeight = $cfg_thumbMiddleHeight == "" ? 180 : $cfg_thumbMiddleHeight;
			$cfg_thumbLargeWidth = $cfg_thumbLargeWidth == "" ? 400 : $cfg_thumbLargeWidth;
			$cfg_thumbLargeHeight = $cfg_thumbLargeHeight == "" ? 300 : $cfg_thumbLargeHeight;
			$cfg_atlasSmallWidth = $cfg_atlasSmallWidth == "" ? 115 : $cfg_atlasSmallWidth;
			$cfg_atlasSmallHeight = $cfg_atlasSmallHeight == "" ? 75 : $cfg_atlasSmallHeight;
			$cfg_photoSmallWidth = $cfg_photoSmallWidth == "" ? 50 : $cfg_photoSmallWidth;
			$cfg_photoSmallHeight = $cfg_photoSmallHeight == "" ? 50 : $cfg_photoSmallHeight;
			$cfg_photoMiddleWidth = $cfg_photoMiddleWidth == "" ? 100 : $cfg_photoMiddleWidth;
			$cfg_photoMiddleHeight = $cfg_photoMiddleHeight == "" ? 100 : $cfg_photoMiddleHeight;
			$cfg_photoLargeWidth = $cfg_photoLargeWidth == "" ? 200 : $cfg_photoLargeWidth;
			$cfg_meditorPicWidth = $cfg_meditorPicWidth == "" ? 700 : $cfg_meditorPicWidth;
			$cfg_photoLargeHeight = $cfg_photoLargeHeight == "" ? 200 : $cfg_photoLargeHeight;
			$cfg_quality = $cfg_quality == "" ? 90 : $cfg_quality;

			if($cfg_uploadDir == "" || $cfg_softType == "" || $cfg_thumbType == "" || $cfg_atlasType == "")
			die('{"state": 200, "info": '.json_encode("请填写完整！").'}');

			adminLog("修改系统基本参数", "上传设置");

		}elseif($action == "ftp"){
			//远程附件
			$cfg_ftpType        = $ftpType;
			$cfg_ftpState       = $ftpStateType;
			$cfg_ftpSSL         = $ftpSSL;
			$cfg_ftpPasv        = $ftpPasv;
			$cfg_ftpUrl         = $ftpUrl;
			$cfg_ftpServer      = $ftpServer;
			$cfg_ftpPort        = $ftpPort;
			$cfg_ftpDir         = $ftpDir;
			$cfg_ftpUser        = $ftpUser;
			$cfg_ftpPwd         = $ftpPwd;
			$cfg_ftpTimeout     = $ftpTimeout;
			$cfg_OSSUrl         = $OSSUrl;
			$cfg_OSSBucket      = $OSSBucket;
			$cfg_OSSKeyID       = $OSSKeyID;
			$cfg_OSSKeySecret   = $OSSKeySecret;

			$cfg_ftpType = $cfg_ftpType == "" ? 0 : $cfg_ftpType;
			$cfg_ftpState = $cfg_ftpState == "" ? 1 : $cfg_ftpState;
			$cfg_ftpSSL = $cfg_ftpSSL == "" ? 0 : $cfg_ftpSSL;
			$cfg_ftpPasv = $cfg_ftpPasv == "" ? 0 : $cfg_ftpPasv;
			$cfg_ftpPort = $cfg_ftpPort == "" ? 21 : $cfg_ftpPort;
			$cfg_ftpTimeout = $cfg_ftpTimeout == "" ? 0 : $cfg_ftpTimeout;

			if($cfg_ftpType == 1){
				if($cfg_OSSUrl == "" || $cfg_OSSBucket == "" || $cfg_OSSKeyID == "" || $cfg_OSSKeySecret == "")
				die('{"state": 200, "info": '.json_encode("请填写完整！").'}');
			}
			if($cfg_ftpState == 1){
				if($cfg_ftpUrl == "" || $cfg_ftpServer == "" || $cfg_ftpDir == "" || $cfg_ftpUser == "" || $cfg_ftpPwd == "")
				die('{"state": 200, "info": '.json_encode("请填写完整！").'}');
			}

			adminLog("修改系统基本参数", "远程附件");

		}elseif($action == "mark"){
			//水印设置
			$thumbMarkState    = $thumbMarkState;
			$atlasMarkState    = $atlasMarkState;
			$editorMarkState   = $editorMarkState;
			$waterMarkWidth    = $waterMarkWidth;
			$waterMarkHeight   = $waterMarkHeight;
			$waterMarkPostion  = $waterMarkPostion;
			$waterMarkType     = $waterMarkType;
			$waterMarkText     = $markText;
			$markFontfamily    = $markFontfamily;
			$markFontsize      = $markFontsize;
			$markFontColor     = $markFontColor;
			$markFile          = $markFile;
			$markPadding       = $markPadding;
			$transparent       = $transparent;
			$markQuality       = $markQuality;

			$thumbMarkState = $thumbMarkState == "" ? 0 : $thumbMarkState;
			$atlasMarkState = $atlasMarkState == "" ? 0 : $atlasMarkState;
			$editorMarkState = $editorMarkState == "" ? 0 : $editorMarkState;
			$waterMarkWidth = $waterMarkWidth == "" ? 400 : $waterMarkWidth;
			$waterMarkHeight = $waterMarkHeight == "" ? 300 : $waterMarkHeight;
			$waterMarkPostion = $waterMarkPostion == "" ? 9 : $waterMarkPostion;
			$waterMarkType = $waterMarkType == "" ? 1 : $waterMarkType;
			$markFontsize = $markFontsize == "" ? 12 : $markFontsize;
			$markPadding = $markPadding == "" ? 10 : $markPadding;
			$markTransparent = $transparent == "" ? 100 : $transparent;
			$markQuality = $markQuality == "" ? 90 : $markQuality;

			if($waterMarkType == 1){
				if($waterMarkText == "" || $markFontfamily == "")
				die('{"state": 200, "info": '.json_encode("请填写完整！").'}');
			}elseif($waterMarkType == 2 || $waterMarkType == 3){
				if($markFile == "")
				die('{"state": 200, "info": '.json_encode("请填写完整！").'}');
			}

			adminLog("修改系统基本参数", "水印设置");


		//设置默认首页
		}elseif($action == "setSystemIndex"){

			//设置频道为首页
			if($type == "set"){

				if(!empty($module)){
					$sql = $dsql->SetQuery("SELECT `name` FROM `#@__site_module` WHERE `id` = $module");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						$cfg_defaultindex = $ret[0]['name'];
					}
				}

			//默认
			}else{

				$cfg_defaultindex = "siteConfig";

			}

			adminLog("设置默认首页", $type." => ".$cfg_defaultindex);


		//设置默认首页
		}elseif($action == "Alidayu"){

			$cfg_smsAlidayu = (int)$smsAlidayu;
			adminLog("设置短信平台为阿里大于", "");

		}

		//站点信息文件内容
		$configFile = "<"."?php\r\n";
		$configFile .= "\$cfg_basehost = '"._RunMagicQuotes($cfg_basehost)."';\r\n";
		$configFile .= "\$cfg_webname = '"._RunMagicQuotes($cfg_webname)."';\r\n";
		$configFile .= "\$cfg_shortname = '"._RunMagicQuotes($cfg_shortname)."';\r\n";
		$configFile .= "\$cfg_weblogo = '"._RunMagicQuotes($cfg_weblogo)."';\r\n";
		$configFile .= "\$cfg_keywords = '"._RunMagicQuotes($cfg_keywords)."';\r\n";
		$configFile .= "\$cfg_description = '"._RunMagicQuotes($cfg_description)."';\r\n";
		$configFile .= "\$cfg_beian = '"._RunMagicQuotes($cfg_beian)."';\r\n";
		$configFile .= "\$cfg_hotline = '"._RunMagicQuotes($cfg_hotline)."';\r\n";
		$configFile .= "\$cfg_powerby = '"._RunMagicQuotes($cfg_powerby)."';\r\n";
		$configFile .= "\$cfg_statisticscode = '"._RunMagicQuotes($cfg_statisticscode)."';\r\n";
		$configFile .= "\$cfg_visitState = "._RunMagicQuotes($cfg_visitState).";\r\n";
		$configFile .= "\$cfg_visitMessage = '"._RunMagicQuotes($cfg_visitMessage)."';\r\n";
		$configFile .= "\$cfg_timeZone = "._RunMagicQuotes($cfg_timeZone).";\r\n";
		$configFile .= "\$cfg_mapCity = '"._RunMagicQuotes($cfg_mapCity)."';\r\n";
		$configFile .= "\$cfg_map = "._RunMagicQuotes($cfg_map).";\r\n";
		$configFile .= "\$cfg_map_google = '"._RunMagicQuotes($cfg_map_google)."';\r\n";
		$configFile .= "\$cfg_map_baidu = '"._RunMagicQuotes($cfg_map_baidu)."';\r\n";
		$configFile .= "\$cfg_map_qq = '"._RunMagicQuotes($cfg_map_qq)."';\r\n";
		$configFile .= "\$cfg_map_amap = '"._RunMagicQuotes($cfg_map_amap)."';\r\n";
		$configFile .= "\$cfg_weatherCity = '"._RunMagicQuotes($cfg_weatherCity)."';\r\n";
		$configFile .= "\$cfg_onlinetime = "._RunMagicQuotes($cfg_onlinetime).";\r\n";
		$configFile .= "\$cfg_cookiePath = '"._RunMagicQuotes($cfg_cookiePath)."';\r\n";
		$configFile .= "\$cfg_cookieDomain = '"._RunMagicQuotes($cfg_cookieDomain)."';\r\n";
		$configFile .= "\$cfg_cookiePre = '"._RunMagicQuotes($cfg_cookiePre)."';\r\n";
		$configFile .= "\$cfg_cache_lifetime = '"._RunMagicQuotes($cfg_cache_lifetime)."';\r\n";
		$configFile .= "\$cfg_urlRewrite = '"._RunMagicQuotes($cfg_urlRewrite)."';\r\n";
		$configFile .= "\$cfg_hideUrl = '"._RunMagicQuotes($cfg_hideUrl)."';\r\n";
		$configFile .= "\$cfg_template = '"._RunMagicQuotes($cfg_template)."';\r\n";
		$configFile .= "\$cfg_touchTemplate = '"._RunMagicQuotes($cfg_touchTemplate)."';\r\n";
		$configFile .= "\$cfg_defaultindex = '"._RunMagicQuotes($cfg_defaultindex)."';\r\n";
		$configFile .= "\$cfg_smsAlidayu = ".(int)$cfg_smsAlidayu.";\r\n";

		//邮件配置
		$configFile .= "\$cfg_mail = "._RunMagicQuotes($cfg_mail).";\r\n";
		$configFile .= "\$cfg_mailServer = '"._RunMagicQuotes($cfg_mailServer)."';\r\n";
		$configFile .= "\$cfg_mailPort = '"._RunMagicQuotes($cfg_mailPort)."';\r\n";
		$configFile .= "\$cfg_mailFrom = '"._RunMagicQuotes($cfg_mailFrom)."';\r\n";
		$configFile .= "\$cfg_mailUser = '"._RunMagicQuotes($cfg_mailUser)."';\r\n";
		$configFile .= "\$cfg_mailPass = '"._RunMagicQuotes($cfg_mailPass)."';\r\n";

		//上传配置
		$configFile .= "\$cfg_uploadDir = '"._RunMagicQuotes($cfg_uploadDir)."';\r\n";
		$configFile .= "\$cfg_softSize = "._RunMagicQuotes($cfg_softSize).";\r\n";
		$configFile .= "\$cfg_softType = '"._RunMagicQuotes($cfg_softType)."';\r\n";
		$configFile .= "\$cfg_thumbSize = "._RunMagicQuotes($cfg_thumbSize).";\r\n";
		$configFile .= "\$cfg_thumbType = '"._RunMagicQuotes($cfg_thumbType)."';\r\n";
		$configFile .= "\$cfg_atlasSize = "._RunMagicQuotes($cfg_atlasSize).";\r\n";
		$configFile .= "\$cfg_atlasType = '"._RunMagicQuotes($cfg_atlasType)."';\r\n";
		$configFile .= "\$cfg_editorSize = "._RunMagicQuotes($cfg_editorSize).";\r\n";
		$configFile .= "\$cfg_editorType = '"._RunMagicQuotes($cfg_editorType)."';\r\n";
		$configFile .= "\$cfg_photoSize = "._RunMagicQuotes($cfg_photoSize).";\r\n";
		$configFile .= "\$cfg_photoType = '"._RunMagicQuotes($cfg_photoType)."';\r\n";
		$configFile .= "\$cfg_flashSize = "._RunMagicQuotes($cfg_flashSize).";\r\n";
		$configFile .= "\$cfg_audioSize = "._RunMagicQuotes($cfg_audioSize).";\r\n";
		$configFile .= "\$cfg_audioType = '"._RunMagicQuotes($cfg_audioType)."';\r\n";
		$configFile .= "\$cfg_videoSize = "._RunMagicQuotes($cfg_videoSize).";\r\n";
		$configFile .= "\$cfg_videoType = '"._RunMagicQuotes($cfg_videoType)."';\r\n";
		$configFile .= "\$cfg_thumbSmallWidth = "._RunMagicQuotes($cfg_thumbSmallWidth).";\r\n";
		$configFile .= "\$cfg_thumbSmallHeight = "._RunMagicQuotes($cfg_thumbSmallHeight).";\r\n";
		$configFile .= "\$cfg_thumbMiddleWidth = "._RunMagicQuotes($cfg_thumbMiddleWidth).";\r\n";
		$configFile .= "\$cfg_thumbMiddleHeight = "._RunMagicQuotes($cfg_thumbMiddleHeight).";\r\n";
		$configFile .= "\$cfg_thumbLargeWidth = "._RunMagicQuotes($cfg_thumbLargeWidth).";\r\n";
		$configFile .= "\$cfg_thumbLargeHeight = "._RunMagicQuotes($cfg_thumbLargeHeight).";\r\n";
		$configFile .= "\$cfg_atlasSmallWidth = "._RunMagicQuotes($cfg_atlasSmallWidth).";\r\n";
		$configFile .= "\$cfg_atlasSmallHeight = "._RunMagicQuotes($cfg_atlasSmallHeight).";\r\n";
		$configFile .= "\$cfg_photoSmallWidth = "._RunMagicQuotes($cfg_photoSmallWidth).";\r\n";
		$configFile .= "\$cfg_photoSmallHeight = "._RunMagicQuotes($cfg_photoSmallHeight).";\r\n";
		$configFile .= "\$cfg_photoMiddleWidth = "._RunMagicQuotes($cfg_photoMiddleWidth).";\r\n";
		$configFile .= "\$cfg_photoMiddleHeight = "._RunMagicQuotes($cfg_photoMiddleHeight).";\r\n";
		$configFile .= "\$cfg_photoLargeWidth = "._RunMagicQuotes($cfg_photoLargeWidth).";\r\n";
		$configFile .= "\$cfg_photoLargeHeight = "._RunMagicQuotes($cfg_photoLargeHeight).";\r\n";
		$configFile .= "\$cfg_meditorPicWidth = "._RunMagicQuotes($cfg_meditorPicWidth).";\r\n";
		$configFile .= "\$cfg_photoCutType = '"._RunMagicQuotes($cfg_photoCutType)."';\r\n";
		$configFile .= "\$cfg_photoCutPostion = '"._RunMagicQuotes($cfg_photoCutPostion)."';\r\n";
		$configFile .= "\$cfg_quality = "._RunMagicQuotes($cfg_quality).";\r\n";

		//远程附件
		$configFile .= "\$cfg_ftpType = "._RunMagicQuotes($cfg_ftpType).";\r\n";
		$configFile .= "\$cfg_ftpState = "._RunMagicQuotes($cfg_ftpState).";\r\n";
		$configFile .= "\$cfg_ftpSSL = "._RunMagicQuotes($cfg_ftpSSL).";\r\n";
		$configFile .= "\$cfg_ftpPasv = "._RunMagicQuotes($cfg_ftpPasv).";\r\n";
		$configFile .= "\$cfg_ftpUrl = '"._RunMagicQuotes($cfg_ftpUrl)."';\r\n";
		$configFile .= "\$cfg_ftpServer = '"._RunMagicQuotes($cfg_ftpServer)."';\r\n";
		$configFile .= "\$cfg_ftpPort = "._RunMagicQuotes($cfg_ftpPort).";\r\n";
		$configFile .= "\$cfg_ftpDir = '"._RunMagicQuotes($cfg_ftpDir)."';\r\n";
		$configFile .= "\$cfg_ftpUser = '"._RunMagicQuotes($cfg_ftpUser)."';\r\n";
		$configFile .= "\$cfg_ftpPwd = '"._RunMagicQuotes($cfg_ftpPwd)."';\r\n";
		$configFile .= "\$cfg_ftpTimeout = "._RunMagicQuotes($cfg_ftpTimeout).";\r\n";
		$configFile .= "\$cfg_OSSUrl = '"._RunMagicQuotes($cfg_OSSUrl)."';\r\n";
		$configFile .= "\$cfg_OSSBucket = '"._RunMagicQuotes($cfg_OSSBucket)."';\r\n";
		$configFile .= "\$cfg_OSSKeyID = '"._RunMagicQuotes($cfg_OSSKeyID)."';\r\n";
		$configFile .= "\$cfg_OSSKeySecret = '"._RunMagicQuotes($cfg_OSSKeySecret)."';\r\n";

		//水印设置
		$configFile .= "\$thumbMarkState = "._RunMagicQuotes($thumbMarkState).";\r\n";
		$configFile .= "\$atlasMarkState = "._RunMagicQuotes($atlasMarkState).";\r\n";
		$configFile .= "\$editorMarkState = "._RunMagicQuotes($editorMarkState).";\r\n";
		$configFile .= "\$waterMarkWidth = "._RunMagicQuotes($waterMarkWidth).";\r\n";
		$configFile .= "\$waterMarkHeight = "._RunMagicQuotes($waterMarkHeight).";\r\n";
		$configFile .= "\$waterMarkPostion = "._RunMagicQuotes($waterMarkPostion).";\r\n";
		$configFile .= "\$waterMarkType = "._RunMagicQuotes($waterMarkType).";\r\n";
		$configFile .= "\$waterMarkText = '"._RunMagicQuotes($waterMarkText)."';\r\n";
		$configFile .= "\$markFontfamily = '"._RunMagicQuotes($markFontfamily)."';\r\n";
		$configFile .= "\$markFontsize = "._RunMagicQuotes($markFontsize).";\r\n";
		$configFile .= "\$markFontColor = '"._RunMagicQuotes($markFontColor)."';\r\n";
		$configFile .= "\$markFile = '"._RunMagicQuotes($markFile)."';\r\n";
		$configFile .= "\$markPadding = "._RunMagicQuotes($markPadding).";\r\n";
		$configFile .= "\$markTransparent = "._RunMagicQuotes($markTransparent).";\r\n";
		$configFile .= "\$markQuality = "._RunMagicQuotes($markQuality).";\r\n";

		//基本安全配置
		$configFile .= "\$cfg_holdsubdomain = '"._RunMagicQuotes($cfg_holdsubdomain)."';\r\n";
		$configFile .= "\$cfg_iplimit = '"._RunMagicQuotes($cfg_iplimit)."';\r\n";
		$configFile .= "\$cfg_errLoginCount = ".(int)_RunMagicQuotes($cfg_errLoginCount).";\r\n";
		$configFile .= "\$cfg_loginLock = ".(int)_RunMagicQuotes($cfg_loginLock).";\r\n";
		$configFile .= "\$cfg_regstatus = "._RunMagicQuotes($cfg_regstatus).";\r\n";
		$configFile .= "\$cfg_regverify = "._RunMagicQuotes($cfg_regverify).";\r\n";
		$configFile .= "\$cfg_regtime = "._RunMagicQuotes($cfg_regtime).";\r\n";
		$configFile .= "\$cfg_holduser = '"._RunMagicQuotes($cfg_holduser)."';\r\n";
		$configFile .= "\$cfg_regclosemessage = '"._RunMagicQuotes($cfg_regclosemessage)."';\r\n";
		$configFile .= "\$cfg_replacestr = '"._RunMagicQuotes($cfg_replacestr)."';\r\n";

		//验证码
		$configFile .= "\$cfg_seccodestatus = '"._RunMagicQuotes($cfg_seccodestatus)."';\r\n";
		$configFile .= "\$cfg_seccodetype = "._RunMagicQuotes($cfg_seccodetype).";\r\n";
		$configFile .= "\$cfg_seccodewidth = "._RunMagicQuotes($cfg_seccodewidth).";\r\n";
		$configFile .= "\$cfg_seccodeheight = "._RunMagicQuotes($cfg_seccodeheight).";\r\n";
		$configFile .= "\$cfg_seccodefamily = '"._RunMagicQuotes($cfg_seccodefamily)."';\r\n";
		$configFile .= "\$cfg_scecodeangle = "._RunMagicQuotes($cfg_scecodeangle).";\r\n";
		$configFile .= "\$cfg_scecodewarping = "._RunMagicQuotes($cfg_scecodewarping).";\r\n";
		$configFile .= "\$cfg_scecodeshadow = "._RunMagicQuotes($cfg_scecodeshadow).";\r\n";
		$configFile .= "\$cfg_scecodeanimator = "._RunMagicQuotes($cfg_scecodeanimator).";\r\n";

		//安全问题
		$configFile .= "\$cfg_secqaastatus = '"._RunMagicQuotes($cfg_secqaastatus)."';\r\n";

		//论坛配置参数
		$configFile .= "\$cfg_bbsName = '"._RunMagicQuotes($cfg_bbsName)."';\r\n";
		$configFile .= "\$cfg_bbsUrl = '"._RunMagicQuotes($cfg_bbsUrl)."';\r\n";
		$configFile .= "\$cfg_bbsState = ".(int)$cfg_bbsState.";\r\n";
		$configFile .= "\$cfg_bbsType = '"._RunMagicQuotes($cfg_bbsType)."';\r\n";

		//极验验证码
		$configFile .= "\$cfg_geetest = ".(int)$cfg_geetest.";\r\n";
		$configFile .= "\$cfg_geetest_pc_id = '"._RunMagicQuotes($cfg_geetest_pc_id)."';\r\n";
		$configFile .= "\$cfg_geetest_pc_key = '"._RunMagicQuotes($cfg_geetest_pc_key)."';\r\n";
		$configFile .= "\$cfg_geetest_mobile_id = '"._RunMagicQuotes($cfg_geetest_mobile_id)."';\r\n";
		$configFile .= "\$cfg_geetest_mobile_key = '"._RunMagicQuotes($cfg_geetest_mobile_key)."';\r\n";

		$configFile .= "?".">";

		$configIncFile = HUONIAOINC.'/config/siteConfig.inc.php';
		$fp = fopen($configIncFile, "w") or die('{"state": 200, "info": '.json_encode("写入文件 $configIncFile 失败，请检查权限！").'}');
		fwrite($fp, $configFile);
		fclose($fp);

		die('{"state": 100, "info": '.json_encode("配置成功！").'}');
		exit;

	}
}

//配置参数
require_once(HUONIAOINC.'/config/siteConfig.inc.php');

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery.colorPicker.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/siteConfig/siteConfig.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	//基本设置
	$huoniaoTag->assign('basehost', $cfg_basehost);
	$huoniaoTag->assign('webname', $cfg_webname);
	$huoniaoTag->assign('shortname', $cfg_shortname);
	$huoniaoTag->assign('weblogo', $cfg_weblogo);
	$huoniaoTag->assign('keywords', $cfg_keywords);
	$huoniaoTag->assign('description', $cfg_description);
	$huoniaoTag->assign('beian', $cfg_beian);
	$huoniaoTag->assign('hotline', $cfg_hotline);
	$huoniaoTag->assign('powerby', stripslashes($cfg_powerby));
	$huoniaoTag->assign('statisticscode', stripslashes($cfg_statisticscode));

	//网站状态-单选
	$huoniaoTag->assign('visitState', array('0', '1'));
	$huoniaoTag->assign('visitStateNames',array('启用','禁用'));
	$huoniaoTag->assign('visitStateChecked', $cfg_visitState);
	$huoniaoTag->assign('visitMessage', $cfg_visitMessage);

	//默认时区
	$timeZoneList = array(
		-12 => '(标准时-12:00) 日界线西',
		-11 => '(标准时-11:00) 中途岛、萨摩亚群岛',
		-10 => '(标准时-10:00) 夏威夷',
		-9 => '(标准时-9:00) 阿拉斯加',
		-8 => '(标准时-8:00) 太平洋时间(美国和加拿大)',
		-7 => '(标准时-7:00) 山地时间(美国和加拿大)',
		-6 => '(标准时-6:00) 中部时间(美国和加拿大)、墨西哥城',
		-5 => '(标准时-5:00) 东部时间(美国和加拿大)、波哥大',
		-4 => '(标准时-4:00) 大西洋时间(加拿大)、加拉加斯',
		-3.5 => '(标准时-3:30) 纽芬兰',
		-3 => '(标准时-3:00) 巴西、布宜诺斯艾利斯、乔治敦',
		-2 => '(标准时-2:00) 中大西洋',
		-1 => '(标准时-1:00) 亚速尔群岛、佛得角群岛',
		0 => '(格林尼治标准时) 西欧时间、伦敦、卡萨布兰卡',
		1 => '(标准时+1:00) 中欧时间、安哥拉、利比亚',
		2 => '(标准时+2:00) 东欧时间、开罗，雅典',
		3 => '(标准时+3:00) 巴格达、科威特、莫斯科',
		3.5 => '(标准时+3:30) 德黑兰',
		4 => '(标准时+4:00) 阿布扎比、马斯喀特、巴库',
		4.5 => '(标准时+4:30) 喀布尔',
		5 => '(标准时+5:00) 叶卡捷琳堡、伊斯兰堡、卡拉奇',
		5.5 => '(标准时+5:30) 孟买、加尔各答、新德里',
		6 => '(标准时+6:00) 阿拉木图、 达卡、新亚伯利亚',
		7 => '(标准时+7:00) 曼谷、河内、雅加达',
		8 => '(北京时间) 北京、重庆、香港、新加坡',
		9 => '(标准时+9:00) 东京、汉城、大阪、雅库茨克',
		9.5 => '(标准时+9:30) 阿德莱德、达尔文',
		10 => '(标准时+10:00) 悉尼、关岛',
		11 => '(标准时+11:00) 马加丹、索罗门群岛',
		12 => '(标准时+12:00) 奥克兰、惠灵顿、堪察加半岛'
	);
	$huoniaoTag->assign('timeZoneList', $timeZoneList);
	$huoniaoTag->assign('timeZone', $cfg_timeZone);
	$huoniaoTag->assign('mapCity', $cfg_mapCity);

	//地图配置
	$huoniaoTag->assign('mapList', array(1 => '谷歌', 2 => '百度', 3 => '腾迅', 4 => '高德'));
	$huoniaoTag->assign('mapSelected', $cfg_map);

	$mapkeyhtml = array();
	$cla = "clearfix";
	if($cfg_map != 1) $cla .= " hide";
	array_push($mapkeyhtml, '<dl id="map1" class="'.$cla.'">
      <dt><label for="mapkey_google">谷歌地图API密钥：</label></dt>
      <dd><div class="input-prepend input-append"><input class="input-xlarge" type="text" name="mapkey_google" id="mapkey_google" value="'.$cfg_map_google.'" /><div class="btn-group"><a href="http://code.google.com/intl/zh-CN/apis/maps/signup.html" class="btn" target="_blank">申请GoogleMap密钥 <i class="icon-share-alt"></i></a></div></div></dd>
    </dl>');
	$cla = "clearfix";
	if($cfg_map != 2) $cla .= " hide";
	array_push($mapkeyhtml, '<dl id="map2" class="'.$cla.'">
      <dt><label for="mapkey_baidu">百度地图ak：</label></dt>
      <dd><div class="input-prepend input-append"><input class="input-xlarge" type="text" name="mapkey_baidu" id="mapkey_baidu" value="'.$cfg_map_baidu.'" /><div class="btn-group"><a href="http://lbsyun.baidu.com/apiconsole/key?application=key" class="btn" target="_blank">申请BaiduMap AK <i class="icon-share-alt"></i></a></div></div></dd>
    </dl>');
	$cla = "clearfix";
	if($cfg_map != 3) $cla .= " hide";
	array_push($mapkeyhtml, '<dl id="map3" class="'.$cla.'">
      <dt><label for="mapkey_qq">腾迅地图API密钥：</label></dt>
      <dd><div class="input-prepend input-append"><input class="input-xlarge" type="text" name="mapkey_qq" id="mapkey_qq" value="'.$cfg_map_qq.'" /><div class="btn-group"><a href="http://open.map.qq.com/ApplicationKey.html" class="btn" target="_blank">申请腾迅地图密钥 <i class="icon-share-alt"></i></a></div></div></dd>
    </dl>');
    $cla = "clearfix";
	if($cfg_map != 4) $cla .= " hide";
	array_push($mapkeyhtml, '<dl id="map4" class="'.$cla.'">
      <dt><label for="mapkey_amap">高德地图API密钥：</label></dt>
      <dd><div class="input-prepend input-append"><input class="input-xlarge" type="text" name="mapkey_amap" id="mapkey_amap" value="'.$cfg_map_amap.'" /><div class="btn-group"><a href="http://api.amap.com/key/" class="btn" target="_blank">申请高德地图密钥 <i class="icon-share-alt"></i></a></div></div></dd>
    </dl>');
	$huoniaoTag->assign('mapkey', join("", $mapkeyhtml));

	$huoniaoTag->assign('weatherCity', $cfg_weatherCity);

	//在线用户时限
	$huoniaoTag->assign('onlinetime', $cfg_onlinetime);
	//cookie设置
	$huoniaoTag->assign('cookiePath', $cfg_cookiePath);
	$huoniaoTag->assign('cookieDomain', $cfg_cookieDomain);
	$huoniaoTag->assign('cookiePre', $cfg_cookiePre);
	$huoniaoTag->assign('cache_lifetime', $cfg_cache_lifetime);

	//开启伪静态
	$huoniaoTag->assign('urlRewriteState', array('0', '1'));
	$huoniaoTag->assign('urlRewriteStateNames',array('关闭','开启'));
	$huoniaoTag->assign('urlRewriteStateChecked', $cfg_urlRewrite);

	//隐藏文件真实路径
	$huoniaoTag->assign('hideUrlState', array('1', '0'));
	$huoniaoTag->assign('hideUrlStateNames',array('隐藏','不隐藏'));
	$huoniaoTag->assign('hideUrlStateChecked', $cfg_hideUrl);

	//模板风格
	$floders = listDir($dir);
	$skins = array();
	if(!empty($floders)){
		$i = 0;
		foreach($floders as $key => $floder){
			$config = $dir.'/'.$floder.'/config.xml';
			if(file_exists($config)){
				//解析xml配置文件
				$xml = new DOMDocument();
				libxml_disable_entity_loader(false);
				$xml->load($config);
				$data = $xml->getElementsByTagName('Data')->item(0);
				$tplname = $data->getElementsByTagName("tplname")->item(0)->nodeValue;
				$copyright = $data->getElementsByTagName("copyright")->item(0)->nodeValue;

				$skins[$i]['tplname'] = $tplname;
				$skins[$i]['directory'] = $floder;
				$skins[$i]['copyright'] = $copyright;
				$i++;
			}
		}
	}
	$huoniaoTag->assign('tplList', $skins);
	$huoniaoTag->assign('template', $cfg_template);

	//touch模板
	$floders = listDir($dir.'/touch');
	$skins = array();
	if(!empty($floders)){
		$i = 0;
		foreach($floders as $key => $floder){
			$config = $dir.'/touch/'.$floder.'/config.xml';
			if(file_exists($config)){
				//解析xml配置文件
				$xml = new DOMDocument();
				libxml_disable_entity_loader(false);
				$xml->load($config);
				$data = $xml->getElementsByTagName('Data')->item(0);
				$tplname = $data->getElementsByTagName("tplname")->item(0)->nodeValue;
				$copyright = $data->getElementsByTagName("copyright")->item(0)->nodeValue;

				$skins[$i]['tplname'] = $tplname;
				$skins[$i]['directory'] = $floder;
				$skins[$i]['copyright'] = $copyright;
				$i++;
			}
		}
	}
	$huoniaoTag->assign('touchTplList', $skins);
	$huoniaoTag->assign('touchTemplate', $cfg_touchTemplate);


	//上传设置
	$huoniaoTag->assign('uploadDir', $cfg_uploadDir);
	$huoniaoTag->assign('softSize', $cfg_softSize);
	$huoniaoTag->assign('softType', $cfg_softType);
	$huoniaoTag->assign('thumbSize', $cfg_thumbSize);
	$huoniaoTag->assign('thumbType_', $cfg_thumbType);
	$huoniaoTag->assign('atlasSize', $cfg_atlasSize);
	$huoniaoTag->assign('atlasType', $cfg_atlasType);
	$huoniaoTag->assign('editorSize', $cfg_editorSize);
	$huoniaoTag->assign('editorType', $cfg_editorType);
	$huoniaoTag->assign('photoSize', $cfg_photoSize);
	$huoniaoTag->assign('photoType_', $cfg_photoType);
	$huoniaoTag->assign('flashSize', $cfg_flashSize);
	$huoniaoTag->assign('audioSize', $cfg_audioSize);
	$huoniaoTag->assign('audioType_', $cfg_audioType);
	$huoniaoTag->assign('videoSize', $cfg_videoSize);
	$huoniaoTag->assign('videoType_', $cfg_videoType);
	$huoniaoTag->assign('thumbSmallWidth', $cfg_thumbSmallWidth);
	$huoniaoTag->assign('thumbSmallHeight', $cfg_thumbSmallHeight);
	$huoniaoTag->assign('thumbMiddleWidth', $cfg_thumbMiddleWidth);
	$huoniaoTag->assign('thumbMiddleHeight', $cfg_thumbMiddleHeight);
	$huoniaoTag->assign('thumbLargeWidth', $cfg_thumbLargeWidth);
	$huoniaoTag->assign('thumbLargeHeight', $cfg_thumbLargeHeight);
	$huoniaoTag->assign('atlasSmallWidth', $cfg_atlasSmallWidth);
	$huoniaoTag->assign('atlasSmallHeight', $cfg_atlasSmallHeight);
	$huoniaoTag->assign('photoSmallWidth', $cfg_photoSmallWidth);
	$huoniaoTag->assign('photoSmallHeight', $cfg_photoSmallHeight);
	$huoniaoTag->assign('photoMiddleWidth', $cfg_photoMiddleWidth);
	$huoniaoTag->assign('photoMiddleHeight', $cfg_photoMiddleHeight);
	$huoniaoTag->assign('photoLargeWidth', $cfg_photoLargeWidth);
	$huoniaoTag->assign('photoLargeHeight', $cfg_photoLargeHeight);
	$huoniaoTag->assign('meditorPicWidth', $cfg_meditorPicWidth);
	$huoniaoTag->assign('photoCutType', $cfg_photoCutType);
	$huoniaoTag->assign('photoCutPostion', $cfg_photoCutPostion);
	$huoniaoTag->assign('quality', $cfg_quality);

	//远程附件
	$huoniaoTag->assign('ftpType', array('0', '1'));
	$huoniaoTag->assign('ftpTypeNames',array('普通FTP模式','阿里云OSS'));
	$huoniaoTag->assign('ftpTypeChecked', (int)$cfg_ftpType);

	$huoniaoTag->assign('ftpStateType', array('0', '1'));
	$huoniaoTag->assign('ftpStateNames',array('否','是'));
	$huoniaoTag->assign('ftpStateChecked', $cfg_ftpState);

	$huoniaoTag->assign('ftpSSL', array('0', '1'));
	$huoniaoTag->assign('ftpSSLNames',array('否','是'));
	$huoniaoTag->assign('ftpSSLChecked', $cfg_ftpSSL);

	$huoniaoTag->assign('ftpPasv', array('0', '1'));
	$huoniaoTag->assign('ftpPasvNames',array('否','是'));
	$huoniaoTag->assign('ftpPasvChecked', $cfg_ftpPasv);

	$huoniaoTag->assign('ftpUrl', $cfg_ftpUrl);
	$huoniaoTag->assign('ftpServer', $cfg_ftpServer);
	$huoniaoTag->assign('ftpPort', $cfg_ftpPort);
	$huoniaoTag->assign('ftpDir', $cfg_ftpDir);
	$huoniaoTag->assign('ftpUser', $cfg_ftpUser);
	$huoniaoTag->assign('ftpPwd', $cfg_ftpPwd);
	$huoniaoTag->assign('ftpTimeout', $cfg_ftpTimeout);
	$huoniaoTag->assign('OSSUrl', $cfg_OSSUrl);
	$huoniaoTag->assign('OSSBucket', $cfg_OSSBucket);
	$huoniaoTag->assign('OSSKeyID', $cfg_OSSKeyID);
	$huoniaoTag->assign('OSSKeySecret', $cfg_OSSKeySecret);

	//水印设置
	$huoniaoTag->assign('thumbMarkState', array('0', '1'));
	$huoniaoTag->assign('thumbMarkStateNames',array('关闭','开启'));
	$huoniaoTag->assign('thumbMarkStateChecked', $thumbMarkState);

	$huoniaoTag->assign('atlasMarkState', array('0', '1'));
	$huoniaoTag->assign('atlasMarkStateNames',array('关闭','开启'));
	$huoniaoTag->assign('atlasMarkStateChecked', $atlasMarkState);

	$huoniaoTag->assign('editorMarkState', array('0', '1'));
	$huoniaoTag->assign('editorMarkStateNames',array('关闭','开启'));
	$huoniaoTag->assign('editorMarkStateChecked', $editorMarkState);

	$huoniaoTag->assign('waterMarkWidth', $waterMarkWidth);
	$huoniaoTag->assign('waterMarkHeight', $waterMarkHeight);
	$huoniaoTag->assign('waterMarkPostion', $waterMarkPostion);
	//水印类型-单选
	$huoniaoTag->assign('waterMarkType', array('1', '2', '3'));
	$huoniaoTag->assign('waterMarkTypeNames',array('文字','PNG图片','GIF图片'));
	$huoniaoTag->assign('waterMarkTypeChecked', $waterMarkType);
	$huoniaoTag->assign('markText', $waterMarkText);

	//水印字体
	$ttfFloder = HUONIAOINC."/data/fonts/";
	if(is_dir($ttfFloder)){
		if ($file = opendir($ttfFloder)){
			$fileArray = array();
			while ($f = readdir($file)){
				if($f != '.' && $f != '..'){
					array_push($fileArray, $f);
				}
			}
			//字体文件-下拉菜单
			$huoniaoTag->assign('markFontfamily', $fileArray);
			$huoniaoTag->assign('markFontfamilySelected', $markFontfamily);
		}
	}

	$huoniaoTag->assign('markFontsize', $markFontsize);
	$huoniaoTag->assign('markFontColor', $markFontColor);

	//水印图片
	$markFloder = HUONIAOINC."/data/mark/";
	if(is_dir($markFloder)){
		if ($file = opendir($markFloder)){
			$fileArray = array();
			while ($f = readdir($file)){
				if($f != '.' && $f != '..'){
					array_push($fileArray, $f);
				}
			}
			//字体文件-下拉菜单
			$huoniaoTag->assign('markFile', $fileArray);
			$huoniaoTag->assign('markFileSelected', $markFile);
		}
	}

	$huoniaoTag->assign('markPadding', $markPadding);
	$huoniaoTag->assign('transparent', $markTransparent);
	$huoniaoTag->assign('markQuality', $markQuality);
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/siteConfig";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
