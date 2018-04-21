$(function() {
  $(".menuBox .item").click(function() {
    var next = $(this).next("ul");
    if (next.css("display") == "none") {
      next.slideDown(300); $("i", this).attr("class", "t");
    } else if (next.css("display") == "block") {
      $("i", this).attr("class", "b"); next.slideUp(300);
    }
  })

  //菜单定位
  var url = location.pathname + location.search
  for (var i = 0; i < $(".leftBox a").length; i++) {
    var href_1 = $(".leftBox a").eq(i).attr("href");
    if (href_1 == undefined) {
      var href_2 = "ppp"
    } else {
      var href_2 = href_1
    }
    if (url == href_2) {
      $(".leftBox a").eq(i).addClass("active"); $(".leftBox a").eq(i).parents("ul").show();
      $(".leftBox a").eq(i).parents("ul").prev().children("i").attr("class", "t")
    }
  }
})