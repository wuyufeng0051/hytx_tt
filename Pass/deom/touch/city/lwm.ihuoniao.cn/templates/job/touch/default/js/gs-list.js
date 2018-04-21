$(function() {

	var dom = $('#screen'),
		mask = $('.mask'),
		tabTop = $('.choose-tab').offset().top,  // 吸顶
		areaScroll = infoScroll = sortScroll = moreScroll = null,
		areaArr = infoArr = sortArr = moreArr = sortSecondArr = [],
		chooseScroll = function(obj){
			return new iScroll(obj, {vScrollbar: false, mouseWheel: true, click: true});
		},

		init = {

			//区域
			getArea: function(){
				var areaObj = $("#choose-area");
				$.ajax({
			        url: masterDomain + '/include/ajax.php?service=job&action=addr&son=1',
			        dataType: 'jsonp',
			        success: function(data){
			          if(data.state == 100){

			            var list = data.info;
			            var html = [];
			            html.push('<li data-id="">不限</li>');
			            for(var i = 0; i < list.length; i++){
			              html.push('<li data-id="'+list[i].id+'">'+list[i].typename+'</li>');
			              areaArr[list[i].id] = list[i].lower;
			            }

			            areaObj.html('<ul>'+html.join("")+'</ul>');
			            areaScroll = chooseScroll("choose-area");

			          }else{
			            areaObj.html('<div class="load">'+data.info+'</div>');
			          }
			        },
			        error: function(){
			        	areaObj.html('<div class="load">网络错误！</div>');
			        }
			    });
			},

			//行业领域
			getInfo: function(){
				var infoObj = $("#choose-info");
				$.ajax({
			        url: masterDomain + '/include/ajax.php?service=job&action=industry&son=1',
			        dataType: 'jsonp',
			        success: function(data){
			          if(data.state == 100){

			            var list = data.info;
			            var html = [];
			            html.push('<li data-id="">不限</li>');
			            for(var i = 0; i < list.length; i++){
			              html.push('<li data-id="'+list[i].id+'">'+list[i].typename+'</li>');
			              infoArr[list[i].id] = list[i].lower;
			            }

			            infoObj.html('<ul>'+html.join("")+'</ul>');
			            infoScroll = chooseScroll("choose-info");

			          }else{
			            infoObj.html('<div class="load">'+data.info+'</div>');
			          }
			        },
			        error: function(){
			        	infoObj.html('<div class="load">网络错误！</div>');
			        }
			    });
			},
		}


	// 筛选框
	$('.choose-tab li').click(function(){

		var $t = $(this),
		 index = $t.index(),
		   box = $('.choose-box .choose-local').eq(index);

		 if (box.css("display")=="none") {

		 	$t.addClass('active').siblings().removeClass('active');
		 	box.show().siblings().hide();dom.hide();

		 	if (index == 0 && areaScroll == null) {
		 		init.getArea();
		 	}

		 	if (index == 1 && infoScroll == null) {
		 		init.getInfo();
		 	}

		 	if (index == 2 && sortScroll == null) {
		 		sortScroll = chooseScroll("choose-sort");
		 	}

		 	if (index == 3 && moreScroll == null) {
		 		moreScroll = chooseScroll("choose-more");
		 	}

		 	mask.show();

		 }else{

		 	$t.removeClass('active');
		 	box.hide();mask.hide();

		 }

	});


	// 工作地点二级
	$('#choose-area').delegate("li", "click", function(){

		var t     = $(this),
			index = t.index(),
			id    = t.attr('data-id'),
	   localIndex = t.closest('.choose-local').index();

		if (index == 0) {

			var type  = t.attr("data-id"),
		  		type = type == undefined ? "" : type;

	 		$(".choose-tab li").eq(index).attr("data-id", type);

			$('#area-box .choose-stage-l').removeClass('choose-stage-l-short');
			t.addClass('current').siblings().removeClass('active');
			t.closest('.choose-local').hide();
			$('#area-box .choose-stage-r').hide();
			$('.choose-tab li').eq(localIndex).removeClass('active').find('span').text("不限");
			mask.hide();
			getList(1);


		}else{

			t.siblings().removeClass('current');
			t.addClass('active').siblings().removeClass('active');
			$('#area-box .choose-stage-l').addClass('choose-stage-l-short');
			$('#area-box .choose-stage-r').show();

			var lower = areaArr[id], html = [];
			if(lower){
	            for(var i = 0; i < lower.length; i++){
	              html.push('<li data-id="'+lower[i].id+'">'+lower[i].typename+'</li>');
	            }

	            $("#choose-area-second").html('<ul>'+html.join("")+'</ul>');
	            chooseScroll("choose-area-second");
			}


		}


	})

	// 行业领域二级
	$('#choose-info').delegate("li", "click", function(){

		var t     = $(this),
			index = t.index(),
			id    = t.attr('data-id'),
	   localIndex = t.closest('.choose-local').index();

		if (index == 0) {

			var type  = t.attr("data-id"),
		  		type = type == undefined ? "" : type;

	 		$(".choose-tab li").eq(index).attr("data-id", type);

			$('#info-box .choose-stage-l').removeClass('choose-stage-l-short');
			t.addClass('current').siblings().removeClass('active');
			t.closest('.choose-local').hide();
			$('#info-box .choose-stage-r').hide();
			$('.choose-tab li').eq(localIndex).removeClass('active').find('span').text("不限");
			mask.hide();
			getList(1);

		}else{

			t.siblings().removeClass('current');
			t.addClass('active').siblings().removeClass('active');
			$('#info-box .choose-stage-l').addClass('choose-stage-l-short');
			$('#info-box .choose-stage-r').show();

			var lower = infoArr[id], html = [];
			if(lower){
	            for(var i = 0; i < lower.length; i++){
	              html.push('<li data-id="'+lower[i].id+'">'+lower[i].typename+'</li>');
	            }

	            $("#choose-info-second").html('<ul>'+html.join("")+'</ul>');
	            chooseScroll("choose-info-second");
			}


		}


	})




	// 一级筛选  地址和排序
	$('#choose-info-second, #choose-area-second, #choose-more, #choose-sort').delegate("li", "click", function(){

		var $t = $(this),
		   val = $(this).html(),
		 local = $t.closest('.choose-local'),
		 index = local.index(),
		 type  = $t.attr("data-id"),
		 type = type == undefined ? "" : type;

 		$(".choose-tab li").eq(index).attr("data-id", type);
		$t.addClass('on').siblings().removeClass('on');

		$('.choose-tab li').eq(index).removeClass('active').find('span').text(val);

		local.hide();mask.hide();
		getList(1);

	})



	// 遮罩层
	$('.mask').on('touchstart',function(){

		mask.hide();dom.hide();
		$('.choose-local').hide();
		$('.choose-tab li').removeClass('active');

	})

	$('.footer li').click(function(){

		$(this).addClass('active').siblings().removeClass('active');

	})




	// 下拉加载
	$(document).ready(function() {
		$(window).scroll(function() {
			var h = $('.gs-tit').height();
			var allh = $('body').height();
			var w = $(window).height();
			var scroll = allh - w;
			if ($(window).scrollTop() > scroll && !isload) {
				atpage++;
				getList();

			};
		});
	});

	//初始加载
	getList();

	//数据列表
	function getList(tr){

		isload = true;

		//如果进行了筛选或排序，需要从第一页开始加载
		if(tr){
			atpage = 1;
			$(".list-box").html("");
		}

		//自定义筛选内容
		var item = [];
		$(".choose-more-condition ul").each(function(){
			var t = $(this), active = t.find(".active");
			if(active.text() != "不限"){
			}
		});


		$(".list-box .loading").remove();
		$(".list-box").append('<div class="loading">加载中...</div>');

		//请求数据
		var data = [];
		data.push("pageSize="+pageSize);
		data.push("type="+$('#sptype').val());

		var addrid = $(".tab-area").attr("data-id");
		addrid = addrid == undefined ? "" : addrid;
		if(addrid != ""){
			data.push("addrid="+addrid);
		}

		var industry = $(".tab-industry").attr("data-id");
		industry = industry == undefined ? "" : industry;
		if(industry != ""){
			data.push("industry="+industry);
		}

		var nature = $(".tab-nature").attr("data-id");
		nature = nature == undefined ? "" : nature;
		if(nature != ""){
			data.push("nature="+nature);
		}

    var scale = $(".tab-scale").attr("data-id");
    scale = scale == undefined ? "" : scale;
    if(scale != ""){
      data.push("scale="+scale);
    }


		data.push("page="+atpage);

		var keywords = $('#search_keyword').val();
		data.push("keywords="+keywords);

		$.ajax({
			url: "/include/ajax.php?service=job&action=company",
			data: data.join("&"),
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data){
					if(data.state == 100){
						$(".list-box .loading").remove();
						var list = data.info.list, html = [];
						if(list.length > 0){
							for(var i = 0; i < list.length; i++){
								html.push('<ul>');
								html.push('<li>');
								html.push('<a href="'+list[i].url+'" class="fn-clear">');
								html.push('<div class="gs-tit fn-clear">');
								html.push('<div class="tit-img"><img src="'+list[i].logo+'"></div>');
								html.push('<div class="tit-txt">');

								html.push('<h3>'+list[i].title+'</h3>');

								//区域
								html.push('<p>');
								html.push('<span>'+list[i].addr+'</span>');
								html.push('<span class="num">职位（'+list[i].pcount+'）</span>');
								html.push('</p>');


								html.push('<p class="tit-info">');
								html.push('<span>'+list[i].nature+'</span>');
								html.push('<em>|</em>');
								html.push('<span>'+list[i].scale+'</span>');
								html.push('<em>|</em>');
								html.push('<span>'+list[i].industry+'</span>');
								html.push('</p>')


								html.push('</div>')
								html.push('</div>')
								html.push('</a>')
								html.push('</li>')
								html.push('</ul>')


							}

							$(".list-box").append(html.join(""));
							isload = false;

							//最后一页
							if(atpage >= data.info.pageInfo.totalPage){
								isload = true;
								$(".list-box").append('<div class="loading">已经到最后一页了</div>');
							}

						//没有数据
						}else{
							isload = true;
							$(".list-box").append('<div class="loading">暂无相关信息</div>');
						}

					//请求失败
					}else{
						$(".list-box .loading").html(data.info);
					}

				//加载失败
				}else{
					$(".list-box .loading").html('加载失败');
				}
			},
			error: function(){
				isload = false;
				$(".list-box .loading").html('网络错误，加载失败！');
			}
		});
	}



})
