<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-21 17:59:42
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\orderdetail-waimai.html" */ ?>
<?php /*%%SmartyHeaderCode:122405924fca17442b1-53521816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e96208be18013654d8d416acb2ad77d12b75d51c' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\orderdetail-waimai.html',
      1 => 1497952726,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122405924fca17442b1-53521816',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924fca174bfb8_63205191',
  'variables' => 
  array (
    'detail_id' => 0,
    'detail_paytype' => 0,
    'detail_state' => 0,
    'detail_peisongid' => 0,
    'detail_peisongpath' => 0,
    'detail_peisongpath_lng' => 0,
    'detail_peisongpath_lat' => 0,
    'detail_pubdate' => 0,
    'detail_paydate' => 0,
    'detail_confirmdate' => 0,
    'detail_peisongphone' => 0,
    'detail_peidate' => 0,
    'detail_peisongname' => 0,
    'detail_songdate' => 0,
    'detail_okdate' => 0,
    'detail_shopname' => 0,
    'detail_food' => 0,
    'food' => 0,
    'detail_priceinfo' => 0,
    'price' => 0,
    'detail_amount' => 0,
    'detail_person' => 0,
    'detail_tel' => 0,
    'detail_address' => 0,
    'detail_ordernumstore' => 0,
    'detail_ordernum' => 0,
    'detail_preset' => 0,
    'preset' => 0,
    'detail_note' => 0,
    'detail_failed' => 0,
    'detail_iscomment' => 0,
    'detail_comment' => 0,
    'detail_sid' => 0,
    'site_map_key' => 0,
    'detail_paylimittime' => 0,
    'detail_coordY' => 0,
    'detail_coordX' => 0,
    'detail_lng' => 0,
    'detail_lat' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924fca174bfb8_63205191')) {function content_5924fca174bfb8_63205191($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
?><?php echo '<script'; ?>
 type="text/javascript">
	var id = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
;
<?php echo '</script'; ?>
>

<meta name="format-detection" content="telephone=no" />

<style media="screen">
body {padding-bottom: 1.3rem;}
.ci_lead {height:1rem;line-height:1rem;text-align:center;background:#fff;}
.ci_lead ul li {float:left;width:50%;box-sizing:border-box;font-size:0.3rem;border-right:1px solid #f1f1f1;border-bottom:1px solid #f8f8f8;}
.ci_lead ul li:last-child {border-right:none;}
.ci_lead ul li a {display:block;}
.cil_bc {border-bottom:1px solid #e95249!important;}
.cil_bc a {color:#e95249!important;}
.ci_list .ci_left {float:left;width:25%;box-sizing:border-box;margin-top:.5rem; padding-bottom: .5rem;}
.ci_list .ci_left .point {width:1rem;margin:0 auto;}
.ci_list .ci_left .line {width:0.05rem;height:.9rem;display:block;margin:0 auto;background:#dadada;}
.ci_list .ci_left .line.on_1 {background:#f90101!important;}
.ci_list .ci_left  .qishou {width:1.1rem;margin:0 auto;}
.ci_list .ci_left  .qishou em {width:1.1rem;height:1.1rem; background: #e95249; border-radius: 50%; background-image: url(/static/images/peisong.png); background-position: center;background-repeat: no-repeat; background-size:70%;display:inline-block;}
.ci_list .ci_left .point em {position:relative;width:.25rem;height:.25rem;border-radius:100%;display:block;margin:0 auto;border:1px solid #d4d4d4;}
.ci_list .ci_left .point.on em {border:1px solid #f90101}
.ci_list .ci_left .point em i {width:.15rem;height:.15rem;background:#d4d4d4;position:absolute;top:0.05rem;left:0.05rem;border-radius:100%;}
.ci_list .ci_left .point.on em i {background: #f90101;}
.ci_list .ci_right {float:right;font-size:.24rem;width:75%;box-sizing:border-box;padding-right:.5rem; padding-bottom: .5rem;}
.ci_list .ci_right .ci_txt {margin-top:.4rem;}
.ci_list .ci_right .ci_txt span {float:left;position:relative;}
.ci_list .ci_right .ci_txt span  a {position:absolute;top:-.2rem;right:-.6rem;width:.5rem;height:.5rem;display:inline-block;background:url(/static/images/phone.png) no-repeat center;background-size:.5rem;vertical-align:text-bottom;}
.ci_list .ci_right .ci_txt em {float:right;color:#b7b7b7;}
.ci_list .ci_right p {color:#b7b7b7;margin-top:.1rem;}
.map {position: relative; display:block;margin-top:.5rem;height:2rem;}
#map {position: relative; z-index: 1; width: 100%; height: 2rem;}
.map .market {position: absolute; z-index: 2; left: 50%; top: 50%; width: .6rem; height: .6rem; margin: -.4rem 0 0 -.3rem; background: url('/static/images/local.png'); background-size: cover;}
.refresh {width:100%;height:1rem;line-height:1rem;font-size:0.3rem;background:#e95249;text-align:center;color:#fff;position:fixed;bottom:0;left:0;right:0;}
.refresh:hover {color: #fff;}

.cid_main1 {background:#fff;padding:0.1rem 0.3rem; margin-top: .2rem;}
.cid_main1 h1 {height:.7rem;line-height:.7rem;font-size:.28rem;border-bottom:1px solid #e6e6e6;}
.cid_main1 h1 i {width:.6rem;height:.5rem;background:url(/static/images/dianpu.png) no-repeat center;background-size:.5rem;vertical-align:text-bottom;display:inline-block;}
.cid_main1 .content {padding: .1rem 0; line-height:.7rem;font-size:.28rem;border-bottom:1px solid #e6e6e6;}
.cid_main1 .content p {float: left; width: 70%;}
.cid_main1 .content p em {line-height: .3rem; color: #999; margin-top: -.1rem; font-size: .24rem; display: block; padding-bottom: .2rem;}
.cid_main1 .content b {float:right; width: 15%; font-weight:normal; text-align: right;}
.cid_main1 .content i {float:right; width: 15%; font-style:normal;color:#a0a0a0; text-align: right;}
.cid_main1 .prices {text-align: right; line-height: .5rem; padding: .2rem 0; border-bottom: 1px solid #e6e6e6;}
.cid_main1 .total {height:.7rem;line-height:.7rem;font-size:.28rem;}
.cid_main1 .total span {float:right;}
.cid_main1 .total em {float:right;color:#e95249;}
.ci_main2 {margin-top:.4rem;background:#fff;padding:.1rem .3rem;}
.ci_main2 h1 {height:.7rem;line-height:.7rem;font-size:.28rem;border-bottom:1px solid #e6e6e6;}
.ci_main2 h1 i {width:.6rem;height:.5rem;background:url(/static/images/ren_1.png) no-repeat center;background-size:.45rem;vertical-align:text-bottom;display:inline-block;}
.ci_main2 ul li {height:.6rem;line-height:.6rem;color:#8c8c8c;font-size:.28rem;}
.ci_main3 {margin-top:.4rem;background:#fff;padding:.1rem .3rem;}
.ci_main3 h1 {height:.7rem;line-height:.7rem;font-size:.28rem;border-bottom:1px solid #e6e6e6;margin-bottom:.1rem;}
.ci_main3 h1 i {width:.6rem;height:.5rem;background:url(/static/images/waimai.png) no-repeat center;background-size:.5rem;vertical-align:text-bottom;display:inline-block;}
.ci_main3 ul li {height:.5rem;line-height:.5rem;font-size:.28rem;}
.ci_main4 {margin-top:.4rem;background:#fff;padding:.1rem .3rem;margin-bottom:1.2rem;}
.ci_main4 .m4_lead {height:.7rem;line-height:.7rem;font-size:.28rem;border-bottom:1px solid #e6e6e6;margin-bottom:.1rem;}
.ci_main4 .m4_lead em {float:left;}
.ci_main4 .m4_lead .more {float:right;width:1.3rem;height:.5rem;line-height:.5rem;text-align:center;border:1px solid #e95249;color:#e95249;margin-top:.1rem;}
.new_com {background:#fff;}

.ci_main3 li {position: relative; padding-left: 30%;}
.ci_main3 li em {position: absolute; left: 0; width: 30%; text-align: right;}

.cuntdown {background: #fff9e9; padding: .2rem .3rem; font-size: .26rem;}
.cuntdown strong {color: #e95249; padding: 0 5px;}

.mapPath {position: fixed; left: 0; top: 0; right: 0; bottom: 0; background: #fff; z-index: 10; display: none;}
#mapPath {position: absolute; left: 0; top: 0; right: 0; bottom: 0; z-index: 1;}




.bubble {-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-transition: background-color .15s ease-in-out; -moz-transition: background-color .15s ease-in-out; -o-transition: background-color .15s ease-in-out; transition: background-color .15s ease-in-out; cursor: pointer; opacity: 0.9; width: 40px; height: 40px; background-size: cover;}
/*.bubble-3 {height: 28px; line-height: 28px; cursor: pointer; text-align: center; margin: 0;}*/
.bubble-3 .num {padding: 0 6px; display: inline-block; background-color: #de1e30; border-radius: 2px; border: 1px solid #de1e30; min-width: 40px; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition: all .15s ease-in-out; transition: all .15s ease-in-out; font-style: normal; color: #fff;}
.bubble-3 .name {height: 30px; color: #333; position: absolute; z-index: -1; line-height: 30px; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition:all .15s ease-in-out; transition: all .15s ease-in-out; opacity: 0; visibility: hidden;}
.bubble-3 .name-des {background-color: #fff; display: inline-block; padding: 0 6px; border-radius: 0 3px 3px 0; box-shadow: 0 2px 2px rgba(0,0,0,0.2); font-style: normal;}
.bubble-3 .name-des a {color: #333}
.bubble-3 .name-des a:hover {text-decoration: underline;}


.bubble-3.shop .num {background-color: #4285f4; border-color: #4285f4; color: #fff;}
.bubble-3.shop .name {visibility: visible; opacity: 1;}
.bubble-3.shop .arrow-up {border-top-color: #4285f4;}
.bubble-3.shop .arrow {border-top-color: #4285f4;}
.label-clicked {z-index:3!important;}
.arrow-up {opacity: .9999; zoom: 1;}


.bubble-3.person .num {background-color: green; border-color: green; color: #fff;}
.bubble-3.person .name {visibility: visible; opacity: 1;}
.bubble-3.person .arrow-up {border-top-color: green;}
.bubble-3.person .arrow {border-top-color: green;}


.arrow-up,.arrow {border: 6px solid transparent; border-top-color: #de1e30; border-top-width: 8px; display: block; width: 0; height: 0; margin: 0 auto; -webkit-transition: all .15s ease-in-out; -moz-transition: all .15s ease-in-out; -o-transition: all .15s ease-in-out; transition: all .15s ease-in-out;}
.arrow {border-top-color: #de1e30; margin-left: -6px; margin-top: -9px; position: relative;}
label.BMapLabel {max-width: inherit;}

.bubble.shop {background-image: url('/static/images/shop_local.png?v=1');}
.bubble.courier {background-image: url('/static/images/courier_local.png?v=1');}
.bubble.person {background-image: url('/static/images/person_local.png?v=1'); width: 30px; height: 30px;}

.mapBtn {position: absolute; z-index: 2; left: 0; top: 0; right: 0;}
.mapBtn button {position: absolute; top: .3rem; width: .8rem; height: .8rem; background-color: #fff; background-position: center; background-repeat: no-repeat; box-shadow: 0 0 5px rgba(0, 0, 0, .2); border: 0; border-radius: 3px; outline: 0;}
#closeMap {left: .3rem; background-image: url('/static/images/close.png'); background-size: .4rem;}
#refreshMap {right: .3rem; background-image: url('/static/images/refresh.png'); background-size: .4rem;}

.new_com {background:#fff;}
.new_com .com_lead {height:.7rem;line-height:.7rem;}
.new_com .com_lead em {float:left;font-size:0.3rem;color:#8c8c8c;}
.new_com .com_lead span {float:right;color:#999999;font-size:0.28rem;}
.new_com .com_lead span i {width:.35rem;height:.35rem;background:url(../images/arrow_right.png) no-repeat center;background-size:.35rem;display:inline-block;vertical-align:text-bottom;}
.new_com .com_list .com_txt {border-bottom:0.02rem solid #dddddd;padding:0.15rem 0;position:relative;}
.new_com .com_list .com_txt h1 {font-size:0.28rem;}
.new_com .com_list .com_txt p {color:#999999;font-size:0.24rem;height:.6rem;line-height:.6rem;}
.new_com .com_list .com_txt span em {float:right;color:#999999;font-size:0.24rem;}
.new_com .com_list .com_txt .pingjia {background:url(/static/images/star_2.png) no-repeat;background-size:1.5rem;width:1.5rem;height:0.4rem;display:inline-block;position:absolute;top:0.2rem;right:0.24rem;}
.new_com .com_list .com_txt .pingjia i{background: url(/static/images/star_1.png) no-repeat; background-size:1.5rem; height: 0.4rem; display: inline-block;}
.new_com .com_list .com_txt .pingjia.star1 i {width: .25rem;}
.new_com .com_list .com_txt .pingjia.star2 i {width: .55rem;}
.new_com .com_list .com_txt .pingjia.star3 i {width: .85rem;}
.new_com .com_list .com_txt .pingjia.star4 i {width: 1.15rem;}
.new_com .com_list .com_txt .pingjia.star5 i {width: 1.5rem;}

.reply p {line-height: .4rem;padding:.1rem 0;color: #f60;}
.reply p span {float: right;padding-left: .5rem;color: #999;}
</style>

<div class="ci_lead fn-clear">
	<ul>
		<li class="cil_bc">订单状态</li>
		<li>订单详情</li>
	</ul>
</div>

<?php if ($_smarty_tpl->tpl_vars['detail_paytype']->value!='货到付款'&&$_smarty_tpl->tpl_vars['detail_state']->value==0) {?>
<div class="cuntdown">您的订单已创建，请在<strong id="t_m">00</strong>分<strong id="t_s">00</strong>秒内完成支付，过期未支付该订单将自动取消。</div>
<?php }?>

<div class="item" id="tab0">
	<?php if ($_smarty_tpl->tpl_vars['detail_state']->value!=6&&$_smarty_tpl->tpl_vars['detail_state']->value!=7) {?>
	<div class="ci_list fn-clear">
		<div class="ci_left">
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=0) {?>
			<div class="point on"><em><i></i></em></div>
			<div class="line on_1"></div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_paytype']->value=='货到付款') {?>
			<div class="point on"><em><i></i></em></div>
			<div class="line on_1"></div>
			<?php } else { ?>
				<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=2||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="point on"><em><i></i></em></div>
			<div class="line on_1"></div>
				<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=3||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="point on"><em><i></i></em></div>
			<div class="line on_1"></div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_peisongid']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=4||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="point on"><em><i></i></em></div>
			<div class="line on_1" style="height: .75rem;"></div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=5||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="qishou on"><em><i></i></em></div>
			<div class="line on_1"></div>
			<?php if ($_smarty_tpl->tpl_vars['detail_peisongpath']->value&&$_smarty_tpl->tpl_vars['detail_peisongpath_lng']->value&&$_smarty_tpl->tpl_vars['detail_peisongpath_lat']->value) {?>
			<div class="line on_1" style="height: 1.75rem;"></div>
			<?php }?>
			<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="point on"><em><i></i></em></div>
			<?php } else { ?>
			<div class="point"><em><i></i></em></div>
			<?php }?>
		</div>
		<div class="ci_right">
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=0) {?>
			<div class="ci_txt">
				<div class="ci_txt fn-clear"><span>订单已提交</span><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_pubdate']->value,"%m-%d %H:%M");?>
</em></div>
				<p>等待支付。</p>
			</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_paytype']->value=='货到付款') {?>
			<div class="ci_txt">
				<div class="ci_txt fn-clear"><span>货到付款</span><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_paydate']->value,"%m-%d %H:%M");?>
</em></div>
				<p>请耐心等待商家确认</p>
			</div>
			<?php } else { ?>
				<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=2||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="ci_txt">
				<div class="ci_txt fn-clear"><span>支付成功</span><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_paydate']->value,"%m-%d %H:%M");?>
</em></div>
				<p>请耐心等待商家确认</p>
			</div>
				<?php }?>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=3||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="ci_txt">
				<div class="ci_txt fn-clear"><span>商家已确认</span><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_confirmdate']->value,"%m-%d %H:%M");?>
</em></div>
				<p>正在为您准备商品，如有疑问请电话联系商家</p>
			</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_peisongid']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=4||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="ci_txt ">
				<div class="ci_txt fn-clear"><span>配送员已接单<?php if ($_smarty_tpl->tpl_vars['detail_peisongphone']->value) {?><a href="tel:<?php echo $_smarty_tpl->tpl_vars['detail_peisongphone']->value;?>
"></a><?php }?></span><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_peidate']->value,"%m-%d %H:%M");?>
</em></div>
				<p>配送员【<?php echo $_smarty_tpl->tpl_vars['detail_peisongname']->value;?>
】正在赶往店铺为您取货</p>
			</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value>=5||$_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="ci_txt ci_1">
				<div class="ci_txt fn-clear"><span>配送员已取货</span><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_songdate']->value,"%m-%d %H:%M");?>
</em></div>
				<p>正在配送中，很快就能收到了哦</p>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['detail_peisongpath']->value&&$_smarty_tpl->tpl_vars['detail_peisongpath_lng']->value&&$_smarty_tpl->tpl_vars['detail_peisongpath_lat']->value) {?>
			<div class="map">
				<div id="map"></div>
				<!-- <div class="market"></div> -->
			</div>

			<div class="mapPath">
				<div id="mapPath"></div>
				<div class="mapBtn">
					<button id="closeMap"></button>
					<button id="refreshMap"></button>
				</div>
			</div>
			<?php }?>
			<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
			<div class="ci_txt ci_2">
				<div class="ci_txt fn-clear"><span>订单已完成</span><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_okdate']->value,"%m-%d %H:%M");?>
</em></div>
				<p>已送达，请给5分好评哦</p>
			</div>
			<?php }?>
		</div>
	</div>
	<?php }?>
</div>

<div class="item fn-hide" id="tab1">
	<div class="cid_main1">
		<h1><i></i><?php echo $_smarty_tpl->tpl_vars['detail_shopname']->value;?>
</h1>
		<div class="content">
			<?php  $_smarty_tpl->tpl_vars['food'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['food']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_food']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['food']->key => $_smarty_tpl->tpl_vars['food']->value) {
$_smarty_tpl->tpl_vars['food']->_loop = true;
?>
			<div class="fn-clear">
				<p><?php echo $_smarty_tpl->tpl_vars['food']->value['title'];
if ($_smarty_tpl->tpl_vars['food']->value['ntitle']) {?><em><?php echo $_smarty_tpl->tpl_vars['food']->value['ntitle'];?>
</em><?php }?></p>
				<b>&yen;<?php echo $_smarty_tpl->tpl_vars['food']->value['count']*$_smarty_tpl->tpl_vars['food']->value['price'];?>
</b>
				<i>×<?php echo $_smarty_tpl->tpl_vars['food']->value['count'];?>
</i>
			</div>
			<?php } ?>
		</div>
		<div class="prices">
			<?php  $_smarty_tpl->tpl_vars['price'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['price']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_priceinfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['price']->key => $_smarty_tpl->tpl_vars['price']->value) {
$_smarty_tpl->tpl_vars['price']->_loop = true;
?>
			<?php echo $_smarty_tpl->tpl_vars['price']->value['body'];?>
：<?php if ($_smarty_tpl->tpl_vars['price']->value['type']=="youhui"||$_smarty_tpl->tpl_vars['price']->value['type']=="manjian"||$_smarty_tpl->tpl_vars['price']->value['type']=="shoudan") {?>-<?php }
echo $_smarty_tpl->tpl_vars['price']->value['amount'];?>
<br />
			<?php } ?>
		</div>
		<div class="total fn-clear"><em>&yen;<?php echo $_smarty_tpl->tpl_vars['detail_amount']->value;?>
</em><span>下单合计：</span></div>
	</div>
	<div class="ci_main2">
		<h1><i></i>顾客信息</h1>
		<ul>
			<li>联系姓名：<?php echo $_smarty_tpl->tpl_vars['detail_person']->value;?>
</li>
			<li>联系电话：<?php echo $_smarty_tpl->tpl_vars['detail_tel']->value;?>
</li>
			<li>联系地址：<?php echo $_smarty_tpl->tpl_vars['detail_address']->value;?>
</li>
		</ul>
	</div>
	<div class="ci_main3">
		<h1><i></i>订单信息</h1>
		<ul>
			<li><em>订单编号：</em><?php if ($_smarty_tpl->tpl_vars['detail_ordernumstore']->value) {
echo $_smarty_tpl->tpl_vars['detail_ordernumstore']->value;
} else {
echo $_smarty_tpl->tpl_vars['detail_ordernum']->value;
}?></li>
			<li><em>下单时间：</em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_pubdate']->value,"%Y-%m-%d %H:%M:%S");?>
</li>

			<?php  $_smarty_tpl->tpl_vars['preset'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['preset']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_preset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['preset']->key => $_smarty_tpl->tpl_vars['preset']->value) {
$_smarty_tpl->tpl_vars['preset']->_loop = true;
?>
			<li><em><?php echo $_smarty_tpl->tpl_vars['preset']->value['title'];?>
：</em><?php echo $_smarty_tpl->tpl_vars['preset']->value['value'];?>
</li>
			<?php } ?>

			<li><em>订单备注：</em><?php echo $_smarty_tpl->tpl_vars['detail_note']->value;?>
</li>
			<li><em>付款方式：</em><?php echo $_smarty_tpl->tpl_vars['detail_paytype']->value;?>
</li>
			<li><em>订单状态：</em>
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
			</li>
			<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==7) {?>
			<li><em>失败原因：</em><?php echo $_smarty_tpl->tpl_vars['detail_failed']->value;?>
</li>
			<?php }?>
		</ul>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==1&&$_smarty_tpl->tpl_vars['detail_iscomment']->value==1) {?>
	<div class="ci_main4">
		<div class="m4_lead fn-clear"><em>评论</em><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'write-comment-waimai','id'=>$_smarty_tpl->tpl_vars['detail_id']->value),$_smarty_tpl);?>
" class="more">修改评论</a></div>
		<div class="new_com">
			<div class="com_list">
				<div class="com_txt">
					<p><?php echo $_smarty_tpl->tpl_vars['detail_comment']->value['content'];?>
</p>
					<span class="fn-clear"><em><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_comment']->value['pubdate'],"%Y-%m-%d %H:%M%S");?>
</em></span>
					<div class="pingjia star<?php echo $_smarty_tpl->tpl_vars['detail_comment']->value['star'];?>
"><i></i></div>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['detail_comment']->value['replydate']!=0) {?>
				<div class="reply">
					<p>【店家回复】<?php echo $_smarty_tpl->tpl_vars['detail_comment']->value['reply'];?>
<span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_comment']->value['replydate'],"%Y-%m-%d %H:%M%S");?>
</span></p>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
	<?php }?>

</div>


<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==0) {?>
<div class="refresh" onclick="location.href='<?php echo getUrlPath(array('service'=>'waimai','template'=>'pay','id'=>$_smarty_tpl->tpl_vars['detail_id']->value),$_smarty_tpl);?>
'">继续支付</div>
<?php } elseif ($_smarty_tpl->tpl_vars['detail_state']->value==1) {?>
<?php if ($_smarty_tpl->tpl_vars['detail_iscomment']->value==0) {?>
<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'write-comment-waimai','id'=>$_smarty_tpl->tpl_vars['detail_id']->value),$_smarty_tpl);?>
" class="refresh">去评价</a>
<?php } else { ?>
<a href="<?php echo getUrlPath(array('service'=>'waimai','template'=>'comment','id'=>$_smarty_tpl->tpl_vars['detail_sid']->value),$_smarty_tpl);?>
" class="refresh">查看评论</a>
<?php }?>
<?php } else { ?>
<a href="javascript:;" onclick="location.reload();" class="refresh">刷新</a>
<?php }?>

<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	$(".ci_lead li").bind("click", function(){
		var t = $(this), index = t.index();

		if(!t.hasClass("cil_bc")){
			t.addClass("cil_bc").siblings("li").removeClass("cil_bc");
			$(".item").hide();
			$("#tab"+index).show();
		}
	});

	<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==0) {?>
	var t = <?php echo $_smarty_tpl->tpl_vars['detail_paylimittime']->value;?>
;
	function GetRTime(){
	    var m = 0;
	    var s = 0;
	    if(t >= 0){
	      m = Math.floor(t/60%60);
	      s = Math.floor(t%60);
		  t--;
	    }

	    document.getElementById("t_m").innerHTML = m;
	    document.getElementById("t_s").innerHTML = s;
	  }
	  setInterval(GetRTime,1000);
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['detail_peisongid']->value) {?>
	<?php if ($_smarty_tpl->tpl_vars['detail_state']->value==1||$_smarty_tpl->tpl_vars['detail_state']->value==5) {?>
	<?php if ($_smarty_tpl->tpl_vars['detail_peisongpath']->value&&$_smarty_tpl->tpl_vars['detail_peisongpath_lng']->value&&$_smarty_tpl->tpl_vars['detail_peisongpath_lat']->value) {?>

	//小地图
	var map = new BMap.Map("map");
	var mPoint = new BMap.Point(<?php echo $_smarty_tpl->tpl_vars['detail_peisongpath_lng']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['detail_peisongpath_lat']->value;?>
);
	var marker = new BMap.Marker(mPoint);
	map.disableDragging();
	setTimeout(function(){
		map.centerAndZoom(mPoint, 16);
		map.addOverlay(marker);
	}, 500);

	//关闭大地图
	$("#closeMap").bind("click", function(){
		$(".mapPath").hide();
	});

	//气泡样式
	var labelStyle = {
		color: "#fff",
		borderWidth: "0",
		padding: "0",
		zIndex: "2",
		backgroundColor: "transparent",
		textAlign: "center",
		fontFamily: '"Hiragino Sans GB", "Microsoft Yahei UI", "Microsoft Yahei", "微软雅黑", "Segoe UI", Tahoma, "宋体b8bf53", SimSun, sans-serif'
	}

	//点击小地图查看大地图
	var mapPath, peisongpath = '<?php echo $_smarty_tpl->tpl_vars['detail_peisongpath']->value;?>
';
	$("#map").bind("click", function(){

		$(".mapPath").show();

		//派送员路径
		var pointArr = [];
		mapPath = new BMap.Map("mapPath");

		//店铺坐标
		var pointShop = new BMap.Point(<?php echo $_smarty_tpl->tpl_vars['detail_coordY']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['detail_coordX']->value;?>
);
		var bubbleLabelShop = new BMap.Label('<p class="bubble-3 bubble shop"></p>', {
			position: pointShop,
			offset: new BMap.Size(-20, -45)
		});
		bubbleLabelShop.setStyle(labelStyle);
		mapPath.addOverlay(bubbleLabelShop);
		pointArr.push(pointShop);

		//终点坐标
		var pointPerson = new BMap.Point(<?php echo $_smarty_tpl->tpl_vars['detail_lng']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['detail_lat']->value;?>
);
		var bubbleLabelPerson = new BMap.Label('<p class="bubble-3 bubble person"></p>', {
			position: pointPerson,
			offset: new BMap.Size(-15, -15)
		});
		bubbleLabelPerson.setStyle(labelStyle);
		mapPath.addOverlay(bubbleLabelPerson);
		pointArr.push(pointPerson);

		//更新骑手位置 & 画线
		updateCourierLocation(peisongpath);

		//设置中心点
		pointArr.push(new BMap.Point(<?php echo $_smarty_tpl->tpl_vars['detail_peisongpath_lng']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['detail_peisongpath_lat']->value;?>
));
		mapPath.setViewport(pointArr);
		mapPath.setZoom(mapPath.getZoom() - 1);

	});


	//刷新骑手位置
	$("#refreshMap").bind("click", function(){
		$.ajax({
			url: "/include/ajax.php",
			type: "post",
			data: {service: "waimai", action: "getCourierLocation", orderid: id},
			dataType: "json",
			success: function(res){
				if(res.state == 100){
					peisongpath = res.info;
					updateCourierLocation(peisongpath);
				}
			}
		})
	});


	//更新骑手位置 & 画线
	var bubbleLabelCourier, polylineCourier;
	function updateCourierLocation(pathData){

		if(!pathData || pathData == "") return false;

		if(bubbleLabelCourier){
            map.removeOverlay(bubbleLabelCourier);
        }

		//获取骑手最新位置
		var psData = pathData.split(";");
		psData = psData[psData.length-1].split(",");

		//骑手坐标
		var pointCourier = new BMap.Point(psData[0], psData[1]);
		bubbleLabelCourier = new BMap.Label('<p class="bubble-3 bubble courier"></p>', {
			position: pointCourier,
			offset: new BMap.Size(-20, -45)
		});
		bubbleLabelCourier.setStyle(labelStyle);
		mapPath.addOverlay(bubbleLabelCourier);

		//画折线
		if(pathData){

			if(polylineCourier){
	            map.removeOverlay(polylineCourier);
	        }

			var pathsArr = [];
			pathArr = pathData.split(";");
			for(var i = 0; i < pathArr.length; i++){
				var p = pathArr[i].split(",");
				pathsArr.push(new BMap.Point(p[0],p[1]));
			}
			polylineCourier = new BMap.Polyline(pathsArr, {strokeColor:"blue", strokeWeight:2, strokeOpacity:.9, strokeStyle:'dashed'});
			mapPath.addOverlay(polylineCourier);
		}
	}
	<?php }?>
	<?php }?>
	<?php }?>
});
<?php echo '</script'; ?>
>
<?php }} ?>