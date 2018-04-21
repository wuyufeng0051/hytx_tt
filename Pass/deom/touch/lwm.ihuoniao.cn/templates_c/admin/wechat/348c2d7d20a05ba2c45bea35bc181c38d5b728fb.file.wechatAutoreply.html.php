<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-09 09:30:57
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\wechat\wechatAutoreply.html" */ ?>
<?php /*%%SmartyHeaderCode:107985939fa51ecac02-07096578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '348c2d7d20a05ba2c45bea35bc181c38d5b728fb' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\wechat\\wechatAutoreply.html',
      1 => 1494490308,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107985939fa51ecac02-07096578',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'wechatSubscribeType' => 0,
    'wechatSubscribe' => 0,
    'wechatSubscribeMedia' => 0,
    'list' => 0,
    'l' => 0,
    'k' => 0,
    'adminPath' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5939fa51f28813_06150277',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5939fa51f28813_06150277')) {function content_5939fa51f28813_06150277($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>微信自动回复</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<style media="screen">
    .list dl {margin: 0; padding: 15px 0; border-bottom: 1px solid #d9d9d9;}
    .list dl:hover {background: rgb(255, 251, 227); border-bottom: 1px solid rgb(255, 224, 191);}
    .list dt, .list dd {float: left; margin: 0; padding: 0;}
    .list .tr .sel, .list .tr .media {float: none; text-align: left; line-height: 20px;}
    .list .tr .media {margin-top: 5px;}
    .list .tr .sel label {display: inline-block; margin: 0; margin-right: 20px;}
</style>
</head>

<body>
<div class="alert alert-success" style="margin:10px 10px 0;"><button type="button" class="close" data-dismiss="alert">×</button>配置说明：<a href="http://help.ikuman.cn/help-50-11.html" target="_blank">http://help.ikuman.cn/help-50-11.html</a></div>

<ul class="thead clearfix" style="position:relative; top:20px; left:0; right:0; margin:0 10px;">
  <li class="row3">&nbsp;</li>
  <li class="row30 left">关键字</li>
  <li class="row50 left">响应内容</li>
  <li class="row17 left">操作</li>
</ul>

<form class="list mb50" id="list" style="margin-top: 20px;">
  <dl class="tr clearfix">
      <dt class="row3">&nbsp;</dt>
      <dt class="row30">关注后自动回复</dt>
      <dd class="row50">
          <div class="sel"><label><input type="radio" name="subscribeType" value="1"<?php if ($_smarty_tpl->tpl_vars['wechatSubscribeType']->value==0||$_smarty_tpl->tpl_vars['wechatSubscribeType']->value==1) {?> checked<?php }?>>自定义</label><label><input type="radio" name="subscribeType" value="2"<?php if ($_smarty_tpl->tpl_vars['wechatSubscribeType']->value==2) {?> checked<?php }?>>微信素材</label></div>
          <textarea name="subscribe" id="subscribe" class="input-xxlarge<?php if ($_smarty_tpl->tpl_vars['wechatSubscribeType']->value==2) {?> hide<?php }?>" placeholder="请输入响应内容"><?php echo $_smarty_tpl->tpl_vars['wechatSubscribe']->value;?>
</textarea>
          <div class="media<?php if ($_smarty_tpl->tpl_vars['wechatSubscribeType']->value!=2) {?> hide<?php }?>"><label><?php if ($_smarty_tpl->tpl_vars['wechatSubscribeMedia']->value) {?>素材ID【<?php echo $_smarty_tpl->tpl_vars['wechatSubscribeMedia']->value;?>
】<?php }?></label><a href="javascript:;">选择素材</a></div>
          <input type="hidden" name="subscribeMedia" value="<?php echo $_smarty_tpl->tpl_vars['wechatSubscribeMedia']->value;?>
">
      </dd>
      <dd class="row17">&nbsp;</dd>
  </dl>
  <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['l']->key;
?>
  <dl class="tr clearfix" data-id="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
">
    <input type="hidden" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" />
    <dt class="row3">&nbsp;</dt>
    <dt class="row30"><input type="text" class="input-large" name="keyword[]" placeholder="关键字" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['key'];?>
"></dt>
    <dd class="row50">
        <div class="sel"><label><input type="radio" name="type[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
]" value="1"<?php if ($_smarty_tpl->tpl_vars['l']->value['type']==1) {?> checked<?php }?>>自定义</label><label><input type="radio" name="type[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
]" value="2"<?php if ($_smarty_tpl->tpl_vars['l']->value['type']==2) {?> checked<?php }?>>微信素材</label></div>
        <textarea name="body[]" class="input-xxlarge<?php if ($_smarty_tpl->tpl_vars['l']->value['type']==2) {?> hide<?php }?>" placeholder="请输入响应内容"><?php echo $_smarty_tpl->tpl_vars['l']->value['body'];?>
</textarea>
        <div class="media<?php if ($_smarty_tpl->tpl_vars['l']->value['type']==1) {?> hide<?php }?>"><label><?php if ($_smarty_tpl->tpl_vars['l']->value['media']) {?>素材ID【<?php echo $_smarty_tpl->tpl_vars['l']->value['media'];?>
】<?php }?></label><a href="javascript:;">选择素材</a></div>
        <input type="hidden" name="media[]" value="<?php echo $_smarty_tpl->tpl_vars['l']->value['media'];?>
">
    </dd>
    <dd class="row17"><a href="javascript:;" class="del" title="删除">删除</a></dd>
  </dl>
  <?php } ?>
  <div class="tr clearfix">
    <div class="row3"></div>
    <div class="row80 left"><a href="javascript:;" class="add-type" style="display:inline-block; margin-left: 0;" id="addNew">新增关键字</a></div>
  </div>
</form>
<div class="fix-btn"><button type="button" class="btn btn-success" id="saveBtn">保存</button></div>

<?php echo '<script'; ?>
>
  var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
