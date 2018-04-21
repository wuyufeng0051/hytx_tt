function returnHumanTime(t,type) {
    var n = new Date().getTime();
    var c = n - t;
    var str = '';
    if(c < 3600) {
        str = parseInt(c / 60) + '分钟前';
    } else if(c < 86400) {
        str = parseInt(c / 3600) + '小时前';
    } else if(c < 604800) {
        str = parseInt(c / 86400) + '天前';
    } else {
        str = huoniao.transTimes(t,type);
    }
    return str;
}
$(function() {
	var device = navigator.userAgent;
	var mask = $('.mask'), isclick = true;

	$(".nav-container ul").each(function(){
		var t = $(this);
		if(t.find("li").length == 0){
			t.closest(".swiper-slide").remove();
		}
	});

	// 幻灯片和导航
	new Swiper('.swiper-container', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true, autoplay:2000, autoplayDisableOnInteraction : false});
	if ($('.nav-container .swiper-slide').length > 1) {
		new Swiper('.nav-container', {pagination: '.pagination',paginationClickable: true,});
		$('.nav').css('padding-bottom', '.3rem');
	}

	// 筛选框
	var chooseArea = chooseInfo = chooseSort = null;
	$('.choose-tab li').click(function(){
		var $t = $(this),
				index = $t.index(),
				box = $('.choose-box .choose-local').eq(index);
		 if (box.css("display")=="none") {
			 	$t.addClass('active').siblings().removeClass('active');
			 	box.show().siblings().hide();
			 	if (index == 0 && chooseArea == null) {
			 		chooseArea = new iScroll("choose-area", {vScrollbar: false,mouseWheel: true,click: true,});
			 	}
			 	if (index == 1 && chooseInfo == null) {
			 		chooseInfo = new iScroll("choose-info", {vScrollbar: false,mouseWheel: true,click: true,});
			 	}
			 	if (index == 2 && chooseSort == null) {
			 		chooseSort = new iScroll("choose-sort", {vScrollbar: false,mouseWheel: true,click: true,});
			 	}
			 	$(window).scrollTop(tabTop + 2);
				isclick = false;
				if (device.indexOf('huoniao_iOS') > -1) {
					$('.choose-box').addClass('padTop20');
				}
			 	mask.show();
		 }else{
			 	isclick = true;
			 	$t.removeClass('active');
			 	box.hide();mask.hide();
		 }
	})

	// 区域二级
	var chooseAreaSecond = null;
	$('#choose-area li').click(function(){
		var t = $(this), index = t.index(), id = t.attr("data-id"), localIndex = t.closest('.choose-local').index();
		if (index == 0) {
			$('#area-box .choose-stage-l').removeClass('choose-stage-l-short');
			t.addClass('current').siblings().removeClass('active');
			t.closest('.choose-local').hide();
			$('.choose-tab li').eq(localIndex).removeClass('active').attr("data-id", 0).find('span').text("不限");
			mask.hide();
			isclick = true;

			page = 1;
			getList();

		}else{
			t.siblings().removeClass('current');
			t.addClass('active').siblings().removeClass('active');
			$('#area-box .choose-stage-l').addClass('choose-stage-l-short');
			$('.choose-stage-r').show();
			chooseAreaSecond = new iScroll("choose-area-second", {vScrollbar: false,mouseWheel: true,click: true});

			$.ajax({
				url: masterDomain + "/include/ajax.php?service=info&action=addr&type="+id,
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){
						var html = [], list = data.info;
						html.push('<li data-id="'+id+'">不限</li>');
						for (var i = 0; i < list.length; i++) {
							html.push('<li data-id="'+list[i].id+'">'+list[i].typename+'</li>');
						}
						$("#choose-area-second").html('<ul>'+html.join("")+'</ul>');
						chooseSecond = new iScroll("choose-area-second", {vScrollbar: false,mouseWheel: true,click: true});
					}else if(data.state == 102){
						$("#choose-area-second").html('<ul><li data-id="'+id+'">不限</li></ul>');
					}else{
						$("#choose-area-second").html('<ul><li class="load">'+data.info+'</li></ul>');
					}
				},
				error: function(){
					$("#choose-area-second").html('<ul><li class="load">网络错误，加载失败！</li></ul>');
				}
			});
		}
	})


	// 分类二级
	var chooseSecond = null;
	$('#choose-info li').click(function(){
		var t = $(this),
				index = t.index(),
				id = t.attr("data-id");
				localIndex = t.closest('.choose-local').index();
		if(index == 0){
			$('.choose-stage-l').removeClass('choose-stage-l-short');
			t.addClass('current').siblings().removeClass('active');
			t.closest('.choose-local').hide();
			$('.choose-tab li').eq(localIndex).removeClass('active').attr("data-id", "").find('span').text("分类");
			mask.hide();
			isclick = true;

			page = 1;
			getList();
		}else{
			t.siblings().removeClass('current');
			t.addClass('active').siblings().removeClass('active');
			$('.choose-stage-l').addClass('choose-stage-l-short');
			$('.choose-stage-r').show();
			$("#choose-second ul").html('<li class="load">加载中...</li>');
			chooseSecond = new iScroll("choose-second", {vScrollbar: false,mouseWheel: true,click: true});

			$.ajax({
				url: masterDomain + "/include/ajax.php?service=info&action=type&type="+id,
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){
						var html = [], list = data.info;
						html.push('<li data-id="'+id+'">不限</li>');
						for (var i = 0; i < list.length; i++) {
							html.push('<li data-id="'+list[i].id+'">'+list[i].typename+'</li>');
						}
						$("#choose-second").html('<ul>'+html.join("")+'</ul>');
						chooseSecond = new iScroll("choose-second", {vScrollbar: false,mouseWheel: true,click: true});
					}else if(data.state == 102){
						$("#choose-second").html('<ul><li data-id="'+id+'">不限</li></ul>');
					}else{
						$("#choose-second").html('<ul><li class="load">'+data.info+'</li></ul>');
					}
				},
				error: function(){
					$("#choose-second").html('<ul><li class="load">网络错误，加载失败！</li></ul>');
				}
			});
		}
	});

	// 一级筛选  地址和排序
	$('#choose-sort, #choose-second, #choose-area-second').delegate("li", "click", function(){
		var $t    = $(this),
				val   = $t.html(),
				id    = $t.attr("data-id"),
				local = $t.closest('.choose-local'),
				index = local.index();
		$t.addClass('on').siblings().removeClass('on');
		$('.choose-tab li').eq(index).removeClass('active').attr("data-id", id).find('span').text(val);
		local.hide();
		mask.hide();
		isclick = true;

		page = 1;
		getList();
	})

	// 遮罩层
	$('.mask').on('click',function(){
		mask.hide();
		isclick = true;
		$('.choose-local').hide();
		$('.choose-tab li').removeClass('active');
	})
	$('.mask').on('touchmove',function(){
		mask.hide();
		isclick = true;
		$('.choose-local').hide();
		$('.choose-tab li').removeClass('active');
	})

	// 下拉加载
	var isload = isend = false, scrollTop1 = 0;
	var tabTop = $('.choose-tab').offset().top;
	$(window).scroll(function() {
		var h = $('.goods-list li').height();
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - h - w;
		var scrollTop2 = $(window).scrollTop();
		if ($(window).scrollTop() > scroll && !isload && !isend) {
			page++;
			getList();
		};
		//吸顶
		if (scrollTop2 > tabTop) {
			$('.choose-tab ul').addClass('top');
			if (device.indexOf('huoniao_iOS') > -1) {
				$('.choose-tab ul').addClass('padTop20');
			}
		}else{
			$('.choose-tab ul').removeClass('top padTop20');
		}
	});

	// 上滑下滑导航隐藏
	var upflag = 1, downflag = 1, fixFooter = $(".fixFooter, .choose-tab ul");
	//scroll滑动,上滑和下滑只执行一次！
	scrollDirect(function (direction) {
		var dom = $('.choose-tab ul').hasClass('top');
		if (direction == "down" && dom && isclick) {
			if (downflag) {
				fixFooter.hide();
				$('.scrollTop').hide();
				downflag = 0;
				upflag = 1;
			}
		}
		if (direction == "up") {
			if (upflag) {
				fixFooter.show();
				$('.scrollTop').show();
				downflag = 1;
				upflag = 0;
			}
		}
	});


	//初始加载
	getList();


	//获取信息列表
	function getList(){
		var data = [];
		data.push("page="+page);
		data.push("pageSize="+pageSize);
		$(".choose-tab li").each(function(){
			data.push($(this).attr("data-type") + "=" + $(this).attr("data-id"));
		});

		isload = true;

		$(".goods-list .empty").html('加载中...').show();

		$.ajax({
			url: masterDomain + "/include/ajax.php?service=info&action=ilist&"+data.join("&"),
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				isload = false;
				if(data && data.state == 100){
					var html = [], list = data.info.list, pageinfo = data.info.pageInfo;

					for (var i = 0; i < list.length; i++) {
						html.push('<li>');
			      html.push('  <a href="'+list[i].url+'">');
			      html.push('    <div class="user-box fn-clear">');

						var photo = list[i].member.photo == null ? templatePath+'images/noavatar_middle.gif' : list[i].member.photo;
			      html.push('    		<div class="imgbox"><img src="'+photo+'" alt=""></div>');

						var nickname = list[i].member.nickname == null ? '匿名' : list[i].member.nickname;
			      html.push('    		<div class="txtbox"><p class="name">'+nickname+'</p><p class="time">'+returnHumanTime(list[i].pubdate, 3)+'发布</p></div>');
			      // html.push('    		<span class="price">&yen;<em>30</em></span>');
			      html.push('    </div>');

						if (list[i].litpic) {
							html.push('   <div class="litpic"><img src="'+list[i].litpic+'" alt=""></div>');
						}
						// if (list[i].litpic) {
						// 	html.push('		<div class="imgList fn-clear">');
						// 	html.push('			<img src="{#$templets_skin#}images/img8.jpg" alt="">');
				    //   html.push('   </div>');
						// }
			      html.push('    <p class="content">'+list[i].title+'</p>');
			      html.push('    <p class="from">来自'+list[i].address+'</p>');
			      html.push('  </a>');
			      html.push('</li>');
					}

					if(page == 1){
						$(".goods-list ul").html(html.join(""));
					}else{
						$(".goods-list ul").append(html.join(""));
					}
					isend = false;

					$(".goods-list .empty").hide();
					if(page >= pageinfo.totalPage){
						isend = true;
						$(".goods-list .empty").html('已到最后一页').show();
					}

				}else{
					if(page == 1){
						$(".goods-list ul").html("");
					}
					$(".goods-list .empty").html(data.info).show();
				}
			},
			error: function(){
				isload = false;
				if(page == 1){
					$(".goods-list ul").html("");
				}
				$(".goods-list .empty").html('网络错误，加载失败...').show();
			}
		});

	}

})
