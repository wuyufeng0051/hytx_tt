<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 招聘模块API接口
 *
 * @version        $Id: job.class.php 2014-4-4 上午09:06:25 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class job {
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
     * 招聘基本参数
     * @return array
     */
	public function config(){

		require(HUONIAOINC."/config/job.inc.php");

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
		// global $custom_gs_atlasMax;       //公司图集数量限制
		// global $custom_fair_atlasMax;     //会场图集数量限制
		// global $customTemplate;           //模板风格

		global $cfg_map;                  //系统默认地图
		// global $custom_map;               //自定义地图

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

		//自定义地图配置
		if($custom_map == 0){
			$custom_map = $cfg_map;
		}

		$params = !empty($this->param) && !is_array($this->param) ? explode(',',$this->param) : "";

		// $domainInfo = getDomain('job', 'config');
		// $customChannelDomain = $domainInfo['domain'];
		// if($customSubDomain == 0){
		// 	$customChannelDomain = "http://".$customChannelDomain;
		// }elseif($customSubDomain == 1){
		// 	$customChannelDomain = "http://".$customChannelDomain.".".$cfg_basehost;
		// }elseif($customSubDomain == 2){
		// 	$customChannelDomain = "http://".$cfg_basehost."/".$customChannelDomain;
		// }

		include HUONIAOINC.'/siteModuleDomain.inc.php';
		$customChannelDomain = $jobDomain;

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
				}elseif($param == "gs_atlasMax"){
					$return['gs_atlasMax'] = $custom_gs_atlasMax;
				}elseif($param == "fair_atlasMax"){
					$return['fair_atlasMax'] = $custom_fair_atlasMax;
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
			$return['gs_atlasMax']   = $custom_gs_atlasMax;
			$return['fair_atlasMax'] = $custom_fair_atlasMax;
			$return['template']      = $customTemplate;
			$return['touchTemplate'] = $customTouchTemplate;
			$return['map']           = $custom_map;
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
     * 招聘地区
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
		$results = $dsql->getTypeList($type, "jobaddr", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 职位类别
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
		$results = $dsql->getTypeList($type, "job_type", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 行业类别
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
		$results = $dsql->getTypeList($type, "job_industry", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 职位分类
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
		$results = $dsql->getTypeList($type, "jobitem", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 招聘企业列表
     * @return array
     */
	public function company(){
		global $dsql;
		$pageinfo = $list = array();
		$nature = $scale = $industry = $addrid = $title = $property = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$nature   = $this->param['nature'];
				$scale    = $this->param['scale'];
				$industry = $this->param['industry'];
				$addrid   = $this->param['addrid'];
				$title    = $this->param['title'];
				$property = $this->param['property'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$where = " WHERE com.`state` = 1";

		if(!empty($nature)){
			$where .= " AND com.`nature` = ".$nature;
		}

		if(!empty($scale)){
			$where .= " AND com.`scale` = ".$scale;
		}


		//行业
		if(!empty($industry)){
			if($dsql->getTypeList($industry, "job_industry")){
				$lower = arr_foreach($dsql->getTypeList($industry, "job_industry"));
				$lower = $industry.",".join(',',$lower);
			}else{
				$lower = $industry;
			}
			$where .= " AND com.`industry` in ($lower)";
		}

		if($addrid != ""){
			if($dsql->getTypeList($addrid, "jobaddr")){
				$lower = arr_foreach($dsql->getTypeList($addrid, "jobaddr"));
				$lower = $addrid.",".join(',',$lower);
			}else{
				$lower = $addrid;
			}
			$where .= " AND com.`addrid` in ($lower)";
		}

		if(!empty($title)){
			$where .= " AND com.`title` like '%".$title."%'";
		}

		if(!empty($property)){
			$where .= " AND FIND_IN_SET('".$property."', com.`property`)";
		}

		$by = " ORDER BY com.`weight` DESC, com.`id` DESC";
		//点评数排序
		if($orderby == 1){
			$by = " ORDER BY `rcount` DESC, com.`weight` DESC, com.`id` DESC";

		//职位数排序
		}elseif($orderby == 2){
			$by = " ORDER BY `pcount` DESC, com.`weight` DESC, com.`id` DESC";

		//工资数排序
		}elseif($orderby == 3){
			$by = " ORDER BY `wcount` DESC, com.`weight` DESC, com.`id` DESC";

		//星级排序
		}elseif($orderby == 4){
			$by = " ORDER BY com.`score` DESC, com.`weight` DESC, com.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT
				com.`id`, com.`title`, com.`domaintype`, com.`nature`, com.`scale`, com.`userid`, com.`industry`, com.`logo`, com.`addrid`, com.`address`, com.`lnglat`, com.`score`, com.`property`, com.`pics`,
				(SELECT COUNT(`id`) FROM `#@__job_company_review` WHERE `cid` = com.`id` AND `ischeck` = 1) as rcount,
				(SELECT COUNT(`id`) FROM `#@__job_post` WHERE `company` = com.`id` AND `state` = 1 AND `valid` > ".time().") as pcount,
				(SELECT COUNT(`id`) FROM `#@__job_wage` WHERE `cid` = com.`id` AND `state` = 1) as wcount
				FROM `#@__job_company` as com
				".$where.$by);

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
		if($results){
			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];

				$this->param = "";
				$channelDomain = $this->config();
				$domainInfo = getDomain('job', 'job_company', $val['id']);

				//默认
				if($val["domaintype"] == 0 || ($channelDomain['subDomain'] == 2 && $val["domaintype"] == 2)){
					$list[$key]["domain"] = $channelDomain['channelDomain']."/company-".$val['id'].".html";

				//绑定主域名
				}elseif($val["domaintype"] == 1){
					$list[$key]["domain"] = $domainInfo['domain'];

				//绑定子域名
				}elseif($val["domaintype"] == 2){
					$list[$key]["domain"] = str_replace("http://", "http://".$domainInfo['domain'].".", $channelDomain['channelDomain']);
				}

				//性质
				$nature = $val['nature'];
				if(!empty($nature)){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$nature);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$nature = $typename[0]['typename'];
					}
				}
				$list[$key]["nature"] = $nature;

				//规模
				$scale = $val['scale'];
				if(!empty($scale)){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$scale);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$scale = $typename[0]['typename'];
					}
				}
				$list[$key]["scale"] = $scale;

				//行业
				$industry = $val['industry'];
				if(!empty($industry)){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__job_industry` WHERE `id` = ".$industry);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$industry = $typename[0]['typename'];
					}
				}
				$list[$key]["industry"] = $industry;

				$list[$key]['logo'] = !empty($val['logo']) ? getFilePath($val['logo']) : "";

				$list[$key]['addrid'] = $val['addrid'];

				global $data;
				$data = "";
				$addrArr = getParentArr("jobaddr", $val['addrid']);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$list[$key]['addr'] = $addrArr;

				$list[$key]['address'] = $val['address'];
				$list[$key]['pics']    = $val['pics'];
				$list[$key]['lnglat']  = $val['lnglat'];
				$list[$key]['score']   = $val['score'];
				$list[$key]['property'] = $val['property'];
				$list[$key]['rcount']  = $val['rcount'];
				$list[$key]['pcount']  = $val['pcount'];
				$list[$key]['wcount']  = $val['wcount'];

				//会员信息
				$member = getMemberDetail($val["userid"]);
				$list[$key]["license"] = $member['licenseState'];

				$param = array(
					"service"  => "job",
					"template" => "company",
					"id"       => $val['id']
				);
				$list[$key]["url"] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 招聘企业详细信息
     * @return array
     */
	public function companyDetail(){
		global $dsql;
		global $userLogin;
		$id = $this->param;
		$uid = $userLogin->getMemberID();

		if(!is_numeric($id) && $uid == -1){
			return array("state" => 200, "info" => '格式错误！');
		}

		$where = " AND `state` = 1";
		if(!is_numeric($id)){
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = ".$uid);
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){
				$id = $results[0]['id'];
				$where = "";
			}else{
				return array("state" => 200, "info" => '该会员暂未开通公司！');
			}
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_company` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$this->param = "";
			$channelDomain = $this->config();
			$domainInfo = getDomain('job', 'job_company', $id);

			//默认
			if($results[0]["domaintype"] == 0 || ($channelDomain['subDomain'] == 2 && $results[0]["domaintype"] == 2)){
				$results[0]["domain"] = $channelDomain['channelDomain']."/company-".$id.".html";

			//绑定主域名
			}elseif($results[0]["domaintype"] == 1){
				$results[0]["domain"] = $domainInfo['domain'];

			//绑定子域名
			}elseif($results[0]["domaintype"] == 2){
				$results[0]["domain"] = str_replace("http://", "http://".$domainInfo['domain'].".", $channelDomain['channelDomain']);

			}

			$results[0]["logoSource"] = $results[0]["logo"];
			$results[0]["logo"] = !empty($results[0]['logo']) ? getFilePath($results[0]['logo']) : "";

			global $data;
			$data = "";
			$addrArr = getParentArr("jobaddr", $results[0]['addrid']);
			$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
			$results[0]['addr'] = $addrArr;


			$nature = $results[0]['nature'];
			if(!empty($nature)){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$nature);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$nature = $typename[0]['typename'];
				}
			}
			$results[0]["natureid"] = $results[0]["nature"];
			$results[0]["nature"] = $nature;

			$scale = $results[0]['scale'];
			if(!empty($scale)){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$scale);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$scale = $typename[0]['typename'];
				}
			}
			$results[0]["scaleid"] = $results[0]["scale"];
			$results[0]["scale"] = $scale;


			global $data;
			$data = "";
			$industryArr = getParentArr("job_industry", $results[0]['industry']);
			$industryArr = array_reverse(parent_foreach($industryArr, "typename"));
			$results[0]['industryid'] = $results[0]['industry'];
			$results[0]['industry'] = $industryArr;

			//会员信息
			$member = getMemberDetail($results[0]["userid"]);
			$results[0]["license"] = $member['licenseState'];

			$results[0]['lnglat'] = explode(",", $results[0]['lnglat']);

			$picsArr = array();
			$pics = $results[0]['pics'];
			if(!empty($pics)){
				$pics = explode("###", $pics);
				foreach ($pics as $key => $value) {
					$v = explode("||", $value);
					array_push($picsArr, array("pic" => getFilePath($v[0]), "picSource" => $v[0], "title" => $v[1]));
				}
			}
			$results[0]['pics'] = $picsArr;

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_post` WHERE `state` = 1 AND `valid` > ".time()." AND `company` = ".$id);
			$postCount  = $dsql->dsqlOper($sql, "totalCount");
			$results[0]['pcount'] = $postCount;

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_wage` WHERE `state` = 1 AND `cid` = ".$id);
			$wageCount  = $dsql->dsqlOper($sql, "totalCount");
			$results[0]['wcount'] = $wageCount;

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company_review` WHERE `ischeck` = 1 AND `cid` = ".$id);
			$reviewCount  = $dsql->dsqlOper($sql, "totalCount");
			$results[0]['rcount'] = $reviewCount;

			$results[0]['site'] = str_replace("http://", "", $results[0]['site']);

			return $results[0];
		}
	}


	/**
     * 伯乐列表
     * @return array
     */
	public function bole(){
		global $dsql;
		$pageinfo = $list = array();
		$cid = $btype = $addr = $status = $industry = $zhineng = $title = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$cid      = $this->param['cid'];
				$type     = $this->param['btype'];
				$addr     = $this->param['addr'];
				$status   = $this->param['status'];
				$industry = $this->param['industry'];
				$zhineng  = $this->param['zhineng'];
				$title    = $this->param['title'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$where = " WHERE bole.`state` = 1";

		if(!empty($cid)){
			$where .= " AND bole.`cid` = ".$cid;
		}

		if(!empty($type)){
			$where .= " AND bole.`type` = ".$type;
		}

		if($addr != ""){
			if($dsql->getTypeList($addr, "jobaddr")){
				$lower = arr_foreach($dsql->getTypeList($addr, "jobaddr"));
				$lower = $addr.",".join(',',$lower);
			}else{
				$lower = $addr;
			}
			$where .= " AND bole.`addr` in ($lower)";
		}

		if(!empty($status)){
			$where .= " AND bole.`status` = ".$status;
		}

		if(!empty($industry)){
			$where .= " AND FIND_IN_SET(".$industry.", bole.`industry`)";
		}

		if(!empty($zhineng)){
			$where .= " AND FIND_IN_SET(".$zhineng.", bole.`zhineng`)";
		}

		if(!empty($title)){
			$whe = array();
			$whe[] = "bole.`work` like '%".$title."%'";

			$comSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__job_company` WHERE `title` like '%$title%'");
			$comResult = $dsql->dsqlOper($comSql, "results");
			if($comResult){
				$cid = array();
				foreach($comResult as $key => $com){
					array_push($cid, $com['id']);
				}
				if(!empty($cid)){
					$whe[] = "bole.`cid` in (".join(",", $cid).")";
				}
			}

			$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume` WHERE `name` like '%$title%'");
			$userResult = $dsql->dsqlOper($userSql, "results");
			if($userResult){
				$userid = array();
				foreach($userResult as $key => $user){
					array_push($userid, $user['id']);
				}
				if(!empty($userid)){
					$whe[] = "bole.`userid` in (".join(",", $userid).")";
				}
			}

			$where .= " AND (".join(" OR ", $whe).")";
		}

		$by = " ORDER BY bole.`id` DESC";

		//点评数排序
		if($orderby == 1){
			$by = " ORDER BY `rcount` DESC, bole.`id` DESC";

		//职位数排序
		}elseif($orderby == 2){
			$by = " ORDER BY `pcount` DESC, bole.`id` DESC";

		//粉丝数排序
		}elseif($orderby == 3){
			$by = " ORDER BY `fcount` DESC, bole.`id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT
				bole.`id`, bole.`cid`, bole.`userid`, bole.`work`, bole.`type`, bole.`addr`, bole.`status`, bole.`industry`, bole.`zhineng`,
				(SELECT COUNT(`id`) FROM `#@__job_bole_review` WHERE `bole` = bole.`id` AND `ischeck` = 1) as rcount,
				(SELECT COUNT(`id`) FROM `#@__job_post` WHERE `bole` = bole.`id` AND `state` = 1 AND `valid` > ".time().") as pcount,
				(SELECT `fs` FROM `#@__job_resume` WHERE `id` = bole.`userid` AND `state` = 1) as fcount
				FROM `#@__job_bole` as bole
				".$where.$by);

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
		if($results){
			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];

				$list[$key]['cid'] = $val['cid'];
				$comSql = $dsql->SetQuery("SELECT `title` FROM `#@__job_company` WHERE `id` = ". $val['cid']);
				$comname = $dsql->getTypeName($comSql);
				$list[$key]["company"] = $comname[0]["title"];

				$list[$key]['userid'] = $val['userid'];
				$userSql = $dsql->SetQuery("SELECT `userid`, `name`, `photo` FROM `#@__job_resume` WHERE `id` = ". $val['userid']);
				$username = $dsql->getTypeName($userSql);

				$list[$key]["mid"] = $username[0]["userid"];
				$list[$key]["realname"] = $username[0]["name"];
				$list[$key]["photo"] = !empty($username[0]["photo"]) ? getFilePath($username[0]["photo"]) : "";

				$list[$key]['work'] = $val['work'];
				$list[$key]['type'] = $val['type'];

				global $data;
				$data = "";
				$addrArr = getParentArr("jobaddr", $val['addr']);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$list[$key]['addr'] = $addrArr;

				$list[$key]['status'] = $val['status'];

				$list[$key]['rcount']  = (int)$val['rcount'];
				$list[$key]['pcount']  = (int)$val['pcount'];
				$list[$key]['fcount']  = (int)$val['fcount'];

				$industrySelected = array();
				if(!empty($val['industry'])){
					$industry = explode(",", $val['industry']);
					foreach($industry as $value){
						$archives = $dsql->SetQuery("SELECT * FROM `#@__job_industry` WHERE `id` = $value");
						$results = $dsql->dsqlOper($archives, "results");
						$name = $results ? $results[0]['typename'] : "";
						$industrySelected[] = $name;
					}
				}
				$list[$key]['industry'] = join(",", $industrySelected);

				$zhinengSelected = array();
				if(!empty($val['zhineng'])){
					$zhineng = explode(",", $val['zhineng']);
					foreach($zhineng as $value){
						$archives = $dsql->SetQuery("SELECT * FROM `#@__job_type` WHERE `id` = $value");
						$results = $dsql->dsqlOper($archives, "results");
						$name = $results ? $results[0]['typename'] : "";
						$zhinengSelected[] = $name;
					}
				}
				$list[$key]['zhineng'] = join(",", $zhinengSelected);

				$param = array(
					"service"  => "job",
					"template" => "bole",
					"id"       => $val['id']
				);
				$list[$key]["url"] = getUrlPath($param);

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 伯乐详细信息
     * @return array
     */
	public function boleDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_bole` WHERE `state` = 1 AND `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");

		if($results){

			$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobaddr` WHERE `id` = ".$results[0]['addr']);
			$address = $dsql->dsqlOper($archives, "results");
			if($address){
				$results[0]['addr'] = $address[0]['typename'];
			}else{
				$results[0]['addr'] = "";
			}

			$industrySelected = array();
			if(!empty($results[0]['industry'])){
				$industry = explode(",", $results[0]['industry']);
				foreach($industry as $value){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__job_industry` WHERE `id` = $value");
					$res = $dsql->dsqlOper($archives, "results");
					$name = $res ? $res[0]['typename'] : "";
					$industrySelected[] = $name;
				}
			}
			$results[0]['industry'] = join(",", $industrySelected);

			$zhinengSelected = array();
			if(!empty($results[0]['zhineng'])){
				$zhineng = explode(",", $results[0]['zhineng']);
				foreach($zhineng as $value){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__job_type` WHERE `id` = $value");
					$res = $dsql->dsqlOper($archives, "results");
					$name = $res ? $res[0]['typename'] : "";
					$zhinengSelected[] = $name;
				}
			}
			$results[0]['zhineng'] = join(",", $zhinengSelected);

			unset($results[0]['weight']);
			unset($results[0]['state']);
			unset($results[0]['pubdate']);
			return $results;
		}
	}


	/**
     * 招聘职位
     * @return array
     */
	public function post(){
		global $dsql;
		$pageinfo = $list = array();
		$addr = $jtype = $experience = $educational = $nature = $salary = $company = $com = $bole = $title = $property = $industry = $gnature = $scale = $state = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$addr        = (int)$this->param['addr'];
				$type        = (int)$this->param['jtype'];
				$experience  = (int)$this->param['experience'];
				$educational = (int)$this->param['educational'];
				$nature      = $this->param['nature'];
				$salary      = (int)$this->param['salary'];
				$company     = (int)$this->param['company'];
				$com         = (int)$this->param['com'];
				$bole        = (int)$this->param['bole'];
				$title       = $this->param['title'];
				$property    = $this->param['property'];
				$industry    = $this->param['industry'];
				$gnature     = $this->param['gnature'];
				$scale       = $this->param['scale'];
				$state       = $this->param['state'];
				$orderby     = $this->param['orderby'];
				$page        = $this->param['page'];
				$pageSize    = $this->param['pageSize'];
			}
		}

		if(!$com){
			$where .= " AND `state` = 1";
			$where .= " AND (`valid` > ".GetMkTime(time())." OR `valid` = 0)";
		}

		if(!empty($addr)){
			if($dsql->getTypeList($addr, "jobaddr")){
				$lower = arr_foreach($dsql->getTypeList($addr, "jobaddr"));
				$lower = $addr.",".join(',',$lower);
			}else{
				$lower = $addr;
			}
			$where .= " AND `addr` in ($lower)";
		}

		if(!empty($type)){
			if($dsql->getTypeList($type, "job_type")){
				$lower = arr_foreach($dsql->getTypeList($type, "job_type"));
				$lower = $type.",".join(',',$lower);
			}else{
				$lower = $type;
			}
			$where .= " AND `type` in ($lower)";
		}

		if(!empty($experience)){
			$where .= " AND `experience` = ".$experience;
		}

		if(!empty($educational)){
			$where .= " AND `educational` = ".$educational;
		}

		if($nature != ""){
			$where .= " AND `nature` = ".$nature;
		}

		if(!empty($salary)){
			$where .= " AND `salary` = ".$salary;
		}

		//当前登录企业会员获取公司的职位
		if(empty($company) && $com){

			global $userLogin;
			$uid = $userLogin->getMemberID();

			//判断是否登录
			if($uid != -1){
				$userinfo = $userLogin->getMemberInfo();

				//判断会员类型是否为企业
				if($userinfo['userType'] == 1){
					$company = -1;
				}else{
					$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = ".$uid);
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						$company = $ret[0]['id'];
					}else{
						return array("state" => 200, "info" => '您的企业还未开通招聘店铺，无法发送邀请！');
					}
				}
			}else{
				$company = -3;
			}
		}

		if(!empty($company)){
			$where .= " AND `company` = ".$company;
		}

		if(!empty($bole)){
			$where .= " AND `bole` = ".$bole;
		}

		if(!empty($title)){
			$whe = array();
			$whe[] = "`title` like '%".$title."%'";

			$comSql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__job_company` WHERE `title` like '%$title%'");
			$comResult = $dsql->dsqlOper($comSql, "results");
			if($comResult){
				$cid = array();
				foreach($comResult as $key => $comval){
					array_push($cid, $comval['id']);
				}
				if(!empty($cid)){
					$whe[] = "`company` in (".join(",", $cid).")";
				}
			}

			$where .= " AND (".join(" OR ", $whe).")";
		}

		if(!empty($property)){
			$where .= " AND FIND_IN_SET(".$property.", `property`)";
		}

		//行业
		if(!empty($industry)){
			if($dsql->getTypeList($industry, "job_industry")){
				$lower = arr_foreach($dsql->getTypeList($industry, "job_industry"));
				$lower = $industry.",".join(',',$lower);
			}else{
				$lower = $industry;
			}

			$comSql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `industry` in (".$lower.")");
			$comResult = $dsql->dsqlOper($comSql, "results");
			if($comResult){
				$cid = array();
				foreach($comResult as $key => $comval){
					array_push($cid, $comval['id']);
				}
				if(!empty($cid)){
					$where .= " AND `company` in (".join(",", $cid).")";
				}else{
					$where .= " AND 1 = 2";
				}
			}else{
				$where .= " AND 1 = 2";
			}
		}

		//公司性质
		if(!empty($gnature)){
			$comSql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `nature` = ".$gnature);
			$comResult = $dsql->dsqlOper($comSql, "results");
			if($comResult){
				$cid = array();
				foreach($comResult as $key => $comval){
					array_push($cid, $comval['id']);
				}
				if(!empty($cid)){
					$where .= " AND `company` in (".join(",", $cid).")";
				}else{
					$where .= " AND 1 = 2";
				}
			}else{
				$where .= " AND 1 = 2";
			}
		}

		//公司规模
		if(!empty($scale)){
			$comSql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `scale` = ".$scale);
			$comResult = $dsql->dsqlOper($comSql, "results");
			if($comResult){
				$cid = array();
				foreach($comResult as $key => $comval){
					array_push($cid, $comval['id']);
				}
				if(!empty($cid)){
					$where .= " AND `company` in (".join(",", $cid).")";
				}else{
					$where .= " AND 1 = 2";
				}
			}else{
				$where .= " AND 1 = 2";
			}
		}

		$order = " ORDER BY `weight` DESC, `pubdate` DESC";
		if($orderby == 1){
			$order = " ORDER BY `pubdate` DESC";
		}elseif($orderby == 2){
			$order = " ORDER BY `pubdate` ASC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `type`, `company`, `bole`, `nature`, `number`, `addr`, `experience`, `educational`, `salary`, `note`, `click`, `property`, `pubdate`, `valid`, `state` FROM `#@__job_post` WHERE 1 = 1".$where);

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

		//企业会员中心需要统计信息状态
		if($com == 1 && $uid > -1){
			//待审核
			$state0 = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
			//已审核
			$state1 = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
			//拒绝审核
			$state2 = $dsql->dsqlOper($archives." AND `state` = 2", "totalCount");
			//已过期
			$state3 = $dsql->dsqlOper($archives." AND `valid` < ".time(), "totalCount");

			$pageinfo['state0'] = $state0;
			$pageinfo['state1'] = $state1;
			$pageinfo['state2'] = $state2;
			$pageinfo['state3'] = $state3;
		}

		$atpage = $pageSize*($page-1);
		$where = $pageSize != -1 ? " LIMIT $atpage, $pageSize" : "";

		$where1 = "";
		if($state != ""){
			if($state != 3){
				$where1 = " AND `state` = ".$state;
			}else{
				$where1 = " AND `valid` < ".time();
			}
		}

		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

		if($results){

			$list = array();

			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];

				//职能
				$type = $val['type'];
				if(!empty($type)){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__job_type` WHERE `id` = ".$type);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$type = $typename[0]['typename'];
					}
				}
				$list[$key]["type"] = $type;

				if(!$com){
					$this->param = $val['company'];
					$list[$key]['company'] = $this->companyDetail();
				}

				$this->param = $val['bole'];
				$list[$key]['bole'] = $this->boleDetail();

				$list[$key]['nature'] = $val['nature'];
				$list[$key]['number'] = $val['number'];


				global $data;
				$data = "";
				$addrArr = getParentArr("jobaddr", $val['addr']);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$list[$key]['addr'] = $addrArr;

				$experience = $val['experience'];
				if(!empty($experience)){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$experience);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$experience = $typename[0]['typename'];
					}
				}
				$list[$key]["experience"] = $experience;

				$educational = $val['educational'];
				if(!empty($educational)){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$educational);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$educational = $typename[0]['typename'];
					}
				}
				$list[$key]["educational"] = $educational;


				$salary = $val['salary'];
				if(!empty($salary)){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$salary);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$salary = $typename[0]['typename'];
					}
				}
				$list[$key]["salary"] = $salary;

				$note = nl2br($val['note']);
				$list[$key]['note']     = "<span>".preg_replace("/<br \/>/", "</span><span>", $note)."</span>";
				$list[$key]['click']    = $val['click'];
				$list[$key]['property'] = $val['property'];
				$list[$key]['valid']    = $val['valid'];
				$list[$key]['pubdate']  = $val['pubdate'];
				$list[$key]['timeUpdate'] = FloorTime(GetMkTime(time()) - $val['pubdate']);

				$param = array(
					"service"  => "job",
					"template" => "job",
					"id"       => $val['id']
				);
				$list[$key]["url"] = getUrlPath($param);

				//企业请求输出状态、应聘人数
				if($com){
					$list[$key]['state']  = $val['state'];

					$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_delivery` WHERE `pid` = ".$val['id']);
					$delivery = $dsql->dsqlOper($sql, "totalCount");
					$list[$key]['delivery']  = $delivery;
				}
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 职位详细信息
     * @return array
     */
	public function job(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		global $oper;
		$where = " AND `state` = 1 AND `valid` > ".GetMkTime(time());
		if($oper == "user"){
			$where = "";
		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_post` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			//职能
			$type = $results[0]['type'];
			if(!empty($type)){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__job_type` WHERE `id` = ".$type);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$type = $typename[0]['typename'];
				}
			}
			$results[0]["typeid"] = $results[0]["type"];
			$results[0]["type"] = $type;

			$this->param = $results[0]['company'];
			$results[0]['company'] = $this->companyDetail();

			$this->param = $results[0]['bole'];
			$results[0]['bole'] = $this->boleDetail();

			$experience = $results[0]['experience'];
			if(!empty($experience)){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$experience);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$experience = $typename[0]['typename'];
				}
			}
			$results[0]["experienceid"] = $results[0]["experience"];
			$results[0]["experience"] = $experience;

			$educational = $results[0]['educational'];
			if(!empty($educational)){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$educational);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$educational = $typename[0]['typename'];
				}
			}
			$results[0]["educationalid"] = $results[0]["educational"];
			$results[0]["educational"] = $educational;


			$salary = $results[0]['salary'];
			if(!empty($salary)){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$salary);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$salary = $typename[0]['typename'];
				}
			}
			$results[0]["salaryid"] = $results[0]["salary"];
			$results[0]["salary"] = $salary;

			global $data;
			$data = "";
			$addrArr = getParentArr("jobaddr", $results[0]['addr']);
			$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
			$results[0]['addrid'] = $results[0]['addr'];
			$results[0]['addr'] = $addrArr;

			$results[0]['timeUpdate'] = FloorTime(GetMkTime(time()) - $results[0]['pubdate']);
			$results[0]['note'] = nl2br($results[0]['note']);
			$results[0]['claim'] = nl2br($results[0]['claim']);

			$param = array(
				"service"  => "job",
				"template" => "job",
				"id"       => $id
			);
			$results[0]["url"] = getUrlPath($param);

			unset($results[0]['weight']);
			unset($results[0]['state']);

			return $results[0];
		}
	}


	/**
     * 简历
     * @return array
     */
	public function resume(){
		global $dsql;
		$pageinfo = $list = array();
		$addr = $type = $sex = $nature = $startwork = $workyear = $educational = $orderby = $title = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$addr        = $this->param['addr'];
				$type        = $this->param['jtype'];
				$sex         = $this->param['sex'];
				$nature      = $this->param['nature'];
				$startwork   = $this->param['startwork'];
				$workyear    = $this->param['workyear'];
				$educational = $this->param['educational'];
				$orderby     = $this->param['orderby'];
				$title       = $this->param['title'];
				$page        = $this->param['page'];
				$pageSize    = $this->param['pageSize'];
			}
		}

		$where = " WHERE `state` = 1";

		if($addr != ""){
			if($dsql->getTypeList($addr, "jobaddr")){
				$lower = arr_foreach($dsql->getTypeList($addr, "jobaddr"));
				$lower = $addr.",".join(',',$lower);
			}else{
				$lower = $addr;
			}
			$where .= " AND `addr` in ($lower)";
		}

		if($type != ""){
			if($dsql->getTypeList($type, "job_type")){
				$lower = arr_foreach($dsql->getTypeList($type, "job_type"));
				$lower = $type.",".join(',',$lower);
			}else{
				$lower = $type;
			}
			$where .= " AND `type` in ($lower)";
		}

		if($sex != ''){
			$where .= " AND `sex` = ".$sex;
		}

		if($nature != ''){
			$where .= " AND `nature` = ".$nature;
		}

		if(!empty($startwork)){
			$where .= " AND `startwork` = ".$startwork;
		}

		if($workyear != ''){
			$workyear = explode(",", $workyear);
			if(empty($workyear[0])){
				$where .= " AND `workyear` < " . $workyear[1];
			}elseif(empty($workyear[1])){
				$where .= " AND `workyear` > " . $workyear[0];
			}else{
				$where .= " AND `workyear` BETWEEN " . $workyear[0] . " AND " . $workyear[1];
			}
		}

		if(!empty($educational)){
			$where .= " AND `educational` = ".$educational;
		}

		if(!empty($title)){
			$where .= " AND (`name` like '%".$title."%' OR `college` like '%".$title."%' OR `professional` like '%".$title."%')";
		}

		$by = " ORDER BY `weight` DESC, `id` DESC";
		if($orderby == 1){
			$by = " ORDER BY `pubdate` DESC, `weight` DESC, `id` DESC";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `userid`, `name`, `sex`, `nature`, `type`, `addr`, `birth`, `photo`, `salary`, `workyear`, `educational`, `college`, `professional` FROM `#@__job_resume`".$where.$by);

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

				$list[$key]["id"] = $val['id'];
				$list[$key]["userid"] = $val['userid'];
				$list[$key]["name"] = $val['name'];
				$list[$key]["sex"] = $val['sex'];
				$list[$key]["nature"] = $val['nature'];

				//职能
				$type = "";
				if(!empty($val['type'])){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__job_type` WHERE `id` = ".$val['type']);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$type = $typename[0]['typename'];
					}
				}
				$list[$key]["type"] = $type;

				global $data;
				$data = "";
				$addrArr = getParentArr("jobaddr", $val['addr']);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$list[$key]['addr'] = $addrArr;

				$age = (GetMkTime(time()) - $val['birth']) / 365 / 24 / 3600;
				$list[$key]['age'] = (int)$age;

				$list[$key]["photo"] = !empty($val["photo"]) ? getFilePath($val["photo"]) : "";

				$list[$key]["salary"] = $val['salary'];
				$list[$key]["workyear"] = $val['workyear'];

				$educational = "";
				if(!empty($val['educational'])){
					$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$val['educational']);
					$typename  = $dsql->dsqlOper($archives, "results");
					if($typename){
						$educational = $typename[0]['typename'];
					}
				}
				$list[$key]["educational"] = $educational;


				$list[$key]["college"] = $val['college'];
				$list[$key]["professional"] = $val['professional'];

				$param = array(
					"service"  => "job",
					"template" => "resume",
					"id"       => $val['id']
				);
				$list[$key]["url"] = getUrlPath($param);

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 简历详细信息
     * @return array
     */
	public function resumeDetail(){
		global $dsql;
		$id = $this->param;

		global $userLogin;
		$uid = $userLogin->getMemberID();

		if($uid != -1){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume` WHERE `userid` = ".$uid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$sid = $ret[0]['id'];
			}
		}

		$where = " AND `state` = 1";
		if($uid != -1){
			$where = " AND (`state` = 1 OR `userid` = $uid)";
		}

		if(empty($id)){
			$id = $sid;
		}

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_resume` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$results[0]['code'] = sprintf("%06d", $results[0]['id']);

			$results[0]['age'] = ceil((GetMkTime(time()) - $results[0]['birth']) / 365 / 24 / 3600);

			//职能
			$type = "";
			if(!empty($results[0]['type'])){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__job_type` WHERE `id` = ".$results[0]['type']);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$type = $typename[0]['typename'];
				}
			}
			$results[0]["typename"] = $type;

			global $data;
			$data = "";
			$addrArr = getParentArr("jobaddr", $results[0]['addr']);
			$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
			$results[0]['addrname'] = join(" > ", $addrArr);

			$results[0]["photoSource"] = $results[0]["photo"];
			$results[0]["photo"] = !empty($results[0]["photo"]) ? getFilePath($results[0]["photo"]) : "";

			$educational = "";
			if(!empty($results[0]['educational'])){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$results[0]['educational']);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$educational = $typename[0]['typename'];
				}
			}
			$results[0]["educationalname"] = $educational;

			$startwork = $results[0]['startwork'];
			if(!empty($startwork)){
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$startwork);
				$typename  = $dsql->dsqlOper($archives, "results");
				if($typename){
					$startwork = $typename[0]['typename'];
				}
			}
			$results[0]["startworkname"] = $startwork;

			//关注
			if($results[0]['gz'] > 0){
				$guanzhuArr = array();
				$guanzhu = explode(",", $results[0]['guanzhu']);
				foreach ($guanzhu as $key => $value) {
					$archives = $dsql->SetQuery("SELECT `id`, `name`, `photo` FROM `#@__job_resume` WHERE `id` = ".$value);
					$res = $dsql->dsqlOper($archives, "results");
					if($res){
						$guanzhuArr[$key]['id'] = $res[0]['id'];
						$guanzhuArr[$key]['name'] = $res[0]['name'];
						$guanzhuArr[$key]['photo'] = !empty($res[0]['photo']) ? getFilePath($res[0]['photo']) : "";;
					}
				}
				$results[0]['guanzhu'] = $guanzhuArr;
			}

			//粉丝
			if($results[0]['fs'] > 0){
				$guanzhuArr = array();
				$fensi = explode(",", $results[0]['fensi']);
				foreach ($fensi as $key => $value) {
					$archives = $dsql->SetQuery("SELECT `id`, `name`, `photo` FROM `#@__job_resume` WHERE `id` = ".$value);
					$res = $dsql->dsqlOper($archives, "results");
					if($res){
						$fensiArr[$key]['id'] = $res[0]['id'];
						$fensiArr[$key]['name'] = $res[0]['name'];
						$fensiArr[$key]['photo'] = !empty($res[0]['photo']) ? getFilePath($res[0]['photo']) : "";;
					}
				}
				$results[0]['fensi'] = $fensiArr;
			}

			//工作经验
			$exp = array();
			$experience = $results[0]['experience'];
			if(strstr($experience, "$$")){
				$experience = explode("|||||", $experience);
				foreach ($experience as $key => $value) {
					$v = explode("$$", $value);
					array_push($exp, array($v[0], $v[1], $v[2], $v[3], $v[4], $v[5]));
				}
			}
			$results[0]['experience'] = $exp;

			unset($results[0]['weight']);

			//验证登录会员是否有权限查看联系方式
			$is = false;
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume_view` WHERE `rid` = $id AND `cid` = $uid");
			$ret = $dsql->dsqlOper($sql, "totalCount");
			if($ret > 0){
				$is = true;
			}

			if($uid != $results[0]['userid'] && !$is){
				unset($results[0]['phone']);
				unset($results[0]['email']);
			}

			$param = array(
				"service"  => "job",
				"template" => "resume",
				"id"       => $id
			);
			$results[0]["url"] = getUrlPath($param);

			return $results[0];
		}
	}


	/**
     * 工资统计
     * @return array
     */
	public function wage(){
		global $dsql;
		$pageinfo = $list = array();
		$nature = $scale = $industry = $addrid = $title = $company = $property = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$nature   = $this->param['nature'];
				$scale    = $this->param['scale'];
				$industry = $this->param['industry'];
				$addrid   = $this->param['addrid'];
				$title    = $this->param['title'];
				$company  = $this->param['company'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$where = " WHERE com.`state` = 1";

		if(!empty($nature)){
			$where .= " AND com.`nature` = ".$nature;
		}

		if(!empty($scale)){
			$where .= " AND com.`scale` = ".$scale;
		}

		//行业
		if(!empty($industry)){
			if($dsql->getTypeList($industry, "job_industry")){
				$lower = arr_foreach($dsql->getTypeList($industry, "job_industry"));
				$lower = $industry.",".join(',',$lower);
			}else{
				$lower = $industry;
			}
			$where .= " AND com.`industry` in ($lower)";
		}

		if($addrid != ""){
			if($dsql->getTypeList($addrid, "jobaddr")){
				$lower = arr_foreach($dsql->getTypeList($addrid, "jobaddr"));
				$lower = $addrid.",".join(',',$lower);
			}else{
				$lower = $addrid;
			}
			$where .= " AND com.`addrid` in ($lower)";
		}

		if(!empty($title)){
			$where .= " AND com.`title` like '%".$title."%'";
		}

		$limit = " LIMIT 0, 5";
		if(!empty($company)){
			$where .= " AND com.`id` = ".$company;
			$limit = "";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT
				com.`id`, com.`title`, com.`domaintype`, com.`logo`,
				(SELECT COUNT(`id`) w FROM `#@__job_wage` WHERE `cid` = com.`id` AND `state` = 1) as wcount
				FROM `#@__job_company` as com
				".$where." AND (SELECT COUNT(`id`) w FROM `#@__job_wage` WHERE `cid` = com.`id` AND `state` = 1) > 0 ORDER BY (SELECT COUNT(`id`) w FROM `#@__job_wage` WHERE `cid` = com.`id` AND `state` = 1) DESC, com.`id` DESC");

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
		if($results){
			foreach($results as $key => $val){

				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];

				$this->param = "";
				$channelDomain = $this->config();
				$domainInfo = getDomain('job', 'job_company', $val['id']);

				//默认
				if($val["domaintype"] == 0 || ($channelDomain['subDomain'] == 2 && $val["domaintype"] == 2)){
					$list[$key]["domain"] = $channelDomain['channelDomain']."/company-".$val['id'].".html";

				//绑定主域名
				}elseif($val["domaintype"] == 1){
					$list[$key]["domain"] = $domainInfo['domain'];

				//绑定子域名
				}elseif($val["domaintype"] == 2){
					$list[$key]["domain"] = str_replace("http://", "http://".$domainInfo['domain'].".", $channelDomain['channelDomain']);
				}

				$list[$key]['logo'] = !empty($val['logo']) ? getFilePath($val['logo']) : "";
				$list[$key]['wcount']  = $val['wcount'];

				$param = array(
					"service"  => "job",
					"template" => "company-salary",
					"id"       => $val['id']
				);
				$list[$key]["url"] = getUrlPath($param);


				$wage = array();
				$sql = $dsql->SetQuery("SELECT wage.`id`, wage.`work`,
				(SELECT AVG(`wage`) FROM `#@__job_wage` WHERE `work` = wage.`work` AND `state` = 1 AND `cid` = ".$val['id'].") as avg,
				(SELECT MIN(`wage`) FROM `#@__job_wage` WHERE `work` = wage.`work` AND `state` = 1 AND `cid` = ".$val['id'].") as min,
				(SELECT MAX(`wage`) FROM `#@__job_wage` WHERE `work` = wage.`work` AND `state` = 1 AND `cid` = ".$val['id'].") as max
				FROM `#@__job_wage` AS wage WHERE wage.`state` = 1 AND `cid` = ".$val['id']." GROUP BY wage.`work` ORDER BY wage.`id` ASC".$limit);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					foreach ($ret as $k => $v) {
						$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_wage` WHERE `state` = 1 AND `cid` = ".$val['id']." AND `work` = '".$v['work']."'");
						$res = $dsql->dsqlOper($sql, "totalCount");
						$ret[$k]['count'] = $res;
					}
					$wage = $ret;
				}
				$list[$key]['wage'] = $wage;

			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 企业评论列表
     * @return array
     */
	public function companyReview(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$company = $userid = $orderby = $page = $pageSize = $where = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$company  = $this->param['company'];
			$userid   = $this->param['userid'];
			$orderby  = $this->param['orderby'];
			$page     = $this->param['page'];
			$pageSize = $this->param['pageSize'];
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = "";
		if(!empty($userid)){
			$where = " AND `userid` = ".$userid;
		}

		$oby = " ORDER BY `id` DESC";

		$archives = $dsql->SetQuery("SELECT `id`, `score`, `content`, `gx`, `ip`, `ipaddr`, `dtime` FROM `#@__job_company_review` WHERE `cid` = ".$company." AND `ischeck` = 1 AND `floor` = 0".$where.$oby);
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
				$list[$key]['score']   = $val['score'];
				$list[$key]['content'] = $val['content'];
				$list[$key]['gx']      = $val['gx'];
				$list[$key]['dtime']   = $val['dtime'];
				$list[$key]['ftime']   = floor((GetMkTime(time()) - $val['dtime']/86400)%30) > 30 ? date("Y-m-d", $val['dtime']) : FloorTime(GetMkTime(time()) - $val['dtime']);
				$list[$key]['ip']      = $val['ip'];
				$list[$key]['ipaddr']  = $val['ipaddr'];
				$list[$key]['lower']   = $this->getCompanyCommonList($val['id']);
			}
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
	 * 遍历评论子级
	 * @param $fid int 评论ID
	 * @return array
	 */
	function getCompanyCommonList($fid){
		if(empty($fid)) return false;
		global $dsql;
		global $userLogin;

		$archives = $dsql->SetQuery("SELECT `id`, `content`, `dtime`, `ip`, `ipaddr` FROM `#@__job_company_review` WHERE `floor` = ".$fid." AND `ischeck` = 1 ORDER BY `id` DESC");
		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount > 0){
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $key => $val){
					$list[$key]['id']      = $val['id'];
					$list[$key]['content'] = $val['content'];
					$list[$key]['dtime']   = $val['dtime'];
					$list[$key]['ftime']   = floor((GetMkTime(time()) - $val['dtime']/86400)%30) > 30 ? $val['dtime'] : FloorTime(GetMkTime(time()) - $val['dtime']);
					$list[$key]['ip']      = $val['ip'];
					$list[$key]['ipaddr']  = $val['ipaddr'];
					$list[$key]['lower']   = $this->getCompanyCommonList($val['id']);
				}
				return $list;
			}
		}
	}


	/**
     * 伯乐评论列表
     * @return array
     */
	public function boleReview(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$bole = $userid = $orderby = $page = $pageSize = $where = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$bole  = $this->param['bole'];
			$userid   = $this->param['userid'];
			$orderby  = $this->param['orderby'];
			$page     = $this->param['page'];
			$pageSize = $this->param['pageSize'];
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$where = "";
		if(!empty($userid)){
			$where = " AND `userid` = ".$userid;
		}

		$oby = " ORDER BY `id` DESC";

		$archives = $dsql->SetQuery("SELECT `id`, `content`, `gx`, `ip`, `ipaddr`, `dtime` FROM `#@__job_bole_review` WHERE `bole` = ".$bole." AND `ischeck` = 1".$where.$oby);
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
				$list[$key]['content'] = $val['content'];
				$list[$key]['gx']      = $val['gx'];
				$list[$key]['dtime']   = $val['dtime'];
				$list[$key]['ftime']   = floor((GetMkTime(time()) - $val['dtime']/86400)%30) > 30 ? date("Y-m-d", $val['dtime']) : FloorTime(GetMkTime(time()) - $val['dtime']);
				$list[$key]['ip']      = $val['ip'];
				$list[$key]['ipaddr']  = $val['ipaddr'];
			}
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 一句话求职/招聘
     * @return array
     */
	public function sentence(){
		global $dsql;
		$pageinfo = $list = array();
		$type = $id = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type        = $this->param['type'];
				$id          = $this->param['id'];
				$page        = $this->param['page'];
				$pageSize    = $this->param['pageSize'];
			}
		}

		if(!is_numeric($type)) return array("state" => 200, "info" => '格式错误！');

		$where = " WHERE `state` = 1 AND `type` = ".$type;

		if(!empty($id)){
			$where .= " AND `id` = ".$id;
		}

		$orderby = " ORDER BY `weight` DESC, `id` DESC";

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_sentence`".$where.$orderby);

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
     * 发布一句话求职/招聘
     * @return array
     */
	public function sendGuest(){
		global $dsql;
		$param = $this->param;

		$type     = $param['type'];
		$title    = $param['title'];
		$people   = $param['people'];
		$contact  = $param['contact'];
		$password = $param['password'];
		$note     = $param['note'];

		if(empty($type) || empty($title) || empty($people) || empty($contact) || empty($password) || empty($note)){
			return array("state" => 200, "info" => '必填项不得为空！');
		}

		$archives = $dsql->SetQuery("INSERT INTO `#@__job_sentence` (`type`, `title`, `people`, `contact`, `password`, `note`, `state`, `pubdate`) VALUES ('$type', '$title', '$people', '$contact', '$password', '$note', 0, ".GetMkTime(time()).")");
		$results  = $dsql->dsqlOper($archives, "update");
		if($results == "ok"){
			return "发布成功！";
		}else{
			return array("state" => 200, "info" => '发布失败！');
		}

	}


	/**
     * 招聘会场
     * @return array
     */
	public function fairsCenter(){
		global $dsql;
		$pageinfo = $list = array();
		$addr = $title = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$addr        = $this->param['addr'];
				$title       = $this->param['title'];
				$page        = $this->param['page'];
				$pageSize    = $this->param['pageSize'];
			}
		}


		$where = " WHERE 1 = 1";

		if($addr != ""){
			if($dsql->getTypeList($addr, "jobaddr")){
				$lower = arr_foreach($dsql->getTypeList($addr, "jobaddr"));
				$lower = $addr.",".join(',',$lower);
			}else{
				$lower = $addr;
			}
			$where .= " AND `addr` in ($lower)";
		}

		if(!empty($title)){
			$where .= " AND (`title` like '%".$title."%' OR `address` like '%".$title."%')";
		}

		$orderby = " ORDER BY `id` DESC";

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `people`, `addr`, `address`, `lnglat`, `traffic` FROM `#@__job_fairs_center`".$where.$orderby);

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

		if($results){

			foreach ($results as $key => $val) {
				$list[$key]['id'] = $val['id'];
				$list[$key]['title'] = $val['title'];
				$list[$key]['people'] = $val['people'];

				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__jobaddr` WHERE `id` = ".$val['addr']);
				$address = $dsql->dsqlOper($archives, "results");
				if($address){
					$list[$key]['addr'] = $address[0]['typename'];
				}else{
					$list[$key]['addr'] = "";
				}

				$list[$key]['address'] = $val['address'];
				$list[$key]['lnglat'] = $val['lnglat'];
				$list[$key]['traffic'] = $val['traffic'];

				$param = array(
					"service"  => "job",
					"template" => "fairsCenter",
					"id"       => $val['id']
				);
				$list[$key]["url"] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 招聘会场详细信息
     * @return array
     */
	public function fairsCenterDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_fairs_center` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			global $data;
			$data = "";
			$addrArr = getParentArr("jobaddr", $results[0]['addr']);
			$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
			$results[0]['addr'] = $addrArr;

			$results[0]['lnglat'] = explode(",", $results[0]['lnglat']);

			$picsArr = array();
			$pics = $results[0]['pics'];
			if(!empty($pics)){
				$pics = explode("###", $pics);
				foreach ($pics as $key => $value) {
					$v = explode("||", $value);
					array_push($picsArr, array("pic" => getFilePath($v[0]), "title" => $v[1]));
				}
			}
			$results[0]['pics'] = $picsArr;

			return $results[0];

		}
	}


	/**
     * 招聘会
     * @return array
     */
	public function fairs(){
		global $dsql;
		$pageinfo = $list = array();
		$time = $addr = $center = $date = $title = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$time        = $this->param['time'];
				$addr        = $this->param['addr'];
				$center      = $this->param['center'];
				$date        = $this->param['date'];
				$title       = $this->param['title'];
				$page        = $this->param['page'];
				$pageSize    = $this->param['pageSize'];
			}
		}

		$where = " WHERE 1 = 1";

		if(!empty($time)){
			$times = GetMkTime($time);
			$where .= " AND `date` = '$times'";
		}

		if($addr != ""){
			if($dsql->getTypeList($addr, "jobaddr")){
				$lower = arr_foreach($dsql->getTypeList($addr, "jobaddr"));
				$lower = $addr.",".join(',',$lower);
			}else{
				$lower = $addr;
			}

			$fids = array();
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__job_fairs_center` WHERE `addr` in (".$lower.")");
			$fairs = $dsql->dsqlOper($archives, "results");
			if($fairs){

				foreach ($fairs as $key => $value) {
					$fids[] = $value['id'];
				}

				$where .= " AND `fid` in (".join(",", $fids).")";

			}else{
				$where .= " AND 1 = 2";
			}

		}

		if(!empty($center)){
			$where .= " AND `fid` = $center";
		}

		if(!empty($date)){
			$date = GetMkTime($date);
			$where .= " AND `date` = ".$date;
		}

		if(!empty($title)){
			$where .= " AND `title` like '%".$title."%'";
		}

		$orderby = " ORDER BY `id` DESC";

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `fid`, `title`, `date`, `began`, `end`, `click` FROM `#@__job_fairs`".$where.$orderby);

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

		if($results){

			foreach ($results as $key => $val) {
				$list[$key]['id'] = $val['id'];
				$list[$key]['fid'] = $val['fid'];

				$this->param = $val['fid'];
				$fairsCenterDetail = $this->fairsCenterDetail();
				$list[$key]['fairs'] = $fairsCenterDetail;

				$list[$key]['title'] = $val['title'];
				$list[$key]['date']  = date("Y-m-d", $val['date']);
				$list[$key]['began'] = $val['began'];
				$list[$key]['end']   = $val['end'];
				$list[$key]['click'] = $val['click'];

				$param = array(
					"service"  => "job",
					"template" => "zhaopinhui",
					"id"       => $val['id']
				);
				$list[$key]["url"] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 招聘会详细信息
     * @return array
     */
	public function fairsDetail(){
		global $dsql;
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_fairs` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$this->param = $results[0]['fid'];
			$fairsCenterDetail = $this->fairsCenterDetail();
			$results[0]['fairs'] = $fairsCenterDetail;

			return $results[0];

		}
	}


	/**
     * 招聘资讯
     * @return array
     */
	public function news(){
		global $dsql;
		$pageinfo = $list = array();
		$typeid = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "job_newstype")){
				$lower = arr_foreach($dsql->getTypeList($typeid, "job_newstype"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		$by = " ORDER BY `weight` DESC, `pubdate` DESC";

		//按点击排行
		if($orderby == 1){
			$by = " ORDER BY `click` DESC, `weight` DESC, `pubdate` DESC";

		//今日浏览量
		}elseif($orderby == 2){
			$by = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') = curdate() ORDER BY `click` DESC, `weight` DESC, `pubdate` DESC";

		//本周浏览量
		}elseif($orderby == 3){
			$by = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') >= DATE_SUB(curdate(), INTERVAL 7 DAY) ORDER BY `click` DESC, `weight` DESC, `pubdate` DESC";

		//本月浏览量
		}elseif($orderby == 4){
			$by = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m') = DATE_FORMAT(curdate(), '%Y-%m') ORDER BY `click` DESC, `weight` DESC, `pubdate` DESC";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `typeid`, `litpic`, `click`, `description`, `pubdate` FROM `#@__job_news` WHERE `arcrank` = 0".$where.$by);
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
				$list[$key]['typeid'] = $value['typeid'];
				$list[$key]['litpic'] = !empty($value['litpic']) ? getFilePath($value['litpic']) : "";

				$typename = "";
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_newstype` WHERE `id` = ".$value['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typename = $ret[0]['typename'];
				}
				$list[$key]['typename'] = $typename;

				$list[$key]['click'] = $value['click'];
				$list[$key]['description'] = $value['description'];
				$list[$key]['pubdate'] = $value['pubdate'];

				$param = array(
					"service"  => "job",
					"template" => "news-detail",
					"id"       => $value['id']
				);
				$list[$key]["url"] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 资讯信息详细
     * @return array
     */
	public function newsDetail(){
		global $dsql;
		$newsDetail = array();

		if(empty($this->param)){
			return array("state" => 200, "info" => '信息ID不得为空！');
		}

		if(!is_numeric($this->param)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT * FROM `#@__job_news` WHERE `arcrank` = 0 AND `id` = ".$this->param);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$newsDetail["title"]       = $results[0]['title'];
			$newsDetail["typeid"]      = $results[0]['typeid'];

			$typename = "";
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_newstype` WHERE `id` = ".$results[0]['typeid']);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typename = $ret[0]['typename'];
			}
			$newsDetail['typename'] = $typename;

			$newsDetail["click"]       = $results[0]['click'];
			$newsDetail["source"]      = $results[0]['source'];
			$newsDetail["sourceUrl"]   = $results[0]['sourceUrl'];
			$newsDetail["writer"]      = $results[0]['writer'];
			$newsDetail["keyword"]     = $results[0]['keyword'];
			$newsDetail["description"] = $results[0]['description'];
			$newsDetail["body"]        = $results[0]['body'];
			$newsDetail["pubdate"]     = $results[0]['pubdate'];
		}
		return $newsDetail;
	}


	/**
     * 资讯分类
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
		$results = $dsql->getTypeList($type, "job_newstype", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 招聘文档
     * @return array
     */
	public function download(){
		global $dsql;
		$pageinfo = $list = array();
		$typeid = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "job_download_type")){
				$lower = arr_foreach($dsql->getTypeList($typeid, "job_download_type"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `title`, `typeid`, `file`, `click`, `note`, `pubdate` FROM `#@__job_download` WHERE `arcrank` = 0".$where." ORDER BY `weight` DESC, `pubdate` DESC");
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
				$list[$key]['typeid'] = $value['typeid'];

				$typename = "";
				$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_newstype` WHERE `id` = ".$value['typeid']);
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$typename = $ret[0]['typename'];
				}
				$list[$key]['typename'] = $typename;

				$size = 0;
				if(!empty($value['file'])){
					$RenrenCrypt = new RenrenCrypt();
					$fid = $RenrenCrypt->php_decrypt(base64_decode($value['file']));

					if(is_numeric($fid)){
						$sql = $dsql->SetQuery("SELECT `filesize` FROM `#@__attachment` WHERE `id` = '$fid'");
						$ret = $dsql->dsqlOper($sql, "results");
						if($ret){
							$size = $ret[0]['filesize'];
						}
					}
				}

				$list[$key]['size'] = sizeformat($size);


				$list[$key]['click'] = $value['click'];
				$list[$key]['note'] = $value['note'];
				$list[$key]['pubdate'] = $value['pubdate'];

				$param = array(
					"service"  => "job",
					"template" => "doc-detail",
					"id"       => $value['id']
				);
				$list[$key]["url"] = getUrlPath($param);
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 文档下载
     * @return array
     */
	public function downloadFile(){
		global $dsql;
		global $userLogin;
		$userid = $userLogin->getMemberID();

		if($userid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		$id = $this->param['id'];

		if(empty($id)){
			return array("state" => 200, "info" => '文档ID不得为空！');
		}

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		$path = "";
		$archives = $dsql->SetQuery("SELECT `file` FROM `#@__job_download` WHERE `arcrank` = 0 AND `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$file = $results[0]['file'];
			if(!empty($file)){
				$path = getFilePath($file);
			}

			$archives = $dsql->SetQuery("UPDATE `#@__job_download` SET `click` = `click` + 1 WHERE `id` = ".$id);
			$dsql->dsqlOper($archives, "update");
		}

		if(!empty($path)){
			return $path;
		}else{
			return array("state" => 200, "info" => '文档不存在或已经删除，下载失败！');
		}
	}


	/**
     * 文档分类
     * @return array
     */
	public function downloadType(){
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
		$results = $dsql->getTypeList($type, "job_download_type", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}




	/**
		* 热门工资统计
		* @return array
		*/
	public function hotpayroll(){
		global $dsql;
		$type = "";
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$type = $this->param['type'];
			}
		}

		if($type != "industry" && $type != "company" && $type != "area"){
			return array("state" => 200, "info" => '格式错误！');
		}

		$names = $values = array();


		//行业
		if($type == "industry"){

			$sql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__job_industry` WHERE `parentid` = 0 ORDER BY `weight` ASC LIMIT 0, 10");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret) return array("state" => 200, "info" => '没有相关行业数据！');

			foreach ($ret as $k => $v) {

				$id = $v['id'];
				$typename = $v['typename'];

				global $arr_data;
				$arr_data = "";
				if($dsql->getTypeList($id, "job_industry")){
					$lower = arr_foreach($dsql->getTypeList($id, "job_industry"));
					$lower = $id.",".join(',',$lower);
				}else{
					$lower = $id;
				}

				$wage = 0;
				$sql = $dsql->SetQuery("SELECT avg(w.`wage`) as wage FROM `#@__job_wage` w LEFT JOIN `#@__job_company` c ON c.`id` = w.`cid` WHERE c.`industry` in ($lower)");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$wage = sprintf("%.2f", $ret[0]['wage']);
				}


				array_push($names, $typename);
				array_push($values, (float)$wage);

			}


		//公司
		}elseif ($type == "company") {

			$sql = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__job_company` WHERE FIND_IN_SET('m', `property`) ORDER BY `weight` DESC, `id` DESC LIMIT 0, 10");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				foreach ($ret as $key => $value) {
					$company = $value['title'];
					$id      = $value['id'];
					$wage    = 0;

					$sql = $dsql->SetQuery("SELECT avg(`wage`) as wage FROM `#@__job_wage` WHERE `cid` = $id");
					$ret = $dsql->dsqlOper($sql, "results");
					if($ret){
						$wage = sprintf("%.2f", $ret[0]['wage']);
					}

					array_push($names, $company);
					array_push($values, (float)$wage);
				}

			}


		//区域
		}elseif ($type == "area") {

			$sql = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__jobaddr` WHERE `parentid` = 0 ORDER BY `weight` ASC");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret) return array("state" => 200, "info" => '没有相关行业数据！');

			foreach ($ret as $k => $v) {

				$id = $v['id'];
				$typename = $v['typename'];

				global $arr_data;
				$arr_data = "";
				if($dsql->getTypeList($id, "jobaddr")){
					$lower = arr_foreach($dsql->getTypeList($id, "jobaddr"));
					$lower = $id.",".join(',',$lower);
				}else{
					$lower = $id;
				}

				$wage = 0;
				$sql = $dsql->SetQuery("SELECT avg(w.`wage`) as wage FROM `#@__job_wage` w LEFT JOIN `#@__job_company` c ON c.`id` = w.`cid` WHERE c.`addrid` in ($lower)");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$wage = sprintf("%.2f", $ret[0]['wage']);
				}


				array_push($names, $typename);
				array_push($values, (float)$wage);

			}

		}

		if($names && $values){
			return array("names" => $names, "values" => $values);
		}else{
			return array("state" => 200, "info" => '暂无相关数据！');
		}


	}




	/**
		* 晒工资
		* @return array
		*/
	public function addsalary(){
		global $dsql;
		$type = "";
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$cid     = $this->param['cid'];
				$company = filterSensitiveWords(addslashes($this->param['company']));
				$addr    = $this->param['addr'];
				$work    = filterSensitiveWords(addslashes($this->param['work']));
				$wage    = (int)sprintf("%.2f", $this->param['wage']);
			}
		}
		global $userLogin;
		$userid = $userLogin->getMemberID();

		if($userid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		if(empty($cid) && empty($company)) return array("state" => 200, "info" => '请输入您所在的公司');
		if(empty($addr)) return array("state" => 200, "info" => '请选择您所在的工作地点');
		if(empty($work)) return array("state" => 200, "info" => '请输入你所担任的职位');
		if(empty($wage)) return array("state" => 200, "info" => '请输入你的每月工资');

		//验证公司
		if(empty($cid) && !empty($company)){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `title` = '".$company."'");
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret) return array("state" => 200, "info" => '您输入的公司暂未收录，发布失败！');
			$cid = $ret[0]['id'];
		}
		if(!empty($cid)){
			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `id` = ".$cid);
			$ret = $dsql->dsqlOper($sql, "results");
			if(!$ret) return array("state" => 200, "info" => '您输入的公司不存在或已经删除，发布失败！');
		}

		//验证是否发布过
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_wage` WHERE `cid` = $cid AND `work` = '".$work."'");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			return array("state" => 200, "info" => '您已经发布过工资信息，不需要重复发布！');
		}

		$sql = $dsql->SetQuery("INSERT INTO `#@__job_wage` (`cid`, `userid`, `addr`, `work`, `wage`, `state`, `pubdate`) VALUES ('$cid', '$userid', '$addr', '$work', '$wage', 0, ".GetMkTime(time()).")");
		$aid = $dsql->dsqlOper($sql, "lastid");

		if(is_numeric($aid)){
			return '发布成功！';
		}else{
			return array("state" => 200, "info" => '发布失败');
		}

	}


	/**
		* 更新&添加简历
		* @return array
		*/
	public function updateResume(){
		global $dsql;
		global $userLogin;

		$param = $this->param;
		$uid   = $userLogin->getMemberID();
		if($uid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		$photo        = $param['photo'];
		$name         = filterSensitiveWords(addslashes($param['name']));
		$sex          = (int)$param['sex'];
		$birth        = GetMkTime($param['birth']);
		$home         = filterSensitiveWords(addslashes($param['home']));
		$address      = filterSensitiveWords(addslashes($param['address']));
		$phone        = $param['phone'];
		$email        = $param['email'];
		$addr         = (int)$param['addr'];
		$nature       = (int)$param['nature'];
		$type         = (int)$param['type'];
		$salary       = (int)$param['salary'];
		$startwork    = (int)$param['startwork'];
		$workyear     = (int)$param['workyear'];
		$experience   = filterSensitiveWords(addslashes($param['experience']));
		$educational  = (int)$param['educational'];
		$college      = filterSensitiveWords(addslashes($param['college']));
		$graduation   = !empty($param['graduation']) ? GetMkTime($param['graduation']) : 0;
		$professional = filterSensitiveWords(addslashes($param['professional']));
		$language     = filterSensitiveWords(addslashes($param['language']));
		$computer     = filterSensitiveWords(addslashes($param['computer']));
		$education    = filterSensitiveWords(addslashes($param['education']));
		$evaluation   = filterSensitiveWords(addslashes($param['evaluation']));
		$objective    = filterSensitiveWords(addslashes($param['objective']));
		$pubdate      = GetMkTime(time());

		if(empty($name)) return array("state" => 200, "info" => '请输入您的姓名！');
		if(empty($birth)) return array("state" => 200, "info" => '请选择您的出生日期！');
		if(empty($home)) return array("state" => 200, "info" => '请输入您的户籍地址！');
		if(empty($address)) return array("state" => 200, "info" => '请输入您的现居地址！');
		if(empty($phone)) return array("state" => 200, "info" => '请输入您的联系电话！');

		preg_match('/0?(13|14|15|17|18)[0-9]{9}/', $phone, $matchPhone);
		if(!$matchPhone) return array("state" => 200, "info" => '请输入正确的手机号码！');

		if(empty($email)) return array("state" => 200, "info" => '请输入您的邮箱！');

		preg_match('/\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/', $email, $matchEmail);
		if(!$matchEmail) return array("state" => 200, "info" => '请输入正确的邮箱地址！');

		if(empty($addr)) return array("state" => 200, "info" => '请选择您的意向工作地点！');
		if(empty($type)) return array("state" => 200, "info" => '请选择您的意向职位！');
		if(empty($salary)) return array("state" => 200, "info" => '请输入您的期望薪资！');
		if(empty($startwork)) return array("state" => 200, "info" => '请选择到岗时间！');
		if(empty($workyear)) return array("state" => 200, "info" => '请输入您的工作年限！');
		if(empty($educational)) return array("state" => 200, "info" => '请选择您的最高学历！');

		$title   = cn_substrR($title, 15);
		$home    = cn_substrR($home, 20);
		$address = cn_substrR($address, 20);
		$email   = cn_substrR($email, 30);
		$college = cn_substrR($college, 30);
		$professional = cn_substrR($professional, 20);
		$language = cn_substrR($language, 20);
		$computer = cn_substrR($computer, 20);

		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume` WHERE `userid` = ".$uid);
		$ret = $dsql->dsqlOper($sql, "results");

		//已有简历，更新
		if($ret){

			$id = $ret[0]['id'];

			$sql = $dsql->SetQuery("UPDATE `#@__job_resume` SET `name` = '$name', `sex` = '$sex', `nature` = '$nature', `type` = '$type', `addr` = '$addr', `birth` = '$birth', `photo` = '$photo', `home` = '$home', `address` = '$address', `phone` = '$phone', `email` = '$email', `salary` = '$salary', `startwork` = '$startwork', `evaluation` = '$evaluation', `objective` = '$objective', `workyear` = '$workyear', `experience` = '$experience', `educational` = '$educational', `college` = '$college', `graduation` = '$graduation', `professional` = '$professional', `language` = '$language', `computer` = '$computer', `education` = '$education', `state` = 1, `pubdate` = '$pubdate' WHERE `id` = ".$id);
			$ret = $dsql->dsqlOper($sql, "update");
			if($ret == "ok"){
				return "更新成功！";
			}else{
				return array("state" => 200, "info" => '更新失败！');
			}

		//没有简历，新增
		}else{

			$sql = $dsql->SetQuery("INSERT INTO `#@__job_resume` (`userid`, `name`, `sex`, `nature`, `type`, `addr`, `birth`, `photo`, `home`, `address`, `phone`, `email`, `salary`, `startwork`, `evaluation`, `objective`, `workyear`, `experience`, `educational`, `college`, `graduation`, `professional`, `language`, `computer`, `education`, `state`, `pubdate`) VALUES ('$uid', '$name', '$sex', '$nature', '$type', '$addr', '$birth', '$photo', '$home', '$address', '$phone', '$email', '$salary', '$startwork', '$evaluation', '$objective', '$workyear', '$experience', '$educational', '$college', '$graduation', '$professional', '$language', '$computer', '$education', 1, '$pubdate')");
			$aid = $dsql->dsqlOper($sql, "lastid");
			if(is_numeric($aid)){
				return "保存成功！";
			}else{
				return array("state" => 200, "info" => '保存失败！');
			}

		}

	}



	/**
		* 投递简历
		* @return array
		*/
	public function delivery(){
		global $dsql;
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$id = $this->param['id'];
			}
		}
		if(empty($id)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		//根据登录ID查询简历ID
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume` WHERE `userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$rid = $ret[0]['id'];
		}else{
			return array("state" => 200, "info" => '您还未创建简历，无法投递！');
		}

		$ids = explode(",", $id);
		foreach ($ids as $key => $value) {

			//查询公司信息
			$sql = $dsql->SetQuery("SELECT `company` FROM `#@__job_post` WHERE `id` = ".$value);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$cid = $ret[0]['company'];

				//验证是否已经投递
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_delivery` WHERE `rid` = '$rid' AND `cid` = '$cid' AND `pid` = '$value'");
				$ret = $dsql->dsqlOper($sql, "results");
				if(!$ret){
					$sql = $dsql->SetQuery("INSERT INTO `#@__job_delivery` (`rid`, `cid`, `pid`, `state`, `date`) VALUES ('$rid', '$cid', '$value', 0, ".GetMkTime(time()).")");
					$dsql->dsqlOper($sql, "update");
				}
			}
		}
		return '投递成功！';

	}


	/**
     * 投递记录
     * @return array
     */
	public function deliveryList(){
		global $dsql;
		$pageinfo = $list = array();
		$rid = $cid = $type = $state = $orderby = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$rid      = $this->param['rid'];
				$cid      = $this->param['cid'];
				$type     = $this->param['type'];
				$state    = (int)$this->param['state'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($type)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();

		//查询人才投递记录
		if($type == "person"){
			if(empty($rid)){
				if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume` WHERE `userid` = ".$userid);
				$ret = $dsql->dsqlOper($sql, "results");
				if(!$ret){
					return array("state" => 200, "info" => '会员还未创建简历！');
				}else{
					$rid = $ret[0]['id'];
				}
			}
			$where = " AND `rid` = ".$rid;

		//查询公司被投记录
		}elseif($type == "company"){
			if(empty($cid)){
				if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = ".$userid);
				$ret = $dsql->dsqlOper($sql, "results");
				if(!$ret){
					return array("state" => 200, "info" => '会员还未开通招聘店铺！');
				}else{
					$cid = $ret[0]['id'];
				}
			}
			$where = " AND `cid` = ".$cid;

		}else{
			return array("state" => 200, "info" => '格式错误！');
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `rid`, `cid`, `pid`, `date`, `state` FROM `#@__job_delivery` WHERE 1 = 1".$where);
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

		if($type == "company"){
			//待处理
			$state0 = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
			//已面试
			$state1 = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
			//不合适
			$state2 = $dsql->dsqlOper($archives." AND `state` = 2", "totalCount");

			$pageinfo['state0'] = $state0;
			$pageinfo['state1'] = $state1;
			$pageinfo['state2'] = $state2;
		}


		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$where1 = "";
		if($type == "company" && $state !== ""){
			$where1 = " AND `state` = ".$state;
		}

		$list = array();
		$results = $dsql->dsqlOper($archives.$where1." ORDER BY `id` DESC".$where, "results");
		if($results){
			foreach ($results as $key => $value) {
				$list[$key]['id']  = $value['id'];
				if($type == "company"){
					$this->param = $value['rid'];
					$detail = $this->resumeDetail();
					$list[$key]['resume'] = $detail;
				}

				$this->param = $value['pid'];
				$detail = $this->job();
				$list[$key]['post'] = array(
					"title" => $detail['title'],
					"url"   => $detail['url'],
					"company" => $detail['company']['title'],
					"domain"  => $detail['company']['domain']
				);

				$list[$key]['date'] = date("Y-m-d H:i:s", $value['date']);
				$list[$key]['state'] = $value['state'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}



	/**
		* 更新简历投递状态
		* @return array
		*/
	public function deliveryUpdate(){
		global $dsql;
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$id    = (int)$this->param['id'];
				$state = (int)$this->param['state'];
			}
		}
		if(empty($id)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		//根据登录ID查询简历ID
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$cid = $ret[0]['id'];
		}else{
			return array("state" => 200, "info" => '您还未填写简历，操作失败！');
		}

		//验证信息权限
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_delivery` WHERE `cid` = $cid AND `id` = $id");
		$ret = $dsql->dsqlOper($sql, "totalCount");
		if($ret == 0){
			return array("state" => 200, "info" => '权限验证失败，操作无法完成！');
		}else{
			$sql = $dsql->SetQuery("UPDATE `#@__job_delivery` SET `state` = $state WHERE `id` = $id");
			$dsql->dsqlOper($sql, "update");
			return '更新成功！';
		}

	}



	/**
		* 企业查看简历联系方式
		* @return array
		*/
	public function viewResume(){
		global $dsql;
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$id = $this->param['id'];
			}
		}
		if(empty($id)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		$userinfo = $userLogin->getMemberInfo();
		if($userinfo['userType'] == 1) return array("state" => 200, "info" => '对不起，简历的联系方式仅限企业会员查看！');

		//验证是否已经查看过
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume_view` WHERE `rid` = $id AND `cid` = $userid");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			return "已经查看过，无需支付积分！";
		}else{

			$sql = $dsql->SetQuery("INSERT INTO `#@__job_resume_view` (`rid`, `cid`, `date`) VALUES ('$id', '$userid', ".GetMkTime(time()).")");
			$ret = $dsql->dsqlOper($sql, "update");
			if($ret == "ok"){
				return "操作成功！";
			}else{
				return array("state" => 200, "info" => '数据库错误，查看失败！');
			}
		}

	}



	/**
		* 邀请面试
		* @return array
		*/
	public function invitation(){
		global $dsql;
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$pid = $this->param['pid'];
				$rid = $this->param['rid'];
			}
		}
		if(empty($pid) || empty($rid)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		//根据登录ID查询公司ID
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$cid = $ret[0]['id'];
		}else{
			return array("state" => 200, "info" => '您还未开通招聘店铺，无法邀请！');
		}

		//查询职位ID是否属于该公司
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_post` WHERE `id` = $pid AND `company` = $cid");
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			return array("state" => 200, "info" => '权限出错，请检查你邀请的职位！');
		}

		//验证是否已经邀请过
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_invitation` WHERE `rid` = $rid AND `cid` = $cid AND `pid` = $pid");
		$ret = $dsql->dsqlOper($sql, "totalCount");
		if($ret > 0){
			return array("state" => 200, "info" => '已经邀请过，无需再次邀请！');
		}else{
			$sql = $dsql->SetQuery("INSERT INTO `#@__job_invitation` (`rid`, `cid`, `pid`, `state`, `date`) VALUES ('$rid', '$cid', '$pid', 0, ".GetMkTime(time()).")");
			$dsql->dsqlOper($sql, "update");
			return '邀请成功！';
		}

	}


	/**
     * 邀请记录
     * @return array
     */
	public function invitationList(){
		global $dsql;
		$pageinfo = $list = array();
		$rid = $cid = $type = $orderby = $state = $page = $pageSize = $where = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$rid      = $this->param['rid'];
				$cid      = $this->param['cid'];
				$type     = $this->param['type'];
				$state    = (int)$this->param['state'];
				$orderby  = $this->param['orderby'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		if(empty($type)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();

		//查询被邀请记录
		if($type == "person"){
			if(empty($rid)){
				if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume` WHERE `userid` = ".$userid);
				$ret = $dsql->dsqlOper($sql, "results");
				if(!$ret){
					return array("state" => 200, "info" => '会员还未创建简历！');
				}else{
					$rid = $ret[0]['id'];
				}
			}
			$where = " AND `rid` = ".$rid;

		//查询公司被投记录
		}elseif($type == "company"){
			if(empty($cid)){
				if($userid == -1) return array("state" => 200, "info" => '登录超时，请重新登录！');
				$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = ".$userid);
				$ret = $dsql->dsqlOper($sql, "results");
				if(!$ret){
					return array("state" => 200, "info" => '会员还未开通招聘店铺！');
				}else{
					$cid = $ret[0]['id'];
				}
			}
			$where = " AND `cid` = ".$cid;

		}else{
			return array("state" => 200, "info" => '格式错误！');
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$archives = $dsql->SetQuery("SELECT `id`, `rid`, `cid`, `pid`, `date`, `state` FROM `#@__job_invitation` WHERE 1 = 1".$where);
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

		if($type == "person"){
			//待处理
			$state0 = $dsql->dsqlOper($archives." AND `state` = 0", "totalCount");
			//已面试
			$state1 = $dsql->dsqlOper($archives." AND `state` = 1", "totalCount");
			//不合适
			$state2 = $dsql->dsqlOper($archives." AND `state` = 2", "totalCount");

			$pageinfo['state0'] = $state0;
			$pageinfo['state1'] = $state1;
			$pageinfo['state2'] = $state2;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$where1 = "";
		if($type == "person" && $state !== ""){
			$where1 = " AND `state` = ".$state;
		}

		$list = array();
		$results = $dsql->dsqlOper($archives.$where1." ORDER BY `id` DESC".$where, "results");
		if($results){
			foreach ($results as $key => $value) {
				$list[$key]['id']  = $value['id'];
				if($type == "company"){
					$this->param = $value['rid'];
					$detail = $this->resumeDetail();
					$list[$key]['resume'] = $detail;
				}

				$this->param = $value['pid'];
				$detail = $this->job();
				$list[$key]['post'] = array(
					"title" => $detail['title'],
					"url"   => $detail['url'],
					"company" => $detail['company']['title'],
					"domain"  => $detail['company']['domain']
				);

				$list[$key]['date'] = date("Y-m-d H:i:s", $value['date']);
				$list[$key]['state'] = $value['state'];
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}



	/**
		* 更新面试邀请状态
		* @return array
		*/
	public function invitationUpdate(){
		global $dsql;
		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$id    = (int)$this->param['id'];
				$state = (int)$this->param['state'];
			}
		}
		if(empty($id)) return array("state" => 200, "info" => '格式错误！');

		global $userLogin;
		$userid = $userLogin->getMemberID();
		if($userid == -1) return array("state" => 200, "info" => '登录超时请刷新页面重试');

		//根据登录ID查询简历ID
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_resume` WHERE `userid` = ".$userid);
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			$rid = $ret[0]['id'];
		}else{
			return array("state" => 200, "info" => '您还未填写简历，操作失败！');
		}

		//验证信息权限
		$sql = $dsql->SetQuery("SELECT `id` FROM `#@__job_invitation` WHERE `rid` = $rid AND `id` = $id");
		$ret = $dsql->dsqlOper($sql, "totalCount");
		if($ret == 0){
			return array("state" => 200, "info" => '权限验证失败，操作无法完成！');
		}else{
			$sql = $dsql->SetQuery("UPDATE `#@__job_invitation` SET `state` = $state WHERE `id` = $id");
			$dsql->dsqlOper($sql, "update");
			return '更新成功！';
		}

	}



	/**
		* 配置商铺
		* @return array
		*/
	public function storeConfig(){
		global $dsql;
		global $userLogin;

		$userid   = $userLogin->getMemberID();
		$param    = $this->param;
		$title    = filterSensitiveWords(addslashes($param['title']));
		$nature   = (int)$param['nature'];
		$scale    = (int)$param['scale'];
		$industry = (int)$param['industry'];
		$logo     = $param['logo'];
		$people   = filterSensitiveWords(addslashes($param['people']));
		$contact  = filterSensitiveWords(addslashes($param['contact']));
		$email    = filterSensitiveWords(addslashes($param['email']));
		$addrid   = (int)$param['addrid'];
		$address  = filterSensitiveWords(addslashes($param['address']));
		$lnglat   = $param['lnglat'];
		$postcode = filterSensitiveWords(addslashes($param['postcode']));
		$site     = filterSensitiveWords(addslashes($param['site']));
		$body     = filterSensitiveWords(addslashes($param['body']));
		$pics     = $param['pics'];
		$vdimgck  = $param['vdimgck'];
		$pubdate  = GetMkTime(time());

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

		if(empty($nature)){
			return array("state" => 200, "info" => '请选择公司性质');
		}

		if(empty($scale)){
			return array("state" => 200, "info" => '请选择公司规模');
		}

		if(empty($industry)){
			return array("state" => 200, "info" => '请选择经营行业');
		}

		if(empty($logo)){
			return array("state" => 200, "info" => '请上传公司LOGO');
		}

		if(empty($people)){
			return array("state" => 200, "info" => '请输入联系人');
		}

		if(empty($contact)){
			return array("state" => 200, "info" => '请输入联系电话');
		}

		if(empty($email)){
			return array("state" => 200, "info" => '请输入联系邮箱');
		}

		if(empty($addrid)){
			return array("state" => 200, "info" => '请选择所在区域');
		}

		if(empty($address)){
			return array("state" => 200, "info" => '请输入公司地址');
		}

		$userSql = $dsql->SetQuery("SELECT `id` FROM `#@__job_company` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");

		//新公司
		if(!$userResult){

			//保存到主表
			$archives = $dsql->SetQuery("INSERT INTO `#@__job_company` (`title`, `addrid`, `logo`, `userid`, `people`, `contact`, `email`, `address`, `lnglat`, `nature`, `scale`, `industry`, `postcode`, `site`, `body`, `state`, `pics`, `pubdate`) VALUES ('$title', '$addrid', '$logo', '$userid', '$people', '$contact', '$email', '$address', '$lnglat', '$nature', '$scale', '$industry', '$postcode', '$site', '$body', '0', '$pics', '$pubdate')");
			$aid = $dsql->dsqlOper($archives, "lastid");

			if(is_numeric($aid)){

				//后台消息通知
				updateAdminNotice("job", "store");

				return "配置成功，您的公司正在审核中，请耐心等待！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		//更新公司信息
		}else{

			//保存到主表
			$archives = $dsql->SetQuery("UPDATE `#@__job_company` SET `title` = '$title', `addrid` = '$addrid', `logo` = '$logo', `userid` = '$userid', `people` = '$people', `contact` = '$contact', `email` = '$email', `address` = '$address', `lnglat` = '$lnglat', `nature` = '$nature', `scale` = '$scale', `industry` = '$industry', `postcode` = '$postcode', `site` = '$site', `body` = '$body', `state` = '0', `pics` = '$pics' WHERE `userid` = ".$userid);
			$results = $dsql->dsqlOper($archives, "update");

			if($results == "ok"){

				//后台消息通知
				updateAdminNotice("job", "store");

				return "保存成功！";
			}else{
				return array("state" => 200, "info" => '配置失败，请查检您输入的信息是否符合要求！');
			}

		}

	}


	/**
		* 新增职位
		* @return array
		*/
	public function addPost(){
		global $dsql;
		global $userLogin;

		$userid    = $userLogin->getMemberID();
		$param     = $this->param;

		$title    = filterSensitiveWords(addslashes($param['title']));
		$type     = (int)$param['type'];
		$sex      = (int)$param['sex'];
		$nature   = (int)$param['nature'];
		$valid    = filterSensitiveWords(addslashes($param['valid']));
		$number   = (int)$param['number'];
		$addr     = (int)$param['addrid'];
		$experience  = (int)$param['experience'];
		$educational = (int)$param['educational'];
		$salary      = (int)$param['salary'];
		$language    = filterSensitiveWords(addslashes($param['language']));
		$note        = filterSensitiveWords(addslashes($param['note']));
		$claim       = filterSensitiveWords(addslashes($param['claim']));
		$tel         = filterSensitiveWords(addslashes($param['tel']));
		$email       = filterSensitiveWords(addslashes($param['email']));
		$vdimgck = $param['vdimgck'];
		$pubdate = GetMkTime(time());

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `state` FROM `#@__job_company` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通招聘公司店铺！');
		}

		if($userResult[0]['state'] == 0){
			return array("state" => 200, "info" => '您的公司信息还在审核中，请通过审核后再发布！');
		}

		if($userResult[0]['state'] == 2){
			return array("state" => 200, "info" => '您的公司信息审核失败，请通过审核后再发布！');
		}

		$company = $userResult[0]['id'];

		if(empty($title)){
			return array("state" => 200, "info" => '请输入职位名称');
		}

		if(empty($type)){
			return array("state" => 200, "info" => '请选择职位类别');
		}

		if(empty($valid)){
			return array("state" => 200, "info" => '请选择有效期');
		}
		$valid = GetMkTime($valid);

		if(empty($number)){
			return array("state" => 200, "info" => "请输入招聘人数");
		}

		if(empty($addr)){
			return array("state" => 200, "info" => "请选择工作地点");
		}

		if(empty($experience)){
			return array("state" => 200, "info" => "请选择工作经验");
		}

		if(empty($educational)){
			return array("state" => 200, "info" => "请选择学历要求");
		}

		if(empty($salary)){
			return array("state" => 200, "info" => "请选择薪资范围");
		}

		if(empty($tel)){
			return array("state" => 200, "info" => "请输入联系电话");
		}

		if(empty($email)){
			return array("state" => 200, "info" => "请输入联系邮箱");
		}

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__job_post` (`title`, `type`, `company`, `bole`, `sex`, `nature`, `valid`, `number`, `addr`, `experience`, `educational`, `language`, `salary`, `note`, `claim`, `tel`, `email`, `state`, `pubdate`) VALUES ('$title', '$type', '$company', '0', '$sex', '$nature', '$valid', '$number', '$addr', '$experience', '$educational', '$language', '$salary', '$note', '$claim', '$tel', '$email', 0, '$pubdate')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			return $aid;
		}else{
			return array("state" => 101, "info" => '发布到数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 修改职位
		* @return array
		*/
	public function editPost(){
		global $dsql;
		global $userLogin;

		$userid    = $userLogin->getMemberID();
		$param     = $this->param;

		$id       = (int)$param['id'];
		$title    = filterSensitiveWords(addslashes($param['title']));
		$type     = (int)$param['type'];
		$sex      = (int)$param['sex'];
		$nature   = (int)$param['nature'];
		$valid    = filterSensitiveWords(addslashes($param['valid']));
		$number   = (int)$param['number'];
		$addr     = (int)$param['addrid'];
		$experience  = (int)$param['experience'];
		$educational = (int)$param['educational'];
		$salary      = (int)$param['salary'];
		$language    = filterSensitiveWords(addslashes($param['language']));
		$note        = filterSensitiveWords(addslashes($param['note']));
		$claim       = filterSensitiveWords(addslashes($param['claim']));
		$tel         = filterSensitiveWords(addslashes($param['tel']));
		$email       = filterSensitiveWords(addslashes($param['email']));
		$vdimgck = $param['vdimgck'];
		$pubdate = GetMkTime(time());

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		if(empty($id)){
			return array("state" => 200, "info" => '格式错误！');
		}

		if($userid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$userSql = $dsql->SetQuery("SELECT `id`, `state` FROM `#@__job_company` WHERE `userid` = ".$userid);
		$userResult = $dsql->dsqlOper($userSql, "results");
		if(!$userResult){
			return array("state" => 200, "info" => '您还未开通招聘公司店铺！');
		}

		if($userResult[0]['state'] == 0){
			return array("state" => 200, "info" => '您的公司信息还在审核中，请通过审核后再发布！');
		}

		if($userResult[0]['state'] == 2){
			return array("state" => 200, "info" => '您的公司信息审核失败，请通过审核后再发布！');
		}

		$company = $userResult[0]['id'];

		if(empty($title)){
			return array("state" => 200, "info" => '请输入职位名称');
		}

		if(empty($type)){
			return array("state" => 200, "info" => '请选择职位类别');
		}

		if(empty($valid)){
			return array("state" => 200, "info" => '请选择有效期');
		}
		$valid = GetMkTime($valid);

		if(empty($number)){
			return array("state" => 200, "info" => "请输入招聘人数");
		}

		if(empty($addr)){
			return array("state" => 200, "info" => "请选择工作地点");
		}

		if(empty($experience)){
			return array("state" => 200, "info" => "请选择工作经验");
		}

		if(empty($educational)){
			return array("state" => 200, "info" => "请选择学历要求");
		}

		if(empty($salary)){
			return array("state" => 200, "info" => "请选择薪资范围");
		}

		if(empty($tel)){
			return array("state" => 200, "info" => "请输入联系电话");
		}

		if(empty($email)){
			return array("state" => 200, "info" => "请输入联系邮箱");
		}

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__job_post` SET `title` = '$title', `type` = '$type', `sex` = '$sex', `nature` = '$nature', `valid` = '$valid', `number` = '$number', `addr` = '$addr', `experience` = '$experience', `educational` = '$educational', `language` = '$language', `salary` = '$salary', `note` = '$note', `claim` = '$claim', `tel` = '$tel', `email` = '$email', `state` = 0, `pubdate` = '$pubdate' WHERE `id` = ".$id);
		$ret = $dsql->dsqlOper($archives, "update");

		if($ret == "ok"){
			return "ok";
		}else{
			return array("state" => 101, "info" => '更新数据时发生错误，请检查字段内容！');
		}

	}


	/**
		* 删除职位信息
		* @return array
		*/
	public function delPost(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$archives = $dsql->SetQuery("SELECT com.`userid` FROM `#@__job_post` post LEFT JOIN `#@__job_company` com ON com.`id` = post.`company` WHERE post.`id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['userid'] == $uid){
				$archives = $dsql->SetQuery("DELETE FROM `#@__job_post` WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return array("state" => 100, "info" => '删除成功！');
			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}





}
