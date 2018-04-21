$(function(){

  // 新增密码框
  var newPasswdHtml = '<div class="inptitbox"><p>密码 <span class="tip-inline"></span></p><div class="inptitle"><input type="number" placeholder="请输入12位团购券密码" maxlength="12" name="title" value=""></div></div>';
  $(".addbtn").bind("click", function(){
		$('.pswbox').append(newPasswdHtml);
  });


  //验证
	$("#fabuForm").delegate("input", "blur", function(){
		var t = $(this), val = t.val().replace(/\s+/g, ""), dl = t.closest(".inptitbox"), hline = dl.find(".tip-inline");
		if(!isNaN(val) && val != "" && val.length == 12){
			hline.html("验证中...");

			$.ajax({
				url: verify,
				type: "POST",
				data: "code="+val,
				dataType: "json",
				success: function (data) {
					if(data && data.state == 100){
						hline.removeClass().addClass("tip-inline success").html(data.info);
					}else{
						hline.removeClass().addClass("tip-inline error").html(data.info);
					}
				},
				error: function(){
					hline.removeClass().addClass("tip-inline error").html("网络错误，请稍候重试！");
				}
			});

			return false;
		}else if(val != ""){
			hline.removeClass().addClass("tip-inline error").html("团购券密码由12位数字组成！");
			return false;
		}

	});


  //提交消费
	$("#tj").bind("click", function(event){
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
            alert(data.info);
						location.reload();
					}else{
						showMsg(data.info);
						t.attr("disabled", false).html("消费");
					}

				},
				error: function(){
					t.attr("disabled", false).html("消费");
					showMsg("网络错误，请稍候重试！");
				}
			});

		}else{
			showMsg("请输入要消费的团购券密码！");
		}
	});


})

// 错误提示
function showMsg(str){
  var o = $(".fixerror");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}
