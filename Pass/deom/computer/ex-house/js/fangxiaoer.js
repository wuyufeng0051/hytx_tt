$(function(){


       $('.intention em').click(function(){
        var x = $(this);
        var index = x.index();
        x.addClass('active');
        x.siblings('em').removeClass('active');
    }) 


})
