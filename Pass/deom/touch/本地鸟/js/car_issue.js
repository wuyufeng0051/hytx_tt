$(function(){


	// 货车选择 性别选择
	$('.choice_box ul li').click(function(){
		var x = $(this);
		x.addClass('CB_bc').siblings().removeClass('CB_bc');
	})
	$('.bag').click(function(){
		var x = $(this);
		if (x.hasClass("bag")) {
			x.removeClass('bag');
			x.find('.arrow img').removeClass('bag_bc');
			$('.bag_1').show();
		}else{
			x.addClass('bag');
			x.find('.arrow img').addClass('bag_bc');
			$('.bag_1').hide();
		}
	})
	$('.sex').click(function(){
		var x = $(this);
		if (x.hasClass("sex")) {
			x.removeClass('sex');
			x.find('.arrow img').removeClass('sex_bc');
			$('.sex_1').show();
		}else{
			x.addClass('sex');
			x.find('.arrow img').addClass('sex_bc');
			$('.sex_1').hide();
		}
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
	$('.agree').click(function(){
		var x = $(this);
		if (x.hasClass('agree_bc')) {
			x.removeClass('agree_bc');
		}else{
			x.addClass('agree_bc');
		}
	})
  //年月日
  var currYear = (new Date()).getFullYear();  
  var opt={};
  opt.date = {preset : 'date'};
  opt.datetime = {preset : 'datetime'};
  opt.time = {preset : 'time'};
  opt.default = {
    theme: 'android-holo light', //皮肤样式
    display: 'bottom', //显示方式 
    mode: 'scroller', //日期选择模式
    dateFormat: 'yyyy-mm-dd',
    lang: 'zh',
    showNow: true,
    nowText: "今天",
    stepMinute: 1,
    startYear: currYear-0, //开始年份
    endYear: currYear +3//结束年份
  };
  var optDateTime = $.extend(opt['datetime'], opt['default']);
  $(".demo-test-date").mobiscroll(optDateTime).datetime(optDateTime);
  var requestDate = $(".demo-test-date").val();
  if(requestDate != ""){
    requestDate = new Date(requestDate);
    $(".demo-test-date").scroller('setDate', requestDate, true);
  }
  
  // 提交成功弹出层
  $('.btn').click(function(){
    $('.cheng').show();
    $('.disk').show();
    alert($('#valid').val());
  })
  // $('.cheng p span').click(function(){
  //   $('.cheng').hide();
  //   $('.disk').hide();
  // })
  $('.disk').click(function(){
    $('.cheng').hide();
    $('.disk').hide();
    $('.delete').hide();
  })



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
        $("#filePicker1").click(function(){ 
          var length = $('#fileList1 li').length;
          var conunt = 6 - length;
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

                                $("#fileList1").prepend('<li><img src="'+localIdImg[i]+'" /><i></i></li>');
                                i++;
                                images.serverId = images.serverId.push(res.serverId); 
                                if (i < localIdImg.length) {
                                  upload();
                                }   
                                if ($('.picture_1 ul li').length > 5) {
                                 var x = $('.picture_1 ul li');
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
        $('.picture_1').delegate('#fileList1 li i','click',function(){
          var x = $(this);
          $('.delete').show();
          $('.disk').show();
          $('.delete .sure').click(function(){
            find = x.closest('li');
            find.remove();
            if ($('.picture_1 ul li').length < 6) {
                 $('.picture_1').find('.uploadbtn').show();
              } 
            $('.delete').hide();
            $('.disk').hide();
          })
        }) 

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
    $('.disk').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
     
})