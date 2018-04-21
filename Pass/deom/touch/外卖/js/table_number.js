$(function(){
	$('.write').click(function(){
		if ($('.sure_box ').css("display") == "none") {
			$('.sure_box ').show();
			$('.disk').show();
		}else{
			$('.sure_box ').hide();
			$('.disk').hide();
		}
	})
	$(".sure_btn").click(function(){
		$('.sure_box ').hide();
		$(".number").show();
	})
	$(".number span").click(function(){
		$(".number").hide();
		$('.fail_box ').show();
	})
	$(".rewrite_btn").click(function(){
		$('.fail_box ').hide();
		$(".number").show();
	})
	$(".cancel_btn").click(function(){
		$('.fail_box ').hide();
		$(".disk").hide();
	})
})