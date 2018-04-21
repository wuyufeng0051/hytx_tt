$(function(){

  var CommunityObj = $(".autocomplete-suggestions");  //地址列表


  //下拉菜单
  $('.demo-test-select').scroller(
    $.extend({preset: 'select'})
  );



  // 选择特色
  $('.facility li').click(function(){
    var t = $(this);
    if (t.hasClass('on')) {
      $(this).removeClass('on');
    }else {
      $(this).addClass('on');
    }
  })

  //小区模糊搜索
  $('#community').bind("input", function(){
		$('#communityid').val('0');
		var title = $(this).val();

		$.ajax({
	        url: masterDomain + '/include/ajax.php?service=house&action=communityList',
	        data: "keywords="+title,
	        dataType: "jsonp",
	        success: function (data) {
	            if(data){

	                var list = data.info.list, addrList = [];
	                if(data.state == 100 && list.length > 0){

	                    for (var i = 0, addr, contact; i < list.length; i++) {
	                        addr = list[i];
	                        addrList.push('<div class="autocomplete-suggestion" data-id="'+list[i].id+'">'+list[i].title+'</div>');
	                    }
	                    CommunityObj.html(addrList.join(""));

	                    $('.autocomplete-suggestions').show();
	                    $(".community-addr").hide();

	                }else{
	                    if(list && list.length == 0){
	                        CommunityObj.html('<div class="empty">没有找到小区</empty>');
	                    }else{
	                        CommunityObj.html('<div class="empty">'+data.info+'</empty>');
	                    }

	                    $('.autocomplete-suggestions').hide();
	                    $(".community-addr").show();
	                }

	            }else{
	                CommunityObj.html('<div class="empty">获取失败！</empty>');

                    $('.autocomplete-suggestions').hide();
                    $(".community-addr").show();
	            }
	        },
	        error: function(){
	            CommunityObj.html('<div class="empty">网络错误，加载失败！</empty>');

                $('.autocomplete-suggestions').hide();
                $(".community-addr").show();
	        }
	    });


	})


  $('.autocomplete-suggestions').delegate('.autocomplete-suggestion', 'click', function(){
    var t = $(this), val = t.text(), id = t.attr('data-id');
    $('#community').val(val);
    $('#communityid').val(id);
    $('.autocomplete-suggestions').hide();
    $(".community-addr").hide();
  })

  $("#community").bind("blur", function(){
    setTimeout(function(){
  		if(($("#communityid").val() == 0 || $("#communityid").val() =="") && $("#community").val() != ""){
        	$('.autocomplete-suggestions').hide();
  			$(".community-addr").show();
  		}else{
  			$(".community-addr").hide();
  		}
    },100)
	});

  //提交发布
	$("#submit").bind("click", function(event){

		event.preventDefault();

    var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url"), tj = true;

		var t           = $(this),
				title       = $("#title"),
				community   = $("#community"),
				communityid = $("#communityid").val(),
				addrid      = $("#addrid").val(),
				address     = $("#address"),
				litpic      = $("#fileList").val(),
				price       = $("#price"),
				area        = $("#area"),
				litpic      = $("#fileList"),
				person      = $("#person"),
				tel         = $("#tel"),
				vdimgck     = $("#vdimgck"),
        error       = $(".error"),
        text        = error.find('p');

		if(t.hasClass("disabled")) return;


    if (community.val() == "") {
      showMsg('请输入小区名称');
      tj = false;
    }
    else if(community.val() != "" && (communityid == 0 || communityid == "") && address.val() == ""){
      showMsg('请输入小区详细地址');
      tj = false;
		}
    else if(community.val() != "" && (communityid == 0 || communityid == "") && addrid == 0){
      showMsg('请输入区域');
      tj = false;
		}
    else if(area.val() == "" || area.val() == 0){
      showMsg('面积不能为空');
      tj = false;
		}
    else if(price.val() == "" || price.val() == 0){
      showMsg('总价不能为空');
      tj = false;
		}
    else if(title.val() == "" || title.val() == 0){
      showMsg('标题不能为空');
      tj = false;
		}
    else if(litpic.find('li').length == 1){
      showMsg('请上传房源图片');
      tj = false;
		}
    else if(person.val() == "" || person.val() == 0){
      showMsg('请填写联系人');
      tj = false;
      return false;
    }
    var personRegex = '[\u4E00-\u9FA5\uF900-\uFA2Da-zA-Z]{2,15}', personErrTip = '格式错误，2~15个汉字或字母';
    var exp = new RegExp("^" + personRegex + "$", "img");
    if(!exp.test(person.val())){
      showMsg('联系人格式错误，2~15个汉字或字母');
      tj = false;
    }
    else if(tel.val() == "" || tel.val() == 0){
      showMsg('请输入手机号');
      tj = false;
    }
    else if(!(/^1[34578]\d{9}$/.test(tel.val()))){
      showMsg('手机号码有误，请重填');
      tj = false;
    }
    else if(vdimgck.val() == "" || vdimgck.val() == 0){
      showMsg('请输入验证码');
      tj = false;
    }

    // 属性
    form.find('.flag').remove();
    $('.facility li.on').each(function(){
      var a = $(this), id = a.data('id'), name = a.closest('.facility').data('type');
      form.append('<input type="hidden" name="'+name+'" class="flag" value="'+id+'">');
    })

    if(!tj) return;

    data = form.serialize();

    var imglist = [], imgli = $("#fileList li.thumbnail");

    imgli.each(function(index){
      var t = $(this), val = t.find("img").attr("data-val");
      if(val != ''){
        if(index == 1){
          data += "&litpic="+val;
        }else{
        var val = $(this).find("img").attr("data-val");
          if(val != ""){
            imglist.push(val+"|");
          }
        }
      }
    })

    if(imglist){
      data += "&imglist="+imglist.join(",");
    }

    t.addClass("disabled").html("提交中...");

    $.ajax({
      url: action,
      data: data,
      type: "POST",
      dataType: "json",
      success: function (data) {
        if(data && data.state == 100){
          var tip = "发布成功";
          if(id != undefined && id != "" && id != 0){
            tip = "修改成功";
          }
          alert(tip + "，正在审核中，请耐心等待！")
          location.href = url;
        }else{
          alert(data.info)
          t.removeClass("disabled").html("立即发布");
          $("#verifycode").click();
        }
      },
      error: function(){
        alert('网络错误，请重试！');
        t.removeClass("disabled").html("立即发布");
        $("#verifycode").click();
      }
    });


	});


})
