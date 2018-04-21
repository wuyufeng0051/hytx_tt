<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-26 11:48:13
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiCourierAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:1885059279d81a4ff37-51166502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd558d6a336a65a3b47f455f253679df74709932b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiCourierAdd.html',
      1 => 1495770489,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1885059279d81a4ff37-51166502',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59279d81a6f342_57278635',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'id' => 0,
    'name' => 0,
    'username' => 0,
    'password' => 0,
    'phone' => 0,
    'age' => 0,
    'sex' => 0,
    'photo' => 0,
    'cfg_attachment' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59279d81a6f342_57278635')) {function content_59279d81a6f342_57278635($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>创建/修改配送员</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

        <div class="clearfix" style="padding: 20px;">
        <div class="col-sm-11">
          <form class="form-horizontal" id="shop-form" action="waimaiCourierAdd.php" method="post">
            <input name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" type="hidden">
            <div class="form-group">
              <label class="col-sm-1"><label for="name">姓名</label></label>
              <input class="col-sm-2" size="20" maxlength="20" name="name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" />
            </div>
            <div class="form-group">
              <label class="col-sm-1"><label for="username">用户名</label></label>
              <input class="col-sm-2" size="20" maxlength="20" name="username" type="text" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" />
            </div>
            <div class="form-group">
              <label class="col-sm-1"><label for="password">app密码</label></label>
              <input class="col-sm-2" maxlength="16" name="password" type="password" value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
" />
            </div>
            <div class="form-group">
              <label class="col-sm-1"><label for="phone">手机号</label></label>
              <input class="col-sm-2" size="20" maxlength="20" name="phone" type="text" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
" />
            </div>
            <div class="form-group">
              <label class="col-sm-1"><label for="age">年龄</label></label>
              <input class="col-sm-2" size="3" maxlength="3" name="age" type="text" value="<?php echo $_smarty_tpl->tpl_vars['age']->value;?>
" />
            </div>
            <div class="form-group">
              <label class="col-sm-1" for="sex">性别</label>
              <select name="sex">
                <option value="1"<?php if ($_smarty_tpl->tpl_vars['sex']->value) {?> selected="selected"<?php }?>>男</option>
                <option value="0"<?php if (!$_smarty_tpl->tpl_vars['sex']->value&&$_smarty_tpl->tpl_vars['sex']->value!='') {?> selected="selected"<?php }?>>女</option>
              </select>
            </div>
            <div class="form-group">
              <label class="col-sm-1" for="Config_share_image">头像</label>
              <div class="fn-clear listImgBox" style="float: left;">
                  <div class="thumb" style="width: auto;">
                      <div class="uploadinp filePicker thumbtn"<?php if ($_smarty_tpl->tpl_vars['photo']->value!='') {?> style="display:none;"<?php }?> id="filePicker1" data-type="thumb"  data-count="1" data-size="1024" data-imglist=""><div></div><span></span></div>
                      <?php if ($_smarty_tpl->tpl_vars['photo']->value!='') {?>
                      <ul id="listSection1" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['photo']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['photo']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
                      <?php } else { ?>
                      <ul id="listSection1" class="listSection thumblist fn-clear"></ul>
                      <?php }?>
                      <input type="hidden" name="photo" value="<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" class="imglist-hidden" id="litpic">
                  </div>
              </div>
            </div>
            <div class="clearfix form-actions">
              <div class="col-md-9">
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
