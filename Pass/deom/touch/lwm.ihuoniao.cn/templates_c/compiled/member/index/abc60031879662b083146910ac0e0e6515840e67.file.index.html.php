<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-15 15:58:48
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\index.html" */ ?>
<?php /*%%SmartyHeaderCode:387059195fb8a9f1d4-61553318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abc60031879662b083146910ac0e0e6515840e67' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\index.html',
      1 => 1494490893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '387059195fb8a9f1d4-61553318',
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
    'cfg_hideUrl' => 0,
    'userinfo' => 0,
    'bannerUrl' => 0,
    'nowHour' => 0,
    'level' => 0,
    'cla' => 0,
    'text' => 0,
    'cfg_pointName' => 0,
    'installModuleArr' => 0,
    'list' => 0,
    'shopCount' => 0,
    'ongoing' => 0,
    'unpaid' => 0,
    'gray' => 0,
    'audit' => 0,
    'refuse' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59195fb8c605b3_97543412',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59195fb8c605b3_97543412')) {function content_59195fb8c605b3_97543412($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>会员中心 - <?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/common.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/public.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';

	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");

	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
;

	var money = <?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money'];?>
, freeze = <?php echo $_smarty_tpl->tpl_vars['userinfo']->value['freeze'];?>
, point = <?php echo $_smarty_tpl->tpl_vars['userinfo']->value['point'];?>
;
<?php echo '</script'; ?>
>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="wrap">
	<div class="container fn-clear">

		<?php echo $_smarty_tpl->getSubTemplate ("sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


		<div class="main">

			<!-- 会员基本信息 s -->
			<div class="banner"<?php if ($_smarty_tpl->tpl_vars['bannerUrl']->value) {?> style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['bannerUrl']->value;?>
');"<?php }?>>
				<a href="javascript:;" class="conbg" id="customBanner" title="自定义封面背景图片">自定义封面背景图片</a>
				<dl class="uinfo">
					<dt>
						<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'portrait'),$_smarty_tpl);?>
">
							<img onerror="javascript:this.src='<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_100.jpg';" src="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['photo']=='') {
echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_100.jpg<?php } else {
echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['userinfo']->value['photo']),'type'=>"middle"),$_smarty_tpl);
}?>" />
							<span>上传头像</span>
						</a>
					</dt>
					<dd>
						<div class="name"><h2><span><?php echo $_smarty_tpl->tpl_vars['nowHour']->value;?>
，<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['nickname'];?>
</span><em></em></h2></div>
						<ul class="fn-clear">
							<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chphone'),$_smarty_tpl);?>
" class="mobile<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['phoneCheck']==0) {?> disable<?php }?>"><s></s>手机认证</a></li>
							<li><a href="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['certifyState']!=1) {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chCertify'),$_smarty_tpl);
} else {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'shCertify'),$_smarty_tpl);
}?>" class="real<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['certifyState']!=1) {?> disable<?php }?>"><s></s>实名认证</a></li>
							<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chemail'),$_smarty_tpl);?>
" class="email<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['emailCheck']==0) {?> disable<?php }?>"><s></s>邮箱认证</a></li>
							<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'chpassword'),$_smarty_tpl);?>
" class="save"><s></s>密码安全</a></li>
							<li><a href="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['paypwdCheck']==0) {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'paypwdAdd'),$_smarty_tpl);
} else {
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'paypwdEdit'),$_smarty_tpl);
}?>" class="pay<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['paypwdCheck']==0) {?> disable<?php }?>"><s></s>支付密码</a></li>
							<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security','doget'=>'question'),$_smarty_tpl);?>
" class="question<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['question']==0) {?> disable<?php }?>"><s></s>安全问题</a></li>
						</ul>
					</dd>
				</dl>
				<div class="bot">
					<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['lastlogintime']) {?>
					<div class="l">最近一次登录：<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['lastlogintime'];?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['lastloginipaddr'];?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'loginrecord'),$_smarty_tpl);?>
">查看更多</a></div>
					<?php } else { ?>
					<div class="l"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'loginrecord'),$_smarty_tpl);?>
">查看登录记录</a></div>
					<?php }?>
					<?php $_smarty_tpl->tpl_vars['level'] = new Smarty_variable("高", null, 0);?>
					<?php $_smarty_tpl->tpl_vars['text'] = new Smarty_variable("点击查看", null, 0);?>
					<?php $_smarty_tpl->tpl_vars['cla'] = new Smarty_variable("l1", null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['security']<100&&$_smarty_tpl->tpl_vars['userinfo']->value['security']>40) {?>
						<?php $_smarty_tpl->tpl_vars['level'] = new Smarty_variable("中", null, 0);?>
						<?php $_smarty_tpl->tpl_vars['text'] = new Smarty_variable("立即提升", null, 0);?>
						<?php $_smarty_tpl->tpl_vars['cla'] = new Smarty_variable("l2", null, 0);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['userinfo']->value['security']<=40) {?>
						<?php $_smarty_tpl->tpl_vars['level'] = new Smarty_variable("低", null, 0);?>
						<?php $_smarty_tpl->tpl_vars['text'] = new Smarty_variable("立即提升", null, 0);?>
						<?php $_smarty_tpl->tpl_vars['cla'] = new Smarty_variable("l2", null, 0);?>
					<?php }?>
					<div class="r">安全等级：<?php echo $_smarty_tpl->tpl_vars['level']->value;?>
<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security'),$_smarty_tpl);?>
" class="<?php echo $_smarty_tpl->tpl_vars['cla']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
</a></div>
					<div class="bg"></div>
				</div>
			</div>
			<!-- 会员基本信息 e -->

			<!-- 资产&天气 s -->
			<div class="mon-dwea">
				<div class="money">
					<div id="chart"></div>
					<div class="cinfo">
						<p>帐户资产总额&nbsp;&nbsp;</p>
						<strong><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money']+$_smarty_tpl->tpl_vars['userinfo']->value['freeze'];?>
</strong>
					</div>
					<div class="tmon pop"><s></s><dl class="popup"><dt><em></em></dt><dd>帐户资产总额，包括可用余额、冻结金额。<br />但不包含帐户<?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
。</dd></dl></div>
					<ul id="chart-detail">
						<li class="m1">
							<div>
								<label>可用余额<div class="pop"><s></s><dl class="popup"><dt><em></em></dt><dd>可用余额，可以直接用于分类信息竞价，房源信息置顶推广，也可以提现</dd></dl></div></label>
								<br /><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money'];?>

							</div>
							<i></i>
						</li>
						<li class="m2">
							<div>
								<label>冻结金额<div class="pop"><s></s><dl class="popup"><dt><em></em></dt><dd>不可用余额是指用户办理一些特殊业务时，本人账户中暂时不能使用的那部分资金。</dd></dl></div></label>
								<br /><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['freeze'];?>

							</div>
							<i></i>
						</li>
						<li class="m3">
							<div>
								<label>帐户<?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
<div class="pop"><s></s><dl class="popup"><dt><em></em></dt><dd><?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
可兑换帐户余额，支持商品<?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
购买，可以用于网站消费，商品补价兑换。</dd></dl></div></label>
								<br /><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['point'];?>

							</div>
							<i></i>
						</li>
					</ul>
				</div>
				<div class="date-weather">
					<h5>我的日历天气状况</h5>
					<ul class="fn-clear">
						<li class="d"><strong><?php echo getMyTime(array('format'=>"%d"),$_smarty_tpl);?>
</strong><p><?php echo getMyWeek(array('prefix'=>"星期"),$_smarty_tpl);?>
<br /><?php echo getMyTime(array('format'=>"%Y"),$_smarty_tpl);?>
.<?php echo getMyTime(array('format'=>"%m"),$_smarty_tpl);?>
</p></li>
					</ul>
				</div>
			</div>
			<!-- 资产&天气 e -->

			<!-- 系统消息 s -->
			<div class="message">
				<ul class="tab">
					<li class="curr"><a href="javascript:;">系统消息提醒</a></li>

					<?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
					<?php $_smarty_tpl->tpl_vars['shopCount'] = new Smarty_variable(0, null, 0);?>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"orderList",'return'=>"list",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo shop(array('action'=>"orderList",'return'=>"list",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<?php $_smarty_tpl->tpl_vars['shopCount'] = new Smarty_variable($_smarty_tpl->tpl_vars['list']->value['success'], null, 0);?>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"orderList",'return'=>"list",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'shop'),$_smarty_tpl);?>
">我购买的商品<?php if ($_smarty_tpl->tpl_vars['shopCount']->value>0) {?><em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['shopCount']->value);?>
</em><?php }?></a></li>
					<?php }?>

					<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
					<?php $_smarty_tpl->tpl_vars['unpaid'] = new Smarty_variable(0, null, 0);?>
					<?php $_smarty_tpl->tpl_vars['ongoing'] = new Smarty_variable(0, null, 0);?>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('tuan', array('action'=>"orderList",'return'=>"list",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo tuan(array('action'=>"orderList",'return'=>"list",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<?php $_smarty_tpl->tpl_vars['unpaid'] = new Smarty_variable($_smarty_tpl->tpl_vars['list']->value['unpaid'], null, 0);?>
					<?php $_smarty_tpl->tpl_vars['ongoing'] = new Smarty_variable($_smarty_tpl->tpl_vars['list']->value['ongoing'], null, 0);?>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo tuan(array('action'=>"orderList",'return'=>"list",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'tuan'),$_smarty_tpl);?>
">我团购的订单<?php if ($_smarty_tpl->tpl_vars['ongoing']->value>0&&$_smarty_tpl->tpl_vars['unpaid']->value>0) {?><em><?php if ($_smarty_tpl->tpl_vars['ongoing']->value>0) {?>未消费：<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['ongoing']->value);
}?> <?php if ($_smarty_tpl->tpl_vars['unpaid']->value>0) {?>未付款：<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['unpaid']->value);
}?></em><?php }?></a></li>
					<?php }?>
				</ul>
				<div class="con">
					<div class="item fn-clear">
						<?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
						<dl class="fn-clear">
							<dt>新闻</dt>
							<dd>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<ul>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'article'),$_smarty_tpl);?>
">发布新闻投稿</a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=1'),$_smarty_tpl);?>
">已经通过审核<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['audit']);?>
</em></a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=0'),$_smarty_tpl);?>
">未审核<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['gray']);?>
</em></a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=2'),$_smarty_tpl);?>
">审核拒绝<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['refuse']);?>
</em></a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article'),$_smarty_tpl);?>
">我的全部投稿<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em></a></li>
								</ul>
								<h5>
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=0'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['gray']);?>
</a>待审
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=1'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['audit']);?>
</a>通过
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=2'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['refuse']);?>
</a>拒绝
								</h5>
								<p>全方位的新闻资讯，最全的时事热点</p>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</dd>
						</dl>
						<?php }?>

						<?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
						<dl class="fn-clear">
							<dt>生活</dt>
							<dd>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('info', array('action'=>"ilist",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo info(array('action'=>"ilist",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<ul>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'info'),$_smarty_tpl);?>
">发布分类信息</a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'info','param'=>'state=1'),$_smarty_tpl);?>
">已经通过审核<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['audit']);?>
</em></a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'info','param'=>'state=0'),$_smarty_tpl);?>
">未审核<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['gray']);?>
</em></a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'info','param'=>'state=2'),$_smarty_tpl);?>
">审核拒绝<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['refuse']);?>
</em></a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'info','param'=>'state=4'),$_smarty_tpl);?>
">已经过期<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['expire']);?>
</em></a></li>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'info'),$_smarty_tpl);?>
">我的全部信息<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em></a></li>
								</ul>
								<h5>
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'info','param'=>'state=0'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['gray']);?>
</a>待审
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=1'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['audit']);?>
</a>通过
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=2'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['refuse']);?>
</a>拒绝
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'article','param'=>'state=4'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['expire']);?>
</a>过期
								</h5>
								<p>最新、最全的本地生活服务信息发布</p>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo info(array('action'=>"ilist",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</dd>
						</dl>
						<?php }?>

						<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
						<dl class="fn-clear">
							<dt>房源</dt>
							<dd>
								<ul>
									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable(0, null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable(0, null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable(0, null, 0);?>
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"demand",'typeid'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"demand",'typeid'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'house','dopost'=>'qzu'),$_smarty_tpl);?>
">求租<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em></a></li>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"demand",'typeid'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"demand",'typeid'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"demand",'typeid'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'house','dopost'=>'qgou'),$_smarty_tpl);?>
">求购<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em></a></li>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"demand",'typeid'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"saleList",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"saleList",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'house','dopost'=>'sale'),$_smarty_tpl);?>
">二手房<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em></a></li>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"saleList",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"zuList",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"zuList",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'house','dopost'=>'zu'),$_smarty_tpl);?>
">租房<em><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em></a></li>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"zuList",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>


									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'house','dopost'=>'xzl'),$_smarty_tpl);?>
">写字楼
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"xzlList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"xzlList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>售<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"xzlList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"xzlList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"xzlList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>租<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"xzlList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									</a></li>

									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'house','dopost'=>'sp'),$_smarty_tpl);?>
">商铺
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"spList",'type'=>"2",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"spList",'type'=>"2",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>转<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"spList",'type'=>"2",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"spList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"spList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>售<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"spList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"spList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"spList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>租<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"spList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									</a></li>

									<li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'manage','action'=>'house','dopost'=>'cf'),$_smarty_tpl);?>
">厂房/仓库
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"cfList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"cfList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>转<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"cfList",'type'=>"1",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"cfList",'type'=>"2",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"cfList",'type'=>"2",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>售<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"cfList",'type'=>"2",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"cfList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo house(array('action'=>"cfList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<?php $_smarty_tpl->tpl_vars['gray'] = new Smarty_variable($_smarty_tpl->tpl_vars['gray']->value+$_smarty_tpl->tpl_vars['list']->value['gray'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['audit'] = new Smarty_variable($_smarty_tpl->tpl_vars['audit']->value+$_smarty_tpl->tpl_vars['list']->value['audit'], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['refuse'] = new Smarty_variable($_smarty_tpl->tpl_vars['refuse']->value+$_smarty_tpl->tpl_vars['list']->value['refuse'], null, 0);?>
									<em>租<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['totalCount']);?>
</em>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"cfList",'type'=>"0",'return'=>"list",'u'=>"1",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									</a></li>
								</ul>
								<h5>
									<a href="javascript:;"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['gray']->value);?>
</a>待审
									<a href="javascript:;"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['audit']->value);?>
</a>通过
									<a href="javascript:;"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['refuse']->value);?>
</a>拒绝
								</h5>
								<p>房产信息免费发布出租、出售房原等 </p>
							</dd>
						</dl>
						<?php }?>

						<?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
						<dl class="fn-clear">
							<dt>招聘</dt>
							<dd>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('job', array('action'=>"invitationList",'type'=>"person",'state'=>"0",'return'=>"list",'pageData'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo job(array('action'=>"invitationList",'type'=>"person",'state'=>"0",'return'=>"list",'pageData'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<h5><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job','action'=>'invitation'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['state0']);?>
</a>份面试通知</h5>
								<p>为求职者提供最新最全的招聘信息 </p>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo job(array('action'=>"invitationList",'type'=>"person",'state'=>"0",'return'=>"list",'pageData'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</dd>
						</dl>
						<?php }?>

						<?php if (in_array("dating",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
						<dl class="fn-clear">
							<dt>交友</dt>
							<dd>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('dating', array('action'=>"review",'return'=>"list",'pageData'=>"1",'pageSize'=>"99999999")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"review",'return'=>"list",'pageData'=>"1",'pageSize'=>"99999999"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<h5><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'dating','action'=>'review'),$_smarty_tpl);?>
"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['list']->value['noread']);?>
</a>条私信</h5>
								<p>婚恋交友平台，让缘分千万里挑一 </p>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"review",'return'=>"list",'pageData'=>"1",'pageSize'=>"99999999"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</dd>
						</dl>
						<?php }?>

						<?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
						<dl class="fn-clear">
							<dt>外卖</dt>
							<dd>
								<h5><a href="#">0</a>最新订单<a href="#">0</a>全部订单</h5>
								<p>众多优质外卖商家，方便网上订餐服务 </p>
							</dd>
						</dl>
						<?php }?>
					</div>
				</div>
			</div>
			<!-- 系统消息 e -->

			<!-- 模块集合 s -->
			<div class="modules">
				<ul class="fn-clear">
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/website.png" /><h5>企业建站</h5><p>利用最新互联网技术打造高端移动商务平台</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/build.png" /><h5>建材产品</h5><p>网络化与终端体验相集合的一站式无忧采购</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/renovation.png" /><h5>装修房子</h5><p>价格透明,拒绝水分,实力公司保障施工效果</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/tuan.png" /><h5>团购</h5><p>精选美食，娱乐等优质信息,尽享无敌折扣</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/paper.png" /><h5>电子报刊</h5><p>智能反解,功能强大，新型的媒报信息载体</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/job.png" /><h5>企业招聘</h5><p>名企信息，快速申请，轻松工作，满意招聘</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/marry.png" /><h5>婚庆摄影</h5><p>叙述有故事的浪漫,追求有灵魂的瞬间</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/waimai.png" /><h5>外卖</h5><p>超值套餐等你来!贴心的订餐服务让生活更简单</p></a></li>
					<li><a href="javascript:;"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/icon/car.png" /><h5>汽车</h5><p>量身选爱车,全程购车服务,让购车更轻松!</p></a></li>
				</ul>
			</div>
			<!-- 模块集合 e -->

		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/raphael.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
