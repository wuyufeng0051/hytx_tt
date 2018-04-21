$(function(){

	// 接受入驻条款
	$('.agree ').click(function(){
		var x = $(this);
		if (x.hasClass('agree_bc')) {
			x.removeClass('agree_bc');
		}else{
			x.addClass('agree_bc');
		}
	})
	  // 提交成功弹出层
	  $('.btn').click(function(){
	    $('.cheng').show();
	    $('.disk').show();
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

	var sex=['美女','帅哥'];
	var age=['2017','2015','2014','2013','2012','2011','2010','2009','2008','2007','2006','2005','2004','2003','2002','2001','2000','1998','1997','1996','1995','1994','1993','1992','1991','1990','1989','1988','1987','1986','1985','1984','1983','1982','1981','1980','1979','1978','1977','1976','1975','1974','1973','1972','1971','1970'];
	var type=['交友','婚恋','交友 婚恋'];
	var marry=['单身','离异','丧偶'];
	var height=['150','151','153','154','155','156','157','158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','196','197','198','198','200'];
	var school=['高中及以下','大专','本科','硕士','博士','博士后'];
	var money=['1000-2000','2000-3000','3000-5000','5000-8000','8000以上'];
	var house=['有房无车','无房有车','有车有房','无车无房'];
	var gong=['公开','不公开'];


	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger1', 
	    title: '性别',  
	    wheels: [
	                {data: sex}
	            ],
	    position:[1] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger2', 
	    title: '年龄',  
	    wheels: [
	                {data: age}
	            ],
	    position:[1] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger3', 
	    title: '交友类型',  
	    wheels: [
	                {data: type}
	            ],
	    position:[1] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger4', 
	    title: '婚姻状况',  
	    wheels: [
	                {data: marry}
	            ],
	    position:[1] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger5', 
	    title: '身高',  
	    wheels: [
	                {data: height}
	            ],
	    position:[20] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger6', 
	    title: '学历',  
	    wheels: [
	                {data: school}
	            ],
	    position:[3] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger7', 
	    title: '月收入',  
	    wheels: [
	                {data: money}
	            ],
	    position:[2] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger8', 
	    title: '车房情况',  
	    wheels: [
	                {data: house}
	            ],
	    position:[1] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
	var mobileSelect1 = new MobileSelect({
	    trigger: '#trigger9', 
	    title: '',  
	    wheels: [
	                {data: gong}
	            ],
	    position:[1] //初始化定位 打开时默认选中的哪个  如果不填默认为0
	});
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