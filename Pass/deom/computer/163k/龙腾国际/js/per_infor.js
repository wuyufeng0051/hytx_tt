$(function(){
    $('#user_qq').focus(function() {
      $('#user_qqs').html('正在输入...');
    });
    $('#user_phone').focus(function() {
      $('#user_phones').html('正在输入...');
    });
    $('#user_tname').focus(function() {
      $('#user_tnames').html('正在输入...');
    });
    $('#aliwangwang').focus(function() {
      $('#user_wxs').html('正在输入...');
    });
    $('#submit').click(function(){
      var ckusertname = $('#user_tname'),
          ckuserqq = $('#user_qq'),
          ckuserphone = $('#user_phone'),
          phone = $('#user_phone').val(),
          ckuserwx = $('#aliwangwang');
      if (ckusertname.val() == "") {
        $('#user_tnames').html('请填写您的网名');
      }
      else if (ckuserqq.val() == "") {
        $('#user_qqs').html('请填写您的QQ号');
      }
      else if (ckuserphone.val() == "") {
        $('#user_phones').html('请填您的手机号码');
      }
      else if (!(/^1[34578]\d{9}$/.test(phone))){
        $('#user_phones').html('号码错误');
      }
      else if (ckuserwx.val() == "") {
        $('#user_wxs').html('请填写您的微信账号');
      };
    })
})