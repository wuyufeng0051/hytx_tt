<?php
/**
 * 管理广告
 *
 * @version        $Id: advList.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.Adv
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/siteConfig";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "advList.html";
$dir = HUONIAOROOT."/templates/".$action;

$tab = "adv";

checkPurview("advList".$action);

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){
		$where .= " AND `title` like '%$sKeyword%'";
	}
	if($sType != ""){
		if(!$type){
			if($dsql->getTypeList($sType, $tab."type")){
				$lower = arr_foreach($dsql->getTypeList($sType, $tab."type"));
				$lower = $sType.",".join(',',$lower);
			}else{
				$lower = $sType;
			}
			$where .= " AND `typeid` in ($lower)";
		}else{
			$where .= " AND `template` = '$sType'";
		}
	}

	if(!empty($sCity)){
		$where .= " AND `cityid` = $sCity";
	}

	$where .= " order by `weight` desc, `id` desc, `pubdate` desc";

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."list` WHERE `model` = '".$action."' AND `type` = ".$type);

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `model`, `class`, `template`, `typeid`, `cityid`, `title`, `weight`, `starttime`, `endtime`, `state` FROM `#@__".$tab."list` WHERE `model` = '".$action."' AND `type` = ".$type.$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			switch($value["class"]){
				case 1:
					$list[$key]["class"] = "普通广告";
					break;
				case 2:
					$list[$key]["class"] = "多图广告";
					break;
				case 3:
					$list[$key]["class"] = "拉伸广告";
					break;
				case 4:
					$list[$key]["class"] = "对联广告";
					break;
			}


			if($type){
				$list[$key]["typeid"] = 0;
				$list[$key]["type"] = "无";

				$floders = listDir($dir);
				$skins = array();
				if(!empty($floders)){

					foreach($floders as $k => $floder){
						$config = $dir.'/'.$floder.'/config.xml';
						if(file_exists($config)){
							//解析xml配置文件
							$xml = new DOMDocument();
							libxml_disable_entity_loader(false);
							$xml->load($config);
							$data = $xml->getElementsByTagName('Data')->item(0);
							$tplname = $data->getElementsByTagName("tplname")->item(0)->nodeValue;

							$floderName = $floder;
							if($value['template'] == $floderName){
								$list[$key]["typeid"] = $floderName;
								$list[$key]["type"] = $tplname;
							}
						}
					}

				}
			}else{
				//分类
				$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__".$tab."type` WHERE `id` = ". $value["typeid"]);
				$typename = $dsql->getTypeName($typeSql);
				$list[$key]["typeid"] = $value["typeid"];
				$list[$key]["type"] = $typename[0]['typename'];
			}

			$cityname = "";
			if($value['model'] == "tuan" && !empty($value['cityid'])){
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__site_area` WHERE `id` = ".$value['cityid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$cityname = $ret[0]['typename']."：";
				}
			}

			$list[$key]["title"] = $cityname.$value["title"];
			$list[$key]["sort"] = $value["weight"];
			$list[$key]["start"] = $value["starttime"] == 0 ? "不限制" : date('Y-m-d', $value["starttime"]);
			$list[$key]["end"] = $value["endtime"] == 0 ? "不限制" : date('Y-m-d', $value["endtime"]);
			$list[$key]["state"] = $value["state"];
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "adList": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").'}';
	}
	die;

//预览
}elseif($dopost == "preview"){

	if(!empty($id)){
		include_once(HUONIAOINC."/class/myad.class.php");
		$param = array(
			'id' => $id
		);
		$handler = true;
		echo '<script type="text/javascript" src="'.$cfg_staticPath.'/js/core/jquery-1.8.3.min.js"></script>';
		$ad = getMyAd($param);
		echo $ad;die;
	}

//删除
}elseif($dopost == "del"){
	if($id != ""){

		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."list` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");

			array_push($title, $results[0]['title']);

			//删除表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."list` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除广告信息", $tab."=>".join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
	}
	die;

//更新状态
}elseif($dopost == "updateState"){
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."list` SET `state` = ".$state." WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("更新广告状态", $id."=>".$state);
		echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		// 'ui/jquery-ui-selectable.js',
		'ui/jquery-smartMenu.js',
		'ui/ZeroClipboard.js',
		'admin/siteConfig/advList.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->assign('action', $action);
	$huoniaoTag->assign('type', (int)$type);

	if($type){
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
					$i++;
				}
			}
		}
		$huoniaoTag->assign('typeListArr', json_encode($skins));
	}else{
		$huoniaoTag->assign('typeListArr', json_encode(getAdvTypeList(0, $action, $tab)));
	}


	//团购单独配置区域
	if($action == "tuan"){
		$addrListArr = array();
		$sql = $dsql->SetQuery("SELECT c.*, a.`typename` FROM `#@__tuan_city` c LEFT JOIN `#@__site_area` a ON a.`id` = c.`cid` ORDER BY c.`id`");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			foreach ($ret as $key => $value) {
				$addrListArr[$key]['id'] = $value['cid'];
				$addrListArr[$key]['typename'] = $value['typename'];
			}
		}
		$huoniaoTag->assign('addrListArr', $addrListArr);
	}


	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/siteConfig";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//获取分类列表
function getAdvTypeList($id, $model, $tab){
	global $dsql;
	$sql = $dsql->SetQuery("SELECT `id`, `parentid`, `typename` FROM `#@__".$tab."type` WHERE `parentid` = $id AND `model` = '$model' ORDER BY `weight`");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){//如果有子类
		foreach($results as $key => $value){
			$results[$key]["lower"] = getAdvTypeList($value['id'], $model, $tab);
		}
		return $results;
	}else{
		return "";
	}
}
