$(function(){
	//左右分页
	$("#totalPage").html(totalPage);
	if(totalPage > 1){
		$(".right").show();
		$(".right .pre").addClass("prevStop");
		$(".right .next").addClass("nextStop");
		if(atPage == 1){
			$(".right .pre").removeClass("prevStop");
		}else{
			$(".right .pre").attr("href", pageUrl.replace("%page%", atPage - 1));
		}
		if(atPage == totalPage){
			$(".right .next").removeClass("nextStop");
		}else{
			$(".right .next").attr("href", pageUrl.replace("%page%", atPage + 1));
		}
	}

})
