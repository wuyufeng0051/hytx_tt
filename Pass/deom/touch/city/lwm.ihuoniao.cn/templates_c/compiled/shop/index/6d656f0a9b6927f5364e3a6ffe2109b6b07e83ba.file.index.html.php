<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 18:40:56
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\default\index.html" */ ?>
<?php /*%%SmartyHeaderCode:2712859523638172fd1-62411662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d656f0a9b6927f5364e3a6ffe2109b6b07e83ba' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\default\\index.html',
      1 => 1494490887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2712859523638172fd1-62411662',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'shop_title' => 0,
    'shop_keywords' => 0,
    'shop_description' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'shop_channelDomain' => 0,
    'cfg_hideUrl' => 0,
    'cfg_cookiePre' => 0,
    'cfg_cookieDomain' => 0,
    'store' => 0,
    '_bindex' => 0,
    'type' => 0,
    'type1' => 0,
    'list' => 0,
    'news' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5952363833c0c1_62764455',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5952363833c0c1_62764455')) {function content_5952363833c0c1_62764455($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title><?php echo $_smarty_tpl->tpl_vars['shop_title']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['shop_keywords']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['shop_description']->value;?>
" />
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/common.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/public.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', channelDomain = '<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
';

	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");

	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
', cookieDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookieDomain']->value;?>
';
<?php echo '</script'; ?>
>
</head>

<body>
<?php $_smarty_tpl->tpl_vars['pageCurr'] = new Smarty_variable('index', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="banner">
	<div class="wrap">
		<div class="slide" id="slide"><?php echo getMyAd(array('id'=>"103",'type'=>"slide"),$_smarty_tpl);?>
</div>
		<div class="slidebtn" id="slidebtn"></div>
	</div>
</div>

<div class="container">

	<!-- 推荐优质商家 s -->
	<div class="wrap">
		<div class="mt">
			<h3>推荐优质商家</h3>
			<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'store'),$_smarty_tpl);?>
" target="_blank" class="more">更多商家</a>
		</div>
		<div class="recbus">
			<ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"store",'return'=>"store",'rec'=>"1",'pageSize'=>"16")); $_block_repeat=true; echo shop(array('action'=>"store",'return'=>"store",'rec'=>"1",'pageSize'=>"16"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li><a href="<?php echo $_smarty_tpl->tpl_vars['store']->value['url'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['store']->value['logo'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['store']->value['title'];?>
" /><p><?php echo $_smarty_tpl->tpl_vars['store']->value['title'];?>
</p></a></li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"store",'return'=>"store",'rec'=>"1",'pageSize'=>"16"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</ul>
		</div>
	</div>
	<!-- 推荐优质商家 e -->

	<!-- 产品所有分类 s -->
	<div class="wrap">
		<div class="mt1">
			<h3>产品所有分类</h3>
			<div class="tcorl"></div>
		</div>
		<div class="tlist">
			<div class="item fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"type",'return'=>"type")); $_block_repeat=true; echo shop(array('action'=>"type",'return'=>"type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['type']==9) {?>
			</div>
			<div class="item fn-clear">
				<?php }?>
				<dl>
					<dt><a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list','param'=>"typeid=".((string)$_smarty_tpl->tpl_vars['type']->value['id'])),$_smarty_tpl);?>
" target="_blank" class="t<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['type']->value['typename'];?>
"><s></s><h5><?php echo $_smarty_tpl->tpl_vars['type']->value['typename'];?>
</h5></a></dt>
					<dd>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"type",'return'=>"type1",'type'=>$_smarty_tpl->tpl_vars['type']->value['id'])); $_block_repeat=true; echo shop(array('action'=>"type",'return'=>"type1",'type'=>$_smarty_tpl->tpl_vars['type']->value['id']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list','param'=>"typeid=".((string)$_smarty_tpl->tpl_vars['type1']->value['id'])),$_smarty_tpl);?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['type1']->value['typename'];?>
"><?php echo $_smarty_tpl->tpl_vars['type1']->value['typename'];?>
</a>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"type",'return'=>"type1",'type'=>$_smarty_tpl->tpl_vars['type']->value['id']), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</dd>
				</dl>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"type",'return'=>"type"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</div>
		</div>
	</div>
	<!-- 产品所有分类 e -->

	<!-- 限时大抢购 s -->
	<div class="wrap">
		<div class="mt1"><h3>限时大抢购</h3></div>
		<div class="panic">
			<ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"3",'limited'=>"2",'pageSize'=>"9")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"3",'limited'=>"2",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
						<div class="p">
							<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"o_large"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
" />
							<div class="t"><h4><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</h4><span></span></div>
						</div>
						<div class="i">
							<strong>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</strong>
							<del>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['mprice'];?>
</del>
							<s><i></i></s>
							<span>销量：<em><?php echo $_smarty_tpl->tpl_vars['list']->value['sales'];?>
</em></span>
						</div>
					</a>
				</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"3",'limited'=>"2",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</ul>
		</div>
		<div class="ad"><?php echo getMyAd(array('id'=>"104"),$_smarty_tpl);?>
</div>
	</div>
	<!-- 限时大抢购 e -->

	<!-- 推荐商品 s -->
	<div class="wrap">
		<div class="mt">
			<h3>推荐商品</h3>
			<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list','typeid'=>'0','attr'=>'0'),$_smarty_tpl);?>
" target="_blank" class="more">更多推荐</a>
		</div>
		<div class="rlist">
			<ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"10")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"10"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
						<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
" />
						<h5><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</h5>
						<p><strong>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</strong><del>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['mprice'];?>
</del></p>
					</a>
				</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"10"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</ul>
		</div>
		<div class="ad"><?php echo getMyAd(array('id'=>"105"),$_smarty_tpl);?>
</div>
	</div>
	<!-- 推荐商品 e -->

	<!-- 特价商品 s -->
	<div class="wrap">
		<div class="mt">
			<h3>特价商品</h3>
			<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list','typeid'=>'0','attr'=>'1'),$_smarty_tpl);?>
" target="_blank" class="more">更多推荐</a>
		</div>
		<div class="rlist">
			<ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"10")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"10"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
						<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
" />
						<h5><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</h5>
						<p><strong>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</strong><del>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['mprice'];?>
</del></p>
					</a>
				</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"10"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</ul>
		</div>
	</div>
	<!-- 特价商品 e -->

	<!-- 商城资讯 s -->
	<div class="wrap">
		<div class="mt1">
			<h3>商城资讯</h3>
		</div>
		<div class="news">
			<ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"news",'return'=>"news",'pageSize'=>"7")); $_block_repeat=true; echo shop(array('action'=>"news",'return'=>"news",'pageSize'=>"7"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li><a href="<?php echo $_smarty_tpl->tpl_vars['news']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['news']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
" /><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a></li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"news",'return'=>"news",'pageSize'=>"7"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<li class="more"><a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'news'),$_smarty_tpl);?>
" target="_blank" title="更多资讯">更多资讯<s></s></a></li>
			</ul>
		</div>
	</div>
	<!-- 商城资讯 e -->

</div>

<?php echo $_smarty_tpl->getSubTemplate ("bottom.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.cycle.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js?v=2"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
