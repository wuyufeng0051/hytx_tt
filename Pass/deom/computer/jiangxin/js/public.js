$(function(){
	//发布招标
	$(".header .entry").hover(function(){
		$(this).find(".dropdown-menu").stop().show();
	}, function(){
		$(this).find(".dropdown-menu").stop().hide();
	});

	// -------------------右侧 留下足迹
	// 显示/隐藏表单
	$('.leaveMsg .k1').hover(function(){
		var p = $('.leaveMsg .pen');
		p.addClass('hover');
	},function(){
		var p = $('.leaveMsg .pen');
		p.removeClass('hover');
	}).click(function(){
		var b = $('.leaveMsg');
		b.toggleClass('open').children('.k2').toggleClass('show');
	})
	// 隐藏按钮
	$('.leaveMsg .close').click(function(){
		$('.leaveMsg').toggleClass('open').children('.k2').toggleClass('show');
	})
	//区域
	$("#rAddrlist").delegate("select", "change", function(){
		var sel = $(this), id = sel.val(), index = sel.index();

		if(id == 0){
			sel.nextAll("select").remove();
		} else if(id != 0 && id != "" && index < 1){
			$.ajax({
				type: "GET",
				url: "http://imenhu.cc/include/ajax.php",
				data: "service=siteConfig&action=addr&son=0&type="+id,
				dataType: "jsonp",
				success: function(data){
					var i = 0, opt = [];
					if(data instanceof Object && data.state == 100){
						for(var key in data.info){
							opt.push('<option value="'+data.info[key]['id']+'">'+data.info[key]['typename']+'</option>');
						}
						sel.nextAll("select , span").remove();
						$("#rAddrlist").append('<select name="addrid[]"><option value="0">请选择</option>'+opt.join("")+'</select>');
					}else{

					}
				},
				error: function(msg){
					alert(msg.status+":"+msg.statusText);
				}
			});
		}
	});
	//提交
	$('.leaveMsg .form').submit(function(){
		var f = $(this);
		f.find('.has-error').removeClass('has-error');
		var str = '',r = true;

		// 称呼
		var name = f.find('.username');
		var namev = $.trim(name.val());
		if(namev == '') {
			name.focus().addClass('has-error');
			str = '请填写您的称呼';
			showError(name,str);
			r = false;
		} else {
			if(namev.length > 6 || namev.length < 2) {
				name.focus().addClass('has-error');
				str = '您的称呼应该在2到4个字符之间';
				showError(name, str);
				r = false;
			}
		}

		// 手机号
		var phone = f.find('.userphone');
		var phonev = $.trim(phone.val());
		if(phonev == '') {
			str = '请输入手机号码';
			phone.addClass('has-error');
			if (r) {
				phone.focus();
				showError(phone, str);
			}
			r = false;
		} else {
			var telReg = !!phonev.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
			if(!telReg){
			    str = '请输入正确手机号码';
			    phone.addClass('has-error');
			    if (r) {
			    	phone.focus();
			    	showError(phone,str);
			    }
			    r = false;
			}
		}

		// 城市
		var arrList = $('#rAddrlist');
		var arrSle = arrList.children('select');
		var lastSle = arrSle.eq(arrSle.length - 1);
		if(lastSle.val() == 0) {
			str = '请选择城市';
			lastSle.addClass('has-error');
			if (r) {
				showError(lastSle, str);
			}
			r = false;
		}

		if(!r) {
			return false;
		}
	})

})

+(function ($) {
	// 大图布局
	$.fn.masonryLoad = function(options){
		var $container = $(this);

		var defaults = {
			'atpage': 1,				//当前页码
			'showScreen': 4,			//显示4屏
			'everyShow': 9,				//每次滚动加载9条
			'topPage' : false,			//第二分页
			'totalCount': 0
		};
		var st = $.extend({},defaults,options);

		st.totalCount = $('#hidenbox .item').length;
		var page = $('.pagination-pages');
		if(st.topPage) {
			var topPage = $('#pagesf');
		}
		if(st.totalCount > 0) {
			var html = '',itemArr = [],allPageNum,scrollNum = 1,aloneMaxScrNum;
			var first = true;
			var lastType;						//调整窗口时判断是否改变box尺寸

			html = $('#hidenbox').html();
			$('#hidenbox').remove();
			itemArr = html.split('$$');
			allPageNum = Math.ceil(st.totalCount/ (st.everyShow * st.showScreen));
			aloneMaxScrNum = Math.ceil(st.totalCount % (st.everyShow * st.showScreen) / 9);
			console.log(aloneMaxScrNum)

			$(window).resize(function() {
				var cw = 328;
				gutterWidth = 8;
				if ($('html').hasClass('w1200')) {
					if (!first && lastType == 'w1200') return;
					lastType = 'w1200';
					cw = 390;
					gutterWidth = 15;
				} else {
					if (!first && lastType == 'w1000') return;
					lastType = 'w1000';
				}

				$container.masonry({
					columnWidth: cw,
					itemSelector: ".item",
					gutterWidth: gutterWidth,
					isAnimated: false,
					isRTL: false
				})
				first = false;
			}).resize();
			getZhuangDate();

			var loadMoreLock = false , pageFirst = true;
			$(window).scroll(function(){
				if(pageFirst || loadMoreLock || (st.atpage == allPageNum && scrollNum >= aloneMaxScrNum) || scrollNum >= st.showScreen) {
					pageFirst = false;
					return;
				}
				console.log('klllkl')
				var sct = $(document).scrollTop();
				if(sct + $(window).height() + 400 > $(document).height()) {
					loadMoreLock = true;
					scrollNum++;
					getZhuangDate();
					console.log('===' + scrollNum + '===')
				}
			})
		} else {
			$container.html('<div id="loading">暂无数据!</div>');
			page.parent().remove();
		}

		function getZhuangDate() {
			var nowPageNum = st.atpage;
			if(scrollNum == 1) {
				$container.html('<div id="loading">正在加载,请稍后</div>');
			} else {
				if(!$('#loading').length > 0) {
					$container.append('<div id="loading">正在加载,请稍后</div>');
				} else {
					$('#loading').fadeIn();
				}
			}
			// 获取数据
			var str = '';
			for(var i in itemArr) {
				var start = 1 + (nowPageNum - 1) * (st.everyShow * st.showScreen) + (scrollNum - 1) *  st.everyShow;
				var end = start + 9;
				if(i >= start && i < end) {
					str += itemArr[i].replace('data-url','src');
				}
			}

			// str = '<div class="item zwf zwf1"></div><div class="item zwf zwf2"></div>' + str
			var $elems = $(str);

			if(!$('#tempBox').length > 0) {
				$container.after('<div id="tempBox" style="width:100%;height:0;"></div>')
			}
			$('#tempBox').stop().animate({'height':'500px'},0,function(){
				$('#loading').remove();
				$container.append($elems);
				$container.masonry('appended', $elems, 'isAnimatedFromBottom');
				setTimeout(function() {
					// $('.zwf').remove();
					$container.masonry('reload');
					$('#tempBox').animate({'height':0},500);
				}, 200);
				loadMoreLock = false;

				showPageInfo();
			})
		}

		function showPageInfo(){
			page.html('').hide();
			var pageList = [];
			var topPageList = [];
			//上一页
			if(st.atpage > 1){
				pageList.push('<a class="first">首页</a><a class="prev">上一页</a>');
				topPageList.push('<i class="left prev">&lt;</i>');
			}else{
				pageList.push('<span class="first disabled">首页</span><span class="prev disabled">上一页</span>');
				topPageList.push('<i class="left disabled">&lt;</i>');
			}

			// 拼接分页
			for(var i=1;i<=allPageNum;i++) {
				if(i == st.atpage) {
					pageList.push('<span class="curr">' + i + '</span>');
					topPageList.push('<span class="curr">' + i + '</span>');
				} else {
					pageList.push('<a>' + i + '</a>');
					topPageList.push('<a>' + i + '</a>');
				}
			}

			//下一页
			if(st.atpage >= allPageNum){
				pageList.push('<span class="next disabled">下一页</span><span class="last disabled">末页</span>');
				topPageList.push('<i class="right next disabled">&gt;</i>');
			}else{
				pageList.push('<a class="next">下一页</a><a class="last">末页</a>');
				topPageList.push('<i class="right next">&gt;</i>');
			}
			page.html(pageList.join(""));
			page.show();

			if(st.topPage) {
				console.log(topPageList)
				topPage.html(topPageList.join(""));
			}
		}
}
// 		// 分页
// 		var offtop = $container.offset().top - 20;
// 		if(st.topPage) {
// 			offtop -= 35;
// 		}
// 		$(document).on('click','.pagination span,.pagination a , #pagesf *',function(){
// 			var t = $(this);
// 			if(t.hasClass('curr') || t.hasClass('disabled')) return;
// 			$container.html('').css({'height':'auto'});
// 			$container.masonry('reload');
// 			if(t.hasClass('first')) {
// 				st.atpage = 1;
// 			} else if (t.hasClass('prev')) {
// 				st.atpage--;
// 			} else if (t.hasClass('next')) {
// 				st.atpage++;
// 			} else if (t.hasClass('last')) {
// 				st.atpage = allPageNum;
// 			} else {
// 				st.atpage = parseInt(t.text());
// 			}
// 			scrollNum = 1;
// 			getZhuangDate();
// 			$('html, body').animate({scrollTop:offtop + 'px'}, 300);
// 		})
// 	}
// })(jQuery);

// 	function showError(obj,str) {
// 		var oid = obj.attr('id');
// 		if(oid === undefined) {
// 			var t = new Date().getTime();
// 			oid = 'layer' + t;
// 			obj.attr('id',oid);
// 		}
// 		layer.tips(str, '#' + oid);
// 	}