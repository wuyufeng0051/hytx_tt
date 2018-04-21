var history_local = 'wm_history_local';


//提交搜索
function check(){
	var keywords = $.trim($("#keywords").val());

	if (site_map == "baidu") {

		var myGeo = new BMap.Geocoder();
		myGeo.getPoint(keywords, function(point){
			if (point) {

				//记录搜索历史
				var history = utils.getStorage(history_local);
				history = history ? history : [];
				if(history && history.length >= 10 && $.inArray(keywords, history) < 0){
					history = history.slice(1);
				}

				// 判断是否已经搜过
				if($.inArray(keywords, history) > -1){
					for (var i = 0; i < history.length; i++) {
						if (history[i] === keywords) {
							history.splice(i, 1);
							break;
						}
					}
				}
				history.push(keywords);
				utils.setStorage(history_local, JSON.stringify(history));

				var time = Date.parse(new Date());
				utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': point.lng, 'lat': point.lat, 'address': keywords}));
				location.href = 'index.html?local=manual';
			}else{
				alert(langData['siteConfig'][20][431]);
			}
		}, langData['waimai'][2][106]);

	}else if (site_map == "google") {

		geocoder = new google.maps.Geocoder();
		geocoder.geocode({'address': keywords}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var locations = results[0].geometry.location;
				lng = locations.lng(), lat = locations.lat();
				if (lng && lat) {

					//记录搜索历史
					var history = utils.getStorage(history_local);
					history = history ? history : [];
					if(history && history.length >= 10 && $.inArray(keywords, history) < 0){
						history = history.slice(1);
					}

					// 判断是否已经搜过
					if($.inArray(keywords, history) > -1){
						for (var i = 0; i < history.length; i++) {
							if (history[i] === keywords) {
								history.splice(i, 1);
								break;
							}
						}
					}
					history.push(keywords);
					utils.setStorage(history_local, JSON.stringify(history));

					var time = Date.parse(new Date());
					utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': keywords}));
					location.href = 'index.html?local=manual';

				}else{
					alert(langData['siteConfig'][20][431]);
				}
			}
		});

	}else if (site_map == "qq") {

	}else if (site_map == "amap") {

		// var geocoder = new AMap.Geocoder;
		// geocoder.getLocation(keywords, function(status, result) {
    //     if (status === 'complete' && result.info === 'OK') {
		// 			var resultStr = "";
		// 			//地理编码结果数组
		// 			var geocode = data.geocodes;
		// 			for (var i = 0; i < geocode.length; i++) {
		// 				 //拼接输出html
		// 				 resultStr += geocode[i].location.getLng() + ", " + geocode[i].location.getLat();
		// 			}
		// 			alert(resultStr);
    //     }
    // });

	}


}


$(function(){

	//加载历史记录
	var hlist = [];
	var history = utils.getStorage(history_local);
	if(history){
		history.reverse();
		for(var i = 0; i < history.length; i++){
			hlist.push('<li><a href="javascript:;">'+history[i]+'</a></li>');
		}
		$('.history ul').html(hlist.join(''));
		$('.all_shan, .history').show();
	}

	//点击历史记录
	$('.history a').bind('click', function(){
		var t = $(this), txt = t.text();
		$('#keywords').val(txt);
		check();
	});

	//清空
	$('.all_shan').bind('click', function(){
		utils.removeStorage(history_local);
		$('.all_shan, .history').hide();
		$('.history ul').html('');
	});

	// 点击当前位置记录历史记录
	$(".relocal a").click(function(){
		var txt = $(this).text();
		$('#keywords').val(txt);
		check();
	})


	//定位当前位置
	$('.click').bind('click', function(){
    $(this).find("span").html(langData['siteConfig'][7][4]+"...");
		location();
	});

	location();

	function location(){
		$('.relocal a').text(langData['siteConfig'][7][4]+'..');

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
                    alert(langData['waimai'][2][104]);
                  	$(this).find("span").html(langData['waimai'][2][77]);
	    	            return;
	    	        }
	    	        var time = Date.parse(new Date());
	              utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': allPois[0].title}));
								$('.relocal a').text(allPois[0].title);
	              // location.href = 'index.html?local=manual';
	    	    }, {
	    	        poiRadius: 1000,  //半径一公里
	    	        numPois: 1
	    	    });

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

											$('.relocal a').text(address);
											utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': results[0].formatted_address}));

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
												var address = result.detail.addressComponents.streetNumber;
												utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': address}));
												$('.relocal a').html(address);
											}
									});
									var coord=new qq.maps.LatLng(lat,lng);
									geocoder.getAddress(coord);


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


							}else {
								alert('failed');
							}
					});
				});

			 function geocoder_CallBack(data) {
					 var time = Date.parse(new Date());
					 var address = data.regeocode.formattedAddress;
					 utils.setStorage('waimai_local', JSON.stringify({'time': time, 'lng': lng, 'lat': lat, 'address': address}));
					 $('.relocal a').html(address);
			 }
		}

	}

	if (site_map == "baidu") {
		var autocomplete = new BMap.Autocomplete({input: "keywords"});
		autocomplete.addEventListener("onconfirm", function(e) {
			console.log(e)
			var _value = e.item.value;
			myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
			$('#keywords').val(myValue);
			check();
		});
	}else if (site_map == "google") {

		var input = document.getElementById('keywords');
    var places = new google.maps.places.Autocomplete(input, {placeIdOnly: true});

		google.maps.event.addListener(places, 'place_changed', function () {
        var address = places.getPlace().name;
				$('#keywords').val(address);
				check();
    });

	}else if (site_map == "qq") {

	}else if (site_map == "amap") {
		// AMap.plugin('AMap.Autocomplete',function(){//回调函数
		//     var autoOptions = {
		//         city: "", //城市，默认全国
		//         input: "keywords"//使用联想输入的input的id
		//     };
		//     var autocomplete= new AMap.Autocomplete(autoOptions);
		//
		//     AMap.event.addListener(autocomplete, "select", function(data){
		// 			check();
		//     });
		// });
	}

});
