<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-18 12:42:31
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiOrderSearch.html" */ ?>
<?php /*%%SmartyHeaderCode:17017594604b78f7284-04424516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a93790d48c9fd75f530fb0d6476d8391d046f9cf' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiOrderSearch.html',
      1 => 1497597153,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17017594604b78f7284-04424516',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'shop' => 0,
    'l' => 0,
    'courier' => 0,
    'c' => 0,
    'comtime' => 0,
    't' => 0,
    'list' => 0,
    'food' => 0,
    'preset' => 0,
    'state' => 0,
    'pagelist' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594604b79e18b7_58881363',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594604b79e18b7_58881363')) {function content_594604b79e18b7_58881363($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>外卖订单</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<style>
.pagination {display: block; text-align: right;}
.pagination div {margin: 0;}
.pagination .page_info {display: inline-block; line-height: 35px; margin-left: 15px;}
.pagination ul>li.page_current span {background: #e8e8e8;}
.chzn-container {vertical-align: middle;}
.tab-content {overflow: visible;}
td hr {margin:5px 0;}


.col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {float: left;}
.col-sm-2 {width: 16.66666667%;}
.form-group {width:600px;float: left;margin:0 -12px 15px 0;}
.form-group select {width:216px;}

.resultiframe {width:100%;}
.resultiframe.fixheight {height: 1000px !important;min-height: 1000px !important;}
</style>
</head>

<body class="no-skin">
<div class="main-content">

  <div class="page-content">

    <?php if (empty($_smarty_tpl->tpl_vars['action']->value)) {?>
    <div class="page-content">
      <div class="page-content-area">
        <style>.col-sm-input{ width:60px; }</style>
        <div class="row">
          <div class="col-xs-12">
            <form class="form-horizontal searchform" id="yw0" action="" method="get" target="resultiframe">
              <input type="hidden" name="action" id="action" value="search">
              <div class="form-group">
                <label class="col-sm-2" for="waimaiOrder_trade_no">订单编号</label>
                <input name="ordernum" id="waimaiOrder_trade_no" type="text"></div>
              <div class="form-group">
                <label class="col-sm-2" for="waimaiOrder_lewaimai_customer_id">顾客ID</label>
                <input name="personId" id="waimaiOrder_lewaimai_customer_id" type="text" maxlength="10"></div>
              <div class="form-group">
                <label class="col-sm-2" for="waimaiOrder_nickname">姓名</label>
                <input name="person" id="waimaiOrder_nickname" type="text" maxlength="20"></div>
              <div class="form-group">
                <label class="col-sm-2" for="waimaiOrder_phone">电话</label>
                <input name="tel" id="waimaiOrder_phone" type="text" maxlength="20"></div>
              <div class="form-group">
                <label class="col-sm-2" for="waimaiOrder_init_date">下单时间</label>
                <input id="waimaiOrder_start_time" type="text" name="paydate[]"> 至
                <input id="waimaiOrder_end_time" type="text" name="paydate[]"></div>
              <div class="form-group" style="height:38px">
                <label class="col-sm-2" for="Order_courier_id">店铺</label>
                <select class="chosen-select" name="shopid" id="form-field-select-1">
                  <option value="">全部店铺</option>
                  <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shop']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
</option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="col-sm-2" for="Order_courier_id">配送员</label>
                <select class="chosen-select" name="peisongid" id="form-field-select-2">
                  <option value="">请选择</option>
                  <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['courier']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="col-sm-2" for="Order_charge_type">支付方式</label>
                <select class="chosen-select" name="paytype" id="form-field-select-3">
                  <option value="">请选择</option>
                  <option value="delivery">货到付款</option>
                  <option value="money">余额付款</option>
                  <option value="online">在线支付</option>
                </select>
              </div>
              <div class="form-group">
                <label class="col-sm-2" for="Order_order_status">订单状态</label>
                <select class="chosen-select" name="state" id="form-field-select-4">
                  <option value="">请选择</option>
                  <option value="2">未处理订单</option>
                  <option value="3">已确认订单</option>
                  <option value="4">已接单</option>
                  <option value="5">配送中</option>
                  <option value="1">成功</option>
                  <option value="7">失败</option>
                  <option value="6">已取消</option>
                </select>
              </div>
              <div class="form-group">
                <label class="col-sm-2" for="waimaiOrder_amount">订单金额</label>
                <input class="col-sm-input" type="number" name="amount[]" id="waimaiOrder_amount1" type="text">&nbsp;&nbsp;到&nbsp;&nbsp;
                <input class="col-sm-input" type="number" name="amount[]" id="waimaiOrder_amount2" type="text"> 元之间</div>
              <div class="form-group">
                <label class="col-sm-2" for="waimaiOrder_complete">完成时间</label>
                <select class="chosen-select" name="comtime" id="form-field-select-5">
                  <option value="">请选择</option>
                  <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comtime']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['t']->value;?>
</option>
                  <?php } ?>
                </select>
                分钟之内
              </div>
              <div style="clear:both;"></div>
              <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                  <button class="btn btn-info" type="submit">
                    <i class="ace-icon fa fa-check bigger-110"></i>搜索</button>&nbsp; &nbsp; &nbsp;
                  <button class="btn" type="reset" id="reset">
                    <i class="icon-undo bigger-110"></i>重置</button>&nbsp; &nbsp; &nbsp;
                  <button class="btn btn-danger" type="button" id="export_btn">导出</button>
                  <input type="hidden" value="0" name="is_export" id="lewaimaiorder_export">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <iframe src="" name="resultiframe" id="resultiframe" frameborder="0" class="resultiframe"></iframe>

    <?php } else { ?>

    <style>body{overflow-y: hidden;}.page-content {padding:8px 0 24px;}</style>
    <div class="page-content-area">
      <div class="col-xs-12">
        <div class="tabbable">

          <div id="order-grid-open" class="grid-view">
            <table id="list" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th class="checkbox-column" id="order-grid-open_c0"><input type="checkbox" value="1" name="order-grid-open_c0_all" id="order-grid-open_c0_all"></th>
                  <th id="order-grid-open_c1">订单编号</th>
                  <th id="order-grid-open_c2">店铺</th>
                  <th id="order-grid-open_c3">顾客ID</th>
                  <th id="order-grid-open_c4">姓名</th>
                  <th id="order-grid-open_c5">电话</th>
                  <th id="order-grid-open_c6">配送地址</th>
                  <th id="order-grid-open_c7">详情</th>
                  <th id="order-grid-open_c8">备注</th>
                  <th id="order-grid-open_c9">用户下单填写的预设字段值</th>
                  <th id="order-grid-open_c10">总价</th>
                  <th id="order-grid-open_c11">配送员</th>
                  <th id="order-grid-open_c15">系统备注</th>
                  <th id="order-grid-open_c11">订单状态</th>
                  <th id="order-grid-open_c12">失败原因</th>
                  <th id="order-grid-open_c13">下单时间</th>
                  <th id="order-grid-open_c16">完成时间</th>
                  <th id="order-grid-open_c17">完成速度（分钟）</th>
                  <th id="order-grid-open_c14">付款方式</th>
                  <th class="button-column" id="order-grid-open_c15">操作</th></tr>
              </thead>
              <tbody>
                <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                  <?php if ($_smarty_tpl->tpl_vars['l']->value['state']==1) {?>
                  <?php $_smarty_tpl->tpl_vars['state'] = new Smarty_variable('成功', null, 0);?>
                  <?php } elseif ($_smarty_tpl->tpl_vars['l']->value['state']=='2') {?>
                  <?php $_smarty_tpl->tpl_vars['state'] = new Smarty_variable('未处理', null, 0);?>
                  <?php } elseif ($_smarty_tpl->tpl_vars['l']->value['state']=='3') {?>
                  <?php $_smarty_tpl->tpl_vars['state'] = new Smarty_variable('已确认', null, 0);?>
                  <?php } elseif ($_smarty_tpl->tpl_vars['l']->value['state']=='4') {?>
                  <?php $_smarty_tpl->tpl_vars['state'] = new Smarty_variable('已接单', null, 0);?>
                  <?php } elseif ($_smarty_tpl->tpl_vars['l']->value['state']=='5') {?>
                  <?php $_smarty_tpl->tpl_vars['state'] = new Smarty_variable('配送中', null, 0);?>
                  <?php } elseif ($_smarty_tpl->tpl_vars['l']->value['state']=='6') {?>
                  <?php $_smarty_tpl->tpl_vars['state'] = new Smarty_variable('已取消', null, 0);?>
                  <?php } elseif ($_smarty_tpl->tpl_vars['l']->value['state']=='7') {?>
                  <?php $_smarty_tpl->tpl_vars['state'] = new Smarty_variable('失败', null, 0);?>
                  <?php }?>
                <tr>
                  <td width="30"><input value="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" id="order-grid-open_c0_0" type="checkbox" name="selectorderl[]"></td>
                  <td width="60"><?php if ($_smarty_tpl->tpl_vars['l']->value['ordernumstore']!='') {
echo $_smarty_tpl->tpl_vars['l']->value['shopname'];
echo $_smarty_tpl->tpl_vars['l']->value['ordernumstore'];
} else {
echo $_smarty_tpl->tpl_vars['l']->value['ordernum'];
}?></td>
                  <td width="70" style="word-break: break-all;"><?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
</td>
                  <td width="60"><a href="javascript:;" class="userinfo" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['uid'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['username'];?>
</a></td>
                  <td width="90"><?php echo $_smarty_tpl->tpl_vars['l']->value['person'];?>
</td>
                  <td width="90"><?php echo $_smarty_tpl->tpl_vars['l']->value['tel'];?>
</td>
                  <td style="word-break: break-all;" width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['address'];?>
</td>
                  <td width="120">
                    <?php  $_smarty_tpl->tpl_vars['food'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['food']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['l']->value['food']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['food']->key => $_smarty_tpl->tpl_vars['food']->value) {
$_smarty_tpl->tpl_vars['food']->_loop = true;
?>
                    <div style="background:#ddd;padding:1px;margin:3px 0px;"><?php echo $_smarty_tpl->tpl_vars['food']->value['title'];?>
【<?php echo $_smarty_tpl->tpl_vars['food']->value['count'];?>
】</div>
                    <?php } ?>
                  </td>
                  <td style="word-break: break-all;" width="80"><?php echo $_smarty_tpl->tpl_vars['l']->value['note'];?>
</td>
                  <td width="80" style="word-break: break-all;">
                    <?php  $_smarty_tpl->tpl_vars['preset'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['preset']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['l']->value['preset']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['preset']->key => $_smarty_tpl->tpl_vars['preset']->value) {
$_smarty_tpl->tpl_vars['preset']->_loop = true;
?>
                    <div style="background:#ddd;padding:1px;margin:3px 0px;"><?php echo $_smarty_tpl->tpl_vars['preset']->value['title'];?>
：<?php echo $_smarty_tpl->tpl_vars['preset']->value['value'];?>
</div>
                    <?php } ?>
                  </td>
                  <td width="50"><?php echo $_smarty_tpl->tpl_vars['l']->value['amount'];?>
</td>
                  <td width="100"><?php if ($_smarty_tpl->tpl_vars['l']->value['peisongname']) {
echo $_smarty_tpl->tpl_vars['l']->value['peisongname'];?>
(<?php echo $_smarty_tpl->tpl_vars['l']->value['peisongtel'];?>
)<?php } else { ?>-<?php }?></td>
                  <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['peisongidlog'];?>
</td>
                  <td width="100"><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</td>
                  <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['failed'];?>
</td>
                  <td width="40"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['pubdate'],"%y-%m-%d %H:%M:%S");?>
</td>
                  <td width="40"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['okdate'],"%y-%m-%d %H:%M:%S");?>
</td>
                  <td width="50"><?php if ($_smarty_tpl->tpl_vars['l']->value['state']=="1") {
echo ceil(($_smarty_tpl->tpl_vars['l']->value['okdate']-$_smarty_tpl->tpl_vars['l']->value['pubdate'])/60);
}?></td>
                  <td width="50"><b style="color:green"><?php echo $_smarty_tpl->tpl_vars['l']->value['paytype'];?>
</b></td>
                  <td width="80" class="button-column">
                    <a title="查看" class="green orderdetail" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" data-num="<?php echo $_smarty_tpl->tpl_vars['l']->value['ordernum'];?>
" style="padding-right:8px;" href="waimaiOrderDetail.php?id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"><i class="ace-icon fa fa-search bigger-130"></i></a>
                  </td>
                </tr>
                <?php } ?>

                <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                <tr>
                  <td colspan="20" style="height: 200px; line-height: 200px; text-align: center;">没有找到数据.</td>
                </tr>
                <?php }?>
              </tbody>
            </table>

            <?php echo $_smarty_tpl->tpl_vars['pagelist']->value;?>


          </div>

        </div>
      </div>
    </div>

    <?php }?>
  </div>
</div>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php if ($_smarty_tpl->tpl_vars['action']->value=="search") {?>
<?php echo '<script'; ?>
>
  $(function(){
    var conHeight = 0, timer = null, listen = false;
    setParIframeHeight();
    parent.winScroll();

    //查看订单
    $(".orderdetail").bind("click", function(event){
      event.preventDefault();
      var href = $(this).attr("href"), id = $(this).data("id"), num = $(this).data("num");
      try {
        parent.parent.addPage("waimaiOrderDetail"+id, "waimai", "订单"+num, "waimai/"+href);
      } catch(e) {}

    });

    $(window).resize(function(){
      if(!listen) return;
      clearTimeout(timer)
      timer = setTimeout(function(){
        setParIframeHeight();
      },1000)
    })

    function setParIframeHeight(){
      
      var h = parseInt($(".main-content").height());
      if(Math.abs(h-conHeight) < 50){
        conHeight = h;
        return;
      }
      conHeight = h;
      $('#resultiframe', window.parent.document).css('height', conHeight+'px');
      listen = true;
    }
  })
<?php echo '</script'; ?>
>
<?php }?>
<?php }} ?>
