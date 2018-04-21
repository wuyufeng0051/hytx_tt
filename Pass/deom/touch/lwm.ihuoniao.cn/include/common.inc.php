<?php
/**
 * 系统核心配置文件
 *
 * @version        $Id: common.inc.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.Libraries
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
ob_start();
session_start();
ini_set('display_errors','On');
error_reporting(E_ALL & ~E_NOTICE);

define('HUONIAOINC', str_replace("\\", '/', dirname(__FILE__) ) );         //当前目录
define('HUONIAOROOT', str_replace("\\", '/', substr(HUONIAOINC,0,-8) ) );  //根目录
define('HUONIAODATA', HUONIAOROOT.'/data');                                //系统配置目录
define('HUONIAOBUG', TRUE);                                                //开启调试
define('sysBtime', microtime(true));

//软件摘要信息
$cfg_softname     = '火鸟网站管理系统';              //软件中文名
$cfg_soft_enname  = 'HuoNiaoCMS';                  //软件英文名
$cfg_soft_devteam = 'HuoNiaoCMS官方团队';           //软件团队名
//$cfg_version      = 'V1_SP1';                    //软件版本
$cfg_soft_lang    = 'utf-8';                       //软件语言

header("Content-Type: text/html; charset={$cfg_soft_lang}");
// header('X-Frame-Options: SAMEORIGIN');  //页面只能被本站页面嵌入到iframe或者frame中。

require_once(HUONIAOINC.'/config/siteConfig.inc.php');  //系统配置参数
require_once(HUONIAOINC.'/config/pointsConfig.inc.php');  //会员积分配置
require_once(HUONIAOINC.'/config/wechatConfig.inc.php');  //微信基本配置

//会员配置参数
require_once(HUONIAOINC.'/config/member.inc.php');

$cfg_attachment   = 'http://'.$cfg_basehost.'/include/attachment.php?f=';  //附件访问地址
$cfg_staticPath   = 'http://'.$cfg_basehost.'/static/'; //静态文件地址

//php5.1版本以上时区设置
//由于这个函数对于是php5.1以下版本并无意义，因此实际上的时间调用，应该用MyDate函数调用
if(PHP_VERSION > '5.1'){
    $time51 = $cfg_timeZone * -1;
    @date_default_timezone_set('Etc/GMT'.$time51);
}

//配置全局附件路径 $cfg_fileUrl
if($cfg_ftpState == 1){
	$cfg_fileUrl = $cfg_ftpUrl.str_replace(".", "", $cfg_ftpDir);
}else{
	$cfg_fileUrl = $cfg_uploadDir;
}

//转换上传的文件相关的变量及安全处理、并引用前台通用的上传函数
if($_FILES){
    require_once(HUONIAOINC.'/uploadsafe.inc.php');
}

//数据库配置文件
require_once(HUONIAOINC.'/dbinfo.inc.php');

//生成一个PDO对象
$dsn = "mysql:host=".$GLOBALS['DB_HOST'].";dbname=".$GLOBALS['DB_NAME'];
try{
	$_opts_values = array(PDO::ATTR_PERSISTENT=>true,PDO::ATTR_ERRMODE=>2,PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
	$dbo = @new PDO($dsn, $GLOBALS['DB_USER'], $GLOBALS['DB_PASS'], $_opts_values);
}catch(Exception $e){
	//如果连接失败，输出错误
	if (HUONIAOBUG === TRUE){
		die($e->getMessage());
	}else{
		die('数据库链接失败，请检查配置信息！');
	}
}

//建立数据库连接
$dsql      = new dsql($dbo);
$userLogin = new userLogin($dbo);

//全局常用函数
require_once(HUONIAOINC.'/common.func.php');

//检测IP段
if(checkIpAccess(GetIP(), $cfg_iplimit) && !empty($cfg_iplimit)){
	die("您的IP已被限制！");
}

//载入插件配置,并对其进行默认初始化
$cfg_plug_autoload = array(
	'charset',    /* 编码插件 */
	'string',     /* 字符串插件 */
	'time',       /* 日期插件 */
	'file',       /* 文件插件 */
	'util',       /* 单元插件 */
	'validate',   /* 数据验证插件 */
	'filter',     /* 过滤器插件 */
	'cookie',     /* cookies插件 */
	'upload',     /* 上传插件 */
	'debug',      /* 验证插件 */
	'myad',				/* 广告插件 */
	'cron'				/* 计划任务 */
);
loadPlug($cfg_plug_autoload);

//执行计划任务
Cron::run();

//Session保存路径
$sessSavePath = HUONIAODATA."/sessions/";
if(is_writeable($sessSavePath) && is_readable($sessSavePath)){
    session_save_path($sessSavePath);
}

//Session跨域设置
if(!empty($cfg_cookieDomain)){
    @session_set_cookie_params(0,'/',$cfg_cookieDomain);
}

function _RunMagicQuotes(&$svar){
    if(!get_magic_quotes_gpc()){
        if( is_array($svar)){
            foreach($svar as $_k => $_v) $svar[$_k] = _RunMagicQuotes($_v);
        }else{
            if( strlen($svar)>0 && preg_match('#^(_GET|_POST|_COOKIE)#',$svar)){
              exit('Request var not allow!');
            }

            //先删除反斜杠，再增加反斜杠，如果不先删除，多提交几次就会出现：\\\\\\\'这种情况
            $svar = addslashes(stripslashes($svar));
        }
    }
    return $svar;
}

//检查和注册外部提交的变量
function CheckRequest(&$val){
	if (is_array($val)){
		foreach ($val as $_k=>$_v) {
			if($_k == 'nvarname') continue;
			CheckRequest($_k);
			CheckRequest($val[$_k]);
		}
	}else{
		if( strlen($val)>0 && preg_match('#^(_GET|_POST|_COOKIE)#',$val)){
			exit('Request var not allow!');
		}
	}
}

//var_dump($_REQUEST);exit;
CheckRequest($_REQUEST);

foreach(Array('_GET','_POST','_COOKIE') as $_request){
	foreach($$_request as $_k => $_v){
		if($_k == 'nvarname') ${$_k} = $_v;
		else ${$_k} = _RunMagicQuotes($_v);
	}
}

//如果session没有防跨站请求标记则生成一个
if(!isset($_SESSION['token'])){
	$_SESSION['token'] = sha1(uniqid(mt_rand(), TRUE));
}

//站点根目录
$cfg_basedir = preg_replace('#\/include$#i', '', HUONIAOINC);

//模板引擎初始化配置
include_once(HUONIAOINC."/tpl/Smarty.class.php");                   //包含smarty类文件
$huoniaoTag = new Smarty();                                         //建立smarty实例对象$smarty
$huoniaoTag->caching         = empty($cfg_cache_lifetime) ? FALSE : TRUE;  //是否使用缓存，项目在调试期间，不建议启用缓存
$huoniaoTag->template_dir    = HUONIAOROOT."/templates";            //设置模板目录
$huoniaoTag->compile_dir     = HUONIAOROOT."/templates_c/compiled"; //设置编译目录
$huoniaoTag->cache_dir       = HUONIAOROOT."/templates_c/caches";   //页面缓存文件夹
$huoniaoTag->cache_lifetime  = $cfg_cache_lifetime;                 //缓存时间
$huoniaoTag->left_delimiter  = "{#";                                //模板开始标记
$huoniaoTag->right_delimiter = "#}";                                //模板结束标记
// $huoniaoTag->compile_check   = false;														//每次访问都必须检测模板，默认为true
spl_autoload_register("__autoload");                                //解决 __autoload 和 Smarty 冲突

//初始化通用模板标签
$huoniaoTag->assign("HUONIAOROOT",    HUONIAOROOT);          //网站根目录
$huoniaoTag->assign("cfg_clihost",    $cfg_basehost);        //域名
$huoniaoTag->assign("cfg_softname",   $cfg_softname);        //软件名
$huoniaoTag->assign("cfg_softenname", $cfg_soft_enname);     //软件英文名
$huoniaoTag->assign("cfg_version",    $cfg_version);         //软件版本
$huoniaoTag->assign("cfg_soft_lang",  $cfg_soft_lang);       //软件语言
$huoniaoTag->assign("thumbSize",      $cfg_thumbSize);       //缩略图上传大小限制
$huoniaoTag->assign("atlasSize",      $cfg_atlasSize);       //图集单张图片上传大小限制
$huoniaoTag->assign("thumbType",      "*.".str_replace("|", ";*.", $cfg_thumbType));     //缩略图上传类型限制
$huoniaoTag->assign("atlasType",      "*.".str_replace("|", ";*.", $cfg_atlasType));     //图集上传类型限制
$huoniaoTag->assign("HUONIAOINC",     HUONIAOINC);
$huoniaoTag->assign("HUONIAOROOT",    HUONIAOROOT);
$huoniaoTag->assign("HUONIAODATA",    HUONIAODATA);
$huoniaoTag->assign("HTTP_REFERER",   $_SERVER['HTTP_REFERER']);   //上一页的地址
$huoniaoTag->assign("cfg_fileUrl",    $cfg_fileUrl);
$huoniaoTag->assign("token",          $_SESSION['token']);         //全站token
$huoniaoTag->assign("editorFile",     includeFile('editor'));      //载入编辑器脚本
$huoniaoTag->assign("cfg_attachment", $cfg_attachment);            //附件访问地址

//系统配置参数
$huoniaoTag->assign("cfg_basehost",       "http://".$cfg_basehost);
$huoniaoTag->assign("cfg_webname",        stripslashes($cfg_webname));
$huoniaoTag->assign("cfg_shortname",      stripslashes($cfg_shortname));

$huoniaoTag->assign("cfg_weblogo",        getFilePath($cfg_weblogo));
$huoniaoTag->assign("cfg_keywords",       stripslashes($cfg_keywords));
$huoniaoTag->assign("cfg_description",    stripslashes($cfg_description));
$huoniaoTag->assign("cfg_beian",          stripslashes($cfg_beian));
$huoniaoTag->assign("cfg_hotline",        stripslashes($cfg_hotline));
$huoniaoTag->assign("cfg_powerby",        stripslashes($cfg_powerby));
$huoniaoTag->assign("cfg_statisticscode", stripslashes($cfg_statisticscode));
$huoniaoTag->assign("cfg_mapCity",        $cfg_mapCity);
$huoniaoTag->assign("cfg_weatherCity",    $cfg_weatherCity);
$huoniaoTag->assign("cfg_template",       $cfg_template);
$huoniaoTag->assign("cfg_cookieDomain",   $cfg_cookieDomain);
$huoniaoTag->assign("cfg_cookiePre",      $cfg_cookiePre);
$huoniaoTag->assign("cfg_bbsUrl",         $cfg_bbsUrl);

//会员积分配置
$huoniaoTag->assign("cfg_pointName",      $cfg_pointName);
$huoniaoTag->assign("cfg_pointRatio",     $cfg_pointRatio);
$huoniaoTag->assign("cfg_pointFee",       $cfg_pointFee);

//微信基本配置
$huoniaoTag->assign("cfg_wechatName",     $cfg_wechatName);  //公众号名称
$huoniaoTag->assign("cfg_wechatCode",     $cfg_wechatCode);  //微信号
$huoniaoTag->assign("cfg_weixinQr",       getFilePath($cfg_wechatQr));  //二维码

//极验验证
$huoniaoTag->assign("cfg_geetest",            (int)$cfg_geetest);            //是否开启  1为开启 0为未开启
$huoniaoTag->assign("cfg_geetest_pc_id",      $cfg_geetest_pc_id);      //网页端ID
$huoniaoTag->assign("cfg_geetest_pc_key",     $cfg_geetest_pc_key);     //网页端KEY
$huoniaoTag->assign("cfg_geetest_mobile_id",  $cfg_geetest_mobile_id);  //移动端ID
$huoniaoTag->assign("cfg_geetest_mobile_key", $cfg_geetest_mobile_key);     //移动端KEY


//app配置
$sql = $dsql->SetQuery("SELECT * FROM `#@__app_config` LIMIT 1");
$ret = $dsql->dsqlOper($sql, "results");
if($ret){
    $data = $ret[0];
    $huoniaoTag->assign('cfg_app_logo', $data['logo']);
    $huoniaoTag->assign('cfg_app_android_version', $data['android_version']);
    $huoniaoTag->assign('cfg_app_ios_version', $data['ios_version']);
    $huoniaoTag->assign('cfg_app_android_download', $data['android_download']);
    $huoniaoTag->assign('cfg_app_ios_download', $data['ios_download']);
}



//地图配置
$module_map =  $moduleConfig['map'];
if(!empty($module_map)){
	$cfg_map = $module_map;
}

switch ($cfg_map) {
	case 1:
		$site_map = "google";
		$site_map_key = $cfg_map_google;
		$site_map_apiFile = "http://maps.google.cn/maps/api/js?key=".$site_map_key."&sensor=false&language=zh-CN";
		break;
	case 2:
		$site_map = "baidu";
		$site_map_key = $cfg_map_baidu;
		$site_map_apiFile = "http://api.map.baidu.com/api?v=2.0&ak=".$site_map_key;
		break;
	case 3:
		$site_map = "qq";
		$site_map_key = $cfg_map_qq;
		$site_map_apiFile = "http://map.qq.com/api/js?key=".$cfg_map_qq."&libraries=drawing";
		break;
	case 4:
		$site_map = "amap";
		$site_map_key = $cfg_map_amap;
		$site_map_apiFile = "http://webapi.amap.com/maps?v=1.3&key=".$site_map_key;
		break;
	default:
		$site_map = "baidu";
		$site_map_key = $cfg_map_baidu;
		$site_map_apiFile = "http://api.map.baidu.com/api?v=2.0&ak=".$site_map_key;
		break;
}

$huoniaoTag->assign('site_map', $site_map);
$huoniaoTag->assign('site_map_key', $site_map_key);
$huoniaoTag->assign('site_map_apiFile', $site_map_apiFile);



$huoniaoTag->assign('nowHour', getNowHour());   //获取当前时辰

$huoniaoTag->registerPlugin("function", 'getUrlPath', 'getUrlPath');    //注册获取链接函数   主要以拼接静态URL为主  例：list-1-1-1-1-1-1-1.html
$huoniaoTag->registerPlugin("function", 'getUrlParam', 'getUrlParam');  //注册获取链接函数   主要以拼接URL参数为主  例：list.html?a=1&b=1&c=1&d=1
$huoniaoTag->registerPlugin("function", 'getPageList', 'getPageList');  //打印分页信息


//注册模板函数
$registerPlugin = array(
	"myad"           => "getMyAd",         //广告函数
	"getMyTime"      => "getMyTime",       //时间函数
	"getMyWeek"      => "getMyWeek",       //星期函数
	"bodyPageList"   => "bodyPageList",    //内容分页函数
	"getTypeInfo"    => "getTypeInfo",     //分类详细信息
	"getTypeName"    => "getTypeName",     //分类名称
	"getChannel"     => "getChannel",      //导航函数
	"getWeather"     => "getWeather",      //天气预报
	"changeFileSize" => "changeFileSize",  //附件地址
	"numberDaxie"    => "numberDaxie",     //数字大小写转换
	"getImgHeightByGeometric" => "getImgHeightByGeometric",      //根据图片路径、指定宽度，获取等比缩放后的高度
	"resizeImageSize" => "resizeImageSize",      //获取等比例缩放后的图片尺寸
    "getPublicParentInfo" => "getPublicParentInfo"      //根据指定表、指定ID获取相关信息
);

if(!empty($registerPlugin)){
	foreach ($registerPlugin as $key => $value) {
		$huoniaoTag->registerPlugin("function", $key, $value);
	}
}


//临时解决模块中调用没有安装的模块时报错的问题 -by guozi 20160811
function registerPluginBlockNull(){};
$allModuleArr = array("article", "info", "tuan", "house", "shop", "build", "furniture", "home", "renovation", "job", "dating", "marry", "paper", "special", "website", "waimai", "car", "travel", "tieba", "huodong", "huangye", "vote", "pic", "video");
foreach ($allModuleArr as $key => $value) {
  $huoniaoTag->registerPlugin("block", $value, "registerPluginBlockNull");
}


//获取系统模块
$installModuleArr = array();
$sql = $dsql->SetQuery("SELECT `name` FROM `#@__site_module` WHERE `state` = 0");
$ret = $dsql->dsqlOper($sql, "results");
if($ret){
  foreach ($ret as $key => $value) {
    $installModuleArr[] = $value['name'];
  }
}
$huoniaoTag->assign('installModuleArr', $installModuleArr);


//保证session中的防跨站标记与提交过来的标记一致
if($_POST['token'] != "" && $_POST['token'] != $_SESSION['token']){
	die('Error!<br />Code:Token');
}

//自动加载类库处理
function __autoload($classname){
	global $handler;
	global $autoload;
	if(!$autoload){
	    $classname = preg_replace("/[^0-9a-z_]/i", '', $classname);
	    if(class_exists($classname)){
	        return TRUE;
	    }
	    $classfile = ($handler ? HUONIAOROOT.'/api/handlers/' : HUONIAOINC.'/class/') . $classname. '.class.php';

		if (is_file($classfile)){
			include_once($classfile);
		}else{
			if (HUONIAOBUG === TRUE){
				echo '<pre>';
				echo $classname.'类找不到';
				echo '</pre>';
				exit();
			}else{
				header ("location:/404.html");
				die();
			}
		}
	}
}
