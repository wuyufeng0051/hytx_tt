$(function(){

	var objId = $('#listCon'), atpage = 1, totalPage = 1; pageSize = 10, isload = false;

    getList();
    // 上一页
    $('.fanye .fan-l').click(function(){
        if(atpage == 1 || isload) return;
        atpage--;
        getList();
    })
    // 下一页
    $('.fanye .fan-r').click(function(){
        if(atpage == totalPage || isload) return;
        atpage++;
        getList();
    })
    // 切换排序方式
    $('.range_look li').click(function(){
    	var t = $(this), orderby = t.attr('data-id');
    	if(t.hasClass('.slient_range')) return;
    	t.addClass('slient_range').siblings().removeClass('slient_range');
    	getList();
    })

    // 报名
    $('.baoming').click(function(){
        var state = '';
        if(detail.state == 0){
            state = '抱歉，活动还未开始';
        }else if(detail.state == 2){
            state = '抱歉，报名已结束';
        }else if(detail.state == 3){
            state = '抱歉，活动已结束';
        }
        if(state == ''){
            checkLogin();
        }else{
            modal.setinfo("提示信息",state,1000);
        }
    })

    // --------------------------投票 s
    var uid = 0; //当前用户id
	var uname = '';

	objId.delegate(".vote","click",function(){
		var t = $(this), p = t.closest('.vote_area');

        // 判断活动是否结束
        if(detail.state == 3){
            modal.setinfo('提示信息', '抱歉，该投票已结束！', 2000);
            return;
        }
        // 判断活动是否允许匿名
		var r = true;
		if(detail.voteuser == 1){
			r = checkLogin();
		}
		if(r){
			uid   = p.attr('data-id');
			uname = p.attr('data-name');
			var content = [];
			content.push('<div class="toupiao">');
			content.push('<label for="mname"><input type="text" name="mname" class="mname" id="mname" placeholder="姓名" /></label></label>')
			content.push('<label for="mtel"><input type="text" name="mtel" class="mtel" id="mtel" placeholder="手机号" /></label></label>');
			content.push('<label for="vdimgckinp"><input type="text" name="vdimgckinp" class="vdimgckinp" id="vdimgckinp" placeholder="验证码" /></label></label>');
			content.push('<label for="vdimgckinpimg"><img src="/include/vdimgck.php" class="vdimgck"></label>');
			content.push('<label class="errorinfo"></label></label>');
			content.push('<a href="javascript:;" class="votesubmit">投票</a>');
			content.push('</div>');
			modal.setinfo('给选手“'+uname+'”投票', content.join(""));
		}
	})
	// 更换验证码
	$('body').delegate(".vdimgck","click",function(){
		changevdimg();
	})

	// 确认投票
	$('body').delegate('.votesubmit','click',function(){
        var t = $(this);
        if(t.hasClass('disabled')) return;

		$('input.error').removeClass('error');
		var t = $(this), mname = $('.mname').val(), mtel = $('.mtel').val(), vdimgck = $('.vdimgckinp').val(), tj = true;
		if(t.hasClass('disabled')) return;

		if(mname != '' && mtel == ''){
			tj = false;
			$('.mtel').addClass('error');
			$('.errorinfo').text('请填写您的手机号');
			return false;
		}else if(mname == '' && mtel != ''){
			tj = false;
			$('.errorinfo').text('请填写您的姓名');
			$('.mname').addClass('error');
			return false;
		}
		if(mname != '' && mtel != ''){
			var telReg = !!mtel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
			if(!telReg){
				tj = false;
				$('.errorinfo').text('您的手机号不正确');
				$('.mtel').addClass('error');
				return false;
			}
		}
		if(vdimgck == ''){
			tj = false;
			$('.errorinfo').text('请填写验证码');
			$('.vdimgckinp').addClass('error');
			return false;
		}

		if(tj){
			t.addClass('disabled').text('正在提交...');
			$.ajax({
				url: '/include/ajax.php?service=vote&action=vote&tid='+detail.id+'&uid='+uid+'&mname='+mname+'&mtel='+mtel+'&vdimgck='+vdimgck,
				type: 'GET',
				dataType: 'JSONP',
				success: function(data){
					$('.vdimgck').click();
					if(typeof data == 'string'){
						data = eval('('+data+')');
					}
					if(data && data.state == 100){
						modal.setinfo("投票成功",'感谢您对“'+uname+'”的支持！',1500);
						objId.find('[data-id="'+uid+'"] .votecount').text(data.info);
					}else{
						$('.errorinfo').text(data.info);
					}
					t.removeClass('disabled').text('投票');
				},
				error: function(){
					$('.vdimgck').click();
					$('.errorinfo').text('网络错误，请重试！');
					t.removeClass('disabled').text('投票');
				}
			})
		}
	})
    // --------------------------投票 e

	function getList(){
        $(window).scrollTop($('.range_look').offset().top);
        objId.html('<div class="loading">获取中，请稍后</div>');

        var data = [], df = $('.choice ul li');
        data.push('tid='+detail.id);
        data.push('orderby='+$('.range_look li.slient_range').attr('data-id'));
        /*if(keywords != ''){
            data.push('keywords='+keywords);
            keywords = '';
            var url = window.location.href.split("?")[0];
            window.history.pushState({}, 0, url);
        }*/
        $.ajax({
            url: "/include/ajax.php?service=vote&action=ulist&page="+atpage+'&pageSize='+pageSize,
            data: data.join("&"),
            type: "GET",
            dataType: "jsonp",
            success: function (data) {
                if(data){
                    if(data.state == 100){
                        var list = data.info.list, html = [];
                        var pageInfo = data.info.pageInfo;
                        if(list.length > 0){
                            for(var i = 0; i < list.length; i++){
                                var obj = list[i], item = [];
                                item.push('<div class="vote_area fn-clear" data-id="'+obj.id+'" data-name="'+obj.name+'">');
                                item.push('	<a href="'+obj.url+'" class="pic_two"><img src="'+obj.litpic+'"></a>');
                                item.push('	<ul>');
                                item.push('		<li><a href="'+obj.url+'">选手:'+obj.name+'</a></li>');
                                item.push('		<li class="fn-clear thre_e gray-color">');
                                item.push('			<p class="tick">得票：<span class="votecount">'+obj.votecount+'</span></p>');
                                item.push('			<a href="javascript:;" class="vote">投票</a>');
                                item.push('		</li>');
                                item.push('		<li class="gray-color fn-clear">');
                                item.push('			<s>编号：'+obj.number+'</s><span class="eight_ty fn-clear"><i></i>&nbsp;<span>'+obj.click+'</span></span>');
                                item.push('		</li>');
                                item.push('	</ul>');
                                item.push('</div>');

                                html.push(item.join(""));
                            }

                            objId.html(html.join(""));
                            totalPage = pageInfo.totalPage;
                            // $('#count').text('('+pageInfo.totalCount+')')
                            $('.fanye').show().find('.page').html(pageInfo.page+'/'+totalPage);
                            isload = false;
                        }else{
                            objId.html('<div class="loading">暂无选手报名！</div>');
                            $('#count').text('(0)')
                            $('.fanye').hide();
                            isload = false;
                        }
                    }else{
                        objId.html('<div class="loading">暂无选手报名！</div>');
                        $('#count').text('(0)')
                        $('.fanye').hide();
                        isload = false;
                    }
                }
            },
            error: function(){
                isload = false;
            }
        })
    }

    var modal = {
        time:0,
        show:function(){
            clearTimeout(this.time);
            $('.disk').show();
            var t = this;
            $('.disk,.tymodal .close').click(function(){
                t.close();
                $('.tymodal').addClass('fn-hide');
            })
        },
        close:function(id){
            clearTimeout(this.time);
            $('.disk').hide();
            if(id != undefined){
                $(id).addClass('fn-hide');
            }
        },
        setinfo:function(title,body,auto){
            var t = this;
            $('.tymodal .title').text(title);
            $('.tymodal .text').html(body);
            $('.tymodal').removeClass('fn-hide');
            t.show();
            if(auto){
                t.time = setTimeout(function(){
                    t.close('.tymodal');
                },auto)
            }
        }
    }

    // 验证是否登录
	function checkLogin(){
		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			top.location.href = masterDomain + '/login.html';
			return false;
		}else{
			return true;
		}
	}

	function changevdimg(){
		var img = $('.vdimgck');
		var src = img.attr('src') + '?v=' + new Date().getTime();
		img.attr('src',src);
	}
})