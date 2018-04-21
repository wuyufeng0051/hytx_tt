$(function(){
    var gzAddress         = $(".gz-address"),  //选择地址页
        gzAddrList        = $("#gzAddrList"),    //选择收货地址页
        gzAddrHeaderBtn   = $(".gz-addr-header-btn"),  //删除按钮
        gzAddrListObj     = $(".gz-addr-list"),  //地址列表
        gzAddNewAddrBtn   = $("#gzAddNewAddrBtn"),  //新增地址按钮
        gzAddNewObj       = $("#gzAddNewObj"),   //新增地址页
        gzSelAddr         = $("#gzSelAddr"),     //选择地区页
        gzAddrSeladdr     = $(".gz-addr-seladdr"),  //选择所在地区按钮
        gzSafeNewAddrBtn  = $("#gzSafeNewAddrBtn"),  //保存新增地址
        gzBackClass       = ".gz-addr-header-back",  //后退按钮样式名
        gzAddrMap         = $("#map"),  //后退按钮样式名
        showErrTimer      = null,
        gzAddrEditId      = 0,   //修改地址ID
        gzAddrInit = {

            //错误提示
            showErr: function(txt){
                showErrTimer && clearTimeout(showErrTimer);
		        		$(".gzAddrErr").remove();
		        		$("body").append('<div class="gzAddrErr"><p>'+txt+'</p></div>');
		        		$(".gzAddrErr p").css({"margin-left": -$(".gzAddrErr p").width()/2, "left": "50%"});
		        		$(".gzAddrErr").css({"visibility": "visible"});
		        		showErrTimer = setTimeout(function(){
		        			$(".gzAddrErr").fadeOut(300, function(){
		        				$(this).remove();
		        			});
		        		}, 1500);
            }

            //显示选择地址页
            ,showChooseAddr: function(){
                $("html").addClass("fixed");
                gzAddress.show();
                if(gzAddrList.find("article").length == 0){
                    gzAddrInit.getAddrList();
                }
            }

            //获取地址列表
            ,getAddrList: function(){

                gzAddrListObj.html('<div class="empty">'+langData['siteConfig'][20][184]+'...</empty>');

                $.ajax({
                    url: masterDomain + '/include/ajax.php?service=waimai&action=getMemberAddress',
                    dataType: "jsonp",
                    success: function (data) {
                        if(data){

                            var list = data.info, addrList = [];
                            if(data.state == 100 && list.length > 0){

                                for (var i = 0, addr, contact; i < list.length; i++) {
                                    addr = list[i];
                                    addrList.push('<article class="fn-clear" data-id="'+addr.id+'" data-people="'+addr.person+'" data-contact="'+addr.tel+'" data-lng="'+addr.lng+'" data-lat="'+addr.lat+'" data-street="'+addr.street+'" data-address="'+addr.address+'">');
                                    addrList.push('<div class="gz-linfo">');
                                    addrList.push('<s></s>');
                                    addrList.push('<h5>'+addr.person+'<sup>'+addr.tel+'</sup></h5>');
                                    addrList.push('<p>'+addr.street+' '+addr.address+'</p>');
                                    addrList.push('</div>');
                                    addrList.push('<div class="gz-rbtn gz-rbtn-edit"></div>');
                                    addrList.push('</article>');
                                }
                                gzAddrListObj.html(addrList.join(""));
                                gzAddrHeaderBtn.fadeIn(300);

                            }else{
                                if(list && list.length == 0){
                                    gzAddrListObj.html('<div class="empty">'+langData['siteConfig'][20][226]+'</empty>');
                                }else{
                                    gzAddrListObj.html('<div class="empty">'+data.info+'</empty>');
                                }
                            }

                        }else{
                            gzAddrListObj.html('<div class="empty">'+langData['siteConfig'][20][228]+'</empty>');
                        }
                    },
                    error: function(){
                        gzAddrListObj.html('<div class="empty">'+langData['siteConfig'][20][227]+'</empty>');
                    }
                });

            }

            //删除地址
            ,delAddr: function(id, obj){
                $.ajax({
                    url: masterDomain + "/include/ajax.php?service=waimai&action=deleteAddress",
                    data: {
      	                id: id
      	            },
                    type: "GET",
                    dataType: "jsonp",
                    success: function (data) {
                        if(data && data.state == 100){
                            obj.hide(300, function(){
                                obj.remove();
                                if(gzAddrListObj.find("article").length == 0){
                                    gzAddrListObj.html('<div class="empty">'+langData['siteConfig'][20][226]+'</empty>');
                                }
                            });
                        }else{
                            alert(data.info);
                        }
                    },
                    error: function(){
                        alert(langData['siteConfig'][20][183]);
                    }
                });
            }

        }

    if (site_map == "baidu") {

  		//关键字搜索
  		var myGeo = new BMap.Geocoder();
  		var autocomplete = new BMap.Autocomplete({input: "searchAddr"});
  		autocomplete.addEventListener("onconfirm", function(e) {
  			var _value = e.item.value;
  			myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;

  			var options = {
  				onSearchComplete: function(results){
  					// 判断状态是否正确
  					if (local.getStatus() == BMAP_STATUS_SUCCESS){
  						var s = [];
  						for (var i = 0; i < results.getCurrentNumPois(); i ++){
  							if(i == 0){
  								lng = results.getPoi(i).point.lng;
  								lat = results.getPoi(i).point.lat;
  								gzAddrSeladdr.find("dd").text(_value.business);
                  gzAddrMap.hide();
                  gzAddress.show();
  							}
  						}
  					}else{
  						alert(langData['siteConfig'][20][431]);
  					}
  				}
  			};
  			var local = new BMap.LocalSearch(map, options);
  			local.search(myValue);

  		});

    // 谷歌地图
    }else if (site_map == "google") {

      var input = document.getElementById('searchAddr');
      var places = new google.maps.places.Autocomplete(input, {placeIdOnly: true});

  		google.maps.event.addListener(places, 'place_changed', function () {
          var address = places.getPlace().name;
  				$('#searchAddr').val(address);

          geocoder = new google.maps.Geocoder();
      		geocoder.geocode({'address': address}, function(results, status) {
      			if (status == google.maps.GeocoderStatus.OK) {
      				var locations = results[0].geometry.location;
      				lng = locations.lng(), lat = locations.lat();
      				if (lng && lat) {
                gzAddrSeladdr.attr('data-lng', lng).attr('data-lat', lat);
                gzAddrSeladdr.find("dd").text(results[0].formatted_address);
                gzAddrMap.hide();
                gzAddress.show();

      				}else{
      					alert(langData['siteConfig'][20][431]);
      				}
      			}
      		});

      });

    }


		//点击检索结果
		$(".mapresults").delegate("li", "click", function(){
			var t = $(this), title = t.find("h5").text();
			lng = t.attr("data-lng");
			lat = t.attr("data-lat");
      gzAddrSeladdr.attr('data-lng', lng).attr('data-lat', lat);
			gzAddrSeladdr.find("dd").text(title);
      gzAddrMap.hide();
      gzAddress.show();
		});


    //选择收货地址
    gzAddrInit.showChooseAddr();

    //选择收货地址页后退
    // gzAddrList.find(gzBackClass).bind("click", function(){
    //     history.go(-1);
    //     $("html").removeClass("fixed");
    // });

    //选择地址
    gzAddrListObj.delegate("article .gz-linfo", "click", function(){
        var t = $(this), par = t.parent(), id = par.attr("data-id"), people = par.attr("data-people"), contact = par.attr("data-contact"), lng = par.attr("data-lng"), lat = par.attr("data-lat"), street = par.attr("data-street"), address = par.attr("data-address");

        var data = {
            "id": id,
            "people": people,
            "contact": contact,
            "lng": lng,
            "lat": lat,
            "street": street,
            "address": address
        }
        //业务层需要配合
        // chooseAddressOk(data);

        location.href = redirectUrl.replace("#id", id);
    });

    //编辑
    gzAddrListObj.delegate(".gz-rbtn-edit", "click", function(){
        var t = $(this), par = t.closest("article"), id = par.attr("data-id"), people = par.attr("data-people"), contact = par.attr("data-contact"), lng = par.attr("data-lng"), lat = par.attr("data-lat"), street = par.attr("data-street"), address = par.attr("data-address");
        if(id){
            gzAddrEditId = id;
            $("#people").val(people);
            $("#mobile").val(contact);
            gzAddrSeladdr.removeClass("gz-no-sel").attr("data-lng", lng).attr("data-lat", lat).find("dd").html(street);
            $("#address").val(address);

            gzAddrList.addClass("fn-hide");
            gzAddNewObj.removeClass("fn-hide");
        }
    });

    //删除按钮
    gzAddrHeaderBtn.bind("touchend", function(){
        var t = $(this);

        if(t.hasClass("isWrite")){
            gzAddrListObj.find(".gz-rbtn").removeClass("gz-rbtn-del").addClass("gz-rbtn-edit");
            t.removeClass("isWrite").html(langData['siteConfig'][6][8]);
        }else{
            gzAddrListObj.find(".gz-rbtn").removeClass("gz-rbtn-edit").addClass("gz-rbtn-del");
            t.addClass("isWrite").html(langData['siteConfig'][6][12]);
        }
    });

    //删除
    gzAddrListObj.delegate(".gz-rbtn-del", "click", function(){
        var t = $(this), par = t.closest("article"), id = par.attr("data-id");
        if(id && confirm(langData['siteConfig'][20][211])){
            gzAddrInit.delAddr(id, par);
        }
    });

    // 选择所在区域
    gzAddrSeladdr.bind("click", function(){
      gzAddrMap.show();
      gzAddress.hide();

      var t = $(this);
      lng = t.attr("data-lng") == null ? lng : t.attr("data-lng");
      lat = t.attr("data-lat") == null ? lat : t.attr("data-lat");

      //定位地图
      // 百度地图
      if (site_map == "baidu") {

  			map = new BMap.Map("mapdiv");
  			var mPoint = new BMap.Point(lng, lat);
  			map.centerAndZoom(mPoint, 16);
  			getLocation(mPoint);

  			map.addEventListener("dragend", function(e){
  			    getLocation(e.point);
  			});

  			//周边检索
  			function getLocation(point){
  			    myGeo.getLocation(point, function mCallback(rs){
  			        var allPois = rs.surroundingPois;
  			        if(allPois == null || allPois == ""){
  			            return;
  			        }
  					var list = [];
  					for(var i = 0; i < allPois.length; i++){
  						list.push('<li data-lng="'+allPois[i].point.lng+'" data-lat="'+allPois[i].point.lat+'"><h5>'+allPois[i].title+'</h5><p>'+allPois[i].address+'</p></li>');
  					}

  					if(list.length > 0){
  						$(".mapresults ul").html(list.join(""));
  						$(".mapresults").show();
  					}

  			    }, {
  			        poiRadius: 1000,  //半径一公里
  			        numPois: 50
  			    });
  			}

      // 谷歌地图
      }else if (site_map == "google") {

        var map, geocoder, marker,
      		mapOptions = {
      			zoom: 14,
      			center: new google.maps.LatLng(lat, lng),
      			zoomControl: true,
      			mapTypeControl: false,
      			streetViewControl: false,
      			zoomControlOptions: {
      				style: google.maps.ZoomControlStyle.SMALL
      			}
      		}

        $('.mapcenter').remove();
        map = new google.maps.Map(document.getElementById('mapdiv'), mapOptions);

        marker = new google.maps.Marker({
  				position: mapOptions.center,
  				map: map,
  				draggable:true,
  				animation: google.maps.Animation.DROP
  			});

        getLocation(mapOptions.center);

        google.maps.event.addListener(marker, 'dragend', function(event) {
          var location = event.latLng;
    			$("#lng").val(location.lng());
    			$("#lat").val(location.lat());

    			var pos = {
    				lat: location.lat(),
    				lng: location.lng()
    			};
          getLocation(pos);
        })

        function getLocation(pos){
          var service = new google.maps.places.PlacesService(map);
          service.nearbySearch({
            location: pos,
            radius: 500
          }, callback);

          var list = [];
          function callback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
              for (var i = 0; i < results.length; i++) {
                list.push('<li data-lng="'+results[i].geometry.location.lng()+'" data-lat="'+results[i].geometry.location.lat()+'"><h5>'+results[i].name+'</h5><p>'+results[i].vicinity+'</p></li>');
              }

              if(list.length > 0){
                $(".mapresults ul").html(list.join(""));
                $(".mapresults").show();
              }
            }
          }
        }



      }

    })

    // 选择地址返回
    $('.lead p').bind("click", function(){
      gzAddress.show();
      gzAddrMap.hide();
    })

    //新增地址
    gzAddNewAddrBtn.bind("click", function(){

        //重置表单
        $("#people").val("");
        $("#mobile").val("");
        gzAddrSeladdr.removeClass("gz-no-sel").addClass("gz-no-sel").removeAttr("data-lng").removeAttr("data-lat").find("dd").text(langData['waimai'][2][67]);
        $("#address").val("");

        gzAddrList.addClass("fn-hide");
        gzAddNewObj.removeClass("fn-hide");

        // 百度地图
        if (site_map == "baidu") {
  				var geolocation = new BMap.Geolocation();
  		    geolocation.getCurrentPosition(function(r){
  		    	if(this.getStatus() == BMAP_STATUS_SUCCESS){
  		    		lat = r.point.lat;
  					  lng = r.point.lng;

  					var geoc = new BMap.Geocoder();
  					geoc.getLocation(r.point, function(rs){
  						var rs = rs.addressComponents;
  						gzAddrSeladdr.find('dd').text(rs.street + rs.streetNumber);
  					});
  		    	}
  		    	else {
  		    		alert('failed'+this.getStatus());
  		    	}
  		    },{enableHighAccuracy: true});

        // 谷歌地图
      }else if (site_map == "google") {

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
                      gzAddrSeladdr.attr('data-lng', lng).attr('data-lat', lat);
                      gzAddrSeladdr.find("dd").text(results[0].formatted_address);
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

    });

    //新增地址返回
    gzAddNewObj.find(gzBackClass).bind("click", function(){
        gzAddNewObj.addClass("fn-hide");
        gzAddrList.removeClass("fn-hide");
    });

    //保存新增地址
    gzSafeNewAddrBtn.bind("click", function(){

        var t = $(this),
            people = $.trim($("#people").val()),
            tel = $.trim($("#mobile").val()),
            street = gzAddrSeladdr.find('dd').text(),
            address = $.trim($("#address").val());

        if(people == ""){
            gzAddrInit.showErr(langData['siteConfig'][20][268]);
            return false;
        }

        if(tel == ""){
            gzAddrInit.showErr(langData['siteConfig'][20][27]);
            return false;
        }

        if(street == "" || lng == "" || lat == ""){
      			gzAddrInit.showErr(langData['waimai'][3][73]);
      			return false;
    		}

        if(address == ""){
            gzAddrInit.showErr(langData['siteConfig'][20][252]);
            return false;
        }

        var data = [];
        data.push('id='+gzAddrEditId);
        data.push('lng='+lng);
        data.push('lat='+lat);
        data.push('street='+street);
        data.push('address='+address);
        data.push('person='+people);
        data.push('tel='+tel);
        t.attr("disabled", true).html(langData['siteConfig'][6][35]+"...");

        var addrName = [];
        $("#addrid").parent().find("select").each(function(){
            addrName.push($(this).find("option:selected").text());
        });

        $.ajax({
            url: masterDomain+"/include/ajax.php?service=waimai&action=operAddress",
            data: data.join("&"),
            dataType: "jsonp",
            success: function (data) {
                if(data && data.state == 100){
                    gzAddNewObj.find(gzBackClass).click();
                    gzAddrInit.getAddrList();
                }else{
                    gzAddrInit.showErr(data.info);
                }
                t.removeAttr("disabled").html(langData['siteConfig'][6][27]);
            },
            error: function(){
                t.removeAttr("disabled").html(langData['siteConfig'][6][27]);
                gzAddrInit.showErr(langData['siteConfig'][20][253]);
            }
        });

    });

});



// 扩展zepto
$.fn.prevAll = function(selector){
    var prevEls = [];
    var el = this[0];
    if(!el) return $([]);
    while (el.previousElementSibling) {
        var prev = el.previousElementSibling;
        if (selector) {
            if($(prev).is(selector)) prevEls.push(prev);
        }
        else prevEls.push(prev);
        el = prev;
    }
    return $(prevEls);
};

$.fn.nextAll = function (selector) {
    var nextEls = [];
    var el = this[0];
    if (!el) return $([]);
    while (el.nextElementSibling) {
        var next = el.nextElementSibling;
        if (selector) {
            if($(next).is(selector)) nextEls.push(next);
        }
        else nextEls.push(next);
        el = next;
    }
    return $(nextEls);
};
