<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-16 15:54:56
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiShop.html" */ ?>
<?php /*%%SmartyHeaderCode:1362591437394808c4-46098811%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '035b883cd3086338fa7b0fa6123c4045e58b3c06' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiShop.html',
      1 => 1497599694,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1362591437394808c4-46098811',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591437394e61e9_46373552',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'shopname' => 0,
    'typename' => 0,
    'phone' => 0,
    'address' => 0,
    'list' => 0,
    'l' => 0,
    'pagelist' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591437394e61e9_46373552')) {function content_591437394e61e9_46373552($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>店铺管理</title>
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
td.fastedit {position: relative;}
td.fastedit:hover {background-color: #82af6f !important;color: #fff;}
/*td.fastedit:after {opacity:0;content:"快速编辑";position:absolute;left:0;top:0;right:0;text-align:center;background: #82af6f;color:#fff;-webkit-transition:top .3s ;transition:top .3s ;}*/
/*td.fastedit:hover::after {opacity:1;top:-15px;}*/
</style>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

      <div class="meng aa">
        <div class="pop-two">
          <div class="pop-cont align-center">
            <p><span style="position:relative;">店铺链接</span></p>
            <p class="seeurl"></p>
          </div>
          <div class="pop-bottom webkit-box1"><a class="order_true">确定</a></div>
        </div>
      </div>
      <div class="feng aa">
        <div class="pop-one">
          <div class="pop-cont align-center">
            <p><span style="position:relative;">店铺二维码</span></p>
            <p id="seeticket"></p>
          </div>
          <div class="pop-bottom webkit-box1"><a class="order_true">确定</a></div>
        </div>
      </div>
      <div class="">
        <div class="col-xs-12">
          <button class="btn btn-success"><a id="addNew" href="waimaiShopAdd.php" style="color:#fff;">新建店铺</a></button>
          <button class="btn btn-danger"><a id="syncShop" href="waimaiShopSync.php" style="color:#fff;">同步店铺</a></button>
          <div id="shopList" class="grid-view">
          <form action="waimaiShop.php" method="get">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th id="shopList_c0">店铺名称</th>
                  <th id="shopList_c1">序号</th>
                  <th id="shopList_c2">店铺分类</th>
                  <th id="shopList_c3">联系电话</th>
                  <th id="shopList_c4">店铺地址</th>
                  <th id="shopList_c5">店铺状态</th>
                  <th id="shopList_c6">微信下单</th>
                  <th id="shopList_c7">店铺链接</th>
                  <th id="shopList_c8">店铺二维码</th>
                  <th class="button-column" id="shopList_c9">商品管理</th>
                  <th id="shopList_c11">打印机</th>
                  <th id="shopList_c10">操作</th>
                </tr>
                <tr class="filters">
                  <td><input name="shopname" type="text" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['shopname']->value;?>
"></td>
                  <td>&nbsp;</td>
                  <td><input name="typename" type="text" value="<?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
"></td>
                  <td><input name="phone" type="text" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
"></td>
                  <td><input name="address" type="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
"></td>
                  <td><input type="submit" style="display: none;" /></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
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
                <tr data-url="<?php echo $_smarty_tpl->tpl_vars['l']->value['url'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
">
                  <td width="100" class="fastedit shopname" data-val="<?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
" contenteditable="true"><?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
</td>
                  <td width="50" class="fastedit sort" data-val="<?php echo $_smarty_tpl->tpl_vars['l']->value['sort'];?>
" contenteditable="true"><?php echo $_smarty_tpl->tpl_vars['l']->value['sort'];?>
</td>
                  <td width="80"><?php echo $_smarty_tpl->tpl_vars['l']->value['typename'];?>
</td>
                  <td width="80"><?php echo $_smarty_tpl->tpl_vars['l']->value['phone'];?>
</td>
                  <td width="150"><?php echo $_smarty_tpl->tpl_vars['l']->value['address'];?>
</td>
                  <td width="70">
                    <label class="statusSwitch" style="display: inline-block;">
                      <input class="ace ace-switch ace-switch-6" type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['status']) {?> checked="checked"<?php }?>>
                      <span class="lbl"></span>
                    </label>
                  </td>
                  <td width="70">
                    <label class="orderValidSwitch" style="display: inline-block;">
                      <input class="ace ace-switch ace-switch-6" type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['l']->value['ordervalid']) {?> checked="checked"<?php }?>>
                      <span class="lbl"></span>
                    </label>
                  </td>
                  <td width="60">
                    <div class="shopurl" style="background:#82AF6F;text-align:center;color:white;cursor:pointer;width:60px;">查看</div>
                  </td>
                  <td width="60">
                    <div class="shopticket" style="background:#82AF6F;text-align:center;color:white;cursor:pointer;width:60px;">查看</div>
                  </td>
                  <td width="60">
                    <a class="label label-success food" data-shopname="<?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" title="商品" href="waimaiFoodList.php?sid=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
">商品</a>
                    <a class="label label-info foodtype" data-shopname="<?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" title="商品分类" href="waimaiFoodType.php?sid=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
">商品分类</a>
                  </td>
                  <td width="60">
                    <?php if ($_smarty_tpl->tpl_vars['l']->value['print_state']==0) {?><font color="gray">未设置</font><?php } elseif ($_smarty_tpl->tpl_vars['l']->value['print_state']==1) {?><b style="color:green">在线</b><?php } elseif ($_smarty_tpl->tpl_vars['l']->value['print_state']==2) {?><b style="color:red">缺纸</b><?php } elseif ($_smarty_tpl->tpl_vars['l']->value['print_state']==3) {?><b style="color:red">离线</b><?php }?>
                  </td>
                  <td nowrap="nowrap" width="80">
                    <a href="waimaiShopAdd.php?id=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" title="修改" data-shopname="<?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" class="green edit" style="padding-right:8px;"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a title="删除" class="del red" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" style="padding-right:8px;cursor:pointer;" ><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php if (count($_smarty_tpl->tpl_vars['list']->value)==0) {?>
                <tr>
                  <td colspan="11" style="height: 200px; line-height: 200px; text-align: center;">没有找到数据.</td>
                </tr>
                <?php }?>
              </tbody>
            </table>

            </form>
            <?php echo $_smarty_tpl->tpl_vars['pagelist']->value;?>


          </div>
        </div>
      </div>

    </div>
  </div>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>