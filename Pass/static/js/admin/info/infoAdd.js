//实例化编辑器
var ue = UE.getEditor('body');
var mue = UE.getEditor('mbody', {"term": "mobile"});

$(function () {

	huoniao.parentHideTip();

	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	var init = {
		//树形递归分类
		treeTypeList: function(type){
			var typeList = [], cl = "";
			if(type == "addr"){
				var l=addrListArr;
				typeList.push('<option value="">选择地区</option>');
			}else{
				var l=typeListArr;
				typeList.push('<option value="">选择分类</option>');
			}
			for(var i = 0; i < l.length; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower, selected = "";
					if((type == "type" && typeid == jsonArray["id"]) || (type == "addr" && addr == jsonArray["id"])){
						$('.addrBtn').attr('data-id', addr);
					}
					if(jsonArray['lower'] != "" && type == "type"){
						typeList.push('<optgroup label="'+cl+"|--"+jsonArray["typename"]+'"></optgroup>');
					}else{
						typeList.push('<option value="'+jsonArray["id"]+'"'+selected+'>'+cl+"|--"+jsonArray["typename"]+'</option>');
					}
					for(var k = 0; k < jArray.length; k++){
						cl += '    ';
						var selected = "";
						if((type == "type" && typeid == jArray[k]["id"]) || (type == "addr" && addr == jArray[k]["id"])){
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

		//异步字段html
		,ajaxItemHtml: function(data){
			$.ajax({
				type: "POST",
				url: "infoAdd.php?dopost=getInfoItem",
				data: data,
				dataType: "json",
				success: function(data){
					if(data){
						init.itemHtml(data);
					}else{
						$("#itemList").html("").hide();
					}
				}
			});
		}

		//字段html
		,itemHtml: function(data){
			var itemList = data.itemList, html = [];
			for(var i = 0; i < itemList.length; i++){
				html.push('<dl class="clearfix">');
				html.push('  <dt><label for="'+itemList[i].field+'">'+itemList[i].title+'：</label></dt>');
				html.push('  <dd>');

				var val = "", required = "";
				if(itemList[i].value != ""){
					val = itemList[i].value;
				}else{
					val = itemList[i].default;
				}
				if(itemList[i].required == 1){
					required = ' data-required="true"'
				}
				if(itemList[i].type == "text"){
					html.push('    <input class="input-xlarge" type="text" name="'+itemList[i].field+'" id="'+itemList[i].field+'"'+required+' value="'+val+'" />');
					if(itemList[i].required == 1){
						html.push('    <span class="input-tips"><s></s>请输入'+itemList[i].title+'</span>');
					}
				}else if(itemList[i].type == "radio" || itemList[i].type == "checkbox"){
					var list = itemList[i].options.split(",");
					for(var a = 0; a < list.length; a++){
						var checked = "";
						if(itemList[i].type == "radio"){
							if(itemList[i].value != ""){
								if(list[a] == itemList[i].value){
									checked = " checked='true'";
								}
							}else if(itemList[i].default != ""){
								if(list[a] == itemList[i].default){
									checked = " checked='true'";
								}
							}else{
								if(a == 0){
									//checked = " checked='true'";
								}
							}
						}else{
							var dVal = itemList[i].default.split("|"), vVal = itemList[i].value.split(",");
							if(itemList[i].value != "") {
								for(var c = 0; c < vVal.length; c++){
									if(list[a] == vVal[c]){
										checked = " checked='true'"
									}
								}
							}else{
								if(itemList[i].default != ""){
									for(var c = 0; c < dVal.length; c++){
										if(list[a] == dVal[c]){
											checked = " checked='true'"
										}
									}
								}
							}
						}
						var name = itemList[i].field;
						if(itemList[i].type == "checkbox"){
							name = itemList[i].field+'[]';
						}
						html.push('    <label for="'+itemList[i].field+"_"+a+'"><input type="'+itemList[i].type+'" name="'+name+'" id="'+itemList[i].field+"_"+a+'"'+required+' value="'+list[a]+'"'+checked+' />'+list[a]+'</label>&nbsp;&nbsp;');
					}
					if(itemList[i].required == 1){
						html.push('    <span class="input-tips"><s></s>请选择'+itemList[i].title+'</span>');
					}

					//多选增加全选功能
					if(itemList[i].type == "checkbox"){
						html.push('<br /><span class="label label-info checkAll" style="margin-top:5px;">全选</span>');
					}
				}else if(itemList[i].type == "select"){
					var list = itemList[i].options.split(",");
					html.push('    <span id="'+itemList[i].field+'List"><select name="'+itemList[i].field+'" id="'+itemList[i].field+'"'+required+'>');
					html.push('      <option value="">请选择</option>');
					for(var a = 0; a < list.length; a++){
						var checked = "";
						if(itemList[i].value != ""){
							if(list[a] == itemList[i].value){
								checked = " selected";
							}
						}else if(itemList[i].default != ""){
							if(list[a] == itemList[i].default){
								checked = " selected";
							}
						}
						html.push('      <option value="'+list[a]+'"'+checked+'>'+list[a]+'</option>');
					}
					html.push('    </select></span>');
					if(itemList[i].required == 1){
						html.push('    <span class="input-tips"><s></s>请选择'+itemList[i].title+'</span>');
					}
				}

				html.push('  </dd>');
				html.push('</dl>');
			}
			$("#itemList").html(html.join("")).show();
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

	//填充栏目分类
	$("#typeid").html(init.treeTypeList("type"));

	//首次加载
	if($("#dopost").val() == "edit" || typeid != ""){
		init.ajaxItemHtml("typeid="+$("#typeid").val()+"&id="+$("#id").val());
	}

	//分类切换
	$("#typeid").change(function(){
		if($("#typeid").val() != ""){
			if($("#dopost").val() == "edit"){
				init.ajaxItemHtml("typeid="+$("#typeid").val()+"&id="+$("#id").val());
			}else{
				init.ajaxItemHtml("typeid="+$("#typeid").val());
			}
		}else{
			$("#itemList").html("").hide();
		}
	});

	//发布时间
	$("#valid").datetimepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		language: 'ch',
		todayBtn: true,
		minView: 2
	});

	//表单验证
	$("#editform").delegate("input,textarea", "focus", function(){
		var tip = $(this).siblings(".input-tips");
		if(tip.html() != undefined){
			tip.removeClass().addClass("input-tips input-focus").attr("style", "display:inline-block");
		}
	});

	$("#editform").delegate("input[type='radio'], input[type='checkbox']", "click", function(){
		if($(this).attr("data-required") == "true"){
			var name = $(this).attr("name"), val = $("input[name='"+name+"']:checked").val();
			if(val == undefined){
				$(this).parent().siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			}else{
				$(this).parent().siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
			}
		}
	});

	$("#editform").delegate("input,textarea", "blur", function(){
		var obj = $(this), tip = obj.siblings(".input-tips");
		if(obj.attr("data-required") == "true"){
			if($(this).val() == ""){
				tip.removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			}else{
				tip.removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
			}
		}else{
			huoniao.regex(obj);
		}
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

	$(".color_pick").colorPicker({
		callback: function(color) {
			var color = color.length === 7 ? color : '';
			$("#color").val(color);
			$(this).find("em").css({"background": color});
		}
	});

	//跳转表单交互
	$("input[name='flags[]']").bind("click", function(){
		if($(this).val() == "t"){
			if(!$(this).is(":checked")){
				$("#rDiv").hide();
			}else{
				$("#rDiv").show();
			}
		}
	});

	//提交表单
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		$('#addr').val($('.addrBtn').attr('data-id'));
		var t            = $(this),
			id           = $("#id").val(),
			typeid       = $("#typeid").val(),
			addr         = $("#addr").val(),
			title        = $("#title"),
			volid        = $("#volid").val(),
			weight       = $("#weight"),
			tj           = true;

		//分类
		if(typeid == "" || typeid == "0"){
			$("#typeList").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			tj = false;
			huoniao.goTop();
			return false;
		}else{
			$("#typeList").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}

		//标题
		if(!huoniao.regex(title)){
			tj = false;
			huoniao.goTop();
			return false;
		};

		//排序
		if(!huoniao.regex(weight)){
			tj = false;
			huoniao.goTop();
			return false;
		}

		//地区
		if(addr == "" || addr == "0"){
			$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			tj = false;
			huoniao.goTop();
			return false;
		}else{
			$("#addrList").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}

		$("#itemList").find("input, select").each(function() {
            var objid = $(this).attr("id"), type = $(this).attr("type"), name = $(this).attr("name"), tip = $(this).parent().siblings(".input-tips");
			if(type == "text"){
				tip = $(this).siblings(".input-tips");
			}
			if($(this).attr("data-required") == "true"){
				if(type == "radio" || type == "checkbox"){
					if($("input[name='"+name+"']:checked").val() == "" || $("input[name='"+name+"']:checked").val() == undefined){
						tip.removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
						tj = false;
						$.dialog.alert(tip.text());
						return false;
					}else{
						tip.removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
					}
				}else{
					if($(this).val() == ""){
						tip.removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
						tj = false;
						$.dialog.alert(tip.text());
						return false;
					}else{
						tip.removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
					}
				}
			}
        });

		ue.sync();
		if(ue.getContent() == ""){
			$.dialog.alert("请输入信息内容！");
			return false;
		}

		if($("#person").val() == ""){
			$.dialog.alert("请输入联系人！");
			return false;
		}

		if($("#tel").val() == ""){
			$.dialog.alert("请输入联系电话！");
			return false;
		}

		if(volid == "" || volid == 0){
			$.dialog.alert("请选择有效期！");
			return false;
		}


		if(tj){
			t.attr("disabled", true).html("提交中...");
			$.ajax({
				type: "POST",
				url: "infoAdd.php?action="+action,
				data: $(this).parents("form").serialize() + "&submit=" + encodeURI("提交"),
				dataType: "json",
				success: function(data){
					if(data.state == 100){
						if($("#dopost").val() == "save"){

							huoniao.parentTip("success", "信息发布成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
							huoniao.goTop();
							location.href = "infoAdd.php?typeid="+$("#typeid").val();

						}else{

							huoniao.parentTip("success", "信息修改成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
							t.attr("disabled", false).html("确认提交");

						}
					}else{
						$.dialog.alert(data.info);
						t.attr("disabled", false);
					};
				},
				error: function(msg){
					$.dialog.alert("网络错误，请刷新页面重试！");
					t.attr("disabled", false);
				}
			});
		}
	});



});
