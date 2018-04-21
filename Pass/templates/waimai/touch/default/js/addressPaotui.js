$(function(){

	var map, edit;

	$("html,body").scrollTop(0);
	location.hash = "main";
	$("#main").show();

	//选择地址
	$(".Address_list .add_txt").bind("click", function(){
		var t = $(this), id = t.data("id");
		if(!edit){
			location.href = redirectUrl.replace("#id", id);
		}
	});

	//新增地址
	$("#addNew").bind("click", function(){
		id = 0;
		lng = "";
		lat = "";
		$("#person").val("");
		$("#tel").val("");
		$("#local strong").html(langData['siteConfig'][7][4]+"...");
		$("#address").val("");
		location.hash = "add";
		$("#add .lead span").html(langData['siteConfig'][6][132]);
	});

	//手动定位
	$("#local").bind("click", function(){
		location.hash = "map";
	});

	//显示编辑按钮
	$('.lead b a').click(function(){
		if ($('.edit').css('display') == 'none') {
			edit = true;
			$('.edit').show();
			$('.dui').hide();
		}else{
			edit = false;
			$('.edit').hide();
			$('.dui').show();
		};
	});

	//修改地址
	$('.Address_list .add_txt .edit a').click(function(){
		var x = $(this).closest(".add_txt");
		id = x.data("id");
		lng = x.data("lng");
		lat = x.data("lat");

		$("#person").val(x.data("person"));
		$("#tel").val(x.data("tel"));
		$("#local strong").html(x.data("street"));
		$("#address").val(x.data("address"));

		location.hash = "add";
		$("#add .lead span").html(langData['waimai'][2][94]);
	});

	//删除
	$('.Address_list .add_txt .edit b').click(function(){
		var x = $(this), par = x.closest(".add_txt"), id = par.data("id");

		if(confirm(langData['siteConfig'][20][211])){
			par.remove();
			$.ajax({
	            url: '/include/ajax.php?service=waimai&action=deleteAddress',
	            data: {
	                id: id
	            },
	            type: 'post',
	            dataType: 'json',
	            success: function(data){}
			});
		}
	});

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
								$("#local strong").html(_value.business);
								location.hash = "add";
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

							$("#local strong").text(results[0].formatted_address);
							location.hash = "add";

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
		$("#local strong").html(title);
		location.hash = "add";
	});


	//监听hash
	$(window).on('hashchange', function(){
    var hash = location.hash;
		$(".pageitem").hide();
		$(hash).show();
		if(hash == "#main"){
			document.title = langData['waimai'][2][66];
		}else if(hash == "#add"){
			document.title = langData['siteConfig'][6][132];

			//第一次进入自动获取当前位置
			if(lng == "" || lat == ""){

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
								$("#local strong").html(rs.street + rs.streetNumber);
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
													$("#local strong").text(results[0].formatted_address);
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


		}else if(hash == "#map"){
			document.title = langData['waimai'][2][66];

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


		}
    });


	//保存地址
	$("#saveAddress").bind("click", function(){
		var t = $(this), person = $("#person").val(), tel = $("#tel").val(), street = $("#local strong").text(), address = $("#address").val();

		if(person == ""){
			alert(langData['siteConfig'][20][345]);
			return false;
		}

		if(tel == ""){
			alert(langData['siteConfig'][20][27]);
			return false;
		}

		if(street == "" || lng == "" || lat == ""){
			alert(langData['waimai'][3][73]);
			return false;
		}

		if(address == ""){
			alert(langData['siteConfig'][20][252]);
			return false;
		}

		t.attr("disabled", true).html(langData['siteConfig'][7][9]+'...');

		$.ajax({
            url: '/include/ajax.php?service=waimai&action=operAddress',
            data: {
                id: id,
                person: person,
                tel: tel,
                street: street,
                address: address,
                lng: lng,
                lat: lat
            },
            type: 'post',
            dataType: 'json',
            success: function(data){
				if(data && data.state == 100){
					location.reload();
				}else{
					alert(data.info);
					t.removeAttr("disabled").html(langData['siteConfig'][6][27]);
				}
			},
			error: function(){
				alert(langData['siteConfig'][20][253]);
				t.removeAttr("disabled").html(langData['siteConfig'][6][27]);
			}
		});



	});

})
