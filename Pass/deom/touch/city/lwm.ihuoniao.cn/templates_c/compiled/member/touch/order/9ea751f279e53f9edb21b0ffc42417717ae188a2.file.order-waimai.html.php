<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 10:16:49
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\order-waimai.html" */ ?>
<?php /*%%SmartyHeaderCode:307685924028d618448-48152566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ea751f279e53f9edb21b0ffc42417717ae188a2' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\order-waimai.html',
      1 => 1495592188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '307685924028d618448-48152566',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924028d62bcc9_88820976',
  'variables' => 
  array (
    'userid' => 0,
    'pageInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924028d62bcc9_88820976')) {function content_5924028d62bcc9_88820976($_smarty_tpl) {?><style media="screen">
    .list {margin-top: 1rem;}
    .food {color: #333; border-bottom: 1px solid #f4f4f4; padding: 0 0 .1rem; margin-bottom: .1rem;}
</style>
<?php echo '<script'; ?>
 type="text/javascript">
  var userid = <?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
, detailUrl = '<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'orderdetail','module'=>'waimai','userid'=>"%id%"),$_smarty_tpl);?>
';
<?php echo '</script'; ?>
>
<!-- <div class="tab">
  <ul data-url="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'orderdetail','module'=>'waimai','userid'=>"%id%"),$_smarty_tpl);?>
">
    <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>'order','return'=>'order','userid'=>$_tmp1,'pageSize'=>'1')); $_block_repeat=true; echo waimai(array('action'=>'order','return'=>'order','userid'=>$_tmp1,'pageSize'=>'1'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>'order','return'=>'order','userid'=>$_tmp1,'pageSize'=>'1'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

  	<li data-id="" class="curr"><a href="javascript:;">全部 (<span id="total"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['pageInfo']->value['totalCount']);?>
</span>)</a></li>
  	<li data-id="0"><a href="javascript:;">未付款 (<span id="state0"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['pageInfo']->value['state0']);?>
</span>)</a></li>
  	<li data-id="1"><a href="javascript:;">已付款 (<span id="state1"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['pageInfo']->value['state1']);?>
</span>)</a></li>
  	<li data-id="2"><a href="javascript:;">送餐中 (<span id="state2"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['pageInfo']->value['state2']);?>
</span>)</a></li>
  	<li data-id="3"><a href="javascript:;">成功 (<span id="state3"><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['pageInfo']->value['state3']);?>
</span>)</a></li>
  </ul>
</div> -->
<?php }} ?>
