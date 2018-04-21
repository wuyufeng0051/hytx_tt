$(function(){

  //第三方登录
  $("body").delegate(".loginconnect", "click", function(e){
		e.preventDefault();
		var href = $(this).attr("href"), type = href.split("type=")[1];
		loginWindow = window.open(href, 'oauthLogin', 'height=565, width=720, left=100, top=100, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes');

		//判断窗口是否关闭
		mtimer = setInterval(function(){
			if(loginWindow.closed){
				$.cookie(cookiePre+"connect_uid", null, {expires: -10, domain: masterDomain.replace("http://www", ""), path: '/'});
				clearInterval(mtimer);
				huoniao.checkLogin(function(){
					location.reload();
				});
			}else{
				if($.cookie(cookiePre+"connect_uid") && $.cookie(cookiePre+"connect_code") == type){
					loginWindow.close();
					var modal = '<div id="loginconnectInfo"><div class="mask"></div> <div class="layer"> <p class="layer-tit"><span>温馨提示</span></p> <p class="layer-con">为了您的账户安全，请绑定您的手机号<br /><em class="layer_time">3</em>s后自动跳转</p> <p class="layer-btn"><a href="'+masterDomain+'/bindMobile.html?type='+type+'">前往绑定</a></p> </div></div>';

					$("#loginconnectInfo").remove();
					$('body').append(modal);

					var t = 3;
					var timer = setInterval(function(){
						if(t == 1){
							clearTimeout(timer);
							location.href = masterDomain+'/bindMobile.html?type='+type;
						}else{
							$(".layer_time").text(--t);
						}
					},1000)
				}
			}
		}, 1000);

	});


  // 搜索
  $(".HouseSeacher_btn").bind("click", function(){
      var keywords = $("#HouseSearch"), txt = $.trim(keywords.val()),
          type = $('.MooudleBC').attr('data-type');
      if(txt != ""){
              location.href = masterDomain +"/house/"+type+".html?keywords="+txt;
      }else{
          keywords.focus();
      }
  });
  $(".JobSeacher_btn").bind("click", function(){
      var keywords = $("#JobSearch"), txt = $.trim(keywords.val()),
          type = $('.MooudleBC').attr('data-type');
      if(txt != ""){
              location.href = masterDomain +"/job/"+type+".html?title="+txt;
      }else{
          keywords.focus();
      }
  });
  $('.ModuleBox a').click(function(){
      var index = $(this).index();
      if ($(this).attr("data-id") == "0") {
          $('.FormBox .form').eq(index).show().siblings().hide();
      }
  })
  $(".MoudleNav ul li").click(function(){
      var index = $(this).closest('a').index();
      $(".MoudleNav ul li").removeClass('MooudleBC');
      $(this).addClass('MooudleBC');
      $('.FormBox .form').eq(index).show().siblings().hide();
      $('.keytype').text($(this).text());
  })
  $('.search dl').hover(function(){
      var a = $(this);
      a.addClass('hover');
      a.find('dd .curr').addClass('active').siblings().removeClass();
  },function(){
      $(this).removeClass('hover');
  }).find('dd a').click(function(){
      var a = $(this);
      if (a.attr("data-id") == "0") {
          $('.keytype').text(a.find('span').text());
          a.addClass('active curr').siblings().removeClass();
          $('.search dl').removeClass('hover');
      }
  }).hover(function(){
      var a = $(this);
      a.addClass('active').siblings().removeClass('active');
  })

  $('.searchkey1').focus(function(){
      $('.hotkey').addClass('leave').stop().animate({
          'right' : '-400px'
      },500);
  }).blur(function(){
      $('.hotkey').removeClass('leave').stop().animate({
          'right' : '15px'
      },500);
  })

  //鼠标经过头部链接显示浮动菜单
	$(".topbarlink li").hover(function(){
		var t = $(this), pop = t.find(".pop");
		pop.show();
		t.addClass("hover");
	}, function(){
		var t = $(this), pop = t.find(".pop");
		pop.hide();
		t.removeClass("hover");
	});

	//切换导航颜色
	$(".changeSkin").colorPicker({
		callback: function(color) {
			var color = color.length === 7 ? color : '';
			changeSkin(color);
		}
	});

	var navbarSkin = $.cookie("navbarSkin");
	if(navbarSkin != null && navbarSkin != ""){
		changeSkin(navbarSkin);
	}

	function changeSkin(color){
		$(".searchwrap, .nav, .mainnav li dd").css({"background": color});
		$(".search .type dd").css({"border-color": color});

		var rgbaVal = "";
		if(color != ""){
			rgbcolor = color.replace("#", "");
			rgbcolor = rgbcolor.toLowerCase();
			var rgba = new Array();
			for(x = 0; x < 3; x++){
				rgba[0] = rgbcolor.substr(x * 2, 2);
				rgba[3] = "0123456789abcdef";
				rgba[1] = rgba[0].substr(0,1);
				rgba[2] = rgba[0].substr(1,1);
				rgba[20 + x] = rgba[3].indexOf(rgba[1]) * 16 + rgba[3].indexOf(rgba[2]);
			}
			rgbaVal = "rgba("+rgba[20]+", "+rgba[21]+", "+rgba[22]+", .95)";
		}
		$(".mainnav li dd").css({"background": rgbaVal});

		var style = '<style id="changeSkinStyle">.search .type dd a.active, .search .type dd a:hover{background:'+color+';}.mainnav li.mainnav li dd, .hover .dropbox, .mainnav li:hover, .mainnav li:hover .dropbox, .search .hotkey a:hover, .search .submit:hover{background:'+color+';background:rgba('+rgbaVal+');}';

		$("#changeSkinStyle").remove();
		$("head").append(style);

		$.cookie("navbarSkin", color, {expires: 365, domain: masterDomain.replace("http://", ""), path: '/'});
	}


})

//单点登录执行脚本
function ssoLogin(info){

	$("#navLoginBefore, #navLoginAfter").remove();

	//已登录
	if(info){
		$(".loginbox").prepend('<div class="loginafter fn-clear"><span class="fn-left">欢迎您回来，</span><a href="'+info['userDomain']+'" target="_blank">'+info['nickname']+'</a><a href="'+masterDomain+'/logout.html" class="logout">退出</a></div>');

		$.cookie(cookiePre+'login_user', info['uid'], {expires: 365, domain: channelDomain.replace("http://", ""), path: '/'});

	//未登录
	}else{
		$(".loginbox").prepend('<div class="loginbefore fn-clear"><a href="'+masterDomain+'/register.html" class="regist">免费注册</a><span class="logint"><a href="'+masterDomain+'/login.html">请登录</a></span><a class="loginconnect" href="'+masterDomain+'/api/login.php?type=qq" target="_blank"><i class="picon picon-qq"></i>QQ登陆</a><a  class="loginconnect"href="'+masterDomain+'/api/login.php?type=wechat" target="_blank"><i class="picon picon-weixin"></i>微信登陆</a><a class="loginconnect" href="'+masterDomain+'/api/login.php?type=sina" target="_blank"><i class="picon picon-weibo"></i>新浪登陆</a></div>');

		$.cookie(cookiePre+'login_user', null, {expires: -10, domain: channelDomain.replace("http://", ""), path: '/'});

	}

}
