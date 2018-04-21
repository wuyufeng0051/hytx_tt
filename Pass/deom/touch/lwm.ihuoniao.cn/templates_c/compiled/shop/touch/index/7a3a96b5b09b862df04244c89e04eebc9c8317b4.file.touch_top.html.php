<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 18:56:32
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\siteConfig\touch_top.html" */ ?>
<?php /*%%SmartyHeaderCode:5901595239e0189e41-62631001%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a3a96b5b09b862df04244c89e04eebc9c8317b4' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\siteConfig\\touch_top.html',
      1 => 1494490712,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5901595239e0189e41-62631001',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageTitle' => 0,
    'cfg_basehost' => 0,
    'installModuleArr' => 0,
    'article_channelDomain' => 0,
    'info_channelDomain' => 0,
    'tuan_channelDomain' => 0,
    'house_channelDomain' => 0,
    'shop_channelDomain' => 0,
    'build_channelDomain' => 0,
    'furniture_channelDomain' => 0,
    'home_channelDomain' => 0,
    'renovation_channelDomain' => 0,
    'job_channelDomain' => 0,
    'marry_channelDomain' => 0,
    'car_channelDomain' => 0,
    'waimai_channelDomain' => 0,
    'business_channelDomain' => 0,
    'tieba_channelDomain' => 0,
    'huangye_channelDomain' => 0,
    'video_channelDomain' => 0,
    'pic_basehost' => 0,
    'vote_channelDomain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_595239e01e7a58_79559924',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_595239e01e7a58_79559924')) {function content_595239e01e7a58_79559924($_smarty_tpl) {?><div class="header">
	<div class="header-l">
		<?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=168" language="javascript"><?php echo '</script'; ?>
>
	</div>
	<div class="header-address">
		<span><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</span>
	</div>
	<div class="header-search">
		<a href="javascript:;" class="dropnav"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/screen.png" alt=""></a>
	</div>
</div>

<div class="navBox" id="navBox">
	<div class="navlist" id="navlist">
		<ul class="clearfix fn-clear">
			<?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
"><span class="nav_1"></span>新闻</a></li><?php }?>
			<?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
"><span class="nav_2"></span>二手</a></li><?php }?>
			<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
"><span class="nav_3"></span>团购</a></li><?php }?>
			<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['house_channelDomain']->value;?>
"><span class="nav_4"></span>房产</a></li><?php }?>
			<?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
"><span class="nav_5"></span>商城</a></li><?php }?>
			<?php if (in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['build_channelDomain']->value;?>
"><span class="nav_6"></span>建材</a></li><?php }?>
			<?php if (in_array("furniture",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['furniture_channelDomain']->value;?>
"><span class="nav_7"></span>家具</a></li><?php }?>
			<?php if (in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['home_channelDomain']->value;?>
"><span class="nav_8"></span>家居</a></li><?php }?>
			<?php if (in_array("renovation",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
"><span class="nav_9"></span>装修</a></li><?php }?>
			<?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
"><span class="nav_10"></span>招聘</a></li><?php }?>
			<?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
"><span class="nav_11"></span>交友</a></li><?php }?>
			<?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['marry_channelDomain']->value;?>
"><span class="nav_12"></span>婚嫁</a></li><?php }?>
			<?php if (in_array("car",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
"><span class="nav_13"></span>汽车</a></li><?php }?>
			<?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
"><span class="nav_14"></span>外卖</a></li><?php }?>
			<?php if (in_array("business",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['business_channelDomain']->value;?>
"><span class="nav_15"></span>商家</a></li><?php }?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
"><span class="nav_16"></span>旅游</a></li>
			<?php if (in_array("tieba",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['tieba_channelDomain']->value;?>
"><span class="nav_17"></span>贴吧</a></li><?php }?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
"><span class="nav_18"></span>五折卡</a></li>
			<?php if (in_array("huangye",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['huangye_channelDomain']->value;?>
"><span class="nav_19"></span>黄页</a></li><?php }?>
			<?php if (in_array("video",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['video_channelDomain']->value;?>
"><span class="nav_20"></span>视频</a></li><?php }?>
			<?php if (in_array("pic",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['pic_basehost']->value;?>
"><span class="nav_21"></span>图片</a></li><?php }?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
"><span class="nav_22"></span>直播</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
"><span class="nav_23"></span>打车</a></li>
			<?php if (in_array("vote",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['vote_channelDomain']->value;?>
"><span class="nav_24"></span>投票</a></li><?php }?>
		</ul>
	</div>
	<div class="bg" id="shearBg"></div>
</div>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/ui/iscroll.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php }} ?>
