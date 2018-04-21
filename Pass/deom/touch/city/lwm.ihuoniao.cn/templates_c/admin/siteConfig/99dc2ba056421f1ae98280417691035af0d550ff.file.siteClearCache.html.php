<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 16:00:03
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\siteClearCache.html" */ ?>
<?php /*%%SmartyHeaderCode:579759156b83c3abf3-56012566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99dc2ba056421f1ae98280417691035af0d550ff' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\siteClearCache.html',
      1 => 1494490283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '579759156b83c3abf3-56012566',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'moduleList' => 0,
    'module' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59156b83c52306_76901541',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59156b83c52306_76901541')) {function content_59156b83c52306_76901541($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>清除页面缓存</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<form action="?action=do" method="post" name="editform" id="editform" class="editform">
  <dl class="clearfix">
    <dt><label>选择模块：</label></dt>
    <dd class="radio" id="modules">
      <label><input type="checkbox" name="module[]" value="siteConfig" checked /><span>基本配置</span></label>
      <label><input type="checkbox" name="module[]" value="member" checked /><span>会员</span></label>
      <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['moduleList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
      <label><input type="checkbox" name="module[]" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
" checked /><span><?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>
</span></label>
      <?php } ?>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label>其它：</label></dt>
    <dd class="radio">
      <label><input type="checkbox" name="type" value="1" /><span>同时删除后台缓存</span></label>
    </dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><button class="btn btn-success" type="submit" name="button" id="btnSubmit">确认提交</button>&nbsp;&nbsp;&nbsp;&nbsp;<label><input id="selectAll" type="checkbox" checked /><span>反选</span></label></dd>
  </dl>
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
