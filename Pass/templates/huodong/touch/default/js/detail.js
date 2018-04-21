$(function(){

    var fid = 0;    // 费用类型

    // 判断是否 不能报名
    if($('.jo-3 a').hasClass('baomingend')){
        $('.baoming .bm-3, .baoming-foot').remove();
    }

    //收藏
    $('.jojo-1').click(function(){
        $(this).hide();$(this).siblings('.jojo-2').show();
    })
    $('.jojo-2').click(function(){
        $(this).hide();$(this).siblings('.jojo-1').show();
    })

    // 打开收费类型
    $('.list-4').click(function(){
        showPrice();
    })

    $('.baoming span,.black').click(function(){
        $('.baoming').slideUp(300);
        $('.black').hide();
    })

    $('.baoming-yes').click(function(){
        var t = $(this);
        if(t.hasClass('disabled')) return;
        if(t.hasClass('cancel')){
            baoming(t,'cancel');
        }else{
            if(showPrice()){
                baoming(t);
            }
        }
    })

    $('.baomin_next').click(function(){
        var t = $(this);
        if(t.hasClass('disabled')) return;
        if(feetype && fid == 0){
            alert('请选择收费类型');
        }else{
            baoming(t);
        }
    })

    // 显示收费类型
    function showPrice(){
        if(!feetype){
            return true;
        }else{
            $('.baoming').slideDown(300);
            $('.black,.baoming').show();
            return false;
        }
    }

    //价格勾选
    $('.baoming ul li').click(function(){
        var x = $(this);
        if (x.hasClass('op-1')) {
            x.removeClass('op-1');
            fid = 0;
        }else{
            x.addClass('op-1');
            x.siblings().removeClass('op-1');
            fid = x.attr('data-id');
        }
    })

    //收藏
    $('.collect').click(function(){

        var t = $(this), type = "add";
        var userid = $.cookie(cookiePre+"login_user");
        if(userid == null || userid == ""){
            location.href = masterDomain + '/login.html';
            return false;
        }

        if(t.hasClass("gy")){
            type = "del";
            t.removeClass("gy").find("p").html("收藏");
        }else{
            t.addClass("gy").find("p").html("已收藏");
        }
        $.post("/include/ajax.php?service=member&action=collect&module=huodong&temp=detail&type="+type+"&id="+id);
    });

    function baoming(t,type){

        //验证登录
        var userid = $.cookie(cookiePre+"login_user");
        if(userid == null || userid == ""){
            location.href = masterDomain + '/login.html';
            return false;
        }

        t.addClass("disabled");

        if(type == 'cancel'){

            if(confirm("确认取消报名吗？")){
                $.ajax({
                    url: masterDomain+"/include/ajax.php?service=huodong&action=cancelJoin&id="+id,
                    type: "GET",
                    dataType: "jsonp",
                    success: function (data) {
                        t.removeClass("disabled");
                        if(data && data.state == 100){
                            location.reload();
                        }else{
                            alert(data.info);
                        }
                        t.removeClass("disabled");
                    },
                    error: function(){
                        alert("网络错误，操作失败，请稍候重试！");
                        t.removeClass("disabled");
                    }
                });
            }else{
                t.removeClass("disabled");
            }
            return false;

        }

        $.ajax({
            url: masterDomain+"/include/ajax.php?service=huodong&action=join&id="+id+"&fid="+fid,
            type: "GET",
            dataType: "jsonp",
            success: function (data) {
                if(data && data.state == 100){
                    if(feetype == 1 && data.info != "报名成功！"){
                        location.href = data.info;
                    }else{
                        location.reload();
                    }
                }else{
                    alert(data.info);
                    t.removeClass("disabled");
                }
            },
            error: function(){
                alert("网络错误，报名失败，请稍候重试！");
                t.removeClass("disabled");
            }
        });
    }

    // 遮罩层
    $('.mask').on('click',function(){
        $('.mask').hide();
        $('.fenlei .fenlei-1').hide();
        $('.list-head li').removeClass('active');
    })

    // 展开更多评论
    $('.dis-foot').click(function(){
        var dom = $('.discuss')
        dom.toggleClass('roll');
    })

    $('.mask').click(function(){
        var dom = $('.mask')
        if (dom.hasClass('active')) {
            $('body').addClass('by')
        }else{
            $('body').removeClass('by')
        }
    })


    var businessUrl = $("#replyList").data("url");
    var atpage = 1;

    //获取评论
    function getReplyList(){
        $('.loading').show();
        $.ajax({
            url: masterDomain+"/include/ajax.php?service=huodong&action=reply&hid="+id+"&page="+atpage+"&pageSize=10",
            type: "GET",
            dataType: "jsonp",
            success: function (data) {
                if(data && data.state == 100){
                    var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

                    if(list.length > 0){
                        for(var i = 0; i < list.length; i++){
                            var src = staticPath+'images/noPhoto_100.jpg';
                            if(list[i].member.photo){
                                src = huoniao.changeFileSize(list[i].member.photo, "middle");
                            }
                            if(list[i].uid == uid){
                                var users = '<p>【主办方】'+list[i].member.nickname+'</p>';
                            }else{
                                var users = '<b>'+list[i].member.nickname+'</b>';
                            }
                            html.push('<li data-id="'+list[i].id+'" data-uid="'+list[i].uid+'" data-name="'+list[i].member.nickname+'"> <a href="'+(businessUrl.replace("%id", list[i].uid))+'"><img onerror="javascript:this.src=\''+staticPath+'images/noPhoto_40.jpg\';" src="'+src+'" alt=""></a> <div class="dis-txt"> <div class="dt-lead">'+ users +'<i>'+list[i].floortime+'</i> </div> <span>'+list[i].content+'</span> </div> </li>');

                            if(list[i].lower != null){
                                html.push(getLowerReply(list[i].lower, list[i].member));
                            }
                        }
                    }

                    $("#replyList ul").append(html.join(""));

                    if(atpage < pageInfo.totalPage){
                        $('.loading').html('<a href="javascript:;" class="getmore">显示更多讨论</a>');
                    }else if($("#replyList ul li").length > 4){
                        $('.loading').html('<a href="javascript:;" class="rollup">展开/收起讨论</a>');
                    }else{
                        $('.loading').html('<a href="javascript:;">已显示全部讨论</a>');
                    }

                }else{
                    if(atpage == 1){
                        $(".loading").html('暂无讨论！');
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

                if(arr[i].uid == uid){
                    var users = '<p>【主办方】'+arr[i].member.nickname+'</p>';
                }else{
                    var users = '<b>'+arr[i].member.nickname+'</b>';
                }

                html.push('<li data-id="'+arr[i].id+'" data-uid="'+arr[i].uid+'" data-name="'+arr[i].member.nickname+'"> <a href="'+(businessUrl.replace("%id", arr[i].uid))+'"><img onerror="javascript:this.src=\''+staticPath+'images/noPhoto_40.jpg\';" src="'+src+'" alt=""></a> <div class="dis-txt"> <div class="dt-lead">'+ users +'<i>'+arr[i].floortime+'</i> </div> <span>回复 '+member.nickname+'：'+arr[i].content+'</span> </div> </li>');

                if(arr[i].lower != null){
                    html.push(getLowerReply(arr[i].lower, arr[i].member));
                }
            }
            return html.join("");
        }
    }

    var first = true;
    $(window).scroll(function(){
        var wsct = $(window).scrollTop();
        if(first && wsct + $(window).height() > $('#replyList').offset().top){
            first = false;
            getReplyList();
        }
    })

    $('#replyList').delegate(".getmore","click",function(){
        atpage++;
        $(".loading").html('获取中，请稍后···');
        getReplyList();
    })

    // 展开收起评论
    $('#replyList').delegate(".rollup","click",function(){
        var ul = $('#replyList ul');
        if(ul.hasClass('roll')){
            ul.removeClass('roll').find('li').show();
        }else{
            ul.addClass('roll').find('li').slice(4).hide();
        }
    })


    var rid = 0, ruid = 0, runame = '', sct = 0;
    // 我要讨论
    $('.reply').click(function(){
        rid = 0;
        ruid = uid;
        runame = uname;
        replyFun();
    })
    // 发表回复
    $('#replyList').delegate(".dis-txt","click",function(){
        var t = $(this).closest('li');
        rid = t.data('id');
        ruid = t.data('uid');
        runame = t.data('name');
        replyFun();
    })

    function replyFun(){
        var userid = $.cookie(cookiePre+"login_user");
        if(userid == null || userid == ""){
            location.href = masterDomain + '/login.html';
            return false;
        }

        sct = $(window).scrollTop();

        $('body').addClass('fixed');

        $('.layer').addClass('show').animate({"left":"0%"},100);

        $('.editor .img').css("display","table-cell");
    }

      //发表回复
    $(".top-r").bind("click", function(){
        var t = $(this), content = $(".textarea").html();
        if(!t.hasClass("disabled") && $.trim(content) != ""){
            t.addClass("disabled");

            $.ajax({
                url: "/include/ajax.php?service=huodong&action=sendReply",
                data: "hid="+id+"&rid="+rid+"&content="+encodeURIComponent(content),
                type: "POST",
                dataType: "json",
                success: function (data) {
                    t.removeClass("disabled");
                    if(data && data.state == 100){
                        var info = data.info;
                        $(".top-l").click();
                        if(data.info.state == 1){
                            $('.top-r').text('发表成功！');
                            $('.layer').animate({"left":"100%"},1,function(){
                                $('.layer').removeClass('show');

                                if(info.id == uid){
                                    var users = '<p>【主办方】'+info.nickname+'</p>';
                                }else{
                                    var users = '<b>'+info.nickname+'</b>';
                                }

                                var newReply = $('<li class="load" data-id="'+info.aid+'" data-uid="'+info.id+'" data-name="'+info.nickname+'" style="display:none;"> <a href="'+(businessUrl.replace("%id", info.id))+'"><img onerror="javascript:this.src=\''+staticPath+'images/noPhoto_40.jpg\';" src="'+info.photo+'" alt=""></a> <div class="dis-txt"> <div class="dt-lead">'+ users +'<i>'+info.pubdate+'</i> </div> <span>'+ (rid ? ('回复 '+runame+'：') : '') +info.content+'</span> </div> </li>');

                                $('#replyList ul').prepend(newReply);
                                newReply.slideDown(300,function(){
                                    newReply.removeClass('load');
                                    $('.discuss-lead em').text(++reply);
                                });
                                t.removeClass("disabled").text('发表');
                            });
                        }else{
                            t.removeClass("disabled").text('发表');
                            alert("发表失败，请刷新重试！");
                        }
                    }else{
                        t.removeClass("disabled").text('发表');
                        alert("发表失败，请刷新重试！");
                    }
                },
                error: function(){
                    t.removeClass("disabled").text('发表');
                    alert("网络错误，发表失败，请稍候重试！");
                }
            });
        }
    });

    // 隐藏回复
    $('.top-l').click(function(){
        $('body').removeClass('fixed');
        $(window).scrollTop(sct);
        $('.layer').removeClass('show').animate({"left":"100%"},100);
        $('.layer .textarea').html('');
    })

    // 选择表情
    var memerySelection;
    $('.editor .emotion').click(function(){
        var t = $(this), box = $('.emotion-box');
        memerySelection = window.getSelection();
        if (box.css('display') == 'none') {
        $('.emotion-box').show();
        t.addClass('on');
        return false;
    }else {
        $('.emotion-box').hide();
        t.removeClass('on');
    }
    })

    $('.emotion-box li').click(function(){
        var t = $(this).find('img'), textarea = $('.textarea'), hfTextObj = textarea;
        hfTextObj.focus();
        pasteHtmlAtCaret('<img src="'+t.attr("src")+'" />');
    })

    //根据光标位置插入指定内容
    function pasteHtmlAtCaret(html) {
      var sel, range;
      if (window.getSelection) {
          sel = memerySelection;
          if (sel.getRangeAt && sel.rangeCount) {
              range = sel.getRangeAt(0);
              range.deleteContents();
              var el = document.createElement("div");
              el.innerHTML = html;
              var frag = document.createDocumentFragment(), node, lastNode;
              while ( (node = el.firstChild) ) {
                  lastNode = frag.appendChild(node);
              }
              range.insertNode(frag);
              if (lastNode) {
                  range = range.cloneRange();
                  range.setStartAfter(lastNode);
                  range.collapse(true);
                  sel.removeAllRanges();
                  sel.addRange(range);
              }
          }
      } else if (document.selection && document.selection.type != "Control") {
          document.selection.createRange().pasteHTML(html);
      }
    }

    //光标定位到最后
    function set_focus(el){
        el=el[0];
        el.focus();
        if($.browser.msie){
            var rng;
            el.focus();
            rng = document.selection.createRange();
            rng.moveStart('character', -el.innerText.length);
            var text = rng.text;
            for (var i = 0; i < el.innerText.length; i++) {
                if (el.innerText.substring(0, i + 1) == text.substring(text.length - i - 1, text.length)) {
                    result = i + 1;
                }
            }
        }else{
            var range = document.createRange();
            range.selectNodeContents(el);
            range.collapse(false);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }
})