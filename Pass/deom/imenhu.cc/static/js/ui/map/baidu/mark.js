$(function(){
	
	/*
	 * 验证逻辑
	 * 1.首先验证坐标值，如果坐标值都不为0，则就以些坐标在地图上标注;
	 * 2.如果详细地址不为空，则解析此地址，如果解析成功，则以此地址作为中心点;
	 * 3.如果详细地址解析不成功，则解析城市名，如果解析成功，以城市名为中心点;
	 * 4.如果都不成功，则IP定位当前城市；
	 */
	
	var city = $("#city").val();
	var addr = $("#addr").val();
	var map_default_lng = $("#lng").val();
	var map_default_lat = $("#lat").val();
	var map_tmp_lng = 0;
	var map_tmp_lat = 0;

	var map = new BMap.Map("map", {enableMapClick: false});
	var point = new BMap.Point(map_default_lng, map_default_lat);
	map.centerAndZoom(point, 15);
	var myIcon = new BMap.Icon("/static/images/mark_ditu.png", new BMap.Size(64, 64), {anchor: new BMap.Size(32,64)});
	var marker = new BMap.Marker(point, {icon: myIcon});  //自定义标注
	
	var myGeo = new BMap.Geocoder();
	
	//如果经、纬度都为0则设置城市名为中心点
	if(map_default_lng == 0 && map_default_lat == 0){
		
		//根据地址解析
		if(city != ""){
			var address = city;
			if(addr != "") address = addr;
			myGeo.getPoint(address, function(address){
				//如果解析成功
				if(address){
					setMark(address, 0);

					$("#lng").val(address.lng);
					$("#lat").val(address.lat);
				
				//不成功则以城市为中心点
				}else{
					setMark(city, 1);
				}
			}, city);
				
		//如果城市为空，则定位当前城市
		}else{
			function myFun(result){
				var cityName = result.name;
				
				myGeo.getPoint(cityName, function(address){
					//如果解析成功
					if(address){
						setMark(address, 0);
					
					//不成功则以城市为中心点
					}else{
						setMark(city, 1);
					}
					
				}, cityName);
				
			}
			var myCity = new BMap.LocalCity();
			myCity.get(myFun);
		}
		
	}else{
		marker = new BMap.Marker(point, {icon: myIcon});  //自定义标注
		map.addOverlay(marker);
		marker.enableDragging();
		listener();
	}
	
	map.enableScrollWheelZoom();
	map.enableKeyboard();
	map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_SMALL}));	
	map.addControl(new BMap.MapTypeControl({mapTypes: [BMAP_NORMAL_MAP,BMAP_HYBRID_MAP]}));     //2D图，卫星图
	
	//设置中心点并添加标注
	function setMark(address, type){
		map.clearOverlays();
		map.setCenter(address);
		if(type == 0){
			point = new BMap.Point(address.lng, address.lat);
			marker = new BMap.Marker(point, {icon: myIcon});  //自定义标注
		}
		map.addOverlay(marker);
		marker.enableDragging();
		
		listener();
	}
	
	//监听事件
	function listener(){
		//点击
		map.addEventListener("click", function(e){
			marker.setPosition(e.point);
			$("#lng").val(e.point.lng);
			$("#lat").val(e.point.lat);
			myGeo.getLocation(e.point, function(rs){
				var addComp = rs.addressComponents;
				$("#addr").val(addComp.street + addComp.streetNumber);
			});
		});
		
		//拖动
		marker.addEventListener("dragend", function(e){
			$("#lng").val(e.point.lng);
			$("#lat").val(e.point.lat);
			myGeo.getLocation(e.point, function(rs){
				var addComp = rs.addressComponents;
				$("#addr").val(addComp.street + addComp.streetNumber);
			});
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
		var keyword = $("#keyword");
		if($.trim(keyword.val()) != ""){
			
			var ls = new BMap.LocalSearch(map);
			ls.setSearchCompleteCallback(function(rs) {
				if (ls.getStatus() == BMAP_STATUS_SUCCESS) {
					var poi = rs.getPoi(0);
					if (poi) {
						setMark(poi.point, 0);
						
						$("#lng").val(poi.point.lng);
						$("#lat").val(poi.point.lat);
						
						myGeo.getLocation(poi.point, function(rs){
							var addComp = rs.addressComponents;
							$("#addr").val(addComp.street + addComp.streetNumber);
						});
						
					}
				}
			});
			ls.search(keyword.val());
			
		}else{
			keyword.focus();
		}
	});
	
});