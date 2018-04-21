$(document).ready(
	//页面加载事件
	function() {

		//-优惠卷弹框信息
		$(".blue,.orange,.red,.more").die("click").live("click",function() {
			$("#up_arrow").fadeIn();
			$(".c_mark").fadeIn();
			$(".coupon_div").fadeIn();
			var a=$(".info_r_lengjuan a").offset().top+5;
			$(".coupon_div").css({top:a});
			$("body").addClass("position_r")
		})
		
		$(".coupon_div .close").die("click").live("click",function() {
			$("#up_arrow").fadeOut();
			$(".c_mark").fadeOut();
			$(".coupon_div").fadeOut();
			$("body").removeClass("position_r")
		});
		
		//底部悬浮效果
		var floorId = null;
		floorId = setTimeout(function() {
			$(".J-fudong-animate").addClass("wk_hide");
		}, 10000);
		
		var channelTypeId=$("#channelTypeId").val();
		if(channelTypeId==31){
			loadingAdver(floorId);//底部广告
			loadingCoupon();//加载优惠卷
		}if(channelTypeId==1){
			homeCoupon();
		}
		
		var imgArr = document.getElementsByTagName('img');
		var noImg = [];
		for ( var i = 0; i < imgArr.length; i++) {
			if (imgArr[i].getAttribute('shid') != 1&& imgArr[i].getAttribute('loadsrc') != null) {
				noImg.push(imgArr[i]);
			}
		}
		var noLoadingArr =noImg;
		var imgSize=30;
		var count=8;
		if (noLoadingArr.length==30) {
			count=10
		}
		for ( var i = 0; i < noLoadingArr.length/count; i++) {
			var imgIDs="";
			var img=noLoadingArr[i];
			
				for(var j=0;j<count;j++){
					var loadSrc = noLoadingArr[j+(count*i)];
					if(loadSrc!=null){
						loadSrc=loadSrc.getAttribute("loadsrc");
					}
					if(loadSrc==null){
						loadSrc="[404]";
					}else if(loadSrc == '' || loadSrc.length==0 || loadSrc == '[]'){
						loadSrc="[404]";
					}
					imgIDs+=loadSrc+";";
				}
				loadingImgBatch(imgIDs, noLoadingArr);
		}
		
	}
  
);
function loadingImgBatch(imgIDs, noLoadingArr) {

	$.post("common/loadImg",{"imgID":imgIDs},function(json){
		if(json&&json.jsonValue!=null&&json.jsonValue.length>0&&json.jsonValue[0]!=""){
			for(var i=0;i<json.jsonValue.length;i++){
				
				for(var j=0;j<noLoadingArr.length;j++){
					
					var imgid=noLoadingArr[j].getAttribute('loadsrc');
		
					if(imgid==json.jsonValue[i].id){
						noLoadingArr[j].src = json.jsonValue[i].src;
						noLoadingArr[j].setAttribute("data-original",json.jsonValue[i].src);
					}else if(imgid==null || imgid=="" || imgid.replace(/(^s*)|(s*$)/g,"").length ==0 || imgid.length==0 ){
					
						noLoadingArr[j].src = "http://static.99114.com/static/images/alb_h156.gif";
						noLoadingArr[j].setAttribute("data-original",json.jsonValue[i].src);
					}
				}
				
			}
		}
	},"json");
	
}
function  loadingAdver(floorId){

	$(".J-fudong-animate i").die("click").live('click',function() {
		$(".J-fudong-animate").hide();
		clearTimeout(floorId);
	});
	
	$.get("getadverhtml",{code:"1_76820_2_advertGroup48945"},function(result){
	
		$(".bottomsus").html(result);
	})
}

function loadingCoupon(){
	var memberId=$("#memberId").val();
	var siteId=$("#siteId").val();
	var channelType3Id=$("#channelType3Id").val();
	$.get("searchCoupons",{memberId:memberId,siteId:siteId,channelId:channelType3Id,"time":new Date().getTime()},function(result){
		$(".J_coupons").html(result);
		if($.trim($(".couponamount").html())==""&&$.trim($(".fanliVal").html())==""){
			$(".coupon_info").hide();	
		}else if($.trim($(".couponamount").html())==""){
			$(".J_coupons").hide();	
		};
		var coupon_div=$(".coupon_show").html();
		$(".coupon_div").html(coupon_div);
		$(".coupon_show").html("");
	});
	
}
function homeCoupon(){
	var memberId=$("#memberId").val();
	var siteId=$("#siteId").val();
	$.get("searchHomeCoupons",{memberId:memberId,siteId:siteId,"time":new Date().getTime()},function(result){
		$(".home_coupons").html(result);
	});
	
}
$(".reciveCoupons").die("click").live('click',function(){
	var _this = $(this);
	_this.removeClass('reciveCoupons');
    var username=$("#username").val();
    var loginUrl = $("#companyCasDomain").val() + "?service=" + $("#companyShopDomain").val() + "/" + $("#memberId").val() +"/pd" +  moduleId + ".html";
    if(username=="" || username==undefined){
		 window.location.href = loginUrl;
    }
    var code = _this.prev().val();
    var ifcreate =$(".detailIfcreate_"+code).val();
    if(ifcreate){
    	alert("无法领取自己创建的优惠券!!!");
    	return ;
    }
	var memberId=$("#IM_LOGIN_MEMBER_ID").val();
	var memberSiteId=$("#LOGIN_memberSiteId").val();
    var url = $("#mainDomain").val()+"/ajax/saveCoupons/";
    
	$.ajax({
		url : url+code,
		async : true,
		data : {type:1,memberId:memberId,siteId:memberSiteId,"time":new Date().getTime()},
		dataType : "jsonp",
		type : "get",
		jsonp : "callbackparam",// 传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
		//jsonpCallback : "success_jsonpCallback",// 自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名
		//success : success_jsonpCallback,
		contentType : "application/x-www-form-urlencoded; charset=utf-8",
		success: function(data){
			var dadad=eval(data);
			console.log(data);
			console.log(dadad);
			if(dadad.code==200){
				//alert("领取成功");
				_this.parent().parent().addClass('c_receive');
			}else if(dadad.code==300){
				alert("优惠卷已领取完");
				window.location.reload();
			}else if(dadad.code==400){
				//alert("已领取过");
				_this.parent().parent().addClass('c_receive');
			}else if(dadad.code==100){
			    var loginUrl = $("#companyCasDomain").val() + "?service=" + $("#companyShopDomain").val() + "/" + $("#memberId").val() +"/pd" +  moduleId + ".html";
				window.location.href = loginUrl;
			}else{
				alert("网络异常！");
				window.location.reload();
			}
		},
		error : function(a, b, c) {
			console.log(a);
			console.log(b);
			console.log(c);
		}
	});
	
});
$(".homereciveCoupons").die("click").live('click',function(){
	var _this = $(this);
	_this.removeClass('homereciveCoupons');
    var username=$("#username").val();
    var loginUrl = $("#companyCasDomain").val() + "?service=" + $("#companyShopDomain").val() + "/" + $("#memberId").val();
    if(username=="" || username==undefined){
		 window.location.href = loginUrl;
    }
  
    var code = _this.prev().val();
    var ifcreate =$(".homeIfcreate_"+code).val();
    if(ifcreate){
    	alert("无法领取自己创建的优惠券!!!");
    	return ;
    }
	var memberId=$("#IM_LOGIN_MEMBER_ID").val();
	var memberSiteId=$("#LOGIN_memberSiteId").val();
    var url = $("#mainDomain").val()+"/ajax/saveCoupons/";
    
	$.ajax({
		url : url+code,
		async : true,
		data : {type:1,memberId:memberId,siteId:memberSiteId,"time":new Date().getTime()},
		dataType : "jsonp",
		type : "get",
		jsonp : "callbackparam",// 传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
		//jsonpCallback : "success_jsonpCallback",// 自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名
		//success : success_jsonpCallback,
		contentType : "application/x-www-form-urlencoded; charset=utf-8",
		success: function(data){
			var dadad=eval(data);
			console.log(data);
			console.log(dadad);
			if(dadad.code==200){
				//alert("领取成功");
				_this.parents(".d_coupon_cont").addClass('c_receive');
			}else if(dadad.code==300){
				alert("优惠卷已领取完");
				window.location.reload();
			}else if(dadad.code==400){
				//alert("已领取过");
				_this.parents(".d_coupon_cont").addClass('c_receive');
			}else if(dadad.code==100){
			    var loginUrl = $("#companyCasDomain").val() + "?service=" + $("#companyShopDomain").val() + "/" + $("#memberId").val();
				window.location.href = loginUrl;
			}else{
				alert("网络异常！");
				window.location.reload();
			}
		},
		error : function(a, b, c) {
			console.log(a);
			console.log(b);
			console.log(c);
		}
	});
});
$(".J-timestate s").live({mouseenter:function(){
	
	if($(this).html()==null||$(this).html()=="")return;
	
	$(this).parent().next('.J-timets').show();
	}
});
$(".J-timets").live({mouseleave:function(){
		$(this).hide();
	}
});
