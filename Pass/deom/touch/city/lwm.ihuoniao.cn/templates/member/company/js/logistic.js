$(function(){

  //删除
	$(".list").delegate(".del", "click", function(){
		var t = $(this), par = t.closest("tr"), id = par.data("id");
		if(id){
			$.dialog.confirm('你确定要删除这条运费模板吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service="+module+"&action=delLogistic&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state != 200){

							location.reload();

						}else{
							$.dialog.alert("删除失败，请稍候重试！");
							t.siblings("a").show();
							t.removeClass("load");
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
						t.siblings("a").show();
						t.removeClass("load");
					}
				});
			});
		}
	});

});
