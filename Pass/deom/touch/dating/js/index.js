$(function(){
	var c = 0, e = 0, f = 0, g = false;

	$('.index-pic').bind("touchstart", function() {
        c = event.touches[0].pageX
    });

    $('.index-pic').bind( "touchmove", function() {
        event.preventDefault();
        e = event.targetTouches[0].pageX;
        f = e - c;
        g = true
    });

    $('.index-pic').bind("touchend", function() {
        g && (0 > f ? doLikeOrNotLike("toLeft") : doLikeOrNotLike("toRight"), g = !1)
    });

    //喜欢&不喜欢
    $(".netbox input").bind("click", function(){
    	doLikeOrNotLike($(this).hasClass("not") ? "toLeft" : "toRight");
    });
    $('.yes').click(function(){
    	var x = $(this);
	  	x.addClass('yy');
	  	setTimeout(function() {
        x.removeClass("yy")}, 250)
    })

    function doLikeOrNotLike(a){
        var b = this, c = $(".index-pic a").length, d = $(".index-pic a:last");
        if (c > 1) {
            var f = d.attr("userid");
            "toRight" == a ? flyToRight(f, 1) : "toLeft" == a && flyToLeft(f);
        } else {
            alert("load more...");
        }
    }

    function flyToLeft(a) {
        var b = this, c = $('.index-pic a[userid="'+a+'"]');
        return c.addClass("toleft"), c.fadeOut(300, function() {
            c.remove()
        });
    }

    function flyToRight (a, b) {
        var c = this;
        if (1 == b) {
            var d = c.$('.index-pic a[userid="'+a+'"]');
            d.addClass("toright"), d.fadeOut(300, function() {
                d.remove()
            })
    	}
    }
})
