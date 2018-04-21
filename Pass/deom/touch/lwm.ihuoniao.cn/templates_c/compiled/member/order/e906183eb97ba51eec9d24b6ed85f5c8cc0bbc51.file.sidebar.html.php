<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:13:33
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:310355923fd3d0c9a48-06905948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e906183eb97ba51eec9d24b6ed85f5c8cc0bbc51' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\sidebar.html',
      1 => 1494490897,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '310355923fd3d0c9a48-06905948',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_pointName' => 0,
    'installModuleArr' => 0,
    'userinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5923fd3d11f965_39250891',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5923fd3d11f965_39250891')) {function content_5923fd3d11f965_39250891($_smarty_tpl) {?><!-- 侧栏 s -->
<div class="sidebar">
	<dl>
		<dt>帐户管理<s><i></i></s></dt>
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'deposit'),$_smarty_tpl);?>
">帐户充值、提现</a></dd>
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order'),$_smarty_tpl);?>
">管理我的订单</a></dd>
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'convert'),$_smarty_tpl);?>
">现金与<?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
兑换</a></dd>
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'record'),$_smarty_tpl);?>
">交易记录明细</a></dd>
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'transfer'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
转赠</a></dd>
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'point'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
记录明细</a></dd>
		<!-- <dd>
			<a href="javascript:;">我的购物车<s><i></i></s></a>
			<ul>
				<li><a href="#">团购</a></li>
				<li><a href="#">商城</a></li>
				<li><a href="#">建材</a></li>
				<li><a href="#">家具</a></li>
				<li><a href="#">家居</a></li>
				<li><a href="#">外卖</a></li>
			</ul>
		</dd> -->
	</dl>
	<dl class="module fn-clear">
		<dt>内容管理<s><i></i></s></dt>
		<dd class="fb">
			<a href="javascript:;">管理我发布的信息<s><i></i></s></a>
			<ul>
				<?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article'),$_smarty_tpl);?>
">新闻投稿</a></li><?php }?>
				<?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'info'),$_smarty_tpl);?>
">分类信息</a></li><?php }?>
				<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'config-house'),$_smarty_tpl);?>
">房产信息</a></li><?php }?>
				<?php if (in_array("tieba",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'tieba'),$_smarty_tpl);?>
">贴吧帖子</a></li><?php }?>
			</ul>
		</dd>
		<dd><a href="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['message']>0) {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'message','param'=>"state=0"),$_smarty_tpl);
} else {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'message'),$_smarty_tpl);
}?>">消息<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['message']>0) {?><em><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['message'];?>
</em><?php }?></a></dd>
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'collect'),$_smarty_tpl);?>
">收藏</a></dd>
		<?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<dd>
			<a href="javascript:;">招聘<s><i></i></s></a>
			<ul>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job','action'=>'resume'),$_smarty_tpl);?>
">简历管理</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job','action'=>'collections'),$_smarty_tpl);?>
">收藏职位</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job','action'=>'delivery'),$_smarty_tpl);?>
">投递记录</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job','action'=>'invitation'),$_smarty_tpl);?>
">面试邀请</a></li>
			</ul>
		</dd>
		<?php }?>
		<?php if (in_array("dating",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<dd>
			<a href="javascript:;">交友<s><i></i></s></a>
			<ul>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'dating','action'=>'profile'),$_smarty_tpl);?>
">资料</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'dating','action'=>'review'),$_smarty_tpl);?>
">私信</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'dating','action'=>'visit'),$_smarty_tpl);?>
">人气</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'dating','action'=>'album'),$_smarty_tpl);?>
">相册</a></li>
			</ul>
		</dd>
		<?php }?>
		<?php if (in_array("huodong",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<dd>
			<a href="javascript:;">活动<s><i></i></s></a>
			<ul>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'huodong-join'),$_smarty_tpl);?>
">我参与的</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'huodong'),$_smarty_tpl);?>
">我的活动</a></li>
				<li><a href="<?php echo getUrlPath(array('service'=>'huodong','template'=>'fabu'),$_smarty_tpl);?>
" target="_blank">发布活动</a></li>
			</ul>
		</dd>
		<?php }?>
	</dl>
	<dl>
		<dt>隐私与安全<s><i></i></s></dt>
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
		<dd><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'loginrecord'),$_smarty_tpl);?>
">帐号登录记录</a></dd>
	</dl>
</div>
<!-- 侧栏 e -->
<?php }} ?>
