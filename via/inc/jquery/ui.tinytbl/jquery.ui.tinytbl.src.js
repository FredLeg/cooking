/**
 * jQuery UI TinyTbl
 * Creates a scrollable table with fixed thead, tfoot and columns
 *
 * Copyright (c) 2011 Michael Keck <http://www.michaelkeck.de/>
 * First Release: 2011-10-08
 * Released:      2011-10-08
 * Version:       2011-11-10
 * jQ Version:    1.9.1
 * License:       Dual licensed under the MIT or GPL Version 2 licenses.
 *                http://jquery.org/license
 * Depends:       jquery.ui.core
 *                jquery.ui.widget
 *
 * Changes:       - Bug: removed wrong typo for paddingRight.
 *                - New: feature for calculating the width of TinyTbl
 */ (function (a) {
    a.widget("ui.tinytbl", {
        options: {
            cols: 0,
            direction: "ltr",
            tbodycss: "ui-widget-content",
            tfoot: !0,
            tfootcss: "ui-widget-header",
            thead: !0,
            theadcss: "ui-widget-header",
            height: "auto",
            width: "auto",
            focus: !1
        },
        _init: function () {
            var b = "undefined",
                c = this,
                e = function (a) {
                    return typeof a !== b && !isNaN(parseInt(a, 10)) ? parseInt(a, 10) : !1
                };
            if (typeof c.csn === b || !c.csn) d = "ui-tinytbl", f = "-first", l = "-last", r = "row", x = "col", c.csn = {
                tbl: d,
                tb: d + "-tb",
                tf: d + "-tf",
                th: d + "-th",
                colb: d + f + x,
                cole: d + l + x,
                rowb: d + f + r,
                rowe: d + l + r
            };
            if (!e(c.sbw)) {
                var g = 0,
                    h = 0,
                    i = a('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-80px;left:0px"><div style="height:80px"></div>');
                a("body").append(i), g = a("div", i).innerWidth(), i.css({
                    "overflow-y": "scroll"
                }), h = a("div", i).innerWidth(), a(i).remove(), c.sbw = e(g) - e(h), c.sbf = Math.round(c.sbw * .5)
            }
        },
        _ra: function (b, c) {
            var d = this,
                e = d.element.data(),
                f = e.opt,
                g = 0,
                h = "tbody",
                i = "td,th",
                j = c.clone(),
                k = a(h, e.tb3),
                l = c.clone(),
                m = a(h, e.tb4);
            a(i, l).each(function (b) {
                b < f.cols && a(this).remove()
            }), a(i, j).each(function (b) {
                b > f.cols - 1 && a(this).remove()
            }), b !== "prepend" ? (k.append(j), m.append(l), g = 1) : (k.prepend(j), m.prepand(l)), d._rs(h), d._sr(h), e.tb2.scrollTop(g > 0 ? e.size.hr : 0)
        },
        _rd: function (b) {
            var c = this,
                d = c.element.data(),
                e = "tbody";
            a(b, a(e, d.tb3)).remove(), a(b, a(e, d.tb4)).remove(), c._rs(e)
        },
        _rs: function (b) {
            var c = this,
                d = c.csn,
                e = c.element.data(),
                f = e.opt,
                g, h, i = function (b) {
                    var c = a("tr", b),
                        e = a("tfoot", b).size() > 0 && !f.tf ? !0 : !1,
                        g = a("thead", b).size() > 0 && !f.th ? !0 : !1;
                    if (c.length < 1) return;
                    c.each(function () {
                        a(this).removeClass(d.rowb).removeClass(d.rowe)
                    }), !g && !e ? (c.first().addClass(d.rowb), c.last().addClass(d.rowe)) : (g || a("tbody tr", b).first().addClass(d.rowb), e ? a("thead tr", b).last().addClass(d.rowe) : a("tbody tr", b).last().addClass(d.rowe)), c.each(function () {
                        var b = a("td,th", this);
                        a(b).removeClass(d.colb).removeClass(d.cole), a(b[0]).addClass(d.colb), a(b[b.length - 1]).addClass(d.cole)
                    })
                };
            b || (b = "tbody"), b = ("" + b).toLowerCase();
            switch (b) {
            case "tfoot":
            case "foot":
                g = e.tf3, h = e.tf4;
                break;
            case "thead":
            case "head":
                g = e.th3, h = e.th4;
                break;
            default:
                g = e.tb3, h = e.tb4
            }
            i(g), i(h)
        },
        _sc: function (b) {
            var c = this,
                d = c.csn,
                e = c.element.data(),
                f = e.opt,
                g, h;
            b || (b = "tbody"), b = ("" + b).toLowerCase();
            switch (b) {
            case "tfoot":
            case "foot":
                g = e.tf3, h = e.tf4;
                break;
            case "thead":
            case "head":
                g = e.th3, h = e.th4;
                break;
            default:
                g = e.tb3, h = e.tb4
            }
            a("tr", h).each(function (b) {
                y = a("td,th", this), y.each(function (b) {
                    b < f.cols && a(this).remove()
                })
            }), a("tr", g).each(function (b) {
                y = a("td,th", this), y.each(function (b) {
                    b > f.cols - 1 && a(this).remove()
                })
            }), c._rs(b)
        },
        _sr: function (b) {
            var c = this.element,
                d = c.data(),
                e = d.opt,
                f = j = 0,
                g = "td,th",
                h = "tr";
            if (!e.cols) return;
            b || (b = "tbody"), b = ("" + b).toLowerCase();
            switch (b) {
            case "tfoot":
            case "foot":
                l = d.tf3, r = d.tf4;
                break;
            case "thead":
            case "head":
                l = d.th3, r = d.th4;
                break;
            default:
                l = d.tb3, r = d.tb4
            }
            var i = {
                l: [],
                r: []
            };
            a(h, r).each(function (b) {
                i.l[b] = a(this).first(g).outerHeight()
            }), a(h, l).each(function (b) {
                i.r[b] = a(this).first(g).outerHeight()
            }), a(h, r).each(function (b) {
                j = i.r[b], i.l[b] > i.r[b] && (j = i.l[b]), a(g, this).first().css({
                    height: j + "px"
                })
            }), a(h, l).each(function (b) {
                j = i.l[b], i.r[b] > i.l[b] && (j = i.r[b]), a(g, this).first().css({
                    height: j + "px"
                })
            }), c.data({
                size: a.extend(d.size, {
                    hl: l.height(),
                    hr: r.height()
                })
            })
        },
        _tc: function (b) {
            b || (b = "tbody"), b = ("" + b).toLowerCase();
            var c = 0,
                d = this,
                e = d.element.data(),
                f = e.opt,
                g, h, i, j = "table",
                k = "colgroup",
                l = function (b) {
                    var c = "table";
                    a(c, b).attr("cellpadding", e.padding), a(c, b).attr("cellspacing", e.spacing), a(c, b).attr("border", "0")
                };
            switch (b) {
            case "tfoot":
            case "foot":
                f.tf && (b = "tfoot", c = f.tf, g = "<" + j + "><" + b + (c.id ? ' role="' + c.id + '"' : "") + (c.csn ? ' class="' + c.csn + '"' : "") + ">" + a(b, e.cln).html() + "</" + b + "></" + j + ">", h = e.tf3, i = e.tf4);
                break;
            case "thead":
            case "head":
                f.th && (b = "thead", c = f.th, g = "<" + j + "><" + b + (c.id ? ' role="' + c.id + '"' : "") + (c.csn ? ' class="' + c.csn + '"' : "") + ">" + a(b, e.cln).html() + "</" + b + "></" + j + ">", h = e.th3, i = e.th4);
                break;
            default:
                b = "tbody", h = e.tb3, i = e.tb4
            }
            b !== "tbody" ? c && (i.append(g), f.cols && (h.append(g), a(k, h).remove(), a(j, h).prepend(e.size.cl).css({
                width: e.size.wl + "px"
            }), l(h), h.css({
                width: e.size.wl + "px"
            })), d._sc(b), a(k, i).remove(), a(j, i).prepend(e.size.cr).css({
                width: e.size.wr + "px"
            }), l(i), i.css({
                width: e.size.wr + "px"
            }), this._sr(b)) : (f.cols && (h.append(i.html()), a(k, h).remove(), a(j, h).prepend(e.size.cl).css({
                width: e.size.wl + "px"
            }), a(b, h).attr("id") && a(b, h).attr("role", a(b, h).attr("id") || "").removeAttr("id"), l(h), h.css({
                width: e.size.wl + "px"
            })), d._sc(b), a(k, i).remove(), a(j, i).prepend(e.size.cr).css({
                width: e.size.wr + "px"
            }), a(b, i).attr("id") && a(b, i).attr("role", a(b, i).attr("id") || "").removeAttr("id"), l(i), i.css({
                width: e.size.wr + "px"
            }), d._sr(b))
        },
        _td: function () {
            var a = this,
                b = a.element.data(),
                c = b.opt;
            s = {
                hl: 0,
                hr: c.height - b.th2.height() - b.tf2.height(),
                ws: c.width - b.tb1.width() - 1,
                wf: 0
            }, s.hr < 100 && (s.hr = 100), s.hl = s.hr, s.ws < 100 && (s.ws = 100), s.wf = s.ws, b.tb2.width() > s.ws && (s.hl = s.hl - a.sbw), b.tb2.height() > s.hr && (s.wf = s.wf - a.sbw), b.tbl.css({
                width: c.width + "px",
                height: c.height + "px"
            }), b.th2.css({
                width: s.wf + "px"
            }), b.tf2.css({
                width: s.wf + "px"
            }), b.tb1.css({
                height: s.hl + "px"
            }), b.tb2.css({
                width: s.ws + "px",
                height: s.hr + "px"
            })
        },
        _ti: function () {
            var b = this,
                c = b.element.data(),
                d = c.opt,
                e, f = "table";
            c.tb4.append("<" + f + ">" + c.cln.html() + "</" + f + ">"), d.tf && (e = "tfoot", a(e, c.tb4).remove(), b._tc(e)), d.th && (e = "thead", a(e, c.tb4).remove(), b._tc(e)), b._tc("tbody"), a(f, c.tbl).each(function () {
                a(this).css({
                    "border-collapse": "collapse",
                    "table-layout": "fixed"
                })
            })
        },
        _ts: function (a) {
            var b = this,
                c = b.element.data();
            if (!c.tb2) return;
            var d = c.tb2.scrollLeft(),
                e = c.tb2.scrollTop();
            c.tb1 && c.tb1.scrollTop(e), c.th2 && c.th2.scrollLeft(d), c.tf2 && c.tf2.scrollLeft(d)
        },
        _create: function () {
            var b = document,
                c = window,
                d, e, f, g, h, i, j, k, l, m = {},
                n = this,
                o, p, q = {},
                r = function (a) {
                    return a = ("" + a).replace(/[^0-9\.]/gi, ""), isNaN(parseFloat(a)) ? 0 : parseFloat(a)
                },
                s = function (a) {
                    return a.parent().get(0).tagName !== "body" && a.parent().get(0).tagName !== "html" ? !0 : !1
                },
                t = function (a) {
                    return a === "auto" || ("" + a).lastIndexOf("%") !== -1 ? !0 : !1
                };
            i = n.element, k = n.options, k.direction = ("" + k.direction).substring(0, 1).toLowerCase(), k.direction == "r" ? k.rtl = !0 : (k.direction = "", k.rtl = !1), ("" + k.width).lastIndexOf("%") !== -1 && r(k.width) >= 100 && (k.width = "auto"), ("" + k.height).lastIndexOf("%") !== -1 && r(k.height) >= 100 && (k.height = "auto");
            var u = a("body"),
                v = c.innerHeight || self.innerHeight || b.documentElement && b.documentElement.clientWidth || b.body.clientWidth,
                w = c.innerWidth || self.innerWidth || b.documentElement && b.documentElement.clientWidth || b.body.clientWidth;
            q = {
                size: {
                    cl: "",
                    cr: "",
                    wl: 0,
                    wr: 0,
                    hl: 0,
                    hr: 0
                }
            };
            if (("" + i.get(0).tagName).toLowerCase() !== "table") return;
            p = a("tr", i);
            if (p.length < 1) return;
            o = a("th,td", p[0]);
            if (o.length < 1) return;
            a("tbody", i).size() > 0 ? (k.tfoot && (d = "tfoot", a(d, i).size() < 1 ? k.tf = !1 : k.tfoot && (k.tf = {
                id: a(d, i).attr("id") || 0,
                csn: a(d, i).attr("class") || 0
            })), k.thead && (d = "thead", a(d, i).size() < 1 ? k.th = !1 : k.thead && (k.th = {
                id: a(d, i).attr("id") || 0,
                csn: a(d, i).attr("class") || 0
            }))) : (k.tf = !1, k.th = !1), f = 0, k.cols && (f = r(k.cols)), f > 0 && f < o.length ? k.fixed = f - 1 : (k.fixed = -1, k.cols = !1);
            if (!k.th && !k.tf && !k.cols) return !1;
            m = {
                c: '<col style="width:{w}px" width="{w}" />',
                g: "colgroup",
                l: "",
                r: ""
            }, k.cols ? o.each(function (b) {
                g = a(this).outerWidth(), b > k.fixed ? (q.size.wr += g, m.r += m.c.replace(/{w}/g, g)) : (q.size.wl += g, m.l += m.c.replace(/{w}/g, g))
            }) : o.each(function (b) {
                g = a(this).outerWidth(), q.size.wr += g, m.r += m.c.replace(/{w}/g, g)
            }), q.size.cl = m.l !== "" ? "<" + m.g + ">" + m.l + "</" + m.g + ">" : "", q.size.cr = m.r !== "" ? "<" + m.g + ">" + m.r + "</" + m.g + ">" : "", q.padding = i.attr("cellpadding") || "0", q.spacing = i.attr("cellspacing") || "0", d = {
                a: "auto",
                m: "margin",
                p: "padding",
                b: "border",
                w: "Width",
                t: "Top",
                f: "Bottom",
                l: "Left",
                r: "Right"
            }, n._init(), f = 0, m = "visible", t(k.height) ? (f = v, s(i) && (u = i.parent(), f = u.height(), k.height == d.a && u.css("overflow") != m && u.css("overflowY") != m && (f -= n.sbf)), k.height !== d.a && (f = Math.floor(f * .01 * r(k.height))), f -= r(u.css(d.m + d.t)) + r(u.css(d.m + d.f)) + r(u.css(d.p + d.t)) + r(u.css(d.p + d.f)) + r(u.css(d.b + d.t + d.w)) + r(u.css(d.b + d.f + d.w))) : f = r(k.height), k.height = f, f = 0;
            if (t(k.width)) f = w, s(i) && (u = i.parent(), f = u.width()), k.width !== d.a && (f = Math.floor(tmp * .01 * r(k.width))), f -= r(u.css(d.m + d.l)) + r(u.css(d.m + d.r)) + r(u.css(d.p + d.l)) + r(u.css(d.p + d.r)) + r(u.css(d.b + d.l + d.w)) + r(u.css(d.b + d.r + d.w));
            else if (("" + k.width).indexOf("cols:") !== -1) {
                f = 1;
                for (var x = 0; x <= r(k.width); x++) f += a(o[x]).outerWidth(!0)
            } else f = r(k.width);
            k.width = f, k.height < 100 && (k.height = 100), k.width < 200 && (k.width = 200), e = n.csn, j = i.clone();
            var y = '<div class="',
                z = '">',
                A = "</div>";
            h = a(y + e.tbl + (k.rtl ? "-rtl" : "") + (i.attr("class") ? " " + i.attr("class") : "") + (i.attr("id") ? '" role="' + i.attr("id") : "") + z + A), i.empty().css({
                display: "none"
            }), i.after(h), m = {
                tb: k.tbodycss ? " " + k.tbodycss : "",
                tf: k.tfootcss ? " " + k.tfootcss : "",
                th: k.theadcss ? " " + k.theadcss : "",
                tc: y + e.tbl + "-content" + z + A,
                fl: ' style="float:' + (k.rtl ? "right" : "left"),
                cb: '<div style="clear:both">' + A
            }, m.div = "", k.th && (m.div += y + e.th + z + y + e.th + "-left" + m.th + '"' + m.fl + z + m.tc + A + y + e.th + "-right" + m.th + '"' + m.fl + z + m.tc + A + m.cb + A), m.div += y + e.tb + z + y + e.tb + "-left" + m.tb + '"' + m.fl + z + m.tc + A + y + e.tb + "-right" + m.tb + '"' + m.fl + z + m.tc + A + m.cb + A, k.tf && (m.div += y + e.tf + z + y + e.tf + "-left" + m.tf + '"' + m.fl + z + m.tc + A + y + e.tf + "-right" + m.tf + '"' + m.fl + z + m.tc + A + m.cb + A), h.append(m.div), m = {
                l: "-left",
                r: "-right",
                c: " ." + e.tbl + "-content",
                h: "." + e.th,
                f: "." + e.tf,
                b: "." + e.tb
            }, q = a.extend(q, {
                tbl: h,
                th0: a(m.h, h),
                th1: a(m.h + m.l, h),
                th3: a(m.h + m.l + m.c, h),
                th2: a(m.h + m.r, h),
                th4: a(m.h + m.r + m.c, h),
                tb0: a(m.b, h),
                tb1: a(m.b + m.l, h),
                tb3: a(m.b + m.l + m.c, h),
                tb2: a(m.b + m.r, h),
                tb4: a(m.b + m.r + m.c, h),
                tf0: a(m.f, h),
                tf1: a(m.f + m.l, h),
                tf3: a(m.f + m.l + m.c, h),
                tf2: a(m.f + m.r, h),
                tf4: a(m.f + m.r + m.c, h),
                cln: j,
                opt: k
            }), i.data(q), n._ti(), m = "hidden", m = {
                x: {
                    "overflow-x": m
                },
                a: {
                    overflow: m
                }
            }, q.th2.css(m.x), q.tf2.css(m.x), q.tb1.css(m.a), q.tb2.css({
                overflow: "auto"
            }).scroll(function (a) {
                n._ts(a)
            }), n._td(), k.focus && q.tb2.focus()
        },
        append: function (a) {
            this._ra("append", a)
        },
        prepend: function (a) {
            this._ra("prepend", a)
        },
        remove: function (a) {
            this._rd(a)
        },
        destroy: function () {
            var a = this.element,
                b = a.data("tbl"),
                c = a.data("cln").html();
            a.html(c), a.css({
                display: "block"
            }), b.remove(), a.removeData()
        },
        focus: function () {
            var a = this.element.data();
            a.tb2.focus()
        }
    }), a.extend(a.ui.tinytbl, {
        version: "1.9.0a"
    })
})(jQuery);