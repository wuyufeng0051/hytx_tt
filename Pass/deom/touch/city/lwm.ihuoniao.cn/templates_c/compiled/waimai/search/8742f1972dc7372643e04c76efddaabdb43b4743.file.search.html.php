<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 09:36:14
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\search.html" */ ?>
<?php /*%%SmartyHeaderCode:231755923920e3a6788-20334999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8742f1972dc7372643e04c76efddaabdb43b4743' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\search.html',
      1 => 1494827012,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '231755923920e3a6788-20334999',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5923920e43ed24_10470185',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5923920e43ed24_10470185')) {function content_5923920e43ed24_10470185($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>搜索</title>
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
css/le_search.css">
</head>

<body>
<div class="search fn-clear">
	<i onclick="history.go(-1)"></i>
	<form action="slist.html" id="searchForm" onsubmit="return check();">
		<input type="text" name="keywords" id="keywords" placeholder="请输入店铺名和商品名搜索">
		<button type="submit">搜索</button>
	</form>
</div>
<div class="history"><ul></ul></div>
<div class="all_shan"><p>清空历史记录</p></div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/search.js?v=1"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
