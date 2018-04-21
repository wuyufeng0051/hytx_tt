$(function(){

  //导航
  $('.header-r .screen').click(function(){
    var nav = $('.nav'), t = $('.nav').css('display') == "none";
    if (t) {nav.show();}else{nav.hide();}
  })

  // 选项切换
  $('.header-c span').click(function(){
    var t = $(this), index = t.index();
    t.addClass('on').siblings('span').removeClass('on');
    $('.content .typelist').eq(index).show().siblings('.typelist').hide();
  })

  //更新验证码
  var verifycode = $("#verifycode").attr("src");
  $("#verifycode").bind("click", function(){
    $(this).attr("src", verifycode+"?v="+Math.random());
  });

  $('.sqsj').click(function(){
    alert('敬请期待！')
  })


})


// 错误提示
function showMsg(str){
  var o = $(".error");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}


function getaddr(id,sname,sid){

  $.ajax({
    url: "/include/ajax.php?service="+modelType+"&action=addr&type="+id,
    type: "GET",
    dataType: "json",
    success: function (data) {
      if(data && data.state == 100){
        var list = [], info = data.info;
        list.push('<option value="0"><a href="javascript:;">请选择</a></option>');
        for(var i = 0; i < info.length; i++){
          var selected = '';
          if(sid != undefined && sid != 0 && sid != ''){
            if(sid == info[i].id){
              selected = ' selected="selected"';
            }
          }
          else if(sname != undefined && sname != '' && $.trim(sname) == $.trim(info[i].typename)){
            selected = ' selected="selected"';
          }
          list.push('<option value="'+info[i].id+'"'+selected+'><a href="javascript:;">'+info[i].typename+'</a></option>');
        }
        $(".area2").html(list.join("")).show();
      }
    }
  });

}
