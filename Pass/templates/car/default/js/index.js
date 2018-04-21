$(function(){

	$("img").scrollLoading();

	//价格Tab切换
	$(".car-price .tabs li").hover(function(){
		var t = $(this), index = t.index();
		t.siblings("li").removeClass("curr");
		t.addClass("curr");

		$(".car-price .item").hide();
		$(".car-price .item:eq("+index+")").show();
	});

	//热门车鼠标经过效果
	$(".car-price dl").bind("hover", function(){
		$(this).siblings("dl").removeClass("curr");
		$(this).siblings("dl").each(function(){
			$(this).find(".conl").hide();
		});
		$(this).addClass("curr");
		if($(this).find("ul").length > 1){
			$(this).find(".conl").show();
		}
	});

	$(".car-price .item").each(function(index){
		var dl = $(this).find("dl:eq(0)");
		dl.addClass("curr");
		if(dl.find("ul").length > 1){
			dl.find(".conl").show();
		}
	});

	//热门车左右切换
	$(".car-price .conl a").bind("click", function(){
		var t = $(this), par = t.closest("dd"), uls = par.find("ul"), index = par.find("ul:visible").index();
		uls.stop().hide(300);
		if(t.hasClass("con-l")){
			setTimeout(function(){
				index == 0 ? uls.eq(uls.length-1).stop().show(300) : uls.eq(index-1).stop().show(300);
			}, 300);
		}else{
			setTimeout(function(){
				index == uls.length-1 ? uls.eq(0).stop().show(300) : uls.eq(index+1).stop().show(300);
			}, 100);			
		}
	});

	$("#tpage").html($("#slide .slideshow-item").length);
	
	//幻灯
	$("#slide").cycle({ 
		fx:	'scrollHorz', 
		speed:	'fast', 
		next:	'#slidebtn_next', 
		prev:	'#slidebtn_prev',
		pause: true,
		after:	function (curr, next, opts) {
					var index = opts.currSlide;
					$("#atpage").html(index+1);
				}
	});

	//热门车型/最新上市
	$("#hn .mt li").hover(function(){
		var t = $(this), index = t.index();
		t.siblings("li").removeClass("curr");
		t.addClass("curr");
		$("#hn .data .item").hide();
		$("#hn .data .item:eq("+index+")").show();
	});


	//精彩图库选择品牌、车型
	$("#tt .sel").bind("click", function(){
		var t = $(this), id = t.find("span").attr("id");

		if(t.find(".popup-sel").html() == "" && id == "cBrand"){
			getBrand(t);
		}

		$("#tt .sel").find(".popup-sel").hide();
		t.find(".popup-sel").show();
		return false;
	});

	//字母检索
	$("#tt .sel").delegate(".pinpzm a", "click", function(e){
		$(this).closest(".pinpzm").find(".on").removeClass("on");
		$(this).parent().addClass("on");

		var obj = $(this).closest(".popup-sel").attr("id");
		if($("#"+obj + $(this).html()).html() != undefined){
			$(this).closest(".popup-sel").find(".pinp_main").get(0).scrollTop = $("#" + obj + $(this).html()).get(0).offsetTop;
		}
		e.stopPropagation();
		return false;
	});

	//选择结果
	$("#tt .sel").delegate(".pinp_main a", "click", function(e){
		var t = $(this);
		t.closest(".pinp_main").find(".on").removeClass("on");
		t.addClass("on");

		var id = t.attr("data"), text = t.html().substring(2), brand = 0, car = 1, obj = t.closest(".popup-sel").attr("id").replace("Mast_", "");

		//车系
		if(obj == "Car"){
			text = t.html();
		}else{
			brand = 1;
		}

		$("#c"+obj)
			.attr("data-val", id)
			.html(text);

		if(brand){
			//初始化车系信息
			$("#cCar")
				.attr("data-val", 0)
				.html('选车型');

			getCars(t, $("#cBrand").attr("data-val"));
		}

		t.closest(".popup-sel").hide();
		return false;
	});

	$("#tt .sel").delegate(".cxtit a", "click", function(e){
		$("#cCar")
			.attr("data-val", 0)
			.html('全部车型');

		t.closest(".popup-sel").hide();
	});

	$(document).click(function (e) {
		$("#tt").find(".popup-sel").hide();
	});

	//精彩图库
	$("#tt .list").cycle({ 
		fx:	'scrollHorz', 
		speed:	'fast', 
		next:	'#ttr', 
		prev:	'#ttl',
		pause: true
	});

	//买车
	$("#buy .slidebar li").hover(function(){
		var t = $(this), index = t.index();
		t.siblings("li").removeClass("curr");
		t.addClass("curr");
		t.closest(".data").find(".list .item").hide();
		t.closest(".data").find(".list .item:eq("+index+")").show();
	});

	//法规幻灯
	$("#fgSlide").cycle({ 
		fx:	'scrollHorz', 
		speed: 'fast', 
		pager: '#fgsc .slidebtn',
		pause: true
	});

	//页面改变尺寸重新对特效的宽高赋值
	$(window).resize(function(){
		var screenwidth = window.innerWidth || document.body.clientWidth;
		if(screenwidth < criticalPoint){
			//大图幻灯
			$("#slide .slideshow-item").css({"width": "625px", "height": "366px"});
			$("#slide").cycle({ 
				fx:	'scrollHorz', 
				speed: 'fast', 
				width: "625px",
				after:	function (curr, next, opts) {
							var index = opts.currSlide;
							$("#atpage").html(index+1);
						}
			});

			//精彩图库
			$("#tt .list .item").css({"width": "1000px", "height": "366px"});
			$("#tt .list").cycle({ 
				fx:	'scrollHorz', 
				speed:	'fast',
				width: "1000px"
			});

		}else{
			//大图幻灯
			$("#slide .slideshow-item").css({"width": "725px", "height": "425px"});
			$("#slide").cycle({ 
				fx:	'scrollHorz',
				speed: 'fast', 
				width: "725px",
				after:	function (curr, next, opts) {
							var index = opts.currSlide;
							$("#atpage").html(index+1);
						}
			});

			//精彩图库
			$("#tt .list .item").css({"width": "1200px", "height": "440px"});
			$("#tt .list").cycle({ 
				fx:	'scrollHorz', 
				speed:	'fast',
				width: "1200px"
			});
		}
	});

});


//获取品牌
function getBrand(t){
	$.ajax({
		url: "/include/ajax.php?service=car&action=brandAsc",
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state == 100){

				var data = data.info;
				var type = "Brand";
				var strChar = "<div class=\"pinpzm\">";
				var strBrand = " <div class=\"pinp_rit\"><div class=\"pinp_main\">";
				var Chr = "";
				for (var i = 0, len = data.length; i < len; i++) {
					var letter = data[i].letter;
					var on = "";
					if (Chr != letter) {
						if (Chr == "") {
							strChar += "<div class=\"on\"><a href=\"javascript:;\">" + letter + "</a></div>";
							strBrand += "<div class=\"pinp_main_zm\" id=\"Mast_" + type + letter + "\">";
						} else {
							strChar += "<div><a href=\"javascript:;\">" + letter + "</a></div>";
							strBrand += "</div><div class=\"pinp_main_zm\" id=\"Mast_" + type + letter + "\">";
						}
					}
					strBrand += "<p><a href=\"javascript:;\" data=\"" + data[i].id + "\">" + letter + " " + data[i].typename + "</a></p>";
					Chr = letter;
				}
				strChar += "</div>"
				strBrand += "</div></div></div>";

				$("#Mast_Brand").html(strChar + strBrand);
				
			}else{
				alert('获取失败，请重试！');
			}
		},
		error: function(){
			alert('网络错误，请重试！');
		}
	});

}

//获取车系
function getCars(t, id){
	$.ajax({
		url: "/include/ajax.php?service=car&action=brandCars&id="+id,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state == 100){

				var data = data.info;
				var strSerial = "<div class=\"cxtit\">" + $("#cBrand").text() + "</div><div class=\"pinp_main\" style=\"height:auto;\">";
				var len = data.length;
				var groupName = "";
				for (var i = 0; i < len; i++) {
					var on = "";
					if(data[i].GroupName != null){
						if (groupName != data[i].GroupName) {
							if (groupName == "") {
								strSerial += "<div class=\"pinp_main_zm\"><p><i>" + data[i].GroupName + "</i></p>";
							} else {
								strSerial += "</div><div class=\"pinp_main_zm\"><p><i>" + data[i].GroupName + "</i></p>";
							}
						}
					}else{
						if (groupName != null) {
							strSerial += "<div class=\"pinp_main_zm\">";
						}
					}
					strSerial += "<p><a href=\"javascript:;\" data=\"" + data[i].Value + "\">" + data[i].Text + "</a></p>";
					groupName = data[i].GroupName;
				}

				strSerial += "</div></div>";

				$("#Mast_Car").html(strSerial);
				
			}else{
				alert('获取失败，请重试！');
			}
		},
		error: function(){
			alert('网络错误，请重试！');
		}
	});

}