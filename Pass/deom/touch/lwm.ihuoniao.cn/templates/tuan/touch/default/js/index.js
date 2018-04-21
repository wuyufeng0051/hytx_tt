$(function() {

	//分类切换
	var mySwiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
	});

	//倒计时
	show_time();

	//猜你喜欢
	$.ajax({
		url: "/include/ajax.php?service=tuan&action=tlist&pageSize=50",
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state == 100 && data.info.list.length > 0){
				$(".like-con .loading").remove();
				var list = data.info.list,
						html = [];
				for(var i = 0; i < list.length; i++){
					var addrname = list[i].store.addrname ? list[i].store.addrname[1] : "";
					var circle = list[i].store.circle ? list[i].store.circle : "";

					html.push('<a href="'+list[i].url+'"><div class="like-list fn-clear"><div class="like-list-img l"><img src="'+cfg_staticPath+'images/blank.gif" data-url="'+huoniao.changeFileSize(list[i].litpic, "middle")+'"></div><dl><dt><h3>'+list[i].title+'</h3></dt><dd class="brief">['+addrname+']'+circle+'</dd><dd class="price"><span>￥'+list[i].price+'</span><em>门市价:￥'+list[i].market+'</em><i>已售'+list[i].sale+'</i></dd></dl></div></a>');
				}
				$(".like-con").prepend(html.join(""));

				$(".like-con img").scrollLoading();
			}else{
				$(".like-con .loading").html('暂无相关信息！');
			}
		},
		error: function(){
			$(".like-con .loading").html('网络错误，加载失败！');
		}
	});

})

function show_time() {
	var time_start = new Date().getTime(); //设定当前时间
	var time_end = new Date(countDownTime).getTime(); //设定目标时间

	// 计算时间差
	var time_distance = time_end - time_start;

	if(time_distance <= 0){
		$("#time_h").val('00');
		$("#time_m").val('00');
		$("#time_s").val('00');
		return;
	}

	// 时
	var int_hour = Math.floor(time_distance / 3600000)
	time_distance -= int_hour * 3600000;
	// 分
	var int_minute = Math.floor(time_distance / 60000)
	time_distance -= int_minute * 60000;
	// 秒
	var int_second = Math.floor(time_distance / 1000)

	// 时分秒为单数时、前面加零
	if (int_hour < 10) {
		int_hour = "0" + int_hour;
	}
	if (int_minute < 10) {
		int_minute = "0" + int_minute;
	}
	if (int_second < 10) {
		int_second = "0" + int_second;
	}

	// 显示时间
	$("#time_h").val(int_hour);
	$("#time_m").val(int_minute);
	$("#time_s").val(int_second);

	// 设置定时器
	setTimeout("show_time()", 1000);
}
