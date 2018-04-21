<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-15 11:11:03
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\siteConfig\touch\default\index.html" */ ?>
<?php /*%%SmartyHeaderCode:787159191c47a5ea61-08239648%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30b5f628fd76fa8e028e411404f4a47b7bc35a71' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\siteConfig\\touch\\default\\index.html',
      1 => 1494490724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '787159191c47a5ea61-08239648',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_webname' => 0,
    'cfg_keywords' => 0,
    'cfg_description' => 0,
    'cfg_basehost' => 0,
    'templets_skin' => 0,
    'cfg_staticPath' => 0,
    'member_userDomain' => 0,
    'cfg_hideUrl' => 0,
    'redirectUrl' => 0,
    'site' => 0,
    'cfg_geetest' => 0,
    'cfg_shortname' => 0,
    'userinfo' => 0,
    'member_busiDomain' => 0,
    'userDomain' => 0,
    'installModuleArr' => 0,
    'article_channelDomain' => 0,
    'info_channelDomain' => 0,
    'tuan_channelDomain' => 0,
    'house_channelDomain' => 0,
    'job_channelDomain' => 0,
    'renovation_channelDomain' => 0,
    'shop_channelDomain' => 0,
    'build_channelDomain' => 0,
    'business_channelDomain' => 0,
    'marry_channelDomain' => 0,
    'waimai_channelDomain' => 0,
    'home_channelDomain' => 0,
    'furniture_channelDomain' => 0,
    'car_channelDomain' => 0,
    'special_channelDomain' => 0,
    'website_channelDomain' => 0,
    'dating_channelDomain' => 0,
    'tieba_channelDomain' => 0,
    'huangye_channelDomain' => 0,
    'video_channelDomain' => 0,
    'pic_basehost' => 0,
    'vote_channelDomain' => 0,
    'module' => 0,
    'alist' => 0,
    'k' => 0,
    'group' => 0,
    'ilist' => 0,
    'tlist' => 0,
    'zu' => 0,
    'slist' => 0,
    'store' => 0,
    '_bindex' => 0,
    'diary' => 0,
    'post' => 0,
    'dating' => 0,
    'hotel' => 0,
    'brand' => 0,
    'list' => 0,
    'wstore' => 0,
    'loginCode' => 0,
    'login' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59191c47e56558_69488762',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59191c47e56558_69488762')) {function content_59191c47e56558_69488762($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['cfg_keywords']->value;?>
">
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['cfg_description']->value;?>
">
<meta name="wap-font-scale" content="no">
<meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/css/touch_common.css?v=5">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css?v=15">
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=15"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', userDomain = '<?php echo $_smarty_tpl->tpl_vars['member_userDomain']->value;?>
', staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';
	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, redirectUrl = '<?php echo $_smarty_tpl->tpl_vars['redirectUrl']->value;?>
', site = '<?php echo $_smarty_tpl->tpl_vars['site']->value;?>
';
    var geetest = <?php echo $_smarty_tpl->tpl_vars['cfg_geetest']->value;?>
;
<?php echo '</script'; ?>
>
<style>
  html #newBridge {display: none;}
</style>
</head>

<body>
<header id="header">
	<div class="l_btn logo"><?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=168" language="javascript"><?php echo '</script'; ?>
></div>
	<h1 class="title"><?php echo $_smarty_tpl->tpl_vars['cfg_shortname']->value;?>
</h1>
	<div class="r_btn">
		<ul class="weather" id="weather"></ul>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['userinfo']->value) {?>
	<?php $_smarty_tpl->tpl_vars['userDomain'] = new Smarty_variable($_smarty_tpl->tpl_vars['member_userDomain']->value, null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['userType']==2) {?>
	<?php $_smarty_tpl->tpl_vars['userDomain'] = new Smarty_variable($_smarty_tpl->tpl_vars['member_busiDomain']->value, null, 0);?>
	<?php }?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['userDomain']->value;?>
" class="icon_user"></a>
	<?php } else { ?>
	<a href="javascript:;" class="icon_user" id="icon_user"></a>
	<?php }?>
</header>
<!-- 导航 -->
<div class="navHeight">
	<div class="swipernav">
		<div class="swiper-container swiper-container-horizontal" id="swiper-container1">
	    <div class="swiper-wrapper">
	      <?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
">新闻</a></div><?php }?>
	      <?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">二手</a></div><?php }?>
	      <?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
">团购</a></div><?php }?>
	      <?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['house_channelDomain']->value;?>
">房产</a></div><?php }?>
	      <?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
">招聘</a></div><?php }?>
	      <?php if (in_array("renovation",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">装修</a></div><?php }?>
	      <?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
">商城</a></div><?php }?>
	      <?php if (in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['build_channelDomain']->value;?>
">建材</a></div><?php }?>
	      <div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['business_channelDomain']->value;?>
">商家</a></div>
	      <?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['marry_channelDomain']->value;?>
">婚嫁</a></div><?php }?>
	      <?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
">外卖</a></div><?php }?>
          <div class="swiper-slide"><a href="app.html">测试</a></div>
          <div class="swiper-slide"><a href="upload.html">上传</a></div>
	      <!-- <?php if (in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a h<?php echo $_smarty_tpl->tpl_vars['home_channelDomain']->value;?>
ef="#">家居</a></div><?php }?>
	      <?php if (in_array("furniture",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['furniture_channelDomain']->value;?>
">家具</a></div><?php }?>
	      <?php if (in_array("car",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
">汽车</a></div><?php }?>
	      <?php if (in_array("special",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['special_channelDomain']->value;?>
">专题</a></div><?php }?>
	      <?php if (in_array("website",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['website_channelDomain']->value;?>
">建站</a></div><?php }?> -->
	    </div>
	  </div>
		<a href="javascript:;" class="toggleBtn"><i class="icon_down"></i></a>
	</div>
</div>
<div class="navBox" id="navBox">
	<div class="navlist" id="navlist">
		<ul class="clearfix">
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
			<?php if (in_array("dating",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['dating_channelDomain']->value;?>
"><span class="nav_11"></span>交友</a></li><?php }?>
			<?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['marry_channelDomain']->value;?>
"><span class="nav_12"></span>婚嫁</a></li><?php }?>
			<?php if (in_array("car",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
"><span class="nav_13"></span>汽车</a></li><?php }?>
			<?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
"><span class="nav_14"></span>外卖</a></li><?php }?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['business_channelDomain']->value;?>
"><span class="nav_15"></span>商家</a></li>
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

<div class="nav">
	<ul class="fn-clear">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"siteModule",'return'=>"module")); $_block_repeat=true; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<li><a href="<?php echo $_smarty_tpl->tpl_vars['module']->value['url'];?>
" target="_blank"><span><?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
</span></a></li>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</ul>
</div>

<!-- 轮播图 -->
<div class="banna clearfix">
	<!-- picscroll -->
	<div class="picscroll">
	    <div class="bd" id="picscroll">
	    	<ul>
					<?php echo getMyAd(array('id'=>"169"),$_smarty_tpl);?>

	    	</ul>
	    </div>
	    <div class="pages">
	    	<span class="page">1</span>/
	    	<span class="count"></span>
	    </div>
	</div>
</div>

<!-- 天气预报 -->
<div class="todaylifeinfo hide">
	<div class="inner clearfix">
		<dl class="weatherd">
			<dt>
				<span>21°</span>
				<span><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/yu.png" alt=""></span>
			</dt>
			<dd>
				<span class="s1">晴 14~31℃</span>
				<span class="s2">空气良 80</span>
			</dd>
		</dl>
		<dl class="xianxing">
			<dt>限行尾号</dt>
			<dd>
				<span>3</span>
				<span>8</span>
			</dd>
		</dl>
	</div>
</div>
<?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 资讯列表 -->
<div class="part newsList">
	<div class="title">今日要闻</div>
	<div class="list">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'group_img'=>"1",'typeid'=>"9",'pageSize'=>"6")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'group_img'=>"1",'typeid'=>"9",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<div class="m_item<?php if ($_smarty_tpl->tpl_vars['alist']->value['group_img']||$_smarty_tpl->tpl_vars['alist']->value['litpic']) {?> alonenews<?php }?>">
			<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" class="clearfix">
				<?php if ($_smarty_tpl->tpl_vars['alist']->value['group_img']) {?>
				<div class="bt m_news_bt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</div>
				<div class="pic clearfix">
					<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['alist']->value['group_img']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
	        <?php if ($_smarty_tpl->tpl_vars['k']->value<3) {?>
	        <img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['group']->value['path']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
">
	        <?php }?>
	        <?php } ?>
				</div>
				<div class="m_des clearfix">
					<div class="ab_l"><span class="souce"><?php echo $_smarty_tpl->tpl_vars['alist']->value['source'];?>
</span><span class="time"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['alist']->value['pubdate'],"%m-%d");?>
</span></div>
					<div class="ab_r"><?php echo $_smarty_tpl->tpl_vars['alist']->value['common'];?>
<i class="icon-pls"></i>
					</div>
				</div>
				<?php } elseif ($_smarty_tpl->tpl_vars['alist']->value['litpic']) {?>
				<div class="m_item-img">
					<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
">
				</div>
				<div class="m_item-txt">
					<span class="m_news_bt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span>
					<div class="m_des clearfix">
						<div class="ab_l"><span class="souce"><?php echo $_smarty_tpl->tpl_vars['alist']->value['source'];?>
</span><span class="time"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['alist']->value['pubdate'],"%m-%d");?>
</span></div>
						<div class="ab_r"><?php echo $_smarty_tpl->tpl_vars['alist']->value['common'];?>
<i class="icon-pls"></i></div>
					</div>
				</div>
				<?php } else { ?>
				<div class="m_item-txt">
					<span class="m_news_bt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span>
					<div class="m_des clearfix">
						<div class="ab_l"><span class="souce"><?php echo $_smarty_tpl->tpl_vars['alist']->value['source'];?>
</span><span class="time"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['alist']->value['pubdate'],"%m-%d");?>
</span></div>
						<div class="ab_r"><?php echo $_smarty_tpl->tpl_vars['alist']->value['common'];?>
<i class="icon-pls"></i></div>
					</div>
				</div>
				<?php }?>
			</a>
		</div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'group_img'=>"1",'typeid'=>"9",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</div>
	<div class="loadmore bb">
		<a href="<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
	</div>
</div>
<?php }?>

<?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 二手信息 -->
<div class="part secondHand">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">二手信息</a></h2>
		<div class="morelink">
			<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">竞价</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">最新</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">推荐</a>
		</div>
	</div>
	<div class="bd">
		<ul class="toplink clearfix">
			<li>
				<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">
					<div class="txt">
						<p class="t">二手良品</p>
						<p class="st">官方质检</p>
					</div>
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/sechand_1.jpg" alt="">
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">
					<div class="txt">
						<p class="t">放心工作</p>
						<p class="st">不用担心黑中介</p>
					</div>
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/sechand_2.jpg" alt="">
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">
					<div class="txt">
						<p class="t">闲置真心送</p>
						<p class="st">乐赠闲置，悦己利他</p>
					</div>
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/sechand_3.jpg" alt="">
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
">
					<div class="txt">
						<p class="t">二手轿车</p>
						<p class="st">好车天天看</p>
					</div>
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/sechand_4.jpg" alt="">
					</div>
				</a>
			</li>
		</ul>
		<div class="list clearfix">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('info', array('action'=>"ilist",'return'=>"ilist",'pageSize'=>"6")); $_block_repeat=true; echo info(array('action'=>"ilist",'return'=>"ilist",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div class="item">
				<a href="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['url'];?>
">
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['ilist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="">
					</div>
					<p class="title"><?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
</p>
					<p class="item_btm clearfix">
						<span class="price"><?php echo $_smarty_tpl->tpl_vars['ilist']->value['typename'];?>
</span>
						<span class="time"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ilist']->value['pubdate'],"%m-%d");?>
</span>
					</p>
				</a>
			</div>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo info(array('action'=>"ilist",'return'=>"ilist",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore bb">
			<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 团购 -->
<div class="part tuangou">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
">团购</a></h2>
		<div class="morelink">
			<a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
">推荐</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
">最新</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
">秒杀</a>
		</div>
	</div>
	<div class="bd">
		<div class="list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('tuan', array('action'=>"tlist",'return'=>"tlist",'pageSize'=>"6")); $_block_repeat=true; echo tuan(array('action'=>"tlist",'return'=>"tlist",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div class="item">
				<a href="<?php echo $_smarty_tpl->tpl_vars['tlist']->value['url'];?>
">
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['tlist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="">
					</div>
					<div class="txt">
						<p class="title"><span class="sell">已售<?php echo $_smarty_tpl->tpl_vars['tlist']->value['sale'];?>
</span><?php echo $_smarty_tpl->tpl_vars['tlist']->value['title'];?>
</p>
						<p class="des"><?php echo $_smarty_tpl->tpl_vars['tlist']->value['subtitle'];?>
</p>
						<div class="item_btm clearfix">
							<div class="price"><span class="now">&yen;<?php echo $_smarty_tpl->tpl_vars['tlist']->value['market'];?>
</span><span class="youhui"><i>减<?php echo $_smarty_tpl->tpl_vars['tlist']->value['market']-$_smarty_tpl->tpl_vars['tlist']->value['price'];?>
</i></span></div>
							<div class="btn">&yen;<?php echo $_smarty_tpl->tpl_vars['tlist']->value['price'];?>
抢</div>
						</div>
					</div>
				</a>
			</div>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo tuan(array('action'=>"tlist",'return'=>"tlist",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore">
			<a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 房产信息 上方链接 -->
<div class="houseInfo">
	<dl class="picbox clearfix">
		<dt>
			<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'loupan'),$_smarty_tpl);?>
">
				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/house_1.png" alt=""></div>
				<div class="txt">
					<p class="t">最新上线</p>
				</div>
			</a>
		</dt>
		<dd>
			<div>
				<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'loupan'),$_smarty_tpl);?>
">
					<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/house_2.png" alt=""></div>
					<div class="txt">
						<p class="t">优惠楼盘</p>
						<p class="st">优惠！错过不再！</p>
					</div>
				</a>
			</div>
			<div>
				<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'loupan'),$_smarty_tpl);?>
">
					<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/house_3.png" alt=""></div>
					<div class="txt">
						<p class="t">最近开盘</p>
						<p class="st">3个月内开盘</p>
					</div>
				</a>
			</div>
		</dd>
	</dl>
</div>
<!-- 房产信息 -->
<div class="part houseInfo">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['house_channelDomain']->value;?>
">房产信息</a></h2>
		<div class="morelink">
			<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'loupan'),$_smarty_tpl);?>
">最新</a>
			<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'zu'),$_smarty_tpl);?>
">出租</a>
			<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'sale'),$_smarty_tpl);?>
">出售</a>
		</div>
	</div>
	<div class="bd">
		<div class="list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"zulist",'return'=>"zu",'pageSize'=>"6")); $_block_repeat=true; echo house(array('action'=>"zulist",'return'=>"zu",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<dl class="clearfix">
				<a href="<?php echo $_smarty_tpl->tpl_vars['zu']->value['url'];?>
">
					<dt>
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['zu']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="">
					</dt>
					<dd>
						<p class="title"><?php echo $_smarty_tpl->tpl_vars['zu']->value['title'];?>
</p>
						<p class="info_m">
							<span class="type"><?php echo $_smarty_tpl->tpl_vars['zu']->value['room'];?>
 <?php echo $_smarty_tpl->tpl_vars['zu']->value['rentype'];?>
</span>
							<span class="price"><em><?php echo $_smarty_tpl->tpl_vars['zu']->value['price'];?>
</em>元/月</span>
						</p>
						<p class="place"><?php echo $_smarty_tpl->tpl_vars['zu']->value['community'];?>
</p>
						<p class="tag">
							<span><?php echo $_smarty_tpl->tpl_vars['zu']->value['protype'];?>
</span>
							<span><?php echo $_smarty_tpl->tpl_vars['zu']->value['direction'];?>
</span>
							<span><?php echo $_smarty_tpl->tpl_vars['zu']->value['zhuangxiu'];?>
</span>
							<?php if ($_smarty_tpl->tpl_vars['zu']->value['sharetype']) {?><span><?php echo $_smarty_tpl->tpl_vars['zu']->value['sharetype'];?>
</span><?php }?>
						</p>
					</dd>
				</a>
			</dl>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"zulist",'return'=>"zu",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore bb">
			<a href="<?php echo $_smarty_tpl->tpl_vars['house_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 商城购物 -->
<div class="part shopping">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
">商城购物</a></h2>
		<div class="morelink">
			<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
">最新</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
">推荐</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
">销量</a>
		</div>
	</div>
	<div class="bd">
		<div class="list clearfix">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"slist",'pageSize'=>"6")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"slist",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<dl>
				<a href="<?php echo $_smarty_tpl->tpl_vars['slist']->value['url'];?>
">
					<dt><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['slist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt=""></dt>
					<dd>
						<p class="des"><?php echo $_smarty_tpl->tpl_vars['slist']->value['title'];?>
</p>
						<p class="price">&yen;<?php echo $_smarty_tpl->tpl_vars['slist']->value['price'];?>
</p>
					</dd>
				</a>
			</dl>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"slist",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore">
			<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<!-- 建材装修 -->
<div class="part build">
	<ul class="p_nav">
		<?php if (in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['build_channelDomain']->value;?>
">
				<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/jiancai.png" alt="">
				<span>建材</span>
			</a>
		</li>
		<?php }?>
		<?php if (in_array("furniture",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['furniture_channelDomain']->value;?>
">
				<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/jiaju.png" alt="">
				<span>家具</span>
			</a>
		</li>
		<?php }?>
		<?php if (in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['home_channelDomain']->value;?>
">
				<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/jiaju_life.png" alt="">
				<span>家居</span>
			</a>
		</li>
		<?php }?>
		<?php if (in_array("renovation",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">
				<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/zhuangxiu.png" alt="">
				<span>装修</span>
			</a>
		</li>
		<?php }?>
		<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<li>
			<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'calculator-sy'),$_smarty_tpl);?>
">
				<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/jisuanqi.png" alt="">
				<span>计算器</span>
			</a>
		</li>
		<?php }?>
	</ul>
</div>

<?php if (in_array("renovation",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<div class="part build">
	<dl class="picbox clearfix">
		<dt>
			<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">
				<div class="txt">
					<p class="t">户型设计与报价<span class="free"><s></s>免费</span></p>
					<p class="st">多家对比不吃亏</p>
				</div>
				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/build_t_01.png" alt=""></div>
			</a>
		</dt>
		<dd>
			<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">
				<div class="txt">
					<p class="t">智能报价</p>
					<p class="st">一分钟出报价</p>
				</div>
				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/build_t_02.png" alt=""></div>
			</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">
				<div class="txt">
					<p class="t">装修报</p>
					<p class="st">第三方装修保障</p>
				</div>
				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/build_t_03.png" alt=""></div>
			</a>
		</dd>
	</dl>
</div>
<!-- 装修公司 -->
<div class="part renovation">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">装修公司</a></h2>
		<div class="morelink">
			<a href="<?php echo getUrlPath(array('service'=>'renovation','template'=>'albums'),$_smarty_tpl);?>
">效果图</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">案例</a>
		</div>
	</div>
	<div class="bd">
		<div class="list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>"store",'return'=>"store",'pageSize'=>"6")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"store",'return'=>"store",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div class="item">
				<a href="<?php echo $_smarty_tpl->tpl_vars['store']->value['url'];?>
">
					<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['store']->value['logo'];?>
" alt=""></div>
					<div class="txt">
						<?php if ($_smarty_tpl->tpl_vars['store']->value['certi']==1) {?><span class="tag">认</span><?php }?>
						<p class="title"><?php echo $_smarty_tpl->tpl_vars['store']->value['company'];?>
</p>
						<p class="data">
							<?php if ($_smarty_tpl->tpl_vars['store']->value['safeguard']>0) {?><span class="koubei">担保金：<span class="num"><?php echo $_smarty_tpl->tpl_vars['store']->value['safeguard'];?>
元</span></span><?php }?>
							<?php if ($_smarty_tpl->tpl_vars['store']->value['caseCount']>0) {?><span class="design">设计方案：<?php echo $_smarty_tpl->tpl_vars['store']->value['caseCount'];?>
套</span><?php }?>
						</p>
						<?php if ($_smarty_tpl->tpl_vars['store']->value['diaryCount']>0) {?><p class="askpeo">施工案例：<?php echo $_smarty_tpl->tpl_vars['store']->value['diaryCount'];?>
个</p><?php }?>
					</div>
				</a>
			</div>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"store",'return'=>"store",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore bb">
			<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<!-- 热门案例 -->
<div class="part hotcase">
	<div class="hd clearfix">
		<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
">
			<h2 class="title">热门案例</h2>
			<span class="subtitle">精品推荐 脑洞打开</span>
		</a>
	</div>
	<div class="bd">
		<div class="list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>"diary",'return'=>"diary",'orderby'=>"click",'pageSize'=>"5")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"diary",'return'=>"diary",'orderby'=>"click",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['diary']==1) {?>
			<div class="full">
				<a href="<?php echo $_smarty_tpl->tpl_vars['diary']->value['url'];?>
">
					<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['diary']->value['litpic']),'type'=>"o_large"),$_smarty_tpl);?>
" alt=""></div>
					<div class="txt">
						<p class="title"><?php echo $_smarty_tpl->tpl_vars['diary']->value['title'];?>
</p>
						<p class="des">38平米的小户型，演绎小空间的美和质感，一个人的生活，在精致小巧的空间中，精彩的进行着。设计师以灰色</p>
					</div>
				</a>
			</div>
			<div class="items clearfix">
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['diary']->value['url'];?>
">
					<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['diary']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="">
					<p><span><?php echo $_smarty_tpl->tpl_vars['diary']->value['title'];?>
</span></p>
				</a>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['diary']==5) {?>
			</div>
			<?php }?>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"diary",'return'=>"diary",'orderby'=>"click",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore">
			<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 招聘信息上 -->
<div class="part job">
	<div class="picbox clearfix">
		<a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
">
			<div class="txt">
				<p class="t">变高富帅</p>
				<p class="st">高薪销售类</p>
			</div>
			<div class="pic"></div>
		</a>
		<a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
">
			<div class="txt">
				<p class="t">稳拿高薪</p>
				<p class="st">技工类</p>
			</div>
			<div class="pic"></div>
		</a>
		<a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
">
			<div class="txt">
				<p class="t">快速入职</p>
				<p class="st">餐饮酒店类</p>
			</div>
			<div class="pic"></div>
		</a>
		<a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
">
			<div class="txt">
				<p class="t">能逛商场</p>
				<p class="st">超市百货类</p>
			</div>
			<div class="pic"></div>
		</a>
	</div>
</div>
<!-- 招聘信息 -->
<div class="part bt job">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
">招聘信息</a></h2>
		<div class="morelink">
			<a href="<?php echo getUrlPath(array('service'=>'job','template'=>'zhaopin'),$_smarty_tpl);?>
">推荐</a>
			<a href="<?php echo getUrlPath(array('service'=>'job','template'=>'resume'),$_smarty_tpl);?>
">简历</a>
			<a href="<?php echo getUrlPath(array('service'=>'job','template'=>'company'),$_smarty_tpl);?>
">企业</a>
		</div>
	</div>
	<div class="bd">
		<div class="list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('job', array('action'=>'post','return'=>'post','pageSize'=>'6')); $_block_repeat=true; echo job(array('action'=>'post','return'=>'post','pageSize'=>'6'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<dl>
				<a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
">
					<dt><i class="type tag<?php if (strstr($_smarty_tpl->tpl_vars['post']->value['property'],'h')) {?> tag-hot<?php }?>"></i><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</dt>
					<dd>
						<p><span class="type"><?php echo $_smarty_tpl->tpl_vars['post']->value['addr'][0];?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['addr'][1];?>
</span><span class="num"><?php echo $_smarty_tpl->tpl_vars['post']->value['salary'];?>
</span></p>
						<p class="p2"><span class="type"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['pubdate'],"%m-%d");?>
</span>招聘<?php echo $_smarty_tpl->tpl_vars['post']->value['number'];?>
人 <?php echo $_smarty_tpl->tpl_vars['post']->value['experience'];?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['educational'];?>
</p>
						<p class="p3"><span class="type"><?php echo $_smarty_tpl->tpl_vars['post']->value['type'];?>
</span><i class="tag tag-yan"></i><?php echo $_smarty_tpl->tpl_vars['post']->value['company']['title'];?>
</p>
					</dd>
				</a>
			</dl>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo job(array('action'=>'post','return'=>'post','pageSize'=>'6'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore">
			<a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("dating",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 同城交友 -->
<div class="part bt dating">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['dating_channelDomain']->value;?>
">同城交友</a></h2>
		<div class="morelink">
			<a href="<?php echo $_smarty_tpl->tpl_vars['dating_channelDomain']->value;?>
">推荐</a>
			<a href="<?php echo getUrlPath(array('service'=>'dating','template'=>'search','param'=>'sex=1'),$_smarty_tpl);?>
">男神</a>
			<a href="<?php echo getUrlPath(array('service'=>'dating','template'=>'search','param'=>'sex=0'),$_smarty_tpl);?>
">女神</a>
		</div>
	</div>
	<div class="bd">
		<div class="vlist">
			<div class="hideScrollBar">
				<ul class="clearfix">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('dating', array('action'=>'memberList','return'=>'dating','sex'=>'0','pageSize'=>'8')); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>'memberList','return'=>'dating','sex'=>'0','pageSize'=>'8'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['dating']->value['url'];?>
">
							<div class="pic">
								<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['dating']->value['photo'];?>
" alt="">
							</div>
							<div class="txt">
								<p class="username"><?php echo $_smarty_tpl->tpl_vars['dating']->value['nickname'];?>
</p>
								<p class="userbase"><?php echo $_smarty_tpl->tpl_vars['dating']->value['age'];?>
岁 <?php echo $_smarty_tpl->tpl_vars['dating']->value['height'];?>
cm</p>
							</div>
						</a>
					</li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>'memberList','return'=>'dating','sex'=>'0','pageSize'=>'8'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
		</div>
		<div class="list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('dating', array('action'=>'memberList','return'=>'dating','sex'=>'1','pageSize'=>'5')); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>'memberList','return'=>'dating','sex'=>'1','pageSize'=>'5'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<dl>
				<a href="<?php echo $_smarty_tpl->tpl_vars['dating']->value['url'];?>
" class="clearfix">
					<dt><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['dating']->value['photo'];?>
" alt=""></dt>
					<dd>
						<span class="comments"><?php echo $_smarty_tpl->tpl_vars['dating']->value['album'];?>
</span>
						<p class="title"><?php echo $_smarty_tpl->tpl_vars['dating']->value['nickname'];?>
</p>
						<p class="des"><?php echo $_smarty_tpl->tpl_vars['dating']->value['age'];?>
岁/<?php echo $_smarty_tpl->tpl_vars['dating']->value['height'];?>
厘米/<?php echo $_smarty_tpl->tpl_vars['dating']->value['educationName'];?>
/<?php echo $_smarty_tpl->tpl_vars['dating']->value['incomeName'];?>
</p>
						<p class="tag"><?php if ($_smarty_tpl->tpl_vars['dating']->value['purposeName']) {?><span><?php echo $_smarty_tpl->tpl_vars['dating']->value['purposeName'];?>
</span><?php }
if ($_smarty_tpl->tpl_vars['dating']->value['addr']) {?><span><?php echo $_smarty_tpl->tpl_vars['dating']->value['addr'][0];?>
</span><?php }?></p>
					</dd>
				</a>
			</dl>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>'memberList','return'=>'dating','sex'=>'1','pageSize'=>'5'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore">
			<a href="<?php echo $_smarty_tpl->tpl_vars['dating_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<div class="part">
	<div class="oLinklist">
		<div class="item item0">
			<div class="txt">
				<p class="t">居家小摆件</p>
				<p class="st">限时抢购 震撼来袭</p>
			</div>
			<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/mary_06.jpg" alt=""></div>
		</div>
		<div class="item item1">
			<div class="txt">
				<p class="t">婚车租赁</p>
				<p class="st">全城最低 买贵退钱</p>
			</div>
			<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/mary_15.jpg" alt=""></div>
		</div>
		<div class="item item2">
			<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/mary_03.jpg" alt=""></div>
			<div class="txt">
				<p class="t">当季热拍</p>
				<p class="st">寻找最美婚纱照</p>
				<p class="st">热门推荐 时下最IN</p>
				<p class="price">1999元起</p>
			</div>
		</div>
		<div class="item item3">
			<div class="txt">
				<p class="t">全球旅拍</p>
				<p class="st">机票+酒店+拍摄</p>
			</div>
			<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/mary_10.jpg" alt=""></div>
		</div>
		<div class="item item4">
			<div class="txt">
				<p class="t">大婚定制</p>
				<p class="st">超人气婚礼策划</p>
			</div>
			<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/mary_13.jpg" alt=""></div>
		</div>
	</div>
</div>
<!-- 婚嫁酒店 -->
<div class="part marryHotel">
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['marry_channelDomain']->value;?>
">婚嫁酒店</a></h2>
		<div class="morelink">
			<a href="<?php echo getUrlPath(array('service'=>'marry','template'=>'ritual'),$_smarty_tpl);?>
">策划</a>
			<a href="<?php echo getUrlPath(array('service'=>'marry','template'=>'wedding'),$_smarty_tpl);?>
">摄影</a>
			<a href="<?php echo getUrlPath(array('service'=>'marry','template'=>'hotel'),$_smarty_tpl);?>
">酒店</a>
		</div>
	</div>
	<div class="bd">
		<div class="list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('marry', array('action'=>'hotel','return'=>'hotel','pageSize'=>'6')); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>'hotel','return'=>'hotel','pageSize'=>'6'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<dl>
				<a href="<?php echo $_smarty_tpl->tpl_vars['hotel']->value['url'];?>
" class="clearfix">
					<dt><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['hotel']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt=""></dt>
					<dd>
						<p class="title"><?php echo $_smarty_tpl->tpl_vars['hotel']->value['title'];?>
</p>
						<p class="price clearfix">
							<span class="youhui">
								<?php if ($_smarty_tpl->tpl_vars['hotel']->value['gift']) {?><s class="youhui-li"></s><?php }?>
								<?php if (in_array("r",$_smarty_tpl->tpl_vars['hotel']->value['property'])) {?><s class="youhui-r"></s><?php }?>
								<?php if (in_array("h",$_smarty_tpl->tpl_vars['hotel']->value['property'])) {?><s class="youhui-h"></s><?php }?>
							</span>
							<span class="num">&yen;<?php echo $_smarty_tpl->tpl_vars['hotel']->value['minprice'];?>
-<?php echo $_smarty_tpl->tpl_vars['hotel']->value['maxprice'];?>
 /桌</span>
						</p>
						<p class="other">
							<span>容纳<?php echo $_smarty_tpl->tpl_vars['hotel']->value['tables'];?>
桌</span>
							<span><?php echo $_smarty_tpl->tpl_vars['hotel']->value['addrName'][0];?>
 <?php echo $_smarty_tpl->tpl_vars['hotel']->value['addrName'][1];?>
</span>
							<span><?php echo $_smarty_tpl->tpl_vars['hotel']->value['levalName'];?>
</span>
						</p>
					</dd>
				</a>
			</dl>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>'hotel','return'=>'hotel','pageSize'=>'6'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore">
			<a href="<?php echo getUrlPath(array('service'=>'marry','template'=>'hotel'),$_smarty_tpl);?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("car",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 汽车 -->
<div class="part car">
	<ul class="topnav clearfix">
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
">
				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_t_1.jpg" alt=""></div>
				<span>新车上市</span>
			</a>
		</li>
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
">
				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_t_2.jpg" alt=""></div>
				<span>关注排行榜</span>
			</a>
		</li>
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
">
				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_t_3.jpg" alt=""></div>
				<span>优惠排行榜</span>
			</a>
		</li>
	</ul>
	<div class="hotbrand">
		<p class="title">热门品牌</p>
		<ul class="brandlist clearfix">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('car', array('action'=>"brand",'return'=>"brand")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"brand",'return'=>"brand"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['brand']<11) {?>
			<li>
				<a href="">
					<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['brand']->value['logo'];?>
" alt="">
					<span><?php echo $_smarty_tpl->tpl_vars['brand']->value['typename'];?>
</span>
				</a>
			</li>
			<?php }?>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"brand",'return'=>"brand"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</ul>
	</div>
	<div class="hd clearfix">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
">汽车信息</a></h2>
		<div class="morelink">
			<a href="">资讯</a>
			<a href="">车型</a>
			<a href="">经销商</a>
		</div>
	</div>
	<div class="bd">
		<div class="list">
			<div class="item">
				<a href="">
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_info_1.jpg" alt="">
					</div>
					<div class="txt">
						<p class="title">雪佛兰新一代Cobalt官图发布</p>
						<p class="item_btm clearfix">
							<span class="comnt">抢沙发</span>
							<span class="time">1小时前</span>
						</p>
					</div>
				</a>
			</div>
			<div class="item">
				<a href="">
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_info_2.jpg" alt="">
					</div>
					<div class="txt">
						<p class="title">宝马新3系GT车型官图正式发布</p>
						<p class="item_btm clearfix">
							<span class="comnt">2评论</span>
							<span class="time">1小时前</span>
						</p>
					</div>
				</a>
			</div>
			<div class="item">
				<a href="">
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_info_3.jpg" alt="">
					</div>
					<div class="txt">
						<p class="title">牧马人/途乐/废铁皮勒芒比赛</p>
						<p class="item_btm clearfix">
							<span class="comnt">2评论</span>
							<span class="time">1小时前</span>
						</p>
					</div>
				</a>
			</div>
			<div class="item">
				<a href="">
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_info_4.jpg" alt="">
					</div>
					<div class="txt">
						<p class="title">盘点那些小孩子们的超级座驾</p>
						<p class="item_btm clearfix">
							<span class="comnt">2评论</span>
							<span class="time">1小时前</span>
						</p>
					</div>
				</a>
			</div>
			<div class="item">
				<a href="">
					<div class="pic">
						<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/car_info_5.jpg" alt="">
					</div>
					<div class="txt">
						<p class="title">爱卡试驾长安马自达CX-5 2.5L</p>
						<p class="item_btm clearfix">
							<span class="comnt">2评论</span>
							<span class="time">1小时前</span>
						</p>
					</div>
				</a>
			</div>
		</div>
		<div class="loadmore">
			<div class="load">展开更多<i></i></div>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 美食 -->
<div class="part caterers">
	<div class="picbox clearfix">
		<div class="left">
			<div class="top_t">
				<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/caterers_qg.jpg" alt="">
				<!-- <div>
					<div class="time">
						<span class="time_t">距离结束</span>
						<span class="mdqgdjs">
							<s class="h">-</s>:<s class="m">-</s>:<s class="s">-</s>
						</span>
					</div>
				</div> -->
			</div>
			<div class="com">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('tuan', array('action'=>"tlist",'return'=>'list','rec'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo tuan(array('action'=>"tlist",'return'=>'list','rec'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['list']->value['litpic'];?>
" alt=""></div>
				<div class="txt">
					<p class="t"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p>
					<p class="price"><span class="now">&yen;65</span><span class="youhui"><i>再减10</i></span></p>
				</div>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo tuan(array('action'=>"tlist",'return'=>'list','rec'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</div>
		</div>
		<div class="right">
			<div class="item">
				<div class="txt">
					<p class="t">天天特价</p>
					<p class="st">特惠不打烊</p>
				</div>
				<div class="pic">
					<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/caterers_1.jpg" alt="">
				</div>
			</div>
			<div class="item">
				<div class="txt">
					<p class="t">工作餐</p>
					<p class="st">优惠不止5折~</p>
				</div>
				<div class="pic">
					<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/caterers_3.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="part caterersSale">
	<div class="hd">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/ttlj.png" alt=""></a></h2>
		<div class="morelink">
			<a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
">更多立减</a>
		</div>
	</div>
	<div class="bd">
		<div class="salebox hideScrollBar">
			<ul class="salelist clearfix">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('tuan', array('action'=>"tlist",'return'=>"list",'pageSize'=>"8")); $_block_repeat=true; echo tuan(array('action'=>"tlist",'return'=>"list",'pageSize'=>"8"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
">
						<div class="pic">
							<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['list']->value['litpic'];?>
" alt="">
						</div>
						<div class="txt">
							<p class="title"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p>
							<p class="des"><?php echo $_smarty_tpl->tpl_vars['list']->value['subtitle'];?>
</p>
							<p class="price"><span class="n">&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</span><span class="m">已售<?php echo $_smarty_tpl->tpl_vars['list']->value['sale'];?>
</span></p>
						</div>
					</a>
				</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo tuan(array('action'=>"tlist",'return'=>"list",'pageSize'=>"8"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</ul>
		</div>
	</div>
</div>
<?php }?>

<?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
<!-- 外卖 -->
<div class="part waimai">
	<div class="hd">
		<h2 class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
">美食外卖</a></h2>
		<div class="morelink">
			<a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
">推荐</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
">优惠</a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
">特价</a>
		</div>
	</div>
	<div class="bd">
		<div class="list" id="waimaiList">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>'store','return'=>'wstore','pageSize'=>'3')); $_block_repeat=true; echo waimai(array('action'=>'store','return'=>'wstore','pageSize'=>'3'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<dl>
				<a href="<?php echo $_smarty_tpl->tpl_vars['wstore']->value['url'];?>
">
					<dt class="clearfix">
						<div class="pic">
							<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['wstore']->value['logo'];?>
" alt="">
						</div>
						<div class="txt">
							<p class="title"><?php echo $_smarty_tpl->tpl_vars['wstore']->value['title'];?>
 </p>
							<p class="price">起送价&yen;<?php echo $_smarty_tpl->tpl_vars['wstore']->value['price'];?>
<span class="pt">|</span>配送费&yen;<?php echo $_smarty_tpl->tpl_vars['wstore']->value['peisong'];?>
<span class="pt">|</span>配送时间<?php echo $_smarty_tpl->tpl_vars['wstore']->value['times'];?>
分钟</p>
						</div>
					</dt>
					<dd>
						<?php if ($_smarty_tpl->tpl_vars['wstore']->value['sale']) {?>
						<div class="youhui">
							<span class="m yh-jian">减</span>
							<span class="d">满<?php echo smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['wstore']->value['sale'],",","减"),"$"."$","元；减");?>
元</span>
						</div>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['wstore']->value['supfapiao']==1) {?>
						<div class="youhui">
							<span class="m yh-sou">票</span>
							<span class="d"><?php echo $_smarty_tpl->tpl_vars['wstore']->value['fapiaonote'];?>
，<?php echo $_smarty_tpl->tpl_vars['wstore']->value['fapiao'];?>
元起开</span>
						</div>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['wstore']->value['supfapiao']==1) {?>
						<div class="youhui">
							<span class="m yh-zhe">付</span>
							<span class="d">该店铺支持在线支付</span>
						</div>
						<?php }?>
						<div class="toggle"><em></em></div>
					</dd>
				</a>
			</dl>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>'store','return'=>'wstore','pageSize'=>'3'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
		<div class="loadmore bb">
			<a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
"><div class="load">展开更多<i></i></div></a>
		</div>
	</div>
</div>
<?php }?>

<!-- 底部 -->
<footer id="footer">
	<p class="copyright">Copyright © 火鸟门户所有 2013-<?php echo smarty_modifier_date_format(time(),"%Y");?>
</p>
</footer>

<!-- 底部固定导航 -->

<div class="fixBtn">
	<div id="backTop" class="btn"></div>
</div>


<div class="leftBtn">
	<a href="javascript:;"></a>
</div>



<div class="snav_body">
<div class="snav_leftmenubg"></div>
<div class="snav_sidenv_box">
  <div class="snav_sidenv_top f_f">
		<?php if ($_smarty_tpl->tpl_vars['userinfo']->value) {?>
    <a href="<?php echo $_smarty_tpl->tpl_vars['userDomain']->value;?>
" class="sidenv_user">
      <em><img src="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['photo']=='') {
echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_40.jpg<?php } else {
echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['userinfo']->value['photo']),'type'=>"small"),$_smarty_tpl);
}?>"></em>
      <p>
        <span class="user_tit fyy"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['nickname'];?>
</span>
      </p>
		</a>
		<?php } else { ?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/login.html" class="sidenv_user">
      <em><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/noavatar_middle.gif"></em>
      <p>
        <span class="user_tit fyy">请登录或注册</span>
      </p>
      <p class="fyy">登录后更精彩...</p>
		</a>
		<?php }?>
  </div>
  <div class="sidenv_li" id="sidenv_li">
    <ul class="snav_left_Touch gxta">
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'message'),$_smarty_tpl);?>
"><i class="snav_1"></i>通知 <?php if ($_smarty_tpl->tpl_vars['userinfo']->value['message']>0) {?><em class="snav_num"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['message'];?>
</em><?php }?></a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'pocket'),$_smarty_tpl);?>
"><i class="snav_2"></i>我的口袋</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'tuan'),$_smarty_tpl);?>
"><i class="snav_3"></i>我的订单</a></li>
      <li><a href="#"><i class="snav_4"></i>购物车</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'collect'),$_smarty_tpl);?>
"><i class="snav_5"></i>我的收藏</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'info'),$_smarty_tpl);?>
"><i class="snav_6"></i>发布信息</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'service'),$_smarty_tpl);?>
"><i class="snav_7"></i>帮助中心</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security'),$_smarty_tpl);?>
"><i class="snav_8"></i>安全中心</a></li>
			<?php if ($_smarty_tpl->tpl_vars['userinfo']->value) {?>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/logout.html" class="logout">退出登录</a></li>
			<?php }?>
    </ul>
  </div>
</div>
</div>

<?php if (!$_smarty_tpl->tpl_vars['userinfo']->value) {?>
<!-- 登录注册弹出层 s -->
<div class="loginbox">
	<div class="contain">
		<div class="logintab">
			<ul class="clearfix">
				<li class="curr">登录</li>
				<li>注册</li>
				<li>找回密码</li>
			</ul>
		</div>
		<div class="typebox">
			<div class="form-box">
				<form id="loginForm" action="">
					<div class="inpbox">
						<i class="icon icon1"></i>
						<input type="text" name="" placeholder="用户名/邮箱/手机号" class="phone">
					</div>
					<div class="form-newpw inpbox">
						<i class="icon icon2"></i>
						<input type="password" name="" placeholder="密码" class="password">
						<a href="javascript:;" class="psw_img"></a>
					</div>
					<?php if ($_smarty_tpl->tpl_vars['loginCode']->value==1) {?>
					<div class="form-newpw inpbox">
						<i class="icon icon3"></i>
						<input type="text" name="" placeholder="验证码" class="vericode">
						<span class="code-box"><img src="/include/vdimgck.php" title="看不清？点击换一张" id="verifycode"></span>
					</div>
					<?php }?>
					<div class="login-btn"><input type="submit" value="登录"></div>
				</form>
			</div>
			<div class="form-box" style="display:none">
				<form id="regForm" action="">
					<div class="form-get">
						<input type="text" name="" placeholder="邮箱/手机号" class="number">
						<a href="javascript:;"><span class="get-yzm">获取验证码</span><span class="reget-yzm dn">重新获取(<em id="djs">60</em>)</span></a>
					</div>
					<input type="text" name="" placeholder="验证码" class="yzm">
					<div class="form-newpw">
						<input type="password" name="" placeholder="密码" class="password">
						<a href="javascript:;" class="psw_img"></a>
					</div>
					<div class="login-btn"><input type="submit" value="注册"></div>
				</form>
			</div>
			<div class="form-box" style="display:none">
				<div class="fpwdtab">
					<ul class="clearfix">
						<li class="curr"><i></i>手机找回</li>
						<li><i></i>邮箱找回</li>
					</ul>
				</div>
				<form id="fpwdForm" action="">
					<div class="form-box-item form-item-number">
						<div class="form-get form-get-phone">
							<input type="text" name="" placeholder="手机号码" class="number">
							<a href="javascript:;"><span class="get-yzm">获取验证码</span><span class="reget-yzm dn">重新获取(<em id="djs">60</em>)</span></a>
						</div>
						<input type="text" name="" class="yzm" placeholder="短信验证码">
					</div>
					<div class="form-box-item form-item-email dn">
						<div class="form-get form-get-email"><input type="text" name="" placeholder="邮箱" class="number"></div>
					</div>
		            <?php if (!$_smarty_tpl->tpl_vars['cfg_geetest']->value) {?>
					<div class="form-newpw">
						<input type="text" name="" placeholder="验证码" class="vericode">
						<span class="code-box"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/vdimgck.php" title="看不清？点击换一张" id="verifycode"></span>
					</div>
					<?php }?>
					<div class="login-btn"><input type="submit" value="确定"></div>
				</form>
			</div>
		</div>
		<div class="other-login">
			<div class="other-login-tit">
				<span>其他方式登录</span>
			</div>
			<div class="other-login-img">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"getLoginConnect",'return'=>"login")); $_block_repeat=true; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"login"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<?php if ($_smarty_tpl->tpl_vars['login']->value['code']=="wechat") {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
" class="wechat"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/weixin.png"></a>
				<?php } elseif ($_smarty_tpl->tpl_vars['login']->value['code']=="qq") {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/qq.png"></a>
				<?php } elseif ($_smarty_tpl->tpl_vars['login']->value['code']=="sina") {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/weibo.png"></a>
				<?php }?>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"login"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</div>
		</div>
	</div>
	<div class="bg"></div>
</div>
<!-- 登录注册弹出层 e -->


<div class="mask">
	<div class="popup">
		<div class="popup-txt">
			<div class="popup-icon"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/pup.png" alt=""></div>
			<p id="mailNote"></p>
		</div>
		<a href="javascript:;" class="know">我知道了</a>
	</div>
</div>

<div id="maskReg"></div>
<div id="popupReg-captcha-mobile"></div>

<div id="maskFpwd"></div>
<div id="popupFpwd-captcha-mobile"></div>

<?php }?>




<?php echo $_smarty_tpl->getSubTemplate ("../../touch_bottom.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/common.js?v=12" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/slider.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/jquery.scroll.loading.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/swiper.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/ui/iscroll.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js?v=13" type="text/javascript"><?php echo '</script'; ?>
>

<?php if (!$_smarty_tpl->tpl_vars['userinfo']->value) {?>
<?php if ($_smarty_tpl->tpl_vars['cfg_geetest']->value) {?><?php echo '<script'; ?>
 type="text/javascript" src="http://static.geetest.com/static/tools/gt.js"><?php echo '</script'; ?>
><?php }?>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/login.js?v=17" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/register.js?v=12" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/fpwd.js?v=12" type="text/javascript"><?php echo '</script'; ?>
>
<?php }?>



</body>
</html>
<?php }} ?>
