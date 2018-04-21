<?php
//系统核心配置文件
require_once(dirname(__FILE__).'/include/common.inc.php');

$service = !empty($service) ? $service : (!empty($cfg_defaultindex) ? $cfg_defaultindex : "siteConfig");
$template = !empty($template) ? $template : "index";

$config_path = HUONIAOINC."/config/";
$templates   = $template.".html";

//域名检测 s
$httpHost  = $_SERVER['HTTP_HOST'];

//兼容win
$reqUri = $_SERVER["HTTP_X_REWRITE_URL"];
if($reqUri == null){
	$reqUri = $_SERVER["HTTP_X_ORIGINAL_URL"];
	if($reqUri == null){
		$reqUri = $_SERVER["REQUEST_URI"];
	}
}
//$reqUri    = $_SERVER['REQUEST_URI'];

$dirDomain = "http://".$httpHost . $reqUri;
$todayDate = GetMkTime(time());
$cfg_basehost_ = str_replace("www.", "", $cfg_basehost);
if($cfg_basehost_ != str_replace("www.", "", $httpHost) && empty($_GET['service'])){

	//全域名匹配数据库是否存在
	$sql = $dsql->SetQuery("SELECT * FROM `#@__domain` WHERE `domain` = '$httpHost'");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){

		$module  = $results[0]['module'];
		$expires = $results[0]['expires'];
		$note    = $results[0]['note'];

		//判断是否过期
		if($todayDate < $expires || empty($end)){
			$service = $module;

		}else{
			die($note);
		}

	//只检测二级域名
	}else{
		$httpHostSub = str_replace(".".$cfg_basehost_, "", $httpHost);
		$sql = $dsql->SetQuery("SELECT * FROM `#@__domain` WHERE `domain` = '$httpHostSub'");
		$results = $dsql->dsqlOper($sql, "results");
		if($results){

			$module  = $results[0]['module'];
			$expires = $results[0]['expires'];
			$note    = $results[0]['note'];

			//判断是否过期
			if($todayDate < $expires || empty($end)){
				$service = $module;

			}else{
				die($note);
			}

		//域名不存在
		}else{

			if(!empty($reqUri)){
				$reqUriArr = explode("/", $reqUri);
				if(!empty($reqUriArr)){
					$subDomain = $reqUriArr[1];

					$sql = $dsql->SetQuery("SELECT * FROM `#@__domain` WHERE `domain` = '$subDomain'");
					$results = $dsql->dsqlOper($sql, "results");
					if($results){

						$module  = $results[0]['module'];
						$expires = $results[0]['expires'];
						$note    = $results[0]['note'];

						//判断是否过期
						if($todayDate < $expires || empty($end)){
							$service = $module;

						}else{
							die($note);
						}
					}else{
						// 如果执行到此处，说明域名已解析至服务器并且在服务器上绑定过，但是网站主域名与之不符，所以不能正常浏览，这也是考虑到如果服务器进行了泛解析，会导致任何域名解析到服务器IP上都可以浏览网站（前提是后台基本设置中Cookie作用域留空），如果不考虑这一点，请将下面一行注释掉即可！
						// die("域名不存在，请确认后重试1！");
					}
				}else{
					die("域名不存在，请确认后重试2！");
				}
			}else{
				die("域名不存在，请确认后重试3！");
			}

		}

	}

}
//域名检测 e


//验证模块状态
if($service != "siteConfig" && $service != "member" && $service != "business"){
	$sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_module` WHERE `name` = '$service' AND `state` = 0");
	$ret = $dsql->dsqlOper($sql, "totalCount");
	if($ret == 0){
		header("location:http://".$cfg_basehost);
		die;
	}
}


//引入当前模块配置文件
if($service != "siteConfig" && $service != "member"){
	$serviceInc = $config_path.$service.".inc.php";
	if(file_exists($serviceInc)){
		require_once($serviceInc);
	}else{
		die("服务名不存在！");
	}
}

//声明以下均为接口类
$handler = true;

//获取当前模块配置参数
$configHandels = new handlers($service, "config");
$moduleConfig  = $configHandels->getHandle();

if(!is_array($moduleConfig) && $moduleConfig['state'] != 100) die('模块数据获取失败！');
$moduleConfig  = $moduleConfig['info'];


//如果系统配置了子频道为大首页、当访问大首页时自动跳转至子频道域名，前提是子频道设置的为二级域名，如果不做跳转，同步登录和登录浮动窗口为报错误
$moduleDomain = $moduleConfig['channelDomain'];
if($moduleConfig['subDomain'] == 1 && !empty($cfg_defaultindex) && $cfg_defaultindex != "siteConfig" && $cfg_defaultindex == $service && $httpHost != str_replace("http://", "", $moduleDomain)){
	header("location:".$moduleDomain);
	die;
}



//输入当前模块配置参数
$configName = array_keys($moduleConfig);
foreach ($configName as $config) {
	$huoniaoTag->assign($service.'_'.$config, $moduleConfig[$config]);
}

//注册当前模块函数
$contorllerFile = dirname(__FILE__).'/api/handlers/'.$service.'.controller.php';
if(file_exists($contorllerFile)){
	require_once($contorllerFile);
	$huoniaoTag->registerPlugin("block", $service, $service);
}


//普通频道
if($service != "member"){

	//检查模块状态
	checkModuleState($moduleConfig);

	//设置模板目录
	$tplFloder = $moduleConfig['template'];
	$touchTplFloder = $moduleConfig['touchTemplate'];
	if(!empty($skin)) $tplFloder = $skin;

	$touchTplFloder = empty($touchTplFloder) ? "default" : $touchTplFloder;

	$ser = $service;
	$tplFloder = $tplFloder . "/";
	$touchTplFloder = $touchTplFloder . "/";

	//单页、帮助、协议
	if($template == "about" || $template == "help" || $template == "help-detail" || $template == "protocol" || $template == "app"){
		$ser = $template == "help-detail" ? "help" : $template;
		$tplFloder = "";
		$touchTplFloder = "";
	}

	//自助建站没有移动版
	if($service == "website" || $service == "waimai"){
		$tpl = "/templates/" . $ser . "/" . $tplFloder;
	}else{
		$tpl = "/templates/" . $ser . "/" . ((isMobile() && (!empty($touchTplFloder) || $template == "about" || $template == "help" || $template == "help-detail")) ? "touch/".$touchTplFloder : $tplFloder);
	}

	//APP Page Config
	$tpl = $template == "app" ? $tpl . $type . "/" : $tpl;
	$templates = $template == "app" ? $page.".html" : $templates;


//会员频道
}else{

	$param = array("service" => "member",	"type" => "user");
	$userDomain = getUrlPath($param);
	$param = array("service"  => "member");
	$busiDomain = getUrlPath($param);

	//判断访问类型
	$ischeck = explode($busiDomain, $dirDomain);

	//如果是访问的企业会员域名，并且不是手机版的情况下，模板选择企业会员的模板
	if(count($ischeck) > 1 && !isMobile()){
		$tpl = "/templates/member/company/";
	}else{
		$tpl = "/templates/member/";
	}

	$tpl .= isMobile() ? "touch/" : "";

}



//遍历所有模块配置文件
//此处是为了让整站在任何模板中通过{#$service_configItem#}的方式直接调取指定频道的基本信息；
//如获取团购频道的名称和域名：{#$tuan_channelName#}，{#$tuan_channelDomain#}
//当前默认只输出：模块名、模块链接，两个参数，如果要输出更多信息，请修改：$sNameParam变量的内容，清空或增加
$config_dir = opendir($config_path);
while(($file = readdir($config_dir)) !== false){
	$sName = str_replace(".inc.php", "", $file);
	$sub_dir = $config_path . $file;
  if($file == '.' || $file == '..' || $sName == "pointsConfig" || $sName == "wechatConfig" || $sName == $service){
      continue;
	}else if(file_exists($sub_dir)){

		//引入配置文件
		// $sNameInc = $config_path.$sName.".inc.php";
		// if(file_exists($sNameInc)){
		// 	require($sNameInc);
		// }

		//获取功能模块配置参数
		$sNameParam = $sName == "siteConfig" || $sName == "member" ? "" : "channelName,channelDomain";
		$sNameHandels = new handlers($sName, "config");
		$sNameConfig  = $sNameHandels->getHandle($sNameParam);

		if(is_array($sNameConfig) && $sNameConfig['state'] == 100){
			$sNameConfig  = $sNameConfig['info'];

			//输出配置信息
			$sConfigName = array_keys($sNameConfig);
			foreach ($sConfigName as $config) {
				$huoniaoTag->assign($sName.'_'.$config, $sNameConfig[$config]);
			}

			//注册函数
			$contorllerFile = dirname(__FILE__).'/api/handlers/'.$sName.'.controller.php';
			if(file_exists($contorllerFile)){
				require_once($contorllerFile);
				$huoniaoTag->registerPlugin("block", $sName, $sName);
			}
	 	}

    }
}



//团购单独设置
if($service == "tuan"){

	//当前城市域名
	$city = str_replace("/", "", $city);
	require($serviceInc);
	$tuanService = new tuan();
	$domainInfo = $tuanService->getCity();
	if(!empty($domainInfo)){

		$tuanDomain = $domainInfo['url'];
		$huoniaoTag->assign('city', $city);   //城市拼音
		$huoniaoTag->assign('cityid', $domainInfo['cid']);  //城市ID
		$huoniaoTag->assign('cityname', $domainInfo['typename']);  //城市名称
		$huoniaoTag->assign('tuanDomain', $tuanDomain);  //城市域名

		PutCookie("tuan_city", $city, 86400 * 365);

		//自动跳转到城市首页
		if(!empty($city) && ($template == "" || $template == "changecity") && $do != "initiative"){
			header("location:".$tuanDomain);die;
		}

	//城市为空时直接访问选择城市页
	}else{
		$templates = "changecity.html";
	}

}


//执行当前页面指定的函数：$template
$params = $_REQUEST;
$params['action'] = $template;
$service($params);


//会员状态
if($userLogin->getMemberID() > -1 && $template != "logout"){

	if($template == "resetpwd"){
		header("location://".$cfg_basehost);
		die;
	}

	$userLogin->keepUserID = $userLogin->keepMemberID;
	$userLogin->keepUser();
	$userinfo = $userLogin->getMemberInfo();
	$huoniaoTag->assign('userinfo', $userinfo);
}


//验证码规则
global $cfg_seccodestatus;
$seccodestatus = explode(",", $cfg_seccodestatus);
$loginCode = "";
if(in_array("login", $seccodestatus)){
	$loginCode = 1;
}
$huoniaoTag->assign('loginCode', $loginCode);


//微信JSSDK
if($cfg_wechatAppid && $cfg_wechatAppsecret){
	$handler = false;
	$jssdk = new WechatJSSDK($cfg_wechatAppid, $cfg_wechatAppsecret);
	$signPackage = $jssdk->GetSignPackage();
	$huoniaoTag->assign('wxjssdk_appId', $signPackage['appId']);
	$huoniaoTag->assign('wxjssdk_timestamp', $signPackage['timestamp']);
	$huoniaoTag->assign('wxjssdk_nonceStr', $signPackage['nonceStr']);
	$huoniaoTag->assign('wxjssdk_signature', $signPackage['signature']);
}


//外卖配送
if($service == "waimai" && $do == "courier"){
	$tpl = "/templates/courier/";
}


//验证模板文件
$tplDir = HUONIAOROOT.$tpl;
if(file_exists($tplDir.$templates)){

	$huoniaoTag->template_dir = $tplDir;
	$huoniaoTag->assign('templets_skin', 'http://'.$cfg_basehost.$tpl);  //模块路径
	$huoniaoTag->assign('page', empty($page) ? 1 : $page);   //当前页码
	$huoniaoTag->assign('cfg_staticPath', $cfg_staticPath);  //静态资源路径
	$huoniaoTag->assign('cfg_hideUrl', $cfg_hideUrl);        //是否隐藏静态资源路径
	$huoniaoTag->assign('template', $template);    //当前模板
	$huoniaoTag->assign('service', $service);      //当前模块
	$huoniaoTag->assign('search_keyword', $search_keyword);  //搜索关键字
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/compiled/".$service."/".(isMobile() ? "touch/" : "").$template;  //设置编译目录
	$huoniaoTag->display($templates);

	echo "<!-- Processed in ".number_format((microtime(true) - sysBtime), 6)." second(s), ".$dsql->querynum." queries -->";

	// echo $dsql->querysql;  //输出页面中用到的SQL
}else{
	die("The requested URL '".$templates."' was not found on this server.");
	die('模板文件不存在！');
}
