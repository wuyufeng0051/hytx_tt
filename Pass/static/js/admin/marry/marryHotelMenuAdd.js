$(function(){
	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" ); 
		thisUPage = tmpUPage[ tmpUPage.length-1 ]; 
		thisPath  = thisURL.split(thisUPage)[0];
		
	//提示
	$('#menus i, #menus a').tooltip();
	$('#menus i').bind("mousedown", function(){
		$('#menus i').tooltip("hide");
	});
	
	//拖动排序
	$("#menus").dragsort({ dragSelector: "h3>i" });	
	$("#menus ul").dragsort({ dragSelector: "li>i", placeHolderTemplate: '<li class="holder"></li>' });	
	
	//新增套系
	$("#addItem").bind("click", function(){
		var itemHtml = '<div class="menus-item clearfix"><h3><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-title"placeholder="套系名"class="input-small"/></h3><div class="del-item"><a href="javascript:;"><i class="icon-trash"></i>删除此套系</a></div><ul class="clearfix"><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li><li><i data-toggle="tooltip"data-placement="right"data-original-title="拖动以排序"class="icon-move"></i><input type="text"name="m-list"placeholder="菜名"class="input-medium"/><a data-toggle="tooltip"data-placement="right"data-original-title="删除"href="javascript:;"class="icon-trash"></a></li></ul><a href="javascript:;"class="addNewList"><i class="icon-plus"></i>新增菜名</a></div>';
		$("#menus").append(itemHtml);
		
		$('#menus i, #menus a').tooltip();
		$('#menus i').bind("mousedown", function(){
			$('#menus i').tooltip("hide");
		});
		
		$("#menus").dragsort("destroy");
		$("#menus ul").dragsort("destroy");
		$("#menus").dragsort({ dragSelector: "h3>i" });
		$("#menus ul").dragsort({ dragSelector: "li>i", placeHolderTemplate: '<li class="holder"></li>' });	
	});
	
	//新增菜名
	$("#menus").delegate(".addNewList", "click", function(){
		var listHtml = '<li><i data-toggle="tooltip" data-placement="right" data-original-title="拖动以排序" class="icon-move"></i><input type="text" name="m-list" placeholder="菜名" class="input-medium" /><a data-toggle="tooltip" data-placement="right" data-original-title="删除" href="javascript:;" class="icon-trash"></a></li>';
		$(this).prev("ul").append(listHtml);
		
		$('#menus i, #menus a').tooltip();
		$('#menus i').bind("mousedown", function(){
			$('#menus i').tooltip("hide");
		});
	});
	
	//删除套系
	$("#menus").delegate(".del-item", "click", function(){
		var t = $(this);
		if($(this).closest("#menus").find(".menus-item").length == 1){
			$.dialog.alert("至少保留一个套系！");
		}else{
			$.dialog.confirm("您确定要删除此套系菜单吗？", function(){
				t.closest(".menus-item").hide(300, function(){
					t.closest(".menus-item").remove()
				});
			});
		}
	});
	
	//删除菜名
	$("#menus").delegate(".icon-trash", "click", function(){
		var parent = $(this).parent();
		if($(this).closest("ul").find("li").length == 1){
			$.dialog.alert("至少保留一个菜名！");
		}else{
			parent.hide(300, function(){
				parent.remove()
			});
		}
	});
	
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
		var t       = $(this),
			id      = $("#id").val(),
			title   = $("#title"),
			price   = $("#price").val();
			
		if(!huoniao.regex(title)){
			huoniao.goTop();
			return false;
		};
		
		if($.trim(price) == ""){
			$.dialog.alert("请输入菜单价格");
			return false;
		}
		
		var menus = [];
		$("#menus").find(".menus-item").each(function(index, element) {
            var t = $(this), tit = t.find("h3 input[name=m-title]").val();
			if($.trim(tit) != ""){
				var mValues = [];
				t.find("ul li").each(function(index, element) {
                    var val = $(this).find("input[name=m-list]").val();
					if($.trim(val) != ""){
						mValues.push(val);
					}
                });
				
				if(mValues){
					menus.push(tit+"$$"+mValues.join("||"));
				}
			}
        });
		if(menus){
			menus = menus.join("@@@");
		}else{
			menus = "";
		}
		
		t.attr("disabled", true);	
		
		//异步提交
		huoniao.operaJson("marryHotelMenu.php", $("#editform").serialize() + "&menus="+menus+"&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "Add"){
					$.dialog({
						fixed: true,
						title: "添加成功",
						icon: 'success.png',
						content: "添加成功！",
						ok: function(){
							huoniao.goTop();
							window.location.reload();
						},
						cancel: false
					});
					
				}else{
					$.dialog({
						fixed: true,
						title: "修改成功",
						icon: 'success.png',
						content: "修改成功！",
						ok: function(){
							try{
								$("body",parent.document).find("#nav-marryHotelMenu"+$("#hotelid").val()).click();
								//parent.reloadPage($("body",parent.document).find("#body-loupanListphp")[0].contentWindow);
								parent.reloadPage($("body",parent.document).find("#body-marryHotelMenu"+$("#hotelid").val()));
								$("body",parent.document).find("#nav-marryHotelMenuEdit"+id+" s").click();
							}catch(e){
								location.href = thisPath + "marryHotelMenu.php?hotelid="+$("#hotelid").val();
							}
						},
						cancel: false
					});
				}
			}else{
				$.dialog.alert(data.info);
				t.attr("disabled", false);
			};
		});
	});
	
});