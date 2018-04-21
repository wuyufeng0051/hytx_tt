<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 房产模块API接口
 *
 * @version        $Id: house.class.php 2014-3-23 上午09:25:10 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class house {
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
     * 房产基本参数
     * @return array
     */
	public function config(){

		require(HUONIAOINC."/config/house.inc.php");

		global $cfg_fileUrl;              //系统附件默认地址
		global $cfg_uploadDir;            //系统附件默认上传目录
		// global $customFtp;                //是否自定义FTP
		// global $custom_ftpState;          //FTP是否开启
		// global $custom_ftpUrl;            //远程附件地址
		// global $custom_ftpDir;            //FTP上传目录
		// global $custom_uploadDir;         //默认上传目录
		global $cfg_basehost;             //系统主域名
		global $cfg_hotline;              //系统默认咨询热线

		// global $custom_la_atlasMax;              //楼盘户型图集数量限制
		// global $custom_ll_atlasMax;              //楼盘房源图集数量限制
		// global $custom_ca_atlasMax;              //小区户型图集数量限制
		// global $custom_houseSale_atlasMax;       //二手房图集数量限制
		// global $custom_houseZu_atlasMax;         //租房图集数量限制
		// global $custom_houseXzl_atlasMax;        //写字楼图集数量限制
		// global $custom_houseSp_atlasMax;         //商铺图集数量限制
		// global $custom_houseCf_atlasMax;         //厂房图集数量限制

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
		// global $custom_map;               //自定义地图

		global $cfg_map;                  //系统默认地图
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

		if(empty($custom_map)) $custom_map = $cfg_map;

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

		// $domainInfo = getDomain('house', 'config');
		// $customChannelDomain = $domainInfo['domain'];
		// if($customSubDomain == 0){
		// 	$customChannelDomain = "http://".$customChannelDomain;
		// }elseif($customSubDomain == 1){
		// 	$customChannelDomain = "http://".$customChannelDomain.".".$cfg_basehost;
		// }elseif($customSubDomain == 2){
		// 	$customChannelDomain = "http://".$cfg_basehost."/".$customChannelDomain;
		// }

		include HUONIAOINC.'/siteModuleDomain.inc.php';
		$customChannelDomain = $houseDomain;

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
				}elseif($param == "la_atlasMax"){
					$return['la_atlasMax'] = $custom_la_atlasMax;
				}elseif($param == "ll_atlasMax"){
					$return['ll_atlasMax'] = $custom_ll_atlasMax;
				}elseif($param == "ca_atlasMax"){
					$return['ca_atlasMax'] = $custom_ca_atlasMax;
				}elseif($param == "houseSale_atlasMax"){
					$return['houseSale_atlasMax'] = $custom_houseSale_atlasMax;
				}elseif($param == "houseZu_atlasMax"){
					$return['houseZu_atlasMax'] = $custom_houseZu_atlasMax;
				}elseif($param == "houseXzl_atlasMax"){
					$return['houseXzl_atlasMax'] = $custom_houseXzl_atlasMax;
				}elseif($param == "houseSp_atlasMax"){
					$return['houseSp_atlasMax'] = $custom_houseSp_atlasMax;
				}elseif($param == "houseCf_atlasMax"){
					$return['houseCf_atlasMax'] = $custom_houseCf_atlasMax;
				}elseif($param == "map"){
					$return['map'] = $custom_map;
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

			//自定义LOGO
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
			$return['la_atlasMax']        = $custom_la_atlasMax;
			$return['ll_atlasMax']        = $custom_ll_atlasMax;
			$return['ca_atlasMax']        = $custom_ca_atlasMax;
			$return['houseSale_atlasMax'] = $custom_houseSale_atlasMax;
			$return['houseZu_atlasMax']   = $custom_houseZu_atlasMax;
			$return['houseXzl_atlasMax']  = $custom_houseXzl_atlasMax;
			$return['houseSp_atlasMax']   = $custom_houseSp_atlasMax;
			$return['houseCf_atlasMax']   = $custom_houseCf_atlasMax;
			$return['map']           = $custom_map;
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
     * 房产地区
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
		$results = $dsql->getTypeList($type, "houseaddr", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 房产字段
     * @return array
     */
	public function item(){
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
		$results = $dsql->getTypeList($type, "houseitem", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 房产行业
     * @return array
     */
	public function industry(){
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
		$results = $dsql->getTypeList($type, "house_industry", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 求租求购列表
     * @return array
     */
	public function demand(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$typeid = $addrid = $act = $title = $u = $state = $page = $pageSize = $orderby = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$addrid   = $this->param['addrid'];
				$act   = $this->param['act'];
				$title    = $this->param['title'];
				$u        = $this->param['u'];
				$state    = $this->param['state'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}


		//是否输出当前登录会员的信息
		if($u != 1){
			$where .= " AND `state` = 1";
			$orderby = " ORDER BY `weight` DESC, `id` DESC";
		}else{
			$uid = $userLogin->getMemberID();
			$where .= " AND `userid` = ".$uid;

			if($state != ""){
				$where1 = " AND `state` = ".$state;
			}
			$orderby = " ORDER BY `id` DESC";
		}

		//类型
		if($typeid != ""){
			$where .= " AND `type` = " . $typeid;
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addr` in ($lower)";
		}

		//类别
		if($act != ""){
			$where .= " AND `action` = " . $act;
		}

		//关键字
		if(!empty($title)){
			$where .= " AND (`title` like '%".$title."%' OR `person` like '%".$title."%')";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `title`, `note`, `action`, `type`, `addr`, `person`, `contact`, `pubdate`, `state` " .
									"FROM `#@__housedemand` " .
									"WHERE " .
									"1 = 1".$where);

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

		//会员列表需要统计信息状态
		if($u == 1 && $userLogin->getMemberID() > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND `state` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']      = $val['id'];
				$list[$key]['title']   = $val['title'];
				$list[$key]['note']    = $val['note'];
				$list[$key]['action']  = $val['action'];
				$list[$key]['type']    = $val['type'];

				if($val['addr'] == 0){
					$list[$key]['addr']  = "不限";
				}else{
					$addrName = getParentArr("houseaddr", $val['addr']);
					global $data;
					$data = "";
					$addrName = array_reverse(parent_foreach($addrName, "typename"));
					$list[$key]['addr']  = join(" > ", $addrName);
				}

				$list[$key]['person']  = $val['person'];
				$list[$key]['contact'] = $val['contact'];
				$list[$key]['state']   = $val['state'];
				$list[$key]['pubdate'] = $val['pubdate'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 求租、求购信息详细
     * @return array
     */
	public function demandDetail(){
		global $dsql;
		global $userLogin;
		$demanDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		$where = "";
		if($userLogin->getUserID() == -1){

			$where = " AND `state` = 1";

			//如果没有登录再验证会员是否已经登录
			if($userLogin->getMemberID() == -1){
				$where = " AND `state` = 1";
			}else{
				$where = " AND `userid` = ".$userLogin->getMemberID();
			}

		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__housedemand` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			global $cfg_clihost;
			$demanDetail["id"]      = $results[0]['id'];
			$demanDetail["title"]   = $results[0]['title'];
			$demanDetail["note"]    = $results[0]['note'];
			$demanDetail["action"]  = $results[0]['action'];
			$demanDetail["type"]    = $results[0]['type'];
			$demanDetail["addrid"]  = $results[0]['addr'];

			global $data;
			$data = "";
			$addrArr = getParentArr("houseaddr", $results[0]['addr']);
			$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
			$demanDetail['addrName'] = join(" > ", $addrArr);

			$demanDetail["person"]  = $results[0]['person'];
			$demanDetail["contact"] = $results[0]['contact'];
			$demanDetail["pubdate"] = $results[0]['pubdate'];

		}
		return $demanDetail;
	}


	/**
     * 房源举报
     * @return array
     */
	public function report(){
		global $dsql;
		$param = $this->param;

		if(!is_array($param)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$action  = $param['action'];
		$aid     = $param['aid'];
		$type    = $param['type'];
		$note    = $param['note'];

		if(empty($action) || empty($aid) || empty($type)){
			return array("state" => 200, "info" => '必填项不得为空！');
		}

		$archives = $dsql->SetQuery("INSERT INTO `#@__house_report` (`action`, `aid`, `type`, `note`, `pubdate`) VALUES ('$action', '$aid', '$type', '$note', ".GetMkTime(time()).")");
		$results  = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			return "举报成功！";
		}else{
			return array("state" => 200, "info" => '举报失败！');
		}

	}



	/**
     * 楼盘列表
     * @return array
     */
	public function loupanList(){
		global $dsql;
		$pageinfo = $list = array();
		$typeid = $addrid = $subway = $station = $price = $keywords = $times = $zhuangxiu = $salestate = $filter = $tuandate = $buildtype = $orderby = $nid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid    = $this->param['typeid'];
				$addrid    = $this->param['addrid'];
				$subway    = $this->param['subway'];
				$station   = $this->param['station'];
				$price     = $this->param['price'];
				$keywords  = $this->param['keywords'];
				$times     = $this->param['times'];
				$zhuangxiu = $this->param['zhuangxiu'];
				$salestate = $this->param['salestate'];
				$filter    = $this->param['filter'];
				$tuandate  = $this->param['tuandate'];
				$buildtype = $this->param['buildtype'];
				$nid       = $this->param['nid'];
				$orderby   = $this->param['orderby'];
				$page      = $this->param['page'];
				$pageSize  = $this->param['pageSize'];
			}
		}


		//类型
		if(!empty($typeid)){
			$where .= " AND FIND_IN_SET(".$typeid.", `protype`)";
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addrid` in ($lower)";
		}

		//地铁
		//如果站点不为空则直接进行验证
		if(!empty($station)){

			$where .= " AND FIND_IN_SET ($station, `subway`)";

		//如果站点为空，线路不为空，则先查询出线路的站点再验证
		}elseif(!empty($subway)){

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_subway_station` WHERE `sid` = $subway ORDER BY `weight`");
			$res = $dsql->dsqlOper($sql, "results");
			if($res){
				$subway = array();
				foreach ($res as $key => $value) {
					$subway[] = "FIND_IN_SET (".$value['id'].", `subway`)";
				}

				$where .= " AND (".join(" OR ", $subway).")";
			}

		}

		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND `price` < " . $price[1] * 1000;
			}elseif(empty($price[1])){
				$where .= " AND `price` > " . $price[0] * 1000;
			}else{
				$where .= " AND `price` BETWEEN " . $price[0] * 1000 . " AND " . $price[1] * 1000;
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (`title` like '%".$keywords."%' OR `addr` like '%".$keywords."%' OR `buildtype` like '%".$keywords."%')";
		}

		$now       = GetMkTime(time());
		$today     = GetMkTime(date("Y-m-d"));  //今日
		$yesterday = GetMkTime(date("Y-m-d", strtotime("-1 day")));  //昨日
		$tomorrow  = GetMkTime(date("Y-m-d", strtotime("+1 day")));  //明日
		$acquired  = GetMkTime(date("Y-m-d", strtotime("+2 day")));  //后日
		$tmonth    = GetMkTime(date("Y-m")."-1");  //本月
		$nmonth    = GetMkTime(date("Y-m"."-1", strtotime("+1 month")));  //下月
		$nmonth_   = GetMkTime(date("Y-m"."-1", strtotime("+2 month")));  //下下月
		$lmonth    = GetMkTime(date("Y-m"."-1", strtotime("-1 month")));  //上月

		//时间筛选
		if(!empty($times)){
			//今日
			if($times == "today"){
				$where .= " AND (`deliverdate` >= ".$today." AND `deliverdate` < ".$tomorrow.")";

			//明日
			}elseif($times == "tomorrow"){
				$where .= " AND (`deliverdate` >= ".$tomorrow." AND `deliverdate` < ".$acquired.")";

			//昨日
			}elseif($times == "yesterday"){
				$where .= " AND (`deliverdate` >= ".$yesterday." AND `deliverdate` < ".$today.")";

			//本月
			}elseif($times == "tmonth"){
				$where .= " AND (`deliverdate` >= ".$tmonth." AND `deliverdate` < ".$nmonth.")";

			//下月
			}elseif($times == "nmonth"){
				$where .= " AND (`deliverdate` >= ".$nmonth." AND `deliverdate` < ".$nmonth_.")";

			//上月
			}elseif($times == "lmonth"){
				$where .= " AND (`deliverdate` >= ".$lmonth." AND `deliverdate` < ".$tmonth.")";
			}
		}

		//装修
		if(!empty($zhuangxiu)){
			$where .= " AND `zhuangxiu` = ".$zhuangxiu;
		}

		//建筑类型
		if(!empty($buildtype)){
			$where .= " AND `buildtype` like '%".$buildtype."%'";
		}

		//销售状态
		if($salestate != ""){
			$where .= " AND `salestate` = ".$salestate;
		}

		//筛选
		if(!empty($filter)){
			$filterArr = explode(",", $filter);
			foreach ($filterArr as $key => $value) {
				if($value == "hot"){
					$where .= " AND `hot` = 1";
				}elseif($value == "rec"){
					$where .= " AND `rec` = 1";
				}elseif($value == "tuan"){
					$where .= " AND `tuan` = 1 AND $now > `tuanbegan` AND $now < `tuanend`";
				}
			}
		}

		//团购时间筛选
		if(!empty($tuandate)){
			//今日
			if($tuandate == "today"){
				$where .= " AND (`tuanbegan` >= ".$today." AND `tuanbegan` < ".$tomorrow.")";

			//明日
			}elseif($tuandate == "tomorrow"){
				$where .= " AND (`tuanbegan` >= ".$tomorrow." AND `tuanbegan` < ".$acquired.")";

			//昨日
			}elseif($tuandate == "yesterday"){
				$where .= " AND (`tuanbegan` >= ".$yesterday." AND `tuanbegan` < ".$today.")";

			//本月
			}elseif($tuandate == "tmonth"){
				$where .= " AND (`tuanbegan` >= ".$tmonth." AND `tuanbegan` < ".$nmonth.")";

			//下月
			}elseif($tuandate == "nmonth"){
				$where .= " AND (`tuanbegan` >= ".$nmonth." AND `tuanbegan` < ".$nmonth_.")";

			//上月
			}elseif($tuandate == "lmonth"){
				$where .= " AND (`tuanbegan` >= ".$lmonth." AND `tuanbegan` < ".$tmonth.")";
			}
		}


		//屏蔽ID
		if(!empty($nid)){
			$where .= " AND `id` NOT IN ($nid)";
		}


		//排序
		if(!empty($orderby)){
			//价格升序
			if($orderby == 1){
				$orderby = " ORDER BY `price` ASC, `rec` DESC, `hot` DESC, `weight` DESC, `id` DESC";
			//价格降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY `price` DESC, `rec` DESC, `hot` DESC, `weight` DESC, `id` DESC";
			//开盘时间降序
			}elseif($orderby == 3){
				$orderby = " ORDER BY `deliverdate` DESC, `rec` DESC, `hot` DESC, `weight` DESC, `id` DESC";
			//开盘时间升序
			}elseif($orderby == 4){
				$orderby = " ORDER BY `deliverdate` ASC, `rec` DESC, `hot` DESC, `weight` DESC, `id` DESC";
			}
		}else{
			$orderby = " ORDER BY `rec` DESC, `hot` DESC, `weight` DESC, `id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `title`, `addrid`, `addr`, `longitude`, `latitude`, `litpic`, `deliverdate`, `opendate`, `price`, `ptype`, `salestate`, `hot`, `rec`, `tuan`, `tuanbegan`, `tuanend`, `protype`, `buildtype`, `zhuangxiu` " .
									"FROM `#@__house_loupan` " .
									"WHERE " .
									"`state` = 1".$where . $orderby);

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
				$list[$key]['id']         = $val['id'];
				$list[$key]['title']      = $val['title'];
				$list[$key]['addrid']     = $val['addrid'];

				$addrName = getParentArr("houseaddr", $val['addrid']);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['addr']       = $addrName;
				$list[$key]['address']    = $val['addr'];

				$list[$key]['longitude']  = $val['longitude'];
				$list[$key]['latitude']   = $val['latitude'];

				$param = array("url" => getFilePath($val['litpic']), "type" => "small");

				$list[$key]['litpic']     = changeFileSize($param);
				$list[$key]['deliverdate'] = $val['deliverdate'];
				$list[$key]['opendate']   = $val['opendate'];
				$list[$key]['price']      = $val['price'];
				$list[$key]['ptype']      = $val['ptype'];

				$list[$key]['salestate']  = $val['salestate'];
				$list[$key]['hot']        = $val['hot'];
				$list[$key]['rec']        = $val['rec'];
				$list[$key]['tuan']       = $val['tuan'];

				//团购状态
				if($now < $val['tuanbegan']){
					$list[$key]['tuanState'] = 1;
				}elseif($now > $val['tuanend']){
					$list[$key]['tuanState'] = 3;
				}elseif($now > $val['tuanbegan'] && $now < $val['tuanend']){
					$list[$key]['tuanState'] = 2;
				}

				$list[$key]['tuanbegan']  = $val['tuanbegan'];
				$list[$key]['tuanend']    = $val['tuanend'];

				//团购人数
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_loupantuan` WHERE `aid` = ".$val['id']);
				$totalCount = $dsql->dsqlOper($sql, "totalCount");
				$list[$key]['tuanCount']  = $totalCount;

				$protype = explode(",", $val['protype']);
				$protypeArr = array();
				foreach ($protype as $k => $v) {
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
				}
				$list[$key]['protype']    = join(",", $protypeArr);

				$list[$key]['buildtype']  = explode(" ", $val['buildtype']);

				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['zhuangxiu']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
				$list[$key]['zhuangxiu']  = $zhuangxiu;

				$param = array(
					"service"     => "house",
					"template"    => "loupan-detail",
					"id"          => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);

				//户型数量
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_apartment` WHERE `action` = 'loupan' AND `loupan` = ".$val['id']);
				$hxcount = $dsql->dsqlOper($sql, "totalCount");
				$list[$key]['hxcount'] = $hxcount;

				//图集数量
				$sql = $dsql->SetQuery("SELECT p.`id` FROM `#@__house_album` a LEFT JOIN `#@__house_pic` p ON p.`aid` = a.`id` WHERE p.`type` = 'albumloupan' AND a.`action` = 'loupan' AND a.`loupan` = ".$val['id']);
				$piccount = $dsql->dsqlOper($sql, "totalCount");
				$list[$key]['piccount'] = $piccount;



			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 楼盘浏览记录列表
     * @return array
     */
	public function loupanHistory(){
		global $dsql;

		$list = array();
		$loupanHistoryCookie = GetCookie("house_loupan_history");
		if(empty($loupanHistoryCookie))	return array("state" => 200, "info" => '暂无数据！');

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `addrid`, `addr`, `litpic`, `price` FROM `#@__house_loupan` WHERE `state` = 1 AND `id` in (".$loupanHistoryCookie.") ORDER BY instr(',".$loupanHistoryCookie.",', concat(',',id,','))");

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$results = $dsql->dsqlOper($archives, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']         = $val['id'];
				$list[$key]['title']      = $val['title'];
				$list[$key]['addrid']     = $val['addrid'];

				$addrName = getParentArr("houseaddr", $val['addrid']);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['addr']       = $addrName;

				$param = array("url" => getFilePath($val['litpic']), "type" => "small");

				$list[$key]['litpic']     = changeFileSize($param);
				$list[$key]['price']      = $val['price'];

				$param = array(
					"service"     => "house",
					"template"    => "loupan-detail",
					"id"          => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);
			}
		}

		return array("pageInfo" => "ok", "list" => $list);
	}


	/**
		* 区域楼盘统计
		*
		* @return array
		*/
	public function loupanDistrict(){
		global $dsql;
		$typeid   = $this->param['typeid'];
		$price    = $this->param['price'];
		$keywords = $this->param['keywords'];
		$times    = $this->param['times'];
		$zhuangxiu   = $this->param['zhuangxiu'];
		$buildtype   = $this->param['buildtype'];
		$salestate   = $this->param['salestate'];

		$data = array();

		//类型
		if(!empty($typeid)){
			$where .= " AND FIND_IN_SET(".$typeid.", `protype`)";
		}

		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND `price` < " . $price[1] * 1000;
			}elseif(empty($price[1])){
				$where .= " AND `price` > " . $price[0] * 1000;
			}else{
				$where .= " AND `price` BETWEEN " . $price[0] * 1000 . " AND " . $price[1] * 1000;
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (`title` like '%".$keywords."%' OR `addr` like '%".$keywords."%' OR `buildtype` like '%".$keywords."%')";
		}

		$now       = GetMkTime(time());
		$today     = GetMkTime(date("Y-m-d"));  //今日
		$yesterday = GetMkTime(date("Y-m-d", strtotime("-1 day")));  //昨日
		$tomorrow  = GetMkTime(date("Y-m-d", strtotime("+1 day")));  //明日
		$acquired  = GetMkTime(date("Y-m-d", strtotime("+2 day")));  //后日
		$tmonth    = GetMkTime(date("Y-m")."-1");  //本月
		$nmonth    = GetMkTime(date("Y-m"."-1", strtotime("+1 month")));  //下月
		$nmonth_   = GetMkTime(date("Y-m"."-1", strtotime("+2 month")));  //下下月
		$lmonth    = GetMkTime(date("Y-m"."-1", strtotime("-1 month")));  //上月

		//时间筛选
		if(!empty($times)){
			//今日
			if($times == "today"){
				$where .= " AND (`deliverdate` >= ".$today." AND `deliverdate` < ".$tomorrow.")";

			//明日
			}elseif($times == "tomorrow"){
				$where .= " AND (`deliverdate` >= ".$tomorrow." AND `deliverdate` < ".$acquired.")";

			//昨日
			}elseif($times == "yesterday"){
				$where .= " AND (`deliverdate` >= ".$yesterday." AND `deliverdate` < ".$today.")";

			//本月
			}elseif($times == "tmonth"){
				$where .= " AND (`deliverdate` >= ".$tmonth." AND `deliverdate` < ".$nmonth.")";

			//下月
			}elseif($times == "nmonth"){
				$where .= " AND (`deliverdate` >= ".$nmonth." AND `deliverdate` < ".$nmonth_.")";

			//上月
			}elseif($times == "lmonth"){
				$where .= " AND (`deliverdate` >= ".$lmonth." AND `deliverdate` < ".$tmonth.")";
			}
		}

		//装修
		if(!empty($zhuangxiu)){
			$where .= " AND `zhuangxiu` = ".$zhuangxiu;
		}

		//建筑类型
		if(!empty($buildtype)){
			$where .= " AND `buildtype` like '%".$buildtype."%'";
		}

		//销售状态
		if($salestate != ""){
			$where .= " AND `salestate` = ".$salestate;
		}

		//所有一级区域
		$sql = $dsql->SetQuery("SELECT `id`, `typename`, `longitude`, `latitude` FROM `#@__houseaddr` WHERE `parentid` = 0 ORDER BY `weight`");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$kk = 0;
			foreach ($ret as $key => $value) {

				$ids = array($value['id']);
				$addrSql = $dsql->SetQuery("SELECT `id` FROM `#@__houseaddr` WHERE `parentid` = ".$value['id']." ORDER BY `weight`");
				$addrRet = $dsql->dsqlOper($addrSql, "results");
				foreach ($addrRet as $k => $v) {
					array_push($ids, $v['id']);
				}

				$count = $price = 0;

				if($ids){
					$loupanSql = $dsql->SetQuery("SELECT COUNT(`id`) count, AVG(`price`) price FROM `#@__house_loupan` WHERE `addrid` in (".join(",", $ids).")".$where);
					$loupanRet = $dsql->dsqlOper($loupanSql, "results");
					if($loupanRet){
						$count = $loupanRet[0]['count'];
						$price = sprintf("%.2f", $loupanRet[0]['price']);
					}
				}

				if($count > 0){
					$data[$kk]['id']        = $value['id'];
					$data[$kk]['addrname']  = $value['typename'];
					$data[$kk]['longitude'] = $value['longitude'];
					$data[$kk]['latitude']  = $value['latitude'];
					$data[$kk]['count']     = $count;
					$data[$kk]['price']     = $price;
					$kk++;
				}

			}
		}

		if($data){
			return $data;
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

	}



	/**
     * 楼盘详细
     * @return array
     */
	public function loupanDetail(){
		global $dsql;
		$loupanDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_loupan` WHERE `state` = 1 AND `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$loupanDetail["id"] = $id;
			$loupanDetail["title"]      = $results[0]['title'];

			$addrid = $results[0]['addrid'];
			$areaid = 0;

			//父级区域
			$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$addrid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$areaid = $ret[0]['parentid'];
			}

			$loupanDetail["areaid"]     = $areaid;
			$loupanDetail["addrid"]     = $addrid;

			$addrName = getParentArr("houseaddr", $results[0]['addrid']);
			global $data;
			$data = "";
			$addrName = array_reverse(parent_foreach($addrName, "typename"));
			$loupanDetail['addr']       = $addrName;

			$loupanDetail["address"]    = $results[0]['addr'];
			$loupanDetail["longitude"]  = $results[0]['longitude'];
			$loupanDetail["latitude"]   = $results[0]['latitude'];
			$loupanDetail["litpic"]     = getFilePath($results[0]['litpic']);
			$loupanDetail["bussiness"]  = $results[0]['bussiness'];
			$loupanDetail["deliverdate"]= $results[0]['deliverdate'];
			$loupanDetail["opendate"]   = $results[0]['opendate'];
			$loupanDetail["price"]      = $results[0]['price'];
			$loupanDetail["ptype"]      = $results[0]['ptype'];
			$loupanDetail["views"]      = $results[0]['views'];
			$loupanDetail["salestate"]  = $results[0]['salestate'];
			$loupanDetail["hot"]        = $results[0]['hot'];
			$loupanDetail["rec"]        = $results[0]['rec'];
			$loupanDetail["tuan"]       = $results[0]['tuan'];
			$loupanDetail["tuantitle"]  = $results[0]['tuantitle'];
			$loupanDetail["tuanbegan"]  = $results[0]['tuanbegan'];
			$loupanDetail["tuanend"]    = $results[0]['tuanend'];

			//团购状态
			$now = GetMkTime(time());
			$tuanState = 0;
			if($now < $results[0]['tuanbegan']){
				$tuanState = 1;
			}elseif($now > $results[0]['tuanend']){
				$tuanState = 3;
			}elseif($now > $results[0]['tuanbegan'] && $now < $results[0]['tuanend']){
				$tuanState = 2;
			}

			$loupanDetail['tuanState'] = $tuanState;

			//团购人数
			$tuanCount = 0;
			if($results[0]['tuan'] == 1){
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_loupantuan` WHERE `aid` = ".$id);
				$tuanCount = $dsql->dsqlOper($sql, "totalCount");
			}
			$loupanDetail['tuanCount'] = $tuanCount;

			//订阅人数
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_notice` WHERE `action` = 'loupan' AND `aid` = ".$id);
			$subscribe = $dsql->dsqlOper($sql, "totalCount");
			$loupanDetail["subscribe"] = $subscribe;

			$loupanDetail["userid"]     = $results[0]['userid'];
			$loupanDetail["investor"]   = $results[0]['investor'];

			$protype = explode(",", $results[0]['protype']);
			$protypeArr = array();
			foreach ($protype as $k => $v) {
				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
			}
			$loupanDetail['protype']    = join(",", $protypeArr);

			$loupanDetail["saleAddress"] = $results[0]['address'];
			$loupanDetail["tel"]        = $results[0]['tel'];
			$loupanDetail["worktime"]   = $results[0]['worktime'];
			$loupanDetail["note"]       = $results[0]['note'];
			$loupanDetail["buildtype"]  = $results[0]['buildtype'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['zhuangxiu']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
			$loupanDetail["zhuangxiu"]  = $zhuangxiu;

			$loupanDetail["buildage"]   = $results[0]['buildage'];
			$loupanDetail["planarea"]   = $results[0]['planarea'];
			$loupanDetail["buildarea"]  = $results[0]['buildarea'];
			$loupanDetail["planhouse"]  = $results[0]['planhouse'];
			$loupanDetail["linklocal"]  = $results[0]['linklocal'];
			$loupanDetail["parknum"]    = $results[0]['parknum'];
			$loupanDetail["rongji"]     = $results[0]['rongji'];
			$loupanDetail["green"]      = $results[0]['green'];
			$loupanDetail["floor"]      = $results[0]['floor'];
			$loupanDetail["property"]   = $results[0]['property'];
			$loupanDetail["proprice"]   = $results[0]['proprice'];

			$configArr = array();
			$config = $results[0]['config'];
			if(!empty($config)){
				$config = explode("|||", $config);
				foreach ($config as $key => $value) {
					$configArr[$key] = explode("###", $value);
				}
			}

			$loupanDetail["config"] = $configArr;
			$loupanDetail["pubdate"]   = $results[0]['pubdate'];

			$sql = $dsql->SetQuery("SELECT `litpic`, `data` FROM `#@__house_shapan` WHERE `loupan` = ".$id);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$loupanDetail["shapan"]["litpic"] = getFilePath($ret[0]['litpic']);
				$loupanDetail["shapan"]["data"] = unserialize($ret[0]['data']);
			}

			//验证是否已经收藏
			$params = array(
				"module" => "house",
				"temp"   => "loupan_detail",
				"type"   => "add",
				"id"     => $id,
				"check"  => 1
			);
			$collect = checkIsCollect($params);
			$loupanDetail['collect'] = $collect == "has" ? 1 : 0;
		}
		return $loupanDetail;
	}


	/**
     * 楼盘房源列表
     * @return array
     */
	public function listingList(){
		global $dsql;
		$pageinfo = $list = array();
		$loupanid = $addrid = $price = $room = $title = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$loupanid = $this->param['loupanid'];
				$addrid   = $this->param['addrid'];
				$price    = $this->param['price'];
				$room     = $this->param['room'];
				$title    = $this->param['title'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		//楼盘
		if($loupanid != ""){
			$where .= " AND `loupan` = " . $loupanid;
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}

			//查询楼盘信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_loupan` WHERE `state` = 1 AND `addrid` in ($lower)");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $loupan){
					$ids[] = $loupan["id"];
				}
				//有结果
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " AND `loupan` in ($ids)";
				//无结果
				}else{
					$where .= " AND 1 = 2";
				}
			//无结果
			}else{
				$where .= " AND 1 = 2";
			}
		}

		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND `price` < " . $price[1];
			}elseif(empty($price[1])){
				$where .= " AND `price` > " . $price[0];
			}else{
				$where .= " AND `price` BETWEEN " . $price[0] . " AND " . $price[1];
			}
		}

		//房型
		if($room != ""){
			if($room == 0){
				$where .= " AND `room` > 5";
			}else{
				$where .= " AND `room` = " . $room;
			}
		}

		//关键字
		if(!empty($title)){
			$where .= " AND `title` like '%".$title."%'";

			//查询楼盘信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_loupan` WHERE `state` = 1 AND (`title` like '%".$title."%' OR `addr` like '%".$title."%' OR `buildtype` like '%".$title."%')");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $loupan){
					$ids[] = $loupan["id"];
				}
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " AND `loupan` in ($ids)";
				}
			}
		}

		if(!empty($orderby)){
			//价格升序
			if($orderby == 1){
				$orderby = " ORDER BY `price` ASC, `weight` DESC, `id` DESC";
			//价格降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY `price` DESC, `weight` DESC, `id` DESC";
			//发布时间降序
			}elseif($orderby == 3){
				$orderby = " ORDER BY `pubdate` DESC, `weight` DESC, `id` DESC";
			//发布时间升序
			}elseif($orderby == 4){
				$orderby = " ORDER BY `pubdate` ASC, `weight` DESC, `id` DESC";
			}
		}else{
			$orderby = " ORDER BY `weight` DESC, `id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `loupan`, `title`, `litpic`, `price`, `room`, `hall`, `guard`, `area` " .
									"FROM `#@__house_listing` " .
									"WHERE " .
									"`state` = 1".$where . $orderby);

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
				$list[$key]['id']     = $val['id'];

				$archives = $dsql->SetQuery("SELECT `title`, `addrid`, `addr` FROM `#@__house_loupan` WHERE `id` = ".$val['loupan']);
				$loupan = $dsql->dsqlOper($archives, "results");
				if($loupan){
					$list[$key]['loupan']  = $loupan[0]['title'];
					$addrName = getParentArr("houseaddr", $loupan[0]['addrid']);
					global $data;
					$data = "";
					$addrName = array_reverse(parent_foreach($addrName, "typename"));
					$list[$key]['addr']    = join(" > ", $addrName);
					$list[$key]['address'] = $loupan[0]['addr'];
				}else{
					$list[$key]['loupan']  = "";
					$list[$key]['addr']    = "";
					$list[$key]['address'] = "";
				}

				$list[$key]['title']  = $val['title'];
				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['price']  = $val['price'];
				$list[$key]['room']   = $val['room']."室".$val['hall']."厅".$val['guard']."卫";
				$list[$key]['area']   = $val['area'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 楼盘房源详细
     * @return array
     */
	public function listingDetail(){
		global $dsql;
		$listingDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_listing` WHERE `state` = 1 AND `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$listingDetail["loupan"]  = $results[0]['loupan'];
			$listingDetail["title"]   = $results[0]['title'];
			$listingDetail["litpic"]  = getFilePath($results[0]['litpic']);
			$listingDetail["price"]   = $results[0]['price'];
			$listingDetail["room"]    = $results[0]['room'] ."室". $results[0]['hall'] ."厅". $results[0]['guard'] ."卫";
			$listingDetail["area"]    = $results[0]['area'];
			$listingDetail["bno"]     = $results[0]['bno'];
			$listingDetail["floor"]   = $results[0]['floor'];
			$listingDetail["userid"]  = $results[0]['userid'];
			$listingDetail["salable"] = $results[0]['salable'];
			$listingDetail["launch"]  = $results[0]['launch'];

			$flist = array();
			$flistArr = $results[0]['flist'];
			if(!empty($flistArr)){
				$flistArr = explode("|", $flistArr);
				$flist[] = $flistArr;
			}

			$listingDetail["flist"]   = $flist;
			$listingDetail["note"]    = $results[0]['note'];

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'listing' AND `aid` = ".$id." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $key => $value){
					$imglist[$key]["path"] = getFilePath($value["picPath"]);
					$imglist[$key]["info"] = $value["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$listingDetail["imglist"]     = $imglist;
		}
		return $listingDetail;
	}


	/**
     * 楼盘资讯列表
     * @return array
     */
	public function loupanNewsList(){
		global $dsql;
		$pageinfo = $list = array();
		$loupanid = $page = $pageSize = $where = $orderby = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$loupanid = $this->param['loupanid'];
				$rand     = $this->param['rand'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$where = " 1 = 1";
		if(!empty($loupanid)){
			$where = " `loupan` = " . $loupanid;
		}

		$orderby = ' ORDER BY `weight` DESC, `id` DESC';
		if(!empty($rand)){
			$orderby = ' ORDER BY rand()';
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//查表
		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `loupan`, `title`, `click`, `body`, `pubdate` " .
									"FROM `#@__house_loupannews` " .
									"WHERE " . $where . $orderby);

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

				$sql = $dsql->SetQuery("SELECT `title` FROM `#@__house_loupan` WHERE `id` = ".$val['loupan']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$list[$key]['loupan'] = $ret[0]['title'];
				}else{
					$list[$key]['loupan'] = "";
				}

				$list[$key]['title']    = $val['title'];
				$list[$key]['click']    = $val['click'];
				$list[$key]['pubdate']  = $val['pubdate'];

				$list[$key]['note']     = substr(strip_tags($val['body']), 0, 250);

				$param = array(
					"service"     => "house",
					"template"    => "loupan-news-detail",
					"id"          => $val['loupan'],
					"aid"         => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 楼盘资讯详细
     * @return array
     */
	public function loupanNewsDetail(){
		global $dsql;
		$listingDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_loupannews` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}
	}


	/**
     * 中介公司模糊匹配
     * @return array
     */
	public function zjCom(){
		global $dsql;
		$title = $this->param['title'];

		if(!empty($title)){
			$commSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__house_zjcom` WHERE `title` like '%$title%' AND `state` = 1 LIMIT 0, 10");
			$commResult = $dsql->dsqlOper($commSql, "results");
			if($commResult){
				return $commResult;
			}
		}
	}


	/**
     * 中介公司列表
     * @return array
     */
	public function zjComList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$state     = $this->param['state'];
				$keywords  = $this->param['keywords'];
				$orderby   = $this->param['orderby'];
				$page      = $this->param['page'];
				$pageSize  = $this->param['pageSize'];
			}
		}
		$state    = $state == "" ? 1 : $state;

		$orderby = $where = "";

		// 状态
		if($state != ""){
			$where .= " AND z.`state` = $state";
		}

		// 关键字
		if(!empty($keywords)){
			$where .= " AND (z.`title` like '%".$keywords."%')";
		}


		if(!empty($orderby)){
			//
			if($orderby == 1){

			}
		}else{
			$orderby = " ORDER BY z.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"z.`id`, z.`title`, z.`litpic`, z.`userid`, z.`tel`, z.`address`, z.`email`, z.`note`, z.`click`, z.`flag`, z.`pubdate`" .
									"FROM `#@__house_zjcom` z " .
									"WHERE 1 = 1" . $where);

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
		$where = $pageSize != -1 ? " LIMIT $atpage, $pageSize" : "";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']      = $val['id'];
				$list[$key]['title']   = $val['title'];
				$list[$key]['litpic']  = !empty($val['litpic']) ? getFilePath($val['litpic']) : "";
				$list[$key]['userid']  = $val['userid'];
				$list[$key]['tel']     = $val['tel'];
				$list[$key]['address'] = $val['address'];
				$list[$key]['email']   = $val['email'];
				$list[$key]['note']    = $val['note'];
				$list[$key]['click']   = $val['click'];
				$list[$key]['flag']    = $val['flag'];
				$list[$key]['pubdate'] = $val['pubdate'];

				// 查询 公司下二手房数目
				$arcSale = $dsql->SetQuery("SELECT count(s.`id`) AS countSale FROM `#@__house_sale` s WHERE `userid` in(SELECT z.`id` FROM `#@__house_zjuser` z WHERE z.`zjcom` = ".$val['id'].") ");
				$retSale = $dsql->dsqlOper($arcSale, "results");
				if($retSale){
					$list[$key]['countSale'] = $retSale[0]['countSale'];
				}else{
					$list[$key]['countSale'] = 0;
				}

				// 查询 公司下出租房数目
				$arcZu = $dsql->SetQuery("SELECT count(z.`id`) AS countZu FROM `#@__house_zu` z WHERE `userid` in(SELECT z.`id` FROM `#@__house_zjuser` z WHERE z.`zjcom` = ".$val['id'].") ");
				$retZu = $dsql->dsqlOper($arcZu, "results");
				if($retZu){
					$list[$key]['countZu'] = $retZu[0]['countZu'];
				}else{
					$list[$key]['countZu'] = 0;
				}
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);

	}



	/**
     * 中介公司详细信息
     * @return array
     */
	public function zjComDetail(){
		global $dsql;
		global $userLogin;
		$listingDetail = array();
		$id = $this->param;
		$uid = $userLogin->getMemberID();

		if(!is_numeric($id) && $uid == -1){
			return array("state" => 200, "info" => '格式错误！');
		}

		$where = " AND `state` = 1";
		if(!is_numeric($id)){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){
				$id = $results[0]['id'];
				$where = "";
			}else{
				return array("state" => 200, "info" => '该会员暂未开通商铺！');
			}
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_zjcom` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results[0]["litpicSource"] = $results[0]["litpic"];
			$results[0]["litpic"] = getFilePath($results[0]["litpic"]);

			$this->param = "";
			$channelDomain = $this->config();
			$domainInfo = getDomain('house', 'house_zjcom', $id);

			/**
			 * 默认 || 模块配置为子目录并且信息配置为绑定子域名则访问方式转为默认
			 * （因为子域名是随模块配置变化，如果模块配置为子目录地址为乱掉。）
			 * 如：模块配置：http://menhu168.com/house
			 * 如果信息绑定子域名则会变成：http://demo.menhu168.com/house
			 * 这样会导致系统读取信息错误
			 */
			if($results[0]["domaintype"] == 0 || ($channelDomain['subDomain'] == 2 && $results[0]["domaintype"] == 2)){

				$results[0]["domain"] = $channelDomain['channelDomain']."/zjCom-".$id.".html";

			//绑定主域名
			}elseif($results[0]["domaintype"] == 1){

				$results[0]["domain"] = $domainInfo['domain'];
				$results[0]["domainexp"] = date("Y-m-d H:i:s", $domainInfo['expires']);
				$results[0]["domaintip"] = $domainInfo['note'];

			//绑定子域名
			}elseif($results[0]["domaintype"] == 2){

				$results[0]["domain"] = str_replace("http://", "http://".$domainInfo['domain'].".", $channelDomain['channelDomain']);
				$results[0]["domainexp"] = date("Y-m-d H:i:s", $domainInfo['expires']);
				$results[0]["domaintip"] = $domainInfo['note'];

			}

			return $results[0];
		}
	}


	/**
		* 配置中介公司
		* @return array
		*/
	public function storeConfig(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;
		$title   = filterSensitiveWords(addslashes($param['title']));
		$litpic  = $param['litpic'];
		$tel     = filterSensitiveWords(addslashes($param['tel']));
		$address = filterSensitiveWords(addslashes($param['address']));
		$email   = filterSensitiveWords(addslashes($param['email']));
		$note    = filterSensitiveWords(addslashes($param['note']));
		$vdimgck = $param['vdimgck'];
		$pubdate = GetMkTime(time());

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//验证会员类型
		$userDetail = $userLogin->getMemberInfo();
		if($userDetail['userType'] != 2){
			return array("state" => 200, "info" => '账号验证错误，操作失败！');
		}

		if(empty($title)){
			return array("state" => 200, "info" => '请输入公司名称');
		}

		if(empty($litpic)){
			return array("state" => 200, "info" => '请上传公司LOGO');
		}

		if(empty($tel)){
			return array("state" => 200, "info" => '请输入联系电话');
		}

		if(empty($address)){
			return array("state" => 200, "info" => '请输入联系地址');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");

		//新商铺
		if(!$userResult){

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__house_zjcom` (`userid`, `title`, `litpic`, `tel`, `address`, `email`, `note`, `weight`, `state`, `pubdate`) VALUES ('$userid', '$title', '$litpic', '$tel', '$address', '$email', '$note', 1, 0, '$pubdate')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("house", "store");

				return "配置成功，您的公司正在审核中，请耐心等待！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		//更新商铺信息
		}else{

			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__house_zjcom` SET `title` = '$title', `litpic` = '$litpic', `tel` = '$tel', `address` = '$address', `email` = '$email', `note` = '$note', `state` = 0 WHERE `userid` = ".$userid);
			$results = $dsql->dsqlOper($archives, "update");

			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("house", "store");

				return "保存成功！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		}

	}


	/**
		* 开通中介经纪人
		* @return array
		*/
	public function configZjUser(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;
		$company = $param['company'];
		$zjcom   = (int)$param['zjcom'];
		$store   = filterSensitiveWords(addslashes($param['store']));
		$addr    = (int)$param['addr'];
		$community = $param['community'];
		$litpic  = $param['litpic'];
		$note    = filterSensitiveWords(addslashes($param['note']));
		$pubdate = GetMkTime(time());

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if($zjcom == 0 && trim($company) == ''){
			return array("state" => 200, "info" => '请选择所属公司！');
			exit();
		}
		if($zjcom == 0){
			$comSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `title` = '".$zjcom."'");
			$comResult = $dsql->dsqlOper($comSql, "results");
			if(!$comResult){
				return array("state" => 200, "info" => '中介公司不存在，请在联想列表中选择，或者新增中介公司！');
				exit();
			}
			$zjcom = $comResult[0]['id'];
		}else{
			$comSql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `id` = ".$comid);
			$comResult = $dsql->dsqlOper($comSql, "results");
			if(!$comResult){
				return array("state" => 200, "info" => '中介公司不存在，请在联想列表中选择，或者新增中介公司！');
				exit();
			}
		}

		if(empty($store)){
			return array("state" => 200, "info" => '请输入所在门店！');
			exit();
		}

		if(empty($addr)){
			return array("state" => 200, "info" => '请选择服务区域！');
		}

		// if(empty($litpic)){
		// 	return array("state" => 200, "info" => '请上传名片！');
		// }

		$userSql = $dsql->SetQuery("SELECT `id`, `litpic` FROM `#@__house_zjuser` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");

		//新中介
		if(!$userResult){

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__house_zjuser` (`userid`, `zjcom`, `store`, `addr`, `community`, `litpic`, `note`, `state`, `flag`, `weight`, `pubdate`) VALUES ('$userid', '$zjcom', '$store', '$addr', '$community', '$litpic', '$note', 0, 0, 1, '$pubdate')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if(is_numeric($aid)){

				//更新当前会员下已经发布的房源信息性质
				$sql = $dsql->SetQuery("UPDATE `#@__house_sale` SET `usertype` = 1 WHERE `userid` = $aid");
				$dsql->dsqlOper($sql, "update");
				$sql = $dsql->SetQuery("UPDATE `#@__house_zu` SET `usertype` = 1 WHERE `userid` = $aid");
				$dsql->dsqlOper($sql, "update");
				$sql = $dsql->SetQuery("UPDATE `#@__house_xzl` SET `usertype` = 1 WHERE `userid` = $aid");
				$dsql->dsqlOper($sql, "update");
				$sql = $dsql->SetQuery("UPDATE `#@__house_sp` SET `usertype` = 1 WHERE `userid` = $aid");
				$dsql->dsqlOper($sql, "update");
				$sql = $dsql->SetQuery("UPDATE `#@__house_cf` SET `usertype` = 1 WHERE `userid` = $aid");
				$dsql->dsqlOper($sql, "update");

				return "提交成功，请联系您的公司为您审核开通！";
			}else{
				return array("state" => 200, "info" => '提交失败，请稍候重试！');
			}

		//更新中介信息
		}else{

			$RenrenCrypt = new RenrenCrypt();
			$opic = $RenrenCrypt->php_decrypt(base64_decode($userResult[0]['litpic']));
			$npic = $RenrenCrypt->php_decrypt(base64_decode($litpic));

			$flag = ", `flag` = 0, `litpic` = '$litpic'";
			if($opic == $npic){
				$flag = "";
			}

			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__house_zjuser` SET `store` = '$store', `addr` = '$addr', `community` = '$community', `note` = '$note', `state` = 0".$flag." WHERE `userid` = ".$userid);
			$results = $dsql->dsqlOper($archives, "update");

			if($results == "ok"){
				return "提交成功，请联系您的公司为您审核开通！";
			}else{
				return array("state" => 200, "info" => '提交失败，请稍候重试！');
			}

		}

	}


	/**
		* 更新中介经纪人审核状态
		* @return array
		*/
	public function updateBrokerState(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$param  = $this->param;
		$id     = (int)$param['id'];
		$state  = (int)$param['state'];

		if(empty($id)) return array("state" => 200, "info" => '格式错误！');
		if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjcom` WHERE `userid` = $userid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$cid = $ret[0]['id'];
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `id` = $id AND `zjcom` = $cid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$flag = "";
				if($state == 1){
					$flag = ", `flag` = 1";
				}
				$sql = $dsql->SetQuery("UPDATE `#@__house_zjuser` SET `state` = $state".$flag." WHERE `id` = $id");
				$ret = $dsql->dsqlOper($sql, "update");
				if($ret == "ok"){
					return "更新成功！";
				}else{
					return array("state" => 200, "info" => '数据更新失败！');
				}

			}else{
				 return array("state" => 200, "info" => '权限验证失败！');
			}

		}else{
			 return array("state" => 200, "info" => '帐号类型验证失败！');
		}
	}


	/**
     * 房产经纪人
     * @return array
     */
	public function zjUserList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$comid = $userid = $u = $addrid = $state = $orderby = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$comid    = $this->param['comid'];
				$userid   = $this->param['userid'];
				$u        = $this->param['u'];
				$addrid   = $this->param['addrid'];
				$state    = $this->param['state'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(!$u){
			$where .= " AND `state` = 1";
		}

		if(!empty($comid)){
			$where .= " AND `zjcom` = " . $comid;

			if($state != ""){
				$where1 = " AND `state` = ".$state;
			}
		}

		if($u && empty($comid) && empty($userid)){
			return array("state" => 200, "info" => '暂无数据！');
		}

		if(!empty($userid)){
			$where .= " AND `id` = " . $userid;
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addr` in ($lower)";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//查表
		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_zjuser` WHERE 1 = 1" . $where);

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

		//中介公司纪纪人列表需要统计信息状态
		if(!empty($comid) && $userLogin->getMemberID() > -1){
			//待审核
			$state0 = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
			//已审核
			$state1 = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
			//拒绝审核
			$state2 = $dsql->dsqlOper($archives." AND `state` = 2", "totalCount");

			$pageinfo['state0'] = $state0;
			$pageinfo['state1'] = $state1;
			$pageinfo['state2'] = $state2;
		}

		$atpage = $pageSize*($page-1);

		//如果是按照房源数量排序，则不进行分页
		if($orderby != "level"){
			$where = " LIMIT $atpage, $pageSize";
		}else{
			$where = "";
		}

		$results = $dsql->dsqlOper($archives.$where1 ." ORDER BY `weight` DESC, `id` DESC".$where, "results");
		if($results){
			foreach ($results as $key => $value) {
				$list[$key]['id']     = $value['id'];
				$list[$key]['userid'] = $value['userid'];
				$list[$key]['zjcom']  = $value['zjcom'];
				$list[$key]['store']  = $value['store'];

				$addrid = $value['addr'];
				$areaid = 0;

				//父级区域
				$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$addrid);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$areaid = $ret[0]['parentid'];
				}

				$list[$key]["areaid"]     = $areaid;
				$list[$key]["addrid"]     = $addrid;

				$list[$key]['litpicSource'] = $value['litpic'];
				$list[$key]['litpic'] = getFilePath($value['litpic']);
				$list[$key]['note']   = $value['note'];
				$list[$key]['click']  = $value['click'];
				$list[$key]['flag']   = $value['flag'];
				$list[$key]['pubdate'] = $value['pubdate'];

				if($u){
					$list[$key]['state']   = $value['state'];
				}

				$archives = $dsql->SetQuery("SELECT `nickname`, `phone`, `photo`, `certifyState` FROM `#@__member` WHERE `id` = ".$value['userid']);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$list[$key]['nickname'] = $member[0]['nickname'];
					$list[$key]['phone']    = $member[0]['phone'];
					$list[$key]['photo']    = getFilePath($member[0]['photo']);
					$list[$key]['certify']  = $member[0]['certifyState'];
				}else{
					$list[$key]['nickname'] = "";
					$list[$key]['phone']    = "";
					$list[$key]['photo']    = "";
					$list[$key]['certify']  = 0;
				}

				$archives = $dsql->SetQuery("SELECT `title` FROM `#@__house_zjcom` WHERE `id` = ".$value['zjcom']);
				$zjComRet = $dsql->dsqlOper($archives, "results");
				if($zjComRet){
					$list[$key]['zjcomName'] = $zjComRet[0]['title'];
				}else{
					$list[$key]['zjcomName']  = "";
				}

				$addrName = getParentArr("houseaddr", $value['addr']);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['address'] = $addrName;

				$param = array(
					"service"     => "house",
					"template"    => "broker-detail",
					"id"          => $value['id']
				);
				$list[$key]['url'] = getUrlPath($param);

				//主营小区
				$community = $value["community"];
				$list[$key]['community'] = $community;
				$communitySelected = array();
				if(!empty($community)){
					$community = explode(",", $community);
					foreach($community as $val){
						if(is_numeric($val)){
							$archives = $dsql->SetQuery("SELECT `title` FROM `#@__house_community` WHERE `id` = $val");
							$typeResults = $dsql->dsqlOper($archives, "results");
							$name = $typeResults ? $typeResults[0]['title'] : "";
							array_push($communitySelected, $name);
						}else{
							array_push($communitySelected, $val);
						}
					}
					$list[$key]["communityArr"] = $community;
					$list[$key]["communityName"] = $communitySelected;
				}

				$num = 0;

				//二手房
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_sale` WHERE `state` = 1 AND `usertype` = 1 AND `userid` = ".$value['id']);
				$sale = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['saleCount'] = $sale;
				$num += $sale;

				//租房
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_zu` WHERE `state` = 1 AND `usertype` = 1 AND `userid` = ".$value['id']);
				$zu = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['zuCount'] = $zu;
				$num += $zu;

				//写字楼
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_xzl` WHERE `state` = 1 AND `usertype` = 1 AND `userid` = ".$value['id']);
				$xzl = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['xzlCount'] = $xzl;
				$num += $xzl;

				//商铺
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_sp` WHERE `state` = 1 AND `usertype` = 1 AND `userid` = ".$value['id']);
				$sp = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['spCount'] = $sp;
				$num += $sp;

				//厂房
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_cf` WHERE `state` = 1 AND `usertype` = 1 AND `userid` = ".$value['id']);
				$cf = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['cfCount'] = $cf;
				$num += $cf;

				//判断级别
				$levelArr = array();
				$archives = $dsql->SetQuery("SELECT `typename`, `icon` FROM `#@__house_zjusergroup` WHERE `num` < $num ORDER BY `num` DESC");
				$group = $dsql->dsqlOper($archives, "results");
				if($group){
					$levelArr["name"]  = $group[0]['typename'];
					$levelArr["icon"]  = $group[0]['icon'];
				}

				$list[$key]['level']    = $levelArr;
				$list[$key]['total']    = $num;
			}

		}

		//按房源总数排序
		if($orderby == "level"){
			$list = array_sortby($list, "total", SORT_DESC);
			$list = array_slice($list, 0, $pageSize);
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 小区列表
     * @return array
     */
	public function communityList(){
		global $dsql;
		$pageinfo = $list = array();
		$typeid = $addrid = $subway = $station = $price = $title = $tags = $nid = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$addrid   = $this->param['addrid'];
				$subway   = $this->param['subway'];
				$station  = $this->param['station'];
				$price    = $this->param['price'];
				$title    = $this->param['keywords'];
				$tags     = $this->param['tags'];
				$orderby  = $this->param['orderby'];
				$nid      = $this->param['nid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		//类型
		if(!empty($typeid)){
			$where .= " AND FIND_IN_SET(".$typeid.", `protype`)";
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addrid` in ($lower)";
		}


		//地铁
		//如果站点不为空则直接进行验证
		if(!empty($station)){

			$where .= " AND FIND_IN_SET ($station, `subway`)";

		//如果站点为空，线路不为空，则先查询出线路的站点再验证
		}elseif(!empty($subway)){

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_subway_station` WHERE `sid` = $subway ORDER BY `weight`");
			$res = $dsql->dsqlOper($sql, "results");
			if($res){
				$subway = array();
				foreach ($res as $key => $value) {
					$subway[] = "FIND_IN_SET (".$value['id'].", `subway`)";
				}

				$where .= " AND (".join(" OR ", $subway).")";
			}

		}


		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND `price` < " . $price[1] * 1000;
			}elseif(empty($price[1])){
				$where .= " AND `price` > " . $price[0] * 1000;
			}else{
				$where .= " AND `price` BETWEEN " . $price[0] * 1000 . " AND " . $price[1] * 1000;
			}
		}

		//关键字
		if(!empty($title)){
			$where .= " AND (`title` like '%".$title."%' OR `addr` like '%".$title."%')";
		}

		//标签
		if(!empty($tags)){
			$where .= " AND FIND_IN_SET(".$tags.", `tags`)";
		}

		//屏蔽ID
		if(!empty($nid)){
			$where .= " AND `id` NOT IN ($nid)";
		}


		if(!empty($orderby)){
			//价格升序
			if($orderby == 1){
				$orderby = " ORDER BY `price` ASC, `weight` DESC, `id` DESC";
			//价格降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY `price` DESC, `weight` DESC, `id` DESC";
			//竣工时间降序
			}elseif($orderby == 3){
				$orderby = " ORDER BY `opendate` DESC, `weight` DESC, `id` DESC";
			//竣工时间升序
			}elseif($orderby == 4){
				$orderby = " ORDER BY `opendate` ASC, `weight` DESC, `id` DESC";
			}
		}else{
			$orderby = " ORDER BY `weight` DESC, `id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `title`, `addrid`, `addr`, `litpic`, `price`, `opendate`, `protype` " .
									"FROM `#@__house_community` " .
									"WHERE " .
									"`state` = 1".$where . $orderby);

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
				$list[$key]['id']         = $val['id'];
				$list[$key]['title']      = $val['title'];
				$list[$key]['addrid']     = $val['addrid'];

				$addrName = getParentArr("houseaddr", $val['addrid']);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['addr']   = $addrName;

				$list[$key]['address']    = $val['addr'];
				$list[$key]['litpic']     = getFilePath($val['litpic']);
				$list[$key]['price']      = $val['price'];
				$list[$key]['opendate']   = $val['opendate'];

				$protypeArr = array();
				if($val['protype']){
					$protype = explode(",", $val['protype']);
					foreach ($protype as $k => $v) {
						$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
						$houseResult = $dsql->dsqlOper($houseitem, "results");
						$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
					}
				}

				$list[$key]['protype']    = join(",", $protypeArr);

				//二手房数量
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_sale` WHERE `state` = 1 AND `communityid` = ".$val['id']);
				$saleCount = $dsql->dsqlOper($sql, "totalCount");
				$list[$key]['saleCount'] = $saleCount;

				//出租房数量
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zu` WHERE `state` = 1 AND `communityid` = ".$val['id']);
				$zuCount = $dsql->dsqlOper($sql, "totalCount");
				$list[$key]['zuCount'] = $zuCount;

				$param = array(
					"service"     => "house",
					"template"    => "community-detail",
					"id"          => $val['id']
				);
				$list[$key]['url']        = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 小区详细
     * @return array
     */
	public function communityDetail(){
		global $dsql;
		$communityDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_community` WHERE `state` = 1 AND `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$communityDetail["id"]        = $results[0]['id'];
			$communityDetail["title"]     = $results[0]['title'];

			$addrid = $results[0]['addrid'];
			$areaid = 0;

			//父级区域
			$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$addrid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$areaid = $ret[0]['parentid'];
			}

			$communityDetail["areaid"]     = $areaid;
			$communityDetail["addrid"]     = $addrid;

			$addrName = getParentArr("houseaddr", $results[0]['addrid']);
			global $data;
			$data = "";
			$addrName = array_reverse(parent_foreach($addrName, "typename"));
			$communityDetail['addr']      = $addrName;

			$communityDetail["address"]   = $results[0]['addr'];
			$communityDetail["longitude"] = $results[0]['longitude'];
			$communityDetail["latitude"]  = $results[0]['latitude'];
			$communityDetail["litpic"]    = getFilePath($results[0]['litpic']);

			$protype = explode(",", $results[0]['protype']);
			$protypeArr = array();
			foreach ($protype as $k => $v) {
				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
			}
			$communityDetail['protype']    = join(",", $protypeArr);

			$communityDetail["property"]  = $results[0]['property'];
			$communityDetail["proprice"]  = $results[0]['proprice'];
			$communityDetail["protel"]    = $results[0]['protel'];
			$communityDetail["proaddr"]   = $results[0]['proaddr'];
			$communityDetail["opendate"]  = $results[0]['opendate'];
			$communityDetail["kfs"]       = $results[0]['kfs'];
			$communityDetail["price"]     = $results[0]['price'];
			$communityDetail["userid"]    = $results[0]['userid'];
			$communityDetail["note"]      = $results[0]['note'];
			$communityDetail["planhouse"] = $results[0]['planhouse'];
			$communityDetail["parknum"]   = $results[0]['parknum'];
			$communityDetail["rongji"]    = $results[0]['rongji'];
			$communityDetail["buildarea"] = $results[0]['buildarea'];
			$communityDetail["planarea"]  = $results[0]['planarea'];
			$communityDetail["buildage"]  = $results[0]['buildage'];
			$communityDetail["post"]      = $results[0]['post'];
			$communityDetail["green"]     = $results[0]['green'];

			$configArr = array();
			$config = $results[0]['config'];
			if(!empty($config)){
				$config = explode("|||", $config);
				foreach ($config as $key => $value) {
					$configArr[$key] = explode("###", $value);
				}
			}
			$communityDetail["config"] = $configArr;
		}
		return $communityDetail;
	}


	/**
     * 房产户型列表
     * @return array
     */
	public function apartmentList(){
		global $dsql;
		$pageinfo = $roomgroup = $list = array();
		$action = $loupanid = $room = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$action   = $this->param['act'];
				$loupanid = $this->param['loupanid'];
				$room     = $this->param['room'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($action)) return array("state" => 200, "info" => '类型不得为空！');
		if(empty($loupanid)) return array("state" => 200, "info" => '楼盘ID不得为空！');

		//楼盘
		$where = " `action` = '$action' AND `loupan` = " . $loupanid;

		//户型
		if(!empty($room)){
			$where .= " AND `room` = " . $room;
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//统计数据
		$archives = $dsql->SetQuery("SELECT DISTINCT `room`, COUNT(`id`) AS num FROM `#@__house_apartment` WHERE `action` = '$action' AND `loupan` = ".$loupanid." GROUP BY `room` having count(`id`) > 0");
		$roomgroup = $dsql->dsqlOper($archives, "results");

		//查表
		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `action`, `loupan`, `title`, `room`, `hall`, `guard`, `litpic`, `area`, `direction`, `note` " .
									"FROM `#@__house_apartment` " .
									"WHERE " . $where .
									" ORDER BY `weight` DESC, `id` DESC");

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
				$list[$key]['id']        = $val['id'];
				$list[$key]['action']    = $val['action'];
				$list[$key]['loupan']    = $val['loupan'];
				$list[$key]['title']     = $val['title'];
				$list[$key]['room']      = $val['room'];
				$list[$key]['hall']      = $val['hall'];
				$list[$key]['guard']      = $val['guard'];

				$param = array("url" => getFilePath($val['litpic']), "type" => "small");
				$list[$key]['litpic']    = changeFileSize($param);
				$list[$key]['area']      = $val['area'];
				$list[$key]['note']      = $val['note'];

				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['direction']);
				$res = $dsql->dsqlOper($sql, "results");
				if($res){
					$list[$key]['direction'] = $res[0]['typename'];
				}else{
					$list[$key]['direction'] = "";
				}

				$param = array(
					"service"     => "house",
					"template"    => $val['action']."-hx-detail",
					"id"          => $val['loupan'],
					"aid"         => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);

			}
		}

		return array("pageInfo" => $pageinfo, "roomGroup" => $roomgroup, "list" => $list);
	}


	/**
     * 房产户型详细
     * @return array
     */
	public function apartmentDetail(){
		global $dsql;
		$apartmentDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_apartment` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$apartmentDetail["action"]    = $results[0]['action'];
			$apartmentDetail["loupan"]    = $results[0]['loupan'];
			$apartmentDetail["title"]     = $results[0]['title'];
			$apartmentDetail["room"]      = $results[0]['room'];
			$apartmentDetail["hall"]      = $results[0]['hall'];
			$apartmentDetail["guard"]      = $results[0]['guard'];
			$apartmentDetail["litpic"]    = getFilePath($results[0]['litpic']);
			$apartmentDetail["area"]      = $results[0]['area'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['direction']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$direction = $houseResult ? $houseResult[0]['typename'] : "";
			$apartmentDetail["direction"] = $direction;

			$apartmentDetail["high"]      = $results[0]['high'];
			$apartmentDetail["note"]      = $results[0]['note'];

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'apartment".$results[0]['action']."' AND `aid` = ".$id." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $key => $value){
					$imglist[$key]["path"] = getFilePath($value["picPath"]);
					$imglist[$key]["info"] = $value["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$apartmentDetail["imglist"]     = $imglist;
		}
		return $apartmentDetail;
	}


	/**
     * 房产相册列表
     * @return array
     */
	public function albumList(){
		global $dsql;
		$pageinfo = $albumgroup = $list = array();
		$act = $loupanid = $room = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$act      = $this->param['act'];
				$loupanid = $this->param['loupanid'];
				$id       = $this->param['id'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($act)) return array("state" => 200, "info" => '类型不得为空！');
		if(empty($loupanid)) return array("state" => 200, "info" => '楼盘ID不得为空！');

		$where = " `action` = '$act' AND `loupan` = " . $loupanid;

		//统计图片数量
		// $archives = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__house_album` WHERE ".$where." ORDER BY `weight` DESC, `id` DESC");
		// $results = $dsql->dsqlOper($archives, "results");
		// if($results){
		// 	foreach ($results as $key=>$value) {
		// 		$albumgroup[$key]["id"] = $value["id"];
		// 		$albumgroup[$key]["title"] = $value["title"];
		// 		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'album".$action."' AND `aid` = ".$value["id"]);
		// 		$results = $dsql->dsqlOper($archives, "totalCount");
		// 		$albumgroup[$key]["count"] = $results;
		// 	}
		// }

		//户型
		if(!empty($id)){
			$where .= " AND `id` = " . $id;
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//查表
		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `action`, `loupan`, `title` " .
									"FROM `#@__house_album` " .
									"WHERE " . $where .
									" ORDER BY `weight` DESC, `id` DESC");

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
				$list[$key]['action']   = $val['action'];
				$list[$key]['loupan']   = $val['loupan'];
				$list[$key]['title']    = $val['title'];

				//图表信息
				$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'album".$val['action']."' AND `aid` = ".$val['id']." ORDER BY `id` ASC");
				$results = $dsql->dsqlOper($archives, "results");

				if(!empty($results)){
					$imglist = array();
					foreach($results as $k => $v){
						$imglist[$k]["path"] = getFilePath($v["picPath"]);
						$imglist[$k]["info"] = $v["picInfo"];
					}
				}else{
					$imglist = array();
				}

				$list[$key]["imglist"] = $imglist;

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 房产全景列表
     * @return array
     */
	public function loupanQjList(){
		global $dsql;
		$pageinfo = $roomgroup = $list = array();
		$loupanid = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$loupanid = $this->param['loupanid'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($loupanid)) return array("state" => 200, "info" => '楼盘ID不得为空！');

		//楼盘
		$where = " `loupan` = " . $loupanid;

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//查表
		$archives = $dsql->SetQuery("SELECT " .
									"`id`, `loupan`, `title`, `litpic` " .
									"FROM `#@__house_360qj` " .
									"WHERE " . $where .
									" ORDER BY `id` DESC");

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
				$list[$key]['id']        = $val['id'];
				$list[$key]['loupan']    = $val['loupan'];
				$list[$key]['title']     = $val['title'];
				$list[$key]['litpic']    = getFilePath($val['litpic']);

				$param = array(
					"service"     => "house",
					"template"    => "loupan-qj-detail",
					"id"          => $val['loupan'],
					"aid"         => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 房产户型详细
     * @return array
     */
	public function loupanQjDetail(){
		global $dsql;
		$qj = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_360qj` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$qj["loupan"] = $results[0]['loupan'];
			$qj["title"]  = $results[0]['title'];
			$qj["litpic"] = getFilePath($results[0]['litpic']);
			$qj["typeid"] = $results[0]['typeid'];
			if($results[0]['typeid'] == 1){
				$qj["file"]   = getFilePath($results[0]['file']);
			}else{
				$qj["file"]   = $results[0]['file'];
			}
			$qj["click"]  = $results[0]['click'];
			$qj["pubdate"]  = $results[0]['pubdate'];
		}
		return $qj;
	}


	/**
     * 楼盘团购
     * @return array
     */
	public function tuan(){
		global $dsql;
		$pageinfo = $list = array();
		$aid = $page = $pageSize = $where = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$aid      = $this->param['aid'];
			$page     = $this->param['page'];
			$pageSize = $this->param['pageSize'];
		}

		if(empty($aid)) return array("state" => 200, "info" => '格式错误！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_loupantuan` WHERE `aid` = ".$aid." ORDER BY `id` DESC");

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
				$list[$key]['id']      = $val['id'];
				$list[$key]['user']    = $val['user'];
				$list[$key]['tel']     = $val['tel'];
				$list[$key]['ip']      = $val['ip'];
				$list[$key]['ipaddr']  = $val['ipaddr'];
				$list[$key]['pubdate'] = $val['pubdate'];
			}
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 信息订阅
		 * @param act 订阅模块
		 * @param aid 要订阅的信息ID
		 * @param type 订阅类型 1变价 2开盘 3团购 4动态
		 * @param name 姓名
		 * @param phone 手机
		 * @param vercode 验证码
     * @return array
     */
	public function subscribe(){
		global $dsql;
		global $userLogin;

		$param = $this->param;

		$act     = $param['act'];
		$aid     = $param['aid'];
		$type    = $param['type'];
		$name    = $param['name'];
		$phone   = $param['phone'];
		$vercode = $param['vercode'];

		if(empty($aid) || empty($act)) return array("state" => 200, "info" => '信息传递失败，请重试');
		if(empty($type)) return array("state" => 200, "info" => '请选择要订阅的信息类型');
		if(empty($name)) return array("state" => 200, "info" => '请输入您的姓名');
		if(empty($phone)) return array("state" => 200, "info" => '请输入您的手机号码');

		preg_match('/0?(13|14|15|17|18)[0-9]{9}/', $phone, $matchPhone);
		if(!$matchPhone) return array("state" => 200, "info" => '手机号码格式错误，请重新输入！');

		if(empty($vercode)) return array("state" => 200, "info" => '请输入验证码');
		$vercode = strtolower($vercode);
		if($vercode != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		$uid = $userLogin->getMemberID();
		$pubdate = GetMkTime(time());

		$typeArr = explode(",", $type);

		//团购
		if(in_array(3, $typeArr) && $act == "loupan"){

			$sql = $dsql->SetQuery("SELECT * FROM `#@__house_loupantuan` WHERE `phone` = '$phone' AND `aid` = '$aid'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				//如果订阅的手机号码已经存在，暂不做任何操作，后期可考虑：
				//1. 更新姓名
				//2. 更新会员ID

			}else{
				//如果不存在，新增一条记录
				$sql = $dsql->SetQuery("INSERT INTO `#@__house_loupantuan` (`aid`, `uid`, `name`, `phone`, `pubdate`) VALUES ('$aid', '$uid', '$name', '$phone', '$pubdate')");
				$dsql->dsqlOper($sql, "update");
			}

		}


		//其他订阅信息
		$key = array_search(3, $typeArr);
		if ($key !== false){
			array_splice($typeArr, $key, 1);
		}
		$type = join(",", $typeArr);

		if(!empty($type)){
			$sql = $dsql->SetQuery("SELECT * FROM `#@__house_notice` WHERE `action` = '$act' AND `phone` = '$phone' AND `aid` = '$aid'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				//如果订阅类型为空（只订阅了看房团的情况），删除数据表中的这条信息
				if(empty($type)){
					$sql = $dsql->SetQuery("DELETE FROM `#@__house_notice` WHERE `id` = ".$ret[0]['id']);
					$dsql->dsqlOper($sql, "update");
				}
				//如果订阅的手机号码已经存在，判断订阅类型是否有变化，如果有变化，则更新
				elseif($ret[0]['type'] != $type){
					$sql = $dsql->SetQuery("UPDATE `#@__house_notice` SET `type` = '$type' WHERE `action` = '$act' AND `phone` = '$phone' AND `aid` = '$aid'");
					$dsql->dsqlOper($sql, "update");
				}
			}else{
				//如果不存在，新增一条记录
				$sql = $dsql->SetQuery("INSERT INTO `#@__house_notice` (`action`, `aid`, `uid`, `type`, `name`, `phone`, `pubdate`) VALUES ('$act', '$aid', '$uid', '$type', '$name', '$phone', '$pubdate')");
				$dsql->dsqlOper($sql, "update");
			}
		}

		return "订阅成功！";

	}





	/**
     * 房产评论
     * @return array
     */
	public function common(){
		global $dsql;
		$pageinfo = $list = array();
		$action = $aid = $page = $pageSize = $where = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$action   = $this->param['action'];
			$aid      = $this->param['aid'];
			$page     = $this->param['page'];
			$pageSize = $this->param['pageSize'];
		}

		if(empty($action) || empty($aid)) return array("state" => 200, "info" => '格式错误！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `floor`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad` FROM `#@__housecommon` WHERE `action` = '$action' AND `aid` = ".$aid." AND `ischeck` = 1 ORDER BY `floor` ASC, `id` DESC");

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
				$list[$key]['id']      = $val['id'];
				$list[$key]['floor']   = $val['floor'];
				$list[$key]['userid']  = $val['userid'];
				$list[$key]['content'] = $val['content'];
				$list[$key]['dtime']   = $val['dtime'];
				$list[$key]['ip']      = $val['ip'];
				$list[$key]['ipaddr']  = $val['ipaddr'];
				$list[$key]['good']    = $val['good'];
				$list[$key]['bad']     = $val['bad'];
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
		$param = $this->param;

		$action  = $param['action'];
		$aid     = $param['aid'];
		$userid  = $param['userid'];
		$content = $param['content'];

		if(empty($action) || empty($aid) || empty($userid) || empty($content)){
			return array("state" => 200, "info" => '必填项不得为空！');
		}

		$archives = $dsql->SetQuery("SELECT `id` FROM `#@__housecommon`");
		$count  = $dsql->dsqlOper($archives, "totalCount");

		$archives = $dsql->SetQuery("INSERT INTO `#@__housecommon` (`action`, `aid`, `floor`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `ischeck`) VALUES ('$action', '$aid', '$count', '$userid', '$content', ".GetMkTime(time()).", '".GetIP()."', '".getIpAddr(GetIP())."', 0, 0, 0)");
		$results  = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			return "评论成功！";
		}else{
			return array("state" => 200, "info" => '评论失败！');
		}

	}


	/**
     * 二手房列表
     * @return array
     */
	public function saleList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$community = $zj = $addrid = $subway = $station = $max_longitude = $min_longitude = $max_latitude = $min_latitude = $price = $room = $area = $keywords = $buildage = $protype = $floor = $type = $direction = $zhuangxiu = $orderby = $flags = $times = $u = $state = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$community = $this->param['community'];
				$zj        = $this->param['zj'];
				$comid     = $this->param['comid'];
				$addrid    = $this->param['addrid'];
				$subway    = $this->param['subway'];
				$station   = $this->param['station'];
				$max_longitude = $this->param['max_longitude'];
				$min_longitude = $this->param['min_longitude'];
				$max_latitude  = $this->param['max_latitude'];
				$min_latitude  = $this->param['min_latitude'];
				$price     = $this->param['price'];
				$room      = $this->param['room'];
				$area      = $this->param['area'];
				$keywords  = $this->param['keywords'];
				$buildage  = $this->param['buildage'];
				$protype   = $this->param['protype'];
				$floor     = $this->param['floor'];
				$type      = $this->param['type'];
				$direction = $this->param['direction'];
				$zhuangxiu = $this->param['zhuangxiu'];
				$orderby   = $this->param['orderby'];
				$flags     = $this->param['flags'];
				$times     = $this->param['times'];
				$u         = $this->param['u'];
				$state     = $this->param['state'];
				$page      = $this->param['page'];
				$pageSize  = $this->param['pageSize'];
			}
		}


		//是否输出当前登录会员的信息
		if($u != 1){
			// $where .= " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
			$where .= " AND s.`state` = 1";
		}else{
			$uid = $userLogin->getMemberID();
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$where .= " AND s.`userid` = ".$ret[0]['id'];
			}else{
				$where .= " AND s.`userid` = ".$uid;
			}

			if($state != ""){
				$where1 = " AND s.`state` = ".$state;
			}
		}


		//小区
		if(!empty($community)){
			$where .= " AND s.`communityid` = " . $community;
		}


		//中介
		if($zj != ""){
			$where .= " AND s.`usertype` = 1 AND s.`userid` = " . $zj;
		}

		// 中介公司
		if($comid != ""){
			// 查询公司下所有中介
			$arcZj = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `zjcom` = $comid");
			$retZj = $dsql->dsqlOper($arcZj, "results");
			if($retZj){
				$zjUserList = array();
				foreach ($retZj as $k => $v) {
					array_push($zjUserList, $v['id']);
				}
				$where .= " AND `userid` in(".join(',',$zjUserList).")";
			}else{
				$where .= " AND 1 = 2";
			}
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `addrid` in ($lower)");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $loupan){
					$ids[] = $loupan["id"];
				}
				//有结果
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " AND (s.`communityid` in ($ids) OR s.`addrid` in ($lower))";
				//无结果
				}else{
					$where .= " AND (1 = 2 OR s.`addrid` in ($lower))";
				}
			//无结果
			}else{
				$where .= " AND (1 = 2 OR s.`addrid` in ($lower))";
			}
		}

		//遍历地铁
		if(!empty($station)){

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND FIND_IN_SET ($station, `subway`)");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $loupan){
					$ids[] = $loupan["id"];
				}
				//有结果
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " AND s.`communityid` in ($ids)";
				//无结果
				}else{
					$where .= " AND 1 = 2";
				}
			//无结果
			}else{
				$where .= " AND 1 = 2";
			}

		//如果站点为空，线路不为空，则先查询出线路的站点再验证
		}elseif(!empty($subway)){

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_subway_station` WHERE `sid` = $subway ORDER BY `weight`");
			$res = $dsql->dsqlOper($sql, "results");
			if($res){
				$subway = array();
				foreach ($res as $key => $value) {
					$subway[] = "FIND_IN_SET (".$value['id'].", `subway`)";
				}

				//查询小区信息
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND (".join(" OR ", $subway).")");
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					$ids = array();
					foreach($results as $loupan){
						$ids[] = $loupan["id"];
					}
					//有结果
					if(!empty($ids)){
						$ids = join(",", $ids);
						$where .= " AND s.`communityid` in ($ids)";
					//无结果
					}else{
						$where .= " AND 1 = 2";
					}
				//无结果
				}else{
					$where .= " AND 1 = 2";
				}

			//无结果
			}else{
				$where .= " AND 1 = 2";
			}

		}

		//地图可视区域内
		if(!empty($max_longitude) && !empty($min_longitude) && !empty($max_latitude) && !empty($min_latitude)){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `longitude` <= '".$max_longitude."' AND `longitude` >= '".$min_longitude."' AND `latitude` <= '".$max_latitude."' AND `latitude` >= '".$min_latitude."'");
			$ret = $dsql->dsqlOper($sql, "results");

			$cids = array();
			if($ret){
				foreach ($ret as $key => $value) {
					$cids[$key] = $value['id'];
				}
			}

			if($cids){
				$cids = join(",", $cids);
				$where .= " AND s.`communityid` in ($cids)";
			}else{
				$where .= " AND 1 = 2";
			}
		}

		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND s.`price` < " . $price[1];
			}elseif(empty($price[1])){
				$where .= " AND s.`price` > " . $price[0];
			}else{
				$where .= " AND s.`price` BETWEEN " . $price[0] . " AND " . $price[1];
			}
		}

		//房型
		if($room != ""){
			if($room == 0){
				$where .= " AND s.`room` > 5";
			}else{
				$where .= " AND s.`room` = " . $room;
			}
		}

		//面积
		if($area != ""){
			$area = explode(",", $area);
			if(empty($area[0])){
				$where .= " AND s.`area` < " . $area[1];
			}elseif(empty($area[1])){
				$where .= " AND s.`area` > " . $area[0];
			}else{
				$where .= " AND s.`area` BETWEEN " . $area[0] . " AND " . $area[1];
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (s.`title` like '%".$keywords."%' OR s.`community` like '%".$keywords."%'";

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND (`title` like '%".$keywords."%' OR `addr` like '%".$keywords."%')");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $community){
					$ids[] = $community["id"];
				}
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " OR s.`communityid` in ($ids)";
				}
			}
			$where .= ")";
		}

		//建筑年代
		if($buildage != ""){
			$buildage = explode(",", $buildage);
			if(empty($buildage[0])){
				$where .= " AND s.`buildage` < " . $buildage[1];
			}elseif(empty($price[1])){
				$where .= " AND s.`buildage` > " . $buildage[0];
			}else{
				$where .= " AND s.`buildage` BETWEEN " . $buildage[0] . " AND " . $buildage[1];
			}
		}

		//物业类型
		if($protype != ""){
			$where .= " AND s.`protype` = " . $protype;
		}

		//楼层
		if($floor != ""){
			$floor = explode(",", $floor);
			if(empty($floor[0])){
				$where .= " AND s.`bno` < " . $floor[1];
			}elseif(empty($floor[1])){
				$where .= " AND s.`bno` > " . $floor[0];
			}else{
				$where .= " AND s.`bno` BETWEEN " . $floor[0] . " AND " . $floor[1];
			}
		}

		//性质
		if(!empty($type)){
			$type = $type == 1 ? 0 : 1;
			$where .= " AND s.`usertype` = " . $type;
		}

		//朝向
		if(!empty($direction)){
			$where .= " AND s.`direction` = $direction";
		}

		//装修
		if(!empty($zhuangxiu)){
			$where .= " AND s.`zhuangxiu` = $zhuangxiu";
		}

		//属性
		if($flags != ""){
			$flag = array();
			$flagArr = explode(",", $flags);
			foreach ($flagArr as $key => $value) {
				$flag[$key] = "FIND_IN_SET(".$value.", s.`flag`)";
			}
			$where .= " AND " . join(" AND ", $flag);
		}

		//时间筛选
		if(!empty($times)){

			if($times == "today"){
				$today = GetMkTime(date("Y-m-d"));
				$where .= " AND s.`pubdate` > ".$today;
			}elseif(strstr($times, "day")){
				$times = str_replace("day", "", $times);
				$times = GetMkTime(date("Y-m-d", strtotime($times." day")));
				$where .= " AND s.`pubdate` > ".$times;
			}elseif(strstr($times, "week")){
				$times = str_replace("week", "", $times);
				$times = GetMkTime(date("Y-m-d", strtotime($times." week")));
				$where .= " AND s.`pubdate` > ".$times;
			}elseif(strstr($times, "month")){
				$times = str_replace("month", "", $times);
				$times = GetMkTime(date("Y-m-d", strtotime($times." month")));
				$where .= " AND s.`pubdate` > ".$times;
			}elseif(strstr($times, "year")){
				$times = str_replace("year", "", $times);
				$times = GetMkTime(date("Y-m-d", strtotime($times." year")));
				$where .= " AND s.`pubdate` > ".$times;
			}

		}

		if(!empty($orderby)){
			//发布时间
			if($orderby == 1){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`pubdate` DESC, s.`weight` DESC, s.`id` DESC";
			//面积降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` ASC, s.`weight` DESC, s.`id` DESC";
			//面积升序
			}elseif($orderby == 3){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` DESC, s.`weight` DESC, s.`id` DESC";
			//价格升序
			}elseif($orderby == 4){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` ASC, s.`weight` DESC, s.`id` DESC";
			//价格降序
			}elseif($orderby == 5){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` DESC, s.`weight` DESC, s.`id` DESC";
			//单价升序
			}elseif($orderby == 6){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`unitprice` ASC, s.`weight` DESC, s.`id` DESC";
			//单价降序
			}elseif($orderby == 7){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`unitprice` DESC, s.`weight` DESC, s.`id` DESC";
			}
		}else{
			$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`weight` DESC, s.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"s.`id`, s.`title`, s.`communityid`, s.`community`, s.`addrid`, s.`address`, s.`litpic`, s.`price`, s.`unitprice`, s.`protype`, s.`room`, s.`hall`, s.`guard`, s.`bno`, s.`floor`, s.`buildage`, s.`area`, s.`flag`, s.`state`, s.`direction`, s.`zhuangxiu`, s.`flag`, s.`pubdate`, s.`isbid`, s.`bid_price`, s.`bid_end` " .
									"FROM `#@__house_sale` s " .
									"WHERE 1 = 1" . $where);

		// echo $archives;
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

		//会员列表需要统计信息状态
		if($u == 1 && $userLogin->getMemberID() > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND s.`state` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND s.`state` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND s.`state` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
		}

		$atpage = $pageSize*($page-1);
		$where = $pageSize != -1 ? " LIMIT $atpage, $pageSize" : "";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");

		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']     = $val['id'];
				$list[$key]['title']  = $val['title'];

				//小区
				$list[$key]["communityid"] = $val["communityid"];
				if($val['communityid'] == 0){
					$list[$key]["community"] = $val["community"];
					$addrName = getParentArr("houseaddr", $val['addrid']);
					global $data;
					$data = "";
					$addrName = array_reverse(parent_foreach($addrName, "typename"));
					$list[$key]['addr']      = $addrName;
					$list[$key]['addrid']    = $val['addrid'];
					$list[$key]["address"]   = $val["address"];
				}else{
					$communitySql = $dsql->SetQuery("SELECT `id`, `title`, `addrid`, `addr` FROM `#@__house_community` WHERE `id` = ". $val["communityid"]);
					$communityResult = $dsql->getTypeName($communitySql);
					if(!$communityResult){
						$list[$key]["community"] = "";
						$list[$key]['addr']      = array();
						$list[$key]["addrid"]    = 0;
						$list[$key]["address"]   = "";
					}else{
						$list[$key]["community"] = $communityResult[0]["title"];
						$addrName = getParentArr("houseaddr", $communityResult[0]['addrid']);
						global $data;
						$data = "";
						$addrName = array_reverse(parent_foreach($addrName, "typename"));
						$list[$key]['addr']      = $addrName;
						$list[$key]["addrid"]    = $communityResult[0]["addrid"];
						$list[$key]["address"]   = $communityResult[0]["addr"];
					}
				}

				$param = array(
					"service"     => "house",
					"template"    => "community-detail",
					"id"          => $val['communityid']
				);
				$list[$key]['communityUrl'] = getUrlPath($param);

				// 图集数量
				$sqlPics = $dsql->SetQuery("SELECT count(`id`) AS count FROM `#@__house_pic` WHERE `type` = 'housesale' AND `aid` = ".$val['id']);
				$retPics = $dsql->dsqlOper($sqlPics, "results");
				if($retPics){
					$list[$key]['pics']= $retPics[0]['count'];
				}else{
					$list[$key]['pics']= 0;
				}
				$list[$key]['litpic']    = getFilePath($val['litpic']);
				$list[$key]['price']     = $val['price'];
				$list[$key]['unitprice'] = $val['unitprice'];

				//物业类型
				$protype = explode(",", $val['protype']);
				$protypeArr = array();
				foreach ($protype as $k => $v) {
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
				}
				$list[$key]['protype']    = join(",", $protypeArr);

				//朝向
				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['direction']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$list[$key]['direction'] = $houseResult ? $houseResult[0]['typename'] : "";

				//装修
				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['zhuangxiu']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$list[$key]['zhuangxiu'] = $houseResult ? $houseResult[0]['typename'] : "";

				$list[$key]['room']     = $val['room']."室".$val['hall']."厅".$val['guard']."卫";
				$list[$key]['bno']      = $val['bno'];
				$list[$key]['floor']    = $val['floor'];
				$list[$key]['buildage'] = $val['buildage'];
				$list[$key]['area']     = $val['area'];
				$list[$key]['flag']     = $val['flag'];
				$list[$key]['pubdate']  = $val['pubdate'];
				$list[$key]['isbid']    = $val['isbid'];

				//属性
				$list[$key]['flag']     = $val['flag'];
				$flags = explode(",", $val['flag']);
				$flagArr = array();
				foreach ($flags as $k => $v) {
					if($v == 0){
						array_push($flagArr, "急售");
					}elseif($v == 1){
						array_push($flagArr, "免税");
					}elseif($v == 2){
						array_push($flagArr, "地铁");
					}elseif($v == 3){
						array_push($flagArr, "校区房");
					}elseif($v == 4){
						array_push($flagArr, "满五年");
					}elseif($v == 5){
						array_push($flagArr, "推荐");
					}
				}
				$list[$key]['flags'] = $flagArr;

				//会员中心显示信息状态
				if($u == 1 && $userLogin->getMemberID() > -1){
					$list[$key]['state'] = $val['state'];

					//显示竞价结束时间、每日预算
					$list[$key]['bid_price'] = $val['bid_price'];
					$list[$key]['bid_end'] = $val['bid_end'];
				}

				//图集数量
				$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housesale' AND `aid` = ".$val['id']);
				$imgCount = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['imgCount'] = $imgCount;

				$param = array(
					"service"     => "house",
					"template"    => "sale-detail",
					"id"          => $val['id']
				);
				$list[$key]['url']        = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
		* 区域二手房统计
		*
		* @return array
		*/
	public function saleDistrict(){
		global $dsql;
		$price    = $this->param['price'];
		$area     = $this->param['area'];
		$keywords = $this->param['keywords'];
		$room     = $this->param['room'];
		$direction = $this->param['direction'];
		$buildage  = $this->param['buildage'];
		$floor     = $this->param['floor'];
		$zhuangxiu = $this->param['zhuangxiu'];
		$flags     = $this->param['flags'];
		$bizcircle = $this->param['bizcircle'];  //统计二级区域数据
		$community = $this->param['community'];  //统计可视范围内小区数据
		$min_latitude  = $this->param['min_latitude'];
		$max_latitude  = $this->param['max_latitude'];
		$min_longitude = $this->param['min_longitude'];
		$max_longitude = $this->param['max_longitude'];

		$data = array();
		$bc = 0;

		$where = " AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";

		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND s.`price` < " . $price[1];
			}elseif(empty($price[1])){
				$where .= " AND s.`price` > " . $price[0];
			}else{
				$where .= " AND s.`price` BETWEEN " . $price[0] . " AND " . $price[1];
			}
		}

		//房型
		if($room != ""){
			if($room == 0){
				$where .= " AND s.`room` > 5";
			}else{
				$where .= " AND s.`room` = " . $room;
			}
		}

		//面积
		if($area != ""){
			$area = explode(",", $area);
			if(empty($area[0])){
				$where .= " AND s.`area` < " . $area[1];
			}elseif(empty($area[1])){
				$where .= " AND s.`area` > " . $area[0];
			}else{
				$where .= " AND s.`area` BETWEEN " . $area[0] . " AND " . $area[1];
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (s.`title` like '%".$keywords."%' OR s.`community` like '%".$keywords."%'";

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND (`title` like '%".$keywords."%' OR `addr` like '%".$keywords."%')");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $comm){
					$ids[] = $comm["id"];
				}
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " OR s.`communityid` in ($ids)";
				}
			}

			$where .= ")";
		}

		//建筑年代
		if($buildage != ""){
			$buildage = explode(",", $buildage);
			if(empty($buildage[0])){
				$where .= " AND s.`buildage` < " . $buildage[1];
			}elseif(empty($price[1])){
				$where .= " AND s.`buildage` > " . $buildage[0];
			}else{
				$where .= " AND s.`buildage` BETWEEN " . $buildage[0] . " AND " . $buildage[1];
			}
		}

		//物业类型
		if($protype != ""){
			$where .= " AND s.`protype` = " . $protype;
		}

		//楼层
		if($floor != ""){
			$floor = explode(",", $floor);
			if(empty($floor[0])){
				$where .= " AND s.`bno` < " . $floor[1];
			}elseif(empty($floor[1])){
				$where .= " AND s.`bno` > " . $floor[0];
			}else{
				$where .= " AND s.`bno` BETWEEN " . $floor[0] . " AND " . $floor[1];
			}
		}

		//朝向
		if(!empty($direction)){
			$where .= " AND s.`direction` = $direction";
		}

		//装修
		if(!empty($zhuangxiu)){
			$where .= " AND s.`zhuangxiu` = $zhuangxiu";
		}

		//属性
		if($flags != ""){
			$flag = array();
			$flagArr = explode(",", $flags);
			foreach ($flagArr as $key => $value) {
				$flag[$key] = "FIND_IN_SET(".$value.", s.`flag`)";
			}
			$where .= " AND " . join(" AND ", $flag);
		}


		//只统计区域内的小区数据
		if($community == 1){

			$sql = $dsql->SetQuery("SELECT `id`, `title`, `longitude`, `latitude` FROM `#@__house_community` WHERE `state` = 1 AND `longitude` <= '".$max_longitude."' AND `longitude` >= '".$min_longitude."' AND `latitude` <= '".$max_latitude."' AND `latitude` >= '".$min_latitude."'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				foreach ($ret as $key => $value) {
					$nwhere = $where . " AND s.`communityid` = ".$value['id'];

					$count = $price = $unitprice = 0;
					$saleSql = $dsql->SetQuery("SELECT COUNT(s.`id`) count, AVG(s.`price`) price, AVG(s.`unitprice`) unitprice FROM `#@__house_sale` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`state` = 1".$nwhere);
					$saleRet = $dsql->dsqlOper($saleSql, "results");
					if($saleRet){
						$count = $saleRet[0]['count'];
						$price = sprintf("%.2f", $saleRet[0]['price']);
						$unitprice = sprintf("%.2f", $saleRet[0]['unitprice']);
					}

					if($count > 0){
						$data[$bc]['id']        = $value['id'];
						$data[$bc]['title']     = $value['title'];
						$data[$bc]['longitude'] = $value['longitude'];
						$data[$bc]['latitude']  = $value['latitude'];
						$data[$bc]['count']     = $count;
						$data[$bc]['price']     = $price;
						$data[$bc]['unitprice'] = $unitprice;
						$param = array(
							"service"  => "house",
							"template" => "community-sale",
							"id"       => $value['id']
						);
						$data[$bc]['url'] = getUrlPath($param);
						$bc++;
					}
				}

			}


		//区域数据
		}else{

			//所有一级区域
			$sql = $dsql->SetQuery("SELECT `id`, `typename`, `longitude`, `latitude` FROM `#@__houseaddr` WHERE `parentid` = 0 ORDER BY `weight`");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$kk = 0;
				foreach ($ret as $key => $value) {

					//单独请求二级区域数据
					if($bizcircle == 1){

						$addrSql = $dsql->SetQuery("SELECT `id`, `typename`, `longitude`, `latitude` FROM `#@__houseaddr` WHERE `parentid` = ".$value['id']." ORDER BY `weight`");
						$addrRet = $dsql->dsqlOper($addrSql, "results");
						foreach ($addrRet as $k => $v) {

							$nwhere = $where;

							//查询小区信息
							$cid = array();
							$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `addrid` = ".$v['id']);
							$results = $dsql->dsqlOper($archives, "results");
							if($results){
								foreach($results as $loupan){
									$cid[] = $loupan["id"];
								}
								//有结果
								if(!empty($cid)){
									$cid = join(",", $cid);
									$nwhere .= " AND s.`communityid` in ($cid)";
								//无结果
								}else{
									$nwhere .= " AND 1 = 2";
								}
							//无结果
							}else{
								$nwhere .= " AND 1 = 2";
							}

							$count = $price = $unitprice = 0;
							if($cid){
								$saleSql = $dsql->SetQuery("SELECT COUNT(s.`id`) count, AVG(s.`price`) price, AVG(s.`unitprice`) unitprice FROM `#@__house_sale` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`state` = 1".$nwhere);
								$saleRet = $dsql->dsqlOper($saleSql, "results");
								if($saleRet){
									$count = $saleRet[0]['count'];
									$price = sprintf("%.2f", $saleRet[0]['price']);
									$unitprice = sprintf("%.2f", $saleRet[0]['unitprice']);
								}
							}

							if($count > 0){
								$data[$bc]['id']        = $v['id'];
								$data[$bc]['addrname']  = $v['typename'];
								$data[$bc]['longitude'] = $v['longitude'];
								$data[$bc]['latitude']  = $v['latitude'];
								$data[$bc]['count']     = $count;
								$data[$bc]['price']     = $price;
								$data[$bc]['unitprice'] = $unitprice;
								$bc++;
							}

						}


					//只请求一级区域数据
					}else{
						$nwhere = $where;
						$ids = array($value['id']);

						$addrSql = $dsql->SetQuery("SELECT `id` FROM `#@__houseaddr` WHERE `parentid` = ".$value['id']." ORDER BY `weight`");
						$addrRet = $dsql->dsqlOper($addrSql, "results");
						foreach ($addrRet as $k => $v) {
							array_push($ids, $v['id']);
						}


						//查询小区信息
						$cid = array();
						$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `addrid` in (".join(",", $ids).")");
						$results = $dsql->dsqlOper($archives, "results");
						if($results){
							foreach($results as $loupan){
								$cid[] = $loupan["id"];
							}
							//有结果
							if(!empty($cid)){
								$cid = join(",", $cid);
								$nwhere .= " AND s.`communityid` in ($cid)";
							//无结果
							}else{
								$nwhere .= " AND 1 = 2";
							}
						//无结果
						}else{
							$nwhere .= " AND 1 = 2";
						}

						$count = $price = $unitprice = 0;

						if($cid){
							$saleSql = $dsql->SetQuery("SELECT COUNT(s.`id`) count, AVG(s.`price`) price, AVG(s.`unitprice`) unitprice FROM `#@__house_sale` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`state` = 1".$nwhere);
							$saleRet = $dsql->dsqlOper($saleSql, "results");
							if($saleRet){
								$count = $saleRet[0]['count'];
								$price = sprintf("%.2f", $saleRet[0]['price']);
								$unitprice = sprintf("%.2f", $saleRet[0]['unitprice']);
							}
						}

						if($count > 0){
							$data[$kk]['id']        = $value['id'];
							$data[$kk]['addrname']  = $value['typename'];
							$data[$kk]['longitude'] = $value['longitude'];
							$data[$kk]['latitude']  = $value['latitude'];
							$data[$kk]['count']     = $count;
							$data[$kk]['price']     = $price;
							$data[$kk]['unitprice'] = $unitprice;
							$kk++;
						}

					}

				}
			}

		}


		if($data){
			return $data;
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

	}


	/**
     * 二手房详细
     * @return array
     */
	public function saleDetail(){
		global $dsql;
		global $userLogin;
		$saleDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		//$where = " AND s.`state` = 1";
		// if($userLogin->getUserID() == -1){
		//
		// 	$where = " AND s.`state` = 1";
		//
		// 	//如果没有登录再验证会员是否已经登录，为了实现会员修改信息功能
		// 	if($userLogin->getMemberID() == -1){
		// 		$where = " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
		// 	}else{
		// 		$where = " AND s.`userid` = ".$userLogin->getMemberID();
		// 	}
		//
		// }

		$archives = $dsql->SetQuery("SELECT s.* FROM `#@__house_sale` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$saleDetail["id"]    = $results[0]['id'];
			$saleDetail["title"] = $results[0]['title'];

			//小区
			$saleDetail["communityid"] = $results[0]["communityid"];

			$addrid = $results[0]['addrid'];

			if($results[0]['communityid'] == 0){
				$saleDetail["community"] = $results[0]["community"];
				$addrName = getParentArr("houseaddr", $addrid);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$saleDetail['addr']      = $addrName;
				$saleDetail["address"]   = $results[0]["address"];
				$saleDetail["longitude"] = "";
				$saleDetail["latitude"]  = "";
			}else{
				$communitySql = $dsql->SetQuery("SELECT `id`, `title`, `addrid`, `addr`, `longitude`, `latitude` FROM `#@__house_community` WHERE `id` = ". $results[0]["communityid"]);
				$communityResult = $dsql->getTypeName($communitySql);
				if(!$communityResult){
					$saleDetail["community"] = "小区不存在";
					$saleDetail['addr']      = array();
					$saleDetail["address"]   = "";
					$saleDetail["longitude"] = "";
					$saleDetail["latitude"]  = "";
					$addrid = 0;
				}else{
					$saleDetail["community"] = $communityResult[0]["title"];
					$addrName = getParentArr("houseaddr", $communityResult[0]['addrid']);
					global $data;
					$data = "";
					$addrName = array_reverse(parent_foreach($addrName, "typename"));
					$saleDetail['addr']      = $addrName;
					$saleDetail["address"]   = $communityResult[0]["addr"];
					$saleDetail["longitude"] = $communityResult[0]["longitude"];
					$saleDetail["latitude"]  = $communityResult[0]["latitude"];
					$addrid                  = $communityResult[0]["addrid"];
				}
			}

			$saleDetail["addrid"] = $addrid;


			//会员信息
			$userid = $results[0]['userid'];
			$userArr = array('userid' => $userid);
			$nickname = $photo = $phone = $certify = $flag = $zjcomName = $zjcomId = "";
			if($userid != 0 && $userid != -1){
				$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo`, m.`phone`, m.`certifyState`, zj.`flag`, zj.`zjcom`, zjcom.`title`, zjcom.`id` zjcomId FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` LEFT JOIN `#@__house_zjcom` zjcom ON zj.`zjcom` = zjcom.`id` WHERE zj.`state` = 1 AND zj.`id` = ".$userid);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$nickname  = $member[0]['nickname'];
					$photo     = getFilePath($member[0]['photo']);
					$phone     = $member[0]['phone'];
					$certify   = $member[0]['certify'];
					$flag      = $member[0]['flag'];
					$zjcomName = $member[0]['title'];
					$zjcomId   = $member[0]['zjcomId'];
				}
				$userArr['nickname']  = $nickname;
				$userArr['photo']     = $photo;
				$userArr['phone']     = $phone;
				$userArr['certify']   = $certify;
				$userArr['flag']      = $flag;
				$userArr['zjcomName'] = $zjcomName;
				$userArr['zjcomId']   = $zjcomId;
			}
			$saleDetail['user'] = $userArr;

			//父级区域
			$areaid = 0;
			$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$addrid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$areaid = $ret[0]['parentid'];
			}
			$saleDetail["areaid"]     = $areaid;

			$param = array(
				"service"     => "house",
				"template"    => "community-detail",
				"id"          => $results[0]['communityid']
			);
			$saleDetail['communityUrl'] = getUrlPath($param);

			$saleDetail["litpic"]    = getFilePath($results[0]['litpic']);
			$saleDetail["litpicSource"] = $results[0]['litpic'];
			$saleDetail["price"]     = $results[0]['price'];
			$saleDetail["unitprice"] = $results[0]['unitprice'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['protype']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$protype = $houseResult ? $houseResult[0]['typename'] : "";
			$saleDetail["protype"]   = $protype;
			$saleDetail["protypeid"] = $results[0]['protype'];

			$saleDetail["room"]      = $results[0]['room'];
			$saleDetail["hall"]      = $results[0]['hall'];
			$saleDetail["guard"]     = $results[0]['guard'];
			$saleDetail["bno"]       = $results[0]['bno'];
			$saleDetail["floor"]     = $results[0]['floor'];
			$saleDetail["area"]      = $results[0]['area'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['direction']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$direction = $houseResult ? $houseResult[0]['typename'] : "";
			$saleDetail["direction"] = $direction;
			$saleDetail["directionid"] = $results[0]['direction'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['zhuangxiu']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
			$saleDetail["zhuangxiu"] = $zhuangxiu;
			$saleDetail["zhuangxiuid"] = $results[0]['zhuangxiu'];

			$saleDetail["buildage"] = $results[0]['buildage'];
			$saleDetail["usertype"] = $results[0]['usertype'];

			//个人会员
			if($userArr['nickname'] == ""){
				$saleDetail["userid"]   = $results[0]['userid'];

				//读取会员信息
				if($results[0]['userid'] && $results[0]['username'] == ""){

					$member = getMemberDetail($results[0]['userid']);
					$saleDetail["username"] = $member['nickname'];
					$saleDetail["contact"]  = $member['phone'];

				}else{
					$saleDetail["username"] = $results[0]['username'];
					$saleDetail["contact"]  = $results[0]['contact'];
				}

			}

			// $saleDetail["userid"]   = $results[0]['userid'];
			// $saleDetail["username"] = $results[0]['username'];
			// $saleDetail["contact"]  = $results[0]['contact'];
			$saleDetail["note"]     = $results[0]['note'];
			$saleDetail["mbody"]    = $results[0]['mbody'];
			$saleDetail["pubdate"]  = $results[0]['pubdate'];

			//属性
			$saleDetail['flag']     = $results[0]['flag'];
			$flags = explode(",", $results[0]['flag']);
			$flagArr = array();
			foreach ($flags as $k => $v) {
				if($v == 0){
					array_push($flagArr, "急售");
				}elseif($v == 1){
					array_push($flagArr, "免税");
				}elseif($v == 2){
					array_push($flagArr, "地铁");
				}elseif($v == 3){
					array_push($flagArr, "校区房");
				}elseif($v == 4){
					array_push($flagArr, "满五年");
				}elseif($v == 5){
					array_push($flagArr, "推荐");
				}
			}
			$saleDetail['flags'] = $flagArr;

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housesale' AND `aid` = ".$results[0]['id']." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $k => $v){
					$imglist[$k]["path"] = getFilePath($v["picPath"]);
					$imglist[$k]["pathSource"] = $v["picPath"];
					$imglist[$k]["info"] = $v["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$saleDetail["imglist"]     = $imglist;
		}
		return $saleDetail;
	}


	/**
     * 出租房列表
     * @return array
     */
	public function zuList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$community = $zj = $addrid = $subway = $station = $max_longitude = $min_longitude = $max_latitude = $min_latitude = $price = $room = $keywords = $protype = $zhuangxiu = $rentype = $type = $u = $state = $orderby = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$community = $this->param['community'];
				$zj        = $this->param['zj'];
				$comid     = $this->param['comid'];
				$addrid    = $this->param['addrid'];
				$subway    = $this->param['subway'];
				$station   = $this->param['station'];
				$max_longitude = $this->param['max_longitude'];
				$min_longitude = $this->param['min_longitude'];
				$max_latitude  = $this->param['max_latitude'];
				$min_latitude  = $this->param['min_latitude'];
				$price     = $this->param['price'];
				$room      = $this->param['room'];
				$keywords  = $this->param['keywords'];
				$protype   = $this->param['protype'];
				$zhuangxiu = $this->param['zhuangxiu'];
				$rentype   = $this->param['rentype'];
				$type      = $this->param['type'];
				$u         = $this->param['u'];
				$state     = $this->param['state'];
				$orderby   = $this->param['orderby'];
				$page      = $this->param['page'];
				$pageSize  = $this->param['pageSize'];
			}
		}


		//是否输出当前登录会员的信息
		if($u != 1){
			// $where .= " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
			$where .= " AND s.`state` = 1";
		}else{
			$uid = $userLogin->getMemberID();
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$where .= " AND s.`userid` = ".$ret[0]['id'];
			}else{
				$where .= " AND s.`userid` = ".$uid;
			}

			if($state != ""){
				$where1 = " AND s.`state` = ".$state;
			}
		}

		//小区
		if(!empty($community)){
			$where .= " AND s.`communityid` = " . $community;
		}

		//中介
		if($zj != ""){
			$where .= " AND s.`usertype` = 1 AND s.`userid` = " . $zj;
		}
		// 中介公司
		if($comid != ""){
			// 查询公司下所有中介
			$arcZj = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `zjcom` = $comid");
			$retZj = $dsql->dsqlOper($arcZj, "results");
			if($retZj){
				$zjUserList = array();
				foreach ($retZj as $k => $v) {
					array_push($zjUserList, $v['id']);
				}
				$where .= " AND `userid` in(".join(',',$zjUserList).")";
			}else{
				$where .= " AND 1 = 2";
			}
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `addrid` in ($lower)");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $loupan){
					$ids[] = $loupan["id"];
				}
				//有结果
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " AND (s.`communityid` in ($ids) OR s.`addrid` in ($lower))";
				//无结果
				}else{
					$where .= " AND (1 = 2 OR s.`addrid` in ($lower))";
				}
			//无结果
			}else{
				$where .= " AND (1 = 2 OR s.`addrid` in ($lower))";
			}

		}


		//遍历地铁
		if(!empty($station)){

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND FIND_IN_SET ($station, `subway`)");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $loupan){
					$ids[] = $loupan["id"];
				}
				//有结果
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " AND s.`communityid` in ($ids)";
				//无结果
				}else{
					$where .= " AND 1 = 2";
				}
			//无结果
			}else{
				$where .= " AND 1 = 2";
			}

		//如果站点为空，线路不为空，则先查询出线路的站点再验证
		}elseif(!empty($subway)){

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__site_subway_station` WHERE `sid` = $subway ORDER BY `weight`");
			$res = $dsql->dsqlOper($sql, "results");
			if($res){
				$subway = array();
				foreach ($res as $key => $value) {
					$subway[] = "FIND_IN_SET (".$value['id'].", `subway`)";
				}

				//查询小区信息
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND (".join(" OR ", $subway).")");
				$results = $dsql->dsqlOper($archives, "results");
				if($results){
					$ids = array();
					foreach($results as $loupan){
						$ids[] = $loupan["id"];
					}
					//有结果
					if(!empty($ids)){
						$ids = join(",", $ids);
						$where .= " AND s.`communityid` in ($ids)";
					//无结果
					}else{
						$where .= " AND 1 = 2";
					}
				//无结果
				}else{
					$where .= " AND 1 = 2";
				}

			//无结果
			}else{
				$where .= " AND 1 = 2";
			}

		}

		//地图可视区域内
		if(!empty($max_longitude) && !empty($min_longitude) && !empty($max_latitude) && !empty($min_latitude)){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `longitude` <= '".$max_longitude."' AND `longitude` >= '".$min_longitude."' AND `latitude` <= '".$max_latitude."' AND `latitude` >= '".$min_latitude."'");
			$ret = $dsql->dsqlOper($sql, "results");

			$cids = array();
			if($ret){
				foreach ($ret as $key => $value) {
					$cids[$key] = $value['id'];
				}
			}

			if($cids){
				$cids = join(",", $cids);
				$where .= " AND s.`communityid` in ($cids)";
			}else{
				$where .= " AND 1 = 2";
			}
		}


		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND s.`price` < " . $price[1] * 100;
			}elseif(empty($price[1])){
				$where .= " AND s.`price` > " . $price[0] * 100;
			}else{
				$where .= " AND s.`price` BETWEEN " . $price[0] * 100 . " AND " . $price[1] * 100;
			}
		}

		//房型
		if($room != ""){
			if($room == 0){
				$where .= " AND s.`room` > 5";
			}else{
				$where .= " AND s.`room` = " . $room;
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (s.`title` like '%".$keywords."%' OR s.`community` like '%".$keywords."%'";

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND (`title` like '%".$keywords."%' OR `addr` like '%".$keywords."%')");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $community){
					$ids[] = $community["id"];
				}
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " OR s.`communityid` in ($ids)";
				}
			}

			$where .= ")";
		}

		//物业类型
		if($protype != ""){
			$where .= " AND s.`protype` = " . $protype;
		}

		//装修
		if($zhuangxiu != ""){
			$where .= " AND s.`zhuangxiu` = " . $zhuangxiu;
		}

		//出租方式
		if(!empty($rentype)){
			$rentype = $rentype == 1 ? 0 : 1;
			$where .= " AND s.`rentype` = " . $rentype;
		}

		//性质
		if(!empty($type)){
			$type = $type == 1 ? 0 : 1;
			$where .= " AND s.`usertype` = " . $type;
		}

		if(!empty($orderby)){
			//发布时间
			if($orderby == 1){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`pubdate` DESC, s.`weight` DESC, s.`id` DESC";
			//价格升序
			}elseif($orderby == 2){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` ASC, s.`weight` DESC, s.`id` DESC";
			//价格降序
			}elseif($orderby == 3){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` DESC, s.`weight` DESC, s.`id` DESC";
			}
		}else{
			$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`weight` DESC, s.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"s.`id`, s.`title`, s.`communityid`, s.`community`, s.`addrid`, s.`address`, s.`litpic`, s.`price`, s.`rentype`, s.`protype`, s.`room`, s.`hall`, s.`guard`, s.`bno`, s.`floor`, s.`area`, s.`sharetype`, s.`direction`, s.`zhuangxiu`, s.`usertype`, s.`username`, s.`userid`, s.`state`, s.`pubdate`, s.`isbid`, s.`bid_price`, s.`bid_end` " .
									"FROM `#@__house_zu` s " .
									"WHERE " .
									"1 = 1".$where);

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

		//会员列表需要统计信息状态
		if($u == 1 && $userLogin->getMemberID() > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND s.`state` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND s.`state` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND s.`state` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']     = $val['id'];
				$list[$key]['title']  = $val['title'];

				//小区
				$list[$key]["communityid"] = $val["communityid"];
				if($val['communityid'] == 0){
					$list[$key]["community"] = $val["community"];
					$addrName = getParentArr("houseaddr", $val['addrid']);
					global $data;
					$data = "";
					$addrName = array_reverse(parent_foreach($addrName, "typename"));
					$list[$key]['addr']      = $addrName;
					$list[$key]["addrid"]    = $val["addrid"];
					$list[$key]["address"]   = $val["address"];
				}else{
					$communitySql = $dsql->SetQuery("SELECT `id`, `title`, `addrid`, `addr` FROM `#@__house_community` WHERE `id` = ". $val["communityid"]);
					$communityResult = $dsql->getTypeName($communitySql);
					if(!$communityResult){
						$list[$key]["community"] = "小区不存在";
						$list[$key]['addr']      = array();
						$list[$key]['addrid']    = 0;
						$list[$key]["address"]   = "";
					}else{
						$list[$key]["community"] = $communityResult[0]["title"];
						$addrName = getParentArr("houseaddr", $communityResult[0]['addrid']);
						global $data;
						$data = "";
						$addrName = array_reverse(parent_foreach($addrName, "typename"));
						$list[$key]['addr']      = $addrName;
						$list[$key]['addrid']    = $communityResult[0]["addrid"];
						$list[$key]["address"]   = $communityResult[0]["addr"];
					}
				}

				$param = array(
					"service"     => "house",
					"template"    => "community-detail",
					"id"          => $val['communityid']
				);
				$list[$key]['communityUrl'] = getUrlPath($param);

				//会员信息
				$nickname = $userPhoto = "";
				if($val['userid'] != 0 && $val['userid'] != -1){
					$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo` FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` WHERE zj.`id` = ".$val['userid']);
					$member = $dsql->dsqlOper($archives, "results");
					if($member){
						$nickname  = $member[0]['nickname'];
						$userPhoto = getFilePath($member[0]['photo']);
					}else{
						$nickname  = "";
						$userPhoto = "";
					}
				}
				$list[$key]['userid']    = $val['userid'];
				$list[$key]['nickname']  = $nickname;
				$list[$key]['userPhoto'] = $userPhoto;

				// 图集数量
				$sqlPics = $dsql->SetQuery("SELECT count(`id`) AS count FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$val['id']);
				$retPics = $dsql->dsqlOper($sqlPics, "results");
				if($retPics){
					$list[$key]['pics']= $retPics[0]['count'];
				}else{
					$list[$key]['pics']= 0;
				}
				$list[$key]['litpic']    = getFilePath($val['litpic']);
				$list[$key]['price']     = $val['price'];
				$list[$key]['rentype'] = $val['rentype'] == 0 ? "整租" : "合租";

				$protype = explode(",", $val['protype']);
				$protypeArr = array();
				foreach ($protype as $k => $v) {
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
				}

				$list[$key]['protype']    = join(",", $protypeArr);

				$list[$key]['room']     = $val['room']."室".$val['hall']."厅".$val['guard']."卫";

				$list[$key]['bno']      = $val['bno'];
				$list[$key]['floor']    = $val['floor'];
				$list[$key]['area']     = $val['area'];

				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['sharetype']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$sharetype = $houseResult ? $houseResult[0]['typename'] : "";
				$list[$key]['sharetype']  = $sharetype;

				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['direction']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$direction = $houseResult ? $houseResult[0]['typename'] : "";
				$list[$key]['direction']  = $direction;

				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['zhuangxiu']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
				$list[$key]['zhuangxiu']  = $zhuangxiu;

				$list[$key]['usertype']  = $val['usertype'];

				if($val['usertype'] == 0){
					$list[$key]['username'] = $val['username'];
				}

				//会员中心显示信息状态
				if($u == 1 && $userLogin->getMemberID() > -1){
					$list[$key]['state'] = $val['state'];

					//显示竞价结束时间、每日预算
					$list[$key]['bid_price'] = $val['bid_price'];
					$list[$key]['bid_end'] = $val['bid_end'];
				}
				$list[$key]['pubdate']  = $val['pubdate'];
				$list[$key]['isbid']  = $val['isbid'];
				$list[$key]['timeUpdate'] = FloorTime(GetMkTime(time()) - $val['pubdate']);

				//图集数量
				$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$val['id']);
				$imgCount = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['imgCount'] = $imgCount;

				$param = array(
					"service"     => "house",
					"template"    => "zu-detail",
					"id"          => $val['id']
				);
				$list[$key]['url']        = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
		* 区域出租房统计
		*
		* @return array
		*/
	public function zuDistrict(){
		global $dsql;
		$price    = $this->param['price'];
		$keywords = $this->param['keywords'];
		$room     = $this->param['room'];
		$zhuangxiu = $this->param['zhuangxiu'];
		$rentype   = $this->param['rentype'];
		$type      = $this->param['type'];
		$bizcircle = $this->param['bizcircle'];  //统计二级区域数据
		$community = $this->param['community'];  //统计可视范围内小区数据
		$min_latitude  = $this->param['min_latitude'];
		$max_latitude  = $this->param['max_latitude'];
		$min_longitude = $this->param['min_longitude'];
		$max_longitude = $this->param['max_longitude'];

		$data = array();
		$bc = 0;

		$where = " AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";

		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND s.`price` < " . $price[1] * 100;
			}elseif(empty($price[1])){
				$where .= " AND s.`price` > " . $price[0] * 100;
			}else{
				$where .= " AND s.`price` BETWEEN " . $price[0] * 100 . " AND " . $price[1] * 100;
			}
		}

		//房型
		if($room != ""){
			if($room == 0){
				$where .= " AND s.`room` > 5";
			}else{
				$where .= " AND s.`room` = " . $room;
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (s.`title` like '%".$keywords."%' OR s.`community` like '%".$keywords."%'";

			//查询小区信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND (`title` like '%".$keywords."%' OR `addr` like '%".$keywords."%')");
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$ids = array();
				foreach($results as $community){
					$ids[] = $community["id"];
				}
				if(!empty($ids)){
					$ids = join(",", $ids);
					$where .= " OR s.`communityid` in ($ids)";
				}
			}

			$where .= ")";
		}

		//物业类型
		if($protype != ""){
			$where .= " AND s.`protype` = " . $protype;
		}

		//装修
		if($zhuangxiu != ""){
			$where .= " AND s.`zhuangxiu` = " . $zhuangxiu;
		}

		//出租方式
		if(!empty($rentype)){
			$rentype = $rentype == 1 ? 0 : 1;
			$where .= " AND s.`rentype` = " . $rentype;
		}

		//性质
		if(!empty($type)){
			$type = $type == 1 ? 0 : 1;
			$where .= " AND s.`usertype` = " . $type;
		}


		//只统计区域内的小区数据
		if($community == 1){

			$sql = $dsql->SetQuery("SELECT `id`, `title`, `longitude`, `latitude` FROM `#@__house_community` WHERE `state` = 1 AND `longitude` <= '".$max_longitude."' AND `longitude` >= '".$min_longitude."' AND `latitude` <= '".$max_latitude."' AND `latitude` >= '".$min_latitude."'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				foreach ($ret as $key => $value) {
					$nwhere = $where . " AND s.`communityid` = ".$value['id'];

					$count = $price = 0;
					$saleSql = $dsql->SetQuery("SELECT COUNT(s.`id`) count, AVG(s.`price`) price FROM `#@__house_zu` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`state` = 1".$nwhere);
					$saleRet = $dsql->dsqlOper($saleSql, "results");
					if($saleRet){
						$count = $saleRet[0]['count'];
						$price = sprintf("%.2f", $saleRet[0]['price']);
					}

					if($count > 0){
						$data[$bc]['id']        = $value['id'];
						$data[$bc]['title']     = $value['title'];
						$data[$bc]['longitude'] = $value['longitude'];
						$data[$bc]['latitude']  = $value['latitude'];
						$data[$bc]['count']     = $count;
						$data[$bc]['price']     = $price;
						$param = array(
							"service"  => "house",
							"template" => "community-zu",
							"id"       => $value['id']
						);
						$data[$bc]['url'] = getUrlPath($param);
						$bc++;
					}
				}

			}


		//区域数据
		}else{

			//所有一级区域
			$sql = $dsql->SetQuery("SELECT `id`, `typename`, `longitude`, `latitude` FROM `#@__houseaddr` WHERE `parentid` = 0 ORDER BY `weight`");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$kk = 0;
				foreach ($ret as $key => $value) {

					//单独请求二级区域数据
					if($bizcircle == 1){

						$addrSql = $dsql->SetQuery("SELECT `id`, `typename`, `longitude`, `latitude` FROM `#@__houseaddr` WHERE `parentid` = ".$value['id']." ORDER BY `weight`");
						$addrRet = $dsql->dsqlOper($addrSql, "results");
						foreach ($addrRet as $k => $v) {

							$nwhere = $where;

							//查询小区信息
							$cid = array();
							$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `addrid` = ".$v['id']);
							$results = $dsql->dsqlOper($archives, "results");
							if($results){
								foreach($results as $loupan){
									$cid[] = $loupan["id"];
								}
								//有结果
								if(!empty($cid)){
									$cid = join(",", $cid);
									$nwhere .= " AND s.`communityid` in ($cid)";
								//无结果
								}else{
									$nwhere .= " AND 1 = 2";
								}
							//无结果
							}else{
								$nwhere .= " AND 1 = 2";
							}

							$count = $price = 0;
							if($cid){
								$saleSql = $dsql->SetQuery("SELECT COUNT(s.`id`) count, AVG(s.`price`) price FROM `#@__house_zu` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`state` = 1".$nwhere);
								$saleRet = $dsql->dsqlOper($saleSql, "results");
								if($saleRet){
									$count = $saleRet[0]['count'];
									$price = sprintf("%.2f", $saleRet[0]['price']);
								}
							}

							if($count > 0){
								$data[$bc]['id']        = $v['id'];
								$data[$bc]['addrname']  = $v['typename'];
								$data[$bc]['longitude'] = $v['longitude'];
								$data[$bc]['latitude']  = $v['latitude'];
								$data[$bc]['count']     = $count;
								$data[$bc]['price']     = $price;
								$bc++;
							}

						}


					//只请求一级区域数据
					}else{
						$nwhere = $where;
						$ids = array($value['id']);

						$addrSql = $dsql->SetQuery("SELECT `id` FROM `#@__houseaddr` WHERE `parentid` = ".$value['id']." ORDER BY `weight`");
						$addrRet = $dsql->dsqlOper($addrSql, "results");
						foreach ($addrRet as $k => $v) {
							array_push($ids, $v['id']);
						}


						//查询小区信息
						$cid = array();
						$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_community` WHERE `state` = 1 AND `addrid` in (".join(",", $ids).")");
						$results = $dsql->dsqlOper($archives, "results");
						if($results){
							foreach($results as $loupan){
								$cid[] = $loupan["id"];
							}
							//有结果
							if(!empty($cid)){
								$cid = join(",", $cid);
								$nwhere .= " AND s.`communityid` in ($cid)";
							//无结果
							}else{
								$nwhere .= " AND 1 = 2";
							}
						//无结果
						}else{
							$nwhere .= " AND 1 = 2";
						}

						$count = $price = 0;

						if($cid){
							$saleSql = $dsql->SetQuery("SELECT COUNT(s.`id`) count, AVG(s.`price`) price FROM `#@__house_zu` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`state` = 1".$nwhere);
							$saleRet = $dsql->dsqlOper($saleSql, "results");
							if($saleRet){
								$count = $saleRet[0]['count'];
								$price = sprintf("%.2f", $saleRet[0]['price']);
							}
						}

						if($count > 0){
							$data[$kk]['id']        = $value['id'];
							$data[$kk]['addrname']  = $value['typename'];
							$data[$kk]['longitude'] = $value['longitude'];
							$data[$kk]['latitude']  = $value['latitude'];
							$data[$kk]['count']     = $count;
							$data[$kk]['price']     = $price;
							$kk++;
						}

					}

				}
			}

		}


		if($data){
			return $data;
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

	}


	/**
     * 出租房详细
     * @return array
     */
	public function zuDetail(){
		global $dsql;
		global $userLogin;
		$zuDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		$where = "";
		// if($userLogin->getUserID() == -1){
		//
		// 	$where = " AND s.`state` = 1";
		//
		// 	//如果没有登录再验证会员是否已经登录，为了实现会员修改信息功能
		// 	if($userLogin->getMemberID() == -1){
		// 		$where = " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
		// 	}else{
		// 		$where = " AND s.`userid` = ".$userLogin->getMemberID();
		// 	}
		//
		// }

		$archives = $dsql->SetQuery("SELECT s.* FROM `#@__house_zu` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$zuDetail["id"] = $results[0]['id'];
			$zuDetail["title"] = $results[0]['title'];

			//小区
			$zuDetail["communityid"] = $results[0]["communityid"];

			$addrid = $results[0]['addrid'];

			if($results[0]['communityid'] == 0){
				$zuDetail["community"] = $results[0]["community"];
				$addrName = getParentArr("houseaddr", $addrid);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$zuDetail['addr']      = $addrName;
				$zuDetail["address"]   = $results[0]["address"];
				$zuDetail["longitude"] = "";
				$zuDetail["latitude"]  = "";
			}else{
				$communitySql = $dsql->SetQuery("SELECT `id`, `title`, `addrid`, `addr`, `longitude`, `latitude` FROM `#@__house_community` WHERE `id` = ". $results[0]["communityid"]);
				$communityResult = $dsql->getTypeName($communitySql);
				if(!$communityResult){
					$zuDetail["community"] = "小区不存在";
					$zuDetail['addr']      = array();
					$zuDetail["address"]   = "";
					$zuDetail["longitude"] = "";
					$zuDetail["latitude"]  = "";
					$addrid = 0;
				}else{
					$zuDetail["community"] = $communityResult[0]["title"];
					$addrName = getParentArr("houseaddr", $communityResult[0]['addrid']);
					global $data;
					$data = "";
					$addrName = array_reverse(parent_foreach($addrName, "typename"));
					$zuDetail['addr']      = $addrName;
					$zuDetail["address"]   = $communityResult[0]["addr"];
					$zuDetail["longitude"] = $communityResult[0]["longitude"];
					$zuDetail["latitude"]  = $communityResult[0]["latitude"];
					$addrid                = $communityResult[0]["addrid"];
				}
			}

			$zuDetail["addrid"] = $addrid;


			//会员信息
			$userid = $results[0]['userid'];
			$userArr = array('userid' => $userid);
			$nickname = $photo = $phone = $certify = $flag = $zjcomName = $zjcomId = "";
			if($userid != 0 && $userid != -1){
				$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo`, m.`phone`, m.`certifyState`, zj.`flag`, zj.`zjcom`, zjcom.`title`, zjcom.`id` zjcomId FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` LEFT JOIN `#@__house_zjcom` zjcom ON zj.`zjcom` = zjcom.`id` WHERE zj.`state` = 1 AND zj.`id` = ".$userid);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$nickname  = $member[0]['nickname'];
					$photo     = getFilePath($member[0]['photo']);
					$phone     = $member[0]['phone'];
					$certify   = $member[0]['certify'];
					$flag      = $member[0]['flag'];
					$zjcomName = $member[0]['title'];
					$zjcomId   = $member[0]['zjcomId'];
				}
				$userArr['nickname']  = $nickname;
				$userArr['photo']     = $photo;
				$userArr['phone']     = $phone;
				$userArr['certify']   = $certify;
				$userArr['flag']      = $flag;
				$userArr['zjcomName'] = $zjcomName;
				$userArr['zjcomId']   = $zjcomId;
			}
			$zuDetail['user'] = $userArr;


			//父级区域
			$areaid = 0;
			$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$addrid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$areaid = $ret[0]['parentid'];
			}
			$zuDetail["areaid"]     = $areaid;

			$param = array(
				"service"     => "house",
				"template"    => "community-detail",
				"id"          => $results[0]['communityid']
			);
			$zuDetail['communityUrl'] = getUrlPath($param);

			$zuDetail["litpic"]    = getFilePath($results[0]['litpic']);
			$zuDetail["litpicSource"] = $results[0]['litpic'];
			$zuDetail["price"]     = $results[0]['price'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['paytype']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$paytype = $houseResult ? $houseResult[0]['typename'] : "";
			$zuDetail["paytype"]   = $paytype;
			$zuDetail["paytypeid"] = $results[0]['paytype'];

			$zuDetail["rentype"]   = $results[0]['rentype'] == 0 ? "整租" : "合租";

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['protype']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$protype = $houseResult ? $houseResult[0]['typename'] : "";
			$zuDetail["protype"]   = $protype;
			$zuDetail["protypeid"]   = $results[0]['protype'];

			$zuDetail["room"]      = $results[0]['room'];
			$zuDetail["hall"]      = $results[0]['hall'];
			$zuDetail["guard"]     = $results[0]['guard'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['sharetype']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$sharetype = $houseResult ? $houseResult[0]['typename'] : "";
			$zuDetail["sharetype"]   = $sharetype;
			$zuDetail["sharetypeid"]   = $results[0]['sharetype'];

			$zuDetail["sharesex"]  = $results[0]['sharesex'];
			$zuDetail["bno"]       = $results[0]['bno'];
			$zuDetail["floor"]     = $results[0]['floor'];
			$zuDetail["area"]      = $results[0]['area'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['direction']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$direction = $houseResult ? $houseResult[0]['typename'] : "";
			$zuDetail["direction"] = $direction;
			$zuDetail["directionid"]   = $results[0]['direction'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['zhuangxiu']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
			$zuDetail["zhuangxiu"] = $zhuangxiu;
			$zuDetail["zhuangxiuid"]   = $results[0]['zhuangxiu'];

			$zuDetail["buildage"] = $results[0]['buildage'];

			$config = array();
			if(!empty($results[0]['config'])){
				$configArr = explode(",", $results[0]['config']);
				$con = array();
				foreach($configArr as $c){
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$c);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$typename = $houseResult ? $houseResult[0]['typename'] : "";
					if(!empty($typename)){
						$con[] = $typename;
					}
				}
				if(!empty($con)){
					$config = $con;
				}
			}

			$zuDetail["config"] = $config;

			$zuDetail["usertype"] = $results[0]['usertype'];

			//个人会员
			if($userArr['nickname'] == ""){
				$zuDetail["userid"]   = $results[0]['userid'];

				//读取会员信息
				if($results[0]['userid'] && $results[0]['username'] == ""){

					$member = getMemberDetail($results[0]['userid']);
					$zuDetail["username"] = $member['nickname'];
					$zuDetail["contact"]  = $member['phone'];

				}else{
					$zuDetail["username"] = $results[0]['username'];
					$zuDetail["contact"]  = $results[0]['contact'];
				}

			}

			$zuDetail["note"]     = $results[0]['note'];
			$zuDetail["mbody"]    = $results[0]['mbody'];
			$zuDetail['timeUpdate'] = FloorTime(GetMkTime(time()) - $results[0]['pubdate']);

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$results[0]['id']." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $k => $v){
					$imglist[$k]["path"] = getFilePath($v["picPath"]);
					$imglist[$k]["pathSource"] = $v["picPath"];
					$imglist[$k]["info"] = $v["picInfo"];
				}
			}else{
				$imglist = array();
			}
			$zuDetail["imglist"]     = $imglist;
		}
		return $zuDetail;
	}


	/**
     * 写字楼列表
     * @return array
     */
	public function xzlList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$zj = $type = $addrid = $price = $area = $keywords = $protype = $usertype = $orderby = $u = $state = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$zj        = $this->param['zj'];
				$type      = $this->param['type'];
				$addrid    = $this->param['addrid'];
				$price     = $this->param['price'];
				$area      = $this->param['area'];
				$keywords  = $this->param['keywords'];
				$protype   = $this->param['protype'];
				$usertype  = $this->param['usertype'];
				$orderby   = $this->param['orderby'];
				$u         = $this->param['u'];
				$state     = $this->param['state'];
				$page      = $this->param['page'];
				$pageSize  = $this->param['pageSize'];
			}
		}

		//中介
		if($zj != ""){
			$where .= " AND s.`usertype` = 1 AND s.`userid` = " . $zj;
		}


		//是否输出当前登录会员的信息
		if($u != 1){
			// $where .= " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
			$where .= " AND s.`state` = 1";
		}else{
			$uid = $userLogin->getMemberID();
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$where .= " AND s.`userid` = ".$ret[0]['id'];
			}else{
				$where .= " AND s.`userid` = ".$uid;
			}

			if($state != ""){
				$where1 = " AND s.`state` = ".$state;
			}
		}

		//类型
		if($type != ""){
			$where .= " AND s.`type` = " . $type;
		}


		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}

			$where .= " AND s.`addrid` in ($lower)";

		}

		//价格区间
		if($price != ""){
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND s.`price` < " . $price[1];
			}elseif(empty($price[1])){
				$where .= " AND s.`price` > " . $price[0];
			}else{
				$where .= " AND s.`price` BETWEEN " . $price[0] . " AND " . $price[1];
			}
		}

		//面积
		if($area != ""){
			$area = explode(",", $area);
			if(empty($area[0])){
				$where .= " AND s.`area` < " . $area[1];
			}elseif(empty($area[1])){
				$where .= " AND s.`area` > " . $area[0];
			}else{
				$where .= " AND s.`area` BETWEEN " . $area[0] . " AND " . $area[1];
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (s.`title` like '%".$keywords."%' OR s.`loupan` like '%".$keywords."%' OR s.`address` like '%".$keywords."%')";
		}

		//物业类型
		if(!empty($protype)){
			$where .= " AND s.`protype` = $protype";
		}

		//性质
		if($usertype != ""){
			$where .= " AND s.`usertype` = $usertype";
		}

		if(!empty($orderby)){
			//发布时间
			if($orderby == 1){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`pubdate` DESC, s.`weight` DESC, s.`id` DESC";
			//面积降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` DESC, s.`weight` DESC, s.`id` DESC";
			//面积升序
			}elseif($orderby == 3){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` ASC, s.`weight` DESC, s.`id` DESC";
			//价格升序
			}elseif($orderby == 4){
				if($type == 0){
					$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, (s.`price` * s.`area`) ASC, s.`weight` DESC, s.`id` DESC";
				}else{
					$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` ASC, s.`weight` DESC, s.`id` DESC";
				}
			//价格降序
			}elseif($orderby == 5){
				if($type == 0){
					$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, (s.`price` * s.`area`) DESC, s.`weight` DESC, s.`id` DESC";
				}else{
					$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` DESC, s.`weight` DESC, s.`id` DESC";
				}
			}
		}else{
			$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`weight` DESC, s.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"s.`id`, s.`type`, s.`title`, s.`loupan`, s.`addrid`, s.`address`, s.`nearby`, s.`protype`, s.`area`, s.`litpic`, s.`price`, s.`zhuangxiu`, s.`userid`, s.`usertype`, s.`username`, s.`state`, s.`pubdate`, s.`config`, s.`isbid`, s.`bid_price`, s.`bid_end` " .
									"FROM `#@__house_xzl` s " .
									"WHERE " .
									"1 = 1".$where);

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

		//会员列表需要统计信息状态
		if($u == 1 && $userLogin->getMemberID() > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND s.`state` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND s.`state` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND s.`state` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']     = $val['id'];
				$list[$key]['type']   = $val['type'];
				$list[$key]['title']  = $val['title'];
				$list[$key]['loupan'] = $val['loupan'];
				$list[$key]['addrid'] = $val['addrid'];

				$addrName = getParentArr("houseaddr", $val['addrid']);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['addr']      = $addrName;

				$list[$key]['address']  = $val['address'];
				$list[$key]['nearby']  = $val['nearby'];

				$protype = explode(",", $val['protype']);
				$protypeArr = array();
				foreach ($protype as $k => $v) {
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
				}
				$list[$key]['protype'] = join(",", $protypeArr);

				$list[$key]['area']   = $val['area'];
				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['price']  = $val['price'];

				//会员信息
				$nickname = $userPhoto = "";
				if($val['userid'] != 0 && $val['userid'] != -1){
					$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo` FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` WHERE zj.`id` = ".$val['userid']);
					$member = $dsql->dsqlOper($archives, "results");
					if($member){
						$nickname  = $member[0]['nickname'];
						$userPhoto = getFilePath($member[0]['photo']);
					}else{
						$nickname  = "";
						$userPhoto = "";
					}
				}
				$list[$key]['userid']    = $val['userid'];
				$list[$key]['nickname']  = $nickname;
				$list[$key]['userPhoto'] = $userPhoto;

				//装修
				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['zhuangxiu']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
				$list[$key]['zhuangxiu']  = $zhuangxiu;

				$list[$key]['usertype']  = $val['usertype'];
				if($val['usertype'] == 0){
					$list[$key]['username'] = $val['username'];
				}

				//会员中心显示信息状态
				if($u == 1 && $userLogin->getMemberID() > -1){
					$list[$key]['state'] = $val['state'];

					//显示竞价结束时间、每日预算
					$list[$key]['bid_price'] = $val['bid_price'];
					$list[$key]['bid_end'] = $val['bid_end'];
				}

				$list[$key]['pubdate']  = $val['pubdate'];
				$list[$key]['isbid']  = $val['isbid'];
				$list[$key]['timeUpdate'] = FloorTime(GetMkTime(time()) - $val['pubdate']);

				$config = explode(",", $val['config']);
				$configArr = array();
				if(!empty($val['config'])){
					foreach ($config as $k => $v) {
						$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
						$houseResult = $dsql->dsqlOper($houseitem, "results");
						$configArr[] = $houseResult ? $houseResult[0]['typename'] : "";
					}
				}
				$list[$key]['config'] = $configArr;

				$param = array(
					"service"     => "house",
					"template"    => "xzl-detail",
					"id"          => $val['id']
				);
				$list[$key]['url']        = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 写字楼详细
     * @return array
     */
	public function xzlDetail(){
		global $dsql;
		global $userLogin;
		$xzlDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		$where = "";
		// if($userLogin->getUserID() == -1){
		//
		// 	$where = " AND s.`state` = 1";
		//
		// 	//如果没有登录再验证会员是否已经登录，为了实现会员修改信息功能
		// 	if($userLogin->getMemberID() == -1){
		// 		$where = " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
		// 	}else{
		// 		$where = " AND s.`userid` = ".$userLogin->getMemberID();
		// 	}
		//
		// }

		$archives = $dsql->SetQuery("SELECT s.* FROM `#@__house_xzl` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$xzlDetail["id"]     = $results[0]['id'];
			$xzlDetail["type"]   = $results[0]['type'];
			$xzlDetail["title"]  = $results[0]['title'];
			$xzlDetail["loupan"] = $results[0]['loupan'];
			$xzlDetail["addrid"] = $results[0]['addrid'];

			//会员信息
			$userid = $results[0]['userid'];
			$userArr = array('userid' => $userid);
			$nickname = $photo = $phone = $certify = $flag = $zjcomName = $zjcomId = "";
			if($userid != 0 && $userid != -1){
				$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo`, m.`phone`, m.`certifyState`, zj.`flag`, zj.`zjcom`, zjcom.`title`, zjcom.`id` zjcomId FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` LEFT JOIN `#@__house_zjcom` zjcom ON zj.`zjcom` = zjcom.`id` WHERE zj.`state` = 1 AND zj.`id` = ".$userid);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$nickname  = $member[0]['nickname'];
					$photo     = getFilePath($member[0]['photo']);
					$phone     = $member[0]['phone'];
					$certify   = $member[0]['certify'];
					$flag      = $member[0]['flag'];
					$zjcomName = $member[0]['title'];
					$zjcomId   = $member[0]['zjcomId'];
				}
				$userArr['nickname']  = $nickname;
				$userArr['photo']     = $photo;
				$userArr['phone']     = $phone;
				$userArr['certify']   = $certify;
				$userArr['flag']      = $flag;
				$userArr['zjcomName'] = $zjcomName;
				$userArr['zjcomId']   = $zjcomId;
			}
			$xzlDetail['user'] = $userArr;

			//父级区域
			$areaid = 0;
			$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$results[0]['addrid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$areaid = $ret[0]['parentid'];
			}
			$xzlDetail["areaid"] = $areaid;

			$addrName = getParentArr("houseaddr", $results[0]['addrid']);
			global $data;
			$data = "";
			$addrName = array_reverse(parent_foreach($addrName, "typename"));
			$xzlDetail['addr'] = $addrName;

			$xzlDetail["address"] = $results[0]['address'];
			$xzlDetail["nearby"]  = $results[0]['nearby'];
			$xzlDetail["litpic"]  = getFilePath($results[0]['litpic']);
			$xzlDetail["litpicSource"]  = $results[0]['litpic'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['protype']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$protype = $houseResult ? $houseResult[0]['typename'] : "";
			$xzlDetail["protype"]  = $protype;
			$xzlDetail["protypeid"]  = $results[0]['protype'];

			$xzlDetail["area"]     = $results[0]['area'];
			$xzlDetail["price"]    = $results[0]['price'];
			$xzlDetail["proprice"] = $results[0]['proprice'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['zhuangxiu']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
			$xzlDetail["zhuangxiu"]  = $zhuangxiu;
			$xzlDetail["zhuangxiuid"]  = $results[0]['zhuangxiu'];

			$xzlDetail["bno"]      = $results[0]['bno'];
			$xzlDetail["floor"]    = $results[0]['floor'];

			$xzlDetail["usertype"] = $results[0]['usertype'];

			//个人会员
			if($userArr['nickname'] == ""){
				$saleDetail["userid"]   = $results[0]['userid'];

				//读取会员信息
				if($results[0]['userid'] && $results[0]['username'] == ""){

					$member = getMemberDetail($results[0]['userid']);
					$xzlDetail["username"] = $member['nickname'];
					$xzlDetail["contact"]  = $member['phone'];

				}else{
					$xzlDetail["username"] = $results[0]['username'];
					$xzlDetail["contact"]  = $results[0]['contact'];
				}

			}

			// $xzlDetail["userid"]   = $results[0]['userid'];
			// $xzlDetail["username"] = $results[0]['username'];
			// $xzlDetail["contact"]  = $results[0]['contact'];
			$xzlDetail["note"]     = $results[0]['note'];
			$xzlDetail["mbody"]    = $results[0]['mbody'];
			$xzlDetail['pubdate']  = $results[0]['pubdate'];
			$xzlDetail['timeUpdate'] = FloorTime(GetMkTime(time()) - $results[0]['pubdate']);

			$config = explode(",", $results[0]['config']);
			$configArr = array();
			if(!empty($results[0]['config'])){
				foreach ($config as $k => $v) {
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$configArr[] = $houseResult ? $houseResult[0]['typename'] : "";
				}
			}
			$xzlDetail["config"]   = $configArr;

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housexzl' AND `aid` = ".$results[0]['id']." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $k => $v){
					$imglist[$k]["path"] = getFilePath($v["picPath"]);
					$imglist[$k]["pathSource"] = $v["picPath"];
					$imglist[$k]["info"] = $v["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$xzlDetail["imglist"] = $imglist;
		}
		return $xzlDetail;
	}


	/**
     * 商铺列表
     * @return array
     */
	public function spList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$zj = $type = $addrid = $price = $area = $keywords = $usertype = $protype = $industry = $orderby = $u = $state = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$zj        = $this->param['zj'];
				$type      = $this->param['type'];
				$addrid    = $this->param['addrid'];
				$price     = $this->param['price'];
				$area      = $this->param['area'];
				$keywords  = $this->param['keywords'];
				$usertype  = $this->param['usertype'];
				$protype   = $this->param['protype'];
				$industry  = $this->param['industry'];
				$orderby   = $this->param['orderby'];
				$u         = $this->param['u'];
				$state     = $this->param['state'];
				$page      = $this->param['page'];
				$pageSize  = $this->param['pageSize'];
			}
		}


		//是否输出当前登录会员的信息
		if($u != 1){
			// $where .= " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
			$where .= " AND s.`state` = 1";
		}else{
			$uid = $userLogin->getMemberID();
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$where .= " AND s.`userid` = ".$ret[0]['id'];
			}else{
				$where .= " AND s.`userid` = ".$uid;
			}

			if($state != ""){
				$where1 = " AND s.`state` = ".$state;
			}
		}

		//类型
		if($type != ""){
			$where .= " AND s.`type` = " . $type;
		}

		//中介
		if($zj != ""){
			$where .= " AND s.`usertype` = 1 AND s.`userid` = " . $zj;
		}

		//性质
		if($usertype != ""){
			$where .= " AND s.`usertype` = ".$usertype;
		}

		//类型
		if($protype != ""){
			$where .= " AND s.`protype` = ".$protype;
		}

		//行业
		if($industry != ""){
			$where .= " AND FIND_IN_SET($industry, s.`suitable`)";
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}

			$where .= " AND s.`addrid` in ($lower)";

		}

		//价格区间
		if($price != ""){
			$mu = $type == 1 ? 1 : 1000;
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND s.`price` < " . $price[1] * $mu;
			}elseif(empty($price[1])){
				$where .= " AND s.`price` > " . $price[0] * $mu;
			}else{
				$where .= " AND s.`price` BETWEEN " . $price[0] * $mu . " AND " . $price[1] * $mu;
			}
		}

		//面积
		if($area != ""){
			$area = explode(",", $area);
			if(empty($area[0])){
				$where .= " AND s.`area` < " . $area[1];
			}elseif(empty($area[1])){
				$where .= " AND s.`area` > " . $area[0];
			}else{
				$where .= " AND s.`area` BETWEEN " . $area[0] . " AND " . $area[1];
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (s.`title` like '%".$keywords."%' OR s.`address` like '%".$keywords."%')";
		}

		if(!empty($orderby)){
			//发布时间
			if($orderby == 1){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`pubdate` DESC, s.`weight` DESC, s.`id` DESC";
			//面积降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` DESC, s.`weight` DESC, s.`id` DESC";
			//面积升序
			}elseif($orderby == 3){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` ASC, s.`weight` DESC, s.`id` DESC";
			//价格升序
			}elseif($orderby == 4){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` ASC, s.`weight` DESC, s.`id` DESC";
			//价格降序
			}elseif($orderby == 5){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` DESC, s.`weight` DESC, s.`id` DESC";
			}
		}else{
			$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`weight` DESC, s.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"s.`id`, s.`type`, s.`title`, s.`addrid`, s.`address`, s.`nearby`, s.`protype`, s.`area`, s.`litpic`, s.`price`, s.`zhuangxiu`, s.`bno`, s.`floor`, s.`transfer`, s.`usertype`, s.`userid`, s.`username`, s.`state`, s.`pubdate`, s.`isbid`, s.`bid_price`, s.`bid_end` " .
									"FROM `#@__house_sp` s " .
									"WHERE " .
									"1 = 1".$where);

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

		//会员列表需要统计信息状态
		if($u == 1 && $userLogin->getMemberID() > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND s.`state` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND s.`state` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND s.`state` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']     = $val['id'];
				$list[$key]['type']   = $val['type'];
				$list[$key]['title']  = $val['title'];
				$list[$key]['addrid'] = $val['addrid'];

				$addrName = getParentArr("houseaddr", $val['addrid']);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['addr'] = $addrName;

				$list[$key]['address'] = $val['address'];
				$list[$key]['nearby']  = $val['nearby'];
				$list[$key]['bno']     = $val['bno'];
				$list[$key]['floor']   = $val['floor'];

				$protype = explode(",", $val['protype']);
				$protypeArr = array();
				foreach ($protype as $k => $v) {
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
				}
				$list[$key]['protype'] = join(",", $protypeArr);

				$list[$key]['area']   = $val['area'];
				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['price']  = $val['price'];

				//会员信息
				$nickname = $userPhoto = "";
				if($val['userid'] != 0 && $val['userid'] != -1){
					$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo` FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` WHERE zj.`id` = ".$val['userid']);
					$member = $dsql->dsqlOper($archives, "results");
					if($member){
						$nickname  = $member[0]['nickname'];
						$userPhoto = getFilePath($member[0]['photo']);
					}else{
						$nickname  = "";
						$userPhoto = "";
					}
				}
				$list[$key]['userid']    = $val['userid'];
				$list[$key]['nickname']  = $nickname;
				$list[$key]['userPhoto'] = $userPhoto;

				//装修
				$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$val['zhuangxiu']);
				$houseResult = $dsql->dsqlOper($houseitem, "results");
				$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
				$list[$key]['zhuangxiu']  = $zhuangxiu;

				$list[$key]['usertype']  = $val['usertype'];
				if($val['usertype'] == 0){
					$list[$key]['username'] = $val['username'];
				}

				//转让费
				if($val['type'] == 2){
					$list[$key]['transfer'] = $val['transfer'];
				}

				//会员中心显示信息状态
				if($u == 1 && $userLogin->getMemberID() > -1){
					$list[$key]['state'] = $val['state'];

					//显示竞价结束时间、每日预算
					$list[$key]['bid_price'] = $val['bid_price'];
					$list[$key]['bid_end'] = $val['bid_end'];
				}

				$list[$key]['pubdate'] = $val['pubdate'];
				$list[$key]['isbid'] = $val['isbid'];
				$list[$key]['timeUpdate'] = FloorTime(GetMkTime(time()) - $val['pubdate']);

				$param = array(
					"service"     => "house",
					"template"    => "sp-detail",
					"id"          => $val['id']
				);
				$list[$key]['url'] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 商铺详细
     * @return array
     */
	public function spDetail(){
		global $dsql;
		global $userLogin;
		$spDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		$where = "";
		// if($userLogin->getUserID() == -1){
		//
		// 	$where = " AND s.`state` = 1";
		//
		// 	//如果没有登录再验证会员是否已经登录，为了实现会员修改信息功能
		// 	if($userLogin->getMemberID() == -1){
		// 		$where = " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
		// 	}else{
		// 		$where = " AND s.`userid` = ".$userLogin->getMemberID();
		// 	}
		//
		// }

		$archives = $dsql->SetQuery("SELECT s.* FROM `#@__house_sp` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$spDetail["id"]     = $results[0]['id'];
			$spDetail["type"]   = $results[0]['type'];
			$spDetail["industryid"] = $results[0]['industry'];

			$industryName = array();
			if($results[0]['type'] == 2){
				$industryName = getParentArr("house_industry", $results[0]['industry']);
				global $data;
				$data = "";
				$industryName = array_reverse(parent_foreach($industryName, "typename"));
				$spDetail['industry'] = $industryName;
			}

			$spDetail["title"]  = $results[0]['title'];
			$spDetail["addrid"] = $results[0]['addrid'];

			//会员信息
			$userid = $results[0]['userid'];
			$userArr = array('userid' => $userid);
			$nickname = $photo = $phone = $certify = $flag = $zjcomName = $zjcomId = "";
			if($userid != 0 && $userid != -1){
				$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo`, m.`phone`, m.`certifyState`, zj.`flag`, zj.`zjcom`, zjcom.`title`, zjcom.`id` zjcomId FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` LEFT JOIN `#@__house_zjcom` zjcom ON zj.`zjcom` = zjcom.`id` WHERE zj.`state` = 1 AND zj.`id` = ".$userid);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$nickname  = $member[0]['nickname'];
					$photo     = getFilePath($member[0]['photo']);
					$phone     = $member[0]['phone'];
					$certify   = $member[0]['certify'];
					$flag      = $member[0]['flag'];
					$zjcomName = $member[0]['title'];
					$zjcomId   = $member[0]['zjcomId'];
				}
				$userArr['nickname']  = $nickname;
				$userArr['photo']     = $photo;
				$userArr['phone']     = $phone;
				$userArr['certify']   = $certify;
				$userArr['flag']      = $flag;
				$userArr['zjcomName'] = $zjcomName;
				$userArr['zjcomId']   = $zjcomId;
			}
			$spDetail['user'] = $userArr;

			//父级区域
			$areaid = 0;
			$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$results[0]['addrid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$areaid = $ret[0]['parentid'];
			}
			$spDetail["areaid"] = $areaid;

			$addrName = getParentArr("houseaddr", $results[0]['addrid']);
			global $data;
			$data = "";
			$addrName = array_reverse(parent_foreach($addrName, "typename"));
			$spDetail['addr'] = $addrName;

			$spDetail["address"] = $results[0]['address'];
			$spDetail["nearby"]  = $results[0]['nearby'];
			$spDetail["litpic"]  = getFilePath($results[0]['litpic']);
			$spDetail["litpicSource"]  = $results[0]['litpic'];
			$spDetail["proprice"]  = $results[0]['proprice'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['protype']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$protype = $houseResult ? $houseResult[0]['typename'] : "";
			$spDetail["protype"]  = $protype;
			$spDetail["protypeid"]  = $results[0]['protype'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['zhuangxiu']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$zhuangxiu = $houseResult ? $houseResult[0]['typename'] : "";
			$spDetail["zhuangxiu"]  = $zhuangxiu;
			$spDetail["zhuangxiuid"]  = $results[0]['zhuangxiu'];

			$spDetail["bno"]      = $results[0]['bno'];
			$spDetail["floor"]    = $results[0]['floor'];

			//适合经营的行业
			$suitable = "";
			if(!empty($results[0]['suitable'])){
				$suitableArr = explode(",", $results[0]['suitable']);
				$con = array();
				foreach($suitableArr as $c){
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__house_industry` WHERE `id` = ".$c);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$typename = $houseResult ? $houseResult[0]['typename'] : "";
					if(!empty($typename)){
						$con[] = $typename;
					}
				}
				if(!empty($con)){
					$suitable = join(",", $con);
				}
			}

			$spDetail["suitable"] = $suitable;

			//配套设施
			$config = "";
			if(!empty($results[0]['config'])){
				$configArr = explode(",", $results[0]['config']);
				$con = array();
				foreach($configArr as $c){
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$c);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$typename = $houseResult ? $houseResult[0]['typename'] : "";
					if(!empty($typename)){
						$con[] = $typename;
					}
				}
				if(!empty($con)){
					$config = join(",", $con);
				}
			}

			$spDetail["config"] = $config;

			$spDetail["area"]     = $results[0]['area'];
			$spDetail["price"]    = $results[0]['price'];
			$spDetail["transfer"] = $results[0]['transfer'];
			$spDetail["usertype"] = $results[0]['usertype'];

			//个人会员
			if($userArr['nickname'] == ""){
				$saleDetail["userid"]   = $results[0]['userid'];

				//读取会员信息
				if($results[0]['userid'] && $results[0]['username'] == ""){

					$member = getMemberDetail($results[0]['userid']);
					$spDetail["username"] = $member['nickname'];
					$spDetail["contact"]  = $member['phone'];

				}else{
					$spDetail["username"] = $results[0]['username'];
					$spDetail["contact"]  = $results[0]['contact'];
				}

			}

			// $spDetail["userid"]   = $results[0]['userid'];
			// $spDetail["username"] = $results[0]['username'];
			// $spDetail["contact"]  = $results[0]['contact'];
			$spDetail["note"]     = $results[0]['note'];
			$spDetail["mbody"]    = $results[0]['mbody'];
			$spDetail["pubdate"]  = $results[0]['pubdate'];
			$spDetail['timeUpdate'] = FloorTime(GetMkTime(time()) - $results[0]['pubdate']);

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housesp' AND `aid` = ".$results[0]['id']." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $k => $v){
					$imglist[$k]["path"] = getFilePath($v["picPath"]);
					$imglist[$k]["pathSource"] = $v["picPath"];
					$imglist[$k]["info"] = $v["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$spDetail["imglist"] = $imglist;
		}
		return $spDetail;
	}


	/**
     * 厂房/仓库列表
     * @return array
     */
	public function cfList(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$zj = $type = $addrid = $price = $area = $keywords = $usertype = $orderby = $u = $state = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$zj        = $this->param['zj'];
				$type      = $this->param['type'];
				$addrid    = $this->param['addrid'];
				$price     = $this->param['price'];
				$area      = $this->param['area'];
				$keywords  = $this->param['keywords'];
				$usertype  = $this->param['usertype'];
				$orderby   = $this->param['orderby'];
				$u         = $this->param['u'];
				$state     = $this->param['state'];
				$page      = $this->param['page'];
				$pageSize  = $this->param['pageSize'];
			}
		}


		//是否输出当前登录会员的信息
		if($u != 1){
			// $where .= " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
			$where .= " AND s.`state` = 1";
		}else{
			$uid = $userLogin->getMemberID();
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$where .= " AND s.`userid` = ".$ret[0]['id'];
			}else{
				$where .= " AND s.`userid` = ".$uid;
			}

			if($state != ""){
				$where1 = " AND s.`state` = ".$state;
			}
		}

		//中介
		if($zj != ""){
			$where .= " AND s.`usertype` = 1 AND s.`userid` = " . $zj;
		}

		//类型
		if($type != ""){
			$where .= " AND s.`type` = " . $type;
		}

		//性质
		if($usertype != ""){
			$where .= " AND s.`usertype` = " . $usertype;
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "houseaddr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "houseaddr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}

			$where .= " AND s.`addrid` in ($lower)";

		}

		//价格区间
		if($price != ""){
			$mu = $type == 2 ? 10000 : 1000;
			$price = explode(",", $price);
			if(empty($price[0])){
				$where .= " AND s.`price` < " . $price[1] * $mu;
			}elseif(empty($price[1])){
				$where .= " AND s.`price` > " . $price[0] * $mu;
			}else{
				$where .= " AND s.`price` BETWEEN " . $price[0] * $mu . " AND " . $price[1] * $mu;
			}
		}

		//面积
		if($area != ""){
			$area = explode(",", $area);
			if(empty($area[0])){
				$where .= " AND s.`area` < " . $area[1];
			}elseif(empty($area[1])){
				$where .= " AND s.`area` > " . $area[0];
			}else{
				$where .= " AND s.`area` BETWEEN " . $area[0] . " AND " . $area[1];
			}
		}

		//关键字
		if(!empty($keywords)){
			$where .= " AND (s.`title` like '%".$keywords."%' OR s.`address` like '%".$keywords."%')";
		}

		if(!empty($orderby)){
			//发布时间
			if($orderby == 1){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`pubdate` DESC, s.`weight` DESC, s.`id` DESC";
			//面积降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` DESC, s.`weight` DESC, s.`id` DESC";
			//面积升序
			}elseif($orderby == 3){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`area` ASC, s.`weight` DESC, s.`id` DESC";
			//价格升序
			}elseif($orderby == 4){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` ASC, s.`weight` DESC, s.`id` DESC";
			//价格降序
			}elseif($orderby == 5){
				$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`price` DESC, s.`weight` DESC, s.`id` DESC";
			}
		}else{
			$orderby = " ORDER BY s.`isbid` DESC, s.`bid_price` DESC, s.`bid_start` ASC, s.`weight` DESC, s.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT " .
									"s.`id`, s.`type`, s.`title`, s.`addrid`, s.`address`, s.`nearby`, s.`protype`, s.`area`, s.`litpic`, s.`price`, s.`transfer`, s.`usertype`, s.`userid`, s.`username`, s.`state`, s.`pubdate`, s.`isbid`, s.`bid_price`, s.`bid_end` " .
									"FROM `#@__house_cf` s " .
									"WHERE " .
									"1 = 1".$where);

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

		//会员列表需要统计信息状态
		if($u == 1 && $userLogin->getMemberID() > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND s.`state` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND s.`state` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND s.`state` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where1.$orderby.$where, "results");
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id']    = $val['id'];
				$list[$key]['type']  = $val['type'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['addrid'] = $val['addrid'];

				$addrName = getParentArr("houseaddr", $val['addrid']);
				global $data;
				$data = "";
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['addr'] = $addrName;

				$list[$key]['address'] = $val['address'];
				$list[$key]['nearby']  = $val['nearby'];

				$protype = explode(",", $val['protype']);
				$protypeArr = array();
				foreach ($protype as $k => $v) {
					$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$v);
					$houseResult = $dsql->dsqlOper($houseitem, "results");
					$protypeArr[] = $houseResult ? $houseResult[0]['typename'] : "";
				}
				$list[$key]['protype']    = join(",", $protypeArr);

				$list[$key]['area']  = $val['area'];
				$list[$key]['litpic'] = getFilePath($val['litpic']);
				$list[$key]['price']  = $val['price'];

				if($val['type'] == 1){
					$list[$key]['transfer']     = $val['transfer'];
				}

				//会员中心显示信息状态
				if($u == 1 && $userLogin->getMemberID() > -1){
					$list[$key]['state'] = $val['state'];

					//显示竞价结束时间、每日预算
					$list[$key]['bid_price'] = $val['bid_price'];
					$list[$key]['bid_end'] = $val['bid_end'];
				}


				$list[$key]['usertype']  = $val['usertype'];
				if($val['usertype'] == 0){
					$list[$key]['username'] = $val['username'];
				}

				//会员信息
				$nickname = $userPhoto = "";
				if($val['userid'] != 0 && $val['userid'] != -1){
					$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo` FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` WHERE zj.`id` = ".$val['userid']);
					$member = $dsql->dsqlOper($archives, "results");
					if($member){
						$nickname  = $member[0]['nickname'];
						$userPhoto = getFilePath($member[0]['photo']);
					}else{
						$nickname  = "";
						$userPhoto = "";
					}
				}
				$list[$key]['userid']    = $val['userid'];
				$list[$key]['nickname']  = $nickname;
				$list[$key]['userPhoto'] = $userPhoto;
				$list[$key]['pubdate'] = $val['pubdate'];
				$list[$key]['isbid'] = $val['isbid'];
				$list[$key]['timeUpdate'] = FloorTime(GetMkTime(time()) - $val['pubdate']);


				$param = array(
					"service"  => "house",
					"template" => "cf-detail",
					"id"       => $val['id']
				);
				$list[$key]['url']        = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 厂房/仓库详细
     * @return array
     */
	public function cfDetail(){
		global $dsql;
		global $userLogin;
		$cfDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		$where = "";
		// if($userLogin->getUserID() == -1){
		//
		// 	$where = " AND s.`state` = 1";
		//
		// 	//如果没有登录再验证会员是否已经登录，为了实现会员修改信息功能
		// 	if($userLogin->getMemberID() == -1){
		// 		$where = " AND s.`state` = 1 AND (s.`usertype` = 0 OR (s.`usertype` = 1 AND s.`userid` = z.`id` AND z.`state` = 1))";
		// 	}else{
		// 		$where = " AND s.`userid` = ".$userLogin->getMemberID();
		// 	}
		//
		// }

		$archives = $dsql->SetQuery("SELECT s.* FROM `#@__house_cf` s LEFT JOIN `#@__house_zjuser` z ON z.`id` = s.`userid` WHERE s.`id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$cfDetail["id"]     = $results[0]['id'];
			$cfDetail["type"]   = $results[0]['type'];
			$cfDetail["title"]  = $results[0]['title'];
			$cfDetail["addrid"] = $results[0]['addrid'];

			//会员信息
			$userid = $results[0]['userid'];
			$userArr = array('userid' => $userid);
			$nickname = $photo = $phone = $certify = $flag = $zjcomName = $zjcomId = "";
			if($userid != 0 && $userid != -1){
				$archives = $dsql->SetQuery("SELECT m.`nickname`, m.`photo`, m.`phone`, m.`certifyState`, zj.`flag`, zj.`zjcom`, zjcom.`title`, zjcom.`id` zjcomId FROM `#@__member` m LEFT JOIN `#@__house_zjuser` zj ON zj.`userid` = m.`id` LEFT JOIN `#@__house_zjcom` zjcom ON zj.`zjcom` = zjcom.`id` WHERE zj.`state` = 1 AND zj.`id` = ".$userid);
				$member = $dsql->dsqlOper($archives, "results");
				if($member){
					$nickname  = $member[0]['nickname'];
					$photo     = getFilePath($member[0]['photo']);
					$phone     = $member[0]['phone'];
					$certify   = $member[0]['certify'];
					$flag      = $member[0]['flag'];
					$zjcomName = $member[0]['title'];
					$zjcomId   = $member[0]['zjcomId'];
				}
				$userArr['nickname']  = $nickname;
				$userArr['photo']     = $photo;
				$userArr['phone']     = $phone;
				$userArr['certify']   = $certify;
				$userArr['flag']      = $flag;
				$userArr['zjcomName'] = $zjcomName;
				$userArr['zjcomId']   = $zjcomId;
			}
			$cfDetail['user'] = $userArr;

			//父级区域
			$areaid = 0;
			$sql = $dsql->SetQuery("SELECT `parentid` FROM `#@__houseaddr` WHERE `id` = ".$results[0]['addrid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$areaid = $ret[0]['parentid'];
			}
			$cfDetail["areaid"] = $areaid;

			$addrName = getParentArr("houseaddr", $results[0]['addrid']);
			global $data;
			$data = "";
			$addrName = array_reverse(parent_foreach($addrName, "typename"));
			$cfDetail['addr'] = $addrName;

			$cfDetail["address"] = $results[0]['address'];
			$cfDetail["nearby"]  = $results[0]['nearby'];
			$cfDetail["litpic"]  = getFilePath($results[0]['litpic']);
			$cfDetail["litpicSource"]  = $results[0]['litpic'];

			$houseitem = $dsql->SetQuery("SELECT `typename` FROM `#@__houseitem` WHERE `id` = ".$results[0]['protype']);
			$houseResult = $dsql->dsqlOper($houseitem, "results");
			$protype = $houseResult ? $houseResult[0]['typename'] : "";
			$cfDetail["protype"]  = $protype;

			$cfDetail["area"]     = $results[0]['area'];
			$cfDetail["price"]    = $results[0]['price'];
			$cfDetail["transfer"] = $results[0]['transfer'];
			$cfDetail["usertype"] = $results[0]['usertype'];

			//个人会员
			if($userArr['nickname'] == ""){
				$saleDetail["userid"]   = $results[0]['userid'];

				//读取会员信息
				if($results[0]['userid'] && $results[0]['username'] == ""){

					$member = getMemberDetail($results[0]['userid']);
					$cfDetail["username"] = $member['nickname'];
					$cfDetail["contact"]  = $member['phone'];

				}else{
					$cfDetail["username"] = $results[0]['username'];
					$cfDetail["contact"]  = $results[0]['contact'];
				}

			}

			// $cfDetail["userid"]   = $results[0]['userid'];
			// $cfDetail["username"] = $results[0]['username'];
			// $cfDetail["contact"]  = $results[0]['contact'];
			$cfDetail["note"]     = $results[0]['note'];
			$cfDetail["mbody"]    = $results[0]['mbody'];
			$cfDetail["pubdate"]  = $results[0]['pubdate'];
			$cfDetail['timeUpdate'] = FloorTime(GetMkTime(time()) - $results[0]['pubdate']);

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_pic` WHERE `type` = 'housecf' AND `aid` = ".$results[0]['id']." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $k => $v){
					$imglist[$k]["path"] = getFilePath($v["picPath"]);
					$imglist[$k]["pathSource"] = $v["picPath"];
					$imglist[$k]["info"] = $v["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$cfDetail["imglist"] = $imglist;
		}
		return $cfDetail;
	}


	/**
     * 房产资讯
     * @return array
     */
	public function news(){
		global $dsql;
		$pageinfo = $list = array();
		$typeid = $litpic = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$litpic   = $this->param['litpic'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "house_newstype")){
				$lower = arr_foreach($dsql->getTypeList($typeid, "house_newstype"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		if($litpic == 1){
			$where .= " AND `litpic` <> ''";
		}

		$o = " ORDER BY `weight` DESC, `id` DESC";
		if($orderby == "click"){
			$o = " ORDER BY `click` ASC, `weight` DESC, `id` DESC";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `typeid`, `click`, `litpic`, `writer`, `description`, `pubdate` FROM `#@__house_news` WHERE `arcrank` = 0".$where.$o);
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
		$list = array();
		foreach($results as $key => $val){
			$list[$key]['index']   = $key+1;
			$list[$key]['id']      = $val['id'];
			$list[$key]['title']   = $val['title'];
			$list[$key]['typeid']  = $val['typeid'];
			$list[$key]['click']   = $val['click'];
			$list[$key]['writer']  = $val['writer'];
			$list[$key]['description'] = $val['description'];
			$list[$key]['litpic']  = !empty($val['litpic']) ? getFilePath($val['litpic']) : "";
			$list[$key]['pubdate'] = $val['pubdate'];

			$param = array(
				"service"     => "house",
				"template"    => "news-detail",
				"id"          => $val['id']
			);
			$list[$key]['url']     = getUrlPath($param);
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 房产资讯信息详细
     * @return array
     */
	public function newsDetail(){
		global $dsql;
		$newsDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '信息ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_news` WHERE `arcrank` = 0 AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$newsDetail["id"]          = $results[0]['id'];
			$newsDetail["title"]       = $results[0]['title'];
			$newsDetail["typeid"]      = $results[0]['typeid'];

			$typename = "";
			if(!empty($results[0]['typeid'])){
				global $data;
				$data = "";
				$typeArr = getParentArr("house_newstype", $results[0]['typeid']);
				$typeArr = array_reverse(parent_foreach($typeArr, "typename"));
				$typename = join("", $typeArr);
			}
			$newsDetail["typename"]   = $typename;

			$newsDetail["litpic"]      = getFilePath($results[0]['litpic']);
			$newsDetail["click"]       = $results[0]['click'];
			$newsDetail["source"]      = $results[0]['source'];
			$newsDetail["writer"]      = $results[0]['writer'];
			$newsDetail["keyword"]     = $results[0]['keyword'];
			$newsDetail["description"] = $results[0]['description'];
			$newsDetail["body"]        = $results[0]['body'];
			$newsDetail["pubdate"]     = $results[0]['pubdate'];
		}
		return $newsDetail;
	}


	/**
     * 房产资讯分类
     * @return array
     */
	public function newsType(){
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
		$results = $dsql->getTypeList($type, "house_newstype", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 房产问答
     * @return array
     */
	public function faq(){
		global $dsql;
		$pageinfo = $list = array();
		$typeid = $keywords = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$keywords = $this->param['keywords'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "house_faqtype")){
				$lower = arr_foreach($dsql->getTypeList($typeid, "house_faqtype"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		if(!empty($keywords)){
			$where .= " AND `title` like '%".$keywords."%'";
		}

		$o = " ORDER BY `id` DESC";
		if($orderby == "click"){
			$o = " ORDER BY `click` ASC, `id` DESC";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `typeid`, `click`, `pubdate` FROM `#@__house_faq` WHERE `state` = 0".$where.$o);
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
		$list = array();
		foreach($results as $key => $val){
			$list[$key]['id']      = $val['id'];
			$list[$key]['title']   = $val['title'];
			$list[$key]['typeid']  = $val['typeid'];

			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__house_faqtype` WHERE `id` = ".$val['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$list[$key]['typename'] = $ret[0]['typename'];
			}else{
				$list[$key]['typename'] = "";
			}
			$list[$key]['click']   = $val['click'];
			$list[$key]['pubdate'] = $val['pubdate'];

			$param = array(
				"service"     => "house",
				"template"    => "faq-detail",
				"id"          => $val['id']
			);
			$list[$key]['url'] = getUrlPath($param);
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 房产问答信息详细
     * @return array
     */
	public function faqDetail(){
		global $dsql;
		$newsDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '信息ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__house_faq` WHERE `state` = 0 AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$newsDetail["id"]          = $results[0]['id'];
			$newsDetail["title"]       = $results[0]['title'];
			$newsDetail["typeid"]      = $results[0]['typeid'];

			$typename = array();
			if(!empty($results[0]['typeid'])){
				global $data;
				$data = "";
				$typeArr = getParentArr("house_faqtype", $results[0]['typeid']);
				$typeArr = array_reverse(parent_foreach($typeArr, "typename"));
				$typename = $typeArr;
			}
			$newsDetail["typename"]   = $typename;

			$newsDetail["click"]      = $results[0]['click'];
			$newsDetail["people"]     = $results[0]['people'];
			$newsDetail["body"]       = $results[0]['body'];
			$newsDetail["pubdate"]    = $results[0]['pubdate'];
		}
		return $newsDetail;
	}


	/**
     * 房产问答分类
     * @return array
     */
	public function faqType(){
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
		$results = $dsql->getTypeList($type, "house_faqtype", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
	 * 提交问答
	 *
	 */
	public function fabuFaq(){
		global $dsql;
		global $userLogin;

		$param  = $this->param;
		$body   = cn_substrR(filterSensitiveWords(addslashes($param['body'])), 200);
		$people = cn_substrR(filterSensitiveWords(addslashes($param['people'])), 10);
		$phone  = cn_substrR(filterSensitiveWords(addslashes($param['phone'])), 11);
		$date   = GetMkTime(time());

		if(empty($body)) return array("state" => 101, "info" => '请填写要咨询的问题！');
		if(empty($people)) return array("state" => 101, "info" => '请填写您的姓名！');
		if(empty($phone)) return array("state" => 101, "info" => '请填写联系电话！');

		$sql = $dsql->SetQuery("INSERT INTO `#@__house_faq` (`typeid`, `title`, `body`, `people`, `phone`, `state`, `pubdate`) VALUES (0, '$body', '', '$people', '$phone', '1', '$date')");
		$ret = $dsql->dsqlOper($sql, "update");
		if($ret != "ok"){
			return array("state" => 101, "info" => '提交失败，请稍候重试！');
		}else{
			return '提交成功！';
		}

	}



	/**
		* 模糊匹配商业地产已添加的楼盘数据
		* @return array
		*/
	public function autoCompleteLoupan(){
		global $dsql;
		$type = $title = $addr = $pageSize = $where = "";
		$param = $this->param;
		$list = array();

		if(empty($param)){
			return array("state" => 200, "info" => '格式错误！');
		}

		$type     = $param['type'];
		$title    = $param['title'];
		$addrid   = $param['addrid'];
		$pageSize = $param['pageSize'];

		if(empty($type)) return array("state" => 200, "info" => '格式错误！');

		$pageSize = empty($pageSize) ? 10 : $pageSize;

		if(!empty($title)){
			$where .= " AND `loupan` like '%$title%'";
		}

		//遍历区域
		if(!empty($addrid)){
			$addrArr = $dsql->getTypeList($addrid, "houseaddr");
			if($addrArr){
				$lower = arr_foreach($addrArr);
				$lower = $addrid.",".join(',',$lower);
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addrid` in ($lower)";
		}

		$archives = $dsql->SetQuery("SELECT `loupan`, `addrid`, `address` FROM `#@__house_".$type."` WHERE `state` = 1".$where." LIMIT 0, $pageSize");
		$results = $dsql->dsqlOper($archives, "results");
		$list = array();
		foreach($results as $key => $val){

			if(!in_array($val['loupan'], $list)){

				$list[$key]['loupan']  = $val['loupan'];
				$list[$key]['addrid']  = $val['addrid'];
				$list[$key]['address'] = $val['address'];

				global $data;
				$data = "";
				$addrName = getParentArr("houseaddr", $val['addrid']);
				$addrName = array_reverse(parent_foreach($addrName, "typename"));
				$list[$key]['addrName'] = join(" > ", $addrName);
			}

		}

		if($list){
			return $list;
		}
	}


	/**
		* 发布房源
		* @return array
		*/
	public function put(){
		global $dsql;
		global $userLogin;

		$param   = $this->param;
		$type    = $param['type'];
		$title   = filterSensitiveWords(addslashes($param['title']));
		$vdimgck = strtolower($param['vdimgck']);

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($title)) return array("state" => 200, "info" => '请输入标题');
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		$title  = cn_substrR($title, 50);

		//判断是否经纪人
		$usertype = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$usertype = 1;
			$uid = $ret[0]['id'];
		}

		//求租、求购
		if($type == "demand"){

			$category = $param['category'];
			$note     = filterSensitiveWords(addslashes($param['note']));
			$lei      = $param['lei'];
			$addrid   = $param['addrid'];
			$person   = filterSensitiveWords(addslashes($param['person']));
			$contact  = filterSensitiveWords($param['contact']);

			if($category == "") return array("state" => 200, "info" => '请选择供求分类');
			if(empty($note)) return array("state" => 200, "info" => '请输入描述');
			if(empty($lei)) return array("state" => 200, "info" => '请选择类别分类');
			if(empty($addrid)) return array("state" => 200, "info" => '请选择所在区域');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($contact)) return array("state" => 200, "info" => '请输入手机号码');

			$note    = cn_substrR($note, 500);
			$person  = cn_substrR($person, 10);
			$contact = cn_substrR($contact, 11);

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__housedemand` (`title`, `note`, `action`, `type`, `addr`, `person`, `contact`, `userid`, `state`, `pubdate`) VALUES ('$title', '$note', '$lei', '$category', '$addrid', '$person', '$contact', '$uid', '0', ".GetMkTime(time()).")");
			$aid = $dsql->dsqlOper($archives, "lastid");
			if(is_numeric($aid)){
				return $aid;
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//二手房
		}elseif($type == "sale"){

			$community   = filterSensitiveWords(addslashes($param['community']));
			$communityid = $param['communityid'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$room        = (int)$param['room'];
			$hall        = (int)$param['hall'];
			$guard       = (int)$param['guard'];
			$area        = (float)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$buildage    = (int)$param['buildage'];
			$price       = (float)$param['price'];
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$direction   = (int)$param['direction'];
			$flag        = !empty($_POST['flag']) ? join(",", $_POST['flag']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($community) && empty($communityid)) return array("state" => 200, "info" => '请输入小区名称');
			if(empty($communityid) && empty($addrid)) return array("state" => 200, "info" => '请选择小区所在区域');
			if(empty($communityid) && empty($address)) return array("state" => 200, "info" => '请输入小区详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传房源代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			//if($area == 0) return array("state" => 200, "info" => '房源面积必须为整数，不得为0');
			//if($price == 0) return array("state" => 200, "info" => '房源价格必须为整数，不得为0');

			$unitprice = floor($price * 10000 / $area);   //单价

			$community = cn_substrR($community, 60);
			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();

			//保存到表
			$archives = $dsql->SetQuery("INSERT INTO `#@__house_sale` (`title`, `communityid`, `community`, `addrid`, `address`, `litpic`, `price`, `unitprice`, `protype`, `room`, `hall`, `guard`, `bno`, `floor`, `area`, `direction`, `zhuangxiu`, `buildage`, `usertype`, `userid`, `username`, `contact`, `note`, `mbody`, `state`, `flag`, `pubdate`) VALUES ('$title', '$communityid', '$community', '$addrid', '$address', '$litpic', '$price', '$unitprice', '$protype', '$room', '$hall', '$guard', '$bno', '$floor', '$area', '$direction', '$zhuangxiu', '$buildage', '$usertype', '$uid', '$person', '$tel', '$note', '', '0', '$flag', '".GetMkTime(time())."')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",",$imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housesale', '$aid', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("house", "sale");

				return $aid;
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//租房
		}elseif($type == "zu"){

			$community   = filterSensitiveWords(addslashes($param['community']));
			$communityid = $param['communityid'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$rentype     = (int)$param['rentype'];
			$sharetype   = (int)$param['sharetype'];
			$sharesex    = (int)$param['sharesex'];
			$room        = (int)$param['room'];
			$hall        = (int)$param['hall'];
			$guard       = (int)$param['guard'];
			$area        = (float)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$buildage    = (int)$param['buildage'];
			$price       = (float)$param['price'];
			$paytype     = (int)$param['paytype'];
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$direction   = (int)$param['direction'];
			$config        = !empty($_POST['config']) ? join(",", $_POST['config']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($community) && empty($communityid)) return array("state" => 200, "info" => '请输入小区名称');
			if(empty($communityid) && empty($addrid)) return array("state" => 200, "info" => '请选择小区所在区域');
			if(empty($communityid) && empty($address)) return array("state" => 200, "info" => '请输入小区详细地址');
			if($rentype == 1 && $sharetype == 0) return array("state" => 200, "info" => '请选择要出租的房间');
			if($rentype == 1 && $sharesex === "") return array("state" => 200, "info" => '请选择合租男女限制');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传房源代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');
			//if($area == 0) return array("state" => 200, "info" => '房源面积必须为整数，不得为0');
			//if($price == 0) return array("state" => 200, "info" => '房源价格必须为整数，不得为0');
			if($paytype == 0) return array("state" => 200, "info" => '请选择租金压付方式');

			$community = cn_substrR($community, 60);
			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();

			//保存到表
			$archives = $dsql->SetQuery("INSERT INTO `#@__house_zu` (`title`, `communityid`, `community`, `addrid`, `address`, `paytype`, `rentype`, `sharetype`, `sharesex`, `litpic`, `price`, `protype`, `room`, `hall`, `guard`, `bno`, `floor`, `area`, `direction`, `zhuangxiu`, `buildage`, `usertype`, `userid`, `username`, `contact`, `note`, `mbody`, `state`, `config`, `pubdate`) VALUES ('$title', '$communityid', '$community', '$addrid', '$address', '$paytype', '$rentype', '$sharetype', '$sharesex', '$litpic', '$price', '$protype', '$room', '$hall', '$guard', '$bno', '$floor', '$area', '$direction', '$zhuangxiu', '$buildage', '$usertype', '$uid', '$person', '$tel', '$note', '', '0', '$config', '".GetMkTime(time())."')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",",$imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housezu', '$aid', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("house", "zu");

				return $aid;
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//写字楼
		}elseif($type == "xzl"){

			$lei         = (int)$param['lei'];
			$loupan      = filterSensitiveWords(addslashes($param['loupan']));
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$price       = (int)$param['price'];
			$proprice    = number_format($param['proprice'], 1);
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$area        = (int)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$config      = !empty($_POST['config']) ? join(",", $_POST['config']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($loupan)) return array("state" => 200, "info" => '请输入楼盘名称');
			if(empty($addrid)) return array("state" => 200, "info" => '请选择写字楼所在区域');
			if(empty($address)) return array("state" => 200, "info" => '请输入写字楼详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传楼盘代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			$loupan = cn_substrR($loupan, 60);
			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();

			//保存到表
			$archives = $dsql->SetQuery("INSERT INTO `#@__house_xzl` (`type`, `title`, `loupan`, `addrid`, `address`, `nearby`, `litpic`, `proprice`, `protype`, `area`, `price`, `usertype`, `userid`, `username`, `contact`, `zhuangxiu`, `bno`, `floor`, `note`, `mbody`, `weight`, `config`, `state`, `pubdate`) VALUES ('$lei', '$title', '$loupan', '$addrid', '$address', '', '$litpic', '$proprice', '$protype', '$area', '$price', '$usertype', '$uid', '$person', '$tel', '$zhuangxiu', '$bno', '$floor', '$note', '', '0', '$config', '0', '".GetMkTime(time())."')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",",$imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housexzl', '$aid', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("house", "xzl");

				return $aid;
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//商铺
		}elseif($type == "sp"){

			$lei         = (int)$param['lei'];
			$industry    = (int)$param['industry'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$price       = (int)$param['price'];
			$proprice    = number_format($param['proprice'], 1);
			$transfer    = (int)$param['transfer'];
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$area        = (int)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$config      = !empty($_POST['config']) ? join(",", $_POST['config']) : "";
			$suitable    = !empty($_POST['suitable']) ? join(",", $_POST['suitable']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if($lei == 2 && empty($industry)) return array("state" => 200, "info" => '请选择现在经营的行业');
			if(empty($addrid)) return array("state" => 200, "info" => '请选择商铺所在区域');
			if(empty($address)) return array("state" => 200, "info" => '请输入商铺详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传楼盘代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();

			//保存到表
			$archives = $dsql->SetQuery("INSERT INTO `#@__house_sp` (`type`, `industry`, `title`, `addrid`, `address`, `nearby`, `litpic`, `proprice`, `protype`, `area`, `price`, `transfer`, `usertype`, `userid`, `username`, `contact`, `zhuangxiu`, `bno`, `floor`, `config`, `suitable`, `note`, `mbody`, `weight`, `state`, `pubdate`) VALUES ('$lei', '$industry', '$title', '$addrid', '$address', '', '$litpic', '$proprice', '$protype', '$area', '$price', '$transfer', '$usertype', '$uid', '$person', '$tel', '$zhuangxiu', '$bno', '$floor', '$config', '$suitable', '$note', '', '0', '0', '".GetMkTime(time())."')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",",$imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housesp', '$aid', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("house", "sp");

				return $aid;
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//厂房、仓库
		}elseif($type == "cf"){

			$lei         = (int)$param['lei'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$price       = (int)$param['price'];
			$transfer    = (int)$param['transfer'];
			$protype     = (int)$param['protype'];
			$area        = (int)$param['area'];
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($addrid)) return array("state" => 200, "info" => '请选择厂房、仓库所在区域');
			if(empty($address)) return array("state" => 200, "info" => '请输入厂房、仓库详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传厂房、仓库代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();

			//保存到表
			$archives = $dsql->SetQuery("INSERT INTO `#@__house_cf` (`type`, `title`, `addrid`, `address`, `nearby`, `litpic`, `protype`, `area`, `price`, `transfer`, `usertype`, `userid`, `username`, `contact`, `note`, `mbody`, `weight`, `state`, `pubdate`) VALUES ('$lei', '$title', '$addrid', '$address', '', '$litpic', '$protype', '$area', '$price', '$transfer', '$usertype', '$uid', '$person', '$tel', '$note', '', '0', '0', '".GetMkTime(time())."')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",",$imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housecf', '$aid', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("house", "cf");

				return $aid;
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		}

	}


	/**
		* 修改房源
		* @return array
		*/
	public function edit(){
		global $dsql;
		global $userLogin;

		$param   = $this->param;
		$id      = $param['id'];

		if(empty($id)) return array("state" => 200, "info" => '数据传递失败！');

		$type    = $param['type'];
		$title   = filterSensitiveWords(addslashes($param['title']));
		$vdimgck = strtolower($param['vdimgck']);

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($title)) return array("state" => 200, "info" => '请输入标题');
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		$title  = cn_substrR($title, 50);

		//判断是否经纪人
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$uid = $ret[0]['id'];
		}

		//求租、求购
		if($type == "qzu" || $type == "qgou"){

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__housedemand` WHERE `id` = ".$id." AND `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '权限不足，修改失败！');
			}

			$category = $param['category'];
			$note     = filterSensitiveWords(addslashes($param['note']));
			$lei      = $param['lei'];
			$addrid   = $param['addrid'];
			$person   = filterSensitiveWords(addslashes($param['person']));
			$contact  = filterSensitiveWords($param['contact']);

			if($category == "") return array("state" => 200, "info" => '请选择供求分类');
			if(empty($note)) return array("state" => 200, "info" => '请输入描述');
			if(empty($lei)) return array("state" => 200, "info" => '请选择类别分类');
			if(empty($addrid)) return array("state" => 200, "info" => '请选择所在区域');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($contact)) return array("state" => 200, "info" => '请输入手机号码');

			$note    = cn_substrR($note, 500);
			$person  = cn_substrR($person, 10);
			$contact = cn_substrR($contact, 11);

			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__housedemand` SET `title` = '$title', `note` = '$note', `action` = '$lei', `type` = '$category', `addr` = '$addrid', `person` = '$person', `contact` = '$contact', `state` = 0 WHERE `id` = ".$id);
			$return = $dsql->dsqlOper($archives, "update");
			if($return == "ok"){
				return "修改成功！";
			}else{
				return array("state" => 101, "info" => '保存到数据时发生错误，请检查字段内容！');
			}

		//二手房
		}elseif($type == "sale"){

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_sale` WHERE `id` = ".$id." AND `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '权限不足，修改失败！');
			}

			$community   = filterSensitiveWords(addslashes($param['community']));
			$communityid = $param['communityid'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$room        = (int)$param['room'];
			$hall        = (int)$param['hall'];
			$guard       = (int)$param['guard'];
			$area        = (float)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$buildage    = (int)$param['buildage'];
			$price       = (float)$param['price'];
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$direction   = (int)$param['direction'];
			$flag        = !empty($_POST['flag']) ? join(",", $_POST['flag']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($community) && empty($communityid)) return array("state" => 200, "info" => '请输入楼盘名称');
			if(empty($communityid) && empty($addrid)) return array("state" => 200, "info" => '请选择楼盘所在区域');
			if(empty($communityid) && empty($address)) return array("state" => 200, "info" => '请输入楼盘详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传楼盘代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			//if($area == 0) return array("state" => 200, "info" => '房源面积必须为整数，不得为0');
			//if($price == 0) return array("state" => 200, "info" => '房源价格必须为整数，不得为0');

			$unitprice = floor($price * 10000 / $area);   //单价

			$community = cn_substrR($community, 60);
			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$archives = $dsql->SetQuery("UPDATE `#@__house_sale` SET `title` = '$title', `communityid` = '$communityid', `community` = '$community', `addrid` = '$addrid', `address` = '$address', `litpic` = '$litpic', `price` = '$price', `unitprice` = '$unitprice', `protype` = '$protype', `room` = '$room', `hall` = '$hall', `guard` = '$guard', `bno` = '$bno', `floor` = '$floor', `area` = '$area', `direction` = '$direction', `zhuangxiu` = '$zhuangxiu', `buildage` = '$buildage', `username` = '$person', `contact` = '$tel', `note` = '$note', `state` = '0', `flag` = '$flag' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");

			//先删除文档所属图集
			$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housesale' AND `aid` = ".$id);
			$dsql->dsqlOper($archives, "update");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",", $imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housesale', '$id', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("house", "sale");

				return "修改成功！";
			}else{
				return array("state" => 101, "info" => '保存到数据时发生错误，请检查字段内容！');
			}

		//租房
		}elseif($type == "zu"){

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_zu` WHERE `id` = ".$id." AND `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '权限不足，修改失败！');
			}

			$community   = filterSensitiveWords(addslashes($param['community']));
			$communityid = $param['communityid'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$rentype     = (int)$param['rentype'];
			$sharetype   = (int)$param['sharetype'];
			$sharesex    = (int)$param['sharesex'];
			$room        = (int)$param['room'];
			$hall        = (int)$param['hall'];
			$guard       = (int)$param['guard'];
			$area        = (float)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$buildage    = (int)$param['buildage'];
			$price       = (float)$param['price'];
			$paytype     = (int)$param['paytype'];
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$direction   = (int)$param['direction'];
			$config        = !empty($_POST['config']) ? join(",", $_POST['config']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($community) && empty($communityid)) return array("state" => 200, "info" => '请输入楼盘名称');
			if(empty($communityid) && empty($addrid)) return array("state" => 200, "info" => '请选择楼盘所在区域');
			if(empty($communityid) && empty($address)) return array("state" => 200, "info" => '请输入楼盘详细地址');
			if($rentype == 1 && $sharetype == 0) return array("state" => 200, "info" => '请选择要出租的房间');
			if($rentype == 1 && $sharesex === "") return array("state" => 200, "info" => '请选择合租男女限制');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传楼盘代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');
			//if($area == 0) return array("state" => 200, "info" => '房源面积必须为整数，不得为0');
			//if($price == 0) return array("state" => 200, "info" => '房源价格必须为整数，不得为0');
			if($paytype == 0) return array("state" => 200, "info" => '请选择租金压付方式');

			$community = cn_substrR($community, 60);
			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			//保存到表
			$archives = $dsql->SetQuery("UPDATE `#@__house_zu` SET `title` = '$title', `communityid` = '$communityid', `community` = '$community', `addrid` = '$addrid', `address` = '$address', `litpic` = '$litpic', `price` = '$price', `paytype` = '$paytype', `rentype` = '$rentype', `protype` = '$protype', `room` = '$room', `hall` = '$hall', `guard` = '$guard', `sharetype` = '$sharetype', `sharesex` = '$sharesex', `bno` = '$bno', `floor` = '$floor', `area` = '$area', `direction` = '$direction', `zhuangxiu` = '$zhuangxiu', `buildage` = '$buildage', `config` = '$config', `username` = '$person', `contact` = '$tel', `note` = '$note', `state` = 0 WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");

			//先删除文档所属图集
			$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$id);
			$dsql->dsqlOper($archives, "update");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",", $imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housezu', '$id', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("house", "zu");

				return "修改成功！";
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//写字楼
		}elseif($type == "xzl"){

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_xzl` WHERE `id` = ".$id." AND `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '权限不足，修改失败！');
			}

			$lei         = (int)$param['lei'];
			$loupan      = filterSensitiveWords(addslashes($param['loupan']));
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$price       = (int)$param['price'];
			$proprice    = number_format($param['proprice'], 1);
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$area        = (int)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$config      = !empty($_POST['config']) ? join(",", $_POST['config']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($loupan)) return array("state" => 200, "info" => '请输入楼盘名称');
			if(empty($addrid)) return array("state" => 200, "info" => '请选择楼盘所在区域');
			if(empty($address)) return array("state" => 200, "info" => '请输入楼盘详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传楼盘代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			$loupan = cn_substrR($loupan, 60);
			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();
			$usertype = $userinfo['userType'] == 1 ? 0 : 1;

			//保存到表
			$archives = $dsql->SetQuery("UPDATE `#@__house_xzl` SET `type` = '$lei', `title` = '$title', `loupan` = '$loupan', `addrid` = '$addrid', `address` = '$address', `litpic` = '$litpic', `proprice` = '$proprice', `protype` = '$protype', `area` = '$area', `price` = '$price', `username` = '$person', `contact` = '$tel', `zhuangxiu` = '$zhuangxiu', `bno` = '$bno', `floor` = '$floor', `note` = '$note', `config` = '$config', `state` = '0' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");

			//先删除文档所属图集
			$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housexzl' AND `aid` = ".$id);
			$dsql->dsqlOper($archives, "update");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",", $imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housexzl', '$id', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("house", "xzl");

				return "修改成功！";
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//商铺
		}elseif($type == "sp"){

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_sp` WHERE `id` = ".$id." AND `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '权限不足，修改失败！');
			}

			$lei         = (int)$param['lei'];
			$industry    = (int)$param['industry'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$price       = (int)$param['price'];
			$proprice    = number_format($param['proprice'], 1);
			$transfer    = (int)$param['transfer'];
			$protype     = (int)$param['protype'];
			$zhuangxiu   = (int)$param['zhuangxiu'];
			$area        = (int)$param['area'];
			$bno         = (int)$param['bno'];
			$floor       = (int)$param['floor'];
			$config      = !empty($_POST['config']) ? join(",", $_POST['config']) : "";
			$suitable    = !empty($_POST['suitable']) ? join(",", $_POST['suitable']) : "";
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if($lei == 2 && empty($industry)) return array("state" => 200, "info" => '请选择现在经营的行业');
			if(empty($addrid)) return array("state" => 200, "info" => '请选择楼盘所在区域');
			if(empty($address)) return array("state" => 200, "info" => '请输入楼盘详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传楼盘代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();
			$usertype = $userinfo['userType'] == 1 ? 0 : 1;

			//保存到表
			$archives = $dsql->SetQuery("UPDATE `#@__house_sp` SET `type` = '$lei', `industry` = '$industry', `title` = '$title', `addrid` = '$addrid', `address` = '$address', `litpic` = '$litpic', `proprice` = '$proprice', `protype` = '$protype', `area` = '$area', `price` = '$price', `transfer` = '$transfer', `username` = '$person', `contact` = '$tel', `zhuangxiu` = '$zhuangxiu', `bno` = '$bno', `floor` = '$floor', `config` = '$config', `suitable` = '$suitable', `note` = '$note', `state` = '0' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");

			//先删除文档所属图集
			$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housesp' AND `aid` = ".$id);
			$dsql->dsqlOper($archives, "update");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",", $imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housesp', '$id', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("house", "sp");

				return "修改成功！";
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		//厂房、仓库
		}elseif($type == "cf"){

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__house_cf` WHERE `id` = ".$id." AND `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if(!$results){
				return array("state" => 200, "info" => '权限不足，修改失败！');
			}

			$lei         = (int)$param['lei'];
			$addrid      = (int)$param['addrid'];
			$address     = filterSensitiveWords(addslashes($param['address']));
			$price       = (int)$param['price'];
			$transfer    = (int)$param['transfer'];
			$protype     = (int)$param['protype'];
			$area        = (int)$param['area'];
			$title       = filterSensitiveWords(addslashes($param['title']));
			$litpic      = $param['litpic'];
			$person      = filterSensitiveWords(addslashes($param['person']));
			$tel         = filterSensitiveWords(addslashes($param['tel']));
			$note        = filterSensitiveWords($param['note']);
			$imglist     = $param['imglist'];

			if(empty($addrid)) return array("state" => 200, "info" => '请选择楼盘所在区域');
			if(empty($address)) return array("state" => 200, "info" => '请输入楼盘详细地址');
			// if(empty($litpic)) return array("state" => 200, "info" => '请上传楼盘代表图片');
			if(empty($note)) return array("state" => 200, "info" => '请输入房源描述');
			if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
			if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');

			$title     = cn_substrR($title, 60);
			$address   = cn_substrR($address, 60);
			$person    = cn_substrR($person, 10);
			$tel       = cn_substrR($tel, 11);

			$userinfo = $userLogin->getMemberInfo();
			$usertype = $userinfo['userType'] == 1 ? 0 : 1;

			//保存到表
			$archives = $dsql->SetQuery("UPDATE `#@__house_cf` SET `type` = '$lei', `title` = '$title', `addrid` = '$addrid', `address` = '$address', `litpic` = '$litpic', `protype` = '$protype', `area` = '$area', `price` = '$price', `transfer` = '$transfer', `username` = '$person', `contact` = '$tel', `note` = '$note', `state` = '0' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");

			//先删除文档所属图集
			$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housecf' AND `aid` = ".$id);
			$dsql->dsqlOper($archives, "update");

			//保存图集表
			if($imglist != ""){
				$picList = explode(",", $imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__house_pic` (`type`, `aid`, `picPath`, `picInfo`) VALUES ('housecf', '$id', '$picInfo[0]', '$picInfo[1]')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("house", "cf");

				return "修改成功！";
			}else{
				return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
			}

		}

	}


	/**
		* 删除信息
		* @return array
		*/
	public function del(){
		global $dsql;
		global $userLogin;

		$id   = $this->param['id'];
		$type = $this->param['type'];

		if(!is_numeric($id) || empty($type)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//判断是否经纪人
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$uid = $ret[0]['id'];
		}

		//求租、求购
		if($type == "qzu" || $type == "qgou"){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__housedemand` WHERE `id` = ".$id);
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){
				$results = $results[0];
				if($results['userid'] == $uid){
					$archives = $dsql->SetQuery("DELETE FROM `#@__housedemand` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");
					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
				}
			}else{
				return array("state" => 101, "info" => '信息不存在，或已经删除！');
			}

		//二手房
		}elseif($type == "sale"){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_sale` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){

				if($results[0]['userid'] == $uid){
					//删除缩略图
					delPicFile($results[0]['litpic'], "delThumb", "house");

					//删除内容图片
					$body = $results[0]['note'];
					if(!empty($body)){
						delEditorPic($body, "house");
					}

					//图集
					$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'housesale' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "results");

					//删除图片文件
					if(!empty($results)){
						$atlasPic = "";
						foreach($results as $key => $value){
							$atlasPic .= $value['picPath'].",";
						}
						delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housesale' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "update");

					//删除表
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_sale` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
				}
			}else{
				return array("state" => 101, "info" => '信息不存在，或已经删除！');
			}


		//租房
		}elseif($type == "zu"){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_zu` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){

				if($results[0]['userid'] == $uid){
					//删除缩略图
					delPicFile($results[0]['litpic'], "delThumb", "house");

					//删除内容图片
					$body = $results[0]['note'];
					if(!empty($body)){
						delEditorPic($body, "house");
					}

					//图集
					$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "results");

					//删除图片文件
					if(!empty($results)){
						$atlasPic = "";
						foreach($results as $key => $value){
							$atlasPic .= $value['picPath'].",";
						}
						delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housezu' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "update");

					//删除表
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_zu` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
				}
			}else{
				return array("state" => 101, "info" => '信息不存在，或已经删除！');
			}

		//写字楼
		}elseif($type == "xzl"){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_xzl` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){

				if($results[0]['userid'] == $uid){
					//删除缩略图
					delPicFile($results[0]['litpic'], "delThumb", "house");

					//删除内容图片
					$body = $results[0]['note'];
					if(!empty($body)){
						delEditorPic($body, "house");
					}

					//图集
					$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'housexzl' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "results");

					//删除图片文件
					if(!empty($results)){
						$atlasPic = "";
						foreach($results as $key => $value){
							$atlasPic .= $value['picPath'].",";
						}
						delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housexzl' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "update");

					//删除表
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_xzl` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
				}
			}else{
				return array("state" => 101, "info" => '信息不存在，或已经删除！');
			}

		//商铺
		}elseif($type == "sp"){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_sp` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){

				if($results[0]['userid'] == $uid){
					//删除缩略图
					delPicFile($results[0]['litpic'], "delThumb", "house");

					//删除内容图片
					$body = $results[0]['note'];
					if(!empty($body)){
						delEditorPic($body, "house");
					}

					//图集
					$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'housesp' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "results");

					//删除图片文件
					if(!empty($results)){
						$atlasPic = "";
						foreach($results as $key => $value){
							$atlasPic .= $value['picPath'].",";
						}
						delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housesp' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "update");

					//删除表
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_sp` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
				}
			}else{
				return array("state" => 101, "info" => '信息不存在，或已经删除！');
			}

		//厂房、仓库
		}elseif($type == "cf"){

			$archives = $dsql->SetQuery("SELECT * FROM `#@__house_cf` WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){

				if($results[0]['userid'] == $uid){
					//删除缩略图
					delPicFile($results[0]['litpic'], "delThumb", "house");

					//删除内容图片
					$body = $results[0]['note'];
					if(!empty($body)){
						delEditorPic($body, "house");
					}

					//图集
					$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__house_pic` WHERE `type` = 'housecf' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "results");

					//删除图片文件
					if(!empty($results)){
						$atlasPic = "";
						foreach($results as $key => $value){
							$atlasPic .= $value['picPath'].",";
						}
						delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "house");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__house_pic` WHERE `type` = 'housecf' AND `aid` = ".$id);
					$results = $dsql->dsqlOper($archives, "update");

					//删除表
					$archives = $dsql->SetQuery("DELETE FROM `#@__house_cf` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
				}
			}else{
				return array("state" => 101, "info" => '信息不存在，或已经删除！');
			}

		}

	}


	/**
		* 验证信息状态是否可以竞价
		* @return array
		*/
	public function checkBidState(){
		global $dsql;
		global $userLogin;

		$aid = $this->param['aid'];
		$type = $this->param['type'];

		if(!is_numeric($aid) || empty($type)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 101, "info" => '登录超时，请重新登录！');
		}

		$zjid = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$zjid = $ret[0]['id'];
		}

		$archives = $dsql->SetQuery("SELECT `state`, `isbid`, `usertype`, `userid`, `bid_price`, `bid_end` FROM `#@__house_".$type."` WHERE `id` = ".$aid);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			if($results[0]['userid'] != $uid && $zjid != $results[0]['userid']){
				return array("state" => 200, "info" => '您走错地方了吧，只能竞价自己发布的信息哦！');
			}elseif($results[0]['state'] != 1){
				return array("state" => 200, "info" => '只有已审核的信息才可以竞价！');
			}elseif($results[0]['isbid'] == 1){
				//已经竞价
				return array('isbid' => 1, 'bid_price' => $results[0]['bid_price'], 'bid_end' => $results[0]['bid_end'], 'now' => GetMkTime(time()));
			}else{
				return 'true';
			}
		}else{
			return array("state" => 200, "info" => '信息不存在，或已经删除，不可以竞价，请确认后重试！');
		}

	}



	/**
	 * 竞价
	 * @return array
	 */
	public function bid(){
		global $dsql;
		global $userLogin;
		global $cfg_basehost;

		$param   = $this->param;
		$aid     = $param['aid'];           //信息ID
		$type    = $param['type'];          //栏目
		$price   = (float)$param['price'];  //每日预算
		$day     = (int)$param['day'];      //竞价时长
		$paytype = $param['paytype'];       //支付方式

		$amount  = $price * $day;  //总费用

		$uid = $userLogin->getMemberID();  //当前登录用户
		if($uid == -1){
			header("location:http://".$cfg_basehost."/login.html");
			die;
		}

		//信息url
		$param = array(
			"service"     => "member",
			"type"        => "user",
			"template"    => "manage",
			"module"      => "house",
			"dopost"      => $type
		);
		$url = getUrlPath($param);

		//验证金额
		if($amount <= 0 || !is_numeric($aid) || empty($type) || empty($paytype)){
			header("location:".$url);
			die;
		}

		//查询信息
		$sql = $dsql->SetQuery("SELECT `state`, `isbid`, `usertype`, `userid` FROM `#@__house_".$type."` WHERE `id` = ".$aid);
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			//信息不存在
			header("location:".$url);
			die;
		}
		$userid = $ret[0]['userid'];

		//没有审核的信息不可以竞价
		if($ret[0]['state'] != 1){
			header("location:".$url);
			die;
		}

		//已经竞价的，不可以再提交
		if($ret[0]['isbid'] == 1){
			header("location:".$url);
			die;
		}

		$zjid = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$zjid = $ret[0]['id'];
		}

		//只能给自己发布的信息竞价
		if($userid != $uid && $userid != $zjid){
			header("location:".$url);
			die;
		}

		//价格或时长验证
		if(empty($price) || empty($day)){
			header("location:".$url);
			die;
		}

		//订单号
		$ordernum = create_ordernum();

		//当前时间
		$start = GetMkTime(time());
		$end   = $start + $day * 24 * 3600;

		$archives = $dsql->SetQuery("INSERT INTO `#@__member_bid` (`ordernum`, `module`, `part`, `uid`, `aid`, `start`, `end`, `price`, `state`) VALUES ('$ordernum', 'house', '$type', '$uid', '$aid', '$start', '$end', '$price', 0)");
		$return = $dsql->dsqlOper($archives, "update");
		if($return != "ok"){
			die("提交失败，请稍候重试！");
		}

		$tit = "";
		if($type == "sale"){
			$tit = "二手房";
		}elseif($type == "zu"){
			$tit = "租房";
		}elseif($type == "xzl"){
			$tit = "写字楼";
		}elseif($type == "sp"){
			$tit = "商铺";
		}elseif($type == "cf"){
			$tit = "厂房/仓库";
		}

		//跳转至第三方支付页面
		createPayForm("house", $ordernum, $amount, $paytype, "房产".$tit."竞价");

	}



	/**
	 * 竞价加价
	 * @return array
	 */
	public function bidIncrease(){
		global $dsql;
		global $userLogin;
		global $cfg_basehost;

		$param   = $this->param;
		$aid     = $param['aid'];           //信息ID
		$type    = $param['type'];          //栏目
		$price   = (float)$param['price'];  //每日预算
		$paytype = $param['paytype'];       //支付方式

		$uid = $userLogin->getMemberID();  //当前登录用户
		if($uid == -1){
			header("location:http://".$cfg_basehost."/login.html");
			die;
		}

		//信息url
		$param = array(
			"service"     => "member",
			"type"        => "user",
			"template"    => "manage",
			"module"      => "info"
		);
		$url = getUrlPath($param);

		//验证金额
		if(!is_numeric($aid) || empty($type) || empty($paytype)){
			header("location:".$url);
			die;
		}

		//查询信息
		$sql = $dsql->SetQuery("SELECT `state`, `isbid`, `usertype`, `userid`, `bid_price`, `bid_start`, `bid_end` FROM `#@__house_".$type."` WHERE `id` = ".$aid);
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			//信息不存在
			header("location:".$url);
			die;
		}
		$userid = $ret[0]['userid'];

		//没有审核的信息不可以竞价
		if($ret[0]['state'] != 1){
			header("location:".$url);
			die;
		}

		//如果没有参加过竞价，则不可以进行加价操作
		if($ret[0]['isbid'] != 1){
			header("location:".$url);
			die;
		}

		$zjid = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_zjuser` WHERE `userid` = $uid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$zjid = $ret[0]['id'];
		}

		//只能给自己发布的信息竞价
		if($userid != $uid && $userid != $zjid){
			header("location:".$url);
			die;
		}

		//计算剩余竞价天数
		$day = ceil(($ret[0]['bid_end'] - GetMkTime(time())) / 24 / 3600);

		//价格或时长验证
		if(empty($price) || empty($day)){
			header("location:".$url);
			die;
		}

		//支付金额
		$amount = $day * $price;

		//订单号
		$ordernum = create_ordernum();

		//当前时间
		$start = $ret[0]['bid_start'];
		$end   = $ret[0]['bid_end'];

		$archives = $dsql->SetQuery("INSERT INTO `#@__member_bid` (`ordernum`, `module`, `part`, `uid`, `aid`, `start`, `end`, `price`, `state`) VALUES ('$ordernum', 'house', '$type', '$uid', '$aid', '$start', '$end', '$price', 0)");
		$return = $dsql->dsqlOper($archives, "update");
		if($return != "ok"){
			die("提交失败，请稍候重试！");
		}

		$tit = "";
		if($type == "sale"){
			$tit = "二手房";
		}elseif($type == "zu"){
			$tit = "租房";
		}elseif($type == "xzl"){
			$tit = "写字楼";
		}elseif($type == "sp"){
			$tit = "商铺";
		}elseif($type == "cf"){
			$tit = "厂房/仓库";
		}

		//跳转至第三方支付页面
		createPayForm("house", $ordernum, $amount, $paytype, "房产".$tit."竞价加价");

	}


	/**
	 * 支付成功
	 * 此处进行支付成功后的操作，例如发送短信等服务
	 *
	 */
	public function paySuccess(){
		global $cfg_basehost;

		$param = $this->param;
		if(!empty($param)){
			global $dsql;

			$paytype  = $param['paytype'];
			$ordernum = $param['ordernum'];
			$date     = GetMkTime(time());

			//查询订单信息
			$sql = $dsql->SetQuery("SELECT * FROM `#@__member_bid` WHERE `ordernum` = '$ordernum'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$bid    = $ret[0]['id'];
				$part   = $ret[0]['part'];
				$uid    = $ret[0]['uid'];
				$aid    = $ret[0]['aid'];
				$start  = $ret[0]['start'];
				$end    = $ret[0]['end'];
				$price  = $ret[0]['price'];

				//总价 = (结束时间 - 开始时间) 得到天数 * 每日预算
				$day    = ($end - $start) / 24 / 3600;
				$amount = $day * $price;

				//信息
				$sql = $dsql->SetQuery("SELECT `title`, `isbid`, `bid_price` FROM `#@__house_".$part."` WHERE `id` = $aid");
				$ret = $dsql->dsqlOper($sql, "results");
				$title     = $ret[0]['title'];
				$isbid     = $ret[0]['isbid'];
				$bid_price = $ret[0]['bid_price'];

				//更新订单状态
				$sql = $dsql->SetQuery("UPDATE `#@__member_bid` SET `state` = 1 WHERE `id` = ".$bid);
				$dsql->dsqlOper($sql, "update");

				$tit = "";
				if($part == "sale"){
					$tit = "二手房";
				}elseif($part == "zu"){
					$tit = "租房";
				}elseif($part == "xzl"){
					$tit = "写字楼";
				}elseif($part == "sp"){
					$tit = "商铺";
				}elseif($part == "cf"){
					$tit = "厂房/仓库";
				}

				//加价
				if($isbid == 1){

					$title = '房产'.$tit.'竞价加价，每天增加预算'.$price.'元：<a href="http://'.$cfg_basehost.'/index.php?service=house&template='.$part.'-detail&id='.$aid.'" target="_blank">'.$title.'</a>';

					//更新信息竞价状态
					$sql = $dsql->SetQuery("UPDATE `#@__house_".$part."` SET `bid_price` = `bid_price` + '$price' WHERE `id` = ".$aid);
					$dsql->dsqlOper($sql, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '$title', '$date')");
					$dsql->dsqlOper($archives, "update");


				//竞价
				}else{

					$title = '房产'.$tit.'竞价'.$day.'天，每天预算'.$price.'元，结束时间：'.date("Y-m-d H:i:s", $end).'：<a href="http://'.$cfg_basehost.'/index.php?service=house&template='.$part.'-detail&id='.$aid.'" target="_blank">'.$title.'</a>';

					//更新信息竞价状态
					$sql = $dsql->SetQuery("UPDATE `#@__house_".$part."` SET `isbid` = 1, `bid_price` = '$price', `bid_start` = '$start', `bid_end` = '$end' WHERE `id` = ".$aid);
					$dsql->dsqlOper($sql, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '$title', '$date')");
					$dsql->dsqlOper($archives, "update");

				}



			}

		}
	}


	/**
	 * 预约看房
	 *
	 */
	public function booking(){
		global $dsql;
		global $userLogin;

		$param   = $this->param;
		$type    = $param['type'];
		$loupan  = $param['loupan'];
		$amount  = $param['amount'];
		$huxing  = $param['huxing'];
		$name    = $param['name'];
		$mobile  = $param['mobile'];
		$note    = $param['note'];

		//获取用户ID
		$uid = $userLogin->getMemberID();

		$date = GetMkTime(time());
		$ip   = GetIP();

		if(empty($loupan)) return array("state" => 101, "info" => '请填写意向楼盘！');
		if(empty($amount)) return array("state" => 101, "info" => '请填写预算价格！');
		if(empty($name)) return array("state" => 101, "info" => '请填写联系人！');
		if(empty($mobile)) return array("state" => 101, "info" => '请填写手机号码！');

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__house_booking` WHERE `mobile` = '$mobile' AND `loupan` = '$loupan' LIMIT 0, 1");
		$ret = $dsql->dsqlOper($sql, "totalCount");
		if($ret > 0) return array("state" => 101, "info" => '您已经预约过！');

		$sql = $dsql->SetQuery("INSERT INTO `#@__house_booking` (`uid`, `type`, `loupan`, `amount`, `huxing`, `name`, `mobile`, `note`, `date`, `ip`) VALUES ('$uid', '$type', '$loupan', '$amount', '$huxing', '$name', '$mobile', '$note', '$date', '$ip')");
		$ret = $dsql->dsqlOper($sql, "update");
		if($ret != "ok"){
			return array("state" => 101, "info" => '预约失败，请稍候重试！');
		}else{
			return '预约成功！';
		}

	}


	/**
	 * 预约看房列表
	 *
	 */
	public function bookingList(){
		global $dsql;
		global $userLogin;

		$param    = $this->param;
		$type     = $this->param['type'];
		$page     = $this->param['page'];
		$pageSize = $this->param['pageSize'];

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = "";
		if(!empty($type)){
			$where = " AND `type` = $type";
		}

		$archives = $dsql->SetQuery("SELECT `loupan`, `name`, `mobile`, `date` FROM `#@__house_booking` WHERE 1 = 1".$where." ORDER BY `id` DESC");
		$archives_count = $dsql->SetQuery("SELECT count(`id`) as count FROM `#@__house_booking` WHERE 1 = 1".$where);
		//总条数
		$totalCount = $dsql->dsqlOper($archives_count, "results");
		$totalCount = $totalCount[0]['count'];
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
		$list = array();
		foreach($results as $key => $val){
			$list[$key]['loupan'] = $val['loupan'];
			$list[$key]['name'] = cn_substrR($val['name'], 1) . "**";
			$list[$key]['mobile'] = preg_replace('/(1[34578]{1}[0-9])[0-9]{8}/is',"$1********", $val['mobile']);
			$list[$key]['date'] = date("Y-m-d", $val['date']);
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}

}
