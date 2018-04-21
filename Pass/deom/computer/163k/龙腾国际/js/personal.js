$(function(){
	 $('.closek').click(function() {
	    $('.fuke').hide();
	    $('.hide').show();
	  });
	  $('.hide').click(function() {
	    $('.fuke').show();
	    $('.hide').hide();
	  });
	  $('.c_1 a').click(function() {
	    $('#reception').hide();
	  });
	  $('.c_2 a').click(function() {
	    $('#zhongyaotongzhi').hide();
	  });
	$('.input_sft, .input_sft_r').click(function(){
		if ($('#alertshowbgdiv').css("display")=='none') {
			$('#alertshowbgdiv').hide();
		}{
			$('#alertshowbgdiv').show();
		};
	})
	$('.tanchuang_close').click(function(){
		$('#alertshowbgdiv').hide();
	})
	$('.input_shanchu').click(function(){
		$('.input_shanchu').closest('tr').hide();
	})
})