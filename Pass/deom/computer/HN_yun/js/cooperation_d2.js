KISSY.use('node,kg/fullpage/1.0.0/purejs,kg/fullpage/1.0.0/purejs.css,gallery/slide/1.3/index', function(S, Node, Fullpage,DataLazyLoad,Slide) {
    KISSY.ready(function() {
        var T = {
            init: function() {
                var self = this;
              // S.one('#section2').all('.tab-pannel').item(0).addClass('normal');
                
                self._rightNav();
                self._animGlobe = new AnimGlobe();
                self._render3DSphere(0);
                self._fullpage();
                self._dot();
                // self._topNav();
                // self._renderTab();
            },
            _fullpage:function(){
                var self = this;
                var h = Node.one(window).height();
                S.all('.section').css('height', h);
                Node.one(window).on('resize', function(event) {
                    var h = Node.one(window).height();
                    S.all('.section').css('height', h);  
                });
                Fullpage.initialize('#fullpage', {
                    anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage','5thpage','6thpage','lastPage'],
                    css3:true,
                    onLeave: function(index,nIndex,derection){
                        // console.log(nIndex)
                        if(nIndex===1){
                            self._render3DSphere(0);
                          S.one('#map-container').css({'background': '#110e25'});
                          S.one('#map-container canvas').css('top','20px');
                            S.one('.fix-nav').all('li').removeClass('selected');
                            S.one('.fix-nav').all('li').item(0).addClass('selected');
                        }else if(nIndex===2){
                            self._render3DSphere(1);
                          S.one('#map-container').css({'background':'#0c071e'});
                          S.one('#map-container canvas').css('top','80px');
                            S.one('.fix-nav').all('li').removeClass('selected');
                            S.one('.fix-nav').all('li').item(1).addClass('selected');
                        }else if(nIndex===3){
                            self._render3DSphere(2);
                          S.one('#map-container').css({'background': '#0d0920'});
                          S.one('#map-container canvas').css('top','10px');
                            S.one('.fix-nav').all('li').removeClass('selected');
                            S.one('.fix-nav').all('li').item(2).addClass('selected');
                        }
                        
                    }
                });
                S.one('.fix-nav').all('li').each(function(el, index) {
                    S.one(el).on('click', function(event) {
                        event.preventDefault();
                        S.one(el).addClass('selected').siblings('li').removeClass('selected');
                        Fullpage.moveTo(index+1, 0);
                    });
                });
                S.all('.review-btn').each(function(el, index) {
                  S.one(el).on('click', function(event) {
                    event.preventDefault();
                    Fullpage.moveTo(index+2, 0);
                    S.one('.fix-nav').all('li').removeClass('selected');
                    S.one('.fix-nav').all('li').item(index+1).addClass('selected');
                  });
                });
              S.all('.page-link').each(function(el, index) {
                  S.one(el).on('click', function(event) {
                    event.preventDefault();
                    S.one(el).addClass('select').siblings('li').removeClass('select');
                    Fullpage.moveTo(index+1, 0);
                    S.one('.fix-nav').all('li').removeClass('selected');
                    S.one('.fix-nav').all('li').item(index).addClass('selected');
                  });
                });
            },
            _dot:function(){
                var self = this;
                var snowsrc = '//img.alicdn.com/tps/TB1UIYtLXXXXXXVXVXXXXXXXXXX-10-10.png';
                //雪花个数
                var no = 120; 
                //声明变量，xp表示横坐标，yp表示纵坐标>
                var dx, xp, yp;
                //声明变量，am表示左右摆动的幅度，stx表示横坐标的偏移步长，sty表示纵坐标的步长>
                var am, stx, sty;  
                
                //获取当前窗口的宽度
                clientWidth = document.body.clientWidth;
                //获取当前窗口的高度
                clientHeight = document.body.clientHeight;
              var dx = new Array();
              var xp = new Array();
              var yp = new Array();
              var am = new Array();
              var stx = new Array();
              var sty = new Array();
              var snowFlakes = new Array();
              for (i = 0; i < no; ++ i) {  
                
                dx[i] = 0;                        
                //第i个图片的横坐标初始值
                xp[i] = Math.random()*(clientWidth-50);  
                yp[i] = Math.random()*clientHeight;//第i个图片的纵坐标初始值
                am[i] = Math.random()*20;         //第i个图片的左右摆动的幅度
                stx[i] = -0.065 + Math.random()/10; //第i个图片x方向的步长
                sty[i] = -0.65 + Math.random();     //第i个图片y方向的步长
                //生成一个容纳雪花图片的div，并设置其绝对坐标
                var snowFlakeDiv = document.createElement('div');
                snowFlakeDiv.setAttribute('id', 'dot'+ i);
                snowFlakeDiv.style.position = 'absolute';
                snowFlakeDiv.style.opacity = 0.8;
                snowFlakeDiv.style.top = '30px';
                snowFlakeDiv.style.left = '30px';
                //生成一个雪花图片对象，设置宽高，并加入div
                var snowFlakeImg = document.createElement('img');
                snowFlakeImg.setAttribute('src', snowsrc);
                snowFlakeImg.style.width = '5px';
                snowFlakeImg.style.height = '5px';
                //将雪花div加入到document中，并通过数组保存
                snowFlakeDiv.appendChild(snowFlakeImg);
                S.one('.page-dot').appendChild(snowFlakeDiv);
                snowFlakes[i] = snowFlakeDiv;
              }
              function snow() {  
                for (i = 0; i < no; ++ i) {  
                  //第i个图片的纵坐标加上步长
                  yp[i] += sty[i];
                  //如果新坐标超过了屏幕下沿，重置该图片的信息，包括横坐标、纵坐标以及x方向的步长和y方向的步长
                  if (yp[i] > clientHeight-50) {
                    //重新赋值图片的横坐标
                    xp[i] = Math.random()*(clientWidth-am[i]-30);
                    //重新赋值图片的纵坐标
                    yp[i] = 0;
                  }
                  dx[i] += stx[i];//dx变量加上一个步长
                  //直接操作数组中对应的雪花div
                  var snowFlakeDiv = snowFlakes[i];
                  //更新图片的纵坐标
                  snowFlakeDiv.style.top = yp[i]+'px';
                  //更新图片的横坐标
                  snowFlakeDiv.style.left = xp[i] + am[i]*Math.sin(dx[i])+'px';
                }
                //设定动画刷新的时间周期
                setTimeout(snow, 10);
              }
              //调用snowIE()函数 
              snow();
            },
            //动态渲染tab切换菜单
            _renderTab:function(){
                var self = this;
                S.all('.J_tab').each(function(el, index) {
                    var tabStr = '';
                    S.one(el).all('.tab-pannel').each(function(v, k) {
                        var name = S.one(v).attr('data-name');
                        tabStr +=  '<li><a href="#">'+name+'</a></li>';
                    });
                    S.one(el).one('.tab-nav').html(tabStr);
                    var len = S.one(el).one('.tab-nav').all('li').length;
                    S.one(el).one('.tab-nav').css('width', 86*len);
                    new Slide(S.one(el),{
                        eventype:'click',//tab上的触发事件
                        effect:'hSlide',//切换效果为纵向滚动
                        autoSlide:false,//自动播放
                        hoverStop:true//鼠标经过内容是否停止播放
                    });
                });
            },
            _rightNav:function(){
                var self = this;
                var navStr = '';
                S.all('.section').each(function(el, index) {
                    var id = S.one(el).attr('id');
                    navStr += '<li><a href="#'+id+'"></a></li>'
                });
                S.one('.fix-nav').html(navStr);
                S.one('.fix-nav').all('li').item(0).addClass('selected');
            },
            _render3DSphere: function(index){
                var self = this;
                // animGlobe.initPanel();
                self._animGlobe.animateExample(index);
            }
        }
        T.init();
    });
})
