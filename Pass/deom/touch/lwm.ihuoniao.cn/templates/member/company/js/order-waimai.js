/**
 * 会员中心商城订单
 * by guozi at: 20150928
 */

var objId = $("#list");
$(function(){

	state = state == "" ? 1 : state;
	$(".nav-tabs li[data-id='"+state+"']").addClass("active");

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


	//送餐
	var songObjPopup;
	objId.delegate(".song", "click", function(){
		var t = $(this), id = t.closest("table").attr("data-id");
		if(id){
			songObjPopup = $.dialog({
				id: "songObj",
				title: "送餐备注",
				content: "<input type='text' id='songNote' value='送餐电话：' />",
				width: 360,
				ok: function(){
					var songNote = self.parent.$("#songNote").val();
					$.ajax({
						url: "/include/ajax.php?service=waimai&action=peisongOrder",
						data: "id="+id+"&songNote="+encodeURIComponent(songNote),
						type: "POST",
						dataType: "json",
						success: function(data){
							if(data && data.state == 100){
								songObjPopup.close();
								getList();
							}else{
								alert(data.info);
							}
						}
					});
					return false;
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
		url: masterDomain+"/include/ajax.php?service=waimai&action=order&store=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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
							var item      = [],
								id        = list[i].id,
								ordernum  = list[i].ordernum,
								state     = list[i].state,
								orderdate = huoniao.transTimes(list[i].orderdate, 1),
								price     = parseFloat(list[i].price),
								paytype   = list[i].paytype,
								peisong   = parseFloat(list[i].peisong),
								offer     = parseFloat(list[i].offer),
								note      = list[i].note;
								menus     = list[i].menus;

							var stateInfo = btn = "";

							switch(state){
								case "1":
									stateInfo = "<span class='state1'>待发货</span>";
									btn = '<div><a href="javascript:;" class="btn song">送餐</a></div>';
									break;
								case "3":
									stateInfo = "<span class='state3'>交易成功</span>";
									break;
							}

							html.push('<table data-id="'+id+'"><colgroup><col style="width:30%;"><col style="width:10%;"><col style="width:10%;"><col style="width:10%;"><col style="width:10%;"><col style="width:18%;"><col style="width:12%;"></colgroup>');
							html.push('<thead><tr class="placeh"><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td colspan="6">');
							html.push('<span class="dealtime" title="'+orderdate+'">'+orderdate+'</span>');
							html.push('<span class="number">订单号：'+ordernum+'</span>');
							html.push('<span class="number">备注：'+note+'</span>');
							html.push('</td>');
							html.push('<td colspan="1"></td></tr></thead>');
							html.push('<tbody>');

							for(var p = 0; p < menus.length; p++){
								cla = p == menus.length - 1 ? ' class="lt"' : "";
								html.push('<tr'+cla+'>');
								html.push('<td class="nb"><div class="info">'+menus[p].pname+'</div></td>');
								html.push('<td class="nb">'+menus[p].price+'</td>');
								html.push('<td>'+menus[p].count+'</td>');

								if(p == 0){
									html.push('<td class="bf" rowspan="'+menus.length+'">'+peisong+'</td>');
									html.push('<td class="bf" rowspan="'+menus.length+'">'+offer+'</td>');
									html.push('<td class="bf" rowspan="'+menus.length+'"><strong>'+(price+peisong-offer).toFixed(2)+'</strong></td>');
									html.push('<td class="bf nb" rowspan="'+menus.length+'">'+btn+'</td>');
								}
								html.push('</tr>');
							}

							html.push('</tbody>');

						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					totalCount = pageInfo.state1;
					switch(state){
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


					$("#state1").html(pageInfo.state1);
					$("#state2").html(pageInfo.state2);
					$("#state3").html(pageInfo.state3);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
