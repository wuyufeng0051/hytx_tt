$(function(){
	// 图集幻灯片
	$('.list').slide({mainCell:".bd", autoPlay:false, autoPage:false,effect:"fold",pageStateCell:".page_count"})
	
	$(".BC_lead ul li").click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('BCL_bc').siblings().removeClass('BCL_bc');
		$(".BC_box .BC_list").eq(index).show().siblings().hide();
	})

	$(".ShopInfo_de ul li.shop_location span a").click(function(){
		layer.open({
		  type: 1,
		  title:'商家位置',
		  area: ['1000px', '661px'], //宽高
		  content: '<div id="allmap"></div>'
		});
		var map1 = new BMap.Map("allmap");            // 创建Map实例
	    var point1 = new BMap.Point(116.404, 39.915);  
	    map1.centerAndZoom(point1,15);               
	    map1.enableScrollWheelZoom(); 
	    var marker = new BMap.Marker(point1);  // 创建标注
		map1.addOverlay(marker);               // 将标注添加到地图中

		var searchInfoWindow1 = new BMapLib.SearchInfoWindow(map1, "信息框1内容", {
			title: "信息框1", //标题
			panel : "panel", //检索结果面板
			enableAutoPan : true, //自动平移
			searchTypes :[
				BMAPLIB_TAB_SEARCH,   //周边检索
				BMAPLIB_TAB_TO_HERE,  //到这里去
				BMAPLIB_TAB_FROM_HERE //从这里出发
			]
		});
		searchInfoWindow1.open(point1);
	})
  
  	$(".business_pic").click(function(){
  		$('.list').show();
  		$('.disk').show();
  	})
  	$(".disk").click(function(){
  		$('.list').hide();
  		$('.disk').hide();	
  	})
  	$(".list .close").click(function(){
  		$('.list').hide();
  		$('.disk').hide();	
  	})

})