$(function(){

	var isload = false;
	var xiding = $(".choose");
	var chtop = parseInt(xiding.offset().top);

	// 显示下拉框
	$('.choose-tab li').click(function(){
		var index = $(this).index();
		var local = $('.choose-local').eq(index);
		if ( local.css("display") == "none") {
			$(this).addClass('active').siblings('.choose-tab li').removeClass('active');
			local.show().siblings('.choose-local').hide();
			$('.mask').show();
			$('body').scrollTop(chtop);
		}else{
			$(this).removeClass('active');
			local.hide();
			$('.mask').hide();

		}
	})

	// 分类
	var myscroll = new iScroll("choose-food", {vScrollbar: false});
	var myscroll0 = null;
	$('.food').click(function() {
		$('#choose-food').css('width','100%');
		$('.city-second,.more-second').hide();
		myscroll.refresh();
	});
	$('.choose-food li').click(function() {
		var html = $(this).find('.name').html(), id = $(this).attr("data-id");
		var dom = $(this).hasClass('right-more');
		$(this).addClass('active').siblings('.choose-food li').removeClass('active');
		if (dom) {
			$('.more-second').show();
			$('#choose-food').css('width', '40%');
			$("#more-second").html('<div class="loading">加载中...</div>');

			$.ajax({
				url: "/include/ajax.php?service=tuan&action=type&type="+id,
				type: "GET",
				dataType: "json",
				success: function (data) {
					if(data && data.state == 100){
						var list = [], info = data.info;
						list.push('<ul>');
						var url = typeUrl.replace("%id%", id);
						list.push('<li><a href="'+url+'"><span class="sub-name">全部</span></a></li>');
						for(var i = 0; i < info.length; i++){
							var url = typeUrl.replace("%id%", info[i].id);
							list.push('<li><a href="'+url+'"><span class="sub-name">'+info[i].typename+'</span></a></li>');
						}
						list.push('</ul>');

						$("#more-second").html(list.join(""));
						myscroll0 = new iScroll("more-second", {vScrollbar: false});

					}else{
						$("#more-second").html('<div class="loading">'+data.info+'</div>');
						myscroll0 = new iScroll("more-second", {vScrollbar: false});
					}
				}
			});

		} else {
			$('#choose-food').css('width', '100%');
			$('.more-second').hide();
			$('.food span').html(html);
			$('.food').removeClass('active');
			$('.choose-local,.mask').hide();
		}
	})



	// 全城
	var myscroll1 = new iScroll("choose-city-sq", {vScrollbar: false});
	var myscroll2 = new iScroll("choose-city-dt", {vScrollbar: false});
	var myscroll3 = null;
	$('.city').click(function(){
		$('.more-second').hide();
		$('.choose-city-area').css('width','100%');
		myscroll1.refresh();
		myscroll2.refresh();
	});
	$('.choose-area a').click(function(){
		$('.city-second').hide();
		$('.choose-city-area').css('width','100%')
		$(this).addClass('active').siblings('.choose-area a').removeClass('active');
		var index = $(this).index();
		$('.choose-city-area').eq(index).show().siblings('.choose-city-area').hide();
	})

	$('#choose-city-sq li').click(function(){
		var html = $(this).find('.name').html();
		var dom = $(this).hasClass('right-more');
		var id = $(this).attr("data-id");
		$(this).addClass('active').siblings('.choose-city-area li').removeClass('active');
		if (dom) {
			$('.city-second').show();
			$('.choose-city-area').css('width','40%');
			$("#city-second").html('<div class="loading">加载中...</div>');

			$.ajax({
				url: "/include/ajax.php?service=tuan&action=circle&type="+id,
				type: "GET",
				dataType: "json",
				success: function (data) {
					if(data && data.state == 100){
						var list = [], info = data.info;
						list.push('<ul>');
						var url = addrUrl.replace("%addr%", id).replace("%circle%", 0);
						list.push('<li><a href="'+url+'"><span class="sub-name">全部</span></a></li>');
						for(var i = 0; i < info.length; i++){
							var url = addrUrl.replace("%addr%", id).replace("%circle%", info[i].id);
							list.push('<li><a href="'+url+'"><span class="sub-name">'+info[i].name+'</span></a></li>');
						}
						list.push('</ul>');

						$("#city-second").html(list.join(""));
						myscroll3 = new iScroll("city-second", {vScrollbar: false});
					}else{
						$("#city-second").html('<div class="loading">'+data.info+'</div>');
						myscroll3 = new iScroll("city-second", {vScrollbar: false});
					}
				}
			});

		}
	});

	//公交地铁
	$('#choose-city-dt li').click(function(){
		var html = $(this).find('.name').html();
		var dom = $(this).hasClass('right-more');
		var id = $(this).attr("data-id");
		$(this).addClass('active').siblings('.choose-city-area li').removeClass('active');
		if (dom) {
			$('.city-second').show();
			$('.choose-city-area').css('width','40%');
			$("#city-second").html('<div class="loading">加载中...</div>');

			$.ajax({
				url: "/include/ajax.php?service=siteConfig&action=subwayStation&type="+id,
				type: "GET",
				dataType: "json",
				success: function (data) {
					if(data && data.state == 100){
						var list = [], info = data.info;
						list.push('<ul>');
						var url = addrUrl.replace("%addr%", id).replace("%circle%", 0);
						list.push('<li><a href="'+url+'"><span class="sub-name">全部</span></a></li>');
						for(var i = 0; i < info.length; i++){
							var url = subwayUrl.replace("%subway%", id).replace("%station%", info[i].id);
							list.push('<li><a href="'+url+'"><span class="sub-name">'+info[i].title+'</span></a></li>');
						}
						list.push('</ul>');

						$("#city-second").html(list.join(""));
						myscroll3 = new iScroll("city-second", {vScrollbar: false});
					}else{
						$("#city-second").html('<div class="loading">'+data.info+'</div>');
						myscroll3 = new iScroll("city-second", {vScrollbar: false});
					}
				}
			});

		}
	});


	// 默认排序
	var myscrollSort = new iScroll("choose-sort", {vScrollbar: false});
	$('.sort').click(function(){
		$('.city-second,.more-second').hide();
		myscrollSort.refresh();
	});

	$('.choose-sort li').click(function(){
		$(this).addClass('active').siblings('.choose-sort li').removeClass('active');
		var html = $(this).find('span').html();
		$('.sort span').html(html);
		$('.sort').removeClass('active');
		$('.choose-local,.mask').hide();

		getList(1);
	});


	// 筛选
	var myscrollFilter = new iScroll("choose-screen", {vScrollbar: false});
	$('.screen').click(function(){
		$('.city-second,.more-second').hide();
		myscrollFilter.refresh();
	})
	$('.eat-time li').click(function(){
		$(this).addClass('active').siblings('.eat-time li').removeClass('active');
	})
	$('.end-box .reset').click(function(){
		$('.eat-time').find('li:first').addClass('active').siblings('.eat-time li').removeClass('active');
		$('.sx-line input').prop("checked", false);
	})
	$('.end-box .save').click(function(){
		$('.choose-local,.mask').hide();
		$('.screen').removeClass('active');
		getList(1);
	})

	// 吸顶
	$(window).on("scroll", function() {
		var thisa = $(this);
		var st = thisa.scrollTop();
		if (st >= chtop) {
			$(".choose").addClass('choose-top');

		} else {
			$(".choose").removeClass('choose-top');

		}
	});

	$('.mask').on('touchstart',function(){
		$('.choose-local').hide();
		$('.mask').hide();
		$('.choose-tab ul li').removeClass('active')
	})

	// 下拉加载
	$(document).ready(function() {
		$(window).scroll(function() {
			var h = $('.shop-list').height();
			var allh = $('body').height();
			var w = $(window).height();
			var scroll = allh - h - w;

			//已经到底部，并且数据不在请求状态
			if ($(window).scrollTop() > scroll && !isload) {
				atpage++;
				isload = true;
				getList();
			};
		});
	});

	//初始加载
	getList();


	//数据列表
	function getList(tr){

		//如果进行了筛选或排序，需要从第一页开始加载
		if(tr){
			atpage = 1;
			$(".shop-box").html("");
		}

		//自定义筛选内容
		var item = [];
		$(".choose-screen .eat-time").each(function(){
			var t = $(this), field = t.data("field").replace("field_", ""), active = t.find(".active");
			if(active.text() != "不限"){
				item.push(field+","+active.text());
			}
		});

		//属性
		var flag = [];
		$(".choose-con .checkbox").each(function(){
			var t = $(this);
			t.find("input").is(":checked") ? flag.push(t.find("input").val()) : "";
		});

		$(".shop-box .loading").remove();
		$(".shop-box").append('<div class="loading">加载中...</div>');

		//请求数据
		var data = [];
		data.push("pageSize="+pageSize);
		data.push("typeid="+typeid);
		data.push("addrid="+addrid);
		data.push("business="+business);
		data.push("subway="+subway);
		data.push("station="+station);
		data.push("item="+item.join("$$"));
		data.push("orderby="+orderby);
		data.push("flag="+flag.join(","));
		data.push("title="+keywords);
		data.push("page="+atpage);

		$.ajax({
			url: "/include/ajax.php?service=tuan&action=tlist",
			data: data.join("&"),
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data){
					if(data.state == 100){
						$(".shop-box .loading").remove();
						var list = data.info.list, html = [];
						if(list.length > 0){
							for(var i = 0; i < list.length; i++){
								html.push('<div class="shop-list">');
								html.push('<a href="'+list[i].url+'">');
								html.push('<dl>');
								html.push('<dt><img src="'+cfg_staticPath+'/images/blank.gif" data-url="'+huoniao.changeFileSize(list[i].litpic, "small")+'">'+list[i].store.addrname[1]+'</dt>');
								html.push('<dd>');
								html.push('<div class="shop-txt">');
								html.push('<h3>'+list[i].title+'</h3>');
								html.push('<span class="price"><small>&yen;</small>'+list[i].price+'</span>');
								html.push('<div class="shop-star">');
								html.push('</div>');

								var sale = '';
								if(list[i].sale > 0){
									sale = '已售：'+list[i].sale;
								}
								html.push('<p><span class="shop-type">'+list[i].store.typename+'</span><span class="shop-addr r">'+sale+'</span></p>');
								html.push('</div>');

								//商圈
								if(list[i].store.circle){
									html.push('<p class="icon-txt"><em><img src="'+templatesSkin+'images/circle.png"></em>'+list[i].store.circle+'</p>');
								}

								//属性
								var attr = [], flag = list[i].flag;
								for(var a = 0; a < flag.length; a++){
									if(flag[a] == "yexiao"){
										attr.push('夜宵');
									}else if(flag[a] == "yuyue"){
										attr.push('免预约');
									}else if(flag[a] == "duotaocan"){
										attr.push('多套餐');
									}else if(flag[a] == "quan"){
										attr.push('代金券');
									}else if(flag[a] == "dujia"){
										attr.push('独家');
									}else if(flag[a] == "baozhang"){
										attr.push('保障');
									}else if(flag[a] == "baozhang"){
										attr.push('主推');
									}
								}
								if(attr){
									html.push('<p class="icon-txt"><em><img src="'+templatesSkin+'images/attr.png"></em>'+attr.join("、")+'</p>');
								}

								html.push('</dd>');
								html.push('</dl>');
								html.push('</a>');
								html.push('</div>');
							}

							$(".shop-box").append(html.join(""));
							$(".shop-box img").scrollLoading();
							isload = false;

							//最后一页
							if(atpage >= data.info.pageInfo.totalPage){
								isload = true;
								$(".shop-box").append('<div class="loading">已经到最后一页了</div>');
							}

						//没有数据
						}else{
							isload = true;
							$(".shop-box").append('<div class="loading">暂无相关信息</div>');
						}

					//请求失败
					}else{
						$(".shop-box .loading").html(data.info);
					}

				//加载失败
				}else{
					$(".shop-box .loading").html('加载失败');
				}
			},
			error: function(){
				isload = false;
				$(".shop-box .loading").html('网络错误，加载失败！');
			}
		});
	}

})