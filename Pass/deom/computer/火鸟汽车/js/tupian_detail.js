$(function(){
	$(".flash .hd").slide({mainCell:"ul",autoPage:true,effect:"left",autoPlay:false,vis:9,scroll:9,prevCell:".btn_prev",nextCell:".btn_next",easing:"easeOutCirc"});
	$('.banner').picScroll();
})

+(function ($) {
	$.fn.picScroll = function(options){
		var $this = $(this);
		var defaults = {
			'atpage': '#atpage',		
			'tpage': '#tpage',			
			'bigk': '.bd',	
			'smallk': '.hd ul',		
			'sItem': '.hd ul li'		
		};
		var st = $.extend({},defaults,options);

		var bigk = $(st.bigk);
		var smallk = $(st.smallk);
		var sItem = $(st.sItem);
		var bpnext = $('.next');
		var bpprev = $('.prev');
		var spnext = $('.btn_next');
		var spprev = $('.btn_prev');

		var len = sItem.length;				
		smallk.css('width',(sItem.width() + 8) * len + 'px');
		$(st.atpage).text(1);
		$(st.tpage).text(len);


		var index = 0,							
			showNum = 9,						
			maxMove = 0;						

		$(window).resize(function(){
			showNum = $('html').hasClass('w1200') ? 9 : 8;
			maxMove = len - showNum;
			if(len < showNum) {
				spnext.addClass('disabled');
				spprev.addClass('disabled');
			}
		}).resize();


		if(len < showNum) {
			spprev.addClass('disabled')
		}

		var biglist = '';
		for(var i=0;i < len;i++) {
			biglist += '<div class="big-item big-item-' + i + '"><div class="big-pic"><i></i><img src="" alt="" /></div><div class="slideinfo"><h3>' + sItem.eq(i).attr('data-title') + '</h3><div class="bg"></div></div></div>';
		}
		bigk.append(biglist);

		smallk.attr('data-step',0)

		sItem.click(function(){
			var a = $(this);
			if(a.hasClass('on')) {
				sPic();
				return;
			}
			index = a.index();
			bigPic = a.attr('src');

			dolist();
			a.addClass('on').siblings().removeClass('on');
		}).eq(0).click();

		bpnext.click(function(){
			if(index + 1 < len) {
				index++;
			} else {
				index = 0;
				smallk.attr('data-step',0)
			}
			dolist();
		})
		bpprev.click(function(){
			if(index > 0) {
				index--;
			} else {
				index = len - 1;
				smallk.attr('data-step',maxMove)
			}
			dolist();
		})

		spnext.click(function(){
			if(spnext.hasClass('disabled')) return;
			spprev.removeClass('disabled')
			var step = parseInt(smallk.attr('data-step'));
			if(step + showNum > maxMove) {
				var step = maxMove
				spnext.addClass('disabled')
			} else {
				var step = step + showNum
			}
			var iw = sItem.width() + 8;
			smallk.stop().animate({
				'left' : -step * iw + 'px'
			},300).attr('data-step',step)
		})
		spprev.click(function(){
			if(spprev.hasClass('disabled')) return;
			spnext.removeClass('disabled')
			var step = parseInt(smallk.attr('data-step'));
			if(step - showNum >= 0) {
				var step = step - showNum;
			} else {
				var step = 0;
				spprev.addClass('disabled')
			}
			var iw = sItem.width() + 8;
			smallk.stop().animate({
				'left' : -step * iw + 'px'
			},300).attr('data-step',step)
		})

		function bPic(){
			var item = $('.big-item-' + index);
			var img = item.find('img');
			if(img.attr('src') == '') {
				var bigPic = sItem.eq(index).attr('data-bigpic');
				img.attr('src',bigPic)
			}
			if($('.loading').length > 0) {
				$('.loading').fadeIn();
			} else {
				bigk.append('<div class="loading"></div>');
			}
			if(item.attr('data-load') === undefined) {
				img.load(function(){
					item.attr('data-load','load').fadeIn().siblings().stop(true,true).fadeOut();
				})
			} else {
				item.fadeIn().siblings().stop(true,true).fadeOut();
			}
		}

		function sPic(){
			sItem.eq(index).addClass('on').siblings().removeClass('on');
			if(len < showNum) return;
			var step = parseInt(smallk.attr('data-step'));
			var iw = sItem.width() + 8;
			if(index + 1 == step + showNum) {
				if(step < maxMove) {
					step++;
				}
				smallk.stop().animate({
					'left' : -step * iw + 'px'
				},500).attr('data-step',step)
			}
			if(index == step) {
				if(step > 0) {
					step--;
				}
				smallk.stop().animate({
					'left' : -step * iw + 'px'
				},500).attr('data-step',step)
			}
			if(smallk.attr('data-step') && smallk.attr('data-step')  != '0' ) {
				spprev.removeClass('disabled');
			} else {
				spprev.addClass('disabled');
			}
			if(parseInt(smallk.attr('data-step')) >= maxMove ) {
				spnext.addClass('disabled');
			} else {
				spnext.removeClass('disabled');
			}
		}

		function showPage(){
			$(st.atpage).text(index + 1);
		}

		keyDown()
		function keyDown(){
			var keydownId;
			$(window).keydown(function(e){
				clearTimeout(keydownId);
				keydownId = setTimeout(function(){
					var keyCode = e.keyCode;
					if(keyCode == 37){
						bpprev.click();
					}else if(keyCode == 39){
						bpnext.click();
					}
				},150);
			});
		}

		function dolist(){
			bPic();
			sPic();
			showPage();
		}
	}
})(jQuery);