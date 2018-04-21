$(function(){
	$('.video').trigger('play');
     $('#dowebok').fullpage({
        'verticalCentered': false,
        'css3': true,
        'navigation': true,
        'navigationPosition': 'right',
        'navigationTooltips': ['', '', '', ''],
        'loopBottom':true,
         'anchors':["page1","page2","page3","page4","page5","page6","page7"],
    })
    var scrollFunc = function (e) {  
        e = e || window.event;  
        if (e.wheelDelta) {  //判断浏览器IE，谷歌滑轮事件               
            if (e.wheelDelta > 0) { //当滑轮向上滚动时 
                if ($('.p1').hasClass('active')) {
                    $('.pa1').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_1').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_2').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_3').hasClass('active')) {
                    $('.pa3').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_4').hasClass('active')) {
                    $('.pa4').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_5').hasClass('active')) {
                    $('.pa5').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_6').hasClass('active')) {
                    $('.pa6').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }
            }  
            if (e.wheelDelta < 0) { //当滑轮向上滚动时  
                if ($('.p1').hasClass('active')) {
                    $('.pa1').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_1').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_2').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_3').hasClass('active')) {
                    $('.pa3').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_4').hasClass('active')) {
                    $('.pa4').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_5').hasClass('active')) {
                    $('.pa5').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_6').hasClass('active')) {
                    $('.pa6').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }
            }  
        } else if (e.detail) {  //Firefox滑轮事件  
            if (e.detail > 0) { //当滑轮向上滚动时 
                if ($('.p1').hasClass('active')) {
                    $('.pa1').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_1').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_2').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_3').hasClass('active')) {
                    $('.pa3').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_4').hasClass('active')) {
                    $('.pa4').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_5').hasClass('active')) {
                    $('.pa5').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_6').hasClass('active')) {
                    $('.pa6').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }
            } 
            if (e.detail < 0) { //当滑轮向上滚动时  
                if ($('.p1').hasClass('active')) {
                    $('.pa1').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_1').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_2').hasClass('active')) {
                    $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_3').hasClass('active')) {
                    $('.pa3').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_4').hasClass('active')) {
                    $('.pa4').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_5').hasClass('active')) {
                    $('.pa5').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }else if ($('.part_6').hasClass('active')) {
                    $('.pa6').addClass('nav_bc').siblings('li').removeClass('nav_bc');
                }
            }  
        }  
    }  
    //给页面绑定滑轮滚动事件  
    if (document.addEventListener) {//firefox  
        document.addEventListener('DOMMouseScroll', scrollFunc, false);  
    }  
    //滚动滑轮触发scrollFunc方法  //ie 谷歌  
    window.onmousewheel = document.onmousewheel = scrollFunc;   
    function getVideoInfo () {
        var video = $('.video');
        var videoH = video[0].videoHeight;
        var videoW = video[0].videoWidth;
        window.onresize = function() {
            // if (video.height() / video.width() > videoRatio) {
            //     console.log('Width:' + video.width() + ' Height: ' + (video.width() * videoRatio));
            // } else {
              // 'Width:' + $(window).width() + ' Height: ' + $(window).height() );
              // 
                // console.log($('.video video').width(),$(window).width())
                $('.video video').removeClass('.size');
                
                loadSize();
               

            // }
        }
    }

getVideoInfo();
    $('.lead .nav ul li').click(function(){
        var x = $(this);
        x.addClass('nav_bc').siblings('li').removeClass('nav_bc');
    })
    $('.page_box p').click(function(){
        $('.pa1').addClass('nav_bc').siblings('li').removeClass('nav_bc');
    })
    $('#fp-nav ul li').click(function(){
        var x = $(this),
            index = x.index();
        if (index = 1) {
            $('.pa1').addClass('nav_bc').siblings('li').removeClass('nav_bc');
        }else if (index = 2,3) {
            $('.pa2').addClass('nav_bc').siblings('li').removeClass('nav_bc');
        }else if (index = 4) {
            $('.pa3').addClass('nav_bc').siblings('li').removeClass('nav_bc');
        }else if (index = 5) {
            $('.pa4').addClass('nav_bc').siblings('li').removeClass('nav_bc');
        }else if (index = 6) {
            $('.pa5').addClass('nav_bc').siblings('li').removeClass('nav_bc');
        }else if (index = 7) {
            $('.pa6').addClass('nav_bc').siblings('li').removeClass('nav_bc');
        }
    })
})
loadSize();

function loadSize(){
    var windowWidth = $(window).width(), windowHeight = $(window).height();
    var aa = windowWidth / windowHeight, rate = 1920 / 1080;
    if (aa < rate) {
        $('.video video').css({
        // "height":$(window).height(),
        "top":-(($('.video video').height()-$(window).height())/120),
        "left":"0",
        "width":'auto'
        })
    }else{
         $('.video video').css({
        "width":$(window).width(),
        "top":"0",
        "left":-(($('.video video').width()-$(window).width())/2),
        "height":'auto'
        })
    }; 
    if ($(window).width()>1920) {
        $('.video video').css({
        "height":$(window).height(),
        "top":-(($('.video video').height()-$(window).height())/4),
        "position":"relative",
        "display":"block",
        "left":"0",
        "width":'1920px',
        "margin":'0 auto'
        })
    }
}