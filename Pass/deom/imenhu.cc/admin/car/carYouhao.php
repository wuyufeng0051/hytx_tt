<?php
/**
 * 汽车油耗管理
 *
 * @version        $Id: carYouhao.php 2014-9-2 上午10:42:11 $
 * @package        HuoNiao.Car
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("carYouhao");
$dsql  = new dsql($dbo);
$tpl   = dirname(__FILE__)."/../templates/car";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$tab = "car_youhao";

if($dopost != ""){
	$templates = "carYouhaoAdd.html";
	
	//js
	$jsFile = array(
		'admin/car/carYouhaoAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}else{
	$templates = "carYouhao.html";
	
	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui-selectable.js',
		'admin/car/carYouhao.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));
}

if($submit == "提交"){
	if($token == "") die('token传递失败！');
	$pubdate = GetMkTime(time());       //发布时间
	
	//二次验证
	if(empty($pid)){
		echo '{"state": 200, "info": "请选择车型"}';
		exit();
	}
	
	if(empty($addr)){
		echo '{"state": 200, "info": "请选择所在地区"}';
		exit();
	}

	if(empty($fuel)){
		echo '{"state": 200, "info": "请输入油耗"}';
		exit();
	}
}

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;
	
	$where = "";
	
	if(!empty($pid)){
		$where .= " AND `pid` = ".$pid;
	}
	
	if(!empty($addr)){
		$where .= " AND `addr` = ".$addr;
	}
	
	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE 1 = 1");

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	
	$where .= " order by `id` desc";
	
	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `uid`, `pid`, `addr`, `fuel`, `isair`, `condition`, `pubdate` FROM `#@__".$tab."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["uid"] = $value["uid"];

			//会员信息
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["uid"]);
			$userResult = $dsql->getTypeName($userSql);
			$list[$key]["username"] = $userResult[0]['username'];

			$list[$key]["title"] = $value["title"];
			$list[$key]["pid"] = $value["pid"];

			//所属车系
			$pSql = $dsql->SetQuery("SELECT `cid`, `title` FROM `#@__car_param` WHERE `id` = ". $value["pid"]);
			$pResult = $dsql->getTypeName($pSql);
			$list[$key]["paramName"] = $pResult[0]['title'];

			//所属车型
			$list[$key]["cid"] = $pResult[0]['cid'];
			$cSql = $dsql->SetQuery("SELECT `title` FROM `#@__car_list` WHERE `id` = ". $pResult[0]["cid"]);
			$cResult = $dsql->getTypeName($cSql);
			$list[$key]["cName"] = $cResult[0]['title'];

			$addrSql = $dsql->SetQuery("SELECT `typename` FROM `#@__car_addr` WHERE `id` = ". $value["addr"]);
			$addrResult = $dsql->getTypeName($addrSql);
			$list[$key]["addr"] = $addrResult[0]['typename'];

			$list[$key]["fuel"] = $value["fuel"];
			$list[$key]["isair"] = $value["isair"] ? "开" : "关";

			$condition = "";
			switch ($value['condition']) {
				case '0':
					$condition = "综合";
					break;
				case '1':
					$condition = "市区";
					break;
				case '2':
					$condition = "郊区";
					break;
				case '3':
					$condition = "高速";
					break;
			}
			$list[$key]["condition"] = $condition;
			$list[$key]["pubdate"] = date('Y-m-d H:i:s', $value["pubdate"]);
		}
		
		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}, "carYouhao": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
		}
		
	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.'}}';
	}
	die;
	
//新增
}elseif($dopost == "Add"){
	checkPurview("carYouhaoAdd");

	$pagetitle = "新增汽车油耗";
	
	//表单提交
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`uid`, `pid`, `addr`, `fuel`, `isair`, `condition`, `pubdate`) VALUES ('$uid', '$pid', '$addr', '$fuel', '$isair', '$condition', '$pubdate')");
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("新增汽车油耗");
			echo '{"state": 100, "info": '.json_encode("添加成功！").'}';
		}else{
			echo $return;
		}
		die;
	}

//修改
}elseif($dopost == "edit"){
	checkPurview("carYouhaoEdit");
	
	$pagetitle = "修改汽车油耗";
	
	if($id == "") die('要修改的信息ID传递失败！');
	if($submit == "提交"){
		
		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `uid` = '$uid', `pid` = '$pid', `addr` = '$addr', `fuel` = '$fuel', `isair` = '$isair', `condition` = '$condition' WHERE `id` = ".$id);
		$return = $dsql->dsqlOper($archives, "update");
		
		if($return == "ok"){
			adminLog("修改汽车油耗");
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
				
				$uid       = $results[0]['uid'];
				$pid       = $results[0]['pid'];
				$addr      = $results[0]['addr'];
				$fuel      = $results[0]['fuel'];
				$isair     = $results[0]['isair'];
				$condition = $results[0]['condition'];
				
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
	if(!testPurview("carYouhaoDel")){
		die('{"state": 200, "info": '.json_encode("对不起，您无权使用此功能！").'}');
	};
	if($id != ""){
		
		//删除表
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$tab."` WHERE `id` in (".$id.")");
		$results = $dsql->dsqlOper($archives, "update");

		adminLog("删除汽车油耗");
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
		die;
		
	}
	die;

}

//验证模板文件
if(file_exists($tpl."/".$templates)){
	
	$huoniaoTag->assign('pagetitle', $pagetitle);
	$huoniaoTag->assign('dopost', $dopost);
	$huoniaoTag->assign('brandid', 0);
	$huoniaoTag->assign('brandName', "请选择品牌");
	$huoniaoTag->assign('cid', 0);
	$huoniaoTag->assign('cname', "请选择车系");
	$huoniaoTag->assign('pid', 0);
	$huoniaoTag->assign('pname', "请选择车型");
	$huoniaoTag->assign('addr', 0);

	$addrList = $addrVal = array();
	$addrSql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__car_addr` WHERE `parentid` = 0 ORDER BY `weight` ASC");
	$addrResult = $dsql->getTypeName($addrSql);
	if($addrResult){
		foreach($addrResult as $value){
			$addrList[$value['id']] = $value['typename'];
		}
	}
	$huoniaoTag->assign('addrList', $addrList);
	
	if($dopost != ""){

		if($dopost == "edit"){
			$huoniaoTag->assign('id', $id);
			$huoniaoTag->assign('uid', $uid);

			//会员
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $uid);
			$username = $dsql->getTypeName($userSql);
			$username = $username[0]['username'];
			$huoniaoTag->assign('username', $username);

			//车型名称
			$huoniaoTag->assign('pid', $pid);
			$pSql = $dsql->SetQuery("SELECT `cid`, `title` FROM `#@__car_param` WHERE `id` = ". $pid);
			$pResult = $dsql->getTypeName($pSql);
			$huoniaoTag->assign('pname', $pResult[0]["title"]);

			$huoniaoTag->assign('cid', $pResult[0]["cid"]);
			//车辆名称
			$carSql = $dsql->SetQuery("SELECT `title`, `brand` FROM `#@__car_list` WHERE `id` = ". $pResult[0]["cid"]);
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

			$huoniaoTag->assign('fuel', $fuel);
		}

	}

	$huoniaoTag->assign('addr', (int)$addr);

	//空调
	$huoniaoTag->assign('isairopt', array('0', '1'));
	$huoniaoTag->assign('isairnames',array('关','开'));

	//路况
	$huoniaoTag->assign('conditionList', array(0 => '综合', 1 => '市区', 2 => '郊区', 3 => '高速'));

	$huoniaoTag->assign('isair', $isair == "" ? 0 : $isair);
	$huoniaoTag->assign('condition', $condition == "" ? 0 : $condition);
	
	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/car";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}