$(function(){
	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('.choice').css('top', 'calc(1.78rem + 20px)');
	}

	// 图片延迟加载
	$("img").scrollLoading();

	// 选装修阶段
	$('.stra_ll p a').click(function(){
	    var t = $(this), choice = $('.choice'), dom = choice.hasClass('show');
			if (!dom) {
				$('.choice').addClass('show').animate({"left":"22%"},200);
		    $('.disk').show();
		    $('body').addClass('by')
			}else {
				$('.choice').removeClass('show').animate({"left":"100%"},200);
		    $('.disk').hide();
		    $('body').removeClass('by');
			}

	})
	$('.disk').click(function(){
	    $('.choice').removeClass('show').animate({"left":"100%"},200);
	    $('.disk').hide();
	    $('body').removeClass('by');
	})
	$('.ch_list h1').click(function(){
			var x = $(this),
			parent = x.closest('.ch_list'),
			 	box = parent.find('ul');
			if (box.css("display")=="none") {
				parent.addClass('curr').siblings().removeClass('curr');
				$('.ch_list h1').removeClass('arrow');
				x.addClass('arrow');
			}else{
				parent.removeClass('curr');
				x.removeClass('arrow');
			}

	})

	$(".ch_list li").each(function(){
    var t = $(this);
    if(t.hasClass("curr")){
			var box = t.closest("ul"), parent = box.closest('.ch_list');
			parent.addClass('curr');
      box.show();
      box.prev("h1").addClass("arrow");
    }
  });




})
