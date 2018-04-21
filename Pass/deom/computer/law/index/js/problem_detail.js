$(function(){
	// 打赏
	$('.answer .answer_list .answer_txt .marker,.answer .answer_list .answer_txt .ans_right .user_list .uu .dashang').click(function(){
		$('.mask,.enjoy').show();
	})
	$('.enjoy .enjoy_lead i').click(function(){
		$('.mask,.enjoy').hide();
	})
	// 采纳
	$('.answer .answer_list .answer_txt .ans_right .user_list .uu .caina').click(function(){
		$('.mask,.caina_list').show();
	})
	$('.caina_list ul li,.caina_list .caina_lead i').click(function(){
		$('.mask,.caina_list').hide();
	})
	// 评价
	$('.answer .answer_list .answer_txt .ans_right .user_list .uu .pingjia ').click(function(){
		$('.mask,.pingjia_list').show();
	})
	$('.pingjia_list .tiji a,.pingjia_list .pingjia_lead i').click(function(){
		$('.mask,.pingjia_list').hide();
	})
	// 打赏金额
	$('.dashang_1  ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		u.addClass('dashang_bc');
		u.siblings('li').removeClass('dashang_bc');
	})
	// 支付方式
	$('.pay_style  ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		u.addClass('pay_bc');
		u.siblings('li').removeClass('pay_bc');
	})
	// 收藏
	$('.part_2 .p2_left .exe .label .lab_sc span').click(function(){
		var i = $(this);
		if (i.hasClass('sc_bac')) {
			i.removeClass('sc_bac');
		}else{
			i.addClass('sc_bac')
		}
	})
	// 我来回答
	$('.part_2 .p2_left .exe .huida').click(function(){
		var i = $(this);
		var txt = i.closest('.exe').find('.repeat_txt');
		if (i.hasClass('huida_bc')) {
			i.removeClass('huida_bc');
			txt.hide();
		}else{
			i.addClass('huida_bc');
			txt.show();
		}
	})
	// 立即回复
	$('.answer .answer_list .answer_txt .hf').click(function(){
		var i = $(this);
		var txt = i.closest('.answer_txt').find('.repeat_txt');
		if (i.hasClass('huifu_bc')) {
			i.removeClass('huifu_bc');
			txt.hide();
		}else{
			i.addClass('huifu_bc');
			txt.show();
		}
	})
	// 评价
	$('.answer .answer_list .answer_txt .ans_right .user_list .uu .ask').click(function(){
		var i = $(this);
		var txt = i.closest('.answer_txt').find('.repeat_txt');
		if (i.hasClass('ask_bc')) {
			i.removeClass('ask_bc');
			txt.hide();
		}else{
			i.addClass('ask_bc');
			txt.show();
		}
	})


	//评分
	var star_text= {
		rating: {r0:{text:''},r1:{text:'差'  },r2:{text:'一般'},r3:{text:'还不错'},r4:{text:'很满意'},r5:{text:'强烈推荐'}}
	};
	$('.pingfen').mousemove(function (e) {
		var sender = $(this);
		var name= sender.attr('data-sync');
		var data_rating = $('input[name="'+name+'"]');
		var width = sender.width();
		var left = sender.offset().left;
		var percent = (e.pageX - left) / width * 100;
		var stars = Math.ceil((percent > 100 ? 100 : percent) / 100 * 5);
		sender.find('.pingfen_selected').css({ width: stars * 20 + '%' });
		var starcfg = star_text && star_text[name] && star_text[name]['r' + stars] ? star_text[name]['r' + stars] : null;
		if (starcfg) {
			sender.next('.pingfen_tip')
				.text(starcfg.text)
				.fadeIn(100);
		}
		if(stars == 0){
			sender.next('.pingfen_tip').stop().fadeOut();
		}
	}).click(function(e){
		e.preventDefault();
		var sender = $(this);
		var name= sender.attr('data-sync');
		var data_rating = $('input[name="'+ name+'"]');
		var width = sender.width();
		var left = sender.offset().left;
		var percent = (e.pageX - left) / width * 100;
		var stars = Math.ceil((percent > 100 ? 100 : percent) / 100 * 5);
		if(data_rating.length) data_rating.val(parseInt(stars));
		var starcfg = star_text && star_text[name] && star_text[name]['r' + stars] ? star_text[name]['r' + stars] : null;
		sender.next('.pingfen_tip')
			.text(starcfg ? starcfg.text : sender.attr('title'))
			.fadeIn(100);
		if(stars == 0){
			sender.next('.pingfen_tip').stop().fadeOut();
		}
	}).mouseleave(function(e){
		e.preventDefault();
		var sender = $(this);
		var name= sender.attr('data-sync');
		var data_rating = $('input[name="'+ name+'"]');
		var width = sender.width();
		var val= data_rating.val();
		var stars = (val && val.length ? val : 0);
		var starcfg = star_text && star_text[name] && star_text[name]['r' + stars] ? star_text[name]['r' + stars] : null;
		sender.find('.pingfen_selected').css({ width: val * 10 * 2 + '%' });
		sender.next('.pingfen_tip')
			.text(starcfg.text)
			.fadeIn(100);
		if(stars == 0){
			sender.next('.pingfen_tip').stop().fadeOut();
		}
	});

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
})