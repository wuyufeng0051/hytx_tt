$(function(){
	$("img").scrollLoading();

	//大图幻灯
	$("#slide").cycle({ 
		pager: '#slidebtn',
		pause: true,
		prev:'.prev',
        next:'.next'
	});

	//热卖爆款
	$('#saleGoods').cycle({
		pause: true,
        next:'.button .next'
	})



	// 侧边导航
	 $(window).scroll(function () {
        var scrollTop = $(document).scrollTop();
        var documentHeight = $(document).height();
        var windowHeight = $(window).height();
        var contentItems = $("#goods").find(".goodsAll");
        var currentItem = "";
       if(scrollTop>contentItems.first().offset().top-100){
       		$("#sideNav").fadeIn();
       }else{
       		$("#sideNav").fadeOut();
       }

        if (scrollTop+windowHeight==documentHeight) {
            currentItem= "#" + contentItems.last().attr("id");
        }else{
            contentItems.each(function () {
                var contentItem = $(this);
                var offsetTop = contentItem.offset().top;
                if (scrollTop > offsetTop-300) {
                    currentItem = "#" + contentItem.attr("id");
                }
            });
        }
        if(currentItem !=""){
        	if (currentItem != $("#sideNav").find(".current").attr("href")) {
        		$("#sideNav").find("a[href=" + currentItem + "]").addClass("current");
	            $("#sideNav").find("a[href=" + currentItem + "]").siblings("a").removeClass("current");
        	}
        }
        
    });
	
})