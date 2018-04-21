$(function(){

  //导航
  $('.header-r .screen').click(function(){
    var nav = $('.nav'), t = $('.nav').css('display') == "none";
    if (t) {nav.show();}else{nav.hide();}
  })



  //下拉菜单
  $('.demo-test-select').scroller(
    $.extend({preset: 'select'})
  );

  //年月日
  $('.demo-test-date').scroller(
  	$.extend({preset: 'date', dateFormat: 'yyyy-mm-dd'})
  );


  // 选择区域
  var typeCon = $("#addrBox");
  function getSelTxt(sel,check){
    var id = sel.val();
    if((id == 0 || id == '') && check) return '';
    return sel.find('[value="'+id+'"]').text();
  }

  // 简历预览
  $('.look').click(function(){
    var t = $(this);
    var lookCon = $('.myresume');
    if($('#fileList .thumbnail').length > 0){
      var photo = $('#fileList .thumbnail img').attr('data-url');
      if(photo != undefined && photo != ''){
        lookCon.find('.photo').attr('src',photo);
      }
    }
    lookCon.find('.name').text($('#name').val());
    lookCon.find('.sex').text(getSelTxt($('#sex')));
    lookCon.find('.home').text($('#home').val());
    lookCon.find('.address').text($('#address').val());
    lookCon.find('.phone').text($('#phone').val());
    lookCon.find('.email').text($('#email').val());
    lookCon.find('.addr').text($('.gz-addr-seladdr p').text());
    lookCon.find('.nature').text(getSelTxt($('#nature')));
    lookCon.find('.type').text($('.gz-addr-type p').text());
    lookCon.find('.salary').text($('#salary').val());
    lookCon.find('.startwork').text(getSelTxt($('#startwork')));
    lookCon.find('.workyear').text($('#workyear').val());

    var html = [];
    $("#experience").find(".experience").each(function(){
      var t = $(this), company = $.trim(t.find(".company").val()), date1 = t.find(".date1 input").val(), date2 = t.find(".date2 input").val(), bumen = $.trim(t.find(".bumen").val()), zhiwei = $.trim(t.find(".zhiwei").val()), neirong = $.trim(t.find(".neirong").val());
      if(company != ""){
        html.push('<div class="experience"> <dl class="ritem"> <dt>公司名称</dt> <dd class="company">'+company+'</dd> </dl> <dl class="ritem"> <dt>在职时间</dt> <dd class="zztimes">'+date1+' 至 '+date2+'</dd> </dl> <dl class="ritem"> <dt>所在部门</dt> <dd class="bumen">'+bumen+'</dd> </dl> <dl class="ritem"> <dt>担任职位</dt> <dd class="zhiwei">'+zhiwei+'</dd> </dl> <dl class="ritem"> <dt>工作内容</dt> <dd class="neirong">'+neirong+'</dd> </dl> </div>');
      }
    });
    lookCon.find('.experienceCon').html(html.join(""));

    lookCon.find('.educational').text(getSelTxt($('#educational')));
    lookCon.find('.college').text($('#college').val());
    lookCon.find('.graduation').text($('#graduation').val());
    lookCon.find('.professional').text($('#professional').val());
    lookCon.find('.language').text($('#language').val());
    lookCon.find('.computer').text($('#computer').val());
    lookCon.find('.education').text($('#education').val());
    lookCon.find('.evaluation').text($('#evaluation').val());
    lookCon.find('.objective').text($('#objective').val());

    $('.myresume').addClass('show').animate({"left":"0"},100);

  })

  // 退出预览
  $('#lookback').click(function(){
    $('.myresume').animate({"left":"100%"},100);
    setTimeout(function(){
      $('.myresume').removeClass('show');
    }, 100)
  })



  // 工作经历
  var experienceHtml = '<div class="experience"><div class="ml4r"><dl class="inpbox"><dt><span><label for="company">公司名称</label></span></dt><dd><input type="text" class="inp company" placeholder="请填写公司名称" id="company"></dd></dl></div><div class="ml4r"><dl class="inpbox ex_date"><dt><span>工作时间</span></dt><dd><div data-role="fieldcontain" class="dom_select date1"><input autocomplete="off" class="demo-test-date" placeholder="2017-01-01"></div><font>至</font><div data-role="fieldcontain" class="dom_select date2"><input autocomplete="off" class="demo-test-date" placeholder="2017-01-01"></div></dd></dl></div><div class="ml4r"><dl class="inpbox"><dt><span>所在部门</span></dt><dd><input type="text" class="inp bumen" placeholder="请填写所在部门"></dd></dl></div><div class="ml4r"><dl class="inpbox"><dt><span>担任职位</span></dt><dd><input type="text" class="inp zhiwei" placeholder="请填写担任职位"></dd></dl></div><div class="mulinpbox mb4r"><p class="multit">工作内容</p><div class="mulcon"><textarea placeholder="请输入" class="textarea"></textarea></div></div><div class="exbtn"><a href="javascript:;" class="btn add">继续添加</a><a href="javascript:;" class="btn del">删除</a></div></div>';

  var experienceHtml1 = '<div class="exbtn exbtn1"> <a href="javascript:;" class="btn add">添加</a></div>';

  $(".list").delegate('.add', "click", function(){
    $('.exbtn1').remove();

    var date1 = new Date().getTime();
    var date2 = new Date().getTime() + 1;

		var newexperience = $(experienceHtml);
		newexperience.appendTo("#experience");
		// newexperience.slideDown(300);
    var sct = newexperience.offset().top;
    //年月日
    $('.demo-test-date').scroller(
      $.extend({preset: 'date', dateFormat: 'yyyy-mm-dd'})
    );

    $('html,body').animate({
      'scrollTop':sct
    },300)
	});

  // 删除工作经历
  $(".list").delegate('.del', "click", function(){
    var p = $(this).closest('.experience'), num = p.siblings('.experience').length;
    p.addClass('del-load');
    // 不加延时不能应用新加的class样式?
    setTimeout(function(){
      if(confirm('确定要删除吗？')){
        p.remove();
        if(num == 0){
          $('#experience').append(experienceHtml1);
        }
      }else{
        p.removeClass('del-load');
      }
    },100)
  });




  //提交发布
  $("#submit").bind("click", function(event){

    var form = $("#fabuForm"), action = form.attr("action"), url = form.attr("data-url"), tj = true;

    event.preventDefault();

    var t           = $(this),
        name        = $("#name"),
        birth       = $("#birth"),
        home        = $("#home"),
        address     = $("#address"),
        phone       = $("#phone"),
        email       = $("#email"),
        addr        = $("#addr"),
        type        = $("#type"),
        salary      = $("#salary"),
        startwork   = $("#startwork"),
        workyear    = $("#workyear"),
        educational = $("#educational"),
        error       = $(".error"),
        text        = error.find('p');

    if(t.hasClass("disabled")) return;

    if(name.val() == ""){
      showMsg('请输入您的姓名！');
      tj = false;
    }

    else if(birth.val() == ""){
      showMsg('请选择您的出生日期！');
      tj = false;
    }

    else if(home.val() == ""){
      showMsg('请输入您的户籍地址！');
      tj = false;
    }

    else if(address.val() == ""){
      showMsg('请输入您的现居地址！');
      tj = false;
      return false;
    }

    else if(phone.val() == ""){
      showMsg('请输入您的联系电话！');
      tj = false;
    }

    else if(!(/^1[34578]\d{9}$/.test(phone.val()))){
      showMsg('请输入正确的手机号码！');
      tj = false;
    }

    else if(email.val() == ""){
      showMsg('请输入您的邮箱！');
      tj = false;
    }

    else if(!/\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/.test(email.val())){
      showMsg('请输入正确的邮箱地址！');
      tj = false;
    }

    else if(addr.val() == "" || addr.val() == 0){
      showMsg('请选择您的意向工作地点！');
      tj = false;
		}

    else if(type.val() == "" || type.val() == 0){
      showMsg('请选择您的意向职位！');
      tj = false;
		}

		else if(salary.val() == ""){
      showMsg('请输入您的期望薪资！');
      tj = false;
		}

		else if(startwork.val() == "请选择" || startwork.val() == 0){
      showMsg('请选择到岗时间！');
      tj = false;
		}

		else if(workyear.val() == ""){
      showMsg('请输入您的工作年限！');
      tj = false;
		}

		else if(educational.val() == "请选择" || educational.val() == 0){
      showMsg('请选择您的最高学历！');
      tj = false;
		}

    if(!tj) return;

    var data = form.serialize();
    var imgli = $("#fileList li.thumbnail");
    if(imgli.length >= 1){
      var src = imgli.eq(0).find("img").attr("data-val");
      data += '&photo='+src;
    }

    var experience = [];
    $("#experience").find(".experience").each(function(){
      var t = $(this), company = $.trim(t.find(".company").val()), date1 = t.find(".date1 input").val(), date2 = t.find(".date2 input").val(), bumen = $.trim(t.find(".bumen").val()), zhiwei = $.trim(t.find(".zhiwei").val()), neirong = $.trim(t.find(".neirong").val());
      if(company != ""){
        experience.push(company+"$$"+date1+"$$"+date2+"$$"+bumen+"$$"+zhiwei+"$$"+neirong);
      }
    });

    data += "&experience=" + experience.join("|||||");

    $.ajax({
      url: action,
      data: data,
      type: "POST",
      dataType: "json",
      success: function (data) {
        if(data && data.state == 100){
          alert("保存成功");
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

  // 错误提示
  function showMsg(str){
    var o = $(".error");
    o.html('<p>'+str+'</p>').show();
    setTimeout(function(){o.hide()},1000);
  }

})
