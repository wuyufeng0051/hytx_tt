$(function(){

  // 系统截图展示
	$("#slideBox_1").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,autoPage:'<li></li>'});
	$("#slideBox_2").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,autoPage:'<li></li>'});
	$("#slideBox_3").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,autoPage:'<li></li>'});
	$("#slideBox_4").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,autoPage:'<li></li>'});
	$("#slideBox_5").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,autoPage:'<li></li>'});
	$("#slideBox_6").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,autoPage:'<li></li>'});

  $('.module-tab li').click(function(){
    var t = $(this), index = $(this).index();
    t.addClass('active').siblings('li').removeClass('active');
    $('.slideWrap .slideBox').eq(index).show().siblings('.slideBox').hide();
  })

	// 核心功能模块
	$(window).on('scroll', function(){
		var sct = $(window).scrollTop(), offset = $('.module-span').offset().top - 500;
		if (sct > offset) {
			$('.module-span').addClass('show');
		}
	})

	// 视频播放器
	var myPlayer = videojs('my-video');
	videojs("my-video").ready(function(){
		var myPlayer = this;
		myPlayer.pause();
	});
	$(".link-2").click(function(){
		$(".popupVideo").fadeIn(200);
		$(".popupVideo video")[0].play();
	});
	$(".popupVideo .close").click(function(){
		$(".popupVideo").fadeOut(200);
		$(".popupVideo video")[0].pause();
	});

})
