$(function(){
	// 顶部二维码
	$('.topbarlink li').hover(function(){
		var s = $(this);
		s.find('.pop').show();
	}, function(){
		$(this).find('.pop').hide();
	})

	//上传海报
	function mysub(){
		$("#hbImg").attr('src', templatePath+'images/placeholder_img.png');
		$("#delHb").hide();
		$("#Filedata").prev("span").html("重新选择");

		var data = [];
		data['mod'] = "huodong";
		data['type'] = "thumb";
		data['filetype'] = "image";

		$.ajaxFileUpload({
			url: "/include/upload.inc.php",
			fileElementId: "Filedata",
			dataType: "json",
			data: data,
			success: function(m, l) {
				if (m.state == "SUCCESS") {
					$("#hbImg").attr('src', m.turl);
					$("#litpic").val(m.url);
					$("#delHb").show();
				} else {
					uploadError();
				}
			},
			error: function() {
				uploadError();
			}
		});

	}

	//上传失败、重新上传
	function uploadError(){
		$("#hbImg").attr('src', templatePath+'images/placeholder_img.png');
		$("#Filedata").prev("span").html("添加海报");
		$("#delHb").hide();
		$("#litpic").val("");
	}
	$("#Filedata").bind("change", function(){
		if ($(this).val() == '') return;
		mysub();
	});
	$("#delHb").bind("click", function(){
		uploadError();
	});



	//时间
	var showDate = function(obj){
		WdatePicker({
			el: obj,
			dateFmt: 'yyyy-MM-dd HH:mm',
			doubleCalendar: true,
			isShowClear: false,
			isShowToday: false,
			position: {left: -41}
		});
	};
	$(".f-date").click(function(){
		showDate($(this).find("input").attr("id"));
	});


	//截止时间
	$("#baomingLabel").bind("click", function(){
		if($("#baoming").is(":checked")){
			$("#baomingendObj").stop().slideUp(200);
		}else{
			$("#baomingendObj").stop().slideDown(200);
		}
	});


	//选择区域
	var gzSelAddrNav  = $(".sel-addr-nav"),
		gzSelAddrNav  = $(".sel-addr-nav"),
		gzSelAddrList = $(".sel-addr-list");
	var gzAddrInit = {
		//获取区域
        getAddrArea: function(id){

            //如果是一级区域
            if(!id){
                gzSelAddrNav.html('<li class="curr"><span>请选择</span></li>');
                gzSelAddrList.html('');
            }

            var areaobj = "addrArea"+id;
            if($("#"+areaobj).length == 0){
                gzSelAddrList.append('<ul id="'+areaobj+'"><li class="loading">加载中...</li></ul>');
            }

            gzSelAddrList.find("ul").hide();
            $("#"+areaobj).show();

            $.ajax({
                url: masterDomain + "/include/ajax.php?service=huodong&action=addr",
                data: "type="+id,
                type: "GET",
                dataType: "jsonp",
                success: function (data) {
                    if(data && data.state == 100){
                        var list = data.info, areaList = [];
                        for (var i = 0, area, lower; i < list.length; i++) {
                            area = list[i];
                            lower = area.lower == undefined ? 0 : area.lower;
                            areaList.push('<li data-id="'+area.id+'" data-lower="'+lower+'"'+(!lower ? 'class="n"' : '')+'>'+area.typename+'</li>');
                        }
                        $("#"+areaobj).html(areaList.join(""));
                    }else{
                        $("#"+areaobj).html('<li class="loading">'+data.info+'</li>');
                    }
                },
                error: function(){
                    $("#"+areaobj).html('<li class="loading">网络错误，请重试！</li>');
                }
            });

        }

	}

	//选择区域
	$("#selAddrInp").bind("click", function(){
		if(!$(".sel-addr").is(":visible")){
			$("#selAddr").show();

			if(gzSelAddrList.find("ul").length == 0){
				gzAddrInit.getAddrArea(0);
			}
			return false;
		}
	});

	//选择区域
    gzSelAddrList.delegate("li", "click", function(){
        var t = $(this), id = t.attr("data-id"), addr = t.text(), lower = t.attr("data-lower"), par = t.closest("ul"), index = par.index();
        if(id && addr){

            t.addClass("curr").siblings("li").removeClass("curr");
            gzSelAddrNav.find("li:eq("+index+")").attr("data-id", id).html("<span>"+addr+"</span>");

            //如果有下级
            if(lower != "0"){

                //把子级清掉
                gzSelAddrNav.find("li:eq("+index+")").nextAll("li").remove();
                gzSelAddrList.find("ul:eq("+index+")").nextAll("ul").remove();

                //新增一组
                gzSelAddrNav.find("li:eq("+index+")").removeClass("curr");
                gzSelAddrNav.append('<li class="curr"><span>请选择</span></li>');

                //获取新的子级区域
                gzAddrInit.getAddrArea(id);

            //没有下级
            }else{

                var addrname = [], ids = [];
                gzSelAddrNav.find("li").each(function(){
                    addrname.push($(this).text());
                    ids.push($(this).attr("data-id"));
                });

				$("#city").val(addr);
				$("#addrid").val(id);
				$(".sel-addr").hide();

            }

        }
		return false;
    });

    //区域切换
    gzSelAddrNav.delegate("li", "click", function(){
        var t = $(this), index = t.index();
        t.addClass("curr").siblings("li").removeClass("curr");
        gzSelAddrList.find("ul").hide();
        gzSelAddrList.find("ul:eq("+index+")").show();
		return false;
    });


	//编辑器
	var ue;
	function getEditor(id){
		ue = UE.getEditor(id, {toolbars: [['fullscreen', 'undo', 'redo', '|', 'fontfamily', 'fontsize', '|', 'forecolor', 'bold', 'italic', 'underline', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'insertorderedlist', 'insertunorderedlist', '|', 'simpleupload', 'insertimage', '|', 'link', 'unlink']], initialStyle:'p{line-height:1.5em; font-size:13px; font-family:microsoft yahei;}'});
		ue.on("focus", function() {ue.container.style.borderColor = "#999"});
		ue.on("blur", function() {ue.container.style.borderColor = ""})
	}
	getEditor("body");

	//选择菜单
	$(".f-sel").delegate("a", "click", function(){
		var t = $(this),
			id = t.attr("data-id"),
			text = t.text(),
			sel = t.closest(".f-sel"),
			opt = t.closest(".f-opt"),
			inp = sel.find("input"),
			idobj = t.closest(".f-right").find("input[type=hidden]");
		inp.val(text);
		idobj.val(id);
		opt.hide();

		//活动类型
		if(opt.attr("id") == "selType"){

			idobj.val("");
			$("#selTypeChild .f-opt").remove();
			$("#selTypeChild input").val("");
			$.ajax({
				url: masterDomain+'/include/ajax.php?service=huodong&action=type&type='+id,
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){

						var html = [], info = data.info;
						html.push('<ul class="f-opt">');
						for (var i = 0; i < info.length; i++) {
							html.push('<li><a href="javascript:;" data-id="'+info[i].id+'">'+info[i].typename+'</a></li>');
						}
						html.push('</ul>');
						$("#selTypeChild").append(html.join(""));

					}
				}
			});

		}

		return false;
	});

	$(".f-sel").bind("click", function(){
		var t = $(this), input = t.find("input"), opt = t.find(".f-opt");
		opt.show();
		return false;
	});

	//点击空白区域隐藏选择菜单
	$("body").bind("click", function(){
		$(".f-sel .f-opt, .sel-addr").hide();
	});


	//费用类型
	$(".fee_type a").bind("click", function(){
		var t = $(this), val = t.data("val");
		if(!t.hasClass("curr")){
			t.addClass("curr").siblings("a").removeClass("curr");
			$("#fee").val(val);

			if(val == 1){
				$(".fee_max").stop().slideUp(200);
				$(".fee_body").stop().slideDown(200);
			}else{
				$(".fee_max").stop().slideDown(200);
				$(".fee_body").stop().slideUp(200);
			}
		}
	});

	//增加电子票
	var feeTemp = '<div class="fee_item"><span class="t1"><input type="text" name="fee_title[]" placeholder="费用名称"></span><span class="t2"><input type="text" name="fee_price[]" placeholder="金额，免费请填0"></span><span class="t3"><input type="text" onkeyup="value=value.replace(/[^\\d.]/g, \'\')" name="fee_max[]" placeholder="人数，不填则无限制"></span><span class="t4"><a href="javascript:;"></a></span></div>';
	$("#feeAdd").bind("click", function(){
		$(this).before(feeTemp);
		$(".fee_con .t4 a").show();
	});

	//删除电子票
	$(".fee_con").delegate(".t4 a", "click", function(){
		if($(".fee_con .fee_item").length > 1){
			$(this).closest(".fee_item").remove();

			if($(".fee_con .fee_item").length == 1){
				$(".fee_con .t4 a").hide();
			}
		}
	});



	//数量错误提示
	var errmsgtime;
	function errmsg(div, str){
		$('#errmsg').remove();
		clearTimeout(errmsgtime);
		var top = div.offset().top - 33;
		var left = div.offset().left;

		$('html, body').animate({scrollTop:top}, 300);

		var msgbox = '<div id="errmsg" style="position:absolute;top:' + top + 'px;left:' + left + 'px;height:30px;padding:0 10px;line-height:30px;text-align:center;color:#ff0;font-size:14px;display:none;z-index:99999;background:#f00;">' + str + '</div>';
		$('body').append(msgbox);
		$('#errmsg').fadeIn(300);
		errmsgtime = setTimeout(function(){
			$('#errmsg').fadeOut(300, function(){
				$('#errmsg').remove();
			});
		},3000);
	};

	//发布
	$("#fabuForm").submit(function(event){
		event.preventDefault();

		var action = $(this).attr("action"), tj = $("#tj");

		var typename = $("#typename");
		if(typename.val() == ""){
			errmsg(typename, "请选择活动类型！");
			return false;
		}

		var typename1 = $("#typename1");
		if(typename1.val() == ""){
			errmsg(typename1, "请选择具体分类！");
			return false;
		}

		var typeid = $("#typeid");
		if(typeid.val() == "" || typeid.val() == 0){
			errmsg(typename1, "请选择具体分类！");
			return false;
		}

		var title = $("#title");
		if(title.val() == ""){
			errmsg(title, "请输入活动主题！");
			return false;
		}

		var litpic = $("#litpic");
		if(litpic.val() == ""){
			errmsg($(".add-hb"), "请添加海报！");
			return false;
		}

		var began = $("#began");
		if(began.val() == ""){
			errmsg(began.parent(), "请选择开始时间！");
			return false;
		}

		var end = $("#end");
		if(end.val() == ""){
			errmsg(end.parent(), "请选择结束时间！");
			return false;
		}

		var baomingend = $("#baomingend");
		if(baomingend.val() == "" && !$("#baoming").is(":checked")){
			errmsg(baomingend.parent(), "请选择报名截止时间！");
			return false;
		}

		var addrid = $("#addrid");
		if(addrid.val() == "" || addrid.val() == 0){
			errmsg($("#selAddrInp"), "请选择活动区域！");
			return false;
		}

		var address = $("#address");
		if(address.val() == ""){
			errmsg(address, "请输入活动详细地址！");
			return false;
		}

		ue.sync();
		if(!ue.hasContents()){
			errmsg($(".f-body"), "请输入活动详情！");
			return false;
		}

		//费用验证
		if(id && reg == 0){
			var fee = $("#fee").val(), feeCount = 0;
			if(fee == 1){
				$(".fee_con .fee_item").each(function(){
					var th = $(this), tit = th.find(".t1 input").val(), price = parseFloat(th.find(".t2 input").val()), max = th.find(".t3 input").val();
					if(tit != "" && price != NaN){
						feeCount++
					}
				});
				if(feeCount == 0){
					errmsg($(".fee_body"), "请填写电子票内容！");
					return false;
				}
			}else{
				var max = $("#max");
				if(max.val() == "" || max.val() == 0){
					errmsg(max, "请输入人数上限！");
					return false;
				}
			}
		}


		var contact = $("#contact");
		if(contact.val() == ""){
			errmsg(contact, "请输入主办方联系方式！");
			return false;
		}


		tj.attr("disabled", true).val("提交中...");

		var data = $("#fabuForm").serialize();
		if(id != 0){
			data += "&id="+id;
		}

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					if(id){
						location.href = detailUrl;
					}else{
						fabuPay.check(data, manageUrl, tj);
					}

				}else{
					alert(data.info);
					tj.removeAttr("disabled").val("重新提交");
				}
			},
			error: function(){
				alert(data.info);
				tj.removeAttr("disabled").val("重新提交");
			}
		});



	});


})
