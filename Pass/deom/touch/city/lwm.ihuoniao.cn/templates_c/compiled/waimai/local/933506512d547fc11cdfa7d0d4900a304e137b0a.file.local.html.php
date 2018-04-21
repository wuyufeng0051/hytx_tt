<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-31 18:05:23
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\local.html" */ ?>
<?php /*%%SmartyHeaderCode:5074592e95630540b7-39281082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '933506512d547fc11cdfa7d0d4900a304e137b0a' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\local.html',
      1 => 1494483675,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5074592e95630540b7-39281082',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'cfg_mapCity' => 0,
    'site_map_key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592e9563067933_68823384',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592e9563067933_68823384')) {function content_592e9563067933_68823384($_smarty_tpl) {?><!DOCTYPE html>
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
css/loca_ing.css">
</head>

<body>
<div class="location_input">
	<input type="text" id="keywords" name="keywords" placeholder="输入地址搜索周边商家">
</div>
<div class="click"><span>点击定位当前位置</span></div>
<div class="history"><ul></ul></div>
<div class="all_shan"><p>清空历史记录</p></div>

<?php echo '<script'; ?>
 type="text/javascript">
	var mapCity = '<?php echo $_smarty_tpl->tpl_vars['cfg_mapCity']->value;?>
';
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/local.js?v=1"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
