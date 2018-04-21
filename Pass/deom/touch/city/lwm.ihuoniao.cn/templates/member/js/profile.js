$(function(){

	// $(".sidebar dl").each(function(index){
	// 	if(index > 0){
	// 		$(this).addClass("curr");
	// 		$(this).find("dd").hide();
	// 	}
	// });

	//选择区域
	$("#selAddr").delegate("a", "click", function(){
		if($(this).text() != "请选择" && $(this).attr("data-id") != $("#addr").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id);
		}
	});

	//获取子级区域
	function getChildAddr(id){
		if(!id) return;
		$.ajax({
			url: "/include/ajax.php?service=siteConfig&action=addr&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button class="sel">请选择<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					html.push('<li><a href="javascript:;" data-id="'+id+'">请选择</a></li>');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');	
					}
					html.push('</ul>');
					html.push('</div>');

					$("#addr").before(html.join(""));

				}
			}
		});
	}

	//出生日期
	$("#birthday").click(function(){
		WdatePicker({
			el: 'birthday',
			isShowClear: false,
			isShowOK: false,
			isShowToday: false,
			qsEnabled: false,
			maxDate: '%y-%M-%d',
			onpicking: function(dp){
				
			}
		});
	});

	//提交
	$("#submit").bind("click", function(event){
		event.preventDefault();

		var t = $(this), form = $("#fabuForm"), serialize = form.serialize(), action = form.attr("action");
		t.attr("disabled", true).html("提交中...");

		$.ajax({
			url: action,
			data: serialize,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					t.removeAttr("disabled").html("修改成功！");
					setTimeout(function(){
						t.html("提交修改");
					}, 2000);
				}else{
					$.dialog.alert(data.info);
					t.removeAttr("disabled").html("提交修改");
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeAttr("disabled").html("提交修改");
			}
		});

	});
	
});

