$(function(){
	//首页楼层鼠标移动分类触发事件
	$(document).on("mouseenter","li[ectype='floor_cat_content']",function(){
		var cat_id = $(this).data("id");
		var floor_num = $(this).data("floornum");
		var warehouse_id = $(this).data("warehouse");
		var area_id = $(this).data("area");
		var eveval = $(this).data("flooreveval");

		if(eveval == 0){
			$.ajax({
			   type: "POST",
			   url: "get_ajax_content.php",
			   data: "act=floor_cat_content&cat_id=" + cat_id + "&floor_num=" + floor_num + "&warehouse_id=" + warehouse_id + "&area_id=" + area_id,
			   dataType:'json',
			   success: function(data){
				   $("#floor_cat_" + data.cat_id).html(data.content);
				   $(".floor-title").find("li[data-id='" + data.cat_id + "']").data("flooreveval", 1);
			   }
			});
		}
	});
	
	//top_banner关闭
	$(".top-banner .close").click(function(){
		$(this).parents(".top-banner").hide();
	});
	
	//城市选择
	$("#city-choice,.f-store,.li_dorpdown").hover(function(){
		$(this).addClass("hover");
		var width = $(this).find(".sc-choie").outerWidth();
		$(this).find(".dd-spacer").css("width",width-2);
	},function(){
		$(this).removeClass("hover");
	});
	
	$(".li_dorpdown").hover(function(){
		$(this).addClass("hover");
		var width = $(this).find(".dt").outerWidth();
		$(this).find(".dd-spacer").css({"width":width-2,"right":0});
	},function(){
		$(this).removeClass("hover");
	});
	
	$("#site-nav").jScroll();
	
	//首页购物车展开
	$(".shopcart-2015").hover(function(){
		$(this).addClass("hover");
	},function(){
		$(this).removeClass("hover");
	});
	
	//全部分类
	$(".quanbu").hover(function(){
		$(this).addClass("hover");
		$(this).children("#categorys-mini-main").show();
	},function(){
		$(this).removeClass("hover");
		$(this).children("#categorys-mini-main").hide();
	});
	
	$(".navitems ul").mouseleave(function(){
		$(this).next().children().animate({left:15},400);
	});
	
	//导航栏子分类展开
	$("#cata-nav .item").mouseenter(function(){
		$(this).addClass("selected");
		$(this).children(".cata-nav-layer").show();
	});
	$("#cata-nav .item").mouseleave(function(){
		$(this).removeClass("selected");
		$(this).children(".cata-nav-layer").hide();
	});
	
	//首页立即抢购隐藏显示
	$(".panic-buy-slide").hover(function(){
		$(this).children(".buy-prev,.buy-next").animate({"opacity":0.4},500);
	},function(){
		$(this).children(".buy-prev,.buy-next").animate({"opacity":0},500);
	});

	//团购分类区域筛选
	$(".filter-strip-all").mouseenter(function(){
		$(".geo-more-placeholder").remove();
		$(this).parents(".content-cell").addClass("site-fs-cell-geowrap");
		$(this).parents(".content-cell").after("<div class='geo-more-placeholder'></div>");
	});
	$(".gd").mouseleave(function(){
		$(this).parents(".content-cell").removeClass("site-fs-cell-geowrap");
		$(".geo-more-placeholder").remove();
	});
	
	$(".group-floor .mc li").mouseenter(function(){
		$(this).addClass("current");
	});
	$(".group-floor .mc li").mouseleave(function(){
		$(this).removeClass("current");
	});
	
	$(".ziji").mouseenter(function(){
		$(this).addClass("hover");
		var width =$(this).width();
		$(this).children(".dorpdown-layer").children(".dd-spacer").css("width",width-2);
	});
	$(".ziji").mouseleave(function(){
		$(this).removeClass("hover");
		$(this).children(".dorpdown-layer").children(".dd-spacer").css("width",0);
	});
	
	$(".reply").click(function(){
		if($(this).parent(".comment-operate").next().hasClass("hide")){
			$(this).parent(".comment-operate").next().removeClass("hide");
		}else{
			$(this).parent(".comment-operate").next().addClass("hide");
		}
	});
	
	$(".biz-info").hover(function(){
		$(this).addClass("biz-info-open").siblings().removeClass("biz-info-open");
	});
	
	$(".choose .attr-radio .item").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
		$(this).find("input[type='radio']").prop("checked",true);
		changePrice();
	});
	
	$(".choose .attr-check .item").click(function(){
		var len = $(this).parent().find(".selected").length;
		if($(this).hasClass("selected")){
			if(len<=1)return;
			$(this).removeClass("selected");
			$(this).find("input[type='checkbox']").prop("checked",false);
		}else{
			$(this).addClass("selected");
			$(this).find("input[type='checkbox']").prop("checked",true);			
		}
		changePrice();
	});
	
	$("#menu dt i.icon,#menu dt span").click(function(){
		var dl = $(this).parents("dl");
		if(dl.hasClass("selected")){
			dl.removeClass("selected");
		}else{
			dl.addClass("selected");
		}
	});
	
	$(".disComment").click(function(){
		$(this).parent().next().show();
	});
	
	var outTimer;
	$(".site-mast").hover(function(){
		var $this = $(this);
		clearTimeout(outTimer);
		outTimer = setTimeout(function(){
			$this.find(".dt").addClass("up");
			$this.find(".dd").show();
		},100);
	},function(){
		var $this = $(this);
		clearTimeout(outTimer);
		outTimer = setTimeout(function(){
			$this.find(".dt").removeClass("up");
			$this.find(".dd").hide();
		},100);
	});

	//网友评论话题类型单选切换
	$("div.value-item").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
	});
	
	//购物提交订单
	$(".sku-props-selector .item").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
	});
	
	//购物车促销优惠效果
	$(".sales-promotion").click(function(){
		$(this).next().slideDown();
	});
	$(".promotion-tit").click(function(){
		$(this).parent().slideUp();
	});
	

	
	
	//商品详情页店铺展开收起
	$(".arrow-show-more").click(function(){
		$(".seller-pop-box,.seller-address").stop(true,false).slideToggle();
	});
	//推荐搭配
	$(".fitting-wrap li").click(function(){
		var goods_id = $(this).attr('id');
		if($(this).hasClass("checked")){
			$("input[name='goods_list_" + goods_id + "']").click();
			$(this).removeClass("checked");
		}else{
			$("input[name='goods_list_" + goods_id + "']").click();
			$(this).addClass("checked");
		}
	});
	
	
	
        
	
	
	

	
	
	
	
	
	
	
	
	
	
	//众筹页面js
	$("#parent_catagory li a").on("click",function(){
		var textTypeIndex = $(this).parent().index();
		var vsecondlist = $(".v-second-list");
		$(this).parent().addClass("current").siblings().removeClass("current");
		$(this).parents(".v-fold").next().show();
		var index = textTypeIndex-1;
		if(index >= 0){
			vsecondlist.show();
			vsecondlist.children(".s-list").eq(index).show().siblings().hide();
		}else{
			vsecondlist.hide();
			vsecondlist.children(".s-list").hide();
		}
	});
	$("#sort li").click(function(){
		$(this).addClass("current").siblings().removeClass("current");
	});

	$(".v-option").click(function(){
		if($(this).hasClass('slidedown')){
			$(this).removeClass('slidedown').addClass('v-close');
			$(this).html("<b></b><span>"+Pack_up+"</span>");
			$(this).next().css("height","auto");
		}else{
			$(this).removeClass('v-close').addClass('slidedown');
			$(this).html("<b></b><span>"+more+"</span>");
			$(this).next().css("height","26px");
		}
	});

	$.inputPrompt("#keyword",true,$('#keyword').val());
	$.inputPrompt("#keyword2",true,$('#keyword2').val());
	$.ecscSearch("#shop_search");
	$.ecscSearch("#shop_search2");
})





//input文本框 提示文字
jQuery.inputPrompt = function(s,c,v){
	var s = $(s);
	s.focus(function(){
		if($(this).val() == v){
			$(this).val("");
			if(c==true){
				$(this).css("color","#666");
			}
		}
	});
	s.blur(function(){
		if($(this).val()==''){
			$(this).val(v);
			if(c==true){
				$(this).css("color","#999");
			}
		}else{
			if(c==true){
				$(this).css("color","#666")
			}
		}
	});
}
/******************************门店选择 切换城市*******************************/
function regionSelect(ru_id,goods_id){
	var hoverTimer,
		outTimer,
		_this,
		level = 0,
		id = 0,
		name = "";
	var changeCity = "#latelStorePick .change-shop-city",
		changeBoxinfo = ".city-box-info",
		tab = ".city-tab .city-item",
		cityItem = ".city-box .city-item",
                catyHst = ".city-hot .city-item",
		shopitem = ".select-shop-box .shop-info-item",
		doc = $(document);
	//鼠标移动到切换城市展开所有城市选择
	doc.on("mouseenter",changeCity,function(){
		clearTimeout(outTimer);
		_this = $(this);
		hoverTimer = setTimeout(function(){
			_this.parents(".city-box-tit").siblings(".city-box-info").show()
		},100);
	})
	.on("mouseleave",changeCity,function(){
		clearTimeout(hoverTimer);
		_this = $(this);
		outTimer = setTimeout(function(){
			_this.parents(".city-box-tit").siblings(".city-box-info").hide();
		},100);	
	})
	.on('mouseenter',changeBoxinfo,function(){
		clearTimeout(outTimer);
		_this = $(this);
		_this.show();
	})
	.on('mouseleave',changeBoxinfo,function(){
		_this = $(this);
		_this.hide();
	})
        .on('click',catyHst,function(){
            var spec_arr = '';
            var formBuy = document.forms['ECS_FORMBUY'];
            if (formBuy)
            {
                spec_arr = getSelectedAttributes(formBuy);
            }
            _this = $(this),level = _this.data("level"),id = _this.data("id"),name = _this.data("name");
            
            var province = 0,city = 0,district = 0;
            if(level == 1){
                province = id;
            }else if(level == 2){
                city = id;
            }else{
                district = id;
            }
            check_store(province,city,district,goods_id,spec_arr);
            
	})
	.on("click",tab,function(){
                var spec_arr = '';
                var formBuy = document.forms['ECS_FORMBUY'];
                if (formBuy)
                {
                    spec_arr = getSelectedAttributes(formBuy);
                }
		//地区三级联动切换
		_this = $(this),level = _this.data("level"),id = _this.data("id"),name = _this.data("name");
		_this.addClass("curr").siblings().removeClass("curr");
                 Ajax.call("get_ajax_content.php?act=get_parent_regions",'value='+ id + "&level=" + level + "&ru_id=" + ru_id+ '&goods_id=' + goods_id + "&spec_arr="+spec_arr , function(data){
                        $(".region_select_ajax").html(data.html);
                }, 'POST','JSON');
	})
	.on("click",cityItem,function(){
            /*获取属性*/
                var spec_arr = '';
                var formBuy = document.forms['ECS_FORMBUY'];
                if (formBuy)
                {
                    spec_arr = getSelectedAttributes(formBuy);
                }
		//地区选择
		_this = $(this),level = _this.data("level"),id = _this.data("id"),name = _this.data("name");
		var cityTab = _this.parents(".city-box").siblings(".city-tab");
		cityTab.find("[data-level="+(level+1)+"]")
                .addClass("curr")
                .siblings().removeClass("curr");
                console.log(level);
                cityTab.find("[data-level="+level+"]")    
                .html(name)
                .attr("data-id",id)
                .attr("data-name",name);
//                if(level < 3){
//                    Ajax.call("get_ajax_content.php?act=getstoreRegion",'value='+ id + "&level=" + level + "&ru_id=" + ru_id + '&goods_id=' + goods_id + "&spec_arr="+spec_arr, function(data){
//                        $(".region_select_ajax").html(data.html);
//                   }, 'POST','JSON');
//               }else{
                   var str ="";
                   $(tab).each(function(){
                       name = $(this).attr("data-name");
                       str += name + "&nbsp;";
                   });
                   $(changeBoxinfo).hide();
                   $(changeCity).find("em").html(str);
                   var province = 0,city = 0,district = 0;
                    if (level == 1) {
                        province = id;
                    } else if (level == 2) {
                        city = id;
                    } else {
                        district = id;
                    }
//                   check_store(province,city,district,goods_id,spec_arr);
                   check_store(province,city,district,goods_id,spec_arr);
//               }
	})
	.on("click",shopitem,function(){
		_this = $(this);
		_this.addClass("active").siblings().removeClass("active");
	});
}
function check_store(province,city,district,goods_id,spec_arr){
     Ajax.call("ajax_dialog.php?act=get_store_list", 'country=' + province + '&goods_id=' + goods_id + "&spec_arr=" + spec_arr + "&type=store_select_shop", function (data) {
         $(".select-shop").html(data.content);
    }, 'POST', 'JSON');
}
/******************************门店选择 切换城市*******************************/

$(document).click(function(){
	$(".suggestions_box").hide();
});

$(".suggestions_box").click(function(e){//自己要阻止
	e.stopPropagation();//阻止冒泡到body
});

//ie6、ie7去除a标签点击后虚线
function ie67(){
	var b_v = navigator.appVersion;
	var IE6 = b_v.search(/MSIE 6/i) != -1;
	var IE7 = b_v.search(/MSIE 7/i) != -1;
	if (IE6||IE7)
	{
		$("a").ready(function(){
			$("a").attr("hidefocus",true);
		});
	}
}
ie67();

//头部商品店铺搜索切换
jQuery.ecscSearch = function(a){
	$(a).hover(function(){
		$(this).css({"height":"auto","overflow":"visible"});
	},function(){
		$(this).css({"height":35,"overflow":"hidden"});
	});
	
	$(a).prev().hover(function(){
		$(this).next().css({"height":"auto","overflow":"visible"});
	});
	
	$(a).find('li').each(function(index, element){
		if($(this).hasClass("curr")){
			$(element).click(function(){
				var html_1 = $(this).html();
				var attr_1 = $(this).attr('rev');
				if(index == 0){
					$(this).html($(this).next().html());
					$(this).next().html(html_1);
					
					var nextAttr = $(this).next().attr("rev");
					$(this).attr({rev : "" +nextAttr+ ""});
					$(this).next().attr({rev : "" +attr_1+ ""});	
				}else if(index == 1){
					$(this).html($(this).prev().html());
					$(this).prev().html(html_1);
					
					var prevAttr = $(this).prev().attr("rev");
					$(this).attr({rev : "" +prevAttr+ ""});
					$(this).prev().attr({rev : "" +attr_1+ ""});
					
					$(this).parent().css({"height":35,"overflow":"hidden"});
				}
				$(this).parents(".ecsc-search-tabs").nextAll("input[name='store_search_cmt']").val(attr_1);
			});
		}
	});
}
function dialogPrompt(i,m){
   var content = '<div id="'+i+'">' + 
                        '<div class="tip-box icon-box">' +
                                '<span class="warn-icon m-icon"></span>' + 
                                '<div class="item-fore">' +
                                        '<h3 class="rem ftx-04">' + m + '</h3>' +
                                '</div>' +
                        '</div>' +
                '</div>';
        pb({
                id:i,
                title:title,
                width:455,
                height:58,
                content:content, 	//调取内容
                drag:false,
                foot:false
        });

        $('#' + i + ' .tip-box').css({
                'width' : '350px'
        });
}
//首页，顶级分类页广告栏自适应宽度
jQuery.liWidth = function(obj){
	$(obj).each(function(){
		var li = $(this).find(".hd li")
		if(li.length==1){
			li.parents(".hd").addClass("hd_li1");
		}else if(li.length==2){
			li.parents(".hd").addClass("hd_li2");
		}else if(li.length==3){
			li.parents(".hd").addClass("hd_li3");
		}else if(li.length==4){
			li.parents(".hd").addClass("hd_li4");
		}
	});
}

//jq仿select
jQuery.divselect = function(divselectid,inputselectid) {
	var inputselect = $(inputselectid);
	$(divselectid+" .cite").click(function(event){
		event.stopImmediatePropagation();
		var ul = $(divselectid+" ul");
		if(ul.css("display")=="none"){
			ul.css("display","block");
		}else{
			ul.css("display","none");
		}

	});
	$(divselectid+" ul li a").click(function(event){
		event.stopImmediatePropagation();
		var txt = $(this).text();
		$(divselectid+" .cite").html(txt);
		var value = $(this).attr("selectid");
		inputselect.val(value);
		$(divselectid+" ul").hide();
	});
	$(document).bind("click",function(){
		$(divselectid+" ul").hide();
	})
};

/*
 *	顶级分类页几套模板js(默认、女装、家电、食品）
 */

$(function(){
	//二级分类栏js
	$('#parent-cata-nav .item').unbind('mouseenter').bind('mouseenter',function(){
		var T = $(this);
		var cat_id = T.children('.item-left').children('.cata-nav-name').data('parentcat');
		var eveval = T.children('.item-left').children('.cata-nav-name').attr('parent_eveval');
		
		if(eveval != 1){
			T.children('.item-left').children('.cata-nav-name').attr('parent_eveval', '1');
			/*加载中by wu*/
			$('#brands_' + cat_id).html('<img src="themes/ecmoban_dsc/images/loadGoods.gif" width="200" height="200" class="lazy" style="margin:0 112px">');					
			$.ajax({
			   type: "GET",
			   url: "get_ajax_content.php",
			   data: "act=getCategotyParentTree&cat_id=" + cat_id,
			   dataType:'json',
			   success: function(data){
				 $('#brands_' + data.cat_id).html(data.brands_content);
			   }
			});
		}
		
		T.addClass("selected");
		T.children('.cata-nav-layer').show();
	});
	
	$('#parent-cata-nav .item').unbind('mouseleave').bind('mouseleave',function(){
		$(this).removeClass("selected");
		$(this).children(".cata-nav-layer").hide();
	});
	
	//随便瞧瞧换一组（家电顶级分类页模板）
	$(".have-a-look").find(".ec-huan").click(function(){
		var load_num = 0;
		var region_id = $("input[name='region_id']").val();
		var area_id = $("input[name='area_id']").val();
		var prent_id = $("input[name='cat_id']").val();
		$.ajax({
			type:'get',
			url:'get_ajax_content.php',
			data:"act=changeShow&type=1&tpl=2&cat_id={$cate_info.cat_id}&rome_key=" + load_num + "&prent_id=" + prent_id + "&region_id=" + region_id + "&area_id=" + area_id,
			dataType:'json',
			success:function(data)
			{
				$(".ecsc-ps-list").html(data.page);
				$(".ecsc-ps-list").find("img.lazy").lazyload({
					effect : "fadeIn"
				});
			}
		})
	});
});

//分类商品换一组
function changeShow(cat_id,tpl)
{
	var load_num = 0;
	var region_id = $("input[name='region_id']").val();
	var area_id = $("input[name='area_id']").val();
	var prent_id = $("input[name='cat_id']").val();
	$.ajax({
		type:'get',
		url:'get_ajax_content.php',
		data:"act=changeShow&type=3&tpl="+ tpl +"&cat_id=" + cat_id + "&rome_key=" + load_num + "&prent_id=" + prent_id + "&region_id=" + region_id + "&area_id=" + area_id,
		dataType:'json',
		success:function(data)
		{
			$("[cat_id="+cat_id+"]").html(data.page);
			$("[cat_id="+cat_id+"]").find("img.lazy").lazyload({
				effect : "fadeIn"
			});
		}
	})
}

//异步加载每个楼层的分类切换
jQuery.tabs = function (){
	var li = $(".tab").find("li");
	var index = 0;
	var floors ='';
	li.hover(function(){
		$(this).addClass("on");
		$(this).siblings().removeClass("on");
		index = $(this).index();
		floors = $(this).parents(".floor-container");
		floors.find(".ecsc-cp-tabs").hide();
		floors.find(".ecsc-cp-tabs").eq(index).show();
	});
}
/*顶级分类页几套模板js(默认、女装、家电、食品）end*/


//出现广告位提示
jQuery.adpos = function(){
	$("*[ecdscType='adPos']").each(function(i,e){
		var _this = $(this);
		var div = _this.find('img');
		var text = _this.data("adposname");
	
		if(!div.length>0){
			_this.addClass('adPos_hint');
			_this.html('<section>'+adv_packup_one+'" '+text+'" '+adv_packup_two+'</section>');
		}
	});
	$("*[ecdscType='Text']").each(function(i,e){
		var _this = $(this);
		var div = _this.find('div');
		var text = _this.data("adposname");
	
		if(!div.length>0){
			_this.addClass('adPos_hint');
			_this.html('<section>'+Please+'" '+text+'"'+set_up+'</section>');
		}
	});
}
//出现广告位提示end

//轮播广告hd只适应left
$.slidehd = function(bd,hd){
	var length = $(bd).length;
	var width = length*37;
	$(hd).css({"margin-left":-width/2});
}
//轮播广告hd只适应left end

//会员中心提示错误信息
function get_user_prompt_message(text){
	var ok_title = determine;
	var cl_title = cancel;
	var title = Prompt_information;
	var width = 455; 
	var height = 58;
	var divId = "email_div";
	
	var content = '<div id="' + divId + '">' +
						'<div class="tip-box icon-box">' +
							'<span class="warn-icon m-icon"></span>' +
							'<div class="item-fore">' +
								'<h3 class="ftx-04">' + text + '</h3>' + 
							'</div>' +
						'</div>' +
					'</div>';
	
	pb({
		id:divId,
		title:title,
		width:width,
		height:height,
		ok_title:ok_title, 	//按钮名称
		cl_title:cl_title, 	//按钮名称
		content:content, 	//调取内容
		drag:false,
		foot:true,
		onOk:function(){              
		},
		onCancel:function(){
		}
	});
	
	$('.pb-ok').addClass('color_df3134');
	$('#' + divId + ' .pb-ct .item-fore').css({
		'height' : '58px'
	});
	
	if(text.length <= 15){
		$('#' + divId + ' .pb-ct .item-fore').css({
			"padding-top" : '10px'
		});
	}
}
function sildeImg(num){
	//$(".network-wrap:eq("+num+")").slide({mainCell:".sider ul",effect:"left",pnLoop:false,autoPlay:false,autoPage:true,trigger:"click",scroll:1,vis:6,prevCell:".goods_prev",nextCell:".goods_next",});
	//$(".network-wrap:gt("+num+")").slide({mainCell:".sider ul",effect:"left",pnLoop:false,autoPlay:false,autoPage:true,trigger:"click",scroll:1,vis:6,prevCell:".goods_prev",nextCell:".goods_next",});

	$(".sider li").hover(function(){
		var src = $(this).find('img').attr("src");
		$(this).parents(".sider").prev().find("img").attr("src",src);
		$(this).addClass("curr").siblings().removeClass("curr");
	});
}