/**
 * 会员中心商城订单
 * by guozi at: 20150928
 */

var objId = $("#list");
$(function(){

	$(".nav-tabs li:first").addClass("active");
	state = $(".nav-tabs li:first").data("id");

	$(".nav-tabs li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("active") && !t.hasClass("add")){
			state = id;
			atpage = 1;
			t.addClass("active").siblings("li").removeClass("active");
			getList();
		}
	});

	getList(1);

	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest("tr"), id = par.attr("data-id");
		if(id){
			$.dialog.confirm(langData['siteConfig'][20][543], function(){

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=job&action=delPost&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state != 200){

							//删除成功后移除信息层并异步获取最新列表
							par.slideUp(300, function(){
								par.remove();

								setTimeout(function(){getList(1);}, 200);
							});

						}else{
							$.dialog.alert(data.info);
						}
					},
					error: function(){
						$.dialog.alert(langData['siteConfig'][20][183]);
					}
				});
			});
		}
	});

});


function getList(is){

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />'+langData['siteConfig'][20][184]+'...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=job&action=post&com=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>"+data.info+"</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){

							html.push('<tr data-id="'+list[i].id+'"><td class="tit"><a href="'+list[i]['url']+'" target="_blank">'+list[i].title+'</a></td>');
							html.push('<td>'+list[i].delivery+'</td>');
							html.push('<td>'+huoniao.transTimes(list[i].pubdate, 1)+'</td>');
							html.push('<td>'+huoniao.transTimes(list[i].valid, 2)+'</td>');

							var states = "";
							switch (list[i].state) {
								case "0":
									states = langData['siteConfig'][19][556];
									break;
								case "1":
									states = langData['siteConfig'][19][392];
									break;
								case "2":
									states = langData['siteConfig'][23][101];
									break;
								case "3":
									states = langData['siteConfig'][9][29];
									break;
							}
							html.push('<td>'+states+'</td>');
							html.push('<td><a href="'+editUrl.replace("%id%", list[i].id)+'" class="edit">'+langData['siteConfig'][6][4]+'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="del">'+langData['siteConfig'][6][8]+'</a></td>');

						}

						objId.html('<table><colgroup><col style="width:38%;"><col style="width:7%;"><col style="width:17%;"><col style="width:10%;"><col style="width:16%;"><col style="width:12%;"></colgroup><tbody>'+html.join("")+'</tbody></table>');

					}else{
						objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
					}

					switch(state){
						case "":
							totalCount = pageInfo.totalCount;
							break;
						case "0":
							totalCount = pageInfo.state0;
							break;
						case "1":
							totalCount = pageInfo.state1;
							break;
						case "2":
							totalCount = pageInfo.state2;
							break;
						case "3":
							totalCount = pageInfo.state3;
							break;
					}


					$("#totalCount").html(pageInfo.totalCount);
					$("#state0").html(pageInfo.state0);
					$("#state1").html(pageInfo.state1);
					$("#state2").html(pageInfo.state2);
					$("#state3").html(pageInfo.state3);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
			}
		}
	});
}