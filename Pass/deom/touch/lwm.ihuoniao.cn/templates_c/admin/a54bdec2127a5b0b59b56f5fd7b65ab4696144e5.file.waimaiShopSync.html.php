<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-13 16:44:53
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiShopSync.html" */ ?>
<?php /*%%SmartyHeaderCode:7705593fa605476de6-58874245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a54bdec2127a5b0b59b56f5fd7b65ab4696144e5' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiShopSync.html',
      1 => 1497343143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7705593fa605476de6-58874245',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'list' => 0,
    'l' => 0,
    'type' => 0,
    't' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593fa6054e8272_24240187',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593fa6054e8272_24240187')) {function content_593fa6054e8272_24240187($_smarty_tpl) {?><!DOCTYPE html>
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
.chzn-container {vertical-align: middle;}
</style>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">
      <style>.ace-file-input a {display:none;} .aa{display:none;}</style>
      <div class="row">
        <div class="col-xs-12">
          <form action="" method="post" id="syncForm">
            <label style="margin-right:20px;">需要同步设置的源店铺：</label>
            <select class="chosen-select" name="courier_id" id="courier_id">
              <option value="0">请选择</option>
              <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
</option>
              <?php } ?>
            </select>
            <br>
            <h4 class="widget-title">需要同步的设置：</h4>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[paytype]" value="1" id="pay">
                  <span class="lbl"><label for="pay">支付方式</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[active]" value="1" id="active">
                  <span class="lbl"><label for="active">店铺活动</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[options]" value="1" id="options">
                  <span class="lbl"><label for="options">预设选项</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[addservice]" value="1" id="addservice">
                  <span class="lbl"><label for="addservice">增值服务</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[weeks]" value="1" id="weeks">
                  <span class="lbl"><label for="weeks">营业星期</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[shop_active_time]" value="1" id="shop_active_time">
                  <span class="lbl"><label for="shop_active_time">营业时间段</label></span>
                </label>
              </div>
            </div>

            <!-- sssssssssssssssssssssssssssss -->
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[delivery_mode]" value="1" id="delivery_mode">
                  <span class="lbl"><label for="delivery_mode">起送价、配送费模式</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[delivery_fee]" value="1" id="delivery_fee">
                  <span class="lbl"><label for="delivery_fee">固定配送费</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[basicprice]" value="1" id="basicprice">
                  <span class="lbl"><label for="basicprice">固定起送价</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[no_delivery_fee_value]" value="1" id="no_delivery_fee_value">
                  <span class="lbl"><label for="no_delivery_fee_value">固定满免配送费金额</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[area_data]" value="1" id="area_data">
                  <span class="lbl"><label for="area_data">配送区域及对应配送费、起送价</label></span>
                </label>
              </div>
            </div>
            <!-- sssssssssssssssssssssssssssss -->

            <!-- <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[deliveryfee]" value="1" id="deliveryfee">
                  <span class="lbl"><label for="deliveryfee">配送费</label></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[basicprice]" value="1" id="basicprice">
                  <span class="lbl"><label for="basicprice">起送价</label></span>
                </label>
              </div>
            </div> -->

            <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[order_voice_remind]" value="1" id="order_voice_remind">
                  <span class="lbl"><label for="order_voice_remind">订单语音提醒</label></span>
                </label>
              </div>
            </div>
            <!-- <div class="form-group">
              <div class="radio">
                <label>
                  <input class="paycheck ace" type="checkbox" name="SetShop[linktype]" value="1" id="linktype">
                  <span class="lbl"><label for="linktype">点单进入首页还是选购</label></span>
                </label>
              </div>
            </div> -->
            <div class="control-group" style="display: inline">
              <label class="control-label  ">同步方式：</label>
              <div class="radio" style="display: inline">
                <label>
                  <input name="SetShop[syn_type]" value="1" type="radio" class="ace">
                  <span class="lbl" style="z-index: 1">全部店铺</span></label>
              </div>
              <div class="radio" style="display: inline">
                <label>
                  <input name="SetShop[syn_type]" value="2" checked="" type="radio" class="ace">
                  <span class="lbl" style="z-index: 1">指定店铺</span></label>
              </div>
              <div class="radio" style="display: inline">
                <label>
                  <input name="SetShop[syn_type]" value="3" type="radio" class="ace">
                  <span class="lbl" style="z-index: 1">店铺分类</span></label>
              </div>
            </div>
            <div style="height: 15px;"></div>
            <div id="sel_shop">
              <label for="SetShop_shop_ids">要同步到的店铺：</label>
              <select style="width: 300px; display: none;" multiple="multiple" name="SetShop_ids[]" class="chosen-select" id="form-field-select-4" data-placeholder="多选">
                <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['shopname'];?>
</option>
                <?php } ?>
              </select>
            </div>
            <div style="display:none" class="shop_type">
              <label>要同步店铺的分类：</label>
              <select style="width:287px;" name="shop_type" class="chosen-select" id="shop_type">
                <option value="0">请选择</option>
                <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['type']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['t']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['t']->value['title'];?>
</option>
                <?php } ?>
              </select>
            </div>
            <div class="span12" style="margin-top:10px;">
              <div class="form-actions">
                <button class="btn btn-info" type="submit" id="submitBtn">
                  <i class="ace-icon fa fa-check bigger-110"></i>保存</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
   </div>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
