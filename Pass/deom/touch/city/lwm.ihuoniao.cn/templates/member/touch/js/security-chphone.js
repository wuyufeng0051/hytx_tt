$(function(){

	var verifyFunc = verifyType = verifyData = opera = returnUrl = null;

	$('.tab li').click(function(){
		var t = $(this);
		t.addClass('curr').siblings('li').removeClass('curr');
	})

	//绑定手机
	$("#chphone").bind("click", function(){
		var phone = $("#phone"), vdimgck = $("#vdimgck"), btn = $(this);
		if($.trim(phone.val()) == "" || !checkPhone(phone.val())){
			showMsg("请输入正确的手机号码", "error");
			phone.focus();
			return "false";
		}
		if($.trim(vdimgck.val()) == ""){
			showMsg("请输入6位短信验证码", "error");
			vdimgck.focus();
			return "false";
		}

		var param = "phone="+phone.val()+"&vdimgck="+vdimgck.val();
		modifyFun(btn,'立即认证','chphone',param);
	});


	//修改手机号码或邮箱
	$("#chPhoneEdit").bind("click", function(){
		opera = 'changePhone';
		authentication(bindPhoneUrl);
	});

	//解绑手机号码
	$("#chphoneDel").bind("click", function(){
		opera = "changePhone";
		authentication(bindPhoneUrl);
	});


	//绑定邮箱
	var memeryEmailData = "";
	$("#chemail").bind("click", function(){
		var email = $("#email"), btn = $(this);

		if($.trim(email.val()) == "" || !checkEmail(email.val())){
			showMsg("请输入正确的邮箱地址", "error");
			email.focus();
			return "false";
		}
			var param = "email="+email.val();
			memeryEmailData = param;

		modifyFun(btn,'下一步','chemail',param);

	});

	//修改邮箱
	$("#chEmailEdit").bind("click", function(){
		opera = "changeEmail";
		authentication(bindEmailUrl);
	});

	//解绑邮箱
	$("#chEmailDel").bind("click", function(){
		opera = "changeEmail";
		authentication(bindEmailUrl);
	});


	// 安全保护问题 --------- s
	$('.q1').change(function(){
		var val = $(this).val();
		$("#q1").val(val);
	})
	$('.q2').change(function(){
		var val = $(this).val();
		$("#q2").val(val);
	})


	//设置安全保护问题
	$("#question").bind("click", function(){

		var q1 = $("#q1"), q2 = $("#q2"), answer = $("#answer"), btn = $(this);
		if($.trim(q1.val()) == ""){
			showMsg("请选择您的问题一", "error");
			return "false";
		}
		if($.trim(q2.val()) == ""){
			showMsg("请选择您的问题二", "error");
			return "false";
		}
		if($.trim(answer.val()) == ""){
			showMsg("请输入您的问题答案", "error");
			answer.focus();
			return "false";
		}

		var q1 = $("#q1"), q2 = $("#q2"), answer = $("#answer");
		param = "q1="+q1.val()+"&q2="+q2.val()+"&answer="+answer.val();
		modifyFun(btn,'确定提交','question',param);

	});

	//修改安全保护问题
	$("#chQuestionEdit").bind("click", function(){
		opera = "changeQuestion";
		authentication(bindQuestionUrl);
	});

	//重置安全保护问题
	$("#chQuestionDel").bind("click", function(){
		opera = "changeQuestion";
		authentication(pageUrl);
	});
	// -------------------------

  //获取短信验证码
  $("html").delegate("#getPhoneVerify", "click", function(){
    var t = $(this), phone = $("#phone");

    if(t.hasClass("disabled")) return false;

    if(!checkPhone(phone.val())){
    	showMsg("请输入正确的手机号码", "error");
    	phone.focus();
    }else{

    	t.addClass("disabled");
    	t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

    	$.ajax({
        	url: masterDomain+"/include/ajax.php?service=siteConfig&action=getPhoneVerify&type=verify",
        	data: "phone="+phone.val(),
        	type: "POST",
        	dataType: "jsonp",
       		success: function (data) {
	        	//获取成功
	        	if(data && data.state == 100){
	            	countDown(t);

	        	//获取失败
	        	}else{
	            	t.removeClass("disabled").html("获取短信验证码");
	            	showMsg(data.info, "error");
	            	$('.edit-tip').text(data.info);
	        	}
        	}
      	});

      $("#vdimgck").focus();
    }
  });



	//短信验证
	$("html").delegate("#getPhoneAuthVerify", "click", function(){
		var t = $(this);

		if(t.hasClass("disabled")) return false;
		t.addClass("disabled");
		t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

		$('.edit-tip').text("请输入短信验证码，没收到短信？      1. 网络通讯异常可能会造成短信丢失，请重新获取或稍后再试      2. 请核实手机是否已欠费停机，或者屏蔽了系统短信", "");

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
					$('.edit-tip').text(data.info, "error");
					showMsg(data.info);
				}
			}
		});

		$("#vdimgck").focus();
	});

	//邮箱验证
	$("html").delegate("#getEmailAuthVerify", "click", function(){
		var t = $(this);

		if(t.hasClass("disabled")) return false;
		t.addClass("disabled");
		t.html('<img src="'+staticPath+'images/loading_16.gif" /> 获取中...');

		$('.edit-tip').text("请输入邮箱验证码，没有收到邮件？      请先检查是否在垃圾邮件中，或者稍候再次发送！", "");

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=siteConfig&action=getEmailVerify&type=auth",
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				//获取成功
				if(data && data.state == 100){
					countDown(t);

				//获取失败
				}else{
					t.removeClass("disabled").html("获取短信验证码");
					$('.edit-tip').text(data.info, "error");
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
			$('.edit-tip').text("请先进行【手机认证、邮箱认证、安全保护问题】   这三项其中一项的绑定/启用才可以进行重置！    或者直接进行 <a href='#' target='_blank' style='color:#08f;'><u>申诉</u></a> 找回！");
		}
	}

	//异步提交修改
	function authVerifyFun(){
		if(verifyFunc == null){
			showMsg('请选择验证方式');
			return;
		}
	    if(verifyFunc() == "false") return false;

	    $.ajax({
	      url: masterDomain+"/include/ajax.php?service=member&action=authentication&do="+verifyType+"&opera="+opera,
	      data: verifyData(),
	      type: "POST",
	      dataType: "jsonp",
	      success: function (data) {
	        if(data && data.state == 100){

	          showMsg(data.info, "success");
	          setTimeout(function(){
	            location.href = returnUrl;
	          }, 1000);

	        }else{
	          showMsg(data.info, "error");

	        }
	      }
	    });
	}

    //确定身份验证方式
  	$('.checkway').change(function(){
  		var t = $(this), val = t.val();
  		$(".authlist .item").hide();
  		$(".authlist .item"+val).show();

  		//短信验证
  		if(val == 0){

  			verifyType = "authPhone";

  			//验证脚本
  			verifyFunc = function(){
  				var vdimgck = $("#vdimgck");
  				if(vdimgck.val() == ""){
  					showMsg("请输入6位短信验证码", "error");
  					vdimgck.focus();
  					return "false";
  				}
  			};

  			//传送数据
  			verifyData = function(){
  				return "vdimgck="+$("#vdimgck").val();
  			};

  		//邮箱验证
      }else if(val == 1){

  			verifyType = "authEmail";

  			//验证脚本
  			verifyFunc = function(){
  				var vdimgck = $("#vdimgckEmail");
  				if(vdimgck.val() == ""){
  					showMsg("请输入6位邮箱验证码", "error");
  					vdimgck.focus();
  					return "false";
  				}
  			};

  			//传送数据
  			verifyData = function(){
  				return "vdimgck="+$("#vdimgckEmail").val();
  			};

  		//安全保护问题
      }else if(val == 2){

  			verifyType = "authQuestion";

  			//验证脚本
  			verifyFunc = function(){
  				var answer = $("#answer");
  				if(answer.val() == ""){
  					showMsg("请输入您的密保答案！", "error");
  					answer.focus();
  					return "false";
  				}
  			};

  			//传送数据
  			verifyData = function(){
  				return "answer="+$("#answer").val();
  			};

  		}

  	});




})



//判断手机号码
function checkPhone(num){
	var exp = new RegExp("^1[34578]{1}[0-9]{9}$", "img");
	if(!exp.test(num)){
		return false;
	}
	return true;
}


//判断邮箱
function checkEmail(num){
	if(!/\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/.test(num)){
		return false;
	}
	return true;
}



// 错误提示
function showMsg(str){
  var o = $(".error");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}

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
      	if(type == 'chemail'){
      		alert(data.info+"\n没有收到邮件？请点击重新发送或更换邮箱");
      		btn.removeClass('disabled').html('重新发送');
      		return;
      	}
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