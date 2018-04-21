<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-09 11:50:17
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\default\top.html" */ ?>
<?php /*%%SmartyHeaderCode:29360593a1af9ea4542-53836767%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31ba06798316e06e0baba8557f5390b8cbf34332' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\default\\top.html',
      1 => 1494490888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29360593a1af9ea4542-53836767',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop_channelDomain' => 0,
    'shop_channelName' => 0,
    'shop_logoUrl' => 0,
    'keywords' => 0,
    'hotkeywords' => 0,
    'pageCurr' => 0,
    'tuan_channelDomain' => 0,
    'build_channelDomain' => 0,
    'furniture_channelDomain' => 0,
    'home_channelDomain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593a1af9eeaa53_31271380',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593a1af9eeaa53_31271380')) {function content_593a1af9eeaa53_31271380($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../../siteConfig/top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="wrap header fn-clear">
	<h1 class="logo"><a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['shop_channelName']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['shop_logoUrl']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['shop_channelName']->value;?>
" /></a></h1>
	<div class="search">
		<form name="search" method="get" action="<?php echo getUrlPath(array('service'=>'shop','template'=>'list'),$_smarty_tpl);?>
">
			<input name="keywords" type="text" class="txt_search" id="search_keyword" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" placeholder="请输入宝贝名称或相关词语" data-role="input" />
			<button id="search_button" type="submit" class="btn-s"><s></s>搜索</button>
		</form>
		<p class="hot-s">
			<span>热门搜索：</span>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('module'=>"shop",'action'=>"hotkeywords",'return'=>"hotkeywords")); $_block_repeat=true; echo siteConfig(array('module'=>"shop",'action'=>"hotkeywords",'return'=>"hotkeywords"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<a href="<?php echo $_smarty_tpl->tpl_vars['hotkeywords']->value['href'];?>
"<?php if ($_smarty_tpl->tpl_vars['hotkeywords']->value['target']==0) {?> target="_blank"<?php }?>><?php echo $_smarty_tpl->tpl_vars['hotkeywords']->value['keyword'];?>
</a>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('module'=>"shop",'action'=>"hotkeywords",'return'=>"hotkeywords"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</p>
	</div>
	<div class="topcart">
		<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'cart'),$_smarty_tpl);?>
" class="cart-btn"><span class="icon"></span><i>0</i>我的购物车<s><em></em></s></a>
		<div class="cart-con">
			<div class="spacer"></div>
			<p class="empty">购物车中还没有商品，赶紧选购吧！</p>
			<div class="cartlist"><ul></ul><div class="cartft fn-clear">共<em></em>件商品总计：<span class="pric">&yen;<strong>0.00</strong></span> <small>(不含运费)</small><a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'cart'),$_smarty_tpl);?>
" class="cartbtn">去购物车结算</a></div></div>
		</div>
	</div>
</div>

<div class="nav">
	<div class="wrap">
		<ul class="fn-clear">
			<li<?php if ($_smarty_tpl->tpl_vars['pageCurr']->value=='index') {?> class="curr"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
">首页</a></li>
			<li><a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list','param'=>"flag=3"),$_smarty_tpl);?>
">抢运气<s class="new"></s></a></li>
			<li><a href="#">找优惠</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['pageCurr']->value=='brand') {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'brand'),$_smarty_tpl);?>
">品牌库</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['pageCurr']->value=='store') {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'store'),$_smarty_tpl);?>
">商家店铺</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
" target="_blank">推荐团购</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['build_channelDomain']->value;?>
" target="_blank">建材市场</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['furniture_channelDomain']->value;?>
" target="_blank">家具商城</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['home_channelDomain']->value;?>
" target="_blank">生活家居</a></li>
		</ul>
	</div>
</div>
<?php }} ?>
