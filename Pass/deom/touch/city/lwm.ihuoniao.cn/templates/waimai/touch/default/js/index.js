$(function(){
	var mySwiper = new Swiper('.swiper-container',{pagination : '.swiper-pagination',})


	//加载商家列表
	var hallList = $(".near-box"), atpage = 1, pageSize = 20, listArr = [], totalPage = 0, isload = false;
	function getList(){
		isload = true;
		if(atpage == 1){
			hallList.html('');
			totalPage = 0;
		}
		hallList.find(".loading, .empty").remove();
		hallList.append('<div class="loading"><i></i>加载中...</div>');

		$.ajax({
			url: "/include/ajax.php?service=waimai&action=store",
			data: {
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
							li.push('<div class="near-list"><a href="'+lr.url+'">');
							li.push('<div class="near-list-img"><img src="'+lr.logo+'" alt="'+lr.title+'"></div>');
							li.push('<div class="near-list-txt"><h1><span>'+lr.title+'</span><em class="dist"></em></h1>');
							li.push('<div class="judge-box fn-clear">')

							if(lr.yy == "1"){
								li.push('<span class="sale-num l">'+lr.address+'</span>');
								li.push('<span class="sale-time r">'+lr.times+'分钟</span>');
							}else{
								li.push('<span class="xiuxi l">休息中</span>');
							}

							li.push('</div>');

							if(lr.yy == "1"){
								li.push('<div class="starting-price">');
								li.push('<span>起送价￥'+lr.price+'</span><em>|</em>');
								li.push('<span>配送费￥'+lr.peisong+'</span>');
								li.push('</div>');


								if(lr.sale != ""){
									var saleArr = lr.sale.split("$$"), sale = [];
									for (var s = 0; s < saleArr.length; s++) {
										var saleLi = saleArr[s].split(",");
										sale.push('<span>满'+saleLi[0]+'减'+saleLi[1]+'元</span>');
									}
									li.push('<p class="gray"><i class="sale">减</i>'+sale.join("；")+'</p>');
								}

								if(lr.supfapiao == "1"){
									li.push('<p class="gray"><i class="piao">票</i>'+lr.fapiaonote+'，'+lr.fapiao+'元起开'+'</p>');
								}
								if(lr.online == "1"){
									li.push('<p class="gray"><i class="online">付</i>该店铺支持在线支付</p>');
								}

							}
							li.push('</div>');

							li.push('</a></div>');
						}

						hallList.append(li.join(""));
					}else{

						if(atpage == 1){
							hallList.append('<div class="empty">抱歉，没有找到相关商户！</div>');
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
		var h = $('.footer').height() + $('.near-list').height() * 2;
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - h - w;
		if ($(window).scrollTop() > scroll && !isload) {
			atpage++;
			getList();
		};
	});


})


// 定位
var geolocation = new BMap.Geolocation();
geolocation.getCurrentPosition(function(r){
	if(this.getStatus() == BMAP_STATUS_SUCCESS){
		var geoc = new BMap.Geocoder();
		geoc.getLocation(r.point, function(rs){
			var rs = rs.addressComponents;
			$('.header-address em').html(rs.district + rs.street + rs.streetNumber)
		});
	}
	else {
		alert('failed'+this.getStatus());
	}
},{enableHighAccuracy: true})
