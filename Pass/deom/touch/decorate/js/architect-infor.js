$(function(){
    // 免费预约
	$('.mf_yu i').click(function(){
    	var  x = $(".yuyue_list");
    	if (x.css("display")=="none") {
    		x.show();
    		$('.disk').show();
    	}else{
    		x.hide();
    		$('.disk').hide();
    	}
    })
    $('.yuyue_list p').click(function(){
    	$('.disk').hide();
    	$('.yuyue_list').hide();
    })
     $('.disk').on('click',function(){
        $('.disk').hide();
    	$('.yuyue_list').hide();
    })
})