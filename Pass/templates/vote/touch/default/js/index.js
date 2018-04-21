$(function(){
	// 判断设备类型，ios全屏
	var device = navigator.userAgent;
	if (device.indexOf('huoniao_iOS') > -1) {
		$('body').addClass('huoniao_iOS');
	}
	var objId = $('#listCon'), atpage = 1, totalPage = 1; pageSize = 4, isload = false;

	$('.module-tab a').click(function(){
		var t = $(this), id = t.attr('data-id');
		if (!t.hasClass('active')) {
			t.addClass('active').siblings('a').removeClass('active');
			atpage = 1;
		  getList();
		}
	})

  getList();

  function getList(){
      $(window).scrollTop(0);
      objId.html('<div class="loading">获取中，请稍后</div>');
			var state = $('.module-tab .active').attr('data-id');

      $.ajax({
          url: "/include/ajax.php?service=vote&action=vlist&page="+atpage+'&state='+state+'&pageSize='+pageSize,
          type: "GET",
          dataType: "jsonp",
          success: function (data) {
              if(data){
                  if(data.state == 100){
                      var list = data.info.list, html = [];
                      var pageInfo = data.info.pageInfo;
                      if(list.length > 0){
                          for(var i = 0; i < list.length; i++){
                              var obj = list[i], item = [], state = obj.state;
															var stateTxt, stateBtn, cla;
															if (state == 0) {
																stateTxt = stateBtn = '未开始';
																cla = ' overtime';
															}else if (state == 1 || state == 2) {
																stateTxt = '投票中';
																stateBtn = '我要投票';
																cla = '';
															}else {
																stateTxt = stateBtn = '已结束';
																cla = ' overtime';
															}
                              item.push('<div class="vote-item'+cla+'">');
                              var color = obj.color ? ' style="color:'+obj.color+'"' : '';
                              item.push('<a href="'+obj.url+'">');
															if (obj.litpic) {
																item.push('<div class="imgbox"><img src="'+obj.litpic+'" alt=""></div>');
															}
                              item.push('<div class="txtbox">');
                              item.push('<p class="title"'+color+'>'+obj.title+'</p>');
															var count = obj.usercount > 0 ? ('<em>'+obj.usercount+'</em>人参与') : '暂无选手';
                              item.push('<p class="info"><span class="state">'+stateTxt+'</span><span class="amount">'+count+'</span></p>');
                            	item.push('<p class="time">开始时间：'+obj.beganf+'</p>');
                            	item.push('<p class="time">结束时间：'+obj.endf+'</p>');
															item.push('<span class="btn">'+stateBtn+'</span>');
															if (state == 3) {
																item.push('<span class="tag"></span>');
															}
															item.push('</div>');
                              item.push('</a>');
                              item.push('</div>');

                              html.push(item.join(""));
                          }

                          objId.html(html.join(""));
                          totalPage = pageInfo.totalPage;
                          $('.fanye').show().find('.page').html(pageInfo.page+'/'+totalPage);
													isload = false;
                      }else{
                          objId.html('<div class="loading">暂无相关信息！</div>');
                          $('#count').text('(0)')
                          $('.fanye').hide();
													isload = false;
                      }
                  }else{
                      objId.html('<div class="loading">暂无相关信息！</div>');
                      $('#count').text('(0)')
                      $('.fanye').hide();
											isload = false;
                  }
              }
          },
          error: function(){
              isload = false;
          }
      })
  }
	// 上拉加载
	$(window).scroll(function() {
		var allh = $('.vote-list').height();
		var w = $(window).height();
		var scroll = allh  - w;
		if ($(window).scrollTop() > scroll && !isload) {
				atpage++;
				load();
		};
	});

	function load(){
			objId.append('<div class="loading">获取中，请稍后</div>');
			var state = $('.module-tab .active').attr('data-id');

			$.ajax({
					url: "/include/ajax.php?service=vote&action=vlist&page="+atpage+'&state='+state+'&pageSize='+pageSize,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
							if(data){
									if(data.state == 100){
										isload = true;
										$('.loading').remove();
											var list = data.info.list, html = [];
											var pageInfo = data.info.pageInfo;
											if(list.length > 0){
													for(var i = 0; i < list.length; i++){
															var obj = list[i], item = [], state = obj.state;
															var stateTxt, stateBtn, cla;
															if (state == 0) {
																stateTxt = stateBtn = '未开始';
																cla = ' overtime';
															}else if (state == 1 || state == 2) {
																stateTxt = '投票中';
																stateBtn = '我要投票';
																cla = '';
															}else {
																stateTxt = stateBtn = '已结束';
																cla = ' overtime';
															}
															item.push('<div class="vote-item'+cla+'">');
															var color = obj.color ? ' style="color:'+obj.color+'"' : '';
															item.push('<a href="'+obj.url+'">');
															if (obj.litpic) {
																item.push('<div class="imgbox"><img src="'+obj.litpic+'" alt=""></div>');
															}
															item.push('<div class="txtbox">');
															item.push('<p class="title"'+color+'>'+obj.title+'</p>');
															var count = obj.usercount > 0 ? ('<em>'+obj.usercount+'</em>人参与') : '暂无选手';
															item.push('<p class="info"><span class="state">'+stateTxt+'</span><span class="amount">'+count+'</span></p>');
															item.push('<p class="time">开始时间：'+obj.beganf+'</p>');
															item.push('<p class="time">结束时间：'+obj.endf+'</p>');
															item.push('<span class="btn">'+stateBtn+'</span>');
															if (state == 3) {
																item.push('<span class="tag"></span>');
															}
															item.push('</div>');
															item.push('</a>');
															item.push('</div>');

															html.push(item.join(""));
													}

													objId.append(html.join(""));
													totalPage = pageInfo.totalPage;
													$('.fanye').show().find('.page').html(pageInfo.page+'/'+totalPage);
													if(atpage >= totalPage){
														isload = false;
													}else{
														isload = true;
													}
											}else{
													objId.append('<div class="loading">已经到底了！</div>');
													$('#count').text('(0)')
													$('.fanye').hide();
													isload = true;
											}
									}else{
											objId.html('<div class="loading">暂无相关信息！</div>');
											$('#count').text('(0)')
											$('.fanye').hide();
											isload = true;
									}
							}
					},
					error: function(){
							isload = false;
					}
			})
	}

})
