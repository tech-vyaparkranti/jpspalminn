!(function (T) {
    T.fn.extend({
        slimScroll: function (E) {
            var k = T.extend(
                {
                    width: "auto",
                    height: "250px",
                    size: "7px",
                    color: "#000",
                    position: "right",
                    distance: "1px",
                    start: "top",
                    opacity: 0.4,
                    alwaysVisible: !1,
                    disableFadeOut: !1,
                    railVisible: !1,
                    railColor: "#333",
                    railOpacity: 0.2,
                    railDraggable: !0,
                    railClass: "slimScrollRail",
                    barClass: "slimScrollBar",
                    wrapperClass: "slimScrollDiv",
                    allowPageScroll: !1,
                    wheelStep: 20,
                    touchScrollStep: 200,
                    borderRadius: "0",
                    railBorderRadius: "0",
                },
                E
            );
            return (
                this.each(function () {
                    var n,
                        e,
                        s,
                        i,
                        o,
                        a,
                        r,
                        l,
                        d = "<div></div>",
                        c = 30,
                        h = !1,
                        p = T(this);
                    if (p.parent().hasClass(k.wrapperClass)) {
                        var u = p.scrollTop();
                        if (((b = p.closest("." + k.barClass)), (v = p.closest("." + k.railClass)), y(), T.isPlainObject(E))) {
                            if ("height" in E && "auto" == E.height) {
                                p.parent().css("height", "auto"), p.css("height", "auto");
                                var f = p.parent().parent().height();
                                p.parent().css("height", f), p.css("height", f);
                            }
                            if ("scrollTo" in E) u = parseInt(k.scrollTo);
                            else if ("scrollBy" in E) u += parseInt(k.scrollBy);
                            else if ("destroy" in E) return b.remove(), v.remove(), void p.unwrap();
                            x(u, !1, !0);
                        }
                    } else if (!(T.isPlainObject(E) && "destroy" in E)) {
                        k.height = "auto" == k.height ? p.parent().height() : k.height;
                        var m = T(d).addClass(k.wrapperClass).css({ position: "relative", overflow: "hidden", width: k.width, height: k.height });
                        p.css({ overflow: "hidden", width: k.width, height: k.height });
                        var g,
                            v = T(d)
                                .addClass(k.railClass)
                                .css({
                                    width: k.size,
                                    height: "100%",
                                    position: "absolute",
                                    top: 0,
                                    display: k.alwaysVisible && k.railVisible ? "block" : "none",
                                    "border-radius": k.railBorderRadius,
                                    background: k.railColor,
                                    opacity: k.railOpacity,
                                    zIndex: 90,
                                }),
                            b = T(d)
                                .addClass(k.barClass)
                                .css({
                                    background: k.color,
                                    width: k.size,
                                    position: "absolute",
                                    top: 0,
                                    opacity: k.opacity,
                                    display: k.alwaysVisible ? "block" : "none",
                                    "border-radius": k.borderRadius,
                                    BorderRadius: k.borderRadius,
                                    MozBorderRadius: k.borderRadius,
                                    WebkitBorderRadius: k.borderRadius,
                                    zIndex: 99,
                                }),
                            $ = "right" == k.position ? { right: k.distance } : { left: k.distance };
                        v.css($),
                            b.css($),
                            p.wrap(m),
                            p.parent().append(b),
                            p.parent().append(v),
                            k.railDraggable &&
                                b
                                    .bind("mousedown", function (e) {
                                        var i = T(document);
                                        return (
                                            (s = !0),
                                            (t = parseFloat(b.css("top"))),
                                            (pageY = e.pageY),
                                            i.bind("mousemove.slimscroll", function (e) {
                                                (currTop = t + e.pageY - pageY), b.css("top", currTop), x(0, b.position().top, !1);
                                            }),
                                            i.bind("mouseup.slimscroll", function (e) {
                                                (s = !1), S(), i.unbind(".slimscroll");
                                            }),
                                            !1
                                        );
                                    })
                                    .bind("selectstart.slimscroll", function (e) {
                                        return e.stopPropagation(), e.preventDefault(), !1;
                                    }),
                            v.hover(
                                function () {
                                    C();
                                },
                                function () {
                                    S();
                                }
                            ),
                            b.hover(
                                function () {
                                    e = !0;
                                },
                                function () {
                                    e = !1;
                                }
                            ),
                            p.hover(
                                function () {
                                    (n = !0), C(), S();
                                },
                                function () {
                                    (n = !1), S();
                                }
                            ),
                            p.bind("touchstart", function (e, t) {
                                e.originalEvent.touches.length && (o = e.originalEvent.touches[0].pageY);
                            }),
                            p.bind("touchmove", function (e) {
                                (h || e.originalEvent.preventDefault(), e.originalEvent.touches.length) && (x((o - e.originalEvent.touches[0].pageY) / k.touchScrollStep, !0), (o = e.originalEvent.touches[0].pageY));
                            }),
                            y(),
                            "bottom" === k.start ? (b.css({ top: p.outerHeight() - b.outerHeight() }), x(0, !0)) : "top" !== k.start && (x(T(k.start).position().top, null, !0), k.alwaysVisible || b.hide()),
                            (g = this),
                            window.addEventListener ? (g.addEventListener("DOMMouseScroll", w, !1), g.addEventListener("mousewheel", w, !1)) : document.attachEvent("onmousewheel", w);
                    }
                    function w(e) {
                        if (n) {
                            var t = 0;
                            (e = e || window.event).wheelDelta && (t = -e.wheelDelta / 120), e.detail && (t = e.detail / 3);
                            var i = e.target || e.srcTarget || e.srcElement;
                            T(i)
                                .closest("." + k.wrapperClass)
                                .is(p.parent()) && x(t, !0),
                                e.preventDefault && !h && e.preventDefault(),
                                h || (e.returnValue = !1);
                        }
                    }
                    function x(e, t, i) {
                        h = !1;
                        var n = e,
                            s = p.outerHeight() - b.outerHeight();
                        if (
                            (t && ((n = parseInt(b.css("top")) + ((e * parseInt(k.wheelStep)) / 100) * b.outerHeight()), (n = Math.min(Math.max(n, 0), s)), (n = 0 < e ? Math.ceil(n) : Math.floor(n)), b.css({ top: n + "px" })),
                            (n = (r = parseInt(b.css("top")) / (p.outerHeight() - b.outerHeight())) * (p[0].scrollHeight - p.outerHeight())),
                            i)
                        ) {
                            var o = ((n = e) / p[0].scrollHeight) * p.outerHeight();
                            (o = Math.min(Math.max(o, 0), s)), b.css({ top: o + "px" });
                        }
                        p.scrollTop(n), p.trigger("slimscrolling", ~~n), C(), S();
                    }
                    function y() {
                        (a = Math.max((p.outerHeight() / p[0].scrollHeight) * p.outerHeight(), c)), b.css({ height: a + "px" });
                        var e = a == p.outerHeight() ? "none" : "block";
                        b.css({ display: e });
                    }
                    function C() {
                        if ((y(), clearTimeout(i), r == ~~r)) {
                            if (((h = k.allowPageScroll), l != r)) {
                                var e = 0 == ~~r ? "top" : "bottom";
                                p.trigger("slimscroll", e);
                            }
                        } else h = !1;
                        (l = r), a >= p.outerHeight() ? (h = !0) : (b.stop(!0, !0).fadeIn("fast"), k.railVisible && v.stop(!0, !0).fadeIn("fast"));
                    }
                    function S() {
                        k.alwaysVisible ||
                            (i = setTimeout(function () {
                                (k.disableFadeOut && n) || e || s || (b.fadeOut("slow"), v.fadeOut("slow"));
                            }, 1e3));
                    }
                }),
                this
            );
        },
    }),
        T.fn.extend({ slimscroll: T.fn.slimScroll });
})(jQuery),
    (function (e, t) {
        "use strict";
        "function" == typeof define && define.amd
            ? define([], function () {
                  return t.apply(e);
              })
            : "object" == typeof exports
            ? (module.exports = t.call(e))
            : (e.Waves = t.call(e));
    })("object" == typeof global ? global : this, function () {
        "use strict";
        var t = t || {},
            n = document.querySelectorAll.bind(document),
            a = Object.prototype.toString,
            r = "ontouchstart" in window;
        function s(e) {
            var t = typeof e;
            return "function" === t || ("object" === t && !!e);
        }
        function c(e) {
            var t,
                i = a.call(e);
            return "[object String]" === i ? n(e) : s(e) && /^\[object (Array|HTMLCollection|NodeList|Object)\]$/.test(i) && e.hasOwnProperty("length") ? e : s((t = e)) && 0 < t.nodeType ? [e] : [];
        }
        function h(e) {
            var t,
                i,
                n,
                s,
                o = { top: 0, left: 0 },
                a = e && e.ownerDocument;
            return (
                (t = a.documentElement),
                void 0 !== e.getBoundingClientRect && (o = e.getBoundingClientRect()),
                (i = null !== (s = n = a) && s === s.window ? n : 9 === n.nodeType && n.defaultView),
                { top: o.top + i.pageYOffset - t.clientTop, left: o.left + i.pageXOffset - t.clientLeft }
            );
        }
        function p(e) {
            var t = "";
            for (var i in e) e.hasOwnProperty(i) && (t += i + ":" + e[i] + ";");
            return t;
        }
        var u = {
                duration: 750,
                delay: 200,
                show: function (e, t, i) {
                    if (2 === e.button) return !1;
                    t = t || this;
                    var n = document.createElement("div");
                    (n.className = "waves-ripple waves-rippling"), t.appendChild(n);
                    var s = h(t),
                        o = 0,
                        a = 0;
                    (a = 0 <= (a = "touches" in e && e.touches.length ? ((o = e.touches[0].pageY - s.top), e.touches[0].pageX - s.left) : ((o = e.pageY - s.top), e.pageX - s.left)) ? a : 0), (o = 0 <= o ? o : 0);
                    var r = "scale(" + (t.clientWidth / 100) * 3 + ")",
                        l = "translate(0,0)";
                    i && (l = "translate(" + i.x + "px, " + i.y + "px)"),
                        n.setAttribute("data-hold", Date.now()),
                        n.setAttribute("data-x", a),
                        n.setAttribute("data-y", o),
                        n.setAttribute("data-scale", r),
                        n.setAttribute("data-translate", l);
                    var d = { top: o + "px", left: a + "px" };
                    n.classList.add("waves-notransition"),
                        n.setAttribute("style", p(d)),
                        n.classList.remove("waves-notransition"),
                        (d["-webkit-transform"] = r + " " + l),
                        (d["-moz-transform"] = r + " " + l),
                        (d["-ms-transform"] = r + " " + l),
                        (d["-o-transform"] = r + " " + l),
                        (d.transform = r + " " + l),
                        (d.opacity = "1");
                    var c = "mousemove" === e.type ? 2500 : u.duration;
                    (d["-webkit-transition-duration"] = c + "ms"), (d["-moz-transition-duration"] = c + "ms"), (d["-o-transition-duration"] = c + "ms"), (d["transition-duration"] = c + "ms"), n.setAttribute("style", p(d));
                },
                hide: function (e, t) {
                    for (var i = (t = t || this).getElementsByClassName("waves-rippling"), n = 0, s = i.length; n < s; n++) o(e, t, i[n]);
                },
            },
            l = {
                input: function (e) {
                    var t = e.parentNode;
                    if ("i" !== t.tagName.toLowerCase() || !t.classList.contains("waves-effect")) {
                        var i = document.createElement("i");
                        (i.className = e.className + " waves-input-wrapper"), (e.className = "waves-button-input"), t.replaceChild(i, e), i.appendChild(e);
                        var n = window.getComputedStyle(e, null),
                            s = n.color,
                            o = n.backgroundColor;
                        i.setAttribute("style", "color:" + s + ";background:" + o), e.setAttribute("style", "background-color:rgba(0,0,0,0);");
                    }
                },
                img: function (e) {
                    var t = e.parentNode;
                    if ("i" !== t.tagName.toLowerCase() || !t.classList.contains("waves-effect")) {
                        var i = document.createElement("i");
                        t.replaceChild(i, e), i.appendChild(e);
                    }
                },
            };
        function o(e, t, i) {
            if (i) {
                i.classList.remove("waves-rippling");
                var n = i.getAttribute("data-x"),
                    s = i.getAttribute("data-y"),
                    o = i.getAttribute("data-scale"),
                    a = i.getAttribute("data-translate"),
                    r = 350 - (Date.now() - Number(i.getAttribute("data-hold")));
                r < 0 && (r = 0), "mousemove" === e.type && (r = 150);
                var l = "mousemove" === e.type ? 2500 : u.duration;
                setTimeout(function () {
                    var e = {
                        top: s + "px",
                        left: n + "px",
                        opacity: "0",
                        "-webkit-transition-duration": l + "ms",
                        "-moz-transition-duration": l + "ms",
                        "-o-transition-duration": l + "ms",
                        "transition-duration": l + "ms",
                        "-webkit-transform": o + " " + a,
                        "-moz-transform": o + " " + a,
                        "-ms-transform": o + " " + a,
                        "-o-transform": o + " " + a,
                        transform: o + " " + a,
                    };
                    i.setAttribute("style", p(e)),
                        setTimeout(function () {
                            try {
                                t.removeChild(i);
                            } catch (e) {
                                return !1;
                            }
                        }, l);
                }, r);
            }
        }
        var d = {
            touches: 0,
            allowEvent: function (e) {
                var t = !0;
                return /^(mousedown|mousemove)$/.test(e.type) && d.touches && (t = !1), t;
            },
            registerEvent: function (e) {
                var t = e.type;
                "touchstart" === t
                    ? (d.touches += 1)
                    : /^(touchend|touchcancel)$/.test(t) &&
                      setTimeout(function () {
                          d.touches && (d.touches -= 1);
                      }, 500);
            },
        };
        function i(t) {
            var i = (function (e) {
                if (!1 === d.allowEvent(e)) return null;
                for (var t = null, i = e.target || e.srcElement; null !== i.parentElement; ) {
                    if (i.classList.contains("waves-effect") && !(i instanceof SVGElement)) {
                        t = i;
                        break;
                    }
                    i = i.parentElement;
                }
                return t;
            })(t);
            if (null !== i) {
                if (i.disabled || i.getAttribute("disabled") || i.classList.contains("disabled")) return;
                if ((d.registerEvent(t), "touchstart" === t.type && u.delay)) {
                    var n = !1,
                        s = setTimeout(function () {
                            (s = null), u.show(t, i);
                        }, u.delay),
                        o = function (e) {
                            s && (clearTimeout(s), (s = null), u.show(t, i)), n || ((n = !0), u.hide(e, i));
                        };
                    i.addEventListener(
                        "touchmove",
                        function (e) {
                            s && (clearTimeout(s), (s = null)), o(e);
                        },
                        !1
                    ),
                        i.addEventListener("touchend", o, !1),
                        i.addEventListener("touchcancel", o, !1);
                } else u.show(t, i), r && (i.addEventListener("touchend", u.hide, !1), i.addEventListener("touchcancel", u.hide, !1)), i.addEventListener("mouseup", u.hide, !1), i.addEventListener("mouseleave", u.hide, !1);
            }
        }
        return (
            (t.init = function (e) {
                var t = document.body;
                "duration" in (e = e || {}) && (u.duration = e.duration),
                    "delay" in e && (u.delay = e.delay),
                    r && (t.addEventListener("touchstart", i, !1), t.addEventListener("touchcancel", d.registerEvent, !1), t.addEventListener("touchend", d.registerEvent, !1)),
                    t.addEventListener("mousedown", i, !1);
            }),
            (t.attach = function (e, t) {
                var i, n;
                (e = c(e)), "[object Array]" === a.call(t) && (t = t.join(" ")), (t = t ? " " + t : "");
                for (var s = 0, o = e.length; s < o; s++)
                    (n = (i = e[s]).tagName.toLowerCase()), -1 !== ["input", "img"].indexOf(n) && (l[n](i), (i = i.parentElement)), -1 === i.className.indexOf("waves-effect") && (i.className += " waves-effect" + t);
            }),
            (t.ripple = function (e, t) {
                var i = (e = c(e)).length;
                if ((((t = t || {}).wait = t.wait || 0), (t.position = t.position || null), i))
                    for (
                        var n,
                            s,
                            o,
                            a = {},
                            r = 0,
                            l = { type: "mousedown", button: 1 },
                            d = function (e, t) {
                                return function () {
                                    u.hide(e, t);
                                };
                            };
                        r < i;
                        r++
                    )
                        if (
                            ((n = e[r]),
                            (s = t.position || { x: n.clientWidth / 2, y: n.clientHeight / 2 }),
                            (o = h(n)),
                            (a.x = o.left + s.x),
                            (a.y = o.top + s.y),
                            (l.pageX = a.x),
                            (l.pageY = a.y),
                            u.show(l, n),
                            0 <= t.wait && null !== t.wait)
                        ) {
                            setTimeout(d({ type: "mouseup", button: 1 }, n), t.wait);
                        }
            }),
            (t.calm = function (e) {
                for (var t = { type: "mouseup", button: 1 }, i = 0, n = (e = c(e)).length; i < n; i++) u.hide(t, e[i]);
            }),
            (t.displayEffect = function (e) {
                console.error("Waves.displayEffect() has been deprecated and will be removed in future version. Please use Waves.init() to initialize Waves effect"), t.init(e);
            }),
            t
        );
    }),
    (function (e, t) {
        "function" == typeof define && define.amd
            ? define(["jquery"], function (e) {
                  return t(e);
              })
            : "object" == typeof module && module.exports
            ? (module.exports = t(require("jquery")))
            : t(e.jQuery);
    })(this, function (e) {
        !(function (T) {
            "use strict";
            var r, e, l, t, i, d, n;
            String.prototype.includes ||
                ((r = {}.toString),
                (e = (function () {
                    try {
                        var e = {},
                            t = Object.defineProperty,
                            i = t(e, e, e) && t;
                    } catch (e) {}
                    return i;
                })()),
                (l = "".indexOf),
                (t = function (e) {
                    if (null == this) throw new TypeError();
                    var t = String(this);
                    if (e && "[object RegExp]" == r.call(e)) throw new TypeError();
                    var i = t.length,
                        n = String(e),
                        s = n.length,
                        o = 1 < arguments.length ? arguments[1] : void 0,
                        a = o ? Number(o) : 0;
                    return a != a && (a = 0), !(i < s + Math.min(Math.max(a, 0), i)) && -1 != l.call(t, n, a);
                }),
                e ? e(String.prototype, "includes", { value: t, configurable: !0, writable: !0 }) : (String.prototype.includes = t)),
                String.prototype.startsWith ||
                    ((i = (function () {
                        try {
                            var e = {},
                                t = Object.defineProperty,
                                i = t(e, e, e) && t;
                        } catch (e) {}
                        return i;
                    })()),
                    (d = {}.toString),
                    (n = function (e) {
                        if (null == this) throw new TypeError();
                        var t = String(this);
                        if (e && "[object RegExp]" == d.call(e)) throw new TypeError();
                        var i = t.length,
                            n = String(e),
                            s = n.length,
                            o = 1 < arguments.length ? arguments[1] : void 0,
                            a = o ? Number(o) : 0;
                        a != a && (a = 0);
                        var r = Math.min(Math.max(a, 0), i);
                        if (i < s + r) return !1;
                        for (var l = -1; ++l < s; ) if (t.charCodeAt(r + l) != n.charCodeAt(l)) return !1;
                        return !0;
                    }),
                    i ? i(String.prototype, "startsWith", { value: n, configurable: !0, writable: !0 }) : (String.prototype.startsWith = n)),
                Object.keys ||
                    (Object.keys = function (e, t, i) {
                        for (t in ((i = []), e)) i.hasOwnProperty.call(e, t) && i.push(t);
                        return i;
                    });
            var s = { useDefault: !1, _set: T.valHooks.select.set };
            T.valHooks.select.set = function (e, t) {
                return t && !s.useDefault && T(e).data("selected", !0), s._set.apply(this, arguments);
            };
            var x = null,
                o = (function () {
                    try {
                        return new Event("change"), !0;
                    } catch (e) {
                        return !1;
                    }
                })();
            function a(e) {
                return (
                    T.each(
                        [
                            { re: /[\xC0-\xC6]/g, ch: "A" },
                            { re: /[\xE0-\xE6]/g, ch: "a" },
                            { re: /[\xC8-\xCB]/g, ch: "E" },
                            { re: /[\xE8-\xEB]/g, ch: "e" },
                            { re: /[\xCC-\xCF]/g, ch: "I" },
                            { re: /[\xEC-\xEF]/g, ch: "i" },
                            { re: /[\xD2-\xD6]/g, ch: "O" },
                            { re: /[\xF2-\xF6]/g, ch: "o" },
                            { re: /[\xD9-\xDC]/g, ch: "U" },
                            { re: /[\xF9-\xFC]/g, ch: "u" },
                            { re: /[\xC7-\xE7]/g, ch: "c" },
                            { re: /[\xD1]/g, ch: "N" },
                            { re: /[\xF1]/g, ch: "n" },
                        ],
                        function () {
                            e = e ? e.replace(this.re, this.ch) : "";
                        }
                    ),
                    e
                );
            }
            (T.fn.triggerNative = function (e) {
                var t,
                    i = this[0];
                i.dispatchEvent
                    ? (o ? (t = new Event(e, { bubbles: !0 })) : (t = document.createEvent("Event")).initEvent(e, !0, !1), i.dispatchEvent(t))
                    : i.fireEvent
                    ? (((t = document.createEventObject()).eventType = e), i.fireEvent("on" + e, t))
                    : this.trigger(e);
            }),
                (T.expr.pseudos.icontains = function (e, t, i) {
                    var n = T(e).find("a");
                    return (n.data("tokens") || n.text()).toString().toUpperCase().includes(i[3].toUpperCase());
                }),
                (T.expr.pseudos.ibegins = function (e, t, i) {
                    var n = T(e).find("a");
                    return (n.data("tokens") || n.text()).toString().toUpperCase().startsWith(i[3].toUpperCase());
                }),
                (T.expr.pseudos.aicontains = function (e, t, i) {
                    var n = T(e).find("a");
                    return (n.data("tokens") || n.data("normalizedText") || n.text()).toString().toUpperCase().includes(i[3].toUpperCase());
                }),
                (T.expr.pseudos.aibegins = function (e, t, i) {
                    var n = T(e).find("a");
                    return (n.data("tokens") || n.data("normalizedText") || n.text()).toString().toUpperCase().startsWith(i[3].toUpperCase());
                });
            var c = function (t) {
                    var i = function (e) {
                            return t[e];
                        },
                        e = "(?:" + Object.keys(t).join("|") + ")",
                        n = RegExp(e),
                        s = RegExp(e, "g");
                    return function (e) {
                        return (e = null == e ? "" : "" + e), n.test(e) ? e.replace(s, i) : e;
                    };
                },
                k = c({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#x27;", "`": "&#x60;" }),
                h = c({ "&amp;": "&", "&lt;": "<", "&gt;": ">", "&quot;": '"', "&#x27;": "'", "&#x60;": "`" }),
                p = function (e, t) {
                    s.useDefault || ((T.valHooks.select.set = s._set), (s.useDefault = !0)),
                        (this.$element = T(e)),
                        (this.$newElement = null),
                        (this.$button = null),
                        (this.$menu = null),
                        (this.$lis = null),
                        (this.options = t),
                        null === this.options.title && (this.options.title = this.$element.attr("title"));
                    var i = this.options.windowPadding;
                    "number" == typeof i && (this.options.windowPadding = [i, i, i, i]),
                        (this.val = p.prototype.val),
                        (this.render = p.prototype.render),
                        (this.refresh = p.prototype.refresh),
                        (this.setStyle = p.prototype.setStyle),
                        (this.selectAll = p.prototype.selectAll),
                        (this.deselectAll = p.prototype.deselectAll),
                        (this.destroy = p.prototype.destroy),
                        (this.remove = p.prototype.remove),
                        (this.show = p.prototype.show),
                        (this.hide = p.prototype.hide),
                        this.init();
                };
            /*function u(e) {
                var o,
                    a = arguments,
                    r = e;
                [].shift.apply(a);
                var t = this.each(function () {
                    var e = T(this);
                    if (e.is("select")) {
                        var t = e.data("selectpicker"),
                            i = "object" == typeof r && r;
                        if (t) {
                            if (i) for (var n in i) i.hasOwnProperty(n) && (t.options[n] = i[n]);
                        } else {
                            var s = T.extend({}, p.DEFAULTS, T.fn.selectpicker.defaults || {}, e.data(), i);
                            (s.template = T.extend({}, p.DEFAULTS.template, T.fn.selectpicker.defaults ? T.fn.selectpicker.defaults.template : {}, e.data().template, i.template)), e.data("selectpicker", (t = new p(this, s)));
                        }
                        "string" == typeof r && (o = t[r] instanceof Function ? t[r].apply(t, a) : t.options[r]);
                    }
                });
                return void 0 !== o ? o : t;
            }
            (p.VERSION = "1.12.4"),
                (p.DEFAULTS = {
                    noneSelectedText: "Nothing selected",
                    noneResultsText: "No results matched {0}",
                    countSelectedText: function (e, t) {
                        return 1 == e ? "{0} item selected" : "{0} items selected";
                    },
                    maxOptionsText: function (e, t) {
                        return [1 == e ? "Limit reached ({n} item max)" : "Limit reached ({n} items max)", 1 == t ? "Group limit reached ({n} item max)" : "Group limit reached ({n} items max)"];
                    },
                    selectAllText: "Select All",
                    deselectAllText: "Deselect All",
                    doneButton: !1,
                    doneButtonText: "Close",
                    multipleSeparator: ", ",
                    styleBase: "btn",
                    style: "btn-default",
                    size: "auto",
                    title: null,
                    selectedTextFormat: "values",
                    width: !1,
                    container: !1,
                    hideDisabled: !1,
                    showSubtext: !1,
                    showIcon: !0,
                    showContent: !0,
                    dropupAuto: !0,
                    header: !1,
                    liveSearch: !1,
                    liveSearchPlaceholder: null,
                    liveSearchNormalize: !1,
                    liveSearchStyle: "contains",
                    actionsBox: !1,
                    iconBase: "glyphicon",
                    tickIcon: "glyphicon-ok",
                    showTick: !1,
                    template: { caret: '<span class="caret"></span>' },
                    maxOptions: !1,
                    mobile: !1,
                    selectOnTab: !1,
                    dropdownAlignRight: !1,
                    windowPadding: 0,
                }),
                (p.prototype = {
                    constructor: p,
                    init: function () {
                        var t = this,
                            e = this.$element.attr("id");
                        this.$element.addClass("bs-select-hidden"),
                            (this.liObj = {}),
                            (this.multiple = this.$element.prop("multiple")),
                            (this.autofocus = this.$element.prop("autofocus")),
                            (this.$newElement = this.createView()),
                            this.$element.after(this.$newElement).appendTo(this.$newElement),
                            (this.$button = this.$newElement.children("button")),
                            (this.$menu = this.$newElement.children(".dropdown-menu")),
                            (this.$menuInner = this.$menu.children(".inner")),
                            (this.$searchbox = this.$menu.find("input")),
                            this.$element.removeClass("bs-select-hidden"),
                            !0 === this.options.dropdownAlignRight && this.$menu.addClass("dropdown-menu-right"),
                            void 0 !== e &&
                                (this.$button.attr("data-id", e),
                                T('label[for="' + e + '"]').click(function (e) {
                                    e.preventDefault(), t.$button.focus();
                                })),
                            this.checkDisabled(),
                            this.clickListener(),
                            this.options.liveSearch && this.liveSearchListener(),
                            this.render(),
                            this.setStyle(),
                            this.setWidth(),
                            this.options.container && this.selectPosition(),
                            this.$menu.data("this", this),
                            this.$newElement.data("this", this),
                            this.options.mobile && this.mobile(),
                            this.$newElement.on({
                                "hide.bs.dropdown": function (e) {
                                    t.$menuInner.attr("aria-expanded", !1), t.$element.trigger("hide.bs.select", e);
                                },
                                "hidden.bs.dropdown": function (e) {
                                    t.$element.trigger("hidden.bs.select", e);
                                },
                                "show.bs.dropdown": function (e) {
                                    t.$menuInner.attr("aria-expanded", !0), t.$element.trigger("show.bs.select", e);
                                },
                                "shown.bs.dropdown": function (e) {
                                    t.$element.trigger("shown.bs.select", e);
                                },
                            }),
                            t.$element[0].hasAttribute("required") &&
                                this.$element.on("invalid", function () {
                                    t.$button.addClass("bs-invalid"),
                                        t.$element.on({
                                            "focus.bs.select": function () {
                                                t.$button.focus(), t.$element.off("focus.bs.select");
                                            },
                                            "shown.bs.select": function () {
                                                t.$element.val(t.$element.val()).off("shown.bs.select");
                                            },
                                            "rendered.bs.select": function () {
                                                this.validity.valid && t.$button.removeClass("bs-invalid"), t.$element.off("rendered.bs.select");
                                            },
                                        }),
                                        t.$button.on("blur.bs.select", function () {
                                            t.$element.focus().blur(), t.$button.off("blur.bs.select");
                                        });
                                }),
                            setTimeout(function () {
                                t.$element.trigger("loaded.bs.select");
                            });
                    },
                    createDropdown: function () {
                        var e = this.multiple || this.options.showTick ? " show-tick" : "",
                            t = this.$element.parent().hasClass("input-group") ? " input-group-btn" : "",
                            i = this.autofocus ? " autofocus" : "",
                            n = this.options.header ? '<div class="popover-title"><button type="button" class="close" aria-hidden="true">&times;</button>' + this.options.header + "</div>" : "",
                            s = this.options.liveSearch
                                ? '<div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"' +
                                  (null === this.options.liveSearchPlaceholder ? "" : ' placeholder="' + k(this.options.liveSearchPlaceholder) + '"') +
                                  ' role="textbox" aria-label="Search"></div>'
                                : "",
                            o =
                                this.multiple && this.options.actionsBox
                                    ? '<div class="bs-actionsbox"><div class="btn-group btn-group-sm btn-block"><button type="button" class="actions-btn bs-select-all btn btn-default">' +
                                      this.options.selectAllText +
                                      '</button><button type="button" class="actions-btn bs-deselect-all btn btn-default">' +
                                      this.options.deselectAllText +
                                      "</button></div></div>"
                                    : "",
                            a =
                                this.multiple && this.options.doneButton
                                    ? '<div class="bs-donebutton"><div class="btn-group btn-block"><button type="button" class="btn btn-sm btn-default">' + this.options.doneButtonText + "</button></div></div>"
                                    : "",
                            r =
                                '<div class="btn-group bootstrap-select' +
                                e +
                                t +
                                '"><button type="button" class="' +
                                this.options.styleBase +
                                ' dropdown-toggle" data-toggle="dropdown"' +
                                i +
                                ' role="button"><span class="filter-option pull-left"></span>&nbsp;<span class="bs-caret">' +
                                this.options.template.caret +
                                '</span></button><div class="dropdown-menu open" role="combobox">' +
                                n +
                                s +
                                o +
                                '<ul class="dropdown-menu inner" role="listbox" aria-expanded="false"></ul>' +
                                a +
                                "</div></div>";
                        return T(r);
                    },
                    createView: function () {
                        var e = this.createDropdown(),
                            t = this.createLi();
                        return (e.find("ul")[0].innerHTML = t), e;
                    },
                    reloadLi: function () {
                        var e = this.createLi();
                        this.$menuInner[0].innerHTML = e;
                    },
                    createLi: function () {
                        var $ = this,
                            w = [],
                            x = 0,
                            e = document.createElement("option"),
                            y = -1,
                            C = function (e, t, i, n) {
                                return "<li" + (void 0 !== i && "" !== i ? ' class="' + i + '"' : "") + (null != t ? ' data-original-index="' + t + '"' : "") + (null != n ? 'data-optgroup="' + n + '"' : "") + ">" + e + "</li>";
                            },
                            S = function (e, t, i, n) {
                                return (
                                    '<a tabindex="0"' +
                                    (void 0 !== t ? ' class="' + t + '"' : "") +
                                    (i ? ' style="' + i + '"' : "") +
                                    ($.options.liveSearchNormalize ? ' data-normalized-text="' + a(k(T(e).html())) + '"' : "") +
                                    (void 0 !== n || null !== n ? ' data-tokens="' + n + '"' : "") +
                                    ' role="option">' +
                                    e +
                                    '<span class="' +
                                    $.options.iconBase +
                                    " " +
                                    $.options.tickIcon +
                                    ' check-mark"></span></a>'
                                );
                            };
                        if (this.options.title && !this.multiple && (y--, !this.$element.find(".bs-title-option").length)) {
                            var t = this.$element[0];
                            (e.className = "bs-title-option"),
                                (e.innerHTML = this.options.title),
                                (e.value = ""),
                                t.insertBefore(e, t.firstChild),
                                void 0 === T(t.options[t.selectedIndex]).attr("selected") && void 0 === this.$element.data("selected") && (e.selected = !0);
                        }
                        var E = this.$element.find("option");
                        return (
                            E.each(function (e) {
                                var t = T(this);
                                if ((y++, !t.hasClass("bs-title-option"))) {
                                    var i,
                                        n = this.className || "",
                                        s = k(this.style.cssText),
                                        o = t.data("content") ? t.data("content") : t.html(),
                                        a = t.data("tokens") ? t.data("tokens") : null,
                                        r = void 0 !== t.data("subtext") ? '<small class="text-muted">' + t.data("subtext") + "</small>" : "",
                                        l = void 0 !== t.data("icon") ? '<span class="' + $.options.iconBase + " " + t.data("icon") + '"></span> ' : "",
                                        d = t.parent(),
                                        c = "OPTGROUP" === d[0].tagName,
                                        h = c && d[0].disabled,
                                        p = this.disabled || h;
                                    if (("" !== l && p && (l = "<span>" + l + "</span>"), $.options.hideDisabled && ((p && !c) || h))) return (i = t.data("prevHiddenIndex")), t.next().data("prevHiddenIndex", void 0 !== i ? i : e), void y--;
                                    if ((t.data("content") || (o = l + '<span class="text">' + o + r + "</span>"), c && !0 !== t.data("divider"))) {
                                        if ($.options.hideDisabled && p) {
                                            if (void 0 === d.data("allOptionsDisabled")) {
                                                var u = d.children();
                                                d.data("allOptionsDisabled", u.filter(":disabled").length === u.length);
                                            }
                                            if (d.data("allOptionsDisabled")) return void y--;
                                        }
                                        var f = " " + d[0].className || "";
                                        if (0 === t.index()) {
                                            x += 1;
                                            var m = d[0].label,
                                                g = void 0 !== d.data("subtext") ? '<small class="text-muted">' + d.data("subtext") + "</small>" : "";
                                            (m = (d.data("icon") ? '<span class="' + $.options.iconBase + " " + d.data("icon") + '"></span> ' : "") + '<span class="text">' + k(m) + g + "</span>"),
                                                0 !== e && 0 < w.length && (y++, w.push(C("", null, "divider", x + "div"))),
                                                y++,
                                                w.push(C(m, null, "dropdown-header" + f, x));
                                        }
                                        if ($.options.hideDisabled && p) return void y--;
                                        w.push(C(S(o, "opt " + n + f, s, a), e, "", x));
                                    } else if (!0 === t.data("divider")) w.push(C("", e, "divider"));
                                    else if (!0 === t.data("hidden")) (i = t.data("prevHiddenIndex")), t.next().data("prevHiddenIndex", void 0 !== i ? i : e), w.push(C(S(o, n, s, a), e, "hidden is-hidden"));
                                    else {
                                        var v = this.previousElementSibling && "OPTGROUP" === this.previousElementSibling.tagName;
                                        if (!v && $.options.hideDisabled && void 0 !== (i = t.data("prevHiddenIndex"))) {
                                            var b = E.eq(i)[0].previousElementSibling;
                                            b && "OPTGROUP" === b.tagName && !b.disabled && (v = !0);
                                        }
                                        v && (y++, w.push(C("", null, "divider", x + "div"))), w.push(C(S(o, n, s, a), e));
                                    }
                                    $.liObj[e] = y;
                                }
                            }),
                            this.multiple || 0 !== this.$element.find("option:selected").length || this.options.title || this.$element.find("option").eq(0).prop("selected", !0).attr("selected", "selected"),
                            w.join("")
                        );
                    },
                    findLis: function () {
                        return null == this.$lis && (this.$lis = this.$menu.find("li")), this.$lis;
                    },
                    render: function (e) {
                        var t,
                            n = this,
                            i = this.$element.find("option");
                        !1 !== e &&
                            i.each(function (e) {
                                var t = n.findLis().eq(n.liObj[e]);
                                n.setDisabled(e, this.disabled || ("OPTGROUP" === this.parentNode.tagName && this.parentNode.disabled), t), n.setSelected(e, this.selected, t);
                            }),
                            this.togglePlaceholder(),
                            this.tabIndex();
                        var s = i
                                .map(function () {
                                    if (this.selected) {
                                        if (n.options.hideDisabled && (this.disabled || ("OPTGROUP" === this.parentNode.tagName && this.parentNode.disabled))) return;
                                        var e,
                                            t = T(this),
                                            i = t.data("icon") && n.options.showIcon ? '<i class="' + n.options.iconBase + " " + t.data("icon") + '"></i> ' : "";
                                        return (
                                            (e = n.options.showSubtext && t.data("subtext") && !n.multiple ? ' <small class="text-muted">' + t.data("subtext") + "</small>" : ""),
                                            void 0 !== t.attr("title") ? t.attr("title") : t.data("content") && n.options.showContent ? t.data("content").toString() : i + t.html() + e
                                        );
                                    }
                                })
                                .toArray(),
                            o = this.multiple ? s.join(this.options.multipleSeparator) : s[0];
                        if (this.multiple && -1 < this.options.selectedTextFormat.indexOf("count")) {
                            var a = this.options.selectedTextFormat.split(">");
                            if ((1 < a.length && s.length > a[1]) || (1 == a.length && 2 <= s.length)) {
                                t = this.options.hideDisabled ? ", [disabled]" : "";
                                var r = i.not('[data-divider="true"], [data-hidden="true"]' + t).length;
                                o = ("function" == typeof this.options.countSelectedText ? this.options.countSelectedText(s.length, r) : this.options.countSelectedText).replace("{0}", s.length.toString()).replace("{1}", r.toString());
                            }
                        }
                        null == this.options.title && (this.options.title = this.$element.attr("title")),
                            "static" == this.options.selectedTextFormat && (o = this.options.title),
                            o || (o = void 0 !== this.options.title ? this.options.title : this.options.noneSelectedText),
                            this.$button.attr("title", h(T.trim(o.replace(/<[^>]*>?/g, "")))),
                            this.$button.children(".filter-option").html(o),
                            this.$element.trigger("rendered.bs.select");
                    },
                    setStyle: function (e, t) {
                        this.$element.attr("class") && this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device|bs-select-hidden|validate\[.*\]/gi, ""));
                        var i = e || this.options.style;
                        "add" == t ? this.$button.addClass(i) : "remove" == t ? this.$button.removeClass(i) : (this.$button.removeClass(this.options.style), this.$button.addClass(i));
                    },
                    liHeight: function (e) {
                        if (e || (!1 !== this.options.size && !this.sizeInfo)) {
                            var t = document.createElement("div"),
                                i = document.createElement("div"),
                                n = document.createElement("ul"),
                                s = document.createElement("li"),
                                o = document.createElement("li"),
                                a = document.createElement("a"),
                                r = document.createElement("span"),
                                l = this.options.header && 0 < this.$menu.find(".popover-title").length ? this.$menu.find(".popover-title")[0].cloneNode(!0) : null,
                                d = this.options.liveSearch ? document.createElement("div") : null,
                                c = this.options.actionsBox && this.multiple && 0 < this.$menu.find(".bs-actionsbox").length ? this.$menu.find(".bs-actionsbox")[0].cloneNode(!0) : null,
                                h = this.options.doneButton && this.multiple && 0 < this.$menu.find(".bs-donebutton").length ? this.$menu.find(".bs-donebutton")[0].cloneNode(!0) : null;
                            if (
                                ((r.className = "text"),
                                (t.className = this.$menu[0].parentNode.className + " open"),
                                (i.className = "dropdown-menu open"),
                                (n.className = "dropdown-menu inner"),
                                (s.className = "divider"),
                                r.appendChild(document.createTextNode("Inner text")),
                                a.appendChild(r),
                                o.appendChild(a),
                                n.appendChild(o),
                                n.appendChild(s),
                                l && i.appendChild(l),
                                d)
                            ) {
                                var p = document.createElement("input");
                                (d.className = "bs-searchbox"), (p.className = "form-control"), d.appendChild(p), i.appendChild(d);
                            }
                            c && i.appendChild(c), i.appendChild(n), h && i.appendChild(h), t.appendChild(i), document.body.appendChild(t);
                            var u = a.offsetHeight,
                                f = l ? l.offsetHeight : 0,
                                m = d ? d.offsetHeight : 0,
                                g = c ? c.offsetHeight : 0,
                                v = h ? h.offsetHeight : 0,
                                b = T(s).outerHeight(!0),
                                $ = "function" == typeof getComputedStyle && getComputedStyle(i),
                                w = $ ? null : T(i),
                                x = {
                                    vert:
                                        parseInt($ ? $.paddingTop : w.css("paddingTop")) +
                                        parseInt($ ? $.paddingBottom : w.css("paddingBottom")) +
                                        parseInt($ ? $.borderTopWidth : w.css("borderTopWidth")) +
                                        parseInt($ ? $.borderBottomWidth : w.css("borderBottomWidth")),
                                    horiz:
                                        parseInt($ ? $.paddingLeft : w.css("paddingLeft")) +
                                        parseInt($ ? $.paddingRight : w.css("paddingRight")) +
                                        parseInt($ ? $.borderLeftWidth : w.css("borderLeftWidth")) +
                                        parseInt($ ? $.borderRightWidth : w.css("borderRightWidth")),
                                },
                                y = {
                                    vert: x.vert + parseInt($ ? $.marginTop : w.css("marginTop")) + parseInt($ ? $.marginBottom : w.css("marginBottom")) + 2,
                                    horiz: x.horiz + parseInt($ ? $.marginLeft : w.css("marginLeft")) + parseInt($ ? $.marginRight : w.css("marginRight")) + 2,
                                };
                            document.body.removeChild(t), (this.sizeInfo = { liHeight: u, headerHeight: f, searchHeight: m, actionsHeight: g, doneButtonHeight: v, dividerHeight: b, menuPadding: x, menuExtras: y });
                        }
                    },
                    setSize: function () {
                        if ((this.findLis(), this.liHeight(), this.options.header && this.$menu.css("padding-top", 0), !1 !== this.options.size)) {
                            var o,
                                a,
                                r,
                                l,
                                d,
                                c,
                                h,
                                p,
                                u = this,
                                f = this.$menu,
                                m = this.$menuInner,
                                s = T(window),
                                g = this.$newElement[0].offsetHeight,
                                v = this.$newElement[0].offsetWidth,
                                b = this.sizeInfo.liHeight,
                                $ = this.sizeInfo.headerHeight,
                                w = this.sizeInfo.searchHeight,
                                x = this.sizeInfo.actionsHeight,
                                y = this.sizeInfo.doneButtonHeight,
                                e = this.sizeInfo.dividerHeight,
                                C = this.sizeInfo.menuPadding,
                                S = this.sizeInfo.menuExtras,
                                t = this.options.hideDisabled ? ".disabled" : "",
                                E = function () {
                                    var e,
                                        t = u.$newElement.offset(),
                                        i = T(u.options.container);
                                    u.options.container && !i.is("body") ? (((e = i.offset()).top += parseInt(i.css("borderTopWidth"))), (e.left += parseInt(i.css("borderLeftWidth")))) : (e = { top: 0, left: 0 });
                                    var n = u.options.windowPadding;
                                    (d = t.top - e.top - s.scrollTop()), (c = s.height() - d - g - e.top - n[2]), (h = t.left - e.left - s.scrollLeft()), (p = s.width() - h - v - e.left - n[1]), (d -= n[0]), (h -= n[3]);
                                };
                            if ((E(), "auto" === this.options.size)) {
                                var i = function () {
                                    var e,
                                        t = function (t, i) {
                                            return function (e) {
                                                return i ? (e.classList ? e.classList.contains(t) : T(e).hasClass(t)) : !(e.classList ? e.classList.contains(t) : T(e).hasClass(t));
                                            };
                                        },
                                        i = u.$menuInner[0].getElementsByTagName("li"),
                                        n = Array.prototype.filter ? Array.prototype.filter.call(i, t("hidden", !1)) : u.$lis.not(".hidden"),
                                        s = Array.prototype.filter ? Array.prototype.filter.call(n, t("dropdown-header", !0)) : n.filter(".dropdown-header");
                                    E(),
                                        (o = c - S.vert),
                                        (a = p - S.horiz),
                                        (l = u.options.container ? (f.data("height") || f.data("height", f.height()), (r = f.data("height")), f.data("width") || f.data("width", f.width()), f.data("width")) : ((r = f.height()), f.width())),
                                        u.options.dropupAuto && u.$newElement.toggleClass("dropup", c < d && o - S.vert < r),
                                        u.$newElement.hasClass("dropup") && (o = d - S.vert),
                                        "auto" === u.options.dropdownAlignRight && f.toggleClass("dropdown-menu-right", p < h && a - S.horiz < l - v),
                                        (e = 3 < n.length + s.length ? 3 * b + S.vert - 2 : 0),
                                        f.css({ "max-height": o + "px", overflow: "hidden", "min-height": e + $ + w + x + y + "px" }),
                                        m.css({ "max-height": o - $ - w - x - y - C.vert + "px", "overflow-y": "auto", "min-height": Math.max(e - C.vert, 0) + "px" });
                                };
                                i(), this.$searchbox.off("input.getSize propertychange.getSize").on("input.getSize propertychange.getSize", i), s.off("resize.getSize scroll.getSize").on("resize.getSize scroll.getSize", i);
                            } else if (this.options.size && "auto" != this.options.size && this.$lis.not(t).length > this.options.size) {
                                var n = this.$lis.not(".divider").not(t).children().slice(0, this.options.size).last().parent().index(),
                                    k = this.$lis.slice(0, n + 1).filter(".divider").length;
                                (o = b * this.options.size + k * e + C.vert),
                                    (r = u.options.container ? (f.data("height") || f.data("height", f.height()), f.data("height")) : f.height()),
                                    u.options.dropupAuto && this.$newElement.toggleClass("dropup", c < d && o - S.vert < r),
                                    f.css({ "max-height": o + $ + w + x + y + "px", overflow: "hidden", "min-height": "" }),
                                    m.css({ "max-height": o - C.vert + "px", "overflow-y": "auto", "min-height": "" });
                            }
                        }
                    },
                    setWidth: function () {
                        if ("auto" === this.options.width) {
                            this.$menu.css("min-width", "0");
                            var e = this.$menu.parent().clone().appendTo("body"),
                                t = this.options.container ? this.$newElement.clone().appendTo("body") : e,
                                i = e.children(".dropdown-menu").outerWidth(),
                                n = t.css("width", "auto").children("button").outerWidth();
                            e.remove(), t.remove(), this.$newElement.css("width", Math.max(i, n) + "px");
                        } else
                            "fit" === this.options.width
                                ? (this.$menu.css("min-width", ""), this.$newElement.css("width", "").addClass("fit-width"))
                                : this.options.width
                                ? (this.$menu.css("min-width", ""), this.$newElement.css("width", this.options.width))
                                : (this.$menu.css("min-width", ""), this.$newElement.css("width", ""));
                        this.$newElement.hasClass("fit-width") && "fit" !== this.options.width && this.$newElement.removeClass("fit-width");
                    },
                    selectPosition: function () {
                        this.$bsContainer = T('<div class="bs-container" />');
                        var t,
                            i,
                            n,
                            s = this,
                            o = T(this.options.container),
                            a = function (e) {
                                s.$bsContainer.addClass(e.attr("class").replace(/form-control|fit-width/gi, "")).toggleClass("dropup", e.hasClass("dropup")),
                                    (t = e.offset()),
                                    o.is("body") ? (i = { top: 0, left: 0 }) : (((i = o.offset()).top += parseInt(o.css("borderTopWidth")) - o.scrollTop()), (i.left += parseInt(o.css("borderLeftWidth")) - o.scrollLeft())),
                                    (n = e.hasClass("dropup") ? 0 : e[0].offsetHeight),
                                    s.$bsContainer.css({ top: t.top - i.top + n, left: t.left - i.left, width: e[0].offsetWidth });
                            };
                        this.$button.on("click", function () {
                            var e = T(this);
                            s.isDisabled() || (a(s.$newElement), s.$bsContainer.appendTo(s.options.container).toggleClass("open", !e.hasClass("open")).append(s.$menu));
                        }),
                            T(window).on("resize scroll", function () {
                                a(s.$newElement);
                            }),
                            this.$element.on("hide.bs.select", function () {
                                s.$menu.data("height", s.$menu.height()), s.$bsContainer.detach();
                            });
                    },
                    setSelected: function (e, t, i) {
                        i || (this.togglePlaceholder(), (i = this.findLis().eq(this.liObj[e]))), i.toggleClass("selected", t).find("a").attr("aria-selected", t);
                    },
                    setDisabled: function (e, t, i) {
                        i || (i = this.findLis().eq(this.liObj[e])),
                            t
                                ? i.addClass("disabled").children("a").attr("href", "#").attr("tabindex", -1).attr("aria-disabled", !0)
                                : i.removeClass("disabled").children("a").removeAttr("href").attr("tabindex", 0).attr("aria-disabled", !1);
                    },
                    isDisabled: function () {
                        return this.$element[0].disabled;
                    },
                    checkDisabled: function () {
                        var e = this;
                        this.isDisabled()
                            ? (this.$newElement.addClass("disabled"), this.$button.addClass("disabled").attr("tabindex", -1).attr("aria-disabled", !0))
                            : (this.$button.hasClass("disabled") && (this.$newElement.removeClass("disabled"), this.$button.removeClass("disabled").attr("aria-disabled", !1)),
                              -1 != this.$button.attr("tabindex") || this.$element.data("tabindex") || this.$button.removeAttr("tabindex")),
                            this.$button.click(function () {
                                return !e.isDisabled();
                            });
                    },
                    togglePlaceholder: function () {
                        var e = this.$element.val();
                        this.$button.toggleClass("bs-placeholder", null === e || "" === e || (e.constructor === Array && 0 === e.length));
                    },
                    tabIndex: function () {
                        this.$element.data("tabindex") !== this.$element.attr("tabindex") &&
                            -98 !== this.$element.attr("tabindex") &&
                            "-98" !== this.$element.attr("tabindex") &&
                            (this.$element.data("tabindex", this.$element.attr("tabindex")), this.$button.attr("tabindex", this.$element.data("tabindex"))),
                            this.$element.attr("tabindex", -98);
                    },
                    clickListener: function () {
                        var w = this,
                            t = T(document);
                        t.data("spaceSelect", !1),
                            this.$button.on("keyup", function (e) {
                                /(32)/.test(e.keyCode.toString(10)) && t.data("spaceSelect") && (e.preventDefault(), t.data("spaceSelect", !1));
                            }),
                            this.$button.on("click", function () {
                                w.setSize();
                            }),
                            this.$element.on("shown.bs.select", function () {
                                if (w.options.liveSearch || w.multiple) {
                                    if (!w.multiple) {
                                        var e = w.liObj[w.$element[0].selectedIndex];
                                        if ("number" != typeof e || !1 === w.options.size) return;
                                        var t = w.$lis.eq(e)[0].offsetTop - w.$menuInner[0].offsetTop;
                                        (t = t - w.$menuInner[0].offsetHeight / 2 + w.sizeInfo.liHeight / 2), (w.$menuInner[0].scrollTop = t);
                                    }
                                } else w.$menuInner.find(".selected a").focus();
                            }),
                            this.$menuInner.on("click", "li a", function (e) {
                                var t = T(this),
                                    i = t.parent().data("originalIndex"),
                                    n = w.$element.val(),
                                    s = w.$element.prop("selectedIndex"),
                                    o = !0;
                                if ((w.multiple && 1 !== w.options.maxOptions && e.stopPropagation(), e.preventDefault(), !w.isDisabled() && !t.parent().hasClass("disabled"))) {
                                    var a = w.$element.find("option"),
                                        r = a.eq(i),
                                        l = r.prop("selected"),
                                        d = r.parent("optgroup"),
                                        c = w.options.maxOptions,
                                        h = d.data("maxOptions") || !1;
                                    if (w.multiple) {
                                        if ((r.prop("selected", !l), w.setSelected(i, !l), t.blur(), !1 !== c || !1 !== h)) {
                                            var p = c < a.filter(":selected").length,
                                                u = h < d.find("option:selected").length;
                                            if ((c && p) || (h && u))
                                                if (c && 1 == c) a.prop("selected", !1), r.prop("selected", !0), w.$menuInner.find(".selected").removeClass("selected"), w.setSelected(i, !0);
                                                else if (h && 1 == h) {
                                                    d.find("option:selected").prop("selected", !1), r.prop("selected", !0);
                                                    var f = t.parent().data("optgroup");
                                                    w.$menuInner.find('[data-optgroup="' + f + '"]').removeClass("selected"), w.setSelected(i, !0);
                                                } else {
                                                    var m = "string" == typeof w.options.maxOptionsText ? [w.options.maxOptionsText, w.options.maxOptionsText] : w.options.maxOptionsText,
                                                        g = "function" == typeof m ? m(c, h) : m,
                                                        v = g[0].replace("{n}", c),
                                                        b = g[1].replace("{n}", h),
                                                        $ = T('<div class="notify"></div>');
                                                    g[2] && ((v = v.replace("{var}", g[2][1 < c ? 0 : 1])), (b = b.replace("{var}", g[2][1 < h ? 0 : 1]))),
                                                        r.prop("selected", !1),
                                                        w.$menu.append($),
                                                        c && p && ($.append(T("<div>" + v + "</div>")), (o = !1), w.$element.trigger("maxReached.bs.select")),
                                                        h && u && ($.append(T("<div>" + b + "</div>")), (o = !1), w.$element.trigger("maxReachedGrp.bs.select")),
                                                        setTimeout(function () {
                                                            w.setSelected(i, !1);
                                                        }, 10),
                                                        $.delay(750).fadeOut(300, function () {
                                                            T(this).remove();
                                                        });
                                                }
                                        }
                                    } else a.prop("selected", !1), r.prop("selected", !0), w.$menuInner.find(".selected").removeClass("selected").find("a").attr("aria-selected", !1), w.setSelected(i, !0);
                                    !w.multiple || (w.multiple && 1 === w.options.maxOptions) ? w.$button.focus() : w.options.liveSearch && w.$searchbox.focus(),
                                        o && ((n != w.$element.val() && w.multiple) || (s != w.$element.prop("selectedIndex") && !w.multiple)) && ((x = [i, r.prop("selected"), l]), w.$element.triggerNative("change"));
                                }
                            }),
                            this.$menu.on("click", "li.disabled a, .popover-title, .popover-title :not(.close)", function (e) {
                                e.currentTarget == this && (e.preventDefault(), e.stopPropagation(), w.options.liveSearch && !T(e.target).hasClass("close") ? w.$searchbox.focus() : w.$button.focus());
                            }),
                            this.$menuInner.on("click", ".divider, .dropdown-header", function (e) {
                                e.preventDefault(), e.stopPropagation(), w.options.liveSearch ? w.$searchbox.focus() : w.$button.focus();
                            }),
                            this.$menu.on("click", ".popover-title .close", function () {
                                w.$button.click();
                            }),
                            this.$searchbox.on("click", function (e) {
                                e.stopPropagation();
                            }),
                            this.$menu.on("click", ".actions-btn", function (e) {
                                w.options.liveSearch ? w.$searchbox.focus() : w.$button.focus(), e.preventDefault(), e.stopPropagation(), T(this).hasClass("bs-select-all") ? w.selectAll() : w.deselectAll();
                            }),
                            this.$element.change(function () {
                                w.render(!1), w.$element.trigger("changed.bs.select", x), (x = null);
                            });
                    },
                    liveSearchListener: function () {
                        var s = this,
                            o = T('<li class="no-results"></li>');
                        this.$button.on("click.dropdown.data-api", function () {
                            s.$menuInner.find(".active").removeClass("active"),
                                s.$searchbox.val() && (s.$searchbox.val(""), s.$lis.not(".is-hidden").removeClass("hidden"), o.parent().length && o.remove()),
                                s.multiple || s.$menuInner.find(".selected").addClass("active"),
                                setTimeout(function () {
                                    s.$searchbox.focus();
                                }, 10);
                        }),
                            this.$searchbox.on("click.dropdown.data-api focus.dropdown.data-api touchend.dropdown.data-api", function (e) {
                                e.stopPropagation();
                            }),
                            this.$searchbox.on("input propertychange", function () {
                                if ((s.$lis.not(".is-hidden").removeClass("hidden"), s.$lis.filter(".active").removeClass("active"), o.remove(), s.$searchbox.val())) {
                                    var e,
                                        t = s.$lis.not(".is-hidden, .divider, .dropdown-header");
                                    if ((e = s.options.liveSearchNormalize ? t.not(":a" + s._searchStyle() + '("' + a(s.$searchbox.val()) + '")') : t.not(":" + s._searchStyle() + '("' + s.$searchbox.val() + '")')).length === t.length)
                                        o.html(s.options.noneResultsText.replace("{0}", '"' + k(s.$searchbox.val()) + '"')), s.$menuInner.append(o), s.$lis.addClass("hidden");
                                    else {
                                        e.addClass("hidden");
                                        var i,
                                            n = s.$lis.not(".hidden");
                                        n.each(function (e) {
                                            var t = T(this);
                                            t.hasClass("divider")
                                                ? void 0 === i
                                                    ? t.addClass("hidden")
                                                    : (i && i.addClass("hidden"), (i = t))
                                                : t.hasClass("dropdown-header") && n.eq(e + 1).data("optgroup") !== t.data("optgroup")
                                                ? t.addClass("hidden")
                                                : (i = null);
                                        }),
                                            i && i.addClass("hidden"),
                                            t.not(".hidden").first().addClass("active"),
                                            s.$menuInner.scrollTop(0);
                                    }
                                }
                            });
                    },
                    _searchStyle: function () {
                        return { begins: "ibegins", startsWith: "ibegins" }[this.options.liveSearchStyle] || "icontains";
                    },
                    val: function (e) {
                        return void 0 !== e ? (this.$element.val(e), this.render(), this.$element) : this.$element.val();
                    },
                    changeAll: function (e) {
                        if (this.multiple) {
                            void 0 === e && (e = !0), this.findLis();
                            var t = this.$element.find("option"),
                                i = this.$lis.not(".divider, .dropdown-header, .disabled, .hidden"),
                                n = i.length,
                                s = [];
                            if (e) {
                                if (i.filter(".selected").length === i.length) return;
                            } else if (0 === i.filter(".selected").length) return;
                            i.toggleClass("selected", e);
                            for (var o = 0; o < n; o++) {
                                var a = i[o].getAttribute("data-original-index");
                                s[s.length] = t.eq(a)[0];
                            }
                            T(s).prop("selected", e), this.render(!1), this.togglePlaceholder(), this.$element.triggerNative("change");
                        }
                    },
                    selectAll: function () {
                        return this.changeAll(!0);
                    },
                    deselectAll: function () {
                        return this.changeAll(!1);
                    },
                    toggle: function (e) {
                        (e = e || window.event) && e.stopPropagation(), this.$button.trigger("click");
                    },
                    keydown: function (t) {
                        var e,
                            i,
                            n,
                            s,
                            o = T(this),
                            a = (o.is("input") ? o.parent().parent() : o.parent()).data("this"),
                            r = ":not(.disabled, .hidden, .dropdown-header, .divider)",
                            l = {
                                32: " ",
                                48: "0",
                                49: "1",
                                50: "2",
                                51: "3",
                                52: "4",
                                53: "5",
                                54: "6",
                                55: "7",
                                56: "8",
                                57: "9",
                                59: ";",
                                65: "a",
                                66: "b",
                                67: "c",
                                68: "d",
                                69: "e",
                                70: "f",
                                71: "g",
                                72: "h",
                                73: "i",
                                74: "j",
                                75: "k",
                                76: "l",
                                77: "m",
                                78: "n",
                                79: "o",
                                80: "p",
                                81: "q",
                                82: "r",
                                83: "s",
                                84: "t",
                                85: "u",
                                86: "v",
                                87: "w",
                                88: "x",
                                89: "y",
                                90: "z",
                                96: "0",
                                97: "1",
                                98: "2",
                                99: "3",
                                100: "4",
                                101: "5",
                                102: "6",
                                103: "7",
                                104: "8",
                                105: "9",
                            };
                        if (!(s = a.$newElement.hasClass("open")) && ((48 <= t.keyCode && t.keyCode <= 57) || (96 <= t.keyCode && t.keyCode <= 105) || (65 <= t.keyCode && t.keyCode <= 90)))
                            return a.options.container ? a.$button.trigger("click") : (a.setSize(), a.$menu.parent().addClass("open"), (s = !0)), void a.$searchbox.focus();
                        if ((a.options.liveSearch && /(^9$|27)/.test(t.keyCode.toString(10)) && s && (t.preventDefault(), t.stopPropagation(), a.$menuInner.click(), a.$button.focus()), /(38|40)/.test(t.keyCode.toString(10)))) {
                            if (!(e = a.$lis.filter(r)).length) return;
                            (i = a.options.liveSearch ? e.index(e.filter(".active")) : e.index(e.find("a").filter(":focus").parent())),
                                (n = a.$menuInner.data("prevIndex")),
                                38 == t.keyCode ? ((!a.options.liveSearch && i != n) || -1 == i || i--, i < 0 && (i += e.length)) : 40 == t.keyCode && ((a.options.liveSearch || i == n) && i++, (i %= e.length)),
                                a.$menuInner.data("prevIndex", i),
                                a.options.liveSearch ? (t.preventDefault(), o.hasClass("dropdown-toggle") || (e.removeClass("active").eq(i).addClass("active").children("a").focus(), o.focus())) : e.eq(i).children("a").focus();
                        } else if (!o.is("input")) {
                            var d,
                                c = [];
                            (e = a.$lis.filter(r)).each(function (e) {
                                T.trim(T(this).children("a").text().toLowerCase()).substring(0, 1) == l[t.keyCode] && c.push(e);
                            }),
                                (d = T(document).data("keycount")),
                                d++,
                                T(document).data("keycount", d),
                                T.trim(T(":focus").text().toLowerCase()).substring(0, 1) != l[t.keyCode] ? ((d = 1), T(document).data("keycount", d)) : d >= c.length && (T(document).data("keycount", 0), d > c.length && (d = 1)),
                                e
                                    .eq(c[d - 1])
                                    .children("a")
                                    .focus();
                        }
                        if ((/(13|32)/.test(t.keyCode.toString(10)) || (/(^9$)/.test(t.keyCode.toString(10)) && a.options.selectOnTab)) && s) {
                            if ((/(32)/.test(t.keyCode.toString(10)) || t.preventDefault(), a.options.liveSearch)) /(32)/.test(t.keyCode.toString(10)) || (a.$menuInner.find(".active a").click(), o.focus());
                            else {
                                var h = T(":focus");
                                h.click(), h.focus(), t.preventDefault(), T(document).data("spaceSelect", !0);
                            }
                            T(document).data("keycount", 0);
                        }
                        ((/(^9$|27)/.test(t.keyCode.toString(10)) && s && (a.multiple || a.options.liveSearch)) || (/(27)/.test(t.keyCode.toString(10)) && !s)) &&
                            (a.$menu.parent().removeClass("open"), a.options.container && a.$newElement.removeClass("open"), a.$button.focus());
                    },
                    mobile: function () {
                        this.$element.addClass("mobile-device");
                    },
                    refresh: function () {
                        (this.$lis = null),
                            (this.liObj = {}),
                            this.reloadLi(),
                            this.render(),
                            this.checkDisabled(),
                            this.liHeight(!0),
                            this.setStyle(),
                            this.setWidth(),
                            this.$lis && this.$searchbox.trigger("propertychange"),
                            this.$element.trigger("refreshed.bs.select");
                    },
                    hide: function () {
                        this.$newElement.hide();
                    },
                    show: function () {
                        this.$newElement.show();
                    },
                    remove: function () {
                        this.$newElement.remove(), this.$element.remove();
                    },
                    destroy: function () {
                        this.$newElement.before(this.$element).remove(),
                            this.$bsContainer ? this.$bsContainer.remove() : this.$menu.remove(),
                            this.$element.off(".bs.select").removeData("selectpicker").removeClass("bs-select-hidden selectpicker");
                    },
                });
            var f = T.fn.selectpicker;
            (T.fn.selectpicker = u),
                (T.fn.selectpicker.Constructor = p),
                (T.fn.selectpicker.noConflict = function () {
                    return (T.fn.selectpicker = f), this;
                }),
                T(document)
                    .data("keycount", 0)
                    .on("keydown.bs.select", '.bootstrap-select [data-toggle=dropdown], .bootstrap-select [role="listbox"], .bs-searchbox input', p.prototype.keydown)
                    .on("focusin.modal", '.bootstrap-select [data-toggle=dropdown], .bootstrap-select [role="listbox"], .bs-searchbox input', function (e) {
                        e.stopPropagation();
                    }),
                T(window).on("load.bs.select.data-api", function () {
                    T(".selectpicker").each(function () {
                        var e = T(this);
                        u.call(e, e.data());
                    });
                });*/
        })(e);
    });
