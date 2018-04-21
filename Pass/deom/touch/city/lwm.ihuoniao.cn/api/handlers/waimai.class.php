<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 外卖模块API接口
 *
 * @version        $Id: waimai.class.php 2014-10-24 下午14:29:56 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class waimai {
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
     * 自助建站基本参数
     * @return array
     */
	public function config(){

		require(HUONIAOINC."/config/waimai.inc.php");

		global $cfg_fileUrl;              //系统附件默认地址
		global $cfg_uploadDir;            //系统附件默认上传目录
		// global $customFtp;                //是否自定义FTP
		// global $custom_ftpState;          //FTP是否开启
		// global $custom_ftpUrl;            //远程附件地址
		// global $custom_ftpDir;            //FTP上传目录
		// global $custom_uploadDir;         //默认上传目录
		global $cfg_basehost;             //系统主域名
		global $cfg_hotline;              //系统默认咨询热线

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
		// global $customTemplate;           //模板风格
		// global $custom_map;               //自定义地图

		global $cfg_map;                  //系统默认地图

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

		// $domainInfo = getDomain('waimai', 'config');
		// $customChannelDomain = $domainInfo['domain'];
		// if($customSubDomain == 0){
		// 	$customChannelDomain = "http://".$customChannelDomain;
		// }elseif($customSubDomain == 1){
		// 	$customChannelDomain = "http://".$customChannelDomain.".".$cfg_basehost;
		// }elseif($customSubDomain == 2){
		// 	$customChannelDomain = "http://".$cfg_basehost."/".$customChannelDomain;
		// }

		include HUONIAOINC.'/siteModuleDomain.inc.php';
		$customChannelDomain = $waimaiDomain;

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
				}elseif($param == "template"){
					$return['template'] = $customTemplate;
				}elseif($param == "touchTemplate"){
					$return['touchTemplate'] = $customTouchTemplate;
				}elseif($param == "map"){
					$return['map'] = $custom_map;
				}elseif($param == "softSize"){
					$return['softSize'] = $custom_softSize;
				}elseif($param == "softType"){
					$return['softType'] = $custom_softType;
				}elseif($param == "thumbSize"){
					$return['thumbSize'] = $custom_thumbSize;
				}elseif($param == "thumbType"){
					$return['thumbType'] = $custom_thumbType;
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
			$return['template']      = $customTemplate;
			$return['touchTemplate'] = $customTouchTemplate;
			$return['map']           = $custom_map;
			$return['softSize']      = $custom_softSize;
			$return['softType']      = $custom_softType;
			$return['thumbSize']     = $custom_thumbSize;
			$return['thumbType']     = $custom_thumbType;
		}

		return $return;

	}



	/**
	  * 店铺列表
	  */
	public function shopList(){
		global $dsql;

		$ids = $typeid = $orderby = $yingye = $lng = $lat = $keywords = $where = $page = $pageSize = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$u        = $this->param['u'];
				$ids      = $this->param['ids'];
				$typeid   = (int)$this->param['typeid'];
				$orderby  = (int)$this->param['orderby'];
				$yingye   = $this->param['yingye'];
				$lng      = $this->param['lng'];
				$lat      = $this->param['lat'];
				$keywords = $this->param['keywords'];
				$page     = (int)$this->param['page'];
				$pageSize = (int)$this->param['pageSize'];
			}
		}

		$where = " AND s.`status` = 1";

		//指定店铺
		if(!empty($ids)){
			$where .= " AND s.`id` in ($ids)";

			$page = 1;
			$pageSize = 9999;

		}else{

			//分类
			if(!empty($typeid)){
				$reg = "(^$typeid$|^$typeid,|,$typeid,|,$typeid)";
				$where .= " AND s.`typeid` REGEXP '".$reg."' ";
			}

			//营业状态
			if(!empty($yingye)){
				$where .= "
				AND (FIND_IN_SET(DAYOFWEEK(now()) - 1, s.`weeks`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, s.`weeks`)))
				AND (
				(CONVERT(s.`start_time1`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time1`, TIME) > CONVERT(now(), TIME))
				OR (CONVERT(s.`start_time2`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time2`, TIME) > CONVERT(now(), TIME))
				OR (CONVERT(s.`start_time3`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time3`, TIME) > CONVERT(now(), TIME))
				)";
			}

			//关键字
			if(!empty($keywords)){
				$where .= " AND (`shopname` like '%$keywords%' OR f.`title` like '%$keywords%')";
			}

		}

		$juli = "";
		if($lng && $lat){
			$juli = ", ROUND(
		        6378.138 * 2 * ASIN(
		            SQRT(POW(SIN(($lat * PI() / 180 - s.`coordX` * PI() / 180) / 2), 2) + COS($lat * PI() / 180) * COS(s.`coordX` * PI() / 180) * POW(SIN(($lng * PI() / 180 - s.`coordY` * PI() / 180) / 2), 2))
		        ) * 1000
		    ) AS juli";

			//筛选10KM范围内的店铺
			$where .= " AND ROUND(
		        6378.138 * 2 * ASIN(
		            SQRT(POW(SIN(($lat * PI() / 180 - s.`coordX` * PI() / 180) / 2), 2) + COS($lat * PI() / 180) * COS(s.`coordX` * PI() / 180) * POW(SIN(($lng * PI() / 180 - s.`coordY` * PI() / 180) / 2), 2))
		        ) * 1000
		    ) < 10000";
		}


		$order = " ORDER BY `yingye` DESC, s.`sort` DESC, s.`id` DESC";
		if($orderby == 1){
			$order = " ORDER BY `juli` ASC, `yingye` DESC, s.`sort` DESC, s.`id` DESC";
		}elseif($orderby == 2){

		}elseif($orderby == 3){
			$order = " ORDER BY s.`basicprice` ASC, s.`yingye` DESC, s.`sort` DESC, s.`id` DESC";
		}elseif($orderby == 4){

		}

		if(empty($keywords)){
			$sql = $dsql->SetQuery("SELECT
				s.`id`, s.`shopname`, s.`typeid`, s.`category`, s.`description`, s.`ordervalid`, s.`weeks`, s.`start_time1`, s.`end_time1`, s.`start_time2`, s.`end_time2`, s.`start_time3`, s.`end_time3`, s.`basicprice`, s.`delivery_fee`, s.`linktype`, s.`show_delivery_service`, s.`delivery_service`, s.`is_first_discount`, s.`first_discount`, s.`is_discount`, s.`discount_value`, s.`open_promotion`, s.`promotions`, s.`shop_banner`,
				CASE WHEN(
					(
						(FIND_IN_SET(DAYOFWEEK(now()) - 1, s.`weeks`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, s.`weeks`))) AND (CONVERT(s.`start_time1`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time1`, TIME) > CONVERT(now(), TIME))
					)
					OR
					(
						(FIND_IN_SET(DAYOFWEEK(now()) - 1, s.`weeks`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, s.`weeks`))) AND (CONVERT(s.`start_time2`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time2`, TIME) > CONVERT(now(), TIME))
					)
					OR
					(
						(FIND_IN_SET(DAYOFWEEK(now()) - 1, s.`weeks`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, s.`weeks`))) AND (CONVERT(s.`start_time3`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time3`, TIME) > CONVERT(now(), TIME))
					)
				)THEN 1 ELSE 0 END AS yingye
				".$juli."
				FROM `#@__waimai_shop` s
				WHERE 1 = 1" . $where . $order);
		}else{
			$sql = $dsql->SetQuery("SELECT
				s.`id`, s.`shopname`, s.`typeid`, s.`category`, s.`description`, s.`ordervalid`, s.`weeks`, s.`start_time1`, s.`end_time1`, s.`start_time2`, s.`end_time2`, s.`start_time3`, s.`end_time3`, s.`basicprice`, s.`delivery_fee`, s.`linktype`, s.`show_delivery_service`, s.`delivery_service`, s.`is_first_discount`, s.`first_discount`, s.`is_discount`, s.`discount_value`, s.`open_promotion`, s.`promotions`, s.`shop_banner`,
				CASE WHEN(
					(
						(FIND_IN_SET(DAYOFWEEK(now()) - 1, s.`weeks`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, s.`weeks`))) AND (CONVERT(s.`start_time1`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time1`, TIME) > CONVERT(now(), TIME))
					)
					OR
					(
						(FIND_IN_SET(DAYOFWEEK(now()) - 1, s.`weeks`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, s.`weeks`))) AND (CONVERT(s.`start_time2`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time2`, TIME) > CONVERT(now(), TIME))
					)
					OR
					(
						(FIND_IN_SET(DAYOFWEEK(now()) - 1, s.`weeks`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, s.`weeks`))) AND (CONVERT(s.`start_time3`, TIME) < CONVERT(now(), TIME) AND CONVERT(s.`end_time3`, TIME) > CONVERT(now(), TIME))
					)
				)THEN 1 ELSE 0 END AS yingye
				".$juli."
				FROM `#@__waimai_shop` s LEFT JOIN `#@__waimai_list` f ON f.`sid` = s.`id`
				WHERE 1 = 1" . $where . " GROUP BY s.`id`" . $order);
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//总条数
		$totalCount = $dsql->dsqlOper($sql, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$where = "";
		if(empty($ids)){
			$atpage = $pageSize*($page-1);
			$where = " LIMIT $atpage, $pageSize";
		}

		$ret = $dsql->dsqlOper($sql.$where, "results");

		$list = array();

		foreach ($ret as $key => $value) {
			$list[$key]['id'] = $value['id'];
			$list[$key]['shopname'] = $value['shopname'];  //店铺名称
			$list[$key]['typeid'] = $value['typeid'];  //分类ID

			$sql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_shop_type` WHERE `id` in (" . $value['typeid'] . ")");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typename = array();
				foreach ($ret as $k => $v) {
					array_push($typename, $v['title']);
				}
				$list[$key]['typename'] = join("，", $typename);  //分类名称
			}else{
				$list[$key]['typename'] = "";
			}

			$list[$key]['category'] = $value['category'];
			$list[$key]['description'] = $value['description'];  //描述
			$list[$key]['ordervalid'] = $value['ordervalid'];  //微信下单状态


			//营业状态
			$yingye = $value['yingye'];
			$list[$key]['yingye'] = $yingye;  //是否营业
			$list[$key]['juli'] = $value['juli'] > 1000 ? sprintf("%.1f", $value['juli'] / 1000) . "千米" : $value['juli'] . "米";  //距离

			$list[$key]['basicprice'] = $value['basicprice'];   //起送价
			$list[$key]['delivery_fee'] = $value['delivery_fee'];   //配送费

			//链接
			if($value['linktype']){
				$param = array(
					"service"  => "waimai",
					"template" => "buy",
					"id"       => $value['id']
				);
			}else{
				$param = array(
			        "service"  => "waimai",
			        "template" => "shop",
			        "id"       => $value['id']
			    );
			}
		    $list[$key]['url'] = getUrlPath($param);

			$list[$key]['delivery_service'] = $value['show_delivery_service'] ? $value['delivery_service'] : "";  //服务商
			$list[$key]['is_first_discount'] = $value['is_first_discount'];  //首单减免
			$list[$key]['first_discount'] = $value['first_discount'];  //首单减免金额
			$list[$key]['is_discount'] = $value['is_discount'];  //店铺打折
			$list[$key]['discount_value'] = $value['discount_value'];  //店铺折扣
			$list[$key]['open_promotion'] = $value['open_promotion'];  //减免
			$list[$key]['promotions'] = unserialize($value['promotions']);  //减免
			$list[$key]['pic'] = $value['shop_banner'] ? getFilePath(explode(",", $value['shop_banner'])[0]) : "";  //图片


			//关键字搜索商品
			$food = array();
			if(!empty($keywords)){
				$sql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_list` WHERE `sid` = ".$value['id']." AND `title` like '%$keywords%' AND `status` = 1 ORDER BY `sort` DESC");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					foreach ($ret as $k => $v) {
						array_push($food, $v['title']);
					}
				}
			}
			$list[$key]['food'] = $food;

		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}



	/**
     * 菜系分类
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
		$results = $dsql->getTypeList($type, "waimai_type", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 区域管理
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
		$results = $dsql->getTypeList($type, "waimai_addr", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 餐厅
     * @return array
     */
	public function store(){
		global $dsql;
		$pageinfo = $list = array();
		$title = $addrid = $typeid = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$title    = $this->param['title'];
				$addrid   = (int)$this->param['addrid'];
				$typeid   = (int)$this->param['typeid'];
				$orderby  = (int)$this->param['orderby'];
				$peisong  = (int)$this->param['peisong'];
				$online   = (int)$this->param['online'];
				$supfapiao = (int)$this->param['supfapiao'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$where = " WHERE `state` = 1";

		//关键字
		if(!empty($title)){
			$where .= " AND (`title` like '%".$title."%' OR `address` like '%".$title."%')";
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "waimai_addr")){
				$addridArr = arr_foreach($dsql->getTypeList($addrid, "waimai_addr"));
				$addridArr = join(',',$addridArr);
				$lower = $addrid.",".$addridArr;
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addr` in ($lower)";
		}

		//类型
		if($typeid != ""){
			$where .= " AND FIND_IN_SET($typeid, `typeid`)";
		}


		$nowTime = (string)date("H:i", time());
		$nowTime = str_replace(":", "", $nowTime);

		//排序
		if(!empty($orderby)){
			//起送价升序
			if($orderby == 1){
				$orderby = " ORDER BY `yy` DESC, `price` ASC, `id` DESC";
			//起送价降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY `yy` DESC, `price` DESC, `id` DESC";
			//配送价升序
			}elseif($orderby == 3){
				$orderby = " ORDER BY `yy` DESC, `peisong` ASC, `id` DESC";
			//配送价降序
			}elseif($orderby == 4){
				$orderby = " ORDER BY `yy` DESC, `peisong` DESC, `id` DESC";
			//配送速度升序
			}elseif($orderby == 5){
				$orderby = " ORDER BY `yy` DESC, `times` ASC, `id` DESC";
			//配送速度降序
			}elseif($orderby == 6){
				$orderby = " ORDER BY `yy` DESC, `times` DESC, `id` DESC";
			}
		}else{
			$orderby = " ORDER BY `yy` DESC, `id` DESC";
		}

		//免配送费
		if($peisong != ""){
			$where .= " AND `peisong` = 0";
		}

		//支持在线支付
		if($online != ""){
			$where .= " AND `online` = 1";
		}

		//可开发票
		if($supfapiao != ""){
			$where .= " AND `supfapiao` = 1";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `typeid`, `logo`, `start1`, `end1`, `start2`, `end2`, `times`, `sale`, `lnglat`, `price`, `peisong`, `online`, `supfapiao`, `fapiao`, `fapiaonote`, `notice`, `yingye`, `weisheng`, `address`, `addr`,
		CASE WHEN(
			(CONVERT(`start1`, TIME) < CONVERT(now(), TIME) AND CONVERT(`end1`, TIME) > CONVERT(now(), TIME))
			OR
			(CONVERT(`start2`, TIME) < CONVERT(now(), TIME) AND CONVERT(`end2`, TIME) > CONVERT(now(), TIME))
		)THEN 1 ELSE 0 END AS yy
		FROM `#@__waimai_store`".$where.$orderby);

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

			$list = array();
			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['typeid'] = $val['typeid'];

				$typeArr = array();
				$typeid = $val["typeid"];
				$typeids = explode(",", $typeid);
				foreach ($typeids as $k => $v) {
					if($v){
						$typeSql = $dsql->SetQuery("SELECT `typename` FROM `#@__waimai_type` WHERE `id` = ". $v);
						$typename = $dsql->getTypeName($typeSql);
						array_push($typeArr, $typename[0]['typename']);
					}
				}
				$list[$key]["typeName"] = join(",", $typeArr);
				$list[$key]["logo"]     = getFilePath($val["logo"]);
				$list[$key]['start1']   = $val['start1'];
				$list[$key]['end1']     = $val['end1'];
				$list[$key]['start2']   = $val['start2'];
				$list[$key]['end2']     = $val['end2'];
				$list[$key]['times']    = $val['times'];
				$list[$key]['sale']     = $val['sale'];
				$list[$key]['lnglat']   = $val['lnglat'];
				$list[$key]['price']    = $val['price'];
				$list[$key]['peisong']  = $val['peisong'];
				$list[$key]['online']   = $val['online'];
				$list[$key]['supfapiao'] = $val['supfapiao'];
				$list[$key]['fapiao']   = $val['fapiao'];
				$list[$key]['fapiaonote'] = $val['fapiaonote'];
				$list[$key]['notice']   = $val['notice'];
				$list[$key]['yingye']   = $val['yingye'];
				$list[$key]['weisheng'] = $val['weisheng'];
				$list[$key]['address']  = $val['address'];
				$list[$key]['addr']     = $val['addr'];
				$list[$key]['yy']       = $val['yy'];

				$param = array(
					"service"     => "waimai",
					"template"    => "shop",
					"id"          => $results[$key]['id']
				);
				$urlParam = getUrlPath($param);
				$list[$key]['url'] = $urlParam;

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
		* 根据坐标获取附近餐厅数量
		* @param string $points  坐标集合，多个用|分隔
		* @return array
		*/
	public function getStoreCount(){
		global $dsql;
		$pointsArr = $list = array();

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$points = $this->param['points'];
				$pointsArr = explode("|", $points);
			}
		}

		if(!empty($pointsArr)){

			$rangeArr = array();

			//遍历数据库，取出所有餐厅的配送范围
			$archives = $dsql->SetQuery("SELECT `range`, `title` FROM `#@__waimai_store` WHERE `state` = 1");
			$results = $dsql->dsqlOper($archives, "results");

			if($results){
				foreach($results as $k1 => $v1){

					if(!empty($v1['range'])){

						$rangeArr[$k1] = array();
						$range1 = explode("$$", $v1['range']);
						foreach ($range1 as $k2 => $v2) {

							$rangeArr[$k1][$k2] = array();
							$range2 = explode("|", $v2);

							foreach ($range2 as $k3 => $v3) {

								$rangeArr[$k1][$k2][$k3] = array();
								$range3 = explode(",", $v3);

								$rangeArr[$k1][$k2][$k3][0] = $range3[0];
								$rangeArr[$k1][$k2][$k3][1] = $range3[1];

							}

						}

					}
				}
			}

			//遍历需要检索的坐标点
			foreach ($pointsArr as $key => $value) {
				$point = explode(",", $value);

				$count = 0;
				$list[$key] = $count;

				//遍历所有配送范围
				foreach ($rangeArr as $k1 => $v1) {

					$r = false;

					//计算坐标点是否在配送范围内
					foreach ($v1 as $k2 => $v2) {

						if(!$r){
							if(isPointInPolygon($v2, $point) == 1){
								$count++;
								$list[$key] = $count;
								$r = true;
							}
						}
					}

				}

			}

			return $list;
		}
	}


	/**
     * 餐厅详细信息
     * @return array
     */
	public function storeDetail(){
		global $dsql;
		global $userLogin;
		$id = $this->param;
		$uid = $userLogin->getMemberID();

		if(!is_numeric($id) && $uid == -1){
			return array("state" => 200, "info" => '格式错误！');
		}

		// $where = " AND `status` = 1";
		if(!is_numeric($id)){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_shop` WHERE `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){
				$id = $results[0]['id'];
				$where = "";
			}else{
				return array("state" => 200, "info" => '该会员暂未开通商铺！');
			}
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_shop` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			// $time = date("H:i", time());
			// $time = (int)str_replace(":", "", $time);
			$time = GetMkTime(time());

			$typeArr = array();
			$typeid = $results[0]["typeid"];
			$typeids = explode(",", $typeid);
			foreach ($typeids as $k => $val) {
				if($val){
					$typeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_shop_type` WHERE `id` = ". $val);
					$type = $dsql->getTypeName($typeSql);
					array_push($typeArr, $type[0]['title']);
				}
			}
			$results[0]["typeid"]   = $typeids;
			$results[0]["typeName"] = join(" > ", $typeArr);

			$state = "";
			$start1 = (int)str_replace(":", "", $results[0]["start_time1"]);
			$end1   = (int)str_replace(":", "", $results[0]["end_time1"]);
			$start2 = (int)str_replace(":", "", $results[0]["start_time2"]);
			$end2   = (int)str_replace(":", "", $results[0]["end_time2"]);
			$start3 = (int)str_replace(":", "", $results[0]["start_time3"]);
			$end3   = (int)str_replace(":", "", $results[0]["end_time3"]);

			//主要计算营业时间跨夜，例如：18:00到02:00
			$s1 = GetMkTime(date("Y-m-d ", time()) . $results[0]["start_time1"]);
			$e1 = $start1 > $end1 ? GetMkTime(date("Y-m-d ", strtotime("+1 day")) . $results[0]["end_time1"]) : GetMkTime(date("Y-m-d ", time()) . $results[0]["end_time1"]);
			$s2 = GetMkTime(date("Y-m-d ", time()) . $results[0]["start_time2"]);
			$e2 = $start2 > $end2 ? GetMkTime(date("Y-m-d ", strtotime("+1 day")) . $results[0]["end_time2"]) : GetMkTime(date("Y-m-d ", time()) . $results[0]["end_time2"]);
			$s3 = GetMkTime(date("Y-m-d ", time()) . $results[0]["start_time3"]);
			$e3 = $start3 > $end3 ? GetMkTime(date("Y-m-d ", strtotime("+1 day")) . $results[0]["end_time3"]) : GetMkTime(date("Y-m-d ", time()) . $results[0]["end_time3"]);

			$weeks = explode(",", $results[0]['weeks']);
			$dayweek = date("w") == 0 ? 7 : date("w");
			$yingyeWeek = 0;
			$yingyeTime = 0;
			if(in_array($dayweek, $weeks)){
				$yingyeWeek = 1;
				if(($s1 < $time && $e1 > $time) OR ($s2 < $time && $e2 > $time) OR ($s3 < $time && $e3 > $time)){
					$yingyeTime = 1;
					$state = 1;
				}else{
					$state = 0;
				}
			}else{
				$state = 0;
			}

			$results[0]["yingye"] = $state;
			$results[0]["yingyeWeek"] = $yingyeWeek;
			$results[0]["yingyeTime"] = $yingyeTime;

			$results[0]["lng"] = explode(",", $results[0]["lng"]);
			$results[0]["lat"] = explode(",", $results[0]["lat"]);
			$results[0]["pubdate"] = date("Y-m-d h:i:s", $results[0]["pubdate"]);

			//验证是否已经收藏
			$params = array(
				"module" => "waimai",
				"temp"   => "shop",
				"type"   => "add",
				"id"     => $id,
				"check"  => 1
			);
			$collect = checkIsCollect($params);
			$results[0]['collect'] = $collect == "has" ? 1 : 0;

			//图集
			$bannerArr = array();
			$shop_banner = explode(",", $results[0]['shop_banner']);
			if($shop_banner){
				foreach($shop_banner as $banner){
					array_push($bannerArr, getFilePath($banner));
				}
			}
			$results[0]['shop_banner'] = $bannerArr;


			//链接
			if($results[0]['linktype']){
				$param = array(
					"service"  => "waimai",
					"template" => "buy",
					"id"       => $results[0]['id']
				);
			}else{
				$param = array(
			        "service"  => "waimai",
			        "template" => "shop",
			        "id"       => $results[0]['id']
			    );
			}
		    $results[0]['url'] = getUrlPath($param);

			//分享图片
			$results[0]['share_pic'] = $results[0]['share_pic'] ? getFilePath($results[0]['share_pic']) : "";

			$results[0]['range_delivery_fee_value'] = unserialize($results[0]['range_delivery_fee_value']);
			$results[0]['range_delivery_fee_value_json'] = json_encode($results[0]['range_delivery_fee_value']);

			//预设选项
			$presetArr = array();
			$preset = unserialize($results[0]['preset']);
			if($preset){
				foreach($preset as $key => $value){
					array_push($presetArr, array(
						$value[0], $value[1], $value[2], ($value[0] == 1 ? explode(",", $value[3]) : $value[3])
					));
				}
			}
			$results[0]['preset'] = $presetArr;


			$results[0]['promotions'] = unserialize($results[0]['promotions']);
			$results[0]['promotions_json'] = json_encode($results[0]['promotions']);
			$results[0]['addservice'] = unserialize($results[0]['addservice']);
			$results[0]['addservice_json'] = json_encode($results[0]['addservice']);
			$results[0]['selfdefine'] = unserialize($results[0]['selfdefine']);
			$results[0]['service_area_data'] = !empty($results[0]['service_area_data']) ? unserialize($results[0]['service_area_data']) : array();

			$results[0]['title'] = $results[0]['shopname'];


			$common = array();

			// 评分
			$sql = $dsql->SetQuery("SELECT avg(`star`) r FROM `#@__waimai_common` WHERE `sid` = ".$id);
			$res = $dsql->dsqlOper($sql, "results");
			$rating = $res[0]['r'];		//总评分
			$common['star'] = number_format($rating, 1);

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_common` WHERE `sid` = ".$id);
			//总条数
			$totalCount      = $dsql->dsqlOper($archives, "totalCount");
			// 一星
			$totalCountStar1   = $dsql->dsqlOper($archives." AND `star` = 1", "totalCount");
			// 二星
			$totalCountStar2   = $dsql->dsqlOper($archives." AND `star` = 2", "totalCount");
			// 三星
			$totalCountStar3 = $dsql->dsqlOper($archives." AND `star` = 3", "totalCount");
			// 四星
			$totalCountStar4  = $dsql->dsqlOper($archives." AND `star` = 4", "totalCount");
			// 五星
			$totalCountStar5  = $dsql->dsqlOper($archives." AND `star` = 5", "totalCount");

			$common['totalCount']  = $totalCount;
			$common['totalCount1'] = $totalCountStar1;
			$common['totalCount2'] = $totalCountStar2;
			$common['totalCount3'] = $totalCountStar3;
			$common['totalCount4'] = $totalCountStar4;
			$common['totalCount5'] = $totalCountStar5;

			// 配送评分
			$sql = $dsql->SetQuery("SELECT avg(`starps`) r FROM `#@__waimai_common` WHERE `sid` = ".$id);
			$res = $dsql->dsqlOper($sql, "results");
			$rating = $res[0]['r'];		//总评分
			$common['starps'] = number_format($rating, 1);

			$results[0]['common'] = $common;

			return $results[0];
		}else{
			return array("state" => 200, "info" => '餐厅不存在！');
		}
	}

	/**
     * 店铺评分
     * @return array
     */
	public function storeDetailStar(){
		global $dsql;
		$id = $this->param;
		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$results = array();

		// 评分
		$sql = $dsql->SetQuery("SELECT avg(`star`) r FROM `#@__waimai_common` WHERE `sid` = ".$id);
		$res = $dsql->dsqlOper($sql, "results");
		$rating = $res[0]['r'];		//总评分
		$results['star'] = number_format($rating, 1);

		$archives = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_common` WHERE `sid` = ".$id);
		//总条数
		$totalCount      = $dsql->dsqlOper($archives, "totalCount");
		// 一星
		$totalCountStar1   = $dsql->dsqlOper($archives." AND `star` = 1", "totalCount");
		// 二星
		$totalCountStar2   = $dsql->dsqlOper($archives." AND `star` = 2", "totalCount");
		// 三星
		$totalCountStar3 = $dsql->dsqlOper($archives." AND `star` = 3", "totalCount");
		// 四星
		$totalCountStar4  = $dsql->dsqlOper($archives." AND `star` = 4", "totalCount");
		// 五星
		$totalCountStar5  = $dsql->dsqlOper($archives." AND `star` = 5", "totalCount");

		$results['totalCount']  = $totalCount;
		$results['totalCount1'] = $totalCountStar1;
		$results['totalCount2'] = $totalCountStar2;
		$results['totalCount3'] = $totalCountStar3;
		$results['totalCount4'] = $totalCountStar4;
		$results['totalCount5'] = $totalCountStar5;

		return $results;

	}


	/**
     * 商品分类
     * @return array
     */
	public function foodType(){
		global $dsql;
		$shop = $this->param['shop'];
		if(!is_numeric($shop)) return array("state" => 200, "info" => '格式错误！');

		//显示状态
		$where = " AND (`weekshow` = 0 OR (`weekshow` = 1 AND (FIND_IN_SET(DAYOFWEEK(now()) - 1, `week`) OR (DAYOFWEEK(now()) = 1 AND FIND_IN_SET(7, `week`)))))
		AND (`start_time` = '00:00' OR CONVERT(`start_time`, TIME) < CONVERT(now(), TIME)) AND (`end_time` = '00:00' OR CONVERT(`end_time`, TIME) > CONVERT(now(), TIME))";

		$archives = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__waimai_list_type` WHERE `status` = 1 AND `sid` = ".$shop." ".$where." ORDER BY `sort` DESC");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}else{
			return array("state" => 200, "info" => '暂无商品分类！');
		}

	}


	/**
	  * 获取地址列表
	  */
	public function getMemberAddress(){
		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1){
			return array("state" => 200, "info" => '未登录或登录超时！');
		}

		$list = array();
		$sql = $dsql->SetQuery("SELECT `id`, `person`, `tel`, `street`, `address`, `lng`, `lat` FROM `#@__waimai_address` WHERE `uid` = $uid ORDER BY `id` DESC");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			foreach($ret as $key => $val){
				$list[$key]['id']      = $val['id'];
				$list[$key]['person']  = $val['person'];
				$list[$key]['tel']     = $val['tel'];
				$list[$key]['street']  = $val['street'];
				$list[$key]['address'] = $val['address'];
				$list[$key]['lng']     = $val['lng'];
				$list[$key]['lat']     = $val['lat'];
			}
		}

		return $list;
	}


	/**
	  * 添加/修改地址
	  */
	public function operAddress(){
		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1){
			return array("state" => 200, "info" => '未登录或登录超时！');
		}

		$id = $this->param['id'];
		$person = $this->param['person'];
		$tel = $this->param['tel'];
		$street = $this->param['street'];
		$lng = $this->param['lng'];
		$lat = $this->param['lat'];
		$address = $this->param['address'];

		if(empty($person)){
			return array("state" => 200, "info" => '请输入联系人！');
		}

		if(empty($tel)){
			return array("state" => 200, "info" => '请输入联系电话！');
		}

		if(empty($street)){
			return array("state" => 200, "info" => '请选择街道/小区/建筑！');
		}

		if(empty($lng) || empty($lat)){
			return array("state" => 200, "info" => '请选择地图坐标！');
		}

		if(empty($address)){
			return array("state" => 200, "info" => '请输入详细地址！');
		}

		//新增地址
		if(empty($id)){
			$sql = $dsql->SetQuery("INSERT INTO `#@__waimai_address` (`uid`, `person`, `tel`, `street`, `address`, `lng`, `lat`) VALUES ('$uid', '$person', '$tel', '$street', '$address', '$lng', '$lat')");

		//更新地址
		}else{
			$sql = $dsql->SetQuery("UPDATE `#@__waimai_address` SET `person` = ' $person', `tel` = '$tel', `street` = '$street', `address` = '$address', `lng` = '$lng', `lat` = '$lat' WHERE `id` = $id AND `uid` = $uid");
		}

		$ret = $dsql->dsqlOper($sql, "update");
		if($ret == "ok"){
			return "保存成功";
		}else{
			return array("state" => 200, "info" => '保存失败！');
		}
	}


	/**
	  * 删除收货地址
	  */
	public function deleteAddress(){
		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1){
			return array("state" => 200, "info" => '未登录或登录超时！');
		}

		$id = (int)$this->param['id'];

		$sql = $dsql->SetQuery("DELETE FROM `#@__waimai_address` WHERE `id` = $id AND `uid` = $uid");
		$dsql->dsqlOper($sql, "update");
	}


	/**
	  * 提交订单
	  */
	public function deal(){
		global $dsql;
		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1){
			return array("state" => 200, "info" => '未登录或登录超时！');
		}

		$shop          = (int)$this->param['shop'];
		$address       = (int)$this->param['address'];
		$paytype       = $this->param['paytype'];
		$order_content = json_decode($this->param['order_content'], true);
		$preset        = json_decode($this->param['preset'], true);
		$note          = $this->param['note'];

		if(empty($shop)){
			return array("state" => 200, "info" => '店铺ID错误！');
		}

		//店铺详细信息
		$this->param = $shop;
		$shopDetail = $this->storeDetail();

		if(!$shopDetail['status']){
			return array("state" => 200, "info" => '该店铺关闭了，您暂时无法在该店铺下单。');
		}

		if($shopDetail['status'] && !$shopDetail['ordervalid']){
			return array("state" => 200, "info" => '该店铺关闭了微信下单，您暂时无法在该店铺下单。');
		}

		if(!$shopDetail['yingye']){
			if(!$shopDetail['yingyeWeek']){
				return array("state" => 200, "info" => '该店铺今天暂停营业！');
			}else{
				return array("state" => 200, "info" => '该店铺不在营业时间，您暂时无法在该店铺下单！');
			}
		}

		//送餐地址
		$user_addr_person = $user_addr_tel = $user_addr_street = $user_addr_address = $user_addr_lng = $user_addr_lat = "";
		$sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_address` WHERE `uid` = $uid AND `id` = $address");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$user_addr_person  = $ret[0]['person'];
			$user_addr_tel     = $ret[0]['tel'];
			$user_addr_street  = $ret[0]['street'];
			$user_addr_address = $ret[0]['address'];
			$user_addr_lng     = $ret[0]['lng'];
			$user_addr_lat     = $ret[0]['lat'];
		}
		if(empty($user_addr_lng) || empty($user_addr_lat)){
			return array("state" => 200, "info" => '送餐地址坐标获取失败，请重新选择地址！');
		}

		if(empty($shopDetail['coordX']) || empty($shopDetail['coordY'])){
			return array("state" => 200, "info" => '店铺坐标获取失败，下单失败！');
		}

		$juli = getDistance($shopDetail['coordX'], $shopDetail['coordY'], $user_addr_lat, $user_addr_lng)/1000;
		if($shopDetail['delivery_radius'] != 0 && $shopDetail['delivery_radius'] < $juli){
			return array("state" => 200, "info" => '送餐地址距离店铺太远，超出了商家的最大服务范围！');
		}

		if(empty($paytype)){
			return array("state" => 200, "info" => '请选择支付方式！');
		}

		if(empty($order_content)){
			return array("state" => 200, "info" => '购物车内容为空，下单失败！');
		}

		//验证商品
		$totalPrice = 0;
		$dabaoPrice = 0;
		$fids = array();
		$food = array();
		foreach ($order_content as $key => $value) {

			$fid     = $value['id'];     //商品ID
			$fcount  = $value['count'];  //商品数量
			$fntitle = $value['ntitle']; //商品属性

			array_push($fids, $fid);

			$sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_list` WHERE `id` = $fid AND `sid` = $shop AND `status` = 1");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$data = $ret[0];

				$price = $data['price'];
				$dabao = $data['is_dabao'] ? $data['dabao_money'] : 0;

				$totalPrice += $price * $fcount;
				$dabaoPrice += $dabao * $fcount;

				$food[$key]['id']     = $fid;
				$food[$key]['title']  = $data['title'];
				$food[$key]['ntitle'] = $fntitle;
				$food[$key]['count']  = $fcount;
				$fprice = $data['price'];

				if($data['stockvalid'] && $data['stock'] < $fcount){
					return array("state" => 200, "info" => $value['title']."库存不足，下单失败！");
				}

				//商品属性
				if($data['is_nature']){
					$nature = unserialize($data['nature']);
					if($nature){
						$names = array();
						$prices = array();
						foreach ($nature as $k => $v) {
							$names[$k] = array();
							$prices[$k] = array();
							foreach ($v['data'] as $k_ => $v_) {
								array_push($names[$k], $v_['value']);
								array_push($prices[$k], $v_['price']);
							}
						}

						$namesArr = descartes($names);
						$pricesArr = descartes($prices);

						$names = array();
						$prices = array();

						if(count($namesArr) > 1){
							foreach ($namesArr as $k => $v) {
								array_push($names, join("/", $v));
							}
						}else{
							$names = $namesArr[0];
						}

						foreach ($pricesArr as $k => $v) {
							array_push($prices, array_sum($v));
						}

						if($fntitle && !in_array($fntitle, $names)){
							return array("state" => 200, "info" => $value['title']."的".$fntitle."不存在，下单失败！");
						}else{

							//获取属性价格
							$fnprice = $prices[array_search($fntitle, $names)];

							$fprice += $fnprice;
							$totalPrice += $fnprice * $fcount;
						}
					}
				}

				$food[$key]['price'] = $fprice;

			}else{
				return array("state" => 200, "info" => $value['title']."已经下架，下单失败！");
			}

		}

		//起送价 && 配送费
		$basicprice = $shopDetail['basicprice'];
		$delivery_fee = $shopDetail['delivery_fee'];

		//固定费用
		if($shopDetail['delivery_fee_mode'] == 1){

		}

		//按区域
		if($shopDetail['delivery_fee_mode'] == 2){
			$prices = array();

			//验证送货地址是否在商家的服务区域
			$service_area_data = $shopDetail['service_area_data'];
			if($service_area_data){
				foreach ($service_area_data as $key => $value) {
					$qi     = $value['qisong'];
					$pei    = $value['peisong'];
					$points = $value['points'];

					$pointsArr = array();
					if(!empty($points)){
						$points = explode("|", $points);
						foreach ($points as $k => $v) {
							$po = explode(",", $v);
							array_push($pointsArr, array("lng" => $po[0], "lat" => $po[1]));
						}

						if(is_point_in_polygon(array("lng" => $user_addr_lng, "lat" => $user_addr_lat), $pointsArr)){
							array_push($prices, array("qisong" => $qi, "peisong" => $pei));
						}
					}

				}

			}

			//如果送货地址在服务区域，则将起送价和配送费更改为按区域的价格
			if($prices){
				$basicprice = $prices[0]['qisong'];
				$delivery_fee = $prices[0]['peisong'];

			//如果不在服务区域，提醒用户
			}else{
				return array("state" => 200, "info" => '送餐地址距离店铺太远，超出了商家的最大服务范围！');
			}

		}

		//按距离
		if($shopDetail['delivery_fee_mode'] == 3 && $shopDetail['range_delivery_fee_value']){
			foreach ($shopDetail['range_delivery_fee_value'] as $key => $value) {
				if($value[0] < $juli && $value[1] > $juli){
					$basicprice = $value[3];
					$delivery_fee = $value[2];
				}
			}
		}

		if($totalPrice < $basicprice){
			return array("state" => 200, "info" => "订单金额未达到起送价$basicprice，下单失败！");
		}

		//免配送费规则
		if($shopDetail['delivery_fee_mode'] == 1 && $shopDetail['delivery_fee_type'] == 2 && $totalPrice >= $shopDetail['delivery_fee_value']){
			$delivery_fee = 0;
		}

		$priceinfo = array();


		//打折优惠
		if($shopDetail['is_discount'] && $shopDetail['discount_value'] < 10){
			$totalPrice = $totalPrice * $shopDetail['discount_value'] / 10;

			array_push($priceinfo, array(
				"type" => "youhui",
				"body" => $shopDetail['discount_value'] . "折优惠活动",
				"amount" => sprintf("%.2f", $totalPrice / $shopDetail['discount_value'] * 10 - $totalPrice)
			));

			// array_push($priceinfo, $shopDetail['discount_value'] . "折优惠活动");
		}


		//满减
		$promotions_title = "";
		$promotions = 0;
		if($shopDetail['open_promotion'] && $shopDetail['promotions']){
			foreach ($shopDetail['promotions'] as $key => $value) {
				if($value[0] > 0 && $value[0] <= $totalPrice){
					$promotions_title = $value[0];
					$promotions = $value[1];
				}
			}
		}

		if($promotions > 0){

			array_push($priceinfo, array(
				"type" => "manjian",
				"body" => "满" . $promotions_title . "减" . $promotions . "元",
				"amount" => sprintf("%.2f", $promotions)
			));

			// array_push($priceinfo, "满" . $promotions_title . "减" . $promotions . "元");
		}


		//首单减免
		$first_discount = 0;
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `uid` = $uid AND `sid` = $shop AND `state` = 1");
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			if($shopDetail['is_first_discount'] && $shopDetail['first_discount'] > 0){
				$first_discount = $shopDetail['first_discount'];

				array_push($priceinfo, array(
					"type" => "shoudan",
					"body" => "首单减免",
					"amount" => sprintf("%.2f", $first_discount)
				));

				// array_push($priceinfo, "首单减免" . $first_discount . "元");
			}
		}

		//增值服务
		$nowTime = date("H:i");
		$addservice_title = "";
		$addservice_price = 0;
		if($shopDetail['open_addservice'] && $shopDetail['addservice']){
			foreach ($shopDetail['addservice'] as $key => $value) {
				if($value[1] < $nowTime && $value[2] > $nowTime && $value[3] > 0){
					$addservice_title = $value[0];
					$addservice_price = $value[3];

					array_push($priceinfo, array(
						"type" => "fuwu",
						"body" => $addservice_title,
						"amount" => sprintf("%.2f", $addservice_price)
					));

					// array_push($priceinfo, $addservice_title . "：" . $addservice_price . "元");
				}
			}
		}

		//应付价格
		$totalPrice += $dabaoPrice + $delivery_fee - $first_discount - $promotions + $addservice_price;

		if($dabaoPrice){

			array_push($priceinfo, array(
				"type" => "dabao",
				"body" => "打包费",
				"amount" => sprintf("%.2f", $dabaoPrice)
			));

			// array_push($priceinfo, "打包费：" . $dabaoPrice . "元");
		}

		if($delivery_fee){

			array_push($priceinfo, array(
				"type" => "peisong",
				"body" => "配送费",
				"amount" => sprintf("%.2f", $delivery_fee)
			));

			// array_push($priceinfo, "配送费：" . $delivery_fee . "元");
		}

		$totalPrice = $totalPrice < 0 ? 0 : $totalPrice;

		// 货到付款验证店铺配置
		if($paytype == 'delivery'){
			if(strstr($shopDetail['paytype'], "1") === false){
				return array("state" => 200, "info" => "商家不支持货到付款，下单失败！");
			}
			if($shopDetail['offline_limit'] && $shopDetail['pay_offline_limit'] < $totalPrice){
				return array("state" => 200, "info" => "商家设置了货到付款限制金额为：￥".$shopDetail['pay_offline_limit']."，下单失败！");
			}
		}

		// 余额支付验证用户余额
		if($paytype == 'money'){
			$sql  = $dsql->SetQuery("SELECT `money` FROM `#@__member` WHERE `id` = $uid");
			$user = $dsql->dsqlOper($sql, "results");
			if($user[0]['money'] < $totalPrice){
				return array("state" => 200, "info" => "余额不足，下单失败！");
			}
		}

		//生成订单号
		$newOrdernum = create_ordernum();
		/*获取当前店铺当天订单数目 在线支付或余额支付state=2,货到付款state=0
		$paytypeState = "( ((`paytype` = 'alipay' || `paytype` = 'wxpay' || `paytype` = 'money') && `state` = 2) || (`paytype` = 'delivery' && `state` = 0) )";*/
		$paytypeState = "`state` != 0";
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `sid` = $shop AND $paytypeState AND  DATE_FORMAT(FROM_UNIXTIME(pubdate),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
		$no  = $dsql->dsqlOper($sql, "totalCount") + 1;
		$newOrdernumstore = date("Ymd") . "-" . $no;

		$pubdate = GetMkTime(time());
		$fids = join(",", $fids);

		$food = serialize($food);
		$preset = serialize($preset);
		$priceinfo = serialize($priceinfo);
		$address = $user_addr_street . " " . $user_addr_address;

		//查询是否下过单，防止重复下单
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `uid` = $uid AND `sid` = $shop AND `state` = 0 AND `fids` = '$fids' AND `food` = '$food' AND `amount` = $totalPrice");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$id = $ret[0]['id'];

			$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `ordernum` = '$newOrdernum', `ordernumstore` = '$newOrdernumstore', `person` = '$user_addr_person', `tel` = '$user_addr_tel', `address` = '$address', `lng` = '$user_addr_lng', `lat` = '$user_addr_lat', `paytype` = '$paytype', `preset` = '$preset', `note` = '$note', `pubdate` = '$pubdate' WHERE `id` = $id");

		}else{
			$sql = $dsql->SetQuery("INSERT INTO
				`#@__waimai_order`
				(`uid`, `sid`, `ordernum`, `ordernumstore`, `state`, `fids`, `food`, `person`, `tel`, `address`, `lng`, `lat`, `paytype`, `amount`, `priceinfo`, `preset`, `note`, `pubdate`)
				VALUES
				('$uid', '$shop', '$newOrdernum', '$newOrdernumstore', '0', '$fids', '$food', '$user_addr_person', '$user_addr_tel', '$address', '$user_addr_lng', '$user_addr_lat', '$paytype', '$totalPrice', '$priceinfo', '$preset', '$note', '$pubdate')
			");
		}
		$ret = $dsql->dsqlOper($sql, "update");

		if($ret == "ok"){
			return $newOrdernum;
		}else{
			return array("state" => 200, "info" => "下单失败！".$sql);
		}


	}


	/**
	  * 支付
	  */
	public function pay(){
		global $dsql;
		$ordernum = $this->param['ordernum'];
		$paytype  = $this->param['paytype'];



		if($ordernum){

			$sql = $dsql->SetQuery("SELECT o.`id`, o.`sid`, o.`uid`, o.`amount`, o.`paytype`, o.`ordernumstore`, s.`shopname`, s.`bind_print`, s.`print_config`, s.`print_state` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE `state` = 0 AND `ordernum` = '$ordernum'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$data          = $ret[0];
				$id            = $data['id'];
				$uid           = $data['uid'];
				$sid           = $data['sid'];
				$amount        = $data['amount'];
				$shopname      = $data['shopname'];
				$bind_print    = $data['bind_print'];
				$print_config  = $data['print_config'];
				$print_state   = $data['print_state'];
				$ordernumstore = $data['ordernumstore'];
				$paytype       = $paytype ? $paytype : $data['paytype'];

				$date = GetMkTime(time());

				/*
					如果订单金额小于等于0或者支付方式为余额付款|货到付款，直接更新订单状态，并跳转至订单详情页
					或者支付方式为货到付款，跳转至订单详情页
				*/

				// 余额支付扣除用户余额
				if($paytype == 'money'){
					$sql = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` - $amount WHERE `id` = $uid");
					$dsql->dsqlOper($sql, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '外卖消费：".$shopname.$ordernumstore."', '$date')");
					$dsql->dsqlOper($archives, "update");

					updateAdminNotice("waimai", "order");
				}
				if($amount <= 0 || $paytype == 'money' || $paytype == 'delivery'){
					$param = array(
				        "service"  => "member",
				        "type"     => "user",
				        "template" => "orderdetail",
				        "module"   => "waimai",
				        "id"       => $id
				    );
			    	$url = getUrlPath($param);


			    	// 更新订单号等信息
					$paytypeState = "`state` != 0";
					$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `sid` = $sid AND $paytypeState AND  DATE_FORMAT(FROM_UNIXTIME(pubdate),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
					$no  = $dsql->dsqlOper($sql, "totalCount") + 1;
					$newOrdernumstore = date("Ymd") . "-" . $no;

					$archives = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 2, `ordernumstore` = '$newOrdernumstore', `paytype` = '$paytype', `paydate` = '$date' WHERE `ordernum` = '$ordernum'");
					$dsql->dsqlOper($archives, "update");

					//打印机接单
					if($bind_print == 1 && $print_state == 1 && !empty($print_config)){
						printerWaimaiOrder($id);
					}

					header("location:".$url);
					die;
				}

				//跳转至第三方支付页面
				createPayForm("waimai", $ordernum, $amount, $paytype, "外卖订单");

			}else{
				die("订单不存在！");
			}

		}else{
			die("订单不存在！");
		}
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
			$ordernum = $param['ordernum'];
			$date     = GetMkTime(time());

			//查询订单信息
			$archives = $dsql->SetQuery("SELECT o.`id`, o.`uid`, o.`sid`, o.`paydate`, o.`amount`, s.`shopname`, s.`bind_print`, s.`print_config`, s.`print_state` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE `ordernum` = '$ordernum'");
			$res = $dsql->dsqlOper($archives, "results");
			if($res){
				$id       = $res[0]['id'];
				$uid      = $res[0]['uid'];
				$sid      = $res[0]['sid'];
				$paydate  = $res[0]['paydate'];
				$amount   = $res[0]['amount'];
				$shopname = $res[0]['shopname'];
				$bind_print   = $res[0]['bind_print'];
				$print_config = $res[0]['print_config'];
				$print_state  = $res[0]['print_state'];

				//判断是否已经更新过状态，如果已经更新过则不进行下面的操作
				if($paydate == 0){

					//最新订单号
					$paytypeState = "`state` != 0";
					$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `sid` = $sid AND $paytypeState AND  DATE_FORMAT(FROM_UNIXTIME(pubdate),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
					$no  = $dsql->dsqlOper($sql, "totalCount") + 1;
					$newOrdernumstore = date("Ymd") . "-" . $no;

					//更新订单状态
					$archives = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 2, `ordernumstore` = '$newOrdernumstore', `paytype` = '$paytype', `paydate` = '$date' WHERE `ordernum` = '$ordernum'");
					$dsql->dsqlOper($archives, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '外卖消费：".$shopname.$newOrdernumstore."', '$date')");
					$dsql->dsqlOper($archives, "update");


					//打印机接单
					if($bind_print == 1 && $print_state == 1 && !empty($print_config)){
						printerWaimaiOrder($id);
					}

					updateAdminNotice("waimai", "order");
				}

			}
		}
	}

	/**
	 * 买家取消订单
	 */
	public function cancelOrder(){
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
		$archives = $dsql->SetQuery("SELECT o.`paytype`, o.`paydate`, o.`amount`, o.`ordernumstore`, l.`ordernum`, s.`shopname` FROM `#@__waimai_order` o LEFT JOIN `#@__pay_log` l ON l.`body` = o.`ordernum` LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`id` = '$id' AND o.`uid` = '$uid' AND o.`state` = 2");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$amount        = $results[0]['amount'];
			$paytype       = $results[0]['paytype'];
			$paydate       = $results[0]['paydate'];
			$ordernum      = $results[0]['ordernum'];
			$shopname      = $results[0]['shopname'];
			$ordernumstore = $results[0]['ordernumstore'];

			$date = GetMkTime(time());
			$time = 300 - ($date - $paydate);
			if($time > 0){
				$min = ceil($time / 60);
				return array("state" => 200, "info" => "操作失败，成功下单五分钟后商家未接单才可以取消订单，剩余时间：".$min."分钟");
			}

			$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 7, `refrundstate` = 1, `refrunddate` = '$date', `failed` = '用户取消订单', `refrundadmin` = $uid WHERE `id` = $id");
			$ret = $dsql->dsqlOper($sql, "update");
			if($ret != "ok") return array("state" => 200, "info" => "操作失败，请重试！");

			// 货到付款
			if($paytype == "delivery" || $amount == 0){
				return "操作成功！";
			}

			$r = true;
			if($paytype == "money"){

				// 余额支付
				if($paytype == "money"){
					$sql = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + $amount WHERE `id` = $uid");
					$dsql->dsqlOper($sql, "update");
				}

			}elseif($paytype == "alipay"){
				$order = array(
			        "ordernum" => $ordernum,
			        "amount" => $amount
			    );

				require_once(HUONIAOROOT."/api/payment/alipay/alipayRefund.php");
				$alipayRefund = new alipayRefund();
				$return = $alipayRefund->refund($order);

				// 成功
				if($return['state'] == 100){
					$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `refrunddate` = '".GetMkTime($return['date'])."', `refrundno` = '".$return['trade_no']."', `refrundfailed` = '' WHERE `id` = $id");
				}else{
					$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 2, `refrundstate` = 0, `failed` = '', `refrundfailed` = '".$return['code']."' WHERE `id` = $id");
					$r = false;
				}
				$ret = $dsql->dsqlOper($sql, "update");

			}

			if($r){
				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '1', '$amount', '外卖退款：".$shopname.$ordernumstore."', '$date')");
				$dsql->dsqlOper($archives, "update");

				$sql  = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $uid");
				$user = $dsql->dsqlOper($sql, "results");
				$user = $user[0];

				$param = array(
					"service" => "member",
					"type" => "user",
					"template" => "record"
				);

				updateMemberNotice($uid, "会员-订单退款成功", $param, array("username" => $user['username'], "order" => $shopname.$ordernumstore, 'amount' => $amount));

				return "操作成功！";
			}else{
				return array("state" => 200, "info" => '操作失败！');
			}

		}else{
			return array("state" => 200, "info" => '操作失败，请核实订单状态后再操作！');
		}

	}



	/**
     * 相册分类
     * @return array
     */
	public function albumType(){
		global $dsql;
		$store = $this->param['store'];
		if(!is_numeric($store)) return array("state" => 200, "info" => '格式错误！');
		$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__waimai_album_type` WHERE `store` = ".$store." ORDER BY `weight` ASC");
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			return $results;
		}else{
			return array("state" => 200, "info" => '暂无菜单分类！');
		}

	}


	/**
     * 店铺商品
     * @return array
     */
	public function food(){
		global $dsql;
		$pageinfo = $list = array();
		$shop = $typeid = $orderby = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$shop    = $this->param['shop'];
				$typeid  = (int)$this->param['typeid'];
				$orderby = (int)$this->param['orderby'];
			}
		}

		if(empty($shop)){
			return array("state" => 200, "info" => '店铺ID必传！');
		}

		$where = " WHERE `sid` = $shop AND `status` = 1";

		//类型
		if($typeid != ""){
			$where .= " AND `typeid` = $typeid";
		}

		//排序
		if(!empty($orderby)){
			//价格升序
			if($orderby == 1){
				$orderby = " ORDER BY `price` ASC, `sort` DESC, `id` DESC";
			//价格降序
			}elseif($orderby == 2){
				$orderby = " ORDER BY `price` DESC, `sort` DESC, `id` DESC";
			}
		}else{
			$orderby = " ORDER BY `sort` DESC, `id` DESC";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `price`, `typeid`, `unit`, `label`, `is_dabao`, `dabao_money`, `stockvalid`, `stock`, `formerprice`, `descript`, `is_nature`, `nature`, `is_day_limitfood`, `day_foodnum`, `is_limitfood`, `foodnum`, `start_time`, `stop_time`, `limit_time`, `pics` FROM `#@__waimai_list`".$where.$orderby);

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$results = $dsql->dsqlOper($archives, "results");

		$list = array();
		if($results){

			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['price'] = $val['price'];
				$list[$key]['typeid'] = $val['typeid'];

				$typeName = "";
				$sql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_list_type` WHERE `id` = ".$val['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typeName = $ret[0]['title'];
				}
				$list[$key]['typeName'] = $typeName;

				$list[$key]['unit'] = $val['unit'];
				$list[$key]['label'] = $val['label'];
				$list[$key]['is_dabao'] = $val['is_dabao'];
				$list[$key]['dabao_money'] = $val['dabao_money'];
				$list[$key]['stockvalid']  = $val['stockvalid'];
				$list[$key]['stock']  = $val['stock'];
				$list[$key]['formerprice']  = $val['formerprice'];
				$list[$key]['descript']  = $val['descript'];
				$list[$key]['is_nature']  = $val['is_nature'];
				$list[$key]['nature']  = unserialize($val['nature']);
				$list[$key]['nature_json']  = json_encode(unserialize($val['nature']));
				$list[$key]['is_day_limitfood']  = $val['is_day_limitfood'];
				$list[$key]['day_foodnum']  = $val['day_foodnum'];
				$list[$key]['is_limitfood']  = $val['is_limitfood'];
				$list[$key]['foodnum']  = $val['foodnum'];
				$list[$key]['start_time']  = $val['start_time'];
				$list[$key]['stop_time']  = $val['stop_time'];
				$list[$key]['limit_time']  = unserialize($val['limit_time']);
				$list[$key]['limit_time_json']  = json_encode(unserialize($val['limit_time']));
				$list[$key]['stock']  = $val['stock'];

				$picArr = array();
				if($val['pics']){
					$pics = explode(",", $val['pics']);
					foreach($pics as $k => $v){
						array_push($picArr, getFilePath($v));
					}
				}
				$list[$key]['pics'] = $picArr;

				$list[$key]['sale'] = mt_rand(1,10);

				//销量
				// $sql = $dsql->SetQuery("SELECT count(`id`) count FROM `#@__waimai_order_product` WHERE `pid` = ".$val['id']);
				// $ret = $dsql->dsqlOper($sql, "results");
				// $list[$key]['sale'] = $ret[0]['count'];

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		// print_r($list);die;

		return $list;
	}


	/**
     * 菜单详细信息
     * @return array
     */
	public function menuDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_list` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$picArr = array();
			$pics = $results[0]["pics"];
			if(!empty($pics)){
				$pics = explode(",", $pics);
				foreach ($pics as $k => $v) {
					$picArr[$k] = getFilePath($v);
				}
			}
			$results[0]['pics'] = $picArr;

			//菜单分类
			$typename = "";
			$sql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_list_type` WHERE `id` = ".$results[0]['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typename = $ret[0]['title'];
			}
			$results[0]['typeName'] = $typename;

			$results[0]['nature']  = unserialize($results[0]['nature']);
			$results[0]['nature_json']  = json_encode($results[0]['nature']);

			$results[0]['limit_time']  = unserialize($results[0]['limit_time']);
			$results[0]['limit_time_json']  = json_encode($results[0]['limit_time']);

			return $results[0];
		}else{
			return array("state" => 200, "info" => '菜单不存在！');
		}
	}


	/**
     * 餐厅相册
     * @return array
     */
	public function album(){
		global $dsql;
		$pageinfo = $list = array();
		$store = $typeid = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$store    = $this->param['store'];
				$typeid   = (int)$this->param['typeid'];
			}
		}

		if(empty($store)){
			return array("state" => 200, "info" => '餐厅ID必传！');
		}

		$where = " WHERE `store` = $store";

		//类型
		if($typeid != ""){
			$where .= " AND `typeid` = $typeid";
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_album`".$where." ORDER BY `id` DESC");

		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$results = $dsql->dsqlOper($archives, "results");
		$list = array();
		if($results){
			foreach($results as $key => $val){
				$list[$key]['id'] = $val['id'];
				$list[$key]['store'] = $val['store'];
				$list[$key]['typeid'] = $val['typeid'];

				$typeName = "";
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__waimai_album_type` WHERE `id` = ".$val['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typeName = $ret[0]['typename'];
				}
				$list[$key]['typeName'] = $typeName;

				$list[$key]['path'] = getFilePath($val['path']);
				$list[$key]['title'] = $val['title'];
			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return $list;
	}


	/**
     * 照片详细信息
     * @return array
     */
	public function albumDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_album` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results[0]["path"] = getFilePath($results[0]["path"]);
			return $results;
		}else{
			return array("state" => 200, "info" => '照片不存在！');
		}
	}


	/**
     * 评论
     * @return array
     */
	public function review(){
		global $dsql;
		$pageinfo = $list = array();
		$store = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$store   = $this->param['store'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($store)){
			return array("state" => 200, "info" => '餐厅ID必传！');
		}

		$where = " WHERE `store` = $store";

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `userid`, `rating`, `note`, `pics`, `pubdate` FROM `#@__waimai_review` ORDER BY `id` DESC");
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
				$pics = $val['pics'];
				if(!empty($pics)){
					$pics = explode(",", $pics);
					$picArr = array();
					foreach ($pics as $k => $v) {
						$picArr[$k] = getFilePath($v);
					}
					$results[$key]['pics'] = $picArr;
				}
			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}
		return array("pageInfo" => $pageinfo, "list" => $results);
	}


	/**
     * 订单
     * @return array
     */
	public function order(){
		global $dsql;
		$pageinfo = $list = array();
		$store = $userid = $start = $end = $state = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$store    = $this->param['store'];
				$userid   = $this->param['userid'];
				$start    = $this->param['start'];
				$end      = $this->param['end'];
				$state    = $this->param['state'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($store) && empty($userid)){
			return array("state" => 200, "info" => '会员ID或店铺ID至少传一个！');
		}

		$where = " WHERE 1 = 1";

		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid == -1) return array("state" => 200, "info" => '登录超时，获取失败！');

		if(!empty($store)){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_shop` WHERE `userid` = $uid");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$where = $where . " AND `sid` = ".$ret[0]['id'];
			}else{
				return array("state" => 200, "info" => '店铺不存在，获取失败！');
			}
		}

		if(!empty($userid)){
			$where = $where . " AND `uid` = $uid";
		}

		if($start != ""){
			$where .= " AND `pubdate` >= ". GetMkTime($start);
		}

		if($end != ""){
			$where .= " AND `pubdate` <= ". GetMkTime($end);
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT s.`shopname`, o.`id`, o.`sid`, o.`ordernum`, o.`ordernumstore`, o.`uid`, o.`state`, o.`food`, o.`amount`, o.`paytype`, o.`pubdate`, o.`paydate` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid`".$where);
		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");
		//未付款
		$state0 = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
		//已付款
		$state1 = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
		//待收货
		$state2 = $dsql->dsqlOper($archives." AND `state` = 2", "totalCount");
		//交易完成
		$state3 = $dsql->dsqlOper($archives." AND `state` = 3", "totalCount");

		if($state != ""){
			$totalCount = $dsql->dsqlOper($archives." AND `state` = ".$state, "totalCount");

			$archives .= " AND `state` = $state";
		}

		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');
		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount,
			"state0" => $state0,
			"state1" => $state1,
			"state2" => $state2,
			"state3" => $state3,
			"state4" => $state4
		);

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives." ORDER BY `id` DESC".$where, "results");
		$list = array();
		if($results){
			foreach($results as $key => $value){

				$list[$key]['id']            = $value['id'];
				$list[$key]['ordernum']      = $value['ordernum'];
				$list[$key]['ordernumstore'] = $value['shopname'].$value['ordernumstore'];
				$list[$key]['uid']           = $value['uid'];
				$list[$key]['sid']           = $value['sid'];
				$list[$key]['amount']        = $value['amount'];
				$list[$key]['paytype']       = $value['paytype'];
				$list[$key]['pubdate']       = $value['pubdate'];
				$list[$key]['paydate']       = $value['paydate'];
				$list[$key]['state']         = $value['state'];

				//商品信息
				$foodArr = array();
				$food = unserialize($value['food']);
				foreach ($food as $k => $v) {
					array_push($foodArr, $v['title'] . ($v['ntitle'] ? '（'.$v['ntitle'].'）' : '') . "×" . $v['count']);
				}
				$list[$key]['food'] = join("，", $foodArr);

				//用户名
				$userSql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = ". $value["uid"]);
				$username = $dsql->dsqlOper($userSql, "results");
				$list[$key]["username"] = $username[0]['username'];

				//餐厅
				$storeSql = $dsql->SetQuery("SELECT `shopname` FROM `#@__waimai_shop` WHERE `id` = ". $value['sid']);
				$storename = $dsql->getTypeName($storeSql);
				$list[$key]["shopname"] = $storename[0]["shopname"];

				if($value['state'] == 0){
					$param = array(
				        "service"  => "waimai",
				        "template" => "pay",
				        "orderid"  => $value['id']
				    );
			    	$list[$key]['payurl'] = getUrlPath($param);
				}

			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 订单信息详细
     * @return array
     */
	public function orderDetail(){
		global $dsql;
		$id = is_numeric($this->param) ? $this->param : $this->param['id'];
		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();

		$did = GetCookie("courier");
		if($userid == -1 && $did == -1) return array("state" => 200, "info" => '请先登录！');

		if($userid > -1){
			$sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_order` WHERE `id` = $id AND `uid` = $userid");
		}elseif($did > -1){
			$sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_order` WHERE `id` = $id AND `peisongid` = $did");
		}
		$ret = $dsql->dsqlOper($sql, "results");
		$return = array();
		if($ret){
			$now = GetMkTime(time());

			$order = $ret[0];
			$return["id"] = $id;
			$return["uid"] = $order['uid'];
			$return["sid"] = $order['sid'];

			$shopname = $shopaddr = $shoptel = $coordX = $coordY = "";
			$sql = $dsql->SetQuery("SELECT `shopname`, `address`, `phone`, `coordX`, `coordY` FROM `#@__waimai_shop` WHERE `id` = ".$order['sid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$shopname = $ret[0]['shopname'];
				$shopaddr = $ret[0]['address'];
				$shoptel  = $ret[0]['phone'];
				$coordX   = $ret[0]['coordX'];
				$coordY   = $ret[0]['coordY'];
			}
			$return['shopname'] = $shopname;
			$return['shopaddr']  = $shopaddr;
			$return['shoptel']  = $shoptel;
			$return['coordX']   = $coordX;
			$return['coordY']   = $coordY;

			$return["ordernum"] = $order['ordernum'];
			$return["ordernumstore"] = $shopname.$order['ordernumstore'];
			$return["state"] = $order['state'];
			$return["fids"] = $order['fids'];
			$return["food"] = unserialize($order['food']);
			$return["person"] = $order['person'];
			$return["tel"] = $order['tel'];
			$return["address"] = $order['address'];
			$return["lng"] = $order['lng'];
			$return["lat"] = $order['lat'];
			$return["paytype"] = $order['paytype'] == "wxpay" ? "微信支付" : ($order['paytype'] == "alipay" ? "支付宝" : ($order['paytype'] == "money" ? "余额支付" : ($order['paytype'] == "delivery" ? "货到付款" : $order['paytype']) ) );
			$return["amount"] = $order['amount'];
			$return["priceinfo"] = unserialize($order['priceinfo']);
			$return["preset"] = unserialize($order['preset']);
			$return["note"] = $order['note'];
			$return["pubdate"] = $order['pubdate'];
			$return["paydate"] = $order['paydate'];
			$return["paylimittime"] = (1800 - ($now - $order['pubdate'])) > 0 ? (1800 - ($now - $order['pubdate'])) : 0;
			$return["confirmdate"] = $order['confirmdate'];
			$return["peidate"] = $order['peidate'];
			$return["peisongid"] = $order['peisongid'];

			if($order['peisongid']){
				$sql = $dsql->SetQuery("SELECT `name`, `phone` FROM `#@__waimai_courier` WHERE `id` = ".$order['peisongid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$return['peisongname'] = $ret[0]['name'];
					$return['peisongphone'] = $ret[0]['phone'];
				}
			}

			$return["songdate"] = $order['songdate'];
			$return["okdate"] = $order['okdate'];
			$return["failed"] = $order['failed'];

			$peisongpath = $order['peisongpath'];
			$return["peisongpath"] = $peisongpath;


			if($peisongpath){
				$peisongpathArr = explode(";", $peisongpath);
				$peisongpathNew = $peisongpathArr[count($peisongpathArr)-1];
				if($peisongpathNew){
					$path = explode(",", $peisongpathNew);
					$return['peisongpath_lng'] = $path[0];
					$return['peisongpath_lat'] = $path[1];
				}
			}


			// 评价
			$return['iscomment'] = $order['iscomment'];
			if($order['iscomment'] == 1){
				$sql = $dsql->SetQuery("SELECT * FROM `#@__waimai_common` WHERE `uid` = $userid AND `oid` = $id");
				$ret = $dsql->dsqlOper($sql, "results");
				$return['comment'] = $ret[0];
			}


			return $return;

		}else{
			return array("state" => 200, "info" => '订单不存在！');
		}

	}



	/**
	  * 根据订单ID获取骑手坐标
	  */
	public function getCourierLocation(){
		global $dsql;
		$id = $this->param['orderid'];
		if(!$id) return array("state" => 200, "info" => '订单不存在！');

		$sql = $dsql->SetQuery("SELECT `peisongpath` FROM `#@__waimai_order` WHERE `id` = $id");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			return $ret[0]['peisongpath'];
		}
	}


	/**
	  * 配送员登录
	  */
	public function courierLogin(){
		global $dsql;
		$username = $this->param['username'];
		$password = $this->param['password'];

		if(empty($username)){
			return array("state" => 200, "info" => '请填写用户名！');
		}

		if(empty($password)){
			return array("state" => 200, "info" => '请填写密码！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_courier` WHERE `username` = '$username' AND `password` = '$password'");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			PutCookie("courier", $ret[0]['id'], 24 * 60 * 60 * 7, "/");
			return "登录成功！";

		}else{
			return array("state" => 200, "info" => '用户名或密码错误！');
		}
	}


	/**
     * 骑手订单数据
     * @return array
     */
	public function courierOrderList(){
		global $dsql;
		$pageinfo = $list = array();
		$state = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$state    = $this->param['state'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$clng = $clat = "";
		$did = GetCookie("courier");
		if($did){
			$sql = $dsql->SetQuery("SELECT `id`, `lng`, `lat` FROM `#@__waimai_courier` WHERE `id` = $did");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret){
				return array("state" => 200, "info" => '骑手不存在！');
			}

			$clng = $ret[0]['lng'];
			$clat = $ret[0]['lat'];
		}else{
			return array("state" => 200, "info" => '登录超时，刷新页面重试！');
		}

		$where = " WHERE `state` in ($state)";

		if($state != "3"){
			$where .= " AND `peisongid` = $did";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT o.`id`, o.`sid`, o.`ordernum`, o.`ordernumstore`, o.`person`, o.`tel`, o.`address`, o.`lng`, o.`lat`, o.`pubdate`, o.`state`, s.`shopname`, s.`phone`, s.`coordX`, s.`coordY`, s.`address` address1 FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid`".$where);

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

		$results = $dsql->dsqlOper($archives." ORDER BY `id` DESC".$where, "results");
		$list = array();
		if($results){
			foreach($results as $key => $value){
				$list[$key]['id']       = $value['id'];
				$list[$key]['sid']      = $value['sid'];
				$list[$key]['ordernum'] = $value['ordernumstore'] ? $value['shopname'].$value['ordernumstore'] : $value['ordernum'];
				$list[$key]['person']   = $value['person'];
				$list[$key]['tel']      = $value['tel'];
				$list[$key]['address']  = $value['address'];
				$list[$key]['lng']      = $value['lng'];
				$list[$key]['lat']      = $value['lat'];
				$list[$key]['pubdate']  = $value['pubdate'];
				$list[$key]['state']    = $value['state'];
				$list[$key]['shopname'] = $value['shopname'];
				$list[$key]['phone']    = $value['phone'];
				$list[$key]['coordX']   = $value['coordX'];
				$list[$key]['coordY']   = $value['coordY'];
				$list[$key]['address1'] = $value['address1'];

				//计算骑手距离商家多远
				$juliShop = getDistance($clng, $clat, $value['coordX'], $value['coordY']);
				$list[$key]['juliShop'] = $juliShop;

				//计算商家距离终点多远
				$juliPerson = getDistance($value['coordX'], $value['coordY'], $value['lat'], $value['lng']);
				$list[$key]['juliPerson'] = $juliPerson;
			}
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
	  * 骑手抢单
	  */
	public function qiangdan(){
		global $dsql;
		$id = (int)$this->param['id'];

		if(!$id) return array("state" => 200, "info" => '订单ID不能为空！');

		$did = GetCookie("courier");
		if($did){
			$sql = $dsql->SetQuery("SELECT `id`, `lng`, `lat` FROM `#@__waimai_courier` WHERE `id` = $did");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret){
				return array("state" => 200, "info" => '骑手不存在！');
			}
		}else{
			return array("state" => 200, "info" => '登录超时，刷新页面重试！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `id` = $id AND `state` = 3");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$date = GetMkTime(time());
			$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 4, `peisongid` = $did, `peidate` = $date WHERE `id` = $id AND `state` = 3");
			$ret = $dsql->dsqlOper($sql, "update");
			if($ret == "ok"){
				return "抢单成功！";
			}else{
				return array("state" => 200, "info" => '已经被其他骑手抢走~');
			}

		}else{
			return array("state" => 200, "info" => '已经被其他骑手抢走~');
		}


	}


	/**
	  * 骑手更新配送状态
	  */
	public function peisong(){
		global $dsql;
		$id = (int)$this->param['id'];
		$state = (int)$this->param['state'];

		if(!$id) return array("state" => 200, "info" => '订单ID不能为空！');

		$did = GetCookie("courier");
		if($did){
			$sql = $dsql->SetQuery("SELECT `id`, `lng`, `lat` FROM `#@__waimai_courier` WHERE `id` = $did");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret){
				return array("state" => 200, "info" => '骑手不存在！');
			}
		}else{
			return array("state" => 200, "info" => '登录超时，刷新页面重试！');
		}

		//取货
		if($state == 5){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `id` = $id AND `state` = 4 AND `peisongid` = $did");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$date = GetMkTime(time());
				$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 5, `songdate` = $date WHERE `id` = $id AND `state` = 4");
				$ret = $dsql->dsqlOper($sql, "update");
				if($ret == "ok"){

					//消息通知用户
	                $sql_ = $dsql->SetQuery("SELECT o.`uid`, o.`ordernumstore`, s.`shopname`, s.`address` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`id` = $id");
	                $ret_ = $dsql->dsqlOper($sql_, "results");
	                if($ret_){
	                    $data = $ret_[0];

	                    $uid           = $data['uid'];
	                    $ordernumstore = $data['ordernumstore'];
	                    $shopname      = $data['shopname'];
	                    $address       = $data['address'];

	                    $param = array(
	                        "service"  => "member",
	                        "type"     => "user",
	                        "template" => "orderdetail",
	                        "module"   => "waimai",
	                        "id"       => $id
	                    );

	                    updateMemberNotice($uid, "会员-取货提醒", $param, array("ordernum" => $ordernumstore, "shopname" => $shopname, "shopaddr" => $address));
	                }

					return "操作成功！";
				}else{
					return array("state" => 200, "info" => '状态异常，操作失败！');
				}

			}else{
				return array("state" => 200, "info" => '状态异常，操作失败！');
			}

		//成功
		}elseif($state == 1){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `id` = $id AND `state` = 5 AND `peisongid` = $did");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$date = GetMkTime(time());
				$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 1, `okdate` = $date WHERE `id` = $id AND `state` = 5");
				$ret = $dsql->dsqlOper($sql, "update");
				if($ret == "ok"){

					//消息通知用户
	                $sql_ = $dsql->SetQuery("SELECT o.`uid`, o.`ordernumstore`, o.`okdate`, s.`shopname` FROM `#@__waimai_order` o LEFT JOIN `#@__waimai_shop` s ON s.`id` = o.`sid` WHERE o.`id` = $id");
	                $ret_ = $dsql->dsqlOper($sql_, "results");
	                if($ret_){
	                    $data = $ret_[0];

	                    $uid           = $data['uid'];
	                    $ordernumstore = $data['shopname'].$data['ordernumstore'];
	                    $okdate        = $data['okdate'];

	                    $param = array(
	                        "service"  => "member",
	                        "type"     => "user",
	                        "template" => "orderdetail",
	                        "module"   => "waimai",
	                        "id"       => $id
	                    );

	                    updateMemberNotice($uid, "会员-订单完成通知", $param, array("ordernum" => $ordernumstore, "date" => date("Y-m-d H:i:s", $okdate)));
	                }


					return "操作成功！";
				}else{
					return array("state" => 200, "info" => '状态异常，操作失败！');
				}

			}else{
				return array("state" => 200, "info" => '状态异常，操作失败！');
			}

		//其他情况
		}else{
			return array("state" => 200, "info" => '状态异常，操作失败！');
		}


	}



	//骑手开工停工
	public function updateCourierState(){
		global $dsql;
		$state = (int)$this->param['state'];
		$did = GetCookie("courier");
		if($did){
			$sql = $dsql->SetQuery("SELECT `id`, `lng`, `lat` FROM `#@__waimai_courier` WHERE `id` = $did");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret){
				return array("state" => 200, "info" => '骑手不存在！');
			}
		}else{
			return array("state" => 200, "info" => '登录超时，刷新页面重试！');
		}

		$sql = $dsql->SetQuery("UPDATE `#@__waimai_courier` SET `state` = $state WHERE `id` = $did");
		$ret = $dsql->dsqlOper($sql, "update");
		if($ret == "ok"){
			return "更新成功！";
		}else{
			return array("state" => 200, "info" => '更新失败！');
		}
	}



	/**
	  * 更新骑手位置
	  */
	public function updateCourierLocation(){
		global $dsql;
		$uid = (int)$this->param['uid'];
		$lng = $this->param['lng'];
		$lat = $this->param['lat'];
		if($uid && $lng && $lat){

			//更新骑手表
			$sql = $dsql->SetQuery("UPDATE `#@__waimai_courier` SET `lng` = '$lat', `lat` = '$lng' WHERE `id` = $uid");
			$dsql->dsqlOper($sql, "update");

			//更新骑手所有配送中的订单地图路径
			$sql = $dsql->SetQuery("SELECT `id`, `peisongpath` FROM `#@__waimai_order` WHERE `peisongid` = $uid AND `state` = 5");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				foreach ($ret as $key => $value) {
					$id = $value['id'];
					$val = $value['peisongpath'];
					if(empty($val)){
						$val = $lng.",".$lat;
					}else{
						$val .= ";".$lng.",".$lat;
					}

					$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `peisongpath` = '$val' WHERE `id` = $id");
					$dsql->dsqlOper($sql, "update");
				}
			}

			return "success";
		}else{
			return array("state" => 200, "info" => 'error');
		}
	}



	/**
     * 帮助分类
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
		$results = $dsql->getTypeList($type, "waimai_news_type", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 帮助信息
     * @return array
     */
	public function news(){
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
			if($dsql->getTypeList($typeid, "waimai_news_type")){
				$lower = arr_foreach($dsql->getTypeList($typeid, "waimai_news_type"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `typeid`, `body`, `pubdate` FROM `#@__waimai_news` ORDER BY `id` DESC");
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
		foreach ($results as $key => $val) {
			$list[$key]['id'] = $val['id'];
			$list[$key]['title'] = $val['title'];
			$list[$key]['typeid'] = $val['typeid'];
			$list[$key]['body'] = $val['body'];
			$list[$key]['pubdate'] = $val['pubdate'];
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 帮助信息详细
     * @return array
     */
	public function newsDetail(){
		global $dsql;
		$newsDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '信息ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_news` WHERE `arcrank` = 0 AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$newsDetail["title"]       = $results[0]['title'];
			$newsDetail["typeid"]      = $results[0]['typeid'];
			$newsDetail["body"]        = $results[0]['body'];
			$newsDetail["pubdate"]     = $results[0]['pubdate'];
		}
		return $newsDetail;
	}



	//验证购物车内容
	public function checkCart(){
		global $dsql;
		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$cartArr = array();
		$cartData = GetCookie("waimai_store".$id);
		if($cartData){
			$cartData = explode("^O^", $cartData);
			foreach ($cartData as $key => $value) {
				$cart = explode("^^", $value);
				$mid = $cart[0];
				$price = $cart[1];
				$count = $cart[2];
				$name = $cart[3];

				$sql = $dsql->SetQuery("SELECT `price` FROM `#@__waimai_menu` WHERE `store` = $id AND `id` = $mid");
				$ret = $dsql->dsqlOper($sql, "results");
				if(!$ret){
					return array("state" => 200, "info" => '【'.$name.'】商品不存存，请确认后重试！');
				}else{
					if($price - $ret[0]['price'] != 0){
						return array("state" => 200, "info" => '【'.$name.'】商品提交价格与真实价格不符，请重新下单！');
					}
				}
			}

			return "ok";
		}else{
			return array("state" => 200, "info" => '购物车为空，请刷新重试！');
		}

	}



	/**
	 * 下单&支付
	 * @return array
	 */
	public function pay_(){
		global $dsql;
		global $userLogin;
		global $cfg_basehost;

		$param      =  $this->param;
		$id         = $param['id'];
		$ordernum   = $param['ordernum'];
		$paytype    = $param['paytype'];
		$addressid  = $param['addressid'];
		$note       = $param['note'];
		$check      = $param['check'];
		$userid     = $userLogin->getMemberID();
		$date       = GetMkTime(time());

		if($userid == -1) return array("state" => 200, "info" => '登录超时');
		if(empty($id)) return array("state" => 200, "info" => '格式错误');
		if(empty($addressid)) return array("state" => 200, "info" => '请选择收货地址');
		if(empty($paytype)) return array("state" => 200, "info" => '请选择支付方式');

		$this->param = $id;
		$storeDetail = $this->storeDetail();
		if(!is_array($storeDetail)) return array("state" => 200, "info" => '商家不存在，请确认后重试！');
		if(!$storeDetail['state']) return array("state" => 200, "info" => '商家休息中，暂不可下单！');

		//收货地址信息
		global $data;
		$data = "";
		$archives = $dsql->SetQuery("SELECT * FROM `#@__member_address` WHERE `uid` = $userid AND `id` = $addressid");
		$userAddr = $dsql->dsqlOper($archives, "results");
		if(!$userAddr) return array("state" => 200, "info" => '会员地址库信息不存在或已删除');
		$addrArr = getParentArr("site_area", $userAddr[0]['addrid']);
		$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
		$addr    = join(" ", $addrArr);
		$address = $addr . $userAddr[0]['address'];
		$person = $userAddr[0]['person'];
		$mobile = $userAddr[0]['mobile'];
		$tel    = $userAddr[0]['tel'];
		$contact = !empty($mobile) ? $mobile . (!empty($tel) ? " / ".$tel : "") : $tel;

		$totalPrice = 0;  //商品总价
		$offer      = 0;  //优惠
		$price      = $storeDetail['price'];   //起送价
		$peisong    = $storeDetail['peisong']; //配送费
		$sale       = $storeDetail['sale'];    //满减

		//新订单
		if(empty($ordernum)){

			//验证店铺信息
			$sql = $dsql->SetQuery("SELECT `userid` FROM `#@__waimai_store` WHERE `id` = $id");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				if($ret[0]['userid'] == $userid){
					return array("state" => 200, "info" => '不可以购买自己店铺的商品！');
				}
			}else{
				return array("state" => 200, "info" => '商家不存在，请确认后操作！');
			}

			$cartData = GetCookie("waimai_store".$id);
			if(empty($cartData)) return array("state" => 200, "info" => '操作超时，请重新下单！');

			$cartData = explode("^O^", $cartData);
			foreach ($cartData as $key => $value) {
				$cart  = explode("^^", $value);
				$mid   = $cart[0];
				$price = $cart[1];
				$count = $cart[2];
				$name  = $cart[3];

				$sql = $dsql->SetQuery("SELECT `price` FROM `#@__waimai_menu` WHERE `store` = $id AND `id` = $mid");
				$ret = $dsql->dsqlOper($sql, "results");
				if(!$ret){
					return array("state" => 200, "info" => '【'.$name.'】商品不存存，请确认后重试！');
				}else{
					if($price - $ret[0]['price'] != 0){
						return array("state" => 200, "info" => '【'.$name.'】商品提交价格与真实价格不符，请重新下单！');
					}
				}

				$totalPrice += $price * $count;
			}

			//计算优惠
			if($storeDetail['sale']){
				foreach ($storeDetail['sale'] as $key => $value) {
					if($totalPrice >= $value[0]){
						$offer = $value[1];
					}
				}
			}

			//支付费用 = 商品总价 + 配送费 - 优惠
			$payPrice = sprintf("%.2f", $totalPrice + $peisong - $offer);

		//老订单
		}else{

			//查询订单
			$sql = $dsql->SetQuery("SELECT `id`, `price`, `offer`, `peisong`, `state` FROM `#@__waimai_order` WHERE `ordernum` = '$ordernum' AND `userid` = $userid AND `store` = $id");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$data    = $ret[0];
				$orderid = $data['id'];
				$price   = $data['price'];
				// $offer   = $data['offer'];
				// $peisong = $data['peisong'];
				$state   = $data['state'];

				if($state != 0) return array("state" => 200, "info" => '订单状态错误，请确认后重试！');

				//验证订单内容
				$sql = $dsql->SetQuery("SELECT `pid`, `pname`, `price` FROM `#@__waimai_order_product` WHERE `orderid` = $orderid AND `store` = $id");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){

					foreach ($ret as $key => $value) {
						$mid  = $value['pid'];
						$name = $value['pname'];
						$price_ = $value['price'];

						$sql = $dsql->SetQuery("SELECT `price` FROM `#@__waimai_menu` WHERE `store` = $id AND `id` = $mid");
						$ret = $dsql->dsqlOper($sql, "results");
						if(!$ret){
							return array("state" => 200, "info" => '【'.$name.'】商品不存存，请确认后重试！');
						}else{
							if($price_ - $ret[0]['price'] != 0){
								return array("state" => 200, "info" => '【'.$name.'】商品提交价格与当前价格不符，请重新下单！');
							}
						}
					}

				}else{
					return array("state" => 200, "info" => '订单内容为空，请确认后重试！');
				}


				//计算优惠
				if($storeDetail['sale']){
					foreach ($storeDetail['sale'] as $key => $value) {
						if($price >= $value[0]){
							$offer = $value[1];
						}
					}
				}


				//支付费用 = 商品总价 + 配送费 - 优惠
				$payPrice = sprintf("%.2f", $price + $peisong - $offer);

			}else{
				return array("state" => 200, "info" => '订单不存在或已经删除，请确认后重试！');
			}

		}

		//价格验证
		if($payPrice <= 0) return array("state" => 200, "info" => '订单金额必须大于0！');


		//如果是验证订单内容
		if($check) return "ok";


		//如果是支付页面只需要更新订单信息
		if(!empty($ordernum)){

			$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `peisong` = '$peisong', `offer` = '$offer', `paytype` = '$paytype', `people` = '$person', `contact` = '$mobile', `address` = '$address', `note` = '$note' WHERE `id` = $orderid");
			$dsql->dsqlOper($sql, "update");

		//新订单
		}else{

			$ordernum = create_ordernum();
			$sql = $dsql->SetQuery("INSERT INTO `#@__waimai_order` (`ordernum`, `userid`, `store`, `price`, `paytype`, `offer`, `peisong`, `people`, `contact`, `address`, `note`, `orderdate`, `state`) VALUES ('$ordernum', '$userid', '$id', '$totalPrice', '$paytype', '$offer', '$peisong', '$person', '$mobile', '$address', '$note', '$date', '0')");
			$oid = $dsql->dsqlOper($sql, "lastid");
			if(is_numeric($oid)){

				foreach ($cartData as $key => $value) {
					$cart  = explode("^^", $value);
					$mid   = $cart[0];
					$price = $cart[1];
					$count = $cart[2];
					$name  = $cart[3];

					$sql = $dsql->SetQuery("INSERT INTO `#@__waimai_order_product` (`orderid`, `store`, `pid`, `pname`, `price`, `count`) VALUES ('$oid', '$id', '$mid', '$name', '$price', '$count')");
					$dsql->dsqlOper($sql, "update");
				}

			}else{
				die("订单写入数据库失败！");
			}

		}

		//跳转至第三方支付页面
		createPayForm("waimai", $ordernum, $payPrice, $paytype, "外卖订单");


	}


	/**
	 * 支付成功
	 * 此处进行支付成功后的操作，例如发送短信等服务
	 *
	 */
	public function paySuccess_(){
		$param = $this->param;
		if(!empty($param)){
			global $dsql;

			$paytype  = $param['paytype'];
			$ordernum = $param['ordernum'];
			$date     = GetMkTime(time());

			//查询订单信息
			$archives = $dsql->SetQuery("SELECT `userid`, `store`, `paydate`, `price`, `peisong`, `offer` FROM `#@__waimai_order` WHERE `ordernum` = '$ordernum'");
			$res = $dsql->dsqlOper($archives, "results");
			if($res){
				$paydate  = $res[0]['paydate'];
				$uid      = $res[0]['userid'];
				$store    = $res[0]['store'];
				$price    = $res[0]['price'];
				$peisong  = $res[0]['peisong'];
				$offer    = $res[0]['offer'];

				$totalPrice = sprintf("%.2f", $price + $peisong - $offer);

				//判断是否已经更新过状态，如果已经更新过则不进行下面的操作
				if($paydate == 0){
					//更新订单状态
					$archives = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 1, `paydate` = '$date', `paytype` = '$paytype' WHERE `ordernum` = '$ordernum'");
					$dsql->dsqlOper($archives, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$totalPrice', '外卖消费：$ordernum', '$date')");
					$dsql->dsqlOper($archives, "update");
				}

				//清除购物车内容
				DropCookie("waimai_store".$store);
			}
		}
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

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_order` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['uid'] == $uid){

				if($results['state'] == 0 || $results['state'] == 6 || $results['state'] == 7){
					$archives = $dsql->SetQuery("DELETE FROM `#@__waimai_order` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");

					return '删除成功！';
				}else{
					return array("state" => 101, "info" => '订单当前状态不可以删除！');
				}

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '订单不存在，或已经删除！');
		}

	}


	/**
		* 确认收货
		* @return array
		*/
	public function confirmOrder(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$archives = $dsql->SetQuery("SELECT `ordernum`, `userid`, `store`, `price`, `offer`, `peisong`, `state` FROM `#@__waimai_order` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['userid'] == $uid){

				if($results['state'] == 2){

					$ordernum = $results['ordernum'];
					$store    = $results['store'];

					//更新订单状态
					$date = GetMkTime(time());
					$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 3, `confirm` = $date WHERE `id` = $id");
					$dsql->dsqlOper($sql, "update");

					$totalPrice = sprintf("%.2f", $results['price'] + $results['peisong'] - $results['offer']);

					//商家信息
					$sql = $dsql->SetQuery("SELECT `userid` FROM `#@__waimai_store` WHERE `id` = $store");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						$userid = $ret[0]['userid'];

						$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$userid', '1', '$totalPrice', '外卖订单：$ordernum', '$date')");
						$dsql->dsqlOper($archives, "update");
					}

					return '确认成功！';
				}else{
					return array("state" => 101, "info" => '订单状态错误，请确认后操作！');
				}

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '订单不存在，或已经删除！');
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
		$typeid      = $param['typeid'];
		$typeid      = isset($typeid) ? join(',', $typeid) : '';
		$litpic      = $param['litpic'];
		$addrid      = (int)$param['addrid'];
		$address     = filterSensitiveWords(addslashes($param['address']));
		$lnglat      = filterSensitiveWords(addslashes($param['lnglat']));
		$tel         = filterSensitiveWords(addslashes($param['contact']));
		$range       = filterSensitiveWords(addslashes($param['range']));
		$times       = (int)$param['times'];
		$start1      = filterSensitiveWords(addslashes($param['start1']));
		$end1        = filterSensitiveWords(addslashes($param['end1']));
		$start2      = filterSensitiveWords(addslashes($param['start2']));
		$end2        = filterSensitiveWords(addslashes($param['end2']));
		$price       = (float)$param['price'];
		$peisong     = (float)$param['peisong'];
		$online      = (int)$param['online'];
		$supfapiao   = (int)$param['supfapiao'];
		$m1          = $param['m1'];
		$m1          = isset($m1) ? $m1 : array();
		$m2          = $param['m2'];
		$m2          = isset($m2) ? $m2 : array();
		$fapiao      = (float)$param['fapiao'];
		$fapiaonote  = filterSensitiveWords(addslashes($param['fapiaonote']));
		$notice      = filterSensitiveWords(addslashes($param['notice']));
		$note        = filterSensitiveWords(addslashes($param['note']));
		$yingyezhizhao = $param['yingyezhizhao'];
		$weishengxuke  = $param['weishengxuke'];
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

		if(empty($typeid)){
			return array("state" => 200, "info" => '请选择经营类别');
		}

		if(empty($addrid)){
			return array("state" => 200, "info" => '请选择所在区域');
		}

		if(empty($address)){
			return array("state" => 200, "info" => '请输入详细地址');
		}

		if(empty($tel)){
			return array("state" => 200, "info" => '请输入联系电话');
		}

		$note = cn_substrR($note, 255);

		$sale = array();
		foreach ($m1 as $key => $value) {
			$sale[$key] = $value.",".$m2[$key];
		}
		$sale = join("$$", $sale);

		$userSql = $dsql->SetQuery("SELECT `id`, `yingye`, `weisheng` FROM `#@__waimai_store` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");

		//新商铺
		if(!$userResult){

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__waimai_store` (`userid`, `title`, `typeid`, `logo`, `start1`, `end1`, `start2`, `end2`, `times`, `addr`, `address`, `lnglat`, `tel`, `range`, `price`, `peisong`, `online`, `sale`, `supfapiao`, `fapiao`, `fapiaonote`, `note`, `notice`, `yingyezhizhao`, `weishengxuke`, `state`, `pubdate`) VALUES ('$userid', '$title', '$typeid', '$litpic', '$start1', '$end1', '$start2', '$end2', '$times', '$addrid', '$address', '$lnglat', '$tel', '$range', '$price', '$peisong', '$online', '$sale', '$supfapiao', '$fapiao', '$fapiaonote', '$note', '$notice', '$yingyezhizhao', '$weishengxuke', 0, '$pubdate')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("waimai", "store");

				return "配置成功，您的商铺正在审核中，请耐心等待！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		//更新商铺信息
		}else{

			$certify = "";
			if(!$userResult[0]['yingye']){
				$certify .= " , `yingyezhizhao` = '$yingyezhizhao'";
			}
			if(!$userResult[0]['weisheng']){
				$certify .= " , `weishengxuke` = '$weishengxuke'";
			}

			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__waimai_store` SET `title` = '$title', `typeid` = '$typeid', `logo` = '$litpic', `start1` = '$start1', `end1` = '$end1', `start2` = '$start2', `end2` = '$end2', `times` = '$times', `addr` = '$addrid', `address` = '$address', `lnglat` = '$lnglat', `tel` = '$tel', `range` = '$range', `price` = '$price', `peisong` = '$peisong', `online` = '$online', `sale` = '$sale', `supfapiao` = '$supfapiao', `fapiao` = '$fapiao', `fapiaonote` = '$fapiaonote', `note` = '$note', `notice` = '$notice'".$certify." WHERE `userid` = ".$userid);
			$results = $dsql->dsqlOper($archives, "update");

			if($results == "ok"){
				return "保存成功！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		}


	}




	/**
		* 删除菜单分类
		* @return array
		*/
	public function delMenuType(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$id     = $this->param['id'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($id)){
			return array("state" => 200, "info" => '删除失败，请重试！');
		}

		$sql = $dsql->SetQuery("SELECT t.`id` FROM `#@__waimai_menu_type` t LEFT JOIN `#@__waimai_store` s ON s.`id` = t.`store` WHERE t.`id` = $id AND s.`userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$sql = $dsql->SetQuery("DELETE FROM `#@__waimai_menu` WHERE `typeid` = ".$id);
			$dsql->dsqlOper($sql, "update");

			$sql = $dsql->SetQuery("DELETE FROM `#@__waimai_menu_type` WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");
			return "删除成功！";
		}else{
			return array("state" => 200, "info" => '分类验证失败！');
		}

	}




	/**
		* 更新菜单分类
		* @return array
		*/
	public function updateMenuType(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$store  = $this->param['store'];
		$data   = $_POST['data'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($data)){
			return array("state" => 200, "info" => '请添加分类！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = ".$userid." AND `id` = $store");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$storeid = $ret[0]['id'];

			$data = str_replace("\\", '', $data);
			$json = json_decode($data);

			$json = objtoarr($json);
			$json = $this->proTypeAjax($json, "waimai_menu_type", $store);
			return $json;

		}else{
			return array("state" => 200, "info" => '您的账户暂未开通商品商铺功能！');
		}

	}




	/**
		* 删除相册分类
		* @return array
		*/
	public function delAlbumsType(){
		global $dsql;
		global $userLogin;

		$userid = $userLogin->getMemberID();
		$id     = $this->param['id'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($id)){
			return array("state" => 200, "info" => '删除失败，请重试！');
		}

		$sql = $dsql->SetQuery("SELECT t.`id` FROM `#@__waimai_album_type` t LEFT JOIN `#@__waimai_store` s ON s.`id` = t.`store` WHERE t.`id` = $id AND s.`userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$sql = $dsql->SetQuery("DELETE FROM `#@__waimai_album` WHERE `typeid` = ".$id);
			$dsql->dsqlOper($sql, "update");

			$sql = $dsql->SetQuery("DELETE FROM `#@__waimai_album_type` WHERE `id` = ".$id);
			$dsql->dsqlOper($sql, "update");
			return "删除成功！";
		}else{
			return array("state" => 200, "info" => '分类验证失败！');
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
		$store  = $this->param['store'];
		$data   = $_POST['data'];

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($data)){
			return array("state" => 200, "info" => '请添加分类！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = ".$userid." AND `id` = $store");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$storeid = $ret[0]['id'];

			$data = str_replace("\\", '', $data);
			$json = json_decode($data);

			$json = objtoarr($json);
			$json = $this->proTypeAjax($json, "waimai_album_type", $store);
			return $json;

		}else{
			return array("state" => 200, "info" => '您的账户暂未开通商品商铺功能！');
		}

	}



	//更新分类
	public function proTypeAjax($json, $tab, $store){
		global $dsql;
		for($i = 0; $i < count($json); $i++){
			$id = $json[$i]["id"];
			$name = $json[$i]["val"];

			//如果ID为空则向数据库插入下级分类
			if($id == "" || $id == 0){
				$archives = $dsql->SetQuery("INSERT INTO `#@__".$tab."` (`store`, `typename`, `weight`) VALUES ('$store', '$name', '$i')");
				$id = $dsql->dsqlOper($archives, "lastid");
			}
			//其它为数据库已存在的分类需要验证分类名是否有改动，如果有改动则UPDATE
			else{
				$archives = $dsql->SetQuery("SELECT `typename`, `weight` FROM `#@__".$tab."` WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");
				if(!empty($results)){
					//验证分类名
					if($results[0]["typename"] != $name){
						$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `typename` = '$name' WHERE `id` = ".$id);
						$results = $dsql->dsqlOper($archives, "update");
					}

					//验证排序
					if($results[0]["weight"] != $i){
						$archives = $dsql->SetQuery("UPDATE `#@__".$tab."` SET `weight` = '$i' WHERE `id` = ".$id);
						$results = $dsql->dsqlOper($archives, "update");
					}
				}
			}
		}
		return '保存成功！';

	}


	/**
		* 新增菜单
		* @return array
		*/
	public function addMenu(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$title   = filterSensitiveWords(addslashes($param['title']));
		$typeid  = (int)($param['typeid']);
		$price   = (float)($param['price']);
		$pics    = $param['pics'];
		$note    = filterSensitiveWords(addslashes($param['note']));
		$vdimgck = $param['vdimgck'];
		$pubdate = GetMkTime(time());

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `state` FROM `#@__waimai_store` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通外卖店铺！');
		}

		if($userResult[0]['state'] == 0){
			return array("state" => 200, "info" => '您的店铺信息还在审核中，请通过审核后再发布！');
		}

		if($userResult[0]['state'] == 2){
			return array("state" => 200, "info" => '您的店铺信息审核失败，请通过审核后再发布！');
		}

		$storeid = $userResult[0]['id'];

		if(empty($title)){
			return array("state" => 200, "info" => '请输入菜单名称');
		}

		if(empty($typeid)){
			return array("state" => 200, "info" => '请选择菜单分类');
		}

		if(empty($price)){
			return array("state" => 200, "info" => "请输入价格");
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__waimai_menu` (`store`, `typeid`, `title`, `pics`, `price`, `note`, `pubdate`) VALUES ('$storeid', '$typeid', '$title', '$pics', '$price', '$note', '".GetMkTime(time())."')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			return $aid;
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}



	/**
		* 修改菜单
		* @return array
		*/
	public function editMenu(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$id      = $param['id'];
		$title   = filterSensitiveWords(addslashes($param['title']));
		$typeid  = (int)($param['typeid']);
		$price   = (float)($param['price']);
		$pics    = $param['pics'];
		$note    = filterSensitiveWords(addslashes($param['note']));
		$vdimgck = $param['vdimgck'];

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `state` FROM `#@__waimai_store` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通外卖店铺！');
		}

		if($userResult[0]['state'] == 0){
			return array("state" => 200, "info" => '您的店铺信息还在审核中，请通过审核后再发布！');
		}

		if($userResult[0]['state'] == 2){
			return array("state" => 200, "info" => '您的店铺信息审核失败，请通过审核后再发布！');
		}

		$storeid = $userResult[0]['id'];

		if(empty($title)){
			return array("state" => 200, "info" => '请输入菜单名称');
		}

		if(empty($typeid)){
			return array("state" => 200, "info" => '请选择菜单分类');
		}

		if(empty($price)){
			return array("state" => 200, "info" => "请输入价格");
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__waimai_menu` SET `title` = '$title', `typeid` = '$typeid', `pics` = '$pics', `price` = '$price', `note` = '$note' WHERE `store` = $storeid AND `id` = ".$id);
		$ret = $dsql->dsqlOper($archives, "update");

		if($ret == "ok"){
			return "修改成功！";
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 删除菜单
		* @return array
		*/
	public function delMenu(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = ".$uid);
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			return array("state" => 101, "info" => '店铺信息不存在，删除失败！');
		}else{
			$sid = $ret[0]['id'];
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_menu` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['store'] == $sid){

					//删除图集
					$pics = explode(",", $results['pics']);
					foreach($pics as $k__ => $v__){
						delPicFile($v__, "delAtlas", "waimai");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__waimai_menu` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");
					return '删除成功！';

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '菜单不存在，或已经删除！');
		}

	}


	/**
		* 新增相册
		* @return array
		*/
	public function addAlbums(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$typeid  = (int)($param['typeid']);
		$imglist = $param['imglist'];
		$vdimgck = $param['vdimgck'];
		$pubdate = GetMkTime(time());

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `state` FROM `#@__waimai_store` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通外卖店铺！');
		}

		if($userResult[0]['state'] == 0){
			return array("state" => 200, "info" => '您的店铺信息还在审核中，请通过审核后再发布！');
		}

		if($userResult[0]['state'] == 2){
			return array("state" => 200, "info" => '您的店铺信息审核失败，请通过审核后再发布！');
		}

		$storeid = $userResult[0]['id'];

		if(empty($imglist)){
			return array("state" => 200, "info" => '请上传图片！');
		}

		$imglist = explode("###", $imglist);
		foreach ($imglist as $key => $pic) {
			$val = explode("||", $pic);
			$archives = $dsql->SetQuery("INSERT INTO `#@__waimai_album` (`store`, `typeid`, `title`, `path`, `pubdate`) VALUES ('$storeid', '$typeid', '".$val[1]."', '".$val[0]."', '$pubdate')");
			$dsql->dsqlOper($archives, "results");
		}

		return "添加成功";

	}


	/**
		* 删除相册
		* @return array
		*/
	public function delAlbums(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_store` WHERE `userid` = ".$uid);
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			return array("state" => 101, "info" => '店铺信息不存在，删除失败！');
		}else{
			$sid = $ret[0]['id'];
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_album` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['store'] == $sid){

					//删除图集
					$pics = explode(",", $results['pics']);
					foreach($pics as $k__ => $v__){
						delPicFile($v__, "delAtlas", "waimai");
					}

					$archives = $dsql->SetQuery("DELETE FROM `#@__waimai_album` WHERE `id` = ".$id);
					$dsql->dsqlOper($archives, "update");
					return '删除成功！';

			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '菜单不存在，或已经删除！');
		}

	}


	/**
		* 商家送餐
		* @return array
		*/
	public function peisongOrder(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$id       = (int)($param['id']);
		$songNote = filterSensitiveWords(addslashes($param['songNote']));
		$pubdate = GetMkTime(time());

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `state` FROM `#@__waimai_store` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通外卖店铺！');
		}

		if($userResult[0]['state'] == 0){
			return array("state" => 200, "info" => '您的店铺信息还在审核中，请通过审核后再发布！');
		}

		if($userResult[0]['state'] == 2){
			return array("state" => 200, "info" => '您的店铺信息审核失败，请通过审核后再发布！');
		}

		$storeid = $userResult[0]['id'];

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_order` WHERE `store` = $storeid AND `id` = $id");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){

			$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `state` = 2, `peisong_note` = '$songNote', `songdate` = '$pubdate' WHERE `id` = $id");
			$dsql->dsqlOper($sql, "update");
			return "添加成功";

		}else{
			return array("state" => 200, "info" => '帐号权限验证错误，操作失败！');
		}


	}

	/**
     * 评论 oid 订单，sid 店铺, peisongid 配送员id
     * @return array
     */
	public function common(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$id = $sid = $filter = $orderby = $page = $pageSize = $where = $px = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$oid       = $this->param['oid'];
			$sid       = $this->param['sid'];
			$peisongid = $this->param['peisongid'];
			$orderby   = $this->param['orderby'];
			$page      = $this->param['page'];
			$pageSize  = $this->param['pageSize'];
		}
		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		// if(empty($oid) && empty($sid)) return array("state" => 200, "info" => '格式错误！');

		$need = "*";
		if($oid){
			$where .= " AND `oid` = $oid";
		}
		if($sid){
			$where .= " AND `sid` = $sid";
		}
		if($peisongid){
			$peisongid = $peisongid == 1 ? checkCourierAccount() : $peisongid;
			$where .= " AND `peisongid` = $peisongid";
		}

		$archives = $dsql->SetQuery("SELECT `id` FROM `#@__waimai_common` WHERE 1 = 1".$where);
		//总条数
		$totalCount      = $dsql->dsqlOper($archives, "totalCount");
		//总分页数
		$totalPage = ceil($totalCount/$pageSize);

 		if($totalCount == 0) return array("state" => 200, "info" => '暂无数据！');

		$pageinfo = array(
			"page" => $page,
			"pageSize" => $pageSize,
			"totalPage" => $totalPage,
			"totalCount" => $totalCount
		);

		$archives = $dsql->SetQuery("SELECT * FROM `#@__waimai_common` WHERE 1 = 1".$where);
		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		if(empty($orderby)){
			$orderby = " ORDER BY `id` DESC";
		}


		$results = $dsql->dsqlOper($archives.$orderby.$where, "results");
		if($results){
			foreach($results as $key => $val){
				$cid = $val['id'];

				$sql = $dsql->SetQuery("SELECT `username`, `nickname`, `photo` FROM `#@__member` WHERE `id` = ".$val['uid']);
				$user = $dsql->dsqlOper($sql, "results");
				if($user){
					$user = $user[0];
					$photo = empty($user['photo']) ? "" : getFilePath($user['photo']);
					if($val['isanony']){
						$user = "平台用户";
					}else{
						$user = empty($user['nickname']) ? $user['username'] : $user['nickname'];
					}

				}else{
					$user = "平台用户";
					$photo = "";
				}
				$val['user'] = $user;

				$val['pubdatef'] = date("Y-m-d H:i:s", $val['pubdate']);
				$val['replydatef'] = $val['replydate'] ? date("Y-m-d H:i:s", $val['replydate']) : "";

				$pics = $val['pics'];
				if($pics != ""){
					$pics = explode(",", $pics);
					foreach ($pics as $k => $v) {
						$pics[$k] = getFilePath($v);
					}
					$val['pics'] = $pics;
				}

				$list[$key] = $val;
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);

	}

	/**
		* 发表订单评价
		* @return array
		*/
	public function sendCommon(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$id        = (int)($param['id']);  	 		// 订单id
		$commonid  = (int)($param['commonid']);  	// 评论id 用于修改
		$star      = (int)($param['star']);   		// 星级
		$isanony   = (int)($param['isanony']);   	// 匿名
		$content   = $param['content'];   	 		// 内容
		$starps    = (int)($param['starps']);   	// 星级-配送员
		$contentps = $param['contentps'];   	 	// 内容-配送员
		$pics      = $param['pics'];   	 			// 图集
		$pics      = $param['pics'];   	 			// 图集

		$pubdate = GetMkTime(time());

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($id)) return array("state" => 200, "info" => '参数错误！');
		if(empty($star)) return array("state" => 200, "info" => '请给店铺打分！');
		if(empty($starps)) return array("state" => 200, "info" => '请给配送员打分！');

		$sql = $dsql->SetQuery("SELECT `sid`, `iscomment`, `peisongid`, `paydate`, `okdate` FROM `#@__waimai_order` WHERE `id` = $id");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$sid = $ret[0]['sid'];

			/*if($ret[0]['iscomment']){
				return array("state" => 200, "info" => '您已经评论过！');
			}*/
		}else{
			return array("state" => 200, "info" => '订单不存在！');
		}

		// 修改
		if($commonid){
			$archive = $dsql->SetQuery("UPDATE `#@__waimai_common` SET `star` = '$star', `content` = '$content', `isanony` = '$isanony', `starps` = '$starps', `contentps` = '$contentps', `pics` = '$pics' WHERE `id` = $commonid AND `uid` = $userid");
		}else{
			$paydate = $ret[0]['paydate'];
			$okdate = $ret[0]['okdate'];
			$time = ceil(($okdate-$paydate)/60);
			$archive = $dsql->SetQuery("INSERT INTO `#@__waimai_common` (`oid`, `uid`, `sid`, `peisongid`, `content`, `star`, `isanony`, `starps`, `contentps`, `pics`, `time`, `pubdate`) VALUES ('$id', '$userid', '$sid', '$peisongid', '$content', '$star', '$isanony', '$starps', '$contentps', '$pics', '$time', '$pubdate')");
		}

		$result = $dsql->dsqlOper($archive, "update");
		if($result == "ok"){
			if(empty($commonid)){
				$sql = $dsql->SetQuery("UPDATE `#@__waimai_order` SET `iscomment` = 1 WHERE `id` = $id");
				$dsql->dsqlOper($sql, "update");
			}
			return "提交成功";
		}else{
			return array("state" => 200, "info" => '提交失败！');
		}

	}

	/**
		* 回复评价
		* @return array
		*/
	public function replyCommon(){
		global $dsql;
		global $userLogin;

		$userid  = $userLogin->getMemberID();
		$param   = $this->param;

		$id      = (int)($param['id']);  	 	// 评价id
		$content = ($param['content']);   	 	// 内容

		$pubdate = GetMkTime(time());

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($id)) return array("state" => 200, "info" => '参数错误！');
		if(empty($content)) return array("state" => 200, "info" => '请填写内容！');

		$sql = $dqsl->SetQuery("SELECT `uid`, `sid`, `replaydate` FROM `#@__waimai_common` WHERE `id` = $id");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			if($ret[0]['replydate'] != 0){
				return array("state" => 200, "info" => '您已经回复过');
			}
		}else{
			return array("state" => 200, "info" => '提交失败！');
		}

		$sql = $dqsl->SetQuery("UPDATE `#@__waimai_common` SET `reply` = '$content', `replydate` = '$pubdate' WHERE `id` = $id");
		$ret = $dsql->dsqlOper($sql, "update");
		if($ret == "ok"){
			return "提交成功";
		}else{
			return array("state" => 200, "info" => '提交失败！');
		}

	}


}
