$(function(){

	$(".edit").click(function(){
		$('.warning_box').show();
		$('.disk').show();
	})
	
	$(".know").click(function(){
		$('.warning_box').hide();
		$('.disk').hide();
	})

	$('.del').click(function(){
		$(".warning").show();
		$(".disk").show();
	})

	$(".cancel").click(function(){
		$('.warning').hide();
		$('.disk').hide();
	})
})