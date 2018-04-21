<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:27:59
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\orderdetail.html" */ ?>
<?php /*%%SmartyHeaderCode:309465924009f1b61c0-28521042%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcf08fc7cee4152362fc4d872d3eb0b18c313515' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\orderdetail.html',
      1 => 1494490896,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '309465924009f1b61c0-28521042',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'cfg_soft_lang' => 0,
    'cfg_webname' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'cfg_hideUrl' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924009f1d1759_42989560',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924009f1d1759_42989560')) {function content_5924009f1d1759_42989560($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['module']->value=='') {?>
<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable("tuan", null, 0);?>
<?php }?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>订单详情 - <?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
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
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/orderdetail-<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
.css" media="all" />
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
, id = <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->tpl_vars['pageTitle'] = new Smarty_variable("订单详情", null, 0);?>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="wrap">
	<div class="container fn-clear">

		<?php echo $_smarty_tpl->getSubTemplate ("orderdetail-".((string)$_smarty_tpl->tpl_vars['module']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/orderdetail-<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
