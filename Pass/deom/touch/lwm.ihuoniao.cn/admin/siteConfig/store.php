<?php
/**
 * 安装新模块
 *
 * @version        $Id: moduleInstall.php 2013-12-24 下午16:52:33 $
 * @package        HuoNiao.Config
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("installMoudule");
require_once(HUONIAODATA."/admin/config_official.php");
$dsql = new dsql($dbo);

@set_time_limit(0);  // 修改为不限制超时时间(默认为30秒)
$data = $_GET['data'];

//跳转到一下页的JS
$gotojs = "\r\nfunction GotoNextPage(){
    document.gonext."."submit();
}"."\r\nset"."Timeout('GotoNextPage()',500);";

$dojs = "<script language='javascript'>$gotojs\r\n</script>";

//转至官方
if(empty($auth) && empty($id)){
  $tpl = dirname(__FILE__)."/../templates/siteConfig";
  $templates = "store.html";

	global $cfg_basehost;
  $version = getSoftVersion();


  //获取系统所有已经安装的模板
  $moduleArr = array();
  $sql = $dsql->SetQuery("SELECT `name` FROM `#@__site_module`");
  $result = $dsql->dsqlOper($sql, "results");
  if($result){
      foreach ($result as $key => $value) {
          if(!empty($value['name'])){
              array_push($moduleArr, $value['name']);
          }
      }
  }

  //当前域名||程序安装文件||当前版本||当前已经安装的模块
	$returnUrl = $cfg_basehost."||".$_SERVER['PHP_SELF']."||".$version."||".serialize($moduleArr);
	$redirectUrl = $storeHost.'/?data='.base64_encode($returnUrl).'&v='.time();

  if(file_exists($tpl."/".$templates)){
    $huoniaoTag->assign('redirectUrl', $redirectUrl);

    $huoniaoTag->template_dir = $tpl;
    $huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/siteConfig";  //设置编译目录
  	$huoniaoTag->display($templates);
  }

//从官方跳转进行安装
}else{

  $startpos = (int)$_POST['startpos'];
  $hasnew   = $_POST['hasnew'];
  $newVersion = $_POST['newVersion'];
  $updateTime = $_POST['updateTime'];
  $savepath = $_POST['savepath'];
  $name     = $_POST['name'];
  $module   = $_POST['module'];
  $mobile   = $_POST['mobile'];
  $ids      = explode(",", $_GET['id']);
  $name     = empty($name) ? $ids[0] : $name;
  if(empty($name)){
    ShowMsg('没有要安装的模块，请确认后重试！', 'store.php', 0, 10000);
    exit();
  }

	$pos = 0;


	/* 步骤一 下载文件 */
	if($startpos == 0){

    $url = $cloudHost.'/include/ajax.php?action=installModule&do='.$action.'&auth='.$auth.'&name='.$name;
    if($name == "system"){
      $softVersion = getSoftVersion();
    	$siteVersion  = explode("\n", $softVersion);  // 0：版本号  1：升级时间
      $url = $cloudHost.'/include/ajax.php?action=installModule&do='.$action.'&auth='.$auth.'&name='.$name.'&update='.(int)$siteVersion[1];
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);
    $con = curl_exec($curl);
    curl_close($curl);

    if($con){
      $data = json_decode($con, true);
    }else{
      ShowMsg('请求超时，请重试', 'store.php', 0, 10000);
      exit();
    }

    if(!is_array($data)){
      ShowMsg('安装包下载失败，请重试', 'store.php', 0, 10000);
      exit();
    }

    if($data['state'] == 200){
      ShowMsg($data['info'], 'store.php', 0, 10000);
      exit();
    }

    //请求成功
    if($data['state'] == 100){

      $dir = HUONIAODATA."/module/";

      //以下两个参数在升级模板或安装模板功能需要用到
      $module = $data['module'];  //所属模块
      $mobile = $data['mobile'];    //是否为手机版

      //创建下载文件夹
      if(!is_dir($dir)){
        createDir(HUONIAODATA."/module/");
      }

      if(!is_dir($dir)){
        ShowMsg('文件夹创建失败，请检查服务器权限，或手动创建'.HUONIAODATA.'/module/文件夹！', 'store.php', 0, 10000);
        exit();
      }

  		/* 下载文件 */
  		$file = new httpdown();
  		$file->OpenUrl($data['info']); # 远程文件地址
  		$file->SaveToBin($dir.$name.".zip"); # 保存路径及文件名
  		$file->Close(); # 释放资源

  		$tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 20%;'>20%</div></div>\r\n";
  		$pos = 1;

      //升级
      if($action == "update" || $action == "updateTemplate"){
        $hasnew = $data['hasnew'];
        $newVersion = $data['version'];
        $updateTime = $data['update'];
        $tmsg .= "<font color='green'>正在下载 ".$data['title']." ".$newVersion." 升级包，请稍候...</font>\r\n";

      //系统升级
      }elseif($name == "system"){
        $hasnew = $data['hasnew'];
        $newVersion = $data['version'];
        $updateTime = $data['update'];
        $tmsg .= "<font color='green'>正在下载 ".$data['title']." ".$newVersion."，请稍候...</font>\r\n";

      //正常安装
      }else{
        $tmsg .= "<font color='green'>正在下载 ".$data['title']." 安装包，请稍候...</font>\r\n";
      }


    //其他情况：升级时发现已经安装了最新版本，无需更新，直接跳转到最后一步
    }elseif($data['state'] == 201){
      if($name == "system"){
        ShowMsg($data['info'], 'store.php', 0, 10000);
        exit();
      }else{
        $tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 0%;'>0%</div></div>\r\n";
		$tmsg .= "<font color='green'>".$data['info']."</font>\r\n";
		$pos = 4;
      }

    }

	/* 步骤二 解压文件 */
	}elseif($startpos == 1){

		$zipfile   = HUONIAODATA."/module/".$name.".zip";
		$savepath  = HUONIAODATA."/module/".$name;

        if(!file_exists($zipfile)) {
          ShowMsg('下载失败，请重新安装！', 'store.php', 0, 10000);
          clearstatcache();
    			exit();
        }

        $zip = new ZipArchive;
        if($zip->open($zipfile) === TRUE){
          $zip->extractTo($savepath);
          $zip->close();
        }else{
          ShowMsg('解压失败，请检查服务器配置！', 'store.php', 0, 10000);
          exit();
        }

		@unlink($zipfile); //删除压缩包

		$tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 40%;'>40%</div></div>\r\n";
		$tmsg .= "<font color='green'>正在解压安装包，请稍候...</font>\r\n";
		$pos = 2;

	/* 步骤三 移动文件 */
	}elseif($startpos == 2){

        //遍历文件夹，获取文件和文件夹列表
		$fileList = traverseFloder($savepath);
		$fileList = singelArray($fileList);


        //安装模板、更新模板
        if($action == "updateTemplate" || $action == "installTemplate"){

            if($mobile){
                $tempDir = HUONIAOROOT."/templates/".$module."/touch/".$name."/";
            }else{
                $tempDir = HUONIAOROOT."/templates/".$module."/".$name."/";
            }

            //创建下载文件夹
            if(!is_dir($tempDir)){
              createDir($tempDir);
            }

            if(!is_dir($tempDir)){
              ShowMsg('文件夹创建失败，请检查服务器权限，或手动创建'.$tempDir.'文件夹！', 'store.php', 0, 10000);
              exit();
            }

            //移动模板至相应目录
    		$current_dir = opendir($savepath);
    		while(($file = readdir($current_dir)) !== false) {
    			$sub_dir = $savepath."/".$file;
    			if($file == '.' || $file == '..') {
    				continue;
    			}else{
                    if(!is_dir($sub_dir)){
                        moveFile($sub_dir, $tempDir.$file, true);
                    }else{
                        moveDir($sub_dir, $tempDir.$file, true);
                    }
                }
    		}

            $tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 80%;'>80%</div></div>\r\n";
    		$tmsg .= "<font color='green'>正在移动模板文件至相应位置，请稍候...</font>\r\n";
    		$pos = 4;

        }else{

    		$files = "";
    		foreach($fileList as $file){
    			$file = iconv("UTF-8", "gb2312", $file);
    			$file = str_replace($savepath.'/config.xml', '', $file);
    			$file = str_replace($savepath."/front", '../..', str_replace($savepath."/admin", '..', $file));
    			if($file != "../../" && $file != "../" && $file != ""){
    				if($file{strlen($file)-1} == "/"){
    					$f = explode("/", $file);
    					if($name == $f[count($f) - 2]){
    						$files .= $file."\r\n";
    					}
    				}else{
    					$files .= $file."\r\n";
    				}
    			}
    		}

    		//移动后台文件夹至相应目录
    		$current_dir = opendir($savepath."/admin");
    		while(($file = readdir($current_dir)) !== false) {
    			$sub_dir = $savepath."/admin" . "/" . $file;
    			if($file == '.' || $file == '..') {
    				continue;
    			}else{
                    if(!is_dir($sub_dir)){
                        moveFile($sub_dir, HUONIAOADMIN."/".$file, true);
                    }else{
                        moveDir($sub_dir, HUONIAOADMIN."/".$file, true);
                    }
                }
    		}


            if($name != "system"){
                //判断是否已经安装过，如果已经安装过，需要保留原有模块配置文件
                //首先将原有文件重命名，移动完成后再将新的配置文件删除，最后再将原有配置文件还原
                $has = 0;
                $sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_module` WHERE `name` = '$name'");
                $ret = $dsql->dsqlOper($sql, "totalCount");
                if($ret > 0){
                    $has = 1;
                    @rename(HUONIAOINC."/config/".$name.".inc.php", HUONIAOINC."/config/".$name.".inc.bak.php");
                }
            }


    		//移动前台文件夹至相应目录
    		$current_dir = opendir($savepath."/front");
    		while(($file = readdir($current_dir)) !== false) {
                $sub_dir = $savepath."/front" . "/" . $file;
                if($file == '.' || $file == '..') {
                    continue;
                }else{
                    if(!is_dir($sub_dir)){
                        moveFile($sub_dir, "../".HUONIAOADMIN."/".$file, true);
                    }else{
                        moveDir($sub_dir, "../".HUONIAOADMIN."/".$file, true);
                    }
                }
    		}


            if($name != "system"){
                //如果是重装或升级，先删除最新的配置文件，再将备份好的还原
                if($has){
                    @rename(HUONIAOINC."/config/".$name.".inc.bak.php", HUONIAOINC."/config/".$name.".inc.php");
                }
            }

    		$tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 60%;'>60%</div></div>\r\n";
    		$tmsg .= "<font color='green'>正在移动程序文件至相应位置，请稍候...</font>\r\n";
    		$pos = 3;
        }

	/* 步骤四 数据库配置 */
	}elseif($startpos == 3){

		//读取模块配置文件
		if (file_exists($savepath.'/config.xml')){
            libxml_disable_entity_loader(false);
			$xml = simplexml_load_file($savepath.'/config.xml');

            if(!$xml){
                ShowMsg('模块配置文件读取失败，请检查服务器配置！', 'store.php', 0, 10000);
                exit();
            }

      //系统升级
      if($name == "system"){

        //配置信息
        $baseinfo = $xml->baseinfo;
        $title    = $baseinfo->title;   //模块名称
        $name     = $baseinfo->name;    //模块标识
        $version  = $baseinfo->version; //模块版本
        $setupsql = str_replace("&#39;", "'", base64_decode($xml->setupsql));  //数据库操作

        //操作执行数据库配置
        $querys = preg_split("#;[ \t]{0,}\n#",$setupsql);
        // $querys = explode(';', $setupsql);
        foreach($querys as $q){
            $q = trim($q);
    		if($q==""){
    			continue;
    		}
            $archives = $dsql->SetQuery($q);
            $dsql->dsqlOper($archives, "update");
        }

      }else{

        //查询模块一级分类
  			$moduleSql = $dsql->SetQuery("SELECT `id` FROM `#@__site_module` WHERE `parentid` = 0 ORDER BY `weight`");
  			$moduleResult = $dsql->dsqlOper($moduleSql, "results");
  			if($moduleResult){
          $parentid = $moduleResult[0]['id'];

        //如果没有一级就创建一级
        }else{
          $sql = $dsql->SetQuery("INSERT INTO `#@__site_module` (`parentid`, `title`) VALUES ('0', '系统默认模块')");
          $parentid = $dsql->dsqlOper($sql, "lastid");
        }

        //根据模块标识查询是否已经安装过
        $sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_module` WHERE `name` = '$name'");
        $ret = $dsql->dsqlOper($sql, "totalCount");

        //更新升级
        if($ret > 0 && $action == "update"){

          //配置信息
          $baseinfo = $xml->baseinfo;
    			$title    = $baseinfo->title;   //模块名称
    			$name     = $baseinfo->name;    //模块标识
    			$version  = $baseinfo->version; //模块版本
          $setupsql = str_replace("&#39;", "'", base64_decode($xml->setupsql));  //数据库操作

          $moduleSql = $dsql->SetQuery("UPDATE `#@__site_module` SET `version` = '$version', `date` = ".GetMkTime(time())." WHERE `name` = '$name'");
          $moduleResult = $dsql->dsqlOper($moduleSql, "update");

          //操作执行数据库配置
                $querys = preg_split("#;[ \t]{0,}\n#",$setupsql);
    			// $querys = explode(';', $setupsql);
    			foreach($querys as $q){
                    $q = trim($q);
            		if($q==""){
            			continue;
            		}
    				$archives = $dsql->SetQuery($q);
    				$dsql->dsqlOper($archives, "update");
    			}

        //新安装
        }else{

          //配置信息
          $baseinfo = $xml->baseinfo;
    			$title    = $baseinfo->title;   //模块名称
    			$name     = $baseinfo->name;    //模块标识
    			$version  = $baseinfo->version; //模块版本
    			$note     = $baseinfo->note;    //模块描述

    			$subnav   = RpLine(addslashes(base64_decode($xml->subnav)));           //后台导航菜单
          $setupsql = str_replace("&#39;", "'", base64_decode($xml->setupsql));  //数据表及默认数据
          $delsql   = str_replace("&#39;", "'", base64_decode($xml->delsql));    //删除数据表sql
          $domainRules  = base64_decode($xml->domainRules);    //子域名规则
          $catalogRules = base64_decode($xml->catalogRules);   //子目录规则

          //文件路径、主要用在卸载模块时一并删除相关的文件
          $files = $_POST['files'];

          //删除模块数据
          $sql = $dsql->SetQuery("DELETE FROM `#@__site_module` WHERE `name` = '$name'");
          $dsql->dsqlOper($sql, "update");

          //先删除数据表
                $uninstallSql = preg_split("#;[ \t]{0,}\n#",$delsql);
    			// $uninstallSql = explode(";",$delsql);
    			foreach($uninstallSql as $v){
                    $v = trim($v);
            		if($v==""){
            			continue;
            		}
    				$archives = $dsql->SetQuery($v);
    				$dsql->dsqlOper($archives, "update");
    			}

    			//建立表结构
                $querys = preg_split("#;[ \t]{0,}\n#",$setupsql);
    			// $querys = explode(';', $setupsql);
    			foreach($querys as $q){
                    $q = trim($q);
            		if($q==""){
            			continue;
            		}
    				$archives = $dsql->SetQuery($q);
    				$dsql->dsqlOper($archives, "update");
    			}

          $icon         = $name.'.png';
          $files        = RpLine($files);
          $domainRules  = RpLine(addslashes($domainRules));
          $catalogRules = RpLine(addslashes($catalogRules));
          $delsql       = RpLine(addslashes($delsql));
          $time         = GetMkTime(time());

          //新增模块数据
  				$moduleSql = $dsql->SetQuery("INSERT INTO `#@__site_module` (`parentid`, `title`, `name`, `icon`, `note`, `state`, `weight`, `subnav`, `filelist`, `domainRules`, `catalogRules`, `delsql`, `version`, `date`) VALUES ('$parentid', '$title', '$name', '$icon', '$note', 0, 50, '$subnav', '$files', '$domainRules', '$catalogRules', '$delsql', '$version', '$time')");
  				$moduleResult = $dsql->dsqlOper($moduleSql, "update");
        }

      }

		}

		$tmsg  = "<div class='progress progress-striped active' style='width:400px; margin:10px auto;'><div class='bar' style='width: 80%;'>80%</div></div>\r\n";
		$tmsg .= "<font color='green'>正在配置数据库，请稍候...</font>\r\n";
		$pos = 4;

	/* 步骤五 清除安装文件 */
	}elseif($startpos == 4){

		deldir($savepath);

    //系统升级只需要修改版本文件/data/admin/version.txt即可
    if($name == "system" && $newVersion && $updateTime){
      $m_file = HUONIAODATA."/admin/version.txt";
      $val = $newVersion."\r\n".$updateTime;
  		$fp = fopen($m_file, "w") or ShowMsg('写入文件 $m_file 失败，请检查权限！', 'store.php', 0, 10000);
  		fwrite($fp, $val);
  		fclose($fp);
    }

    //如果还有新的版本，则不删除正在进行的模块
    if(!$hasnew){
      //删除已经安装的模块
      array_splice($ids, 0, 1);
    }

    if($name == "system"){
        $action = "update";
    }

    //更新官网会员订单状态
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $cloudHost.'/include/ajax.php?action=installModuleSuccess&auth='.$auth.'&name='.$name.'&do='.$action.'&version='.$newVersion.'&update='.$updateTime);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);
    curl_exec($curl);
    curl_close($curl);

    //全部安装完成
    if(empty($ids)){

      if($action == "updateTemplate" || $action == "installTemplate"){
          $tmsg = "<font color='green'>模板安装成功！</font>\r\n";
      }else{
          $tmsg = "<font color='green'>模块安装成功！</font>\r\n";
      }
  		$doneForm = '<script language="javascript">
  			function GotoNextPage(){
  				top.location.href = "../index.php?gotopage=siteConfig/store.php";
  			}
  			setTimeout("GotoNextPage()",1000);
  		</script>';
  		PutInfo($tmsg, $doneForm);
  		exit();

    //继续安装下一个
    }else{
      $id = join(",", $ids);
      $name = "";
      $pos = 0;

      if($hasnew){
        $tmsg = "<font color='green'>发现其他升级包，继续安装，请稍候...</font>\r\n";
      }else{
        $tmsg = "<font color='green'>继续安装下一个模块，请稍候...</font>\r\n";
      }
    }

	}

	$doneForm  = "<form name='gonext' method='post' action='store.php?id=".$id."&auth=".$auth."'>\r\n";
	$doneForm .= "  <input type='hidden' name='name' value='".$name."' />\r\n";
	$doneForm .= "  <input type='hidden' name='hasnew' value='".$hasnew."' />\r\n";
	$doneForm .= "  <input type='hidden' name='newVersion' value='".$newVersion."' />\r\n";
	$doneForm .= "  <input type='hidden' name='updateTime' value='".$updateTime."' />\r\n";
	$doneForm .= "  <input type='hidden' name='action' value='".$action."' />\r\n";
	$doneForm .= "  <input type='hidden' name='savepath' value='".$savepath."' />\r\n";
	$doneForm .= "  <input type='hidden' name='module' value='".$module."' />\r\n";
	$doneForm .= "  <input type='hidden' name='mobile' value='".$mobile."' />\r\n";
	$doneForm .= "  <textarea name='files' style='display:none;'>".$files."</textarea>\r\n";
	$doneForm .= "  <input type='hidden' name='startpos' value='".$pos."' />\r\n</form>\r\n{$dojs}";
	PutInfo($tmsg, $doneForm);
	exit();
}

//遍历文件夹
function traverseFloder($path = '.') {
	$fileList = array();
	$current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
	while(($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
		$sub_dir = $path . "/" . $file;    //构建子目录路径
		if($file == '.' || $file == '..') {
			continue;
		} else if(is_dir($sub_dir)) {
			$fileList[] = $sub_dir."/";
			$fileList[] = traverseFloder($sub_dir);
		} else {
			$fileList[] = $sub_dir;
		}
	}
	return $fileList;
}

//遍历多维数组为一维数组
function singelArray($arr) {
	static $data;
	if (!is_array ($arr) && $arr != NULL) {
		return $data;
	}
	foreach ($arr as $key => $val ) {
		if (is_array ($val)) {
			singelArray ($val);
		} else {
			if($val != NULL){
				$data[]=$val;
			}
		}
	}
	return $data;
}

function PutInfo($msg1,$msg2){
	$htmlhead  = "<html>\r\n<head>\r\n<title>温馨提示</title>\r\n";
	$htmlhead .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$GLOBALS['cfg_soft_lang']."\" />\r\n";
	$htmlhead .= "<link rel='stylesheet' rel='stylesheet' href='".HUONIAOADMIN."/../static/css/admin/bootstrap.css?v=4' />";
	$htmlhead .= "<link rel='stylesheet' rel='stylesheet' href='".HUONIAOADMIN."/../static/css/admin/common.css?v=1111' />";
    $htmlhead .= "<base target='_self'/>\r\n</head>\r\n<body>\r\n";
    $htmlfoot  = "</body>\r\n</html>";
	$rmsg  = "<div class='s-tip'><div class='s-tip-head'><h1>".$GLOBALS['cfg_soft_enname']." 提示：</h1></div>\r\n";
    $rmsg .= "<div class='s-tip-body'>".str_replace("\"","“",$msg1)."\r\n".$msg2."\r\n";
    $msginfo = $htmlhead.$rmsg.$htmlfoot;
    echo $msginfo;
}
