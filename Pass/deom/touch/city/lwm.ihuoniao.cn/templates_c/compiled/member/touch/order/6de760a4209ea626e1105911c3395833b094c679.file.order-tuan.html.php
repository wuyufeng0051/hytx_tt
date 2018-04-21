<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 09:27:33
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\order-tuan.html" */ ?>
<?php /*%%SmartyHeaderCode:97155924e18593c518-56101477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6de760a4209ea626e1105911c3395833b094c679' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\order-tuan.html',
      1 => 1494490906,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97155924e18593c518-56101477',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924e1859d0c30_49079020',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924e1859d0c30_49079020')) {function content_5924e1859d0c30_49079020($_smarty_tpl) {?>
<div class="tab">
  <ul data-url="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'orderdetail','module'=>'tuan','id'=>"%id%"),$_smarty_tpl);?>
">
  	<li data-id="" class="curr"><a href="javascript:;">全部 (<span id="total">0</span>)</a></li>
  	<li data-id="0"><a href="javascript:;">未付款 (<span id="unpaid">0</span>)</a></li>
  	<li data-id="1"><a href="javascript:;">已付款 (<span id="unused">0</span>)</a></li>
  	<li data-id="6"><a href="javascript:;">待收货 (<span id="recei">0</span>)</a></li>
  	<li data-id="3"><a href="javascript:;">成功 (<span id="used">0</span>)</a></li>
  	<li data-id="2"><a href="javascript:;">过期 (<span id="expired">0</span>)</a></li>
  	<li data-id="4"><a href="javascript:;">退款中 (<span id="refund">0</span>)</a></li>
  	<li data-id="5"><a href="javascript:;">待评价 (<span id="rates">0</span>)</a></li>
  	<li data-id="7"><a href="javascript:;">退款成功 (<span id="closed">0</span>)</a></li>
  </ul>
</div>
<?php }} ?>
