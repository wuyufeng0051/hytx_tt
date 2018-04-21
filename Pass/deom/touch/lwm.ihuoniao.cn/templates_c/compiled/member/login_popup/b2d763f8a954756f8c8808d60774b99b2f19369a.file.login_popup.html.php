<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 10:47:03
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\login_popup.html" */ ?>
<?php /*%%SmartyHeaderCode:24529594b2fa7168bb7-20229108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2d763f8a954756f8c8808d60774b99b2f19369a' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\login_popup.html',
      1 => 1494490895,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24529594b2fa7168bb7-20229108',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'redirectUrl' => 0,
    'site' => 0,
    '_bindex' => 0,
    'row1' => 0,
    'row2' => 0,
    'loginCode' => 0,
    'isLogin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b2fa71a3547_94877627',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b2fa71a3547_94877627')) {function content_594b2fa71a3547_94877627($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>用户登录</title>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/login_popup.css?v=3" media="all" />
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', redirectUrl = '<?php echo $_smarty_tpl->tpl_vars['redirectUrl']->value;?>
', site = '<?php echo $_smarty_tpl->tpl_vars['site']->value;?>
';
<?php echo '</script'; ?>
>
</head>

<body>
<div class="login-pup fn-clear">
	<div class="login-left">
		<h2>推荐使用</h2>
		<ul>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"getLoginConnect",'return'=>"row1")); $_block_repeat=true; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"row1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		  <?php if ($_smarty_tpl->tpl_vars['_bindex']->value['row1']==1||$_smarty_tpl->tpl_vars['_bindex']->value['row1']==2) {?>
		  <li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['row1']->value['code'];?>
" class="login-<?php echo $_smarty_tpl->tpl_vars['row1']->value['code'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row1']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['row1']->value['name'];?>
</a></li>
		  <?php }?>
		  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"row1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			<li class="more">
			  更多&raquo;&nbsp;&nbsp;
			  <?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"getLoginConnect",'return'=>"row2")); $_block_repeat=true; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"row2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			  <?php if ($_smarty_tpl->tpl_vars['_bindex']->value['row2']!=1&&$_smarty_tpl->tpl_vars['_bindex']->value['row2']!=2) {?>
			  <a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['row2']->value['code'];?>
" class="login-<?php echo $_smarty_tpl->tpl_vars['row2']->value['code'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row2']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['row2']->value['name'];?>
</a>
			  <?php }?>
			  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"row2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</li>
		</ul>
	</div>
	<div class="login-right">
		<h2>帐号登录</h2>
		<form method="post" id="loginForm">
			<ul>
				<li><input type="text" class="login-input" name="loginuser" id="loginuser" autocomplete="off" /><span>邮箱/手机号/用户名</span></li>
				<li><input type="password" class="login-input error" maxlength="40" name="loginpass" id="loginpass" /><span>密码</span></li>
				<?php if ($_smarty_tpl->tpl_vars['loginCode']->value==1) {?>
				<li class="vdcode"><input type="text" class="login-input" maxlength="4" name="logincode" id="logincode" autocomplete="off" /><span>验证码</span><img src="/include/vdimgck.php" title="看不清？点击换一张" id="verifycode" /></li>
				<?php }?>
				<li class="submit fn-clear">
					<label><input type="checkbox" name="memberme" id="memberme" checked="checked" value="1" />记住登录状态</label>
					<a href="javascript:;" id="submitLogin" class="login-btn">登录</a>
				</li>
			</ul>
		</form>
		<span class="or">or</span>
	</div>
	<div class="login-foot">
		<a id="regbtn" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/register.html">注册</a>&nbsp;或&nbsp;<a id="pwdbtn" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/fpwd.html">找回密码</a>
	</div>
	<a href="javascript:;" title="关闭" id="close">关闭</a>
</div>

<span class="fn-hide" id="isLogin"><?php echo $_smarty_tpl->tpl_vars['isLogin']->value;?>
</span>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/login_popup.js?v=6"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
