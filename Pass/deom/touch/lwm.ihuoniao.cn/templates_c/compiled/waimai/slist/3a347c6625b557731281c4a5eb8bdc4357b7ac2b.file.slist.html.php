<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-27 13:53:52
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\slist.html" */ ?>
<?php /*%%SmartyHeaderCode:23648592914706698e1-87261816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a347c6625b557731281c4a5eb8bdc4357b7ac2b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\slist.html',
      1 => 1494827193,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23648592914706698e1-87261816',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'keywords' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592914706afdf4_80195242',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592914706afdf4_80195242')) {function content_592914706afdf4_80195242($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>搜索结果</title>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/zepto.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/le_list.css">
</head>

<body>
<div class="le_list"></div>

<?php echo '<script'; ?>
 type="text/javascript">
	var keywords = '<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
', page = 1, pageSize = 10;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/le_slist.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
