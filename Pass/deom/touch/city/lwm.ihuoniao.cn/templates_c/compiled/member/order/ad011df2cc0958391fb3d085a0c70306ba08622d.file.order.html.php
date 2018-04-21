<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:29:24
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\order.html" */ ?>
<?php /*%%SmartyHeaderCode:131095923fd3cf02414-64063271%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad011df2cc0958391fb3d085a0c70306ba08622d' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\order.html',
      1 => 1495531748,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131095923fd3cf02414-64063271',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5923fd3d064132_53925710',
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
<?php if ($_valid && !is_callable('content_5923fd3d064132_53925710')) {function content_5923fd3d064132_53925710($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>管理我的订单 - <?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/common.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/public.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/manage.css" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';

	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");

	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, state = '<?php echo $_smarty_tpl->tpl_vars['state']->value;?>
';
	var atpage = 1, totalCount = 0, pageSize = 15;
<?php echo '</script'; ?>
>
</head>

<body>
<?php $_smarty_tpl->tpl_vars['pageTitle'] = new Smarty_variable("管理我的订单", null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="wrap">
	<div class="container fn-clear">

		<?php echo $_smarty_tpl->getSubTemplate ("sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


		<div class="main">

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

			<?php if ($_smarty_tpl->tpl_vars['module']->value==''&&in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
			<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("home", null, 0);?>
			<?php }?>

			<ul class="main-tab">
				<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="tuan") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'tuan'),$_smarty_tpl);?>
">团购</a></li><?php }?>
				<?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="shop") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'shop'),$_smarty_tpl);?>
">商城</a></li><?php }?>
				<?php if (in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="build") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'build'),$_smarty_tpl);?>
">建材</a></li><?php }?>
				<?php if (in_array("furniture",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="furniture") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'furniture'),$_smarty_tpl);?>
">家具</a></li><?php }?>
				<?php if (in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li<?php if ($_smarty_tpl->tpl_vars['module']->value=="home") {?> class="curr"<?php }?>><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'home'),$_smarty_tpl);?>
">家居</a></li><?php }?>
			</ul>

			<?php echo $_smarty_tpl->getSubTemplate ("order-".((string)$_smarty_tpl->tpl_vars['module']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


			<div class="list <?php echo $_smarty_tpl->tpl_vars['module']->value;?>
" id="list"><p class="loading"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/ajax-loader.gif" />加载中，请稍候...</p></div>
			<div class="pagination fn-clear"></div>

		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/order-<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
.js?v=1"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
