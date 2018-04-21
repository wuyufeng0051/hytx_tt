<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 信息模块API接口
 *
 * @version        $Id: info.class.php 2014-3-24 下午14:51:14 $
 * @package        HuoNiao.Handlers
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class info {
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
     * 信息基本参数
     * @return array
     */
	public function config(){

		require(HUONIAOINC."/config/info.inc.php");

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
		// global $customAtlasMax;           //图集数量限制
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

		// $domainInfo = getDomain('info', 'config');
		// $customChannelDomain = $domainInfo['domain'];
		// if($customSubDomain == 0){
		// 	$customChannelDomain = "http://".$customChannelDomain;
		// }elseif($customSubDomain == 1){
		// 	$customChannelDomain = "http://".$customChannelDomain.".".$cfg_basehost;
		// }elseif($customSubDomain == 2){
		// 	$customChannelDomain = "http://".$cfg_basehost."/".$customChannelDomain;
		// }

		include HUONIAOINC.'/siteModuleDomain.inc.php';
		$customChannelDomain = $infoDomain;

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
			$return['atlasMax']      = $customAtlasMax;
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
     * 信息分类
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

		$results = $dsql->getTypeList($type, "infotype", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 分类模糊匹配
     * @return array
     */
	public function searchType(){
		global $dsql;
		$key = trim($this->param['key']);

		$list = array();
		if(!empty($key)){
			$archives = $dsql->SetQuery("SELECT `id`, `typename` FROM `#@__infotype` WHERE (`typename` like '%".$key."%' OR `seotitle` like '%".$key."%' OR `keywords` like '%".$key."%' OR `description` like '%".$key."%') AND `parentid` != 0 LIMIT 0,10");
			$results  = $dsql->dsqlOper($archives, "results");
			if($results){
				foreach ($results as $key => $value) {

					$list[$key]['id'] = $value['id'];
					global $data;
					$data = "";
					$typeArr = getParentArr("infotype", $value['id']);
					$typeArr = array_reverse(parent_foreach($typeArr, "typename"));
					$list[$key]['typename'] = join(" > ", $typeArr);

				}
			}
		}

		return $list;
	}


	/**
     * 信息分类详细信息
     * @return array
     */
	public function typeDetail(){
		global $dsql;
		$id = $this->param;

		$id = !is_numeric($id) ? $id['id'] : $id;

		if(empty($id)) return array("state" => 200, "info" => '格式错误！');

		$archives = $dsql->SetQuery("SELECT `id`, `typename`, `seotitle`, `keywords`, `description` FROM `#@__infotype` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$archives = $dsql->SetQuery("SELECT `id`, `field`, `title`, `formtype`, `required`, `options`, `default` FROM `#@__infotypeitem` WHERE `tid` = ".$id." ORDER BY `orderby` DESC");
			$typeitem = $dsql->dsqlOper($archives, "results");
			if($typeitem){
				foreach($typeitem as $key => $item){
					$results[0]["item"][$key]['id']    = $item['id'];
					$results[0]["item"][$key]['field'] = $item['field'];
					$results[0]["item"][$key]['title'] = $item['title'];
					$results[0]["item"][$key]['formtype'] = $item['formtype'];
					$results[0]["item"][$key]['required'] = $item['required'];
					if($item["options"] != ""){
						$options = join('|', preg_split("[\r\n]", $item["options"]));
						$results[0]["item"][$key]['options'] = explode("\r\n", $item["options"]);
					}
					$results[0]["item"][$key]['default'] = explode("|", $item['default']);
				}
			}

			$param = array(
				"service"     => "info",
				"template"    => "list",
				"typeid"      => $id
			);
			$results[0]["url"] = getUrlPath($param);

			$sql = $dsql->SetQuery("SELECT `id` FROM `#@__infotype` WHERE `parentid` = ".$id);
			$res = $dsql->dsqlOper($sql, "totalCount");
			if($res > 0){
				$results[0]["lower"] = $res;
			}

			return $results;
		}

	}


	/**
     * 信息地区
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
		$results = $dsql->getTypeList($type, "infoaddr", $son, $page, $pageSize);
		if($results){
			return $results;
		}
	}


	/**
     * 信息列表
     * @return array
     */
	public function ilist(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = $itemList = array();
		$nature = $typeid = $addrid = $valid = $title = $rec = $fire = $top = $thumb = $orderby = $u = $state = $userid = $tel = $page = $pageSize = $where = $where1 = "";

		if(!empty($this->param)){
			if(!is_array($this->param)){
				return array("state" => 200, "info" => '格式错误！');
			}else{
				$nature   = $this->param['nature'];
				$typeid   = $this->param['typeid'];
				$addrid   = $this->param['addrid'];
				$valid    = $this->param['valid'];
				$title    = $this->param['title'];
				$itemList = $this->param['item'];
				$rec      = $this->param['rec'];
				$fire     = $this->param['fire'];
				$top      = $this->param['top'];
				$thumb    = $this->param['thumb'];
				$orderby  = $this->param['orderby'];
				$u        = $this->param['u'];
				$state    = $this->param['state'];
				$userid   = $this->param['userid'];
				$tel      = $this->param['tel'];
				$page     = $this->param['page'];
				$pageSize = $this->param['pageSize'];
			}
		}

		//是否输出当前登录会员的信息
		if($u != 1){
			$where .= " AND l.`arcrank` = 1";
		}else{
			$uid = $userLogin->getMemberID();
			$where .= " AND l.`userid` = ".$uid;

			if($state != ""){
				if($state == 4){
					$now = GetMkTime(time());
					$where1 = " AND (`valid` < ".$now." OR `valid` = 0)";
				}else{
					$where1 = " AND l.`arcrank` = ".$state;
				}
			}
		}

		//只查找不过期的信息
		if($u != 1){
			$now = GetMkTime(time());
			$where .= " AND `valid` > ".$now." AND `valid` <> 0";
		}

		//信息性质
		if(!empty($nature)){

			//个人
			if($nature == 1){
				$where .= " AND ((SELECT `mtype` FROM `#@__member` WHERE `id` = l.`userid`) = 1 OR l.`userid` = -1)";

			//商家
			}elseif($nature == 2){
				$where .= " AND ((SELECT `mtype` FROM `#@__member` WHERE `id` = l.`userid`) = 2)";
			}

		}

		//遍历分类
		if(!empty($typeid)){
			if($dsql->getTypeList($typeid, "infotype")){
				global $arr_data;
				$arr_data = array();
				$lower = arr_foreach($dsql->getTypeList($typeid, "infotype"));
				$lower = $typeid.",".join(',',$lower);
			}else{
				$lower = $typeid;
			}
			$where .= " AND `typeid` in ($lower)";
		}

		//遍历地区
		if(!empty($addrid)){
			if($dsql->getTypeList($addrid, "infoaddr")){
				global $arr_data;
				$arr_data = array();
				$lower = arr_foreach($dsql->getTypeList($addrid, "infoaddr"));
				$lower = $addrid.",".join(',',$lower);
			}else{
				$lower = $addrid;
			}
			$where .= " AND `addr` in ($lower)";
		}

		if(!empty($title)){
			$where .= " AND `title` like '%".$title."%'";
		}

		//取出字段表中满足条件的所有信息ID Start
		$aidArr = $infoidArr = $aid = array();

		$tj = true;

		if(!empty($itemList)){
			$itemList = json_decode($itemList, true);
			foreach($itemList as $k => $v){
				if(!empty($v['value'])){
					$archives = $dsql->SetQuery("SELECT `aid` FROM `#@__infoitem` WHERE `iid` = ".$v['id']." AND find_in_set('".$v['value']."', `value`)");
					$results = $dsql->dsqlOper($archives, "results");
					if($results){
						foreach($results as $key => $val){
							$infoidArr[$k][$key] = $val['aid'];
						}
					}else{
						$tj = false;
					}
				}
			}
		}

		if(!$tj) $infoidArr = array();

		//二维数组转一维
		if(!empty($infoidArr)){
			foreach($infoidArr as $id){
				$aid[] = join(",", $id);
			}
		}

		$aid = join(",", $aid);
		$aid = explode(",", $aid);

		//取出重复次数最多的信息ID
		$aidcount = array_count_values($aid);
		foreach($aidcount as $key => $val){
			if($val == count($infoidArr)){
				$aidArr[] = $key;
			}
		}

		$aidArr = join(",", $aidArr);
		//取出字段表中满足条件的所有信息ID End
		if(!empty($itemList) && empty($infoidArr)){
			$where .= " AND 1 = 2";
		}else{
			if(!empty($aidArr)){
				$where .= " AND `id` in ($aidArr)";
			}
		}

		//推荐
		if(!empty($rec)){
			$where .= " AND `rec` = 1";
		}

		//火急
		if(!empty($fire)){
			$where .= " AND `fire` = 1";
		}

		//置顶
		if(!empty($top)){
			$where .= " AND `top` = 1";
		}

		//有图
		if(!empty($thumb)){
			$where .= " AND (SELECT COUNT(`id`) FROM `#@__infopic` WHERE `aid` = l.`id`) > 0";
		}

		//指定会员
		if(!empty($userid)){
			$where .= " AND `userid` = $userid";
		}

		//指定电话号码
		if(!empty($tel)){
			$where .= " AND `tel` = '$tel'";
		}

		$order = " ORDER BY `isbid` DESC, `bid_price` DESC, `bid_start` ASC, `top` DESC, `fire` DESC, `rec` DESC, `weight` DESC, `id` DESC";
		//发布时间
		if($orderby == "1"){
			$order = " ORDER BY `isbid` DESC, `bid_price` DESC, `bid_start` ASC, `pubdate` DESC, `top` DESC, `fire` DESC, `rec` DESC, `weight` DESC, `id` DESC";
		//浏览量
		}elseif($orderby == "2"){
			$order = " ORDER BY `isbid` DESC, `bid_price` DESC, `bid_start` ASC, `click` DESC, `top` DESC, `fire` DESC, `rec` DESC, `weight` DESC, `id` DESC";
		//今日浏览量
		}elseif($orderby == "2.1"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') = curdate() ORDER BY `isbid` DESC, `bid_price` DESC, `bid_start` ASC, `click` DESC, `top` DESC, `fire` DESC, `rec` DESC, `weight` DESC, `id` DESC";
		//昨日浏览量
		}elseif($orderby == "2.2"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') = DATE_SUB(curdate(), INTERVAL 1 DAY) ORDER BY `isbid` DESC, `bid_price` DESC, `bid_start` ASC, `click` DESC, `top` DESC, `fire` DESC, `rec` DESC, `weight` DESC, `id` DESC";
		//本周浏览量
		}elseif($orderby == "2.3"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m-%d') >= DATE_SUB(curdate(), INTERVAL 7 DAY) ORDER BY `isbid` DESC, `bid_price` DESC, `bid_start` ASC, `click` DESC, `top` DESC, `fire` DESC, `rec` DESC, `weight` DESC, `id` DESC";
		//本月浏览量
		}elseif($orderby == "2.4"){
			$order = " AND DATE_FORMAT(FROM_UNIXTIME(`pubdate`), '%Y-%m') = DATE_FORMAT(curdate(), '%Y-%m') ORDER BY `isbid` DESC, `bid_price` DESC, `bid_start` ASC, `click` DESC, `top` DESC, `fire` DESC, `rec` DESC, `weight` DESC, `id` DESC";
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

			$archives = $dsql->SetQuery("SELECT l.`id`, l.`title`, l.`typeid`, l.`color`, l.`pubdate`, l.`body`, l.`addr`, l.`click`, l.`tel`, l.`teladdr`, l.`rec`, l.`fire`, l.`top`, l.`userid`, l.`arcrank`, l.`valid`, l.`isbid`, l.`bid_end`, l.`bid_price`, (SELECT COUNT(`id`) FROM `#@__infocommon` WHERE `aid` = l.`id` AND `ischeck` = 1) AS total FROM `#@__infolist` l WHERE 1 = 1".$where);

		//普通查询
		}else{
			$archives = $dsql->SetQuery("SELECT l.`id`, l.`title`, l.`typeid`, l.`color`, l.`pubdate`, l.`body`, l.`addr`, l.`click`, l.`tel`, l.`teladdr`, l.`rec`, l.`fire`, l.`top`, l.`userid`, l.`arcrank`, l.`valid`, l.`isbid`, l.`bid_end`, l.`bid_price` FROM `#@__infolist` as l WHERE 1 = 1".$where);
		}

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
			$totalGray = $dsql->dsqlOper($archives." AND `arcrank` = 0", "totalCount");
			//已审核
			$totalAudit = $dsql->dsqlOper($archives." AND `arcrank` = 1", "totalCount");
			//拒绝审核
			$totalRefuse = $dsql->dsqlOper($archives." AND `arcrank` = 2", "totalCount");
			//过期
			$now = GetMkTime(time());
			$totalExpire = $dsql->dsqlOper($archives." AND `valid` < ".$now." AND `valid` <> 0", "totalCount");

			$pageinfo['gray'] = $totalGray;
			$pageinfo['audit'] = $totalAudit;
			$pageinfo['refuse'] = $totalRefuse;
			$pageinfo['expire'] = $totalExpire;
		}

		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";

		$results = $dsql->dsqlOper($archives.$where1.$order.$where, "results");

		if($results){

			$param = array(
				"service"     => "info",
				"template"    => "list",
				"id"          => "%id%"
			);
			$typeurlParam = getUrlPath($param);

			$param = array(
				"service"     => "info",
				"template"    => "detail",
				"id"          => "%id%"
			);
			$urlParam = getUrlPath($param);

			$now = GetMkTime(time());

			foreach($results as $key => $val){
				$list[$key]['id']          = $val['id'];
				$list[$key]['title']       = $val['title'];
				$list[$key]['color']       = $val['color'];

				//会员发布信息统计
				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infolist` WHERE `userid` = ".$val['userid']);
				$results = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['fabuCount'] = $results;

				global $data;
				$data = "";
				$addrArr = getParentArr("infoaddr", $val['addr']);
				$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
				$list[$key]['address']     = join(" - ", $addrArr);

				$list[$key]['typeid']      = $val['typeid'];
				$archives = $dsql->SetQuery("SELECT `typename` FROM `#@__infotype` WHERE `id` = ".$val['typeid']);
				$typename = $dsql->dsqlOper($archives, "results");
				if($typename){
					$list[$key]['typename']   = $typename[0]['typename'];
				}else{
					$list[$key]['typename']   = "";
				}

				$list[$key]['tel']     = $val['tel'];
				$list[$key]['teladdr'] = $val['teladdr'];

				$list[$key]['click'] = $val['click'];

				$list[$key]['pubdate'] = $val['pubdate'];
				$list[$key]['fire']    = $val['fire'];
				$list[$key]['rec']     = $val['rec'];
				$list[$key]['top']     = $val['top'];
				$list[$key]['isbid']   = $val['isbid'];
				$list[$key]['valid']   = $val['valid'];
				$list[$key]['isvalid'] = ($val['valid'] != 0 && $val['valid'] > $now) ? 0 : 1;

				$list[$key]['typeurl'] = str_replace("%id%", $val['typeid'], $typeurlParam);
				$list[$key]['url'] = str_replace("%id%", $val['id'], $urlParam);

				//图集信息
				$archives = $dsql->SetQuery("SELECT * FROM `#@__infopic` WHERE `aid` = ".$val['id']." ORDER BY `id` ASC LIMIT 0, 1");
				$results = $dsql->dsqlOper($archives, "results");
				if(!empty($results)){
					$list[$key]['litpic'] = getFilePath($results[0]["picPath"]);
				}

				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infopic` WHERE `aid` = ".$val['id']);
				$results = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['pcount'] = $results;

				$list[$key]['desc'] = cn_substrR(strip_tags($val['body']), 80);

				$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infocommon` WHERE `aid` = ".$val['id']." AND `ischeck` = 1");
				$totalCount = $dsql->dsqlOper($archives, "totalCount");
				$list[$key]['common'] = $totalCount;

				//会员信息
				$member = getMemberDetail($val['userid']);
				$list[$key]['member'] = array(
					"id"           => $val['userid'],
					"nickname"     => $member['nickname'],
					"photo"        => $member['photo'],
					"userType"     => $member['userType'],
					"emailCheck"   => $member['emailCheck'],
					"phoneCheck"   => $member['phoneCheck'],
					"certifyState" => $member['certifyState']
				);

				//验证是否已经收藏
				$params = array(
					"module" => "info",
					"temp"   => "detail",
					"type"   => "add",
					"id"     => $val['id'],
					"check"  => 1
				);
				$collect = checkIsCollect($params);
				$list[$key]['collect'] = $collect == "has" ? 1 : 0;

				//会员中心显示信息状态
				if($u == 1 && $userLogin->getMemberID() > -1){

					$now = GetMkTime(time());
					if($val['pubdate'] + $val['valid'] * 86400 < $now AND $val['valid'] != 0){
						$list[$key]['arcrank'] = 4;
					}else{
						$list[$key]['arcrank'] = $val['arcrank'];
					}

					//显示竞价结束时间、每日预算
					$list[$key]['bid_price'] = $val['bid_price'];
					$list[$key]['bid_end'] = $val['bid_end'];
				}

			}

		}

		return array("pageInfo" => $pageinfo, "list" => $list);
	}


	/**
     * 信息详细
     * @return array
     */
	public function detail(){
		global $dsql;
		global $userLogin;
		$infoDetail = array();
		$id = $this->param;

		if(!is_numeric($id)) return array("state" => 200, "info" => '格式错误！');

		//判断是否管理员已经登录
		$where = "";


		// 此处是为了判断信息在未审核状态下，只有管理员和发布者可以在前台浏览
		if($userLogin->getUserID() == -1){

			$where = " AND `arcrank` = 1";

			//如果没有登录再验证会员是否已经登录
			if($userLogin->getMemberID() == -1){
				$where = " AND `arcrank` = 1";
			}else{
				$where = " AND (`arcrank` = 1 OR `userid` = ".$userLogin->getMemberID().")";
			}

		}

		$archives = $dsql->SetQuery("SELECT * FROM `#@__infolist` WHERE `id` = ".$id.$where);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){

			$valid = $results[0]['valid'];
			$pubdate = $results[0]['pubdate'];

			$infoDetail["id"]      = $results[0]['id'];
			$infoDetail["typeid"]  = $results[0]['typeid'];
			$infoDetail["title"]   = $results[0]['title'];
			$infoDetail["addrid"]  = $results[0]['addr'];

			global $data;
			$data = "";
			$addrArr = getParentArr("infoaddr", $results[0]['addr']);
			$addrArr = array_reverse(parent_foreach($addrArr, "typename"));
			$infoDetail['address'] = join(" > ", $addrArr);

			$infoDetail["validVal"]  = $results[0]['valid'];

			$item = array();
			$infoitem = $dsql->SetQuery("SELECT `iid`, `value` FROM `#@__infoitem` WHERE `aid` = ".$results[0]['id']." ORDER BY `id` ASC");
			$itemResult = $dsql->dsqlOper($infoitem, "results");
			if($itemResult){
				foreach($itemResult as $key => $val){
					$typeitem = $dsql->SetQuery("SELECT `id`, `title` FROM `#@__infotypeitem` WHERE `id` = ".$val['iid']);
					$itemResult = $dsql->dsqlOper($typeitem, "results");
					if($itemResult){
						$item[$key]['id']    = $val['iid'];
						$item[$key]['type']  = $itemResult[0]['title'];
						$item[$key]['value'] = $val['value'];
					}
				}
			}
			$infoDetail["item"]     = $item;

			$infoDetail["body"]     = $results[0]['body'];
			$infoDetail["mbody"]    = empty($results[0]['mbody']) ? $results[0]['body'] : $results[0]['mbody'];
			$infoDetail["person"]   = $results[0]['person'];

			$RenrenCrypt = new RenrenCrypt();
			$infoDetail["tel"]      = base64_encode($RenrenCrypt->php_encrypt($results[0]['tel']));

			//if($userLogin->getUserID() > -1 || $userLogin->getMemberID() > -1){
				$infoDetail["telNum"]   = $results[0]['tel'];
			//}

			$infoDetail["teladdr"]  = $results[0]['teladdr'];
			$infoDetail["qq"]       = $results[0]['qq'];
			$infoDetail["click"]    = $results[0]['click'];
			$infoDetail["ip"]       = preg_replace('/(\d+)\.(\d+)\.(\d+)\.(\d+)/is',"$1.$2.*.*", $results[0]['ip']);
			$infoDetail["ipaddr"]   = $results[0]['ipaddr'];
			$infoDetail["userid"]   = $results[0]['userid'];
			$infoDetail["pubdate"]  = $pubdate;
			$infoDetail['member']   = getMemberDetail($results[0]['userid']);
			$infoDetail["rec"]      = $results[0]['rec'];
			$infoDetail["fire"]     = $results[0]['fire'];
			$infoDetail["top"]      = $results[0]['top'];

			//会员发布信息统计
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infolist` WHERE `userid` = ".$results[0]['userid']);
			$results1 = $dsql->dsqlOper($archives, "totalCount");
			$infoDetail['fabuCount'] = $results1;

			//验证是否已经收藏
			$params = array(
				"module" => "info",
				"temp"   => "detail",
				"type"   => "add",
				"id"     => $results[0]['id'],
				"check"  => 1
			);
			$collect = checkIsCollect($params);
			$infoDetail['collect'] = $collect == "has" ? 1 : 0;


			//有效期
			$now = GetMkTime(time());
			$infoDetail["valid"] = $valid;
			$infoDetail["isvalid"] = ($valid == 0 || $valid < $now) ? 1 : 0;
			$infoDetail["validCeil"] = ($valid != 0 && $valid > $now) ? ceil(($valid - $now) / 86400) . "天后过期" : "已过期";


			//获取手机号码共发布多少条信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infolist` WHERE `tel` = '".$results[0]['tel']."'");
			$results2 = $dsql->dsqlOper($archives, "totalCount");
			$infoDetail["telCount"] = $results2;

			//获取商家共发布多少条信息
			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infolist` WHERE `userid` = '".$results[0]['userid']."'");
			$results2 = $dsql->dsqlOper($archives, "totalCount");
			$infoDetail["storeCount"] = $results2;

			$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infocommon` WHERE `aid` = ".$results[0]['id']." AND `ischeck` = 1");
			$totalCount = $dsql->dsqlOper($archives, "totalCount");
			$infoDetail['common'] = $totalCount;

			//图表信息
			$archives = $dsql->SetQuery("SELECT * FROM `#@__infopic` WHERE `aid` = ".$id." ORDER BY `id` ASC");
			$results = $dsql->dsqlOper($archives, "results");

			if(!empty($results)){
				$imglist = array();
				foreach($results as $key => $value){
					$imglist[$key]["path"] = getFilePath($value["picPath"]);
					$imglist[$key]["pathSource"] = $value["picPath"];
					$imglist[$key]["info"] = $value["picInfo"];
				}
			}else{
				$imglist = array();
			}

			$infoDetail["imglist"]     = $imglist;



		}
		return $infoDetail;
	}


	/**
     * 评论列表
     * @return array
     */
	public function common(){
		global $dsql;
		global $userLogin;
		$pageinfo = $list = array();
		$infoid = $orderby = $page = $pageSize = $where = "";

		if(!is_array($this->param)){
			return array("state" => 200, "info" => '格式错误！');
		}else{
			$infoid    = $this->param['infoid'];
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

		$archives = $dsql->SetQuery("SELECT `id`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `duser` FROM `#@__infocommon` WHERE `aid` = ".$infoid." AND `ischeck` = 1 AND `floor` = 0".$oby);
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

		$archives = $dsql->SetQuery("SELECT `id`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `duser` FROM `#@__infocommon` WHERE `floor` = ".$fid." AND `ischeck` = 1 ORDER BY `id` DESC");
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

		$archives = $dsql->SetQuery("SELECT `duser` FROM `#@__infocommon` WHERE `id` = ".$id);
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

			$archives = $dsql->SetQuery("UPDATE `#@__infocommon` SET `good` = `good` + 1 WHERE `id` = ".$id);
			$results = $dsql->dsqlOper($archives, "update");

			$archives = $dsql->SetQuery("UPDATE `#@__infocommon` SET `duser` = '$nuser' WHERE `id` = ".$id);
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

		include HUONIAOINC."/config/info.inc.php";
		$state = (int)$customCommentCheck;

		$archives = $dsql->SetQuery("INSERT INTO `#@__infocommon` (`aid`, `floor`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `ischeck`, `duser`) VALUES ('$aid', '$id', '".$userLogin->getMemberID()."', '$content', ".GetMkTime(time()).", '".GetIP()."', '".getIpAddr(GetIP())."', 0, 0, '$state', '')");
		$lid  = $dsql->dsqlOper($archives, "lastid");
		if($lid){
			$archives = $dsql->SetQuery("SELECT `id`, `userid`, `content`, `dtime`, `ip`, `ipaddr`, `good`, `bad`, `duser` FROM `#@__infocommon` WHERE `id` = ".$lid);
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

		$typeid  = $param['typeid'];
		$title   = filterSensitiveWords(addslashes($param['title']));
		$addr    = $param['addr'];
		$person  = filterSensitiveWords(addslashes($param['person']));
		$qq      = filterSensitiveWords($param['qq']);
		$tel     = filterSensitiveWords($param['tel']);
		$valid   = $param['valid'];
		$body    = filterSensitiveWords($param['body']);
		$imglist = $param['imglist'];
		$valid   = $param['valid'];
		$vdimgck = $param['vdimgck'];

		if(empty($typeid)) return array("state" => 200, "info" => '分类传递失败');
		if(empty($title)) return array("state" => 200, "info" => '标题不得为空');

		$title = cn_substrR($title, 50);

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		//获取分类下相应字段
		$infoitem = $dsql->SetQuery("SELECT * FROM `#@__infotypeitem` WHERE `tid` = ".$typeid." ORDER BY `orderby` DESC");
		$itemResults = $dsql->dsqlOper($infoitem, "results");

		//验证字段内容
		if(count($itemResults) > 0){
			foreach ($itemResults as $key=>$value) {
				if($value["required"] == 1 && $param[$value["field"]] == ""){
					if($value["formtype"] == "text"){
						return array("state" => 200, "info" => $value['title'].'不能为空');
					}else{
						return array("state" => 200, "info" => '请选择'.$value['title']);
					}
				}
			}
		}

		if(empty($addr)) return array("state" => 200, "info" => '请选择所在区域');
		if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
		if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');
		if(empty($valid)) return array("state" => 200, "info" => '请选择有效期');
		if(empty($vdimgck)) return array("state" => 200, "info" => '请输入验证码');

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		$person = cn_substrR($person, 6);
		$tel    = cn_substrR($tel, 11);

		$ip = GetIP();
		$ipAddr = getIpAddr($ip);

		$teladdr = getTelAddr($tel);
		$valid   = GetMkTime($valid);

		include HUONIAOINC."/config/info.inc.php";
		$state = (int)$customFabuCheck;

		//保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__infolist` (`typeid`, `title`, `valid`, `addr`, `body`, `person`, `tel`, `teladdr`, `qq`, `ip`, `ipaddr`, `pubdate`, `userid`, `arcrank`) VALUES ('$typeid', '$title', '$valid', '$addr', '$body', '$person', '$tel', '$teladdr', '$qq', '$ip', '$ipAddr', ".GetMkTime(time()).", '$uid', '$state')");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if(is_numeric($aid)){
			//保存字段内容
			if(count($itemResults) > 0){
				foreach ($itemResults as $key=>$value) {
					$val = $param[$value['field']];
					if($value['formtype'] == "checkbox"){
						$val = join(",", $val);
					}
					$val = filterSensitiveWords($val);
					$infoitem = $dsql->SetQuery("INSERT INTO `#@__infoitem` (`aid`, `iid`, `value`) VALUES (".$aid.", ".$value['id'].", '".$val."')");
					$dsql->dsqlOper($infoitem, "update");
				}
			}

			//保存图集表
			if($imglist != ""){
				$picList = explode(",",$imglist);
				foreach($picList as $k => $v){
					$picInfo = explode("|", $v);
					$pics = $dsql->SetQuery("INSERT INTO `#@__infopic` (`aid`, `picPath`, `picInfo`) VALUES (".$aid.", '".$picInfo[0]."', '".filterSensitiveWords($picInfo[1])."')");
					$dsql->dsqlOper($pics, "update");
				}
			}

			//后台消息通知
			updateAdminNotice("info", "detail");

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

		$typeid  = $param['typeid'];
		$title   = filterSensitiveWords(addslashes($param['title']));
		$addr    = $param['addr'];
		$person  = filterSensitiveWords(addslashes($param['person']));
		$qq      = filterSensitiveWords($param['qq']);
		$tel     = filterSensitiveWords($param['tel']);
		$valid   = $param['valid'];
		$body    = filterSensitiveWords($param['body']);
		$imglist = $param['imglist'];
		$vdimgck = $param['vdimgck'];
		$valid   = $param['valid'];

		if(empty($typeid)) return array("state" => 200, "info" => '分类传递失败');
		if(empty($title)) return array("state" => 200, "info" => '标题不得为空');

		$title = cn_substrR($title, 50);

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 200, "info" => '登录超时，请重新登录！');
		}

		$archives = $dsql->SetQuery("SELECT `id` FROM `#@__infolist` WHERE `id` = ".$id." AND `userid` = ".$uid);
		$results  = $dsql->dsqlOper($archives, "results");
		if(!$results){
			return array("state" => 200, "info" => '权限不足，修改失败！');
		}

		//获取分类下相应字段
		$infoitem = $dsql->SetQuery("SELECT * FROM `#@__infotypeitem` WHERE `tid` = ".$typeid." ORDER BY `orderby` DESC");
		$itemResults = $dsql->dsqlOper($infoitem, "results");

		//验证字段内容
		if(count($itemResults) > 0){
			foreach ($itemResults as $key=>$value) {
				if($value["required"] == 1 && $param[$value["field"]] == ""){
					if($value["formtype"] == "text"){
						return array("state" => 200, "info" => $value['title'].'不能为空');
					}else{
						return array("state" => 200, "info" => '请选择'.$value['title']);
					}
				}
			}
		}

		if(empty($addr)) return array("state" => 200, "info" => '请选择所在区域');
		if(empty($person)) return array("state" => 200, "info" => '请输入联系人');
		if(empty($tel)) return array("state" => 200, "info" => '请输入手机号码');
		if(empty($valid)) return array("state" => 200, "info" => '请选择有效期');
		if(empty($vdimgck)) return array("state" => 200, "info" => '请输入验证码');

		$vdimgck = strtolower($vdimgck);
		if($vdimgck != $_SESSION['huoniao_vdimg_value']) return array("state" => 200, "info" => '验证码输入错误');

		$person = cn_substrR($person, 6);
		$tel    = cn_substrR($tel, 11);

		$ip = GetIP();
		$ipAddr = getIpAddr($ip);

		include HUONIAOINC."/config/info.inc.php";
		$state = (int)$customFabuCheck;

		$teladdr = getTelAddr($tel);
		$valid   = GetMkTime($valid);

		//保存到主表
		$archives = $dsql->SetQuery("UPDATE `#@__infolist` SET `title` = '".$title."', `valid` = ".$valid.", `addr` = ".$addr.", `body` = '".$body."', `person` = '".$person."', `tel` = '".$tel."', `teladdr` = '".$teladdr."', `qq` = '".$qq."', `arcrank` = '$state' WHERE `id` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		if($results != "ok"){
			return array("state" => 200, "info" => '保存到数据时发生错误，请检查字段内容！');
		}

		//先删除信息所属字段
		$archives = $dsql->SetQuery("DELETE FROM `#@__infoitem` WHERE `aid` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		//保存字段内容
		if(count($itemResults) > 0){
			foreach ($itemResults as $key=>$value) {

				$val = $_POST[$value['field']];
				if($value['formtype'] == "checkbox"){
					$val = join(",", $val);
				}
				$val = filterSensitiveWords($val);
				$infoitem = $dsql->SetQuery("INSERT INTO `#@__infoitem` (`aid`, `iid`, `value`) VALUES (".$id.", ".$value['id'].", '".$val."')");
				$dsql->dsqlOper($infoitem, "update");
			}
		}

		//先删除信息所属图集
		$archives = $dsql->SetQuery("DELETE FROM `#@__infopic` WHERE `aid` = ".$id);
		$results = $dsql->dsqlOper($archives, "update");

		//保存图集表
		if($imglist != ""){
			$picList = explode(",",$imglist);
			foreach($picList as $k => $v){
				$picInfo = explode("|", $v);
				$pics = $dsql->SetQuery("INSERT INTO `#@__infopic` (`aid`, `picPath`, `picInfo`) VALUES (".$id.", '".$picInfo[0]."', '".filterSensitiveWords($picInfo[1])."')");
				$dsql->dsqlOper($pics, "update");
			}
		}

		//后台消息通知
		updateAdminNotice("info", "detail");

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

		$archives = $dsql->SetQuery("SELECT * FROM `#@__infolist` WHERE `id` = ".$id);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			$results = $results[0];
			if($results['userid'] == $uid){

				//如果已经竞价，不可以删除
				if($results['isbid'] == 1){
					return array("state" => 101, "info" => '竞价状态的信息不可以删除！');
				}

				//删除评论
				$archives = $dsql->SetQuery("DELETE FROM `#@__infocommon` WHERE `aid` = ".$id);
				$dsql->dsqlOper($archives, "update");

				$archives = $dsql->SetQuery("SELECT * FROM `#@__infolist` WHERE `id` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");

				//删除缩略图
				delPicFile($results[0]['litpic'], "delThumb", "info");

				$body = $results[0]['body'];
				if(!empty($body)){
					delEditorPic($body, "info");
				}

				//删除图集
				$archives = $dsql->SetQuery("SELECT `picPath` FROM `#@__infopic` WHERE `aid` = ".$id);
				$results = $dsql->dsqlOper($archives, "results");

				//删除图片文件
				if(!empty($results)){
					$atlasPic = "";
					foreach($results as $key => $value){
						$atlasPic .= $value['picPath'].",";
					}
					delPicFile(substr($atlasPic, 0, strlen($atlasPic)-1), "delAtlas", "info");
				}

				$archives = $dsql->SetQuery("DELETE FROM `#@__infopic` WHERE `aid` = ".$id);
				$dsql->dsqlOper($archives, "update");

				//删除字段
				$archives = $dsql->SetQuery("DELETE FROM `#@__infoitem` WHERE `aid` = ".$id);
				$dsql->dsqlOper($archives, "update");

				//删除表
				$archives = $dsql->SetQuery("DELETE FROM `#@__infolist` WHERE `id` = ".$id);
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
		* 验证信息状态是否可以竞价
		* @return array
		*/
	public function checkBidState(){
		global $dsql;
		global $userLogin;

		$aid = $this->param['aid'];

		if(!is_numeric($aid)) return array("state" => 200, "info" => '格式错误！');

		//获取用户ID
		$uid = $userLogin->getMemberID();
		if($uid == -1){
			return array("state" => 101, "info" => '登录超时，请重新登录！');
		}

		$archives = $dsql->SetQuery("SELECT `arcrank`, `isbid`, `userid`, `bid_price`, `bid_end`, `valid` FROM `#@__infolist` WHERE `id` = ".$aid);
		$results  = $dsql->dsqlOper($archives, "results");
		if($results){
			//已过期的不可以竞价
			$now = GetMkTime(time());
			if($results[0]['valid'] == 0 || $results[0]['valid'] < $now){
				return array("state" => 200, "info" => '过期的信息不可以竞价！！');
			}
			if($results[0]['userid'] != $uid){
				return array("state" => 200, "info" => '您走错地方了吧，只能竞价自己发布的信息哦！');
			}elseif($results[0]['arcrank'] != 1){
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
			"module"      => "info"
		);
		$url = getUrlPath($param);

		//验证金额
		if($amount <= 0 || !is_numeric($aid) || empty($paytype)){
			header("location:".$url);
			die;
		}

		//查询信息
		$sql = $dsql->SetQuery("SELECT `arcrank`, `isbid`, `userid`, `valid` FROM `#@__infolist` WHERE `id` = ".$aid);
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			//信息不存在
			header("location:".$url);
			die;
		}
		$userid = $ret[0]['userid'];

		//没有审核的信息不可以竞价
		if($ret[0]['arcrank'] != 1){
			header("location:".$url);
			die;
		}

		//已过期的不可以竞价
		$now = GetMkTime(time());
		if($ret[0]['valid'] == 0 || $ret[0]['valid'] < $now){
			header("location:".$url);
			die;
		}

		//已经竞价的，不可以再提交
		if($ret[0]['isbid'] == 1){
			header("location:".$url);
			die;
		}

		//只能给自己发布的信息竞价
		if($userid != $uid){
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

		$archives = $dsql->SetQuery("INSERT INTO `#@__member_bid` (`ordernum`, `module`, `part`, `uid`, `aid`, `start`, `end`, `price`, `state`) VALUES ('$ordernum', 'info', 'detail', '$uid', '$aid', '$start', '$end', '$price', 0)");
		$return = $dsql->dsqlOper($archives, "update");
		if($return != "ok"){
			die("提交失败，请稍候重试！");
		}

		//跳转至第三方支付页面
		createPayForm("info", $ordernum, $amount, $paytype, "分类信息竞价");

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
		if(!is_numeric($aid) || empty($paytype)){
			header("location:".$url);
			die;
		}

		//查询信息
		$sql = $dsql->SetQuery("SELECT `arcrank`, `isbid`, `userid`, `bid_price`, `bid_start`, `bid_end` FROM `#@__infolist` WHERE `id` = ".$aid);
		$ret = $dsql->dsqlOper($sql, "results");
		if(!$ret){
			//信息不存在
			header("location:".$url);
			die;
		}
		$userid = $ret[0]['userid'];

		//没有审核的信息不可以竞价
		if($ret[0]['arcrank'] != 1){
			header("location:".$url);
			die;
		}

		//如果没有参加过竞价，则不可以进行加价操作
		if($ret[0]['isbid'] != 1){
			header("location:".$url);
			die;
		}

		//只能给自己发布的信息竞价
		if($userid != $uid){
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

		$archives = $dsql->SetQuery("INSERT INTO `#@__member_bid` (`ordernum`, `module`, `part`, `uid`, `aid`, `start`, `end`, `price`, `state`) VALUES ('$ordernum', 'info', 'detail', '$uid', '$aid', '$start', '$end', '$price', 0)");
		$return = $dsql->dsqlOper($archives, "update");
		if($return != "ok"){
			die("提交失败，请稍候重试！");
		}

		//跳转至第三方支付页面
		createPayForm("info", $ordernum, $amount, $paytype, "分类信息竞价加价");

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
				$uid    = $ret[0]['uid'];
				$aid    = $ret[0]['aid'];
				$start  = $ret[0]['start'];
				$end    = $ret[0]['end'];
				$price  = $ret[0]['price'];

				//总价 = (结束时间 - 开始时间) 得到天数 * 每日预算
				$day    = ($end - $start) / 24 / 3600;
				$amount = $day * $price;

				//信息
				$sql = $dsql->SetQuery("SELECT `title`, `isbid`, `bid_price` FROM `#@__infolist` WHERE `id` = $aid");
				$ret = $dsql->dsqlOper($sql, "results");
				$title     = $ret[0]['title'];
				$isbid     = $ret[0]['isbid'];
				$bid_price = $ret[0]['bid_price'];

				//更新订单状态
				$sql = $dsql->SetQuery("UPDATE `#@__member_bid` SET `state` = 1 WHERE `id` = ".$bid);
				$dsql->dsqlOper($sql, "update");

				//加价
				if($isbid == 1){

					$title = '加价，每天增加预算'.$price.'元：<a href="http://'.$cfg_basehost.'/index.php?service=info&template=detail&id='.$aid.'" target="_blank">'.$title.'</a>';

					//更新信息竞价状态
					$sql = $dsql->SetQuery("UPDATE `#@__infolist` SET `bid_price` = `bid_price` + '$price' WHERE `id` = ".$aid);
					$dsql->dsqlOper($sql, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '信息竞价$title', '$date')");
					$dsql->dsqlOper($archives, "update");


				//竞价
				}else{

					$title = $day.'天，每天预算'.$price.'元，结束时间：'.date("Y-m-d H:i:s", $end).'：<a href="http://'.$cfg_basehost.'/index.php?service=info&template=detail&id='.$aid.'" target="_blank">'.$title.'</a>';

					//更新信息竞价状态
					$sql = $dsql->SetQuery("UPDATE `#@__infolist` SET `isbid` = 1, `bid_price` = '$price', `bid_start` = '$start', `bid_end` = '$end' WHERE `id` = ".$aid);
					$dsql->dsqlOper($sql, "update");

					//保存操作日志
					$archives = $dsql->SetQuery("INSERT INTO `#@__member_money` (`userid`, `type`, `amount`, `info`, `date`) VALUES ('$uid', '0', '$amount', '信息竞价$title', '$date')");
					$dsql->dsqlOper($archives, "update");

				}



			}

		}
	}



}
