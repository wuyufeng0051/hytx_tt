<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:28:22
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\order-build.html" */ ?>
<?php /*%%SmartyHeaderCode:13294592400b63af473-94190151%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '529e3b7d2097ea6d91ae995f80a47c5694988166' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\order-build.html',
      1 => 1494490894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13294592400b63af473-94190151',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592400b63edc85_87394898',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592400b63edc85_87394898')) {function content_592400b63edc85_87394898($_smarty_tpl) {?><ul class="main-sub-tab" data-url="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'orderdetail','module'=>'build','id'=>"%id%"),$_smarty_tpl);?>
" data-refund="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'orderdetail','module'=>'build','id'=>"%id%",'param'=>'rates=1'),$_smarty_tpl);?>
" data-comment="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'write-comment','module'=>'build','id'=>"%id%"),$_smarty_tpl);?>
">
	<li data-id=""><a href="javascript:;">全部 (<span id="total">0</span>)</a></li>
	<li data-id="0"><a href="javascript:;">未付款 (<span id="unpaid">0</span>)</a></li>
	<li data-id="1"><a href="javascript:;">待发货 (<span id="unused">0</span>)</a></li>
	<li data-id="6"><a href="javascript:;">待收货 (<span id="recei">0</span>)</a></li>
	<li data-id="3"><a href="javascript:;">成功 (<span id="used">0</span>)</a></li>
	<li data-id="4"><a href="javascript:;">退款中 (<span id="refund">0</span>)</a></li>
	<li data-id="5"><a href="javascript:;">待评价 (<span id="rates">0</span>)</a></li>
	<li data-id="7"><a href="javascript:;">退款成功 (<span id="closed">0</span>)</a></li>
	<li data-id="10"><a href="javascript:;">关闭 (<span id="cancel">0</span>)</a></li>
</ul>
<table class="oh">
	<colgroup>
		<col style="width:38%;">
		<col style="width:10%;">
		<col style="width:7%;">
		<col style="width:17%;">
		<col style="width:16%;">
		<col style="width:12%;">
	</colgroup>
	<tbody>
		<tr>
			<td>商品</td>
			<td>单价(元)</td>
			<td>数量</td>
			<td>实付款(元)</td>
			<td>状态</td>
			<td>操作</td>
		</tr>
	</tbody>
</table>
<?php }} ?>
