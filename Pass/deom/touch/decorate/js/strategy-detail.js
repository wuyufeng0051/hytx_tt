$(function(){
	// 分享
$('.share img').click(function(){
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


function closeShearBox(){
        $('#shearBox').css('bottom','-100%');
        $('#shearBox .bg').css({'height':'0','opacity':0});
    }
    function closecodeBox(){
        $('#codeBox').css('bottom','-100%');
        $('.shearBox .bg').css({'height':'0','opacity':0});
    }

})