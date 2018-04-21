$(function(){
    //大图幻灯片
    function allJ(oPic,oList,oPrevTop,oNextTop,num,valx){
        function getStyle(obj, attr){
            if(obj.currentStyle){
                return obj.currentStyle[attr];
            }else{
                return getComputedStyle(obj, false)[attr];
            }
        }
        function Animate(obj, json){
            if(obj.timer){
                clearInterval(obj.timer);
            }
            obj.timer = setInterval(function(){
                for(var attr in json){
                    var iCur = parseInt(getStyle(obj, attr));
                    iCur = iCur ? iCur : 0;
                    var iSpeed = (json[attr] - iCur) / 5;
                    iSpeed = iSpeed > 0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
                    obj.style[attr] = iCur + iSpeed + 'px';
                    if(iCur == json[attr]){
                        clearInterval(obj.timer);
                    }
                }
            }, 30);
        }
        // alert(oPic.innerHTML)
        var oPicLi = oPic.getElementsByTagName("li");
        var oListLi = oList.getElementsByTagName("li");
        var len1 = oPicLi.length;
        var len2 = oListLi.length;
        
        var oPicUl = oPic.getElementsByTagName("ul")[0];
        var oListUl = oList.getElementsByTagName("ul")[0];
        var w1 = oPicLi[0].offsetWidth;
        var w2 = oListLi[0].offsetWidth;

        oPicUl.style.width = w1 * len1 + "px";
        oListUl.style.width = w2 * len2 + "px";
        var index = 0;
        var num2 = Math.ceil(num / 2);

        valx.siblings("em").text(len2);
        function Change(){
            Animate(oPicUl, {left: - index * w1});
            
            if(num==9){
                if(index < num2){
                    Animate(oListUl, {left: 0});
                }else if(index + num2 <= len2){
                        Animate(oListUl, {left: - (index - num2+1 ) * w2});
                }else{
                    Animate(oListUl, {left: - (len2 - num) * w2});
                }
            }else{
                if(index <= num2){
                    Animate(oListUl, {left: 0});
                }else if(index + num2 <= len2){
                        Animate(oListUl, {left: - (index - num2 ) * w2});
                }else{
                    Animate(oListUl, {left: - (len2 - num) * w2});
                }
            }
            
            for (var i = 0; i < len2; i++) {
                oListLi[i].className = "";
                if(i == index){
                    oListLi[i].className = "on";
                    valx.text(i+1);
                }
            }
        }
        
        oNextTop.onclick = function(){
            index ++;
            index = index == len2 ? 0 : index;
            Change();
        }
        
        oPrevTop.onmouseover = oNextTop.onmouseover = function(){
            clearInterval(timer);
            }
        oPrevTop.onmouseout = oNextTop.onmouseout = function(){
            timer=setInterval(autoPlay,4000);
            }

        oPrevTop.onclick = function(){
            index --;
            index = index == -1 ? len2 -1 : index;
            Change();
        }
        var timer=null;
        timer=setInterval(autoPlay,4000);
        function autoPlay(){
                index ++;
                index = index == len2 ? 0 : index;
                Change();
            }

        for (var i = 0; i < len2; i++) {
            oListLi[i].index = i;
            oListLi[i].onclick = function(){
                index = this.index;
                Change();
            }
        }
    }
	$("img").scrollLoading();
    
	$("#slide").cycle({ 
		pause: true,
		prev: '#prev',
		next: '#next'
	});

	//全部套系
	$("ul.all li").hover(function(){
		var t=$(this);
		t.addClass("active");
	},function(){
		var t=$(this), info=t.find(".info");
		t.removeClass("active");
	})

	//作品欣赏
	$(".enjoy .block ul.small li").hover(function(){
		var t = $(this), block = t.closest(".block"), big = block.find("ul.big");
		big.find("li").eq(t.index()).show().siblings("li").hide();
	})


	//私人定制
	$("ul.order li").hover(function(){
		var t=$(this);
		t.addClass("active");
	},function(){
		var t=$(this), info=t.find(".info");
		t.removeClass("active");
	})

	//解决IE8之类不支持getElementsByClassName
    if (!document.getElementsByClassName) {
        document.getElementsByClassName = function (className, element){
            var children = (element || document).getElementsByTagName('*');
            var elements = new Array();
            for (var i = 0; i < children.length; i++) {
                var child = children[i];
                var classNames = child.className.split(' ');
                for (var j = 0; j < classNames.length; j++) {
                    if (classNames[j] == className) {
                        elements.push(child);
                        break;
                    }
                }
            }
            return elements;
        };
    }
    //评论部分
    $(".comment1 .more span.mm").click(function(){
        var t = $(this), list = t.closest(".list"), s = t.closest(".list").find(".slideBox"), p = t.closest(".list").find("p.count");
        s.slideDown();
        t.hide().siblings().show();
        p.show();
        n = list.index();
        l = s.find(".upBox li").length;
        p.find("span").text(l); 
        var oPic2 = document.getElementsByClassName("downBox")[n];
        var oList2 = document.getElementsByClassName("upBox")[n];
        var oPrevTop2 = document.getElementsByClassName("prevx2")[n];
        var oNextTop2 = document.getElementsByClassName("nextx2")[n];
        var num2=9,valx2=$(".cgxc .picBox p i");
        allJ(oPic2,oList2,oPrevTop2,oNextTop2,num2,valx2);  
    })
        
    $(".comment1 .more span.ss").click(function(){
        var t=$(this), s=t.closest(".list").find(".slideBox"), p=t.closest(".list").find("p.count");
        s.slideUp();
        t.hide().siblings().show();
        p.hide();
    })

	 //星星打分
    var stars = [
        ['star_b1.png', 'star_b2.png', 'star_b2.png', 'star_b2.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b2.png', 'star_b2.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b2.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b2.png'],
        ['star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b1.png', 'star_b1.png'],
    ];

    $(".comment li").find("img").hover(function() { 
        var obj = $(this);
        var index = obj.index();
        var li = obj.closest("li"); 
        var star_area_index = li.index();
        for (var i = 0; i < 5; i++) {
            li.find("img").eq(i).attr("src", "images/" + stars[index][i]);//切换每个星星
        }  
    }, function() {
        var obj = $(this);
        var li = obj.closest("li");
        var star_area_index = li.index();
        var index = li.attr("data-default-index");//点击后的索引
        if (index >= 0) { //若该行点击后的索引大于等于0，说明该行星星已被点击
            for (var i = 0; i < 5; i++) {
                li.find("img").eq(i).attr("src", "images/" + stars[index][i]);//更新该行星星
            }
        } else {
            for (var i = 0; i < 5; i++) {
                li.find("img").eq(i).attr("src", "images/star_b2.png");//更新该行星星都变初始状态
            }
        }
    })
    $(".comment li").find("img").click(function() { 
        var obj = $(this);
        var li = obj.closest("li");
        var star_area_index = li.index();
        var index = obj.index();
        li.attr("data-default-index", index);
    })

    //图层弹出和关闭
    var bg=$("#bg"), pop=$("#pop"), H=pop.height();
    pop.css("marginTop",-(H/2));
    $(".star a.write").click(function(){
    	bg.show();
    	pop.show();
    })

    $("#pop p.close span,#bg").click(function(){
    	bg.hide();
    	pop.hide();
    })

    //-----------------上传图片-----------------

    //鼠标经过图片
    $(".loadImg li").hover(function(){
    	var t=$(this);
    	t.find("i,p").show();
    },function(){
    	var t=$(this);
    	t.find("i,p").hide();
    })
    //删除图片
    $(".loadImg li i").click(function(){
    	var t=$(this), li=t.closest("li");
    	li.remove();
    	if(t.closest("ul").find("li").length==0){
    		$(".loadImg span.delete").hide();	
    	}
    })
    $(".loadImg span.delete").click(function(){
    	var t=$(this);
    	t.siblings("ul").empty();
    	t.hide();
    })

    //左旋
    var n=0;
    $(".loadImg li em.leftR").click(function(){
    	var t=$(this), li=t.closest("li"), img= li.find("img");
    	n=n-90;
    	img.css("transform","rotate("+n+"deg)");
    })

    $(".loadImg li em.rightR").click(function(){
    	var t=$(this), li=t.closest("li"), img= li.find("img");
    	n=n+90;
    	img.css("transform","rotate("+n+"deg)");
    })
    var ul=$(".digImg .img ul");
    $(".loadImg li em.open").click(function(){
    	var t=$(this), li=t.closest("li"), img= li.find("img");
    	t.closest("ul").find("li").each(function(){
    		var $t=$(this),m=$t.index();
    		src=$t.find("img").attr("src");
    		ul.find("li:eq("+m+") img").attr("src",src);
    	})
    	index=li.index();
    	$(".popbg").show();
    	$(".digImg").show();
    	ul.find("li:eq("+index+")").show().siblings().hide();
    })
    $(".digImg i").click(function(){
    	$(".popbg").hide();
    	$(".digImg").hide();
    })
    $(".digImg .img a.next2").click(function(){
    	var L=ul.find("li").length;
    	index=index+1;
    	if(index==L){
    		index=0;
    	}
    	ul.find("li:eq("+index+")").show().siblings().hide();	
    })

    $(".digImg .img a.prev2").click(function(){
    	var L=ul.find("li").length-1;
    	index=index-1;
    	if(index==-1){
    		index=L;
    	}
    	ul.find("li:eq("+index+")").show().siblings().hide();	
    })

})