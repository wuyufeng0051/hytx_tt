/**
 * 会员中心招聘面试邀请列表
 * by guozi at: 20160527
 */

var objId = $(".list"), lei = 0, isload = false;
$(function(){

	//导航
	$('.header-r .screen').click(function(){
		var nav = $('.nav'), t = $('.nav').css('display') == "none";
		if (t) {nav.show();}else{nav.hide();}
	})


	//类型切换
	$(".tab .type").bind("click", function(){
		var t = $(this), id = t.attr("data-id"), index = t.index();
		if(!t.hasClass("curr")){
			isload = false;
			lei = id;
			atpage = 1;
			$('.count li').eq(index).show().siblings("li").hide();
			t.addClass("curr").siblings("li").removeClass("curr");
			objId.html('');
			getList(1);
		}
	});

	getList(1);

	// 下拉加载
	$(window).scroll(function() {
		var h = $('.item').height();
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - w - h;
		if ($(window).scrollTop() > scroll && !isload) {
			atpage++;
			getList();
		};
	});




	//标记
  objId.delegate(".select ", "change", function(){

		var id = $(this).closest(".item").attr("data-id");
        var state = $(this).val();

		$.ajax({
			url: masterDomain + "/include/ajax.php?service=job&action=invitationUpdate&id="+id+"&state="+state,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data.state == 100){
					objId.html('');
					getList();
				}else{
					alert(data.info);
				}
			},
			error: function(){
				alert('网络错误，请刷新重试！');
			}
		});
	});


});

function getList(is){
	if(isload) return;
	isload = true;

	if(is != 1){
		// $('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.append('<p class="loading">加载中，请稍候...</p>');

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=job&action=invitationList&type=person&state="+lei+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];
					var totalCount = 0;
					switch(parseInt(lei)){
						case "":
							totalCount = pageInfo.totalCount;
							break;
						case 0:
							totalCount = pageInfo.state0;
							break;
						case 1:
							totalCount = pageInfo.state1;
							break;
						case 2:
							totalCount = pageInfo.state2;
							break;
					}

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var item  = [],
								id    = list[i].id,
								post  = list[i].post,
								state = list[i].state,
								date  = list[i].date;

							html.push('<div class="item" data-id="'+id+'">');
							html.push('<div class="txtbox">');
              				html.push('<a href="'+post['url']+'">');
							html.push('<p class="name">'+post['title']+'</p>');
							html.push('<p class="company">'+post['company']+'</p>');
							html.push('<p class="date">'+date+'</p>');
							html.push('</a>');
							html.push('</div>');
							html.push('<div class="btnbox">');

							var states = "";
							switch (state) {
								case "0":
									states = "待处理";
									break;
								case "1":
									states = "已面试";
									break;
								case "2":
									states = "不合适";
									break;
							}
							html.push('<div class="state">'+states+'</div>');
							html.push('<span class="link">标记');
							html.push('<select class="select">');
							html.push('<option value="">请选择</option>');
							html.push('<option value="0">待处理</option>');
							html.push('<option value="1">已面试</option>');
							html.push('<option value="2">不合适</option>');
							html.push('</select>');
							html.push('</span>');
							html.push('</div>');
							html.push('</div>');
						}

			            $('.loading').remove();
			            objId.append(html.join(""));

			            isload = false;
					}else{
						$('.loading').remove();
						objId.append("<p class='loading'>"+(totalCount == 0 ? "暂无信息！" : "已加载完全部信息！")+"</p>");
					}

					$("#state0").html(pageInfo.state0);
					$("#state1").html(pageInfo.state1);
					$("#state2").html(pageInfo.state2);
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
				isload = false;
			}
		}
	});
}
