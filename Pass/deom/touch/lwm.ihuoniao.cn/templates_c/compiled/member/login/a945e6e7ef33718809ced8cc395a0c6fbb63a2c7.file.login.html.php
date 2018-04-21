<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-18 16:22:02
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\login.html" */ ?>
<?php /*%%SmartyHeaderCode:20314591d59aa43a731-32015131%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a945e6e7ef33718809ced8cc395a0c6fbb63a2c7' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\login.html',
      1 => 1494490894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20314591d59aa43a731-32015131',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cfg_webname' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'redirectUrl' => 0,
    'site' => 0,
    'cfg_weblogo' => 0,
    'cfg_shortname' => 0,
    'cfg_hotline' => 0,
    'loginCode' => 0,
    'login' => 0,
    'row' => 0,
    'cfg_powerby' => 0,
    'cfg_statisticscode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591d59aa4de863_77877521',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591d59aa4de863_77877521')) {function content_591d59aa4de863_77877521($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>用户登录-<?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
../siteConfig/default/css/index_public.css?v=2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/login.css?v=5" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', redirectUrl = '<?php echo $_smarty_tpl->tpl_vars['redirectUrl']->value;?>
', site = '<?php echo $_smarty_tpl->tpl_vars['site']->value;?>
';
	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");
<?php echo '</script'; ?>
>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("../siteConfig/top1.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- head s -->
<div class="wrap header fn-clear">
	<div class="logo">
		<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_weblogo']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
"><h2><?php echo $_smarty_tpl->tpl_vars['cfg_shortname']->value;?>
</h2><span>地方最大最全生活网</span></a>
	</div>
	<dl class="kefu fn-clear">
		<dt><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/kf_tel.png" alt=""></dt>
		<dd>
			<p class="p1">客服热线</p>
			<p class="p2"><?php echo $_smarty_tpl->tpl_vars['cfg_hotline']->value;?>
</p>
		</dd>
	</dl>
</div>
<!-- head e -->
<!-- 登录外框 s -->
<div class="loginwrap">
	<div class="wrap">
		<div class="person"><?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=163" language="javascript"><?php echo '</script'; ?>
></div>
		<div class="formbox">
			<span class="ewmlogin"></span>
			<div class="saoma">
				<p class="title">手机扫码，安全登录</p>
				<div class="picbox">
					<div class="pic1" id="login_container"><iframe src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=wechat&notclose=1" frameborder="0" scrolling="no" width="300px" height="400px"></iframe></div>
				</div>
			</div>
			<form action="" class="loginform">
				<p class="title">欢迎登录</p>
				<div class="error"><p>请输入登录帐号</p></div>
				<div class="form-row">
					<div class="inpbdr">
						<i class="lgicon iconuser"></i>
						<input type="text" class="inp username" id="loginuser" name="loginuser" placeholder="用户名/手机号码/邮箱">
					</div>
				</div>
				<div class="form-row">
					<div class="inpbdr">
						<i class="lgicon iconlock"></i>
						<input type="password" class="inp password" id="loginpass" name="loginpass" placeholder="密码">
					</div>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['loginCode']->value==1) {?>
				<div class="form-row fn-clear">
					<div class="inpbdr yzminput">
						<i class="lgicon iconyzm"></i>
						<input type="input" class="inp vdimgck" id="logincode" name="logincode" placeholder="验证码">
					</div>
					<div class="inpbdr yzmpic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/vdimgck.php" id="vdimgck" alt=""></div>
					<a href="javascript:;" class="change">换一张</a>
				</div>
				<?php }?>
				<div class="form-row"><div class="rememberpsd"><i class="lgicon iconcheck"></i>两周内自动登录</div></div>
				<div class="form-row btnwrap">
					<input type="submit" class="submit" value="登录">
				</div>
				<div class="otherdo fn-clear">
					<a href="register.html" class="goregister">免费注册，有惊喜></a>
					<a href="fpwd.html" class="fogetpsd">忘记密码？</a>
				</div>
				<div class="othertype">
					<p>合作网站账号登录：</p>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"getLoginConnect",'return'=>"login")); $_block_repeat=true; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"login"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['login']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login/<?php echo $_smarty_tpl->tpl_vars['login']->value['code'];?>
/img/24.png" /></a>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"getLoginConnect",'return'=>"login"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</div>
			</form>
		</div>
	</div>
</div>
<!-- 登录外框 e -->

<!-- 底部 s -->
<div class="footer-login">
	<p>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"singel")); $_block_repeat=true; echo siteConfig(array('action'=>"singel"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php echo getUrlPath(array('service'=>'siteConfig','template'=>'about','id'=>$_tmp1),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a><span class="pice">|</span>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"singel"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<a href="<?php echo getUrlPath(array('service'=>'siteConfig','template'=>'help'),$_smarty_tpl);?>
" target="_blank">帮助中心</a>
	</p>
	<?php echo $_smarty_tpl->tpl_vars['cfg_powerby']->value;?>

</div>
<!-- 底部 e -->

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/login.js?v=8"><?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['cfg_statisticscode']->value;?>

</body>
</html>
<?php }} ?>
