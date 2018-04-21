<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-18 12:26:17
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\member\adminGroupPerm.html" */ ?>
<?php /*%%SmartyHeaderCode:23534594600e95fa9f4-67296965%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baffe79b54b53f93474e1933f219d69e9f3fbbc1' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\member\\adminGroupPerm.html',
      1 => 1494490297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23534594600e95fa9f4-67296965',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'id' => 0,
    'token' => 0,
    'menuData' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594600e960e277_78943748',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594600e960e277_78943748')) {function content_594600e960e277_78943748($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>管理组权限</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<style>body {height: auto;}</style>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform mb50">
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <?php echo $_smarty_tpl->tpl_vars['menuData']->value;?>

  <div class="fix-btn"><button type="button" class="btn btn-success" id="saveBtn">&nbsp;&nbsp;保&nbsp;&nbsp;存&nbsp;&nbsp;</button></div>
</form>
<?php echo '<script'; ?>
>
  var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
