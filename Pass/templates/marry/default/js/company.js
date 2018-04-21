$(function(){

  //展开列表
  $(".list li .down").click(function(){
  	var t=$(this);
  	t.siblings(".img").slideToggle();
  	t.toggleClass("current");
  })

	//获取宴会厅
  $(".list li").each(function(){
    var t = $(this), id = t.data('id'), url = t.data('url');
    if(id){
      $.ajax({
        url: masterDomain+"/include/ajax.php?service=marry&action=works&type=ritual&cid="+id+"&pageSize=4",
        type: "GET",
        dataType: "jsonp",
        success: function (data) {
          if(data && data.state == 100){
            var list = data.info.list, html = [], i = 0;
            for(var i = 0; i < list.length; i++){
              html.push('<a href="'+url+'" target="_blank"><img src="'+huoniao.changeFileSize(list[i].litpic, "middle")+'" alt=""><p>'+list[i].title+'</p></a>');
            }
            t.find(".img").html(html.join(""));
          }else{
            t.find(".img .loading").html("暂无相关作品");
          }
        }
      });
    }
  });

})
