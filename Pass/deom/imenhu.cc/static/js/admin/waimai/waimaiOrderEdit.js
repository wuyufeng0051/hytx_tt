$(function () {
	
	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" ); 
		thisUPage = tmpUPage[ tmpUPage.length-1 ]; 
		thisPath  = thisURL.split(thisUPage)[0];

	
	//删除订单商品
	$(".table").delegate(".del", "click", function(){
		if($(".table").find("tbody tr").length == 2){
			$.dialog.alert("至少保留一个菜单！");
			return false;
		}
		var parent = $(this).parent().parent(), menuid = parent.attr("data-id");
		$.dialog.confirm('您确定要删除吗？', function(){
			if(id != "" && menuid != ""){
				huoniao.operaJson("waimaiOrder.php?dopost=delMenu", "id="+id+"&menuid="+menuid);
			}
			parent.remove();
			var price = 0;
			$(".table").find("tbody tr").each(function(index, element) {
				var p = $(this).find("td:eq(4)").text();
				if(p != ""){
					price = price + Number(p.replace("¥", ""));
				};
			});
			$("#tPrice").html(price.toFixed(2));
			$("#aPrice").html((price+peisong).toFixed(2));
			if($(".table").find("tbody tr").length == 1){
				$(".table").find("tbody tr").hide();
			}
		});
	});


	//提交表单
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t = $(this), fv = [], orderinfo = [], tr = $(".table tbody").find("tr");

		fv.push("id="+id);
		tr.each(function(index, element) {
            if(index == tr.length - 1){
				return false;
			}
			var $this = $(this), 
				id = $this.attr("data-id"), 
				price = $this.find("td:eq(2)").text().replace("&yen;", "").replace("¥", ""), 
				count = $this.find("td:eq(3) input").val();
				
				if(!/^0|[1-9]\d*$/.test(count)){
					$.dialog.alert("数量必须为0或正整数！");
					return false;
				}
				
			orderinfo.push(id+","+price+","+count);
        });

		t.attr("disabled", true);
		$.ajax({
			type: "POST",
			url: "waimaiOrder.php",
			data: $(this).parents("form").serialize()+"&orderinfo="+orderinfo.join("#")+"&submit=" + encodeURI("提交"),
			dataType: "json",
			success: function(data){
				if(data.state == 100){
					$.dialog({
						fixed: true,
						title: "修改成功",
						icon: 'success.png',
						content: "修改成功！",
						ok: function(){
							huoniao.goTop();
							location.reload();
						},
						cancel: false
					});
				}else{
					$.dialog.alert(data.info);
					t.attr("disabled", false);
				};
			},
			error: function(msg){
				$.dialog.alert(msg.status+":"+msg.statusText);
				t.attr("disabled", false);
			}
		});
	});
	
});