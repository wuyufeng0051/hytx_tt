/**
 * 会员中心交友上传照片
 * by guozi at: 20160612
 */

$(function(){


  //保存
  $("#submit").bind("click", function(){

    var t = $(this);

    if(t.hasClass("disabled")) return false;

    var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}


		var imgval = $("#imglist").val();
		var imgArr = imgval.split(",")
    var imglist = [];
		var imgli = $('#listSection2 li');
		for(var i = 0; i < imgArr.length; i++){
			imglist.push("img[]="+imgArr[i]);
		}

    if(imgli.length == 0){
      $.dialog.alert('请添加图片！');
      return false;
    }

    t.addClass("disabled").val("保存中...");

    $.ajax({
			url: masterDomain + "/include/ajax.php?service=dating&action=uploadAlbum",
			data: imglist.join("&"),
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
          $.dialog.tips('保存成功！', 3, 'success.png');
          setTimeout(function(){
            location.href = url;
          }, 3000);
				}else{
					$.dialog.alert('保存失败！');
					t.removeClass("disabled").html("保存");
				}
			},
			error: function(){
        $.dialog.alert('网络错误，请重试！');
        t.removeClass("disabled").html("保存");
			}
		});

  });

});
