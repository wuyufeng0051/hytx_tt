<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 16:33:43
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\touch\default\cart.html" */ ?>
<?php /*%%SmartyHeaderCode:201935923f3e7e1d2a2-42813782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9db05a750791da483d9293d204fd0a76cb2c0ac7' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\touch\\default\\cart.html',
      1 => 1494490869,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201935923f3e7e1d2a2-42813782',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templets_skin' => 0,
    'cfg_basehost' => 0,
    'shop_channelDomain' => 0,
    'cfg_staticPath' => 0,
    'cfg_hideUrl' => 0,
    'cfg_cookiePre' => 0,
    'cfg_cookieDomain' => 0,
    'cartList' => 0,
    'cart' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5923f3e7ed8ad7_79372224',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5923f3e7ed8ad7_79372224')) {function content_5923f3e7ed8ad7_79372224($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购物车</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/cart.css?v=1">
    <?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', channelDomain = '<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
', cfg_staticPath = staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';
	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
', cookieDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookieDomain']->value;?>
';
	<?php echo '</script'; ?>
>
</head>
<body>
	<div class="container">
		<!-- 头部 -->
		<div class="header">
			<div class="header-l">
				<a href="javascript:history.go(-1)"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/left.png" alt=""></a>
			</div>
			<div class="header-address">
				<span>购物车</span>
			</div>
			<div class="header-search">
				<a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/newhome.png" alt=""></a>
			</div>
		</div>
	<!-- 头部 end -->
		<div class="cart-main">
			<form action="<?php echo getUrlPath(array('service'=>'shop','template'=>'confirm-order'),$_smarty_tpl);?>
" data-action="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/ajax.php?service=shop&action=confirm_order" method="post">
				<ul>
					<?php  $_smarty_tpl->tpl_vars["cart"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["cart"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cartList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["cart"]->key => $_smarty_tpl->tpl_vars["cart"]->value) {
$_smarty_tpl->tpl_vars["cart"]->_loop = true;
?>
					<li class="cart-list">
						<div class="shop-name">
							<div class="shop-name-circle">
								<span></span>
							</div>
							<div class="shop-name-info">
								<a href="<?php if ($_smarty_tpl->tpl_vars['cart']->value['domain']) {
echo $_smarty_tpl->tpl_vars['cart']->value['domain'];
} else { ?>javascript:;<?php }?>">
									<span><?php echo $_smarty_tpl->tpl_vars['cart']->value['store'];?>
</span>
									<i></i>
								</a>
							</div>
						</div>
						<div class="shop-list">
							<ul>
								<?php  $_smarty_tpl->tpl_vars["list"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["list"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["list"]->key => $_smarty_tpl->tpl_vars["list"]->value) {
$_smarty_tpl->tpl_vars["list"]->_loop = true;
?>
								<li class="shop-list-li" data-id="<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" data-price="<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
" data-coupon="<?php echo $_smarty_tpl->tpl_vars['list']->value['coupon'];?>
" data-specation="<?php echo $_smarty_tpl->tpl_vars['list']->value['specation'];?>
" data-limit="<?php echo $_smarty_tpl->tpl_vars['list']->value['limit'];?>
" data-inventor="<?php echo $_smarty_tpl->tpl_vars['list']->value['inventor'];?>
" data-bearfreight="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['bearFreight'];?>
" data-valuation="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['valuation'];?>
" data-express_start="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['express_start'];?>
" data-express_postage="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['express_postage'];?>
" data-express_plus="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['express_plus'];?>
" data-express_postageplus="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['express_postageplus'];?>
" data-preferentialstandard="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['preferentialStandard'];?>
" data-preferentialmoney="<?php echo $_smarty_tpl->tpl_vars['list']->value['logisticTemp']['preferentialMoney'];?>
" data-weight="<?php echo $_smarty_tpl->tpl_vars['list']->value['weight'];?>
" data-volume="<?php echo $_smarty_tpl->tpl_vars['list']->value['volume'];?>
">
									<div class="shop-name-circle">
										<span></span>
									</div>
									<div class="shop-info">
										<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
">
											<div class="shop-info-img">
												<img src="<?php echo $_smarty_tpl->tpl_vars['list']->value['thumb'];?>
" alt="">
											</div>
										</a>
										<div class="shop-info-txt">
											<h3><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</h3>
											<div class="shop-info-color">
												<?php echo $_smarty_tpl->tpl_vars['list']->value['specation'];?>

											</div>
											<div class="shop-info-price">
												<span class="price"><?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</span>
												<span class="mprice">&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</span>
											</div>
											<div class="shop-info-num">
												<span class="rec"><i>－</i></span><span class="num"><em><?php echo $_smarty_tpl->tpl_vars['list']->value['count'];?>
</em></span><span class="append"><i>＋</i></span>
												<span class="icon-del"><i></i></span>
											</div>
										</div>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</li>
				<?php } ?>
				</ul>
			</form>
		</div>
		<div class="empty">
			<span><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/ico_cart.jpg" alt=""></span>
			<div class="empty-txt">
				<p>购物车里还没有宝贝哦</p>
				<p>快去挑挑吧~</p>
			</div>
		</div>
	<!-- 精选推荐 -->
		<div class="command-list">
			<div class="command-list-tit">
				<h2></h2>
				<span>为你推荐</span>
			</div>
			<div class="command-list-con">
				<ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"10")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"10"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

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
</em><?php if ($_smarty_tpl->tpl_vars['list']->value['panic']) {?><span class="yellow">限时抢</span><?php }?>
								</div>
								<div class="pro-info">
									<span>已售<em><?php echo $_smarty_tpl->tpl_vars['list']->value['sales'];?>
</em>件</span><?php if ($_smarty_tpl->tpl_vars['list']->value['tejia']) {?><span class="ter">商城特价</span><?php }?>
								</div>
							</div>
						</a>
					</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"10"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
			<div class="command-list-tit">
				<h2></h2>
				<span>已看到最后</span>
			</div>
		</div>
	<!-- 精选推荐 end-->

	<!-- 底部 -->
		<div class="footer">
			<div class="footer-select">
				<div class="shop-name-circle">
					<span></span><em>全选</em>
				</div>
			</div>
			<div class="account-btn r">
				<a href="javascript:;" data-href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
/confirm-order.html" id="js" class="disabled">结算(<em>0</em>)</a>
			</div>
			<div class="total-num r">
				<span>合计：￥<em>0.00</em></span>
				<span>不含运费</span>
			</div>
		</div>
	<!-- 底部 end -->
	</div>
	<div class="topcart"><div class="cart-con"><div class="cartlist"><ul></ul></div></div></div>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.scroll.loading.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=4"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/common.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/iscroll.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/cart.js?v=4"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
