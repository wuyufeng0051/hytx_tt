 $(document).ready(function(){
        nynavhd('#right_nav',function(){
            /*var winSc =  $(window).scrollTop(),tmp,num= 1,navList;
             for(var i=1;i<7;i++){
             tmp = $("#nr"+i).offset().top;
             if((tmp-150)<=winSc){
             num = i
             }
             }
             navList = $('li','#right_nav');
             navList.removeClass('active');
             navList.eq(num-1).addClass('active')*/
        });
        scrollto('#right_nav li',300,'#nr');
    });
    function nynavhd(a,cb) {
        var b = $(a),
                timer,
                c = b.offset().top;//当前高度
        $(window).scroll(function() { 
            clearTimeout(timer);
            timer = setTimeout(function(){
                var b = $(window).scrollTop(),
                        d = parseInt(c) - parseInt(b);
                0 >= d ? $(a).stop().animate({
                    top: -d+c+20
                }, 500) : $(a).stop().animate({
                    top: c
                }, 500)
                cb();
            },100)
        })
    }
    function scrollto(a, b, c) {
        var $navv, s,d;
        for ($navv = $(a), s = 0; s < $navv.length; s++){
            $navv.eq(s).attr("date-scroll", c + (s + 1));
        }
        $navv.click(function() {
            var a = $(this).attr("date-scroll"),
                    c = $(a),navList;
            navList = $('li','#right_nav');
            navList.removeClass('active');
            $(this).addClass('active');
            d = Math.abs($(window).scrollTop() - c.offset().top) / 5 + b;
            $("html,body").animate({
                scrollTop: c.offset().top
            }, d);
            return false;
        })
    }
