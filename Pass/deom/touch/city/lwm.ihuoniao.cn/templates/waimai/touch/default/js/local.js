$(function(){
	//搜索联想
	var autocomplete = new BMap.Autocomplete({
			input: "s"
	});


	$('.locate a').click(function(){
		var geolocation = new BMap.Geolocation();
		geolocation.getCurrentPosition(function(r){
			if(this.getStatus() == BMAP_STATUS_SUCCESS){
				var geoc = new BMap.Geocoder(); 
				geoc.getLocation(r.point, function(rs){
					var rs = rs.addressComponents;
					location.href = 'index.html?address='+rs.district + rs.street + rs.streetNumber
				});
			}
			else {
				alert('failed'+this.getStatus());
			}
		},{enableHighAccuracy: true})
	})


})