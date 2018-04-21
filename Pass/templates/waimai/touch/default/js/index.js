$(function(){

  // banna轮播图
	var mySwiper1 = new Swiper('.swiper-container1', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true, autoplay: 5000});
  new Swiper('.swiper-container3', {pagination: '.pagination', slideClass: 'slideshow-item', paginationClickable: true, loop: true, autoplay: 5000});

  // 滑动导航
  if ($('.nav li').length > 8) {
    var mySwiper2 = new Swiper('.nav',{pagination : '.swiper-pagination',});
  }


  var hallList = $(".near-box"), atpage = 1, pageSize = 20, listArr = [], totalPage = 0, isload = false;
  function getList(){

    typeid = $("#choose-classify .active").data("id");
    orderby = $("#choose-sort .active").data("id");
    yingye = $("#choose-screen .active").data("id");

    isload = true;

		if(page == 1){
			$('.near-box').html('<div class="loading">'+langData['siteConfig'][20][184]+'...</div>');
		}else{
			$('.near-box').append('<div class="loading">'+langData['siteConfig'][20][184]+'...</div>');
		}

        $.ajax({
            url: '/include/ajax.php?service=waimai&action=shopList',
            data: {
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
                    $('.near-box .loading').remove();

                    if(data.info.pageInfo.totalPage < page){
                        if(page == 1){
                          $('.near-box').html('<div class="loading">'+langData['siteConfig'][20][126]+'</div>');
                        }else {
                          $('.near-box').append('<div class="loading">'+langData['siteConfig'][20][185]+'</div>');
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

                        list.push('<div class="near-list"><a href="'+d.url+'">');

                        var xx = '';


												list.push('<div class="near-list-img"><img src="'+d.pic+'" alt="'+d.shopname+'" onerror="this.src=\'/static/images/shop.png\'"></div>');
												list.push('<div class="near-list-txt"><p class="fn-clear nh"><span class="fn-left">'+d.shopname+'</span></p>');
												list.push('<div class="judge-box fn-clear">');
												if(d.yingye != 1 || d.ordervalid != 1){
                          if(d.ordervalid != 1){
                            list.push('<span class="xiuxi l">'+langData['waimai'][2][101]+'</span>');
                          }else if(d.yingye != 1){
                            list.push('<span class="xiuxi l">'+langData['waimai'][2][102]+'</span>');
                          }
                        }else {
													list.push('<div class="rating-wrapper"><div class="rating-gray"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="#star-gray.cc081b9"></use></svg></div>');
													list.push('<div class="rating-actived"style="width: '+(d.star/5)*100+'%;"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="#star-actived.d4c54d1"></use></svg></div></div><span class="rateNum">'+(d.star > 0 ? d.star : langData['waimai'][2][4])+'</span>');

													list.push('<span class="sale-num">'+langData['waimai'][2][5].replace('1', d.sale)+'</span>');
                          if(d.delivery_service){
                            list.push('<b class="fn-right sale-song">'+d.delivery_service+'</b>');
                          }
                        }
												list.push('</div>');

                        list.push('<div class="starting-price"><span>'+echoCurrency('symbol')+d.basicprice+langData['waimai'][2][6]+'</span><em>|</em><span>'+langData['waimai'][2][7]+echoCurrency('symbol')+d.delivery_fee+'</span><div class="fn-right grayfz"><span>'+d.juli+'</span>'+(d.delivery_time ? '<em>|</em><span>'+d.delivery_time+langData['waimai'][2][11]+'</span>' : '')+'</div></div>');

												list.push('<div class="saleBox">');
                        if(d.is_first_discount == '1'){
                            list.push('<p class="gray"><i class="shou">'+langData['waimai'][2][92]+'</i><span>'+langData['waimai'][2][8].replace('1', d.first_discount)+'</span></p>');
                        }
                        if(d.is_discount == '1'){
                          list.push('<p class="gray"><i class="zhe">'+langData['waimai'][2][91]+'</i>'+langData['waimai'][2][8].replace('1', d.discount_value)+'</p>');
                        }
                        if(d.open_promotion == '1'){
                          list.push('<p class="gray"><i class="sale">'+langData['waimai'][2][93]+'</i><span>');
                          for(var o = 0; o < d.promotions.length; o++){
                              if(d.promotions[o][0] && d.promotions[o][1]){
                                  list.push(langData['waimai'][2][10].replace('1', d.promotions[o][0]).replace('2', d.promotions[o][1]));
                              }
                          }
                          list.push('</span></p>');
                        }
												list.push('</div>');

                        if(d.description){
                          list.push('<p class="gray desc">'+d.description+'</p>');
                        }

                        list.push('</div>');
                        list.push('</a></div>');
                    }

                    if(page == 1){
                			$('.near-box').html(list.join(''));
                		}else{
                			$('.near-box').append(list.join(''));
                		}

                    isload = false;
                    page++;

                }else{
                    $('.near-box .loading').html(data.info);
                }

            },
            error: function(){
                $('.near-box .loading').html(langData['siteConfig'][20][227]);
            }
        })

	}

  //滚动加载
  $(window).on("scroll", function(){
    var scrollTop = $(window).scrollTop(),
        allh = $('body').height(),
        w = $(window).height(),
        scroll = allh - w - 300;
    if (scrollTop > scroll && !isload) {
      if(lat == 0){
        $('.near-box').html('<div class="loading">'+langData['waimai'][2][103]+'</div>');
      }else{
        atpage++;
        getList();
      }
    };
  });

  // 定位
  var localData = utils.getStorage('waimai_local');
  var getLastLocal = false;
  if(localData){
    var last = localData.time;
	var time = Date.parse(new Date());
    lat = localData.lat;
    lng = localData.lng;

    // 手动定位或10分钟内使用上次坐标
    if(local == 'manual' || (time - last < 60*10*1000)){
      getLastLocal = true;
      $('.header-m em').html(localData.address);
      getList();

      utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': localData.address}));
    }
  }

  if(!getLastLocal){

		// 百度地图
		if (site_map == 'baidu') {
		    var geolocation = new BMap.Geolocation();
	      geolocation.getCurrentPosition(function(r){
	        if(this.getStatus() == BMAP_STATUS_SUCCESS){
	            lat = r.point.lat;
	            lng = r.point.lng;

	            var myGeo = new BMap.Geocoder();
	            myGeo.getLocation(r.point, function mCallback(rs){
	    	        var allPois = rs.surroundingPois;
	    	        if(allPois == null || allPois == ""){
	                    $('.header-m em').html(langData['waimai'][2][104]);
	    	            return;
	    	        }

	              var time = Date.parse(new Date());
	              utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': allPois[0].title}));
	              $('.header-m em').html(allPois[0].title);
	    	    }, {
	    	        poiRadius: 1000,  //半径一公里
	    	        numPois: 1
	    	    });

	            getList();

	        }else {
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
				              $('.header-m em').html(address);
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

			// 腾讯地图
			}else if (site_map == 'qq') {
				if (navigator.geolocation) {
					var geolocation = new qq.maps.Geolocation("Q77BZ-KQ5RD-B6O46-PINPW-32UVQ-VHBMF", "hn");
					window.addEventListener('message', function(event) {
					    // 接收位置信息
					    var loc = event.data;

							if(loc && loc.module == 'geolocation'){
			            lat = loc.lat;
			            lng = loc.lng;

									geocoder = new qq.maps.Geocoder({
									    complete:function(result){
												var time = Date.parse(new Date());
												address = result.detail.addressComponents.streetNumber;
												utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': address}));
												$('.header-m em').html(address);
									    }
									});
									var coord=new qq.maps.LatLng(lat,lng);
									geocoder.getAddress(coord);

			            getList();

			        }else {
			          // alert('failed');
			        }

					}, false);

				}

			// 高德地图
			}else if (site_map == 'amap') {
				mapObj = new AMap.Map('map');
				mapObj.plugin('AMap.Geolocation', function () {
				    var geolocation = new AMap.Geolocation({
				        enableHighAccuracy: true,//是否使用高精度定位，默认:true
				        timeout: 10000,          //超过10秒后停止定位，默认：无穷大
				        maximumAge: 0,           //定位结果缓存0毫秒，默认：0
				        convert: true           //自动偏移坐标，偏移后的坐标为高德坐标，默认：true
				    });

				    geolocation.getCurrentPosition(function(status,result){
							if(result.info == "SUCCESS"){
			            lat = result.position.lat;
			            lng = result.position.lng;
									lnglatXY = [lng, lat];

									var geocoder = new AMap.Geocoder({
			 							 radius: 1000,
			 							 extensions: "all"
			 					 });
			 					 geocoder.getAddress(lnglatXY, function(status, result) {
			 							 if (status === 'complete' && result.info === 'OK') {
			 									 geocoder_CallBack(result);
			 							 }
			 					 });

		            	getList();

			        }else {
			          alert('failed');
			        }
					});
				});

			 function geocoder_CallBack(data) {
					 var time = Date.parse(new Date());
					 address = data.regeocode.formattedAddress;
					 utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': address}));
					 $('.header-m em').html(address);
			 }
			}
  }


  var mywaimaiSwiper = null;

  function checkWaimaiOrder(){
    $.ajax({
      url: '/include/ajax.php?service=waimai&action=checkMyorder',
      type: 'get',
      dataType: 'json',
      success: function(data){

        if(data && data.state == 100){
          var list = data.info;
          var order = null;
          if(list.length > 0){
            var html = [];
            for(var i = 0; i < list.length; i++){
              var obj = list[i],
                  state = parseInt(obj.state);

              if(obj.iscommon){
                continue;
              }

              var str = '';
              if(state == 0){
                str = '<li class="swiper-slide"><a href="'+userdomain+'/orderdetail-waimai-'+obj.id+'.html">'+langData['waimai'][3][76]+'</a></li>';
              }else{
                var txt = '';
                switch(state){
                  case 2:
                    txt = langData['waimai'][3][77];
                    break;
                  case 3:
                    txt = langData['waimai'][3][78];
                    break;
                  case 4:
                    txt = langData['waimai'][3][79];
                    break;
                  case 5:
                    txt = langData['waimai'][3][80];
                    break;
                  case 7:
                    txt = langData['waimai'][3][81];
                    break;
                  case 1:
                    txt = langData['waimai'][3][82];
                    break;
                }
                str = '<li class="swiper-slide"><a href="'+userdomain+'/orderdetail-waimai-'+obj.id+'.html">'+txt+'</a></li>';
              }

              html.push(str);
            }

            $('.swiper-msg ul').html(html.join(""));
            if(mywaimaiSwiper){
              // 销毁
              mywaimaiSwiper.destroy();
            }
            if(list.length > 1){
              mywaimaiSwiper = new Swiper('.swiper-msg', {direction: 'vertical', autoplay:3000, loop : true, speed: 700, height: 60});
            }
            $(".waimaiOrderstate").show();

          }else{
            $(".waimaiOrderstate").hide();
          }

        }else{
          $(".waimaiOrderstate").hide();
        }

        setTimeout(function(){
          checkWaimaiOrder();
        },13700)
      },
      error: function(){
        $(".waimaiOrderstate").hide();
        setTimeout(function(){
          checkWaimaiOrder();
        },13700)
      }
    })
  }

  var userid = $.cookie(cookiePre+"login_user");
  if(userid != undefined && userid != null && userid != ''){
    checkWaimaiOrder();
  }


})
