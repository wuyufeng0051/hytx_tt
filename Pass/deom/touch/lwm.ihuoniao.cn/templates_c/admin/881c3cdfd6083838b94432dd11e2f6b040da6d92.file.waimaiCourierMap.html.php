<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-09 10:11:17
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiCourierMap.html" */ ?>
<?php /*%%SmartyHeaderCode:139335927ae31515605-11264048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '881c3cdfd6083838b94432dd11e2f6b040da6d92' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiCourierMap.html',
      1 => 1496915054,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139335927ae31515605-11264048',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5927ae31525002_37022526',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'list' => 0,
    'site_map_key' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5927ae31525002_37022526')) {function content_5927ae31525002_37022526($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>配送员位置</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
var list = <?php echo $_smarty_tpl->tpl_vars['list']->value;?>
;
<?php echo '</script'; ?>
>
<style media="screen">
html, body {width: 100%; height: 100%;}
#map {position: absolute; left: 0; top: 0; right: 0; bottom: 0; background: #fff;}

.bubble {-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-transition: background-color .15s ease-in-out; -moz-transition: background-color .15s ease-in-out; -o-transition: background-color .15s ease-in-out; transition: background-color .15s ease-in-out; cursor: pointer;}
.bubble-3 {height: 28px; line-height: 28px; cursor: pointer; text-align: center; margin: 0;}

.bubble-3.closed .num {background-color: #666; border-color: #666; color: #fff;}
.bubble-3.closed .arrow-up {border-top-color: #666;}
.bubble-3.closed .arrow {border-top-color: #666;}

.bubble-3 .num {padding: 0 6px; display: inline-block; background-color: #4285f4; border-radius: 2px; border: 1px solid #4285f4; min-width: 40px; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition: all .15s ease-in-out; transition: all .15s ease-in-out; font-style: normal;}
.bubble-3 .name {height: 30px; color: #333; position: absolute; z-index: -1; line-height: 30px; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition:all .15s ease-in-out; transition: all .15s ease-in-out; opacity: 0; visibility: hidden;}
.bubble-3 .name-des {background-color: #fff; display: inline-block; padding: 0 6px; border-radius: 0 3px 3px 0; box-shadow: 0 2px 2px rgba(0,0,0,0.2); font-style: normal;}
.bubble-3 .name-des a {color: #333}
.bubble-3 .name-des a:hover {text-decoration: underline;}
.bubble-3:hover .num,.bubble-3.clicked .num,.bubble-3.hovered .num {background-color: #de1e30; border-color: #de1e30; color: #fff;}
.bubble-3:hover .name,.bubble-3.clicked .name,.bubble-3.hovered .name {visibility: visible; opacity: 1;}
.bubble-3:hover .arrow-up,.bubble-3.clicked .arrow-up,.bubble-3.hovered .arrow-up {border-top-color: #de1e30;}
.bubble-3:hover .arrow,.bubble-3.clicked .arrow,.bubble-3.hovered .arrow {border-top-color: #de1e30;}

.bubble-3.closed:hover .num {background-color: #000; border-color: #000; color: #fff;}
.bubble-3.closed:hover .name {visibility: visible; opacity: 1;}
.bubble-3.closed:hover .arrow-up {border-top-color: #000;}
.bubble-3.closed:hover .arrow {border-top-color: #000;}

.label-clicked {z-index:3!important;}
.arrow-up {opacity: .9999; zoom: 1;}
.arrow-up,.arrow {border: 6px solid transparent; border-top-color: #4285f4; border-top-width: 8px; display: block; width: 0; height: 0; margin: 0 auto; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition: all .15s ease-in-out; transition: all .15s ease-in-out;}
.arrow {border-top-color: #4285f4; margin-left: -6px; margin-top: -9px; position: relative;}
label.BMapLabel {max-width: inherit;}
</style>
</head>

<body>
<div id="map"></div>

<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
