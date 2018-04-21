$(function(){
	    $('#_submit').click(function() {
        var str, rec = 0,
        un = $('._ajaxuser').val(),
        pw = $('._ajaxpw').val();;
        if (un == '') {
          str = '请输入登录账号!';
        } else {

          if (pw == '') {
            str = '请输入登录密码';
          }
        }
        if (str) $('#_msg').html(str);
      });
      function goto_top(){
      $('html,body').animate({
      "scrollTop":768

      },300)
      }
      $('.load_1').click(function(){
        if ($('.load').css('display') == 'none') {
          $('.load').show();
        }else{
          $('.load').hide();
        };
      })
      $('.zc_1').click(function(){
          $('.load').hide();
          goto_top();
      })
})