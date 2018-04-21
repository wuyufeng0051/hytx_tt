$(function(){
	// 评论点击
	$(".com").focus(function(){
		$('.comment ').addClass('on');
		$('.btn').show();
		$('.black').show();
		$('body').animate({scrollTop: $('.com').offset().top}, 1000);
	})
	$(".black").click(function(){
		$('.comment ').removeClass('on');
		$('.btn').hide();
	});
	$(".btn").click(function(){
		$('.comment ').removeClass('on');
		$('.btn').hide();
	});
	$('input[type="text"],textarea').on('click', function () {
	  var target = this;
	  setTimeout(function(){
	        target.scrollIntoViewIfNeeded();
	        console.log('scrollIntoViewIfNeeded');
	      },400);
	});

	// 转发弹出层
	$('.zhuan').click(function(){
		$('.share').show();
	})
	$('.share').click(function(){
		$('.share').hide();
	})
	// 关注按钮
	$('.anchor_info .guanzhu em').click(function(){
		$('.done').show();
		$(".anchor_info .guanzhu").hide();
		setTimeout(function(){$('.done').hide()},1000);
		$(".floow").text('取消关注');
		$('.fans_list').addClass('wi');
	})
	$('.floow').click(function(){
		if ($(".anchor_info .guanzhu").css("display")=="none") {
			$(".floow").text('关注');
			$('.done').text('取消成功').show();
			setTimeout(function(){$('.done').hide()},1000);
			$(".anchor_info .guanzhu").show();
			$('.fans_list').removeClass('wi');
		}else{
			$(".floow").text('取消关注');
			$('.done').text('已关注').show();
			setTimeout(function(){$('.done').hide()},1000);
			$(".anchor_info .guanzhu").hide();
			$('.fans_list').addClass('wi');
		}
	})

	// 查看个人信息及关闭个人信息
	$('.anchor_info img , .fans_list li').click(function(){
		$('.introduce').show();
		$('.disk').show();
	})
	$('.close').click(function(){
		$('.introduce').hide();
		$('.disk').hide();
	})

	// 举报
	$(".inter_foot span").click(function(){
		$('.jubao_list').show();
		$('.introduce').hide();
	})
	$(".jubao_list .ju_main p").click(function(){
		$('.jubao_list').hide();
		$('.introduce').show();
	})
	// 点赞
   $(".zan").click(function(){
		var x = -500;       
		var y = 100;  
		var num = Math.floor(Math.random() * 3 + 1);
		var index=$('.connect_right').children('img').length;
		var rand = parseInt(Math.random() * (x - y) ); 
		
		$(".connect_right").append("<img src=''>");
		$('.connect_right img:eq(' + index + ')').attr('src','images/'+num+'.png')
		$(".connect_right img").animate({
			bottom:"300px",
			opacity:"0",
			left: rand,
		},3000);
   })
   setInterval(function(){
   	$('.connect_right img').remove()
   },20000);


   // 礼物列表点击出现消失
    $('.gift').click(function(){  
        $('.gift_list').slideDown(300);
        $('.gift_list,.black').show();
        if (swiper == undefined) {
		   var swiper = new Swiper('.swiper-container');
        };
    })
    $('.black').click(function(){
        $('.gift_list').slideUp(300);
        $('.black').hide();
        $('.buy').hide();
    })


    // 礼物列表点选切换
    $('.gift_list ul li').click(function(){
    	var x = $(this);
    	x.addClass('gift_bc');
    	x.siblings().removeClass('gift_bc');
    	if (x.hasClass('lian')) {
    		$('.lian_give').show();
    	}else{
    		$('.lian_give').hide();
    	}
    })
    // 余额充值
    $('.guide').click(function(){
    	$('.buy').show();
    })
    $('.buy .buy_lead i').click(function(){
    	$('.buy').hide();
    })

    // 充值选择支付方式
    $('.pay_sty ul li').click(function(){
    	var x = $(this);
    	x.addClass('ps_bc');
    	x.siblings().removeClass('ps_bc');
    })
    $('.buy .buy_list ul li').click(function(){
    	var  x = $(this),
    		money = x.find('.money em').text(),
    		web_money = x.find('.money_1 em').text();
    	$(".pay").show();
    	$('.black_1').show();
    	$('.pay_num h2 em').text(web_money);
    	$('.pay_num p em').text(money);
    })
    $('.pay .pay_lead i').click(function(){
    	$(".pay").hide();
    	$('.black_1').hide();
    })

    // 单次连击送礼物
 	var num = 2;
 	var timer;
	$(".give").bind("click",function(){
		var on = $(".gift_list ul").find('.gift_bc'),
			pic = $('.gift_list ul .gift_bc').find('img')[0].src,
	    	GiftName = $('.gift_list ul .gift_bc').find('span').text();
	if(on.data("lastClick")){
		// alert("相同");
		Giftnumber = num++;
		if ($('.giver_l').hasClass('dom')) {
			$('.giver_l.dom').remove();
		}
		$('.give_list').append('<div class="giver_l"><div class="giver_infor"><img src="upfile/1.jpg"><span>老木</span><em>送了'+GiftName+'</em></div><div class="gift_icon"><img src="'+pic+'"></div><div class="gift_num"><i>✘</i><span>'+Giftnumber+'</span></div></div>');
	    $('.giver_l').animate({"left":"0"},100).addClass('dom');
	    clearTimeout( timer );
	    timer = setTimeout(function(){$('.giver_l').remove();$('.gift_list ul li').removeData("lastClick");},1100);
	}else{
		// alert("不同");
		$(".gift_list ul li.gift_bc").removeData("lastClick");
		on.data("lastClick",true);
		$('.give_list').append('<div class="giver_l"><div class="giver_infor"><img src="upfile/1.jpg"><span>老木</span><em>送了'+GiftName+'</em></div><div class="gift_icon"><img src="'+pic+'"></div><div class="gift_num"><i>✘</i><span>1</span></div></div>');
	    $('.giver_l').animate({"left":"0"},100).addClass('dom');
	    setTimeout(function(){$('.giver_l').remove();},800);
	    num = 2;
	}
	})
	

	// 连击8
   	var Giftnumber = 8;
   	var timer1;
	$(".lian_give").bind("click",function(){
		var on = $(".gift_list ul").find('.gift_bc'),
			pic = $('.gift_list ul .gift_bc').find('img')[0].src,
	    	GiftName = $('.gift_list ul .gift_bc').find('span').text();
	if(on.data("lastClick1")){
		// alert("相同");
		Giftnumber = Giftnumber+8;
		if ($('.giver_l').hasClass('dom1')) {	
			$('.giver_l.dom1').remove();
		}
		$('.give_list').append('<div class="giver_l"><div class="giver_infor"><img src="upfile/1.jpg"><span>老木</span><em>送了'+GiftName+'</em></div><div class="gift_icon"><img src="'+pic+'"></div><div class="gift_num"><i>✘</i><span>'+Giftnumber+'</span></div></div>');
	    $('.giver_l').animate({"left":"0"},100).addClass('dom1');
	    clearTimeout( timer1 );
	    timer1 = setTimeout(function(){$('.giver_l').remove();$('.gift_list ul li').removeData("lastClick1");},2000);
	}else{
		// alert("不同");
		$(".gift_list ul li.gift_bc").removeData("lastClick1");
		on.data("lastClick1",true);
		$('.give_list').append('<div class="giver_l"><div class="giver_infor"><img src="upfile/1.jpg"><span>老木</span><em>送了'+GiftName+'</em></div><div class="gift_icon"><img src="'+pic+'"></div><div class="gift_num"><i>✘</i><span>8</span></div></div>');
	    $('.giver_l').animate({"left":"0"},100).addClass('dom1');
	    var timer = setTimeout(function(){$('.giver_l').remove();},1000);
	    Giftnumber = 8;
	}
	})



	// 点击全屏隐藏
	$('.video').click(function(){
		if ($('.head , .bottom').css("display")=="none") {
			$('.head , .bottom ').removeClass('none');
		}else{
			$('.head , .bottom').addClass('none');
		}
	})
	$('.head,.bottom').click(function(){
		return false;
	})


	var playBtn = $('.play');
    window.isLoading = false;
    
    playBtn.on('tap', function () {
        var $videoEle = $('video');
        $videoEle.length && $videoEle[0].play();
        playBtn.hide();
        $('.bottom').removeClass('none');
        window.isLoading = true;
    })



})

