$(function(){

	$(".choice_box ul li").click(function(){
		var x = $(this),
			index = x.index();
		x.addClass('choice_bc').siblings().removeClass('choice_bc');
		$('.show_box ul li').eq(index).removeClass('hide').siblings().addClass('hide');
	})
    /*表格吸顶*/
    $('.right-content').scroll(function () {
        var m = $('.right-content').scrollTop();
        if (m > 0) {
            $(".left-content").css({
                "top": -m + 118 + 'px',
            });
        } else {
            $(".left-content").css({
                "top": 118
            });
        }
    });

    /*实现表格隔行换色*/
    var item = $(".left-content ul");
    for (var i = 0; i < item.length; i++) {
        if (i % 2 == 0) {
            item[i].style.backgroundColor = "#fff";
            $('.right-content ul')[i].style.backgroundColor = "#fff";
        } else {
            item[i].style.backgroundColor = "#eff8ff";
            $('.right-content ul')[i].style.backgroundColor = "#eff8ff";
        }
    }
    // 数量减
    $(".minus").click(function () {
        var t = $(this).parent().find('.am-num-text');
        var minOrderVal = 1;
        t.val() === minOrderVal && t.val('0');
        t.val(parseInt(t.val()) - 1);

        if (t.val() <= 0) {
            t.val(0);
        }
    });
    // 数量加
    $(".plus").click(function () {
        var t = $(this).parent().find('.am-num-text');
        var minOrderVal = 1;
        t.val() === '0' ? t.val(minOrderVal) : t.val(parseInt(t.val()) + 1);
        
        flag = false;
        if (t.val() <= 1) {
            t.val(1);
            flag = false;
        }
    });
    //左边表格自适应宽度
    var leftTitle = $('.left-title > ul');  //title_ul
    var leftchoice = $('.left_choice > ul');  //title_ul
    var column = $('.left-title ul li');
    var leftContent = $('.left-content');   //内容的容器
    var column_w = 200;                     //单列宽度
    var inquiry_left = $('#inquiry_left');
    var rows = leftContent.children().length;
    var contentW = column.length * column_w; //总宽度
    (contentW > 607) ? leftTitle.width(contentW) : leftTitle.width(607);
    (contentW > 607) ? leftContent.width(contentW) : leftContent.width(607);
    (contentW > 607) ? leftchoice.width(contentW) : leftchoice.width(607);
    if (rows < 6) {
        inquiry_left.height(rows * 59 + 59 + 59);
        $('.right-content').height(rows * 59 );
    } else {
        $('.right-content').height(412 - 59);
        inquiry_left.height(412 + 59);
    }

    // 表格排序
    $('.left-title ul li').click(function(){
    	var  x = $(this);
    	if (x.hasClass('up')) {
    		x.addClass('down').siblings().removeClass('up , down');
    		x.removeClass("up");
    	}else{
    		x.addClass('up').siblings().removeClass('up , down');
    		x.removeClass("down");
    	}
    })
    $('.right-title ul li').click(function(){
    	var  x = $(this);
    	if (x.hasClass('up')) {
    		x.addClass('down').siblings().removeClass('up , down');
    		x.removeClass("up");
    	}else{
    		x.addClass('up').siblings().removeClass('up , down');
    		x.removeClass("down");
    	}
    })

    // 下方内容评论tab切换
    $('.evaluate_title ul li').click(function(){
    	var x = $(this),
    		index = x.index();
    	x.addClass('eva_bc').siblings().removeClass('eva_bc');
    	$('.evaluate_con .eva_list').eq(index).show().siblings().hide();
    })

    $('.tips').click(function(){
        var  x = $(this);
        if (x.hasClass("tips_bc")) {
            x.removeClass('tips_bc')
        }else{
            x.addClass('tips_bc')
        }
    })
})