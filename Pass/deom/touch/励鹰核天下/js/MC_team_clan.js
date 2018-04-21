$(function(){
	$('.lists ul li').click(function(){
		if ($('#alertshowmsgdiv').css('display') == 'none') {
			$('#alertshowmsgdiv').show();
		}else{
			$('#alertshowmsgdiv').hide();
		};
	})
	$('.ajaxview_close').click(function(){
		$('#alertshowmsgdiv').hide();
	})
})