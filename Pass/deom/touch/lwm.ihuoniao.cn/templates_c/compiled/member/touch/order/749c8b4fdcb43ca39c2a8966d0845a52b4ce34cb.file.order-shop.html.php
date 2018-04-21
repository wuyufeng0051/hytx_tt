<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:47:43
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\order-shop.html" */ ?>
<?php /*%%SmartyHeaderCode:299045924053f0f9826-18923555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749c8b4fdcb43ca39c2a8966d0845a52b4ce34cb' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\order-shop.html',
      1 => 1494490901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '299045924053f0f9826-18923555',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924053f1341b1_93578910',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924053f1341b1_93578910')) {function content_5924053f1341b1_93578910($_smarty_tpl) {?>
<div class="tab">
  <ul data-url="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'orderdetail','module'=>'shop','id'=>"%id%"),$_smarty_tpl);?>
" data-refund="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'orderdetail','module'=>'shop','id'=>"%id%",'param'=>'rates=1'),$_smarty_tpl);?>
" data-comment="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'write-comment','module'=>'shop','id'=>"%id%"),$_smarty_tpl);?>
">
    <li data-id="" class="curr"><a href="javascript:;">全部 (<span id="total">0</span>)</a></li>
  	<li data-id="0"><a href="javascript:;">未付款 (<span id="unpaid">0</span>)</a></li>
  	<li data-id="1"><a href="javascript:;">待发货 (<span id="unused">0</span>)</a></li>
  	<li data-id="6"><a href="javascript:;">待收货 (<span id="recei">0</span>)</a></li>
  	<li data-id="3"><a href="javascript:;">成功 (<span id="used">0</span>)</a></li>
  	<li data-id="4"><a href="javascript:;">退款中 (<span id="refund">0</span>)</a></li>
  	<li data-id="5"><a href="javascript:;">待评价 (<span id="rates">0</span>)</a></li>
  	<li data-id="7"><a href="javascript:;">退款成功 (<span id="closed">0</span>)</a></li>
  	<li data-id="10"><a href="javascript:;">关闭 (<span id="cancel">0</span>)</a></li>
  </ul>
</div>
<?php }} ?>
