<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-31 15:52:31
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\emailAccount.html" */ ?>
<?php /*%%SmartyHeaderCode:10730592e763f843847-04771943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f69d69f9d146f772c4f7fa0a5792d81a4719c461' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\emailAccount.html',
      1 => 1494490285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10730592e763f843847-04771943',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'token' => 0,
    'mailItem' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592e763f87e1d5_74949165',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592e763f87e1d5_74949165')) {function content_592e763f87e1d5_74949165($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>邮箱账号管理</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />

  <div class="mail-list clearfix">
    <?php echo $_smarty_tpl->tpl_vars['mailItem']->value;?>

  </div>
  <input class="btn btn-large btn-success" type="button" name="button" id="addMail" style="margin-left:50px;" value="新增一个帐户">
  <a href="javascript:;" id="checkMail" style="margin-left:20px;<?php if ($_smarty_tpl->tpl_vars['mailItem']->value=='') {?> display: none;<?php }?>">测试启用帐号是否可用</a>
  <?php echo '<script'; ?>
 id="mailForm" type="text/html">
    <form action="" class="quick-editForm" name="mailForm">
      <dl class="clearfix">
        <dt>SMTP 服务器：</dt>
        <dd><input class="input-xlarge" type="text" name="mailServer" id="mailServer" value="smtp." /></dd>
      </dl>
      <dl class="clearfix">
        <dt>服务器端口：</dt>
        <dd><input class="input-mini" type="number" name="mailPort" id="mailPort" value="25" /></dd>
      </dl>
      <dl class="clearfix">
        <dt>发信人地址：</dt>
        <dd><input class="input-xlarge" type="text" name="mailFrom" id="mailFrom" value="" /></dd>
      </dl>
      <dl class="clearfix">
        <dt>用户名：</dt>
        <dd><input class="input-large" type="text" name="mailUser" id="mailUser" value="" /></dd>
      </dl>
      <dl class="clearfix">
        <dt>密码：</dt>
        <dd><input class="input-large" type="password" name="mailPass" id="mailPass" value="" /></dd>
      </dl>
    </form>
  <?php echo '</script'; ?>
>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
