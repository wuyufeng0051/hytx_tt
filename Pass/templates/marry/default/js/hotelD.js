$(function(){

	//第一部分幻灯片
	$(".slider").slide({mainCell:".bd ul",autoPlay:true,switchLoad:"_src",effect:"fold"});

	//大图幻灯片
	function allJ(oPic,oList,oPrevTop,oNextTop,num,valx){
		function getStyle(obj, attr){
			if(obj.currentStyle){
				return obj.currentStyle[attr];
			}else{
				return getComputedStyle(obj, false)[attr];
			}
		}
		function Animate(obj, json){
			if(obj.timer){
				clearInterval(obj.timer);
			}
			obj.timer = setInterval(function(){
				for(var attr in json){
					var iCur = parseInt(getStyle(obj, attr));
					iCur = iCur ? iCur : 0;
					var iSpeed = (json[attr] - iCur) / 5;
					iSpeed = iSpeed > 0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
					obj.style[attr] = iCur + iSpeed + 'px';
					if(iCur == json[attr]){
						clearInterval(obj.timer);
					}
				}
			}, 30);
		}
		// alert(oPic.innerHTML)
		var oPicLi = oPic.getElementsByTagName("li");
		var oListLi = oList.getElementsByTagName("li");
		var len1 = oPicLi.length;
		var len2 = oListLi.length;

		var oPicUl = oPic.getElementsByTagName("ul")[0];
		var oListUl = oList.getElementsByTagName("ul")[0];
		var w1 = oPicLi[0].offsetWidth;
		var w2 = oListLi[0].offsetWidth;

		oPicUl.style.width = w1 * len1 + "px";
		oListUl.style.width = w2 * len2 + "px";
		var index = 0;
		var num2 = Math.ceil(num / 2);

		valx.siblings("em").text(len2);
		function Change(){
			Animate(oPicUl, {left: - index * w1});

			if(num==9){
				if(index < num2){
					Animate(oListUl, {left: 0});
				}else if(index + num2 <= len2){
						Animate(oListUl, {left: - (index - num2+1 ) * w2});
				}else{
					Animate(oListUl, {left: - (len2 - num) * w2});
				}
			}else{
				if(index <= num2){
					Animate(oListUl, {left: 0});
				}else if(index + num2 <= len2){
						Animate(oListUl, {left: - (index - num2 ) * w2});
				}else{
					Animate(oListUl, {left: - (len2 - num) * w2});
				}
			}

			for (var i = 0; i < len2; i++) {
				oListLi[i].className = "";
				if(i == index){
					oListLi[i].className = "on";
					valx.text(i+1);
				}
			}
		}

		oNextTop.onclick = function(){
			index ++;
			index = index == len2 ? 0 : index;
			Change();
		}

		oPrevTop.onmouseover = oNextTop.onmouseover = function(){
			clearInterval(timer);
			}
		oPrevTop.onmouseout = oNextTop.onmouseout = function(){
			timer=setInterval(autoPlay,4000);
			}

		oPrevTop.onclick = function(){
			index --;
			index = index == -1 ? len2 -1 : index;
			Change();
		}
		var timer=null;
		timer=setInterval(autoPlay,4000);
		function autoPlay(){
			    index ++;
				index = index == len2 ? 0 : index;
				Change();
			}

		for (var i = 0; i < len2; i++) {
			oListLi[i].index = i;
			oListLi[i].onclick = function(){
				index = this.index;
				Change();
			}
		}
	}
	function G(s){
		return document.getElementById(s);
	}

	//场馆相册
	var oPic0 = G("picBox");
	var oList0 = G("listBox");
	var oPrevTop0 = G("prevTop");
	var oNextTop0 = G("nextTop");
	var num0=6,valx0=$(".cgxc .picBox p i");
	allJ(oPic0,oList0,oPrevTop0,oNextTop0,num0,valx0);

	//场馆地址部分百度地图
	var map3 = new BMap.Map("allmap");
	var point = new BMap.Point(lng, lat);
	var marker = new BMap.Marker(point);
	map3.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_SMALL}));
	map3.addOverlay(marker);
	map3.centerAndZoom(point, 15);
	var opts = {width: 200, title: '<strong>'+title+'</strong>'};
	var infoWindow = new BMap.InfoWindow("地址："+address, opts);
	marker.addEventListener("click", function(){
		map3.openInfoWindow(infoWindow,point);
	});


	//场馆全景
	var panorama = new BMap.Panorama('panorama'); //默认为显示导航控件
	panorama.setPosition(new BMap.Point(116.316169, 40.005567));
	panorama.setOptions({
	    navigationControl: false //隐藏导航控件
	});
	//解决IE8之类不支持getElementsByClassName
	if (!document.getElementsByClassName) {
	    document.getElementsByClassName = function (className, element){
	        var children = (element || document).getElementsByTagName('*');
	        var elements = new Array();
	        for (var i = 0; i < children.length; i++) {
	            var child = children[i];
	            var classNames = child.className.split(' ');
	            for (var j = 0; j < classNames.length; j++) {
	                if (classNames[j] == className) {
	                    elements.push(child);
	                    break;
	                }
	            }
	        }
	        return elements;
	    };
	}
	//评论部分
	$(".comment1 .more span.mm").click(function(){
		var t = $(this), list = t.closest(".list"), s = t.closest(".list").find(".slideBox"), p = t.closest(".list").find("p.count");
		s.slideDown();
		t.hide().siblings().show();
		p.show();
		n = list.index();
		l = s.find(".upBox li").length;
		p.find("span").text(l);
		var oPic2 = document.getElementsByClassName("downBox")[n];
		var oList2 = document.getElementsByClassName("upBox")[n];
		var oPrevTop2 = document.getElementsByClassName("prevx2")[n];
		var oNextTop2 = document.getElementsByClassName("nextx2")[n];
		var num2=9,valx2=$(".cgxc .picBox p i");
		allJ(oPic2,oList2,oPrevTop2,oNextTop2,num2,valx2);
	})

	$(".comment1 .more span.ss").click(function(){
		var t=$(this), s=t.closest(".list").find(".slideBox"), p=t.closest(".list").find("p.count");
		s.slideUp();
		t.hide().siblings().show();
		p.hide();
	})

	//星星打分
    var stars = [
        ['star_b1.png', 'star_b2.png', 'star_b2.png', 'star_b2.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b2.png', 'star_b2.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b2.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b1.png'],
    ];

    $(".comment li").find("img").hover(function() {
        var obj = $(this);
        var index = obj.index();
        var li = obj.closest("li");
        var star_area_index = li.index();
        for (var i = 0; i < 5; i++) {
            li.find("img").eq(i).attr("src", templatePath+"images/" + stars[index][i]);//切换每个星星
        }
    }, function() {
        var obj = $(this);
        var li = obj.closest("li");
        var star_area_index = li.index();
        var index = li.attr("data-default-index");//点击后的索引
        if (index >= 0) { //若该行点击后的索引大于等于0，说明该行星星已被点击
            for (var i = 0; i < 5; i++) {
                li.find("img").eq(i).attr("src", templatePath+"images/" + stars[index][i]);//更新该行星星
            }
        } else {
            for (var i = 0; i < 5; i++) {
                li.find("img").eq(i).attr("src", templatePath+"images/star_b2.png");//更新该行星星都变初始状态
            }
        }
    })
    $(".comment li").find("img").click(function(){
        var obj = $(this);
        var li = obj.closest("li");
        var star_area_index = li.index();
        var index = obj.index();
        li.attr("data-default-index", index);
    })

    //图层弹出和关闭
    var bg=$("#bg"), pop=$("#pop"), H=pop.height();
    pop.css("marginTop",-(H/2));
    $(".star a.write").click(function(){
    	bg.show();
    	pop.show();
    })

    $("#pop p.close span,#bg").click(function(){
    	bg.hide();
    	pop.hide();
    })

    //-----------------上传图片-----------------

    //鼠标经过图片
    $(".loadImg li").hover(function(){
    	var t=$(this);
    	t.find("i,p").show();
    },function(){
    	var t=$(this);
    	t.find("i,p").hide();
    })
    //删除图片
    $(".loadImg li i").click(function(){
    	var t=$(this), li=t.closest("li");
    	li.remove();
    	if(t.closest("ul").find("li").length==0){
    		$(".loadImg span.delete").hide();
    	}
    })
    $(".loadImg span.delete").click(function(){
    	var t=$(this);
    	t.siblings("ul").empty();
    	t.hide();
    })
    //左旋
    var n=0;
    $(".loadImg li em.leftR").click(function(){
    	var t=$(this), li=t.closest("li"), img= li.find("img");
    	n=n-90;
    	img.css("transform","rotate("+n+"deg)");
    })

    $(".loadImg li em.rightR").click(function(){
    	var t=$(this), li=t.closest("li"), img= li.find("img");
    	n=n+90;
    	img.css("transform","rotate("+n+"deg)");
    })
    var ul=$(".digImg .img ul");
    $(".loadImg li em.open").click(function(){
    	var t=$(this), li=t.closest("li"), img= li.find("img");
    	t.closest("ul").find("li").each(function(){
    		var $t=$(this),m=$t.index();
    		src=$t.find("img").attr("src");
    		ul.find("li:eq("+m+") img").attr("src",src);
    	})
    	index=li.index();
    	$(".popbg").show();
    	$(".digImg").show();
    	ul.find("li:eq("+index+")").show().siblings().hide();
    })
    $(".digImg i").click(function(){
    	$(".popbg").hide();
    	$(".digImg").hide();
    })
    $(".digImg .img a.next2").click(function(){
    	var L=ul.find("li").length;
    	index=index+1;
    	if(index==L){
    		index=0;
    	}
    	ul.find("li:eq("+index+")").show().siblings().hide();
    })
    $(".digImg .img a.prev2").click(function(){
    	var L=ul.find("li").length-1;
    	index=index-1;
    	if(index==-1){
    		index=L;
    	}
    	ul.find("li:eq("+index+")").show().siblings().hide();
    })
    //弹出层函数
		var isloadPopupMap = 0;
    function all(obj,pop,close){
		$(obj).click(function(){
			$(pop).show();

			if(pop != '.popMore'){
				$(".popMore").hide();
			}else{
				$(".popCalendar").hide();
			}

			//浮动地图
			if(pop == ".popImg" && !isloadPopupMap){
				var map2 = new BMap.Map("mapSb", {enableMapClick: false});
				var point = new BMap.Point(lng, lat);
				var marker = new BMap.Marker(point);
				map2.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_SMALL}));
				map2.addOverlay(marker);
				map2.centerAndZoom(point, 15);
				var opts = {width: 200, title: '<strong>'+title+'</strong>'};
				var infoWindow = new BMap.InfoWindow("地址："+address, opts);
				marker.addEventListener("click", function(){
					map2.openInfoWindow(infoWindow,point);
				});
				isloadPopupMap = 1;
			}

		})
		$(close).click(function(){
			$(pop).hide();
		})
	}
    //婚宴套餐  弹出层
    var xl=$(".wrap").offset().left;
    $(".detail .title a.hyPack").click(function(){
		var t=$(this),
		    T=t.offset().top+60,
			L=t.offset().left-xl+30;
		$(".popHytc").css("top",T);
		$(".popHytc i.jt").css("left",L);
		$(".popHytc").show();
	})
	$(".popHytc i.close").click(function(){
		$(".popHytc").hide();
	})
	// 查看大图弹出层
	all(".detail .img .mapS",".popImg",".popImg i");
	//优惠活动
	all(".detail .notice p.b",".popYhhd",".popYhhd i");
	all(".detail .notice p.t",".popDdyl",".popDdyl i");
	//套餐详情
	var tcH=(-($(".popTcxq").height())/2);
	$(".popTcxq").css("marginTop",tcH);
	all(".hytc dd.look a",".popTcxq",".popTcxq i.close");
	//更多照片
	all("a.morePhoto",".popMore",".popMore i.close");
	$("a.morePhoto").click(function(){
		var oPic1 = G("bigBox");
		var oList1 = G("smallBox");
		var oPrevTop1 = G("prevTop1");
		var oNextTop1 = G("nextTop1");
		var num1=8,valx1=$(".popMore .bigBox p i");
		allJ(oPic1,oList1,oPrevTop1,oNextTop1,num1,valx1);
		var t=$(this);
		var x=t.offset().left;
		var y=t.offset().top-680;
		$(".popMore").css("top",y);
	})
	if($(window).width()>1240){  //控制弹出层上忙的三角箭头位置
		var w=100;
	}else{
		var w=0;
	}
	if($(window).width()>1240){
		var r=60;
	}else{
		var r=0;
	}
	//查看档期和预约场地
	all(".detail .title a.lookDq,dd.look a.ckdq,.detail .title a.hyAddr,dd.look a.yukg",".popYucdup",".popYucdup i.close");
	$(".detail .title a.lookDq,.detail .title a.hyAddr").click(function(){
		var t=$(this);
		var H=t.offset().top+60,
		L=t.position().left-20-w;
		$(".popYucdup").css("top",H).show();
		$(".popYucdup i.jt").css({"left":L,"top":"-15px"}).removeClass("on");
		if(t.hasClass("lookDq")){
			$(".info1").hide().siblings(".info2").show();
		}else{
			$(".info2").hide().siblings(".info1").show();
		}
	})
	$("dd.look a.ckdq,dd.look a.yukg").click(function(){
		var t=$(this);
		var H=t.offset().top-470,
		L=t.position().left-65-r;
		$(".popYucdup").css("top",H).show();
		$(".popYucdup i.jt").css({"left":L,"top":"450px"}).addClass("on");
		if(t.hasClass("ckdq")){
			$(".info1").hide().siblings(".info2").show();
		}else{
			$(".info2").hide().siblings(".info1").show();
		}

	})
	// 2016节假日清单，一年一改
	window.OB = window.OB || {},
	window.OB.RiLi = window.OB.RiLi || {},
	window.OB.RiLi.dateRest = ["0101", "0102", "0103", "0207", "0208", "0209", "0210", "0211", "0212", "0213", "0402", "0403", "0404", "0430", "0501", "0502", "0609", "0610", "0611", "0903", "0915", "0916","0917", "1001", "1002", "1003", "1004", "1005", "1006", "1007"],
	window.OB.RiLi.dateWork = ["0206", "0214", "0612", "0918", "1008","1009"],
	window.OB.RiLi.dateFestival = ["20160101||元旦", "20160208||春节", "20160404||清明节", "20160501||劳动节", "20160609||端午节", "20160903||抗战纪念日", "20160915||中秋节", "20161001||国庆节"],
	window.OB.RiLi.dateAllFestival = ["正月初一|v,春节", "正月十五|v,元宵节", "二月初二|v,龙头节", "五月初五|v,端午节", "七月初七|v,七夕节", "七月十五|v,中元节", "八月十五|v,中秋节", "九月初九|v,重阳节", "十月初一|i,寒衣节", "十月十五|i,下元节", "腊月初八|i,腊八节", "腊月廿三|i,祭灶节", "0202|i,世界湿地日,1996", "0214|v,西洋情人节", "0308|i,国际妇女节,1975", "0315|i,国际消费者权益日,1983", "0422|i,世界地球日,1990", "0501|v,国际劳动节,1889", "0512|i,国际护士节,1912", "0518|i,国际博物馆日,1977", "0605|i,世界环境日,1972", "0623|i,国际奥林匹克日,1948", "0624|i,世界骨质疏松日,1997", "1117|i,世界学生日,1942", "1201|i,世界艾滋病日,1988", "0101|v,元旦", "0312|i,植树节,1979", "0504|i,五四青年节,1939", "0601|v,儿童节,1950", "0701|v,建党节,1941", "0801|v,建军节,1933", "0903|v,抗战胜利纪念日", "0910|v,教师节,1985", "1001|v,国庆节,1949", "1224|v,平安夜", "1225|v,圣诞节", "w:0520|v,母亲节,1913", "w:0630|v,父亲节", "w:1144|v,感恩节(美国)", "w:1021|v,感恩节(加拿大)"];
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
})
