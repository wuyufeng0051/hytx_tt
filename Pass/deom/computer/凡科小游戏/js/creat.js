$(function(){

	// 时间插件
	$("input[name='act_start_time'],input[name='act_stop_time']").datetimepicker();
	$("input[name='awards_start'],input[name='awards_stop']").datetimepicker();

	// 滚动条插件
	$(window).load(function(){
            $(".content").mCustomScrollbar();
    }); 
	// 一级首页栏 tab切换
	$('.crl_top ul li').click(function(){
		var x = $(this),
			index = x.index(),
			va = x.data("choice");
		x.addClass('Crltop_bc').siblings().removeClass('Crltop_bc');
		$("."+va).show().addClass('active').siblings().hide().removeClass('active');

		$(".crl_line span").stop().animate({
			left: 0 + index * 93.3 + "px"
		}, 100);
	})
	// $('.next').click(function(){
	// 	var 
	// })

	// 二级基础设置 tab切换
	$('.editDetail .ed_tab ul li').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('tab_bc').siblings().removeClass('tab_bc');
		$('.ed_list .TipsBox').eq(index).show().siblings().hide();
	})

	// 基础设置 参与人数 参与人数限制 强制关注 开启与关闭
	$('.lab_box1 label').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box1 .lab_show').hasClass('lab_bc')) {
			x.closest('.jn_box').find('.num_box').show();
			$('.jion').show();
		}else{
			x.closest('.jn_box').find('.num_box').hide();
			$('.jion').hide();
		};
	})
	$('.people').keyup(function(){
		var	y = $(".people").val();
		$('.jion em').text(y);
	})
	$('.lab_box2 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box2 .lab_show').hasClass('lab_bc')) {
			x.closest('.astrict_number').find('.num_box').show();
		}else{
			x.closest('.astrict_number').find('.num_box').hide();
		};
	})

	$('.lab_box3 label , .lab_box4 label , .lab_box19 label , .lab_box22 label').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('lab_bc').siblings().removeClass('lab_bc');
	})




	// 派发方式下的tab切换
	$('.gift_style .gift_nav ul li').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('gift_bc').siblings().removeClass('gift_bc');
		$('.gift_list .gl_txt').eq(index).show().siblings().hide();
	})

	// 抽奖派发 总抽奖机会限制开关
	$('.lab_box5 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box5 .lab_show').hasClass('lab_bc')) {
			x.closest('.settingLine').find('.num_box').show();
		}else{
			x.closest('.settingLine').find('.num_box').hide();
		};
	})

	// 抽奖派发 好友助力开启关闭
	$('.lab_box6 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box6 .share').hasClass('lab_bc')) {
			x.closest('.friend_help').find('.friend_box1').show();
		}else{
			x.closest('.friend_help').find('.friend_box1').hide();
		};
		if ($('.lab_box6 .invite').hasClass('lab_bc')) {
			x.closest('.friend_help').find('.friend_box2').show();
		}else{
			x.closest('.friend_help').find('.friend_box2').hide();
		};
	})

	// 抽奖派发 联系信息开启关闭
	$('.lab_box7 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box7 .jion_before').hasClass('lab_bc')) {
			x.closest('.friend_help').find('.friend_box3').show();
		}else{
			x.closest('.friend_help').find('.friend_box3').hide();
		};
		if ($('.lab_box7 .chou_before').hasClass('lab_bc')) {
			x.closest('.friend_help').find('.friend_box4').show();
		}else{
			x.closest('.friend_help').find('.friend_box4').hide();
		};
		if ($('.lab_box7 .gole_after').hasClass('lab_bc')) {
			x.closest('.friend_help').find('.friend_box5').show();
		}else{
			x.closest('.friend_help').find('.friend_box5').hide();
		};
	})

	// 抽奖派发 联系信息内需填信息勾选
	$('.fb_choice1 label').click(function(){
		var x = $(this);
			if (x.hasClass('lab_bc_dui')) {
				x.removeClass('lab_bc_dui');
			}else{
				x.addClass('lab_bc_dui');
			};
	})

	$('.comfort_box').click(function(){
		var x = $(this);
		if (x.hasClass('lab_bc_dui')) {
			$('.awards_lead .comfort').show().addClass('awa_bc');
			$('.awa_item').removeClass('awa_bc');
			$('.comfort_list').show();
			$('.awards_txt').hide();
		};
	})


	// 奖项设置 添加奖项
	$('.addAwardNum').click(function(){
		var t = $('.awards_list .active'), index = t.index();
		if (index < 8) {
			$('.awards_list .awards_txt').eq(index+1).addClass('active').siblings('.awards_txt').removeClass('active');
			$('.comfort').removeClass('awa_bc');
			$('.awards_lead_list .awa_item').eq(index+1).addClass('active , awa_bc').siblings('.awa_item').removeClass('awa_bc');
		};
	})
	$('.delAwardNum').click(function(){
		var t = $('.awards_lead_list .awa_bc'), index = t.index();
		if (index > 0) {
			$('.awards_list .awards_txt').eq(index-1).addClass('active').siblings('.awards_txt').removeClass('active');
			$('.awards_lead_list .awa_item').eq(index).removeClass('active , awa_bc');
			$('.awards_lead_list .awa_item').eq(index-1).addClass('awa_bc');
			$('.comfort_list').hide();
		};
		
	})
	// 抽奖派发 联系信息内对应奖项
	$('.fb_choice label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.fb_choice .part').hasClass('lab_bc')) {
			x.closest('.fb_choice').find('.tips').show();
		}else{
			x.closest('.fb_choice').find('.tips').hide();
		};
	})

	// 奖项设置 下拉选择奖品类型
	$('.awardType_lead').click(function(){
		var x = $(this);
		if ($('.awardType_txt').css('display') == "none") {
			$('.awardType_txt').show();
		}else{
			$('.awardType_txt').hide();
		};
		return false;
	})
	$('.awardType_txt p').click(function(){
		var x = $(this),
			txt = x.text();
		$('.level_set .awardTypeSetBox span').text(txt);
		$('.awardType_txt').hide();
		x.addClass('awardType_bc').siblings().removeClass('awardType_bc');
	})
	$('.awardType_txt p').hover(function(){
		var x = $(this);
		x.addClass('awardType_bc').siblings().removeClass('awardType_bc');
	})
	$('body').click(function(){
		$('.awardType_txt').hide();
	})

	// 奖项设置 选择奖项兑换方式
	$('.lab_box8 label').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.down_line').hasClass('lab_bc')) {
			$('.warning input').val('凭券联系现场工作人员兑奖');
			$('.warning1 s').text('兑奖地址：');
			$('.warning1 input').val('请填写您的兑奖地址或者门店地址');
		}else{
		};
		if ($('.on_line').hasClass('lab_bc')) {
			$('.warning input').val('点击“立即兑奖”跳转到兑奖界面');
			$('.warning1 s').text('网页链接：');
			$('.warning1 input').val('http://');
		}else{
		};
	})

	// 奖项设置 兑奖期限选择
	$('.lab_box9 label').click(function(){
		var x = $(this),
			index = x.index(),
			find = x.closest('.level_set').find('.timer2'),
			find1 = x.closest('.level_set').find('.timer3');
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if (find.hasClass('lab_bc')) {
			x.closest('.level_set').find('.awards-data').show();
		}else{
			x.closest('.level_set').find('.awards-data').hide();
		};
		if (find1.hasClass('lab_bc')) {
			x.closest('.level_set').find('.awards-local').show();
		}else{
			x.closest('.level_set').find('.awards-local').hide();
		};
	})

	// 奖项设置 兑奖期限选择
	$('.lab_box10 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box10 .by_hand_tab').hasClass('lab_bc')) {
			x.closest('.level_set').find('.by_hand').show();
		}else{
			x.closest('.level_set').find('.by_hand').hide();
		};
	})

	// 奖项设置 兑奖期限选择
	$('.lab_box11 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box11 .week').hasClass('lab_bc')) {
			x.closest('.level_set').find('.week_box').show();
		}else{
			x.closest('.level_set').find('.week_box').hide();
		};
	})

	// 奖项设置 兑奖期限选择
	$('.lab_box12 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box12 .in_web').hasClass('lab_bc')) {
			x.closest('.level_set').find('.custom_btn').show();
		}else{
			x.closest('.level_set').find('.custom_btn').hide();
		};
		if ($('.lab_box12 .OneKey_web').hasClass('lab_bc')) {
			x.closest('.level_set').find('.one_key').show();
		}else{
			x.closest('.level_set').find('.one_key').hide();
		};
	})

	// 分享设置  好友助力允许与禁止
	$('.lab_box13 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box13 .allow').hasClass('lab_bc')) {
			x.closest('.share_seting').find('.allow_box').show();
		}else{
			x.closest('.share_seting').find('.allow_box').hide();
		};
	})
	
	// 分享设置  好友助力允许与禁止
	$('.lab_box14 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box14 .cum_pic').hasClass('lab_bc')) {
			x.closest('.share_box').find('.shareIMG_box').show();
		}else{
			x.closest('.share_box').find('.shareIMG_box').hide();
		};
	})

	// 分享设置 微信分享内容 以及自定义
	$('.lab_box15 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box15 .my_choice').hasClass('lab_bc')) {
			x.closest('.share_box').find('.shareBox_TextBox').show();
		}else{
			x.closest('.share_box').find('.shareBox_TextBox').hide();
		};
	})

	$('.shareBox_TextBox').on('click','.TextBox_Title .TT_Interposition .TT_InterList p',function(){
        var text = $(this).text();
        var TextBox_TextContent = $(this).parents('.shareBox_TextBox').find('.TextBox_TextContent');
        var html = $('<span contenteditable="false">'+ text +'</span>');
        var sel = window.getSelection();
        var range = TextBox_TextContent.data('range');
        if((text == '奖品名称' || text == '奖项等级') && !checkWxShareContet($('.TextBox_TextContent').get(2))){
            $('#wxShareWarm').show();                   
        }
        if(!range){
            TextBox_TextContent.append(html);
        }else{
            sel.removeAllRanges();
            sel.addRange(range);
            range.deleteContents();
            range.insertNode(html[0]);
            range = range.cloneRange();
            range.setStartAfter(html[0]);
            range.collapse(true);
            sel.removeAllRanges();
            sel.addRange(range);
            TextBox_TextContent.data('range',range);
        }
        TextBox_TextContent.find('br').remove();
        TextBox_TextContent.append('<br>');
        $(this).parents('.shareBox_TextBox').find('.tagOptionsBox').hide();
    });

	// 高级设置 企业信息游戏设置 tab切换
	$('.More_seting .More_lead ul li').click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('ML_bc').siblings().removeClass('ML_bc');
		$('.More_list .More_txt').eq(index).show().siblings().hide();
		$(".M_line em").stop().animate({
			left: 0 + index * 110 + "px"
		}, 100);
	})

	// 高级设置 企业Logo 页面加载图片 功能按钮 开启关闭
	$('.lab_box16 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box16 .More_show').hasClass('lab_bc')) {
			x.closest('.More_com').find('.MoreLogo_upload').show();
		}else{
			x.closest('.More_com').find('.MoreLogo_upload').hide();
		};
	})
	$('.lab_box17 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box17 .More_show1').hasClass('lab_bc')) {
			x.closest('.More_com').find('.MoreLogo_upload').show();
		}else{
			x.closest('.More_com').find('.MoreLogo_upload').hide();
		};
	})
	$('.lab_box18 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box18 .jump').hasClass('lab_bc')) {
			x.closest('.More_com').find('.menuBox').show();
		}else{
			x.closest('.More_com').find('.menuBox').hide();
		};
		if ($('.lab_box18 .jump_1').hasClass('lab_bc')) {
			x.closest('.More_com').find('.menuBox1').show();
		}else{
			x.closest('.More_com').find('.menuBox1').hide();
		};
	})

	// 高级设置 游戏设置部分开关 开启关闭
	$('.lab_box20 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box20 .self').hasClass('lab_bc')) {
			x.closest('.More_com').find('.num_box').show();
		}else{
			x.closest('.More_com').find('.num_box').hide();
		};
	})
	$('.lab_box21 label').click(function(){
		var x = $(this),
			index = x.index();
			x.addClass('lab_bc').siblings().removeClass('lab_bc');
		if ($('.lab_box21 .self').hasClass('lab_bc')) {
			x.closest('.More_com').find('.num_box').show();
		}else{
			x.closest('.More_com').find('.num_box').hide();
		};
	})


	// 左侧模拟手机端 活动说明tab切换
	$(".poupTitleBox ul li").click(function() {
		$(this).addClass('on');
		$(this).siblings().removeClass('on');
		var index = $(".poupTitleBox ul li").index(this);
		$('.poupList .poupMain').eq(index).show();
		$('.poupList .poupMain').eq(index).siblings().hide();

		$(".poupline span").stop().animate({
			left: 20 + index * 88.33 + "px"
		}, 300);
	})


	// 图片拖拽
	$('.PhoneIndex .biao , .PhoneIndex .jinnang ,.PhoneIndex .start ,.PhoneIndex .jion ').each(function(){
	    $(this).dragging({
	        move : 'both', //拖动方式  1、x   2、y    3、both(xy)
	        randomPosition : false , //开启随机位置
	        hander:'.hander'//鼠标按住此类拖动
	    });
	});
	$( ".biao" ).resizable({     //要调整的DIV的ID   #resizable1
	  aspectRatio: true  //开启按比例缩放，也可以指定比例： 16 / 9
	});

	// 更换图片
	$(".upload_IMG").click(function () {
		$(".upload_IMG").on("change",function(){
			var x = $(this),
				objUrl = getObjectURL(this.files[0]) ; 
			if (objUrl) {
				x.closest('.IMG_Box').find('img').attr("src", objUrl) ; 
			}
		});
	});
	function getObjectURL(file) {
	    var url = null ;
	    if (window.createObjectURL!=undefined) { // basic
	      url = window.createObjectURL(file) ;
	    }else if (window.URL!=undefined) { // mozilla(firefox)
	      url = window.URL.createObjectURL(file) ;
	    }else if (window.webkitURL!=undefined) { // webkit or chrome
	      url = window.webkitURL.createObjectURL(file) ;
	    }
	    return url ;
	}

	// 游戏过程更换大背景
	$('.PhoneCourse ').hover(function(){
		$('.PhoneCourse_BC .edit_IMG').show();
	},function(){
		$('.PhoneCourse_BC .edit_IMG').hide();
	})

	$('.awardsDetailSet').click(function(){
		var x = $(this),
			find = x.closest('.awards_list').find('.awardsDetailSet_List');
		if (find.css('display') == 'none') {
			x.closest('.awards_seting ').find('.awardsDetailSet_List').show();
			x.removeClass('DetailSet_BC');
		}else{
			x.closest('.awards_seting ').find('.awardsDetailSet_List').hide();
			x.addClass('DetailSet_BC');
		};
	})




})

 
        
