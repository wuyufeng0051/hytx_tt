$(function(){

	$("#submit").bind("click", function(){

	    var t = $(this);

	    if(t.hasClass("disabled")) return false;

	    var userid = $.cookie(cookiePre+"login_user");
			if(userid == null || userid == ""){
				location.href = "/login.html";
				return false;
			}

	    var imglist = [], imgli = $("#fileList li");
			if(imgli.length > 1){
				for(var i = 1; i < imgli.length; i++){
					var imgsrc = $("#fileList li:eq("+i+")").find("img").attr("data-val"), imgdes = '';
					imglist.push("img[]="+imgsrc+"|"+imgdes);
				}
			}

	    if(imglist.length == 0){
	    	alert('请添加图片！');
	    	return false;
	    }

	    t.addClass("disabled").val("保存中...");

	    $.ajax({
				url: "/include/ajax.php?service=dating&action=uploadAlbum",
				data: imglist.join("&"),
				type: "POST",
				dataType: "json",
				success: function (data) {
					if(data && data.state == 100){
	          			t.html('保存成功！');
						setTimeout(function(){
							location.href = url;
						}, 1000);
					}else{
						alert('保存失败！');
						t.removeClass("disabled").html("保存");
					}
				},
				error: function(){
	        		alert('网络错误，请重试！');
	        		t.removeClass("disabled").html("保存");
				}
			});

	});


})