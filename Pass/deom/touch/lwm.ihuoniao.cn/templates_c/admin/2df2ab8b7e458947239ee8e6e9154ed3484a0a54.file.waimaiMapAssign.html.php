<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-26 18:11:58
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiMapAssign.html" */ ?>
<?php /*%%SmartyHeaderCode:104635927dba4e95174-41495638%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2df2ab8b7e458947239ee8e6e9154ed3484a0a54' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiMapAssign.html',
      1 => 1495793518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104635927dba4e95174-41495638',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5927dba4ea8a08_54943792',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'courier' => 0,
    'order' => 0,
    'site_map_key' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5927dba4ea8a08_54943792')) {function content_5927dba4ea8a08_54943792($_smarty_tpl) {?><!DOCTYPE html>
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
var courier = <?php echo $_smarty_tpl->tpl_vars['courier']->value;?>
;
var order = <?php echo $_smarty_tpl->tpl_vars['order']->value;?>
;
<?php echo '</script'; ?>
>
<style media="screen">
html, body {width: 100%; height: 100%; background: #fff;}
.slide {position: absolute; left: 10px; top: 5px; bottom: 5px; width: 348px; border: 1px solid #ddd; background: #f3f3f3;}

.slide .tit {padding: 0 10px; height: 40px; line-height: 40px;}
.slide .tit select {float: right; margin-top: 5px; width: auto;}

.slide .list {position: absolute; left: 0; top: 40px; right: 0; bottom: 0; overflow-y: auto; color: #8A8787;}
.slide .list .item {border: 2px solid #fff; padding: 8px; background: #fff; margin-bottom: 12px; border-radius: 4px;}
.slide .list .item.curr {border-color: #55A947;}
.slide .list .item .tit {padding: 0; height: 28px; line-height: 20px; border-bottom: 1px solid #ddd;}
.slide .list .item dl {padding: 10px 0; border-bottom: 1px solid #ddd; margin-bottom: 0;}
.slide .list .item dt {float: left; width: 38px; height: 38px; margin-right: 10px;}
.slide .list .item dt img {width: 38px; display: block;}
.slide .list .item dd {position: relative; overflow: hidden; line-height: 20px;}
.slide .list .fot {padding: 15px 0 10px;}
.slide .list .fot input {display: inline-block; vertical-align: middle; outline: 0; margin-top: 0;}
.slide .list .fot .time {display: inline-block; vertical-align: middle; margin-left: 10px;}
.slide .list .fot .btn {float: right; margin-top: 0; padding: 4px 5px; line-height: 4px;}


#map {position: absolute; left: 370px; top: 5px; right: 5px; bottom: 5px; background: #fff;}

.bubble {-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-transition: background-color .15s ease-in-out; -moz-transition: background-color .15s ease-in-out; -o-transition: background-color .15s ease-in-out; transition: background-color .15s ease-in-out; cursor: pointer;}
.bubble-3 {height: 28px; line-height: 28px; cursor: pointer; text-align: center; margin: 0;}
.bubble-3 .num {padding: 0 6px; display: inline-block; background-color: #de1e30; border-radius: 2px; border: 1px solid #de1e30; min-width: 40px; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition: all .15s ease-in-out; transition: all .15s ease-in-out; font-style: normal;}
.bubble-3 .name {height: 30px; color: #333; position: absolute; z-index: -1; line-height: 30px; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition:all .15s ease-in-out; transition: all .15s ease-in-out; opacity: 0; visibility: hidden;}
.bubble-3 .name-des {background-color: #fff; display: inline-block; padding: 0 6px; border-radius: 0 3px 3px 0; box-shadow: 0 2px 2px rgba(0,0,0,0.2); font-style: normal;}
.bubble-3 .name-des a {color: #333}
.bubble-3 .name-des a:hover {text-decoration: underline;}


.bubble-3.shop .num {background-color: #4285f4; border-color: #4285f4; color: #fff;}
.bubble-3.shop .name {visibility: visible; opacity: 1;}
.bubble-3.shop .arrow-up {border-top-color: #4285f4;}
.bubble-3.shop .arrow {border-top-color: #4285f4;}
.label-clicked {z-index:3!important;}
.arrow-up {opacity: .9999; zoom: 1;}


.bubble-3.person .num {background-color: green; border-color: green; color: #fff;}
.bubble-3.person .name {visibility: visible; opacity: 1;}
.bubble-3.person .arrow-up {border-top-color: green;}
.bubble-3.person .arrow {border-top-color: green;}


.arrow-up,.arrow {border: 6px solid transparent; border-top-color: #de1e30; border-top-width: 8px; display: block; width: 0; height: 0; margin: 0 auto; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition: all .15s ease-in-out; transition: all .15s ease-in-out;}
.arrow {border-top-color: #de1e30; margin-left: -6px; margin-top: -9px; position: relative;}
label.BMapLabel {max-width: inherit;}
</style>
</head>

<body>
<div class="slide">
    <div class="tit">
        共 <span id="total">0</span> 条
        <select id="page" class="hide"></select>
    </div>
    <div class="list"></div>
</div>
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
