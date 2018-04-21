$(function(){
	$(".cont_box .cb_lead .cbl_left .choice  span").click(function(){
        if( $(".choice_box").css("display")=='none' ) { 
            $(".choice_box ").show();
        }else{
            $(".choice_box ").hide();
        }
        })
	$('.cont_box .cb_lead .cbl_left .choice .choice_box ul li').click(function(){
		var  x = $(this);
		var  b = x.text();
		$('.cont_box .cb_lead .cbl_left .choice  span b').text(b);
		$('.choice_box').hide();
	})
	$(".mo b").click(function(){
        if( $(".mo_box").css("display")=='none' ) { 
            $(".mo_box ").show();
        }else{
            $(".mo_box ").hide();
        }
        })

	$('.mo_box a').click(function(){
		var  x = $(this);
		var  b = x.text();
		// $('.mo b').text(b);
		$('.mo_box').hide();
	})
	$(".guolv b").click(function(){
        if( $(".guolv_box").css("display")=='none' ) { 
            $(".guolv_box ").show();
        }else{
            $(".guolv_box ").hide();
        }
        })

	$('.guolv_box a').click(function(){
		var  x = $(this);
		var  b = x.text();
		// $('.mo b').text(b);
		$('.guolv_box').hide();
	})





	$(".add").click(function(){
	    if( $(".add_de").css("display")=='none' ) { 
	        $(".add_de ").show();
	        $(".disk ").show();
	    }else{
	        $(".add_de ").hide();
	        $(".disk ").hide();
	    }
    })
	$('.add_de h1 em').click(function(){
        $(".add_de ").hide();
        $(".disk ").hide();
	})
})