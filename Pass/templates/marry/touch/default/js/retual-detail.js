$(function(){

    $(".TypeBox ul li").click(function(){
        var x = $(this),
            index = x.index();
        x.addClass('TypeBC').siblings().removeClass('TypeBC');
        $('.TypeList .TypeContent').eq(index).show().siblings().hide();
    })
    // 预约看场地弹出层
    $(".yuyue_btn").click(function(){
        $(".disk").show();
        $(".Subscribe").show();
    })
    $(".Subscribe .Subscribe_title i").click(function(){
        $(".disk").hide();
        $(".Subscribe").hide();
    })
    $(".clean").click(function(){
        $(".Subscribe_input .Subscribe_txt input").val("");
    })
})
