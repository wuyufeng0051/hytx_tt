$(function() {

	var dom = $('#screen');
	var mask = $('.mask');

	// 筛选框
	var chooseArea = chooseInfo = chooseSort = null;
	$('.choose-tab li').click(function(){
		dom.hide();
		$('.confirm').hide();

		var $t = $(this),
				index = $t.index(),
				box = $('.choose-box .choose-local').eq(index);
		 if (box.css("display")=="none") {
			 	$t.addClass('active').siblings().removeClass('active');
			 	box.show().siblings().hide();
			 	if (index == 0 && chooseArea == null) {
			 		chooseArea = new iScroll("choose-area", {vScrollbar: false,mouseWheel: true,click: true});
			 	}
			 	if (index == 1 && chooseInfo == null) {
			 		chooseInfo = new iScroll("choose-info", {vScrollbar: false,mouseWheel: true,click: true});
			 	}
			 	if (index == 2 && chooseSort == null) {
			 		chooseSort = new iScroll("choose-sort", {vScrollbar: false,mouseWheel: true,click: true});
			 	}
			 	mask.show();
		 }else{
			 	$t.removeClass('active');
			 	box.hide();mask.hide();
		 }
	});


	// 区域二级
	var chooseAreaSecond = null;
	$('#choose-area li').click(function(){
		var t = $(this),
				index = t.index(),
				id = t.attr("data-id"),
				localIndex = t.closest('.choose-local').index();
		if (index == 0) {
			$('#area-box .choose-stage-l').removeClass('choose-stage-l-short');
			t.addClass('current').siblings().removeClass('active');
			t.closest('.choose-local').hide();
			$('.choose-tab li').eq(localIndex).removeClass('active').attr("data-id", 0).find('span').text("不限");
			mask.hide();

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
				id = t.attr("data-id"),
				localIndex = t.closest('.choose-local').index();
		if (index == 0) {
			$('#info-box .choose-stage-l').removeClass('choose-stage-l-short');
			t.addClass('current').siblings().removeClass('active');
			t.closest('.choose-local').hide();
			$('.choose-tab li').eq(localIndex).removeClass('active').attr("data-id", '').find('span').text("全部分类");
			mask.hide();

			page = 1;
			getList();
		}else{
			t.siblings().removeClass('current');
			t.addClass('active').siblings().removeClass('active');
			$('#info-box .choose-stage-l').addClass('choose-stage-l-short');
			$('.choose-stage-r').show();
			chooseSecond = new iScroll("choose-info-second", {vScrollbar: false,mouseWheel: true,click: true});

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
						$("#choose-info-second").html('<ul>'+html.join("")+'</ul>');
						chooseSecond = new iScroll("choose-info-second", {vScrollbar: false,mouseWheel: true,click: true});
					}else if(data.state == 102){
						$("#choose-info-second").html('<ul><li data-id="'+id+'">不限</li></ul>');
					}else{
						$("#choose-info-second").html('<ul><li class="load">'+data.info+'</li></ul>');
					}
				},
				error: function(){
					$("#choose-info-second").html('<ul><li class="load">网络错误，加载失败！</li></ul>');
				}
			});
		}
	})

	// 一级筛选  地址和排序
	var screenScroll = null;
	$('#choose-sort, #choose-info-second, #choose-area-second').delegate("li", "click", function(){
		var $t = $(this),
				id = $t.attr("data-id"),
		   val = $t.html(),
		 local = $t.closest('.choose-local'),
		 index = local.index();

		$t.addClass('on').siblings().removeClass('on');
		$('.choose-tab li').eq(index).removeClass('active').attr("data-id", id).find('span').text(val);
		local.hide();
		mask.hide();

		page = 1;
		getList();

		//加载分类自定义筛选条件
		if(index == 1 && $t.index() > 0){
			$.ajax({
				url: masterDomain + "/include/ajax.php?service=info&action=typeDetail&id="+id,
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){
						var item = data.info[0].item, html = [];

						if(item != undefined && item.length > 0){
							for(var i = 0; i < item.length; i++){
								if(item[i].formtype != "text"){
									html.push('<div class="screen-box" data-type="'+item[i].field+'" data-id="'+item[i].id+'">');
									html.push('<h3>'+item[i].title+'</h3>');
									html.push('<ul class="fn-clear">');
									html.push('<li class="active" data-id="0">不限</li>');
									for(var b = 0; b < item[i].options.length; b++){
										html.push('<li data-id="'+item[i].options[b]+'">'+item[i].options[b]+'</li>')
									}
									html.push('</ul>');
									html.push('</div>');
								}
							}
						}

						$("#filter").html(html.join(""));
						if(screenScroll == null){
							screenScroll = new iScroll("screen", {vScrollbar: false,mouseWheel: true,click: true});
						}else{
							screenScroll.refresh();
						}

					}else{
						$("#filter").html('');
					}
				},
				error: function(){
					$("#filter").html('');
				}
			});
		}
	})

	// 遮罩层
	$('.mask').on('touchstart',function(){
		mask.hide();dom.hide();$('.confirm').hide();
		$('.choose-local').hide();
		$('.choose-tab li').removeClass('active');
	})

	// 筛选
	$('.header-user').click(function(){
		if (dom.css('display') == 'none') {
			dom.show();mask.show();$('.confirm').show();
			if(screenScroll == null){
				screenScroll = new iScroll("screen", {vScrollbar: false,mouseWheel: true,click: true});
			}else{
				screenScroll.refresh();
			}
			$('.choose-local').hide();
			$('.choose-tab li').removeClass('active');
		}
		else{
			dom.hide();
			mask.hide();
			$('.confirm').hide();
		}
	})

	$('.scroll-screen').delegate("li", "click", function(){
		$(this).addClass('active').siblings().removeClass('active');
	})

	$('.confirm').click(function(){
		dom.hide();
		mask.hide();
		$('.confirm').hide();

		page = 1;
		getList();
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

		// var valid = $("#valid .active").attr("data-id");
		// data.push("valid="+valid);

		//获取字段
		var item = [];
		$("#filter .screen-box").each(function(index){
			var t = $(this), id = t.attr("data-id"), value = t.find(".active").attr("data-id");
			if(value != 0){
				item[index] = {
					"id": id,
					"value": value
				};
			}
		});
		data.push("item="+JSON.stringify(item));

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
