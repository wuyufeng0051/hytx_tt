function skyCanvas(){function t(t,i){if(arguments.length<2&&(i=t,t=0),t>i){var s=i;i=t,t=s}return Math.floor(Math.random()*(i-t+1))+t}function i(t,i){var s=Math.max(t,i),a=Math.round(Math.sqrt(s*s+s*s));return a/2}function s(){var t=new Image;t.src="/static/images/star1.jpg",t.onload=function(){n.drawImage(t,0,0),window.requestAnimationFrame(s)},n.drawImage(t,0,0);for(var i=1,a=r.length;a>i;i++)r[i].draw()}var a=document.getElementById("canvas"),n=a.getContext("2d"),o=a.width=$(".one-banner").width(),e=a.height=600,r=[],c=0,d=300,l=document.createElement("canvas"),h=l.getContext("2d");l.width=100,l.height=100;var m=l.width/2,f=h.createRadialGradient(m,m,3,m,m,26);f.addColorStop(.025,"#87c0f6"),f.addColorStop(.25,"#11417a"),f.addColorStop(1,"transparent"),h.fillStyle=f,h.beginPath(),h.arc(m,m,m,0,2*Math.PI),h.fill();var u=function(){this.orbitRadius=t(i(o,e)),this.radius=t(60,this.orbitRadius)/12,this.orbitX=o/2,this.orbitY=e/2,this.timePassed=t(0,d),this.speed=t(this.orbitRadius)/9e5,this.alpha=t(2,10)/10,c++,r[c]=this};u.prototype.draw=function(){var i=Math.sin(this.timePassed)*this.orbitRadius+this.orbitX,s=Math.cos(this.timePassed)*this.orbitRadius+this.orbitY,a=t(10);1===a&&this.alpha>0?this.alpha-=.05:2===a&&this.alpha<1&&(this.alpha+=.05),n.globalAlpha=this.alpha,n.drawImage(l,i-this.radius/2,s-this.radius/2,this.radius,this.radius),this.timePassed+=this.speed};for(var p=0;d>p;p++)new u;s()}$(function(){var t=0;linum=$("#gift-list li").length,liwidth=305*linum,visible=4,speed=2e3,$("#gift-list").css({width:liwidth+"px"}),$("#gift-next").on("click",function(){t<linum-visible&&(t++,$("#gift-list").css("left",305*-t+"px").attr("data-num",t))}),$("#gift-prev").on("click",function(){t>0&&(t--,$("#gift-list").css("left",305*-t+"px").attr("data-num",t))});for(var i=0;3>i;i++)$(".rank-table > tbody > tr:eq("+i+")").addClass("rank"+i);$("#customization").on("click",function(){$(".csrc-layer").show(),$(".layer-dialog").show().addClass("bounceInDown animated")}),$("#close").on("click",function(){$(".csrc-layer").hide(),$(".layer-dialog").hide(),$(".csrc-common-tips").css("top","-50px")}),$("#git-submit").on("click",function(){var t=$("#giftname").val(),i=$("#giftdes").val(),s=($("#gitimg").val(),$("input[name='_xsrf']").val());if(""==t)return $("#giftname").focus(),!1;var a="/custom_gift",n={gift_name:t,gift_des:i,_xsrf:s};$.post(a,n,function(t){t.ack?($(".csrc-common-tips").css("top","0").addClass("bg-success"),$(".csrc-common-tips p").html(t.msg),$(".csrc-layer").hide(),$(".layer-dialog").hide()):($(".csrc-common-tips").css("top","0").addClass("bg-danger"),$(".csrc-common-tips p").html(t.msg))})}),$(".csrc-common-tips span").on("click",function(){$(".csrc-common-tips").css("top","-50px")}),skyCanvas()}),$(window).resize(function(){skyCanvas()});