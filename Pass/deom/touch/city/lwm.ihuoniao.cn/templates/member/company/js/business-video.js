/**
 * 会员中心商家视频
 * by guozi at: 20170328
 */

var objId = $("#list");
$(function(){

	getList();

	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm("确认要删除吗？", function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=business&action=delvideo&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							setTimeout(function(){getList();}, 500);
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

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=business&action=video&u=1&page="+atpage+"&pageSize="+pageSize,
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

						var t = window.location.href.indexOf(".html") > -1 ? "?" : "&";
						var param = t + "id=";
						var urlString = editUrl + param;

						for(var i = 0; i < list.length; i++){
							var item   = [],
								id     = list[i].id,
								title  = list[i].title,
								litpic  = list[i].litpic,
								click   = list[i].click,
								url     = list[i].url,
								pubdate = huoniao.transTimes(list[i].pubdate, 1);

							html.push('<div class="item fn-clear" data-id="'+id+'">');

							if(litpic){
								html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(litpic, "small")+'" /></a></div>');
							}

							html.push('<div class="o"><a href="'+urlString+id+'" class="edit"><s></s>编辑</a>');
							html.push('<a href="javascript:;" class="del"><s></s>删除</a>');
							html.push('</div>');
							html.push('<div class="i">');

							html.push('<h5><a href="'+url+'" target="_blank">'+title+'</a></h5>');

							html.push('<p>浏览：'+click+'&nbsp;&nbsp;·&nbsp;&nbsp;添加时间：'+pubdate+'</p>');
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
