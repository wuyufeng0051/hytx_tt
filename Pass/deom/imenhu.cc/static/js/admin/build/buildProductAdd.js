//实例化编辑器
var ue = UE.getEditor('body');
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

	//分类切换改变品牌选项
	$("#type").change(function(){
		var val = $(this).val(), brand = $("#brand");
		if(val != ""){
			huoniao.operaJson("buildProductAdd.php?dopost=getBrand", "id="+val, function(data){
				if(data != 200 && data.length > 0){
					var option = [];
					option.push('<option value="0">请选择</option>');
					for(var i = 0; i < data.length; i++){
						option.push('<option value="'+data[i].id+'">'+data[i].title+'</option>');
					}
					brand.html(option.join(""));
				}else{
					brand.html('<option value="0">分类下无相关品牌</option>');
				}
			});
		}else{
			brand.html('<option value="0">请先选择分类</option>');
		}
	});

	//限时抢
	$("input[name='property[]']").bind("click", function(){

		$("input[name='property[]']").each(function(){
			if($(this).val() == 'q' && $(this).is(":checked")){
				$("#panicbuy").show();
			}else{
				$("#panicbuy").hide();
			}
		});

	});

	//选择时间
	$("#btime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose: true, language: 'ch'});
	$("#etime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose: true, language: 'ch'});

	//回车提交
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
			title        = $("#title"),
			type         = $("#type").val(),
			mprice       = $("#mprice"),
			price        = $("#price"),
			litpic       = $("#litpic"),
			weight       = $("#weight");

		if(!huoniao.regex(title)){
			huoniao.goTop();
			return false;
		};

		if(type == "" || type == 0){
			huoniao.goTop();
			$("#typeList").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			return false;
		}else{
			$("#typeList").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}

		if(!huoniao.regex(mprice)){
			huoniao.goTop();
			return false;
		}

		if(!huoniao.regex(price)){
			huoniao.goTop();
			return false;
		}

		if(litpic == ""){
			huoniao.goTop();
			$.dialog.alert("请上传产品缩略图！");
			return false;
		};

		if(!huoniao.regex(weight)){
			return false;
		}

		t.attr("disabled", true);

		ue.sync();

		//异步提交
		huoniao.operaJson("buildProductAdd.php", $("#editform").serialize() + "&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "save"){

					huoniao.parentTip("success", "商品添加成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					huoniao.goTop();
					location.reload();

				}else{

					huoniao.parentTip("success", "商品修改成功！<a href='"+data.url+"' target='_blank'>"+data.url+"</a>");
					t.attr("disabled", false);

				}
			}else{
				$.dialog.alert(data.info);
				t.attr("disabled", false);
			};
		}, function(){
			$.dialog.alert("网络错误，请重试！");
			t.attr("disabled", false);
		});
	});

});
