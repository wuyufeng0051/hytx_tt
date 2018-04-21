<?php

/**
 * huoniaoTag模板标签函数插件-新闻模块
 *
 * @param $params array 参数集
 * @return array
 */
function article($params, $content = "", &$smarty = array(), &$repeat = array()){
	$service = "article";
	extract ($params);
	if(empty($action)) return '';
	global $huoniaoTag;

	//获取指定分类详细信息
	if($action == "list"){

		if(empty($typeid)){
			global $dsql;

			//全拼类型
			if(!empty($pinyin)){

				$pinyin = str_replace("/", "", $pinyin);

				//获取分类信息
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__articletype` WHERE `pinyin` = '$pinyin'");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typeid1 = $ret[0]['id'];
				}

			//首字母
			}elseif(!empty($py)){

				$py = str_replace("/", "", $py);

				//获取分类信息
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__articletype` WHERE `py` = '$py'");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typeid1 = $ret[0]['id'];
				}

			}

			global $typeid;
			$typeid = $typeid1;
		}

		//404
		if(empty($typeid)){
			header("location:".$cfg_basehost."/404.html");
		}

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
		return;

	//搜索
	}elseif($action == "search"){

		//关键字为空跳回首页
		if(empty($keywords)){
			header("location:index.html");
			die;
		}

		$huoniaoTag->assign('keywords', $keywords);
		$huoniaoTag->assign('page', (int)$page);
		return;

	//获取指定ID的详细信息
	}elseif($action == "detail" || $action == "comment"){
		$detailHandels = new handlers($service, "detail");
		$detailConfig  = $detailHandels->getHandle($id);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//跳转
				if(strpos($detailConfig['flag'], 't') !== false && !empty($detailConfig['redirecturl'])){
					header("location:".$detailConfig['redirecturl']);
					die;
				}

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

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}

				global $p;
				global $all;
				$body = isMobile() ? ($detailConfig['mbody'] ? $detailConfig['mbody'] : $detailConfig['body']) : $detailConfig['body'];
				$pagesss = '_huoniao_page_break_tag_';  //设定分页标签
				$a = strpos($body, $pagesss);
			  if($a && !$all){
					$con = explode($pagesss, $body);
			  	if($p && $p > 0){
					  $huoniaoTag->assign('detail_body', $con[$p-1]);
					}else{
						$huoniaoTag->assign('detail_body', $con[0]);
					}
				}else{
				  $huoniaoTag->assign('detail_body', str_replace($pagesss, "", $body));
				}
				$huoniaoTag->assign('detail_page', bodyPageList(array("body" => $body, "page" => $p)));

				//更新阅读次数
				global $dsql;
				$sql = $dsql->SetQuery("UPDATE `#@__".$service."list` SET `click` = `click` + 1 WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "update");

			}
		}else{
			header("location:".$cfg_basehost."/404.html");
		}
		return;


	//打赏结果页面
	}elseif($action == "payreturn"){
		global $dsql;

		if(!empty($ordernum)){

			//根据支付订单号查询支付结果
			$archives = $dsql->SetQuery("SELECT r.`ordernum`, r.`aid`, r.`date`, r.`state`, r.`amount` FROM `#@__pay_log` l LEFT JOIN `#@__member_reward` r ON r.`ordernum` = l.`body` WHERE r.`module` = 'article' AND l.`ordernum` = '$ordernum'");
			$payDetail  = $dsql->dsqlOper($archives, "results");
			if($payDetail){

				$title = "";
				$sql = $dsql->SetQuery("SELECT `title` FROM `#@__articlelist` WHERE `id` = ".$payDetail[0]['aid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$title = $ret[0]['title'];
				}

				$param = array(
					"service"     => "article",
					"template"    => "detail",
					"id"          => $payDetail[0]['aid']
				);
				$url = getUrlPath($param);

				$huoniaoTag->assign('state', $payDetail[0]['state']);
				$huoniaoTag->assign('ordernum', $payDetail[0]['ordernum']);
				$huoniaoTag->assign('title', $title);
				$huoniaoTag->assign('url', $url);
				$huoniaoTag->assign('date', $payDetail[0]['date']);
				$huoniaoTag->assign('amount', sprintf("%.2f", $payDetail[0]['amount']));

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
