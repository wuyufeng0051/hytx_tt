$(function(){

	//新增密码框
	var newPasswdHtml = '<dl class="fn-clear" data-required="1"><dt><span>*</span>密码：</dt><dd><input type="text" name="passwd[]" class="inp" maxlength="14" data-title="请输入12位团购券密码" /><a href="javascript:;" class="clear" title="清空"><s></s></a><span class="tip-inline"></span></dd></dl>';
	$("#addPasswd").bind("click", function(){
		var t = $(this).closest("dl");
		t.before(newPasswdHtml);
		$('#fabuForm input').inputFormat('account');
	});

	//自动分组
	$("#fabuForm input").inputFormat('account');

	//验证
	$("#fabuForm").delegate("input", "blur", function(){
		var t = $(this), val = t.val().replace(/\s+/g, ""), dl = t.closest("dl"), hline = t.siblings(".tip-inline"), cbtn = t.siblings(".clear");
		if(!isNaN(val) && val != "" && val.length == 12){
			t.attr("disabled", true);
			cbtn.hide();
			hline.removeClass().addClass("tip-inline loading").html("<s></s>验证中...");

			$.ajax({
				url: verify,
				type: "POST",
				data: "code="+val,
				dataType: "json",
				success: function (data) {
					cbtn.show();					
					if(data && data.state == 100){
						hline.removeClass().addClass("tip-inline success").html("<s></s>"+data.info);
					}else{
						hline.removeClass().addClass("tip-inline error").html("<s></s>"+data.info);
						t.attr("disabled", false);
					}
				},
				error: function(){
					cbtn.show();
					t.attr("disabled", false);
					hline.removeClass().addClass("tip-inline error").html("<s></s>网络错误，请稍候重试！");
				}
			});

			return false;
		}else if(val != ""){
			cbtn.show();
			hline.removeClass().addClass("tip-inline error").html("<s></s>团购券密码由12位数字组成！");

			return false;
		}
		
	});

	//清空
	$("#fabuForm").delegate(".clear", "click", function(){
		var input = $(this).siblings("input");
		if(input.attr("disabled") != true){
			input.attr("disabled", false).val("").focus();
			$(this).hide();
		}
	});

	//提交消费
	$("#submit").bind("click", function(event){
		event.preventDefault();
		var t = $(this), codes = [];
		$("#fabuForm input").each(function(){
			var val = $(this).val().replace(/\s+/g, "");
			if(!isNaN(val) && val != "" && val.length == 12){
				codes.push(val);
			}
		});
		if(codes.length > 0){
			
			t.attr("disabled", true).html("提交中...");
			$.ajax({
				url: action,
				type: "POST",
				data: "codes="+codes,
				dataType: "json",
				success: function (data) {
					
					if(data && data.state == 100){
						$.dialog({
							fixed: true,
							title: "操作成功",
							icon: 'success.png',
							content: data.info,
							ok: function(){
								location.reload();
							},
							cancel: false
						});
					}else{
						$.dialog.alert(data.info);
						t.attr("disabled", false).html("消费");
					}
					
				},
				error: function(){
					t.attr("disabled", false).html("消费");
					$.dialog.alert("网络错误，请稍候重试！");
				}
			});

		}else{
			$.dialog.alert("请输入要消费的团购券密码！");
		}
	});

});