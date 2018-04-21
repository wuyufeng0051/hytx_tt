$(function(){
	window._bd_share_config = {
		"common": {
		  "bdSnsKey": {},
		  "bdText": "",
		  "bdMini": "2",
		  "bdMiniList": false,
		  "bdPic": "",
		  "bdStyle": "0",
		  "bdSize": "16"
		},
		"share": {}
		};
		with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];
	// 导航栏切换
	$('.part_1 .p1_lead ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		$('.part_2 .personal_com').eq(index).show();
		$('.part_2 .personal_com').eq(index).siblings().hide();
		u.addClass('p1l_bc');
		u.siblings('li').removeClass('p1l_bc');
	})
	// 评价
	$('.part_2 .p2_list5 .p5_left .review .review_choice .label label').click(function(){
		var x = $(this);
		var index = x.index();
		x.addClass('lab_bc');
		x.siblings('label').removeClass('lab_bc');
	})
	// 法律咨询切换
	$('.part_2 .p2_list .p2_left .consult .inter_lead ul li').hover(function(){
		var  u = $(this);
		var index = u.index();
		$('.consult_ll .consult_list').eq(index).show();
		$('.consult_ll .consult_list').eq(index).siblings().hide();
		u.addClass('inl_bac');
		u.siblings('li').removeClass('inl_bac');
	})
})