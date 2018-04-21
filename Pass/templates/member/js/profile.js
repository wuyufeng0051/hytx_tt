$(function(){

	//出生日期
	$("#birthday").click(function(){
		WdatePicker({
			el: 'birthday',
			isShowClear: false,
			isShowOK: false,
			isShowToday: false,
			qsEnabled: false,
			maxDate: '%y-%M-%d',
			onpicking: function(dp){

			}
		});
	});

	//提交
	$("#submit").bind("click", function(event){
		event.preventDefault();
		$('#addr').val($('#selAddr .addrBtn').attr('data-id'));

		var t = $(this), form = $("#fabuForm"), serialize = form.serialize(), action = form.attr("action");
		t.attr("disabled", true).html(langData['siteConfig'][6][35]+"...");

		$.ajax({
			url: action,
			data: serialize,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
					t.removeAttr("disabled").html(langData['siteConfig'][20][229]);
					setTimeout(function(){
						t.html(langData['siteConfig'][6][122]);
					}, 2000);
				}else{
					$.dialog.alert(data.info);
					t.removeAttr("disabled").html(langData['siteConfig'][6][122]);
				}
			},
			error: function(){
				$.dialog.alert(langData['siteConfig'][20][183]);
				t.removeAttr("disabled").html(langData['siteConfig'][6][122]);
			}
		});

	});

});
