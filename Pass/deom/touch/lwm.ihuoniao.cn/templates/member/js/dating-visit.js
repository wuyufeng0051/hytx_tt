/**
 * 会员中心交友私信列表
 * by guozi at: 20160608
 */

var objId = $("#list");
$(function(){

	getList(1);

	//取消关注
	objId.delegate(".follow", "click", function(){
		var t = $(this), par = t.closest("dl"), id = par.attr("data-id");
		if(id){

			if(t.text() == "加关注"){
				$.ajax({
					url: masterDomain+"/include/ajax.php?service=dating&action=visitOper&type=2&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							t.html("取消关注");
						}else{
							$.dialog.tips("操作失败！", 3, 'error.png');
						}
					},
					error: function(){
						$.dialog.tips("网络错误，请稍候重试！", 3, 'error.png');
					}
				});

			}else if(t.text() == "取消关注"){
				$.dialog.confirm('确定不在关注吗？', function(){
					$.ajax({
						url: masterDomain+"/include/ajax.php?service=dating&action=cancelFollow&id="+id,
						type: "GET",
						dataType: "jsonp",
						success: function (data) {
							if(data && data.state == 100){

								if(oper == "follow"){
									getList(1);
								}else{
									t.html("加关注");
								}

							}else{
								$.dialog.tips("操作失败！", 3, 'error.png');
								t.html("取消关注");
							}
						},
						error: function(){
							$.dialog.tips("网络错误，请稍候重试！", 3, 'error.png');
							t.html("取消关注");
						}
					});
				});
			}
		}
	});

	//发私信
	objId.delegate(".review", "click", function(){
		var t = $(this), par = t.closest("dl"), id = par.attr("data-id"), username = par.attr("data-name");
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}

		if(id){
	    dataInfo = $.dialog({
				id: "dataInfo",
				fixed: true,
				title: "发私信给 "+username,
				content: '<div class="sx fn-clear"><textarea></textarea></div>',
				width: 450,
				height: 120,
				ok: function(){
	        var note = $(".sx textarea").val();
	        if(note == ""){
	          $.dialog.tips("请输入私信内容！", 3, 'error.png');
	          return false;
	        }else{

	          $.ajax({
	            url: masterDomain + "/include/ajax.php?service=dating&action=fabuReview&id="+id+"&note="+note,
	            type: "GET",
	            dataType: "jsonp",
	            success: function (data) {
	              if(data.state == 100){
	                $.dialog.tips('发送成功！', 3, 'success.png');
	              }else{
	                $.dialog.tips(data.info, 3, 'error.png');
	              }
	            },
	            error: function(){
	              $.dialog.tips('网络错误，发送失败！', 3, 'error.png');
	            }
	          });

	        }
	      }
			});
		}

	});


});

function getList(is){

	if(is != 1){
		$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
	}

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=dating&action=visit&oper="+oper+"&act="+act+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>暂无相关信息！</p>");
				}else{
					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

					//拼接列表
					if(list.length > 0){
						for(var i = 0; i < list.length; i++){
							var member  = list[i].member;

							html.push('<dl class="fn-clear" data-id="'+member['id']+'" data-name="'+member['nickname']+'">');
							html.push('<dt><a href="'+member['url']+'" target="_blank"><img src="'+member['photo']+'" onerror="javascript:this.src=\''+masterDomain+'/static/images/noPhoto_100.jpg\';" /></a></dt>');
							html.push('<dd>');
							html.push('<h3><a href="'+member['url']+'" target="_blank">'+member['nickname']+'</a></h3>');
							html.push('<p>'+member['age']+'岁 <em>|</em> '+member['height']+'cm <em>|</em> '+member['addr'][1]+' <em>|</em> '+member['education']+'</p>');

							var follow = '加关注';
							if(list[i].follow > 0){
								follow = '取消关注';
							}
							html.push('<p><a href="javascript:;" class="review">发私信</a> <em>|</em> <a href="javascript:;" class="follow">'+follow+'</a></p>');
							html.push('<span>'+list[i].pubdate+'</span>');
							html.push('</dd>');
							html.push('</dl>');
						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					totalCount = pageInfo.totalCount;
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
