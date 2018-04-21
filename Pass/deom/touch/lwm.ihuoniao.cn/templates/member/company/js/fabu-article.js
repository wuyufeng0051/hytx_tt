$(function(){

	getEditor("body");

	//选择分类
	$("#selType").delegate("a", "click", function(){
		if($(this).text() != "不限" && $(this).attr("data-id") != $("#addr").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildType(id);
		}
	});

	//获取子级分类
	function getChildType(id){
		if(!id) return;
		$.ajax({
			url: "/include/ajax.php?service=article&action=type&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button class="sel">不限<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					html.push('<li><a href="javascript:;" data-id="'+id+'">不限</a></li>');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#typeid").before(html.join(""));

				}
			}
		});
	}


	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t           = $(this),
				title       = $("#title"),
				typeid      = $("#typeid").val(),
				writer      = $("#writer"),
				source      = $("#source"),
				sourceurl   = $("#sourceurl"),
				vdimgck     = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//验证标题
		var exp = new RegExp("^" + titleRegex + "$", "img");
		if(!exp.test(title.val())){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+titleErrTip);
			offsetTop = title.offset().top;
		}

		//验证分类
		if(typeid == "" || typeid == 0){
			var dl = $("#typeid").closest("dl");
			dl.find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+dl.find(".sel-group:eq(0)").attr("data-title"));
			offsetTop = offsetTop == 0 ? dl.offset().top : offsetTop;
		}

		ue.sync();

		if(!ue.hasContents() && offsetTop == 0){
			$.dialog.alert("请输入投稿内容！");
			offsetTop = offsetTop == 0 ? $("#body").offset().top : offsetTop;
		}

		//验证作者
		var exp = new RegExp("^" + writerRegex + "$", "img");
		if(!exp.test(writer.val())){
			writer.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+writerErrTip);
			offsetTop = offsetTop == 0 ? writer.offset().top : offsetTop;
		}

		//验证来源
		var exp = new RegExp("^" + sourceRegex + "$", "img");
		if(!exp.test(source.val())){
			source.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>"+sourceErrTip);
			offsetTop = offsetTop == 0 ? source.offset().top : offsetTop;
		}

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.offset().top : offsetTop;
		}

		if(offsetTop){
			$('.main').animate({scrollTop: offsetTop - 5}, 300);
			return false;
		}

		var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url");
		data = form.serialize();

		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					var tip = "发布成功";
					if(id != undefined && id != "" && id != 0){
						tip = "修改成功";
					}
					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: tip,
						ok: function(){
							location.href = url;
						}
					});
				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html("立即投稿");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("立即投稿");
				$("#verifycode").click();
			}
		});


	});
});
