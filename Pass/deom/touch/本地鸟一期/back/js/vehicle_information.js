$(function(){

	// 联系方式弹出层
// 联系方式弹出层
    $('.mer_detail .tel').click(function(){
        var x = $(this),
            phone = x.closest('.mer_detail').data('phone');
        var tel = "tel:"+phone;
        $('.phone ul li a').attr('href',tel);
        $('.phone ul li a em').text(phone);
        $('.phone').show();
        $('.disk').show();
    })
	$('.close').click(function(){
		$('.phone').hide();
		$('.disk').hide();
	})

})