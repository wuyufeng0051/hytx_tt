$(function(){
_loader.use("jquery",
	function() {
		function l() {
			t.slideDown(),
			r.slideDown(),
			i == "1" && $.ajax({
				url: v("https://open.onebox.haosou.com/dataApi"),
				dataType: "jsonp",
				data: {
					query: "日历",
					url: "日历",
					type: "rili",
					user_tpl: "ajax/rili/html",
					selectorPrefix: s,
					asynLoading: i,
					src: "onebox",
					tpl: "1"
				},
				timeout: 5e3,
				success: function(t) {
					t && t.html ? (e.find(".mh-rili-widget").html(t.html), n.hide().addClass("mh-err"), i = "0") : d()
				},
				error: function() {
					d()
				}
			})
		}
		function c(t, n) {
			t = t.replace("\u6e05\u660e", "\u6e05\u660e\u8282").replace("\u56fd\u9645\u52b3\u52a8\u8282", "\u52b3\u52a8\u8282");
			var r = new RegExp(u);
			f = f || e.find("#mh-date-y").html(),
			u && n == f && r.test(t) ? a = !0 : a = !1,
			o.val(t).trigger("change")
		}
		function h() {
			$.each(o.find("option"),
			function(e, t) {
				var n = $(this);
				n.data("desc") && n.val() && (u += n.val() + "|")
			}),
			u = u.substring(0, u.length - 2)
		}
		function p() {
			n.hide()
		}
		function d() {
			n.addClass("mh-err")
		}
		function v(e) {
			return location.protocol == "https:" ? "https://open.onebox.haosou.com/api/proxy?__url__=" + encodeURIComponent(e) : e
		}
		jQuery.curCSS = jQuery.css;
		var e = $("#mohe-rili"),
		t = $(".mh-rili-wap", e),
		n = $(".mh-tips", e),
		r = $(".mh-rili-foot", e),
		i = "0",
		s = "#mohe-rili .mh-rili-widget",
		o = e.find(".mh-holiday-data"),
		u = "",
		a = !1,
		f = e.find("#mh-date-y").html();
		h(),
		e.on("click", ".mh-op a",
		function(e) {
			e.preventDefault();
			var n = $(this).closest(".mh-op");
			n.hasClass("mh-op-less") ? (t.slideUp(), r.slideUp()) : l(),
			n.toggleClass("mh-op-less")
		}).on("click", ".mh-js-reload",
		function(e) {
			e.preventDefault(),
			l()
		}).on("change", ".mh-holiday-data",
		function() {
			var e = $(this),
			t = e.val(),
			n = e.find("option:selected"),
			i = n.attr("data-desc") || "",
			s = n.attr("data-gl") || "";
			if (!a || t == "0" || i === "" && s === "") r.html("");
			else {
				var o = '<div class="mh-rili-holiday">[holidayDetail][holidaySug]</div>';
				i && (i = "<p>" + i + "</p>"),
				s && (s = "<p><span>\u4f11\u5047\u653b\u7565\uff1a</span>" + s + "</p>"),
				o = o.replace("[holidayDetail]", i).replace("[holidaySug]", s),
				r.html(o)
			}
		}),
		window.OB = window.OB || {},
		window.OB.RiLi = window.OB.RiLi || {},
		window.OB.RiLi.rootSelector = "#mohe-rili ",
		window.OB.RiLi.CallBack = {
			afterInit: p,
			holiday: c
		}
	})

_loader.remove && _loader.remove("rili-widget");
_loader.add("rili-widget", templatePath+"js/hnwnl.js");//上述JS文件们已让我压缩成wnl.js
_loader.use("jquery, rili-widget", function(){

	var RiLi = window.OB.RiLi;

	var gMsg = RiLi.msg_config,
		dispatcher = RiLi.Dispatcher,
		mediator = RiLi.mediator;

	var root = window.OB.RiLi.rootSelector || '';

	// RiLi.AppData(namespace, signature, storeObj) 为了解决"In IE7, keys may not contain special chars"
	//'api.hao.360.cn:rili' 仅仅是个 namespace
	var timeData = new RiLi.AppData('api.hao.360.cn:rili'),
		gap = timeData.get('timeOffset'),
		dt = new Date(new Date() - (gap || 0));

	RiLi.action = "default";

	var $detail = $(root+'.mh-almanac .mh-almanac-main');
	$detail.dayDetail(dt);

	RiLi.today = dt;

	var $wbc = $(root+'.mh-calendar');

	mediator.subscribe(gMsg.type.actionfestival , function (d){
		var holi = RiLi.dateFestival,
			val = d.val ? decodeURIComponent(d.val) : "",
			holiHash = {},
			el,
			node = {};

		for (var i = 0 ; i < holi.length ; ++i){
			el = holi[i];
			el = $.trim(el).split("||");
			if (el.length == 2){
				node = {};
				node.year = el[0].substr(0 , 4);
				node.month = el[0].substr(4 , 2);
				node.day = el[0].substr(6 , 2);
				holiHash[el[1]] = node;
			}
		};

		RiLi.action = "festival";

		if (holiHash[val]){
			node.year = holiHash[val].year;
			node.month = holiHash[val].month;
			node.day = holiHash[val].day;

			RiLi.needDay = new Date(parseInt(node.year , 10) , parseInt(node.month ,10) - 1 , node.day);
			$wbc.webCalendar({
				time : new Date(parseInt(node.year , 10) , parseInt(node.month ,10) - 1 , node.day),
				onselect: function(d, l){
					$detail.dayDetail('init', d , l);
				}
			});
		}
		else{
			RiLi.action = "default";
		}
	});

	mediator.subscribe(gMsg.type.actionquery , function (d){
		var strDate;

		if (!d.year || d.year > 2100 || d.year < 1901){
			RiLi.action = "default";
			return 0;
		}

		d.month = parseInt(d.month , 10);

		if (d.month &&  (d.month > 12 || d.month < 1)){
			RiLi.action = "default";
			return 0;
		}

		if (!d.month){
			d.month = 1 ;
		}

		d.day = parseInt(d.day , 10);

		if (!d.day){
			d.day = 1;
		}

		RiLi.action = "query";
		RiLi.needDay = new Date(parseInt(d.year , 10) , parseInt(d.month ,10) - 1 , d.day);

		$wbc.webCalendar({
			time : new Date(parseInt(d.year , 10) , parseInt(d.month ,10) - 1 , d.day),
			onselect: function(d, l){
				$detail.dayDetail('init', d , l);
			}
		});
	});

	mediator.subscribe(gMsg.type.actiongoupiao, function (d){
		RiLi.action = "goupiao";
		$wbc.webCalendar({
			time : dt,
			onselect: function(d, l){
				$detail.dayDetail('init', d , l);
			}
		});

	});

	mediator.subscribe(gMsg.type.actiondefault , function (d){
		RiLi.needDay = dt;
		$wbc.webCalendar({
			time : dt,
			onselect: function(d, l){
				$detail.dayDetail('init', d , l);
			}
		});
	});

	dispatcher.dispatch();

	mediator.subscribe(gMsg.type.dch , function (d){
		// if (RiLi.needDay){
		// 	$wbc.webCalendar("initTime" , RiLi.needDay);
		// }
		// else{
		// 	$wbc.webCalendar("initTime" , RiLi.today);
		// }
		$wbc.webCalendar("initTime" , RiLi.needDay||RiLi.today);
	});

	mediator.publish(gMsg.type.dch ,  dt);

	var nowDate = (new Date()).getTime() ;

	/* 时间矫正 */
	RiLi.TimeSVC.getTime(function(d){
		var trueTime = d.getTime();
		var timeData = new RiLi.AppData('api.hao.360.cn:rili') , isFirst = true;

		if(Math.abs(nowDate - trueTime) > 300000){
			timeData.set('timeOffset', nowDate - trueTime);
		}
		else {
			timeData.remove('timeOffset');
		}

		if (typeof gap == undefined || !isFirst){
			RiLi.today = d;
			mediator.publish(gMsg.type.dch , d);
		}

		isFirst = false;
	});

	//日历初始完后的回调
	if(typeof RiLi.CallBack.afterInit === "function"){
		RiLi.CallBack.afterInit();
	}

});
})
