<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-28 18:18:04
         compiled from "D:\wwwroot\deom\touch\lwm.ihuoniao.cn\templates\siteConfig\top1.html" */ ?>
<?php /*%%SmartyHeaderCode:90845953825cb5f3b9-39690009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc87f1257548686a619aba7689d8d194cd28ec02' => 
    array (
      0 => 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\templates\\siteConfig\\top1.html',
      1 => 1494490712,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90845953825cb5f3b9-39690009',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_cookiePre' => 0,
    'userinfo' => 0,
    'member_userDomain' => 0,
    'member_busiDomain' => 0,
    'userDomain' => 0,
    'cfg_basehost' => 0,
    'cfg_weixinQr' => 0,
    'module' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5953825cb7e7b3_04573678',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5953825cb7e7b3_04573678')) {function content_5953825cb7e7b3_04573678($_smarty_tpl) {?><?php echo '<script'; ?>
 type="text/javascript">var cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
';<?php echo '</script'; ?>
>
<!-- 顶部信息 s -->
<div class="topInfo">
	<div class="wrap fn-clear">
		<div class="loginbox">
			<?php if ($_smarty_tpl->tpl_vars['userinfo']->value) {?>
			<?php $_smarty_tpl->tpl_vars['userDomain'] = new Smarty_variable($_smarty_tpl->tpl_vars['member_userDomain']->value, null, 0);?>
			<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['userType']==2) {?>
			<?php $_smarty_tpl->tpl_vars['userDomain'] = new Smarty_variable($_smarty_tpl->tpl_vars['member_busiDomain']->value, null, 0);?>
			<?php }?>
			<div class="loginafter fn-clear">
				<span class="fn-left">欢迎您回来，</span><a href="<?php echo $_smarty_tpl->tpl_vars['userDomain']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['nickname'];?>
</a><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/logout.html" class="logout">退出</a>
			</div>
			<?php } else { ?>
			<div class="loginbefore fn-clear">
				<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/register.html" class="regist">免费注册</a><span class="logint"><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/login.html">请登录</a></span><a class="loginconnect" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=qq" target="_blank"><i class="picon picon-qq"></i>QQ登陆</a><a  class="loginconnect"href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=wechat" target="_blank"><i class="picon picon-weixin"></i>微信登陆</a><a class="loginconnect" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/login.php?type=sina" target="_blank"><i class="picon picon-weibo"></i>新浪登陆</a>
			</div>
			<?php }?>
		</div>
		<ul class="menu topbarlink fn-clear">
			<li class="dropdown user">
				<a href="<?php echo $_smarty_tpl->tpl_vars['member_userDomain']->value;?>
">我的会员中心<i class="picon picon-down"></i></a>
				<div class="submenu">
					<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order'),$_smarty_tpl);?>
" target="_blank">我的订单</a>
					<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'record'),$_smarty_tpl);?>
" target="_blank">交易明细</a>
					<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security'),$_smarty_tpl);?>
" target="_blank">安全中心</a>
				</div>
			</li>
			<li><a href="<?php echo getUrlPath(array('service'=>"siteConfig",'template'=>"mobile"),$_smarty_tpl);?>
" target="_blank"><i class="picon picon-phone"></i>手机站</a><span class="separ">|</span>
				<div class="pop">
					<s></s>
					<p>扫码访问<a href="<?php echo getUrlPath(array('service'=>"siteConfig",'template'=>"mobile"),$_smarty_tpl);?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/qrcode.php?data=<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" width="150" height="150" /></a></p>
				</div>
			</li>
			<li><a href="javascript:;"><i class="picon picon-weixin"></i>微信公众平台</a><span class="separ">|</span>
				<div class="pop" style="left: -26px;">
					<s></s>
					<p>微信扫码关注<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_weixinQr']->value;?>
" width="150" height="150" /></p>
				</div>
			</li>
			<li class="dropdown">
				<a href="javascript:;">快速发布<i class="picon picon-down"></i></a>
				<div class="submenu">
					<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'article'),$_smarty_tpl);?>
" target="_blank">新闻投稿</a>
					<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'info'),$_smarty_tpl);?>
" target="_blank">分类信息</a>
					<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'config','action'=>'house'),$_smarty_tpl);?>
" target="_blank">发布房源</a>
				</div>
			</li>
			<li class="dropdown webmap">
				<a href="javascript:;">网站导航<i class="picon picon-down"></i></a>
				<div class="submenu">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"siteModule",'return'=>"module")); $_block_repeat=true; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<a href="<?php echo $_smarty_tpl->tpl_vars['module']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
</a>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</div>
			</li>
		</ul>
	</div>
</div>
<!-- 顶部信息 e -->
<?php }} ?>
