<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:36:02
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\public-payreturn.html" */ ?>
<?php /*%%SmartyHeaderCode:1141159240282f03186-09468110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a8dac435309a150589e05b04d6bf11b4e74e90f1' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\public-payreturn.html',
      1 => 1494490904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1141159240282f03186-09468110',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'channelName' => 0,
    'cfg_staticPath' => 0,
    'cfg_basehost' => 0,
    'service' => 0,
    'url' => 0,
    'state' => 0,
    'channelDomain' => 0,
    'cfg_shortname' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59240283039f21_62359345',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59240283039f21_62359345')) {function content_59240283039f21_62359345($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['channelName']->value;?>
</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/touchBase.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/member/touch/css/public-payreturn.css">
</head>

<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['service']->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>$_tmp1),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable($_tmp2, null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['service']->value=="huodong") {?>
<?php ob_start();?><?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'record'),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable($_tmp3, null, 0);?>
<?php }?>
<body>
<div class="container">
	<div class="header">
		<div class="header-c"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
		<div class="header-r"><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">完成</a></div>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['state']->value!=1) {?>
	<div class="pay-icon failed"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/member/touch/images/pay-failed.png" /><p>支付失败</p></div>
	<div class="btn">
		<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" class="endpay">订单中心</a>
	</div>
	<?php } else { ?>
	<div class="pay-icon"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/member/touch/images/pay-success.png" /><p>支付成功</p></div>
	<div class="btn">
		<a href="<?php echo $_smarty_tpl->tpl_vars['channelDomain']->value;?>
" class="repay">继续购物</a>
		<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" class="endpay">查看订单</a>
	</div>
	<div class="tip">
		<p>安全提醒：<?php echo $_smarty_tpl->tpl_vars['cfg_shortname']->value;?>
不会以任何理由要求您提供银行卡信息或支付额外费用，请谨防钓鱼链接或诈骗电话。</p>
	</div>
	<?php }?>
</div>
</body>
</html>
<?php }} ?>
