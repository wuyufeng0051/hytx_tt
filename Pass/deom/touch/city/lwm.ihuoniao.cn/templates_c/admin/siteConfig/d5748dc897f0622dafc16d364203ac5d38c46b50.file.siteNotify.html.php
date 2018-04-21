<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-25 11:18:57
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\siteNotify.html" */ ?>
<?php /*%%SmartyHeaderCode:843959264d21184d04-37365077%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5748dc897f0622dafc16d364203ac5d38c46b50' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\siteNotify.html',
      1 => 1494490284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '843959264d21184d04-37365077',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59264d211a0280_48513970',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59264d211a0280_48513970')) {function content_59264d211a0280_48513970($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>消息通知配置</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<div class="search">
  <label>搜索：<input class="input-xlarge" type="search" id="keyword" placeholder="请输入要搜索的关键字"></label>
  <button type="button" class="btn btn-success" id="searchBtn">立即搜索</button>
</div>

<div class="filter clearfix">
  <div class="f-left">
    <a href="siteNotifyAdd.php" class="btn btn-primary" id="addNew">新增消息通知</a>
    &nbsp;&nbsp;&nbsp;&nbsp;配置教程：<a href="http://help.ikuman.cn/help-48.html" target="_blank">http://help.ikuman.cn/help-48.html</a>
  </div>
  <div class="f-right">
    <span class="help-inline" id="totalCount" style="margin-right:10px;"></span>
    <div class="btn-group" id="pageBtn">
      <button class="btn dropdown-toggle" data-toggle="dropdown">每页10条<span class="caret"></span></button>
      <ul class="dropdown-menu pull-right">
        <li><a href="javascript:;" data-id="10">每页10条</a></li>
        <li><a href="javascript:;" data-id="15">每页15条</a></li>
        <li><a href="javascript:;" data-id="20">每页20条</a></li>
        <li><a href="javascript:;" data-id="30">每页30条</a></li>
        <li><a href="javascript:;" data-id="50">每页50条</a></li>
        <li><a href="javascript:;" data-id="100">每页100条</a></li>
      </ul>
    </div>
    <button class="btn disabled" data-toggle="dropdown" id="prevBtn">上一页</button>
    <button class="btn disabled" data-toggle="dropdown" id="nextBtn">下一页</button>
    <div class="btn-group" id="paginationBtn">
      <button class="btn dropdown-toggle" data-toggle="dropdown">1/1页<span class="caret"></span></button>
      <ul class="dropdown-menu" style="left:auto; right:0;">
        <li><a href="javascript:;" data-id="1">第1页</a></li>
      </ul>
    </div>
  </div>
</div>

<ul class="thead t100 clearfix">
  <li class="row20 left">&nbsp;&nbsp;&nbsp;&nbsp;消息名称</li>
  <li class="row50">通知方式</li>
  <li class="row20">状态</li>
  <li class="row10 left">操 作</li>
</ul>

<div class="list mt124" id="list" data-totalpage="1" data-atpage="1"><table><tbody></tbody></table><div id="loading" class="loading hide"></div></div>

<div id="pageInfo" class="pagination pagination-centered"></div>

<div class="hide">
  <span id="sKeyword"></span>
</div>

<?php echo '<script'; ?>
>
  var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
