<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 18:41:12
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\siteConfig\top.html" */ ?>
<?php /*%%SmartyHeaderCode:312375952364803e0c0-30775146%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20139c6a2db7a1bc1182dc385199f547fa3083a3' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\siteConfig\\top.html',
      1 => 1494490711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '312375952364803e0c0-30775146',
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
    'cfg_staticPath' => 0,
    'cfg_basehost' => 0,
    'cfg_weixinQr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5952364805d4c1_61249679',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5952364805d4c1_61249679')) {function content_5952364805d4c1_61249679($_smarty_tpl) {?><?php echo '<script'; ?>
 type="text/javascript">var cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
';<?php echo '</script'; ?>
>
<!-- 顶部菜单 s -->
<div class="top">
	<div class="wrap topbar fn-clear">
		<?php if ($_smarty_tpl->tpl_vars['userinfo']->value) {?>
		<?php $_smarty_tpl->tpl_vars['userDomain'] = new Smarty_variable($_smarty_tpl->tpl_vars['member_userDomain']->value, null, 0);?>
		<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['userType']==2) {?>
		<?php $_smarty_tpl->tpl_vars['userDomain'] = new Smarty_variable($_smarty_tpl->tpl_vars['member_busiDomain']->value, null, 0);?>
		<?php }?>
		<div class="userinfo" id="navLoginAfter">
			<div id="upic"><a href="<?php echo $_smarty_tpl->tpl_vars['userDomain']->value;?>
" target="_blank"><img onerror="javascript:this.src='<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_40.jpg';" src="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['photo']=='') {
echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_40.jpg<?php } else {
echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['userinfo']->value['photo']),'type'=>"small"),$_smarty_tpl);
}?>" /></a></div>
			<a href="<?php echo $_smarty_tpl->tpl_vars['userDomain']->value;?>
" id="uname" target="_blank"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['nickname'];?>
</a><?php if ($_smarty_tpl->tpl_vars['userinfo']->value['message']>0) {?><a href="<?php echo $_smarty_tpl->tpl_vars['userDomain']->value;?>
/message.html?state=0" target="_blank" id="umsg">消息(<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['message']>99) {?>99+<?php } else {
echo $_smarty_tpl->tpl_vars['userinfo']->value['message'];
}?>)</a><?php }?><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/logout.html" class="logout">安全退出</a>
		</div>
		<?php } else { ?>
		<ul class="logreg" id="navLoginBefore">
			<li><a href="javascript:;" id="login">登录</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/register.html">注册</a></li>
		</ul>
		<?php }?>
		<ul class="topbarlink">
			<li class="mark"><a href="javascript:;">设为书签</a>
				<div class="pop">
					<s></s>
					<p class="t"><strong>Ctrl+D</strong>将本页面保存为书签，全面了解最新资讯，方便快捷。</p>
					<p class="b">您也可下载桌面快捷方式。<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/json.php?action=internetShortcut">点击下载</a></p>
				</div>
			</li>
			<li class="pubno"><a href="javascript:;">公众号</a>
				<div class="pop">
					<s></s>
					<p>微信扫码关注<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_weixinQr']->value;?>
" width="150" height="150" /></p>
				</div>
				
			</li>
			<li class="mobile"><a href="<?php echo getUrlPath(array('service'=>"siteConfig",'template'=>"mobile"),$_smarty_tpl);?>
" target="_blank">手机版</a>
				<div class="pop">
					<s></s>
					<p>扫码访问<a href="<?php echo getUrlPath(array('service'=>"siteConfig",'template'=>"mobile"),$_smarty_tpl);?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/qrcode.php?data=<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" width="150" height="150" /></a></p>
				</div>
			</li>
			
			<li class="index"><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" title="返回首页" target="_blank">返回首页>></a></li>
		</ul>
	</div>
</div>
<!-- 顶部菜单 e -->
<?php }} ?>
