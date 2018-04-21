<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 14:59:36
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiFoodType.html" */ ?>
<?php /*%%SmartyHeaderCode:2335059155c813d7193-10322598%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '760caf3a16ba80054e57607d75fb2a733ffd509f' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiFoodType.html',
      1 => 1494572375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2335059155c813d7193-10322598',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59155c814159a6_54360935',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'sid' => 0,
    'list' => 0,
    'l' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59155c814159a6_54360935')) {function content_59155c814159a6_54360935($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>商品分类</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
</head>

<style>.weekShowSwitch{ display: none; } #foodtypeList .tagInput{ font-size:12px; color:black; display:none; width:100%; }</style>
<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="">
        <div class="col-xs-12">
          <button class="btn btn-success" ><a href="waimaiFoodTypeAdd.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
" style="color:#fff;">新建商品分类</a></button>
          <div id="foodtypeList" class="grid-view">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th id="foodtypeList_c0">分类名称</th>
                  <th id="foodtypeList_c1">编号</th>
                  <th id="foodtypeList_c3">是否显示分类</th>
                  <th id="foodtypeList_c4">分类显示时间段</th>
                  <th id="foodtypeList_c5">是否开启只星期几显示</th>
                  <th id="foodtypeList_c6">星期几显示</th>
                  <th id="foodtypeList_c8">操作</th>
                </tr>
              </thead>
              <tbody>
                <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                <tr>
                  <td><?php echo $_smarty_tpl->tpl_vars['l']->value['title'];?>
</td>
                  <td width="80"><?php echo $_smarty_tpl->tpl_vars['l']->value['sort'];?>
</td>
                  <td width="100">
                      <label class="statusSwitch" style="display: inline-block;">
                        <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['status']) {?> checked<?php }?>>
                        <span class="lbl"></span>
                      </label>
                  </td>
                  <td width="150"><?php echo $_smarty_tpl->tpl_vars['l']->value['start_time'];?>
至<?php echo $_smarty_tpl->tpl_vars['l']->value['end_time'];?>
</td>
                  <td width="150">
                    <label class="weekShowSwitch" style="display: inline-block;">
                      <input name="switch-field-2" class="ace ace-switch ace-switch-6" type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['weekshow']) {?> checked<?php }?>>
                      <span class="lbl"></span>
                    </label>
                  </td>
                  <td width="350"><?php echo $_smarty_tpl->tpl_vars['l']->value['week'];?>
</td>
                  <td nowrap="nowrap" width="100">
                    <a href="waimaiFoodTypeAdd.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" title="修改" class="green" style="padding-right:8px;">
                      <i class="ace-icon fa fa-pencil bigger-130"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a title="删除" class="red del" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" style="padding-right:8px;cursor:pointer;">
                      <i class="ace-icon fa fa-trash-o bigger-130"></i>
                    </a>
                  </td>
                </tr>
                <?php } ?>
                <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                <tr>
                  <td colspan="7" style="height: 200px; line-height: 200px; text-align: center;">没有找到数据.</td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>



<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
