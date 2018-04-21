<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 17:45:56
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\advList.html" */ ?>
<?php /*%%SmartyHeaderCode:697459158454736f70-26516257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '099d12da9710c53d2c11825b61d9d360b3d9ae2b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\advList.html',
      1 => 1494490285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '697459158454736f70-26516257',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'addrListArr' => 0,
    'addr' => 0,
    'type' => 0,
    'typeListArr' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59158454781315_06843606',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59158454781315_06843606')) {function content_59158454781315_06843606($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>管理广告</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<div class="search">
  <label>搜索：<input class="input-xlarge" type="search" id="keyword" placeholder="请输入要搜索的关键字"></label>
  <div class="btn-group" id="typeBtn" data-id="">
    <button class="btn dropdown-toggle" data-toggle="dropdown">全部分类<span class="caret"></span></button>
  </div>
  <?php if ($_smarty_tpl->tpl_vars['action']->value=="tuan") {?>
  <div class="btn-group" id="cityBtn" data-id="">
    <button class="btn dropdown-toggle" data-toggle="dropdown">全部城市<span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="javascript:;" data-id="">全部城市</a></li>
      <?php  $_smarty_tpl->tpl_vars["addr"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["addr"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['addrListArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["addr"]->key => $_smarty_tpl->tpl_vars["addr"]->value) {
$_smarty_tpl->tpl_vars["addr"]->_loop = true;
?>
      <li><a href="javascript:;" data-id="<?php echo $_smarty_tpl->tpl_vars['addr']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['addr']->value['typename'];?>
</a></li>
      <?php } ?>
    </ul>
  </div>
  <?php }?>
  <button type="button" class="btn btn-success" id="searchBtn">立即搜索</button>
  <?php if (!$_smarty_tpl->tpl_vars['type']->value) {?><a href="advType.php?action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="btn btn-info ml30" id="typeManage">分类管理</a><?php }?>
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
    <button class="btn" data-toggle="dropdown" id="delBtn">删除</button>
    <a href="advAdd.php?action=<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" class="btn btn-primary" id="addNew">新增广告</a>
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
  <li class="row3">&nbsp;</li>
  <li class="row25">标 题</li>
  <li class="row5">排 序</li>
  <li class="row10"><?php if (!$_smarty_tpl->tpl_vars['type']->value) {?>分 类<?php } else { ?>模 板<?php }?></li>
  <li class="row10">类 型</li>
  <li class="row13">起始时间</li>
  <li class="row13">结束时间</li>
  <li class="row9">状态</li>
  <li class="row12">操 作</li>
</ul>

<div class="list mt124" id="list" data-totalpage="1" data-atpage="1"><table><tbody></tbody></table><div id="loading" class="loading hide"></div></div>

<div id="pageInfo" class="pagination pagination-centered"></div>

<div class="hide">
  <span id="sKeyword"></span>
  <span id="sType"></span>
  <span id="sCity"></span>
</div>

<?php echo '<script'; ?>
>
  var typeListArr = <?php echo $_smarty_tpl->tpl_vars['typeListArr']->value;?>
, action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", atype = <?php echo $_smarty_tpl->tpl_vars['type']->value;?>
;
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
