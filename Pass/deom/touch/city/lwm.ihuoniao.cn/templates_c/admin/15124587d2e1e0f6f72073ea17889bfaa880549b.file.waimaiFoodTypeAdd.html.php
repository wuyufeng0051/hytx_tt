<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 15:04:14
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiFoodTypeAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:2740759155dd6a03493-41086562%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15124587d2e1e0f6f72073ea17889bfaa880549b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiFoodTypeAdd.html',
      1 => 1494572654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2740759155dd6a03493-41086562',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59155dd6a516a2_28494588',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'sid' => 0,
    'id' => 0,
    'title' => 0,
    'sort' => 0,
    'status' => 0,
    'start_time' => 0,
    'end_time' => 0,
    'weekshow' => 0,
    'week' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59155dd6a516a2_28494588')) {function content_59155dd6a516a2_28494588($_smarty_tpl) {?><!DOCTYPE html>
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
", sid = <?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
;
<?php echo '</script'; ?>
>
<style>
label {display: inline-block;}
.tab-content {overflow: visible;}
input, textarea, .uneditable-input {width: auto;}
input[type="radio"], input[type="checkbox"] {margin: 0 3px 0 0;}
.weekShowSwitch{ display: none; } #foodtypeList .tagInput{ font-size:12px; color:black; display:none; width:100%; }
</style>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
          <div class="col-sm-11">
            <form enctype="multipart/form-data" class="form-horizontal" id="shop-form" action="?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" method="post" style="padding-top: 15px;">
              <div class="form-group">
                <label class="col-sm-1"><label for="FoodType_name">分类名称</label></label>
                <input class="col-sm-1" size="10" maxlength="10" name="title" id="FoodType_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" /> （分类名称只能为1-10个字）
              </div>
              <div class="form-group">
                <label class="col-sm-1"><label for="FoodType_tag">分类编号</label></label>
                <input class="col-sm-1" size="10" maxlength="10" name="sort" id="FoodType_tag" type="text" value="<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['sort']->value);?>
" />（决定展示顺序，编号越大越靠前）
              </div>
              <div class="form-group">
                <label class="col-sm-1" for="FoodType_is_show">是否显示商品分类</label>
                <select name="status" id="FoodType_is_show">
                  <option value="0"<?php if ($_smarty_tpl->tpl_vars['status']->value==0&&$_smarty_tpl->tpl_vars['status']->value!='') {?> selected<?php }?>>关闭</option>
                  <option value="1"<?php if ($_smarty_tpl->tpl_vars['status']->value||$_smarty_tpl->tpl_vars['status']->value=='') {?> selected<?php }?>>开启</option>
                </select>
              </div>
              <div class="form-group">
                <label class="col-sm-1" for="FoodType_showtime">商品分类显示时间段</label>
                <input id="showtime_start_time" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['start_time']->value) {
echo $_smarty_tpl->tpl_vars['start_time']->value;
} else { ?>00:00<?php }?>" name="start_time" />至
                <input id="showtime_stop_time" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['end_time']->value) {
echo $_smarty_tpl->tpl_vars['end_time']->value;
} else { ?>00:00<?php }?>" name="end_time" />
              </div>
              <div class="form-group">
                <label class="col-sm-1" for="FoodType_is_weekshow">是否开启只星期几显示</label>
                <select name="weekshow" id="FoodType_is_weekshow">
                  <option value="0"<?php if (!$_smarty_tpl->tpl_vars['weekshow']->value) {?> selected<?php }?>>关闭</option>
                  <option value="1"<?php if ($_smarty_tpl->tpl_vars['weekshow']->value) {?> selected<?php }?>>开启</option>
                </select>
              </div>
              <div class="form-group">
                <label class="col-sm-1" for="FoodType_week">星期几显示</label>
                <div class="col-sm-10" style="margin-top:5px;">
                  <label style="width:80px;float:left;font-size:16px;"><input class="check_week" type="checkbox" value="1" name="week[]"<?php if (strstr($_smarty_tpl->tpl_vars['week']->value,"1")) {?> checked<?php }?>>星期一&nbsp;&nbsp;</label>
                  <label style="width:80px;float:left;font-size:16px;"><input class="check_week" type="checkbox" value="2" name="week[]"<?php if (strstr($_smarty_tpl->tpl_vars['week']->value,"2")) {?> checked<?php }?>>星期二&nbsp;&nbsp;</label>
                  <label style="width:80px;float:left;font-size:16px;"><input class="check_week" type="checkbox" value="3" name="week[]"<?php if (strstr($_smarty_tpl->tpl_vars['week']->value,"3")) {?> checked<?php }?>>星期三&nbsp;&nbsp;</label>
                  <label style="width:80px;float:left;font-size:16px;"><input class="check_week" type="checkbox" value="4" name="week[]"<?php if (strstr($_smarty_tpl->tpl_vars['week']->value,"4")) {?> checked<?php }?>>星期四&nbsp;&nbsp;</label>
                  <label style="width:80px;float:left;font-size:16px;"><input class="check_week" type="checkbox" value="5" name="week[]"<?php if (strstr($_smarty_tpl->tpl_vars['week']->value,"5")) {?> checked<?php }?>>星期五&nbsp;&nbsp;</label>
                  <label style="width:80px;float:left;font-size:16px;"><input class="check_week" type="checkbox" value="6" name="week[]"<?php if (strstr($_smarty_tpl->tpl_vars['week']->value,"6")) {?> checked<?php }?>>星期六&nbsp;&nbsp;</label>
                  <label style="width:80px;float:left;font-size:16px;"><input class="check_week" type="checkbox" value="7" name="week[]"<?php if (strstr($_smarty_tpl->tpl_vars['week']->value,"7")) {?> checked<?php }?>>星期日&nbsp;&nbsp;</label>
                </div>
              </div>
              <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                  <button class="btn btn-info" type="submit" id="submitBtn" onclick="return checkFrom(this.form)"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>
              </div>
            </form>
          </div>
        </div>

    </div>
  </div>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
