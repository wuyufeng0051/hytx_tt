<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-18 12:04:36
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiOrderDetail.html" */ ?>
<?php /*%%SmartyHeaderCode:20703592666ceb3d0e5-37017032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b3bcbd1c6a21e6a42adf6aefc25fcedbc999a71' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiOrderDetail.html',
      1 => 1497758674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20703592666ceb3d0e5-37017032',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592666ceb5c4f3_33244393',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'ordernum' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'id' => 0,
    'state' => 0,
    'ordernumstore' => 0,
    'shopname' => 0,
    'uid' => 0,
    'username' => 0,
    'person' => 0,
    'tel' => 0,
    'address' => 0,
    'food' => 0,
    'f' => 0,
    'note' => 0,
    'preset' => 0,
    'p' => 0,
    'priceinfo' => 0,
    'amount' => 0,
    'paytype' => 0,
    'peisong' => 0,
    'pubdate' => 0,
    'paydate' => 0,
    'confirmdate' => 0,
    'peidate' => 0,
    'songdate' => 0,
    'okdate' => 0,
    'failed' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592666ceb5c4f3_33244393')) {function content_592666ceb5c4f3_33244393($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title><?php echo $_smarty_tpl->tpl_vars['ordernum']->value;?>
-外卖订单</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", id = <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;
<?php echo '</script'; ?>
>
</head>

<body class="no-skin">
<div class="main-content">

  <div class="page-content">

      <div class="page-content-area" id="list">
        <style>.detail-view tr { height:30px; line-height:30px; } td { width: 80px; }</style>
        <div style="width: 50%;">
          <div class="col-xs-12 col-sm-6 ui-sortable">

            <?php if ($_smarty_tpl->tpl_vars['state']->value==2) {?>
            <button class="btn btn-success" id="confirmObj">确认订单</button>
            <button class="btn btn-danger" id="failedObj">无效订单</button>
            <?php } elseif ($_smarty_tpl->tpl_vars['state']->value==3||$_smarty_tpl->tpl_vars['state']->value==4||$_smarty_tpl->tpl_vars['state']->value==5) {?>
            <button class="btn btn-success" id="okObj">成功订单</button>
            <button class="btn btn-danger" id="failedObj">失败订单</button>
            <button class="btn btn-warning" id="printObj">打印订单</button>
            <?php } elseif ($_smarty_tpl->tpl_vars['state']->value==1) {?>
            <button class="btn btn-warning" id="printObj">打印订单</button>
            <?php }?>

            <div class="widget-box">
              <div class="widget-header header-color-blue">
                <h5 class="bigger lighter">
                  <i class="icon-table"></i>订单详情</h5>
              </div>
              <div class="widget-body">
                <div class="widget-main no-padding">
                  <table class="table table-striped table-bordered table-hover">
                    <tbody>
                      <tr>
                        <td>订单编号</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['ordernumstore']->value!='') {
echo ($_smarty_tpl->tpl_vars['shopname']->value).($_smarty_tpl->tpl_vars['ordernumstore']->value);
} else {
echo $_smarty_tpl->tpl_vars['ordernum']->value;
}?></td>
                      </tr>
                      <tr>
                        <td>店铺</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['shopname']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>顾客ID</td>
                        <td><a href="javascript:;" class="userinfo" data-id="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a></td>
                      </tr>
                      <tr>
                        <td>姓名</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['person']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>电话</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['tel']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>配送地址</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['address']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>详情</td>
                        <td>
                            <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['food']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                            <?php echo $_smarty_tpl->tpl_vars['f']->value['title'];?>
 【<?php echo $_smarty_tpl->tpl_vars['f']->value['count'];?>
】 &yen;<?php echo $_smarty_tpl->tpl_vars['f']->value['price']*$_smarty_tpl->tpl_vars['f']->value['count'];?>
<br />
                            <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>备注</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>预设字段</td>
                        <td>
                            <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['preset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                            <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
：<?php echo $_smarty_tpl->tpl_vars['p']->value['value'];?>
<br />
                            <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>费用详细</td>
                        <td>
                            <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['priceinfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                            <?php echo $_smarty_tpl->tpl_vars['p']->value['body'];?>
：<?php if ($_smarty_tpl->tpl_vars['p']->value['type']=="youhui"||$_smarty_tpl->tpl_vars['p']->value['type']=="manjian"||$_smarty_tpl->tpl_vars['p']->value['type']=="shoudan") {?>-<?php }
echo $_smarty_tpl->tpl_vars['p']->value['amount'];?>
<br />
                            <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>总价</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>付款方式</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['paytype']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>配送员</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['peisong']->value;?>
</td>
                      </tr>
                      <tr>
                        <td>下单时间</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['pubdate']->value) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['pubdate']->value,"%Y-%m-%d %H:%M:%S");
}?></td>
                      </tr>
                      <tr>
                        <td>付款时间</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['paydate']->value) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['paydate']->value,"%Y-%m-%d %H:%M:%S");
}?></td>
                      </tr>
                      <tr>
                        <td>确认时间</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['confirmdate']->value) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['confirmdate']->value,"%Y-%m-%d %H:%M:%S");
}?></td>
                      </tr>
                      <tr>
                        <td>接单时间</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['peidate']->value) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['peidate']->value,"%Y-%m-%d %H:%M:%S");
}?></td>
                      </tr>
                      <tr>
                        <td>配送时间</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['songdate']->value) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['songdate']->value,"%Y-%m-%d %H:%M:%S");
}?></td>
                      </tr>
                      <tr>
                        <td>完成时间</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['okdate']->value) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['okdate']->value,"%Y-%m-%d %H:%M:%S");
}?></td>
                      </tr>
                      <tr>
                        <td>完成速度（分钟）</td>
                        <td><?php if ($_smarty_tpl->tpl_vars['okdate']->value) {
echo ceil(($_smarty_tpl->tpl_vars['okdate']->value-$_smarty_tpl->tpl_vars['pubdate']->value)/60);
}?></td>
                      </tr>
                      <tr>
                        <td>订单状态</td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['state']->value==0) {?>
            				未付款
            				<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==1) {?>
            				完成
            				<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==2) {?>
            				待确认
            				<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==3) {?>
            				待配送
            				<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==4) {?>
            				已接单
            				<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==5) {?>
            				配送中
            				<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==6) {?>
            				取消支付
            				<?php } elseif ($_smarty_tpl->tpl_vars['state']->value==7) {?>
            				交易失败
            				<?php }?>
                        </td>
                      </tr>
                      <?php if ($_smarty_tpl->tpl_vars['state']->value==6||$_smarty_tpl->tpl_vars['state']->value==7) {?>
                      <tr>
                        <td>失败原因</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['failed']->value;?>
</td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>
</div>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
