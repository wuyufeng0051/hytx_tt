$(function(){
	$("#slider1").cycle({
		pause: true,
		prev:'.prev',
		next:'.next'
	});

  //搜索
  $("#search").bind("click", function(){

    var keywords = $.trim($("#keywords").val()), price1 = $.trim($("#price1").val()), price2 = $.trim($("#price2").val());
    var data = [];
    if(keywords != "" && keywords != "请输入搜索内容"){
      data.push("keywords="+keywords);
    }
    if(price1 != "" || price2 != ""){
      var price = [];
      if(price1 != ""){
        price.push(price1);
      }
      price.push(",");
      if(price2 != ""){
        price.push(price2);
      }
      data.push("price="+price.join(""));
    }

    var param = pageUrl.indexOf(".html") > -1 ? "?" : "&";
    location.href = pageUrl + param + data.join("&");

  });

  //回车提交
  $(".classify input").keyup(function (e) {
		if (!e) {
			var e = window.event;
		}
		if (e.keyCode) {
			code = e.keyCode;
		}
		else if (e.which) {
			code = e.which;
		}
		if (code === 13) {
			$("#search").click();
		}
	});

})
