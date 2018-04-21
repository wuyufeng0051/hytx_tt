$(function(){
	// 选择分类
  $('.type').click(function(){
    var t = $(this);
    $('.layer').addClass('show').animate({"left":"0"},100);
    $('.choose').addClass('show').animate({"left":"0"},100);
  })

  // 隐藏分类
  $('.top-l').click(function(){
    $('.layer').animate({"left":"100%"},100);
    $('.choose').animate({"left":"100%"},100);
    setTimeout(function(){
      $('.layer').removeClass('show');
      $('.choose').removeClass('show');
    }, 100)
  })

	// 获取二级分类
	$('.fchoose').delegate('li','click',function(){
    var t = $(this), id = t.attr('data-id');
    t.addClass('curr').siblings('li').removeClass('curr');
    $.ajax({
      url: masterDomain + "/include/ajax.php?service=info&action=type&type="+id,
      type: "GET",
      dataType: "json",
      success: function (data) {
        if(data && data.state == 100){
          var list = [], info = data.info;
          list.push('<ul>');
          for(var i = 0; i < info.length; i++){
            list.push('<li data-id="'+info[i].id+'"><a href="javascript:;">'+info[i].typename+'</a></li>');
          }

          $('.fchoose, .schoose').css('width','50%');
          $(".schoose").html(list.join("")).show();

        }
        else if(data.state == 102){
          location.href = fabuUrl + '?typeid='+id;
        }
      }
    });
  })

	// 获取三级分类
  $('.schoose').delegate('li','click',function(){
    var t = $(this), id = t.attr('data-id');
    t.addClass('curr').siblings('li').removeClass('curr');
    $.ajax({
      url: masterDomain + "/include/ajax.php?service=info&action=type&type="+id,
      type: "GET",
      dataType: "json",
      success: function (data) {
        if(data && data.state == 100){
          var list = [], info = data.info;
          list.push('<ul>');
          for(var i = 0; i < info.length; i++){
            list.push('<li data-id="'+info[i].id+'"><a href="javascript:;">'+info[i].typename+'</a></li>');
          }

          $('.fchoose, .schoose').css('width','33.3%');
          $(".tchoose").html(list.join("")).show();
        }
        else if(data.state == 102){
          location.href = fabuUrl + '?typeid='+id;
        }
      }
    });
  })

  // 点击三级分类
  $('.tchoose').delegate('li','click',function(){
    var t = $(this), id = t.attr('data-id');
    location.href = fabuUrl + '?typeid='+id;
  })

  getType();

	// 初始一级分类
  function getType(){
    $.ajax({
      url: masterDomain + "/include/ajax.php?service=info&action=type",
      type: "GET",
      dataType: "json",
      success: function (data) {
        if(data && data.state == 100){
          var list = [], info = data.info;
          list.push('<ul>');
          for(var i = 0; i < info.length; i++){
            list.push('<li data-id="'+info[i].id+'"><a href="javascript:;">'+info[i].typename+'</a></li>');
          }

          $(".fchoose").html(list.join(""));
        }
      }
    });
  }
})