<?php
/**
 * 管理后台首页
 *
 * @version        $Id: index.php 2013-7-7 上午10:33:36 $
 * @package        HuoNiao.Administrator
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "." );
require_once(dirname(__FILE__)."/inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/templates";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录
$templates = "index.html";

//域名检测 s
$httpHost  = $_SERVER['HTTP_HOST'];    //当前访问域名
$reqUri    = $_SERVER['REQUEST_URI'];  //当前访问目录

//判断是否为主域名，如果不是则跳转到主域名的后台目录
if($cfg_basehost != $httpHost && $cfg_basehost != str_replace("www.", "", $httpHost)){
	header("location:http://".$cfg_basehost.$reqUri);
	die;
}


//验证模板文件
if(file_exists($tpl."/".$templates)){


	//预览所有模块链接
	if($dopost == "getModuleArr"){

		$handler = true;
		$moduleArr = array();
		$config_path = HUONIAOINC."/config/";

		$moduleArr[] = array(
			"name" => '首页',
			"url"  => 'http://'.$cfg_basehost
		);

		$siteDomainInc = "<"."?php\r\n";


		//个人会员
		$userDomainInfo = getDomain('member', 'user');
		$userChannelDomain = $userDomainInfo['domain'];
		if($cfg_userSubDomain == 0){
			$userChannelDomain = "http://".$userChannelDomain;
		}elseif($cfg_userSubDomain == 1){
			$userChannelDomain = "http://".$userChannelDomain.".".str_replace("www.", "", $cfg_basehost);
		}elseif($cfg_userSubDomain == 2){
			$userChannelDomain = "http://".$cfg_basehost."/".$userChannelDomain;
		}

		$siteDomainInc .= "\$userDomain = '".$userChannelDomain."';\r\n";

		//企业会员
		$busiDomainInfo = getDomain('member', 'busi');
		$busiChannelDomain = $busiDomainInfo['domain'];
		if($cfg_busiSubDomain == 0){
			$busiChannelDomain = "http://".$busiChannelDomain;
		}elseif($cfg_busiSubDomain == 1){
			$busiChannelDomain = "http://".$busiChannelDomain.".".str_replace("www.", "", $cfg_basehost);
		}elseif($cfg_busiSubDomain == 2){
			$busiChannelDomain = "http://".$cfg_basehost."/".$busiChannelDomain;
		}

		$siteDomainInc .= "\$busiDomain = '".$busiChannelDomain."';\r\n";

		//商家
		$busiDomainInfo = getDomain('business', 'config');
		$busiChannelDomain = $busiDomainInfo['domain'];

		//引入配置文件
		$serviceInc = $config_path."business.inc.php";
		if(file_exists($serviceInc)){
			require($serviceInc);
		}

		if($customSubDomain == 0){
			$busiChannelDomain = "http://".$busiChannelDomain;
		}elseif($customSubDomain == 1){
			$busiChannelDomain = "http://".$busiChannelDomain.".".str_replace("www.", "", $cfg_basehost);
		}elseif($customSubDomain == 2){
			$busiChannelDomain = "http://".$cfg_basehost."/".$busiChannelDomain;
		}

		$siteDomainInc .= "\$businessDomain = '".$busiChannelDomain."';\r\n";

		$moduleArr[] = array(
			"name" => "商家",
			"url" => $busiChannelDomain
		);


		function getDomainUrl($module, $customSubDomain){
			global $cfg_basehost;
			$domainInfo = getDomain($module, 'config');
			$domain = $domainInfo['domain'];
			if($customSubDomain == 0){
				$domain = "http://".$domain;
			}elseif($customSubDomain == 1){
				$domain = "http://".$domain.".".str_replace("www.", "", $cfg_basehost);
			}elseif($customSubDomain == 2){
				$domain = "http://".$cfg_basehost."/".$domain;
			}
			return $domain;
		}



		$sql = $dsql->SetQuery("SELECT `title`, `name` FROM `#@__site_module` WHERE `state` = 0 ORDER BY `weight`, `id`");
		$result = $dsql->dsqlOper($sql, "results");
		if($result){
			foreach ($result as $key => $value) {
				if(!empty($value['name'])){
					$sName = $value['name'];

					//获取功能模块配置参数
					$configHandels = new handlers($sName, "config");
					$moduleConfig  = $configHandels->getHandle();

					if(is_array($moduleConfig) && $moduleConfig['state'] == 100){
						$moduleConfig  = $moduleConfig['info'];

						//引入配置文件
						$serviceInc = $config_path.$sName.".inc.php";
						if(file_exists($serviceInc)){
							require($serviceInc);
						}
						$channelDomain = getDomainUrl($sName, $customSubDomain);

						$moduleArr[] = array(
							"name" => $value['title'],
							"url" => $channelDomain
						);

						$siteDomainInc .= "\$".$sName."Domain = '".$channelDomain."';\r\n";

						//新闻频道增加图片频道
						// if($sName == "article"){
						// 	$sName = "pic";
						//
						// 	//获取功能模块配置参数
						// 	$configHandels = new handlers($sName, "config");
						// 	$moduleConfig  = $configHandels->getHandle();
						//
						// 	if(is_array($moduleConfig) && $moduleConfig['state'] == 100){
						// 		$moduleConfig  = $moduleConfig['info'];
						//
						// 		//引入配置文件
						// 		$serviceInc = $config_path.$sName.".inc.php";
						// 		if(file_exists($serviceInc)){
						// 			require($serviceInc);
						// 		}
						// 		$channelDomain = getDomainUrl($sName, $customSubDomain);
						//
						// 		$moduleArr[] = array(
						// 			"name" => "图片",
						// 			"url" => $channelDomain
						// 		);
						//
						// 		$siteDomainInc .= "\$".$sName."Domain = '".$channelDomain."';\r\n";
						// 	}
						// }
					}
				}
			}
		}

		$siteDomainInc .= "?".">";
		$customIncFile = HUONIAOINC."/siteModuleDomain.inc.php";
		$fp = @fopen($customIncFile, "w");
		@fwrite($fp, $siteDomainInc);
		@fclose($fp);


		//更新规则文件
		updateHtaccess();


		echo $callback."(".json_encode($moduleArr).")";die;


	//获取消息通知
	}elseif($dopost == "getAdminNotice"){

		$noticeArr = array();

		//提现
		$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__member_withdraw` WHERE `state` = 0");
		$ret = $dsql->dsqlOper($sql, "results");
		$count = $ret[0]['c'];
		if($count){
			array_push($noticeArr, array(
				"module" => "member",
				"name"   => "提现申请",
				"id"     => "withdrawphp",
				"url"    => "member/withdraw.php",
				"count"  => $count
			));
		}

		//认证
		$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__member` WHERE `certifyState` = 3 OR `licenseState` = 3");
		$ret = $dsql->dsqlOper($sql, "results");
		$count = $ret[0]['c'];
		if($count){
			array_push($noticeArr, array(
				"module" => "member",
				"name"   => "会员认证",
				"id"     => "memberListphp",
				"url"    => "member/memberList.php",
				"count"  => $count
			));
		}

		//商家店铺
		$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__business_list` WHERE `state` = 0");
		$ret = $dsql->dsqlOper($sql, "results");
		$count = $ret[0]['c'];
		if($count){
			array_push($noticeArr, array(
				"module" => "business",
				"name"   => "商家店铺",
				"id"     => "businessListphp",
				"url"    => "business/businessList.php",
				"count"  => $count
			));
		}


		//查询所有可用模块
		$sql = $dsql->SetQuery("SELECT `name` FROM `#@__site_module` WHERE `state` = 0");
		$result = $dsql->dsqlOper($sql, "results");
		if($result){
			foreach ($result as $key => $value) {

				$name = $value['name'];

				//新闻资讯
				if($name == "article"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__articlelist` WHERE `del` = 0 AND `arcrank` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => "article",
							"name"   => "新闻资讯",
							"id"     => "articleListphpactionarticle",
							"url"    => "article/articleList.php",
							"count"  => $count
						));
					}

				//分类信息
				}elseif($name == "info"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__infolist` WHERE `arcrank` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "分类信息",
							"id"     => "infoListphp",
							"url"    => "info/infoList.php",
							"count"  => $count
						));
					}

				//团购秒杀
				}elseif($name == "tuan"){

					//商家审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__tuan_store` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "团购商家",
							"id"     => "tuanStorephp",
							"url"    => "tuan/tuanStore.php",
							"count"  => $count
						));
					}

					//团购审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__tuanlist` WHERE `arcrank` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "团购商品",
							"id"     => "tuanListphp",
							"url"    => "tuan/tuanList.php",
							"count"  => $count
						));
					}

				//房产
				}elseif($name == "house"){

					//中介公司
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__house_zjcom` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "房产中介",
							"id"     => "zjComListphp",
							"url"    => "house/zjComList.php",
							"count"  => $count
						));
					}

					//二手房
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__house_sale` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "二手房",
							"id"     => "houseSalephp",
							"url"    => "house/houseSale.php",
							"count"  => $count
						));
					}

					//出租房
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__house_zu` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "出租房",
							"id"     => "houseZuphp",
							"url"    => "house/houseZu.php",
							"count"  => $count
						));
					}

					//写字楼
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__house_xzl` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "写字楼",
							"id"     => "houseXzlphp",
							"url"    => "house/houseXzl.php",
							"count"  => $count
						));
					}

					//商铺
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__house_sp` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "房产商铺",
							"id"     => "houseSpphp",
							"url"    => "house/houseSp.php",
							"count"  => $count
						));
					}

					//厂房仓库
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__house_cf` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "厂房仓库",
							"id"     => "houseCfphp",
							"url"    => "house/houseCf.php",
							"count"  => $count
						));
					}

				//商城
				}elseif($name == "shop"){

					//店铺审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__shop_store` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "商城店铺",
							"id"     => "shopStoreListphp",
							"url"    => "shop/shopStoreList.php",
							"count"  => $count
						));
					}

					//商品审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__shop_product` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "商城商品",
							"id"     => "productListphp",
							"url"    => "shop/productList.php",
							"count"  => $count
						));
					}

				//建材
				}elseif($name == "build"){

					//店铺审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__build_store` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "建材店铺",
							"id"     => "buildStoreListphp",
							"url"    => "build/buildStoreList.php",
							"count"  => $count
						));
					}

					//商品审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__build_product` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "建材商品",
							"id"     => "buildProductphp",
							"url"    => "build/buildProduct.php",
							"count"  => $count
						));
					}

				//家具
				}elseif($name == "furniture"){

					//店铺审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__furniture_store` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "家具店铺",
							"id"     => "furnitureStoreListphp",
							"url"    => "furniture/furnitureStoreList.php",
							"count"  => $count
						));
					}

					//商品审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__furniture_product` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "家具商品",
							"id"     => "furnitureProductphp",
							"url"    => "furniture/furnitureProduct.php",
							"count"  => $count
						));
					}

				//家居
				}elseif($name == "home"){

					//店铺审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__home_store` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "家居店铺",
							"id"     => "homeStoreListphp",
							"url"    => "home/homeStoreList.php",
							"count"  => $count
						));
					}

					//商品审核
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__home_product` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "家居商品",
							"id"     => "homeProductphp",
							"url"    => "home/homeProduct.php",
							"count"  => $count
						));
					}

				//装修公司
				}elseif($name == "renovation"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__renovation_store` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "装修公司",
							"id"     => "renovationStorephp",
							"url"    => "renovation/renovationStore.php",
							"count"  => $count
						));
					}

				//招聘企业
				}elseif($name == "job"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__job_company` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "招聘企业",
							"id"     => "jobCompanyphp",
							"url"    => "job/jobCompany.php",
							"count"  => $count
						));
					}

				//婚嫁
				}elseif($name == "marry"){

					//婚宴酒店
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__marry_hotel` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "婚宴酒店",
							"id"     => "marryHotelphp",
							"url"    => "marry/marryHotel.php",
							"count"  => $count
						));
					}

					//婚纱摄影
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__marry_ritual` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "婚纱摄影",
							"id"     => "marryWeddingphp",
							"url"    => "marry/marryWedding.php",
							"count"  => $count
						));
					}

					//婚庆礼仪
					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__marry_wedding` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "婚庆礼仪",
							"id"     => "marryRitualphp",
							"url"    => "marry/marryRitual.php",
							"count"  => $count
						));
					}

				//外卖餐厅
				}elseif($name == "waimai"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__waimai_store` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "外卖餐厅",
							"id"     => "waimaiStorephp",
							"url"    => "waimai/waimaiStore.php",
							"count"  => $count
						));
					}

				//汽车商家
				}elseif($name == "car"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__car_dealer` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "汽车商家",
							"id"     => "carDealerphp",
							"url"    => "car/carDealer.php",
							"count"  => $count
						));
					}

				//自助建站
				}elseif($name == "website"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__website` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "自助建站",
							"id"     => "websitephp",
							"url"    => "website/website.php",
							"count"  => $count
						));
					}

				//贴吧社区
				}elseif($name == "tieba"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__tieba_list` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "贴吧社区",
							"id"     => "tiebaListphp",
							"url"    => "tieba/tiebaList.php",
							"count"  => $count
						));
					}

				//活动
				}elseif($name == "huodong"){

					$sql = $dsql->SetQuery("SELECT count(`id`) as c FROM `#@__huodong_list` WHERE `state` = 0");
					$ret = $dsql->dsqlOper($sql, "results");
					$count = $ret[0]['c'];
					if($count){
						array_push($noticeArr, array(
							"module" => $module,
							"name"   => "同城活动",
							"id"     => "huodongListphp",
							"url"    => "huodong/huodongList.php",
							"count"  => $count
						));
					}

				}

			}
		}

		//查询消息通知
		$sql = $dsql->SetQuery("SELECT count(`id`) c FROM `#@__site_admin_notice`");
		$ret = $dsql->dsqlOper($sql, "results");
		$hasnew = $ret[0]['c'];

		echo $callback."({'data': ".json_encode($noticeArr).", 'hasnew': ".$hasnew."})";die;


	//清除消息通知
	}elseif($dopost == "clearAdminNotice"){
		$sql = $dsql->SetQuery("DELETE FROM `#@__site_admin_notice`");
		$dsql->dsqlOper($sql, "results");
		die;
	}

	require_once(HUONIAODATA."/admin/config_permission.php");

	//配置
	$menuId = $menuData[0]['menuId'];
	if(!empty($menuData[0]['subMenu'])){
		$html_ = array();
		$span  = array();
		$dataHtml = "";
		foreach($menuData[0]['subMenu'] as $key => $val){
			//循环终级菜单
			$html__ = array();
			foreach($val['subMenu'] as $f_key => $f_val){
				$value = $f_val['menuUrl'];
				if(strpos($value, "/") !== false){
					$value = explode("/", $value);
					$value = $value[1];
				}
				$value = preg_replace('/\.php(\?action\=)?/', '', $value);
				//验证权限
				if(testPurview($value)){
					array_push($html__, '<a href="'.$menuId.'/'.$f_val['menuUrl'].'">'.$f_val['menuName'].'</a>');
				}
			}
			//如果终级菜单不为空，则拼接菜单分组以及菜单列表
			if($html__){
				array_push($html_, '<dd>'.join("", $html__).'</dd>');
				array_push($span, '<span>'.$val['menuName'].'</span>');
			}
		}

		//如果菜单分组不为空，则拼接最外层代码
		if($html_){
			$html = array();
			array_push($html, '<div class="sub-nav clearfix" id="'.$menuId.'"><dl class="clearfix">');
			array_push($html, '<dt>'.join("", $span).'</dt>'.join("", $html_).'</dl></div>');
			$dataHtml = '<li class="sub-li"><a href="javascript:;" class="sub-title">'.$menuData[0]['menuName'].'</a>'.join("", $html).'</li>';
		}
		$huoniaoTag->assign('configData', $dataHtml);
	}

	//用户
	$menuId = $menuData[1]['menuId'];
	if(!empty($menuData[1]['subMenu'])){
		$html_ = array();
		$span  = array();
		$dataHtml = "";
		foreach($menuData[1]['subMenu'] as $key => $val){
			//循环终级菜单
			$html__ = array();
			foreach($val['subMenu'] as $f_key => $f_val){
				$value = $f_val['menuUrl'];
				if(strpos($value, "/") !== false){
					$value = explode("/", $value);
					$value = $value[1];
				}
				$value = preg_replace('/\.php(\?action\=)?/', '', $value);
				//验证权限
				if(testPurview($value)){
					array_push($html__, '<a href="'.$menuId.'/'.$f_val['menuUrl'].'">'.$f_val['menuName'].'</a>');
				}
			}
			//如果终级菜单不为空，则拼接菜单分组以及菜单列表
			if($html__){
				array_push($span, '<span>'.$val['menuName'].'</span>');
				array_push($html_, '<dd>'.join("", $html__).'</dd>');
			}
		}

		//如果菜单分组不为空，则拼接最外层代码
		if($html_){
			$html = array();
			array_push($html, '<div class="sub-nav clearfix" id="'.$menuId.'"><dl class="clearfix">');
			array_push($html, '<dt>'.join("", $span).'</dt>'.join("", $html_).'</dl></div>');
			$dataHtml = '<li class="sub-li"><a href="javascript:;" class="sub-title">'.$menuData[1]['menuName'].'</a>'.join("", $html).'</li>';
		}
		$huoniaoTag->assign('memberData', $dataHtml);
	}

	//模块
	$sql = $dsql->SetQuery("SELECT `id`, `parentid`, `icon`, `title`, `name`, `subnav` FROM `#@__site_module` WHERE `state` = 0 ORDER BY `weight`, `id`");
	$result = $dsql->dsqlOper($sql, "results");
	if($result){//如果有子类
		$html = array();
		$type = array();
		$list = array();
		$info = array();
		$dataHtml = "";
		$i = 0;

		foreach($result as $f_key => $f_val){
			$list_ = array();
			//拼接模块列表
			foreach($result as $s_key => $s_val){
				if($s_val['parentid'] == $f_val['id']){
					$navdata = json_decode($s_val['subnav'], true);
					$info_ = array();
					$info__ = array();
					//拼接最终链接
					foreach($navdata as $s_type){
						$info___ = array();
						foreach($s_type['subMenu'] as $s_list){
							$href = $s_list['menuUrl'];
							if(strpos($href, "/") === false){
								$href = $s_val['name']."/".$href;
							}

							$value = $s_list['menuUrl'];
							if(strpos($value, "/") !== false){
								$value = explode("/", $value);
								$value = $value[1];
							}
							$value = preg_replace('/\.php(\?action\=)?/', '', $value);
							//验证权限
							if(testPurview($value)){
								array_push($info___, '<a href="'.$href.'">'.$s_list['menuName'].'</a>');
							}
						}

						if($info___){
							//链接分类
							array_push($info__, '<span>'.$s_type['menuName'].'</span>');
							//最终链接
							array_push($info_, '<dd class="hide">'.join("", $info___).'</dd>');
						}
					}

					//如果链接不为空，则拼接外层代码
					if($info_){
						array_push($info, '<div class="hide" id="'.$s_val['name'].'"><dl class="clearfix"><dt>'.join("", $info__).'</dt>'.join("", $info_)."</dl></div>");
						array_push($list_, '<li data-id="'.$s_val['name'].'"><a href="javascript:;"><s><img src="'.HUONIAOADMIN.'/../static/images/admin/nav/'.$s_val['icon'].'" /></s>'.$s_val['title'].'</a></li>');
					}

				}
			}

			if($f_val['parentid'] == 0 && $list_){
				//第一个分组和第一个模块为显示状态
				$cla = "";
				$cla_ = " hide";
				if($i == 0){
					$cla = " class='selected'";
					$cla_ = "";
				}

				//模块分组
				array_push($type, '<li'.$cla.'><a href="javascript:;">'.$f_val['title'].'</a></li>');

				//模块列表
				array_push($list, '<ul class="clearfix'.$cla_.'">'.join("", $list_).'</ul>');
				$i++;
			}
		}
		if($info){
			array_push($html, '<div class="sub-nav clearfix" id="module">');
			array_push($html, '<div class="sub-top clearfix"><ul class="tab clearfix" id="tab">'.join("", $type).'</ul>');
			array_push($html, '<ul class="tool-r clearfix"><li class="selected"><a href="javascript:;" id="editModelList">编辑模块</a></li></ul>');
			array_push($html, '</div>');
			array_push($html, '<div class="model-list" id="modelList">'.join("", $list).'</div>');
			array_push($html, '<div class="model-info hide" id="modelInfo">'.join("", $info).'</div>');
			array_push($html, '</div>');
			$dataHtml = '<li class="sub-li"><a href="javascript:;" class="sub-title">'.$menuData[2]['menuName'].'</a>'.join("", $html).'</li>';
		}

		$huoniaoTag->assign('moduleData', $dataHtml);
	}

	//手机
	$menuId = $menuData[3]['menuId'];
	if(!empty($menuData[3]['subMenu'])){
		$html_ = array();
		$span  = array();
		$dataHtml = "";
		foreach($menuData[3]['subMenu'] as $key => $val){
			//循环终级菜单
			$html__ = array();
			foreach($val['subMenu'] as $f_key => $f_val){
				$value = $f_val['menuUrl'];
				if(strpos($value, "/") !== false){
					$value = explode("/", $value);
					$value = $value[1];
				}
				$value = preg_replace('/\.php(\?action\=)?/', '', $value);
				//验证权限
				if(testPurview($value)){
					array_push($html__, '<a href="'.$menuId.'/'.$f_val['menuUrl'].'">'.$f_val['menuName'].'</a>');
				}
			}
			//如果终级菜单不为空，则拼接菜单分组以及菜单列表
			if($html__){
				array_push($span, '<span>'.$val['menuName'].'</span>');
				array_push($html_, '<dd>'.join("", $html__).'</dd>');
			}
		}

		//如果菜单分组不为空，则拼接最外层代码
		if($html_){
			$html = array();
			array_push($html, '<div class="sub-nav clearfix" id="'.$menuId.'"><dl class="clearfix">');
			array_push($html, '<dt>'.join("", $span).'</dt>'.join("", $html_).'</dl></div>');
			$dataHtml = '<li class="sub-li"><a href="javascript:;" class="sub-title">'.$menuData[3]['menuName'].'</a>'.join("", $html).'</li>';
		}
		$huoniaoTag->assign('mobileData', $dataHtml);
	}

	//微信
	$menuId = $menuData[4]['menuId'];
	if(!empty($menuData[4]['subMenu'])){
		$html_ = array();
		$span  = array();
		$dataHtml = "";
		foreach($menuData[4]['subMenu'] as $key => $val){
			//循环终级菜单
			$html__ = array();
			foreach($val['subMenu'] as $f_key => $f_val){
				$value = $f_val['menuUrl'];
				if(strpos($value, "/") !== false){
					$value = explode("/", $value);
					$value = $value[1];
				}
				$value = preg_replace('/\.php(\?action\=)?/', '', $value);
				//验证权限
				if(testPurview($value)){
					array_push($html__, '<a href="'.$menuId.'/'.$f_val['menuUrl'].'">'.$f_val['menuName'].'</a>');
				}
			}
			//如果终级菜单不为空，则拼接菜单分组以及菜单列表
			if($html__){
				array_push($span, '<span>'.$val['menuName'].'</span>');
				array_push($html_, '<dd>'.join("", $html__).'</dd>');
			}
		}

		//如果菜单分组不为空，则拼接最外层代码
		if($html_){
			$html = array();
			array_push($html, '<div class="sub-nav clearfix" id="'.$menuId.'"><dl class="clearfix">');
			array_push($html, '<dt>'.join("", $span).'</dt>'.join("", $html_).'</dl></div>');
			$dataHtml = '<li class="sub-li"><a href="javascript:;" class="sub-title">'.$menuData[4]['menuName'].'</a>'.join("", $html).'</li>';
		}
		$huoniaoTag->assign('wechatData', $dataHtml);
	}

	//商家
	$menuId = $menuData[5]['menuId'];
	if(!empty($menuData[5]['subMenu'])){
		$html_ = array();
		$span  = array();
		$dataHtml = "";
		foreach($menuData[5]['subMenu'] as $key => $val){
			//循环终级菜单
			$html__ = array();
			foreach($val['subMenu'] as $f_key => $f_val){
				$value = $f_val['menuUrl'];
				if(strpos($value, "/") !== false){
					$value = explode("/", $value);
					$value = $value[1];
				}
				$value = preg_replace('/\.php(\?action\=)?/', '', $value);
				//验证权限
				if(testPurview($value)){
					$href = $f_val['menuUrl'];
					if(strpos($href, "/") === false){
						$href = $menuId.'/'.$href;
					}

					array_push($html__, '<a href="'.$href.'">'.$f_val['menuName'].'</a>');
				}
			}
			//如果终级菜单不为空，则拼接菜单分组以及菜单列表
			if($html__){
				array_push($span, '<span>'.$val['menuName'].'</span>');
				array_push($html_, '<dd>'.join("", $html__).'</dd>');
			}
		}

		//如果菜单分组不为空，则拼接最外层代码
		if($html_){
			$html = array();
			array_push($html, '<div class="sub-nav clearfix" id="'.$menuId.'"><dl class="clearfix">');
			array_push($html, '<dt>'.join("", $span).'</dt>'.join("", $html_).'</dl></div>');
			$dataHtml = '<li class="sub-li"><a href="javascript:;" class="sub-title">'.$menuData[5]['menuName'].'</a>'.join("", $html).'</li>';
		}
		$huoniaoTag->assign('businessData', $dataHtml);
	}


	//商店
	$storeData = "";
	if(testPurview("moduleList")){
		$storeData = '<li><a href="siteConfig/store.php" data-id="store">商店</a></li>';
	}else{
	}
	$huoniaoTag->assign('storeData', $storeData);


	$userid = $userLogin->getUserID();
	$archives = $dsql->SetQuery("SELECT `username`, `mgroupid` FROM `#@__member` WHERE `id` = ".$userid);
	$results = $dsql->dsqlOper($archives, "results");
	$huoniaoTag->assign('username', $results[0]['username']);

	$archives = $dsql->SetQuery("SELECT `groupname` FROM `#@__admingroup` WHERE `id` = ".$results[0]['mgroupid']);
	$results = $dsql->dsqlOper($archives, "results");
	$huoniaoTag->assign('groupname', $results[0]['groupname']);

	$archives = $dsql->SetQuery("SELECT * FROM `#@__adminlogin` WHERE `userid` = ".$userid." ORDER BY `id` DESC LIMIT 0, 2");
	$results = $dsql->dsqlOper($archives, "results");
	$huoniaoTag->assign('logintime', date("Y-m-d H:i:s", $results[1]['logintime']));
	$huoniaoTag->assign('loginip', $results[1]['loginip']);

	$huoniaoTag->assign('gotopage', $gotopage);

	$huoniaoTag->assign('hour', getNowHour());
	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
