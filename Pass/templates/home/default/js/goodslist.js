$(function(){
	$(".filter span.left").hover(function(){
		var $this=$(this);
		$this.find("ul").show();
	},function(){
		var $this=$(this);
		$this.find("ul").hide();
	})

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

  //回车提交
  $(".filter input").keyup(function (e) {
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
	$("#totalCount").html(totalCount);
	if(totalPage > 1){
		$(".filter .right").show();
		$(".filter .right .pre").addClass("prevStop");
		$(".filter .right .next").addClass("nextStop");
		if(atPage == 1){
			$(".filter .right .pre").removeClass("prevStop");
		}else{
			$(".filter .right .pre").attr("href", pageUrl.replace("pagePlaceholder", atPage - 1));
		}
		if(atPage == totalPage){
			$(".filter .right .next").removeClass("nextStop");
		}else{
			$(".filter .right .next").attr("href", pageUrl.replace("pagePlaceholder", atPage + 1));
		}
	}



})
