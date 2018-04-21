<?php

/**
 * huoniaoTag模板标签函数插件-商家模块
 *
 * @param $params array 参数集
 * @return array
 */
function business($params, $content = "", &$smarty = array(), &$repeat = array()){
	$service = "business";
	extract ($params);
	if(empty($action)) return '';

	global $huoniaoTag;
	global $dsql;
	global $userLogin;
	global $cfg_basehost;


	//商品列表
	if($action == "list"){

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

		//所有父级集合
		global $data;
		$data = "";
		$addrArr = getParentArr("business_addr", $addrid);
		$addrNameArr = array_reverse(parent_foreach($addrArr, "typename"));
		$data = "";
		$addrIdArr = array_reverse(parent_foreach($addrArr, "id"));
		$huoniaoTag->assign("addrNameArr", $addrNameArr);
		$huoniaoTag->assign("addrIdArr", $addrIdArr);
		if($addrNameArr){
			array_push($seo_title, join("-", $addrNameArr));
		}

		//所有父级集合
		global $data;
		$data = "";
		$typeArr = getParentArr("business_type", $typeid);
		$typeNameArr = array_reverse(parent_foreach($typeArr, "typename"));
		$data = "";
		$typeIdArr = array_reverse(parent_foreach($typeArr, "id"));
		$huoniaoTag->assign("typeNameArr", $typeNameArr);
		$huoniaoTag->assign("typeIdArr", $typeIdArr);
		if($typeNameArr){
			array_push($seo_title, join("-", $typeNameArr));
		}

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

		//排序
		$huoniaoTag->assign('orderby', $orderby);

		//seo标题
		$huoniaoTag->assign('seo_title', join("-", $seo_title));



	//获取指定ID的商铺详细
	}elseif(
		$action == "storeDetail" ||
		$action == "detail" ||
		$action == "intro" ||
		$action == "news" ||
		$action == "newsd" ||
		$action == "albums" ||
		$action == "albumsd" ||
		$action == "panor" ||
		$action == "panord" ||
		$action == "video" ||
		$action == "videod" ||
		$action == "tuan" ||
		$action == "shop" ||
		$action == "house-sale" ||
		$action == "house-zu" ||
		$action == "job" ||
		$action == "waimai"
	){

		$detailid = $uid ? $uid : $id;

		//动态详细
		if($action == "newsd"){

			if(!empty($id)){

				$detailHandels = new handlers($service, "news_detail");
				$detailConfig  = $detailHandels->getHandle($id);
				if(is_array($detailConfig) && $detailConfig['state'] == 100){
					$detailConfig  = $detailConfig['info'];
					if(is_array($detailConfig)){
						//输出详细信息
						foreach ($detailConfig as $key => $value) {
							$huoniaoTag->assign('newsd_'.$key, $value);
						}
					}

					$detailid = $detailConfig['bid'];

					//更新浏览次数
					$sql = $dsql->SetQuery("UPDATE `#@__business_news` SET `click` = `click` + 1 WHERE `id` = $id");
					$dsql->dsqlOper($sql, "update");

				}else{
					header("location:http://".$cfg_basehost."/404.html?4");
				}

			}else{
				header("location:http://".$cfg_basehost."/404.html?3");
			}

		//相册详细
		}elseif($action == "albumsd"){

			if(!empty($id)){

				$detailHandels = new handlers($service, "albums_detail");
				$detailConfig  = $detailHandels->getHandle($id);
				if(is_array($detailConfig) && $detailConfig['state'] == 100){
					$detailConfig  = $detailConfig['info'];
					if(is_array($detailConfig)){
						//输出详细信息
						foreach ($detailConfig as $key => $value) {
							$huoniaoTag->assign('albumsd_'.$key, $value);
						}
					}

					$detailid = $detailConfig['bid'];

				}else{
					header("location:http://".$cfg_basehost."/404.html?6");
				}

			}else{
				header("location:http://".$cfg_basehost."/404.html?5");
			}

		//视频详细
		}elseif($action == "videod"){

			if(!empty($id)){

				$detailHandels = new handlers($service, "video_detail");
				$detailConfig  = $detailHandels->getHandle($id);
				if(is_array($detailConfig) && $detailConfig['state'] == 100){
					$detailConfig  = $detailConfig['info'];
					if(is_array($detailConfig)){
						//输出详细信息
						foreach ($detailConfig as $key => $value) {
							$huoniaoTag->assign('videod_'.$key, $value);
						}
					}

					$detailid = $detailConfig['bid'];

					//更新浏览次数
					$sql = $dsql->SetQuery("UPDATE `#@__business_video` SET `click` = `click` + 1 WHERE `id` = $id");
					$dsql->dsqlOper($sql, "update");

				}else{
					header("location:http://".$cfg_basehost."/404.html?6");
				}

			}else{
				header("location:http://".$cfg_basehost."/404.html?5");
			}

		//全景详细
		}elseif($action == "panord"){

			if(!empty($id)){

				$detailHandels = new handlers($service, "panor_detail");
				$detailConfig  = $detailHandels->getHandle($id);
				if(is_array($detailConfig) && $detailConfig['state'] == 100){
					$detailConfig  = $detailConfig['info'];
					if(is_array($detailConfig)){
						//输出详细信息
						foreach ($detailConfig as $key => $value) {
							$huoniaoTag->assign('panord_'.$key, $value);
						}
					}

					$detailid = $detailConfig['bid'];

					//更新浏览次数
					$sql = $dsql->SetQuery("UPDATE `#@__business_panor` SET `click` = `click` + 1 WHERE `id` = $id");
					$dsql->dsqlOper($sql, "update");

				}else{
					header("location:http://".$cfg_basehost."/404.html?6");
				}

			}else{
				header("location:http://".$cfg_basehost."/404.html?5");
			}

		}



		if($action != "storeDetail" && $action != "detail" && $action != "newsd" && $action != "albumsd" && $action != "videod" && $action != "panord"){
			$detailid = $bid;
		}

		if(empty($detailid)){
			// header("location:http://".$cfg_basehost."/404.html?1");
			// die;
		}

		$detailHandels = new handlers($service, "storeDetail");
		$detailConfig  = $detailHandels->getHandle($detailid);
		$state = 0;

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}
				$state = 1;


				//介绍
				if($action == "intro"){

					//介绍ID为空时取第一个
					if(empty($id)){
						$sql = $dsql->SetQuery("SELECT `id`, `title`, `body`, `click`, `pubdate` FROM `#@__business_about` WHERE `uid` = ".$detailConfig['member']['userid']." ORDER BY `weight` DESC, `id` ASC");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$data = $ret[0];
							$id = $data['id'];
							$huoniaoTag->assign('intro_id', $data['id']);
							$huoniaoTag->assign('intro_title', $data['title']);
							$huoniaoTag->assign('intro_body', $data['body']);
							$huoniaoTag->assign('intro_click', $data['click']);
							$huoniaoTag->assign('intro_pubdate', $data['pubdate']);
						}

					//取指定ID的介绍
					}else{
						$detailHandels = new handlers($service, "introDetail");
						$detailConfig  = $detailHandels->getHandle($id);
						if(is_array($detailConfig) && $detailConfig['state'] == 100){
							$detailConfig  = $detailConfig['info'];
							if(is_array($detailConfig)){
								//输出详细信息
								foreach ($detailConfig as $key => $value) {
									$huoniaoTag->assign('intro_'.$key, $value);
								}
							}
						}
					}

					//更新浏览次数
					$sql = $dsql->SetQuery("UPDATE `#@__business_about` SET `click` = `click` + 1 WHERE `id` = $id");
					$dsql->dsqlOper($sql, "update");


				//动态
				}elseif($action == "news"){

					$typename = "商家动态";
					if(!empty($id)){
						$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_news_type` WHERE `uid` = ".$detailConfig['member']['userid']." AND `id` = $id");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$typename = $ret[0]['typename'];
						}
					}

					$huoniaoTag->assign("id", (int)$id);
					$huoniaoTag->assign("news_typename", $typename);


				//相册
				}elseif($action == "albums"){

					$typename = "商家相册";
					if(!empty($id)){
						$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_albums_type` WHERE `uid` = ".$detailConfig['member']['userid']." AND `id` = $id");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$typename = $ret[0]['typename'];
						}
					}

					$huoniaoTag->assign("id", (int)$id);
					$huoniaoTag->assign("albums_typename", $typename);


				//团购
				}elseif($action == "tuan"){

					if(!$detailConfig['store']['tuan']){
						header("location:http://".$cfg_basehost."/404.html?11");
					}


				//商城
				}elseif($action == "shop"){

					if(!$detailConfig['store']['shop']){
						header("location:http://".$cfg_basehost."/404.html?22");
					}


				//房产
				}elseif($action == "house-sale" || $action == "house-zu"){

					if(!$detailConfig['store']['house']){
						header("location:http://".$cfg_basehost."/404.html?22");
					}


				//招聘
				}elseif($action == "job"){

					if(!$detailConfig['store']['job']){
						header("location:http://".$cfg_basehost."/404.html?22");
					}

				}



			}
		}else{
			if($id){
				header("location:http://".$cfg_basehost."/404.html?2");
			}
		}
		$huoniaoTag->assign('storeState', $state);
		return;



	//发布信息
	}elseif($action == "fabu"){

		//输出分类字段内容
		global $userLogin;
		$userid = $userLogin->getMemberID();

		if($userid != -1){

			$storeid = 0;
			$parentTypeid = 0;
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$storeid = $ret[0]['id'];
			}

			//修改信息
			if($id){

				$detailHandels = new handlers($service, $act."Detail");
				$detailConfig  = $detailHandels->getHandle($id);

				if(is_array($detailConfig) && $detailConfig['state'] == 100){
					$detailConfig  = $detailConfig['info'];
					if(is_array($detailConfig)){

						if($userid != $detailConfig['uid']){
							header('location:http://'.$cfg_basehost.'/404.html');
							die;
						}
						foreach ($detailConfig as $key => $value) {
							$huoniaoTag->assign('detail_'.$key, $value);
						}
					}
				}else{
					header('location:http://'.$cfg_basehost.'/404.html');
					die;
				}

			}

			$huoniaoTag->assign('storeid', $storeid);

		}

	}



	global $template;
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

		//获取分类
		if($action == "type" || $action == "addr"){
			$param['son'] = $son ? $son : 0;

		//信息列表
		}elseif($action == "alist"){
			//如果是列表页面，则获取地址栏传过来的typeid
			if($template == "list" && !$typeid){
				global $typeid;
			}
			!empty($typeid) ? $param['typeid'] = $typeid : "";

		}

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

		//正常返回
		}else{

			if(!is_array($moduleReturn) || $moduleReturn['state'] != 100) return '';
			$moduleReturn  = $moduleReturn['info'];  //返回数据
			$pageInfo_ = $moduleReturn['pageInfo'];
			if($pageInfo_){
				//如果有分页数据则提取list键
				$moduleReturn  = $moduleReturn['list'];
				//把pageInfo定义为global变量
				global $pageInfo;
				$pageInfo = $pageInfo_;
				$smarty->assign('pageInfo', $pageInfo);
			}

			$smarty->block_data[$dataindex] = $moduleReturn;  //存储数据

		}
	}

	//果没有数据，直接返回null,不必再执行了
	if(!$smarty->block_data[$dataindex]) {
		$repeat = false;
		return '';
	}

	if($action=="type"){
		//print_r($smarty->block_data[$dataindex]);die;
	}

	//一条数据出栈，并把它指派给$return，重复执行开关置位1
	if(list($key, $item) = each($smarty->block_data[$dataindex])){
		if($action == "type"){
			//print_r($item);die;
		}
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
