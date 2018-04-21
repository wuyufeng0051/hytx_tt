$(function(){

    //确认订单
    $("#confirmObj").bind("click", function(){

        if(confirm("是否确认？")){
            $.ajax({
                url: "waimaiOrder.php",
                type: "post",
                data: {action: "confirm", id: id},
                dataType: "json",
                success: function(res){
                    if(res.state != 100){
                        alert(res.info);
                    }else{
                        location.reload();
                    }
                },
                error: function(){
                    alert("网络错误，操作失败！");
                }
            })
        }
        return false;

    });



    //成功订单
    $("#okObj").bind("click", function(){

        if(confirm("是否确认为成功订单？")){
            $.ajax({
                url: "waimaiOrder.php",
                type: "post",
                data: {action: "ok", id: id},
                dataType: "json",
                success: function(res){
                    if(res.state != 100){
                        alert(res.info);
                    }else{
                        location.reload();
                    }
                },
                error: function(){
                    alert("网络错误，操作失败！");
                }
            })
        }
        return false;

    });


    // 无效订单
    $('.footer .fail').click(function(){
        $('.failbox').addClass('show');
    })
    $('.whyform .cancel').click(function(){
        $('.failbox').removeClass('show');
        $('.textarea').removeClass('error');
    })

    $('.failbox .mask').bind('touchstart', function(){
        $('.failbox').removeClass('show');
        $('.textarea').removeClass('error');
    })
    //无效订单
    $("#failedObj").bind("click", function(){
        var textarea = $('.textarea'), val = textarea.val();
        if (val == "") {
          textarea.addClass('error').focus();
          return;
        }else {
          textarea.removeClass('error');
        }

        $.ajax({
            url: "waimaiOrder.php",
            type: "post",
            data: {action: "failed", id: id, note: val},
            dataType: "json",
            success: function(res){
                if(res.state != 100){
                    alert(res.info);
                }else{
                    location.reload();
                }
            },
            error: function(){
                alert("网络错误，操作失败！");
            }
        })

        return false;

    });



    //打印订单
    /*$("#printObj").bind("click", function(){

        if(confirm("是否打印？")){
            $.ajax({
                url: "waimaiOrder.php",
                type: "post",
                data: {action: "print", id: id},
                dataType: "json",
                success: function(res){
                    alert(res.info);
                },
                error: function(){
                    alert("网络错误，操作失败！");
                }
            })
        }
        return false;

    });*/



});
