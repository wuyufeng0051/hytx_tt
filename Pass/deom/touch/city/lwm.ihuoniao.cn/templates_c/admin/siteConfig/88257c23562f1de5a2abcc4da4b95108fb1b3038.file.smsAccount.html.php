<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-25 15:52:06
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\smsAccount.html" */ ?>
<?php /*%%SmartyHeaderCode:2741459268d26134546-05333012%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88257c23562f1de5a2abcc4da4b95108fb1b3038' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\smsAccount.html',
      1 => 1494490286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2741459268d26134546-05333012',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'token' => 0,
    'smsItem' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59268d2614fac4_22582052',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59268d2614fac4_22582052')) {function content_59268d2614fac4_22582052($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>短信平台管理</title>
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
  <div class="alert alert-success" style="margin:0 50px 10px;"><button type="button" class="close" data-dismiss="alert">×</button>配置非常重要，如果不会配置的，可以联系短信平台提供商帮助配置</div>
  <div class="mail-list clearfix">
    <?php echo $_smarty_tpl->tpl_vars['smsItem']->value;?>

  </div>
  <input class="btn btn-large btn-success" type="button" name="button" id="add" style="margin-left:50px;" value="新增一个帐户">
  <a href="javascript:;" id="check" style="margin-left:20px;<?php if ($_smarty_tpl->tpl_vars['smsItem']->value=='') {?> display: none;<?php }?>">测试启用帐号是否可用</a>
  <?php echo '<script'; ?>
 id="smsForm" type="text/html">
    <form action="" class="quick-editForm smsForm" name="smsForm">
      <dl class="clearfix">
        <dt>平台名称：</dt>
        <dd><input class="input-large" type="text" name="title" id="title" value="" /></dd>
      </dl>
      <dl class="clearfix">
        <dt>用户名/AppKey：</dt>
        <dd><input class="input-large" type="text" name="username" id="username" value="" /></dd>
      </dl>
      <dl class="clearfix">
        <dt>密码/AppSecret：</dt>
        <dd>
          <input class="input-large" type="text" name="password" id="password" value="" />
          <span class="help-inline">如果需要加密，请输入加密后的密码</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt>短信签名：</dt>
        <dd><input class="input-large" type="text" name="signCode" id="signCode" value="" /></dd>
      </dl>
      <dl class="clearfix">
        <dt>编码：</dt>
        <dd>
          <label><input type="radio" name="charset" value="0" checked /> utf-8</label>
          <label><input type="radio" name="charset" value="1" /> gb2312</label>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt>发送接口地址：</dt>
        <dd><input class="input-xxlarge" type="text" name="sendUrl" id="sendUrl" value="" /><br />用户名 {$username$} 密码 {$password$} 手机号 {$mobile$} 内容 {$content$}</dd>
      </dl>
      <dl class="clearfix">
        <dt>发送成功标识：</dt>
        <dd><input class="input-large" type="text" name="sendCode" id="sendCode" value="" /><span class="help-inline">返回值中包含此值，表明发送成功，否则失败</span></dd>
      </dl>
      <dl class="clearfix">
        <dt>查询接口地址：</dt>
        <dd><input class="input-xxlarge" type="text" name="accountUrl" id="accountUrl" value="" /><br />用户名 {$username$} 密码 {$password$}</dd>
      </dl>
      <dl class="clearfix">
        <dt>查询成功标识：</dt>
        <dd><input class="input-large" type="text" name="accountCode" id="accountCode" value="" /><span class="help-inline">条数 {$num$}</span></dd>
      </dl>
      <dl class="clearfix">
        <dt>官方网站：</dt>
        <dd><input class="input-large" type="text" name="website" id="website" value="" /></dd>
      </dl>
      <dl class="clearfix">
        <dt>联系方式：</dt>
        <dd><input class="input-large" type="text" name="contact" id="contact" value="" /></dd>
      </dl>
    </form>
  <?php echo '</script'; ?>
>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
