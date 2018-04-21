// 主导航hover
	$('.mainnav li').hover(function(){
		var a = $(this);
		a.addClass('curr');
	},function(){
		var a = $(this);
		a.removeClass('curr');
	})

	$mbg = $('<div class="modal-bg" style="position:fixed;left:0;top:0;width:100%;height:100%;background:#000;opacity:.5;filter:alpha(opacity=50);z-index:1999;display:none"></div>');
