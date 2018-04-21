$(function(){
	$(".FormBox .FormTabe.dection .dec_com").click(function(){
		$('.FormBox .FormTabe.dection textarea').focus();
	})
	$('.FormBox .FormTabe.dection textarea').focus(function(){
		$(".FormBox .FormTabe.dection .dec_com").hide();
	})
	$('.FormBox .FormTabe.dection textarea').blur(function(){
		$(".FormBox .FormTabe.dection .dec_com").show();
	})
	$('.FormBox .FormTabe.dection textarea').keyup(function(){
		$(".FormBox .FormTabe.dection .dec_com").remove();
	})

	// 同意协议
	$(".read").click(function(){
		var x = $(this);
		if (x.hasClass('reread')) {
			x.removeClass('reread')
		}else{
			x.addClass('reread')
		}
	})

	// 表单提交

	$(".submit").click(function(){
		var type  = $("#type").val(),
			money = $("#money").val(),
			pic   = $("#fileList1 li").length,
			name  = $('#name').val(),
			tel   = $('#tel').val(),
			offsetTop = 0;

		if (type == "") {
			$("#type").closest('.FormTabe').find('.warning').show();	
			offsetTop = offsetTop == 0 ? $("#type").position().top : offsetTop;
		}else if (money == "") {
			$("#money").closest('.FormTabe').find('.warning').show();	
			offsetTop = offsetTop == 0 ? $("#money").position().top : offsetTop;
		}else if (pic <= 1) {
			$("#fileList1").closest('.FormTabe').find('.warning').show();	
			offsetTop = offsetTop == 0 ? $("#fileList1").position().top : offsetTop;
		}else if (name == "") {
			$("#name").closest('.FormTabe').find('.warning').show();	
			offsetTop = offsetTop == 0 ? $("#name").position().top : offsetTop;
		}else if (tel == "") {
			$("#tel").closest('.FormTabe').find('.warning').show();	
			offsetTop = offsetTop == 0 ? $("#tel").position().top : offsetTop;
		}else{
			$(".wrning").hide();
			alert(111);
		}

		if(offsetTop){
			$('body').animate({scrollTop: offsetTop - 20}, 300);
			return false;
		}

	})

	var modelType = 'info', upType1 = 'atlas', atlasSize = 1024 * 1024;

  $('.picker').each(function(){

    var t = $(this), filePicker = t.attr('id'), id = filePicker.substr(10, 1), type = t.attr('data-type'),
         atlasMax = t.attr('data-amount');
    //上传凭证
  	var $list = $('#fileList'+id),
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
  		swf: 'http://dq.huoniaomenhu.com/static/js/webuploader/Uploader.swf',
  		server: 'http://dq.huoniaomenhu.com/include/upload.inc.php?mod='+modelType+'&type='+upType1,
  		pick: '#filePicker'+id,
  		fileVal: 'Filedata',
  		accept: {
  			title: 'Images',
  			extensions: 'jpg,jpeg,gif,png',
  			mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif'
  		},
  		fileNumLimit: atlasMax,
  		fileSingleSizeLimit: atlasSize
  	});

  	//删除已上传图片
  	var delAtlasPic = function(b){
  		var g = {
  			mod: modelType,
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
  		$(".uploader-btn .utip").html('还能上传'+(atlasMax-fileCount)+'张图片');
  	}

  	// 负责view的销毁
  	function removeFile(file) {
  		var $li = $('#'+file.id);
  		fileCount--;
  		delAtlasPic($li.find("img").attr("data-val"));
  		$li.remove();
  		updateStatus();
  	}

  	//从队列删除
  	$list.delegate(".cancel", "click", function(){
  		var t = $(this), li = t.closest("li");
  		var file = [];
  		file['id'] = li.attr("id");
  		removeFile(file);
  		updateStatus();
  	});

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

  	// 当有文件添加进来时执行，负责view的创建
  	function addFile(file) {
  		var $li   = $('<li id="' + file.id + '" class="thumbnail"><img></li>'),
  				$btns = $('<div class="file-panel"><span class="cancel"></span></div>').appendTo($li),
  				$img = $li.find('img');

  		// 创建缩略图
  		uploader.makeThumb(file, function(error, src) {
  				if(error){
  					$img.replaceWith('<span class="thumb-error">不能预览</span>');
  					return;
  				}
  				$img.attr('src', src);
  			}, thumbnailWidth, thumbnailHeight);

  			$btns.on('click', 'span', function(){
  				uploader.removeFile(file, true);
  			});

  			$list.append($li);
        if (type == "litpic") {
          t.css('opacity', '0');
        }
  	}

  	// 当有文件添加进来的时候
  	uploader.on('fileQueued', function(file) {

  		//先判断是否超出限制
  		if(fileCount == atlasMax){
  			alert('图片数量已达上限');
  			// $(".uploader-btn .utip").html('<font color="ff6600">图片数量已达上限</font>');
  			return false;
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
  		}else{
  			removeFile(file);
  			alert('上传失败！');
  			// $(".uploader-btn .utip").html('<font color="ff6600">上传失败！</font>');
  		}
  	});

  	// 文件上传失败，现实上传出错。
  	uploader.on('uploadError', function(file){
  		removeFile(file);
  		alert('上传失败！');
      if (type == "litpic") {
        t.css('opacity', '1');
      }
  		// $(".uploader-btn .utip").html('<font color="ff6600">上传失败！</font>');
  	});

  	// 完成上传完了，成功或者失败，先删除进度条。
  	uploader.on('uploadComplete', function(file){
  		$('#'+file.id).find('.progress').remove();
  	});

  	// 上传失败
  	uploader.on('error', function(code){
  		var txt = "上传失败！";
  		switch(code){
  			case "Q_EXCEED_NUM_LIMIT":
  				txt = "图片数量已达上限";
  				break;
  			case "F_EXCEED_SIZE":
  				txt = "图片大小超出限制，单张图片最大不得超过"+atlasSize/1024/1024+"MB";
  				break;
  			case "F_DUPLICATE":
  				txt = "此图片已上传过";
  				break;
  		}
  		alert(txt);
      if (type == "litpic") {
        t.css('opacity', '1');
      }
  		// $(".uploader-btn .utip").html('<font color="ff6600">'+txt+'</font>');
  	});

  })

})