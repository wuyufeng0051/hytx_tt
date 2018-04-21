var pubStaticPath = (typeof staticPath != "undefined" && staticPath != "") ? staticPath : "/static/";
var pubModelType = (typeof modelType != "undefined") ? modelType : "siteConfig";

document.write('<script type="text/javascript" src="'+pubStaticPath+'js/webuploader/webuploader.js?t='+~(-new Date())+'"></script>');

$(function(){


$("head").append('<link rel="stylesheet" type="text/css" href="'+pubStaticPath+'css/publicUpload.css?t='+~(-new Date())+'">');

$('.listImgBox').show();

$('.filePicker').each(function() {
  var picker = $(this), type = picker.data('type'), atlasMax = count = picker.data('count'), size = picker.data('size') * 1024;

	if (type == "thumb") {
		var upType1 = "thumb";
	}else {
		var upType1 = "atlas";
	}


	//上传凭证
  var i = $(this).attr('id').substr(10,1);
	var $list = $('#listSection' + i),
		uploadbtn = $('.uploadinp'),
			ratio = window.devicePixelRatio || 1,
			fileCount = 0,
			thumbnailWidth = 100 * ratio,   // 缩略图大小
			thumbnailHeight = 100 * ratio,  // 缩略图大小
			uploader;

	fileCount = $list.find('li').length;

  if (type == "adv") {
    var adBody = [];
        adBody = $('#adBody').html().split(",");
    if (adBody != "") {
      fileCount = adBody.length;
    }
  }

  // 后加载进来的数据
	var	img = picker.data('imglist');
	if (img != "") {
    if (type == "certs") {
      var list = certs.split("||"), picList = [], fileCount = list_length = list.length, count = count - list_length;
    }else {
      var list = imglist[img], picList = [], fileCount = list_length = list.length, count = count - list_length;
    }
	}



	// 初始化Web Uploader
	uploader = WebUploader.create({
		auto: true,
		swf: pubStaticPath + 'js/webuploader/Uploader.swf',
		server: '/include/upload.inc.php?mod='+pubModelType+'&type='+upType1,
		pick: '#filePicker' + i,
		fileVal: 'Filedata',
		accept: {
			title: 'Images',
			extensions: 'jpg,jpeg,gif,png',
			mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif'
		},
		fileNumLimit: count,
		fileSingleSizeLimit: size
	});

	//删除已上传图片
	var delAtlasPic = function(b){
		var g = {
			mod: pubModelType,
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
      if (type != "thumb") {
        $list.hide();
				$list.closest('.listImgBox').find('.deleteAllAtlas').hide();
      }
		}else{
			$('.imgtip').hide();
			if(atlasMax > 1 && $list.find('.litpic').length == 0){
				$list.children('li').eq(0).addClass('litpic');
			}
      if (type != "thumb") {
        $list.show();
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
	$list.delegate(".li-rm", "click", function(){
		var t = $(this), li = t.closest("li"), ul = li.closest('ul');
		var file = [];
		file['id'] = li.attr("id");
    if (type == "thumb") {
      $('#'+file.id).closest('.thumb').find('.uploadinp').show();
    }
		removeFile(file);
		updateStatus();
		imgListVal(ul);

	});


	//删除所有图集
	$(".deleteAllAtlas").bind("click", function(){
		var t = $(this), dd = t.closest('.listImgBox'), listSection = dd.find('.listSection'),
				li = listSection.find("li"), file = [];

			for (var m = 0; m < li.length; m++) {
				file['id'] = li.eq(m).attr("id");
				removeFile(file);
			}

		fileCount = 0;
		updateStatus();
		listSection.hide();
		t.hide();
		imgListVal(listSection);

	});



	// 切换litpic
	if(atlasMax > 1){
		$list.delegate(".pubitem img", "click", function(){
			var t = $(this).parent('.pubitem');
			if(atlasMax > 1 && !t.hasClass('litpic')){
			console.log('eee')
				t.addClass('litpic').siblings('.pubitem').removeClass('litpic');
			}
		});
	}

	// 当有文件添加进来时执行，负责view的创建
	function addFile(file) {

    if (type == "thumb") {
      var $li = $('<li id="' + file.id + '" class="pubitem"><a href="" target="_blank" title="" class="enlarge"><img></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li>');
    }else if (type == "desc"){
      var $li   = $('<li class="pubitem fn-clear" id="' + file.id + '"><span class="li-move" title="拖动调整图片顺序">↕</span><a class="li-rm" href="javascript:;">×</a><div class="li-thumb" style="display: block;"><div class="r-progress"><s></s></div><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img></div><textarea class="li-desc inputVal" placeholder="请输入图片描述" style="display: inline-block;"></textarea></li>');
    }else if (type == "adv"){
      var $li   = $('<li class="pubitem fn-clear" id="' + file.id + '"><a class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</a><a class="li-rm" href="javascript:;">×</a><div class="li-thumb" style="display: block;"><div class="r-progress"><s></s></div><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img data-val="" src=""></div><div class="li-input" style="display: block;"><input style="margin:0 10px 10px 0; width:47%; float:left;" class="i-name inputVal" placeholder="请输入图片名称" value=""><input style="margin:0 0 10px 0; width:46%; float:left;" class="i-link inputVal" placeholder="请输入图片链接" value=""><input class="i-desc inputVal" placeholder="请输入图片介绍" value=""></div></li>');
    }else if (type == "name"){
      var $li   = $('<li class="pubitem fn-clear" id="' + file.id + '"><a class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</a><a class="li-rm" href="javascript:;">×</a><div class="li-thumb" style="display: block;"><div class="r-progress"><s></s></div><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img data-val="" src=""></div><div class="li-info" style="display:block;"><input class="li-title inputVal" placeholder="请输入图片名称" style="width:225px; display:inline-block;" value=""></div></li>');
    }else if (type == "album"){
      var $li   = $('<li class="pubitem fn-clear" id="' + file.id + '"><a class="li-rm" href="javascript:;">×</a><div class="li-thumb" style="display: block;"><div class="r-progress"><s></s></div><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img data-val="" src=""></div></li>');
    }else if (type == "certs"){
      var $li   = $('<li class="pubitem fn-clear" id="' + file.id + '"><a class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</a><a class="li-rm" href="javascript:;">×</a><div class="li-thumb" style="display:block;"><span class="ibtn"><a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a><a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a><a href="" target="_blank" class="enlarge" title="放大"></a></span><span class="ibg"></span><img data-val="" src=""></div><div class="li-input" style="display: block;"><input class="i-name" placeholder="请输入图片名称" value="" /><input class="i-note" placeholder="请输入图片简介" value="" /></div></li>');
    }

		var $btns = $li.find('.li-rm'),
		    $img = $li.find('img');


		// 创建缩略图
		uploader.makeThumb(file, function(error, src) {
				if(error){
					$img.replaceWith('<span class="thumb-error">不能预览</span>');
					return;
				}
				$img.attr('src', src);
			}, thumbnailWidth, thumbnailHeight);

			$btns.on('click', function(){
				uploader.removeFile(file, true);
			});

			$('.deleteAllAtlas').on('click', function(){
				uploader.removeFile(file, true);
			});

			$list.append($li);
	}

	// 当有文件添加进来的时候
	uploader.on('fileQueued', function(file) {


		//先判断是否超出限制
		if(fileCount == atlasMax){
	    showErr($(this.options.pick), "图片数量已达上限");
			return false;
		}

    if (type == "thumb") {
      $(this.options.pick).closest('.uploadinp').hide();
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

	// 文件上传成功，给pubitem添加成功class, 用样式标记上传成功。
	uploader.on('uploadSuccess', function(file, response){
		var $li = $('#'+file.id);
		if(response.state == "SUCCESS"){
			var img = $li.find("img");
			img.attr("data-val", response.url).attr("data-url", response.turl).attr("src", response.turl);
			$li.find(".enlarge").attr("href", response.turl);
			$li.closest('.listImgBox').find('.deleteAllAtlas').show();
			imgListVal(img);
		}else{
			removeFile(file);
	    showErr($(this.options.pick), "上传失败");
		}
	});

	// 文件上传失败，现实上传出错。
	uploader.on('uploadError', function(file){
		removeFile(file);
    showErr($(this.options.pick), "上传失败");
	});

	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on('uploadComplete', function(file){
		$('#'+file.id).find('.progress').remove();

	});

	//上传失败
	uploader.on('error', function(code){
		var txt = "上传失败！", size = this.options.fileSingleSizeLimit;
		switch(code){
			case "Q_EXCEED_NUM_LIMIT":
				txt = "图片数量已达上限";
				break;
			case "F_EXCEED_SIZE":
				txt = "图片大小超出限制，单张图片最大不得超过"+size/1024/1024+"MB";
				break;
			case "F_DUPLICATE":
				txt = "此图片已上传过";
				break;
		}
    showErr($(this.options.pick), txt);
	});


	// 后台上传图集
	if (img != "") {
    if (img != "certs") {
  		for(var j = 0; j < list_length; j++){
        var path = list[j].path;
  			picList.push('<li class="clearfix" id="WU_FILE_9_'+j+'">');
  			picList.push('  <a class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</a>');
  			picList.push('  <a class="li-rm" href="javascript:;">×</a>');
  			picList.push('  <div class="li-thumb" style="display:block;">');
  			picList.push('    <div class="r-progress"><s></s></div>');
  			picList.push('    <span class="ibtn">');
  			picList.push('      <a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a>');
  			picList.push('      <a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a>');

        if (type == "desc") {
          if (path == undefined) {
            var imgItem = list[j].split("##");
            picList.push('      <a href="'+cfg_attachment+imgItem[0]+'&type=large" target="_blank" class="enlarge" title="放大"></a>');
          }else {
            picList.push('      <a href="'+cfg_attachment+path+'&type=large" target="_blank" class="enlarge" title="放大"></a>');
          }
        }else {
          picList.push('      <a href="'+cfg_attachment+list[j]+'" target="_blank" class="enlarge" title="放大"></a>');
        }


  			picList.push('    </span>');
  			picList.push('    <span class="ibg"></span>');

        if (type == "desc") {
          if (path == undefined) {
            picList.push('    <img data-val="'+imgItem[0]+'" src="'+cfg_attachment+imgItem[0]+'" data-url="'+cfg_attachment+imgItem[0]+'" />');
      			picList.push('  </div>');
            picList.push('  <textarea class="li-desc inputVal" placeholder="请输入图片描述" style="display:inline-block;">'+imgItem[1]+'</textarea>');
          }else {
            picList.push('    <img data-val="'+path+'" src="'+cfg_attachment+path+'" data-url="'+cfg_attachment+path+'" />');
      			picList.push('  </div>');
            picList.push('  <textarea class="li-desc inputVal" placeholder="请输入图片描述" style="display:inline-block;">'+list[j].info+'</textarea>');
          }
        }else {
          picList.push('    <img data-val="'+list[j]+'" src="'+cfg_attachment+list[j]+'" data-url="'+cfg_attachment+list[j]+'" />');
    			picList.push('  </div>');
        }
  			picList.push('</li>');
  		}
    }else {
      if (certs != "") {
    		for(var j = 0; j < list.length; j++){
    			var imgItem = list[j].split("##");
    			picList.push('<li class="clearfix" id="SWFUpload_1_0'+j+'">');
    			picList.push('  <a class="li-move" href="javascript:;" title="拖动调整图片顺序">移动</a>');
    			picList.push('  <a class="li-rm" href="javascript:;">×</a>');
    			picList.push('  <div class="li-thumb" style="display:block;">');
    			picList.push('    <div class="r-progress"><s></s></div>');
    			picList.push('    <span class="ibtn">');
    			picList.push('      <a href="javascript:;" class="Lrotate" title="逆时针旋转90度"></a>');
    			picList.push('      <a href="javascript:;" class="Rrotate" title="顺时针旋转90度"></a>');
    			picList.push('      <a href="'+cfg_attachment+imgItem[0]+'&type=large" target="_blank" class="enlarge" title="放大"></a>');
    			picList.push('    </span>');
    			picList.push('    <span class="ibg"></span>');
    			picList.push('    <img data-val="'+imgItem[0]+'" src="'+cfg_attachment+imgItem[0]+'" data-val="'+cfg_attachment+imgItem[0]+'" />');
    			picList.push('  </div>');
    			picList.push('  <div class="li-input" style="display:block;"><input class="i-name" placeholder="请输入资质名称" value="'+imgItem[1]+'" /><input class="i-note" placeholder="请输入资质简介" value="'+imgItem[2]+'" /></div>');
    			picList.push('</li>');
    		}
      }
    }

		$("#listSection"+i).html(picList.join("")).show();
    if (list_length > 0) {
      $("#listSection"+i).closest('.listImgBox').find(".deleteAllAtlas").show();
    }
	}

	imgListVal(picker);

})


	$('.listSection').on('input propertychange', function(){
		var t = $(this);
		imgListVal(t);
	})



	function imgListVal(obj){
		var dd = obj.closest('.listImgBox'), btn = dd.find('.filePicker'), type = btn.data("type"),
				listLi = dd.find('.listSection li'), $li_list = [];

		if (listLi.length != 0) {
			for (var k = 0; k < listLi.length; k++) {
				if (type == "thumb") {
					var imgsrc = listLi.find('img').attr('data-val');
					dd.find('.imglist-hidden').val(imgsrc);
				}else if (type == "desc"){
					var imgsrc = listLi.eq(k).find('img').attr("data-val"), imgdes = listLi.eq(k).find('.li-desc').val();
					$li_list.push(imgsrc+"|"+imgdes);
					dd.find('.imglist-hidden').val($li_list);
				}else if (type == "adv") {
					var imgsrc = listLi.eq(k).find('img').attr("data-val"), name = listLi.eq(k).find('.i-name').val(), href = listLi.eq(k).find('.i-link').val(), desc = listLi.eq(k).find('.i-desc').val();
					$li_list.push(imgsrc+"##"+name+"##"+href+"##"+desc);
					dd.find('.imglist-hidden').val($li_list);
				}else if (type == "name") {
					var imgsrc = listLi.eq(k).find('img').attr("data-val"), title = listLi.eq(k).find('.li-title');
					$li_list.push(imgsrc+"||"+title);
					dd.find('.imglist-hidden').val($li_list);
				}else if (type == "album") {
					var imgsrc = listLi.eq(k).find('img').attr("data-val");
					$li_list.push(imgsrc);
					dd.find('.imglist-hidden').val($li_list);
				}else if (type == "certs") {
          var imgsrc = listLi.eq(k).find('img').attr("data-val"), name = listLi.eq(k).find('.i-name').val(), note = listLi.eq(k).find('.i-note').val();
          $li_list.push(imgsrc+"##"+name+"##"+note);
          dd.find('.imglist-hidden').val($li_list.join("||"));
				}
			}
		}else {
			$li_list = [];
			dd.find('.imglist-hidden').val($li_list);
		}


	}



	//逆时针旋转
	$(".listSection").delegate(".Lrotate", "click", function(){
		var t = $(this), img = t.parent().siblings("img").attr("data-val"), url = t.parent().siblings("img").attr("data-url");
		uploadCustom.rotateAtlasPic(pubModelType, "left", img, function(data){
			if(data.state == "SUCCESS"){
        if (typeof hideFileUrl != "undefined") {
          t.parent().siblings("img").attr("src", hideFileUrl == 1 ? url+"&v="+Math.random() : url+"?v="+Math.random());
        }else {
          if (url.indexOf('?') < 0) {
            t.parent().siblings("img").attr("src", url+"?v="+Math.random());
          }else {
            t.parent().siblings("img").attr("src", url+"&v="+Math.random());
          }
        }
				imgListVal(t);
			}else{
				$.dialog.alert(data.info);
			}
		});
	});

	//顺时针旋转
	$(".listSection").delegate(".Rrotate", "click", function(){
		var t = $(this), img = t.parent().siblings("img").attr("data-val"), url = t.parent().siblings("img").attr("data-url");
		uploadCustom.rotateAtlasPic(pubModelType, "right", img, function(data){
			if(data.state == "SUCCESS"){
        if (typeof hideFileUrl != "undefined") {
  				t.parent().siblings("img").attr("src", hideFileUrl == 1 ? url+"&v="+Math.random() : url+"?v="+Math.random());
        }else {
          if (url.indexOf('?') < 0) {
            t.parent().siblings("img").attr("src", url+"?v="+Math.random());
          }else {
            t.parent().siblings("img").attr("src", url+"&v="+Math.random());
          }
        }
				imgListVal(t);
			}else{
				$.dialog.alert(data.info);
			}
		});
	});

	//图集排序
	$(".list-holder ul").dragsort({ dragSelector: "li", placeHolderTemplate: '<li class="holder"></li>', dragEnd: function(){imgListVal($(this))}});


	//错误提示
  function showErr(error, txt){
    var obj = error.next('.upload-tip').find('.fileerror');
    obj.html(txt);
    setTimeout(function(){
      obj.html('');
    },2000)
  }


})
