<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 18:56:32
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\siteConfig\touch_bottom.html" */ ?>
<?php /*%%SmartyHeaderCode:30402595239e0af8172-44966951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '608d8c75d2842e290f510962d29fea5ba8f03c6d' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\siteConfig\\touch_bottom.html',
      1 => 1497955395,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30402595239e0af8172-44966951',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_basehost' => 0,
    'service' => 0,
    'userinfo' => 0,
    'member_userDomain' => 0,
    'installModuleArr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_595239e0b945a2_99720454',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_595239e0b945a2_99720454')) {function content_595239e0b945a2_99720454($_smarty_tpl) {?><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/css/touch_common_bottom.css">

<div class="btmMenu">
	<ul class="bnav">
		<li<?php if ($_smarty_tpl->tpl_vars['service']->value=="siteConfig") {?> class="active"<?php }?>>
			<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
">
				<i class="iconnav bicon-1"></i>
				<span>首页</span>
			</a>
		</li>
		<li>
			<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'message'),$_smarty_tpl);?>
">
				<i class="iconnav bicon-2"><?php if ($_smarty_tpl->tpl_vars['userinfo']->value&&$_smarty_tpl->tpl_vars['userinfo']->value['message']>0) {?><em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['userinfo']->value['message']);?>
</em><?php }?></i>
				<span>消息</span>
			</a>
		</li>
		<li id="fabubtn">
			<a href="javascript:;">
				<i class="quan1"><em class="quan2"></em></i>
				<span>发布</span>
			</a>
		</li>
		<li>
			<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'cart'),$_smarty_tpl);?>
">
				<i class="iconnav bicon-3"></i>
				<span>购物车</span>
			</a>
		</li>
		<li<?php if ($_smarty_tpl->tpl_vars['service']->value=="member") {?> class="active"<?php }?>>
			<a href="<?php echo $_smarty_tpl->tpl_vars['member_userDomain']->value;?>
">
				<i class="iconnav bicon-4"></i>
				<span>我的</span>
			</a>
		</li>
	</ul>
</div>

<div class="fabuBox">
  <div class="fabu">
    <ul class="clearfix">
	  <?php if (in_array("tieba",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t1">
		<a href="<?php echo getUrlPath(array('service'=>'tieba','template'=>'fabu'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_1.png" alt=""></a>
		<p>发布帖子</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t2">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu-article'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_2.png" alt=""></a>
		<p>新闻投稿</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t3">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'info'),$_smarty_tpl);?>
#Stype"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_3.png" alt=""></a>
		<p>发布二手信息</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t4">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu-house-sale'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_4.png" alt=""></a>
		<p>发布二手房</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t5">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu-house-zu'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_5.png" alt=""></a>
		<p>发布出租房</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t6">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu-house-xzl'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_6.png" alt=""></a>
		<p>发布写字楼</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t7">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu-house-sp'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_7.png" alt=""></a>
		<p>发布商铺</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t8">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu-house-cf'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_8.png" alt=""></a>
		<p>发布厂房、仓库</p>
	  </li>
	  <?php }?>
	  <?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li class="t9">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job-resume'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/images/fabu_btn_9.png" alt=""></a>
		<p>发布简历</p>
	  </li>
	  <?php }?>
    </ul>
    <div class="cancel"></div>
  </div>
</div>
<div class="bg_1"></div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/templates/siteConfig/touch/default/js/touch_common_bottom.js"><?php echo '</script'; ?>
>
<?php }} ?>
