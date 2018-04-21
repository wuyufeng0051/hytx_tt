/**
 * 会员中心商家点评
 * by guozi at: 20170328
 */

var objId = $("#list");
$(function(){

	getList(1);

	//删除点评
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('你确定要删除吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=business&action=delComment&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){

							//删除成功后移除信息层并异步获取最新列表
							par.slideUp(300, function(){
								par.remove();

								setTimeout(function(){getList(1);}, 200);
							});

						}else{
							$.dialog.alert(data.info);
							t.siblings("a").show();
							t.removeClass("load");
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
						t.siblings("a").show();
						t.removeClass("load");
					}
				});
			});
		}
	});

	//回复点评
	objId.delegate(".reg", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id"), reply = par.attr("data-reply");
		if(id){

			$.dialog({
				fixed: true,
				title: '回复点评',
				content: '<textarea id="reply" name="reply" style="width:480px; padding: 3px 5px; height:100px;">'+reply+'</textarea>',
				width: 500,
				ok: function(){
					//提交
					var newReply = $.trim(self.parent.$("#reply").val());

					$.ajax({
						url: masterDomain+"/include/ajax.php?service=business&action=replyComment&id="+id+"&reply="+newReply,
						type: "GET",
						dataType: "jsonp",
						success: function (data) {
							if(data && data.state == 100){
								par.attr("data-reply", newReply);
								par.find("h6 span").html(newReply);
							}else{
								$.dialog.alert(data.info);
							}
						},
						error: function(){
							$.dialog.alert("网络错误，请稍候重试！");
						}
					});

				},
				cancel: true
			});

		}
	});

});



function getList(is){

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=business&action=comment&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){

						for(var i = 0; i < list.length; i++){
							var item     = [],
								id       = list[i].id,
								username = list[i].username,
								rating   = list[i].rating,
								content  = list[i].content,
								dtime    = huoniao.transTimes(list[i].dtime, 1),
								ip       = list[i].ip,
								ipaddr   = list[i].ipaddr,
								reply    = list[i].reply,
								rtime    = huoniao.transTimes(list[i].rtime, 1);

							html.push('<div class="item fn-clear" data-id="'+id+'" data-reply="'+(reply ? reply : "")+'">');
							html.push('<div class="o">');
							html.push('<a href="javascript:;" class="reg"><s></s>回复</a>');
							html.push('<a href="javascript:;" class="del"><s></s>删除</a>');
							html.push('</div>');
							html.push('<div class="i">');
							html.push('<p>点评会员：'+username+'&nbsp;&nbsp;&nbsp;评分：'+rating+'星</p>');
							html.push('<h5>'+content+'</h5>');
							if(reply){
								html.push('<h6 style="font-size: 14px; color: red; margin: -5px 0 5px;">回复：<span>'+reply+'</span>&nbsp;&nbsp;<small>'+rtime+'</small></h6>');
							}
							html.push('<p>IP：'+ip+'('+ipaddr+')&nbsp;&nbsp;·&nbsp;&nbsp;时间：'+dtime+'</p>');
							html.push('</div>');
							html.push('</div>');

						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					$("#total").html(pageInfo.totalCount);
					totalCount = pageInfo.totalCount;
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}