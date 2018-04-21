<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 13:36:32
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiFoodList.html" */ ?>
<?php /*%%SmartyHeaderCode:806459152d3a20d0f0-45975836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64bccda86be61683d7b26b64b381913a71f373cb' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiFoodList.html',
      1 => 1494567391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '806459152d3a20d0f0-45975836',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59152d3a2c4a98_60850368',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'sid' => 0,
    'typelist' => 0,
    'type' => 0,
    'typeid' => 0,
    'title' => 0,
    'sort' => 0,
    'unit' => 0,
    'price' => 0,
    'typename' => 0,
    'label' => 0,
    'saleCount' => 0,
    'stock' => 0,
    'list' => 0,
    'l' => 0,
    'pagelist' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59152d3a2c4a98_60850368')) {function content_59152d3a2c4a98_60850368($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>商品列表</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", sid = <?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
;
<?php echo '</script'; ?>
>
<style>
.stockStatusSwitch, .foodStatusSwitch{ display:none; }
#foodList .priceInput, #foodList .nameInput, #foodList .tagInput, #foodList .unitInput, #foodList .labelInput, #foodList .pointInput, #foodList .stockInput{ font-size:12px; color:black; display:none; width:100%; }
#foodList pre{ white-space:pre-wrap; }
.btn-group+.btn, .btn-group>.btn{ border-width:5px; }
.pagination {display: block; text-align: right;}
.pagination div {margin: 0;}
.pagination .page_info {display: inline-block; line-height: 35px; margin-left: 15px;}
.pagination ul>li.page_current span {background: #e8e8e8;}

#import {overflow: hidden;}
#Filedata {position: absolute; left: 0; top: 0; right: 0; bottom: 0; opacity: 0; filter: alpha(opacity=0); cursor: pointer;}
</style>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

      <form action="" method="get">
          <input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
" />
          <div class="">
            <div class="col-xs-12">
              <span style="float: left; margin-right: 20px;">
                <select name="typeid" id="typeid">
                  <option value="0">全部分类</option>
                  <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['typelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['typeid']->value==$_smarty_tpl->tpl_vars['type']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value['title'];?>
</option>
                  <?php } ?>
                </select>
              </span>
              <button class="btn btn-success" ><a href="waimaiFoodAdd.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
" style="color:#fff">新建商品</a></button>
              <button class="btn btn-danger" id="deleteSelect">批量删除商品</button>
              <div class="btn btn-primary" id="import"><span>导入商品</span><input type="file" accept=".xls" id="Filedata" name="Filedata"></div>
              <!-- 111111111111111111111111111 -->
              <div id="foodList" class="grid-view">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="checkbox-column" id="foodList_c0"><input type="checkbox" value="1" name="foodList_c0_all" id="foodList_c0_all"></th>
                      <th id="foodList_c1">商品名称</th>
                      <th id="foodList_c2">编号</th>
                      <th id="foodList_c3">商品单位</th>
                      <th id="foodList_c4">价格</th>
                      <th id="foodList_c5">商品分类</th>
                      <th id="foodList_c7">标签</th>
                      <th id="foodList_c8">销售量</th>
                      <th id="foodList_c9">库存状态</th>
                      <th id="foodList_c10">库存量</th>
                      <th id="foodList_c11">是否限购</th>
                      <th id="foodList_c12">商品状态</th>
                      <th id="foodList_c13">开启自定义属性</th>
                      <th id="foodList_c14">操作</th>
                    </tr>
                    <tr class="filters">
                      <td>&nbsp;</td>
                      <td><input name="title" type="text" maxlength="30" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"></td>
                      <td><input name="sort" type="text" maxlength="10" value="<?php if ($_smarty_tpl->tpl_vars['sort']->value) {
echo $_smarty_tpl->tpl_vars['sort']->value;
}?>"></td>
                      <td><input name="unit" type="text" maxlength="6" value="<?php echo $_smarty_tpl->tpl_vars['unit']->value;?>
"></td>
                      <td><input name="price" type="text" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
"></td>
                      <td><input name="typename" type="text" value="<?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
"></td>
                      <td><input name="label" type="text" maxlength="4" value="<?php echo $_smarty_tpl->tpl_vars['label']->value;?>
"></td>
                      <td><input name="saleCount" type="text" maxlength="10" value="<?php if ($_smarty_tpl->tpl_vars['saleCount']->value) {
echo $_smarty_tpl->tpl_vars['saleCount']->value;
}?>"></td>
                      <td>&nbsp;</td>
                      <td><input name="stock" type="text" value="<?php if ($_smarty_tpl->tpl_vars['stock']->value) {
echo $_smarty_tpl->tpl_vars['stock']->value;
}?>"></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                    <tr>
                      <td width="20"><input value="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" id="foodList_c0_0" type="checkbox" name="selectorderlist[]"></td>
                      <td><?php echo $_smarty_tpl->tpl_vars['l']->value['title'];?>
</td>
                      <td width="50"><?php echo $_smarty_tpl->tpl_vars['l']->value['sort'];?>
</td>
                      <td width="60"><?php echo $_smarty_tpl->tpl_vars['l']->value['unit'];?>
</td>
                      <td width="80"><?php echo $_smarty_tpl->tpl_vars['l']->value['price'];?>
</td>
                      <td width="120"><?php echo $_smarty_tpl->tpl_vars['l']->value['typename'];?>
</td>
                      <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['label'];?>
</td>
                      <td width="50">0</td>
                      <td width="60">
                        <label class="stockStatusSwitch" style="display: inline-block;">
                          <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['stockvalid']) {?> checked<?php }?>>
                          <span class="lbl"></span>
                        </label>
                      </td>
                      <td width="60"><?php echo $_smarty_tpl->tpl_vars['l']->value['stock'];?>
</td>
                      <td width="60"><?php if ($_smarty_tpl->tpl_vars['l']->value['is_day_limitfood']) {?>是<?php } else { ?>否<?php }?></td>
                      <td width="60">
                        <label class="foodStatusSwitch" style="display: inline-block;">
                          <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['status']) {?> checked<?php }?>>
                          <span class="lbl"></span>
                        </label>
                      </td>
                      <td width="110">
                        <label class="natureStatusSwitch">
                          <input name="switch-field-1" class="ace ace-switch ace-switch-6" type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['is_nature']) {?> checked<?php }?>>
                          <span class="lbl"></span>
                        </label>
                      </td>
                      <td nowrap="nowrap" class="center">
                        <a href="waimaiFoodAdd.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" title="修改" class="green" style="padding-right:8px;"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="删除" class="red del" style="padding-right:8px;cursor:pointer;" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                      </td>
                    </tr>
                    <?php } ?>
                    <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                    <tr>
                      <td colspan="14" style="height: 200px; line-height: 200px; text-align: center;">没有找到数据.</td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>

                <?php echo $_smarty_tpl->tpl_vars['pagelist']->value;?>


              </div>
            </div>
          </div>
      </form>

    </div>
  </div>



<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
