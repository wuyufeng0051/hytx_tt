$(function() {

	$('.h-menu').on('click', function() {
		if ($('.nav,.mask').css("display") == "none") {
			$('.nav,.mask').show();
			$('.header').css('z-index', '101');
			$('.choose-box').css('z-index', '88');

		} else {
			$('.nav,.mask').hide();
			$('.header').css('z-index', '99');
			$('.choose-box').css('z-index', '1002');

		}
	})

	$('.mask').on('touchstart', function() {
		$(this).hide();
		$('.nav').hide();
		$('.choose-local').hide();
		$('.choose li').removeClass('active');
		$('.header').css('z-index', '99');
		$('.choose-box').css('z-index', '1002');
		$('.choose-box').removeClass('choose-top');

	})

	var xiding = $(".choose-box");
	var chtop = parseInt(xiding.offset().top);
	var myscroll_price = new iScroll("scroll-price", {vScrollbar: false});
	var myscroll_mj = new iScroll("scroll-area", {vScrollbar: false,});
	var myscroll_area = new iScroll("area-box", {vScrollbar: false});
	var myscroll_more = new iScroll("more-box", {vScrollbar: false});
	// 选择
	$('.choose li').each(function(index) {
		$(this).click(function() {
			if ($('.choose-local').eq(index).css("display") == "none") {
				$(this).addClass('active').siblings().removeClass('active');
				$('.choose-local').eq(index).show().siblings('.choose-local').hide();
				myscroll_price.refresh();
				myscroll_mj.refresh();
				myscroll_area.refresh();
				myscroll_more.refresh();
				$(this).parents('.choose-box').addClass('choose-top');

				$('.mask').show();
				$('body').scrollTop(chtop);
				$('.white').show()
			} else {
				$('.choose-local').eq(index).hide();
				$('.choose li').removeClass('active');
				$('.mask').hide();
				$('.white').hide()
				$(this).parents('.choose-box').removeClass('choose-top');
			}

		})
	})

	$('.choose-local li').click(function() {
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
	})

	// 点击一级区域
	$('#area-box li').click(function(){
		var a = $(this),id = a.data('area'),name = a.children('a').text();
		if(id){
			$.ajax({
				url: "/include/ajax.php?service=house&action=addr&type="+id,
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data){
						if(data.state == 100){
							var info = data.info,len = info.length,html = ['<li data-area="'+id+'" data-pname="'+name+'"><a href="javascript:;">全部</a></li>'];
							for(var i = 0; i < len; i++){
								var obj = info[i];
								html.push('<li data-area="'+obj.id+'"><a href="javascript:;">'+obj.typename+'</a></li>');
							}
							$("#scroll-third .scroll").html(html.join(""));
							$('.cf .choose-local-second').css('width', '60.72%');
							$('.area-third .choose-local-third').show();
							myscroll = new iScroll("scroll-third", {
								vScrollbar: false
							});
						}else{

						}
					}
				},
				error : function(){

				}
			})

		}else{
			$('.cf .choose-local-second').css('width', '100%');
			$('.area-third .choose-local-third').hide();
			$('.choose-local').hide();
			$('.mask').hide();
			$('.choose li').removeClass('active');
			$('.tab-area span').html('不限');
			$('.white').hide();

			$('.tab-addrid').attr('data-id','').find('span').text('不限');
			getList(1);
		}
	})

	// 选择二级区域
	$('.area-third .choose-local-third').on('click', 'li', function() {
		var a = $(this),id = a.data('area'),name = a.children('a').text();
		if(a.hasClass('active')) return;
		a.addClass('active').siblings().removeClass('active');
		if(name == '全部'){
			name = a.data('pname');
		}
		$('.tab-addrid span').html(name);
		$('.choose-local').hide();
		$('.mask').hide();
		$('.choose li').removeClass('active');
		$('.white').hide()
		$('.tab-addrid').attr('data-id',id);

		getList(1);
	})

	// 点击筛选条件 筛选地区不在内
	$('.choose-local').not('.choose-area').find('li').click(function(){
		var obj = $(this),id = obj.data('id') || '',name = obj.children('a').text(),p = obj.parents('.choose-local');

		var type = p.data('type');
		$('.tab-'+type).attr('data-id',id).find('span').html(name);
		p.hide();
		$('.mask').hide();
		$('.choose li').removeClass('active');
		$('.white').hide();

		getList(1);
	})

	$(window).on("scroll", function() {
		var thisa = $(this);
		var st = thisa.scrollTop();
		if (st >= chtop) {
			$(".choose-box").addClass('choose-top');

		} else {
			$(".choose-box").removeClass('choose-top');

		}
	});

	// 下拉加载
	$(document).ready(function() {
		$(window).scroll(function() {
			var h = $('.footer').height() + $('.house-box').height() * 2;
			var allh = $('body').height();
			var w = $(window).height();
			var scroll = allh - h - w;
			if ($(window).scrollTop() > scroll && !isload) {
				atpage++;
				getList();
			};
		});
	});

	// 头部切换类别
	$('#sptype').change(function(){
		getList(1);
	})

	// 搜索
	$('.search-box').submit(function(e){
		e.preventDefault();
		$('#search_button').click();
	})
	$('#search_button').click(function(){
		var keywords = $('#search_keyword').val();
		getList(1);
	})

	//初始加载
	getList();

	//数据列表
	function getList(tr){

		isload = true;

		//如果进行了筛选或排序，需要从第一页开始加载
		if(tr){
			atpage = 1;
			$(".house-list").html("");
		}

		//自定义筛选内容
		var item = [];
		$(".choose-more-condition ul").each(function(){
			var t = $(this), active = t.find(".active");
			if(active.text() != "不限"){
			}
		});


		$(".house-list .loading").remove();
		$(".house-list").append('<div class="loading">加载中...</div>');

		//请求数据
		var data = [];
		data.push("pageSize="+pageSize);
		data.push("type="+$('#sptype').val());

		$('.choose li').each(function(){
			var obj = $(this),cls = obj.attr('class'),field = cls.split('-')[1];
			var val = obj.attr('data-id');
			if(val){
				data.push(field+"="+val);
			}
		})


		//更新筛选条件
		$(".choose-more-condition").each(function(){
			var t = $(this), type = t.attr("data-type"), val = t.find(".active").attr('data-id');
			if(val != undefined && val != ""){
				data.push(type+"="+val);
			}
		});

		data.push("page="+atpage);

		var keywords = $('#search_keyword').val();
		data.push("keywords="+keywords);

		$.ajax({
			url: "/include/ajax.php?service=house&action="+action,
			data: data.join("&"),
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				$('.choose-box').removeClass('choose-top');
				if(data){
					if(data.state == 100){
						$(".house-list .loading").remove();
						var list = data.info.list, html = [];
						if(list.length > 0){
							for(var i = 0; i < list.length; i++){

								var pic = list[i].litpic == false || list[i].litpic == '' ? '/static/images/blank.gif' : list[i].litpic;

								html.push('<div class="house-box">');
								html.push('<a href="'+list[i].url+'">');
								html.push('<div class="house-item">');
								html.push('<div class="house-img l"><img src="'+pic+'" alt="'+list[i].title+'"></div>');
								html.push('<dl class="l">');

								html.push('<dt>'+list[i].title+'</dt>');
								var price = list[i].price / 1000 + '万';
								if(list[i].type != 2){
									price += '/月';
								}
								html.push('<dd class="item-area"><em>'+list[i].addr[0]+'-'+list[i].addr[1]+'</em><span class="price r">&yen;'+price+'</span></dd>');
								html.push('<dd class="item-type-1"><em>'+list[i].protype+'</em><em>面积：'+list[i].area+'㎡</em></dd>');
								var utype = list[i].usertype == 0 ? '无中介费' : '中介';
								html.push('<dd class="item-type-2"><span>'+utype+'</span></dd>');
								html.push('</dl>')
								html.push('</div>')
								html.push('<div class="clear"></div>')
								html.push('</a>')
								html.push('</div>')
							}

							$(".house-list").append(html.join(""));
							isload = false;

							//最后一页
							if(atpage >= data.info.pageInfo.totalPage){
								isload = true;
								$(".house-list").append('<div class="loading">已经到最后一页了</div>');
							}

						//没有数据
						}else{
							isload = true;
							$(".house-list").append('<div class="loading">暂无相关信息</div>');
						}

					//请求失败
					}else{
						$(".house-list .loading").html(data.info);
					}

				//加载失败
				}else{
					$(".house-list .loading").html('加载失败');
				}
			},
			error: function(){
				isload = false;
				$(".house-list .loading").html('网络错误，加载失败！');
				$('.choose-box').removeClass('choose-top');
			}
		});
	}

})
