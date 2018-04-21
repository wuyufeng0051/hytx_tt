$(function(){

	//收货
	$(".sh").bind("click", function(){
		var t = $(this);
		if(t.attr("disabled") == "disabled") return;

		if(confirm("确定要收货吗？\r确定后费用将直接转至卖家账户，请谨慎操作！")){
			t.html("提交中...").attr("disabled", true);

			$.ajax({
				url: "/include/ajax.php?service=build&action=receipt",
				data: "id="+id,
				type: "POST",
				dataType: "json",
				success: function (data) {
					if(data && data.state == 100){
						location.reload();

					}else{
						alert(data.info);
						t.attr("disabled", false).html("确定收货");
					}
				},
				error: function(){
					$.dialog.alert("网络错误，请重试！");
					t.attr("disabled", false).html("确定收货");
				}
			});

		}

	});

});
