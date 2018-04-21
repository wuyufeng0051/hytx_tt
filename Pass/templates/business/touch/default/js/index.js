$(function(){

	// 幻灯片
  new Swiper('#slider', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true,});

	// 滑动导航
	if ($('.mainNav li').length > 10) {
		var mySwiper = new Swiper('.mainNav',{pagination : '.swiper-pagination',});
		$('.mainNav ul').css('padding-bottom', '.6rem');
	}
	var NewSwiper = new Swiper('.bd',{autoplay : 5000,loop : true,onlyExternal : true,})
	var HotSwiper = new Swiper('.hot-list', {freeMode: true,freeModeFluid: true,spaceBetween: 10,slidesPerView: 'auto',cssWidthAndHeight: false});

	// 附近头条
	var mySwiperNews = new Swiper('.topNews',{direction : 'vertical', autoplay: 2000, speed: 700, loop: true})

	// 上滑下滑导航隐藏
	var upflag = 1, downflag = 1, fixFooter = $(".fixFooter, .header");
	//scroll滑动,上滑和下滑只执行一次！
	scrollDirect(function (direction) {
		if (direction == "down") {
			if (downflag) {
				fixFooter.hide();
				downflag = 0;
				upflag = 1;
			}
		}
		if (direction == "up") {
			if (upflag) {
				fixFooter.show();
				downflag = 1;
				upflag = 0;
			}
		}
	});

	//倒计时
	show_time();

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

})


var	scrollDirect = function (fn) {
  var beforeScrollTop = document.body.scrollTop;
  fn = fn || function () {
  };
  window.addEventListener("scroll", function (event) {
      event = event || window.event;

      var afterScrollTop = document.body.scrollTop;
      delta = afterScrollTop - beforeScrollTop;
      beforeScrollTop = afterScrollTop;

      var scrollTop = $(this).scrollTop();
      var scrollHeight = $(document).height();
      var windowHeight = $(this).height();
      if (scrollTop + windowHeight > scrollHeight - 10) {  //滚动到底部执行事件
          fn('up');
          return;
      }
      if (afterScrollTop < 10 || afterScrollTop > $(document.body).height - 10) {
          fn('up');
      } else {
          if (Math.abs(delta) < 10) {
              return false;
          }
          fn(delta > 0 ? "down" : "up");
      }
  }, false);
}

if (site_map == "baidu") {

  $('.header-m').show();
  // 定位
  var geolocation = new BMap.Geolocation();
  geolocation.getCurrentPosition(function(r){
  	if(this.getStatus() == BMAP_STATUS_SUCCESS){
  		var geoc = new BMap.Geocoder();
  		geoc.getLocation(r.point, function(rs){
  			var rs = rs.addressComponents;
  			$('.header-m em').html(rs.district + rs.street + rs.streetNumber)
  		});
  	}
  	else {
  		alert('failed'+this.getStatus());
  	}
  },{enableHighAccuracy: true})

}
