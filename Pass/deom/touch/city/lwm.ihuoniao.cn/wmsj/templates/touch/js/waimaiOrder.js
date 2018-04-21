$(function(){

  var isload = false;
  var activeIndex = 0, container = $(".swiper-slide").eq(0);
  var tabsSwiper = new Swiper('#tabs-container',{
    speed:500,
    autoHeight: true,
    onSlideChangeStart: function(){
      activeIndex = tabsSwiper.activeIndex;
      container = $(".swiper-slide").eq(activeIndex);
      var active = $(".tabs a").eq(activeIndex);
      active.addClass('active').siblings().removeClass('active');
      $(window).scrollTop(0);
      isload = false;
      getList('change');
    },
    onSliderMove: function(){
      // isload = true;
    },
    onSlideChangeEnd: function(){
      isload = false;
    }
  })
  $(".tabs a").on('touchstart mousedown',function(e){
    e.preventDefault();
    $(".tabs .active").removeClass('active')
    $(this).addClass('active')
    tabsSwiper.slideTo( $(this).index() )
  })
  $(".tabs a").click(function(e){
    e.preventDefault()
  })


  // 下拉刷新
  new DragLoading($('.loading'), {
      onReload: function () {

        container.attr({"data-first":"1", "data-page":"1", "data-end":"0"});


        getList("refresh");
        tabsSwiper.onResize();
        this.origin();
      }
  });


  // 加载更多
	$(window).scroll(function() {
		var h = $('.footer').height();
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - h - w;
		if ($(window).scrollTop() > scroll && !isload) {
      if($(".swiper-slide").eq(activeIndex).attr("data-end") != "1"){
        getList();
      }
      tabsSwiper.onResize();

		};
	});

  function getList(type){
    var state = $(".tabs a").eq(activeIndex).attr("data-state"), list = container.find(".content-slide"), page = container.attr("data-page");

    if(type == 'change'){
      if(container.attr("data-first") != 1){
        return;
      }
    }
    if(type == 'refresh'){
      list.html('<div class="load">正在加载，请稍后···</div>');
    }else{
      if(list.find(".load").length == 0){
        list.append('<div class="load">正在加载，请稍后···</div>');
      }
    }
    var load = list.find(".load");
    load.show();

    isload = true;

    $.ajax({
      url: '?action=getList&state='+state+'&p='+page,
      type: 'get',
      dataType: 'json',
      success: function(data){
        if(data && data.state == 100){
          var list = data.info.list, len = list.length, html = [];

          // container.attr("data-totalPage", data.info.pageInfo.totalPage);

          if(len > 0){
            for(var i = 0; i < len; i++){
              var obj = list[i], item = [];
              item.push('<div class="item">');
              if(obj.today){
                item.push('  <em class="tag">今日</em>');
              }
              item.push('  <a href="waimaiOrderDetail.php?id='+obj.id+'" class="fn-clear">');
              item.push('    <div class="imgbox"><img src="'+skinlUrl+'images/timepicker2.png" alt="">'+obj.pubdatef+'</div>');
              item.push('    <div class="txtbox">');
              item.push('      <p class="title">'+obj.username+'&nbsp;&nbsp;'+obj.tel+'</p>');
              item.push('      <p>订单号：'+obj.shopname+obj.ordernumstore+'</p>');
              item.push('    </div>');
              item.push('  </a>');
              item.push('</div>');

              html.push(item.join(""));
            }

            load.hide().before(html.join(""));

            container.attr("data-page", ++page)

            isload = false;

          }else{
            load.text('已加载完全部数据');
            container.attr("data-end", "1");
          }
          
        }else{
          load.text("暂无数据");
          container.attr("data-end", "1");
        }

        container.attr("data-first", "0");
      },
      error:  function(){
        isload = false;
        console.log('err')
      }
    })
  }
  // getList();

})
