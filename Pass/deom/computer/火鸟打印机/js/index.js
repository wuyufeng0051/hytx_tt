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