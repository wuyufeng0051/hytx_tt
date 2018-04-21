$(function(){

  var device = navigator.userAgent;
  if (device.indexOf('huoniao_iOS') > -1) {
    $('body').addClass('huoniao_iOS');
  }

  // 选择区号
  $('#areaCode').scroller(
    $.extend({preset: 'select'})
  );
  $('#typeid').scroller(
    $.extend({preset: 'select', group: true})
  );
  $('.select').show();


  var geetestData = "";
  function sendVerCode(t){
    t.addClass('disabled').html(langData['siteConfig'][7][10]+'...');
    $.ajax({
      url: masterDomain+"/include/ajax.php?service=siteConfig&action=getPhoneVerify&type=join",
      data: "areaCode="+$('#areaCode').val()+"&phone="+$('#phone').val() + geetestData,
      type: "GET",
      dataType: "jsonp",
      success: function (data) {
        //获取成功
        if(data && data.state == 100){
          t.addClass('disabled').html(langData['siteConfig'][4][6]+'(<em class="count">60</em>s)');
          count = t.find('.count');
          countDown(60, count, t);
          $('.yzm').addClass('show');

        //获取失败
        }else{
          t.removeClass("disabled").html(langData['siteConfig'][4][1]);
          alert(data.info);
        }
      }
    });
  }


  if(geetest){

		//极验验证
		var handlerPopup = function (captchaObj) {
			// captchaObj.appendTo("#popup-captcha");

			// 成功的回调
			captchaObj.onSuccess(function () {

				var result = captchaObj.getValidate();
        var geetest_challenge = result.geetest_challenge,
            geetest_validate = result.geetest_validate,
            geetest_seccode = result.geetest_seccode;

				geetestData = "&geetest_challenge="+geetest_challenge+'&geetest_validate='+geetest_validate+'&geetest_seccode='+geetest_seccode;

				sendVerCode($('.verify'));
			});


      $('.verify').click(function(){
        var t = $(this), phone = $('#phone');
        if (t.hasClass('disabled')) {
          return false;
        }
        if (phone.val() == "") {
          showErr(langData['siteConfig'][20][239]);
        }else {
          captchaObj.verify();
        }
      })

		};


	    $.ajax({
	        url: masterDomain+"/include/ajax.php?service=siteConfig&action=geetest&t=" + (new Date()).getTime(), // 加随机数防止缓存
	        type: "get",
	        dataType: "json",
	        success: function (data) {
	            initGeetest({
	                gt: data.gt,
	                challenge: data.challenge,
									offline: !data.success,
									new_captcha: true,
									product: "bind",
									width: '312px'
	            }, handlerPopup);
	        }
	    });

	}else{
    // 发送验证码
    $('.verify').click(function(){
      var t = $(this), phone = $('#phone');
      if (t.hasClass('disabled')) {
        return false;
      }
      if (phone.val() == "") {
        showErr(langData['siteConfig'][20][239]);
      }else {
        sendVerCode(t);
      }
    })
  }


  // 下一步
  $('.next-btn').click(function(){
    var t = $(this), step = t.attr('data-step'), next = t.attr('data-next');
    var name = $('#name').val(),
        phone = $('#phone').val(),
        yzm = $('#yzm').val(),
        email = $('#email').val(),
        cardnum = $('#cardnum').val(),
        company = $('#company').val(),
        licensenum = $('#licensenum').val(),
        addrid = $('#addrid').val(),
        address = $('#address').val(),
        typeid = $('#typeid').val(),
        yzmbox = $('.yzm');

    if(t.hasClass("disabled")) return false;

    // 基本信息
    if (step == "slideBox1") {
      if (name == "") {
        showErr(langData['siteConfig'][20][314]);
        return false;
      }
      if (phone == "") {
        showErr(langData['siteConfig'][20][315]);
        return false;
      }
      if (!yzmbox.hasClass('show')) {
        showErr(langData['siteConfig'][20][316]);
        return false;
      }else {
        if (yzm == "") {
          showErr(langData['siteConfig'][20][317]);
          return false;
        }
      }
      if (email == "") {
        showErr(langData['siteConfig'][20][318]);
        return false;
      }else{
  			var reg = !!email.match(/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/);
  			if(!reg) {
          showErr(langData['siteConfig'][20][319]);
          return false;
  			}
  		}
      if (cardnum == "") {
        showErr(langData['siteConfig'][20][106]);
        return false;
      }else{
        // if (!checkIdcard(cardnum)) {
        //   showErr('请输入正确的身份证号码');
        //   return false;
        // }
  		}
      if (company == "") {
        showErr(langData['siteConfig'][20][320]);
        return false;
      }
      if (licensenum == "") {
        showErr(langData['siteConfig'][20][321]);
        return false;
      }
      if (typeid == "" || typeid == 0) {
        showErr(langData['siteConfig'][20][322]);
        return false;
      }
      if (addrid == "") {
        showErr(langData['siteConfig'][20][323]);
        return false;
      }
      if (address == "") {
        showErr(langData['siteConfig'][20][324]);
        return false;
      }
      window.scroll(0, 0);
      $('.slideBox').hide();
      $('.header-l').attr('data-prev', 'slideBox1');
      $('.header-c').text(langData['siteConfig'][20][325]);
      $('.'+next).show();
    }

    // 资质信息
    else if (step == "slideBox2"){
      var front = $('#front').val(),
          back = $('#back').val(),
          logo = $('#logo').val();
      if (front == "") {
        showErr(langData['siteConfig'][20][107]);
        return false;
      }
      if (back == "") {
        showErr(langData['siteConfig'][20][108]);
        return false;
      }
      if (logo == "") {
        showErr(langData['siteConfig'][20][326]);
        return false;
      }



      t.addClass("disabled").html(langData['siteConfig'][6][35]+"...")

      var data = {
        name: name,
        areaCode: $("#areaCode").val(),
        phone: phone,
        yzm: yzm,
        email: email,
        cardnum: cardnum,
        company: $("#company").val(),
        licensenum: $("#licensenum").val(),
        addrid: $("#addrid").val(),
        address: $("#address").val(),
        cardfront: front,
        cardbehind: back,
        license: $("#zhizhao").val(),
        accounts: $("#xuke").val(),
        jingying: $("#zhuce").val(),
        typeid: typeid,
        logo: logo
      }

      $.ajax({
          url: masterDomain+"/include/ajax.php?service=member&action=joinBusiness",
          data: data,
          dataType: "jsonp",
          success: function (data) {
            t.removeClass("disabled").html(langData['siteConfig'][6][32]);
            if(data.state == 100){
              window.location.href = data.info;
            }else{
              alert(data.info);
            }
          },
          error: function(){
            t.removeClass("disabled").html(langData['siteConfig'][6][32]);
            alert(langData['siteConfig'][20][181]);
          }
      });

      // window.location.href = 'select-module.html';

    }

  })

  // 返回上一步
  $('.header-l').click(function(){
    var t = $(this), prev = t.attr('data-prev');
    if (prev == "0") {
      window.history.go(-1);
    }else if (prev == "slideBox1") {
      $('.header-l').attr('data-prev', '0');
      $('.slideBox').hide();
      $('.header-c').text(langData['siteConfig'][19][22]);
      $('.'+prev).show();
    }else if (prev == "slideBox2") {
      $('.header-l').attr('data-prev', 'slideBox1');
      $('.slideBox').hide();
      $('.'+prev).show();
    }
  })


  // 倒计时(开始时间、计时器、显示容器)
  function countDown(time, obj, btn){
    mtimer = setInterval(function(){
      obj.text((--time));
      if (time <= 0) {
        clearInterval(mtimer);
        btn.removeClass('disabled').html(langData['siteConfig'][4][1]);
      }
    }, 1000)
  }

  // 上传图片
  $('.input-img').each(function(){
    var t = $(this), id = t.attr('id');
    //上传凭证
  	var $list = t.closest('dl').find('dt'),
  		uploadbtn = $('.uploadbtn'),
  			ratio = window.devicePixelRatio || 1,
  			fileCount = 0,
  			thumbnailWidth = 100 * ratio,   // 缩略图大小
  			thumbnailHeight = 100 * ratio,  // 缩略图大小
  			uploader;

  	fileCount = $list.find("li.item").length;

  	// 初始化Web Uploader
  	uploader = WebUploader.create({
  		auto: true,
  		swf: staticPath + 'js/webuploader/Uploader.swf',
  		server: '/include/upload.inc.php?mod=member&type=card',
  		pick: {
        id:'#'+id,
        multiple: false
      },
  		fileVal: 'Filedata',
  		accept: {
  			title: 'Images',
  			extensions: 'jpg,jpeg,gif,png',
  			mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif'
  		},
  		compress: {
  			width: 750,
  	    height: 750,
  	    // 图片质量，只有type为`image/jpeg`的时候才有效。
  	    quality: 90,
  	    // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
  	    allowMagnify: false,
  	    // 是否允许裁剪。
  	    crop: false,
  	    // 是否保留头部meta信息。
  	    preserveHeaders: true,
  	    // 如果发现压缩后文件大小比原来还大，则使用原来图片
  	    // 此属性可能会影响图片自动纠正功能
  	    noCompressIfLarger: false,
  	    // 单位字节，如果图片大小小于此值，不会采用压缩。
  	    compressSize: 1024*200
  		},
  		fileNumLimit: 2,
  		fileSingleSizeLimit: atlasSize
  	});

  	//删除已上传图片
  	var delAtlasPic = function(b){
  		var g = {
  			mod: 'member',
  			type: "delAtlas",
  			picpath: b,
  			randoms: Math.random()
  		};
  		$.ajax({
  			type: "POST",
  			url: "/include/upload.inc.php",
  			data: $.param(g)
  		})
  	};

  	//更新上传状态
  	function updateStatus(){
  		if(fileCount == 0){
  			$('.imgtip').show();
  		}else{
  			$('.imgtip').hide();
  			if(atlasMax > 1 && $list.find('.litpic').length == 0){
  				$list.children('li').eq(0).addClass('litpic');
  			}
  		}
  		$(".uploader-btn .utip").html(langData['siteConfig'][20][303].replace('1', (atlasMax-fileCount)));
  	}

  	// 负责view的销毁
  	function removeFile(file) {
  		var $li = $('#'+file.id);
  		fileCount--;
  		delAtlasPic($li.find("img").attr("data-val"));
  		$li.remove();
  		updateStatus();
  	}


  	// 切换litpic
  	if(atlasMax > 1){
  		$list.delegate(".item img", "click", function(){
  			var t = $(this).parent('.item');
  			if(atlasMax > 1 && !t.hasClass('litpic')){
  			console.log('eee')
  				t.addClass('litpic').siblings('.item').removeClass('litpic');
  			}
  		});
  	}

    var fileArr = [];

    // 当有文件添加进来时执行，负责view的创建
  	function addFile(file) {
  		var $li   = $('<div id="' + file.id + '"><img></div>'),
  				$img = $li.find('img');

          var imgval = $('#'+id.replace('up_', '')).val();
          if (imgval != "") {
            // uploader.removeFile(imgval, true);
            // removeFile(imgval);
          }

  		// 创建缩略图
  		uploader.makeThumb(file, function(error, src) {
  				if(error){
  					$img.replaceWith('<span class="thumb-error">'+langData['siteConfig'][20][304]+'</span>');
  					return;
  				}
  				$img.attr('src', src);
  			}, thumbnailWidth, thumbnailHeight);



  			$list.html($li);
  	}

  	// 当有文件添加进来的时候
  	uploader.on('fileQueued', function(file) {

  		//先判断是否超出限制
  		if(fileCount == atlasMax){

  		}

  		fileCount++;
  		addFile(file);
  		updateStatus();
  	});

  	// 文件上传过程中创建进度条实时显示。
  	uploader.on('uploadProgress', function(file, percentage){
  		var $li = $('#'+file.id),
  		$percent = $li.find('.progress span');

  		// 避免重复创建
  		if (!$percent.length) {
  			$percent = $('<p class="progress"><span></span></p>')
  				.appendTo($li)
  				.find('span');
  		}
  		$percent.css('width', percentage * 100 + '%');
  	});

  	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
  	uploader.on('uploadSuccess', function(file, response){
  		var $li = $('#'+file.id);
  		if(response.state == "SUCCESS"){
  			$li.find("img").attr("data-val", response.url).attr("data-url", response.turl);
        $('#'+id.replace('up_', '')).val(response.url);
        fileArr = file;
        $li.closest('dl').find('.picker-btn').text(langData['siteConfig'][6][59]);
  		}else{
  			removeFile(file);
  			showErr(langData['siteConfig'][20][306]);
  		}
  	});

  	// 文件上传失败，现实上传出错。
  	uploader.on('uploadError', function(file){
  		removeFile(file);
  		showErr(langData['siteConfig'][20][306]);
  	});

  	// 完成上传完了，成功或者失败，先删除进度条。
  	uploader.on('uploadComplete', function(file){
  		$('#'+file.id).find('.progress').remove();
  	});

  	//上传失败
  	uploader.on('error', function(code){
  		var txt = langData['siteConfig'][20][306];
  		switch(code){
  			case "Q_EXCEED_NUM_LIMIT":
  				txt = langData['siteConfig'][20][305];
  				break;
  			case "F_EXCEED_SIZE":
  				txt = langData['siteConfig'][20][307].replace('1', atlasSize/1024/1024);
  				break;
  			case "F_DUPLICATE":
  				txt = langData['siteConfig'][20][308];
  				break;
  		}
  		showErr(txt);
  	});
  })


  //判断身份证信息
  function checkIdcard(sId) {
  	var tj = true;
  	var aCity = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外" }
  	var iSum = 0
  	var info = ""
  	if (!/^\d{17}(\d|x)$/i.test(sId)) {
  		tj = false;
  	}
  	sId = sId.replace(/x$/i, "a");
  	if (aCity[parseInt(sId.substr(0, 2))] == null) {
  		tj = false;
  	}
  	sBirthday = sId.substr(6, 4) + "-" + Number(sId.substr(10, 2)) + "-" + Number(sId.substr(12, 2));
  	var d = new Date(sBirthday.replace(/-/g, "/"))
  	if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate())) {
  		tj = false;
  	}
  	for (var i = 17; i >= 0; i--) iSum += (Math.pow(2, i) % 11) * parseInt(sId.charAt(17 - i), 11)
  	if (iSum % 11 != 1) {
  		tj = false;
  	}
  	return tj;
  }

})

// 错误提示
function showErr(str){
  var o = $(".error");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}

// 删除图片
function delFile(src){
  var g = {
    mod: "member",
    type: "delCard",
    picpath: src,
    randoms: Math.random()
  };
  $.ajax({
    type: "POST",
    cache: false,
    async: false,
    url: "/include/upload.inc.php",
    dataType: "json",
    data: $.param(g),
    success: function() {}
  });
}
