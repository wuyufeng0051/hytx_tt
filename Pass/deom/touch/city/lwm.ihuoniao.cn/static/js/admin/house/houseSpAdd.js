//实例化编辑器
var ue = UE.getEditor('note');
var mue = UE.getEditor('mbody', {"term": "mobile"});

var uploadCustom = {
	//旋转图集文件
	rotateAtlasPic: function(mod, direction, img, c) {
		var g = {
			mod: mod,
			type: "rotateAtlas",
			direction: direction,
			picpath: img,
			randoms: Math.random()
		};
		$.ajax({
			type: "POST",
			cache: false,
			async: false,
			url: "/include/upload.inc.php",
			dataType: "json",
			data: $.param(g),
			success: function(a) {
				try {
					c(a)
				} catch(b) {}
			}
		});
	}
}

$(function(){

	huoniao.parentHideTip();

	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	var init = {
		regex: function(obj){
			var regex = obj.attr("data-regex");
			if(regex != undefined){
				var exp = new RegExp("^" + regex + "$", "img");
				if(!exp.test($.trim(obj.val()))){
					return false;
				}else{
					return true;
				}
			}
		}

		//树形递归分类
		,treeTypeList: function(type){
			var typeList = [], cl = "";
			if(type == "addr"){
				var l = addrListArr, s = addrid;
				typeList.push('<option value="0">请选择</option>');
			}else{
				var l = industryArr, s = industry;
				typeList.push('<option value="0">请选择</option>');
			}
			for(var i = 0; i < l.length; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower, selected = "";
					if(s == jsonArray["id"]){
						selected = " selected";
					}
					typeList.push('<option value="'+jsonArray["id"]+'"'+selected+'>'+cl+"|--"+jsonArray["typename"]+'</option>');
					for(var k = 0; k < jArray.length; k++){
						cl += '    ';
						var selected = "";
						if(s == jArray[k]["id"]){
							selected = " selected";
						}
						if(jArray[k]['lower'] != ""){
							arguments.callee(jArray[k]);
						}else{
							typeList.push('<option value="'+jArray[k]["id"]+'"'+selected+'>'+cl+"|--"+jArray[k]["typename"]+'</option>');
						}
						if(jsonArray["lower"] == null){
							cl = "";
						}else{
							cl = cl.replace("    ", "");
						}
					}
				})(l[i]);
			}
			return typeList.join("");
		}
	};

	//平台切换
	$('.nav-tabs a').click(function (e) {
		e.preventDefault();
		var obj = $(this).attr("href").replace("#", "");
		if(!$(this).parent().hasClass("active")){
			$(".nav-tabs li").removeClass("active");
			$(this).parent().addClass("active");

			$(".nav-tabs").parent().find(">div").hide();
			cfg_term = obj;
			$("#"+obj).show();
		}
	})

	//填充行业
	$("#industry").html(init.treeTypeList("industry"));

	//填充区域
	$("#addrid").html(init.treeTypeList("addr"));

	//表单验证
	$("#editform").delegate("input,textarea", "focus", function(){
		var tip = $(this).siblings(".input-tips");
		if(tip.html() != undefined){
			tip.removeClass().addClass("input-tips input-focus").attr("style", "display:inline-block");
		}
	});

	$("#editform").delegate("input,textarea", "blur", function(){
		var obj = $(this);
		huoniao.regex(obj);
	});

	$("#editform").delegate("select", "change", function(){
		if($(this).parent().siblings(".input-tips").html() != undefined){
			if($(this).val() == 0){
				$(this).parent().siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			}else{
				$(this).parent().siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
			}
		}
	});

	//类别
	$("input[name=type]").bind("click", function(){
		var val = $(this).val();
		if(val == 0){
			$("#price").next(".add-on").html("元/月");
			$("#transferObj, #industryObj").hide();
		}else if(val == 1){
			$("#price").next(".add-on").html("万元");
			$("#transferObj, #industryObj").hide();
		}else{
			$("#price").next(".add-on").html("元/月");
			$("#transferObj, #industryObj").css("display", "inline-block");
		}
	});

	//房源性质选择
	$("input[name=usertype]").bind("click", function(){
		var val = $(this).val();
		if(val == 0){
			$("#userType0").show();
			$("#userType1").hide();
		}else{
			$("#userType1").show();
			$("#userType0").hide();
		}
	});

	//选择适合经营的行业
	$(".chooseSuitable").bind("click", function(){
		var input = $(this).prev("input"), valArr = input.val().split(",");
		huoniao.showTip("loading", "数据读取中，请稍候...");
		huoniao.operaJson("houseSpAdd.php?dopost=getIndustry", "", function(data){
			huoniao.hideTip();
			if(data){

				var content = [], selected = [];
				content.push('<div class="selectedTags">已选：</div>');
				content.push('<div class="tagsList"><div class="tag-list">');
				for(var l = 0; l < data.length; l++){
					var id = data[l].id, name = data[l].typename;
					if($.inArray(id, valArr) > -1){
						selected.push('<span data-id="'+id+'">'+name+'<a href="javascript:;">&times;</a></span>');
					}
					content.push('<span'+($.inArray(id, valArr) > -1 ? " class='checked'" : "")+' data-id="'+id+'">'+name+'<a href="javascript:;">+</a></span>');
				}
				content.push('</div></div>');

				$.dialog({
					id: "memberInfo",
					fixed: false,
					title: "选择行业",
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
						input.prev(".selectedTags").html(html);

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
						// if(type == "learn" && length >= learnLength){
						// 	alert("想学技能最多可选择 "+learnLength+" 个，可在模块设置中配置！");
						// 	return false;
						// }

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
		});
	});

	//删除已选择的行业
	$(".selectedTags").delegate("span a", "click", function(){
		var pp = $(this).parent(), id = pp.attr("data-id"), input = pp.parent().next("input");
		pp.remove();

		var val = input.val().split(",");
		val.splice($.inArray(id,val),1);
		input.val(val.join(","));
	});

	//模糊匹配会员
	$("#user").bind("input", function(){
		$("#userid").val("0");
		$("#userPhone").html("").hide();
		var t = $(this), val = t.val();
		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("../inc/json.php?action=checkZjUser", "key="+val, function(data){
				t.removeClass("input-loading");
				if(!data) {
					$("#userList, #userPhone").html("").hide();
					return false;
				}
				var list = [];
				for(var i = 0; i < data.length; i++){
					list.push('<li data-id="'+data[i].id+'" data-phone="'+data[i].phone+'">'+data[i].username+'</li>');
				}
				if(list.length > 0){
					var pos = t.position();
					$("#userList")
						.css({"left": pos.left, "top": pos.top + 36, "width": t.width() + 12})
						.html('<ul>'+list.join("")+'</ul>')
						.show();
				}else{
					$("#userList, #userPhone").html("").hide();
				}
			});

		}else{
			$("#userList, #userPhone").html("").hide();
		}
    });

	$("#userList").delegate("li", "click", function(){
		var name = $(this).text(), id = $(this).attr("data-id"), phone = $(this).attr("data-phone");
		$("#user").val(name);
		$("#userid").val(id);
		$("#userList").html("").hide();
		$("#userPhone").html("电话："+phone).show();
		$("#user").siblings(".input-tips").removeClass().addClass("input-tips input-ok");
		return false;
	});

	$(document).click(function (e) {
        var s = e.target;
        if (!jQuery.contains($("#userList").get(0), s)) {
            if (jQuery.inArray(s.id, "user") < 0) {
                $("#userList").hide();
            }
        }
    });

	$("#user").bind("blur", function(){
		var t = $(this), val = t.val(), flag = false;
		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("../inc/json.php?action=checkZjUser", "key="+val, function(data){
				t.removeClass("input-loading");
				if(data) {
					for(var i = 0; i < data.length; i++){
						if(data[i].username == val){
							flag = true;
							$("#userid").val(data[i].id);
							$("#userPhone").html("电话："+data[i].phone).show();
						}
					}
				}
				if(flag){
					t.siblings(".input-tips").removeClass().addClass("input-tips input-ok");
				}else{
					t.siblings(".input-tips").removeClass().addClass("input-tips input-error");
				}
			});
		}else{
			t.siblings(".input-tips").removeClass().addClass("input-tips input-error");
		}
	});

	//搜索回车提交
    $("#editform input").keyup(function (e) {
        if (!e) {
            var e = window.event;
        }
        if (e.keyCode) {
            code = e.keyCode;
        }
        else if (e.which) {
            code = e.which;
        }
        if (code === 13) {
            $("#btnSubmit").click();
        }
    });

	//表单提交
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t            = $(this),
			id           = $("#id").val(),
			type         = $("input[name=type]:checked").val(),
			title        = $("#title"),
			industry     = $("#industry").val(),
			addrid       = $("#addrid").val(),
			address      = $("#address"),
			price        = $("#price"),
			transfer     = $("#transfer"),
			area         = $("#area"),
			usertype     = $("input[name=usertype]:checked").val(),
			username     = $("#username"),
			contact      = $("#contact"),
			userid       = $("#userid").val(),
			user         = $("#user").val(),
			weight       = $("#weight");

		if(type == 2){
			if(industry == 0 || industry == ""){
				huoniao.goTop();
				$.dialog.alert("请选择经营行业！");
				return false;
			}
		}

		if(!huoniao.regex(title)){
			huoniao.goTop();
			return false;
		};

		if(addrid == 0 || addrid == ""){
			huoniao.goTop();
			$.dialog.alert("请选择区域！");
			return false;
		}

		if(!huoniao.regex(address)){
			huoniao.goTop();
			return false;
		};

		if(!init.regex(price)){
			huoniao.goTop();
			$.dialog.alert("请正确输入价格，只能填写数字，支持两位小数！");
			return false;
		};

		if(type == 2){
			if(!init.regex(transfer)){
				huoniao.goTop();
				$.dialog.alert("请正确输入转让费，只能填写数字，支持两位小数！");
				return false;
			};
		}

		if(!init.regex(area)){
			huoniao.goTop();
			$.dialog.alert("请正确输入面积，只能填写正整数！");
			return false;
		};

		if(usertype == 0){
			if(!huoniao.regex(username)){
				huoniao.goTop();
				return false;
			}
			if(!huoniao.regex(contact)){
				huoniao.goTop();
				return false;
			}
		}else{
			if(userid == "" || userid == 0 || user == ""){
				$("#user").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
				huoniao.goTop();
				return false;
			}
		}

		if(!huoniao.regex(weight)){
			return false;
		}

		t.attr("disabled", true);

		//异步提交
		huoniao.operaJson("houseSpAdd.php", $("#editform").serialize() + "&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "save"){
					huoniao.parentTip("success", "发布成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					huoniao.goTop();
					location.reload();
				}else{
					huoniao.parentTip("success", "修改成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					t.attr("disabled", false);
				}
			}else{
				$.dialog.alert(data.info);
				t.attr("disabled", false);
			};
		});
	});

});
