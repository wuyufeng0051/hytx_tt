$(function(){
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

    // 分享
    $('.zan p,.zf-3').click(function(){
        $('#shearBox').css('bottom','0');
        $('#shearBox .bg').css({'height':'100%','opacity':1});
    })

    // 分享取消
    $('#cancelShear').click(function(){
        closeShearBox();
    })
    $('#cancelcode').click(function(){
        closecodeBox();
    })

    // 分享点击遮罩层
    $('.shearBox .bg, .zhiyin .bg').click(function(){
        closeShearBox();
        closecodeBox();
        $('.zhiyin').hide();
        $('.zhiyin .bg').css({'height':'0','opacity':0});
    })

    // 分享二维码
    $('.jiathis_button_code').click(function(){
      $('#shearBox').css('bottom','-100%');
      $('#codeBox').css('bottom','0');
      var code = masterDomain+'/include/qrcode.php?data='+encodeURIComponent(window.location);
      $('#codeBox img').attr('src', code);
    })

    // 分享右上角
    $('.jiathis_button_tweixin, .jiathis_button_ttqq, .jiathis_button_comment').click(function(){
      closeShearBox();
      $('.zhiyin').show();
      $('.zhiyin .bg').css({'height':'100%','opacity':1});
    })

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

})