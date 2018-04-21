<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-23 11:28:16
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\index.html" */ ?>
<?php /*%%SmartyHeaderCode:14595591971815d2335-17691942%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef0140cdfdbe3d5ad0f4c648062de630447ab7b5' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\index.html',
      1 => 1498114495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14595591971815d2335-17691942',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591971816e7908_87893646',
  'variables' => 
  array (
    'cfg_webname' => 0,
    'templets_skin' => 0,
    'cfg_staticPath' => 0,
    'cfg_basehost' => 0,
    'module' => 0,
    'userinfo' => 0,
    'cfg_pointName' => 0,
    'installModuleArr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591971816e7908_87893646')) {function content_591971816e7908_87893646($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>会员中心 - <?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css?v=3">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css?v=6">
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=10"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
</head>
<body>
<div class="header">
  <div class="header-l">
    <a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/logo1.png?v=2"></a>
  </div>
  <div class="header-c">
    <span>会员中心</span>
  </div>
  <div class="header-r">
    <ul class="yun" id="weather"></ul>
  </div>
  <div class="nav">
      <ul class="fn-clear">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"siteModule",'return'=>"module")); $_block_repeat=true; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <li><a href="<?php echo $_smarty_tpl->tpl_vars['module']->value['url'];?>
"><span><?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
</span></a></li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

      </ul>
    </div>
</div>
<div class="user">
  <div class="user-box fn-clear">
  	<?php if ($_smarty_tpl->tpl_vars['userinfo']->value) {?>
    <div class="user-img fn-left"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'profile'),$_smarty_tpl);?>
"><img onerror="javascript:this.src='<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_100.jpg';" src="<?php if ($_smarty_tpl->tpl_vars['userinfo']->value['photo']=='') {
echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_100.jpg<?php } else {
echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['userinfo']->value['photo']),'type'=>"large"),$_smarty_tpl);
}?>" /></a></div>
    <div class="user-info fn-left">
      <h3><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['nickname'];?>
</h3>
      <?php if ($_smarty_tpl->tpl_vars['userinfo']->value['certifyState']==1) {?><span class="zheng"><i></i>实名认证</span><?php }?>
    </div>
    <?php } else { ?>
    <div class="user-img fn-left"><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/login.html"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/noPhoto_100.jpg" /></a></div>
    <div class="user-info fn-left">
      <h3><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/login.html">登录/注册</a></h3>
    </div>
    <?php }?>
  </div>
  <!-- <div class="user-tip fn-right"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'zhaoshang'),$_smarty_tpl);?>
"><span>入驻商家</span></a></div> -->
</div>
<?php if ($_smarty_tpl->tpl_vars['userinfo']->value) {?>
<div class="info-box fn-clear">
  <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'balance'),$_smarty_tpl);?>
" class="remain"><i><strong><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money']+$_smarty_tpl->tpl_vars['userinfo']->value['freeze'];?>
</strong>元</i>余额</a><em class="line"></em>
  <!-- <a href="#" class="hui"><i><strong>1</strong>张</i>优惠券</a><em class="line"></em> -->
  <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'integral'),$_smarty_tpl);?>
" class="point"><i><strong><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['point'];?>
</strong>分</i><?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
</a>
</div>
<?php } else { ?>
<div class="info-box fn-clear">
  <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'balance'),$_smarty_tpl);?>
" class="remain"><i><strong>--</strong>元</i>余额</a><em class="line"></em>
  <!-- <a href="#" class="hui"><i><strong>--</strong>张</i>优惠券</a><em class="line"></em> -->
  <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'integral'),$_smarty_tpl);?>
" class="point"><i><strong>--</strong>分</i><?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
</a>
</div>
<?php }?>

<!-- 我的消息 -->
<div class="pocket fn-hide">
  <div class="pocket-tit">
    <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'message'),$_smarty_tpl);?>
">我的消息<span>查看全部消息</span></a>
  </div>
  <div class="pocket-box fn-clear">
    <a href="#"><i class="info-1"></i>评论</a>
    <a href="#"><i class="info-2"></i>私信</a>
    <a href="#"><i class="info-3"></i><em class="tznum">8</em>通知</a>
    <a href="#"><i class="info-4"></i>赞</a>
  </div>
</div>
<!-- 我的消息 end -->


<!-- 我的口袋 -->
<div class="pocket">
  <div class="pocket-tit">
    <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'pocket'),$_smarty_tpl);?>
">我的口袋<span>查看我的口袋</span></a>
  </div>
  <div class="pocket-box fn-clear">
    <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'deposit'),$_smarty_tpl);?>
"><i class="pocket-1"></i>充值</a>
    <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'convert'),$_smarty_tpl);?>
"><i class="pocket-3"></i>现金与积分互换</a>
    <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'withdraw'),$_smarty_tpl);?>
"><i class="pocket-2"></i>提现</a>
    <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'transfer'),$_smarty_tpl);?>
"><i class="pocket-4"></i>积分转赠</a>
  </div>
</div>
<!-- 我的口袋 end -->


<!-- 必备工具 -->
<div class="tool">
  <div class="tool-tit">
    <h3>必备工具</h3>
  </div>
  <div class="tool-box">
    <ul class="fn-clear">
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'collect','module'=>'waimai'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img1.png" alt=""></span>
          <span class="tool-txt">我的收藏</span>
        </a>
      </li>
      <li class="fn-hide">
        <a href="#">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img3.png" alt=""></span>
          <span class="tool-txt">收到赏金</span>
        </a>
      </li>
      <li class="fn-hide">
        <a href="#">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img4.png" alt=""></span>
          <span class="tool-txt">我的圈子</span>
        </a>
      </li>
      <?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'shop'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img5.png" alt=""></span>
          <span class="tool-txt">商城订单</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'tuan'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img6.png" alt=""></span>
          <span class="tool-txt">团购订单</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)&&$_smarty_tpl->tpl_vars['userinfo']->value['userType']==2) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','template'=>'verify','action'=>'tuan'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img20.png" alt=""></span>
          <span class="tool-txt">团购券核销</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'waimai'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img7.png" alt=""></span>
          <span class="tool-txt">外卖订单</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'home'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img8.png" alt=""></span>
          <span class="tool-txt">家居订单</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("furniture",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'furniture'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img9.png" alt=""></span>
          <span class="tool-txt">家具订单</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'build'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img10.png" alt=""></span>
          <span class="tool-txt">建材订单</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="#">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img11.png" alt=""></span>
          <span class="tool-txt">婚嫁订单</span>
        </a>
      </li>
      <?php }?>
      <li class="fn-hide">
        <a href="#">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img12.png" alt=""></span>
          <span class="tool-txt">酒店订单</span>
        </a>
      </li>
    </ul>
  </div>
</div>
<!-- 必备工具 end-->

<!-- 常用频道 -->
<div class="tool">
  <div class="tool-tit">
    <h3>常用频道</h3>
  </div>
  <div class="tool-box">
    <ul class="fn-clear">
      <?php if (in_array("tieba",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'tieba'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img21.png" alt=""></span>
          <span class="tool-txt">发布帖子</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'article'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img13.png" alt=""></span>
          <span class="tool-txt">新闻投稿</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'info'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img14.png" alt=""></span>
          <span class="tool-txt">发布二手</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'house'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img15.png" alt=""></span>
          <span class="tool-txt">发布房源</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img16.png" alt=""></span>
          <span class="tool-txt">找工作</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="#">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img17.png" alt=""></span>
          <span class="tool-txt">婚宴预订</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("dating",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'dating'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img18.png" alt=""></span>
          <span class="tool-txt">异性交友</span>
        </a>
      </li>
      <?php }?>
      <?php if (in_array("huodong",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
      <li>
        <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'huodong'),$_smarty_tpl);?>
">
          <span class="tool-img"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/img19.png" alt=""></span>
          <span class="tool-txt">管理活动</span>
        </a>
      </li>
      <?php }?>
    </ul>
  </div>
</div>
<!-- 常用频道 end-->

<!-- 帮助 -->
<div class="help">
  <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'service'),$_smarty_tpl);?>
" class="help-box">
    <div class="service">
      <i class="icon-1"></i>
      <span>客服/帮助</span>
      <span class="grey">在线客服、帮助中心</span>
    </div>
  </a>
  <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'security'),$_smarty_tpl);?>
" class="help-box">
    <div class="service center">
      <i class="icon-2"></i>
      <span>安全中心</span>
      <span class="grey">手机绑定、修改密码</span>
    </div>
  </a>
  <a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'setting'),$_smarty_tpl);?>
" class="help-box" id="appSetting">
    <div class="service center">
      <i class="icon-3"></i>
      <span>系统设置</span>
      <span class="grey">推送、缓存、版本</span>
    </div>
  </a>
</div>
<!-- 帮助 end-->

<?php echo $_smarty_tpl->getSubTemplate ("../../siteConfig/touch_bottom.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js?v=2"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
