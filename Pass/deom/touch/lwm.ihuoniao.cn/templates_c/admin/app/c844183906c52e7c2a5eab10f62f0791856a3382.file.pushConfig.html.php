<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-21 19:27:29
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\app\pushConfig.html" */ ?>
<?php /*%%SmartyHeaderCode:188365939fa1dbd8e60-38166475%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c844183906c52e7c2a5eab10f62f0791856a3382' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\app\\pushConfig.html',
      1 => 1498044279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188365939fa1dbd8e60-38166475',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5939fa1dc80e18_08596148',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'token' => 0,
    'android_access_id' => 0,
    'android_access_key' => 0,
    'android_secret_key' => 0,
    'ios_access_id' => 0,
    'ios_access_key' => 0,
    'ios_secret_key' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5939fa1dc80e18_08596148')) {function content_5939fa1dc80e18_08596148($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>推送配置</title>
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
  <div class="thead" style="margin-top: 0;">&nbsp;&nbsp;安卓应用</div>
    <dl class="clearfix">
      <dt><label for="android_access_id">ID：</label></dt>
      <dd><input class="input-xlarge" type="text" name="android_access_id" id="android_access_id" value="<?php echo $_smarty_tpl->tpl_vars['android_access_id']->value;?>
" placeholder="友盟不需要，阿里云移动推送需要" /></dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="android_access_key">Appkey：</label></dt>
      <dd><input class="input-xlarge" type="text" name="android_access_key" id="android_access_key" value="<?php echo $_smarty_tpl->tpl_vars['android_access_key']->value;?>
" /></dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="android_secret_key">Secret：</label></dt>
      <dd><input class="input-xlarge" type="text" name="android_secret_key" id="android_secret_key" value="<?php echo $_smarty_tpl->tpl_vars['android_secret_key']->value;?>
" /></dd>
    </dl>
  <div class="thead" style="margin-top: 20px;">&nbsp;&nbsp;iOS应用</div>
  <dl class="clearfix">
    <dt><label for="ios_access_id">ID：</label></dt>
    <dd><input class="input-xlarge" type="text" name="ios_access_id" id="ios_access_id" value="<?php echo $_smarty_tpl->tpl_vars['ios_access_id']->value;?>
" placeholder="友盟不需要，阿里云移动推送需要" /></dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="ios_access_key">Appkey：</label></dt>
    <dd><input class="input-xlarge" type="text" name="ios_access_key" id="ios_access_key" value="<?php echo $_smarty_tpl->tpl_vars['ios_access_key']->value;?>
" /></dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="ios_secret_key">Secret：</label></dt>
    <dd><input class="input-xlarge" type="text" name="ios_secret_key" id="ios_secret_key" value="<?php echo $_smarty_tpl->tpl_vars['ios_secret_key']->value;?>
" /></dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd>
        <input class="btn btn-large btn-success" type="submit" name="submit" id="btnSubmit" value="确认提交" />
    </dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
