$(function(){

  //设置支付密码
	$("#paypwdAdd").bind("click", function(){
		var pay1 = $("#pay1"), pay2 = $("#pay2"), passwordStrengthDiv = $("#passwordStrengthDiv").attr("class"), btn = $(this);
		if($.trim(pay1.val()) == ""){
			showMsg("请输入支付密码");
			pay1.focus();
			return "false";
		}
		if(passwordStrengthDiv == "" || passwordStrengthDiv == undefined || Number(passwordStrengthDiv.replace("is", "")) < 50){
			showMsg("您输入的新密码太过简单，请重新输入");
			pay1.focus();
			return "false";
		}
		if($.trim(pay2.val()) == ""){
			showMsg("请确认支付密码");
			pay2.focus();
			return "false";
		}
		if(pay1.val() != pay2.val()){
			showMsg("两次输入的密码不一致，请重新输入");
			pay2.focus();
			return "false";
		}

    var param = "pay1="+pay1.val()+"&pay2="+pay2.val();
    modifyFun(btn,'确定提交','paypwdAdd',param);

});

		$(".editForm #pay1").passwordStrength();


    $('.tab li').click(function(){
      var t = $(this), index = t.index(), editForm = $('.editForm');
      t.addClass('curr').siblings('li').removeClass('curr');
      editForm.hide().eq(index).show();
    })


  //修改支付密码
  $("#paypwdEdit").bind("click", function(){
    var old = $("#old"), newest = $("#new"), confirm = $("#confirm"), passwordStrengthDiv = $("#passwordStrengthDiv").attr("class"), btn = $(this);

    if(btn.hasClass('disabled')) return;

    if(old.val() == ""){
      showMsg("请输入原支付密码");
      old.focus();
      return "false";
    }
    if(newest.val() == ""){
      showMsg("请输入新的支付密码");
      newest.focus();
      return "false";
    }
    if(passwordStrengthDiv == "" || passwordStrengthDiv == undefined || Number(passwordStrengthDiv.replace("is", "")) < 50){
      showMsg("您输入的新密码太过简单，请重新输入");
      newest.focus();
      return "false";
    }
    if(confirm.val() == ""){
      showMsg("请确认支付密码");
      confirm.focus();
      return "false";
    }
    if(newest.val() != confirm.val()){
      showMsg("两次输入的密码不一致，请重新输入");
      confirm.focus();
      return "false";
    }

    var param = "old="+old.val()+"&new="+newest.val()+"&confirm="+confirm.val();
    modifyFun(btn,'确定提交','paypwdEdit',param);

  });

    $(".editForm #new").passwordStrength();

    //重置支付密码
  	$("#paypwdReset").bind("click", function(){
  		opera = "paypwd";
  		authentication(bindPaypwdUrl);
  	});

    $('.checkway').change(function(){
      var t = $(this), val = t.val();
      if (!val == "") {
        $('.authlist .item').hide();
        $('.authlist .item'+val).show();
      }else {
        $('.authlist .item').hide();
      }

    })

    //短信验证
    $("html").delegate("#getPhoneAuthVerify", "click", function(){
      var t = $(this);

      if(t.hasClass("disabled")) return false;
      t.addClass("disabled");
      t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

      $('.edit-tip').text("请输入短信验证码，没收到短信？     1. 网络通讯异常可能会造成短信丢失，请重新获取或稍后再试     2. 请核实手机是否已欠费停机，或者屏蔽了系统短信", "");

      $.ajax({
        url: masterDomain+"/include/ajax.php?service=siteConfig&action=getPhoneVerify&type=auth",
        type: "POST",
        dataType: "jsonp",
        success: function (data) {
          //获取成功
          if(data && data.state == 100){
            countDown(t);

          //获取失败
          }else{
            t.removeClass("disabled").html("获取短信验证码");
            showMsg(data.info);
          }
        }
      });

      $("#vdimgck").focus();
    });

    var wait = 60;
    function countDown(t) {
      if (wait == 0) {
        t.removeClass("disabled");
        t.html("重新获取验证码");
        wait = 60;
      } else {
        t.addClass("disabled");
        t.html(wait+" 秒后可重新获取");
        wait--;
        setTimeout(function() {
          countDown(t)
        }, 1000);
      }
    }



  	//验证身份信息
  	function authentication(url){
  		if(phoneCheck == 1 || emailCheck == 1 || questionSet == 1){

  			returnUrl = url;
  			authVerifyFun();
  			$(".ui_buttons").hide();

  		}else{
  			showMsg("请先进行【手机认证、邮箱认证、安全保护问题】<br />这三项其中一项的绑定/启用才可以进行重置！<br /><br />或者直接进行 <a href='#' target='_blank' style='color:#08f;'><u>申诉</u></a> 找回！");
  		}
  	}

  	//异步提交修改
  	function authVerifyFun(){
  		var button = [{
  					id: "okBtn",
  					name: "下一步",
  					callback: function(){

  						if(verifyFunc() == "false") return false;
  						var t = this;

  						t.button({
  							id:'okBtn',
  							name:'操作中...',
  							disabled: true
  						});

  						$.ajax({
  							url: masterDomain+"/include/ajax.php?service=member&action=authentication&do="+verifyType+"&opera="+opera,
  							data: verifyData(),
  							type: "POST",
  							dataType: "jsonp",
  							success: function (data) {
  								if(data && data.state == 100){
  									t.button({
  										id:'okBtn',
  										name:'操作成功',
  										disabled: true
  									});

  									showMsg(data.info, "success");
  									setTimeout(function(){
  										authVerifyPop.close();
  										location.href = returnUrl;
  									}, 1000);

  								}else{
  									showMsg(data.info, "error");
  									t.button({
  										id:'okBtn',
  										name: "下一步",
  										disabled: false
  									});
  								}
  							}
  						});

  						return false;
  					},
  					focus: true
  				}]
  	}


})

function modifyFun(btn, btnstr, type, param, func){
  var data = param == undefined ? '' : param;
  btn.addClass('disabled').text('正在提交...');
  $.ajax({
    url: masterDomain+"/include/ajax.php?service=member&action=updateAccount&do="+type,
    data: data,
    type: "POST",
    dataType: "jsonp",
    success: function (data) {
      if(data && data.state == 100){
        alert(data.info);
        location.href = pageUrl;
      }else{
        alert(data.info);
        btn.removeClass('disabled').text(btnstr);
      }
    },
    error: function(){
      alert('网络错误，请稍后重试！');
      btn.removeClass('disbaled').text(btnstr);
    }
  })
}


// 错误提示
function showMsg(str){
  var o = $(".error");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}
