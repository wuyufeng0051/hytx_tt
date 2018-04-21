/**
 * 会员中心贴吧帖子列表
 * by guozi at: 20161124
 */

var objId = $("#list");
$(function(){

	$(".main-tab li[data-id='"+state+"']").addClass("curr");

	$(".main-tab li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr") && !t.hasClass("add")){
			state = id;
			atpage = 1;
			t.addClass("curr").siblings("li").removeClass("curr");
			getList();
		}
	});

	getList(1);

	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('你确定要删除这条信息吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=tieba&action=del&id="+id,
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

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=tieba&action=tlist&u=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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
								title    = list[i].title,
								color    = list[i].color,
								typename = list[i].typename.join("-"),
								url      = list[i].url,
								bold     = list[i].bold,
								jinghua  = list[i].jinghua,
								top      = list[i].top,
								click    = list[i].click,
								reply    = list[i].reply,
								pubdate  = huoniao.transTimes(list[i].pubdate, 1);

							html.push('<div class="item fn-clear" data-id="'+id+'">');
							html.push('<div class="o"><a href="javascript:;" class="del"><s></s>删除</a></div>');
							html.push('<div class="i">');

							var arcrank = "";
							if(list[i].state == "0"){
								arcrank = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
							}else if(list[i].state == "2"){
								arcrank = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
							}

							html.push('<p>分类：'+typename+'&nbsp;&nbsp;·&nbsp;&nbsp;发布时间：'+pubdate+arcrank+'</p>');
							html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'" style="color:'+color+';">'+title+'</a></h5>');

							var apa = [];
							if(top == 1){
								apa.push('<span style="background: #66a3ff; color:#fff; padding: 0 5px; margin-left: 10px;">置顶</span>');
							}
							if(jinghua == 1){
								apa.push('<span style="background: #f66; color:#fff; padding: 0 5px; margin-left: 10px;">精华</span>');
							}

							html.push('<p>浏览：'+click+'次&nbsp;&nbsp;·&nbsp;&nbsp;评论：'+reply+'条'+apa.join("")+'</p>');
							html.push('</div>');
							html.push('</div>');

						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					switch(state){
						case "":
							totalCount = pageInfo.totalCount;
							break;
						case "0":
							totalCount = pageInfo.gray;
							break;
						case "1":
							totalCount = pageInfo.audit;
							break;
						case "2":
							totalCount = pageInfo.refuse;
							break;
					}


					$("#total").html(pageInfo.totalCount);
					$("#audit").html(pageInfo.audit);
					$("#gray").html(pageInfo.gray);
					$("#refuse").html(pageInfo.refuse);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
