$(function(){
	// 悬赏金额
	$('.part_2 .p2_list .xs_money ul li').click(function(){
		var  u = $(this);
		var index = u.index();
		u.addClass('xs_bc');
		u.siblings('li').removeClass('xs_bc');
	})
	//字数限制
	var commonChange = function(t){
		var val = t.val(), maxLength = 35, tip = $(".part_2 .p2_list .title .ti_txt b");
		var charLength = val.replace(/<[^>]*>|\s/g, "").replace(/&\w{2,4};/g, "a").length;
		charLength = charLength <= 0 ? 0 : charLength;
		var txt = "<em>" + charLength + "</em>/35";
		tip.html(txt);
		if(charLength >= 34){
			t.val(val.substr(0, maxLength));
		}
	}
	//页面打开后自动执行
	$("#commentText").focus(function(){
		commonChange($(this));
	});
	$("#commentText").keyup(function(){
		commonChange($(this));
	});
	$("#commentText").keydown(function(){
		commonChange($(this));
	});
	$("#commentText").bind("paste", function(){
		commonChange($(this));
	});
	//文本字数限制
	var wenChange = function(t){
		var val = t.val(), wenLength = 1000, type = $(".part_2 .p2_list .con_txt .position .number");
		var clLength = val.replace(/<[^>]*>|\s/g, "").replace(/&\w{2,4};/g, "a").length;
		clLength = clLength <= 0 ? 0 : clLength;
		var txt = "<em>" + clLength + "</em>/1000";
		type.html(txt);
		if(clLength >= 1000){
			t.val(val.substr(0, wenLength));
		}
	}
	//页面打开后自动执行
	$(".shuru").focus(function(){
		wenChange($(this));
	});
	$(".shuru").keyup(function(){
		wenChange($(this));
	});
	$(".shuru").keydown(function(){
		wenChange($(this));
	});
	$(".shuru").bind("paste", function(){
		wenChange($(this));
	});
	// input选中边框变色
	$(".border_color").focus(function(){
		var x = $(this);
		var close = x.closest('.bc_d')
		close.css("border-color","#85c0ea");
	});
	$(".border_color").blur(function(){
		var x = $(this);
		var close = x.closest('.bc_d')
		close.css("border-color","#dddddd");
	});
	$(".ds_color").focus(function(){
		$('.part_2 .p2_list .xs_money .other_mo span').css({"background":"#ffa800","color":"#fff"});
		$('.part_2 .p2_list .xs_money .other_mo em').css("border-color","#ffa800");
		$('.part_2 .p2_list .xs_money ul li').removeClass('xs_bc');
	});
	$(".ds_color").blur(function(){
		$('.part_2 .p2_list .xs_money .other_mo span').css({"background":"#fff","color":"#000"});
		$('.part_2 .p2_list .xs_money .other_mo em').css("border-color","#dddddd");
	});
	// 点击警告隐藏
	$('.part_2 .p2_list .title .ti_txt input').click(function(){
		$('.part_2 .p2_list .title .ti_txt input').closest('.title').find('.warning').hide();
	})
	$('.shuru').click(function(){
		$('.shuru').closest('.content').find('.warning').hide();
	})
	$('.part_2 .p2_list .tel .tel_txt input').click(function(){
		$('.part_2 .p2_list .tel .tel_txt input').closest('.tel').find('.warning').hide();
	})
	$('.part_2 .p2_list .yzm .yzm_txt input').click(function(){
		$('.part_2 .p2_list .yzm .yzm_txt input').closest('.yzm').find('.warning').hide();
	})
	// 表单验证
	$('.part_2 .p2_list button').click(function(){
		var tel = $('.part_2 .p2_list .tel .tel_txt input').val();
		var	x = $('#commentText');
		var	y = $('.part_2 .p2_list .tel .tel_txt input');
		var	z = $('.shuru ');
		var	a = $('.part_2 .p2_list .yzm .yzm_txt input ');
		var	colse = x.closest('.title').find('.warning');
		var	y_colse = y.closest('.tel').find('.warning');
		var	z_colse = z.closest('.content ').find('.warning');
		var	a_colse = a.closest('.yzm').find('.warning');
		if (x.val() == "") {
			colse.show();
		}
		else if (z.val() == "") {
			z_colse.show();
		}
		else if (y.val() == "") {
			y_colse.show();
		}
		else if (!(/^1[34578]\d{9}$/.test(tel))){
			y_colse.show();
		}
		else if (a.val() == "") {
			a_colse.show();
		};
	})
	$('.part_2 .p2_list .tel .tel_txt input').keyup(function(){
		if (!$('.part_2 .p2_list .tel .tel_txt input').val() == "") {
		$('.part_2 .p2_list .yzm em').css("background","#4794d2")
	}else{
		$('.part_2 .p2_list .yzm em').css("background","#eaeaea")
	}
	})
	$('.border_color').keyup(function(){
		if (!$('.border_color').val() == "") {
		$('.part_2 .p2_list button').css("background","#4794d2")
	}else{
		$('.part_2 .p2_list button').css("background","#eaeaea")
	}
	})

	// 地区选择
	$(".part_2 .p2_list .con_txt .position .place").click(function(){
		var x = $(this);
		var next = x.closest('.position').find('.selcity');
        if( next.css("display")=='none' ) { 
            next.show();
        }else{
            next.hide();
        }
    });
})