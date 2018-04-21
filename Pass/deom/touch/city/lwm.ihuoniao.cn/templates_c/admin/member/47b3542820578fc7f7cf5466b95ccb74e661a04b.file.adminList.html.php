<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-10 09:09:44
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\member\adminList.html" */ ?>
<?php /*%%SmartyHeaderCode:22109593b46d82b4575-71566008%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47b3542820578fc7f7cf5466b95ccb74e661a04b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\member\\adminList.html',
      1 => 1494490297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22109593b46d82b4575-71566008',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'groupList' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593b46d8306609_98061391',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593b46d8306609_98061391')) {function content_593b46d8306609_98061391($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>管理员列表</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<div class="search">
  <label>搜索：<input class="input-xlarge" type="search" id="keyword" placeholder="请输入要搜索的关键字"></label>
  <div class="btn-group" id="cadmin" data-id="">
    <button class="btn dropdown-toggle" data-toggle="dropdown">管理组<span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="javascript:;" data-id="">全部</a></li>
    </ul>
  </div>
  <button type="button" class="btn btn-success" id="searchBtn">立即搜索</button>
</div>

<div class="filter clearfix">
  <div class="f-left">
    <div class="btn-group" id="selectBtn">
      <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="check"></span><span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="javascript:;" data-id="1">全选</a></li>
        <li><a href="javascript:;" data-id="0">不选</a></li>
      </ul>
    </div>
    <button class="btn" id="delBtn">删除</button>
    <div class="btn-group" id="stateBtn">
      <button class="btn dropdown-toggle" data-toggle="dropdown">全部信息(<span class="totalCount"></span>)<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="javascript:;" data-id="">全部信息(<span class="totalCount"></span>)</a></li>
        <li><a href="javascript:;" data-id="0">正常(<span class="normal"></span>)</a></li>
        <li><a href="javascript:;" data-id="1">锁定(<span class="lock"></span>)</a></li>
      </ul>
    </div>
  </div>
  <div class="f-right">
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
    <button class="btn dropdown-toggle disabled" data-toggle="dropdown" id="prevBtn">上一页</button>
    <button class="btn dropdown-toggle disabled" data-toggle="dropdown" id="nextBtn">下一页</button>
    <div class="btn-group" id="paginationBtn">
      <button class="btn dropdown-toggle" data-toggle="dropdown">1/1页<span class="caret"></span></button>
      <ul class="dropdown-menu" style="left:auto; right:0;">
        <li><a href="javascript:;" data-id="1">第1页</a></li>
      </ul>
    </div>
  </div>
</div>

<ul class="thead t100 clearfix">
  <li class="row3">&nbsp;</li>
  <li class="row20 left">用户名</li>
  <li class="row20 left">真实姓名</li>
  <li class="row15 left">管理组</li>
  <li class="row15 left">注册时间</li>
  <li class="row12">状态</li>
  <li class="row15">操作</li>
</ul>

<div class="list common mt124" id="list" data-totalpage="1" data-atpage="1"><table><tbody></tbody></table><div id="loading" class="loading hide"></div></div>

<div id="pageInfo" class="pagination pagination-centered"></div>

<div class="hide">
  <span id="sKeyword"></span>
  <span id="admin"></span>
</div>

<?php echo '<script'; ?>
>var groupList = <?php echo $_smarty_tpl->tpl_vars['groupList']->value;?>
, adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
