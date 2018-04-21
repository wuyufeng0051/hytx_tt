<?php
/**
 * 网站附件访问中转
 *
 * @version        $Id: attachment.php 2014-4-24 下午14:46:18 $
 * @package        HuoNiao.Include
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

//系统核心配置文件
require_once(dirname(__FILE__).'/common.inc.php');
$dsql = new dsql($dbo);

//本地图片
class imgdata{
	public $imgsrc;
	public $imgdata;
	public $imgform;
	public function getdir($source){
			$this->imgsrc  = $source;
	}
	public function img2data(){
		$this->_imgfrom($this->imgsrc);
		return $this->imgdata=fread(fopen($this->imgsrc,'rb'),filesize($this->imgsrc));
	}
	public function data2img(){
		header("content-type:$this->imgform");
		echo $this->imgdata;
	}
	public function _imgfrom($imgsrc){
		$info = getimagesize($imgsrc);
		return $this->imgform = $info['mime'];
	}
}

//远程图片
function GrabImage($url) {
	if ($url == "") return false;

	//通过CURL方式读取远程图片内容
	$curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 5);
  $img = curl_exec($curl);
  curl_close($curl);

	header("content-type:image/jpeg");

	//如果下载失败则显示一张本地error图片
	if(empty($img)){
		$n = new imgdata;
		$n -> getdir(HUONIAOROOT."/static/images/404.jpg");
		$n -> img2data();
		$n -> data2img();
	}else{
		return $img;
	}
}

if(!empty($f)){

	if(strstr($f, "http")){
		header("location:".$f);
		die;
	}

	global $cfg_hideUrl;

	if(strstr($f, ".jpg") || strstr($f, ".jpeg") || strstr($f, ".gif") || strstr($f, ".png") || strstr($f, ".bmp")){
		global $cfg_uploadDir;
		$filepath = "..".$cfg_uploadDir.$f;

		$n = new imgdata;
		$n -> getdir($filepath);
		$n -> img2data();
		$n -> data2img();
		die;
	}

	$RenrenCrypt = new RenrenCrypt();
	$id = $RenrenCrypt->php_decrypt(base64_decode($f));

	if(!is_numeric($id)) {
		global $cfg_uploadDir;
		$filepath = "..".$cfg_uploadDir.$f;

		$n = new imgdata;
		$n -> getdir($filepath);
		$n -> img2data();
		$n -> data2img();
		die;
	}

	$attachment = $dsql->SetQuery("SELECT * FROM `#@__attachment` WHERE `id` = ".$id);
	$results = $dsql->dsqlOper($attachment, "results");
	if(!is_array($results)) die("Error!");

	if($results){
		$userid   = $results[0]["userid"];
		$filename = $results[0]["filename"];
		$filesize = $results[0]["filesize"];
		$path     = $results[0]["path"];
		$pubdate  = $results[0]["pubdate"];

		$filetype = explode(".", $path);
		$fileinfo = explode("/", $path);

		$module   = $fileinfo[1];
		$fileclas = $fileinfo[2];

		//大、中、小图
		if($type != ""){
			$pathNew = str_replace($fileinfo[3], $type, $path);
		}else{
			$pathNew = $path;
		}


		//如果是不隐藏图片地址
		if($cfg_hideUrl == 0){
			$fileTrueUrl = getRealFilePath($f);
			$fileUrl = explode($path, $fileTrueUrl);
			$fileUrl_ = $fileUrl[0].$pathNew;
			//判断文件是否存在，如果不存在直接访问原文件
			if(file_exists($fileUrl_)){
				header("location:".$fileUrl_);
			}else{
				header("location:".$fileUrl[0].$path);
			}
			die;
		}


		global $cfg_fileUrl;
		global $cfg_uploadDir;
		global $cfg_ftpType;
		global $cfg_OSSUrl;
		global $cfg_ftpState;
		global $cfg_ftpDir;

		if($module != "siteConfig"){
			require_once(HUONIAOINC."/config/".$module.".inc.php");
			global $customUpload;
			global $custom_uploadDir;
			global $customFtp;
			global $customFtpType;
			global $custom_ftpState;
			global $custom_ftpDir;
			global $custom_ftpUrl;
			global $custom_OSSUrl;

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
						$site_fileUrl = "..".$custom_uploadDir;
					}else{
						$site_fileUrl = "..".$cfg_uploadDir;
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
					$site_fileUrl = $cfg_fileUrl;
				//本地
				}else{
					$site_fileUrl = "..".$cfg_uploadDir;
				}
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
			}elseif($cfg_ftpType == 0 && $cfg_ftpState == 1){
				$site_fileUrl = $cfg_fileUrl;
			//本地
			}else{
				$site_fileUrl = "..".$cfg_uploadDir;
			}
		}

		$filepath = $site_fileUrl.$pathNew;

		//判断文件是否存在，待后续完善
		// if(!file_exists($filepath)){
		// 	$filepath = $site_fileUrl.$path;
		// }

		//验证是否为图片/flash/音频文件，如果是则直接输出，否则提示下载
		global $cfg_audioType;
		$imageArr = array("jpg", "jpeg", "gif", "png", "bmp");
		if(in_array(strtolower($filetype[1]), $imageArr) || strtolower($filetype[1]) == "swf" || in_array(strtolower($filetype[1]), explode("|", $cfg_audioType))){
			//if(@fopen($filepath, 'r')) {

				//远程
				if(stripos($site_fileUrl, "http") !== false){
					echo GrabImage($filepath);

				//本地
				}else{
					if(!file_exists($filepath)){
						$filepath = $site_fileUrl.$path;
					}

					$n = new imgdata;
					$n -> getdir($filepath);
					$n -> img2data();
					$n -> data2img();
				}
			// }else{
			// 	$filepath = $site_fileUrl.$path;
			// 	if(@fopen($filepath, 'r')) {
			// 		if(stripos($site_fileUrl, "http") !== false){
			// 			echo GrabImage($filepath);
			// 		}else{
			// 			$n = new imgdata;
			// 			$n -> getdir($filepath);
			// 			$n -> img2data();
			// 			$n -> data2img();
			// 		}
			// 	}else{
			// 		echo "文件不存在2！";
			// 		exit;
			// 	}
			// }
		}else{
			//if(@fopen($filepath, 'r')) {
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment; filename=".basename($filename));
				readfile($filepath);
				exit;
			//}else{
			//	echo "文件不存在！";
			//	exit;
			//}
		}

	}else{
		echo "文件不存在！";
		exit;
	}
}
?>
