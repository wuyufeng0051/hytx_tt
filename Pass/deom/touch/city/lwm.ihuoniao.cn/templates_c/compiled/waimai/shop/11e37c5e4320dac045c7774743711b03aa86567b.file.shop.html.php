<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-14 09:12:37
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\shop.html" */ ?>
<?php /*%%SmartyHeaderCode:75759195b9956d936-70579018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11e37c5e4320dac045c7774743711b03aa86567b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\shop.html',
      1 => 1497344355,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75759195b9956d936-70579018',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59195b9959c735_62524439',
  'variables' => 
  array (
    'detail_shopname' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'detail_collect' => 0,
    'detail_shop_banner' => 0,
    'b' => 0,
    'detail_id' => 0,
    'detail_shop_notice' => 0,
    'detail_typeName' => 0,
    'detail_start_time1' => 0,
    'detail_end_time1' => 0,
    'detail_start_time2' => 0,
    'detail_end_time2' => 0,
    'detail_start_time3' => 0,
    'detail_end_time3' => 0,
    'detail_address' => 0,
    'detail_phone' => 0,
    'detail_callshow' => 0,
    'detail_delivery_fee_mode' => 0,
    'detail_basicprice' => 0,
    'detail_delivery_fee' => 0,
    'detail_delivery_fee_type' => 0,
    'detail_delivery_fee_value' => 0,
    'detail_range_delivery_fee_value' => 0,
    'range' => 0,
    'detail_show_range' => 0,
    'detail_delivery_radius' => 0,
    'detail_delivery_area' => 0,
    'detail_selfdefine' => 0,
    'self' => 0,
    'detail_open_addservice' => 0,
    'detail_addservice' => 0,
    'add' => 0,
    'cfg_basehost' => 0,
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
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59195b9959c735_62524439')) {function content_59195b9959c735_62524439($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
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
css/swiper.min.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/shop.css?v=3">
<?php echo '<script'; ?>
 type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
</head>

<body>
<div class="lead"><span><?php echo $_smarty_tpl->tpl_vars['detail_shopname']->value;?>
</span><b<?php if ($_smarty_tpl->tpl_vars['detail_collect']->value) {?> class="lead_bc"<?php }?>></b></div>
<?php if ($_smarty_tpl->tpl_vars['detail_shop_banner']->value) {?>
<div class="slideBox">
  <div class="swiper-wrapper">
    <?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['b']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_shop_banner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->_loop = true;
?>
    <div class="swiper-slide"><img src="<?php echo $_smarty_tpl->tpl_vars['b']->value;?>
"></div>
    <?php } ?>
  </div>
  <div class="swiper-pagination"></div>
</div>
<?php }?>
<div class="shop_list fn-clear">
	<ul>
		<!-- <li class="message"><a href="message.html"><i></i><span>留言</span></a></li> -->
		<li class="bill"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'buy','id'=>$_tmp1),$_smarty_tpl);?>
"><i></i><span>下单</span></a></li>
		<!-- <li class="comment"><a href="comment.html"><i></i><span>评论</span></a></li>
		<li class="dynamic"><a href="dynamic.html"><i></i><span>动态</span></a></li>
		<li class="rank"><a href="rank.html"><i></i><span>排行</span></a></li>
		<li class="email"><a href="email.html"><i></i><span>邮箱</span></a></li> -->
		<li class="dan"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'waimai'),$_smarty_tpl);?>
"><i></i><span>订单</span></a></li>
		<!-- <li class="sign"><a href="#"><i></i><span>签到</span></a></li>
		<li class="integral"><a href="integral.html"><i></i><span>积分</span></a></li>
		<li class="favorable"><a href="favorable.html"><i></i><span>优惠券</span></a></li>
		<li class="datum"><a href="datum.html"><i></i><span>资料</span></a></li>
		<li class="turntable"><a href="turntable.html"><i></i><span>大转盘</span></a></li>
		<li class="member"><a href="member.html"><i></i><span>会员中心</span></a></li>
		<li class="nav"><a href="nav.html"><i></i><span>导航</span></a></li> -->
	</ul>
</div>

<?php if ($_smarty_tpl->tpl_vars['detail_shop_notice']->value) {?>
<div class="shop_information notice">
	<h1><s></s>公告</h1>
	<div class="note"><?php echo $_smarty_tpl->tpl_vars['detail_shop_notice']->value;?>
</div>
</div>
<?php }?>

<div class="shop_information">
	<h1>店铺信息</h1>
	<ul>
		<li><em>店铺类型：</em><span><?php echo $_smarty_tpl->tpl_vars['detail_typeName']->value;?>
</span></li>
		<li><em>营业时间：</em><span>
			<?php if ($_smarty_tpl->tpl_vars['detail_start_time1']->value&&$_smarty_tpl->tpl_vars['detail_start_time1']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time1']->value&&$_smarty_tpl->tpl_vars['detail_end_time1']->value!="00:00") {
echo $_smarty_tpl->tpl_vars['detail_start_time1']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time1']->value;
}
if ($_smarty_tpl->tpl_vars['detail_start_time2']->value&&$_smarty_tpl->tpl_vars['detail_start_time2']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time2']->value&&$_smarty_tpl->tpl_vars['detail_end_time2']->value!="00:00") {?>; <?php echo $_smarty_tpl->tpl_vars['detail_start_time2']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time2']->value;
}
if ($_smarty_tpl->tpl_vars['detail_start_time3']->value&&$_smarty_tpl->tpl_vars['detail_start_time3']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time3']->value&&$_smarty_tpl->tpl_vars['detail_end_time3']->value!="00:00") {?>; <?php echo $_smarty_tpl->tpl_vars['detail_start_time3']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time3']->value;
}?>
		</span></li>
		<li><em>店铺地址：</em><span><?php echo $_smarty_tpl->tpl_vars['detail_address']->value;?>
</span><i><b></b></i></li>
		<li><em>电话：</em><span><?php echo $_smarty_tpl->tpl_vars['detail_phone']->value;
if ($_smarty_tpl->tpl_vars['detail_callshow']->value) {?><a href="tel:<?php echo $_smarty_tpl->tpl_vars['detail_phone']->value;?>
" class="calltel"></a><?php }?></span></li>

        <!-- 固定配送费 -->
        <?php if ($_smarty_tpl->tpl_vars['detail_delivery_fee_mode']->value==1) {?>
        <li><em>起送价：</em><span><?php echo $_smarty_tpl->tpl_vars['detail_basicprice']->value;?>
</span></li>
        <li><em>外送费：</em><span><?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee']->value;
if ($_smarty_tpl->tpl_vars['detail_delivery_fee_type']->value==2) {?>（订单满<?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee_value']->value;?>
元免外送费）<?php }?></span></li>

        <!-- 按距离 -->
        <?php } elseif ($_smarty_tpl->tpl_vars['detail_delivery_fee_mode']->value==3) {?>
        <li><em>起送价：</em><span>
            <?php  $_smarty_tpl->tpl_vars['range'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['range']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_range_delivery_fee_value']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['range']->key => $_smarty_tpl->tpl_vars['range']->value) {
$_smarty_tpl->tpl_vars['range']->_loop = true;
?>
                <p><?php echo $_smarty_tpl->tpl_vars['range']->value[0];?>
-<?php echo $_smarty_tpl->tpl_vars['range']->value[1];?>
公里：<?php echo $_smarty_tpl->tpl_vars['range']->value[3];?>
元</p>
            <?php } ?>
        </span></li>
        <li><em>外送费：</em><span>
            <?php  $_smarty_tpl->tpl_vars['range'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['range']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_range_delivery_fee_value']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['range']->key => $_smarty_tpl->tpl_vars['range']->value) {
$_smarty_tpl->tpl_vars['range']->_loop = true;
?>
                <p><?php echo $_smarty_tpl->tpl_vars['range']->value[0];?>
-<?php echo $_smarty_tpl->tpl_vars['range']->value[1];?>
公里：<?php echo $_smarty_tpl->tpl_vars['range']->value[2];?>
元</p>
            <?php } ?>
        </span></li>
        <?php }?>

		<?php if (!$_smarty_tpl->tpl_vars['detail_show_range']->value) {?><li><em>服务距离：</em><span><?php echo $_smarty_tpl->tpl_vars['detail_delivery_radius']->value;?>
公里</span></li><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['detail_delivery_area']->value) {?><li><em>配送区域：</em><span><?php echo $_smarty_tpl->tpl_vars['detail_delivery_area']->value;?>
</span></li><?php }?>

        <?php if ($_smarty_tpl->tpl_vars['detail_selfdefine']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['self'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['self']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_selfdefine']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['self']->key => $_smarty_tpl->tpl_vars['self']->value) {
$_smarty_tpl->tpl_vars['self']->_loop = true;
?>
        <li><em><?php echo $_smarty_tpl->tpl_vars['self']->value[1];?>
：</em><span><?php if ($_smarty_tpl->tpl_vars['self']->value[0]=="link") {?><a href="<?php echo $_smarty_tpl->tpl_vars['self']->value[2];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['self']->value[2];?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['self']->value[2];
}?></span></li>
        <?php } ?>
        <?php }?>
	</ul>
</div>

<?php if ($_smarty_tpl->tpl_vars['detail_open_addservice']->value&&$_smarty_tpl->tpl_vars['detail_addservice']->value) {?>
<div class="shop_information">
    <h1>店铺增值服务</h1>
    <ul>
        <?php  $_smarty_tpl->tpl_vars['add'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['add']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_addservice']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['add']->key => $_smarty_tpl->tpl_vars['add']->value) {
$_smarty_tpl->tpl_vars['add']->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['add']->value[0]!=''&&$_smarty_tpl->tpl_vars['add']->value[1]!="00:00"&&$_smarty_tpl->tpl_vars['add']->value[2]!="00:00") {?>
        <li><em><?php echo $_smarty_tpl->tpl_vars['add']->value[0];?>
：</em><span><?php echo $_smarty_tpl->tpl_vars['add']->value[1];?>
-<?php echo $_smarty_tpl->tpl_vars['add']->value[2];?>
 加收 <?php echo $_smarty_tpl->tpl_vars['add']->value[3];?>
元</span></li>
        <?php }?>
        <?php } ?>
    </ul>
</div>
<?php }?>

<!-- <div class="new_com">
	<div class="com_lead fn-clear"><em>最新评论</em><span>更多<i></i></span></div>
	<div class="com_list">
		<div class="com_txt">
			<h1>naisi</h1>
			<p>好评！msdkj嘻嘻嘻</p>
			<span class='fn-clear'><em>2017-03-21 14:23:31</em></span>
			<div class="pingjia"><i></i></div>
		</div>
		<div class="com_txt">
			<h1>naisi</h1>
			<p>好评！msdkj嘻嘻嘻</p>
			<span class='fn-clear'><em>2017-03-21 14:23:31</em></span>
			<div class="pingjia"><i></i></div>
		</div>
	</div>
</div> -->

<div class="foot">
	<div class="footer">
		<div class="ff fn-clear">
			<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/logo.png?v=2" alt="">
			<h1>金点外卖</h1>
			<p><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['cfg_basehost']->value,"http://",'');?>
</p>
		</div>
		<span>酷曼软件提供技术支持</span>
	</div>
</div>

<div class="navtion fn-clear">
	<ul>
		<li class="shop nav_bc"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'shop','id'=>$_tmp2),$_smarty_tpl);?>
"><i></i><span>首页</span></a></li>
		<li class="xuangou"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'buy','id'=>$_tmp3),$_smarty_tpl);?>
"><i></i><span>选购</span></a></li>
		<li class="car"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'cart','id'=>$_tmp4),$_smarty_tpl);?>
"><i></i><span>购物车</span></a></li>
		<li class="center"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user'),$_smarty_tpl);?>
"><i></i><span>个人中心</span></a></li>
	</ul>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
	var id = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
;
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
该店铺关闭了，您暂时无法在该店铺下单。<?php }?>');<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['detail_status']->value&&!$_smarty_tpl->tpl_vars['detail_ordervalid']->value) {?>alert('<?php if ($_smarty_tpl->tpl_vars['detail_closeorder']->value) {
echo $_smarty_tpl->tpl_vars['detail_closeorder']->value;
} else { ?>该店铺关闭了微信下单，您暂时无法在该店铺下单。<?php }?>');<?php }?>
	<?php if (!$_smarty_tpl->tpl_vars['detail_yingye']->value) {?>
		<?php if (!$_smarty_tpl->tpl_vars['detail_yingyeWeek']->value) {?>
		alert('该店铺今天暂停营业！营业时间：星期<?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['detail_weeks']->value,"1","一"),"2","二"),"3","三"),"4","四"),"5","五"),"6","六"),"7","七"),",","，星期");?>
');
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
		<?php }?>
	<?php }?>
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/swiper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/shop.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
