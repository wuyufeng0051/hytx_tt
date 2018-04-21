<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-18 09:50:00
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\member\withdrawEdit.html" */ ?>
<?php /*%%SmartyHeaderCode:177975945dc487f5299-88254222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42d74331564b7374e1fa3bf750d3d693f2ac3c14' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\member\\withdrawEdit.html',
      1 => 1494490298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177975945dc487f5299-88254222',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'pagetitle' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'dopost' => 0,
    'id' => 0,
    'bank' => 0,
    'cardnum' => 0,
    'cardname' => 0,
    'tdate' => 0,
    'amount' => 0,
    'uid' => 0,
    'username' => 0,
    'state' => 0,
    'note' => 0,
    'rdate' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5945dc4886a5a2_28203552',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5945dc4886a5a2_28203552')) {function content_5945dc4886a5a2_28203552($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title><?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = '<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
', adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="dopost" id="dopost" value="<?php echo $_smarty_tpl->tpl_vars['dopost']->value;?>
" />
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <?php if ($_smarty_tpl->tpl_vars['bank']->value=="alipay") {?>
  <dl class="clearfix">
    <dt>提现到：</dt>
    <dd class="singel-line">支付宝</dd>
  </dl>
  <dl class="clearfix">
    <dt>收款人帐号：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['cardnum']->value;?>
</dd>
  </dl>
  <dl class="clearfix">
    <dt>收款人姓名：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['cardname']->value;?>
</dd>
  </dl>
  <?php } else { ?>
  <dl class="clearfix">
    <dt>提现银行：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['bank']->value;?>
</dd>
  </dl>
  <dl class="clearfix">
    <dt>提现卡号：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['cardnum']->value;?>
</dd>
  </dl>
  <dl class="clearfix">
    <dt>收  款  人：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['cardname']->value;?>
</dd>
  </dl>
  <?php }?>
  <dl class="clearfix">
    <dt>申请时间：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['tdate']->value;?>
</dd>
  </dl>
  <dl class="clearfix">
    <dt>提现金额：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
</dd>
  </dl>
  <dl class="clearfix">
    <dt>申请会员：</dt>
    <dd class="singel-line"><a href="javascript:;" data-id="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" class="userinfo"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a></dd>
  </dl>

  <?php if ($_smarty_tpl->tpl_vars['state']->value!=0) {?>
  <dl class="clearfix">
    <dt>申请状态：</dt>
    <dd class="singel-line">
      <?php if ($_smarty_tpl->tpl_vars['state']->value==1) {?>
      成功
      <?php } elseif ($_smarty_tpl->tpl_vars['state']->value==2) {?>
      失败
      <?php }?>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>备注：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</dd>
  </dl>  
  <dl class="clearfix">
    <dt>操作时间：</dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['rdate']->value;?>
</dd>
  </dl>  
  <?php }?>

<br /><br />

  <?php if ($_smarty_tpl->tpl_vars['state']->value==0) {?>
  <dl class="clearfix">
    <dt>状态：</dt>
    <dd class="radio">
      <label><input type="radio" name="state" value="1">成功</label>
      <label><input type="radio" name="state" value="2">失败</label>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>备注：</dt>
    <dd class="radio">
      <textarea class="input-xxlarge" type="text" name="note" id="note"></textarea>
    </dd>
  </dl>  
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><button class="btn btn-large btn-success" type="submit" name="button" id="btnSubmit">确认提交</button></dd>
  </dl>
  <?php }?>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
