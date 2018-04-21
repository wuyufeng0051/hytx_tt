$(function(){

  // 鼠标经过更换gif图
  $('.rect').hover(function(){
    var x = $(this),
        find = x.find('.rect_pic img'),
        data = find.data('gif'),
        pic = x.find('.rect_pic img')[0].src;

      find.attr("src",data).data('gif',pic);
  })

  // 推荐活动点击出现弹出框
  $('.rect').on('click', function(){
     layer.open({
      type: 1,
      title: false,
      closeBtn: 1,
      shadeClose: false,
      skin: '',
      content: '<div class="popup"><div class="close"></div><div class="turn_left"></div><div class="turn_right"></div><div class="pop_left"><div class="pop_pic"><img src="upfile/AAEIABACGAAg0O2KyQUo6L_n1gcwgAU48Ag.jpg"alt=""></div><div class="activeLink"><div class="act_hover"><img src="images/comewm.jpg"alt=""><p>扫二维码体验活动</p></div></div></div><div class="pop_right"><div class="pop_name">活动名称：清凉夏至吃水果</div><div class="qrCodeBox"><div class="qrCodeImg"><img src="images/comewm.jpg"alt=""></div><div class="qrCodeTxt">微信扫一扫体验活动</div></div><div class="pop_creat"><a href="creat.html">创建</a></div></div></div>'
      });
  });



})