$(function(){
	/*setTimeout(function(){
		$(".title").addClass("triggered")
		hideText();
		showUl();
	},2000)
	$(".title").hover(function(){
		if($(this).hasClass("triggered")){
			return;
		}
		hideText();
		showUl();
	},function(){
		
	})
	*/
	
	var swiper = new Swiper('.swiper-container1', {
        pagination: '.swiper-pagination1',
        nextButton: '.swiper-button-next1',
        prevButton: '.swiper-button-prev1',
        slidesPerView: 1,
        paginationClickable: true,
        autoplayDisableOnInteraction : false,
        loop: true,
        autoplay :5000
    });
    new Swiper('.swiper-container2',{
        nextButton: '.swiper-button-next2',
        prevButton: '.swiper-button-prev2',
        slidesPerView: 5,
        autoplayDisableOnInteraction : false,
        loop: true,
    })
    // var sum = 0;
    // var timer;
    $(".swiper-container1 .swiper-wrapper").hover(function(){
    	// swiper.stopAutoplay();
    	// timer = setTimeout(function(){
    	// 	sum++;
    	// },1000);
    },function(){
    	// if(sum > 4){
    	// 	swiper.slideNext();
    	// 	clearTimeout(timer)
    	// 	sum = 0;
    	// }
    	swiper.startAutoplay();
    });
    $(".swiper-container2").hover(function(){
    	swiper.stopAutoplay();
    },function(){
    	swiper.startAutoplay();
    });
    $('.swiper-slide img').hover(function(){
    	$('.swiper-button-prev1,.swiper-button-next1').css({
    		"opacity":".2"
    	})
    },function(){
    	$('.swiper-button-prev1,.swiper-button-next1').css({
    		"opacity":"0"
    	})
    });
    $('.swiper-button-prev1,.swiper-button-next1').hover(function(){
    	$(this).css({
    		"opacity":".5"
    	})
    });
    $('.swiper-button-prev2,.swiper-button-next2').hover(function(){
    	$(this).css({
    		"opacity":".3"
    	})
    });
    $('.swiper-container2 li').hover(function(){
    	$('.swiper-button-prev2,.swiper-button-next2').css({
    		"opacity":".2"
    	})
    },function(){
    	$('.swiper-button-prev2,.swiper-button-next2').css({
    		"opacity":"0"
    	})
    });
    //鼠标移入icon-intro时图片路径改变
    $('.icon-intro1').hover(function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro1.png")
    },function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro01.png")
    });
    $('.icon-intro2').hover(function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro2.png")
    },function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro02.png")
    });
    $('.icon-intro3').hover(function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro3.png")
    },function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro03.png")
    });
    $('.icon-intro4').hover(function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro4.png")
    },function(){
    	$(this).find('.icon-intro').attr("src","/zjpc/images/icon-intro04.png")
    });
    scroll($(".scroll-1"));
    //进度条
    function percentProgressWidth(){
		var percentProgressWidth = $($('.financing-project .propressBar')[0]).width();
		$('.financing-project .propres').each(function(index,item){
			var thisWidth = $(this).width();
			// var percentProgressBarVal = $thisSpan.attr('percent');
			// var spanLength = $thisSpan.width();
			var newPercent = thisWidth /percentProgressWidth*100;
			if(newPercent>100){
				$(item).width('100%');
			}else{
				$(item).width(newPercent+'%');
			}
		});
	}
	percentProgressWidth();

	
	$('.greenhand li').hover(function(){
		$(this).find('span').css({
			"color":"#ff841b",
		})
	},function(){
		$(this).find('span').css({
			"color":"#242424"
		})
	})
	$('.lastLi').hover(function(){
		$(this).find('span').css({
			"color":"#000",
		})
	},function(){
		$(this).find('span').css({
			"color":"#000"
		})
	})

	$('.article-title').hover(function(){
		$('.shade-img').stop().animate({
			"opacity":".5"
		},500)
	},function(){
		$('.shade-img').stop().animate({
			"opacity":"1"
		},500)
	})
	$('.partner-info li').hover(function(){
		$(this).find(".partner-intro").stop().animate({
			"opacity":"1"
		},600);
	},function(){
		$(this).find(".partner-intro").stop().animate({
			"opacity":"0"
		},600);
	});

	//鼠标移上箭头出来
	$('.case1').hover(function(){
		$('.arrows-img').css({
			"display":"block",
			"cursor":"pointer"
		})
	},function(){
		$('.arrows-img').css({
			"display":"none"
		})
	});
	var flag = 1;
	$(".arrows-img").on('click',function(){
		if(flag){
			$(".contain-case1").css({
				"display":"none"
			});
			$(".contain-case2").css({
				"display":"block"
			});
			$(".arrows-img").css({
				"transform":"rotateZ(180deg)",
				"-ms-transform":"rotateZ(180deg)",
				"-o-transform":"rotateZ(180deg)",
				"-moz-transform":"rotateZ(180deg)",
				"-web-transform":"rotateZ(180deg)",
			})
			flag = 0;
		}else{
			$(".contain-case2").css({
				"display":"none"
			});
			$(".contain-case1").css({
				"display":"block"
			});
			$(".arrows-img").css({
				"transform":"rotate(360deg)",
				"-ms-transform":"rotate(360deg)",
				"-o-transform":"rotate(360deg)",
				"-moz-transform":"rotate(360deg)",
				"-web-transform":"rotate(360deg)"
			});
			flag = 1;
		}
		
	})
 //    new Swiper('.swiper-container2_1', {
 //        nextButton: '.swiper-button-next2_1',
 //        prevButton: '.swiper-button-prev2_1',
 //        slidesPerView: 2,
 //        paginationClickable: true,
 //        loop: true,
 //        /*autoplay :300*/
 //    });
 //    new Swiper('.swiper-container2_2', {
 //        nextButton: '.swiper-button-next2_2',
 //        prevButton: '.swiper-button-prev2_2',
 //        slidesPerView: 2,
 //        paginationClickable: true,
 //        loop: true,
 //        /*autoplay :300*/
 //    });
 //    new Swiper('.swiper-container3', {
 //        pagination: '.swiper-pagination3',
 //        nextButton: '.swiper-button-next3',
 //        prevButton: '.swiper-button-prev3',
 //        slidesPerView: 4,
 //        paginationClickable: true,
 //        loop: true,
 //        /*autoplay :300*/
 //    });
	//scroll($("#scroll-1"));
	
	/*明星投资人移入事件*/
	$(".index .star li").hover(function(){
		var $this = $(this);
		$this.css({
			"border-radius":"0"
		})
		$this.children("div.bg").stop().animate({
			"border-radius":"0",
			"width":"268px",
			"height":"297px",
			"padding-top":"3px",
			"margin":"6px"
		},200);
		$this.children("div.border").stop().animate({
			"width":"42px",
			"height":"42px"
		},200);
	},function(){
		var $this = $(this);
		$this.css({
			"border-radius":"4"
		})
		$this.children("div.bg").stop().animate({
			"border-radius":"4",
			"width":"280px",
			"height":"303px",
			"padding-top":"9px",
			"margin":"0"
		},200);
		$this.children("div.border").stop().animate({
			"width":"0px",
			"height":"0px"
		},200);
	})

	$(".ljyy").on("click",function(){
		new Balloon(6,{
			"title":"预约"
		},
		{
			url:"/ajax/send_advisory_2",
			callback:success
		});
	})
	function success(msg){
		new Balloon(1,{
			"title":"预约",
			msg:msg
		});
	}

})
//隐藏文字动态
function hideText(){
	$(".title div h2").css({
		"opacity": "0"
	});
	$(".title div h1").css({
		"opacity": "0"
	});
	$(".title div h1 span").animate({
		margin:"0 10px"
	},700)
}
//列表出现动态动态
function showUl(){
	setTimeout(function(){
		$(".title div ul").css({
			"opacity": "1"
		});
		$(".title div ul li").css({
			"margin-top": "0"
		});
	},700)
}




