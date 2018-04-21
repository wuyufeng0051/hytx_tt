<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 系统模块API接口
 *
 * @version        $Id: siteConfig.class.php 2014-3-20 下午17:56:16 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class siteConfig {
	private $param;  //参数

	/**
     * 构造函数
	 *
     * @param string $action 动作名
     */
    public function __construct($param = array()){
		$this->param = $param;
	}

	/**
     * 系统基本参数
     * @return array
     */
	public function config(){

		global $cfg_basehost;        //网站域名
		global $cfg_webname;         //网站名称
		global $cfg_shortname;       //简称
		global $cfg_fileUrl;         //网站附件地址
		global $cfg_weblogo;         //网站logo地址
		global $cfg_keywords;        //网站关键字
		global $cfg_description;     //网站描述
		global $cfg_beian;           //网站ICP备案号
		global $cfg_hotline;         //网站咨询热线
		global $cfg_powerby;         //网站版权信息
		global $cfg_statisticscode;  //统计代码
		global $cfg_visitState;      //网站运营状态
		global $cfg_visitMessage;    //禁用时的说明信息
		global $cfg_timeZone;        //网站默认时区
		global $cfg_mapCity;         //地图默认城市
		global $cfg_map;             //地图配置
		global $cfg_map_google;      //google密钥
		global $cfg_map_baidu;       //百度密钥
		global $cfg_map_qq;          //腾讯密钥
		global $cfg_map_amap;        //高德密钥
		global $cfg_template;        //首页风格
		global $cfg_touchTemplate;   //首页风格
		global $cfg_softSize;        //附件上传限制大小
		global $cfg_softType;        //附件上传类型限制
		global $cfg_thumbSize;       //缩略图上传限制大小
		global $cfg_thumbType;       //缩略图上传类型限制
		global $cfg_atlasSize;       //图集上传限制大小
		global $cfg_atlasType;       //图集上传类型限制
		global $cfg_photoSize;       //头像上传限制大小
		global $cfg_photoType;       //头像上传类型限制

		$cfg_weblogo = getFilePath($cfg_weblogo);
		$params = !empty($this->param) && !is_array($this->param) ? explode(',',$this->param) : "";

		switch ($cfg_map) {
			case 1:
				$cfg_map_key = $cfg_map_google;
				break;
			case 2:
				$cfg_map_key = $cfg_map_baidu;
				break;
			case 3:
				$cfg_map_key = $cfg_map_qq;
				break;
			case 4:
				$cfg_map_key = $cfg_map_amap;
				break;
			default:
				$cfg_map_key = $cfg_map_baidu;
				break;
		}

		$return = array();
		if(!empty($params) > 0){

			foreach($params as $key => $param){
				if($param == "baseHost"){
					$return['baseHost'] = $cfg_basehost;
				}elseif($param == "webName"){
					$return['webName'] = $cfg_webname;
				}elseif($param == "shortName"){
					$return['shortName'] = $cfg_shortname;
				}elseif($param == "webLogo"){
					$return['webLogo'] = $cfg_weblogo;
				}elseif($param == "keywords"){
					$return['keywords'] = $cfg_keywords;
				}elseif($param == "description"){
					$return['description'] = $cfg_description;
				}elseif($param == "beian"){
					$return['beian'] = $cfg_beian;
				}elseif($param == "hotline"){
					$return['hotline'] = $cfg_hotline;
				}elseif($param == "powerby"){
					$return['powerby'] = $cfg_powerby;
				}elseif($param == "statisticscode"){
					$return['statisticscode'] = $cfg_statisticscode;
				}elseif($param == "visitState"){
					$return['visitState'] = $cfg_visitState;
				}elseif($param == "visitMessage"){
					$return['visitMessage'] = $cfg_visitMessage;
				}elseif($param == "timeZone"){
					$return['timeZone'] = $cfg_timeZone;
				}elseif($param == "mapCity"){
					$return['mapCity'] = $cfg_mapCity;
				}elseif($param == "map"){
					$return['map'] = $cfg_map;
				}elseif($param == "mapKey"){
					$return['mapKey'] = $cfg_map_key;
				}elseif($param == "template"){
					$return['template'] = $cfg_template;
				}elseif($param == "touchTemplate"){
					$return['touchTemplate'] = $cfg_touchTemplate;
				}elseif($param == "softSize"){
					$return['softSize'] = $cfg_softSize;
				}elseif($param == "softType"){
					$return['softType'] = $cfg_softType;
				}elseif($param == "thumbSize"){
					$return['thumbSize'] = $cfg_thumbSize;
				}elseif($param == "thumbType"){
					$return['thumbType'] = $cfg_thumbType;
				}elseif($param == "atlasSize"){
					$return['atlasSize'] = $cfg_atlasSize;
				}elseif($param == "atlasType"){
					$return['atlasType'] = $cfg_atlasType;
				}elseif($param == "photoSize"){
					$return['photoSize'] = $cfg_photoSize;
				}elseif($param == "photoType"){
					$return['photoType'] = $cfg_photoType;
				}
			}

		}else{
			$return['baseHost']       = $cfg_basehost;
			$return['webName']        = $cfg_webname;
			$return['shortName']      = $cfg_shortname;
			$return['webLogo']        = $cfg_weblogo;
			$return['keywords']       = $cfg_keywords;
			$return['description']    = $cfg_description;
			$return['beian']          = $cfg_beian;
			$return['hotline']        = $cfg_hotline;
			$return['powerby']        = $cfg_powerby;
			$return['statisticscode'] = $cfg_statisticscode;
			$return['visitState']     = $cfg_visitState;
			$return['visitMessage']   = $cfg_visitMessage;
			$return['timeZone']       = $cfg_timeZone;
			$return['mapCity']        = $cfg_mapCity;
			$return['map']            = $cfg_map;
			$return['mapKey']         = $cfg_map_key;
			$return['template']       = $cfg_template;
			$return['touchTemplate']  = $cfg_touchTemplate;
			$return['softSize']       = $cfg_softSize;
			$return['softType']       = $cfg_softType;
			$return['thumbSize']      = $cfg_thumbSize;
			$return['thumbType']      = $cfg_thumbType;
			$return['atlasSize']      = $cfg_atlasSize;
			$return['atlasType']      = $cfg_atlasType;
			$return['photoSize']      = $cfg_photoSize;
			$return['photoType']      = $cfg_photoType;
		}

		return $return;

	}


	/**
     * 系统所有模块
     * @return array
     */
	public function siteModule(){
		global $dsql;

		$moduleArr = array();
		$config_path = HUONIAOINC."/config/";

		$sql = $dsql->SetQuery("SELECT `title`, `name` FROM `#@__site_module` WHERE `state` = 0 ORDER BY `weight`, `id`");
		$result = $dsql->dsqlOper($sql, "results");
		if($result){
			foreach ($result as $key => $value) {
				if(!empty($value['name'])){
					$sName = $value['name'];

					//引入配置文件
					$serviceInc = $config_path.$sName.".inc.php";
					if(file_exists($serviceInc)){
						require($serviceInc);
					}

					//重置自定义配置
					$subDomain = $customSubDomain;
					global $customSubDomain;
					$customSubDomain = $subDomain;

					//获取功能模块配置参数
					$configHandels = new handlers($sName, "config");
					$moduleConfig  = $configHandels->getHandle();


					if(is_array($moduleConfig) && $moduleConfig['state'] == 100){
						$moduleConfig  = $moduleConfig['info'];

						$moduleArr[] = array(
							"name" => $value['title'],
							"code" => $value['name'],
							"url" => $moduleConfig['channelDomain']
						);

						//新闻频道增加图片频道
						// if($sName == "article"){
						// 	$sName = "pic";
						//
						// 	//引入配置文件
						// 	$serviceInc = $config_path.$sName.".inc.php";
						// 	if(file_exists($serviceInc)){
						// 		require($serviceInc);
						// 	}
						//
						// 	//获取功能模块配置参数
						// 	$configHandels = new handlers($sName, "config");
						// 	$moduleConfig  = $configHandels->getHandle();
						//
						// 	if(is_array($moduleConfig) && $moduleConfig['state'] == 100){
						// 		$moduleConfig  = $moduleConfig['info'];
						//
						// 		$moduleArr[] = array(
						// 			"name" => "图片",
						// 			"url" => $moduleConfig['channelDomain']
						// 		);
						// 	}
						// }

					}
				}
			}
		}

		return $moduleArr;
	}


	/**
     * 安全配置参数
     * @return array
     */
	public function safe(){

		global $cfg_regstatus;        //会员注册开关
		global $cfg_regclosemessage;  //会员注册关闭原因
		global $cfg_replacestr;       //敏感词过滤
		global $cfg_seccodestatus;    //启用验证码的功能
		global $cfg_secqaastatus;     //启用验证问题的功能
		$params = !empty($this->param) && !is_array($this->param) ? explode(',',$this->param) : "";

		$return = array();
		if(!empty($params)){

			foreach($params as $key => $param){
				if($param == "regstatus"){
					$return['regstatus'] = $cfg_regstatus;
				}elseif($param == "regclosemessage"){
					$return['regclosemessage'] = $cfg_regclosemessage;
				}elseif($param == "replacestr"){
					$return['replacestr'] = $cfg_replacestr;
				}elseif($param == "seccodestatus"){
					$return['seccodestatus'] = $cfg_seccodestatus;
				}elseif($param == "secqaastatus"){
					$return['secqaastatus'] = $cfg_secqaastatus;
				}elseif($param == "safeqa"){
					$return['safeqa'] = $this->safeqa();
				}
			}

		}else{
			$return['regstatus'] = $cfg_regstatus;
			$return['regclosemessage'] = $cfg_regclosemessage;
			$return['replacestr'] = $cfg_replacestr;
			$return['seccodestatus'] = $cfg_seccodestatus;
			$return['secqaastatus'] = $cfg_secqaastatus;
			$return['safeqa'] = $this->safeqa();
		}

		return $return;

	}


	/**
     * 验证问题数据
     * @return array
     */
	public function safeqa(){
		global $dsql;
		$archives = $dsql->SetQuery("SELECT `id`, `question`, `answer` FROM `#@__safeqa`");
		$results = $dsql->dsqlOper($archives, "results");
		return $results;
	}


	/**
     * 支付方式
     * @return array
     */
	public function payment(){
		global $dsql;

		$archives = $dsql->SetQuery("SELECT `id`, `pay_code`, `pay_name`, `pay_desc` FROM `#@__site_payment` WHERE `state` = 1 ORDER BY `weight`, `id` DESC");
		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}
	}


	/**
     * 网站地区
     * @return array
     */
	public function addr(){
		global $dsql;
		$type = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type     = (int)$this->param['type'];
				$page     = (int)$this->param['page'];
				$pageSize = (int)$this->param['pageSize'];
				$son      = $this->param['son'] == 0 ? false : true;
			}
		}
		$results = $dsql->getTypeList($type, "site_area", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 网站地区
     * @return array
     */
	public function area(){
		global $dsql;
		$type = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type     = (int)$this->param['type'];
				$page     = (int)$this->param['page'];
				$pageSize = (int)$this->param['pageSize'];
				$son      = $this->param['son'] == 0 ? false : true;
			}
		}
		$results = $dsql->getTypeList($type, "site_area", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 地铁线路
     * @return array
     */
	public function subway(){
		global $dsql;
		$city = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$city = (int)$this->param['city'];
			}
		}

		if(empty($city)) return array("state" => 200, "info" => '格式错误！');

		$sql = $dsql->SetQuery("SELECT * FROM `#@__site_subway` WHERE `cid` = $city ORDER BY `weight`");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			return $ret;
		}
	}


	/**
     * 地铁站点
     * @return array
     */
	public function subwayStation(){
		global $dsql;
		$type = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type = (int)$this->param['type'];
			}
		}

		if(empty($type)) return array("state" => 200, "info" => '格式错误！');

		$sql = $dsql->SetQuery("SELECT * FROM `#@__site_subway_station` WHERE `sid` = $type ORDER BY `weight`");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			return $ret;
		}
	}


	/**
     * 已安装模块信息
     * @return array
     */
	public function module(){
		global $dsql;

		$archives = $dsql->SetQuery("SELECT `id`, `icon`, `title`, `name`  FROM `#@__site_module` WHERE `state` = 0 AND `parentid` != 0 ORDER BY `weight`, `id`");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}
	}


	/**
	 * 热门关键词
	 */
	public function hotkeywords(){
		$module = $this->param['module'];
		$list = array();
		if($module){
			global $dsql;
			$archives = $dsql->SetQuery("SELECT `keyword`, `color`, `href`, `blod`  FROM `#@__site_hotkeywords` WHERE `state` = 0 AND `module` = '$module' ORDER BY `weight` DESC, `id` DESC");
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){

				$param = array(
					"service"  => $module,
					"template" => "search",
					"param"    => "keyword=%key%"
				);
				$urlParam = getUrlPath($param);

				foreach ($results as $key => $value) {
					$keyword = $value['keyword'];
					if(!empty($value['color'])){
						$keyword = '<font color="'.$value['color'].'">'.$keyword.'</font>';
					}
					if($value['blod'] == 1){
						$keyword = '<strong>'.$keyword.'</strong>';
					}
					$list[$key]['keyword'] = $keyword;

					$url = $value['href'];
					if(empty($url)){
						$url = str_replace("%key%", $value['keyword'], $urlParam);
					}
					$list[$key]['href'] = $url;
					$list[$key]['target'] = $value['target'];
				}
			}
		}
		return $list;
	}


	/**
     * 单页文档
     * @return array
     */
	public function singel(){
		global $dsql;
		$page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = (int)$this->param['page'];
				$pageSize = (int)$this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 999 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$archives = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__site_singellist` WHERE `type` = 'singel' ORDER BY `id` ASC".$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}
	}


	/**
     * 单页文档内容
     * @return array
     */
	public function singelDetail(){
		global $dsql;
		$singeDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '信息ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `title`, `body`, `pubdate` FROM `#@__site_singellist` WHERE `type` = 'singel' AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$singeDetail["title"]   = $results[0]['title'];
			$singeDetail["body"]    = $results[0]['body'];
			$singeDetail["pubdate"] = $results[0]['pubdate'];
		}
		return $singeDetail;
	}


	/**
     * 网站公告
     * @return array
     */
	public function notice(){
		global $dsql;
		$pageinfo = $list = array();
		$page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `color`, `redirecturl`, `pubdate` FROM `#@__site_noticelist` WHERE `arcrank` = 0 ORDER BY `weight` DESC, `id` DESC");
		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where, "results");
		return array("pageInfo" => $pageinfo, "list" => $results);
	}


	/**
     * 公告内容
     * @return array
     */
	public function noticeDetail(){
		global $dsql;
		$noticeDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '公告ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `title`, `color`, `redirecturl`, `body`, `pubdate` FROM `#@__site_noticelist` WHERE `arcrank` = 0 AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$noticeDetail["title"]       = $results[0]['title'];
			$noticeDetail["color"]       = $results[0]['color'];
			$noticeDetail["redirecturl"] = $results[0]['redirecturl'];
			$noticeDetail["body"]        = $results[0]['body'];
			$noticeDetail["pubdate"]     = $results[0]['pubdate'];
		}
		return $noticeDetail;
	}


	/**
     * 帮助信息
     * @return array
     */
	public function helps(){
		global $dsql;
		$pageinfo = $list = array();
		$typeid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "site_helpstype")){
				$lower = arr_foreach($dsql->getTypeList($typeid, "site_helpstype"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `pubdate` FROM `#@__site_helpslist` WHERE `arcrank` = 0".$where." ORDER BY `weight` DESC, `id` DESC");
		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$list = array();
		$results = $dsql->dsqlOper($archives.$where, "results");
		if($results){
			foreach ($results as $key => $value) {
				$list[$key]['id'] = $value['id'];
				$list[$key]['title'] = $value['title'];
				$list[$key]['pubdate'] = $value['pubdate'];

				$param = array(
					"service"     => "siteConfig",
					"template"    => "help-detail",
					"id"          => $value['id']
				);
				$list[$key]['url'] = getUrlPath($param);
			}
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 帮助信息详细
     * @return array
     */
	public function helpsDetail(){
		global $dsql;
		$helpsDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '信息ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `title`, `typeid`, `body`, `pubdate` FROM `#@__site_helpslist` WHERE `arcrank` = 0 AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$helpsDetail["title"]       = $results[0]['title'];
			$helpsDetail["typeid"]      = $results[0]['typeid'];
			$helpsDetail["body"]        = $results[0]['body'];
			$helpsDetail["pubdate"]     = $results[0]['pubdate'];
		}
		return $helpsDetail;
	}


	/**
     * 帮助信息分类
     * @return array
     */
	public function helpsType(){
		global $dsql;
		$type = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type     = (int)$this->param['type'];
				$page     = (int)$this->param['page'];
				$pageSize = (int)$this->param['pageSize'];
				$son      = $this->param['son'] == 0 ? false : true;
			}
		}
		$results = $dsql->getTypeList($type, "site_helpstype", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 网站协议
     * @return array
     */
	public function agree(){
		global $dsql;

		if(empty($this->param)){
			return array("state" => 200, "info" => '协议ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `title`, `body` FROM `#@__site_singellist` WHERE `type` = 'agree' AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		return $results;
	}


	/**
     * 网站广告
     * @return array
     */
	public function adv(){
		global $dsql;

		$param = $this->param;

		//普通模式
		if(is_numeric($param)){
			$id = $param;

		//分站广告
		}else{
			$model = $param['model'];
			$title = $param['title'];
			if($model != "" && $title != ""){

				//团购
				if($model == 'tuan'){
					$tuanService = new tuan();
					$domainInfo = $tuanService->getCity();
					if(empty($domainInfo)) return array("state" => 200, "info" => '城市不存在！');

					$cityid = $domainInfo['cid'];

					$sql = $dsql->SetQuery("SELECT `id` FROM `#@__advlist` WHERE `cityid` = $cityid AND `title` = '$title'");
					$ret = $dsql->dsqlOper($sql, "results");
					if(!$ret) return array("state" => 200, "info" => '广告不存在！');
					$id = $ret[0]['id'];
				}

			//其他类型
			}else{
				$id = $param['id'];
			}
		}


		if(empty($id)){
			return array("state" => 200, "info" => '广告ID不得为空！');
		}

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$adlist = array();
		$archives = $dsql->SetQuery("SELECT `class`, `title`, `starttime`, `endtime`, `body`, `state` FROM `#@__advlist` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$cla   = $results[0]['class'];
			$title = $results[0]['title'];
			$start = $results[0]['starttime'];
			$end   = $results[0]['endtime'];
			$body  = $results[0]['body'];
			$state = $results[0]['state'];
			$date  = GetMkTime(time());

			if($state != 1) return array("state" => 200, "info" => '广告已隐藏！');
			if($date < $start && !empty($start)) return array("state" => 200, "info" => '广告还未开始！');
			if($date > $end && !empty($end)) return array("state" => 200, "info" => '广告已结束！');

			$adlist['class'] = $cla;
			$body = explode("$$", $body);

			//普通广告
			if($cla == 1){
				$adlist['type'] = $body[0];

				//代码
				if($body[0] == "code"){
					$adlist['body'] = $body[1];

				//文字
				}elseif($body[0] == "text"){
					$adlist['title'] = $body[1];
					$adlist['color'] = $body[2];
					$adlist['link']  = $body[3];
					$adlist['size']  = $body[4];

				//图片
				}elseif($body[0] == "pic"){
					$adlist['src']    = $body[1];
					$adlist['href']   = $body[2];
					$adlist['title']  = $body[3];
					$adlist['width']  = $body[4];
					$adlist['height'] = $body[5];

				//flash
				}elseif($body[0] == "flash"){
					$adlist['src']    = $body[1];
					$adlist['width']  = $body[2];
					$adlist['height'] = $body[3];

				}

			//多图广告
			}elseif($cla == 2){
				$adlist['width']  = $body[0];
				$adlist['height'] = $body[1];
				$list = explode("||", $body[2]);
				foreach ($list as $key => $value) {
					$bod = explode("##", $value);
					$adlist['list'][$key]['src']   = $bod[0];
					$adlist['list'][$key]['title'] = $bod[1];
					$adlist['list'][$key]['link']  = $bod[2];
					$adlist['list'][$key]['desc']  = $bod[3];
				}

			//伸缩广告
			}elseif($cla == 3){
				$adlist['time']  = $body[0];
				$adlist['width']  = $body[1];
				$adlist['link']  = $body[2];
				$adlist['large'] = $body[3];
				$adlist['largeHeight'] = $body[4];
				$adlist['small'] = $body[5];
				$adlist['smallHeight'] = $body[6];

			//对联广告
			}elseif($cla == 4){
				$adlist['width']  = $body[0];
				$adlist['adwidth']  = $body[1];
				$adlist['adheight']  = $body[2];
				$adlist['topheight']  = $body[3];
				$left  = explode("##", $body[4]);
				$adlist['left']['src']   = $left[0];
				$adlist['left']['link']  = $left[1];
				$adlist['left']['title'] = $left[2];
				$right = explode("##", $body[5]);
				$adlist['right']['src']   = $right[0];
				$adlist['right']['link']  = $right[1];
				$adlist['right']['title'] = $right[2];

			}

		}
		return $adlist;
	}


	/**
     * 友情链接分类
     * @return array
     */
	public function friendLinkType(){
		global $dsql;
		$module = $this->param;

		if(empty($module)){
			return array("state" => 200, "info" => '模块名为空！');
		}

		$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__site_friendlinktype` WHERE `model` = '$module' ORDER BY `weight` DESC, `id` DESC");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}
	}


	/**
     * 友情链接
     * @return array
     */
	public function friendLink(){
		global $dsql;
		$param = $this->param;
		$list = array();
		$where = "";

		$module = $param['module'];
		$type = $param['type'];

		if(empty($module)){
			return array("state" => 200, "info" => '模块名为空！');
		}

		//遍历分类
		if(!empty($type)){
			if($dsql->getTypeList($type, "site_friendlinktype")){
				$lower = arr_foreach($dsql->getTypeList($type, "site_friendlinktype"));
				$lower = $type.",".join(',',$lower);
			}else{
				$lower = $type;
			}
			$where .= " AND `type` in ($lower)";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `sitename`, `sitelink`, `litpic` FROM `#@__site_friendlinklist` WHERE `module` = '$module'".$where." ORDER BY `weight` DESC, `id` DESC");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			global $cfg_fileUrl;
			foreach($results as $key => $val){
				$list[$key]['id']       = $val['id'];
				$list[$key]['sitename'] = $val['sitename'];
				$list[$key]['sitelink'] = $val['sitelink'];
				$list[$key]['litpic']   = !empty($val['litpic']) ? $cfg_fileUrl.$val['litpic'] : "";
			}
			return $list;
		}
	}


	/**
	 * 自动提取关键词、描述
	 * @param $type  提取类型 keywords: 关键词  description: 描述
	 * @param $body  需要提取的内容
	 * @return string
	 */
	public function autoget(){
		$param = $this->param;
		$type = $param['type'];
		$body = $param['body'];

		if(!empty($type) && !empty($body)){

			$title = $keywords = $description = "";
			$return = AnalyseHtmlBody($body, $description, $keywords);

			if($type == "keywords"){
				return $keywords;
			}else{
				return $description;
			}

		}
	}


	/**
	 * 获取天气预报
	 *
	 */
	public function getWeatherApi(){
		$param = $this->param;

		$weatherInfo = getWeather($param, $smarty);
		return $weatherInfo;
	}


	/**
     * 发送邮件
     * @return array
     */
	public function sendMail(){
		$param = $this->param;

		$email     = $param['email'];
		$mailtitle = $param['mailtitle'];
		$mailbody  = $param['mailbody'];

		if(empty($email) || empty($mailtitle) || empty($mailbody)){
			return array("state" => 200, "info" => '必填项不得为空！');
		}

		//发送邮件
		$sendmail = sendmail($email, $mailtitle, $mailbody);
		if($sendmail != ""){
			return "200";
		}else{
			return "发送成功！";
		}

	}


	/**
		* 判断输入的验证码是否正确
		* @return array
		*/
	public function checkVdimgck(){
		$param = $this->param;
		$code = $param['code'];

		$code = strtolower($code);
		if($code != $_SESSION['huoniao_vdimg_value']){
			return "error";
		}else{
			return "ok";
		}
	}


	/**
		* 发送手机验证码
		* @return array
		*/
	public function getPhoneVerify(){
		$param = $this->param;

		global $dsql;
		global $userLogin;
		global $cfg_shortname;
		global $cfg_hotline;
		global $cfg_geetest;
		global $cfg_geetest;

		//获取用户ID
		$uid = $userLogin->getMemberID();
		$ip  = GetIP();
		$now = GetMkTime(time());
		$has = false;

		if(!is_array($param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$type  = $param['type'];
			$phone = $param['phone'];
		}

		//如果是进行身份验证，需要进行登录验证，并获取登录用户的手机号码
		if($type == "auth"){
			if($uid == -1) return array("state" => 200, "info" => '登录超时，请刷新页面重新登录！');
			$memberInfo = $userLogin->getMemberInfo();
			$phone = $memberInfo['phone'];
		}

		// $terminal = isMobile() ? "mobile" : "pc";

		//如果是注册，需要验证邮箱是否被注册
		if($type == "signup"){

			//如果开启了极验
			if($cfg_geetest){
				$geetest_challenge = $param['geetest_challenge'];
				$geetest_validate  = $param['geetest_validate'];
				$geetest_seccode   = $param['geetest_seccode'];
				$terminal          = $param['terminal'];
				$terminal = empty($terminal) ? "pc" : $terminal;

				$verifyGeetest = json_decode(verifyGeetest($geetest_challenge, $geetest_validate, $geetest_seccode, $terminal), true);
				if(!is_array($verifyGeetest) || $verifyGeetest['status'] == 'fail'){
					return array("state" => 200, "info" => '图形验证错误，请重试！');
				}
			}

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `phone` = '$phone'");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results > 0) return array("state" => 200, "info" => '该手机号码已经注册过会员！');
		}

		//如果是找回密码，需要验证手机号码是否存在
		if($type == "fpwd"){

			$vericode = $param['vericode']; //验证码

			//如果开启了极验
			if($cfg_geetest){
				$geetest_challenge = $param['geetest_challenge'];
				$geetest_validate  = $param['geetest_validate'];
				$geetest_seccode   = $param['geetest_seccode'];
				$terminal          = $param['terminal'];
				$terminal = empty($terminal) ? "pc" : $terminal;

				$verifyGeetest = json_decode(verifyGeetest($geetest_challenge, $geetest_validate, $geetest_seccode, $terminal), true);
				if(!is_array($verifyGeetest) || $verifyGeetest['status'] == 'fail'){
					return array("state" => 200, "info" => '图形验证错误，请重试！');
				}
			}
			else{
				if(strtolower($vericode) != $_SESSION['huoniao_vdimg_value'] && !$isend) return array("state" => 200, "info" => '验证码输入错误，请重试！');
			}

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `phone` = '$phone'");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results == 0) return array("state" => 200, "info" => '该手机号码没有注册过会员！');
		}

		if(empty($type) || empty($phone)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'phone' AND `by` = '$uid' AND `lei` = '$type' AND `user` = '$phone'");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$has = true;
			$time = $now - $results[0]['time'];
			if($time < 60){
				return array("state" => 200, "info" => '您的发送频率太快，请'.(60-$time).'秒后稍候重试！');
			}
		}

		$content = "";
		$code = $rand_num = rand(100000, 999999);

		//手机认证
		if($type == "verify"){
			$smsTemp = "会员-手机邮箱绑定-发送验证码";
			//$content = "校验码".$code."，您正在进行手机绑定，工作人员不会向您索取，请勿泄漏。如有疑问请致电".$cfg_hotline."。";

		//注册验证
		}elseif($type == "signup"){
			$smsTemp = "会员-注册验证-发送验证码";
			//$content = "校验码".$code."，您正在进行身份验证，工作人员不会向您索取，请勿泄漏。如有疑问请致电".$cfg_hotline."。";

		//身份验证
		}elseif($type == "auth"){
			$smsTemp = "会员-安全验证-发送验证码";
			//$content = "校验码".$code."，您正在进行身份验证，工作人员不会向您索取，请勿泄漏。如有疑问请致电".$cfg_hotline."。";

		//找回密码
		}elseif($type == "fpwd"){
			$smsTemp = "会员-找回密码-发送验证码";
			//$content = "校验码".$code."，工作人员不会向您索取，请勿泄漏。如有疑问请致电".$cfg_hotline."。";

		}

		//发送短信
		if($smsTemp){
			return sendsms($phone, 1, $code, $type, $has, false, $smsTemp);
		}

		//获取短信内容
		// $content = "";
		// $contentTpl = getInfoTempContent("sms", $smsTempId, array("code" => $code));
		// if($contentTpl){
		// 	$content = $contentTpl['content'];
		// }
		//
		// //调用发送短信接口
		// include_once(HUONIAOINC."/class/sms.class.php");
		// $sms = new sms($dbo);
		// $return = $sms->send($phone, $content);
		//
		// if($return == "ok"){
		// 	if($has){
		// 		$archives = $dsql->SetQuery("UPDATE `#@__site_messagelog` SET `code` = '$code', `body` = '$content', `pubdate` = '$now', `ip` = '$ip' WHERE `type` = 'phone' AND `lei` = '$type' AND `user` = '$phone'");
		// 		$results  = $dsql->dsqlOper($archives, "update");
		// 	}else{
		// 		messageLog("phone", $type, $phone, $title, $content, $uid, 0, $code);
		// 	}
		// 	return "ok";
		//
		// }else{
		// 	messageLog("phone", $type, $phone, $title, $content, $uid, 1, $code);
		// 	return array("state" => 200, "info" => '验证码发送失败，请重试！');
		// }

	}


	/**
		* 发送邮箱验证码
		* @return array
		*/
	public function getEmailVerify(){
		$param = $this->param;

		global $dsql;
		global $userLogin;
		global $cfg_shortname;
		global $cfg_hotline;
		global $cfg_webname;
		global $cfg_geetest;

		//获取用户ID
		$uid = $userLogin->getMemberID();
		$ip  = GetIP();
		$now = GetMkTime(time());
		$has = false;

		if(!is_array($param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$type  = $param['type'];
			$email = $param['email'];
		}

		// $terminal = isMobile() ? "mobile" : "pc";

		//如果是进行身份验证，需要进行登录验证，并获取登录用户的手机号码
		if($type == "auth"){
			if($uid == -1) return array("state" => 200, "info" => '登录超时，请刷新页面重新登录！');
			$memberInfo = $userLogin->getMemberInfo();
			$email = $memberInfo['email'];

		//如果是注册，需要验证邮箱是否被注册
		}elseif($type == "signup"){

			//如果开启了极验
			if($cfg_geetest){
				$geetest_challenge = $param['geetest_challenge'];
				$geetest_validate  = $param['geetest_validate'];
				$geetest_seccode   = $param['geetest_seccode'];
				$terminal          = $param['terminal'];
				$terminal = empty($terminal) ? "pc" : $terminal;

				$verifyGeetest = json_decode(verifyGeetest($geetest_challenge, $geetest_validate, $geetest_seccode, $terminal), true);
				if(!is_array($verifyGeetest) || $verifyGeetest['status'] == 'fail'){
					return array("state" => 200, "info" => '图形验证错误，请重试！');
				}
			}

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `email` = '$email'");
			$results  = $dsql->dsqlOper($archives, "totalCount");
			if($results > 0) return array("state" => 200, "info" => '该邮箱地址已经注册过会员！');
		}

		if(empty($type) || empty($email)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `pubdate` FROM `#@__site_messagelog` WHERE `type` = 'email' AND `by` = '$uid' AND `lei` = '$type' AND `user` = '$email'");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$has = true;
			$time = $now - $results[0]['pubdate'];
			if($time < 60){
				return array("state" => 200, "info" => '您的发送频率太快，请'.(60-$time).'秒后稍候重试！');
			}
		}

		$title   = "";
		$content = "";
		$code = $rand_num = rand(100000, 999999);

		//身份验证
		if($type == "auth" || $type == "signup"){

			$tit = "会员-注册验证-发送验证码";
			if($type == "auth"){
				$tit = "会员-安全验证-发送验证码";
			}

			//获取邮件内容
			$cArr = getInfoTempContent("mail", $tit, array("code" => $code));

			$title = $cArr['title'];
			$content = $cArr['content'];

			// $title = $cfg_webname."-邮箱验证";
			// $content = "您正在进行邮箱验证，本次请求的验证码为：<strong>".$code."</strong>，<br /><br />为了保障您帐号的安全性，请在 48小时内完成绑定，此链接将在您绑定过后失效！<br />激活邮件将在您激活一次后失效。<br /><br />".$cfg_webname."<br />".date("Y-m-d", time())."<br /><br />如您错误的收到了此邮件，请不要点击绑定按钮。<br />这是一封系统自动发出的邮件，请不要直接回复。";
		}

		if($title == "" && $content == ""){
			return array("state" => 200, "info" => '邮件通知功能未开启，发送失败！');
		}

		//调用发送邮件接口
		$replay = sendmail($email, $title, $content);

		$content = addslashes($content);

		if(empty($replay)){

			if($has){
				$archives = $dsql->SetQuery("UPDATE `#@__site_messagelog` SET `code` = '$code', `body` = '$content', `pubdate` = '$now', `ip` = '$ip' WHERE `type` = 'email' AND `lei` = '$type' AND `user` = '$email'");
				$dsql->dsqlOper($archives, "update");
			}else{
				messageLog("email", $type, $email, $title, $content, $uid, 0, $code);
			}

			return "ok";

		}else{
			messageLog("email", $type, $email, $title, $content, $uid, 1, $code);
			return array("state" => 200, "info" => '验证码发送失败，请重试！');
		}

	}


	/**
		* 获取网站已开通的第三方登录平台
		* @return array
		*/
	public function getLoginConnect(){
		global $dsql;

		$list = array();
		$archives = $dsql->SetQuery("SELECT `id`, `code`, `name` FROM `#@__site_loginconnect` WHERE `state` = 1 ORDER BY `weight`, `id`");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['code']  = $val['code'];
				$list[$key]['name']  = $val['name'];
			}
		}

		return $list;
	}


	/**
		* 获取用户已经绑定的登录平台
		* @return array
		*/
	public function getUserBindLoginConnect(){
		global $dsql;
		global $userLogin;

		$uid = $userLogin->getMemberID();
		if($uid == -1) return array("state" => 200, "info" => '登录超时，请刷新页面重新登录！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__member` WHERE `id` = $uid");
		$results = $dsql->dsqlOper($archives, "results");
		if(!$results) return array("state" => 200, "info" => "用户不存在！");

		$open = array();
		$i = 0;
		foreach ($results[0] as $key => $value) {
			if(strstr($key, "_conn") && !empty($value)){
				$open[$i] = str_replace("_conn", "", $key);
				$i++;
			}
		}

		$list = array();
		$archives = $dsql->SetQuery("SELECT `id`, `code`, `name` FROM `#@__site_loginconnect` WHERE `state` = 1 ORDER BY `weight`, `id`");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			foreach($results as $key => $val){
				$state = 0;
				if(in_array($val['code'], $open)){
					$state = 1;
				}
				$list[$key]['state'] = $state;
				$list[$key]['code']  = $val['code'];
				$list[$key]['name']  = $val['name'];
			}
		}

		$list = array_sort($list, "state", "desc");

		return $list;
	}



	/**
		* 根据指定表、指定ID获取相关信息
		* @return array
		*/
	public function getPublicParentInfo(){
		global $dsql;
		$param = $this->param;

		$tab  = $param['tab'];
		$id   = $param['id'];

		global $data;
		$data = "";
		$typeArr = getParentArr($tab, $id);
		$ids = array_reverse(parent_foreach($typeArr, "id"));

		global $data;
		$data = "";
		$typeArr = getParentArr($tab, $id);
		$typenames = array_reverse(parent_foreach($typeArr, "typename"));

		return array(
			"ids" => $ids,
			"names" => $typenames
		);

	}

}
