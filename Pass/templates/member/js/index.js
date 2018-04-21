var p = [], path1 = [], path2 = [], p_mouseOver = [], p_mouseOut = [],
		banner = $(".banner"), atpage = 1, totalCount = 0, pageSize = 9, loadType = 1, covertypeid = "rec",
		defaultImg = banner.css("background-image").replace("url(", "").replace(")", "");

$(function(){

	//自定义封面图片
	$("#customBanner").bind("click", function(){
		$('html, body').animate({scrollTop: $(".container").offset().top}, 300);

		var cover = banner.find(".custom-cover");
		if(cover.size() > 0) {
			cover.show();
			return;
		}

		var html = [];
		html.push('<div class="custom-cover">');
		html.push('<div class="tit">');
		html.push('<h5>'+langData['siteConfig'][23][108]+'</h5>');
		html.push('<a href="javascript:;" class="close" title="'+langData['siteConfig'][6][15]+'">'+langData['siteConfig'][6][15]+'</a>');
		html.push('</div>');
		html.push('<div class="cont"><p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />'+langData['siteConfig'][20][184]+'...</p></div>');
		html.push('<div class="foot"><input type="button" value="'+langData['siteConfig'][6][27]+'" class="save" /><input type="button" value="'+langData['siteConfig'][6][12]+'" class="cancel" /></div>');
		html.push('</div>');

		banner.append(html.join(""));
		getList();

	});

	banner.delegate(".custom-cover .save", "click", function(){
		var id = banner.find(".cover-list .curr").attr("data-id");
		if(id == undefined){
			alert(langData['siteConfig'][20][527]);
		}else{
			$(this).val(langData['siteConfig'][6][35]+"...").attr("disabled", true);
			$.post("/include/ajax.php?service=member&action=updateCoverBg", {id: id}, function(){
				$(this).val(langData['siteConfig'][6][39]);
				$(".custom-cover").hide();
			});
		}
	});

	banner.delegate(".close, .cancel", "click", function(){
		$(".custom-cover").hide();
		banner.css("background-image", "url("+defaultImg+")");
	});

	banner.delegate(".cover-type li", "click", function(){
		var t = $(this), id = t.attr("data-id");
		if(id && !t.hasClass("curr")){
			covertypeid = id;
			t.addClass("curr").siblings("li").removeClass("curr");
			atpage = 1;
			getList();
		}
	});

	banner.delegate(".cover-list li", "click", function(){
		var t = $(this), pic = t.attr("data-pic");
		t.addClass("curr").siblings("li").removeClass("curr");
		banner.css("background-image", "url("+pic+")");
	});



	//环状图  参数：画图区域id
	function DdmChart(canvasId){
		var _R = Raphael;
		var _canvas = document.getElementById(canvasId);
		this._paper = _R(_canvas);
	}

	DdmChart.prototype.Doughnut = function(data, setting){
		var _this = this;
		var rad = Math.PI / 180; //角度、弧度换算
		var dataLength = data.length;
		var total = 0;
		for(i = 0; i < dataLength; i++) total+=Number(data[i].value); //求data.value和
		var s = 0, e = 0; //起始，结束角百分度
		this._paper.setStart();
		for(var i = 0; i < dataLength; i++){
			(function(i){
				//当前部分的结束角
				e = data[i].value / total;
				//基础路径与hover路径
				path1.push(doughnut_path(setting.cx, setting.cy, setting.r1, setting.r2, s*359.99999, (s+e)*359.99999)),
				path2.push(doughnut_path_hover(setting.cx, setting.cy, setting.r1, setting.r2, s*359.99999, (s+e)*359.99999));
				p.push(_this._paper.path(path1[i]).attr({"fill":data[i].color,"stroke":"#ffffff"}).attr('stroke-width', '1.5'));
				p_mouseOver.push(function(){p[i].animate({"path":path2[i]},200); $("#chart-detail").find("li:eq("+i+")").addClass("curr");}),
				p_mouseOut.push(function(){p[i].animate({"path":path1[i]},200); $("#chart-detail").find("li").removeClass("curr");});
				s += e;
			})(i);
		}
		var st = this._paper.setFinish();
		return st;

		//绘制环状图(返回path)
		function doughnut_path(cx,cy,r1,r2,startAngle,endAngle){
			var x1 = cx + r1 * Math.cos(-startAngle * rad), y1 = cy + r1 * Math.sin(-startAngle * rad),
			x2 =  cx + r2 * Math.cos(-startAngle * rad), y2 = cy + r2 * Math.sin(-startAngle * rad),
			x3 =  cx + r2 * Math.cos(-endAngle * rad), y3 = cy + r2 * Math.sin(-endAngle * rad),
			x4 =  cx + r1 * Math.cos(-endAngle * rad), y4 = cy + r1 * Math.sin(-endAngle * rad);	  //四点坐标
			return ["M",x2,y2,"A",r2,r2, 0, +(endAngle - startAngle > 180),0,x3,y3,"L",x4,y4,"A",r1,r1,0,+( endAngle - startAngle > 180),1,x1,y1,"z"];
		}
		function doughnut_path_hover(cx,cy,r1,r2,startAngle,endAngle){
			// r1 = r1;
			r2 = r2 + 8;
			var x1 = cx + r1 * Math.cos(-startAngle * rad), y1 = cy + r1 * Math.sin(-startAngle * rad),
			x2 =  cx + r2 * Math.cos(-startAngle * rad), y2 = cy + r2 * Math.sin(-startAngle * rad),
			x3 =  cx + r2 * Math.cos(-endAngle * rad), y3 = cy + r2 * Math.sin(-endAngle * rad),
			x4 =  cx + r1 * Math.cos(-endAngle * rad), y4 = cy + r1 * Math.sin(-endAngle * rad);	  //四点坐标
			return ["M",x2,y2,"A",r2,r2, 0, +(endAngle - startAngle > 180),0,x3,y3,"L",x4,y4,"A",r1,r1,0,+( endAngle - startAngle > 180),1,x1,y1,"z"];
		}
		//绘制环状图 end
	}

	var doughnutSetting = {"cx": 110,	"cy": 110, "r1": 77, "r2": 99};
	var data = [];
	data.push({
		"value": money,
		"color": "#64b2e9"
	});
	data.push({
		"value": freeze,
		"color": "#ffb324"
	});
	data.push({
		"value": point,
		"color": "#81cb50"
	});

	if(money == 0.00 && freeze == 0.00 && point == 0){
		data.push({
			"value": 1,
			"color": "#ccc"
		});
	}


	var chart = new DdmChart("chart");
	chart.Doughnut(data, doughnutSetting);

	//鼠标经过效果
	for(i = 0; i < p.length; i++){
		p[i].mouseover(p_mouseOver[i]);
		p[i].mouseout(p_mouseOut[i]);
	}

	$("#chart-detail li").hover(function(){
		var i = $(this).index();
		p_mouseOver[i]();
	}, function(){
		var i = $(this).index();
		p_mouseOut[i]();
	});

	//提示popup
	$(".pop").hover(function(){
		$(this).find(".popup").show();
	}, function(){
		$(this).find(".popup").hide();
	});

	//系统消息浮动层
	$(".message dl").hover(function(){
		$(this).addClass("curr").siblings("dl").removeClass("curr");
		$(this).find("ul").show();
	}, function(){
		$(this).removeClass("curr");
		$(".message .con").find("ul").hide();
	});

});


//获取天气预报
$.ajax({
	url: "/include/ajax.php?service=siteConfig&action=getWeatherApi&day=1&skin=6",
	dataType: "json",
	success: function (data) {
		if(data && data.state == 100){
			$(".date-weather ul").append(data.info);
		}
	}
});



//异步获取封面图片
function getList(){

	banner.find(".custom-cover .cover-list").html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />'+langData['siteConfig'][20][184]+'...</p>');

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=customCoverBg&loadtype="+loadType+"&typeid="+covertypeid+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state == 100){

				if(loadType){
					var typeList = data.info.typeList, typeHtml = [];
					typeHtml.push('<li class="curr" data-id="rec"><a href="javascript:;">'+langData['siteConfig'][23][109]+'</a></li>');
					for(var i = 0; i < typeList.length; i++){
						typeHtml.push('<li data-id="'+typeList[i].id+'"><a href="javascript:;">'+typeList[i].typename+'</a></li>');
					}
					banner.find(".custom-cover .cont").html('<ul class="cover-type fn-clear">'+typeHtml.join("")+'</ul>');
					banner.find(".custom-cover .cont").append('<ul class="cover-list fn-clear"></ul><div class="pagination fn-clear"></div>');
				}
				loadType = 0;

				var list = data.info.list, coverList = [];
				totalCount = data.info.pageInfo.totalCount;

				for(var i = 0; i < list.length; i++){
					var cla = "";
					if(defaultImg == list[i].big){
						cla = ' class="curr';
					}
					coverList.push('<li'+cla+' data-id="'+list[i].id+'" data-pic="'+list[i].big+'"><a href="javascript:;"><img src="'+list[i].litpic+'" /><div class="txt"><p>'+list[i].title+'</p><span></span></div><i></i></a></li>');
				}
				banner.find(".custom-cover .cover-list").html(coverList.join(""));
				showPageInfo();

			}else{
				loadCoverBgError(data.info);
			}
		},
		error: function(){
			loadCoverBgError(langData['siteConfig'][20][528]);
		}
	});

}

function loadCoverBgError(info){
	banner.find(".custom-cover .cont").html('<p class="loading">'+info+'</p>');
}
