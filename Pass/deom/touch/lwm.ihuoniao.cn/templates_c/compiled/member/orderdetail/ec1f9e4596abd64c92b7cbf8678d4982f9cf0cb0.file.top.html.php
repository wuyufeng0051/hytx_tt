<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:27:59
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\top.html" */ ?>
<?php /*%%SmartyHeaderCode:11395924009f1dd2d7-98585561%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec1f9e4596abd64c92b7cbf8678d4982f9cf0cb0' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\top.html',
      1 => 1494490895,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11395924009f1dd2d7-98585561',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'member_userDomain' => 0,
    'userinfo' => 0,
    'installModuleArr' => 0,
    'cfg_pointName' => 0,
    'member_busiDomain' => 0,
    'cfg_basehost' => 0,
    'template' => 0,
    'templets_skin' => 0,
    'pageTitle' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924009f22b4e7_60795372',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924009f22b4e7_60795372')) {function content_5924009f22b4e7_60795372($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><?php echo '<script'; ?>
 type="text/javascript">var memberPage = true;<?php echo '</script'; ?>
>
<div class="header">
	<div class="wrap fn-clear">
		<a class="logo" title="会员中心首页" href="<?php echo $_smarty_tpl->tpl_vars['member_userDomain']->value;?>
"><s></s><h1>个人会员中心</h1><span><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['member_userDomain']->value,"http://",'');?>
</span></a>
		<ul class="nav">
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['member_userDomain']->value;?>
">首页</a></li>
			<li>
				<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'profile'),$_smarty_tpl);?>
">帐户设置<span class="arrow"><em></em></span></a>
				<dl class="subnav">
					<dt></dt>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'profile'),$_smarty_tpl);?>
">个人基本资料</a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chpassword'),$_smarty_tpl);?>
">修改登录密码</a></dd>
					<dd><?php if ($_smarty_tpl->tpl_vars['userinfo']->value['paypwdCheck']==0) {?><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'paypwdAdd'),$_smarty_tpl);?>
">设置支付密码</a><?php } else { ?><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'paypwdEdit'),$_smarty_tpl);?>
">修改支付密码</a><?php }?></dd>
					<dd><a href="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['certifyState']!=1) {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chCertify'),$_smarty_tpl);
} else {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'shCertify'),$_smarty_tpl);
}?>">个人实名认证</a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chphone'),$_smarty_tpl);?>
"><?php if ($_smarty_tpl->tpl_vars['userinfo']->value['phoneCheck']==0) {?>绑定手机<?php } else { ?>手机认证<?php }?></a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chemail'),$_smarty_tpl);?>
"><?php if ($_smarty_tpl->tpl_vars['userinfo']->value['emailCheck']==0) {?>绑定邮箱<?php } else { ?>邮箱认证<?php }?></a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'question'),$_smarty_tpl);?>
">安全保护问题</a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'address'),$_smarty_tpl);?>
">收货地址管理</a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'connect'),$_smarty_tpl);?>
">社交帐号关联绑定</a></dd>
				</dl>
			</li>
			<li>
				<a href="javascript:;">便捷发布<span class="arrow"><em></em></span></a>
				<dl class="subnav">
					<dt></dt>
					<?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'article'),$_smarty_tpl);?>
">[新闻] 发布新闻投稿</a></dd><?php }?>
					<?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'info'),$_smarty_tpl);?>
">[信息] 发布分类信息</a></dd><?php }?>
					<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
					<dd>
						<a href="javascript:;">[房产] 发布出租/出售房源</a>
						<dl>
							<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'house-demand'),$_smarty_tpl);?>
">求租、求购</a></dd>
							<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'house-sale'),$_smarty_tpl);?>
">二手房</a></dd>
							<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'house-zu'),$_smarty_tpl);?>
">租房</a></dd>
							<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'house-xzl'),$_smarty_tpl);?>
">写字楼</a></dd>
							<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'house-sp'),$_smarty_tpl);?>
">商铺</a></dd>
							<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'house-cf'),$_smarty_tpl);?>
">厂房、仓库</a></dd>
						</dl>
					</dd>
					<?php }?>
					<?php if (in_array("tieba",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><dd><a href="<?php echo getUrlPath(array('service'=>'tieba','template'=>'index'),$_smarty_tpl);?>
#publish" target="_blank">[贴吧] 发布新贴</a></dd><?php }?>
					<?php if (in_array("huodong",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><dd><a href="<?php echo getUrlPath(array('service'=>'huodong','template'=>'fabu'),$_smarty_tpl);?>
" target="_blank">[活动] 发布活动</a></dd><?php }?>
				</dl>
			</li>
			<li>
				<a href="javascript:;">我的财务<span class="arrow"><em></em></span></a>
				<dl class="subnav">
					<dt></dt>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'deposit'),$_smarty_tpl);?>
">帐户充值、提现</a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order'),$_smarty_tpl);?>
">管理我的订单</a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'record'),$_smarty_tpl);?>
">交易记录明细</a></dd>
					<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'point'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
记录明细</a></dd>
					<dd><a>可用金额：<strong><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money'];?>
</strong> 元</a></dd>
					<dd><a>冻结金额：<strong><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['freeze'];?>
</strong> 元</a></dd>
				</dl>
			</li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['member_busiDomain']->value;?>
" target="_blank">商家服务</a></li>
			<li class="mobile">
				<a href="#" target="_blank"><s class="mob"></s>手机版<i class="new">new</i></a>
				<dl class="subnav">
					<dt></dt>
					<dd class="qrcode"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/include/qrcode.php?data=<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" /></dd>
				</dl>
			</li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/logout.html"><s class="quit"></s>退出帐户</a></li>
		</ul>
	</div>
</div>

<?php if ($_smarty_tpl->tpl_vars['template']->value=='index') {?>
<div class="wrap crumbs fn-clear">
	<div class="cont">
		<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" target="_blank">网站首页</a>
		<s><i></i></s>
		<a href="<?php echo $_smarty_tpl->tpl_vars['member_userDomain']->value;?>
">会员中心</a>
	</div>
	<div class="notice" id="notice">
		<ul>
			
		</ul>
	</div>
	<!-- <div class="qiandao"><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/qiandao.png" title="签到送<?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
" /></a></div> -->
</div>
<?php } else { ?>
<div class="wrap crumbs fn-clear">
	<div class="cont">
		<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" target="_blank">网站首页</a>
		<s><i></i></s>
		<a href="<?php echo $_smarty_tpl->tpl_vars['member_userDomain']->value;?>
">会员中心</a>
		<s><i></i></s>
		<?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>

	</div>
	<div class="notice" id="notice">
		<ul>
			
		</ul>
	</div>
</div>
<?php }?>
<?php }} ?>
