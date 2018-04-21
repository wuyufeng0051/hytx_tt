$(function(){
	$(".service_box ul li").click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('ser_bc').siblings().removeClass('ser_bc');
		$('.ServiceConnect .SC_List').eq(index).show().siblings().hide();
	})
	function getQueryString(){
	    var url = window.location.href;
	    var num = url.indexOf("?");
	    var str = url.substr(num + 1);
	    var arr = str.split("&");
	    var name = "";
	    var value = "";
	    for(var i = 0; i < arr.length; i++)
	    {
	        num = arr[i].indexOf("=");
	        if(num > 0)
	        {
	            name = arr[i].substring(0, num);
	            value = arr[i].substr(num + 1);
	            this[name] = value;
	        }
	    }
	}
    var request = new getQueryString().id;
    if (request == undefined) {
    	request = 0;
    	$(".service_box ul li").eq(request).addClass('ser_bc').siblings().removeClass('ser_bc');
    	$('.ServiceConnect .SC_List').eq(request).show().siblings().hide();
    }else{
    	$(".service_box ul li").eq(request).addClass('ser_bc').siblings().removeClass('ser_bc');
    	$('.ServiceConnect .SC_List').eq(request).show().siblings().hide();
    }
})