$(function(){

	// 判断设备类型，ios全屏
	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('body').addClass('huoniao_iOS');
	}

	function GetQueryString(name){
		 var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		 var r = window.location.search.substr(1).match(reg);
		 if(r!=null)return  unescape(r[2]); return null;
	}

	var nav_id = GetQueryString("id");
	$(".menu_list a").each(function(){
		var t = $(this), menu_id = t.attr("data-id"), length = $(".menu_list a").length;
		if (nav_id == menu_id) {
			var nav_index = t.index();
			t.addClass('menu_bc');
			if (nav_index > 3) {
				var index = t.index(), width = t.width(), y = (index - 2.5) * width;
			  $('.menu_list').scrollLeft(y);
			}
		}
		$('body').addClass('show');
	});

	var detailList, getParid, isload = false;
	detailList = new h5DetailList();
	setTimeout(function(){detailList.removeLocalStorage();}, 800);

	var dataInfo = {
		isBack: true
	};

	$('#video_list').delegate('.video_box', 'click', function(){
		var t = $(this), a = t.find('a'), url = a.attr('data-url');
		detailList.insertHtmlStr(dataInfo, $("#video_list").html(), {lastIndex: page});
		setTimeout(function(){location.href = url;}, 500);
	})

	$('.menu_list').css('visibility','visible');
	//转换PHP时间戳
	function transTimes(timestamp, n){
		update = new Date(timestamp*1000);//时间戳要乘1000
		year   = update.getFullYear();
		month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
		day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
		hour   = (update.getHours()<10)?('0'+update.getHours()):(update.getHours());
		minute = (update.getMinutes()<10)?('0'+update.getMinutes()):(update.getMinutes());
		second = (update.getSeconds()<10)?('0'+update.getSeconds()):(update.getSeconds());
		if(n == 1){
			return (year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second);
		}else if(n == 2){
			return (year+'-'+month+'-'+day);
		}else if(n == 3){
			return (month+'-'+day);
		}else if(n == 4){
			return (hour+':'+minute+':'+second);
		}else{
			return 0;
		}
	}

	//获取时间段
	function time_tran(time) {
			var dur = nowStamp - time;
			if (dur < 0) {
					return transTimes(time, 2);
			} else {
					if (dur < 60) {
							return dur+'秒前';
					} else {
							if (dur < 3600) {
									return parseInt(dur / 60)+'分钟前';
							} else {
									if (dur < 86400) {
											return parseInt(dur / 3600)+'小时前';
									} else {
											if (dur < 259200) {//3天内
													return parseInt(dur / 86400)+'天前';
											} else {
													return transTimes(time, 2);
											}
									}
							}
					}
			}
	}
	var page = 1,isload = false,load_btn = false;

	var refresh = function(){
		var typeid = $('.menu_list  a.menu_bc').attr("data-id");
		if (typeid == undefined) {
			typeid = 0;
		}
		var objId = "List" + typeid;
		if ($("#" + objId).html() == undefined) {
			$(".video_list").append('<div id="' + objId + '" class="slide-box"></div>');
		}
		$("#" + objId)
			.append("<p class='loading'>加载中...</p>")
			.show()
			.siblings(".slide-box").hide();

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=video&action=alist&pageSize=10&typeid="+typeid+"&page="+page,
			type: "GET",
			dataType: "json",
			success: function(data) {
				if (data && data.state != 200) {
					if (data.state == 101) {
						$('.head i').removeClass('shua');
						$("#" + objId).html("<p class='loading'>" + data.info + "</p>");
						load_btn = false;
					} else {
						load_btn = true;
						$('.head i').removeClass('shua');
						var list = data.info.list,
							pageInfo = data.info.pageInfo,
							html = [];
						for (var i = 0; i < list.length; i++) {

								html.push('<div class="video_box"><a href="javascript:;" data-url="'+list[i].url+'">');
								html.push('<div class="video_img">');
								html.push('<div class="video_mask"></div>');
								html.push('<h1>'+list[i].title+'</h1>');
								html.push('<img src="'+list[i].litpic+'" data-url="" alt="'+list[i].title+'">');
								html.push('<div class="video_btn"></div>');
								html.push('</div>');
								html.push('  <div class="item"><em>'+list[i].typeName+'</em><span>播放量 '+list[i].click+'</span><span>'+time_tran(list[i].pubdate)+'</span></div>');
								html.push('</a></div>');

						}
						$("#" + objId).html(html.join(""));
						isload = false;
					}
				} else {
					$('.head i').removeClass('shua');
					$("#" + objId).html("<p class='loading'>数据获取失败，请稍候访问！</p>");
					isload = false;
				}
			},
			error: function() {
				$('.head i').removeClass('shua');
				$("#" + objId).html("<p class='loading'>数据获取失败，请稍候访问！</p>");
				isload = false;
			}
		});
	}

	//初始加载
	if($.isEmptyObject(detailList.getLocalStorage()['extraData']) || !detailList.isBack()){
		refresh();

	// 返回时更正页码
	}else {
		page = detailList.getLocalStorage()['extraData'].lastIndex;
	}

	var load = function(){
		isload = true;
		var typeid = $('.menu_list  a.menu_bc').attr("data-id");
		if (typeid == undefined) {
			typeid = 0;
		}
		var objId = "List" + typeid;
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=video&action=alist&pageSize=10&typeid="+typeid+"&page="+page,
			type: "GET",
			dataType: "json",
			success: function(data) {
				if (data && data.state != 200) {
					if (data.state == 101) {
						$(".video_list").html("<p class='loading'>" + data.info + "</p>");
						load_btn = false;
					} else {
						load_btn = true;
						$('.head i').removeClass('shua');
						var list = data.info.list,
								pageInfo = data.info.pageInfo,
								html = [];
						for (var i = 0; i < list.length; i++) {

								html.push('<div class="video_box"><a href="javascript:;" data-url="'+list[i].url+'">');
								html.push('<div class="video_img">');
								html.push('<div class="video_mask"></div>');
								html.push('<h1>'+list[i].title+'</h1>');
								html.push('<img src="'+list[i].litpic+'" data-url="" alt="'+list[i].title+'">');
								html.push('<div class="video_btn"></div>');
								html.push('</div>');
								html.push('  <div class="item"><em>'+list[i].typeName+'</em><span>播放量 '+list[i].click+'</span><span>'+time_tran(list[i].pubdate)+'</span></div>');
								html.push('</a></div>');

						}
						$("#" + objId).append(html.join(""));
						if(page >= data.info.pageInfo.totalPage){
							isload = true;
							$("#" + objId).find('.loading').remove();
							$("#" + objId).append('<div class="loading">到底啦！</div>');
						}
						if(page >= pageInfo.totalPage){
							isload = true;
						}else{
							isload = false;
						}
					}
				} else {
					$('.head i').removeClass('shua');
					$("#" + objId).html("<p class='loading'>数据获取失败，请稍候访问！</p>");
				}
			},
			error: function() {
				$('.head i').removeClass('shua');
				$("#" + objId).html("<p class='loading'>数据获取失败，请稍候访问！</p>");
			}
		});
	}

	// 上拉加载
	$(window).scroll(function() {
		var allh = $('.video_list').height();
		var w = $(window).height();
		var scroll = allh  - w;
		if ($(window).scrollTop() > scroll && !isload) {
			page++;
			if (load_btn != false) {
				$('.head i').addClass('shua');
			}
      load();
		};
	});

	// 头部下拉刷新按钮显示旋转
	var content = $('.video_list');
	var img = document.getElementById('refresh');
	var img_box = document.getElementById('refresh_box');
	var touchY = "";
	content.on('touchstart',function (event) {
    var touch = event.touches[0];
    startY = touch.pageY;
    clientY = touch.clientY;
	});

	content.on('touchmove',function  (event) {
    var touchs = event.touches[0];
		touchY = touchs.pageY;
    //向上滚动,直接返回
    if (touchs.pageY - startY <= 0 ) {
        return ;
    }
    //不相等,说明屏幕已经向上翻动,加载按钮不出现
    if(startY != clientY){
        return ;
    }
		if (touchs.pageY - startY > 0) {
			event.preventDefault();
			var scale = (touchs.pageY - startY) ;
	    var scale_r = (touchs.pageY - startY + 30) * 6;
			if(scale < 105){
				img_box.style.transform = "rotate("+ scale_r +"deg)";
				img.style.transform = "translate( 0 , "+ scale +"px)";
			}
		}
	});

	content.on('touchend',function  (event) {
    var touch = event.changedTouches[0];
    img.style.transform = "translate( 0 , 0)";
		img_box.style.transform = "none";

		var touchs = event.touches[0];
		var scale_r = (touchY - startY);
    //向上滚动,直接返回
    if (touchY - startY <= 0 ) {
        return ;
    }
    //不相等,说明屏幕已经向上翻动,不刷新
    if(startY != clientY){
        return ;
    }
			if (touchY - startY > 0 && scale_r > 44) {
				page = 1;
				if (load_btn == true) {
					$('.head i').addClass('shua');
					refresh();
				}
			}
	});
	// 头部按钮刷新
	$('.head i').click(function(){
		page = 1;
		$('.head i').addClass('shua');
		isload = false;
		refresh();
	})

})
