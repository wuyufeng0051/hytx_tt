$(function(){
            // 替换个人网站
      var website = 'http://www.lyhtx.cn/';
      // 替换个人网站
      


      var msg = '';
      var ok = '<i>输入正确</i>';
      var sec = 90;

      // 幻灯片js
      jQuery(".fullSlide").hover(function() {
        jQuery(this).find(".prev,.next").stop(true, true).fadeTo("show", 0.5)
      },
      function() {
        jQuery(this).find(".prev,.next").fadeOut()
      });
      jQuery(".fullSlide").slide({
        titCell: ".hd ul",
        mainCell: ".bd ul",
        effect: "fold",
        autoPlay: true,
        autoPage: true,
        trigger: "click",
        startFun: function(i) {
          var curLi = jQuery(".fullSlide .bd li").eq(i);
          if ( !! curLi.attr("_src")) {
            curLi.css("background-image", curLi.attr("_src")).removeAttr("_src")
          }
        }
      });
      // 最新会员动态调用
      $(function(){
        $("div.list_lh").myScroll({
          speed:50, //数值越大，速度越慢
          rowHeight:19 //li的高度
        });
      });
      $('.yinc').click(function(){
        $('.bcon').hide();
      })
      $('.load_1').click(function(){
        $('#tdiv1').show();
        $('#ddiv1').show();
      })
      $('.denglu_guanbiii').click(function(){
        $('#tdiv1').hide();
        $('#ddiv1').hide();
      })
      //提交开始校验
      $('#submit').click(function() {
        if (!ckusertname()) {
          xtalert(msg);
          $('#xtalertxs_a').click(function() {
            $('#user_tname').focus();
          });
          return false;
        }
        if (!ckuserqq()) {
          xtalert(msg);
          $('#xtalertxs_a').click(function() {
            $('#user_qq').focus();
          });
          return false;
        }
        if (!ckuserwx()) {
          xtalert(msg);
          $('#xtalertxs_a').click(function() {
            $('#aliwangwang').focus();
          });
          return false;
        }
        if (!ckuserphone()) {
          xtalert(msg);
          $('#xtalertxs_a').click(function() {
            $('#user_phone').focus();
          });
          return false;
        }
        if (!ckuserpw()) {
          xtalert(msg);
          $('#xtalertxs_a').click(function() {
            $('#user_pw').focus();
          });
          return false;
        }
        if (!ckcpw()) {
          xtalert(msg);
          $('#xtalertxs_a').click(function() {
            $('#cpw').focus();
          });
          return false;
        }
        if (!cktjname()) {
          xtalert(msg);
          $('#xtalertxs_a').click(function() {
            $('#user_name_tj').focus();
          });
          return false;
        }
        return true;
      });


      function goto_top(){
        $('html,body').animate({
          "scrollTop":900
        },300)
      }
      $('.head_zc,.denglu_colorblue1 ').click(function(){
          goto_top();
          $('#tdiv1').hide();
          $('#ddiv1').hide();
      })
})