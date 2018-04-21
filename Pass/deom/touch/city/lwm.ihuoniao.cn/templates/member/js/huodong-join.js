/**
 * 会员中心我参与的活动
 * by guozi at: 20161229
 */

var objId = $("#list");
$(function(){

	getList(1);

	//取消报名
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm('你确定要取消吗？', function(){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=huodong&action=cancelJoin&id="+id,
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



function transTimes(timestamp, n){
	update = new Date(timestamp*1000);//时间戳要乘1000
	year   = update.getFullYear();
	month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
	day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
	hour   = (update.getHours()<10)?('0'+update.getHours()):(update.getHours());
	minute = (update.getMinutes()<10)?('0'+update.getMinutes()):(update.getMinutes());
	second = (update.getSeconds()<10)?('0'+update.getSeconds()):(update.getSeconds());
	if(n == 1){
		return (month+'-'+day+' '+hour+':'+minute);
	}else{
		return 0;
	}
}

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=huodong&action=joinList&page="+atpage+"&pageSize="+pageSize,
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
								litpic   = huoniao.changeFileSize(list[i].litpic, "middle"),
								url      = list[i].url,
								addrname = list[i].addrname,
								address  = list[i].address,
								going    = list[i].going,
								began    = transTimes(list[i].began, 1),
								date     = huoniao.transTimes(list[i].date, 1);

							html.push('<div class="item fn-clear" data-id="'+id+'">');
							if(litpic){
								html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+litpic+'"></a></div>');
							}
							var state = '&nbsp;&nbsp;·&nbsp;&nbsp;<font color="red">活动已结束</font>';
							if(going){
								html.push('<div class="o">');
								html.push('<a href="javascript:;" class="del"><s></s>取消报名</a>');
								html.push('</div>');
								state = '&nbsp;&nbsp;·&nbsp;&nbsp;<font color="#0eabee">活动进行中</font>';
							}
							html.push('<div class="i">');
							html.push('<p>报名时间：'+date+state+'</p>');
							html.push('<h5><a href="'+url+'" target="_blank" title="'+title+'">'+title+'</a></h5>');
							html.push('<p>开始时间：'+began+'&nbsp;&nbsp;·&nbsp;&nbsp;地址：'+addrname[0]+' '+addrname[1]+' '+address+'</p>');
							html.push('</div>');
							html.push('</div>');

						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					$("#total").html(pageInfo.totalCount);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
