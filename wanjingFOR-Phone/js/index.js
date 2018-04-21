/**
 * 
 * @authors zhangzhixin
 * @date    2018-04-09 16:55:31
 */

 !function(s, t) {
    function u() {
        var a = x.getBoundingClientRect().width;
        a / A > 540 && (a = 540 * A);
        var d = a / 7.5;
        x.style.fontSize = d + "px",
        C.rem = s.rem = d
    }
    var v, w = s.document, x = w.documentElement, y = w.querySelector('meta[name="viewport"]'), z = w.querySelector('meta[name="flexible"]'), A = 0, B = 0, C = t.flexible || (t.flexible = {});
    if (y) {
        var D = y.getAttribute("content").match(/initial\-scale=([\d\.]+)/);
        D && (B = parseFloat(D[1]),
        A = parseInt(1 / B))
    } else {
        if (z) {
            var E = z.getAttribute("content");
            if (E) {
                var F = E.match(/initial\-dpr=([\d\.]+)/)
                  , G = E.match(/maximum\-dpr=([\d\.]+)/);
                F && (A = parseFloat(F[1]),
                B = parseFloat((1 / A).toFixed(2))),
                G && (A = parseFloat(G[1]),
                B = parseFloat((1 / A).toFixed(2)))
            }
        }
    }
    if (!A && !B) {
        var H = (s.navigator.appVersion.match(/android/gi),
        s.navigator.appVersion.match(/iphone/gi))
          , I = s.devicePixelRatio;
        A = H ? I >= 3 && (!A || A >= 3) ? 3 : I >= 2 && (!A || A >= 2) ? 2 : 1 : 1,
        B = 1 / A
    }
    if (x.setAttribute("data-dpr", A),
    !y) {
        if (y = w.createElement("meta"),
        y.setAttribute("name", "viewport"),
        y.setAttribute("content", "initial-scale=" + B + ", maximum-scale=" + B + ", minimum-scale=" + B + ", user-scalable=no"),
        x.firstElementChild) {
            x.firstElementChild.appendChild(y)
        } else {
            var J = w.createElement("div");
            J.appendChild(y),
            w.write(J.innerHTML)
        }
    }
    s.addEventListener("resize", function() {
        clearTimeout(v),
        v = setTimeout(u, 300)
    }, !1),
    "complete" === w.readyState ? w.body.style.fontSize = 12 * A + "px" : w.addEventListener("DOMContentLoaded", function(b) {
        // w.body.style.fontSize = 12 * A + "px"
    }, !1),
    u(),
    C.dpr = s.dpr = A,
    C.refreshRem = u,
    C.rem2px = function(c) {
      var d = parseFloat(c) * this.rem;
      return "string" == typeof c && c.match(/rem$/) && (d += "px"),
      d
    }
    ,
    C.px2rem = function(c) {
      var d = parseFloat(c) / this.rem;
      return "string" == typeof c && c.match(/px$/) && (d += "rem"),
      d
    }

	  s.addEventListener("pageshow", function(b) {

			b.persisted && (clearTimeout(v),
			v = setTimeout(u, 300))

	  }, false);
}(window, window.lib || (window.lib = {}));

$(function(){

// 侧滑
	$('.burger').click(function(){
	    if (!$(this).hasClass('open')) {
	        openMenu();
	    } else {
	        closeMenu();
	    }
	});
	function openMenu() {
	    $('.burger').addClass('open');
	    $('.y').fadeOut(100);
	    $('.screen').addClass('animate');
	    setTimeout(function () {
	        $('.x').addClass('rotate30');
	        $('.z').addClass('rotate150');
	        $('.menu').addClass('animate');
	        setTimeout(function () {
	            $('.x').addClass('rotate45');
	            $('.z').addClass('rotate135');
	        }, 100);
	    }, 10);
	}
	function closeMenu() {
	    $('.screen, .menu').removeClass('animate');
	    $('.y').fadeIn(150);
	    $('.burger').removeClass('open');
	    $('.x').removeClass('rotate45').addClass('rotate30');
	    $('.z').removeClass('rotate135').addClass('rotate150');
	    setTimeout(function () {
	        $('.x').removeClass('rotate30');
	        $('.z').removeClass('rotate150');
	    }, 50);
	    setTimeout(function () {
	        $('.x, .z').removeClass('collapse');
	    }, 70);
	}
// 幻灯片
    new Swiper('#slider', {pagination: '.pagination', slideClass: 'swiper-slide', paginationClickable: true, loop: true, autoplay: 3000, autoplayDisableOnInteraction : false});

// 公告栏
    new Swiper('#announcement', {
        direction: 'vertical',
        loop: true,
        autoplay : 2500
    })
})
