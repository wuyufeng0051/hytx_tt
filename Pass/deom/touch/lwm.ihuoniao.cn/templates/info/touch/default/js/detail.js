$(function(){

	var imgLoad = function (url, obj) {
		var img = new Image();
		img.src = url;
		if (img.complete) {
			$("#"+obj).attr("data-size", img.width+"x"+img.height);
		} else {
			img.onload = function () {
				$("#"+obj).attr("data-size", img.width+"x"+img.height);
				img.onload = null;
			};
		};
	};

	$("#picobj .picarr").each(function(){
		var id = $(this).attr("id"), pic = $(this).attr("href");
		imgLoad(pic, id);
	});

	new Swiper('.comment-pic-slide', {pagination: '.swiper-pagination',paginationType: 'fraction'});

	var photoswipeInstance = new PhotoSwipe('#Gallery a');

	// 详细信息
	$('.all-detail').click(function(){

		var dom = $(this).closest('.info-detail');
		if (dom.hasClass('turn')) {

			dom.removeClass('turn')

		}else{
			dom.addClass('turn')
		}

	})

})
