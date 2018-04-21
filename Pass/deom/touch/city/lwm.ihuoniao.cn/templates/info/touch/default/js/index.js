$(function() {

	var mask = $('.mask');

	// 吸顶
	var tabTop = $('.choose-tab').offset().top;
	$(window).scroll(function(){
		var winTop = $(this).scrollTop();
		if (winTop > tabTop) {
			$('.choose-tab ul').addClass('top');
		}
		else{
			$('.choose-tab ul').removeClass('top');
		}
	})

	$(".nav-container ul").each(function(){
		var t = $(this);
		if(t.find("li").length == 0){
			t.closest(".swiper-slide").remove();
		}
	});

	// 幻灯片和导航
	new Swiper('.swiper-container', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true,});
	new Swiper('.nav-container', {pagination: '.pagination',paginationClickable: true,})

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
			 	$(window).scrollTop(tabTop);
			 	mask.show();
		 }else{
			 	$t.removeClass('active');
			 	box.hide();mask.hide();
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
	$('#choose-area, #choose-sort, #choose-second').delegate("li", "click", function(){
		var $t    = $(this),
				val   = $t.html(),
				id    = $t.attr("data-id"),
				local = $t.closest('.choose-local'),
				index = local.index();
		$t.addClass('on').siblings().removeClass('on');
		$('.choose-tab li').eq(index).removeClass('active').attr("data-id", id).find('span').text(val);
		local.hide();
		mask.hide();

		page = 1;
		getList();
	})

	// 遮罩层
	$('.mask').on('touchstart',function(){
		mask.hide();
		$('.choose-local').hide();
		$('.choose-tab li').removeClass('active');
	})

	// 下拉加载
	var isload = isend = false;
	$(window).scroll(function() {
		var h = $('.goods-list li').height();
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - h - w;
		if ($(window).scrollTop() > scroll && !isload && !isend) {
			page++;
			getList();
		};
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
			      html.push('    <div class="img-box">');
			      html.push('      <img src="'+huoniao.changeFileSize(list[i].litpic, "small")+'" alt="">');
			      html.push('    </div>');
			      html.push('    <div class="txt-box">');
			      html.push('      <h3>'+list[i].title+'</h3>');
			      html.push('      <p class="price"><span class="nprice">'+list[i].typename+'</span></p>');
			      html.push('      <p class="area"><span>'+list[i].address+'</span><span>评论：'+list[i].common+'</span></p>');
			      html.push('    </div>');
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
