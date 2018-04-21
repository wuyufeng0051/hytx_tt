$(function(){
	// 2016节假日清单，一年一改												
	window.OB = window.OB || {},
	window.OB.RiLi = window.OB.RiLi || {},
	window.OB.RiLi.dateRest = ["0101", "0102", "0103", "0207", "0208", "0209", "0210", "0211", "0212", "0213", "0402", "0403", "0404", "0430", "0501", "0502", "0609", "0610", "0611", "0903", "0915", "0916","0917", "1001", "1002", "1003", "1004", "1005", "1006", "1007"],
	window.OB.RiLi.dateWork = ["0206", "0214", "0612", "0918", "1008","1009"],
	window.OB.RiLi.dateFestival = ["20160101||元旦", "20160208||春节", "20160404||清明节", "20160501||劳动节", "20160609||端午节", "20160903||抗战纪念日", "20160915||中秋节", "20161001||国庆节"],
	window.OB.RiLi.dateAllFestival = ["正月初一|v,春节", "正月十五|v,元宵节", "二月初二|v,龙头节", "五月初五|v,端午节", "七月初七|v,七夕节", "七月十五|v,中元节", "八月十五|v,中秋节", "九月初九|v,重阳节", "十月初一|i,寒衣节", "十月十五|i,下元节", "腊月初八|i,腊八节", "腊月廿三|i,祭灶节", "0202|i,世界湿地日,1996", "0214|v,西洋情人节", "0308|i,国际妇女节,1975", "0315|i,国际消费者权益日,1983", "0422|i,世界地球日,1990", "0501|v,国际劳动节,1889", "0512|i,国际护士节,1912", "0518|i,国际博物馆日,1977", "0605|i,世界环境日,1972", "0623|i,国际奥林匹克日,1948", "0624|i,世界骨质疏松日,1997", "1117|i,世界学生日,1942", "1201|i,世界艾滋病日,1988", "0101|v,元旦", "0312|i,植树节,1979", "0504|i,五四青年节,1939", "0601|v,儿童节,1950", "0701|v,建党节,1941", "0801|v,建军节,1933", "0903|v,抗战胜利纪念日", "0910|v,教师节,1985", "1001|v,国庆节,1949", "1224|v,平安夜", "1225|v,圣诞节", "w:0520|v,母亲节,1913", "w:0630|v,父亲节", "w:1144|v,感恩节(美国)", "w:1021|v,感恩节(加拿大)"];
	// window.OB.RiLi.dateAllFestival = ["",""]
	var e = "https://s.ssl.qhimg.com/!97be6a4c/data/"
	/*本地老黄历库在lhl文件夹，此处是官网调用的*/
	;
	location.protocol == "https:" && (e = "https://s.ssl.qhimg.com/!97be6a4c/data/")
	/*本地老黄历库在lhl文件夹，此处是官网调用的*/
	,
	window.OB.RiLi.hlUrl = {
		2008 : e + "hl2008.js",
		2009 : e + "hl2009.js",
		2010 : e + "hl2010.js",
		2011 : e + "hl2011.js",
		2012 : e + "hl2012.js",
		2013 : e + "hl2013.js",
		2014 : e + "hl2014.js",
		2015 : e + "hl2015.js",
		2016 : e + "hl2016.js",
		2017 : e + "hl2017.js",
		2018 : e + "hl2018.js",
		2019 : e + "hl2019.js",
		2020 : e + "hl2020.js"
	},
	window.OB.RiLi.dateHuochepiao = ["-20151201||20", "20151201||30", "20151202||36", "20151203||42", "20151204||48", "20151205||54", "+20151205||60", "c20151221-20151228||red"],
	window.OB.RiLi.useLunarTicketDay = {
		2016 : {
			"0207": "除夕",
			"0208": "初一",
			"0209": "初二",
			"0210": "初三",
			"0211": "初四",
			"0212": "初五",
			"0213": "初六"
		}
	}

	//结婚吉日
	 function jiazai(){
		$.each(window.OB.RiLi.HuangLi.y2016, function(idx, item){
			if(item.y.indexOf("嫁")>-1){
				if(idx.substr(1,1)==0 && idx.substr(3,1)==0){
					yr = idx.substr(2,1)+"/"+idx.substr(4,1);
				}else if(idx.substr(1,1)==0){
					yr = idx.substr(2,1)+"/"+idx.substr(3,2);
				}else if(idx.substr(3,1)==0){
					yr = idx.substr(1,2)+"/"+idx.substr(4,1);
				}else{
					var yr = idx.substr(1,2)+"/"+idx.substr(3,2);
				}
				yr = "2016/"+yr;
			}
			$('ol.mh-dates-bd li[date="'+yr+'"]').css("backgroundColor","#d3fcda").append('<span class="jiri"></span>')
			if($('ol.mh-dates-bd li[date="'+yr+'"]').hasClass("mh-vacation") || $('ol.mh-dates-bd li[date="'+yr+'"]').hasClass("mh-work")){
				$('ol.mh-dates-bd li[date="'+yr+'"]').find("span.jiri").css("left","22px")
			}
		})
	}
	setTimeout(jiazai,200);
	$("#mohe-rili .mh-rili-widget .jiriSelect a.jie").click(function(){
		var t=$(this);
		t.addClass("on").siblings("a").removeClass("on");
		$("ol.mh-dates-bd li span.jiri").closest("li").css("backgroundColor","#fff");
		$("#mohe-rili .mh-rili-widget .mh-dates-bd .mh-cross-month").css("backgroundColor","#f5f5f5");
		$("ol.mh-dates-bd li span.jiri").remove();
		jiazai();
	})

	// 订婚吉日
	$("#mohe-rili .mh-rili-widget .jiriSelect a.ding").click(function(){
		var t=$(this);
		t.addClass("on").siblings("a").removeClass("on");
		$("ol.mh-dates-bd li span.jiri").closest("li").css("backgroundColor","#fff");
		$("#mohe-rili .mh-rili-widget .mh-dates-bd .mh-cross-month").css("backgroundColor","#f5f5f5");
		$("ol.mh-dates-bd li span.jiri").remove();
		$.each(window.OB.RiLi.HuangLi.y2016, function(idx, item){
			if(item.y.indexOf("订盟")>-1){
				var yr;
				if(idx.substr(1,1)==0 && idx.substr(3,1)==0){
					yr=idx.substr(2,1)+"/"+idx.substr(4,1);
				}else if(idx.substr(1,1)==0){
					yr=idx.substr(2,1)+"/"+idx.substr(3,2);
				}else if(idx.substr(3,1)==0){
					yr=idx.substr(1,2)+"/"+idx.substr(4,1);
				}else{
					yr = idx.substr(1,2)+"/"+idx.substr(3,2);
				}
				yr="2016/"+yr;
				$('ol.mh-dates-bd li[date="'+yr+'"]').css("backgroundColor","#fceecc").append('<span class="jiri"></span>')
				if($('ol.mh-dates-bd li[date="'+yr+'"]').hasClass("mh-vacation") || $('ol.mh-dates-bd li[date="'+yr+'"]').hasClass("mh-work")){
					$('ol.mh-dates-bd li[date="'+yr+'"]').find("span.jiri").css("left","22px");
				}
			}
		})
	})

})

