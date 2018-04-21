<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 16:02:31
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\siteConfig\touch\default\404.html" */ ?>
<?php /*%%SmartyHeaderCode:1760459156c17e76e95-08930862%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '448493e52fc02abf5c6db5097346026cf37118e4' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\siteConfig\\touch\\default\\404.html',
      1 => 1494490723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1760459156c17e76e95-08930862',
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
  'unifunc' => 'content_59156c17e9a115_12632955',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59156c17e9a115_12632955')) {function content_59156c17e9a115_12632955($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
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
</html>
<?php }} ?>
