$(function(){

  //提交发布
  $("#submit").bind("click", function(event){

    var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url"), tj = true;

    event.preventDefault();

    var t           = $(this),
				title       = $("#title"),
				typeid      = $("#typeid").val(),
				writer      = $("#writer").val(),
				source      = $("#source"),
				textarea    = $("#textarea"),
				sourceurl   = $("#sourceurl"),
				vdimgck     = $("#vdimgck"),
        error       = $(".error"),
        text        = error.find('p');


    if(t.hasClass("disabled")) return;

    var titleRegex = '[\u4E00-\u9FA5\uF900-\uFA2Da-zA-Z]{2,50}';
    var exp = new RegExp("^" + titleRegex + "$", "img");


    if(!exp.test(title.val())){
      showMsg('标题不能为空2~15个汉字或字母aaaa');
      return false;
    }
    else if(typeid == 0 || typeid == ''){
      showMsg('请选择分类');
      return false;
    }
    else if(textarea.val() == "" || textarea.val() == 0){
      showMsg('请填写投稿内容');
      return false;
    }

    var personRegex = '[\u4E00-\u9FA5\uF900-\uFA2Da-zA-Z]{2,15}';
    var exp = new RegExp("^" + personRegex + "$", "img");
    if(!exp.test(writer)){
      showMsg('作者格式错误，2~15个汉字或字母');
      return false;
    }
    else if(source.val() == "" || source.val() == 0){
      showMsg('请输入来源');
      return false;
    }
    else if(vdimgck.val() == "" || vdimgck.val() == 0){
      showMsg('请输入验证码');
      return false;
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
