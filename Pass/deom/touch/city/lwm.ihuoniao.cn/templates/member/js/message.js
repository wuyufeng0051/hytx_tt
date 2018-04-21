/**
 * 会员中心站内消息列表
 * by guozi at: 20151224
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


	//全选
	$("#selectAll").bind("click", function(){
		$(this).is(":checked") ? $("#list input").attr("checked", true) : $("#list input").attr("checked", false);
	});


	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('您确定要删除选中的消息吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=delMessage&id="+id,
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


	//删除
	$(".delSelect").bind("click", function(){
		var id = [];
		$("#list input").each(function(){
			$(this).is(":checked") ? id.push($(this).val()) : "";
		});

		if(id){
			$.dialog.confirm('您确定要删除选中的消息吗？', function(){

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=delMessage&id="+id.join(","),
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							getList(1);
						}else{
							$.dialog.alert(data.info);
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
					}
				});
			});
		}
	});


	//设为已读
	$(".readSelect").bind("click", function(){
		var id = [];
		$("#list input").each(function(){
			$(this).is(":checked") ? id.push($(this).val()) : "";
		});

		if(id){
			$.dialog.confirm('您确定要标记选中的消息为已读吗？', function(){

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=setMessageRead&id="+id.join(","),
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							getList(1);
						}else{
							$.dialog.alert(data.info);
						}
					},
					error: function(){
						$.dialog.alert("网络错误，请稍候重试！");
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
	$(".opera").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=message&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
					$('.pagination').hide();
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var item  = [],
									id    = list[i].id,
									title = list[i].title,
									state = list[i].state,
									date  = list[i].date;

							var detailUrl = url.replace("%id", id);
							var status = state == 0 ? "未读" : "已读";
							var isread = state == 0 ? "unread" : "read";

							html.push('<div class="item fn-clear '+isread+'" data-id="'+id+'">');
							html.push('<input class="checkbox" type="checkbox" value="'+id+'" />');
							html.push('<div class="o"><a href="javascript:;" class="del"><s></s>删除</a></div>');
							html.push('<div class="i">');
							html.push('<h5><a href="'+detailUrl+'" target="_blank" title="'+title+'">'+title+'</a></h5>');
							html.push('<p>发送时间：'+date+'&nbsp;&nbsp;·&nbsp;&nbsp;状态：'+status+'</p>');
							html.push('</div></div>');

						}

						objId.html(html.join(""));
						$(".opera").show();

						switch(state){
							case "":
								totalCount = pageInfo.totalCount;
								break;
							case "0":
								totalCount = pageInfo.unread;
								break;
							case "1":
								totalCount = pageInfo.read;
								break;
						}


						$("#total").html(pageInfo.totalCount);
						$("#unread").html(pageInfo.unread);
						$("#read").html(pageInfo.read);

						showPageInfo();

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
						$('.pagination').hide();
					}


				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
				$('.pagination').hide();
			}
		}
	});
}