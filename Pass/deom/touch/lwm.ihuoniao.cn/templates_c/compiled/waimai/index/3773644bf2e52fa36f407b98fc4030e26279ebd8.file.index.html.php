<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 17:39:35
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\courier\index.html" */ ?>
<?php /*%%SmartyHeaderCode:32175592b714a678c90-83967171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3773644bf2e52fa36f407b98fc4030e26279ebd8' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\courier\\index.html',
      1 => 1498032825,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32175592b714a678c90-83967171',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592b714a767141_62010296',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'courier_state' => 0,
    'state' => 0,
    'userid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592b714a767141_62010296')) {function content_592b714a767141_62010296($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>外卖订单</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/touchBase.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=33"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="/templates/courier/css/leMai.css?v=8">
</head>

<body>
<div class="mode01">
	<!-- 外卖订单 -->
	<div class="waiMai">
		<a href="javascript:;" class="kaiGuan xiaoXue<?php if ($_smarty_tpl->tpl_vars['courier_state']->value==1) {?> kaiGuan01<?php }?>"><i></i></a>
		<p>外卖订单</p>
		<a href="/?service=waimai&do=courier&template=logout" class="logout"></a>
	</div>
	<!-- 待抢、配送、成功、失败 -->
	<div class="stateNow stateNow01" data-type="1">
		<a href="/?service=waimai&do=courier&state=3"<?php if ($_smarty_tpl->tpl_vars['state']->value=="3") {?> class="daiQiang"<?php }?>>待抢</a>
		<a href="/?service=waimai&do=courier&state=4,5"<?php if ($_smarty_tpl->tpl_vars['state']->value=="4,5") {?> class="daiQiang"<?php }?>>配送</a>
		<a href="/?service=waimai&do=courier&state=1"<?php if ($_smarty_tpl->tpl_vars['state']->value=="1") {?> class="daiQiang"<?php }?>>成功</a>
		<a href="/?service=waimai&do=courier&state=7"<?php if ($_smarty_tpl->tpl_vars['state']->value=="7") {?> class="daiQiang"<?php }?>>失败</a>
	</div>
	<div class="xuanXiang">
		<!-- 待抢 -->

		<?php if ($_smarty_tpl->tpl_vars['courier_state']->value==0&&$_smarty_tpl->tpl_vars['state']->value==3) {?>
		<div class="empty">您已经停工，好好休息一下吧~</div>
		<?php } else { ?>
		<div class="show01 dingDan show02">
		    <div class="loading" data-loading="false" style="border-bottom: 0px solid transparent; height: 0px;">下拉刷新...</div>
			<div class="reTry"></div>
		</div>
		<?php }?>

	</div>
</div>

<div class="mapPath">
	<div id="mapPath"></div>
	<div class="mapBtn">
		<button id="closeMap"></button>
	</div>
</div>

<div class="bottomFix">
	<ul class="fn-clear bottomFix01">
		<li class="maiWai maiWai01"><a href="/?service=waimai&do=courier&state=3"><i></i><p>订单</p></a></li>
		<li class="paoTui"><a href="/?service=waimai&do=courier&template=comment"><i></i><p>评价</p></a></li>
		<li class="woDe"><a href="/?service=waimai&do=courier&template=statistics"><i></i><p>统计</p></a></li>
	</ul>
</div>

<!-- 友情提醒 -->
<div class="youqingTixing"></div>

<?php echo '<script'; ?>
 type="text/javascript">
    var state = '<?php echo $_smarty_tpl->tpl_vars['state']->value;?>
', userid = '<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
', courier_state = <?php echo $_smarty_tpl->tpl_vars['courier_state']->value;?>
;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/templates/courier/js/drag-loading.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/templates/courier/js/leMai.js?v=10"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
