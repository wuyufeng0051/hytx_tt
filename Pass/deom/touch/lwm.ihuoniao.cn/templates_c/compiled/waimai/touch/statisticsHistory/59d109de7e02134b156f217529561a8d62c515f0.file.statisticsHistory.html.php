<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-20 11:57:51
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\courier\statisticsHistory.html" */ ?>
<?php /*%%SmartyHeaderCode:2140259488cb6302ce3-27560736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59d109de7e02134b156f217529561a8d62c515f0' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\courier\\statisticsHistory.html',
      1 => 1497931069,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2140259488cb6302ce3-27560736',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59488cb6345378_83898485',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'stime' => 0,
    'etime' => 0,
    'totalSuccess' => 0,
    'totalFailed' => 0,
    'peisong' => 0,
    'fuwu' => 0,
    'success' => 0,
    'delivery' => 0,
    'money' => 0,
    'online' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59488cb6345378_83898485')) {function content_59488cb6345378_83898485($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>我的统计</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/touchBase.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=33"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="/templates/courier/css/leMai.css?v=8">
</head>

<body>
<!-- 头部 外卖订单详细头部 -->
<div class="tongJi jk22">
	<a href="javascript:;" onclick="history.go(-1);"><i></i></a>
	<p><span>历史统计</span></p>
</div>

<!-- 今日外卖战绩 -->
<div class="todayWai">
	<div class="zhanJi fn-clear">
		<span><?php echo $_smarty_tpl->tpl_vars['stime']->value;?>
 至 <?php echo $_smarty_tpl->tpl_vars['etime']->value;?>
</span>
	</div>
	<div class="yiuLan fn-clear" style="margin-top: .2rem;">
		<div class="yiuLan01">
			<p><?php echo $_smarty_tpl->tpl_vars['totalSuccess']->value;?>
单</p>
			<span>配送成功</span>
		</div>
		<div class="yiuLan01 yiuLan02">
			<p><?php echo $_smarty_tpl->tpl_vars['totalFailed']->value;?>
单</p>
			<span>配送失败</span>
		</div>
	</div>
	<div class="yiuLan fn-clear" style="margin-top: .6rem;">
		<div class="yiuLan01">
			<p><?php echo $_smarty_tpl->tpl_vars['peisong']->value;?>
元</p>
			<span>配送费</span>
		</div>
		<div class="yiuLan01 yiuLan02">
			<p><?php echo $_smarty_tpl->tpl_vars['fuwu']->value;?>
元</p>
			<span>增值服务费</span>
		</div>
	</div>
	<div class="yiuLan fn-clear" style="margin-top: .6rem;">
		<div class="yiuLan01">
			<p><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
元</p>
			<span>配送成功总金额</span>
		</div>
		<div class="yiuLan01 yiuLan02">
			<p><?php echo $_smarty_tpl->tpl_vars['delivery']->value;?>
元</p>
			<span>货到付款总金额</span>
		</div>
	</div>
	<div class="yiuLan fn-clear" style="margin-top: .6rem;">
		<div class="yiuLan01">
			<p><?php echo $_smarty_tpl->tpl_vars['money']->value;?>
元</p>
			<span>余额付款总金额</span>
		</div>
		<div class="yiuLan01 yiuLan02">
			<p><?php echo $_smarty_tpl->tpl_vars['online']->value;?>
元</p>
			<span>在线支付总金额</span>
		</div>
	</div>
</div>

<div class="bottomFix">
	<ul class="fn-clear bottomFix01">
		<li class="maiWai"><a href="/?service=waimai&do=courier&state=3"><i></i><p>订单</p></a></li>
		<li class="paoTui"><a href="/?service=waimai&do=courier&template=comment"><i></i><p>评价</p></a></li>
		<li class="woDe woDe01"><a href="/?service=waimai&do=courier&template=statistics"><i></i><p>统计</p></a></li>
	</ul>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/templates/courier/js/drag-loading.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
