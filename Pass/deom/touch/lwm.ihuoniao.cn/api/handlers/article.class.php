<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 新闻模块API接口
 *
 * @version        $Id: article.class.php 2014-3-22 下午13:36:15 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class article {
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

		require(HUONIAOINC."/config/article.inc.php");

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

		$hotline = $hotline_config == 0 ? $cfg_hotline : $customHotline;

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
		$customChannelDomain = $articleDomain;

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
				}elseif($param == "hotline"){
					$return['hotline'] = $hotline;
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
			$return['hotline']       = $hotline;
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
     * 新闻分类
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
		$results = $dsql->getTypeList($type, "articletype", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 新闻分类详细信息
     * @return array
     */
	public function typeDetail(){
		global $dsql;
		$typeDetail = array();
		$typeid = $this->param;
		$archives = $dsql->SetQuery("SELECT `id`, `typename`, `seotitle`, `keywords`, `description` FROM `#@__articletype` WHERE `id` = ".$typeid);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results && is_array($results)){
			$param = array(
				"service"     => "article",
				"template"    => "list",
				"typeid"      => $typeid
			);
			$results[0]["url"] = getUrlPath($param);
			return $results;
		}
	}


	/**
     * 新闻列表
     * @return array
     */
	public function alist(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$typeid = $title = $flag = $thumb = $orderby = $u = $state = $group_img = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$typeid   = $this->param['typeid'];
				$title    = $this->param['title'];
				$flag     = $this->param['flag'];
				$thumb    = $this->param['thumb'];
				$orderby  = $this->param['orderby'];
				$u        = $this->param['u'];
				$state    = $this->param['state'];
				$group_img = $this->param['group_img'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		//是否输出当前登录会员的信息
		if($u != 1){
			$where .= " AND l.`arcrank` = 1";
		}else{
			$uid = $userLogin->getMemberID();
			$where .= " AND l.`admin` = ".$uid;

			if($state != ""){
				$where1 = " AND l.`arcrank` = ".$state;
			}
		}

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "articletype")){
				global $arr_data;
				$arr_data = array();
				$lower = arr_foreach($dsql->getTypeList($typeid, "articletype"));
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
					$w[] = "`title` like '%".$v."%' OR `keywords` like '%".$v."%'";
				}
			}
			$where .= " AND (".join(" OR ", $w).")";
		}

		//匹配自定义属性
		if(!empty($flag)){
			$flag = explode(",", $flag);
			$w = array();
			foreach ($flag as $k => $v) {
				$w[] = "`flag` like '%".$v."%'";
			}
			$where .= " AND (".join(" AND ", $w).")";
		}

		//缩略图
		if($thumb === "0"){
			$where .= " AND `litpic` = ''";
		}elseif($thumb === "1"){
			$where .= " AND `litpic` != ''";
		}

		$order = " ORDER BY `weight` DESC, `id` DESC";
		//发布时间
		if($orderby == "1"){
			$order = " ORDER BY `pubdate` DESC, `weight` DESC, `id` DESC";
		//浏览量
		}elseif($orderby == "2"){
			$order = " ORDER BY `click` DESC, `weight` DESC, `id` DESC";
		//今日浏览量
		}elseif($orderby == "2.1"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') = curdate() ORDER BY `click` DESC, `weight` DESC, `id` DESC";
		//昨日浏览量
		}elseif($orderby == "2.2"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') = DATE_SUB(curdate(), INTERVAL 1 DAY) ORDER BY `click` DESC, `weight` DESC, `id` DESC";
		//本周浏览量
		}elseif($orderby == "2.3"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') >= DATE_SUB(curdate(), INTERVAL 7 DAY) ORDER BY `click` DESC, `weight` DESC, `id` DESC";
		//本月浏览量
		}elseif($orderby == "2.4"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m') = DATE_FORMAT(curdate(), '%Y-%m') ORDER BY `click` DESC, `weight` DESC, `id` DESC";
		//随机
		}elseif($orderby == "3"){
			$order = " ORDER BY rand()";
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		//评论排行
		if(strstr($orderby, "4")){
			//今日评论
			if($orderby == "4.1"){
				$where .= " AND DATE_FORMAT(FROM_UNIXTIME(l.`pubdate`), '%Y-%m-%d') = curdate()";
			//昨日评论
			}elseif($orderby == "4.2"){
				$where .= " AND DATE_FORMAT(FROM_UNIXTIME(l.`pubdate`), '%Y-%m-%d') = DATE_SUB(curdate(), INTERVAL 1 DAY)";
			//本周评论
			}elseif($orderby == "4.3"){
				$where .= " AND DATE_FORMAT(FROM_UNIXTIME(l.`pubdate`), '%Y-%m-%d') >= DATE_SUB(curdate(), INTERVAL 7 DAY)";
			//本月评论
			}elseif($orderby == "4.4"){
				$where .= " AND DATE_FORMAT(FROM_UNIXTIME(l.`pubdate`), '%Y-%m') = DATE_FORMAT(curdate(), '%Y-%m')";
			}

			$order = " ORDER BY total DESC";

			$archives = $dsql->SetQuery("SELECT l.`id`, l.`title`, l.`subtitle`, l.`flag`, l.`keywords`, l.`description`, l.`redirecturl`, l.`litpic`, l.`color`, l.`click`, l.`arcrank`, l.`pubdate`, (SELECT COUNT(`id`)  FROM `#@__articlecommon` WHERE `aid` = l.`id` AND `ischeck` = 1) AS total FROM `#@__articlelist` l WHERE l.`del` = 0".$where);
			$archives_count = $dsql->SetQuery("SELECT count(`id`) FROM `#@__articlelist` l WHERE l.`del` = 0".$where);

		//普通查询
		}else{
			$archives = $dsql->SetQuery("SELECT `id`, `title`, `subtitle`, `typeid`, `flag`, `keywords`, `description`, `source`, `redirecturl`, `litpic`, `color`, `click`, l.`arcrank`, `pubdate`, (SELECT COUNT(`id`)  FROM `#@__articlecommon` WHERE `aid` = l.`id` AND `ischeck` = 1) AS total FROM `#@__articlelist` l WHERE `del` = 0".$where);
			$archives_count = $dsql->SetQuery("SELECT count(`id`) FROM `#@__articlelist` l WHERE `del` = 0".$where);
		}

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

		//会员列表需要统计信息状态
		if($u == 1 && $userLogin->getMemberID() > -1){
			//待审核
			$totalGray = $dsql->dsqlOper($archives." AND `arcrank` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND `arcrank` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND `arcrank` = 2", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

		if($results){
			global $cfg_clihost;
			foreach($results as $key => $val){
				$flag = explode(",", $val['flag']);
				$list[$key]['id']          = $val['id'];
				$list[$key]['title']       = in_array("b", $flag) ? '<strong>'.$val['title'].'</strong>' : $val['title'];
				$list[$key]['subtitle']    = $val['subtitle'];
				$list[$key]['typeid']      = $val['typeid'];

				global $data;
				$data = "";
				$typeArr = getParentArr("articletype", $val['typeid']);
				$typeArr = array_reverse(parent_foreach($typeArr, "typename"));
				$list[$key]['typeName']    = $typeArr;

				$list[$key]['flag']        = $val['flag'];
				$list[$key]['keywords']    = str_replace(",", " ", $val['keywords']);
				$list[$key]['description'] = $val['description'];
				$list[$key]['source']      = $val['source'];
				$list[$key]['redirecturl'] = $val['redirecturl'];
				$list[$key]['litpic']      = !empty($val['litpic']) ? getFilePath($val['litpic']) : "";
				$list[$key]['color']       = $val['color'];
				$list[$key]['click']       = $val['click'];

				//会员中心显示信息状态
				if($u == 1 && $userLogin->getMemberID() > -1){
					$list[$key]['arcrank'] = $val['arcrank'];
				}

				$list[$key]['pubdate']     = $val['pubdate'];

				// $archives = $dsql->SetQuery("SELECT count(`id`) FROM `#@__articlecommon` WHERE `aid` = ".$val['id']." AND `ischeck` = 1");
				// $totalCount = $dsql->dsqlOper($archives, "results", "NUM");
				// $list[$key]['common']     = (int)$totalCount[0][0];
				$list[$key]['common'] = $val['total'];

				$param = array(
					"service"     => "article",
					"template"    => "detail",
					"id"          => $val['id'],
					"flag"        => $val['flag'],
					"redirecturl" => $val['redirecturl']
				);
				$list[$key]['url'] = getUrlPath($param);

				//图表信息
				if($group_img){
					$archives = $dsql->SetQuery("SELECT * FROM `#@__articlepic` WHERE `aid` = ".$val['id']." ORDER BY `id` ASC LIMIT 0, 6");
					$results = $dsql->dsqlOper($archives, "results");
					if(!empty($results)){
						$imglist = array();
						foreach($results as $k => $value){
							$imglist[$k]["path"] = getFilePath($value["picPath"]);
							$imglist[$k]["info"] = $value["picInfo"];
						}
						$list[$key]['group_img'] = $imglist;
					}
				}
			}
		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 新闻信息详细
     * @return array
     */
	public function detail(){
		global $dsql;
		global $userLogin;
		$articleDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		//功能点：管理员和信息的发布者可以查看所有状态的信息
		$where = "";
		if($userLogin->getUserID() == -1){

			$where = " AND `arcrank` = 1 AND `del` = 0";

			//如果没有登录再验证会员是否已经登录
			if($userLogin->getMemberID() == -1){
				$where = " AND `arcrank` = 1 AND `del` = 0";
			}else{
				$where = " AND (`arcrank` = 1 AND `del` = 0 OR `admin` = ".$userLogin->getMemberID().")";
			}

		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__articlelist` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			global $cfg_clihost;
			$articleDetail["id"]          = $results[0]['id'];
			$articleDetail["title"]       = $results[0]['title'];
			$articleDetail["subtitle"]    = $results[0]['subtitle'];
			$articleDetail["flag"]        = $results[0]['flag'];
			$articleDetail["redirecturl"] = $results[0]['redirecturl'];
			$articleDetail["litpic"]      = !empty($results[0]['litpic']) ? getFilePath($results[0]['litpic']) : "";
			$articleDetail["litpicSource"] = !empty($results[0]['litpic']) ? $results[0]['litpic'] : "";
			$articleDetail["source"]      = $results[0]['source'];
			$articleDetail["sourceurl"]   = $results[0]['sourceurl'];
			$articleDetail["writer"]      = $results[0]['writer'];
			$articleDetail["typeid"]      = $results[0]['typeid'];

			global $data;
			$data = "";
			$typeArr = getParentArr("articletype", $results[0]['typeid']);
			$typeArr = array_reverse(parent_foreach($typeArr, "typename"));
			$articleDetail['typeName']    = join(" > ", $typeArr);

			$articleDetail["keywords"]    = str_replace(",", " ", $results[0]['keywords']);
			$articleDetail["keywordsList"] = explode(" ", str_replace(",", " ", $results[0]['keywords']));
			$articleDetail["description"] = str_replace(array("\r\n", "\r", "\n"), '', strip_tags($results[0]['description']));
			$articleDetail["notpost"]     = $results[0]['notpost'];
			$articleDetail["click"]       = $results[0]['click'];
			$articleDetail["color"]       = $results[0]['color'];
			$articleDetail["arcrank"]     = $results[0]['arcrank'];
			$articleDetail["pubdate"]     = $results[0]['pubdate'];

			$body = "";
			$archives = $dsql->SetQuery("SELECT `body` FROM `#@__article` WHERE `aid` = ".$id);
			$results1  = $dsql->dsqlOper($archives, "results");
			if($results1){
				$body = $results1[0]['body'];
			}
			$articleDetail["body"]       = $body;
			$articleDetail["mbody"]      = empty($results[0]['mbody']) ? $body : $results[0]['mbody'];

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__articlepic` WHERE `aid` = ".$id." ORDER BY `id` ASC");
			$results2 = $dsql->dsqlOper($archives, "results");

			if(!empty($results2)){
				$imglist = array();
				foreach($results2 as $key => $value){
					$imglist[$key]["pathSource"] = $value["picPath"];
					$imglist[$key]["path"] = getFilePath($value["picPath"]);
					$imglist[$key]["info"] = $value["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$articleDetail["imglist"]     = $imglist;

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__articlecommon` WHERE `aid` = ".$results[0]['id']." AND `ischeck` = 1");
			$totalCount = $dsql->dsqlOper($archives, "totalCount");
			$articleDetail['common'] = $totalCount;

		}
		return $articleDetail;
	}


	/**
     * 评论列表
     * @return array
     */
	public function common(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$newsid = $orderby = $page = $pageSize = $where = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$newsid    = $this->param['newsid'];
			$orderby   = $this->param['orderby'];
			$page     = $this->param['page'];
			$pageSize = $this->param['pageSize'];
		}

		$pageSize = empty($pageSize) ? 10 : $pageSize;
		$page     = empty($page) ? 1 : $page;

		$oby = " ORDER BY `id` DESC";
		if($orderby == "hot"){
			$oby = " ORDER BY `good` DESC, `id` DESC";
		}

		$archives = $dsql->SetQuery("SELECT `id`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `duser` FROM `#@__articlecommon` WHERE `aid` = ".$newsid." AND `ischeck` = 1 AND `floor` = 0".$oby);
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
				$list[$key]['userinfo'] = $userLogin->getMemberInfo($val['userid']);
				$list[$key]['content'] = $val['content'];
				$list[$key]['dtime']   = $val['dtime'];
				$list[$key]['ftime']   = floor((GetMkTime(time()) - $val['dtime']/86400)%30) > 30 ? date("Y-m-d", $val['dtime']) : FloorTime(GetMkTime(time()) - $val['dtime']);
				$list[$key]['ip']      = $val['ip'];
				$list[$key]['ipaddr']  = $val['ipaddr'];
				$list[$key]['good']    = $val['good'];
				$list[$key]['bad']     = $val['bad'];

				$userArr = explode(",", $val['duser']);
				$list[$key]['already'] = in_array($userLogin->getMemberID(), $userArr) ? 1 : 0;

				$list[$key]['lower']   = $this->getCommonList($val['id']);
			}
		}
		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
	 * 遍历评论子级
	 * @param $fid int 评论ID
	 * @return array
	 */
	function getCommonList($fid){
		if(empty($fid)) return false;
		global $dsql;
		global $userLogin;

		$archives = $dsql->SetQuery("SELECT `id`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `duser` FROM `#@__articlecommon` WHERE `floor` = ".$fid." AND `ischeck` = 1 ORDER BY `id` DESC");
		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		if($totalCount > 0){
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $key => $val){
					$list[$key]['id']      = $val['id'];
					$list[$key]['userinfo'] = $userLogin->getMemberInfo($val['userid']);
					$list[$key]['content'] = $val['content'];
					$list[$key]['dtime']   = $val['dtime'];
					$list[$key]['ftime']   = floor((GetMkTime(time()) - $val['dtime']/86400)%30) > 30 ? $val['dtime'] : FloorTime(GetMkTime(time()) - $val['dtime']);
					$list[$key]['ip']      = $val['ip'];
					$list[$key]['ipaddr']  = $val['ipaddr'];
					$list[$key]['good']    = $val['good'];
					$list[$key]['bad']     = $val['bad'];

					$userArr = explode(",", $val['duser']);
					$list[$key]['already'] = in_array($userLogin->getMemberID(), $userArr) ? 1 : 0;

					$list[$key]['lower']   = $this->getCommonList($val['id']);
				}
				return $list;
			}
		}
	}


	/**
	 * 顶评论
	 * @param $id int 评论ID
	 * @param string
	 **/
	public function dingCommon(){
		global $dsql;
		global $userLogin;

		$id = $this->param['id'];
		if(empty($id)) return "请传递评论ID！";
		$memberID = $userLogin->getMemberID();
		if($memberID == -1 || empty($memberID)) return "请先登录！";

		$archives = $dsql->SetQuery("SELECT `duser` FROM `#@__articlecommon` WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "results");
		if($results){

			$duser = $results[0]['duser'];

			//如果此会员已经顶过则return
			$userArr = explode(",", $duser);
			if(in_array($userLogin->getMemberID(), $userArr)) return "已顶过！";

			//附加会员ID
			if(empty($duser)){
				$nuser = $userLogin->getMemberID();
			}else{
				$nuser = $duser . "," . $userLogin->getMemberID();
			}

			$archives = $dsql->SetQuery("UPDATE `#@__articlecommon` SET `good` = `good` + 1 WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");

			$archives = $dsql->SetQuery("UPDATE `#@__articlecommon` SET `duser` = '$nuser' WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");
			return $results;

		}else{
			return "评论不存在或已删除！";
		}
	}


	/**
     * 发表评论
     * @return array
     */
	public function sendCommon(){
		global $dsql;
		global $userLogin;
		$param = $this->param;

		$aid     = $param['aid'];
		$id      = $param['id'];
		$content = addslashes($param['content']);

		if(empty($aid) || empty($content)){
			return array("state" => 200, "info" => '必填项不得为空！');
		}

		$content = filterSensitiveWords(cn_substrR($content,250));

		include HUONIAOINC."/config/article.inc.php";
		$ischeck = (int)$customCommentCheck;

		$archives = $dsql->SetQuery("INSERT INTO `#@__articlecommon` (`aid`, `floor`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `ischeck`, `duser`) VALUES ('$aid', '$id', '".$userLogin->getMemberID()."', '$content', ".GetMkTime(time()).", '".GetIP()."', '".getIpAddr(GetIP())."', 0, 0, '$ischeck', '')");
		$lid  = $dsql->dsqlOper($archives, "lastid");
		if($lid){
			$archives = $dsql->SetQuery("SELECT `id`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `duser` FROM `#@__articlecommon` WHERE `id` = ".$lid);
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				$list['id']      = $results[0]['id'];
				$list['userinfo'] = $userLogin->getMemberInfo($results[0]['userid']);
				$list['content'] = $results[0]['content'];
				$list['dtime']   = $results[0]['dtime'];
				$list['ftime']   = GetMkTime(time()) - $results[0]['dtime'] > 30 ? $results[0]['dtime'] : FloorTime(GetMkTime(time()) - $results[0]['dtime']);
				$list['ip']      = $results[0]['ip'];
				$list['ipaddr']  = $results[0]['ipaddr'];
				$list['good']    = $results[0]['good'];
				$list['bad']     = $results[0]['bad'];
				return $list;
			}
		}else{
			return array("state" => 200, "info" => '评论失败！');
		}

	}


	/**
		* 发布信息
		* @return array
		*/
	public function put(){
		global $dsql;
		global $userLogin;

		$param = $this->param;

		$title    = filterSensitiveWords(addslashes($param['title']));
		$typeid   = $param['typeid'];
		$litpic   = $param['litpic'];
		$body     = filterSensitiveWords($param['body']);
		$imglist  = $param['imglist'];
		$writer   = filterSensitiveWords(addslashes($param['writer']));
		$source   = filterSensitiveWords(addslashes($param['source']));
		$sourceurl = filterSensitiveWords(addslashes($param['sourceurl']));
		$keywords = filterSensitiveWords(addslashes($param['keywords']));
		$description = filterSensitiveWords(addslashes($param['description']));
		$vdimgck = $param['vdimgck'];

		global $dellink, $autolitpic;
		include HUONIAOINC."/config/article.inc.php";
		$dellink    = (int)$customDelLink;
		$autolitpic = (int)$customAutoLitpic;
		$arcrank    = (int)$customFabuCheck;

		$body = AnalyseHtmlBodyLinkLitpic($body, $litpic);

		$flag = $litpic ? "p" : "";

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		if(empty($title)) return array("state" => 200, "info" => '请输入标题');
		if(empty($typeid)) return array("state" => 200, "info" => '请选择投稿分类');
		if(empty($body)) return array("state" => 200, "info" => '请输入投稿内容');
		if(empty($writer)) return array("state" => 200, "info" => '请输入作者');
		if(empty($source)) return array("state" => 200, "info" => '请输入投稿来源');
		if(empty($vdimgck)) return array("state" => 200, "info" => '请输入验证码');

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		$title  = cn_substrR($title, 50);
		$writer = cn_substrR($writer, 10);
		$source = cn_substrR($source, 20);
		$sourceurl = cn_substrR($sourceurl, 150);

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__articlelist` (`title`, `flag`, `litpic`, `source`, `sourceurl`, `writer`, `typeid`, `keywords`, `description`, `mbody`, `arcrank`, `pubdate`, `admin`) VALUES ('$title', '$flag', '$litpic', '$source', '$sourceurl', '$writer', '$typeid', '$keywords', '$description', '', '$arcrank', ".GetMkTime(time()).", '$uid')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			//保存图集表
			if($imglist != ""){
				$picList = explode(",",$imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__articlepic` (`aid`, `picPath`, `picInfo`) VALUES ('$aid', '$picInfo[0]', '".filterSensitiveWords($picInfo[1])."')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			//保存内容表
			$art = $dsql->SetQuery("INSERT INTO `#@__article` (`aid`, `body`) VALUES ('$aid', '$body')");
			$dsql->dsqlOper($art, "update");

			//后台消息通知
			if(!$arcrank){
				updateAdminNotice("article", "detail");
			}

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

		$param = $this->param;

		$id       = $param['id'];

		if(empty($id)) return array("state" => 200, "info" => '数据传递失败！');

		$title    = filterSensitiveWords(addslashes($param['title']));
		$typeid   = $param['typeid'];
		$litpic   = $param['litpic'];
		$body     = filterSensitiveWords($param['body']);
		$imglist  = $param['imglist'];
		$writer   = filterSensitiveWords(addslashes($param['writer']));
		$source   = filterSensitiveWords(addslashes($param['source']));
		$sourceurl = filterSensitiveWords(addslashes($param['sourceurl']));
		$keywords = filterSensitiveWords(addslashes($param['keywords']));
		$description = filterSensitiveWords(addslashes($param['description']));
		$vdimgck = $param['vdimgck'];

		global $dellink, $autolitpic;
		include HUONIAOINC."/config/article.inc.php";
		$dellink    = (int)$customDelLink;
		$autolitpic = (int)$customAutoLitpic;
		$arcrank    = (int)$customFabuCheck;

		$body = AnalyseHtmlBodyLinkLitpic($body, $litpic);

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$archives = $dsql->SetQuery("SELECT `id` FROM `#@__articlelist` WHERE `id` = ".$id." AND `admin` = ".$uid);
		$results  = $dsql->dsqlOper($archives, "results");
		if(!$results){
			return array("state" => 200, "info" => '权限不足，修改失败！');
		}

		if(empty($title)) return array("state" => 200, "info" => '请输入标题');
		if(empty($typeid)) return array("state" => 200, "info" => '请选择投稿分类');
		if(empty($body)) return array("state" => 200, "info" => '请输入投稿内容');
		if(empty($writer)) return array("state" => 200, "info" => '请输入作者');
		if(empty($source)) return array("state" => 200, "info" => '请输入投稿来源');
		if(empty($vdimgck)) return array("state" => 200, "info" => '请输入验证码');

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		$title  = cn_substrR($title, 50);
		$writer = cn_substrR($writer, 10);
		$source = cn_substrR($source, 20);
		$sourceurl = cn_substrR($sourceurl, 150);

		$archives = $dsql->SetQuery("UPDATE `#@__articlelist` SET `title` = '$title', `litpic` = '$litpic', `source` = '$source', `sourceurl` = '$sourceurl', `writer` = '$writer', `typeid` = '$typeid', `keywords` = '$keywords', `description` = '$description', `arcrank` = '$arcrank' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results != "ok"){
			return array("state" => 200, "info" => '保存到数据时发生错误，请检查字段内容！');
		}

		//先删除文档所属图集
		$archives = $dsql->SetQuery("DELETE FROM `#@__articlepic` WHERE `aid` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		//保存图集表
		if($imglist != ""){
			$picList = explode(",",$imglist);
			foreach($picList as $k => $v){
				$picInfo = explode("|", $v);
				$pics = $dsql->SetQuery("INSERT INTO `#@__articlepic` (`aid`, `picPath`, `picInfo`) VALUES ('$id', '$picInfo[0]', '".filterSensitiveWords($picInfo[1])."')");
				$dsql->dsqlOper($pics, "update");
			}
		}

		//保存内容表
		$art = $dsql->SetQuery("UPDATE `#@__article` SET `body` = '$body' WHERE `aid` = ".$id);
		$results = $dsql->dsqlOper($art, "update");

		//后台消息通知
		if(!$arcrank){
			updateAdminNotice("article", "detail");
		}

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

		$archives = $dsql->SetQuery("SELECT * FROM `#@__articlelist` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['admin'] == $uid){
				$archives = $dsql->SetQuery("UPDATE `#@__articlelist` SET `del` = 1 WHERE `id` = ".$id);
				$dsql->dsqlOper($archives, "update");
				return array("state" => 100, "info" => '删除成功！');
			}else{
				return array("state" => 101, "info" => '权限不足，请确认帐户信息后再进行操作！');
			}
		}else{
			return array("state" => 101, "info" => '信息不存在，或已经删除！');
		}

	}


	/**
		* 验证文章状态是否可以打赏
		* @return array
		*/
	public function checkRewardState(){
		global $dsql;
		global $userLogin;

		$aid = $this->param['aid'];

		if(!is_numeric($aid)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 100, "info" => 'true');
		}

		$archives = $dsql->SetQuery("SELECT `admin` FROM `#@__articlelist` WHERE `id` = ".$aid);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			if($results[0]['admin'] == $uid){
				return array("state" => 200, "info" => '自己不可以给自己打赏！');
			}else{
				return array("state" => 100, "info" => 'true');
			}
		}else{
			return array("state" => 200, "info" => '信息不存在，或已经删除，不可以打赏，请确认后重试！');
		}

	}


	/**
	 * 打赏记录
	 * @param $fid int 评论ID
	 * @return array
	 */
	function rewardList(){
		global $dsql;

		$param   = $this->param;
		$aid     = $param['aid']; //信息ID

		$archives = $dsql->SetQuery("SELECT m.`username`, m.`photo`, r.`amount` FROM `#@__member_reward` r LEFT JOIN `#@__member` m ON m.`id` = r.`uid` WHERE r.`aid` = ".$aid." AND r.`state` = 1 ORDER BY r.`id` ASC");
		//总条数
		$totalCount = $dsql->dsqlOper($archives, "totalCount");

		$list = array();
		if($totalCount > 0){
			$results = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach($results as $key => $val){
					$list[$key]['username'] = $val['username'];
					$list[$key]['photo']    = !empty($val['photo']) ? getFilePath($val['photo']) : "";
					$list[$key]['amount']   = $val['amount'];
				}
			}
		}
		return array("pageInfo" => array("totalCount" => $totalCount), "list" => $list);
	}



	/**
	 * 打赏
	 * @return array
	 */
	public function reward(){
		global $dsql;
		global $userLogin;

		$param   = $this->param;
		$aid     = $param['aid'];      //信息ID
		$amount  = $param['amount'];   //打赏金额
		$paytype = $param['paytype'];  //支付方式

		$uid = $userLogin->getMemberID();  //当前登录用户

		//信息url
		$param = array(
			"service"     => "article",
			"template"    => "detail",
			"id"          => $aid
		);
		$url = getUrlPath($param);

		//验证金额
		if($amount <= 0 || !is_numeric($aid) || empty($paytype)){
			header("location:".$url);
			die;
		}

		//查询信息发布人
		$sql = $dsql->SetQuery("SELECT `admin` FROM `#@__articlelist` WHERE `id` = ".$aid);
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			//信息不存在
			header("location:".$url);
			die;
		}
		$admin = $ret[0]['admin'];

		//自己不可以给自己打赏
		if($admin == $uid){
			//信息不存在
			header("location:".$url);
			die;
		}

		//订单号
		$ordernum = create_ordernum();

		$archives = $dsql->SetQuery("INSERT INTO `#@__member_reward` (`ordernum`, `module`, `uid`, `to`, `aid`, `amount`, `state`, `date`) VALUES ('$ordernum', 'article', '$uid', '$admin', '$aid', '$amount', 0, ".GetMkTime(time()).")");
		$return = $dsql->dsqlOper($archives, "update");
		if($return != "ok"){
			die("提交失败，请稍候重试！");
		}

		//跳转至第三方支付页面
		createPayForm("article", $ordernum, $amount, $paytype, "打赏文章");

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
			$sql = $dsql->SetQuery("SELECT * FROM `#@__member_reward` WHERE `ordernum` = '$ordernum'");
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){

				$rid    = $ret[0]['id'];
				$uid    = $ret[0]['uid'];
				$to     = $ret[0]['to'];
				$aid    = $ret[0]['aid'];
				$amount = $ret[0]['amount'];

				//文章信息
				$sql = $dsql->SetQuery("SELECT `title` FROM `#@__articlelist` WHERE `id` = $aid");
				$ret = $dsql->dsqlOper($sql, "results");
				$title = $ret[0]['title'];

				$title_ = '<a href="http://'.$cfg_basehost.'/index.php?service=article&template=detail&id='.$aid.'" target="_blank">'.$title.'</a>';

				//更新订单状态
				$sql = $dsql->SetQuery("UPDATE `#@__member_reward` SET `state` = 1 WHERE `id` = ".$rid);
				$dsql->dsqlOper($sql, "update");

				//如果是会员打赏，保存操作日志
				if($uid != -1){
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '文章打赏：$title_', '$date')");
					$dsql->dsqlOper($archives, "update");
				}

				//将费用打给文章作者
				$archives = $dsql->SetQuery("UPDATE `#@__member` SET `money` = `money` + '$amount' WHERE `id` = '$to'");
				$dsql->dsqlOper($archives, "update");

				//保存操作日志
				$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$to', '1', '$amount', '文章打赏：$title_', '$date')");
				$dsql->dsqlOper($archives, "update");


				//会员通知
				$param = array(
					"service"  => "article",
					"template" => "detail",
					"id"   => $aid
				);

				//获取会员名
				$username = "";
				$sql = $dsql->SetQuery("SELECT `username` FROM `#@__member` WHERE `id` = $to");
				$ret = $dsql->dsqlOper($sql, "results");
				if($ret){
					$username = $ret[0]['username'];
				}
				updateMemberNotice($to, "会员-打赏通知", $param, array("username" => $username, "title" => $title, 'amount' => $amount, "date" => date("Y-m-d H:i:s", $date)));

			}

		}
	}

}
