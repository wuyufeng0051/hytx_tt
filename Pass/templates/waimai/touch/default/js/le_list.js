$(function(){
	var xiding = $(".nav_lead");
  var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.nav_lead ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.nav_txt .nav').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('nav_lbc').siblings().removeClass('nav_lbc');
            box.show().siblings().hide();
            $('.disk').show();
            // $('body').addClass('by');
            $(".nav_lead").addClass('com_screen_top');
            $('body').scrollTop(chtop);
            $('.navigation').addClass('com_screen_top')
         }else{
            $t.removeClass('nav_lbc');
            box.hide();
            $('.disk').hide();
            // $('body').removeClass('by');
            $('.navigation').removeClass('com_screen_top')
            $(".nav_lead").removeClass('com_screen_top');
         }
    })
	$('.nav_txt .nav ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest(".nav").index();
			var  lead = $('.nav_lead  ul li').eq(index);
			var  b = x.find('a').text();
			$(lead).find('em').text(b);
			x.addClass('nav_bc');
	      	x.siblings('li').removeClass('nav_bc');
			$('.disk').hide();
	      	$('.nav_txt .nav').hide();
			$('.nav_lead ul li').removeClass('nav_lbc');
			// $('body').removeClass('by');
            $('.navigation').removeClass('com_screen_top')
			$(".nav_lead").removeClass('com_screen_top');

            var utype = x.closest("ul").data("type");
            var uid = x.data("id");

            if(utype == "type"){
                typeid = uid;
            }else if(utype == "orderby"){
                orderby = uid;
            }else if(utype == "yingye"){
                yingye = uid;
            }

            page = 1;
            getList();
		})
     // 遮罩层
    $('.disk').on('click',function(){
        $('.disk').hide();
        $('.nav_txt .nav').hide();
        $('.nav_lead ul li').removeClass('nav_lbc');
            $('.navigation').removeClass('com_screen_top')
        // $('body').removeClass('by')
		$(".nav_lead").removeClass('com_screen_top');
    })


    // 吸顶
    $(window).on("scroll", function() {
		var thisa = $(this);
		var st = thisa.scrollTop();
		if (st >= chtop) {
			$(".nav_lead").addClass('com_screen_top');
		} else {
			$(".nav_lead").removeClass('com_screen_top');
		}
	});

	var localData = utils.getStorage('waimai_local');
	if(localData){
		lat = localData.lat;
		lng = localData.lng;
		$('.location a').html(localData.address);

		getList();
	}else{

		// 百度地图
		if (site_map == 'baidu') {
			var geolocation = new BMap.Geolocation();
	    geolocation.getCurrentPosition(function(r){
	    	if(this.getStatus() == BMAP_STATUS_SUCCESS){
	    		lat = r.point.lat;
					lng = r.point.lng;

					var geoc = new BMap.Geocoder();
					geoc.getLocation(r.point, function(rs){
						var rs = rs.addressComponents;
						$('.location a').html(rs.district + rs.street + rs.streetNumber)
					});

					getList();
	    	}
	    	else {
	    		alert('failed'+this.getStatus());
	    	}
	    },{enableHighAccuracy: true})

			// 谷歌地图
			}else if (site_map == 'google') {

				if (navigator.geolocation) {

					//获取当前地理位置
					navigator.geolocation.getCurrentPosition(function(position) {
							var coords = position.coords;
							lat = coords.latitude;
							lng = coords.longitude;

							//指定一个google地图上的坐标点，同时指定该坐标点的横坐标和纵坐标
							var latlng = new google.maps.LatLng(lat, lng);
							var geocoder = new google.maps.Geocoder();
							geocoder.geocode( {'location': latlng}, function(results, status) {
									if (status == google.maps.GeocoderStatus.OK) {
											var time = Date.parse(new Date());
											var resultArr = results[0].address_components, address = "";

											for (var i = 0; i < resultArr.length; i++) {
												var type = resultArr[i].types[0] ? resultArr[i].types[0] : 0;
												if (type && type == "street_number") {
													address = resultArr[i].short_name;
												}
												if (type && type == "route") {
													address += " " + resultArr[i].short_name;
												}
											}

											utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': address}));
											$('.location a').html(address);
											getList();

									} else {
										alert('Geocode was not successful for the following reason: ' + status);
									}
							});

					}, function getError(error){
							switch(error.code){
								case error.TIMEOUT:
										 alert(langData['siteConfig'][22][100]);
										 break;
								case error.PERMISSION_DENIED:
										 alert(langData['siteConfig'][22][101]);
										 break;
								case error.POSITION_UNAVAILABLE:
										 alert(langData['siteConfig'][22][102]);
										 break;
								default:
										 break;
							}
				 })
			 }else {
				alert(langData['waimai'][3][72])
			 }
			}


	}


  var isload = false;

	//获取店铺列表
	function getList(){

        isload = true;

		if(page == 1){
			$('.le_list').html('<div class="loading">'+langData['siteConfig'][20][184]+'...</div>');
		}else{
			$('.le_list').append('<div class="loading">'+langData['siteConfig'][20][184]+'...</div>');
		}

        $.ajax({
            url: '/include/ajax.php?service=waimai&action=shopList',
            data: {
                typeid: typeid,
                orderby: orderby,
                yingye: yingye,
                lng: lng,
                lat: lat,
                page: page,
                pageSize: pageSize
            },
            type: 'get',
            dataType: 'json',
            success: function(data){

                if(data.state == 100){
                    var list = [];
                    $('.le_list .loading').remove();

										if(data.info.pageInfo.totalPage < page){
                        if(page == 1){
                          $('.le_list').html('<div class="loading">'+langData['siteConfig'][20][126]+'</div>');
                        }else {
                          $('.le_list').append('<div class="loading">'+langData['siteConfig'][20][185]+'</div>');
                        }
                        return false;
                    }

                    var info = data.info.list;
                    for(var i = 0; i < info.length; i++){
                        var d = info[i];

                        // 不是默认排序隐藏休息中的店铺
                        if(orderby != 1 && orderby != '' && d.yingye != 1){
                          continue;
                        }

                        list.push('<div class="le_xtt fn-clear"><a href="'+d.url+'">');

                        var xx = '';
                        if(d.yingye != 1){
                            xx = '<img class="xx" src="/static/images/xx.png" />';
                        }

                        list.push('<div class="le_pic"><img src="'+d.pic+'" alt="'+d.shopname+'" onerror="this.src=\'/static/images/shop.png\'">'+xx+'</div>');
                        list.push('<div class="le_text">');
                        list.push('<h1>'+d.shopname+'</h1>');
                        list.push('<div class="pingjia">');
												list.push('<div class="rating-wrapper"><div class="rating-gray"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="#star-gray.cc081b9"></use></svg></div>');
												list.push('<div class="rating-actived"style="width: '+(d.star/5)*100+'%;"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="#star-actived.d4c54d1"></use></svg></div></div><span class="rateNum">'+(d.star > 0 ? d.star : langData['waimai'][2][4])+'</span>');
                        list.push('<em>'+langData['waimai'][2][5].replace('1', d.sale)+'</em>');
                        if(d.delivery_service){
                            list.push('<b>'+d.delivery_service+'</b>');
                        }
                        list.push('</div>');
                        list.push('<div class="le_foot fn-clear">');
                        list.push('<div class="lf_left">');
                        list.push(echoCurrency('symbol')+d.basicprice+langData['waimai'][2][6]+'<em>|</em>'+langData['waimai'][2][7]+echoCurrency('symbol')+d.delivery_fee+'');
                        list.push('</div>');
                        list.push('<div class="fn-right grayfz"><span>'+d.juli+'</span>'+(d.delivery_time ? '<em>|</em><span>'+d.delivery_time+langData['waimai'][2][11]+'</span>' : '')+'</div>');
                        list.push('</div>');

                        list.push('<div class="favorable">');
        				list.push('<ul>');
                        if(d.is_first_discount == '1'){
                            list.push('<li class="shou"><em>'+langData['waimai'][2][92]+'</em>'+langData['waimai'][2][8].replace('1', d.first_discount)+'</li>');
                        }
                        if(d.is_discount == '1'){
                            list.push('<li class="zhe"><em>'+langData['waimai'][2][91]+'</em>'+langData['waimai'][2][8].replace('1', d.discount_value)+'</li>');
                        }
                        if(d.open_promotion == '1'){
            				list.push('<li class="jian"><em>'+langData['waimai'][2][93]+'</em>');
                            for(var o = 0; o < d.promotions.length; o++){
                                if(d.promotions[o][0] && d.promotions[o][1]){
                                    list.push(langData['waimai'][2][10].replace('1', d.promotions[o][0]).replace('2', d.promotions[o][1]));
                                }
                            }
                            list.push('</li>');
                        }

                        if(d.description){
                            list.push('<li class="tejia">'+d.description+'</li>');
                        }
			        				list.push('</ul>');
			        				list.push('</div>');

                        list.push('</div>');


                        list.push('</a></div>');
                    }

                    if(page == 1){
            			$('.le_list').html(list.join(''));
            		}else{
            			$('.le_list').append(list.join(''));
            		}

                    isload = false;
                    page++;

                }else{
                    $('.le_list .loading').html(data.info);
                }

            },
            error: function(){
                $('.le_list .loading').html(langData['siteConfig'][20][227]);
            }
        })

	}



    $(window).scroll(function() {
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - w - 100;
		if ($(window).scrollTop() > scroll && !isload) {
            getList();
		};
	});


})
