$(function(){

	var tabsSwiper = new Swiper('#tabs-container',{
    speed:500,
    autoHeight: true,
    onSlideChangeStart: function(){
      $(".tabs .active").removeClass('active');
      $(".tabs a").eq(tabsSwiper.activeIndex).addClass('active');
      $(window).scrollTop(0);
    },
    onSliderMove: function(){
      isload = true;
    },
    onSlideChangeEnd: function(){
      isload = false;
    }
  })
  $(".tabs a").on('touchstart mousedown',function(e){
    e.preventDefault();
    $(".tabs .active").removeClass('active')
    $(this).addClass('active')
    tabsSwiper.slideTo( $(this).index() )
  })
  $(".tabs a").click(function(e){
    e.preventDefault()
  })


})
