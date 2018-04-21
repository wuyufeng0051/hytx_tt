<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-15 09:45:25
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\list.html" */ ?>
<?php /*%%SmartyHeaderCode:259159190835a824a9-90229470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '776508717e7455e221a77c57e00f05937a636637' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\list.html',
      1 => 1494587067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '259159190835a824a9-90229470',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'typename' => 0,
    'typeArr' => 0,
    'type' => 0,
    'typeid' => 0,
    'site_map_key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59190835acc837_21854576',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59190835acc837_21854576')) {function content_59190835acc837_21854576($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>店铺列表</title>
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
<div class="search fn-clear">
	<div class="location"><a href="local.html"></a></div>
	<div class="se_1"><a href="search.html"></a></div>
</div>
<div class="lead_pic"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/cXxRUBZSkwM2JL7XyqwfeGzM8fciqThE-w174.png" alt=""></div>
<div class="navigation fn-clear">
	<div class="nav_lead fn-clear">
		<ul>
			<li><em><?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
</em><i></i></li>
			<li><em>距离最近</em><i></i></li>
			<li><em>不限状态</em><i></i></li>
		</ul>
	</div>
	<div class="nav_txt">
		<div class="nav">
			<ul data-type='type'>
				<li data-id=""><a href="javascript:;"><b></b>全部分类<i></i></a></li>
				<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['typeArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
				<li data-id="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['typeid']->value==$_smarty_tpl->tpl_vars['type']->value['id']) {?> class="nav_bc"<?php }?>><a href="javascript:;"><b></b><?php echo $_smarty_tpl->tpl_vars['type']->value['title'];?>
<i></i></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="nav none">
			<ul data-type='orderby'>
				<li data-id=""><a href="javascript:;"><b></b>默认排序<i></i></a></li>
				<li data-id="1"><a href="javascript:;"><b></b>距离最近<i></i></a></li>
				<li data-id="2"><a href="javascript:;"><b></b>销量最高<i></i></a></li>
				<li data-id="3"><a href="javascript:;"><b></b>起送价最低<i></i></a></li>
				<li data-id="4"><a href="javascript:;"><b></b>评论最多<i></i></a></li>
			</ul>
		</div>
		<div class="nav none">
			<ul data-type='yingye'>
				<li data-id=""><a href="javascript:;"><b></b>不限状态<i></i></a></li>
				<li data-id="1"><a href="javascript:;"><b></b>营业中<i></i></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="le_list"></div>
<div class="disk none"></div>

<?php echo '<script'; ?>
 type="text/javascript">
	var typeid = <?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
, orderby = '', yingye = '', lng = '', lat = '', page = 1, pageSize = 10;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/le_list.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
