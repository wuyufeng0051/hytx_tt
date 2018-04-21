$(function(){
	// 幻灯片
		$('.cont_Projector').slide({mainCell:"#slides", titCell:".pagination", autoPlay:true, autoPage:true,effect:"fold"})
	// 网站公告
		$('.erSearch').slide({mainCell:".announcement .announcement_tit_list ",autoPage:true,effect:"topLoop",autoPlay:true,vis:1});
	// 搜索栏找工作
		$("#search_name").click(function(){
        if( $(".erSearch_list_box").css("display")=='none' ) { 
            $(".erSearch_list_box ").show();
        }else{
            $(".erSearch_list_box ").hide();
        }
        })

		$('.erSearch_list_c a').click(function(){
			var  x = $(this);
			var  b = x.text();
			$('.erSearch_left span').text(b);
			$('.erSearch_list_box').hide();
		})
	// 导航栏
		$('.menu_box').hover(function(){
			var x = $(this);
			x.find('.menu_sub').show();
		}, function(){
			$(this).find('.menu_sub').hide();
		})

		$('.menu_box').hover(function(){
			var i = $(this);
			i.addClass("current");
		}, function(){
			var i = $(this);
			i.removeClass("current");
		})
	// 名企招聘
		$('.tlogo ul li').hover(function(){
			var i = $(this);
			i.addClass("current1");
		}, function(){
			var i = $(this);
			i.removeClass("current1");
		})
	// 更换验证码
		$('.vdimgck, .change').click(function(){
		var a = $(this),img;
		if(a.hasClass('change')){
			img = a.siblings("a").find('img');
		}else{
			img = a;
		}
		var src = img.attr('src') + '?v=' + new Date().getTime();
		img.attr('src',src);
		})

	// 提交
	var lgform = $('.Indexlogin_box ');
	var err = lgform.find('#show_name');
	var pas = lgform.find('#show_pass');
	lgform.submit(function(e){
		e.preventDefault();
		var nameinp = $('#username'),
			name = nameinp.val(),
			psdinp = $('#password2'),
			psd = psdinp.val(),
			vdimgckinp = $('#txt_CheckCode'),
			vdimgck = vdimgckinp.val(),
			submit = $(".Indexlogin_bth"),
			r = true;
		if(name == ''){
			console.log(name)
			err.show();
			nameinp.focus();
			r = false;
		}else{
			err.hide();
		}
		if(r && psd == ''){
			pas.show();
			psdinp.focus();
			r = false;
		}else{
			pas.hide();
		}
})
	})

