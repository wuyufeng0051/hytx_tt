<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 10:13:13
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\payreturn.html" */ ?>
<?php /*%%SmartyHeaderCode:28877592401fb0bbb96-34045621%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f91e6ccbf2e6611f7b6100eff008ae34ca64f1d' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\payreturn.html',
      1 => 1495534325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28877592401fb0bbb96-34045621',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592401fb0ea9a3_64458039',
  'variables' => 
  array (
    'waimai_channelName' => 0,
    'waimai_channelDomain' => 0,
    'sid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592401fb0ea9a3_64458039')) {function content_592401fb0ea9a3_64458039($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['channelName'] = new Smarty_variable($_smarty_tpl->tpl_vars['waimai_channelName']->value, null, 0);?>
<?php $_smarty_tpl->tpl_vars['channelDomain'] = new Smarty_variable($_smarty_tpl->tpl_vars['waimai_channelDomain']->value, null, 0);?>
<?php $_smarty_tpl->tpl_vars['backUrl'] = new Smarty_variable("javascript:history.go(-1);", null, 0);?>
<?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("支付结果", null, 0);?>
<?php $_smarty_tpl->tpl_vars['service'] = new Smarty_variable("waimai", null, 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("../../member/touch/public-payreturn.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
    utils.removeStorage("wm_cart_<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
");
});
<?php echo '</script'; ?>
>
<?php }} ?>
