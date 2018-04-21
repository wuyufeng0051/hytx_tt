<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-01 17:00:42
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\info.html" */ ?>
<?php /*%%SmartyHeaderCode:3291592fd7baaf6787-49114955%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e73c538c620649d3e59763d1ed4b460285e2cfd6' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\info.html',
      1 => 1494490902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3291592fd7baaf6787-49114955',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templets_skin' => 0,
    'cfg_staticPath' => 0,
    'cfg_basehost' => 0,
    'cfg_hideUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592fd7bab3cc94_87840092',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592fd7bab3cc94_87840092')) {function content_592fd7bab3cc94_87840092($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>发布信息</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/fabu-info.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', staticPath = cfg_staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';
var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
;
var fabuUrl = '<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu-info'),$_smarty_tpl);?>
';
<?php echo '</script'; ?>
>
</head>
<body>

  <?php $_smarty_tpl->tpl_vars['pageTitle'] = new Smarty_variable("发布信息", null, 0);?>
  <?php ob_start();
echo getUrlPath(array('service'=>'member','type'=>'user','template'=>"index"),$_smarty_tpl);
$_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['backUrl'] = new Smarty_variable($_tmp1, null, 0);?>
  <?php echo $_smarty_tpl->getSubTemplate ("top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


  <div class="content">
    <!-- 发布列表 s -->
    <div class="list">
      <div class="model">
        <img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/rental-banner.png" alt="">
      </div>
      <ul>
        <li class="type">
          <a href="javascript:;">
            <i class="icon icon1"></i>
            <div class="title"><p>选择发布分类</div>
            <i class="arrow"></i>
          </a>
        </li>
        <li>
          <a href="manage-info.html">
            <i class="icon icon2"></i>
            <div class="title"><p>管理我的信息</div>
            <i class="arrow"></i>
          </a>
        </li>
      </ul>
    </div>
    <!-- 发布列表 e -->
  </div>

  <div class="layer">
    <div class="top fn-clear">
      <div class="top-l fn-left"><a href="javascript:;">返回</a></div>
    </div>
    <div class="choose">
      <div class="fn-clear">
        <div class="fchoose fn-left"></div>
        <div class="schoose fn-left"></div>
        <div class="tchoose fn-left"></div>
      </div>
    </div>
  </div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=2"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/fabu.js?v=2"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/info.js?v=2"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
