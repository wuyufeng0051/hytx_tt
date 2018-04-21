$(function(){
	  // 选择
    $('#J_crumbs dd a').click(function(){
        var x = $(this);
        x.addClass('curr');
        x.siblings("a").removeClass('curr');
    })
    
})