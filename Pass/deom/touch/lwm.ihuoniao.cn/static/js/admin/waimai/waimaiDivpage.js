$(function(){

    $(".chzn-select").chosen();

    var adBody = $("#adBody").html();
    if(adBody != "" && adBody != undefined){
        $(".list-holder input").val(adBody);
        imgArray = adBody.split(",");
		var picList = [];
		for(var i = 0; i < imgArray.length; i++){
			var imgItem = imgArray[i].split("##");
			picList.push('<li class="pubitem clearfix" id="SWFUpload_1_0'+i+'">');
			picList.push('  <a class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</a>');
			picList.push('  <a class="li-rm" href="javascript:;">×</a>');
			picList.push('  <div class="li-thumb" style="display:block;">');
			picList.push('    <div class="r-progress"><s></s></div>');
			picList.push('    <img data-val="'+imgItem[0]+'" src="'+cfg_attachment+imgItem[0]+'" data-url="'+cfg_attachment+imgItem[0]+'" />');
			picList.push('  </div>');
			picList.push('  <div class="li-input" style="display:block;"><input class="i-name" placeholder="请输入图片名称" value="'+imgItem[1]+'" /><input class="i-link" placeholder="请输入图片链接" value="'+imgItem[2]+'" /><input class="i-desc" placeholder="请输入图片介绍" value="'+imgItem[3]+'" /></div>');
			picList.push('</li>');
		}
		$("#listSection").html(picList.join(""));
		$(".deleteAllAtlas").show();
    }

    //提交
    $(".tjbtn").bind("click", function(){
        var t = $(this), parent = t.closest(".page-item"), data = parent.find("input, select, textarea").serialize();

        data += "&type="+type;

        t.attr("disabled", true);

        $.ajax({
            url: "waimaiDivpage.php",
            type: "post",
            data: data,
            dataType: "json",
            success: function(res){
                if(res.state != 100){
                    $.dialog.alert(res.info);
                    t.attr("disabled", false);
                }else{
                    location.reload();
                }
            },
            error: function(){
                $.dialog.alert("网络错误，保存失败！");
                t.attr("disabled", false);
            }
        })


    });

});
