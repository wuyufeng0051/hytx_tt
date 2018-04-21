$(function(){
    // 顶部导航栏tab切换
    $(".nav_tab ul li").click(function(){
        var x = $(this),
            index = x.index();
        x.addClass('navBC').siblings().removeClass('navBC');
        $('.navList .navBox').eq(index).show().siblings().hide();
    })

    // 日期
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
      showNow: false,
      nowText: langData['siteConfig'][13][24],
      stepMinute: 1,
      // defaultValue: [ new Date(2013, 6, 12), new Date(2013, 6, 18, 23, 59) ],
      startYear: currYear-0, //开始年份
      endYear: currYear +3//结束年份
    };
    var optDateTime = $.extend(opt['datetime'], opt['default']);
    var optTime = $.extend(opt['time'], opt['default']);
    $("#startdate").mobiscroll(optDateTime).datetime(optDateTime);
    $("#enddate").mobiscroll(optDateTime).datetime(optDateTime);

    // 人数单选
    $('.choicebox .choicekind span').click(function(){
        var x = $(this),
            txt = x.text();
            x.addClass('choiceBC').siblings().removeClass('choiceBC');
        $("#item_185").val(txt);
    })

    // 购买须知增加 上下移动
    $("#NeedList").delegate(".up","click",function(){
        var x = $(this),
            box = x.closest('li'),
            index = box.index(),
            nextbox = index-1;
        $(".up").show();
        $(".down").show();
        $('#NeedList li').eq(nextbox).before(box).fadeIn();
        hiddenbox();
    })
    $("#NeedList").delegate(".down","click",function(){
        var x = $(this),
            box = x.closest('li'),
            index = box.index(),
            nextbox = index+1;
        $(".up").show();
        $(".down").show();
        $('#NeedList li').eq(nextbox).after(box).fadeIn();
        hiddenbox();
    })
    $("#NeedList").delegate(".del","click",function(){
        var x = $(this),
            box = x.closest('li');
        if (confirm(langData['siteConfig'][20][211])==true){
          box.remove();
        }
    })
    $('.AddNeed').click(function(){
        $("#NeedList").append('<li><div class="NeedTitle"><input type="text"placeholder="'+langData['siteConfig'][20][417]+'"></div><div class="Needcon"><textarea name="name"rows="3"cols="80"placeholder="'+langData['siteConfig'][20][418]+'"></textarea></div><div class="NeedBTN fn-clear"><div class="btnbox"><div class="up"><i></i>'+langData['siteConfig'][6][158]+'</div><div class="down"><i></i>'+langData['siteConfig'][6][159]+'</div><div class="del"><i></i></div></div></div></li>').fadeIn();
        $(".up").show();
        $(".down").show();
        hiddenbox();
    })
    hiddenbox();
    function hiddenbox(){
        var MaxIndex = $('#NeedList li:last-child'),
            MinIndex = $('#NeedList li:first-child');
        MaxIndex.find('.down').hide();
        MinIndex.find('.up').hide();
    }

    // 团购内容种类方式选择
    $('.TuanConnect_Nav ul li').click(function(){
        var x = $(this),
            index = x.index(),
            id = x.attr("data-id");
        x.addClass('TC_BC').siblings().removeClass('TC_BC');
        $('.TuanConnect_List .TC_Box').eq(index).show().siblings().hide();
        $("#packtype").val(id);
    })

    // 团购套餐展开收起
    $(".PackageList").delegate(".PackageBox_arrow","click",function(){
        var x = $(this),
            box = x.closest('.PackageBox').find('.PackageBox_List');
            height = box.height();
        if (height == "0") {
            box.css({"height":"auto","padding":"0.1rem .25rem","border":"0.02rem solid #ededed","border-top":"none"});
            x.removeClass('rog')
        }else{
            box.css({"height":"0","padding":"0","border":"none"});
            x.addClass('rog')
        }
    })
    // 新增删除套餐内容
    $(".PackageList").delegate(".PackageBox_ADD","click",function(){
        var x = $(this),
            box = x.closest('.PackageBox_List').find('.PackageBox_LL');
        box.append('<div class="PackageBox_de"><div class="PackageBox_littledel"></div><div class="PL_Name fn-clear"><em>'+langData['siteConfig'][19][547]+'</em><input type="text"class="tit"value=""placeholder="'+langData['siteConfig'][20][419]+'"></div><div class="PL_number"><em>'+langData['siteConfig'][19][315]+'</em><input class="pric"type="text"value=""><em>'+langData['siteConfig'][19][324]+'</em><input class="coun"type="text"value=""><em>'+langData['siteConfig'][19][549]+'</em><input type="text"class="tot"value=""></div></div>')
    })
    $(".PackageList").delegate(".PackageBox_littledel","click",function(){
        var x = $(this),
            box = x.closest('.PackageBox_de');
        if (confirm(langData['siteConfig'][20][211])==true){
            box.remove();
        }
    })

    // 团购套餐增加 上下移动
    $(".PackageList").delegate(".PackageBox_up","click",function(){
        var x = $(this),
            box = x.closest('.PackageBox'),
            index = box.index(),
            nextbox = index-1;
        $(".PackageBox_up").show();
        $(".PackageBox_down").show();
        $('.PackageList .PackageBox').eq(nextbox).before(box).fadeIn();
        PackageHiddenbox();
    })
    $(".PackageList").delegate(".PackageBox_down","click",function(){
        var x = $(this),
            box = x.closest('.PackageBox'),
            index = box.index(),
            nextbox = index+1;
        $(".PackageBox_up").show();
        $(".PackageBox_down").show();
        $('.PackageList .PackageBox').eq(nextbox).after(box).fadeIn();
        PackageHiddenbox();
    })
    $(".PackageList").delegate(".PackageBox_del","click",function(){
        var x = $(this),
            box = x.closest('.PackageBox');
        if (confirm(langData['siteConfig'][20][211])==true){
          box.remove();
        }
    })
    $('.Package_ADD').click(function(){
        $(".PackageList").append('<div class="PackageBox"><div class="PackageBox_Lead fn-clear"><input type="text"placeholder="'+langData['siteConfig'][20][420]+'"value=""><div class="PackageBox_btn"><div class="PackageBox_up"><i></i></div><div class="PackageBox_down"><i></i></div><div class="PackageBox_del"><i></i></div><div class="PackageBox_arrow"><i></i></div></div></div><div class="PackageBox_List"><div class="PackageBox_LL"><div class="PackageBox_de"><div class="PackageBox_littledel"></div><div class="PL_Name fn-clear"><em>'+langData['siteConfig'][19][547]+'</em><input type="text"class="tit"value=""placeholder="'+langData['siteConfig'][20][419]+'"></div><div class="PL_number"><em>'+langData['siteConfig'][19][315]+'</em><input class="pric"type="text"value=""><em>'+langData['siteConfig'][19][324]+'</em><input class="coun"type="text"value=""><em>'+langData['siteConfig'][19][549]+'</em><input type="text"class="tot"value=""></div></div><div class="PackageBox_de"><div class="PackageBox_littledel"></div><div class="PL_Name fn-clear"><em>'+langData['siteConfig'][19][547]+'</em><input type="text"class="tit"value=""placeholder="'+langData['siteConfig'][20][419]+'"></div><div class="PL_number"><em>'+langData['siteConfig'][19][315]+'</em><input class="pric"type="text"value=""><em>'+langData['siteConfig'][19][324]+'</em><input class="coun"type="text"value=""><em>'+langData['siteConfig'][19][549]+'</em><input type="text"class="tot"value=""></div></div></div><div class="PackageBox_ADD"><i></i>'+langData['siteConfig'][19][550]+'</div></div></div>').fadeIn();
        $(".PackageBox_up").show();
        $(".PackageBox_down").show();
        PackageHiddenbox();
    })
    PackageHiddenbox();
    function PackageHiddenbox(){
        var MaxIndex = $('.PackageList .PackageBox:last-child'),
            MinIndex = $('.PackageList .PackageBox:first-child');
        MaxIndex.find('.PackageBox_down').hide();
        MinIndex.find('.PackageBox_up').hide();
    }



    $('.webuploader-container').each(function(){

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
     		swf: staticPath + 'js/webuploader/Uploader.swf',
     		server: '/include/upload.inc.php?mod='+modelType+'&filetype=image&type='+type,
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
     					$img.replaceWith('<span class="thumb-error">'+langData['siteConfig'][20][304]+'</span>');
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
     			alert(langData['siteConfig'][20][305]);
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
     			alert(langData['siteConfig'][20][306]);
     		}
     	});

     	// 文件上传失败，现实上传出错。
     	uploader.on('uploadError', function(file){
     		removeFile(file);
     		alert(langData['siteConfig'][20][306]);
         if (type == "litpic") {
           t.css('opacity', '1');
         }
     	});

     	// 完成上传完了，成功或者失败，先删除进度条。
     	uploader.on('uploadComplete', function(file){
     		$('#'+file.id).find('.progress').remove();
     	});

     	// 上传失败
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
     		alert(txt);
         if (type == "litpic") {
           t.css('opacity', '1');
         }
     	});

     })


    // 提交
    $(".header-r").bind("click", function(event){

		event.preventDefault();

		var t           = $(this),
				title       = $("#title"),
				startdate   = $("#startdate").val(),
				enddate     = $("#enddate").val(),
				tuantype    = $("#tuantype").val(),
				expireddate = $("#expireddate").val(),
				freight     = $("#freight").val(),
				freeshi     = $("#freeshi").val();

		if(t.hasClass("disabled")) return;

		var offsetTop = 0;

        //图集
        var imgList = ""
        $("#fileList1 li").each(function(){
            var x = $(this),
                u = x.index(),
                url = x.find('img').attr("data-val");
            if (u == 1) {
                $("#litpic").val(url)
            }
            if (url != undefined && u != 0) {
                imgList = imgList +','+ url;
            }
        })

        $("#imglist").val(imgList.substr(1));

        var imgli = $("#fileList1 li");
        if(imgli.length <= 1){
            alert(langData['siteConfig'][20][436]);
            return
        }

		//验证标题
		var exp = new RegExp("^.{2,50}$", "img");
		if(!exp.test(title.val())){
			alert(langData['siteConfig'][20][34]);
            return
		}

		if($("#subtitle").val()== ""){
            alert(langData['siteConfig'][20][437]);
            return
		}


		//时间
		if((startdate == "" || enddate == "") && offsetTop <= 0){
            alert(langData['siteConfig'][20][438])
            return
		}

		if($("#maxnum").val()==""){
            alert(langData['siteConfig'][20][439])
            return
		}

		if($("#limit").val() == ""){
            alert(langData['siteConfig'][20][440])
            return
		}

		if($("#market").val() == ""){
            alert(langData['siteConfig'][20][441])
            return
		}

		if($("#price_").val() == ""){
            alert(langData['siteConfig'][20][442])
            return
		}


    //购买须知
    var notice = [], noticeItem = $("#NeedList li");
    if(noticeItem.length > 0){
    	for(var i = 0; i < noticeItem.length; i++){
    		var obj = $("#NeedList li:eq("+i+")");
    		var tit = obj.find("input").val();
    		var con = obj.find("textarea").val();
    		notice.push(tit+"$$$"+con);
    	}
    }

    //套餐内容
    var packtype = $("#packtype").val(), packages = [];
    if(packtype == 1){
    	var obj = $(".voucher"), s1 = obj.find(".s1").val(), s2 = obj.find(".s2").val(), s3 = obj.find(".s3").val(), s4 = obj.find(".s4").val();
    	packages.push(s1+"$$$"+s2+"$$$"+s3+"$$$"+s4);
    }else if(packtype == 2){
    	var obj = $(".PackageList");
    	obj.find(".PackageBox").each(function(i){
    		var manyItem = [], mtit = $(this).find(".PackageBox_Lead input").val();
    		$(this).find(".PackageBox_LL .PackageBox_de").each(function(){
    			var t = $(this), tit = t.find(".tit").val(), pric = t.find(".pric").val(), coun = t.find(".coun").val(), tot = t.find(".tot").val();
    			if(tit != undefined && pric != undefined && coun != undefined && tot != undefined){
	    			manyItem.push(tit+"$$$"+pric+"$$$"+coun+"$$$"+tot);
	    		}
    		});
    		if(mtit != undefined){
	    		packages.push(mtit+"@@@"+manyItem.join("~~~"));
	    	}
    	});
    }

    if(!packages){
        alert(langData['siteConfig'][20][443]);
        return
    }


		var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url");
		data = form.serialize() + "&notice="+notice.join("|||") + "&package="+packages.join("|||");


		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					if(id != undefined && id != "" && id != 0){
						alert(langData['siteConfig'][20][229]);
					}else{
                        alert(langData['siteConfig'][20][341])
                    }
                    location.href = url;

				}else{
					alert(data.info);
				}
			},
			error: function(){
				alert(langData['siteConfig'][20][183]);
			}
		});


	});

})
