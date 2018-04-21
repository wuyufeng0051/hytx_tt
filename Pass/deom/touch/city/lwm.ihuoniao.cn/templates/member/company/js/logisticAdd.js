$(function(){

  $(".bearFreight span").bind("click", function(){
		var val = $(this).data("id");
		if(val == 1){
			$("#freight").hide();
		}else{
			$("#freight").show();
		}
	});

	$(".valuation span").bind("click", function(){
		var val = $(this).data("id"), i = $("#freight i");
		if(val == 0){
			i.html("件");
		}else if(val == 1){
			i.html("kg");
		}else if(val == 2){
			i.html("m³");
		}
	});

	//提交发布
	$("#submit").bind("click", function(event){
		event.preventDefault();
		var t = $(this);
		if(t.hasClass("disabled")) return;
		var form = $("#fabuForm"), action = form.attr("action"), data = form.serialize();
		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var tip = "提交成功！";
					if(id != undefined && id != "" && id != 0){
						tip = "修改成功！";
					}
					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: tip,
						ok: function(){
							location.href = manageUrl;
						}
					});
				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html("确认提交");
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("确认提交");
			}
		});

	});




});
