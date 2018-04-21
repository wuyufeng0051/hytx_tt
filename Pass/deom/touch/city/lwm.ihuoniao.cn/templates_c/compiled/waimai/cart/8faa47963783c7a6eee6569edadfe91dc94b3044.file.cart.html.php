<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-14 11:16:05
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\cart.html" */ ?>
<?php /*%%SmartyHeaderCode:9999591d41ae2016c6-82254376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8faa47963783c7a6eee6569edadfe91dc94b3044' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\cart.html',
      1 => 1497410148,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9999591d41ae2016c6-82254376',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591d41ae218dc2_07398648',
  'variables' => 
  array (
    'detail_shopname' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'detail_id' => 0,
    'detail_is_first_discount' => 0,
    'detail_first_discount' => 0,
    'detail_is_discount' => 0,
    'detail_discount_value' => 0,
    'detail_basicprice' => 0,
    'detail_delivery_fee' => 0,
    'detail_delivery_fee_type' => 0,
    'detail_delivery_fee_value' => 0,
    'detail_open_range_delivery_fee' => 0,
    'detail_range_delivery_fee_value_json' => 0,
    'juli' => 0,
    'detail_delivery_radius' => 0,
    'detail_delivery_fee_mode' => 0,
    'detail_open_promotion' => 0,
    'detail_promotions_json' => 0,
    'detail_open_addservice' => 0,
    'detail_addservice_json' => 0,
    'firstOrder' => 0,
    'detail_offline_limit' => 0,
    'detail_pay_offline_limit' => 0,
    'userinfo' => 0,
    'cart_address_id' => 0,
    'wxjssdk_appId' => 0,
    'wxjssdk_timestamp' => 0,
    'wxjssdk_nonceStr' => 0,
    'wxjssdk_signature' => 0,
    'detail_description' => 0,
    'detail_share_title' => 0,
    'detail_share_pic' => 0,
    'detail_url' => 0,
    'detail_status' => 0,
    'detail_closeinfo' => 0,
    'deatil_status' => 0,
    'detail_ordervalid' => 0,
    'detail_closeorder' => 0,
    'detail_yingye' => 0,
    'detail_yingyeWeek' => 0,
    'detail_weeks' => 0,
    'detail_start_time1' => 0,
    'detail_end_time1' => 0,
    'detail_start_time2' => 0,
    'detail_end_time2' => 0,
    'detail_start_time3' => 0,
    'detail_end_time3' => 0,
    'cart_address_person' => 0,
    'cart_address_tel' => 0,
    'cart_address_street' => 0,
    'cart_address_address' => 0,
    'detail_paytype' => 0,
    'detail_preset' => 0,
    'preset' => 0,
    'pre' => 0,
    'detail_memo_hint' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591d41ae218dc2_07398648')) {function content_591d41ae218dc2_07398648($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title><?php echo $_smarty_tpl->tpl_vars['detail_shopname']->value;?>
</title>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/zepto.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/car.css">
<?php echo '<script'; ?>
 type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	var shopid = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
;  //店铺ID
	var first_discount = <?php if ($_smarty_tpl->tpl_vars['detail_is_first_discount']->value) {
echo $_smarty_tpl->tpl_vars['detail_first_discount']->value;
} else { ?>0<?php }?>;  //首单减免
	var discount_value = <?php if ($_smarty_tpl->tpl_vars['detail_is_discount']->value) {
echo $_smarty_tpl->tpl_vars['detail_discount_value']->value;
} else { ?>10<?php }?>;  //打折优惠
	var basicprice = <?php echo $_smarty_tpl->tpl_vars['detail_basicprice']->value;?>
;  //起送价
	var delivery_fee = <?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee']->value;?>
;  //配送费
	var delivery_fee_type = <?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee_type']->value;?>
;  //配送费类型  0：达到起送价免配送费  1：始终收取外送费  2：满额免
	var delivery_fee_value = <?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee_value']->value;?>
;  //满多少免配送费
	var open_range_delivery_fee = <?php echo $_smarty_tpl->tpl_vars['detail_open_range_delivery_fee']->value;?>
;  //开启不同距离收取不同的配送费
	var range_delivery_fee_value = <?php echo $_smarty_tpl->tpl_vars['detail_range_delivery_fee_value_json']->value;?>
;  //不同距离本着费规则
	var juli = <?php echo $_smarty_tpl->tpl_vars['juli']->value;?>
;  //用户距商家距离，单位：千米
	var shop_delivery_radius = <?php echo $_smarty_tpl->tpl_vars['detail_delivery_radius']->value;?>
; //商家最大配送距离
	var delivery_fee_mode = <?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee_mode']->value;?>
; //起送价、配送费模式 1固定 2区域 3距离
	var promotions = <?php if ($_smarty_tpl->tpl_vars['detail_open_promotion']->value) {
echo $_smarty_tpl->tpl_vars['detail_promotions_json']->value;
} else { ?>[]<?php }?>;  //满减规则
	var addservice = <?php if ($_smarty_tpl->tpl_vars['detail_open_addservice']->value) {
echo $_smarty_tpl->tpl_vars['detail_addservice_json']->value;
} else { ?>[]<?php }?>;  //增值服务
	var foodTotalPrice = 0, dabaoTotalPrice = 0 , manjianPrice = 0, addservicePrice = 0, first_discount = <?php if ($_smarty_tpl->tpl_vars['firstOrder']->value&&$_smarty_tpl->tpl_vars['detail_is_first_discount']->value) {
echo $_smarty_tpl->tpl_vars['detail_first_discount']->value;
} else { ?>0<?php }?>;   //商品总价，打包总价，满减金额，增值服务，首单减免
	var offline_limit = <?php echo $_smarty_tpl->tpl_vars['detail_offline_limit']->value;?>
;	//是否开启货到付款金额限制
	var pay_offline_limit = <?php echo $_smarty_tpl->tpl_vars['detail_pay_offline_limit']->value;?>
;	//货到付款金额限制
	var myMoney = <?php echo $_smarty_tpl->tpl_vars['userinfo']->value['money'];?>
;			//用户余额
	var depositUrl = '<?php echo getUrlPath(array('service'=>'member','template'=>'deposit'),$_smarty_tpl);?>
';	//充值页面
	var buyUrl = '<?php echo getUrlPath(array('service'=>'waimai','template'=>'buy','id'=>$_smarty_tpl->tpl_vars['detail_id']->value),$_smarty_tpl);?>
';	// 商品页面

	var cart_address_id = <?php echo $_smarty_tpl->tpl_vars['cart_address_id']->value;?>
;
	var order_content;

	var nowDate = <?php echo time();?>
, nowTime = "<?php echo smarty_modifier_date_format(time(),'%H:%M');?>
";
    var wxconfig = {
        "appId": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_appId']->value;?>
',
        "timestamp": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_timestamp']->value;?>
',
        "nonceStr": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_nonceStr']->value;?>
',
        "signature": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_signature']->value;?>
',
        "description": '<?php echo $_smarty_tpl->tpl_vars['detail_description']->value;?>
',
        "title": '<?php if ($_smarty_tpl->tpl_vars['detail_share_title']->value) {
echo $_smarty_tpl->tpl_vars['detail_share_title']->value;
} else {
echo $_smarty_tpl->tpl_vars['detail_shopname']->value;
}?>',
        "imgUrl": '<?php echo $_smarty_tpl->tpl_vars['detail_share_pic']->value;?>
',
        "link": '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
',
    };

	<?php if (!$_smarty_tpl->tpl_vars['detail_status']->value) {?>alert('<?php if ($_smarty_tpl->tpl_vars['detail_closeinfo']->value) {
echo $_smarty_tpl->tpl_vars['detail_closeinfo']->value;
} else {
echo $_smarty_tpl->tpl_vars['deatil_status']->value;?>
该店铺关闭了，您暂时无法在该店铺下单。<?php }?>');location.history.go(-1);<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['detail_status']->value&&!$_smarty_tpl->tpl_vars['detail_ordervalid']->value) {?>alert('<?php if ($_smarty_tpl->tpl_vars['detail_closeorder']->value) {
echo $_smarty_tpl->tpl_vars['detail_closeorder']->value;
} else { ?>该店铺关闭了微信下单，您暂时无法在该店铺下单。<?php }?>');location.history.go(-1);<?php }?>
	<?php if (!$_smarty_tpl->tpl_vars['detail_yingye']->value) {?>
		<?php if (!$_smarty_tpl->tpl_vars['detail_yingyeWeek']->value) {?>
		alert('该店铺今天暂停营业！营业时间：星期<?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['detail_weeks']->value,"1","一"),"2","二"),"3","三"),"4","四"),"5","五"),"6","六"),"7","七"),",","，星期");?>
');
		location.history.go(-1);
		<?php } else { ?>
		alert('该店铺不在营业时间，您暂时无法在该店铺下单！营业时间：<?php if ($_smarty_tpl->tpl_vars['detail_start_time1']->value&&$_smarty_tpl->tpl_vars['detail_start_time1']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time1']->value&&$_smarty_tpl->tpl_vars['detail_end_time1']->value!="00:00") {
echo $_smarty_tpl->tpl_vars['detail_start_time1']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time1']->value;
}
if ($_smarty_tpl->tpl_vars['detail_start_time2']->value&&$_smarty_tpl->tpl_vars['detail_start_time2']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time2']->value&&$_smarty_tpl->tpl_vars['detail_end_time2']->value!="00:00") {?>; <?php echo $_smarty_tpl->tpl_vars['detail_start_time2']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time2']->value;
}
if ($_smarty_tpl->tpl_vars['detail_start_time3']->value&&$_smarty_tpl->tpl_vars['detail_start_time3']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time3']->value&&$_smarty_tpl->tpl_vars['detail_end_time3']->value!="00:00") {?>; <?php echo $_smarty_tpl->tpl_vars['detail_start_time3']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time3']->value;
}?>');
		location.history.go(-1);
		<?php }?>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['detail_delivery_radius']->value!=0&&$_smarty_tpl->tpl_vars['detail_delivery_radius']->value<$_smarty_tpl->tpl_vars['juli']->value) {?>
		alert("您离店铺太远，超出了商家的最大服务范围！");
	<?php }?>

	var payUrl = '/include/ajax.php?service=waimai&action=pay&ordernum=#ordernum';

<?php echo '</script'; ?>
>
</head>

<body>
<!-- 无内容 -->
<div class="empty fn-hide">
	<i></i>
	<p>购物车为空哦，快去选购吧</p>
</div>

<!-- 有内容 -->
<div class="cart fn-hide">
	<div class="line"></div>
	<div class="place">
		<a href="<?php echo getUrlPath(array('service'=>'waimai','template'=>'address','id'=>$_smarty_tpl->tpl_vars['detail_id']->value,'param'=>"address=".((string)$_smarty_tpl->tpl_vars['cart_address_id']->value)),$_smarty_tpl);?>
">
			<ul>
				<li><em>联系人</em><span><?php echo $_smarty_tpl->tpl_vars['cart_address_person']->value;?>
</span></li>
				<li><em>联系电话</em><span><?php echo $_smarty_tpl->tpl_vars['cart_address_tel']->value;?>
</span></li>
				<li><em>联系地址</em><span><?php echo $_smarty_tpl->tpl_vars['cart_address_street']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['cart_address_address']->value;?>
</span></li>
			</ul>
			<p><i></i></p>
		</a>
	</div>
	<div class="pay_style fn-clear">
		<span>支付方式</span>
		<ul class="fn-clear">
			<?php if (strstr($_smarty_tpl->tpl_vars['detail_paytype']->value,"3")) {?>
			<li id="wxpay">微信</li>
			<li id="alipay">支付宝</li>
			<?php }?>
			<?php if (strstr($_smarty_tpl->tpl_vars['detail_paytype']->value,"1")) {?><li id="delivery">货到付款</li><?php }?>
			<?php if (strstr($_smarty_tpl->tpl_vars['detail_paytype']->value,"2")) {?><li id="money">余额付款</li><?php }?>
		</ul>
		<div class="fn-clear"></div>
		<p class="info"></p>
	</div>
	<div class="car_list">
		<div id="cartList"></div>
		<div class="car_t2">
			<ul>
				<li>商品总价：&yen;<span id="totalFoodPrice">0.00</span></li>
				<?php if ($_smarty_tpl->tpl_vars['detail_is_discount']->value&&$_smarty_tpl->tpl_vars['detail_discount_value']->value<10) {?><li>本店开启了 <?php echo sprintf("%.1f",$_smarty_tpl->tpl_vars['detail_discount_value']->value);?>
 折优惠活动</li><?php }?>
				<li id="manjian" class="fn-hide"></li>
				<li id="dabao" class="fn-hide">打包费：<span id="dabaoPrice">0.00</span>元</li>
				<li id="peisong" class="fn-hide">配送费：<span id="peisongPrice">0.00</span>元</li>
				<li id="addservice" class="fn-hide"></li>
				<?php if ($_smarty_tpl->tpl_vars['firstOrder']->value&&$_smarty_tpl->tpl_vars['detail_is_first_discount']->value&&$_smarty_tpl->tpl_vars['detail_first_discount']->value>0) {?><li>首单减免：<?php echo $_smarty_tpl->tpl_vars['detail_first_discount']->value;?>
元</li><?php }?>
			</ul>
		</div>
	</div>

	<div>
		<?php if ($_smarty_tpl->tpl_vars['detail_preset']->value) {?>
		<?php  $_smarty_tpl->tpl_vars['preset'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['preset']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_preset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['preset']->key => $_smarty_tpl->tpl_vars['preset']->value) {
$_smarty_tpl->tpl_vars['preset']->_loop = true;
?>
		<div class="preset_item beizhu fn-clear">
			<em><?php echo $_smarty_tpl->tpl_vars['preset']->value[2];?>
</em>
			<?php if ($_smarty_tpl->tpl_vars['preset']->value[0]==1) {?>
			<select class="preset">
				<?php  $_smarty_tpl->tpl_vars['pre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['preset']->value[3]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pre']->key => $_smarty_tpl->tpl_vars['pre']->value) {
$_smarty_tpl->tpl_vars['pre']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['pre']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pre']->value;?>
</option>
				<?php } ?>
			</select>
			<?php } else { ?>
			<input type="text" class="preset" placeholder="<?php echo $_smarty_tpl->tpl_vars['preset']->value[3];?>
">
			<?php }?>
		</div>
		<?php } ?>
		<?php }?>
		<div class="beizhu fn-clear">
			<em>订单备注</em><input id="note" type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['detail_memo_hint']->value;?>
">
		</div>
	</div>

	<div class="price"><em>应付金额：</em><b>&yen;0.00</b></div>
	<div class="car_button"><button id="tj">提交订单</button></div>

</div>

<div class="navtion fn-clear">
	<ul>
		<li class="shop"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'shop','id'=>$_tmp1),$_smarty_tpl);?>
"><i></i><span>首页</span></a></li>
		<li class="xuangou"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'buy','id'=>$_tmp2),$_smarty_tpl);?>
"><i></i><span>选购</span></a></li>
		<li class="car nav_bc"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'cart','id'=>$_tmp3),$_smarty_tpl);?>
"><i></i><span>购物车</span></a></li>
		<li class="center"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user'),$_smarty_tpl);?>
"><i></i><span>个人中心</span></a></li>
	</ul>
</div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/car.js?v=2"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
