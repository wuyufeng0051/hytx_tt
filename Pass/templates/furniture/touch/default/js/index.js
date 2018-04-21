$(function(){

	// banna轮播图
	$('.picscroll .count').text($('#picscroll li').length);
	 $('#picscroll').slider({changedFun:function(n){
			 var li = $('#picscroll ul li'), active = li.eq(n);
			 if(n < li.length - 1) {
					 if(!active.hasClass('showed')) {
							 active.addClass('showed');
					 }
					 var next = li.eq(n+1);
					 next.addClass('showed');
			 }
			 $('.picscroll .page').text(++n);
	 }})

	// 头部导航渐显
	var Color = {
	    init: function() {
	        var t = this.getopacity();
	        this.changeColor(t)
	    },
	    changeColor: function(t) {
	        var n = $(".header");
	        t < 25 ? (n.css("background", "rgba(206,30,30,0 )")) : (t /= 100, n.css("background", "rgba(206,30,30," + t + ")"))
	    },
	    getopacity: function() {
	        var t = $(window).scrollTop();
	        return t /= 2, t > 90 ? 90 : t
	    }
	};
	Color.init(),
	$(window).on("scroll", function() {
	    Color.init()
	});

	// 导航栏
	$('.header-r').click(function(){
		var nav = $('.nav'), t = $('.nav').css('display') == "none";
		if (t) {nav.show();}else{nav.hide();}
	})

	// 下拉加载
	var h = $('.footer').height() + $('.like li').height();
	var allh = $('body').height();
	var w = $(window).height();
	var scroll = allh - h - w;
	$(document).ready(function() {
		$(window).scroll(function() {
			if ($(window).scrollTop() > scroll) {
				// alert('111');
			};
		});
	});

})
