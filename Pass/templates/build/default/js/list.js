$(function(){


  //搜索
  $("#search").bind("click", function(){

    var price1 = $.trim($("#price1").val()), price2 = $.trim($("#price2").val());
    var price = [];
    if(price1 != "" || price2 != ""){
      if(price1 != ""){
        price.push(price1);
      }
      price.push(",");
      if(price2 != ""){
        price.push(price2);
      }
    }

    location.href = priceUrl.replace("pricePlaceholder", price.join(""));

  });

	$(".jiage").hover(function(){
		$(this).find(".sub").show();
	}, function(){
		$(this).find(".sub").hide();
	});
	$(".cancel").bind("click", function(){
		$(".jiage .sub").hide();
	});

  //回车提交
  $(".jiage input").keyup(function (e) {
		if (!e) {
			var e = window.event;
		}
		if (e.keyCode) {
			code = e.keyCode;
		}
		else if (e.which) {
			code = e.which;
		}
		if (code === 13) {
			$("#search").click();
		}
	});


  //左右分页
	$("#totalPage").html(totalPage);
	if(totalPage > 1){
		$(".sort .right").show();
		$(".sort .right .prev").addClass("prevStop");
		$(".sort .right .next").addClass("nextStop");
		if(atPage == 1){
			$(".sort .right .prev").removeClass("prevStop");
		}else{
			$(".sort .right .prev").attr("href", pageUrl.replace("pagePlaceholder", atPage - 1));
		}
		if(atPage == totalPage){
			$(".sort .right .next").removeClass("nextStop");
		}else{
			$(".sort .right .next").attr("href", pageUrl.replace("pagePlaceholder", atPage + 1));
		}
	}


});
