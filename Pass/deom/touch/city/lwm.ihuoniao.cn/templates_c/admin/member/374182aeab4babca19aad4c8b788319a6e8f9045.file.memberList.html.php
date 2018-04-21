<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-20 14:07:05
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\member\memberList.html" */ ?>
<?php /*%%SmartyHeaderCode:226025940b0d592a879-02844906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '374182aeab4babca19aad4c8b788319a6e8f9045' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\member\\memberList.html',
      1 => 1497858976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '226025940b0d592a879-02844906',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5940b0d5988482_18992589',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'notice' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5940b0d5988482_18992589')) {function content_5940b0d5988482_18992589($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>会员列表</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<div class="search">
  <label>搜索：
  <div class="btn-group" id="ctype" data-id="">
    <button class="btn dropdown-toggle" data-toggle="dropdown">会员类型<span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="javascript:;" data-id="">全部</a></li>
      <li><a href="javascript:;" data-id="1">个人</a></li>
      <li><a href="javascript:;" data-id="2">企业</a></li>
    </ul>
  </div>
  </label>
  <input class="input-xlarge" type="search" id="keyword" placeholder="请输入要搜索的关键字">
  &nbsp;&nbsp;注册日期&nbsp;&nbsp;<input class="input-small" type="text" id="stime" placeholder="开始日期">&nbsp;&nbsp;到&nbsp;&nbsp;<input class="input-small" type="text" id="etime" placeholder="结束日期">&nbsp;&nbsp;
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
        <li><a href="javascript:;" data-id="0">未审核(<span class="totalGray"></span>)</a></li>
        <li><a href="javascript:;" data-id="1">正常(<span class="normal"></span>)</a></li>
        <li><a href="javascript:;" data-id="2">审核拒绝(<span class="lock"></span>)</a></li>
      </ul>
    </div>
    <div class="btn-group" id="pendBtn"<?php if ($_smarty_tpl->tpl_vars['notice']->value) {?> data-id="0"<?php }?>>
      <button class="btn dropdown-toggle" data-toggle="dropdown">待办事项(<span class="totalPend"></span>)<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="javascript:;" data-id="0">全部待办信息(<span class="totalPend"></span>)</a></li>
        <li><a href="javascript:;" data-id="1">个人实名待认证(<span class="pendPerson"></span>)</a></li>
        <li><a href="javascript:;" data-id="2">公司待认证(<span class="pendCompany"></span>)</a></li>
      </ul>
    </div>
    <a href="memberList.php?dopost=Add" class="btn btn-primary" id="addNew">添加会员</a>
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
  <li class="row5 left">ID/类型</li>
  <li class="row14 left">用户名/打折卡号</li>
  <li class="row13 left">昵称/真名</li>
  <li class="row12 left">邮箱/电话</li>
  <li class="row6 left">余额</li>
  <li class="row6 left">积分</li>
  <li class="row14 left">注册/上次登录</li>
  <li class="row9 left">注册IP/上次登录</li>
  <li class="row10">状态</li>
  <li class="row8">操作</li>
</ul>

<div class="list common mt124" id="list" data-totalpage="1" data-atpage="1"><table><tbody></tbody></table><div id="loading" class="loading hide"></div></div>

<div id="pageInfo" class="pagination pagination-centered"></div>

<div class="hide">
  <span id="sKeyword"></span>
  <span id="mtype"></span>
  <span id="start"></span>
  <span id="end"></span>
</div>

<?php echo '<script'; ?>
>var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>