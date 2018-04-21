<?php
/**
 * 管理酒店菜单
 *
 * @version        $Id: marryHotelMenu.php 2014-8-1 上午09:49:21 $
 * @package        HuoNiao.Marry
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("marryHotelMenu");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/marry";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
if(empty($hotelid)) die("酒店ID传递失败，请检查！");

$tab = "marry_menu";

if($dopost != ""){
	$templates = "marryHotelMenuAdd.html";
	
	//js
	$jsFile = array(
		'ui/jquery.dragsort-0.5.1.min.js',
		'ui/bootstrap.min.js',
		'admin/marry/marryHotelMenuAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "marryHotelMenu.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/marry/marryHotelMenu.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate     = GetMkTime(time());       //发布时间
	
	//二次验证
	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入菜单名称"}';
		exit();
	}
	if(trim($price) == ""){
		echo '{"state": 200, "info": "请输入价格"}';
		exit();
	}
	
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `hotel` = ".$hotelid);

	//总条数
	$totalCount = $dsql->dsqlOper($archives, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `weight` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `title`, `price`, `weight` FROM `#@__".$tab."` WHERE `hotel` = ".$hotelid.$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["title"] = $value["title"];
			$list[$key]["price"] = $value["price"];
			$list[$key]["weight"] = $value["weight"];
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "marryHotelMenu": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){

	$pagetitle = "新增婚宴菜单";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`hotel`, `title`, `price`, `menus`, `weight`, `note`) VALUES ('$hotelid', '$title', '$price', '$menus', '$weight', '$note')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增婚宴酒店菜单", $title);
			syncPrice();
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	
	$pagetitle = "修改婚宴菜单信息";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `title` = '$title', `price` = '$price', `menus` = '$menus', `weight` = '$weight', `note` = '$note' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改婚宴酒店菜单信息", $title);
			syncPrice();
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}else{
			echo $return;
		}
		die;
		
	}else{
		if(!empty($id)){
			
			//主表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			
			if(!empty($results)){
				
				$title    = $results[0]['title'];
				$price    = $results[0]['price'];
				$menus    = $results[0]['menus'];
				$weight   = $results[0]['weight'];
				$note     = $results[0]['note'];
				
			}else{
				ShowMsg('要修改的信息不存在或已删除！', "-1");
				die;
			}
			
		}else{
			ShowMsg('要修改的信息参数传递失败，请联系管理员！', "-1");
			die;
		}
	}
	
//删除
}elseif($dopost == "del"){
	if($id != ""){
		
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			
			array_push($title, $results[0]['title']);
			
			//删除户型表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除酒店菜单信息", join(", ", $title));
			syncPrice();
			echo '{"state": 100, "info": '.json_encode("修改成功！").'}';
		}
		die;
		
	}
	die;
	
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('hoteid', $hoteid);
	
	if($dopost != ""){
		$huoniaoTag->assign('id', $id);
		$huoniaoTag->assign('title', $title);
		$huoniaoTag->assign('price', $price);
		if(!empty($menus)){
			$mHtml = "";
			$mArr = explode("@@@", $menus);
			if($mArr){
				foreach($mArr as $val){
					$mHtml .= '<div class="menus-item clearfix">';
					$mItem = explode("$$", $val);
					$mTitle = $mItem[0];
					$mList  = $mItem[1];
					
					$mHtml .= '<h3><i data-toggle="tooltip" data-placement="right" data-original-title="拖动以排序" class="icon-move"></i><input type="text" name="m-title" placeholder="套系名" class="input-small" value="'.$mTitle.'" /></h3><div class="del-item"><a href="javascript:;"><i class="icon-trash"></i>删除此套系</a></div>';
					
					$mListArr = explode("||", $mList);
					if($mListArr){
						$mHtml .= '<ul class="clearfix">';
						foreach($mListArr as $list){
							$mHtml .= '<li><i data-toggle="tooltip" data-placement="right" data-original-title="拖动以排序" class="icon-move"></i><input type="text" name="m-list" placeholder="菜名" class="input-medium" value="'.$list.'" /><a data-toggle="tooltip" data-placement="right" data-original-title="删除" href="javascript:;" class="icon-trash"></a></li>';
						}
						$mHtml .= '</ul>';
					}
					
					$mHtml .= '<a href="javascript:;" class="addNewList"><i class="icon-plus"></i>新增菜名</a>';
					$mHtml .= '</div>';
					
				}
			}
			$huoniaoTag->assign('menus', $mHtml);
		}
		$huoniaoTag->assign('weight', $weight);
		$huoniaoTag->assign('note', $note);
	}
	
	
	
	//酒店信息
	$hotelSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__marry_hotel` WHERE `id` = ". $hotelid);
	$hotelResult = $dsql->getTypeName($hotelSql);
	if(!$hotelResult)die('酒店不存在！');
	$huoniaoTag->assign('hotelid', $hotelResult[0]['id']);
	$huoniaoTag->assign('hotelname', $hotelResult[0]['title']);

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/marry";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//同步主表最小最大价格
function syncPrice(){
	global $dsql;
	global $tab;
	global $hotelid;
	$prices = array();
	
	$archives = $dsql->SetQuery("SELECT `price` FROM `#@__".$tab."` WHERE `hotel` = ".$hotelid);
	$results = $dsql->dsqlOper($archives, "results");
	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			array_push($prices, $value['price']);
		}
	}

	$max = array_search(max($prices), $prices);
	$min = array_search(min($prices), $prices);
	
	$archives = $dsql->SetQuery("UPDATE `#@__marry_hotel` SET `minprice` = '".$prices[$min]."', `maxprice` = '".$prices[$max]."' WHERE `id` = ".$hotelid);
	$dsql->dsqlOper($archives, "update");
}