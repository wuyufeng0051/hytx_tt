<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-01 16:21:06
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\order.html" */ ?>
<?php /*%%SmartyHeaderCode:85635924028d551090-60432716%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b0cef92a2c8c193f5090adc126779948aafc5f8' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\order.html',
      1 => 1496228114,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85635924028d551090-60432716',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924028d610747_79936255',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cfg_webname' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'cfg_hideUrl' => 0,
    'state' => 0,
    'module' => 0,
    'installModuleArr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924028d610747_79936255')) {function content_5924028d610747_79936255($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>管理我的订单 - <?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/common.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/order.css" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';
	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, state = '<?php echo $_smarty_tpl->tpl_vars['state']->value;?>
';
	var atpage = 1, totalCount = 0, pageSize = 15;
<?php echo '</script'; ?>
>
</head>

<body>

  <?php if ($_smarty_tpl->tpl_vars['module']->value==''&&in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
	<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("tuan", null, 0);?>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['module']->value==''&&in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
	<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("shop", null, 0);?>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['module']->value==''&&in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
	<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("build", null, 0);?>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['module']->value==''&&in_array("furniture",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
	<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("furniture", null, 0);?>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['module']->value==''&&in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
	<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("waimai", null, 0);?>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['module']->value==''&&in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
	<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("home", null, 0);?>
  <?php }?>

  <!-- 头部 s -->
  <div class="header">
    <div class="header-l">
      <a href="javascript:;" onclick="history.go(-1)"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/back-r.png"></a>
    </div>
    <div class="header-c">
			<span class="orderbtn">
	      <?php if ($_smarty_tpl->tpl_vars['module']->value=="tuan") {?>团购订单<?php }?>
	      <?php if ($_smarty_tpl->tpl_vars['module']->value=="shop") {?>商城订单<?php }?>
	      <?php if ($_smarty_tpl->tpl_vars['module']->value=="build") {?>建材订单<?php }?>
	      <?php if ($_smarty_tpl->tpl_vars['module']->value=="furniture") {?>家具订单<?php }?>
	      <?php if ($_smarty_tpl->tpl_vars['module']->value=="waimai") {?>外卖订单<?php }?>
	      <?php if ($_smarty_tpl->tpl_vars['module']->value=="home") {?>家居订单<?php }?><em></em>
			</span>
    </div>

  </div>
  <!-- 头部 s -->

	<div class="orderbox">
		<ul class="fn-clear">
			<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="tuan") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'tuan'),$_smarty_tpl);?>
">团购</a></li><?php }?>
			<?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="shop") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'shop'),$_smarty_tpl);?>
">商城</a></li><?php }?>
			<?php if (in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="build") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'build'),$_smarty_tpl);?>
">建材</a></li><?php }?>
			<?php if (in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="home") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'home'),$_smarty_tpl);?>
">家居</a></li><?php }?>
			<?php if (in_array("furniture",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="furniture") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'furniture'),$_smarty_tpl);?>
">家具</a></li><?php }?>
			<?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="waimai") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'waimai'),$_smarty_tpl);?>
">外卖</a></li><?php }?>
		</ul>
	</div>

	<div class="mask"></div>


		<div class="main">

			<?php echo $_smarty_tpl->getSubTemplate ("order-".((string)$_smarty_tpl->tpl_vars['module']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


			<div class="list <?php echo $_smarty_tpl->tpl_vars['module']->value;?>
" id="list"></div>

		</div>


<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=1"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/order.js?v=1"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/order-<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
.js?v=2"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
