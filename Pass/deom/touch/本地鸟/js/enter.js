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
	$('.btn').click(function(){
		$('.cheng').show();
		$('.disk').show();
	})
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
		if ($('.QR_box .thumbnail').length > 0) {
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
				$('.now').click(function(){
          $('#place').val(rs.district + rs.street + rs.streetNumber);
          $('#lng').text(r.point.lng);
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
        console.log(loc)
        $('#place').val(loc.poiaddress+loc.poiname);  
        $('#lng').text(loc.latlng.lng);  
			  alert(loc.latlng.lat);  
			}                                
		}, false); 
	// 调用微信接口上传图片
	$.ajax({
		url: "http://huoniao.bdniao.com/HN_test/wechat.php?id=wxdbd247b4802a1ed6&secret=76ab84807ec5edc9cfc342f04b773ce7&url=" + encodeURIComponent(location.href.split('#')[0]),
		// data: {},
		type: "GET",
		dataType: "json",
		success: function(data) {
				
				var appId = data.appId,
					timestamp = data.timestamp,
					nonceStr = data.nonceStr;
					signature = data.signature;

  			wx.config({      
          debug: false,
          appId: appId,
          timestamp: timestamp,
          nonceStr: nonceStr,
          signature: signature,
          jsApiList: [
             'chooseImage',
             'uploadImage',
             'downloadImage'
         ] 
        })
        var images = {
          localId: [],
          serverId: []
        }  
        $(".picture_1").click(function(){ 
            wx.ready(function(){
              //拍照或从手机相册中选图接口
              wx.chooseImage({
                  count: 1, // 最多能选择多少张图片，默认9
                  sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                  sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                  success: function (res) {
                      var localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                      var localIdImg=localId.toString().split(",");
                      //上传图片接口                            
                          if (localIdImg.length == 0) {
                            return;
                          }
                          var i = 0, length = images.localId.length;
                          images.serverId = [];
                          function upload() {
                            wx.uploadImage({
                              localId: localIdImg[i],
                              success: function (res) {
                                $("#fileList1 .thumbnail img").attr('src',localIdImg[i]);
                                i++;
                                if (i < localIdImg.length) {
                                  upload();
                                }   
                              },
                              fail: function (res) {
                                alert(JSON.stringify(res));
                              }
                            });
                          }
                          upload();
                    }                    
                });
            });   
        });
        $("#filePicker2").click(function(){ 
          var length = $('#fileList2 li').length;
          var conunt = 10 - length;
          if (conunt == 0) {
            
          }else{
            wx.ready(function(){
              //拍照或从手机相册中选图接口
              wx.chooseImage({
                  count: conunt, // 最多能选择多少张图片，默认9
                  sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                  sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                  success: function (res) {
                      var localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                      var localIdImg=localId.toString().split(",");
                      //上传图片接口                            
                          if (localIdImg.length == 0) {
                            return;
                          }
                          var i = 0, length = images.localId.length;
                          images.serverId = [];
                          function upload() {
                            wx.uploadImage({
                              localId: localIdImg[i],
                              success: function (res) {
                                $("#fileList2").prepend('<li><img src="'+localIdImg[i]+'" /><i></i></li>');
                                i++;
                                if (i < localIdImg.length) {
                                  upload();
                                }   
                                if ($('.picture_2 ul li').length > 9) {
                                 var x = $('.picture_2 ul li');
                                   x.closest('.uploader-list').find('.uploadbtn').hide();
                                }                                        
                              },
                              fail: function (res) {
                                alert(JSON.stringify(res));
                              }
                            });
                          }
                          upload();
                    }                    
                });
            });   
          }
        });
        $('.picture_2').delegate('#fileList2 li i','click',function(){
          var x = $(this);
          $('.delete').show();
          $('.disk').show();
          $('.delete .sure').click(function(){
            find = x.closest('li');
            find.remove();
            if ($('.picture_2 ul li').length < 10) {
                 $('.picture_2').find('.uploadbtn').show();
              } 
            $('.delete').hide();
            $('.disk').hide();
          })
        }) 
        $("#filePicker3").click(function(){ 
          var length = $('#fileList3 li').length;
          var conunt = 10 - length;
          if (conunt == 0) {
            
          }else{
            wx.ready(function(){
              //拍照或从手机相册中选图接口
              wx.chooseImage({
                  count: conunt, // 最多能选择多少张图片，默认9
                  sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                  sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                  success: function (res) {
                      var localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                      var localIdImg=localId.toString().split(",");
                      //上传图片接口                            
                          if (localIdImg.length == 0) {
                            return;
                          }
                          var i = 0, length = images.localId.length;
                          images.serverId = [];
                          function upload() {
                            wx.uploadImage({
                              localId: localIdImg[i],
                              success: function (res) {
                                $("#fileList3").prepend('<li><img src="'+localIdImg[i]+'" /><i></i></li>');
                                i++;
                                if (i < localIdImg.length) {
                                  upload();
                                }   
                                if ($('.picture_3 ul li').length > 9) {
                                 var x = $('.picture_3 ul li');
                                   x.closest('.uploader-list').find('.uploadbtn').hide();
                                }                                        
                              },
                              fail: function (res) {
                                alert(JSON.stringify(res));
                              }
                            });
                          }
                          upload();
                    }                    
                });
            });   
          }
        });
        $('.picture_3').delegate('#fileList3 li i','click',function(){
          var x = $(this);
          $('.delete').show();
          $('.disk').show();
          $('.delete .sure').click(function(){
            find = x.closest('li');
            find.remove();
            if ($('.picture_3 ul li').length < 10) {
                 $('.picture_3').find('.uploadbtn').show();
              } 
            $('.delete').hide();
            $('.disk').hide();
          })
        })
        $(".picture_4").click(function(){ 
            wx.ready(function(){
              //拍照或从手机相册中选图接口
              wx.chooseImage({
                  count: 1, // 最多能选择多少张图片，默认9
                  sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                  sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                  success: function (res) {
                      var localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                      var localIdImg=localId.toString().split(",");
                      //上传图片接口                            
                          if (localIdImg.length == 0) {
                            return;
                          }
                          var i = 0, length = images.localId.length;
                          images.serverId = [];
                          function upload() {
                            wx.uploadImage({
                              localId: localIdImg[i],
                              success: function (res) {
                                $("#fileList4 .thumbnail img").attr('src',localIdImg[i]);
                                i++;
                                if (i < localIdImg.length) {
                                  upload();
                                }   
                                // if ($('.picture_4 ul li').length > 1) {
                                //  var x = $('.picture_4 ul li');
                                //    x.closest('.uploader-list').find('.uploadbtn').hide();
                                // }                                        
                              },
                              fail: function (res) {
                                alert(JSON.stringify(res));
                              }
                            });
                          }
                          upload();
                    }                    
                });
            });   
        });

		},
		error: function() {
			// console.log(111)
			// alert(1111)
		}
  	});
    $('.delete .cancel').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
     
})