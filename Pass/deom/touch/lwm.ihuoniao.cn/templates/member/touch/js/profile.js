$(function(){

	if(typeidLevel != ''){
		var typeArr = typeidLevel.split('>'), typeLen = typeArr.length;
	    var typeCon = $(".sel-group");
	    typeCon.html('');
	    getChildType('0',true,0);
	}

	//选择区域
	$(".sel-group").delegate('select','change',function(){
	    var t = $(this), id = t.val();
	    t.nextAll("select").remove();
	    if(id != '' && id != 0){
	    	getChildType(id);
	    }
	});

  //获取子级分类
	function getChildType(id,getLeave,no){
		if(id == undefined || id == '') return;
    	var sid = 0;
		$.ajax({
			url: masterDomain + "/include/ajax.php?service=siteConfig&action=addr&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<select>');
					html.push('<option value="0">请选择</option>');
					for(var i = 0; i < list.length; i++){
			            var selected = '';
			            var sname = list[i].typename;
			            if(getLeave){
			              if($.trim(typeArr[no]) != '' && $.trim(typeArr[no]) == sname){
			                selected = ' selected="selected"';
			                sid = list[i].id;
			              }
			            }
						html.push('<option value="'+list[i].id+'"'+selected+'>'+sname+'</option>');
					}
					html.push('</select>');

					$(".sel-group").append(html.join(""));
					if(getLeave && (no) < typeLen){
						getChildType(sid,true,++no);
					}
				}
			}
		});
	}


    //提交
	$("#submit").bind("click", function(event){
		event.preventDefault();

		$('#selAddr select').each(function(){
			var id = $(this).val();
			if(id != 0){
				$('#addr').val(id);
			}
		});

		var t = $(this), form = $("#fabuForm"), serialize = form.serialize(), action = form.attr("action");
		if(t.hasClass('disabled')) return;

		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: action,
			data: serialize,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					t.removeClass("disabled").html("修改成功！");
					setTimeout(function(){
						t.html("提交修改");
					}, 2000);
				}else{
					alert(data.info);
					t.removeClass("disabled").html("提交修改");
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.removeClass("disabled").html("提交修改");
			}
		});

	});

})
