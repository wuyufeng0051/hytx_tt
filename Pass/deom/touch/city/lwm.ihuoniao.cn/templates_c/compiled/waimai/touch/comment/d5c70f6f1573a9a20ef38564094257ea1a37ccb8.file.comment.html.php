<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-20 12:59:15
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\courier\comment.html" */ ?>
<?php /*%%SmartyHeaderCode:1224759489f0fa8c967-78814138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5c70f6f1573a9a20ef38564094257ea1a37ccb8' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\courier\\comment.html',
      1 => 1497934748,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1224759489f0fa8c967-78814138',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59489f0fabb762_48662375',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'courier_state' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59489f0fabb762_48662375')) {function content_59489f0fabb762_48662375($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>我的评价</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/touchBase.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=33"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="/templates/courier/css/leMai.css?v=8">
</head>

<body>
<!-- 外卖订单 -->
<div class="waiMai">
	<a href="javascript:;" class="kaiGuan xiaoXue<?php if ($_smarty_tpl->tpl_vars['courier_state']->value==1) {?> kaiGuan01<?php }?>"><i></i></a>
	<p>我的评价</p>
	<a href="/?service=waimai&do=courier&template=logout" class="logout"></a>
</div>

<div class="lewaimai">
	<div class="peisongyuan">
		<!-- 我的评分 -->
		<div class="myTongji">
			<a href="#" class="fn-clear">
				<i class="reMark"></i>
				<span>我的评分</span>
				<span class="fiveStar">5</span>
				<s style="background: none; margin-top: 0;">
					<b></b>
					<b class="star01"></b>
				</s>
			</a>
		</div>
	</div>
</div>

<!-- 评论详细 -->
<div id="list">
	<div class="remarkDetail">
		<p class="waimBlue fn-clear">
			<span>【外卖】</span>
			<s>
				<b></b>
				<i></i>
			</s>
		</p>
		<span class="goodRemark">好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！</span>
		<p class="goodRemark01 fn-clear">
			<span>向雪莲</span>
			<i>2017-02-22 23:35:22</i>
		</p>
	</div>
	<div class="remarkDetail">
		<p class="waimBlue fn-clear">
			<span>【外卖】</span>
			<s>
				<b></b>
				<i></i>
			</s>
		</p>
		<span class="goodRemark">好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！ 好评！</span>
		<p class="goodRemark01 fn-clear">
			<span>向雪莲</span>
			<i>2017-02-22 23:35:22</i>
		</p>
	</div>
</div>

<div class="bottomFix">
	<ul class="fn-clear bottomFix01">
		<li class="maiWai"><a href="/?service=waimai&do=courier&state=3"><i></i><p>订单</p></a></li>
		<li class="paoTui paoTui01"><a href="/?service=waimai&do=courier&template=comment"><i></i><p>评价</p></a></li>
		<li class="woDe"><a href="/?service=waimai&do=courier&template=statistics"><i></i><p>统计</p></a></li>
	</ul>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/templates/courier/js/drag-loading.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	//开工
	$(".kaiGuan").bind("click", function(){
		var t = $(this), state = 1, title = "开工啦";
		if(t.hasClass("kaiGuan01")){
			state = 0;
			title = "收工啦";
			t.removeClass("kaiGuan01");
		}else{
			t.addClass("kaiGuan01");
		}

		$('.youqingTixing').html('<i>'+title+'</i>').show();
		setTimeout(function(){
			$(".youqingTixing").hide();
		}, 1000);

		$.ajax({
            url: '/include/ajax.php?service=waimai&action=updateCourierState',
            data: {
				state: state
            },
            type: 'get',
            dataType: 'json',
            success: function(data){
				location.reload();
			}
		});

	});
});
<?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
