<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 10:47:05
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\loginFrame.html" */ ?>
<?php /*%%SmartyHeaderCode:12009594b2fa94a1723-60797555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b7c1ec669160275de8c016f9b2c1011bd28748d' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\loginFrame.html',
      1 => 1494490893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12009594b2fa94a1723-60797555',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_basehost' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b2fa94b4fa2_57152117',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b2fa94b4fa2_57152117')) {function content_594b2fa94b4fa2_57152117($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<!-- <?php echo '<script'; ?>
>document.domain = '<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['cfg_basehost']->value,"http://",'');?>
';<?php echo '</script'; ?>
> -->
</head>


<body>
<?php echo '<script'; ?>
>
try {
	var hash_url = window.location.hash, hash = hash_url.replace("#", "");
  if(hash != ""){
  	var hashArr = hash.split("_");
  	//更新iframe高度
  	if(hashArr[0] == "height"){
	  	parent.parent.huoniao.changeLoginFrameSize(hashArr[1]);

	  //关闭
	  }else if(hashArr[0] == "close"){
	  	parent.parent.huoniao.closeLoginFrame();

	  //登录成功
	  }else if(hashArr[0] == "success"){
	  	top.location.reload();

	  }
  }
} catch (e) { }
<?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
