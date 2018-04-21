$(function(){
    getList();

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
                keywords: keywords,
                page: page,
                pageSize: pageSize
            },
            type: 'get',
            dataType: 'json',
            success: function(data){

                if(data.state == 100){
                    var list = [];
                    $('.le_list .loading').remove();

                    var info = data.info.list;

                    if(info.length == 0){
                        if(page == 1){
                            $('.le_list').html('<div class="loading">暂无相关数据！</div>');
                        }
                        return false;
                    }

                    for(var i = 0; i < info.length; i++){
                        var d = info[i];
                        list.push('<div class="le_xtt fn-clear"><a href="'+d.url+'">');

                        var xx = '';
                        if(d.yingye != 1){
                            xx = '<img class="xx" src="/static/images/xx.png" />';
                        }

                        list.push('<div class="le_pic"><img src="'+d.pic+'" alt="'+d.shopname+'" onerror="this.src=\'/static/images/shop.png\'">'+xx+'</div>');
                        list.push('<div class="le_text">');
                        list.push('<h1>'+d.shopname.replace(keywords, "<font color='#ffoooo'>"+keywords+"</font>")+'</h1>');
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

                        if(d.food && d.food.length > 0){
                            list.push('<div class="food fn-clear"><span>'+d.food[0].replace(keywords, "<font color='#ffoooo'>"+keywords+"</font>")+'</span><em>查看更多...<em></div>');
                        }

                        list.push('</div>');

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
