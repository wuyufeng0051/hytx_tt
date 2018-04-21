<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-20 12:02:13
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\courier\statistics.html" */ ?>
<?php /*%%SmartyHeaderCode:235375947a4a23bc067-32692915%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d020c71babb8e3d1ed1a3d0a31086f298ff5fc0' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\courier\\statistics.html',
      1 => 1497931310,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235375947a4a23bc067-32692915',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5947a4a23db469_81544565',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'courier_state' => 0,
    'success' => 0,
    'failed' => 0,
    'amount' => 0,
    'peisong' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5947a4a23db469_81544565')) {function content_5947a4a23db469_81544565($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>我的统计</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/touchBase.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=33"><?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" href="/templates/courier/css/mobiscroll.css"/>
<link rel="stylesheet" type="text/css" href="/templates/courier/css/leMai.css?v=8">
</head>

<body>
<!-- 外卖订单 -->
<div class="waiMai">
	<a href="javascript:;" class="kaiGuan xiaoXue<?php if ($_smarty_tpl->tpl_vars['courier_state']->value==1) {?> kaiGuan01<?php }?>"><i></i></a>
	<p>我的统计</p>
	<a href="/?service=waimai&do=courier&template=logout" class="logout"></a>
</div>

<!-- 今日外卖战绩 -->
<div class="todayWai">
	<div class="zhanJi fn-clear">
		<span>今日外卖战绩</span>
	</div>
	<div class="yiuLan fn-clear" style="margin-top: .2rem;">
		<div class="yiuLan01">
			<p><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
单</p>
			<span>成功</span>
		</div>
		<div class="yiuLan01 yiuLan02">
			<p><?php echo $_smarty_tpl->tpl_vars['failed']->value;?>
单</p>
			<span>失败</span>
		</div>
	</div>
	<div class="yiuLan fn-clear" style="margin-top: .6rem;">
		<div class="yiuLan01">
			<p><?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
元</p>
			<span>收入</span>
		</div>
		<div class="yiuLan01 yiuLan02">
			<p><?php echo $_smarty_tpl->tpl_vars['peisong']->value;?>
元</p>
			<span>收款</span>
		</div>
	</div>
</div>

<!-- 外卖订单统计、外卖营业额统计 -->
<div id="waimaiBtn">
	<div class="bgTongji">
		<div class="part01">
			<a href="javascript:;" class="fn-clear">
				<span>外卖历史统计</span>
				<s><i></i></s>
			</a>
		</div>
	</div>
</div>

<!-- 开始时间、结束时间 -->
<div id="timeSelect" class="fn-hide">
	<div class="bgTongji">
		<div class="part01 xiaoQi">
			<a href="javascript:;" class="fn-clear">
				<label for="test3" class="startT">开始时间</label>
				<label for="test3" class="endT"><s><i></i></s></label>
				<input type="text" name="test3" id="stime" class="demo-test-datetime" placeholder="选择开始时间">
			</a>
		</div>
		<div class="part01 part02 xiaoQi01">
			<a href="javascript:;" class="fn-clear">
				<label for="test2" class="startT">截止时间</label>
				<label for="test2" class="endT"><s><i></i></s></label>
				<input type="text" name="test2" id="etime" class="demo-test-datetime" placeholder="选择截止时间">
			</a>
		</div>
	</div>
	<!-- 点击查询 -->
	<div class="checkTj"><a href="javascript:;">查看统计</a></div>
</div>


<div class="bottomFix">
	<ul class="fn-clear bottomFix01">
		<li class="maiWai"><a href="/?service=waimai&do=courier&state=3"><i></i><p>订单</p></a></li>
		<li class="paoTui"><a href="/?service=waimai&do=courier&template=comment"><i></i><p>评价</p></a></li>
		<li class="woDe woDe01"><a href="/?service=waimai&do=courier&template=statistics"><i></i><p>统计</p></a></li>
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
  type="text/javascript" src="/templates/courier/js/mobiscroll.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
  type="text/javascript" src="/templates/courier/js/mobiscroll.datetime.js"><?php echo '</script'; ?>
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


	//显示时间
	$("#waimaiBtn a").bind("click", function(){
		$("#waimaiBtn").hide();
		$("#timeSelect").show();
	});

	//年月日 时分
    $('.demo-test-datetime').scroller(
    	$.extend({preset: 'datetime', stepMinute: 10, dateFormat: 'yyyy-mm-dd'})
    );

	//查看统计
	$(".checkTj a").bind("click", function(){
		var stime = $("#stime").val(), etime = $("#etime").val();
		if(stime == "" || etime == ""){
			alert("请选择时间");
			return false;
		}

		location.href = "/?service=waimai&do=courier&template=statisticsHistory&stime="+stime+"&etime="+etime;

	});
});
<?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
