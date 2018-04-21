<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-15 14:27:13
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\funSearch.html" */ ?>
<?php /*%%SmartyHeaderCode:313159194a41db3109-76901027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbdba08198a619c2445e4f75d5b246a842b4425c' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\funSearch.html',
      1 => 1494490267,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '313159194a41db3109-76901027',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'keyword' => 0,
    'count' => 0,
    'funSearch' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59194a41dc6995_69687647',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59194a41dc6995_69687647')) {function content_59194a41dc6995_69687647($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<title>目录导航</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<div class="fun-search">
  <?php if ($_smarty_tpl->tpl_vars['keyword']->value!='') {?>
  <div style="margin:0 0 10px; font-size:16px;">&nbsp;&nbsp;搜索：<font color="red"><?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
</font> 的结果<small>（<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
条记录）</small>：</div>
  <?php }?>
  <?php echo $_smarty_tpl->tpl_vars['funSearch']->value;?>

</div>

<?php echo '<script'; ?>
>
	var adminPath = "../";
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
