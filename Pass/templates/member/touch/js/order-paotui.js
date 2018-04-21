/**
 * 会员中心商城订单列表
 * by guozi at: 20151130
 */

var objId = $("#list");
detailUrl = detailUrl.replace("waimai", 'paotui')
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
	objId.delegate(".delete", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			if(confirm(langData['siteConfig'][20][182])){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=waimai&action=delOrder&type=paotui&id="+id,
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
						alert(langData['siteConfig'][20][183]);
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
			if(confirm(langData['siteConfig'][20][186])){
				t.siblings("a").hide();
				t.addClass("load");

				$.ajax({
					url: masterDomain+"/include/ajax.php?service=waimai&action=cancelPaotuiOrder&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							location.reload();
						}else{
							alert(data.info);
							t.siblings("a").show();
							t.removeClass("load");
						}
					},
					error: function(){
						alert(langData['siteConfig'][20][183]);
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

	objId.append('<p class="loading">'+langData['siteConfig'][20][184]+'...</p>');
	$(".pagination").hide();

	var num = $('.tab li.curr span').text();
	var msg = num == '0' ? langData['siteConfig'][20][126] : langData['siteConfig'][20][185];

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=waimai&action=paotuiOrder&userid="+userid+"&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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
								id       = list[i].id,
								ordernum = list[i].ordernumstore ? list[i].ordernumstore : list[i].ordernum,
								paytype  = list[i].paytype,
								pubdate  = huoniao.transTimes(list[i].pubdate, 1),
								paydate  = huoniao.transTimes(list[i].paydate, 1),
								shop     = list[i].shop,
								type     = list[i].type,
								state    = list[i].state,
								uid      = list[i].uid,
								username = list[i].username,
								address = list[i].address,
								buyaddress = list[i].buyaddress,
								payurl   = list[i].payurl;

		                  var stateInfo = btn = "";
		                  switch(state){
		                    case "0":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][9][22]+'</em>';
		                      btn = '<a href="javascript:;" class="gray cancel">'+langData['siteConfig'][6][65]+'</a><a href="'+payurl+'" class="yellow">'+langData['siteConfig'][6][64]+'</a>';
		                      break;
		                    case "1":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][6][3]+'</em>';
		                      btn = '<a href="javascript:;" class="gray delete">'+langData['siteConfig'][6][8]+'</a>';
		                      break;
		                    case "2":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][9][11]+'</em>';
		                      btn = '<a href="javascript:;" class="gray cancel">'+langData['siteConfig'][6][65]+'</a>';
		                      break;
		                    case "3":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][9][46]+'</em>';
		                      btn = '<a href="javascript:;" class="gray delete">'+langData['siteConfig'][6][8]+'</a>';
		                      break;
		                    case "4":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][16][114]+'</em>';
		                      btn = '<a href="javascript:;" class="gray delete">'+langData['siteConfig'][6][8]+'</a>';
		                      break;
		                    case "5":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][16][115]+'</em>';
		                      btn = '<a href="javascript:;" class="gray delete">'+langData['siteConfig'][6][8]+'</a>';
		                      break;
		                    case "6":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][6][112]+'</em>';
		                      btn = '<a href="javascript:;" class="gray delete">'+langData['siteConfig'][6][8]+'</a>';
		                      break;
		                    case "7":
		                      stateInfo = '<em class="state fn-right">'+langData['siteConfig'][9][47]+'</em>';
		                      btn = '<a href="javascript:;" class="gray delete">'+langData['siteConfig'][6][8]+'</a>';
		                      break;
		                  }

  							html.push('<div class="item" data-id="'+id+'">');
  							html.push('<a href="'+detailUrl.replace("%id%", id)+'">');
  							html.push('<div class="domain fn-clear"><span style="font-size: .3rem;">'+langData['siteConfig'][19][108]+'：'+(type == 1 ? langData['siteConfig'][17][16] : langData['siteConfig'][17][17])+'</span>'+stateInfo+'</div>');
			                html.push('<div class="wnumber">');
							html.push('<p class="food">'+langData['siteConfig'][20][189]+'：'+shop+'</p>');
							html.push('<p class="food">'+langData['siteConfig'][20][190]+'：'+buyaddress+'</p>');
							html.push('<p class="food">'+langData['siteConfig'][20][191]+'：'+address+'</p>');
			                html.push('<p>'+langData['siteConfig'][19][51]+'：'+pubdate+'</p>');
			                html.push('<p>'+langData['siteConfig'][19][308]+'：'+ordernum+'</p>');
			                html.push('</div>');
							html.push('</a>');
  							html.push('<div class="opbtn fn-clear">');
							html.push('<span style="line-height: .6rem;" class="fn-left">'+langData['siteConfig'][19][306]+'：<font color="#ff6800">'+echoCurrency('symbol')+amount+'</font></span>');
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
