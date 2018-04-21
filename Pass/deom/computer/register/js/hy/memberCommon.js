/**
 * Created by xn on 2015/7/14.
 */
$(function(){
    $('.reason-tips').mouseenter(function(){
        var reason = $(this).attr('reason');
        Base.tips(reason,this,3,'#F25618');
    });
    $('.reason-tips').mouseleave(function(){
        Base.closeAll();
    })
});

//注册会员类型切换
function register_type(type){
    for (var i = 1; i <4; i++) {
        if (i == type) {
            continue;
        }
        $('#type-' + i).removeClass();
        $('.register-type-' + i).hide();
        $('.type-show-'+i).hide();
    }
    $('#type-' + type).addClass('on');
    $('.register-type-' + type).show();
    $('.type-show-'+type).show();
}

//初始化登陆页面验证
function loginInitial(){
    $.formValidator.initConfig({
        autotip:true,
        formid:"loginForm",
        onsuccess:function(){
            var gourl = '/member/';
            if(forward){
                gourl = forward;
            }
            return login($('#username').val(),$('#password').val(),gourl);
        }
    });

    $("#username,#password,#password-text").bind("focus",function(){
        var value = $(this).val();
        var _value = $(this).attr("placeholder");
        if(value == _value) {
            $(this).val("");
        }
        if($(this).attr('id')=='password-text'){
            $('#password-text').hide();
            $('#password').show();
            $('#password').focus();
        }
    }).bind("blur", function() {
        var value = $(this).val();
        var _value = $(this).attr("placeholder");
        if(value == "" || value == _value) {
            if($(this).attr('id')=='password'){
                $('#password').hide();
                $('#password-text').show();
            }
            $(this).val(_value);
        }
    });

    $("#username").formValidator({
        onshow:'请输入手机号/用户名/绑定邮箱',
        onfocus:'请输入手机号/用户名/绑定邮箱'
    }).functionValidator({fun:function(val){if(val==$('#username').attr('placeholder')){return '请输入手机号/用户名/绑定邮箱';}return true;
    }}).inputValidator({min:5,
        max:18,
        onerror:'请输入手机号/用户名/绑定邮箱',
        oncorrect:"填写正确"
    });

    $("#password").formValidator({
        onshow:"请输入密码",
        onfocus:"请输入密码",
        oncorrect:""
    }).inputValidator({
        min:6,
        max:20,
        onerror:"请输入正确的密码"
    });
}

function login(username,password,gourl,code,nolg){
    var data         = {};
    var url          = '/member/public/Login/';
    data['username'] = username;
    data['password'] = password;
    data['code']     = code;
    data['nolg']     = nolg;
    $.ajax({
        type     : "post",
        url      : url,
        data     : data,
        async    : false,
        dataType : "json",
        success  : function(json) {
            if (json.state=='success') {
                if(typeof gourl == 'undefined'){
                    location.reload();
                }else{
                    window.location = gourl;
                }
            }else{
                alert(json.message);
            }
        }
    });
    return false;
}

//注册页面表单验证
function regInitial(){
    //验证表单
    $.formValidator.initConfig({autotip:true,formid:"regForm",onerror:function(msg){}});
    $("#username").formValidator({
        onshow:"填写用户名",
        onfocus:"用户名应该为6-18位之间"
    }).inputValidator({
        min:6,
        max:18,
        onerror:"用户名应该为6-18位之间"
    }).regexValidator({
        regexp: "username",
        datatype: "enum",
        onerror: "用户名格式错误"
    }).ajaxValidator({
        type : "get",
        url : "/member/public/checkUsername/",
        datatype : "json",
        async:'false',
        success : function(data){
            if( data.state != "fail" ) {
                return true;
            } else {
                return false;
            }
        },
        buttons: $("#regiter_btn"),
        onerror : "禁止注册或用户已存在。",
        onwait : "请稍候..."
    });
    $("#password").formValidator({
        onshow:"请输入密码",
        onfocus:"密码应该为6-20位之间"
    }).inputValidator({
        min:6,
        max:20,
        onerror:"密码应该为6-20位之间"
    });
    $("#pwdconfirm").formValidator({
        onshow:"确认密码",
        onfocus:"两次密码不同。",
        oncorrect:"密码输入一致"
    }).compareValidator({
        desid:"password",
        operateor:"=",
        onerror:"两次密码不同。"
    });

    $("#phone").formValidator({
        onshow:"请输入手机",
        onfocus:"请输入正确的手机号码"
    }).inputValidator({
        min:11,
        onerror:"请输入正确的手机号码"
    }).regexValidator({
        regexp:"mobile",
        datatype:"enum",
        onerror:"请输入正确的手机号码"
    }).ajaxValidator({
        type : "get",
        url : "/member/public/checkPhone/",
        datatype : "json",
        getdata: {phone:'phone'},
        async:'false',
        success : function(data){
            if( data.state != "fail" ) {
                return true;
            } else {
                return false;
            }
        },
        onerror : "手机号码已存在",
        onwait : "请稍候..."
    });
    $("#nickname").formValidator({
        onshow:"请输入公司联系人",
        onfocus:"请输入正确的联系人"

    }).inputValidator({
        min:3,
        max:12,
        onerror:"请输入正确的联系人"
    });
    $("#companyname").formValidator({
        onshow:"请输入公司名称",
        onfocus:"请输入正确的公司名称"
    }).inputValidator({
        min:10,
        max:50,
        onerror:"请输入正确的公司名称"
    }).ajaxValidator({
        type : "get",
        url : "/member/public/checkCompanyname/",
        datatype : "json",
        async:'false',
        success : function(data){
            if( data.state != "fail" ) {
                return true;
            } else {
                return false;
            }
        },
        buttons: $("#regiter_btn"),
        onerror : "公司名称已经被人注册了。",
        onwait : "请稍候..."
    });
    $('#username').click(function(){
        $("#area").formValidator({
            onshow:"请选择一个所在地区",
            onfocus:"请选择一个所在地区"
        }).inputValidator({
            min:1,
            onerror:"请选择一个所在地区"
        });
    });

    $("#code").formValidator({
        onshow:"请输入验证码",
        onfocus:"请输入验证码"
    }).inputValidator({
        min:1,
        max:7,
        onerror:"请输入验证码"
    }).ajaxValidator({
        type : "get",
        url  : "/api/sendCode/vphonecode/",
        getdata: {phone:'phone'},
        datatype : "json",
        success : function(json){
            if( json.state == "success" ) {
                return true;
            } else {
                return false;
            }
        },
        onerror : "验证码错误！",
        onwait  : "请稍候..."
    });

    //发送验证码
    $('#send_ecode').click(function(){
        var phone = $('#phone');
        if(!/^(13|15|18|14|17)[0-9]{9}$/i.test(phone.val())){
            $('#phoneTip').addClass('onError').html('请输入正确的手机号码');
            phone.focus();
            return;
        }
        $.ajax({
            type     : "get",
            url      : "/member/public/checkPhone/",
            data     : {phone:phone.val()},
            async    : false,
            dataType : "json",
            success  : function(json){
                if( json.state != "fail" ) {
                    //图像验证码
                    Base.gtInit('.geetest-captcha',function(){
                        $.ajax({
                            type     : "get",
                            url      : "/api/sendCode/phonecode/",
                            data     : {phone:phone.val()},
                            async    : true,
                            dataType : "json",
                            beforeSend: function(){
                                $('#send_ecode').removeClass('btn-default').addClass('disabled');
                                $('#send_ecode').val('正在发送中...');
                            },
                            success  : function(json){
                                if(json.state=='success'){
                                    Base.sendCodeWait('#send_ecode');
                                }else{
                                    alert(json.info);
                                    Base.sendCodeWait('#send_ecode');
                                }
                            }
                        });
                    });

                } else {
                    return false;
                }
            }
        });
    });
    $('#select-company,.update-btn').click(function(){
        Base.pop('选择服务公司',$('.select-company-box'),'680px','380px');
        getCompanyList(1);
    });
    $('.search-btn').bind('click',function(){
        getCompanyList(1);
    });
    $('.delete-btn').bind('click',function(){
        $('.companyname-text').empty();
        $('#companyname3').val(0);
        $('#cid').val(0);
        $('#select-default').show();
        $('#select-show').hide();
    });

    $('.company-list ul').on('click','.select-btn',function(){
        var parents = $(this).parents("li");
        var title   = parents.attr("title");
        var id      = parents.attr("cid");
        $('.companyname-text').html(title);
        $('#companyname3').val(title);
        $('#cid').val(id);
        $('#select-default').hide();
        $('#select-show').show();
        Base.closeAll();
    });


}
//获取公司列表
function getCompanyList(page){
    var keyword    = $('.search-input').val();
    var provinceid = $('#provinceid').val();
    var cityid = $('#cityid').val();
    var areaid = $('#areaid').val();
    $.getJSON('/company/index/getCompanyList/',{keyword:keyword,provinceid:provinceid,cityid:cityid,areaid:areaid,page:page},function(json){
        if(json.state=='success'){
            var html = '';
            $.each(json.list,function(index,data){
                html += '<li title="'+data.title+'" cid="'+data.id+'">' +
                '<span class="tit">'+data.title+'</span> ' +
                '<span class="area">（'+data.region+'）</span>' +
                '<a href="javascript:;" class="select-btn">申请加入</a>' +
                '</li>';
            });
            $('.company-list ul').html(html);
            Base.pages('.pages',json.count,json.page-1,20,function(page){
                getCompanyList(page+1);
            });
        }else{
            $('.company-list ul').html(json.info);
        }
    });
}

//修改密码
function modPassword(){
    $.formValidator.initConfig({autotip:true,formid:"Form",onerror:function(msg){}});
    $("#oldpassword").formValidator({
        onshow:"请输入密码",
        onfocus:"密码应该为6-20位之间"
    }).inputValidator({
        min:6,
        max:20,
        onerror:"密码应该为6-20位之间"
    });
    $("#password").formValidator({
        onshow:"请输入密码",
        onfocus:"密码应该为6-20位之间"
    }).inputValidator({
        min:6,
        max:20,
        onerror:"密码应该为6-20位之间"
    });
    $("#pwdconfirm").formValidator({
        onshow:"确认密码",
        onfocus:"两次密码不同。",
        oncorrect:"密码输入一致"
    }).compareValidator({
        desid:"password",
        operateor:"=",
        onerror:"两次密码不同。"
    });

}

//修改个人信息
function modProfile(){
    $.formValidator.initConfig({
        autotip:true,
        formid:"Form",
        onerror:function(msg){
        }
    });
    $("#nickname").formValidator({
        onshow:"请输入昵称",
        onfocus:"请输入昵称"

    }).inputValidator({
        min:2,
        max:12,
        onerror:"请输入正确的昵称"
    });

    $('#Form').click(function(){
        $("#area").formValidator({
            onshow:"请选择一个所在地区",
            onfocus:"请选择一个所在地区"
        }).inputValidator({
            min:1,
            onerror:"请选择一个所在地区"
        });
    });


}
//倒计时

function sendCodeWait(obj){
    if(waitTime==0){
        $(obj).removeClass('disabled').addClass('btn-default');
        $(obj).val('重新发送');
        waitTime = 300;
    }else{
        $(obj).removeClass('btn-default').addClass('disabled');
        $(obj).val("重新发送("+waitTime+")");
        waitTime--;
        setTimeout(function(){
            sendCodeWait(obj);
        },1000);
    }
}

//确认跳转
function jumpConfirm(url,title){
    if(typeof title == 'undefined') title   = '您确定要删除吗？';
    Base.confirm(title,['确认','取消'],function(){
        location.href=url;
    });
}