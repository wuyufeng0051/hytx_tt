$(function(){

	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('.coms_l ul').css('top', 'calc(.8rem + 20px)');
	}

	var xiding = $(".com_screen");
  var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.com_screen ul li').click(function(){
    var $t = $(this), index = $t.index(),box = $('.coms_l ul').eq(index);

     if (box.css("display")=="none") {
        $t.addClass('cur').siblings().removeClass('cur');
        box.show().siblings().hide();
        $('.disk').show();
        $(".com_screen").addClass('com_screen_top');
				if (device.indexOf('huoniao_iOS') > -1) {
			 		$('.com_screen').addClass('padTop20');
			 	}
     }else{
        $t.removeClass('cur');
        box.hide();
        $('.disk').hide();
        // $(".com_screen").removeClass('padTop20');
     }
		 $('body').scrollTop(chtop + 2);
    })
		$('.coms_l ul li ').click(function(){
			var  x = $(this), index = x.closest("ul").index(), id = x.attr('data-id'), lead = $('.com_screen ul li').eq(index);
			lead.attr('data-id', id);
			x.addClass('leib').siblings('li').removeClass('leib');
			$('.disk, .coms_l ul').hide();
			$('.com_screen ul li').removeClass('cur');
			$(".com_screen").removeClass('com_screen_top padTop20');
			getList(1);
		})
     // 遮罩层
    $('.disk').on('touchmove',function(){
			listHide();
    })
		$('.disk').on('click',function(){
			listHide();
		})

		function listHide(){
			$('.disk, .coms_l  ul').hide();
      $('.com_screen ul li').removeClass('cur');
      $('.stylist_lead').removeClass('sc_1');
			$('.screen').removeClass('sc_1');
			$(".com_screen").removeClass('com_screen_top padTop20');
		}

    // 吸顶
    $(window).on("scroll", function() {
			var thisa = $(this);
			var st = thisa.scrollTop();
			if (st >= chtop) {
				$(".com_screen").addClass('com_screen_top');
				if (device.indexOf('huoniao_iOS') > -1) {
			 		$('.com_screen').addClass('padTop20');
			 	}
			} else {
				$(".com_screen").removeClass('com_screen_top padTop20');
			}
		});


		//初始加载
		getList();

		//数据列表
		function getList(tr){

			isload = true;

			//如果进行了筛选或排序，需要从第一页开始加载
			if(tr){
				atpage = 1;
				$("#list").html("");
			}


			$("#list .loading").remove();
			$("#list").append('<div class="loading">加载中...</div>');

			//请求数据
			var data = [];
			data.push("pageSize="+pageSize);

			var jiastyle = $(".tab-jiastyle").attr("data-id");
			jiastyle = jiastyle == undefined ? "" : jiastyle;
			if(jiastyle != ""){
				data.push("jiastyle="+jiastyle);
			}

			var comstyle = $(".tab-comstyle").attr("data-id");
			comstyle = comstyle == undefined ? "" : comstyle;
			if(comstyle != ""){
				data.push("comstyle="+comstyle);
			}

			var range = $(".tab-range").attr("data-id");
			range = range == undefined ? "" : range;
			if(range != ""){
				data.push("range="+range);
			}

			var style = $(".tab-style").attr("data-id");
			style = style == undefined ? "" : style;
			if(style != ""){
				data.push("style="+style);
			}


			data.push("page="+atpage);


			$.ajax({
				url: "/include/ajax.php?service=renovation&action=store",
				data: data.join("&"),
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data){
						if(data.state == 100){
							$("#list .loading").remove();
							var list = data.info.list, html = [];
							if(list.length > 0){
								for(var i = 0; i < list.length; i++){

									html.push('<div class="com_infor fn-clear">');
									html.push('<a href="'+list[i].url+'" class="fn-clear">');
									html.push('<img src="'+list[i].logo+'" alt="">');
									html.push('<div class="information">');
									html.push('<h1>'+list[i].company+'</h1>');
									html.push('<span>认证：');

									var license = list[i].license;
									if (license == 1) {
										html.push('<i class="ying">营</i>');
									}

									var certi = list[i].certi;
									if (certi == 1) {
										html.push('<i class="ren">认</i>');
									}

									var saleCount = list[i].saleCount;
									if (saleCount > 0) {
										html.push('<i class="hui">惠</i>');
									}else {
										html.push('<i class="hui no">惠</i>');
									}

									var safeguard = list[i].safeguard;
									if (safeguard > 0) {
										html.push('<i class="jin">金</i>'+list[i].safeguard+'');
									}else {
										html.push('<i class="jin no">金</i>');
									}

									var guestCount = list[i].guestCount;
									if (guestCount > 0) {
										html.push('<i class="ping">评</i>'+list[i].guestCount+'');
									}else {
										html.push('<i class="ping no">评</i>');
									}

									html.push('</span>');
									html.push('<div class="have">');
									html.push('<b>案例：<em>'+list[i].diaryCount+'</em>套</b>');
									html.push('<b>效果图：<em>'+list[i].caseCount+'</em>套</b>');
									html.push('<s>拥有设计师：<em>'+list[i].teamCount+'</em>位</s>');
									html.push('</div>');
									html.push('</div>');
									html.push('</a>');
									html.push('<div class="com_infor_l fn-clear">');
									html.push('<ul>');
									html.push('<li class="first"><a href="'+list[i].url+'">店铺</a></li>');
									html.push('<li class="mid"><a href="tel:'+list[i].contact+'">一键呼叫</a></li>');
									html.push('<li class="last"><a href="'+list[i].url+'">案例('+list[i].diaryCount+')</a></li>');
									html.push('</ul>');
									html.push('</div>');
									html.push('</div>');


								}

								$("#list").append(html.join(""));
								isload = false;

								//最后一页
								if(atpage >= data.info.pageInfo.totalPage){
									isload = true;
									$("#list").append('<div class="loading">已经到最后一页了</div>');
								}

							//没有数据
							}else{
								isload = true;
								$("#list").append('<div class="loading">暂无相关信息</div>');
							}

						//请求失败
						}else{
							$("#list .loading").html(data.info);
						}

					//加载失败
					}else{
						$("#list .loading").html('加载失败');
					}
				},
				error: function(){
					isload = false;
					$("#list .loading").html('网络错误，加载失败！');
					$('.choose-box').removeClass('choose-top');
				}
			});
		}






})
