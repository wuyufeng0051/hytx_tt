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

	 // 图片延迟加载
	 $("img").scrollLoading();
})