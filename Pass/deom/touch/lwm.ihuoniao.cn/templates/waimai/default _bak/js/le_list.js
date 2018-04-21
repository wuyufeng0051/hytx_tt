$(function(){
	var xiding = $(".nav_lead");
    var chtop = parseInt(xiding.offset().top);
	// 筛选
	$('.nav_lead ul li').click(function(){
        var $t = $(this),
         index = $t.index(),
           box = $('.nav_txt .nav').eq(index);
         if (box.css("display")=="none") {
            $t.addClass('nav_lbc').siblings().removeClass('nav_lbc');
            box.show().siblings().hide();
            $('.disk').show();
            // $('body').addClass('by');
            $(".nav_lead").addClass('com_screen_top');
            $('body').scrollTop(chtop);
            $('.navigation').addClass('com_screen_top')
         }else{
            $t.removeClass('nav_lbc');
            box.hide();
            $('.disk').hide();
            // $('body').removeClass('by');
            $('.navigation').removeClass('com_screen_top')
            $(".nav_lead").removeClass('com_screen_top');
         }
    })
	$('.nav_txt .nav ul li ').click(function(){
			var  x = $(this);
			var  index = x.closest(".nav").index();
			var  lead = $('.nav_lead  ul li').eq(index);
			var  b = x.find('a').text();
			$(lead).find('em').text(b);
			x.addClass('nav_bc');
	      	x.siblings('li').removeClass('nav_bc');
			$('.disk').hide();
	      	$('.nav_txt .nav').hide();
			$('.nav_lead ul li').removeClass('nav_lbc');
			// $('body').removeClass('by');
            $('.navigation').removeClass('com_screen_top')
			$(".nav_lead").removeClass('com_screen_top');

            var utype = x.closest("ul").data("type");
            var uid = x.data("id");

            if(utype == "type"){
                typeid = uid;
            }else if(utype == "orderby"){
                orderby = uid;
            }else if(utype == "yingye"){
                yingye = uid;
            }

            page = 1;
            getList();
		})
     // 遮罩层
    $('.disk').on('click',function(){
        $('.disk').hide();
        $('.nav_txt .nav').hide();
        $('.nav_lead ul li').removeClass('nav_lbc');
            $('.navigation').removeClass('com_screen_top')
        // $('body').removeClass('by')
		$(".nav_lead").removeClass('com_screen_top');
    })


    // 吸顶
    $(window).on("scroll", function() {
		var thisa = $(this);
		var st = thisa.scrollTop();
		if (st >= chtop) {
			$(".nav_lead").addClass('com_screen_top');
		} else {
			$(".nav_lead").removeClass('com_screen_top');
		}
	});

	var localData = utils.getStorage('waimai_local');
	if(localData){
		lat = localData.lat;
		lng = localData.lng;
		$('.location a').html(localData.address);

		getList();
	}else{
		var geolocation = new BMap.Geolocation();
	    geolocation.getCurrentPosition(function(r){
	    	if(this.getStatus() == BMAP_STATUS_SUCCESS){
	    		lat = r.point.lat;
				lng = r.point.lng;

				var geoc = new BMap.Geocoder();
				geoc.getLocation(r.point, function(rs){
					var rs = rs.addressComponents;
					$('.location a').html(rs.district + rs.street + rs.streetNumber)
				});

				getList();
	    	}
	    	else {
	    		alert('failed'+this.getStatus());
	    	}
	    },{enableHighAccuracy: true})
	}


    var isload = false;

	//获取店铺列表
	function getList(){

        isload = true;

		if(page == 1){
			$('.le_list').html('<div class="loading">加载中...</div>');
		}else{
			$('.le_list').append('<div class="loading">加载中...</div>');
		}

        $.ajax({
            url: '/include/ajax.php?service=waimai&action=shopList',
            data: {
                typeid: typeid,
                orderby: orderby,
                yingye: yingye,
                lng: lng,
                lat: lat,
                page: page,
                pageSize: pageSize
            },
            type: 'get',
            dataType: 'json',
            success: function(data){

                if(data.state == 100){
                    var list = [];
                    $('.le_list .loading').remove();

					//注释原因：如果总页数只有1页时，会不显示数据 20170614
                    if(data.info.pageInfo.totalPage == page){
                        // if(page == 1){
                        //     $('.le_list').html('<div class="loading">暂无相关数据！</div>');
                        // }
                        // return false;
                    }

                    var info = data.info.list;
                    for(var i = 0; i < info.length; i++){
                        var d = info[i];
                        list.push('<div class="le_xtt fn-clear"><a href="'+d.url+'">');

                        var xx = '';
                        if(d.yingye != 1){
                            xx = '<img class="xx" src="/static/images/xx.png" />';
                        }

                        list.push('<div class="le_pic"><img src="'+d.pic+'" alt="'+d.shopname+'" onerror="this.src=\'/static/images/shop.png\'">'+xx+'</div>');
                        list.push('<div class="le_text">');
                        list.push('<h1>'+d.shopname+'<div class="fn-right">'+d.juli+'</div></h1>');
                        list.push('<div class="pingjia">');
                        list.push('<span><p></p></span><em>已售14单</em>');
                        if(d.delivery_service){
                            list.push('<b>'+d.delivery_service+'</b>');
                        }
                        list.push('</div>');
                        list.push('<div class="le_foot fn-clear">');
                        list.push('<div class="lf_left">');
                        list.push('起送价￥'+d.basicprice+' <em>|</em>外送费￥'+d.delivery_fee+'');
                        list.push('</div>');
                        list.push('');
                        list.push('</div>');

                        list.push('<div class="favorable">');
        				list.push('<ul>');
                        if(d.is_first_discount == '1'){
                            list.push('<li class="shou"><em>首</em>新用户立减'+d.first_discount+'元</li>');
                        }
                        if(d.is_discount == '1'){
                            list.push('<li class="zhe"><em>折</em>可享受全店'+d.discount_value+'折</li>');
                        }
                        if(d.open_promotion == '1'){
            				list.push('<li class="jian"><em>减</em>消费');
                            for(var o = 0; o < d.promotions.length; o++){
                                if(d.promotions[o][0] && d.promotions[o][1]){
                                    list.push('满'+d.promotions[o][0]+'元减'+d.promotions[o][1]+'元；');
                                }
                            }
                            list.push('</li>');
                        }
        				list.push('</ul>');
        				list.push('</div>');

                        list.push('</div>');

                        if(d.description){
                            list.push('<div class="tejia">'+d.description+'</div>');
                        }

                        list.push('</a></div>');
                    }

                    if(page == 1){
            			$('.le_list').html(list.join(''));
            		}else{
            			$('.le_list').append(list.join(''));
            		}

                    isload = false;
                    page++;

                }else{
                    $('.le_list .loading').html(data.info);
                }

            },
            error: function(){
                $('.le_list .loading').html('网络错误，加载失败！');
            }
        })

	}



    $(window).scroll(function() {
		var allh = $('body').height();
		var w = $(window).height();
		var scroll = allh - w - 100;
		if ($(window).scrollTop() > scroll && !isload) {
            getList();
		};
	});


})
