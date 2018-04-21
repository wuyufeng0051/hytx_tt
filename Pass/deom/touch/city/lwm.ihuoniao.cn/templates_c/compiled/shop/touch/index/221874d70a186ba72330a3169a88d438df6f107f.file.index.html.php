<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 18:56:32
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\touch\default\index.html" */ ?>
<?php /*%%SmartyHeaderCode:11684595239e00e1ea4-18409168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '221874d70a186ba72330a3169a88d438df6f107f' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\touch\\default\\index.html',
      1 => 1494490868,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11684595239e00e1ea4-18409168',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop_title' => 0,
    'templets_skin' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'shop_channelDomain' => 0,
    'cfg_hideUrl' => 0,
    'cfg_cookiePre' => 0,
    '_bindex' => 0,
    'type' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_595239e017a444_04104868',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_595239e017a444_04104868')) {function content_595239e017a444_04104868($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $_smarty_tpl->tpl_vars['shop_title']->value;?>
</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/css/touch_common.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css?v=8">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/swiper.min.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', channelDomain = '<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
';
	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
';
<?php echo '</script'; ?>
>
</head>
<body>
	<div class="container">
	<!-- 头部 -->
	<?php $_smarty_tpl->tpl_vars['pageTitle'] = new Smarty_variable("商城首页", null, 0);?>
	<?php echo $_smarty_tpl->getSubTemplate ("../../../siteConfig/touch_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<!-- 头部 end -->

	<!-- 幻灯片 -->
	<div class="banna clearfix">
		<!-- picscroll -->
		<div class="picscroll">
		    <div class="bd" id="picscroll">
		    	<ul>
					<?php echo getMyAd(array('id'=>"121"),$_smarty_tpl);?>

		    	</ul>
		    </div>
		    <div class="pages">
		    	<span class="page">1</span>/
		    	<span class="count"></span>
		    </div>
		</div>
	</div>
	<!-- 幻灯片 end -->

	<!-- 标签 -->
	<div class="slogan">
		<span class="bg1">全网底价</span>
		<span class="bg2">一件包邮</span>
		<span class="bg3">人工质检</span>
		<span class="bg4">退货补贴</span>
	</div>
	<!-- 标签 end-->

	<!-- 导航 -->
	<div class="nav">
		<div class="nav-list fn-clear">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"type",'return'=>"type")); $_block_repeat=true; echo shop(array('action'=>"type",'return'=>"type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['type']==8) {?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
/category.html" class="nav-item">
				<div class="nav-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/nav8.jpg"></div>更多
			</a>
			<?php } elseif ($_smarty_tpl->tpl_vars['_bindex']->value['type']<8) {?>
			<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list','param'=>"typeid=".((string)$_smarty_tpl->tpl_vars['type']->value['id'])),$_smarty_tpl);?>
" class="nav-item">
				<div class="nav-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/navt<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
.jpg"></div><?php echo $_smarty_tpl->tpl_vars['type']->value['typename'];?>

			</a>
			<?php }?>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"type",'return'=>"type"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
	</div>
	<!-- 导航 end-->

	<!-- 广告位 -->
		<div class="hot-renew">
			<div class="rec-item-1 l">
				<?php echo getMyAd(array('id'=>"187"),$_smarty_tpl);?>

			</div>
			<ul class="list">
			<?php echo getMyAd(array('id'=>"188"),$_smarty_tpl);?>

			</ul>
		</div>
		<div class="hot-tuan">
			<ul class="tuan-box fn-clear">
				<?php echo getMyAd(array('id'=>"189"),$_smarty_tpl);?>

			</ul>
		</div>
	<!-- 广告位 end-->

	<!-- 精选推荐 -->
		<div class="command-list">
			<div class="command-list-tit">
				<span>精选推荐</span>
			</div>
			<div class="command-list-con">
				<ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"22")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"22"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
">
							<div class="pro-img">
								<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
" />
							</div>
							<div class="pro-txt">
								<h4 class="mt10"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</h4>
								<div class="pro-price mt10">
									<span>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</span><em>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['mprice'];?>
</em>
								</div>
								<div class="pro-info">
									<?php if ($_smarty_tpl->tpl_vars['list']->value['panic']) {?><span class="yellow">限时抢</span><?php }?><span>已售<em class="yellow"><?php echo $_smarty_tpl->tpl_vars['list']->value['sales'];?>
</em>件</span><?php if ($_smarty_tpl->tpl_vars['list']->value['tejia']) {?><span class="ter">商城特价</span><?php }?>
								</div>
							</div>
						</a>
					</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"22"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
			<div class="more">
				<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
/list.html">点击查看更多>></a>
			</div>
		</div>
	<!-- 精选推荐 end-->


	<?php echo $_smarty_tpl->getSubTemplate ("../../../siteConfig/touch_bottom.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


	</div>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.scroll.loading.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/slider.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/js/touch_common.js" type="text/javascript"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
