<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-15 17:14:43
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\login.html" */ ?>
<?php /*%%SmartyHeaderCode:1810559197183d12394-08813459%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce2dd519f5692092459032354e1adcb50c7cc5a6' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\login.html',
      1 => 1494490903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1810559197183d12394-08813459',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templets_skin' => 0,
    'cfg_staticPath' => 0,
    'cfg_basehost' => 0,
    'redirectUrl' => 0,
    'site' => 0,
    'cfg_weblogo' => 0,
    'loginCode' => 0,
    'login' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59197183d6ffa4_35708525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59197183d6ffa4_35708525')) {function content_59197183d6ffa4_35708525($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>用户登录</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/login.css?v=2">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=33"><?php echo '</script'; ?>
>
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
<div class="container">
	<!-- 头部 -->
	<div class="header">
		<div class="header-l"><a href="javascript:history.go(-1)"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/arrow.png" alt=""></a></div>
		<div class="header-c">登录</div>
		<div class="header-r"><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/register.html">注册</a></div>
	</div>
	<!-- 头部 end -->
	<div class="logo"><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_weblogo']->value;?>
" alt=""></a></div>
	<div class="form-box">
		<form id="loginForm" action="">
			<div class="inpbox">
				<i class="icon icon1"></i>
				<input type="text" name="" placeholder="用户名/邮箱/手机号" class="phone">
			</div>
			<div class="form-newpw inpbox<?php if ($_smarty_tpl->tpl_vars['loginCode']->value) {?> bb<?php }?>">
				<i class="icon icon2"></i>
				<input type="password" name="" placeholder="密码" class="password">
				<a href="javascript:;" class="psw_img"></a>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['loginCode']->value==1) {?>
			<div class="form-newpw inpbox">
				<i class="icon icon3"></i>
				<input type="text" name="" placeholder="验证码" class="vericode">
				<span class="code-box"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/vdimgck.php" title="看不清？点击换一张" id="verifycode"></span>
			</div>
			<?php }?>
			<div class="login-btn"><input type="submit" value="登录"></div>
			<div class="find-btn"><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/fpwd.html">找回密码</a></div>
		</form>
	</div>
	<div class="other-login">
		<div class="other-login-tit">
			<span>其他方式登录</span>
		</div>
		<div class="other-login-img">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"getLoginConnect",'return'=>"login")); $_block_repeat=true; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"login"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<?php if ($_smarty_tpl->tpl_vars['login']->value['code']=="wechat") {?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
" class="wechat"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/weixin.png"></a>
			<?php } elseif ($_smarty_tpl->tpl_vars['login']->value['code']=="qq") {?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/qq.png"></a>
			<?php } elseif ($_smarty_tpl->tpl_vars['login']->value['code']=="sina") {?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/weibo.png"></a>
			<?php }?>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"login"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</div>
	</div>
</div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
<!-- <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=3"><?php echo '</script'; ?>
> -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/login.js?v=24"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
