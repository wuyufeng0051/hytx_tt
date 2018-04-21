/**
 * 会员中心活动管理列表
 * by guozi at: 20161228
 */

var objId = $("#list");
$(function(){

  //项目
	$(".tab .type").bind("click", function(){
		var t = $(this), id = t.attr("data-id"), index = t.index();
		if(!t.hasClass("curr") && !t.hasClass("sel")){
			state = id;
			atpage = 1;
      $('.count li').eq(index).show().siblings("li").hide();
			t.addClass("curr").siblings("li").removeClass("curr");
      $('#list').html('');
			getList(1);
		}
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



	getList(1);

	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			if(confirm('你确定要删除这条信息吗？')){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=huodong&action=del&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){

							//删除成功后移除信息层并异步获取最新列表
							par.slideUp(300, function(){
								par.remove();
								setTimeout(function(){$('#list').html("");getList(1);}, 200);
							});

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
			};
		}
	});

});

var uploadErrorInfo = [],
	huoniao = {

    changeFileSize: function(url, to, from){
    		if(url == "" || url == undefined) return "";
    		if(to == "") return url;
    		var from = (from == "" || from == undefined) ? "large" : from;
    		var newUrl = "";
    		if(hideFileUrl == 1){
    			newUrl =  url + "&type=" + to;
    		}else{
    			newUrl = url.replace(from, to);
    		}

    		return newUrl;

    	}
    }


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

  isload = true;


	if(is != 1){
	// 	$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.append('<p class="loading">加载中，请稍候...</p>');

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=huodong&action=hlist&u=1&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
          objId.html("<p class='loading'>暂无相关信息！</p>");
          $('.count span').text(0);
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){

						var editUrl = $(".tab ul").data("url"), regUrl = $(".tab ul").data("reg");

						for(var i = 0; i < list.length; i++){
							var item     = [],
								id       = list[i].id,
								title    = list[i].title,
								litpic   = huoniao.changeFileSize(list[i].litpic, "middle"),
								typename = list[i].typename.join("-"),
								url      = list[i].url,
								click    = list[i].click,
								reg      = list[i].reg,
								began    = transTimes(list[i].began, 1),
								end      = transTimes(list[i].end, 1),
								feetype  = list[i].feetype,
								reply    = list[i].reply,
								waitpay  = list[i].waitpay,
								pubdate  = transTimes(list[i].pubdate, 1);

							url = waitpay == "1" || list[i].state != "1" ? 'javascript:;' : url;

              html.push('<div class="item" data-id="'+id+'">');
              var arcrank = "";
							if(list[i].state == "0"){
								arcrank = '<em class="fn-right gray">未审核</em>';
							}else if(list[i].state == "2"){
								arcrank = '<em class="fn-right red">审核拒绝</em>';
							}
							html.push('<div class="title">'+typename+arcrank+'</div>');
							html.push('<div class="info-item fn-clear">');
							if(litpic != "" && litpic != undefined){
								html.push('<div class="info-img fn-left"><a href="'+url+'"><img src="'+litpic+'" /></a></div>');
							}
							html.push('<dl>');
              var type = "";
							if(feetype == "1"){
								type = '<em class="fn-right" style="background: #f66; color:#fff; padding: 0 .1rem; margin: .05rem 0 0 .2rem; font-size: .22rem; font-weight: 500; border-radius: .04rem">收费</em>';
							}else{
								type = '<em class="fn-right" style="background: #66a3ff; color:#fff; padding: 0 .1rem; margin: .05rem 0 0 .2rem; font-size: .22rem; font-weight: 500; border-radius: .04rem">免费</em>';
							}
							html.push('<dt class="fn-clear"><a href="'+url+'">'+title+'</a>'+type+'</dt>');
							html.push('<dd class="item-area"><em>报名：'+reg+'人</em><em> 浏览：'+click+'次 </em><em>评论：'+reply+'条</em></dd>');
							html.push('<dd class="item-type-1"><em> 发布时间：'+pubdate+'</em></dd>');
							html.push('<dd class="item-type-2">时间：'+began+'&nbsp;至&nbsp;'+end+'</dd>');
							html.push('</dl>');
							html.push('</div>');
							html.push('<div class="o fn-clear">');
							if(waitpay == "1"){
                html.push('<a href="javascript:;" class="delayPay">支付</a><a href="javascript:;" class="del">删除</a>');
              }else{
	              if(reg > 0){
									html.push('<a href="'+regUrl.replace("%id", id)+'" class="reg">报名管理</a>');
								}
								html.push('<a href="'+editUrl.replace("%id", id)+'" class="edit">编辑</a>');
	              if(reg <= 0){
									html.push('<a href="javascript:;" class="del">删除</a>');
								}
							}
							html.push('</div>');
							html.push('</div>');
							html.push('</div>');

						}

            objId.append(html.join(""));
            $('.loading').remove();
            isload = false;

					}else{
            $('.loading').remove();
            objId.append("<p class='loading'>已加载完全部信息！</p>");
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
					// showPageInfo();
				}
			}else{
        objId.html("<p class='loading'>暂无相关信息！</p>");
        $('.count span').text(0);
			}
		}
	});
}
