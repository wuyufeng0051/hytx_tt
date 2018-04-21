<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 15:35:44
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\siteCron.html" */ ?>
<?php /*%%SmartyHeaderCode:21100592537d0c3ff99-51081387%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4524a12a8d608edaf4a95d5a801fec7faa39f12f' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\siteCron.html',
      1 => 1494490285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21100592537d0c3ff99-51081387',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'moduleArr' => 0,
    'module' => 0,
    'list' => 0,
    'l' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592537d0c8e1b5_82634659',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592537d0c8e1b5_82634659')) {function content_592537d0c8e1b5_82634659($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>计划任务管理</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<ul style="padding: 10px 100px 0 5px;">
  <li>计划任务是一项使系统在规定时间自动执行某些特定任务的功能，在需要的情况下，您也可以方便的将其用于站点功能的扩展。</li>
  <li>计划任务是与系统核心紧密关联的功能特性，不当的设置可能造成站点功能的隐患，严重时可能导致站点无法正常运行，因此请务必仅在您对计划任务特性十分了解，并明确知道正在做什么、有什么样后果的时候才自行添加或修改任务项目。</li>
  <li>此处和其他功能不同，本功能中完全按照站点系统默认时差对时间进行设定和显示，而不会依据某一用户或管理员的时差设定而改变显示或设置的时间值。</li>
</ul>
<div class="filter clearfix" style="padding-top: 10px;">
  <div class="f-left">
    <div class="btn-group" id="selectBtn">
      <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="check"></span><span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="javascript:;" data-id="1">全选</a></li>
        <li><a href="javascript:;" data-id="0">不选</a></li>
      </ul>
    </div>
    <button class="btn btn-success hide" id="openBtn" data-type="开启">开启</button>
    <button class="btn btn-danger hide" id="closeBtn" data-type="停用">停用</button>
    <button class="btn btn-inverse hide" id="delBtn">删除</button>
    <div class="btn-group" id="moduleBtn">
      <button class="btn dropdown-toggle" data-toggle="dropdown">频道<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="javascript:;" data-id="">全部</a></li>
        <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['moduleArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
        <li><a href="javascript:;" data-id="<?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>
</a></li>
        <?php } ?>
      </ul>
    </div>
    <button class="btn btn-primary" id="addNew">新增计划任务</button>
  </div>
</div>

<ul class="thead t100 clearfix">
  <li class="row3">&nbsp;</li>
  <li class="row12 left">频道</li>
  <li class="row20 left">名称</li>
  <li class="row15 left">任务周期</li>
  <li class="row15 left">上次执行时间</li>
  <li class="row15 left">下次执行时间</li>
  <li class="row10">状态</li>
  <li class="row10">操作</li>
</ul>

<div class="list common mt124" id="list" data-totalpage="1" data-atpage="1">
  <table>
    <tbody>
      <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
      <tr data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" data-type="<?php echo $_smarty_tpl->tpl_vars['l']->value['moduleName'];?>
">
        <td class="row3"><span class="check"></span></td>
        <td class="row12 left"><?php echo $_smarty_tpl->tpl_vars['l']->value['moduleTitle'];?>
</td>
        <td class="row20 left"><?php echo $_smarty_tpl->tpl_vars['l']->value['title'];?>
<br /><small><?php echo $_smarty_tpl->tpl_vars['l']->value['file'];?>
.php</small></td>
        <td class="row15 left"><?php echo $_smarty_tpl->tpl_vars['l']->value['cycle'];?>
</td>
        <td class="row15 left"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['ltime'],"%Y-%m-%d %H:%M");?>
</td>
        <td class="row15 left"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['ntime'],"%Y-%m-%d %H:%M");?>
</td>
        <td class="row10 state"><?php echo $_smarty_tpl->tpl_vars['l']->value['state'];?>
<span class="more"><s></s></span></td>
        <td class="row10"><a href="siteCron.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" title="编辑<?php echo $_smarty_tpl->tpl_vars['l']->value['title'];?>
计划任务" class="edit">编辑</a><a href="javascript:;" class="run" title="手动执行">执行</a><a href="javascript:;" title="删除" class="del">删除</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php echo '<script'; ?>
>var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
