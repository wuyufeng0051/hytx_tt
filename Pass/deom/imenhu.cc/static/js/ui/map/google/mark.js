$(function(){
	
	/*
	 * 验证逻辑
	 * 1.首先验证坐标值，如果坐标值都不为0，则就以些坐标在地图上标注;
	 * 2.如果详细地址不为空，则解析此地址，如果解析成功，则以此地址作为中心点;
	 * 3.如果详细地址解析不成功，则解析城市名，如果解析成功，以城市名为中心点;
	 */
	 
	//初始化变量
	var city = $("#city").val(),
		addr = $("#addr").val(),
		map_default_lng  = $("#lng").val(),
		map_default_lat  = $("#lat").val();
	
	var map, geocoder, marker, 
		mapOptions = {
			zoom: 14,
			center: new google.maps.LatLng(map_default_lat, map_default_lng),
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL//LARGE
			}
		},
		image = '/static/images/mark_ditu.png';

	//加载地图事件
	function initialize() {

		//如果经、纬度都为0则设置城市名为中心点
		if(map_default_lng == 0 && map_default_lat == 0){

			//根据地址解析
			if(city != ""){
				var address = city;
				if(addr != "") address = address + addr;
				geocoder = new google.maps.Geocoder();
				geocoder.geocode({'address': address}, function(results, status) {
					//如果解析成功，则重置经、纬度
					if(status == google.maps.GeocoderStatus.OK) {
						var location = results[0].geometry.location;
						mapOptions.center = new google.maps.LatLng(location.k, location.D);

						$("#lng").val(location.D);
						$("#lat").val(location.k);
					}
					setMark();
				});

			//如果城市为空，则定位当前城市
			}else{
				$("#map").html('请先设置默认城市！');
			}

		}else{
			setMark();
		}

	}
	
	//设置标注
	function setMark(){
		map = new google.maps.Map(document.getElementById('map'), mapOptions);

		//增加标注
		marker = new google.maps.Marker({
			position: mapOptions.center,
			map: map,
			icon: image,
			draggable:true,
			animation: google.maps.Animation.DROP
		});
		
		//点击
		google.maps.event.addListener(map, 'click', function(event) {
			marker.setMap(); //清除标注
			var location = event.latLng;
			mapOptions.center = new google.maps.LatLng(location.k, location.D);
			
			//添加新的标注
			marker = new google.maps.Marker({
				position: mapOptions.center,
				map: map,
				icon: image,
				draggable:true,
				animation: google.maps.Animation.DROP
			});
			
			$("#lng").val(location.D);
			$("#lat").val(location.k);
			
			listener();
		});
		
		listener();
	}
	
	//监听拖动
	function listener(){
		google.maps.event.addListener(marker, 'dragend', function(event) {		
			var location = event.latLng;	
			$("#lng").val(location.D);
			$("#lat").val(location.k);
		});
	}
	
	//搜索回车提交
    $("#keyword").keyup(function (e) {
        if (!e) {
            var e = window.event;
        }
        if (e.keyCode) {
            code = e.keyCode;
        }
        else if (e.which) {
            code = e.which;
        }
        if (code === 13) {
            $("#search").click();
        }
    });
	
	//关键字搜索
	$("#search").bind("click", function(){
		var address = document.getElementById('keyword').value;
		if(address != ""){
			geocoder = new google.maps.Geocoder();
			geocoder.geocode({'address': city+address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var location = results[0].geometry.location;
					mapOptions.center = new google.maps.LatLng(location.k, location.D);
					setMark();
					
					$("#lng").val(location.D);
					$("#lat").val(location.k);
				}
			});
		}else{
			document.getElementById('address').focus();
		}
	});
	
	google.maps.event.addDomListener(window, 'load', initialize);
});