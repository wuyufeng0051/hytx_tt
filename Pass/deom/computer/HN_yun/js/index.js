$(function(){

    jQuery(".Friendlist").slide({titCell:".Friendbtn ul",mainCell:".plan-swiper ul",autoPage:true,effect:"left",autoPlay:true,vis:4,autoPage:"<li><a></a></li>"});
    
    $(document).ready(function(){
        // 顶部banner
        $('#picscroll').unslider({
            speed: 1000,               //  The speed to animate each slide (in milliseconds)
            delay: 20000,              //  The delay between slide animations (in milliseconds)
            autoplay:true,
            infinite:true,           //无缝滚动
            pause:true,
            keys: false,               //  Enable keyboard (left, right) arrow shortcuts
            dots: true,               //  Display dot navigation
            fluid: false 
        });
    })
})