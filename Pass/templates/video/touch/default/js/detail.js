$(function(){
    var atpage = 1;
    $('.gologin').click(function(){
        window.location.href = "/login.html";
    })
    //  选项卡
    $('.com-lead ul li').click(function(){
        var t = $(this), index = t.index();
        t.addClass('li-on').siblings('li').removeClass('li-on');
        $('.com-txt .com-1').eq(index).show().siblings().hide();
    })
    // 赞
    $('.zan span').click(function(){
        var  x = $(this);
        if (x.hasClass('zan-zz')) {
            x.removeClass('zan-zz');
        }else{
            x.addClass('zan-zz');
        }
    })
    $('.zan-2 span').click(function(){
        var  x = $(this);
        if (x.hasClass('zan-z1')) {
            x.removeClass('zan-z1');
        }else{
            x.addClass('zan-z1');
        }
    })
   // 收藏
    $('.sc span').click(function(){
        var  x = $(this);
        if (x.hasClass('sc-z1')) {
            x.removeClass('sc-z1');
        }else{
            x.addClass('sc-z1');
        }
    })
    // 评论文本输入
    $('.com-in .shuru').keyup(function(){
        var  x = $(this).text();
        if (x == "") {
            $(".infor-c span").removeClass('bf-1');
        }else{
            $(".infor-c span").addClass('bf-1');
        }
    })
    $('.pld-r .shuru').keyup(function(){
        var  x = $(this).text();
        if (x == "") {
            $(".pld-r p").removeClass('bf-1');
        }else{
            $(".pld-r p").addClass('bf-1');
        }
    })

    // // 分享
    // $('.zan p,.zf-3').click(function(){
    //     $('#shearBox').css('bottom','0');
    //     $('#shearBox .bg').css({'height':'100%','opacity':1});
    // })
    //
    // // 分享取消
    // $('#cancelShear').click(function(){
    //     closeShearBox();
    // })
    // $('#cancelcode').click(function(){
    //     closecodeBox();
    // })
    //
    // // 分享点击遮罩层
    // $('.shearBox .bg, .zhiyin .bg').click(function(){
    //     closeShearBox();
    //     closecodeBox();
    //     $('.zhiyin').hide();
    //     $('.zhiyin .bg').css({'height':'0','opacity':0});
    // })
    //
    // // 分享二维码
    // $('.jiathis_button_code').click(function(){
    //   $('#shearBox').css('bottom','-100%');
    //   $('#codeBox').css('bottom','0');
    //   var code = masterDomain+'/include/qrcode.php?data='+encodeURIComponent(window.location);
    //   $('#codeBox img').attr('src', code);
    // })
    //
    // // 分享右上角
    // $('.jiathis_button_tweixin, .jiathis_button_ttqq, .jiathis_button_comment').click(function(){
    //   closeShearBox();
    //   $('.zhiyin').show();
    //   $('.zhiyin .bg').css({'height':'100%','opacity':1});
    // })

    // 举报
    $('.jbr-lead p').click(function(){
      var t = $(this);
      $('.jb-right').removeClass('show').animate({"left":"100%"},200);
       $('body').removeClass('by');
    })
    $('.jb').click(function(){
      var t = $(this);
      $('.jb-right').addClass('show').animate({"left":"0"},200);
      $('body').addClass('by');
    })
    $('.jb-txt ul li').click(function(){
        var x = $(this);
         if (x.hasClass('duihao')) {
           x.removeClass('duihao');
        }else{
            x.addClass('duihao');
        }
    })
    // 评论页回复
    $('.nope-txt i').click(function(){
        var x = $(this).closest('.yepe').find('.repeat-box')
        if (x.css('display') == 'none'){
            x.show();
        }else{
            x.hide();
        }
    })
    $('.repeat-box span').click(function(){
        $('.repeat-box').hide();
    })
    // 发表成功
    $('.repeat-box span,.pld-r p').click(function(){
        var t = $(".succes");
        $('.succes').animate({"top":"0"},200).show();
        setTimeout(function(){$('.succes').hide()},1000);
    })
    // 文本框加高
    $('.pld-r .shuru').click(function(){
        var  u = $(this)
        u.addClass('hei');
    })
    $('.pld-r p').click(function(){
        var  u = $(this)
        u.removeClass('hei');
    })
    $(".pld-r .shuru").blur(function(){
        $(".shuru").removeClass('hei');
    });

    // 点赞，收藏提示
    $('.zan-2').click(function(){
      var x = $('.zan-2 span')
      var t = $(".zan-suss");
      var z = $('.zan-fult')
        if (x.hasClass('zan-z1')) {
            t.show();
            setTimeout(function(){$('.zan-suss').hide()},1000);
        }else{
            z.show();
            setTimeout(function(){$('.zan-fult').hide()},1000);
        }
    })
    $('.sc span').click(function(){
      var x = $('.sc span')
      var t = $(".sc-suss");
      var z = $('.sc-fult')
        if (x.hasClass('sc-z1')) {
            t.show();
            setTimeout(function(){$('.sc-suss').hide()},1000);
        }else{
            z.show();
            setTimeout(function(){$('.sc-fult').hide()},1000);
        }
    })


    function closeShearBox(){
        $('#shearBox').css('bottom','-100%');
        $('#shearBox .bg').css({'height':'0','opacity':0});
    }
    function closecodeBox(){
        $('#codeBox').css('bottom','-100%');
        $('.shearBox .bg').css({'height':'0','opacity':0});
    }

    var commentObj = $('#commentObj');
    //提交评论回复
    $(".comment").delegate(".subtn", "click", function(){
        var t = $(this), id = 0;
        if(t.hasClass("load")) return false;

        var contentObj = $(".shuru"),
            content = contentObj.html();

        if(content == ""){
            return false;
        }
        if(huoniao.getStrLength(content) > 200){
            alert("超过200个字了！");
        }

        t.addClass("load");

        $.ajax({
            url: masterDomain + "/include/ajax.php?service=video&action=sendCommon&aid="+aid+"&id="+id,
            data: "content="+content,
            type: "GET",
            dataType: "jsonp",
            success: function (data) {
                t.removeClass("load");
                contentObj.html("");
                if(data && data.state == 100){

                    var info = data.info;
                    var list = [];
                    var photo = info.userinfo['photo'] == "" ? staticPath+'images/noPhoto_40.jpg' : huoniao.changeFileSize(info.userinfo['photo'], "small");


                    list.push('<li data-id="'+info['id']+'">');
                    list.push('  <img data-uid="'+info.userinfo['userid']+'" src="'+photo+'" alt="'+info.userinfo['nickname']+'">');
                    list.push(' <div class="pl-txt">');
                    list.push('     <div class="plt-lead">');
                    list.push('         <span class="name" data-id="'+info.userinfo['userid']+'">'+info.userinfo['nickname']+'</span>');
                    list.push('         <span class="zan-1">'+info['good']+'<i></i></span>');
                    list.push('         </div>');
                    list.push('         <div class="date">'+info['ftime']+'</div>');
                    list.push('      <div class="tt">'+info['content']+'</div>');
                    list.push('    </div>');
                    list.push('</li>');

                    //一级评论
                    if(commentObj.find("li").length <= 0){
                        commentObj.html("");
                        $("#loadMore").removeClass().hide();
                    }

                    commentObj.prepend(list.join(""));

                }

            }
        });

    });

    //顶
    commentObj.delegate(".zan-1", "click", function(){
        var t = $(this), id = t.closest("li").attr("data-id");
        if(t.hasClass("active")) return false;
        if(id != "" && id != undefined){
            $.ajax({
                url: "/include/ajax.php?service=video&action=dingCommon&id="+id,
                type: "GET",
                dataType: "jsonp",
                success: function (data) {
                    var ncount = Number(t.text().replace("(", "").replace(")", ""));
                    t
                        .addClass("active")
                        .html((ncount+1)+'<i></i>');
                }
            });
        }
    });

    //加载评论
    function loadComment(){
        if(aid && aid != undefined){

            $('.loading').html("获取评论中，请稍后...");

            var orderby = "ctime";
            //异步获取用户信息
            $.ajax({
                url: "/include/ajax.php?service=video&action=common&newsid="+aid+"&page="+atpage+"&orderby="+orderby+"&pageSize=10",
                type: "GET",
                dataType: "jsonp",
                success: function (data) {
                    if(data && data.state == 100){

                        var html = getCommentList(data.info.list);
                        if(html != ''){
                            commentObj.append(html);
                            $('.loading').html('点击加载更多');
                            if(atpage == 1){
                                $('.loading').addClass('getmore')
                            }
                        }else{
                            $('.loading').removeClass('getmore').html('已加载全部评论');
                        }

                    }else{
                        $('.loading').html("暂无相关评论");
                    }
                },
                error: function(){
                    if(commentObj.find("li").length <= 0){
                        $(".loading").html('暂无相关评论');
                    }
                }
            });
        }else{
            $(".loading").addClass('error').html('Error!');
        }
    }

    //拼接评论列表
    function getCommentList(list){
        var data = list, html = [];
        for(var i = 0; i < data.length; i++){
            var info = data[i];
            var list = [];
            var photo = info.userinfo.photo == "" ? staticPath+'images/noPhoto_40.jpg' : huoniao.changeFileSize(info.userinfo.photo, "small");

            list.push('<li data-id="'+info['id']+'">');
            list.push('  <img data-uid="'+info.userinfo['userid']+'" src="'+photo+'" alt="'+info.userinfo['nickname']+'">');
            list.push(' <div class="pl-txt">');
            list.push('     <div class="plt-lead">');
            list.push('         <span class="name" data-id="'+info.userinfo['userid']+'">'+info.userinfo['nickname']+'</span>');
            list.push('         <span class="'+(info.already == 1 ? 'zan-1 active' : 'zan-1')+'">'+info['good']+'<i></i></span>');
            list.push('         </div>');
            list.push('         <div class="date">'+info['ftime']+'</div>');
            list.push('      <div class="tt">'+info['content']+'</div>');
            list.push('    </div>');
            list.push('</li>');


            html.push(list.join(""));
        }
        return html.join("");
    }
    loadComment();

    $('.comment').delegate(".getmore", "click", function(){
        atpage++;
        loadComment();
    })

})
