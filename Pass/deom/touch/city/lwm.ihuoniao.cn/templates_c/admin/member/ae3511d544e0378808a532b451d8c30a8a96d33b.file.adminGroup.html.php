<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-18 12:26:15
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\member\adminGroup.html" */ ?>
<?php /*%%SmartyHeaderCode:25961594600e7ded720-13262572%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae3511d544e0378808a532b451d8c30a8a96d33b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\member\\adminGroup.html',
      1 => 1494490298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25961594600e7ded720-13262572',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'token' => 0,
    'groupList' => 0,
    'i' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594600e7e85cc0_85174467',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594600e7e85cc0_85174467')) {function content_594600e7e85cc0_85174467($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>管理组</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<ul class="thead clearfix" style="margin:10px 10px 0;">
  <li class="row30 left">&nbsp;&nbsp;&nbsp;&nbsp;管理组</li>
  <li class="row70 left">&nbsp;&nbsp;&nbsp;操 作</li>
</ul>

<form class="list mb50" id="list">
  <input type="hidden" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <ul class="root">
  <?php if ($_smarty_tpl->tpl_vars['groupList']->value!='') {?>
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groupList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
    <li class="clearfix tr">
      <div class="row30 left">&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" data-id="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['groupname'];?>
" /></div>
      <div class="row70 left"><a href="adminGroup.php?action=perm&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
" class="edit" title="编辑权限">编辑权限</a><a href="javascript:;" class="del" title="删除">删除</a></div>
    </li>
    <?php } ?>
  <?php }?>
  </ul>
  <div class="tr clearfix">
    <div class="row80 left">&nbsp;&nbsp;<a href="javascript:;" class="add-type" style="display:inline-block;" id="addNew">新增管理组</a></div>
  </div>
  <button type="button" class="btn btn-success" id="saveBtn">保存</button>
</form>

<?php echo '<script'; ?>
>
  var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
