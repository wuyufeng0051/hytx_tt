$(function(){

	//大图幻灯
	$("#slide").cycle({
		pager: '#slidebtn'
	});

	$("#slidebtn").delegate("a", "click", function(){
		$(".banner .stab").animate({"height": "35px"}, 200);
		$(".banner .stab").addClass("ofh");
		$("#slidebtn").animate({"bottom": "45px"}, 200);
		$(".banner .tab li").removeClass("curr");
		$(".banner .con").hide();
		$(".banner .stab .l").addClass("s");
	});

	$(".banner .tab li").bind("click", function(){
		$(".banner .stab").animate({"height": "103px"}, 200);
		$(".banner .stab").removeClass("ofh");
		$("#slidebtn").animate({"bottom": "113px"}, 200);
		$(".banner .stab .l").removeClass("s");

		var t = $(this), index = t.index();
		t.siblings("li").removeClass("curr");
		t.addClass("curr");
		$(".banner .con").hide();
		$(".banner .con:eq("+index+")").fadeIn("100");
	});

	$(".stab label").bind("click", function(){
		$(this).parent().siblings(".sel").find(".popup-sel").hide();
		$(this).parent().find(".popup-sel").toggle();
		return false;
	});

	//搜索下拉
	$(".stab .popup-sel").delegate("a", "click", function(){
		if($(this).closest(".popup-sel").find(".areaList").html() == undefined){
			var id = $(this).attr("data-id"), txt = $(this).text();
			$(this).closest(".sel").find("label")
				.attr("data-val", id)
				.html(txt+"<s></s>");
			$(this).closest(".popup-sel").hide();
			return false;
		}
	});

	var areaArr = [];

	//选择区域 s
	$(".stab .addr label").bind("click", function(){
		var content = [], par = $(this).parent().find(".popup-sel");
		$(".stab .addr").find(".areaList").hide();

		if(areaArr.length > 0 && par.find(".areaList").html() != undefined){
			content.push(createArea(par));

		}else{
			content.push('<p align="center">加载中...</p>');
		}

		if(par.find(".areaList").html() == undefined){
			createAreaObj(par, content.join(""));
		}

		par.find(".areaList").show();

		return false;

	});

	function createAreaObj(obj, content){
		obj.append('<div class="areaList fn-clear">'+content+'</div>');

		var areaList = obj.find(".areaList");

		if(obj.find(".areaList").html().indexOf("加载中") > -1){
			areaList.html(content);
		}

		areaList.show();

		if(areaArr.length <= 0){
			$.ajax({
				url: "/include/ajax.php?service=marry&action=addr&son=1",
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data.state == 100){

						areaArr = data.info;
						areaList.html(createArea(obj));

					}else{
						areaList.html('<p align="center"><font size="3" color="#ff0000">'+data.info+'</font></p>');
					}
				},
				error: function(){
					areaList.html('<p align="center"><font size="3" color="#ff0000">加载失败，请稍后访问！</font></p>');
				}
			});
		}else{
			areaList.html(createArea(obj));
		}
	}

	function createArea(obj){
		if(obj.find(".areaList").html().indexOf("加载中") > -1 && areaArr){
			var content = [];
			var data = areaArr;
			var subdata = [], f = 0, i = true;

			for(var a = 0; a < data.length; a++){

				content.push('<div class="sub-data" data-id="'+a+'" title="'+data[a].typename+'"><a href="javascript:;">'+data[a].typename+'</a><i></i></div>');
				lower2 = data[a].lower;

				subdata.push('<ul class="fn-clear area'+a+'">');
				for(var c = 0; c < lower2.length; c++){
					subdata.push('<li><a href="javascript:;" data-id="'+lower2[c].id+'" data-name="'+lower2[c].typename+'" title="'+lower2[c].typename+'">'+lower2[c].typename+'</a></li>');
				}
				subdata.push('</ul>');

				f++;

				if(f == 5 || a == data.length-1){

					if(a == data.length-1 && f < 5){
						i = false;
						content.push('<div class="sub-data no"><a href="javascript:;">不限</a></div>');
					}

					content.push(subdata.join(""));
					subdata = [];
					f = 0;
				}

			}

			if(i){
				content.push('<div class="sub-data no"><a href="javascript:;">不限</a></div>');
			}

			return content.join("");
		}
	}

	//选择地区
	$(".stab .addr").delegate('.sub-data', 'click', function () {
		var t = $(this), id = t.attr("data-id"), par = t.closest(".areaList");
		if(t.hasClass("no")){
			t.closest(".sel").find("label")
				.attr("data-id", 0)
				.attr("title", "不限地址")
				.html("不限地址<s></s>");

			t.find(".areaList").hide();

		}else{
			if(t.hasClass("curr")){
				t.removeClass("curr");
				par.find(".sub-data").removeClass("curr");
				par.find("ul").stop().slideUp("fast");
			}else{
				par.find(".sub-data").removeClass("curr");
				par.find("ul").stop().slideUp("fast");

				t.addClass("curr");
				t.parent().find(".area"+id).stop().slideDown("fast");
			}
			return false;
		}
	});

	//确定地区
	$(".stab .addr").delegate('li a', 'click', function () {
		var t = $(this), id = t.attr("data-id"), name = t.attr('data-name'), pname = t.closest(".areaList").find(".curr a").text();
		if(id && name){
			name = pname + " " + name;
			t.closest(".sel").find("label")
				.attr("data-id", id)
				.attr("title", name)
				.html(name+"<s></s>");
		}
	});

	//选择区域 e

	$(document).click(function (e) {
		$(".stab .sel").find(".popup-sel").hide();
	});

	//特别推荐换一换效果
	var arartta2= window['arartta2'] = function(o){
		return new das2(o);
	}
	das2 = function(o){
		this.obj = $('#'+o.obj);
		this.bnt = $('#'+o.bnt);
		this.showLi = this.obj.find('li');
		this.current = 0;
		this.myTimersc = '';
		this.init()
	}
	das2.prototype = {
		chgPic:function(n){
			var _this = this;
			_this.showLi.each(function(){
				var width = $(this).width();
				$(this).find('.list:not(:animated)').animate({left: -(n * width) + "px"}, {easing:"easeInOutExpo"}, 1500);
			});
		},
		init:function(){
			var _this = this;
			this.bnt.bind("click",function(){
				_this.current++;
				if (_this.current > 2) {
					_this.current = 0 ;
				}
				_this.chgPic(_this.current);
			});
		}
	}


	//异步获取酒店推荐数据
	$.ajax({
		url: "/include/ajax.php?service=marry&action=hotel&property=r&pageSize=4",
		type: "POST",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state == 100){
				var list = data.info.list, html = [], li = [];
				for(var i = 0; i < list.length; i++){
					html.push('<li><div class="list"><div class="item"><a href="'+list[i].url+'" target="_blank" class="pic"><img alt="'+list[i].title+'" src="'+huoniao.changeFileSize(list[i].litpic, "middle")+'" /></a><h5><a href="'+list[i].url+'" target="_blank" title="'+list[i].title+'">'+list[i].title+'</a></h5><p>'+list[i].note+'</p></div></div></li>');
				}
				$("#recList").html(html.join(""));
				$("#recQh").fadeIn();

				//异步获取摄影推荐数据
				$.ajax({
					url: "/include/ajax.php?service=marry&action=wedding&property=r&pageSize=4",
					type: "POST",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							var list = data.info.list, html = [], li = [];
							for(var i = 0; i < list.length; i++){
								$("#recList li:eq("+i+") .list").append('<div class="item wedding"><a href="'+list[i].url+'" target="_blank" class="pic"><img alt="'+list[i].title+'" src="'+huoniao.changeFileSize(list[i]['works'].litpic, "o_large")+'" /></a><h5><a href="'+list[i].url+'" target="_blank" title="'+list[i].title+'">'+list[i].title+'</a></h5><p>'+list[i]['deal'].note+'</p></div>');
							}


							//异步获取婚庆推荐数据
							$.ajax({
								url: "/include/ajax.php?service=marry&action=ritual&property=r&pageSize=4",
								type: "POST",
								dataType: "jsonp",
								success: function (data) {
									if(data && data.state == 100){
										var list = data.info.list, html = [], li = [];
										for(var i = 0; i < list.length; i++){
											$("#recList li:eq("+i+") .list").append('<div class="item ritual"><a href="'+list[i].url+'" target="_blank" class="pic"><img alt="'+list[i].title+'" src="'+huoniao.changeFileSize(list[i]['works'].litpic, "o_large")+'" /></a><h5><a href="'+list[i].url+'" target="_blank" title="'+list[i].title+'">'+list[i].title+'</a></h5><p>'+list[i]['deal'].note+'</p></div>');
										}
									}
								}
							});


							arartta2({
								bnt:'recQh',
								obj:'recList'
							});
						}
					}
				});

			}else{
				$("#recList .loading").html("暂无相关信息！");
			}
		}
	});

	//热门信息
	$(".hlist li").hover(function(){
		$(this).siblings("li").find(".i").hide();
		$(this).find(".i").show();
	});

	//婚尚资讯
	$(".news .tabs li").hover(function(){
		var t = $(this), index = t.index();

		t.siblings("li").removeClass("curr");
		t.addClass("curr");

		$(".news .list ul").hide();
		$(".news .list ul:eq("+index+")").show();
	});

});
