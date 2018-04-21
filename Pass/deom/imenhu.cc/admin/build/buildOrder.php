<?php
/**
 * 管理建材商品订单
 *
 * @version        $Id: buildOrder.php 2016-5-4 上午11:51:15 $
 * @package        HuoNiao.Build
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "..");
require_once(dirname(__FILE__)."/../inc/config.inc.php");
checkPurview("buildOrder");
$dsql = new dsql($dbo);
$tpl = dirname(__FILE__)."/../templates/build";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "buildOrder.html";

$action = "build_order";

if($dopost == "getList"){
	$pagestep = $pagestep == "" ? 10 : $pagestep;
	$page     = $page == "" ? 1 : $page;

	$where = "";

	if($sKeyword != ""){

		$where .= " AND `ordernum` like '%$sKeyword%' OR `people` like '%$sKeyword%' OR `contact` like '%$sKeyword%' OR `address` like '%$sKeyword%'";

		//商品
		$proSql = $dsql->SetQuery("SELECT pp.`orderid` FROM `#@__build_product` p LEFT JOIN `#@__build_order_product` pp ON pp.`proid` = p.`id` WHERE p.`title` like '%$sKeyword%'");
		$proResult = $dsql->dsqlOper($proSql, "results");
		if($proResult){
			$orderid = array();
			foreach($proResult as $key => $pro){
				array_push($orderid, $pro['orderid']);
			}
			if(!empty($orderid)){
				$where .= " OR `id` in (".join(",", $orderid).")";
			}
		}

		//个人会员
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` like '%$sKeyword%' OR `nickname` like '%$sKeyword%'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where .= " OR `userid` in (".join(",", $userid).")";
			}
		}

		//商家会员
		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `username` like '%$sKeyword%' OR `nickname` like '%$sKeyword%' OR `company` like '%$sKeyword%'");
		$userResult = $dsql->dsqlOper($userSql, "results");
		if($userResult){
			$userid = array();
			foreach($userResult as $key => $user){
				array_push($userid, $user['id']);
			}
			if(!empty($userid)){
				$where .= " OR `store` in (".join(",", $userid).")";
			}
		}

	}

	if($start != ""){
		$where .= " AND `orderdate` >= ". GetMkTime($start." 00:00:00");
	}

	if($end != ""){
		$where .= " AND `orderdate` <= ". GetMkTime($end." 23:59:59");
	}

	$archives = $dsql->SetQuery("SELECT `id` FROM `#@__".$action."` WHERE 1 = 1".$where);

	//总条数
	$totalCount = $dsql->dsqlOper($archives.$where, "totalCount");
	//总分页数
	$totalPage = ceil($totalCount/$pagestep);
	//未付款
	$state0 = $dsql->dsqlOper($archives." AND `orderstate` = 0", "totalCount");
	//未使用
	$state1 = $dsql->dsqlOper($archives." AND `orderstate` = 1", "totalCount");
	//成功
	$state3 = $dsql->dsqlOper($archives." AND `orderstate` = 3", "totalCount");
	//已退款
	$state4 = $dsql->dsqlOper($archives." AND `ret-state` = 1", "totalCount");
	//已发货
	$state6 = $dsql->dsqlOper($archives." AND `orderstate` = 6 AND `exp-date` != 0", "totalCount");
	//过期
	$state7 = $dsql->dsqlOper($archives." AND `orderstate` = 7", "totalCount");
	//交易关闭
	$state10 = $dsql->dsqlOper($archives." AND `orderstate` = 10", "totalCount");


	if($state != ""){
		if($state != "" && $state != 4 && $state != 5 && $state != 6){
			$where = " AND `orderstate` = " . $state;
		}

		//退款
		if($state == 4){
			$where = " AND `ret-state` = 1";
		}

		//已发货
		if($state == 6){
			$where = " AND `orderstate` = 6 AND `exp-date` != 0";
		}

		if($state == 0){
			$totalPage = ceil($state0/$pagestep);
		}elseif($state == 1){
			$totalPage = ceil($state1/$pagestep);
		}elseif($state == 3){
			$totalPage = ceil($state3/$pagestep);
		}elseif($state == 4){
			$totalPage = ceil($state4/$pagestep);
		}elseif($state == 6){
			$totalPage = ceil($state6/$pagestep);
		}elseif($state == 7){
			$totalPage = ceil($state7/$pagestep);
		}elseif($state == 10){
			$totalPage = ceil($state10/$pagestep);
		}
	}

	$where .= " order by `id` desc";

	$atpage = $pagestep*($page-1);
	$where .= " LIMIT $atpage, $pagestep";
	$archives = $dsql->SetQuery("SELECT `id`, `ordernum`, `store`, `userid`, `orderstate`, `orderdate`, `paytype`, `ret-state` FROM `#@__".$action."` WHERE 1 = 1".$where);
	$results = $dsql->dsqlOper($archives, "results");

	if(count($results) > 0){
		$list = array();
		foreach ($results as $key=>$value) {
			$list[$key]["id"] = $value["id"];
			$list[$key]["ordernum"] = $value["ordernum"];
			$list[$key]["userid"] = $value["userid"];

			//用户名
			$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["userid"]);
			$username = $dsql->dsqlOper($userSql, "results");
			if(count($username) > 0){
				$list[$key]["username"] = $username[0]['username'];
			}else{
				$list[$key]["username"] = "未知";
			}

			$list[$key]["storeid"] = $value["store"];

			//商家
			$userSql = $dsql->SetQuery("SELECT `title` FROM `#@__build_store` WHERE `id` = ". $value["store"]);
			$store = $dsql->dsqlOper($userSql, "results");
			if(count($store) > 0){
				$param = array(
					"service"  => "build",
					"template" => "store-detail",
					"id"       => $value['store']
				);
				$list[$key]["storeUrl"] = getUrlPath($param);
				$list[$key]["store"] = $store[0]['title'];
			}else{
				$list[$key]["storeUrl"] = "javascript:;";
				$list[$key]["store"] = "未知";
			}

			//订单金额
			$orderprice = 0;
			$sql = $dsql->SetQuery("SELECT `price`, `count`, `logistic` FROM `#@__".$action."_product` WHERE `orderid` = ".$value['id']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				foreach ($ret as $k => $v) {
					$orderprice += $v['price'] * $v['count'] + $v['logistic'];
				}
			}
			$list[$key]["orderprice"] = sprintf("%.2f", $orderprice);


			$list[$key]["orderstate"] = $value["orderstate"];
			$list[$key]["orderdate"] = date('Y-m-d H:i:s', $value["orderdate"]);

			//主表信息
			$sql = $dsql->SetQuery("SELECT `pay_name` FROM `#@__site_payment` WHERE `pay_code` = '".$value["paytype"]."'");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!empty($ret)){
				$list[$key]["paytype"] = $ret[0]['pay_name'];
			}else{
				$list[$key]["paytype"] = $value["paytype"];
			}

			$list[$key]['retState'] = $value['ret-state'];
		}

		if(count($list) > 0){
			echo '{"state": 100, "info": '.json_encode("获取成功").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state1": '.$state1.', "state3": '.$state3.', "state4": '.$state4.', "state6": '.$state6.', "state7": '.$state7.', "state10": '.$state10.'}, "buildOrder": '.json_encode($list).'}';
		}else{
			echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state1": '.$state1.', "state3": '.$state3.', "state4": '.$state4.', "state6": '.$state6.', "state7": '.$state7.', "state10": '.$state10.'}}';
		}

	}else{
		echo '{"state": 101, "info": '.json_encode("暂无相关信息").', "pageInfo": {"totalPage": '.$totalPage.', "totalCount": '.$totalCount.', "state0": '.$state0.', "state1": '.$state1.', "state3": '.$state3.', "state4": '.$state4.', "state6": '.$state6.', "state7": '.$state7.', "state10": '.$state10.'}}';
	}
	die;

//删除
}elseif($dopost == "del"){
	if(!testPurview("buildOrderDel")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	if($id == "") die;
	$each = explode(",", $id);
	$error = array();
	foreach($each as $val){
		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."` WHERE `id` = ".$val);
		$results = $dsql->dsqlOper($archives, "update");
		if($results != "ok"){
			$error[] = $val;
		}

		$archives = $dsql->SetQuery("DELETE FROM `#@__".$action."_product` WHERE `orderid` = ".$val);
		$dsql->dsqlOper($archives, "update");
	}
	if(!empty($error)){
		echo '{"state": 200, "info": '.json_encode($error).'}';
	}else{
		adminLog("删除建材订单", $id);
		echo '{"state": 100, "info": '.json_encode("删除成功！").'}';
	}
	die;


//付款
/**
	* 付款业务逻辑
	* 1. 验证订单状态，只有状态为未付款时才可以往下进行
	* 2. 验证订单中的商品：1. 订单中含有不存在或已经下架的商品
	*                    2. 订单中的商品库存不足
	* 3. 会员账户余额，不足需要先到会员管理页面充值
	* 4. 上面三种都通过之后就可以进行支付成功后的操作：
	* 5. 更新订单的支付方式
	* 6. 更新订单中商品的已售数量、库存（包括不同规格的库存）
	* 7. 扣除会员账户余额并做相关记录
	* 8. 更新订单状态为已付款
	* 9. 后续操作（如：发送短信通知等）
	*/
}elseif($dopost == "payment"){
	if(!testPurview("buildOrderEdit")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	if(!empty($id)){
		$archives = $dsql->SetQuery("SELECT `ordernum`, `userid`, `orderstate` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if($results){
			$ordernum = $results[0]['ordernum'];
			$userid = $results[0]["userid"];
			$orderstate = $results[0]["orderstate"];

			if($orderstate == 0){

				$orderprice = 0;
				$opArr = array();

				//订单商品
				$sql = $dsql->SetQuery("SELECT `id`, `proid`, `price`, `count`, `logistic`, `discount` FROM `#@__build_order_product` WHERE `orderid` = ".$id);
				$res = $dsql->dsqlOper($sql, "results");
				if($res){

					foreach ($res as $key => $value) {

						$opid      = $value['id'];
						$proid     = $value['proid'];
						$price     = $value['price'];
						$count     = $value['count'];
						$logistic  = $value['logistic'];
						$discount  = $value['discount'];

						global $handler;
						$handler = true;
						$detailHandels = new handlers("build", "detail");
						$detailConfig  = $detailHandels->getHandle($proid);
						if(is_array($detailConfig) && $detailConfig['state'] == 100){
							$detail  = $detailConfig['info'];
							if(is_array($detail)){

								//验证商品库存
								$inventor = $detail['inventory'];

								if($inventor < $count && $inventor != 0) {
									echo '{"state": 200, "info": '.json_encode('【'.$detail['title'].'  '.$specation.'】库存不足').'}';
									die;
								}

								$oprice = $price * $count + $logistic + $discount;
								$orderprice += $oprice;

								array_push($opArr, array(
									"id"    => $opid,
									"proid" => $proid,
									"count" => $count,
									"price" => $oprice
								));


							}else{
								echo '{"state": 200, "info": '.json_encode("商品不存在，付款失败！").'}';
								die;
							}
						}else{
							echo '{"state": 200, "info": '.json_encode("商品不存在，付款失败！").'}';
							die;
						}

					}


					//会员信息
					$userSql = $dsql->SetQuery("SELECT `money` FROM `#@__member` WHERE `id` = ". $userid);
					$userResult = $dsql->dsqlOper($userSql, "results");

					if($userResult){

						if($userResult[0]['money'] > $orderprice){

							//更新订单支付方式
							$sql = $dsql->SetQuery("UPDATE `#@__build_order` SET `paytype` = '管理员支付' WHERE `id` = ".$id);
							$dsql->dsqlOper($sql, "update");


							//更新商品信息
							foreach ($opArr as $key => $value) {

								$_id    = $value['id'];
								$_proid = $value['proid'];
								$_count = $value['count'];
								$_price = $value['price'];

								//更新订单实付金额
								$sql = $dsql->SetQuery("UPDATE `#@__build_order_product` SET `point` = 0, `balance` = 0, `payprice` = '$_price' WHERE `id` = ".$_id);
								$dsql->dsqlOper($sql, "update");

								//更新已购买数量
								$sql = $dsql->SetQuery("UPDATE `#@__build_product` SET `sales` = `sales` + $_count, `inventory` = `inventory` - $_count WHERE `id` = ".$_proid);
								$dsql->dsqlOper($sql, "update");

							}



							//扣除会员帐户
							$userOpera = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - $orderprice WHERE `id` = ". $userid);
							$dsql->dsqlOper($userOpera, "update");

							//记录消费日志
							$logs = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `amount`, `type`, `info`, `date`) VALUES (".$userid.", ".$orderprice.", 0, '建材消费：".$ordernum."', ".GetMkTime(time()).")");
							$dsql->dsqlOper($logs, "update");

							//更新订单状态
							$orderOpera = $dsql->SetQuery("UPDATE `#@__".$action."` SET `orderstate` = 1, `paydate` = ".GetMkTime(time())." WHERE `id` = ". $id);
							$dsql->dsqlOper($orderOpera, "update");

							adminLog("为会员手动支付建材订单", $ordernum);

							echo '{"state": 100, "info": '.json_encode("付款成功！").'}';
							die;

						}else{
							echo '{"state": 200, "info": '.json_encode("会员帐户余额不足，请先进行充值！").'}';
							die;
						}

					}else{
						echo '{"state": 200, "info": '.json_encode("会员不存在，无法继续支付！").'}';
						die;
					}


				}

			}else{
				echo '{"state": 200, "info": '.json_encode("此订单不是未付款状态，请确认后操作！").'}';
				die;
			}
		}else{
			echo '{"state": 200, "info": '.json_encode("订单不存在，请刷新页面！").'}';
			die;
		}

	}else{
		echo '{"state": 200, "info": '.json_encode("订单ID为空，操作失败！").'}';
		die;
	}
	die;


//退款
/**
	* 退款业务逻辑
	* 1. 验证订单状态，只有状态为已付款、申请退款、已发货时才可以往下进行
	* 2. 计算需要退回的余额及积分
	* 3. 更新会员余额及积分并做相关记录
	* 4. 更新订单中商品的已售数量、库存（包括不同规格的库存）
	* 5. 更新订单状态为已退款
	* 6. 后续操作（如：发送短信通知等）
	*/
}elseif($dopost == "refund"){
	if(!testPurview("buildOrderEdit")){
		die('{"state": 200, "info": '.json_encode('对不起，您无权使用此功能！').'}');
	}
	if(!empty($id)){
		$archives = $dsql->SetQuery("SELECT `ordernum`, `userid`, `orderstate` FROM `#@__".$action."` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if($results){

			$ordernum   = $results[0]['ordernum'];
			$userid     = $results[0]["userid"];
			$orderstate = $results[0]["orderstate"];

			if($orderstate == 1 || $orderstate == 4 || $orderstate == 6){

				//计算需要退回的积分及余额
				$totalPoint = 0;
				$totalMoney = 0;

				$opArr = array();

				$sql = $dsql->SetQuery("SELECT `proid`, `count`, `point`, `balance`, `payprice` FROM `#@__build_order_product` WHERE `orderid` = ".$id);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					foreach ($ret as $key => $value) {
						$totalPoint += $value['point'];
						$totalMoney += $value['balance'] + $value['payprice'];

						array_push($opArr, array(
							"proid" => $value['proid'],
							"count" => $value['count']
						));
					}
				}


				//会员信息
				$userSql = $dsql->SetQuery("SELECT `money` FROM `#@__member` WHERE `id` = ". $userid);
				$userResult = $dsql->dsqlOper($userSql, "results");

				if($userResult){

					//退回积分
					if(!empty($totalPoint)){
						$archives = $dsql->SetQuery("UPDATE `#@__member` SET `point` = `point` + '$totalPoint' WHERE `id` = '$userid'");
						$dsql->dsqlOper($archives, "update");

						//保存操作日志
						$archives = $dsql->SetQuery("INSERT INTO `#@__member_point` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '1', '$totalPoint', '建材订单退回：$ordernum', ".GetMkTime(time()).")");
						$dsql->dsqlOper($archives, "update");
					}

					//会员帐户充值
					if($totalMoney > 0){
						$userOpera = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + ".$totalMoney." WHERE `id` = ". $userid);
						$dsql->dsqlOper($userOpera, "update");

						//记录退款日志
						$logs = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `amount`, `type`, `info`, `date`) VALUES (".$userid.", ".$totalMoney.", 1, '建材订单退款：".$ordernum."', ".GetMkTime(time()).")");
						$dsql->dsqlOper($logs, "update");
					}

					//更新订单状态
					$orderOpera = $dsql->SetQuery("UPDATE `#@__".$action."` SET `orderstate` = 7, `ret-state` = 0, `ret-ok-date` = ".GetMkTime(time())." WHERE `id` = ". $id);
					$dsql->dsqlOper($orderOpera, "update");


					//更新商品已售数量及库存
					foreach ($opArr as $key => $value) {

						$_proid = $value['proid'];
						$_count = $value['count'];

						//更新已购买数量
						$sql = $dsql->SetQuery("UPDATE `#@__build_product` SET `sales` = `sales` - $_count, `inventory` = `inventory` + $_count WHERE `id` = ".$_proid);
						$dsql->dsqlOper($sql, "update");

					}



					echo '{"state": 100, "info": '.json_encode("操作成功，款项已退还至会员帐户！").'}';
					die;

				}else{
					echo '{"state": 200, "info": '.json_encode("会员不存在，无法继续退款！").'}';
					die;
				}

			}else{
				echo '{"state": 200, "info": '.json_encode("订单当前状态不支持手动退款！").'}';
				die;
			}
		}else{
			echo '{"state": 200, "info": '.json_encode("订单不存在，请刷新页面！").'}';
			die;
		}

	}else{
		echo '{"state": 200, "info": '.json_encode("订单ID为空，操作失败！").'}';
		die;
	}


}

//验证模板文件
if(file_exists($tpl."/".$templates)){

	//js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/bootstrap-datetimepicker.min.js',
		'admin/build/buildOrder.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->compile_dir = HUONIAOROOT."/templates_c/admin/build";  //设置编译目录
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
