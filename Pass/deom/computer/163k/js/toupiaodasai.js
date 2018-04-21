$(function(){

	// 更换验证码
	$('.vdimgck ,.change').click(function(){
	var a = $(this),img;
	if(a.hasClass('change')){
		img = a.siblings('img');
	}else{
		img = a;
	}
	var src = img.attr('src') + '?v=' + new Date().getTime();
	img.attr('src',src);



// regform.find('.inp').focus(function(){
// 	$(this).closest('.form-row').addClass('focus');
// }).blur(function(){
// 	$(this).closest('.form-row').removeClass('focus');
// })
})



window._bd_share_config = {
"common": {
  "bdSnsKey": {},
  "bdText": "",
  "bdMini": "2",
  "bdMiniList": false,
  "bdPic": "",
  "bdStyle": "0",
  "bdSize": "16"
},
"share": {}
};
with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];


// 投我一票
	$('.t-3 span a').click(function(){
		$('.rewardS-mask,.opdv').show();
	})
	$('.op-1 span').click(function(){
		$('.rewardS-mask,.opdv').hide();
	})

})
