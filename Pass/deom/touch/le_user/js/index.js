$(function(){

	var mySwiper = new Swiper('.slideBox',{pagination : '.swiper-pagination',})


	$('.newsbox .tab li').click(function(){
		var t = $(this), index = t.index(), ul = $('.newsbox .list ul');
		t.addClass('curr').siblings('li').removeClass('curr');
		ul.hide().eq(index).show();
	})




})