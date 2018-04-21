<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 11:08:22
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\orderdetail.html" */ ?>
<?php /*%%SmartyHeaderCode:74715924f92655c023-00841140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2909a038ee6f7c7ca7676de2149bcd54cd3e8af' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\orderdetail.html',
      1 => 1494490905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74715924f92655c023-00841140',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cfg_webname' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'module' => 0,
    'cfg_hideUrl' => 0,
    'id' => 0,
    'thumbSize' => 0,
    'thumbType' => 0,
    'atlasSize' => 0,
    'atlasType' => 0,
    'atlasMax' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924f926592b20_97851470',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924f926592b20_97851470')) {function content_5924f926592b20_97851470($_smarty_tpl) {?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>订单详情 - <?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/common.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/orderdetail-<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
.css?v=6" media="all" />
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
, id = <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;
	var modelType = '<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
';
	var thumbSize = <?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
, thumbType = '<?php echo $_smarty_tpl->tpl_vars['thumbType']->value;?>
', atlasSize = <?php echo $_smarty_tpl->tpl_vars['atlasSize']->value*1024*1024;?>
, atlasType = '<?php echo $_smarty_tpl->tpl_vars['atlasType']->value;?>
', atlasMax = <?php echo $_smarty_tpl->tpl_vars['atlasMax']->value;?>
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
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/webuploader/webuploader.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=5"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/common.js?v=4" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/orderdetail-<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
.js?v=5"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
