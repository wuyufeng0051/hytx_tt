/**
 * 会员中心商城订单列表
 * by guozi at: 20151130
 */

var objId = $("#list");
$(function(){



	//状态切换
	$(".tab ul li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr") && !t.hasClass("sel")){
			state = id;
			atpage = 1;
			t.addClass("curr").siblings("li").removeClass("curr");
      		objId.html('');
			getList();
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

	getList();

	// 删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			if(confirm('确定删除订单？删除后本订单将从订单列表消失，且不能恢复。')){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=waimai&action=delOrder&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){

							//删除成功后移除信息层并异步获取最新列表
							location.reload();
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

	// 取消
	objId.delegate(".cancel", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			if(confirm('确定取消该订单？')){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=waimai&action=cancelOrder&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){

							//取消成功后移除信息层并异步获取最新列表
							location.reload();
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

function getList(is){

  isload = true;

	if(is != 1){
		// $('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.append('<p class="loading">加载中，请稍候...</p>');
	$(".pagination").hide();

	var num = $('.tab li.curr span').text();
	var msg = num == '0' ? '暂无相关信息！' : '已加载完全部信息！';

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=waimai&action=order&userid="+userid+"&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					$('.loading').remove();
					objId.append("<p class='loading'>"+msg+"</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var item     = [],
								amount   = list[i].amount,
								food     = list[i].food,
								id       = list[i].id,
								ordernum = list[i].ordernumstore ? list[i].ordernumstore : list[i].ordernum,
								paytype  = list[i].paytype,
								pubdate  = huoniao.transTimes(list[i].pubdate, 1),
								paydate  = huoniao.transTimes(list[i].paydate, 1),
								shopname = list[i].shopname,
								sid      = list[i].sid,
								state    = list[i].state,
								uid      = list[i].uid,
								username = list[i].username,
								payurl   = list[i].payurl;

		                  var stateInfo = btn = "";
		                  switch(state){
		                    case "0":
		                      stateInfo = '<em class="state fn-right">未付款</em>';
		                      btn = '<a href="javascript:;" class="gray del">取消订单</a><a href="'+payurl+'" class="yellow">立即付款</a>';
		                      break;
		                    case "1":
		                      stateInfo = '<em class="state fn-right">完成</em>';
		                      break;
		                    case "2":
		                      stateInfo = '<em class="state fn-right">待确认</em>';
		                      btn = '<a href="javascript:;" class="gray cancel">取消订单</a>';
		                      break;
		                    case "3":
		                      stateInfo = '<em class="state fn-right">待配送</em>';
		                      break;
		                    case "4":
		                      stateInfo = '<em class="state fn-right">已接单</em>';
		                      break;
		                    case "5":
		                      stateInfo = '<em class="state fn-right">配送中</em>';
		                      break;
		                    case "6":
		                      stateInfo = '<em class="state fn-right">取消支付</em>';
		                      btn = '<a href="javascript:;" class="gray del">删除</a>';
		                      break;
		                    case "7":
		                      stateInfo = '<em class="state fn-right">交易失败</em>';
		                      btn = '<a href="javascript:;" class="gray del">删除</a>';
		                      break;
		                  }

  							html.push('<div class="item" data-id="'+id+'">');
							html.push('<a href="'+detailUrl.replace("%id%", id)+'">');
                			html.push('<div class="domain fn-clear"><span style="font-size: .3rem;">'+shopname+'</span><em class="state fn-right">'+stateInfo+'</em></div>');

			                html.push('<div class="wnumber">');
							html.push('<p class="food">'+food.replace(/，/mg, "<br />")+'</p>');
			                html.push('<p>下单时间：'+pubdate+'</p>');
			                html.push('<p>订单号：'+ordernum+'</p>');
			                html.push('</div>');
							html.push('</a>');
  							html.push('<div class="opbtn fn-clear">');
							html.push('<span style="line-height: .6rem;" class="fn-left">金额：<font color="#ff6800">&yen;'+amount+'</font></span>');
  							html.push(btn);
  							html.push('</div>');
  							html.push('</div>');


						}

						objId.append(html.join(""));
			            $('.loading').remove();
			            isload = false;

					}else{
            			$('.loading').remove();
						objId.append("<p class='loading'>"+msg+"</p>");
					}
				}
			}else{
				$('.loading').remove();
				objId.append("<p class='loading'>"+msg+"</p>");
			}
		}
	});
}
