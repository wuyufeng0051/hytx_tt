<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-18 16:10:22
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiCommon.html" */ ?>
<?php /*%%SmartyHeaderCode:198485946356e8a2633-09401060%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc95844b950f17b2cc9f55ce34884af41bf54653' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiCommon.html',
      1 => 1497597153,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198485946356e8a2633-09401060',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'shop' => 0,
    'l' => 0,
    'shopid' => 0,
    'list' => 0,
    'key' => 0,
    'value' => 0,
    'pagelist' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5946356e8e0e49_83886149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5946356e8e0e49_83886149')) {function content_5946356e8e0e49_83886149($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>外卖订单</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<style>

.pagination {display: block; text-align: right;}
.pagination div {margin: 0;}
.pagination .page_info {display: inline-block; line-height: 35px; margin-left: 15px;}
.pagination ul>li.page_current span {background: #e8e8e8;}
.chzn-container {vertical-align: middle;}
.tab-content {overflow: visible;}

table.table {border-collapse: collapse;border-spacing: 0;}
.label-sm {height: auto;}
td.center {text-align: center;}
</style>
</head>
<body class="no-skin">
<div class="main-content">
    <div class="page-content">
        <div class="page-content-area">
            <div class="col-xs-12">
                <form id="frmselect" method="get" action="" style="margin-bottom:0;">
                    <select name="shopid" id="shopid" class="chosen-select">
                        <option value="">全部店铺</option>
                        <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shop']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['id']==$_smarty_tpl->tpl_vars['shopid']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
</option>
                        <?php } ?>
                    </select>
                </form>
                <div id="yw0" class="grid-view">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th id="yw0_c0">
                                    <a class="sort-link" href="#">顾客ID</a></th>
                                <th id="yw0_c1">店铺名称</th>
                                <th id="yw0_c2">评论内容</th>
                                <th id="yw0_c3">
                                    <a class="sort-link" href="#">评论的时间</a></th>
                                <th id="yw0_c4">
                                    <a class="sort-link" href="#">评论打分</a></th>
                                <th id="yw0_c5">是否回复</th>
                                <th class="button-column" id="yw0_c6">操作</th></tr>
                        </thead>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                            <tr class="<?php if ($_smarty_tpl->tpl_vars['key']->value%2==0) {?>odd<?php } else { ?>even<?php }?>">
                                <td width="70"><?php echo $_smarty_tpl->tpl_vars['value']->value['uid'];?>
</td>
                                <td width="140"><?php echo $_smarty_tpl->tpl_vars['value']->value['shopname'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>
</td>
                                <td width="150"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['value']->value['pubdate'],"%Y-%m-%d %H:%M:%S");?>
</td>
                                <td width="80"><?php echo $_smarty_tpl->tpl_vars['value']->value['star'];?>
</td>
                                <?php if ($_smarty_tpl->tpl_vars['value']->value['replydate']!=0) {?>
                                <td width="80">已回复</td>
                                <td width="40" class="center">
                                    <a class="label label-sm label-success reply" title="回复" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" data-uid="<?php echo $_smarty_tpl->tpl_vars['value']->value['uid'];?>
" href="waimaiCommonReply.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">查看</a></td>
                                <?php } else { ?>
                                <td width="80">未回复</td>
                                <td width="40" class="center">
                                    <a class="label label-sm label-success reply" title="回复" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" data-uid="<?php echo $_smarty_tpl->tpl_vars['value']->value['uid'];?>
" href="waimaiCommonReply.php?id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">回复</a></td>
                                <?php }?>
                            </tr>
                            <?php } ?>
                            <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                            <tr>
                                <td colspan="7" class="center">没有找到数据.</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php echo $_smarty_tpl->tpl_vars['pagelist']->value;?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="disk"></div>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>
<?php }} ?>
