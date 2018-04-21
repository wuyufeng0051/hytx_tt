$(function(){

	$("img").scrollLoading();


	// 下拉加载
	$(document).ready(function() {
		$(window).scroll(function() {
			var allh = $('body').height();
			var w = $(window).height();
			var scroll = allh - 200 - w;
			if ($(window).scrollTop() > scroll && !isload) {
				atpage++;
				getList();
			};
		});
	});



	//初始加载
	getList();

	//数据列表
	function getList(tr){

		isload = true;

		//如果进行了筛选或排序，需要从第一页开始加载
		if(tr){
			atpage = 1;
			$("#list").html("");
		}


		$("#list .loading").remove();
		$("#list").append('<div class="loading">加载中...</div>');

		//请求数据
		var data = [];
		data.push("pageSize="+pageSize);

		data.push("page="+atpage);

		$.ajax({
			url: "/include/ajax.php?service=renovation&action=diary&company="+company,
			data: data.join("&"),
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data){
					if(data.state == 100){
						$("#list .loading").remove();
						var list = data.info.list, html = [];
						if(list.length > 0){
							for(var i = 0; i < list.length; i++){

								html.push('<ul>');
								html.push('<li>');
                html.push('<a href="'+list[i].url+'">');
                html.push('<img src="'+list[i].litpic+'" alt="">');
                html.push('<span>');
                html.push('<h1>'+list[i].title+'</h1>');
                html.push('<p>'+list[i].btype+'&nbsp;&nbsp;&nbsp;'+list[i].style+'&nbsp;&nbsp;&nbsp;'+list[i].units+'&nbsp;&nbsp;&nbsp;'+list[i].price+'万</p>');
                html.push('</span>');
                html.push('</a>');
                html.push('</li>');


							}

							$("#list").append(html.join(""));
							isload = false;

							//最后一页
							if(atpage >= data.info.pageInfo.totalPage){
								isload = true;
								$("#list").append('<div class="loading">已经到最后一页了</div>');
							}

						//没有数据
						}else{
							isload = true;
							$("#list").append('<div class="loading">暂无相关信息</div>');
						}

					//请求失败
					}else{
						$("#list .loading").html(data.info);
					}

				//加载失败
				}else{
					$("#list .loading").html('加载失败');
				}
			},
			error: function(){
				isload = false;
				$("#list .loading").html('网络错误，加载失败！');
				$('.choose-box').removeClass('choose-top');
			}
		});
	}







})
