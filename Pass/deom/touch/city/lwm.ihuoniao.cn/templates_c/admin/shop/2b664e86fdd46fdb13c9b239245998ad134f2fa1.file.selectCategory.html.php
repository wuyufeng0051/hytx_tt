<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-09 11:48:50
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\shop\selectCategory.html" */ ?>
<?php /*%%SmartyHeaderCode:8706593a1aa2614e38-05382909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b664e86fdd46fdb13c9b239245998ad134f2fa1' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\shop\\selectCategory.html',
      1 => 1494490291,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8706593a1aa2614e38-05382909',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'typeid' => 0,
    'id' => 0,
    'proType' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593a1aa26380c9_33018750',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593a1aa26380c9_33018750')) {function content_593a1aa26380c9_33018750($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>上架新商品</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<style>
<!--
.t-main {position:relative; width:1000px; border:1px solid #abcafb; background:#f0f6ff;}
.t-main .cc-nav {position:absolute; top:145px; width:23px; height:70px; cursor:pointer; text-indent:-9999em; background:url(../../../static/images/admin/arrow.png) no-repeat; display:none;}
.t-main .prev {left:5px;}
.t-main .next {right:5px; background-position:-23px 0;}
.t-main .t-list {position:relative; margin:25px 12px 25px 28px; width:944px; height:340px; overflow:hidden;}
.t-main .t-ol {position:absolute; top:0; left:0; margin:0; padding:0; width:2000em;}
.t-list .t-item {float:left; width:215px; padding:5px; margin:0; margin-right:12px; background:#fff; border:1px solid #abcafb;}
.t-list .t-item dt {float:none; width:100%; height:25px; padding:0; text-align:left;}
.t-list .t-item dt label {height:25px; display:block; line-height:25px; border:1px solid #abcafb;}
.t-list .t-item dt label s {float:left; width:17px; height:17px; margin:3px; background:url(../../../static/images/admin/pubIcon.png) -183px -72px;}
.t-list .t-item dt label input {float:left; width:188px; height:23px; line-height:23px; margin:0; padding:0; box-shadow:none; border:none;}
.t-list .t-item dd {padding:0; margin:0; height:300px; overflow:auto;}
.t-list .t-item dd ul {margin:0;}
.t-list .t-item dd li {list-style:none; line-height:31px; font-size:14px; text-indent:10px; border-bottom:1px dashed #ccc;}
.t-list .t-item dd li .t-name {color:#3366cc; cursor:default; display:block;}
.t-list .t-item dd li .t-name s {text-decoration:none; margin-left:5px; font-family:Georgia, "Times New Roman", Times, serif; font-size:12px;}
.t-list .t-item dd .sub-nav {margin:-6px 0 -1px; padding-bottom:4px; display:none;}
.t-list .t-item dd .sub-nav li {position:relative; line-height:25px; border:1px solid #fff; cursor:pointer; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.t-list .t-item dd .sub-nav li s {position:absolute; right:10px; top:8px; width:5px; height:9px; background:url(../../../static/images/admin/pubIcon.png) -194px -94px;}
.t-list .t-item dd .sub-nav li.selected {border:1px dotted #82bce0; background:#dff1fb;}
.t-list .t-item dd .sub {margin:0; padding:0; display:block;}
.confrim {width:980px; border:1px solid #fedbab; background:#fffaf2; padding:5px 10px; margin:15px 0; line-height:2em; font-size:14px;}
#btnNext {margin-left:420px;}
.t-list .t-item dd li.nob {border-bottom:none;}
-->
</style>
</head>

<body>
<form class="editform" method="post" action="productAdd.php?action=productAdd">
  <input type="hidden" name="typeid" id="typeid" value="<?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
" />
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <dl class="clearfix">
    <dt>选择分类：</dt>
    <dd>
      <div class="t-main">
        <s class="cc-nav prev" title="上一级">上一级</s>
        <div class="t-list">
          <ol class="t-ol clearfix" id="tList"></ol>
        </div>
        <s class="cc-nav next" title="下一级">下一级</s>
      </div>
      <div class="confrim">
        <strong>您当前选择的是：</strong><span id="cTxt"><?php echo $_smarty_tpl->tpl_vars['proType']->value;?>
</span>
      </div>
      <input class="btn btn-large<?php if ($_smarty_tpl->tpl_vars['typeid']->value!='') {?> btn-primary<?php }?>" type="submit" name="submit" id="btnNext" value="确认，下一步" <?php if ($_smarty_tpl->tpl_vars['typeid']->value=='') {?>disabled<?php }?> />
    </dd>
  </dl>
</form>

<?php echo '<script'; ?>
>var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
