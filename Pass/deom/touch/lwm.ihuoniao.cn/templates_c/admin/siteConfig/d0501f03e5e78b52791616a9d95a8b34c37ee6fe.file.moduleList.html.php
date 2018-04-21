<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-23 11:27:02
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\moduleList.html" */ ?>
<?php /*%%SmartyHeaderCode:12767594c8a86e84a65-43923076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0501f03e5e78b52791616a9d95a8b34c37ee6fe' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\moduleList.html',
      1 => 1494490286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12767594c8a86e84a65-43923076',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'moduleList' => 0,
    'action' => 0,
    'token' => 0,
    'cfg_defaultindex' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594c8a86f20e83_05849039',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594c8a86f20e83_05849039')) {function content_594c8a86f20e83_05849039($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>网站模块管理</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<style media="screen">
  .curr {color: #f00;}
</style>
</head>

<body>
<div class="search" style="position:relative;">
  <div class="tool">
    <button class="btn btn-info" data-toggle="dropdown" id="installNew">商店</button>
  </div>
</div>

<ul class="thead clearfix" style="position:relative; top:0; left:0; right:0; margin:0 10px;">
  <li class="row3">&nbsp;</li>
  <li class="row40 left">已安装模块</li>
  <li class="row20">设为首页</li>
  <li class="row20">排序</li>
  <li class="row17 left">操 作</li>
</ul>

<div class="list mb50" id="list" style="margin-top:-10px;">
  <ul class="root"></ul>
  <div class="tr clearfix">
    <div class="row3"></div>
    <div class="row80 left"><a href="javascript:;" class="add-type" style="display:inline-block;" id="addNew">添加新分类</a></div>
  </div>
  <button type="button" class="btn btn-success" id="saveBtn">保存</button>
</div>

<?php echo '<script'; ?>
 id="editForm" type="text/html">
  <form action="" class="quick-editForm" name="editForm">
	<dl class="clearfix">
      <dt>模块标识：</dt>
      <dd id="name"></dd>
    </dl>
    <dl class="clearfix">
      <dt>模块名称：</dt>
      <dd><input class="input-xlarge" type="text" name="title" id="title" value="" /></dd>
    </dl>
	<dl class="clearfix">
      <dt>模块图标：</dt>
      <dd>
	    <input class="input-xlarge" type="text" name="icon" id="icon" value="" /><br />
	    图片位于：<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
../static/images/admin/nav/
      </dd>
    </dl>
    <dl class="clearfix hide">
      <dt>所属目录：</dt>
      <dd><select name="parentid" id="parentid" class="input-large"></select></dd>
    </dl>
    <dl class="clearfix">
      <dt>状态：</dt>
      <dd class="clearfix">
        <label><input type="radio" name="state" value="0" />启用</label>&nbsp;&nbsp;
        <label><input type="radio" name="state" value="1" />禁用</label>
      </dd>
    </dl>
	<dl class="clearfix">
      <dt>排序：</dt>
      <dd><input class="input-mini" type="number" min="0" name="weight" id="weight" value="" /></dd>
    </dl>
  </form>
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
  var moduleList = <?php echo $_smarty_tpl->tpl_vars['moduleList']->value;?>
, action = '<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
', adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", token = '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
', defaultindex = '<?php echo $_smarty_tpl->tpl_vars['cfg_defaultindex']->value;?>
';
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
