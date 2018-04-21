<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 商家模块API接口
 *
 * @version        $Id: business.class.php 2017-3-23 上午12:01:21 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class business {
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
     * 新闻基本参数
     * @return array
     */
	public function config(){

		require(HUONIAOINC."/config/business.inc.php");

		global $cfg_fileUrl;              //系统附件默认地址
		global $cfg_uploadDir;            //系统附件默认上传目录
		// global $customFtp;                //是否自定义FTP
		// global $custom_ftpState;          //FTP是否开启
		// global $custom_ftpUrl;            //远程附件地址
		// global $custom_ftpDir;            //FTP上传目录
		// global $custom_uploadDir;         //默认上传目录
		global $cfg_basehost;             //系统主域名

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
		// global $submission;               //投稿邮箱
		// global $customAtlasMax;           //图集数量限制
		// global $customTemplate;           //模板风格
		//
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

		$params = !empty($this->param) && !is_array($this->param) ? explode(',',$this->param) : "";

		// $domainInfo = getDomain('article', 'config');
		// $customChannelDomain = $domainInfo['domain'];
		// if($customSubDomain == 0){
		// 	$customChannelDomain = "http://".$customChannelDomain;
		// }elseif($customSubDomain == 1){
		// 	$customChannelDomain = "http://".$customChannelDomain.".".$cfg_basehost;
		// }elseif($customSubDomain == 2){
		// 	$customChannelDomain = "http://".$cfg_basehost."/".$customChannelDomain;
		// }

		include HUONIAOINC.'/siteModuleDomain.inc.php';
		$customChannelDomain = $businessDomain;

		$return = array();
		if(!empty($params) > 0){

			foreach($params as $key => $param){
				if($param == "channelName"){
					$return['channelName'] = $customChannelName;
				}elseif($param == "logoUrl"){

					//自定义LOGO
					if($customLogo == 1){
						$customLogoPath = getFilePath($customLogoUrl);
					}else{
						$customLogoPath = getFilePath($cfg_weblogo);
					}

					$return['logoUrl'] = $customLogoPath;
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
				}elseif($param == "submission"){
					$return['submission'] = $submission;
				}elseif($param == "atlasMax"){
					$return['atlasMax'] = $customAtlasMax;
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
				}elseif($param == "listRule"){
					$return['listRule'] = $custom_listRule;
				}elseif($param == "detailRule"){
					$return['detailRule'] = $custom_detailRule;
				}
			}

		}else{

			//自定义LOGO
			if($customLogo == 1){
				$customLogoPath = getFilePath($customLogoUrl);
			}else{
				$customLogoPath = getFilePath($cfg_weblogo);
			}

			$return['channelName']   = $customChannelName;
			$return['logoUrl']       = $customLogoPath;
			$return['subDomain']     = $customSubDomain;
			$return['channelDomain'] = $customChannelDomain;
			$return['channelSwitch'] = $customChannelSwitch;
			$return['closeCause']    = $customCloseCause;
			$return['title']         = $customSeoTitle;
			$return['keywords']      = $customSeoKeyword;
			$return['description']   = $customSeoDescription;
			$return['submission']    = $submission;
			$return['atlasMax']      = $customAtlasMax;
			$return['template']      = $customTemplate;
			$return['touchTemplate'] = $customTouchTemplate;
			$return['softSize']      = $custom_softSize;
			$return['softType']      = $custom_softType;
			$return['thumbSize']     = $custom_thumbSize;
			$return['thumbType']     = $custom_thumbType;
			$return['atlasSize']     = $custom_atlasSize;
			$return['atlasType']     = $custom_atlasType;
			$return['listRule']      = $custom_listRule;
			$return['detailRule']    = $custom_detailRule;
		}

		return $return;

	}


	/**
     * 商家分类
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
		$results = $dsql->getTypeList($type, "business_type", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 商家区域
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
		$results = $dsql->getTypeList($type, "business_addr", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 商家列表
     * @return array
     */
	public function blist(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$addrid = $typeid = $title = $orderby = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$addrid   = $this->param['addrid'];
				$typeid   = $this->param['typeid'];
				$title    = $this->param['title'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		//遍历区域
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "business_addr")){
				global $arr_data;
				$arr_data = array();
				$lower = arr_foreach($dsql->getTypeList($addrid, "business_addr"));
				$lower = $addrid.",".join(',',$lower);
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addrid` in ($lower)";
		}

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "business_type")){
				global $arr_data;
				$arr_data = array();
				$lower = arr_foreach($dsql->getTypeList($typeid, "business_type"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		//模糊查询关键字
		if(!empty($title)){
			$title = explode(" ", $title);
			$w = array();
			foreach ($title as $k => $v) {
				if(!empty($v)){
					$w[] = "`title` like '%".$v."%'";
				}
			}
			$where .= " AND (".join(" OR ", $w).")";
		}

		$order = " ORDER BY l.`id` DESC";


		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//人气
		if($orderby == "1"){
			$order = " ORDER BY popularity DESC";

		//好评
		}elseif($orderby == "2"){
			$order = " ORDER BY praise DESC";
		}

		$archives = $dsql->SetQuery("SELECT l.`id`, l.`uid`, l.`title`, l.`logo`, l.`typeid`, l.`addrid`, l.`address`, l.`lng`, l.`lat`, l.`wechatname`, l.`wechatcode`, l.`wechatqr`, l.`tel`, l.`qq`, l.`pics`, l.`license`, l.`opentime`, l.`amount`, l.`parking`, l.`authattr`, l.`pubdate`, (SELECT COUNT(`id`)  FROM `#@__business_comment` WHERE `bid` = l.`id` AND `ischeck` = 1) AS popularity, (SELECT COUNT(`id`)  FROM `#@__business_comment` WHERE `bid` = l.`id` AND `ischeck` = 1 AND `rating` > 3) AS praise FROM `#@__business_list` l WHERE l.`state` = 1".$where);
		$archives_count = $dsql->SetQuery("SELECT count(`id`) FROM `#@__business_list` l WHERE l.`state` = 1".$where);

		//总条数
		$totalResults = $dsql->dsqlOper($archives_count, "results", "NUM");
		$totalCount = (int)$totalResults[0][0];

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
		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']    = $val['id'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['logo']  = !empty($val['logo']) ? getFilePath($val['logo']) : "";

				global $data;
				$data = "";
				$typeArr = getParentArr("business_type", $val['typeid']);
				$typeArr = array_reverse(parent_foreach($typeArr, "typename"));
				$list[$key]['typeid']      = $val['typeid'];
				$list[$key]['typename']    = $typeArr;

				global $data;
				$data = "";
				$addrArr = getParentArr("business_addr", $val['addrid']);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$list[$key]['addrid']      = $val['typeid'];
				$list[$key]['addrname']    = $addrArr;

				$list[$key]['address']     = $val['address'];
				$list[$key]['lng']         = $val['lng'];
				$list[$key]['lat']         = $val['lat'];
				$list[$key]['wechatname']  = $val['wechatname'];
				$list[$key]['wechatcode']  = $val['wechatcode'];
				$list[$key]['wechatqr']    = !empty($val['wechatqr']) ? getFilePath($val['wechatqr']) : "";
				$list[$key]['tel']         = $val['tel'];
				$list[$key]['qq']          = $val['qq'];

				$picArr = array();
				$pics = $val['pics'];
				if($pics){
					$pics = explode(",", $pics);
					foreach ($pics as $k => $v) {
						array_push($picArr, getFilePath($v));
					}
				}
				$list[$key]['pics']    = $picArr;
				$list[$key]['license'] = !empty($val['license']) ? getFilePath($val['license']) : "";
				$list[$key]['opentime'] = $val['opentime'];
				$list[$key]['amount']   = $val['amount'];
				$list[$key]['parking']  = $val['parking'];
				$list[$key]['pubdate']  = $val['pubdate'];
				$list[$key]['comment']  = $val['popularity'];

				//认证
				$auth = array();
				if($val['authattr']){
					$authattr = explode(",", $val['authattr']);
					foreach ($authattr as $k => $v) {
						$sql = $dsql->SetQuery("SELECT `jc`, `typename` FROM `#@__business_authattr` WHERE `id` = $v");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							array_push($auth, array("jc" => $ret[0]['jc'], "typename" => $ret[0]['typename']));
						}
					}
				}
				$list[$key]["auth"] = $auth;

				//会员信息
				$uinfo = $userLogin->getMemberInfo($val['uid']);
				$list[$key]['member'] = array(
					"userid"       => $uinfo['userid'],
					"company"      => $uinfo['company'],
					"photo"        => $uinfo['photo'],
					"online"       => $uinfo['online'],
					"emailCheck"   => $uinfo['emailCheck'],
					"phoneCheck"   => $uinfo['phoneCheck'],
					"licenseState" => $uinfo['licenseState'],
					"certifyState" => $uinfo['certifyState'],
				);

				//综合评分
				$sql = $dsql->SetQuery("SELECT avg(`rating`) r FROM `#@__business_comment` WHERE `ischeck` = 1 AND `bid` = ".$val['id']);
				$res = $dsql->dsqlOper($sql, "results");
				$rating = $res[0]['r'];		//总评分
				$list[$key]['rating']  = number_format($rating, 1);

				$param = array(
					"service"     => "business",
					"template"    => "detail",
					"id"          => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
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
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `uid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){
				$id = $results[0]['id'];
				$where = "";
			}else{
				return array("state" => 200, "info" => '该会员暂未开通商铺！');
			}
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_list` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$storeDetail["id"]         = $results[0]['id'];
			$storeDetail["title"]      = $results[0]['title'];

			$storeDetail["logoSource"] = $results[0]["logo"];
			$storeDetail["logo"] = getFilePath($results[0]["logo"]);

			$uid = $results[0]['uid'];
			$storeDetail['member']     = getMemberDetail($uid);

			$storeDetail["typeid"]     = $results[0]['typeid'];
			global $data;
			$data = "";
			$bustype = getParentArr("business_type", $results[0]['typeid']);
			if($bustype){
				$bustype = array_reverse(parent_foreach($bustype, "typename"));
				$storeDetail['typename'] = join(" > ", $bustype);
			}else{
				$storeDetail['typename'] = "";
			}

			$storeDetail["addrid"]     = $results[0]['addrid'];
			$addrName = getParentArr("business_addr", $results[0]['addrid']);
			global $data;
			$data = "";
			$addrArr = array_reverse(parent_foreach($addrName, "typename"));
			$addrArr = count($addrArr) > 2 ? array_splice($addrArr, 1) : $addrArr;
			$storeDetail['addrname']  = $addrArr;

			$storeDetail["address"]    = $results[0]['address'];
			$storeDetail["lnglat"]     = $results[0]['lng'].",".$results[0]['lat'];
			$storeDetail["wechatname"] = $results[0]['wechatname'];
			$storeDetail["wechatcode"] = $results[0]['wechatcode'];

			$storeDetail["wechatqrSource"] = $results[0]['wechatqr'];
			$storeDetail["wechatqr"] = getFilePath($results[0]["wechatqr"]);

			$storeDetail["tel"]        = $results[0]['tel'];
			$storeDetail["qq"]         = $results[0]['qq'];

			$bannerArr = array();
			$banner = $results[0]['banner'];
			if(!empty($banner)){
				$banner = explode(",", $banner);
				foreach ($banner as $key => $value) {
					array_push($bannerArr, array("pic" => getFilePath($value), "picSource" => $value));
				}
			}
			$storeDetail['banner'] = $bannerArr;

			$picsArr = array();
			$pics = $results[0]['pics'];
			if(!empty($pics)){
				$pics = explode(",", $pics);
				foreach ($pics as $key => $value) {
					array_push($picsArr, array("pic" => getFilePath($value), "picSource" => $value));
				}
			}
			$storeDetail['pics'] = $picsArr;

			$storeDetail["licenseSource"] = $results[0]["license"];
			$storeDetail["license"] = getFilePath($results[0]["license"]);

			$picsArr = array();
			$pics = $results[0]['certify'];
			if(!empty($pics)){
				$pics = explode(",", $pics);
				foreach ($pics as $key => $value) {
					array_push($picsArr, array("pic" => getFilePath($value), "picSource" => $value));
				}
			}
			$storeDetail['certify'] = $picsArr;

			$storeDetail["opentime"] = $results[0]['opentime'];
			$storeDetail["amount"]  = $results[0]['amount'];
			$storeDetail["parking"]  = $results[0]['parking'];
			$storeDetail["state"] = $results[0]['state'];
			$storeDetail["pubdate"] = $results[0]['pubdate'];

			//认证
			$auth = array();
			if($results[0]['authattr']){
				$authattr = explode(",", $results[0]['authattr']);
				foreach ($authattr as $k => $v) {
					$sql = $dsql->SetQuery("SELECT `jc`, `typename` FROM `#@__business_authattr` WHERE `id` = $v");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						array_push($auth, array("jc" => $ret[0]['jc'], "typename" => $ret[0]['typename']));
					}
				}
			}
			$storeDetail["auth"] = $auth;

			//点评
			$sql = $dsql->SetQuery("SELECT avg(`rating`) r, count(`id`) c FROM `#@__business_comment` WHERE `ischeck` = 1 AND `bid` = ".$id);
			$res = $dsql->dsqlOper($sql, "results");
			$comment = $res[0]['c'];	//点评数量
			$rating = $res[0]['r'];		//总评分
			$storeDetail['comment'] = $comment;
			$storeDetail['rating']  = number_format($rating, 1);

			//介绍，取排在第一位的信息
			$intro = "";
			$sql = $dsql->SetQuery("SELECT `body` FROM `#@__business_about` WHERE `uid` = ".$results[0]['uid']." ORDER BY `weight` DESC LIMIT 0, 1");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$intro = strip_tags($ret[0]['body']);
			}
			$storeDetail['intro'] = $intro;

			//查询商家已开通的店铺
			$storeArr = $storeInfo = array();
			$sql = $dsql->SetQuery("SELECT `name` FROM `#@__site_module` WHERE `state` = 0 ORDER BY `weight`, `id`");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				foreach ($ret as $k => $v) {

					$name = $v['name'];

					//团购
					if($name == "tuan"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__tuan_store` WHERE `uid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["tuan"] = $ret[0]['id'];
							// array_push($storeArr, array("tuan" => $ret[0]['id']));
						}

					//房产中介
					}elseif($name == "house"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["house"] = $ret[0]['id'];
							// array_push($storeArr, array("house" => $ret[0]['id']));
						}

					//商城
					}elseif($name == "shop"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__shop_store` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["shop"] = $ret[0]['id'];
							// array_push($storeArr, array("shop" => $ret[0]['id']));
						}

					//建材
					}elseif($name == "build"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__build_store` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["build"] = $ret[0]['id'];
							// array_push($storeArr, array("build" => $ret[0]['id']));
						}

					//家具
					}elseif($name == "furniture"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__furniture_store` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["furniture"] = $ret[0]['id'];
							// array_push($storeArr, array("furniture" => $ret[0]['id']));
						}

					//家居
					}elseif($name == "home"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__home_store` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["home"] = $ret[0]['id'];
							// array_push($storeArr, array("home" => $ret[0]['id']));
						}

					//装修
					}elseif($name == "renovation"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__renovation_store` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["renovation"] = $ret[0]['id'];
							// array_push($storeArr, array("renovation" => $ret[0]['id']));
						}

					//招聘
					}elseif($name == "job"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["job"] = $ret[0]['id'];
							// array_push($storeArr, array("job" => $ret[0]['id']));
						}

					//外卖
					}elseif($name == "waimai"){
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = $uid AND `state` = 1");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$storeArr["waimai"] = $ret[0]['id'];
							// array_push($storeArr, array("waimai" => $ret[0]['id']));
						}

					}

					$storeDetail['store'] = $storeArr;


				}
			}

		}
		return $storeDetail;
	}


	/**
     * 商家介绍列表
     * @return array
     */
	public function introList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$uid = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$uid      = $this->param['uid'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(!$uid){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT a.`id`, a.`title`, a.`body`, a.`click`, a.`pubdate`, b.`id` bid FROM `#@__business_about` a LEFT JOIN `#@__business_list` b ON b.`uid` = a.`uid` WHERE a.`uid` = $uid ORDER BY a.`weight` DESC, a.`id` ASC");
		$results = $dsql->dsqlOper($archives, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']      = $val['id'];
				$list[$key]['title']   = $val['title'];
				$list[$key]['body']    = $val['body'];
				$list[$key]['click']   = $val['click'];
				$list[$key]['pubdate'] = $val['pubdate'];

				$param = array(
					"service"  => "business",
					"template" => "intro",
					"bid"      => $val['bid'],
					"id"       => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);
			}
		}

		return $list;
	}


	/**
     * 商家介绍详细
     * @return array
     */
	public function introDetail(){
		global $dsql;
		global $userLogin;
		$introDetail = array();
		$id = $this->param;

		if(!is_numeric($id)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT a.*, b.`id` bid FROM `#@__business_about` a LEFT JOIN `#@__business_list` b ON b.`uid` = a.`uid` WHERE a.`id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$introDetail["id"]      = $results[0]['id'];
			$introDetail["title"]   = $results[0]['title'];
			$introDetail["body"]    = $results[0]['body'];
			$introDetail["click"]   = $results[0]['click'];
			$introDetail["pubdate"] = $results[0]['pubdate'];
			$introDetail["bid"]     = $results[0]['bid'];
		}
		return $introDetail;
	}


	/**
     * 商家动态分类
     * @return array
     */
	public function news_type(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$uid = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$uid = $this->param['uid'];
			}
		}

		if(!$uid){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT t.`id`, t.`typename`, b.`id` bid FROM `#@__business_news_type` t LEFT JOIN `#@__business_list` b ON b.`uid` = t.`uid` WHERE t.`uid` = $uid ORDER BY t.`weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']      = $val['id'];
				$list[$key]['typename']   = $val['typename'];
				$param = array(
					"service"  => "business",
					"template" => "news",
					"bid"      => $val['bid'],
					"id"       => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);
			}
		}

		return $list;
	}


	/**
     * 商家动态
     * @return array
     */
	 public function news_list(){
 		global $dsql;
 		global $userLogin;
 		$pageinfo = $list = array();
 		$uid = $typeid = $page = $pageSize = $where = $where1 = "";

 		if(!empty($this->param)){
 			if(!is_array($this->param)){
 				return array("state" => 200, "info" => '格式错误！');
 			}else{
 				$uid      = $this->param['uid'];
 				$typeid   = $this->param['typeid'];
 				$page     = $this->param['page'];
 				$pageSize = $this->param['pageSize'];
 			}
 		}

		//会员ID
		if(empty($uid)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$where .= " AND n.`uid` = $uid";

		//分类
		if(!empty($typeid)){
			$where .= " AND n.`typeid` = $typeid";
		}

 		$pageSize = empty($pageSize) ? 10 : $pageSize;
 		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT n.`id`, n.`typeid`, n.`title`, n.`click`, n.`pubdate`, l.`id` bid FROM `#@__business_news` n LEFT JOIN `#@__business_list` l ON l.`uid` = n.`uid` WHERE 1 = 1".$where);

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
 		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

 		if($results){
 			foreach($results as $key => $val){
 				$list[$key]['id']    = $val['id'];
 				$list[$key]['title'] = $val['title'];

 				$list[$key]['typeid']   = $val['typeid'];
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_news_type` WHERE `id` = ".$val['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
	 				$list[$key]['typename'] = $ret[0]['typename'];
				}else{
					$list[$key]['typename'] = "";
				}

				$param = array(
 					"service"  => "business",
 					"template" => "news",
					"bid"      => $val['bid'],
 					"id"       => $val['id']
 				);
 				$list[$key]['typeurl'] = getUrlPath($param);

 				$list[$key]['click']   = $val['click'];
 				$list[$key]['pubdate'] = $val['pubdate'];
 				$list[$key]['bid']     = $val['bid'];

 				$param = array(
 					"service"     => "business",
 					"template"    => "newsd",
 					"id"          => $val['id']
 				);
 				$list[$key]['url'] = getUrlPath($param);
 			}
 		}

 		return array("pageInfo" => $pageinfo, "list" => $list);
 	}


	/**
     * 商家动态详细
     * @return array
     */
	public function news_detail(){
		global $dsql;
		global $userLogin;
		$newsDetail = array();
		$id = $this->param;

		if(!is_numeric($id)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT n.*, b.`id` bid FROM `#@__business_news` n LEFT JOIN `#@__business_list` b ON b.`uid` = n.`uid` WHERE n.`id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$newsDetail["id"]      = $results[0]['id'];
			$newsDetail["typeid"]  = $results[0]['typeid'];
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_news_type` WHERE `id` = ".$results[0]['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$newsDetail['typename'] = $ret[0]['typename'];
			}else{
				$newsDetail['typename'] = "";
			}
			$newsDetail["title"]   = $results[0]['title'];
			$newsDetail["body"]    = $results[0]['body'];
			$newsDetail["click"]   = $results[0]['click'];
			$newsDetail["pubdate"] = $results[0]['pubdate'];
			$newsDetail["bid"]     = $results[0]['bid'];
		}
		return $newsDetail;
	}


	/**
     * 商家相册分类
     * @return array
     */
	public function albums_type(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$uid = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$uid = $this->param['uid'];
			}
		}

		if(!$uid){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT t.`id`, t.`typename`, b.`id` bid FROM `#@__business_albums_type` t LEFT JOIN `#@__business_list` b ON b.`uid` = t.`uid` WHERE t.`uid` = $uid ORDER BY t.`weight` ASC");
		$results = $dsql->dsqlOper($archives, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']      = $val['id'];
				$list[$key]['typename']   = $val['typename'];
				$param = array(
					"service"  => "business",
					"template" => "albums",
					"bid"      => $val['bid'],
					"id"       => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);

				//查询相册的第一张图片
				$litpic = "";
				$sql = $dsql->SetQuery("SELECT `litpic` FROM `#@__business_albums` WHERE `uid` = $uid AND `typeid` = ".$val['id']." ORDER BY `id` ASC");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$litpic = getFilePath($ret[0]['litpic']);
				}

				$list[$key]['litpic'] = $litpic;
			}
		}

		return $list;
	}


	/**
     * 商家相册
     * @return array
     */
	 public function albums_list(){
 		global $dsql;
 		global $userLogin;
 		$pageinfo = $list = array();
 		$uid = $typeid = $page = $pageSize = $where = $where1 = "";

 		if(!empty($this->param)){
 			if(!is_array($this->param)){
 				return array("state" => 200, "info" => '格式错误！');
 			}else{
 				$uid      = $this->param['uid'];
 				$typeid   = $this->param['typeid'];
 				$page     = $this->param['page'];
 				$pageSize = $this->param['pageSize'];
 			}
 		}

		//会员ID
		if(empty($uid)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$where .= " AND a.`uid` = $uid";

		//分类
		if(!empty($typeid)){
			$where .= " AND a.`typeid` = $typeid";
		}

 		$pageSize = empty($pageSize) ? 10 : $pageSize;
 		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT a.`id`, a.`typeid`, a.`litpic`, a.`pubdate`, l.`id` bid FROM `#@__business_albums` a LEFT JOIN `#@__business_list` l ON l.`uid` = a.`uid` WHERE 1 = 1".$where);

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
 		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

 		if($results){
 			foreach($results as $key => $val){
 				$list[$key]['id']    = $val['id'];

 				$list[$key]['typeid']   = $val['typeid'];
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_news_type` WHERE `id` = ".$val['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
	 				$list[$key]['typename'] = $ret[0]['typename'];
				}else{
					$list[$key]['typename'] = "";
				}

				$param = array(
 					"service"  => "business",
 					"template" => "albums",
					"bid"      => $val['bid'],
 					"id"       => $val['id']
 				);
 				$list[$key]['typeurl'] = getUrlPath($param);

 				$list[$key]['litpic']  = !empty($val['litpic']) ? getFilePath($val['litpic']) : "";
 				$list[$key]['pubdate'] = $val['pubdate'];
 				$list[$key]['bid']     = $val['bid'];

 				$param = array(
 					"service"     => "business",
 					"template"    => "albumsd",
 					"id"          => $val['id']
 				);
 				$list[$key]['url'] = getUrlPath($param);
 			}
 		}

 		return array("pageInfo" => $pageinfo, "list" => $list);
 	}


	/**
     * 商家相册详细
     * @return array
     */
	public function albums_detail(){
		global $dsql;
		global $userLogin;
		$newsDetail = array();
		$id = $this->param;

		if(!is_numeric($id)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT a.*, b.`id` bid FROM `#@__business_albums` a LEFT JOIN `#@__business_list` b ON b.`uid` = a.`uid` WHERE a.`id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$newsDetail["id"]      = $results[0]['id'];
			$newsDetail["typeid"]  = $results[0]['typeid'];
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_albums_type` WHERE `id` = ".$results[0]['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$newsDetail['typename'] = $ret[0]['typename'];
			}else{
				$newsDetail['typename'] = "";
			}
			$newsDetail["litpic"]  = !empty($results[0]['litpic']) ? getFilePath($results[0]['litpic']) : "";
			$newsDetail["pubdate"] = $results[0]['pubdate'];
			$newsDetail["bid"]     = $results[0]['bid'];
		}
		return $newsDetail;
	}


	/**
     * 商家视频
     * @return array
     */
	 public function video_list(){
 		global $dsql;
 		global $userLogin;
 		$pageinfo = $list = array();
 		$uid = $page = $pageSize = $where = $where1 = "";

 		if(!empty($this->param)){
 			if(!is_array($this->param)){
 				return array("state" => 200, "info" => '格式错误！');
 			}else{
 				$uid      = $this->param['uid'];
 				$page     = $this->param['page'];
 				$pageSize = $this->param['pageSize'];
 			}
 		}

		//会员ID
		if(empty($uid)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$where .= " AND v.`uid` = $uid";

 		$pageSize = empty($pageSize) ? 10 : $pageSize;
 		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT v.`id`, v.`title`, v.`litpic`, v.`pubdate`, l.`id` bid FROM `#@__business_video` v LEFT JOIN `#@__business_list` l ON l.`uid` = v.`uid` WHERE 1 = 1".$where);

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
 		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

 		if($results){
 			foreach($results as $key => $val){
 				$list[$key]['id']      = $val['id'];
				$list[$key]['title']   = $val['title'];
 				$list[$key]['litpic']  = !empty($val['litpic']) ? getFilePath($val['litpic']) : "";
 				$list[$key]['pubdate'] = $val['pubdate'];
 				$list[$key]['bid']     = $val['bid'];

 				$param = array(
 					"service"     => "business",
 					"template"    => "videod",
 					"id"          => $val['id']
 				);
 				$list[$key]['url'] = getUrlPath($param);
 			}
 		}

 		return array("pageInfo" => $pageinfo, "list" => $list);
 	}


	/**
     * 商家视频详细
     * @return array
     */
	public function video_detail(){
		global $dsql;
		global $userLogin;
		$videoDetail = array();
		$id = $this->param;

		if(!is_numeric($id)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT v.*, b.`id` bid FROM `#@__business_video` v LEFT JOIN `#@__business_list` b ON b.`uid` = v.`uid` WHERE v.`id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$videoDetail["id"]      = $results[0]['id'];
			$videoDetail["title"]   = $results[0]['title'];
			$videoDetail["litpic"]  = !empty($results[0]['litpic']) ? $results[0]['litpic'] : "";
			$videoDetail["video"]   = $results[0]['video'];
			$videoDetail["pubdate"] = $results[0]['pubdate'];
			$videoDetail["bid"]     = $results[0]['bid'];
		}
		return $videoDetail;
	}


	/**
     * 商家全景
     * @return array
     */
	 public function panor_list(){
 		global $dsql;
 		global $userLogin;
 		$pageinfo = $list = array();
 		$uid = $page = $pageSize = $where = $where1 = "";

 		if(!empty($this->param)){
 			if(!is_array($this->param)){
 				return array("state" => 200, "info" => '格式错误！');
 			}else{
 				$uid      = $this->param['uid'];
 				$page     = $this->param['page'];
 				$pageSize = $this->param['pageSize'];
 			}
 		}

		//会员ID
		if(empty($uid)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$where .= " AND v.`uid` = $uid";

 		$pageSize = empty($pageSize) ? 10 : $pageSize;
 		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT v.`id`, v.`title`, v.`litpic`, v.`pubdate`, l.`id` bid FROM `#@__business_panor` v LEFT JOIN `#@__business_list` l ON l.`uid` = v.`uid` WHERE 1 = 1".$where);

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
 		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

 		if($results){
 			foreach($results as $key => $val){
 				$list[$key]['id']      = $val['id'];
				$list[$key]['title']   = $val['title'];
 				$list[$key]['litpic']  = !empty($val['litpic']) ? getFilePath($val['litpic']) : "";
 				$list[$key]['pubdate'] = $val['pubdate'];
 				$list[$key]['bid']     = $val['bid'];

 				$param = array(
 					"service"     => "business",
 					"template"    => "panord",
 					"id"          => $val['id']
 				);
 				$list[$key]['url'] = getUrlPath($param);
 			}
 		}

 		return array("pageInfo" => $pageinfo, "list" => $list);
 	}


	/**
     * 商家全景详细
     * @return array
     */
	public function panor_detail(){
		global $dsql;
		global $userLogin;
		$panorDetail = array();
		$id = $this->param;

		if(!is_numeric($id)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$archives = $dsql->SetQuery("SELECT v.*, b.`id` bid FROM `#@__business_panor` v LEFT JOIN `#@__business_list` b ON b.`uid` = v.`uid` WHERE v.`id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$panorDetail["id"]      = $results[0]['id'];
			$panorDetail["title"]   = $results[0]['title'];
			$panorDetail["litpic"]  = !empty($results[0]['litpic']) ? $results[0]['litpic'] : "";
			$panorDetail["panor"]   = $results[0]['panor'];
			$panorDetail["pubdate"] = $results[0]['pubdate'];
			$panorDetail["bid"]     = $results[0]['bid'];
		}
		return $panorDetail;
	}


	/**
     * 商家点评列表
     * @return array
     */
	public function comment_list(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$bid = $orderby = $page = $pageSize = $px = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$bid      = $this->param['bid'];
			$orderby  = $this->param['orderby'];
			$page     = $this->param['page'];
			$pageSize = $this->param['pageSize'];
		}

		if(empty($bid)) return array("state" => 200, "info" => '格式错误！');

		//排序
		$px = " ORDER BY `id` DESC";
		if(!empty($orderby)){
			if($orderby == "rating"){
				$px = " ORDER BY `rating` DESC, `id` DESC";
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `userid`, `rating`, `content`, `dtime`, `ip`, `ipaddr`, `reply`, `rtime` FROM `#@__business_comment` WHERE `ischeck` = 1 AND `bid` = $bid".$px);

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
				$list[$key]['content'] = $val['content'];
				$list[$key]['dtime']   = $val['dtime'];
				$list[$key]['ip']      = $val['ip'];
				$list[$key]['ipaddr']  = $val['ipaddr'];
				$list[$key]['reply']   = $val['reply'];
				$list[$key]['rtime']   = $val['rtime'];

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
     * 发表点评
     * @return array
     */
	public function sendComment(){
		global $dsql;
		global $userLogin;
		$param = $this->param;

		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请刷新页面重试！');

		$bid     = $param['bid'];
		$rating  = $param['rating'];
		$content = filterSensitiveWords(addslashes($param['content']));
		$ip      = GetIP();
		$ipaddr  = getIpAddr($ip);
		$date    = GetMkTime(time());

		if(empty($bid)) return array("state" => 200, "info" => '要点评的商家ID传递失败，请从正确的地址发表点评');
		if(empty($rating)) return array("state" => 200, "info" => '请先打分！');
		if(empty($content) || strlen($content) < 15) return array("state" => 200, "info" => '请输入点评内容，最少15个字！');

		$archives = $dsql->SetQuery("INSERT INTO `#@__business_comment` (`bid`, `userid`, `rating`, `content`, `dtime`, `ip`, `ipaddr`, `reply`, `rtime`, `ischeck`) VALUES ('$bid', '$userid', '$rating', '$content', '$date', '$ip', '$ipaddr', '', 0, 0)");
		$results  = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			return "点评成功！";
		}else{
			return array("state" => 200, "info" => '点评失败！');
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
		$title       = filterSensitiveWords(addslashes($param['title']));
		$logo       = filterSensitiveWords(addslashes($param['logo']));
		$typeid      = (int)$param['typeid'];
		$addrid      = (int)$param['addrid'];
		$address     = filterSensitiveWords(addslashes($param['address']));
		$lnglat      = explode(",", filterSensitiveWords(addslashes($param['lnglat'])));
		$lng         = $lnglat[0];
		$lat         = $lnglat[1];
		$wechatname  = filterSensitiveWords(addslashes($param['wechatname']));
		$wechatcode  = filterSensitiveWords(addslashes($param['wechatcode']));
		$wechatqr    = filterSensitiveWords(addslashes($param['wechatqr']));
		$tel         = filterSensitiveWords(addslashes($param['tel']));
		$qq          = filterSensitiveWords(addslashes($param['qq']));
		$banner      = filterSensitiveWords(addslashes($param['banner']));
		$pics        = filterSensitiveWords(addslashes($param['pics']));
		$license     = filterSensitiveWords(addslashes($param['license']));
		$certify     = filterSensitiveWords(addslashes($param['certify']));
		$opentime    = filterSensitiveWords(addslashes($param['opentime']));
		$amount      = filterSensitiveWords(addslashes($param['amount']));
		$parking     = filterSensitiveWords(addslashes($param['parking']));
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

		if(empty($title)){
			return array("state" => 200, "info" => '请输入店铺名称');
		}

		if(empty($logo)){
			return array("state" => 200, "info" => '请上传LOGO');
		}

		if(empty($typeid)){
			return array("state" => 200, "info" => '请选择经营品类');
		}

		if(empty($addrid)){
			return array("state" => 200, "info" => '请选择所属地区');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");

		//新商铺
		if(!$userResult){

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__business_list` (`uid`, `title`, `logo`, `typeid`, `addrid`, `address`, `lng`, `lat`, `wechatname`, `wechatcode`, `wechatqr`, `tel`, `qq`, `pics`, `banner`, `license`, `certify`, `opentime`, `amount`, `parking`, `pubdate`, `state`) VALUES ('$userid', '$title', '$logo', '$typeid', '$addrid', '$address', '$lng', '$lat', '$wechatname', '$wechatcode', '$wechatqr', '$tel', '$qq', '$pics', '$banner', '$license', '$certify', '$opentime', '$amount', '$parking', '$pubdate', 0)");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("business", "store");

				return "配置成功，您的商铺正在审核中，请耐心等待！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		//更新商铺信息
		}else{

			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__business_list` SET `title` = '$title', `logo` = '$logo', `typeid` = '$typeid', `addrid` = '$addrid', `address` = '$address', `lng` = '$lng', `lat` = '$lat', `wechatname` = '$wechatname', `wechatcode` = '$wechatcode', `wechatqr` = '$wechatqr', `tel` = '$tel', `qq` = '$qq', `pics` = '$pics', `banner` = '$banner', `license` = '$license', `certify` = '$certify', `opentime` = '$opentime', `amount` = '$amount', `parking` = '$parking', `state` = '0' WHERE `uid` = ".$userid);
			$results = $dsql->dsqlOper($archives, "update");

			if($results == "ok"){
				return "保存成功，您的商铺正在审核中，请耐心等待！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		}


	}


	/**
     * 动态分类
     * @return array
     */
	public function newstype(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__business_news_type` WHERE `uid` = $userid ORDER BY `weight` ASC");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}else{
			return array("state" => 200, "info" => '暂无相关分类！');
		}

	}




	/**
		* 更新动态分类
		* @return array
		*/
	public function updateNewsType(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$data = $_POST['data'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		if(empty($data)){
			return array("state" => 200, "info" => '请添加分类！');
		}

		$data = str_replace("\\", '', $data);
		$json = json_decode($data);
		$json = objtoarr($json);

		foreach ($json as $key => $value) {
			$id     = $value['id'];
			$weight = $value['weight'];
			$val    = $value['val'];

			//更新
			if(is_numeric($id)){
				$sql = $dsql->SetQuery("UPDATE `#@__business_news_type` SET `typename` = '$val', `weight` = '$weight' WHERE `uid` = $userid AND `id` = $id");
				$ret = $dsql->dsqlOper($sql, "update");

			//新增
			}else{
				$sql = $dsql->SetQuery("INSERT INTO `#@__business_news_type` (`uid`, `typename`, `weight`) VALUES ('$userid', '$val', '$weight')");
				$ret = $dsql->dsqlOper($sql, "update");
			}
		}

		return "保存成功";


	}




	/**
		* 删除动态分类
		* @return array
		*/
	public function delNewsType(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$id  = $this->param['id'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		if(empty($id)){
			return array("state" => 200, "info" => '删除失败，请重试！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__business_news_type` WHERE `id` = $id AND `uid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$sql = $dsql->SetQuery("DELETE FROM `#@__business_news` WHERE `typeid` = ".$id);
			$dsql->dsqlOper($sql, "update");

			$sql = $dsql->SetQuery("DELETE FROM `#@__business_news_type` WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");
			return "删除成功！";
		}else{
			return array("state" => 200, "info" => '分类验证失败！');
		}

	}


	/**
     * 动态信息
     * @return array
     */
	public function news(){
		global $dsql;
		global $userLogin;

		$userid   = $userLogin->getMemberID();
		$pageinfo = $list = array();
		$typeid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = (int)$this->param['typeid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = " WHERE `uid` = $userid";

		//类型
		if($typeid != ""){
			$where .= " AND `typeid` = $typeid";
		}

		$orderby = " ORDER BY `id` DESC";
		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_news`".$where.$orderby);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");
		$list = array();
		if($results){

			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['typeid'] = $val['typeid'];

				$typeName = "";
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_news_type` WHERE `id` = ".$val['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typeName = $ret[0]['typename'];
				}
				$list[$key]['typename'] = $typeName;

				$list[$key]['title'] = $val['title'];
				$list[$key]['click']  = $val['click'];
				$list[$key]['pubdate'] = $val['pubdate'];

				$param = array(
					"service"  => "business",
					"template" => "newsd",
					"id"       => $val['id']
				);
				$list[$key]['url']     = getUrlPath($param);

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 新闻详细信息
     * @return array
     */
	public function newsDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_news` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			//信息分类
			$typename = "";
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_news_type` WHERE `id` = ".$results[0]['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typename = $ret[0]['typename'];
			}
			$results[0]['typename'] = $typename;

			return $results[0];
		}else{
			return array("state" => 200, "info" => '分类不存在！');
		}
	}


	/**
		* 新增动态信息
		* @return array
		*/
	public function addnews(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$typeid      = (int)($param['typeid']);
		$body        = filterSensitiveWords($param['body']);
		$pubdate     = GetMkTime(time());
		$vdimgck     = $param['vdimgck'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($typeid)){
			return array("state" => 200, "info" => '请选择信息分类');
		}

		if(empty($body)){
			return array("state" => 200, "info" => "请输入信息内容");
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__business_news` (`uid`, `typeid`, `title`, `body`, `click`, `pubdate`) VALUES ('$userid', '$typeid', '$title', '$body', '0', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			return $aid;
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}



	/**
		* 修改动态信息
		* @return array
		*/
	public function editnews(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$id          = (int)($param['id']);
		$typeid      = (int)($param['typeid']);
		$body        = filterSensitiveWords($param['body']);
		$vdimgck     = $param['vdimgck'];

		if(empty($id)){
			return array("state" => 200, "info" => '请选择要修改的信息！');
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($typeid)){
			return array("state" => 200, "info" => '请选择信息分类');
		}

		if(empty($body)){
			return array("state" => 200, "info" => "请输入信息内容");
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__business_news` SET `title` = '$title', `typeid` = '$typeid', `body` = '$body' WHERE `uid` = $userid AND `id` = ".$id);
		$ret = $dsql->dsqlOper($archives, "update");

		if($ret == "ok"){
			return "修改成功！";
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 删除动态信息
		* @return array
		*/
	public function delnews(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_news` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['uid'] == $userid){
				$archives = $dsql->SetQuery("DELETE FROM `#@__business_news` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return '删除成功！';

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}


	/**
     * 介绍信息
     * @return array
     */
	public function about(){
		global $dsql;
		global $userLogin;

		$userid   = $userLogin->getMemberID();
		$pageinfo = $list = array();
		$typeid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = " WHERE `uid` = $userid";

		$orderby = " ORDER BY `weight` DESC, `id` DESC";
		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_about`".$where.$orderby);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");
		$list = array();
		if($results){

			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['click']  = $val['click'];
				$list[$key]['pubdate'] = $val['pubdate'];

				$param = array(
					"service"  => "business",
					"template" => "intro",
					"business" => $business,
					"id"       => $val['id']
				);
				$list[$key]['url']     = getUrlPath($param);

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 介绍详细信息
     * @return array
     */
	public function aboutDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_about` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results[0];
		}else{
			return array("state" => 200, "info" => '信息不存在！');
		}
	}


	/**
		* 新增介绍信息
		* @return array
		*/
	public function addabout(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$body        = filterSensitiveWords($param['body']);
		$weight      = (int)$param['weight'];
		$pubdate     = GetMkTime(time());
		$vdimgck     = $param['vdimgck'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($body)){
			return array("state" => 200, "info" => "请输入信息内容");
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__business_about` (`uid`, `title`, `body`, `weight`, `click`, `pubdate`) VALUES ('$userid', '$title', '$body', '$weight', '0', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			return $aid;
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}



	/**
		* 修改介绍信息
		* @return array
		*/
	public function editabout(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$id          = (int)($param['id']);
		$body        = filterSensitiveWords($param['body']);
		$weight      = (int)($param['weight']);
		$vdimgck     = $param['vdimgck'];

		if(empty($id)){
			return array("state" => 200, "info" => '请选择要修改的信息！');
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($body)){
			return array("state" => 200, "info" => "请输入信息内容");
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__business_about` SET `title` = '$title', `body` = '$body', `weight` = '$weight' WHERE `uid` = $userid AND `id` = ".$id);
		$ret = $dsql->dsqlOper($archives, "update");

		if($ret == "ok"){
			return "修改成功！";
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 删除介绍信息
		* @return array
		*/
	public function delabout(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_about` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['uid'] == $userid){
				$archives = $dsql->SetQuery("DELETE FROM `#@__business_about` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return '删除成功！';

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}


	/**
     * 相册分类
     * @return array
     */
	public function albumstype(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__business_albums_type` WHERE `uid` = $userid ORDER BY `weight` ASC");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}else{
			return array("state" => 200, "info" => '暂无相关分类！');
		}

	}




	/**
		* 更新相册分类
		* @return array
		*/
	public function updateAlbumsType(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$data = $_POST['data'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		if(empty($data)){
			return array("state" => 200, "info" => '请添加分类！');
		}

		$data = str_replace("\\", '', $data);
		$json = json_decode($data);
		$json = objtoarr($json);

		foreach ($json as $key => $value) {
			$id     = $value['id'];
			$weight = $value['weight'];
			$val    = $value['val'];

			//更新
			if(is_numeric($id)){
				$sql = $dsql->SetQuery("UPDATE `#@__business_albums_type` SET `typename` = '$val', `weight` = '$weight' WHERE `uid` = $userid AND `id` = $id");
				$ret = $dsql->dsqlOper($sql, "update");

			//新增
			}else{
				$sql = $dsql->SetQuery("INSERT INTO `#@__business_albums_type` (`uid`, `typename`, `weight`) VALUES ('$userid', '$val', '$weight')");
				$ret = $dsql->dsqlOper($sql, "update");
			}
		}

		return "保存成功";


	}




	/**
		* 删除相册分类
		* @return array
		*/
	public function delAlbumsType(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$id  = $this->param['id'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		if(empty($id)){
			return array("state" => 200, "info" => '删除失败，请重试！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__business_albums_type` WHERE `id` = $id AND `uid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$sql = $dsql->SetQuery("DELETE FROM `#@__business_albums` WHERE `typeid` = ".$id);
			$dsql->dsqlOper($sql, "update");

			$sql = $dsql->SetQuery("DELETE FROM `#@__business_albums_type` WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");
			return "删除成功！";
		}else{
			return array("state" => 200, "info" => '分类验证失败！');
		}

	}


	/**
     * 相册信息
     * @return array
     */
	public function albums(){
		global $dsql;
		global $userLogin;

		$userid   = $userLogin->getMemberID();
		$pageinfo = $list = array();
		$typeid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = (int)$this->param['typeid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = " WHERE `uid` = $userid";

		//类型
		if($typeid != ""){
			$where .= " AND `typeid` = $typeid";
		}

		$orderby = " ORDER BY `id` DESC";
		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_albums`".$where.$orderby);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");
		$list = array();
		if($results){

			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['typeid'] = $val['typeid'];

				$typeName = "";
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_albums_type` WHERE `id` = ".$val['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typeName = $ret[0]['typename'];
				}
				$list[$key]['typename'] = $typeName;

				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['click']  = $val['click'];
				$list[$key]['pubdate'] = $val['pubdate'];

				$param = array(
					"service"  => "business",
					"template" => "albumsd",
					"id"       => $val['id']
				);
				$list[$key]['url']     = getUrlPath($param);

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 相册详细信息
     * @return array
     */
	public function albumsDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_news` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			//信息分类
			$typename = "";
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__business_albums_type` WHERE `id` = ".$results[0]['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typename = $ret[0]['typename'];
			}
			$results[0]['typename'] = $typename;

			$results[0]['litpicSource'] = $results[0]['litpic'];
			$results[0]['litpic'] = getFilePath($results[0]['litpic']);

			return $results[0];
		}else{
			return array("state" => 200, "info" => '信息不存在！');
		}
	}


	/**
		* 新增相册信息
		* @return array
		*/
	public function addalbums(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$pics    = filterSensitiveWords(addslashes($param['pics']));
		$typeid  = (int)($param['typeid']);
		$pubdate = GetMkTime(time());
		$vdimgck = $param['vdimgck'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');


		if(empty($typeid)){
			return array("state" => 200, "info" => '请选择信息分类');
		}

		if(empty($pics)){
			return array("state" => 200, "info" => '请上传图片');
		}

		$picsArr = explode(",", $pics);
		foreach ($picsArr as $key => $value) {
			$archives = $dsql->SetQuery("INSERT INTO `#@__business_albums` (`uid`, `typeid`, `litpic`, `pubdate`) VALUES ('$userid', '$typeid', '$value', '$pubdate')");
			$aid = $dsql->dsqlOper($archives, "update");
		}
		return "上传成功！";

	}


	/**
		* 删除动态信息
		* @return array
		*/
	public function delalbums(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_albums` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['uid'] == $userid){

				//删除图集
				delPicFile($results['litpic'], "delAtlas", "business");

				$archives = $dsql->SetQuery("DELETE FROM `#@__business_albums` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return '删除成功！';

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}


	/**
     * 商家视频
     * @return array
     */
	public function video(){
		global $dsql;
		global $userLogin;

		$userid   = $userLogin->getMemberID();
		$pageinfo = $list = array();
		$typeid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = " WHERE `uid` = $userid";

		$orderby = " ORDER BY `id` DESC";
		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_video`".$where.$orderby);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");
		$list = array();
		if($results){

			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['click']  = $val['click'];
				$list[$key]['pubdate'] = $val['pubdate'];

				$param = array(
					"service"  => "business",
					"template" => "videod",
					"id"       => $val['id']
				);
				$list[$key]['url']     = getUrlPath($param);

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 视频详细信息
     * @return array
     */
	public function videoDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_video` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$results[0]['litpicSource'] = $results[0]['litpic'];
			$results[0]['litpic'] = getFilePath($results[0]['litpic']);

			return $results[0];
		}else{
			return array("state" => 200, "info" => '信息不存在！');
		}
	}


	/**
		* 新增视频信息
		* @return array
		*/
	public function addvideo(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$litpic      = filterSensitiveWords($param['litpic']);
		$video        = filterSensitiveWords($param['video']);
		$pubdate     = GetMkTime(time());
		$vdimgck     = $param['vdimgck'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($litpic)){
			return array("state" => 200, "info" => "请上传图片");
		}

		if(strstr($video, "iframe")){
			preg_match_all('/<iframe.*?(?: |\t|\r|\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\t|\r|\n)+.*?)?>(.*?)<\/iframe.*?>/sim', $video, $iframe);
			$video = $iframe[1][0];
		}

		if(empty($video)){
			return array("state" => 200, "info" => "请输入视频地址");
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__business_video` (`uid`, `title`, `litpic`, `video`, `click`, `pubdate`) VALUES ('$userid', '$title', '$litpic', '$video', '0', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			return $aid;
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}



	/**
		* 修改视频信息
		* @return array
		*/
	public function editvideo(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$id          = (int)($param['id']);
		$litpic      = filterSensitiveWords($param['litpic']);
		$video       = filterSensitiveWords($param['video']);
		$weight      = (int)($param['weight']);
		$vdimgck     = $param['vdimgck'];

		if(empty($id)){
			return array("state" => 200, "info" => '请选择要修改的信息！');
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($litpic)){
			return array("state" => 200, "info" => "请上传图片");
		}

		if(empty($video)){
			return array("state" => 200, "info" => "请输入视频地址");
		}

		if(strstr($video, "iframe")){
			preg_match_all('/<iframe.*?(?: |\t|\r|\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\t|\r|\n)+.*?)?>(.*?)<\/iframe.*?>/sim', $video, $iframe);
			$video = $iframe[1][0];
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__business_video` SET `title` = '$title', `litpic` = '$litpic', `video` = '$video' WHERE `uid` = $userid AND `id` = ".$id);
		$ret = $dsql->dsqlOper($archives, "update");

		if($ret == "ok"){
			return "修改成功！";
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 删除视频信息
		* @return array
		*/
	public function delvideo(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_video` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['uid'] == $userid){
				$archives = $dsql->SetQuery("DELETE FROM `#@__business_video` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return '删除成功！';

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}


	/**
     * 商家全景
     * @return array
     */
	public function panor(){
		global $dsql;
		global $userLogin;

		$userid   = $userLogin->getMemberID();
		$pageinfo = $list = array();
		$typeid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = " WHERE `uid` = $userid";

		$orderby = " ORDER BY `id` DESC";
		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_panor`".$where.$orderby);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");
		$list = array();
		if($results){

			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['click']  = $val['click'];
				$list[$key]['pubdate'] = $val['pubdate'];

				$param = array(
					"service"  => "business",
					"template" => "panord",
					"id"       => $val['id']
				);
				$list[$key]['url']     = getUrlPath($param);

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 全景详细信息
     * @return array
     */
	public function panorDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_panor` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$results[0]['litpicSource'] = $results[0]['litpic'];
			$results[0]['litpic'] = getFilePath($results[0]['litpic']);

			return $results[0];
		}else{
			return array("state" => 200, "info" => '信息不存在！');
		}
	}


	/**
		* 新增全景信息
		* @return array
		*/
	public function addpanor(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$litpic      = filterSensitiveWords($param['litpic']);
		$panor        = filterSensitiveWords($param['panor']);
		$pubdate     = GetMkTime(time());
		$vdimgck     = $param['vdimgck'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($litpic)){
			return array("state" => 200, "info" => "请上传图片");
		}

		if(empty($panor)){
			return array("state" => 200, "info" => "请输入全景地址");
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__business_panor` (`uid`, `title`, `litpic`, `panor`, `click`, `pubdate`) VALUES ('$userid', '$title', '$litpic', '$panor', '0', '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			return $aid;
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}



	/**
		* 修改全景信息
		* @return array
		*/
	public function editpanor(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title       = filterSensitiveWords(addslashes($param['title']));
		$id          = (int)($param['id']);
		$litpic      = filterSensitiveWords($param['litpic']);
		$panor       = filterSensitiveWords($param['panor']);
		$weight      = (int)($param['weight']);
		$vdimgck     = $param['vdimgck'];

		if(empty($id)){
			return array("state" => 200, "info" => '请选择要修改的信息！');
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($title)){
			return array("state" => 200, "info" => '请输入信息标题');
		}

		if(empty($litpic)){
			return array("state" => 200, "info" => "请上传图片");
		}

		if(empty($panor)){
			return array("state" => 200, "info" => "请输入全景地址");
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__business_panor` SET `title` = '$title', `litpic` = '$litpic', `panor` = '$panor' WHERE `uid` = $userid AND `id` = ".$id);
		$ret = $dsql->dsqlOper($archives, "update");

		if($ret == "ok"){
			return "修改成功！";
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 删除全景信息
		* @return array
		*/
	public function delpanor(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_panor` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['uid'] == $userid){
				$archives = $dsql->SetQuery("DELETE FROM `#@__business_panor` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return '删除成功！';

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}


	/**
     * 点评列表
     * @return array
     */
	public function comment(){
		global $dsql;
		global $userLogin;
		$page = $pageSize = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$userid   = $userLogin->getMemberID();
		$pageinfo = $list = array();

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = " WHERE `bid` = $business AND `isCheck` = 1";
		$orderby = " ORDER BY `id` DESC";
		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_comment`".$where.$orderby);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where, "results");
		$list = array();
		if($results){

			foreach($results as $key => $val){
				$list[$key]['id'] = $val['id'];
				$list[$key]['userid'] = $val['userid'];
				if($val['userid']){
					$userinfo = $userLogin->getMemberInfo($val['userid']);
					$list[$key]['username'] = $userinfo['username'];
				}else{
					$list[$key]['username'] = '游客';
				}
				$list[$key]['rating'] = $val['rating'];
				$list[$key]['content'] = $val['content'];
				$list[$key]['ip']  = $val['ip'];
				$list[$key]['ipaddr'] = $val['ipaddr'];
				$list[$key]['dtime'] = $val['dtime'];
				$list[$key]['reply'] = $val['reply'];
				$list[$key]['rtime'] = $val['rtime'];
			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
		* 删除点评信息
		* @return array
		*/
	public function delComment(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_comment` WHERE `id` = $id AND `isCheck` = 1");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['bid'] == $business){
				$archives = $dsql->SetQuery("DELETE FROM `#@__business_comment` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return '删除成功！';
			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}


	/**
		* 回复点评信息
		* @return array
		*/
	public function replyComment(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];
		$reply = $this->param['reply'];
		$rtime = GetMkTime(time());

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$userid = $userLogin->getMemberID();
		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__business_list` WHERE `state` = 1 AND `uid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '请先申请商家店铺！');
		}

		$business = $userResult[0]['id'];

		$archives = $dsql->SetQuery("SELECT * FROM `#@__business_comment` WHERE `id` = $id AND `isCheck` = 1");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['bid'] == $business){

				if(!empty($reply)){
					$archives = $dsql->SetQuery("UPDATE `#@__business_comment` SET `reply` = '$reply', `rtime` = '$rtime' WHERE `id` = ".$id);
				}else{
					$archives = $dsql->SetQuery("UPDATE `#@__business_comment` SET `reply` = '' WHERE `id` = ".$id);
				}
				$dsql->dsqlOper($archives, "update");
				return '回复成功！';
			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}




}
