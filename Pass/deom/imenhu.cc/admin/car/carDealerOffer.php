<?php
/**
 * 经销商车型报价
 *
 * @version        $Id: carDealerOffer.php 2014-9-13 上午10:16:21 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carDealerOffer");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_dealer_offer";

if($dopost != ""){
	$templates = "carDealerOfferAdd.html";
	
	//js
	$jsFile = array(
		'admin/car/carDealerOfferAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carDealerOffer.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carDealerOffer.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	if(!empty($property)) $property = join(",", $property);
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if(empty($aid)){
		echo '{"state": 200, "info": "请选择经销商"}';
		exit();
	}else{
		$dealerSql = $dsql->SetQuery("SELECT `id` FROM `#@__car_dealer` WHERE `id` = ".$aid);
		$dealerResult = $dsql->dsqlOper($dealerSql, "results");
		if(!$dealerResult){
			echo '{"state": 200, "info": "经销商不存在，请重新选择！"}';
			exit();
		}
	}
	
	if(empty($bid)){
		echo '{"state": 200, "info": "请选择品牌"}';
		exit();
	}
	
	if(empty($cid)){
		echo '{"state": 200, "info": "请选择车系"}';
		exit();
	}
	
	if(empty($pid)){
		echo '{"state": 200, "info": "请选择车型"}';
		exit();
	}

	$where = "";
	if($dopost == "edit"){
		$where = " AND `id` <> ".$id;
	}
	$offerSql = $dsql->SetQuery("SELECT `id` FROM `#@__car_dealer_offer` WHERE `aid` = $aid AND `bid` = $bid AND `cid` = $cid AND `pid` = $pid".$where);
	$offerResult = $dsql->dsqlOper($offerSql, "results");
	if($offerResult){
		echo '{"state": 200, "info": "所选车型已经添加！"}';
		exit();
	}
	
	if(empty($price)){
		echo '{"state": 200, "info": "请输入本店销售价格"}';
		exit();
	}
	
	if(empty($color)){
		echo '{"state": 200, "info": "请选择可售颜色"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($aid)){
		$where .= " AND `aid` = ".$aid;
	}
	
	if(!empty($bid)){
		if($dsql->getTypeList($bid, "car_brand")){
			$lower = arr_foreach($dsql->getTypeList($bid, "car_brand"));
			$lower = $bid.",".join(',',$lower);
		}else{
			$lower = $bid;
		}
		$where .= " AND `bid` in ($lower)";
	}
	
	if(!empty($cid)){
		$where .= " AND `cid` = ".$cid;
	}
	
	if(!empty($pid)){
		$where .= " AND `pid` = ".$pid;
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `aid`, `bid`, `cid`, `pid`, `price`, `inventory`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];

			//经销商
			$list[$key]["aid"] = $value["aid"];
			$aSql = $dsql->SetQuery("SELECT `subtitle` FROM `#@__car_dealer` WHERE `id` = ". $value["aid"]);
			$aResult = $dsql->getTypeName($aSql);
			$list[$key]["aName"] = $aResult[0]['subtitle'];

			//品牌
			$list[$key]["bid"] = $value["bid"];
			$bSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_brand` WHERE `id` = ". $value["bid"]);
			$bResult = $dsql->getTypeName($bSql);
			$list[$key]["bName"] = $bResult[0]['typename'];

			//所属车系
			$list[$key]["cid"] = $value["cid"];
			$cSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $value["cid"]);
			$cResult = $dsql->getTypeName($cSql);
			$list[$key]["cName"] = $cResult[0]['title'];

			//所属车型
			$list[$key]["pid"] = $value['pid'];
			$cSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_param` WHERE `id` = ". $value["pid"]);
			$cResult = $dsql->getTypeName($cSql);
			$list[$key]["pName"] = $cResult[0]['title'];

			$list[$key]["price"] = $value["price"];
			
			$inventory = "";
			switch ($value['inventory']) {
				case '0':
					$inventory = "现车充足";
					break;				
				case '1':
					$inventory = "少量现车";
					break;
			}
			$list[$key]["inventory"] = $inventory;
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carDealerOffer": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carDealerOfferAdd");

	$pagetitle = "新增经销商车型报价";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`aid`, `bid`, `cid`, `pid`, `price`, `color`, `inventory`, `maincycle`, `mainprice`, `property`, `pubdate`) VALUES ('$aid', '$bid', '$cid', '$pid', '$price', '$color', '$inventory', '$maincycle', '$mainprice', '$property', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增经销商车型报价");
			syncPrice($cid);
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carDealerOfferEdit");
	
	$pagetitle = "修改经销商车型报价";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `aid` = '$aid', `bid` = '$bid', `cid` = '$cid', `pid` = '$pid', `price` = '$price', `color` = '$color', `inventory` = '$inventory', `maincycle` = '$maincycle', `mainprice` = '$mainprice', `property` = '$property' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改经销商车型报价");
			syncPrice($cid);
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
				
				$aid         = $results[0]['aid'];
				$bid         = $results[0]['bid'];
				$cid         = $results[0]['cid'];
				$pid         = $results[0]['pid'];
				$price       = $results[0]['price'];
				$color       = $results[0]['color'];
				$inventory   = $results[0]['inventory'];
				$maincycle   = $results[0]['maincycle'];
				$mainprice   = $results[0]['mainprice'];
				$property    = $results[0]['property'];
				
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
	if(!testPurview("carDealerOfferDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		
		//删除表
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` in (".$id.")");
		$results = $dsql->dsqlOper($archives, "update");

		adminLog("删除经销商车型报价");
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		
	}
	die;

//根据经销商ID获取品牌信息
}elseif($dopost == "getBrand"){
	if(!empty($aid)){
		//获取报价表中指定经销商车型信息
		$archives = $dsql->SetQuery("SELECT `bid` FROM `#@__".$tab."` WHERE `aid` = ".$aid);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$i = 0;
			$ids = $brand = array();
			foreach ($results as $key => $value) {
				$ids[] = $value['bid'];
			}
			$ids = array_unique($ids);

			//获取品牌信息
			foreach ($ids as $key => $value) {
				$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__car_brand` WHERE `id` = ".$value);
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					$brand[$i]['id'] = $results[0]['id'];
					$brand[$i]['typename'] = $results[0]['typename'];
					$i++;
				}
			}
			echo json_encode($brand);
		}
	}
	die;

//根据经销商ID和品牌ID获取车系
}elseif($dopost == "getCars"){
	if(!empty($aid) && !empty($brand)){
		$archives = $dsql->SetQuery("SELECT `cid` FROM `#@__".$tab."` WHERE `aid` = ".$aid." AND `bid` = ".$brand);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$i = 0;
			$ids = $car = array();
			foreach ($results as $key => $value) {
				$ids[] = $value['cid'];
			}
			$ids = array_unique($ids);

			//获取车型信息
			foreach ($ids as $key => $value) {
				$archives = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__car_list` WHERE `id` = ".$value);
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					$car[$i]['id'] = $results[0]['id'];
					$car[$i]['title'] = $results[0]['title'];
					$i++;
				}
			}
			echo json_encode($car);
		}
	}
	die;

//根据经销商ID、品牌ID、车系ID获取车型
}elseif($dopost == "getParam"){
	if(!empty($aid) && !empty($brand) && !empty($cid)){
		$archives = $dsql->SetQuery("SELECT `pid` FROM `#@__car_dealer_offer` WHERE `aid` = $aid AND `bid` = $brand AND `cid` = ".$cid);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			$i = 0;
			$return = array();
			foreach ($results as $key => $value) {
				$archives = $dsql->SetQuery("SELECT `id`, `year`, `title` FROM `#@__car_param` WHERE `id` = ".$value['pid']);
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					$return[$i]['id'] = $results[0]['id'];
					$return[$i]['title'] = $results[0]['year']."款 ".$results[0]['title'];
					$i++;
				}
			}
			echo json_encode($return);
		}
	}
	die;

//根据经销商ID、车型ID获取车型详细信息
}elseif($dopost == "getParamInfo"){
	if(!empty($aid) && !empty($cid)){
		$cid = explode(",", $cid);
		$return = array();
		$i = 0;
		foreach ($cid as $key => $value) {
			$archives = $dsql->SetQuery("SELECT `year`, `title`, `guide` FROM `#@__car_param` WHERE `id` = ".$value);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$archives_ = $dsql->SetQuery("SELECT `price`, `inventory` FROM `#@__car_dealer_offer` WHERE `pid` = ".$value." AND `aid` = ".$aid);
				$results_ = $dsql->dsqlOper($archives_, "results");
				if($results_){
					$return[$i]['id'] = $value;
					$return[$i]['title'] = $results[0]['year']."款 ".$results[0]['title'];
					$return[$i]['guide'] = $results[0]['guide'];
					$return[$i]['price'] = $results_[0]['price'];
					$return[$i]['deal'] = number_format($results[0]['guide'] - $results_[0]['price'], 2, '.', '');
					$inventory = "";
					switch ($results_[0]['inventory']) {
						case '0':
							$inventory = "现车充足";
							break;
						case '1':
							$inventory = "少量现车";
							break;
					}
					$return[$i]['inventory'] = $inventory;
					$i++;
				}
			}
		}
		echo json_encode($return);
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('aid', 0);
	$huoniaoTag->assign('aname', "请选择经销商");
	$huoniaoTag->assign('bid', 0);
	$huoniaoTag->assign('bname', "请选择品牌");
	$huoniaoTag->assign('cid', 0);
	$huoniaoTag->assign('cname', "请选择车系");
	$huoniaoTag->assign('pid', 0);
	$huoniaoTag->assign('pname', "请选择车型");
	
	if($dopost != ""){

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);

			//经销商
			$huoniaoTag->assign('aid', $aid);
			$aSql = $dsql->SetQuery("SELECT `subtitle` FROM `#@__car_dealer` WHERE `id` = ". $aid);
			$aResult = $dsql->getTypeName($aSql);
			$huoniaoTag->assign('aname', $aResult[0]["subtitle"]);
			
			//品牌名称
			$huoniaoTag->assign('bid', $bid);
			$brandSql = $dsql->SetQuery("SELECT `parentid`, `typename` FROM `#@__car_brand` WHERE `id` = ". $bid);
			$brandResult = $dsql->getTypeName($brandSql);
			$huoniaoTag->assign('bname', $brandResult[0]["typename"]);

			//车辆名称
			$huoniaoTag->assign('cid', $cid);
			$carSql = $dsql->SetQuery("SELECT `title`, `brand` FROM `#@__car_list` WHERE `id` = ". $cid);
			$carResult = $dsql->getTypeName($carSql);
			$huoniaoTag->assign('cname', $carResult[0]["title"]);

			//车型名称
			$huoniaoTag->assign('pid', $pid);
			$pSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_param` WHERE `id` = ". $pid);
			$pResult = $dsql->getTypeName($pSql);
			$huoniaoTag->assign('pname', $pResult[0]["title"]);

			$huoniaoTag->assign('price', $price);
			$huoniaoTag->assign('color', $color);
			$huoniaoTag->assign('maincycle', $maincycle);
			$huoniaoTag->assign('mainprice', $mainprice);
		}
		
		$huoniaoTag->assign('inventoryList', array(0 => '现车充足', 1 => '少量现车'));
		$huoniaoTag->assign('inventory', empty($inventory) ? 0 : $inventory);
		
		//属性
		$huoniaoTag->assign('propertyVal',array('r','h','n'));
		$huoniaoTag->assign('propertyList',array('推荐','热门','新车'));
		$huoniaoTag->assign('property', !empty($property) ? explode(",", $property) : "");

	}

	$huoniaoTag->assign('addrListArr', json_encode($dsql->getTypeList(0, "car_addr")));
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}

//同步主表最小最大价格
function syncPrice($cid){
	global $dsql;
	global $tab;
	$prices = array();
	
	$archives = $dsql->SetQuery("SELECT `price` FROM `#@__".$tab."` WHERE `cid` = ".$cid);
	$results = $dsql->dsqlOper($archives, "results");
	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			array_push($prices, $value['price']);
		}
	}

	$max = array_search(max($prices), $prices);
	$min = array_search(min($prices), $prices);
	
	$archives = $dsql->SetQuery("UPDATE `#@__car_list` SET `dminprice` = '".$prices[$min]."', `dmaxprice` = '".$prices[$max]."' WHERE `id` = ".$cid);
	$dsql->dsqlOper($archives, "update");
}