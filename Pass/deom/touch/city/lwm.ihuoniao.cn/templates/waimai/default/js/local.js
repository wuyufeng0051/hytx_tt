var history_local = 'wm_history_local';


//提交搜索
function check(){
	var keywords = $.trim($("#keywords").val());

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

			utils.setStorage('waimai_local', JSON.stringify({'lng': point.lng, 'lat': point.lat, 'address': keywords}));
			location.href = 'index.html';
		}else{
			alert("您选择地址没有解析到结果!");
		}
	}, '中国');

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


	//定位当前位置
	$('.click').bind('click', function(){
		var geolocation = new BMap.Geolocation();
	    geolocation.getCurrentPosition(function(r){
	    	if(this.getStatus() == BMAP_STATUS_SUCCESS){
	    		lat = r.point.lat;
				lng = r.point.lng;

				var myGeo = new BMap.Geocoder();
	            myGeo.getLocation(r.point, function mCallback(rs){
	    	        var allPois = rs.surroundingPois;
	    	        if(allPois == null || allPois == ""){
	                    alert('定位失败');
	    	            return;
	    	        }
	                utils.setStorage('waimai_local', JSON.stringify({'lng': lng, 'lat': lat, 'address': allPois[0].title}));
	                location.href = 'index.html';
	    	    }, {
	    	        poiRadius: 1000,  //半径一公里
	    	        numPois: 1
	    	    });
				
	    	}
	    	else {
	    		alert('failed'+this.getStatus());
	    	}
	    },{enableHighAccuracy: true})
	});


	var autocomplete = new BMap.Autocomplete({input: "keywords"});
	autocomplete.addEventListener("onconfirm", function(e) {
		var _value = e.item.value;
		myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		$('#keywords').val(myValue);
		check();
	});

});
