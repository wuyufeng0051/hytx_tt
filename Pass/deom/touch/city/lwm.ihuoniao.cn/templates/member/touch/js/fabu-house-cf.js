$(function(){


  //下拉菜单
  $('.demo-test-select').scroller(
    $.extend({preset: 'select'})
  );


  // 出租、出售、转让
  $('.radioBox label').click(function(){
    var t = $(this), id = t.find('a').attr('data-id'), type = $('.sharetype');
    t.addClass('active').siblings('label').removeClass('active');
    $('#lei').attr('value', id);
    if (id == 0) {
      $('#priceType').text('元/月');$('.transfer, .industry').hide();
    }else {
      $('#priceType').text('万元');$('.transfer, .industry').hide();
      if (id == 1) {
        $('.transfer, .industry').show();
      }
    }
  })



  // 选择特色
  $('.facility li').click(function(){
    var t = $(this);
    if (t.hasClass('on')) {
      $(this).removeClass('on');
    }else {
      $(this).addClass('on');
    }
  })




  //提交发布
	$("#submit").bind("click", function(event){

    var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url"), tj = true;

		event.preventDefault();

		var t           = $(this),
        lei         = $("#lei"),
        title       = $("#title"),
        addrid      = $("#addrid").val(),
        address     = $("#address"),
        litpic      = $("#litpic").val(),
        price       = $("#price"),
        area        = $("#area"),
        litpic      = $("#litpic"),
        person      = $("#person"),
        tel         = $("#tel"),
        vdimgck     = $("#vdimgck"),
        error       = $(".error"),
        text        = error.find('p');

		if(t.hasClass("disabled")) return;

		else if(addrid == 0 || addrid == ""){
      showMsg('请选择厂房所在区域');
      tj = false;
		}
    else if(address.val() == ""){
      showMsg('请输入厂房详细地址');
      tj = false;
		}
    else if(area.val() == "" || area.val() == 0){
      showMsg('面积不能为空');
      tj = false;
		}
    else if(price.val() == "" || price.val() == 0){
      showMsg('请输入价格');
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
