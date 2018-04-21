$(function(){

  var init = {
		//树形递归分类
		treeTypeList: function(data){
			var typeList = [], cl = "";
			for(var i = 0; i < data.length; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower;
					typeList.push('<a href="javascript:;" data="'+jsonArray["id"]+'">'+cl+"|--"+jsonArray["typename"]+'</a>');
					if(jArray != undefined){
						for(var k = 0; k < jArray.length; k++){
							cl += '    ';
							if(jArray[k]['lower'] != ""){
								arguments.callee(jArray[k]);
							}else{
								typeList.push('<a href="javascript:;" data="'+jArray[k]["id"]+'">'+cl+"|--"+jArray[k]["typename"]+'</a>');
							}
							if(jsonArray["lower"] == null){
								cl = "";
							}else{
								cl = cl.replace("    ", "");
							}
						}
					}
				})(data[i]);
			}
			return typeList.join("");
		}
	}



  //发布房源子级菜单
  $(".main-tab .add").hover(function(){
    var t = $(this), dl = t.find("dl");
    if(dl.size() > 0){
      dl.show();
    };
  }, function(){
    var t = $(this), dl = t.find("dl");
    if(dl.size() > 0){
      dl.hide();
    };
  });

  //申请
  $("#reg").bind('click', function(){
    $("#fabuForm").show();
    $(".reg").hide();
  });

  //公司模糊搜索
	$("#company").bind("input", function(){
		$("#zjcom").val(0);
	});
	$("#company").autocomplete({
		source: function(request, response) {
			$.ajax({
				url: masterDomain+"/include/ajax.php?service=house&action=zjCom",
				dataType: "jsonp",
				data:{
					title: request.term
				},
				success: function(data) {
					if(data && data.state == 100){
						response($.map(data.info, function(item, index) {
							return {
								id: item.id,
								label: item.title
							}
						}));
					}else{
						response([])
					}
				}
			});
		},
		minLength: 1,
		select: function(event, ui) {
			$("#zjcom").val(ui.item.id);
		}
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li data-id='"+item.id+"'>")
			.append(item.label)
			.appendTo(ul);
	};

  //选择区域
	$("#selAddr").delegate("a", "click", function(){
		if($(this).text() != "不限" && $(this).attr("data-id") != $(this).closest("dd").find("input").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id);
		}
	});

  if($("#addr").val() != ""){
		var cid = 0;
		$("#selAddr .sel-menu li").each(function(){
			if($(this).text() == $("#addrname0").val()){
				cid = $(this).find("a").attr('data-id');
			}
		});
		if(cid != 0){
			getChildAddr(cid, $("#addrname1").val());
		}
	}

  //获取子级区域
	function getChildAddr(id, selected){
		if(!id) return;
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=house&action=addr&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button type="button" class="sel">'+(selected ? selected : "请选择")+'<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#addr").before(html.join(""));
					if(!selected){
						$("#addr").val(0);
						$("#addr").closest("dd").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择所在区域");
					}

				}
			}
		});
	}


  //选择小区
	$("#selTags").bind("click", function(){
    var input = $(this).siblings("input"), valArr = input.val().split(",");

		$.ajax({
			url: "/include/ajax.php?service=house&action=addr&son=1",
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data){

					var content = [], selected = [];

          //已选小区
          content.push('<div class="selectedTags"><label>已选：</label></div>');

					//选地区
					content.push('<div class="choose-item" id="selectAddr"><h2>选择区域：</h2><div class="choose-container fn-clear">');
					content.push('<div class="pinp_main"><div class="pinp_main_zm">'+init.treeTypeList(data.info)+'</div></div>');
					content.push('</div></div>');

					//选小区
					content.push('<div class="choose-item" id="selectCommunity" style="width:230px;"><h2>选择小区：<span id="tCount"></span></h2><div class="choose-container fn-clear">');
					content.push('<div class="pinp_main"><div class="pinp_main_zm"><center style="line-height:335px;">请先选择区域！</center></div></div>');
					content.push('</div></div>');

					$.dialog({
						id: "chooseData",
						fixed: false,
						title: "选择小区",
						content: '<div class="chooseData fn-clear">'+content.join("")+'</div>',
						width: 590,
						okVal: "确定",
						ok: function(){

              //确定选择结果
  						var html = parent.$(".selectedTags").html().replace("<label>已选：</label>", ""), ids = [];
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


          //填充已选
          var selectedObj = parent.$(".selectedTags");
          $(".selectedTag").find("span").each(function(){
            var t = $(this), id = t.attr("data-id"), name = t.attr("data-name");
            selected.push('<span data-id="'+id+'" data-name="'+name+'">'+name+'<a href="javascript:;">&times;</a></span>');
          });
  				selectedObj.append(selected.join(""));

					//选择地区
					parent.$("#selectAddr a").bind("click", function(){
						parent.$("#selectAddr a").removeClass("cur");
						$(this).addClass("cur");
						getCommunity();
					});

					//获取小区
					function getCommunity(){
						var addr = parent.$("#selectAddr .cur").attr("data");
						addr = addr != undefined ? addr : 0;
						parent.$("#selectCommunity .pinp_main_zm").html('<center style="line-height:335px;">搜索中...</center>');

						$.ajax({
							url: "/include/ajax.php?service=house&action=communityList&addrid="+addr,
							type: "GET",
							dataType: "jsonp",
							success: function (data) {
								if(data && data.state == 100){
									var list = data.info.list, community = [];
									for (var i = 0; i < list.length; i++) {
										community.push('<a href="javascript:;" data-id="'+list[i].id+'" data-title="'+list[i].title+'" data-address="'+list[i].address+'" data-price="'+list[i].price+'" title="'+list[i].title+'"> '+(i+1)+'. '+list[i].title+'</a>');
									};
									parent.$("#selectCommunity .pinp_main_zm").html(community.join(""));
									parent.$("#tCount").html("<small>"+list.length+"个</small>");
								}else{
									parent.$("#selectCommunity .pinp_main_zm").html('<center style="line-height:335px;">没有相关小区！</center>');
									parent.$("#tCount").html("");
								}
							}
						});

					}

					//选择小区
					parent.$("#selectCommunity").delegate("a", "click", function(){
            var t = $(this), id = t.attr("data-id"), name = t.attr("data-title"), is = 1;
            t.addClass("cur");
            selectedObj.find("span").each(function(){
              var th = $(this), _id = th.attr("data-id");
              if(_id == id){
                is = 0;
              }
            });
            if(is){
  						selectedObj.append('<span data-id="'+id+'" data-name="'+name+'">'+name+'<a href="javascript:;">&times;</a></span>');
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
		});
	});


	//删除已选择的标签/技能（非浮窗）
	$(".selectedTag").delegate("span a", "click", function(){
		var pp = $(this).parent(), id = pp.attr("data-id"), input = pp.parent().siblings("input");
		pp.remove();

		var val = input.val().split(",");
		val.splice($.inArray(id,val),1);
		input.val(val.join(","));
	});



  //提交
  $("#submit").bind("click", function(event){
    event.preventDefault();

    var t       = $(this),
        company = $("#company").val(),
        zjcom   = $("#zjcom").val(),
        store   = $("#store").val(),
        addr    = $("#addr").val(),
        litpic  = $("#litpic").val();

    if(t.hasClass("disabled")) return false;

    if($.trim(company) == "" && zjcom == ""){
      $.dialog.tips("请输入所属公司！", 2, "error.png");
      return false;
    }

    if($.trim(store) == ""){
      $.dialog.tips("请输入所在门店！", 2, "error.png");
      return false;
    }

    if(addr == "" || addr == 0){
      $.dialog.tips("请选择服务区域！", 2, "error.png");
      return false;
    }

    if(litpic == ""){
      $.dialog.tips("请上传名片！", 2, "error.png");
      return false;
    }

    t.addClass("disabled").val("提交中...");

    var form = $("#fabuForm"), action = form.attr("action");

    $.ajax({
			url: action,
			data: form.serialize(),
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){

					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: data.info,
						ok: function(){
              location.reload();
            }
					});

				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html("重新提交");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("重新提交");
				$("#verifycode").click();
			}
		});

  });

});
