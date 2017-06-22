function isSmall() {
    return $("#main-nav .menu-toggle").is(":visible")
}

function stickyCategorySelect() {
    var t = $("#category-select"),
        e = $(window).scrollTop(),
        n = "stick-to-it",
        i = t.hasClass(n);
    e > t.offset().top ? i || t.addClass(n) : i && t.removeClass(n)
}

function scrollChange() {
    var t = getActiveLink();
    t && !t.hasClass("active") && ($("#home-slide-nav a").removeClass("active"), t.addClass("active"));
    var e = parseInt(4 * $("body").innerHeight()),
        n = $(document).scrollTop();
    n > e ? $("#home-slide-nav").hide() : $("#home-slide-nav").show()
}

function getActiveLink() {
    var t = $(window).scrollTop(),
        e = null;
    return $("#home-slide-nav a").each(function() {
        var n = $(this),
            i = n.attr("id").replace(/^.*\-(\d+)$/, "$1"),
            s = $("#post-" + i);
        return t + $(window).height() / 2 > s.offset().top ? void(e = n) : e
    }), e
}

function EasyPeasyParallax() {
    var t = $(document).scrollTop(),
        e = 1;
    300 > t && (e = parseInt(t / 3), e = 10 > e ? "0.0" + e : "0." + e), $(".banner-inner-wrap").css({
        "background-color": "rgba(0, 0, 0, " + e + ")"
    })
}

function checkWidth(t) {
    $(window).width() > 768 ? $("body").addClass("desk") : t || $("body").removeClass("desk"), $(window).width() < 769 ? $("body").addClass("ipad") : t || $("body").removeClass("ipad"), $(window).width() < 481 ? ($("body").addClass("mobile"), $("body").removeClass("ipad")) : t || $("body").removeClass("mobile")
}
window.Modernizr = function(t, e, n) {
        function i(t) {
            _.cssText = t
        }

        function s(t, e) {
            return i(C.join(t + ";") + (e || ""))
        }

        function a(t, e) {
            return typeof t === e
        }

        function o(t, e) {
            return !!~("" + t).indexOf(e)
        }

        function r(t, e) {
            for (var i in t) {
                var s = t[i];
                if (!o(s, "-") && _[s] !== n) return "pfx" == e ? s : !0
            }
            return !1
        }

        function l(t, e, i) {
            for (var s in t) {
                var o = e[t[s]];
                if (o !== n) return i === !1 ? t[s] : a(o, "function") ? o.bind(i || e) : o
            }
            return !1
        }

        function c(t, e, n) {
            var i = t.charAt(0).toUpperCase() + t.slice(1),
                s = (t + " " + S.join(i + " ") + i).split(" ");
            return a(e, "string") || a(e, "undefined") ? r(s, e) : (s = (t + " " + T.join(i + " ") + i).split(" "), l(s, e, n))
        }

        function d() {
            p.input = function(n) {
                for (var i = 0, s = n.length; s > i; i++) I[n[i]] = !!(n[i] in b);
                return I.list && (I.list = !(!e.createElement("datalist") || !t.HTMLDataListElement)), I
            }("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")), p.inputtypes = function(t) {
                for (var i, s, a, o = 0, r = t.length; r > o; o++) b.setAttribute("type", s = t[o]), i = "text" !== b.type, i && (b.value = x, b.style.cssText = "position:absolute;visibility:hidden;", /^range$/.test(s) && b.style.WebkitAppearance !== n ? (m.appendChild(b), a = e.defaultView, i = a.getComputedStyle && "textfield" !== a.getComputedStyle(b, null).WebkitAppearance && 0 !== b.offsetHeight, m.removeChild(b)) : /^(search|tel)$/.test(s) || (i = /^(url|email)$/.test(s) ? b.checkValidity && b.checkValidity() === !1 : b.value != x)), F[t[o]] = !!i;
                return F
            }("search tel url email datetime date month week time datetime-local number range color".split(" "))
        }
        var u, h, f = "2.7.2",
            p = {},
            g = !0,
            m = e.documentElement,
            v = "modernizr",
            y = e.createElement(v),
            _ = y.style,
            b = e.createElement("input"),
            x = ":)",
            w = {}.toString,
            C = " -webkit- -moz- -o- -ms- ".split(" "),
            k = "Webkit Moz O ms",
            S = k.split(" "),
            T = k.toLowerCase().split(" "),
            A = {
                svg: "http://www.w3.org/2000/svg"
            },
            $ = {},
            F = {},
            I = {},
            j = [],
            E = j.slice,
            D = function(t, n, i, s) {
                var a, o, r, l, c = e.createElement("div"),
                    d = e.body,
                    u = d || e.createElement("body");
                if (parseInt(i, 10))
                    for (; i--;) r = e.createElement("div"), r.id = s ? s[i] : v + (i + 1), c.appendChild(r);
                return a = ["&#173;", '<style id="s', v, '">', t, "</style>"].join(""), c.id = v, (d ? c : u).innerHTML += a, u.appendChild(c), d || (u.style.background = "", u.style.overflow = "hidden", l = m.style.overflow, m.style.overflow = "hidden", m.appendChild(u)), o = n(c, t), d ? c.parentNode.removeChild(c) : (u.parentNode.removeChild(u), m.style.overflow = l), !!o
            },
            P = function(e) {
                var n = t.matchMedia || t.msMatchMedia;
                if (n) return n(e).matches;
                var i;
                return D("@media " + e + " { #" + v + " { position: absolute; } }", function(e) {
                    i = "absolute" == (t.getComputedStyle ? getComputedStyle(e, null) : e.currentStyle).position
                }), i
            },
            N = function() {
                function t(t, s) {
                    s = s || e.createElement(i[t] || "div"), t = "on" + t;
                    var o = t in s;
                    return o || (s.setAttribute || (s = e.createElement("div")), s.setAttribute && s.removeAttribute && (s.setAttribute(t, ""), o = a(s[t], "function"), a(s[t], "undefined") || (s[t] = n), s.removeAttribute(t))), s = null, o
                }
                var i = {
                    select: "input",
                    change: "input",
                    submit: "form",
                    reset: "form",
                    error: "img",
                    load: "img",
                    abort: "img"
                };
                return t
            }(),
            M = {}.hasOwnProperty;
        h = a(M, "undefined") || a(M.call, "undefined") ? function(t, e) {
            return e in t && a(t.constructor.prototype[e], "undefined")
        } : function(t, e) {
            return M.call(t, e)
        }, Function.prototype.bind || (Function.prototype.bind = function(t) {
            var e = this;
            if ("function" != typeof e) throw new TypeError;
            var n = E.call(arguments, 1),
                i = function() {
                    if (this instanceof i) {
                        var s = function() {};
                        s.prototype = e.prototype;
                        var a = new s,
                            o = e.apply(a, n.concat(E.call(arguments)));
                        return Object(o) === o ? o : a
                    }
                    return e.apply(t, n.concat(E.call(arguments)))
                };
            return i
        }), $.flexbox = function() {
            return c("flexWrap")
        }, $.flexboxlegacy = function() {
            return c("boxDirection")
        }, $.canvas = function() {
            var t = e.createElement("canvas");
            return !(!t.getContext || !t.getContext("2d"))
        }, $.canvastext = function() {
            return !(!p.canvas || !a(e.createElement("canvas").getContext("2d").fillText, "function"))
        }, $.webgl = function() {
            return !!t.WebGLRenderingContext
        }, $.touch = function() {
            var n;
            return "ontouchstart" in t || t.DocumentTouch && e instanceof DocumentTouch ? n = !0 : D(["@media (", C.join("touch-enabled),("), v, ")", "{#modernizr{top:9px;position:absolute}}"].join(""), function(t) {
                n = 9 === t.offsetTop
            }), n
        }, $.geolocation = function() {
            return "geolocation" in navigator
        }, $.postmessage = function() {
            return !!t.postMessage
        }, $.websqldatabase = function() {
            return !!t.openDatabase
        }, $.indexedDB = function() {
            return !!c("indexedDB", t)
        }, $.hashchange = function() {
            return N("hashchange", t) && (e.documentMode === n || e.documentMode > 7)
        }, $.history = function() {
            return !(!t.history || !history.pushState)
        }, $.draganddrop = function() {
            var t = e.createElement("div");
            return "draggable" in t || "ondragstart" in t && "ondrop" in t
        }, $.websockets = function() {
            return "WebSocket" in t || "MozWebSocket" in t
        }, $.rgba = function() {
            return i("background-color:rgba(150,255,150,.5)"), o(_.backgroundColor, "rgba")
        }, $.hsla = function() {
            return i("background-color:hsla(120,40%,100%,.5)"), o(_.backgroundColor, "rgba") || o(_.backgroundColor, "hsla")
        }, $.multiplebgs = function() {
            return i("background:url(https://),url(https://),red url(https://)"), /(url\s*\(.*?){3}/.test(_.background)
        }, $.backgroundsize = function() {
            return c("backgroundSize")
        }, $.borderimage = function() {
            return c("borderImage")
        }, $.borderradius = function() {
            return c("borderRadius")
        }, $.boxshadow = function() {
            return c("boxShadow")
        }, $.textshadow = function() {
            return "" === e.createElement("div").style.textShadow
        }, $.opacity = function() {
            return s("opacity:.55"), /^0.55$/.test(_.opacity)
        }, $.cssanimations = function() {
            return c("animationName")
        }, $.csscolumns = function() {
            return c("columnCount")
        }, $.cssgradients = function() {
            var t = "background-image:",
                e = "gradient(linear,left top,right bottom,from(#9f9),to(white));",
                n = "linear-gradient(left top,#9f9, white);";
            return i((t + "-webkit- ".split(" ").join(e + t) + C.join(n + t)).slice(0, -t.length)), o(_.backgroundImage, "gradient")
        }, $.cssreflections = function() {
            return c("boxReflect")
        }, $.csstransforms = function() {
            return !!c("transform")
        }, $.csstransforms3d = function() {
            var t = !!c("perspective");
            return t && "webkitPerspective" in m.style && D("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}", function(e) {
                t = 9 === e.offsetLeft && 3 === e.offsetHeight
            }), t
        }, $.csstransitions = function() {
            return c("transition")
        }, $.fontface = function() {
            var t;
            return D('@font-face {font-family:"font";src:url("https://")}', function(n, i) {
                var s = e.getElementById("smodernizr"),
                    a = s.sheet || s.styleSheet,
                    o = a ? a.cssRules && a.cssRules[0] ? a.cssRules[0].cssText : a.cssText || "" : "";
                t = /src/i.test(o) && 0 === o.indexOf(i.split(" ")[0])
            }), t
        }, $.generatedcontent = function() {
            var t;
            return D(["#", v, "{font:0/0 a}#", v, ':after{content:"', x, '";visibility:hidden;font:3px/1 a}'].join(""), function(e) {
                t = e.offsetHeight >= 3
            }), t
        }, $.video = function() {
            var t = e.createElement("video"),
                n = !1;
            try {
                (n = !!t.canPlayType) && (n = new Boolean(n), n.ogg = t.canPlayType('video/ogg; codecs="theora"').replace(/^no$/, ""), n.h264 = t.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/, ""), n.webm = t.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/, ""))
            } catch (i) {}
            return n
        }, $.audio = function() {
            var t = e.createElement("audio"),
                n = !1;
            try {
                (n = !!t.canPlayType) && (n = new Boolean(n), n.ogg = t.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/, ""), n.mp3 = t.canPlayType("audio/mpeg;").replace(/^no$/, ""), n.wav = t.canPlayType('audio/wav; codecs="1"').replace(/^no$/, ""), n.m4a = (t.canPlayType("audio/x-m4a;") || t.canPlayType("audio/aac;")).replace(/^no$/, ""))
            } catch (i) {}
            return n
        }, $.localstorage = function() {
            try {
                return localStorage.setItem(v, v), localStorage.removeItem(v), !0
            } catch (t) {
                return !1
            }
        }, $.sessionstorage = function() {
            try {
                return sessionStorage.setItem(v, v), sessionStorage.removeItem(v), !0
            } catch (t) {
                return !1
            }
        }, $.webworkers = function() {
            return !!t.Worker
        }, $.applicationcache = function() {
            return !!t.applicationCache
        }, $.svg = function() {
            return !!e.createElementNS && !!e.createElementNS(A.svg, "svg").createSVGRect
        }, $.inlinesvg = function() {
            var t = e.createElement("div");
            return t.innerHTML = "<svg/>", (t.firstChild && t.firstChild.namespaceURI) == A.svg
        }, $.smil = function() {
            return !!e.createElementNS && /SVGAnimate/.test(w.call(e.createElementNS(A.svg, "animate")))
        }, $.svgclippaths = function() {
            return !!e.createElementNS && /SVGClipPath/.test(w.call(e.createElementNS(A.svg, "clipPath")))
        };
        for (var H in $) h($, H) && (u = H.toLowerCase(), p[u] = $[H](), j.push((p[u] ? "" : "no-") + u));
        return p.input || d(), p.addTest = function(t, e) {
                if ("object" == typeof t)
                    for (var i in t) h(t, i) && p.addTest(i, t[i]);
                else {
                    if (t = t.toLowerCase(), p[t] !== n) return p;
                    e = "function" == typeof e ? e() : e, "undefined" != typeof g && g && (m.className += " " + (e ? "" : "no-") + t), p[t] = e
                }
                return p
            }, i(""), y = b = null,
            function(t, e) {
                function n(t, e) {
                    var n = t.createElement("p"),
                        i = t.getElementsByTagName("head")[0] || t.documentElement;
                    return n.innerHTML = "x<style>" + e + "</style>", i.insertBefore(n.lastChild, i.firstChild)
                }

                function i() {
                    var t = y.elements;
                    return "string" == typeof t ? t.split(" ") : t
                }

                function s(t) {
                    var e = v[t[g]];
                    return e || (e = {}, m++, t[g] = m, v[m] = e), e
                }

                function a(t, n, i) {
                    if (n || (n = e), d) return n.createElement(t);
                    i || (i = s(n));
                    var a;
                    return a = i.cache[t] ? i.cache[t].cloneNode() : p.test(t) ? (i.cache[t] = i.createElem(t)).cloneNode() : i.createElem(t), !a.canHaveChildren || f.test(t) || a.tagUrn ? a : i.frag.appendChild(a)
                }

                function o(t, n) {
                    if (t || (t = e), d) return t.createDocumentFragment();
                    n = n || s(t);
                    for (var a = n.frag.cloneNode(), o = 0, r = i(), l = r.length; l > o; o++) a.createElement(r[o]);
                    return a
                }

                function r(t, e) {
                    e.cache || (e.cache = {}, e.createElem = t.createElement, e.createFrag = t.createDocumentFragment, e.frag = e.createFrag()), t.createElement = function(n) {
                        return y.shivMethods ? a(n, t, e) : e.createElem(n)
                    }, t.createDocumentFragment = Function("h,f", "return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&(" + i().join().replace(/[\w\-]+/g, function(t) {
                        return e.createElem(t), e.frag.createElement(t), 'c("' + t + '")'
                    }) + ");return n}")(y, e.frag)
                }

                function l(t) {
                    t || (t = e);
                    var i = s(t);
                    return !y.shivCSS || c || i.hasCSS || (i.hasCSS = !!n(t, "article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")), d || r(t, i), t
                }
                var c, d, u = "3.7.0",
                    h = t.html5 || {},
                    f = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,
                    p = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,
                    g = "_html5shiv",
                    m = 0,
                    v = {};
                ! function() {
                    try {
                        var t = e.createElement("a");
                        t.innerHTML = "<xyz></xyz>", c = "hidden" in t, d = 1 == t.childNodes.length || function() {
                            e.createElement("a");
                            var t = e.createDocumentFragment();
                            return "undefined" == typeof t.cloneNode || "undefined" == typeof t.createDocumentFragment || "undefined" == typeof t.createElement
                        }()
                    } catch (n) {
                        c = !0, d = !0
                    }
                }();
                var y = {
                    elements: h.elements || "abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",
                    version: u,
                    shivCSS: h.shivCSS !== !1,
                    supportsUnknownElements: d,
                    shivMethods: h.shivMethods !== !1,
                    type: "default",
                    shivDocument: l,
                    createElement: a,
                    createDocumentFragment: o
                };
                t.html5 = y, l(e)
            }(this, e), p._version = f, p._prefixes = C, p._domPrefixes = T, p._cssomPrefixes = S, p.mq = P, p.hasEvent = N, p.testProp = function(t) {
                return r([t])
            }, p.testAllProps = c, p.testStyles = D, p.prefixed = function(t, e, n) {
                return e ? c(t, e, n) : c(t, "pfx")
            }, m.className = m.className.replace(/(^|\s)no-js(\s|$)/, "$1$2") + (g ? " js " + j.join(" ") : ""), p
    }(this, this.document), ! function(t, e) {
        "object" == typeof module && "object" == typeof module.exports ? module.exports = t.document ? e(t, !0) : function(t) {
            if (!t.document) throw new Error("jQuery requires a window with a document");
            return e(t)
        } : e(t)
    }("undefined" != typeof window ? window : this, function(t, e) {
        function n(t) {
            var e = t.length,
                n = tt.type(t);
            return "function" === n || tt.isWindow(t) ? !1 : 1 === t.nodeType && e ? !0 : "array" === n || 0 === e || "number" == typeof e && e > 0 && e - 1 in t
        }

        function i(t, e, n) {
            if (tt.isFunction(e)) return tt.grep(t, function(t, i) {
                return !!e.call(t, i, t) !== n
            });
            if (e.nodeType) return tt.grep(t, function(t) {
                return t === e !== n
            });
            if ("string" == typeof e) {
                if (rt.test(e)) return tt.filter(e, t, n);
                e = tt.filter(e, t)
            }
            return tt.grep(t, function(t) {
                return X.call(e, t) >= 0 !== n
            })
        }

        function s(t, e) {
            for (;
                (t = t[e]) && 1 !== t.nodeType;);
            return t
        }

        function a(t) {
            var e = pt[t] = {};
            return tt.each(t.match(ft) || [], function(t, n) {
                e[n] = !0
            }), e
        }

        function o() {
            J.removeEventListener("DOMContentLoaded", o, !1), t.removeEventListener("load", o, !1), tt.ready()
        }

        function r() {
            Object.defineProperty(this.cache = {}, 0, {
                get: function() {
                    return {}
                }
            }), this.expando = tt.expando + Math.random()
        }

        function l(t, e, n) {
            var i;
            if (void 0 === n && 1 === t.nodeType)
                if (i = "data-" + e.replace(bt, "-$1").toLowerCase(), n = t.getAttribute(i), "string" == typeof n) {
                    try {
                        n = "true" === n ? !0 : "false" === n ? !1 : "null" === n ? null : +n + "" === n ? +n : _t.test(n) ? tt.parseJSON(n) : n
                    } catch (s) {}
                    yt.set(t, e, n)
                } else n = void 0;
            return n
        }

        function c() {
            return !0
        }

        function d() {
            return !1
        }

        function u() {
            try {
                return J.activeElement
            } catch (t) {}
        }

        function h(t, e) {
            return tt.nodeName(t, "table") && tt.nodeName(11 !== e.nodeType ? e : e.firstChild, "tr") ? t.getElementsByTagName("tbody")[0] || t.appendChild(t.ownerDocument.createElement("tbody")) : t
        }

        function f(t) {
            return t.type = (null !== t.getAttribute("type")) + "/" + t.type, t
        }

        function p(t) {
            var e = Mt.exec(t.type);
            return e ? t.type = e[1] : t.removeAttribute("type"), t
        }

        function g(t, e) {
            for (var n = 0, i = t.length; i > n; n++) vt.set(t[n], "globalEval", !e || vt.get(e[n], "globalEval"))
        }

        function m(t, e) {
            var n, i, s, a, o, r, l, c;
            if (1 === e.nodeType) {
                if (vt.hasData(t) && (a = vt.access(t), o = vt.set(e, a), c = a.events)) {
                    delete o.handle, o.events = {};
                    for (s in c)
                        for (n = 0, i = c[s].length; i > n; n++) tt.event.add(e, s, c[s][n])
                }
                yt.hasData(t) && (r = yt.access(t), l = tt.extend({}, r), yt.set(e, l))
            }
        }

        function v(t, e) {
            var n = t.getElementsByTagName ? t.getElementsByTagName(e || "*") : t.querySelectorAll ? t.querySelectorAll(e || "*") : [];
            return void 0 === e || e && tt.nodeName(t, e) ? tt.merge([t], n) : n
        }

        function y(t, e) {
            var n = e.nodeName.toLowerCase();
            "input" === n && kt.test(t.type) ? e.checked = t.checked : ("input" === n || "textarea" === n) && (e.defaultValue = t.defaultValue)
        }

        function _(e, n) {
            var i = tt(n.createElement(e)).appendTo(n.body),
                s = t.getDefaultComputedStyle ? t.getDefaultComputedStyle(i[0]).display : tt.css(i[0], "display");
            return i.detach(), s
        }

        function b(t) {
            var e = J,
                n = Wt[t];
            return n || (n = _(t, e), "none" !== n && n || (qt = (qt || tt("<iframe frameborder='0' width='0' height='0'/>")).appendTo(e.documentElement), e = qt[0].contentDocument, e.write(), e.close(), n = _(t, e), qt.detach()), Wt[t] = n), n
        }

        function x(t, e, n) {
            var i, s, a, o, r = t.style;
            return n = n || Rt(t), n && (o = n.getPropertyValue(e) || n[e]), n && ("" !== o || tt.contains(t.ownerDocument, t) || (o = tt.style(t, e)), Lt.test(o) && Ot.test(e) && (i = r.width, s = r.minWidth, a = r.maxWidth, r.minWidth = r.maxWidth = r.width = o, o = n.width, r.width = i, r.minWidth = s, r.maxWidth = a)), void 0 !== o ? o + "" : o
        }

        function w(t, e) {
            return {
                get: function() {
                    return t() ? void delete this.get : (this.get = e).apply(this, arguments)
                }
            }
        }

        function C(t, e) {
            if (e in t) return e;
            for (var n = e[0].toUpperCase() + e.slice(1), i = e, s = Yt.length; s--;)
                if (e = Yt[s] + n, e in t) return e;
            return i
        }

        function k(t, e, n) {
            var i = Qt.exec(e);
            return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : e
        }

        function S(t, e, n, i, s) {
            for (var a = n === (i ? "border" : "content") ? 4 : "width" === e ? 1 : 0, o = 0; 4 > a; a += 2) "margin" === n && (o += tt.css(t, n + wt[a], !0, s)), i ? ("content" === n && (o -= tt.css(t, "padding" + wt[a], !0, s)), "margin" !== n && (o -= tt.css(t, "border" + wt[a] + "Width", !0, s))) : (o += tt.css(t, "padding" + wt[a], !0, s), "padding" !== n && (o += tt.css(t, "border" + wt[a] + "Width", !0, s)));
            return o
        }

        function T(t, e, n) {
            var i = !0,
                s = "width" === e ? t.offsetWidth : t.offsetHeight,
                a = Rt(t),
                o = "border-box" === tt.css(t, "boxSizing", !1, a);
            if (0 >= s || null == s) {
                if (s = x(t, e, a), (0 > s || null == s) && (s = t.style[e]), Lt.test(s)) return s;
                i = o && (G.boxSizingReliable() || s === t.style[e]), s = parseFloat(s) || 0
            }
            return s + S(t, e, n || (o ? "border" : "content"), i, a) + "px"
        }

        function A(t, e) {
            for (var n, i, s, a = [], o = 0, r = t.length; r > o; o++) i = t[o], i.style && (a[o] = vt.get(i, "olddisplay"), n = i.style.display, e ? (a[o] || "none" !== n || (i.style.display = ""), "" === i.style.display && Ct(i) && (a[o] = vt.access(i, "olddisplay", b(i.nodeName)))) : a[o] || (s = Ct(i), (n && "none" !== n || !s) && vt.set(i, "olddisplay", s ? n : tt.css(i, "display"))));
            for (o = 0; r > o; o++) i = t[o], i.style && (e && "none" !== i.style.display && "" !== i.style.display || (i.style.display = e ? a[o] || "" : "none"));
            return t
        }

        function $(t, e, n, i, s) {
            return new $.prototype.init(t, e, n, i, s)
        }

        function F() {
            return setTimeout(function() {
                Ut = void 0
            }), Ut = tt.now()
        }

        function I(t, e) {
            var n, i = 0,
                s = {
                    height: t
                };
            for (e = e ? 1 : 0; 4 > i; i += 2 - e) n = wt[i], s["margin" + n] = s["padding" + n] = t;
            return e && (s.opacity = s.width = t), s
        }

        function j(t, e, n) {
            for (var i, s = (ne[e] || []).concat(ne["*"]), a = 0, o = s.length; o > a; a++)
                if (i = s[a].call(n, e, t)) return i
        }

        function E(t, e, n) {
            var i, s, a, o, r, l, c, d = this,
                u = {},
                h = t.style,
                f = t.nodeType && Ct(t),
                p = vt.get(t, "fxshow");
            n.queue || (r = tt._queueHooks(t, "fx"), null == r.unqueued && (r.unqueued = 0, l = r.empty.fire, r.empty.fire = function() {
                r.unqueued || l()
            }), r.unqueued++, d.always(function() {
                d.always(function() {
                    r.unqueued--, tt.queue(t, "fx").length || r.empty.fire()
                })
            })), 1 === t.nodeType && ("height" in e || "width" in e) && (n.overflow = [h.overflow, h.overflowX, h.overflowY], c = tt.css(t, "display"), "none" === c && (c = b(t.nodeName)), "inline" === c && "none" === tt.css(t, "float") && (h.display = "inline-block")), n.overflow && (h.overflow = "hidden", d.always(function() {
                h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
            }));
            for (i in e)
                if (s = e[i], Jt.exec(s)) {
                    if (delete e[i], a = a || "toggle" === s, s === (f ? "hide" : "show")) {
                        if ("show" !== s || !p || void 0 === p[i]) continue;
                        f = !0
                    }
                    u[i] = p && p[i] || tt.style(t, i)
                }
            if (!tt.isEmptyObject(u)) {
                p ? "hidden" in p && (f = p.hidden) : p = vt.access(t, "fxshow", {}), a && (p.hidden = !f), f ? tt(t).show() : d.done(function() {
                    tt(t).hide()
                }), d.done(function() {
                    var e;
                    vt.remove(t, "fxshow");
                    for (e in u) tt.style(t, e, u[e])
                });
                for (i in u) o = j(f ? p[i] : 0, i, d), i in p || (p[i] = o.start, f && (o.end = o.start, o.start = "width" === i || "height" === i ? 1 : 0))
            }
        }

        function D(t, e) {
            var n, i, s, a, o;
            for (n in t)
                if (i = tt.camelCase(n), s = e[i], a = t[n], tt.isArray(a) && (s = a[1], a = t[n] = a[0]), n !== i && (t[i] = a, delete t[n]), o = tt.cssHooks[i], o && "expand" in o) {
                    a = o.expand(a), delete t[i];
                    for (n in a) n in t || (t[n] = a[n], e[n] = s)
                } else e[i] = s
        }

        function P(t, e, n) {
            var i, s, a = 0,
                o = ee.length,
                r = tt.Deferred().always(function() {
                    delete l.elem
                }),
                l = function() {
                    if (s) return !1;
                    for (var e = Ut || F(), n = Math.max(0, c.startTime + c.duration - e), i = n / c.duration || 0, a = 1 - i, o = 0, l = c.tweens.length; l > o; o++) c.tweens[o].run(a);
                    return r.notifyWith(t, [c, a, n]), 1 > a && l ? n : (r.resolveWith(t, [c]), !1)
                },
                c = r.promise({
                    elem: t,
                    props: tt.extend({}, e),
                    opts: tt.extend(!0, {
                        specialEasing: {}
                    }, n),
                    originalProperties: e,
                    originalOptions: n,
                    startTime: Ut || F(),
                    duration: n.duration,
                    tweens: [],
                    createTween: function(e, n) {
                        var i = tt.Tween(t, c.opts, e, n, c.opts.specialEasing[e] || c.opts.easing);
                        return c.tweens.push(i), i
                    },
                    stop: function(e) {
                        var n = 0,
                            i = e ? c.tweens.length : 0;
                        if (s) return this;
                        for (s = !0; i > n; n++) c.tweens[n].run(1);
                        return e ? r.resolveWith(t, [c, e]) : r.rejectWith(t, [c, e]), this
                    }
                }),
                d = c.props;
            for (D(d, c.opts.specialEasing); o > a; a++)
                if (i = ee[a].call(c, t, d, c.opts)) return i;
            return tt.map(d, j, c), tt.isFunction(c.opts.start) && c.opts.start.call(t, c), tt.fx.timer(tt.extend(l, {
                elem: t,
                anim: c,
                queue: c.opts.queue
            })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always)
        }

        function N(t) {
            return function(e, n) {
                "string" != typeof e && (n = e, e = "*");
                var i, s = 0,
                    a = e.toLowerCase().match(ft) || [];
                if (tt.isFunction(n))
                    for (; i = a[s++];) "+" === i[0] ? (i = i.slice(1) || "*", (t[i] = t[i] || []).unshift(n)) : (t[i] = t[i] || []).push(n)
            }
        }

        function M(t, e, n, i) {
            function s(r) {
                var l;
                return a[r] = !0, tt.each(t[r] || [], function(t, r) {
                    var c = r(e, n, i);
                    return "string" != typeof c || o || a[c] ? o ? !(l = c) : void 0 : (e.dataTypes.unshift(c), s(c), !1)
                }), l
            }
            var a = {},
                o = t === xe;
            return s(e.dataTypes[0]) || !a["*"] && s("*")
        }

        function H(t, e) {
            var n, i, s = tt.ajaxSettings.flatOptions || {};
            for (n in e) void 0 !== e[n] && ((s[n] ? t : i || (i = {}))[n] = e[n]);
            return i && tt.extend(!0, t, i), t
        }

        function z(t, e, n) {
            for (var i, s, a, o, r = t.contents, l = t.dataTypes;
                "*" === l[0];) l.shift(), void 0 === i && (i = t.mimeType || e.getResponseHeader("Content-Type"));
            if (i)
                for (s in r)
                    if (r[s] && r[s].test(i)) {
                        l.unshift(s);
                        break
                    }
            if (l[0] in n) a = l[0];
            else {
                for (s in n) {
                    if (!l[0] || t.converters[s + " " + l[0]]) {
                        a = s;
                        break
                    }
                    o || (o = s)
                }
                a = a || o
            }
            return a ? (a !== l[0] && l.unshift(a), n[a]) : void 0
        }

        function q(t, e, n, i) {
            var s, a, o, r, l, c = {},
                d = t.dataTypes.slice();
            if (d[1])
                for (o in t.converters) c[o.toLowerCase()] = t.converters[o];
            for (a = d.shift(); a;)
                if (t.responseFields[a] && (n[t.responseFields[a]] = e), !l && i && t.dataFilter && (e = t.dataFilter(e, t.dataType)), l = a, a = d.shift())
                    if ("*" === a) a = l;
                    else if ("*" !== l && l !== a) {
                if (o = c[l + " " + a] || c["* " + a], !o)
                    for (s in c)
                        if (r = s.split(" "), r[1] === a && (o = c[l + " " + r[0]] || c["* " + r[0]])) {
                            o === !0 ? o = c[s] : c[s] !== !0 && (a = r[0], d.unshift(r[1]));
                            break
                        }
                if (o !== !0)
                    if (o && t["throws"]) e = o(e);
                    else try {
                        e = o(e)
                    } catch (u) {
                        return {
                            state: "parsererror",
                            error: o ? u : "No conversion from " + l + " to " + a
                        }
                    }
            }
            return {
                state: "success",
                data: e
            }
        }

        function W(t, e, n, i) {
            var s;
            if (tt.isArray(e)) tt.each(e, function(e, s) {
                n || Se.test(t) ? i(t, s) : W(t + "[" + ("object" == typeof s ? e : "") + "]", s, n, i)
            });
            else if (n || "object" !== tt.type(e)) i(t, e);
            else
                for (s in e) W(t + "[" + s + "]", e[s], n, i)
        }

        function O(t) {
            return tt.isWindow(t) ? t : 9 === t.nodeType && t.defaultView
        }
        var L = [],
            R = L.slice,
            B = L.concat,
            Q = L.push,
            X = L.indexOf,
            Z = {},
            V = Z.toString,
            Y = Z.hasOwnProperty,
            U = "".trim,
            G = {},
            J = t.document,
            K = "2.1.0",
            tt = function(t, e) {
                return new tt.fn.init(t, e)
            },
            et = /^-ms-/,
            nt = /-([\da-z])/gi,
            it = function(t, e) {
                return e.toUpperCase()
            };
        tt.fn = tt.prototype = {
            jquery: K,
            constructor: tt,
            selector: "",
            length: 0,
            toArray: function() {
                return R.call(this)
            },
            get: function(t) {
                return null != t ? 0 > t ? this[t + this.length] : this[t] : R.call(this)
            },
            pushStack: function(t) {
                var e = tt.merge(this.constructor(), t);
                return e.prevObject = this, e.context = this.context, e
            },
            each: function(t, e) {
                return tt.each(this, t, e)
            },
            map: function(t) {
                return this.pushStack(tt.map(this, function(e, n) {
                    return t.call(e, n, e)
                }))
            },
            slice: function() {
                return this.pushStack(R.apply(this, arguments))
            },
            first: function() {
                return this.eq(0)
            },
            last: function() {
                return this.eq(-1)
            },
            eq: function(t) {
                var e = this.length,
                    n = +t + (0 > t ? e : 0);
                return this.pushStack(n >= 0 && e > n ? [this[n]] : [])
            },
            end: function() {
                return this.prevObject || this.constructor(null)
            },
            push: Q,
            sort: L.sort,
            splice: L.splice
        }, tt.extend = tt.fn.extend = function() {
            var t, e, n, i, s, a, o = arguments[0] || {},
                r = 1,
                l = arguments.length,
                c = !1;
            for ("boolean" == typeof o && (c = o, o = arguments[r] || {}, r++), "object" == typeof o || tt.isFunction(o) || (o = {}), r === l && (o = this, r--); l > r; r++)
                if (null != (t = arguments[r]))
                    for (e in t) n = o[e], i = t[e], o !== i && (c && i && (tt.isPlainObject(i) || (s = tt.isArray(i))) ? (s ? (s = !1, a = n && tt.isArray(n) ? n : []) : a = n && tt.isPlainObject(n) ? n : {}, o[e] = tt.extend(c, a, i)) : void 0 !== i && (o[e] = i));
            return o
        }, tt.extend({
            expando: "jQuery" + (K + Math.random()).replace(/\D/g, ""),
            isReady: !0,
            error: function(t) {
                throw new Error(t)
            },
            noop: function() {},
            isFunction: function(t) {
                return "function" === tt.type(t)
            },
            isArray: Array.isArray,
            isWindow: function(t) {
                return null != t && t === t.window
            },
            isNumeric: function(t) {
                return t - parseFloat(t) >= 0
            },
            isPlainObject: function(t) {
                if ("object" !== tt.type(t) || t.nodeType || tt.isWindow(t)) return !1;
                try {
                    if (t.constructor && !Y.call(t.constructor.prototype, "isPrototypeOf")) return !1
                } catch (e) {
                    return !1
                }
                return !0
            },
            isEmptyObject: function(t) {
                var e;
                for (e in t) return !1;
                return !0
            },
            type: function(t) {
                return null == t ? t + "" : "object" == typeof t || "function" == typeof t ? Z[V.call(t)] || "object" : typeof t
            },
            globalEval: function(t) {
                var e, n = eval;
                t = tt.trim(t), t && (1 === t.indexOf("use strict") ? (e = J.createElement("script"), e.text = t, J.head.appendChild(e).parentNode.removeChild(e)) : n(t))
            },
            camelCase: function(t) {
                return t.replace(et, "ms-").replace(nt, it)
            },
            nodeName: function(t, e) {
                return t.nodeName && t.nodeName.toLowerCase() === e.toLowerCase()
            },
            each: function(t, e, i) {
                var s, a = 0,
                    o = t.length,
                    r = n(t);
                if (i) {
                    if (r)
                        for (; o > a && (s = e.apply(t[a], i), s !== !1); a++);
                    else
                        for (a in t)
                            if (s = e.apply(t[a], i), s === !1) break
                } else if (r)
                    for (; o > a && (s = e.call(t[a], a, t[a]), s !== !1); a++);
                else
                    for (a in t)
                        if (s = e.call(t[a], a, t[a]), s === !1) break; return t
            },
            trim: function(t) {
                return null == t ? "" : U.call(t)
            },
            makeArray: function(t, e) {
                var i = e || [];
                return null != t && (n(Object(t)) ? tt.merge(i, "string" == typeof t ? [t] : t) : Q.call(i, t)), i
            },
            inArray: function(t, e, n) {
                return null == e ? -1 : X.call(e, t, n)
            },
            merge: function(t, e) {
                for (var n = +e.length, i = 0, s = t.length; n > i; i++) t[s++] = e[i];
                return t.length = s, t
            },
            grep: function(t, e, n) {
                for (var i, s = [], a = 0, o = t.length, r = !n; o > a; a++) i = !e(t[a], a), i !== r && s.push(t[a]);
                return s
            },
            map: function(t, e, i) {
                var s, a = 0,
                    o = t.length,
                    r = n(t),
                    l = [];
                if (r)
                    for (; o > a; a++) s = e(t[a], a, i), null != s && l.push(s);
                else
                    for (a in t) s = e(t[a], a, i), null != s && l.push(s);
                return B.apply([], l)
            },
            guid: 1,
            proxy: function(t, e) {
                var n, i, s;
                return "string" == typeof e && (n = t[e], e = t, t = n), tt.isFunction(t) ? (i = R.call(arguments, 2), s = function() {
                    return t.apply(e || this, i.concat(R.call(arguments)))
                }, s.guid = t.guid = t.guid || tt.guid++, s) : void 0
            },
            now: Date.now,
            support: G
        }), tt.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(t, e) {
            Z["[object " + e + "]"] = e.toLowerCase()
        });
        var st = function(t) {
            function e(t, e, n, i) {
                var s, a, o, r, l, c, u, p, g, m;
                if ((e ? e.ownerDocument || e : W) !== E && j(e), e = e || E, n = n || [], !t || "string" != typeof t) return n;
                if (1 !== (r = e.nodeType) && 9 !== r) return [];
                if (P && !i) {
                    if (s = yt.exec(t))
                        if (o = s[1]) {
                            if (9 === r) {
                                if (a = e.getElementById(o), !a || !a.parentNode) return n;
                                if (a.id === o) return n.push(a), n
                            } else if (e.ownerDocument && (a = e.ownerDocument.getElementById(o)) && z(e, a) && a.id === o) return n.push(a), n
                        } else {
                            if (s[2]) return K.apply(n, e.getElementsByTagName(t)), n;
                            if ((o = s[3]) && C.getElementsByClassName && e.getElementsByClassName) return K.apply(n, e.getElementsByClassName(o)), n
                        }
                    if (C.qsa && (!N || !N.test(t))) {
                        if (p = u = q, g = e, m = 9 === r && t, 1 === r && "object" !== e.nodeName.toLowerCase()) {
                            for (c = h(t), (u = e.getAttribute("id")) ? p = u.replace(bt, "\\$&") : e.setAttribute("id", p), p = "[id='" + p + "'] ", l = c.length; l--;) c[l] = p + f(c[l]);
                            g = _t.test(t) && d(e.parentNode) || e, m = c.join(",")
                        }
                        if (m) try {
                            return K.apply(n, g.querySelectorAll(m)), n
                        } catch (v) {} finally {
                            u || e.removeAttribute("id")
                        }
                    }
                }
                return x(t.replace(lt, "$1"), e, n, i)
            }

            function n() {
                function t(n, i) {
                    return e.push(n + " ") > k.cacheLength && delete t[e.shift()], t[n + " "] = i
                }
                var e = [];
                return t
            }

            function i(t) {
                return t[q] = !0, t
            }

            function s(t) {
                var e = E.createElement("div");
                try {
                    return !!t(e)
                } catch (n) {
                    return !1
                } finally {
                    e.parentNode && e.parentNode.removeChild(e), e = null
                }
            }

            function a(t, e) {
                for (var n = t.split("|"), i = t.length; i--;) k.attrHandle[n[i]] = e
            }

            function o(t, e) {
                var n = e && t,
                    i = n && 1 === t.nodeType && 1 === e.nodeType && (~e.sourceIndex || V) - (~t.sourceIndex || V);
                if (i) return i;
                if (n)
                    for (; n = n.nextSibling;)
                        if (n === e) return -1;
                return t ? 1 : -1
            }

            function r(t) {
                return function(e) {
                    var n = e.nodeName.toLowerCase();
                    return "input" === n && e.type === t
                }
            }

            function l(t) {
                return function(e) {
                    var n = e.nodeName.toLowerCase();
                    return ("input" === n || "button" === n) && e.type === t
                }
            }

            function c(t) {
                return i(function(e) {
                    return e = +e, i(function(n, i) {
                        for (var s, a = t([], n.length, e), o = a.length; o--;) n[s = a[o]] && (n[s] = !(i[s] = n[s]))
                    })
                })
            }

            function d(t) {
                return t && typeof t.getElementsByTagName !== Z && t
            }

            function u() {}

            function h(t, n) {
                var i, s, a, o, r, l, c, d = B[t + " "];
                if (d) return n ? 0 : d.slice(0);
                for (r = t, l = [], c = k.preFilter; r;) {
                    (!i || (s = ct.exec(r))) && (s && (r = r.slice(s[0].length) || r), l.push(a = [])), i = !1, (s = dt.exec(r)) && (i = s.shift(), a.push({
                        value: i,
                        type: s[0].replace(lt, " ")
                    }), r = r.slice(i.length));
                    for (o in k.filter) !(s = pt[o].exec(r)) || c[o] && !(s = c[o](s)) || (i = s.shift(), a.push({
                        value: i,
                        type: o,
                        matches: s
                    }), r = r.slice(i.length));
                    if (!i) break
                }
                return n ? r.length : r ? e.error(t) : B(t, l).slice(0)
            }

            function f(t) {
                for (var e = 0, n = t.length, i = ""; n > e; e++) i += t[e].value;
                return i
            }

            function p(t, e, n) {
                var i = e.dir,
                    s = n && "parentNode" === i,
                    a = L++;
                return e.first ? function(e, n, a) {
                    for (; e = e[i];)
                        if (1 === e.nodeType || s) return t(e, n, a)
                } : function(e, n, o) {
                    var r, l, c = [O, a];
                    if (o) {
                        for (; e = e[i];)
                            if ((1 === e.nodeType || s) && t(e, n, o)) return !0
                    } else
                        for (; e = e[i];)
                            if (1 === e.nodeType || s) {
                                if (l = e[q] || (e[q] = {}), (r = l[i]) && r[0] === O && r[1] === a) return c[2] = r[2];
                                if (l[i] = c, c[2] = t(e, n, o)) return !0
                            }
                }
            }

            function g(t) {
                return t.length > 1 ? function(e, n, i) {
                    for (var s = t.length; s--;)
                        if (!t[s](e, n, i)) return !1;
                    return !0
                } : t[0]
            }

            function m(t, e, n, i, s) {
                for (var a, o = [], r = 0, l = t.length, c = null != e; l > r; r++)(a = t[r]) && (!n || n(a, i, s)) && (o.push(a), c && e.push(r));
                return o
            }

            function v(t, e, n, s, a, o) {
                return s && !s[q] && (s = v(s)), a && !a[q] && (a = v(a, o)), i(function(i, o, r, l) {
                    var c, d, u, h = [],
                        f = [],
                        p = o.length,
                        g = i || b(e || "*", r.nodeType ? [r] : r, []),
                        v = !t || !i && e ? g : m(g, h, t, r, l),
                        y = n ? a || (i ? t : p || s) ? [] : o : v;
                    if (n && n(v, y, r, l), s)
                        for (c = m(y, f), s(c, [], r, l), d = c.length; d--;)(u = c[d]) && (y[f[d]] = !(v[f[d]] = u));
                    if (i) {
                        if (a || t) {
                            if (a) {
                                for (c = [], d = y.length; d--;)(u = y[d]) && c.push(v[d] = u);
                                a(null, y = [], c, l)
                            }
                            for (d = y.length; d--;)(u = y[d]) && (c = a ? et.call(i, u) : h[d]) > -1 && (i[c] = !(o[c] = u))
                        }
                    } else y = m(y === o ? y.splice(p, y.length) : y), a ? a(null, o, y, l) : K.apply(o, y)
                })
            }

            function y(t) {
                for (var e, n, i, s = t.length, a = k.relative[t[0].type], o = a || k.relative[" "], r = a ? 1 : 0, l = p(function(t) {
                        return t === e
                    }, o, !0), c = p(function(t) {
                        return et.call(e, t) > -1
                    }, o, !0), d = [function(t, n, i) {
                        return !a && (i || n !== $) || ((e = n).nodeType ? l(t, n, i) : c(t, n, i))
                    }]; s > r; r++)
                    if (n = k.relative[t[r].type]) d = [p(g(d), n)];
                    else {
                        if (n = k.filter[t[r].type].apply(null, t[r].matches), n[q]) {
                            for (i = ++r; s > i && !k.relative[t[i].type]; i++);
                            return v(r > 1 && g(d), r > 1 && f(t.slice(0, r - 1).concat({
                                value: " " === t[r - 2].type ? "*" : ""
                            })).replace(lt, "$1"), n, i > r && y(t.slice(r, i)), s > i && y(t = t.slice(i)), s > i && f(t))
                        }
                        d.push(n)
                    }
                return g(d)
            }

            function _(t, n) {
                var s = n.length > 0,
                    a = t.length > 0,
                    o = function(i, o, r, l, c) {
                        var d, u, h, f = 0,
                            p = "0",
                            g = i && [],
                            v = [],
                            y = $,
                            _ = i || a && k.find.TAG("*", c),
                            b = O += null == y ? 1 : Math.random() || .1,
                            x = _.length;
                        for (c && ($ = o !== E && o); p !== x && null != (d = _[p]); p++) {
                            if (a && d) {
                                for (u = 0; h = t[u++];)
                                    if (h(d, o, r)) {
                                        l.push(d);
                                        break
                                    }
                                c && (O = b)
                            }
                            s && ((d = !h && d) && f--, i && g.push(d))
                        }
                        if (f += p, s && p !== f) {
                            for (u = 0; h = n[u++];) h(g, v, o, r);
                            if (i) {
                                if (f > 0)
                                    for (; p--;) g[p] || v[p] || (v[p] = G.call(l));
                                v = m(v)
                            }
                            K.apply(l, v), c && !i && v.length > 0 && f + n.length > 1 && e.uniqueSort(l)
                        }
                        return c && (O = b, $ = y), g
                    };
                return s ? i(o) : o
            }

            function b(t, n, i) {
                for (var s = 0, a = n.length; a > s; s++) e(t, n[s], i);
                return i
            }

            function x(t, e, n, i) {
                var s, a, o, r, l, c = h(t);
                if (!i && 1 === c.length) {
                    if (a = c[0] = c[0].slice(0), a.length > 2 && "ID" === (o = a[0]).type && C.getById && 9 === e.nodeType && P && k.relative[a[1].type]) {
                        if (e = (k.find.ID(o.matches[0].replace(xt, wt), e) || [])[0], !e) return n;
                        t = t.slice(a.shift().value.length)
                    }
                    for (s = pt.needsContext.test(t) ? 0 : a.length; s-- && (o = a[s], !k.relative[r = o.type]);)
                        if ((l = k.find[r]) && (i = l(o.matches[0].replace(xt, wt), _t.test(a[0].type) && d(e.parentNode) || e))) {
                            if (a.splice(s, 1), t = i.length && f(a), !t) return K.apply(n, i), n;
                            break
                        }
                }
                return A(t, c)(i, e, !P, n, _t.test(t) && d(e.parentNode) || e), n
            }
            var w, C, k, S, T, A, $, F, I, j, E, D, P, N, M, H, z, q = "sizzle" + -new Date,
                W = t.document,
                O = 0,
                L = 0,
                R = n(),
                B = n(),
                Q = n(),
                X = function(t, e) {
                    return t === e && (I = !0), 0
                },
                Z = "undefined",
                V = 1 << 31,
                Y = {}.hasOwnProperty,
                U = [],
                G = U.pop,
                J = U.push,
                K = U.push,
                tt = U.slice,
                et = U.indexOf || function(t) {
                    for (var e = 0, n = this.length; n > e; e++)
                        if (this[e] === t) return e;
                    return -1
                },
                nt = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
                it = "[\\x20\\t\\r\\n\\f]",
                st = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
                at = st.replace("w", "w#"),
                ot = "\\[" + it + "*(" + st + ")" + it + "*(?:([*^$|!~]?=)" + it + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + at + ")|)|)" + it + "*\\]",
                rt = ":(" + st + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + ot.replace(3, 8) + ")*)|.*)\\)|)",
                lt = new RegExp("^" + it + "+|((?:^|[^\\\\])(?:\\\\.)*)" + it + "+$", "g"),
                ct = new RegExp("^" + it + "*," + it + "*"),
                dt = new RegExp("^" + it + "*([>+~]|" + it + ")" + it + "*"),
                ut = new RegExp("=" + it + "*([^\\]'\"]*?)" + it + "*\\]", "g"),
                ht = new RegExp(rt),
                ft = new RegExp("^" + at + "$"),
                pt = {
                    ID: new RegExp("^#(" + st + ")"),
                    CLASS: new RegExp("^\\.(" + st + ")"),
                    TAG: new RegExp("^(" + st.replace("w", "w*") + ")"),
                    ATTR: new RegExp("^" + ot),
                    PSEUDO: new RegExp("^" + rt),
                    CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + it + "*(even|odd|(([+-]|)(\\d*)n|)" + it + "*(?:([+-]|)" + it + "*(\\d+)|))" + it + "*\\)|)", "i"),
                    bool: new RegExp("^(?:" + nt + ")$", "i"),
                    needsContext: new RegExp("^" + it + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + it + "*((?:-\\d)?\\d*)" + it + "*\\)|)(?=[^-]|$)", "i")
                },
                gt = /^(?:input|select|textarea|button)$/i,
                mt = /^h\d$/i,
                vt = /^[^{]+\{\s*\[native \w/,
                yt = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
                _t = /[+~]/,
                bt = /'|\\/g,
                xt = new RegExp("\\\\([\\da-f]{1,6}" + it + "?|(" + it + ")|.)", "ig"),
                wt = function(t, e, n) {
                    var i = "0x" + e - 65536;
                    return i !== i || n ? e : 0 > i ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
                };
            try {
                K.apply(U = tt.call(W.childNodes), W.childNodes), U[W.childNodes.length].nodeType
            } catch (Ct) {
                K = {
                    apply: U.length ? function(t, e) {
                        J.apply(t, tt.call(e))
                    } : function(t, e) {
                        for (var n = t.length, i = 0; t[n++] = e[i++];);
                        t.length = n - 1
                    }
                }
            }
            C = e.support = {}, T = e.isXML = function(t) {
                var e = t && (t.ownerDocument || t).documentElement;
                return e ? "HTML" !== e.nodeName : !1
            }, j = e.setDocument = function(t) {
                var e, n = t ? t.ownerDocument || t : W,
                    i = n.defaultView;
                return n !== E && 9 === n.nodeType && n.documentElement ? (E = n, D = n.documentElement, P = !T(n), i && i !== i.top && (i.addEventListener ? i.addEventListener("unload", function() {
                    j()
                }, !1) : i.attachEvent && i.attachEvent("onunload", function() {
                    j()
                })), C.attributes = s(function(t) {
                    return t.className = "i", !t.getAttribute("className")
                }), C.getElementsByTagName = s(function(t) {
                    return t.appendChild(n.createComment("")), !t.getElementsByTagName("*").length
                }), C.getElementsByClassName = vt.test(n.getElementsByClassName) && s(function(t) {
                    return t.innerHTML = "<div class='a'></div><div class='a i'></div>", t.firstChild.className = "i", 2 === t.getElementsByClassName("i").length
                }), C.getById = s(function(t) {
                    return D.appendChild(t).id = q, !n.getElementsByName || !n.getElementsByName(q).length
                }), C.getById ? (k.find.ID = function(t, e) {
                    if (typeof e.getElementById !== Z && P) {
                        var n = e.getElementById(t);
                        return n && n.parentNode ? [n] : []
                    }
                }, k.filter.ID = function(t) {
                    var e = t.replace(xt, wt);
                    return function(t) {
                        return t.getAttribute("id") === e
                    }
                }) : (delete k.find.ID, k.filter.ID = function(t) {
                    var e = t.replace(xt, wt);
                    return function(t) {
                        var n = typeof t.getAttributeNode !== Z && t.getAttributeNode("id");
                        return n && n.value === e
                    }
                }), k.find.TAG = C.getElementsByTagName ? function(t, e) {
                    return typeof e.getElementsByTagName !== Z ? e.getElementsByTagName(t) : void 0
                } : function(t, e) {
                    var n, i = [],
                        s = 0,
                        a = e.getElementsByTagName(t);
                    if ("*" === t) {
                        for (; n = a[s++];) 1 === n.nodeType && i.push(n);
                        return i
                    }
                    return a
                }, k.find.CLASS = C.getElementsByClassName && function(t, e) {
                    return typeof e.getElementsByClassName !== Z && P ? e.getElementsByClassName(t) : void 0
                }, M = [], N = [], (C.qsa = vt.test(n.querySelectorAll)) && (s(function(t) {
                    t.innerHTML = "<select t=''><option selected=''></option></select>", t.querySelectorAll("[t^='']").length && N.push("[*^$]=" + it + "*(?:''|\"\")"), t.querySelectorAll("[selected]").length || N.push("\\[" + it + "*(?:value|" + nt + ")"), t.querySelectorAll(":checked").length || N.push(":checked")
                }), s(function(t) {
                    var e = n.createElement("input");
                    e.setAttribute("type", "hidden"), t.appendChild(e).setAttribute("name", "D"), t.querySelectorAll("[name=d]").length && N.push("name" + it + "*[*^$|!~]?="), t.querySelectorAll(":enabled").length || N.push(":enabled", ":disabled"), t.querySelectorAll("*,:x"), N.push(",.*:")
                })), (C.matchesSelector = vt.test(H = D.webkitMatchesSelector || D.mozMatchesSelector || D.oMatchesSelector || D.msMatchesSelector)) && s(function(t) {
                    C.disconnectedMatch = H.call(t, "div"), H.call(t, "[s!='']:x"), M.push("!=", rt)
                }), N = N.length && new RegExp(N.join("|")), M = M.length && new RegExp(M.join("|")), e = vt.test(D.compareDocumentPosition), z = e || vt.test(D.contains) ? function(t, e) {
                    var n = 9 === t.nodeType ? t.documentElement : t,
                        i = e && e.parentNode;
                    return t === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : t.compareDocumentPosition && 16 & t.compareDocumentPosition(i)))
                } : function(t, e) {
                    if (e)
                        for (; e = e.parentNode;)
                            if (e === t) return !0;
                    return !1
                }, X = e ? function(t, e) {
                    if (t === e) return I = !0, 0;
                    var i = !t.compareDocumentPosition - !e.compareDocumentPosition;
                    return i ? i : (i = (t.ownerDocument || t) === (e.ownerDocument || e) ? t.compareDocumentPosition(e) : 1, 1 & i || !C.sortDetached && e.compareDocumentPosition(t) === i ? t === n || t.ownerDocument === W && z(W, t) ? -1 : e === n || e.ownerDocument === W && z(W, e) ? 1 : F ? et.call(F, t) - et.call(F, e) : 0 : 4 & i ? -1 : 1)
                } : function(t, e) {
                    if (t === e) return I = !0, 0;
                    var i, s = 0,
                        a = t.parentNode,
                        r = e.parentNode,
                        l = [t],
                        c = [e];
                    if (!a || !r) return t === n ? -1 : e === n ? 1 : a ? -1 : r ? 1 : F ? et.call(F, t) - et.call(F, e) : 0;
                    if (a === r) return o(t, e);
                    for (i = t; i = i.parentNode;) l.unshift(i);
                    for (i = e; i = i.parentNode;) c.unshift(i);
                    for (; l[s] === c[s];) s++;
                    return s ? o(l[s], c[s]) : l[s] === W ? -1 : c[s] === W ? 1 : 0
                }, n) : E
            }, e.matches = function(t, n) {
                return e(t, null, null, n)
            }, e.matchesSelector = function(t, n) {
                if ((t.ownerDocument || t) !== E && j(t), n = n.replace(ut, "='$1']"), !(!C.matchesSelector || !P || M && M.test(n) || N && N.test(n))) try {
                    var i = H.call(t, n);
                    if (i || C.disconnectedMatch || t.document && 11 !== t.document.nodeType) return i
                } catch (s) {}
                return e(n, E, null, [t]).length > 0
            }, e.contains = function(t, e) {
                return (t.ownerDocument || t) !== E && j(t), z(t, e)
            }, e.attr = function(t, e) {
                (t.ownerDocument || t) !== E && j(t);
                var n = k.attrHandle[e.toLowerCase()],
                    i = n && Y.call(k.attrHandle, e.toLowerCase()) ? n(t, e, !P) : void 0;
                return void 0 !== i ? i : C.attributes || !P ? t.getAttribute(e) : (i = t.getAttributeNode(e)) && i.specified ? i.value : null
            }, e.error = function(t) {
                throw new Error("Syntax error, unrecognized expression: " + t)
            }, e.uniqueSort = function(t) {
                var e, n = [],
                    i = 0,
                    s = 0;
                if (I = !C.detectDuplicates, F = !C.sortStable && t.slice(0), t.sort(X), I) {
                    for (; e = t[s++];) e === t[s] && (i = n.push(s));
                    for (; i--;) t.splice(n[i], 1)
                }
                return F = null, t
            }, S = e.getText = function(t) {
                var e, n = "",
                    i = 0,
                    s = t.nodeType;
                if (s) {
                    if (1 === s || 9 === s || 11 === s) {
                        if ("string" == typeof t.textContent) return t.textContent;
                        for (t = t.firstChild; t; t = t.nextSibling) n += S(t)
                    } else if (3 === s || 4 === s) return t.nodeValue
                } else
                    for (; e = t[i++];) n += S(e);
                return n
            }, k = e.selectors = {
                cacheLength: 50,
                createPseudo: i,
                match: pt,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(t) {
                        return t[1] = t[1].replace(xt, wt), t[3] = (t[4] || t[5] || "").replace(xt, wt), "~=" === t[2] && (t[3] = " " + t[3] + " "), t.slice(0, 4)
                    },
                    CHILD: function(t) {
                        return t[1] = t[1].toLowerCase(), "nth" === t[1].slice(0, 3) ? (t[3] || e.error(t[0]), t[4] = +(t[4] ? t[5] + (t[6] || 1) : 2 * ("even" === t[3] || "odd" === t[3])), t[5] = +(t[7] + t[8] || "odd" === t[3])) : t[3] && e.error(t[0]), t
                    },
                    PSEUDO: function(t) {
                        var e, n = !t[5] && t[2];
                        return pt.CHILD.test(t[0]) ? null : (t[3] && void 0 !== t[4] ? t[2] = t[4] : n && ht.test(n) && (e = h(n, !0)) && (e = n.indexOf(")", n.length - e) - n.length) && (t[0] = t[0].slice(0, e), t[2] = n.slice(0, e)), t.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(t) {
                        var e = t.replace(xt, wt).toLowerCase();
                        return "*" === t ? function() {
                            return !0
                        } : function(t) {
                            return t.nodeName && t.nodeName.toLowerCase() === e
                        }
                    },
                    CLASS: function(t) {
                        var e = R[t + " "];
                        return e || (e = new RegExp("(^|" + it + ")" + t + "(" + it + "|$)")) && R(t, function(t) {
                            return e.test("string" == typeof t.className && t.className || typeof t.getAttribute !== Z && t.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(t, n, i) {
                        return function(s) {
                            var a = e.attr(s, t);
                            return null == a ? "!=" === n : n ? (a += "", "=" === n ? a === i : "!=" === n ? a !== i : "^=" === n ? i && 0 === a.indexOf(i) : "*=" === n ? i && a.indexOf(i) > -1 : "$=" === n ? i && a.slice(-i.length) === i : "~=" === n ? (" " + a + " ").indexOf(i) > -1 : "|=" === n ? a === i || a.slice(0, i.length + 1) === i + "-" : !1) : !0
                        }
                    },
                    CHILD: function(t, e, n, i, s) {
                        var a = "nth" !== t.slice(0, 3),
                            o = "last" !== t.slice(-4),
                            r = "of-type" === e;
                        return 1 === i && 0 === s ? function(t) {
                            return !!t.parentNode
                        } : function(e, n, l) {
                            var c, d, u, h, f, p, g = a !== o ? "nextSibling" : "previousSibling",
                                m = e.parentNode,
                                v = r && e.nodeName.toLowerCase(),
                                y = !l && !r;
                            if (m) {
                                if (a) {
                                    for (; g;) {
                                        for (u = e; u = u[g];)
                                            if (r ? u.nodeName.toLowerCase() === v : 1 === u.nodeType) return !1;
                                        p = g = "only" === t && !p && "nextSibling"
                                    }
                                    return !0
                                }
                                if (p = [o ? m.firstChild : m.lastChild], o && y) {
                                    for (d = m[q] || (m[q] = {}), c = d[t] || [], f = c[0] === O && c[1], h = c[0] === O && c[2], u = f && m.childNodes[f]; u = ++f && u && u[g] || (h = f = 0) || p.pop();)
                                        if (1 === u.nodeType && ++h && u === e) {
                                            d[t] = [O, f, h];
                                            break
                                        }
                                } else if (y && (c = (e[q] || (e[q] = {}))[t]) && c[0] === O) h = c[1];
                                else
                                    for (;
                                        (u = ++f && u && u[g] || (h = f = 0) || p.pop()) && ((r ? u.nodeName.toLowerCase() !== v : 1 !== u.nodeType) || !++h || (y && ((u[q] || (u[q] = {}))[t] = [O, h]), u !== e)););
                                return h -= s, h === i || h % i === 0 && h / i >= 0
                            }
                        }
                    },
                    PSEUDO: function(t, n) {
                        var s, a = k.pseudos[t] || k.setFilters[t.toLowerCase()] || e.error("unsupported pseudo: " + t);
                        return a[q] ? a(n) : a.length > 1 ? (s = [t, t, "", n], k.setFilters.hasOwnProperty(t.toLowerCase()) ? i(function(t, e) {
                            for (var i, s = a(t, n), o = s.length; o--;) i = et.call(t, s[o]), t[i] = !(e[i] = s[o])
                        }) : function(t) {
                            return a(t, 0, s)
                        }) : a
                    }
                },
                pseudos: {
                    not: i(function(t) {
                        var e = [],
                            n = [],
                            s = A(t.replace(lt, "$1"));
                        return s[q] ? i(function(t, e, n, i) {
                            for (var a, o = s(t, null, i, []), r = t.length; r--;)(a = o[r]) && (t[r] = !(e[r] = a))
                        }) : function(t, i, a) {
                            return e[0] = t, s(e, null, a, n), !n.pop()
                        }
                    }),
                    has: i(function(t) {
                        return function(n) {
                            return e(t, n).length > 0
                        }
                    }),
                    contains: i(function(t) {
                        return function(e) {
                            return (e.textContent || e.innerText || S(e)).indexOf(t) > -1
                        }
                    }),
                    lang: i(function(t) {
                        return ft.test(t || "") || e.error("unsupported lang: " + t), t = t.replace(xt, wt).toLowerCase(),
                            function(e) {
                                var n;
                                do
                                    if (n = P ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return n = n.toLowerCase(), n === t || 0 === n.indexOf(t + "-");
                                while ((e = e.parentNode) && 1 === e.nodeType);
                                return !1
                            }
                    }),
                    target: function(e) {
                        var n = t.location && t.location.hash;
                        return n && n.slice(1) === e.id
                    },
                    root: function(t) {
                        return t === D
                    },
                    focus: function(t) {
                        return t === E.activeElement && (!E.hasFocus || E.hasFocus()) && !!(t.type || t.href || ~t.tabIndex)
                    },
                    enabled: function(t) {
                        return t.disabled === !1
                    },
                    disabled: function(t) {
                        return t.disabled === !0
                    },
                    checked: function(t) {
                        var e = t.nodeName.toLowerCase();
                        return "input" === e && !!t.checked || "option" === e && !!t.selected
                    },
                    selected: function(t) {
                        return t.parentNode && t.parentNode.selectedIndex, t.selected === !0
                    },
                    empty: function(t) {
                        for (t = t.firstChild; t; t = t.nextSibling)
                            if (t.nodeType < 6) return !1;
                        return !0
                    },
                    parent: function(t) {
                        return !k.pseudos.empty(t)
                    },
                    header: function(t) {
                        return mt.test(t.nodeName)
                    },
                    input: function(t) {
                        return gt.test(t.nodeName)
                    },
                    button: function(t) {
                        var e = t.nodeName.toLowerCase();
                        return "input" === e && "button" === t.type || "button" === e
                    },
                    text: function(t) {
                        var e;
                        return "input" === t.nodeName.toLowerCase() && "text" === t.type && (null == (e = t.getAttribute("type")) || "text" === e.toLowerCase())
                    },
                    first: c(function() {
                        return [0]
                    }),
                    last: c(function(t, e) {
                        return [e - 1]
                    }),
                    eq: c(function(t, e, n) {
                        return [0 > n ? n + e : n]
                    }),
                    even: c(function(t, e) {
                        for (var n = 0; e > n; n += 2) t.push(n);
                        return t
                    }),
                    odd: c(function(t, e) {
                        for (var n = 1; e > n; n += 2) t.push(n);
                        return t
                    }),
                    lt: c(function(t, e, n) {
                        for (var i = 0 > n ? n + e : n; --i >= 0;) t.push(i);
                        return t
                    }),
                    gt: c(function(t, e, n) {
                        for (var i = 0 > n ? n + e : n; ++i < e;) t.push(i);
                        return t
                    })
                }
            }, k.pseudos.nth = k.pseudos.eq;
            for (w in {
                    radio: !0,
                    checkbox: !0,
                    file: !0,
                    password: !0,
                    image: !0
                }) k.pseudos[w] = r(w);
            for (w in {
                    submit: !0,
                    reset: !0
                }) k.pseudos[w] = l(w);
            return u.prototype = k.filters = k.pseudos, k.setFilters = new u, A = e.compile = function(t, e) {
                var n, i = [],
                    s = [],
                    a = Q[t + " "];
                if (!a) {
                    for (e || (e = h(t)), n = e.length; n--;) a = y(e[n]), a[q] ? i.push(a) : s.push(a);
                    a = Q(t, _(s, i))
                }
                return a
            }, C.sortStable = q.split("").sort(X).join("") === q, C.detectDuplicates = !!I, j(), C.sortDetached = s(function(t) {
                return 1 & t.compareDocumentPosition(E.createElement("div"))
            }), s(function(t) {
                return t.innerHTML = "<a href='#'></a>", "#" === t.firstChild.getAttribute("href")
            }) || a("type|href|height|width", function(t, e, n) {
                return n ? void 0 : t.getAttribute(e, "type" === e.toLowerCase() ? 1 : 2)
            }), C.attributes && s(function(t) {
                return t.innerHTML = "<input/>", t.firstChild.setAttribute("value", ""), "" === t.firstChild.getAttribute("value")
            }) || a("value", function(t, e, n) {
                return n || "input" !== t.nodeName.toLowerCase() ? void 0 : t.defaultValue
            }), s(function(t) {
                return null == t.getAttribute("disabled")
            }) || a(nt, function(t, e, n) {
                var i;
                return n ? void 0 : t[e] === !0 ? e.toLowerCase() : (i = t.getAttributeNode(e)) && i.specified ? i.value : null
            }), e
        }(t);
        tt.find = st, tt.expr = st.selectors, tt.expr[":"] = tt.expr.pseudos, tt.unique = st.uniqueSort, tt.text = st.getText, tt.isXMLDoc = st.isXML, tt.contains = st.contains;
        var at = tt.expr.match.needsContext,
            ot = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
            rt = /^.[^:#\[\.,]*$/;
        tt.filter = function(t, e, n) {
            var i = e[0];
            return n && (t = ":not(" + t + ")"), 1 === e.length && 1 === i.nodeType ? tt.find.matchesSelector(i, t) ? [i] : [] : tt.find.matches(t, tt.grep(e, function(t) {
                return 1 === t.nodeType
            }))
        }, tt.fn.extend({
            find: function(t) {
                var e, n = this.length,
                    i = [],
                    s = this;
                if ("string" != typeof t) return this.pushStack(tt(t).filter(function() {
                    for (e = 0; n > e; e++)
                        if (tt.contains(s[e], this)) return !0
                }));
                for (e = 0; n > e; e++) tt.find(t, s[e], i);
                return i = this.pushStack(n > 1 ? tt.unique(i) : i), i.selector = this.selector ? this.selector + " " + t : t, i
            },
            filter: function(t) {
                return this.pushStack(i(this, t || [], !1))
            },
            not: function(t) {
                return this.pushStack(i(this, t || [], !0))
            },
            is: function(t) {
                return !!i(this, "string" == typeof t && at.test(t) ? tt(t) : t || [], !1).length
            }
        });
        var lt, ct = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
            dt = tt.fn.init = function(t, e) {
                var n, i;
                if (!t) return this;
                if ("string" == typeof t) {
                    if (n = "<" === t[0] && ">" === t[t.length - 1] && t.length >= 3 ? [null, t, null] : ct.exec(t), !n || !n[1] && e) return !e || e.jquery ? (e || lt).find(t) : this.constructor(e).find(t);
                    if (n[1]) {
                        if (e = e instanceof tt ? e[0] : e, tt.merge(this, tt.parseHTML(n[1], e && e.nodeType ? e.ownerDocument || e : J, !0)), ot.test(n[1]) && tt.isPlainObject(e))
                            for (n in e) tt.isFunction(this[n]) ? this[n](e[n]) : this.attr(n, e[n]);
                        return this
                    }
                    return i = J.getElementById(n[2]), i && i.parentNode && (this.length = 1, this[0] = i), this.context = J, this.selector = t, this
                }
                return t.nodeType ? (this.context = this[0] = t, this.length = 1, this) : tt.isFunction(t) ? "undefined" != typeof lt.ready ? lt.ready(t) : t(tt) : (void 0 !== t.selector && (this.selector = t.selector, this.context = t.context), tt.makeArray(t, this))
            };
        dt.prototype = tt.fn, lt = tt(J);
        var ut = /^(?:parents|prev(?:Until|All))/,
            ht = {
                children: !0,
                contents: !0,
                next: !0,
                prev: !0
            };
        tt.extend({
            dir: function(t, e, n) {
                for (var i = [], s = void 0 !== n;
                    (t = t[e]) && 9 !== t.nodeType;)
                    if (1 === t.nodeType) {
                        if (s && tt(t).is(n)) break;
                        i.push(t)
                    }
                return i
            },
            sibling: function(t, e) {
                for (var n = []; t; t = t.nextSibling) 1 === t.nodeType && t !== e && n.push(t);
                return n
            }
        }), tt.fn.extend({
            has: function(t) {
                var e = tt(t, this),
                    n = e.length;
                return this.filter(function() {
                    for (var t = 0; n > t; t++)
                        if (tt.contains(this, e[t])) return !0
                })
            },
            closest: function(t, e) {
                for (var n, i = 0, s = this.length, a = [], o = at.test(t) || "string" != typeof t ? tt(t, e || this.context) : 0; s > i; i++)
                    for (n = this[i]; n && n !== e; n = n.parentNode)
                        if (n.nodeType < 11 && (o ? o.index(n) > -1 : 1 === n.nodeType && tt.find.matchesSelector(n, t))) {
                            a.push(n);
                            break
                        }
                return this.pushStack(a.length > 1 ? tt.unique(a) : a)
            },
            index: function(t) {
                return t ? "string" == typeof t ? X.call(tt(t), this[0]) : X.call(this, t.jquery ? t[0] : t) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
            },
            add: function(t, e) {
                return this.pushStack(tt.unique(tt.merge(this.get(), tt(t, e))))
            },
            addBack: function(t) {
                return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
            }
        }), tt.each({
            parent: function(t) {
                var e = t.parentNode;
                return e && 11 !== e.nodeType ? e : null
            },
            parents: function(t) {
                return tt.dir(t, "parentNode")
            },
            parentsUntil: function(t, e, n) {
                return tt.dir(t, "parentNode", n)
            },
            next: function(t) {
                return s(t, "nextSibling")
            },
            prev: function(t) {
                return s(t, "previousSibling")
            },
            nextAll: function(t) {
                return tt.dir(t, "nextSibling")
            },
            prevAll: function(t) {
                return tt.dir(t, "previousSibling")
            },
            nextUntil: function(t, e, n) {
                return tt.dir(t, "nextSibling", n)
            },
            prevUntil: function(t, e, n) {
                return tt.dir(t, "previousSibling", n)
            },
            siblings: function(t) {
                return tt.sibling((t.parentNode || {}).firstChild, t)
            },
            children: function(t) {
                return tt.sibling(t.firstChild)
            },
            contents: function(t) {
                return t.contentDocument || tt.merge([], t.childNodes)
            }
        }, function(t, e) {
            tt.fn[t] = function(n, i) {
                var s = tt.map(this, e, n);
                return "Until" !== t.slice(-5) && (i = n), i && "string" == typeof i && (s = tt.filter(i, s)), this.length > 1 && (ht[t] || tt.unique(s), ut.test(t) && s.reverse()), this.pushStack(s)
            }
        });
        var ft = /\S+/g,
            pt = {};
        tt.Callbacks = function(t) {
            t = "string" == typeof t ? pt[t] || a(t) : tt.extend({}, t);
            var e, n, i, s, o, r, l = [],
                c = !t.once && [],
                d = function(a) {
                    for (e = t.memory && a, n = !0, r = s || 0, s = 0, o = l.length, i = !0; l && o > r; r++)
                        if (l[r].apply(a[0], a[1]) === !1 && t.stopOnFalse) {
                            e = !1;
                            break
                        }
                    i = !1, l && (c ? c.length && d(c.shift()) : e ? l = [] : u.disable())
                },
                u = {
                    add: function() {
                        if (l) {
                            var n = l.length;
                            ! function a(e) {
                                tt.each(e, function(e, n) {
                                    var i = tt.type(n);
                                    "function" === i ? t.unique && u.has(n) || l.push(n) : n && n.length && "string" !== i && a(n)
                                })
                            }(arguments), i ? o = l.length : e && (s = n, d(e))
                        }
                        return this
                    },
                    remove: function() {
                        return l && tt.each(arguments, function(t, e) {
                            for (var n;
                                (n = tt.inArray(e, l, n)) > -1;) l.splice(n, 1), i && (o >= n && o--, r >= n && r--)
                        }), this
                    },
                    has: function(t) {
                        return t ? tt.inArray(t, l) > -1 : !(!l || !l.length)
                    },
                    empty: function() {
                        return l = [], o = 0, this
                    },
                    disable: function() {
                        return l = c = e = void 0, this
                    },
                    disabled: function() {
                        return !l
                    },
                    lock: function() {
                        return c = void 0, e || u.disable(), this
                    },
                    locked: function() {
                        return !c
                    },
                    fireWith: function(t, e) {
                        return !l || n && !c || (e = e || [], e = [t, e.slice ? e.slice() : e], i ? c.push(e) : d(e)), this
                    },
                    fire: function() {
                        return u.fireWith(this, arguments), this
                    },
                    fired: function() {
                        return !!n
                    }
                };
            return u
        }, tt.extend({
            Deferred: function(t) {
                var e = [
                        ["resolve", "done", tt.Callbacks("once memory"), "resolved"],
                        ["reject", "fail", tt.Callbacks("once memory"), "rejected"],
                        ["notify", "progress", tt.Callbacks("memory")]
                    ],
                    n = "pending",
                    i = {
                        state: function() {
                            return n
                        },
                        always: function() {
                            return s.done(arguments).fail(arguments), this
                        },
                        then: function() {
                            var t = arguments;
                            return tt.Deferred(function(n) {
                                tt.each(e, function(e, a) {
                                    var o = tt.isFunction(t[e]) && t[e];
                                    s[a[1]](function() {
                                        var t = o && o.apply(this, arguments);
                                        t && tt.isFunction(t.promise) ? t.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[a[0] + "With"](this === i ? n.promise() : this, o ? [t] : arguments)
                                    })
                                }), t = null
                            }).promise()
                        },
                        promise: function(t) {
                            return null != t ? tt.extend(t, i) : i
                        }
                    },
                    s = {};
                return i.pipe = i.then, tt.each(e, function(t, a) {
                    var o = a[2],
                        r = a[3];
                    i[a[1]] = o.add, r && o.add(function() {
                        n = r
                    }, e[1 ^ t][2].disable, e[2][2].lock), s[a[0]] = function() {
                        return s[a[0] + "With"](this === s ? i : this, arguments), this
                    }, s[a[0] + "With"] = o.fireWith
                }), i.promise(s), t && t.call(s, s), s
            },
            when: function(t) {
                var e, n, i, s = 0,
                    a = R.call(arguments),
                    o = a.length,
                    r = 1 !== o || t && tt.isFunction(t.promise) ? o : 0,
                    l = 1 === r ? t : tt.Deferred(),
                    c = function(t, n, i) {
                        return function(s) {
                            n[t] = this, i[t] = arguments.length > 1 ? R.call(arguments) : s, i === e ? l.notifyWith(n, i) : --r || l.resolveWith(n, i)
                        }
                    };
                if (o > 1)
                    for (e = new Array(o), n = new Array(o), i = new Array(o); o > s; s++) a[s] && tt.isFunction(a[s].promise) ? a[s].promise().done(c(s, i, a)).fail(l.reject).progress(c(s, n, e)) : --r;
                return r || l.resolveWith(i, a), l.promise()
            }
        });
        var gt;
        tt.fn.ready = function(t) {
            return tt.ready.promise().done(t), this
        }, tt.extend({
            isReady: !1,
            readyWait: 1,
            holdReady: function(t) {
                t ? tt.readyWait++ : tt.ready(!0)
            },
            ready: function(t) {
                (t === !0 ? --tt.readyWait : tt.isReady) || (tt.isReady = !0, t !== !0 && --tt.readyWait > 0 || (gt.resolveWith(J, [tt]), tt.fn.trigger && tt(J).trigger("ready").off("ready")))
            }
        }), tt.ready.promise = function(e) {
            return gt || (gt = tt.Deferred(), "complete" === J.readyState ? setTimeout(tt.ready) : (J.addEventListener("DOMContentLoaded", o, !1), t.addEventListener("load", o, !1))), gt.promise(e)
        }, tt.ready.promise();
        var mt = tt.access = function(t, e, n, i, s, a, o) {
            var r = 0,
                l = t.length,
                c = null == n;
            if ("object" === tt.type(n)) {
                s = !0;
                for (r in n) tt.access(t, e, r, n[r], !0, a, o)
            } else if (void 0 !== i && (s = !0, tt.isFunction(i) || (o = !0), c && (o ? (e.call(t, i), e = null) : (c = e, e = function(t, e, n) {
                    return c.call(tt(t), n)
                })), e))
                for (; l > r; r++) e(t[r], n, o ? i : i.call(t[r], r, e(t[r], n)));
            return s ? t : c ? e.call(t) : l ? e(t[0], n) : a
        };
        tt.acceptData = function(t) {
            return 1 === t.nodeType || 9 === t.nodeType || !+t.nodeType
        }, r.uid = 1, r.accepts = tt.acceptData, r.prototype = {
            key: function(t) {
                if (!r.accepts(t)) return 0;
                var e = {},
                    n = t[this.expando];
                if (!n) {
                    n = r.uid++;
                    try {
                        e[this.expando] = {
                            value: n
                        }, Object.defineProperties(t, e)
                    } catch (i) {
                        e[this.expando] = n, tt.extend(t, e)
                    }
                }
                return this.cache[n] || (this.cache[n] = {}), n
            },
            set: function(t, e, n) {
                var i, s = this.key(t),
                    a = this.cache[s];
                if ("string" == typeof e) a[e] = n;
                else if (tt.isEmptyObject(a)) tt.extend(this.cache[s], e);
                else
                    for (i in e) a[i] = e[i];
                return a
            },
            get: function(t, e) {
                var n = this.cache[this.key(t)];
                return void 0 === e ? n : n[e]
            },
            access: function(t, e, n) {
                var i;
                return void 0 === e || e && "string" == typeof e && void 0 === n ? (i = this.get(t, e), void 0 !== i ? i : this.get(t, tt.camelCase(e))) : (this.set(t, e, n), void 0 !== n ? n : e)
            },
            remove: function(t, e) {
                var n, i, s, a = this.key(t),
                    o = this.cache[a];
                if (void 0 === e) this.cache[a] = {};
                else {
                    tt.isArray(e) ? i = e.concat(e.map(tt.camelCase)) : (s = tt.camelCase(e), e in o ? i = [e, s] : (i = s, i = i in o ? [i] : i.match(ft) || [])), n = i.length;
                    for (; n--;) delete o[i[n]]
                }
            },
            hasData: function(t) {
                return !tt.isEmptyObject(this.cache[t[this.expando]] || {})
            },
            discard: function(t) {
                t[this.expando] && delete this.cache[t[this.expando]]
            }
        };
        var vt = new r,
            yt = new r,
            _t = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
            bt = /([A-Z])/g;
        tt.extend({
            hasData: function(t) {
                return yt.hasData(t) || vt.hasData(t)
            },
            data: function(t, e, n) {
                return yt.access(t, e, n)
            },
            removeData: function(t, e) {
                yt.remove(t, e)
            },
            _data: function(t, e, n) {
                return vt.access(t, e, n)
            },
            _removeData: function(t, e) {
                vt.remove(t, e)
            }
        }), tt.fn.extend({
            data: function(t, e) {
                var n, i, s, a = this[0],
                    o = a && a.attributes;
                if (void 0 === t) {
                    if (this.length && (s = yt.get(a), 1 === a.nodeType && !vt.get(a, "hasDataAttrs"))) {
                        for (n = o.length; n--;) i = o[n].name, 0 === i.indexOf("data-") && (i = tt.camelCase(i.slice(5)), l(a, i, s[i]));
                        vt.set(a, "hasDataAttrs", !0)
                    }
                    return s
                }
                return "object" == typeof t ? this.each(function() {
                    yt.set(this, t)
                }) : mt(this, function(e) {
                    var n, i = tt.camelCase(t);
                    if (a && void 0 === e) {
                        if (n = yt.get(a, t), void 0 !== n) return n;
                        if (n = yt.get(a, i), void 0 !== n) return n;
                        if (n = l(a, i, void 0), void 0 !== n) return n
                    } else this.each(function() {
                        var n = yt.get(this, i);
                        yt.set(this, i, e), -1 !== t.indexOf("-") && void 0 !== n && yt.set(this, t, e)
                    })
                }, null, e, arguments.length > 1, null, !0)
            },
            removeData: function(t) {
                return this.each(function() {
                    yt.remove(this, t)
                })
            }
        }), tt.extend({
            queue: function(t, e, n) {
                var i;
                return t ? (e = (e || "fx") + "queue", i = vt.get(t, e), n && (!i || tt.isArray(n) ? i = vt.access(t, e, tt.makeArray(n)) : i.push(n)), i || []) : void 0
            },
            dequeue: function(t, e) {
                e = e || "fx";
                var n = tt.queue(t, e),
                    i = n.length,
                    s = n.shift(),
                    a = tt._queueHooks(t, e),
                    o = function() {
                        tt.dequeue(t, e)
                    };
                "inprogress" === s && (s = n.shift(), i--), s && ("fx" === e && n.unshift("inprogress"), delete a.stop, s.call(t, o, a)), !i && a && a.empty.fire()
            },
            _queueHooks: function(t, e) {
                var n = e + "queueHooks";
                return vt.get(t, n) || vt.access(t, n, {
                    empty: tt.Callbacks("once memory").add(function() {
                        vt.remove(t, [e + "queue", n])
                    })
                })
            }
        }), tt.fn.extend({
            queue: function(t, e) {
                var n = 2;
                return "string" != typeof t && (e = t, t = "fx", n--), arguments.length < n ? tt.queue(this[0], t) : void 0 === e ? this : this.each(function() {
                    var n = tt.queue(this, t, e);
                    tt._queueHooks(this, t), "fx" === t && "inprogress" !== n[0] && tt.dequeue(this, t)
                })
            },
            dequeue: function(t) {
                return this.each(function() {
                    tt.dequeue(this, t)
                })
            },
            clearQueue: function(t) {
                return this.queue(t || "fx", [])
            },
            promise: function(t, e) {
                var n, i = 1,
                    s = tt.Deferred(),
                    a = this,
                    o = this.length,
                    r = function() {
                        --i || s.resolveWith(a, [a])
                    };
                for ("string" != typeof t && (e = t, t = void 0), t = t || "fx"; o--;) n = vt.get(a[o], t + "queueHooks"), n && n.empty && (i++, n.empty.add(r));
                return r(), s.promise(e)
            }
        });
        var xt = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
            wt = ["Top", "Right", "Bottom", "Left"],
            Ct = function(t, e) {
                return t = e || t, "none" === tt.css(t, "display") || !tt.contains(t.ownerDocument, t)
            },
            kt = /^(?:checkbox|radio)$/i;
        ! function() {
            var t = J.createDocumentFragment(),
                e = t.appendChild(J.createElement("div"));
            e.innerHTML = "<input type='radio' checked='checked' name='t'/>", G.checkClone = e.cloneNode(!0).cloneNode(!0).lastChild.checked, e.innerHTML = "<textarea>x</textarea>", G.noCloneChecked = !!e.cloneNode(!0).lastChild.defaultValue
        }();
        var St = "undefined";
        G.focusinBubbles = "onfocusin" in t;
        var Tt = /^key/,
            At = /^(?:mouse|contextmenu)|click/,
            $t = /^(?:focusinfocus|focusoutblur)$/,
            Ft = /^([^.]*)(?:\.(.+)|)$/;
        tt.event = {
            global: {},
            add: function(t, e, n, i, s) {
                var a, o, r, l, c, d, u, h, f, p, g, m = vt.get(t);
                if (m)
                    for (n.handler && (a = n, n = a.handler, s = a.selector), n.guid || (n.guid = tt.guid++), (l = m.events) || (l = m.events = {}), (o = m.handle) || (o = m.handle = function(e) {
                            return typeof tt !== St && tt.event.triggered !== e.type ? tt.event.dispatch.apply(t, arguments) : void 0
                        }), e = (e || "").match(ft) || [""], c = e.length; c--;) r = Ft.exec(e[c]) || [], f = g = r[1], p = (r[2] || "").split(".").sort(), f && (u = tt.event.special[f] || {}, f = (s ? u.delegateType : u.bindType) || f, u = tt.event.special[f] || {}, d = tt.extend({
                        type: f,
                        origType: g,
                        data: i,
                        handler: n,
                        guid: n.guid,
                        selector: s,
                        needsContext: s && tt.expr.match.needsContext.test(s),
                        namespace: p.join(".")
                    }, a), (h = l[f]) || (h = l[f] = [], h.delegateCount = 0, u.setup && u.setup.call(t, i, p, o) !== !1 || t.addEventListener && t.addEventListener(f, o, !1)), u.add && (u.add.call(t, d), d.handler.guid || (d.handler.guid = n.guid)), s ? h.splice(h.delegateCount++, 0, d) : h.push(d), tt.event.global[f] = !0)
            },
            remove: function(t, e, n, i, s) {
                var a, o, r, l, c, d, u, h, f, p, g, m = vt.hasData(t) && vt.get(t);
                if (m && (l = m.events)) {
                    for (e = (e || "").match(ft) || [""], c = e.length; c--;)
                        if (r = Ft.exec(e[c]) || [], f = g = r[1], p = (r[2] || "").split(".").sort(), f) {
                            for (u = tt.event.special[f] || {}, f = (i ? u.delegateType : u.bindType) || f, h = l[f] || [], r = r[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), o = a = h.length; a--;) d = h[a], !s && g !== d.origType || n && n.guid !== d.guid || r && !r.test(d.namespace) || i && i !== d.selector && ("**" !== i || !d.selector) || (h.splice(a, 1), d.selector && h.delegateCount--, u.remove && u.remove.call(t, d));
                            o && !h.length && (u.teardown && u.teardown.call(t, p, m.handle) !== !1 || tt.removeEvent(t, f, m.handle), delete l[f])
                        } else
                            for (f in l) tt.event.remove(t, f + e[c], n, i, !0);
                    tt.isEmptyObject(l) && (delete m.handle, vt.remove(t, "events"))
                }
            },
            trigger: function(e, n, i, s) {
                var a, o, r, l, c, d, u, h = [i || J],
                    f = Y.call(e, "type") ? e.type : e,
                    p = Y.call(e, "namespace") ? e.namespace.split(".") : [];
                if (o = r = i = i || J, 3 !== i.nodeType && 8 !== i.nodeType && !$t.test(f + tt.event.triggered) && (f.indexOf(".") >= 0 && (p = f.split("."), f = p.shift(), p.sort()), c = f.indexOf(":") < 0 && "on" + f, e = e[tt.expando] ? e : new tt.Event(f, "object" == typeof e && e), e.isTrigger = s ? 2 : 3, e.namespace = p.join("."), e.namespace_re = e.namespace ? new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = i), n = null == n ? [e] : tt.makeArray(n, [e]), u = tt.event.special[f] || {}, s || !u.trigger || u.trigger.apply(i, n) !== !1)) {
                    if (!s && !u.noBubble && !tt.isWindow(i)) {
                        for (l = u.delegateType || f, $t.test(l + f) || (o = o.parentNode); o; o = o.parentNode) h.push(o), r = o;
                        r === (i.ownerDocument || J) && h.push(r.defaultView || r.parentWindow || t)
                    }
                    for (a = 0;
                        (o = h[a++]) && !e.isPropagationStopped();) e.type = a > 1 ? l : u.bindType || f, d = (vt.get(o, "events") || {})[e.type] && vt.get(o, "handle"), d && d.apply(o, n), d = c && o[c], d && d.apply && tt.acceptData(o) && (e.result = d.apply(o, n), e.result === !1 && e.preventDefault());
                    return e.type = f, s || e.isDefaultPrevented() || u._default && u._default.apply(h.pop(), n) !== !1 || !tt.acceptData(i) || c && tt.isFunction(i[f]) && !tt.isWindow(i) && (r = i[c], r && (i[c] = null), tt.event.triggered = f, i[f](), tt.event.triggered = void 0, r && (i[c] = r)), e.result
                }
            },
            dispatch: function(t) {
                t = tt.event.fix(t);
                var e, n, i, s, a, o = [],
                    r = R.call(arguments),
                    l = (vt.get(this, "events") || {})[t.type] || [],
                    c = tt.event.special[t.type] || {};
                if (r[0] = t, t.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, t) !== !1) {
                    for (o = tt.event.handlers.call(this, t, l), e = 0;
                        (s = o[e++]) && !t.isPropagationStopped();)
                        for (t.currentTarget = s.elem, n = 0;
                            (a = s.handlers[n++]) && !t.isImmediatePropagationStopped();)(!t.namespace_re || t.namespace_re.test(a.namespace)) && (t.handleObj = a, t.data = a.data, i = ((tt.event.special[a.origType] || {}).handle || a.handler).apply(s.elem, r), void 0 !== i && (t.result = i) === !1 && (t.preventDefault(), t.stopPropagation()));
                    return c.postDispatch && c.postDispatch.call(this, t), t.result
                }
            },
            handlers: function(t, e) {
                var n, i, s, a, o = [],
                    r = e.delegateCount,
                    l = t.target;
                if (r && l.nodeType && (!t.button || "click" !== t.type))
                    for (; l !== this; l = l.parentNode || this)
                        if (l.disabled !== !0 || "click" !== t.type) {
                            for (i = [], n = 0; r > n; n++) a = e[n], s = a.selector + " ", void 0 === i[s] && (i[s] = a.needsContext ? tt(s, this).index(l) >= 0 : tt.find(s, this, null, [l]).length), i[s] && i.push(a);
                            i.length && o.push({
                                elem: l,
                                handlers: i
                            })
                        }
                return r < e.length && o.push({
                    elem: this,
                    handlers: e.slice(r)
                }), o
            },
            props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "),
                filter: function(t, e) {
                    return null == t.which && (t.which = null != e.charCode ? e.charCode : e.keyCode), t
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function(t, e) {
                    var n, i, s, a = e.button;
                    return null == t.pageX && null != e.clientX && (n = t.target.ownerDocument || J, i = n.documentElement, s = n.body, t.pageX = e.clientX + (i && i.scrollLeft || s && s.scrollLeft || 0) - (i && i.clientLeft || s && s.clientLeft || 0), t.pageY = e.clientY + (i && i.scrollTop || s && s.scrollTop || 0) - (i && i.clientTop || s && s.clientTop || 0)), t.which || void 0 === a || (t.which = 1 & a ? 1 : 2 & a ? 3 : 4 & a ? 2 : 0), t
                }
            },
            fix: function(t) {
                if (t[tt.expando]) return t;
                var e, n, i, s = t.type,
                    a = t,
                    o = this.fixHooks[s];
                for (o || (this.fixHooks[s] = o = At.test(s) ? this.mouseHooks : Tt.test(s) ? this.keyHooks : {}), i = o.props ? this.props.concat(o.props) : this.props, t = new tt.Event(a), e = i.length; e--;) n = i[e], t[n] = a[n];
                return t.target || (t.target = J), 3 === t.target.nodeType && (t.target = t.target.parentNode), o.filter ? o.filter(t, a) : t
            },
            special: {
                load: {
                    noBubble: !0
                },
                focus: {
                    trigger: function() {
                        return this !== u() && this.focus ? (this.focus(), !1) : void 0
                    },
                    delegateType: "focusin"
                },
                blur: {
                    trigger: function() {
                        return this === u() && this.blur ? (this.blur(), !1) : void 0
                    },
                    delegateType: "focusout"
                },
                click: {
                    trigger: function() {
                        return "checkbox" === this.type && this.click && tt.nodeName(this, "input") ? (this.click(), !1) : void 0
                    },
                    _default: function(t) {
                        return tt.nodeName(t.target, "a")
                    }
                },
                beforeunload: {
                    postDispatch: function(t) {
                        void 0 !== t.result && (t.originalEvent.returnValue = t.result)
                    }
                }
            },
            simulate: function(t, e, n, i) {
                var s = tt.extend(new tt.Event, n, {
                    type: t,
                    isSimulated: !0,
                    originalEvent: {}
                });
                i ? tt.event.trigger(s, null, e) : tt.event.dispatch.call(e, s), s.isDefaultPrevented() && n.preventDefault()
            }
        }, tt.removeEvent = function(t, e, n) {
            t.removeEventListener && t.removeEventListener(e, n, !1)
        }, tt.Event = function(t, e) {
            return this instanceof tt.Event ? (t && t.type ? (this.originalEvent = t, this.type = t.type, this.isDefaultPrevented = t.defaultPrevented || void 0 === t.defaultPrevented && t.getPreventDefault && t.getPreventDefault() ? c : d) : this.type = t, e && tt.extend(this, e), this.timeStamp = t && t.timeStamp || tt.now(), void(this[tt.expando] = !0)) : new tt.Event(t, e)
        }, tt.Event.prototype = {
            isDefaultPrevented: d,
            isPropagationStopped: d,
            isImmediatePropagationStopped: d,
            preventDefault: function() {
                var t = this.originalEvent;
                this.isDefaultPrevented = c, t && t.preventDefault && t.preventDefault()
            },
            stopPropagation: function() {
                var t = this.originalEvent;
                this.isPropagationStopped = c, t && t.stopPropagation && t.stopPropagation()
            },
            stopImmediatePropagation: function() {
                this.isImmediatePropagationStopped = c, this.stopPropagation()
            }
        }, tt.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout"
        }, function(t, e) {
            tt.event.special[t] = {
                delegateType: e,
                bindType: e,
                handle: function(t) {
                    var n, i = this,
                        s = t.relatedTarget,
                        a = t.handleObj;
                    return (!s || s !== i && !tt.contains(i, s)) && (t.type = a.origType, n = a.handler.apply(this, arguments), t.type = e), n
                }
            }
        }), G.focusinBubbles || tt.each({
            focus: "focusin",
            blur: "focusout"
        }, function(t, e) {
            var n = function(t) {
                tt.event.simulate(e, t.target, tt.event.fix(t), !0)
            };
            tt.event.special[e] = {
                setup: function() {
                    var i = this.ownerDocument || this,
                        s = vt.access(i, e);
                    s || i.addEventListener(t, n, !0), vt.access(i, e, (s || 0) + 1)
                },
                teardown: function() {
                    var i = this.ownerDocument || this,
                        s = vt.access(i, e) - 1;
                    s ? vt.access(i, e, s) : (i.removeEventListener(t, n, !0), vt.remove(i, e))
                }
            }
        }), tt.fn.extend({
            on: function(t, e, n, i, s) {
                var a, o;
                if ("object" == typeof t) {
                    "string" != typeof e && (n = n || e, e = void 0);
                    for (o in t) this.on(o, e, n, t[o], s);
                    return this
                }
                if (null == n && null == i ? (i = e, n = e = void 0) : null == i && ("string" == typeof e ? (i = n, n = void 0) : (i = n, n = e, e = void 0)), i === !1) i = d;
                else if (!i) return this;
                return 1 === s && (a = i, i = function(t) {
                    return tt().off(t), a.apply(this, arguments)
                }, i.guid = a.guid || (a.guid = tt.guid++)), this.each(function() {
                    tt.event.add(this, t, i, n, e)
                })
            },
            one: function(t, e, n, i) {
                return this.on(t, e, n, i, 1)
            },
            off: function(t, e, n) {
                var i, s;
                if (t && t.preventDefault && t.handleObj) return i = t.handleObj, tt(t.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
                if ("object" == typeof t) {
                    for (s in t) this.off(s, e, t[s]);
                    return this
                }
                return (e === !1 || "function" == typeof e) && (n = e, e = void 0), n === !1 && (n = d), this.each(function() {
                    tt.event.remove(this, t, n, e)
                })
            },
            trigger: function(t, e) {
                return this.each(function() {
                    tt.event.trigger(t, e, this)
                })
            },
            triggerHandler: function(t, e) {
                var n = this[0];
                return n ? tt.event.trigger(t, e, n, !0) : void 0
            }
        });
        var It = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
            jt = /<([\w:]+)/,
            Et = /<|&#?\w+;/,
            Dt = /<(?:script|style|link)/i,
            Pt = /checked\s*(?:[^=]|=\s*.checked.)/i,
            Nt = /^$|\/(?:java|ecma)script/i,
            Mt = /^true\/(.*)/,
            Ht = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
            zt = {
                option: [1, "<select multiple='multiple'>", "</select>"],
                thead: [1, "<table>", "</table>"],
                col: [2, "<table><colgroup>", "</colgroup></table>"],
                tr: [2, "<table><tbody>", "</tbody></table>"],
                td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
                _default: [0, "", ""]
            };
        zt.optgroup = zt.option, zt.tbody = zt.tfoot = zt.colgroup = zt.caption = zt.thead, zt.th = zt.td, tt.extend({
            clone: function(t, e, n) {
                var i, s, a, o, r = t.cloneNode(!0),
                    l = tt.contains(t.ownerDocument, t);
                if (!(G.noCloneChecked || 1 !== t.nodeType && 11 !== t.nodeType || tt.isXMLDoc(t)))
                    for (o = v(r), a = v(t), i = 0, s = a.length; s > i; i++) y(a[i], o[i]);
                if (e)
                    if (n)
                        for (a = a || v(t), o = o || v(r), i = 0, s = a.length; s > i; i++) m(a[i], o[i]);
                    else m(t, r);
                return o = v(r, "script"), o.length > 0 && g(o, !l && v(t, "script")), r
            },
            buildFragment: function(t, e, n, i) {
                for (var s, a, o, r, l, c, d = e.createDocumentFragment(), u = [], h = 0, f = t.length; f > h; h++)
                    if (s = t[h], s || 0 === s)
                        if ("object" === tt.type(s)) tt.merge(u, s.nodeType ? [s] : s);
                        else if (Et.test(s)) {
                    for (a = a || d.appendChild(e.createElement("div")), o = (jt.exec(s) || ["", ""])[1].toLowerCase(), r = zt[o] || zt._default, a.innerHTML = r[1] + s.replace(It, "<$1></$2>") + r[2], c = r[0]; c--;) a = a.lastChild;
                    tt.merge(u, a.childNodes), a = d.firstChild, a.textContent = ""
                } else u.push(e.createTextNode(s));
                for (d.textContent = "", h = 0; s = u[h++];)
                    if ((!i || -1 === tt.inArray(s, i)) && (l = tt.contains(s.ownerDocument, s), a = v(d.appendChild(s), "script"), l && g(a), n))
                        for (c = 0; s = a[c++];) Nt.test(s.type || "") && n.push(s);
                return d
            },
            cleanData: function(t) {
                for (var e, n, i, s, a, o, r = tt.event.special, l = 0; void 0 !== (n = t[l]); l++) {
                    if (tt.acceptData(n) && (a = n[vt.expando], a && (e = vt.cache[a]))) {
                        if (i = Object.keys(e.events || {}), i.length)
                            for (o = 0; void 0 !== (s = i[o]); o++) r[s] ? tt.event.remove(n, s) : tt.removeEvent(n, s, e.handle);
                        vt.cache[a] && delete vt.cache[a]
                    }
                    delete yt.cache[n[yt.expando]]
                }
            }
        }), tt.fn.extend({
            text: function(t) {
                return mt(this, function(t) {
                    return void 0 === t ? tt.text(this) : this.empty().each(function() {
                        (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && (this.textContent = t)
                    })
                }, null, t, arguments.length)
            },
            append: function() {
                return this.domManip(arguments, function(t) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var e = h(this, t);
                        e.appendChild(t)
                    }
                })
            },
            prepend: function() {
                return this.domManip(arguments, function(t) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var e = h(this, t);
                        e.insertBefore(t, e.firstChild)
                    }
                })
            },
            before: function() {
                return this.domManip(arguments, function(t) {
                    this.parentNode && this.parentNode.insertBefore(t, this)
                })
            },
            after: function() {
                return this.domManip(arguments, function(t) {
                    this.parentNode && this.parentNode.insertBefore(t, this.nextSibling)
                })
            },
            remove: function(t, e) {
                for (var n, i = t ? tt.filter(t, this) : this, s = 0; null != (n = i[s]); s++) e || 1 !== n.nodeType || tt.cleanData(v(n)), n.parentNode && (e && tt.contains(n.ownerDocument, n) && g(v(n, "script")), n.parentNode.removeChild(n));
                return this
            },
            empty: function() {
                for (var t, e = 0; null != (t = this[e]); e++) 1 === t.nodeType && (tt.cleanData(v(t, !1)), t.textContent = "");
                return this
            },
            clone: function(t, e) {
                return t = null == t ? !1 : t, e = null == e ? t : e, this.map(function() {
                    return tt.clone(this, t, e)
                })
            },
            html: function(t) {
                return mt(this, function(t) {
                    var e = this[0] || {},
                        n = 0,
                        i = this.length;
                    if (void 0 === t && 1 === e.nodeType) return e.innerHTML;
                    if ("string" == typeof t && !Dt.test(t) && !zt[(jt.exec(t) || ["", ""])[1].toLowerCase()]) {
                        t = t.replace(It, "<$1></$2>");
                        try {
                            for (; i > n; n++) e = this[n] || {}, 1 === e.nodeType && (tt.cleanData(v(e, !1)), e.innerHTML = t);
                            e = 0
                        } catch (s) {}
                    }
                    e && this.empty().append(t)
                }, null, t, arguments.length)
            },
            replaceWith: function() {
                var t = arguments[0];
                return this.domManip(arguments, function(e) {
                    t = this.parentNode, tt.cleanData(v(this)), t && t.replaceChild(e, this)
                }), t && (t.length || t.nodeType) ? this : this.remove()
            },
            detach: function(t) {
                return this.remove(t, !0)
            },
            domManip: function(t, e) {
                t = B.apply([], t);
                var n, i, s, a, o, r, l = 0,
                    c = this.length,
                    d = this,
                    u = c - 1,
                    h = t[0],
                    g = tt.isFunction(h);
                if (g || c > 1 && "string" == typeof h && !G.checkClone && Pt.test(h)) return this.each(function(n) {
                    var i = d.eq(n);
                    g && (t[0] = h.call(this, n, i.html())), i.domManip(t, e)
                });
                if (c && (n = tt.buildFragment(t, this[0].ownerDocument, !1, this), i = n.firstChild, 1 === n.childNodes.length && (n = i), i)) {
                    for (s = tt.map(v(n, "script"), f), a = s.length; c > l; l++) o = n, l !== u && (o = tt.clone(o, !0, !0), a && tt.merge(s, v(o, "script"))), e.call(this[l], o, l);
                    if (a)
                        for (r = s[s.length - 1].ownerDocument, tt.map(s, p), l = 0; a > l; l++) o = s[l], Nt.test(o.type || "") && !vt.access(o, "globalEval") && tt.contains(r, o) && (o.src ? tt._evalUrl && tt._evalUrl(o.src) : tt.globalEval(o.textContent.replace(Ht, "")))
                }
                return this
            }
        }), tt.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function(t, e) {
            tt.fn[t] = function(t) {
                for (var n, i = [], s = tt(t), a = s.length - 1, o = 0; a >= o; o++) n = o === a ? this : this.clone(!0), tt(s[o])[e](n), Q.apply(i, n.get());
                return this.pushStack(i)
            }
        });
        var qt, Wt = {},
            Ot = /^margin/,
            Lt = new RegExp("^(" + xt + ")(?!px)[a-z%]+$", "i"),
            Rt = function(t) {
                return t.ownerDocument.defaultView.getComputedStyle(t, null)
            };
        ! function() {
            function e() {
                r.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%", a.appendChild(o);
                var e = t.getComputedStyle(r, null);
                n = "1%" !== e.top, i = "4px" === e.width, a.removeChild(o)
            }
            var n, i, s = "padding:0;margin:0;border:0;display:block;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box",
                a = J.documentElement,
                o = J.createElement("div"),
                r = J.createElement("div");
            r.style.backgroundClip = "content-box", r.cloneNode(!0).style.backgroundClip = "", G.clearCloneStyle = "content-box" === r.style.backgroundClip, o.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", o.appendChild(r), t.getComputedStyle && tt.extend(G, {
                pixelPosition: function() {
                    return e(), n
                },
                boxSizingReliable: function() {
                    return null == i && e(), i
                },
                reliableMarginRight: function() {
                    var e, n = r.appendChild(J.createElement("div"));
                    return n.style.cssText = r.style.cssText = s, n.style.marginRight = n.style.width = "0", r.style.width = "1px", a.appendChild(o), e = !parseFloat(t.getComputedStyle(n, null).marginRight), a.removeChild(o), r.innerHTML = "", e
                }
            })
        }(), tt.swap = function(t, e, n, i) {
            var s, a, o = {};
            for (a in e) o[a] = t.style[a], t.style[a] = e[a];
            s = n.apply(t, i || []);
            for (a in e) t.style[a] = o[a];
            return s
        };
        var Bt = /^(none|table(?!-c[ea]).+)/,
            Qt = new RegExp("^(" + xt + ")(.*)$", "i"),
            Xt = new RegExp("^([+-])=(" + xt + ")", "i"),
            Zt = {
                position: "absolute",
                visibility: "hidden",
                display: "block"
            },
            Vt = {
                letterSpacing: 0,
                fontWeight: 400
            },
            Yt = ["Webkit", "O", "Moz", "ms"];
        tt.extend({
            cssHooks: {
                opacity: {
                    get: function(t, e) {
                        if (e) {
                            var n = x(t, "opacity");
                            return "" === n ? "1" : n
                        }
                    }
                }
            },
            cssNumber: {
                columnCount: !0,
                fillOpacity: !0,
                fontWeight: !0,
                lineHeight: !0,
                opacity: !0,
                order: !0,
                orphans: !0,
                widows: !0,
                zIndex: !0,
                zoom: !0
            },
            cssProps: {
                "float": "cssFloat"
            },
            style: function(t, e, n, i) {
                if (t && 3 !== t.nodeType && 8 !== t.nodeType && t.style) {
                    var s, a, o, r = tt.camelCase(e),
                        l = t.style;
                    return e = tt.cssProps[r] || (tt.cssProps[r] = C(l, r)), o = tt.cssHooks[e] || tt.cssHooks[r], void 0 === n ? o && "get" in o && void 0 !== (s = o.get(t, !1, i)) ? s : l[e] : (a = typeof n, "string" === a && (s = Xt.exec(n)) && (n = (s[1] + 1) * s[2] + parseFloat(tt.css(t, e)), a = "number"), void(null != n && n === n && ("number" !== a || tt.cssNumber[r] || (n += "px"), G.clearCloneStyle || "" !== n || 0 !== e.indexOf("background") || (l[e] = "inherit"), o && "set" in o && void 0 === (n = o.set(t, n, i)) || (l[e] = "", l[e] = n))))
                }
            },
            css: function(t, e, n, i) {
                var s, a, o, r = tt.camelCase(e);
                return e = tt.cssProps[r] || (tt.cssProps[r] = C(t.style, r)), o = tt.cssHooks[e] || tt.cssHooks[r], o && "get" in o && (s = o.get(t, !0, n)), void 0 === s && (s = x(t, e, i)), "normal" === s && e in Vt && (s = Vt[e]), "" === n || n ? (a = parseFloat(s), n === !0 || tt.isNumeric(a) ? a || 0 : s) : s
            }
        }), tt.each(["height", "width"], function(t, e) {
            tt.cssHooks[e] = {
                get: function(t, n, i) {
                    return n ? 0 === t.offsetWidth && Bt.test(tt.css(t, "display")) ? tt.swap(t, Zt, function() {
                        return T(t, e, i)
                    }) : T(t, e, i) : void 0
                },
                set: function(t, n, i) {
                    var s = i && Rt(t);
                    return k(t, n, i ? S(t, e, i, "border-box" === tt.css(t, "boxSizing", !1, s), s) : 0)
                }
            }
        }), tt.cssHooks.marginRight = w(G.reliableMarginRight, function(t, e) {
            return e ? tt.swap(t, {
                display: "inline-block"
            }, x, [t, "marginRight"]) : void 0
        }), tt.each({
            margin: "",
            padding: "",
            border: "Width"
        }, function(t, e) {
            tt.cssHooks[t + e] = {
                expand: function(n) {
                    for (var i = 0, s = {}, a = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++) s[t + wt[i] + e] = a[i] || a[i - 2] || a[0];
                    return s
                }
            }, Ot.test(t) || (tt.cssHooks[t + e].set = k)
        }), tt.fn.extend({
            css: function(t, e) {
                return mt(this, function(t, e, n) {
                    var i, s, a = {},
                        o = 0;
                    if (tt.isArray(e)) {
                        for (i = Rt(t), s = e.length; s > o; o++) a[e[o]] = tt.css(t, e[o], !1, i);
                        return a
                    }
                    return void 0 !== n ? tt.style(t, e, n) : tt.css(t, e)
                }, t, e, arguments.length > 1)
            },
            show: function() {
                return A(this, !0)
            },
            hide: function() {
                return A(this)
            },
            toggle: function(t) {
                return "boolean" == typeof t ? t ? this.show() : this.hide() : this.each(function() {
                    Ct(this) ? tt(this).show() : tt(this).hide()
                })
            }
        }), tt.Tween = $, $.prototype = {
            constructor: $,
            init: function(t, e, n, i, s, a) {
                this.elem = t, this.prop = n, this.easing = s || "swing", this.options = e, this.start = this.now = this.cur(), this.end = i, this.unit = a || (tt.cssNumber[n] ? "" : "px")
            },
            cur: function() {
                var t = $.propHooks[this.prop];
                return t && t.get ? t.get(this) : $.propHooks._default.get(this)
            },
            run: function(t) {
                var e, n = $.propHooks[this.prop];
                return this.pos = e = this.options.duration ? tt.easing[this.easing](t, this.options.duration * t, 0, 1, this.options.duration) : t, this.now = (this.end - this.start) * e + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : $.propHooks._default.set(this), this
            }
        }, $.prototype.init.prototype = $.prototype, $.propHooks = {
            _default: {
                get: function(t) {
                    var e;
                    return null == t.elem[t.prop] || t.elem.style && null != t.elem.style[t.prop] ? (e = tt.css(t.elem, t.prop, ""), e && "auto" !== e ? e : 0) : t.elem[t.prop]
                },
                set: function(t) {
                    tt.fx.step[t.prop] ? tt.fx.step[t.prop](t) : t.elem.style && (null != t.elem.style[tt.cssProps[t.prop]] || tt.cssHooks[t.prop]) ? tt.style(t.elem, t.prop, t.now + t.unit) : t.elem[t.prop] = t.now
                }
            }
        }, $.propHooks.scrollTop = $.propHooks.scrollLeft = {
            set: function(t) {
                t.elem.nodeType && t.elem.parentNode && (t.elem[t.prop] = t.now)
            }
        }, tt.easing = {
            linear: function(t) {
                return t
            },
            swing: function(t) {
                return .5 - Math.cos(t * Math.PI) / 2
            }
        }, tt.fx = $.prototype.init, tt.fx.step = {};
        var Ut, Gt, Jt = /^(?:toggle|show|hide)$/,
            Kt = new RegExp("^(?:([+-])=|)(" + xt + ")([a-z%]*)$", "i"),
            te = /queueHooks$/,
            ee = [E],
            ne = {
                "*": [function(t, e) {
                    var n = this.createTween(t, e),
                        i = n.cur(),
                        s = Kt.exec(e),
                        a = s && s[3] || (tt.cssNumber[t] ? "" : "px"),
                        o = (tt.cssNumber[t] || "px" !== a && +i) && Kt.exec(tt.css(n.elem, t)),
                        r = 1,
                        l = 20;
                    if (o && o[3] !== a) {
                        a = a || o[3], s = s || [], o = +i || 1;
                        do r = r || ".5", o /= r, tt.style(n.elem, t, o + a); while (r !== (r = n.cur() / i) && 1 !== r && --l)
                    }
                    return s && (o = n.start = +o || +i || 0, n.unit = a, n.end = s[1] ? o + (s[1] + 1) * s[2] : +s[2]), n
                }]
            };
        tt.Animation = tt.extend(P, {
                tweener: function(t, e) {
                    tt.isFunction(t) ? (e = t, t = ["*"]) : t = t.split(" ");
                    for (var n, i = 0, s = t.length; s > i; i++) n = t[i], ne[n] = ne[n] || [], ne[n].unshift(e)
                },
                prefilter: function(t, e) {
                    e ? ee.unshift(t) : ee.push(t)
                }
            }), tt.speed = function(t, e, n) {
                var i = t && "object" == typeof t ? tt.extend({}, t) : {
                    complete: n || !n && e || tt.isFunction(t) && t,
                    duration: t,
                    easing: n && e || e && !tt.isFunction(e) && e
                };
                return i.duration = tt.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in tt.fx.speeds ? tt.fx.speeds[i.duration] : tt.fx.speeds._default, (null == i.queue || i.queue === !0) && (i.queue = "fx"), i.old = i.complete, i.complete = function() {
                    tt.isFunction(i.old) && i.old.call(this), i.queue && tt.dequeue(this, i.queue)
                }, i
            }, tt.fn.extend({
                fadeTo: function(t, e, n, i) {
                    return this.filter(Ct).css("opacity", 0).show().end().animate({
                        opacity: e
                    }, t, n, i)
                },
                animate: function(t, e, n, i) {
                    var s = tt.isEmptyObject(t),
                        a = tt.speed(e, n, i),
                        o = function() {
                            var e = P(this, tt.extend({}, t), a);
                            (s || vt.get(this, "finish")) && e.stop(!0)
                        };
                    return o.finish = o, s || a.queue === !1 ? this.each(o) : this.queue(a.queue, o)
                },
                stop: function(t, e, n) {
                    var i = function(t) {
                        var e = t.stop;
                        delete t.stop, e(n)
                    };
                    return "string" != typeof t && (n = e, e = t, t = void 0), e && t !== !1 && this.queue(t || "fx", []), this.each(function() {
                        var e = !0,
                            s = null != t && t + "queueHooks",
                            a = tt.timers,
                            o = vt.get(this);
                        if (s) o[s] && o[s].stop && i(o[s]);
                        else
                            for (s in o) o[s] && o[s].stop && te.test(s) && i(o[s]);
                        for (s = a.length; s--;) a[s].elem !== this || null != t && a[s].queue !== t || (a[s].anim.stop(n), e = !1, a.splice(s, 1));
                        (e || !n) && tt.dequeue(this, t)
                    })
                },
                finish: function(t) {
                    return t !== !1 && (t = t || "fx"), this.each(function() {
                        var e, n = vt.get(this),
                            i = n[t + "queue"],
                            s = n[t + "queueHooks"],
                            a = tt.timers,
                            o = i ? i.length : 0;
                        for (n.finish = !0, tt.queue(this, t, []), s && s.stop && s.stop.call(this, !0), e = a.length; e--;) a[e].elem === this && a[e].queue === t && (a[e].anim.stop(!0), a.splice(e, 1));
                        for (e = 0; o > e; e++) i[e] && i[e].finish && i[e].finish.call(this);
                        delete n.finish
                    })
                }
            }), tt.each(["toggle", "show", "hide"], function(t, e) {
                var n = tt.fn[e];
                tt.fn[e] = function(t, i, s) {
                    return null == t || "boolean" == typeof t ? n.apply(this, arguments) : this.animate(I(e, !0), t, i, s)
                }
            }), tt.each({
                slideDown: I("show"),
                slideUp: I("hide"),
                slideToggle: I("toggle"),
                fadeIn: {
                    opacity: "show"
                },
                fadeOut: {
                    opacity: "hide"
                },
                fadeToggle: {
                    opacity: "toggle"
                }
            }, function(t, e) {
                tt.fn[t] = function(t, n, i) {
                    return this.animate(e, t, n, i)
                }
            }), tt.timers = [], tt.fx.tick = function() {
                var t, e = 0,
                    n = tt.timers;
                for (Ut = tt.now(); e < n.length; e++) t = n[e], t() || n[e] !== t || n.splice(e--, 1);
                n.length || tt.fx.stop(), Ut = void 0
            }, tt.fx.timer = function(t) {
                tt.timers.push(t), t() ? tt.fx.start() : tt.timers.pop()
            }, tt.fx.interval = 13, tt.fx.start = function() {
                Gt || (Gt = setInterval(tt.fx.tick, tt.fx.interval))
            }, tt.fx.stop = function() {
                clearInterval(Gt), Gt = null
            }, tt.fx.speeds = {
                slow: 600,
                fast: 200,
                _default: 400
            }, tt.fn.delay = function(t, e) {
                return t = tt.fx ? tt.fx.speeds[t] || t : t, e = e || "fx", this.queue(e, function(e, n) {
                    var i = setTimeout(e, t);
                    n.stop = function() {
                        clearTimeout(i)
                    }
                })
            },
            function() {
                var t = J.createElement("input"),
                    e = J.createElement("select"),
                    n = e.appendChild(J.createElement("option"));
                t.type = "checkbox", G.checkOn = "" !== t.value, G.optSelected = n.selected, e.disabled = !0, G.optDisabled = !n.disabled, t = J.createElement("input"), t.value = "t", t.type = "radio", G.radioValue = "t" === t.value
            }();
        var ie, se, ae = tt.expr.attrHandle;
        tt.fn.extend({
            attr: function(t, e) {
                return mt(this, tt.attr, t, e, arguments.length > 1)
            },
            removeAttr: function(t) {
                return this.each(function() {
                    tt.removeAttr(this, t)
                })
            }
        }), tt.extend({
            attr: function(t, e, n) {
                var i, s, a = t.nodeType;
                return t && 3 !== a && 8 !== a && 2 !== a ? typeof t.getAttribute === St ? tt.prop(t, e, n) : (1 === a && tt.isXMLDoc(t) || (e = e.toLowerCase(), i = tt.attrHooks[e] || (tt.expr.match.bool.test(e) ? se : ie)), void 0 === n ? i && "get" in i && null !== (s = i.get(t, e)) ? s : (s = tt.find.attr(t, e), null == s ? void 0 : s) : null !== n ? i && "set" in i && void 0 !== (s = i.set(t, n, e)) ? s : (t.setAttribute(e, n + ""), n) : void tt.removeAttr(t, e)) : void 0
            },
            removeAttr: function(t, e) {
                var n, i, s = 0,
                    a = e && e.match(ft);
                if (a && 1 === t.nodeType)
                    for (; n = a[s++];) i = tt.propFix[n] || n, tt.expr.match.bool.test(n) && (t[i] = !1), t.removeAttribute(n)
            },
            attrHooks: {
                type: {
                    set: function(t, e) {
                        if (!G.radioValue && "radio" === e && tt.nodeName(t, "input")) {
                            var n = t.value;
                            return t.setAttribute("type", e), n && (t.value = n), e
                        }
                    }
                }
            }
        }), se = {
            set: function(t, e, n) {
                return e === !1 ? tt.removeAttr(t, n) : t.setAttribute(n, n), n
            }
        }, tt.each(tt.expr.match.bool.source.match(/\w+/g), function(t, e) {
            var n = ae[e] || tt.find.attr;
            ae[e] = function(t, e, i) {
                var s, a;
                return i || (a = ae[e], ae[e] = s, s = null != n(t, e, i) ? e.toLowerCase() : null, ae[e] = a), s
            }
        });
        var oe = /^(?:input|select|textarea|button)$/i;
        tt.fn.extend({
            prop: function(t, e) {
                return mt(this, tt.prop, t, e, arguments.length > 1)
            },
            removeProp: function(t) {
                return this.each(function() {
                    delete this[tt.propFix[t] || t]
                })
            }
        }), tt.extend({
            propFix: {
                "for": "htmlFor",
                "class": "className"
            },
            prop: function(t, e, n) {
                var i, s, a, o = t.nodeType;
                return t && 3 !== o && 8 !== o && 2 !== o ? (a = 1 !== o || !tt.isXMLDoc(t), a && (e = tt.propFix[e] || e, s = tt.propHooks[e]), void 0 !== n ? s && "set" in s && void 0 !== (i = s.set(t, n, e)) ? i : t[e] = n : s && "get" in s && null !== (i = s.get(t, e)) ? i : t[e]) : void 0
            },
            propHooks: {
                tabIndex: {
                    get: function(t) {
                        return t.hasAttribute("tabindex") || oe.test(t.nodeName) || t.href ? t.tabIndex : -1
                    }
                }
            }
        }), G.optSelected || (tt.propHooks.selected = {
            get: function(t) {
                var e = t.parentNode;
                return e && e.parentNode && e.parentNode.selectedIndex, null
            }
        }), tt.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
            tt.propFix[this.toLowerCase()] = this
        });
        var re = /[\t\r\n\f]/g;
        tt.fn.extend({
            addClass: function(t) {
                var e, n, i, s, a, o, r = "string" == typeof t && t,
                    l = 0,
                    c = this.length;
                if (tt.isFunction(t)) return this.each(function(e) {
                    tt(this).addClass(t.call(this, e, this.className))
                });
                if (r)
                    for (e = (t || "").match(ft) || []; c > l; l++)
                        if (n = this[l], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(re, " ") : " ")) {
                            for (a = 0; s = e[a++];) i.indexOf(" " + s + " ") < 0 && (i += s + " ");
                            o = tt.trim(i), n.className !== o && (n.className = o)
                        }
                return this
            },
            removeClass: function(t) {
                var e, n, i, s, a, o, r = 0 === arguments.length || "string" == typeof t && t,
                    l = 0,
                    c = this.length;
                if (tt.isFunction(t)) return this.each(function(e) {
                    tt(this).removeClass(t.call(this, e, this.className))
                });
                if (r)
                    for (e = (t || "").match(ft) || []; c > l; l++)
                        if (n = this[l], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(re, " ") : "")) {
                            for (a = 0; s = e[a++];)
                                for (; i.indexOf(" " + s + " ") >= 0;) i = i.replace(" " + s + " ", " ");
                            o = t ? tt.trim(i) : "", n.className !== o && (n.className = o)
                        }
                return this
            },
            toggleClass: function(t, e) {
                var n = typeof t;
                return "boolean" == typeof e && "string" === n ? e ? this.addClass(t) : this.removeClass(t) : this.each(tt.isFunction(t) ? function(n) {
                    tt(this).toggleClass(t.call(this, n, this.className, e), e)
                } : function() {
                    if ("string" === n)
                        for (var e, i = 0, s = tt(this), a = t.match(ft) || []; e = a[i++];) s.hasClass(e) ? s.removeClass(e) : s.addClass(e);
                    else(n === St || "boolean" === n) && (this.className && vt.set(this, "__className__", this.className), this.className = this.className || t === !1 ? "" : vt.get(this, "__className__") || "")
                })
            },
            hasClass: function(t) {
                for (var e = " " + t + " ", n = 0, i = this.length; i > n; n++)
                    if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(re, " ").indexOf(e) >= 0) return !0;
                return !1
            }
        });
        var le = /\r/g;
        tt.fn.extend({
            val: function(t) {
                var e, n, i, s = this[0];
                return arguments.length ? (i = tt.isFunction(t), this.each(function(n) {
                    var s;
                    1 === this.nodeType && (s = i ? t.call(this, n, tt(this).val()) : t, null == s ? s = "" : "number" == typeof s ? s += "" : tt.isArray(s) && (s = tt.map(s, function(t) {
                        return null == t ? "" : t + ""
                    })), e = tt.valHooks[this.type] || tt.valHooks[this.nodeName.toLowerCase()], e && "set" in e && void 0 !== e.set(this, s, "value") || (this.value = s))
                })) : s ? (e = tt.valHooks[s.type] || tt.valHooks[s.nodeName.toLowerCase()], e && "get" in e && void 0 !== (n = e.get(s, "value")) ? n : (n = s.value, "string" == typeof n ? n.replace(le, "") : null == n ? "" : n)) : void 0
            }
        }), tt.extend({
            valHooks: {
                select: {
                    get: function(t) {
                        for (var e, n, i = t.options, s = t.selectedIndex, a = "select-one" === t.type || 0 > s, o = a ? null : [], r = a ? s + 1 : i.length, l = 0 > s ? r : a ? s : 0; r > l; l++)
                            if (n = i[l], !(!n.selected && l !== s || (G.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && tt.nodeName(n.parentNode, "optgroup"))) {
                                if (e = tt(n).val(), a) return e;
                                o.push(e)
                            }
                        return o
                    },
                    set: function(t, e) {
                        for (var n, i, s = t.options, a = tt.makeArray(e), o = s.length; o--;) i = s[o], (i.selected = tt.inArray(tt(i).val(), a) >= 0) && (n = !0);
                        return n || (t.selectedIndex = -1), a
                    }
                }
            }
        }), tt.each(["radio", "checkbox"], function() {
            tt.valHooks[this] = {
                set: function(t, e) {
                    return tt.isArray(e) ? t.checked = tt.inArray(tt(t).val(), e) >= 0 : void 0
                }
            }, G.checkOn || (tt.valHooks[this].get = function(t) {
                return null === t.getAttribute("value") ? "on" : t.value
            })
        }), tt.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(t, e) {
            tt.fn[e] = function(t, n) {
                return arguments.length > 0 ? this.on(e, null, t, n) : this.trigger(e)
            }
        }), tt.fn.extend({
            hover: function(t, e) {
                return this.mouseenter(t).mouseleave(e || t)
            },
            bind: function(t, e, n) {
                return this.on(t, null, e, n)
            },
            unbind: function(t, e) {
                return this.off(t, null, e)
            },
            delegate: function(t, e, n, i) {
                return this.on(e, t, n, i)
            },
            undelegate: function(t, e, n) {
                return 1 === arguments.length ? this.off(t, "**") : this.off(e, t || "**", n)
            }
        });
        var ce = tt.now(),
            de = /\?/;
        tt.parseJSON = function(t) {
            return JSON.parse(t + "")
        }, tt.parseXML = function(t) {
            var e, n;
            if (!t || "string" != typeof t) return null;
            try {
                n = new DOMParser, e = n.parseFromString(t, "text/xml")
            } catch (i) {
                e = void 0
            }
            return (!e || e.getElementsByTagName("parsererror").length) && tt.error("Invalid XML: " + t), e
        };
        var ue, he, fe = /#.*$/,
            pe = /([?&])_=[^&]*/,
            ge = /^(.*?):[ \t]*([^\r\n]*)$/gm,
            me = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
            ve = /^(?:GET|HEAD)$/,
            ye = /^\/\//,
            _e = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
            be = {},
            xe = {},
            we = "*/".concat("*");
        try {
            he = location.href
        } catch (Ce) {
            he = J.createElement("a"), he.href = "", he = he.href
        }
        ue = _e.exec(he.toLowerCase()) || [], tt.extend({
            active: 0,
            lastModified: {},
            etag: {},
            ajaxSettings: {
                url: he,
                type: "GET",
                isLocal: me.test(ue[1]),
                global: !0,
                processData: !0,
                async: !0,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                accepts: {
                    "*": we,
                    text: "text/plain",
                    html: "text/html",
                    xml: "application/xml, text/xml",
                    json: "application/json, text/javascript"
                },
                contents: {
                    xml: /xml/,
                    html: /html/,
                    json: /json/
                },
                responseFields: {
                    xml: "responseXML",
                    text: "responseText",
                    json: "responseJSON"
                },
                converters: {
                    "* text": String,
                    "text html": !0,
                    "text json": tt.parseJSON,
                    "text xml": tt.parseXML
                },
                flatOptions: {
                    url: !0,
                    context: !0
                }
            },
            ajaxSetup: function(t, e) {
                return e ? H(H(t, tt.ajaxSettings), e) : H(tt.ajaxSettings, t)
            },
            ajaxPrefilter: N(be),
            ajaxTransport: N(xe),
            ajax: function(t, e) {
                function n(t, e, n, o) {
                    var l, d, v, y, b, w = e;
                    2 !== _ && (_ = 2, r && clearTimeout(r), i = void 0, a = o || "", x.readyState = t > 0 ? 4 : 0, l = t >= 200 && 300 > t || 304 === t, n && (y = z(u, x, n)), y = q(u, y, x, l), l ? (u.ifModified && (b = x.getResponseHeader("Last-Modified"), b && (tt.lastModified[s] = b), b = x.getResponseHeader("etag"), b && (tt.etag[s] = b)), 204 === t || "HEAD" === u.type ? w = "nocontent" : 304 === t ? w = "notmodified" : (w = y.state, d = y.data, v = y.error, l = !v)) : (v = w, (t || !w) && (w = "error", 0 > t && (t = 0))), x.status = t, x.statusText = (e || w) + "", l ? p.resolveWith(h, [d, w, x]) : p.rejectWith(h, [x, w, v]), x.statusCode(m), m = void 0, c && f.trigger(l ? "ajaxSuccess" : "ajaxError", [x, u, l ? d : v]), g.fireWith(h, [x, w]), c && (f.trigger("ajaxComplete", [x, u]), --tt.active || tt.event.trigger("ajaxStop")))
                }
                "object" == typeof t && (e = t, t = void 0), e = e || {};
                var i, s, a, o, r, l, c, d, u = tt.ajaxSetup({}, e),
                    h = u.context || u,
                    f = u.context && (h.nodeType || h.jquery) ? tt(h) : tt.event,
                    p = tt.Deferred(),
                    g = tt.Callbacks("once memory"),
                    m = u.statusCode || {},
                    v = {},
                    y = {},
                    _ = 0,
                    b = "canceled",
                    x = {
                        readyState: 0,
                        getResponseHeader: function(t) {
                            var e;
                            if (2 === _) {
                                if (!o)
                                    for (o = {}; e = ge.exec(a);) o[e[1].toLowerCase()] = e[2];
                                e = o[t.toLowerCase()]
                            }
                            return null == e ? null : e
                        },
                        getAllResponseHeaders: function() {
                            return 2 === _ ? a : null
                        },
                        setRequestHeader: function(t, e) {
                            var n = t.toLowerCase();
                            return _ || (t = y[n] = y[n] || t, v[t] = e), this
                        },
                        overrideMimeType: function(t) {
                            return _ || (u.mimeType = t), this
                        },
                        statusCode: function(t) {
                            var e;
                            if (t)
                                if (2 > _)
                                    for (e in t) m[e] = [m[e], t[e]];
                                else x.always(t[x.status]);
                            return this
                        },
                        abort: function(t) {
                            var e = t || b;
                            return i && i.abort(e), n(0, e), this
                        }
                    };
                if (p.promise(x).complete = g.add, x.success = x.done, x.error = x.fail, u.url = ((t || u.url || he) + "").replace(fe, "").replace(ye, ue[1] + "//"), u.type = e.method || e.type || u.method || u.type, u.dataTypes = tt.trim(u.dataType || "*").toLowerCase().match(ft) || [""], null == u.crossDomain && (l = _e.exec(u.url.toLowerCase()), u.crossDomain = !(!l || l[1] === ue[1] && l[2] === ue[2] && (l[3] || ("http:" === l[1] ? "80" : "443")) === (ue[3] || ("http:" === ue[1] ? "80" : "443")))), u.data && u.processData && "string" != typeof u.data && (u.data = tt.param(u.data, u.traditional)), M(be, u, e, x), 2 === _) return x;
                c = u.global, c && 0 === tt.active++ && tt.event.trigger("ajaxStart"), u.type = u.type.toUpperCase(), u.hasContent = !ve.test(u.type), s = u.url, u.hasContent || (u.data && (s = u.url += (de.test(s) ? "&" : "?") + u.data, delete u.data), u.cache === !1 && (u.url = pe.test(s) ? s.replace(pe, "$1_=" + ce++) : s + (de.test(s) ? "&" : "?") + "_=" + ce++)), u.ifModified && (tt.lastModified[s] && x.setRequestHeader("If-Modified-Since", tt.lastModified[s]), tt.etag[s] && x.setRequestHeader("If-None-Match", tt.etag[s])), (u.data && u.hasContent && u.contentType !== !1 || e.contentType) && x.setRequestHeader("Content-Type", u.contentType), x.setRequestHeader("Accept", u.dataTypes[0] && u.accepts[u.dataTypes[0]] ? u.accepts[u.dataTypes[0]] + ("*" !== u.dataTypes[0] ? ", " + we + "; q=0.01" : "") : u.accepts["*"]);
                for (d in u.headers) x.setRequestHeader(d, u.headers[d]);
                if (u.beforeSend && (u.beforeSend.call(h, x, u) === !1 || 2 === _)) return x.abort();
                b = "abort";
                for (d in {
                        success: 1,
                        error: 1,
                        complete: 1
                    }) x[d](u[d]);
                if (i = M(xe, u, e, x)) {
                    x.readyState = 1, c && f.trigger("ajaxSend", [x, u]), u.async && u.timeout > 0 && (r = setTimeout(function() {
                        x.abort("timeout")
                    }, u.timeout));
                    try {
                        _ = 1, i.send(v, n)
                    } catch (w) {
                        if (!(2 > _)) throw w;
                        n(-1, w)
                    }
                } else n(-1, "No Transport");
                return x
            },
            getJSON: function(t, e, n) {
                return tt.get(t, e, n, "json")
            },
            getScript: function(t, e) {
                return tt.get(t, void 0, e, "script")
            }
        }), tt.each(["get", "post"], function(t, e) {
            tt[e] = function(t, n, i, s) {
                return tt.isFunction(n) && (s = s || i, i = n, n = void 0), tt.ajax({
                    url: t,
                    type: e,
                    dataType: s,
                    data: n,
                    success: i
                })
            }
        }), tt.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(t, e) {
            tt.fn[e] = function(t) {
                return this.on(e, t)
            }
        }), tt._evalUrl = function(t) {
            return tt.ajax({
                url: t,
                type: "GET",
                dataType: "script",
                async: !1,
                global: !1,
                "throws": !0
            })
        }, tt.fn.extend({
            wrapAll: function(t) {
                var e;
                return tt.isFunction(t) ? this.each(function(e) {
                    tt(this).wrapAll(t.call(this, e))
                }) : (this[0] && (e = tt(t, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && e.insertBefore(this[0]), e.map(function() {
                    for (var t = this; t.firstElementChild;) t = t.firstElementChild;
                    return t
                }).append(this)), this)
            },
            wrapInner: function(t) {
                return this.each(tt.isFunction(t) ? function(e) {
                    tt(this).wrapInner(t.call(this, e))
                } : function() {
                    var e = tt(this),
                        n = e.contents();
                    n.length ? n.wrapAll(t) : e.append(t)
                })
            },
            wrap: function(t) {
                var e = tt.isFunction(t);
                return this.each(function(n) {
                    tt(this).wrapAll(e ? t.call(this, n) : t)
                })
            },
            unwrap: function() {
                return this.parent().each(function() {
                    tt.nodeName(this, "body") || tt(this).replaceWith(this.childNodes)
                }).end()
            }
        }), tt.expr.filters.hidden = function(t) {
            return t.offsetWidth <= 0 && t.offsetHeight <= 0
        }, tt.expr.filters.visible = function(t) {
            return !tt.expr.filters.hidden(t)
        };
        var ke = /%20/g,
            Se = /\[\]$/,
            Te = /\r?\n/g,
            Ae = /^(?:submit|button|image|reset|file)$/i,
            $e = /^(?:input|select|textarea|keygen)/i;
        tt.param = function(t, e) {
            var n, i = [],
                s = function(t, e) {
                    e = tt.isFunction(e) ? e() : null == e ? "" : e, i[i.length] = encodeURIComponent(t) + "=" + encodeURIComponent(e)
                };
            if (void 0 === e && (e = tt.ajaxSettings && tt.ajaxSettings.traditional), tt.isArray(t) || t.jquery && !tt.isPlainObject(t)) tt.each(t, function() {
                s(this.name, this.value)
            });
            else
                for (n in t) W(n, t[n], e, s);
            return i.join("&").replace(ke, "+")
        }, tt.fn.extend({
            serialize: function() {
                return tt.param(this.serializeArray())
            },
            serializeArray: function() {
                return this.map(function() {
                    var t = tt.prop(this, "elements");
                    return t ? tt.makeArray(t) : this
                }).filter(function() {
                    var t = this.type;
                    return this.name && !tt(this).is(":disabled") && $e.test(this.nodeName) && !Ae.test(t) && (this.checked || !kt.test(t))
                }).map(function(t, e) {
                    var n = tt(this).val();
                    return null == n ? null : tt.isArray(n) ? tt.map(n, function(t) {
                        return {
                            name: e.name,
                            value: t.replace(Te, "\r\n")
                        }
                    }) : {
                        name: e.name,
                        value: n.replace(Te, "\r\n")
                    }
                }).get()
            }
        }), tt.ajaxSettings.xhr = function() {
            try {
                return new XMLHttpRequest
            } catch (t) {}
        };
        var Fe = 0,
            Ie = {},
            je = {
                0: 200,
                1223: 204
            },
            Ee = tt.ajaxSettings.xhr();
        t.ActiveXObject && tt(t).on("unload", function() {
            for (var t in Ie) Ie[t]()
        }), G.cors = !!Ee && "withCredentials" in Ee, G.ajax = Ee = !!Ee, tt.ajaxTransport(function(t) {
            var e;
            return G.cors || Ee && !t.crossDomain ? {
                send: function(n, i) {
                    var s, a = t.xhr(),
                        o = ++Fe;
                    if (a.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)
                        for (s in t.xhrFields) a[s] = t.xhrFields[s];
                    t.mimeType && a.overrideMimeType && a.overrideMimeType(t.mimeType), t.crossDomain || n["X-Requested-With"] || (n["X-Requested-With"] = "XMLHttpRequest");
                    for (s in n) a.setRequestHeader(s, n[s]);
                    e = function(t) {
                        return function() {
                            e && (delete Ie[o], e = a.onload = a.onerror = null, "abort" === t ? a.abort() : "error" === t ? i(a.status, a.statusText) : i(je[a.status] || a.status, a.statusText, "string" == typeof a.responseText ? {
                                text: a.responseText
                            } : void 0, a.getAllResponseHeaders()))
                        }
                    }, a.onload = e(), a.onerror = e("error"), e = Ie[o] = e("abort"), a.send(t.hasContent && t.data || null)
                },
                abort: function() {
                    e && e()
                }
            } : void 0
        }), tt.ajaxSetup({
            accepts: {
                script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
            },
            contents: {
                script: /(?:java|ecma)script/
            },
            converters: {
                "text script": function(t) {
                    return tt.globalEval(t), t
                }
            }
        }), tt.ajaxPrefilter("script", function(t) {
            void 0 === t.cache && (t.cache = !1), t.crossDomain && (t.type = "GET")
        }), tt.ajaxTransport("script", function(t) {
            if (t.crossDomain) {
                var e, n;
                return {
                    send: function(i, s) {
                        e = tt("<script>").prop({
                            async: !0,
                            charset: t.scriptCharset,
                            src: t.url
                        }).on("load error", n = function(t) {
                            e.remove(), n = null, t && s("error" === t.type ? 404 : 200, t.type)
                        }), J.head.appendChild(e[0])
                    },
                    abort: function() {
                        n && n()
                    }
                }
            }
        });
        var De = [],
            Pe = /(=)\?(?=&|$)|\?\?/;
        tt.ajaxSetup({
            jsonp: "callback",
            jsonpCallback: function() {
                var t = De.pop() || tt.expando + "_" + ce++;
                return this[t] = !0, t
            }
        }), tt.ajaxPrefilter("json jsonp", function(e, n, i) {
            var s, a, o, r = e.jsonp !== !1 && (Pe.test(e.url) ? "url" : "string" == typeof e.data && !(e.contentType || "").indexOf("application/x-www-form-urlencoded") && Pe.test(e.data) && "data");
            return r || "jsonp" === e.dataTypes[0] ? (s = e.jsonpCallback = tt.isFunction(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, r ? e[r] = e[r].replace(Pe, "$1" + s) : e.jsonp !== !1 && (e.url += (de.test(e.url) ? "&" : "?") + e.jsonp + "=" + s), e.converters["script json"] = function() {
                return o || tt.error(s + " was not called"), o[0]
            }, e.dataTypes[0] = "json", a = t[s], t[s] = function() {
                o = arguments
            }, i.always(function() {
                t[s] = a, e[s] && (e.jsonpCallback = n.jsonpCallback, De.push(s)), o && tt.isFunction(a) && a(o[0]), o = a = void 0
            }), "script") : void 0
        }), tt.parseHTML = function(t, e, n) {
            if (!t || "string" != typeof t) return null;
            "boolean" == typeof e && (n = e, e = !1), e = e || J;
            var i = ot.exec(t),
                s = !n && [];
            return i ? [e.createElement(i[1])] : (i = tt.buildFragment([t], e, s), s && s.length && tt(s).remove(), tt.merge([], i.childNodes))
        };
        var Ne = tt.fn.load;
        tt.fn.load = function(t, e, n) {
            if ("string" != typeof t && Ne) return Ne.apply(this, arguments);
            var i, s, a, o = this,
                r = t.indexOf(" ");
            return r >= 0 && (i = t.slice(r), t = t.slice(0, r)), tt.isFunction(e) ? (n = e, e = void 0) : e && "object" == typeof e && (s = "POST"), o.length > 0 && tt.ajax({
                url: t,
                type: s,
                dataType: "html",
                data: e
            }).done(function(t) {
                a = arguments, o.html(i ? tt("<div>").append(tt.parseHTML(t)).find(i) : t)
            }).complete(n && function(t, e) {
                o.each(n, a || [t.responseText, e, t])
            }), this
        }, tt.expr.filters.animated = function(t) {
            return tt.grep(tt.timers, function(e) {
                return t === e.elem
            }).length
        };
        var Me = t.document.documentElement;
        tt.offset = {
            setOffset: function(t, e, n) {
                var i, s, a, o, r, l, c, d = tt.css(t, "position"),
                    u = tt(t),
                    h = {};
                "static" === d && (t.style.position = "relative"), r = u.offset(), a = tt.css(t, "top"), l = tt.css(t, "left"), c = ("absolute" === d || "fixed" === d) && (a + l).indexOf("auto") > -1, c ? (i = u.position(), o = i.top, s = i.left) : (o = parseFloat(a) || 0, s = parseFloat(l) || 0), tt.isFunction(e) && (e = e.call(t, n, r)), null != e.top && (h.top = e.top - r.top + o), null != e.left && (h.left = e.left - r.left + s), "using" in e ? e.using.call(t, h) : u.css(h)
            }
        }, tt.fn.extend({
            offset: function(t) {
                if (arguments.length) return void 0 === t ? this : this.each(function(e) {
                    tt.offset.setOffset(this, t, e)
                });
                var e, n, i = this[0],
                    s = {
                        top: 0,
                        left: 0
                    },
                    a = i && i.ownerDocument;
                return a ? (e = a.documentElement, tt.contains(e, i) ? (typeof i.getBoundingClientRect !== St && (s = i.getBoundingClientRect()), n = O(a), {
                    top: s.top + n.pageYOffset - e.clientTop,
                    left: s.left + n.pageXOffset - e.clientLeft
                }) : s) : void 0
            },
            position: function() {
                if (this[0]) {
                    var t, e, n = this[0],
                        i = {
                            top: 0,
                            left: 0
                        };
                    return "fixed" === tt.css(n, "position") ? e = n.getBoundingClientRect() : (t = this.offsetParent(), e = this.offset(), tt.nodeName(t[0], "html") || (i = t.offset()), i.top += tt.css(t[0], "borderTopWidth", !0), i.left += tt.css(t[0], "borderLeftWidth", !0)), {
                        top: e.top - i.top - tt.css(n, "marginTop", !0),
                        left: e.left - i.left - tt.css(n, "marginLeft", !0)
                    }
                }
            },
            offsetParent: function() {
                return this.map(function() {
                    for (var t = this.offsetParent || Me; t && !tt.nodeName(t, "html") && "static" === tt.css(t, "position");) t = t.offsetParent;
                    return t || Me
                })
            }
        }), tt.each({
            scrollLeft: "pageXOffset",
            scrollTop: "pageYOffset"
        }, function(e, n) {
            var i = "pageYOffset" === n;
            tt.fn[e] = function(s) {
                return mt(this, function(e, s, a) {
                    var o = O(e);
                    return void 0 === a ? o ? o[n] : e[s] : void(o ? o.scrollTo(i ? t.pageXOffset : a, i ? a : t.pageYOffset) : e[s] = a)
                }, e, s, arguments.length, null)
            }
        }), tt.each(["top", "left"], function(t, e) {
            tt.cssHooks[e] = w(G.pixelPosition, function(t, n) {
                return n ? (n = x(t, e), Lt.test(n) ? tt(t).position()[e] + "px" : n) : void 0
            })
        }), tt.each({
            Height: "height",
            Width: "width"
        }, function(t, e) {
            tt.each({
                padding: "inner" + t,
                content: e,
                "": "outer" + t
            }, function(n, i) {
                tt.fn[i] = function(i, s) {
                    var a = arguments.length && (n || "boolean" != typeof i),
                        o = n || (i === !0 || s === !0 ? "margin" : "border");
                    return mt(this, function(e, n, i) {
                        var s;
                        return tt.isWindow(e) ? e.document.documentElement["client" + t] : 9 === e.nodeType ? (s = e.documentElement, Math.max(e.body["scroll" + t], s["scroll" + t], e.body["offset" + t], s["offset" + t], s["client" + t])) : void 0 === i ? tt.css(e, n, o) : tt.style(e, n, i, o);
                    }, e, a ? i : void 0, a, null)
                }
            })
        }), tt.fn.size = function() {
            return this.length
        }, tt.fn.andSelf = tt.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
            return tt
        });
        var He = t.jQuery,
            ze = t.$;
        return tt.noConflict = function(e) {
            return t.$ === tt && (t.$ = ze), e && t.jQuery === tt && (t.jQuery = He), tt
        }, typeof e === St && (t.jQuery = t.$ = tt), tt
    }), void 0 === jQuery.migrateMute && (jQuery.migrateMute = !0),
    function(t, e, n) {
        function i(n) {
            var i = e.console;
            a[n] || (a[n] = !0, t.migrateWarnings.push(n), i && i.warn && !t.migrateMute && (i.warn("JQMIGRATE: " + n), t.migrateTrace && i.trace && i.trace()))
        }

        function s(e, s, a, o) {
            if (Object.defineProperty) try {
                return Object.defineProperty(e, s, {
                    configurable: !0,
                    enumerable: !0,
                    get: function() {
                        return i(o), a
                    },
                    set: function(t) {
                        i(o), a = t
                    }
                }), n
            } catch (r) {}
            t._definePropertyBroken = !0, e[s] = a
        }
        var a = {};
        t.migrateWarnings = [], !t.migrateMute && e.console && e.console.log && e.console.log("JQMIGRATE: Logging is active"), t.migrateTrace === n && (t.migrateTrace = !0), t.migrateReset = function() {
            a = {}, t.migrateWarnings.length = 0
        }, "BackCompat" === document.compatMode && i("jQuery is not compatible with Quirks Mode");
        var o = t("<input/>", {
                size: 1
            }).attr("size") && t.attrFn,
            r = t.attr,
            l = t.attrHooks.value && t.attrHooks.value.get || function() {
                return null
            },
            c = t.attrHooks.value && t.attrHooks.value.set || function() {
                return n
            },
            d = /^(?:input|button)$/i,
            u = /^[238]$/,
            h = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
            f = /^(?:checked|selected)$/i;
        s(t, "attrFn", o || {}, "jQuery.attrFn is deprecated"), t.attr = function(e, s, a, l) {
            var c = s.toLowerCase(),
                p = e && e.nodeType;
            return l && (4 > r.length && i("jQuery.fn.attr( props, pass ) is deprecated"), e && !u.test(p) && (o ? s in o : t.isFunction(t.fn[s]))) ? t(e)[s](a) : ("type" === s && a !== n && d.test(e.nodeName) && e.parentNode && i("Can't change the 'type' of an input or button in IE 6/7/8"), !t.attrHooks[c] && h.test(c) && (t.attrHooks[c] = {
                get: function(e, i) {
                    var s, a = t.prop(e, i);
                    return a === !0 || "boolean" != typeof a && (s = e.getAttributeNode(i)) && s.nodeValue !== !1 ? i.toLowerCase() : n
                },
                set: function(e, n, i) {
                    var s;
                    return n === !1 ? t.removeAttr(e, i) : (s = t.propFix[i] || i, s in e && (e[s] = !0), e.setAttribute(i, i.toLowerCase())), i
                }
            }, f.test(c) && i("jQuery.fn.attr('" + c + "') may use property instead of attribute")), r.call(t, e, s, a))
        }, t.attrHooks.value = {
            get: function(t, e) {
                var n = (t.nodeName || "").toLowerCase();
                return "button" === n ? l.apply(this, arguments) : ("input" !== n && "option" !== n && i("jQuery.fn.attr('value') no longer gets properties"), e in t ? t.value : null)
            },
            set: function(t, e) {
                var s = (t.nodeName || "").toLowerCase();
                return "button" === s ? c.apply(this, arguments) : ("input" !== s && "option" !== s && i("jQuery.fn.attr('value', val) no longer sets properties"), t.value = e, n)
            }
        };
        var p, g, m = t.fn.init,
            v = t.parseJSON,
            y = /^([^<]*)(<[\w\W]+>)([^>]*)$/;
        t.fn.init = function(e, n, s) {
            var a;
            return e && "string" == typeof e && !t.isPlainObject(n) && (a = y.exec(t.trim(e))) && a[0] && ("<" !== e.charAt(0) && i("$(html) HTML strings must start with '<' character"), a[3] && i("$(html) HTML text after last tag is ignored"), "#" === a[0].charAt(0) && (i("HTML string cannot start with a '#' character"), t.error("JQMIGRATE: Invalid selector string (XSS)")), n && n.context && (n = n.context), t.parseHTML) ? m.call(this, t.parseHTML(a[2], n, !0), n, s) : m.apply(this, arguments)
        }, t.fn.init.prototype = t.fn, t.parseJSON = function(t) {
            return t || null === t ? v.apply(this, arguments) : (i("jQuery.parseJSON requires a valid JSON string"), null)
        }, t.uaMatch = function(t) {
            t = t.toLowerCase();
            var e = /(chrome)[ \/]([\w.]+)/.exec(t) || /(webkit)[ \/]([\w.]+)/.exec(t) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(t) || /(msie) ([\w.]+)/.exec(t) || 0 > t.indexOf("compatible") && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(t) || [];
            return {
                browser: e[1] || "",
                version: e[2] || "0"
            }
        }, t.browser || (p = t.uaMatch(navigator.userAgent), g = {}, p.browser && (g[p.browser] = !0, g.version = p.version), g.chrome ? g.webkit = !0 : g.webkit && (g.safari = !0), t.browser = g), s(t, "browser", t.browser, "jQuery.browser is deprecated"), t.sub = function() {
            function e(t, n) {
                return new e.fn.init(t, n)
            }
            t.extend(!0, e, this), e.superclass = this, e.fn = e.prototype = this(), e.fn.constructor = e, e.sub = this.sub, e.fn.init = function(i, s) {
                return s && s instanceof t && !(s instanceof e) && (s = e(s)), t.fn.init.call(this, i, s, n)
            }, e.fn.init.prototype = e.fn;
            var n = e(document);
            return i("jQuery.sub() is deprecated"), e
        }, t.ajaxSetup({
            converters: {
                "text json": t.parseJSON
            }
        });
        var _ = t.fn.data;
        t.fn.data = function(e) {
            var s, a, o = this[0];
            return !o || "events" !== e || 1 !== arguments.length || (s = t.data(o, e), a = t._data(o, e), s !== n && s !== a || a === n) ? _.apply(this, arguments) : (i("Use of jQuery.fn.data('events') is deprecated"), a)
        };
        var b = /\/(java|ecma)script/i,
            x = t.fn.andSelf || t.fn.addBack;
        t.fn.andSelf = function() {
            return i("jQuery.fn.andSelf() replaced by jQuery.fn.addBack()"), x.apply(this, arguments)
        }, t.clean || (t.clean = function(e, s, a, o) {
            s = s || document, s = !s.nodeType && s[0] || s, s = s.ownerDocument || s, i("jQuery.clean() is deprecated");
            var r, l, c, d, u = [];
            if (t.merge(u, t.buildFragment(e, s).childNodes), a)
                for (c = function(t) {
                        return !t.type || b.test(t.type) ? o ? o.push(t.parentNode ? t.parentNode.removeChild(t) : t) : a.appendChild(t) : n
                    }, r = 0; null != (l = u[r]); r++) t.nodeName(l, "script") && c(l) || (a.appendChild(l), l.getElementsByTagName !== n && (d = t.grep(t.merge([], l.getElementsByTagName("script")), c), u.splice.apply(u, [r + 1, 0].concat(d)), r += d.length));
            return u
        });
        var w = t.event.add,
            C = t.event.remove,
            k = t.event.trigger,
            S = t.fn.toggle,
            T = t.fn.live,
            A = t.fn.die,
            $ = "ajaxStart|ajaxStop|ajaxSend|ajaxComplete|ajaxError|ajaxSuccess",
            F = RegExp("\\b(?:" + $ + ")\\b"),
            I = /(?:^|\s)hover(\.\S+|)\b/,
            j = function(e) {
                return "string" != typeof e || t.event.special.hover ? e : (I.test(e) && i("'hover' pseudo-event is deprecated, use 'mouseenter mouseleave'"), e && e.replace(I, "mouseenter$1 mouseleave$1"))
            };
        t.event.props && "attrChange" !== t.event.props[0] && t.event.props.unshift("attrChange", "attrName", "relatedNode", "srcElement"), t.event.dispatch && s(t.event, "handle", t.event.dispatch, "jQuery.event.handle is undocumented and deprecated"), t.event.add = function(t, e, n, s, a) {
            t !== document && F.test(e) && i("AJAX events should be attached to document: " + e), w.call(this, t, j(e || ""), n, s, a)
        }, t.event.remove = function(t, e, n, i, s) {
            C.call(this, t, j(e) || "", n, i, s)
        }, t.fn.error = function() {
            var t = Array.prototype.slice.call(arguments, 0);
            return i("jQuery.fn.error() is deprecated"), t.splice(0, 0, "error"), arguments.length ? this.bind.apply(this, t) : (this.triggerHandler.apply(this, t), this)
        }, t.fn.toggle = function(e, n) {
            if (!t.isFunction(e) || !t.isFunction(n)) return S.apply(this, arguments);
            i("jQuery.fn.toggle(handler, handler...) is deprecated");
            var s = arguments,
                a = e.guid || t.guid++,
                o = 0,
                r = function(n) {
                    var i = (t._data(this, "lastToggle" + e.guid) || 0) % o;
                    return t._data(this, "lastToggle" + e.guid, i + 1), n.preventDefault(), s[i].apply(this, arguments) || !1
                };
            for (r.guid = a; s.length > o;) s[o++].guid = a;
            return this.click(r)
        }, t.fn.live = function(e, n, s) {
            return i("jQuery.fn.live() is deprecated"), T ? T.apply(this, arguments) : (t(this.context).on(e, this.selector, n, s), this)
        }, t.fn.die = function(e, n) {
            return i("jQuery.fn.die() is deprecated"), A ? A.apply(this, arguments) : (t(this.context).off(e, this.selector || "**", n), this)
        }, t.event.trigger = function(t, e, n, s) {
            return n || F.test(t) || i("Global events are undocumented and deprecated"), k.call(this, t, e, n || document, s)
        }, t.each($.split("|"), function(e, n) {
            t.event.special[n] = {
                setup: function() {
                    var e = this;
                    return e !== document && (t.event.add(document, n + "." + t.guid, function() {
                        t.event.trigger(n, null, e, !0)
                    }), t._data(this, n, t.guid++)), !1
                },
                teardown: function() {
                    return this !== document && t.event.remove(document, n + "." + t._data(this, n)), !1
                }
            }
        })
    }(jQuery, window),
    function(t, e, n, i) {
        "use strict";

        function s(t) {
            return ("string" == typeof t || t instanceof String) && (t = t.replace(/^['\\/"]+|(;\s?})+|['\\/"]+$/g, "")), t
        }
        var a = function(e) {
            for (var n = e.length, i = t("head"); n--;) 0 === i.has("." + e[n]).length && i.append('<meta class="' + e[n] + '" />')
        };
        a(["foundation-mq-small", "foundation-mq-medium", "foundation-mq-large", "foundation-mq-xlarge", "foundation-mq-xxlarge", "foundation-data-attribute-namespace"]), t(function() {
            "undefined" != typeof FastClick && "undefined" != typeof n.body && FastClick.attach(n.body)
        });
        var o = function(e, i) {
                if ("string" == typeof e) {
                    if (i) {
                        var s;
                        if (i.jquery) {
                            if (s = i[0], !s) return i
                        } else s = i;
                        return t(s.querySelectorAll(e))
                    }
                    return t(n.querySelectorAll(e))
                }
                return t(e, i)
            },
            r = function(t) {
                var e = [];
                return t || e.push("data"), this.namespace.length > 0 && e.push(this.namespace), e.push(this.name), e.join("-")
            },
            l = function(t) {
                for (var e = t.split("-"), n = e.length, i = []; n--;) 0 !== n ? i.push(e[n]) : this.namespace.length > 0 ? i.push(this.namespace, e[n]) : i.push(e[n]);
                return i.reverse().join("-")
            },
            c = function(e, n) {
                var i = this,
                    s = !o(this).data(this.attr_name(!0));
                return "string" == typeof e ? this[e].call(this, n) : void(o(this.scope).is("[" + this.attr_name() + "]") ? (o(this.scope).data(this.attr_name(!0) + "-init", t.extend({}, this.settings, n || e, this.data_options(o(this.scope)))), s && this.events(this.scope)) : o("[" + this.attr_name() + "]", this.scope).each(function() {
                    var s = !o(this).data(i.attr_name(!0) + "-init");
                    o(this).data(i.attr_name(!0) + "-init", t.extend({}, i.settings, n || e, i.data_options(o(this)))), s && i.events(this)
                }))
            },
            d = function(t, e) {
                function n() {
                    e(t[0])
                }

                function i() {
                    if (this.one("load", n), /MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
                        var t = this.attr("src"),
                            e = t.match(/\?/) ? "&" : "?";
                        e += "random=" + (new Date).getTime(), this.attr("src", t + e)
                    }
                }
                return t.attr("src") ? void(t[0].complete || 4 === t[0].readyState ? n() : i.call(t)) : void n()
            };
        e.matchMedia = e.matchMedia || function(t) {
                var e, n = t.documentElement,
                    i = n.firstElementChild || n.firstChild,
                    s = t.createElement("body"),
                    a = t.createElement("div");
                return a.id = "mq-test-1", a.style.cssText = "position:absolute;top:-100em", s.style.background = "none", s.appendChild(a),
                    function(t) {
                        return a.innerHTML = '&shy;<style media="' + t + '"> #mq-test-1 { width: 42px; }</style>', n.insertBefore(s, i), e = 42 === a.offsetWidth, n.removeChild(s), {
                            matches: e,
                            media: t
                        }
                    }
            }(n),
            function(t) {
                function n() {
                    i && (o(n), l && jQuery.fx.tick())
                }
                for (var i, s = 0, a = ["webkit", "moz"], o = e.requestAnimationFrame, r = e.cancelAnimationFrame, l = "undefined" != typeof jQuery.fx; s < a.length && !o; s++) o = e[a[s] + "RequestAnimationFrame"], r = r || e[a[s] + "CancelAnimationFrame"] || e[a[s] + "CancelRequestAnimationFrame"];
                o ? (e.requestAnimationFrame = o, e.cancelAnimationFrame = r, l && (jQuery.fx.timer = function(t) {
                    t() && jQuery.timers.push(t) && !i && (i = !0, n())
                }, jQuery.fx.stop = function() {
                    i = !1
                })) : (e.requestAnimationFrame = function(t) {
                    var n = (new Date).getTime(),
                        i = Math.max(0, 16 - (n - s)),
                        a = e.setTimeout(function() {
                            t(n + i)
                        }, i);
                    return s = n + i, a
                }, e.cancelAnimationFrame = function(t) {
                    clearTimeout(t)
                })
            }(jQuery), e.Foundation = {
                name: "Foundation",
                version: "5.2.2",
                media_queries: {
                    small: o(".foundation-mq-small").css("font-family").replace(/^[\/\\'"]+|(;\s?})+|[\/\\'"]+$/g, ""),
                    medium: o(".foundation-mq-medium").css("font-family").replace(/^[\/\\'"]+|(;\s?})+|[\/\\'"]+$/g, ""),
                    large: o(".foundation-mq-large").css("font-family").replace(/^[\/\\'"]+|(;\s?})+|[\/\\'"]+$/g, ""),
                    xlarge: o(".foundation-mq-xlarge").css("font-family").replace(/^[\/\\'"]+|(;\s?})+|[\/\\'"]+$/g, ""),
                    xxlarge: o(".foundation-mq-xxlarge").css("font-family").replace(/^[\/\\'"]+|(;\s?})+|[\/\\'"]+$/g, "")
                },
                stylesheet: t("<style></style>").appendTo("head")[0].sheet,
                global: {
                    namespace: i
                },
                init: function(t, e, n, i, s) {
                    var a = [t, n, i, s],
                        r = [];
                    if (this.rtl = /rtl/i.test(o("html").attr("dir")), this.scope = t || this.scope, this.set_namespace(), e && "string" == typeof e && !/reflow/i.test(e)) this.libs.hasOwnProperty(e) && r.push(this.init_lib(e, a));
                    else
                        for (var l in this.libs) r.push(this.init_lib(l, e));
                    return t
                },
                init_lib: function(e, n) {
                    return this.libs.hasOwnProperty(e) ? (this.patch(this.libs[e]), n && n.hasOwnProperty(e) ? ("undefined" != typeof this.libs[e].settings ? t.extend(!0, this.libs[e].settings, n[e]) : "undefined" != typeof this.libs[e].defaults && t.extend(!0, this.libs[e].defaults, n[e]), this.libs[e].init.apply(this.libs[e], [this.scope, n[e]])) : (n = n instanceof Array ? n : new Array(n), this.libs[e].init.apply(this.libs[e], n))) : function() {}
                },
                patch: function(t) {
                    t.scope = this.scope, t.namespace = this.global.namespace, t.rtl = this.rtl, t.data_options = this.utils.data_options, t.attr_name = r, t.add_namespace = l, t.bindings = c, t.S = this.utils.S
                },
                inherit: function(t, e) {
                    for (var n = e.split(" "), i = n.length; i--;) this.utils.hasOwnProperty(n[i]) && (t[n[i]] = this.utils[n[i]])
                },
                set_namespace: function() {
                    var e = this.global.namespace === i ? t(".foundation-data-attribute-namespace").css("font-family") : this.global.namespace;
                    this.global.namespace = e === i || /false/i.test(e) ? "" : e
                },
                libs: {},
                utils: {
                    S: o,
                    throttle: function(t, e) {
                        var n = null;
                        return function() {
                            var i = this,
                                s = arguments;
                            null == n && (n = setTimeout(function() {
                                t.apply(i, s), n = null
                            }, e))
                        }
                    },
                    debounce: function(t, e, n) {
                        var i, s;
                        return function() {
                            var a = this,
                                o = arguments,
                                r = function() {
                                    i = null, n || (s = t.apply(a, o))
                                },
                                l = n && !i;
                            return clearTimeout(i), i = setTimeout(r, e), l && (s = t.apply(a, o)), s
                        }
                    },
                    data_options: function(e) {
                        function n(t) {
                            return !isNaN(t - 0) && null !== t && "" !== t && t !== !1 && t !== !0
                        }

                        function i(e) {
                            return "string" == typeof e ? t.trim(e) : e
                        }
                        var s, a, o, r = {},
                            l = function(t) {
                                var e = Foundation.global.namespace;
                                return e.length > 0 ? t.data(e + "-options") : t.data("options")
                            },
                            c = l(e);
                        if ("object" == typeof c) return c;
                        for (o = (c || ":").split(";"), s = o.length; s--;) a = o[s].split(":"), /true/i.test(a[1]) && (a[1] = !0), /false/i.test(a[1]) && (a[1] = !1), n(a[1]) && (-1 === a[1].indexOf(".") ? a[1] = parseInt(a[1], 10) : a[1] = parseFloat(a[1])), 2 === a.length && a[0].length > 0 && (r[i(a[0])] = i(a[1]));
                        return r
                    },
                    register_media: function(e, n) {
                        Foundation.media_queries[e] === i && (t("head").append('<meta class="' + n + '">'), Foundation.media_queries[e] = s(t("." + n).css("font-family")))
                    },
                    add_custom_rule: function(t, e) {
                        if (e === i && Foundation.stylesheet) Foundation.stylesheet.insertRule(t, Foundation.stylesheet.cssRules.length);
                        else {
                            var n = Foundation.media_queries[e];
                            n !== i && Foundation.stylesheet.insertRule("@media " + Foundation.media_queries[e] + "{ " + t + " }")
                        }
                    },
                    image_loaded: function(t, e) {
                        var n = this,
                            i = t.length;
                        0 === i && e(t), t.each(function() {
                            d(n.S(this), function() {
                                i -= 1, 0 === i && e(t)
                            })
                        })
                    },
                    random_str: function() {
                        return this.fidx || (this.fidx = 0), this.prefix = this.prefix || [this.name || "F", (+new Date).toString(36)].join("-"), this.prefix + (this.fidx++).toString(36)
                    }
                }
            }, t.fn.foundation = function() {
                var t = Array.prototype.slice.call(arguments, 0);
                return this.each(function() {
                    return Foundation.init.apply(Foundation, [this].concat(t)), this
                })
            }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.interchange = {
            name: "interchange",
            version: "5.2.2",
            cache: {},
            images_loaded: !1,
            nodes_loaded: !1,
            settings: {
                load_attr: "interchange",
                named_queries: {
                    "default": "only screen",
                    small: Foundation.media_queries.small,
                    medium: Foundation.media_queries.medium,
                    large: Foundation.media_queries.large,
                    xlarge: Foundation.media_queries.xlarge,
                    xxlarge: Foundation.media_queries.xxlarge,
                    landscape: "only screen and (orientation: landscape)",
                    portrait: "only screen and (orientation: portrait)",
                    retina: "only screen and (-webkit-min-device-pixel-ratio: 2),only screen and (min--moz-device-pixel-ratio: 2),only screen and (-o-min-device-pixel-ratio: 2/1),only screen and (min-device-pixel-ratio: 2),only screen and (min-resolution: 192dpi),only screen and (min-resolution: 2dppx)"
                },
                directives: {
                    replace: function(e, n, i) {
                        if (/IMG/.test(e[0].nodeName)) {
                            var s = e[0].src;
                            if (new RegExp(n, "i").test(s)) return;
                            return e[0].src = n, i(e[0].src)
                        }
                        var a = e.data(this.data_attr + "-last-path");
                        if (a != n) return /\.(gif|jpg|jpeg|tiff|png)([?#].*)?/i.test(n) ? (t(e).css("background-image", "url(" + n + ")"), e.data("interchange-last-path", n), i(n)) : t.get(n, function(t) {
                            e.html(t), e.data(this.data_attr + "-last-path", n), i()
                        })
                    }
                }
            },
            init: function(e, n, i) {
                Foundation.inherit(this, "throttle random_str"), this.data_attr = this.set_data_attr(), t.extend(!0, this.settings, n, i), this.bindings(n, i), this.load("images"), this.load("nodes")
            },
            get_media_hash: function() {
                var t = "";
                for (var e in this.settings.named_queries) t += matchMedia(this.settings.named_queries[e]).matches.toString();
                return t
            },
            events: function() {
                var n, i = this;
                return t(e).off(".interchange").on("resize.fndtn.interchange", i.throttle(function() {
                    var t = i.get_media_hash();
                    t !== n && i.resize(), n = t
                }, 50)), this
            },
            resize: function() {
                var e = this.cache;
                if (!this.images_loaded || !this.nodes_loaded) return void setTimeout(t.proxy(this.resize, this), 50);
                for (var n in e)
                    if (e.hasOwnProperty(n)) {
                        var i = this.results(n, e[n]);
                        i && this.settings.directives[i.scenario[1]].call(this, i.el, i.scenario[0], function() {
                            if (arguments[0] instanceof Array) var t = arguments[0];
                            else var t = Array.prototype.slice.call(arguments, 0);
                            i.el.trigger(i.scenario[1], t)
                        })
                    }
            },
            results: function(t, e) {
                var n = e.length;
                if (n > 0)
                    for (var i = this.S("[" + this.add_namespace("data-uuid") + '="' + t + '"]'); n--;) {
                        var s, a = e[n][2];
                        if (s = this.settings.named_queries.hasOwnProperty(a) ? matchMedia(this.settings.named_queries[a]) : matchMedia(a), s.matches) return {
                            el: i,
                            scenario: e[n]
                        }
                    }
                return !1
            },
            load: function(t, e) {
                return ("undefined" == typeof this["cached_" + t] || e) && this["update_" + t](), this["cached_" + t]
            },
            update_images: function() {
                var t = this.S("img[" + this.data_attr + "]"),
                    e = t.length,
                    n = e,
                    i = 0,
                    s = this.data_attr;
                for (this.cache = {}, this.cached_images = [], this.images_loaded = 0 === e; n--;) {
                    if (i++, t[n]) {
                        var a = t[n].getAttribute(s) || "";
                        a.length > 0 && this.cached_images.push(t[n])
                    }
                    i === e && (this.images_loaded = !0, this.enhance("images"))
                }
                return this
            },
            update_nodes: function() {
                var t = this.S("[" + this.data_attr + "]").not("img"),
                    e = t.length,
                    n = e,
                    i = 0,
                    s = this.data_attr;
                for (this.cached_nodes = [], this.nodes_loaded = 0 === e; n--;) {
                    i++;
                    var a = t[n].getAttribute(s) || "";
                    a.length > 0 && this.cached_nodes.push(t[n]), i === e && (this.nodes_loaded = !0, this.enhance("nodes"))
                }
                return this
            },
            enhance: function(n) {
                for (var i = this["cached_" + n].length; i--;) this.object(t(this["cached_" + n][i]));
                return t(e).trigger("resize")
            },
            parse_params: function(t, e, n) {
                return [this.trim(t), this.convert_directive(e), this.trim(n)]
            },
            convert_directive: function(t) {
                var e = this.trim(t);
                return e.length > 0 ? e : "replace"
            },
            object: function(t) {
                var e = this.parse_data_attr(t),
                    n = [],
                    i = e.length;
                if (i > 0)
                    for (; i--;) {
                        var s = e[i].split(/\((.*?)(\))$/);
                        if (s.length > 1) {
                            var a = s[0].split(","),
                                o = this.parse_params(a[0], a[1], s[1]);
                            n.push(o)
                        }
                    }
                return this.store(t, n)
            },
            store: function(t, e) {
                var n = this.random_str(),
                    i = t.data(this.add_namespace("uuid", !0));
                return this.cache[i] ? this.cache[i] : (t.attr(this.add_namespace("data-uuid"), n), this.cache[n] = e)
            },
            trim: function(e) {
                return "string" == typeof e ? t.trim(e) : e
            },
            set_data_attr: function(t) {
                return t ? this.namespace.length > 0 ? this.namespace + "-" + this.settings.load_attr : this.settings.load_attr : this.namespace.length > 0 ? "data-" + this.namespace + "-" + this.settings.load_attr : "data-" + this.settings.load_attr
            },
            parse_data_attr: function(t) {
                for (var e = t.attr(this.attr_name()).split(/\[(.*?)\]/), n = e.length, i = []; n--;) e[n].replace(/[\W\d]+/, "").length > 4 && i.push(e[n]);
                return i
            },
            reflow: function() {
                this.load("images", !0), this.load("nodes", !0)
            }
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.equalizer = {
            name: "equalizer",
            version: "5.2.2",
            settings: {
                use_tallest: !0,
                before_height_change: t.noop,
                after_height_change: t.noop
            },
            init: function(t, e, n) {
                Foundation.inherit(this, "image_loaded"), this.bindings(e, n), this.reflow()
            },
            events: function() {
                this.S(e).off(".equalizer").on("resize.fndtn.equalizer", function(t) {
                    this.reflow()
                }.bind(this))
            },
            equalize: function(e) {
                var n = !1,
                    i = e.find("[" + this.attr_name() + "-watch]:visible"),
                    s = i.first().offset().top,
                    a = e.data(this.attr_name(!0) + "-init");
                if (0 !== i.length && (a.before_height_change(), e.trigger("before-height-change"), i.height("inherit"), i.each(function() {
                        var e = t(this);
                        e.offset().top !== s && (n = !0)
                    }), !n)) {
                    var o = i.map(function() {
                        return t(this).outerHeight()
                    }).get();
                    if (a.use_tallest) {
                        var r = Math.max.apply(null, o);
                        i.css("height", r)
                    } else {
                        var l = Math.min.apply(null, o);
                        i.css("height", l)
                    }
                    a.after_height_change(), e.trigger("after-height-change")
                }
            },
            reflow: function() {
                var e = this;
                this.S("[" + this.attr_name() + "]", this.scope).each(function() {
                    var n = t(this);
                    e.image_loaded(e.S("img", this), function() {
                        e.equalize(n)
                    })
                })
            }
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.abide = {
            name: "abide",
            version: "5.2.2",
            settings: {
                live_validate: !0,
                focus_on_invalid: !0,
                error_labels: !0,
                timeout: 1e3,
                patterns: {
                    alpha: /^[a-zA-Z]+$/,
                    alpha_numeric: /^[a-zA-Z0-9]+$/,
                    integer: /^[-+]?\d+$/,
                    number: /^[-+]?\d*(?:\.\d+)?$/,
                    card: /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/,
                    cvv: /^([0-9]){3,4}$/,
                    email: /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
                    url: /^(https?|ftp|file|ssh):\/\/(((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/,
                    domain: /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/,
                    datetime: /^([0-2][0-9]{3})\-([0-1][0-9])\-([0-3][0-9])T([0-5][0-9])\:([0-5][0-9])\:([0-5][0-9])(Z|([\-\+]([0-1][0-9])\:00))$/,
                    date: /(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))$/,
                    time: /^(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}$/,
                    dateISO: /^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/,
                    month_day_year: /^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/,
                    color: /^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/
                },
                validators: {
                    equalTo: function(t, e, i) {
                        var s = n.getElementById(t.getAttribute(this.add_namespace("data-equalto"))).value,
                            a = t.value,
                            o = s === a;
                        return o
                    }
                }
            },
            timer: null,
            init: function(t, e, n) {
                this.bindings(e, n)
            },
            events: function(e) {
                var n = this,
                    i = n.S(e).attr("novalidate", "novalidate"),
                    s = i.data(this.attr_name(!0) + "-init") || {};
                this.invalid_attr = this.add_namespace("data-invalid"), i.off(".abide").on("submit.fndtn.abide validate.fndtn.abide", function(t) {
                    var e = /ajax/i.test(n.S(this).attr(n.attr_name()));
                    return n.validate(n.S(this).find("input, textarea, select").get(), t, e)
                }).on("reset", function() {
                    return n.reset(t(this))
                }).find("input, textarea, select").off(".abide").on("blur.fndtn.abide change.fndtn.abide", function(t) {
                    n.validate([this], t)
                }).on("keydown.fndtn.abide", function(t) {
                    s.live_validate === !0 && (clearTimeout(n.timer), n.timer = setTimeout(function() {
                        n.validate([this], t)
                    }.bind(this), s.timeout))
                })
            },
            reset: function(e) {
                e.removeAttr(this.invalid_attr), t(this.invalid_attr, e).removeAttr(this.invalid_attr), t(".error", e).not("small").removeClass("error")
            },
            validate: function(t, e, n) {
                var i = this.parse_patterns(t),
                    s = i.length,
                    a = this.S(t[0]).closest("[data-" + this.attr_name(!0) + "]"),
                    o = a.data(this.attr_name(!0) + "-init") || {},
                    r = /submit/.test(e.type);
                a.trigger("validated");
                for (var l = 0; s > l; l++)
                    if (!i[l] && (r || n)) return o.focus_on_invalid && t[l].focus(), a.trigger("invalid"), this.S(t[l]).closest("[data-" + this.attr_name(!0) + "]").attr(this.invalid_attr, ""), !1;
                return (r || n) && a.trigger("valid"), a.removeAttr(this.invalid_attr), n ? !1 : !0
            },
            parse_patterns: function(t) {
                for (var e = t.length, n = []; e--;) n.push(this.pattern(t[e]));
                return this.check_validation_and_apply_styles(n)
            },
            pattern: function(t) {
                var e = t.getAttribute("type"),
                    n = "string" == typeof t.getAttribute("required"),
                    i = t.getAttribute("pattern") || "";
                return this.settings.patterns.hasOwnProperty(i) && i.length > 0 ? [t, this.settings.patterns[i], n] : i.length > 0 ? [t, new RegExp("^" + i + "$"), n] : this.settings.patterns.hasOwnProperty(e) ? [t, this.settings.patterns[e], n] : (i = /.*/, [t, i, n])
            },
            check_validation_and_apply_styles: function(e) {
                for (var n = e.length, i = [], s = this.S(e[0][0]).closest("[data-" + this.attr_name(!0) + "]"), a = s.data(this.attr_name(!0) + "-init") || {}; n--;) {
                    var o, r, l = e[n][0],
                        c = e[n][2],
                        d = l.value,
                        u = this.S(l).parent(),
                        h = l.getAttribute(this.add_namespace("data-abide-validator")),
                        f = "radio" === l.type,
                        p = "checkbox" === l.type,
                        g = this.S('label[for="' + l.getAttribute("id") + '"]'),
                        m = c ? l.value.length > 0 : !0;
                    l.getAttribute(this.add_namespace("data-equalto")) && (h = "equalTo"), o = u.is("label") ? u.parent() : u, f && c ? i.push(this.valid_radio(l, c)) : p && c ? i.push(this.valid_checkbox(l, c)) : h ? (r = this.settings.validators[h].apply(this, [l, c, o]), i.push(r), r ? (this.S(l).removeAttr(this.invalid_attr), o.removeClass("error")) : (this.S(l).attr(this.invalid_attr, ""), o.addClass("error"))) : e[n][1].test(d) && m || !c && l.value.length < 1 || t(l).attr("disabled") ? (this.S(l).removeAttr(this.invalid_attr), o.removeClass("error"), g.length > 0 && a.error_labels && g.removeClass("error"), i.push(!0), t(l).triggerHandler("valid")) : (this.S(l).attr(this.invalid_attr, ""), o.addClass("error"), g.length > 0 && a.error_labels && g.addClass("error"), i.push(!1), t(l).triggerHandler("invalid"))
                }
                return i
            },
            valid_checkbox: function(t, e) {
                var t = this.S(t),
                    n = t.is(":checked") || !e;
                return n ? t.removeAttr(this.invalid_attr).parent().removeClass("error") : t.attr(this.invalid_attr, "").parent().addClass("error"), n
            },
            valid_radio: function(t, e) {
                for (var n = t.getAttribute("name"), i = this.S(t).closest("[data-" + this.attr_name(!0) + "]").find("[name=" + n + "]"), s = i.length, a = !1, o = 0; s > o; o++) i[o].checked && (a = !0);
                for (var o = 0; s > o; o++) a ? this.S(i[o]).removeAttr(this.invalid_attr).parent().removeClass("error") : this.S(i[o]).attr(this.invalid_attr, "").parent().addClass("error");
                return a
            },
            valid_equal: function(t, e, i) {
                var s = n.getElementById(t.getAttribute(this.add_namespace("data-equalto"))).value,
                    a = t.value,
                    o = s === a;
                return o ? (this.S(t).removeAttr(this.invalid_attr), i.removeClass("error")) : (this.S(t).attr(this.invalid_attr, ""), i.addClass("error")), o
            },
            valid_oneof: function(t, e, n, i) {
                var t = this.S(t),
                    s = this.S("[" + this.add_namespace("data-oneof") + "]"),
                    a = s.filter(":checked").length > 0;
                if (a ? t.removeAttr(this.invalid_attr).parent().removeClass("error") : t.attr(this.invalid_attr, "").parent().addClass("error"), !i) {
                    var o = this;
                    s.each(function() {
                        o.valid_oneof.call(o, this, null, null, !0)
                    })
                }
                return a
            }
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.dropdown = {
            name: "dropdown",
            version: "5.2.2",
            settings: {
                active_class: "open",
                align: "bottom",
                is_hover: !1,
                opened: function() {},
                closed: function() {}
            },
            init: function(t, e, n) {
                Foundation.inherit(this, "throttle"), this.bindings(e, n)
            },
            events: function(n) {
                var i = this,
                    s = i.S;
                s(this.scope).off(".dropdown").on("click.fndtn.dropdown", "[" + this.attr_name() + "]", function(e) {
                    var n = s(this).data(i.attr_name(!0) + "-init") || i.settings;
                    (!n.is_hover || Modernizr.touch) && (e.preventDefault(), i.toggle(t(this)))
                }).on("mouseenter.fndtn.dropdown", "[" + this.attr_name() + "], [" + this.attr_name() + "-content]", function(t) {
                    var e = s(this);
                    if (clearTimeout(i.timeout), e.data(i.data_attr())) var n = s("#" + e.data(i.data_attr())),
                        a = e;
                    else {
                        var n = e;
                        a = s("[" + i.attr_name() + "='" + n.attr("id") + "']")
                    }
                    var o = a.data(i.attr_name(!0) + "-init") || i.settings;
                    s(t.target).data(i.data_attr()) && o.is_hover && i.closeall.call(i), o.is_hover && i.open.apply(i, [n, a])
                }).on("mouseleave.fndtn.dropdown", "[" + this.attr_name() + "], [" + this.attr_name() + "-content]", function(t) {
                    var e = s(this);
                    i.timeout = setTimeout(function() {
                        if (e.data(i.data_attr())) {
                            var t = e.data(i.data_attr(!0) + "-init") || i.settings;
                            t.is_hover && i.close.call(i, s("#" + e.data(i.data_attr())))
                        } else {
                            var n = s("[" + i.attr_name() + '="' + s(this).attr("id") + '"]'),
                                t = n.data(i.attr_name(!0) + "-init") || i.settings;
                            t.is_hover && i.close.call(i, e)
                        }
                    }.bind(this), 150)
                }).on("click.fndtn.dropdown", function(e) {
                    var n = s(e.target).closest("[" + i.attr_name() + "-content]");
                    if (!s(e.target).data(i.data_attr()) && !s(e.target).parent().data(i.data_attr())) return !s(e.target).data("revealId") && n.length > 0 && (s(e.target).is("[" + i.attr_name() + "-content]") || t.contains(n.first()[0], e.target)) ? void e.stopPropagation() : void i.close.call(i, s("[" + i.attr_name() + "-content]"))
                }).on("opened.fndtn.dropdown", "[" + i.attr_name() + "-content]", function() {
                    i.settings.opened.call(this)
                }).on("closed.fndtn.dropdown", "[" + i.attr_name() + "-content]", function() {
                    i.settings.closed.call(this)
                }), s(e).off(".dropdown").on("resize.fndtn.dropdown", i.throttle(function() {
                    i.resize.call(i)
                }, 50)), this.resize()
            },
            close: function(t) {
                var e = this;
                t.each(function() {
                    e.S(this).hasClass(e.settings.active_class) && (e.S(this).css(Foundation.rtl ? "right" : "left", "-99999px").removeClass(e.settings.active_class).prev("[" + e.attr_name() + "]").removeClass(e.settings.active_class), e.S(this).trigger("closed", [t]))
                })
            },
            closeall: function() {
                var e = this;
                t.each(e.S("[" + this.attr_name() + "-content]"), function() {
                    e.close.call(e, e.S(this))
                })
            },
            open: function(t, e) {
                this.css(t.addClass(this.settings.active_class), e), t.prev("[" + this.attr_name() + "]").addClass(this.settings.active_class), t.trigger("opened", [t, e])
            },
            data_attr: function() {
                return this.namespace.length > 0 ? this.namespace + "-" + this.name : this.name
            },
            toggle: function(t) {
                var e = this.S("#" + t.data(this.data_attr()));
                0 !== e.length && (this.close.call(this, this.S("[" + this.attr_name() + "-content]").not(e)), e.hasClass(this.settings.active_class) ? this.close.call(this, e) : (this.close.call(this, this.S("[" + this.attr_name() + "-content]")), this.open.call(this, e, t)))
            },
            resize: function() {
                var t = this.S("[" + this.attr_name() + "-content].open"),
                    e = this.S("[" + this.attr_name() + "='" + t.attr("id") + "']");
                t.length && e.length && this.css(t, e)
            },
            css: function(t, e) {
                if (this.clear_idx(), this.small()) {
                    var n = this.dirs.bottom.call(t, e);
                    t.attr("style", "").removeClass("drop-left drop-right drop-top").css({
                        position: "absolute",
                        width: "95%",
                        "max-width": "none",
                        top: n.top
                    }), t.css(Foundation.rtl ? "right" : "left", "2.5%")
                } else {
                    var i = e.data(this.attr_name(!0) + "-init") || this.settings;
                    this.style(t, e, i)
                }
                return t
            },
            style: function(e, n, i) {
                var s = t.extend({
                    position: "absolute"
                }, this.dirs[i.align].call(e, n, i));
                e.attr("style", "").css(s)
            },
            dirs: {
                _base: function(t) {
                    var e = this.offsetParent(),
                        n = e.offset(),
                        i = t.offset();
                    return i.top -= n.top, i.left -= n.left, i
                },
                top: function(t, e) {
                    var n = Foundation.libs.dropdown,
                        i = n.dirs._base.call(this, t),
                        s = t.outerWidth() / 2 - 8;
                    return this.addClass("drop-top"), (t.outerWidth() < this.outerWidth() || n.small()) && n.adjust_pip(s, i), Foundation.rtl ? {
                        left: i.left - this.outerWidth() + t.outerWidth(),
                        top: i.top - this.outerHeight()
                    } : {
                        left: i.left,
                        top: i.top - this.outerHeight()
                    }
                },
                bottom: function(t, e) {
                    var n = Foundation.libs.dropdown,
                        i = n.dirs._base.call(this, t),
                        s = t.outerWidth() / 2 - 8;
                    return (t.outerWidth() < this.outerWidth() || n.small()) && n.adjust_pip(s, i), n.rtl ? {
                        left: i.left - this.outerWidth() + t.outerWidth(),
                        top: i.top + t.outerHeight()
                    } : {
                        left: i.left,
                        top: i.top + t.outerHeight()
                    }
                },
                left: function(t, e) {
                    var n = Foundation.libs.dropdown.dirs._base.call(this, t);
                    return this.addClass("drop-left"), {
                        left: n.left - this.outerWidth(),
                        top: n.top
                    }
                },
                right: function(t, e) {
                    var n = Foundation.libs.dropdown.dirs._base.call(this, t);
                    return this.addClass("drop-right"), {
                        left: n.left + t.outerWidth(),
                        top: n.top
                    }
                }
            },
            adjust_pip: function(t, e) {
                var n = Foundation.stylesheet;
                this.small() && (t += e.left - 8), this.rule_idx = n.cssRules.length;
                var i = ".f-dropdown.open:before",
                    s = ".f-dropdown.open:after",
                    a = "left: " + t + "px;",
                    o = "left: " + (t - 1) + "px;";
                n.insertRule ? (n.insertRule([i, "{", a, "}"].join(" "), this.rule_idx), n.insertRule([s, "{", o, "}"].join(" "), this.rule_idx + 1)) : (n.addRule(i, a, this.rule_idx), n.addRule(s, o, this.rule_idx + 1))
            },
            clear_idx: function() {
                var t = Foundation.stylesheet;
                this.rule_idx && (t.deleteRule(this.rule_idx), t.deleteRule(this.rule_idx), delete this.rule_idx)
            },
            small: function() {
                return matchMedia(Foundation.media_queries.small).matches && !matchMedia(Foundation.media_queries.medium).matches
            },
            off: function() {
                this.S(this.scope).off(".fndtn.dropdown"), this.S("html, body").off(".fndtn.dropdown"), this.S(e).off(".fndtn.dropdown"), this.S("[data-dropdown-content]").off(".fndtn.dropdown")
            },
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.alert = {
            name: "alert",
            version: "5.2.2",
            settings: {
                callback: function() {}
            },
            init: function(t, e, n) {
                this.bindings(e, n)
            },
            events: function() {
                var n = this,
                    i = this.S;
                t(this.scope).off(".alert").on("click.fndtn.alert", "[" + this.attr_name() + "] a.close", function(t) {
                    var s = i(this).closest("[" + n.attr_name() + "]"),
                        a = s.data(n.attr_name(!0) + "-init") || n.settings;
                    t.preventDefault(), "transitionend" in e || "webkitTransitionEnd" in e || "oTransitionEnd" in e ? (s.addClass("alert-close"), s.on("transitionend webkitTransitionEnd oTransitionEnd", function(t) {
                        i(this).trigger("close").remove(), a.callback()
                    })) : s.fadeOut(300, function() {
                        i(this).trigger("close").remove(), a.callback()
                    })
                })
            },
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs["magellan-expedition"] = {
            name: "magellan-expedition",
            version: "5.2.2",
            settings: {
                active_class: "active",
                threshold: 0,
                destination_threshold: 20,
                throttle_delay: 30
            },
            init: function(t, e, n) {
                Foundation.inherit(this, "throttle"), this.bindings(e, n)
            },
            events: function() {
                var n = this,
                    i = n.S,
                    s = n.settings;
                n.set_expedition_position(), i(n.scope).off(".magellan").on("click.fndtn.magellan", "[" + n.add_namespace("data-magellan-arrival") + '] a[href^="#"]', function(e) {
                    e.preventDefault();
                    var i = t(this).closest("[" + n.attr_name() + "]"),
                        s = (i.data("magellan-expedition-init"), this.hash.split("#").join("")),
                        a = t("a[name='" + s + "']");
                    0 === a.length && (a = t("#" + s));
                    var o = a.offset().top;
                    o -= i.outerHeight(), t("html, body").stop().animate({
                        scrollTop: o
                    }, 700, "swing", function() {
                        history.pushState ? history.pushState(null, null, "#" + s) : location.hash = "#" + s
                    })
                }).on("scroll.fndtn.magellan", n.throttle(this.check_for_arrivals.bind(this), s.throttle_delay)), t(e).on("resize.fndtn.magellan", n.throttle(this.set_expedition_position.bind(this), s.throttle_delay))
            },
            check_for_arrivals: function() {
                var t = this;
                t.update_arrivals(), t.update_expedition_positions()
            },
            set_expedition_position: function() {
                var e = this;
                t("[" + this.attr_name() + "=fixed]", e.scope).each(function(n, i) {
                    var s, a = t(this),
                        o = a.attr("styles");
                    a.attr("style", ""), s = a.offset().top, a.data(e.data_attr("magellan-top-offset"), s), a.attr("style", o)
                })
            },
            update_expedition_positions: function() {
                var n = this,
                    i = t(e).scrollTop();
                t("[" + this.attr_name() + "=fixed]", n.scope).each(function() {
                    var e = t(this),
                        s = e.data("magellan-top-offset");
                    if (i >= s) {
                        var a = e.prev("[" + n.add_namespace("data-magellan-expedition-clone") + "]");
                        0 === a.length && (a = e.clone(), a.removeAttr(n.attr_name()), a.attr(n.add_namespace("data-magellan-expedition-clone"), ""), e.before(a)), e.css({
                            position: "fixed",
                            top: 0
                        })
                    } else e.prev("[" + n.add_namespace("data-magellan-expedition-clone") + "]").remove(), e.attr("style", "")
                })
            },
            update_arrivals: function() {
                var n = this,
                    i = t(e).scrollTop();
                t("[" + this.attr_name() + "]", n.scope).each(function() {
                    var e = t(this),
                        s = s = e.data(n.attr_name(!0) + "-init"),
                        a = n.offsets(e, i),
                        o = e.find("[" + n.add_namespace("data-magellan-arrival") + "]"),
                        r = !1;
                    a.each(function(t, i) {
                        if (i.viewport_offset >= i.top_offset) {
                            var a = e.find("[" + n.add_namespace("data-magellan-arrival") + "]");
                            return a.not(i.arrival).removeClass(s.active_class), i.arrival.addClass(s.active_class), r = !0, !0
                        }
                    }), r || o.removeClass(s.active_class)
                })
            },
            offsets: function(e, n) {
                var i = this,
                    s = e.data(i.attr_name(!0) + "-init"),
                    a = n;
                return e.find("[" + i.add_namespace("data-magellan-arrival") + "]").map(function(n, o) {
                    var r = t(this).data(i.data_attr("magellan-arrival")),
                        l = t("[" + i.add_namespace("data-magellan-destination") + "=" + r + "]");
                    if (l.length > 0) {
                        var c = l.offset().top - s.destination_threshold - e.outerHeight();
                        return {
                            destination: l,
                            arrival: t(this),
                            top_offset: c,
                            viewport_offset: a
                        }
                    }
                }).sort(function(t, e) {
                    return t.top_offset < e.top_offset ? -1 : t.top_offset > e.top_offset ? 1 : 0
                })
            },
            data_attr: function(t) {
                return this.namespace.length > 0 ? this.namespace + "-" + t : t
            },
            off: function() {
                this.S(this.scope).off(".magellan"), this.S(e).off(".magellan")
            },
            reflow: function() {
                var e = this;
                t("[" + e.add_namespace("data-magellan-expedition-clone") + "]", e.scope).remove()
            }
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";

        function s(t) {
            var e = /fade/i.test(t),
                n = /pop/i.test(t);
            return {
                animate: e || n,
                pop: n,
                fade: e
            }
        }
        Foundation.libs.reveal = {
            name: "reveal",
            version: "5.2.2",
            locked: !1,
            settings: {
                animation: "fadeAndPop",
                animation_speed: 250,
                close_on_background_click: !0,
                close_on_esc: !0,
                dismiss_modal_class: "close-reveal-modal",
                bg_class: "reveal-modal-bg",
                open: function() {},
                opened: function() {},
                close: function() {},
                closed: function() {},
                bg: t(".reveal-modal-bg"),
                css: {
                    open: {
                        opacity: 0,
                        visibility: "visible",
                        display: "block"
                    },
                    close: {
                        opacity: 1,
                        visibility: "hidden",
                        display: "none"
                    }
                }
            },
            init: function(e, n, i) {
                t.extend(!0, this.settings, n, i), this.bindings(n, i)
            },
            events: function(t) {
                var e = this,
                    i = e.S;
                return i(this.scope).off(".reveal").on("click.fndtn.reveal", "[" + this.add_namespace("data-reveal-id") + "]", function(t) {
                    if (t.preventDefault(), !e.locked) {
                        var n = i(this),
                            s = n.data(e.data_attr("reveal-ajax"));
                        if (e.locked = !0, "undefined" == typeof s) e.open.call(e, n);
                        else {
                            var a = s === !0 ? n.attr("href") : s;
                            e.open.call(e, n, {
                                url: a
                            })
                        }
                    }
                }), i(n).on("touchend.fndtn.reveal click.fndtn.reveal", this.close_targets(), function(t) {
                    if (t.preventDefault(), !e.locked) {
                        var n = i("[" + e.attr_name() + "].open").data(e.attr_name(!0) + "-init"),
                            s = i(t.target)[0] === i("." + n.bg_class)[0];
                        if (s) {
                            if (!n.close_on_background_click) return;
                            t.stopPropagation()
                        }
                        e.locked = !0, e.close.call(e, s ? i("[" + e.attr_name() + "].open") : i(this).closest("[" + e.attr_name() + "]"))
                    }
                }), i("[" + e.attr_name() + "]", this.scope).length > 0 ? i(this.scope).on("open.fndtn.reveal", this.settings.open).on("opened.fndtn.reveal", this.settings.opened).on("opened.fndtn.reveal", this.open_video).on("close.fndtn.reveal", this.settings.close).on("closed.fndtn.reveal", this.settings.closed).on("closed.fndtn.reveal", this.close_video) : i(this.scope).on("open.fndtn.reveal", "[" + e.attr_name() + "]", this.settings.open).on("opened.fndtn.reveal", "[" + e.attr_name() + "]", this.settings.opened).on("opened.fndtn.reveal", "[" + e.attr_name() + "]", this.open_video).on("close.fndtn.reveal", "[" + e.attr_name() + "]", this.settings.close).on("closed.fndtn.reveal", "[" + e.attr_name() + "]", this.settings.closed).on("closed.fndtn.reveal", "[" + e.attr_name() + "]", this.close_video), !0
            },
            key_up_on: function(t) {
                var e = this;
                return e.S("body").off("keyup.fndtn.reveal").on("keyup.fndtn.reveal", function(t) {
                    var n = e.S("[" + e.attr_name() + "].open"),
                        i = n.data(e.attr_name(!0) + "-init");
                    i && 27 === t.which && i.close_on_esc && !e.locked && e.close.call(e, n)
                }), !0
            },
            key_up_off: function(t) {
                return this.S("body").off("keyup.fndtn.reveal"), !0
            },
            open: function(e, n) {
                var i = this;
                if (e)
                    if ("undefined" != typeof e.selector) var s = i.S("#" + e.data(i.data_attr("reveal-id")));
                    else {
                        var s = i.S(this.scope);
                        n = e
                    }
                else var s = i.S(this.scope);
                var a = s.data(i.attr_name(!0) + "-init");
                if (!s.hasClass("open")) {
                    var o = i.S("[" + i.attr_name() + "].open");
                    if ("undefined" == typeof s.data("css-top") && s.data("css-top", parseInt(s.css("top"), 10)).data("offset", this.cache_offset(s)), this.key_up_on(s), s.trigger("open"), o.length < 1 && this.toggle_bg(s), "string" == typeof n && (n = {
                            url: n
                        }), "undefined" != typeof n && n.url) {
                        var r = "undefined" != typeof n.success ? n.success : null;
                        t.extend(n, {
                            success: function(e, n, l) {
                                t.isFunction(r) && r(e, n, l), s.html(e), i.S(s).foundation("section", "reflow"), o.length > 0 && i.hide(o, a.css.close), i.show(s, a.css.open)
                            }
                        }), t.ajax(n)
                    } else o.length > 0 && this.hide(o, a.css.close), this.show(s, a.css.open)
                }
            },
            close: function(t) {
                var t = t && t.length ? t : this.S(this.scope),
                    e = this.S("[" + this.attr_name() + "].open"),
                    n = t.data(this.attr_name(!0) + "-init");
                e.length > 0 && (this.locked = !0, this.key_up_off(t), t.trigger("close"), this.toggle_bg(t), this.hide(e, n.css.close, n))
            },
            close_targets: function() {
                var t = "." + this.settings.dismiss_modal_class;
                return this.settings.close_on_background_click ? t + ", ." + this.settings.bg_class : t
            },
            toggle_bg: function(e) {
                e.data(this.attr_name(!0));
                0 === this.S("." + this.settings.bg_class).length && (this.settings.bg = t("<div />", {
                    "class": this.settings.bg_class
                }).appendTo("body").hide()), this.settings.bg.filter(":visible").length > 0 ? this.hide(this.settings.bg) : this.show(this.settings.bg)
            },
            show: function(n, i) {
                if (i) {
                    var a = n.data(this.attr_name(!0) + "-init");
                    if (0 === n.parent("body").length) {
                        var o = n.wrap('<div style="display: none;" />').parent(),
                            r = this.settings.rootElement || "body";
                        n.on("closed.fndtn.reveal.wrapped", function() {
                            n.detach().appendTo(o), n.unwrap().unbind("closed.fndtn.reveal.wrapped")
                        }), n.detach().appendTo(r)
                    }
                    var l = s(a.animation);
                    if (l.animate || (this.locked = !1), l.pop) {
                        i.top = t(e).scrollTop() - n.data("offset") + "px";
                        var c = {
                            top: t(e).scrollTop() + n.data("css-top") + "px",
                            opacity: 1
                        };
                        return setTimeout(function() {
                            return n.css(i).animate(c, a.animation_speed, "linear", function() {
                                this.locked = !1, n.trigger("opened")
                            }.bind(this)).addClass("open")
                        }.bind(this), a.animation_speed / 2)
                    }
                    if (l.fade) {
                        i.top = t(e).scrollTop() + n.data("css-top") + "px";
                        var c = {
                            opacity: 1
                        };
                        return setTimeout(function() {
                            return n.css(i).animate(c, a.animation_speed, "linear", function() {
                                this.locked = !1, n.trigger("opened")
                            }.bind(this)).addClass("open")
                        }.bind(this), a.animation_speed / 2)
                    }
                    return n.css(i).show().css({
                        opacity: 1
                    }).addClass("open").trigger("opened")
                }
                var a = this.settings;
                return s(a.animation).fade ? n.fadeIn(a.animation_speed / 2) : (this.locked = !1, n.show())
            },
            hide: function(n, i) {
                if (i) {
                    var a = n.data(this.attr_name(!0) + "-init"),
                        o = s(a.animation);
                    if (o.animate || (this.locked = !1), o.pop) {
                        var r = {
                            top: -t(e).scrollTop() - n.data("offset") + "px",
                            opacity: 0
                        };
                        return setTimeout(function() {
                            return n.animate(r, a.animation_speed, "linear", function() {
                                this.locked = !1, n.css(i).trigger("closed")
                            }.bind(this)).removeClass("open")
                        }.bind(this), a.animation_speed / 2)
                    }
                    if (o.fade) {
                        var r = {
                            opacity: 0
                        };
                        return setTimeout(function() {
                            return n.animate(r, a.animation_speed, "linear", function() {
                                this.locked = !1, n.css(i).trigger("closed")
                            }.bind(this)).removeClass("open")
                        }.bind(this), a.animation_speed / 2)
                    }
                    return n.hide().css(i).removeClass("open").trigger("closed")
                }
                var a = this.settings;
                return s(a.animation).fade ? n.fadeOut(a.animation_speed / 2) : n.hide()
            },
            close_video: function(e) {
                var n = t(".flex-video", e.target),
                    i = t("iframe", n);
                i.length > 0 && (i.attr("data-src", i[0].src), i.attr("src", "about:blank"), n.hide())
            },
            open_video: function(e) {
                var n = t(".flex-video", e.target),
                    s = n.find("iframe");
                if (s.length > 0) {
                    var a = s.attr("data-src");
                    if ("string" == typeof a) s[0].src = s.attr("data-src");
                    else {
                        var o = s[0].src;
                        s[0].src = i, s[0].src = o
                    }
                    n.show()
                }
            },
            data_attr: function(t) {
                return this.namespace.length > 0 ? this.namespace + "-" + t : t
            },
            cache_offset: function(t) {
                var e = t.show().height() + parseInt(t.css("top"), 10);
                return t.hide(), e
            },
            off: function() {
                t(this.scope).off(".fndtn.reveal")
            },
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.tooltip = {
            name: "tooltip",
            version: "5.2.2",
            settings: {
                additional_inheritable_classes: [],
                tooltip_class: ".tooltip",
                append_to: "body",
                touch_close_text: "Tap To Close",
                disable_for_touch: !1,
                hover_delay: 200,
                tip_template: function(t, e) {
                    return '<span data-selector="' + t + '" class="' + Foundation.libs.tooltip.settings.tooltip_class.substring(1) + '">' + e + '<span class="nub"></span></span>'
                }
            },
            cache: {},
            init: function(t, e, n) {
                Foundation.inherit(this, "random_str"), this.bindings(e, n)
            },
            events: function(e) {
                var n = this,
                    i = n.S;
                n.create(this.S(e)), t(this.scope).off(".tooltip").on("mouseenter.fndtn.tooltip mouseleave.fndtn.tooltip touchstart.fndtn.tooltip MSPointerDown.fndtn.tooltip", "[" + this.attr_name() + "]", function(e) {
                    var s = i(this),
                        a = t.extend({}, n.settings, n.data_options(s)),
                        o = !1;
                    if (Modernizr.touch && /touchstart|MSPointerDown/i.test(e.type) && i(e.target).is("a")) return !1;
                    if (/mouse/i.test(e.type) && n.ie_touch(e)) return !1;
                    if (s.hasClass("open")) Modernizr.touch && /touchstart|MSPointerDown/i.test(e.type) && e.preventDefault(), n.hide(s);
                    else {
                        if (a.disable_for_touch && Modernizr.touch && /touchstart|MSPointerDown/i.test(e.type)) return;
                        !a.disable_for_touch && Modernizr.touch && /touchstart|MSPointerDown/i.test(e.type) && (e.preventDefault(), i(a.tooltip_class + ".open").hide(), o = !0), /enter|over/i.test(e.type) ? this.timer = setTimeout(function() {
                            n.showTip(s)
                        }.bind(this), n.settings.hover_delay) : "mouseout" === e.type || "mouseleave" === e.type ? (clearTimeout(this.timer), n.hide(s)) : n.showTip(s)
                    }
                }).on("mouseleave.fndtn.tooltip touchstart.fndtn.tooltip MSPointerDown.fndtn.tooltip", "[" + this.attr_name() + "].open", function(e) {
                    return /mouse/i.test(e.type) && n.ie_touch(e) ? !1 : void(("touch" != t(this).data("tooltip-open-event-type") || "mouseleave" != e.type) && ("mouse" == t(this).data("tooltip-open-event-type") && /MSPointerDown|touchstart/i.test(e.type) ? n.convert_to_touch(t(this)) : n.hide(t(this))))
                }).on("DOMNodeRemoved DOMAttrModified", "[" + this.attr_name() + "]:not(a)", function(t) {
                    n.hide(i(this))
                })
            },
            ie_touch: function(t) {
                return !1
            },
            showTip: function(t) {
                this.getTip(t);
                return this.show(t)
            },
            getTip: function(e) {
                var n = this.selector(e),
                    i = t.extend({}, this.settings, this.data_options(e)),
                    s = null;
                return n && (s = this.S('span[data-selector="' + n + '"]' + i.tooltip_class)), "object" == typeof s ? s : !1
            },
            selector: function(t) {
                var e = t.attr("id"),
                    n = t.attr(this.attr_name()) || t.attr("data-selector");
                return (e && e.length < 1 || !e) && "string" != typeof n && (n = this.random_str(6), t.attr("data-selector", n)), e && e.length > 0 ? e : n
            },
            create: function(n) {
                var i = this,
                    s = t.extend({}, this.settings, this.data_options(n)),
                    a = this.settings.tip_template;
                "string" == typeof s.tip_template && e.hasOwnProperty(s.tip_template) && (a = e[s.tip_template]);
                var o = t(a(this.selector(n), t("<div></div>").html(n.attr("title")).html())),
                    r = this.inheritable_classes(n);
                o.addClass(r).appendTo(s.append_to), Modernizr.touch && (o.append('<span class="tap-to-close">' + s.touch_close_text + "</span>"), o.on("touchstart.fndtn.tooltip MSPointerDown.fndtn.tooltip", function(t) {
                    i.hide(n)
                })), n.removeAttr("title").attr("title", "")
            },
            reposition: function(e, n, i) {
                var s, a, o, r, l;
                if (n.css("visibility", "hidden").show(), s = e.data("width"), a = n.children(".nub"), o = a.outerHeight(), r = a.outerHeight(), this.small() ? n.css({
                        width: "100%"
                    }) : n.css({
                        width: s ? s : "auto"
                    }), (l = function(t, e, n, i, s, a) {
                        return t.css({
                            top: e ? e : "auto",
                            bottom: i ? i : "auto",
                            left: s ? s : "auto",
                            right: n ? n : "auto"
                        }).end()
                    })(n, e.offset().top + e.outerHeight() + 10, "auto", "auto", e.offset().left), this.small()) l(n, e.offset().top + e.outerHeight() + 10, "auto", "auto", 12.5, t(this.scope).width()), n.addClass("tip-override"), l(a, -o, "auto", "auto", e.offset().left);
                else {
                    var c = e.offset().left;
                    Foundation.rtl && (a.addClass("rtl"), c = e.offset().left + e.outerWidth() - n.outerWidth()), l(n, e.offset().top + e.outerHeight() + 10, "auto", "auto", c), n.removeClass("tip-override"), i && i.indexOf("tip-top") > -1 ? (Foundation.rtl && a.addClass("rtl"), l(n, e.offset().top - n.outerHeight(), "auto", "auto", c).removeClass("tip-override")) : i && i.indexOf("tip-left") > -1 ? (l(n, e.offset().top + e.outerHeight() / 2 - n.outerHeight() / 2, "auto", "auto", e.offset().left - n.outerWidth() - o).removeClass("tip-override"), a.removeClass("rtl")) : i && i.indexOf("tip-right") > -1 && (l(n, e.offset().top + e.outerHeight() / 2 - n.outerHeight() / 2, "auto", "auto", e.offset().left + e.outerWidth() + o).removeClass("tip-override"), a.removeClass("rtl"))
                }
                n.css("visibility", "visible").hide()
            },
            small: function() {
                return matchMedia(Foundation.media_queries.small).matches && !matchMedia(Foundation.media_queries.medium).matches
            },
            inheritable_classes: function(e) {
                var n = t.extend({}, this.settings, this.data_options(e)),
                    i = ["tip-top", "tip-left", "tip-bottom", "tip-right", "radius", "round"].concat(n.additional_inheritable_classes),
                    s = e.attr("class"),
                    a = s ? t.map(s.split(" "), function(e, n) {
                        return -1 !== t.inArray(e, i) ? e : void 0
                    }).join(" ") : "";
                return t.trim(a)
            },
            convert_to_touch: function(e) {
                var n = this,
                    i = n.getTip(e),
                    s = t.extend({}, n.settings, n.data_options(e));
                0 === i.find(".tap-to-close").length && (i.append('<span class="tap-to-close">' + s.touch_close_text + "</span>"), i.on("click.fndtn.tooltip.tapclose touchstart.fndtn.tooltip.tapclose MSPointerDown.fndtn.tooltip.tapclose", function(t) {
                    n.hide(e)
                })), e.data("tooltip-open-event-type", "touch")
            },
            show: function(t) {
                var e = this.getTip(t);
                "touch" == t.data("tooltip-open-event-type") && this.convert_to_touch(t), this.reposition(t, e, t.attr("class")), t.addClass("open"), e.fadeIn(150)
            },
            hide: function(t) {
                var e = this.getTip(t);
                e.fadeOut(150, function() {
                    e.find(".tap-to-close").remove(), e.off("click.fndtn.tooltip.tapclose touchstart.fndtn.tooltip.tapclose MSPointerDown.fndtn.tapclose"), t.removeClass("open")
                })
            },
            off: function() {
                var e = this;
                this.S(this.scope).off(".fndtn.tooltip"), this.S(this.settings.tooltip_class).each(function(n) {
                    t("[" + e.attr_name() + "]").eq(n).attr("title", t(this).text())
                }).remove()
            },
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.tab = {
            name: "tab",
            version: "5.2.2",
            settings: {
                active_class: "active",
                callback: function() {},
                deep_linking: !1,
                scroll_to_content: !0,
                is_hover: !1
            },
            default_tab_hashes: [],
            init: function(t, e, n) {
                var i = this,
                    s = this.S;
                this.bindings(e, n), this.handle_location_hash_change(), s("[" + this.attr_name() + "] > dd.active > a", this.scope).each(function() {
                    i.default_tab_hashes.push(this.hash)
                })
            },
            events: function() {
                var t = this,
                    n = this.S;
                n(this.scope).off(".tab").on("click.fndtn.tab", "[" + this.attr_name() + "] > dd > a", function(e) {
                    var i = n(this).closest("[" + t.attr_name() + "]").data(t.attr_name(!0) + "-init");
                    (!i.is_hover || Modernizr.touch) && (e.preventDefault(), e.stopPropagation(), t.toggle_active_tab(n(this).parent()))
                }).on("mouseenter.fndtn.tab", "[" + this.attr_name() + "] > dd > a", function(e) {
                    var i = n(this).closest("[" + t.attr_name() + "]").data(t.attr_name(!0) + "-init");
                    i.is_hover && t.toggle_active_tab(n(this).parent())
                }), n(e).on("hashchange.fndtn.tab", function(e) {
                    e.preventDefault(), t.handle_location_hash_change()
                })
            },
            handle_location_hash_change: function() {
                var e = this,
                    n = this.S;
                n("[" + this.attr_name() + "]", this.scope).each(function() {
                    var s = n(this).data(e.attr_name(!0) + "-init");
                    if (s.deep_linking) {
                        var a = e.scope.location.hash;
                        if ("" != a) {
                            var o = n(a);
                            if (o.hasClass("content") && o.parent().hasClass("tab-content")) e.toggle_active_tab(t("[" + e.attr_name() + "] > dd > a[href=" + a + "]").parent());
                            else {
                                var r = o.closest(".content").attr("id");
                                r != i && e.toggle_active_tab(t("[" + e.attr_name() + "] > dd > a[href=#" + r + "]").parent(), a)
                            }
                        } else
                            for (var l in e.default_tab_hashes) e.toggle_active_tab(t("[" + e.attr_name() + "] > dd > a[href=" + e.default_tab_hashes[l] + "]").parent())
                    }
                })
            },
            toggle_active_tab: function(n, s) {
                var a = this.S,
                    o = n.closest("[" + this.attr_name() + "]"),
                    r = n.children("a").first(),
                    l = "#" + r.attr("href").split("#")[1],
                    c = a(l),
                    d = n.siblings(),
                    u = o.data(this.attr_name(!0) + "-init");
                if (a(this).data(this.data_attr("tab-content")) && (l = "#" + a(this).data(this.data_attr("tab-content")).split("#")[1], c = a(l)), u.deep_linking) {
                    var h = t("body,html").scrollTop();
                    s != i ? e.location.hash = s : e.location.hash = l, u.scroll_to_content ? s == i || s == l ? n.parent()[0].scrollIntoView() : a(l)[0].scrollIntoView() : (s == i || s == l) && t("body,html").scrollTop(h)
                }
                n.addClass(u.active_class).triggerHandler("opened"), d.removeClass(u.active_class), c.siblings().removeClass(u.active_class).end().addClass(u.active_class), u.callback(n), c.triggerHandler("toggled", [n]), o.triggerHandler("toggled", [c])
            },
            data_attr: function(t) {
                return this.namespace.length > 0 ? this.namespace + "-" + t : t
            },
            off: function() {},
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.clearing = {
            name: "clearing",
            version: "5.2.2",
            settings: {
                templates: {
                    viewing: '<a href="#" class="clearing-close">&times;</a><div class="visible-img" style="display: none"><div class="clearing-touch-label"></div><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" alt="" /><p class="clearing-caption"></p><a href="#" class="clearing-main-prev"><span></span></a><a href="#" class="clearing-main-next"><span></span></a></div>'
                },
                close_selectors: ".clearing-close",
                touch_label: "",
                init: !1,
                locked: !1
            },
            init: function(t, e, n) {
                var i = this;
                Foundation.inherit(this, "throttle image_loaded"), this.bindings(e, n), i.S(this.scope).is("[" + this.attr_name() + "]") ? this.assemble(i.S("li", this.scope)) : i.S("[" + this.attr_name() + "]", this.scope).each(function() {
                    i.assemble(i.S("li", this))
                })
            },
            events: function(i) {
                var s = this,
                    a = s.S;
                t(".scroll-container").length > 0 && (this.scope = t(".scroll-container")), a(this.scope).off(".clearing").on("click.fndtn.clearing", "ul[" + this.attr_name() + "] li", function(t, e, n) {
                    var e = e || a(this),
                        n = n || e,
                        i = e.next("li"),
                        o = e.closest("[" + s.attr_name() + "]").data(s.attr_name(!0) + "-init"),
                        r = a(t.target);
                    t.preventDefault(), o || (s.init(), o = e.closest("[" + s.attr_name() + "]").data(s.attr_name(!0) + "-init")), n.hasClass("visible") && e[0] === n[0] && i.length > 0 && s.is_open(e) && (n = i, r = a("img", n)), s.open(r, e, n), s.update_paddles(n)
                }).on("click.fndtn.clearing", ".clearing-main-next", function(t) {
                    s.nav(t, "next")
                }).on("click.fndtn.clearing", ".clearing-main-prev", function(t) {
                    s.nav(t, "prev")
                }).on("click.fndtn.clearing", this.settings.close_selectors, function(t) {
                    Foundation.libs.clearing.close(t, this)
                }), t(n).on("keydown.fndtn.clearing", function(t) {
                    s.keydown(t)
                }), a(e).off(".clearing").on("resize.fndtn.clearing", function() {
                    s.resize()
                }), this.swipe_events(i)
            },
            swipe_events: function(t) {
                var e = this,
                    n = e.S;
                n(this.scope).on("touchstart.fndtn.clearing", ".visible-img", function(t) {
                    t.touches || (t = t.originalEvent);
                    var e = {
                        start_page_x: t.touches[0].pageX,
                        start_page_y: t.touches[0].pageY,
                        start_time: (new Date).getTime(),
                        delta_x: 0,
                        is_scrolling: i
                    };
                    n(this).data("swipe-transition", e), t.stopPropagation()
                }).on("touchmove.fndtn.clearing", ".visible-img", function(t) {
                    if (t.touches || (t = t.originalEvent), !(t.touches.length > 1 || t.scale && 1 !== t.scale)) {
                        var i = n(this).data("swipe-transition");
                        if ("undefined" == typeof i && (i = {}), i.delta_x = t.touches[0].pageX - i.start_page_x, "undefined" == typeof i.is_scrolling && (i.is_scrolling = !!(i.is_scrolling || Math.abs(i.delta_x) < Math.abs(t.touches[0].pageY - i.start_page_y))), !i.is_scrolling && !i.active) {
                            t.preventDefault();
                            var s = i.delta_x < 0 ? "next" : "prev";
                            i.active = !0, e.nav(t, s)
                        }
                    }
                }).on("touchend.fndtn.clearing", ".visible-img", function(t) {
                    n(this).data("swipe-transition", {}), t.stopPropagation()
                })
            },
            assemble: function(e) {
                var n = e.parent();
                if (!n.parent().hasClass("carousel")) {
                    n.after('<div id="foundationClearingHolder"></div>');
                    var i = n.detach(),
                        s = "";
                    if (null != i[0]) {
                        s = i[0].outerHTML;
                        var a = this.S("#foundationClearingHolder"),
                            o = n.data(this.attr_name(!0) + "-init"),
                            i = n.detach(),
                            r = {
                                grid: '<div class="carousel">' + s + "</div>",
                                viewing: o.templates.viewing
                            },
                            l = '<div class="clearing-assembled"><div>' + r.viewing + r.grid + "</div></div>",
                            c = this.settings.touch_label;
                        Modernizr.touch && (l = t(l).find(".clearing-touch-label").html(c).end()), a.after(l).remove()
                    }
                }
            },
            open: function(e, i, s) {
                function a() {
                    setTimeout(function() {
                        this.image_loaded(h, function() {
                            1 !== h.outerWidth() || p ? o.call(this, h) : a.call(this)
                        }.bind(this))
                    }.bind(this), 50)
                }

                function o(e) {
                    t(e);
                    e.css("visibility", "visible"), l.css("overflow", "hidden"), c.addClass("clearing-blackout"), d.addClass("clearing-container"), u.show(), this.fix_height(s).caption(r.S(".clearing-caption", u), r.S("img", s)).center_and_label(e, f).shift(i, s, function() {
                        s.siblings().removeClass("visible"), s.addClass("visible")
                    })
                }
                var r = this,
                    l = t(n.body),
                    c = s.closest(".clearing-assembled"),
                    d = r.S("div", c).first(),
                    u = r.S(".visible-img", d),
                    h = r.S("img", u).not(e),
                    f = r.S(".clearing-touch-label", d),
                    p = !1;
                h.error(function() {
                    p = !0
                }), this.locked() || (h.attr("src", this.load(e)).css("visibility", "hidden"), a.call(this))
            },
            close: function(e, i) {
                e.preventDefault();
                var s, a, o = function(t) {
                        return /blackout/.test(t.selector) ? t : t.closest(".clearing-blackout")
                    }(t(i)),
                    r = t(n.body);
                return i === e.target && o && (r.css("overflow", ""), s = t("div", o).first(), a = t(".visible-img", s), this.settings.prev_index = 0, t("ul[" + this.attr_name() + "]", o).attr("style", "").closest(".clearing-blackout").removeClass("clearing-blackout"), s.removeClass("clearing-container"), a.hide()), !1
            },
            is_open: function(t) {
                return t.parent().prop("style").length > 0
            },
            keydown: function(e) {
                var n = t(".clearing-blackout ul[" + this.attr_name() + "]"),
                    i = this.rtl ? 37 : 39,
                    s = this.rtl ? 39 : 37,
                    a = 27;
                e.which === i && this.go(n, "next"), e.which === s && this.go(n, "prev"), e.which === a && this.S("a.clearing-close").trigger("click")
            },
            nav: function(e, n) {
                var i = t("ul[" + this.attr_name() + "]", ".clearing-blackout");
                e.preventDefault(), this.go(i, n)
            },
            resize: function() {
                var e = t("img", ".clearing-blackout .visible-img"),
                    n = t(".clearing-touch-label", ".clearing-blackout");
                e.length && this.center_and_label(e, n)
            },
            fix_height: function(t) {
                var e = t.parent().children(),
                    n = this;
                return e.each(function() {
                    var t = n.S(this),
                        e = t.find("img");
                    t.height() > e.outerHeight() && t.addClass("fix-height")
                }).closest("ul").width(100 * e.length + "%"), this
            },
            update_paddles: function(t) {
                var e = t.closest(".carousel").siblings(".visible-img");
                t.next().length > 0 ? this.S(".clearing-main-next", e).removeClass("disabled") : this.S(".clearing-main-next", e).addClass("disabled"), t.prev().length > 0 ? this.S(".clearing-main-prev", e).removeClass("disabled") : this.S(".clearing-main-prev", e).addClass("disabled")
            },
            center_and_label: function(t, e) {
                return this.rtl ? (t.css({
                    marginRight: -(t.outerWidth() / 2),
                    marginTop: -(t.outerHeight() / 2),
                    left: "auto",
                    right: "50%"
                }), e.length > 0 && e.css({
                    marginRight: -(e.outerWidth() / 2),
                    marginTop: -(t.outerHeight() / 2) - e.outerHeight() - 10,
                    left: "auto",
                    right: "50%"
                })) : (t.css({
                    marginLeft: -(t.outerWidth() / 2),
                    marginTop: -(t.outerHeight() / 2)
                }), e.length > 0 && e.css({
                    marginLeft: -(e.outerWidth() / 2),
                    marginTop: -(t.outerHeight() / 2) - e.outerHeight() - 10
                })), this
            },
            load: function(t) {
                if ("A" === t[0].nodeName) var e = t.attr("href");
                else var e = t.parent().attr("href");
                return this.preload(t), e ? e : t.attr("src")
            },
            preload: function(t) {
                this.img(t.closest("li").next()).img(t.closest("li").prev())
            },
            img: function(t) {
                if (t.length) {
                    var e = new Image,
                        n = this.S("a", t);
                    n.length ? e.src = n.attr("href") : e.src = this.S("img", t).attr("src")
                }
                return this
            },
            caption: function(t, e) {
                var n = e.attr("data-caption");
                return n ? t.html(n).show() : t.text("").hide(), this
            },
            go: function(t, e) {
                var n = this.S(".visible", t),
                    i = n[e]();
                i.length && this.S("img", i).trigger("click", [n, i])
            },
            shift: function(t, e, n) {
                var i, s = e.parent(),
                    a = this.settings.prev_index || e.index(),
                    o = this.direction(s, t, e),
                    r = this.rtl ? "right" : "left",
                    l = parseInt(s.css("left"), 10),
                    c = e.outerWidth(),
                    d = {};
                e.index() === a || /skip/.test(o) ? /skip/.test(o) && (i = e.index() - this.settings.up_count, this.lock(), i > 0 ? (d[r] = -(i * c), s.animate(d, 300, this.unlock())) : (d[r] = 0, s.animate(d, 300, this.unlock()))) : /left/.test(o) ? (this.lock(), d[r] = l + c, s.animate(d, 300, this.unlock())) : /right/.test(o) && (this.lock(), d[r] = l - c, s.animate(d, 300, this.unlock())), n()
            },
            direction: function(t, e, n) {
                var i, s = this.S("li", t),
                    a = s.outerWidth() + s.outerWidth() / 4,
                    o = Math.floor(this.S(".clearing-container").outerWidth() / a) - 1,
                    r = s.index(n);
                return this.settings.up_count = o, i = this.adjacent(this.settings.prev_index, r) ? r > o && r > this.settings.prev_index ? "right" : r > o - 1 && r <= this.settings.prev_index ? "left" : !1 : "skip", this.settings.prev_index = r, i
            },
            adjacent: function(t, e) {
                for (var n = e + 1; n >= e - 1; n--)
                    if (n === t) return !0;
                return !1
            },
            lock: function() {
                this.settings.locked = !0
            },
            unlock: function() {
                this.settings.locked = !1
            },
            locked: function() {
                return this.settings.locked
            },
            off: function() {
                this.S(this.scope).off(".fndtn.clearing"), this.S(e).off(".fndtn.clearing")
            },
            reflow: function() {
                this.init()
            }
        }
    }(jQuery, this, this.document), ! function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
    }(function(t) {
        function e(t) {
            return r.raw ? t : encodeURIComponent(t)
        }

        function n(t) {
            return r.raw ? t : decodeURIComponent(t)
        }

        function i(t) {
            return e(r.json ? JSON.stringify(t) : String(t))
        }

        function s(t) {
            0 === t.indexOf('"') && (t = t.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
            try {
                t = decodeURIComponent(t.replace(o, " "))
            } catch (e) {
                return
            }
            try {
                return r.json ? JSON.parse(t) : t
            } catch (e) {}
        }

        function a(e, n) {
            var i = r.raw ? e : s(e);
            return t.isFunction(n) ? n(i) : i
        }
        var o = /\+/g,
            r = t.cookie = function(s, o, l) {
                if (void 0 !== o && !t.isFunction(o)) {
                    if (l = t.extend({}, r.defaults, l), "number" == typeof l.expires) {
                        var c = l.expires,
                            d = l.expires = new Date;
                        d.setDate(d.getDate() + c)
                    }
                    return document.cookie = [e(s), "=", i(o), l.expires ? "; expires=" + l.expires.toUTCString() : "", l.path ? "; path=" + l.path : "", l.domain ? "; domain=" + l.domain : "", l.secure ? "; secure" : ""].join("")
                }
                for (var u = s ? void 0 : {}, h = document.cookie ? document.cookie.split("; ") : [], f = 0, p = h.length; p > f; f++) {
                    var g = h[f].split("="),
                        m = n(g.shift()),
                        v = g.join("=");
                    if (s && s === m) {
                        u = a(v, o);
                        break
                    }
                    s || void 0 === (v = a(v)) || (u[m] = v)
                }
                return u
            };
        r.defaults = {}, t.removeCookie = function(e, n) {
            return void 0 !== t.cookie(e) ? (t.cookie(e, "", t.extend({}, n, {
                expires: -1
            })), !0) : !1
        }
    }),
    function(t, e, n, i) {
        "use strict";
        var s = s || !1;
        Foundation.libs.joyride = {
            name: "joyride",
            version: "5.2.2",
            defaults: {
                expose: !1,
                modal: !0,
                tip_location: "bottom",
                nub_position: "auto",
                scroll_speed: 1500,
                scroll_animation: "linear",
                timer: 0,
                start_timer_on_click: !0,
                start_offset: 0,
                next_button: !0,
                tip_animation: "fade",
                pause_after: [],
                exposed: [],
                tip_animation_fade_speed: 300,
                cookie_monster: !1,
                cookie_name: "joyride",
                cookie_domain: !1,
                cookie_expires: 365,
                tip_container: "body",
                abort_on_close: !0,
                tip_location_patterns: {
                    top: ["bottom"],
                    bottom: [],
                    left: ["right", "top", "bottom"],
                    right: ["left", "top", "bottom"]
                },
                post_ride_callback: function() {},
                post_step_callback: function() {},
                pre_step_callback: function() {},
                pre_ride_callback: function() {},
                post_expose_callback: function() {},
                template: {
                    link: '<a href="#close" class="joyride-close-tip">&times;</a>',
                    timer: '<div class="joyride-timer-indicator-wrap"><span class="joyride-timer-indicator"></span></div>',
                    tip: '<div class="joyride-tip-guide"><span class="joyride-nub"></span></div>',
                    wrapper: '<div class="joyride-content-wrapper"></div>',
                    button: '<a href="#" class="small button joyride-next-tip"></a>',
                    modal: '<div class="joyride-modal-bg"></div>',
                    expose: '<div class="joyride-expose-wrapper"></div>',
                    expose_cover: '<div class="joyride-expose-cover"></div>'
                },
                expose_add_class: ""
            },
            init: function(e, n, i) {
                Foundation.inherit(this, "throttle random_str"), this.settings = this.settings || t.extend({}, this.defaults, i || n), this.bindings(n, i)
            },
            events: function() {
                var n = this;
                t(this.scope).off(".joyride").on("click.fndtn.joyride", ".joyride-next-tip, .joyride-modal-bg", function(t) {
                    t.preventDefault(), this.settings.$li.next().length < 1 ? this.end() : this.settings.timer > 0 ? (clearTimeout(this.settings.automate), this.hide(), this.show(), this.startTimer()) : (this.hide(), this.show())
                }.bind(this)).on("click.fndtn.joyride", ".joyride-close-tip", function(t) {
                    t.preventDefault(), this.end(this.settings.abort_on_close)
                }.bind(this)), t(e).off(".joyride").on("resize.fndtn.joyride", n.throttle(function() {
                    if (t("[" + n.attr_name() + "]").length > 0 && n.settings.$next_tip) {
                        if (n.settings.exposed.length > 0) {
                            var e = t(n.settings.exposed);
                            e.each(function() {
                                var e = t(this);
                                n.un_expose(e), n.expose(e)
                            })
                        }
                        n.is_phone() ? n.pos_phone() : n.pos_default(!1, !0)
                    }
                }, 100))
            },
            start: function() {
                var e = this,
                    n = t("[" + this.attr_name() + "]", this.scope),
                    i = ["timer", "scrollSpeed", "startOffset", "tipAnimationFadeSpeed", "cookieExpires"],
                    s = i.length;
                !n.length > 0 || (this.settings.init || this.events(), this.settings = n.data(this.attr_name(!0) + "-init"), this.settings.$content_el = n, this.settings.$body = t(this.settings.tip_container), this.settings.body_offset = t(this.settings.tip_container).position(), this.settings.$tip_content = this.settings.$content_el.find("> li"), this.settings.paused = !1, this.settings.attempts = 0, "function" != typeof t.cookie && (this.settings.cookie_monster = !1), (!this.settings.cookie_monster || this.settings.cookie_monster && !t.cookie(this.settings.cookie_name)) && (this.settings.$tip_content.each(function(n) {
                    var a = t(this);
                    this.settings = t.extend({}, e.defaults, e.data_options(a));
                    for (var o = s; o--;) e.settings[i[o]] = parseInt(e.settings[i[o]], 10);
                    e.create({
                        $li: a,
                        index: n
                    })
                }), !this.settings.start_timer_on_click && this.settings.timer > 0 ? (this.show("init"), this.startTimer()) : this.show("init")))
            },
            resume: function() {
                this.set_li(), this.show()
            },
            tip_template: function(e) {
                var n, i;
                return e.tip_class = e.tip_class || "", n = t(this.settings.template.tip).addClass(e.tip_class), i = t.trim(t(e.li).html()) + this.button_text(e.button_text) + this.settings.template.link + this.timer_instance(e.index), n.append(t(this.settings.template.wrapper)), n.first().attr(this.add_namespace("data-index"), e.index), t(".joyride-content-wrapper", n).append(i), n[0]
            },
            timer_instance: function(e) {
                var n;
                return n = 0 === e && this.settings.start_timer_on_click && this.settings.timer > 0 || 0 === this.settings.timer ? "" : t(this.settings.template.timer)[0].outerHTML
            },
            button_text: function(e) {
                return this.settings.next_button ? (e = t.trim(e) || "Next", e = t(this.settings.template.button).append(e)[0].outerHTML) : e = "", e
            },
            create: function(e) {
                var n = e.$li.attr(this.add_namespace("data-button")) || e.$li.attr(this.add_namespace("data-text")),
                    i = e.$li.attr("class"),
                    s = t(this.tip_template({
                        tip_class: i,
                        index: e.index,
                        button_text: n,
                        li: e.$li
                    }));
                t(this.settings.tip_container).append(s)
            },
            show: function(e) {
                var n = null;
                this.settings.$li === i || -1 === t.inArray(this.settings.$li.index(), this.settings.pause_after) ? (this.settings.paused ? this.settings.paused = !1 : this.set_li(e),
                    this.settings.attempts = 0, this.settings.$li.length && this.settings.$target.length > 0 ? (e && (this.settings.pre_ride_callback(this.settings.$li.index(), this.settings.$next_tip), this.settings.modal && this.show_modal()), this.settings.pre_step_callback(this.settings.$li.index(), this.settings.$next_tip), this.settings.modal && this.settings.expose && this.expose(), this.settings.tip_settings = t.extend({}, this.settings, this.data_options(this.settings.$li)), this.settings.timer = parseInt(this.settings.timer, 10), this.settings.tip_settings.tip_location_pattern = this.settings.tip_location_patterns[this.settings.tip_settings.tip_location], /body/i.test(this.settings.$target.selector) || this.scroll_to(), this.is_phone() ? this.pos_phone(!0) : this.pos_default(!0), n = this.settings.$next_tip.find(".joyride-timer-indicator"), /pop/i.test(this.settings.tip_animation) ? (n.width(0), this.settings.timer > 0 ? (this.settings.$next_tip.show(), setTimeout(function() {
                        n.animate({
                            width: n.parent().width()
                        }, this.settings.timer, "linear")
                    }.bind(this), this.settings.tip_animation_fade_speed)) : this.settings.$next_tip.show()) : /fade/i.test(this.settings.tip_animation) && (n.width(0), this.settings.timer > 0 ? (this.settings.$next_tip.fadeIn(this.settings.tip_animation_fade_speed).show(), setTimeout(function() {
                        n.animate({
                            width: n.parent().width()
                        }, this.settings.timer, "linear")
                    }.bind(this), this.settings.tip_animation_fadeSpeed)) : this.settings.$next_tip.fadeIn(this.settings.tip_animation_fade_speed)), this.settings.$current_tip = this.settings.$next_tip) : this.settings.$li && this.settings.$target.length < 1 ? this.show() : this.end()) : this.settings.paused = !0
            },
            is_phone: function() {
                return matchMedia(Foundation.media_queries.small).matches && !matchMedia(Foundation.media_queries.medium).matches
            },
            hide: function() {
                this.settings.modal && this.settings.expose && this.un_expose(), this.settings.modal || t(".joyride-modal-bg").hide(), this.settings.$current_tip.css("visibility", "hidden"), setTimeout(t.proxy(function() {
                    this.hide(), this.css("visibility", "visible")
                }, this.settings.$current_tip), 0), this.settings.post_step_callback(this.settings.$li.index(), this.settings.$current_tip)
            },
            set_li: function(t) {
                t ? (this.settings.$li = this.settings.$tip_content.eq(this.settings.start_offset), this.set_next_tip(), this.settings.$current_tip = this.settings.$next_tip) : (this.settings.$li = this.settings.$li.next(), this.set_next_tip()), this.set_target()
            },
            set_next_tip: function() {
                this.settings.$next_tip = t(".joyride-tip-guide").eq(this.settings.$li.index()), this.settings.$next_tip.data("closed", "")
            },
            set_target: function() {
                var e = this.settings.$li.attr(this.add_namespace("data-class")),
                    i = this.settings.$li.attr(this.add_namespace("data-id")),
                    s = function() {
                        return i ? t(n.getElementById(i)) : e ? t("." + e).first() : t("body")
                    };
                this.settings.$target = s()
            },
            scroll_to: function() {
                var n, i;
                n = t(e).height() / 2, i = Math.ceil(this.settings.$target.offset().top - n + this.settings.$next_tip.outerHeight()), 0 != i && t("html, body").animate({
                    scrollTop: i
                }, this.settings.scroll_speed, "swing")
            },
            paused: function() {
                return -1 === t.inArray(this.settings.$li.index() + 1, this.settings.pause_after)
            },
            restart: function() {
                this.hide(), this.settings.$li = i, this.show("init")
            },
            pos_default: function(n, i) {
                var s = (Math.ceil(t(e).height() / 2), this.settings.$next_tip.offset(), this.settings.$next_tip.find(".joyride-nub")),
                    a = Math.ceil(s.outerWidth() / 2),
                    o = Math.ceil(s.outerHeight() / 2),
                    r = n || !1;
                r && (this.settings.$next_tip.css("visibility", "hidden"), this.settings.$next_tip.show()), "undefined" == typeof i && (i = !1), /body/i.test(this.settings.$target.selector) ? this.settings.$li.length && this.pos_modal(s) : (this.bottom() ? (this.rtl ? this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top + o + this.settings.$target.outerHeight(),
                    left: this.settings.$target.offset().left + this.settings.$target.outerWidth() - this.settings.$next_tip.outerWidth()
                }) : this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top + o + this.settings.$target.outerHeight(),
                    left: this.settings.$target.offset().left
                }), this.nub_position(s, this.settings.tip_settings.nub_position, "top")) : this.top() ? (this.rtl ? this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top - this.settings.$next_tip.outerHeight() - o,
                    left: this.settings.$target.offset().left + this.settings.$target.outerWidth() - this.settings.$next_tip.outerWidth()
                }) : this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top - this.settings.$next_tip.outerHeight() - o,
                    left: this.settings.$target.offset().left
                }), this.nub_position(s, this.settings.tip_settings.nub_position, "bottom")) : this.right() ? (this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top,
                    left: this.settings.$target.outerWidth() + this.settings.$target.offset().left + a
                }), this.nub_position(s, this.settings.tip_settings.nub_position, "left")) : this.left() && (this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top,
                    left: this.settings.$target.offset().left - this.settings.$next_tip.outerWidth() - a
                }), this.nub_position(s, this.settings.tip_settings.nub_position, "right")), !this.visible(this.corners(this.settings.$next_tip)) && this.settings.attempts < this.settings.tip_settings.tip_location_pattern.length && (s.removeClass("bottom").removeClass("top").removeClass("right").removeClass("left"), this.settings.tip_settings.tip_location = this.settings.tip_settings.tip_location_pattern[this.settings.attempts], this.settings.attempts++, this.pos_default())), r && (this.settings.$next_tip.hide(), this.settings.$next_tip.css("visibility", "visible"))
            },
            pos_phone: function(e) {
                var n = this.settings.$next_tip.outerHeight(),
                    i = (this.settings.$next_tip.offset(), this.settings.$target.outerHeight()),
                    s = t(".joyride-nub", this.settings.$next_tip),
                    a = Math.ceil(s.outerHeight() / 2),
                    o = e || !1;
                s.removeClass("bottom").removeClass("top").removeClass("right").removeClass("left"), o && (this.settings.$next_tip.css("visibility", "hidden"), this.settings.$next_tip.show()), /body/i.test(this.settings.$target.selector) ? this.settings.$li.length && this.pos_modal(s) : this.top() ? (this.settings.$next_tip.offset({
                    top: this.settings.$target.offset().top - n - a
                }), s.addClass("bottom")) : (this.settings.$next_tip.offset({
                    top: this.settings.$target.offset().top + i + a
                }), s.addClass("top")), o && (this.settings.$next_tip.hide(), this.settings.$next_tip.css("visibility", "visible"))
            },
            pos_modal: function(t) {
                this.center(), t.hide(), this.show_modal()
            },
            show_modal: function() {
                if (!this.settings.$next_tip.data("closed")) {
                    var e = t(".joyride-modal-bg");
                    e.length < 1 && t("body").append(this.settings.template.modal).show(), /pop/i.test(this.settings.tip_animation) ? e.show() : e.fadeIn(this.settings.tip_animation_fade_speed)
                }
            },
            expose: function() {
                var n, i, s, a, o, r = "expose-" + this.random_str(6);
                if (arguments.length > 0 && arguments[0] instanceof t) s = arguments[0];
                else {
                    if (!this.settings.$target || /body/i.test(this.settings.$target.selector)) return !1;
                    s = this.settings.$target
                }
                return s.length < 1 ? (e.console && console.error("element not valid", s), !1) : (n = t(this.settings.template.expose), this.settings.$body.append(n), n.css({
                    top: s.offset().top,
                    left: s.offset().left,
                    width: s.outerWidth(!0),
                    height: s.outerHeight(!0)
                }), i = t(this.settings.template.expose_cover), a = {
                    zIndex: s.css("z-index"),
                    position: s.css("position")
                }, o = null == s.attr("class") ? "" : s.attr("class"), s.css("z-index", parseInt(n.css("z-index")) + 1), "static" == a.position && s.css("position", "relative"), s.data("expose-css", a), s.data("orig-class", o), s.attr("class", o + " " + this.settings.expose_add_class), i.css({
                    top: s.offset().top,
                    left: s.offset().left,
                    width: s.outerWidth(!0),
                    height: s.outerHeight(!0)
                }), this.settings.modal && this.show_modal(), this.settings.$body.append(i), n.addClass(r), i.addClass(r), s.data("expose", r), this.settings.post_expose_callback(this.settings.$li.index(), this.settings.$next_tip, s), this.add_exposed(s), void 0)
            },
            un_expose: function() {
                var n, i, s, a, o, r = !1;
                if (arguments.length > 0 && arguments[0] instanceof t) i = arguments[0];
                else {
                    if (!this.settings.$target || /body/i.test(this.settings.$target.selector)) return !1;
                    i = this.settings.$target
                }
                return i.length < 1 ? (e.console && console.error("element not valid", i), !1) : (n = i.data("expose"), s = t("." + n), arguments.length > 1 && (r = arguments[1]), r === !0 ? t(".joyride-expose-wrapper,.joyride-expose-cover").remove() : s.remove(), a = i.data("expose-css"), "auto" == a.zIndex ? i.css("z-index", "") : i.css("z-index", a.zIndex), a.position != i.css("position") && ("static" == a.position ? i.css("position", "") : i.css("position", a.position)), o = i.data("orig-class"), i.attr("class", o), i.removeData("orig-classes"), i.removeData("expose"), i.removeData("expose-z-index"), this.remove_exposed(i), void 0)
            },
            add_exposed: function(e) {
                this.settings.exposed = this.settings.exposed || [], e instanceof t || "object" == typeof e ? this.settings.exposed.push(e[0]) : "string" == typeof e && this.settings.exposed.push(e)
            },
            remove_exposed: function(e) {
                var n, i;
                for (e instanceof t ? n = e[0] : "string" == typeof e && (n = e), this.settings.exposed = this.settings.exposed || [], i = this.settings.exposed.length; i--;)
                    if (this.settings.exposed[i] == n) return void this.settings.exposed.splice(i, 1)
            },
            center: function() {
                var n = t(e);
                return this.settings.$next_tip.css({
                    top: (n.height() - this.settings.$next_tip.outerHeight()) / 2 + n.scrollTop(),
                    left: (n.width() - this.settings.$next_tip.outerWidth()) / 2 + n.scrollLeft()
                }), !0
            },
            bottom: function() {
                return /bottom/i.test(this.settings.tip_settings.tip_location)
            },
            top: function() {
                return /top/i.test(this.settings.tip_settings.tip_location)
            },
            right: function() {
                return /right/i.test(this.settings.tip_settings.tip_location)
            },
            left: function() {
                return /left/i.test(this.settings.tip_settings.tip_location)
            },
            corners: function(n) {
                var i = t(e),
                    s = i.height() / 2,
                    a = Math.ceil(this.settings.$target.offset().top - s + this.settings.$next_tip.outerHeight()),
                    o = i.width() + i.scrollLeft(),
                    r = i.height() + a,
                    l = i.height() + i.scrollTop(),
                    c = i.scrollTop();
                return c > a && (c = 0 > a ? 0 : a), r > l && (l = r), [n.offset().top < c, o < n.offset().left + n.outerWidth(), l < n.offset().top + n.outerHeight(), i.scrollLeft() > n.offset().left]
            },
            visible: function(t) {
                for (var e = t.length; e--;)
                    if (t[e]) return !1;
                return !0
            },
            nub_position: function(t, e, n) {
                "auto" === e ? t.addClass(n) : t.addClass(e)
            },
            startTimer: function() {
                this.settings.$li.length ? this.settings.automate = setTimeout(function() {
                    this.hide(), this.show(), this.startTimer()
                }.bind(this), this.settings.timer) : clearTimeout(this.settings.automate)
            },
            end: function(e) {
                this.settings.cookie_monster && t.cookie(this.settings.cookie_name, "ridden", {
                    expires: this.settings.cookie_expires,
                    domain: this.settings.cookie_domain
                }), this.settings.timer > 0 && clearTimeout(this.settings.automate), this.settings.modal && this.settings.expose && this.un_expose(), this.settings.$next_tip.data("closed", !0), t(".joyride-modal-bg").hide(), this.settings.$current_tip.hide(), "undefined" == typeof e && (this.settings.post_step_callback(this.settings.$li.index(), this.settings.$current_tip), this.settings.post_ride_callback(this.settings.$li.index(), this.settings.$current_tip)), t(".joyride-tip-guide").remove()
            },
            off: function() {
                t(this.scope).off(".joyride"), t(e).off(".joyride"), t(".joyride-close-tip, .joyride-next-tip, .joyride-modal-bg").off(".joyride"), t(".joyride-tip-guide, .joyride-modal-bg").remove(), clearTimeout(this.settings.automate), this.settings = {}
            },
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        var s = function() {},
            a = function(i, s) {
                if (i.hasClass(s.slides_container_class)) return this;
                var a, l, c, d, u, h = this,
                    f = i,
                    p = 0,
                    g = f.find("." + s.active_slide_class).length > 0;
                h.cache = {}, h.slides = function() {
                    return f.children(s.slide_selector)
                }, g || h.slides().first().addClass(s.active_slide_class), h.update_slide_number = function(e) {
                    s.slide_number && (l.find("span:first").text(parseInt(e) + 1), l.find("span:last").text(h.slides().length)), s.bullets && (c.children().removeClass(s.bullets_active_class), t(c.children().get(e)).addClass(s.bullets_active_class))
                }, h.update_active_link = function(e) {
                    var n = t('[data-orbit-link="' + h.slides().eq(e).attr("data-orbit-slide") + '"]');
                    n.siblings().removeClass(s.bullets_active_class), n.addClass(s.bullets_active_class)
                }, h.build_markup = function() {
                    f.wrap('<div class="' + s.container_class + '"></div>'), a = f.parent(), f.addClass(s.slides_container_class), f.addClass(s.animation), s.stack_on_small && a.addClass(s.stack_on_small_class), s.navigation_arrows && (a.append(t('<a href="#"><span></span></a>').addClass(s.prev_class)), a.append(t('<a href="#"><span></span></a>').addClass(s.next_class))), s.timer && (d = t("<div>").addClass(s.timer_container_class), d.append("<span>"), s.timer_show_progress_bar && d.append(t("<div>").addClass(s.timer_progress_class)), d.addClass(s.timer_paused_class), a.append(d)), s.slide_number && (l = t("<div>").addClass(s.slide_number_class), l.append("<span></span> " + s.slide_number_text + " <span></span>"), a.append(l)), s.bullets && (c = t("<ol>").addClass(s.bullets_container_class), a.append(c), c.wrap('<div class="orbit-bullets-container"></div>'), h.slides().each(function(e, n) {
                        var i = t("<li>").attr("data-orbit-slide", e);
                        c.append(i)
                    }))
                }, h._prepare_direction = function(e, n) {
                    var i = "next";
                    p >= e && (i = "prev"), "slide" === s.animation && setTimeout(function() {
                        f.removeClass("swipe-prev swipe-next"), "next" === i ? f.addClass("swipe-next") : "prev" === i && f.addClass("swipe-prev")
                    }, 0);
                    var a = h.slides();
                    if (e >= a.length) {
                        if (!s.circular) return !1;
                        e = 0
                    } else if (0 > e) {
                        if (!s.circular) return !1;
                        e = a.length - 1
                    }
                    var o = t(a.get(p)),
                        r = t(a.get(e));
                    return [i, o, r, e]
                }, h._goto = function(t, e) {
                    if (null === t) return !1;
                    if (h.cache.animating) return !1;
                    if (t === p) return !1;
                    "object" == typeof h.cache.timer && h.cache.timer.restart();
                    var n = h.slides();
                    h.cache.animating = !0;
                    var i = h._prepare_direction(t),
                        a = i[0],
                        o = i[1],
                        r = i[2],
                        t = i[3];
                    if (i === !1) return !1;
                    f.trigger("before-slide-change.fndtn.orbit"), s.before_slide_change(), p = t, o.css("transitionDuration", s.animation_speed + "ms"), r.css("transitionDuration", s.animation_speed + "ms");
                    var l = function() {
                        var i = function() {
                            e === !0 && h.cache.timer.restart(), h.update_slide_number(p), r.addClass(s.active_slide_class), h.update_active_link(t), f.trigger("after-slide-change.fndtn.orbit", [{
                                slide_number: p,
                                total_slides: n.length
                            }]), s.after_slide_change(p, n.length), setTimeout(function() {
                                h.cache.animating = !1
                            }, 100)
                        };
                        f.height() != r.height() && s.variable_height ? f.animate({
                            height: r.height()
                        }, 250, "linear", i) : i()
                    };
                    if (1 === n.length) return l(), !1;
                    var c = function() {
                        "next" === a && u.next(o, r, l), "prev" === a && u.prev(o, r, l)
                    };
                    r.height() > f.height() && s.variable_height ? f.animate({
                        height: r.height()
                    }, 250, "linear", c) : c()
                }, h.next = function(t) {
                    t.stopImmediatePropagation(), t.preventDefault(), h._prepare_direction(p + 1), setTimeout(function() {
                        h._goto(p + 1)
                    }, 100)
                }, h.prev = function(t) {
                    t.stopImmediatePropagation(), t.preventDefault(), h._prepare_direction(p - 1), setTimeout(function() {
                        h._goto(p - 1)
                    }, 100)
                }, h.link_custom = function(e) {
                    e.preventDefault();
                    var n = t(this).attr("data-orbit-link");
                    if ("string" == typeof n && "" != (n = t.trim(n))) {
                        var i = a.find("[data-orbit-slide=" + n + "]"); - 1 != i.index() && setTimeout(function() {
                            h._goto(i.index())
                        }, 100)
                    }
                }, h.link_bullet = function(e) {
                    var n = t(this).attr("data-orbit-slide");
                    if ("string" == typeof n && "" != (n = t.trim(n)))
                        if (isNaN(parseInt(n))) {
                            var i = a.find("[data-orbit-slide=" + n + "]"); - 1 != i.index() && setTimeout(function() {
                                h._goto(i.index() + 1)
                            }, 100)
                        } else setTimeout(function() {
                            h._goto(parseInt(n))
                        }, 100)
                }, h.timer_callback = function() {
                    h._goto(p + 1, !0)
                }, h.compute_dimensions = function() {
                    var e = t(h.slides().get(p)),
                        n = e.height();
                    s.variable_height || h.slides().each(function() {
                        t(this).height() > n && (n = t(this).height())
                    }), f.height(n)
                }, h.create_timer = function() {
                    var t = new o(a.find("." + s.timer_container_class), s, h.timer_callback);
                    return t
                }, h.stop_timer = function() {
                    "object" == typeof h.cache.timer && h.cache.timer.stop()
                }, h.toggle_timer = function() {
                    var t = a.find("." + s.timer_container_class);
                    t.hasClass(s.timer_paused_class) ? ("undefined" == typeof h.cache.timer && (h.cache.timer = h.create_timer()), h.cache.timer.start()) : "object" == typeof h.cache.timer && h.cache.timer.stop()
                }, h.init = function() {
                    if (h.build_markup(), s.timer && (h.cache.timer = h.create_timer(), Foundation.utils.image_loaded(this.slides().children("img"), h.cache.timer.start)), u = new r(s, f), g) {
                        var i = f.find("." + s.active_slide_class),
                            o = s.animation_speed;
                        s.animation_speed = 1, i.removeClass("active"), h._goto(i.index()), s.animation_speed = o
                    }
                    a.on("click", "." + s.next_class, h.next), a.on("click", "." + s.prev_class, h.prev), s.next_on_click && a.on("click", "[data-orbit-slide]", h.link_bullet), a.on("click", h.toggle_timer), s.swipe && f.on("touchstart.fndtn.orbit", function(t) {
                        h.cache.animating || (t.touches || (t = t.originalEvent), t.preventDefault(), t.stopPropagation(), h.cache.start_page_x = t.touches[0].pageX, h.cache.start_page_y = t.touches[0].pageY, h.cache.start_time = (new Date).getTime(), h.cache.delta_x = 0, h.cache.is_scrolling = null, h.cache.direction = null, h.stop_timer())
                    }).on("touchmove.fndtn.orbit", function(t) {
                        Math.abs(h.cache.delta_x) > 5 && (t.preventDefault(), t.stopPropagation()), h.cache.animating || requestAnimationFrame(function() {
                            if (t.touches || (t = t.originalEvent), !(t.touches.length > 1 || t.scale && 1 !== t.scale || (h.cache.delta_x = t.touches[0].pageX - h.cache.start_page_x, null === h.cache.is_scrolling && (h.cache.is_scrolling = !!(h.cache.is_scrolling || Math.abs(h.cache.delta_x) < Math.abs(t.touches[0].pageY - h.cache.start_page_y))), h.cache.is_scrolling))) {
                                var e = h.cache.delta_x < 0 ? p + 1 : p - 1;
                                if (h.cache.direction !== e) {
                                    var n = h._prepare_direction(e);
                                    h.cache.direction = e, h.cache.dir = n[0], h.cache.current = n[1], h.cache.next = n[2]
                                }
                                if ("slide" === s.animation) {
                                    var i, o;
                                    i = h.cache.delta_x / a.width() * 100, o = i >= 0 ? -(100 - i) : 100 + i, h.cache.current.css("transform", "translate3d(" + i + "%,0,0)"), h.cache.next.css("transform", "translate3d(" + o + "%,0,0)")
                                }
                            }
                        })
                    }).on("touchend.fndtn.orbit", function(t) {
                        h.cache.animating || (t.preventDefault(), t.stopPropagation(), setTimeout(function() {
                            h._goto(h.cache.direction)
                        }, 50))
                    }), a.on("mouseenter.fndtn.orbit", function(t) {
                        s.timer && s.pause_on_hover && h.stop_timer()
                    }).on("mouseleave.fndtn.orbit", function(t) {
                        s.timer && s.resume_on_mouseout && h.cache.timer.start()
                    }), t(n).on("click", "[data-orbit-link]", h.link_custom), t(e).on("load resize", h.compute_dimensions);
                    var l = this.slides().find("img");
                    Foundation.utils.image_loaded(l, h.compute_dimensions), Foundation.utils.image_loaded(l, function() {
                        a.prev("." + s.preloader_class).css("display", "none"), h.update_slide_number(p), h.update_active_link(p), f.trigger("ready.fndtn.orbit")
                    })
                }, h.init()
            },
            o = function(t, e, n) {
                var i, s, a = this,
                    o = e.timer_speed,
                    r = t.find("." + e.timer_progress_class),
                    l = r && "none" != r.css("display"),
                    c = -1;
                this.update_progress = function(t) {
                    var e = r.clone();
                    e.attr("style", ""), e.css("width", t + "%"), r.replaceWith(e), r = e
                }, this.restart = function() {
                    clearTimeout(s), t.addClass(e.timer_paused_class), c = -1, l && a.update_progress(0), a.start()
                }, this.start = function() {
                    return t.hasClass(e.timer_paused_class) ? (c = -1 === c ? o : c, t.removeClass(e.timer_paused_class), l && (i = (new Date).getTime(), r.animate({
                        width: "100%"
                    }, c, "linear")), s = setTimeout(function() {
                        a.restart(), n()
                    }, c), t.trigger("timer-started.fndtn.orbit"), void 0) : !0
                }, this.stop = function() {
                    if (t.hasClass(e.timer_paused_class)) return !0;
                    if (clearTimeout(s), t.addClass(e.timer_paused_class), l) {
                        var n = (new Date).getTime();
                        c -= n - i;
                        var r = 100 - c / o * 100;
                        a.update_progress(r)
                    }
                    t.trigger("timer-stopped.fndtn.orbit")
                }
            },
            r = function(t, e) {
                var n = "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend";
                this.next = function(i, s, a) {
                    Modernizr.csstransitions ? s.on(n, function(t) {
                        s.unbind(n), i.removeClass("active animate-out"), s.removeClass("animate-in"), e.children().css({
                            transform: "",
                            "-ms-transform": "",
                            "-webkit-transition-duration": "",
                            "-moz-transition-duration": "",
                            "-o-transition-duration": "",
                            "transition-duration": ""
                        }), a()
                    }) : setTimeout(function() {
                        i.removeClass("active animate-out"), s.removeClass("animate-in"), e.children().css({
                            transform: "",
                            "-ms-transform": "",
                            "-webkit-transition-duration": "",
                            "-moz-transition-duration": "",
                            "-o-transition-duration": "",
                            "transition-duration": ""
                        }), a()
                    }, t.animation_speed), e.children().css({
                        transform: "",
                        "-ms-transform": "",
                        "-webkit-transition-duration": "",
                        "-moz-transition-duration": "",
                        "-o-transition-duration": "",
                        "transition-duration": ""
                    }), i.addClass("animate-out"), s.addClass("animate-in")
                }, this.prev = function(i, s, a) {
                    Modernizr.csstransitions ? s.on(n, function(t) {
                        s.unbind(n), i.removeClass("active animate-out"), s.removeClass("animate-in"), e.children().css({
                            transform: "",
                            "-ms-transform": "",
                            "-webkit-transition-duration": "",
                            "-moz-transition-duration": "",
                            "-o-transition-duration": "",
                            "transition-duration": ""
                        }), a()
                    }) : setTimeout(function() {
                        i.removeClass("active animate-out"), s.removeClass("animate-in"), e.children().css({
                            transform: "",
                            "-ms-transform": "",
                            "-webkit-transition-duration": "",
                            "-moz-transition-duration": "",
                            "-o-transition-duration": "",
                            "transition-duration": ""
                        }), a()
                    }, t.animation_speed), e.children().css({
                        transform: "",
                        "-ms-transform": "",
                        "-webkit-transition-duration": "",
                        "-moz-transition-duration": "",
                        "-o-transition-duration": "",
                        "transition-duration": ""
                    }), i.addClass("animate-out"), s.addClass("animate-in")
                }
            };
        Foundation.libs = Foundation.libs || {}, Foundation.libs.orbit = {
            name: "orbit",
            version: "5.2.2",
            settings: {
                animation: "slide",
                timer_speed: 1e4,
                pause_on_hover: !0,
                resume_on_mouseout: !1,
                next_on_click: !0,
                animation_speed: 500,
                stack_on_small: !1,
                navigation_arrows: !0,
                slide_number: !0,
                slide_number_text: "of",
                container_class: "orbit-container",
                stack_on_small_class: "orbit-stack-on-small",
                next_class: "orbit-next",
                prev_class: "orbit-prev",
                timer_container_class: "orbit-timer",
                timer_paused_class: "paused",
                timer_progress_class: "orbit-progress",
                timer_show_progress_bar: !0,
                slides_container_class: "orbit-slides-container",
                preloader_class: "preloader",
                slide_selector: "*",
                bullets_container_class: "orbit-bullets",
                bullets_active_class: "active",
                slide_number_class: "orbit-slide-number",
                caption_class: "orbit-caption",
                active_slide_class: "active",
                orbit_transition_class: "orbit-transitioning",
                bullets: !0,
                circular: !0,
                timer: !0,
                variable_height: !1,
                swipe: !0,
                before_slide_change: s,
                after_slide_change: s
            },
            init: function(t, e, n) {
                this.bindings(e, n)
            },
            events: function(t) {
                var e = new a(this.S(t), this.S(t).data("orbit-init"));
                this.S(t).data(self.name + "-instance", e)
            },
            reflow: function() {
                var t = this;
                if (t.S(t.scope).is("[data-orbit]")) {
                    var e = t.S(t.scope),
                        n = e.data(t.name + "-instance");
                    n.compute_dimensions()
                } else t.S("[data-orbit]", t.scope).each(function(e, n) {
                    var i = t.S(n),
                        s = (t.data_options(i), i.data(t.name + "-instance"));
                    s.compute_dimensions()
                })
            }
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.topbar = {
            name: "topbar",
            version: "5.2.2",
            settings: {
                index: 0,
                sticky_class: "sticky",
                custom_back_text: !0,
                back_text: "Back",
                is_hover: !0,
                mobile_show_parent_link: !1,
                scrolltop: !0,
                sticky_on: "all"
            },
            init: function(e, n, i) {
                Foundation.inherit(this, "add_custom_rule register_media throttle");
                var s = this;
                s.register_media("topbar", "foundation-mq-topbar"), this.bindings(n, i), s.S("[" + this.attr_name() + "]", this.scope).each(function() {
                    var e = t(this),
                        n = e.data(s.attr_name(!0) + "-init");
                    s.S("section", this), e.children().filter("ul").first();
                    e.data("index", 0);
                    var i = e.parent();
                    i.hasClass("fixed") || s.is_sticky(e, i, n) ? (s.settings.sticky_class = n.sticky_class, s.settings.sticky_topbar = e, e.data("height", i.outerHeight()), e.data("stickyoffset", i.offset().top)) : e.data("height", e.outerHeight()), n.assembled || s.assemble(e), n.is_hover ? s.S(".has-dropdown", e).addClass("not-click") : s.S(".has-dropdown", e).removeClass("not-click"), s.add_custom_rule(".f-topbar-fixed { padding-top: " + e.data("height") + "px }"), i.hasClass("fixed") && s.S("body").addClass("f-topbar-fixed")
                })
            },
            is_sticky: function(t, e, n) {
                var i = e.hasClass(n.sticky_class);
                return i && "all" === n.sticky_on ? !0 : i && this.small() && "small" === n.sticky_on ? !0 : i && this.medium() && "medium" === n.sticky_on ? !0 : i && this.large() && "large" === n.sticky_on ? !0 : !1
            },
            toggle: function(n) {
                var i = this;
                if (n) var s = i.S(n).closest("[" + this.attr_name() + "]");
                else var s = i.S("[" + this.attr_name() + "]");
                var a = s.data(this.attr_name(!0) + "-init"),
                    o = i.S("section, .section", s);
                i.breakpoint() && (i.rtl ? (o.css({
                    right: "0%"
                }), t(">.name", o).css({
                    right: "100%"
                })) : (o.css({
                    left: "0%"
                }), t(">.name", o).css({
                    left: "100%"
                })), i.S("li.moved", o).removeClass("moved"), s.data("index", 0), s.toggleClass("expanded").css("height", "")), a.scrolltop ? s.hasClass("expanded") ? s.parent().hasClass("fixed") && (a.scrolltop ? (s.parent().removeClass("fixed"), s.addClass("fixed"), i.S("body").removeClass("f-topbar-fixed"), e.scrollTo(0, 0)) : s.parent().removeClass("expanded")) : s.hasClass("fixed") && (s.parent().addClass("fixed"), s.removeClass("fixed"), i.S("body").addClass("f-topbar-fixed")) : (i.is_sticky(s, s.parent(), a) && s.parent().addClass("fixed"), s.parent().hasClass("fixed") && (s.hasClass("expanded") ? (s.addClass("fixed"), s.parent().addClass("expanded"), i.S("body").addClass("f-topbar-fixed")) : (s.removeClass("fixed"), s.parent().removeClass("expanded"), i.update_sticky_positioning())))
            },
            timer: null,
            events: function(n) {
                var i = this,
                    s = this.S;
                s(this.scope).off(".topbar").on("click.fndtn.topbar", "[" + this.attr_name() + "] .toggle-topbar", function(t) {
                    t.preventDefault(), i.toggle(this)
                }).on("click.fndtn.topbar", '.top-bar .top-bar-section li a[href^="#"],[' + this.attr_name() + '] .top-bar-section li a[href^="#"]', function(e) {
                    var n = t(this).closest("li");
                    i.breakpoint() && !n.hasClass("back") && !n.hasClass("has-dropdown") && i.toggle()
                }).on("click.fndtn.topbar", "[" + this.attr_name() + "] li.has-dropdown", function(e) {
                    var n = s(this),
                        a = s(e.target),
                        o = n.closest("[" + i.attr_name() + "]"),
                        r = o.data(i.attr_name(!0) + "-init");
                    return a.data("revealId") ? void i.toggle() : void(i.breakpoint() || (!r.is_hover || Modernizr.touch) && (e.stopImmediatePropagation(), n.hasClass("hover") ? (n.removeClass("hover").find("li").removeClass("hover"), n.parents("li.hover").removeClass("hover")) : (n.addClass("hover"), t(n).siblings().removeClass("hover"), "A" === a[0].nodeName && a.parent().hasClass("has-dropdown") && e.preventDefault())))
                }).on("click.fndtn.topbar", "[" + this.attr_name() + "] .has-dropdown>a", function(t) {
                    if (i.breakpoint()) {
                        t.preventDefault();
                        var e = s(this),
                            n = e.closest("[" + i.attr_name() + "]"),
                            a = n.find("section, .section"),
                            o = (e.next(".dropdown").outerHeight(), e.closest("li"));
                        n.data("index", n.data("index") + 1), o.addClass("moved"), i.rtl ? (a.css({
                            right: -(100 * n.data("index")) + "%"
                        }), a.find(">.name").css({
                            right: 100 * n.data("index") + "%"
                        })) : (a.css({
                            left: -(100 * n.data("index")) + "%"
                        }), a.find(">.name").css({
                            left: 100 * n.data("index") + "%"
                        })), n.css("height", e.siblings("ul").outerHeight(!0) + n.data("height"))
                    }
                }), s(e).off(".topbar").on("resize.fndtn.topbar", i.throttle(function() {
                    i.resize.call(i)
                }, 50)).trigger("resize"), s("body").off(".topbar").on("click.fndtn.topbar touchstart.fndtn.topbar", function(t) {
                    var e = s(t.target).closest("li").closest("li.hover");
                    e.length > 0 || s("[" + i.attr_name() + "] li.hover").removeClass("hover")
                }), s(this.scope).on("click.fndtn.topbar", "[" + this.attr_name() + "] .has-dropdown .back", function(t) {
                    t.preventDefault();
                    var e = s(this),
                        n = e.closest("[" + i.attr_name() + "]"),
                        a = n.find("section, .section"),
                        o = (n.data(i.attr_name(!0) + "-init"), e.closest("li.moved")),
                        r = o.parent();
                    n.data("index", n.data("index") - 1), i.rtl ? (a.css({
                        right: -(100 * n.data("index")) + "%"
                    }), a.find(">.name").css({
                        right: 100 * n.data("index") + "%"
                    })) : (a.css({
                        left: -(100 * n.data("index")) + "%"
                    }), a.find(">.name").css({
                        left: 100 * n.data("index") + "%"
                    })), 0 === n.data("index") ? n.css("height", "") : n.css("height", r.outerHeight(!0) + n.data("height")), setTimeout(function() {
                        o.removeClass("moved")
                    }, 300)
                })
            },
            resize: function() {
                var t = this;
                t.S("[" + this.attr_name() + "]").each(function() {
                    var e, i = t.S(this),
                        s = i.data(t.attr_name(!0) + "-init"),
                        a = i.parent("." + t.settings.sticky_class);
                    if (!t.breakpoint()) {
                        var o = i.hasClass("expanded");
                        i.css("height", "").removeClass("expanded").find("li").removeClass("hover"), o && t.toggle(i)
                    }
                    t.is_sticky(i, a, s) && (a.hasClass("fixed") ? (a.removeClass("fixed"), e = a.offset().top, t.S(n.body).hasClass("f-topbar-fixed") && (e -= i.data("height")), i.data("stickyoffset", e), a.addClass("fixed")) : (e = a.offset().top, i.data("stickyoffset", e)))
                })
            },
            breakpoint: function() {
                return !matchMedia(Foundation.media_queries.topbar).matches
            },
            small: function() {
                return matchMedia(Foundation.media_queries.small).matches
            },
            medium: function() {
                return matchMedia(Foundation.media_queries.medium).matches
            },
            large: function() {
                return matchMedia(Foundation.media_queries.large).matches
            },
            assemble: function(e) {
                var n = this,
                    i = e.data(this.attr_name(!0) + "-init"),
                    s = n.S("section", e);
                t(this).children().filter("ul").first();
                s.detach(), n.S(".has-dropdown>a", s).each(function() {
                    var e = n.S(this),
                        s = e.siblings(".dropdown"),
                        a = e.attr("href");
                    if (!s.find(".title.back").length) {
                        if (i.mobile_show_parent_link && a && a.length > 1) var o = t('<li class="title back js-generated"><h5><a href="javascript:void(0)"></a></h5></li><li><a class="parent-link js-generated" href="' + a + '">' + e.text() + "</a></li>");
                        else var o = t('<li class="title back js-generated"><h5><a href="javascript:void(0)"></a></h5></li>');
                        1 == i.custom_back_text ? t("h5>a", o).html(i.back_text) : t("h5>a", o).html("&laquo; " + e.html()), s.prepend(o)
                    }
                }), s.appendTo(e), this.sticky(), this.assembled(e)
            },
            assembled: function(e) {
                e.data(this.attr_name(!0), t.extend({}, e.data(this.attr_name(!0)), {
                    assembled: !0
                }))
            },
            height: function(e) {
                var n = 0,
                    i = this;
                return t("> li", e).each(function() {
                    n += i.S(this).outerHeight(!0)
                }), n
            },
            sticky: function() {
                var t = (this.S(e), this);
                this.S(e).on("scroll", function() {
                    t.update_sticky_positioning()
                })
            },
            update_sticky_positioning: function() {
                var t = "." + this.settings.sticky_class,
                    n = this.S(e),
                    i = this;
                if (i.settings.sticky_topbar && i.is_sticky(this.settings.sticky_topbar, this.settings.sticky_topbar.parent(), this.settings)) {
                    var s = this.settings.sticky_topbar.data("stickyoffset");
                    i.S(t).hasClass("expanded") || (n.scrollTop() > s ? i.S(t).hasClass("fixed") || (i.S(t).addClass("fixed"), i.S("body").addClass("f-topbar-fixed")) : n.scrollTop() <= s && i.S(t).hasClass("fixed") && (i.S(t).removeClass("fixed"), i.S("body").removeClass("f-topbar-fixed")))
                }
            },
            off: function() {
                this.S(this.scope).off(".fndtn.topbar"), this.S(e).off(".fndtn.topbar")
            },
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.accordion = {
            name: "accordion",
            version: "5.2.2",
            settings: {
                active_class: "active",
                multi_expand: !1,
                toggleable: !0
            },
            init: function(t, e, n) {
                this.bindings(e, n)
            },
            events: function() {
                var e = this,
                    n = this.S;
                n(this.scope).off(".fndtn.accordion").on("click.fndtn.accordion", "[" + this.attr_name() + "] dd > a", function(i) {
                    var s = n(this).closest("[" + e.attr_name() + "]"),
                        a = n("#" + this.href.split("#")[1]),
                        o = n("dd > .content", s),
                        r = t("dd", s),
                        l = s.data(e.attr_name(!0) + "-init"),
                        c = n("dd > .content." + l.active_class, s),
                        d = n("dd." + l.active_class, s);
                    return i.preventDefault(), n(this).closest("dl").is(s) ? l.toggleable && a.is(c) ? (d.toggleClass(l.active_class, !1), a.toggleClass(l.active_class, !1)) : (l.multi_expand || (o.removeClass(l.active_class), r.removeClass(l.active_class)), void a.addClass(l.active_class).parent().addClass(l.active_class)) : void 0
                })
            },
            off: function() {},
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n, i) {
        "use strict";
        Foundation.libs.offcanvas = {
            name: "offcanvas",
            version: "5.2.2",
            settings: {},
            init: function(t, e, n) {
                this.events()
            },
            events: function() {
                var t = this,
                    e = t.S;
                e(this.scope).off(".offcanvas").on("click.fndtn.offcanvas", ".left-off-canvas-toggle", function(e) {
                    t.click_toggle_class(e, "move-right")
                }).on("click.fndtn.offcanvas", ".left-off-canvas-menu a", function(t) {
                    e(".off-canvas-wrap").removeClass("move-right")
                }).on("click.fndtn.offcanvas", ".right-off-canvas-toggle", function(e) {
                    t.click_toggle_class(e, "move-left")
                }).on("click.fndtn.offcanvas", ".right-off-canvas-menu a", function(t) {
                    e(".off-canvas-wrap").removeClass("move-left")
                }).on("click.fndtn.offcanvas", ".exit-off-canvas", function(e) {
                    t.click_remove_class(e, "move-left"), t.click_remove_class(e, "move-right")
                })
            },
            click_toggle_class: function(t, e) {
                t.preventDefault(), this.S(t.target).closest(".off-canvas-wrap").toggleClass(e)
            },
            click_remove_class: function(t, e) {
                t.preventDefault(), this.S(".off-canvas-wrap").removeClass(e)
            },
            reflow: function() {}
        }
    }(jQuery, this, this.document),
    function(t, e, n) {
        "use strict";
        t.HoverDir = function(e, n) {
            this.$el = t(n), this._init(e)
        }, t.HoverDir.defaults = {
            speed: 300,
            easing: "ease",
            hoverDelay: 0,
            inverse: !1
        }, t.HoverDir.prototype = {
            _init: function(e) {
                this.options = t.extend(!0, {}, t.HoverDir.defaults, e), this.transitionProp = "all " + this.options.speed + "ms " + this.options.easing, this.support = Modernizr.csstransitions, this._loadEvents()
            },
            _loadEvents: function() {
                var e = this;
                this.$el.on("mouseenter.hoverdir, mouseleave.hoverdir", function(n) {
                    var i = t(this),
                        s = i.find("div.latest-work-list-hover"),
                        a = e._getDir(i, {
                            x: n.pageX,
                            y: n.pageY
                        }),
                        o = e._getStyle(a);
                    "mouseenter" === n.type ? (s.hide().css(o.from),
                        clearTimeout(e.tmhover), e.tmhover = setTimeout(function() {
                            s.show(0, function() {
                                var n = t(this);
                                e.support && n.css("transition", e.transitionProp), e._applyAnimation(n, o.to, e.options.speed)
                            })
                        }, e.options.hoverDelay)) : (e.support && s.css("transition", e.transitionProp), clearTimeout(e.tmhover), e._applyAnimation(s, o.from, e.options.speed))
                })
            },
            _getDir: function(t, e) {
                var n = t.width(),
                    i = t.height(),
                    s = (e.x - t.offset().left - n / 2) * (n > i ? i / n : 1),
                    a = (e.y - t.offset().top - i / 2) * (i > n ? n / i : 1),
                    o = Math.round((Math.atan2(a, s) * (180 / Math.PI) + 180) / 90 + 3) % 4;
                return o
            },
            _getStyle: function(t) {
                var e, n, i = {
                        left: "0px",
                        top: "-100%"
                    },
                    s = {
                        left: "0px",
                        top: "100%"
                    },
                    a = {
                        left: "-100%",
                        top: "0px"
                    },
                    o = {
                        left: "100%",
                        top: "0px"
                    },
                    r = {
                        top: "0px"
                    },
                    l = {
                        left: "0px"
                    };
                switch (t) {
                    case 0:
                        e = this.options.inverse ? s : i, n = r;
                        break;
                    case 1:
                        e = this.options.inverse ? a : o, n = l;
                        break;
                    case 2:
                        e = this.options.inverse ? i : s, n = r;
                        break;
                    case 3:
                        e = this.options.inverse ? o : a, n = l
                }
                return {
                    from: e,
                    to: n
                }
            },
            _applyAnimation: function(e, n, i) {
                t.fn.applyStyle = this.support ? t.fn.css : t.fn.animate, e.stop().applyStyle(n, t.extend(!0, [], {
                    duration: i + "ms"
                }))
            }
        };
        var i = function(t) {
            e.console && e.console.error(t)
        };
        t.fn.hoverdir = function(e) {
            var n = t.data(this, "hoverdir");
            if ("string" == typeof e) {
                var s = Array.prototype.slice.call(arguments, 1);
                this.each(function() {
                    return n ? t.isFunction(n[e]) && "_" !== e.charAt(0) ? void n[e].apply(n, s) : void i("no such method '" + e + "' for hoverdir instance") : void i("cannot call methods on hoverdir prior to initialization; attempted to call method '" + e + "'")
                })
            } else this.each(function() {
                n ? n._init() : n = t.data(this, "hoverdir", new t.HoverDir(e, this))
            });
            return n
        }
    }(jQuery, window),
    function(t) {
        t.fn.hoverIntent = function(e, n) {
            var i = {
                sensitivity: 7,
                interval: 100,
                timeout: 0
            };
            i = t.extend(i, n ? {
                over: e,
                out: n
            } : e);
            var s, a, o, r, l = function(t) {
                    s = t.pageX, a = t.pageY
                },
                c = function(e, n) {
                    return n.hoverIntent_t = clearTimeout(n.hoverIntent_t), Math.abs(o - s) + Math.abs(r - a) < i.sensitivity ? (t(n).unbind("mousemove", l), n.hoverIntent_s = 1, i.over.apply(n, [e])) : (o = s, r = a, n.hoverIntent_t = setTimeout(function() {
                        c(e, n)
                    }, i.interval), void 0)
                },
                d = function(t, e) {
                    return e.hoverIntent_t = clearTimeout(e.hoverIntent_t), e.hoverIntent_s = 0, i.out.apply(e, [t])
                },
                u = function(e) {
                    var n = jQuery.extend({}, e),
                        s = this;
                    s.hoverIntent_t && (s.hoverIntent_t = clearTimeout(s.hoverIntent_t)), "mouseenter" == e.type ? (o = n.pageX, r = n.pageY, t(s).bind("mousemove", l), 1 != s.hoverIntent_s && (s.hoverIntent_t = setTimeout(function() {
                        c(n, s)
                    }, i.interval))) : (t(s).unbind("mousemove", l), 1 == s.hoverIntent_s && (s.hoverIntent_t = setTimeout(function() {
                        d(n, s)
                    }, i.timeout)))
                };
            return this.bind("mouseenter", u).bind("mouseleave", u)
        }
    }(jQuery),
    function(t, e, n) {
        "use strict";
        var i = e.Modernizr;
        t.Windy = function(e, n) {
            this.$el = t(n), this._init(e)
        }, t.Windy.defaults = {
            nextEl: "",
            prevEl: "",
            boundaries: {
                rotateX: {
                    min: 40,
                    max: 90
                },
                rotateY: {
                    min: -15,
                    max: 15
                },
                rotateZ: {
                    min: -10,
                    max: 10
                },
                translateX: {
                    min: -200,
                    max: 200
                },
                translateY: {
                    min: -400,
                    max: -200
                },
                translateZ: {
                    min: 250,
                    max: 550
                }
            }
        }, t.Windy.prototype = {
            _init: function(e) {
                this.options = t.extend(!0, {}, t.Windy.defaults, e), this.transEndEventNames = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd",
                    msTransition: "MSTransitionEnd",
                    transition: "transitionend"
                }, this.transEndEventName = this.transEndEventNames[i.prefixed("transition")], this.$items = this.$el.children("li"), this.itemsCount = this.$items.length, this.resetTransformStr = "translateX( 0px ) translateY( 0px ) translateZ( 0px ) rotateX( 0deg ) rotateY( 0deg ) rotateZ( 0deg )", this.supportTransitions = i.csstransitions, this.support3d = i.csstransforms3d, this.current = 0, this.$items.eq(this.current).show(), this._initEvents()
            },
            _getRandTransform: function() {
                return {
                    rx: Math.floor(Math.random() * (this.options.boundaries.rotateX.max - this.options.boundaries.rotateX.min + 1) + this.options.boundaries.rotateX.min),
                    ry: Math.floor(Math.random() * (this.options.boundaries.rotateY.max - this.options.boundaries.rotateY.min + 1) + this.options.boundaries.rotateY.min),
                    rz: Math.floor(Math.random() * (this.options.boundaries.rotateZ.max - this.options.boundaries.rotateZ.min + 1) + this.options.boundaries.rotateZ.min),
                    tx: Math.floor(Math.random() * (this.options.boundaries.translateX.max - this.options.boundaries.translateX.min + 1) + this.options.boundaries.translateX.min),
                    ty: Math.floor(Math.random() * (this.options.boundaries.translateY.max - this.options.boundaries.translateY.min + 1) + this.options.boundaries.translateY.min),
                    tz: Math.floor(Math.random() * (this.options.boundaries.translateZ.max - this.options.boundaries.translateZ.min + 1) + this.options.boundaries.translateZ.min)
                }
            },
            _initEvents: function() {
                var e = this;
                this.$items.on(this.transEndEventName, function(n) {
                    e._onTransEnd(t(this))
                }), "" !== this.options.nextEl && t(this.options.nextEl).on("click.windy", function() {
                    return e.next(), !1
                }), "" !== this.options.prevEl && t(this.options.prevEl).on("click.windy", function() {
                    return e.prev(), !1
                })
            },
            _onTransEnd: function(t) {
                if (t.removeClass("wi-move"), "right" === t.data("dir")) {
                    var e = {
                        zIndex: 1,
                        opacity: 1
                    };
                    this.support3d ? e.transform = this.resetTransformStr : this.supportTransitions && (e.left = 0, e.top = 0), t.hide().css(e)
                }
            },
            navigate: function(t) {
                var e = this,
                    n = this.$items.eq(this.current),
                    i = this.$items.eq(t),
                    s = this._getRandTransform(),
                    a = {
                        zIndex: this.itemsCount + 1 - t,
                        opacity: 0
                    },
                    o = {
                        opacity: 1
                    };
                this.support3d ? (o.transform = e.resetTransformStr, a.transform = "translateX(" + s.tx + "px) translateY(" + s.ty + "px) translateZ(" + s.tz + "px) rotateX(" + s.rx + "deg) rotateY(" + s.ry + "deg) rotateZ(" + s.rz + "deg)") : this.supportTransitions && (o.left = 0, o.top = 0, a.left = s.tx, a.top = s.ty), t > this.current ? ("left" === this.dir && this.$items.not(n).css("z-index", 1).hide(), this.dir = "right", n.addClass("wi-move").data("dir", "right").css(a), i.hasClass("wi-move") && i.removeClass("wi-move"), i.css(o).show(), this.supportTransitions || this._onTransEnd(n)) : t < this.current && (this.dir = "left", i.data("dir", "left").css(a).show(), setTimeout(function() {
                    i.addClass("wi-move").data("dir", "left").css(o), e.supportTransitions || e._onTransEnd(i)
                }, 20)), this.current = t
            },
            getItemsCount: function() {
                return this.itemsCount
            },
            next: function() {
                if (this.current < this.itemsCount - 1) {
                    var t = this.current + 1;
                    this.navigate(t)
                }
            },
            prev: function() {
                if (this.current > 0) {
                    var t = this.current - 1;
                    this.navigate(t)
                }
            }
        };
        var s = function(t) {
            e.console && e.console.error(t)
        };
        t.fn.windy = function(e) {
            var n = t.data(this, "windy");
            if ("string" == typeof e) {
                var i = Array.prototype.slice.call(arguments, 1);
                this.each(function() {
                    return n ? t.isFunction(n[e]) && "_" !== e.charAt(0) ? void n[e].apply(n, i) : void s("no such method '" + e + "' for windy instance") : void s("cannot call methods on windy prior to initialization; attempted to call method '" + e + "'")
                })
            } else this.each(function() {
                n ? n._init() : n = t.data(this, "windy", new t.Windy(e, this))
            });
            return n
        }
    }(jQuery, window),
    function(t) {
        "use strict";

        function e(t) {
            return (t || "").toLowerCase()
        }
        var n = "20130409";
        t.fn.cycle = function(n) {
            var i;
            return 0 !== this.length || t.isReady ? this.each(function() {
                var i, s, a, o, r = t(this),
                    l = t.fn.cycle.log;
                if (!r.data("cycle.opts")) {
                    (r.data("cycle-log") === !1 || n && n.log === !1 || s && s.log === !1) && (l = t.noop), l("--c2 init--"), i = r.data();
                    for (var c in i) i.hasOwnProperty(c) && /^cycle[A-Z]+/.test(c) && (o = i[c], a = c.match(/^cycle(.*)/)[1].replace(/^[A-Z]/, e), l(a + ":", o, "(" + typeof o + ")"), i[a] = o);
                    s = t.extend({}, t.fn.cycle.defaults, i, n || {}), s.timeoutId = 0, s.paused = s.paused || !1, s.container = r, s._maxZ = s.maxZ, s.API = t.extend({
                        _container: r
                    }, t.fn.cycle.API), s.API.log = l, s.API.trigger = function(t, e) {
                        return s.container.trigger(t, e), s.API
                    }, r.data("cycle.opts", s), r.data("cycle.API", s.API), s.API.trigger("cycle-bootstrap", [s, s.API]), s.API.addInitialSlides(), s.API.preInitSlideshow(), s.slides.length && s.API.initSlideshow()
                }
            }) : (i = {
                s: this.selector,
                c: this.context
            }, t.fn.cycle.log("requeuing slideshow (dom not ready)"), t(function() {
                t(i.s, i.c).cycle(n)
            }), this)
        }, t.fn.cycle.API = {
            opts: function() {
                return this._container.data("cycle.opts")
            },
            addInitialSlides: function() {
                var e = this.opts(),
                    n = e.slides;
                e.slideCount = 0, e.slides = t(), n = n.jquery ? n : e.container.find(n), e.random && n.sort(function() {
                    return Math.random() - .5
                }), e.API.add(n)
            },
            preInitSlideshow: function() {
                var e = this.opts();
                e.API.trigger("cycle-pre-initialize", [e]);
                var n = t.fn.cycle.transitions[e.fx];
                n && t.isFunction(n.preInit) && n.preInit(e), e._preInitialized = !0
            },
            postInitSlideshow: function() {
                var e = this.opts();
                e.API.trigger("cycle-post-initialize", [e]);
                var n = t.fn.cycle.transitions[e.fx];
                n && t.isFunction(n.postInit) && n.postInit(e)
            },
            initSlideshow: function() {
                var e, n = this.opts(),
                    i = n.container;
                n.API.calcFirstSlide(), "static" == n.container.css("position") && n.container.css("position", "relative"), t(n.slides[n.currSlide]).css("opacity", 1).show(), n.API.stackSlides(n.slides[n.currSlide], n.slides[n.nextSlide], !n.reverse), n.pauseOnHover && (n.pauseOnHover !== !0 && (i = t(n.pauseOnHover)), i.hover(function() {
                    n.API.pause(!0)
                }, function() {
                    n.API.resume(!0)
                })), n.timeout && (e = n.API.getSlideOpts(n.nextSlide), n.API.queueTransition(e, e.timeout + n.delay)), n._initialized = !0, n.API.updateView(!0), n.API.trigger("cycle-initialized", [n]), n.API.postInitSlideshow()
            },
            pause: function(e) {
                var n = this.opts(),
                    i = n.API.getSlideOpts(),
                    s = n.hoverPaused || n.paused;
                e ? n.hoverPaused = !0 : n.paused = !0, s || (n.container.addClass("cycle-paused"), n.API.trigger("cycle-paused", [n]).log("cycle-paused"), i.timeout && (clearTimeout(n.timeoutId), n.timeoutId = 0, n._remainingTimeout -= t.now() - n._lastQueue, (n._remainingTimeout < 0 || isNaN(n._remainingTimeout)) && (n._remainingTimeout = void 0)))
            },
            resume: function(t) {
                var e = this.opts(),
                    n = !e.hoverPaused && !e.paused;
                t ? e.hoverPaused = !1 : e.paused = !1, n || (e.container.removeClass("cycle-paused"), e.API.queueTransition(e.API.getSlideOpts(), e._remainingTimeout), e.API.trigger("cycle-resumed", [e, e._remainingTimeout]).log("cycle-resumed"))
            },
            add: function(e, n) {
                var i, s = this.opts(),
                    a = s.slideCount,
                    o = !1;
                "string" == t.type(e) && (e = t.trim(e)), t(e).each(function(e) {
                    var i, a = t(this);
                    n ? s.container.prepend(a) : s.container.append(a), s.slideCount++, i = s.API.buildSlideOpts(a), n ? s.slides = t(a).add(s.slides) : s.slides = s.slides.add(a), s.API.initSlide(i, a, --s._maxZ), a.data("cycle.opts", i), s.API.trigger("cycle-slide-added", [s, i, a])
                }), s.API.updateView(!0), o = s._preInitialized && 2 > a && s.slideCount >= 1, o && (s._initialized ? s.timeout && (i = s.slides.length, s.nextSlide = s.reverse ? i - 1 : 1, s.timeoutId || s.API.queueTransition(s)) : s.API.initSlideshow())
            },
            calcFirstSlide: function() {
                var t, e = this.opts();
                t = parseInt(e.startingSlide || 0, 10), (t >= e.slides.length || 0 > t) && (t = 0), e.currSlide = t, e.reverse ? (e.nextSlide = t - 1, e.nextSlide < 0 && (e.nextSlide = e.slides.length - 1)) : (e.nextSlide = t + 1, e.nextSlide == e.slides.length && (e.nextSlide = 0))
            },
            calcNextSlide: function() {
                var t, e = this.opts();
                e.reverse ? (t = e.nextSlide - 1 < 0, e.nextSlide = t ? e.slideCount - 1 : e.nextSlide - 1, e.currSlide = t ? 0 : e.nextSlide + 1) : (t = e.nextSlide + 1 == e.slides.length, e.nextSlide = t ? 0 : e.nextSlide + 1, e.currSlide = t ? e.slides.length - 1 : e.nextSlide - 1)
            },
            calcTx: function(e, n) {
                var i, s = e;
                return n && s.manualFx && (i = t.fn.cycle.transitions[s.manualFx]), i || (i = t.fn.cycle.transitions[s.fx]), i || (i = t.fn.cycle.transitions.fade, s.API.log('Transition "' + s.fx + '" not found.  Using fade.')), i
            },
            prepareTx: function(t, e) {
                var n, i, s, a, o, r = this.opts();
                return r.slideCount < 2 ? void(r.timeoutId = 0) : (!t || r.busy && !r.manualTrump || (r.API.stopTransition(), r.busy = !1, clearTimeout(r.timeoutId), r.timeoutId = 0), void(r.busy || (0 !== r.timeoutId || t) && (i = r.slides[r.currSlide], s = r.slides[r.nextSlide], a = r.API.getSlideOpts(r.nextSlide), o = r.API.calcTx(a, t), r._tx = o, t && void 0 !== a.manualSpeed && (a.speed = a.manualSpeed), r.nextSlide != r.currSlide && (t || !r.paused && !r.hoverPaused && r.timeout) ? (r.API.trigger("cycle-before", [a, i, s, e]), o.before && o.before(a, i, s, e), n = function() {
                    r.busy = !1, r.container.data("cycle.opts") && (o.after && o.after(a, i, s, e), r.API.trigger("cycle-after", [a, i, s, e]), r.API.queueTransition(a), r.API.updateView(!0))
                }, r.busy = !0, o.transition ? o.transition(a, i, s, e, n) : r.API.doTransition(a, i, s, e, n), r.API.calcNextSlide(), r.API.updateView()) : r.API.queueTransition(a))))
            },
            doTransition: function(e, n, i, s, a) {
                var o = e,
                    r = t(n),
                    l = t(i),
                    c = function() {
                        l.animate(o.animIn || {
                            opacity: 1
                        }, o.speed, o.easeIn || o.easing, a)
                    };
                l.css(o.cssBefore || {}), r.animate(o.animOut || {}, o.speed, o.easeOut || o.easing, function() {
                    r.css(o.cssAfter || {}), o.sync || c()
                }), o.sync && c()
            },
            queueTransition: function(e, n) {
                var i = this.opts(),
                    s = void 0 !== n ? n : e.timeout;
                return 0 === i.nextSlide && 0 === --i.loop ? (i.API.log("terminating; loop=0"), i.timeout = 0, s ? setTimeout(function() {
                    i.API.trigger("cycle-finished", [i])
                }, s) : i.API.trigger("cycle-finished", [i]), void(i.nextSlide = i.currSlide)) : void(s && (i._lastQueue = t.now(), void 0 === n && (i._remainingTimeout = e.timeout), i.paused || i.hoverPaused || (i.timeoutId = setTimeout(function() {
                    i.API.prepareTx(!1, !i.reverse)
                }, s))))
            },
            stopTransition: function() {
                var t = this.opts();
                t.slides.filter(":animated").length && (t.slides.stop(!1, !0), t.API.trigger("cycle-transition-stopped", [t])), t._tx && t._tx.stopTransition && t._tx.stopTransition(t)
            },
            advanceSlide: function(t) {
                var e = this.opts();
                return clearTimeout(e.timeoutId), e.timeoutId = 0, e.nextSlide = e.currSlide + t, e.nextSlide < 0 ? e.nextSlide = e.slides.length - 1 : e.nextSlide >= e.slides.length && (e.nextSlide = 0), e.API.prepareTx(!0, t >= 0), !1
            },
            buildSlideOpts: function(n) {
                var i, s, a = this.opts(),
                    o = n.data() || {};
                for (var r in o) o.hasOwnProperty(r) && /^cycle[A-Z]+/.test(r) && (i = o[r], s = r.match(/^cycle(.*)/)[1].replace(/^[A-Z]/, e), a.API.log("[" + (a.slideCount - 1) + "]", s + ":", i, "(" + typeof i + ")"), o[s] = i);
                o = t.extend({}, t.fn.cycle.defaults, a, o), o.slideNum = a.slideCount;
                try {
                    delete o.API, delete o.slideCount, delete o.currSlide, delete o.nextSlide, delete o.slides
                } catch (l) {}
                return o
            },
            getSlideOpts: function(e) {
                var n = this.opts();
                void 0 === e && (e = n.currSlide);
                var i = n.slides[e],
                    s = t(i).data("cycle.opts");
                return t.extend({}, n, s)
            },
            initSlide: function(e, n, i) {
                var s = this.opts();
                n.css(e.slideCss || {}), i > 0 && n.css("zIndex", i), isNaN(e.speed) && (e.speed = t.fx.speeds[e.speed] || t.fx.speeds._default), e.sync || (e.speed = e.speed / 2), n.addClass(s.slideClass)
            },
            updateView: function(t) {
                var e = this.opts();
                if (e._initialized) {
                    var n = e.API.getSlideOpts(),
                        i = e.slides[e.currSlide];
                    !t && (e.API.trigger("cycle-update-view-before", [e, n, i]), e.updateView < 0) || (e.slideActiveClass && e.slides.removeClass(e.slideActiveClass).eq(e.currSlide).addClass(e.slideActiveClass), t && e.hideNonActive && e.slides.filter(":not(." + e.slideActiveClass + ")").hide(), e.API.trigger("cycle-update-view", [e, n, i, t]), e.API.trigger("cycle-update-view-after", [e, n, i]))
                }
            },
            getComponent: function(e) {
                var n = this.opts(),
                    i = n[e];
                return "string" == typeof i ? /^\s*[\>|\+|~]/.test(i) ? n.container.find(i) : t(i) : i.jquery ? i : t(i)
            },
            stackSlides: function(e, n, i) {
                var s = this.opts();
                e || (e = s.slides[s.currSlide], n = s.slides[s.nextSlide], i = !s.reverse), t(e).css("zIndex", s.maxZ);
                var a, o = s.maxZ - 2,
                    r = s.slideCount;
                if (i) {
                    for (a = s.currSlide + 1; r > a; a++) t(s.slides[a]).css("zIndex", o--);
                    for (a = 0; a < s.currSlide; a++) t(s.slides[a]).css("zIndex", o--)
                } else {
                    for (a = s.currSlide - 1; a >= 0; a--) t(s.slides[a]).css("zIndex", o--);
                    for (a = r - 1; a > s.currSlide; a--) t(s.slides[a]).css("zIndex", o--)
                }
                t(n).css("zIndex", s.maxZ - 1)
            },
            getSlideIndex: function(t) {
                return this.opts().slides.index(t)
            }
        }, t.fn.cycle.log = function() {
            window.console && console.log && console.log("[cycle2] " + Array.prototype.join.call(arguments, " "))
        }, t.fn.cycle.version = function() {
            return "Cycle2: " + n
        }, t.fn.cycle.transitions = {
            custom: {},
            none: {
                before: function(t, e, n, i) {
                    t.API.stackSlides(n, e, i), t.cssBefore = {
                        opacity: 1,
                        display: "block"
                    }
                }
            },
            fade: {
                before: function(e, n, i, s) {
                    var a = e.API.getSlideOpts(e.nextSlide).slideCss || {};
                    e.API.stackSlides(n, i, s), e.cssBefore = t.extend(a, {
                        opacity: 0,
                        display: "block"
                    }), e.animIn = {
                        opacity: 1
                    }, e.animOut = {
                        opacity: 0
                    }
                }
            },
            fadeout: {
                before: function(e, n, i, s) {
                    var a = e.API.getSlideOpts(e.nextSlide).slideCss || {};
                    e.API.stackSlides(n, i, s), e.cssBefore = t.extend(a, {
                        opacity: 1,
                        display: "block"
                    }), e.animOut = {
                        opacity: 0
                    }
                }
            },
            scrollHorz: {
                before: function(t, e, n, i) {
                    t.API.stackSlides(e, n, i);
                    var s = t.container.css("overflow", "hidden").width();
                    t.cssBefore = {
                        left: i ? s : -s,
                        top: 0,
                        opacity: 1,
                        display: "block"
                    }, t.cssAfter = {
                        zIndex: t._maxZ - 2,
                        left: 0
                    }, t.animIn = {
                        left: 0
                    }, t.animOut = {
                        left: i ? -s : s
                    }
                }
            }
        }, t.fn.cycle.defaults = {
            allowWrap: !0,
            autoSelector: ".cycle-slideshow[data-cycle-auto-init!=false]",
            delay: 0,
            easing: null,
            fx: "fade",
            hideNonActive: !0,
            loop: 0,
            manualFx: void 0,
            manualSpeed: void 0,
            manualTrump: !0,
            maxZ: 100,
            pauseOnHover: !1,
            reverse: !1,
            slideActiveClass: "cycle-slide-active",
            slideClass: "cycle-slide",
            slideCss: {
                position: "absolute",
                top: 0,
                left: 0
            },
            slides: "> img",
            speed: 500,
            startingSlide: 0,
            sync: !0,
            timeout: 4e3,
            updateView: -1
        }, t(document).ready(function() {
            t(t.fn.cycle.defaults.autoSelector).cycle()
        })
    }(jQuery),
    function(t) {
        "use strict";

        function e(e, i) {
            var s, a, o, r = i.autoHeight;
            if ("container" == r) a = t(i.slides[i.currSlide]).outerHeight(), i.container.height(a);
            else if (i._autoHeightRatio) i.container.height(i.container.width() / i._autoHeightRatio);
            else if ("calc" === r || "number" == t.type(r) && r >= 0) {
                if (o = "calc" === r ? n(e, i) : r >= i.slides.length ? 0 : r, o == i._sentinelIndex) return;
                i._sentinelIndex = o, i._sentinel && i._sentinel.remove(), s = t(i.slides[o].cloneNode(!0)), s.removeAttr("id name rel").find("[id],[name],[rel]").removeAttr("id name rel"), s.css({
                    position: "static",
                    visibility: "hidden",
                    display: "block"
                }).prependTo(i.container).addClass("cycle-sentinel cycle-slide").removeClass("cycle-slide-active"), s.find("*").css("visibility", "hidden"), i._sentinel = s
            }
        }

        function n(e, n) {
            var i = 0,
                s = -1;
            return n.slides.each(function(e) {
                var n = t(this).height();
                n > s && (s = n, i = e)
            }), i
        }

        function i(e, n, i, s, a) {
            var o = t(s).outerHeight(),
                r = n.sync ? n.speed / 2 : n.speed;
            n.container.animate({
                height: o
            }, r)
        }

        function s(n, a) {
            a._autoHeightOnResize && (t(window).off("resize orientationchange", a._autoHeightOnResize), a._autoHeightOnResize = null), a.container.off("cycle-slide-added cycle-slide-removed", e), a.container.off("cycle-destroyed", s), a.container.off("cycle-before", i), a._sentinel && (a._sentinel.remove(), a._sentinel = null)
        }
        t.extend(t.fn.cycle.defaults, {
            autoHeight: 0
        }), t(document).on("cycle-initialized", function(n, a) {
            function o() {
                e(n, a)
            }
            var r, l = a.autoHeight,
                c = t.type(l),
                d = null;
            ("string" === c || "number" === c) && (a.container.on("cycle-slide-added cycle-slide-removed", e), a.container.on("cycle-destroyed", s), "container" == l ? a.container.on("cycle-before", i) : "string" === c && /\d+\:\d+/.test(l) && (r = l.match(/(\d+)\:(\d+)/), r = r[1] / r[2], a._autoHeightRatio = r), "number" !== c && (a._autoHeightOnResize = function() {
                clearTimeout(d), d = setTimeout(o, 50)
            }, t(window).on("resize orientationchange", a._autoHeightOnResize)), setTimeout(o, 30))
        })
    }(jQuery),
    function(t) {
        "use strict";
        t.extend(t.fn.cycle.defaults, {
            caption: "> .cycle-caption",
            captionTemplate: "{{slideNum}} / {{slideCount}}",
            overlay: "> .cycle-overlay",
            overlayTemplate: "<div>{{title}}</div><div>{{desc}}</div>",
            captionModule: "caption"
        }), t(document).on("cycle-update-view", function(e, n, i, s) {
            if ("caption" === n.captionModule) {
                t.each(["caption", "overlay"], function() {
                    var t = this,
                        e = i[t + "Template"],
                        a = n.API.getComponent(t);
                    a.length && e ? (a.html(n.API.tmpl(e, i, n, s)), a.show()) : a.hide()
                })
            }
        }), t(document).on("cycle-destroyed", function(e, n) {
            var i;
            t.each(["caption", "overlay"], function() {
                var t = this,
                    e = n[t + "Template"];
                n[t] && e && (i = n.API.getComponent("caption"), i.empty())
            })
        })
    }(jQuery),
    function(t) {
        "use strict";
        var e = t.fn.cycle;
        t.fn.cycle = function(n) {
            var i, s, a, o = t.makeArray(arguments);
            return "number" == t.type(n) ? this.cycle("goto", n) : "string" == t.type(n) ? this.each(function() {
                var r;
                return i = n, a = t(this).data("cycle.opts"), void 0 === a ? void e.log('slideshow must be initialized before sending commands; "' + i + '" ignored') : (i = "goto" == i ? "jump" : i, s = a.API[i], t.isFunction(s) ? (r = t.makeArray(o), r.shift(), s.apply(a.API, r)) : void e.log("unknown command: ", i))
            }) : e.apply(this, arguments)
        }, t.extend(t.fn.cycle, e), t.extend(e.API, {
            next: function() {
                var t = this.opts();
                if (!t.busy || t.manualTrump) {
                    var e = t.reverse ? -1 : 1;
                    t.allowWrap === !1 && t.currSlide + e >= t.slideCount || (t.API.advanceSlide(e), t.API.trigger("cycle-next", [t]).log("cycle-next"))
                }
            },
            prev: function() {
                var t = this.opts();
                if (!t.busy || t.manualTrump) {
                    var e = t.reverse ? 1 : -1;
                    t.allowWrap === !1 && t.currSlide + e < 0 || (t.API.advanceSlide(e), t.API.trigger("cycle-prev", [t]).log("cycle-prev"))
                }
            },
            destroy: function() {
                this.stop();
                var e = this.opts(),
                    n = t.isFunction(t._data) ? t._data : t.noop;
                clearTimeout(e.timeoutId), e.timeoutId = 0, e.API.stop(), e.API.trigger("cycle-destroyed", [e]).log("cycle-destroyed"), e.container.removeData(), n(e.container[0], "parsedAttrs", !1), e.retainStylesOnDestroy || (e.container.removeAttr("style"), e.slides.removeAttr("style"), e.slides.removeClass("cycle-slide-active")), e.slides.each(function() {
                    t(this).removeData(), n(this, "parsedAttrs", !1)
                })
            },
            jump: function(t) {
                var e, n = this.opts();
                if (!n.busy || n.manualTrump) {
                    var i = parseInt(t, 10);
                    if (isNaN(i) || 0 > i || i >= n.slides.length) return void n.API.log("goto: invalid slide index: " + i);
                    if (i == n.currSlide) return void n.API.log("goto: skipping, already on slide", i);
                    n.nextSlide = i, clearTimeout(n.timeoutId), n.timeoutId = 0, n.API.log("goto: ", i, " (zero-index)"), e = n.currSlide < n.nextSlide, n.API.prepareTx(!0, e)
                }
            },
            stop: function() {
                var e = this.opts(),
                    n = e.container;
                clearTimeout(e.timeoutId), e.timeoutId = 0, e.API.stopTransition(), e.pauseOnHover && (e.pauseOnHover !== !0 && (n = t(e.pauseOnHover)), n.off("mouseenter mouseleave")), e.API.trigger("cycle-stopped", [e]).log("cycle-stopped")
            },
            reinit: function() {
                var t = this.opts();
                t.API.destroy(), t.container.cycle()
            },
            remove: function(e) {
                for (var n, i, s = this.opts(), a = [], o = 1, r = 0; r < s.slides.length; r++) n = s.slides[r], r == e ? i = n : (a.push(n), t(n).data("cycle.opts").slideNum = o, o++);
                i && (s.slides = t(a), s.slideCount--, t(i).remove(), e == s.currSlide && s.API.advanceSlide(1), s.API.trigger("cycle-slide-removed", [s, e, i]).log("cycle-slide-removed"), s.API.updateView())
            }
        }), t(document).on("click.cycle", "[data-cycle-cmd]", function(e) {
            e.preventDefault();
            var n = t(this),
                i = n.data("cycle-cmd"),
                s = n.data("cycle-context") || ".cycle-slideshow";
            t(s).cycle(i, n.data("cycle-arg"))
        })
    }(jQuery),
    function(t) {
        "use strict";

        function e(e, n) {
            var i;
            return e._hashFence ? void(e._hashFence = !1) : (i = window.location.hash.substring(1), void e.slides.each(function(s) {
                return t(this).data("cycle-hash") == i ? (n === !0 ? e.startingSlide = s : (e.nextSlide = s, e.API.prepareTx(!0, !1)), !1) : void 0
            }))
        }
        t(document).on("cycle-pre-initialize", function(n, i) {
            e(i, !0), i._onHashChange = function() {
                e(i, !1)
            }, t(window).on("hashchange", i._onHashChange)
        }), t(document).on("cycle-update-view", function(t, e, n) {
            n.hash && (e._hashFence = !0, window.location.hash = n.hash)
        }), t(document).on("cycle-destroyed", function(e, n) {
            n._onHashChange && t(window).off("hashchange", n._onHashChange)
        })
    }(jQuery),
    function(t) {
        "use strict";
        t.extend(t.fn.cycle.defaults, {
            loader: !1
        }), t(document).on("cycle-bootstrap", function(e, n) {
            function i(e, i) {
                function a(e) {
                    var a;
                    "wait" == n.loader ? (r.push(e), 0 === c && (r.sort(o), s.apply(n.API, [r, i]), n.container.removeClass("cycle-loading"))) : (a = t(n.slides[n.currSlide]), s.apply(n.API, [e, i]), a.show(), n.container.removeClass("cycle-loading"))
                }

                function o(t, e) {
                    return t.data("index") - e.data("index")
                }
                var r = [];
                if ("string" == t.type(e)) e = t.trim(e);
                else if ("array" === t.type(e))
                    for (var l = 0; l < e.length; l++) e[l] = t(e[l])[0];
                e = t(e);
                var c = e.length;
                c && (e.hide().appendTo("body").each(function(e) {
                    function o() {
                        0 === --l && (--c, a(d))
                    }
                    var l = 0,
                        d = t(this),
                        u = d.is("img") ? d : d.find("img");
                    return d.data("index", e), u = u.filter(":not(.cycle-loader-ignore)").filter(':not([src=""])'), u.length ? (l = u.length, void u.each(function() {
                        this.complete ? o() : t(this).load(function() {
                            o()
                        }).error(function() {
                            0 === --l && (n.API.log("slide skipped; img not loaded:", this.src), 0 === --c && "wait" == n.loader && s.apply(n.API, [r, i]))
                        })
                    })) : (--c, void r.push(d))
                }), c && n.container.addClass("cycle-loading"))
            }
            var s;
            n.loader && (s = n.API.add, n.API.add = i)
        })
    }(jQuery),
    function(t) {
        "use strict";

        function e(e, n, i) {
            var s, a = e.API.getComponent("pager");
            a.each(function() {
                var a = t(this);
                if (n.pagerTemplate) {
                    var o = e.API.tmpl(n.pagerTemplate, n, e, i[0]);
                    s = t(o).appendTo(a)
                } else s = a.children().eq(e.slideCount - 1);
                s.on(e.pagerEvent, function(t) {
                    t.preventDefault(), e.API.page(a, t.currentTarget)
                })
            })
        }

        function n(t, e) {
            var n = this.opts();
            if (!n.busy || n.manualTrump) {
                var i = t.children().index(e),
                    s = i,
                    a = n.currSlide < s;
                n.currSlide != s && (n.nextSlide = s, n.API.prepareTx(!0, a), n.API.trigger("cycle-pager-activated", [n, t, e]))
            }
        }
        t.extend(t.fn.cycle.defaults, {
            pager: "> .cycle-pager",
            pagerActiveClass: "cycle-pager-active",
            pagerEvent: "click.cycle",
            pagerTemplate: "<span>&bull;</span>"
        }), t(document).on("cycle-bootstrap", function(t, n, i) {
            i.buildPagerLink = e
        }), t(document).on("cycle-slide-added", function(t, e, i, s) {
            e.pager && (e.API.buildPagerLink(e, i, s), e.API.page = n)
        }), t(document).on("cycle-slide-removed", function(e, n, i, s) {
            if (n.pager) {
                var a = n.API.getComponent("pager");
                a.each(function() {
                    var e = t(this);
                    t(e.children()[i]).remove()
                })
            }
        }), t(document).on("cycle-update-view", function(e, n, i) {
            var s;
            n.pager && (s = n.API.getComponent("pager"), s.each(function() {
                t(this).children().removeClass(n.pagerActiveClass).eq(n.currSlide).addClass(n.pagerActiveClass)
            }))
        }), t(document).on("cycle-destroyed", function(t, e) {
            var n = e.API.getComponent("pager");
            n && (n.children().off(e.pagerEvent), e.pagerTemplate && n.empty())
        })
    }(jQuery),
    function(t) {
        "use strict";
        t.extend(t.fn.cycle.defaults, {
            next: "> .cycle-next",
            nextEvent: "click.cycle",
            disabledClass: "disabled",
            prev: "> .cycle-prev",
            prevEvent: "click.cycle",
            swipe: !1
        }), t(document).on("cycle-initialized", function(t, e) {
            if (e.API.getComponent("next").on(e.nextEvent, function(t) {
                    t.preventDefault(), e.API.next()
                }), e.API.getComponent("prev").on(e.prevEvent, function(t) {
                    t.preventDefault(), e.API.prev()
                }), e.swipe) {
                var n = e.swipeVert ? "swipeUp.cycle" : "swipeLeft.cycle swipeleft.cycle",
                    i = e.swipeVert ? "swipeDown.cycle" : "swipeRight.cycle swiperight.cycle";
                e.container.on(n, function(t) {
                    e.API.next()
                }), e.container.on(i, function() {
                    e.API.prev()
                })
            }
        }), t(document).on("cycle-update-view", function(t, e, n, i) {
            if (!e.allowWrap) {
                var s = e.disabledClass,
                    a = e.API.getComponent("next"),
                    o = e.API.getComponent("prev"),
                    r = e._prevBoundry || 0,
                    l = e._nextBoundry || e.slideCount - 1;
                e.currSlide == l ? a.addClass(s).prop("disabled", !0) : a.removeClass(s).prop("disabled", !1), e.currSlide === r ? o.addClass(s).prop("disabled", !0) : o.removeClass(s).prop("disabled", !1)
            }
        }), t(document).on("cycle-destroyed", function(t, e) {
            e.API.getComponent("prev").off(e.nextEvent), e.API.getComponent("next").off(e.prevEvent), e.container.off("swipeleft.cycle swiperight.cycle swipeLeft.cycle swipeRight.cycle swipeUp.cycle swipeDown.cycle")
        })
    }(jQuery),
    function(t) {
        "use strict";
        t.extend(t.fn.cycle.defaults, {
            progressive: !1
        }), t(document).on("cycle-pre-initialize", function(e, n) {
            if (n.progressive) {
                var i, s, a = n.API,
                    o = a.next,
                    r = a.prev,
                    l = a.prepareTx,
                    c = t.type(n.progressive);
                if ("array" == c) i = n.progressive;
                else if (t.isFunction(n.progressive)) i = n.progressive(n);
                else if ("string" == c) {
                    if (s = t(n.progressive), i = t.trim(s.html()), !i) return;
                    if (/^(\[)/.test(i)) try {
                        i = t.parseJSON(i)
                    } catch (d) {
                        return void a.log("error parsing progressive slides", d)
                    } else i = i.split(new RegExp(s.data("cycle-split") || "\n")), i[i.length - 1] || i.pop()
                }
                l && (a.prepareTx = function(t, e) {
                    var s, a;
                    return t || 0 === i.length ? void l.apply(n.API, [t, e]) : void(e && n.currSlide == n.slideCount - 1 ? (a = i[0], i = i.slice(1), n.container.one("cycle-slide-added", function(t, e) {
                        setTimeout(function() {
                            e.API.advanceSlide(1)
                        }, 50)
                    }), n.API.add(a)) : e || 0 !== n.currSlide ? l.apply(n.API, [t, e]) : (s = i.length - 1, a = i[s], i = i.slice(0, s), n.container.one("cycle-slide-added", function(t, e) {
                        setTimeout(function() {
                            e.currSlide = 1, e.API.advanceSlide(-1)
                        }, 50)
                    }), n.API.add(a, !0)))
                }), o && (a.next = function() {
                    var t = this.opts();
                    if (i.length && t.currSlide == t.slideCount - 1) {
                        var e = i[0];
                        i = i.slice(1), t.container.one("cycle-slide-added", function(t, e) {
                            o.apply(e.API), e.container.removeClass("cycle-loading")
                        }), t.container.addClass("cycle-loading"), t.API.add(e)
                    } else o.apply(t.API)
                }), r && (a.prev = function() {
                    var t = this.opts();
                    if (i.length && 0 === t.currSlide) {
                        var e = i.length - 1,
                            n = i[e];
                        i = i.slice(0, e), t.container.one("cycle-slide-added", function(t, e) {
                            e.currSlide = 1, e.API.advanceSlide(-1), e.container.removeClass("cycle-loading")
                        }), t.container.addClass("cycle-loading"), t.API.add(n, !0)
                    } else r.apply(t.API)
                })
            }
        })
    }(jQuery),
    function(t) {
        "use strict";
        t.extend(t.fn.cycle.defaults, {
            tmplRegex: "{{((.)?.*?)}}"
        }), t.extend(t.fn.cycle.API, {
            tmpl: function(e, n) {
                var i = new RegExp(n.tmplRegex || t.fn.cycle.defaults.tmplRegex, "g"),
                    s = t.makeArray(arguments);
                return s.shift(), e.replace(i, function(e, n) {
                    var i, a, o, r, l = n.split(".");
                    for (i = 0; i < s.length; i++)
                        if (o = s[i]) {
                            if (l.length > 1)
                                for (r = o, a = 0; a < l.length; a++) o = r, r = r[l[a]] || n;
                            else r = o[n];
                            if (t.isFunction(r)) return r.apply(o, s);
                            if (void 0 !== r && null !== r && r != n) return r
                        }
                    return n
                })
            }
        })
    }(jQuery),
    function(t) {
        "use strict";
        t(document).on("cycle-bootstrap", function(t, e, n) {
            "carousel" === e.fx && (n.getSlideIndex = function(t) {
                var e = this.opts()._carouselWrap.children(),
                    n = e.index(t);
                return n % e.length
            }, n.next = function() {
                var t = e.reverse ? -1 : 1;
                e.allowWrap === !1 && e.currSlide + t > e.slideCount - e.carouselVisible || (e.API.advanceSlide(t), e.API.trigger("cycle-next", [e]).log("cycle-next"))
            })
        }), t.fn.cycle.transitions.carousel = {
            preInit: function(e) {
                e.hideNonActive = !1, e.container.on("cycle-destroyed", t.proxy(this.onDestroy, e.API)), e.API.stopTransition = this.stopTransition;
                for (var n = 0; n < e.startingSlide; n++) e.container.append(e.slides[0])
            },
            postInit: function(e) {
                var n, i, s, a, o = e.carouselVertical;
                e.carouselVisible && e.carouselVisible > e.slideCount && (e.carouselVisible = e.slideCount - 1);
                var r = e.carouselVisible || e.slides.length,
                    l = {
                        display: o ? "block" : "inline-block",
                        position: "static"
                    };
                if (e.container.css({
                        position: "relative",
                        overflow: "hidden"
                    }), e.slides.css(l), e._currSlide = e.currSlide, a = t('<div class="cycle-carousel-wrap"></div>').prependTo(e.container).css({
                        margin: 0,
                        padding: 0,
                        top: 0,
                        left: 0,
                        position: "absolute"
                    }).append(e.slides), e._carouselWrap = a, o || a.css("white-space", "nowrap"), e.allowWrap !== !1) {
                    for (i = 0; i < (void 0 === e.carouselVisible ? 2 : 1); i++) {
                        for (n = 0; n < e.slideCount; n++) a.append(e.slides[n].cloneNode(!0));
                        for (n = e.slideCount; n--;) a.prepend(e.slides[n].cloneNode(!0))
                    }
                    a.find(".cycle-slide-active").removeClass("cycle-slide-active"), e.slides.eq(e.startingSlide).addClass("cycle-slide-active")
                }
                e.pager && e.allowWrap === !1 && (s = e.slideCount - r, t(e.pager).children().filter(":gt(" + s + ")").hide()), e._nextBoundry = e.slideCount - e.carouselVisible, this.prepareDimensions(e)
            },
            prepareDimensions: function(e) {
                var n, i, s, a = e.carouselVertical,
                    o = e.carouselVisible || e.slides.length;
                if (e.carouselFluid && e.carouselVisible ? e._carouselResizeThrottle || this.fluidSlides(e) : e.carouselVisible && e.carouselSlideDimension ? (n = o * e.carouselSlideDimension, e.container[a ? "height" : "width"](n)) : e.carouselVisible && (n = o * t(e.slides[0])[a ? "outerHeight" : "outerWidth"](!0), e.container[a ? "height" : "width"](n)), i = e.carouselOffset || 0, e.allowWrap !== !1)
                    if (e.carouselSlideDimension) i -= (e.slideCount + e.currSlide) * e.carouselSlideDimension;
                    else {
                        s = e._carouselWrap.children();
                        for (var r = 0; r < e.slideCount + e.currSlide; r++) i -= t(s[r])[a ? "outerHeight" : "outerWidth"](!0)
                    }
                e._carouselWrap.css(a ? "top" : "left", i)
            },
            fluidSlides: function(e) {
                function n() {
                    clearTimeout(s), s = setTimeout(i, 20)
                }

                function i() {
                    e._carouselWrap.stop(!1, !0);
                    var t = e.container.width() / e.carouselVisible;
                    t = Math.ceil(t - o), e._carouselWrap.children().width(t), e._sentinel && e._sentinel.width(t), r(e)
                }
                var s, a = e.slides.eq(0),
                    o = a.outerWidth() - a.width(),
                    r = this.prepareDimensions;
                t(window).on("resize", n), e._carouselResizeThrottle = n, i()
            },
            transition: function(e, n, i, s, a) {
                var o, r = {},
                    l = e.nextSlide - e.currSlide,
                    c = e.carouselVertical,
                    d = e.speed;
                if (e.allowWrap === !1) {
                    s = l > 0;
                    var u = e._currSlide,
                        h = e.slideCount - e.carouselVisible;
                    l > 0 && e.nextSlide > h && u == h ? l = 0 : l > 0 && e.nextSlide > h ? l = e.nextSlide - u - (e.nextSlide - h) : 0 > l && e.currSlide > h && e.nextSlide > h ? l = 0 : 0 > l && e.currSlide > h ? l += e.currSlide - h : u = e.currSlide, o = this.getScroll(e, c, u, l), e.API.opts()._currSlide = e.nextSlide > h ? h : e.nextSlide
                } else s && 0 === e.nextSlide ? (o = this.getDim(e, e.currSlide, c), a = this.genCallback(e, s, c, a)) : s || e.nextSlide != e.slideCount - 1 ? o = this.getScroll(e, c, e.currSlide, l) : (o = this.getDim(e, e.currSlide, c), a = this.genCallback(e, s, c, a));
                r[c ? "top" : "left"] = s ? "-=" + o : "+=" + o, e.throttleSpeed && (d = o / t(e.slides[0])[c ? "height" : "width"]() * e.speed), e._carouselWrap.animate(r, d, e.easing, a)
            },
            getDim: function(e, n, i) {
                var s = t(e.slides[n]);
                return s[i ? "outerHeight" : "outerWidth"](!0)
            },
            getScroll: function(t, e, n, i) {
                var s, a = 0;
                if (i > 0)
                    for (s = n; n + i > s; s++) a += this.getDim(t, s, e);
                else
                    for (s = n; s > n + i; s--) a += this.getDim(t, s, e);
                return a
            },
            genCallback: function(e, n, i, s) {
                return function() {
                    var n = t(e.slides[e.nextSlide]).position(),
                        a = 0 - n[i ? "top" : "left"] + (e.carouselOffset || 0);
                    e._carouselWrap.css(e.carouselVertical ? "top" : "left", a), s()
                }
            },
            stopTransition: function() {
                var t = this.opts();
                t.slides.stop(!1, !0), t._carouselWrap.stop(!1, !0)
            },
            onDestroy: function(e) {
                var n = this.opts();
                n._carouselResizeThrottle && t(window).off("resize", n._carouselResizeThrottle),
                    n.slides.prependTo(n.container), n._carouselWrap.remove()
            }
        }
    }(jQuery),
    function(t) {
        null == t.isNumeric && (t.isNumeric = function(t) {
            return null != t && t.constructor === Number
        }), null == t.isFunction && (t.isFunction = function(t) {
            return null != t && t instanceof Function
        });
        var e = t(window),
            n = t(document),
            i = {
                defaultConfig: {
                    animate: !1,
                    cellW: 100,
                    cellH: 100,
                    delay: 0,
                    engine: "giot",
                    fixSize: null,
                    gutterX: 15,
                    gutterY: 15,
                    selector: "> div",
                    draggable: !1,
                    rightToLeft: !1,
                    bottomToTop: !1,
                    onStartSet: function() {},
                    onGapFound: function() {},
                    onComplete: function() {},
                    onResize: function() {},
                    onSetBlock: function() {}
                },
                plugin: {},
                totalGrid: 1,
                transition: !1,
                loadBlock: function(e, n) {
                    var i = n.runtime,
                        s = t(e),
                        a = null,
                        o = i.gutterX,
                        r = i.gutterY,
                        l = parseInt(s.attr("data-fixSize")),
                        c = i.lastId++ + "-" + this.totalGrid;
                    if (!s.hasClass("fw-float")) {
                        s.attr({
                            id: c,
                            "data-delay": e.index
                        }), n.animate && this.transition && this.setTransition(e, ""), null == s.attr("data-height") && s.attr("data-height", s.height()), null == s.attr("data-width") && s.attr("data-width", s.width());
                        var d = 1 * s.attr("data-height"),
                            u = 1 * s.attr("data-width"),
                            h = s.attr("data-fixPos"),
                            f = i.cellH,
                            p = i.cellW,
                            g = u ? Math.round((u + o) / p) : 0,
                            m = d ? Math.round((d + r) / f) : 0;
                        return isNaN(l) && (l = null), l || "auto" != n.cellH || (s.width(p * g - o), e.style.height = "", d = s.height(), m = d ? Math.round((d + r) / f) : 0), l || "auto" != n.cellW || (s.height(f * m - r), e.style.width = "", u = s.width(), g = u ? Math.round((u + o) / p) : 0), null != l && (g > i.limitCol || m > i.limitRow) ? a = null : (m && m < i.minHoB && (i.minHoB = m), g && g < i.minWoB && (i.minWoB = g), m > i.maxHoB && (i.maxHoB = m), g > i.maxWoB && (i.maxWoB = g), 0 == u && (g = 0), 0 == d && (m = 0), a = {
                            id: c,
                            width: g,
                            height: m,
                            fixSize: l
                        }, h && (h = h.split("-"), a.y = 1 * h[0], a.x = 1 * h[1], a.width = null != l ? g : Math.min(g, i.limitCol - a.x), a.height = null != l ? m : Math.min(m, i.limitRow - a.y), i.holes.push({
                            top: a.y,
                            left: a.x,
                            width: a.width,
                            height: a.height
                        }), this.setBlock(a, n))), null == s.attr("data-state") ? s.attr("data-state", "init") : s.attr("data-state", "move"), h ? null : a
                    }
                },
                setBlock: function(t, e) {
                    var n = e.runtime,
                        i = n.gutterX,
                        s = n.gutterY,
                        a = t.height,
                        o = t.width,
                        r = n.cellH,
                        l = n.cellW,
                        c = t.x,
                        d = t.y;
                    e.rightToLeft && (c = n.limitCol - c - o), e.bottomToTop && (d = n.limitRow - d - a);
                    var u = {
                        fixSize: t.fixSize,
                        top: d * r,
                        left: c * l,
                        width: l * o - i,
                        height: r * a - s
                    };
                    return u.top = 1 * u.top.toFixed(2), u.left = 1 * u.left.toFixed(2), u.width = 1 * u.width.toFixed(2), u.height = 1 * u.height.toFixed(2), t.id && (n.blocks[t.id] = u), u
                },
                showBlock: function(e, n) {
                    function i() {
                        if (c && r.attr("data-state", "start"), n.animate && l.transition && l.setTransition(e, d), o) o.fixSize && (o.height = 1 * r.attr("data-height"), o.width = 1 * r.attr("data-width")), r.css({
                            opacity: 1,
                            width: o.width,
                            height: o.height
                        }), r[a]({
                            top: o.top,
                            left: o.left
                        }), null != r.attr("data-nested") && l.nestedGrid(e, n);
                        else {
                            var t = parseInt(e.style.height) || 0,
                                i = parseInt(e.style.width) || 0,
                                u = parseInt(e.style.left) || 0,
                                h = parseInt(e.style.top) || 0;
                            r[a]({
                                left: u + i / 2,
                                top: h + t / 2,
                                width: 0,
                                height: 0,
                                opacity: 0
                            })
                        }
                        s.length -= 1, n.onSetBlock.call(e, o, n), 0 == s.length && n.onComplete.call(e, o, n)
                    }
                    var s = n.runtime,
                        a = n.animate && !this.transition ? "animate" : "css",
                        o = s.blocks[e.id],
                        r = t(e),
                        l = this,
                        c = "move" != r.attr("data-state"),
                        d = c ? "width 0.5s, height 0.5s" : "top 0.5s, left 0.5s, width 0.5s, height 0.5s, opacity 0.5s";
                    e.delay && clearTimeout(e.delay), r.hasClass("fw-float") || (l.setTransition(e, ""), e.style.position = "absolute", n.onStartSet.call(e, o, n), n.delay > 0 ? e.delay = setTimeout(i, n.delay * r.attr("data-delay")) : i())
                },
                nestedGrid: function(e, n) {
                    var i, s = t(e),
                        a = n.runtime,
                        o = s.attr("data-gutterX") || n.gutterX,
                        r = s.attr("data-gutterY") || n.gutterY,
                        l = s.attr("data-method") || "fitZone",
                        c = s.attr("data-nested") || "> div",
                        d = s.attr("data-cellH") || n.cellH,
                        u = s.attr("data-cellW") || n.cellW,
                        h = a.blocks[e.id];
                    if (h) switch (i = new freewall(s), i.reset({
                        cellH: d,
                        cellW: u,
                        gutterX: 1 * o,
                        gutterY: 1 * r,
                        selector: c
                    }), l) {
                        case "fitHeight":
                            i[l](h.height);
                            break;
                        case "fitWidth":
                            i[l](h.width);
                            break;
                        case "fitZone":
                            i[l](h.width, h.height)
                    }
                },
                adjustBlock: function(e, n) {
                    var i = n.runtime,
                        s = i.gutterX,
                        a = i.gutterY,
                        o = t("#" + e.id),
                        r = i.cellH,
                        l = i.cellW;
                    (n.cellH = "auto") && (o.width(e.width * l - s), o.get(0).style = "", e.height = Math.round((o.height() + a) / r))
                },
                adjustUnit: function(e, n, i) {
                    var s = i.gutterX,
                        a = i.gutterY,
                        o = i.runtime,
                        r = i.cellW,
                        l = i.cellH;
                    if (t.isFunction(r) && (r = r(e)), r = 1 * r, !t.isNumeric(r) && (r = 1), t.isFunction(l) && (l = l(n)), l = 1 * l, !t.isNumeric(l) && (l = 1), t.isNumeric(e)) {
                        1 > r && (r *= e);
                        var c = Math.max(1, Math.floor(e / r));
                        t.isNumeric(s) || (s = (e - c * r) / Math.max(1, c - 1), s = Math.max(0, s)), c = Math.floor((e + s) / r), o.cellW = (e + s) / c, o.cellS = o.cellW / r, o.gutterX = s, o.limitCol = c
                    }
                    if (t.isNumeric(n)) {
                        1 > l && (l *= n);
                        var d = Math.max(1, Math.floor(n / l));
                        t.isNumeric(a) || (a = (n - d * l) / Math.max(1, d - 1), a = Math.max(0, a)), d = Math.floor((n + a) / l), o.cellH = (n + a) / d, o.cellS = o.cellH / l, o.gutterY = a, o.limitRow = d
                    }
                    t.isNumeric(e) || (1 > r && (r = o.cellH), o.cellW = 1 != r ? r * o.cellS : 1, o.gutterX = s, o.limitCol = 666666), t.isNumeric(n) || (1 > l && (l = o.cellW), o.cellH = 1 != l ? l * o.cellS : 1, o.gutterY = a, o.limitRow = 666666)
                },
                resetGrid: function(t) {
                    t.blocks = {}, t.length = 0, t.cellH = 0, t.cellW = 0, t.lastId = 1, t.matrix = {}, t.totalCol = 0, t.totalRow = 0
                },
                setDragable: function(e, i) {
                    var s = !1,
                        a = {
                            sX: 0,
                            sY: 0,
                            top: 0,
                            left: 0,
                            proxy: null,
                            end: function() {},
                            move: function() {},
                            start: function() {}
                        };
                    t(e).each(function() {
                        function e(t) {
                            return t.stopPropagation(), t = t.originalEvent, t.touches && (s = !0, t = t.changedTouches[0]), 2 != t.button && 3 != t.which && (l.start.call(c, t), l.sX = t.clientX, l.sY = t.clientY, l.top = parseInt(d.css("top")) || 0, l.left = parseInt(d.css("left")) || 0, n.bind("mouseup touchend", r), n.bind("mousemove touchmove", o)), !1
                        }

                        function o(t) {
                            t = t.originalEvent, s && (t = t.changedTouches[0]), d.css({
                                top: l.top - (l.sY - t.clientY),
                                left: l.left - (l.sX - t.clientX)
                            }), l.move.call(c, t)
                        }

                        function r(t) {
                            t = t.originalEvent, s && (t = t.changedTouches[0]), l.end.call(c, t), n.unbind("mouseup touchend", r), n.unbind("mousemove touchmove", o)
                        }
                        var l = t.extend({}, a, i),
                            c = l.proxy || this,
                            d = t(c),
                            u = d.css("position");
                        "absolute" != u && d.css("position", "relative"), t(this).find("iframe, form, input, textarea, .ignore-drag").each(function() {
                            t(this).on("touchstart mousedown", function(t) {
                                t.stopPropagation()
                            })
                        }), n.unbind("mouseup touchend", r), n.unbind("mousemove touchmove", o), d.unbind("mousedown touchstart").bind("mousedown touchstart", e)
                    })
                },
                setTransition: function(e, n) {
                    var i = e.style,
                        s = t(e);
                    !this.transition && s.stop ? s.stop() : null != i.webkitTransition ? i.webkitTransition = n : null != i.MozTransition ? i.MozTransition = n : null != i.msTransition ? i.msTransition = n : null != i.OTransition ? i.OTransition = n : i.transition = n
                },
                getFreeArea: function(t, e, n) {
                    for (var i = Math.min(t + n.maxHoB, n.limitRow), s = Math.min(e + n.maxWoB, n.limitCol), a = s, o = i, r = n.matrix, l = t; o > l; ++l)
                        for (var c = e; s > c; ++c) 1 == r[l + "-" + c] && c > e && a > c && (a = c);
                    for (var l = t; i > l; ++l)
                        for (var c = e; a > c; ++c) 1 == r[l + "-" + c] && l > t && o > l && (o = l);
                    return {
                        top: t,
                        left: e,
                        width: a - e,
                        height: o - t
                    }
                },
                setWallSize: function(t, e) {
                    var n = Math.max(1, t.totalRow),
                        i = Math.max(1, t.totalCol),
                        s = t.gutterY,
                        a = t.gutterX,
                        o = t.cellH,
                        r = t.cellW,
                        l = r * i - a,
                        c = o * n - s;
                    e.attr({
                        "data-total-col": i,
                        "data-total-row": n,
                        "data-wall-width": Math.ceil(l),
                        "data-wall-height": Math.ceil(c)
                    }), t.limitCol < t.limitRow && !e.attr("data-height") && e.height(Math.ceil(c))
                }
            },
            s = {
                giot: function(t, e) {
                    function n(t, e, n, i) {
                        for (var s = t; t + i > s;) {
                            for (var a = e; e + n > a;) p[s + "-" + a] = !0, ++a > c && (c = a);
                            ++s > d && (d = s)
                        }
                    }
                    var s = e.runtime,
                        a = s.limitRow,
                        o = s.limitCol,
                        r = 0,
                        l = 0,
                        c = s.totalCol,
                        d = s.totalRow,
                        u = {},
                        h = s.holes,
                        f = null,
                        p = s.matrix,
                        g = Math.max(o, a),
                        m = null,
                        v = null,
                        y = a > o ? 1 : 0,
                        _ = null,
                        b = Math.min(o, a);
                    if (h.length)
                        for (var x = 0; x < h.length; ++x) n(h[x].top, h[x].left, h[x].width, h[x].height);
                    for (var w = 0; g > w && t.length; ++w) {
                        y ? l = w : r = w, _ = null;
                        for (var C = 0; b > C && t.length; ++C)
                            if (y ? r = C : l = C, !s.matrix[l + "-" + r]) {
                                m = i.getFreeArea(l, r, s), f = null;
                                for (var x = 0; x < t.length; ++x)
                                    if (!(t[x].height > m.height || t[x].width > m.width)) {
                                        f = t.splice(x, 1)[0];
                                        break
                                    }
                                if (null == f && null == e.fixSize) {
                                    if (_ && !y && s.minHoB > m.height) {
                                        _.height += m.height, n(_.y, _.x, _.width, _.height), i.setBlock(_, e);
                                        continue
                                    }
                                    if (_ && y && s.minWoB > m.width) {
                                        _.width += m.width, n(_.y, _.x, _.width, _.height), i.setBlock(_, e);
                                        continue
                                    }
                                    for (var x = 0; x < t.length; ++x)
                                        if (null == t[x].fixSize) {
                                            f = t.splice(x, 1)[0], y ? (f.width = m.width, "auto" == e.cellH && i.adjustBlock(f, e), f.height = Math.min(f.height, m.height)) : (f.height = m.height, f.width = Math.min(f.width, m.width));
                                            break
                                        }
                                }
                                if (null != f) u[f.id] = {
                                    id: f.id,
                                    x: r,
                                    y: l,
                                    width: f.width,
                                    height: f.height,
                                    fixSize: f.fixSize
                                }, _ = u[f.id], n(_.y, _.x, _.width, _.height), i.setBlock(_, e);
                                else {
                                    var v = {
                                        x: r,
                                        y: l,
                                        fixSize: 0
                                    };
                                    if (y) {
                                        v.width = m.width, v.height = 0;
                                        for (var k = r - 1, S = l; p[S + "-" + k];) p[S + "-" + r] = !0, v.height += 1, S += 1
                                    } else {
                                        v.height = m.height, v.width = 0;
                                        for (var S = l - 1, k = r; p[S + "-" + k];) p[l + "-" + k] = !0, v.width += 1, k += 1
                                    }
                                    e.onGapFound(i.setBlock(v, e), e)
                                }
                            }
                    }
                    s.matrix = p, s.totalRow = d, s.totalCol = c
                }
            };
        window.freewall = function(n) {
            function a(e) {
                var n = (d.gutterX, d.gutterY, d.cellH),
                    s = d.cellW;
                i.setDragable(e, {
                    start: function(e) {
                        c.animate && i.transition && i.setTransition(this, ""), t(this).css("z-index", 9999).addClass("fw-float")
                    },
                    move: function(e, i) {
                        var a = t(this).position(),
                            o = Math.round(a.top / n),
                            r = Math.round(a.left / s),
                            c = Math.round(t(this).width() / s),
                            u = Math.round(t(this).height() / n);
                        o = Math.min(Math.max(0, o), d.limitRow - u), r = Math.min(Math.max(0, r), d.limitCol - c), l.setHoles([{
                            top: o,
                            left: r,
                            width: c,
                            height: u
                        }]), l.refresh()
                    },
                    end: function() {
                        var e = t(this).position(),
                            i = Math.round(e.top / n),
                            a = Math.round(e.left / s),
                            o = Math.round(t(this).width() / s),
                            r = Math.round(t(this).height() / n);
                        i = Math.min(Math.max(0, i), d.limitRow - r), a = Math.min(Math.max(0, a), d.limitCol - o), t(this).css({
                            zIndex: "auto",
                            top: i * n,
                            left: a * s
                        }).removeClass("fw-float"), l.fillHoles()
                    }
                })
            }
            var o = t(n);
            "static" == o.css("position") && o.css("position", "relative");
            var r = Number.MAX_VALUE,
                l = this;
            i.totalGrid += 1;
            var c = t.extend({}, i.defaultConfig),
                d = {
                    blocks: {},
                    events: {},
                    matrix: {},
                    holes: [],
                    cellW: 0,
                    cellH: 0,
                    cellS: 1,
                    filter: "",
                    lastId: 0,
                    length: 0,
                    maxWoB: 0,
                    maxHoB: 0,
                    minWoB: r,
                    minHoB: r,
                    running: 0,
                    gutterX: 15,
                    gutterY: 15,
                    totalCol: 0,
                    totalRow: 0,
                    limitCol: 666666,
                    limitRow: 666666,
                    currentMethod: null,
                    currentArguments: []
                };
            c.runtime = d;
            var u = document.body.style;
            i.transition || (null != u.webkitTransition || null != u.MozTransition || null != u.msTransition || null != u.OTransition || null != u.transition) && (i.transition = !0), t.extend(l, {
                addCustomEvent: function(t, e) {
                    var n = d.events;
                    return t = t.toLowerCase(), !n[t] && (n[t] = []), e.eid = n[t].length, n[t].push(e), this
                },
                appendBlock: function(e) {
                    var n = t(e).appendTo(o),
                        r = null,
                        u = [];
                    n.each(function(t, e) {
                        e.index = ++t, (r = i.loadBlock(e, c)) && (u.push(r), l.fireEvent("onBlockLoad", e, c))
                    }), s[c.engine](u, c), i.setWallSize(d, o), d.length = n.length, n.each(function(t, e) {
                        c.draggable && a(e), i.showBlock(e, c), l.fireEvent("onBlockShow", e, c)
                    })
                },
                appendHoles: function(t) {
                    return d.holes = d.holes.concat(t), this
                },
                container: o,
                fillHoles: function() {
                    return d.holes = [], this
                },
                filter: function(t) {
                    return d.filter = t, d.currentMethod && this.refresh(), this
                },
                fireEvent: function(t, e, n) {
                    var i = d.events;
                    if (t = t.toLowerCase(), i[t] && i[t].length)
                        for (var s = 0; s < i[t].length; ++s) i[t][s].call(e, n);
                    return this
                },
                fitHeight: function(n) {
                    var r = o.find(c.selector).removeAttr("id"),
                        u = null,
                        h = [];
                    n = n ? n : o.height() || e.height(), d.currentMethod = arguments.callee, d.currentArguments = arguments, i.resetGrid(d), i.adjustUnit("auto", n, c), d.filter ? (r.data("active", 0), r.filter(d.filter).data("active", 1)) : r.data("active", 1), l.fireEvent("onGridReady", o, c), r.each(function(e, n) {
                        var s = t(n);
                        n.index = ++e, (u = i.loadBlock(n, c)) && (s.data("active") && h.push(u), l.fireEvent("onBlockLoad", n, c))
                    }), l.fireEvent("onGridLoad", o, c), s[c.engine](h, c), i.setWallSize(d, o), l.fireEvent("onGridArrange", o, c), d.length = r.length, r.each(function(t, e) {
                        c.draggable && a(e), i.showBlock(e, c), l.fireEvent("onBlockShow", e, c)
                    }), l.fireEvent("onGridShow", o, c)
                },
                fitWidth: function(n) {
                    var r = o.find(c.selector).removeAttr("id"),
                        u = null,
                        h = [];
                    n = n ? n : o.width() || e.width(), d.currentMethod = arguments.callee, d.currentArguments = arguments, i.resetGrid(d), i.adjustUnit(n, "auto", c), d.filter ? (r.data("active", 0), r.filter(d.filter).data("active", 1)) : r.data("active", 1), l.fireEvent("onGridReady", o, c), r.each(function(e, n) {
                        var s = t(n);
                        n.index = ++e, (u = i.loadBlock(n, c)) && (s.data("active") && h.push(u), l.fireEvent("onBlockLoad", n, c))
                    }), l.fireEvent("onGridLoad", o, c), s[c.engine](h, c), i.setWallSize(d, o), l.fireEvent("onGridArrange", o, c), d.length = r.length, r.each(function(t, e) {
                        c.draggable && a(e), i.showBlock(e, c), l.fireEvent("onBlockShow", e, c)
                    }), l.fireEvent("onGridShow", o, c)
                },
                fitZone: function(n, r) {
                    var u = o.find(c.selector).removeAttr("id"),
                        h = null,
                        f = [];
                    r = r ? r : o.height() || e.height(), n = n ? n : o.width() || e.width(), d.currentMethod = arguments.callee, d.currentArguments = arguments, i.resetGrid(d), i.adjustUnit(n, r, c), d.filter ? (u.data("active", 0), u.filter(d.filter).data("active", 1)) : u.data("active", 1), l.fireEvent("onGridReady", o, c), u.each(function(e, n) {
                        var s = t(n);
                        n.index = ++e, (h = i.loadBlock(n, c)) && (s.data("active") && f.push(h), l.fireEvent("onBlockLoad", n, c))
                    }), l.fireEvent("onGridLoad", o, c), s[c.engine](f, c), i.setWallSize(d, o), l.fireEvent("onGridArrange", o, c), d.length = u.length, u.each(function(t, e) {
                        c.draggable && a(e), i.showBlock(e, c), l.fireEvent("onBlockShow", e, c)
                    }), l.fireEvent("onGridShow", o, c)
                },
                fixPos: function(e) {
                    return t(e.block).attr({
                        "data-fixPos": e.top + "-" + e.left
                    }), this
                },
                fixSize: function(e) {
                    return null != e.width && t(e.block).attr({
                        "data-width": e.width
                    }), null != e.height && t(e.block).attr({
                        "data-height": e.height
                    }), this
                },
                prepend: function(t) {
                    return o.prepend(t), d.currentMethod && this.refresh(), this
                },
                refresh: function() {
                    var t = arguments.length ? arguments : d.currentArguments;
                    return null == d.currentMethod && (d.currentMethod = this.fitWidth), d.currentMethod.apply(this, Array.prototype.slice.call(t, 0)), this
                },
                reset: function(e) {
                    return t.extend(c, e), this
                },
                setHoles: function(t) {
                    return d.holes = [].concat(t), this
                },
                unFilter: function() {
                    return delete d.filter, this.refresh(), this
                }
            }), o.attr("data-min-width", 80 * Math.floor(e.width() / 80));
            for (var h in i.plugin) i.plugin.hasOwnProperty(h) && i.plugin[h].call(l, c, o);
            e.resize(function() {
                d.running || (d.running = 1, setTimeout(function() {
                    d.running = 0, c.onResize.call(l, o)
                }, 122), o.attr("data-min-width", 80 * Math.floor(e.width() / 80)))
            })
        }, freewall.createPlugin = function(e) {
            return t.extend(i.plugin, e), {
                addConfig: function(e) {
                    t.extend(i.defaultConfig, e)
                }
            }
        }, freewall.createEngine = function(e) {
            t.extend(s, e)
        }, freewall.getMethod = function(t) {
            return i[t]
        }
    }(window.Zepto || window.jQuery), $(document).foundation(), $(document).ready(function() {
        $(".banner ul li > img, .index-testimonial > img, .service-features1 > img, .service-example > img, .service-landing-title-img > img").each(function(t, e) {
            var n = $(e);
            $(this).hide(), $(this).parent().css({
                background: "url(" + n.attr("src") + ") no-repeat"
            })
        }), $(".banner-inner ul li > img").each(function(t, e) {
            var n = $(e);
            $(this).hide(), $(this).parent().css({
                background: "url(" + n.attr("src") + ") no-repeat",
                backgroundPosition: "center "
            })
        }), checkWidth(!0), $(window).resize(function() {
            checkWidth(!1)
        }), $(window).scroll(function() {
            $(this).scrollTop() > 300 ? $(".back-to-top").addClass("back-to-top-show") : $(".back-to-top").removeClass("back-to-top-show")
        }), $(".back-to-top").click(function() {
            return $("html, body").animate({
                scrollTop: 0
            }, 600), !1
        }), $(".ipad .what-we-do-slider").cycle({
            carouselVisible: 2,
            log: !1
        }), $(".mobile .what-we-do-slider").cycle({
            carouselVisible: 1,
            log: !1
        }), $(".desk .take-a-look-slider").cycle({
            carouselVisible: 4,
            log: !1
        }), $(".ipad .take-a-look-slider").cycle({
            carouselVisible: 3,
            log: !1
        }), $(".mobile .take-a-look-slider").cycle({
            carouselVisible: 1,
            log: !1
        }), $(".mobile .latest-work-list-slider").cycle({
            log: !1
        }), $(".mobile .footer-slider").cycle({
            log: !1
        }), $(".index-blog-slider").cycle({
            log: !1
        }), $(".banner-slider").cycle({
            log: !1
        }), $(" .latest-work-list > ul > li").each(function() {
            $(this).hoverdir()
        }), $(".services-detail-tabs-nav ul li a").click(function() {
            $(".services-detail-tabs-nav ul li a").removeClass("active"), $(this).addClass("active"), $(".services-detail-content-right > div").hide(), $("." + $(this).attr("id")).fadeIn("slow")
        }), $(".services-detail-tabs-prev, .services-detail-tabs-next").click(function() {
            var t, e = $(".services-detail-tabs-nav ul li a.active").parent();
            t = $(this).is(".services-detail-tabs-next") ? e.next().size() > 0 ? e.next() : $(".services-detail-tabs-nav ul li").first() : e.prev().size() > 0 ? e.prev() : $(".services-detail-tabs-nav ul li").last(), t.find("a").triggerHandler("click")
        }), $('.service-detail-other-service ul li a[href*="#"]').on("click", function(t) {
            t.preventDefault();
            var e = this.hash,
                n = $(e),
                i = parseInt(n.offset().top) - 75;
            $("html, body").stop().animate({
                scrollTop: i
            }, 900, "swing", function() {})
        }), $(".work-detail-share > a").click(function() {
            $(".work-detail-social-share").fadeIn()
        }), $(".work-detail-social-close").click(function() {
            $(".work-detail-social-share").fadeOut()
        }), $("#form_subscriber").submit(function(t) {
            t.preventDefault(), $.ajax($(this).attr("action"), {
                method: "post",
                dataType: "json",
                data: $(this).serialize(),
                success: function() {
                    alert("Thankyou for subscribing our newsletter"), $("#form_subscriber")[0].reset()
                },
                error: function(t) {
                    422 == t.status ? alert("Email " + t.responseJSON.errors.email[0]) : alert("Sorry, Please try after some time.")
                }
            })
        }), window.location.hash && $(".filter-label[data-filter='." + window.location.hash.substring(1) + "']").size() > 0 ? $(".filter-label[data-filter='." + window.location.hash.substring(1) + "']").addClass("active") : $(".filter-label").first().addClass("active"), $(".service-nav").mouseenter(function() {
            $(".dropdown-blog").slideUp(300), $(".blog-header-nav").removeClass("active"), $(this).addClass("active"), $(".dropdown").slideDown(300)
        }), $(".header-wrap").mouseleave(function(t) {
            $(".dropdown").slideUp(300), $(".dropdown-blog").slideUp(300), $(".service-nav").removeClass("active"), $(".blog-header-nav").removeClass("active")
        }), $(".blog-header-nav").mouseenter(function() {
            $(".dropdown").slideUp(300), $(this).addClass("active"), $(".dropdown-blog").slideDown(300), $(".service-nav").removeClass("active")
        })
    }), $(".nav-m > a").click(function() {
        var t = $(this).parent();
        $(".nav-m1").each(function(e, n) {
            $(n).parent().is(t) ? $(n).slideToggle() : $(n).slideUp()
        })
    }), $(document).ready(function() {
        $(".nav-m .nav-m1").hide(), $(".nav-m1 > ul > li > ul").hide(), $(".sub-nav-m").click(function() {
            var t = $(this).parent();
            $(".nav-m1 ul li ul").each(function(e, n) {
                $(n).parent().is(t) ? $(n).slideToggle() : $(n).slideUp()
            })
        }), $(".nav-m1 ul li ul").hide(), $("#video_trigger").click(function(t) {
            t.preventDefault(), Modernizr.touch ? window.open($(this).attr("href")) : ($("#video_popup").foundation("reveal", "open"), $("#video_popup_content").html('<iframe width="854" height="480" src="' + $(this).attr("href") + '" frameborder="0" allowfullscreen></iframe>'))
        }), $(document).on("closed", "#video_popup", function() {
            $("#video_popup_content").empty()
        }), $(".banner-scroll-icon a").on("click", function(t) {
            t.preventDefault();
            var e = $(this).data("id"),
                n = $(e);
            $("html, body").stop().animate({
                scrollTop: n.offset().top
            }, 900, "swing", function() {})
        })
    }), $(document).ready(function() {
        $("#home-slide-nav a").click(function(t) {
            t.preventDefault(), $("body, html").animate({
                scrollTop: $($(this).attr("href")).offset().top
            }, 1e3)
        }), $(window).scroll(scrollChange), scrollChange(), $("#category-select").length && "static" == $("#category-select").css("position") && ($(window).scroll(stickyCategorySelect), stickyCategorySelect())
    }), $(window).scroll(function() {
        var t = $(window).scrollTop();
        t = .9 * t, $(".banner-inner ul li").css("background-position", "center " + t + "px")
    }), $(function() {
        $(window).scroll(function() {
            EasyPeasyParallax()
        })
    }), $(window).load(function() {
        $("#freewall").size() > 0 && (wall = new freewall("#freewall"), wall.reset({
            gutterX: 25,
            gutterY: 25,
            cellW: 480,
            cellH: 300,
            selector: ".brick",
            animate: !0,
            onResize: function() {
                wall.refresh()
            }
        }), wall.filter(), $(".filter-label").click(function() {
            var t = $(this).data("filter");
            t ? (wall.filter(t), window.location.hash = t.replace(".", "")) : (wall.unFilter(), window.location.hash = "")
        }), $(".filter-label").click(function() {
            $(".filter-label").removeClass("active");
            var t = $(this).addClass("active").data("filter");
            t ? wall.filter(t) : wall.unFilter()
        }), $(".filter-label.active").triggerHandler("click"), wall.fitWidth())
    }), $(document).on("page:before-change", function() {
        $("#page_loader").css({
            left: ($(window).width() - $("#page_loader").width()) / 2
        }), $("#page_loader").show()
    }), $(document).on("page:load, page:restore", function() {
        $("#page_loader").hide(), $(".addthis_toolbox").size() > 0 && addthis.toolbox(".addthis_toolbox")
    }), $(document).ready(function() {
        "1" != $.cookie("blogp") && jQuery(".pop").trigger("click"), $.cookie("blogp", "1", {
            expires: 1
        })
    }), $(window).load(function() {
        $(document).scrollTop() > $(document).height() - 395 ? $(".f-map").addClass("hidden") : $(".f-map").removeClass("hidden")
    });