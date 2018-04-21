<?php

/**
 * huoniaoTag模板标签函数插件-商城模块
 *
 * @param $params array 参数集
 * @return array
 */
function shop($params, $content = "", &$smarty = array(), &$repeat = array()){
	$service = "shop";
	extract ($params);
	if(empty($action)) return '';

	global $huoniaoTag;
	global $dsql;
	global $userLogin;
	global $cfg_basehost;

	$userid = $userLogin->getMemberID();
	$furl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);


	//品牌库
	if($action == "brand"){

		$typeid = (int)$typeid;
		$huoniaoTag->assign("typeid", $typeid);

		//类型
		$seo_title = "商城";
		if(!empty($typeid)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__shop_brandtype` WHERE `id` = $typeid");
			$res = $dsql->dsqlOper($sql, "results");
			if($res){
				$seo_title = $res[0]['typename'];
			}
		}
		$huoniaoTag->assign('seo_title', $seo_title);


	//品牌详细
	}elseif($action == "brand-detail"){

		$id = (int)$id;
		if($id){
			$sql = $dsql->SetQuery("SELECT `title` FROM `#@__shop_brand` WHERE `id` = $id");
			$res = $dsql->dsqlOper($sql, "results");
			if($res){

				//品牌名
				$seo_title = $res[0]['title'];
				$huoniaoTag->assign('id', $id);
				$huoniaoTag->assign('seo_title', $seo_title);

				//分类
				$typename = "";
				$typeid = (int)$typeid;
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__shop_type` WHERE `id` = $typeid");
				$res = $dsql->dsqlOper($sql, "results");
				if($res){
					$typename = $res[0]['typename'];
				}
				$huoniaoTag->assign('typeid', $typeid);
				$huoniaoTag->assign('typename', $typename);

				//分页
				$page = (int)$page;
				$atpage = $page == 0 ? 1 : $page;
				global $page;
				$page = $atpage;
				$huoniaoTag->assign('page', $page);

				//排序
				$orderby = (int)$orderby;
				$huoniaoTag->assign('orderby', $orderby);

			}else{
				header("location:http://".$cfg_basehost."/404.html");
			}
		}else{
			header("location:http://".$cfg_basehost."/404.html");
		}
		return;


	//商家店铺
	}elseif($action == "store"){

		$typeid   = (int)$typeid;
		$addrid   = (int)$addrid;
		$business = (int)$business;
		$orderby  = (int)$orderby;
		$page     = (int)$page;

		$huoniaoTag->assign('typeid', $typeid);
		$huoniaoTag->assign('addrid', $addrid);
		$huoniaoTag->assign('business', $business);
		$huoniaoTag->assign('orderby', $orderby);
		$huoniaoTag->assign('page', $page);


	//店铺详细
	}elseif($action == "store-detail" || $action == "storeDetail"){

		$detailHandels = new handlers($service, "storeDetail");
		$detailConfig  = $detailHandels->getHandle($id);
		$state = 0;

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//更新浏览次数
				$sql = $dsql->SetQuery("UPDATE `#@__shop_store` SET `click` = `click` + 1 WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "results");

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}
				$state = 1;


				//分类
				$pid = $tid = $child = 0;
				$pname = $tname = "";
				$typeid = (int)$typeid;
				if($typeid){
					$sql = $dsql->SetQuery("SELECT `parentid`, `typename` FROM `#@__shop_category` WHERE `id` = $typeid");
					$res = $dsql->dsqlOper($sql, "results");
					if($res){
						//如果pid为0，代表当前ID就是一级
						if($res[0]['parentid'] == 0){
							$pid = $typeid;
							$pname = $res[0]['typename'];

							$sql = $dsql->SetQuery("SELECT `id` FROM `#@__shop_category` WHERE `parentid` = ".$pid);
							$child = $dsql->dsqlOper($sql, "totalCount");

						//如果pid不为0，代表当前ID为二级，需要查询一级分类名
						}else{
							$pid = $res[0]['parentid'];
							$tid = $typeid;
							$tname = $res[0]['typename'];
							$child = 1;

							$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__shop_category` WHERE `id` = ".$pid);
							$ret = $dsql->dsqlOper($sql, "results");
							if($ret){
								$pname = $ret[0]['typename'];
							}
						}
					}
				}
				$huoniaoTag->assign('typeid', $typeid);
				$huoniaoTag->assign('tid', $tid);     //二级ID
				$huoniaoTag->assign('tname', $tname); //二级名
				$huoniaoTag->assign('pid', $pid);     //一级ID
				$huoniaoTag->assign('pname', $pname); //一级名
				$huoniaoTag->assign('child', $child); //二级数量

				//分页
				$page = (int)$page;
				$atpage = $page == 0 ? 1 : $page;
				global $page;
				$page = $atpage;
				$huoniaoTag->assign('page', $page);

				//排序
				$orderby = (int)$orderby;
				$huoniaoTag->assign('orderby', $orderby);

				//关键字
				$huoniaoTag->assign('keywords', $keywords);

				//价格
				$priceArr = array();
				if(!empty($price)){
					$priceArr = explode(",", $price);
				}
				$huoniaoTag->assign('price', $priceArr);

			}
			$huoniaoTag->assign('storeState', $state);

		}else{
			if($action == "store-detail"){
				header("location:http://".$cfg_basehost."/404.html");
			}
		}
		return;


	//商品列表
	}elseif($action == "list"){

		$seo_title = array();

		//输出所有GET参数
		$pageParam = array();
		foreach($_GET as $key => $val){
			$huoniaoTag->assign($key, $val);
			if($key != "service" && $key != "template" && $key != "page"){
				array_push($pageParam, $key."=".$val);
			}
		}
		$huoniaoTag->assign("pageParam", join("&", $pageParam));

		//品牌名
		$brandName = "";
		if($brand){
			$sql = $dsql->SetQuery("SELECT `title` FROM `#@__shop_brand` WHERE `id` = ".$brand);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$brandName = $ret[0]['title'];
				array_push($seo_title, $brandName);
			}
		}
		$huoniaoTag->assign("brandName", $brandName);


		//子级分类
		$typeid = (int)$typeid;
		$huoniaoTag->assign("typeArr", $dsql->getTypeList($typeid, "shop_type", 0));


		//所有父级集合
		global $data;
		$data = "";
		$typeArr = getParentArr("shop_type", $typeid);
		$typeNameArr = array_reverse(parent_foreach($typeArr, "typename"));
		$data = "";
		$typeIdArr = array_reverse(parent_foreach($typeArr, "id"));
		$huoniaoTag->assign("typeNameArr", $typeNameArr);
		$huoniaoTag->assign("typeIdArr", $typeIdArr);
		array_push($seo_title, join("-", $typeNameArr));


		//属性
		$itemType = $itemVal = array();
		if(!empty($item)){
			$itemArr = explode(";", $item);
			foreach($itemArr as $key => $val){
				$vArr = explode(":", $val);
				array_push($itemType, $vArr[0]);
				array_push($itemVal, $vArr[1]);
			}
		}
		$huoniaoTag->assign("itemType", $itemType);
		$huoniaoTag->assign("itemVal", $itemVal);


		//规格
		$specificationType = $specificationVal = array();
		if(!empty($specification)){
			$specificationArr = explode(";", $specification);
			foreach($specificationArr as $key => $val){
				$vArr = explode(":", $val);
				array_push($specificationType, $vArr[0]);
				array_push($specificationVal, $vArr[1]);
			}
		}
		$huoniaoTag->assign("specificationType", $specificationType);
		$huoniaoTag->assign("specificationVal", $specificationVal);


		//分页
		$page = (int)$page;
		$atpage = $page == 0 ? 1 : $page;
		global $page;
		$page = $atpage;
		$huoniaoTag->assign('page', $page);

		//排序
		$orderby = (int)$orderby;
		$huoniaoTag->assign('orderby', $orderby);

		//关键字
		$huoniaoTag->assign('keywords', $keywords);

		//价格
		$priceArr = array();
		if(!empty($price)){
			$priceArr = explode(",", $price);
		}
		$huoniaoTag->assign('price', $priceArr);

		//属性
		$flagArr = explode(",", $flag);
		$newFlag = array();
		foreach ($flagArr as $key => $value) {
			if($value !== ""){
				array_push($newFlag, $value);
			}
		}
		$flag = join(",", $newFlag);
		$huoniaoTag->assign('flag', $flag);
		$huoniaoTag->assign('flagArr', $newFlag);

		$huoniaoTag->assign('seo_title', join("-", $seo_title));


	//商品详情
	}elseif ($action == "detail") {

		$detailHandels = new handlers($service, "detail");
		$detailConfig  = $detailHandels->getHandle($id);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				$sql = $dsql->SetQuery("UPDATE `#@__shop_product` SET `click` = `click` + 1 WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "update");

				global $detailArr;
				$detailArr = $detailConfig;

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}

			}
		}else{
			header("location:http://".$cfg_basehost."/404.html");
		}
		return;


	//购物车 && 确认订单
	}elseif($action == "cart" || $action == "confirm-order"){

		$detailHandels = new handlers($service, "getCartList");

		$d = $action == "confirm-order" ? $_POST['pros'] : "";  //区分购物车或确认下单页面
		$detailConfig  = $detailHandels->getHandle($d);

		$cartList = array();
		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				$i = 0;
				foreach($detailConfig as $k => $v){

					//是否已经存在
					$h = 0;
					foreach($cartList as $key => $value) {
						if($value['sid'] == $v['store']['id']){
							$h = 1;
						}
					}

					$data = array(
						"id"        => $v['id'],
						"specation" => $v['specation'],
						"count"     => $v['count'],
						"title"     => $v['title'],
						"thumb"     => $v['thumb'],
						"price"     => $v['price'],
						"limit"     => $v['limit'],
						"inventor"  => $v['inventor'],
						"volume"    => $v['volume'],
						"weight"    => $v['weight'],
						"logistic"  => $v['logistic'],
						"logisticTemp"  => $v['logisticTemp'],
						"logisticNote"  => $v['logisticNote'],
						"url"       => $v['url'],
						"speInfo"   => $v['speInfo']
					);

					//如果不存在则新建一级
					if(!$h){
						if($v['store']){
							$cartList[$i]['sid']    = $v['store']['id'];
							$cartList[$i]['store']  = $v['store']['title'];
							$cartList[$i]['domain'] = $v['store']['domain'];
							$cartList[$i]['qq']     = $v['store']['qq'];
						}else{
							$cartList[$i]['sid']  = 0;
							$cartList[$i]['store']  = '官方直营';
						}
						$cartList[$i]['list']   = array($data);
						$i++;
					}else{

						//如果已存在则push
						foreach ($cartList as $key => $value) {
							if($value['sid'] == $v['store']['id']){
								array_push($cartList[$key]['list'], $data);
							}
						}

					}

				}
			}
		}

		$huoniaoTag->assign('cartList', $cartList);

		//确认订单页面输出要下单的商品信息
		if($action == "confirm-order"){

			if($userid == -1 || empty($pros)){
				header("location:http://".$cfg_basehost);
				die;
			}

			$huoniaoTag->assign('pros', join("|", $pros));
			$huoniaoTag->assign('_token_', join("|", $pros));
		}
		return;


	//支付页面
	}elseif($action == "pay"){

		global $userLogin;
		$userid = $userLogin->getMemberID();

		if($userid == -1){
			header('location:http://'.$cfg_basehost.'/login.html?furl='.$furl);
			die;
		}

		$RenrenCrypt = new RenrenCrypt();
		$ordernums = $RenrenCrypt->php_decrypt(base64_decode($ordernum));

		if($ordernums){

			$sql = $dsql->SetQuery("SELECT * FROM `#@__shop_order` WHERE `ordernum` = '$ordernums'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$huoniaoTag->assign('ordernum', $ordernums);
				$order = $ret[0];

				if($order['orderstate'] == 0){

					//店铺信息
					$store = array(
						"sid" => 0,
						"store" => "官方直营"
					);
					if($order['store'] != 0){
						$storeHandels = new handlers($service, "storeDetail");
						$storeConfig  = $storeHandels->getHandle($order['store']);
						if(is_array($storeConfig) && $storeConfig['state'] == 100){
							$storeConfig  = $storeConfig['info'];
							if(is_array($storeConfig)){
								$store = array(
									"sid" => $order['store'],
									"store" => $storeConfig['title'],
									"domain" => $storeConfig['domain'],
									"qq" => $storeConfig['qq']
								);
							}
						}
					}
					$huoniaoTag->assign('store', $store);

					$huoniaoTag->assign('people', $order['people']);
					$huoniaoTag->assign('address', $order['address']);
					$huoniaoTag->assign('contact', $order['contact']);
					$huoniaoTag->assign('note', $order['note']);

					$list = array();
					$sql = $dsql->SetQuery("SELECT * FROM `#@__shop_order_product` WHERE `orderid` = ".$order['id']);
					$res = $dsql->dsqlOper($sql, "results");
					if($res){

						$p = 0;
						foreach ($res as $key => $value) {

							$detailHandels = new handlers($service, "detail");
							$detailConfig  = $detailHandels->getHandle($value['proid']);
							if(is_array($detailConfig) && $detailConfig['state'] == 100){
								$detailConfig  = $detailConfig['info'];
								if(is_array($detailConfig)){

									$list[$p]['id']        = $value['proid'];
									$list[$p]['specation'] = $value['specation'];
									$list[$p]['price']     = $value['price'];
									$list[$p]['count']     = $value['count'];
									$list[$p]['logistic']  = $value['logistic'];
									$list[$p]['discount']  = $value['discount'];
									$list[$p]['title']     = $detailConfig['title'];
									$list[$p]['thumb']     = $detailConfig['litpic'];
									$list[$p]['url']       = $detailConfig['url'];

									$p++;
								}
							}else{
								header('location:http://'.$cfg_basehost.'/404.html');
								die;
							}

						}

					}else{
						header('location:http://'.$cfg_basehost.'/404.html');
						die;
					}

					$huoniaoTag->assign('product', $list);

				//付过款的直接跳转到订单详情页
				}else{

					$param = array(
						"service"  => "member",
						"type"     => "user",
						"template" => "orderdetail",
						"module"   => "shop",
						"id"       => $order['id']
					);

					header('location:'.getUrlPath($param));
					die;

				}



			}else{
				header('location:http://'.$cfg_basehost.'/404.html');
				die;
			}

		}else{
			header('location:http://'.$cfg_basehost.'/404.html');
			die;
		}




	//支付结果页面
	}elseif($action == "payreturn"){

		global $userLogin;
		$userid = $userLogin->getMemberID();

		if($userid == -1){
			header('location:http://'.$cfg_basehost.'/login.html?furl='.$furl);
			die;
		}

		if(!empty($ordernum)){

			//根据支付订单号查询支付结果
			$archives = $dsql->SetQuery("SELECT `body`, `amount`, `state` FROM `#@__pay_log` WHERE `ordertype` = 'shop' AND `ordernum` = '$ordernum' AND `uid` = $userid");
			$payDetail  = $dsql->dsqlOper($archives, "results");
			if($payDetail){

				$state = $payDetail[0]['state'];

				if($state == 1){
					$orderListArr = array();
					$totalAmount = 0;
					$totalPoint = 0;
					$totalBalance = 0;
					$totalPayPrice = 0;
					$i = 0;
					$ids = explode(",", $payDetail[0]['body']);

					foreach ($ids as $key => $value) {

						//查询订单详细信息
						$archives = $dsql->SetQuery("SELECT `id`, `store`, `address`, `people`, `contact`, `note` FROM `#@__shop_order` WHERE `ordernum` = '$value' AND `userid` = $userid");
						$orderDetail  = $dsql->dsqlOper($archives, "results");
						if($orderDetail){
							$orderDetail = $orderDetail[0];

							//查询订单商品
							$sql = $dsql->SetQuery("SELECT `proid`, `specation`, `price`, `count`, `logistic`, `discount`, `point`, `balance`, `payprice` FROM `#@__shop_order_product` WHERE `orderid` = ".$orderDetail['id']);
							$ret = $dsql->dsqlOper($sql, "results");
							if($ret){

								$orderListArr[$i]['orderid']  = $orderDetail['id'];
								$orderListArr[$i]['ordernum'] = $value;

								//店铺信息
								$storeHandels = new handlers($service, "storeDetail");
								$storeConfig  = $storeHandels->getHandle($orderDetail['store']);
								if(is_array($storeConfig) && $storeConfig['state'] == 100){
									$storeConfig  = $storeConfig['info'];
									if(is_array($storeConfig)){

										$orderListArr[$i]['store'] = array(
											"id"     => $storeConfig['id'],
											"title"  => $storeConfig['title'],
											"domain" => $storeConfig['domain'],
											"qq"     => $storeConfig['qq']
										);

									}else{
										$orderListArr[$i]['store'] = array(
											"id"     => 0,
											"title"  => '官方直营'
										);
									}
								}else{
									$orderListArr[$i]['store'] = array(
										"id"     => 0,
										"title"  => '官方直营'
									);
								}


								//订单配送信息
								$orderListArr[$i]['address'] = $orderDetail['address'];
								$orderListArr[$i]['people']  = $orderDetail['people'];
								$orderListArr[$i]['contact'] = $orderDetail['contact'];
								$orderListArr[$i]['note']    = $orderDetail['note'];

								$proDetail = array();
								$p = 0;
								foreach($ret as $k => $v){

									//查询商品详细信息
									$detailHandels = new handlers($service, "detail");
									$detailConfig  = $detailHandels->getHandle($v['proid']);
									if(is_array($detailConfig) && $detailConfig['state'] == 100){
										$detailConfig  = $detailConfig['info'];
										if(is_array($detailConfig)){

											$proDetail[$p]['id']        = $detailConfig['id'];
											$proDetail[$p]['title']     = $detailConfig['title'];
											$proDetail[$p]['litpic']    = $detailConfig['litpic'];
											$proDetail[$p]['specation'] = $v['specation'];
											$proDetail[$p]['price']     = $v['price'];
											$proDetail[$p]['count']     = $v['count'];
											$proDetail[$p]['logistic']  = $v['logistic'];
											$proDetail[$p]['discount']  = $v['discount'];
											$proDetail[$p]['point']     = $v['point'];
											$proDetail[$p]['balance']   = $v['balance'];
											$proDetail[$p]['payprice']  = $v['payprice'];
											$p++;

											//单价 * 数量 + 运费 + 折扣
											$totalAmount += $v['price'] * $v['count'] + $v['logistic'] + $v['discount'];

											$totalPoint    += $v['point'];
											$totalBalance  += $v['balance'];
											$totalPayPrice += $v['payprice'];

										}
									}
								}

								$orderListArr[$i]['product'] = $proDetail;
								$i++;

							}

						}
					}

					$huoniaoTag->assign('orderListArr', $orderListArr);
					$huoniaoTag->assign('totalPoint', $totalPoint);
					$huoniaoTag->assign('totalBalance', sprintf("%.2f", $totalBalance));
					$huoniaoTag->assign('totalPayPrice', sprintf("%.2f", $totalPayPrice));
				}

				$huoniaoTag->assign('state', $state);


			//支付订单不存在
			}else{
				header("location:http://".$cfg_basehost);
				die;
			}

		}else{
			header("location:http://".$cfg_basehost);
			die;
		}


	//商城资讯列表
	}elseif($action == "news"){

		//分类
		$pid = $tid = $child = 0;
		$pname = $tname = "";
		$typeid = (int)$typeid;
		if($typeid){
			$sql = $dsql->SetQuery("SELECT `parentid`, `typename` FROM `#@__shop_news_type` WHERE `id` = $typeid");
			$res = $dsql->dsqlOper($sql, "results");
			if($res){
				//如果pid为0，代表当前ID就是一级
				if($res[0]['parentid'] == 0){
					$pid = $typeid;
					$pname = $res[0]['typename'];

					$sql = $dsql->SetQuery("SELECT `id` FROM `#@__shop_news_type` WHERE `parentid` = ".$pid);
					$child = $dsql->dsqlOper($sql, "totalCount");

				//如果pid不为0，代表当前ID为二级，需要查询一级分类名
				}else{
					$pid = $res[0]['parentid'];
					$tid = $typeid;
					$tname = $res[0]['typename'];
					$child = 1;

					$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__shop_news_type` WHERE `id` = ".$pid);
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						$pname = $ret[0]['typename'];
					}
				}
			}
		}
		$huoniaoTag->assign('typeid', $typeid);
		$huoniaoTag->assign('tid', $tid);     //二级ID
		$huoniaoTag->assign('tname', $tname); //二级名
		$huoniaoTag->assign('pid', $pid);     //一级ID
		$huoniaoTag->assign('pname', $pname); //一级名
		$huoniaoTag->assign('child', $child); //二级数量


	//资讯详细
	}elseif($action == "news-detail"){

		$detailHandels = new handlers($service, "newsDetail");
		$detailConfig  = $detailHandels->getHandle($id);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}

			}

		}else{
			header("location:http://".$cfg_basehost."/404.html");
		}
		return;


	//发布商品
	}elseif($action == "fabu"){

		//输出分类字段内容
		global $userLogin;
		$userid = $userLogin->getMemberID();

		global $detailArr;

		if($userid != -1 && (!empty($typeid) || $detailArr)){

			$store = 0;
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__shop_store` WHERE `userid` = ".$userid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$store = $ret[0]['id'];
			}else{
				header("location:http://".$cfg_basehost."/404.html");
				die;
			}

			//修改信息
			if($detailArr){
				$id     = $detailArr['id'];
				$typeid = $detailArr['type'];
				$brand  = $detailArr['brand'];
				$logistic = $detailArr['logisticId'];
				$property = $detailArr['propertyId'];
				$specifiList = $detailArr['specifiList'];

				$huoniaoTag->assign("typeid", $typeid);
			}

			//遍历所选分类名称，输出格式：分类名 > 分类名
			global $data;
			$data = "";
			$proType = getParentArr("shop_type", $typeid);
			$proType = array_reverse(parent_foreach($proType, "typename"));
			$huoniaoTag->assign('proType', join(" > ", $proType));

			//遍历所选分类ID
			global $data;
			$data = "";
			$proId = array_reverse(parent_foreach(getParentArr("shop_type", $typeid), "id"));
			$proId = array_slice($proId, 0, count($proType));

			//根据分类ID，获取分类属性值
			$itemid = 0;
			if(count($proId) > 0){
				foreach($proId as $key => $val){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__shop_item` WHERE `type` = ".$val);
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						$itemid = $val;
					}
				}
			}

			$huoniaoTag->assign("itemid", $itemid);

			//品牌Array
			$brandOption = array();
			array_push($brandOption, '<option value="">请选择</option>');
			$archives = $dsql->SetQuery("SELECT * FROM `#@__shop_brandtype` ORDER BY `weight`");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $key => $val){
					$archives_ = $dsql->SetQuery("SELECT * FROM `#@__shop_brand` WHERE `type` = ".$val['id']." ORDER BY `weight`");
					$results_ = $dsql->dsqlOper($archives_, "results");
					$branditem = array();
					if($results_){
						foreach($results_ as $key_ => $val_){
							$selected = "";
							if($val_['id'] == $brand){
								$selected = " selected";
							}
							array_push($branditem, '<option value="'.$val_['id'].'"'.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;|--'.$val_['title'].'</option>');
						}
						if(!empty($branditem)){
							array_push($brandOption, '<optgroup label="|--'.$val["typename"].'">');
							array_push($brandOption, join("", $branditem));
							array_push($brandOption, '</optgroup>');
						}
					}
				}
			}
			$huoniaoTag->assign('brandOption', join("", $brandOption));

			//商品分类Array
			if($store){
				$ids = array();
				if($id != ""){
					$archives = $dsql->SetQuery("SELECT `category` FROM `#@__shop_product` WHERE `id` = ".$id);
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						$ids = explode(",", $results[0]['category']);
					}
				}
				$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__shop_category` WHERE `type` = ".$store." AND `parentid` = 0 ORDER BY `weight`");
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					$cList = array('<option value="">请选择,支持多选</option>');
					foreach($results as $key => $val){
						$selected = "";
						if(in_array($val['id'], $ids)){
							$selected = " selected";
						}
						$archives_ = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__shop_category` WHERE `parentid` = ".$val['id']." ORDER BY `weight`");
						$results_ = $dsql->dsqlOper($archives_, "results");
						if($results_){
							array_push($cList, '<optgroup label="|--'.$val['typename'].'"></optgroup>');
							foreach($results_ as $key_ => $val_){
								$selected = "";
								if(in_array($val_['id'], $ids)){
									$selected = " selected";
								}
								array_push($cList, '<option value="'.$val_['id'].'"'.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;|--'.$val_['typename'].'</option>');
							}
						}else{
							array_push($cList, '<option value="'.$val['id'].'"'.$selected.'>|--'.$val['typename'].'</option>');
						}
					}
					if(!empty($cList)){
						$huoniaoTag->assign('storeTypeOption', join("", $cList));
					}
				}
			}



			//运费模板Array
			$logisticOption = array();
			array_push($logisticOption, '<option value="0">请选择运费模板</option>');
			$archives = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__shop_logistictemplate` WHERE `sid` = ".$store." ORDER BY `id` DESC");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $key => $val){
					$selected = "";
					if($val["id"] == $logistic){
						$selected = " selected";
					}
					array_push($logisticOption, '<option value="'.$val["id"].'"'.$selected.'>'.$val["title"].'</option>');
				}
			}
			$huoniaoTag->assign('logisticOption', join("", $logisticOption));

			$huoniaoTag->assign('proItemList', join("", getItemList($property, $itemid)));

			//根据分类ID，获取分类属性值
			$itemid1 = 0;
			if(count($proId) > 0){
				foreach($proId as $key => $val){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__shop_type` WHERE `spe` != '' AND `id` = ".$val);
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						$itemid1 = $val;
					}
				}
			}

			$speArr = getSpeList($specifiList, $itemid1);
			$huoniaoTag->assign('specification', join("", $speArr['specification']));
			$huoniaoTag->assign('specifiVal', json_encode($speArr['specifiVal']));

		}


	//运费模板详细
	}elseif($action == "logisticDetail"){

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			header('location:http://'.$cfg_basehost.'/login.html?furl='.$furl);
			die;
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__shop_store` WHERE `userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$sid = $ret[0]['id'];

			$archives = $dsql->SetQuery("SELECT * FROM `#@__shop_logistictemplate` WHERE `sid` = $sid AND `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$res = $results[0];

				$sid = $res['sid'];
				$title = $res['title'];
				$bearFreight = $res['bearFreight'];
				$valuation = $res['valuation'];
				$express_start = $res['express_start'];
				$express_postage = $res['express_postage'];
				$express_plus = $res['express_plus'];
				$express_postageplus = $res['express_postageplus'];
				$preferentialStandard = $res['preferentialStandard'];
				$preferentialMoney = $res['preferentialMoney'];


				$huoniaoTag->assign('title', $title);
				$huoniaoTag->assign('bearFreight', $bearFreight);
				$huoniaoTag->assign('valuation', $valuation);
				$huoniaoTag->assign('express_start', $express_start);
				$huoniaoTag->assign('express_postage', $express_postage);
				$huoniaoTag->assign('express_plus', $express_plus);
				$huoniaoTag->assign('express_postageplus', $express_postageplus);
				$huoniaoTag->assign('preferentialStandard', $preferentialStandard);
				$huoniaoTag->assign('preferentialMoney', $preferentialMoney);


				switch ($valuation) {
					case 0:
						$valuationTxt = "件";
						break;
					case 1:
						$valuationTxt = "kg";
						break;
					case 2:
						$valuationTxt = "m³";
						break;
				}
				$huoniaoTag->assign('valuationTxt', $valuationTxt);

			}


		}else{
			header('location:http://'.$cfg_basehost.'/404.html');
			die;
		}

	}




	if(empty($smarty)) return;

	if(!isset($return))
		$return = 'row'; //返回的变量数组名

	//注册一个block的索引，照顾smarty的版本
    if(method_exists($smarty, 'get_template_vars')){
        $_bindex = $smarty->get_template_vars('_bindex');
    }else{
        $_bindex = $smarty->getVariable('_bindex')->value;
    }

    if(!$_bindex){
        $_bindex = array();
    }

    if($return){
        if(!isset($_bindex[$return])){
            $_bindex[$return] = 1;
        }else{
            $_bindex[$return] ++;
        }
    }

    $smarty->assign('_bindex', $_bindex);

	//对象$smarty上注册一个数组以供block使用
	if(!isset($smarty->block_data)){
		$smarty->block_data = array();
	}

	//得一个本区块的专属数据存储空间
	$dataindex = md5(__FUNCTION__.md5(serialize($params)));
	$dataindex = substr($dataindex, 0, 16);

	//使用$smarty->block_data[$dataindex]来存储
	if(!$smarty->block_data[$dataindex]){
		//取得指定动作名
		$moduleHandels = new handlers($service, $action);

		$param = $params;
		$moduleReturn  = $moduleHandels->getHandle($param);

		//只返回数据统计信息
		if($pageData == 1){
			if(!is_array($moduleReturn) || $moduleReturn['state'] != 100){
				$pageInfo_ = array("totalCount" => 0, "gray" => 0, "audit" => 0, "refuse" => 0);
			}else{
				$moduleReturn  = $moduleReturn['info'];  //返回数据
				$pageInfo_ = $moduleReturn['pageInfo'];
			}
			$smarty->block_data[$dataindex] = array($pageInfo_);

		//指定数据
		}elseif(!empty($get)){
			$retArr = $moduleReturn['state'] == 100 ? $moduleReturn['info'][$get] : "";
			$retArr = is_array($retArr) ? $retArr : array();
			$smarty->block_data[$dataindex] = $retArr;

		//正常返回
		}else{

			global $pageInfo;
			if(!is_array($moduleReturn) || $moduleReturn['state'] != 100) {
				$pageInfo = array();
				$smarty->assign('pageInfo', $pageInfo);
				return '';
			}
			$moduleReturn  = $moduleReturn['info'];  //返回数据
			$pageInfo_ = $moduleReturn['pageInfo'];
			if($pageInfo_){
				//如果有分页数据则提取list键
				$moduleReturn  = $moduleReturn['list'];
				$pageInfo = $pageInfo_;
			}else{
				$pageInfo = array();
			}
			$smarty->assign('pageInfo', $pageInfo);
			$smarty->block_data[$dataindex] = $moduleReturn;  //存储数据

		}

	}

	//果没有数据，直接返回null,不必再执行了
	if(!$smarty->block_data[$dataindex]) {
		$repeat = false;
		return '';
	}

	//一条数据出栈，并把它指派给$return，重复执行开关置位1
	if(list($key, $item) = each($smarty->block_data[$dataindex])){
		$smarty->assign($return, $item);
		$repeat = true;
	}

	//如果已经到达最后，重置数组指针，重复执行开关置位0
	if(!$item) {
		reset($smarty->block_data[$dataindex]);
		$repeat = false;
	}

	//打印内容
	print $content;
}





//获取属性
function getItemList($property, $itemid){
	global $dsql;
	//获取分类属性
	$proItemList = array();
	$propertyArr = array();
	$propertyIds = array();
	$propertyVal = array();
	if(!empty($property)){
		$propertyArr = explode("|", $property);
		foreach($propertyArr as $key => $val){
			$value = explode("#", $val);
			array_push($propertyIds, $value[0]);
			array_push($propertyVal, $value[1]);
		}
	}
	if($itemid != 0){
		$archives = $dsql->SetQuery("SELECT * FROM `#@__shop_item` WHERE `type` = ".$itemid." AND `parentid` = 0 ORDER BY `weight`");
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			foreach($results as $key => $val){

				$id = $val['id'];
				$typeName = $val['typename'];
				$r = strstr($val['flag'], 'r');
				$w = strstr($val['flag'], 'w');
				$c = strstr($val['flag'], 'c');

				$archives_ = $dsql->SetQuery("SELECT * FROM `#@__shop_item` WHERE `parentid` = ".$val['id']." ORDER BY `weight`");
				$results_ = $dsql->dsqlOper($archives_, "results");

				if($results_){
					$listItem = array();
					$requri = $requri_ = $dtitle = $ctype = "";
					if($r){
						$requri = ' data-required="1"';
						$requri_ = '<font color="#f00">*</font>';
					}
					$properVal = array();
					if(!empty($propertyIds) && $_GET['typeid'] == ""){
						$found = array_search($id, $propertyIds);
						$properVal = $propertyVal[$found];
					}else{
						$properVal = "";
					}

					//可输入
					if($w){

						$ctype = "select";
						array_push($listItem, '<input type="text" class="inp" name="item'.$id.'" id="item'.$id.'" data-title="请选择或直接输入'.$typeName.'属性" placeholder="点击选择或直接输入内容" data-regex="\S+" value="'.$properVal.'" />');
						if($r){
							array_push($listItem, '<span class="tip-inline"><s></s>请选择或直接输入'.$typeName.'属性</span>');
							$dtitle = '请选择或直接输入'.$typeName.'属性';
						}
						array_push($listItem, '<div class="popup_key"><ul>');
						foreach($results_ as $key_ => $val_){
							array_push($listItem, '<li data-id="'.$val_['id'].'" title="'.$val_['typename'].'">'.$val_['typename'].'</li>');
						}
						array_push($listItem, '</ul></div>');

					//多选
					}elseif($c){

						$ctype = "checkbox";
						array_push($listItem, '<div class="checkbox" data-title="请选择'.$typeName.'属性">');

						$properVal = array();
						if(!empty($propertyIds) && $_GET['typeid'] == ""){
							$found = array_search($id, $propertyIds);
							if($found){
								$properVal = explode(",", $propertyVal[$found]);
							}
						}

						foreach($results_ as $key_ => $val_){

							$checked = "";
							if(in_array($val_['id'], $properVal)){
								$checked = " checked";
							}

							array_push($listItem, '<label><input type="checkbox" name="item'.$id.'[]" value="'.$val_['id'].'"'.$requri.$checked.' />'.$val_['typename'].'</label>');
						}
						if($r){
							array_push($listItem, '<span class="tip-inline"><s></s>请选择'.$typeName.'属性</span>');
							$dtitle = '请选择'.$typeName.'属性';
						}

						array_push($listItem, '</div>');

					//下拉菜单
					}else{
						$ctype = "radio";
						array_push($listItem, '<div class="radio" data-title="请选择'.$typeName.'属性">');
						foreach($results_ as $key_ => $val_){
							$selected = "";
							if($val_['id'] == $properVal){
								$selected = " class='curr'";
							}
							array_push($listItem, '<span data-id="'.$val_['id'].'"'.$selected.'>'.$val_['typename'].'</span>');
						}
						array_push($listItem, '<input type="hidden" name="item'.$id.'" id="item'.$id.'" value="'.$properVal.'">');
						if($r){
							array_push($listItem, '</div><span class="tip-inline"><s></s>请选择'.$typeName.'属性</span>');
							$dtitle = '请选择'.$typeName.'属性';
						}
					}

					if(!empty($listItem)){
						array_push($proItemList, '<dl'.$requri.' data-title="'.$dtitle.'" data-type="'.$ctype.'" class="fn-clear"><dt>'.$requri_.''.$typeName.'：</dt>');
						array_push($proItemList, '<dd>'.join("", $listItem).'</dd>');
						array_push($proItemList, '</dl>');
					}

				}
			}
		}
	}
	return $proItemList;
}


//获取规格
function getSpeList($specifiList, $itemid){
	global $dsql;
	//获取分类规格
	$specification = array();
	$specifiArr = array();
	$specifiIds = array();
	$specifiVal = array();
	if(!empty($specifiList) && $_GET['typeid'] == ""){
		$specifiArr = explode("|", $specifiList);
		foreach($specifiArr as $key => $val){
			$value = explode(",", $val);
			$ids = explode("-", $value[0]);
			foreach($ids as $key_ => $val_){
				if(!in_array($val_, $specifiIds)){
					array_push($specifiIds, $val_);
				}
			}
			array_push($specifiVal, $value[1]);
		}
	}
	if($itemid != 0){
		$archives = $dsql->SetQuery("SELECT `spe` FROM `#@__shop_type` WHERE `id` = ".$itemid);
		$results = $dsql->dsqlOper($archives, "results");
		if($results && !empty($results[0]['spe'])){
			$spe = explode(",", $results[0]['spe']);
			foreach($spe as $key => $val){
				$archives_1 = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__shop_specification` WHERE `id` = ".$val);
				$results_1 = $dsql->dsqlOper($archives_1, "results");
				if($results_1){
					$speItem = array();
					foreach($results_1 as $key_1 => $val_1){
						$archives_2 = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__shop_specification` WHERE `parentid` = ".$val_1['id']);
						$results_2 = $dsql->dsqlOper($archives_2, "results");
						if($results_2){
							foreach($results_2 as $key_2 => $val_2){
								$checked = "";
								if(in_array($val_2['id'], $specifiIds)){
									$checked = " checked";
								}
								array_push($speItem, '<label><input type="checkbox" name="spe'.$val.'[]" id="spe'.$val.'" title="'.$val_2['typename'].'" value="'.$val_2['id'].'"'.$checked.' />'.$val_2['typename'].'</label>');
							}
						}
					}
					if($speItem){
						array_push($specification, '<dl class="fn-clear"><dt><label>'.$results_1[0]['typename'].'：</label></dt>');
						array_push($specification, '<dd data-title="'.$results_1[0]['typename'].'" data-id="'.$results_1[0]['id'].'"><div class="fn-clear checkbox">'.join("", $speItem).'</div></dd>');
						array_push($specification, '</dl>');
					}
				}
			}
		}
	}
	return array("specifiVal" => $specifiVal, "specification" => $specification);
}
