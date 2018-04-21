<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-11 16:32:30
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\index_body.html" */ ?>
<?php /*%%SmartyHeaderCode:323545914219e999414-45334778%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35c94a40d7588886af3262a1a25be742a0f7d484' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\index_body.html',
      1 => 1494490267,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '323545914219e999414-45334778',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cfg_softname' => 0,
    'cfg_version' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'cfg_basehost' => 0,
    'server_port' => 0,
    'cfg_softenname' => 0,
    'update_version' => 0,
    'cfg_bbsState' => 0,
    'cfg_bbsType' => 0,
    'php_uname_s' => 0,
    'php_uname_r' => 0,
    'server_software' => 0,
    'PHP_VERSION' => 0,
    'mysqlinfo' => 0,
    'max_upload' => 0,
    'DB_CHARSET' => 0,
    'installPayment' => 0,
    'uninstallPayment' => 0,
    'installLogin' => 0,
    'uninstallLogin' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5914219e9b4992_00625013',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5914219e9b4992_00625013')) {function content_5914219e9b4992_00625013($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<title><?php echo $_smarty_tpl->tpl_vars['cfg_softname']->value;
echo $_smarty_tpl->tpl_vars['cfg_version']->value;?>
</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<style>
dl {padding:10px; margin:0; border-bottom:1px solid #eee; font-size:16px;}
dt {float:left; width:145px; text-align:right; font-weight:500;}
dd {position:relative; overflow:hidden; padding-left:25px; font-weight:500;}
dd span {font-size:12px; color:#f00;}
dd a {font-size:12px;}
dd span {margin-left: 2px;}
.icon {width: 16px; display: inline-block; vertical-align: middle; margin: -2px 3px 0 0;}
</style>
<?php echo '<script'; ?>
>var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";<?php echo '</script'; ?>
>
</head>

<body>
<dl class="clearfix">
  <dt>商业授权域名绑定</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
 (默认端口:<?php echo $_smarty_tpl->tpl_vars['server_port']->value;?>
)</dd>
</dl>
<dl class="clearfix">
  <dt>火鸟系统程序版本</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['cfg_softenname']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['update_version']->value;?>
 Release <?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="siteConfig/store.php" id="checkUpdate">查看最新版本</a></dd>
</dl>
<?php if ($_smarty_tpl->tpl_vars['cfg_bbsState']->value==1) {?>
<dl class="clearfix">
  <dt>整合社区论坛程序</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['cfg_bbsType']->value;?>
&nbsp;<a href="siteConfig/siteBBS.php" id="BBSConfig">配置</a></dd>
</dl>
<?php }?>
<dl class="clearfix">
  <dt>操作系统软件信息</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['php_uname_s']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['php_uname_r']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['server_software']->value;?>
</dd>
</dl>
<dl class="clearfix">
  <dt>PHP解析引擎版本</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['PHP_VERSION']->value;?>
</dd>
</dl>
<dl class="clearfix">
  <dt>MySql数据库版本</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['mysqlinfo']->value;?>
</dd>
</dl>
<dl class="clearfix">
  <dt>最大附件上传大小</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['max_upload']->value;?>
</dd>
</dl>
<dl class="clearfix">
  <dt>当前数据库大小</dt>
  <dd id="mysqlsize"><a href="javascript:;" id="getMysqlSize">点击获取</a></dd>
</dl>
<dl class="clearfix">
  <dt>数据库编码格式</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['DB_CHARSET']->value;?>
</dd>
</dl>
<dl class="clearfix">
  <dt>集成在线支付接口</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['installPayment']->value;
echo $_smarty_tpl->tpl_vars['uninstallPayment']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="siteConfig/sitePayment.php" class="icon-wrench" style="margin-top:5px;" title="管理" id="paymentConfig"></a></dd>
</dl>
<dl class="clearfix">
  <dt>整合一键登录接口</dt>
  <dd><?php echo $_smarty_tpl->tpl_vars['installLogin']->value;
echo $_smarty_tpl->tpl_vars['uninstallLogin']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="siteConfig/loginConnect.php" class="icon-wrench" style="margin-top:5px;" title="管理" id="loginConfig"></a></dd>
</dl>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php echo '<script'; ?>
>
$(function(){
  //配置
  $("#BBSConfig, #paymentConfig, #loginConfig").bind("click", function(event){
  	var href = $(this).attr("href");

  	try {
  		event.preventDefault();
  		parent.$(".h-nav a").each(function(index, element) {
        if($(this).attr("href") == href){
  				parent.$(this).click();
  				return false;
  			}
  		});
  	} catch(e) {}
  });

  //检查最新版本
  $("#checkUpdate").bind("click", function(){
    var href = $(this).attr("href");

  	try {
  		event.preventDefault();
  		parent.$(".h-nav a").each(function(index, element) {
        if($(this).attr("href") == href){
  				parent.$(this).click();
  				return false;
  			}
  		});
  	} catch(e) {}
  });

  //获取mysqlsize
  $("#getMysqlSize").bind("click", function(){
    $("#mysqlsize").html("正在获取，请稍候...");
    huoniao.operaJson("index_body.php", "dopost=getMysqlSize", function(data){
      $("#mysqlsize").html(data.state == 100 ? data.mysqlSize : "获取失败！");
    })
  });
});
<?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
