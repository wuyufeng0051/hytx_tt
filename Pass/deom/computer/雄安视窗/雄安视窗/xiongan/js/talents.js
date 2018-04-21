$(function(){

	jQuery(".p_lead").slide({mainCell:".gg_list",autoPlay:true,effect:"topMarquee",vis:1,interTime:100,trigger:"click"});

	// 名企招聘遮罩层
	$('.p_list ').hover(function(){
		var x = $(this),
			find = x.find('i');
		find.show();
	},function(){
		var x = $(this),
			find = x.find('i');
		find.hide();
	});

	// 名企招聘鼠标滑过显示隐藏
	$('.pos').hide();
    $('.part_2 .p2_list .p2l_2 ul li').mousemove(function(e){
        $('.part_2 .p2_list .p2l_2 ul li').find('.pos').show().css({
            "top": e.pageY-80,
            "left": e.pageX+5
        });
    });
    $('.part_2 .p2_list .p2l_2 ul li').mouseleave(function(){
        $('.pos').hide();
    });

	// 最新招聘信息tab切换
	$('.part_2 .p2l_left ul li').hover(function(){
		var x = $(this),
			index = x.index();
		$('.p2_list .p2ll').eq(index).show().siblings().hide();
		x.addClass('p2l_bc');
		x.siblings().removeClass('p2l_bc')
	})

	$('.p2l_l1').hover(function(){
		$(".part_2 .p2l_left").css("background-image","url(../images/i12.gif)");  
	})
	$('.p2l_l2').hover(function(){
		$(".part_2 .p2l_left ").css("background-image","url(../images/i12_12.gif)");  
	})
	$('.p2l_l3').hover(function(){
		$(".part_2 .p2l_left ").css("background-image","url(../images/i12_12_12.gif)");  
	})

	// 选择职能

	$('.n4from1 .dis').click(function(){
		$('.disk').show();
		$('.position').show();
	})
	$('.position .pos_lead span').click(function(){
		$('.disk').hide();
		$('.position').hide();
	})
	$('.position .pos_list a ').mouseover(function(){
		var x = $(this),
			find = x.find('.pos_detail');
		find.show();
	})
	$('.position .pos_list a ').mouseout(function(){
		$('.pos_detail').hide();
	})
	$('.pos_detail em').click(function(){
		var x = $(this),
			txt = x.text();
		$('.n4from1 .dis').text(txt);
		$('.position').hide();
		$('.disk').hide();
	})
})