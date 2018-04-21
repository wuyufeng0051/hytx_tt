$(function(){
	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" ); 
		thisUPage = tmpUPage[ tmpUPage.length-1 ]; 
		thisPath  = thisURL.split(thisUPage)[0];
	
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
		var t            = $(this),
			id           = $("#id").val(),
			title        = $("#title"),
			type         = $("#type").val(),
			people       = $("#people"),
			contact      = $("#contact"),
			password     = $("#password"),
			weight       = $("#weight");
			
		if(!huoniao.regex(title)){
			huoniao.goInput($("#title"));
			return false;
		}
		
		if(!huoniao.regex(people)){
			huoniao.goInput(people);
			return false;
		}
		
		if(!huoniao.regex(contact)){
			huoniao.goInput(contact);
			return false;
		}
		
		if($("#edit").val() == "edit"){
			if(!huoniao.regex(password)){
				huoniao.goInput(password);
				return false;
			}
		}
		
		if(!huoniao.regex(weight)){
			huoniao.goInput(weight);
			return false;
		}
		
		t.attr("disabled", true);	
		
		//异步提交
		huoniao.operaJson("jobSentenceAdd.php", $("#editform").serialize() + "&submit="+encodeURI("提交"), function(data){
			if(data.state == 100){
				if($("#dopost").val() == "save"){
					$.dialog({
						fixed: true,
						title: "添加成功",
						icon: 'success.png',
						content: "查看链接：<br /><a href='http://www.baidu.com?id="+data.id+"' target='_blank'>http://www.baidu.com?id="+data.id+"</a>",
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
						content: "查看链接：<br /><a href='http://www.baidu.com?id="+id+"' target='_blank'>http://www.baidu.com?id="+id+"</a>",
						ok: function(){
							try{
								$("body",parent.document).find("#nav-jobSentencephptype"+type).click();
								parent.reloadPage($("body",parent.document).find("#body-jobSentencephptype"+type));
								$("body",parent.document).find("#nav-jobSentenceEdit"+type+id+" s").click();
							}catch(e){
								location.href = thisPath + "jobSentence.php?type="+type;
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