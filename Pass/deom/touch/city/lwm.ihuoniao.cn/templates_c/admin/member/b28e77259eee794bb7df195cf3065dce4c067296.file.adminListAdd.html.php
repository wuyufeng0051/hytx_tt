<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-10 09:09:46
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\member\adminListAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:27955593b46dacb76f4-66903687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b28e77259eee794bb7df195cf3065dce4c067296' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\member\\adminListAdd.html',
      1 => 1494490298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27955593b46dacb76f4-66903687',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'mgroupid' => 0,
    'groupList' => 0,
    'adminPath' => 0,
    'dopost' => 0,
    'id' => 0,
    'token' => 0,
    'username' => 0,
    'nickname' => 0,
    'stateList' => 0,
    'state' => 0,
    'stateName' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593b46dacde7f8_27922179',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593b46dacde7f8_27922179')) {function content_593b46dacde7f8_27922179($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>添加管理员</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var mgroupid = <?php echo $_smarty_tpl->tpl_vars['mgroupid']->value;?>
, groupList = <?php echo $_smarty_tpl->tpl_vars['groupList']->value;?>
, adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="dopost" id="dopost" value="<?php echo $_smarty_tpl->tpl_vars['dopost']->value;?>
" />
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <dl class="clearfix">
    <dt><label for="username">用户名：</label></dt>
    <dd>
      <input class="input-large" type="text" name="username" id="username" data-regex=".{1,20}" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" />
      <span class="input-tips"><s></s>请输入用户名，1-20个字符。</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="password">密码：</label></dt>
    <dd>
      <input class="input-large" type="text" name="password" id="password" data-regex=".{6,32}" maxlength="32" value="" />
      <span class="input-tips"><s></s>请输入密码，6-32个字符。</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="nickname">真实姓名：</label></dt>
    <dd>
      <input class="input-large" type="text" name="nickname" id="nickname" data-regex=".{2,36}" maxlength="36" value="<?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
" />
      <span class="input-tips"><s></s>请输入真实姓名，6-36个字符。</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="mgroupid">所属管理组：</label></dt>
    <dd>
      <span id="groupList">
        <select name="mgroupid" id="mgroupid" class="input-large"></select>
      </span>
      <span class="input-tips"><s></s>请选所属管理组</span>
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
</html>
<?php }} ?>
