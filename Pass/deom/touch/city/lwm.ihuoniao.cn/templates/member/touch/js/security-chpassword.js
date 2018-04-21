$(function(){

  //修改登录密码
  $("#submit").bind("click", function(){
      var old = $("#old"), newest = $("#new"), confirm = $("#confirm"), passwordStrengthDiv = $("#passwordStrengthDiv").attr("class"), btn = $(this);

      if(btn.hasClass('disabled')) return;

      if(old.val() == ""){
        showMsg("请输入当前密码");
        old.focus();
        return "false";
      }
      if(newest.val() == ""){
        showMsg("请输入新密码");
        newest.focus();
        return "false";
      }
      if(passwordStrengthDiv == "" || passwordStrengthDiv == undefined || Number(passwordStrengthDiv.replace("is", "")) < 50){
        showMsg("您输入的新密码太过简单，请重新输入");
        newest.focus();
        return "false";
      }
      if(confirm.val() == ""){
        showMsg("请确认新密码");
        confirm.focus();
        return "false";
      }
      if(newest.val() != confirm.val()){
        showMsg("两次输入的密码不一致，请重新输入");
        confirm.focus();
        return "false";
      }

      var param = "old="+old.val()+"&new="+newest.val()+"&confirm="+confirm.val();
      modifyFun(btn,'确定修改','password',param);

  });

    $(".editForm #new").passwordStrength();

})

function modifyFun(btn, btnstr, type, param){
  var data = param == undefined ? '' : param;
  btn.addClass('disabled').text('正在提交...');
  $.ajax({
    url: masterDomain+"/include/ajax.php?service=member&action=updateAccount&do="+type,
    data: data,
    type: "POST",
    dataType: "jsonp",
    success: function (data) {
      if(data && data.state == 100){
        alert(data.info);
        location.href = pageUrl;
      }else{
        alert(data.info);
        btn.removeClass('disabled').text(btnstr);
      }
    },
    error: function(){
      alert('网络错误，请稍后重试！');
      btn.removeClass('disbaled').text(btnstr);
    }
  })
}


// 错误提示
function showMsg(str){
  var o = $(".error");
  o.html('<p>'+str+'</p>').show();
  setTimeout(function(){o.hide()},1000);
}
