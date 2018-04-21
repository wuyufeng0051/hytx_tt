$(function(){
	    
  		$('.he_he li').click(function(){
    	var t = $(this);
    	var index = t.index();
    	$(' .r_r').eq(index).show().siblings().hide();
    	t.addClass('active').siblings().removeClass('active');

    	})
      $('.tab_menu li').click(function(){
    	var t = $(this);
    	var index = t.index();
    	$('.tab_box .tab').eq(index).show().siblings().hide();


      
    })   
    $('.list').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold",prevCell:".arrow-left", nextCell:".arrow-right"})

})