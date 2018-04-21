$(function(){

	//产品列表
	$(".list li").each(function(){
		var con = $(this).find(".con");
		if(con.find("ul").length > 1){
			con.cycle({
				pause: true,
				timeout: 0,
		    next: $(this).find(".next")
			});
			$(this).find(".right span").show();
		}
	});

	//左右分页
	$("#totalPage").html(totalPage);
	if(totalPage > 1){
		$(".right").show();
		$(".sort .prev").addClass("prevStop");
		$(".sort .next").addClass("nextStop");
		if(atPage == 1){
			$(".sort .prev").removeClass("prevStop");
		}else{
			$(".sort .prev").attr("href", pageUrl.replace("%page%", atPage - 1));
		}
		if(atPage == totalPage){
			$(".sort .next").removeClass("nextStop");
		}else{
			$(".sort .next").attr("href", pageUrl.replace("%page%", atPage + 1));
		}
	}

})
