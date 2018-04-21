$(function(){

	//导航
	$('.header-r .more').click(function(){
		var nav = $('.nav'), t = $('.nav').css('display') == "none";
		if (t) {nav.show();}else{nav.hide();}
	})

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


	// 头部导航
	var mySwiperShop = new Swiper('.topNav', {freeMode: true,freeModeFluid: true,spaceBetween: 10,slidesPerView: 'auto',cssWidthAndHeight: false});

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
			return (hour+':'+minute);
		}else{
			return 0;
		}
	}


	//加载商家列表
	var hallList = $(".main"), atpage = 1, pageSize = 20, listArr = [], totalPage = 0, isload = false;
	function getList(){
		isload = true;
		if(atpage == 1){
			hallList.html('');
			totalPage = 0;
		}
		hallList.find(".loading, .empty").remove();
		hallList.append('<div class="loading"><i></i>加载中...</div>');

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=tieba&action=tlist",
			data: {
				"typeid": typeid,
				"page": atpage,
				"pageSize": pageSize
			},
			dataType: "jsonp",
			success: function (data) {
				hallList.find(".loading").remove();
				if(data){
					if(data.state == 100){
						var list = data.info.list, pageInfo = data.info.pageInfo, li = [];
						for (var i = 0, lr, cla; i < list.length; i++) {
							lr = list[i];

							var style = [];

							//颜色
							if(lr.color != ""){
								style.push('color:'+lr.color+';');
							}

							//加粗
							if(lr.bold != ""){
								style.push('font-weight:700;');
							}

							li.push('<div class="listbox"><a href="'+lr.url+'"><div class="title">');

							if(lr.top == "1"){
								li.push('<span class="tag tag1">置顶</span>');
							}
							if(lr.jinghua == "1"){
								li.push('<span class="tag tag2">精华</span>');
							}

							li.push('<span style="'+style.join(" ")+'">'+lr.title+'</span>');
							li.push('</div><div class="txtbox">');
							li.push('<p>'+lr.content+'</p>');
							li.push('</div>');

							//图集
							if(lr.imgGroup){
								li.push('<div class="imgbox"><ul class="fn-clear">');
								for(var g = 0; g < lr.imgGroup.length; g++){
									if(g < 3){
										li.push('<li><img src="/static/images/blank.gif" style="background-image:url('+lr.imgGroup[g]+');"></li>');
									}
								}
								li.push('</ul>');
								if(lr.imgGroup.length > 3){
									li.push('<span class="total">共 '+lr.imgGroup.length+' 张</span>');
								}
								li.push('</div>');
							}

							li.push('<div class="user fn-clear"><div class="user-l fn-left">');
							li.push('<span class="name">'+lr.username+'</span>');
							li.push('<span class="time">'+transTimes(lr.pubdate, 4)+'</span>');
							li.push('</div>');
							li.push('<div class="user-r fn-right"><span>'+lr.reply+'</span></div></div></a></div>');

						}

						hallList.append(li.join(""));
					}else{

						if(atpage == 1){
							hallList.append('<div class="empty">暂无相关信息！</div>');
						}

					}

					if(atpage >= pageInfo.totalPage){
						isload = true;
					}else{
						isload = false;
					}
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				isload = false;
				hallList.find(".loading").remove();
				console.log(XMLHttpRequest.status);
				console.log(XMLHttpRequest.readyState);
				console.log(textStatus);
			}
		});

	}
	getList();

	//滚动加载
	$(window).on("touchmove", function(){
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - w - 300;
		if ($(window).scrollTop() > scroll && !isload) {
			atpage++;
			getList();
		};
	});


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
