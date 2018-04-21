/**
 * 会员中心收藏列表
 * by guozi at: 20170207
 */

var objId = $("#list");
$(function(){

	if(state){
		$(".main-sub-tab li[data-id='"+state+"']").addClass("curr");
	}else{
		$(".main-sub-tab li:eq(0)").addClass("curr");
		state = $(".main-sub-tab li:eq(0)").data("id");
	}

	//状态切换
	$(".main-sub-tab li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr") && !t.hasClass("sel")){
			state = id;
			atpage = 1;
			t.addClass("curr").siblings("li").removeClass("curr");
			getList();
		}
	});

	getList(1);

	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('确定删除该条收藏记录？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=delCollect&id="+id,
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

});

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	state = state == undefined ? "" : state;

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=collectList&module="+module+"&temp="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [], durl = $(".main-sub-tab").data("url");

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var item    = [],
								id      = list[i].id,
								pubdate = list[i].pubdate;

							if(list[i].detail){
								var title = list[i].detail.title,
									url   = list[i].detail.url;

								html.push('<div class="item fn-clear" data-id="'+id+'">');
								html.push('<div class="o"><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');
								html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');
								html.push('<p>收藏时间：'+pubdate+'</p>');
								html.push('</div></div>');

							//信息不存在或已删除
							}else{
								html.push('<div class="item fn-clear" data-id="'+id+'">');
								html.push('<div class="o"><a href="javascript:;" class="del"><s></s>删除</a></div>');
								html.push('<div class="i">');
								html.push('<h5><del style="color:#ccc; font-weight: 500;">信息不存在或已经删除</del></h5>');
								html.push('<p>收藏时间：'+pubdate+'</p>');
								html.push('</div></div>');
							}

						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					totalCount = pageInfo.totalCount;

					showPageInfo();
				}
			}else{
				$('.main-sub-tab').hide();
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
