$(function(){
	$('#star').raty({"starOff":tpldir+"images/star-off.png","starOn":tpldir+"images/star-on.png","score":star});
	$('#starps').raty({"starOff":tpldir+"images/star-off.png","starOn":tpldir+"images/star-on.png","scoreName":"scoreps","score":starps});

	// 匿名
	$(".rank_lead li").click(function(){
		$(this).addClass("rank_bc").siblings().removeClass("rank_bc");
	})

	// 提交
	$(".submitBtn").click(function(){
		var btn = $(this);
		if(btn.hasClass("disabled")) return;

		var isanony = $(".rank_lead .rank_bc").index(),
			star = $("input[name=score]").val(),
			commonid = $("#commonid").val(),
			content = $.trim($("#content").val()),
			content = $.trim($("#content").val()),
			starps = $("input[name=scoreps]").val(),
			contentps = $.trim($("#contentps").val());

		if(star == ""){
			alert("请给店铺打分");
			return;
		}
		if(starps == ""){
			alert("请给配送员打分");
			return;
		}

		var imglist = [], imgli = $("#fileList li.thumbnail");

	    imgli.each(function(index){
	        var t = $(this), val = t.find("img").attr("data-val");
	        if(val != ''){
	          	imglist.push(val);
        	}
	    })

		btn.addClass("disabeld").text("正在提交");

		var data = [];
		data.push('id='+id);
		data.push('star='+star);
		data.push('commonid='+commonid);
		data.push('isanony='+isanony);
		data.push('content='+content);
		data.push('starps='+starps);
		data.push('contentps='+contentps);
		data.push('pics='+imglist.join(","));
		$.ajax({
			url: masterDomain + '/include/ajax.php?service=waimai&action=sendCommon',
			type: 'get',
			data: data.join("&"),
			dataType: 'jsonp',
			success: function(data){
				btn.removeClass("disabeld");
				if(data && data.state == 100){
					btn.removeClass("disabeld").text("提交成功");
					setTimeout(function(){
						location.href = returnUrl;
					},500)
				}else{
					btn.removeClass("disabeld").text("提交");
					alert(data.info);
				}
			},
			error: function(){
				btn.removeClass("disabeld").text("正在提交");
				alert("网络错误，提交失败！");
			}
		})

	})
})