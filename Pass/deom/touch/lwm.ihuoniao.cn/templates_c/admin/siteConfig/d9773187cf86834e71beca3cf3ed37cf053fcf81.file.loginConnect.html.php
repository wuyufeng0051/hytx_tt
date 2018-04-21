<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-13 10:49:55
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\loginConnect.html" */ ?>
<?php /*%%SmartyHeaderCode:20705593f52d3719618-43828673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9773187cf86834e71beca3cf3ed37cf053fcf81' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\loginConnect.html',
      1 => 1494490285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20705593f52d3719618-43828673',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'installArr' => 0,
    'install' => 0,
    'uninstallArr' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593f52d37b98b0_62008526',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593f52d37b98b0_62008526')) {function content_593f52d37b98b0_62008526($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>管理第三方登录接口</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<div class="alert alert-success" style="margin:10px;"><button type="button" class="close" data-dismiss="alert">×</button>网站整合登录配置教程：<a href="http://help.ikuman.cn/help-52.html" target="_blank">http://help.ikuman.cn/help-52.html</a></div>

<?php if (count($_smarty_tpl->tpl_vars['installArr']->value)!=0) {?>
<ul class="thead clearfix" style="position:relative; top:0; left:0; right:0; margin:10px;">
  <li class="row50 left">&nbsp;&nbsp;已安装</li>
  <li class="row10 left">作者</li>
  <li class="row20">排序</li>
  <li class="row20 left">操作</li>
</ul>
<div class="list mb50" id="list" style="margin-top:-20px;">
  <ul class="root">
    <?php  $_smarty_tpl->tpl_vars['install'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['install']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['installArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['install']->key => $_smarty_tpl->tpl_vars['install']->value) {
$_smarty_tpl->tpl_vars['install']->_loop = true;
?>
    <li class="li0">
      <div class="tr clearfix" data-id="<?php echo $_smarty_tpl->tpl_vars['install']->value['id'];?>
">
        <div class="row50 left">&nbsp;&nbsp;&nbsp;<strong><?php echo $_smarty_tpl->tpl_vars['install']->value['name'];?>
</strong><sup><?php echo $_smarty_tpl->tpl_vars['install']->value['version'];?>
</sup>&nbsp;&nbsp;<a href="javascript:;" class="explain">说明</a></div>
        <div class="row10 left"><a href="<?php echo $_smarty_tpl->tpl_vars['install']->value['website'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['install']->value['author'];?>
</a></div>
        <div class="row20"><a href="javascript:;" class="up">向上</a><a href="javascript:;" class="down">向下</a></div>
        <div class="row20 left"><a href="loginConnect.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['install']->value['id'];?>
" class="modify" data-title="<?php echo $_smarty_tpl->tpl_vars['install']->value['name'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['install']->value['id'];?>
">配置</a>&nbsp;|&nbsp;<a href="loginConnect.php?action=uninstall&id=<?php echo $_smarty_tpl->tpl_vars['install']->value['id'];?>
" class="uninstall">卸载</a><?php if ($_smarty_tpl->tpl_vars['install']->value['state']==2) {?>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#f00">未启用</font><?php }?></div>
        <div class="hide"><?php echo $_smarty_tpl->tpl_vars['install']->value['desc'];?>
</div>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['uninstallArr']->value)!=0) {?>
<ul class="thead clearfix" style="position:relative; top:0; left:0; right:0; margin:10px;">
  <li class="row60 left">&nbsp;&nbsp;未安装</li>
  <li class="row20 left">作者</li>
  <li class="row20 left">操作</li>
</ul>
<div class="list mb50" style="margin-top:-20px;">
  <ul>
    <?php  $_smarty_tpl->tpl_vars['install'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['install']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['uninstallArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['install']->key => $_smarty_tpl->tpl_vars['install']->value) {
$_smarty_tpl->tpl_vars['install']->_loop = true;
?>
    <li>
      <div class="tr clearfix">
        <div class="row60 left">&nbsp;&nbsp;&nbsp;<strong><?php echo $_smarty_tpl->tpl_vars['install']->value['name'];?>
</strong><sup><?php echo $_smarty_tpl->tpl_vars['install']->value['version'];?>
</sup>&nbsp;&nbsp;<a href="javascript:;" class="explain">说明</a></div>
        <div class="row20 left"><a href="<?php echo $_smarty_tpl->tpl_vars['install']->value['website'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['install']->value['author'];?>
</a></div>
        <div class="row20 left"><a href="loginConnect.php?action=install&code=<?php echo $_smarty_tpl->tpl_vars['install']->value['code'];?>
" class="modify" data-title="<?php echo $_smarty_tpl->tpl_vars['install']->value['name'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['install']->value['code'];?>
">安装</a></div>
        <div class="hide"><?php echo $_smarty_tpl->tpl_vars['install']->value['desc'];?>
</div>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>
<?php }?>
<?php echo '<script'; ?>
>var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
