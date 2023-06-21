
$(document).ready(function() {
    "use strict";
    /* ============ Grid/List ============ */
    $('#grid-view').on('click', function (e) {
        $(this).addClass('active');
        $('#list-view').removeClass('active');
        $('.grid-content').removeClass('d-none');
        $('.list-content').addClass('d-none');
    });
    $('#list-view').on('click', function (e) {
        $(this).addClass('active');
        $('#grid-view').removeClass('active');
        $('.list-content').removeClass('d-none');
        $('.grid-content').addClass('d-none');
    });
    
    /* ============ Popover ============ */
    if ($(".inline_userpopover").length > 0) {
      $('.inline_userpopover').webuiPopover({
          trigger:'hover',
          placement:'auto',
          content:function(){
              return $('#user_popover').html();
          },
          width:'240',
          arrow:true,
          padding:false,
          backdrop:false,
          type:'html',
      });
    }
    if ($(".open_userslist_popover").length > 0) {
        $('.open_userslist_popover').webuiPopover({
            trigger: 'hover',
            placement: 'auto',
            content: function() {
                return $('#userslist_popover').html();
            },
            width: '240',
            arrow: true,
            padding: false,
            backdrop: false,
            type: 'html'
        });
    }
    /* ============ Project Infos Popover ============ */
    if ($(".inline_projectpopover").length > 0) {
        $('.inline_projectpopover').webuiPopover({
            trigger: 'hover',
            placement: 'auto',
            content: function () {
                return $('#project_popover').html();
            },
            width: '240',
            arrow: true,
            padding: false,
            backdrop: false,
            type: 'html',
        });
    }

    /* ============ Project Infos Popover ============ */
    if ($(".open_projectslist_popover").length > 0) {
        $('.open_projectslist_popover').webuiPopover({
            trigger: 'hover',
            placement: 'auto',
            content: function () {
                return $('#projectslist_popover').html();
            },
            width: '240',
            arrow: true,
            padding: false,
            backdrop: false,
            type: 'html',

            onShow: function ($element) {
                $('.popover-slimscroll').slimScroll({
                    height: "auto"
                });
            }
        });
    }

    /* ============ Calendar item preview Popover ============ */
    if ($(".show_preview_popover").length > 0) {
      $('.show_preview_popover').webuiPopover({
          trigger:'click',
          placement:'auto',
          content:function(){
              return $('#show_preview_popover').html();
          },
          width:'280',
          height: 'auto',
          arrow:true,
          padding:false,
          backdrop:false,
          type:'html',
      });
    }


    /* ============ Calendar absence preview Popover ============ */
    if ($(".show_absence_popover").length > 0) {
      $('.show_absence_popover').webuiPopover({
          trigger:'click',
          placement:'auto',
          content:function(){
              return $('#show_absence_popover').html();
          },
          width:'280',
          height: 'auto',
          arrow:true,
          padding:false,
          backdrop:false,
          type:'html',
      });
    }


    /* ============ Calendar absence preview Popover ============ */
    if ($(".create_entry_popover").length > 0) {
      $('.create_entry_popover').webuiPopover({
          trigger:'click',
          placement:'right',
          content:function(){
              return $('#create_entry_popover').html();
          },
          width:'280',
          height: 'auto',
          arrow:true,
          padding:false,
          backdrop:false,
          type:'html',
      });
    }

    

    /* ============ label_popover ============ */
    if ($(".inline_entrypopover").length > 0) {
        $('.inline_entrypopover').webuiPopover({
            trigger: 'click',
            placement: 'auto',
            content: function () {
                return $('#label_popover').html();
            },
            width: '290',
            arrow: true,
            padding: false,
            backdrop: false,
            type: 'html',
        });
    }

  $('#go-step2').on('click', function() {
    $('.inline_entrypopover').webuiPopover('destroy');
    $('.inline_entrypopover').webuiPopover({
        placement: 'auto',
        content: function(){ $('#label_popover_2').html();
        },
            width: '290',
            arrow: true,
            padding: false,
            backdrop: false,
            type: 'html',
    })
  });
  $('#go-back').on('click', function() {
      $('.inline_entrypopover').webuiPopover('destroy');
    $('.inline_entrypopover').webuiPopover({
        placement: 'auto',
        content: function(){ $('#label_popover').html();
        },
            width: '290',
            arrow: true,
            padding: false,
            backdrop: false,
            type: 'html',
    })
  });
});

(function(D) {
    D.fn.extend({
        slimScroll: function(S) {
            var A = D.extend({
                width: "auto",
                height: "250px",
                size: "7px",
                color: "#000",
                position: "right",
                distance: "1px",
                start: "top",
                opacity: .4,
                alwaysVisible: !1,
                disableFadeOut: !1,
                railVisible: !1,
                railColor: "#333",
                railOpacity: .2,
                railDraggable: !0,
                railClass: "slimScrollRail",
                barClass: "slimScrollBar",
                wrapperClass: "slimScrollDiv",
                allowPageScroll: !1,
                wheelStep: 20,
                touchScrollStep: 200,
                borderRadius: "7px",
                railBorderRadius: "7px"
            }, S);
            return this.each(function() {
                var i, e, r, n, o, s, a, l, u = "<div></div>",
                    c = 30,
                    f = !1,
                    h = D(this);
                if (h.parent().hasClass(A.wrapperClass)) {
                    var d = h.scrollTop();
                    if (b = h.siblings("." + A.barClass), y = h.siblings("." + A.railClass), T(), D.isPlainObject(S)) {
                        if ("height" in S && "auto" == S.height) {
                            h.parent().css("height", "auto"), h.css("height", "auto");
                            var p = h.parent().parent().height();
                            h.parent().css("height", p), h.css("height", p)
                        } else if ("height" in S) {
                            var g = S.height;
                            h.parent().css("height", g), h.css("height", g)
                        }
                        if ("scrollTo" in S) d = parseInt(A.scrollTo);
                        else if ("scrollBy" in S) d += parseInt(A.scrollBy);
                        else if ("destroy" in S) return b.remove(), y.remove(), void h.unwrap();
                        E(d, !1, !0)
                    }
                } else if (!(D.isPlainObject(S) && "destroy" in S)) {
                    A.height = "auto" == A.height ? h.parent().height() : A.height;
                    var m = D(u).addClass(A.wrapperClass).css({
                        position: "relative",
                        overflow: "hidden",
                        width: A.width,
                        height: A.height
                    });
                    h.css({
                        overflow: "hidden",
                        width: A.width,
                        height: A.height
                    });
                    var v, y = D(u).addClass(A.railClass).css({
                            width: A.size,
                            height: "100%",
                            position: "absolute",
                            top: 0,
                            display: A.alwaysVisible && A.railVisible ? "block" : "none",
                            "border-radius": A.railBorderRadius,
                            background: A.railColor,
                            opacity: A.railOpacity,
                            zIndex: 90
                        }),
                        b = D(u).addClass(A.barClass).css({
                            background: A.color,
                            width: A.size,
                            position: "absolute",
                            top: 0,
                            opacity: A.opacity,
                            display: A.alwaysVisible ? "block" : "none",
                            "border-radius": A.borderRadius,
                            BorderRadius: A.borderRadius,
                            MozBorderRadius: A.borderRadius,
                            WebkitBorderRadius: A.borderRadius,
                            zIndex: 99
                        }),
                        _ = "right" == A.position ? {
                            right: A.distance
                        } : {
                            left: A.distance
                        };
                    y.css(_), b.css(_), h.wrap(m), h.parent().append(b), h.parent().append(y), A.railDraggable && b.bind("mousedown", function(e) {
                        var n = D(document);
                        return r = !0, t = parseFloat(b.css("top")), pageY = e.pageY, n.bind("mousemove.slimscroll", function(e) {
                            currTop = t + e.pageY - pageY, b.css("top", currTop), E(0, b.position().top, !1)
                        }), n.bind("mouseup.slimscroll", function(e) {
                            r = !1, C(), n.unbind(".slimscroll")
                        }), !1
                    }).bind("selectstart.slimscroll", function(e) {
                        return e.stopPropagation(), e.preventDefault(), !1
                    }), y.hover(function() {
                        x()
                    }, function() {
                        C()
                    }), b.hover(function() {
                        e = !0
                    }, function() {
                        e = !1
                    }), h.hover(function() {
                        i = !0, x(), C()
                    }, function() {
                        i = !1, C()
                    }), h.bind("touchstart", function(e, t) {
                        e.originalEvent.touches.length && (o = e.originalEvent.touches[0].pageY)
                    }), h.bind("touchmove", function(e) {
                        (f || e.originalEvent.preventDefault(), e.originalEvent.touches.length) && (E((o - e.originalEvent.touches[0].pageY) / A.touchScrollStep, !0), o = e.originalEvent.touches[0].pageY)
                    }), T(), "bottom" === A.start ? (b.css({
                        top: h.outerHeight() - b.outerHeight()
                    }), E(0, !0)) : "top" !== A.start && (E(D(A.start).position().top, null, !0), A.alwaysVisible || b.hide()), v = this, window.addEventListener ? (v.addEventListener("DOMMouseScroll", w, !1), v.addEventListener("mousewheel", w, !1)) : document.attachEvent("onmousewheel", w)
                }

                function w(e) {
                    if (i) {
                        var t = 0;
                        (e = e || window.event).wheelDelta && (t = -e.wheelDelta / 120), e.detail && (t = e.detail / 3);
                        var n = e.target || e.srcTarget || e.srcElement;
                        D(n).closest("." + A.wrapperClass).is(h.parent()) && E(t, !0), e.preventDefault && !f && e.preventDefault(), f || (e.returnValue = !1)
                    }
                }

                function E(e, t, n) {
                    f = !1;
                    var i = e,
                        r = h.outerHeight() - b.outerHeight();
                    if (t && (i = parseInt(b.css("top")) + e * parseInt(A.wheelStep) / 100 * b.outerHeight(), i = Math.min(Math.max(i, 0), r), i = 0 < e ? Math.ceil(i) : Math.floor(i), b.css({
                            top: i + "px"
                        })), i = (a = parseInt(b.css("top")) / (h.outerHeight() - b.outerHeight())) * (h[0].scrollHeight - h.outerHeight()), n) {
                        var o = (i = e) / h[0].scrollHeight * h.outerHeight();
                        o = Math.min(Math.max(o, 0), r), b.css({
                            top: o + "px"
                        })
                    }
                    h.scrollTop(i), h.trigger("slimscrolling", ~~i), x(), C()
                }

                function T() {
                    s = Math.max(h.outerHeight() / h[0].scrollHeight * h.outerHeight(), c), b.css({
                        height: s + "px"
                    });
                    var e = s == h.outerHeight() ? "none" : "block";
                    b.css({
                        display: e
                    })
                }

                function x() {
                    if (T(), clearTimeout(n), a == ~~a) {
                        if (f = A.allowPageScroll, l != a) {
                            var e = 0 == ~~a ? "top" : "bottom";
                            h.trigger("slimscroll", e)
                        }
                    } else f = !1;
                    l = a, s >= h.outerHeight() ? f = !0 : (b.stop(!0, !0).fadeIn("fast"), A.railVisible && y.stop(!0, !0).fadeIn("fast"))
                }

                function C() {
                    A.alwaysVisible || (n = setTimeout(function() {
                        A.disableFadeOut && i || e || r || (b.fadeOut("slow"), y.fadeOut("slow"))
                    }, 1e3))
                }
            }), this
        }
    }), D.fn.extend({
        slimscroll: D.fn.slimScroll
    })
})(jQuery),

function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t(require("jquery")) : "function" == typeof define && define.amd ? define(["jquery"], t) : e.metisMenu = t(e.jQuery)
}(this, function(e) {
    "use strict";

    function o(r) {
        for (var e = 1; e < arguments.length; e++) {
            var o = null != arguments[e] ? arguments[e] : {},
                t = Object.keys(o);
            "function" == typeof Object.getOwnPropertySymbols && (t = t.concat(Object.getOwnPropertySymbols(o).filter(function(e) {
                return Object.getOwnPropertyDescriptor(o, e).enumerable
            }))), t.forEach(function(e) {
                var t, n, i;
                t = r, i = o[n = e], n in t ? Object.defineProperty(t, n, {
                    value: i,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : t[n] = i
            })
        }
        return r
    }
    var a, t, s, n, i, l, u, r, c = function(i) {
        var t = "transitionend",
            r = {
                TRANSITION_END: "mmTransitionEnd",
                triggerTransitionEnd: function(e) {
                    i(e).trigger(t)
                },
                supportsTransitionEnd: function() {
                    return Boolean(t)
                }
            };

        function e(e) {
            var t = this,
                n = !1;
            return i(this).one(r.TRANSITION_END, function() {
                n = !0
            }), setTimeout(function() {
                n || r.triggerTransitionEnd(t)
            }, e), this
        }
        return i.fn.mmEmulateTransitionEnd = e, i.event.special[r.TRANSITION_END] = {
            bindType: t,
            delegateType: t,
            handle: function(e) {
                if (i(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
            }
        }, r
    }(e = e && e.hasOwnProperty("default") ? e.default : e);
    return n = "." + (s = t = "metisMenu"), i = (a = e).fn[t], l = {
        toggle: !0,
        preventDefault: !0,
        activeClass: "active",
        collapseClass: "collapse",
        collapseInClass: "in",
        collapsingClass: "collapsing",
        triggerElement: "a",
        parentTrigger: "li",
        subMenu: "ul"
    }, u = {
        SHOW: "show" + n,
        SHOWN: "shown" + n,
        HIDE: "hide" + n,
        HIDDEN: "hidden" + n,
        CLICK_DATA_API: "click" + n + ".data-api"
    }, r = function() {
        function r(e, t) {
            this.element = e, this.config = o({}, l, t), this.transitioning = null, this.init()
        }
        var e = r.prototype;
        return e.init = function() {
            var o = this,
                s = this.config;
            a(this.element).find(s.parentTrigger + "." + s.activeClass).has(s.subMenu).children(s.subMenu).addClass(s.collapseClass + " " + s.collapseInClass), a(this.element).find(s.parentTrigger).not("." + s.activeClass).has(s.subMenu).children(s.subMenu).addClass(s.collapseClass), a(this.element).find(s.parentTrigger).has(s.subMenu).children(s.triggerElement).on(u.CLICK_DATA_API, function(e) {
                var t = a(this),
                    n = t.parent(s.parentTrigger),
                    i = n.siblings(s.parentTrigger).children(s.triggerElement),
                    r = n.children(s.subMenu);
                s.preventDefault && e.preventDefault(), "true" !== t.attr("aria-disabled") && (n.hasClass(s.activeClass) ? (t.attr("aria-expanded", !1), o.hide(r)) : (o.show(r), t.attr("aria-expanded", !0), s.toggle && i.attr("aria-expanded", !1)), s.onTransitionStart && s.onTransitionStart(e))
            })
        }, e.show = function(e) {
            var t = this;
            if (!this.transitioning && !a(e).hasClass(this.config.collapsingClass)) {
                var n = a(e),
                    i = a.Event(u.SHOW);
                if (n.trigger(i), !i.isDefaultPrevented()) {
                    n.parent(this.config.parentTrigger).addClass(this.config.activeClass), this.config.toggle && this.hide(n.parent(this.config.parentTrigger).siblings().children(this.config.subMenu + "." + this.config.collapseInClass)), n.removeClass(this.config.collapseClass).addClass(this.config.collapsingClass).height(0), this.setTransitioning(!0);
                    n.height(e[0].scrollHeight).one(c.TRANSITION_END, function() {
                        t.config && t.element && (n.removeClass(t.config.collapsingClass).addClass(t.config.collapseClass + " " + t.config.collapseInClass).height(""), t.setTransitioning(!1), n.trigger(u.SHOWN))
                    }).mmEmulateTransitionEnd(350)
                }
            }
        }, e.hide = function(e) {
            var t = this;
            if (!this.transitioning && a(e).hasClass(this.config.collapseInClass)) {
                var n = a(e),
                    i = a.Event(u.HIDE);
                if (n.trigger(i), !i.isDefaultPrevented()) {
                    n.parent(this.config.parentTrigger).removeClass(this.config.activeClass), n.height(n.height())[0].offsetHeight, n.addClass(this.config.collapsingClass).removeClass(this.config.collapseClass).removeClass(this.config.collapseInClass), this.setTransitioning(!0);
                    var r = function() {
                        t.config && t.element && (t.transitioning && t.config.onTransitionEnd && t.config.onTransitionEnd(), t.setTransitioning(!1), n.trigger(u.HIDDEN), n.removeClass(t.config.collapsingClass).addClass(t.config.collapseClass))
                    };
                    0 === n.height() || "none" === n.css("display") ? r() : n.height(0).one(c.TRANSITION_END, r).mmEmulateTransitionEnd(350)
                }
            }
        }, e.setTransitioning = function(e) {
            this.transitioning = e
        }, e.dispose = function() {
            a.removeData(this.element, s), a(this.element).find(this.config.parentTrigger).has(this.config.subMenu).children(this.config.triggerElement).off("click"), this.transitioning = null, this.config = null, this.element = null
        }, r.jQueryInterface = function(i) {
            return this.each(function() {
                var e = a(this),
                    t = e.data(s),
                    n = o({}, l, e.data(), "object" == typeof i && i ? i : {});
                if (!t && /dispose/.test(i) && this.dispose(), t || (t = new r(this, n), e.data(s, t)), "string" == typeof i) {
                    if (void 0 === t[i]) throw new Error('No method named "' + i + '"');
                    t[i]()
                }
            })
        }, r
    }(), a.fn[t] = r.jQueryInterface, a.fn[t].Constructor = r, a.fn[t].noConflict = function() {
        return a.fn[t] = i, r.jQueryInterface
    }, r
}),


function(e, t) {
    "use strict";
    "function" == typeof define && define.amd ? define([], function() {
        return e.Waves = t.call(e), e.Waves
    }) : "object" == typeof exports ? module.exports = t.call(e) : e.Waves = t.call(e)
}("object" == typeof global ? global : this, function() {
    "use strict";
    var t = t || {},
        i = document.querySelectorAll.bind(document),
        s = Object.prototype.toString,
        a = "ontouchstart" in window;

    function r(e) {
        var t = typeof e;
        return "function" === t || "object" === t && !!e
    }

    function c(e) {
        var t, n = s.call(e);
        return "[object String]" === n ? i(e) : r(e) && /^\[object (Array|HTMLCollection|NodeList|Object)\]$/.test(n) && e.hasOwnProperty("length") ? e : r(t = e) && 0 < t.nodeType ? [e] : []
    }

    function f(e) {
        var t, n, i, r, o = {
                top: 0,
                left: 0
            },
            s = e && e.ownerDocument;
        return t = s.documentElement, void 0 !== e.getBoundingClientRect && (o = e.getBoundingClientRect()), n = null !== (r = i = s) && r === r.window ? i : 9 === i.nodeType && i.defaultView, {
            top: o.top + n.pageYOffset - t.clientTop,
            left: o.left + n.pageXOffset - t.clientLeft
        }
    }

    function h(e) {
        var t = "";
        for (var n in e) e.hasOwnProperty(n) && (t += n + ":" + e[n] + ";");
        return t
    }
    var d = {
            duration: 750,
            delay: 200,
            show: function(e, t, n) {
                if (2 === e.button) return !1;
                t = t || this;
                var i = document.createElement("div");
                i.className = "waves-ripple waves-rippling", t.appendChild(i);
                var r = f(t),
                    o = 0,
                    s = 0;
                s = 0 <= (s = "touches" in e && e.touches.length ? (o = e.touches[0].pageY - r.top, e.touches[0].pageX - r.left) : (o = e.pageY - r.top, e.pageX - r.left)) ? s : 0, o = 0 <= o ? o : 0;
                var a = "scale(" + t.clientWidth / 100 * 3 + ")",
                    l = "translate(0,0)";
                n && (l = "translate(" + n.x + "px, " + n.y + "px)"), i.setAttribute("data-hold", Date.now()), i.setAttribute("data-x", s), i.setAttribute("data-y", o), i.setAttribute("data-scale", a), i.setAttribute("data-translate", l);
                var u = {
                    top: o + "px",
                    left: s + "px"
                };
                i.classList.add("waves-notransition"), i.setAttribute("style", h(u)), i.classList.remove("waves-notransition"), u["-webkit-transform"] = a + " " + l, u["-moz-transform"] = a + " " + l, u["-ms-transform"] = a + " " + l, u["-o-transform"] = a + " " + l, u.transform = a + " " + l, u.opacity = "1";
                var c = "mousemove" === e.type ? 2500 : d.duration;
                u["-webkit-transition-duration"] = c + "ms", u["-moz-transition-duration"] = c + "ms", u["-o-transition-duration"] = c + "ms", u["transition-duration"] = c + "ms", i.setAttribute("style", h(u))
            },
            hide: function(e, t) {
                for (var n = (t = t || this).getElementsByClassName("waves-rippling"), i = 0, r = n.length; i < r; i++) o(e, t, n[i]);
                a && (t.removeEventListener("touchend", d.hide), t.removeEventListener("touchcancel", d.hide)), t.removeEventListener("mouseup", d.hide), t.removeEventListener("mouseleave", d.hide)
            }
        },
        l = {
            input: function(e) {
                var t = e.parentNode;
                if ("i" !== t.tagName.toLowerCase() || !t.classList.contains("waves-effect")) {
                    var n = document.createElement("i");
                    n.className = e.className + " waves-input-wrapper", e.className = "waves-button-input", t.replaceChild(n, e), n.appendChild(e);
                    var i = window.getComputedStyle(e, null),
                        r = i.color,
                        o = i.backgroundColor;
                    n.setAttribute("style", "color:" + r + ";background:" + o), e.setAttribute("style", "background-color:rgba(0,0,0,0);")
                }
            },
            img: function(e) {
                var t = e.parentNode;
                if ("i" !== t.tagName.toLowerCase() || !t.classList.contains("waves-effect")) {
                    var n = document.createElement("i");
                    t.replaceChild(n, e), n.appendChild(e)
                }
            }
        };

    function o(e, t, n) {
        if (n) {
            n.classList.remove("waves-rippling");
            var i = n.getAttribute("data-x"),
                r = n.getAttribute("data-y"),
                o = n.getAttribute("data-scale"),
                s = n.getAttribute("data-translate"),
                a = 350 - (Date.now() - Number(n.getAttribute("data-hold")));
            a < 0 && (a = 0), "mousemove" === e.type && (a = 150);
            var l = "mousemove" === e.type ? 2500 : d.duration;
            setTimeout(function() {
                var e = {
                    top: r + "px",
                    left: i + "px",
                    opacity: "0",
                    "-webkit-transition-duration": l + "ms",
                    "-moz-transition-duration": l + "ms",
                    "-o-transition-duration": l + "ms",
                    "transition-duration": l + "ms",
                    "-webkit-transform": o + " " + s,
                    "-moz-transform": o + " " + s,
                    "-ms-transform": o + " " + s,
                    "-o-transform": o + " " + s,
                    transform: o + " " + s
                };
                n.setAttribute("style", h(e)), setTimeout(function() {
                    try {
                        t.removeChild(n)
                    } catch (e) {
                        return !1
                    }
                }, l)
            }, a)
        }
    }
    var u = {
        touches: 0,
        allowEvent: function(e) {
            var t = !0;
            return /^(mousedown|mousemove)$/.test(e.type) && u.touches && (t = !1), t
        },
        registerEvent: function(e) {
            var t = e.type;
            "touchstart" === t ? u.touches += 1 : /^(touchend|touchcancel)$/.test(t) && setTimeout(function() {
                u.touches && (u.touches -= 1)
            }, 500)
        }
    };

    function n(t) {
        var n = function(e) {
            if (!1 === u.allowEvent(e)) return null;
            for (var t = null, n = e.target || e.srcElement; n.parentElement;) {
                if (!(n instanceof SVGElement) && n.classList.contains("waves-effect")) {
                    t = n;
                    break
                }
                n = n.parentElement
            }
            return t
        }(t);
        if (null !== n) {
            if (n.disabled || n.getAttribute("disabled") || n.classList.contains("disabled")) return;
            if (u.registerEvent(t), "touchstart" === t.type && d.delay) {
                var i = !1,
                    r = setTimeout(function() {
                        r = null, d.show(t, n)
                    }, d.delay),
                    o = function(e) {
                        r && (clearTimeout(r), r = null, d.show(t, n)), i || (i = !0, d.hide(e, n)), s()
                    },
                    e = function(e) {
                        r && (clearTimeout(r), r = null), o(e), s()
                    };
                n.addEventListener("touchmove", e, !1), n.addEventListener("touchend", o, !1), n.addEventListener("touchcancel", o, !1);
                var s = function() {
                    n.removeEventListener("touchmove", e), n.removeEventListener("touchend", o), n.removeEventListener("touchcancel", o)
                }
            } else d.show(t, n), a && (n.addEventListener("touchend", d.hide, !1), n.addEventListener("touchcancel", d.hide, !1)), n.addEventListener("mouseup", d.hide, !1), n.addEventListener("mouseleave", d.hide, !1)
        }
    }
    return t.init = function(e) {
        var t = document.body;
        "duration" in (e = e || {}) && (d.duration = e.duration), "delay" in e && (d.delay = e.delay), a && (t.addEventListener("touchstart", n, !1), t.addEventListener("touchcancel", u.registerEvent, !1), t.addEventListener("touchend", u.registerEvent, !1)), t.addEventListener("mousedown", n, !1)
    }, t.attach = function(e, t) {
        var n, i;
        e = c(e), "[object Array]" === s.call(t) && (t = t.join(" ")), t = t ? " " + t : "";
        for (var r = 0, o = e.length; r < o; r++) i = (n = e[r]).tagName.toLowerCase(), -1 !== ["input", "img"].indexOf(i) && (l[i](n), n = n.parentElement), -1 === n.className.indexOf("waves-effect") && (n.className += " waves-effect" + t)
    }, t.ripple = function(e, t) {
        var n = (e = c(e)).length;
        if ((t = t || {}).wait = t.wait || 0, t.position = t.position || null, n)
            for (var i, r, o, s = {}, a = 0, l = {
                    type: "mousedown",
                    button: 1
                }, u = function(e, t) {
                    return function() {
                        d.hide(e, t)
                    }
                }; a < n; a++)
                if (i = e[a], r = t.position || {
                        x: i.clientWidth / 2,
                        y: i.clientHeight / 2
                    }, o = f(i), s.x = o.left + r.x, s.y = o.top + r.y, l.pageX = s.x, l.pageY = s.y, d.show(l, i), 0 <= t.wait && null !== t.wait) {
                    setTimeout(u({
                        type: "mouseup",
                        button: 1
                    }, i), t.wait)
                }
    }, t.calm = function(e) {
        for (var t = {
                type: "mouseup",
                button: 1
            }, n = 0, i = (e = c(e)).length; n < i; n++) d.hide(t, e[n])
    }, t.displayEffect = function(e) {
        console.error("Waves.displayEffect() has been deprecated and will be removed in future version. Please use Waves.init() to initialize Waves effect"), t.init(e)
    }, t
})










//////////////////////////////////////////////////////////////////////////


! function(n) {
    "use strict";
    var t = function() {};
     t.prototype.initSlimScrollPlugin = function() {
        n.fn.slimScroll && n(".slimscroll").slimScroll({
            height: "auto",
            position: "right",
            size: "8px",
            touchScrollStep: 20,
            color: "#9ea5ab"
        })
    }, t.prototype.init = function() {
        this.initSlimScrollPlugin()
    }, n.Components = new t, n.Components.Constructor = t
}(window.jQuery),
function(a) {
    "use strict";
    
}(window.jQuery),
function(e) {
    "use strict";
    var t = function() {
        this.$body = e("body"), this.$window = e(window)
    };
    t.prototype._resetSidebarScroll = function() {
        e(".slimscroll-menu").slimscroll({
            height: "auto",
            position: "right",
            size: "8px",
            color: "#9ea5ab",
            wheelStep: 5,
            touchScrollStep: 20
        })
    }, t.prototype.initMenu = function() {
        var i = this;
        e(".button-menu-mobile").on("click", function(t) {
            t.preventDefault(), i.$body.toggleClass("sidebar-enable")
            ,768 <= i.$window.width() ? i.$body.toggleClass("enlarged") : i.$body.removeClass("enlarged")
            ,i._resetSidebarScroll()
        }), e("#side-menu").metisMenu(), i._resetSidebarScroll(), e(".right-bar-toggle").on("click", function(t) {
            e("body").toggleClass("right-bar-enabled")
        }), e(document).on("click", "body", function(t) {
            0 < e(t.target).closest(".right-bar-toggle, .right-bar").length || 0 < e(t.target).closest(".left-side-menu, .side-nav").length || e(t.target).hasClass("button-menu-mobile") || 0 < e(t.target).closest(".button-menu-mobile").length || (e("body").removeClass("right-bar-enabled"), e("body").removeClass("sidebar-enable"))
        }), e("#side-menu a").each(function() {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t && (e(this).addClass("active"), e(this).parent().addClass("active"), e(this).parent().parent().addClass("in"), e(this).parent().parent().prev().addClass("active"), e(this).parent().parent().parent().addClass("active"), e(this).parent().parent().parent().parent().addClass("in"), e(this).parent().parent().parent().parent().parent().addClass("active"))
        }), e(".navbar-toggle").on("click", function(t) {
            e(this).toggleClass("open"), e("#navigation").slideToggle(400)
        }), e(window).on("load", function() {
            e("#status").fadeOut(), e("#preloader").delay(350).fadeOut("slow")
        })
    }, t.prototype.initLayout = function() {
        768 <= this.$window.width() && this.$window.width() <= 1028 ? this.$body.addClass("enlarged") : 1 != this.$body.data("keep-enlarged") && this.$body.removeClass("enlarged")
    }, t.prototype.init = function() {
        var i = this;
        this.initLayout(),  this.initMenu(), e.Components.init(), i.$window.on("resize", function(t) {
            t.preventDefault(), i.initLayout(), i._resetSidebarScroll()
        })
    }, e.App = new t, e.App.Constructor = t
}(window.jQuery),
function(t) {
    "use strict";
    window.jQuery.App.init()
}(), Waves.init();
//# sourceMappingURL=app.min.js.map


