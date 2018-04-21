$(function(){

  // 转盘样式，a：旋转角度，p：概率（1代表100%），t：需要显示的其它信息（文案or分享）
		var result_angle = [
      {a:0,p:0.083,t:'十积分',state:'1'}
      ,{a:30,p:0.083,t:'购物包',state:'1'}
      ,{a:60,p:0.083,t:'谢谢参与',state:'0'}
      ,{a:90,p:0.083,t:'五积分',state:'1'}
      ,{a:120,p:0.083,t:'围裙',state:'1'}
      ,{a:150,p:0.083,t:'原生态大米',state:'1'}
      ,{a:180,p:0.083,t:'谢谢参与',state:'0'}
      ,{a:210,p:0.083,t:'商家优惠券',state:'1'}
      ,{a:240,p:0.083,t:'天堂伞',state:'1'}
      ,{a:270,p:0.083,t:'话费',state:'1'}
      ,{a:300,p:0.083,t:'谢谢参与',state:'0'}
      ,{a:330,p:0.083,t:'二十积分',state:'1'}
    ];
		var rotate = {
			rotate_angle : 0, //起始位置为0
			flag_click : true, //转盘转动过程中不可再次触发
			calculate_result:function(type,during_time){//type:0,箭头转动,1,背景转动;during_time:持续时间(s)
				var self = this;
				type = type || 0; // 默认为箭头转动
				during_time = during_time || 1; // 默认为1s

				var rand_num = Math.ceil(Math.random() * 100); // 用来判断的随机数，1-100

				var result_index; // 最终要旋转到哪一块，对应result_angle的下标
				var start_pos = end_pos = 0; // 判断的角度值起始位置和结束位置

				for(var i in result_angle){
					start_pos = end_pos + 1; // 区块的起始值
					end_pos = end_pos + 100 * result_angle[i].p; // 区块的结束值

					if(rand_num >= start_pos && rand_num <= end_pos){ // 如果随机数落在当前区块，那么获取到最终要旋转到哪一块
						result_index = i;
						break;
					}
				}

				var rand_circle = Math.ceil(Math.random() * 2) + 1; // 附加多转几圈，2-3

				self.flag_click = false; // 旋转结束前，不允许再次触发
				if(type == 1){ // 转动盘子
					self.rotate_angle =  self.rotate_angle - rand_circle * 360 - result_angle[result_index].a - self.rotate_angle % 360;
					$('#i_bg').css({
						'transform': 'rotate('+self.rotate_angle+'deg)',
						'-ms-transform': 'rotate('+self.rotate_angle+'deg)',
						'-webkit-transform': 'rotate('+self.rotate_angle+'deg)',
						'-moz-transform': 'rotate('+self.rotate_angle+'deg)',
						'-o-transform': 'rotate('+self.rotate_angle+'deg)',
						'transition': 'transform ease-out '+during_time+'s',
						'-moz-transition': '-moz-transform ease-out '+during_time+'s',
						'-webkit-transition': '-webkit-transform ease-out '+during_time+'s',
						'-o-transition': '-o-transform ease-out '+during_time+'s'
					});
				}else{ // 转动指针
					self.rotate_angle = self.rotate_angle + rand_circle * 360 + result_angle[result_index].a - self.rotate_angle % 360;
					$('#i_cont').css({
						'transform': 'rotate('+self.rotate_angle+'deg)',
						'-ms-transform': 'rotate('+self.rotate_angle+'deg)',
						'-webkit-transform': 'rotate('+self.rotate_angle+'deg)',
						'-moz-transform': 'rotate('+self.rotate_angle+'deg)',
						'-o-transform': 'rotate('+self.rotate_angle+'deg)',
						'transition': 'transform ease-out '+during_time+'s',
						'-moz-transition': '-moz-transform ease-out '+during_time+'s',
						'-webkit-transition': '-webkit-transform ease-out '+during_time+'s',
						'-o-transition': '-o-transform ease-out '+during_time+'s'
					});
				}
				// 旋转结束后，允许再次触发
				setTimeout(function(){
					self.flag_click = true;
					// 告诉结果
          if (result_angle[result_index].state == '0') {
            $('.failer, .mask').show();
          }else {
            $('.success, .mask').show();
            $('.success .bonus').text('抽到'+result_angle[result_index].t+'一个')
          }
					// alert(result_angle[result_index].t);
				},during_time*1010);
			}
		}
		$(document).ready(function(){

			$('#i_cont').click(function(){
        var rest = $('.rest').text();
        if (rest >= 10) {
  				if(rotate.flag_click){ // 旋转结束前，不允许再次触发
  					rotate.calculate_result(1,1);
  				}
        }else {
          $('.empty, .mask').show();
        }
			});

			var t=5;//5秒后返回微信
			function f_t(){
				setTimeout(function(){
					t--;
					$("#i_time").html(t+"s");
					f_t();
				},1000)
			}

			$('#i_back').click(function(){
				$("#i_close_cont").show();
				f_t();
			});

			$('#i_close').click(function(){
				$("#i_close_cont").hide();
			});
		});

    // 公告轮播
    $(".txtScroll-top").slide({mainCell:".bd ul",autoPage:true,effect:"top",autoPlay:true,vis:6,effect:"topLoop"});

    // 点击遮罩层
    $('.mask').click(function(){
      $('.layer, .mask').hide();
    })
    $('.mask').on('touchmove', function(){
      $('.layer, .mask').hide();
    })





})
