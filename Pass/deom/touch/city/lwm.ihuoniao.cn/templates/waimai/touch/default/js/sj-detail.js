$(function() {

    var list = $(".cart-box");

    //点菜、商家切换
    $('.menu-tab li').click(function() {
        var index = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.menu-con').eq(index).show().siblings().hide();
    })

    // 收藏
    $('.shop-txt-store').click(function() {
        var userid = $.cookie(cookiePre+"login_user");
        if(userid == null || userid == ""){
            location.href = masterDomain + "/login.html";
            return false;
        }

        var shou = $(this).hasClass('shou'), type = "add";
        if (shou) {
			type = "del";
            $('.shop-txt-store').removeClass('shou');
            $('.shop-txt-store').html('收藏')
        } else {
            $('.shop-txt-store').addClass('shou');
            $('.shop-txt-store').html('已收藏')
        }
		$.post("/include/ajax.php?service=member&action=collect&module=waimai&temp=store&type="+type+"&id="+id);
    })

    // 购物车图标
    $('.bottom-box .cart').click(function() {
        if ($(this).hasClass('active')) {
            if (list.find("li").length < 1) {
                $('.cart-box,.mask').hide();
            } else {
                $('.cart-box,.mask').show();
            }
        }
    })

    // 遮罩层
    $('.mask').on('touchstart', function() {
        $(this).hide();
        $('.cart-box').hide();
    })

    // 点菜左边切换
    $('.menu-select-left li').on('touchend',function() {
        $(this).addClass('active').siblings().removeClass('active');
        var index = $(this).index();
        $(".menu-select-right").stop().animate({scrollTop: $(".menu-select-box:eq("+index+")").position().top}, 300);
    })

    // 公告
    $('.shop-annouce, .shop-info-img,.shop-txt h3').click(function(){
        $('.infor-box').show();
    })
    $('.shut span').click(function(){
        $('.infor-box').hide();
    })

    // 点击商家头像名称
    // $('.shop-info-img,.shop-txt h3').click(function(){
    //     $('.menu-seller').show().siblings().hide();
    //     $('.seller').addClass('active').siblings().removeClass('active');
    // })

})
