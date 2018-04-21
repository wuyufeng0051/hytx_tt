<?php
/**
 * 评论管理
 *
 * @version        $Id: add.php 2017-4-25 上午11:19:16 $
 * @package        HuoNiao.Shop
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', "../" );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/";
$tpl = isMobile() ? $tpl."touch/message" : $tpl."message";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$dbname = "waimai_common";
$templates = "waimaiCommon.html";


$where = " AND s.`id` in ($managerIds)";
$shop = array();
$sql = $dsql->SetQuery("SELECT s.`id`, s.`shopname` FROM `#@__waimai_shop` s WHERE 1 = 1".$where);
$ret = $dsql->dsqlOper($sql, "results");
if($ret){
    $shop = $ret;
}
$huoniaoTag->assign('shop', $shop);

$list = array();
$where = " AND c.`sid` in ($managerIds)";
$pageSize = 20;
if($shopid){
    $where .= " AND c.`sid` = $shopid"; 
    $huoniaoTag->assign('shopid', $shopid);
}
$sql = $dsql->SetQuery("SELECT c.`id` FROM `#@__$dbname` c WHERE 1 = 1".$where);
//总条数
$totalCount = $dsql->dsqlOper($sql, "totalCount");
//总分页数
$totalPage = ceil($totalCount/$pageSize);

$p = (int)$p == 0 ? 1 : (int)$p;
$atpage = $pageSize * ($p - 1);


$sql = $dsql->SetQuery("SELECT c.*, o.`ordernumstore`, s.`shopname`, m.`username` FROM (`#@__$dbname` c LEFT JOIN `#@__waimai_order` o ON c.`oid` = o.`id`) LEFT JOIN `#@__waimai_shop` s ON c.`sid` = s.`id` LEFT JOIN `#@__member` m ON m.`id` = c.`uid` WHERE 1 = 1".$where);
$ret = $dsql->dsqlOper($sql." LIMIT $atpage, $pageSize", "results");
if($ret){
  foreach ($ret as $key => $value) {
    $value['pubdatef'] = date("Y-m-d H:i:s", $value['pubdate']);
    $value['replydatef'] = $value['replydate'] ? date("Y-m-d H:i:s", $value['replydate']) : "";

    $pics = $value['pics'];
    $picsf = array();
    if($pics != ""){
        $pics = explode(",", $pics);
        foreach ($pics as $k => $v) {
          $picsf[$k] = getFilePath($v);
        }
    }

    $value['pics'] = $pics;
    $value['picsf'] = $picsf;

    $list[$key] = $value;
  }
}
$huoniaoTag->assign('list', $list);

$pagelist = new pagelist(array(
  "list_rows"   => $pageSize,
  "total_pages" => $totalPage,
  "total_rows"  => $totalCount,
  "now_page"    => $p
));
$pagelist->show();
$huoniaoTag->assign("pagelist", $pagelist->show());

// 移动端-获取评论列表
if($action == "getList"){

  if($totalCount == 0){

      echo '{"state": 200, "info": "暂无数据"}';

  }else{

      $pageinfo = array(
          "page" => $page,
          "pageSize" => $pageSize,
          "totalPage" => $totalPage,
          "totalCount" => $totalCount
      );

      $info = array("list" => $list, "pageInfo" => $pageinfo);

      echo '{"state": 100, "info": '.json_encode($info).'}';
    }
    exit();
}


//验证模板文件
if(file_exists($tpl."/".$templates)){
    $jsFile = array(
        'shop/waimaiCommon.js'
    );
    $huoniaoTag->assign('jsFile', $jsFile);

    $huoniaoTag->assign('HUONIAOADMIN', HUONIAOADMIN);
    $huoniaoTag->assign('templets_skin', 'http://'.$cfg_basehost."/wmsj/templates/".(isMobile() ? "touch/" : ""));  //模块路径
    $huoniaoTag->display($templates);
}else{
    echo $templates."模板文件未找到！";
}