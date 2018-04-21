$(function(){

	var dataInfo;
	var zhinengArr = [];

	//选择职位类型 s
	$("#selType button").bind("click", function(){
		var content = [];

		if(zhinengArr.length > 0){
			content.push(createZhineng());
		}else{
			content.push('<p class="loadzhineng" align="center">加载中...</p>');
		}

		dataInfo = $.dialog({
			id: "dataInfo",
			fixed: false,
			title: "选择职位类型",
			content: '<div class="selectType">'+content.join("")+'</div>',
			width: 800,
			height: 450,
			button: [
				{
					name: '不限类别',
					callback: function(){
						var url = $("#zn").data("url").replace("%type%", "");
						$("#zn")
							.attr("data-id", 0)
							.attr("title", "职位类型")
							.html("职位类型<i></i>");
						location.href = url;
					}
				}
			]
		});

		if(zhinengArr.length <= 0){
			$.ajax({
				url: masterDomain+"/include/ajax.php?service=job&action=type&son=1",
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data.state == 100){

						zhinengArr = data.info;
						$(".selectType").html(createZhineng());

					}else{
						$(".selectType").html('<p align="center"><font size="3" color="#ff0000">'+data.info+'</font></p>');
					}
				},
				error: function(){
					$(".selectType").html('<p align="center"><font size="3" color="#ff0000">加载失败，请稍后访问！</font></p>');
				}
			});
		}

	});

	//创建职能HTML
	function createZhineng(){
		var content = [];
		var data = zhinengArr;
		var url = $("#zn").data("url");
		for(var a = 0; a < data.length; a++){
			content.push('<dl>');
			content.push('<dt><span>'+data[a].typename+'</span><s></s></dt>');
			content.push('<dd class="fn-clear">');

			if(data[a].lower.length > 0){
				var lower1 = data[a].lower;
				var subdata = [], f = 0;

				for(var b = 0; b < lower1.length; b++){
					content.push('<div class="sub-data" data-id="'+b+'" title="'+lower1[b].typename+'"><a href="javascript:;">'+lower1[b].typename+'</a><i></i></div>');
					lower2 = lower1[b].lower;

					subdata.push('<ul class="fn-clear zn'+b+'">');
					for(var c = 0; c < lower2.length; c++){
						subdata.push('<li><a href="javascript:;" data-id="'+lower2[c].id+'" data-name="'+lower2[c].typename+'" title="'+lower2[c].typename+'">'+lower2[c].typename+'</a></li>');
					}
					subdata.push('</ul>');

					f++;

					if(f == 3 || b == lower1.length-1){
						content.push(subdata.join(""));
						subdata = [];
						f = 0;
					}

				}

			}

			content.push('</dd>');
			content.push('</dl>');
		}

		return content.join("");
	}

	//TAB切换
	$("body").delegate('.sub-data', 'click', function () {
		var t = $(this), id = t.attr("data-id"), par = t.closest("dd");
		if(t.hasClass("curr")){
			t.removeClass("curr");
			$(".selectType .sub-data").removeClass("curr");
			$(".selectType ul").stop().slideUp("fast");
		}else{
			$(".selectType .sub-data").removeClass("curr");
			$(".selectType ul").stop().slideUp("fast");

			t.addClass("curr");
			par.find(".zn"+id).stop().slideDown("fast");
		}
	});

	//选择标签
	$("body").delegate(".selectType li a", 'click', function(){
		var t = $(this), id = t.attr("data-id"), name = t.attr("data-name");
		$("#selType button")
			.attr("data-id", id)
			.attr("title", name)
			.html(name+'<span class="caret"></span>');
		$("#type").val(id);
		dataInfo.close();
	});

	//选择职位类型 e



	//选择区域
	$("#selAddr .sel-group:eq(0) a").bind("click", function(){
		if($(this).attr("data-id") != $("#addrid").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id);
		}
	});

	if($("#addrid").val() != ""){
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
			url: masterDomain+"/include/ajax.php?service=job&action=addr&type="+id,
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

					$("#addrid").before(html.join(""));
					if(!selected){
						$("#addrid").val(0);
						$("#addrid").closest("dd").find(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择所在区域");
					}

				}
			}
		});
	}

	//时间
	var selectDate = function(el, func){
		WdatePicker({
			el: el,
			isShowClear: false,
			isShowOK: false,
			isShowToday: false,
			qsEnabled: false,
			dateFmt: 'yyyy-MM-dd'
		});
	}
	$("#valid").focus(function(){
		selectDate("valid");
	});


	//提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

		var t           = $(this),
				title       = $("#title"),
				type        = $("#type"),
				valid       = $("#valid"),
				number      = $("#number"),
				addrid      = $("#addrid"),
				experience  = $("#experience"),
				educational = $("#educational"),
				salary      = $("#salary"),
				tel         = $("#tel"),
				email       = $("#email"),
				vdimgck     = $("#vdimgck");

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

		//职位名称
		if($.trim(title.val()) == "" || title.val() == 0){
			title.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入公司名称");
			offsetTop = offsetTop == 0 ? title.position().top : offsetTop;
		}

		//职位类别
		if($.trim(type.val()) == "" || type.val() == 0){
			type.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择职位类别");
			offsetTop = offsetTop == 0 ? $("#selType").position().top : offsetTop;
		}

		//有效期
		if($.trim(valid.val()) == "" || valid.val() == 0){
			valid.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择有效期");
			offsetTop = offsetTop == 0 ? valid.position().top : offsetTop;
		}

		//招聘人数
		if($.trim(number.val()) == ""){
			number.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入招聘人数");
			offsetTop = offsetTop == 0 ? number.position().top : offsetTop;
		}

		//工作地点
		if($.trim(addrid.val()) == "" || addrid.val() == 0){
			addrid.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择工作地点");
			offsetTop = offsetTop == 0 ? $("#selAddr").position().top : offsetTop;
		}

		//工作经验
		if($.trim(experience.val()) == "" || experience.val() == 0){
			experience.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择工作经验");
			offsetTop = offsetTop == 0 ? $("#selExperience").position().top : offsetTop;
		}

		//学历要求
		if($.trim(educational.val()) == "" || educational.val() == 0){
			educational.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择学历要求");
			offsetTop = offsetTop == 0 ? $("#selEducational").position().top : offsetTop;
		}

		//薪资范围
		if($.trim(salary.val()) == "" || salary.val() == 0){
			salary.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请选择薪资范围");
			offsetTop = offsetTop == 0 ? $("#selSalary").position().top : offsetTop;
		}

		//联系方式
		if($.trim(tel.val()) == "" || tel.val() == 0){
			tel.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入联系电话");
			offsetTop = offsetTop == 0 ? tel.position().top : offsetTop;
		}

		//联系邮箱
		if($.trim(email.val()) == "" || email.val() == 0){
			email.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入联系邮箱");
			offsetTop = offsetTop == 0 ? email.position().top : offsetTop;
		}

		//验证验证码
		if($.trim(vdimgck.val()) == ""){
			vdimgck.siblings(".tip-inline").removeClass().addClass("tip-inline error").html("<s></s>请输入码证码！");
			offsetTop = offsetTop == 0 ? vdimgck.position().top : offsetTop;
		}

		if(offsetTop){
			$('.main').animate({scrollTop: offsetTop + 10}, 300);
			return false;
		}

		var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url"), data = form.serialize();

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					var tip = "发布成功！";
					if(id != undefined && id != "" && id != 0){
						tip = "修改成功！";
					}

					$.dialog({
						title: '提示消息',
						icon: 'success.png',
						content: tip,
						ok: function(){
							location.href = url;
						}
					});

				}else{
					$.dialog.alert(data.info);
					t.removeClass("disabled").html("确认提交");
					$("#verifycode").click();
				}
			},
			error: function(){
				$.dialog.alert("网络错误，请重试！");
				t.removeClass("disabled").html("确认提交");
				$("#verifycode").click();
			}
		});


	});


});
