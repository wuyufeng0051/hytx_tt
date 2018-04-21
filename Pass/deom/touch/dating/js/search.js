$(function(){
	// 筛选
	$('.header-search p img').click(function(){
		var x = $(this);
		var box = $('.se-list') 
		if (box.css('display') == 'none'){
			x.addClass('fan');
			$('.se-list').show();
			$('.disk').show();
		}else {
			x.removeClass('fan');
			$('.se-list').hide();
			$('.disk').hide();
		}
	})
	$('.disk').click(function(){
		$('.se-list').hide();
		$('.disk').hide();
		$('.header-search p img').removeClass('fan');
	})
	// 点关注
	 $('.last-nic').click(function(){
        var  x = $(this);
        if (x.hasClass('guanzhu')) {
            x.removeClass('guanzhu');
        }else{
            x.addClass('guanzhu');
        }
    })
	// 发私信
    $('.sea-infor span,.first-nic').click(function(){
        var x = $(this);
        var box = $('.txt') 
        if (box.css('display') == 'none'){
            $('.txt').show();
            $('.disk').show();
        }else {
            $('.txt').hide();
            $('.disk').hide();
        }
    })
    $('.disk,.txt p').click(function(){
        $('.txt').hide();
        $('.disk').hide();
    })
    // 打招呼
    $('.second-nic').click(function(){
    	var x = $(this);
    	var dom = x.closest('.second-nic')
    	dom.find('.op').hide();
    	dom.find('.do').show();
    	$('.zhaohu').show();
    	setTimeout(function(){$('.zhaohu').hide()},1000);
    })

	// 列表body置顶
	$('.header-search p img,.first-nic').click(function(){
		var dom = $('.se-list')
		if (dom.css('display') == 'none'){
			$('body').removeClass('by')
		}else{
			$('body').addClass('by')
		}
	})
	$('.first-nic').click(function(){
		var dom = $('.txt')
		if (dom.css('display') == 'none'){
			$('body').removeClass('by')
		}else{
			$('body').addClass('by')
		}
	})
	$('.disk,.txt p').click(function(){
		var dom = $('.disk')
		if (dom.css('display') == 'none'){
			$('body').removeClass('by')
		}else{
			$('body').addClass('by')
		}
	})

	// 区域选择
	$("#addrid").change(function(){
	    $("#addrid option").each(function(i,o){
	        if($(this).attr("selected"))
	        {
	           $(".area2").hide();
	           $(".area2").eq(i).show();
	        }
	    });
	});
	$("#addrid").change();


	// var a = $('#agebegin')
	// var b = a.text();
	// $('.age-t span').text(b);
	
	$('#agebegin').change(function(){
		var t = $(this), val = t.val();
		$('.age-t span').text(val);
	})
	$('#ageend').change(function(){
		var t = $(this), val = t.val();
		$('.age-t em').text(val);
	})
	$('#h1').change(function(){
		var t = $(this), val = t.val();
		$('.hei-t span').text(val);
	})
	$('#h2').change(function(){
		var t = $(this), val = t.val();
		$('.hei-t em').text(val);
	})
	$('#addrid').change(function(){
		var t = $(this), val = t.val();
		$('.pla-t span').text(val);
	})
	$('.area2').change(function(){
		var t = $(this), val = t.val();
		$('.pla-t em').text(val);
	})
	$('#lear').change(function(){
		var t = $(this), val = t.val();
		$('.lear-t span').text(val);
	})
	$('#money-1').change(function(){
		var t = $(this), val = t.val();
		$('.mone-t span').text(val);
	})
})