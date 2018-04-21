$(function(){

  var dragload = new DragLoading($('.loading'), {
    onReload: function () {
        var self = this;
        if($(".pswp").attr("aria-hidden") != "false"){
          MoreCreateList(true);
        }
        self.origin();
    }
  });

  setInterval(function(){
    if($(".pswp").attr("aria-hidden") == "false"){
      $(".loading").addClass("stop");
    }else{
      $(".loading").removeClass("stop");
    }
  },100)


  // 加载更多
  var hallList = $(".load"), page = 2, pageSize = 10, listArr = [], totalPage = 0, isload = false;
  var MoreCreateList = function (refresh) {
    isload = true;

    if(refresh){
      $(".list .comment-list").remove();
      page = 1;
    }
    hallList.text('正在加载，请稍后···').show();
    $.ajax({
      url: '?action=getList',
      data: {
          p: page,
          pageSize: pageSize
      },
      type: 'get',
      dataType: 'json',
      success: function(data){

          if(data.state == 100){
              var html = [];

              var info = data.info.list, totalCount = data.info.pageInfo.totalCount;

              if(info.length > 0){
                for(var i = 0; i < info.length; i++){
                    var d = info[i], item = [];

                    item.push('<div class="comment-list" data-id="'+d.id+'">');
                    item.push('    <div class="comment-user"><img src="/static/images/default_user.jpg"></div>');
                    item.push('    <div class="comment-info">');
                    item.push('      <h3>'+d.username+'<em>'+d.pubdatef+'</em> </h3>');
                    item.push('      <h3>店铺名称：'+d.shopname+'<em>'+d.pubdatef+'</em> </h3>');
                    item.push('      <h3>订单编号：'+d.ordernumstore+'<em>'+d.pubdatef+'</em> </h3>');
                    item.push('      <div class="judge-box">');
                    item.push('       <div class="judge-star l"><s style="width:'+d.star/5*100+'%;"></s></div>');
                    item.push('       <span class="sale-time">：店铺评分</span>');
                    item.push('      </div>');
                    item.push('      <div class="judge-box">');
                    item.push('       <div class="judge-star l"><s style="width:'+d.starps/5*100+'%;"></s></div>');
                    item.push('       <span class="sale-time">：配送评分，'+d.time+'分钟送达</span>');
                    item.push('       <div class="clear"></div>');
                    item.push('      </div>');
                    item.push('      <div class="comment-txt">'+d.content+'</div>');

                    if(d.pics){
                      item.push('   <div class="my-gallery" data-pswp-uid="1" itemscope="" itemtype="">');
                      for(var m = 0; m < d.pics.length; m++){
                        item.push('<figure itemprop="associatedMedia">');
                        item.push('    <a data-size="300x228" href="'+d.picsf[m]+'" itemprop="contentUrl">');
                        item.push('        <img alt="Image description" itemprop="thumbnail" src="'+d.picsf[m].replace('large', 'small')+'">');
                        item.push('</a>');
                        item.push('</figure>');
                      }
                      item.push('   </div>');
                    }

                    item.push('    <div class="'+(d.replydate != 0 ? 'state ok' : 'state')+'">');
                    if(d.replydate != 0){
                      item.push('       <p class="content">回复内容：'+d.reply+'</p><p class="time">回复时间：'+d.replydatef+'</p><p class="btns"><a href="javascript:;" class="btn">已回复</a></p>');
                    }else{
                      item.push('       <p class="btns"><a href="javascript:;" class="btn reply">回复</a></p>');
                    }
                    item.push('    </div>');

                    item.push('    </div>');
                    item.push('</div>');

                    html.push(item.join(""));
                }

                hallList.hide().before(html.join(''));

                initPhotoSwipeFromDOM('.my-gallery');

                isload = false;
                page++;

              }else{

                hallList.text(totalCount > 0 ? "已加载全部评论" : "暂无评论");

              }

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

  // MoreCreateList();

  // 回复
  var activeObj = null;
  $(".list").delegate(".reply", "click", function(){
    activeObj = $(this).closest('.comment-list');

    $('.textarea').val('');
    $('.failbox').addClass('show');

  })

  $('.whyform .cancel').click(function(){
    $('.failbox').removeClass('show');
    $('.textarea').removeClass('error');
  })

  $('.failbox .mask').bind('touchstart', function(){
    $('.failbox').removeClass('show');
    $('.textarea').removeClass('error');
  })

  //提交回复
  $("#failedObj").bind("click", function(){
    var btn = $(this);
    if(btn.hasClass("disabled")) return;

    var textarea = $('.textarea'), val = textarea.val();
    if (val == "") {
      textarea.addClass('error').focus();
      return;
    }else {
      textarea.removeClass('error');
    }

    btn.addClass("disabled").text("正在提交");

    var data = [];
    data.push('id='+activeObj.attr('data-id'));
    data.push('content='+val);
    $.ajax({
      url: 'waimaiCommonReply.php?action=reply',
      data: data.join("&"),
      type: 'get',
      dataType: 'json',
      success: function(data){
        if(data && data.state == 100){
          activeObj.find(".state").addClass("ok").html('<p class="content">回复内容：'+val+'</p><p class="time">回复时间：刚刚</p><p class="btns"><a href="javascript:;" class="btn">已回复</a></p>');
          $('.failbox').removeClass('show');
        }else{
          alert(data.info);
        }
        btn.removeClass("disabled").text("确定");
      },
      error: function(){
        btn.removeClass("disabled").text("确定");
        alert("网络错误，提交失败！");
      }
    })

  });



})
