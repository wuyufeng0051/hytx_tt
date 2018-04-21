$(function(){

	// 店铺分类选择
	$('.choice').click(function(){
		var x = $(this),
			arrow = x.find('.arrow');
		if (arrow.hasClass('box_open')) {
			$('.choice_box').show();
			arrow.removeClass('box_open');
		}else{
			$('.choice_box').hide();
			arrow.addClass('box_open');
		}
	})
	$('.choice_box ul li').click(function(){
		var x = $(this);
		if (x.hasClass('cb_bc')) {
			x.removeClass('cb_bc');
		}else{
			x.addClass('cb_bc');
		}
	})

	// 提交成功弹出层
	$('.cheng p span').click(function(){
		$('.cheng').hide();
		$('.disk').hide();
	})
	$('.disk').click(function(){
		$('.cheng').hide();
		$('.disk').hide();
    $('.delete').hide();
	})
	// 支付方式选择
	$('.wei_pay ul li').click(function(){
		var x = $(this);
		x.addClass('re_check').siblings().removeClass('re_check');
		$('.cash_pay ul li').removeClass('re_check');
	})
	$('.cash_pay ul li').click(function(){
		var x = $(this);
		x.addClass('re_check').siblings().removeClass('re_check');
		$('.wei_pay ul li').removeClass('re_check');
	})

	// 接受入驻条款
	$('.agreement').click(function(){
		var x = $(this);
		if (x.hasClass('agree_bc')) {
			x.removeClass('agree_bc');
		}else{
			x.addClass('agree_bc');
		}
	})

	// 地理位置选择弹出框
	$('.location').click(function(){
		$('.choice_location').slideDown(300);
		$('.disk,.choice_location').show();
	})
	$('.disk').click(function(){
		$('.choice_location').slideUp(300);
		$('.disk').hide();
	})
	$('.close').click(function(){
		$('.choice_location').slideUp(200);
		$('.disk').hide();
	})

	// 二维码上传
	$('.QR_code').click(function(){
		$('.QR_box').css({"left":"50%"});
		$('.disk').show();
	})
	$('.disk').click(function(){
		$('.QR_box').css({"left":"-50%"});
		$('.disk').hide();
		if ($('.QR_box ul li').length > 2) {
			$('.b_box .QR_code span i').text('已上传');
		}else{
			$('.b_box .QR_code span i').text('未上传');
		}
	})
	// 地图弹出层
	$('.map').click(function(){
	    var t = $(this);
	    $('.map_box').addClass('show').animate({"left":"0"},200);
	    $('.choice_location').slideUp(300);
		$('.disk').hide();
  	})
	$('.map_box .back , .map_box .sure').click(function(){
		 var t = $(this);
	    $('.map_box').animate({"left":"100%"},200);
		$('body').removeClass('by');
  	})
	$('.map').click(function(){
    	var dom = $('.map_box')
        if (dom.hasClass('show')) {
            $('body').addClass('by')
        }else{
            $('body').removeClass('by')
        }
  })
  var start=['01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00'];
  var end=['01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00'];
  var mobileSelect1 = new MobileSelect({
      trigger: '#starttime', 
      title: '',  
      wheels: [
                  {data: start}
              ],
      position:[10] //初始化定位 打开时默认选中的哪个  如果不填默认为0
  });
  var mobileSelect1 = new MobileSelect({
      trigger: '#endtime', 
      title: '',  
      wheels: [
                  {data: end}
              ],
      position:[10] //初始化定位 打开时默认选中的哪个  如果不填默认为0
  });
	// 定位
	var geolocation = new BMap.Geolocation();
	geolocation.getCurrentPosition(function(r){
		if(this.getStatus() == BMAP_STATUS_SUCCESS){
			var geoc = new BMap.Geocoder();
			geoc.getLocation(r.point, function(rs){
				var rs = rs.addressComponents;
				// $('#place').val(rs.district + rs.street + rs.streetNumber)
				$('.now').click(function(){
					$('#place').val(rs.district + rs.street + rs.streetNumber)
					$('#lng').val(r.point.lng);
					$('#lat').val(r.point.lat);
					$('.disk').hide();
					$('.choice_location').hide();
				})
			});
		}
		else {
			alert('failed'+this.getStatus());
		}
	},{enableHighAccuracy: true})

	window.addEventListener('message', function(event) {
		// 接收位置信息，用户选择确认位置点后选点组件会触发该事件，回传用户的位置信息
			var loc = event.data;
			if (loc && loc.module == 'locationPicker') {//防止其他应用也会向该页面post信息，需判断module是否为'locationPicker'
			  $('#place').val(loc.poiaddress+loc.poiname);
			  $('#lng').val(loc.latlng.lng);
			  $('#lat').val(loc.latlng.lat);
			}                                
		}, false);

    $('.delete .cancel').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
     
})