<?php
//系统核心配置文件
require_once(dirname(__FILE__).'/common.inc.php');

//手机号码图片化
if($action == "phoneimage"){

	if(!empty($num)){

		//转码
		$RenrenCrypt = new RenrenCrypt();
		$num = $RenrenCrypt->php_decrypt(base64_decode($num));

		//生成图像
		Header("Content-type: image/PNG");
		$str2PNG = new str2PNG($num, $size);
		$str2PNG->createImage();
	}
	die;

//输出广告代码
}elseif($action == "adjs"){

	if(!empty($id) || !empty($title)){

		$handler = true;
		include_once(HUONIAOINC."/class/myad.class.php");

		if(!empty($id)){
			$param = array("id" => $id);
		}
		if(!empty($title)){
			$param = array("title" => $title);
			$param['model'] = $model;
		}
		if(!empty($type)){
			$param["type"] = $type;
		}

		$adhtml = getMyAd($param);

		$adhtml = str_replace("\n", "", $adhtml);
		$adhtml = str_replace("\r", "", $adhtml);
		$adhtml = str_replace("\r\n", "", $adhtml);

		$adhtml = addslashes($adhtml);
		echo 'document.write("'.$adhtml.'");';die;

	}

//网址快捷方式
}elseif($action == "internetShortcut"){

	$url = "http://".$cfg_basehost;
	$name = iconv("UTF-8", "GBK", $cfg_webname);

	Header("Content-type:application/octet-stream ");
	Header("Accept-Ranges:bytes ");
	header("Content-Disposition:attachment;filename=$name.url");
	echo "[DEFAULT]\r\n";
	echo "BASEURL=$url\r\n";
	echo "[$name]\r\n";
	echo "Prop3=19,11\r\n";
	echo "[InternetShortcut]\r\n";
	echo "URL=$url\r\n";
	echo "IconFile=$url/favicon.ico";
}
