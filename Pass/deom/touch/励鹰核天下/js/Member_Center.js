$(function(){
	// 分类下拉
      $("#tbdaohang").click(function() {
        $("#fenlei").toggle();
      });
      $(window).scroll(function() {
        $("#fenlei").hide();
      });
      $("#tongji").click(function() {
        $("#tongji_jf").toggle();
      });
      $(window).scroll(function() {
        $("#tongji_jf").hide();
      });
      // 菜单弹出
      $("#plug_btn").click(function() {
        if ($("ul.top_menu li").hasClass("on")) {
          $("ul.top_menu li").removeClass("on");
          $("ul.top_menu li").addClass("out");
          $(".plug_menu").removeClass("plug_menu_xuanzhong");
          $('.top_bar').fadeOut(700);
        } else {
          $(".top_menu li").removeClass("out");
          $(".top_menu li").addClass("on");
          $(".plug_menu").addClass("plug_menu_xuanzhong");
          $('.top_bar').fadeIn(100);
        }
      });
      $("div.top_bar").click(function() {
        $("ul.top_menu li").removeClass("on");
        $("ul.top_menu li").addClass("out");
        $(".plug_menu").removeClass("plug_menu_xuanzhong");
        $('.top_bar').fadeOut(700);
      });
      // 视频自适应
      var widths = $(window).width();
      if (widths > 310) {
        $("div.con_neirong video").css({
          "width": "100%",
          "height": 250 + 'px'
        });
        $("div.con_neirong iframe").css({
          "width": "100%",
          "height": 250 + 'px'
        });
        $("div.con_neirong object").css({
          "width": "100%",
          "height": 250 + 'px'
        });
      }
      // 图片自适应
      $(window).load(function() {
        $("div.con_neirong img").each(function(index) {
          var conimgmaxWidth = 310;
          var conimgwidth = $(this).width();
          if (conimgwidth > conimgmaxWidth) {
            $(this).css({
              "width": "100%",
              "height": "auto"
            });
          }
        })
      })
      // 刷新功能
      $(function() {
        $("#shuaxin").click(function() {
          refresh();
        });
      });
      //点击按钮调用的方法
      function refresh() {
        window.location.reload(); //刷新当前页面.
      }



    $('.li').click(function(){
      $('.li').children('div').removeClass('on');
      $(this).children('div').addClass('on');
      id=$(this).attr('data');
    });


        
    var adsid=$('#adsid').val();
    $(function(){
      if(adsid==0){
        $('#selectads span:eq(0)').addClass('on');
        $('#adsid').val($('#selectads span:eq(0) img').attr('id'));
      }else $('#'+adsid).parent().addClass('on');

      if ($('.jiesuan_input').is(":checked")){
        $('.jiesuan_input').addClass("jiesuan_hong");
      };
    });
    $('#selectads span').click(function(){
      $('#selectads span').removeClass('on');
      $(this).addClass('on');
      $('#adsid').val($(this).children('img').attr('id'));
    });

    $('.jiesuan_input').click(function(){
      var is = $(this).is(":checked");
      if(is) {
        $(this).addClass("jiesuan_hong");
      }
      else {
        $(this).removeClass("jiesuan_hong");;
      }
    });

    $('#inputthumb').blur(function(){
      $('#thumb').attr('src',$('#inputthumb').val());
    });

    // 分享添加校验
    $('#fenxiang').click(function(){
      // 校验标题是否为空
      if ($(":input[name='info[title]']").val() == '') {
        alert('请填写分享文章的标题');
        $(":input[name='info[title]']").focus();
        return false;
      }
      if ($(":input[name='info[loadurl]']").val() == '') {
        alert('请填写分享文章的链接');
        $(":input[name='info[loadurl]']").focus();
        return false;
      }
      // 校验添加的文章链接是否正确
      var fxvue=$(":input[name='info[loadurl]']").val();
      fxurl = /^(ftp|http|https)[\w\W]+$/;
      if (fxurl.test(fxvue) == false) {
        alert("分享文章链接不正确");
        $(":input[name='info[loadurl]']").focus();
        return false;
      }
      // 判断图片是否为空
      if ($(":input[name='info[thumb]']").val() == '') {
        alert('请填写分享图片的链接');
        $('#inputthumb').focus();
        return false;
      }
      //判断图片是否存在  
      var imgurl = $(":input[name='info[thumb]']").val();
      var ImgObj = new Image(); 
      ImgObj.src = imgurl;  
      if (ImgObj.fileSize > 0 || (ImgObj.width > 0 && ImgObj.height > 0)) { //没有图片，则返回-1  
        return true;  
      } else {
        alert("分享图片链接不正确");
        $('#inputthumb').focus();
        return false;
      }
    });
    // 分享添加校验结束
    $('.zixun_hgf').click(function(){
      if ($('#zixun_fl').css('display') == 'none') {
        $('#zixun_fl').show();
      }else{
        $('#zixun_fl').hide();
      };
    })
    
    $('#submit').click(function(){
      if($('input[name="oldpw"]').val()==''){
        alert('请填入旧密码');return false;
      }
      var pw=$('input[name="password"]').val();
      if(pw.length<6 ||pw.length>20){
        alert('请输入一个6到20位的密码');return false;
      }
      if(pw!=$('input[name="pwconfirm"]').val()){
        alert('两次密码不一致');return false;
      }
    });
})