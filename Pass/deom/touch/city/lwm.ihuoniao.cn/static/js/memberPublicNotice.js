$(function(){

    //引入样式
    var css = document.getElementsByTagName('head')[0].appendChild(document.createElement('link'));
    css.href = masterDomain + '/static/css/memberPublicNotice.css?v=' + ~(-new Date());
    css.rel = "stylesheet";
    css.type = "text/css";

    //公共样式名
    var notice = "hn_memberPublicNotice",
        header = "hn_memberPublicNotice_header",
        up     = "hn_memberPublicNotice_up",
        down   = "hn_memberPublicNotice_down",
        close  = "hn_memberPublicNotice_close",
        body   = "hn_memberPublicNotice_body",
        title  = "hn_memberPublicNotice_title",
        time   = "hn_memberPublicNotice_time",
        yes    = "hn_memberPublicNotice_yes";

    var timer, audio, step = 0, _title = document.title;
    var cookieNoticeHide = $.cookie("HN_memberPublicNotice_hide");

	//消息通知音频
	if(window.HTMLAudioElement){
		audio = new Audio();
		audio.src = "/static/audio/notice01.mp3";
	}

    var noticeInit = {

        //获取未读消息
        getNotice: function(){
            $.ajax({
    			url: "/include/ajax.php?service=member&action=message&state=0&pageSize=100",
    			type: "GET",
    			dataType: "jsonp",
    			success: function (d) {
                    if(d.state == 100){
                        noticeInit.splicNotice(d.info);
                    }
    			}
    		});
        }

        //拼接消息浮动层
        ,splicNotice: function(data){
            var list = data.list, pageinfo = data.pageInfo, html = [];
            for (var i = 0; i < list.length; i++) {
                html.push('<li data-id="' + list[i].id + '">');
                html.push('<p class="' + title + '"><a href="' + list[i].url + '" target="_blank" title="' + list[i].title + '">' + list[i].title + '</a></p>');
                html.push('<p class="' + time + '">' + list[i].date + '</p>');
                html.push('<button class="' + yes + '" title="已读"></button>');
                html.push('</li>');
            }

            //如果有消息列表
            if(html.length > 0){

                //验证浮动层是否已经创建
                if($("." + notice).size() == 0){
                    var noticeHtml = [];
                    noticeHtml.push('<div class="' + notice + '">');
                    noticeHtml.push('<div class="' + header + '">');
                    noticeHtml.push('<h3>消息通知(<span>' + pageinfo.unread + '</span>)</h3>');
                    if(cookieNoticeHide == 1){
                        noticeHtml.push('<button class="' + up + '" title="展开消息通知"></button>');
                    }else{
                        noticeHtml.push('<button class="' + down + '" title="收起消息通知"></button>');
                    }
                    noticeHtml.push('<button class="' + close + '" title="关闭消息通知"></button>');
                    noticeHtml.push('</div>');
                    if(cookieNoticeHide == 1){
                        noticeHtml.push('<div class="' + body + '" style="display: none;">');
                    }else{
                        noticeHtml.push('<div class="' + body + '">');
                    }
                    noticeHtml.push('<ul>');
                    noticeHtml.push('</ul>');
                    noticeHtml.push('</div>');
                    noticeHtml.push('</div>');
                    $("body").append(noticeHtml.join(""));
                }else{
                    $("." + notice).find("h3 span").html(pageinfo.unread);
                }

                $("." + body).find("ul").html(html.join(""));
                $("." + body).scrollUnique();
                setTimeout(function(){
                    $("." + notice).show();
                }, 500);

            }
        }

        //获取是否有新消息
        ,getNewRemind: function(){
            $.ajax({
    			url: "/include/ajax.php?service=member&action=getNewNotice",
    			type: "GET",
    			dataType: "jsonp",
    			success: function (d) {
                    if(d.state == 100 && d.info > 0){

                        //标题闪动
    					timer = setInterval(function(){
    						step++;
    						if(step == 3) {step = 1};
    						if(step == 1) {document.title = '【　　　】-' + _title};
    						if(step == 2) {
    							document.title = '【新消息】-' + _title;
    						};
    					}, 500);

                        setTimeout(function(){
                            document.title = _title;
                            clearInterval(timer);
                        }, 8000);

    					//播放音频
    					audio.play();

                        //获取新列表
                        noticeInit.getNotice();

                        //清除未读消息
                        $.get("/include/ajax.php?service=member&action=clearNewNotice");

                    }
    			}
    		});
        }
    }

    //会员中心和手机版不需要显示
    var userid = typeof cookiePre == "undefined" ? null : $.cookie(cookiePre+"login_user");
    if(typeof(memberPage) == "undefined" && !navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i) && userid != null){

        //每隔5秒请求一次新消息通知
    	setInterval(function(){
            noticeInit.getNewRemind();
        }, 10000);

        //第一次请求
        noticeInit.getNotice();
    }

    //点击消息通知标题
    $("body").delegate("." + header + " h3", "click", function(){
        $("." + up + ", ." + down).click();
    });

    //收起消息通知
    $("body").delegate("." + down, "click", function(){
        $.cookie("HN_memberPublicNotice_hide", 1);
        $(this).removeClass().addClass(up).attr("title", "展开消息通知");
        $("." + body).stop().slideUp();
    });

    //展开消息通知
    $("body").delegate("." + up, "click", function(){
        $.cookie("HN_memberPublicNotice_hide", 0);
        $(this).removeClass().addClass(down).attr("title", "收起消息通知");
        $("." + body).slideDown();
    });

    //关闭消息通知
    $("body").delegate("." + close, "click", function(){
        $("." + notice).stop().slideUp(250, function(){
            $(this).remove();
        });
    });

    //点击链接
    $("body").delegate("." + body + " a", "click", function(){
        var t = $(this);
        t.closest("li").slideUp(150, function(){
            $(this).remove();

            //总数减一
            $("." + header).find("h3 span").html(Number($("." + header).find("h3 span").html()) - 1);

            //如果消息列表为空，删除消息通知浮动层
            if($("." + body).find("li").length == 0){
                $("." + notice).stop().slideUp(250, function(){
                    $(this).remove();
                });
            }
        });
    });

    //已读
    $("body").delegate("." + yes, "click", function(){
        var t = $(this), id = t.closest("li").attr("data-id");
        t.closest("li").slideUp(150, function(){
            $(this).remove();

            $.get("/include/ajax.php?service=member&action=setMessageRead&id="+id);

            //总数减一
            $("." + header).find("h3 span").html(Number($("." + header).find("h3 span").html()) - 1);

            //如果消息列表为空，删除消息通知浮动层
            if($("." + body).find("li").length == 0){
                $("." + notice).stop().slideUp(250, function(){
                    $(this).remove();
                });
            }
        });
    });

});
