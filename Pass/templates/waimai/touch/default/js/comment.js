$(function(){

	$("#starCon b").each(function(){
		var t = $(this), width = t.attr("data-width");
		t.width(width);
	})

	// 收藏
	$('.lead b').click(function(){
		if ($('.lead b').hasClass('lead_bc')) {
			$('.lead b').removeClass('lead_bc');

			$.post("/include/ajax.php?service=member&action=collect&module=waimai&temp=shop&type=del&id="+id);
		}else{
			$('.lead b').addClass('lead_bc');

			$.post("/include/ajax.php?service=member&action=collect&module=waimai&temp=shop&type=add&id="+id);
		};
	})

	var loading = $(".loading"), isload = false, page = 1;

	if(totalCount == 0){
		loading.text(langData['waimai'][2][100]);
	}else{
		getList(1);
	}

	$(window).scroll(function(){
		var sct = $(window).scrollTop();
		if(!isload && sct + $(window).height() + 100 > $('body').height()){
			page++;
			getList();
		}
	})

	function getList(first){

		isload = true;

		var data = [];
		data.push('sid='+id);

		loading.show();
		$.ajax({
			url: masterDomain + '/include/ajax.php?service=waimai&action=common&page='+page+'&pageSize=10',
			type: 'get',
			data: data.join("&"),
			dataType: 'jsonp',
			success: function(data){
				if(data && data.state == 100){

					var list = data.info.list, html = [];

					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var obj = list[i], item = [];
							item.push('<div class="item">');
							item.push('<div class="com_txt">');
							item.push('<span class="user">'+obj.user+'</span><p>'+obj.content+'</p>');
							item.push('<span class="date fn-clear"><em>'+obj.pubdatef+'</em></span>');
							item.push('<div class="pingjia star'+obj.star+'"><i></i></div>');
							item.push('</div>');
							if(obj.reply != "" && obj.replaydate != 0){
								item.push('<div class="reply">');
								item.push('<p>'+langData['siteConfig'][16][67]+obj.reply+'<span>'+obj.replydatef+'</span></p>');
								item.push('</div>');
							}
							item.push('</div>');

							html.push(item.join(""));
						}

						loading.hide().before(html.join(""));

						isload = false;

					}else{
						loading.text(langData['waimai'][2][20]);
					}
				}else{
					loading.text(langData['waimai'][2][20]);
				}
			},
			error: function(){
				isload = false;
				loading.text(langData['siteConfig'][20][458]);
			}
		})

	}

})
