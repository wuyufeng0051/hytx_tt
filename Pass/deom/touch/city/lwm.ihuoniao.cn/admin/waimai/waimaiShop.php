<?php
/**
 * 店铺管理 店铺列表
 *
 * @version        $Id: list.php 2017-4-25 上午10:16:21 $
 * @package        HuoNiao.Shop
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', ".." );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$dbname = "waimai_shop";
$templates = "waimaiShop.html";


//更新店铺状态
if($action == "updateStatus"){
    if(!empty($id)){

        $val = (int)$val;

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `status` = $val WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "更新成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "更新失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


//更新微信下单状态
if($action == "updateValid"){
    if(!empty($id)){

        $val = (int)$val;

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `ordervalid` = $val WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
            echo '{"state": 100, "info": "更新成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "更新失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


//删除店铺
if($action == "delete"){
    if(!empty($id)){

        $sql = $dsql->SetQuery("DELETE FROM `#@__$dbname` WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){

            //删除商品分类
            $sql = $dsql->SetQuery("DELETE FROM `#@__waimai_list_type` WHERE `sid` = $id");
            $dsql->dsqlOper($sql, "update");

            //删除商品
            $sql = $dsql->SetQuery("DELETE FROM `#@__waimai_list` WHERE `sid` = $id");
            $dsql->dsqlOper($sql, "update");

            echo '{"state": 100, "info": "删除成功！"}';
    		exit();
        }else{
            echo '{"state": 200, "info": "删除失败！"}';
    		exit();
        }

    }else{
        echo '{"state": 200, "info": "信息ID传输失败！"}';
		exit();
    }
}


// 快速编辑
if($action == "fastedit"){
  if(empty($type) || $type == "id" || empty($id) || $val == "") echo '{"state": 200, "info": "参数错误！"}';

  if($type != "shopname" && $type != "sort") echo '{"state": 200, "info": "操作错误！"}';

  if($type == "shopname"){
    $sql = $dsql->SetQuery("SELECT `id` FROM `#@__$dbname` WHERE `shopname` = '$val' AND `id` != '$id'");
    $ret = $dsql->dsqlOper($sql, "results");
    if($ret){
      die('{"state": 200, "info": "店铺名称已经存在！"}');
    }
  }

  $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET `$type` = '$val' WHERE `id` = $id");
  // echo $sql;die;
  $ret = $dsql->dsqlOper($sql, "update");
  if($ret == "ok"){
    die('{"state": 100, "info": "修改成功！"}');
  }else{
    die('{"state": 200, "info": "修改失败！"}');
  }
}



$where = "";

//店铺名称
if(!empty($shopname)){
  $where .= " AND s.`shopname` like ('%$shopname%')";
}

//店铺分类
if(!empty($typeid)){
  $reg = "(^$typeid$|^$typeid,|,$typeid,|,$typeid)";
  $where .= " AND s.`typeid` REGEXP '".$reg."' ";
}

//店铺分类
if(!empty($typename)){
  if(is_numeric($typename) && empty($typeid)){
    $reg = "(^$typename$|^$typename,|,$typename,|,$typename)";
    $where .= " AND s.`typeid` REGEXP '".$reg."' ";
  }else{
    $where .= " AND t.`title` like '%$typename%'";
  }
}

//联系电话
if(!empty($phone)){
  $where .= " AND s.`phone` like ('%$phone%')";
}

//联系地址
if(!empty($address)){
  $where .= " AND s.`address` like ('%$address%')";
}

$pageSize = 15;

$reg = "(^s.`typeid`$|^s.`typeid`,|,s.`typeid`,|,s.`typeid`)";
$sql = $dsql->SetQuery("SELECT s.`id`, s.`shopname`, s.`sort`, s.`typeid`, s.`phone`, s.`address`, s.`status`, s.`ordervalid`, s.`print_state` FROM `#@__$dbname` s LEFT JOIN `#@__waimai_shop_type` t ON t.`id` in (s.`typeid`) WHERE 1 = 1".$where." ORDER BY s.`sort` DESC, `id` DESC");

//总条数
$totalCount = $dsql->dsqlOper($sql, "totalCount");
//总分页数
$totalPage = ceil($totalCount/$pageSize);

$p = (int)$p == 0 ? 1 : (int)$p;
$atpage = $pageSize * ($p - 1);
$results = $dsql->dsqlOper($sql." LIMIT $atpage, $pageSize", "results");

$list = array();
foreach ($results as $key => $value) {
  $list[$key]['id']         = $value['id'];
  $list[$key]['shopname']   = $value['shopname'];
  $list[$key]['sort']       = $value['sort'];
  $list[$key]['typeid']     = $value['typeid'];
  $list[$key]['phone']      = $value['phone'];
  $list[$key]['address']    = $value['address'];
  $list[$key]['status']     = $value['status'];
  $list[$key]['ordervalid'] = $value['ordervalid'];
  $list[$key]['print_state'] = $value['print_state'];

  // 分类名
  $typeArr = array();
  $typeids = explode(",", $value['typeid']);
  foreach ($typeids as $k => $val) {
    if($val){
      $typeSql = $dsql->SetQuery("SELECT `title` FROM `#@__waimai_shop_type` WHERE `id` = ". $val);
      $type = $dsql->getTypeName($typeSql);
      array_push($typeArr, $type[0]['title']);
    }
  }
  $list[$key]['typename'] = join(" > ", $typeArr);

  $param = array(
      "service"  => "waimai",
      "template" => "shop",
      "id"       => $value['id']
  );
  $list[$key]['url'] = getUrlPath($param);
}

$huoniaoTag->assign("shopname", $shopname);
$huoniaoTag->assign("typename", $typename);
$huoniaoTag->assign("phone", $phone);
$huoniaoTag->assign("address", $address);
$huoniaoTag->assign("list", $list);

$pagelist = new pagelist(array(
  "list_rows"   => $pageSize,
  "total_pages" => $totalPage,
  "total_rows"  => $totalCount,
  "now_page"    => $p
));
$huoniaoTag->assign("pagelist", $pagelist->show());



//验证模板文件
if(file_exists($tpl."/".$templates)){

    //css
	$cssFile = array(
		'admin/jquery-ui.css',
		'admin/styles.css',
		'admin/chosen.min.css',
		'admin/ace-fonts.min.css',
		'admin/select.css',
		'admin/ace.min.css',
		'admin/animate.css',
		'admin/font-awesome.min.css',
		'admin/simple-line-icons.css',
		'admin/font.css',
		// 'admin/app.css'
	);
	$huoniaoTag->assign('cssFile', includeFile('css', $cssFile));

    //js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'admin/waimai/waimaiShop.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));

	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
