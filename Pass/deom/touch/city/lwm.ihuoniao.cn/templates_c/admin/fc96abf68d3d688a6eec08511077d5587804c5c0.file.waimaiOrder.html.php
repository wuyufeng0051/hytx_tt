<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 15:06:03
         compiled from "D:\ServerWwwroot\www.lwm.com\wmsj\templates\order\waimaiOrder.html" */ ?>
<?php /*%%SmartyHeaderCode:29160594b6c5b269ec2-76350717%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc96abf68d3d688a6eec08511077d5587804c5c0' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\wmsj\\templates\\order\\waimaiOrder.html',
      1 => 1498038475,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29160594b6c5b269ec2-76350717',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'adminPath' => 0,
    'state' => 0,
    'state2' => 0,
    'list' => 0,
    'l' => 0,
    'food' => 0,
    'preset' => 0,
    'pagelist' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b6c5b30a164_22710151',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b6c5b30a164_22710151')) {function content_594b6c5b30a164_22710151($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
?><?php $_smarty_tpl->tpl_vars['pageTitle'] = new Smarty_variable("订单管理", null, 0);?>
<?php $_smarty_tpl->tpl_vars['pageCurr'] = new Smarty_variable("order/waimaiOrder", null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("../_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<style>
.page-content-area {overflow: hidden;}
.pagination {display: block; text-align: right;}
.pagination div {margin: 0;}
.pagination .page_info {display: inline-block; line-height: 35px; margin-left: 15px;}
.pagination ul>li.page_current span {background: #e8e8e8;}
.chzn-container {vertical-align: middle;}
.tab-content {overflow: visible;}
td hr {margin:5px 0;}
.refundYes {color: red;font-weight: bold;}
.refundNo {color: green;font-weight: bold;}
.bgtxt {background:#ddd;padding:1px;margin:3px 0px;}
</style>

<div class="main-content">
  <div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
      <i class="ace-icon fa fa-bar-chart-o bar-chart-o-icon"></i>
      <li class="active">外卖订单</li>
      <li class="active">订单管理</li>
    </ul>

    <?php echo $_smarty_tpl->getSubTemplate ("../_uinfo.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


  </div>

  <div class="page-content">

    <div class="page-content-area">

      <div class="col-xs-12">
        <div class="tabbable">
          <ul class="nav nav-tabs" id="myTab">
            <li<?php if ($_smarty_tpl->tpl_vars['state']->value==2) {?> class="active"<?php }?>><a href="waimaiOrder.php?state=2">未处理订单<?php if ($_smarty_tpl->tpl_vars['state2']->value) {?><span class="badge badge-danger"><?php echo $_smarty_tpl->tpl_vars['state2']->value;?>
</span><?php }?></a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['state']->value==3) {?> class="active"<?php }?>><a href="waimaiOrder.php?state=3">已确认订单</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['state']->value==4) {?> class="active"<?php }?>><a href="waimaiOrder.php?state=4">已接单</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['state']->value==5) {?> class="active"<?php }?>><a href="waimaiOrder.php?state=5">配送中订单</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['state']->value==1) {?> class="active"<?php }?>><a href="waimaiOrder.php?state=1">成功订单</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['state']->value==7) {?> class="active"<?php }?>><a href="waimaiOrder.php?state=7">失败订单</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['state']->value==6) {?> class="active"<?php }?>><a href="waimaiOrder.php?state=6">已取消订单</a></li>
          </ul>
          <div class="tab-content">
  
              

            <div>
              <?php if ($_smarty_tpl->tpl_vars['state']->value==2) {?>
              <button class="btn btn-success" id="confirmObj">确认订单</button>
              <button class="btn btn-danger" id="failedObj">无效订单</button>
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['state']->value==3||$_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5) {?>
              <button class="btn btn-success" id="okObj">成功订单</button>
              <button class="btn btn-danger" id="failedObj">失败订单</button>
              
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['state']->value==1) {?>
              <button class="btn btn-warning" id="printObj">打印订单</button>
              <?php }?>
            </div>
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
                    <?php if ($_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5||$_smarty_tpl->tpl_vars['state']->value==1||$_smarty_tpl->tpl_vars['state']->value==6||$_smarty_tpl->tpl_vars['state']->value==7) {?>
                    <th id="order-grid-open_c11">配送员</th>
                      <?php if ($_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5) {?>
                    <th id="order-grid-open_c15">系统备注</th>
                      <?php }?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['state']->value==6||$_smarty_tpl->tpl_vars['state']->value==7) {?>
                    <th id="order-grid-open_c12">失败原因</th>
                    <th id="order-grid-open_c12">退款状态</th>
                    <?php }?>
                    <th id="order-grid-open_c13">下单时间</th>
                    <?php if ($_smarty_tpl->tpl_vars['state']->value==1) {?>
                    <th id="order-grid-open_c16">完成时间</th>
                    <th id="order-grid-open_c17">完成速度（分钟）</th>
                    <?php }?>
                    <th id="order-grid-open_c14">付款方式</th>
                    <th class="button-column" id="order-grid-open_c15">操作</th></tr>
                </thead>
                <tbody>
                  <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                  <tr data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
">
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
                    <?php if ($_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5||$_smarty_tpl->tpl_vars['state']->value==1||$_smarty_tpl->tpl_vars['state']->value==6||$_smarty_tpl->tpl_vars['state']->value==7) {?>
                    <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['peisongname'];?>
(<?php echo $_smarty_tpl->tpl_vars['l']->value['peisongtel'];?>
)</td>
                      <?php if ($_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5) {?>
                    <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['peisongidlog'];?>
</td>
                      <?php }?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['state']->value==6||$_smarty_tpl->tpl_vars['state']->value==7) {?>
                    <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['failed'];?>
</td>
                    <td width="100" class="refrundState">
                      <?php if ($_smarty_tpl->tpl_vars['l']->value['refrundstate']==1) {?>
                      <?php if ($_smarty_tpl->tpl_vars['l']->value['paytype']!='货到付款') {?>
                      <div class="refundYes">已退款</div>
                      <div class="bgtxt">退款状态：退款成功</div>
                      <div class="bgtxt">退款时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['refrunddate'],"%Y-%m-%d %H:%M:%S");?>
</div>
                      <div class="bgtxt">退款流水号：<?php echo $_smarty_tpl->tpl_vars['l']->value['refrundno'];?>
</div>
                      <div class="bgtxt">退款操作员帐号：<?php echo $_smarty_tpl->tpl_vars['l']->value['refrundadmin'];?>
</div>
                      <?php } else { ?>
                      <div class="refundNo">未退款</div>
                      <?php }?>
                      <?php } else { ?>
                      <div class="refundNo">未退款</div>
                      <?php }?>
                    </td>
                    <?php }?>
                    <td width="40"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['pubdate'],"%y-%m-%d %H:%M:%S");?>
</td>
                    <?php if ($_smarty_tpl->tpl_vars['state']->value==1) {?>
                    <td width="40"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['okdate'],"%y-%m-%d %H:%M:%S");?>
</td>
                    <td width="50"><?php echo ceil(($_smarty_tpl->tpl_vars['l']->value['okdate']-$_smarty_tpl->tpl_vars['l']->value['pubdate'])/60);?>
</td>
                    <?php }?>
                    <td width="50"><b style="color:green"><?php echo $_smarty_tpl->tpl_vars['l']->value['paytype'];?>
</b></td>
                    <td width="80" class="button-column">
                      <a title="查看" class="green orderdetail" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" data-num="<?php echo $_smarty_tpl->tpl_vars['l']->value['ordernum'];?>
" style="padding-right:8px;" href="waimaiOrderDetail.php?id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"><i class="ace-icon fa fa-search bigger-130"></i></a>
                      <?php if ($_smarty_tpl->tpl_vars['state']->value==7&&$_smarty_tpl->tpl_vars['l']->value['refrundstate']==0&&$_smarty_tpl->tpl_vars['l']->value['amount']>0&&$_smarty_tpl->tpl_vars['l']->value['paytype']!='货到付款') {?><br><a class="label label-sm label-danger refund" href="javascript:;">退款</a><?php }?>
                    </td>
                  </tr>
                  <?php } ?>

                  <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                  <tr>
                    <td colspan="<?php if ($_smarty_tpl->tpl_vars['state']->value==1||$_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5) {
if ($_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5) {?>16<?php } else { ?>17<?php }
} elseif ($_smarty_tpl->tpl_vars['state']->value==7) {?>16<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==6) {?>16<?php } else { ?>14<?php }?>" style="height: 200px; line-height: 200px; text-align: center;">没有找到数据.</td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>

              <?php echo $_smarty_tpl->tpl_vars['pagelist']->value;?>


            </div>
          </div>
        </div>
      </div>

    </div>
    </div>
  </div>

  <?php echo $_smarty_tpl->getSubTemplate ("../_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('jsFile'=>$_smarty_tpl->tpl_vars['jsFile']->value), 0);?>


<?php }} ?>
