$(function(){

	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('.screen_list ul').css('top', 'calc(.92rem + 20px)');
	}

  var xiding = $(".screen");
  var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.screen ul li').click(function(){
    var $t = $(this),
     index = $t.index(),
       box = $('.screen_list ul').eq(index);
     if (box.css("display")=="none") {
        $t.addClass('cur').siblings().removeClass('cur');
        box.show().siblings().hide();
        $('.disk').show();
        $('body').scrollTop(chtop);
     }else{
        $t.removeClass('cur');
        box.hide();
        $('.disk').hide();
     }
  })
	$('.screen_list ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest("ul").index();
			var  lead = $('.screen  ul li').eq(index);
			x.addClass('leib');
	      	x.siblings('li').removeClass('leib');
			$('.disk').hide();
	      	$('.screen_list  ul').hide();
			$('.screen  ul li').removeClass('cur');
			$('body').removeClass('by');
			$('.screen li').eq(index).attr('data-id', id);
			getList(1);
		})

		// 遮罩层
    $('.disk').on('click',function(){
      $('.disk').hide();
      $('.screen_list  ul').hide();
      $('.screen ul li').removeClass('cur');
  		$('.yuyue_list').hide();
      $('.stylist_lead').removeClass('sc_1');
			$('.screen').removeClass('sc_1');
    })
		$('.disk').on('touchmove',function(){
      $('.disk').hide();
      $('.screen_list  ul').hide();
      $('.screen ul li').removeClass('cur');
  		$('.yuyue_list').hide();
      $('.stylist_lead').removeClass('sc_1');
			$('.screen').removeClass('sc_1');
    })

		// 吸顶
    $(window).on("scroll", function() {
        var thisa = $(this);
        var st = thisa.scrollTop();
        if (st >= chtop) {
            $(".screen ").addClass('deco_pic_lead-top1');
						if (device.indexOf('huoniao_iOS') > -1) {
							$('.screen').addClass('padTop20');
						}
            $('.stylist-list').css('margin-top', '1.1rem');
        } else {
            $(".screen ").removeClass('deco_pic_lead-top1 padTop20');
            $('.stylist-list').css('margin-top', '0');

        }
    });
    // 免费预约
    $('.sty_dao .yuyue').click(function(){
    	var  x = $(".yuyue_list");
    	if (x.css("display")=="none") {
    		x.show();
    		$('.disk').show();
    		$('body').addClass('by');
    		$('.screen').addClass('sc_1');
    		$('.stylist_lead').addClass('sc_1');
    	}else{
    		x.hide();
    		$('.disk').hide();
    		$('body').removeClass('by');
    		$('.screen').removeClass('sc_1');
    		$('.stylist_lead').removeClass('sc_1');
    	}
    })
    $('.yuyue_list p').click(function(){
    	$('.disk').hide();
		$('body').removeClass('by');
    	$('.yuyue_list').hide();
    	$('.stylist_lead').removeClass('sc_1');
		$('.screen').removeClass('sc_1');
    })

		// 下拉加载
		$(document).ready(function() {
			$(window).scroll(function() {
				var h = $('.sty_1').height() * 2;
				var allh = $('body').height();
				var w = $(window).height();
				var scroll = allh - h - w;
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
				$("#list").html("");
			}


			$("#list .loading").remove();
			$("#list").append('<div class="loading">加载中...</div>');

			//请求数据
			var data = [];
			data.push("pageSize="+pageSize);

			var special = $(".tab-special").attr("data-id");
			special = special == undefined ? "" : special;
			if(special != ""){
				data.push("special="+special);
			}

			var style = $(".tab-style").attr("data-id");
			style = style == undefined ? "" : style;
			if(style != ""){
				data.push("style="+style);
			}

			var works = $(".tab-works").attr("data-id");
			works = works == undefined ? "" : works;
			if(works != ""){
				data.push("works="+works);
			}

			var orderby = $(".tab-orderby").attr("data-id");
			orderby = orderby == undefined ? "" : orderby;
			if(orderby != ""){
				data.push("orderby="+orderby);
			}


			data.push("page="+atpage);


			$.ajax({
				url: "/include/ajax.php?service=renovation&action=team",
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

									html.push('<div class="sty_1">');
									html.push('<a href="'+list[i].url+'">');
									html.push('<div class="sty_com">');
									html.push('<div class="sty_pic"><img src="'+list[i].photo+'"></div>');
									html.push('<div class="sty_infor">');


									html.push('<h1>'+list[i].name+'<p></p></h1>');
									html.push('<span>职位：<em>'+list[i].post+'</em></span>');
									html.push('<p>工作经验：<i>'+list[i].works+'年</i></p>');
									html.push('<b>擅长风格：<s class="blue">简约</s><s class="pink">中式</s></b>');
									html.push('</div>');
									html.push('</div>');
									html.push('</a>');


									html.push('<div class="sty_dao fn-clear">');
									html.push('<ul>');
									html.push('<li class="host"><a href="'+list[i].url+'">主页</a></li>');
									html.push('<li class="yuyue"><a href="'+list[i].url+'">免费预约</a></li>');
									html.push('<li class="anli"><a href="'+list[i].url+'">案例('+list[i].diary+')</a></li>');
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
