<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 15:30:36
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiTypeAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:197255915646369fbb0-05092544%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90213a8a3569e0ba0d1baea83ec07f8830437fb6' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiTypeAdd.html',
      1 => 1494574235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197255915646369fbb0-05092544',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591564636d2839_03234726',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'id' => 0,
    'sort' => 0,
    'title' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591564636d2839_03234726')) {function content_591564636d2839_03234726($_smarty_tpl) {?><!DOCTYPE html>
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
</head>

<body>
<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

      <div class="">
        <div class="col-sm-12">
          <form enctype="multipart/form-data" class="form-horizontal" id="shoptype-form" action="waimaiTypeAdd.php" method="post">
            <div class="alert alert-danger" id="shoptype-form_es_" style="display:none">
              <p>请更正下列输入错误:</p>
              <ul><li>dummy</li></ul>
            </div>
            <!---->
            <input name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" type="hidden">
            <div class="form-group">
              <label class="col-sm-1"><label for="ShopType_tag">店铺分类编号</label></label>
              <input class="col-sm-1" size="10" maxlength="10" name="sort" id="ShopType_tag" type="text" value="<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['sort']->value);?>
">
              <span class="help-button">
                <span class="ace-icon fa fa-info bigger-120" data-rel="popover" data-trigger="hover" data-placement="right" data-content="决定展示顺序，编号越小越靠前" title="" data-original-title="店铺分类编号说明"></span>
                <div class="popover fade right in" style="top:-24px;left:300.39px;display:none;">
                  <div class="arrow" style="top:50%;"></div>
                  <h3 class="popover-title">店铺分类编号说明</h3>
                  <div class="popover-content">决定展示顺序，编号越大越靠前</div>
                </div>
              </span>
            </div>
            <div class="form-group">
              <label class="col-sm-1"><label for="ShopType_name">店铺分类名称</label></label>
              <input class="col-sm-1" size="10" maxlength="10" name="title" id="ShopType_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"></div>
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

<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
    $('[data-rel="popover"]').popover();
});

//表单提交
function checkFrom(form){
    var form = $("#shoptype-form"), action = form.attr("action"), data = form.serialize();
    var btn = $("#submitBtn");

    btn.attr("disabled", true);

    $.ajax({
        url: action,
        type: "post",
        data: data,
        dataType: "json",
        success: function(res){
            if(res.state == 100){
                location.href = "waimaiType.php";
            }else{
                $.dialog.alert(res.info);
                btn.attr("disabled", false);
            }
        },
        error: function(){
            $.dialog.alert("网络错误，保存失败！");
            btn.attr("disabled", false);
        }
    })

}
<?php echo '</script'; ?>
>
<?php }} ?>
