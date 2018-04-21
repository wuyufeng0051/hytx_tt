$(function(){

    //错误提示
    var showErrTimer;
    function showErr(txt){
        showErrTimer && clearTimeout(showErrTimer);
        $(".popErr").remove();
        $("body").append('<div class="popErr"><p>'+txt+'</p></div>');
        $(".popErr p").css({"margin-left": -$(".popErr p").width()/2, "left": "50%"});
        $(".popErr").css({"visibility": "visible"});
        showErrTimer = setTimeout(function(){
            $(".popErr").fadeOut(300, function(){
                $(this).remove();
            });
        }, 1500);
    }

    //发布选择分类
    $("#selType").change(function(){
        var t = $(this), id = t.val();
        if(id){

            $.ajax({
                url: "/include/ajax.php?service=tieba&action=type&type="+id,
                type: "GET",
                dataType: "jsonp",
                success: function (data) {
                    if(data && data.state == 100){

                        var option = [], list = data.info;
                        for(var i = 0; i < list.length; i++){
                            option.push('<option value="'+list[i].id+'">'+list[i].typename+'</option>');
                        }
                        if(option){
                            t.next("select").remove();
                            t.parent().append('<select><option value="">请选择分类</option>'+option.join("")+'</select>');
                        }

                    }
                }
            });

        }else{
            t.next("select").remove();
        }
    });


  $("#content").focus(function(){
      var t = $(this), con = t.html();
      if(con == "帖子内容"){
          t.removeClass("placeholder").html("");
      }
  });

  $("#content").blur(function(){
    var t = $(this), con = t.html();
    if(con == ""){
        t.addClass("placeholder").html("帖子内容");
    }
  });



  // 选择表情
  var memerySelection;
  $('.editor .emotion').click(function(){
		var t = $(this), box = $('.emotion-box');
        memerySelection = window.getSelection();
		if (box.css('display') == 'none') {
		    $('.emotion-box').show();
            $('.img-box').hide();
            t.addClass('on');
            $(".editor .img").removeClass("on");
			return false;
		}else {
			box.hide();
            t.removeClass('on');
		}
	})

  //选择图片
  $(".editor .img").click(function(){
    var t = $(this), box = $(".img-box");
    if (box.css('display') == 'none') {
        $('.emotion-box').hide();
        box.show();
        t.addClass('on');
        $(".editor .emotion").removeClass("on");
    }else {
        box.hide();
        t.removeClass('on');
    }
  })

  $('.emotion-box li').click(function(){
		var t = $(this).find('img'), textarea = $('.textarea'), hfTextObj = textarea;
		hfTextObj.focus();
		pasteHtmlAtCaret('<img src="'+t.attr("src")+'" />');
	})

  //回复框
	function replyFunc(parent, name){
		var comment = $(".comment"), mlinfo = comment.closest(".ml-list-info");
		if(Number(mlinfo.attr("data-reply")) == 0){
			mlinfo.find(".reply-shou").click();
		}
		comment.remove();
		parent.find(".comment").remove();
		parent.append($("#replyTemp").html());
		parent.find(".comment").show();

		var textarea = parent.find(".textarea");

		if(name){
			textarea.html('<label contenteditable="false">回复  ' + name + '</label>&nbsp;');
		}

		set_focus(textarea);
		hfTextObj = textarea;
		textarea.bind("paste", function(e){
			clearHtml(e);
		})
		textarea.bind("keydown", function(e){
			clearShortKey(e);
		})
	}

  //根据光标位置插入指定内容
	function pasteHtmlAtCaret(html) {
      var sel, range;
      if (window.getSelection) {
          sel = memerySelection;
          if (sel.getRangeAt && sel.rangeCount) {
              range = sel.getRangeAt(0);
              range.deleteContents();
              var el = document.createElement("div");
              el.innerHTML = html;
              var frag = document.createDocumentFragment(), node, lastNode;
              while ( (node = el.firstChild) ) {
                  lastNode = frag.appendChild(node);
              }
              range.insertNode(frag);
              if (lastNode) {
                  range = range.cloneRange();
                  range.setStartAfter(lastNode);
                  range.collapse(true);
                  sel.removeAllRanges();
                  sel.addRange(range);
              }
          }
      } else if (document.selection && document.selection.type != "Control") {
          document.selection.createRange().pasteHTML(html);
      }
  }

	//光标定位到最后
	function set_focus(el){
		el=el[0];
		el.focus();
		if($.browser.msie){
			var rng;
			el.focus();
			rng = document.selection.createRange();
			rng.moveStart('character', -el.innerText.length);
			var text = rng.text;
			for (var i = 0; i < el.innerText.length; i++) {
				if (el.innerText.substring(0, i + 1) == text.substring(text.length - i - 1, text.length)) {
					result = i + 1;
				}
			}
		}else{
			var range = document.createRange();
			range.selectNodeContents(el);
			range.collapse(false);
			var sel = window.getSelection();
			sel.removeAllRanges();
			sel.addRange(range);
		}
	}



    //上传凭证
	var $list = $('#fileList'),
        uploadbtn = $('.uploadbtn'),
		ratio = window.devicePixelRatio || 1,
		fileCount = 0,
		thumbnailWidth = 100 * ratio,   // 缩略图大小
		thumbnailHeight = 100 * ratio,  // 缩略图大小
		uploader;

    // 初始化Web Uploader
	uploader = WebUploader.create({
		auto: true,
		swf: staticPath + 'js/webuploader/Uploader.swf',
		server: '/include/upload.inc.php?mod=tieba&type=atlas',
		pick: '#filePicker',
		fileVal: 'Filedata',
		accept: {
			title: 'Images',
			extensions: atlasType,
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
		fileNumLimit: atlasMax,
		fileSingleSizeLimit: atlasSize
	});

	//删除已上传图片
	var delAtlasPic = function(b){
		var g = {
			mod: "tieba",
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

	// 负责view的销毁
	function removeFile(file) {
		var $li = $('#'+file.id);
		fileCount--;
		delAtlasPic($li.find("img").attr("data-val"));
		$li.off().find('.file-panel').off().end().remove();
	}

	//从队列删除
	$list.delegate(".cancel", "click", function(){
		var t = $(this), li = t.closest("li");
		var file = [];
		file['id'] = li.attr("id");
		removeFile(file);
	});


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

		uploadbtn.after($li);
	}

	// 当有文件添加进来的时候
	uploader.on('fileQueued', function(file) {

		//先判断是否超出限制
		if(fileCount == atlasMax){
			showErr('图片数量已达上限');
			return false;
		}

		fileCount++;
		addFile(file);
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
			// $li.find("img").attr("data-val", response.url).attr("style", "background-image: url('"+huoniao.changeFileSize(response.turl, "small")+"')");
			$li.find("img").attr("data-val", response.url);
		}else{
			removeFile(file);
			showErr('上传失败！');
		}
	});

	// 文件上传失败，现实上传出错。
	uploader.on('uploadError', function(file){
		removeFile(file);
		showErr('上传失败！');
	});

	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on('uploadComplete', function(file){
		$('#'+file.id).find('.progress').remove();
	});

	//上传失败
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
		showErr(txt);
	});






    //发表帖子/评论
    $(".top-r").click(function(){
        var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			location.href = masterDomain + '/login.html';
			return false;
		}

        var t = $(this);
        if(t.hasClass("disabled")) return false;

        var typeid = $(".type select:last").val();
        if(!typeid){
            alert("请选择板块分类！");
            return false;
        }

        var title = $("#title").val();
        if(title == ""){
            alert("请填写标题！");
            return false;
        }

        var content = $("#content").html();

        if(content == ""){
			alert("请填写内容！");
            return false;
		}

        var imgArr = [];
        $("#fileList .thumbnail").each(function(){
            var t = $(this), img = t.find("img"), val = img.attr("data-val");
            if(val != ""){
                imgArr.push('<div class="tieba_img"><img src="'+attachment+val+'" /></div>');
            }
        });
        content += imgArr.join("");

        t.addClass("disabled");
        $.ajax({
			url: "/include/ajax.php?service=tieba&action=sendPublish",
            data: "typeid="+typeid+"&title="+encodeURIComponent(title)+"&content="+encodeURIComponent(content),
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					fabuPay.check(data, channelDomain, t);

				}else{
					alert(data.info);
					t.removeClass("disabled");
				}
			},
			error: function(){
				alert("网络错误，发表失败，请稍候重试！");
				t.removeClass("disabled");
			}
		});


    });


})