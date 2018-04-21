$(function(){
	// 勾选
	$('.noti_list .item_list .item .it_1 span').click(function(){
		var x = $(this);
		var near = x.closest('.it_1').find('span');
		if (x.hasClass('it_bc')) {
			near.removeClass('it_bc');
		}else{
			near.addClass('it_bc');
		}
	})
	// 详情展开
	$('.noti_list .item_list .item .it_2 i').click(function(){
		var x = $(this);
		var near = x.closest('.it_2').find('a');
		var close = x.closest('.item ')
		if (near.hasClass('it_height')) {
			near.removeClass('it_height');
			close.removeClass('it_height');
			x.removeClass('xuan');
		}else{
			near.addClass('it_height');
			close.addClass('it_height');
			x.addClass('xuan');
		}
	})
	// 全选
	$('.noti_list .item_list .it_foot .all_choice').click(function(){
		var x = $(this);
		var near = x.closest('.item_list ').find('.item span');
		if (x.hasClass('it_bc')) {
			near.removeClass('it_bc');
			x.removeClass('it_bc');
		}else{
			near.addClass('it_bc');
			x.addClass('it_bc');
		}
	})
	  // 删除
  $('.del').click(function(){
    var span = $('.it_bc'), item = span.closest('.item');
    item.remove();
  })

  // 标记为已读
  $('.biaoji').click(function(){
    var span = $('.it_bc'), item = span.closest('.item'), i = item.find('.it_1 i');
    i.text('已读');
  })
})