$(function(){
	  var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        paginationClickable: true,
        spaceBetween: 30,
    });
	  $('.jia_hao a').click(function(){
	  	var op = $('.op');
	  	var public = $('.public');
	  	if(op.css('display')=='none' , public.css('display')=='none'){
	  		$('.op').show();
	  		$('.public').show();
	  	}
	  	else{
	  		$('.op').hide();
	  		$('.public').hide();
	  	}
	  })
})