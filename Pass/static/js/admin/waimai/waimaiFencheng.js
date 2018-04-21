$(function(){

    //修改分成
    $(".edit").bind("click", function(){
        var href = $(this).attr("href"), shopname = $(this).attr("data-shopname");

		try {
			event.preventDefault();
			parent.addPage("waimaiFenchengEdit", "waimai", "修改分成-"+shopname, "waimai/"+href);
		} catch(e) {}
    });


});
