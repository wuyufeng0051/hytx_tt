<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-16 17:05:30
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiType.html" */ ?>
<?php /*%%SmartyHeaderCode:113015915620ea064d9-55020043%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4850e1eb53a1ddf586b7fd4669b1aa388963af89' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiType.html',
      1 => 1497343143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113015915620ea064d9-55020043',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5915620ea40e66_62544798',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'list' => 0,
    'l' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5915620ea40e66_62544798')) {function content_5915620ea40e66_62544798($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>店铺分类</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<style type="text/css">
.pop-one{ background: #fff; border-radius:3px; position: fixed; top: 21%; left: 50%; margin-left: -135px; }
.pop-two{ width:400px; background: #fff; border-radius:3px; position: fixed; top: 21%; left: 50%; margin-left: -135px; }
.meng{ background:rgba(0,0,0,.5); position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index:9999; }
.feng{ background:rgba(0,0,0,.5); position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index:9999; }
.pop-one .pop-cont{ line-height: 25px; padding: 12px 10px; border-bottom: 1px solid #d2d6da; }
.pop-bottom a{ text-align: center; height: 40px; line-height: 40px; color: #007aff; }
.pop-bottom a:first-child{ border-right:1px solid #d2d6da; }
.align-center, .div-align-center { text-align: center; }
.webkit-box1 { display: -webkit-box; width: 100%; }
.webkit-box1 >* { -webkit-box-flex: 1; width: 100%; display: block; }
.order_true{cursor:pointer;}
.aa{display:none;}
</style>
</head>

<body>
<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">


        <div class="meng aa">
          <div class="pop-two">
            <div class="pop-cont align-center">
              <p><span style="position:relative;">分类链接</span></p>
              <p class="seeurl"></p>
            </div>
            <div class="pop-bottom webkit-box1"><a class="order_true">确定</a></div>
          </div>
        </div>
        <div class="feng aa">
          <div class="pop-one">
            <div class="pop-cont align-center">
              <p><span style="position:relative;">分类二维码</span></p>
              <p id="seeticket"></p>
            </div>
            <div class="pop-bottom webkit-box1"><a class="order_true">确定</a></div>
          </div>
        </div>


      <div class="">
        <div class="col-sm-8">
          <button class="btn btn-success"><a href="waimaiTypeAdd.php" style='color:#fff;'>新建店铺分类</a></button>
          <div id="yw0" class="grid-view">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th id="yw0_c0">分类名称</th>
                  <th id="yw0_c1">分类编号</th>
                  <th id="yw0_c2">分类地址</th>
                  <th id="yw0_c3">分类二维码</th>
                  <th class="button-column" id="yw0_c4">操作</th>
                </tr>
              </thead>
              <tbody>
                <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                <tr data-url="<?php echo getUrlPath(array('service'=>'waimai','template'=>'list'),$_smarty_tpl);?>
?typeid=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
">
                  <td><?php echo $_smarty_tpl->tpl_vars['l']->value['title'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['l']->value['sort'];?>
</td>
                  <td><div class="shopurl" style="background:#82AF6F;text-align:center;color:white;cursor:pointer;width:60px;">查看</div></td>
                  <td><div class="shopticket" style="background:#82AF6F;text-align:center;color:white;cursor:pointer;width:60px;">查看</div></td>
                  <td width="100" class="center">
                    <a title="修改" class="green" style="padding-right:8px;" href="waimaiTypeAdd.php?id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp;&nbsp;
                    <a title="删除" class="red del" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" style="padding-right:8px;" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                <tr>
                  <td colspan="5" style="height: 200px; line-height: 200px; text-align: center;">没有找到数据.</td>
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
