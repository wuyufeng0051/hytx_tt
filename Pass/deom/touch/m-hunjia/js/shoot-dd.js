$(function(){
	$('.more').click(function(){
		var dom = $('.xiang-list')
		    if (dom.hasClass('nic')) {
            $('.xiang-list').removeClass('nic');
        }else{
            $('.xiang-list').addClass('nic');
        }
    })
    $('.more').click(function(){
		var dom = $('.more')
		    if (dom.hasClass('nn')) {
            $('.more').removeClass('nn');
        }else{
            $('.more').addClass('nn');
        }
    })
})