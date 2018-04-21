$(function(){
	$('.banner ').slide({mainCell:".wrap .slide", titCell:".hd ul", autoPlay:true, autoPage:"<li><a></a></li>",effect:"fold"})
	// 搜索框选择
	$('.choice_list p').click(function(){
			var  x = $(this);
			var  b = x.text();
			$('.choice em').text(b);
	})
})