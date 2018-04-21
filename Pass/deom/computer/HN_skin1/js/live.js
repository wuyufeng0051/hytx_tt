$(function(){

	// 礼物列表展开  礼物选中
	$('.Gift_arrow i').click(function(){
	    var t = $(this);
	    if ($('.Gift_box2 ').hasClass('show')) {
		    $('.Gift_box2 ').removeClass('show').animate({"height":"52px"},200);
		    t.removeClass('zhuan');
	    }else{
		    $('.Gift_box2 ').addClass('show').animate({"height":"217px"},200);
		    t.addClass('zhuan');
	    }
	})

	$('.Gift_box2 ul li').click(function(){
		var x =$(this),
			img = x.find('img')[0].src;
		x.addClass('GB_bc').siblings().removeClass('GB_bc');
		$('.quantity img').attr('src',img);
	})

	// 送出礼物数量列表展开 以及选择
	$('.quantity i').click(function(){
	    var t = $(this);
	    if ($('.quantity_list').hasClass('border')) {
		    $('.quantity_list').animate({"height":"0px"},200).removeClass('border');
		    t.removeClass('zhuan_1');
	    }else{
		    $('.quantity_list').addClass('border').animate({"height":"252px"},200);
		    t.addClass('zhuan_1');
	    }
	})

	$('.quantity .quantity_list ul li').click(function(){
		var x = $(this);
			txt = x.find('span').text();
		$('.quantity input').val(txt);
	    $('.quantity_list').animate({"height":"0px"},200).removeClass('border');
	    $('.quantity i').removeClass('zhuan_1');
	})

	// 观众发表言论区tab切换
	$('.discuss .Dis_lead ul li').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('DL_bac').siblings().removeClass('DL_bac');
		$('.Dis_list .Dis_txt').eq(index).show().siblings().hide();
	})

	// 关注按钮
	$('.Personal_infor .care').click(function(){
		var x = $(this);
		if (x.hasClass('guanzhu')) {
			x.text('关注').removeClass('guanzhu');
		}else{
			x.text('已关注').addClass('guanzhu');
		}
	})
	$('.rank_detail .rank_title span').click(function(){
		$(this).hide();
	})
})