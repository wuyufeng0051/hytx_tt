$(function(){
	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('.deco_pic_lead').addClass('padTop20');
		$('.pic_lead_list ul').css('top', 'calc(.92rem + 20px)');
	}

	var xiding = $(".deco_pic_lead");
	var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.deco_pic_lead ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.pic_lead_list ul').eq(index);
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
		$('.pic_lead_list ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest("ul").index();
			var  lead = $('.deco_pic_lead  ul li').eq(index);
			x.addClass('leib');
					x.siblings('li').removeClass('leib');
			$('.disk').hide();
					$('.pic_lead_list  ul').hide();
			$('.deco_pic_lead  ul li').removeClass('cur');
		})
		// 遮罩层
    $('.disk').on('touchstart',function(){
        $('.disk').hide();
        $('.pic_lead_list  ul').hide();
        $('.deco_pic_lead ul li').removeClass('cur');
    })


		// 下拉加载
		$(document).ready(function() {
			$(window).scroll(function() {
				var allh = $('body').height();
				var w = $(window).height();
				var scroll = allh - 200 - w;
				if ($(window).scrollTop() > scroll && !isload) {
					atpage++;
					getList();
				};
			});
		});

		// 吸顶
    var xiding = $(".deco_pic_lead");
    var chtop = parseInt(xiding.offset().top);
		$(window).on("scroll", function() {
  		var thisa = $(this);
  		var st = thisa.scrollTop();
  		if (st >= chtop) {
  			$(".deco_pic_lead").addClass('deco_pic_lead-top1');
  		} else {
  			$(".deco_pic_lead").removeClass('deco_pic_lead-top1');
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
			$("#list_1").html("");
			$("#list_2").html("");
		}


		$("#list .loading").remove();
		$("#list").append('<div class="loading">加载中...</div>');

		//请求数据
		var data = [];
		data.push("pageSize="+pageSize);

		var zhType = $(".tab-type").attr("data-id");

		// 类别
		data.push("type="+zhType);

		if(zhType == 0){

			// 风格
			var style = $(".tab-style").attr("data-id");
			style = style == undefined ? "" : style;
			if(style != ""){
				data.push("style="+style);
			}

			// 空间
			var kongjian = $(".tab-kongjian").attr("data-id");
			kongjian = kongjian == undefined ? "" : kongjian;

			if(kongjian != ""){
				data.push("kongjian="+kongjian);
			}

			// 局部
			var jubu = $(".tab-jubu").attr("data-id");
			jubu = jubu == undefined ? "" : jubu;
			if(jubu != ""){
				data.push("jubu="+jubu);
			}

			// 户型
			var units = $(".tab-units").attr("data-id");
			units = units == undefined ? "" : units;
			if(units != ""){
				data.push("units="+units);
			}

			// 造价
			var apartment = $(".tab-apartment").attr("data-id");
			apartment = apartment == undefined ? "" : apartment;
			if(apartment != ""){
				data.push("apartment="+apartment);
			}



		}else{

			// 类型
			var comstyle = $(".tab-comstyle").attr("data-id");
			comstyle = comstyle == undefined ? "" : comstyle;
			if(comstyle != ""){
				data.push("comstyle="+comstyle);
			}

		}


		data.push("page="+atpage);


		$.ajax({
			url: "/include/ajax.php?service=renovation&action=rcase",
			data: data.join("&"),
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data){
					if(data.state == 100){
						$("#list .loading").remove();
						var list = data.info.list, html1 = [], html2 = [];
						if(list.length > 0){
							for(var i = 0; i < list.length; i++){

								if ((i % 2) == 0) {
									html1.push('<li>');
									html1.push('<a href="'+list[i].url+'" class="fn-clear">');
									html1.push('<img src="'+list[i].litpic+'">');
									html1.push('<span>'+list[i].title+'</span>');
									html1.push('<p>浏览量：<em>'+list[i].click+'</em></p>');
									html1.push('</a>');
									html1.push('</li>');
								}else {
									html2.push('<li>');
									html2.push('<a href="'+list[i].url+'" class="fn-clear">');
									html2.push('<img src="'+list[i].litpic+'">');
									html2.push('<span>'+list[i].title+'</span>');
									html2.push('<p>浏览量：<em>'+list[i].click+'</em></p>');
									html2.push('</a>');
									html2.push('</li>');
								}

							}

							$("#list_1").append(html1.join(""));
							$("#list_2").append(html2.join(""));

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
