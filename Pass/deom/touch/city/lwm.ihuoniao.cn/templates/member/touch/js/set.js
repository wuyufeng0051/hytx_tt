$(function(){

	setupWebViewJavascriptBridge(function(bridge) {

		//获取APP推送状态
	    bridge.callHandler(
	        'getAppPushStatus',
	        {},
	        function(responseData){
	            if(responseData == "on"){
					$("#pushStatus").prop("checked", true);
				}
	        }
	    );

		//开启、关闭消息推送
		$("#pushStatus").bind("click", function(event){
			event.preventDefault();

			var t = $(this);
			if(!t.is(":checked")){
				//关闭推送
			    bridge.callHandler(
			        'setAppPushStatus',
			        {"pushStatus": "off"},
			        function(responseData){
			            t.prop("checked", false);
			        }
			    );
			}else{
				//开启推送
			    bridge.callHandler(
			        'setAppPushStatus',
			        {"pushStatus": "on"},
			        function(responseData){
			            t.prop("checked", true);
			        }
			    );

			}
		});


		//获取APP缓存大小
	    bridge.callHandler(
	        'updateCacheSize',
	        {},
	        function(responseData){
	            $("#cache").html(responseData);
	        }
	    );

		$('.clear').click(function(){
			//清除APP缓存大小
		    bridge.callHandler(
		        'cleanCache',
		        {},
		        function(responseData){
					$('.succes').show();
					setTimeout(function(){$('.succes').hide()}, 1000);
					$("#cache").html("0 B");
		        }
		    );
		});



	});


})
