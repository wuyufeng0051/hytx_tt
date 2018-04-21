$(function(){

	//大图幻灯
	$("#slide").cycle({
		pager: '#slidebtn',
		pause: true
	});

	//推荐优质商家
	$(".business .ad1 li").hover(function(){
		var t = $(this);
		t.find("img").stop().animate({"margin-left": "-10px"}, 200);
		t.find(".enter").stop().animate({"right": "0", "opacity": ".8"}, 200);
	}, function(){
		var t = $(this);
		t.find("img").stop().animate({"margin-left": "0"}, 200);
		t.find(".enter").stop().animate({"right": "-185px", "opacity": "0"}, 200);
	});

	//限时秒杀
	$(".seckill .tab li").bind("click", function(){
		var t = $(this), index = t.index();
		if(!t.hasClass("curr")){
			t.addClass("curr").siblings("li").removeClass("curr");

			$(".seckill .content ul").hide();
			$(".seckill .content ul:eq("+index+")").fadeIn(150);
		}
	});

	var timeCompute = function (a, b) {
		if (this.time = a, !(0 >= a)) {
			for (var c = [86400 / b, 3600 / b, 60 / b, 1 / b], d = .1 === b ? 1 : .01 === b ? 2 : .001 === b ? 3 : 0, e = 0; d > e; e++) c.push(b * Math.pow(10, d - e));
			for (var f, g = [], e = 0; e < c.length; e++) f = Math.floor(a / c[e]),
			g.push(f),
			a -= f * c[e];
			return g
		}
	}
	,CountDown =	function(a, b) {
		this.precise = parseFloat(b) || 1,
		this.time = a / this.precise,
		this.countTimer = null,
		this.run = function(a) {
			var b, c = this,
			e = this.precise;
			this.countTimer = setInterval(function() {
				b = timeCompute.call(c, c.time - 1, e),
				b || (clearInterval(c.countTimer), c.countTimer = null),
				"function" == typeof a && a(b || [0, 0, 0, 0, 0], !c.countTimer)
			},
			1e3 * e)
		}
	};

	$(".seckill .content li").each(function (index){
		timeLmtCountdown(index);
	});

	// 限时秒杀倒计时
	function timeLmtCountdown(index) {
		var content = $(".seckill .content li:eq("+index+")");
		var $this = content.find(".time");
		var stime = $this.attr('data-stime'); //开始时间
		var etime = $this.attr('data-etime'); //结束时间
		var ntime = $this.attr('data-ntime'); //当前时间
		var begin = stime - ntime;
		var end = etime - ntime;
		var time = begin > 0 ? begin : end > 0 ? end : 0;
		var buyBtn = $this.closest(".info").find('.btn a');

		var timeTypeText = '离开始还有';
		if(begin < 0 && end < 0 ){
			buyBtn.addClass('disable');
			buyBtn.html('抢光了');
			timeTypeText = '剩余';
		}else if (begin > 0 && end > 0) {
			buyBtn.addClass('disable');
			buyBtn.html('即将开始');
			timeTypeText = '离开始还有';
		} else if(begin < 0 && end > 0) {
			buyBtn.removeClass('disable');
			buyBtn.html('立即秒杀');
			timeTypeText = '剩余';
		}
		var countDown = new CountDown(time);
		countDownRun();

		function countDownRun(time) {
			time && (countDown.time = time);
			countDown.run(function(times, complete) {
				var html = '<span>'+timeTypeText+'<em>' + times[0] +
				'</em>天<em>' + times[1] +
				'</em>小时<em>' + times[2] +
				'</em>分<em>' + times[3] + '</em>秒</span>';
				$this.html(html);
				if (complete) {
					if(begin< 0 && end < 0 ){
						buyBtn.addClass('disable');
						buyBtn.html('抢光了');
						timeTypeText = '剩余';
					}else if ( begin > 0) {
						buyBtn.removeClass('disable');
						buyBtn.html('立即秒杀');
						timeTypeText = '剩余';
						countDownRun(etime - stime);
						begin = null;
					} else {
						buyBtn.addClass('disable');
						if( begin === null || begin == 0 ){
							buyBtn.html('抢光了');
						}else{
							buyBtn.html('即将开始');
							timeTypeText = '离开始还有';
						}
					}
				}
			});
		}
	}

	$(".seckill .content .btn a").bind("click", function(event){
		if($(this).hasClass("disable")){
			event.preventDefault();
		}
	});

	//建材选购知识幻灯
	$(".nslide .slideinfo").each(function(){
		var t = $(this), width = t.width() + 40;
		t.css({"margin-left": "-"+(width/2)+"px"});
	});

	$("#nslide").cycle({
		fx: 'scrollLeft',
		pager: '#nslidebtn',
		next:	'.nslide .next',
		prev:	'.nslide .prev',
		pause: true,
		speed: 300
	});

	$(".nslide").hover(function(){
		$(this).find(".prev, .next").stop().animate({"opacity": ".8"}, 300);
	}, function(){
		$(this).find(".prev, .next").stop().animate({"opacity": ".2"}, 300);
	});



});
