$(function(){
	var zindex = 1000, showTip = function(obj, state, txt){
		var offset = obj.parent().offset(),
				objwid = obj.parent().width() + 15,
				left = offset.left + objwid + "px",
				top  = offset.top + "px",
				id   = obj.attr("id"),
				nid  = id+"_Tip";
		state == "error" ? obj.addClass("err") : "";
		$(".inptip").remove();
		$("body").append('<div id="'+nid+'" class="inptip '+state+'" style="left: '+left+'; top: '+top+'; z-index: '+zindex+'"><s></s><i></i><p>'+txt+'</p></div>');
		zindex++;
	};

	var verifyInput = function(t){
		var id = t.attr("id");
		t.removeClass("focus");
		if($.trim(t.val()) == ""){
			t.next("span").show();

			if(id == "npwd"){
				showTip(t, "error", "请输入新密码！");
			}else if(id == "npwd1"){
				showTip(t, "error", "请再输入一遍新密码！");
			}
			return false;

		}else{

			var passwordStrengthDiv = $("#passwordStrengthDiv").attr("class");

			if(id == "npwd" && (passwordStrengthDiv == "" || passwordStrengthDiv == undefined || Number(passwordStrengthDiv.replace("is", "")) < 50)){
				showTip(t, "error", "您输入的新密码太过简单，请重新输入！");
				return false;
			}else if(id == "npwd1" && $("#npwd").val() != t.val()){
				showTip(t, "error", "两次输入的密码不一致，请重新输入！");
				return false;
			}else{
				t.removeClass("err");
			}
		}
		return true;
	};

	$("#npwd").passwordStrength();


	//表单占位符
	$(".form-horizontal li span").bind("click", function(){
		var t = $(this);
		t.hide();
		t.prev("input").focus();
	});

	//表单聚焦时状态
	$(".form-horizontal li input").bind("focus", function(){
		var t = $(this), id = t.attr("id");
		t.next("span").hide();
		t.removeClass("error").addClass("focus");
		$(".inptip").remove();
	});

	//表单失去焦点时状态
	$(".form-horizontal li input").bind("blur", function(){
		verifyInput($(this));
	});


	//回车提交
	$(".form-horizontal input").keyup(function (e) {
		if (!e) {
			var e = window.event;
		}
		if (e.keyCode) {
			code = e.keyCode;
		}else if (e.which) {
			code = e.which;
		}
		if (code === 13) {
			$("#submitFpwd").click();
		}
	});

	//提交
	$("#submitFpwd").bind("click", function(){
		var t = $(this), tj = true;

		if(t.hasClass("disabled")) return false;

		$(".form-horizontal li input").each(function(){
			if(!verifyInput($(this))){
				tj = false;
				return false;
			}
		});

		if(!tj) return false;

		t.addClass("disabled").html("请稍候...");

		//异步提交
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=member&action=resetpwd",
			data: $(".form-horizontal").serialize(),
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data){

					if(data.state == 100){

						t.html("密码重置成功！");
						setTimeout(function(){
							location.href = userDomain;
						}, 500);

					}else{
						alert(data.info);
						t.removeClass("disabled").html("确认");
					}

				}else{
					alert("提交失败，请重试！");
					t.removeClass("disabled").html("确认");
				}
			}
		});
		return false;

	});

	particlesJS('particles-js',{particles:{number:{value:20,density:{enable:!0,value_area:1E3}},color:{value:"#e1e1e1"},shape:{type:"circle",stroke:{width:0,color:"#000000"},polygon:{nb_sides:5},image:{src:"img/github.svg",width:100,height:100}},opacity:{value:.8,random:!1,anim:{enable:!1,speed:1,opacity_min:.1,sync:!1}},size:{value:15,random:!0,anim:{enable:!1,speed:180,size_min:.1,sync:!1}},line_linked:{enable:!0,distance:650,color:"#cfcfcf",opacity:.26,width:1},move:{enable:!0,speed:2,direction:"none",random:!0,straight:!1,out_mode:"out",bounce:!1,attract:{enable:!1,rotateX:600,rotateY:1200}}},interactivity:{detect_on:"canvas",events:{onhover:{enable:!1,mode:"repulse"},onclick:{enable:!1,mode:"push"},resize:!0},modes:{grab:{distance:400,line_linked:{opacity:1}},bubble:{distance:400,size:40,duration:2,opacity:8,speed:3},repulse:{distance:200,duration:.4},push:{particles_nb:4},remove:{particles_nb:2}}},retina_detect:!0});
});
