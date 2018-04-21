<?php

/**
 * huoniaoTag模板标签函数插件-信息模块
 *
 * @param $params array 参数集
 * @return array
 */
function info($params, $content = "", &$smarty = array(), &$repeat = array()){
	$service = "info";
	extract ($params);
	if(empty($action)) return '';
	global $huoniaoTag;

	//获取指定分类详细信息
	if($action == "list"){
		$listHandels = new handlers($service, "typeDetail");
		$listConfig  = $listHandels->getHandle($typeid);

		if(is_array($listConfig) && $listConfig['state'] == 100){
			$listConfig  = $listConfig['info'];
			if(is_array($listConfig)){
				foreach ($listConfig[0] as $key => $value) {
					$huoniaoTag->assign('list_'.$key, $value);
				}
			}
		}

		//面包屑
		global $data;
		$data = "";
		$typeArr = getParentArr("infotype", $typeid);
		$typeArr = array_reverse(parent_foreach($typeArr, "typename"));

		global $data;
		$data = "";
		$typeIds = getParentArr("infotype", $typeid);
		$typeIds = array_reverse(parent_foreach($typeIds, "id"));

		$crumbs = array();
		foreach ($typeArr as $key => $value) {
			$param = array(
				"service"     => $service,
				"template"    => "list",
				"id"          => $typeIds[$key]
			);
			$url = getUrlPath($param);
			$crumbs[] = '<a href="'.$url.'">'.$value.'</a>';
		}
		$huoniaoTag->assign('list_crumbs', join("<s></s>", $crumbs));

		$huoniaoTag->assign('typeid', (int)$typeid);
		$huoniaoTag->assign('keywords', $keywords);
		return;

	//获取指定ID的详细信息
	}elseif($action == "detail"){
		$detailHandels = new handlers($service, $action);
		$detailConfig  = $detailHandels->getHandle($id);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){
				//获取分类信息
				$listHandels = new handlers($service, "typeDetail");
				$listConfig  = $listHandels->getHandle($detailConfig['typeid']);
				if(is_array($listConfig) && $listConfig['state'] == 100){
					$listConfig  = $listConfig['info'];
					if(is_array($listConfig)){
						foreach ($listConfig[0] as $key => $value) {
							$huoniaoTag->assign('list_'.$key, $value);
						}
					}
				}

				//面包屑
				global $data;
				$data = "";
				$typeArr = getParentArr("infotype", $detailConfig['typeid']);
				$typeArr = array_reverse(parent_foreach($typeArr, "typename"));

				global $data;
				$data = "";
				$typeIds = getParentArr("infotype", $detailConfig['typeid']);
				$typeIds = array_reverse(parent_foreach($typeIds, "id"));

				$crumbs = array();
				foreach ($typeArr as $key => $value) {
					$param = array(
						"service"     => $service,
						"template"    => "list",
						"id"          => $typeIds[$key]
					);
					$url = getUrlPath($param);
					$crumbs[] = '<a href="'.$url.'" target="_blank">'.$value.'</a>';
				}
				$huoniaoTag->assign('list_crumbs', join(" &raquo; ", $crumbs));

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}

				$body = $detailConfig['body'];
				$huoniaoTag->assign('detail_body', str_replace("</p>_huoniao_page_break_tag_<p>", "", $body));

				//更新阅读次数
				global $dsql;
				$sql = $dsql->SetQuery("UPDATE `#@__".$service."list` SET `click` = `click` + 1 WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "update");

			}
		}else{
			header("location:".$cfg_basehost."/404.html");
		}
		return;


	//会员首页
	}elseif($action == "store"){

		$huoniaoTag->assign('id', $id);
		$huoniaoTag->assign('member', getMemberDetail($id));
		return;


	//号码发布记录
	}elseif($action == "mobilehistory"){

		if($data){
			$RenrenCrypt = new RenrenCrypt();
			$tel = $RenrenCrypt->php_decrypt(base64_decode($data));

			$huoniaoTag->assign('data', $data);
			$huoniaoTag->assign('tel', $tel);
			$huoniaoTag->assign('telAddr', getTelAddr($tel));

			//获取手机号码共发布多少条信息
			global $dsql;
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infolist` WHERE `tel` = '".$tel."'");
			$results2 = $dsql->dsqlOper($archives, "totalCount");
			$huoniaoTag->assign('telCount', $results2);

		}else{
			header("location:".$cfg_basehost."/404.html");
		}
		return;


	//发布信息
	}elseif($action == "fabu"){

		$huoniaoTag->assign('dopost', $dopost);

		if(!empty($typeid)){

			//获取分类信息
			$listHandels = new handlers($service, "typeDetail");
			$listConfig  = $listHandels->getHandle($typeid);
			if(is_array($listConfig) && $listConfig['state'] == 100){
				$listConfig  = $listConfig['info'];
				if(is_array($listConfig)){
					foreach ($listConfig[0] as $key => $value) {
						$huoniaoTag->assign('list_'.$key, $value);
					}
				}
			}

		}

		//发布成功
		if(!empty($id)){
			$huoniaoTag->assign("id", $id);
		}
		return;


	//付款结果页面
	}elseif($action == "payreturn"){
		global $dsql;

		if(!empty($ordernum)){

			//根据支付订单号查询支付结果
			$archives = $dsql->SetQuery("SELECT r.`ordernum`, r.`aid`, r.`start`, r.`end`, r.`price`, r.`state` FROM `#@__pay_log` l LEFT JOIN `#@__member_bid` r ON r.`ordernum` = l.`body` WHERE r.`module` = 'info' AND l.`ordernum` = '$ordernum'");
			$payDetail  = $dsql->dsqlOper($archives, "results");
			if($payDetail){

				$title = "";
				$sql = $dsql->SetQuery("SELECT `title` FROM `#@__infolist` WHERE `id` = ".$payDetail[0]['aid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$title = $ret[0]['title'];
				}

				$param = array(
					"service"     => "info",
					"template"    => "detail",
					"id"          => $payDetail[0]['aid']
				);
				$url = getUrlPath($param);

				$huoniaoTag->assign('state', $payDetail[0]['state']);
				$huoniaoTag->assign('ordernum', $payDetail[0]['ordernum']);
				$huoniaoTag->assign('title', $title);
				$huoniaoTag->assign('url', $url);
				$huoniaoTag->assign('date', $payDetail[0]['start']);
				$huoniaoTag->assign('end', $payDetail[0]['end']);
				$huoniaoTag->assign('price', $payDetail[0]['price']);

				$amount = ($payDetail[0]['end'] - $payDetail[0]['end']) / 24 / 3600 * $payDetail[0]['price'];
				$huoniaoTag->assign('amount', sprintf("%.2f", $amount));

			//支付订单不存在
			}else{
				$huoniaoTag->assign('state', 0);
			}

		}else{
			header("location:http://".$cfg_basehost);
			die;
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
		}elseif($action == "ilist"){
			//如果是列表页面，则获取地址栏传过来的typeid
			if($template == "list" && !$typeid){
				global $typeid;
				$params['typeid']   = $typeid;
			}

		}

		$moduleReturn  = $moduleHandels->getHandle($param);

		//只返回数据统计信息
		if($pageData == 1){
			if(!is_array($moduleReturn) || $moduleReturn['state'] != 100){
				$pageInfo_ = array("totalCount" => 0, "gray" => 0, "audit" => 0, "refuse" => 0, "expire" => 0);
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
