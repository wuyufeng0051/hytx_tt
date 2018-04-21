$(function(){

  //选择标签
	$("#selTags").bind("click", function(){
		var input = $(this).siblings("input"), valArr = input.val().split(",");

    $.ajax({
      url: masterDomain+"/include/ajax.php?service=dating&action=tags",
      dataType: "JSONP",
      success: function(data){
        if(data && data.state == 100){
          data = data.info;
  				var content = [], selected = [];
  				content.push('<div class="selectedTags">已选：</div>');
  				content.push('<ul class="nav nav-tabs fn-clear">');
  				for(var i = 0; i < data.length; i++){
  					content.push('<li'+ (i == 0 ? ' class="active"' : "") +'><a href="#tab'+i+'">'+data[i].typename+'</a></li>');
  				}
  				content.push('</ul><div class="tagsList">');
  				for(var i = 0; i < data.length; i++){
  					content.push('<div class="tag-list'+(i == 0 ? "" : " fn-hide")+'" id="tab'+i+'">')
  					for(var l = 0; l < data[i].lower.length; l++){
  						var id = data[i].lower[l].id, name = data[i].lower[l].typename;
  						if($.inArray(id, valArr) > -1){
  							selected.push('<span data-id="'+id+'">'+name+'<a href="javascript:;">&times;</a></span>');
  						}
  						content.push('<span'+($.inArray(id, valArr) > -1 ? " class='checked'" : "")+' data-id="'+id+'">'+name+'<a href="javascript:;">+</a></span>');
  					}
  					content.push('</div>');
  				}
  				content.push('</div>');

  				$.dialog({
  					id: "memberInfo",
  					fixed: true,
  					title: "选择标签",
  					content: '<div class="selectTags">'+content.join("")+'</div>',
  					width: 600,
  					okVal: "确定",
  					ok: function(){

  						//确定选择结果
  						var html = parent.$(".selectedTags").html().replace("已选：", ""), ids = [];
  						parent.$(".selectedTags").find("span").each(function(){
  							var id = $(this).attr("data-id");
  							if(id){
  								ids.push(id);
  							}
  						});
  						input.val(ids.join(","));
  						input.siblings(".selectedTag").html(html);

  					},
  					cancelVal: "关闭",
  					cancel: true
  				});

  				var selectedObj = parent.$(".selectedTags");
  				//填充已选
  				selectedObj.append(selected.join(""));

  				//TAB切换
  				parent.$('.nav-tabs a').click(function (e) {
  					e.preventDefault();
  					var obj = $(this).attr("href").replace("#", "");
  					if(!$(this).parent().hasClass("active")){
  						$(this).parent().siblings("li").removeClass("active");
  						$(this).parent().addClass("active");

  						$(this).parent().parent().next(".tagsList").find("div").hide();
  						parent.$("#"+obj).show();
  					}
  				});

  				//选择标签
  				parent.$(".tag-list span").click(function(){
  					if(!$(this).hasClass("checked")){
  						var length = selectedObj.find("span").length;
  						if(length >= tagsLength){
  							alert("交友标签最多可选择 "+tagsLength+" 个！");
  							return false;
  						}

  						var id = $(this).attr("data-id"), name = $(this).text().replace("+", "");
  						$(this).addClass("checked");
  						selectedObj.append('<span data-id="'+id+'">'+name+'<a href="javascript:;">&times;</a></span>');
  					}
  				});

  				//取消已选
  				selectedObj.delegate("a", "click", function(){
  					var pp = $(this).parent(), id = pp.attr("data-id");

  					parent.$(".tagsList").find("span").each(function(index, element) {
              if($(this).attr("data-id") == id){
  							$(this).removeClass("checked");
  						}
            });

  					pp.remove();
  				});

  			}
      }
    })
	});

	//删除已选择的标签/技能（非浮窗）
	$(".selectedTags").delegate("span a", "click", function(){
		var pp = $(this).parent(), id = pp.attr("data-id"), input = pp.parent().siblings("input");
		pp.remove();

		var val = input.val().split(",");
		val.splice($.inArray(id,val),1);
		input.val(val.join(","));
	});





  //选择区域
	$("#selAddr, #selAddr1").delegate("a", "click", function(){
		if($(this).text() != "不限" && $(this).attr("data-id") != $(this).closest("dd").find("input").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id, $(this).closest("dd"));
		}
	});

	//获取子级区域
	function getChildAddr(id, obj){
		if(!id) return;
		$.ajax({
			url: "/include/ajax.php?service=job&action=addr&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button type="button" class="sel">不限<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					html.push('<li><a href="javascript:;" data-id="'+id+'">不限</a></li>');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					obj.find("input").before(html.join(""));

				}
			}
		});
	}

  //标注地图
	$("#mark").bind("click", function(){
		$.dialog({
			id: "markDitu",
			title: "标注地图位置<small>（请点击/拖动图标到正确的位置，再点击底部确定按钮。）</small>",
			content: 'url:'+adminPath+'../api/map/mark.php?mod=dating&lnglat='+$("#lnglat").val()+"&city="+mapCity,
			width: 800,
			height: 500,
			max: true,
			ok: function(){
				var doc = $(window.parent.frames["markDitu"].document),
					lng = doc.find("#lng").val(),
					lat = doc.find("#lat").val();
				$("#lnglat").val(lng+","+lat);
			},
			cancel: true
		});
	});

	//提交
	$("#submit").bind("click", function(event){
		event.preventDefault();

		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}

		var t = $(this);

		if(t.hasClass("disabled")) return false;
		t.addClass("disabled").html("保存中...");

		var url = t.closest("form").attr("action"), data = t.closest("form").serialize();

		$.ajax({
			url: url,
			data: data,
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				t.removeClass("disabled").html("保存资料");
				if(data.state == 100){
					$.dialog.tips('保存成功！', 3, 'success.png');
				}else{
					$.dialog.tips(data.info, 3, 'error.png');
				}
			},
			error: function(){
				t.removeClass("disabled").html("保存资料");
				$.dialog.tips('网络错误，保存失败！', 3, 'error.png');
			}
		});

  });


});
