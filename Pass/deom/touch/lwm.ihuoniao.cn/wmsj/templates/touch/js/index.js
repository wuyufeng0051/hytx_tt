$(function(){



  // 加载更多
  var hallList = $(".load"), page = 1, atpage = 1, pageSize = 20, listArr = [], totalPage = 0, isload = false;
  var MoreCreateList = function () {
    isload = true;
    $(".list .item").remove();
    hallList.text('正在加载，请稍后···').show();
    $.ajax({
      url: '?action=shopList',
      data: {
          // typeid: typeid,
          // orderby: orderby,
          u: 1,
          page: page,
          pageSize: pageSize
      },
      type: 'get',
      dataType: 'json',
      success: function(data){

          if(data.state == 100){
              var list = [];

              var info = data.info.list;
              for(var i = 0; i < info.length; i++){
                  var d = info[i];

                  list.push('<div class="item" data-id="'+d.id+'">');
                  list.push('    <div class="imgbox"><img src="'+d.pic+'" alt="'+d.shopname+'" onerror="this.src=\'/static/images/shop.png\'"></div>');
                  list.push('    <div class="txtbox">');
                  list.push('      <div class="title"><span class="name">'+d.shopname+'</span>');
                  list.push('      <div class="switch switch-small has-switch"> <div class="'+(d.status == 1 ? 'switch-on' : 'switch-off')+'"><input type="checkbox" checked=""><span class="switch-left switch-small">ON</span><label class="switch-small">&nbsp;</label><span class="switch-right switch-small">OFF</span></div> </div>');
                  list.push('      </div>');
                  list.push('      <p>电话：'+d.phone+'</p>');
                  list.push('      <p>地址：'+d.address+'</p>');
                  list.push('    </div>');
                  list.push('</div>');
              }

              hallList.hide().before(list.join(''));

              isload = false;
              page++;

          }else{
              hallList.text(data.info);
          }

      },
      error: function(){
        isload = false;
        hallList.text('网络错误，加载失败！');
      }
    })
  };


  new DragLoading($('.loading'), {
      onReload: function () {
          var self = this;
          MoreCreateList();
          self.origin();
      }
  });


  // 加载更多
	$(window).scroll(function() {
		var h = $('.footer').height();
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - h - w;
		if (!isload && $(window).scrollTop() > scroll) {
        MoreCreateList();
        // tabsSwiper.onResize();
		};
	});

  MoreCreateList();


  // 更改店铺状态
  $(".list").delegate(".switch", "click", function(){
    var t = $(this), check = t.children('div'), val = check.hasClass('switch-on') ? 0 : 1, id = t.closest('.item').attr('data-id');

    $.ajax({
      url: "",
      type: "post",
      data: {action: "updateStatus", id: id, val: val},
      dataType: "json",
      success: function(res){
        if(res.state != 100){
          alert(res.info);
        }else{
          if(val == 0){
            check.removeClass().addClass('switch-off switch-animate');
          }else{
            check.removeClass().addClass('switch-on switch-animate');
          }
        }
      },
      error: function(){
        alert("网络错误，保存失败！");
      }
    })

  })

})
