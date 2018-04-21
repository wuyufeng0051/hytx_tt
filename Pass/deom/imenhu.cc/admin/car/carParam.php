<?php
/**
 * 汽车配置管理
 *
 * @version        $Id: carParam.php 2014-8-21 下午16:45:21 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carParam");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_param";

if($dopost != ""){
	$templates = "carParamAdd.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap-datetimepicker.min.js',
		'admin/car/carParamAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carParam.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carParam.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$listedDate = !empty($listedDate) ? GetMkTime($listedDate) : 0;
	$year = (int)$year;
	$guide = (float)$guide;
	$speed = (int)$speed;
	$occupant = (int)$occupant;
	$long = (int)$long;
	$width = (int)$width;
	$height = (int)$height;
	$wheelbase = (int)$wheelbase;
	$ftrack = (int)$ftrack;
	$btrack = (int)$btrack;
	$curbweight = (int)$curbweight;
	$fullweight = (int)$fullweight;
	$clearance = (int)$clearance;
	$approach = (int)$approach;
	$departure = (int)$departure;
	$luggage = (int)$luggage;
	$doors = (int)$doors;
	$displacementMl = (int)$displacementMl;
	$cylinder = (int)$cylinder;
	$valvecount = (int)$valvecount;
	$compression = (float)$compression;
	$bore = (float)$bore;
	$stroke = (float)$stroke;
	$horsepower = (int)$horsepower;
	$power = (int)$power;
	$torque = (int)$torque;
	$fuelgrade = (int)$fuelgrade;
	$turnradius = (float)$turnradius;
	$fueltank = (int)$fueltank;
	$blockcount = (int)$blockcount;
	$vehiclepowervoltage = (int)$vehiclepowervoltage;
	$dvd = (int)$dvd;
	$cd = (int)$cd;
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if(empty($cid)){
		echo '{"state": 200, "info": "请选择所属车辆"}';
		exit();
	}

	if(empty($year)){
		echo '{"state": 200, "info": "请输入所属年款"}';
		exit();
	}

	if(empty($gearbox)){
		echo '{"state": 200, "info": "请选择变速箱"}';
		exit();
	}

	if(empty($displacement)){
		echo '{"state": 200, "info": "请选择排量"}';
		exit();
	}

	if(empty($listedDate)){
		echo '{"state": 200, "info": "请输入上市时间"}';
		exit();
	}

	if(trim($title) == ""){
		echo '{"state": 200, "info": "请输入配置名称"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	if($sKeyword != ""){
		$carSql = $dsql->SetQuery("SELECT `id` FROM `#@__car_list` WHERE `title` like '%$sKeyword%'");
		$carResult = $dsql->dsqlOper($carSql, "results");
		if($carResult){
			$carid = array();
			foreach($carResult as $key => $car){
				array_push($carid, $car['id']);
			}
			if(!empty($carid)){
				$where .= " AND (`title` like '%$sKeyword%' OR `cid` in (".join(",", $carid)."))";
			}else{
				$where .= " AND `title` like '%$sKeyword%'";
			}
		}else{
			$where .= " AND `title` like '%$sKeyword%'";
		}
	}
		
	if($brand != ""){
		if($dsql->getTypeList($brand, "car_brand")){
			$lower = arr_foreach($dsql->getTypeList($brand, "car_brand"));
			$lower = $brand.",".join(',',$lower);
		}else{
			$lower = $brand;
		}

		$carSql = $dsql->SetQuery("SELECT `id` FROM `#@__car_list` WHERE `brand` in ($lower)");
		$carResult = $dsql->dsqlOper($carSql, "results");
		if($carResult){
			$carid = array();
			foreach($carResult as $key => $car){
				array_push($carid, $car['id']);
			}
			if(!empty($carid)){
				$where .= " AND `cid` in (".join(",", $carid).")";
			}
		}else{
			$where .= " AND 1 = 2";
		}
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `pubdate` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `cid`, `year`, `gearbox`, `displacement`, `title`, `saletype`, `guide` , `blockcount` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$Param = array();
		foreach ($results as $key=>$value) {
			$Param[$key]["id"] = $value["id"];
			$Param[$key]["cid"] = $value["cid"];

			//车辆名称
			$carSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $value["cid"]);
			$carResult = $dsql->getTypeName($carSql);
			$Param[$key]["cname"] = $carResult[0]["title"];

			$Param[$key]["year"] = $value["year"];
			
			//变速箱
			$itemSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_item` WHERE `id` = ". $value["gearbox"]);
			$itemResult = $dsql->getTypeName($itemSql);
			$Param[$key]["gearbox"] = $itemResult[0]['typename'];
			
			$Param[$key]["displacement"] = $value["displacement"];
			$Param[$key]["title"] = $value["title"];
			$Param[$key]["saletype"] = $value["saletype"];
			$Param[$key]["guide"] = $value["guide"];
			$Param[$key]["blockcount"] = $value["blockcount"];
		}
		
		if(count($Param) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carParam": '.json_encode($Param).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carParamAdd");

	$pagetitle = "添加新配置";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`cid`, `year`, `gearbox`, `displacement`, `listedDate`, `title`, `saletype`, `guide`, `warranty`, `speed`, `occupant`, `color`, `long`, `width`, `height`, `wheelbase`, `ftrack`, `btrack`, `curbweight`, `fullweight`, `clearance`, `approach`, `departure`, `luggage`, `gopentype`, `opentype`, `doors`, `roofrack`, `spoaro`, `enginepos`, `enginemod`, `displacementMl`, `intake`, `cylindertype`, `cylinder`, `valvecount`, `valvestructure`, `compression`, `bore`, `stroke`, `horsepower`, `power`, `powerspeed`, `torque`, `torquespeed`, `specific`, `fuel`, `fuelgrade`, `oilway`, `fueltank`, `headmaterial`, `cylindermaterial`, `environmental`, `ossystem`, `blockcount`, `shiftpaddles`, `structure`, `turnradius`, `steering`, `fbraketype`, `rbraketype`, `pbraketype`, `driver`, `airsuspension`, `adjustable`, `fsuspensiontype`, `bsuspensiontype`, `driverairbags`, `copilotairbag`, `fairbags`, `fhairbags`, `kneeairbag`, `rairbags`, `rhairbags`, `seatips`, `seatforce`, `seatprete`, `seatadjus`, `rseat`, `tirepressure`, `locking`, `centrallocking`, `remotekey`, `keylessstart`, `eantiengine`, `frontire`, `reartire`, `fwheelhub`, `bwheelhub`, `sparetire`, `hubmaterial`, `abs`, `ebd`, `brakeassist`, `traction`, `esp`, `eps`, `apark`, `hillassist`, `descent`, `parkradar`, `reversradar`, `reverseimage`, `panoramicamera`, `cruise`, `adaptivecruise`, `gps`, `interactive`, `autopark`, `activebrake`, `nightvision`, `blindspot`, `electricw`, `uv`, `wpinch`, `skylightmode`, `skylighttype`, `rsunshade`, `rssunshade`, `awipers`, `swipers`, `mirrorsturnsignals`, `omirrormemory`, `emirrorheat`, `emirrorfold`, `emirroradju`, `irmirrordimm`, `visormirror`, `headlamp`, `headlightsautosc`, `headlampautocf`, `headlightswds`, `headlamprange`, `frontfoglights`, `breadlamp`, `areadlamp`, `ambientlight`, `daytimerunlights`, `ledtail`, `highbrekelight`, `assistlamp`, `luggagelamp`, `swheelbfadjust`, `swheeludadjust`, `swheeladjustmethod`, `swheelsurface`, `multiswheel`, `computerdisplay`, `interiorcolors`, `rearcupholder`, `vehiclepowervoltage`, `sportseats`, `seatmaterial`, `seatadjust`, `pseatadjust`, `lumbarsupportadjust`, `shouldsupportadjust`, `fcenterarmrest`, `acenterarmrest`, `seatventilation`, `seatheating`, `seatmassage`, `seatmemory`, `childsafety`, `thirdseats`, `carphone`, `bluetooth`, `externalinterface`, `builtdrive`, `cartv`, `speakers`, `audiobrand`, `dvd`, `cd`, `cclcd`, `rlcd`, `aircontrol`, `tempercontrol`, `rearindeaircond`, `adischargeoutlet`, `pollenfilter`, `refrigerator`, `pubdate`) VALUES ('$cid', '$year', '$gearbox', '$displacement', '$listedDate', '$title', '$saletype', '$guide', '$warranty', '$speed', '$occupant', '$color', '$long', '$width', '$height', '$wheelbase', '$ftrack', '$btrack', '$curbweight', '$fullweight', '$clearance', '$approach', '$departure', '$luggage', '$gopentype', '$opentype', '$doors', '$roofrack', '$spoaro', '$enginepos', '$enginemod', '$displacementMl', '$intake', '$cylindertype', '$cylinder', '$valvecount', '$valvestructure', '$compression', '$bore', '$stroke', '$horsepower', '$power', '$powerspeed', '$torque', '$torquespeed', '$specific', '$fuel', '$fuelgrade', '$oilway', '$fueltank', '$headmaterial', '$cylindermaterial', '$environmental', '$ossystem', '$blockcount', '$shiftpaddles', '$structure', '$turnradius', '$steering', '$fbraketype', '$rbraketype', '$pbraketype', '$driver', '$airsuspension', '$adjustable', '$fsuspensiontype', '$bsuspensiontype', '$driverairbags', '$copilotairbag', '$fairbags', '$fhairbags', '$kneeairbag', '$rairbags', '$rhairbags', '$seatips', '$seatforce', '$seatprete', '$seatadjus', '$rseat', '$tirepressure', '$locking', '$centrallocking', '$remotekey', '$keylessstart', '$eantiengine', '$frontire', '$reartire', '$fwheelhub', '$bwheelhub', '$sparetire', '$hubmaterial', '$abs', '$ebd', '$brakeassist', '$traction', '$esp', '$eps', '$apark', '$hillassist', '$descent', '$parkradar', '$reversradar', '$reverseimage', '$panoramicamera', '$cruise', '$adaptivecruise', '$gps', '$interactive', '$autopark', '$activebrake', '$nightvision', '$blindspot', '$electricw', '$uv', '$wpinch', '$skylightmode', '$skylighttype', '$rsunshade', '$rssunshade', '$awipers', '$swipers', '$mirrorsturnsignals', '$omirrormemory', '$emirrorheat', '$emirrorfold', '$emirroradju', '$irmirrordimm', '$visormirror', '$headlamp', '$headlightsautosc', '$headlampautocf', '$headlightswds', '$headlamprange', '$frontfoglights', '$breadlamp', '$areadlamp', '$ambientlight', '$daytimerunlights', '$ledtail', '$highbrekelight', '$assistlamp', '$luggagelamp', '$swheelbfadjust', '$swheeludadjust', '$swheeladjustmethod', '$swheelsurface', '$multiswheel', '$computerdisplay', '$interiorcolors', '$rearcupholder', '$vehiclepowervoltage', '$sportseats', '$seatmaterial', '$seatadjust', '$pseatadjust', '$lumbarsupportadjust', '$shouldsupportadjust', '$fcenterarmrest', '$acenterarmrest', '$seatventilation', '$seatheating', '$seatmassage', '$seatmemory', '$childsafety', '$thirdseats', '$carphone', '$bluetooth', '$externalinterface', '$builtdrive', '$cartv', '$speakers', '$audiobrand', '$dvd', '$cd', '$cclcd', '$rlcd', '$aircontrol', '$tempercontrol', '$rearindeaircond', '$adischargeoutlet', '$pollenfilter', '$refrigerator', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");
		
		if($aid){
			adminLog("添加汽车新配置", $title);
			syncPrice($cid);
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carParamEdit");
	
	$pagetitle = "修改配置";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `cid` = '$cid', `year` = '$year', `gearbox` = '$gearbox', `displacement` = '$displacement', `listedDate` = '$listedDate', `title` = '$title', `saletype` = '$saletype', `guide` = '$guide', `warranty` = '$warranty', `speed` = '$speed', `occupant` = '$occupant', `color` = '$color', `long` = '$long', `width` = '$width', `height` = '$height', `wheelbase` = '$wheelbase', `ftrack` = '$ftrack', `btrack` = '$btrack', `curbweight` = '$curbweight', `fullweight` = '$fullweight', `clearance` = '$clearance', `approach` = '$approach', `departure` = '$departure', `luggage` = '$luggage', `gopentype` = '$gopentype', `opentype` = '$opentype', `doors` = '$doors', `roofrack` = '$roofrack', `spoaro` = '$spoaro', `enginepos` = '$enginepos', `enginemod` = '$enginemod', `displacementMl` = '$displacementMl', `intake` = '$intake', `cylindertype` = '$cylindertype', `cylinder` = '$cylinder', `valvecount` = '$valvecount', `valvestructure` = '$valvestructure', `compression` = '$compression', `bore` = '$bore', `stroke` = '$stroke', `horsepower` = '$horsepower', `power` = '$power', `powerspeed` = '$powerspeed', `torque` = '$torque', `torquespeed` = '$torquespeed', `specific` = '$specific', `fuel` = '$fuel', `fuelgrade` = '$fuelgrade', `oilway` = '$oilway', `fueltank` = '$fueltank', `headmaterial` = '$headmaterial', `cylindermaterial` = '$cylindermaterial', `environmental` = '$environmental', `ossystem` = '$ossystem', `blockcount` = '$blockcount', `shiftpaddles` = '$shiftpaddles', `structure` = '$structure', `turnradius` = '$turnradius', `steering` = '$steering', `fbraketype` = '$fbraketype', `rbraketype` = '$rbraketype', `pbraketype` = '$pbraketype', `driver` = '$driver', `airsuspension` = '$airsuspension', `adjustable` = '$adjustable', `fsuspensiontype` = '$fsuspensiontype', `bsuspensiontype` = '$bsuspensiontype', `driverairbags` = '$driverairbags', `copilotairbag` = '$copilotairbag', `fairbags` = '$fairbags', `fhairbags` = '$fhairbags', `kneeairbag` = '$kneeairbag', `rairbags` = '$rairbags', `rhairbags` = '$rhairbags', `seatips` = '$seatips', `seatforce` = '$seatforce', `seatprete` = '$seatprete', `seatadjus` = '$seatadjus', `rseat` = '$rseat', `tirepressure` = '$tirepressure', `locking` = '$locking', `centrallocking` = '$centrallocking', `remotekey` = '$remotekey', `keylessstart` = '$keylessstart', `eantiengine` = '$eantiengine', `frontire` = '$frontire', `reartire` = '$reartire', `fwheelhub` = '$fwheelhub', `bwheelhub` = '$bwheelhub', `sparetire` = '$sparetire', `hubmaterial` = '$hubmaterial', `abs` = '$abs', `ebd` = '$ebd', `brakeassist` = '$brakeassist', `traction` = '$traction', `esp` = '$esp', `eps` = '$eps', `apark` = '$apark', `hillassist` = '$hillassist', `descent` = '$descent', `parkradar` = '$parkradar', `reversradar` = '$reversradar', `reverseimage` = '$reverseimage', `panoramicamera` = '$panoramicamera', `cruise` = '$cruise', `adaptivecruise` = '$adaptivecruise', `gps` = '$gps', `interactive` = '$interactive', `autopark` = '$autopark', `activebrake` = '$activebrake', `nightvision` = '$nightvision', `blindspot` = '$blindspot', `electricw` = '$electricw', `uv` = '$uv', `wpinch` = '$wpinch', `skylightmode` = '$skylightmode', `skylighttype` = '$skylighttype', `rsunshade` = '$rsunshade', `rssunshade` = '$rssunshade', `awipers` = '$awipers', `swipers` = '$swipers', `mirrorsturnsignals` = '$mirrorsturnsignals', `omirrormemory` = '$omirrormemory', `emirrorheat` = '$emirrorheat', `emirrorfold` = '$emirrorfold', `emirroradju` = '$emirroradju', `irmirrordimm` = '$irmirrordimm', `visormirror` = '$visormirror', `headlamp` = '$headlamp', `headlightsautosc` = '$headlightsautosc', `headlampautocf` = '$headlampautocf', `headlightswds` = '$headlightswds', `headlamprange` = '$headlamprange', `frontfoglights` = '$frontfoglights', `breadlamp` = '$breadlamp', `areadlamp` = '$areadlamp', `ambientlight` = '$ambientlight', `daytimerunlights` = '$daytimerunlights', `ledtail` = '$ledtail', `highbrekelight` = '$highbrekelight', `assistlamp` = '$assistlamp', `luggagelamp` = '$luggagelamp', `swheelbfadjust` = '$swheelbfadjust', `swheeludadjust` = '$swheeludadjust', `swheeladjustmethod` = '$swheeladjustmethod', `swheelsurface` = '$swheelsurface', `multiswheel` = '$multiswheel', `computerdisplay` = '$computerdisplay', `interiorcolors` = '$interiorcolors', `rearcupholder` = '$rearcupholder', `vehiclepowervoltage` = '$vehiclepowervoltage', `sportseats` = '$sportseats', `seatmaterial` = '$seatmaterial', `seatadjust` = '$seatadjust', `pseatadjust` = '$pseatadjust', `lumbarsupportadjust` = '$lumbarsupportadjust', `shouldsupportadjust` = '$shouldsupportadjust', `fcenterarmrest` = '$fcenterarmrest', `acenterarmrest` = '$acenterarmrest', `seatventilation` = '$seatventilation', `seatheating` = '$seatheating', `seatmassage` = '$seatmassage', `seatmemory` = '$seatmemory', `childsafety` = '$childsafety', `thirdseats` = '$thirdseats', `carphone` = '$carphone', `bluetooth` = '$bluetooth', `externalinterface` = '$externalinterface', `builtdrive` = '$builtdrive', `cartv` = '$cartv', `speakers` = '$speakers', `audiobrand` = '$audiobrand', `dvd` = '$dvd', `cd` = '$cd', `cclcd` = '$cclcd', `rlcd` = '$rlcd', `aircontrol` = '$aircontrol', `tempercontrol` = '$tempercontrol', `rearindeaircond` = '$rearindeaircond', `adischargeoutlet` = '$adischargeoutlet', `pollenfilter` = '$pollenfilter', `refrigerator` = '$refrigerator' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车配置", $title);
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
				
				$cid                 = $results[0]['cid'];
				$year                = $results[0]['year'];
				$gearbox             = $results[0]['gearbox'];
				$displacement        = $results[0]['displacement'];
				$listedDate          = $results[0]['listedDate'];
				$title               = $results[0]['title'];
				$saletype            = $results[0]['saletype'];
				$guide               = $results[0]['guide'];
				$warranty            = $results[0]['warranty'];
				$speed               = $results[0]['speed'];
				$occupant            = $results[0]['occupant'];
				$color               = $results[0]['color'];
				$long                = $results[0]['long'];
				$width               = $results[0]['width'];
				$height              = $results[0]['height'];
				$wheelbase           = $results[0]['wheelbase'];
				$ftrack              = $results[0]['ftrack'];
				$btrack              = $results[0]['btrack'];
				$curbweight          = $results[0]['curbweight'];
				$fullweight          = $results[0]['fullweight'];
				$clearance           = $results[0]['clearance'];
				$approach            = $results[0]['approach'];
				$departure           = $results[0]['departure'];
				$luggage             = $results[0]['luggage'];
				$gopentype           = $results[0]['gopentype'];
				$opentype            = $results[0]['opentype'];
				$doors               = $results[0]['doors'];
				$roofrack            = $results[0]['roofrack'];
				$spoaro              = $results[0]['spoaro'];
				$enginepos           = $results[0]['enginepos'];
				$enginemod           = $results[0]['enginemod'];
				$displacementMl      = $results[0]['displacementMl'];
				$intake              = $results[0]['intake'];
				$cylindertype        = $results[0]['cylindertype'];
				$cylinder            = $results[0]['cylinder'];
				$valvecount          = $results[0]['valvecount'];
				$valvestructure      = $results[0]['valvestructure'];
				$compression         = $results[0]['compression'];
				$bore                = $results[0]['bore'];
				$stroke              = $results[0]['stroke'];
				$horsepower          = $results[0]['horsepower'];
				$power               = $results[0]['power'];
				$powerspeed          = $results[0]['powerspeed'];
				$torque              = $results[0]['torque'];
				$torquespeed         = $results[0]['torquespeed'];
				$specific            = $results[0]['specific'];
				$fuel                = $results[0]['fuel'];
				$fuelgrade           = $results[0]['fuelgrade'];
				$oilway              = $results[0]['oilway'];
				$fueltank            = $results[0]['fueltank'];
				$headmaterial        = $results[0]['headmaterial'];
				$cylindermaterial    = $results[0]['cylindermaterial'];
				$environmental       = $results[0]['environmental'];
				$ossystem            = $results[0]['ossystem'];
				$blockcount          = $results[0]['blockcount'];
				$shiftpaddles        = $results[0]['shiftpaddles'];
				$structure           = $results[0]['structure'];
				$turnradius          = $results[0]['turnradius'];
				$steering            = $results[0]['steering'];
				$fbraketype          = $results[0]['fbraketype'];
				$rbraketype          = $results[0]['rbraketype'];
				$pbraketype          = $results[0]['pbraketype'];
				$driver              = $results[0]['driver'];
				$airsuspension       = $results[0]['airsuspension'];
				$adjustable          = $results[0]['adjustable'];
				$fsuspensiontype     = $results[0]['fsuspensiontype'];
				$bsuspensiontype     = $results[0]['bsuspensiontype'];
				$driverairbags       = $results[0]['driverairbags'];
				$copilotairbag       = $results[0]['copilotairbag'];
				$fairbags            = $results[0]['fairbags'];
				$fhairbags           = $results[0]['fhairbags'];
				$kneeairbag          = $results[0]['kneeairbag'];
				$rairbags            = $results[0]['rairbags'];
				$rhairbags           = $results[0]['rhairbags'];
				$seatips             = $results[0]['seatips'];
				$seatforce           = $results[0]['seatforce'];
				$seatprete           = $results[0]['seatprete'];
				$seatadjus           = $results[0]['seatadjus'];
				$rseat               = $results[0]['rseat'];
				$tirepressure        = $results[0]['tirepressure'];
				$locking             = $results[0]['locking'];
				$centrallocking      = $results[0]['centrallocking'];
				$remotekey           = $results[0]['remotekey'];
				$keylessstart        = $results[0]['keylessstart'];
				$eantiengine         = $results[0]['eantiengine'];
				$frontire            = $results[0]['frontire'];
				$reartire            = $results[0]['reartire'];
				$fwheelhub           = $results[0]['fwheelhub'];
				$bwheelhub           = $results[0]['bwheelhub'];
				$sparetire           = $results[0]['sparetire'];
				$hubmaterial         = $results[0]['hubmaterial'];
				$abs                 = $results[0]['abs'];
				$ebd                 = $results[0]['ebd'];
				$brakeassist         = $results[0]['brakeassist'];
				$traction            = $results[0]['traction'];
				$esp                 = $results[0]['esp'];
				$eps                 = $results[0]['eps'];
				$apark               = $results[0]['apark'];
				$hillassist          = $results[0]['hillassist'];
				$descent             = $results[0]['descent'];
				$parkradar           = $results[0]['parkradar'];
				$reversradar         = $results[0]['reversradar'];
				$reverseimage        = $results[0]['reverseimage'];
				$panoramicamera      = $results[0]['panoramicamera'];
				$cruise              = $results[0]['cruise'];
				$adaptivecruise      = $results[0]['adaptivecruise'];
				$gps                 = $results[0]['gps'];
				$interactive         = $results[0]['interactive'];
				$autopark            = $results[0]['autopark'];
				$activebrake         = $results[0]['activebrake'];
				$nightvision         = $results[0]['nightvision'];
				$blindspot           = $results[0]['blindspot'];
				$electricw           = $results[0]['electricw'];
				$uv                  = $results[0]['uv'];
				$wpinch              = $results[0]['wpinch'];
				$skylightmode        = $results[0]['skylightmode'];
				$skylighttype        = $results[0]['skylighttype'];
				$rsunshade           = $results[0]['rsunshade'];
				$rssunshade          = $results[0]['rssunshade'];
				$awipers             = $results[0]['awipers'];
				$swipers             = $results[0]['swipers'];
				$mirrorsturnsignals  = $results[0]['mirrorsturnsignals'];
				$omirrormemory       = $results[0]['omirrormemory'];
				$emirrorheat         = $results[0]['emirrorheat'];
				$emirrorfold         = $results[0]['emirrorfold'];
				$emirroradju         = $results[0]['emirroradju'];
				$irmirrordimm        = $results[0]['irmirrordimm'];
				$visormirror         = $results[0]['visormirror'];
				$headlamp            = $results[0]['headlamp'];
				$headlightsautosc    = $results[0]['headlightsautosc'];
				$headlampautocf      = $results[0]['headlampautocf'];
				$headlightswds       = $results[0]['headlightswds'];
				$headlamprange       = $results[0]['headlamprange'];
				$frontfoglights      = $results[0]['frontfoglights'];
				$breadlamp           = $results[0]['breadlamp'];
				$areadlamp           = $results[0]['areadlamp'];
				$ambientlight        = $results[0]['ambientlight'];
				$daytimerunlights    = $results[0]['daytimerunlights'];
				$ledtail             = $results[0]['ledtail'];
				$highbrekelight      = $results[0]['highbrekelight'];
				$assistlamp          = $results[0]['assistlamp'];
				$luggagelamp         = $results[0]['luggagelamp'];
				$swheelbfadjust      = $results[0]['swheelbfadjust'];
				$swheeludadjust      = $results[0]['swheeludadjust'];
				$swheeladjustmethod  = $results[0]['swheeladjustmethod'];
				$swheelsurface       = $results[0]['swheelsurface'];
				$multiswheel         = $results[0]['multiswheel'];
				$computerdisplay     = $results[0]['computerdisplay'];
				$interiorcolors      = $results[0]['interiorcolors'];
				$rearcupholder       = $results[0]['rearcupholder'];
				$vehiclepowervoltage = $results[0]['vehiclepowervoltage'];
				$sportseats          = $results[0]['sportseats'];
				$seatmaterial        = $results[0]['seatmaterial'];
				$seatadjust          = $results[0]['seatadjust'];
				$pseatadjust         = $results[0]['pseatadjust'];
				$lumbarsupportadjust = $results[0]['lumbarsupportadjust'];
				$shouldsupportadjust = $results[0]['shouldsupportadjust'];
				$fcenterarmrest      = $results[0]['fcenterarmrest'];
				$acenterarmrest      = $results[0]['acenterarmrest'];
				$seatventilation     = $results[0]['seatventilation'];
				$seatheating         = $results[0]['seatheating'];
				$seatmassage         = $results[0]['seatmassage'];
				$seatmemory          = $results[0]['seatmemory'];
				$childsafety         = $results[0]['childsafety'];
				$thirdseats          = $results[0]['thirdseats'];
				$carphone            = $results[0]['carphone'];
				$bluetooth           = $results[0]['bluetooth'];
				$externalinterface   = $results[0]['externalinterface'];
				$builtdrive          = $results[0]['builtdrive'];
				$cartv               = $results[0]['cartv'];
				$speakers            = $results[0]['speakers'];
				$audiobrand          = $results[0]['audiobrand'];
				$dvd                 = $results[0]['dvd'];
				$cd                  = $results[0]['cd'];
				$cclcd               = $results[0]['cclcd'];
				$rlcd                = $results[0]['rlcd'];
				$aircontrol          = $results[0]['aircontrol'];
				$tempercontrol       = $results[0]['tempercontrol'];
				$rearindeaircond     = $results[0]['rearindeaircond'];
				$adischargeoutlet    = $results[0]['adischargeoutlet'];
				$pollenfilter        = $results[0]['pollenfilter'];
				$refrigerator        = $results[0]['refrigerator'];
				
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
	if(!testPurview("carDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		
		$each = explode(",", $id);
		$error = array();
		$title = array();
		foreach($each as $val){
			$archives = $dsql->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			
			//车辆名称
			$carSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $results[0]['cid']);
			$carResult = $dsql->getTypeName($carSql);

			array_push($title, $carResult[0]["title"]." ".$results[0]['year']." ".$results[0]['title']);

			//删除图片
			$archives = $dsql->SetQuery("SELECT * FROM `#@__car_pic` WHERE `pid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach ($results as $key => $value) {
					delPicFile($value['pic'], "delAtlas", "car");
				}
			}
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_pic` WHERE `pid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除口碑
			$archives = $dsql->SetQuery("SELECT * FROM `#@__car_koubei` WHERE `pid` = ".$val);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach ($results as $key => $value) {
					delPicFile($value['pics'], "delAtlas", "car");
				}
			}
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_koubei` WHERE `pid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除油耗
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_youhao` WHERE `pid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除保养
			$archives = $dsql->SetQuery("DELETE FROM `#@__car_baoyang` WHERE `pid` = ".$val);
			$dsql->dsqlOper($archives, "update");

			//删除表
			$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` = ".$val);
			$results = $dsql->dsqlOper($archives, "update");
			if($results != "ok"){
				$error[] = $val;
			}
		}
		if(!empty($error)){
			echo '{"state": 200, "info": '.json_encode($error).'}';
		}else{
			adminLog("删除汽车配置", join(", ", $title));
			echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		}
		die;
		
	}
	die;
	
//选择品牌
}elseif($dopost == "getBrand"){
	$sql = $dsql->SetQuery("SELECT `id`, `letter`, `typename` FROM `#@__car_brand` WHERE `parentid` = 0 ORDER BY `letter` ASC");
	$results = $dsql->dsqlOper($sql, "results");
	echo json_encode($results);
	die;

//单独获取车系二级
}elseif($dopost == "getSubCars"){
	$return = array();
	$sql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__car_brand` WHERE `parentid` = $brand ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		$GroupId = $i = 0;
		foreach ($results as $key => $value) {
			if($GroupId != $value['id']){
				$return[$i]['GroupId'] = $value['id'];
				$return[$i]['GroupName'] = $value['typename'];
				$i++;
			}
			$GroupId = $value['id'];
		}
	}
	echo json_encode($return);
	die;

//单独获取车系（不包含二级品牌）
}elseif($dopost == "getCarsSingle"){
	$return = array();
	$sql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__car_list` WHERE `brand` = $brand ORDER BY `weight` DESC, `id` DESC");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		foreach ($results as $key => $value) {
			$return[$key]['id'] = $value['id'];
			$return[$key]['title'] = $value['title'];
		}
	}
	echo json_encode($return);
	die;

//选择车系
}elseif($dopost == "getCars"){
	$return = array();
	$sql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__car_brand` WHERE `parentid` = $brand ORDER BY `weight` ASC");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		$i = 0;
		foreach ($results as $key => $value) {
			$sql_ = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__car_list` WHERE `brand` = ".$value['id']." ORDER BY `weight` DESC, `id` DESC");
			$results_ = $dsql->dsqlOper($sql_, "results");
			if($results_){
				foreach ($results_ as $key_ => $value_) {
					$return[$i]['GroupId'] = $value['id'];
					$return[$i]['GroupName'] = $value['typename'];
					$return[$i]['Text'] = $value_['title'];
					$return[$i]['Value'] = $value_['id'];
					$i++;
				}
			}
		}
	}else{
		$i = 0;
		$sql_ = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__car_list` WHERE `brand` = ".$brand." ORDER BY `weight` DESC, `id` DESC");
		$results_ = $dsql->dsqlOper($sql_, "results");
		if($results_){
			foreach ($results_ as $key_ => $value_) {
				$return[$i]['GroupId'] = $value['id'];
				$return[$i]['GroupName'] = $value['typename'];
				$return[$i]['Text'] = $value_['title'];
				$return[$i]['Value'] = $value_['id'];
				$i++;
			}
		}
	}
	echo json_encode($return);
	die;

//选择车身颜色
}elseif($dopost == "getColor"){
	$return = array();
	$sql = $dsql->SetQuery("SELECT `color` FROM `#@__car_list` WHERE `id` = $carid");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		$color = $results[0]['color'];
		$color = explode("###", $color);
		foreach ($color as $key => $value) {
			$value = explode("||", $value);
			$return[$key]['pic'] = $value[0];
			$return[$key]['text'] = $value[1];
			$return[$key]['color'] = $value[2];
		}
	}
	echo json_encode($return);
	die;

//选择车身颜色（此处是车型的配置的颜色）
}elseif($dopost == "getSubColor"){
	$return = array();
	$sql = $dsql->SetQuery("SELECT `color` FROM `#@__car_param` WHERE `id` = $pid");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		$color = $results[0]['color'];
		$color = explode(",", $color);
		$i = 0;
		foreach ($color as $key => $value) {
			$value = explode("||", $value);

			$sql = $dsql->SetQuery("SELECT `color` FROM `#@__car_list` WHERE `id` = $cid");
			$results = $dsql->dsqlOper($sql, "results");
			if($results){
				$color = $results[0]['color'];
				$color = explode("###", $color);
				foreach ($color as $k => $val) {
					$val = explode("||", $val);
					if($val[2] == $value[1]){
						$return[$i]['pic'] = $val[0];
					}
				}
				$return[$i]['text'] = $value[0];
				$return[$i]['color'] = $value[1];
				$i++;
			}
		}
	}
	echo json_encode($return);
	die;

//选择年款
}elseif($dopost == "getYear"){
	$return = array();
	$sql = $dsql->SetQuery("SELECT `year` FROM `#@__car_param` WHERE `cid` = $carid");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		foreach ($results as $key => $value) {
			if(!in_array($value['year'], $return)){
				$return[] = $value['year'];
			}
		}
	}
	echo json_encode($return);
	die;

//选择车型
}elseif($dopost == "getParam"){
	$return = array();
	$sql = $dsql->SetQuery("SELECT `id`, `title`, `year` FROM `#@__car_param` WHERE `cid` = $cid");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		foreach ($results as $key => $value) {
			$return[$key]['GroupName'] = $value['year'];
			$return[$key]['Text'] = $value['title'];
			$return[$key]['Value'] = $value['id'];
		}
	}
	echo json_encode($return);
	die;

//获取车型官方价
}elseif($dopost == "getParamPrice"){
	$sql = $dsql->SetQuery("SELECT `guide` FROM `#@__car_param` WHERE `id` = $pid");
	$results = $dsql->dsqlOper($sql, "results");
	if($results){
		echo $results[0]['guide'];
	}
	die;
}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	require_once(HUONIAOINC."/config/car.inc.php");
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('brandid', 0);
	$huoniaoTag->assign('brandName', "请选择品牌");
	$huoniaoTag->assign('cid', 0);
	$huoniaoTag->assign('cname', "请选择车系");
	
	if($dopost != ""){

		$huoniaoTag->assign('colorParam', '[]');

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);
			$huoniaoTag->assign('cid', $cid);
			//车辆名称
			$carSql = $dsql->SetQuery("SELECT `title`, `brand` FROM `#@__car_list` WHERE `id` = ". $cid);
			$carResult = $dsql->getTypeName($carSql);
			$huoniaoTag->assign('cname', $carResult[0]["title"]);
			$huoniaoTag->assign('brandid', $carResult[0]["brand"]);
			//品牌名称
			$brandSql = $dsql->SetQuery("SELECT `parentid`, `typename` FROM `#@__car_brand` WHERE `id` = ". $carResult[0]["brand"]);
			$brandResult = $dsql->getTypeName($brandSql);
			if($brandResult[0]["parentid"] != 0){
				$huoniaoTag->assign('brandid', $brandResult[0]["parentid"]);
				$brandSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_brand` WHERE `id` = ". $brandResult[0]["parentid"]);
				$brandResult = $dsql->getTypeName($brandSql);
				$huoniaoTag->assign('brandName', $brandResult[0]["typename"]);
			}else{
				$huoniaoTag->assign('brandName', $brandResult[0]["typename"]);
			}


			$huoniaoTag->assign('year', $year);
			$huoniaoTag->assign('gearbox', $gearbox);
			$huoniaoTag->assign('displacement', $displacement);
			$huoniaoTag->assign('listedDate', !empty($listedDate) ? date("Y-m-d", $listedDate) : "");
			$huoniaoTag->assign('title', $title);
			$huoniaoTag->assign('guide', $guide);
			$huoniaoTag->assign('warranty', $warranty);
			$huoniaoTag->assign('speed', $speed == 0 ? "" : $speed);
			$huoniaoTag->assign('occupant', $occupant == 0 ? "" : $occupant);
			$huoniaoTag->assign('color', $color);
			$huoniaoTag->assign('long', $long == 0 ? "" : $long);
			$huoniaoTag->assign('width', $width == 0 ? "" : $width);
			$huoniaoTag->assign('height', $height == 0 ? "" : $height);
			$huoniaoTag->assign('wheelbase', $wheelbase == 0 ? "" : $wheelbase);
			$huoniaoTag->assign('ftrack', $ftrack == 0 ? "" : $ftrack);
			$huoniaoTag->assign('btrack', $btrack == 0 ? "" : $btrack);
			$huoniaoTag->assign('curbweight', $curbweight == 0 ? "" : $curbweight);
			$huoniaoTag->assign('fullweight', $fullweight == 0 ? "" : $fullweight);
			$huoniaoTag->assign('clearance', $clearance == 0 ? "" : $clearance);
			$huoniaoTag->assign('approach', $approach == 0 ? "" : $approach);
			$huoniaoTag->assign('departure', $departure == 0 ? "" : $departure);
			$huoniaoTag->assign('luggage', $luggage == 0 ? "" : $luggage);
			$huoniaoTag->assign('gopentype', $gopentype);
			$huoniaoTag->assign('opentype', $opentype);
			$huoniaoTag->assign('doors', $doors == 0 ? "" : $doors);
			$huoniaoTag->assign('enginepos', $enginepos);
			$huoniaoTag->assign('enginemod', $enginemod);
			$huoniaoTag->assign('displacementMl', $displacementMl == 0 ? "" : $displacementMl);
			$huoniaoTag->assign('intake', $intake);
			$huoniaoTag->assign('cylindertype', $cylindertype);
			$huoniaoTag->assign('cylinder', $cylinder == 0 ? "" : $cylinder);
			$huoniaoTag->assign('valvecount', $valvecount == 0 ? "" : $valvecount);
			$huoniaoTag->assign('valvestructure', $valvestructure);
			$huoniaoTag->assign('compression', $compression == 0 ? "" : $compression);
			$huoniaoTag->assign('bore', $bore == 0 ? "" : $bore);
			$huoniaoTag->assign('stroke', $stroke == 0 ? "" : $stroke);
			$huoniaoTag->assign('horsepower', $horsepower == 0 ? "" : $horsepower);
			$huoniaoTag->assign('power', $power == 0 ? "" : $power);
			$huoniaoTag->assign('powerspeed', $powerspeed);
			$huoniaoTag->assign('torque', $torque == 0 ? "" : $torque);
			$huoniaoTag->assign('torquespeed', $torquespeed);
			$huoniaoTag->assign('specific', $specific);
			$huoniaoTag->assign('fuelgrade', $fuelgrade == 0 ? "" : $fuelgrade);
			$huoniaoTag->assign('oilway', $oilway);
			$huoniaoTag->assign('fueltank', $fueltank == 0 ? "" : $fueltank);
			$huoniaoTag->assign('headmaterial', $headmaterial);
			$huoniaoTag->assign('cylindermaterial', $cylindermaterial);
			$huoniaoTag->assign('environmental', $environmental);
			$huoniaoTag->assign('blockcount', $blockcount == 0 ? "" : $blockcount);
			$huoniaoTag->assign('structure', $structure);
			$huoniaoTag->assign('turnradius', $turnradius == 0 ? "" : $turnradius);
			$huoniaoTag->assign('steering', $steering);
			$huoniaoTag->assign('fbraketype', $fbraketype);
			$huoniaoTag->assign('rbraketype', $rbraketype);
			$huoniaoTag->assign('pbraketype', $pbraketype);
			$huoniaoTag->assign('fsuspensiontype', $fsuspensiontype);
			$huoniaoTag->assign('bsuspensiontype', $bsuspensiontype);
			$huoniaoTag->assign('frontire', $frontire);
			$huoniaoTag->assign('reartire', $reartire);
			$huoniaoTag->assign('fwheelhub', $fwheelhub);
			$huoniaoTag->assign('bwheelhub', $bwheelhub);
			$huoniaoTag->assign('sparetire', $sparetire);
			$huoniaoTag->assign('hubmaterial', $hubmaterial);
			$huoniaoTag->assign('electricw', $electricw);
			$huoniaoTag->assign('uv', $uv);
			$huoniaoTag->assign('wpinch', $wpinch);
			$huoniaoTag->assign('skylightmode', $skylightmode);
			$huoniaoTag->assign('skylighttype', $skylighttype);
			$huoniaoTag->assign('headlamp', $headlamp);
			$huoniaoTag->assign('daytimerunlights', $daytimerunlights);
			$huoniaoTag->assign('swheeladjustmethod', $swheeladjustmethod);
			$huoniaoTag->assign('swheelsurface', $swheelsurface);
			$huoniaoTag->assign('interiorcolors', $interiorcolors);
			$huoniaoTag->assign('vehiclepowervoltage', $vehiclepowervoltage == 0 ? "" : $vehiclepowervoltage);
			$huoniaoTag->assign('seatmaterial', $seatmaterial);
			$huoniaoTag->assign('seatadjust', $seatadjust);
			$huoniaoTag->assign('pseatadjust', $pseatadjust);
			$huoniaoTag->assign('seatheating', $seatheating);
			$huoniaoTag->assign('externalinterface', $externalinterface);
			$huoniaoTag->assign('audiobrand', $audiobrand);
			$huoniaoTag->assign('dvd', $dvd == 0 ? "" : $dvd);
			$huoniaoTag->assign('cd', $cd == 0 ? "" : $cd);
			$huoniaoTag->assign('aircontrol', $aircontrol);
		}
	
		$huoniaoTag->assign('saletype', (int)$saletype);
		$huoniaoTag->assign('roofrack', (int)$roofrack);
		$huoniaoTag->assign('spoaro', (int)$spoaro);
		$huoniaoTag->assign('ossystem', (int)$ossystem);		
		$huoniaoTag->assign('shiftpaddles', (int)$shiftpaddles);
		$huoniaoTag->assign('airsuspension', (int)$airsuspension);
		$huoniaoTag->assign('adjustable', (int)$adjustable);
		$huoniaoTag->assign('driverairbags', (int)$driverairbags);
		$huoniaoTag->assign('copilotairbag', (int)$copilotairbag);
		$huoniaoTag->assign('fairbags', (int)$fairbags);
		$huoniaoTag->assign('fhairbags', (int)$fhairbags);
		$huoniaoTag->assign('kneeairbag', (int)$kneeairbag);
		$huoniaoTag->assign('rairbags', (int)$rairbags);
		$huoniaoTag->assign('rhairbags', (int)$rhairbags);
		$huoniaoTag->assign('seatips', (int)$seatips);
		$huoniaoTag->assign('seatforce', (int)$seatforce);
		$huoniaoTag->assign('seatprete', (int)$seatprete);
		$huoniaoTag->assign('seatadjus', $seatadjus);
		$huoniaoTag->assign('rseat', (int)$rseat);
		$huoniaoTag->assign('tirepressure', (int)$tirepressure);
		$huoniaoTag->assign('locking', (int)$locking);
		$huoniaoTag->assign('centrallocking', (int)$centrallocking);
		$huoniaoTag->assign('remotekey', (int)$remotekey);
		$huoniaoTag->assign('keylessstart', (int)$keylessstart);
		$huoniaoTag->assign('eantiengine', (int)$eantiengine);
		$huoniaoTag->assign('abs', (int)$abs);
		$huoniaoTag->assign('ebd', (int)$ebd);
		$huoniaoTag->assign('brakeassist', (int)$brakeassist);
		$huoniaoTag->assign('traction', (int)$traction);
		$huoniaoTag->assign('esp', (int)$esp);
		$huoniaoTag->assign('eps', (int)$eps);
		$huoniaoTag->assign('apark', (int)$apark);
		$huoniaoTag->assign('hillassist', (int)$hillassist);
		$huoniaoTag->assign('descent', (int)$descent);
		$huoniaoTag->assign('parkradar', (int)$parkradar);
		$huoniaoTag->assign('reversradar', (int)$reversradar);
		$huoniaoTag->assign('reverseimage', (int)$reverseimage);
		$huoniaoTag->assign('panoramicamera', (int)$panoramicamera);
		$huoniaoTag->assign('cruise', (int)$cruise);
		$huoniaoTag->assign('adaptivecruise', (int)$adaptivecruise);
		$huoniaoTag->assign('gps', (int)$gps);
		$huoniaoTag->assign('interactive', (int)$interactive);
		$huoniaoTag->assign('autopark', (int)$autopark);
		$huoniaoTag->assign('activebrake', (int)$activebrake);
		$huoniaoTag->assign('nightvision', (int)$nightvision);
		$huoniaoTag->assign('blindspot', (int)$blindspot);
		$huoniaoTag->assign('rsunshade', (int)$rsunshade);
		$huoniaoTag->assign('rssunshade', (int)$rssunshade);
		$huoniaoTag->assign('awipers', (int)$awipers);
		$huoniaoTag->assign('swipers', (int)$swipers);
		$huoniaoTag->assign('mirrorsturnsignals', (int)$mirrorsturnsignals);
		$huoniaoTag->assign('omirrormemory', (int)$omirrormemory);
		$huoniaoTag->assign('emirrorheat', (int)$emirrorheat);
		$huoniaoTag->assign('emirrorfold', (int)$emirrorfold);
		$huoniaoTag->assign('emirroradju', (int)$emirroradju);
		$huoniaoTag->assign('irmirrordimm', (int)$irmirrordimm);
		$huoniaoTag->assign('visormirror', (int)$visormirror);
		$huoniaoTag->assign('headlightsautosc', (int)$headlightsautosc);
		$huoniaoTag->assign('headlampautocf', (int)$headlampautocf);
		$huoniaoTag->assign('headlightswds', (int)$headlightswds);
		$huoniaoTag->assign('headlamprange', (int)$headlamprange);
		$huoniaoTag->assign('frontfoglights', (int)$frontfoglights);
		$huoniaoTag->assign('breadlamp', (int)$breadlamp);
		$huoniaoTag->assign('areadlamp', (int)$areadlamp);
		$huoniaoTag->assign('ambientlight', (int)$ambientlight);
		$huoniaoTag->assign('ledtail', (int)$ledtail);
		$huoniaoTag->assign('highbrekelight', (int)$highbrekelight);
		$huoniaoTag->assign('assistlamp', (int)$assistlamp);
		$huoniaoTag->assign('luggagelamp', (int)$luggagelamp);
		$huoniaoTag->assign('swheelbfadjust', (int)$swheelbfadjust);
		$huoniaoTag->assign('swheeludadjust', (int)$swheeludadjust);
		$huoniaoTag->assign('multiswheel', (int)$multiswheel);
		$huoniaoTag->assign('computerdisplay', (int)$computerdisplay);
		$huoniaoTag->assign('rearcupholder', (int)$rearcupholder);
		$huoniaoTag->assign('sportseats', (int)$sportseats);
		$huoniaoTag->assign('lumbarsupportadjust', (int)$lumbarsupportadjust);
		$huoniaoTag->assign('shouldsupportadjust', (int)$shouldsupportadjust);
		$huoniaoTag->assign('fcenterarmrest', (int)$fcenterarmrest);
		$huoniaoTag->assign('acenterarmrest', (int)$acenterarmrest);
		$huoniaoTag->assign('seatventilation', (int)$seatventilation);
		$huoniaoTag->assign('seatmassage', (int)$seatmassage);
		$huoniaoTag->assign('seatmemory', (int)$seatmemory);
		$huoniaoTag->assign('childsafety', (int)$childsafety);
		$huoniaoTag->assign('thirdseats', (int)$thirdseats);
		$huoniaoTag->assign('carphone', (int)$carphone);
		$huoniaoTag->assign('bluetooth', (int)$bluetooth);
		$huoniaoTag->assign('builtdrive', (int)$builtdrive);
		$huoniaoTag->assign('cartv', (int)$cartv);
		$huoniaoTag->assign('speakers', (int)$speakers);
		$huoniaoTag->assign('cclcd', (int)$cclcd);
		$huoniaoTag->assign('rlcd', (int)$rlcd);
		$huoniaoTag->assign('tempercontrol', (int)$tempercontrol);
		$huoniaoTag->assign('rearindeaircond', (int)$rearindeaircond);
		$huoniaoTag->assign('adischargeoutlet', (int)$adischargeoutlet);
		$huoniaoTag->assign('pollenfilter', (int)$pollenfilter);
		$huoniaoTag->assign('refrigerator', (int)$refrigerator);
		
		//变速箱
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 4 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('gearboxList', $list);
		$huoniaoTag->assign('gearbox', $gearbox == "" ? 0 : $gearbox);

		//驱动
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 6 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('driverList', $list);
		$huoniaoTag->assign('driver', $driver == "" ? 0 : $driver);

		//燃料
		$archives = $dsql->SetQuery("SELECT * FROM `#@__car_item` WHERE `parentid` = 7 ORDER BY `weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array(0 => '请选择');
		foreach($results as $value){
			$list[$value['id']] = $value['typename'];
		}
		$huoniaoTag->assign('fuelList', $list);
		$huoniaoTag->assign('fuel', $fuel == "" ? 0 : $fuel);

		//销售状态
		$huoniaoTag->assign('saletypeopt', array('0', '1', '2'));
		$huoniaoTag->assign('saletypenames',array('在售','停售','未上市'));
		
		//车门数
		$huoniaoTag->assign('doorsopt', array('0', '1', '2'));
		$huoniaoTag->assign('doorsnames',array('● 标配','○ 选配','- 无'));
		
		//车顶行李厢架
		$huoniaoTag->assign('roofrackopt', array('0', '1', '2'));
		$huoniaoTag->assign('roofracknames',array('● 标配','○ 选配','- 无'));
		
		//运动包围
		$huoniaoTag->assign('spoaroopt', array('0', '1', '2'));
		$huoniaoTag->assign('spoaronames',array('● 标配','○ 选配','- 无'));

		//启停系统
		$huoniaoTag->assign('ossystemopt', array('0', '1', '2'));
		$huoniaoTag->assign('ossystemnames',array('● 标配','○ 选配','- 无'));

		//换挡拨片
		$huoniaoTag->assign('shiftpaddlesopt', array('0', '1', '2'));
		$huoniaoTag->assign('shiftpaddlesnames',array('● 标配','○ 选配','- 无'));

		//空气悬挂
		$huoniaoTag->assign('airsuspensionopt', array('0', '1', '2'));
		$huoniaoTag->assign('airsuspensionnames',array('● 标配','○ 选配','- 无'));

		//可调悬挂
		$huoniaoTag->assign('adjustableopt', array('0', '1', '2'));
		$huoniaoTag->assign('adjustablenames',array('● 标配','○ 选配','- 无'));

		//驾驶位安全气囊
		$huoniaoTag->assign('driverairbagsopt', array('0', '1', '2'));
		$huoniaoTag->assign('driverairbagsnames',array('● 标配','○ 选配','- 无'));

		//副驾驶位安全气囊
		$huoniaoTag->assign('copilotairbagopt', array('0', '1', '2'));
		$huoniaoTag->assign('copilotairbagnames',array('● 标配','○ 选配','- 无'));

		//前排侧安全气囊
		$huoniaoTag->assign('fairbagsopt', array('0', '1', '2'));
		$huoniaoTag->assign('fairbagsnames',array('● 标配','○ 选配','- 无'));

		//前排头部气囊
		$huoniaoTag->assign('fhairbagsopt', array('0', '1', '2'));
		$huoniaoTag->assign('fhairbagsnames',array('● 标配','○ 选配','- 无'));

		//膝部气囊
		$huoniaoTag->assign('kneeairbagopt', array('0', '1', '2'));
		$huoniaoTag->assign('kneeairbagnames',array('● 标配','○ 选配','- 无'));

		//后排侧安全气囊
		$huoniaoTag->assign('rairbagsopt', array('0', '1', '2'));
		$huoniaoTag->assign('rairbagsnames',array('● 标配','○ 选配','- 无'));

		//后排头部气囊
		$huoniaoTag->assign('rhairbagsopt', array('0', '1', '2'));
		$huoniaoTag->assign('rhairbagsnames',array('● 标配','○ 选配','- 无'));

		//安全带未系提示
		$huoniaoTag->assign('seatipsopt', array('0', '1', '2'));
		$huoniaoTag->assign('seatipsnames',array('● 标配','○ 选配','- 无'));

		//安全带限力功能
		$huoniaoTag->assign('seatforceopt', array('0', '1', '2'));
		$huoniaoTag->assign('seatforcenames',array('● 标配','○ 选配','- 无'));

		//安全带预收紧功能
		$huoniaoTag->assign('seatpreteopt', array('0', '1', '2'));
		$huoniaoTag->assign('seatpretenames',array('● 标配','○ 选配','- 无'));

		//后排安全带
		$huoniaoTag->assign('rseatopt', array('0', '1', '2'));
		$huoniaoTag->assign('rseatnames',array('● 标配','○ 选配','- 无'));

		//胎压监测装置
		$huoniaoTag->assign('tirepressureopt', array('0', '1', '2'));
		$huoniaoTag->assign('tirepressurenames',array('● 标配','○ 选配','- 无'));

		//车内中控锁
		$huoniaoTag->assign('lockingopt', array('0', '1', '2'));
		$huoniaoTag->assign('lockingnames',array('● 标配','○ 选配','- 无'));

		//中控门锁
		$huoniaoTag->assign('centrallockingopt', array('0', '1', '2'));
		$huoniaoTag->assign('centrallockingnames',array('● 标配','○ 选配','- 无'));

		//遥控钥匙
		$huoniaoTag->assign('remotekeyopt', array('0', '1', '2'));
		$huoniaoTag->assign('remotekeynames',array('● 标配','○ 选配','- 无'));

		//无钥匙启动系统
		$huoniaoTag->assign('keylessstartopt', array('0', '1', '2'));
		$huoniaoTag->assign('keylessstartnames',array('● 标配','○ 选配','- 无'));

		//发动机电子防盗
		$huoniaoTag->assign('eantiengineopt', array('0', '1', '2'));
		$huoniaoTag->assign('eantienginenames',array('● 标配','○ 选配','- 无'));

		//刹车防抱死(ABS)
		$huoniaoTag->assign('absopt', array('0', '1', '2'));
		$huoniaoTag->assign('absnames',array('● 标配','○ 选配','- 无'));

		//电子制动力分配系统(EBD)
		$huoniaoTag->assign('ebdopt', array('0', '1', '2'));
		$huoniaoTag->assign('ebdnames',array('● 标配','○ 选配','- 无'));

		//刹车辅助(EBA/BAS/BA/EVA等)
		$huoniaoTag->assign('brakeassistopt', array('0', '1', '2'));
		$huoniaoTag->assign('brakeassistnames',array('● 标配','○ 选配','- 无'));

		//牵引力控制(ASR/TCS/TRC/ATC等)
		$huoniaoTag->assign('tractionopt', array('0', '1', '2'));
		$huoniaoTag->assign('tractionnames',array('● 标配','○ 选配','- 无'));

		//动态稳定控制系统（ESP）
		$huoniaoTag->assign('espopt', array('0', '1', '2'));
		$huoniaoTag->assign('espnames',array('● 标配','○ 选配','- 无'));

		//随速助力转向调节(EPS)
		$huoniaoTag->assign('epsopt', array('0', '1', '2'));
		$huoniaoTag->assign('epsnames',array('● 标配','○ 选配','- 无'));

		//自动驻车
		$huoniaoTag->assign('aparkopt', array('0', '1', '2'));
		$huoniaoTag->assign('aparknames',array('● 标配','○ 选配','- 无'));

		//上坡辅助
		$huoniaoTag->assign('hillassistopt', array('0', '1', '2'));
		$huoniaoTag->assign('hillassistnames',array('● 标配','○ 选配','- 无'));

		//陡坡缓降
		$huoniaoTag->assign('descentopt', array('0', '1', '2'));
		$huoniaoTag->assign('descentnames',array('● 标配','○ 选配','- 无'));

		//泊车雷达
		$huoniaoTag->assign('parkradaropt', array('0', '1', '2'));
		$huoniaoTag->assign('parkradarnames',array('● 标配','○ 选配','- 无'));

		//倒车雷达
		$huoniaoTag->assign('reversradaropt', array('0', '1', '2'));
		$huoniaoTag->assign('reversradarnames',array('● 标配','○ 选配','- 无'));

		//倒车影像
		$huoniaoTag->assign('reverseimageopt', array('0', '1', '2'));
		$huoniaoTag->assign('reverseimagenames',array('● 标配','○ 选配','- 无'));

		//全景摄像头
		$huoniaoTag->assign('panoramicameraopt', array('0', '1', '2'));
		$huoniaoTag->assign('panoramicameranames',array('● 标配','○ 选配','- 无'));

		//定速巡航
		$huoniaoTag->assign('cruiseopt', array('0', '1', '2'));
		$huoniaoTag->assign('cruisenames',array('● 标配','○ 选配','- 无'));

		//自适应巡航
		$huoniaoTag->assign('adaptivecruiseopt', array('0', '1', '2'));
		$huoniaoTag->assign('adaptivecruisenames',array('● 标配','○ 选配','- 无'));

		//GPS导航系统
		$huoniaoTag->assign('gpsopt', array('0', '1', '2'));
		$huoniaoTag->assign('gpsnames',array('● 标配','○ 选配','- 无'));

		//人机交互系统
		$huoniaoTag->assign('interactiveopt', array('0', '1', '2'));
		$huoniaoTag->assign('interactivenames',array('● 标配','○ 选配','- 无'));

		//自动泊车入位
		$huoniaoTag->assign('autoparkopt', array('0', '1', '2'));
		$huoniaoTag->assign('autoparknames',array('● 标配','○ 选配','- 无'));

		//主动刹车/主动安全系统
		$huoniaoTag->assign('activebrakeopt', array('0', '1', '2'));
		$huoniaoTag->assign('activebrakenames',array('● 标配','○ 选配','- 无'));

		//夜视系统
		$huoniaoTag->assign('nightvisionopt', array('0', '1', '2'));
		$huoniaoTag->assign('nightvisionnames',array('● 标配','○ 选配','- 无'));

		//盲点检测
		$huoniaoTag->assign('blindspotopt', array('0', '1', '2'));
		$huoniaoTag->assign('blindspotnames',array('● 标配','○ 选配','- 无'));

		//后窗遮阳帘
		$huoniaoTag->assign('rsunshadeopt', array('0', '1', '2'));
		$huoniaoTag->assign('rsunshadenames',array('● 标配','○ 选配','- 无'));

		//后排侧遮阳帘
		$huoniaoTag->assign('rssunshadeopt', array('0', '1', '2'));
		$huoniaoTag->assign('rssunshadenames',array('● 标配','○ 选配','- 无'));

		//后雨刷器
		$huoniaoTag->assign('awipersopt', array('0', '1', '2'));
		$huoniaoTag->assign('awipersnames',array('● 标配','○ 选配','- 无'));

		//感应雨刷
		$huoniaoTag->assign('swipersopt', array('0', '1', '2'));
		$huoniaoTag->assign('swipersnames',array('● 标配','○ 选配','- 无'));

		//后视镜带侧转向灯
		$huoniaoTag->assign('mirrorsturnsignalsopt', array('0', '1', '2'));
		$huoniaoTag->assign('mirrorsturnsignalsnames',array('● 标配','○ 选配','- 无'));

		//外后视镜记忆功能
		$huoniaoTag->assign('omirrormemoryopt', array('0', '1', '2'));
		$huoniaoTag->assign('omirrormemorynames',array('● 标配','○ 选配','- 无'));

		//外后视镜加热功能
		$huoniaoTag->assign('emirrorheatopt', array('0', '1', '2'));
		$huoniaoTag->assign('emirrorheatnames',array('● 标配','○ 选配','- 无'));

		//外后视镜电动折叠功能
		$huoniaoTag->assign('emirrorfoldopt', array('0', '1', '2'));
		$huoniaoTag->assign('emirrorfoldnames',array('● 标配','○ 选配','- 无'));

		//外后视镜电动调节
		$huoniaoTag->assign('emirroradjuopt', array('0', '1', '2'));
		$huoniaoTag->assign('emirroradjunames',array('● 标配','○ 选配','- 无'));

		//内后视镜防眩目功能
		$huoniaoTag->assign('irmirrordimmopt', array('0', '1', '2'));
		$huoniaoTag->assign('irmirrordimmnames',array('● 标配','○ 选配','- 无'));

		//遮阳板化妆镜
		$huoniaoTag->assign('visormirroropt', array('0', '1', '2'));
		$huoniaoTag->assign('visormirrornames',array('● 标配','○ 选配','- 无'));

		//前大灯自动开闭
		$huoniaoTag->assign('headlightsautoscopt', array('0', '1', '2'));
		$huoniaoTag->assign('headlightsautoscnames',array('● 标配','○ 选配','- 无'));

		//前照灯自动清洗功能
		$huoniaoTag->assign('headlampautocfopt', array('0', '1', '2'));
		$huoniaoTag->assign('headlampautocfnames',array('● 标配','○ 选配','- 无'));

		//前大灯随动转向
		$huoniaoTag->assign('headlightswdsopt', array('0', '1', '2'));
		$huoniaoTag->assign('headlightswdsnames',array('● 标配','○ 选配','- 无'));

		//前照灯照射范围调整
		$huoniaoTag->assign('headlamprangeopt', array('0', '1', '2'));
		$huoniaoTag->assign('headlamprangenames',array('● 标配','○ 选配','- 无'));

		//前雾灯
		$huoniaoTag->assign('frontfoglightsopt', array('0', '1', '2'));
		$huoniaoTag->assign('frontfoglightsnames',array('● 标配','○ 选配','- 无'));

		//车厢前阅读灯
		$huoniaoTag->assign('breadlampopt', array('0', '1', '2'));
		$huoniaoTag->assign('breadlampnames',array('● 标配','○ 选配','- 无'));

		//车厢后阅读灯
		$huoniaoTag->assign('areadlampopt', array('0', '1', '2'));
		$huoniaoTag->assign('areadlampnames',array('● 标配','○ 选配','- 无'));

		//车内氛围灯
		$huoniaoTag->assign('ambientlightopt', array('0', '1', '2'));
		$huoniaoTag->assign('ambientlightnames',array('● 标配','○ 选配','- 无'));

		//日间行车灯
		$huoniaoTag->assign('daytimerunlightsopt', array('0', '1', '2'));
		$huoniaoTag->assign('daytimerunlightsnames',array('● 标配','○ 选配','- 无'));

		//LED尾灯
		$huoniaoTag->assign('ledtailopt', array('0', '1', '2'));
		$huoniaoTag->assign('ledtailnames',array('● 标配','○ 选配','- 无'));

		//高位（第三）制动灯
		$huoniaoTag->assign('highbrekelightopt', array('0', '1', '2'));
		$huoniaoTag->assign('highbrekelightnames',array('● 标配','○ 选配','- 无'));

		//转向头灯（辅助灯）
		$huoniaoTag->assign('assistlampopt', array('0', '1', '2'));
		$huoniaoTag->assign('assistlampnames',array('● 标配','○ 选配','- 无'));

		//行李厢灯
		$huoniaoTag->assign('luggagelampopt', array('0', '1', '2'));
		$huoniaoTag->assign('luggagelampnames',array('● 标配','○ 选配','- 无'));

		//方向盘前后调节
		$huoniaoTag->assign('swheelbfadjustopt', array('0', '1', '2'));
		$huoniaoTag->assign('swheelbfadjustnames',array('● 标配','○ 选配','- 无'));

		//方向盘上下调节
		$huoniaoTag->assign('swheeludadjustopt', array('0', '1', '2'));
		$huoniaoTag->assign('swheeludadjustnames',array('● 标配','○ 选配','- 无'));

		//多功能方向盘
		$huoniaoTag->assign('multiswheelopt', array('0', '1', '2'));
		$huoniaoTag->assign('multiswheelnames',array('● 标配','○ 选配','- 无'));

		//行车电脑显示屏
		$huoniaoTag->assign('computerdisplayopt', array('0', '1', '2'));
		$huoniaoTag->assign('computerdisplaynames',array('● 标配','○ 选配','- 无'));

		//后排杯架
		$huoniaoTag->assign('rearcupholderopt', array('0', '1', '2'));
		$huoniaoTag->assign('rearcupholdernames',array('● 标配','○ 选配','- 无'));

		//运动座椅
		$huoniaoTag->assign('sportseatsopt', array('0', '1', '2'));
		$huoniaoTag->assign('sportseatsnames',array('● 标配','○ 选配','- 无'));

		//驾驶座腰部支撑调节
		$huoniaoTag->assign('lumbarsupportadjustopt', array('0', '1', '2'));
		$huoniaoTag->assign('lumbarsupportadjustnames',array('● 标配','○ 选配','- 无'));

		//驾驶座肩部支撑调节
		$huoniaoTag->assign('shouldsupportadjustopt', array('0', '1', '2'));
		$huoniaoTag->assign('shouldsupportadjustnames',array('● 标配','○ 选配','- 无'));

		//前座中央扶手
		$huoniaoTag->assign('fcenterarmrestopt', array('0', '1', '2'));
		$huoniaoTag->assign('fcenterarmrestnames',array('● 标配','○ 选配','- 无'));

		//后座中央扶手
		$huoniaoTag->assign('acenterarmrestopt', array('0', '1', '2'));
		$huoniaoTag->assign('acenterarmrestnames',array('● 标配','○ 选配','- 无'));

		//座椅通风
		$huoniaoTag->assign('seatventilationopt', array('0', '1', '2'));
		$huoniaoTag->assign('seatventilationnames',array('● 标配','○ 选配','- 无'));

		//座椅按摩功能
		$huoniaoTag->assign('seatmassageopt', array('0', '1', '2'));
		$huoniaoTag->assign('seatmassagenames',array('● 标配','○ 选配','- 无'));

		//电动座椅记忆
		$huoniaoTag->assign('seatmemoryopt', array('0', '1', '2'));
		$huoniaoTag->assign('seatmemorynames',array('● 标配','○ 选配','- 无'));

		//儿童安全座椅固定装置
		$huoniaoTag->assign('childsafetyopt', array('0', '1', '2'));
		$huoniaoTag->assign('childsafetynames',array('● 标配','○ 选配','- 无'));

		//第三排座椅
		$huoniaoTag->assign('thirdseatsopt', array('0', '1', '2'));
		$huoniaoTag->assign('thirdseatsnames',array('● 标配','○ 选配','- 无'));

		//车载电话
		$huoniaoTag->assign('carphoneopt', array('0', '1', '2'));
		$huoniaoTag->assign('carphonenames',array('● 标配','○ 选配','- 无'));

		//蓝牙系统
		$huoniaoTag->assign('bluetoothopt', array('0', '1', '2'));
		$huoniaoTag->assign('bluetoothnames',array('● 标配','○ 选配','- 无'));

		//内置硬盘
		$huoniaoTag->assign('builtdriveopt', array('0', '1', '2'));
		$huoniaoTag->assign('builtdrivenames',array('● 标配','○ 选配','- 无'));

		//车载电视
		$huoniaoTag->assign('cartvopt', array('0', '1', '2'));
		$huoniaoTag->assign('cartvnames',array('● 标配','○ 选配','- 无'));

		//扬声器数量
		$huoniaoTag->assign('speakersopt', array('0', '1', '2'));
		$huoniaoTag->assign('speakersnames',array('● 标配','○ 选配','- 无'));

		//dvd
		$huoniaoTag->assign('dvdopt', array('0', '1', '2'));
		$huoniaoTag->assign('dvdnames',array('● 标配','○ 选配','- 无'));

		//cd
		$huoniaoTag->assign('cdopt', array('0', '1', '2'));
		$huoniaoTag->assign('cdnames',array('● 标配','○ 选配','- 无'));

		//中控台液晶屏
		$huoniaoTag->assign('cclcdopt', array('0', '1', '2'));
		$huoniaoTag->assign('cclcdnames',array('● 标配','○ 选配','- 无'));

		//后排液晶屏
		$huoniaoTag->assign('rlcdopt', array('0', '1', '2'));
		$huoniaoTag->assign('rlcdnames',array('● 标配','○ 选配','- 无'));

		//温度分区控制
		$huoniaoTag->assign('tempercontrolopt', array('0', '1', '2'));
		$huoniaoTag->assign('tempercontrolnames',array('● 标配','○ 选配','- 无'));

		//后排独立空调
		$huoniaoTag->assign('rearindeaircondopt', array('0', '1', '2'));
		$huoniaoTag->assign('rearindeaircondnames',array('● 标配','○ 选配','- 无'));

		//后排出风口
		$huoniaoTag->assign('adischargeoutletopt', array('0', '1', '2'));
		$huoniaoTag->assign('adischargeoutletnames',array('● 标配','○ 选配','- 无'));

		//空气调节/花粉过滤
		$huoniaoTag->assign('pollenfilteropt', array('0', '1', '2'));
		$huoniaoTag->assign('pollenfilternames',array('● 标配','○ 选配','- 无'));

		//车载冰箱
		$huoniaoTag->assign('refrigeratoropt', array('0', '1', '2'));
		$huoniaoTag->assign('refrigeratornames',array('● 标配','○ 选配','- 无'));
	}
	$huoniaoTag->assign('brandTypeList', json_encode($dsql->getTypeList(0, "car_brand")));
	
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
	
	$archives = $dsql->SetQuery("SELECT `guide` FROM `#@__".$tab."` WHERE `cid` = ".$cid);
	$results = $dsql->dsqlOper($archives, "results");
	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			array_push($prices, $value['guide']);
		}
	}

	$max = array_search(max($prices), $prices);
	$min = array_search(min($prices), $prices);
	
	$archives = $dsql->SetQuery("UPDATE `#@__car_list` SET `minprice` = '".$prices[$min]."', `maxprice` = '".$prices[$max]."' WHERE `id` = ".$cid);
	$dsql->dsqlOper($archives, "update");
}