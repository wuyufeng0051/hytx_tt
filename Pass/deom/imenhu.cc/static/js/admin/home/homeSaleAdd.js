//实例化编辑器
var ue = UE.getEditor('body');

$(function () {

	var thisURL   = window.location.pathname;
		tmpUPage  = thisURL.split( "/" );
		thisUPage = tmpUPage[ tmpUPage.length-1 ];
		thisPath  = thisURL.split(thisUPage)[0];

	var init = {
		//树形递归分类
		treeTypeList: function(){
			var typeList = [], cl = "";
			var l=companyArr;
			typeList.push('<option value="">选择公司</option>');
			for(var i = 0; i < l.length; i++){
				(function(){
					var jsonArray =arguments[0], selected = "";
					if(company == jsonArray["id"]){
						selected = " selected";
					}
					typeList.push('<option value="'+jsonArray["id"]+'"'+selected+'>'+cl+"|--"+jsonArray["company"]+'</option>');
				})(l[i]);
			}
			return typeList.join("");
		}

	};

	//填充栏目分类
	$("#company").html(init.treeTypeList());

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

	//提交表单
	$("#btnSubmit").bind("click", function(event){
		event.preventDefault();
		var t            = $(this),
			id           = $("#id").val(),
			title        = $("#title"),
			company      = $("#company").val();

		//标题
		if(!huoniao.regex(title)){
			huoniao.goTop();
			return false;
		};

		//公司
		if(company == "" || company == "0"){
			$("#companyList").siblings(".input-tips").removeClass().addClass("input-tips input-error").attr("style", "display:inline-block");
			tj = false;
			huoniao.goTop();
			return false;
		}else{
			$("#companyList").siblings(".input-tips").removeClass().addClass("input-tips input-ok").attr("style", "display:inline-block");
		}

		ue.sync();

		t.attr("disabled", true);

		$.ajax({
			type: "POST",
			url: "homeSale.php?dopost="+$("#dopost").val(),
			data: $(this).parents("form").serialize() + "&submit=" + encodeURI("提交"),
			dataType: "json",
			success: function(data){
				if(data.state == 100){
					ue.execCommand('cleardoc');
					if($("#dopost").val() == "Add"){
						huoniao.goTop();
						$.dialog({
							fixed: true,
							title: "添加成功",
							icon: 'success.png',
							content: "添加成功！",
							ok: function(){
								location.reload();
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
									$("body",parent.document).find("#nav-homeSalephp").click();
									//parent.reloadPage($("body",parent.document).find("#body-houseNewsListphp")[0].contentWindow);
									parent.reloadPage($("body",parent.document).find("#body-homeSalephp"));
									$("body",parent.document).find("#nav-homeSaleEdit"+id+" s").click();
								}catch(e){
									location.href = thisPath + "homeSale.php";
								}
							},
							cancel: false
						});
					}
				}else{
					$.dialog.alert(data.info);
					t.attr("disabled", false);
				};
			},
			error: function(msg){
				$.dialog.alert(msg.status+":"+msg.statusText);
				t.attr("disabled", false);
			}
		});
	});

	//页面刷新前提示
	window.onbeforeunload = function() {
		if (ue.hasContents()) {
			return "您正在编辑的文章没有保存，离开会导致内容丢失，是否确定离开？";
		}
	}


});
