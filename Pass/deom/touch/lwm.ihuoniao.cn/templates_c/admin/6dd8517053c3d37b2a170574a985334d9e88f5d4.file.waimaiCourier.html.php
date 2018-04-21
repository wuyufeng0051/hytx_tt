<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-08 17:32:36
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiCourier.html" */ ?>
<?php /*%%SmartyHeaderCode:1508659279948e7efd5-03848554%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6dd8517053c3d37b2a170574a985334d9e88f5d4' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiCourier.html',
      1 => 1496914355,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1508659279948e7efd5-03848554',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59279948eb5ae4_35917160',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'list' => 0,
    'l' => 0,
    'pagelist' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59279948eb5ae4_35917160')) {function content_59279948eb5ae4_35917160($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>配送员管理</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<style>
.statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {display: none;}
#shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput {font-size:12px; color:black; display:none; width:100%;}
.pop-one {background: #fff; border-radius:3px; position: fixed; top: 21%; left: 50%; margin-left: -135px;}
.pop-two {width:400px; background: #fff; border-radius:3px; position: fixed; top: 21%; left: 50%; margin-left: -135px;}
.meng {background:rgba(0,0,0,.5); position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index:9999;}
.feng {background:rgba(0,0,0,.5); position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index:9999;}
.pop-one .pop-cont {line-height: 25px; padding: 12px 10px; border-bottom: 1px solid #d2d6da;}
.pop-bottom a {text-align: center; height: 40px; line-height: 40px; color: #007aff;}
.pop-bottom a:first-child {border-right:1px solid #d2d6da;}
.align-center, .div-align-center {text-align: center;}
.webkit-box1 {display: -webkit-box; width: 100%;}
.webkit-box1 >* {-webkit-box-flex: 1; width: 100%; display: block;}
.order_true {cursor:pointer;} .aa{display:none;}
.mybtn {float: right;}
.pagination {display: block; text-align: right;}
.pagination div {margin: 0;}
.pagination .page_info {display: inline-block; line-height: 35px; margin-left: 15px;}
.pagination ul>li.page_current span {background: #e8e8e8;}
#shop_list_choose_chosen {width:200px !important;}
</style>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

      <div class="">
        <div class="col-xs-12">
          <button class="btn btn-success"><a id="addNew" href="waimaiCourierAdd.php" style="color:#fff;">新建配送员</a></button>
          <div id="shopList" class="grid-view">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th id="shopList_c0">姓名</th>
                  <th id="shopList_c1">用户名</th>
                  <th id="shopList_c2">年龄</th>
                  <th id="shopList_c3">性别</th>
                  <th id="shopList_c4">手机号</th>
                  <th id="shopList_c5">配送总量</th>
                  <th id="shopList_c6">配送成功</th>
                  <th id="shopList_c7">配送失败</th>
                  <th id="shopList_c8">状态</th>
                  <th class="button-column" id="shopList_c9">管理</th>
                  <th id="shopList_c10">操作</th>
                </tr>
              </thead>
              <tbody>
                <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                <tr data-url="<?php echo $_smarty_tpl->tpl_vars['l']->value['url'];?>
">
                  <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
</td>
                  <td width="100"><?php echo $_smarty_tpl->tpl_vars['l']->value['username'];?>
</td>
                  <td width="80"><?php echo $_smarty_tpl->tpl_vars['l']->value['age'];?>
</td>
                  <td width="80"><?php if ($_smarty_tpl->tpl_vars['l']->value['sex']==1) {?>男<?php } else { ?>女<?php }?></td>
                  <td width="150"><?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>
</td>
                  <td width="50"><?php echo $_smarty_tpl->tpl_vars['l']->value['total'];?>
</td>
                  <td width="50"><?php echo $_smarty_tpl->tpl_vars['l']->value['ok'];?>
</td>
                  <td width="50"><?php echo $_smarty_tpl->tpl_vars['l']->value['failed'];?>
</td>
                  <td width="50"><?php if ($_smarty_tpl->tpl_vars['l']->value['state']==1) {?><b style="color:green">开工中</b><?php } else { ?><b style="color:red">已停工</b><?php }?></td>
                  <td width="100" style="text-align: center;">
                    <a class="label label-success location" data-name="<?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" data-lng="<?php echo $_smarty_tpl->tpl_vars['l']->value['lng'];?>
" data-lat="<?php echo $_smarty_tpl->tpl_vars['l']->value['lat'];?>
" title="查看位置" href="javascript:;">查看位置</a>
                  </td>
                  <td nowrap="nowrap" width="80">
                    <a href="waimaiCourierAdd.php?id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" title="修改" data-name="<?php echo $_smarty_tpl->tpl_vars['l']->value['name'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" class="green edit" style="padding-right:8px;"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a title="删除" class="del red" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" style="padding-right:8px;cursor:pointer;" ><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                <tr>
                  <td colspan="12" style="height: 200px; line-height: 200px; text-align: center;">没有找到数据.</td>
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

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
