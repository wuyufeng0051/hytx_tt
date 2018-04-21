var objId = $("#list");
$(function(){

	var pageInfo = {totalCount:-1,totalPage:0};
	var first = 1;
	getList(1);

	//删除
	objId.delegate(".del", "click", function(){
		var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
		if(id){
			par.addClass('del');
			setTimeout(function(){
				if(confirm('您确定要删除选中的信息吗？')){
					t.addClass("load");

					$.ajax({
						url: masterDomain+"/include/ajax.php?service=dating&action=delReview&id="+id,
						type: "GET",
						dataType: "jsonp",
						success: function (data) {
							if(data && data.state == 100){

								par.addClass('remove-ing');
								setTimeout(function(){
									par.remove();
									$(window).scroll();
									if(objId.children('.item').length == 0){
										getList(1);
									}
								},300);

							}else{
								alert(data.info);
								t.removeClass("load");
							}
						},
						error: function(){
							alert("网络错误，请稍候重试！");
							t.removeClass("load");
						}
					});
				}else{
					par.removeClass('del');
				}
			},10)
		}
	});

	var win = $(window), winh = win.height(), itemh = 0, isload = false, isend = false;
    win.scroll(function(){
        var sct = win.scrollTop();
        var h = itemh == 0 ? objId.children('.item').height() : itemh;
        var allh = $('body').height();
        var scroll = allh - h - winh;
        if (sct > scroll && !isload && !isend) {
            atpage++;
            getList();
        };
    })

	function getList(is){
		if(is){
			atpage = 1;
	        pageInfo.totalCount = -1;
	        pageInfo.totalPage = 0;
	        objId.html('');
		}

		objId.append('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=dating&action=review&page="+atpage+"&pageSize="+pageSize,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state != 200){
					if(data.state == 100){
						var list = data.info.list, pgInfo = data.info.pageInfo, html = [];

						if(pageInfo.totalCount == -1){
	                        pageInfo.totalCount = pgInfo.totalCount;
	                        pageInfo.totalPage = pgInfo.totalPage;
	                    }

						//拼接列表
						if(list.length > 0){
							for(var i = 0; i < list.length; i++){
								var item    = [],
										member  = list[i].member,
										info    = list[i].info;

								var is = info['isread'] == 1 ? "" : " nr";

								html.push('<div class="item'+is+'" data-id="'+info['id']+'">');
								html.push('	<div class="info-item">')
								html.push('		<a href="'+member['url']+'" target="_blank" class="pic fn-left"><img src="'+member['photo']+'" onerror="javascript:this.src=\''+masterDomain+'/static/images/noPhoto_100.jpg\';" /></a>');
								html.push('		<div class="info">');
								html.push('			<p class="m"><a href="'+member['url']+'">'+member['nickname']+'</a></p>');
								html.push('			<p>'+member['addr'][0]+' <em>|</em> '+member['age']+'岁 <em>|</em> '+member['height']+'cm <em>|</em> '+member['education']+'</p>');
								html.push('			<p class="note"><a href="'+info['url']+'#r'+info['pubdate']+'"><span>say：</span>'+info['note']+'</a></p>');
								html.push('		</div>');
								html.push('	</div>');
								html.push('	<div class="o fn-clear">');
								html.push('		<a href="'+info['url']+'" class="edit">回复</a><a href="javascript:;" class="del">删除</a><a href="javascript:;" class="t">'+huoniao.transTimes(info['pubdate'], 1)+'</a>');
								html.push('	</div>');
								html.push('</div>');

							}
							objId.append(html.join(""));

						}
					}
				}
				checkResult();
			}
		});
	}

	function checkResult(){
		$('.loading').remove();
	    if(pageInfo.totalCount <= 0){
	    	objId.append('<div class="loading">暂无相关信息</div>');
	        isend = true;
	    }else{
	        if(pageInfo.totalPage == atpage){
	            isend = true;
	            objId.append('<div class="loading toend">已显示全部信息</div>')
	        }else{
	            isload = false;
	        }
	    }
	}

});