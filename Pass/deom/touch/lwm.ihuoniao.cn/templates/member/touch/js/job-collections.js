
var objId = $(".list"), isload = false;
$(function(){

	getList(1);

	//导航
	$('.header-r .screen').click(function(){
		var nav = $('.nav'), t = $('.nav').css('display') == "none";
    	if (t) {nav.show();}else{nav.hide();}
	})

	//全选
	$("#selectAll").bind("click", function(){
		$(this).hasClass('on') ? $(".inp").removeClass('on') : $(".inp").addClass('on');
	});

	//选中
	$(".list").delegate(".inp", "click", function(){
		$(this).toggleClass('on');
	});

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

	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			if(confirm('您确定要删除选中的信息吗？')){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=collect&module=job&temp=job&type=del&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){

							//删除成功后移除信息层并异步获取最新列表
							par.remove();
							setTimeout(function(){getList(1);}, 200);

						}else{
							alert(data.info);
							t.siblings("a").show();
							t.removeClass("load");
						}
					},
					error: function(){
						alert("网络错误，请稍候重试！");
						t.siblings("a").show();
						t.removeClass("load");
					}
				});
  		}
    }
	});

	//删除
	$(".delSelect").bind("click", function(){
		var id = [];
		$(".list .inp").each(function(){
			$(this).hasClass("on") ? id.push($(this).closest('.item').attr('data-id')) : "";
		});
		if(id.length > 0){
			if(confirm('您确定要删除选中的信息吗？')){
				$.ajax({
					url: masterDomain+"/include/ajax.php?service=member&action=collect&module=job&temp=job&type=del&id="+id.join(","),
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							getList(1);
						}else{
							alert(data.info);
						}
					},
					error: function(){
						alert("网络错误，请稍候重试！");
					}
				});
			};
		}else{
			alert("您还没有选中任何职位！");
		}
	});
})

function getList(is){
	if(isload) return;

	isload = true;

	if(is == 1){
		objId.html('<p class="loading">加载中，请稍候...</p>');
		// $('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}else{
		objId.append('<p class="loading">加载中，请稍候...</p>');
	}
	// $(".opera").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=member&action=collectList&module=job&temp=job&page="+atpage+'pageSize='+pageSize,
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
              				var pic = hideFileUrl ? list[i]['detail']['company'].logoSource : list[i]['detail']['company'].logo;
							pic = pic == '' ? '/static/images/blank.gif' : pic;
							html.push('<div class="item" data-id="'+list[i].aid+'">');

                			html.push('<div class="checkbox fn-clear"><em href="javascript:;" class="inp"></em><em href="javascript:;" class="del">删除</em></div>')

							html.push('<a href="'+list[i]['detail'].url+'" class="fn-clear">');
							html.push('<div class="img-box fn-left">');
							html.push('<img src="'+pic+'" alt="">');
							html.push('</div>');
							html.push('<div class="img-txt fn-left">');
							html.push('<h3>'+list[i]['detail'].title+'<em class="fn-right">'+list[i]['detail'].salary+'</em></h3>');
							html.push('<p>'+list[i]['detail']['company']['title']+'</p>');
							html.push('<p class="grey area"><span>'+list[i]['detail']['addr'][0]+'</span><span>'+list[i]['detail']['addr'][1]+'</span><span>'+list[i]['detail'].experience+'</span><span>'+list[i]['detail'].educational+'</span><em class="fn-right time">'+list[i]['detail'].timeUpdate+'</em></p>');
							html.push('<p class="grey info"><span>'+list[i]['detail']['company']['nature']+'</span><em>|</em><span>'+list[i]['detail']['company']['scale']+'</span><em>|</em><span>'+list[i]['detail']['company']['industry'][1]+'</span></p>');
							html.push('</div>');
							html.push('</a>');
							html.push('</div>');

						}

              			$('.loading').remove();
              			objId.append(html.join(""));
						isload = false;

					}else{
						$('.loading').remove();
						objId.append("<p class='loading'>已加载完信息！</p>");
					}

					// totalCount = pageInfo.totalCount;
					// $("#total").html(pageInfo.totalCount);
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
