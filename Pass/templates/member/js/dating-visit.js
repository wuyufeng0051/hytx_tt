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

			if(t.text() == langData['siteConfig'][6][37]){
				$.ajax({
					url: masterDomain+"/include/ajax.php?service=dating&action=visitOper&type=2&id="+id,
					type: "GET",
					dataType: "jsonp",
					success: function (data) {
						if(data && data.state == 100){
							t.html(langData['siteConfig'][6][77]);
						}else{
							$.dialog.tips(langData['siteConfig'][20][295], 3, 'error.png');
						}
					},
					error: function(){
						$.dialog.tips(langData['siteConfig'][20][183], 3, 'error.png');
					}
				});

			}else if(t.text() == langData['siteConfig'][6][77]){
				$.dialog.confirm(langData['siteConfig'][20][296], function(){
					$.ajax({
						url: masterDomain+"/include/ajax.php?service=dating&action=cancelFollow&id="+id,
						type: "GET",
						dataType: "jsonp",
						success: function (data) {
							if(data && data.state == 100){

								if(oper == "follow"){
									getList(1);
								}else{
									t.html(langData['siteConfig'][6][37]);
								}

							}else{
								$.dialog.tips(langData['siteConfig'][20][295], 3, 'error.png');
								t.html(langData['siteConfig'][6][77]);
							}
						},
						error: function(){
							$.dialog.tips(langData['siteConfig'][20][183], 3, 'error.png');
							t.html(langData['siteConfig'][6][77]);
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
				title: langData['siteConfig'][23][103]+username,
				content: '<div class="sx fn-clear"><textarea></textarea></div>',
				width: 450,
				height: 120,
				ok: function(){
	        var note = $(".sx textarea").val();
	        if(note == ""){
	          $.dialog.tips(langData['siteConfig'][20][297], 3, 'error.png');
	          return false;
	        }else{

	          $.ajax({
	            url: masterDomain + "/include/ajax.php?service=dating&action=fabuReview&id="+id+"&note="+note,
	            type: "GET",
	            dataType: "jsonp",
	            success: function (data) {
	              if(data.state == 100){
	                $.dialog.tips(langData['siteConfig'][20][298], 3, 'success.png');
	              }else{
	                $.dialog.tips(data.info, 3, 'error.png');
	              }
	            },
	            error: function(){
	              $.dialog.tips(langData['siteConfig'][20][173], 3, 'error.png');
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

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />'+langData['siteConfig'][20][184]+'...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=dating&action=visit&oper="+oper+"&act="+act+"&page="+atpage+"&pageSize="+pageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state != 200){
				if(data.state == 101){
					objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
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
							html.push('<p>'+member['age']+langData['siteConfig'][13][29]+' <em>|</em> '+member['height']+'cm <em>|</em> '+member['addr'][1]+' <em>|</em> '+member['education']+'</p>');

							var follow = langData['siteConfig'][6][37];
							if(list[i].follow > 0){
								follow = langData['siteConfig'][6][77];
							}
							html.push('<p><a href="javascript:;" class="review">'+langData['siteConfig'][6][36]+'</a> <em>|</em> <a href="javascript:;" class="follow">'+follow+'</a></p>');
							html.push('<span>'+list[i].pubdate+'</span>');
							html.push('</dd>');
							html.push('</dl>');
						}

						objId.html(html.join(""));

					}else{
						objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
					}

					totalCount = pageInfo.totalCount;
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>"+langData['siteConfig'][20][126]+"</p>");
			}
		}
	});
}
