$(function(){
	$("img").scrollLoading();

	var pageInfo = {totalCount:-1,totalPage:0};

    var con = $('#content'), clist = con.children('ul');
    var win = $(window), winh = win.height(), itemh = 0, isload = false, isend = false;
    win.scroll(function(){
        var sct = win.scrollTop();
        var h = itemh == 0 ? clist.children('li').height() : itemh;
        var allh = $('body').height();
        var scroll = allh - h - winh;
        if (sct > scroll && !isload && !isend) {
            atpage++;
            getList();
        };
    })

    var ftfix = true;
    getList();
	function getList(){
		isload = true;
        $('.loading').remove();
        con.append('<div class="loading">正在加载，请稍后······</div>');

        $.ajax({
            url: '/include/ajax.php?service=video&action=alist&typeid='+typeid+'&page='+atpage+'&pageSize='+pageSize,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                if(data){
                    if(data.state == 100){
                        var info = data.info, list = info.list, html = [];
                        if(pageInfo.totalCount == -1){
                            pageInfo.totalCount = info.pageInfo.totalCount;
                            pageInfo.totalPage = info.pageInfo.totalPage;
                        }
                        if(list.length > 0){
                            for(var i = 0; i < list.length; i++){
                                var obj = list[i], item = [];
                                item.push('<li>');
                                item.push(' <a href="'+obj.url+'">');
                                item.push(' 	<div class="hot-pic">');
                                item.push('     	<img src="'+obj.litpic+'" alt="">');
                                item.push('		</div>');
                                item.push('     <div class="hot-txt">');
                                item.push('         <i>'+obj.title+'</i>');
                                item.push('         <b><s></s>'+obj.click+'</b>');
                                item.push('		</div>');
                                item.push('	</a>');
                                item.push('</li>');

                                html.push(item.join(""));
                            }
                        }
                        checkResult();
                        clist.append(html.join(""));
                        if(ftfix && con.offset().top + con.height() + $('.foot').height() >= win.height()){
                        	$('.foot').removeClass('fixbtm');
                        	ftfix = false;
                    	}
                    }else{
                        checkResult();
                    }
                }else{
                    checkResult();
                }
            },
            error: function(){
            	alert('网络错误，请重试');
            }
        })
	}

	function checkResult(){
        if(pageInfo.totalCount <= 0){
            $('.loading').text('暂无相关视频');
            isend = true;
        }else{
            if(pageInfo.totalPage == atpage){
                isend = true;
                $('.loading').addClass('toend').text('已显示全部视频');
            }else{
                $('.loading').remove();
                isload = false;
            }
        }
    }
})