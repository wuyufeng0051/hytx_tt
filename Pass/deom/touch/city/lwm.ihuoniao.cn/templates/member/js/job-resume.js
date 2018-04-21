$(function(){

	//头像
	var photo = $(".photo");
	photo.hover(function(){
		$(this).removeClass("hover").addClass("hover");
	}, function(){
		$(this).removeClass("hover");
	});

	//上传图片
  function mysub(){

    var data = [];
    data['mod']  = "job";
    data['type'] = "photo";

    var fileId = photo.find("input[type=file]").attr("id");
		photo.find(".loading").show();
		photo.removeClass("hover");

    $.ajaxFileUpload({
      url: "/include/upload.inc.php",
      fileElementId: fileId,
      dataType: "json",
      data: data,
      success: function(m, l) {
        if (m.state == "SUCCESS") {

        	$(".holder").html("<s></s>重新上传");
					photo.find("img").attr("src", huoniao.changeFileSize(m.turl, "middle"));
					$("#litpic").val(m.url);
          photo.find(".loading").hide();

        } else {
          alert("上传失败！");
        }
      },
      error: function() {
				alert("网络错误，上传失败！");
      }
    });

  }

  $(".Filedata").bind("change", function(){
    if ($(this).val() == '') return;
    mysub();
  });


	//时间
	var selectDate = function(el){
		WdatePicker({
			el: el,
			isShowClear: false,
			isShowOK: false,
			isShowToday: false,
			qsEnabled: false,
			dateFmt: 'yyyy-MM-dd'
		});
	}

	$("#birth").click(function(){
		selectDate("birth");
	});

	$("#graduation").click(function(){
		selectDate("graduation");
	});

	$("#experience").delegate(".date1, .date2", "click", function(){
		selectDate($(this).attr("id"));
	});


  //选择区域
	$("#selAddr").delegate("a", "click", function(){
		if($(this).text() != "不限" && $(this).attr("data-id") != $("#addr").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id);
		}
	});

	//获取子级区域
	function getChildAddr(id){
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

					$("#addr").before(html.join(""));

				}
			}
		});
	}



	var dataInfo;
	var zhinengArr = [];

	//选择职位类型 s
	$("#typename").bind("click", function(){
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
			cancel: true
		});

		if(zhinengArr.length <= 0){
			$.ajax({
				url: "/include/ajax.php?service=job&action=type&son=1",
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
		var url = $("#typename").data("url");
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
		$("#typename")
			.attr("data-id", id)
			.attr("title", name)
			.html(name+'<span class="caret"></span>');
		$("#type").val(id);
		dataInfo.close();
	});

	//选择职位类型 e


	/* 工作经历 */
	var experienceHtml = '<div class="item"><div class="con"><div class="fn-clear"><dl class="fn-clear"><dt>公司名称：</dt><dd><input type="text"class="inp company"/></dd></dl><dl class="fn-clear"><dt>工作时间：</dt><dd><input type="text"class="inp date1"id="date11"/><em class="fn-left">&nbsp;-&nbsp;</em><input type="text"class="inp date2"id="date22"/></dd></dl></div><div class="fn-clear"><dl class="fn-clear"><dt>所在部门：</dt><dd><input type="text"class="inp bumen"/></dd></dl><dl class="fn-clear"><dt>担任职位：</dt><dd><input type="text"class="inp zhiwei"/></dd></dl></div><div class="fn-clear"><dl class="single fn-clear"><dt>工作内容：</dt><dd><textarea class="inp neirong"></textarea></dd></dl></div></div><div class="col"></div><span class="btn move"title="移动"><i></i></span><span class="btn del"title="删除"><i></i></span><span class="btn add"title="添加"><i></i></span></div>';

	$(".newbtn").bind("click", function(){
		var date1 = new Date().getTime();
		var date2 = new Date().getTime() + 1;
		var html = experienceHtml.replace("date11", date1).replace("date22", date2);
		var newexperience = $(html);
		newexperience.appendTo("#experience");
		newexperience.slideDown(300);
	});
	$("#experience").delegate(".add", "click", function(){
		var t = $(this).closest(".item");
		var date1 = new Date().getTime();
		var date2 = new Date().getTime() + 1;
		var html = experienceHtml.replace("date11", date1).replace("date22", date2);
		var newexperience = $(html);
		newexperience.insertAfter(t);
		newexperience.slideDown(300);
	});

	//删除工作经历
	$("#experience").delegate(".del", "click", function(){
		var t = $(this).closest(".item");
		$.dialog.confirm("确定要删除吗？", function(){
			t.slideUp(300, function(){
				t.remove();
			});
		});
	});

	$("#experience").dragsort({ dragSelector: ".move", placeHolderTemplate: '<div class="drag-item"></div>' });

	//错误提示
	var errmsgtime;
	function errmsg(div,str){
		$('#errmsg').remove();
		clearTimeout(errmsgtime);
		var top = div.offset().top - 33;
		var left = div.offset().left;
		$('html, body').animate({scrollTop:top}, 300);

		var msgbox = '<div id="errmsg" style="position:absolute;top:' + top + 'px;left:' + left + 'px;padding:0 10px;height:30px;line-height:30px;text-align:center;color:#f00;font-size:14px;display:none;z-index:99999;background:#ff0;">' + str + '</div>';
		$('body').append(msgbox);
		$('#errmsg').fadeIn(300);
		errmsgtime = setTimeout(function(){
			$('#errmsg').fadeOut(500, function(){
				$('#errmsg').remove();
			});
		},3000);
	};


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

		var name    = $("#name"),
				birth   = $("#birth"),
				home    = $("#home"),
				address = $("#address"),
				phone   = $("#phone"),
				email   = $("#email"),
				addr    = $("#addr"),
				type    = $("#type"),
				salary  = $("#salary"),
				startwork = $("#startwork"),
				workyear  = $("#workyear"),
				educational = $("#educational");

		if($.trim(name.val()) == ""){
			errmsg(name, "请输入您的姓名！");
			return false;
		}

		if($.trim(birth.val()) == ""){
			errmsg(birth, "请选择您的出生日期！");
			return false;
		}

		if($.trim(home.val()) == ""){
			errmsg(home, "请输入您的户籍地址！");
			return false;
		}

		if($.trim(address.val()) == ""){
			errmsg(address, "请输入您的现居地址！");
			return false;
		}

		if($.trim(phone.val()) == ""){
			errmsg(phone, "请输入您的联系电话！");
			return false;
		}else{
			var exp = new RegExp("^1[34578]{1}[0-9]{9}$", "img");
			if(!exp.test(phone.val())){
				errmsg(phone, "请输入正确的手机号码！");
				return false;
			}
		}

		if($.trim(email.val()) == ""){
			errmsg(email, "请输入您的邮箱！");
			return false;
		}else{
			if(!/\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/.test(email.val())){
				errmsg(email, "请输入正确的邮箱地址！");
				return false;
			}
		}

		if(addr.val() == "" || addr.val() == 0){
			errmsg(addr.closest("dd"), "请选择您的意向工作地点！");
			return false;
		}

		if(type.val() == "" || type.val() == 0){
			errmsg(type.closest("dd"), "请选择您的意向职位！");
			return false;
		}

		if(salary.val() == ""){
			errmsg(salary.closest("dd"), "请输入您的期望薪资！");
			return false;
		}

		if(startwork.val() == "" || startwork.val() == 0){
			errmsg(startwork.closest("dd"), "请选择到岗时间！");
			return false;
		}

		if(workyear.val() == ""){
			errmsg(workyear.closest("dd"), "请输入您的工作年限！");
			return false;
		}

		if(educational.val() == "" || educational.val() == 0){
			errmsg(educational.closest("dd"), "请选择您的最高学历！");
			return false;
		}

		var experience = [];
		$("#experience").find(".item").each(function(){
			var t = $(this), company = $.trim(t.find(".company").val()), date1 = t.find(".date1").val(), date2 = t.find(".date2").val(), bumen = $.trim(t.find(".bumen").val()), zhiwei = $.trim(t.find(".zhiwei").val()), neirong = $.trim(t.find(".neirong").val());
			if(company != ""){
				experience.push(company+"$$"+date1+"$$"+date2+"$$"+bumen+"$$"+zhiwei+"$$"+neirong);
			}
		});

		t.addClass("disabled").html("保存中...");

		var url = t.closest("form").attr("action"), data = t.closest("form").serialize() + "&experience=" + experience.join("|||||");

		$.ajax({
			url: url,
			data: data,
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				t.removeClass("disabled").html("保存简历");
				if(data.state == 100){

					$.dialog.tips('保存成功，您现在可以去投递简历啦！', 3, 'success.png');


				}else{
					$.dialog.tips(data.info, 3, 'error.png');
				}
			},
			error: function(){
				t.removeClass("disabled").html("保存简历");
				$.dialog.tips('网络错误，保存失败！', 3, 'error.png');
			}
		});

	});

});
