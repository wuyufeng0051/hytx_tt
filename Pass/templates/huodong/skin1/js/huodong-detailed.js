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


	// 收费类型
	$('.crtxt-1 span').click(function(){
		var i = $(this);
		if (i.hasClass('select')) {
			i.removeClass('select');
		}else{
			i.addClass('select');
			i.siblings("span").removeClass("select");
		}
	})


	//报名&取消报名
	$(".baoming a").bind("click", function(){
		var t = $(this), fid = $(".crtxt-1 .select").data("id");

		//验证登录
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}

		if(!t.hasClass("loading")){


			//取消报名
			if(t.hasClass("cancel")){

				if(confirm("确认取消报名吗？")){
					t.addClass("loading");
					$.ajax({
						url: masterDomain+"/include/ajax.php?service=huodong&action=cancelJoin&id="+id,
						type: "GET",
						dataType: "jsonp",
						success: function (data) {
							if(data && data.state == 100){
								alert(data.info);
								location.reload();
							}else{
								alert(data.info);
								t.removeClass("loading");
							}
						},
						error: function(){
							alert("网络错误，操作失败，请稍候重试！");
							t.removeClass("loading");
						}
					});
				}
				return false;

			}


			if(feetype == 1 && (fid == undefined || fid == 0 || fid == "")){
				alert("请选择收费项");
				return false;
			}

			t.addClass("loading");
			$.ajax({
				url: masterDomain+"/include/ajax.php?service=huodong&action=join&id="+id+"&fid="+fid,
				type: "GET",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){
						if(feetype == 1 && data.info != "报名成功！"){
							location.href = data.info;
						}else{
							alert("报名成功！");
							location.reload();
						}
					}else{
						alert(data.info);
						t.removeClass("loading");
					}
				},
				error: function(){
					alert("网络错误，报名失败，请稍候重试！");
					t.removeClass("loading");
				}
			});

		}
	});


	// 用户讨论
	$('.featur-lead p').click(function(){
		var k = $(this);
		var index = k.index();
		$('.xuanze .tt').eq(index).show();
		$('.xuanze .tt').eq(index).siblings().hide();
		k.addClass('fea-bc');
		k.siblings('p').removeClass('fea-bc');
	})

	// 导航栏置顶
	var Ggoffset = $('.list-lead').offset().top;
	$(window).bind("scroll",function(){
		var d = $(document).scrollTop();
		if(Ggoffset < d){
				$('.list-lead').addClass('fixed');
		}else{
			$('.list-lead').removeClass('fixed');
		}
	});

	var isClick = 0;
	//左侧导航点击
	$(".list-lead a").bind("click", function(){
		isClick = 1; //关闭滚动监听
		var t = $(this), parent = t.parent(), index = parent.index(), theadTop = $(".con-tit:eq("+index+")").offset().top - 40;
		parent.addClass("current").siblings("li").removeClass("current");
		$('html, body').animate({
         	scrollTop: theadTop
     	}, 300, function(){
     		isClick = 0; //开启滚动监听
     	});
	});

	//滚动监听
	$(window).scroll(function() {
		if(isClick) return false;
	    var scroH = $(this).scrollTop();
	    var theadLength = $(".con-tit").length;
	    $(".list-lead li").removeClass("current");

	    $(".con-tit").each(function(index, element) {
	        var offsetTop = $(this).offset().top;
	        if (index != theadLength - 1) {
	            var offsetNextTop = $(".con-tit:eq(" + (index + 1) + ")").offset().top - 40;
	            if (scroH < offsetNextTop) {
	                $(".list-lead li:eq(" + index + ")").addClass("current");
	                return false;
	            }
	        } else {
	            $(".list-lead li:last").addClass("current");
	            return false;
	        }
	    });
	});

	//收藏
	$('.shoucang .gt').click(function(){

		var t = $(this), type = "add";
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}

		if(t.hasClass("gy")){
			type = "del";
			t.removeClass("gy").find("span").html("收藏");
		}else{
			t.addClass("gy").find("span").html("已收藏");
		}
		$.post("/include/ajax.php?service=member&action=collect&module=huodong&temp=detail&type="+type+"&id="+id);
	});


	//发表评论
	var rid = 0, uid = 0; uname = "";
	$("#rtj").bind("click", function(){
		var t = $(this), content = $(".writ textarea");
		rid = 0;
		sendReply(t, content);
	});

	var businessUrl = $("#replyList").data("url");

	function sendReply(t, content){
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}

		if(!t.hasClass("disabled") && $.trim(content.val()) != ""){
			t.addClass("disabled");

			$.ajax({
				url: "/include/ajax.php?service=huodong&action=sendReply",
				data: "hid="+id+"&rid="+rid+"&content="+encodeURIComponent(content.val()),
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){

						var info = data.info;
						content.val("");

						//一级评论
						if(rid == 0){
							if($("#replyList ul").size() == 0){
								$("#replyList").html('<ul></ul>');
							}
							$("#replyList ul").prepend('<li data-id="'+info.aid+'" data-uid="'+info.id+'" data-name="'+info.nickname+'"><p><a href="'+(businessUrl.replace("%id", info.id))+'" target="_blank"><img onerror="javascript:this.src=\''+staticPath+'images/noPhoto_40.jpg\';" src="'+info.photo+'"></a></p><div class="wr-name"><span><a href="'+(businessUrl.replace("%id", info.id))+'" target="_blank">'+info.nickname+'</a>：</span><div class="wr-da"><em>'+info.pubdate+'</em><b><a href="javascript:;">回复</a></b></div></div><div class="wr-txt">'+info.content+'</div></li>');

						//子级评论
						}else{
							var par = t.closest("li");
							t.closest(".writ-reply").remove();
							par.after('<li class="writ-repeat" data-id="'+info.aid+'" data-uid="'+info.id+'" data-name="'+info.nickname+'"><p><a href="'+(businessUrl.replace("%id", info.id))+'" target="_blank"><img onerror="javascript:this.src=\''+staticPath+'images/noPhoto_40.jpg\';" src="'+info.photo+'"></a></p><div class="wr-name"><span><a href="'+(businessUrl.replace("%id", info.id))+'" target="_blank">'+info.nickname+'</a>&nbsp;回复&nbsp;<a href="'+(businessUrl.replace("%id", uid))+'" target="_blank">'+uname+'</a>：</span><div class="wr-da"><em>'+info.pubdate+'</em><b><a href="javascript:;">回复</a></b></div></div><div class="wr-txt">'+info.content+'</div></li>');
						}


						t.removeClass("disabled");

					}else{
						alert(data.info);
						t.removeClass("disabled");
					}
				},
				error: function(){
					alert("网络错误，发表失败，请稍候重试！");
					t.removeClass("disabled");
				}
			});
		}
	}


	//获取评论
	var atpage = 1;
	function getReplyList(){
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=huodong&action=reply&hid="+id+"&page="+atpage+"&pageSize=5",
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];
					for(var i = 0; i < list.length; i++){
						var src = staticPath+'images/noPhoto_100.jpg';
						if(list[i].member.photo){
							src = huoniao.changeFileSize(list[i].member.photo, "middle");
						}
						html.push('<li data-id="'+list[i].id+'" data-uid="'+list[i].uid+'" data-name="'+list[i].member.nickname+'"><p><a href="'+(businessUrl.replace("%id", list[i].uid))+'" target="_blank"><img onerror="javascript:this.src=\''+staticPath+'images/noPhoto_40.jpg\';" src="'+src+'" /></a></p><div class="wr-name"><span><a href="'+(businessUrl.replace("%id", list[i].uid))+'" target="_blank">'+list[i].member.nickname+'</a>：</span><div class="wr-da"><em>'+list[i].floortime+'</em><b><a href="javascript:;">回复</a></b></div></div><div class="wr-txt">'+list[i].content+'</div></li>');

						if(list[i].lower != null){
							html.push(getLowerReply(list[i].lower, list[i].member));
						}
					}

					if($("#replyList ul").size() == 0){
						$("#replyList").html('<ul>'+html.join("")+'</ul>');
					}else{
						$("#replyList ul").append(html.join(""));
					}

					if(atpage < pageInfo.totalPage){
						$("#replyList").append('<div class="more"><a href="javascript:;"><span>展开更多评论</span></a></div>');
					}
				}else{
					if(atpage == 1){
						$("#replyList").html('<div class="loading">暂无评论！</div>');
					}
				}
			}
		});
	}

	//评论子级
	function getLowerReply(arr, member){
		if(arr){
			var html = [];
			for(var i = 0; i < arr.length; i++){
				var src = staticPath+'images/noPhoto_100.jpg';
				if(arr[i].member.photo){
					src = huoniao.changeFileSize(arr[i].member.photo, "middle");
				}
				html.push('<li class="writ-repeat" data-id="'+arr[i].id+'" data-uid="'+arr[i].uid+'" data-name="'+arr[i].member.nickname+'"><p><a href="'+(businessUrl.replace("%id", arr[i].uid))+'" target="_blank"><img onerror="javascript:this.src=\''+staticPath+'images/noPhoto_40.jpg\';" src="'+src+'" /></a></p><div class="wr-name"><span><a href="'+(businessUrl.replace("%id", arr[i].uid))+'" target="_blank">'+arr[i].member.nickname+'</a>&nbsp;回复&nbsp;<a href="'+(businessUrl.replace("%id", member.id))+'" target="_blank">'+member.nickname+'</a>：</span><div class="wr-da"><em>'+arr[i].floortime+'</em><b><a href="javascript:;">回复</a></b></div></div><div class="wr-txt">'+arr[i].content+'</div></li>');

				if(arr[i].lower != null){
					html.push(getLowerReply(arr[i].lower, arr[i].member));
				}
			}
			return html.join("");
		}
	}

	//加载评论
	getReplyList();


	//加载更多评论
	$("#replyList").delegate(".more", "click", function(){
		atpage++;
		$(this).remove();
		getReplyList();
	});

	//回复评论
	$("#replyList").delegate(".wr-da b a", "click", function(){
		var t = $(this), li = t.closest("li");
		rid = li.attr("data-id");
		uid = li.attr("data-uid");
		uname = li.attr("data-name");
		if(li.find(".writ-reply").size() == 0){
			$("#replyList .writ-reply").remove();
			li.append('<div class="writ-reply"><textarea placeholder="回复'+uname+'："></textarea><button>回复</button></div>');
		}
	});

	//提交回复
	$("#replyList").delegate(".writ-reply button", "click", function(){
		var t = $(this), content = t.prev("textarea");
		sendReply(t, content);
	});




	// 分享
	window._bd_share_config = {"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
})

//单点登录执行脚本
function ssoLogin(info){

	$("#navLoginBefore, #navLoginAfter").remove();

	//已登录
	if(info){
		$(".loginbox").prepend('<div class="loginafter fn-clear" id="navLoginBefore"><span class="fn-left">欢迎您回来，</span><a href="'+info['userDomain']+'" target="_blank">'+info['nickname']+'</a><a href="'+masterDomain+'/logout.html" class="logout">退出</a></div>');
		$.cookie(cookiePre+'login_user', info['uid'], {expires: 365, domain: channelDomain.replace("http://", ""), path: '/'});

	//未登录
	}else{
		$(".loginbox").prepend('<div class="loginbefore fn-clear" id="navLoginAfter"><a href="'+masterDomain+'/register.html" class="regist">免费注册</a><span class="logint"><a href="'+masterDomain+'/login.html">请登录</a></span><a class="loginconnect" href="'+masterDomain+'/api/login.php?type=qq" target="_blank"><i class="picon picon-qq"></i>QQ登陆</a><a class="loginconnect" href="'+masterDomain+'/api/login.php?type=wechat" target="_blank"><i class="picon picon-weixin"></i>微信登陆</a><a class="loginconnect" href="'+masterDomain+'/api/login.php?type=sina" target="_blank"><i class="picon picon-weibo"></i>新浪登陆</a></div>');
		$.cookie(cookiePre+'login_user', null, {expires: -10, domain: channelDomain.replace("http://", ""), path: '/'});

	}

}
