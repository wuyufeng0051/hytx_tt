/**
 * 会员中心邀请记录管理
 * by guozi at: 20160530
 */

var objId = $("#list");
var state = 0;
$(function(){

	$(".nav-tabs li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("active") && !t.hasClass("add")){
			state = id;
			atpage = 1;
			t.addClass("active").siblings("li").removeClass("active");
			getList();
		}
	});

	getList(1);




	//标记
  objId.delegate(".link", "click", function(){
		var id = $(this).closest("tr").attr("data-id");
		var state = [];
		state.push('<label><input type="radio" name="state" value="0" />待处理</label>');
		state.push('<label><input type="radio" name="state" value="1" />已面试</label>');
		state.push('<label><input type="radio" name="state" value="2" />不合适</label>');

    $.dialog({
			id: "dataInfo",
			fixed: true,
			title: "标记",
			content: '<div class="chooseState fn-clear">'+state.join("")+'</div>',
			width: 300,
			height: 120,
			ok: function(){
        var state = $(".chooseState input:checked").val();

				if(state == undefined){
					$.dialog.tips('请选择要标记的状态！', 3, 'error.png');
					return false;
				}

        $.ajax({
          url: masterDomain + "/include/ajax.php?service=job&action=deliveryUpdate&id="+id+"&state="+state,
          type: "GET",
          dataType: "jsonp",
          success: function (data) {
            if(data.state == 100){
              getList();
            }else{
              $.dialog.tips(data.info, 3, 'error.png');
            }
          },
          error: function(){
            $.dialog.tips('网络错误，邀请失败！', 3, 'error.png');
          }
        });

      }
		});

  });

});

function getList(is){

	$('.main').animate({scrollTop: 0}, 300);

	objId.html('<p class="loading"><img src="'+staticPath+'images/ajax-loader.gif" />加载中，请稍候...</p>');
	$(".pagination").hide();

	$.ajax({
		url: masterDomain+"/include/ajax.php?service=job&action=deliveryList&type=company&state="+state+"&page="+atpage+"&pageSize="+pageSize,
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
							var item  = [],
									id    = list[i].id,
									detail = list[i].resume,
									date  = list[i].date;

							html.push('<tr data-id="'+id+'"><td class="fir">&nbsp;</td>');
							html.push('<td><a href="'+detail['url']+'" target="_blank"><img src="'+detail['photo']+'" width="50" />'+detail['name']+'</a></td>');
							html.push('<td><a href="'+list[i]['post'].url+'" target="_blank">'+list[i]['post'].title+'</a></td>');
							html.push('<td>'+(detail['sex'] == 0 ? "男" : "女")+'</td>');
							html.push('<td>'+detail['age']+'</td>');
							html.push('<td>'+detail['home']+'</td>');
							html.push('<td>'+detail['workyear']+'年</td>');
							html.push('<td>'+detail['educationalname']+'</td>');
							html.push('<td>'+detail['college']+'</td>');
							html.push('<td>'+list[i].date+'</td>');

							var states = "";
							switch (list[i].state) {
								case "0":
									states = "待处理";
									break;
								case "1":
									states = "已面试";
									break;
								case "2":
									states = "不合适";
									break;
							}
							html.push('<td class="state'+list[i].state+'">'+states+'</td>');

							html.push('<td><a href="javascript:;" class="bj link">标记</a></td>');
							html.push('</tr>');

						}

						objId.html('<table><thead class="thead"><tr><th class="fir">&nbsp;</th><th>姓名</th><th>投递职位</th><th>性别</th><th>年龄</th><th>籍贯</th><th>工作</th><th>学历</th><th>毕业学院</th><th>投递时间</th><th>状态</th><th>操作</th></tr></thead><tbody>'+html.join("")+'</tbody></table>');

					}else{
						objId.html("<p class='loading'>暂无相关信息！</p>");
					}

					switch(state){
						case "":
							totalCount = pageInfo.totalCount;
							break;
						case "0":
							totalCount = pageInfo.state0;
							break;
						case "1":
							totalCount = pageInfo.state1;
							break;
						case "2":
							totalCount = pageInfo.state2;
							break;
					}

					$("#state0").html(pageInfo.state0);
					$("#state1").html(pageInfo.state1);
					$("#state2").html(pageInfo.state2);
					showPageInfo();
				}
			}else{
				objId.html("<p class='loading'>暂无相关信息！</p>");
			}
		}
	});
}
