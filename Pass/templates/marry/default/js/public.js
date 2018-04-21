$(function(){


	$("img").scrollLoading();

	$(".hsearch .stype label").bind("click", function(){
		$(this).next("ul").toggle();
		return false;
	});

	$(".hsearch .stype li").bind("click", function(){
		var t = $(this), id = t.attr("data-id"), val = t.text();
		t.closest(".stype").find("label")
			.attr("data-id", id)
			.html(val+"<s></s>");
		if(id == 1){
			t.closest(".stype").next(".input").find("label").html("<s></s>请输入酒店名或路名");
		}else{
			t.closest(".stype").next(".input").find("label").html("<s></s>请输入公司名或路名");
		}
	});

	//搜索
	$("#q").bind("input keyup", function(){
		$(this).prev("label").hide();
		if($(this).val() == ""){
			$(this).prev("label").show();
		}
	});

	$("#q").bind("blur", function(){
		if($(this).val() == ""){
			$(this).prev("label").show();
		}
	});

	$(document).click(function (e) {
		$(".hsearch .stype ul").hide();
	});


})
