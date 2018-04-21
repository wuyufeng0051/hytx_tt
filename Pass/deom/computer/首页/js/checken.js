$(document).ready(function(){
	$("img.lazy").lazyload();
	//公共js start
	//单品展销，数量修改
	 $("._Jia1").click(function(){
			var _jiaObj = $(this).parent().parent().prev("input");
			var _jia = _jiaObj.val();
			if(null==_jia||""==_jia||isNaN(_jia)||_jia<1)
				_jiaObj.val(1);
			else
				_jiaObj.val(parseInt(_jiaObj.val())+1);
		 });
		 $("._Jian1").click(function(){
				var _jiaObj = $(this).parent().parent().prev("input");
				var _jia = _jiaObj.val();
				if(null==_jia||""==_jia||isNaN(_jia)||_jia<1)
					_jiaObj.val(0);
				else
					_jiaObj.val(_jiaObj.val()-1);
		 });
			//top滑过出现下拉框
			$(".topMuneList").hover(function(){
				$(this).addClass("snMenuHover")
				$(this).children(".show1").show()
			},function(){
				$(this).removeClass("snMenuHover")
				$(this).children(".show1").hide()
			})
/*		//点击top用户名显示下拉框
			$('.top-1-L .user').mouseenter(function(){
				$(this).toggleClass('z-hov');
			});
			$('.top-1-L .user').mouseleave(function(){
				$(this).removeClass('z-hov');
			})*/
		//logo图片滑动显示tip
		$(".cn-icon").hover( function(){
			$(this).children(".tips").show();
		},function(){
			$(this).children(".tips").hide();	
		});
		$(".J_renzheng").hover( function(){
			$(this).find("span").show();
		},function(){
			$(this).find("span").hide();	
		});
	//公共js end
	$(function() {
		$("#ad_12395078").tb_flash(); //多图广告
	})

	var lis = $("#_photo_scroll_31880550").children("li");
      lis.each(function(i, item) {
        $("#_photo_scroll_31880550").append("<li>" + $(item).html() + "</li>");
      });
      lis.each(function(i, item) {
        $("#_photo_scroll_31880550").append("<li>" + $(item).html() + "</li>");
      });
      lis.each(function(i, item) {
        $("#_photo_scroll_31880550").append("<li>" + $(item).html() + "</li>");
      });
      lis.each(function(i, item) {
        $("#_photo_scroll_31880550").append("<li>" + $(item).html() + "</li>");
      });

      $("#_photo_scroll_31880550").simplyScroll({
        autoMode: 'loop',
        speed: 2
      });
      window._bd_share_config = {
        "common": {
          "bdSnsKey": {},
          "bdText": "",
          "bdMini": "2",
          "bdMiniList": false,
          "bdPic": "",
          "bdStyle": "2",
          "bdSize": "16"
        },
        "share": {
          "bdSize": 16
        }
      };
      with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];
    var $pfj = $(".J-proS-m").find(".J-pf-d").length;

    if ($pfj) {
      $(".J-pf-price").removeClass("pf-price-mTop");
    } else {
      $(".J-pf-price").addClass("pf-price-mTop");
    }
    function setFlash() {
	    $("#photo_single_12395083").tb_flash();
	  }
	  setFlash();
	// 头部幻灯片
	$('.list').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold"})

	$('.arr').hover(function(){
		$('.guanzhu-er').show();
	},function(){
		$('.guanzhu-er').hide();
	})
});

