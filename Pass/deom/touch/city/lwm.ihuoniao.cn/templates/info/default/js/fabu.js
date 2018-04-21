$(function(){

	//大类切换
	$(".seltype .slide li").bind("click", function(){
		var t = $(this), index = t.index();
		if(!t.hasClass("curr")){
			t.addClass("curr").siblings("li").removeClass("curr");
			$(".seltype .stype ul").hide();
			$(".seltype .stype ul:eq("+index+")").show();
		}
	});

	$("#skey").val("");
	$("#skey").autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "/include/ajax.php?service=info&action=searchType",
				dataType: "jsonp",
				data:{
					key: request.term
				},
				success: function( data ) {
					if(data && data.state == 100){
						response( $.map( data.info, function( item, index ) {
							return {
								id: item.id,
								value: item.typename,
								label: (index+1)+". "+item.typename
							}
						}));
					}else{
						response([])
					}
				}
			});
		},
		minLength: 1,
		select: function( event, ui ) {
			location.href = getUrl(ui.item.id);
		}
	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $("<li>")
			.append(item.label)
			.appendTo( ul );
	};

	//二级分类
	$(".seltype .stype li").hover(function(){
		var sub = $(this).find(".subnav");
		if(sub.find("a").length > 0){
			$(this).addClass("curr");
			sub.show();
		}
	}, function(){
		var sub = $(this).find(".subnav");
		if(sub.find("a").length > 0){
			$(this).removeClass("curr");
			sub.hide();
		}
	});

	function getUrl(id){
		var url = $(".sform").data("url");
		return url.replace("%id%", id);
	}

});