<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 16:00:18
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\siteConfig\default\404.html" */ ?>
<?php /*%%SmartyHeaderCode:542159156b92d34358-30407333%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30bd49c9fa8348cecadcc32be2c3ec46f7edba76' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\siteConfig\\default\\404.html',
      1 => 1494490754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '542159156b92d34358-30407333',
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
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59156b92d6ae66_36168912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59156b92d6ae66_36168912')) {function content_59156b92d6ae66_36168912($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title>404-<?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<?php echo '<script'; ?>
 type='text/javascript'>window.BWEUM||(BWEUM={});BWEUM.info = {"stand":true,"agentType":"browser","agent":"bi-collector.oneapm.com/static/js/bw-send-411.5.9.js","beaconUrl":"bi-collector.oneapm.com/beacon","licenseKey":"3BvNz~I6uuIuvMMR","applicationID":2291662};<?php echo '</script'; ?>
><?php echo '<script'; ?>
 type="text/javascript" src="//bi-collector.oneapm.com/static/js/bw-loader-411.5.9.js"><?php echo '</script'; ?>
>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/404.css" media="all" />
</head>

<body>
<div class="error-page">
  <div class="error-page-container">
    <div class="error-page-main">
      <h3><strong>404</strong>无法打开页面</h3>
      <div class="error-page-actions">
        <div>
          <h4>可能原因：</h4>
          <ol>
            <li>网络信号差</li>
            <li>找不到请求的页面</li>
            <li>输入的网址不正确</li>
          </ol>
        </div>
        <div>
          <h4>可以尝试：</h4>
          <ul>
             <li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
">返回首页</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html><?php }} ?>
