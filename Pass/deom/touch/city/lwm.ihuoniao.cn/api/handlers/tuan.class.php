<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 团购模块API接口
 *
 * @version        $Id: tuan.class.php 2014-3-23 上午09:25:10 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class tuan {
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
	 * 获取当前城市信息
	 */
	public function getCity(){
		global $city;
		global $dsql;

		if(empty($city)){
			$city = GetCookie("tuan_city");
		}

		if(!empty($city)){

			$sql = $dsql->SetQuery("SELECT c.`id`, c.`type`, c.`cid`, a.`typename` FROM `#@__domain` d LEFT JOIN `#@__tuan_city` c ON c.`id` = d.`iid` LEFT JOIN `#@__site_area` a ON a.`id` = c.`cid` WHERE d.`domain` = '$city' AND d.`module` = 'tuan' AND d.`part` = 'city'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$ret = $ret[0];

				//获取频道域名
				$this->param = 'channelDomain';
				$config = $this->config();
				$customeDomain = str_replace("http://", "", $config['channelDomain']);
				$domainInfo = getDomain('tuan', 'city', $ret['id']);
				$domain = $domainInfo['domain'];
				$ndomain = "";
				if($ret['type'] == 0){
					$ndomain = $domain;
				}elseif($ret['type'] == 1){
					$ndomain = $domain.".".$customeDomain;
				}elseif($ret['type'] == 2){
					$ndomain = $customeDomain."/".$domain;
				}

				$ret['url'] = "http://".$ndomain;

				return $ret;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/**
     * 团购基本参数
     * @return array
     */
	public function config(){

		require(HUONIAOINC."/config/tuan.inc.php");

		global $cfg_fileUrl;              //系统附件默认地址
		global $cfg_uploadDir;            //系统附件默认上传目录
		// global $customFtp;                //是否自定义FTP
		// global $custom_ftpState;          //FTP是否开启
		// global $custom_ftpUrl;            //远程附件地址
		// global $custom_ftpDir;            //FTP上传目录
		// global $custom_uploadDir;         //默认上传目录
		global $cfg_basehost;             //系统主域名
		global $cfg_hotline;              //系统默认咨询热线
		// global $customAtlasMax;           //图集数量限制

		// global $customChannelName;        //模块名称
		// global $customLogo;               //logo使用方式
		global $cfg_weblogo;              //系统默认logo地址
		// global $customLogoUrl;            //logo地址
		// global $customSubDomain;          //访问方式
		// global $customChannelSwitch;      //模块状态
		// global $customCloseCause;         //模块禁用说明
		// global $customSeoTitle;           //seo标题
		// global $customSeoKeyword;         //seo关键字
		// global $customSeoDescription;     //seo描述
		global $hotline_config;           //咨询热线配置
		// global $customHotline;            //咨询热线
		// global $recMoney;                 //推荐返现金额
		// global $singelnum;                //单次购买数量限制
		// global $Tel400;                   //400电话
		// global $subscribe;                //邮件订阅
		// global $customTemplate;           //模板风格

		// global $customUpload;             //上传配置是否自定义
		global $cfg_softSize;             //系统附件上传限制大小
		global $cfg_softType;             //系统附件上传类型限制
		global $cfg_thumbSize;            //系统缩略图上传限制大小
		global $cfg_thumbType;            //系统缩略图上传类型限制
		global $cfg_atlasSize;            //系统图集上传限制大小
		global $cfg_atlasType;            //系统图集上传类型限制

		// global $custom_softSize;          //附件上传限制大小
		// global $custom_softType;          //附件上传类型限制
		// global $custom_thumbSize;         //缩略图上传限制大小
		// global $custom_thumbType;         //缩略图上传类型限制
		// global $custom_atlasSize;         //图集上传限制大小
		// global $custom_atlasType;         //图集上传类型限制

		//如果上传设置为系统默认，则以下参数使用系统默认
		if($customUpload == 0){
			$custom_softSize = $cfg_softSize;
			$custom_softType  = $cfg_softType;
			$custom_thumbSize = $cfg_thumbSize;
			$custom_thumbType = $cfg_thumbType;
			$custom_atlasSize = $cfg_atlasSize;
			$custom_atlasType = $cfg_atlasType;
		}

		$hotline = $hotline_config == 0 ? $cfg_hotline : $customHotline;

		$params = !empty($this->param) && !is_array($this->param) ? explode(',',$this->param) : "";

		// $domainInfo = getDomain('tuan', 'config');
		// $customChannelDomain = $domainInfo['domain'];
		// if($customSubDomain == 0){
		// 	$customChannelDomain = "http://".$customChannelDomain;
		// }elseif($customSubDomain == 1){
		// 	$customChannelDomain = "http://".$customChannelDomain.".".$cfg_basehost;
		// }elseif($customSubDomain == 2){
		// 	$customChannelDomain = "http://".$cfg_basehost."/".$customChannelDomain;
		// }

		include HUONIAOINC.'/siteModuleDomain.inc.php';
		$customChannelDomain = $tuanDomain;

		$return = array();
		if(!empty($params) > 0){

			foreach($params as $key => $param){
				if($param == "channelName"){
					$return['channelName'] = $customChannelName;
				}elseif($param == "logoUrl"){

					//自定义LOGO
					if($customLogo == 1){
						$customLogo = getFilePath($customLogoUrl);
					}else{
						$customLogo = getFilePath($cfg_weblogo);
					}

					$return['logoUrl'] = $customLogo;
				}elseif($param == "subDomain"){
					$return['subDomain'] = $customSubDomain;
				}elseif($param == "channelDomain"){
					$return['channelDomain'] = $customChannelDomain;
				}elseif($param == "channelSwitch"){
					$return['channelSwitch'] = $customChannelSwitch;
				}elseif($param == "closeCause"){
					$return['closeCause'] = $customCloseCause;
				}elseif($param == "title"){
					$return['title'] = $customSeoTitle;
				}elseif($param == "keywords"){
					$return['keywords'] = $customSeoKeyword;
				}elseif($param == "description"){
					$return['description'] = $customSeoDescription;
				}elseif($param == "hotline"){
					$return['hotline'] = $hotline;
				}elseif($param == "atlasMax"){
					$return['atlasMax'] = $customAtlasMax;
				}elseif($param == "recMoney"){
					$return['recMoney'] = $recMoney;
				}elseif($param == "singelnum"){
					$return['singelnum'] = $singelnum;
				}elseif($param == "Tel400"){
					$return['Tel400'] = $Tel400;
				}elseif($param == "subscribe"){
					$return['subscribe'] = $subscribe;
				}elseif($param == "template"){
					$return['template'] = $customTemplate;
				}elseif($param == "touchTemplate"){
					$return['touchTemplate'] = $customTouchTemplate;
				}elseif($param == "softSize"){
					$return['softSize'] = $custom_softSize;
				}elseif($param == "softType"){
					$return['softType'] = $custom_softType;
				}elseif($param == "thumbSize"){
					$return['thumbSize'] = $custom_thumbSize;
				}elseif($param == "thumbType"){
					$return['thumbType'] = $custom_thumbType;
				}elseif($param == "atlasSize"){
					$return['atlasSize'] = $custom_atlasSize;
				}elseif($param == "atlasType"){
					$return['atlasType'] = $custom_atlasType;
				}
			}

		}else{

			if($customLogo == 1){
				$customLogo = getFilePath($customLogoUrl);
			}else{
				$customLogo = getFilePath($cfg_weblogo);
			}

			$return['channelName']   = $customChannelName;
			$return['logoUrl']       = $customLogo;
			$return['subDomain']     = $customSubDomain;
			$return['channelDomain'] = $customChannelDomain;
			$return['channelSwitch'] = $customChannelSwitch;
			$return['closeCause']    = $customCloseCause;
			$return['title']         = $customSeoTitle;
			$return['keywords']      = $customSeoKeyword;
			$return['description']   = $customSeoDescription;
			$return['hotline']       = $hotline;
			$return['atlasMax']      = $customAtlasMax;
			$return['recMoney']      = $recMoney;
			$return['singelnum']     = $singelnum;
			$return['Tel400']        = $Tel400;
			$return['subscribe']     = $subscribe;
			$return['template']      = $customTemplate;
			$return['touchTemplate'] = $customTouchTemplate;
			$return['softSize']      = $custom_softSize;
			$return['softType']      = $custom_softType;
			$return['thumbSize']     = $custom_thumbSize;
			$return['thumbType']     = $custom_thumbType;
			$return['atlasSize']     = $custom_atlasSize;
			$return['atlasType']     = $custom_atlasType;
		}

		return $return;

	}

	/**
	 * 团购答疑
	 * @reseturn array
	 */
	public function question(){
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

		$archives = $dsql->SetQuery("SELECT * FROM `#@__tuan_question` WHERE `ischeck` = 1 ORDER BY `id` DESC");
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
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']       = $val['id'];
				$list[$key]['userid']   = $val['userid'];

				$archives = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ".$val['userid']);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$list[$key]['username']   = $member[0]['username'];
				}else{
					$list[$key]['username']   = "未知";
				}

				$list[$key]['content']  = $val['content'];
				$list[$key]['dtime']    = $val['dtime'];

				$archives = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ".$val['by']);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$list[$key]['admin']   = $member[0]['username'];
				}else{
					$list[$key]['admin']   = "未知";
				}

				$list[$key]['replay']   = $val['replay'];
				$list[$key]['rtime']    = $val['rtime'];
				$list[$key]['ip']       = $val['ip'];
				$list[$key]['ipaddr']   = $val['ipaddr'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 常见问题
     * @return array
     */
	public function faq(){
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
			if($dsql->getTypeList($typeid, "tuan_faqtype")){
				$lower = arr_foreach($dsql->getTypeList($typeid, "tuan_faqtype"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `pubdate` FROM `#@__tuan_faqlist` WHERE `arcrank` = 0".$where." ORDER BY `weight` DESC, `id` DESC");
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
     * 问题详细信息
     * @return array
     */
	public function faqDetail(){
		global $dsql;
		$faqDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '信息ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `title`, `typeid`, `body`, `pubdate` FROM `#@__tuan_faqlist` WHERE `arcrank` = 0 AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$faqDetail["title"]       = $results[0]['title'];
			$faqDetail["typeid"]      = $results[0]['typeid'];
			$faqDetail["body"]        = $results[0]['body'];
			$faqDetail["pubdate"]     = $results[0]['pubdate'];
		}
		return $faqDetail;
	}


	/**
     * 常见问题分类
     * @return array
     */
	public function faqType(){
		global $dsql;

		$type = !empty($this->param) ? $this->param : 0;
		if(!is_numeric($type)) return array("state" => 200, "info" => '格式错误！');

		$results = $dsql->getTypeList($type, "tuan_faqtype");
		if($results){
			return $results;
		}
	}


	/**
     * 团购分类
     * @return array
     */
	public function type(){
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
		$results = $dsql->getTypeList($type, "tuantype", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 团购热门分类
     * @return array
     */
	public function hotype(){
		global $dsql;
		$list = array();

		$sql = $dsql->SetQuery("SELECT * FROM `#@__tuantype` WHERE `hot` = 1 ORDER BY `id` ASC");
		$results = $dsql->dsqlOper($sql, "results");

		$list = array();
		if(count($results) > 0){

			$par = array(
				"service"  => "tuan",
				"template" => "list",
				"typeid"   => "%id%"
			);
			$urlParam = getUrlPath($par);

			foreach ($results as $key=>$value) {
				$list[$key]["id"]       = $value["id"];
				$typename = $value["typename"];
				if(!empty($value["color"])){
					$typename = '<font color="'.$value["color"].'">'.$typename.'</font>';
				}
				$list[$key]["typename"] = $typename;
				$list[$key]["url"]      = str_replace("%id%", $value['id'], $urlParam);
			}
		}
		return $list;
	}


	/**
     * 团购分类详细信息
     * @return array
     */
	public function typeDetail(){
		global $dsql;
		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `id`, `parentid`, `typename`, `seotitle`, `keywords`, `description` FROM `#@__tuantype` WHERE `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$itemid = $results[0]['id'];
			if($results[0]['parentid'] != 0){
				$itemid = $results[0]['parentid'];
			}
			$archives = $dsql->SetQuery("SELECT `id`, `title`, `options` FROM `#@__tuantypeitem` WHERE `tid` = ".$itemid." AND `formtype` != 'text' ORDER BY `orderby` DESC, `id` DESC");
			$typeitem = $dsql->dsqlOper($archives, "results");
			if($typeitem){
				foreach($typeitem as $key => $item){
					$results[0]["item"][$key]['id']    = $item['id'];
					$results[0]["item"][$key]['title'] = $item['title'];
					if($item["options"] != ""){
						$options = join('|', preg_split("[\r\n]", $item["options"]));
						$results[0]["item"][$key]['options'] = $options;
					}
				}
			}
			return $results;
		}

	}


	/**
     * 分类字段
     * @return array
     */
	public function typeItem(){
		global $dsql;

		$typeid = $this->param['typeid'];
		if(!is_numeric($typeid)) return array("state" => 200, "info" => '格式错误！');

		$checktype = $dsql->SetQuery("SELECT `parentid` FROM `#@__tuantype` WHERE `id` = ".$typeid);
		$typeResults = $dsql->dsqlOper($checktype, "results");
		$tt = $typeResults[0]['parentid'] != 0 ? $typeResults[0]['parentid'] : $typeid;

		$infoitem = $dsql->SetQuery("SELECT `id`, `title`, `field`, `options` FROM `#@__tuantypeitem` WHERE `tid` = ".$tt." ORDER BY `orderby` DESC");
		$itemResults = $dsql->dsqlOper($infoitem, "results");

		$list = array();
		if(count($itemResults) > 0){
			foreach ($itemResults as $key=>$value) {
				$options = array();
				if($value["options"] != ""){
					$options = preg_split("[\r\n]", $value["options"]);
				}

				$list[$key]["id"]      = $value["id"];
				$list[$key]["title"]   = $value["title"];
				$list[$key]["field"]   = $value["field"];
				$list[$key]["options"] = $options;
			}
		}
		return $list;
	}


	/**
	 * 已开通的城市
	 */
	public function city(){
		global $dsql;
		global $cfg_basehost;
		global $customSubDomain;

		$sql = $dsql->SetQuery("SELECT c.*, a.`typename` FROM `#@__tuan_city` c LEFT JOIN `#@__site_area` a ON a.`id` = c.`cid` ORDER BY c.`id`");
		$ret = $dsql->dsqlOper($sql, "results");
		$list = array();
		if($ret){

			//获取频道域名
			$this->param = 'channelDomain';
			$config = $this->config();
			$customeDomain = str_replace("http://", "", $config['channelDomain']);

			foreach ($ret as $key => $value) {
				$domainInfo = getDomain('tuan', 'city', $value['id']);
				$domain = $domainInfo['domain'];
				$ndomain = "";
				if($value['type'] == 0){
					$ndomain = $domain;
				}elseif($value['type'] == 1){
					$ndomain = $domain.".".$customeDomain;
				}elseif($value['type'] == 2){
					$ndomain = $customeDomain."/".$domain;
				}

				$list[$key]['id']   = $value['id'];
				$list[$key]['url']  = "http://".$ndomain;
				$list[$key]['name'] = $value['typename'];
			}
		}
		return $list;
	}


	/**
     * 团购地区
     * @return array
     */
	public function addr(){
		global $dsql;
		$store = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$store    = (int)$this->param['store'];
				$page     = (int)$this->param['page'];
				$pageSize = (int)$this->param['pageSize'];
				$son      = $this->param['son'] == 0 ? false : true;
			}
		}

		$cityInfo = $this->getCity();
		if($cityInfo || $store){

			$page = (int)$page;
			$pageSize = (int)$pageSize;

			$page = empty($page) ? 1 : $page;
			$pageSize = empty($pageSize) ? 1000 : $pageSize;
			$atpage = $pageSize*($page-1);
			$where = " LIMIT $atpage, $pageSize";

			$ret = array();
			if($store){
				$sql = $dsql->SetQuery("SELECT c.*, a.`typename` FROM `#@__tuan_city` c LEFT JOIN `#@__site_area` a ON a.`id` = c.`cid` ORDER BY c.`id`");
				$results = $dsql->dsqlOper($sql, "results");
				if($results){
					foreach ($results as $key => $value) {
						$ret[$key]['id'] = $value['cid'];
						$ret[$key]['typename'] = $value['typename'];

						// $sql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__site_area` WHERE `parentid` = ".$value['cid']." ORDER BY `weight`");
						// $res = $dsql->dsqlOper($sql, "results");
						// $addrListArr[$key]['lower'] = $res;
					}
				}

			}else{
				$sql = $dsql->SetQuery("SELECT * FROM `#@__site_area` WHERE `parentid` = ".$cityInfo['cid']." ORDER BY `weight`".$where);
				$ret = $dsql->dsqlOper($sql, "results");
			}
			if($ret){
				return $ret;
			}
		}
	}


	/**
     * 商圈
     * @return array
     */
	public function circle(){
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

		if(empty($type)) return array("state" => 200, "info" => '格式错误！');

		$page = (int)$page;
		$pageSize = (int)$pageSize;

		$page = empty($page) ? 1 : $page;
		$pageSize = empty($pageSize) ? 1000 : $pageSize;
		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$sql = $dsql->SetQuery("SELECT * FROM `#@__tuan_circle` WHERE `qid` = $type".$where);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			return $ret;
		}
	}


	/**
     * 团购热门商圈
     * @return array
     */
	public function hotCircle(){
		global $dsql;
		$list = array();

		$cityInfo = $this->getCity();
		$sql = $dsql->SetQuery("SELECT * FROM `#@__tuan_circle` WHERE `hot` = 1 AND `cid` = ".$cityInfo['id']." ORDER BY `id` ASC");
		$results = $dsql->dsqlOper($sql, "results");

		$list = array();
		if(count($results) > 0){
			foreach ($results as $key=>$value) {
				$list[$key]["id"]   = $value["id"];
				$list[$key]["name"] = $value["name"];
			}
		}
		return $list;
	}


	/**
     * 商家详细
     * @return array
     */
	public function storeDetail(){
		global $dsql;
		global $userLogin;
		$storeDetail = array();
		$id = $this->param;
		$uid = $userLogin->getMemberID();

		if(!is_numeric($id) && $uid == -1){
			return array("state" => 200, "info" => '格式错误！');
		}

		$where = " AND `state` = 1";
		if(!is_numeric($id)){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `uid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){
				$id = $results[0]['id'];
				$where = "";
			}else{
				return array("state" => 200, "info" => '该会员暂未开通商铺！');
			}
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__tuan_store` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$storeDetail["id"]         = $results[0]['id'];

			$uid = $results[0]['uid'];
			$storeDetail['member']     = getMemberDetail($uid);

			$storeDetail["typeid"]     = $results[0]['stype'];
			global $data;
			$data = "";
			$tuantype = getParentArr("tuantype", $results[0]['stype']);
			if($tuantype){
				$tuantype = array_reverse(parent_foreach($tuantype, "typename"));
				$storeDetail['typename'] = join(" > ", $tuantype);
			}else{
				$storeDetail['typename'] = "";
			}

			$storeDetail["addrid"]     = $results[0]['addrid'];
			$addrName = getParentArr("site_area", $results[0]['addrid']);
			global $data;
			$data = "";
			$addrArr = array_reverse(parent_foreach($addrName, "typename"));
			$addrArr = count($addrArr) > 2 ? array_splice($addrArr, 1) : $addrArr;
			$storeDetail['addrname']  = $addrArr;

			global $data;
			$data = "";
			$addrArr = array_reverse(parent_foreach($addrName, "id"));
			$storeDetail['city'] = count($addrArr) > 2 ? $addrArr[1] : $addrArr[0];

			// $addrSql = $dsql->SetQuery("SELECT `typename` FROM `#@__site_area` WHERE `id` = ". $results[0]['addrid']);
			// $addrname = $dsql->getTypeName($addrSql);
			// $storeDetail["addrname"]   = $addrname[0]['typename'];

			$storeDetail["address"]    = $results[0]['address'];

			if(!empty($results[0]['circle'])){
				$storeDetail["circleid"]   = explode(",", $results[0]['circle']);
				$circleArr = array();
				$sql = $dsql->SetQuery("SELECT `name` FROM `#@__tuan_circle` WHERE `id` in (". $results[0]['circle'] .")");
				$creturn = $dsql->dsqlOper($sql, "results");
				if($creturn){
					foreach ($creturn as $key => $value) {
						$circleArr[$key] = $value['name'];
					}
				}
				$storeDetail["circle"]     = join("、", $circleArr);
			}else{
				$storeDetail["circle"] = "";
			}

			$subwayIds = $results[0]['subway'];
			$storeDetail["subwayid"]   = explode(",", $subwayIds);
			$subwayArr = array();

			if(!empty($subwayIds)){
				$sql = $dsql->SetQuery("SELECT `title` FROM `#@__site_subway_station` WHERE `id` in (". $subwayIds .")");
				$creturn = $dsql->dsqlOper($sql, "results");
				if($creturn){
					foreach ($creturn as $key => $value) {
						$subwayArr[$key] = $value['title'];
					}
				}
			}
			$storeDetail["subway"]     = join("、", $subwayArr);

			$storeDetail["lnglat"]     = $results[0]['lnglat'];
			$storeDetail["tel"]        = $results[0]['tel'];

			$openStart = $results[0]['openStart'];
			$open1 = substr($openStart, 0, 2);
			$open2 = substr($openStart, 2);
			$storeDetail["openStart"]  = $open1 . ":" . $open2;

			$openEnd = $results[0]['openEnd'];
			$end1 = substr($openEnd, 0, 2);
			$end2 = substr($openEnd, 2);
			$storeDetail["openEnd"]  = $end1 . ":" . $end2;

			$storeDetail["score"] = $results[0]['score'];
			$storeDetail["click"] = $results[0]['click'];
			$storeDetail["note"]  = $results[0]['note'];
			$storeDetail["body"]  = $results[0]['body'];
			$storeDetail["state"] = $results[0]['state'];
		}
		return $storeDetail;
	}


	/**
     * 团购列表
     * @return array
     */
	public function tlist(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$all = $store = $typeid = $addrid = $business = $subway = $station = $title = $item = $flag = $orderby = $u = $state = $filter = $rec = $page = $pageSize = $where = $where1 = "";
		$tj = true;

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$all      = $this->param['all'];
				$store    = $this->param['store'];
				$typeid   = $this->param['typeid'];
				$addrid   = $this->param['addrid'];
				$business = $this->param['business'];
				$subway   = $this->param['subway'];
				$station  = $this->param['station'];
				$title    = $this->param['title'];
				$item     = $this->param['item'];
				$flag     = $this->param['flag'];
				$orderby  = $this->param['orderby'];
				$u        = $this->param['u'];
				$state    = $this->param['state'];
				$rec      = $this->param['rec'];
				$filter   = $this->param['filter'];
				$hourly   = $this->param['hourly'];
				$time     = $this->param['time'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		// $city = GetCookie("tuan_city");
		// if(empty($city)) return array("state" => 200, "info" => "城市设置失败");

		//商家
		if(!empty($store)){
			$where .= " AND `sid` = $store";
		}

		else{

		//如果是商家会员获取列表，则不通过城市筛选
		if(empty($u) && !$all){
			//获取当前城市所有商品
			$lower = 0;
			$cityInfo = $this->getCity();
			if($cityInfo){
				$cityid = $cityInfo['cid'];

				if($dsql->getTypeList($cityid, "site_area")){
					global $arr_data;
					$arr_data = array();
					$lower = arr_foreach($dsql->getTypeList($cityid, "site_area"));
					$lower = $cityid.",".join(',',$lower);
				}else{
					$lower = $cityid;
				}

				$sidArr = array();
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `addrid` in ($lower)");
				$results = $dsql->dsqlOper($archives, "results");
				if(is_array($results)){
					foreach ($results as $key => $value) {
						$sidArr[$key] = $value['id'];
					}
					if(!empty($sidArr)){
						$where .= " AND `sid` in (".join(",",$sidArr).")";
					}else{
						$tj = false;
						$where .= " AND 0 = 1";
					}
				}else{
					$tj = false;
					$where .= " AND 0 = 1";
				}

			}
		}

		//遍历分类
		if(!empty($typeid) && $tj){
			if($dsql->getTypeList($typeid, "tuantype")){
				global $arr_data;
				$arr_data = array();
				$lower = arr_foreach($dsql->getTypeList($typeid, "tuantype"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}

			$sidArr = array();
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `stype` in ($lower)");
			$results = $dsql->dsqlOper($archives, "results");
			if(is_array($results)){
				foreach ($results as $key => $value) {
					$sidArr[$key] = $value['id'];
				}
				if(!empty($sidArr)){
					$where .= " AND `sid` in (".join(",",$sidArr).")";
				}else{
					$tj = false;
					$where .= " AND 1 = 2";
				}
			}else{
				$tj = false;
				$where .= " AND 1 = 2";
			}
		}

		//遍历地区
		if(!empty($addrid) && $tj){

			$addridArr = array();
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `addrid` = $addrid");
			$results = $dsql->dsqlOper($archives, "results");
			foreach ($results as $key => $value) {
				$addridArr[$key] = $value['id'];
			}
			if(!empty($addridArr)){
				$where .= " AND `sid` in (".join(",",$addridArr).")";
			}else{
				$tj = false;
				$where .= " AND 3 = 4";
			}

		}


		//遍历商圈
		if(!empty($business) && $tj){

			$addridArr = array();
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE find_in_set($business, `circle`)");
			$results = $dsql->dsqlOper($archives, "results");
			foreach ($results as $key => $value) {
				$addridArr[$key] = $value['id'];
			}
			if(!empty($addridArr)){
				$where .= " AND `sid` in (".join(",",$addridArr).")";
			}else{
				$tj = false;
				$where .= " AND 5 = 6";
			}

		}


		//遍历地铁站
		if(!empty($subway) && empty($station) && $tj){

			$sql = $dsql->SetQuery("SELECT s2.`id` FROM `#@__site_subway` s1 LEFT JOIN `#@__site_subway_station` s2 ON s2.`sid` = s1.`id` WHERE s1.`id` = $subway");
			$ret = $dsql->dsqlOper($sql, "results");

			$subwhere = array();
			$subwhere[] = "find_in_set($station, `subway`)";
			if(!empty($ret)){
				foreach ($ret as $key => $value) {
					$subwhere[] = "find_in_set(".$value['id'].", `subway`)";
				}
			}

			$stationArr = array();
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE (".join(" OR ", $subwhere).")");
			$results = $dsql->dsqlOper($archives, "results");
			foreach ($results as $key => $value) {
				$stationArr[$key] = $value['id'];
			}
			if(!empty($stationArr)){
				$where .= " AND `sid` in (".join(",",$stationArr).")";
			}else{
				$tj = false;
				$where .= " AND 9 = 10";
			}

		}


		//遍历地铁站点
		if(!empty($station) && $tj){

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_subway_station` WHERE `id` = $station ORDER BY `weight`");
			$ret = $dsql->dsqlOper($sql, "results");

			$subwhere = array();
			$subwhere[] = "find_in_set($station, `subway`)";
			if(!empty($ret)){
				foreach ($ret as $key => $value) {
					$subwhere[] = "find_in_set(".$value['id'].", `subway`)";
				}
			}

			$stationArr = array();
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE (".join(" OR ", $subwhere).")");
			$results = $dsql->dsqlOper($archives, "results");
			foreach ($results as $key => $value) {
				$stationArr[$key] = $value['id'];
			}
			if(!empty($stationArr)){
				$where .= " AND `sid` in (".join(",",$stationArr).")";
			}else{
				$tj = false;
				$where .= " AND 7 = 8";
			}

		}



		//关键字
		if(!empty($title) && $tj){
			$sidArr = array();
			$userSql = $dsql->SetQuery("SELECT `store`.id FROM `#@__tuan_store` store LEFT JOIN `#@__member` user ON `user`.id = `store`.uid WHERE `user`.company like '%$title%' OR `store`.address like '%$title%'");
			$results = $dsql->dsqlOper($userSql, "results");
			foreach ($results as $key => $value) {
				$sidArr[$key] = $value['id'];
			}

			if(!empty($sidArr)){
				$where .= " AND (`title` like '%$title%' OR `sid` in (".join(",",$sidArr)."))";
			}else{
				$where .= " AND `title` like '%$title%'";
			}
		}

		//取出字段表中满足条件的所有信息ID Start
		if(!empty($item)){
			$item = explode("$$", $item);
			foreach($item as $k => $v){
				$v = explode(",", $v);
				if(!empty($v[1])){
					$archives = $dsql->SetQuery("SELECT `aid` FROM `#@__tuanitem` WHERE `iid` = ".$v[0]." AND find_in_set('".$v[1]."', `value`)");
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						$ids = array();
						foreach($results as $key => $val){
							$ids[$key] = $val['aid'];
						}
						$where .= " AND `id` in (".join(",", $ids).")";
					}else{
						$where .= " AND 8 = 9";
					}
				}
			}
		}


		//自定义属性
		if(!empty($flag)){
			$flags = explode(",", $flag);
			foreach ($flags as $key => $value) {
				$where .= " AND find_in_set('$value', `flag`)";
			}
		}

		//有限期，结束日期必须大于当前时间
		//$where .= " AND (`startdate` < ".GetMkTime(time())." AND `enddate` > ".GetMkTime(time()).")";

		//排序
		switch ($orderby){
			//默认
			case 0:
				$orderby = " ORDER BY `weight` DESC, `id` DESC";
				break;
			//销量降序
			case 1:
				$orderby = " ORDER BY (`buynum`+`defbuynum`) DESC, `weight` DESC, `id` DESC";
				break;
			//销量升序
			case 2:
				$orderby = " ORDER BY (`buynum`+`defbuynum`) ASC, `weight` DESC, `id` DESC";
				break;
			//价格升序
			case 3:
				$orderby = " ORDER BY `price` ASC, `weight` DESC, `id` DESC";
				break;
			//价格降序
			case 4:
				$orderby = " ORDER BY `price` DESC, `weight` DESC, `id` DESC";
				break;
			//发布时间降序
			case 5:
				$orderby = " ORDER BY `pubdate` DESC, `weight` DESC, `id` DESC";
				break;
			default:
				$orderby = " ORDER BY `weight` DESC, `id` DESC";
				break;
		}

		//推荐
		if(!empty($rec)){
			$where .= " AND `rec` = 1";
		}

		//筛选
		if(!empty($filter)){
			$today    = GetMkTime(date("Y-m-d"));
			$prevDay  = GetMkTime(date("Y-m-d", strtotime("-1 day")));
			$nextDay  = GetMkTime(date("Y-m-d", strtotime("+1 day")));

			if($filter == "today"){
				$where .= " AND (`startdate` >= ".$today." AND `startdate` < ".$nextDay.")";
			}elseif($filter == "old"){
				$where .= " AND (`startdate` >= ".$prevDay." AND `startdate` < ".$today.")";
			}elseif($filter == "foreshow"){
				$where .= " AND `startdate` >= ".$nextDay;
			}
		}

		//整点团
		if(!empty($hourly)){
			$start = $time - 3600;
			$where .= " AND `hourly` = 1 AND `startdate` >= '$start' AND `enddate` <= '$time'";
		}


		//已结束团购统计
		$finish = 0;

		//是否输出当前登录会员的信息
		if($u != 1){
			$where .= " AND `arcrank` = 1 AND `enddate` > ".GetMkTime(time());
		}else{
			$uid = $userLogin->getMemberID();

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `uid` = $uid");
			$storeRes = $dsql->dsqlOper($sql, "results");
			if($storeRes){
				$where .= " AND `sid` = ".$storeRes[0]['id'];
			}else{
				$where .= " AND 1 = 2";
			}

			//查询已结束的团购
			$finishArchives = $dsql->SetQuery("SELECT `id` FROM `#@__tuanlist` WHERE ((`enddate` < ".GetMkTime(time())." AND `defbuynum` + `buynum` > `maxnum`) OR (`maxnum` != 0 AND `defbuynum` + `buynum` > `maxnum`))".$where);
			//统计已结束团购数量
			$finish = $dsql->dsqlOper($finishArchives, "totalCount");


			if($state != "" && $state != 3){
				$where1 = " AND `arcrank` = ".$state;
			}else{
				$ids = array();
				//结束信息ID
				if($state == 3){
					$finishResults = $dsql->dsqlOper($finishArchives, "results");
					if($finishResults){
						foreach($finishResults as $v){
							$ids[] = $v['id'];
						}
					}
				}

				if($state != ""){
					if(!empty($ids)){
						$where1 .= " AND `id` in (".join(",", $ids).")";
					}else{
						$where1 .= " AND 1 = 2";
					}
				}
			}
		}

	}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `sid`, `title`, `subtitle`, `startdate`, `enddate`, `defbuynum`, `buynum`, `maxnum`, `litpic`, `market`, `price`, `packtype`, `flag`, `arcrank`, `pubdate` " .
									"FROM `#@__tuanlist` " .
									"WHERE " .
									"1 = 1".$where);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		if($totalCount == 0) return array("state" => 100, "pageInfo" => $pageinfo, "list" => array());

		//会员列表需要统计信息状态
		if($u == 1 && $uid > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND `arcrank` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND `arcrank` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND `arcrank` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
			$pageinfo['finish'] = $finish;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']       = $val['id'];
				$list[$key]['title']    = $val['title'];
				$list[$key]['subtitle'] = $val['subtitle'];
				$list[$key]['sale']     = $val['defbuynum'] + $val['buynum'];
				$list[$key]['litpic']   = getFilePath($val['litpic']);
				$list[$key]['market']   = $val['market'];
				$list[$key]['price']    = $val['price'];
				$list[$key]['packtype'] = $val['packtype'];
				$list[$key]['discount'] = sprintf("%.1f", ($val['price']/$val['market'])*10);
				$list[$key]['flag']     = explode(",", $val['flag']);

				//评价
				$sql = $dsql->SetQuery("SELECT avg(c.`rating`) r FROM `#@__tuancommon` c LEFT JOIN `#@__tuan_order` o ON o.`id` = c.`aid` WHERE o.`orderstate` = 3 AND c.`ischeck` = 1 AND o.`proid` = ".$val['id']);
				$res = $dsql->dsqlOper($sql, "results");
				$rating = $res[0]['r'];

				$sql = $dsql->SetQuery("SELECT c.`id` FROM `#@__tuancommon` c LEFT JOIN `#@__tuan_order` o ON o.`id` = c.`aid` WHERE o.`orderstate` = 3 AND c.`ischeck` = 1 AND o.`proid` = ".$val['id']);
				$totalCommon  = $dsql->dsqlOper($sql, "totalCount");  //评价总人数

				$list[$key]['common']['rating'] = number_format($rating, 1);
				$list[$key]['common']['count'] = $totalCommon;


				$this->param = $val['sid'];
				$list[$key]['store'] = $this->storeDetail();

				//商家会员中心团购列表
				if($u == 1 && $uid > -1){
					$list[$key]['buynum']    = $val['buynum'];
					$list[$key]['startdate'] = $val['startdate'];
					$list[$key]['enddate']   = $val['enddate'];

					$property = $val['arcrank'];
					if(GetMkTime(time()) > $val["enddate"]){
						if(($val["defbuynum"] + $val["buynum"]) > $val["maxnum"]){
							$property = "3";
						}
					}

					$list[$key]['arcrank']   = $property;
					$list[$key]['pubdate']   = $val['pubdate'];

					//评价数量
					$sql = $dsql->SetQuery("SELECT c.`id` FROM `#@__tuancommon` c LEFT JOIN `#@__tuan_order` o ON o.`id` = c.`aid` WHERE o.`orderstate` = 3 AND c.`ischeck` = 1 AND o.`proid` = ".$val['id']);
					$totalCommon  = $dsql->dsqlOper($sql, "totalCount");
					$list[$key]['common'] = $totalCommon;

				}

				$param = array(
					"service"  => "tuan",
					"template" => "detail",
					"id"       => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);

	}


	/**
     * 团购详细
     * @return arrayg
     */
	public function detail(){
		global $dsql;
		$tuanDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		global $do;
		$where = " AND `arcrank` = 1";
		if($do == "edit"){
			$where = "";
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__tuanlist` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];

			$tuanDetail["id"]           = $results['id'];
			$tuanDetail["sid"]          = $results['sid'];
			$tuanDetail["title"]        = $results['title'];
			$tuanDetail["subtitle"]     = $results['subtitle'];
			$tuanDetail["startdate"]    = $results['startdate'];
			$tuanDetail["enddate"]      = $results['enddate'];
			$tuanDetail["minnum"]       = $results['minnum'];

			$maxnum = $results['maxnum'];
			$limit  = $results['limit'];
			$sale   = $results['defbuynum'] + $results['buynum'];
			$comp   = $maxnum != 0 ? $maxnum - $sale : 0;
			$limit  = $limit != 0 ? ($comp == 0 ? $limit : $comp > $limit ? $limit : $comp) : $comp;
			$limit  = $limit > 0 ? $limit : 0;

			$tuanDetail["maxnum"]       = $maxnum;
			$tuanDetail["limit"]        = $limit;
			$tuanDetail["sale"]         = $sale;

			$tuanDetail["tuantype"]     = $results['tuantype'];
			$tuanDetail["expireddate"]  = $results['expireddate'];
			$tuanDetail["amount"]       = $results['amount'];
			$tuanDetail["freight"]      = $results['freight'];
			$tuanDetail["freeshi"]      = $results['freeshi'];
			$tuanDetail["litpic"]       = getFilePath($results['litpic']);
			$tuanDetail["market"]       = $results['market'];
			$tuanDetail["price"]        = $results['price'];
			$tuanDetail['discount']     = sprintf("%.1f", ($results['price']/$results['market'])*10);
			$tuanDetail["typeid"]       = $results['typeid'];
			$tuanDetail["tips"]         = $results['tips'];
			$tuanDetail["body"]         = $results['body'];
			$tuanDetail["mbody"]        = $results['mbody'];

			$param = array(
				"service"  => "tuan",
				"template" => "detail",
				"id"       => $id
			);
			$tuanDetail['url'] = getUrlPath($param);

			if($do == "edit"){
				$tuanDetail["litpicSource"] = $results['litpic'];
				$tuanDetail["flags"] = explode(",", $results['flag']);
			}

			//购买须知
			$notice = $results['notice'];
			$noticeArr = array();
			if(!empty($notice)){
				$notice = explode("|||", $notice);
				foreach ($notice as $key => $value) {
					$val = explode("$$$", $value);
					$noticeArr[$key]['title'] = $val[0];
					$noticeArr[$key]['note'] = $val[1];
				}
			}
			$tuanDetail['notice'] = $noticeArr;

			//套餐内容
			$packtype = $results['packtype'];
			$package = $results['package'];

			$tuanDetail['packtype'] = $packtype;

			$packageArr = array();
			if(!empty($package)){
				$package = explode("|||", $package);

				//单项
				if($packtype == 1){
					$val = explode("$$$", $package[0]);
					$packageArr[0] = $val[0];
					$packageArr[1] = $val[1];
					$packageArr[2] = $val[2];
					$packageArr[3] = $val[3];

				//多项
				}elseif($packtype == 2){

					foreach ($package as $key => $value) {
						$val = explode("@@@", $value);
						$packageArr[$key]['title'] = $val[0];

						$tabs = explode("~~~", $val[1]);
						foreach ($tabs as $k => $v) {
							$tr = explode("$$$", $v);
							$packageArr[$key]['tr'][$k][0] = $tr[0];
							$packageArr[$key]['tr'][$k][1] = $tr[1];
							$packageArr[$key]['tr'][$k][2] = $tr[2];
							$packageArr[$key]['tr'][$k][3] = $tr[3];
						}
					}
				}
			}

			$tuanDetail['package'] = $packageArr;

			//图集
			$imglist = array();
			$pics = $results['pics'];
			if(!empty($pics)){
				$pics = explode(",", $pics);
				foreach ($pics as $key => $value) {
					$imglist[$key]['path'] = getFilePath($value);
					$imglist[$key]['pathSource'] = $value;
				}
			}
			$tuanDetail['pics'] = $imglist;


			//验证是否已经收藏
			$params = array(
				"module" => "tuan",
				"temp"   => "detail",
				"type"   => "add",
				"id"     => $results['id'],
				"check"  => 1
			);
			$collect = checkIsCollect($params);
			$tuanDetail['collect'] = $collect == "has" ? 1 : 0;

			$this->param = $results['sid'];
			$tuanDetail['store'] = $this->storeDetail();

			//评价
			$sql = $dsql->SetQuery("SELECT avg(c.`rating`) r, avg(c.`score1`) s1, avg(c.`score2`) s2, avg(c.`score3`) s3 FROM `#@__tuancommon` c LEFT JOIN `#@__tuan_order` o ON o.`id` = c.`aid` WHERE o.`orderstate` = 3 AND c.`ischeck` = 1 AND o.`proid` = ".$id);
			$res = $dsql->dsqlOper($sql, "results");
			$rating = $res[0]['r'];		//总评分
			$score1 = $res[0]['s1'];  //分项1
			$score2 = $res[0]['s2'];  //分项2
			$score3 = $res[0]['s3'];  //分项3

			$sql = $dsql->SetQuery("SELECT c.`id` FROM `#@__tuancommon` c LEFT JOIN `#@__tuan_order` o ON o.`id` = c.`aid` WHERE o.`orderstate` = 3 AND c.`ischeck` = 1 AND o.`proid` = ".$id);

			$totalCommon  = $dsql->dsqlOper($sql, "totalCount");  //评价总人数
			$rating1      = $dsql->dsqlOper($sql." AND c.`rating` = 1", "totalCount");  //1分
			$rating2      = $dsql->dsqlOper($sql." AND c.`rating` = 2", "totalCount");  //2分
			$rating3      = $dsql->dsqlOper($sql." AND c.`rating` = 3", "totalCount");  //3分
			$rating4      = $dsql->dsqlOper($sql." AND c.`rating` = 4", "totalCount");  //4分
			$rating5      = $dsql->dsqlOper($sql." AND c.`rating` = 5", "totalCount");  //5分

			$tuanDetail['totalCommon'] = $totalCommon;
			$tuanDetail['rating'] = number_format($rating, 1);
			$tuanDetail['score1'] = number_format($score1, 1);
			$tuanDetail['score2'] = number_format($score2, 1);
			$tuanDetail['score3'] = number_format($score3, 1);
			$tuanDetail['rating1'] = $rating1;
			$tuanDetail['rating2'] = $rating2;
			$tuanDetail['rating3'] = $rating3;
			$tuanDetail['rating4'] = $rating4;
			$tuanDetail['rating5'] = $rating5;

		}

		return $tuanDetail;
	}


	/**
		* 购物车列表
		* @return array
		*/
	public function getCartList(){

		global $dsql;
		// $cartData = GetCookie("tuan_cart");
		$cartData = $this->param['data'];
		if(!empty($cartData)){

			$return = array();
			$cartData = explode("|", $cartData);

			foreach ($cartData as $key => $value) {
				$val = explode(",", $value);

				$this->param = $val[0];
				$detail = $this->detail();

				$return[$key]['id']     = $val[0];
				$return[$key]['count']  = $val[1];
				$return[$key]['title']  = $detail['title'];
				$return[$key]['thumb']  = $detail['litpic'];
				$return[$key]['price']  = $detail['price'];
				$return[$key]['limit']  = $detail['limit'];
				$return[$key]['tuantype']  = $detail['tuantype'];
				$return[$key]['freight']  = $detail['freight'];
				$return[$key]['freeshi']  = $detail['freeshi'];

				//运费
				$freight = 0;
				if($detail['tuantype'] == 2 && $val[1] <= $detail['freeshi']){
					$freight = $detail['freight'];
				}

				$return[$key]['totalAmount'] = sprintf("%.2f", $val[1] * $detail['price'] + $freight);

				$param = array(
					"service"     => "tuan",
					"template"    => "detail",
					"id"          => $val[0]
				);
				$return[$key]['url'] = getUrlPath($param);

			}

			return $return;
		}

	}


	/**
		* 获取需要修改订单的内容
		* @return array
		*/
	public function getOrderList(){
		global $dsql;
		$ordernum = $this->param["ordernum"];
		if(empty($ordernum)) return;

		$RenrenCrypt = new RenrenCrypt();
		$ordernums = $RenrenCrypt->php_decrypt(base64_decode($ordernum));

		if(!empty($ordernums)){

			$return = array();
			$ordernums = explode(",", $ordernums);

			$i = 0;

			foreach ($ordernums as $key => $value) {

				$archives = $dsql->SetQuery("SELECT `id`, `proid`, `procount`, `deliveryType`, `useraddr`, `username`, `usercontact`, `usernote` FROM `#@__tuan_order` WHERE `orderstate` = 0 AND `ordernum` = '$value'");
				$results  = $dsql->dsqlOper($archives, "results");
				if($results){
					$proid    = $results[0]['proid'];
					$procount = $results[0]['procount'];
					$orderid  = $results[0]['id'];

					$this->param = $proid;
					$detail = $this->detail();

					$return[$i]['orderid'] = $orderid;
					$return[$i]['id']     = $proid;
					$return[$i]['count']  = $procount;
					$return[$i]['title']  = $detail['title'];
					$return[$i]['thumb']  = $detail['litpic'];
					$return[$i]['price']  = $detail['price'];
					$return[$i]['limit']  = $detail['limit'];
					$return[$i]['tuantype']  = $detail['tuantype'];
					$return[$i]['freight']  = $detail['freight'];
					$return[$i]['freeshi']  = $detail['freeshi'];

					//物流信息
					if($detail['tuantype'] == 2){
						$return[$i]['deliveryType'] = $results[0]['deliveryType'];
						$return[$i]['useraddr']     = $results[0]['useraddr'];
						$return[$i]['username']     = $results[0]['username'];
						$return[$i]['usercontact']  = $results[0]['usercontact'];
						$return[$i]['usernote']     = $results[0]['usernote'];
					}

					//运费
					$freight = 0;
					if($detail['tuantype'] == 2 && $procount <= $detail['freeshi']){
						$freight = $detail['freight'];
					}

					$return[$i]['totalAmount'] = sprintf("%.2f", $procount * $detail['price'] + $freight);

					$param = array(
						"service"     => "tuan",
						"template"    => "detail",
						"id"          => $proid
					);
					$return[$i]['url'] = getUrlPath($param);

					$i++;
				}

			}

			return $return;
		}

	}


	/**
     * 团购订单列表
     * @return array
     */
	public function orderList(){
		global $dsql;
		$pageinfo = $list = array();
		$store = $state = $userid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$store    = $this->param['store'];
				$state    = $this->param['state'];
				$userid   = $this->param['userid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($userid)){
			global $userLogin;
			$userid = $userLogin->getMemberID();
		}
		if(empty($userid)) return array("state" => 200, "info" => '会员ID不得为空！');

		//个人会员订单
		if(empty($store)){
			$where = " `userid` = " . $userid;
			$archives = $dsql->SetQuery("SELECT " .
									"`id`, `ordernum`, `proid`, `procount`, `orderprice`, `propolic`, `orderstate`, `orderdate`, `paydate`, `ret-state`, `exp-date` " .
									"FROM `#@__tuan_order` " .
									"WHERE " . $where);

		//商家订单列表 && 只列出所有类别为快递的订单
		}else{
			$archives = $dsql->SetQuery("SELECT " .
									"o.`id`, o.`ordernum`, o.`proid`, o.`procount`, o.`orderprice`, o.`propolic`, o.`orderstate`, o.`orderdate`, o.`paydate`, o.`ret-state`, o.`exp-date` " .
									"FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id`" .
									"WHERE l.`tuantype` = 2 AND s.`uid` = ".$userid . $where);
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		//未付款
		$unpaid = $dsql->dsqlOper($archives." AND `orderstate` = 0", "totalCount");
		//未使用
		$ongoing = $dsql->dsqlOper($archives." AND `orderstate` = 1", "totalCount");
		//已过期
		$expired = $dsql->dsqlOper($archives." AND `orderstate` = 2", "totalCount");
		//已使用
		$success = $dsql->dsqlOper($archives." AND `orderstate` = 3", "totalCount");
		//等待退款
		$refunded = $dsql->dsqlOper($archives." AND `ret-state` = 1", "totalCount");
		//待评价
		$rates = $dsql->dsqlOper($archives." AND `orderstate` = 3 AND `common` = 0", "totalCount");
		//已发货/待收货
		$recei = $dsql->dsqlOper($archives." AND `orderstate` = 6 AND `exp-date` != 0", "totalCount");
		//关闭/失败/退款成功
		$closed = $dsql->dsqlOper($archives." AND `orderstate` = 7", "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount,
			"unpaid"  => $unpaid,
			"ongoing" => $ongoing,
			"expired" => $expired,
			"success" => $success,
			"refunded" => $refunded,
			"rates"    => $rates,
			"recei"    => $recei,
			"closed"    => $closed
		);

		$where = "";
		if($state != "" && $state != 4 && $state != 5 && $state != 6){
			$where = " AND `orderstate` = " . $state;
		}

		//退款
		if($state == 4){
			$where = " AND `ret-state` = 1";
		}

		//待评价
		if($state == 5){
			$where = " AND `orderstate` = 3 AND `common` = 0";
		}

		//已发货
		if($state == 6){
			$where = " AND `orderstate` = 6 AND `exp-date` != 0";
		}

		$atpage = $pageSize*($page-1);
		$where .= " ORDER BY `id` DESC LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where, "results");
		if($results){

			$param = array(
				"service"     => "tuan",
				"template"    => "pay",
				"param"       => "ordernum=%id%"
			);
			$payurlParam = getUrlPath($param);

			$param = array(
				"service"  => "member",
				"type"     => "user",
				"template" => "orderdetail",
				"module"   => "tuan",
				"id"       => "%id%",
				"param"    => "rates=1"
			);
			$commonUrlParam = getUrlPath($param);

			foreach($results as $key => $val){
				$list[$key]['id']          = $val['id'];
				$list[$key]['ordernum']    = $val['ordernum'];
				$list[$key]['proid']       = $val['proid'];
				$list[$key]['procount']    = $val['procount'];

				//计算订单价格
				$totalPrice = $val['orderprice'] * $val['procount'];
				$propolic   = $val['propolic'];
				$policy     = unserialize($propolic);
				if(!empty($propolic) && !empty($policy)){
					$freight  = $policy['freight'];
					$freeshi  = $policy['freeshi'];

					if($val['procount'] <= $freeshi){
						$totalPrice += $freight;
					}
				}

				$list[$key]['orderprice']  = $totalPrice;
				$list[$key]["orderstate"]  = $val['orderstate'];
				$list[$key]['orderdate']   = $val['orderdate'];
				$list[$key]['paydate']     = $val['paydate'];
				$list[$key]['retState']    = $val['ret-state'];
				$list[$key]['expDate']     = $val['exp-date'];

				$this->param = $val['proid'];
				$detail = $this->detail();

				$list[$key]['product']['title'] = $detail['title'];
				$list[$key]['product']['enddate'] = $detail['enddate'];
				$list[$key]['product']['litpic'] = $detail['litpic'];

				$param = array(
					"service"     => "tuan",
					"template"    => "detail",
					"id"          => $val['proid']
				);
				$list[$key]['product']['url'] = getUrlPath($param);

				//未付款的提供付款链接
				if($val['orderstate'] == 0){
					$RenrenCrypt = new RenrenCrypt();
					$encodeid = base64_encode($RenrenCrypt->php_encrypt($val["ordernum"]));
					$list[$key]["payurl"] = str_replace("%id%", $encodeid, $payurlParam);
				}

				//评价
				if($val['orderstate'] == 3){
					$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuancommon` WHERE `aid` = ".$val['id']);
					$common = $dsql->dsqlOper($archives, "totalCount");
					$iscommon = $common > 0 ? 1 : 0;
					$list[$key]['common'] = $iscommon;
					$list[$key]['commonUrl'] = str_replace("%id%", $val['id'], $commonUrlParam);

				}


				//判断订单状态为未付款，如果已经过期，更新订单状态
				// if($val["orderstate"] == 0){
				// 	if(GetMkTime(time()) > $product[0]['enddate']){
				// 		$list[$key]["orderstate"] = "2";

				// 		$updateProSql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 2 WHERE `id` = ". $val["id"]);
				// 		$dsql->dsqlOper($updateProSql, "update");

				// 	}else{
				// 		$list[$key]["orderstate"] = $val["orderstate"];
				// 	}

				// //如果是已经付款的，检查活动是否结束，如果结束检查团购是否成功，如果成功则更新订单状态
				// }elseif($val["orderstate"] == 1){
				// 	if(GetMkTime(time()) > $product[0]['enddate'] && $product[0]['minnum'] <= $product[0]['defbuynum'] + $product[0]['buynum']){
				// 		$list[$key]["orderstate"] = "4";

				// 		$updateProSql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 4 WHERE `id` = ". $val["id"]);
				// 		$dsql->dsqlOper($updateProSql, "update");
				// 	}else{
				// 		$list[$key]["orderstate"] = $val["orderstate"];
				// 	}

				// //如果是已经过期的，检查商品活动是否已过期（这里主要是针对后期改动商品结束日期），如果没有过期，则更新订单状态为未付款
				// }elseif($val["orderstate"] == 2){
				// 	if(GetMkTime(time()) <= $product[0]['enddate']){
				// 		$list[$key]["orderstate"] = "0";

				// 		$proSql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 0 WHERE `id` = ". $val["id"]);
				// 		$dsql->dsqlOper($proSql, "update");

				// 	}else{
				// 		$list[$key]["orderstate"] = $val["orderstate"];
				// 	}
				// }else{
				// 	$list[$key]["orderstate"] = $val["orderstate"];
				// }


			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);

	}


	/**
     * 团购订单详细
     * @return array
     */
	public function orderDetail(){
		global $dsql;
		$orderDetail = $cardnum = array();
		$id = $this->param;

		global $userLogin;
		$userid = $userLogin->getMemberID();

		if($userid == -1) return array("state" => 200, "info" => '请先登录！');
		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//主表信息
		$archives = $dsql->SetQuery("SELECT o.*, s.`id` as sid FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE (o.`userid` = '$userid' OR s.`uid` = '$userid') AND o.`id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");

		if(!empty($results)){

			$results = $results[0];

			$orderDetail["ordernum"] = $results["ordernum"];
			$orderDetail["userid"]   = $results["userid"];

			//会员信息
			$orderDetail['member'] = getMemberDetail($results['userid']);

			//商品信息
			$this->param = $results['proid'];
			$detail = $this->detail();

			$orderDetail['product']['id']       = $detail['id'];
			$orderDetail['product']['title']    = $detail['title'];
			$orderDetail['product']['enddate']  = $detail['enddate'];
			$orderDetail['product']['litpic']   = $detail['litpic'];
			$orderDetail['product']['tuantype'] = $detail['tuantype'];

			$param = array(
				"service"     => "tuan",
				"template"    => "detail",
				"id"          => $results['proid']
			);
			$url = getUrlPath($param);
			$orderDetail['product']['url'] = $url;


			$orderDetail["procount"]   = $results["procount"];

			//总价
			$orderprice = $results["orderprice"];
			$point      = $results["point"];
			$balance    = $results["balance"];
			$payprice   = $results["payprice"];
			$procount   = $results["procount"];
			$propolic   = $results["propolic"];
			$policy     = unserialize($propolic);

			$totalAmount += $orderprice * $procount;
			$freightMoney = 0;

			if(!empty($propolic) && !empty($policy)){
				$freight  = $policy['freight'];
				$freeshi  = $policy['freeshi'];

				//如果达不到免物流费的数量，则总价再加上运费
				if($procount <= $freeshi){
					$totalAmount += $freight;
					$freightMoney = $freight;
				}
			}

			$orderDetail["freight"]    = $freightMoney;
			$orderDetail["orderprice"] = $orderprice;
			$orderDetail["totalmoney"] = $totalAmount;
			$orderDetail["point"]      = $point;
			$orderDetail["balance"]    = $balance;
			$orderDetail["payprice"]   = $payprice;
			$orderDetail["orderstate"] = $results["orderstate"];
			$orderDetail["orderdate"]  = $results["orderdate"];


			//评价信息
			$sql = $dsql->SetQuery("SELECT `rating`, `score1`, `score2`, `score3`, `pics`, `content`, `ischeck` FROM `#@__tuancommon` WHERE `aid` = ".$results['id']);
			$common = $dsql->dsqlOper($sql, "results");
			if($common && $results['common'] == 1){
				$common = $common[0];
				$orderDetail['common']['rating'] = $common['rating'];
				$orderDetail['common']['score1'] = $common['score1'];
				$orderDetail['common']['score2'] = $common['score2'];
				$orderDetail['common']['score3'] = $common['score3'];

				$imglist = array();
				$pics = $common['pics'];
				if(!empty($pics)){
					$pics = explode(",", $pics);
					foreach ($pics as $key => $value) {
						$imglist[$key]['val'] = $value;
						$imglist[$key]['path'] = getFilePath($value);
					}
				}

				$orderDetail['common']['pics']   = $imglist;
				$orderDetail['common']['content'] = $common['content'];
				$orderDetail['common']['ischeck'] = $common['ischeck'];
			}


			//未付款的提供付款链接
			if($results['orderstate'] == 0){
				$RenrenCrypt = new RenrenCrypt();
				$encodeid = base64_encode($RenrenCrypt->php_encrypt($results["ordernum"]));

				$param = array(
					"service"     => "tuan",
					"template"    => "pay",
					"param"       => "ordernum=".$encodeid
				);
				$payurl = getUrlPath($param);

				$orderDetail["payurl"] = $payurl;
			}


			//支付方式
			$paySql = $dsql->SetQuery("SELECT `pay_name` FROM `#@__site_payment` WHERE `pay_code` = '".$results["paytype"]."'");
			$payResult = $dsql->dsqlOper($paySql, "results");
			if(!empty($payResult)){
				$orderDetail["paytype"]   = $payResult[0]["pay_name"];
			}else{
				global $cfg_pointName;
				$payname = "";
				if($results["paytype"] == "point,money"){
					$payname = $cfg_pointName."+余额";
				}elseif($results["paytype"] == "point"){
					$payname = $cfg_pointName;
				}elseif($results["paytype"] == "money"){
					$payname = "余额";
				}
				$orderDetail["paytype"]   = $payname;
			}

			$orderDetail["paydate"]   = $results["paydate"];



			//团购券
			if($detail["tuantype"] == 0 && $results['orderstate'] != 0){
				$cardSql = $dsql->SetQuery("SELECT `cardnum`, `usedate`, `expireddate` FROM `#@__tuanquan` WHERE `orderid` = ". $results["id"]);
				$cardResult = $dsql->dsqlOper($cardSql, "results");
				if($cardResult){
					foreach($cardResult as $key => $val){
						$cardnum[$key]['cardnum']     = join(" ", str_split($val['cardnum'], 4));
						$cardnum[$key]['usedate']     = $val['usedate'];
						$cardnum[$key]['expireddate'] = $val['expireddate'];
					}
				}

			//充值卡
			}elseif($detail["tuantype"] == 1 && $results['orderstate'] != 0){
				$cardSql = $dsql->SetQuery("SELECT `cardnum`, `usedate`, `expireddate`, `cardmoney` FROM `#@__paycard` WHERE `module` = 'tuan' AND `orderid` = ". $results["id"]);
				$cardResult = $dsql->dsqlOper($cardSql, "results");
				if($cardResult){
					foreach($cardResult as $key => $val){
						$cardnum[$key] = $cardResult[$key];
					}
				}
			}

			if($cardnum){
				$orderDetail["cardnum"]   = $cardnum;
			}

			//快递类型
			if($detail['tuantype'] == 2){
				$orderDetail["deliveryType"] = $results["deliveryType"];
				$orderDetail["useraddr"]     = $results["useraddr"];
				$orderDetail["username"]     = $results["username"];
				$orderDetail["usercontact"]  = $results["usercontact"];
				$orderDetail["usernote"]     = !empty($results["usernote"]) ? $results["usernote"] : "无";

				//快递公司&单号
				$orderDetail["expCompany"] = $results["exp-company"];
				$orderDetail["expNumber"]  = $results["exp-number"];
				$orderDetail["expDate"]    = $results["exp-date"];

				//卖家回复
				$orderDetail["retSnote"]    = $results["ret-s-note"];
				$imglist = array();
				$pics = $results['ret-s-pics'];
				if(!empty($pics)){
					$pics = explode(",", $pics);
					foreach ($pics as $key => $value) {
						$imglist[$key]['val'] = $value;
						$imglist[$key]['path'] = getFilePath($value);
					}
				}

				$orderDetail["retSpics"]    = $imglist;
				$orderDetail["retSdate"]    = $results["ret-s-date"];

			}

			//退款状态
			$orderDetail["retState"]    = $results["ret-state"];

			//退款原因
			$orderDetail["retType"]    = $results["ret-type"];
			$orderDetail["retNote"]    = $results["ret-note"];

			$imglist = array();
			$pics = $results['ret-pics'];
			if(!empty($pics)){
				$pics = explode(",", $pics);
				foreach ($pics as $key => $value) {
					$imglist[$key]['val'] = $value;
					$imglist[$key]['path'] = getFilePath($value);
				}
			}

			$orderDetail["retPics"]    = $imglist;
			$orderDetail["retDate"]    = $results["ret-date"];

			//退款确定时间
			$orderDetail["retOkdate"]    = $results["ret-ok-date"];

			$orderDetail['now'] = GetMkTime(time());


			//卖家信息
			$this->param = $results['sid'];
			$orderDetail['store'] = $this->storeDetail();



			//计算运费
			// $price = $results[0]["orderprice"];
			// if($proResult[0]['tuantype'] == 2){
			// 	if($procount < $proResult[0]["freeshi"] && $results[0]['emstype'] == 0){
			// 		$price = $price + $proResult[0]['freight'];
			// 	}
			// }
			// $orderDetail["orderprice"] = sprintf("%.2f", $price);

			//判断订单状态为未付款并且团购商品为团购券和充值卡的订单是否过期
			// if($results[0]["orderstate"] == 0){
			// 	if(GetMkTime(time()) > $proResult[0]['enddate']){
			// 		$orderDetail["orderstate"] = "2";

			// 		$updateProSql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 2 WHERE `id` = ". $id);
			// 		$dsql->dsqlOper($updateProSql, "results");

			// 	}else{
			// 		$orderDetail["orderstate"] = $results[0]["orderstate"];
			// 	}
			// }elseif($value["orderstate"] == 2){
			// 	if(GetMkTime(time()) < $proResult[0]['enddate']){
			// 		$orderDetail["orderstate"] = "0";

			// 		$proSql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 0 WHERE `id` = ". $id);
			// 		$dsql->dsqlOper($proSql, "results");

			// 	}else{
			// 		$orderDetail["orderstate"] = $results[0]["orderstate"];
			// 	}
			// }else{
			// 	$orderDetail["orderstate"] = $results[0]["orderstate"];
			// }

			// $orderDetail["orderdate"] = $results[0]["orderdate"];
			// $orderDetail["paytype"]   = $results[0]["paytype"];
			// $orderDetail["paydate"]   = $results[0]["paydate"];
			// $orderDetail["emstype"]   = $results[0]["emstype"];
			// $orderDetail["useraddr"]  = $results[0]["useraddr"];
			// $orderDetail["usercode"]  = $results[0]["usercode"];
			// $orderDetail["usernote"]  = $results[0]["usernote"];

		}

		return $orderDetail;
	}


	/**
		* 删除订单
		* @return array
		*/
	public function delOrder(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__tuan_order` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['userid'] == $uid){

				if($results['orderstate'] == 0){
					$archives = $dsql->SetQuery("DELETE FROM `#@__tuan_order` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '订单为不可删除状态！');
				}

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '订单不存在，或已经删除！');
		}

	}


	/**
     * 邀请返现
     * @return array
     */
	public function invite(){
		global $dsql;
		$pageinfo = $list = $orderid = array();
		$state = $userid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$state    = $this->param['state'];
				$userid   = $this->param['userid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($userid)) return array("state" => 200, "info" => '会员ID不得为空！');

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__member` WHERE `recid` = $userid ORDER BY `id` DESC");
		$userResult = $dsql->dsqlOper($userSql, "results");

		if($userResult){

			foreach($userResult as $key => $user){
				$orderSql = $dsql->SetQuery("SELECT * FROM `#@__tuan_order` WHERE `orderstate` = 4 AND `userid` = ".$user['id']." ORDER BY `id` ASC limit 0,1");
				$orderResult = $dsql->dsqlOper($orderSql, "results");
				if($orderResult){
					array_push($orderid, $orderResult[0]['id']);
				}
			}
		}

		if(!empty($orderid)){
			$orderid = join(",", $orderid);
			$archives = $dsql->SetQuery("SELECT * FROM `#@__tuan_order` WHERE `id` in (".$orderid.")");

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
			$results = $dsql->dsqlOper($archives." LIMIT $atpage, $pageSize", "results");
		}else{
			$results    = array();
		}

		if(count($results) > 0){
			$list = array();
			foreach ($results as $key=>$value) {

				$userSql = $dsql->SetQuery("SELECT `id`, `username`, `recid`, `recfan`, `rectime` FROM `#@__member` WHERE `id` = ".$value['userid']);
				$userResult = $dsql->dsqlOper($userSql, "results");

				if($userResult){
					$list[$key]["userid"] = $userResult[0]["id"];
					$list[$key]["username"] = $userResult[0]["username"];
					$list[$key]["state"] = $userResult[0]["recfan"];
					$list[$key]["invitedate"] = $userResult[0]["rectime"];
				}else{
					$list[$key]["userid"] = 0;
					$list[$key]["username"] = "未知";
					$list[$key]["state"] = -1;
					$list[$key]["invitedate"] = "";
				}

				$list[$key]["proid"] = $value["proid"];
				$proSql = $dsql->SetQuery("SELECT `title` FROM `#@__tuanlist` WHERE `id` = ".$value['proid']);
				$proResult = $dsql->dsqlOper($proSql, "results");

				if($proResult){
					$list[$key]["proname"] = $proResult[0]["title"];
				}else{
					$list[$key]["proname"] = "商品不存在";
				}

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 评论列表
     * @return array
     */
	public function common(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$id = $filter = $orderby = $page = $pageSize = $where = $px = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$id       = $this->param['id'];
			$filter   = $this->param['filter'];
			$orderby  = $this->param['orderby'];
			$page     = $this->param['page'];
			$pageSize = $this->param['pageSize'];
		}

		if(empty($id)) return array("state" => 200, "info" => '格式错误！');

		//筛选
		if(!empty($filter)){
			if($filter == "pic"){
				$where .= " AND c.`pics` <> ''";
			}elseif($filter == "lower"){
				$where .= " AND c.`rating` < 3";
			}
		}

		//排序
		$px = " ORDER BY c.`rating` DESC, c.`floor` ASC, c.`id` DESC";
		if(!empty($orderby)){
			if($orderby == "time"){
				$px = " ORDER BY c.`floor` ASC, c.`id` DESC";
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT c.`rating`, c.`userid`, c.`pics`, c.`content`, c.`dtime` FROM `#@__tuancommon` c LEFT JOIN `#@__tuan_order` o ON o.`id` = c.`aid` WHERE o.`proid` = ".$id." AND o.`orderstate` = 3 AND o.`common` = 1 AND c.`ischeck` = 1".$where.$px);

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
		if($results){
			foreach($results as $key => $val){
				$list[$key]['rating']  = $val['rating'];

				$imgArr = array();
				$pics = $val['pics'];
				if(!empty($pics)){
					$picArr = explode(",", $pics);
					foreach ($picArr as $k => $v) {
						$imgArr[$k] = getFilePath($v);
					}
				}
				$list[$key]['pics'] = $imgArr;

				$list[$key]['content'] = $val['content'];
				$list[$key]['dtime']   = $val['dtime'];

				$userinfo = $userLogin->getMemberInfo($val['userid']);
				if($userinfo && is_array($userinfo)){
					$list[$key]['user']['photo'] = $userinfo['photo'];
					$list[$key]['user']['nickname'] = $userinfo['nickname'];
				}else{
					$list[$key]['user']['photo'] = "";
					$list[$key]['user']['nickname'] = "游客";
				}

			}
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 发表评论
     * @return array
     */
	public function sendCommon(){
		global $dsql;
		global $userLogin;
		$param = $this->param;

		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请刷新页面重试！');

		$id      = $param['id'];   //订单ID
		$rating  = $param['rating'];
		$score1  = $param['score1'];
		$score2  = $param['score2'];
		$score3  = $param['score3'];
		$pics    = $param['pics'];
		$content = filterSensitiveWords(addslashes($param['content']));
		$ip      = GetIP();
		$ipaddr  = getIpAddr($ip);
		$date    = GetMkTime(time());

		if(empty($id)) return array("state" => 200, "info" => '要评价的商品ID传递失败，请从正确的地址发表评价');
		if(empty($rating) || empty($score1) || empty($score2) || empty($score3)) return array("state" => 200, "info" => '请先打分！');
		if(empty($content) || strlen($content) < 15) return array("state" => 200, "info" => '请输入评价内容，最少15个字！');

		//查询订单信息
		$sql = $dsql->SetQuery("SELECT `userid`, `orderstate` FROM `#@__tuan_order` WHERE `id` = '$id'");
		$order = $dsql->dsqlOper($sql, "results");
		if($order){
			if($order[0]['userid'] != $userid) return array("state" => 200, "info" => '验证账户权限失败，请使用购买过此商品的账号登录后再评价！');
			if($order[0]['orderstate'] != 3) return array("state" => 200, "info" => '订单当前状态不可评价，请使用后再评价！');
		}else{
			return array("state" => 200, "info" => '订单不存在，评价失败！');
		}

		//查询评价信息
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__tuancommon` WHERE `aid` = '$id'");
		$res = $dsql->dsqlOper($sql, "totalCount");

		//修改评价
		if($res > 0){

			$archives = $dsql->SetQuery("UPDATE `#@__tuancommon` SET `rating` = '$rating', `score1` = '$score1', `score2` = '$score2', `score3` = '$score3', `pics` = '$pics', `content` = '$content', `dtime` = '$date', `ip` = '$ip', `ipaddr` = '$ipaddr', `ischeck` = 0 WHERE `aid` = '$id'");

		//新增评价
		}else{

			$archives = $dsql->SetQuery("INSERT INTO `#@__tuancommon` (`aid`, `floor`, `userid`, `rating`, `score1`, `score2`, `score3`, `pics`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `ischeck`) VALUES ('$id', '0', '$userid', '$rating', '$score1', '$score2', '$score3', '$pics', '$content', '$date', '$ip', '$ipaddr', 0, 0, 0)");

		}

		$results  = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){

			$archives = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `common` = 1 WHERE `id` = '$id'");
			$dsql->dsqlOper($archives, "update");

			return "评论成功！";
		}else{
			return array("state" => 200, "info" => '评论失败！');
		}

	}


	/**
	 * 下单
	 * @return array
	 */
	public function deal(){
		global $dsql;
		global $userLogin;

		$param = $this->param;

		if(empty($param)) return array("state" => 200, "info" => '商品为空');

		$pros = $param['pros'];
		if(!is_array($pros)) return array("state" => 200, "info" => '格式错误');

		$userid = $userLogin->getMemberID();
		$addrid = (int)$param['addrid'];
		$deliveryType = (int)$param['deliveryType'];
		$comment = $param['comment'];

		$url = array();

		foreach ($pros as $key => $value) {
			$pro = explode(",", $value);

			$this->param = $pro[0];
			$detail = $this->detail();

			if($detail['store']['member']['userid'] == $userid) return array("state" => 200, "info" => '企业会员不可以购买自己的商品！');
			if(!is_array($detail)) return array("state" => 200, "info" => '商品不存在');
			if($detail['startdate'] > time()) return array("state" => 200, "info" => '团购活动还未开始');
			if($detail['enddate'] < time()) return array("state" => 200, "info" => '团购活动已经结束');
			if($detail['limit'] < $pro[1]) return array("state" => 200, "info" => '【'.$detail['title'].'】库存不足');

			// $price = $detail['price'] * $pro[1];
			$price = $detail['price'];

			//快递信息
			if($detail['tuantype'] == 2){

				// //物流费用
				// $freight = 0;
				// if($detail['freeshi'] <= $pro[1]){
				// 	$freight = $detail['freight'];
				// }
				// $price += $freight;

				//地址库
				if($addrid != 0){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__member_address` WHERE `uid` = $userid AND `id` = $addrid");
					$userAddr  = $dsql->dsqlOper($archives, "results");

					if(!$userAddr) return array("state" => 200, "info" => '会员地址库信息不存在或已删除');

					global $data;
					$data = "";
					$addrArr = getParentArr("site_area", $userAddr[0]['addrid']);
					$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
					$addr    = join(" ", $addrArr);

					$address = $addr . $userAddr[0]['address'];
					$person = $userAddr[0]['person'];
					$mobile = $userAddr[0]['mobile'];
					$tel    = $userAddr[0]['tel'];

					$contact = !empty($mobile) ? $mobile . (!empty($tel) ? " / ".$tel : "") : $tel;

				//新输入
				}else{

					$addressid = $param['addressid'];
					$address   = $param['address'];
					$person    = $param['person'];
					$mobile    = $param['mobile'];

					if(empty($addressid)) return array("state" => 200, "info" => '请选择所在区域');
					if(empty($address)) return array("state" => 200, "info" => '请输入街道地址');
					if(empty($person)) return array("state" => 200, "info" => '请输入收货人姓名');
					if(empty($mobile) && empty($tel)) return array("state" => 200, "info" => '手机号码和固定电话最少填写一项');

					if(!empty($mobile)){
						preg_match('/0?(13|14|15|17|18)[0-9]{9}/', $mobile, $matchPhone);
						if(!$matchPhone){
							return array("state" => 200, "info" => '手机格式有误');
						}
					}

					$address = cn_substrR($address, 50);
					$person  = cn_substrR($person, 15);
					$mobile  = cn_substrR($mobile, 11);
					$tel     = cn_substrR($tel, 20);

					//保存到用户常用地址库
					$handels = new handlers("member", "addressAdd");
					$handels->getHandle(array(
						"addrid"  => $addressid,
						"address" => $address,
						"person"  => $person,
						"mobile"  => $mobile,
						"tel"     => $tel
					));

					global $data;
					$data = "";
					$addrArr = getParentArr("site_area", $addressid);
					$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
					$addr    = join(" ", $addrArr);

					$address = $addr . $address;

					$contact = !empty($mobile) ? $mobile . (!empty($tel) ? " / ".$tel : "") : $tel;
				}

			}

			//快递类型的商品增加物流策略
			$policy = array();
			if($detail['tuantype'] == 2){
				$policy['freight'] = $detail['freight'];
				$policy['freeshi'] = $detail['freeshi'];
			}
			$data = serialize($policy);

			//判断是否为修改订单操作
			if(!empty($pro[2])){

				$archives = $dsql->SetQuery("SELECT `ordernum` FROM `#@__tuan_order` WHERE `id` = ".$pro[2]." AND `userid` = '$userid'");
				$sql  = $dsql->dsqlOper($archives, "results");
				if($sql){

					//快递
					if($detail['tuantype'] == 2){
						$archives = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `procount` = ".$pro[1].", `orderprice` = '$price', `propolic` = '$data', `useraddr` = '$address', `username` = '$person', `usercontact` = '$contact', `deliveryType` = '$deliveryType', `usernote` = '$comment' WHERE `id` = ".$pro[2]);
					}else{
						$archives = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `procount` = ".$pro[1].", `orderprice` = '$price', `propolic` = '$data' WHERE `id` = ".$pro[2]);
					}
					$res = $dsql->dsqlOper($archives, "update");
					if($res == "ok"){
						$ordernum = $sql[0]['ordernum'];
					}

				}else{
					return array("state" => 200, "info" => '订单不存在或已经删除，修改失败！');
				}

			//新订单
			}else{
				$ordernum = create_ordernum();

				//快递
				if($detail['tuantype'] == 2){
					$archives = $dsql->SetQuery("INSERT INTO `#@__tuan_order` (`ordernum`, `userid`, `proid`, `procount`, `orderprice`, `propolic`, `orderstate`, `orderdate`, `useraddr`, `username`, `usercontact`, `deliveryType`, `usernote`) VALUES ('$ordernum', '$userid', ".$pro[0].", ".$pro[1].", '$price', '$data', 0, ".GetMkTime(time()).", '$address', '$person', '$contact', '$deliveryType', '$comment')");
				}else{
					$archives = $dsql->SetQuery("INSERT INTO `#@__tuan_order` (`ordernum`, `userid`, `proid`, `procount`, `orderprice`, `propolic`, `orderstate`, `orderdate`) VALUES ('$ordernum', '$userid', ".$pro[0].", ".$pro[1].", '$price', '$data', 0, ".GetMkTime(time()).")");
				}
			}

			$return = $dsql->dsqlOper($archives, "update");
			if($return == "ok"){
				$url[] = $ordernum;
			}else{
				return array("state" => 200, "info" => '下单失败');
			}

		}

		$RenrenCrypt = new RenrenCrypt();
		$ids = base64_encode($RenrenCrypt->php_encrypt(join(",", $url)));

		$param = array(
			"service"     => "tuan",
			"template"    => "pay",
			"param"       => "ordernum=".$ids
		);
		return getUrlPath($param);

	}


	/**
	 * 修改订单的配送地址
	 * @return array
	 */
	public function editOrderAddr(){
		global $dsql;
		global $userLogin;
		$param = $this->param;

		$userid = $userLogin->getMemberID();
		$id     = (int)$param['id'];

		if($userid == -1) return array("state" => 200, "info" => '登录超时，请登录后重试！');

		//验证订单
		$archives = $dsql->SetQuery("SELECT * FROM `#@__tuan_order` WHERE `userid` = $userid AND `id` = $id");
		$res  = $dsql->dsqlOper($archives, "results");
		if(!$res) return array("state" => 200, "info" => '订单不存在或已删除，请确认后重试！');

		$date = GetMkTime(time());
		$order = $res[0];

		//验证状态
		if($order['orderstate'] == 0 || ($order['orderstate'] == 1 && $date - $order['paydate'] < 3600)){

			$addrid = (int)$param['addrid'];
			$deliveryType = (int)$param['deliveryType'];
			$comment = $param['comment'];

			//地址库
			if($addrid != 0){
				$archives = $dsql->SetQuery("SELECT * FROM `#@__member_address` WHERE `uid` = $userid AND `id` = $addrid");
				$userAddr  = $dsql->dsqlOper($archives, "results");

				if(!$userAddr) return array("state" => 200, "info" => '会员地址库信息不存在或已删除');

				global $data;
				$data = "";
				$addrArr = getParentArr("site_area", $userAddr[0]['addrid']);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$addr    = join(" ", $addrArr);

				$address = $addr . $userAddr[0]['address'];
				$person = $userAddr[0]['person'];
				$mobile = $userAddr[0]['mobile'];
				$tel    = $userAddr[0]['tel'];

				$contact = !empty($mobile) ? $mobile . (!empty($tel) ? " / ".$tel : "") : $tel;

			//新输入
			}else{

				$addressid = $param['addressid'];
				$address   = $param['address'];
				$person    = $param['person'];
				$mobile    = $param['mobile'];

				if(empty($addressid)) return array("state" => 200, "info" => '请选择所在区域');
				if(empty($address)) return array("state" => 200, "info" => '请输入街道地址');
				if(empty($person)) return array("state" => 200, "info" => '请输入收货人姓名');
				if(empty($mobile) && empty($tel)) return array("state" => 200, "info" => '手机号码和固定电话最少填写一项');

				if(!empty($mobile)){
					preg_match('/0?(13|14|15|17|18)[0-9]{9}/', $mobile, $matchPhone);
					if(!$matchPhone){
						return array("state" => 200, "info" => '手机格式有误');
					}
				}

				$address = cn_substrR($address, 50);
				$person  = cn_substrR($person, 15);
				$mobile  = cn_substrR($mobile, 11);
				$tel     = cn_substrR($tel, 20);

				//保存到用户常用地址库
				$handels = new handlers("member", "addressAdd");
				$handels->getHandle(array(
					"addrid"  => $addressid,
					"address" => $address,
					"person"  => $person,
					"mobile"  => $mobile,
					"tel"     => $tel
				));

				global $data;
				$data = "";
				$addrArr = getParentArr("site_area", $addressid);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$addr    = join(" ", $addrArr);

				$address = $addr . $address;

				$contact = !empty($mobile) ? $mobile . (!empty($tel) ? " / ".$tel : "") : $tel;
			}

			$archives = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `useraddr` = '$address', `username` = '$person', `usercontact` = '$contact', `deliveryType` = '$deliveryType', `usernote` = '$comment' WHERE `id` = ".$id);
			$res = $dsql->dsqlOper($archives, "update");
			if($res == "ok"){
				return "修改成功！";
			}else{
				return array("state" => 200, "info" => "程序错误，修改失败！");
			}

		}else{

			if($order['orderstate'] == 1){
				return array("state" => 200, "info" => "支付时间已超过1个小时，修改失败！");
			}else{
				return array("state" => 200, "info" => "订单当前状态无法修改配送信息！");
			}

		}

	}


	/**
	 * 支付前验证帐户积分和余额
	 */
	public function checkPayAmount(){
		global $dsql;
		global $userLogin;
		global $cfg_pointName;
		global $cfg_pointRatio;

		$userid   = $userLogin->getMemberID();
		$param    = $this->param;

		//订单状态验证
		$payCheck = $this->payCheck();
		if($payCheck != "ok") return array("state" => 200, "info" => $payCheck['info']);

		$ordernum   = $param['ordernum'];    //订单号
		$usePinput  = $param['usePinput'];   //是否使用积分
		$point      = $param['point'];       //使用的积分
		$useBalance = $param['useBalance'];  //是否使用余额
		$balance    = $param['balance'];     //使用的余额
		$paypwd     = $param['paypwd'];      //支付密码

		if($userid == -1) return array("state" => 200, "info" => "登录超时，请登录后重试！");
		if(empty($ordernum)) return array("state" => 200, "info" => "提交失败，订单号不能为空！");
		// if(empty($point) && empty($balance) && empty($paypwd)) return array("state" => 200, "info" => "$cfg_pointName或余额至少选择一项！");
		if(!empty($balance) && empty($paypwd)) return array("state" => 200, "info" => "请输入支付密码！");

		$totalPrice = 0;
		$ordernumArr = explode(",", $ordernum);
		foreach ($ordernumArr as $key => $value) {

			//查询订单信息
			$archives = $dsql->SetQuery("SELECT `procount`, `orderprice`, `propolic` FROM `#@__tuan_order` WHERE `ordernum` = '$value'");
			$results  = $dsql->dsqlOper($archives, "results");
			$res = $results[0];
			$procount   = $res['procount'];
			$orderprice = $res['orderprice'];
			$propolic   = $res['propolic'];
			$policy     = unserialize($propolic);

			$totalPrice += $orderprice * $procount;
			if(!empty($propolic) && !empty($policy)){
				$freight  = $policy['freight'];
				$freeshi  = $policy['freeshi'];

				if($procount <= $freeshi){
					$totalPrice += $freight;
				}
			}

		}


		//查询会员信息
		$userinfo  = $userLogin->getMemberInfo();
		$usermoney = $userinfo['money'];
		$userpoint = $userinfo['point'];

		$tit      = array();
		$useTotal = 0;

		//判断是否使用积分，并且验证剩余积分
		if($usePinput == 1 && !empty($point)){
			if($userpoint < $point) return array("state" => 200, "info" => "您的可用".$cfg_pointName."不足，支付失败！");
			$useTotal += $point / $cfg_pointRatio;
			$tit[] = $cfg_pointName;
		}

		//判断是否使用余额，并且验证余额和支付密码
		if($useBalance == 1 && !empty($balance) && !empty($paypwd)){

			//验证支付密码
			$archives = $dsql->SetQuery("SELECT `id`, `paypwd` FROM `#@__member` WHERE `id` = '$userid'");
			$results  = $dsql->dsqlOper($archives, "results");
			$res = $results[0];
			$hash = $userLogin->_getSaltedHash($paypwd, $res['paypwd']);
			if($res['paypwd'] != $hash) return array("state" => 200, "info" => "支付密码输入错误，请重试！");

			//验证余额
			if($usermoney < $balance) return array("state" => 200, "info" => "您的余额不足，支付失败！");

			$useTotal += $balance;
			$tit[] = "余额";
		}

		if($useTotal > $totalPrice) return array("state" => 200, "info" => "您使用的".join("和", $tit)."超出订单总费用，请重新输入要使用的".join("和", $tit));

		//返回需要支付的费用
		return sprintf("%.2f", $totalPrice - $useTotal);

	}


	/**
	 * 支付
	 * @return array
	 */
	public function pay(){
		global $dsql;
		global $cfg_basehost;
		global $cfg_pointRatio;

		$param =  $this->param;

		//验证需要支付的费用
		$payTotalAmount = $this->checkPayAmount();

		//重置表单参数
		$this->param = $param;

		if($this->payCheck() != "ok" || is_array($payTotalAmount)){
			$param = array(
				"service"     => "member",
				"type"        => "user",
				"template"    => "order",
				"module"      => "tuan"
			);
			$url = getUrlPath($param);

			header("location:".$url);
			die;
			die("提交失败，请进入会员中心重新提交！");
		}

		$ordernum   = $param['ordernum'];
		$paytype    = $param['paytype'];
		$usePinput  = $param['usePinput'];
		$point      = (float)$param['point'];
		$useBalance = $param['useBalance'];
		$balance    = (float)$param['balance'];
		$ordernumArr = explode(",", $ordernum);

		//如果有使用积分或余额则更新订单内容的价格策略
		if(($usePinput && !empty($point)) || ($useBalance && !empty($balance))){

			$pointMoney = $point / $cfg_pointRatio;
			$balanceMoney = $balance;

			foreach ($ordernumArr as $key => $value) {

				//查询订单信息
				$archives = $dsql->SetQuery("SELECT `procount`, `orderprice`, `propolic` FROM `#@__tuan_order` WHERE `ordernum` = '$value'");
				$results  = $dsql->dsqlOper($archives, "results");
				$res = $results[0];
				$procount   = $res['procount'];   //数量
				$orderprice = $res['orderprice']; //单价
				$propolic   = $res['propolic'];   //物流政策
				$policy     = unserialize($propolic);

				$oprice = $procount * $orderprice;  //单个订单总价 = 数量 * 单价

				//验证物流费用
				if(!empty($propolic) && !empty($policy)){
					$freight  = $policy['freight'];
					$freeshi  = $policy['freeshi'];

					//如果达不到免物流费的数量，则总价再加上运费
					if($procount <= $freeshi){
						$oprice += $freight;
					}
				}

				$usePointMoney = 0;
				$useBalanceMoney = 0;


				//先判断积分是否足够支付总价
				//如果足够支付：
				//1.把还需要支付的总价重置为0
				//2.积分总额减去用掉的
				//3.记录已经使用的积分
				if($oprice < $pointMoney){

					$pointMoney -= $oprice;
					$usePointMoney = $oprice;
					$oprice = 0;


				//积分不够支付再判断余额是否足够
				//如果积分不足以支付总价：
				//1.总价减去积分抵扣掉的部部分
				//2.积分总额设置为0
				//3.记录已经使用的积分
				}else{

					$oprice -= $pointMoney;
					$usePointMoney = $pointMoney;
					$pointMoney = 0;

					//验证余额是否足够支付剩余部分的总价
					//如果足够支付：
					//1.把还需要支付的总价重置为0
					//2.余额减去用掉的部分
					//3.记录已经使用的余额
					if($oprice < $balanceMoney){

						$balanceMoney -= $oprice;
						$useBalanceMoney = $oprice;
						$oprice = 0;

					//余额不够支付的情况
					//1.总价减去余额付过的部分
					//2.余额设置为0
					//3.记录已经使用的余额
					}else{

						$oprice -= $balanceMoney;
						$useBalanceMoney = $balanceMoney;
						$balanceMoney = 0;

					}

				}

				$pointMoney_ = $usePointMoney * $cfg_pointRatio;
				$archives = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `point` = '$pointMoney_', `balance` = '$useBalanceMoney', `payprice` = '$oprice' WHERE `ordernum` = '$value'");
				$dsql->dsqlOper($archives, "update");
			}

		//如果没有使用积分或余额，重置积分&余额等价格信息
		}else{
			foreach ($ordernumArr as $key => $value) {

				//查询订单信息
				$archives = $dsql->SetQuery("SELECT `procount`, `orderprice`, `propolic` FROM `#@__tuan_order` WHERE `ordernum` = '$value'");
				$results  = $dsql->dsqlOper($archives, "results");
				$res = $results[0];
				$procount   = $res['procount'];   //数量
				$orderprice = $res['orderprice']; //单价
				$propolic   = $res['propolic'];   //物流政策
				$policy     = unserialize($propolic);

				$oprice = $procount * $orderprice;  //单个订单总价 = 数量 * 单价

				//验证物流费用
				if(!empty($propolic) && !empty($policy)){
					$freight  = $policy['freight'];
					$freeshi  = $policy['freeshi'];

					//如果达不到免物流费的数量，则总价再加上运费
					if($procount <= $freeshi){
						$oprice += $freight;
					}
				}

				$archives = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `point` = '0', `balance` = '0', `payprice` = '$oprice' WHERE `ordernum` = '$value'");
				$dsql->dsqlOper($archives, "update");
			}
		}


		//1.如果需要支付的金额小于等于0，表示会员使用积分或余额已经付清了，不需要另外去支付
		//2.这种情况直接更新订单状态，并跳转至支付成功页即可
		//3.对会员的积分和余额进行扣除操作
		if($payTotalAmount <= 0){

			$date = GetMkTime(time());
			$paytype = array();

			//扣除会员账户积分和余额
			foreach ($ordernumArr as $key => $value) {

				//查询订单信息
				$archives = $dsql->SetQuery("SELECT `userid`, `point`, `balance` FROM `#@__tuan_order` WHERE `ordernum` = '$value'");
				$results  = $dsql->dsqlOper($archives, "results");
				$res = $results[0];
				$userid  = $res['userid'];   //购买用户ID
				$upoint   = $res['point'];    //使用的积分
				$ubalance = $res['balance'];  //使用的余额

				//扣除会员积分
				if(!empty($upoint) && $upoint > 0){
					// $archives = $dsql->SetQuery("UPDATE `#@__member` SET `point` = `point` - '$upoint' WHERE `id` = '$userid'");
					// $dsql->dsqlOper($archives, "update");
					//
					// //保存操作日志
					// $archives = $dsql->SetQuery("INSERT INTO `#@__member_point` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$upoint', '支付团购订单：$value', '$date')");
					// $dsql->dsqlOper($archives, "update");

					$paytype[] = "point";
				}

				//扣除会员余额
				if(!empty($ubalance) && $ubalance > 0){
					// $archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - '$ubalance' WHERE `id` = '$userid'");
					// $dsql->dsqlOper($archives, "update");
					//
					// //保存操作日志
					// $archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$ubalance', '支付团购订单：$value', '$date')");
					// $dsql->dsqlOper($archives, "update");

					$paytype[] = "money";
				}

			}


			//增加支付日志
			$paylognum = create_ordernum();
			$archives = $dsql->SetQuery("INSERT INTO `#@__pay_log` (`ordertype`, `ordernum`, `uid`, `body`, `amount`, `paytype`, `state`) VALUES ('tuan', '$paylognum', '$userid', '$ordernum', '0', '".join(",", $paytype)."', '1')");
			$dsql->dsqlOper($archives, "update");


			//执行支付成功的操作
			$this->param = array(
				"paytype" => join(",", $paytype),
				"ordernum" => $ordernum
			);
			$this->paySuccess();

			//跳转至支付成功页面
			$param = array(
				"service"     => "tuan",
				"template"    => "payreturn",
				"ordernum"    => $paylognum
			);
			$url = getUrlPath($param);
			header("location:".$url);

		}else{

			//跳转至第三方支付页面
			createPayForm("tuan", $ordernum, $payTotalAmount, $paytype, "团购订单");

		}



	}


	/**
	 * 支付前验证订单内容
	 * @return array
	 */
	public function payCheck(){
		global $dsql;
		global $userLogin;

		$param = $this->param;
		$ordernum = $param['ordernum'];

		if(empty($ordernum)) return array("state" => 200, "info" => "订单号传递失败！");

		$userid = $userLogin->getMemberID();
		$ordernumArr = explode(",", $ordernum);
		foreach ($ordernumArr as $key => $value) {

			//获取订单内容
			$archives = $dsql->SetQuery("SELECT `proid`, `procount`, `orderprice`, `orderstate` FROM `#@__tuan_order` WHERE `ordernum` = '$value' AND `userid` = $userid");
			$orderDetail  = $dsql->dsqlOper($archives, "results");
			if($orderDetail){

				$proid      = $orderDetail[0]['proid'];
				$procount   = $orderDetail[0]['procount'];
				$orderprice = $orderDetail[0]['orderprice'];
				$orderstate = $orderDetail[0]['orderstate'];

				//验证订单状态
				if($orderstate != 0){
					$info = count($ordernumArr) > 1 ? "订单中包含状态异常的订单，请确认后重试！" : "订单状态异常，请确认后重试！";
					return array("state" => 200, "info" => $info);
				}

				$this->param = $proid;
				$proDetail = $this->detail();

				//验证是否为自己的店铺
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `uid` = $userid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					if($proDetail['sid'] == $ret[0]['id']){
						return array("state" => 200, "info" => "企业会员不得购买自己店铺的商品！");
					}
				}

				//获取商品详细信息
				if($proDetail && $proDetail['enddate'] > time()){

					//验证商品库存
					if($proDetail['limit'] < $procount){
						return array("state" => 200, "info" => "商品：".$proDetail['title']." 库存不足，请确认后重试！");
					}


					//成功不做处理，自动运行至结束返回ok


				//商品不存在
				}else{
					$info = count($ordernumArr) > 1 ? "订单中包含不存在或已下架的商品，请确认后重试！" : "提交失败，您要购买的商品不存在或已下架！";
					return array("state" => 200, "info" => $info);
				}

			//订单不存在
			}else{
				$info = count($ordernumArr) > 1 ? "订单中包含不存在的订单，请确认后重试！" : "订单不存在或已删除，请确认后重试！";
				return array("state" => 200, "info" => $info);
			}

		}

		return "ok";

	}


	/**
	 * 支付成功
	 * 此处进行支付成功后的操作，例如发送短信等服务
	 *
	 */
	public function paySuccess(){
		$param = $this->param;
		if(!empty($param)){
			global $dsql;

			$paytype  = $param['paytype'];
			$paramArr = explode(",", $param['ordernum']);
			$date = GetMkTime(time());

			foreach ($paramArr as $key => $value) {

				//查询订单信息
				$archives = $dsql->SetQuery("SELECT o.`id`, o.`userid`, o.`proid`, o.`procount`, o.`point`, o.`balance`, o.`payprice`, o.`paydate`, l.`title`, l.`tuantype`, l.`expireddate`, s.`uid` FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON s.`id` = l.`sid` WHERE o.`ordernum` = '$value'");
				$res = $dsql->dsqlOper($archives, "results");

				if($res){
					$title    = $res[0]['title'];
					$orderid  = $res[0]['id'];
					$uid      = $res[0]['uid'];
					$userid   = $res[0]['userid'];
					$proid    = $res[0]['proid'];
					$procount = $res[0]['procount'];
					$upoint    = $res[0]['point'];
					$ubalance  = $res[0]['balance'];
					$payprice  = $res[0]['payprice'];
					$paydate  = $res[0]['paydate'];
					$tuantype = $res[0]['tuantype'];
					$expireddate = $res[0]['expireddate'];

					//判断是否已经更新过状态，如果已经更新过则不进行下面的操作
					if($paydate == 0){

						//更新订单状态
						$archives = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 1, `paydate` = '$date', `paytype` = '$paytype' WHERE `ordernum` = '$value'");
						$dsql->dsqlOper($archives, "update");

						//更新已购买数量
						$sql = $dsql->SetQuery("UPDATE `#@__tuanlist` SET `buynum` = `buynum` + $procount WHERE `id` = '$proid'");
						$dsql->dsqlOper($sql, "update");


						$totalPrice = $payprice;

						//扣除会员积分
						if(!empty($upoint) && $upoint > 0){
							$archives = $dsql->SetQuery("UPDATE `#@__member` SET `point` = `point` - '$upoint' WHERE `id` = '$userid'");
							$dsql->dsqlOper($archives, "update");

							//保存操作日志
							$archives = $dsql->SetQuery("INSERT INTO `#@__member_point` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$upoint', '支付团购订单：$value', '$date')");
							$dsql->dsqlOper($archives, "update");
						}

						//扣除会员余额
						if(!empty($ubalance) && $ubalance > 0){
							$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - '$ubalance' WHERE `id` = '$userid'");
							$dsql->dsqlOper($archives, "update");

							//保存操作日志，下面已经有冻结的记录，里面包含了余额
							//$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$ubalance', '支付团购订单：$value', '$date')");
							//$dsql->dsqlOper($archives, "update");

							$totalPrice += $ubalance;
						}


						//增加冻结金额
						$archives = $dsql->SetQuery("UPDATE `#@__member` SET `freeze` = `freeze` + '$totalPrice' WHERE `id` = '$userid'");
						$dsql->dsqlOper($archives, "update");

						//保存操作日志
						$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$totalPrice', '团购消费冻结：$value', '$date')");
						$dsql->dsqlOper($archives, "update");



						//生成团购券
						if($tuantype == 0){
							$sqlQuan = array();
							$carddate = GetMkTime(time());
							for ($i = 0; $i < $procount; $i++) {
								$cardnum = genSecret(12, 1);
								$sqlQuan[$i] = "('$orderid', '$cardnum', '$carddate', 0, '$expireddate')";
							}

							$sql = $dsql->SetQuery("INSERT INTO `#@__tuanquan` (`orderid`, `cardnum`, `carddate`, `usedate`, `expireddate`) VALUES ".join(",", $sqlQuan));
							$dsql->dsqlOper($sql, "update");
						}

						//生成充值卡



						//支付成功，会员消息通知
						$paramUser = array(
							"service"  => "member",
							"type"     => "user",
							"template" => "orderdetail",
							"action"   => "tuan",
							"id"       => $orderid
						);

						$paramBusi = array(
							"service"  => "member",
							"template" => "orderdetail",
							"action"   => "tuan",
							"id"       => $orderid
						);

						//获取会员名
						$username = "";
						$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $userid");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$username = $ret[0]['username'];
						}
						updateMemberNotice($userid, "会员-订单支付成功", $paramUser, array("username" => $userResult[0]['username'], "title" => $title, "order" => $value, 'amount' => $totalPrice));

						//获取会员名
						$username = "";
						$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$username = $ret[0]['username'];
						}
						updateMemberNotice($uid, "会员-商家新订单通知", $paramBusi, array("username" => $username, "title" => $title, "order" => $value, "amount" => $totalPrice, "date" => date("Y-m-d H:i:s", time())));


					}

				}
			}
		}
	}


	/**
		* 配置商铺
		* @return array
		*/
	public function storeConfig(){
		global $dsql;
		global $userLogin;

		$userid      = $userLogin->getMemberID();
		$param       = $this->param;
		$stype       = (int)$param['stype'];
		$addrid      = (int)$param['addrid'];
		$circle      = $param['circle'];
		$circle      = isset($circle) ? join(',', $circle) : '';
		$subway      = $param['subway'];
		$subway      = isset($subway) ? join(',', $subway) : '';
		$address     = filterSensitiveWords(addslashes($param['address']));
		$lnglat      = filterSensitiveWords(addslashes($param['lnglat']));
		$phone       = filterSensitiveWords(addslashes($param['phone']));
		$openStart   = filterSensitiveWords(addslashes($param['openStart']));
		$openEnd     = filterSensitiveWords(addslashes($param['openEnd']));
		$note        = filterSensitiveWords(addslashes($param['note']));
		$body        = filterSensitiveWords(addslashes($param['body']));
		$vdimgck     = $param['vdimgck'];
		$pubdate     = GetMkTime(time());

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if($userid == 0 && $userid == ''){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//验证会员类型
		$userDetail = $userLogin->getMemberInfo();
		if($userDetail['userType'] != 2){
			return array("state" => 200, "info" => '账号验证错误，操作失败！');
		}

		if(empty($stype)){
			return array("state" => 200, "info" => '请选择所属类别');
		}

		if(empty($addrid)){
			return array("state" => 200, "info" => '请选择所在区域');
		}

		if(empty($circle)){
			//return array("state" => 200, "info" => '请选择所在商圈');
		}

		if(empty($address)){
			return array("state" => 200, "info" => '请输入详细地址');
		}

		if(empty($phone)){
			return array("state" => 200, "info" => '请输入联系电话');
		}

		if(empty($openStart) || empty($openEnd)){
			return array("state" => 200, "info" => '请选择营业时间');
		}
		$openStart = str_replace(":", "", $openStart);
		$openEnd   = str_replace(":", "", $openEnd);

		if(empty($note)){
			//return array("state" => 200, "info" => '请输入简介');
		}
		$note = cn_substrR($note, 200);

		if(empty($body)){
			return array("state" => 200, "info" => '请输入详细介绍');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");

		//新商铺
		if(!$userResult){

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__tuan_store` (`uid`, `stype`, `subway`, `addrid`, `address`, `circle`, `lnglat`, `tel`, `openStart`, `openEnd`, `note`, `body`, `jointime`, `click`, `weight`, `state`) VALUES ('$userid', '$stype', '$subway', '$addrid', '$address', '$circle', '$lnglat', '$phone', '$openStart', '$openEnd', '$note', '$body', '$pubdate', '1', '1', '0')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("tuan", "store");

				return "配置成功，您的商铺正在审核中，请耐心等待！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		//更新商铺信息
		}else{

			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__tuan_store` SET `subway` = '$subway', `addrid` = '$addrid', `address` = '$address', `circle` = '$circle', `lnglat` = '$lnglat', `tel` = '$phone', `openStart` = '$openStart', `openEnd` = '$openEnd', `note` = '$note', `body` = '$body' WHERE `uid` = ".$userid);
			$results = $dsql->dsqlOper($archives, "update");

			if($results == "ok"){
				return "保存成功！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		}


	}


	/**
		* 发布信息
		* @return array
		*/
	public function put(){
		global $dsql;
		global $userLogin;

		$userid      = $userLogin->getMemberID();
		$param       = $this->param;
		$title       = filterSensitiveWords(addslashes($param['title']));
		$subtitle    = filterSensitiveWords(addslashes($param['subtitle']));
		$litpic      = $param['litpic'];
		$imglist     = $param['imglist'];
		$startdate   = $param['startdate'];
		$startdate   = !empty($startdate) ? GetMkTime($startdate) : 0;
		$enddate     = $param['enddate'];
		$enddate     = !empty($enddate) ? GetMkTime($enddate) : 0;
		$hourly      = (int)$param['hourly'];
		$maxnum      = (int)$param['maxnum'];
		$limit       = (int)$param['limit'];
		$market      = (float)$param['market'];
		$price       = (float)$param['price'];
		$tuantype    = (int)$param['tuantype'];
		$expireddate = $enddate;
		$expireddate = !empty($expireddate) ? GetMkTime($expireddate) : 0;
		$freight     = (int)$param['freight'];
		$freeshi     = (int)$param['freeshi'];
		$flags       = $param['flags'];
		$flags       = isset($flags) ? join(',', $flags) : '';
		$tips        = filterSensitiveWords(addslashes($param['tips']));
		$notice      = filterSensitiveWords(addslashes($param['notice']));
		$packtype    = (int)$param['packtype'];
		$package     = filterSensitiveWords(addslashes($param['package']));
		$body        = filterSensitiveWords(addslashes($param['body']));
		$vdimgck     = $param['vdimgck'];
		$pubdate     = GetMkTime(time());

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');


		if($userid == 0 && $userid == ''){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `stype`, `state` FROM `#@__tuan_store` WHERE `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通团购店铺！');
		}

		if($userResult[0]['state'] == 0){
			return array("state" => 200, "info" => '您的商铺信息还在审核中，请通过审核后再发布！');
		}

		if($userResult[0]['state'] == 2){
			return array("state" => 200, "info" => '您的商铺信息审核失败，请通过审核后再发布！');
		}

		$sid = $userResult[0]['id'];

		if(empty($title)){
			return array("state" => 200, "info" => '标题不能为空');
		}

		if(empty($subtitle)){
			return array("state" => 200, "info" => '副标题不能为空');
		}

		if(empty($litpic)){
			return array("state" => 200, "info" => '请上传代表图片');
		}

		if(empty($imglist)){
			return array("state" => 200, "info" => '请上传图集');
		}

		if(!empty($startdate) && !empty($enddate)){
			$startdate = GetMkTime($startdate);
			$enddate = GetMkTime($enddate);
			if($enddate - $startdate < 0){
				return array("state" => 200, "info" => '结束时间不能小于开始时间');
			}
		}else{
			return array("state" => 200, "info" => '请选择团购时间');
		}

		// if($tuantype == 2){
		// 	if($freight ===''){
		// 		return array("state" => 200, "info" => '请输入运费');
		// 	}
		// 	if($freeshi === ''){
		// 		return array("state" => 200, "info" => '请输入免运费政策');
		// 	}
		// }

		$itemResults = array();
		$typeid = $userResult[0]['stype'];
		$checktype = $dsql->SetQuery("SELECT `parentid` FROM `#@__tuantype` WHERE `id` = ".$typeid);
		$typeResults = $dsql->dsqlOper($checktype, "results");
		$tt = $typeResults[0]['parentid'] != 0 ? $typeResults[0]['parentid'] : $typeid;

		$infoitem = $dsql->SetQuery("SELECT * FROM `#@__tuantypeitem` WHERE `tid` = ".$tt." ORDER BY `orderby` DESC");
		$itemResults = $dsql->dsqlOper($infoitem, "results");

		//验证字段内容
		if(count($itemResults) > 0){
			foreach ($itemResults as $key=>$value) {
				if($value["required"] == 1 && $_POST['item_'.$value["id"]] == ""){
					if($value["formtype"] == "text"){
						return array("state" => 200, "info" => $value['title'].'不能为空');
					}else{
						return array("state" => 200, "info" => '请选择'.$value['title']);
					}
				}
			}
		}

		if(trim($body) == ''){
			return array("state" => 200, "info" => '请输入团购详情');
		}

		$ip = GetIP();
		$ipAddr = getIpAddr($ip);

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__tuanlist` (`sid`, `title`, `subtitle`, `startdate`, `enddate`, `hourly`, `minnum`, `maxnum`, `limit`, `defbuynum`, `tuantype`, `expireddate`, `amount`, `freight`, `freeshi`, `litpic`, `pics`, `market`, `price`, `arcrank`, `weight`, `flag`, `tips`, `notice`, `packtype`, `package`, `body`, `mbody`, `pubdate`, `ip`, `ipaddr`) VALUES ('$sid', '$title', '$subtitle', '$startdate', '$enddate', '$hourly', '1', '$maxnum', '$limit', '0', '$tuantype', '$expireddate', '0', '$freight', '$freeshi', '$litpic', '$imglist', '$market', '$price', '0', '1', '$flags', '$tips', '$notice', '$packtype', '$package', '$body', '$body', '$pubdate', '$ip', '$ipAddr')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			//保存字段内容
			if(count($itemResults) > 0){
				foreach ($itemResults as $key=>$value) {
					$val = $_POST['item_'.$value['id']];
					if($value['formtype'] == "checkbox"){
						if(is_array($val)){
							$val = join(",", $val);
						}
					}
					$infoitem = $dsql->SetQuery("INSERT INTO `#@__tuanitem` (`aid`, `iid`, `value`) VALUES (".$aid.", ".$value['id'].", '".$val."')");
					$dsql->dsqlOper($infoitem, "update");
				}
			}

			//后台消息通知
			updateAdminNotice("tuan", "detail");

			return $aid;
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 修改信息
		* @return array
		*/
	public function edit(){
		global $dsql;
		global $userLogin;

		$userid      = $userLogin->getMemberID();
		$param       = $this->param;
		$id          = $param['id'];
		$title       = filterSensitiveWords(addslashes($param['title']));
		$subtitle    = filterSensitiveWords(addslashes($param['subtitle']));
		$litpic      = $param['litpic'];
		$imglist     = $param['imglist'];
		$startdate   = $param['startdate'];
		$startdate   = !empty($startdate) ? GetMkTime($startdate) : 0;
		$enddate     = $param['enddate'];
		$enddate     = !empty($enddate) ? GetMkTime($enddate) : 0;
		$hourly      = (int)$param['hourly'];
		$maxnum      = (int)$param['maxnum'];
		$limit       = (int)$param['limit'];
		$market      = (float)$param['market'];
		$price       = (float)$param['price'];
		// $tuantype    = (int)$param['tuantype'];
		// $expireddate = $param['expireddate'];
		// $expireddate = !empty($expireddate) ? GetMkTime($expireddate) : 0;
		// $freight     = (int)$param['freight'];
		// $freeshi     = (int)$param['freeshi'];
		$flags       = $param['flags'];
		$flags       = isset($flags) ? join(',', $flags) : '';
		$tips        = filterSensitiveWords(addslashes($param['tips']));
		$notice      = filterSensitiveWords(addslashes($param['notice']));
		$packtype    = (int)$param['packtype'];
		$package     = filterSensitiveWords(addslashes($param['package']));
		$body        = filterSensitiveWords(addslashes($param['body']));
		$vdimgck     = $param['vdimgck'];

		if(empty($id)) return array("state" => 200, "info" => '数据传递失败！');

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if($userid == 0 && $userid == ''){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `stype` FROM `#@__tuan_store` WHERE `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通团购店铺！');
		}

		$sid = $userResult[0]['id'];

		$archives = $dsql->SetQuery("SELECT `id` FROM `#@__tuanlist` WHERE `id` = ".$id." AND `sid` = ".$sid);
		$results  = $dsql->dsqlOper($archives, "results");
		if(!$results){
			return array("state" => 200, "info" => '权限不足，修改失败！');
		}

		if(empty($title)){
			return array("state" => 200, "info" => '标题不能为空');
		}

		if(empty($subtitle)){
			return array("state" => 200, "info" => '副标题不能为空');
		}

		if(empty($litpic)){
			return array("state" => 200, "info" => '请上传代表图片');
		}

		if(empty($imglist)){
			return array("state" => 200, "info" => '请上传图集');
		}

		if(!empty($startdate) && !empty($enddate)){
			$startdate = GetMkTime($startdate);
			$enddate = GetMkTime($enddate);
			if($enddate - $startdate < 0){
				return array("state" => 200, "info" => '结束时间不能小于开始时间');
			}
		}else{
			return array("state" => 200, "info" => '请选择团购时间');
		}

		// if($tuantype == 2){
		// 	if($freight == ''){
		// 		return array("state" => 200, "info" => '请输入运费');
		// 	}
		// 	if($freeshi == ''){
		// 		return array("state" => 200, "info" => '请输入免运费政策');
		// 	}
		// }

		$itemResults = array();
		$typeid = $userResult[0]['stype'];
		$checktype = $dsql->SetQuery("SELECT `parentid` FROM `#@__tuantype` WHERE `id` = ".$typeid);
		$typeResults = $dsql->dsqlOper($checktype, "results");
		$tt = $typeResults[0]['parentid'] != 0 ? $typeResults[0]['parentid'] : $typeid;

		$infoitem = $dsql->SetQuery("SELECT * FROM `#@__tuantypeitem` WHERE `tid` = ".$tt." ORDER BY `orderby` DESC");
		$itemResults = $dsql->dsqlOper($infoitem, "results");

		//验证字段内容
		if(count($itemResults) > 0){
			foreach ($itemResults as $key=>$value) {
				if($value["required"] == 1 && $_POST['item_'.$value["id"]] == ""){
					if($value["formtype"] == "text"){
						return array("state" => 200, "info" => $value['title'].'不能为空');
					}else{
						return array("state" => 200, "info" => '请选择'.$value['title']);
					}
				}
			}
		}

		if(trim($body) == ''){
			return array("state" => 200, "info" => '请输入团购详情');
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__tuanlist` SET `title` = '$title', `subtitle` = '$subtitle', `startdate` = '$startdate', `enddate` = '$enddate', `hourly` = '$hourly', `maxnum` = '$maxnum', `limit` = '$limit', `litpic` = '$litpic', `pics` = '$imglist', `market` = '$market', `price` = '$price', `arcrank` = '0', `flag` = '$flags', `tips` = '$tips', `notice` = '$notice', `packtype` = '$packtype', `package` = '$package', `body` = '$body', `mbody` = '$body' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results != "ok"){
			return array("state" => 200, "info" => '保存到数据时发生错误，请检查字段内容！');
		}

		//先删除信息所属字段
		$archives = $dsql->SetQuery("DELETE FROM `#@__tuanitem` WHERE `aid` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		//保存字段内容
		if(count($itemResults) > 0){
			foreach ($itemResults as $key=>$value) {
				$val = $_POST["item_".$value['id']];
				if($value['formtype'] == "checkbox"){
					if(is_array($val)){
						$val = join(",", $val);
					}
				}

				$infoitem = $dsql->SetQuery("INSERT INTO `#@__tuanitem` (`aid`, `iid`, `value`) VALUES (".$id.", ".$value['id'].", '".$val."')");
				$dsql->dsqlOper($infoitem, "update");
			}
		}

		//后台消息通知
		updateAdminNotice("tuan", "detail");

		return "修改成功！";

	}


	/**
		* 删除信息
		* @return array
		*/
	public function del(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__tuanlist` l LEFT JOIN `#@__tuan_store` s ON s.`id` = l.`sid` WHERE l.`id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];

			if($results['arcrank'] == 1) return array("state" => 200, "info" => '商品当前状态不可以删除！');

			if($results['uid'] == $uid){

				//删除评论
				$archives = $dsql->SetQuery("DELETE FROM `#@__tuancommon` WHERE `aid` = ".$id);
				$dsql->dsqlOper($archives, "update");

				$orderid = array();
				//删除相应的订单、团购券、充值卡数据
				$orderSql = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_order` WHERE `proid` = ".$id);
				$orderResult = $dsql->dsqlOper($orderSql, "results");

				if($orderResult){
					foreach($orderResult as $key => $order){
						array_push($orderid, $order['id']);
					}

					if(!empty($orderid)){
						$orderid = join(",", $orderid);

						$quanSql = $dsql->SetQuery("DELETE FROM `#@__tuanquan` WHERE `orderid` in (".$orderid.")");
						$dsql->dsqlOper($quanSql, "update");

						$quanSql = $dsql->SetQuery("DELETE FROM `#@__paycard` WHERE `module` = 'tuan' AND `orderid` in (".$orderid.")");
						$dsql->dsqlOper($quanSql, "update");
					}

					$quanSql = $dsql->SetQuery("DELETE FROM `#@__tuan_order` WHERE `proid` = ".$id);
					$dsql->dsqlOper($quanSql, "update");
				}

				//删除缩略图
				delPicFile($results['litpic'], "delThumb", "tuan");
				//删除图集
				delPicFile($results['pics'], "delAtlas", "tuan");

				$body = $results['body'];
				if(!empty($body)){
					delEditorPic($body, "tuan");
				}

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__tuanlist` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");

				return array("state" => 100, "info" => '删除成功！');
			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '商品不存在，或已经删除！');
		}

	}


	/**
     * 团购券列表
     * @return array
     */
	public function quanList(){
		global $dsql;
		global $userLogin;

		$pageinfo = $list = $orderid = array();
		$page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}


		$archives = $dsql->SetQuery("SELECT q.`id`, q.`cardnum`, q.`usedate`, o.`proid`, o.`orderprice` FROM `#@__tuan_order` o LEFT JOIN `#@__tuanquan` q ON o.`id` = q.`orderid` LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE q.`usedate` <> 0 AND s.`uid` = '$uid' ORDER BY q.`usedate` DESC");

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
		$results = $dsql->dsqlOper($archives." LIMIT $atpage, $pageSize", "results");

		if(count($results) > 0){
			$list = array();
			foreach ($results as $key=>$value) {

				$sql = $dsql->SetQuery("SELECT `id`, `title`, `price` FROM `#@__tuanlist` WHERE `id` = ".$value['proid']);
				$res = $dsql->dsqlOper($sql, "results");

				if($res){
					$id    = $res[0]['id'];
					$title = $res[0]['title'];
					$price = $res[0]['price'];
					$param = array(
						"service"  => "tuan",
						"template" => "detail",
						"id"       => $id
					);
					$url = getUrlPath($param);

					$list[$key]["pro"]['title'] = $title;
					$list[$key]["pro"]['url']   = $url;
				}else{
					$list[$key]["pro"]['title'] = "";
					$list[$key]["pro"]['url']   = "";
				}

				$list[$key]['id']      = $value['id'];
				$list[$key]['price']   = $value['orderprice'];
				$list[$key]['cardnum'] = $value['cardnum'];
				$list[$key]['usedate'] = $value['usedate'];

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
	 * 验证团购券状态
	 */
	public function verifyQuan(){
		global $dsql;
		global $userLogin;

		$code = $this->param['code'];
		$now  = GetMkTime(time());

		if(!is_numeric($code)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//查询券
		$archives = $dsql->SetQuery("SELECT q.`usedate`, q.`expireddate`, o.`proid`, o.`orderprice` FROM `#@__tuanquan` q LEFT JOIN `#@__tuan_order` o ON o.`id` = q.`orderid` LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE o.`orderstate` = 1 AND q.`cardnum` = '".$code."' AND s.`uid` = ".$uid);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$usedate     = $results[0]['usedate'];
			$expireddate = $results[0]['expireddate'];
			$proid       = $results[0]['proid'];

			//是否已经使用过
			if($usedate != 0){
				$usedate = date("Y-m-d H:i:s", $usedate);
				return array("state" => 101, "info" => '验证失败，此券已于'.$usedate.'使用过了！');

			//是否已经过期
			}elseif($expireddate < $now){
				return array("state" => 101, "info" => '验证失败，此券已经过期！');

			//可以使用
			}else{

				//获取团购信息
				$sql = $dsql->SetQuery("SELECT `id`, `title`, `price` FROM `#@__tuanlist` WHERE `id` = ".$proid);
				$res = $dsql->dsqlOper($sql, "results");
				if($res){

					$id    = $res[0]['id'];
					$title = $res[0]['title'];

					$param = array(
						"service"  => "tuan",
						"template" => "detail",
						"id"       => $id
					);
					$url = getUrlPath($param);
					return "验证成功，项目：<a href='".$url."' target='_blank'>$title</a> [".$results[0]['orderprice']."元]";

				}else{
					return array("state" => 101, "info" => '验证失败，团购信息不存在！');
				}

			}

		}else{
			return array("state" => 101, "info" => '密码错误，请与消费者确认提供的密码是否正确！');
		}


	}


	/**
	 * 消费团购券
	 */
	public function useQuan(){
		global $dsql;
		global $userLogin;

		$codes = $this->param['codes'];
		$now   = GetMkTime(time());
		$uid   = $userLogin->getMemberID();

		if(empty($codes)) return array("state" => 200, "info" => '请输入要消费的团购券密码！');

		$codeArr = explode(",", $codes);
		$success = 0;
		foreach ($codeArr as $key => $value) {

			$this->param['code'] = $value;
			$verify = $this->verifyQuan();
			if(!is_array($verify)){

				$sql = $dsql->SetQuery("UPDATE `#@__tuanquan` SET `usedate` = '$now' WHERE `cardnum` = '$value'");
				$res  = $dsql->dsqlOper($sql, "update");

				if($res == "ok"){
					$success++;

					//查询订单信息
					$sql = $dsql->SetQuery("SELECT q.`orderid`, o.`orderprice`, o.`userid` FROM `#@__tuanquan` q LEFT JOIN `#@__tuan_order` o ON o.`id` = q.`orderid` WHERE q.`cardnum` = '$value'");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){

						$orderid    = $ret[0]['orderid'];
						$orderprice = $ret[0]['orderprice'];
						$userid     = $ret[0]['userid'];

						//将费用转至商家帐户
						$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$orderprice' WHERE `id` = '$uid'");
						$dsql->dsqlOper($archives, "update");

						//保存操作日志
						$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '1', '$orderprice', '团购券消费：$value', '$now')");
						$dsql->dsqlOper($archives, "update");

						//更新订单状态，如果券都用掉了，就更新订单状态为已使用
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__tuanquan` WHERE `orderid` = (SELECT `orderid` FROM `#@__tuanquan` WHERE `cardnum` = '$value') AND `usedate` = 0");
						$ret = $dsql->dsqlOper($sql, "totalCount");
						if($ret == 0){
							$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 3, `ret-state` = 0 WHERE `id` = '$orderid'");
							$dsql->dsqlOper($sql, "update");
						}

						//减去消费会员的冻结金额
						$archives = $dsql->SetQuery("UPDATE `#@__member` SET `freeze` = `freeze` - '$orderprice' WHERE `id` = '$userid'");
						$dsql->dsqlOper($archives, "update");

						//保存操作日志
						$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$orderprice', '团购券消费：$value', '$now')");
						$dsql->dsqlOper($archives, "update");

					}

				}

			}

		}

		if($success > 0){
			return "消费成功！";
		}else{
			return array("state" => 200, "info" => '消费失败，请检查您输入的团购券密码！');
		}

	}


	/**
	 * 撤消团购券
	 */
	public function cancelQuan(){
		global $dsql;
		global $userLogin;

		$ids = $this->param['ids'];

		if(empty($ids)) return array("state" => 200, "info" => '请选择要撤消的团购券密码！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$idArr   = explode(",", $ids);
		$success = 0;
		$now     = GetMkTime(time());

		foreach ($idArr as $key => $value) {

			$archives = $dsql->SetQuery("SELECT q.`cardnum`, o.`orderprice`, o.`userid` FROM `#@__tuanquan` q LEFT JOIN `#@__tuan_order` o ON o.`id` = q.`orderid` LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE q.`id` = '$value' AND s.`uid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){

				$cardnum    = $results[0]['cardnum'];
				$orderprice = $results[0]['orderprice'];
				$userid     = $results[0]['userid'];


				$uinfo = $userLogin->getMemberInfo();
				$umoney = $uinfo['money'];

				//判断商家账户全额是否充足
				if($umoney < $orderprice) return array("state" => 200, "info" => '您的账户余额不足，无法撤消，请先充值！');

				//从商家帐户减去相应金额
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - '$orderprice' WHERE `id` = '$uid'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$orderprice', '撤消团购券：$cardnum', '$now')");
				$dsql->dsqlOper($archives, "update");


				//将团购券状态更改为未使用
				$sql = $dsql->SetQuery("UPDATE `#@__tuanquan` SET `usedate` = 0 WHERE `id` = '$value'");
				$dsql->dsqlOper($sql, "update");

				//更新订单状态
				$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 1 WHERE `id` = ".$results[0]['id']);
				$dsql->dsqlOper($sql, "update");



				//增加消费会员的冻结金额
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `freeze` = `freeze` + '$orderprice' WHERE `id` = '$userid'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '1', '$orderprice', '团购券撤消后冻结：$cardnum', '$now')");
				$dsql->dsqlOper($archives, "update");

			}

		}

		return "操作成功！";
	}


	/**
	 * 商家发货
	 */
	public function delivery(){
		global $dsql;
		global $userLogin;

		$id      = $this->param['id'];
		$company = $this->param['company'];
		$number  = $this->param['number'];

		if(empty($id) || empty($company) || empty($number)) return array("state" => 200, "info" => '数据不完整，请检查！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//验证订单
		$archives = $dsql->SetQuery("SELECT o.`id`, o.`userid`, o.`ordernum`, l.`title` FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE o.`id` = '$id' AND s.`uid` = '$uid' AND o.`orderstate` = 1 AND l.`tuantype` = 2");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$userid = $results[0]['userid'];
			$ordernum = $results[0]['ordernum'];
			$title  = $results[0]['title'];

			$paramBusi = array(
				"service"  => "member",
				"type"     => "user",
				"template" => "orderdetail",
				"action"   => "tuan",
				"id"       => $id
			);

			//获取会员名
			$username = "";
			$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $userid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$username = $ret[0]['username'];
			}
			updateMemberNotice($userid, "会员-订单发货通知", $paramBusi, array("username" => $username, "order" => $ordernum, "exp_company" => $company, "exp_number" => $number));


			//更新订单状态
			$now = GetMkTime(time());
			$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 6, `exp-company` = '$company', `exp-number` = '$number', `exp-date` = '$now' WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");
			return "操作成功！";

		}else{
			return array("state" => 200, "info" => '操作失败，请核实订单状态后再操作！');
		}

	}


	/**
	 * 买家申请退款
	 */
	public function refund(){
		global $dsql;
		global $userLogin;

		$id      = $this->param['id'];
		$type    = $this->param['type'];
		$pics    = $this->param['pics'];
		$content = $this->param['content'];

		if(empty($id)) return array("state" => 200, "info" => '数据不完整，请检查！');
		if(empty($type)) return array("state" => 200, "info" => '请选择退款原因！');
		if(empty($content)) return array("state" => 200, "info" => '请输入退款说明！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$type    = filterSensitiveWords(addslashes($type));
		$content = filterSensitiveWords(addslashes($content));
		$type    = cn_substrR($type, 20);
		$content = cn_substrR($content, 500);

		//验证订单
		$archives = $dsql->SetQuery("SELECT o.`id`, o.`orderprice`, o.`ordernum`, l.`title`, l.`tuantype`, s.`uid` FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE o.`id` = '$id' AND o.`userid` = '$uid' AND (o.`orderstate` = 1 OR o.`orderstate` = 6 OR (o.`orderstate` = 2 AND o.`paydate` != 0)) AND o.`ret-state` = 0");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$title      = $results[0]['title'];      //商品名称
			$tuantype   = $results[0]['tuantype'];   //类型
			$orderprice = $results[0]['orderprice']; //单价
			$ordernum   = $results[0]['ordernum'];   //订单号
			$uid        = $results[0]['uid'];        //卖家会员ID
			$date       = GetMkTime(time());

			//如果是快递类型的则转交给商家自行处理，将订单状态设置为申请退款状态
			if($tuantype == 2){

				$paramBusi = array(
					"service"  => "member",
					"template" => "orderdetail",
					"action"   => "tuan",
					"id"       => $id
				);

				//获取会员名
				$username = "";
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}
				updateMemberNotice($uid, "会员-订单退款通知", $paramBusi, array("username" => $username, "order" => $ordernum, 'amount' => $orderprice, 'info' => $content));

				$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = 6, `ret-state` = 1, `ret-type` = '$type', `ret-note` = '$content', `ret-pics` = '$pics', `ret-date` = '$date' WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "update");

			//团购券的情况，直接将会员申请的退款转至会员帐户
			}elseif($tuantype == 0){

				//查询属于当前订单的团购券
				$totalRefund = 0;
				$sql = $dsql->SetQuery("SELECT * FROM `#@__tuanquan` WHERE `orderid` = ".$id);
				$res = $dsql->dsqlOper($sql, "results");
				if($res){

					foreach ($res as $key => $value) {

						$usedate = $value['usedate'];

						//判断是否已经使用
						if($usedate == 0){
							$totalRefund++;
						}

					}

				}

				//更新订单状态为退款成功
				$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `ret-state` = 0, `orderstate` = 7, `ret-ok-date` = '$date', `ret-type` = '$type', `ret-note` = '$content', `ret-pics` = '$pics', `ret-date` = '$date' WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "update");

				//判断是否有需要退款的团购券
				if($totalRefund > 0){

					$totalMoney = $totalRefund * $orderprice;

					$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$totalMoney' WHERE `id` = '$uid'");
					$dsql->dsqlOper($archives, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '1', '$totalMoney', '团购订单退回：$ordernum', '$date')");
					$dsql->dsqlOper($archives, "update");

				}

			}

			return "操作成功！";

		}else{
			return array("state" => 200, "info" => '操作失败，请核实订单状态后再操作！');
		}
	}


	/**
	 * 商家退款
	 */
	public function refundPay(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(empty($id)) return array("state" => 200, "info" => '数据不完整，请检查！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//验证订单
		$archives = $dsql->SetQuery("SELECT o.`id`, o.`ordernum`, o.`point`, o.`balance`, o.`payprice`, o.`propolic`, o.`orderprice`, o.`procount`, o.`userid`, l.`title` FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE o.`id` = '$id' AND s.`uid` = '$uid' AND o.`orderstate` = 6 AND o.`ret-state` = 1 AND l.`tuantype` = 2");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			//验证商家账户余额是否足以支付退款
			$uinfo = $userLogin->getMemberInfo();
			$umoney = $uinfo['money'];

			$date     = GetMkTime(time());
			$title      = $results[0]['title'];      //商品名称
			$ordernum   = $results[0]['ordernum'];   //需要退回的订单号
			$orderprice = $results[0]['orderprice']; //订单商品单价
			$procount   = $results[0]['procount'];   //订单商品数量
			$totalMoney = $orderprice * $procount;   //需要扣除商家的费用


			//因为买家没有确认收货，所以费用是还没有转到卖家账户，这里就不涉及从卖家账户扣费的流程 by:gz 20160422

			//判断商家账户全额是否充足
			//if($umoney < $totalMoney) return array("state" => 200, "info" => '您的账户余额不足，无法退款，请先充值！');

			//从商家帐户减去相应金额
			//$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - '$totalMoney' WHERE `id` = '$uid'");
			//$dsql->dsqlOper($archives, "update");

			//保存操作日志
			//$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$totalMoney', '订单退款：$ordernum', '$date')");
			//$dsql->dsqlOper($archives, "update");




			//更新订单状态
			$now = GetMkTime(time());
			$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `ret-state` = 0, `orderstate` = 7, `ret-ok-date` = '$now' WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");


			//退回会员积分、余额
			$userid   = $results[0]['userid'];   //需要退回的会员ID
			$point    = $results[0]['point'];    //需要退回的积分
			$balance  = $results[0]['balance'];  //需要退回的余额
			$payprice = $results[0]['payprice']; //需要退回的支付金额
			$propolic = $results[0]['propolic']; //运费

			//计算运费 by: guozi 20160425
			$propolicMoney = 0;
			$policy = unserialize($propolic);
			if(!empty($propolic) && !empty($policy)){
				$freight  = $policy['freight'];
				$freeshi  = $policy['freeshi'];

				if($procount <= $freeshi){
					$propolicMoney = $freight;
				}
			}

			//退回积分
			if(!empty($point)){
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `point` = `point` + '$point' WHERE `id` = '$userid'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_point` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '1', '$point', '团购订单退回：$ordernum', '$date')");
				$dsql->dsqlOper($archives, "update");
			}

			//退回余额
			$money = $balance + $payprice + $propolicMoney;
			if($money > 0){
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$money' WHERE `id` = '$userid'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '1', '$money', '团购订单退回：$ordernum', '$date')");
				$dsql->dsqlOper($archives, "update");


				//减去会员的冻结金额
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `freeze` = `freeze` - '$money' WHERE `id` = '$userid'");
				$dsql->dsqlOper($archives, "update");
			}


			$paramBusi = array(
				"service"  => "member",
				"type"     => "user",
				"template" => "orderdetail",
				"action"   => "tuan",
				"id"       => $id
			);

			//获取会员名
			$username = "";
			$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $userid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$username = $ret[0]['username'];
			}
			updateMemberNotice($userid, "会员-订单退款成功", $paramBusi, array("username" => $username, "order" => $ordernum, 'amount' => $money));


			return "退款成功！";

		}else{
			return array("state" => 200, "info" => '操作失败，请核实订单状态后再操作！');
		}

	}


	/**
	 * 商家退款回复
	 */
	public function refundReply(){
		global $dsql;
		global $userLogin;

		$id      = $this->param['id'];
		$pics    = $this->param['pics'];
		$content = $this->param['content'];

		if(empty($id)) return array("state" => 200, "info" => '数据不完整，请检查！');
		if(empty($content)) return array("state" => 200, "info" => '请输入回复内容！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$content = filterSensitiveWords(addslashes($content));
		$content = cn_substrR($content, 500);

		//验证订单
		$archives = $dsql->SetQuery("SELECT o.`id`, o.`userid`, o.`ordernum`, o.`balance`, o.`payprice`, l.`title` FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE o.`id` = '$id' AND s.`uid` = '$uid' AND o.`orderstate` = 6 AND o.`ret-state` = 1 AND l.`tuantype` = 2");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$title  = $results[0]['title'];
			$userid = $results[0]['userid'];
			$ordernum = $results[0]['ordernum'];
			$orderprice = $results[0]['balance'] + $results[0]['payprice'];
			$paramBusi = array(
				"service"  => "member",
				"type"     => "user",
				"template" => "orderdetail",
				"action"   => "tuan",
				"id"       => $id
			);

			//获取会员名
			$username = "";
			$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $userid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$username = $ret[0]['username'];
			}
			updateMemberNotice($userid, "会员-退款申请卖家回复", $param, array("username" => $username, "order" => $ordernum, 'amount' => $orderprice, 'info' => $content));


			//更新订单状态
			$now = GetMkTime(time());
			$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `ret-s-note` = '$content', `ret-s-pics` = '$pics', `ret-s-date` = '$now' WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");

			return "回复成功！";

		}else{
			return array("state" => 200, "info" => '回复失败，请核实订单状态后再操作！');
		}
	}


	/**
	 * 买家确认收货
	 */
	public function receipt(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(empty($id)) return array("state" => 200, "info" => '操作失败，参数传递错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//验证订单
		$archives = $dsql->SetQuery("SELECT o.`ordernum`, o.`procount`, o.`orderprice`, o.`payprice`, o.`userid`, l.`title`, s.`uid` FROM `#@__tuan_order` o LEFT JOIN `#@__tuanlist` l ON o.`proid` = l.`id` LEFT JOIN `#@__tuan_store` s ON l.`sid` = s.`id` WHERE o.`id` = '$id' AND o.`userid` = '$uid' AND o.`orderstate` = 6 AND l.`tuantype` = 2");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			//更新订单状态
			$now = GetMkTime(time());
			$sql = $dsql->SetQuery("UPDATE `#@__tuan_order` SET `orderstate` = '3' WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");

			//将订单费用转到卖家帐户
			$date       = GetMkTime(time());
			$ordernum   = $results[0]['ordernum'];   //订单号
			$procount   = $results[0]['procount'];   //数量
			$orderprice = $results[0]['orderprice']; //单价
			$payprice   = $results[0]['payprice'];   //支付金额
			$userid     = $results[0]['userid'];     //买家ID
			$uid        = $results[0]['uid'];        //卖家ID
			$title      = $results[0]['title'];      //商品名称

			if($payprice > 0){
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$payprice' WHERE `id` = '$uid'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '1', '$payprice', '团购收入，订单号：$ordernum', '$date')");
				$dsql->dsqlOper($archives, "update");


				//减去消费会员的冻结金额
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `freeze` = `freeze` - '$payprice' WHERE `id` = '$userid'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '0', '$payprice', '团购消费：$ordernum', '$date')");
				$dsql->dsqlOper($archives, "update");

			}


			//商家会员消息通知
			$paramBusi = array(
				"service"  => "member",
				"template" => "orderdetail",
				"action"   => "tuan",
				"id"       => $id
			);

			//获取会员名
			$username = "";
			$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$username = $ret[0]['username'];
			}
			updateMemberNotice($uid, "会员-商品成交通知", $paramBusi, array("username" => $username, "title" => $title, 'amount' => $payprice));

			return "操作成功！";

		}else{
			return array("state" => 200, "info" => '操作失败，请核实订单状态后再操作！');
		}
	}



}
