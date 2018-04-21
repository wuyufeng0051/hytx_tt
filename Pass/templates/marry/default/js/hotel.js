$(function(){
  $("#totalCount").html(totalCount);

  //获取宴会厅
  $(".list .block").each(function(){
    var t = $(this), id = t.data('id'), url = t.data('url');
    if(id){
      $.ajax({
        url: masterDomain+"/include/ajax.php?service=marry&action=hotelHall&id="+id+"&pageSize=3",
        type: "GET",
        dataType: "jsonp",
        success: function (data) {
          if(data && data.state == 100){
            var list = data.info, html = [], i = 0;
            for(var i = 0; i < list.length; i++){
              html.push('<tr><td></td>');
              html.push('<td><a href="'+url+'" target="_blank">'+list[i].title+'</a></td>');
              html.push('<td>'+list[i].desk+'桌</td>');
              html.push('<td>'+list[i].height+'米</td>');
              html.push('<td>'+list[i].shape+'</td>');
              html.push('<td>'+list[i].area+'平米</td>');
              html.push('<td><span><em>&yen;</em>'+list[i].low+'<i>万/桌起</i></span></td>');
              html.push('</tr>');
            }
            t.find("tbody tr:eq(1)").remove();
            t.find("tbody").append(html.join(""));

            if(list.length > 3){
              t.append('<p class="down"><a href="'+url+'" target="_blank"><span>查看全部 <font>'+list.length+'</font> 个宴会厅</span></a></p>');
            }else if(list.length > 0){
              t.append('<p class="down"><a href="'+url+'" target="_blank"><span>查看宴会厅</span></a></p>');
            }
          }
        }
      });
    }
  });

});
