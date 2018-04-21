$(function(){



  //年月日
  $('.demo-test-date').scroller(
  	$.extend({preset: 'date', dateFormat: 'yyyy-mm-dd'})
  );

  //下拉菜单
  $('.demo-test-select').scroller(
  	$.extend({preset: 'select'})
  );


  // 选择多选框
  $('.facility li').click(function(){
   $(this).toggleClass('on');
  })

  // 选择单选框
  $('.radioBox a').click(function(){
    var t = $(this), id = t.attr('data-id');
    t.addClass('active').siblings('a').removeClass('active');
    t.siblings('input').val(id);
  })






  //提交发布
  $("#submit").bind("click", function(event){

    var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url"), tj = true;

    event.preventDefault();

    var t           = $(this),
        typeid      = $("#typeid").val(),
        title       = $("#title"),
        addr        = $("#addr").val(),
        person      = $("#person"),
        valid       = $("#valid"),
        tel         = $("#tel"),
        vdimgck     = $("#vdimgck"),
        error       = $(".error"),
        text        = error.find('p');

    if(t.hasClass("disabled")) return;


    if(!typeid){
      showMsg('分类ID获取失败，请重新选择类目！');
      tj = false;
		}
    else if(title.val() == "" || title.val() == 0){
      showMsg('标题不能为空');
      tj = false;
    }
    else if(addr == "" || addr == 0){
      showMsg('请输入区域');
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
    else if(valid.val() == "" || valid.val() == 0){
      showMsg('请输入有效期');
      tj = false;
    }

    // 多选
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
        var val = $(this).find("img").attr("data-val");
        if(val != ""){
          imglist.push(val+"|");
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
