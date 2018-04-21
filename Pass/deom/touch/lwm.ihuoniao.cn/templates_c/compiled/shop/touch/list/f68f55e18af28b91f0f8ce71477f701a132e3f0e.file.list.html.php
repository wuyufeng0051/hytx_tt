<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 19:13:54
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\touch\default\list.html" */ ?>
<?php /*%%SmartyHeaderCode:769459523df2169038-18997864%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f68f55e18af28b91f0f8ce71477f701a132e3f0e' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\touch\\default\\list.html',
      1 => 1494490869,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '769459523df2169038-18997864',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'seo_title' => 0,
    'shop_title' => 0,
    'templets_skin' => 0,
    'cfg_basehost' => 0,
    'shop_channelDomain' => 0,
    'cfg_hideUrl' => 0,
    'cfg_cookiePre' => 0,
    'typeid' => 0,
    'typeArr' => 0,
    'type' => 0,
    'keywords' => 0,
    'cfg_staticPath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59523df21f1bd4_14377662',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59523df21f1bd4_14377662')) {function content_59523df21f1bd4_14377662($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php if ($_smarty_tpl->tpl_vars['seo_title']->value!='') {
echo $_smarty_tpl->tpl_vars['seo_title']->value;
} else { ?>商品列表<?php }?>-<?php echo $_smarty_tpl->tpl_vars['shop_title']->value;?>
</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/list.css?v=2">
    <?php echo '<script'; ?>
 type="text/javascript">
		var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', channelDomain = '<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
';
		var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
';
		var typeid = <?php if ($_smarty_tpl->tpl_vars['typeid']->value) {
echo $_smarty_tpl->tpl_vars['typeid']->value;
} else { ?>0<?php }?>;
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
				<span>商品列表</span>
			</div>
			<div class="header-search">
				<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/newhome.png" alt=""></a>
			</div>
		</div>
	<!-- 头部 end -->
	<!-- 内容 -->
		<div class="main">
			<div class="select-box">
				<div class="select-nav">
					<ul>
						<li class="active op-li" data-type="0"><a href="javascript:;"><span>默认</span><em>|</em></a></li>
						<li class="op-li" data-type="1"><a href="javascript:;"><span>销量</span><em>|</em></a></li>
						<li class="toggle-li"><a href="javascript:;" class="option-price"><span>价格<i></i></span><em>|</em></a></li>
						<li class="op-drop"><a href="javascript:;" class="option-xuan"><span>筛选<i></i></span></a></li>
					</ul>
				</div>
				<div class="select-drop">
					<div class="screen">
						<div class="drop-type drop-typeid">
							<h3>商品类别</h3>
							<ul>
								<li class="active"><a href="javascript:;">全部</a></li>
								<?php if ($_smarty_tpl->tpl_vars['typeArr']->value) {?>
								<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['typeArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
								<li data-id="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"><a href="javascript:;"><?php echo $_smarty_tpl->tpl_vars['type']->value['typename'];?>
</a></li>
								<?php } ?>
								<?php }?>
							</ul>
						</div>
						<div class="drop-range">
							<h3>价格区间</h3>
							<input type="number" class="price1" name=""onkeyup="value=value.replace(/[^\d.]/g,'')">
							<span>—</span>
							<input type="number" class="price2" name=""onkeyup="value=value.replace(/[^\d.]/g,'')">
						</div>
					</div>
					<div class="confirm">
						<a href="javascript:;">确定</a>
					</div>
				</div>
			</div>
			<div class="main-list">
				<div class="list-box">
					<ul></ul>
				</div>
			</div>
		</div>
	<!-- 内容 end-->

	<div class="top">
		<a href="javascript:scroll(0,0)"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/top.png" alt=""></a>
	</div>

	</div>
	<div class="mask"></div>
	<?php echo '<script'; ?>
>
		var atpage = 1,
			pageSize = 20,
			keywords = '<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
';
	<?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=2"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/list.js?v=9"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
