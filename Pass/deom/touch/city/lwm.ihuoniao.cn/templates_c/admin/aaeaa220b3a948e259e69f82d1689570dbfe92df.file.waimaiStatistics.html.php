<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-19 15:16:24
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiStatistics.html" */ ?>
<?php /*%%SmartyHeaderCode:24259594602c5ca2b99-26667705%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aaeaa220b3a948e259e69f82d1689570dbfe92df' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiStatistics.html',
      1 => 1497856129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24259594602c5ca2b99-26667705',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594602c5cd19a0_33085838',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'lastMonthDate' => 0,
    'nowDate' => 0,
    'shopArr' => 0,
    'shop' => 0,
    'shop_id' => 0,
    'dataArr' => 0,
    'total' => 0,
    'data' => 0,
    'delivery' => 0,
    'money' => 0,
    'online' => 0,
    'dabao' => 0,
    'peisong' => 0,
    'fuwu' => 0,
    'shoudan' => 0,
    'success' => 0,
    'courierArr' => 0,
    'courier' => 0,
    'courier_id' => 0,
    'totalSuccess' => 0,
    'totalFailed' => 0,
    'business' => 0,
    'platform' => 0,
    'turnover' => 0,
    'foodTotalPrice' => 0,
    'peisongTotalPrice' => 0,
    'dabaoTotalPrice' => 0,
    'addserviceTotalPrice' => 0,
    'discountTotalPrice' => 0,
    'promotionTotalPrice' => 0,
    'firstdiscountTotalPrice' => 0,
    'jsFile' => 0,
    'timeArr' => 0,
    'priceArr' => 0,
    'failedArr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594602c5cd19a0_33085838')) {function content_594602c5cd19a0_33085838($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>外卖统计</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<style media="screen">
.tab-content {overflow: visible;}
</style>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

      <div class="">
        <div class="col-sm-12">
          <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
              <li<?php if ($_smarty_tpl->tpl_vars['action']->value=="chartrevenue") {?> class="active"<?php }?>><a href="?action=chartrevenue">外卖营业额统计</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['action']->value=="chartorder") {?> class="active"<?php }?>><a href="?action=chartorder">订单按天统计</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['action']->value=="chartordertime") {?> class="active"<?php }?>><a href="?action=chartordertime">订单按时间段统计</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['action']->value=="chartcourier") {?> class="active"<?php }?>><a href="?action=chartcourier">配送员统计</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['action']->value=="financenew") {?> class="active"<?php }?>><a href="?action=financenew">财务结算</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">

                <?php if ($_smarty_tpl->tpl_vars['action']->value=="chartrevenue") {?>
                <div class="widget-box">
                  <div class="widget-header"><h5>营业额统计-条件选择</h5></div>
                  <div class="widget-body" style="padding:20px;">
                      <form id="exportorder-form" class="clearfix">
                        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
                        <label>统计时间段</label>
                        <input id="beginDate" type="text" class="chooseDate" value="<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
" name="beginDate" />至
                        <input id="endDate" type="text" class="chooseDate" value="<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
" name="endDate" />
                        <br />
                        <br />
                        <label>选择店铺
                          <br>
                          <select class="chosen-select" name="shop_id" id="shop_id">
                            <option value="0">全部店铺</option>
                            <?php  $_smarty_tpl->tpl_vars['shop'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['shop']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shopArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->key => $_smarty_tpl->tpl_vars['shop']->value) {
$_smarty_tpl->tpl_vars['shop']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['shop']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['shop_id']->value==$_smarty_tpl->tpl_vars['shop']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['shop']->value['shopname'];?>
</option>
                            <?php } ?>
                          </select>
                        </label>
                        <br />
                        <div class="span12" style="margin-left: 0;"><button type="submit" class="btn btn-success">查看统计</button></div>
                      </form>
                    </div>
                </div>
                <div class="widget-box" style="margin-top: 20px;">
                  <div class="widget-header">
                    <h5>统计图</h5></div>
                  <div class="widget-body" style="padding:20px;">
                    <div id="chartscontainer"></div>
                  </div>
                </div>
                <div class="">
                  <div class="col-xs-10">
                    <div id="shopList" class="grid-view">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th id="shopList_c0">时间</th>
                            <th id="shopList_c1">总营业额</th>
                            <th id="shopList_c2">货到付款</th>
                            <th id="shopList_c3">余额支付</th>
                            <th id="shopList_c4">在线支付</th>
                            <th id="shopList_c5">餐盒费</th>
                            <th id="shopList_c6">配送费</th>
                            <th id="shopList_c7">增值服务费统计</th>
                            <th id="shopList_c9">首单立减总金额</th></tr>
                        </thead>
                        <tbody>
                          <?php $_smarty_tpl->tpl_vars['total'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['dabao'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['peisong'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['fuwu'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['shoudan'] = new Smarty_variable(0, null, 0);?>

                          <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dataArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
                          <?php $_smarty_tpl->tpl_vars['total'] = new Smarty_variable($_smarty_tpl->tpl_vars['total']->value+$_smarty_tpl->tpl_vars['data']->value['total'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable($_smarty_tpl->tpl_vars['delivery']->value+$_smarty_tpl->tpl_vars['data']->value['delivery'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable($_smarty_tpl->tpl_vars['money']->value+$_smarty_tpl->tpl_vars['data']->value['money'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable($_smarty_tpl->tpl_vars['online']->value+$_smarty_tpl->tpl_vars['data']->value['online'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['dabao'] = new Smarty_variable($_smarty_tpl->tpl_vars['dabao']->value+$_smarty_tpl->tpl_vars['data']->value['dabao'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['peisong'] = new Smarty_variable($_smarty_tpl->tpl_vars['peisong']->value+$_smarty_tpl->tpl_vars['data']->value['peisong'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['fuwu'] = new Smarty_variable($_smarty_tpl->tpl_vars['fuwu']->value+$_smarty_tpl->tpl_vars['data']->value['fuwu'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['shoudan'] = new Smarty_variable($_smarty_tpl->tpl_vars['shoudan']->value+$_smarty_tpl->tpl_vars['data']->value['shoudan'], null, 0);?>
                          <tr>
                            <td style="width: 120px"><?php echo $_smarty_tpl->tpl_vars['data']->value['date'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['total'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['delivery'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['money'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['online'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['dabao'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['peisong'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['fuwu'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['shoudan'];?>
</td>
                          </tr>
                          <?php } ?>
                          <tr>
                              <td style="width: 120px">总计</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['delivery']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['money']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['online']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['dabao']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['peisong']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['fuwu']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['shoudan']->value);?>
</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <a class="btn btn-success" href="?action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
&do=export&shop_id=<?php echo $_smarty_tpl->tpl_vars['shop_id']->value;?>
&beginDate=<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
">导出成excel</a></div>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['action']->value=="chartorder") {?>
                <div class="widget-box">
                  <div class="widget-header"><h5>订单统计-条件选择</h5></div>
                  <div class="widget-body" style="padding:20px;">
                      <form id="exportorder-form" class="clearfix">
                        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
                        <label>统计时间段</label>
                        <input id="beginDate" type="text" class="chooseDate" value="<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
" name="beginDate" />至
                        <input id="endDate" type="text" class="chooseDate" value="<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
" name="endDate" />
                        <br />
                        <br />
                        <label>选择店铺
                          <br>
                          <select class="chosen-select" name="shop_id" id="shop_id">
                            <option value="0">全部店铺</option>
                            <?php  $_smarty_tpl->tpl_vars['shop'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['shop']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shopArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->key => $_smarty_tpl->tpl_vars['shop']->value) {
$_smarty_tpl->tpl_vars['shop']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['shop']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['shop_id']->value==$_smarty_tpl->tpl_vars['shop']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['shop']->value['shopname'];?>
</option>
                            <?php } ?>
                          </select>
                        </label>
                        <br />
                        <div class="span12" style="margin-left: 0;"><button type="submit" class="btn btn-success">查看统计</button></div>
                      </form>
                    </div>
                </div>
                <div class="widget-box" style="margin-top: 20px;">
                  <div class="widget-header">
                    <h5>统计图</h5></div>
                  <div class="widget-body" style="padding:20px;">
                    <div id="chartscontainer"></div>
                  </div>
                </div>
                <div class="">
                  <div class="col-xs-10">
                    <div id="shopList" class="grid-view">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th id="shopList_c0">时间</th>
                            <th id="shopList_c1">成功订单数</th>
                            <th id="shopList_c2">货到付款成功订单数</th>
                            <th id="shopList_c3">余额付款成功订单数</th>
                            <th id="shopList_c4">在线支付成功订单数</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $_smarty_tpl->tpl_vars['success'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable(0, null, 0);?>

                          <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dataArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
                          <?php $_smarty_tpl->tpl_vars['success'] = new Smarty_variable($_smarty_tpl->tpl_vars['success']->value+$_smarty_tpl->tpl_vars['data']->value['success'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable($_smarty_tpl->tpl_vars['delivery']->value+$_smarty_tpl->tpl_vars['data']->value['delivery'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable($_smarty_tpl->tpl_vars['money']->value+$_smarty_tpl->tpl_vars['data']->value['money'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable($_smarty_tpl->tpl_vars['online']->value+$_smarty_tpl->tpl_vars['data']->value['online'], null, 0);?>
                          <tr>
                            <td style="width: 120px"><?php echo $_smarty_tpl->tpl_vars['data']->value['date'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['success'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['delivery'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['money'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['online'];?>
</td>
                          </tr>
                          <?php } ?>
                          <tr>
                              <td style="width: 120px">总计</td>
                              <td><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
</td>
                              <td><?php echo $_smarty_tpl->tpl_vars['delivery']->value;?>
</td>
                              <td><?php echo $_smarty_tpl->tpl_vars['money']->value;?>
</td>
                              <td><?php echo $_smarty_tpl->tpl_vars['online']->value;?>
</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <a class="btn btn-success" href="?action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
&do=export&shop_id=<?php echo $_smarty_tpl->tpl_vars['shop_id']->value;?>
&beginDate=<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
">导出成excel</a></div>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['action']->value=="chartordertime") {?>
                <div class="widget-box">
                  <div class="widget-header"><h5>订单统计-条件选择</h5></div>
                  <div class="widget-body" style="padding:20px;">
                      <form id="exportorder-form" class="clearfix">
                        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
                        <label>统计时间段</label>
                        <input id="beginDate" type="text" class="chooseDateTime" value="<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
" name="beginDate" />至
                        <input id="endDate" type="text" class="chooseDateTime" value="<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
" name="endDate" />
                        <br />
                        <br />
                        <label>选择店铺
                          <br>
                          <select class="chosen-select" name="shop_id" id="shop_id">
                            <option value="0">全部店铺</option>
                            <?php  $_smarty_tpl->tpl_vars['shop'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['shop']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shopArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->key => $_smarty_tpl->tpl_vars['shop']->value) {
$_smarty_tpl->tpl_vars['shop']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['shop']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['shop_id']->value==$_smarty_tpl->tpl_vars['shop']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['shop']->value['shopname'];?>
</option>
                            <?php } ?>
                          </select>
                        </label>
                        <br />
                        <div class="span12" style="margin-left: 0;"><button type="submit" class="btn btn-success">查看统计</button></div>
                      </form>
                    </div>
                </div>
                <div class="">
                  <div class="col-xs-10">
                    <div id="shopList" class="grid-view">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th id="shopList_c0">时间段</th>
                            <th id="shopList_c1">成功订单数</th>
                            <th id="shopList_c2">货到付款成功订单数</th>
                            <th id="shopList_c3">余额付款成功订单数</th>
                            <th id="shopList_c4">在线支付成功订单数</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="width: 300px"><?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
 至 <?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['dataArr']->value[0]['success'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['dataArr']->value[0]['delivery'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['dataArr']->value[0]['money'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['dataArr']->value[0]['online'];?>
</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['action']->value=="chartcourier") {?>
                <div class="widget-box">
                  <div class="widget-header"><h5>配送员统计-条件选择</h5></div>
                  <div class="widget-body" style="padding:20px;">
                      <form id="exportorder-form" class="clearfix">
                        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
                        <label>统计时间段</label>
                        <input id="beginDate" type="text" class="chooseDateTime" value="<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
" name="beginDate" />至
                        <input id="endDate" type="text" class="chooseDateTime" value="<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
" name="endDate" />
                        <br />
                        <br />
                        <label>选择配送员
                          <br>
                          <select class="chosen-select" name="courier_id" id="courier_id">
                            <option value="0">全部</option>
                            <?php  $_smarty_tpl->tpl_vars['courier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['courier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['courierArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['courier']->key => $_smarty_tpl->tpl_vars['courier']->value) {
$_smarty_tpl->tpl_vars['courier']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['courier']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['courier_id']->value==$_smarty_tpl->tpl_vars['courier']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['courier']->value['name'];?>
</option>
                            <?php } ?>
                          </select>
                        </label>
                        <br />
                        <div class="span12" style="margin-left: 0;"><button type="submit" class="btn btn-success">查看统计</button></div>
                      </form>
                    </div>
                </div>
                <div class="widget-box" style="margin-top: 20px;">
                  <div class="widget-header">
                    <h5>统计图</h5></div>
                  <div class="widget-body" style="padding:20px;">
                    <div id="chartscontainer"></div>
                  </div>
                </div>
                <div class="">
                  <div class="col-xs-10">
                    <div id="shopList" class="grid-view">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th id="shopList_c0">配送员</th>
                            <th id="shopList_c2">配送成功</th>
                            <th id="shopList_c3">配送失败</th>
                            <th id="shopList_c4">配送费</th>
                            <th id="shopList_c5">增值服务费</th>
                            <th id="shopList_c6">配送成功总金额</th>
                            <th id="shopList_c7">货到付款总金额</th>
                            <th id="shopList_c8">余额付款总金额</th>
                            <th id="shopList_c9">在线支付总金额</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $_smarty_tpl->tpl_vars['totalSuccess'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['totalFailed'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['peisong'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['fuwu'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['success'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable(0, null, 0);?>

                          <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dataArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>

                          <?php $_smarty_tpl->tpl_vars['totalSuccess'] = new Smarty_variable($_smarty_tpl->tpl_vars['totalSuccess']->value+$_smarty_tpl->tpl_vars['data']->value['totalSuccess'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['totalFailed'] = new Smarty_variable($_smarty_tpl->tpl_vars['totalFailed']->value+$_smarty_tpl->tpl_vars['data']->value['totalFailed'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['peisong'] = new Smarty_variable($_smarty_tpl->tpl_vars['peisong']->value+$_smarty_tpl->tpl_vars['data']->value['peisong'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['fuwu'] = new Smarty_variable($_smarty_tpl->tpl_vars['fuwu']->value+$_smarty_tpl->tpl_vars['data']->value['fuwu'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['success'] = new Smarty_variable($_smarty_tpl->tpl_vars['success']->value+$_smarty_tpl->tpl_vars['data']->value['success'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable($_smarty_tpl->tpl_vars['delivery']->value+$_smarty_tpl->tpl_vars['data']->value['delivery'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable($_smarty_tpl->tpl_vars['money']->value+$_smarty_tpl->tpl_vars['data']->value['money'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable($_smarty_tpl->tpl_vars['online']->value+$_smarty_tpl->tpl_vars['data']->value['online'], null, 0);?>
                          <tr>
                            <td style="width: 120px"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['totalSuccess'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['totalFailed'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['peisong'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['fuwu'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['success'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['delivery'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['money'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['online'];?>
</td>
                          </tr>
                          <?php } ?>
                          <tr>
                              <td style="width: 120px">总计</td>
                              <td><?php echo $_smarty_tpl->tpl_vars['totalSuccess']->value;?>
</td>
                              <td><?php echo $_smarty_tpl->tpl_vars['totalFailed']->value;?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['peisong']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['fuwu']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['success']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['delivery']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['money']->value);?>
</td>
                              <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['online']->value);?>
</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <a class="btn btn-success" href="?action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
&do=export&courier_id=<?php echo $_smarty_tpl->tpl_vars['courier_id']->value;?>
&beginDate=<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
">导出成excel</a></div>
                </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['action']->value=="financenew") {?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">×</a>
        			<p><strong>总交易额：</strong><br />商品总额 - 折扣优惠 - 满减优惠 - 首单减免 + 打包费 + 配送费 + 增值服务费<br /><br /><strong>平台应得金额：</strong><br />商品总额 * 提成比例 - 折扣优惠 * 提成比例 - 满减优惠 * 提成比例 - 首单减免 * 提成比例 + 打包费 * 提成比例 + 配送费 * 提成比例 + 增值服务费 * 提成比例<br /><br />注：每项的提成比例请到店铺信息中查看！</p>
           		</div>
                <div class="widget-box">
                  <div class="widget-header"><h5>财务结算-条件选择</h5></div>
                  <div class="widget-body" style="padding:20px;">
                      <form id="exportorder-form" class="clearfix">
                        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
                        <label>统计时间段</label>
                        <input id="beginDate" type="text" class="chooseDate" value="<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
" name="beginDate" />至
                        <input id="endDate" type="text" class="chooseDate" value="<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
" name="endDate" />
                        <br />
                        <br />
                        <div class="span12" style="margin-left: 0;"><button type="submit" class="btn btn-success">查看统计</button></div>
                      </form>
                    </div>
                </div>
                <div class="">
                  <div class="col-xs-10">
                    <div id="shopList" class="grid-view">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th id="shopList_c0">店铺名</th>
                            <th id="shopList_c1">商家应得金额</th>
                            <th id="shopList_c2">平台应得金额</th>
                            <th id="shopList_c3">总交易额</th>
                            <th id="shopList_c4">货到付款交易额</th>
                            <th id="shopList_c5">余额付款交易额</th>
                            <th id="shopList_c6">在线支付交易额</th>
                            <th id="shopList_c7">商品原价总额</th>
                            <th id="shopList_c8">配送费总额</th>
                            <th id="shopList_c9">打包费总额</th>
                            <th id="shopList_c10">增值服务费总额</th>
                            <th id="shopList_c11">折扣优惠总额</th>
                            <th id="shopList_c12">满减优惠</th>
                            <th id="shopList_c13">首次下单减免总额</th>
                          </tr>
                          <tr class="filters">
                            <td><input id="shopname" type="text" maxlength="20" /></td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $_smarty_tpl->tpl_vars['business'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['platform'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['turnover'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['foodTotalPrice'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['peisongTotalPrice'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['dabaoTotalPrice'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['addserviceTotalPrice'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['discountTotalPrice'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['promotionTotalPrice'] = new Smarty_variable(0, null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['firstdiscountTotalPrice'] = new Smarty_variable(0, null, 0);?>

                          <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dataArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>

                          <?php $_smarty_tpl->tpl_vars['business'] = new Smarty_variable($_smarty_tpl->tpl_vars['business']->value+$_smarty_tpl->tpl_vars['data']->value['business'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['platform'] = new Smarty_variable($_smarty_tpl->tpl_vars['platform']->value+$_smarty_tpl->tpl_vars['data']->value['platform'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['turnover'] = new Smarty_variable($_smarty_tpl->tpl_vars['turnover']->value+$_smarty_tpl->tpl_vars['data']->value['turnover'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['delivery'] = new Smarty_variable($_smarty_tpl->tpl_vars['delivery']->value+$_smarty_tpl->tpl_vars['data']->value['delivery'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['money'] = new Smarty_variable($_smarty_tpl->tpl_vars['money']->value+$_smarty_tpl->tpl_vars['data']->value['money'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['online'] = new Smarty_variable($_smarty_tpl->tpl_vars['online']->value+$_smarty_tpl->tpl_vars['data']->value['online'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['foodTotalPrice'] = new Smarty_variable($_smarty_tpl->tpl_vars['foodTotalPrice']->value+$_smarty_tpl->tpl_vars['data']->value['foodTotalPrice'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['peisongTotalPrice'] = new Smarty_variable($_smarty_tpl->tpl_vars['peisongTotalPrice']->value+$_smarty_tpl->tpl_vars['data']->value['peisongTotalPrice'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['dabaoTotalPrice'] = new Smarty_variable($_smarty_tpl->tpl_vars['dabaoTotalPrice']->value+$_smarty_tpl->tpl_vars['data']->value['dabaoTotalPrice'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['addserviceTotalPrice'] = new Smarty_variable($_smarty_tpl->tpl_vars['addserviceTotalPrice']->value+$_smarty_tpl->tpl_vars['data']->value['addserviceTotalPrice'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['discountTotalPrice'] = new Smarty_variable($_smarty_tpl->tpl_vars['discountTotalPrice']->value+$_smarty_tpl->tpl_vars['data']->value['discountTotalPrice'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['promotionTotalPrice'] = new Smarty_variable($_smarty_tpl->tpl_vars['promotionTotalPrice']->value+$_smarty_tpl->tpl_vars['data']->value['promotionTotalPrice'], null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['firstdiscountTotalPrice'] = new Smarty_variable($_smarty_tpl->tpl_vars['firstdiscountTotalPrice']->value+$_smarty_tpl->tpl_vars['data']->value['firstdiscountTotalPrice'], null, 0);?>
                          <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['shopname'];?>
</td>
                            <td style="font-weight: 700; color: green;"><?php echo $_smarty_tpl->tpl_vars['data']->value['business'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['platform'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['turnover'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['delivery'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['money'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['online'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['foodTotalPrice'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['peisongTotalPrice'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['dabaoTotalPrice'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['addserviceTotalPrice'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['discountTotalPrice'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['promotionTotalPrice'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['firstdiscountTotalPrice'];?>
</td>
                          </tr>
                          <?php } ?>

                          <tr>
                            <td>总计</td>
                            <td style="font-weight: 700; color: green;"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['business']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['platform']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['turnover']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['delivery']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['money']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['online']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['foodTotalPrice']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['peisongTotalPrice']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['dabaoTotalPrice']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['addserviceTotalPrice']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['discountTotalPrice']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['promotionTotalPrice']->value);?>
</td>
                            <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['firstdiscountTotalPrice']->value);?>
</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <a class="btn btn-success" href="?action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
&do=export&beginDate=<?php echo $_smarty_tpl->tpl_vars['lastMonthDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['nowDate']->value;?>
">导出成excel</a></div>
                </div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>


<?php if ($_smarty_tpl->tpl_vars['action']->value=="chartrevenue") {?>
<?php echo '<script'; ?>
>$(function() {
    $('#chartscontainer').highcharts({
      title: {
        text: '营业额统计',
        x: -20 //center
      },
      xAxis: {
        categories: <?php echo $_smarty_tpl->tpl_vars['timeArr']->value;?>
,
        labels: {
          step: 3,
        }
      },
      yAxis: {
        title: {
          text: '营业额（元）'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      tooltip: {
        valueSuffix: '元'
      },
      series: [{
        name: '营业额',
        data: <?php echo $_smarty_tpl->tpl_vars['priceArr']->value;?>

      }]
    });
  });
<?php echo '</script'; ?>
>
<?php } elseif ($_smarty_tpl->tpl_vars['action']->value=="chartorder") {?>
<?php echo '<script'; ?>
>$(function() {
    $('#chartscontainer').highcharts({
      title: {
        text: '订单统计',
        x: -20 //center
      },
      xAxis: {
        categories: <?php echo $_smarty_tpl->tpl_vars['timeArr']->value;?>
,
        labels: {
          step: 3,
        }
      },
      yAxis: {
        title: {
          text: '订单数（笔）'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      tooltip: {
        valueSuffix: '笔'
      },
      series: [{
        name: '成功订单',
        data: <?php echo $_smarty_tpl->tpl_vars['priceArr']->value;?>

      }]
    });
  });
<?php echo '</script'; ?>
>
<?php } elseif ($_smarty_tpl->tpl_vars['action']->value=="chartcourier") {?>
<?php echo '<script'; ?>
>$(function() {
    $('#chartscontainer').highcharts({
      title: {
        text: '配送员统计',
        x: -20 //center
      },
      xAxis: {
        categories: <?php echo $_smarty_tpl->tpl_vars['timeArr']->value;?>
,
        labels: {
          step: 3,
        }
      },
      yAxis: {
        title: {
          text: '配送数（件）'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      tooltip: {
        valueSuffix: '件'
      },
      series: [{
        name: '配送成功',
        data: <?php echo $_smarty_tpl->tpl_vars['priceArr']->value;?>

    },{
      name: '配送失败',
      data: <?php echo $_smarty_tpl->tpl_vars['failedArr']->value;?>

    }]
    });
  });
<?php echo '</script'; ?>
>
<?php } elseif ($_smarty_tpl->tpl_vars['action']->value=="financenew") {?>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
    //搜索回车提交
    $("#shopname").keyup(function (e) {
        if (!e) {
            var e = window.event;
        }
        if (e.keyCode) {
            code = e.keyCode;
        }
        else if (e.which) {
            code = e.which;
        }
        if (code === 13) {

            var shopname = $.trim($(this).val());
            if(shopname){
                $("#shopList tbody").find("tr").each(function(){
                    var name = $(this).find("td:eq(0)").text();
                    if(name.indexOf(shopname) < 0){
                        $(this).hide();
                    }
                });
            }else{
                $("#shopList tbody tr").show();
            }

        }
    });
});
<?php echo '</script'; ?>
>
<?php }?>
<?php }} ?>
