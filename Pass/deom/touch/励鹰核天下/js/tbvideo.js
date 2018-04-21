var tb_player_object = function() {
    var e = "undefined", t = "object", i = "Shockwave Flash", n = "ShockwaveFlash.ShockwaveFlash", a = "application/x-shockwave-flash", r = "SWFObjectExprInst", o = "onreadystatechange", l = window, f = document, s = navigator, d = false, u = [B], c = [], p = [], v = [], h, y, g, w, b = false, A = false, C, E, S = true, N = ["autoplay", "controls", "loop", "preload"], T = function() {
        var r = typeof f.getElementById != e && typeof f.getElementsByTagName != e && typeof f.createElement != e
          , o = s.userAgent.toLowerCase()
          , u = s.platform.toLowerCase()
          , c = u ? /win/.test(u) : /win/.test(o)
          , p = u ? /mac/.test(u) : /mac/.test(o)
          , v = /webkit/.test(o) ? parseFloat(o.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : false
          , h = !+"1"
          , y = [0, 0, 0]
          , m = null;
        if (typeof s.plugins != e && typeof s.plugins[i] == t) {
            m = s.plugins[i].description;
            if (m && !(typeof s.mimeTypes != e && s.mimeTypes[a] && !s.mimeTypes[a].enabledPlugin)) {
                d = true;
                h = false;
                m = m.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
                y[0] = parseInt(m.replace(/^(.*)\..*$/, "$1"), 10);
                y[1] = parseInt(m.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
                y[2] = /[a-zA-Z]/.test(m) ? parseInt(m.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0
            }
        } else if (typeof l.ActiveXObject != e) {
            try {
                var g = new ActiveXObject(n);
                if (g) {
                    m = g.GetVariable("$version");
                    if (m) {
                        h = true;
                        m = m.split(" ")[1].split(",");
                        y = [parseInt(m[0], 10), parseInt(m[1], 10), parseInt(m[2], 10)]
                    }
                }
            } catch (w) {}
        }
        return {
            w3: r,
            pv: y,
            wk: v,
            ie: h,
            win: c,
            mac: p
        }
    }(), I = function() {
        if (!T.w3) {
            return
        }
        if (typeof f.readyState != e && f.readyState == "complete" || typeof f.readyState == e && (f.getElementsByTagName("body")[0] || f.body)) {
            k()
        }
        if (!b) {
            if (typeof f.addEventListener != e) {
                f.addEventListener("DOMContentLoaded", k, false)
            }
            if (T.ie && T.win) {
                f.attachEvent(o, function() {
                    if (f.readyState == "complete") {
                        f.detachEvent(o, arguments.callee);
                        k()
                    }
                });
                if (l == top) {
                    (function() {
                        if (b) {
                            return
                        }
                        try {
                            f.documentElement.doScroll("left")
                        } catch (e) {
                            setTimeout(arguments.callee, 0);
                            return
                        }
                        k()
                    })()
                }
            }
            if (T.wk) {
                (function() {
                    if (b) {
                        return
                    }
                    if (!/loaded|complete/.test(f.readyState)) {
                        setTimeout(arguments.callee, 0);
                        return
                    }
                    k()
                })()
            }
            O(k)
        }
    }();
    function k() {
        if (b) {
            return
        }
        try {
            var e = f.getElementsByTagName("body")[0].appendChild(W("span"));
            e.parentNode.removeChild(e)
        } catch (t) {
            return
        }
        b = true;
        var i = u.length;
        for (var n = 0; n < i; n++) {
            u[n]()
        }
    }
    function L(e) {
        if (b) {
            e()
        } else {
            u[u.length] = e
        }
    }
    function O(t) {
        if (typeof l.addEventListener != e) {
            l.addEventListener("load", t, false)
        } else if (typeof f.addEventListener != e) {
            f.addEventListener("load", t, false)
        } else if (typeof l.attachEvent != e) {
            G(l, "onload", t)
        } else if (typeof l.onload == "function") {
            var i = l.onload;
            l.onload = function() {
                i();
                t()
            }
        } else {
            l.onload = t
        }
    }
    function B() {
        if (d) {
            _()
        } else {
            j()
        }
    }
    function _() {
        var i = f.getElementsByTagName("body")[0];
        var n = W(t);
        n.setAttribute("type", a);
        var r = i.appendChild(n);
        if (r) {
            var o = 0;
            (function() {
                if (typeof r.GetVariable != e) {
                    var t = r.GetVariable("$version");
                    if (t) {
                        t = t.split(" ")[1].split(",");
                        T.pv = [parseInt(t[0], 10), parseInt(t[1], 10), parseInt(t[2], 10)]
                    }
                } else if (o < 10) {
                    o++;
                    setTimeout(arguments.callee, 10);
                    return
                }
                i.removeChild(n);
                r = null;
                j()
            })()
        } else {
            j()
        }
    }
    function j() {
        var t = c.length;
        if (t > 0) {
            for (var i = 0; i < t; i++) {
                var n = c[i].id;
                var a = c[i].callbackFn;
                var r = {
                    success: false,
                    id: n
                };
                if (T.pv[0] > 0) {
                    var o = U(n);
                    if (o) {
                        if (J(c[i].swfVersion) && !(T.wk && T.wk < 312)) {
                            z(n, true);
                            if (a) {
                                r.success = true;
                                r.ref = F(n);
                                a(r)
                            }
                        } else if (c[i].expressInstall && x()) {
                            var l = {};
                            l.data = c[i].expressInstall;
                            l.width = o.getAttribute("width") || "0";
                            l.height = o.getAttribute("height") || "0";
                            if (o.getAttribute("class")) {
                                l.styleclass = o.getAttribute("class")
                            }
                            if (o.getAttribute("align")) {
                                l.align = o.getAttribute("align")
                            }
                            var f = {};
                            var s = o.getElementsByTagName("param");
                            var d = s.length;
                            for (var u = 0; u < d; u++) {
                                if (s[u].getAttribute("name").toLowerCase() != "movie") {
                                    f[s[u].getAttribute("name")] = s[u].getAttribute("value")
                                }
                            }
                            M(l, f, n, a)
                        } else {
                            P(o);
                            if (a) {
                                a(r)
                            }
                        }
                    }
                } else {
                    z(n, true);
                    if (a) {
                        var p = F(n);
                        if (p && typeof p.SetVariable != e) {
                            r.success = true;
                            r.ref = p
                        }
                        a(r)
                    }
                }
            }
        }
    }
    function F(i) {
        var n = null;
        var a = U(i);
        if (a && a.nodeName == "OBJECT") {
            if (typeof a.SetVariable != e) {
                n = a
            } else {
                var r = a.getElementsByTagName(t)[0];
                if (r) {
                    n = r
                }
            }
        }
        return n
    }
    function x() {
        return !A && J("6.0.65") && (T.win || T.mac) && !(T.wk && T.wk < 312)
    }
    function M(t, i, n, a) {
        A = true;
        g = a || null;
        w = {
            success: false,
            id: n
        };
        var o = U(n);
        if (o) {
            if (o.nodeName == "OBJECT") {
                h = $(o);
                y = null
            } else {
                h = o;
                y = n
            }
            t.id = r;
            if (typeof t.width == e || !/%$/.test(t.width) && parseInt(t.width, 10) < 310) {
                t.width = "310"
            }
            if (typeof t.height == e || !/%$/.test(t.height) && parseInt(t.height, 10) < 137) {
                t.height = "137"
            }
            f.title = f.title.slice(0, 47) + " - Flash Player Installation";
            var s = T.ie && T.win ? "ActiveX" : "PlugIn"
              , d = "MMredirectURL=" + l.location.toString().replace(/&/g, "%26") + "&MMplayerType=" + s + "&MMdoctitle=" + f.title;
            if (typeof i.flashvars != e) {
                i.flashvars += "&" + d
            } else {
                i.flashvars = d
            }
            if (T.ie && T.win && o.readyState != 4) {
                var u = W("div");
                n += "SWFObjectNew";
                u.setAttribute("id", n);
                o.parentNode.insertBefore(u, o);
                o.style.display = "none";
                (function() {
                    if (o.readyState == 4) {
                        o.parentNode.removeChild(o)
                    } else {
                        setTimeout(arguments.callee, 10)
                    }
                })()
            }
            V(t, i, n)
        }
    }
    function P(e) {
        if (T.ie && T.win && e.readyState != 4) {
            var t = W("div");
            e.parentNode.insertBefore(t, e);
            t.parentNode.replaceChild($(e), t);
            e.style.display = "none";
            (function() {
                if (e.readyState == 4) {
                    e.parentNode.removeChild(e)
                } else {
                    setTimeout(arguments.callee, 10)
                }
            })()
        } else {
            e.parentNode.replaceChild($(e), e)
        }
    }
    function $(e) {
        var i = W("div");
        if (T.win && T.ie) {
            i.innerHTML = e.innerHTML
        } else {
            var n = e.getElementsByTagName(t)[0];
            if (n) {
                var a = n.childNodes;
                if (a) {
                    var r = a.length;
                    for (var o = 0; o < r; o++) {
                        if (!(a[o].nodeType == 1 && a[o].nodeName == "PARAM") && !(a[o].nodeType == 8)) {
                            i.appendChild(a[o].cloneNode(true))
                        }
                    }
                }
            }
        }
        return i
    }
    function V(i, n, r) {
        var o, l = U(r);
        if (T.wk && T.wk < 312) {
            return o
        }
        if (l) {
            if (typeof i.id == e) {
                i.id = r
            }
            if (T.ie && T.win) {
                var f = "";
                for (var s in i) {
                    if (i[s] != Object.prototype[s]) {
                        if (s.toLowerCase() == "data") {
                            n.movie = i[s]
                        } else if (s.toLowerCase() == "styleclass") {
                            f += ' class="' + i[s] + '"'
                        } else if (s.toLowerCase() != "classid") {
                            f += " " + s + '="' + i[s] + '"'
                        }
                    }
                }
                var d = "";
                for (var u in n) {
                    if (n[u] != Object.prototype[u]) {
                        d += '<param name="' + u + '" value="' + n[u] + '" />'
                    }
                }
                l.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + f + ">" + d + "</object>";
                p[p.length] = i.id;
                o = U(i.id)
            } else {
                var c = W(t);
                c.setAttribute("type", a);
                for (var v in i) {
                    if (i[v] != Object.prototype[v]) {
                        if (v.toLowerCase() == "styleclass") {
                            c.setAttribute("class", i[v])
                        } else if (v.toLowerCase() != "classid") {
                            c.setAttribute(v, i[v])
                        }
                    }
                }
                for (var h in n) {
                    if (n[h] != Object.prototype[h] && h.toLowerCase() != "movie") {
                        R(c, h, n[h])
                    }
                }
                l.parentNode.replaceChild(c, l);
                o = c
            }
        }
        return o
    }
    function R(e, t, i) {
        var n = W("param");
        n.setAttribute("name", t);
        n.setAttribute("value", i);
        e.appendChild(n)
    }
    function D(e) {
        var t = U(e);
        if (t && t.nodeName == "OBJECT") {
            if (T.ie && T.win) {
                t.style.display = "none";
                (function() {
                    if (t.readyState == 4) {
                        H(e)
                    } else {
                        setTimeout(arguments.callee, 10)
                    }
                })()
            } else {
                t.parentNode.removeChild(t)
            }
        }
    }
    function H(e) {
        var t = U(e);
        if (t) {
            for (var i in t) {
                if (typeof t[i] == "function") {
                    t[i] = null
                }
            }
            t.parentNode.removeChild(t)
        }
    }
    function U(e) {
        var t = null;
        try {
            t = f.getElementById(e)
        } catch (i) {}
        return t
    }
    function W(e) {
        return f.createElement(e)
    }
    function G(e, t, i) {
        e.attachEvent(t, i);
        v[v.length] = [e, t, i]
    }
    function J(e) {
        var t = T.pv
          , i = e.split(".");
        i[0] = parseInt(i[0], 10);
        i[1] = parseInt(i[1], 10) || 0;
        i[2] = parseInt(i[2], 10) || 0;
        return t[0] > i[0] || t[0] == i[0] && t[1] > i[1] || t[0] == i[0] && t[1] == i[1] && t[2] >= i[2] ? true : false
    }
    function X(i, n, a, r) {
        if (T.ie && T.mac) {
            return
        }
        var o = f.getElementsByTagName("head")[0];
        if (!o) {
            return
        }
        var l = a && typeof a == "string" ? a : "screen";
        if (r) {
            C = null;
            E = null
        }
        if (!C || E != l) {
            var s = W("style");
            s.setAttribute("type", "text/css");
            s.setAttribute("media", l);
            C = o.appendChild(s);
            if (T.ie && T.win && typeof f.styleSheets != e && f.styleSheets.length > 0) {
                C = f.styleSheets[f.styleSheets.length - 1]
            }
            E = l
        }
        if (T.ie && T.win) {
            if (C && typeof C.addRule == t) {
                C.addRule(i, n)
            }
        } else {
            if (C && typeof f.createTextNode != e) {
                C.appendChild(f.createTextNode(i + " {" + n + "}"))
            }
        }
    }
    function z(e, t) {
        if (!S) {
            return
        }
        var i = t ? "visible" : "hidden";
        if (b && U(e)) {
            U(e).style.visibility = i
        } else {
            X("#" + e, "visibility:" + i)
        }
    }
    function Z(t) {
        var i = /[\\\"<>\.;]/;
        var n = i.exec(t) != null;
        return n && typeof encodeURIComponent != e ? encodeURIComponent(t) : t
    }
    function q(i, n, a, r, o, l, f, s, d, u) {
        var c = {
            success: false,
            id: n
        };
        if (T.w3 && !(T.wk && T.wk < 312) && i && n && a && r && o) {
            z(n, false);
            L(function() {
                a += "";
                r += "";
                var p = {};
                if (d && typeof d === t) {
                    for (var v in d) {
                        p[v] = d[v]
                    }
                }
                p.data = i;
                p.width = a;
                p.height = r;
                var h = {};
                if (s && typeof s === t) {
                    for (var y in s) {
                        h[y] = s[y]
                    }
                }
                if (f && typeof f === t) {
                    for (var m in f) {
                        if (typeof h.flashvars != e) {
                            h.flashvars += "&" + m + "=" + f[m]
                        } else {
                            h.flashvars = m + "=" + f[m]
                        }
                    }
                }
                if (J(o)) {
                    var g = V(p, h, n);
                    if (p.id == n) {
                        z(n, true)
                    }
                    c.success = true;
                    c.ref = g
                } else if (l && x()) {
                    p.data = l;
                    M(p, h, n, u);
                    return
                } else {
                    z(n, true)
                }
                if (u) {
                    u(c)
                }
            })
        } else if (u) {
            u(c)
        }
    }
    var Q = function() {
        var e = {
            mobile: undefined,
            ipad: undefined,
            iphone: undefined,
            ipod: undefined,
            ios: undefined,
            android: undefined
        };
        function t(e) {
            var t = 0;
            return parseFloat(e.replace(/\./g, function() {
                return t++ === 0 ? "." : ""
            }))
        }
        var i = navigator && navigator.userAgent || "";
        if (/ Mobile\//.test(i) && i.match(/iPad|iPod|iPhone/)) {
            e.mobile = "apple";
            m = i.match(/OS ([^\s]*)/);
            if (m && m[1]) {
                e.ios = t(m[1].replace("_", "."))
            }
            m = i.match(/iPad|iPod|iPhone/);
            if (m && m[0]) {
                e[m[0].toLowerCase()] = e.ios
            }
        } else if (/ Android/.test(i)) {
            if (/Mobile/.test(i)) {
                e.mobile = "android"
            }
            m = i.match(/Android ([^\s]*);/);
            if (m && m[1]) {
                e.android = t(m[1])
            }
        }
        return e
    }();
    var K = function() {
        if (T.ie && T.win) {
            window.attachEvent("onunload", function() {
                var e = v.length;
                for (var t = 0; t < e; t++) {
                    v[t][0].detachEvent(v[t][1], v[t][2])
                }
                var i = p.length;
                for (var n = 0; n < i; n++) {
                    D(p[n])
                }
                for (var a in T) {
                    T[a] = null
                }
                T = null;
                for (var r in tb_player_object) {
                    tb_player_object[r] = null
                }
                tb_player_object = null
            })
        }
    }();
    function Y(e, t, i, n) {
        var a = document.createElement("video");
        if ("undefined" == typeof a || null == a) {
            return false
        }
        if ("true" == i.plays_inline || true === i.plays_inline) {
            a.setAttribute("webkit-playsinline", "webkit-playsinline")
        }
        a.setAttribute("width", t.width);
        a.setAttribute("height", t.height);
        a.setAttribute("controls", "controls");
        if ("undefined" != typeof i.poster) {
            a.setAttribute("poster", i.poster)
        }
        var r = N.length;
        for (var o = 0; o < r; o++) {
            var l = N[o];
            var f = i[l];
            if ("undefined" != typeof f) {
                if ("true" == f || true === f) {
                    a.setAttribute(l, l)
                } else if ("false" == f || false === f) {
                    a.removeAttribute(l)
                }
            }
        }
        a.setAttribute("id", t.div);
        a.style.backgroundColor = "#222";
        a.setAttribute("src", n);
        e.parentNode.replaceChild(a, e);
        return true
    }
    function et(e, t, i, n, a) {
        if (!J("9.0")) {
            e.innerHTML = "\u6ca1\u6709\u5b89\u88c5Flash\uff0c\u8bf7\u5148<a href='http://get.adobe.com/cn/flashplayer'>\u4e0b\u8f7d</a>";
            return
        }
        a.menu = "false";
        a.quality = "high";
        if (J("10.1.0")) {
            t += "/e/1/t/" + i.tid + "/fv/102/" + i.vid + ".swf";
            q(t, i.div, i.width, i.height, "10.1.0", t, n, a)
        } else {
            t += "/e/1/t/" + i.tid + "/fv/1/" + i.vid + ".swf";
            q(t, i.div, i.width, i.height, "9.0.0", t, n, a)
        }
    }
    return {
        registerObject: function(e, t, i, n) {
            if (T.w3 && e && t) {
                var a = {};
                a.id = e;
                a.swfVersion = t;
                a.expressInstall = i;
                a.callbackFn = n;
                c[c.length] = a;
                z(e, false)
            } else if (n) {
                n({
                    success: false,
                    id: e
                })
            }
        },
        getObjectById: function(e) {
            if (T.w3) {
                return F(e)
            }
        },
        embedPlayer: function(t, i, n) {
            if ("undefined" == typeof t.vid) {
                alert("\u4eb2\uff0c\u8bf7\u6307\u5b9a\u89c6\u9891vid!");
                return
            }
            if ("undefined" == typeof t.uid) {
                alert("\u4eb2\uff0c\u8bf7\u6307\u5b9a\u89c6\u9891\u6240\u6709\u8005uid!");
                return
            }
            if ("undefined" == typeof t.width) {
                alert("\u4eb2\uff0c\u8bf7\u6307\u5b9a\u5bbdwidth!");
                return
            }
            if ("undefined" == typeof t.height) {
                alert("\u4eb2\uff0c\u8bf7\u6307\u5b9a\u9ad8height!");
                return
            }
            if ("undefined" == typeof t.tid) {
                t.tid = 1
            }
            var a = document.location.protocol + "//cloud.video.taobao.com/play/u/" + t.uid + "/p/1";
            if (l.location.href.indexOf("daily.") > 0 || l.location.href.indexOf("test.") > 0 && l.location.href.indexOf("special") > 0) {
                a = document.location.protocol + "//cloud.video.daily.taobao.net/play/u/" + t.uid + "/p/1"
            }
            if ("undefined" != typeof i.showloadinglogo && ("false" === i.showloadinglogo || false === i.showloadinglogo)) {
                i.reservelt = 9527;
                i.showloadinglogo = e
            }
            if ("undefined" != typeof i.showvideologo) {
                i.showplayinglogo = i.showvideologo;
                i.showvideologo = e
            }
            if ("undefined" != typeof i.showlogobtn) {
                i.show_controlbar_logo = i.showlogobtn;
                i.showlogobtn = e
            }
            if ("undefined" != typeof i.logourl) {
                i.logo_url = i.logourl;
                i.logourl = e
            }
            if ("undefined" != typeof i.showfullscreenbtn) {
                i.show_fullscreen_button = i.showfullscreenbtn;
                i.showfullscreenbtn = e
            }
            if ("undefined" != typeof i.showsharebutton) {
                i.show_share_button = i.showsharebutton;
                i.showsharebutton = e
            }
            if ("undefined" != typeof i.playsinline) {
                i.plays_inline = i.playsinline;
                i.playsinline = e
            }
            if ("undefined" != typeof i.autoreplay) {
                i.loop = i.autoreplay
            }
            if ("undefined" == typeof n.wmode) {
                n.wmode = "transparent"
            }
            if ("undefined" == typeof n.allowScriptAccess) {
                n.allowScriptAccess = "always"
            }
            if ("undefined" == typeof n.allowFullScreen) {
                n.allowFullScreen = true
            }
            var r = document.getElementById(t.div);
            if ("undefined" == typeof r || null == r) {
                alert("\u4eb2\uff0c\u7528\u4e8emount\u89c6\u9891\u8d44\u6e90\u7684\u8282\u70b9\u4e0d\u5b58\u5728!");
                return
            }
            var o = function() {
                if ("undefined" != typeof window.console) {
                    console.log("\u4eb2\uff0c\u521b\u5efa\u89c6\u9891\u8282\u70b9\u5931\u8d25!")
                }
            };
            if ("undefined" != typeof Q.mobile && "android" == Q.mobile && "undefined" != typeof Q.android) {
                a += "/e/6/t/" + t.tid + "/" + t.vid + ".mp4";
                if (!Y(r, t, i, a)) {
                    o();
                    return
                }
                return
            }
            if ("undefined" != typeof Q.mobile && "apple" == Q.mobile) {
                if ("undefined" != typeof Q.ipad && Q.ipad > 0) {
                    a += "/e/2/t/" + t.tid + "/" + t.vid + ".m3u8"
                } else if ("undefined" != typeof Q.iphone && Q.iphone > 0) {
                    a += "/e/3/t/" + t.tid + "/" + t.vid + ".m3u8"
                }
                if (!Y(r, t, i, a)) {
                    o();
                    return
                }
                return
            }
            if (T.mac && T.wk && !J("9.0")) {
                a += "/e/6/t/" + t.tid + "/" + t.vid + ".mp4";
                if (!Y(r, t, i, a)) {
                    o();
                    et(r, a, t, i, n)
                }
            } else {
                et(r, a, t, i, n)
            }
        },
        switchOffAutoHideShow: function() {
            S = false
        },
        ua: T,
        mUa: Q,
        getFlashPlayerVersion: function() {
            return {
                major: T.pv[0],
                minor: T.pv[1],
                release: T.pv[2]
            }
        },
        hasFlashPlayerVersion: J,
        createSWF: function(e, t, i) {
            if (T.w3) {
                return V(e, t, i)
            } else {
                return undefined
            }
        },
        showExpressInstall: function(e, t, i, n) {
            if (T.w3 && x()) {
                M(e, t, i, n)
            }
        },
        removeSWF: function(e) {
            if (T.w3) {
                D(e)
            }
        },
        createCSS: function(e, t, i, n) {
            if (T.w3) {
                X(e, t, i, n)
            }
        },
        addDomLoadEvent: L,
        addLoadEvent: O,
        getQueryParamValue: function(e) {
            var t = f.location.search || f.location.hash;
            if (t) {
                if (/\?/.test(t)) {
                    t = t.split("?")[1]
                }
                if (e == null) {
                    return Z(t)
                }
                var i = t.split("&");
                for (var n = 0; n < i.length; n++) {
                    if (i[n].substring(0, i[n].indexOf("=")) == e) {
                        return Z(i[n].substring(i[n].indexOf("=") + 1))
                    }
                }
            }
            return ""
        },
        expressInstallCallback: function() {
            if (A) {
                var e = U(r);
                if (e && h) {
                    e.parentNode.replaceChild(h, e);
                    if (y) {
                        z(y, true);
                        if (T.ie && T.win) {
                            h.style.display = "block"
                        }
                    }
                    if (g) {
                        g(w)
                    }
                }
                A = false
            }
        }
    }
}();

