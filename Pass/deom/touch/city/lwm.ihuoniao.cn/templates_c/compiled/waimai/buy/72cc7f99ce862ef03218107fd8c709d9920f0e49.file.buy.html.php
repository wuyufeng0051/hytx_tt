<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-28 09:36:26
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\buy.html" */ ?>
<?php /*%%SmartyHeaderCode:9914591a687014c230-28848462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72cc7f99ce862ef03218107fd8c709d9920f0e49' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\buy.html',
      1 => 1498094832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9914591a687014c230-28848462',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591a68701a9e47_80987454',
  'variables' => 
  array (
    'detail_shopname' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'detail_shop_notice_used' => 0,
    'detail_buy_notice' => 0,
    'detail_shop_banner' => 0,
    'collect' => 0,
    'detail_id' => 0,
    '_bindex' => 0,
    'type' => 0,
    'type1' => 0,
    'food' => 0,
    'detail_showsales' => 0,
    'detail_unitshow' => 0,
    'detail_common' => 0,
    'detail_address' => 0,
    'detail_start_time1' => 0,
    'detail_end_time1' => 0,
    'detail_start_time2' => 0,
    'detail_end_time2' => 0,
    'detail_start_time3' => 0,
    'detail_end_time3' => 0,
    'detail_phone' => 0,
    'detail_callshow' => 0,
    'detail_show_basicprice' => 0,
    'detail_open_range_delivery_fee' => 0,
    'detail_range_delivery_fee_value' => 0,
    'range' => 0,
    'detail_basicprice' => 0,
    'detail_show_delivery' => 0,
    'detail_delivery_fee' => 0,
    'detail_delivery_fee_type' => 0,
    'detail_delivery_fee_value' => 0,
    'detail_show_range' => 0,
    'detail_delivery_radius' => 0,
    'detail_delivery_area' => 0,
    'detail_selfdefine' => 0,
    'self' => 0,
    'banner' => 0,
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
<?php if ($_valid && !is_callable('content_591a68701a9e47_80987454')) {function content_591a68701a9e47_80987454($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
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
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/photoswipe.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/default-skin.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/xuangou.css?v=26">
<?php echo '<script'; ?>
 type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
</head>

<body>
<?php if ($_smarty_tpl->tpl_vars['detail_shop_notice_used']->value&&$_smarty_tpl->tpl_vars['detail_buy_notice']->value) {?>
<div class="notice">
	<i></i>
	<p><marquee behavior="scroll" scrollamount="2"><?php echo $_smarty_tpl->tpl_vars['detail_buy_notice']->value;?>
</marquee></p>
	<a href="javascript:;">&times;</a>
</div>
<?php }?>

<div class="head">
	<div class="shop-info">
		<div class="shop-info-img l"><a href="javascript:;"><img src="<?php if ($_smarty_tpl->tpl_vars['detail_shop_banner']->value[0]) {
echo $_smarty_tpl->tpl_vars['detail_shop_banner']->value[0];
} else { ?>/static/images/shop.png<?php }?>"></a></div>
		<div class="shop-txt">
			<h3><?php echo $_smarty_tpl->tpl_vars['detail_shopname']->value;?>
</h3>
			<p>
				<span class="shop-txt-store r<?php if ($_smarty_tpl->tpl_vars['collect']->value) {?> shou<?php }?>">收藏</span>
			</p>
		</div>
	</div>
	<div class="bg"></div>
</div>
<div class="menu-tab">
	<ul>
		<li class="active"><a href="javascript:;">点菜</a></li>
		<li><a href="javascript:;">评价</a></li>
		<li class="seller"><a href="javascript:;">商家</a></li>
	</ul>
</div>

<div class="main fn-clear<?php if ($_smarty_tpl->tpl_vars['detail_shop_notice_used']->value&&$_smarty_tpl->tpl_vars['detail_buy_notice']->value) {?> show_notice<?php }?>">
	<div class="menu-con" style="display: block;">
		<div class="main_left">
			<ul>
				<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>'foodType','return'=>'type','shop'=>$_tmp1)); $_block_repeat=true; echo waimai(array('action'=>'foodType','return'=>'type','shop'=>$_tmp1), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['type']==1) {?> class="ml_bac"<?php }?> data-id="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"><em><?php echo $_smarty_tpl->tpl_vars['type']->value['title'];?>
</em></li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>'foodType','return'=>'type','shop'=>$_tmp1), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</ul>
		</div>
		<div class="main_right">
			<div class="main_box">
				<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>'foodType','return'=>'type1','shop'=>$_tmp2)); $_block_repeat=true; echo waimai(array('action'=>'foodType','return'=>'type1','shop'=>$_tmp2), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<div class="main_item" id="item<?php echo $_smarty_tpl->tpl_vars['type1']->value['id'];?>
">
					<div class="menu-select-tit"><span><?php echo $_smarty_tpl->tpl_vars['type1']->value['title'];?>
</span></div>
					<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type1']->value['id'];?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>'food','return'=>'food','shop'=>$_tmp3,'typeid'=>$_tmp4)); $_block_repeat=true; echo waimai(array('action'=>'food','return'=>'food','shop'=>$_tmp3,'typeid'=>$_tmp4), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<div class="car_t1 fn-clear" id="food<?php echo $_smarty_tpl->tpl_vars['food']->value['id'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['food']->value['id'];?>
" data-title="<?php echo $_smarty_tpl->tpl_vars['food']->value['title'];?>
" data-src="<?php echo $_smarty_tpl->tpl_vars['food']->value['pics'][0];?>
" data-price="<?php echo $_smarty_tpl->tpl_vars['food']->value['price'];?>
" data-unit="<?php echo $_smarty_tpl->tpl_vars['food']->value['unit'];?>
" data-dabao="<?php if ($_smarty_tpl->tpl_vars['food']->value['is_dabao']) {
echo $_smarty_tpl->tpl_vars['food']->value['dabao_money'];
}?>" data-stock="<?php if ($_smarty_tpl->tpl_vars['food']->value['stockvalid']) {
echo $_smarty_tpl->tpl_vars['food']->value['stock'];
}?>" data-nature='<?php if ($_smarty_tpl->tpl_vars['food']->value['is_nature']&&$_smarty_tpl->tpl_vars['food']->value['nature_json']!="[]") {
echo $_smarty_tpl->tpl_vars['food']->value['nature_json'];
}?>' data-limitfood="<?php echo $_smarty_tpl->tpl_vars['food']->value['is_limitfood'];?>
"<?php if ($_smarty_tpl->tpl_vars['food']->value['is_limitfood']) {?> data-foodnum="<?php echo $_smarty_tpl->tpl_vars['food']->value['foodnum'];?>
" data-stime="<?php echo $_smarty_tpl->tpl_vars['food']->value['start_time'];?>
" data-etime="<?php echo $_smarty_tpl->tpl_vars['food']->value['stop_time'];?>
" data-times='<?php echo $_smarty_tpl->tpl_vars['food']->value['limit_time_json'];?>
'<?php }?>>
						<?php if ($_smarty_tpl->tpl_vars['food']->value['label']) {?><span class="label"><?php echo $_smarty_tpl->tpl_vars['food']->value['label'];?>
</span><?php }?>
						<div class="car_pic"><img src="<?php echo $_smarty_tpl->tpl_vars['food']->value['pics'][0];?>
" onerror="this.src='/static/images/food.png'"></div>
						<h1><?php echo $_smarty_tpl->tpl_vars['food']->value['title'];?>
</h1>
						<?php if ($_smarty_tpl->tpl_vars['food']->value['is_nature']&&$_smarty_tpl->tpl_vars['food']->value['nature_json']!='[]') {?><em class="nature_">多规格</em><?php }?>
						<h3><?php echo $_smarty_tpl->tpl_vars['food']->value['descript'];?>
&nbsp;</h3>
						<?php if ($_smarty_tpl->tpl_vars['detail_showsales']->value) {?><h4>已售<?php echo $_smarty_tpl->tpl_vars['food']->value['sale'];
echo $_smarty_tpl->tpl_vars['food']->value['unit'];?>
</h4><?php }?>
						<span class="fn-clear">
							<em class='sale-price'>&yen;<?php echo $_smarty_tpl->tpl_vars['food']->value['price'];?>
</em>
							<?php if ($_smarty_tpl->tpl_vars['detail_unitshow']->value) {?><i>/<?php echo $_smarty_tpl->tpl_vars['food']->value['unit'];?>
</i><?php }?>
							<?php if ($_smarty_tpl->tpl_vars['food']->value['stockvalid']&&$_smarty_tpl->tpl_vars['food']->value['stock']==0) {?>
							<s class="nostock">已售完</s>
							<?php } else { ?>
							<p><?php if (!$_smarty_tpl->tpl_vars['food']->value['is_nature']||$_smarty_tpl->tpl_vars['food']->value['nature_json']=="[]") {?><i class="reduce"></i><?php }?><strong class='num-account'>0</strong><b class="plus"></b></p>
							<?php }?>
						</span>
					</div>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>'food','return'=>'food','shop'=>$_tmp3,'typeid'=>$_tmp4), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</div>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>'foodType','return'=>'type1','shop'=>$_tmp2), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</div>
		</div>
	</div>
	<div class="menu-con menu-comment" id="menu-comment">
		<div class="comment">
			<div class="comment-tit fn-clear">
				<div class="comment-tit-l l">
					<h1><?php echo $_smarty_tpl->tpl_vars['detail_common']->value['star'];?>
</h1>
					<h2>综合评价</h2>
					<p>商家好评率<?php if ($_smarty_tpl->tpl_vars['detail_common']->value['totalCount']==0) {?>0<?php } else {
echo ($_smarty_tpl->tpl_vars['detail_common']->value['totalCount4']+$_smarty_tpl->tpl_vars['detail_common']->value['totalCount5'])/$_smarty_tpl->tpl_vars['detail_common']->value['totalCount']*100;
}?>%</p>
				</div>
				<div class="comment-tit-r l">
					<div class="l comment-star-top">
						<span class="l">配送评分</span>
						<div class="judge-box">
							<div class="judge-star l"><s style="width:<?php echo $_smarty_tpl->tpl_vars['detail_common']->value['starps']/5*100;?>
%"></s></div>
							<span class="sale-time r"><?php echo $_smarty_tpl->tpl_vars['detail_common']->value['starps'];?>
</span>
							<div class="clear"></div>
						</div>
					</div>
					<div class="l comment-star-bottom">
						<span class="l">商家评分</span>
						<div class="judge-box">
							<div class="judge-star l"><s style="width:<?php echo $_smarty_tpl->tpl_vars['detail_common']->value['star']/5*100;?>
%"></s></div>
							<span class="sale-time r"><?php echo $_smarty_tpl->tpl_vars['detail_common']->value['star'];?>
</span>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="comment-con">
				<div class="comment-box">
					<div class="loading">评论加载中，请稍后···</div>
				</div>
			</div>
		</div>
	</div>
	<div class="menu-con menu-seller">
		<div class="seller-box">
			<ul>
				<li><a href="tel:0512-67873735"><i><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/phone_icon.png" alt=""></i><span>0512-67873735</span><em></em></a></li>
				<li><a href="javascript:;" target="_blank" class="appMapBtn"><i><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/map.png" alt=""></i><span><?php echo $_smarty_tpl->tpl_vars['detail_address']->value;?>
</span></a></li>
				<li><i><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/time.png" alt=""></i><span><?php if ($_smarty_tpl->tpl_vars['detail_start_time1']->value&&$_smarty_tpl->tpl_vars['detail_start_time1']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time1']->value&&$_smarty_tpl->tpl_vars['detail_end_time1']->value!="00:00") {
echo $_smarty_tpl->tpl_vars['detail_start_time1']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time1']->value;
}
if ($_smarty_tpl->tpl_vars['detail_start_time2']->value&&$_smarty_tpl->tpl_vars['detail_start_time2']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time2']->value&&$_smarty_tpl->tpl_vars['detail_end_time2']->value!="00:00") {?>; <?php echo $_smarty_tpl->tpl_vars['detail_start_time2']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time2']->value;
}
if ($_smarty_tpl->tpl_vars['detail_start_time3']->value&&$_smarty_tpl->tpl_vars['detail_start_time3']->value!="00:00"&&$_smarty_tpl->tpl_vars['detail_end_time3']->value&&$_smarty_tpl->tpl_vars['detail_end_time3']->value!="00:00") {?>; <?php echo $_smarty_tpl->tpl_vars['detail_start_time3']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['detail_end_time3']->value;
}?></span></li>
				<li><s>电话：</s><span><?php echo $_smarty_tpl->tpl_vars['detail_phone']->value;
if ($_smarty_tpl->tpl_vars['detail_callshow']->value) {?><a href="tel:<?php echo $_smarty_tpl->tpl_vars['detail_phone']->value;?>
" class="calltel"></a><?php }?></span></li>
		<?php if (!$_smarty_tpl->tpl_vars['detail_show_basicprice']->value) {?><li><s>起送价：</s><span>
            <?php if ($_smarty_tpl->tpl_vars['detail_open_range_delivery_fee']->value) {?>
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
            <?php } else { ?>
            &yen;<?php echo $_smarty_tpl->tpl_vars['detail_basicprice']->value;?>

            <?php }?>
        </span></li><?php }?>
		<?php if (!$_smarty_tpl->tpl_vars['detail_show_delivery']->value) {?><li><s>外送费：</s><span>
            <?php if ($_smarty_tpl->tpl_vars['detail_open_range_delivery_fee']->value) {?>
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
            <?php } else { ?>
            &yen;<?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee']->value;?>

            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['detail_delivery_fee_type']->value!=1) {?>（<?php if ($_smarty_tpl->tpl_vars['detail_delivery_fee_type']->value==0) {?>订单金额达到起送价免外送费<?php } elseif ($_smarty_tpl->tpl_vars['detail_delivery_fee_type']->value==2) {?>订单满<?php echo $_smarty_tpl->tpl_vars['detail_delivery_fee_value']->value;?>
元免外送费<?php }?>）<?php }?>
        </span></li><?php }?>
		<?php if (!$_smarty_tpl->tpl_vars['detail_show_range']->value) {?><li><s>服务距离：</s><span><?php echo $_smarty_tpl->tpl_vars['detail_delivery_radius']->value;?>
公里</span></li><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['detail_delivery_area']->value) {?><li><s>配送区域：</s><span><?php echo $_smarty_tpl->tpl_vars['detail_delivery_area']->value;?>
</span></li><?php }?>

        <?php if ($_smarty_tpl->tpl_vars['detail_selfdefine']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['self'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['self']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_selfdefine']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['self']->key => $_smarty_tpl->tpl_vars['self']->value) {
$_smarty_tpl->tpl_vars['self']->_loop = true;
?>
        <li><s><?php echo $_smarty_tpl->tpl_vars['self']->value[1];?>
：</s><span><?php if ($_smarty_tpl->tpl_vars['self']->value[0]=="link") {?><a href="<?php echo $_smarty_tpl->tpl_vars['self']->value[2];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['self']->value[2];?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['self']->value[2];
}?></span></li>
        <?php } ?>
        <?php }?>
			</ul>
		</div>
		<div class="my-gallery certy" itemscope="" itemtype="" data-pswp-uid="1">
			<?php if ($_smarty_tpl->tpl_vars['detail_shop_banner']->value[0]) {?>
			<?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_shop_banner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value) {
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>
			<figure itemprop="associatedMedia" itemscope="" itemtype="">
				<a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value;?>
" itemprop="contentUrl" data-size="400x300">
					<img src="<?php echo $_smarty_tpl->tpl_vars['banner']->value;?>
" itemprop="thumbnail" alt="">
				</a>
			</figure>
			<?php } ?>
			<?php }?>
		</div>
	</div>
</div>

<div class="cart-box">
	<div class="title"><h3>已选商品</h3><a href="javascript:;" class="right">[清空]</a></div>
	<div class="con"></div>
</div>
<div class="mask_cart"></div>

<div class="nature">
	<h2><strong></strong><s>&times;</s></h2>
	<div class="con"></div>
	<div class="fot">
		<span><i>&yen;</i><strong>0</strong></span>
		<button class="confirm" disabled>选好了</button>
	</div>
</div>
<div class="mask_nature"></div>
<div class="cart-tips">点击购物车图标修改已选商品</div>
<div class="price fn-clear">
	<div class="gou"><em><i></i></em><b>0</b></div>
	<div class="zong_p">总价：<em>&yen;<strong>0.00</strong></em></div>
	<div class="ok"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo getUrlPath(array('service'=>'waimai','template'=>'cart','id'=>$_tmp5),$_smarty_tpl);?>
">选好了</a></div>
</div>


<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="pswp__bg"></div>

    <div class="pswp__scroll-wrap">

        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>


                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

          </div>

        </div>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', tplUrl = '<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
';
	var shopid = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
, id = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
, nowDate = <?php echo time();?>
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
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.fly.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/photoswipe.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/photoswipe-ui-default.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/pic-swiper.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/xuangou.js?v=20"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
