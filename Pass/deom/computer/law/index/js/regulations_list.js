	$(function(){
		$('.select select').change(function(){
			var t = $(this), val = t.val(), parent = t.closest('.select');
			parent.find('span em').text(val);
		})
	})