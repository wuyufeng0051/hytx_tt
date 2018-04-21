$(function(){

    // 吸顶
	var e = $("#order-by-panel");
        if (0 !== e.length) {
            var t = e.offset().top,
            n = $("#placeH42"),
            o = $("#bottom-page-pagination");
            if (0 !== o.length) {
                var r = o.offset().top;
                0 !== e.length && $(window).scroll(function() {
                    var o = $(window).scrollTop();
                    o > t && (e.addClass("fixed-to-top"), n.removeClass("hide")),
                    (t > o || o > r) && (e.removeClass("fixed-to-top"), n.addClass("hide"))
                })
            }
        }

    // 收藏按钮
    $('.watch__house .unfollow').click(function(){
        $(this).hide();$(this).siblings('.followed').show();
    })

    // 排序
    $('#orderby_panel .item').click(function(){
        var t = $(this);

        t.siblings('.item').removeClass('active l-d');

        if (!t.hasClass('active')) {
            t.removeClass('l-d').addClass('active');
        }else{
            t.removeClass('active').addClass('l-d')
        }

    })

    // 取消收藏
    $('.watch__house .followed').click(function(){
        $(this).hide();$(this).siblings('.unfollow').show();
    })

    // 地区选择
    $('.tab .oo').click(function(){
        var  u = $(this);
        var index = u.index();
        if (index == 0) {
            $('.item-child').hide()
        }else{
        $('.yu .item-child').eq(index).show();
        $('.yu .item-child').eq(index).siblings().hide();
    }

    })
    $('.tab-body-item span').click(function(){
        var x = $(this);
        x.addClass('bac');
        x.siblings("span").removeClass('bac');
    })
    $('.tabb span').click(function(){
        var x = $(this);
        x.addClass('bac');
        x.siblings("span").removeClass('bac');
    })

    //热门小区
    $('.hot li').hover(function(){
        $('.hot .op').hide();
        $(this).find(".op").show();
    })
    //我看过的房源
    $(".oppo").click(function(){
        if( $(".history__house .content").css("display")=='none' ) { 
            $(".history__house .content ").slideDown();
        }else{
            $(".history__house .content ").slideUp();
        }
        
    });
    // 大家都在看
    $(".recommend__house").slide({mainCell:".content",prevCell:".prev",nextCell:".next",vis:4, autoPage:true,effect:"left"});
})