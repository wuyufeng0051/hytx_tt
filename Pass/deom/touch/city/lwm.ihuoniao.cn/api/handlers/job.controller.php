<?php

/**
 * huoniaoTag模板标签函数插件-招聘模块
 *
 * @param $params array 参数集
 * @return array
 */
function job($params, $content = "", &$smarty = array(), &$repeat = array()){
	$service = "job";
	extract ($params);
	if(empty($action)) return '';

	global $huoniaoTag;
	global $dsql;
	global $userLogin;
	global $cfg_basehost;

	$userid = $userLogin->getMemberID();

	//职位
	if($action == "zhaopin"){

		//输出所有GET参数
		$pageParam = array();
		foreach($_GET as $key => $val){
			$huoniaoTag->assign($key, $val);
			if($key != "service" && $key != "template" && $key != "page"){
				array_push($pageParam, $key."=".$val);
			}
		}
		$huoniaoTag->assign("pageParam", join("&", $pageParam));


		//性质
		$natureName = "";
		switch ($nature) {
			case 0:
				$natureName = "全职";
				break;
			case 1:
				$natureName = "兼职";
				break;
			case 2:
				$natureName = "临时";
				break;
			case 3:
				$natureName = "实习";
				break;
		}
		$huoniaoTag->assign("natureName", $natureName);


		//工作经验
		$experienceName = "";
		if(!empty($experience)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$experience);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$experienceName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("experienceName", $experienceName);


		//学历要求
		$educationalName = "";
		if(!empty($educational)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$educational);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$educationalName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("educationalName", $educationalName);


		//薪资范围
		$salaryName = "";
		if(!empty($salary)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$salary);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$salaryName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("salaryName", $salaryName);


		//公司性质
		$gnatureName = "";
		if(!empty($gnature)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$gnature);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$gnatureName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("gnatureName", $gnatureName);


		//公司规模
		$scaleName = "";
		if(!empty($scale)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$scale);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$scaleName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("scaleName", $scaleName);


		//工作地点
		$addrName = "";
		if(!empty($addr)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobaddr` WHERE `id` = ".$addr);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$addrName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("addrName", $addrName);


		//行业领域
		$industryName = "";
		if(!empty($industry)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_industry` WHERE `id` = ".$industry);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$industryName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("industryName", $industryName);


		//职位类型
		$typeName = "";
		if(!empty($jtype)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_type` WHERE `id` = ".$jtype);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typeName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("typeName", $typeName);

		//分页
		$page = (int)$page;
		$atpage = $page == 0 ? 1 : $page;
		global $page;
		$page = $atpage;
		$huoniaoTag->assign('page', $page);


	//公司
	}elseif($action == "company" || $action == "payroll-list"){

		//输出所有GET参数
		$pageParam = array();
		foreach($_GET as $key => $val){
			$huoniaoTag->assign($key, $val);
			if($key != "service" && $key != "template" && $key != "page"){
				array_push($pageParam, $key."=".$val);
			}
		}
		$huoniaoTag->assign("pageParam", join("&", $pageParam));


		//公司性质
		$natureName = "";
		if(!empty($nature)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$nature);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$natureName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("natureName", $natureName);


		//公司规模
		$scaleName = "";
		if(!empty($scale)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$scale);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$scaleName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("scaleName", $scaleName);


		//工作地点
		$addrName = "";
		if(!empty($addrid)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobaddr` WHERE `id` = ".$addrid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$addrName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("addrName", $addrName);


		//行业领域
		$industryName = "";
		if(!empty($industry)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_industry` WHERE `id` = ".$industry);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$industryName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("industryName", $industryName);


		//分页
		$page = (int)$page;
		$atpage = $page == 0 ? 1 : $page;
		global $page;
		$page = $atpage;
		$huoniaoTag->assign('page', $page);


	//公司详细
	}elseif($action == "company-detail" || $action == "company-album" || $action == "company-job" || $action == "job" || $action == "company-salary" || $action == "storeDetail") {

		if($action == "job"){
			$detailHandels = new handlers($service, "job");
			$detailConfig  = $detailHandels->getHandle($id);

			if(is_array($detailConfig) && $detailConfig['state'] == 100){
				$detailConfig  = $detailConfig['info'];
				if(is_array($detailConfig)){

					//输出详细信息
					foreach ($detailConfig as $key => $value) {
						$huoniaoTag->assign('job_'.$key, $value);
					}

					$id = $detailConfig['company']['id'];

				}

			}else{
				header("location:http://".$cfg_basehost."/404.html");
			}
		}


		$detailHandels = new handlers($service, "companyDetail");
		$detailConfig  = $detailHandels->getHandle($id);
		$state = 0;

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}
				$state = 1;

			}

		}else{
			if($action != "storeDetail"){
				header("location:http://".$cfg_basehost."/404.html");
			}
		}
		$huoniaoTag->assign('storeState', $state);


		require(HUONIAOINC."/config/job.inc.php");

		if($customUpload == 1){
			$huoniaoTag->assign('thumbSize', $custom_thumbSize);
			$huoniaoTag->assign('thumbType', "*.".str_replace("|", ";*.", $custom_thumbType));
			$huoniaoTag->assign('atlasSize', $custom_atlasSize);
			$huoniaoTag->assign('atlasType', "*.".str_replace("|", ";*.", $custom_atlasType));
		}

		$huoniaoTag->assign('atlasMax', (int)$custom_gs_atlasMax);
		return;


	//简历
	}elseif($action == "resume"){

		//输出所有GET参数
		$pageParam = array();
		foreach($_GET as $key => $val){
			$huoniaoTag->assign($key, $val);
			if($key != "service" && $key != "template" && $key != "page"){
				array_push($pageParam, $key."=".$val);
			}
		}
		$huoniaoTag->assign("pageParam", join("&", $pageParam));


		//性别
		$sexName = "";
		switch ($sex) {
			case 0:
				$sexName = "男";
				break;
			case 1:
				$sexName = "女";
				break;
		}
		$huoniaoTag->assign("sexName", $sexName);

		//职位性质
		$natureName = "";
		switch ($nature) {
			case 0:
				$natureName = "全职";
				break;
			case 1:
				$natureName = "兼职";
				break;
			case 2:
				$natureName = "临时";
				break;
			case 3:
				$natureName = "实习";
				break;
		}
		$huoniaoTag->assign("natureName", $natureName);


		//到岗时间
		$startworkName = "";
		if(!empty($startwork)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$startwork);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$startworkName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("startworkName", $startworkName);

		$workyearName = "";
		if($workyear != ''){
			$workyear = explode(",", $workyear);
			if(empty($workyear[0])){
				$workyearName = $workyear[1] . "年以下";
			}elseif(empty($workyear[1])){
				$workyearName = $workyear[0] . "年以上";
			}else{
				$workyearName = $workyear[0] . "-" . $workyear . "年";
			}
		}
		$huoniaoTag->assign("workyearName", $workyearName);


		//学历要求
		$educationalName = "";
		if(!empty($educational)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobitem` WHERE `id` = ".$educational);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$educationalName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("educationalName", $educationalName);


		//工作地点
		$addrName = "";
		if(!empty($addr)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobaddr` WHERE `id` = ".$addr);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$addrName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("addrName", $addrName);


		//职位类型
		$typeName = "";
		if(!empty($jtype)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_type` WHERE `id` = ".$jtype);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typeName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("typeName", $typeName);


		//分页
		$page = (int)$page;
		$atpage = $page == 0 ? 1 : $page;
		global $page;
		$page = $atpage;
		$huoniaoTag->assign('page', $page);


	//简历详细
	}elseif($action == "resume-detail"){

		$detailHandels = new handlers($service, "resumeDetail");
		$detailConfig  = $detailHandels->getHandle($id);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//输出详细信息
				$uid = 0;
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
					if($key == "userid"){
						$uid = $value;
					}
				}

				//更新浏览次数
				if($userid != $uid){
					$sql = $dsql->SetQuery("UPDATE `#@__job_resume` SET `click` = `click` + 1 WHERE `id` = ".$id);
					$dsql->dsqlOper($sql, "results");
				}

			}

		}else{
			header("location:http://".$cfg_basehost."/404.html");
		}
		return;


	//伯乐
	}elseif($action == "bole"){

		//输出所有GET参数
		$pageParam = array();
		foreach($_GET as $key => $val){
			$huoniaoTag->assign($key, $val);
			if($key != "service" && $key != "template" && $key != "page"){
				array_push($pageParam, $key."=".$val);
			}
		}
		$huoniaoTag->assign("pageParam", join("&", $pageParam));


		//身份类型
		$btypeName = "";
		switch ($btype) {
			case 1:
				$btypeName = "HR";
				break;
			case 2:
				$btypeName = "猎头";
				break;
			case 3:
				$btypeName = "高管";
				break;
		}
		$huoniaoTag->assign("btypeName", $btypeName);


		//招聘状态
		$statusName = "";
		switch ($status) {
			case 1:
				$statusName = "正在招聘中";
				break;
			case 2:
				$statusName = "有好的人才可以考虑";
				break;
			case 3:
				$statusName = "暂不招聘";
				break;
		}
		$huoniaoTag->assign("statusName", $statusName);


		//工作地点
		$addrName = "";
		if(!empty($addr)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobaddr` WHERE `id` = ".$addr);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$addrName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("addrName", $addrName);


		//行业领域
		$industryName = "";
		if(!empty($industry)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_industry` WHERE `id` = ".$industry);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$industryName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("industryName", $industryName);


		//职位类型
		$typeName = "";
		if(!empty($jtype)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_type` WHERE `id` = ".$jtype);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typeName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("typeName", $typeName);

		//分页
		$page = (int)$page;
		$atpage = $page == 0 ? 1 : $page;
		global $page;
		$page = $atpage;
		$huoniaoTag->assign('page', $page);


	//招聘会
	}elseif($action == "zhaopinhui"){

		//输出所有GET参数
		$pageParam = array();
		foreach($_GET as $key => $val){
			$huoniaoTag->assign($key, $val);
			if($key != "service" && $key != "template" && $key != "page"){
				array_push($pageParam, $key."=".$val);
			}
		}
		$huoniaoTag->assign("pageParam", join("&", $pageParam));

		//区域
		$addrName = "";
		if(!empty($addr)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__jobaddr` WHERE `id` = ".$addr);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$addrName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("addrName", $addrName);

		//场馆
		$centerName = "";
		if(!empty($center)){
			$sql = $dsql->SetQuery("SELECT `title` FROM `#@__job_fairs_center` WHERE `id` = ".$center);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$centerName = $ret[0]['title'];
			}
		}
		$huoniaoTag->assign("centerName", $centerName);

		//分页
		$page = (int)$page;
		$atpage = $page == 0 ? 1 : $page;
		global $page;
		$page = $atpage;
		$huoniaoTag->assign('page', $page);


	//招聘会详细
	}elseif($action == "zhaopinhui-detail"){

		$detailHandels = new handlers($service, "fairsDetail");
		$detailConfig  = $detailHandels->getHandle($id);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}

				//更新浏览次数
				$sql = $dsql->SetQuery("UPDATE `#@__job_fairs` SET `click` = `click` + 1 WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "results");

			}

		}else{
			header("location:http://".$cfg_basehost."/404.html");
		}
		return;


	//资讯
	}elseif($action == "news"){

		$huoniaoTag->assign("typeid", (int)$typeid);
		$typeName = "";
		if(!empty($typeid)){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_newstype` WHERE `id` = ".$typeid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typeName = $ret[0]['typename'];
			}
		}
		$huoniaoTag->assign("typeName", $typeName);


	//资讯详细
	}elseif($action == "news-detail"){

		$detailHandels = new handlers($service, "newsDetail");
		$detailConfig  = $detailHandels->getHandle($id);

		if(is_array($detailConfig) && $detailConfig['state'] == 100){
			$detailConfig  = $detailConfig['info'];
			if(is_array($detailConfig)){

				//输出详细信息
				foreach ($detailConfig as $key => $value) {
					$huoniaoTag->assign('detail_'.$key, $value);
				}

				//更新浏览次数
				$sql = $dsql->SetQuery("UPDATE `#@__job_news` SET `click` = `click` + 1 WHERE `id` = ".$id);
				$dsql->dsqlOper($sql, "results");

			}

		}else{
			header("location:http://".$cfg_basehost."/404.html");
		}
		return;


	//简历
	}elseif($action == "doc"){

		$typename = "";
		$typeid = (int)$typeid;

		if($typeid){
			$sql = $dsql->SetQuery("SELECT `typename` FROM `#@__job_download_type` WHERE `id` = ".$typeid);
			$ret = $dsql->dsqlOper($sql, "results");
			if($ret){
				$typename = $ret[0]['typename'];
			}
		}

		$huoniaoTag->assign('typeid', $typeid);
		$huoniaoTag->assign('typename', $typename);



	}



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

		//指定数据
		}elseif(!empty($get)){
			$retArr = $moduleReturn['state'] == 100 ? $moduleReturn['info'][$get] : "";
			$retArr = is_array($retArr) ? $retArr : array();
			$smarty->block_data[$dataindex] = $retArr;

		//正常返回
		}else{

			global $pageInfo;
			if(!is_array($moduleReturn) || $moduleReturn['state'] != 100) {
				$pageInfo = array();
				$smarty->assign('pageInfo', $pageInfo);
				return '';
			}
			$moduleReturn  = $moduleReturn['info'];  //返回数据
			$pageInfo_ = $moduleReturn['pageInfo'];
			if($pageInfo_){
				//如果有分页数据则提取list键
				$moduleReturn  = $moduleReturn['list'];
				$pageInfo = $pageInfo_;
			}else{
				$pageInfo = array();
			}
			$smarty->assign('pageInfo', $pageInfo);
			$smarty->block_data[$dataindex] = $moduleReturn;  //存储数据

		}

	}

	//果没有数据，直接返回null,不必再执行了
	if(!$smarty->block_data[$dataindex]) {
		$repeat = false;
		return '';
	}

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
