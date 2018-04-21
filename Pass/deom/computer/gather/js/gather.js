  $(function(){
    // 栏目选择
                // setLMPoint();
                // $('.leftmenu a').hover(function() {
                //     var o = $(this),
                //     index = o.index();
                //     if (o.hasClass('curr')) {
                //         $('.leftmenu .curr').removeClass('leave');
                //     } else {
                //         $('.leftmenu .curr').addClass('leave');
                //     }
                //     lmAnimat(index);
                // },
                // function() {
                //     setLMPoint();
                //     $('.leftmenu .curr').removeClass('leave');
                // }) 
                // function setLMPoint() {
                //     if ($('#lmbg').length <= 0) {
                //         $('.leftmenu').append('<a class="bg" id="lmbg"></a>')
                //     }
                //     var actli = $('.leftmenu a.active').parent('a'),
                //     index = actli.index();
                //     actli.addClass('curr');
                //     lmAnimat(index);
                // }
                // function lmAnimat(index) {
                //     if (index == -1) {
                //         $('#lmbg').css({
                //             'left': '70px'
                //         });
                //     }else{
                //         var t = index * 130 + 60;
                //         $('#lmbg').css({
                //             'left': t + 'px'
                //         });
                //     }
                    
                // }
// 筛选事件
            $('.auto_area').filterizr();
            $('.fixed_area li').click(function(){   
            $(this).addClass('select-channel').siblings().removeClass('select-channel');
        }) 
// 筛选事件
// 左侧导航栏滚动条事件
        var obj=$(".fixed_area");
        var navH = obj.offset().top; //获取要定位元素距离浏览器顶部的距离
        $(window).scroll(function(){
                var scroH = $(this).scrollTop(); //获取滚动条的滑动距离
                //滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
                if(scroH>=navH){
                        obj.css({"position":"fixed","top":0}); //top值因不同主题而定
                }else if(scroH<navH){
                        obj.css({"position":"static"});
                }
                //console.log(scroH==navH);
        })
// 左侧导航栏滚动条事件
        $('.fixed_area ul li').click(function(){
            $('.auto_area .filtr-item').removeClass('pp')
        })


        $("a[target=qqlink_iframe]").each(function() {
        var browserName = navigator.appName;
        if (browserName == "Microsoft Internet Explorer") {
            $(this).attr("target", "_blank");
        }
        
    });

})