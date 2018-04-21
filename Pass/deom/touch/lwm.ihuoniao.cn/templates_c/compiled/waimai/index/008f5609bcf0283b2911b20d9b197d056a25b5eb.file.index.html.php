<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-29 15:56:14
         compiled from "D:\wwwroot\deom\touch\lwm.ihuoniao.cn\templates\courier\index.html" */ ?>
<?php /*%%SmartyHeaderCode:607759544ece9dfc08-51093346%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '008f5609bcf0283b2911b20d9b197d056a25b5eb' => 
    array (
      0 => 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\templates\\courier\\index.html',
      1 => 1498720090,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '607759544ece9dfc08-51093346',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59544eceb47256_68691106',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'courier_state' => 0,
    'state' => 0,
    'userid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59544eceb47256_68691106')) {function content_59544eceb47256_68691106($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>外卖订单</title>
<link src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/ui/swiper.min.css"></link>
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
		<a data-page="1" data-totalpage="1" data-action="robbed" href="javascript:;" class="daiQiang">待抢</a>
		<a data-page="1" data-totalpage="1" data-action="distribution" href="javascript:;" >配送</a>
		<a data-page="1" data-totalpage="1" data-action="succeed" href="javascript:;" >成功</a>
		<a data-page="1" data-totalpage="1" data-action="Failure" href="javascript:;" >失败</a>
	</div>
	<div class="xuanXiang">
		<!-- 待抢 -->

		<?php if ($_smarty_tpl->tpl_vars['courier_state']->value==0&&$_smarty_tpl->tpl_vars['state']->value==3) {?>
		<div class="empty">您已经停工，好好休息一下吧~</div>
		<?php } else { ?>
		<div class="show01 dingDan show02">
		    <div class="loading" data-loading="false" style="border-bottom: 0px solid transparent; height: 0px;">下拉刷新...</div>
			<div class="reTry swiper-container" id="tabs-container" >
				<div class="swiper-wrapper">
					<div class="swiper-slide robbed"></div>
					<div class="swiper-slide distribution"></div>
					<div class="swiper-slide succeed"></div>
					<div class="swiper-slide Failure"></div>
				</div>
			</div>
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
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/swiper.min.js"><?php echo '</script'; ?>
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
