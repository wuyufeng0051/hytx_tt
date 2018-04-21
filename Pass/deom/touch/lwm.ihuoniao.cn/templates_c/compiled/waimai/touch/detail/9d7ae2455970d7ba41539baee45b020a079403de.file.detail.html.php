<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-28 18:45:20
         compiled from "D:\wwwroot\deom\touch\lwm.ihuoniao.cn\templates\courier\detail.html" */ ?>
<?php /*%%SmartyHeaderCode:1884595388c0c9de57-38901212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d7ae2455970d7ba41539baee45b020a079403de' => 
    array (
      0 => 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\templates\\courier\\detail.html',
      1 => 1498125128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1884595388c0c9de57-38901212',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'detail_food' => 0,
    'food' => 0,
    'detail_priceinfo' => 0,
    'price' => 0,
    'detail_paytype' => 0,
    'detail_amount' => 0,
    'detail_note' => 0,
    'detail_shopname' => 0,
    'detail_coordY' => 0,
    'detail_coordX' => 0,
    'detail_shopaddr' => 0,
    'detail_shoptel' => 0,
    'detail_person' => 0,
    'detail_lng' => 0,
    'detail_lat' => 0,
    'detail_address' => 0,
    'detail_tel' => 0,
    'detail_ordernumstore' => 0,
    'detail_pubdate' => 0,
    'detail_state' => 0,
    'detail_confirmdate' => 0,
    'detail_peidate' => 0,
    'detail_songdate' => 0,
    'detail_okdate' => 0,
    'detail_failed' => 0,
    'detail_id' => 0,
    'site_map_key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_595388c0d0b472_96478010',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_595388c0d0b472_96478010')) {function content_595388c0d0b472_96478010($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\include\\tpl\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>订单详情</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/touchBase.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=33"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="/templates/courier/css/dingdanDetail.css">
</head>

<body>
<!-- 头部 外卖订单详细头部 -->
<div class="tongJi jk22">
	<a href="javascript:;" onclick="history.go(-1);"><i></i></a>
	<p><span>订单详情</span></p>
</div>
<div class="shangPin">
<!-- 商品信息 -->
	<div class="shangPinCao">
		<div class="shangPin01 shangPin02">
			<div class="shangpInfo fn-clear">
				<i></i>
				<span>商品信息</span>
			</div>
		</div>
		<div class="shangPin01">
			<?php  $_smarty_tpl->tpl_vars['food'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['food']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_food']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['food']->key => $_smarty_tpl->tpl_vars['food']->value) {
$_smarty_tpl->tpl_vars['food']->_loop = true;
?>
			<div class="shangpInfo shangPin02 fn-clear">
				<span class="niuRoubao"><?php echo $_smarty_tpl->tpl_vars['food']->value['title'];?>
</span>
				<s class="juLi">&yen; <?php echo $_smarty_tpl->tpl_vars['food']->value['price']*$_smarty_tpl->tpl_vars['food']->value['count'];?>
</s>
				<s>x<?php echo $_smarty_tpl->tpl_vars['food']->value['count'];?>
</s>
			</div>
			<?php } ?>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo shangPin02 fn-clear">
				<?php  $_smarty_tpl->tpl_vars['price'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['price']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_priceinfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['price']->key => $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->_loop = true;
?>
				<s class="amount"><?php echo $_smarty_tpl->tpl_vars['price']->value['body'];?>
：<em style="margin-right: 20px;">&yen;<?php echo $_smarty_tpl->tpl_vars['price']->value['amount'];?>
</em></s>
				<?php } ?>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo shangPin02 fn-clear">
			<?php if ($_smarty_tpl->tpl_vars['detail_paytype']->value=='货到付款') {?>
				<s class="amount danger">待付金额：<span>&yen;<?php echo $_smarty_tpl->tpl_vars['detail_amount']->value;?>
</span></s>
			<?php } else { ?>
				<s class="amount">付款金额：<span>&yen;<?php echo $_smarty_tpl->tpl_vars['detail_amount']->value;?>
</span></s>
			<?php }?>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo fn-clear weiLa">
				<span>订单备注：<?php echo $_smarty_tpl->tpl_vars['detail_note']->value;?>
</span>
			</div>
		</div>
	</div>
<!-- 商家信息 -->
	<div class="shangPinCao">
		<div class="shangPin01 shangPin02">
			<div class="shangpInfo fn-clear">
				<i class="yangZhe"></i>
				<span>商家信息</span>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo shangPin02 fn-clear">
				<span class="niuRoubao">店铺名称：<?php echo $_smarty_tpl->tpl_vars['detail_shopname']->value;?>
</span>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo shangPin02 fn-clear">
				<a href="javascript:;" data-lng="<?php echo $_smarty_tpl->tpl_vars['detail_coordY']->value;?>
" data-lat="<?php echo $_smarty_tpl->tpl_vars['detail_coordX']->value;?>
" data-title="<?php echo $_smarty_tpl->tpl_vars['detail_shopname']->value;?>
" data-address="<?php echo $_smarty_tpl->tpl_vars['detail_shopaddr']->value;?>
" class="showmap"><i class="juLi02"></i></a>
				<s class="juLi juLi01">店铺地址：<?php echo $_smarty_tpl->tpl_vars['detail_shopaddr']->value;?>
</s>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo fn-clear">
				<a href="tel:<?php echo $_smarty_tpl->tpl_vars['detail_shoptel']->value;?>
"><i class="juLi05"></i></a>
				<s class="juLi juLi01">店铺电话：<?php echo $_smarty_tpl->tpl_vars['detail_shoptel']->value;?>
</s>
			</div>
		</div>
	</div>
<!-- 买家信息 -->
	<div class="shangPinCao">
		<div class="shangPin01 shangPin02">
			<div class="shangpInfo fn-clear">
				<i class="yanjie"></i>
				<span>买家信息</span>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo shangPin02 fn-clear">
				<span class="niuRoubao">姓名：<?php echo $_smarty_tpl->tpl_vars['detail_person']->value;?>
</span>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo shangPin02 fn-clear">
				<a href="javascript:;" data-lng="<?php echo $_smarty_tpl->tpl_vars['detail_lng']->value;?>
" data-lat="<?php echo $_smarty_tpl->tpl_vars['detail_lat']->value;?>
" data-title="<?php echo $_smarty_tpl->tpl_vars['detail_person']->value;?>
" data-address="<?php echo $_smarty_tpl->tpl_vars['detail_address']->value;?>
" class="showmap"><i class="juLi02"></i></a>
				<s class="juLi juLi01">地址：<?php echo $_smarty_tpl->tpl_vars['detail_address']->value;?>
</s>
			</div>
		</div>
		<div class="shangPin01">
			<div class="shangpInfo fn-clear">
				<a href="tel:<?php echo $_smarty_tpl->tpl_vars['detail_tel']->value;?>
"><i class="juLi05"></i></a>
				<s class="juLi juLi01">电话：<?php echo $_smarty_tpl->tpl_vars['detail_tel']->value;?>
</s>
			</div>
		</div>
	</div>
<!-- 订单信息 -->
	<div class="shangPinCao">
		<div class="shangPin01 shangPin02">
			<div class="shangpInfo fn-clear">
				<i class="yanjie01"></i>
				<span>订单信息</span>
			</div>
		</div>
		<div class="bianHao">
			<p class="num01">订单编号：<?php echo $_smarty_tpl->tpl_vars['detail_ordernumstore']->value;?>
</p>
			<p>下单时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_pubdate']->value,"%Y-%m-%d %H:%M:%S");?>
</p>
			<p>订单状态：
				<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==0) {?>
				未付款
				<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
				完成
				<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==2) {?>
				待确认
				<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==3) {?>
				待配送
				<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==4) {?>
				已接单
				<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==5) {?>
				配送中
				<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==6) {?>
				取消支付
				<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==7) {?>
				交易失败
				<?php }?>
			</p>
			<p>付款方式：<span><?php echo $_smarty_tpl->tpl_vars['detail_paytype']->value;?>
</span></p>
			<?php if ($_smarty_tpl->tpl_vars['detail_confirmdate']->value) {?><p>确认时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_confirmdate']->value,"%Y-%m-%d %H:%M:%S");?>
</p><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_peidate']->value) {?><p>接单时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_peidate']->value,"%Y-%m-%d %H:%M:%S");?>
</p><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_songdate']->value) {?><p>配送时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_songdate']->value,"%Y-%m-%d %H:%M:%S");?>
</p><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_okdate']->value) {?><p>完成时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_okdate']->value,"%Y-%m-%d %H:%M:%S");?>
</p><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==6||$_smarty_tpl->tpl_vars['detail_state']->value==7) {?><p>失败原因：<?php echo $_smarty_tpl->tpl_vars['detail_failed']->value;?>
</p><?php }?>
		</div>
	</div>
<!-- 设为失败、确认取货、设为成功 -->
	<div class="lingDian">
		<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==4) {?><a href="javascript:;" data-state="5" class="lingDian01 lingDian03">已取货</a><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==5) {?><a href="javascript:;" data-state="1" class="lingDian01 lingDian03">确认成功</a><?php }?>
	</div>
</div>

<div class="mapPath">
	<div id="mapPath"></div>
	<div class="mapBtn">
		<button id="closeMap"></button>
	</div>
</div>

<!-- 友情提醒 -->
<div class="youqingTixing"></div>

<?php echo '<script'; ?>
 type="text/javascript">
	var id = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){

	//小地图
	// $(".showmap").bind("click", function(){
	// 	var t = $(this), lng = t.data("lng"), lat = t.data("lat");
	// 	if(lng && lat){
	// 		$(".mapPath").show();
	// 		var map = new BMap.Map("mapPath");
	// 		var mPoint = new BMap.Point(lng, lat);
	// 		var marker = new BMap.Marker(mPoint);
	// 		map.centerAndZoom(mPoint, 16);
	// 		map.addOverlay(marker);
	// 	}
	// });
	//
	// //关闭大地图
	// $("#closeMap").bind("click", function(){
	// 	$(".mapPath").hide();
	// });

	//注册客户端webview
    function setupWebViewJavascriptBridge(callback){
      if(window.WebViewJavascriptBridge){
        return callback(WebViewJavascriptBridge);
      }else{
        document.addEventListener("WebViewJavascriptBridgeReady", function() {
          return callback(WebViewJavascriptBridge);
        }, false);
      }

      if(window.WVJBCallbacks){return window.WVJBCallbacks.push(callback);}
      window.WVJBCallbacks = [callback];
      var WVJBIframe = document.createElement("iframe");
      WVJBIframe.style.display = "none";
      WVJBIframe.src = "wvjbscheme://__BRIDGE_LOADED__";
      document.documentElement.appendChild(WVJBIframe);
      setTimeout(function(){document.documentElement.removeChild(WVJBIframe) }, 0);
    }

	setupWebViewJavascriptBridge(function(bridge) {
    	$(".showmap").bind("click", function(){
			var t = $(this), lng = t.attr("data-lng"), lat = t.attr("data-lat"), title = t.attr("data-title"), address = t.attr("data-address");
    		if (lat != "" && lng != "") {
		        bridge.callHandler("skipAppMap", {
		            "lat": lat,
		            "lng": lng,
		            "addrTitle": title,
		            "addrDetail": address
		        }, function(responseData) {});
	        }
    	})
    });


	//更新状态
	$(".lingDian03").bind("click", function(){
		var t = $(this), state = t.attr("data-state");
		if(t.hasClass("disabled") || !id) return false;

		t.addClass("disabled");
		$('.youqingTixing').html('<i>操作中...</i>').show();

		$.ajax({
            url: '/include/ajax.php?service=waimai&action=peisong',
            data: {
                id: id,
				state: state
            },
            type: 'get',
            dataType: 'json',
            success: function(data){
				if(data && data.state == 100){
					$('.youqingTixing').html('<i>操作成功！</i>').show();
					setTimeout(function(){
						location.reload();
					}, 1000);
				}else{
					t.removeClass("disabled");
					$('.youqingTixing').html('<i>'+data.info+'</i>').show();
					setTimeout(function(){
						$(".youqingTixing").hide();
					}, 2000);
				}
			},
			error: function(){
				t.removeClass("disabled");
				$('.youqingTixing').html('<i>网络错误，操作失败！</i>').show();
				setTimeout(function(){
					$(".youqingTixing").hide();
				}, 2000);
			}
		});
	});
});
<?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
