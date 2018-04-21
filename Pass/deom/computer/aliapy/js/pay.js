$(function(){
	$('#country-1').click(function(){
		if ($('.ui-country').css("display")=='none') {
			$('.ui-country').show();
		}else{
			$('.ui-country').hide();
		};
	})
	$('#J-countryMobileCode').click(function(){
		if ($('.ui-select').css("display")=='none') {
			$('.ui-select').show();
		}else{
			$('.ui-select').hide();
		};
	})
	$('.ui-country-tops li').click(function(){
		var u = $(this),
			country = u.text();
			uval = u.attr("data-value");
		$('#country-1').text(country);
		$('.ui-select-content li').each(function(){
			x = $(this), xval = x.attr("data-value"),num = x.find('span').text();
			if (xval == uval) {
				$('#J-countryMobileCode').text(num);
				$('.ui-country').hide();
			};
		})
		$('.ui-country').hide();
	})
	$('.ui-country-group li').click(function(){
		var  u = $(this), uval = u.attr("data-value");
		$('.ui-country-content li').hide();
		$('.ui-country-content li').each(function(){
			x = $(this), xval = x.attr("data-group");
			if (xval == uval) {
				x.show();
			};
		})
		u.addClass('tab-active');
		u.siblings('li').removeClass('tab-active');
	})
	$('.ui-country-item').click(function(){
		var  u = $(this), uval = u.attr("data-value"),
			country = u.text();
		$('#country-1').text(country);
		$('.ui-select-content li').each(function(){
			x = $(this), xval = x.attr("data-value"),num = x.find('span').text();
			if (xval == uval) {
				$('#J-countryMobileCode').text(num);
				$('.ui-country').hide();
			};
		})
	})
	$('.ui-select-content li').click(function(){
		var u = $(this),
			country = u.find('span').text();
			uval = u.attr("data-value");
		$('.ui-country li').each(function(){
			x = $(this), xval = x.attr("data-value"),num = x.text();
			if (xval == uval) {
				$('#country-1').text(num);
				$('.ui-country').hide();
			};
		})
		$('#J-countryMobileCode').text(country);
		$('.ui-select').hide();
	})
})