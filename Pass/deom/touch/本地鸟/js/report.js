$(function(){
	$('.report_box .choice_box ul li').click(function(){
		var x = $(this);
		if (x.hasClass('cb_bc')) {
			x.removeClass('cb_bc');
		}else{
			x.addClass('cb_bc');
		}
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
          var conunt = 7 - length;
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
                                if (i < localIdImg.length) {
                                  upload();
                                }   
                                if ($('.picture_1 ul li').length > 6) {
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
            if ($('.picture_1 ul li').length < 7) {
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