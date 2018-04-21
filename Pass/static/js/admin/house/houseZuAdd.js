//实例化编辑器
var ue = UE.getEditor('note');
var mue = UE.getEditor('mbody', {"term": "mobile"});

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
		,treeTypeList: function(){
			var typeList = [], cl = "";
			var l=addrListArr;
			typeList.push('<option value="0">不限</option>');
			for(var i = 0; i < l.length; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower, selected = "";
					if(addrid == jsonArray["id"]){
						selected = " selected";
					}
					typeList.push('<option value="'+jsonArray["id"]+'"'+selected+'>'+cl+"|--"+jsonArray["typename"]+'</option>');
					for(var k = 0; k < jArray.length; k++){
						cl += '    ';
						var selected = "";
						if(addrid == jArray[k]["id"]){
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

	//模糊匹配小区
	$("#community").bind("input", function(){
		$("#communityid").val("0");
		$("#communityAddr").html("").hide();
		$("#communityInfo").hide();
		var t = $(this), val = t.val();
		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("../inc/json.php?action=checkCommunity", "key="+val, function(data){
				t.removeClass("input-loading");
				if(!data) {
					$("#communityList, #communityAddr").html("").hide();
					return false;
				}
				var list = [];
				for(var i = 0; i < data.length; i++){
					list.push('<li data-id="'+data[i].id+'" data-addrid="'+data[i].typename+'" data-addr="'+data[i].addr+'">'+data[i].title+'</li>');
				}
				if(list.length > 0){
					var pos = t.position();
					$("#communityList")
						.css({"left": pos.left, "top": pos.top + 36, "width": t.width() + 12})
						.html('<ul>'+list.join("")+'</ul>')
						.show();
				}else{
					$("#communityList, #communityAddr").html("").hide();
				}
			});

		}else{
			$("#communityList, #communityAddr").html("").hide();
		}
    });

	$("#communityList").delegate("li", "click", function(){
		var title = $(this).text(), id = $(this).attr("data-id"), addrid = $(this).attr("data-addrid"), addr = $(this).attr("data-addr");
		$("#community").val(title);
		$("#communityid").val(id);
		$("#communityAddr").html(addrid+" "+addr).show();
		$("#communityList").html("").hide();
		$("#community").siblings(".input-tips").removeClass().addClass("input-tips input-ok");
		return false;
	});

	$(document).click(function (e) {
        var s = e.target;
        if (!jQuery.contains($("#communityList").get(0), s)) {
            if (jQuery.inArray(s.id, "community") < 0) {
                $("#communityList").hide();
            }
        }
		if($("#community").val() != "" && $("#communityid").val() == 0){
			$("#communityInfo").show();
		}
    });

	$("#community").bind("blur", function(){
		var t = $(this), val = t.val(), flag = false;
		if(val != ""){
			t.addClass("input-loading");
			huoniao.operaJson("../inc/json.php?action=checkCommunity", "key="+val, function(data){
				t.removeClass("input-loading");
				if(data) {
					for(var i = 0; i < data.length; i++){
						if(data[i].username == val){
							flag = true;
							$("#community").val(data[i].title);
							$("#communityid").val(data[i].id);
							$("#communityAddr").html(data[i].addrid+" "+data[i].addr).show();
						}
					}
				}
				if(flag){
					t.siblings(".input-tips").removeClass().addClass("input-tips input-ok");
				}else{
					t.siblings(".input-tips").removeClass().addClass("input-tips input-ok");
				}
			});
		}else{
			t.siblings(".input-tips").removeClass().addClass("input-tips input-error");
		}
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

	//房源性质选择
	$("input[name=rentype]").bind("click", function(){
		var val = $(this).val();
		if(val == 0){
			$("#rent1").hide();
		}else{
			$("#rent1").show();
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
		$('#addrid').val($('.addrBtn').attr('data-id'));
		var t            = $(this),
			id           = $("#id").val(),
			title        = $("#title"),
			community    = $("#community").val(),
			communityid  = $("#communityid").val();
			addrid       = $("#addrid").val(),
			address      = $("#address"),
			rentype      = $("input[name=rentype]:checked").val(),
			price        = $("#price"),
			area         = $("#area"),
			bno          = $("#bno"),
			floor        = $("#floor"),
			buildage     = $("#buildage"),
			usertype     = $("input[name=usertype]:checked").val(),
			username     = $("#username"),
			contact      = $("#contact"),
			userid       = $("#userid").val(),
			user         = $("#user").val(),
			weight       = $("#weight"),
			sharetype    = $("#sharetype").val();

		if(!huoniao.regex(title)){
			huoniao.goTop();
			return false;
		};

		if((communityid == "" || communityid == 0) && community == ""){
			$("#community").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			huoniao.goTop();
			return false;
		}

		if(communityid == 0){
			if(addrid == "" || addrid == 0){
				huoniao.goTop();
				$(".config-nav button:eq(0)").click();
				$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
				return false;
			}else{
				$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
			}
			if(!huoniao.regex(address)){
				huoniao.goTop();
				return false;
			}
		}

		if(!init.regex(price)){
			huoniao.goTop();
			$.dialog.alert("请正确输入租金，只能填写数字，支持两位小数！");
			return false;
		};

		if(rentype == 1 && (sharetype == "" || sharetype == 0)){
			huoniao.goTop();
			$.dialog.alert("请选择出租间！");
			return false;
		}

		if(!init.regex(area)){
			huoniao.goTop();
			$.dialog.alert("请正确输入面积，只能填写正整数！");
			return false;
		};

		if(!init.regex(bno)){
			huoniao.goTop();
			$.dialog.alert("请正确输入楼层，填写整数，不能为0，地下室请用负数！");
			return false;
		};

		if(!init.regex(floor)){
			huoniao.goTop();
			$.dialog.alert("请正确输入总层数，填写整数，不能为0和负数！");
			return false;
		};

		if(Number(floor.val()) < Number(bno.val())){
			huoniao.goTop();
			$.dialog.alert("总楼层不能小于所在楼层！");
			return false;
		}

		if(buildage.val() != ""){
			if(!init.regex(buildage)){
				huoniao.goTop();
				$.dialog.alert("请正确输入建造年代，填写整数！");
				return false;
			};
		}

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
		huoniao.operaJson("houseZuAdd.php", $("#editform").serialize() + "&submit="+encodeURI("提交"), function(data){
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
