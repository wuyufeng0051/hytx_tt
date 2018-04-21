$(function(){
	$('img').scrollLoading();
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

    $('.footer .top').click(function(){
        $(window).scrollTop(0);
    })
})