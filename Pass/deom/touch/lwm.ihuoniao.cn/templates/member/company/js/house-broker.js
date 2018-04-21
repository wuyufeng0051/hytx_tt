/**
 * 会员中心房产经纪人列表
 * by guozi at: 20160615
 */

var objId = $("#list");
$(function(){

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


	//操作
	objId.delegate(".edit", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr('data-id');
		if(t.hasClass("disabled")) return false;

		t.addClass("disabled");
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=house&action=zjUserList&u=1&userid="+id+"&comid="+comid,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {

				t.removeClass("disabled");

				if(data.state == 100 && data.info.pageInfo.totalCount == 1){

					var info = data.info.list[0];
					var content = [];
					content.push('<dl class="fn-clear"><dt>经纪人姓名：</dt><dd>'+info['nickname']+'</dd></dl>');
					content.push('<dl class="fn-clear"><dt>所在门店：</dt><dd>'+info['store']+'</dd></dl>');
					content.push('<dl class="fn-clear"><dt>服务区域：</dt><dd>'+info['address'][0]+' '+info['address'][1]+'</dd></dl>');
					if(info['community']){
						content.push('<dl class="fn-clear"><dt>主营小区：</dt><dd>'+info['communityName']+'</dd></dl>');
					}
					content.push('<dl class="fn-clear"><dt>名片：</dt><dd><a href="'+info['litpic']+'" target="_blank"><img src="'+info['litpic']+'" /></a></dd></dl>');
					content.push('<dl class="fn-clear"><dt>自我介绍：</dt><dd>'+info['note']+'</dd></dl><dl>&nbsp;</dl>');
					content.push('<dl class="fn-clear"><dt>审核：</dt><dd><label><input type="radio" name="state" value="1" checked /> 审核通过</label>&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="state" value="0" /> 等待审核</label>&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="state" value="2" /> 审核失败</label></dd></dl>');

					$.dialog({
						id: "chooseData",
						fixed: false,
						title: "经纪人信息",
						content: '<div class="editBroker">'+content.join("")+'</div>',
						width: 590,
						okVal: "确定",
						ok: function(){

	            //确定选择结果
							var state = parent.$("input[type=radio][name=state]:checked").val();
							$.ajax({
								url: masterDomain+"/include/ajax.php?service=house&action=updateBrokerState&id="+id+"&state="+state,
								type: "GET",
								dataType: "jsonp",
								success: function (data) {
									if(data && data.state != 200){
										getList();
									}else{
										$.dialog.alert("更新失败，请稍候重试！");
									}
								},
								error: function(){
									$.dialog.alert("网络错误，请稍候重试！");
								}
							});

						},
						cancelVal: "关闭",
						cancel: true
					});
				}else{
					$.dialog.alert("信息获取失败，请稍候重试！");
				}

			},
			error: function(){
				$.dialog.alert("网络错误，信息获取失败！");
			}
		});
	});


});

function getList(is){

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=house&action=zjUserList&u=1&comid="+comid+"&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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
									nickname  = list[i].nickname,
									store     = list[i].store,
									url       = list[i].url,
									photo     = list[i].photo,
									click     = list[i].click,
									saleCount = list[i].saleCount,
									zuCount   = list[i].zuCount,
									xzlCount  = list[i].xzlCount,
									spCount   = list[i].spCount,
									cfCount   = list[i].cfCount,
									pubdate   = huoniao.transTimes(list[i].pubdate, 1);

							html.push('<div class="item fn-clear" data-id="'+id+'">');
							if(photo != ""){
								html.push('<div class="p"><a href="'+url+'" target="_blank"><i></i><img src="'+huoniao.changeFileSize(photo, "middle")+'" /></a></div>');
							}
							html.push('<div class="o"><a href="javascript:" class="edit"><s></s>操作</a></div>');
							html.push('<div class="i">');

							var stateHtml = "";
							if(list[i].state == 0){
								stateHtml = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="gray">未审核</span>';
							}else if(list[i].state == 2){
								stateHtml = '&nbsp;&nbsp;·&nbsp;&nbsp;<span class="red">审核拒绝</span>';
							}

							html.push('<p>申请时间：'+pubdate+stateHtml+'</p>');
							html.push('<h5><a href="'+url+'" target="_blank" title="'+nickname+'">'+nickname+'</a><small> - '+store+'</small></h5>');

							html.push('<p>二手房：'+saleCount+'&nbsp;&nbsp;·&nbsp;&nbsp;出租房：'+zuCount+'&nbsp;&nbsp;·&nbsp;&nbsp;写字楼：'+xzlCount+'&nbsp;&nbsp;·&nbsp;&nbsp;商铺：'+spCount+'&nbsp;&nbsp;·&nbsp;&nbsp;厂房：'+cfCount+'&nbsp;&nbsp;·&nbsp;&nbsp;浏览：'+click+'次</p>');
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
							totalCount = pageInfo.state0;
							break;
						case "1":
							totalCount = pageInfo.state1;
							break;
						case "2":
							totalCount = pageInfo.state2;
							break;
					}

					$("#total").html(pageInfo.totalCount);
					$("#state0").html(pageInfo.state0);
					$("#state1").html(pageInfo.state1);
					$("#state2").html(pageInfo.state2);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
