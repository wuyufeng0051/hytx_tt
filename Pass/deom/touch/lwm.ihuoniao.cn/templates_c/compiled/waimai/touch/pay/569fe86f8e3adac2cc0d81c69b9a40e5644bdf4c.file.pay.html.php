<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 14:51:28
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\pay.html" */ ?>
<?php /*%%SmartyHeaderCode:189815924f297ada358-64768969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '569fe86f8e3adac2cc0d81c69b9a40e5644bdf4c' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\pay.html',
      1 => 1495594815,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189815924f297ada358-64768969',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924f297ae5ed3_63951759',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'ordernum' => 0,
    'amount' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924f297ae5ed3_63951759')) {function content_5924f297ae5ed3_63951759($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>订单继续支付</title>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/zepto.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<style media="screen">
	html {background: #eee;}
	.content {background: #fff; margin: .2rem 0; padding: .2rem .2rem 0; font-size: .3rem;}
	.content dl {padding-bottom: .2rem; line-height: .6rem;}
	.content dt {float: left; width: 1.6rem;}
	.content dd {position: relative; overflow: hidden;}
	.content select {width: 90%; height: .6rem;}
	.btn {width: 90%; height: .8rem; line-height: .8rem; text-align: center; color: #fff; background: #e83829; margin: 0 auto; display: block; border: none; border-radius: 0.6rem; font-size: 0.3rem;}
</style>
</head>

<body>
<form action="/include/ajax.php?service=waimai&action=pay&ordernum=<?php echo $_smarty_tpl->tpl_vars['ordernum']->value;?>
" method="post">
	<div class="content">
		<dl class="fn-clear">
			<dt>支付方式：</dt>
			<dd>
				<select name="paytype">
					<option value="wxpay">微信支付</option>
					<option value="alipay">支付宝</option>
				</select>
			</dd>
		</dl>
		<dl class="fn-clear">
			<dt>支付金额：</dt>
			<dd><strong style="color: #e83829;">&yen; <?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
</strong></dd>
		</dl>
	</div>
	<button type="submit" class="btn">确定支付</button>
</form>
</body>
</html>
<?php }} ?>
