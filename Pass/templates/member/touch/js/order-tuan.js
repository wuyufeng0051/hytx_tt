/**
 * 会员中心商城订单列表
 * by guozi at: 20151130
 */

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


});

function getList(is){

  isload = true;

	if(is != 1){
		// $('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.append('<p class="loading">'+langData['siteConfig'][20][184]+'...</p>');
	$(".pagination").hide();


	$.ajax({
		url: masterDomain+"/include/ajax.php?service=tuan&action=orderList&state="+state+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [], durl = $(".tab ul").data("url"), rUrl = $(".tab ul").data("refund"), cUrl = $(".tab ul").data("comment");

					switch(state){
						case "":
							totalCount = pageInfo.totalCount;
							break;
						case "0":
							totalCount = pageInfo.unpaid;
							break;
						case "1":
							totalCount = pageInfo.ongoing;
							break;
						case "2":
							totalCount = pageInfo.expired;
							break;
						case "3":
							totalCount = pageInfo.success;
							break;
						case "4":
							totalCount = pageInfo.refunded;
							break;
						case "5":
							totalCount = pageInfo.rates;
							break;
						case "6":
							totalCount = pageInfo.recei;
							break;
						case "7":
							totalCount = pageInfo.closed;
							break;
					}

					var msg = totalCount == 0 ? langData['siteConfig'][20][126] : langData['siteConfig'][20][185];

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
	  					var item     = [],
								id         = list[i].id,
								company    = list[i].company,
								ordernum   = list[i].ordernum,
								proid      = list[i].proid,
								procount   = list[i].procount,
								orderprice = list[i].orderprice,
								orderstate = list[i].orderstate,
								paydate    = list[i].paydate,
								retState   = list[i].retState,
								expDate    = list[i].expDate,
								orderdate  = huoniao.transTimes(list[i].orderdate, 1).replace(new Date().getFullYear() + "-", ""),
								title      = list[i].product.title,
								enddate    = huoniao.transTimes(list[i].product.enddate, 2),
								litpic     = list[i].product.litpic,
								url        = list[i].product.url,
								payurl     = list[i].payurl,
								common     = list[i].common,
								commonUrl  = list[i].commonUrl;

              var stateInfo = btn = "";
              switch(orderstate){
                case "0":
                  stateInfo = '<span class="state">'+langData['siteConfig'][9][22]+'</span>';
                  btn = '<a href="javascript:;" class="blueBtn del">'+langData['siteConfig'][6][65]+'</a><a href="'+payurl+'" class="sureBtn">'+langData['siteConfig'][6][64]+'</a>';
                  break;
                case "1":
                  stateInfo = '<span class="state">'+langData['siteConfig'][9][24]+'</span>';
                  break;
                case "2":
                  if(paydate != 0){
                    stateInfo = '<span class="state">'+langData['siteConfig'][9][29]+'</span>';
                  }else{
                    stateInfo = '<span class="state">'+langData['siteConfig'][9][40]+'</span>';
                    btn = '<a href="javascript:;" class="blueBtn del">'+langData['siteConfig'][6][65]+'</a>';
                  }
                  break;
                case "3":
                  stateInfo = '<span class="state">'+langData['siteConfig'][9][37]+'</span>';
                  if(common == 1){
                    btn = '<a href="'+commonUrl+'" class="sureBtn">'+langData['siteConfig'][8][2]+'</a>';
                  }else{
                    btn = '<a href="'+commonUrl+'" class="sureBtn">'+langData['siteConfig'][19][365]+'</a>';
                  }

                  break;
                case "4":
                  stateInfo = '<span class="state">'+langData['siteConfig'][9][27]+'</span>';
                  // btn = '<a href="javascript:;" class="edit">退款去向</a>';
                  break;
                case "6":

                  //申请退款
                  if(retState == 1){

                    //还未发货
                    if(expDate == 0){
                      stateInfo = '<span class="state">'+langData['siteConfig'][9][44]+'</span>';

                    //已经发货
                    }else{
                      stateInfo = '<span class="state">'+langData['siteConfig'][9][42]+'</span>';
                    }

                  //未申请退款
                  }else{
                    stateInfo = '<span class="state">'+langData['siteConfig'][9][26]+'</span>';
                    btn = '<a href="javascript:;" class="edit" target="_blank">'+langData['siteConfig'][6][45]+'</a>';
                  }
                  break;
                case "7":
                  stateInfo = '<span class="state">'+langData['siteConfig'][9][34]+'</span>';
                  // btn = '<a href="javascript:;" class="edit">退款去向</a>';
                  break;
              }

              var detailUrl = durl.replace("%id%", id);

							html.push('<div class="item" data-id="'+id+'">');
							html.push('<p class="order-number fn-clear"><span class="fn-left">'+langData['siteConfig'][19][308]+'：'+ordernum+'</span><span class="time">'+orderdate+'</span></p>');
							html.push('<p class="store fn-clear">');
							html.push('<span class="title fn-clear"><em class="sname">'+company+'</em></span>');
							html.push('<span class="state">'+stateInfo+'</span>');
							html.push('</p>');

							html.push('<a href="'+detailUrl+'">');
							html.push('<div class="fn-clear">');
							html.push('<div class="imgbox"><img src="'+litpic+'" alt=""></div>');
							html.push('<div class="txtbox">');
							html.push('<p class="gname">'+title+'</p>');
							html.push('</div>');
							html.push('<div class="pricebox">');
							html.push('<p class="price">'+(echoCurrency('symbol'))+orderprice+'</p>');
							html.push('<p class="mprice">×'+procount+'</p>');
							html.push('</div>');
							html.push('</div>');
							html.push('</a>');
							html.push('<p class="btns fn-clear" data-action="tuan"><a href="'+detailUrl+'" class="blueBtn">'+langData['siteConfig'][19][313]+'</a>'+btn+'</p>');
							html.push('</div>');

						}

						objId.append(html.join(""));
            $('.loading').remove();
            isload = false;

					}else{
            $('.loading').remove();
						objId.append("<p class='loading'>"+msg+"</p>");
					}

					$("#total").html(pageInfo.totalCount);
					$("#unpaid").html(pageInfo.unpaid);
					$("#unused").html(pageInfo.ongoing);
					$("#recei").html(pageInfo.recei);
					$("#used").html(pageInfo.success);
					$("#expired").html(pageInfo.expired);
					$("#refund").html(pageInfo.refunded);
					$("#rates").html(pageInfo.rates);
					$("#closed").html(pageInfo.closed);
					$("#cancel").html(pageInfo.cancel);

				}
			}else{
				objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
			}
		}
	});
}
