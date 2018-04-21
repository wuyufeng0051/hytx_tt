$(function(){
	 var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true,
	        // paginationBulletRender: function (swiper, index, className) {
	        //     return '<span class="' + className + '">' + (index + 1) + '</span>';
	        // }
	    });
	  // 收藏
    $('.pay_de_lead em').click(function(){
        var z = $(this);
        if (z.hasClass('chick')) {
           z.removeClass('chick');  
        }else{
            z.addClass('chick');
        }
    })

})