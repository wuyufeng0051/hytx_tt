$(function(){
	// 收费类型
	$('.crtxt-1 span').click(function(){
		var i = $(this);
		if (i.hasClass('select')) {
			i.removeClass('select');
		}else{
			i.addClass('select')
		}
	})
	
	// 分享
	window._bd_share_config=
	{"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"",
	"bdStyle":"1","bdSize":"16"},
	"share":{}};with(document)0[(getElementsByTagName('head')[0]||body)
	.appendChild(createElement('script'))
	.src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='
	+~(-new Date()/36e5)];

	// 顶部二维码
	$('.topbarlink li').hover(function(){
		var s = $(this);
		s.find('.pop').show();
	}, function(){
		$(this).find('.pop').hide();
	})
	// 用户讨论
	$('.featur-lead p').click(function(){
		var k = $(this);
		var index = k.index();
		$('.xuanze .tt').eq(index).show();
		$('.xuanze .tt').eq(index).siblings().hide();
		k.addClass('fea-bc');
		k.siblings('p').removeClass('fea-bc');
	})
	// 导航栏置顶
	var Ggoffset = $('.list-lead').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop();
		if(Ggoffset < d){
				$('.list-lead').addClass('fixed');
		}else{
			$('.list-lead').removeClass('fixed');
		}
	});
		var isClick = 0;
	//左侧导航点击
	$(".list-lead a").bind("click", function(){
		isClick = 1; //关闭滚动监听
		var t = $(this), parent = t.parent(), index = parent.index(), theadTop = $(".con-tit:eq("+index+")").offset().top - 40;
		parent.addClass("current").siblings("li").removeClass("current");
		$('html, body').animate({
         	scrollTop: theadTop
     	}, 300, function(){
     		isClick = 0; //开启滚动监听
     	});
	});
	//滚动监听
	$(window).scroll(function() {
	if(isClick) return false;
    var scroH = $(this).scrollTop();
    var theadLength = $(".con-tit").length;
    $(".list-lead li").removeClass("current");

    $(".con-tit").each(function(index, element) {
        var offsetTop = $(this).offset().top;
        if (index != theadLength - 1) {
            var offsetNextTop = $(".con-tit:eq(" + (index + 1) + ")").offset().top - 40;
            if (scroH < offsetNextTop) {
                $(".list-lead li:eq(" + index + ")").addClass("current");
                return false;
            }
        } else {
            $(".list-lead li:last").addClass("current");
            return false;
        }
    });
});
	// 导航
	$('.shoucang .gt').click(function(){
		var gy = $('.shoucang .gy');
		if (gy.css('display') == 'none') {
			gy.show().siblings('.gt').hide();
		}else{
			$('.shoucang .gt').show();
			gy.hide();
		}
	});
})
