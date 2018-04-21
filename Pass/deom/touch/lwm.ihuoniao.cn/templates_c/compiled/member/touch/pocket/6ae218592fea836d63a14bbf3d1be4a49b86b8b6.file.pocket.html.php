<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-01 16:59:55
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\pocket.html" */ ?>
<?php /*%%SmartyHeaderCode:18577592fd78b90b785-29071246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ae218592fea836d63a14bbf3d1be4a49b86b8b6' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\pocket.html',
      1 => 1494490903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18577592fd78b90b785-29071246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'cfg_basehost' => 0,
    'cfg_hideUrl' => 0,
    'cfg_pointRatio' => 0,
    'cfg_pointName' => 0,
    'module1' => 0,
    'userinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592fd78b9616a5_10396324',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592fd78b9616a5_10396324')) {function content_592fd78b9616a5_10396324($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>我的口袋</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/common.css?v=2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/money.css?v=2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/pocket.css?v=2" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';

	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
;
	var pointRatio = <?php echo $_smarty_tpl->tpl_vars['cfg_pointRatio']->value;?>
, pointName = '<?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
';
<?php echo '</script'; ?>
>
</head>
<body>

  <!-- 头部 s -->
  <div class="header">
    <div class="header-l">
      <a href="javascript:;" onclick="history.go(-1)"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/back-r.png"></a>
    </div>
    <div class="header-c">我的口袋</div>
    <div class="header-r">
      <a href="javascript:;" class="screen"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/screen.png"></a>
    </div>

    <div class="nav">
      <ul class="fn-clear">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"siteModule",'return'=>"<module></module>1")); $_block_repeat=true; echo siteConfig(array('action'=>"siteModule",'return'=>"<module></module>1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <li><a href="<?php echo $_smarty_tpl->tpl_vars['module1']->value['url'];?>
" target="_blank"><span><?php echo $_smarty_tpl->tpl_vars['module1']->value['name'];?>
</span></a></li>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"siteModule",'return'=>"<module></module>1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

      </ul>
    </div>
  </div>
  <!-- 头部 s -->

  <!-- 余额总览 s -->
  <div class="bgbox">
    <div class="bgtop">
      <p class="tit">帐户资产总额(元)</p>
      <p class="count"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money']+$_smarty_tpl->tpl_vars['userinfo']->value['freeze'];?>
</p>
    </div>
    <div class="bgbottom fn-clear">
      <div class="item">
        <p class="tit">冻结金额</p>
        <p class="count"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['freeze'];?>
</p>
      </div>
      <div class="item">
        <p class="tit">可用余额</p>
        <p class="count"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money'];?>
</p>
      </div>
      <div class="item">
        <p class="tit">帐户<?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
</p>
        <p class="count"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value['point'];?>
</p>
      </div>
    </div>
  </div>
  <!-- 余额总览 d -->

  <!-- 列表 s -->
  <div class="operate">
    <ul>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'deposit'),$_smarty_tpl);?>
"><i class="icon1"></i>充值</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'withdraw'),$_smarty_tpl);?>
"><i class="icon2"></i>提现</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'convert'),$_smarty_tpl);?>
"><i class="icon3"></i>现金积分兑换</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'transfer'),$_smarty_tpl);?>
"><i class="icon4"></i>积分转赠</a></li>
    </ul>
  </div>
  <!-- 列表 e -->






<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=5"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/order.js?v=5"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
