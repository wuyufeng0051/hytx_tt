$(function(){
	//-----------------------------input点击效果----------------------------
	function myVal(inputClassName){
		var inputName="."+inputClassName; 
		$(inputName).css("color","#aaa"); 
		$(inputName).focus(function(event) {
			$a1val = $(this).val();
			if ($a1val == this.defaultValue) {
				$(this).val("");
				$(this).css("color","#3c3c3c");
			} else {
				$(this).val($a1val);
				//$(this).css("color","#aaa");
			}
		});
		$(inputName).blur(function() {
			$a1val = $(this).val();
			if ($a1val != "") {
				$(this).val($a1val);
				//$(this).css("color","#3c3c3c");
			} else {
				$(this).val(this.defaultValue);
				$(this).css("color","#aaa");
			}
		})
	};
	myVal("inpTxt");

    //搜索产品
	$("#search_product_btn").click(function(){

		var siteId=$("#searchSiteId").val();
		var memberId=$("#searchMemberId").val();
		var productName=$("#productName").val();
		var lowPrice=$("#lowPrice").val();
		lowPrice= lowPrice.replace("￥","");
		 if(isNaN(lowPrice)){
			 alert("最小价格只能为数字");
			 return;
		  }
		 
	    var highPrice=$("#highPrice").val();
	    highPrice= highPrice.replace("￥","");
	    if(isNaN(highPrice)){
			 alert("最大价格只能为数字");
			 return;
		  }
	    var valstr=/^[A-Za-z0-9\u4e00-\u9fa5\s]*$/ig;
	    var orderName=$("#formDateOrderName").val();
	    if(!valstr.test(productName)){
	    	alert('包含特殊字符');
	    	}
	  
	    var asc=$("#formDateAsc").val();
	    var viewType=$("#formDateViewType").val();
	  	var currentPage=1;
	  	//window.location.href=basePath+"browse/product/search?siteId="+siteId+"&memberId="+memberId+"&productName="+productName+"&lowPrice="+lowPrice+"&highPrice="+highPrice+"&currentPage="+currentPage;
	  	window.location.href=$("#searchPath").val()+"search.html?productName="+encodeURI(encodeURI(productName))+"&lowPrice="+lowPrice+"&highPrice="+highPrice+"&currentPage="+currentPage;
});
});