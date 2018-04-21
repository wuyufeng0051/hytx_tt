$(function(){

	//收货
	$(".sh").bind("click", function(){
		var t = $(this);
		if(t.attr("disabled") == "disabled") return;

		if(confirm("确定要收货吗？")){
			t.html("提交中...").attr("disabled", true);
			
			$.ajax({
				url: "/include/ajax.php?service=tuan&action=receipt",
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