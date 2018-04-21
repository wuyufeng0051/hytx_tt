$(function(){
	$(".form-tab li").on("click",function(){
		var index = $(this).index();
		$(this).addClass("cur").siblings().removeClass("cur");
		$(".form-con>div").hide().eq(index).show();
		if(index == 0){
            $(".form-foot").hide();
        }else{
            $(".form-foot").show();
        }
		$(".form-error").hide();
	});

	$(".rem-check").each(function(){
		if(this.checked){
			$(this).parent().addClass("memCheck");
		}else{
			$(this).parent().removeClass("memCheck");
		}
	});
		$(".rem-check").each(function(){
		if(this.checked){
			$(this).parent().addClass("memCheck");
		}else{
			$(this).parent().removeClass("memCheck");
		}
	});
	$(".rem-box").on("click",function(){
		var val = $(this).children(".rem-check").attr("checked");
		if(val){
			$(this).children(".rem-check").attr("checked",false);
			$(this).removeClass("memCheck");
		}else{
			$(this).children(".rem-check").attr("checked",true);
			$(this).addClass("memCheck");
		}
	});


});



