<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 16:48:18
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\sitePaymentAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:78335923f752153b95-06124191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2eca65abd77b3168e51521d13a11300fa23080e' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\sitePaymentAdd.html',
      1 => 1494490284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78335923f752153b95-06124191',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'action' => 0,
    'id' => 0,
    'code' => 0,
    'token' => 0,
    'pay_name' => 0,
    'pay_config' => 0,
    'pay_desc' => 0,
    'stateList' => 0,
    'state' => 0,
    'stateName' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5923f7521b17b3_07665941',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5923f7521b17b3_07665941')) {function content_5923f7521b17b3_07665941($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>配置支付方式</title>
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
  <input type="hidden" name="action" id="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <input type="hidden" name="code" id="code" value="<?php echo $_smarty_tpl->tpl_vars['code']->value;?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <dl class="clearfix">
    <dt><label for="pay_name">支付方式名称：</label></dt>
    <dd>
      <input class="input-large" type="text" name="pay_name" id="pay_name" data-regex=".{2,30}" maxlength="30" value="<?php echo $_smarty_tpl->tpl_vars['pay_name']->value;?>
" />
      <span class="input-tips"><s></s>请输入支付方式名称，2-30个字符。</span>
    </dd>
  </dl>
  <div id="payConfig">
    <?php echo $_smarty_tpl->tpl_vars['pay_config']->value;?>

  </div>
  <dl class="clearfix">
    <dt><label for="pay_desc">支付方式说明：</label></dt>
    <dd>
      <textarea class="input-xxlarge" rows="5" name="pay_desc" id="pay_desc" data-regex=".*"><?php echo $_smarty_tpl->tpl_vars['pay_desc']->value;?>
</textarea>
      <span class="input-tips"><s></s>请输入支付方式说明。</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>状态：</dt>
    <dd class="radio">
      <?php echo smarty_function_html_radios(array('name'=>"state",'values'=>$_smarty_tpl->tpl_vars['stateList']->value,'checked'=>$_smarty_tpl->tpl_vars['state']->value,'output'=>$_smarty_tpl->tpl_vars['stateName']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

    </dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><button class="btn btn-large btn-success" type="submit" name="button" id="btnSubmit">确认提交</button></dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
