!function(e) {
    function t(a) {
        if (n[a])
            return n[a].exports;
        var r = n[a] = {
            i: a,
            l: !1,
            exports: {}
        };
        return e[a].call(r.exports, r, r.exports, t),
        r.l = !0,
        r.exports
    }
    var n = {};
    t.m = e,
    t.c = n,
    t.d = function(e, n, a) {
        t.o(e, n) || Object.defineProperty(e, n, {
            configurable: !1,
            enumerable: !0,
            get: a
        })
    }
    ,
    t.n = function(e) {
        var n = e && e.__esModule ? function() {
            return e.default
        }
        : function() {
            return e
        }
        ;
        return t.d(n, "a", n),
        n
    }
    ,
    t.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }
    ,
    t.p = "",
    t(t.s = 123)
}([function(e, t, n) {
    (function(e) {
        !function(t, n) {
            e.exports = n()
        }(0, function() {
            "use strict";
            function t() {
                return va.apply(null, arguments)
            }
            function a(e) {
                return e instanceof Array || "[object Array]" === Object.prototype.toString.call(e)
            }
            function r(e) {
                return null != e && "[object Object]" === Object.prototype.toString.call(e)
            }
            function i(e) {
                var t;
                for (t in e)
                    return !1;
                return !0
            }
            function s(e) {
                return void 0 === e
            }
            function o(e) {
                return "number" == typeof e || "[object Number]" === Object.prototype.toString.call(e)
            }
            function d(e) {
                return e instanceof Date || "[object Date]" === Object.prototype.toString.call(e)
            }
            function u(e, t) {
                var n, a = [];
                for (n = 0; n < e.length; ++n)
                    a.push(t(e[n], n));
                return a
            }
            function _(e, t) {
                return Object.prototype.hasOwnProperty.call(e, t)
            }
            function l(e, t) {
                for (var n in t)
                    _(t, n) && (e[n] = t[n]);
                return _(t, "toString") && (e.toString = t.toString),
                _(t, "valueOf") && (e.valueOf = t.valueOf),
                e
            }
            function c(e, t, n, a) {
                return Lt(e, t, n, a, !0).utc()
            }
            function m() {
                return {
                    empty: !1,
                    unusedTokens: [],
                    unusedInput: [],
                    overflow: -2,
                    charsLeftOver: 0,
                    nullInput: !1,
                    invalidMonth: null,
                    invalidFormat: !1,
                    userInvalidated: !1,
                    iso: !1,
                    parsedDateParts: [],
                    meridiem: null,
                    rfc2822: !1,
                    weekdayMismatch: !1
                }
            }
            function f(e) {
                return null == e._pf && (e._pf = m()),
                e._pf
            }
            function h(e) {
                if (null == e._isValid) {
                    var t = f(e)
                      , n = ga.call(t.parsedDateParts, function(e) {
                        return null != e
                    })
                      , a = !isNaN(e._d.getTime()) && t.overflow < 0 && !t.empty && !t.invalidMonth && !t.invalidWeekday && !t.nullInput && !t.invalidFormat && !t.userInvalidated && (!t.meridiem || t.meridiem && n);
                    if (e._strict && (a = a && 0 === t.charsLeftOver && 0 === t.unusedTokens.length && void 0 === t.bigHour),
                    null != Object.isFrozen && Object.isFrozen(e))
                        return a;
                    e._isValid = a
                }
                return e._isValid
            }
            function p(e) {
                var t = c(NaN);
                return null != e ? l(f(t), e) : f(t).userInvalidated = !0,
                t
            }
            function M(e, t) {
                var n, a, r;
                if (s(t._isAMomentObject) || (e._isAMomentObject = t._isAMomentObject),
                s(t._i) || (e._i = t._i),
                s(t._f) || (e._f = t._f),
                s(t._l) || (e._l = t._l),
                s(t._strict) || (e._strict = t._strict),
                s(t._tzm) || (e._tzm = t._tzm),
                s(t._isUTC) || (e._isUTC = t._isUTC),
                s(t._offset) || (e._offset = t._offset),
                s(t._pf) || (e._pf = f(t)),
                s(t._locale) || (e._locale = t._locale),
                ka.length > 0)
                    for (n = 0; n < ka.length; n++)
                        a = ka[n],
                        r = t[a],
                        s(r) || (e[a] = r);
                return e
            }
            function y(e) {
                M(this, e),
                this._d = new Date(null != e._d ? e._d.getTime() : NaN),
                this.isValid() || (this._d = new Date(NaN)),
                !1 === Da && (Da = !0,
                t.updateOffset(this),
                Da = !1)
            }
            function L(e) {
                return e instanceof y || null != e && null != e._isAMomentObject
            }
            function v(e) {
                return e < 0 ? Math.ceil(e) || 0 : Math.floor(e)
            }
            function Y(e) {
                var t = +e
                  , n = 0;
                return 0 !== t && isFinite(t) && (n = v(t)),
                n
            }
            function g(e, t, n) {
                var a, r = Math.min(e.length, t.length), i = Math.abs(e.length - t.length), s = 0;
                for (a = 0; a < r; a++)
                    (n && e[a] !== t[a] || !n && Y(e[a]) !== Y(t[a])) && s++;
                return s + i
            }
            function k(e) {
                !1 === t.suppressDeprecationWarnings && "undefined" != typeof console && console.warn
            }
            function D(e, n) {
                var a = !0;
                return l(function() {
                    if (null != t.deprecationHandler && t.deprecationHandler(null, e),
                    a) {
                        for (var r, i = [], s = 0; s < arguments.length; s++) {
                            if (r = "",
                            "object" == typeof arguments[s]) {
                                r += "\n[" + s + "] ";
                                for (var o in arguments[0])
                                    r += o + ": " + arguments[0][o] + ", ";
                                r = r.slice(0, -2)
                            } else
                                r = arguments[s];
                            i.push(r)
                        }
                        k(e + "\nArguments: " + Array.prototype.slice.call(i).join("") + "\n" + (new Error).stack),
                        a = !1
                    }
                    return n.apply(this, arguments)
                }, n)
            }
            function w(e, n) {
                null != t.deprecationHandler && t.deprecationHandler(e, n),
                wa[e] || (k(n),
                wa[e] = !0)
            }
            function T(e) {
                return e instanceof Function || "[object Function]" === Object.prototype.toString.call(e)
            }
            function b(e) {
                var t, n;
                for (n in e)
                    t = e[n],
                    T(t) ? this[n] = t : this["_" + n] = t;
                this._config = e,
                this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source)
            }
            function S(e, t) {
                var n, a = l({}, e);
                for (n in t)
                    _(t, n) && (r(e[n]) && r(t[n]) ? (a[n] = {},
                    l(a[n], e[n]),
                    l(a[n], t[n])) : null != t[n] ? a[n] = t[n] : delete a[n]);
                for (n in e)
                    _(e, n) && !_(t, n) && r(e[n]) && (a[n] = l({}, a[n]));
                return a
            }
            function j(e) {
                null != e && this.set(e)
            }
            function H(e, t, n) {
                var a = this._calendar[e] || this._calendar.sameElse;
                return T(a) ? a.call(t, n) : a
            }
            function x(e) {
                var t = this._longDateFormat[e]
                  , n = this._longDateFormat[e.toUpperCase()];
                return t || !n ? t : (this._longDateFormat[e] = n.replace(/MMMM|MM|DD|dddd/g, function(e) {
                    return e.slice(1)
                }),
                this._longDateFormat[e])
            }
            function O() {
                return this._invalidDate
            }
            function P(e) {
                return this._ordinal.replace("%d", e)
            }
            function A(e, t, n, a) {
                var r = this._relativeTime[n];
                return T(r) ? r(e, t, n, a) : r.replace(/%d/i, e)
            }
            function E(e, t) {
                var n = this._relativeTime[e > 0 ? "future" : "past"];
                return T(n) ? n(t) : n.replace(/%s/i, t)
            }
            function C(e, t) {
                var n = e.toLowerCase();
                Pa[n] = Pa[n + "s"] = Pa[t] = e
            }
            function W(e) {
                return "string" == typeof e ? Pa[e] || Pa[e.toLowerCase()] : void 0
            }
            function F(e) {
                var t, n, a = {};
                for (n in e)
                    _(e, n) && (t = W(n)) && (a[t] = e[n]);
                return a
            }
            function $(e, t) {
                Aa[e] = t
            }
            function N(e) {
                var t = [];
                for (var n in e)
                    t.push({
                        unit: n,
                        priority: Aa[n]
                    });
                return t.sort(function(e, t) {
                    return e.priority - t.priority
                }),
                t
            }
            function z(e, n) {
                return function(a) {
                    return null != a ? (I(this, e, a),
                    t.updateOffset(this, n),
                    this) : R(this, e)
                }
            }
            function R(e, t) {
                return e.isValid() ? e._d["get" + (e._isUTC ? "UTC" : "") + t]() : NaN
            }
            function I(e, t, n) {
                e.isValid() && e._d["set" + (e._isUTC ? "UTC" : "") + t](n)
            }
            function J(e) {
                return e = W(e),
                T(this[e]) ? this[e]() : this
            }
            function U(e, t) {
                if ("object" == typeof e) {
                    e = F(e);
                    for (var n = N(e), a = 0; a < n.length; a++)
                        this[n[a].unit](e[n[a].unit])
                } else if (e = W(e),
                T(this[e]))
                    return this[e](t);
                return this
            }
            function G(e, t, n) {
                var a = "" + Math.abs(e)
                  , r = t - a.length;
                return (e >= 0 ? n ? "+" : "" : "-") + Math.pow(10, Math.max(0, r)).toString().substr(1) + a
            }
            function V(e, t, n, a) {
                var r = a;
                "string" == typeof a && (r = function() {
                    return this[a]()
                }
                ),
                e && (Fa[e] = r),
                t && (Fa[t[0]] = function() {
                    return G(r.apply(this, arguments), t[1], t[2])
                }
                ),
                n && (Fa[n] = function() {
                    return this.localeData().ordinal(r.apply(this, arguments), e)
                }
                )
            }
            function B(e) {
                return e.match(/\[[\s\S]/) ? e.replace(/^\[|\]$/g, "") : e.replace(/\\/g, "")
            }
            function q(e) {
                var t, n, a = e.match(Ea);
                for (t = 0,
                n = a.length; t < n; t++)
                    Fa[a[t]] ? a[t] = Fa[a[t]] : a[t] = B(a[t]);
                return function(t) {
                    var r, i = "";
                    for (r = 0; r < n; r++)
                        i += T(a[r]) ? a[r].call(t, e) : a[r];
                    return i
                }
            }
            function K(e, t) {
                return e.isValid() ? (t = Z(t, e.localeData()),
                Wa[t] = Wa[t] || q(t),
                Wa[t](e)) : e.localeData().invalidDate()
            }
            function Z(e, t) {
                function n(e) {
                    return t.longDateFormat(e) || e
                }
                var a = 5;
                for (Ca.lastIndex = 0; a >= 0 && Ca.test(e); )
                    e = e.replace(Ca, n),
                    Ca.lastIndex = 0,
                    a -= 1;
                return e
            }
            function Q(e, t, n) {
                nr[e] = T(t) ? t : function(e, a) {
                    return e && n ? n : t
                }
            }
            function X(e, t) {
                return _(nr, e) ? nr[e](t._strict, t._locale) : new RegExp(ee(e))
            }
            function ee(e) {
                return te(e.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function(e, t, n, a, r) {
                    return t || n || a || r
                }))
            }
            function te(e) {
                return e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&")
            }
            function ne(e, t) {
                var n, a = t;
                for ("string" == typeof e && (e = [e]),
                o(t) && (a = function(e, n) {
                    n[t] = Y(e)
                }
                ),
                n = 0; n < e.length; n++)
                    ar[e[n]] = a
            }
            function ae(e, t) {
                ne(e, function(e, n, a, r) {
                    a._w = a._w || {},
                    t(e, a._w, a, r)
                })
            }
            function re(e, t, n) {
                null != t && _(ar, e) && ar[e](t, n._a, n, e)
            }
            function ie(e, t) {
                return new Date(Date.UTC(e, t + 1, 0)).getUTCDate()
            }
            function se(e, t) {
                return e ? a(this._months) ? this._months[e.month()] : this._months[(this._months.isFormat || fr).test(t) ? "format" : "standalone"][e.month()] : a(this._months) ? this._months : this._months.standalone
            }
            function oe(e, t) {
                return e ? a(this._monthsShort) ? this._monthsShort[e.month()] : this._monthsShort[fr.test(t) ? "format" : "standalone"][e.month()] : a(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone
            }
            function de(e, t, n) {
                var a, r, i, s = e.toLocaleLowerCase();
                if (!this._monthsParse)
                    for (this._monthsParse = [],
                    this._longMonthsParse = [],
                    this._shortMonthsParse = [],
                    a = 0; a < 12; ++a)
                        i = c([2e3, a]),
                        this._shortMonthsParse[a] = this.monthsShort(i, "").toLocaleLowerCase(),
                        this._longMonthsParse[a] = this.months(i, "").toLocaleLowerCase();
                return n ? "MMM" === t ? (r = mr.call(this._shortMonthsParse, s),
                -1 !== r ? r : null) : (r = mr.call(this._longMonthsParse, s),
                -1 !== r ? r : null) : "MMM" === t ? -1 !== (r = mr.call(this._shortMonthsParse, s)) ? r : (r = mr.call(this._longMonthsParse, s),
                -1 !== r ? r : null) : -1 !== (r = mr.call(this._longMonthsParse, s)) ? r : (r = mr.call(this._shortMonthsParse, s),
                -1 !== r ? r : null)
            }
            function ue(e, t, n) {
                var a, r, i;
                if (this._monthsParseExact)
                    return de.call(this, e, t, n);
                for (this._monthsParse || (this._monthsParse = [],
                this._longMonthsParse = [],
                this._shortMonthsParse = []),
                a = 0; a < 12; a++) {
                    if (r = c([2e3, a]),
                    n && !this._longMonthsParse[a] && (this._longMonthsParse[a] = new RegExp("^" + this.months(r, "").replace(".", "") + "$","i"),
                    this._shortMonthsParse[a] = new RegExp("^" + this.monthsShort(r, "").replace(".", "") + "$","i")),
                    n || this._monthsParse[a] || (i = "^" + this.months(r, "") + "|^" + this.monthsShort(r, ""),
                    this._monthsParse[a] = new RegExp(i.replace(".", ""),"i")),
                    n && "MMMM" === t && this._longMonthsParse[a].test(e))
                        return a;
                    if (n && "MMM" === t && this._shortMonthsParse[a].test(e))
                        return a;
                    if (!n && this._monthsParse[a].test(e))
                        return a
                }
            }
            function _e(e, t) {
                var n;
                if (!e.isValid())
                    return e;
                if ("string" == typeof t)
                    if (/^\d+$/.test(t))
                        t = Y(t);
                    else if (t = e.localeData().monthsParse(t),
                    !o(t))
                        return e;
                return n = Math.min(e.date(), ie(e.year(), t)),
                e._d["set" + (e._isUTC ? "UTC" : "") + "Month"](t, n),
                e
            }
            function le(e) {
                return null != e ? (_e(this, e),
                t.updateOffset(this, !0),
                this) : R(this, "Month")
            }
            function ce() {
                return ie(this.year(), this.month())
            }
            function me(e) {
                return this._monthsParseExact ? (_(this, "_monthsRegex") || he.call(this),
                e ? this._monthsShortStrictRegex : this._monthsShortRegex) : (_(this, "_monthsShortRegex") || (this._monthsShortRegex = Mr),
                this._monthsShortStrictRegex && e ? this._monthsShortStrictRegex : this._monthsShortRegex)
            }
            function fe(e) {
                return this._monthsParseExact ? (_(this, "_monthsRegex") || he.call(this),
                e ? this._monthsStrictRegex : this._monthsRegex) : (_(this, "_monthsRegex") || (this._monthsRegex = yr),
                this._monthsStrictRegex && e ? this._monthsStrictRegex : this._monthsRegex)
            }
            function he() {
                function e(e, t) {
                    return t.length - e.length
                }
                var t, n, a = [], r = [], i = [];
                for (t = 0; t < 12; t++)
                    n = c([2e3, t]),
                    a.push(this.monthsShort(n, "")),
                    r.push(this.months(n, "")),
                    i.push(this.months(n, "")),
                    i.push(this.monthsShort(n, ""));
                for (a.sort(e),
                r.sort(e),
                i.sort(e),
                t = 0; t < 12; t++)
                    a[t] = te(a[t]),
                    r[t] = te(r[t]);
                for (t = 0; t < 24; t++)
                    i[t] = te(i[t]);
                this._monthsRegex = new RegExp("^(" + i.join("|") + ")","i"),
                this._monthsShortRegex = this._monthsRegex,
                this._monthsStrictRegex = new RegExp("^(" + r.join("|") + ")","i"),
                this._monthsShortStrictRegex = new RegExp("^(" + a.join("|") + ")","i")
            }
            function pe(e) {
                return Me(e) ? 366 : 365
            }
            function Me(e) {
                return e % 4 == 0 && e % 100 != 0 || e % 400 == 0
            }
            function ye() {
                return Me(this.year())
            }
            function Le(e, t, n, a, r, i, s) {
                var o = new Date(e,t,n,a,r,i,s);
                return e < 100 && e >= 0 && isFinite(o.getFullYear()) && o.setFullYear(e),
                o
            }
            function ve(e) {
                var t = new Date(Date.UTC.apply(null, arguments));
                return e < 100 && e >= 0 && isFinite(t.getUTCFullYear()) && t.setUTCFullYear(e),
                t
            }
            function Ye(e, t, n) {
                var a = 7 + t - n;
                return -(7 + ve(e, 0, a).getUTCDay() - t) % 7 + a - 1
            }
            function ge(e, t, n, a, r) {
                var i, s, o = (7 + n - a) % 7, d = Ye(e, a, r), u = 1 + 7 * (t - 1) + o + d;
                return u <= 0 ? (i = e - 1,
                s = pe(i) + u) : u > pe(e) ? (i = e + 1,
                s = u - pe(e)) : (i = e,
                s = u),
                {
                    year: i,
                    dayOfYear: s
                }
            }
            function ke(e, t, n) {
                var a, r, i = Ye(e.year(), t, n), s = Math.floor((e.dayOfYear() - i - 1) / 7) + 1;
                return s < 1 ? (r = e.year() - 1,
                a = s + De(r, t, n)) : s > De(e.year(), t, n) ? (a = s - De(e.year(), t, n),
                r = e.year() + 1) : (r = e.year(),
                a = s),
                {
                    week: a,
                    year: r
                }
            }
            function De(e, t, n) {
                var a = Ye(e, t, n)
                  , r = Ye(e + 1, t, n);
                return (pe(e) - a + r) / 7
            }
            function we(e) {
                return ke(e, this._week.dow, this._week.doy).week
            }
            function Te() {
                return this._week.dow
            }
            function be() {
                return this._week.doy
            }
            function Se(e) {
                var t = this.localeData().week(this);
                return null == e ? t : this.add(7 * (e - t), "d")
            }
            function je(e) {
                var t = ke(this, 1, 4).week;
                return null == e ? t : this.add(7 * (e - t), "d")
            }
            function He(e, t) {
                return "string" != typeof e ? e : isNaN(e) ? (e = t.weekdaysParse(e),
                "number" == typeof e ? e : null) : parseInt(e, 10)
            }
            function xe(e, t) {
                return "string" == typeof e ? t.weekdaysParse(e) % 7 || 7 : isNaN(e) ? null : e
            }
            function Oe(e, t) {
                return e ? a(this._weekdays) ? this._weekdays[e.day()] : this._weekdays[this._weekdays.isFormat.test(t) ? "format" : "standalone"][e.day()] : a(this._weekdays) ? this._weekdays : this._weekdays.standalone
            }
            function Pe(e) {
                return e ? this._weekdaysShort[e.day()] : this._weekdaysShort
            }
            function Ae(e) {
                return e ? this._weekdaysMin[e.day()] : this._weekdaysMin
            }
            function Ee(e, t, n) {
                var a, r, i, s = e.toLocaleLowerCase();
                if (!this._weekdaysParse)
                    for (this._weekdaysParse = [],
                    this._shortWeekdaysParse = [],
                    this._minWeekdaysParse = [],
                    a = 0; a < 7; ++a)
                        i = c([2e3, 1]).day(a),
                        this._minWeekdaysParse[a] = this.weekdaysMin(i, "").toLocaleLowerCase(),
                        this._shortWeekdaysParse[a] = this.weekdaysShort(i, "").toLocaleLowerCase(),
                        this._weekdaysParse[a] = this.weekdays(i, "").toLocaleLowerCase();
                return n ? "dddd" === t ? (r = mr.call(this._weekdaysParse, s),
                -1 !== r ? r : null) : "ddd" === t ? (r = mr.call(this._shortWeekdaysParse, s),
                -1 !== r ? r : null) : (r = mr.call(this._minWeekdaysParse, s),
                -1 !== r ? r : null) : "dddd" === t ? -1 !== (r = mr.call(this._weekdaysParse, s)) ? r : -1 !== (r = mr.call(this._shortWeekdaysParse, s)) ? r : (r = mr.call(this._minWeekdaysParse, s),
                -1 !== r ? r : null) : "ddd" === t ? -1 !== (r = mr.call(this._shortWeekdaysParse, s)) ? r : -1 !== (r = mr.call(this._weekdaysParse, s)) ? r : (r = mr.call(this._minWeekdaysParse, s),
                -1 !== r ? r : null) : -1 !== (r = mr.call(this._minWeekdaysParse, s)) ? r : -1 !== (r = mr.call(this._weekdaysParse, s)) ? r : (r = mr.call(this._shortWeekdaysParse, s),
                -1 !== r ? r : null)
            }
            function Ce(e, t, n) {
                var a, r, i;
                if (this._weekdaysParseExact)
                    return Ee.call(this, e, t, n);
                for (this._weekdaysParse || (this._weekdaysParse = [],
                this._minWeekdaysParse = [],
                this._shortWeekdaysParse = [],
                this._fullWeekdaysParse = []),
                a = 0; a < 7; a++) {
                    if (r = c([2e3, 1]).day(a),
                    n && !this._fullWeekdaysParse[a] && (this._fullWeekdaysParse[a] = new RegExp("^" + this.weekdays(r, "").replace(".", ".?") + "$","i"),
                    this._shortWeekdaysParse[a] = new RegExp("^" + this.weekdaysShort(r, "").replace(".", ".?") + "$","i"),
                    this._minWeekdaysParse[a] = new RegExp("^" + this.weekdaysMin(r, "").replace(".", ".?") + "$","i")),
                    this._weekdaysParse[a] || (i = "^" + this.weekdays(r, "") + "|^" + this.weekdaysShort(r, "") + "|^" + this.weekdaysMin(r, ""),
                    this._weekdaysParse[a] = new RegExp(i.replace(".", ""),"i")),
                    n && "dddd" === t && this._fullWeekdaysParse[a].test(e))
                        return a;
                    if (n && "ddd" === t && this._shortWeekdaysParse[a].test(e))
                        return a;
                    if (n && "dd" === t && this._minWeekdaysParse[a].test(e))
                        return a;
                    if (!n && this._weekdaysParse[a].test(e))
                        return a
                }
            }
            function We(e) {
                if (!this.isValid())
                    return null != e ? this : NaN;
                var t = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
                return null != e ? (e = He(e, this.localeData()),
                this.add(e - t, "d")) : t
            }
            function Fe(e) {
                if (!this.isValid())
                    return null != e ? this : NaN;
                var t = (this.day() + 7 - this.localeData()._week.dow) % 7;
                return null == e ? t : this.add(e - t, "d")
            }
            function $e(e) {
                if (!this.isValid())
                    return null != e ? this : NaN;
                if (null != e) {
                    var t = xe(e, this.localeData());
                    return this.day(this.day() % 7 ? t : t - 7)
                }
                return this.day() || 7
            }
            function Ne(e) {
                return this._weekdaysParseExact ? (_(this, "_weekdaysRegex") || Ie.call(this),
                e ? this._weekdaysStrictRegex : this._weekdaysRegex) : (_(this, "_weekdaysRegex") || (this._weekdaysRegex = Dr),
                this._weekdaysStrictRegex && e ? this._weekdaysStrictRegex : this._weekdaysRegex)
            }
            function ze(e) {
                return this._weekdaysParseExact ? (_(this, "_weekdaysRegex") || Ie.call(this),
                e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (_(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = wr),
                this._weekdaysShortStrictRegex && e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex)
            }
            function Re(e) {
                return this._weekdaysParseExact ? (_(this, "_weekdaysRegex") || Ie.call(this),
                e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (_(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = Tr),
                this._weekdaysMinStrictRegex && e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex)
            }
            function Ie() {
                function e(e, t) {
                    return t.length - e.length
                }
                var t, n, a, r, i, s = [], o = [], d = [], u = [];
                for (t = 0; t < 7; t++)
                    n = c([2e3, 1]).day(t),
                    a = this.weekdaysMin(n, ""),
                    r = this.weekdaysShort(n, ""),
                    i = this.weekdays(n, ""),
                    s.push(a),
                    o.push(r),
                    d.push(i),
                    u.push(a),
                    u.push(r),
                    u.push(i);
                for (s.sort(e),
                o.sort(e),
                d.sort(e),
                u.sort(e),
                t = 0; t < 7; t++)
                    o[t] = te(o[t]),
                    d[t] = te(d[t]),
                    u[t] = te(u[t]);
                this._weekdaysRegex = new RegExp("^(" + u.join("|") + ")","i"),
                this._weekdaysShortRegex = this._weekdaysRegex,
                this._weekdaysMinRegex = this._weekdaysRegex,
                this._weekdaysStrictRegex = new RegExp("^(" + d.join("|") + ")","i"),
                this._weekdaysShortStrictRegex = new RegExp("^(" + o.join("|") + ")","i"),
                this._weekdaysMinStrictRegex = new RegExp("^(" + s.join("|") + ")","i")
            }
            function Je() {
                return this.hours() % 12 || 12
            }
            function Ue() {
                return this.hours() || 24
            }
            function Ge(e, t) {
                V(e, 0, 0, function() {
                    return this.localeData().meridiem(this.hours(), this.minutes(), t)
                })
            }
            function Ve(e, t) {
                return t._meridiemParse
            }
            function Be(e) {
                return "p" === (e + "").toLowerCase().charAt(0)
            }
            function qe(e, t, n) {
                return e > 11 ? n ? "pm" : "PM" : n ? "am" : "AM"
            }
            function Ke(e) {
                return e ? e.toLowerCase().replace("_", "-") : e
            }
            function Ze(e) {
                for (var t, n, a, r, i = 0; i < e.length; ) {
                    for (r = Ke(e[i]).split("-"),
                    t = r.length,
                    n = Ke(e[i + 1]),
                    n = n ? n.split("-") : null; t > 0; ) {
                        if (a = Qe(r.slice(0, t).join("-")))
                            return a;
                        if (n && n.length >= t && g(r, n, !0) >= t - 1)
                            break;
                        t--
                    }
                    i++
                }
                return null
            }
            function Qe(t) {
                var a = null;
                if (!xr[t] && void 0 !== e && e && e.exports)
                    try {
                        a = br._abbr,
                        n(154)("./" + t),
                        Xe(a)
                    } catch (e) {}
                return xr[t]
            }
            function Xe(e, t) {
                var n;
                return e && (n = s(t) ? nt(e) : et(e, t)) && (br = n),
                br._abbr
            }
            function et(e, t) {
                if (null !== t) {
                    var n = Hr;
                    if (t.abbr = e,
                    null != xr[e])
                        w("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."),
                        n = xr[e]._config;
                    else if (null != t.parentLocale) {
                        if (null == xr[t.parentLocale])
                            return Or[t.parentLocale] || (Or[t.parentLocale] = []),
                            Or[t.parentLocale].push({
                                name: e,
                                config: t
                            }),
                            null;
                        n = xr[t.parentLocale]._config
                    }
                    return xr[e] = new j(S(n, t)),
                    Or[e] && Or[e].forEach(function(e) {
                        et(e.name, e.config)
                    }),
                    Xe(e),
                    xr[e]
                }
                return delete xr[e],
                null
            }
            function tt(e, t) {
                if (null != t) {
                    var n, a = Hr;
                    null != xr[e] && (a = xr[e]._config),
                    t = S(a, t),
                    n = new j(t),
                    n.parentLocale = xr[e],
                    xr[e] = n,
                    Xe(e)
                } else
                    null != xr[e] && (null != xr[e].parentLocale ? xr[e] = xr[e].parentLocale : null != xr[e] && delete xr[e]);
                return xr[e]
            }
            function nt(e) {
                var t;
                if (e && e._locale && e._locale._abbr && (e = e._locale._abbr),
                !e)
                    return br;
                if (!a(e)) {
                    if (t = Qe(e))
                        return t;
                    e = [e]
                }
                return Ze(e)
            }
            function at() {
                return Sa(xr)
            }
            function rt(e) {
                var t, n = e._a;
                return n && -2 === f(e).overflow && (t = n[ir] < 0 || n[ir] > 11 ? ir : n[sr] < 1 || n[sr] > ie(n[rr], n[ir]) ? sr : n[or] < 0 || n[or] > 24 || 24 === n[or] && (0 !== n[dr] || 0 !== n[ur] || 0 !== n[_r]) ? or : n[dr] < 0 || n[dr] > 59 ? dr : n[ur] < 0 || n[ur] > 59 ? ur : n[_r] < 0 || n[_r] > 999 ? _r : -1,
                f(e)._overflowDayOfYear && (t < rr || t > sr) && (t = sr),
                f(e)._overflowWeeks && -1 === t && (t = lr),
                f(e)._overflowWeekday && -1 === t && (t = cr),
                f(e).overflow = t),
                e
            }
            function it(e) {
                var t, n, a, r, i, s, o = e._i, d = Pr.exec(o) || Ar.exec(o);
                if (d) {
                    for (f(e).iso = !0,
                    t = 0,
                    n = Cr.length; t < n; t++)
                        if (Cr[t][1].exec(d[1])) {
                            r = Cr[t][0],
                            a = !1 !== Cr[t][2];
                            break
                        }
                    if (null == r)
                        return void (e._isValid = !1);
                    if (d[3]) {
                        for (t = 0,
                        n = Wr.length; t < n; t++)
                            if (Wr[t][1].exec(d[3])) {
                                i = (d[2] || " ") + Wr[t][0];
                                break
                            }
                        if (null == i)
                            return void (e._isValid = !1)
                    }
                    if (!a && null != i)
                        return void (e._isValid = !1);
                    if (d[4]) {
                        if (!Er.exec(d[4]))
                            return void (e._isValid = !1);
                        s = "Z"
                    }
                    e._f = r + (i || "") + (s || ""),
                    ct(e)
                } else
                    e._isValid = !1
            }
            function st(e) {
                var t, n, a, r, i, s, o, d, u = {
                    " GMT": " +0000",
                    " EDT": " -0400",
                    " EST": " -0500",
                    " CDT": " -0500",
                    " CST": " -0600",
                    " MDT": " -0600",
                    " MST": " -0700",
                    " PDT": " -0700",
                    " PST": " -0800"
                }, _ = "YXWVUTSRQPONZABCDEFGHIKLM";
                if (t = e._i.replace(/\([^\)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").replace(/^\s|\s$/g, ""),
                n = $r.exec(t)) {
                    if (a = n[1] ? "ddd" + (5 === n[1].length ? ", " : " ") : "",
                    r = "D MMM " + (n[2].length > 10 ? "YYYY " : "YY "),
                    i = "HH:mm" + (n[4] ? ":ss" : ""),
                    n[1]) {
                        var l = new Date(n[2])
                          , c = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][l.getDay()];
                        if (n[1].substr(0, 3) !== c)
                            return f(e).weekdayMismatch = !0,
                            void (e._isValid = !1)
                    }
                    switch (n[5].length) {
                    case 2:
                        0 === d ? o = " +0000" : (d = _.indexOf(n[5][1].toUpperCase()) - 12,
                        o = (d < 0 ? " -" : " +") + ("" + d).replace(/^-?/, "0").match(/..$/)[0] + "00");
                        break;
                    case 4:
                        o = u[n[5]];
                        break;
                    default:
                        o = u[" GMT"]
                    }
                    n[5] = o,
                    e._i = n.splice(1).join(""),
                    s = " ZZ",
                    e._f = a + r + i + s,
                    ct(e),
                    f(e).rfc2822 = !0
                } else
                    e._isValid = !1
            }
            function ot(e) {
                var n = Fr.exec(e._i);
                if (null !== n)
                    return void (e._d = new Date(+n[1]));
                it(e),
                !1 === e._isValid && (delete e._isValid,
                st(e),
                !1 === e._isValid && (delete e._isValid,
                t.createFromInputFallback(e)))
            }
            function dt(e, t, n) {
                return null != e ? e : null != t ? t : n
            }
            function ut(e) {
                var n = new Date(t.now());
                return e._useUTC ? [n.getUTCFullYear(), n.getUTCMonth(), n.getUTCDate()] : [n.getFullYear(), n.getMonth(), n.getDate()]
            }
            function _t(e) {
                var t, n, a, r, i = [];
                if (!e._d) {
                    for (a = ut(e),
                    e._w && null == e._a[sr] && null == e._a[ir] && lt(e),
                    null != e._dayOfYear && (r = dt(e._a[rr], a[rr]),
                    (e._dayOfYear > pe(r) || 0 === e._dayOfYear) && (f(e)._overflowDayOfYear = !0),
                    n = ve(r, 0, e._dayOfYear),
                    e._a[ir] = n.getUTCMonth(),
                    e._a[sr] = n.getUTCDate()),
                    t = 0; t < 3 && null == e._a[t]; ++t)
                        e._a[t] = i[t] = a[t];
                    for (; t < 7; t++)
                        e._a[t] = i[t] = null == e._a[t] ? 2 === t ? 1 : 0 : e._a[t];
                    24 === e._a[or] && 0 === e._a[dr] && 0 === e._a[ur] && 0 === e._a[_r] && (e._nextDay = !0,
                    e._a[or] = 0),
                    e._d = (e._useUTC ? ve : Le).apply(null, i),
                    null != e._tzm && e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm),
                    e._nextDay && (e._a[or] = 24)
                }
            }
            function lt(e) {
                var t, n, a, r, i, s, o, d;
                if (t = e._w,
                null != t.GG || null != t.W || null != t.E)
                    i = 1,
                    s = 4,
                    n = dt(t.GG, e._a[rr], ke(vt(), 1, 4).year),
                    a = dt(t.W, 1),
                    ((r = dt(t.E, 1)) < 1 || r > 7) && (d = !0);
                else {
                    i = e._locale._week.dow,
                    s = e._locale._week.doy;
                    var u = ke(vt(), i, s);
                    n = dt(t.gg, e._a[rr], u.year),
                    a = dt(t.w, u.week),
                    null != t.d ? ((r = t.d) < 0 || r > 6) && (d = !0) : null != t.e ? (r = t.e + i,
                    (t.e < 0 || t.e > 6) && (d = !0)) : r = i
                }
                a < 1 || a > De(n, i, s) ? f(e)._overflowWeeks = !0 : null != d ? f(e)._overflowWeekday = !0 : (o = ge(n, a, r, i, s),
                e._a[rr] = o.year,
                e._dayOfYear = o.dayOfYear)
            }
            function ct(e) {
                if (e._f === t.ISO_8601)
                    return void it(e);
                if (e._f === t.RFC_2822)
                    return void st(e);
                e._a = [],
                f(e).empty = !0;
                var n, a, r, i, s, o = "" + e._i, d = o.length, u = 0;
                for (r = Z(e._f, e._locale).match(Ea) || [],
                n = 0; n < r.length; n++)
                    i = r[n],
                    a = (o.match(X(i, e)) || [])[0],
                    a && (s = o.substr(0, o.indexOf(a)),
                    s.length > 0 && f(e).unusedInput.push(s),
                    o = o.slice(o.indexOf(a) + a.length),
                    u += a.length),
                    Fa[i] ? (a ? f(e).empty = !1 : f(e).unusedTokens.push(i),
                    re(i, a, e)) : e._strict && !a && f(e).unusedTokens.push(i);
                f(e).charsLeftOver = d - u,
                o.length > 0 && f(e).unusedInput.push(o),
                e._a[or] <= 12 && !0 === f(e).bigHour && e._a[or] > 0 && (f(e).bigHour = void 0),
                f(e).parsedDateParts = e._a.slice(0),
                f(e).meridiem = e._meridiem,
                e._a[or] = mt(e._locale, e._a[or], e._meridiem),
                _t(e),
                rt(e)
            }
            function mt(e, t, n) {
                var a;
                return null == n ? t : null != e.meridiemHour ? e.meridiemHour(t, n) : null != e.isPM ? (a = e.isPM(n),
                a && t < 12 && (t += 12),
                a || 12 !== t || (t = 0),
                t) : t
            }
            function ft(e) {
                var t, n, a, r, i;
                if (0 === e._f.length)
                    return f(e).invalidFormat = !0,
                    void (e._d = new Date(NaN));
                for (r = 0; r < e._f.length; r++)
                    i = 0,
                    t = M({}, e),
                    null != e._useUTC && (t._useUTC = e._useUTC),
                    t._f = e._f[r],
                    ct(t),
                    h(t) && (i += f(t).charsLeftOver,
                    i += 10 * f(t).unusedTokens.length,
                    f(t).score = i,
                    (null == a || i < a) && (a = i,
                    n = t));
                l(e, n || t)
            }
            function ht(e) {
                if (!e._d) {
                    var t = F(e._i);
                    e._a = u([t.year, t.month, t.day || t.date, t.hour, t.minute, t.second, t.millisecond], function(e) {
                        return e && parseInt(e, 10)
                    }),
                    _t(e)
                }
            }
            function pt(e) {
                var t = new y(rt(Mt(e)));
                return t._nextDay && (t.add(1, "d"),
                t._nextDay = void 0),
                t
            }
            function Mt(e) {
                var t = e._i
                  , n = e._f;
                return e._locale = e._locale || nt(e._l),
                null === t || void 0 === n && "" === t ? p({
                    nullInput: !0
                }) : ("string" == typeof t && (e._i = t = e._locale.preparse(t)),
                L(t) ? new y(rt(t)) : (d(t) ? e._d = t : a(n) ? ft(e) : n ? ct(e) : yt(e),
                h(e) || (e._d = null),
                e))
            }
            function yt(e) {
                var n = e._i;
                s(n) ? e._d = new Date(t.now()) : d(n) ? e._d = new Date(n.valueOf()) : "string" == typeof n ? ot(e) : a(n) ? (e._a = u(n.slice(0), function(e) {
                    return parseInt(e, 10)
                }),
                _t(e)) : r(n) ? ht(e) : o(n) ? e._d = new Date(n) : t.createFromInputFallback(e)
            }
            function Lt(e, t, n, s, o) {
                var d = {};
                return !0 !== n && !1 !== n || (s = n,
                n = void 0),
                (r(e) && i(e) || a(e) && 0 === e.length) && (e = void 0),
                d._isAMomentObject = !0,
                d._useUTC = d._isUTC = o,
                d._l = n,
                d._i = e,
                d._f = t,
                d._strict = s,
                pt(d)
            }
            function vt(e, t, n, a) {
                return Lt(e, t, n, a, !1)
            }
            function Yt(e, t) {
                var n, r;
                if (1 === t.length && a(t[0]) && (t = t[0]),
                !t.length)
                    return vt();
                for (n = t[0],
                r = 1; r < t.length; ++r)
                    t[r].isValid() && !t[r][e](n) || (n = t[r]);
                return n
            }
            function gt() {
                return Yt("isBefore", [].slice.call(arguments, 0))
            }
            function kt() {
                return Yt("isAfter", [].slice.call(arguments, 0))
            }
            function Dt(e) {
                for (var t in e)
                    if (-1 === Ir.indexOf(t) || null != e[t] && isNaN(e[t]))
                        return !1;
                for (var n = !1, a = 0; a < Ir.length; ++a)
                    if (e[Ir[a]]) {
                        if (n)
                            return !1;
                        parseFloat(e[Ir[a]]) !== Y(e[Ir[a]]) && (n = !0)
                    }
                return !0
            }
            function wt() {
                return this._isValid
            }
            function Tt() {
                return Ut(NaN)
            }
            function bt(e) {
                var t = F(e)
                  , n = t.year || 0
                  , a = t.quarter || 0
                  , r = t.month || 0
                  , i = t.week || 0
                  , s = t.day || 0
                  , o = t.hour || 0
                  , d = t.minute || 0
                  , u = t.second || 0
                  , _ = t.millisecond || 0;
                this._isValid = Dt(t),
                this._milliseconds = +_ + 1e3 * u + 6e4 * d + 1e3 * o * 60 * 60,
                this._days = +s + 7 * i,
                this._months = +r + 3 * a + 12 * n,
                this._data = {},
                this._locale = nt(),
                this._bubble()
            }
            function St(e) {
                return e instanceof bt
            }
            function jt(e) {
                return e < 0 ? -1 * Math.round(-1 * e) : Math.round(e)
            }
            function Ht(e, t) {
                V(e, 0, 0, function() {
                    var e = this.utcOffset()
                      , n = "+";
                    return e < 0 && (e = -e,
                    n = "-"),
                    n + G(~~(e / 60), 2) + t + G(~~e % 60, 2)
                })
            }
            function xt(e, t) {
                var n = (t || "").match(e);
                if (null === n)
                    return null;
                var a = n[n.length - 1] || []
                  , r = (a + "").match(Jr) || ["-", 0, 0]
                  , i = 60 * r[1] + Y(r[2]);
                return 0 === i ? 0 : "+" === r[0] ? i : -i
            }
            function Ot(e, n) {
                var a, r;
                return n._isUTC ? (a = n.clone(),
                r = (L(e) || d(e) ? e.valueOf() : vt(e).valueOf()) - a.valueOf(),
                a._d.setTime(a._d.valueOf() + r),
                t.updateOffset(a, !1),
                a) : vt(e).local()
            }
            function Pt(e) {
                return 15 * -Math.round(e._d.getTimezoneOffset() / 15)
            }
            function At(e, n, a) {
                var r, i = this._offset || 0;
                if (!this.isValid())
                    return null != e ? this : NaN;
                if (null != e) {
                    if ("string" == typeof e) {
                        if (null === (e = xt(Xa, e)))
                            return this
                    } else
                        Math.abs(e) < 16 && !a && (e *= 60);
                    return !this._isUTC && n && (r = Pt(this)),
                    this._offset = e,
                    this._isUTC = !0,
                    null != r && this.add(r, "m"),
                    i !== e && (!n || this._changeInProgress ? Kt(this, Ut(e - i, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0,
                    t.updateOffset(this, !0),
                    this._changeInProgress = null)),
                    this
                }
                return this._isUTC ? i : Pt(this)
            }
            function Et(e, t) {
                return null != e ? ("string" != typeof e && (e = -e),
                this.utcOffset(e, t),
                this) : -this.utcOffset()
            }
            function Ct(e) {
                return this.utcOffset(0, e)
            }
            function Wt(e) {
                return this._isUTC && (this.utcOffset(0, e),
                this._isUTC = !1,
                e && this.subtract(Pt(this), "m")),
                this
            }
            function Ft() {
                if (null != this._tzm)
                    this.utcOffset(this._tzm, !1, !0);
                else if ("string" == typeof this._i) {
                    var e = xt(Qa, this._i);
                    null != e ? this.utcOffset(e) : this.utcOffset(0, !0)
                }
                return this
            }
            function $t(e) {
                return !!this.isValid() && (e = e ? vt(e).utcOffset() : 0,
                (this.utcOffset() - e) % 60 == 0)
            }
            function Nt() {
                return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset()
            }
            function zt() {
                if (!s(this._isDSTShifted))
                    return this._isDSTShifted;
                var e = {};
                if (M(e, this),
                e = Mt(e),
                e._a) {
                    var t = e._isUTC ? c(e._a) : vt(e._a);
                    this._isDSTShifted = this.isValid() && g(e._a, t.toArray()) > 0
                } else
                    this._isDSTShifted = !1;
                return this._isDSTShifted
            }
            function Rt() {
                return !!this.isValid() && !this._isUTC
            }
            function It() {
                return !!this.isValid() && this._isUTC
            }
            function Jt() {
                return !!this.isValid() && (this._isUTC && 0 === this._offset)
            }
            function Ut(e, t) {
                var n, a, r, i = e, s = null;
                return St(e) ? i = {
                    ms: e._milliseconds,
                    d: e._days,
                    M: e._months
                } : o(e) ? (i = {},
                t ? i[t] = e : i.milliseconds = e) : (s = Ur.exec(e)) ? (n = "-" === s[1] ? -1 : 1,
                i = {
                    y: 0,
                    d: Y(s[sr]) * n,
                    h: Y(s[or]) * n,
                    m: Y(s[dr]) * n,
                    s: Y(s[ur]) * n,
                    ms: Y(jt(1e3 * s[_r])) * n
                }) : (s = Gr.exec(e)) ? (n = "-" === s[1] ? -1 : 1,
                i = {
                    y: Gt(s[2], n),
                    M: Gt(s[3], n),
                    w: Gt(s[4], n),
                    d: Gt(s[5], n),
                    h: Gt(s[6], n),
                    m: Gt(s[7], n),
                    s: Gt(s[8], n)
                }) : null == i ? i = {} : "object" == typeof i && ("from"in i || "to"in i) && (r = Bt(vt(i.from), vt(i.to)),
                i = {},
                i.ms = r.milliseconds,
                i.M = r.months),
                a = new bt(i),
                St(e) && _(e, "_locale") && (a._locale = e._locale),
                a
            }
            function Gt(e, t) {
                var n = e && parseFloat(e.replace(",", "."));
                return (isNaN(n) ? 0 : n) * t
            }
            function Vt(e, t) {
                var n = {
                    milliseconds: 0,
                    months: 0
                };
                return n.months = t.month() - e.month() + 12 * (t.year() - e.year()),
                e.clone().add(n.months, "M").isAfter(t) && --n.months,
                n.milliseconds = +t - +e.clone().add(n.months, "M"),
                n
            }
            function Bt(e, t) {
                var n;
                return e.isValid() && t.isValid() ? (t = Ot(t, e),
                e.isBefore(t) ? n = Vt(e, t) : (n = Vt(t, e),
                n.milliseconds = -n.milliseconds,
                n.months = -n.months),
                n) : {
                    milliseconds: 0,
                    months: 0
                }
            }
            function qt(e, t) {
                return function(n, a) {
                    var r, i;
                    return null === a || isNaN(+a) || (w(t, "moment()." + t + "(period, number) is deprecated. Please use moment()." + t + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."),
                    i = n,
                    n = a,
                    a = i),
                    n = "string" == typeof n ? +n : n,
                    r = Ut(n, a),
                    Kt(this, r, e),
                    this
                }
            }
            function Kt(e, n, a, r) {
                var i = n._milliseconds
                  , s = jt(n._days)
                  , o = jt(n._months);
                e.isValid() && (r = null == r || r,
                i && e._d.setTime(e._d.valueOf() + i * a),
                s && I(e, "Date", R(e, "Date") + s * a),
                o && _e(e, R(e, "Month") + o * a),
                r && t.updateOffset(e, s || o))
            }
            function Zt(e, t) {
                var n = e.diff(t, "days", !0);
                return n < -6 ? "sameElse" : n < -1 ? "lastWeek" : n < 0 ? "lastDay" : n < 1 ? "sameDay" : n < 2 ? "nextDay" : n < 7 ? "nextWeek" : "sameElse"
            }
            function Qt(e, n) {
                var a = e || vt()
                  , r = Ot(a, this).startOf("day")
                  , i = t.calendarFormat(this, r) || "sameElse"
                  , s = n && (T(n[i]) ? n[i].call(this, a) : n[i]);
                return this.format(s || this.localeData().calendar(i, this, vt(a)))
            }
            function Xt() {
                return new y(this)
            }
            function en(e, t) {
                var n = L(e) ? e : vt(e);
                return !(!this.isValid() || !n.isValid()) && (t = W(s(t) ? "millisecond" : t),
                "millisecond" === t ? this.valueOf() > n.valueOf() : n.valueOf() < this.clone().startOf(t).valueOf())
            }
            function tn(e, t) {
                var n = L(e) ? e : vt(e);
                return !(!this.isValid() || !n.isValid()) && (t = W(s(t) ? "millisecond" : t),
                "millisecond" === t ? this.valueOf() < n.valueOf() : this.clone().endOf(t).valueOf() < n.valueOf())
            }
            function nn(e, t, n, a) {
                return a = a || "()",
                ("(" === a[0] ? this.isAfter(e, n) : !this.isBefore(e, n)) && (")" === a[1] ? this.isBefore(t, n) : !this.isAfter(t, n))
            }
            function an(e, t) {
                var n, a = L(e) ? e : vt(e);
                return !(!this.isValid() || !a.isValid()) && (t = W(t || "millisecond"),
                "millisecond" === t ? this.valueOf() === a.valueOf() : (n = a.valueOf(),
                this.clone().startOf(t).valueOf() <= n && n <= this.clone().endOf(t).valueOf()))
            }
            function rn(e, t) {
                return this.isSame(e, t) || this.isAfter(e, t)
            }
            function sn(e, t) {
                return this.isSame(e, t) || this.isBefore(e, t)
            }
            function on(e, t, n) {
                var a, r, i, s;
                return this.isValid() ? (a = Ot(e, this),
                a.isValid() ? (r = 6e4 * (a.utcOffset() - this.utcOffset()),
                t = W(t),
                "year" === t || "month" === t || "quarter" === t ? (s = dn(this, a),
                "quarter" === t ? s /= 3 : "year" === t && (s /= 12)) : (i = this - a,
                s = "second" === t ? i / 1e3 : "minute" === t ? i / 6e4 : "hour" === t ? i / 36e5 : "day" === t ? (i - r) / 864e5 : "week" === t ? (i - r) / 6048e5 : i),
                n ? s : v(s)) : NaN) : NaN
            }
            function dn(e, t) {
                var n, a, r = 12 * (t.year() - e.year()) + (t.month() - e.month()), i = e.clone().add(r, "months");
                return t - i < 0 ? (n = e.clone().add(r - 1, "months"),
                a = (t - i) / (i - n)) : (n = e.clone().add(r + 1, "months"),
                a = (t - i) / (n - i)),
                -(r + a) || 0
            }
            function un() {
                return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
            }
            function _n() {
                if (!this.isValid())
                    return null;
                var e = this.clone().utc();
                return e.year() < 0 || e.year() > 9999 ? K(e, "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]") : T(Date.prototype.toISOString) ? this.toDate().toISOString() : K(e, "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]")
            }
            function ln() {
                if (!this.isValid())
                    return "moment.invalid(/* " + this._i + " */)";
                var e = "moment"
                  , t = "";
                this.isLocal() || (e = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone",
                t = "Z");
                var n = "[" + e + '("]'
                  , a = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY"
                  , r = t + '[")]';
                return this.format(n + a + "-MM-DD[T]HH:mm:ss.SSS" + r)
            }
            function cn(e) {
                e || (e = this.isUtc() ? t.defaultFormatUtc : t.defaultFormat);
                var n = K(this, e);
                return this.localeData().postformat(n)
            }
            function mn(e, t) {
                return this.isValid() && (L(e) && e.isValid() || vt(e).isValid()) ? Ut({
                    to: this,
                    from: e
                }).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
            }
            function fn(e) {
                return this.from(vt(), e)
            }
            function hn(e, t) {
                return this.isValid() && (L(e) && e.isValid() || vt(e).isValid()) ? Ut({
                    from: this,
                    to: e
                }).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
            }
            function pn(e) {
                return this.to(vt(), e)
            }
            function Mn(e) {
                var t;
                return void 0 === e ? this._locale._abbr : (t = nt(e),
                null != t && (this._locale = t),
                this)
            }
            function yn() {
                return this._locale
            }
            function Ln(e) {
                switch (e = W(e)) {
                case "year":
                    this.month(0);
                case "quarter":
                case "month":
                    this.date(1);
                case "week":
                case "isoWeek":
                case "day":
                case "date":
                    this.hours(0);
                case "hour":
                    this.minutes(0);
                case "minute":
                    this.seconds(0);
                case "second":
                    this.milliseconds(0)
                }
                return "week" === e && this.weekday(0),
                "isoWeek" === e && this.isoWeekday(1),
                "quarter" === e && this.month(3 * Math.floor(this.month() / 3)),
                this
            }
            function vn(e) {
                return void 0 === (e = W(e)) || "millisecond" === e ? this : ("date" === e && (e = "day"),
                this.startOf(e).add(1, "isoWeek" === e ? "week" : e).subtract(1, "ms"))
            }
            function Yn() {
                return this._d.valueOf() - 6e4 * (this._offset || 0)
            }
            function gn() {
                return Math.floor(this.valueOf() / 1e3)
            }
            function kn() {
                return new Date(this.valueOf())
            }
            function Dn() {
                var e = this;
                return [e.year(), e.month(), e.date(), e.hour(), e.minute(), e.second(), e.millisecond()]
            }
            function wn() {
                var e = this;
                return {
                    years: e.year(),
                    months: e.month(),
                    date: e.date(),
                    hours: e.hours(),
                    minutes: e.minutes(),
                    seconds: e.seconds(),
                    milliseconds: e.milliseconds()
                }
            }
            function Tn() {
                return this.isValid() ? this.toISOString() : null
            }
            function bn() {
                return h(this)
            }
            function Sn() {
                return l({}, f(this))
            }
            function jn() {
                return f(this).overflow
            }
            function Hn() {
                return {
                    input: this._i,
                    format: this._f,
                    locale: this._locale,
                    isUTC: this._isUTC,
                    strict: this._strict
                }
            }
            function xn(e, t) {
                V(0, [e, e.length], 0, t)
            }
            function On(e) {
                return Cn.call(this, e, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy)
            }
            function Pn(e) {
                return Cn.call(this, e, this.isoWeek(), this.isoWeekday(), 1, 4)
            }
            function An() {
                return De(this.year(), 1, 4)
            }
            function En() {
                var e = this.localeData()._week;
                return De(this.year(), e.dow, e.doy)
            }
            function Cn(e, t, n, a, r) {
                var i;
                return null == e ? ke(this, a, r).year : (i = De(e, a, r),
                t > i && (t = i),
                Wn.call(this, e, t, n, a, r))
            }
            function Wn(e, t, n, a, r) {
                var i = ge(e, t, n, a, r)
                  , s = ve(i.year, 0, i.dayOfYear);
                return this.year(s.getUTCFullYear()),
                this.month(s.getUTCMonth()),
                this.date(s.getUTCDate()),
                this
            }
            function Fn(e) {
                return null == e ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (e - 1) + this.month() % 3)
            }
            function $n(e) {
                var t = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
                return null == e ? t : this.add(e - t, "d")
            }
            function Nn(e, t) {
                t[_r] = Y(1e3 * ("0." + e))
            }
            function zn() {
                return this._isUTC ? "UTC" : ""
            }
            function Rn() {
                return this._isUTC ? "Coordinated Universal Time" : ""
            }
            function In(e) {
                return vt(1e3 * e)
            }
            function Jn() {
                return vt.apply(null, arguments).parseZone()
            }
            function Un(e) {
                return e
            }
            function Gn(e, t, n, a) {
                var r = nt()
                  , i = c().set(a, t);
                return r[n](i, e)
            }
            function Vn(e, t, n) {
                if (o(e) && (t = e,
                e = void 0),
                e = e || "",
                null != t)
                    return Gn(e, t, n, "month");
                var a, r = [];
                for (a = 0; a < 12; a++)
                    r[a] = Gn(e, a, n, "month");
                return r
            }
            function Bn(e, t, n, a) {
                "boolean" == typeof e ? (o(t) && (n = t,
                t = void 0),
                t = t || "") : (t = e,
                n = t,
                e = !1,
                o(t) && (n = t,
                t = void 0),
                t = t || "");
                var r = nt()
                  , i = e ? r._week.dow : 0;
                if (null != n)
                    return Gn(t, (n + i) % 7, a, "day");
                var s, d = [];
                for (s = 0; s < 7; s++)
                    d[s] = Gn(t, (s + i) % 7, a, "day");
                return d
            }
            function qn(e, t) {
                return Vn(e, t, "months")
            }
            function Kn(e, t) {
                return Vn(e, t, "monthsShort")
            }
            function Zn(e, t, n) {
                return Bn(e, t, n, "weekdays")
            }
            function Qn(e, t, n) {
                return Bn(e, t, n, "weekdaysShort")
            }
            function Xn(e, t, n) {
                return Bn(e, t, n, "weekdaysMin")
            }
            function ea() {
                var e = this._data;
                return this._milliseconds = ai(this._milliseconds),
                this._days = ai(this._days),
                this._months = ai(this._months),
                e.milliseconds = ai(e.milliseconds),
                e.seconds = ai(e.seconds),
                e.minutes = ai(e.minutes),
                e.hours = ai(e.hours),
                e.months = ai(e.months),
                e.years = ai(e.years),
                this
            }
            function ta(e, t, n, a) {
                var r = Ut(t, n);
                return e._milliseconds += a * r._milliseconds,
                e._days += a * r._days,
                e._months += a * r._months,
                e._bubble()
            }
            function na(e, t) {
                return ta(this, e, t, 1)
            }
            function aa(e, t) {
                return ta(this, e, t, -1)
            }
            function ra(e) {
                return e < 0 ? Math.floor(e) : Math.ceil(e)
            }
            function ia() {
                var e, t, n, a, r, i = this._milliseconds, s = this._days, o = this._months, d = this._data;
                return i >= 0 && s >= 0 && o >= 0 || i <= 0 && s <= 0 && o <= 0 || (i += 864e5 * ra(oa(o) + s),
                s = 0,
                o = 0),
                d.milliseconds = i % 1e3,
                e = v(i / 1e3),
                d.seconds = e % 60,
                t = v(e / 60),
                d.minutes = t % 60,
                n = v(t / 60),
                d.hours = n % 24,
                s += v(n / 24),
                r = v(sa(s)),
                o += r,
                s -= ra(oa(r)),
                a = v(o / 12),
                o %= 12,
                d.days = s,
                d.months = o,
                d.years = a,
                this
            }
            function sa(e) {
                return 4800 * e / 146097
            }
            function oa(e) {
                return 146097 * e / 4800
            }
            function da(e) {
                if (!this.isValid())
                    return NaN;
                var t, n, a = this._milliseconds;
                if ("month" === (e = W(e)) || "year" === e)
                    return t = this._days + a / 864e5,
                    n = this._months + sa(t),
                    "month" === e ? n : n / 12;
                switch (t = this._days + Math.round(oa(this._months)),
                e) {
                case "week":
                    return t / 7 + a / 6048e5;
                case "day":
                    return t + a / 864e5;
                case "hour":
                    return 24 * t + a / 36e5;
                case "minute":
                    return 1440 * t + a / 6e4;
                case "second":
                    return 86400 * t + a / 1e3;
                case "millisecond":
                    return Math.floor(864e5 * t) + a;
                default:
                    throw new Error("Unknown unit " + e)
                }
            }
            function ua() {
                return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * Y(this._months / 12) : NaN
            }
            function _a(e) {
                return function() {
                    return this.as(e)
                }
            }
            function la(e) {
                return e = W(e),
                this.isValid() ? this[e + "s"]() : NaN
            }
            function ca(e) {
                return function() {
                    return this.isValid() ? this._data[e] : NaN
                }
            }
            function ma() {
                return v(this.days() / 7)
            }
            function fa(e, t, n, a, r) {
                return r.relativeTime(t || 1, !!n, e, a)
            }
            function ha(e, t, n) {
                var a = Ut(e).abs()
                  , r = Li(a.as("s"))
                  , i = Li(a.as("m"))
                  , s = Li(a.as("h"))
                  , o = Li(a.as("d"))
                  , d = Li(a.as("M"))
                  , u = Li(a.as("y"))
                  , _ = r <= vi.ss && ["s", r] || r < vi.s && ["ss", r] || i <= 1 && ["m"] || i < vi.m && ["mm", i] || s <= 1 && ["h"] || s < vi.h && ["hh", s] || o <= 1 && ["d"] || o < vi.d && ["dd", o] || d <= 1 && ["M"] || d < vi.M && ["MM", d] || u <= 1 && ["y"] || ["yy", u];
                return _[2] = t,
                _[3] = +e > 0,
                _[4] = n,
                fa.apply(null, _)
            }
            function pa(e) {
                return void 0 === e ? Li : "function" == typeof e && (Li = e,
                !0)
            }
            function Ma(e, t) {
                return void 0 !== vi[e] && (void 0 === t ? vi[e] : (vi[e] = t,
                "s" === e && (vi.ss = t - 1),
                !0))
            }
            function ya(e) {
                if (!this.isValid())
                    return this.localeData().invalidDate();
                var t = this.localeData()
                  , n = ha(this, !e, t);
                return e && (n = t.pastFuture(+this, n)),
                t.postformat(n)
            }
            function La() {
                if (!this.isValid())
                    return this.localeData().invalidDate();
                var e, t, n, a = Yi(this._milliseconds) / 1e3, r = Yi(this._days), i = Yi(this._months);
                e = v(a / 60),
                t = v(e / 60),
                a %= 60,
                e %= 60,
                n = v(i / 12),
                i %= 12;
                var s = n
                  , o = i
                  , d = r
                  , u = t
                  , _ = e
                  , l = a
                  , c = this.asSeconds();
                return c ? (c < 0 ? "-" : "") + "P" + (s ? s + "Y" : "") + (o ? o + "M" : "") + (d ? d + "D" : "") + (u || _ || l ? "T" : "") + (u ? u + "H" : "") + (_ ? _ + "M" : "") + (l ? l + "S" : "") : "P0D"
            }
            var va, Ya;
            Ya = Array.prototype.some ? Array.prototype.some : function(e) {
                for (var t = Object(this), n = t.length >>> 0, a = 0; a < n; a++)
                    if (a in t && e.call(this, t[a], a, t))
                        return !0;
                return !1
            }
            ;
            var ga = Ya
              , ka = t.momentProperties = []
              , Da = !1
              , wa = {};
            t.suppressDeprecationWarnings = !1,
            t.deprecationHandler = null;
            var Ta;
            Ta = Object.keys ? Object.keys : function(e) {
                var t, n = [];
                for (t in e)
                    _(e, t) && n.push(t);
                return n
            }
            ;
            var ba, Sa = Ta, ja = {
                sameDay: "[Today at] LT",
                nextDay: "[Tomorrow at] LT",
                nextWeek: "dddd [at] LT",
                lastDay: "[Yesterday at] LT",
                lastWeek: "[Last] dddd [at] LT",
                sameElse: "L"
            }, Ha = {
                LTS: "h:mm:ss A",
                LT: "h:mm A",
                L: "MM/DD/YYYY",
                LL: "MMMM D, YYYY",
                LLL: "MMMM D, YYYY h:mm A",
                LLLL: "dddd, MMMM D, YYYY h:mm A"
            }, xa = /\d{1,2}/, Oa = {
                future: "in %s",
                past: "%s ago",
                s: "a few seconds",
                ss: "%d seconds",
                m: "a minute",
                mm: "%d minutes",
                h: "an hour",
                hh: "%d hours",
                d: "a day",
                dd: "%d days",
                M: "a month",
                MM: "%d months",
                y: "a year",
                yy: "%d years"
            }, Pa = {}, Aa = {}, Ea = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g, Ca = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, Wa = {}, Fa = {}, $a = /\d/, Na = /\d\d/, za = /\d{3}/, Ra = /\d{4}/, Ia = /[+-]?\d{6}/, Ja = /\d\d?/, Ua = /\d\d\d\d?/, Ga = /\d\d\d\d\d\d?/, Va = /\d{1,3}/, Ba = /\d{1,4}/, qa = /[+-]?\d{1,6}/, Ka = /\d+/, Za = /[+-]?\d+/, Qa = /Z|[+-]\d\d:?\d\d/gi, Xa = /Z|[+-]\d\d(?::?\d\d)?/gi, er = /[+-]?\d+(\.\d{1,3})?/, tr = /[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i, nr = {}, ar = {}, rr = 0, ir = 1, sr = 2, or = 3, dr = 4, ur = 5, _r = 6, lr = 7, cr = 8;
            ba = Array.prototype.indexOf ? Array.prototype.indexOf : function(e) {
                var t;
                for (t = 0; t < this.length; ++t)
                    if (this[t] === e)
                        return t;
                return -1
            }
            ;
            var mr = ba;
            V("M", ["MM", 2], "Mo", function() {
                return this.month() + 1
            }),
            V("MMM", 0, 0, function(e) {
                return this.localeData().monthsShort(this, e)
            }),
            V("MMMM", 0, 0, function(e) {
                return this.localeData().months(this, e)
            }),
            C("month", "M"),
            $("month", 8),
            Q("M", Ja),
            Q("MM", Ja, Na),
            Q("MMM", function(e, t) {
                return t.monthsShortRegex(e)
            }),
            Q("MMMM", function(e, t) {
                return t.monthsRegex(e)
            }),
            ne(["M", "MM"], function(e, t) {
                t[ir] = Y(e) - 1
            }),
            ne(["MMM", "MMMM"], function(e, t, n, a) {
                var r = n._locale.monthsParse(e, a, n._strict);
                null != r ? t[ir] = r : f(n).invalidMonth = e
            });
            var fr = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/
              , hr = "January_February_March_April_May_June_July_August_September_October_November_December".split("_")
              , pr = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_")
              , Mr = tr
              , yr = tr;
            V("Y", 0, 0, function() {
                var e = this.year();
                return e <= 9999 ? "" + e : "+" + e
            }),
            V(0, ["YY", 2], 0, function() {
                return this.year() % 100
            }),
            V(0, ["YYYY", 4], 0, "year"),
            V(0, ["YYYYY", 5], 0, "year"),
            V(0, ["YYYYYY", 6, !0], 0, "year"),
            C("year", "y"),
            $("year", 1),
            Q("Y", Za),
            Q("YY", Ja, Na),
            Q("YYYY", Ba, Ra),
            Q("YYYYY", qa, Ia),
            Q("YYYYYY", qa, Ia),
            ne(["YYYYY", "YYYYYY"], rr),
            ne("YYYY", function(e, n) {
                n[rr] = 2 === e.length ? t.parseTwoDigitYear(e) : Y(e)
            }),
            ne("YY", function(e, n) {
                n[rr] = t.parseTwoDigitYear(e)
            }),
            ne("Y", function(e, t) {
                t[rr] = parseInt(e, 10)
            }),
            t.parseTwoDigitYear = function(e) {
                return Y(e) + (Y(e) > 68 ? 1900 : 2e3)
            }
            ;
            var Lr = z("FullYear", !0);
            V("w", ["ww", 2], "wo", "week"),
            V("W", ["WW", 2], "Wo", "isoWeek"),
            C("week", "w"),
            C("isoWeek", "W"),
            $("week", 5),
            $("isoWeek", 5),
            Q("w", Ja),
            Q("ww", Ja, Na),
            Q("W", Ja),
            Q("WW", Ja, Na),
            ae(["w", "ww", "W", "WW"], function(e, t, n, a) {
                t[a.substr(0, 1)] = Y(e)
            });
            var vr = {
                dow: 0,
                doy: 6
            };
            V("d", 0, "do", "day"),
            V("dd", 0, 0, function(e) {
                return this.localeData().weekdaysMin(this, e)
            }),
            V("ddd", 0, 0, function(e) {
                return this.localeData().weekdaysShort(this, e)
            }),
            V("dddd", 0, 0, function(e) {
                return this.localeData().weekdays(this, e)
            }),
            V("e", 0, 0, "weekday"),
            V("E", 0, 0, "isoWeekday"),
            C("day", "d"),
            C("weekday", "e"),
            C("isoWeekday", "E"),
            $("day", 11),
            $("weekday", 11),
            $("isoWeekday", 11),
            Q("d", Ja),
            Q("e", Ja),
            Q("E", Ja),
            Q("dd", function(e, t) {
                return t.weekdaysMinRegex(e)
            }),
            Q("ddd", function(e, t) {
                return t.weekdaysShortRegex(e)
            }),
            Q("dddd", function(e, t) {
                return t.weekdaysRegex(e)
            }),
            ae(["dd", "ddd", "dddd"], function(e, t, n, a) {
                var r = n._locale.weekdaysParse(e, a, n._strict);
                null != r ? t.d = r : f(n).invalidWeekday = e
            }),
            ae(["d", "e", "E"], function(e, t, n, a) {
                t[a] = Y(e)
            });
            var Yr = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_")
              , gr = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_")
              , kr = "Su_Mo_Tu_We_Th_Fr_Sa".split("_")
              , Dr = tr
              , wr = tr
              , Tr = tr;
            V("H", ["HH", 2], 0, "hour"),
            V("h", ["hh", 2], 0, Je),
            V("k", ["kk", 2], 0, Ue),
            V("hmm", 0, 0, function() {
                return "" + Je.apply(this) + G(this.minutes(), 2)
            }),
            V("hmmss", 0, 0, function() {
                return "" + Je.apply(this) + G(this.minutes(), 2) + G(this.seconds(), 2)
            }),
            V("Hmm", 0, 0, function() {
                return "" + this.hours() + G(this.minutes(), 2)
            }),
            V("Hmmss", 0, 0, function() {
                return "" + this.hours() + G(this.minutes(), 2) + G(this.seconds(), 2)
            }),
            Ge("a", !0),
            Ge("A", !1),
            C("hour", "h"),
            $("hour", 13),
            Q("a", Ve),
            Q("A", Ve),
            Q("H", Ja),
            Q("h", Ja),
            Q("k", Ja),
            Q("HH", Ja, Na),
            Q("hh", Ja, Na),
            Q("kk", Ja, Na),
            Q("hmm", Ua),
            Q("hmmss", Ga),
            Q("Hmm", Ua),
            Q("Hmmss", Ga),
            ne(["H", "HH"], or),
            ne(["k", "kk"], function(e, t, n) {
                var a = Y(e);
                t[or] = 24 === a ? 0 : a
            }),
            ne(["a", "A"], function(e, t, n) {
                n._isPm = n._locale.isPM(e),
                n._meridiem = e
            }),
            ne(["h", "hh"], function(e, t, n) {
                t[or] = Y(e),
                f(n).bigHour = !0
            }),
            ne("hmm", function(e, t, n) {
                var a = e.length - 2;
                t[or] = Y(e.substr(0, a)),
                t[dr] = Y(e.substr(a)),
                f(n).bigHour = !0
            }),
            ne("hmmss", function(e, t, n) {
                var a = e.length - 4
                  , r = e.length - 2;
                t[or] = Y(e.substr(0, a)),
                t[dr] = Y(e.substr(a, 2)),
                t[ur] = Y(e.substr(r)),
                f(n).bigHour = !0
            }),
            ne("Hmm", function(e, t, n) {
                var a = e.length - 2;
                t[or] = Y(e.substr(0, a)),
                t[dr] = Y(e.substr(a))
            }),
            ne("Hmmss", function(e, t, n) {
                var a = e.length - 4
                  , r = e.length - 2;
                t[or] = Y(e.substr(0, a)),
                t[dr] = Y(e.substr(a, 2)),
                t[ur] = Y(e.substr(r))
            });
            var br, Sr = /[ap]\.?m?\.?/i, jr = z("Hours", !0), Hr = {
                calendar: ja,
                longDateFormat: Ha,
                invalidDate: "Invalid date",
                ordinal: "%d",
                dayOfMonthOrdinalParse: xa,
                relativeTime: Oa,
                months: hr,
                monthsShort: pr,
                week: vr,
                weekdays: Yr,
                weekdaysMin: kr,
                weekdaysShort: gr,
                meridiemParse: Sr
            }, xr = {}, Or = {}, Pr = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/, Ar = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/, Er = /Z|[+-]\d\d(?::?\d\d)?/, Cr = [["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/], ["YYYY-MM-DD", /\d{4}-\d\d-\d\d/], ["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/], ["GGGG-[W]WW", /\d{4}-W\d\d/, !1], ["YYYY-DDD", /\d{4}-\d{3}/], ["YYYY-MM", /\d{4}-\d\d/, !1], ["YYYYYYMMDD", /[+-]\d{10}/], ["YYYYMMDD", /\d{8}/], ["GGGG[W]WWE", /\d{4}W\d{3}/], ["GGGG[W]WW", /\d{4}W\d{2}/, !1], ["YYYYDDD", /\d{7}/]], Wr = [["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/], ["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/], ["HH:mm:ss", /\d\d:\d\d:\d\d/], ["HH:mm", /\d\d:\d\d/], ["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/], ["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/], ["HHmmss", /\d\d\d\d\d\d/], ["HHmm", /\d\d\d\d/], ["HH", /\d\d/]], Fr = /^\/?Date\((\-?\d+)/i, $r = /^((?:Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d?\d\s(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(?:\d\d)?\d\d\s)(\d\d:\d\d)(\:\d\d)?(\s(?:UT|GMT|[ECMP][SD]T|[A-IK-Za-ik-z]|[+-]\d{4}))$/;
            t.createFromInputFallback = D("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function(e) {
                e._d = new Date(e._i + (e._useUTC ? " UTC" : ""))
            }),
            t.ISO_8601 = function() {}
            ,
            t.RFC_2822 = function() {}
            ;
            var Nr = D("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function() {
                var e = vt.apply(null, arguments);
                return this.isValid() && e.isValid() ? e < this ? this : e : p()
            })
              , zr = D("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function() {
                var e = vt.apply(null, arguments);
                return this.isValid() && e.isValid() ? e > this ? this : e : p()
            })
              , Rr = function() {
                return Date.now ? Date.now() : +new Date
            }
              , Ir = ["year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond"];
            Ht("Z", ":"),
            Ht("ZZ", ""),
            Q("Z", Xa),
            Q("ZZ", Xa),
            ne(["Z", "ZZ"], function(e, t, n) {
                n._useUTC = !0,
                n._tzm = xt(Xa, e)
            });
            var Jr = /([\+\-]|\d\d)/gi;
            t.updateOffset = function() {}
            ;
            var Ur = /^(\-)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/
              , Gr = /^(-)?P(?:(-?[0-9,.]*)Y)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)W)?(?:(-?[0-9,.]*)D)?(?:T(?:(-?[0-9,.]*)H)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)S)?)?$/;
            Ut.fn = bt.prototype,
            Ut.invalid = Tt;
            var Vr = qt(1, "add")
              , Br = qt(-1, "subtract");
            t.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ",
            t.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]";
            var qr = D("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function(e) {
                return void 0 === e ? this.localeData() : this.locale(e)
            });
            V(0, ["gg", 2], 0, function() {
                return this.weekYear() % 100
            }),
            V(0, ["GG", 2], 0, function() {
                return this.isoWeekYear() % 100
            }),
            xn("gggg", "weekYear"),
            xn("ggggg", "weekYear"),
            xn("GGGG", "isoWeekYear"),
            xn("GGGGG", "isoWeekYear"),
            C("weekYear", "gg"),
            C("isoWeekYear", "GG"),
            $("weekYear", 1),
            $("isoWeekYear", 1),
            Q("G", Za),
            Q("g", Za),
            Q("GG", Ja, Na),
            Q("gg", Ja, Na),
            Q("GGGG", Ba, Ra),
            Q("gggg", Ba, Ra),
            Q("GGGGG", qa, Ia),
            Q("ggggg", qa, Ia),
            ae(["gggg", "ggggg", "GGGG", "GGGGG"], function(e, t, n, a) {
                t[a.substr(0, 2)] = Y(e)
            }),
            ae(["gg", "GG"], function(e, n, a, r) {
                n[r] = t.parseTwoDigitYear(e)
            }),
            V("Q", 0, "Qo", "quarter"),
            C("quarter", "Q"),
            $("quarter", 7),
            Q("Q", $a),
            ne("Q", function(e, t) {
                t[ir] = 3 * (Y(e) - 1)
            }),
            V("D", ["DD", 2], "Do", "date"),
            C("date", "D"),
            $("date", 9),
            Q("D", Ja),
            Q("DD", Ja, Na),
            Q("Do", function(e, t) {
                return e ? t._dayOfMonthOrdinalParse || t._ordinalParse : t._dayOfMonthOrdinalParseLenient
            }),
            ne(["D", "DD"], sr),
            ne("Do", function(e, t) {
                t[sr] = Y(e.match(Ja)[0], 10)
            });
            var Kr = z("Date", !0);
            V("DDD", ["DDDD", 3], "DDDo", "dayOfYear"),
            C("dayOfYear", "DDD"),
            $("dayOfYear", 4),
            Q("DDD", Va),
            Q("DDDD", za),
            ne(["DDD", "DDDD"], function(e, t, n) {
                n._dayOfYear = Y(e)
            }),
            V("m", ["mm", 2], 0, "minute"),
            C("minute", "m"),
            $("minute", 14),
            Q("m", Ja),
            Q("mm", Ja, Na),
            ne(["m", "mm"], dr);
            var Zr = z("Minutes", !1);
            V("s", ["ss", 2], 0, "second"),
            C("second", "s"),
            $("second", 15),
            Q("s", Ja),
            Q("ss", Ja, Na),
            ne(["s", "ss"], ur);
            var Qr = z("Seconds", !1);
            V("S", 0, 0, function() {
                return ~~(this.millisecond() / 100)
            }),
            V(0, ["SS", 2], 0, function() {
                return ~~(this.millisecond() / 10)
            }),
            V(0, ["SSS", 3], 0, "millisecond"),
            V(0, ["SSSS", 4], 0, function() {
                return 10 * this.millisecond()
            }),
            V(0, ["SSSSS", 5], 0, function() {
                return 100 * this.millisecond()
            }),
            V(0, ["SSSSSS", 6], 0, function() {
                return 1e3 * this.millisecond()
            }),
            V(0, ["SSSSSSS", 7], 0, function() {
                return 1e4 * this.millisecond()
            }),
            V(0, ["SSSSSSSS", 8], 0, function() {
                return 1e5 * this.millisecond()
            }),
            V(0, ["SSSSSSSSS", 9], 0, function() {
                return 1e6 * this.millisecond()
            }),
            C("millisecond", "ms"),
            $("millisecond", 16),
            Q("S", Va, $a),
            Q("SS", Va, Na),
            Q("SSS", Va, za);
            var Xr;
            for (Xr = "SSSS"; Xr.length <= 9; Xr += "S")
                Q(Xr, Ka);
            for (Xr = "S"; Xr.length <= 9; Xr += "S")
                ne(Xr, Nn);
            var ei = z("Milliseconds", !1);
            V("z", 0, 0, "zoneAbbr"),
            V("zz", 0, 0, "zoneName");
            var ti = y.prototype;
            ti.add = Vr,
            ti.calendar = Qt,
            ti.clone = Xt,
            ti.diff = on,
            ti.endOf = vn,
            ti.format = cn,
            ti.from = mn,
            ti.fromNow = fn,
            ti.to = hn,
            ti.toNow = pn,
            ti.get = J,
            ti.invalidAt = jn,
            ti.isAfter = en,
            ti.isBefore = tn,
            ti.isBetween = nn,
            ti.isSame = an,
            ti.isSameOrAfter = rn,
            ti.isSameOrBefore = sn,
            ti.isValid = bn,
            ti.lang = qr,
            ti.locale = Mn,
            ti.localeData = yn,
            ti.max = zr,
            ti.min = Nr,
            ti.parsingFlags = Sn,
            ti.set = U,
            ti.startOf = Ln,
            ti.subtract = Br,
            ti.toArray = Dn,
            ti.toObject = wn,
            ti.toDate = kn,
            ti.toISOString = _n,
            ti.inspect = ln,
            ti.toJSON = Tn,
            ti.toString = un,
            ti.unix = gn,
            ti.valueOf = Yn,
            ti.creationData = Hn,
            ti.year = Lr,
            ti.isLeapYear = ye,
            ti.weekYear = On,
            ti.isoWeekYear = Pn,
            ti.quarter = ti.quarters = Fn,
            ti.month = le,
            ti.daysInMonth = ce,
            ti.week = ti.weeks = Se,
            ti.isoWeek = ti.isoWeeks = je,
            ti.weeksInYear = En,
            ti.isoWeeksInYear = An,
            ti.date = Kr,
            ti.day = ti.days = We,
            ti.weekday = Fe,
            ti.isoWeekday = $e,
            ti.dayOfYear = $n,
            ti.hour = ti.hours = jr,
            ti.minute = ti.minutes = Zr,
            ti.second = ti.seconds = Qr,
            ti.millisecond = ti.milliseconds = ei,
            ti.utcOffset = At,
            ti.utc = Ct,
            ti.local = Wt,
            ti.parseZone = Ft,
            ti.hasAlignedHourOffset = $t,
            ti.isDST = Nt,
            ti.isLocal = Rt,
            ti.isUtcOffset = It,
            ti.isUtc = Jt,
            ti.isUTC = Jt,
            ti.zoneAbbr = zn,
            ti.zoneName = Rn,
            ti.dates = D("dates accessor is deprecated. Use date instead.", Kr),
            ti.months = D("months accessor is deprecated. Use month instead", le),
            ti.years = D("years accessor is deprecated. Use year instead", Lr),
            ti.zone = D("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", Et),
            ti.isDSTShifted = D("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", zt);
            var ni = j.prototype;
            ni.calendar = H,
            ni.longDateFormat = x,
            ni.invalidDate = O,
            ni.ordinal = P,
            ni.preparse = Un,
            ni.postformat = Un,
            ni.relativeTime = A,
            ni.pastFuture = E,
            ni.set = b,
            ni.months = se,
            ni.monthsShort = oe,
            ni.monthsParse = ue,
            ni.monthsRegex = fe,
            ni.monthsShortRegex = me,
            ni.week = we,
            ni.firstDayOfYear = be,
            ni.firstDayOfWeek = Te,
            ni.weekdays = Oe,
            ni.weekdaysMin = Ae,
            ni.weekdaysShort = Pe,
            ni.weekdaysParse = Ce,
            ni.weekdaysRegex = Ne,
            ni.weekdaysShortRegex = ze,
            ni.weekdaysMinRegex = Re,
            ni.isPM = Be,
            ni.meridiem = qe,
            Xe("en", {
                dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
                ordinal: function(e) {
                    var t = e % 10;
                    return e + (1 === Y(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
                }
            }),
            t.lang = D("moment.lang is deprecated. Use moment.locale instead.", Xe),
            t.langData = D("moment.langData is deprecated. Use moment.localeData instead.", nt);
            var ai = Math.abs
              , ri = _a("ms")
              , ii = _a("s")
              , si = _a("m")
              , oi = _a("h")
              , di = _a("d")
              , ui = _a("w")
              , _i = _a("M")
              , li = _a("y")
              , ci = ca("milliseconds")
              , mi = ca("seconds")
              , fi = ca("minutes")
              , hi = ca("hours")
              , pi = ca("days")
              , Mi = ca("months")
              , yi = ca("years")
              , Li = Math.round
              , vi = {
                ss: 44,
                s: 45,
                m: 45,
                h: 22,
                d: 26,
                M: 11
            }
              , Yi = Math.abs
              , gi = bt.prototype;
            return gi.isValid = wt,
            gi.abs = ea,
            gi.add = na,
            gi.subtract = aa,
            gi.as = da,
            gi.asMilliseconds = ri,
            gi.asSeconds = ii,
            gi.asMinutes = si,
            gi.asHours = oi,
            gi.asDays = di,
            gi.asWeeks = ui,
            gi.asMonths = _i,
            gi.asYears = li,
            gi.valueOf = ua,
            gi._bubble = ia,
            gi.get = la,
            gi.milliseconds = ci,
            gi.seconds = mi,
            gi.minutes = fi,
            gi.hours = hi,
            gi.days = pi,
            gi.weeks = ma,
            gi.months = Mi,
            gi.years = yi,
            gi.humanize = ya,
            gi.toISOString = La,
            gi.toString = La,
            gi.toJSON = La,
            gi.locale = Mn,
            gi.localeData = yn,
            gi.toIsoString = D("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", La),
            gi.lang = qr,
            V("X", 0, 0, "unix"),
            V("x", 0, 0, "valueOf"),
            Q("x", Za),
            Q("X", er),
            ne("X", function(e, t, n) {
                n._d = new Date(1e3 * parseFloat(e, 10))
            }),
            ne("x", function(e, t, n) {
                n._d = new Date(Y(e))
            }),
            t.version = "2.18.1",
            function(e) {
                va = e
            }(vt),
            t.fn = ti,
            t.min = gt,
            t.max = kt,
            t.now = Rr,
            t.utc = c,
            t.unix = In,
            t.months = qn,
            t.isDate = d,
            t.locale = Xe,
            t.invalid = p,
            t.duration = Ut,
            t.isMoment = L,
            t.weekdays = Zn,
            t.parseZone = Jn,
            t.localeData = nt,
            t.isDuration = St,
            t.monthsShort = Kn,
            t.weekdaysMin = Xn,
            t.defineLocale = et,
            t.updateLocale = tt,
            t.locales = at,
            t.weekdaysShort = Qn,
            t.normalizeUnits = W,
            t.relativeTimeRounding = pa,
            t.relativeTimeThreshold = Ma,
            t.calendarFormat = Zt,
            t.prototype = ti,
            t
        })
    }
    ).call(t, n(153)(e))
}
, function(e, t, n) {
    "use strict";
    function a(e) {
        return "[object Array]" === D.call(e)
    }
    function r(e) {
        return "[object ArrayBuffer]" === D.call(e)
    }
    function i(e) {
        return "undefined" != typeof FormData && e instanceof FormData
    }
    function s(e) {
        return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer
    }
    function o(e) {
        return "string" == typeof e
    }
    function d(e) {
        return "number" == typeof e
    }
    function u(e) {
        return void 0 === e
    }
    function _(e) {
        return null !== e && "object" == typeof e
    }
    function l(e) {
        return "[object Date]" === D.call(e)
    }
    function c(e) {
        return "[object File]" === D.call(e)
    }
    function m(e) {
        return "[object Blob]" === D.call(e)
    }
    function f(e) {
        return "[object Function]" === D.call(e)
    }
    function h(e) {
        return _(e) && f(e.pipe)
    }
    function p(e) {
        return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams
    }
    function M(e) {
        return e.replace(/^\s*/, "").replace(/\s*$/, "")
    }
    function y() {
        return ("undefined" == typeof navigator || "ReactNative" !== navigator.product) && ("undefined" != typeof window && "undefined" != typeof document)
    }
    function L(e, t) {
        if (null !== e && void 0 !== e)
            if ("object" == typeof e || a(e) || (e = [e]),
            a(e))
                for (var n = 0, r = e.length; n < r; n++)
                    t.call(null, e[n], n, e);
            else
                for (var i in e)
                    Object.prototype.hasOwnProperty.call(e, i) && t.call(null, e[i], i, e)
    }
    function v() {
        function e(e, n) {
            "object" == typeof t[n] && "object" == typeof e ? t[n] = v(t[n], e) : t[n] = e
        }
        for (var t = {}, n = 0, a = arguments.length; n < a; n++)
            L(arguments[n], e);
        return t
    }
    function Y(e, t, n) {
        return L(t, function(t, a) {
            e[a] = n && "function" == typeof t ? g(t, n) : t
        }),
        e
    }
    var g = n(3)
      , k = n(131)
      , D = Object.prototype.toString;
    e.exports = {
        isArray: a,
        isArrayBuffer: r,
        isBuffer: k,
        isFormData: i,
        isArrayBufferView: s,
        isString: o,
        isNumber: d,
        isObject: _,
        isUndefined: u,
        isDate: l,
        isFile: c,
        isBlob: m,
        isFunction: f,
        isStream: h,
        isURLSearchParams: p,
        isStandardBrowserEnv: y,
        forEach: L,
        merge: v,
        extend: Y,
        trim: M
    }
}
, function(e, t, n) {
    "use strict";
    (function(t) {
        function a(e, t) {
            !r.isUndefined(e) && r.isUndefined(e["Content-Type"]) && (e["Content-Type"] = t)
        }
        var r = n(1)
          , i = n(134)
          , s = {
            "Content-Type": "application/x-www-form-urlencoded"
        }
          , o = {
            adapter: function() {
                var e;
                return "undefined" != typeof XMLHttpRequest ? e = n(4) : void 0 !== t && (e = n(4)),
                e
            }(),
            transformRequest: [function(e, t) {
                return i(t, "Content-Type"),
                r.isFormData(e) || r.isArrayBuffer(e) || r.isBuffer(e) || r.isStream(e) || r.isFile(e) || r.isBlob(e) ? e : r.isArrayBufferView(e) ? e.buffer : r.isURLSearchParams(e) ? (a(t, "application/x-www-form-urlencoded;charset=utf-8"),
                e.toString()) : r.isObject(e) ? (a(t, "application/json;charset=utf-8"),
                JSON.stringify(e)) : e
            }
            ],
            transformResponse: [function(e) {
                if ("string" == typeof e)
                    try {
                        e = JSON.parse(e)
                    } catch (e) {}
                return e
            }
            ],
            timeout: 0,
            xsrfCookieName: "XSRF-TOKEN",
            xsrfHeaderName: "X-XSRF-TOKEN",
            maxContentLength: -1,
            validateStatus: function(e) {
                return e >= 200 && e < 300
            }
        };
        o.headers = {
            common: {
                Accept: "application/json, text/plain, */*"
            }
        },
        r.forEach(["delete", "get", "head"], function(e) {
            o.headers[e] = {}
        }),
        r.forEach(["post", "put", "patch"], function(e) {
            o.headers[e] = r.merge(s)
        }),
        e.exports = o
    }
    ).call(t, n(133))
}
, function(e, t, n) {
    "use strict";
    e.exports = function(e, t) {
        return function() {
            for (var n = new Array(arguments.length), a = 0; a < n.length; a++)
                n[a] = arguments[a];
            return e.apply(t, n)
        }
    }
}
, function(e, t, n) {
    "use strict";
    var a = n(1)
      , r = n(135)
      , i = n(137)
      , s = n(138)
      , o = n(139)
      , d = n(5)
      , u = "undefined" != typeof window && window.btoa && window.btoa.bind(window) || n(140);
    e.exports = function(e) {
        return new Promise(function(t, _) {
            var l = e.data
              , c = e.headers;
            a.isFormData(l) && delete c["Content-Type"];
            var m = new XMLHttpRequest
              , f = "onreadystatechange"
              , h = !1;
            if ("undefined" == typeof window || !window.XDomainRequest || "withCredentials"in m || o(e.url) || (m = new window.XDomainRequest,
            f = "onload",
            h = !0,
            m.onprogress = function() {}
            ,
            m.ontimeout = function() {}
            ),
            e.auth) {
                var p = e.auth.username || ""
                  , M = e.auth.password || "";
                c.Authorization = "Basic " + u(p + ":" + M)
            }
            if (m.open(e.method.toUpperCase(), i(e.url, e.params, e.paramsSerializer), !0),
            m.timeout = e.timeout,
            m[f] = function() {
                if (m && (4 === m.readyState || h) && (0 !== m.status || m.responseURL && 0 === m.responseURL.indexOf("file:"))) {
                    var n = "getAllResponseHeaders"in m ? s(m.getAllResponseHeaders()) : null
                      , a = e.responseType && "text" !== e.responseType ? m.response : m.responseText
                      , i = {
                        data: a,
                        status: 1223 === m.status ? 204 : m.status,
                        statusText: 1223 === m.status ? "No Content" : m.statusText,
                        headers: n,
                        config: e,
                        request: m
                    };
                    r(t, _, i),
                    m = null
                }
            }
            ,
            m.onerror = function() {
                _(d("Network Error", e, null, m)),
                m = null
            }
            ,
            m.ontimeout = function() {
                _(d("timeout of " + e.timeout + "ms exceeded", e, "ECONNABORTED", m)),
                m = null
            }
            ,
            a.isStandardBrowserEnv()) {
                var y = n(141)
                  , L = (e.withCredentials || o(e.url)) && e.xsrfCookieName ? y.read(e.xsrfCookieName) : void 0;
                L && (c[e.xsrfHeaderName] = L)
            }
            if ("setRequestHeader"in m && a.forEach(c, function(e, t) {
                void 0 === l && "content-type" === t.toLowerCase() ? delete c[t] : m.setRequestHeader(t, e)
            }),
            e.withCredentials && (m.withCredentials = !0),
            e.responseType)
                try {
                    m.responseType = e.responseType
                } catch (t) {
                    if ("json" !== e.responseType)
                        throw t
                }
            "function" == typeof e.onDownloadProgress && m.addEventListener("progress", e.onDownloadProgress),
            "function" == typeof e.onUploadProgress && m.upload && m.upload.addEventListener("progress", e.onUploadProgress),
            e.cancelToken && e.cancelToken.promise.then(function(e) {
                m && (m.abort(),
                _(e),
                m = null)
            }),
            void 0 === l && (l = null),
            m.send(l)
        }
        )
    }
}
, function(e, t, n) {
    "use strict";
    var a = n(136);
    e.exports = function(e, t, n, r, i) {
        var s = new Error(e);
        return a(s, t, n, r, i)
    }
}
, function(e, t, n) {
    "use strict";
    e.exports = function(e) {
        return !(!e || !e.__CANCEL__)
    }
}
, function(e, t, n) {
    "use strict";
    function a(e) {
        this.message = e
    }
    a.prototype.toString = function() {
        return "Cancel" + (this.message ? ": " + this.message : "")
    }
    ,
    a.prototype.__CANCEL__ = !0,
    e.exports = a
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("af", {
            months: "Januarie_Februarie_Maart_April_Mei_Junie_Julie_Augustus_September_Oktober_November_Desember".split("_"),
            monthsShort: "Jan_Feb_Mrt_Apr_Mei_Jun_Jul_Aug_Sep_Okt_Nov_Des".split("_"),
            weekdays: "Sondag_Maandag_Dinsdag_Woensdag_Donderdag_Vrydag_Saterdag".split("_"),
            weekdaysShort: "Son_Maa_Din_Woe_Don_Vry_Sat".split("_"),
            weekdaysMin: "So_Ma_Di_Wo_Do_Vr_Sa".split("_"),
            meridiemParse: /vm|nm/i,
            isPM: function(e) {
                return /^nm$/i.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 12 ? n ? "vm" : "VM" : n ? "nm" : "NM"
            },
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Vandag om] LT",
                nextDay: "[M??re om] LT",
                nextWeek: "dddd [om] LT",
                lastDay: "[Gister om] LT",
                lastWeek: "[Laas] dddd [om] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "oor %s",
                past: "%s gelede",
                s: "'n paar sekondes",
                m: "'n minuut",
                mm: "%d minute",
                h: "'n uur",
                hh: "%d ure",
                d: "'n dag",
                dd: "%d dae",
                M: "'n maand",
                MM: "%d maande",
                y: "'n jaar",
                yy: "%d jaar"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
            ordinal: function(e) {
                return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "??",
            2: "??",
            3: "??",
            4: "??",
            5: "??",
            6: "??",
            7: "??",
            8: "??",
            9: "??",
            0: "??"
        }
          , n = {
            "??": "1",
            "??": "2",
            "??": "3",
            "??": "4",
            "??": "5",
            "??": "6",
            "??": "7",
            "??": "8",
            "??": "9",
            "??": "0"
        }
          , a = function(e) {
            return 0 === e ? 0 : 1 === e ? 1 : 2 === e ? 2 : e % 100 >= 3 && e % 100 <= 10 ? 3 : e % 100 >= 11 ? 4 : 5
        }
          , r = {
            s: ["?????? ???? ??????????", "?????????? ??????????", ["??????????????", "??????????????"], "%d ????????", "%d ??????????", "%d ??????????"],
            m: ["?????? ???? ??????????", "?????????? ??????????", ["??????????????", "??????????????"], "%d ??????????", "%d ??????????", "%d ??????????"],
            h: ["?????? ???? ????????", "???????? ??????????", ["????????????", "????????????"], "%d ??????????", "%d ????????", "%d ????????"],
            d: ["?????? ???? ??????", "?????? ????????", ["??????????", "??????????"], "%d ????????", "%d ??????????", "%d ??????"],
            M: ["?????? ???? ??????", "?????? ????????", ["??????????", "??????????"], "%d ????????", "%d ????????", "%d ??????"],
            y: ["?????? ???? ??????", "?????? ????????", ["??????????", "??????????"], "%d ??????????", "%d ??????????", "%d ??????"]
        }
          , i = function(e) {
            return function(t, n, i, s) {
                var o = a(t)
                  , d = r[e][a(t)];
                return 2 === o && (d = d[n ? 0 : 1]),
                d.replace(/%d/i, t)
            }
        }
          , s = ["?????????? ???????????? ??????????", "???????? ????????????", "???????? ????????", "?????????? ??????????", "???????? ????????", "???????????? ??????????", "???????? ??????????", "???? ??????????", "?????????? ????????????", "?????????? ?????????? ????????????", "?????????? ???????????? ????????????", "?????????? ?????????? ????????????"];
        return e.defineLocale("ar", {
            months: s,
            monthsShort: s,
            weekdays: "??????????_??????????????_????????????????_????????????????_????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????????_????????????_????????????_????????_????????_??????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "D/???M/???YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            meridiemParse: /??|??/,
            isPM: function(e) {
                return "??" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??" : "??"
            },
            calendar: {
                sameDay: "[?????????? ?????? ????????????] LT",
                nextDay: "[???????? ?????? ????????????] LT",
                nextWeek: "dddd [?????? ????????????] LT",
                lastDay: "[?????? ?????? ????????????] LT",
                lastWeek: "dddd [?????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "?????? %s",
                past: "?????? %s",
                s: i("s"),
                m: i("m"),
                mm: i("m"),
                h: i("h"),
                hh: i("h"),
                d: i("d"),
                dd: i("d"),
                M: i("M"),
                MM: i("M"),
                y: i("y"),
                yy: i("y")
            },
            preparse: function(e) {
                return e.replace(/\u200f/g, "").replace(/[????????????????????]/g, function(e) {
                    return n[e]
                }).replace(/??/g, ",")
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                }).replace(/,/g, "??")
            },
            week: {
                dow: 6,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ar-dz", {
            months: "??????????_??????????_????????_??????????_??????_????????_????????????_??????_????????????_????????????_????????????_????????????".split("_"),
            monthsShort: "??????????_??????????_????????_??????????_??????_????????_????????????_??????_????????????_????????????_????????????_????????????".split("_"),
            weekdays: "??????????_??????????????_????????????????_????????????????_????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????????_????????????_????????????_????????_????????_??????".split("_"),
            weekdaysMin: "????_????_??????_????_????_????_????".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ?????? ????????????] LT",
                nextDay: "[?????? ?????? ????????????] LT",
                nextWeek: "dddd [?????? ????????????] LT",
                lastDay: "[?????? ?????? ????????????] LT",
                lastWeek: "dddd [?????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "?????? %s",
                s: "????????",
                m: "??????????",
                mm: "%d ??????????",
                h: "????????",
                hh: "%d ??????????",
                d: "??????",
                dd: "%d ????????",
                M: "??????",
                MM: "%d ????????",
                y: "??????",
                yy: "%d ??????????"
            },
            week: {
                dow: 0,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ar-kw", {
            months: "??????????_????????????_????????_??????????_??????_??????????_????????????_??????_??????????_????????????_??????????_??????????".split("_"),
            monthsShort: "??????????_????????????_????????_??????????_??????_??????????_????????????_??????_??????????_????????????_??????????_??????????".split("_"),
            weekdays: "??????????_??????????????_????????????????_????????????????_????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????????_????????????_????????????_????????_????????_??????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ?????? ????????????] LT",
                nextDay: "[?????? ?????? ????????????] LT",
                nextWeek: "dddd [?????? ????????????] LT",
                lastDay: "[?????? ?????? ????????????] LT",
                lastWeek: "dddd [?????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "?????? %s",
                s: "????????",
                m: "??????????",
                mm: "%d ??????????",
                h: "????????",
                hh: "%d ??????????",
                d: "??????",
                dd: "%d ????????",
                M: "??????",
                MM: "%d ????????",
                y: "??????",
                yy: "%d ??????????"
            },
            week: {
                dow: 0,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "1",
            2: "2",
            3: "3",
            4: "4",
            5: "5",
            6: "6",
            7: "7",
            8: "8",
            9: "9",
            0: "0"
        }
          , n = function(e) {
            return 0 === e ? 0 : 1 === e ? 1 : 2 === e ? 2 : e % 100 >= 3 && e % 100 <= 10 ? 3 : e % 100 >= 11 ? 4 : 5
        }
          , a = {
            s: ["?????? ???? ??????????", "?????????? ??????????", ["??????????????", "??????????????"], "%d ????????", "%d ??????????", "%d ??????????"],
            m: ["?????? ???? ??????????", "?????????? ??????????", ["??????????????", "??????????????"], "%d ??????????", "%d ??????????", "%d ??????????"],
            h: ["?????? ???? ????????", "???????? ??????????", ["????????????", "????????????"], "%d ??????????", "%d ????????", "%d ????????"],
            d: ["?????? ???? ??????", "?????? ????????", ["??????????", "??????????"], "%d ????????", "%d ??????????", "%d ??????"],
            M: ["?????? ???? ??????", "?????? ????????", ["??????????", "??????????"], "%d ????????", "%d ????????", "%d ??????"],
            y: ["?????? ???? ??????", "?????? ????????", ["??????????", "??????????"], "%d ??????????", "%d ??????????", "%d ??????"]
        }
          , r = function(e) {
            return function(t, r, i, s) {
                var o = n(t)
                  , d = a[e][n(t)];
                return 2 === o && (d = d[r ? 0 : 1]),
                d.replace(/%d/i, t)
            }
        }
          , i = ["??????????", "????????????", "????????", "??????????", "????????", "??????????", "??????????", "??????????", "????????????", "????????????", "????????????", "????????????"];
        return e.defineLocale("ar-ly", {
            months: i,
            monthsShort: i,
            weekdays: "??????????_??????????????_????????????????_????????????????_????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????????_????????????_????????????_????????_????????_??????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "D/???M/???YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            meridiemParse: /??|??/,
            isPM: function(e) {
                return "??" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??" : "??"
            },
            calendar: {
                sameDay: "[?????????? ?????? ????????????] LT",
                nextDay: "[???????? ?????? ????????????] LT",
                nextWeek: "dddd [?????? ????????????] LT",
                lastDay: "[?????? ?????? ????????????] LT",
                lastWeek: "dddd [?????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "?????? %s",
                past: "?????? %s",
                s: r("s"),
                m: r("m"),
                mm: r("m"),
                h: r("h"),
                hh: r("h"),
                d: r("d"),
                dd: r("d"),
                M: r("M"),
                MM: r("M"),
                y: r("y"),
                yy: r("y")
            },
            preparse: function(e) {
                return e.replace(/\u200f/g, "").replace(/??/g, ",")
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                }).replace(/,/g, "??")
            },
            week: {
                dow: 6,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ar-ma", {
            months: "??????????_????????????_????????_??????????_??????_??????????_????????????_??????_??????????_????????????_??????????_??????????".split("_"),
            monthsShort: "??????????_????????????_????????_??????????_??????_??????????_????????????_??????_??????????_????????????_??????????_??????????".split("_"),
            weekdays: "??????????_??????????????_????????????????_????????????????_????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????????_????????????_????????????_????????_????????_??????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ?????? ????????????] LT",
                nextDay: "[?????? ?????? ????????????] LT",
                nextWeek: "dddd [?????? ????????????] LT",
                lastDay: "[?????? ?????? ????????????] LT",
                lastWeek: "dddd [?????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "?????? %s",
                s: "????????",
                m: "??????????",
                mm: "%d ??????????",
                h: "????????",
                hh: "%d ??????????",
                d: "??????",
                dd: "%d ????????",
                M: "??????",
                MM: "%d ????????",
                y: "??????",
                yy: "%d ??????????"
            },
            week: {
                dow: 6,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "??",
            2: "??",
            3: "??",
            4: "??",
            5: "??",
            6: "??",
            7: "??",
            8: "??",
            9: "??",
            0: "??"
        }
          , n = {
            "??": "1",
            "??": "2",
            "??": "3",
            "??": "4",
            "??": "5",
            "??": "6",
            "??": "7",
            "??": "8",
            "??": "9",
            "??": "0"
        };
        return e.defineLocale("ar-sa", {
            months: "??????????_????????????_????????_??????????_????????_??????????_??????????_??????????_????????????_????????????_????????????_????????????".split("_"),
            monthsShort: "??????????_????????????_????????_??????????_????????_??????????_??????????_??????????_????????????_????????????_????????????_????????????".split("_"),
            weekdays: "??????????_??????????????_????????????????_????????????????_????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????????_????????????_????????????_????????_????????_??????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            meridiemParse: /??|??/,
            isPM: function(e) {
                return "??" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??" : "??"
            },
            calendar: {
                sameDay: "[?????????? ?????? ????????????] LT",
                nextDay: "[?????? ?????? ????????????] LT",
                nextWeek: "dddd [?????? ????????????] LT",
                lastDay: "[?????? ?????? ????????????] LT",
                lastWeek: "dddd [?????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "?????? %s",
                s: "????????",
                m: "??????????",
                mm: "%d ??????????",
                h: "????????",
                hh: "%d ??????????",
                d: "??????",
                dd: "%d ????????",
                M: "??????",
                MM: "%d ????????",
                y: "??????",
                yy: "%d ??????????"
            },
            preparse: function(e) {
                return e.replace(/[????????????????????]/g, function(e) {
                    return n[e]
                }).replace(/??/g, ",")
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                }).replace(/,/g, "??")
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ar-tn", {
            months: "??????????_??????????_????????_??????????_??????_????????_????????????_??????_????????????_????????????_????????????_????????????".split("_"),
            monthsShort: "??????????_??????????_????????_??????????_??????_????????_????????????_??????_????????????_????????????_????????????_????????????".split("_"),
            weekdays: "??????????_??????????????_????????????????_????????????????_????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????????_????????????_????????????_????????_????????_??????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ?????? ????????????] LT",
                nextDay: "[?????? ?????? ????????????] LT",
                nextWeek: "dddd [?????? ????????????] LT",
                lastDay: "[?????? ?????? ????????????] LT",
                lastWeek: "dddd [?????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "?????? %s",
                s: "????????",
                m: "??????????",
                mm: "%d ??????????",
                h: "????????",
                hh: "%d ??????????",
                d: "??????",
                dd: "%d ????????",
                M: "??????",
                MM: "%d ????????",
                y: "??????",
                yy: "%d ??????????"
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "-inci",
            5: "-inci",
            8: "-inci",
            70: "-inci",
            80: "-inci",
            2: "-nci",
            7: "-nci",
            20: "-nci",
            50: "-nci",
            3: "-??nc??",
            4: "-??nc??",
            100: "-??nc??",
            6: "-nc??",
            9: "-uncu",
            10: "-uncu",
            30: "-uncu",
            60: "-??nc??",
            90: "-??nc??"
        };
        return e.defineLocale("az", {
            months: "yanvar_fevral_mart_aprel_may_iyun_iyul_avqust_sentyabr_oktyabr_noyabr_dekabr".split("_"),
            monthsShort: "yan_fev_mar_apr_may_iyn_iyl_avq_sen_okt_noy_dek".split("_"),
            weekdays: "Bazar_Bazar ert??si_????r????nb?? ax??am??_????r????nb??_C??m?? ax??am??_C??m??_????nb??".split("_"),
            weekdaysShort: "Baz_BzE_??Ax_????r_CAx_C??m_????n".split("_"),
            weekdaysMin: "Bz_BE_??A_????_CA_C??_????".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[bug??n saat] LT",
                nextDay: "[sabah saat] LT",
                nextWeek: "[g??l??n h??ft??] dddd [saat] LT",
                lastDay: "[d??n??n] LT",
                lastWeek: "[ke????n h??ft??] dddd [saat] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s sonra",
                past: "%s ??vv??l",
                s: "birne???? saniyy??",
                m: "bir d??qiq??",
                mm: "%d d??qiq??",
                h: "bir saat",
                hh: "%d saat",
                d: "bir g??n",
                dd: "%d g??n",
                M: "bir ay",
                MM: "%d ay",
                y: "bir il",
                yy: "%d il"
            },
            meridiemParse: /gec??|s??h??r|g??nd??z|ax??am/,
            isPM: function(e) {
                return /^(g??nd??z|ax??am)$/.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "gec??" : e < 12 ? "s??h??r" : e < 17 ? "g??nd??z" : "ax??am"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(??nc??|inci|nci|??nc??|nc??|uncu)/,
            ordinal: function(e) {
                if (0 === e)
                    return e + "-??nc??";
                var n = e % 10
                  , a = e % 100 - n
                  , r = e >= 100 ? 100 : null;
                return e + (t[n] || t[a] || t[r])
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t) {
            var n = e.split("_");
            return t % 10 == 1 && t % 100 != 11 ? n[0] : t % 10 >= 2 && t % 10 <= 4 && (t % 100 < 10 || t % 100 >= 20) ? n[1] : n[2]
        }
        function n(e, n, a) {
            var r = {
                mm: n ? "??????????????_??????????????_????????????" : "??????????????_??????????????_????????????",
                hh: n ? "??????????????_??????????????_????????????" : "??????????????_??????????????_????????????",
                dd: "??????????_??????_????????",
                MM: "??????????_????????????_??????????????",
                yy: "??????_????????_??????????"
            };
            return "m" === a ? n ? "??????????????" : "??????????????" : "h" === a ? n ? "??????????????" : "??????????????" : e + " " + t(r[a], +e)
        }
        return e.defineLocale("be", {
            months: {
                format: "????????????????_????????????_????????????????_??????????????????_????????????_??????????????_????????????_????????????_??????????????_??????????????????????_??????????????????_????????????".split("_"),
                standalone: "????????????????_????????_??????????????_????????????????_??????????????_??????????????_????????????_??????????????_????????????????_????????????????????_????????????????_??????????????".split("_")
            },
            monthsShort: "????????_??????_??????_????????_????????_????????_??????_????????_??????_????????_????????_????????".split("_"),
            weekdays: {
                format: "??????????????_????????????????????_??????????????_????????????_????????????_??????????????_????????????".split("_"),
                standalone: "??????????????_????????????????????_??????????????_????????????_????????????_??????????????_????????????".split("_"),
                isFormat: /\[ ?[????] ?(?:??????????????|??????????????????)? ?\] ?dddd/
            },
            weekdaysShort: "????_????_????_????_????_????_????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY ??.",
                LLL: "D MMMM YYYY ??., HH:mm",
                LLLL: "dddd, D MMMM YYYY ??., HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ??] LT",
                nextDay: "[???????????? ??] LT",
                lastDay: "[?????????? ??] LT",
                nextWeek: function() {
                    return "[??] dddd [??] LT"
                },
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                    case 3:
                    case 5:
                    case 6:
                        return "[?? ??????????????] dddd [??] LT";
                    case 1:
                    case 2:
                    case 4:
                        return "[?? ????????????] dddd [??] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "???????? %s",
                past: "%s ????????",
                s: "???????????????? ????????????",
                m: n,
                mm: n,
                h: n,
                hh: n,
                d: "??????????",
                dd: n,
                M: "??????????",
                MM: n,
                y: "??????",
                yy: n
            },
            meridiemParse: /????????|????????????|??????|????????????/,
            isPM: function(e) {
                return /^(??????|????????????)$/.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "????????" : e < 12 ? "????????????" : e < 17 ? "??????" : "????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(??|??|????)/,
            ordinal: function(e, t) {
                switch (t) {
                case "M":
                case "d":
                case "DDD":
                case "w":
                case "W":
                    return e % 10 != 2 && e % 10 != 3 || e % 100 == 12 || e % 100 == 13 ? e + "-??" : e + "-??";
                case "D":
                    return e + "-????";
                default:
                    return e
                }
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("bg", {
            months: "????????????_????????????????_????????_??????????_??????_??????_??????_????????????_??????????????????_????????????????_??????????????_????????????????".split("_"),
            monthsShort: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "????????????_????????????????????_??????????????_??????????_??????????????????_??????????_????????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "D.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY H:mm",
                LLLL: "dddd, D MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[???????? ??] LT",
                nextDay: "[???????? ??] LT",
                nextWeek: "dddd [??] LT",
                lastDay: "[?????????? ??] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                    case 3:
                    case 6:
                        return "[?? ????????????????????] dddd [??] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[?? ??????????????????] dddd [??] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "???????? %s",
                past: "?????????? %s",
                s: "?????????????? ??????????????",
                m: "????????????",
                mm: "%d ????????????",
                h: "??????",
                hh: "%d ????????",
                d: "??????",
                dd: "%d ??????",
                M: "??????????",
                MM: "%d ????????????",
                y: "????????????",
                yy: "%d ????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(????|????|????|????|????|????)/,
            ordinal: function(e) {
                var t = e % 10
                  , n = e % 100;
                return 0 === e ? e + "-????" : 0 === n ? e + "-????" : n > 10 && n < 20 ? e + "-????" : 1 === t ? e + "-????" : 2 === t ? e + "-????" : 7 === t || 8 === t ? e + "-????" : e + "-????"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("bn", {
            months: "????????????????????????_??????????????????????????????_???????????????_??????????????????_??????_?????????_???????????????_???????????????_??????????????????????????????_?????????????????????_?????????????????????_????????????????????????".split("_"),
            monthsShort: "????????????_?????????_???????????????_????????????_??????_?????????_?????????_??????_???????????????_???????????????_?????????_????????????".split("_"),
            weekdays: "??????????????????_??????????????????_????????????????????????_??????????????????_?????????????????????????????????_????????????????????????_??????????????????".split("_"),
            weekdaysShort: "?????????_?????????_???????????????_?????????_????????????????????????_???????????????_?????????".split("_"),
            weekdaysMin: "?????????_?????????_????????????_?????????_????????????_???????????????_?????????".split("_"),
            longDateFormat: {
                LT: "A h:mm ?????????",
                LTS: "A h:mm:ss ?????????",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm ?????????",
                LLLL: "dddd, D MMMM YYYY, A h:mm ?????????"
            },
            calendar: {
                sameDay: "[??????] LT",
                nextDay: "[????????????????????????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[???????????????] LT",
                lastWeek: "[??????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ?????????",
                past: "%s ?????????",
                s: "???????????? ?????????????????????",
                m: "?????? ???????????????",
                mm: "%d ???????????????",
                h: "?????? ???????????????",
                hh: "%d ???????????????",
                d: "?????? ?????????",
                dd: "%d ?????????",
                M: "?????? ?????????",
                MM: "%d ?????????",
                y: "?????? ?????????",
                yy: "%d ?????????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            meridiemParse: /?????????|????????????|???????????????|???????????????|?????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "?????????" === t && e >= 4 || "???????????????" === t && e < 5 || "???????????????" === t ? e + 12 : e
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "?????????" : e < 10 ? "????????????" : e < 17 ? "???????????????" : e < 20 ? "???????????????" : "?????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("bo", {
            months: "??????????????????????????????_?????????????????????????????????_?????????????????????????????????_??????????????????????????????_???????????????????????????_?????????????????????????????????_?????????????????????????????????_????????????????????????????????????_??????????????????????????????_??????????????????????????????_?????????????????????????????????????????????_?????????????????????????????????????????????".split("_"),
            monthsShort: "??????????????????????????????_?????????????????????????????????_?????????????????????????????????_??????????????????????????????_???????????????????????????_?????????????????????????????????_?????????????????????????????????_????????????????????????????????????_??????????????????????????????_??????????????????????????????_?????????????????????????????????????????????_?????????????????????????????????????????????".split("_"),
            weekdays: "???????????????????????????_???????????????????????????_????????????????????????????????????_??????????????????????????????_??????????????????????????????_??????????????????????????????_?????????????????????????????????".split("_"),
            weekdaysShort: "???????????????_???????????????_????????????????????????_??????????????????_??????????????????_??????????????????_?????????????????????".split("_"),
            weekdaysMin: "???????????????_???????????????_????????????????????????_??????????????????_??????????????????_??????????????????_?????????????????????".split("_"),
            longDateFormat: {
                LT: "A h:mm",
                LTS: "A h:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm",
                LLLL: "dddd, D MMMM YYYY, A h:mm"
            },
            calendar: {
                sameDay: "[??????????????????] LT",
                nextDay: "[??????????????????] LT",
                nextWeek: "[?????????????????????????????????????????????], LT",
                lastDay: "[????????????] LT",
                lastWeek: "[??????????????????????????????????????????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ??????",
                past: "%s ???????????????",
                s: "???????????????",
                m: "??????????????????????????????",
                mm: "%d ???????????????",
                h: "?????????????????????????????????",
                hh: "%d ??????????????????",
                d: "????????????????????????",
                dd: "%d ????????????",
                M: "???????????????????????????",
                MM: "%d ????????????",
                y: "?????????????????????",
                yy: "%d ??????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            meridiemParse: /??????????????????|?????????????????????|?????????????????????|?????????????????????|??????????????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????????????????" === t && e >= 4 || "?????????????????????" === t && e < 5 || "?????????????????????" === t ? e + 12 : e
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "??????????????????" : e < 10 ? "?????????????????????" : e < 17 ? "?????????????????????" : e < 20 ? "?????????????????????" : "??????????????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n) {
            return e + " " + r({
                mm: "munutenn",
                MM: "miz",
                dd: "devezh"
            }[n], e)
        }
        function n(e) {
            switch (a(e)) {
            case 1:
            case 3:
            case 4:
            case 5:
            case 9:
                return e + " bloaz";
            default:
                return e + " vloaz"
            }
        }
        function a(e) {
            return e > 9 ? a(e % 10) : e
        }
        function r(e, t) {
            return 2 === t ? i(e) : e
        }
        function i(e) {
            var t = {
                m: "v",
                b: "v",
                d: "z"
            };
            return void 0 === t[e.charAt(0)] ? e : t[e.charAt(0)] + e.substring(1)
        }
        return e.defineLocale("br", {
            months: "Genver_C'hwevrer_Meurzh_Ebrel_Mae_Mezheven_Gouere_Eost_Gwengolo_Here_Du_Kerzu".split("_"),
            monthsShort: "Gen_C'hwe_Meu_Ebr_Mae_Eve_Gou_Eos_Gwe_Her_Du_Ker".split("_"),
            weekdays: "Sul_Lun_Meurzh_Merc'her_Yaou_Gwener_Sadorn".split("_"),
            weekdaysShort: "Sul_Lun_Meu_Mer_Yao_Gwe_Sad".split("_"),
            weekdaysMin: "Su_Lu_Me_Mer_Ya_Gw_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "h[e]mm A",
                LTS: "h[e]mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D [a viz] MMMM YYYY",
                LLL: "D [a viz] MMMM YYYY h[e]mm A",
                LLLL: "dddd, D [a viz] MMMM YYYY h[e]mm A"
            },
            calendar: {
                sameDay: "[Hiziv da] LT",
                nextDay: "[Warc'hoazh da] LT",
                nextWeek: "dddd [da] LT",
                lastDay: "[Dec'h da] LT",
                lastWeek: "dddd [paset da] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "a-benn %s",
                past: "%s 'zo",
                s: "un nebeud segondenno??",
                m: "ur vunutenn",
                mm: t,
                h: "un eur",
                hh: "%d eur",
                d: "un devezh",
                dd: t,
                M: "ur miz",
                MM: t,
                y: "ur bloaz",
                yy: n
            },
            dayOfMonthOrdinalParse: /\d{1,2}(a??|vet)/,
            ordinal: function(e) {
                return e + (1 === e ? "a??" : "vet")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n) {
            var a = e + " ";
            switch (n) {
            case "m":
                return t ? "jedna minuta" : "jedne minute";
            case "mm":
                return a += 1 === e ? "minuta" : 2 === e || 3 === e || 4 === e ? "minute" : "minuta";
            case "h":
                return t ? "jedan sat" : "jednog sata";
            case "hh":
                return a += 1 === e ? "sat" : 2 === e || 3 === e || 4 === e ? "sata" : "sati";
            case "dd":
                return a += 1 === e ? "dan" : "dana";
            case "MM":
                return a += 1 === e ? "mjesec" : 2 === e || 3 === e || 4 === e ? "mjeseca" : "mjeseci";
            case "yy":
                return a += 1 === e ? "godina" : 2 === e || 3 === e || 4 === e ? "godine" : "godina"
            }
        }
        return e.defineLocale("bs", {
            months: "januar_februar_mart_april_maj_juni_juli_august_septembar_oktobar_novembar_decembar".split("_"),
            monthsShort: "jan._feb._mar._apr._maj._jun._jul._aug._sep._okt._nov._dec.".split("_"),
            monthsParseExact: !0,
            weekdays: "nedjelja_ponedjeljak_utorak_srijeda_??etvrtak_petak_subota".split("_"),
            weekdaysShort: "ned._pon._uto._sri._??et._pet._sub.".split("_"),
            weekdaysMin: "ne_po_ut_sr_??e_pe_su".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd, D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[danas u] LT",
                nextDay: "[sutra u] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[u] [nedjelju] [u] LT";
                    case 3:
                        return "[u] [srijedu] [u] LT";
                    case 6:
                        return "[u] [subotu] [u] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[u] dddd [u] LT"
                    }
                },
                lastDay: "[ju??er u] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                    case 3:
                        return "[pro??lu] dddd [u] LT";
                    case 6:
                        return "[pro??le] [subote] [u] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[pro??li] dddd [u] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "za %s",
                past: "prije %s",
                s: "par sekundi",
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: "dan",
                dd: t,
                M: "mjesec",
                MM: t,
                y: "godinu",
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ca", {
            months: {
                standalone: "gener_febrer_mar??_abril_maig_juny_juliol_agost_setembre_octubre_novembre_desembre".split("_"),
                format: "de gener_de febrer_de mar??_d'abril_de maig_de juny_de juliol_d'agost_de setembre_d'octubre_de novembre_de desembre".split("_"),
                isFormat: /D[oD]?(\s)+MMMM/
            },
            monthsShort: "gen._febr._mar??_abr._maig_juny_jul._ag._set._oct._nov._des.".split("_"),
            monthsParseExact: !0,
            weekdays: "diumenge_dilluns_dimarts_dimecres_dijous_divendres_dissabte".split("_"),
            weekdaysShort: "dg._dl._dt._dc._dj._dv._ds.".split("_"),
            weekdaysMin: "Dg_Dl_Dt_Dc_Dj_Dv_Ds".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD/MM/YYYY",
                LL: "[el] D MMMM [de] YYYY",
                ll: "D MMM YYYY",
                LLL: "[el] D MMMM [de] YYYY [a les] H:mm",
                lll: "D MMM YYYY, H:mm",
                LLLL: "[el] dddd D MMMM [de] YYYY [a les] H:mm",
                llll: "ddd D MMM YYYY, H:mm"
            },
            calendar: {
                sameDay: function() {
                    return "[avui a " + (1 !== this.hours() ? "les" : "la") + "] LT"
                },
                nextDay: function() {
                    return "[dem?? a " + (1 !== this.hours() ? "les" : "la") + "] LT"
                },
                nextWeek: function() {
                    return "dddd [a " + (1 !== this.hours() ? "les" : "la") + "] LT"
                },
                lastDay: function() {
                    return "[ahir a " + (1 !== this.hours() ? "les" : "la") + "] LT"
                },
                lastWeek: function() {
                    return "[el] dddd [passat a " + (1 !== this.hours() ? "les" : "la") + "] LT"
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "d'aqu?? %s",
                past: "fa %s",
                s: "uns segons",
                m: "un minut",
                mm: "%d minuts",
                h: "una hora",
                hh: "%d hores",
                d: "un dia",
                dd: "%d dies",
                M: "un mes",
                MM: "%d mesos",
                y: "un any",
                yy: "%d anys"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(r|n|t|??|a)/,
            ordinal: function(e, t) {
                var n = 1 === e ? "r" : 2 === e ? "n" : 3 === e ? "r" : 4 === e ? "t" : "??";
                return "w" !== t && "W" !== t || (n = "a"),
                e + n
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e) {
            return e > 1 && e < 5 && 1 != ~~(e / 10)
        }
        function n(e, n, a, r) {
            var i = e + " ";
            switch (a) {
            case "s":
                return n || r ? "p??r sekund" : "p??r sekundami";
            case "m":
                return n ? "minuta" : r ? "minutu" : "minutou";
            case "mm":
                return n || r ? i + (t(e) ? "minuty" : "minut") : i + "minutami";
            case "h":
                return n ? "hodina" : r ? "hodinu" : "hodinou";
            case "hh":
                return n || r ? i + (t(e) ? "hodiny" : "hodin") : i + "hodinami";
            case "d":
                return n || r ? "den" : "dnem";
            case "dd":
                return n || r ? i + (t(e) ? "dny" : "dn??") : i + "dny";
            case "M":
                return n || r ? "m??s??c" : "m??s??cem";
            case "MM":
                return n || r ? i + (t(e) ? "m??s??ce" : "m??s??c??") : i + "m??s??ci";
            case "y":
                return n || r ? "rok" : "rokem";
            case "yy":
                return n || r ? i + (t(e) ? "roky" : "let") : i + "lety"
            }
        }
        var a = "leden_??nor_b??ezen_duben_kv??ten_??erven_??ervenec_srpen_z??????_????jen_listopad_prosinec".split("_")
          , r = "led_??no_b??e_dub_kv??_??vn_??vc_srp_z????_????j_lis_pro".split("_");
        return e.defineLocale("cs", {
            months: a,
            monthsShort: r,
            monthsParse: function(e, t) {
                var n, a = [];
                for (n = 0; n < 12; n++)
                    a[n] = new RegExp("^" + e[n] + "$|^" + t[n] + "$","i");
                return a
            }(a, r),
            shortMonthsParse: function(e) {
                var t, n = [];
                for (t = 0; t < 12; t++)
                    n[t] = new RegExp("^" + e[t] + "$","i");
                return n
            }(r),
            longMonthsParse: function(e) {
                var t, n = [];
                for (t = 0; t < 12; t++)
                    n[t] = new RegExp("^" + e[t] + "$","i");
                return n
            }(a),
            weekdays: "ned??le_pond??l??_??ter??_st??eda_??tvrtek_p??tek_sobota".split("_"),
            weekdaysShort: "ne_po_??t_st_??t_p??_so".split("_"),
            weekdaysMin: "ne_po_??t_st_??t_p??_so".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd D. MMMM YYYY H:mm",
                l: "D. M. YYYY"
            },
            calendar: {
                sameDay: "[dnes v] LT",
                nextDay: "[z??tra v] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[v ned??li v] LT";
                    case 1:
                    case 2:
                        return "[v] dddd [v] LT";
                    case 3:
                        return "[ve st??edu v] LT";
                    case 4:
                        return "[ve ??tvrtek v] LT";
                    case 5:
                        return "[v p??tek v] LT";
                    case 6:
                        return "[v sobotu v] LT"
                    }
                },
                lastDay: "[v??era v] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[minulou ned??li v] LT";
                    case 1:
                    case 2:
                        return "[minul??] dddd [v] LT";
                    case 3:
                        return "[minulou st??edu v] LT";
                    case 4:
                    case 5:
                        return "[minul??] dddd [v] LT";
                    case 6:
                        return "[minulou sobotu v] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "za %s",
                past: "p??ed %s",
                s: n,
                m: n,
                mm: n,
                h: n,
                hh: n,
                d: n,
                dd: n,
                M: n,
                MM: n,
                y: n,
                yy: n
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("cv", {
            months: "????????????_??????????_??????_??????_??????_????????????_??????_??????????_????????_??????_??????_????????????".split("_"),
            monthsShort: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "??????????????????????_????????????????_??????????????????_??????????_??????????????????????_??????????????_????????????????".split("_"),
            weekdaysShort: "??????_??????_??????_????_??????_??????_??????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD-MM-YYYY",
                LL: "YYYY [??????????] MMMM [????????????] D[-????????]",
                LLL: "YYYY [??????????] MMMM [????????????] D[-????????], HH:mm",
                LLLL: "dddd, YYYY [??????????] MMMM [????????????] D[-????????], HH:mm"
            },
            calendar: {
                sameDay: "[????????] LT [??????????????]",
                nextDay: "[????????] LT [??????????????]",
                lastDay: "[????????] LT [??????????????]",
                nextWeek: "[??????????] dddd LT [??????????????]",
                lastWeek: "[??????????] dddd LT [??????????????]",
                sameElse: "L"
            },
            relativeTime: {
                future: function(e) {
                    return e + (/??????????$/i.exec(e) ? "??????" : /??????$/i.exec(e) ? "??????" : "??????")
                },
                past: "%s ????????????",
                s: "??????-???? ??????????????",
                m: "?????? ??????????",
                mm: "%d ??????????",
                h: "?????? ??????????",
                hh: "%d ??????????",
                d: "?????? ??????",
                dd: "%d ??????",
                M: "?????? ????????",
                MM: "%d ????????",
                y: "?????? ??????",
                yy: "%d ??????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-??????/,
            ordinal: "%d-??????",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("cy", {
            months: "Ionawr_Chwefror_Mawrth_Ebrill_Mai_Mehefin_Gorffennaf_Awst_Medi_Hydref_Tachwedd_Rhagfyr".split("_"),
            monthsShort: "Ion_Chwe_Maw_Ebr_Mai_Meh_Gor_Aws_Med_Hyd_Tach_Rhag".split("_"),
            weekdays: "Dydd Sul_Dydd Llun_Dydd Mawrth_Dydd Mercher_Dydd Iau_Dydd Gwener_Dydd Sadwrn".split("_"),
            weekdaysShort: "Sul_Llun_Maw_Mer_Iau_Gwe_Sad".split("_"),
            weekdaysMin: "Su_Ll_Ma_Me_Ia_Gw_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Heddiw am] LT",
                nextDay: "[Yfory am] LT",
                nextWeek: "dddd [am] LT",
                lastDay: "[Ddoe am] LT",
                lastWeek: "dddd [diwethaf am] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "mewn %s",
                past: "%s yn ??l",
                s: "ychydig eiliadau",
                m: "munud",
                mm: "%d munud",
                h: "awr",
                hh: "%d awr",
                d: "diwrnod",
                dd: "%d diwrnod",
                M: "mis",
                MM: "%d mis",
                y: "blwyddyn",
                yy: "%d flynedd"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(fed|ain|af|il|ydd|ed|eg)/,
            ordinal: function(e) {
                var t = e
                  , n = ""
                  , a = ["", "af", "il", "ydd", "ydd", "ed", "ed", "ed", "fed", "fed", "fed", "eg", "fed", "eg", "eg", "fed", "eg", "eg", "fed", "eg", "fed"];
                return t > 20 ? n = 40 === t || 50 === t || 60 === t || 80 === t || 100 === t ? "fed" : "ain" : t > 0 && (n = a[t]),
                e + n
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("da", {
            months: "januar_februar_marts_april_maj_juni_juli_august_september_oktober_november_december".split("_"),
            monthsShort: "jan_feb_mar_apr_maj_jun_jul_aug_sep_okt_nov_dec".split("_"),
            weekdays: "s??ndag_mandag_tirsdag_onsdag_torsdag_fredag_l??rdag".split("_"),
            weekdaysShort: "s??n_man_tir_ons_tor_fre_l??r".split("_"),
            weekdaysMin: "s??_ma_ti_on_to_fr_l??".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY HH:mm",
                LLLL: "dddd [d.] D. MMMM YYYY [kl.] HH:mm"
            },
            calendar: {
                sameDay: "[i dag kl.] LT",
                nextDay: "[i morgen kl.] LT",
                nextWeek: "p?? dddd [kl.] LT",
                lastDay: "[i g??r kl.] LT",
                lastWeek: "[i] dddd[s kl.] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "om %s",
                past: "%s siden",
                s: "f?? sekunder",
                m: "et minut",
                mm: "%d minutter",
                h: "en time",
                hh: "%d timer",
                d: "en dag",
                dd: "%d dage",
                M: "en m??ned",
                MM: "%d m??neder",
                y: "et ??r",
                yy: "%d ??r"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = {
                m: ["eine Minute", "einer Minute"],
                h: ["eine Stunde", "einer Stunde"],
                d: ["ein Tag", "einem Tag"],
                dd: [e + " Tage", e + " Tagen"],
                M: ["ein Monat", "einem Monat"],
                MM: [e + " Monate", e + " Monaten"],
                y: ["ein Jahr", "einem Jahr"],
                yy: [e + " Jahre", e + " Jahren"]
            };
            return t ? r[n][0] : r[n][1]
        }
        return e.defineLocale("de", {
            months: "Januar_Februar_M??rz_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
            monthsShort: "Jan._Febr._Mrz._Apr._Mai_Jun._Jul._Aug._Sept._Okt._Nov._Dez.".split("_"),
            monthsParseExact: !0,
            weekdays: "Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
            weekdaysShort: "So._Mo._Di._Mi._Do._Fr._Sa.".split("_"),
            weekdaysMin: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY HH:mm",
                LLLL: "dddd, D. MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[heute um] LT [Uhr]",
                sameElse: "L",
                nextDay: "[morgen um] LT [Uhr]",
                nextWeek: "dddd [um] LT [Uhr]",
                lastDay: "[gestern um] LT [Uhr]",
                lastWeek: "[letzten] dddd [um] LT [Uhr]"
            },
            relativeTime: {
                future: "in %s",
                past: "vor %s",
                s: "ein paar Sekunden",
                m: t,
                mm: "%d Minuten",
                h: t,
                hh: "%d Stunden",
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = {
                m: ["eine Minute", "einer Minute"],
                h: ["eine Stunde", "einer Stunde"],
                d: ["ein Tag", "einem Tag"],
                dd: [e + " Tage", e + " Tagen"],
                M: ["ein Monat", "einem Monat"],
                MM: [e + " Monate", e + " Monaten"],
                y: ["ein Jahr", "einem Jahr"],
                yy: [e + " Jahre", e + " Jahren"]
            };
            return t ? r[n][0] : r[n][1]
        }
        return e.defineLocale("de-at", {
            months: "J??nner_Februar_M??rz_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
            monthsShort: "J??n._Febr._Mrz._Apr._Mai_Jun._Jul._Aug._Sept._Okt._Nov._Dez.".split("_"),
            monthsParseExact: !0,
            weekdays: "Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
            weekdaysShort: "So._Mo._Di._Mi._Do._Fr._Sa.".split("_"),
            weekdaysMin: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY HH:mm",
                LLLL: "dddd, D. MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[heute um] LT [Uhr]",
                sameElse: "L",
                nextDay: "[morgen um] LT [Uhr]",
                nextWeek: "dddd [um] LT [Uhr]",
                lastDay: "[gestern um] LT [Uhr]",
                lastWeek: "[letzten] dddd [um] LT [Uhr]"
            },
            relativeTime: {
                future: "in %s",
                past: "vor %s",
                s: "ein paar Sekunden",
                m: t,
                mm: "%d Minuten",
                h: t,
                hh: "%d Stunden",
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = {
                m: ["eine Minute", "einer Minute"],
                h: ["eine Stunde", "einer Stunde"],
                d: ["ein Tag", "einem Tag"],
                dd: [e + " Tage", e + " Tagen"],
                M: ["ein Monat", "einem Monat"],
                MM: [e + " Monate", e + " Monaten"],
                y: ["ein Jahr", "einem Jahr"],
                yy: [e + " Jahre", e + " Jahren"]
            };
            return t ? r[n][0] : r[n][1]
        }
        return e.defineLocale("de-ch", {
            months: "Januar_Februar_M??rz_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
            monthsShort: "Jan._Febr._M??rz_April_Mai_Juni_Juli_Aug._Sept._Okt._Nov._Dez.".split("_"),
            monthsParseExact: !0,
            weekdays: "Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
            weekdaysShort: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
            weekdaysMin: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH.mm",
                LTS: "HH.mm.ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY HH.mm",
                LLLL: "dddd, D. MMMM YYYY HH.mm"
            },
            calendar: {
                sameDay: "[heute um] LT [Uhr]",
                sameElse: "L",
                nextDay: "[morgen um] LT [Uhr]",
                nextWeek: "dddd [um] LT [Uhr]",
                lastDay: "[gestern um] LT [Uhr]",
                lastWeek: "[letzten] dddd [um] LT [Uhr]"
            },
            relativeTime: {
                future: "in %s",
                past: "vor %s",
                s: "ein paar Sekunden",
                m: t,
                mm: "%d Minuten",
                h: t,
                hh: "%d Stunden",
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = ["????????????????", "????????????????????", "????????????", "????????????????", "????", "????????", "????????????", "????????????????", "????????????????????????", "????????????????????", "????????????????????", "????????????????????"]
          , n = ["????????????????", "????????", "????????????????", "????????", "????????????????????", "????????????", "????????????????"];
        return e.defineLocale("dv", {
            months: t,
            monthsShort: t,
            weekdays: n,
            weekdaysShort: n,
            weekdaysMin: "????????_????????_????????_????????_????????_????????_????????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "D/M/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            meridiemParse: /????|????/,
            isPM: function(e) {
                return "????" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "????" : "????"
            },
            calendar: {
                sameDay: "[????????????] LT",
                nextDay: "[????????????] LT",
                nextWeek: "dddd LT",
                lastDay: "[????????????] LT",
                lastWeek: "[????????????????] dddd LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???????????????? %s",
                past: "???????????? %s",
                s: "????????????????????????????",
                m: "????????????????",
                mm: "???????????? %d",
                h: "????????????????????",
                hh: "???????????????? %d",
                d: "????????????????",
                dd: "???????????? %d",
                M: "????????????",
                MM: "???????? %d",
                y: "????????????????",
                yy: "???????????? %d"
            },
            preparse: function(e) {
                return e.replace(/??/g, ",")
            },
            postformat: function(e) {
                return e.replace(/,/g, "??")
            },
            week: {
                dow: 7,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e) {
            return e instanceof Function || "[object Function]" === Object.prototype.toString.call(e)
        }
        return e.defineLocale("el", {
            monthsNominativeEl: "????????????????????_??????????????????????_??????????????_????????????????_??????????_??????????????_??????????????_??????????????????_??????????????????????_??????????????????_??????????????????_????????????????????".split("_"),
            monthsGenitiveEl: "????????????????????_??????????????????????_??????????????_????????????????_??????????_??????????????_??????????????_??????????????????_??????????????????????_??????????????????_??????????????????_????????????????????".split("_"),
            months: function(e, t) {
                return e ? /D/.test(t.substring(0, t.indexOf("MMMM"))) ? this._monthsGenitiveEl[e.month()] : this._monthsNominativeEl[e.month()] : this._monthsNominativeEl
            },
            monthsShort: "??????_??????_??????_??????_??????_????????_????????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "??????????????_??????????????_??????????_??????????????_????????????_??????????????????_??????????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            meridiem: function(e, t, n) {
                return e > 11 ? n ? "????" : "????" : n ? "????" : "????"
            },
            isPM: function(e) {
                return "??" === (e + "").toLowerCase()[0]
            },
            meridiemParse: /[????]\.????\.?/i,
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY h:mm A",
                LLLL: "dddd, D MMMM YYYY h:mm A"
            },
            calendarEl: {
                sameDay: "[???????????? {}] LT",
                nextDay: "[?????????? {}] LT",
                nextWeek: "dddd [{}] LT",
                lastDay: "[???????? {}] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 6:
                        return "[???? ??????????????????????] dddd [{}] LT";
                    default:
                        return "[?????? ??????????????????????] dddd [{}] LT"
                    }
                },
                sameElse: "L"
            },
            calendar: function(e, n) {
                var a = this._calendarEl[e]
                  , r = n && n.hours();
                return t(a) && (a = a.apply(n)),
                a.replace("{}", r % 12 == 1 ? "??????" : "????????")
            },
            relativeTime: {
                future: "???? %s",
                past: "%s ????????",
                s: "???????? ????????????????????????",
                m: "?????? ??????????",
                mm: "%d ??????????",
                h: "?????? ??????",
                hh: "%d ????????",
                d: "?????? ????????",
                dd: "%d ??????????",
                M: "???????? ??????????",
                MM: "%d ??????????",
                y: "???????? ????????????",
                yy: "%d ????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("en-au", {
            months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
            monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
            weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
            weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
            weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY h:mm A",
                LLLL: "dddd, D MMMM YYYY h:mm A"
            },
            calendar: {
                sameDay: "[Today at] LT",
                nextDay: "[Tomorrow at] LT",
                nextWeek: "dddd [at] LT",
                lastDay: "[Yesterday at] LT",
                lastWeek: "[Last] dddd [at] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "in %s",
                past: "%s ago",
                s: "a few seconds",
                m: "a minute",
                mm: "%d minutes",
                h: "an hour",
                hh: "%d hours",
                d: "a day",
                dd: "%d days",
                M: "a month",
                MM: "%d months",
                y: "a year",
                yy: "%d years"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("en-ca", {
            months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
            monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
            weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
            weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
            weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "YYYY-MM-DD",
                LL: "MMMM D, YYYY",
                LLL: "MMMM D, YYYY h:mm A",
                LLLL: "dddd, MMMM D, YYYY h:mm A"
            },
            calendar: {
                sameDay: "[Today at] LT",
                nextDay: "[Tomorrow at] LT",
                nextWeek: "dddd [at] LT",
                lastDay: "[Yesterday at] LT",
                lastWeek: "[Last] dddd [at] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "in %s",
                past: "%s ago",
                s: "a few seconds",
                m: "a minute",
                mm: "%d minutes",
                h: "an hour",
                hh: "%d hours",
                d: "a day",
                dd: "%d days",
                M: "a month",
                MM: "%d months",
                y: "a year",
                yy: "%d years"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("en-gb", {
            months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
            monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
            weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
            weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
            weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Today at] LT",
                nextDay: "[Tomorrow at] LT",
                nextWeek: "dddd [at] LT",
                lastDay: "[Yesterday at] LT",
                lastWeek: "[Last] dddd [at] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "in %s",
                past: "%s ago",
                s: "a few seconds",
                m: "a minute",
                mm: "%d minutes",
                h: "an hour",
                hh: "%d hours",
                d: "a day",
                dd: "%d days",
                M: "a month",
                MM: "%d months",
                y: "a year",
                yy: "%d years"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("en-ie", {
            months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
            monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
            weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
            weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
            weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD-MM-YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Today at] LT",
                nextDay: "[Tomorrow at] LT",
                nextWeek: "dddd [at] LT",
                lastDay: "[Yesterday at] LT",
                lastWeek: "[Last] dddd [at] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "in %s",
                past: "%s ago",
                s: "a few seconds",
                m: "a minute",
                mm: "%d minutes",
                h: "an hour",
                hh: "%d hours",
                d: "a day",
                dd: "%d days",
                M: "a month",
                MM: "%d months",
                y: "a year",
                yy: "%d years"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("en-nz", {
            months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
            monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
            weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
            weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
            weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY h:mm A",
                LLLL: "dddd, D MMMM YYYY h:mm A"
            },
            calendar: {
                sameDay: "[Today at] LT",
                nextDay: "[Tomorrow at] LT",
                nextWeek: "dddd [at] LT",
                lastDay: "[Yesterday at] LT",
                lastWeek: "[Last] dddd [at] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "in %s",
                past: "%s ago",
                s: "a few seconds",
                m: "a minute",
                mm: "%d minutes",
                h: "an hour",
                hh: "%d hours",
                d: "a day",
                dd: "%d days",
                M: "a month",
                MM: "%d months",
                y: "a year",
                yy: "%d years"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("eo", {
            months: "januaro_februaro_marto_aprilo_majo_junio_julio_a??gusto_septembro_oktobro_novembro_decembro".split("_"),
            monthsShort: "jan_feb_mar_apr_maj_jun_jul_a??g_sep_okt_nov_dec".split("_"),
            weekdays: "diman??o_lundo_mardo_merkredo_??a??do_vendredo_sabato".split("_"),
            weekdaysShort: "dim_lun_mard_merk_??a??_ven_sab".split("_"),
            weekdaysMin: "di_lu_ma_me_??a_ve_sa".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY-MM-DD",
                LL: "D[-a de] MMMM, YYYY",
                LLL: "D[-a de] MMMM, YYYY HH:mm",
                LLLL: "dddd, [la] D[-a de] MMMM, YYYY HH:mm"
            },
            meridiemParse: /[ap]\.t\.m/i,
            isPM: function(e) {
                return "p" === e.charAt(0).toLowerCase()
            },
            meridiem: function(e, t, n) {
                return e > 11 ? n ? "p.t.m." : "P.T.M." : n ? "a.t.m." : "A.T.M."
            },
            calendar: {
                sameDay: "[Hodia?? je] LT",
                nextDay: "[Morga?? je] LT",
                nextWeek: "dddd [je] LT",
                lastDay: "[Hiera?? je] LT",
                lastWeek: "[pasinta] dddd [je] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "post %s",
                past: "anta?? %s",
                s: "sekundoj",
                m: "minuto",
                mm: "%d minutoj",
                h: "horo",
                hh: "%d horoj",
                d: "tago",
                dd: "%d tagoj",
                M: "monato",
                MM: "%d monatoj",
                y: "jaro",
                yy: "%d jaroj"
            },
            dayOfMonthOrdinalParse: /\d{1,2}a/,
            ordinal: "%da",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split("_")
          , n = "ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split("_");
        return e.defineLocale("es", {
            months: "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
            monthsShort: function(e, a) {
                return e ? /-MMM-/.test(a) ? n[e.month()] : t[e.month()] : t
            },
            monthsParseExact: !0,
            weekdays: "domingo_lunes_martes_mi??rcoles_jueves_viernes_s??bado".split("_"),
            weekdaysShort: "dom._lun._mar._mi??._jue._vie._s??b.".split("_"),
            weekdaysMin: "do_lu_ma_mi_ju_vi_s??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D [de] MMMM [de] YYYY",
                LLL: "D [de] MMMM [de] YYYY H:mm",
                LLLL: "dddd, D [de] MMMM [de] YYYY H:mm"
            },
            calendar: {
                sameDay: function() {
                    return "[hoy a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                nextDay: function() {
                    return "[ma??ana a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                nextWeek: function() {
                    return "dddd [a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                lastDay: function() {
                    return "[ayer a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                lastWeek: function() {
                    return "[el] dddd [pasado a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "en %s",
                past: "hace %s",
                s: "unos segundos",
                m: "un minuto",
                mm: "%d minutos",
                h: "una hora",
                hh: "%d horas",
                d: "un d??a",
                dd: "%d d??as",
                M: "un mes",
                MM: "%d meses",
                y: "un a??o",
                yy: "%d a??os"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split("_")
          , n = "ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split("_");
        return e.defineLocale("es-do", {
            months: "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
            monthsShort: function(e, a) {
                return e ? /-MMM-/.test(a) ? n[e.month()] : t[e.month()] : t
            },
            monthsParseExact: !0,
            weekdays: "domingo_lunes_martes_mi??rcoles_jueves_viernes_s??bado".split("_"),
            weekdaysShort: "dom._lun._mar._mi??._jue._vie._s??b.".split("_"),
            weekdaysMin: "do_lu_ma_mi_ju_vi_s??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D [de] MMMM [de] YYYY",
                LLL: "D [de] MMMM [de] YYYY h:mm A",
                LLLL: "dddd, D [de] MMMM [de] YYYY h:mm A"
            },
            calendar: {
                sameDay: function() {
                    return "[hoy a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                nextDay: function() {
                    return "[ma??ana a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                nextWeek: function() {
                    return "dddd [a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                lastDay: function() {
                    return "[ayer a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                lastWeek: function() {
                    return "[el] dddd [pasado a la" + (1 !== this.hours() ? "s" : "") + "] LT"
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "en %s",
                past: "hace %s",
                s: "unos segundos",
                m: "un minuto",
                mm: "%d minutos",
                h: "una hora",
                hh: "%d horas",
                d: "un d??a",
                dd: "%d d??as",
                M: "un mes",
                MM: "%d meses",
                y: "un a??o",
                yy: "%d a??os"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = {
                s: ["m??ne sekundi", "m??ni sekund", "paar sekundit"],
                m: ["??he minuti", "??ks minut"],
                mm: [e + " minuti", e + " minutit"],
                h: ["??he tunni", "tund aega", "??ks tund"],
                hh: [e + " tunni", e + " tundi"],
                d: ["??he p??eva", "??ks p??ev"],
                M: ["kuu aja", "kuu aega", "??ks kuu"],
                MM: [e + " kuu", e + " kuud"],
                y: ["??he aasta", "aasta", "??ks aasta"],
                yy: [e + " aasta", e + " aastat"]
            };
            return t ? r[n][2] ? r[n][2] : r[n][1] : a ? r[n][0] : r[n][1]
        }
        return e.defineLocale("et", {
            months: "jaanuar_veebruar_m??rts_aprill_mai_juuni_juuli_august_september_oktoober_november_detsember".split("_"),
            monthsShort: "jaan_veebr_m??rts_apr_mai_juuni_juuli_aug_sept_okt_nov_dets".split("_"),
            weekdays: "p??hap??ev_esmasp??ev_teisip??ev_kolmap??ev_neljap??ev_reede_laup??ev".split("_"),
            weekdaysShort: "P_E_T_K_N_R_L".split("_"),
            weekdaysMin: "P_E_T_K_N_R_L".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd, D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[T??na,] LT",
                nextDay: "[Homme,] LT",
                nextWeek: "[J??rgmine] dddd LT",
                lastDay: "[Eile,] LT",
                lastWeek: "[Eelmine] dddd LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s p??rast",
                past: "%s tagasi",
                s: t,
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: t,
                dd: "%d p??eva",
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("eu", {
            months: "urtarrila_otsaila_martxoa_apirila_maiatza_ekaina_uztaila_abuztua_iraila_urria_azaroa_abendua".split("_"),
            monthsShort: "urt._ots._mar._api._mai._eka._uzt._abu._ira._urr._aza._abe.".split("_"),
            monthsParseExact: !0,
            weekdays: "igandea_astelehena_asteartea_asteazkena_osteguna_ostirala_larunbata".split("_"),
            weekdaysShort: "ig._al._ar._az._og._ol._lr.".split("_"),
            weekdaysMin: "ig_al_ar_az_og_ol_lr".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY-MM-DD",
                LL: "YYYY[ko] MMMM[ren] D[a]",
                LLL: "YYYY[ko] MMMM[ren] D[a] HH:mm",
                LLLL: "dddd, YYYY[ko] MMMM[ren] D[a] HH:mm",
                l: "YYYY-M-D",
                ll: "YYYY[ko] MMM D[a]",
                lll: "YYYY[ko] MMM D[a] HH:mm",
                llll: "ddd, YYYY[ko] MMM D[a] HH:mm"
            },
            calendar: {
                sameDay: "[gaur] LT[etan]",
                nextDay: "[bihar] LT[etan]",
                nextWeek: "dddd LT[etan]",
                lastDay: "[atzo] LT[etan]",
                lastWeek: "[aurreko] dddd LT[etan]",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s barru",
                past: "duela %s",
                s: "segundo batzuk",
                m: "minutu bat",
                mm: "%d minutu",
                h: "ordu bat",
                hh: "%d ordu",
                d: "egun bat",
                dd: "%d egun",
                M: "hilabete bat",
                MM: "%d hilabete",
                y: "urte bat",
                yy: "%d urte"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "??",
            2: "??",
            3: "??",
            4: "??",
            5: "??",
            6: "??",
            7: "??",
            8: "??",
            9: "??",
            0: "??"
        }
          , n = {
            "??": "1",
            "??": "2",
            "??": "3",
            "??": "4",
            "??": "5",
            "??": "6",
            "??": "7",
            "??": "8",
            "??": "9",
            "??": "0"
        };
        return e.defineLocale("fa", {
            months: "????????????_??????????_????????_??????????_????_????????_??????????_??????_??????????????_??????????_????????????_????????????".split("_"),
            monthsShort: "????????????_??????????_????????_??????????_????_????????_??????????_??????_??????????????_??????????_????????????_????????????".split("_"),
            weekdays: "???????????????_????????????_???????????????_????????????????_?????????????????_????????_????????".split("_"),
            weekdaysShort: "???????????????_????????????_???????????????_????????????????_?????????????????_????????_????????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            meridiemParse: /?????? ???? ??????|?????? ???? ??????/,
            isPM: function(e) {
                return /?????? ???? ??????/.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "?????? ???? ??????" : "?????? ???? ??????"
            },
            calendar: {
                sameDay: "[?????????? ????????] LT",
                nextDay: "[???????? ????????] LT",
                nextWeek: "dddd [????????] LT",
                lastDay: "[?????????? ????????] LT",
                lastWeek: "dddd [??????] [????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "%s ??????",
                s: "?????? ??????????",
                m: "???? ??????????",
                mm: "%d ??????????",
                h: "???? ????????",
                hh: "%d ????????",
                d: "???? ??????",
                dd: "%d ??????",
                M: "???? ??????",
                MM: "%d ??????",
                y: "???? ??????",
                yy: "%d ??????"
            },
            preparse: function(e) {
                return e.replace(/[??-??]/g, function(e) {
                    return n[e]
                }).replace(/??/g, ",")
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                }).replace(/,/g, "??")
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 6,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, a, r) {
            var i = "";
            switch (a) {
            case "s":
                return r ? "muutaman sekunnin" : "muutama sekunti";
            case "m":
                return r ? "minuutin" : "minuutti";
            case "mm":
                i = r ? "minuutin" : "minuuttia";
                break;
            case "h":
                return r ? "tunnin" : "tunti";
            case "hh":
                i = r ? "tunnin" : "tuntia";
                break;
            case "d":
                return r ? "p??iv??n" : "p??iv??";
            case "dd":
                i = r ? "p??iv??n" : "p??iv????";
                break;
            case "M":
                return r ? "kuukauden" : "kuukausi";
            case "MM":
                i = r ? "kuukauden" : "kuukautta";
                break;
            case "y":
                return r ? "vuoden" : "vuosi";
            case "yy":
                i = r ? "vuoden" : "vuotta"
            }
            return i = n(e, r) + " " + i
        }
        function n(e, t) {
            return e < 10 ? t ? r[e] : a[e] : e
        }
        var a = "nolla yksi kaksi kolme nelj?? viisi kuusi seitsem??n kahdeksan yhdeks??n".split(" ")
          , r = ["nolla", "yhden", "kahden", "kolmen", "nelj??n", "viiden", "kuuden", a[7], a[8], a[9]];
        return e.defineLocale("fi", {
            months: "tammikuu_helmikuu_maaliskuu_huhtikuu_toukokuu_kes??kuu_hein??kuu_elokuu_syyskuu_lokakuu_marraskuu_joulukuu".split("_"),
            monthsShort: "tammi_helmi_maalis_huhti_touko_kes??_hein??_elo_syys_loka_marras_joulu".split("_"),
            weekdays: "sunnuntai_maanantai_tiistai_keskiviikko_torstai_perjantai_lauantai".split("_"),
            weekdaysShort: "su_ma_ti_ke_to_pe_la".split("_"),
            weekdaysMin: "su_ma_ti_ke_to_pe_la".split("_"),
            longDateFormat: {
                LT: "HH.mm",
                LTS: "HH.mm.ss",
                L: "DD.MM.YYYY",
                LL: "Do MMMM[ta] YYYY",
                LLL: "Do MMMM[ta] YYYY, [klo] HH.mm",
                LLLL: "dddd, Do MMMM[ta] YYYY, [klo] HH.mm",
                l: "D.M.YYYY",
                ll: "Do MMM YYYY",
                lll: "Do MMM YYYY, [klo] HH.mm",
                llll: "ddd, Do MMM YYYY, [klo] HH.mm"
            },
            calendar: {
                sameDay: "[t??n????n] [klo] LT",
                nextDay: "[huomenna] [klo] LT",
                nextWeek: "dddd [klo] LT",
                lastDay: "[eilen] [klo] LT",
                lastWeek: "[viime] dddd[na] [klo] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s p????st??",
                past: "%s sitten",
                s: t,
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("fo", {
            months: "januar_februar_mars_apr??l_mai_juni_juli_august_september_oktober_november_desember".split("_"),
            monthsShort: "jan_feb_mar_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_"),
            weekdays: "sunnudagur_m??nadagur_t??sdagur_mikudagur_h??sdagur_fr??ggjadagur_leygardagur".split("_"),
            weekdaysShort: "sun_m??n_t??s_mik_h??s_fr??_ley".split("_"),
            weekdaysMin: "su_m??_t??_mi_h??_fr_le".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D. MMMM, YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?? dag kl.] LT",
                nextDay: "[?? morgin kl.] LT",
                nextWeek: "dddd [kl.] LT",
                lastDay: "[?? gj??r kl.] LT",
                lastWeek: "[s????stu] dddd [kl] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "um %s",
                past: "%s s????ani",
                s: "f?? sekund",
                m: "ein minutt",
                mm: "%d minuttir",
                h: "ein t??mi",
                hh: "%d t??mar",
                d: "ein dagur",
                dd: "%d dagar",
                M: "ein m??na??i",
                MM: "%d m??na??ir",
                y: "eitt ??r",
                yy: "%d ??r"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("fr", {
            months: "janvier_f??vrier_mars_avril_mai_juin_juillet_ao??t_septembre_octobre_novembre_d??cembre".split("_"),
            monthsShort: "janv._f??vr._mars_avr._mai_juin_juil._ao??t_sept._oct._nov._d??c.".split("_"),
            monthsParseExact: !0,
            weekdays: "dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
            weekdaysShort: "dim._lun._mar._mer._jeu._ven._sam.".split("_"),
            weekdaysMin: "Di_Lu_Ma_Me_Je_Ve_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Aujourd???hui ??] LT",
                nextDay: "[Demain ??] LT",
                nextWeek: "dddd [??] LT",
                lastDay: "[Hier ??] LT",
                lastWeek: "dddd [dernier ??] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "dans %s",
                past: "il y a %s",
                s: "quelques secondes",
                m: "une minute",
                mm: "%d minutes",
                h: "une heure",
                hh: "%d heures",
                d: "un jour",
                dd: "%d jours",
                M: "un mois",
                MM: "%d mois",
                y: "un an",
                yy: "%d ans"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(er|)/,
            ordinal: function(e, t) {
                switch (t) {
                case "D":
                    return e + (1 === e ? "er" : "");
                default:
                case "M":
                case "Q":
                case "DDD":
                case "d":
                    return e + (1 === e ? "er" : "e");
                case "w":
                case "W":
                    return e + (1 === e ? "re" : "e")
                }
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("fr-ca", {
            months: "janvier_f??vrier_mars_avril_mai_juin_juillet_ao??t_septembre_octobre_novembre_d??cembre".split("_"),
            monthsShort: "janv._f??vr._mars_avr._mai_juin_juil._ao??t_sept._oct._nov._d??c.".split("_"),
            monthsParseExact: !0,
            weekdays: "dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
            weekdaysShort: "dim._lun._mar._mer._jeu._ven._sam.".split("_"),
            weekdaysMin: "Di_Lu_Ma_Me_Je_Ve_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY-MM-DD",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Aujourd???hui ??] LT",
                nextDay: "[Demain ??] LT",
                nextWeek: "dddd [??] LT",
                lastDay: "[Hier ??] LT",
                lastWeek: "dddd [dernier ??] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "dans %s",
                past: "il y a %s",
                s: "quelques secondes",
                m: "une minute",
                mm: "%d minutes",
                h: "une heure",
                hh: "%d heures",
                d: "un jour",
                dd: "%d jours",
                M: "un mois",
                MM: "%d mois",
                y: "un an",
                yy: "%d ans"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(er|e)/,
            ordinal: function(e, t) {
                switch (t) {
                default:
                case "M":
                case "Q":
                case "D":
                case "DDD":
                case "d":
                    return e + (1 === e ? "er" : "e");
                case "w":
                case "W":
                    return e + (1 === e ? "re" : "e")
                }
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("fr-ch", {
            months: "janvier_f??vrier_mars_avril_mai_juin_juillet_ao??t_septembre_octobre_novembre_d??cembre".split("_"),
            monthsShort: "janv._f??vr._mars_avr._mai_juin_juil._ao??t_sept._oct._nov._d??c.".split("_"),
            monthsParseExact: !0,
            weekdays: "dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
            weekdaysShort: "dim._lun._mar._mer._jeu._ven._sam.".split("_"),
            weekdaysMin: "Di_Lu_Ma_Me_Je_Ve_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Aujourd???hui ??] LT",
                nextDay: "[Demain ??] LT",
                nextWeek: "dddd [??] LT",
                lastDay: "[Hier ??] LT",
                lastWeek: "dddd [dernier ??] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "dans %s",
                past: "il y a %s",
                s: "quelques secondes",
                m: "une minute",
                mm: "%d minutes",
                h: "une heure",
                hh: "%d heures",
                d: "un jour",
                dd: "%d jours",
                M: "un mois",
                MM: "%d mois",
                y: "un an",
                yy: "%d ans"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(er|e)/,
            ordinal: function(e, t) {
                switch (t) {
                default:
                case "M":
                case "Q":
                case "D":
                case "DDD":
                case "d":
                    return e + (1 === e ? "er" : "e");
                case "w":
                case "W":
                    return e + (1 === e ? "re" : "e")
                }
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = "jan._feb._mrt._apr._mai_jun._jul._aug._sep._okt._nov._des.".split("_")
          , n = "jan_feb_mrt_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_");
        return e.defineLocale("fy", {
            months: "jannewaris_febrewaris_maart_april_maaie_juny_july_augustus_septimber_oktober_novimber_desimber".split("_"),
            monthsShort: function(e, a) {
                return e ? /-MMM-/.test(a) ? n[e.month()] : t[e.month()] : t
            },
            monthsParseExact: !0,
            weekdays: "snein_moandei_tiisdei_woansdei_tongersdei_freed_sneon".split("_"),
            weekdaysShort: "si._mo._ti._wo._to._fr._so.".split("_"),
            weekdaysMin: "Si_Mo_Ti_Wo_To_Fr_So".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD-MM-YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[hjoed om] LT",
                nextDay: "[moarn om] LT",
                nextWeek: "dddd [om] LT",
                lastDay: "[juster om] LT",
                lastWeek: "[??fr??ne] dddd [om] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "oer %s",
                past: "%s lyn",
                s: "in pear sekonden",
                m: "ien min??t",
                mm: "%d minuten",
                h: "ien oere",
                hh: "%d oeren",
                d: "ien dei",
                dd: "%d dagen",
                M: "ien moanne",
                MM: "%d moannen",
                y: "ien jier",
                yy: "%d jierren"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
            ordinal: function(e) {
                return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = ["Am Faoilleach", "An Gearran", "Am M??rt", "An Giblean", "An C??itean", "An t-??gmhios", "An t-Iuchar", "An L??nastal", "An t-Sultain", "An D??mhair", "An t-Samhain", "An D??bhlachd"]
          , n = ["Faoi", "Gear", "M??rt", "Gibl", "C??it", "??gmh", "Iuch", "L??n", "Sult", "D??mh", "Samh", "D??bh"]
          , a = ["Did??mhnaich", "Diluain", "Dim??irt", "Diciadain", "Diardaoin", "Dihaoine", "Disathairne"]
          , r = ["Did", "Dil", "Dim", "Dic", "Dia", "Dih", "Dis"]
          , i = ["D??", "Lu", "M??", "Ci", "Ar", "Ha", "Sa"];
        return e.defineLocale("gd", {
            months: t,
            monthsShort: n,
            monthsParseExact: !0,
            weekdays: a,
            weekdaysShort: r,
            weekdaysMin: i,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[An-diugh aig] LT",
                nextDay: "[A-m??ireach aig] LT",
                nextWeek: "dddd [aig] LT",
                lastDay: "[An-d?? aig] LT",
                lastWeek: "dddd [seo chaidh] [aig] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "ann an %s",
                past: "bho chionn %s",
                s: "beagan diogan",
                m: "mionaid",
                mm: "%d mionaidean",
                h: "uair",
                hh: "%d uairean",
                d: "latha",
                dd: "%d latha",
                M: "m??os",
                MM: "%d m??osan",
                y: "bliadhna",
                yy: "%d bliadhna"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(d|na|mh)/,
            ordinal: function(e) {
                return e + (1 === e ? "d" : e % 10 == 2 ? "na" : "mh")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("gl", {
            months: "xaneiro_febreiro_marzo_abril_maio_xu??o_xullo_agosto_setembro_outubro_novembro_decembro".split("_"),
            monthsShort: "xan._feb._mar._abr._mai._xu??._xul._ago._set._out._nov._dec.".split("_"),
            monthsParseExact: !0,
            weekdays: "domingo_luns_martes_m??rcores_xoves_venres_s??bado".split("_"),
            weekdaysShort: "dom._lun._mar._m??r._xov._ven._s??b.".split("_"),
            weekdaysMin: "do_lu_ma_m??_xo_ve_s??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D [de] MMMM [de] YYYY",
                LLL: "D [de] MMMM [de] YYYY H:mm",
                LLLL: "dddd, D [de] MMMM [de] YYYY H:mm"
            },
            calendar: {
                sameDay: function() {
                    return "[hoxe " + (1 !== this.hours() ? "??s" : "??") + "] LT"
                },
                nextDay: function() {
                    return "[ma???? " + (1 !== this.hours() ? "??s" : "??") + "] LT"
                },
                nextWeek: function() {
                    return "dddd [" + (1 !== this.hours() ? "??s" : "a") + "] LT"
                },
                lastDay: function() {
                    return "[onte " + (1 !== this.hours() ? "??" : "a") + "] LT"
                },
                lastWeek: function() {
                    return "[o] dddd [pasado " + (1 !== this.hours() ? "??s" : "a") + "] LT"
                },
                sameElse: "L"
            },
            relativeTime: {
                future: function(e) {
                    return 0 === e.indexOf("un") ? "n" + e : "en " + e
                },
                past: "hai %s",
                s: "uns segundos",
                m: "un minuto",
                mm: "%d minutos",
                h: "unha hora",
                hh: "%d horas",
                d: "un d??a",
                dd: "%d d??as",
                M: "un mes",
                MM: "%d meses",
                y: "un ano",
                yy: "%d anos"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = {
                s: ["thodde secondanim", "thodde second"],
                m: ["eka mintan", "ek minute"],
                mm: [e + " mintanim", e + " mintam"],
                h: ["eka horan", "ek hor"],
                hh: [e + " horanim", e + " hor"],
                d: ["eka disan", "ek dis"],
                dd: [e + " disanim", e + " dis"],
                M: ["eka mhoinean", "ek mhoino"],
                MM: [e + " mhoineanim", e + " mhoine"],
                y: ["eka vorsan", "ek voros"],
                yy: [e + " vorsanim", e + " vorsam"]
            };
            return t ? r[n][0] : r[n][1]
        }
        return e.defineLocale("gom-latn", {
            months: "Janer_Febrer_Mars_Abril_Mai_Jun_Julai_Agost_Setembr_Otubr_Novembr_Dezembr".split("_"),
            monthsShort: "Jan._Feb._Mars_Abr._Mai_Jun_Jul._Ago._Set._Otu._Nov._Dez.".split("_"),
            monthsParseExact: !0,
            weekdays: "Aitar_Somar_Mongllar_Budvar_Brestar_Sukrar_Son'var".split("_"),
            weekdaysShort: "Ait._Som._Mon._Bud._Bre._Suk._Son.".split("_"),
            weekdaysMin: "Ai_Sm_Mo_Bu_Br_Su_Sn".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "A h:mm [vazta]",
                LTS: "A h:mm:ss [vazta]",
                L: "DD-MM-YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY A h:mm [vazta]",
                LLLL: "dddd, MMMM[achea] Do, YYYY, A h:mm [vazta]",
                llll: "ddd, D MMM YYYY, A h:mm [vazta]"
            },
            calendar: {
                sameDay: "[Aiz] LT",
                nextDay: "[Faleam] LT",
                nextWeek: "[Ieta to] dddd[,] LT",
                lastDay: "[Kal] LT",
                lastWeek: "[Fatlo] dddd[,] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s",
                past: "%s adim",
                s: t,
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}(er)/,
            ordinal: function(e, t) {
                switch (t) {
                case "D":
                    return e + "er";
                default:
                case "M":
                case "Q":
                case "DDD":
                case "d":
                case "w":
                case "W":
                    return e
                }
            },
            week: {
                dow: 1,
                doy: 4
            },
            meridiemParse: /rati|sokalli|donparam|sanje/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "rati" === t ? e < 4 ? e : e + 12 : "sokalli" === t ? e : "donparam" === t ? e > 12 ? e : e + 12 : "sanje" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "rati" : e < 12 ? "sokalli" : e < 16 ? "donparam" : e < 20 ? "sanje" : "rati"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("he", {
            months: "??????????_????????????_??????_??????????_??????_????????_????????_????????????_????????????_??????????????_????????????_??????????".split("_"),
            monthsShort: "????????_????????_??????_????????_??????_????????_????????_????????_????????_????????_????????_????????".split("_"),
            weekdays: "??????????_??????_??????????_??????????_??????????_????????_??????".split("_"),
            weekdaysShort: "????_????_????_????_????_????_????".split("_"),
            weekdaysMin: "??_??_??_??_??_??_??".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D [??]MMMM YYYY",
                LLL: "D [??]MMMM YYYY HH:mm",
                LLLL: "dddd, D [??]MMMM YYYY HH:mm",
                l: "D/M/YYYY",
                ll: "D MMM YYYY",
                lll: "D MMM YYYY HH:mm",
                llll: "ddd, D MMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[???????? ????]LT",
                nextDay: "[?????? ????]LT",
                nextWeek: "dddd [????????] LT",
                lastDay: "[?????????? ????]LT",
                lastWeek: "[????????] dddd [???????????? ????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???????? %s",
                past: "???????? %s",
                s: "???????? ??????????",
                m: "??????",
                mm: "%d ????????",
                h: "??????",
                hh: function(e) {
                    return 2 === e ? "????????????" : e + " ????????"
                },
                d: "??????",
                dd: function(e) {
                    return 2 === e ? "????????????" : e + " ????????"
                },
                M: "????????",
                MM: function(e) {
                    return 2 === e ? "??????????????" : e + " ????????????"
                },
                y: "??????",
                yy: function(e) {
                    return 2 === e ? "????????????" : e % 10 == 0 && 10 !== e ? e + " ??????" : e + " ????????"
                }
            },
            meridiemParse: /??????"??|????????"??|???????? ??????????????|???????? ??????????????|?????????? ????????|??????????|????????/i,
            isPM: function(e) {
                return /^(??????"??|???????? ??????????????|????????)$/.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 5 ? "?????????? ????????" : e < 10 ? "??????????" : e < 12 ? n ? '????????"??' : "???????? ??????????????" : e < 18 ? n ? '??????"??' : "???????? ??????????????" : "????????"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("hi", {
            months: "???????????????_??????????????????_???????????????_??????????????????_??????_?????????_???????????????_???????????????_?????????????????????_?????????????????????_??????????????????_?????????????????????".split("_"),
            monthsShort: "??????._?????????._???????????????_???????????????._??????_?????????_?????????._??????._?????????._???????????????._??????._?????????.".split("_"),
            monthsParseExact: !0,
            weekdays: "??????????????????_??????????????????_?????????????????????_??????????????????_?????????????????????_????????????????????????_??????????????????".split("_"),
            weekdaysShort: "?????????_?????????_????????????_?????????_????????????_???????????????_?????????".split("_"),
            weekdaysMin: "???_??????_??????_??????_??????_??????_???".split("_"),
            longDateFormat: {
                LT: "A h:mm ?????????",
                LTS: "A h:mm:ss ?????????",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm ?????????",
                LLLL: "dddd, D MMMM YYYY, A h:mm ?????????"
            },
            calendar: {
                sameDay: "[??????] LT",
                nextDay: "[??????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[??????] LT",
                lastWeek: "[???????????????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ?????????",
                past: "%s ????????????",
                s: "????????? ?????? ????????????",
                m: "?????? ????????????",
                mm: "%d ????????????",
                h: "?????? ????????????",
                hh: "%d ????????????",
                d: "?????? ?????????",
                dd: "%d ?????????",
                M: "?????? ???????????????",
                MM: "%d ???????????????",
                y: "?????? ????????????",
                yy: "%d ????????????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            meridiemParse: /?????????|????????????|???????????????|?????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "?????????" === t ? e < 4 ? e : e + 12 : "????????????" === t ? e : "???????????????" === t ? e >= 10 ? e : e + 12 : "?????????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "?????????" : e < 10 ? "????????????" : e < 17 ? "???????????????" : e < 20 ? "?????????" : "?????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n) {
            var a = e + " ";
            switch (n) {
            case "m":
                return t ? "jedna minuta" : "jedne minute";
            case "mm":
                return a += 1 === e ? "minuta" : 2 === e || 3 === e || 4 === e ? "minute" : "minuta";
            case "h":
                return t ? "jedan sat" : "jednog sata";
            case "hh":
                return a += 1 === e ? "sat" : 2 === e || 3 === e || 4 === e ? "sata" : "sati";
            case "dd":
                return a += 1 === e ? "dan" : "dana";
            case "MM":
                return a += 1 === e ? "mjesec" : 2 === e || 3 === e || 4 === e ? "mjeseca" : "mjeseci";
            case "yy":
                return a += 1 === e ? "godina" : 2 === e || 3 === e || 4 === e ? "godine" : "godina"
            }
        }
        return e.defineLocale("hr", {
            months: {
                format: "sije??nja_velja??e_o??ujka_travnja_svibnja_lipnja_srpnja_kolovoza_rujna_listopada_studenoga_prosinca".split("_"),
                standalone: "sije??anj_velja??a_o??ujak_travanj_svibanj_lipanj_srpanj_kolovoz_rujan_listopad_studeni_prosinac".split("_")
            },
            monthsShort: "sij._velj._o??u._tra._svi._lip._srp._kol._ruj._lis._stu._pro.".split("_"),
            monthsParseExact: !0,
            weekdays: "nedjelja_ponedjeljak_utorak_srijeda_??etvrtak_petak_subota".split("_"),
            weekdaysShort: "ned._pon._uto._sri._??et._pet._sub.".split("_"),
            weekdaysMin: "ne_po_ut_sr_??e_pe_su".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd, D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[danas u] LT",
                nextDay: "[sutra u] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[u] [nedjelju] [u] LT";
                    case 3:
                        return "[u] [srijedu] [u] LT";
                    case 6:
                        return "[u] [subotu] [u] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[u] dddd [u] LT"
                    }
                },
                lastDay: "[ju??er u] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                    case 3:
                        return "[pro??lu] dddd [u] LT";
                    case 6:
                        return "[pro??le] [subote] [u] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[pro??li] dddd [u] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "za %s",
                past: "prije %s",
                s: "par sekundi",
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: "dan",
                dd: t,
                M: "mjesec",
                MM: t,
                y: "godinu",
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = e;
            switch (n) {
            case "s":
                return a || t ? "n??h??ny m??sodperc" : "n??h??ny m??sodperce";
            case "m":
                return "egy" + (a || t ? " perc" : " perce");
            case "mm":
                return r + (a || t ? " perc" : " perce");
            case "h":
                return "egy" + (a || t ? " ??ra" : " ??r??ja");
            case "hh":
                return r + (a || t ? " ??ra" : " ??r??ja");
            case "d":
                return "egy" + (a || t ? " nap" : " napja");
            case "dd":
                return r + (a || t ? " nap" : " napja");
            case "M":
                return "egy" + (a || t ? " h??nap" : " h??napja");
            case "MM":
                return r + (a || t ? " h??nap" : " h??napja");
            case "y":
                return "egy" + (a || t ? " ??v" : " ??ve");
            case "yy":
                return r + (a || t ? " ??v" : " ??ve")
            }
            return ""
        }
        function n(e) {
            return (e ? "" : "[m??lt] ") + "[" + a[this.day()] + "] LT[-kor]"
        }
        var a = "vas??rnap h??tf??n kedden szerd??n cs??t??rt??k??n p??nteken szombaton".split(" ");
        return e.defineLocale("hu", {
            months: "janu??r_febru??r_m??rcius_??prilis_m??jus_j??nius_j??lius_augusztus_szeptember_okt??ber_november_december".split("_"),
            monthsShort: "jan_feb_m??rc_??pr_m??j_j??n_j??l_aug_szept_okt_nov_dec".split("_"),
            weekdays: "vas??rnap_h??tf??_kedd_szerda_cs??t??rt??k_p??ntek_szombat".split("_"),
            weekdaysShort: "vas_h??t_kedd_sze_cs??t_p??n_szo".split("_"),
            weekdaysMin: "v_h_k_sze_cs_p_szo".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "YYYY.MM.DD.",
                LL: "YYYY. MMMM D.",
                LLL: "YYYY. MMMM D. H:mm",
                LLLL: "YYYY. MMMM D., dddd H:mm"
            },
            meridiemParse: /de|du/i,
            isPM: function(e) {
                return "u" === e.charAt(1).toLowerCase()
            },
            meridiem: function(e, t, n) {
                return e < 12 ? !0 === n ? "de" : "DE" : !0 === n ? "du" : "DU"
            },
            calendar: {
                sameDay: "[ma] LT[-kor]",
                nextDay: "[holnap] LT[-kor]",
                nextWeek: function() {
                    return n.call(this, !0)
                },
                lastDay: "[tegnap] LT[-kor]",
                lastWeek: function() {
                    return n.call(this, !1)
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "%s m??lva",
                past: "%s",
                s: t,
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("hy-am", {
            months: {
                format: "????????????????_????????????????_??????????_????????????_????????????_??????????????_??????????????_????????????????_????????????????????_????????????????????_??????????????????_????????????????????".split("_"),
                standalone: "??????????????_??????????????_????????_??????????_??????????_????????????_????????????_??????????????_??????????????????_??????????????????_????????????????_??????????????????".split("_")
            },
            monthsShort: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "????????????_????????????????????_??????????????????_????????????????????_??????????????????_????????????_??????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_????????_??????".split("_"),
            weekdaysMin: "??????_??????_??????_??????_??????_????????_??????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY ??.",
                LLL: "D MMMM YYYY ??., HH:mm",
                LLLL: "dddd, D MMMM YYYY ??., HH:mm"
            },
            calendar: {
                sameDay: "[??????????] LT",
                nextDay: "[????????] LT",
                lastDay: "[????????] LT",
                nextWeek: function() {
                    return "dddd [?????? ????????] LT"
                },
                lastWeek: function() {
                    return "[??????????] dddd [?????? ????????] LT"
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ????????",
                past: "%s ????????",
                s: "???? ???????? ????????????????",
                m: "????????",
                mm: "%d ????????",
                h: "??????",
                hh: "%d ??????",
                d: "????",
                dd: "%d ????",
                M: "????????",
                MM: "%d ????????",
                y: "????????",
                yy: "%d ????????"
            },
            meridiemParse: /??????????????|????????????????|??????????????|????????????????/,
            isPM: function(e) {
                return /^(??????????????|????????????????)$/.test(e)
            },
            meridiem: function(e) {
                return e < 4 ? "??????????????" : e < 12 ? "????????????????" : e < 17 ? "??????????????" : "????????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}|\d{1,2}-(????|????)/,
            ordinal: function(e, t) {
                switch (t) {
                case "DDD":
                case "w":
                case "W":
                case "DDDo":
                    return 1 === e ? e + "-????" : e + "-????";
                default:
                    return e
                }
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("id", {
            months: "Januari_Februari_Maret_April_Mei_Juni_Juli_Agustus_September_Oktober_November_Desember".split("_"),
            monthsShort: "Jan_Feb_Mar_Apr_Mei_Jun_Jul_Ags_Sep_Okt_Nov_Des".split("_"),
            weekdays: "Minggu_Senin_Selasa_Rabu_Kamis_Jumat_Sabtu".split("_"),
            weekdaysShort: "Min_Sen_Sel_Rab_Kam_Jum_Sab".split("_"),
            weekdaysMin: "Mg_Sn_Sl_Rb_Km_Jm_Sb".split("_"),
            longDateFormat: {
                LT: "HH.mm",
                LTS: "HH.mm.ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY [pukul] HH.mm",
                LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
            },
            meridiemParse: /pagi|siang|sore|malam/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "pagi" === t ? e : "siang" === t ? e >= 11 ? e : e + 12 : "sore" === t || "malam" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 11 ? "pagi" : e < 15 ? "siang" : e < 19 ? "sore" : "malam"
            },
            calendar: {
                sameDay: "[Hari ini pukul] LT",
                nextDay: "[Besok pukul] LT",
                nextWeek: "dddd [pukul] LT",
                lastDay: "[Kemarin pukul] LT",
                lastWeek: "dddd [lalu pukul] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "dalam %s",
                past: "%s yang lalu",
                s: "beberapa detik",
                m: "semenit",
                mm: "%d menit",
                h: "sejam",
                hh: "%d jam",
                d: "sehari",
                dd: "%d hari",
                M: "sebulan",
                MM: "%d bulan",
                y: "setahun",
                yy: "%d tahun"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e) {
            return e % 100 == 11 || e % 10 != 1
        }
        function n(e, n, a, r) {
            var i = e + " ";
            switch (a) {
            case "s":
                return n || r ? "nokkrar sek??ndur" : "nokkrum sek??ndum";
            case "m":
                return n ? "m??n??ta" : "m??n??tu";
            case "mm":
                return t(e) ? i + (n || r ? "m??n??tur" : "m??n??tum") : n ? i + "m??n??ta" : i + "m??n??tu";
            case "hh":
                return t(e) ? i + (n || r ? "klukkustundir" : "klukkustundum") : i + "klukkustund";
            case "d":
                return n ? "dagur" : r ? "dag" : "degi";
            case "dd":
                return t(e) ? n ? i + "dagar" : i + (r ? "daga" : "d??gum") : n ? i + "dagur" : i + (r ? "dag" : "degi");
            case "M":
                return n ? "m??nu??ur" : r ? "m??nu??" : "m??nu??i";
            case "MM":
                return t(e) ? n ? i + "m??nu??ir" : i + (r ? "m??nu??i" : "m??nu??um") : n ? i + "m??nu??ur" : i + (r ? "m??nu??" : "m??nu??i");
            case "y":
                return n || r ? "??r" : "??ri";
            case "yy":
                return t(e) ? i + (n || r ? "??r" : "??rum") : i + (n || r ? "??r" : "??ri")
            }
        }
        return e.defineLocale("is", {
            months: "jan??ar_febr??ar_mars_apr??l_ma??_j??n??_j??l??_??g??st_september_okt??ber_n??vember_desember".split("_"),
            monthsShort: "jan_feb_mar_apr_ma??_j??n_j??l_??g??_sep_okt_n??v_des".split("_"),
            weekdays: "sunnudagur_m??nudagur_??ri??judagur_mi??vikudagur_fimmtudagur_f??studagur_laugardagur".split("_"),
            weekdaysShort: "sun_m??n_??ri_mi??_fim_f??s_lau".split("_"),
            weekdaysMin: "Su_M??_??r_Mi_Fi_F??_La".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY [kl.] H:mm",
                LLLL: "dddd, D. MMMM YYYY [kl.] H:mm"
            },
            calendar: {
                sameDay: "[?? dag kl.] LT",
                nextDay: "[?? morgun kl.] LT",
                nextWeek: "dddd [kl.] LT",
                lastDay: "[?? g??r kl.] LT",
                lastWeek: "[s????asta] dddd [kl.] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "eftir %s",
                past: "fyrir %s s????an",
                s: n,
                m: n,
                mm: n,
                h: "klukkustund",
                hh: n,
                d: n,
                dd: n,
                M: n,
                MM: n,
                y: n,
                yy: n
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("it", {
            months: "gennaio_febbraio_marzo_aprile_maggio_giugno_luglio_agosto_settembre_ottobre_novembre_dicembre".split("_"),
            monthsShort: "gen_feb_mar_apr_mag_giu_lug_ago_set_ott_nov_dic".split("_"),
            weekdays: "domenica_luned??_marted??_mercoled??_gioved??_venerd??_sabato".split("_"),
            weekdaysShort: "dom_lun_mar_mer_gio_ven_sab".split("_"),
            weekdaysMin: "do_lu_ma_me_gi_ve_sa".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Oggi alle] LT",
                nextDay: "[Domani alle] LT",
                nextWeek: "dddd [alle] LT",
                lastDay: "[Ieri alle] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[la scorsa] dddd [alle] LT";
                    default:
                        return "[lo scorso] dddd [alle] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: function(e) {
                    return (/^[0-9].+$/.test(e) ? "tra" : "in") + " " + e
                },
                past: "%s fa",
                s: "alcuni secondi",
                m: "un minuto",
                mm: "%d minuti",
                h: "un'ora",
                hh: "%d ore",
                d: "un giorno",
                dd: "%d giorni",
                M: "un mese",
                MM: "%d mesi",
                y: "un anno",
                yy: "%d anni"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ja", {
            months: "1???_2???_3???_4???_5???_6???_7???_8???_9???_10???_11???_12???".split("_"),
            monthsShort: "1???_2???_3???_4???_5???_6???_7???_8???_9???_10???_11???_12???".split("_"),
            weekdays: "?????????_?????????_?????????_?????????_?????????_?????????_?????????".split("_"),
            weekdaysShort: "???_???_???_???_???_???_???".split("_"),
            weekdaysMin: "???_???_???_???_???_???_???".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY/MM/DD",
                LL: "YYYY???M???D???",
                LLL: "YYYY???M???D??? HH:mm",
                LLLL: "YYYY???M???D??? HH:mm dddd",
                l: "YYYY/MM/DD",
                ll: "YYYY???M???D???",
                lll: "YYYY???M???D??? HH:mm",
                llll: "YYYY???M???D??? HH:mm dddd"
            },
            meridiemParse: /??????|??????/i,
            isPM: function(e) {
                return "??????" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??????" : "??????"
            },
            calendar: {
                sameDay: "[??????] LT",
                nextDay: "[??????] LT",
                nextWeek: "[??????]dddd LT",
                lastDay: "[??????] LT",
                lastWeek: "[??????]dddd LT",
                sameElse: "L"
            },
            dayOfMonthOrdinalParse: /\d{1,2}???/,
            ordinal: function(e, t) {
                switch (t) {
                case "d":
                case "D":
                case "DDD":
                    return e + "???";
                default:
                    return e
                }
            },
            relativeTime: {
                future: "%s???",
                past: "%s???",
                s: "??????",
                m: "1???",
                mm: "%d???",
                h: "1??????",
                hh: "%d??????",
                d: "1???",
                dd: "%d???",
                M: "1??????",
                MM: "%d??????",
                y: "1???",
                yy: "%d???"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("jv", {
            months: "Januari_Februari_Maret_April_Mei_Juni_Juli_Agustus_September_Oktober_Nopember_Desember".split("_"),
            monthsShort: "Jan_Feb_Mar_Apr_Mei_Jun_Jul_Ags_Sep_Okt_Nop_Des".split("_"),
            weekdays: "Minggu_Senen_Seloso_Rebu_Kemis_Jemuwah_Septu".split("_"),
            weekdaysShort: "Min_Sen_Sel_Reb_Kem_Jem_Sep".split("_"),
            weekdaysMin: "Mg_Sn_Sl_Rb_Km_Jm_Sp".split("_"),
            longDateFormat: {
                LT: "HH.mm",
                LTS: "HH.mm.ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY [pukul] HH.mm",
                LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
            },
            meridiemParse: /enjing|siyang|sonten|ndalu/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "enjing" === t ? e : "siyang" === t ? e >= 11 ? e : e + 12 : "sonten" === t || "ndalu" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 11 ? "enjing" : e < 15 ? "siyang" : e < 19 ? "sonten" : "ndalu"
            },
            calendar: {
                sameDay: "[Dinten puniko pukul] LT",
                nextDay: "[Mbenjang pukul] LT",
                nextWeek: "dddd [pukul] LT",
                lastDay: "[Kala wingi pukul] LT",
                lastWeek: "dddd [kepengker pukul] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "wonten ing %s",
                past: "%s ingkang kepengker",
                s: "sawetawis detik",
                m: "setunggal menit",
                mm: "%d menit",
                h: "setunggal jam",
                hh: "%d jam",
                d: "sedinten",
                dd: "%d dinten",
                M: "sewulan",
                MM: "%d wulan",
                y: "setaun",
                yy: "%d taun"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ka", {
            months: {
                standalone: "?????????????????????_???????????????????????????_???????????????_??????????????????_???????????????_??????????????????_??????????????????_?????????????????????_??????????????????????????????_???????????????????????????_????????????????????????_???????????????????????????".split("_"),
                format: "?????????????????????_???????????????????????????_???????????????_?????????????????????_???????????????_??????????????????_??????????????????_?????????????????????_??????????????????????????????_???????????????????????????_????????????????????????_???????????????????????????".split("_")
            },
            monthsShort: "?????????_?????????_?????????_?????????_?????????_?????????_?????????_?????????_?????????_?????????_?????????_?????????".split("_"),
            weekdays: {
                standalone: "???????????????_????????????????????????_???????????????????????????_???????????????????????????_???????????????????????????_???????????????????????????_??????????????????".split("_"),
                format: "??????????????????_????????????????????????_???????????????????????????_???????????????????????????_???????????????????????????_???????????????????????????_??????????????????".split("_"),
                isFormat: /(????????????|??????????????????)/
            },
            weekdaysShort: "?????????_?????????_?????????_?????????_?????????_?????????_?????????".split("_"),
            weekdaysMin: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY h:mm A",
                LLLL: "dddd, D MMMM YYYY h:mm A"
            },
            calendar: {
                sameDay: "[????????????] LT[-??????]",
                nextDay: "[????????????] LT[-??????]",
                lastDay: "[???????????????] LT[-??????]",
                nextWeek: "[??????????????????] dddd LT[-??????]",
                lastWeek: "[????????????] dddd LT-??????",
                sameElse: "L"
            },
            relativeTime: {
                future: function(e) {
                    return /(????????????|????????????|???????????????|????????????)/.test(e) ? e.replace(/???$/, "??????") : e + "??????"
                },
                past: function(e) {
                    return /(????????????|????????????|???????????????|?????????|?????????)/.test(e) ? e.replace(/(???|???)$/, "?????? ????????????") : /????????????/.test(e) ? e.replace(/????????????$/, "???????????? ????????????") : void 0
                },
                s: "??????????????????????????? ????????????",
                m: "????????????",
                mm: "%d ????????????",
                h: "???????????????",
                hh: "%d ???????????????",
                d: "?????????",
                dd: "%d ?????????",
                M: "?????????",
                MM: "%d ?????????",
                y: "????????????",
                yy: "%d ????????????"
            },
            dayOfMonthOrdinalParse: /0|1-??????|??????-\d{1,2}|\d{1,2}-???/,
            ordinal: function(e) {
                return 0 === e ? e : 1 === e ? e + "-??????" : e < 20 || e <= 100 && e % 20 == 0 || e % 100 == 0 ? "??????-" + e : e + "-???"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            0: "-????",
            1: "-????",
            2: "-????",
            3: "-????",
            4: "-????",
            5: "-????",
            6: "-????",
            7: "-????",
            8: "-????",
            9: "-????",
            10: "-????",
            20: "-????",
            30: "-????",
            40: "-????",
            50: "-????",
            60: "-????",
            70: "-????",
            80: "-????",
            90: "-????",
            100: "-????"
        };
        return e.defineLocale("kk", {
            months: "????????????_??????????_????????????_??????????_??????????_????????????_??????????_??????????_????????????????_??????????_????????????_??????????????????".split("_"),
            monthsShort: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "????????????????_????????????????_????????????????_????????????????_????????????????_????????_??????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ??????????] LT",
                nextDay: "[?????????? ??????????] LT",
                nextWeek: "dddd [??????????] LT",
                lastDay: "[???????? ??????????] LT",
                lastWeek: "[?????????? ??????????????] dddd [??????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ????????????",
                past: "%s ??????????",
                s: "?????????????? ????????????",
                m: "?????? ??????????",
                mm: "%d ??????????",
                h: "?????? ??????????",
                hh: "%d ??????????",
                d: "?????? ??????",
                dd: "%d ??????",
                M: "?????? ????",
                MM: "%d ????",
                y: "?????? ??????",
                yy: "%d ??????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(????|????)/,
            ordinal: function(e) {
                var n = e % 10
                  , a = e >= 100 ? 100 : null;
                return e + (t[e] || t[n] || t[a])
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("km", {
            months: "????????????_??????????????????_????????????_????????????_????????????_??????????????????_??????????????????_????????????_???????????????_????????????_????????????????????????_????????????".split("_"),
            monthsShort: "????????????_??????????????????_????????????_????????????_????????????_??????????????????_??????????????????_????????????_???????????????_????????????_????????????????????????_????????????".split("_"),
            weekdays: "?????????????????????_???????????????_??????????????????_?????????_??????????????????????????????_???????????????_????????????".split("_"),
            weekdaysShort: "?????????????????????_???????????????_??????????????????_?????????_??????????????????????????????_???????????????_????????????".split("_"),
            weekdaysMin: "?????????????????????_???????????????_??????????????????_?????????_??????????????????????????????_???????????????_????????????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[????????????????????? ????????????] LT",
                nextDay: "[??????????????? ????????????] LT",
                nextWeek: "dddd [????????????] LT",
                lastDay: "[???????????????????????? ????????????] LT",
                lastWeek: "dddd [??????????????????????????????] [????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s?????????",
                past: "%s?????????",
                s: "??????????????????????????????????????????",
                m: "?????????????????????",
                mm: "%d ????????????",
                h: "?????????????????????",
                hh: "%d ????????????",
                d: "?????????????????????",
                dd: "%d ????????????",
                M: "???????????????",
                MM: "%d ??????",
                y: "????????????????????????",
                yy: "%d ???????????????"
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("kn", {
            months: "???????????????_????????????????????????_??????????????????_?????????????????????_?????????_????????????_???????????????_??????????????????_??????????????????????????????_??????????????????????????????_?????????????????????_????????????????????????".split("_"),
            monthsShort: "??????_???????????????_??????????????????_?????????????????????_?????????_????????????_???????????????_??????????????????_????????????????????????_????????????????????????_???????????????_??????????????????".split("_"),
            monthsParseExact: !0,
            weekdays: "?????????????????????_????????????????????????_?????????????????????_??????????????????_?????????????????????_????????????????????????_??????????????????".split("_"),
            weekdaysShort: "????????????_???????????????_????????????_?????????_????????????_???????????????_?????????".split("_"),
            weekdaysMin: "??????_????????????_??????_??????_??????_??????_???".split("_"),
            longDateFormat: {
                LT: "A h:mm",
                LTS: "A h:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm",
                LLLL: "dddd, D MMMM YYYY, A h:mm"
            },
            calendar: {
                sameDay: "[????????????] LT",
                nextDay: "[????????????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[??????????????????] LT",
                lastWeek: "[??????????????????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ????????????",
                past: "%s ???????????????",
                s: "??????????????? ?????????????????????",
                m: "???????????? ???????????????",
                mm: "%d ???????????????",
                h: "???????????? ????????????",
                hh: "%d ????????????",
                d: "???????????? ?????????",
                dd: "%d ?????????",
                M: "???????????? ??????????????????",
                MM: "%d ??????????????????",
                y: "???????????? ????????????",
                yy: "%d ????????????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            meridiemParse: /??????????????????|????????????????????????|????????????????????????|????????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????????????????" === t ? e < 4 ? e : e + 12 : "????????????????????????" === t ? e : "????????????????????????" === t ? e >= 10 ? e : e + 12 : "????????????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "??????????????????" : e < 10 ? "????????????????????????" : e < 17 ? "????????????????????????" : e < 20 ? "????????????" : "??????????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(?????????)/,
            ordinal: function(e) {
                return e + "?????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ko", {
            months: "1???_2???_3???_4???_5???_6???_7???_8???_9???_10???_11???_12???".split("_"),
            monthsShort: "1???_2???_3???_4???_5???_6???_7???_8???_9???_10???_11???_12???".split("_"),
            weekdays: "?????????_?????????_?????????_?????????_?????????_?????????_?????????".split("_"),
            weekdaysShort: "???_???_???_???_???_???_???".split("_"),
            weekdaysMin: "???_???_???_???_???_???_???".split("_"),
            longDateFormat: {
                LT: "A h:mm",
                LTS: "A h:mm:ss",
                L: "YYYY.MM.DD",
                LL: "YYYY??? MMMM D???",
                LLL: "YYYY??? MMMM D??? A h:mm",
                LLLL: "YYYY??? MMMM D??? dddd A h:mm",
                l: "YYYY.MM.DD",
                ll: "YYYY??? MMMM D???",
                lll: "YYYY??? MMMM D??? A h:mm",
                llll: "YYYY??? MMMM D??? dddd A h:mm"
            },
            calendar: {
                sameDay: "?????? LT",
                nextDay: "?????? LT",
                nextWeek: "dddd LT",
                lastDay: "?????? LT",
                lastWeek: "????????? dddd LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ???",
                past: "%s ???",
                s: "??? ???",
                ss: "%d???",
                m: "1???",
                mm: "%d???",
                h: "??? ??????",
                hh: "%d??????",
                d: "??????",
                dd: "%d???",
                M: "??? ???",
                MM: "%d???",
                y: "??? ???",
                yy: "%d???"
            },
            dayOfMonthOrdinalParse: /\d{1,2}???/,
            ordinal: "%d???",
            meridiemParse: /??????|??????/,
            isPM: function(e) {
                return "??????" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??????" : "??????"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            0: "-????",
            1: "-????",
            2: "-????",
            3: "-????",
            4: "-????",
            5: "-????",
            6: "-????",
            7: "-????",
            8: "-????",
            9: "-????",
            10: "-????",
            20: "-????",
            30: "-????",
            40: "-????",
            50: "-????",
            60: "-????",
            70: "-????",
            80: "-????",
            90: "-????",
            100: "-????"
        };
        return e.defineLocale("ky", {
            months: "????????????_??????????????_????????_????????????_??????_????????_????????_????????????_????????????????_??????????????_????????????_??????????????".split("_"),
            monthsShort: "??????_??????_????????_??????_??????_????????_????????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "????????????????_????????????????_????????????????_????????????????_????????????????_????????_????????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ????????] LT",
                nextDay: "[?????????? ????????] LT",
                nextWeek: "dddd [????????] LT",
                lastDay: "[???????? ????????] LT",
                lastWeek: "[?????????? ??????????????] dddd [????????] [????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ????????????",
                past: "%s ??????????",
                s: "?????????????? ????????????",
                m: "?????? ??????????",
                mm: "%d ??????????",
                h: "?????? ????????",
                hh: "%d ????????",
                d: "?????? ??????",
                dd: "%d ??????",
                M: "?????? ????",
                MM: "%d ????",
                y: "?????? ??????",
                yy: "%d ??????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(????|????|????|????)/,
            ordinal: function(e) {
                var n = e % 10
                  , a = e >= 100 ? 100 : null;
                return e + (t[e] || t[n] || t[a])
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = {
                m: ["eng Minutt", "enger Minutt"],
                h: ["eng Stonn", "enger Stonn"],
                d: ["een Dag", "engem Dag"],
                M: ["ee Mount", "engem Mount"],
                y: ["ee Joer", "engem Joer"]
            };
            return t ? r[n][0] : r[n][1]
        }
        function n(e) {
            return r(e.substr(0, e.indexOf(" "))) ? "a " + e : "an " + e
        }
        function a(e) {
            return r(e.substr(0, e.indexOf(" "))) ? "viru " + e : "virun " + e
        }
        function r(e) {
            if (e = parseInt(e, 10),
            isNaN(e))
                return !1;
            if (e < 0)
                return !0;
            if (e < 10)
                return 4 <= e && e <= 7;
            if (e < 100) {
                var t = e % 10
                  , n = e / 10;
                return r(0 === t ? n : t)
            }
            if (e < 1e4) {
                for (; e >= 10; )
                    e /= 10;
                return r(e)
            }
            return e /= 1e3,
            r(e)
        }
        return e.defineLocale("lb", {
            months: "Januar_Februar_M??erz_Abr??ll_Mee_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
            monthsShort: "Jan._Febr._Mrz._Abr._Mee_Jun._Jul._Aug._Sept._Okt._Nov._Dez.".split("_"),
            monthsParseExact: !0,
            weekdays: "Sonndeg_M??indeg_D??nschdeg_M??ttwoch_Donneschdeg_Freideg_Samschdeg".split("_"),
            weekdaysShort: "So._M??._D??._M??._Do._Fr._Sa.".split("_"),
            weekdaysMin: "So_M??_D??_M??_Do_Fr_Sa".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm [Auer]",
                LTS: "H:mm:ss [Auer]",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm [Auer]",
                LLLL: "dddd, D. MMMM YYYY H:mm [Auer]"
            },
            calendar: {
                sameDay: "[Haut um] LT",
                sameElse: "L",
                nextDay: "[Muer um] LT",
                nextWeek: "dddd [um] LT",
                lastDay: "[G??schter um] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 2:
                    case 4:
                        return "[Leschten] dddd [um] LT";
                    default:
                        return "[Leschte] dddd [um] LT"
                    }
                }
            },
            relativeTime: {
                future: n,
                past: a,
                s: "e puer Sekonnen",
                m: t,
                mm: "%d Minutten",
                h: t,
                hh: "%d Stonnen",
                d: t,
                dd: "%d Deeg",
                M: t,
                MM: "%d M??int",
                y: t,
                yy: "%d Joer"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("lo", {
            months: "??????????????????_???????????????_????????????_????????????_?????????????????????_??????????????????_?????????????????????_???????????????_???????????????_????????????_???????????????_???????????????".split("_"),
            monthsShort: "??????????????????_???????????????_????????????_????????????_?????????????????????_??????????????????_?????????????????????_???????????????_???????????????_????????????_???????????????_???????????????".split("_"),
            weekdays: "???????????????_?????????_??????????????????_?????????_???????????????_?????????_????????????".split("_"),
            weekdaysShort: "?????????_?????????_??????????????????_?????????_???????????????_?????????_????????????".split("_"),
            weekdaysMin: "???_???_??????_???_??????_??????_???".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "?????????dddd D MMMM YYYY HH:mm"
            },
            meridiemParse: /????????????????????????|??????????????????/,
            isPM: function(e) {
                return "??????????????????" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "????????????????????????" : "??????????????????"
            },
            calendar: {
                sameDay: "[??????????????????????????????] LT",
                nextDay: "[?????????????????????????????????] LT",
                nextWeek: "[?????????]dddd[?????????????????????] LT",
                lastDay: "[???????????????????????????????????????] LT",
                lastWeek: "[?????????]dddd[?????????????????????????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "????????? %s",
                past: "%s??????????????????",
                s: "????????????????????????????????????????????????",
                m: "1 ????????????",
                mm: "%d ????????????",
                h: "1 ?????????????????????",
                hh: "%d ?????????????????????",
                d: "1 ?????????",
                dd: "%d ?????????",
                M: "1 ???????????????",
                MM: "%d ???????????????",
                y: "1 ??????",
                yy: "%d ??????"
            },
            dayOfMonthOrdinalParse: /(?????????)\d{1,2}/,
            ordinal: function(e) {
                return "?????????" + e
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            return t ? "kelios sekund??s" : a ? "keli?? sekund??i??" : "kelias sekundes"
        }
        function n(e, t, n, a) {
            return t ? r(n)[0] : a ? r(n)[1] : r(n)[2]
        }
        function a(e) {
            return e % 10 == 0 || e > 10 && e < 20
        }
        function r(e) {
            return s[e].split("_")
        }
        function i(e, t, i, s) {
            var o = e + " ";
            return 1 === e ? o + n(e, t, i[0], s) : t ? o + (a(e) ? r(i)[1] : r(i)[0]) : s ? o + r(i)[1] : o + (a(e) ? r(i)[1] : r(i)[2])
        }
        var s = {
            m: "minut??_minut??s_minut??",
            mm: "minut??s_minu??i??_minutes",
            h: "valanda_valandos_valand??",
            hh: "valandos_valand??_valandas",
            d: "diena_dienos_dien??",
            dd: "dienos_dien??_dienas",
            M: "m??nuo_m??nesio_m??nes??",
            MM: "m??nesiai_m??nesi??_m??nesius",
            y: "metai_met??_metus",
            yy: "metai_met??_metus"
        };
        return e.defineLocale("lt", {
            months: {
                format: "sausio_vasario_kovo_baland??io_gegu????s_bir??elio_liepos_rugpj????io_rugs??jo_spalio_lapkri??io_gruod??io".split("_"),
                standalone: "sausis_vasaris_kovas_balandis_gegu????_bir??elis_liepa_rugpj??tis_rugs??jis_spalis_lapkritis_gruodis".split("_"),
                isFormat: /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?|MMMM?(\[[^\[\]]*\]|\s)+D[oD]?/
            },
            monthsShort: "sau_vas_kov_bal_geg_bir_lie_rgp_rgs_spa_lap_grd".split("_"),
            weekdays: {
                format: "sekmadien??_pirmadien??_antradien??_tre??iadien??_ketvirtadien??_penktadien??_??e??tadien??".split("_"),
                standalone: "sekmadienis_pirmadienis_antradienis_tre??iadienis_ketvirtadienis_penktadienis_??e??tadienis".split("_"),
                isFormat: /dddd HH:mm/
            },
            weekdaysShort: "Sek_Pir_Ant_Tre_Ket_Pen_??e??".split("_"),
            weekdaysMin: "S_P_A_T_K_Pn_??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY-MM-DD",
                LL: "YYYY [m.] MMMM D [d.]",
                LLL: "YYYY [m.] MMMM D [d.], HH:mm [val.]",
                LLLL: "YYYY [m.] MMMM D [d.], dddd, HH:mm [val.]",
                l: "YYYY-MM-DD",
                ll: "YYYY [m.] MMMM D [d.]",
                lll: "YYYY [m.] MMMM D [d.], HH:mm [val.]",
                llll: "YYYY [m.] MMMM D [d.], ddd, HH:mm [val.]"
            },
            calendar: {
                sameDay: "[??iandien] LT",
                nextDay: "[Rytoj] LT",
                nextWeek: "dddd LT",
                lastDay: "[Vakar] LT",
                lastWeek: "[Pra??jus??] dddd LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "po %s",
                past: "prie?? %s",
                s: t,
                m: n,
                mm: i,
                h: n,
                hh: i,
                d: n,
                dd: i,
                M: n,
                MM: i,
                y: n,
                yy: i
            },
            dayOfMonthOrdinalParse: /\d{1,2}-oji/,
            ordinal: function(e) {
                return e + "-oji"
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n) {
            return n ? t % 10 == 1 && t % 100 != 11 ? e[2] : e[3] : t % 10 == 1 && t % 100 != 11 ? e[0] : e[1]
        }
        function n(e, n, a) {
            return e + " " + t(i[a], e, n)
        }
        function a(e, n, a) {
            return t(i[a], e, n)
        }
        function r(e, t) {
            return t ? "da??as sekundes" : "da????m sekund??m"
        }
        var i = {
            m: "min??tes_min??t??m_min??te_min??tes".split("_"),
            mm: "min??tes_min??t??m_min??te_min??tes".split("_"),
            h: "stundas_stund??m_stunda_stundas".split("_"),
            hh: "stundas_stund??m_stunda_stundas".split("_"),
            d: "dienas_dien??m_diena_dienas".split("_"),
            dd: "dienas_dien??m_diena_dienas".split("_"),
            M: "m??ne??a_m??ne??iem_m??nesis_m??ne??i".split("_"),
            MM: "m??ne??a_m??ne??iem_m??nesis_m??ne??i".split("_"),
            y: "gada_gadiem_gads_gadi".split("_"),
            yy: "gada_gadiem_gads_gadi".split("_")
        };
        return e.defineLocale("lv", {
            months: "janv??ris_febru??ris_marts_apr??lis_maijs_j??nijs_j??lijs_augusts_septembris_oktobris_novembris_decembris".split("_"),
            monthsShort: "jan_feb_mar_apr_mai_j??n_j??l_aug_sep_okt_nov_dec".split("_"),
            weekdays: "sv??tdiena_pirmdiena_otrdiena_tre??diena_ceturtdiena_piektdiena_sestdiena".split("_"),
            weekdaysShort: "Sv_P_O_T_C_Pk_S".split("_"),
            weekdaysMin: "Sv_P_O_T_C_Pk_S".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY.",
                LL: "YYYY. [gada] D. MMMM",
                LLL: "YYYY. [gada] D. MMMM, HH:mm",
                LLLL: "YYYY. [gada] D. MMMM, dddd, HH:mm"
            },
            calendar: {
                sameDay: "[??odien pulksten] LT",
                nextDay: "[R??t pulksten] LT",
                nextWeek: "dddd [pulksten] LT",
                lastDay: "[Vakar pulksten] LT",
                lastWeek: "[Pag??ju????] dddd [pulksten] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "p??c %s",
                past: "pirms %s",
                s: r,
                m: a,
                mm: n,
                h: a,
                hh: n,
                d: a,
                dd: n,
                M: a,
                MM: n,
                y: a,
                yy: n
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            words: {
                m: ["jedan minut", "jednog minuta"],
                mm: ["minut", "minuta", "minuta"],
                h: ["jedan sat", "jednog sata"],
                hh: ["sat", "sata", "sati"],
                dd: ["dan", "dana", "dana"],
                MM: ["mjesec", "mjeseca", "mjeseci"],
                yy: ["godina", "godine", "godina"]
            },
            correctGrammaticalCase: function(e, t) {
                return 1 === e ? t[0] : e >= 2 && e <= 4 ? t[1] : t[2]
            },
            translate: function(e, n, a) {
                var r = t.words[a];
                return 1 === a.length ? n ? r[0] : r[1] : e + " " + t.correctGrammaticalCase(e, r)
            }
        };
        return e.defineLocale("me", {
            months: "januar_februar_mart_april_maj_jun_jul_avgust_septembar_oktobar_novembar_decembar".split("_"),
            monthsShort: "jan._feb._mar._apr._maj_jun_jul_avg._sep._okt._nov._dec.".split("_"),
            monthsParseExact: !0,
            weekdays: "nedjelja_ponedjeljak_utorak_srijeda_??etvrtak_petak_subota".split("_"),
            weekdaysShort: "ned._pon._uto._sri._??et._pet._sub.".split("_"),
            weekdaysMin: "ne_po_ut_sr_??e_pe_su".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd, D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[danas u] LT",
                nextDay: "[sjutra u] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[u] [nedjelju] [u] LT";
                    case 3:
                        return "[u] [srijedu] [u] LT";
                    case 6:
                        return "[u] [subotu] [u] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[u] dddd [u] LT"
                    }
                },
                lastDay: "[ju??e u] LT",
                lastWeek: function() {
                    return ["[pro??le] [nedjelje] [u] LT", "[pro??log] [ponedjeljka] [u] LT", "[pro??log] [utorka] [u] LT", "[pro??le] [srijede] [u] LT", "[pro??log] [??etvrtka] [u] LT", "[pro??log] [petka] [u] LT", "[pro??le] [subote] [u] LT"][this.day()]
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "za %s",
                past: "prije %s",
                s: "nekoliko sekundi",
                m: t.translate,
                mm: t.translate,
                h: t.translate,
                hh: t.translate,
                d: "dan",
                dd: t.translate,
                M: "mjesec",
                MM: t.translate,
                y: "godinu",
                yy: t.translate
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("mi", {
            months: "Kohi-t??te_Hui-tanguru_Pout??-te-rangi_Paenga-wh??wh??_Haratua_Pipiri_H??ngoingoi_Here-turi-k??k??_Mahuru_Whiringa-??-nuku_Whiringa-??-rangi_Hakihea".split("_"),
            monthsShort: "Kohi_Hui_Pou_Pae_Hara_Pipi_H??ngoi_Here_Mahu_Whi-nu_Whi-ra_Haki".split("_"),
            monthsRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,3}/i,
            monthsStrictRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,3}/i,
            monthsShortRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,3}/i,
            monthsShortStrictRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,2}/i,
            weekdays: "R??tapu_Mane_T??rei_Wenerei_T??ite_Paraire_H??tarei".split("_"),
            weekdaysShort: "Ta_Ma_T??_We_T??i_Pa_H??".split("_"),
            weekdaysMin: "Ta_Ma_T??_We_T??i_Pa_H??".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY [i] HH:mm",
                LLLL: "dddd, D MMMM YYYY [i] HH:mm"
            },
            calendar: {
                sameDay: "[i teie mahana, i] LT",
                nextDay: "[apopo i] LT",
                nextWeek: "dddd [i] LT",
                lastDay: "[inanahi i] LT",
                lastWeek: "dddd [whakamutunga i] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "i roto i %s",
                past: "%s i mua",
                s: "te h??kona ruarua",
                m: "he meneti",
                mm: "%d meneti",
                h: "te haora",
                hh: "%d haora",
                d: "he ra",
                dd: "%d ra",
                M: "he marama",
                MM: "%d marama",
                y: "he tau",
                yy: "%d tau"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("mk", {
            months: "??????????????_????????????????_????????_??????????_??????_????????_????????_????????????_??????????????????_????????????????_??????????????_????????????????".split("_"),
            monthsShort: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "????????????_????????????????????_??????????????_??????????_????????????????_??????????_????????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "??e_??o_????_????_????_????_??a".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "D.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY H:mm",
                LLLL: "dddd, D MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[?????????? ????] LT",
                nextDay: "[???????? ????] LT",
                nextWeek: "[????] dddd [????] LT",
                lastDay: "[?????????? ????] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                    case 3:
                    case 6:
                        return "[????????????????????] dddd [????] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[????????????????????] dddd [????] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "?????????? %s",
                past: "???????? %s",
                s: "?????????????? ??????????????",
                m: "????????????",
                mm: "%d ????????????",
                h: "??????",
                hh: "%d ????????",
                d: "??????",
                dd: "%d ????????",
                M: "??????????",
                MM: "%d ????????????",
                y: "????????????",
                yy: "%d ????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(????|????|????|????|????|????)/,
            ordinal: function(e) {
                var t = e % 10
                  , n = e % 100;
                return 0 === e ? e + "-????" : 0 === n ? e + "-????" : n > 10 && n < 20 ? e + "-????" : 1 === t ? e + "-????" : 2 === t ? e + "-????" : 7 === t || 8 === t ? e + "-????" : e + "-????"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ml", {
            months: "??????????????????_???????????????????????????_?????????????????????_??????????????????_????????????_?????????_????????????_????????????????????????_??????????????????????????????_?????????????????????_???????????????_??????????????????".split("_"),
            monthsShort: "?????????._??????????????????._?????????._???????????????._????????????_?????????_????????????._??????._?????????????????????._???????????????._?????????._????????????.".split("_"),
            monthsParseExact: !0,
            weekdays: "????????????????????????_??????????????????????????????_???????????????????????????_????????????????????????_???????????????????????????_?????????????????????????????????_????????????????????????".split("_"),
            weekdaysShort: "????????????_??????????????????_???????????????_????????????_??????????????????_??????????????????_?????????".split("_"),
            weekdaysMin: "??????_??????_??????_??????_????????????_??????_???".split("_"),
            longDateFormat: {
                LT: "A h:mm -??????",
                LTS: "A h:mm:ss -??????",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm -??????",
                LLLL: "dddd, D MMMM YYYY, A h:mm -??????"
            },
            calendar: {
                sameDay: "[???????????????] LT",
                nextDay: "[????????????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[??????????????????] LT",
                lastWeek: "[??????????????????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ?????????????????????",
                past: "%s ???????????????",
                s: "????????? ???????????????????????????",
                m: "????????? ????????????????????????",
                mm: "%d ????????????????????????",
                h: "????????? ????????????????????????",
                hh: "%d ????????????????????????",
                d: "????????? ???????????????",
                dd: "%d ???????????????",
                M: "????????? ????????????",
                MM: "%d ????????????",
                y: "????????? ????????????",
                yy: "%d ????????????"
            },
            meridiemParse: /??????????????????|??????????????????|???????????? ?????????????????????|??????????????????????????????|??????????????????/i,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????????????????" === t && e >= 4 || "???????????? ?????????????????????" === t || "??????????????????????????????" === t ? e + 12 : e
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "??????????????????" : e < 12 ? "??????????????????" : e < 17 ? "???????????? ?????????????????????" : e < 20 ? "??????????????????????????????" : "??????????????????"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = "";
            if (t)
                switch (n) {
                case "s":
                    r = "???????????? ???????????????";
                    break;
                case "m":
                    r = "?????? ???????????????";
                    break;
                case "mm":
                    r = "%d ??????????????????";
                    break;
                case "h":
                    r = "?????? ?????????";
                    break;
                case "hh":
                    r = "%d ?????????";
                    break;
                case "d":
                    r = "?????? ????????????";
                    break;
                case "dd":
                    r = "%d ????????????";
                    break;
                case "M":
                    r = "?????? ???????????????";
                    break;
                case "MM":
                    r = "%d ???????????????";
                    break;
                case "y":
                    r = "?????? ????????????";
                    break;
                case "yy":
                    r = "%d ???????????????"
                }
            else
                switch (n) {
                case "s":
                    r = "???????????? ?????????????????????";
                    break;
                case "m":
                    r = "????????? ??????????????????";
                    break;
                case "mm":
                    r = "%d ?????????????????????";
                    break;
                case "h":
                    r = "????????? ????????????";
                    break;
                case "hh":
                    r = "%d ???????????????";
                    break;
                case "d":
                    r = "????????? ???????????????";
                    break;
                case "dd":
                    r = "%d ??????????????????";
                    break;
                case "M":
                    r = "????????? ?????????????????????";
                    break;
                case "MM":
                    r = "%d ????????????????????????";
                    break;
                case "y":
                    r = "????????? ???????????????";
                    break;
                case "yy":
                    r = "%d ??????????????????"
                }
            return r.replace(/%d/i, e)
        }
        var n = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , a = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("mr", {
            months: "????????????????????????_??????????????????????????????_???????????????_??????????????????_??????_?????????_????????????_???????????????_????????????????????????_?????????????????????_???????????????????????????_?????????????????????".split("_"),
            monthsShort: "????????????._??????????????????._???????????????._???????????????._??????._?????????._????????????._??????._??????????????????._???????????????._?????????????????????._???????????????.".split("_"),
            monthsParseExact: !0,
            weekdays: "??????????????????_??????????????????_?????????????????????_??????????????????_?????????????????????_????????????????????????_??????????????????".split("_"),
            weekdaysShort: "?????????_?????????_????????????_?????????_????????????_???????????????_?????????".split("_"),
            weekdaysMin: "???_??????_??????_??????_??????_??????_???".split("_"),
            longDateFormat: {
                LT: "A h:mm ???????????????",
                LTS: "A h:mm:ss ???????????????",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm ???????????????",
                LLLL: "dddd, D MMMM YYYY, A h:mm ???????????????"
            },
            calendar: {
                sameDay: "[??????] LT",
                nextDay: "[???????????????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[?????????] LT",
                lastWeek: "[???????????????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s???????????????",
                past: "%s??????????????????",
                s: t,
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return a[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return n[e]
                })
            },
            meridiemParse: /??????????????????|???????????????|??????????????????|????????????????????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????????????????" === t ? e < 4 ? e : e + 12 : "???????????????" === t ? e : "??????????????????" === t ? e >= 10 ? e : e + 12 : "????????????????????????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "??????????????????" : e < 10 ? "???????????????" : e < 17 ? "??????????????????" : e < 20 ? "????????????????????????" : "??????????????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ms", {
            months: "Januari_Februari_Mac_April_Mei_Jun_Julai_Ogos_September_Oktober_November_Disember".split("_"),
            monthsShort: "Jan_Feb_Mac_Apr_Mei_Jun_Jul_Ogs_Sep_Okt_Nov_Dis".split("_"),
            weekdays: "Ahad_Isnin_Selasa_Rabu_Khamis_Jumaat_Sabtu".split("_"),
            weekdaysShort: "Ahd_Isn_Sel_Rab_Kha_Jum_Sab".split("_"),
            weekdaysMin: "Ah_Is_Sl_Rb_Km_Jm_Sb".split("_"),
            longDateFormat: {
                LT: "HH.mm",
                LTS: "HH.mm.ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY [pukul] HH.mm",
                LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
            },
            meridiemParse: /pagi|tengahari|petang|malam/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "pagi" === t ? e : "tengahari" === t ? e >= 11 ? e : e + 12 : "petang" === t || "malam" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 11 ? "pagi" : e < 15 ? "tengahari" : e < 19 ? "petang" : "malam"
            },
            calendar: {
                sameDay: "[Hari ini pukul] LT",
                nextDay: "[Esok pukul] LT",
                nextWeek: "dddd [pukul] LT",
                lastDay: "[Kelmarin pukul] LT",
                lastWeek: "dddd [lepas pukul] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "dalam %s",
                past: "%s yang lepas",
                s: "beberapa saat",
                m: "seminit",
                mm: "%d minit",
                h: "sejam",
                hh: "%d jam",
                d: "sehari",
                dd: "%d hari",
                M: "sebulan",
                MM: "%d bulan",
                y: "setahun",
                yy: "%d tahun"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ms-my", {
            months: "Januari_Februari_Mac_April_Mei_Jun_Julai_Ogos_September_Oktober_November_Disember".split("_"),
            monthsShort: "Jan_Feb_Mac_Apr_Mei_Jun_Jul_Ogs_Sep_Okt_Nov_Dis".split("_"),
            weekdays: "Ahad_Isnin_Selasa_Rabu_Khamis_Jumaat_Sabtu".split("_"),
            weekdaysShort: "Ahd_Isn_Sel_Rab_Kha_Jum_Sab".split("_"),
            weekdaysMin: "Ah_Is_Sl_Rb_Km_Jm_Sb".split("_"),
            longDateFormat: {
                LT: "HH.mm",
                LTS: "HH.mm.ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY [pukul] HH.mm",
                LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
            },
            meridiemParse: /pagi|tengahari|petang|malam/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "pagi" === t ? e : "tengahari" === t ? e >= 11 ? e : e + 12 : "petang" === t || "malam" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 11 ? "pagi" : e < 15 ? "tengahari" : e < 19 ? "petang" : "malam"
            },
            calendar: {
                sameDay: "[Hari ini pukul] LT",
                nextDay: "[Esok pukul] LT",
                nextWeek: "dddd [pukul] LT",
                lastDay: "[Kelmarin pukul] LT",
                lastWeek: "dddd [lepas pukul] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "dalam %s",
                past: "%s yang lepas",
                s: "beberapa saat",
                m: "seminit",
                mm: "%d minit",
                h: "sejam",
                hh: "%d jam",
                d: "sehari",
                dd: "%d hari",
                M: "sebulan",
                MM: "%d bulan",
                y: "setahun",
                yy: "%d tahun"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("my", {
            months: "????????????????????????_??????????????????????????????_?????????_????????????_??????_????????????_?????????????????????_??????????????????_????????????????????????_??????????????????????????????_????????????????????????_?????????????????????".split("_"),
            monthsShort: "?????????_??????_?????????_?????????_??????_????????????_???????????????_??????_?????????_???????????????_?????????_??????".split("_"),
            weekdays: "???????????????????????????_?????????????????????_??????????????????_????????????????????????_????????????????????????_??????????????????_?????????".split("_"),
            weekdaysShort: "?????????_??????_??????_?????????_?????????_?????????_??????".split("_"),
            weekdaysMin: "?????????_??????_??????_?????????_?????????_?????????_??????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[?????????.] LT [?????????]",
                nextDay: "[????????????????????????] LT [?????????]",
                nextWeek: "dddd LT [?????????]",
                lastDay: "[?????????.???] LT [?????????]",
                lastWeek: "[??????????????????????????????] dddd LT [?????????]",
                sameElse: "L"
            },
            relativeTime: {
                future: "?????????????????? %s ?????????",
                past: "?????????????????????????????? %s ???",
                s: "??????????????????.????????????????????????",
                m: "????????????????????????",
                mm: "%d ???????????????",
                h: "?????????????????????",
                hh: "%d ????????????",
                d: "??????????????????",
                dd: "%d ?????????",
                M: "????????????",
                MM: "%d ???",
                y: "?????????????????????",
                yy: "%d ????????????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("nb", {
            months: "januar_februar_mars_april_mai_juni_juli_august_september_oktober_november_desember".split("_"),
            monthsShort: "jan._feb._mars_april_mai_juni_juli_aug._sep._okt._nov._des.".split("_"),
            monthsParseExact: !0,
            weekdays: "s??ndag_mandag_tirsdag_onsdag_torsdag_fredag_l??rdag".split("_"),
            weekdaysShort: "s??._ma._ti._on._to._fr._l??.".split("_"),
            weekdaysMin: "s??_ma_ti_on_to_fr_l??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY [kl.] HH:mm",
                LLLL: "dddd D. MMMM YYYY [kl.] HH:mm"
            },
            calendar: {
                sameDay: "[i dag kl.] LT",
                nextDay: "[i morgen kl.] LT",
                nextWeek: "dddd [kl.] LT",
                lastDay: "[i g??r kl.] LT",
                lastWeek: "[forrige] dddd [kl.] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "om %s",
                past: "%s siden",
                s: "noen sekunder",
                m: "ett minutt",
                mm: "%d minutter",
                h: "en time",
                hh: "%d timer",
                d: "en dag",
                dd: "%d dager",
                M: "en m??ned",
                MM: "%d m??neder",
                y: "ett ??r",
                yy: "%d ??r"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("ne", {
            months: "???????????????_???????????????????????????_???????????????_??????????????????_??????_?????????_???????????????_???????????????_??????????????????????????????_?????????????????????_????????????????????????_????????????????????????".split("_"),
            monthsShort: "??????._??????????????????._???????????????_???????????????._??????_?????????_???????????????._??????._???????????????._???????????????._????????????._????????????.".split("_"),
            monthsParseExact: !0,
            weekdays: "??????????????????_??????????????????_????????????????????????_??????????????????_?????????????????????_????????????????????????_??????????????????".split("_"),
            weekdaysShort: "?????????._?????????._???????????????._?????????._????????????._???????????????._?????????.".split("_"),
            weekdaysMin: "???._??????._??????._??????._??????._??????._???.".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "A?????? h:mm ?????????",
                LTS: "A?????? h:mm:ss ?????????",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A?????? h:mm ?????????",
                LLLL: "dddd, D MMMM YYYY, A?????? h:mm ?????????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            meridiemParse: /????????????|???????????????|??????????????????|????????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "????????????" === t ? e < 4 ? e : e + 12 : "???????????????" === t ? e : "??????????????????" === t ? e >= 10 ? e : e + 12 : "????????????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 3 ? "????????????" : e < 12 ? "???????????????" : e < 16 ? "??????????????????" : e < 20 ? "????????????" : "????????????"
            },
            calendar: {
                sameDay: "[??????] LT",
                nextDay: "[????????????] LT",
                nextWeek: "[???????????????] dddd[,] LT",
                lastDay: "[????????????] LT",
                lastWeek: "[????????????] dddd[,] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s??????",
                past: "%s ???????????????",
                s: "???????????? ????????????",
                m: "?????? ???????????????",
                mm: "%d ???????????????",
                h: "?????? ???????????????",
                hh: "%d ???????????????",
                d: "?????? ?????????",
                dd: "%d ?????????",
                M: "?????? ???????????????",
                MM: "%d ???????????????",
                y: "?????? ????????????",
                yy: "%d ????????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = "jan._feb._mrt._apr._mei_jun._jul._aug._sep._okt._nov._dec.".split("_")
          , n = "jan_feb_mrt_apr_mei_jun_jul_aug_sep_okt_nov_dec".split("_")
          , a = [/^jan/i, /^feb/i, /^maart|mrt.?$/i, /^apr/i, /^mei$/i, /^jun[i.]?$/i, /^jul[i.]?$/i, /^aug/i, /^sep/i, /^okt/i, /^nov/i, /^dec/i]
          , r = /^(januari|februari|maart|april|mei|april|ju[nl]i|augustus|september|oktober|november|december|jan\.?|feb\.?|mrt\.?|apr\.?|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i;
        return e.defineLocale("nl", {
            months: "januari_februari_maart_april_mei_juni_juli_augustus_september_oktober_november_december".split("_"),
            monthsShort: function(e, a) {
                return e ? /-MMM-/.test(a) ? n[e.month()] : t[e.month()] : t
            },
            monthsRegex: r,
            monthsShortRegex: r,
            monthsStrictRegex: /^(januari|februari|maart|mei|ju[nl]i|april|augustus|september|oktober|november|december)/i,
            monthsShortStrictRegex: /^(jan\.?|feb\.?|mrt\.?|apr\.?|mei|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i,
            monthsParse: a,
            longMonthsParse: a,
            shortMonthsParse: a,
            weekdays: "zondag_maandag_dinsdag_woensdag_donderdag_vrijdag_zaterdag".split("_"),
            weekdaysShort: "zo._ma._di._wo._do._vr._za.".split("_"),
            weekdaysMin: "Zo_Ma_Di_Wo_Do_Vr_Za".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD-MM-YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[vandaag om] LT",
                nextDay: "[morgen om] LT",
                nextWeek: "dddd [om] LT",
                lastDay: "[gisteren om] LT",
                lastWeek: "[afgelopen] dddd [om] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "over %s",
                past: "%s geleden",
                s: "een paar seconden",
                m: "????n minuut",
                mm: "%d minuten",
                h: "????n uur",
                hh: "%d uur",
                d: "????n dag",
                dd: "%d dagen",
                M: "????n maand",
                MM: "%d maanden",
                y: "????n jaar",
                yy: "%d jaar"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
            ordinal: function(e) {
                return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = "jan._feb._mrt._apr._mei_jun._jul._aug._sep._okt._nov._dec.".split("_")
          , n = "jan_feb_mrt_apr_mei_jun_jul_aug_sep_okt_nov_dec".split("_")
          , a = [/^jan/i, /^feb/i, /^maart|mrt.?$/i, /^apr/i, /^mei$/i, /^jun[i.]?$/i, /^jul[i.]?$/i, /^aug/i, /^sep/i, /^okt/i, /^nov/i, /^dec/i]
          , r = /^(januari|februari|maart|april|mei|april|ju[nl]i|augustus|september|oktober|november|december|jan\.?|feb\.?|mrt\.?|apr\.?|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i;
        return e.defineLocale("nl-be", {
            months: "januari_februari_maart_april_mei_juni_juli_augustus_september_oktober_november_december".split("_"),
            monthsShort: function(e, a) {
                return e ? /-MMM-/.test(a) ? n[e.month()] : t[e.month()] : t
            },
            monthsRegex: r,
            monthsShortRegex: r,
            monthsStrictRegex: /^(januari|februari|maart|mei|ju[nl]i|april|augustus|september|oktober|november|december)/i,
            monthsShortStrictRegex: /^(jan\.?|feb\.?|mrt\.?|apr\.?|mei|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i,
            monthsParse: a,
            longMonthsParse: a,
            shortMonthsParse: a,
            weekdays: "zondag_maandag_dinsdag_woensdag_donderdag_vrijdag_zaterdag".split("_"),
            weekdaysShort: "zo._ma._di._wo._do._vr._za.".split("_"),
            weekdaysMin: "Zo_Ma_Di_Wo_Do_Vr_Za".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[vandaag om] LT",
                nextDay: "[morgen om] LT",
                nextWeek: "dddd [om] LT",
                lastDay: "[gisteren om] LT",
                lastWeek: "[afgelopen] dddd [om] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "over %s",
                past: "%s geleden",
                s: "een paar seconden",
                m: "????n minuut",
                mm: "%d minuten",
                h: "????n uur",
                hh: "%d uur",
                d: "????n dag",
                dd: "%d dagen",
                M: "????n maand",
                MM: "%d maanden",
                y: "????n jaar",
                yy: "%d jaar"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
            ordinal: function(e) {
                return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("nn", {
            months: "januar_februar_mars_april_mai_juni_juli_august_september_oktober_november_desember".split("_"),
            monthsShort: "jan_feb_mar_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_"),
            weekdays: "sundag_m??ndag_tysdag_onsdag_torsdag_fredag_laurdag".split("_"),
            weekdaysShort: "sun_m??n_tys_ons_tor_fre_lau".split("_"),
            weekdaysMin: "su_m??_ty_on_to_fr_l??".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY [kl.] H:mm",
                LLLL: "dddd D. MMMM YYYY [kl.] HH:mm"
            },
            calendar: {
                sameDay: "[I dag klokka] LT",
                nextDay: "[I morgon klokka] LT",
                nextWeek: "dddd [klokka] LT",
                lastDay: "[I g??r klokka] LT",
                lastWeek: "[F??reg??ande] dddd [klokka] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "om %s",
                past: "%s sidan",
                s: "nokre sekund",
                m: "eit minutt",
                mm: "%d minutt",
                h: "ein time",
                hh: "%d timar",
                d: "ein dag",
                dd: "%d dagar",
                M: "ein m??nad",
                MM: "%d m??nader",
                y: "eit ??r",
                yy: "%d ??r"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("pa-in", {
            months: "???????????????_??????????????????_????????????_??????????????????_??????_?????????_???????????????_????????????_???????????????_??????????????????_???????????????_???????????????".split("_"),
            monthsShort: "???????????????_??????????????????_????????????_??????????????????_??????_?????????_???????????????_????????????_???????????????_??????????????????_???????????????_???????????????".split("_"),
            weekdays: "???????????????_??????????????????_?????????????????????_??????????????????_??????????????????_???????????????????????????_???????????????????????????".split("_"),
            weekdaysShort: "??????_?????????_????????????_?????????_?????????_???????????????_????????????".split("_"),
            weekdaysMin: "??????_?????????_????????????_?????????_?????????_???????????????_????????????".split("_"),
            longDateFormat: {
                LT: "A h:mm ?????????",
                LTS: "A h:mm:ss ?????????",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm ?????????",
                LLLL: "dddd, D MMMM YYYY, A h:mm ?????????"
            },
            calendar: {
                sameDay: "[??????] LT",
                nextDay: "[??????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[??????] LT",
                lastWeek: "[???????????????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ????????????",
                past: "%s ???????????????",
                s: "????????? ???????????????",
                m: "?????? ????????????",
                mm: "%d ????????????",
                h: "????????? ????????????",
                hh: "%d ????????????",
                d: "????????? ?????????",
                dd: "%d ?????????",
                M: "????????? ???????????????",
                MM: "%d ???????????????",
                y: "????????? ?????????",
                yy: "%d ?????????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            meridiemParse: /?????????|????????????|??????????????????|????????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "?????????" === t ? e < 4 ? e : e + 12 : "????????????" === t ? e : "??????????????????" === t ? e >= 10 ? e : e + 12 : "????????????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "?????????" : e < 10 ? "????????????" : e < 17 ? "??????????????????" : e < 20 ? "????????????" : "?????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e) {
            return e % 10 < 5 && e % 10 > 1 && ~~(e / 10) % 10 != 1
        }
        function n(e, n, a) {
            var r = e + " ";
            switch (a) {
            case "m":
                return n ? "minuta" : "minut??";
            case "mm":
                return r + (t(e) ? "minuty" : "minut");
            case "h":
                return n ? "godzina" : "godzin??";
            case "hh":
                return r + (t(e) ? "godziny" : "godzin");
            case "MM":
                return r + (t(e) ? "miesi??ce" : "miesi??cy");
            case "yy":
                return r + (t(e) ? "lata" : "lat")
            }
        }
        var a = "stycze??_luty_marzec_kwiecie??_maj_czerwiec_lipiec_sierpie??_wrzesie??_pa??dziernik_listopad_grudzie??".split("_")
          , r = "stycznia_lutego_marca_kwietnia_maja_czerwca_lipca_sierpnia_wrze??nia_pa??dziernika_listopada_grudnia".split("_");
        return e.defineLocale("pl", {
            months: function(e, t) {
                return e ? "" === t ? "(" + r[e.month()] + "|" + a[e.month()] + ")" : /D MMMM/.test(t) ? r[e.month()] : a[e.month()] : a
            },
            monthsShort: "sty_lut_mar_kwi_maj_cze_lip_sie_wrz_pa??_lis_gru".split("_"),
            weekdays: "niedziela_poniedzia??ek_wtorek_??roda_czwartek_pi??tek_sobota".split("_"),
            weekdaysShort: "ndz_pon_wt_??r_czw_pt_sob".split("_"),
            weekdaysMin: "Nd_Pn_Wt_??r_Cz_Pt_So".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Dzi?? o] LT",
                nextDay: "[Jutro o] LT",
                nextWeek: "[W] dddd [o] LT",
                lastDay: "[Wczoraj o] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[W zesz???? niedziel?? o] LT";
                    case 3:
                        return "[W zesz???? ??rod?? o] LT";
                    case 6:
                        return "[W zesz???? sobot?? o] LT";
                    default:
                        return "[W zesz??y] dddd [o] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "za %s",
                past: "%s temu",
                s: "kilka sekund",
                m: n,
                mm: n,
                h: n,
                hh: n,
                d: "1 dzie??",
                dd: "%d dni",
                M: "miesi??c",
                MM: n,
                y: "rok",
                yy: n
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("pt", {
            months: "Janeiro_Fevereiro_Mar??o_Abril_Maio_Junho_Julho_Agosto_Setembro_Outubro_Novembro_Dezembro".split("_"),
            monthsShort: "Jan_Fev_Mar_Abr_Mai_Jun_Jul_Ago_Set_Out_Nov_Dez".split("_"),
            weekdays: "Domingo_Segunda-Feira_Ter??a-Feira_Quarta-Feira_Quinta-Feira_Sexta-Feira_S??bado".split("_"),
            weekdaysShort: "Dom_Seg_Ter_Qua_Qui_Sex_S??b".split("_"),
            weekdaysMin: "Do_2??_3??_4??_5??_6??_S??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D [de] MMMM [de] YYYY",
                LLL: "D [de] MMMM [de] YYYY HH:mm",
                LLLL: "dddd, D [de] MMMM [de] YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Hoje ??s] LT",
                nextDay: "[Amanh?? ??s] LT",
                nextWeek: "dddd [??s] LT",
                lastDay: "[Ontem ??s] LT",
                lastWeek: function() {
                    return 0 === this.day() || 6 === this.day() ? "[??ltimo] dddd [??s] LT" : "[??ltima] dddd [??s] LT"
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "em %s",
                past: "h?? %s",
                s: "segundos",
                m: "um minuto",
                mm: "%d minutos",
                h: "uma hora",
                hh: "%d horas",
                d: "um dia",
                dd: "%d dias",
                M: "um m??s",
                MM: "%d meses",
                y: "um ano",
                yy: "%d anos"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("pt-br", {
            months: "Janeiro_Fevereiro_Mar??o_Abril_Maio_Junho_Julho_Agosto_Setembro_Outubro_Novembro_Dezembro".split("_"),
            monthsShort: "Jan_Fev_Mar_Abr_Mai_Jun_Jul_Ago_Set_Out_Nov_Dez".split("_"),
            weekdays: "Domingo_Segunda-feira_Ter??a-feira_Quarta-feira_Quinta-feira_Sexta-feira_S??bado".split("_"),
            weekdaysShort: "Dom_Seg_Ter_Qua_Qui_Sex_S??b".split("_"),
            weekdaysMin: "Do_2??_3??_4??_5??_6??_S??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D [de] MMMM [de] YYYY",
                LLL: "D [de] MMMM [de] YYYY [??s] HH:mm",
                LLLL: "dddd, D [de] MMMM [de] YYYY [??s] HH:mm"
            },
            calendar: {
                sameDay: "[Hoje ??s] LT",
                nextDay: "[Amanh?? ??s] LT",
                nextWeek: "dddd [??s] LT",
                lastDay: "[Ontem ??s] LT",
                lastWeek: function() {
                    return 0 === this.day() || 6 === this.day() ? "[??ltimo] dddd [??s] LT" : "[??ltima] dddd [??s] LT"
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "em %s",
                past: "%s atr??s",
                s: "poucos segundos",
                m: "um minuto",
                mm: "%d minutos",
                h: "uma hora",
                hh: "%d horas",
                d: "um dia",
                dd: "%d dias",
                M: "um m??s",
                MM: "%d meses",
                y: "um ano",
                yy: "%d anos"
            },
            dayOfMonthOrdinalParse: /\d{1,2}??/,
            ordinal: "%d??"
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n) {
            var a = {
                mm: "minute",
                hh: "ore",
                dd: "zile",
                MM: "luni",
                yy: "ani"
            }
              , r = " ";
            return (e % 100 >= 20 || e >= 100 && e % 100 == 0) && (r = " de "),
            e + r + a[n]
        }
        return e.defineLocale("ro", {
            months: "ianuarie_februarie_martie_aprilie_mai_iunie_iulie_august_septembrie_octombrie_noiembrie_decembrie".split("_"),
            monthsShort: "ian._febr._mart._apr._mai_iun._iul._aug._sept._oct._nov._dec.".split("_"),
            monthsParseExact: !0,
            weekdays: "duminic??_luni_mar??i_miercuri_joi_vineri_s??mb??t??".split("_"),
            weekdaysShort: "Dum_Lun_Mar_Mie_Joi_Vin_S??m".split("_"),
            weekdaysMin: "Du_Lu_Ma_Mi_Jo_Vi_S??".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY H:mm",
                LLLL: "dddd, D MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[azi la] LT",
                nextDay: "[m??ine la] LT",
                nextWeek: "dddd [la] LT",
                lastDay: "[ieri la] LT",
                lastWeek: "[fosta] dddd [la] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "peste %s",
                past: "%s ??n urm??",
                s: "c??teva secunde",
                m: "un minut",
                mm: t,
                h: "o or??",
                hh: t,
                d: "o zi",
                dd: t,
                M: "o lun??",
                MM: t,
                y: "un an",
                yy: t
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t) {
            var n = e.split("_");
            return t % 10 == 1 && t % 100 != 11 ? n[0] : t % 10 >= 2 && t % 10 <= 4 && (t % 100 < 10 || t % 100 >= 20) ? n[1] : n[2]
        }
        function n(e, n, a) {
            var r = {
                mm: n ? "????????????_????????????_??????????" : "????????????_????????????_??????????",
                hh: "??????_????????_??????????",
                dd: "????????_??????_????????",
                MM: "??????????_????????????_??????????????",
                yy: "??????_????????_??????"
            };
            return "m" === a ? n ? "????????????" : "????????????" : e + " " + t(r[a], +e)
        }
        var a = [/^??????/i, /^??????/i, /^??????/i, /^??????/i, /^????[????]/i, /^??????/i, /^??????/i, /^??????/i, /^??????/i, /^??????/i, /^??????/i, /^??????/i];
        return e.defineLocale("ru", {
            months: {
                format: "????????????_??????????????_??????????_????????????_??????_????????_????????_??????????????_????????????????_??????????????_????????????_??????????????".split("_"),
                standalone: "????????????_??????????????_????????_????????????_??????_????????_????????_????????????_????????????????_??????????????_????????????_??????????????".split("_")
            },
            monthsShort: {
                format: "??????._????????._??????._??????._??????_????????_????????_??????._????????._??????._????????._??????.".split("_"),
                standalone: "??????._????????._????????_??????._??????_????????_????????_??????._????????._??????._????????._??????.".split("_")
            },
            weekdays: {
                standalone: "??????????????????????_??????????????????????_??????????????_??????????_??????????????_??????????????_??????????????".split("_"),
                format: "??????????????????????_??????????????????????_??????????????_??????????_??????????????_??????????????_??????????????".split("_"),
                isFormat: /\[ ?[????] ?(?:??????????????|??????????????????|??????)? ?\] ?dddd/
            },
            weekdaysShort: "????_????_????_????_????_????_????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            monthsParse: a,
            longMonthsParse: a,
            shortMonthsParse: a,
            monthsRegex: /^(??????????[????]|??????\.?|????????????[????]|?????????\.?|???????????|??????\.?|??????????[????]|??????\.?|????[????]|??????[????]|??????\.?|??????[????]|??????\.?|???????????????|??????\.?|??????????????[????]|?????????\.?|????????????[????]|??????\.?|??????????[????]|?????????\.?|????????????[????]|??????\.?)/i,
            monthsShortRegex: /^(??????????[????]|??????\.?|????????????[????]|?????????\.?|???????????|??????\.?|??????????[????]|??????\.?|????[????]|??????[????]|??????\.?|??????[????]|??????\.?|???????????????|??????\.?|??????????????[????]|?????????\.?|????????????[????]|??????\.?|??????????[????]|?????????\.?|????????????[????]|??????\.?)/i,
            monthsStrictRegex: /^(??????????[????]|????????????[????]|???????????|??????????[????]|????[????]|??????[????]|??????[????]|???????????????|??????????????[????]|????????????[????]|??????????[????]|????????????[????])/i,
            monthsShortStrictRegex: /^(??????\.|?????????\.|??????[??.]|??????\.|????[????]|??????[????.]|??????[????.]|??????\.|?????????\.|??????\.|?????????\.|??????\.)/i,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY ??.",
                LLL: "D MMMM YYYY ??., HH:mm",
                LLLL: "dddd, D MMMM YYYY ??., HH:mm"
            },
            calendar: {
                sameDay: "[?????????????? ??] LT",
                nextDay: "[???????????? ??] LT",
                lastDay: "[?????????? ??] LT",
                nextWeek: function(e) {
                    if (e.week() === this.week())
                        return 2 === this.day() ? "[????] dddd [??] LT" : "[??] dddd [??] LT";
                    switch (this.day()) {
                    case 0:
                        return "[?? ??????????????????] dddd [??] LT";
                    case 1:
                    case 2:
                    case 4:
                        return "[?? ??????????????????] dddd [??] LT";
                    case 3:
                    case 5:
                    case 6:
                        return "[?? ??????????????????] dddd [??] LT"
                    }
                },
                lastWeek: function(e) {
                    if (e.week() === this.week())
                        return 2 === this.day() ? "[????] dddd [??] LT" : "[??] dddd [??] LT";
                    switch (this.day()) {
                    case 0:
                        return "[?? ??????????????] dddd [??] LT";
                    case 1:
                    case 2:
                    case 4:
                        return "[?? ??????????????] dddd [??] LT";
                    case 3:
                    case 5:
                    case 6:
                        return "[?? ??????????????] dddd [??] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "?????????? %s",
                past: "%s ??????????",
                s: "?????????????????? ????????????",
                m: n,
                mm: n,
                h: "??????",
                hh: n,
                d: "????????",
                dd: n,
                M: "??????????",
                MM: n,
                y: "??????",
                yy: n
            },
            meridiemParse: /????????|????????|??????|????????????/i,
            isPM: function(e) {
                return /^(??????|????????????)$/.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "????????" : e < 12 ? "????????" : e < 17 ? "??????" : "????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(??|????|??)/,
            ordinal: function(e, t) {
                switch (t) {
                case "M":
                case "d":
                case "DDD":
                    return e + "-??";
                case "D":
                    return e + "-????";
                case "w":
                case "W":
                    return e + "-??";
                default:
                    return e
                }
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = ["??????????", "??????????????", "????????", "??????????", "??????", "??????", "????????????", "????????", "??????????????", "????????????", "??????????", "??????????"]
          , n = ["??????", "????????", "??????????", "????????", "????????", "??????", "????????"];
        return e.defineLocale("sd", {
            months: t,
            monthsShort: t,
            weekdays: n,
            weekdaysShort: n,
            weekdaysMin: n,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd?? D MMMM YYYY HH:mm"
            },
            meridiemParse: /??????|??????/,
            isPM: function(e) {
                return "??????" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??????" : "??????"
            },
            calendar: {
                sameDay: "[????] LT",
                nextDay: "[??????????] LT",
                nextWeek: "dddd [???????? ???????? ????] LT",
                lastDay: "[??????????] LT",
                lastWeek: "[?????????? ????????] dddd [????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ??????",
                past: "%s ????",
                s: "?????? ??????????",
                m: "???? ??????",
                mm: "%d ??????",
                h: "???? ????????",
                hh: "%d ????????",
                d: "???? ??????????",
                dd: "%d ??????????",
                M: "???? ??????????",
                MM: "%d ??????????",
                y: "???? ??????",
                yy: "%d ??????"
            },
            preparse: function(e) {
                return e.replace(/??/g, ",")
            },
            postformat: function(e) {
                return e.replace(/,/g, "??")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("se", {
            months: "o????ajagem??nnu_guovvam??nnu_njuk??am??nnu_cuo??om??nnu_miessem??nnu_geassem??nnu_suoidnem??nnu_borgem??nnu_??ak??am??nnu_golggotm??nnu_sk??bmam??nnu_juovlam??nnu".split("_"),
            monthsShort: "o????j_guov_njuk_cuo_mies_geas_suoi_borg_??ak??_golg_sk??b_juov".split("_"),
            weekdays: "sotnabeaivi_vuoss??rga_ma????eb??rga_gaskavahkku_duorastat_bearjadat_l??vvardat".split("_"),
            weekdaysShort: "sotn_vuos_ma??_gask_duor_bear_l??v".split("_"),
            weekdaysMin: "s_v_m_g_d_b_L".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "MMMM D. [b.] YYYY",
                LLL: "MMMM D. [b.] YYYY [ti.] HH:mm",
                LLLL: "dddd, MMMM D. [b.] YYYY [ti.] HH:mm"
            },
            calendar: {
                sameDay: "[otne ti] LT",
                nextDay: "[ihttin ti] LT",
                nextWeek: "dddd [ti] LT",
                lastDay: "[ikte ti] LT",
                lastWeek: "[ovddit] dddd [ti] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s gea??es",
                past: "ma??it %s",
                s: "moadde sekunddat",
                m: "okta minuhta",
                mm: "%d minuhtat",
                h: "okta diimmu",
                hh: "%d diimmut",
                d: "okta beaivi",
                dd: "%d beaivvit",
                M: "okta m??nnu",
                MM: "%d m??nut",
                y: "okta jahki",
                yy: "%d jagit"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("si", {
            months: "??????????????????_????????????????????????_??????????????????_????????????????????????_????????????_????????????_????????????_?????????????????????_?????????????????????????????????_????????????????????????_???????????????????????????_???????????????????????????".split("_"),
            monthsShort: "??????_?????????_????????????_?????????_????????????_????????????_????????????_?????????_????????????_?????????_????????????_????????????".split("_"),
            weekdays: "???????????????_???????????????_???????????????????????????_???????????????_??????????????????????????????????????????_????????????????????????_???????????????????????????".split("_"),
            weekdaysShort: "?????????_?????????_??????_?????????_???????????????_????????????_?????????".split("_"),
            weekdaysMin: "???_???_???_???_????????????_??????_??????".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "a h:mm",
                LTS: "a h:mm:ss",
                L: "YYYY/MM/DD",
                LL: "YYYY MMMM D",
                LLL: "YYYY MMMM D, a h:mm",
                LLLL: "YYYY MMMM D [????????????] dddd, a h:mm:ss"
            },
            calendar: {
                sameDay: "[??????] LT[???]",
                nextDay: "[?????????] LT[???]",
                nextWeek: "dddd LT[???]",
                lastDay: "[?????????] LT[???]",
                lastWeek: "[??????????????????] dddd LT[???]",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s????????????",
                past: "%s?????? ?????????",
                s: "??????????????? ??????????????????",
                m: "???????????????????????????",
                mm: "???????????????????????? %d",
                h: "?????????",
                hh: "????????? %d",
                d: "????????????",
                dd: "????????? %d",
                M: "????????????",
                MM: "????????? %d",
                y: "?????????",
                yy: "????????? %d"
            },
            dayOfMonthOrdinalParse: /\d{1,2} ????????????/,
            ordinal: function(e) {
                return e + " ????????????"
            },
            meridiemParse: /????????? ?????????|????????? ?????????|??????.???|???.???./,
            isPM: function(e) {
                return "???.???." === e || "????????? ?????????" === e
            },
            meridiem: function(e, t, n) {
                return e > 11 ? n ? "???.???." : "????????? ?????????" : n ? "??????.???." : "????????? ?????????"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e) {
            return e > 1 && e < 5
        }
        function n(e, n, a, r) {
            var i = e + " ";
            switch (a) {
            case "s":
                return n || r ? "p??r sek??nd" : "p??r sekundami";
            case "m":
                return n ? "min??ta" : r ? "min??tu" : "min??tou";
            case "mm":
                return n || r ? i + (t(e) ? "min??ty" : "min??t") : i + "min??tami";
            case "h":
                return n ? "hodina" : r ? "hodinu" : "hodinou";
            case "hh":
                return n || r ? i + (t(e) ? "hodiny" : "hod??n") : i + "hodinami";
            case "d":
                return n || r ? "de??" : "d??om";
            case "dd":
                return n || r ? i + (t(e) ? "dni" : "dn??") : i + "d??ami";
            case "M":
                return n || r ? "mesiac" : "mesiacom";
            case "MM":
                return n || r ? i + (t(e) ? "mesiace" : "mesiacov") : i + "mesiacmi";
            case "y":
                return n || r ? "rok" : "rokom";
            case "yy":
                return n || r ? i + (t(e) ? "roky" : "rokov") : i + "rokmi"
            }
        }
        var a = "janu??r_febru??r_marec_apr??l_m??j_j??n_j??l_august_september_okt??ber_november_december".split("_")
          , r = "jan_feb_mar_apr_m??j_j??n_j??l_aug_sep_okt_nov_dec".split("_");
        return e.defineLocale("sk", {
            months: a,
            monthsShort: r,
            weekdays: "nede??a_pondelok_utorok_streda_??tvrtok_piatok_sobota".split("_"),
            weekdaysShort: "ne_po_ut_st_??t_pi_so".split("_"),
            weekdaysMin: "ne_po_ut_st_??t_pi_so".split("_"),
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[dnes o] LT",
                nextDay: "[zajtra o] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[v nede??u o] LT";
                    case 1:
                    case 2:
                        return "[v] dddd [o] LT";
                    case 3:
                        return "[v stredu o] LT";
                    case 4:
                        return "[vo ??tvrtok o] LT";
                    case 5:
                        return "[v piatok o] LT";
                    case 6:
                        return "[v sobotu o] LT"
                    }
                },
                lastDay: "[v??era o] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[minul?? nede??u o] LT";
                    case 1:
                    case 2:
                        return "[minul??] dddd [o] LT";
                    case 3:
                        return "[minul?? stredu o] LT";
                    case 4:
                    case 5:
                        return "[minul??] dddd [o] LT";
                    case 6:
                        return "[minul?? sobotu o] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "za %s",
                past: "pred %s",
                s: n,
                m: n,
                mm: n,
                h: n,
                hh: n,
                d: n,
                dd: n,
                M: n,
                MM: n,
                y: n,
                yy: n
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = e + " ";
            switch (n) {
            case "s":
                return t || a ? "nekaj sekund" : "nekaj sekundami";
            case "m":
                return t ? "ena minuta" : "eno minuto";
            case "mm":
                return r += 1 === e ? t ? "minuta" : "minuto" : 2 === e ? t || a ? "minuti" : "minutama" : e < 5 ? t || a ? "minute" : "minutami" : t || a ? "minut" : "minutami";
            case "h":
                return t ? "ena ura" : "eno uro";
            case "hh":
                return r += 1 === e ? t ? "ura" : "uro" : 2 === e ? t || a ? "uri" : "urama" : e < 5 ? t || a ? "ure" : "urami" : t || a ? "ur" : "urami";
            case "d":
                return t || a ? "en dan" : "enim dnem";
            case "dd":
                return r += 1 === e ? t || a ? "dan" : "dnem" : 2 === e ? t || a ? "dni" : "dnevoma" : t || a ? "dni" : "dnevi";
            case "M":
                return t || a ? "en mesec" : "enim mesecem";
            case "MM":
                return r += 1 === e ? t || a ? "mesec" : "mesecem" : 2 === e ? t || a ? "meseca" : "mesecema" : e < 5 ? t || a ? "mesece" : "meseci" : t || a ? "mesecev" : "meseci";
            case "y":
                return t || a ? "eno leto" : "enim letom";
            case "yy":
                return r += 1 === e ? t || a ? "leto" : "letom" : 2 === e ? t || a ? "leti" : "letoma" : e < 5 ? t || a ? "leta" : "leti" : t || a ? "let" : "leti"
            }
        }
        return e.defineLocale("sl", {
            months: "januar_februar_marec_april_maj_junij_julij_avgust_september_oktober_november_december".split("_"),
            monthsShort: "jan._feb._mar._apr._maj._jun._jul._avg._sep._okt._nov._dec.".split("_"),
            monthsParseExact: !0,
            weekdays: "nedelja_ponedeljek_torek_sreda_??etrtek_petek_sobota".split("_"),
            weekdaysShort: "ned._pon._tor._sre._??et._pet._sob.".split("_"),
            weekdaysMin: "ne_po_to_sr_??e_pe_so".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd, D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[danes ob] LT",
                nextDay: "[jutri ob] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[v] [nedeljo] [ob] LT";
                    case 3:
                        return "[v] [sredo] [ob] LT";
                    case 6:
                        return "[v] [soboto] [ob] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[v] dddd [ob] LT"
                    }
                },
                lastDay: "[v??eraj ob] LT",
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[prej??njo] [nedeljo] [ob] LT";
                    case 3:
                        return "[prej??njo] [sredo] [ob] LT";
                    case 6:
                        return "[prej??njo] [soboto] [ob] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[prej??nji] dddd [ob] LT"
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "??ez %s",
                past: "pred %s",
                s: t,
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("sq", {
            months: "Janar_Shkurt_Mars_Prill_Maj_Qershor_Korrik_Gusht_Shtator_Tetor_N??ntor_Dhjetor".split("_"),
            monthsShort: "Jan_Shk_Mar_Pri_Maj_Qer_Kor_Gus_Sht_Tet_N??n_Dhj".split("_"),
            weekdays: "E Diel_E H??n??_E Mart??_E M??rkur??_E Enjte_E Premte_E Shtun??".split("_"),
            weekdaysShort: "Die_H??n_Mar_M??r_Enj_Pre_Sht".split("_"),
            weekdaysMin: "D_H_Ma_M??_E_P_Sh".split("_"),
            weekdaysParseExact: !0,
            meridiemParse: /PD|MD/,
            isPM: function(e) {
                return "M" === e.charAt(0)
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "PD" : "MD"
            },
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Sot n??] LT",
                nextDay: "[Nes??r n??] LT",
                nextWeek: "dddd [n??] LT",
                lastDay: "[Dje n??] LT",
                lastWeek: "dddd [e kaluar n??] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "n?? %s",
                past: "%s m?? par??",
                s: "disa sekonda",
                m: "nj?? minut??",
                mm: "%d minuta",
                h: "nj?? or??",
                hh: "%d or??",
                d: "nj?? dit??",
                dd: "%d dit??",
                M: "nj?? muaj",
                MM: "%d muaj",
                y: "nj?? vit",
                yy: "%d vite"
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            words: {
                m: ["jedan minut", "jedne minute"],
                mm: ["minut", "minute", "minuta"],
                h: ["jedan sat", "jednog sata"],
                hh: ["sat", "sata", "sati"],
                dd: ["dan", "dana", "dana"],
                MM: ["mesec", "meseca", "meseci"],
                yy: ["godina", "godine", "godina"]
            },
            correctGrammaticalCase: function(e, t) {
                return 1 === e ? t[0] : e >= 2 && e <= 4 ? t[1] : t[2]
            },
            translate: function(e, n, a) {
                var r = t.words[a];
                return 1 === a.length ? n ? r[0] : r[1] : e + " " + t.correctGrammaticalCase(e, r)
            }
        };
        return e.defineLocale("sr", {
            months: "januar_februar_mart_april_maj_jun_jul_avgust_septembar_oktobar_novembar_decembar".split("_"),
            monthsShort: "jan._feb._mar._apr._maj_jun_jul_avg._sep._okt._nov._dec.".split("_"),
            monthsParseExact: !0,
            weekdays: "nedelja_ponedeljak_utorak_sreda_??etvrtak_petak_subota".split("_"),
            weekdaysShort: "ned._pon._uto._sre._??et._pet._sub.".split("_"),
            weekdaysMin: "ne_po_ut_sr_??e_pe_su".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd, D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[danas u] LT",
                nextDay: "[sutra u] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[u] [nedelju] [u] LT";
                    case 3:
                        return "[u] [sredu] [u] LT";
                    case 6:
                        return "[u] [subotu] [u] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[u] dddd [u] LT"
                    }
                },
                lastDay: "[ju??e u] LT",
                lastWeek: function() {
                    return ["[pro??le] [nedelje] [u] LT", "[pro??log] [ponedeljka] [u] LT", "[pro??log] [utorka] [u] LT", "[pro??le] [srede] [u] LT", "[pro??log] [??etvrtka] [u] LT", "[pro??log] [petka] [u] LT", "[pro??le] [subote] [u] LT"][this.day()]
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "za %s",
                past: "pre %s",
                s: "nekoliko sekundi",
                m: t.translate,
                mm: t.translate,
                h: t.translate,
                hh: t.translate,
                d: "dan",
                dd: t.translate,
                M: "mesec",
                MM: t.translate,
                y: "godinu",
                yy: t.translate
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            words: {
                m: ["?????????? ??????????", "?????????? ????????????"],
                mm: ["??????????", "????????????", "????????????"],
                h: ["?????????? ??????", "???????????? ????????"],
                hh: ["??????", "????????", "????????"],
                dd: ["??????", "????????", "????????"],
                MM: ["??????????", "????????????", "????????????"],
                yy: ["????????????", "????????????", "????????????"]
            },
            correctGrammaticalCase: function(e, t) {
                return 1 === e ? t[0] : e >= 2 && e <= 4 ? t[1] : t[2]
            },
            translate: function(e, n, a) {
                var r = t.words[a];
                return 1 === a.length ? n ? r[0] : r[1] : e + " " + t.correctGrammaticalCase(e, r)
            }
        };
        return e.defineLocale("sr-cyrl", {
            months: "????????????_??????????????_????????_??????????_??????_??????_??????_????????????_??????????????????_??????????????_????????????????_????????????????".split("_"),
            monthsShort: "??????._??????._??????._??????._??????_??????_??????_??????._??????._??????._??????._??????.".split("_"),
            monthsParseExact: !0,
            weekdays: "????????????_??????????????????_????????????_??????????_????????????????_??????????_????????????".split("_"),
            weekdaysShort: "??????._??????._??????._??????._??????._??????._??????.".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM YYYY",
                LLL: "D. MMMM YYYY H:mm",
                LLLL: "dddd, D. MMMM YYYY H:mm"
            },
            calendar: {
                sameDay: "[?????????? ??] LT",
                nextDay: "[?????????? ??] LT",
                nextWeek: function() {
                    switch (this.day()) {
                    case 0:
                        return "[??] [????????????] [??] LT";
                    case 3:
                        return "[??] [??????????] [??] LT";
                    case 6:
                        return "[??] [????????????] [??] LT";
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                        return "[??] dddd [??] LT"
                    }
                },
                lastDay: "[???????? ??] LT",
                lastWeek: function() {
                    return ["[????????????] [????????????] [??] LT", "[??????????????] [??????????????????] [??] LT", "[??????????????] [????????????] [??] LT", "[????????????] [??????????] [??] LT", "[??????????????] [????????????????] [??] LT", "[??????????????] [??????????] [??] LT", "[????????????] [????????????] [??] LT"][this.day()]
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "?????? %s",
                s: "???????????????? ??????????????",
                m: t.translate,
                mm: t.translate,
                h: t.translate,
                hh: t.translate,
                d: "??????",
                dd: t.translate,
                M: "??????????",
                MM: t.translate,
                y: "????????????",
                yy: t.translate
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("ss", {
            months: "Bhimbidvwane_Indlovana_Indlov'lenkhulu_Mabasa_Inkhwekhweti_Inhlaba_Kholwane_Ingci_Inyoni_Imphala_Lweti_Ingongoni".split("_"),
            monthsShort: "Bhi_Ina_Inu_Mab_Ink_Inh_Kho_Igc_Iny_Imp_Lwe_Igo".split("_"),
            weekdays: "Lisontfo_Umsombuluko_Lesibili_Lesitsatfu_Lesine_Lesihlanu_Umgcibelo".split("_"),
            weekdaysShort: "Lis_Umb_Lsb_Les_Lsi_Lsh_Umg".split("_"),
            weekdaysMin: "Li_Us_Lb_Lt_Ls_Lh_Ug".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY h:mm A",
                LLLL: "dddd, D MMMM YYYY h:mm A"
            },
            calendar: {
                sameDay: "[Namuhla nga] LT",
                nextDay: "[Kusasa nga] LT",
                nextWeek: "dddd [nga] LT",
                lastDay: "[Itolo nga] LT",
                lastWeek: "dddd [leliphelile] [nga] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "nga %s",
                past: "wenteka nga %s",
                s: "emizuzwana lomcane",
                m: "umzuzu",
                mm: "%d emizuzu",
                h: "lihora",
                hh: "%d emahora",
                d: "lilanga",
                dd: "%d emalanga",
                M: "inyanga",
                MM: "%d tinyanga",
                y: "umnyaka",
                yy: "%d iminyaka"
            },
            meridiemParse: /ekuseni|emini|entsambama|ebusuku/,
            meridiem: function(e, t, n) {
                return e < 11 ? "ekuseni" : e < 15 ? "emini" : e < 19 ? "entsambama" : "ebusuku"
            },
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "ekuseni" === t ? e : "emini" === t ? e >= 11 ? e : e + 12 : "entsambama" === t || "ebusuku" === t ? 0 === e ? 0 : e + 12 : void 0
            },
            dayOfMonthOrdinalParse: /\d{1,2}/,
            ordinal: "%d",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("sv", {
            months: "januari_februari_mars_april_maj_juni_juli_augusti_september_oktober_november_december".split("_"),
            monthsShort: "jan_feb_mar_apr_maj_jun_jul_aug_sep_okt_nov_dec".split("_"),
            weekdays: "s??ndag_m??ndag_tisdag_onsdag_torsdag_fredag_l??rdag".split("_"),
            weekdaysShort: "s??n_m??n_tis_ons_tor_fre_l??r".split("_"),
            weekdaysMin: "s??_m??_ti_on_to_fr_l??".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY-MM-DD",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY [kl.] HH:mm",
                LLLL: "dddd D MMMM YYYY [kl.] HH:mm",
                lll: "D MMM YYYY HH:mm",
                llll: "ddd D MMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Idag] LT",
                nextDay: "[Imorgon] LT",
                lastDay: "[Ig??r] LT",
                nextWeek: "[P??] dddd LT",
                lastWeek: "[I] dddd[s] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "om %s",
                past: "f??r %s sedan",
                s: "n??gra sekunder",
                m: "en minut",
                mm: "%d minuter",
                h: "en timme",
                hh: "%d timmar",
                d: "en dag",
                dd: "%d dagar",
                M: "en m??nad",
                MM: "%d m??nader",
                y: "ett ??r",
                yy: "%d ??r"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(e|a)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "e" : 1 === t ? "a" : 2 === t ? "a" : "e")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("sw", {
            months: "Januari_Februari_Machi_Aprili_Mei_Juni_Julai_Agosti_Septemba_Oktoba_Novemba_Desemba".split("_"),
            monthsShort: "Jan_Feb_Mac_Apr_Mei_Jun_Jul_Ago_Sep_Okt_Nov_Des".split("_"),
            weekdays: "Jumapili_Jumatatu_Jumanne_Jumatano_Alhamisi_Ijumaa_Jumamosi".split("_"),
            weekdaysShort: "Jpl_Jtat_Jnne_Jtan_Alh_Ijm_Jmos".split("_"),
            weekdaysMin: "J2_J3_J4_J5_Al_Ij_J1".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[leo saa] LT",
                nextDay: "[kesho saa] LT",
                nextWeek: "[wiki ijayo] dddd [saat] LT",
                lastDay: "[jana] LT",
                lastWeek: "[wiki iliyopita] dddd [saat] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s baadaye",
                past: "tokea %s",
                s: "hivi punde",
                m: "dakika moja",
                mm: "dakika %d",
                h: "saa limoja",
                hh: "masaa %d",
                d: "siku moja",
                dd: "masiku %d",
                M: "mwezi mmoja",
                MM: "miezi %d",
                y: "mwaka mmoja",
                yy: "miaka %d"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "???",
            2: "???",
            3: "???",
            4: "???",
            5: "???",
            6: "???",
            7: "???",
            8: "???",
            9: "???",
            0: "???"
        }
          , n = {
            "???": "1",
            "???": "2",
            "???": "3",
            "???": "4",
            "???": "5",
            "???": "6",
            "???": "7",
            "???": "8",
            "???": "9",
            "???": "0"
        };
        return e.defineLocale("ta", {
            months: "???????????????_????????????????????????_??????????????????_??????????????????_??????_????????????_????????????_??????????????????_?????????????????????????????????_???????????????????????????_?????????????????????_????????????????????????".split("_"),
            monthsShort: "???????????????_????????????????????????_??????????????????_??????????????????_??????_????????????_????????????_??????????????????_?????????????????????????????????_???????????????????????????_?????????????????????_????????????????????????".split("_"),
            weekdays: "?????????????????????????????????????????????_????????????????????????????????????_???????????????????????????????????????_??????????????????????????????_????????????????????????????????????_???????????????????????????????????????_??????????????????????????????".split("_"),
            weekdaysShort: "??????????????????_?????????????????????_????????????????????????_???????????????_?????????????????????_??????????????????_?????????".split("_"),
            weekdaysMin: "??????_??????_??????_??????_??????_??????_???".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, HH:mm",
                LLLL: "dddd, D MMMM YYYY, HH:mm"
            },
            calendar: {
                sameDay: "[???????????????] LT",
                nextDay: "[????????????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[??????????????????] LT",
                lastWeek: "[??????????????? ???????????????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ?????????",
                past: "%s ????????????",
                s: "????????? ????????? ???????????????????????????",
                m: "????????? ?????????????????????",
                mm: "%d ??????????????????????????????",
                h: "????????? ????????? ???????????????",
                hh: "%d ????????? ???????????????",
                d: "????????? ????????????",
                dd: "%d ?????????????????????",
                M: "????????? ???????????????",
                MM: "%d ????????????????????????",
                y: "????????? ??????????????????",
                yy: "%d ????????????????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}?????????/,
            ordinal: function(e) {
                return e + "?????????"
            },
            preparse: function(e) {
                return e.replace(/[??????????????????????????????]/g, function(e) {
                    return n[e]
                })
            },
            postformat: function(e) {
                return e.replace(/\d/g, function(e) {
                    return t[e]
                })
            },
            meridiemParse: /???????????????|???????????????|????????????|?????????????????????|?????????????????????|????????????/,
            meridiem: function(e, t, n) {
                return e < 2 ? " ???????????????" : e < 6 ? " ???????????????" : e < 10 ? " ????????????" : e < 14 ? " ?????????????????????" : e < 18 ? " ?????????????????????" : e < 22 ? " ????????????" : " ???????????????"
            },
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "???????????????" === t ? e < 2 ? e : e + 12 : "???????????????" === t || "????????????" === t ? e : "?????????????????????" === t && e >= 10 ? e : e + 12
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("te", {
            months: "???????????????_????????????????????????_??????????????????_?????????????????????_??????_????????????_???????????????_??????????????????_??????????????????????????????_????????????????????????_??????????????????_????????????????????????".split("_"),
            monthsShort: "??????._???????????????._??????????????????_???????????????._??????_????????????_???????????????_??????._????????????._???????????????._??????._????????????.".split("_"),
            monthsParseExact: !0,
            weekdays: "?????????????????????_?????????????????????_????????????????????????_?????????????????????_????????????????????????_???????????????????????????_?????????????????????".split("_"),
            weekdaysShort: "?????????_?????????_????????????_?????????_????????????_???????????????_?????????".split("_"),
            weekdaysMin: "???_??????_??????_??????_??????_??????_???".split("_"),
            longDateFormat: {
                LT: "A h:mm",
                LTS: "A h:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY, A h:mm",
                LLLL: "dddd, D MMMM YYYY, A h:mm"
            },
            calendar: {
                sameDay: "[????????????] LT",
                nextDay: "[????????????] LT",
                nextWeek: "dddd, LT",
                lastDay: "[???????????????] LT",
                lastWeek: "[??????] dddd, LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ??????",
                past: "%s ??????????????????",
                s: "?????????????????? ?????????????????????",
                m: "?????? ??????????????????",
                mm: "%d ????????????????????????",
                h: "?????? ?????????",
                hh: "%d ???????????????",
                d: "?????? ????????????",
                dd: "%d ??????????????????",
                M: "?????? ?????????",
                MM: "%d ???????????????",
                y: "?????? ????????????????????????",
                yy: "%d ??????????????????????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}???/,
            ordinal: "%d???",
            meridiemParse: /??????????????????|????????????|???????????????????????????|????????????????????????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????????????????" === t ? e < 4 ? e : e + 12 : "????????????" === t ? e : "???????????????????????????" === t ? e >= 10 ? e : e + 12 : "????????????????????????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "??????????????????" : e < 10 ? "????????????" : e < 17 ? "???????????????????????????" : e < 20 ? "????????????????????????" : "??????????????????"
            },
            week: {
                dow: 0,
                doy: 6
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("tet", {
            months: "Janeiru_Fevereiru_Marsu_Abril_Maiu_Juniu_Juliu_Augustu_Setembru_Outubru_Novembru_Dezembru".split("_"),
            monthsShort: "Jan_Fev_Mar_Abr_Mai_Jun_Jul_Aug_Set_Out_Nov_Dez".split("_"),
            weekdays: "Domingu_Segunda_Tersa_Kuarta_Kinta_Sexta_Sabadu".split("_"),
            weekdaysShort: "Dom_Seg_Ters_Kua_Kint_Sext_Sab".split("_"),
            weekdaysMin: "Do_Seg_Te_Ku_Ki_Sex_Sa".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[Ohin iha] LT",
                nextDay: "[Aban iha] LT",
                nextWeek: "dddd [iha] LT",
                lastDay: "[Horiseik iha] LT",
                lastWeek: "dddd [semana kotuk] [iha] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "iha %s",
                past: "%s liuba",
                s: "minutu balun",
                m: "minutu ida",
                mm: "minutus %d",
                h: "horas ida",
                hh: "horas %d",
                d: "loron ida",
                dd: "loron %d",
                M: "fulan ida",
                MM: "fulan %d",
                y: "tinan ida",
                yy: "tinan %d"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("th", {
            months: "??????????????????_??????????????????????????????_??????????????????_??????????????????_?????????????????????_????????????????????????_?????????????????????_?????????????????????_?????????????????????_??????????????????_???????????????????????????_?????????????????????".split("_"),
            monthsShort: "???.???._???.???._??????.???._??????.???._???.???._??????.???._???.???._???.???._???.???._???.???._???.???._???.???.".split("_"),
            monthsParseExact: !0,
            weekdays: "?????????????????????_??????????????????_??????????????????_?????????_????????????????????????_???????????????_???????????????".split("_"),
            weekdaysShort: "?????????????????????_??????????????????_??????????????????_?????????_???????????????_???????????????_???????????????".split("_"),
            weekdaysMin: "??????._???._???._???._??????._???._???.".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "H:mm",
                LTS: "H:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY ???????????? H:mm",
                LLLL: "?????????dddd????????? D MMMM YYYY ???????????? H:mm"
            },
            meridiemParse: /??????????????????????????????|??????????????????????????????/,
            isPM: function(e) {
                return "??????????????????????????????" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??????????????????????????????" : "??????????????????????????????"
            },
            calendar: {
                sameDay: "[?????????????????? ????????????] LT",
                nextDay: "[???????????????????????? ????????????] LT",
                nextWeek: "dddd[???????????? ????????????] LT",
                lastDay: "[????????????????????????????????? ????????????] LT",
                lastWeek: "[?????????]dddd[????????????????????? ????????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "????????? %s",
                past: "%s?????????????????????",
                s: "????????????????????????????????????",
                m: "1 ????????????",
                mm: "%d ????????????",
                h: "1 ?????????????????????",
                hh: "%d ?????????????????????",
                d: "1 ?????????",
                dd: "%d ?????????",
                M: "1 ???????????????",
                MM: "%d ???????????????",
                y: "1 ??????",
                yy: "%d ??????"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("tl-ph", {
            months: "Enero_Pebrero_Marso_Abril_Mayo_Hunyo_Hulyo_Agosto_Setyembre_Oktubre_Nobyembre_Disyembre".split("_"),
            monthsShort: "Ene_Peb_Mar_Abr_May_Hun_Hul_Ago_Set_Okt_Nob_Dis".split("_"),
            weekdays: "Linggo_Lunes_Martes_Miyerkules_Huwebes_Biyernes_Sabado".split("_"),
            weekdaysShort: "Lin_Lun_Mar_Miy_Huw_Biy_Sab".split("_"),
            weekdaysMin: "Li_Lu_Ma_Mi_Hu_Bi_Sab".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "MM/D/YYYY",
                LL: "MMMM D, YYYY",
                LLL: "MMMM D, YYYY HH:mm",
                LLLL: "dddd, MMMM DD, YYYY HH:mm"
            },
            calendar: {
                sameDay: "LT [ngayong araw]",
                nextDay: "[Bukas ng] LT",
                nextWeek: "LT [sa susunod na] dddd",
                lastDay: "LT [kahapon]",
                lastWeek: "LT [noong nakaraang] dddd",
                sameElse: "L"
            },
            relativeTime: {
                future: "sa loob ng %s",
                past: "%s ang nakalipas",
                s: "ilang segundo",
                m: "isang minuto",
                mm: "%d minuto",
                h: "isang oras",
                hh: "%d oras",
                d: "isang araw",
                dd: "%d araw",
                M: "isang buwan",
                MM: "%d buwan",
                y: "isang taon",
                yy: "%d taon"
            },
            dayOfMonthOrdinalParse: /\d{1,2}/,
            ordinal: function(e) {
                return e
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e) {
            var t = e;
            return t = -1 !== e.indexOf("jaj") ? t.slice(0, -3) + "leS" : -1 !== e.indexOf("jar") ? t.slice(0, -3) + "waQ" : -1 !== e.indexOf("DIS") ? t.slice(0, -3) + "nem" : t + " pIq"
        }
        function n(e) {
            var t = e;
            return t = -1 !== e.indexOf("jaj") ? t.slice(0, -3) + "Hu???" : -1 !== e.indexOf("jar") ? t.slice(0, -3) + "wen" : -1 !== e.indexOf("DIS") ? t.slice(0, -3) + "ben" : t + " ret"
        }
        function a(e, t, n, a) {
            var i = r(e);
            switch (n) {
            case "mm":
                return i + " tup";
            case "hh":
                return i + " rep";
            case "dd":
                return i + " jaj";
            case "MM":
                return i + " jar";
            case "yy":
                return i + " DIS"
            }
        }
        function r(e) {
            var t = Math.floor(e % 1e3 / 100)
              , n = Math.floor(e % 100 / 10)
              , a = e % 10
              , r = "";
            return t > 0 && (r += i[t] + "vatlh"),
            n > 0 && (r += ("" !== r ? " " : "") + i[n] + "maH"),
            a > 0 && (r += ("" !== r ? " " : "") + i[a]),
            "" === r ? "pagh" : r
        }
        var i = "pagh_wa???_cha???_wej_loS_vagh_jav_Soch_chorgh_Hut".split("_");
        return e.defineLocale("tlh", {
            months: "tera??? jar wa???_tera??? jar cha???_tera??? jar wej_tera??? jar loS_tera??? jar vagh_tera??? jar jav_tera??? jar Soch_tera??? jar chorgh_tera??? jar Hut_tera??? jar wa???maH_tera??? jar wa???maH wa???_tera??? jar wa???maH cha???".split("_"),
            monthsShort: "jar wa???_jar cha???_jar wej_jar loS_jar vagh_jar jav_jar Soch_jar chorgh_jar Hut_jar wa???maH_jar wa???maH wa???_jar wa???maH cha???".split("_"),
            monthsParseExact: !0,
            weekdays: "lojmItjaj_DaSjaj_povjaj_ghItlhjaj_loghjaj_buqjaj_ghInjaj".split("_"),
            weekdaysShort: "lojmItjaj_DaSjaj_povjaj_ghItlhjaj_loghjaj_buqjaj_ghInjaj".split("_"),
            weekdaysMin: "lojmItjaj_DaSjaj_povjaj_ghItlhjaj_loghjaj_buqjaj_ghInjaj".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[DaHjaj] LT",
                nextDay: "[wa???leS] LT",
                nextWeek: "LLL",
                lastDay: "[wa???Hu???] LT",
                lastWeek: "LLL",
                sameElse: "L"
            },
            relativeTime: {
                future: t,
                past: n,
                s: "puS lup",
                m: "wa??? tup",
                mm: a,
                h: "wa??? rep",
                hh: a,
                d: "wa??? jaj",
                dd: a,
                M: "wa??? jar",
                MM: a,
                y: "wa??? DIS",
                yy: a
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = {
            1: "'inci",
            5: "'inci",
            8: "'inci",
            70: "'inci",
            80: "'inci",
            2: "'nci",
            7: "'nci",
            20: "'nci",
            50: "'nci",
            3: "'??nc??",
            4: "'??nc??",
            100: "'??nc??",
            6: "'nc??",
            9: "'uncu",
            10: "'uncu",
            30: "'uncu",
            60: "'??nc??",
            90: "'??nc??"
        };
        return e.defineLocale("tr", {
            months: "Ocak_??ubat_Mart_Nisan_May??s_Haziran_Temmuz_A??ustos_Eyl??l_Ekim_Kas??m_Aral??k".split("_"),
            monthsShort: "Oca_??ub_Mar_Nis_May_Haz_Tem_A??u_Eyl_Eki_Kas_Ara".split("_"),
            weekdays: "Pazar_Pazartesi_Sal??_??ar??amba_Per??embe_Cuma_Cumartesi".split("_"),
            weekdaysShort: "Paz_Pts_Sal_??ar_Per_Cum_Cts".split("_"),
            weekdaysMin: "Pz_Pt_Sa_??a_Pe_Cu_Ct".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[bug??n saat] LT",
                nextDay: "[yar??n saat] LT",
                nextWeek: "[haftaya] dddd [saat] LT",
                lastDay: "[d??n] LT",
                lastWeek: "[ge??en hafta] dddd [saat] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s sonra",
                past: "%s ??nce",
                s: "birka?? saniye",
                m: "bir dakika",
                mm: "%d dakika",
                h: "bir saat",
                hh: "%d saat",
                d: "bir g??n",
                dd: "%d g??n",
                M: "bir ay",
                MM: "%d ay",
                y: "bir y??l",
                yy: "%d y??l"
            },
            dayOfMonthOrdinalParse: /\d{1,2}'(inci|nci|??nc??|nc??|uncu|??nc??)/,
            ordinal: function(e) {
                if (0 === e)
                    return e + "'??nc??";
                var n = e % 10
                  , a = e % 100 - n
                  , r = e >= 100 ? 100 : null;
                return e + (t[n] || t[a] || t[r])
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t, n, a) {
            var r = {
                s: ["viensas secunds", "'iensas secunds"],
                m: ["'n m??ut", "'iens m??ut"],
                mm: [e + " m??uts", e + " m??uts"],
                h: ["'n ??ora", "'iensa ??ora"],
                hh: [e + " ??oras", e + " ??oras"],
                d: ["'n ziua", "'iensa ziua"],
                dd: [e + " ziuas", e + " ziuas"],
                M: ["'n mes", "'iens mes"],
                MM: [e + " mesen", e + " mesen"],
                y: ["'n ar", "'iens ar"],
                yy: [e + " ars", e + " ars"]
            };
            return a ? r[n][0] : t ? r[n][0] : r[n][1]
        }
        return e.defineLocale("tzl", {
            months: "Januar_Fevraglh_Mar??_Avr??u_Mai_G??n_Julia_Guscht_Setemvar_Listop??ts_Noemvar_Zecemvar".split("_"),
            monthsShort: "Jan_Fev_Mar_Avr_Mai_G??n_Jul_Gus_Set_Lis_Noe_Zec".split("_"),
            weekdays: "S??ladi_L??ne??i_Maitzi_M??rcuri_Xh??adi_Vi??ner??i_S??turi".split("_"),
            weekdaysShort: "S??l_L??n_Mai_M??r_Xh??_Vi??_S??t".split("_"),
            weekdaysMin: "S??_L??_Ma_M??_Xh_Vi_S??".split("_"),
            longDateFormat: {
                LT: "HH.mm",
                LTS: "HH.mm.ss",
                L: "DD.MM.YYYY",
                LL: "D. MMMM [dallas] YYYY",
                LLL: "D. MMMM [dallas] YYYY HH.mm",
                LLLL: "dddd, [li] D. MMMM [dallas] YYYY HH.mm"
            },
            meridiemParse: /d\'o|d\'a/i,
            isPM: function(e) {
                return "d'o" === e.toLowerCase()
            },
            meridiem: function(e, t, n) {
                return e > 11 ? n ? "d'o" : "D'O" : n ? "d'a" : "D'A"
            },
            calendar: {
                sameDay: "[oxhi ??] LT",
                nextDay: "[dem?? ??] LT",
                nextWeek: "dddd [??] LT",
                lastDay: "[ieiri ??] LT",
                lastWeek: "[s??r el] dddd [lasteu ??] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "osprei %s",
                past: "ja%s",
                s: t,
                m: t,
                mm: t,
                h: t,
                hh: t,
                d: t,
                dd: t,
                M: t,
                MM: t,
                y: t,
                yy: t
            },
            dayOfMonthOrdinalParse: /\d{1,2}\./,
            ordinal: "%d.",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("tzm", {
            months: "??????????????????_???????????????_????????????_???????????????_???????????????_???????????????_??????????????????_????????????_????????????????????????_???????????????_????????????????????????_?????????????????????".split("_"),
            monthsShort: "??????????????????_???????????????_????????????_???????????????_???????????????_???????????????_??????????????????_????????????_????????????????????????_???????????????_????????????????????????_?????????????????????".split("_"),
            weekdays: "??????????????????_???????????????_??????????????????_???????????????_???????????????_?????????????????????_?????????????????????".split("_"),
            weekdaysShort: "??????????????????_???????????????_??????????????????_???????????????_???????????????_?????????????????????_?????????????????????".split("_"),
            weekdaysMin: "??????????????????_???????????????_??????????????????_???????????????_???????????????_?????????????????????_?????????????????????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[???????????? ???] LT",
                nextDay: "[???????????? ???] LT",
                nextWeek: "dddd [???] LT",
                lastDay: "[??????????????? ???] LT",
                lastWeek: "dddd [???] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "???????????? ??? ????????? %s",
                past: "????????? %s",
                s: "????????????",
                m: "???????????????",
                mm: "%d ???????????????",
                h: "????????????",
                hh: "%d ????????????????????????",
                d: "?????????",
                dd: "%d o????????????",
                M: "??????o??????",
                MM: "%d ??????????????????",
                y: "???????????????",
                yy: "%d ??????????????????"
            },
            week: {
                dow: 6,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("tzm-latn", {
            months: "innayr_br??ayr??_mar??s??_ibrir_mayyw_ywnyw_ywlywz_??w??t_??wtanbir_kt??wbr??_nwwanbir_dwjnbir".split("_"),
            monthsShort: "innayr_br??ayr??_mar??s??_ibrir_mayyw_ywnyw_ywlywz_??w??t_??wtanbir_kt??wbr??_nwwanbir_dwjnbir".split("_"),
            weekdays: "asamas_aynas_asinas_akras_akwas_asimwas_asi???yas".split("_"),
            weekdaysShort: "asamas_aynas_asinas_akras_akwas_asimwas_asi???yas".split("_"),
            weekdaysMin: "asamas_aynas_asinas_akras_akwas_asimwas_asi???yas".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[asdkh g] LT",
                nextDay: "[aska g] LT",
                nextWeek: "dddd [g] LT",
                lastDay: "[assant g] LT",
                lastWeek: "dddd [g] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "dadkh s yan %s",
                past: "yan %s",
                s: "imik",
                m: "minu???",
                mm: "%d minu???",
                h: "sa??a",
                hh: "%d tassa??in",
                d: "ass",
                dd: "%d ossan",
                M: "ayowr",
                MM: "%d iyyirn",
                y: "asgas",
                yy: "%d isgasn"
            },
            week: {
                dow: 6,
                doy: 12
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        function t(e, t) {
            var n = e.split("_");
            return t % 10 == 1 && t % 100 != 11 ? n[0] : t % 10 >= 2 && t % 10 <= 4 && (t % 100 < 10 || t % 100 >= 20) ? n[1] : n[2]
        }
        function n(e, n, a) {
            var r = {
                mm: n ? "??????????????_??????????????_????????????" : "??????????????_??????????????_????????????",
                hh: n ? "????????????_????????????_??????????" : "????????????_????????????_??????????",
                dd: "????????_??????_????????",
                MM: "????????????_????????????_??????????????",
                yy: "??????_????????_??????????"
            };
            return "m" === a ? n ? "??????????????" : "??????????????" : "h" === a ? n ? "????????????" : "????????????" : e + " " + t(r[a], +e)
        }
        function a(e, t) {
            var n = {
                nominative: "????????????_??????????????????_????????????????_????????????_????????????_?????????????????_????????????".split("_"),
                accusative: "????????????_??????????????????_????????????????_????????????_????????????_?????????????????_????????????".split("_"),
                genitive: "????????????_??????????????????_????????????????_????????????_????????????????_?????????????????_????????????".split("_")
            };
            return e ? n[/(\[[????????]\]) ?dddd/.test(t) ? "accusative" : /\[?(?:??????????????|??????????????????)? ?\] ?dddd/.test(t) ? "genitive" : "nominative"][e.day()] : n.nominative
        }
        function r(e) {
            return function() {
                return e + "??" + (11 === this.hours() ? "??" : "") + "] LT"
            }
        }
        return e.defineLocale("uk", {
            months: {
                format: "??????????_????????????_??????????????_????????????_????????????_????????????_??????????_????????????_??????????????_????????????_??????????????????_????????????".split("_"),
                standalone: "????????????_??????????_????????????????_??????????????_??????????????_??????????????_????????????_??????????????_????????????????_??????????????_????????????????_??????????????".split("_")
            },
            monthsShort: "??????_??????_??????_????????_????????_????????_??????_????????_??????_????????_????????_????????".split("_"),
            weekdays: a,
            weekdaysShort: "????_????_????_????_????_????_????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD.MM.YYYY",
                LL: "D MMMM YYYY ??.",
                LLL: "D MMMM YYYY ??., HH:mm",
                LLLL: "dddd, D MMMM YYYY ??., HH:mm"
            },
            calendar: {
                sameDay: r("[???????????????? "),
                nextDay: r("[???????????? "),
                lastDay: r("[?????????? "),
                nextWeek: r("[??] dddd ["),
                lastWeek: function() {
                    switch (this.day()) {
                    case 0:
                    case 3:
                    case 5:
                    case 6:
                        return r("[??????????????] dddd [").call(this);
                    case 1:
                    case 2:
                    case 4:
                        return r("[????????????????] dddd [").call(this)
                    }
                },
                sameElse: "L"
            },
            relativeTime: {
                future: "???? %s",
                past: "%s ????????",
                s: "???????????????? ????????????",
                m: n,
                mm: n,
                h: "????????????",
                hh: n,
                d: "????????",
                dd: n,
                M: "????????????",
                MM: n,
                y: "??????",
                yy: n
            },
            meridiemParse: /????????|??????????|??????|????????????/,
            isPM: function(e) {
                return /^(??????|????????????)$/.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 4 ? "????????" : e < 12 ? "??????????" : e < 17 ? "??????" : "????????????"
            },
            dayOfMonthOrdinalParse: /\d{1,2}-(??|????)/,
            ordinal: function(e, t) {
                switch (t) {
                case "M":
                case "d":
                case "DDD":
                case "w":
                case "W":
                    return e + "-??";
                case "D":
                    return e + "-????";
                default:
                    return e
                }
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        var t = ["??????????", "??????????", "????????", "??????????", "??????", "??????", "????????????", "????????", "??????????", "????????????", "??????????", "??????????"]
          , n = ["??????????", "??????", "????????", "??????", "????????????", "????????", "????????"];
        return e.defineLocale("ur", {
            months: t,
            monthsShort: t,
            weekdays: n,
            weekdaysShort: n,
            weekdaysMin: n,
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd?? D MMMM YYYY HH:mm"
            },
            meridiemParse: /??????|??????/,
            isPM: function(e) {
                return "??????" === e
            },
            meridiem: function(e, t, n) {
                return e < 12 ? "??????" : "??????"
            },
            calendar: {
                sameDay: "[???? ????????] LT",
                nextDay: "[???? ????????] LT",
                nextWeek: "dddd [????????] LT",
                lastDay: "[?????????? ?????? ????????] LT",
                lastWeek: "[??????????] dddd [????????] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s ??????",
                past: "%s ??????",
                s: "?????? ??????????",
                m: "?????? ??????",
                mm: "%d ??????",
                h: "?????? ??????????",
                hh: "%d ??????????",
                d: "?????? ????",
                dd: "%d ????",
                M: "?????? ??????",
                MM: "%d ??????",
                y: "?????? ??????",
                yy: "%d ??????"
            },
            preparse: function(e) {
                return e.replace(/??/g, ",")
            },
            postformat: function(e) {
                return e.replace(/,/g, "??")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("uz", {
            months: "??????????_????????????_????????_??????????_??????_??????_??????_????????????_??????????????_????????????_??????????_????????????".split("_"),
            monthsShort: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdays: "??????????????_??????????????_??????????????_????????????????_????????????????_????????_??????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "????_????_????_????_????_????_????".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "D MMMM YYYY, dddd HH:mm"
            },
            calendar: {
                sameDay: "[?????????? ????????] LT [????]",
                nextDay: "[????????????] LT [????]",
                nextWeek: "dddd [???????? ????????] LT [????]",
                lastDay: "[???????? ????????] LT [????]",
                lastWeek: "[??????????] dddd [???????? ????????] LT [????]",
                sameElse: "L"
            },
            relativeTime: {
                future: "???????? %s ??????????",
                past: "?????? ???????? %s ??????????",
                s: "????????????",
                m: "?????? ????????????",
                mm: "%d ????????????",
                h: "?????? ????????",
                hh: "%d ????????",
                d: "?????? ??????",
                dd: "%d ??????",
                M: "?????? ????",
                MM: "%d ????",
                y: "?????? ??????",
                yy: "%d ??????"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("uz-latn", {
            months: "Yanvar_Fevral_Mart_Aprel_May_Iyun_Iyul_Avgust_Sentabr_Oktabr_Noyabr_Dekabr".split("_"),
            monthsShort: "Yan_Fev_Mar_Apr_May_Iyun_Iyul_Avg_Sen_Okt_Noy_Dek".split("_"),
            weekdays: "Yakshanba_Dushanba_Seshanba_Chorshanba_Payshanba_Juma_Shanba".split("_"),
            weekdaysShort: "Yak_Dush_Sesh_Chor_Pay_Jum_Shan".split("_"),
            weekdaysMin: "Ya_Du_Se_Cho_Pa_Ju_Sha".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "D MMMM YYYY, dddd HH:mm"
            },
            calendar: {
                sameDay: "[Bugun soat] LT [da]",
                nextDay: "[Ertaga] LT [da]",
                nextWeek: "dddd [kuni soat] LT [da]",
                lastDay: "[Kecha soat] LT [da]",
                lastWeek: "[O'tgan] dddd [kuni soat] LT [da]",
                sameElse: "L"
            },
            relativeTime: {
                future: "Yaqin %s ichida",
                past: "Bir necha %s oldin",
                s: "soniya",
                m: "bir daqiqa",
                mm: "%d daqiqa",
                h: "bir soat",
                hh: "%d soat",
                d: "bir kun",
                dd: "%d kun",
                M: "bir oy",
                MM: "%d oy",
                y: "bir yil",
                yy: "%d yil"
            },
            week: {
                dow: 1,
                doy: 7
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("vi", {
            months: "th??ng 1_th??ng 2_th??ng 3_th??ng 4_th??ng 5_th??ng 6_th??ng 7_th??ng 8_th??ng 9_th??ng 10_th??ng 11_th??ng 12".split("_"),
            monthsShort: "Th01_Th02_Th03_Th04_Th05_Th06_Th07_Th08_Th09_Th10_Th11_Th12".split("_"),
            monthsParseExact: !0,
            weekdays: "ch??? nh???t_th??? hai_th??? ba_th??? t??_th??? n??m_th??? s??u_th??? b???y".split("_"),
            weekdaysShort: "CN_T2_T3_T4_T5_T6_T7".split("_"),
            weekdaysMin: "CN_T2_T3_T4_T5_T6_T7".split("_"),
            weekdaysParseExact: !0,
            meridiemParse: /sa|ch/i,
            isPM: function(e) {
                return /^ch$/i.test(e)
            },
            meridiem: function(e, t, n) {
                return e < 12 ? n ? "sa" : "SA" : n ? "ch" : "CH"
            },
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "DD/MM/YYYY",
                LL: "D MMMM [n??m] YYYY",
                LLL: "D MMMM [n??m] YYYY HH:mm",
                LLLL: "dddd, D MMMM [n??m] YYYY HH:mm",
                l: "DD/M/YYYY",
                ll: "D MMM YYYY",
                lll: "D MMM YYYY HH:mm",
                llll: "ddd, D MMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[H??m nay l??c] LT",
                nextDay: "[Ng??y mai l??c] LT",
                nextWeek: "dddd [tu???n t???i l??c] LT",
                lastDay: "[H??m qua l??c] LT",
                lastWeek: "dddd [tu???n r???i l??c] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "%s t???i",
                past: "%s tr?????c",
                s: "v??i gi??y",
                m: "m???t ph??t",
                mm: "%d ph??t",
                h: "m???t gi???",
                hh: "%d gi???",
                d: "m???t ng??y",
                dd: "%d ng??y",
                M: "m???t th??ng",
                MM: "%d th??ng",
                y: "m???t n??m",
                yy: "%d n??m"
            },
            dayOfMonthOrdinalParse: /\d{1,2}/,
            ordinal: function(e) {
                return e
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("x-pseudo", {
            months: "J~????????~r??_F~??br??~??r??_~M??rc~h_??p~r??l_~M????_~J??????~_J??l~??_????~g??st~_S??p~t??mb~??r_??~ct??b~??r_??~??v??m~b??r_~D??c??~mb??r".split("_"),
            monthsShort: "J~????_~F??b_~M??r_~??pr_~M????_~J????_~J??l_~????g_~S??p_~??ct_~????v_~D??c".split("_"),
            monthsParseExact: !0,
            weekdays: "S~????d??~??_M??~??d????~_T????~sd????~_W??d~????sd~????_T~h??rs~d????_~Fr??d~????_S~??t??r~d????".split("_"),
            weekdaysShort: "S~????_~M????_~T????_~W??d_~Th??_~Fr??_~S??t".split("_"),
            weekdaysMin: "S~??_M??~_T??_~W??_T~h_Fr~_S??".split("_"),
            weekdaysParseExact: !0,
            longDateFormat: {
                LT: "HH:mm",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY HH:mm",
                LLLL: "dddd, D MMMM YYYY HH:mm"
            },
            calendar: {
                sameDay: "[T~??d??~?? ??t] LT",
                nextDay: "[T~??m??~rr??~w ??t] LT",
                nextWeek: "dddd [??t] LT",
                lastDay: "[??~??st~??rd??~?? ??t] LT",
                lastWeek: "[L~??st] dddd [??t] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "??~?? %s",
                past: "%s ??~g??",
                s: "?? ~f??w ~s??c??~??ds",
                m: "?? ~m????~??t??",
                mm: "%d m~??????~t??s",
                h: "??~?? h??~??r",
                hh: "%d h~????rs",
                d: "?? ~d????",
                dd: "%d d~????s",
                M: "?? ~m????~th",
                MM: "%d m~????t~hs",
                y: "?? ~??????r",
                yy: "%d ??~????rs"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
            ordinal: function(e) {
                var t = e % 10;
                return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("yo", {
            months: "S?????r?????_E??re??le??_???r?????na??_I??gbe??_E??bibi_O??ku??du_Ag???mo_O??gu??n_Owewe_?????wa??ra??_Be??lu??_?????p???????".split("_"),
            monthsShort: "S?????r_E??rl_???rn_I??gb_E??bi_O??ku??_Ag???_O??gu??_Owe_?????wa??_Be??l_?????p???????".split("_"),
            weekdays: "A??i??ku??_Aje??_I??s?????gun_???j?????ru??_???j?????b???_???ti??_A??ba??m?????ta".split("_"),
            weekdaysShort: "A??i??k_Aje??_I??s?????_???jr_???jb_???ti??_A??ba??".split("_"),
            weekdaysMin: "A??i??_Aj_I??s_???r_???b_???t_A??b".split("_"),
            longDateFormat: {
                LT: "h:mm A",
                LTS: "h:mm:ss A",
                L: "DD/MM/YYYY",
                LL: "D MMMM YYYY",
                LLL: "D MMMM YYYY h:mm A",
                LLLL: "dddd, D MMMM YYYY h:mm A"
            },
            calendar: {
                sameDay: "[O??ni?? ni] LT",
                nextDay: "[?????la ni] LT",
                nextWeek: "dddd [???s????? to??n'b???] [ni] LT",
                lastDay: "[A??na ni] LT",
                lastWeek: "dddd [???s????? to??l?????] [ni] LT",
                sameElse: "L"
            },
            relativeTime: {
                future: "ni?? %s",
                past: "%s k???ja??",
                s: "i??s???ju?? aaya?? die",
                m: "i??s???ju?? kan",
                mm: "i??s???ju?? %d",
                h: "wa??kati kan",
                hh: "wa??kati %d",
                d: "???j????? kan",
                dd: "???j????? %d",
                M: "osu?? kan",
                MM: "osu?? %d",
                y: "???du??n kan",
                yy: "???du??n %d"
            },
            dayOfMonthOrdinalParse: /???j?????\s\d{1,2}/,
            ordinal: "???j????? %d",
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("zh-cn", {
            months: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_?????????_?????????".split("_"),
            monthsShort: "1???_2???_3???_4???_5???_6???_7???_8???_9???_10???_11???_12???".split("_"),
            weekdays: "?????????_?????????_?????????_?????????_?????????_?????????_?????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "???_???_???_???_???_???_???".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY???MMMD???",
                LL: "YYYY???MMMD???",
                LLL: "YYYY???MMMD???Ah???mm???",
                LLLL: "YYYY???MMMD???ddddAh???mm???",
                l: "YYYY???MMMD???",
                ll: "YYYY???MMMD???",
                lll: "YYYY???MMMD??? HH:mm",
                llll: "YYYY???MMMD???dddd HH:mm"
            },
            meridiemParse: /??????|??????|??????|??????|??????|??????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????" === t || "??????" === t || "??????" === t ? e : "??????" === t || "??????" === t ? e + 12 : e >= 11 ? e : e + 12
            },
            meridiem: function(e, t, n) {
                var a = 100 * e + t;
                return a < 600 ? "??????" : a < 900 ? "??????" : a < 1130 ? "??????" : a < 1230 ? "??????" : a < 1800 ? "??????" : "??????"
            },
            calendar: {
                sameDay: "[??????]LT",
                nextDay: "[??????]LT",
                nextWeek: "[???]ddddLT",
                lastDay: "[??????]LT",
                lastWeek: "[???]ddddLT",
                sameElse: "L"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(???|???|???)/,
            ordinal: function(e, t) {
                switch (t) {
                case "d":
                case "D":
                case "DDD":
                    return e + "???";
                case "M":
                    return e + "???";
                case "w":
                case "W":
                    return e + "???";
                default:
                    return e
                }
            },
            relativeTime: {
                future: "%s???",
                past: "%s???",
                s: "??????",
                m: "1 ??????",
                mm: "%d ??????",
                h: "1 ??????",
                hh: "%d ??????",
                d: "1 ???",
                dd: "%d ???",
                M: "1 ??????",
                MM: "%d ??????",
                y: "1 ???",
                yy: "%d ???"
            },
            week: {
                dow: 1,
                doy: 4
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("zh-hk", {
            months: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_?????????_?????????".split("_"),
            monthsShort: "1???_2???_3???_4???_5???_6???_7???_8???_9???_10???_11???_12???".split("_"),
            weekdays: "?????????_?????????_?????????_?????????_?????????_?????????_?????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "???_???_???_???_???_???_???".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY???MMMD???",
                LL: "YYYY???MMMD???",
                LLL: "YYYY???MMMD??? HH:mm",
                LLLL: "YYYY???MMMD???dddd HH:mm",
                l: "YYYY???MMMD???",
                ll: "YYYY???MMMD???",
                lll: "YYYY???MMMD??? HH:mm",
                llll: "YYYY???MMMD???dddd HH:mm"
            },
            meridiemParse: /??????|??????|??????|??????|??????|??????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????" === t || "??????" === t || "??????" === t ? e : "??????" === t ? e >= 11 ? e : e + 12 : "??????" === t || "??????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                var a = 100 * e + t;
                return a < 600 ? "??????" : a < 900 ? "??????" : a < 1130 ? "??????" : a < 1230 ? "??????" : a < 1800 ? "??????" : "??????"
            },
            calendar: {
                sameDay: "[??????]LT",
                nextDay: "[??????]LT",
                nextWeek: "[???]ddddLT",
                lastDay: "[??????]LT",
                lastWeek: "[???]ddddLT",
                sameElse: "L"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(???|???|???)/,
            ordinal: function(e, t) {
                switch (t) {
                case "d":
                case "D":
                case "DDD":
                    return e + "???";
                case "M":
                    return e + "???";
                case "w":
                case "W":
                    return e + "???";
                default:
                    return e
                }
            },
            relativeTime: {
                future: "%s???",
                past: "%s???",
                s: "??????",
                m: "1 ??????",
                mm: "%d ??????",
                h: "1 ??????",
                hh: "%d ??????",
                d: "1 ???",
                dd: "%d ???",
                M: "1 ??????",
                MM: "%d ??????",
                y: "1 ???",
                yy: "%d ???"
            }
        })
    })
}
, function(e, t, n) {
    !function(e, t) {
        t(n(0))
    }(0, function(e) {
        "use strict";
        return e.defineLocale("zh-tw", {
            months: "??????_??????_??????_??????_??????_??????_??????_??????_??????_??????_?????????_?????????".split("_"),
            monthsShort: "1???_2???_3???_4???_5???_6???_7???_8???_9???_10???_11???_12???".split("_"),
            weekdays: "?????????_?????????_?????????_?????????_?????????_?????????_?????????".split("_"),
            weekdaysShort: "??????_??????_??????_??????_??????_??????_??????".split("_"),
            weekdaysMin: "???_???_???_???_???_???_???".split("_"),
            longDateFormat: {
                LT: "HH:mm",
                LTS: "HH:mm:ss",
                L: "YYYY???MMMD???",
                LL: "YYYY???MMMD???",
                LLL: "YYYY???MMMD??? HH:mm",
                LLLL: "YYYY???MMMD???dddd HH:mm",
                l: "YYYY???MMMD???",
                ll: "YYYY???MMMD???",
                lll: "YYYY???MMMD??? HH:mm",
                llll: "YYYY???MMMD???dddd HH:mm"
            },
            meridiemParse: /??????|??????|??????|??????|??????|??????/,
            meridiemHour: function(e, t) {
                return 12 === e && (e = 0),
                "??????" === t || "??????" === t || "??????" === t ? e : "??????" === t ? e >= 11 ? e : e + 12 : "??????" === t || "??????" === t ? e + 12 : void 0
            },
            meridiem: function(e, t, n) {
                var a = 100 * e + t;
                return a < 600 ? "??????" : a < 900 ? "??????" : a < 1130 ? "??????" : a < 1230 ? "??????" : a < 1800 ? "??????" : "??????"
            },
            calendar: {
                sameDay: "[??????]LT",
                nextDay: "[??????]LT",
                nextWeek: "[???]ddddLT",
                lastDay: "[??????]LT",
                lastWeek: "[???]ddddLT",
                sameElse: "L"
            },
            dayOfMonthOrdinalParse: /\d{1,2}(???|???|???)/,
            ordinal: function(e, t) {
                switch (t) {
                case "d":
                case "D":
                case "DDD":
                    return e + "???";
                case "M":
                    return e + "???";
                case "w":
                case "W":
                    return e + "???";
                default:
                    return e
                }
            },
            relativeTime: {
                future: "%s???",
                past: "%s???",
                s: "??????",
                m: "1 ??????",
                mm: "%d ??????",
                h: "1 ??????",
                hh: "%d ??????",
                d: "1 ???",
                dd: "%d ???",
                M: "1 ??????",
                MM: "%d ??????",
                y: "1 ???",
                yy: "%d ???"
            }
        })
    })
}
, function(e, t, n) {
    e.exports = n(124)
}
, function(e, t, n) {
    n(125),
    n(126)
}
, function(e, t) {
    function n() {
        windowFocus = !1
    }
    function a() {
        windowFocus = !0
    }
    window.windowFocus = !0,
    window.onfocus = a,
    window.onblur = n
}
, function(e, t, n) {
    "use strict";
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = n(127)
      , r = n.n(a)
      , i = n(129)
      , s = n.n(i)
      , o = n(149)
      , d = n.n(o)
      , u = n(150)
      , _ = n.n(u)
      , l = n(0)
      , c = n.n(l)
      , m = n(155)
      , f = n.n(m);
    window.Vue = r.a,
    window.axios = s.a,
    window.querystring = _.a,
    window.moment = c.a,
    window.pushjs = f.a,
    r.a.use(d.a, s.a),
    r.a.component("firebase-messages", n(156));
    new r.a({
        el: "#app"
    })
}
, function(e, t, n) {
    "use strict";
    (function(t) {
        function n(e) {
            return void 0 === e || null === e
        }
        function a(e) {
            return void 0 !== e && null !== e
        }
        function r(e) {
            return !0 === e
        }
        function i(e) {
            return !1 === e
        }
        function s(e) {
            return "string" == typeof e || "number" == typeof e || "boolean" == typeof e
        }
        function o(e) {
            return null !== e && "object" == typeof e
        }
        function d(e) {
            return "[object Object]" === Nr.call(e)
        }
        function u(e) {
            return "[object RegExp]" === Nr.call(e)
        }
        function _(e) {
            var t = parseFloat(e);
            return t >= 0 && Math.floor(t) === t && isFinite(e)
        }
        function l(e) {
            return null == e ? "" : "object" == typeof e ? JSON.stringify(e, null, 2) : String(e)
        }
        function c(e) {
            var t = parseFloat(e);
            return isNaN(t) ? e : t
        }
        function m(e, t) {
            for (var n = Object.create(null), a = e.split(","), r = 0; r < a.length; r++)
                n[a[r]] = !0;
            return t ? function(e) {
                return n[e.toLowerCase()]
            }
            : function(e) {
                return n[e]
            }
        }
        function f(e, t) {
            if (e.length) {
                var n = e.indexOf(t);
                if (n > -1)
                    return e.splice(n, 1)
            }
        }
        function h(e, t) {
            return Ir.call(e, t)
        }
        function p(e) {
            var t = Object.create(null);
            return function(n) {
                return t[n] || (t[n] = e(n))
            }
        }
        function M(e, t) {
            function n(n) {
                var a = arguments.length;
                return a ? a > 1 ? e.apply(t, arguments) : e.call(t, n) : e.call(t)
            }
            return n._length = e.length,
            n
        }
        function y(e, t) {
            t = t || 0;
            for (var n = e.length - t, a = new Array(n); n--; )
                a[n] = e[n + t];
            return a
        }
        function L(e, t) {
            for (var n in t)
                e[n] = t[n];
            return e
        }
        function v(e) {
            for (var t = {}, n = 0; n < e.length; n++)
                e[n] && L(t, e[n]);
            return t
        }
        function Y(e, t, n) {}
        function g(e, t) {
            if (e === t)
                return !0;
            var n = o(e)
              , a = o(t);
            if (!n || !a)
                return !n && !a && String(e) === String(t);
            try {
                var r = Array.isArray(e)
                  , i = Array.isArray(t);
                if (r && i)
                    return e.length === t.length && e.every(function(e, n) {
                        return g(e, t[n])
                    });
                if (r || i)
                    return !1;
                var s = Object.keys(e)
                  , d = Object.keys(t);
                return s.length === d.length && s.every(function(n) {
                    return g(e[n], t[n])
                })
            } catch (e) {
                return !1
            }
        }
        function k(e, t) {
            for (var n = 0; n < e.length; n++)
                if (g(e[n], t))
                    return n;
            return -1
        }
        function D(e) {
            var t = !1;
            return function() {
                t || (t = !0,
                e.apply(this, arguments))
            }
        }
        function w(e) {
            var t = (e + "").charCodeAt(0);
            return 36 === t || 95 === t
        }
        function T(e, t, n, a) {
            Object.defineProperty(e, t, {
                value: n,
                enumerable: !!a,
                writable: !0,
                configurable: !0
            })
        }
        function b(e) {
            if (!ni.test(e)) {
                var t = e.split(".");
                return function(e) {
                    for (var n = 0; n < t.length; n++) {
                        if (!e)
                            return;
                        e = e[t[n]]
                    }
                    return e
                }
            }
        }
        function S(e, t, n) {
            if (ei.errorHandler)
                ei.errorHandler.call(null, e, t, n);
            else if (!ii || "undefined" == typeof console)
                throw e
        }
        function j(e) {
            return "function" == typeof e && /native code/.test(e.toString())
        }
        function H(e) {
            ki.target && Di.push(ki.target),
            ki.target = e
        }
        function x() {
            ki.target = Di.pop()
        }
        function O(e, t, n) {
            e.__proto__ = t
        }
        function P(e, t, n) {
            for (var a = 0, r = n.length; a < r; a++) {
                var i = n[a];
                T(e, i, t[i])
            }
        }
        function A(e, t) {
            if (o(e)) {
                var n;
                return h(e, "__ob__") && e.__ob__ instanceof ji ? n = e.__ob__ : Si.shouldConvert && !yi() && (Array.isArray(e) || d(e)) && Object.isExtensible(e) && !e._isVue && (n = new ji(e)),
                t && n && n.vmCount++,
                n
            }
        }
        function E(e, t, n, a, r) {
            var i = new ki
              , s = Object.getOwnPropertyDescriptor(e, t);
            if (!s || !1 !== s.configurable) {
                var o = s && s.get
                  , d = s && s.set
                  , u = !r && A(n);
                Object.defineProperty(e, t, {
                    enumerable: !0,
                    configurable: !0,
                    get: function() {
                        var t = o ? o.call(e) : n;
                        return ki.target && (i.depend(),
                        u && (u.dep.depend(),
                        Array.isArray(t) && F(t))),
                        t
                    },
                    set: function(t) {
                        var a = o ? o.call(e) : n;
                        t === a || t !== t && a !== a || (d ? d.call(e, t) : n = t,
                        u = !r && A(t),
                        i.notify())
                    }
                })
            }
        }
        function C(e, t, n) {
            if (Array.isArray(e) && _(t))
                return e.length = Math.max(e.length, t),
                e.splice(t, 1, n),
                n;
            if (h(e, t))
                return e[t] = n,
                n;
            var a = e.__ob__;
            return e._isVue || a && a.vmCount ? n : a ? (E(a.value, t, n),
            a.dep.notify(),
            n) : (e[t] = n,
            n)
        }
        function W(e, t) {
            if (Array.isArray(e) && _(t))
                return void e.splice(t, 1);
            var n = e.__ob__;
            e._isVue || n && n.vmCount || h(e, t) && (delete e[t],
            n && n.dep.notify())
        }
        function F(e) {
            for (var t = void 0, n = 0, a = e.length; n < a; n++)
                t = e[n],
                t && t.__ob__ && t.__ob__.dep.depend(),
                Array.isArray(t) && F(t)
        }
        function $(e, t) {
            if (!t)
                return e;
            for (var n, a, r, i = Object.keys(t), s = 0; s < i.length; s++)
                n = i[s],
                a = e[n],
                r = t[n],
                h(e, n) ? d(a) && d(r) && $(a, r) : C(e, n, r);
            return e
        }
        function N(e, t, n) {
            return n ? e || t ? function() {
                var a = "function" == typeof t ? t.call(n) : t
                  , r = "function" == typeof e ? e.call(n) : e;
                return a ? $(a, r) : r
            }
            : void 0 : t ? e ? function() {
                return $("function" == typeof t ? t.call(this) : t, "function" == typeof e ? e.call(this) : e)
            }
            : t : e
        }
        function z(e, t) {
            return t ? e ? e.concat(t) : Array.isArray(t) ? t : [t] : e
        }
        function R(e, t) {
            var n = Object.create(e || null);
            return t ? L(n, t) : n
        }
        function I(e) {
            var t = e.props;
            if (t) {
                var n, a, r, i = {};
                if (Array.isArray(t))
                    for (n = t.length; n--; )
                        "string" == typeof (a = t[n]) && (r = Ur(a),
                        i[r] = {
                            type: null
                        });
                else if (d(t))
                    for (var s in t)
                        a = t[s],
                        r = Ur(s),
                        i[r] = d(a) ? a : {
                            type: a
                        };
                e.props = i
            }
        }
        function J(e) {
            var t = e.inject;
            if (Array.isArray(t))
                for (var n = e.inject = {}, a = 0; a < t.length; a++)
                    n[t[a]] = t[a]
        }
        function U(e) {
            var t = e.directives;
            if (t)
                for (var n in t) {
                    var a = t[n];
                    "function" == typeof a && (t[n] = {
                        bind: a,
                        update: a
                    })
                }
        }
        function G(e, t, n) {
            function a(a) {
                var r = Hi[a] || xi;
                d[a] = r(e[a], t[a], n, a)
            }
            "function" == typeof t && (t = t.options),
            I(t),
            J(t),
            U(t);
            var r = t.extends;
            if (r && (e = G(e, r, n)),
            t.mixins)
                for (var i = 0, s = t.mixins.length; i < s; i++)
                    e = G(e, t.mixins[i], n);
            var o, d = {};
            for (o in e)
                a(o);
            for (o in t)
                h(e, o) || a(o);
            return d
        }
        function V(e, t, n, a) {
            if ("string" == typeof n) {
                var r = e[t];
                if (h(r, n))
                    return r[n];
                var i = Ur(n);
                if (h(r, i))
                    return r[i];
                var s = Gr(i);
                if (h(r, s))
                    return r[s];
                return r[n] || r[i] || r[s]
            }
        }
        function B(e, t, n, a) {
            var r = t[e]
              , i = !h(n, e)
              , s = n[e];
            if (Z(Boolean, r.type) && (i && !h(r, "default") ? s = !1 : Z(String, r.type) || "" !== s && s !== Br(e) || (s = !0)),
            void 0 === s) {
                s = q(a, r, e);
                var o = Si.shouldConvert;
                Si.shouldConvert = !0,
                A(s),
                Si.shouldConvert = o
            }
            return s
        }
        function q(e, t, n) {
            if (h(t, "default")) {
                var a = t.default;
                return e && e.$options.propsData && void 0 === e.$options.propsData[n] && void 0 !== e._props[n] ? e._props[n] : "function" == typeof a && "Function" !== K(t.type) ? a.call(e) : a
            }
        }
        function K(e) {
            var t = e && e.toString().match(/^\s*function (\w+)/);
            return t ? t[1] : ""
        }
        function Z(e, t) {
            if (!Array.isArray(t))
                return K(t) === K(e);
            for (var n = 0, a = t.length; n < a; n++)
                if (K(t[n]) === K(e))
                    return !0;
            return !1
        }
        function Q(e) {
            return new Oi(void 0,void 0,void 0,String(e))
        }
        function X(e, t) {
            var n = new Oi(e.tag,e.data,e.children,e.text,e.elm,e.context,e.componentOptions,e.asyncFactory);
            return n.ns = e.ns,
            n.isStatic = e.isStatic,
            n.key = e.key,
            n.isComment = e.isComment,
            n.isCloned = !0,
            t && e.children && (n.children = ee(e.children)),
            n
        }
        function ee(e, t) {
            for (var n = e.length, a = new Array(n), r = 0; r < n; r++)
                a[r] = X(e[r], t);
            return a
        }
        function te(e) {
            function t() {
                var e = arguments
                  , n = t.fns;
                if (!Array.isArray(n))
                    return n.apply(null, arguments);
                for (var a = n.slice(), r = 0; r < a.length; r++)
                    a[r].apply(null, e)
            }
            return t.fns = e,
            t
        }
        function ne(e, t) {
            return e.plain ? -1 : t.plain ? 1 : 0
        }
        function ae(e, t, a, r, i) {
            var s, o, d, u, _ = [], l = !1;
            for (s in e)
                o = e[s],
                d = t[s],
                u = Ci(s),
                u.plain || (l = !0),
                n(o) || (n(d) ? (n(o.fns) && (o = e[s] = te(o)),
                u.handler = o,
                _.push(u)) : o !== d && (d.fns = o,
                e[s] = d));
            if (_.length) {
                l && _.sort(ne);
                for (var c = 0; c < _.length; c++) {
                    var m = _[c];
                    a(m.name, m.handler, m.once, m.capture, m.passive)
                }
            }
            for (s in t)
                n(e[s]) && (u = Ci(s),
                r(u.name, t[s], u.capture))
        }
        function re(e, t, i) {
            function s() {
                i.apply(this, arguments),
                f(o.fns, s)
            }
            var o, d = e[t];
            n(d) ? o = te([s]) : a(d.fns) && r(d.merged) ? (o = d,
            o.fns.push(s)) : o = te([d, s]),
            o.merged = !0,
            e[t] = o
        }
        function ie(e, t, r) {
            var i = t.options.props;
            if (!n(i)) {
                var s = {}
                  , o = e.attrs
                  , d = e.props;
                if (a(o) || a(d))
                    for (var u in i) {
                        var _ = Br(u);
                        se(s, d, u, _, !0) || se(s, o, u, _, !1)
                    }
                return s
            }
        }
        function se(e, t, n, r, i) {
            if (a(t)) {
                if (h(t, n))
                    return e[n] = t[n],
                    i || delete t[n],
                    !0;
                if (h(t, r))
                    return e[n] = t[r],
                    i || delete t[r],
                    !0
            }
            return !1
        }
        function oe(e) {
            for (var t = 0; t < e.length; t++)
                if (Array.isArray(e[t]))
                    return Array.prototype.concat.apply([], e);
            return e
        }
        function de(e) {
            return s(e) ? [Q(e)] : Array.isArray(e) ? _e(e) : void 0
        }
        function ue(e) {
            return a(e) && a(e.text) && i(e.isComment)
        }
        function _e(e, t) {
            var i, o, d, u = [];
            for (i = 0; i < e.length; i++)
                o = e[i],
                n(o) || "boolean" == typeof o || (d = u[u.length - 1],
                Array.isArray(o) ? u.push.apply(u, _e(o, (t || "") + "_" + i)) : s(o) ? ue(d) ? d.text += String(o) : "" !== o && u.push(Q(o)) : ue(o) && ue(d) ? u[u.length - 1] = Q(d.text + o.text) : (r(e._isVList) && a(o.tag) && n(o.key) && a(t) && (o.key = "__vlist" + t + "_" + i + "__"),
                u.push(o)));
            return u
        }
        function le(e, t) {
            return e.__esModule && e.default && (e = e.default),
            o(e) ? t.extend(e) : e
        }
        function ce(e, t, n, a, r) {
            var i = Ei();
            return i.asyncFactory = e,
            i.asyncMeta = {
                data: t,
                context: n,
                children: a,
                tag: r
            },
            i
        }
        function me(e, t, i) {
            if (r(e.error) && a(e.errorComp))
                return e.errorComp;
            if (a(e.resolved))
                return e.resolved;
            if (r(e.loading) && a(e.loadingComp))
                return e.loadingComp;
            if (!a(e.contexts)) {
                var s = e.contexts = [i]
                  , d = !0
                  , u = function() {
                    for (var e = 0, t = s.length; e < t; e++)
                        s[e].$forceUpdate()
                }
                  , _ = D(function(n) {
                    e.resolved = le(n, t),
                    d || u()
                })
                  , l = D(function(t) {
                    a(e.errorComp) && (e.error = !0,
                    u())
                })
                  , c = e(_, l);
                return o(c) && ("function" == typeof c.then ? n(e.resolved) && c.then(_, l) : a(c.component) && "function" == typeof c.component.then && (c.component.then(_, l),
                a(c.error) && (e.errorComp = le(c.error, t)),
                a(c.loading) && (e.loadingComp = le(c.loading, t),
                0 === c.delay ? e.loading = !0 : setTimeout(function() {
                    n(e.resolved) && n(e.error) && (e.loading = !0,
                    u())
                }, c.delay || 200)),
                a(c.timeout) && setTimeout(function() {
                    n(e.resolved) && l(null)
                }, c.timeout))),
                d = !1,
                e.loading ? e.loadingComp : e.resolved
            }
            e.contexts.push(i)
        }
        function fe(e) {
            return e.isComment && e.asyncFactory
        }
        function he(e) {
            if (Array.isArray(e))
                for (var t = 0; t < e.length; t++) {
                    var n = e[t];
                    if (a(n) && (a(n.componentOptions) || fe(n)))
                        return n
                }
        }
        function pe(e) {
            e._events = Object.create(null),
            e._hasHookEvent = !1;
            var t = e.$options._parentListeners;
            t && Le(e, t)
        }
        function Me(e, t, n) {
            n ? Ai.$once(e, t) : Ai.$on(e, t)
        }
        function ye(e, t) {
            Ai.$off(e, t)
        }
        function Le(e, t, n) {
            Ai = e,
            ae(t, n || {}, Me, ye, e)
        }
        function ve(e, t) {
            var n = {};
            if (!e)
                return n;
            for (var a = [], r = 0, i = e.length; r < i; r++) {
                var s = e[r]
                  , o = s.data;
                if (o && o.attrs && o.attrs.slot && delete o.attrs.slot,
                s.context !== t && s.functionalContext !== t || !o || null == o.slot)
                    a.push(s);
                else {
                    var d = s.data.slot
                      , u = n[d] || (n[d] = []);
                    "template" === s.tag ? u.push.apply(u, s.children) : u.push(s)
                }
            }
            return a.every(Ye) || (n.default = a),
            n
        }
        function Ye(e) {
            return e.isComment || " " === e.text
        }
        function ge(e, t) {
            t = t || {};
            for (var n = 0; n < e.length; n++)
                Array.isArray(e[n]) ? ge(e[n], t) : t[e[n].key] = e[n].fn;
            return t
        }
        function ke(e) {
            var t = e.$options
              , n = t.parent;
            if (n && !t.abstract) {
                for (; n.$options.abstract && n.$parent; )
                    n = n.$parent;
                n.$children.push(e)
            }
            e.$parent = n,
            e.$root = n ? n.$root : e,
            e.$children = [],
            e.$refs = {},
            e._watcher = null,
            e._inactive = null,
            e._directInactive = !1,
            e._isMounted = !1,
            e._isDestroyed = !1,
            e._isBeingDestroyed = !1
        }
        function De(e, t, n) {
            e.$el = t,
            e.$options.render || (e.$options.render = Ei),
            je(e, "beforeMount");
            var a;
            return a = function() {
                e._update(e._render(), n)
            }
            ,
            e._watcher = new Ui(e,a,Y),
            n = !1,
            null == e.$vnode && (e._isMounted = !0,
            je(e, "mounted")),
            e
        }
        function we(e, t, n, a, r) {
            var i = !!(r || e.$options._renderChildren || a.data.scopedSlots || e.$scopedSlots !== ti);
            if (e.$options._parentVnode = a,
            e.$vnode = a,
            e._vnode && (e._vnode.parent = a),
            e.$options._renderChildren = r,
            e.$attrs = a.data && a.data.attrs || ti,
            e.$listeners = n || ti,
            t && e.$options.props) {
                Si.shouldConvert = !1;
                for (var s = e._props, o = e.$options._propKeys || [], d = 0; d < o.length; d++) {
                    var u = o[d];
                    s[u] = B(u, e.$options.props, t, e)
                }
                Si.shouldConvert = !0,
                e.$options.propsData = t
            }
            if (n) {
                var _ = e.$options._parentListeners;
                e.$options._parentListeners = n,
                Le(e, n, _)
            }
            i && (e.$slots = ve(r, a.context),
            e.$forceUpdate())
        }
        function Te(e) {
            for (; e && (e = e.$parent); )
                if (e._inactive)
                    return !0;
            return !1
        }
        function be(e, t) {
            if (t) {
                if (e._directInactive = !1,
                Te(e))
                    return
            } else if (e._directInactive)
                return;
            if (e._inactive || null === e._inactive) {
                e._inactive = !1;
                for (var n = 0; n < e.$children.length; n++)
                    be(e.$children[n]);
                je(e, "activated")
            }
        }
        function Se(e, t) {
            if (!(t && (e._directInactive = !0,
            Te(e)) || e._inactive)) {
                e._inactive = !0;
                for (var n = 0; n < e.$children.length; n++)
                    Se(e.$children[n]);
                je(e, "deactivated")
            }
        }
        function je(e, t) {
            var n = e.$options[t];
            if (n)
                for (var a = 0, r = n.length; a < r; a++)
                    try {
                        n[a].call(e)
                    } catch (n) {
                        S(n, e, t + " hook")
                    }
            e._hasHookEvent && e.$emit("hook:" + t)
        }
        function He() {
            Ii = Fi.length = $i.length = 0,
            Ni = {},
            zi = Ri = !1
        }
        function xe() {
            Ri = !0;
            var e, t;
            for (Fi.sort(function(e, t) {
                return e.id - t.id
            }),
            Ii = 0; Ii < Fi.length; Ii++)
                e = Fi[Ii],
                t = e.id,
                Ni[t] = null,
                e.run();
            var n = $i.slice()
              , a = Fi.slice();
            He(),
            Ae(n),
            Oe(a),
            Li && ei.devtools && Li.emit("flush")
        }
        function Oe(e) {
            for (var t = e.length; t--; ) {
                var n = e[t]
                  , a = n.vm;
                a._watcher === n && a._isMounted && je(a, "updated")
            }
        }
        function Pe(e) {
            e._inactive = !1,
            $i.push(e)
        }
        function Ae(e) {
            for (var t = 0; t < e.length; t++)
                e[t]._inactive = !0,
                be(e[t], !0)
        }
        function Ee(e) {
            var t = e.id;
            if (null == Ni[t]) {
                if (Ni[t] = !0,
                Ri) {
                    for (var n = Fi.length - 1; n > Ii && Fi[n].id > e.id; )
                        n--;
                    Fi.splice(n + 1, 0, e)
                } else
                    Fi.push(e);
                zi || (zi = !0,
                Yi(xe))
            }
        }
        function Ce(e) {
            Gi.clear(),
            We(e, Gi)
        }
        function We(e, t) {
            var n, a, r = Array.isArray(e);
            if ((r || o(e)) && Object.isExtensible(e)) {
                if (e.__ob__) {
                    var i = e.__ob__.dep.id;
                    if (t.has(i))
                        return;
                    t.add(i)
                }
                if (r)
                    for (n = e.length; n--; )
                        We(e[n], t);
                else
                    for (a = Object.keys(e),
                    n = a.length; n--; )
                        We(e[a[n]], t)
            }
        }
        function Fe(e, t, n) {
            Vi.get = function() {
                return this[t][n]
            }
            ,
            Vi.set = function(e) {
                this[t][n] = e
            }
            ,
            Object.defineProperty(e, n, Vi)
        }
        function $e(e) {
            e._watchers = [];
            var t = e.$options;
            t.props && Ne(e, t.props),
            t.methods && Ge(e, t.methods),
            t.data ? ze(e) : A(e._data = {}, !0),
            t.computed && Ie(e, t.computed),
            t.watch && t.watch !== mi && Ve(e, t.watch)
        }
        function Ne(e, t) {
            var n = e.$options.propsData || {}
              , a = e._props = {}
              , r = e.$options._propKeys = []
              , i = !e.$parent;
            Si.shouldConvert = i;
            for (var s in t)
                !function(i) {
                    r.push(i);
                    var s = B(i, t, n, e);
                    E(a, i, s),
                    i in e || Fe(e, "_props", i)
                }(s);
            Si.shouldConvert = !0
        }
        function ze(e) {
            var t = e.$options.data;
            t = e._data = "function" == typeof t ? Re(t, e) : t || {},
            d(t) || (t = {});
            for (var n = Object.keys(t), a = e.$options.props, r = (e.$options.methods,
            n.length); r--; ) {
                var i = n[r];
                a && h(a, i) || w(i) || Fe(e, "_data", i)
            }
            A(t, !0)
        }
        function Re(e, t) {
            try {
                return e.call(t)
            } catch (e) {
                return S(e, t, "data()"),
                {}
            }
        }
        function Ie(e, t) {
            var n = e._computedWatchers = Object.create(null)
              , a = yi();
            for (var r in t) {
                var i = t[r]
                  , s = "function" == typeof i ? i : i.get;
                a || (n[r] = new Ui(e,s || Y,Y,Bi)),
                r in e || Je(e, r, i)
            }
        }
        function Je(e, t, n) {
            var a = !yi();
            "function" == typeof n ? (Vi.get = a ? Ue(t) : n,
            Vi.set = Y) : (Vi.get = n.get ? a && !1 !== n.cache ? Ue(t) : n.get : Y,
            Vi.set = n.set ? n.set : Y),
            Object.defineProperty(e, t, Vi)
        }
        function Ue(e) {
            return function() {
                var t = this._computedWatchers && this._computedWatchers[e];
                if (t)
                    return t.dirty && t.evaluate(),
                    ki.target && t.depend(),
                    t.value
            }
        }
        function Ge(e, t) {
            e.$options.props;
            for (var n in t)
                e[n] = null == t[n] ? Y : M(t[n], e)
        }
        function Ve(e, t) {
            for (var n in t) {
                var a = t[n];
                if (Array.isArray(a))
                    for (var r = 0; r < a.length; r++)
                        Be(e, n, a[r]);
                else
                    Be(e, n, a)
            }
        }
        function Be(e, t, n, a) {
            return d(n) && (a = n,
            n = n.handler),
            "string" == typeof n && (n = e[n]),
            e.$watch(t, n, a)
        }
        function qe(e) {
            var t = e.$options.provide;
            t && (e._provided = "function" == typeof t ? t.call(e) : t)
        }
        function Ke(e) {
            var t = Ze(e.$options.inject, e);
            t && (Si.shouldConvert = !1,
            Object.keys(t).forEach(function(n) {
                E(e, n, t[n])
            }),
            Si.shouldConvert = !0)
        }
        function Ze(e, t) {
            if (e) {
                for (var n = Object.create(null), a = vi ? Reflect.ownKeys(e).filter(function(t) {
                    return Object.getOwnPropertyDescriptor(e, t).enumerable
                }) : Object.keys(e), r = 0; r < a.length; r++)
                    for (var i = a[r], s = e[i], o = t; o; ) {
                        if (o._provided && s in o._provided) {
                            n[i] = o._provided[s];
                            break
                        }
                        o = o.$parent
                    }
                return n
            }
        }
        function Qe(e, t, n, r, i) {
            var s = {}
              , o = e.options.props;
            if (a(o))
                for (var d in o)
                    s[d] = B(d, o, t || ti);
            else
                a(n.attrs) && Xe(s, n.attrs),
                a(n.props) && Xe(s, n.props);
            var u = Object.create(r)
              , _ = function(e, t, n, a) {
                return it(u, e, t, n, a, !0)
            }
              , l = e.options.render.call(null, _, {
                data: n,
                props: s,
                children: i,
                parent: r,
                listeners: n.on || ti,
                injections: Ze(e.options.inject, r),
                slots: function() {
                    return ve(i, r)
                }
            });
            return l instanceof Oi && (l.functionalContext = r,
            l.functionalOptions = e.options,
            n.slot && ((l.data || (l.data = {})).slot = n.slot)),
            l
        }
        function Xe(e, t) {
            for (var n in t)
                e[Ur(n)] = t[n]
        }
        function et(e, t, i, s, d) {
            if (!n(e)) {
                var u = i.$options._base;
                if (o(e) && (e = u.extend(e)),
                "function" == typeof e) {
                    var _;
                    if (n(e.cid) && (_ = e,
                    void 0 === (e = me(_, u, i))))
                        return ce(_, t, i, s, d);
                    t = t || {},
                    vt(e),
                    a(t.model) && rt(e.options, t);
                    var l = ie(t, e, d);
                    if (r(e.options.functional))
                        return Qe(e, l, t, i, s);
                    var c = t.on;
                    if (t.on = t.nativeOn,
                    r(e.options.abstract)) {
                        var m = t.slot;
                        t = {},
                        m && (t.slot = m)
                    }
                    nt(t);
                    var f = e.options.name || d;
                    return new Oi("vue-component-" + e.cid + (f ? "-" + f : ""),t,void 0,void 0,void 0,i,{
                        Ctor: e,
                        propsData: l,
                        listeners: c,
                        tag: d,
                        children: s
                    },_)
                }
            }
        }
        function tt(e, t, n, r) {
            var i = e.componentOptions
              , s = {
                _isComponent: !0,
                parent: t,
                propsData: i.propsData,
                _componentTag: i.tag,
                _parentVnode: e,
                _parentListeners: i.listeners,
                _renderChildren: i.children,
                _parentElm: n || null,
                _refElm: r || null
            }
              , o = e.data.inlineTemplate;
            return a(o) && (s.render = o.render,
            s.staticRenderFns = o.staticRenderFns),
            new i.Ctor(s)
        }
        function nt(e) {
            e.hook || (e.hook = {});
            for (var t = 0; t < Ki.length; t++) {
                var n = Ki[t]
                  , a = e.hook[n]
                  , r = qi[n];
                e.hook[n] = a ? at(r, a) : r
            }
        }
        function at(e, t) {
            return function(n, a, r, i) {
                e(n, a, r, i),
                t(n, a, r, i)
            }
        }
        function rt(e, t) {
            var n = e.model && e.model.prop || "value"
              , r = e.model && e.model.event || "input";
            (t.props || (t.props = {}))[n] = t.model.value;
            var i = t.on || (t.on = {});
            a(i[r]) ? i[r] = [t.model.callback].concat(i[r]) : i[r] = t.model.callback
        }
        function it(e, t, n, a, i, o) {
            return (Array.isArray(n) || s(n)) && (i = a,
            a = n,
            n = void 0),
            r(o) && (i = Qi),
            st(e, t, n, a, i)
        }
        function st(e, t, n, r, i) {
            if (a(n) && a(n.__ob__))
                return Ei();
            if (a(n) && a(n.is) && (t = n.is),
            !t)
                return Ei();
            Array.isArray(r) && "function" == typeof r[0] && (n = n || {},
            n.scopedSlots = {
                default: r[0]
            },
            r.length = 0),
            i === Qi ? r = de(r) : i === Zi && (r = oe(r));
            var s, o;
            if ("string" == typeof t) {
                var d;
                o = e.$vnode && e.$vnode.ns || ei.getTagNamespace(t),
                s = ei.isReservedTag(t) ? new Oi(ei.parsePlatformTagName(t),n,r,void 0,void 0,e) : a(d = V(e.$options, "components", t)) ? et(d, n, e, r, t) : new Oi(t,n,r,void 0,void 0,e)
            } else
                s = et(t, n, e, r);
            return a(s) ? (o && ot(s, o),
            s) : Ei()
        }
        function ot(e, t) {
            if (e.ns = t,
            "foreignObject" !== e.tag && a(e.children))
                for (var r = 0, i = e.children.length; r < i; r++) {
                    var s = e.children[r];
                    a(s.tag) && n(s.ns) && ot(s, t)
                }
        }
        function dt(e, t) {
            var n, r, i, s, d;
            if (Array.isArray(e) || "string" == typeof e)
                for (n = new Array(e.length),
                r = 0,
                i = e.length; r < i; r++)
                    n[r] = t(e[r], r);
            else if ("number" == typeof e)
                for (n = new Array(e),
                r = 0; r < e; r++)
                    n[r] = t(r + 1, r);
            else if (o(e))
                for (s = Object.keys(e),
                n = new Array(s.length),
                r = 0,
                i = s.length; r < i; r++)
                    d = s[r],
                    n[r] = t(e[d], d, r);
            return a(n) && (n._isVList = !0),
            n
        }
        function ut(e, t, n, a) {
            var r = this.$scopedSlots[e];
            if (r)
                return n = n || {},
                a && (n = L(L({}, a), n)),
                r(n) || t;
            var i = this.$slots[e];
            return i || t
        }
        function _t(e) {
            return V(this.$options, "filters", e, !0) || Kr
        }
        function lt(e, t, n) {
            var a = ei.keyCodes[t] || n;
            return Array.isArray(a) ? -1 === a.indexOf(e) : a !== e
        }
        function ct(e, t, n, a, r) {
            if (n)
                if (o(n)) {
                    Array.isArray(n) && (n = v(n));
                    var i;
                    for (var s in n)
                        !function(s) {
                            if ("class" === s || "style" === s || Rr(s))
                                i = e;
                            else {
                                var o = e.attrs && e.attrs.type;
                                i = a || ei.mustUseProp(t, o, s) ? e.domProps || (e.domProps = {}) : e.attrs || (e.attrs = {})
                            }
                            if (!(s in i) && (i[s] = n[s],
                            r)) {
                                (e.on || (e.on = {}))["update:" + s] = function(e) {
                                    n[s] = e
                                }
                            }
                        }(s)
                } else
                    ;return e
        }
        function mt(e, t) {
            var n = this._staticTrees[e];
            return n && !t ? Array.isArray(n) ? ee(n) : X(n) : (n = this._staticTrees[e] = this.$options.staticRenderFns[e].call(this._renderProxy),
            ht(n, "__static__" + e, !1),
            n)
        }
        function ft(e, t, n) {
            return ht(e, "__once__" + t + (n ? "_" + n : ""), !0),
            e
        }
        function ht(e, t, n) {
            if (Array.isArray(e))
                for (var a = 0; a < e.length; a++)
                    e[a] && "string" != typeof e[a] && pt(e[a], t + "_" + a, n);
            else
                pt(e, t, n)
        }
        function pt(e, t, n) {
            e.isStatic = !0,
            e.key = t,
            e.isOnce = n
        }
        function Mt(e, t) {
            if (t)
                if (d(t)) {
                    var n = e.on = e.on ? L({}, e.on) : {};
                    for (var a in t) {
                        var r = n[a]
                          , i = t[a];
                        n[a] = r ? [].concat(i, r) : i
                    }
                } else
                    ;return e
        }
        function yt(e) {
            e._vnode = null,
            e._staticTrees = null;
            var t = e.$vnode = e.$options._parentVnode
              , n = t && t.context;
            e.$slots = ve(e.$options._renderChildren, n),
            e.$scopedSlots = ti,
            e._c = function(t, n, a, r) {
                return it(e, t, n, a, r, !1)
            }
            ,
            e.$createElement = function(t, n, a, r) {
                return it(e, t, n, a, r, !0)
            }
            ;
            var a = t && t.data;
            E(e, "$attrs", a && a.attrs || ti, null, !0),
            E(e, "$listeners", e.$options._parentListeners || ti, null, !0)
        }
        function Lt(e, t) {
            var n = e.$options = Object.create(e.constructor.options);
            n.parent = t.parent,
            n.propsData = t.propsData,
            n._parentVnode = t._parentVnode,
            n._parentListeners = t._parentListeners,
            n._renderChildren = t._renderChildren,
            n._componentTag = t._componentTag,
            n._parentElm = t._parentElm,
            n._refElm = t._refElm,
            t.render && (n.render = t.render,
            n.staticRenderFns = t.staticRenderFns)
        }
        function vt(e) {
            var t = e.options;
            if (e.super) {
                var n = vt(e.super);
                if (n !== e.superOptions) {
                    e.superOptions = n;
                    var a = Yt(e);
                    a && L(e.extendOptions, a),
                    t = e.options = G(n, e.extendOptions),
                    t.name && (t.components[t.name] = e)
                }
            }
            return t
        }
        function Yt(e) {
            var t, n = e.options, a = e.extendOptions, r = e.sealedOptions;
            for (var i in n)
                n[i] !== r[i] && (t || (t = {}),
                t[i] = gt(n[i], a[i], r[i]));
            return t
        }
        function gt(e, t, n) {
            if (Array.isArray(e)) {
                var a = [];
                n = Array.isArray(n) ? n : [n],
                t = Array.isArray(t) ? t : [t];
                for (var r = 0; r < e.length; r++)
                    (t.indexOf(e[r]) >= 0 || n.indexOf(e[r]) < 0) && a.push(e[r]);
                return a
            }
            return e
        }
        function kt(e) {
            this._init(e)
        }
        function Dt(e) {
            e.use = function(e) {
                var t = this._installedPlugins || (this._installedPlugins = []);
                if (t.indexOf(e) > -1)
                    return this;
                var n = y(arguments, 1);
                return n.unshift(this),
                "function" == typeof e.install ? e.install.apply(e, n) : "function" == typeof e && e.apply(null, n),
                t.push(e),
                this
            }
        }
        function wt(e) {
            e.mixin = function(e) {
                return this.options = G(this.options, e),
                this
            }
        }
        function Tt(e) {
            e.cid = 0;
            var t = 1;
            e.extend = function(e) {
                e = e || {};
                var n = this
                  , a = n.cid
                  , r = e._Ctor || (e._Ctor = {});
                if (r[a])
                    return r[a];
                var i = e.name || n.options.name
                  , s = function(e) {
                    this._init(e)
                };
                return s.prototype = Object.create(n.prototype),
                s.prototype.constructor = s,
                s.cid = t++,
                s.options = G(n.options, e),
                s.super = n,
                s.options.props && bt(s),
                s.options.computed && St(s),
                s.extend = n.extend,
                s.mixin = n.mixin,
                s.use = n.use,
                Qr.forEach(function(e) {
                    s[e] = n[e]
                }),
                i && (s.options.components[i] = s),
                s.superOptions = n.options,
                s.extendOptions = e,
                s.sealedOptions = L({}, s.options),
                r[a] = s,
                s
            }
        }
        function bt(e) {
            var t = e.options.props;
            for (var n in t)
                Fe(e.prototype, "_props", n)
        }
        function St(e) {
            var t = e.options.computed;
            for (var n in t)
                Je(e.prototype, n, t[n])
        }
        function jt(e) {
            Qr.forEach(function(t) {
                e[t] = function(e, n) {
                    return n ? ("component" === t && d(n) && (n.name = n.name || e,
                    n = this.options._base.extend(n)),
                    "directive" === t && "function" == typeof n && (n = {
                        bind: n,
                        update: n
                    }),
                    this.options[t + "s"][e] = n,
                    n) : this.options[t + "s"][e]
                }
            })
        }
        function Ht(e) {
            return e && (e.Ctor.options.name || e.tag)
        }
        function xt(e, t) {
            return Array.isArray(e) ? e.indexOf(t) > -1 : "string" == typeof e ? e.split(",").indexOf(t) > -1 : !!u(e) && e.test(t)
        }
        function Ot(e, t, n) {
            for (var a in e) {
                var r = e[a];
                if (r) {
                    var i = Ht(r.componentOptions);
                    i && !n(i) && (r !== t && Pt(r),
                    e[a] = null)
                }
            }
        }
        function Pt(e) {
            e && e.componentInstance.$destroy()
        }
        function At(e) {
            for (var t = e.data, n = e, r = e; a(r.componentInstance); )
                r = r.componentInstance._vnode,
                r.data && (t = Et(r.data, t));
            for (; a(n = n.parent); )
                n.data && (t = Et(t, n.data));
            return Ct(t.staticClass, t.class)
        }
        function Et(e, t) {
            return {
                staticClass: Wt(e.staticClass, t.staticClass),
                class: a(e.class) ? [e.class, t.class] : t.class
            }
        }
        function Ct(e, t) {
            return a(e) || a(t) ? Wt(e, Ft(t)) : ""
        }
        function Wt(e, t) {
            return e ? t ? e + " " + t : e : t || ""
        }
        function Ft(e) {
            return Array.isArray(e) ? $t(e) : o(e) ? Nt(e) : "string" == typeof e ? e : ""
        }
        function $t(e) {
            for (var t, n = "", r = 0, i = e.length; r < i; r++)
                a(t = Ft(e[r])) && "" !== t && (n && (n += " "),
                n += t);
            return n
        }
        function Nt(e) {
            var t = "";
            for (var n in e)
                e[n] && (t && (t += " "),
                t += n);
            return t
        }
        function zt(e) {
            return ks(e) ? "svg" : "math" === e ? "math" : void 0
        }
        function Rt(e) {
            if (!ii)
                return !0;
            if (ws(e))
                return !1;
            if (e = e.toLowerCase(),
            null != Ts[e])
                return Ts[e];
            var t = document.createElement(e);
            return e.indexOf("-") > -1 ? Ts[e] = t.constructor === window.HTMLUnknownElement || t.constructor === window.HTMLElement : Ts[e] = /HTMLUnknownElement/.test(t.toString())
        }
        function It(e) {
            if ("string" == typeof e) {
                var t = document.querySelector(e);
                return t || document.createElement("div")
            }
            return e
        }
        function Jt(e, t) {
            var n = document.createElement(e);
            return "select" !== e ? n : (t.data && t.data.attrs && void 0 !== t.data.attrs.multiple && n.setAttribute("multiple", "multiple"),
            n)
        }
        function Ut(e, t) {
            return document.createElementNS(Ys[e], t)
        }
        function Gt(e) {
            return document.createTextNode(e)
        }
        function Vt(e) {
            return document.createComment(e)
        }
        function Bt(e, t, n) {
            e.insertBefore(t, n)
        }
        function qt(e, t) {
            e.removeChild(t)
        }
        function Kt(e, t) {
            e.appendChild(t)
        }
        function Zt(e) {
            return e.parentNode
        }
        function Qt(e) {
            return e.nextSibling
        }
        function Xt(e) {
            return e.tagName
        }
        function en(e, t) {
            e.textContent = t
        }
        function tn(e, t, n) {
            e.setAttribute(t, n)
        }
        function nn(e, t) {
            var n = e.data.ref;
            if (n) {
                var a = e.context
                  , r = e.componentInstance || e.elm
                  , i = a.$refs;
                t ? Array.isArray(i[n]) ? f(i[n], r) : i[n] === r && (i[n] = void 0) : e.data.refInFor ? Array.isArray(i[n]) ? i[n].indexOf(r) < 0 && i[n].push(r) : i[n] = [r] : i[n] = r
            }
        }
        function an(e, t) {
            return e.key === t.key && (e.tag === t.tag && e.isComment === t.isComment && a(e.data) === a(t.data) && rn(e, t) || r(e.isAsyncPlaceholder) && e.asyncFactory === t.asyncFactory && n(t.asyncFactory.error))
        }
        function rn(e, t) {
            if ("input" !== e.tag)
                return !0;
            var n, r = a(n = e.data) && a(n = n.attrs) && n.type, i = a(n = t.data) && a(n = n.attrs) && n.type;
            return r === i || bs(r) && bs(i)
        }
        function sn(e, t, n) {
            var r, i, s = {};
            for (r = t; r <= n; ++r)
                i = e[r].key,
                a(i) && (s[i] = r);
            return s
        }
        function on(e, t) {
            (e.data.directives || t.data.directives) && dn(e, t)
        }
        function dn(e, t) {
            var n, a, r, i = e === Hs, s = t === Hs, o = un(e.data.directives, e.context), d = un(t.data.directives, t.context), u = [], _ = [];
            for (n in d)
                a = o[n],
                r = d[n],
                a ? (r.oldValue = a.value,
                ln(r, "update", t, e),
                r.def && r.def.componentUpdated && _.push(r)) : (ln(r, "bind", t, e),
                r.def && r.def.inserted && u.push(r));
            if (u.length) {
                var l = function() {
                    for (var n = 0; n < u.length; n++)
                        ln(u[n], "inserted", t, e)
                };
                i ? re(t.data.hook || (t.data.hook = {}), "insert", l) : l()
            }
            if (_.length && re(t.data.hook || (t.data.hook = {}), "postpatch", function() {
                for (var n = 0; n < _.length; n++)
                    ln(_[n], "componentUpdated", t, e)
            }),
            !i)
                for (n in o)
                    d[n] || ln(o[n], "unbind", e, e, s)
        }
        function un(e, t) {
            var n = Object.create(null);
            if (!e)
                return n;
            var a, r;
            for (a = 0; a < e.length; a++)
                r = e[a],
                r.modifiers || (r.modifiers = Ps),
                n[_n(r)] = r,
                r.def = V(t.$options, "directives", r.name, !0);
            return n
        }
        function _n(e) {
            return e.rawName || e.name + "." + Object.keys(e.modifiers || {}).join(".")
        }
        function ln(e, t, n, a, r) {
            var i = e.def && e.def[t];
            if (i)
                try {
                    i(n.elm, e, n, a, r)
                } catch (a) {
                    S(a, n.context, "directive " + e.name + " " + t + " hook")
                }
        }
        function cn(e, t) {
            var r = t.componentOptions;
            if (!(a(r) && !1 === r.Ctor.options.inheritAttrs || n(e.data.attrs) && n(t.data.attrs))) {
                var i, s, o = t.elm, d = e.data.attrs || {}, u = t.data.attrs || {};
                a(u.__ob__) && (u = t.data.attrs = L({}, u));
                for (i in u)
                    s = u[i],
                    d[i] !== s && mn(o, i, s);
                di && u.value !== d.value && mn(o, "value", u.value);
                for (i in d)
                    n(u[i]) && (ys(i) ? o.removeAttributeNS(Ms, Ls(i)) : hs(i) || o.removeAttribute(i))
            }
        }
        function mn(e, t, n) {
            ps(t) ? vs(n) ? e.removeAttribute(t) : (n = "allowfullscreen" === t && "EMBED" === e.tagName ? "true" : t,
            e.setAttribute(t, n)) : hs(t) ? e.setAttribute(t, vs(n) || "false" === n ? "false" : "true") : ys(t) ? vs(n) ? e.removeAttributeNS(Ms, Ls(t)) : e.setAttributeNS(Ms, t, n) : vs(n) ? e.removeAttribute(t) : e.setAttribute(t, n)
        }
        function fn(e, t) {
            var r = t.elm
              , i = t.data
              , s = e.data;
            if (!(n(i.staticClass) && n(i.class) && (n(s) || n(s.staticClass) && n(s.class)))) {
                var o = At(t)
                  , d = r._transitionClasses;
                a(d) && (o = Wt(o, Ft(d))),
                o !== r._prevClass && (r.setAttribute("class", o),
                r._prevClass = o)
            }
        }
        function hn(e) {
            function t() {
                (s || (s = [])).push(e.slice(f, r).trim()),
                f = r + 1
            }
            var n, a, r, i, s, o = !1, d = !1, u = !1, _ = !1, l = 0, c = 0, m = 0, f = 0;
            for (r = 0; r < e.length; r++)
                if (a = n,
                n = e.charCodeAt(r),
                o)
                    39 === n && 92 !== a && (o = !1);
                else if (d)
                    34 === n && 92 !== a && (d = !1);
                else if (u)
                    96 === n && 92 !== a && (u = !1);
                else if (_)
                    47 === n && 92 !== a && (_ = !1);
                else if (124 !== n || 124 === e.charCodeAt(r + 1) || 124 === e.charCodeAt(r - 1) || l || c || m) {
                    switch (n) {
                    case 34:
                        d = !0;
                        break;
                    case 39:
                        o = !0;
                        break;
                    case 96:
                        u = !0;
                        break;
                    case 40:
                        m++;
                        break;
                    case 41:
                        m--;
                        break;
                    case 91:
                        c++;
                        break;
                    case 93:
                        c--;
                        break;
                    case 123:
                        l++;
                        break;
                    case 125:
                        l--
                    }
                    if (47 === n) {
                        for (var h = r - 1, p = void 0; h >= 0 && " " === (p = e.charAt(h)); h--)
                            ;
                        p && Ws.test(p) || (_ = !0)
                    }
                } else
                    void 0 === i ? (f = r + 1,
                    i = e.slice(0, r).trim()) : t();
            if (void 0 === i ? i = e.slice(0, r).trim() : 0 !== f && t(),
            s)
                for (r = 0; r < s.length; r++)
                    i = pn(i, s[r]);
            return i
        }
        function pn(e, t) {
            var n = t.indexOf("(");
            return n < 0 ? '_f("' + t + '")(' + e + ")" : '_f("' + t.slice(0, n) + '")(' + e + "," + t.slice(n + 1)
        }
        function Mn(e) {}
        function yn(e, t) {
            return e ? e.map(function(e) {
                return e[t]
            }).filter(function(e) {
                return e
            }) : []
        }
        function Ln(e, t, n) {
            (e.props || (e.props = [])).push({
                name: t,
                value: n
            })
        }
        function vn(e, t, n) {
            (e.attrs || (e.attrs = [])).push({
                name: t,
                value: n
            })
        }
        function Yn(e, t, n, a, r, i) {
            (e.directives || (e.directives = [])).push({
                name: t,
                rawName: n,
                value: a,
                arg: r,
                modifiers: i
            })
        }
        function gn(e, t, n, a, r, i) {
            a && a.capture && (delete a.capture,
            t = "!" + t),
            a && a.once && (delete a.once,
            t = "~" + t),
            a && a.passive && (delete a.passive,
            t = "&" + t);
            var s;
            a && a.native ? (delete a.native,
            s = e.nativeEvents || (e.nativeEvents = {})) : s = e.events || (e.events = {});
            var o = {
                value: n,
                modifiers: a
            }
              , d = s[t];
            Array.isArray(d) ? r ? d.unshift(o) : d.push(o) : s[t] = d ? r ? [o, d] : [d, o] : o
        }
        function kn(e, t, n) {
            var a = Dn(e, ":" + t) || Dn(e, "v-bind:" + t);
            if (null != a)
                return hn(a);
            if (!1 !== n) {
                var r = Dn(e, t);
                if (null != r)
                    return JSON.stringify(r)
            }
        }
        function Dn(e, t) {
            var n;
            if (null != (n = e.attrsMap[t]))
                for (var a = e.attrsList, r = 0, i = a.length; r < i; r++)
                    if (a[r].name === t) {
                        a.splice(r, 1);
                        break
                    }
            return n
        }
        function wn(e, t, n) {
            var a = n || {}
              , r = a.number
              , i = a.trim
              , s = "$$v";
            i && (s = "(typeof $$v === 'string'? $$v.trim(): $$v)"),
            r && (s = "_n(" + s + ")");
            var o = Tn(t, s);
            e.model = {
                value: "(" + t + ")",
                expression: '"' + t + '"',
                callback: "function ($$v) {" + o + "}"
            }
        }
        function Tn(e, t) {
            var n = bn(e);
            return null === n.idx ? e + "=" + t : "$set(" + n.exp + ", " + n.idx + ", " + t + ")"
        }
        function bn(e) {
            if (rs = e,
            as = rs.length,
            ss = os = ds = 0,
            e.indexOf("[") < 0 || e.lastIndexOf("]") < as - 1)
                return {
                    exp: e,
                    idx: null
                };
            for (; !jn(); )
                is = Sn(),
                Hn(is) ? On(is) : 91 === is && xn(is);
            return {
                exp: e.substring(0, os),
                idx: e.substring(os + 1, ds)
            }
        }
        function Sn() {
            return rs.charCodeAt(++ss)
        }
        function jn() {
            return ss >= as
        }
        function Hn(e) {
            return 34 === e || 39 === e
        }
        function xn(e) {
            var t = 1;
            for (os = ss; !jn(); )
                if (e = Sn(),
                Hn(e))
                    On(e);
                else if (91 === e && t++,
                93 === e && t--,
                0 === t) {
                    ds = ss;
                    break
                }
        }
        function On(e) {
            for (var t = e; !jn() && (e = Sn()) !== t; )
                ;
        }
        function Pn(e, t, n) {
            us = n;
            var a = t.value
              , r = t.modifiers
              , i = e.tag
              , s = e.attrsMap.type;
            if (e.component)
                return wn(e, a, r),
                !1;
            if ("select" === i)
                Cn(e, a, r);
            else if ("input" === i && "checkbox" === s)
                An(e, a, r);
            else if ("input" === i && "radio" === s)
                En(e, a, r);
            else if ("input" === i || "textarea" === i)
                Wn(e, a, r);
            else if (!ei.isReservedTag(i))
                return wn(e, a, r),
                !1;
            return !0
        }
        function An(e, t, n) {
            var a = n && n.number
              , r = kn(e, "value") || "null"
              , i = kn(e, "true-value") || "true"
              , s = kn(e, "false-value") || "false";
            Ln(e, "checked", "Array.isArray(" + t + ")?_i(" + t + "," + r + ")>-1" + ("true" === i ? ":(" + t + ")" : ":_q(" + t + "," + i + ")")),
            gn(e, $s, "var $$a=" + t + ",$$el=$event.target,$$c=$$el.checked?(" + i + "):(" + s + ");if(Array.isArray($$a)){var $$v=" + (a ? "_n(" + r + ")" : r) + ",$$i=_i($$a,$$v);if($$el.checked){$$i<0&&(" + t + "=$$a.concat([$$v]))}else{$$i>-1&&(" + t + "=$$a.slice(0,$$i).concat($$a.slice($$i+1)))}}else{" + Tn(t, "$$c") + "}", null, !0)
        }
        function En(e, t, n) {
            var a = n && n.number
              , r = kn(e, "value") || "null";
            r = a ? "_n(" + r + ")" : r,
            Ln(e, "checked", "_q(" + t + "," + r + ")"),
            gn(e, $s, Tn(t, r), null, !0)
        }
        function Cn(e, t, n) {
            var a = n && n.number
              , r = 'Array.prototype.filter.call($event.target.options,function(o){return o.selected}).map(function(o){var val = "_value" in o ? o._value : o.value;return ' + (a ? "_n(val)" : "val") + "})"
              , i = "var $$selectedVal = " + r + ";";
            i = i + " " + Tn(t, "$event.target.multiple ? $$selectedVal : $$selectedVal[0]"),
            gn(e, "change", i, null, !0)
        }
        function Wn(e, t, n) {
            var a = e.attrsMap.type
              , r = n || {}
              , i = r.lazy
              , s = r.number
              , o = r.trim
              , d = !i && "range" !== a
              , u = i ? "change" : "range" === a ? Fs : "input"
              , _ = "$event.target.value";
            o && (_ = "$event.target.value.trim()"),
            s && (_ = "_n(" + _ + ")");
            var l = Tn(t, _);
            d && (l = "if($event.target.composing)return;" + l),
            Ln(e, "value", "(" + t + ")"),
            gn(e, u, l, null, !0),
            (o || s) && gn(e, "blur", "$forceUpdate()")
        }
        function Fn(e) {
            var t;
            a(e[Fs]) && (t = oi ? "change" : "input",
            e[t] = [].concat(e[Fs], e[t] || []),
            delete e[Fs]),
            a(e[$s]) && (t = ci ? "click" : "change",
            e[t] = [].concat(e[$s], e[t] || []),
            delete e[$s])
        }
        function $n(e, t, n, a, r) {
            if (n) {
                var i = t
                  , s = _s;
                t = function(n) {
                    null !== (1 === arguments.length ? i(n) : i.apply(null, arguments)) && Nn(e, t, a, s)
                }
            }
            _s.addEventListener(e, t, fi ? {
                capture: a,
                passive: r
            } : a)
        }
        function Nn(e, t, n, a) {
            (a || _s).removeEventListener(e, t, n)
        }
        function zn(e, t) {
            if (!n(e.data.on) || !n(t.data.on)) {
                var a = t.data.on || {}
                  , r = e.data.on || {};
                _s = t.elm,
                Fn(a),
                ae(a, r, $n, Nn, t.context)
            }
        }
        function Rn(e, t) {
            if (!n(e.data.domProps) || !n(t.data.domProps)) {
                var r, i, s = t.elm, o = e.data.domProps || {}, d = t.data.domProps || {};
                a(d.__ob__) && (d = t.data.domProps = L({}, d));
                for (r in o)
                    n(d[r]) && (s[r] = "");
                for (r in d)
                    if (i = d[r],
                    "textContent" !== r && "innerHTML" !== r || (t.children && (t.children.length = 0),
                    i !== o[r]))
                        if ("value" === r) {
                            s._value = i;
                            var u = n(i) ? "" : String(i);
                            In(s, t, u) && (s.value = u)
                        } else
                            s[r] = i
            }
        }
        function In(e, t, n) {
            return !e.composing && ("option" === t.tag || Jn(e, n) || Un(e, n))
        }
        function Jn(e, t) {
            var n = !0;
            try {
                n = document.activeElement !== e
            } catch (e) {}
            return n && e.value !== t
        }
        function Un(e, t) {
            var n = e.value
              , r = e._vModifiers;
            return a(r) && r.number ? c(n) !== c(t) : a(r) && r.trim ? n.trim() !== t.trim() : n !== t
        }
        function Gn(e) {
            var t = Vn(e.style);
            return e.staticStyle ? L(e.staticStyle, t) : t
        }
        function Vn(e) {
            return Array.isArray(e) ? v(e) : "string" == typeof e ? Rs(e) : e
        }
        function Bn(e, t) {
            var n, a = {};
            if (t)
                for (var r = e; r.componentInstance; )
                    r = r.componentInstance._vnode,
                    r.data && (n = Gn(r.data)) && L(a, n);
            (n = Gn(e.data)) && L(a, n);
            for (var i = e; i = i.parent; )
                i.data && (n = Gn(i.data)) && L(a, n);
            return a
        }
        function qn(e, t) {
            var r = t.data
              , i = e.data;
            if (!(n(r.staticStyle) && n(r.style) && n(i.staticStyle) && n(i.style))) {
                var s, o, d = t.elm, u = i.staticStyle, _ = i.normalizedStyle || i.style || {}, l = u || _, c = Vn(t.data.style) || {};
                t.data.normalizedStyle = a(c.__ob__) ? L({}, c) : c;
                var m = Bn(t, !0);
                for (o in l)
                    n(m[o]) && Us(d, o, "");
                for (o in m)
                    (s = m[o]) !== l[o] && Us(d, o, null == s ? "" : s)
            }
        }
        function Kn(e, t) {
            if (t && (t = t.trim()))
                if (e.classList)
                    t.indexOf(" ") > -1 ? t.split(/\s+/).forEach(function(t) {
                        return e.classList.add(t)
                    }) : e.classList.add(t);
                else {
                    var n = " " + (e.getAttribute("class") || "") + " ";
                    n.indexOf(" " + t + " ") < 0 && e.setAttribute("class", (n + t).trim())
                }
        }
        function Zn(e, t) {
            if (t && (t = t.trim()))
                if (e.classList)
                    t.indexOf(" ") > -1 ? t.split(/\s+/).forEach(function(t) {
                        return e.classList.remove(t)
                    }) : e.classList.remove(t),
                    e.classList.length || e.removeAttribute("class");
                else {
                    for (var n = " " + (e.getAttribute("class") || "") + " ", a = " " + t + " "; n.indexOf(a) >= 0; )
                        n = n.replace(a, " ");
                    n = n.trim(),
                    n ? e.setAttribute("class", n) : e.removeAttribute("class")
                }
        }
        function Qn(e) {
            if (e) {
                if ("object" == typeof e) {
                    var t = {};
                    return !1 !== e.css && L(t, qs(e.name || "v")),
                    L(t, e),
                    t
                }
                return "string" == typeof e ? qs(e) : void 0
            }
        }
        function Xn(e) {
            ao(function() {
                ao(e)
            })
        }
        function ea(e, t) {
            var n = e._transitionClasses || (e._transitionClasses = []);
            n.indexOf(t) < 0 && (n.push(t),
            Kn(e, t))
        }
        function ta(e, t) {
            e._transitionClasses && f(e._transitionClasses, t),
            Zn(e, t)
        }
        function na(e, t, n) {
            var a = aa(e, t)
              , r = a.type
              , i = a.timeout
              , s = a.propCount;
            if (!r)
                return n();
            var o = r === Zs ? eo : no
              , d = 0
              , u = function() {
                e.removeEventListener(o, _),
                n()
            }
              , _ = function(t) {
                t.target === e && ++d >= s && u()
            };
            setTimeout(function() {
                d < s && u()
            }, i + 1),
            e.addEventListener(o, _)
        }
        function aa(e, t) {
            var n, a = window.getComputedStyle(e), r = a[Xs + "Delay"].split(", "), i = a[Xs + "Duration"].split(", "), s = ra(r, i), o = a[to + "Delay"].split(", "), d = a[to + "Duration"].split(", "), u = ra(o, d), _ = 0, l = 0;
            return t === Zs ? s > 0 && (n = Zs,
            _ = s,
            l = i.length) : t === Qs ? u > 0 && (n = Qs,
            _ = u,
            l = d.length) : (_ = Math.max(s, u),
            n = _ > 0 ? s > u ? Zs : Qs : null,
            l = n ? n === Zs ? i.length : d.length : 0),
            {
                type: n,
                timeout: _,
                propCount: l,
                hasTransform: n === Zs && ro.test(a[Xs + "Property"])
            }
        }
        function ra(e, t) {
            for (; e.length < t.length; )
                e = e.concat(e);
            return Math.max.apply(null, t.map(function(t, n) {
                return ia(t) + ia(e[n])
            }))
        }
        function ia(e) {
            return 1e3 * Number(e.slice(0, -1))
        }
        function sa(e, t) {
            var r = e.elm;
            a(r._leaveCb) && (r._leaveCb.cancelled = !0,
            r._leaveCb());
            var i = Qn(e.data.transition);
            if (!n(i) && !a(r._enterCb) && 1 === r.nodeType) {
                for (var s = i.css, d = i.type, u = i.enterClass, _ = i.enterToClass, l = i.enterActiveClass, m = i.appearClass, f = i.appearToClass, h = i.appearActiveClass, p = i.beforeEnter, M = i.enter, y = i.afterEnter, L = i.enterCancelled, v = i.beforeAppear, Y = i.appear, g = i.afterAppear, k = i.appearCancelled, w = i.duration, T = Wi, b = Wi.$vnode; b && b.parent; )
                    b = b.parent,
                    T = b.context;
                var S = !T._isMounted || !e.isRootInsert;
                if (!S || Y || "" === Y) {
                    var j = S && m ? m : u
                      , H = S && h ? h : l
                      , x = S && f ? f : _
                      , O = S ? v || p : p
                      , P = S && "function" == typeof Y ? Y : M
                      , A = S ? g || y : y
                      , E = S ? k || L : L
                      , C = c(o(w) ? w.enter : w)
                      , W = !1 !== s && !di
                      , F = ua(P)
                      , $ = r._enterCb = D(function() {
                        W && (ta(r, x),
                        ta(r, H)),
                        $.cancelled ? (W && ta(r, j),
                        E && E(r)) : A && A(r),
                        r._enterCb = null
                    });
                    e.data.show || re(e.data.hook || (e.data.hook = {}), "insert", function() {
                        var t = r.parentNode
                          , n = t && t._pending && t._pending[e.key];
                        n && n.tag === e.tag && n.elm._leaveCb && n.elm._leaveCb(),
                        P && P(r, $)
                    }),
                    O && O(r),
                    W && (ea(r, j),
                    ea(r, H),
                    Xn(function() {
                        ea(r, x),
                        ta(r, j),
                        $.cancelled || F || (da(C) ? setTimeout($, C) : na(r, d, $))
                    })),
                    e.data.show && (t && t(),
                    P && P(r, $)),
                    W || F || $()
                }
            }
        }
        function oa(e, t) {
            function r() {
                k.cancelled || (e.data.show || ((i.parentNode._pending || (i.parentNode._pending = {}))[e.key] = e),
                f && f(i),
                v && (ea(i, _),
                ea(i, m),
                Xn(function() {
                    ea(i, l),
                    ta(i, _),
                    k.cancelled || Y || (da(g) ? setTimeout(k, g) : na(i, u, k))
                })),
                h && h(i, k),
                v || Y || k())
            }
            var i = e.elm;
            a(i._enterCb) && (i._enterCb.cancelled = !0,
            i._enterCb());
            var s = Qn(e.data.transition);
            if (n(s))
                return t();
            if (!a(i._leaveCb) && 1 === i.nodeType) {
                var d = s.css
                  , u = s.type
                  , _ = s.leaveClass
                  , l = s.leaveToClass
                  , m = s.leaveActiveClass
                  , f = s.beforeLeave
                  , h = s.leave
                  , p = s.afterLeave
                  , M = s.leaveCancelled
                  , y = s.delayLeave
                  , L = s.duration
                  , v = !1 !== d && !di
                  , Y = ua(h)
                  , g = c(o(L) ? L.leave : L)
                  , k = i._leaveCb = D(function() {
                    i.parentNode && i.parentNode._pending && (i.parentNode._pending[e.key] = null),
                    v && (ta(i, l),
                    ta(i, m)),
                    k.cancelled ? (v && ta(i, _),
                    M && M(i)) : (t(),
                    p && p(i)),
                    i._leaveCb = null
                });
                y ? y(r) : r()
            }
        }
        function da(e) {
            return "number" == typeof e && !isNaN(e)
        }
        function ua(e) {
            if (n(e))
                return !1;
            var t = e.fns;
            return a(t) ? ua(Array.isArray(t) ? t[0] : t) : (e._length || e.length) > 1
        }
        function _a(e, t) {
            !0 !== t.data.show && sa(t)
        }
        function la(e, t, n) {
            ca(e, t, n),
            (oi || ui) && setTimeout(function() {
                ca(e, t, n)
            }, 0)
        }
        function ca(e, t, n) {
            var a = t.value
              , r = e.multiple;
            if (!r || Array.isArray(a)) {
                for (var i, s, o = 0, d = e.options.length; o < d; o++)
                    if (s = e.options[o],
                    r)
                        i = k(a, fa(s)) > -1,
                        s.selected !== i && (s.selected = i);
                    else if (g(fa(s), a))
                        return void (e.selectedIndex !== o && (e.selectedIndex = o));
                r || (e.selectedIndex = -1)
            }
        }
        function ma(e, t) {
            return t.every(function(t) {
                return !g(t, e)
            })
        }
        function fa(e) {
            return "_value"in e ? e._value : e.value
        }
        function ha(e) {
            e.target.composing = !0
        }
        function pa(e) {
            e.target.composing && (e.target.composing = !1,
            Ma(e.target, "input"))
        }
        function Ma(e, t) {
            var n = document.createEvent("HTMLEvents");
            n.initEvent(t, !0, !0),
            e.dispatchEvent(n)
        }
        function ya(e) {
            return !e.componentInstance || e.data && e.data.transition ? e : ya(e.componentInstance._vnode)
        }
        function La(e) {
            var t = e && e.componentOptions;
            return t && t.Ctor.options.abstract ? La(he(t.children)) : e
        }
        function va(e) {
            var t = {}
              , n = e.$options;
            for (var a in n.propsData)
                t[a] = e[a];
            var r = n._parentListeners;
            for (var i in r)
                t[Ur(i)] = r[i];
            return t
        }
        function Ya(e, t) {
            if (/\d-keep-alive$/.test(t.tag))
                return e("keep-alive", {
                    props: t.componentOptions.propsData
                })
        }
        function ga(e) {
            for (; e = e.parent; )
                if (e.data.transition)
                    return !0
        }
        function ka(e, t) {
            return t.key === e.key && t.tag === e.tag
        }
        function Da(e) {
            e.elm._moveCb && e.elm._moveCb(),
            e.elm._enterCb && e.elm._enterCb()
        }
        function wa(e) {
            e.data.newPos = e.elm.getBoundingClientRect()
        }
        function Ta(e) {
            var t = e.data.pos
              , n = e.data.newPos
              , a = t.left - n.left
              , r = t.top - n.top;
            if (a || r) {
                e.data.moved = !0;
                var i = e.elm.style;
                i.transform = i.WebkitTransform = "translate(" + a + "px," + r + "px)",
                i.transitionDuration = "0s"
            }
        }
        function ba(e, t) {
            var n = t ? go(t) : vo;
            if (n.test(e)) {
                for (var a, r, i = [], s = n.lastIndex = 0; a = n.exec(e); ) {
                    r = a.index,
                    r > s && i.push(JSON.stringify(e.slice(s, r)));
                    var o = hn(a[1].trim());
                    i.push("_s(" + o + ")"),
                    s = r + a[0].length
                }
                return s < e.length && i.push(JSON.stringify(e.slice(s))),
                i.join("+")
            }
        }
        function Sa(e, t) {
            var n = (t.warn,
            Dn(e, "class"));
            n && (e.staticClass = JSON.stringify(n));
            var a = kn(e, "class", !1);
            a && (e.classBinding = a)
        }
        function ja(e) {
            var t = "";
            return e.staticClass && (t += "staticClass:" + e.staticClass + ","),
            e.classBinding && (t += "class:" + e.classBinding + ","),
            t
        }
        function Ha(e, t) {
            var n = (t.warn,
            Dn(e, "style"));
            if (n) {
                e.staticStyle = JSON.stringify(Rs(n))
            }
            var a = kn(e, "style", !1);
            a && (e.styleBinding = a)
        }
        function xa(e) {
            var t = "";
            return e.staticStyle && (t += "staticStyle:" + e.staticStyle + ","),
            e.styleBinding && (t += "style:(" + e.styleBinding + "),"),
            t
        }
        function Oa(e, t) {
            t.value && Ln(e, "textContent", "_s(" + t.value + ")")
        }
        function Pa(e, t) {
            t.value && Ln(e, "innerHTML", "_s(" + t.value + ")")
        }
        function Aa(e, t) {
            var n = t ? nd : td;
            return e.replace(n, function(e) {
                return ed[e]
            })
        }
        function Ea(e, t) {
            function n(t) {
                _ += t,
                e = e.substring(t)
            }
            function a(e, n, a) {
                var r, o;
                if (null == n && (n = _),
                null == a && (a = _),
                e && (o = e.toLowerCase()),
                e)
                    for (r = s.length - 1; r >= 0 && s[r].lowerCasedTag !== o; r--)
                        ;
                else
                    r = 0;
                if (r >= 0) {
                    for (var d = s.length - 1; d >= r; d--)
                        t.end && t.end(s[d].tag, n, a);
                    s.length = r,
                    i = r && s[r - 1].tag
                } else
                    "br" === o ? t.start && t.start(e, [], !0, n, a) : "p" === o && (t.start && t.start(e, [], !1, n, a),
                    t.end && t.end(e, n, a))
            }
            for (var r, i, s = [], o = t.expectHTML, d = t.isUnaryTag || qr, u = t.canBeLeftOpenTag || qr, _ = 0; e; ) {
                if (r = e,
                i && Qo(i)) {
                    var l = 0
                      , c = i.toLowerCase()
                      , m = Xo[c] || (Xo[c] = new RegExp("([\\s\\S]*?)(</" + c + "[^>]*>)","i"))
                      , f = e.replace(m, function(e, n, a) {
                        return l = a.length,
                        Qo(c) || "noscript" === c || (n = n.replace(/<!--([\s\S]*?)-->/g, "$1").replace(/<!\[CDATA\[([\s\S]*?)]]>/g, "$1")),
                        rd(c, n) && (n = n.slice(1)),
                        t.chars && t.chars(n),
                        ""
                    });
                    _ += e.length - f.length,
                    e = f,
                    a(c, _ - l, _)
                } else {
                    var h = e.indexOf("<");
                    if (0 === h) {
                        if ($o.test(e)) {
                            var p = e.indexOf("--\x3e");
                            if (p >= 0) {
                                t.shouldKeepComment && t.comment(e.substring(4, p)),
                                n(p + 3);
                                continue
                            }
                        }
                        if (No.test(e)) {
                            var M = e.indexOf("]>");
                            if (M >= 0) {
                                n(M + 2);
                                continue
                            }
                        }
                        var y = e.match(Fo);
                        if (y) {
                            n(y[0].length);
                            continue
                        }
                        var L = e.match(Wo);
                        if (L) {
                            var v = _;
                            n(L[0].length),
                            a(L[1], v, _);
                            continue
                        }
                        var Y = function() {
                            var t = e.match(Eo);
                            if (t) {
                                var a = {
                                    tagName: t[1],
                                    attrs: [],
                                    start: _
                                };
                                n(t[0].length);
                                for (var r, i; !(r = e.match(Co)) && (i = e.match(Oo)); )
                                    n(i[0].length),
                                    a.attrs.push(i);
                                if (r)
                                    return a.unarySlash = r[1],
                                    n(r[0].length),
                                    a.end = _,
                                    a
                            }
                        }();
                        if (Y) {
                            !function(e) {
                                var n = e.tagName
                                  , r = e.unarySlash;
                                o && ("p" === i && jo(n) && a(i),
                                u(n) && i === n && a(n));
                                for (var _ = d(n) || !!r, l = e.attrs.length, c = new Array(l), m = 0; m < l; m++) {
                                    var f = e.attrs[m];
                                    zo && -1 === f[0].indexOf('""') && ("" === f[3] && delete f[3],
                                    "" === f[4] && delete f[4],
                                    "" === f[5] && delete f[5]);
                                    var h = f[3] || f[4] || f[5] || "";
                                    c[m] = {
                                        name: f[1],
                                        value: Aa(h, t.shouldDecodeNewlines)
                                    }
                                }
                                _ || (s.push({
                                    tag: n,
                                    lowerCasedTag: n.toLowerCase(),
                                    attrs: c
                                }),
                                i = n),
                                t.start && t.start(n, c, _, e.start, e.end)
                            }(Y),
                            rd(i, e) && n(1);
                            continue
                        }
                    }
                    var g = void 0
                      , k = void 0
                      , D = void 0;
                    if (h >= 0) {
                        for (k = e.slice(h); !(Wo.test(k) || Eo.test(k) || $o.test(k) || No.test(k) || (D = k.indexOf("<", 1)) < 0); )
                            h += D,
                            k = e.slice(h);
                        g = e.substring(0, h),
                        n(h)
                    }
                    h < 0 && (g = e,
                    e = ""),
                    t.chars && g && t.chars(g)
                }
                if (e === r) {
                    t.chars && t.chars(e);
                    break
                }
            }
            a()
        }
        function Ca(e, t) {
            function n(e) {
                e.pre && (o = !1),
                Vo(e.tag) && (d = !1)
            }
            Ro = t.warn || Mn,
            Vo = t.isPreTag || qr,
            Bo = t.mustUseProp || qr,
            qo = t.getTagNamespace || qr,
            Jo = yn(t.modules, "transformNode"),
            Uo = yn(t.modules, "preTransformNode"),
            Go = yn(t.modules, "postTransformNode"),
            Io = t.delimiters;
            var a, r, i = [], s = !1 !== t.preserveWhitespace, o = !1, d = !1;
            return Ea(e, {
                warn: Ro,
                expectHTML: t.expectHTML,
                isUnaryTag: t.isUnaryTag,
                canBeLeftOpenTag: t.canBeLeftOpenTag,
                shouldDecodeNewlines: t.shouldDecodeNewlines,
                shouldKeepComment: t.comments,
                start: function(e, s, u) {
                    var _ = r && r.ns || qo(e);
                    oi && "svg" === _ && (s = tr(s));
                    var l = {
                        type: 1,
                        tag: e,
                        attrsList: s,
                        attrsMap: Qa(s),
                        parent: r,
                        children: []
                    };
                    _ && (l.ns = _),
                    er(l) && !yi() && (l.forbidden = !0);
                    for (var c = 0; c < Uo.length; c++)
                        Uo[c](l, t);
                    if (o || (Wa(l),
                    l.pre && (o = !0)),
                    Vo(l.tag) && (d = !0),
                    o)
                        Fa(l);
                    else {
                        za(l),
                        Ra(l),
                        Ga(l),
                        $a(l),
                        l.plain = !l.key && !s.length,
                        Na(l),
                        Va(l),
                        Ba(l);
                        for (var m = 0; m < Jo.length; m++)
                            Jo[m](l, t);
                        qa(l)
                    }
                    if (a ? i.length || a.if && (l.elseif || l.else) && Ua(a, {
                        exp: l.elseif,
                        block: l
                    }) : a = l,
                    r && !l.forbidden)
                        if (l.elseif || l.else)
                            Ia(l, r);
                        else if (l.slotScope) {
                            r.plain = !1;
                            var f = l.slotTarget || '"default"';
                            (r.scopedSlots || (r.scopedSlots = {}))[f] = l
                        } else
                            r.children.push(l),
                            l.parent = r;
                    u ? n(l) : (r = l,
                    i.push(l));
                    for (var h = 0; h < Go.length; h++)
                        Go[h](l, t)
                },
                end: function() {
                    var e = i[i.length - 1]
                      , t = e.children[e.children.length - 1];
                    t && 3 === t.type && " " === t.text && !d && e.children.pop(),
                    i.length -= 1,
                    r = i[i.length - 1],
                    n(e)
                },
                chars: function(e) {
                    if (r && (!oi || "textarea" !== r.tag || r.attrsMap.placeholder !== e)) {
                        var t = r.children;
                        if (e = d || e.trim() ? Xa(r) ? e : cd(e) : s && t.length ? " " : "") {
                            var n;
                            !o && " " !== e && (n = ba(e, Io)) ? t.push({
                                type: 2,
                                expression: n,
                                text: e
                            }) : " " === e && t.length && " " === t[t.length - 1].text || t.push({
                                type: 3,
                                text: e
                            })
                        }
                    }
                },
                comment: function(e) {
                    r.children.push({
                        type: 3,
                        text: e,
                        isComment: !0
                    })
                }
            }),
            a
        }
        function Wa(e) {
            null != Dn(e, "v-pre") && (e.pre = !0)
        }
        function Fa(e) {
            var t = e.attrsList.length;
            if (t)
                for (var n = e.attrs = new Array(t), a = 0; a < t; a++)
                    n[a] = {
                        name: e.attrsList[a].name,
                        value: JSON.stringify(e.attrsList[a].value)
                    };
            else
                e.pre || (e.plain = !0)
        }
        function $a(e) {
            var t = kn(e, "key");
            t && (e.key = t)
        }
        function Na(e) {
            var t = kn(e, "ref");
            t && (e.ref = t,
            e.refInFor = Ka(e))
        }
        function za(e) {
            var t;
            if (t = Dn(e, "v-for")) {
                var n = t.match(od);
                if (!n)
                    return;
                e.for = n[2].trim();
                var a = n[1].trim()
                  , r = a.match(dd);
                r ? (e.alias = r[1].trim(),
                e.iterator1 = r[2].trim(),
                r[3] && (e.iterator2 = r[3].trim())) : e.alias = a
            }
        }
        function Ra(e) {
            var t = Dn(e, "v-if");
            if (t)
                e.if = t,
                Ua(e, {
                    exp: t,
                    block: e
                });
            else {
                null != Dn(e, "v-else") && (e.else = !0);
                var n = Dn(e, "v-else-if");
                n && (e.elseif = n)
            }
        }
        function Ia(e, t) {
            var n = Ja(t.children);
            n && n.if && Ua(n, {
                exp: e.elseif,
                block: e
            })
        }
        function Ja(e) {
            for (var t = e.length; t--; ) {
                if (1 === e[t].type)
                    return e[t];
                e.pop()
            }
        }
        function Ua(e, t) {
            e.ifConditions || (e.ifConditions = []),
            e.ifConditions.push(t)
        }
        function Ga(e) {
            null != Dn(e, "v-once") && (e.once = !0)
        }
        function Va(e) {
            if ("slot" === e.tag)
                e.slotName = kn(e, "name");
            else {
                var t = kn(e, "slot");
                t && (e.slotTarget = '""' === t ? '"default"' : t,
                vn(e, "slot", t)),
                "template" === e.tag && (e.slotScope = Dn(e, "scope"))
            }
        }
        function Ba(e) {
            var t;
            (t = kn(e, "is")) && (e.component = t),
            null != Dn(e, "inline-template") && (e.inlineTemplate = !0)
        }
        function qa(e) {
            var t, n, a, r, i, s, o, d = e.attrsList;
            for (t = 0,
            n = d.length; t < n; t++)
                if (a = r = d[t].name,
                i = d[t].value,
                sd.test(a))
                    if (e.hasBindings = !0,
                    s = Za(a),
                    s && (a = a.replace(ld, "")),
                    _d.test(a))
                        a = a.replace(_d, ""),
                        i = hn(i),
                        o = !1,
                        s && (s.prop && (o = !0,
                        "innerHtml" === (a = Ur(a)) && (a = "innerHTML")),
                        s.camel && (a = Ur(a)),
                        s.sync && gn(e, "update:" + Ur(a), Tn(i, "$event"))),
                        o || !e.component && Bo(e.tag, e.attrsMap.type, a) ? Ln(e, a, i) : vn(e, a, i);
                    else if (id.test(a))
                        a = a.replace(id, ""),
                        gn(e, a, i, s, !1, Ro);
                    else {
                        a = a.replace(sd, "");
                        var u = a.match(ud)
                          , _ = u && u[1];
                        _ && (a = a.slice(0, -(_.length + 1))),
                        Yn(e, a, r, i, _, s)
                    }
                else {
                    vn(e, a, JSON.stringify(i))
                }
        }
        function Ka(e) {
            for (var t = e; t; ) {
                if (void 0 !== t.for)
                    return !0;
                t = t.parent
            }
            return !1
        }
        function Za(e) {
            var t = e.match(ld);
            if (t) {
                var n = {};
                return t.forEach(function(e) {
                    n[e.slice(1)] = !0
                }),
                n
            }
        }
        function Qa(e) {
            for (var t = {}, n = 0, a = e.length; n < a; n++)
                t[e[n].name] = e[n].value;
            return t
        }
        function Xa(e) {
            return "script" === e.tag || "style" === e.tag
        }
        function er(e) {
            return "style" === e.tag || "script" === e.tag && (!e.attrsMap.type || "text/javascript" === e.attrsMap.type)
        }
        function tr(e) {
            for (var t = [], n = 0; n < e.length; n++) {
                var a = e[n];
                md.test(a.name) || (a.name = a.name.replace(fd, ""),
                t.push(a))
            }
            return t
        }
        function nr(e, t) {
            e && (Ko = hd(t.staticKeys || ""),
            Zo = t.isReservedTag || qr,
            rr(e),
            ir(e, !1))
        }
        function ar(e) {
            return m("type,tag,attrsList,attrsMap,plain,parent,children,attrs" + (e ? "," + e : ""))
        }
        function rr(e) {
            if (e.static = sr(e),
            1 === e.type) {
                if (!Zo(e.tag) && "slot" !== e.tag && null == e.attrsMap["inline-template"])
                    return;
                for (var t = 0, n = e.children.length; t < n; t++) {
                    var a = e.children[t];
                    rr(a),
                    a.static || (e.static = !1)
                }
                if (e.ifConditions)
                    for (var r = 1, i = e.ifConditions.length; r < i; r++) {
                        var s = e.ifConditions[r].block;
                        rr(s),
                        s.static || (e.static = !1)
                    }
            }
        }
        function ir(e, t) {
            if (1 === e.type) {
                if ((e.static || e.once) && (e.staticInFor = t),
                e.static && e.children.length && (1 !== e.children.length || 3 !== e.children[0].type))
                    return void (e.staticRoot = !0);
                if (e.staticRoot = !1,
                e.children)
                    for (var n = 0, a = e.children.length; n < a; n++)
                        ir(e.children[n], t || !!e.for);
                if (e.ifConditions)
                    for (var r = 1, i = e.ifConditions.length; r < i; r++)
                        ir(e.ifConditions[r].block, t)
            }
        }
        function sr(e) {
            return 2 !== e.type && (3 === e.type || !(!e.pre && (e.hasBindings || e.if || e.for || zr(e.tag) || !Zo(e.tag) || or(e) || !Object.keys(e).every(Ko))))
        }
        function or(e) {
            for (; e.parent; ) {
                if (e = e.parent,
                "template" !== e.tag)
                    return !1;
                if (e.for)
                    return !0
            }
            return !1
        }
        function dr(e, t, n) {
            var a = t ? "nativeOn:{" : "on:{";
            for (var r in e) {
                a += '"' + r + '":' + ur(r, e[r]) + ","
            }
            return a.slice(0, -1) + "}"
        }
        function ur(e, t) {
            if (!t)
                return "function(){}";
            if (Array.isArray(t))
                return "[" + t.map(function(t) {
                    return ur(e, t)
                }).join(",") + "]";
            var n = Md.test(t.value)
              , a = pd.test(t.value);
            if (t.modifiers) {
                var r = ""
                  , i = ""
                  , s = [];
                for (var o in t.modifiers)
                    vd[o] ? (i += vd[o],
                    yd[o] && s.push(o)) : s.push(o);
                s.length && (r += _r(s)),
                i && (r += i);
                return "function($event){" + r + (n ? t.value + "($event)" : a ? "(" + t.value + ")($event)" : t.value) + "}"
            }
            return n || a ? t.value : "function($event){" + t.value + "}"
        }
        function _r(e) {
            return "if(!('button' in $event)&&" + e.map(lr).join("&&") + ")return null;"
        }
        function lr(e) {
            var t = parseInt(e, 10);
            if (t)
                return "$event.keyCode!==" + t;
            var n = yd[e];
            return "_k($event.keyCode," + JSON.stringify(e) + (n ? "," + JSON.stringify(n) : "") + ")"
        }
        function cr(e, t) {
            e.wrapListeners = function(e) {
                return "_g(" + e + "," + t.value + ")"
            }
        }
        function mr(e, t) {
            e.wrapData = function(n) {
                return "_b(" + n + ",'" + e.tag + "'," + t.value + "," + (t.modifiers && t.modifiers.prop ? "true" : "false") + (t.modifiers && t.modifiers.sync ? ",true" : "") + ")"
            }
        }
        function fr(e, t) {
            var n = new gd(t);
            return {
                render: "with(this){return " + (e ? hr(e, n) : '_c("div")') + "}",
                staticRenderFns: n.staticRenderFns
            }
        }
        function hr(e, t) {
            if (e.staticRoot && !e.staticProcessed)
                return pr(e, t);
            if (e.once && !e.onceProcessed)
                return Mr(e, t);
            if (e.for && !e.forProcessed)
                return vr(e, t);
            if (e.if && !e.ifProcessed)
                return yr(e, t);
            if ("template" !== e.tag || e.slotTarget) {
                if ("slot" === e.tag)
                    return Pr(e, t);
                var n;
                if (e.component)
                    n = Ar(e.component, e, t);
                else {
                    var a = e.plain ? void 0 : Yr(e, t)
                      , r = e.inlineTemplate ? null : br(e, t, !0);
                    n = "_c('" + e.tag + "'" + (a ? "," + a : "") + (r ? "," + r : "") + ")"
                }
                for (var i = 0; i < t.transforms.length; i++)
                    n = t.transforms[i](e, n);
                return n
            }
            return br(e, t) || "void 0"
        }
        function pr(e, t) {
            return e.staticProcessed = !0,
            t.staticRenderFns.push("with(this){return " + hr(e, t) + "}"),
            "_m(" + (t.staticRenderFns.length - 1) + (e.staticInFor ? ",true" : "") + ")"
        }
        function Mr(e, t) {
            if (e.onceProcessed = !0,
            e.if && !e.ifProcessed)
                return yr(e, t);
            if (e.staticInFor) {
                for (var n = "", a = e.parent; a; ) {
                    if (a.for) {
                        n = a.key;
                        break
                    }
                    a = a.parent
                }
                return n ? "_o(" + hr(e, t) + "," + t.onceId++ + "," + n + ")" : hr(e, t)
            }
            return pr(e, t)
        }
        function yr(e, t, n, a) {
            return e.ifProcessed = !0,
            Lr(e.ifConditions.slice(), t, n, a)
        }
        function Lr(e, t, n, a) {
            function r(e) {
                return n ? n(e, t) : e.once ? Mr(e, t) : hr(e, t)
            }
            if (!e.length)
                return a || "_e()";
            var i = e.shift();
            return i.exp ? "(" + i.exp + ")?" + r(i.block) + ":" + Lr(e, t, n, a) : "" + r(i.block)
        }
        function vr(e, t, n, a) {
            var r = e.for
              , i = e.alias
              , s = e.iterator1 ? "," + e.iterator1 : ""
              , o = e.iterator2 ? "," + e.iterator2 : "";
            return e.forProcessed = !0,
            (a || "_l") + "((" + r + "),function(" + i + s + o + "){return " + (n || hr)(e, t) + "})"
        }
        function Yr(e, t) {
            var n = "{"
              , a = gr(e, t);
            a && (n += a + ","),
            e.key && (n += "key:" + e.key + ","),
            e.ref && (n += "ref:" + e.ref + ","),
            e.refInFor && (n += "refInFor:true,"),
            e.pre && (n += "pre:true,"),
            e.component && (n += 'tag:"' + e.tag + '",');
            for (var r = 0; r < t.dataGenFns.length; r++)
                n += t.dataGenFns[r](e);
            if (e.attrs && (n += "attrs:{" + Er(e.attrs) + "},"),
            e.props && (n += "domProps:{" + Er(e.props) + "},"),
            e.events && (n += dr(e.events, !1, t.warn) + ","),
            e.nativeEvents && (n += dr(e.nativeEvents, !0, t.warn) + ","),
            e.slotTarget && (n += "slot:" + e.slotTarget + ","),
            e.scopedSlots && (n += Dr(e.scopedSlots, t) + ","),
            e.model && (n += "model:{value:" + e.model.value + ",callback:" + e.model.callback + ",expression:" + e.model.expression + "},"),
            e.inlineTemplate) {
                var i = kr(e, t);
                i && (n += i + ",")
            }
            return n = n.replace(/,$/, "") + "}",
            e.wrapData && (n = e.wrapData(n)),
            e.wrapListeners && (n = e.wrapListeners(n)),
            n
        }
        function gr(e, t) {
            var n = e.directives;
            if (n) {
                var a, r, i, s, o = "directives:[", d = !1;
                for (a = 0,
                r = n.length; a < r; a++) {
                    i = n[a],
                    s = !0;
                    var u = t.directives[i.name];
                    u && (s = !!u(e, i, t.warn)),
                    s && (d = !0,
                    o += '{name:"' + i.name + '",rawName:"' + i.rawName + '"' + (i.value ? ",value:(" + i.value + "),expression:" + JSON.stringify(i.value) : "") + (i.arg ? ',arg:"' + i.arg + '"' : "") + (i.modifiers ? ",modifiers:" + JSON.stringify(i.modifiers) : "") + "},")
                }
                return d ? o.slice(0, -1) + "]" : void 0
            }
        }
        function kr(e, t) {
            var n = e.children[0];
            if (1 === n.type) {
                var a = fr(n, t.options);
                return "inlineTemplate:{render:function(){" + a.render + "},staticRenderFns:[" + a.staticRenderFns.map(function(e) {
                    return "function(){" + e + "}"
                }).join(",") + "]}"
            }
        }
        function Dr(e, t) {
            return "scopedSlots:_u([" + Object.keys(e).map(function(n) {
                return wr(n, e[n], t)
            }).join(",") + "])"
        }
        function wr(e, t, n) {
            return t.for && !t.forProcessed ? Tr(e, t, n) : "{key:" + e + ",fn:function(" + String(t.attrsMap.scope) + "){return " + ("template" === t.tag ? br(t, n) || "void 0" : hr(t, n)) + "}}"
        }
        function Tr(e, t, n) {
            var a = t.for
              , r = t.alias
              , i = t.iterator1 ? "," + t.iterator1 : ""
              , s = t.iterator2 ? "," + t.iterator2 : "";
            return t.forProcessed = !0,
            "_l((" + a + "),function(" + r + i + s + "){return " + wr(e, t, n) + "})"
        }
        function br(e, t, n, a, r) {
            var i = e.children;
            if (i.length) {
                var s = i[0];
                if (1 === i.length && s.for && "template" !== s.tag && "slot" !== s.tag)
                    return (a || hr)(s, t);
                var o = n ? Sr(i, t.maybeComponent) : 0
                  , d = r || Hr;
                return "[" + i.map(function(e) {
                    return d(e, t)
                }).join(",") + "]" + (o ? "," + o : "")
            }
        }
        function Sr(e, t) {
            for (var n = 0, a = 0; a < e.length; a++) {
                var r = e[a];
                if (1 === r.type) {
                    if (jr(r) || r.ifConditions && r.ifConditions.some(function(e) {
                        return jr(e.block)
                    })) {
                        n = 2;
                        break
                    }
                    (t(r) || r.ifConditions && r.ifConditions.some(function(e) {
                        return t(e.block)
                    })) && (n = 1)
                }
            }
            return n
        }
        function jr(e) {
            return void 0 !== e.for || "template" === e.tag || "slot" === e.tag
        }
        function Hr(e, t) {
            return 1 === e.type ? hr(e, t) : 3 === e.type && e.isComment ? Or(e) : xr(e)
        }
        function xr(e) {
            return "_v(" + (2 === e.type ? e.expression : Cr(JSON.stringify(e.text))) + ")"
        }
        function Or(e) {
            return "_e(" + JSON.stringify(e.text) + ")"
        }
        function Pr(e, t) {
            var n = e.slotName || '"default"'
              , a = br(e, t)
              , r = "_t(" + n + (a ? "," + a : "")
              , i = e.attrs && "{" + e.attrs.map(function(e) {
                return Ur(e.name) + ":" + e.value
            }).join(",") + "}"
              , s = e.attrsMap["v-bind"];
            return !i && !s || a || (r += ",null"),
            i && (r += "," + i),
            s && (r += (i ? "" : ",null") + "," + s),
            r + ")"
        }
        function Ar(e, t, n) {
            var a = t.inlineTemplate ? null : br(t, n, !0);
            return "_c(" + e + "," + Yr(t, n) + (a ? "," + a : "") + ")"
        }
        function Er(e) {
            for (var t = "", n = 0; n < e.length; n++) {
                var a = e[n];
                t += '"' + a.name + '":' + Cr(a.value) + ","
            }
            return t.slice(0, -1)
        }
        function Cr(e) {
            return e.replace(/\u2028/g, "\\u2028").replace(/\u2029/g, "\\u2029")
        }
        function Wr(e, t) {
            try {
                return new Function(e)
            } catch (n) {
                return t.push({
                    err: n,
                    code: e
                }),
                Y
            }
        }
        function Fr(e) {
            var t = Object.create(null);
            return function(n, a, r) {
                a = a || {};
                var i = a.delimiters ? String(a.delimiters) + n : n;
                if (t[i])
                    return t[i];
                var s = e(n, a)
                  , o = {}
                  , d = [];
                return o.render = Wr(s.render, d),
                o.staticRenderFns = s.staticRenderFns.map(function(e) {
                    return Wr(e, d)
                }),
                t[i] = o
            }
        }
        function $r(e) {
            if (e.outerHTML)
                return e.outerHTML;
            var t = document.createElement("div");
            return t.appendChild(e.cloneNode(!0)),
            t.innerHTML
        }
        var Nr = Object.prototype.toString
          , zr = m("slot,component", !0)
          , Rr = m("key,ref,slot,is")
          , Ir = Object.prototype.hasOwnProperty
          , Jr = /-(\w)/g
          , Ur = p(function(e) {
            return e.replace(Jr, function(e, t) {
                return t ? t.toUpperCase() : ""
            })
        })
          , Gr = p(function(e) {
            return e.charAt(0).toUpperCase() + e.slice(1)
        })
          , Vr = /\B([A-Z])/g
          , Br = p(function(e) {
            return e.replace(Vr, "-$1").toLowerCase()
        })
          , qr = function(e, t, n) {
            return !1
        }
          , Kr = function(e) {
            return e
        }
          , Zr = "data-server-rendered"
          , Qr = ["component", "directive", "filter"]
          , Xr = ["beforeCreate", "created", "beforeMount", "mounted", "beforeUpdate", "updated", "beforeDestroy", "destroyed", "activated", "deactivated"]
          , ei = {
            optionMergeStrategies: Object.create(null),
            silent: !1,
            productionTip: !1,
            devtools: !1,
            performance: !1,
            errorHandler: null,
            warnHandler: null,
            ignoredElements: [],
            keyCodes: Object.create(null),
            isReservedTag: qr,
            isReservedAttr: qr,
            isUnknownElement: qr,
            getTagNamespace: Y,
            parsePlatformTagName: Kr,
            mustUseProp: qr,
            _lifecycleHooks: Xr
        }
          , ti = Object.freeze({})
          , ni = /[^\w.$]/
          , ai = Y
          , ri = "__proto__"in {}
          , ii = "undefined" != typeof window
          , si = ii && window.navigator.userAgent.toLowerCase()
          , oi = si && /msie|trident/.test(si)
          , di = si && si.indexOf("msie 9.0") > 0
          , ui = si && si.indexOf("edge/") > 0
          , _i = si && si.indexOf("android") > 0
          , li = si && /iphone|ipad|ipod|ios/.test(si)
          , ci = si && /chrome\/\d+/.test(si) && !ui
          , mi = {}.watch
          , fi = !1;
        if (ii)
            try {
                var hi = {};
                Object.defineProperty(hi, "passive", {
                    get: function() {
                        fi = !0
                    }
                }),
                window.addEventListener("test-passive", null, hi)
            } catch (e) {}
        var pi, Mi, yi = function() {
            return void 0 === pi && (pi = !ii && void 0 !== t && "server" === t.process.env.VUE_ENV),
            pi
        }, Li = ii && window.__VUE_DEVTOOLS_GLOBAL_HOOK__, vi = "undefined" != typeof Symbol && j(Symbol) && "undefined" != typeof Reflect && j(Reflect.ownKeys), Yi = function() {
            function e() {
                a = !1;
                var e = n.slice(0);
                n.length = 0;
                for (var t = 0; t < e.length; t++)
                    e[t]()
            }
            var t, n = [], a = !1;
            if ("undefined" != typeof Promise && j(Promise)) {
                var r = Promise.resolve()
                  , i = function(e) {};
                t = function() {
                    r.then(e).catch(i),
                    li && setTimeout(Y)
                }
            } else if (oi || "undefined" == typeof MutationObserver || !j(MutationObserver) && "[object MutationObserverConstructor]" !== MutationObserver.toString())
                t = function() {
                    setTimeout(e, 0)
                }
                ;
            else {
                var s = 1
                  , o = new MutationObserver(e)
                  , d = document.createTextNode(String(s));
                o.observe(d, {
                    characterData: !0
                }),
                t = function() {
                    s = (s + 1) % 2,
                    d.data = String(s)
                }
            }
            return function(e, r) {
                var i;
                if (n.push(function() {
                    if (e)
                        try {
                            e.call(r)
                        } catch (e) {
                            S(e, r, "nextTick")
                        }
                    else
                        i && i(r)
                }),
                a || (a = !0,
                t()),
                !e && "undefined" != typeof Promise)
                    return new Promise(function(e, t) {
                        i = e
                    }
                    )
            }
        }();
        Mi = "undefined" != typeof Set && j(Set) ? Set : function() {
            function e() {
                this.set = Object.create(null)
            }
            return e.prototype.has = function(e) {
                return !0 === this.set[e]
            }
            ,
            e.prototype.add = function(e) {
                this.set[e] = !0
            }
            ,
            e.prototype.clear = function() {
                this.set = Object.create(null)
            }
            ,
            e
        }();
        var gi = 0
          , ki = function() {
            this.id = gi++,
            this.subs = []
        };
        ki.prototype.addSub = function(e) {
            this.subs.push(e)
        }
        ,
        ki.prototype.removeSub = function(e) {
            f(this.subs, e)
        }
        ,
        ki.prototype.depend = function() {
            ki.target && ki.target.addDep(this)
        }
        ,
        ki.prototype.notify = function() {
            for (var e = this.subs.slice(), t = 0, n = e.length; t < n; t++)
                e[t].update()
        }
        ,
        ki.target = null;
        var Di = []
          , wi = Array.prototype
          , Ti = Object.create(wi);
        ["push", "pop", "shift", "unshift", "splice", "sort", "reverse"].forEach(function(e) {
            var t = wi[e];
            T(Ti, e, function() {
                for (var n = [], a = arguments.length; a--; )
                    n[a] = arguments[a];
                var r, i = t.apply(this, n), s = this.__ob__;
                switch (e) {
                case "push":
                case "unshift":
                    r = n;
                    break;
                case "splice":
                    r = n.slice(2)
                }
                return r && s.observeArray(r),
                s.dep.notify(),
                i
            })
        });
        var bi = Object.getOwnPropertyNames(Ti)
          , Si = {
            shouldConvert: !0
        }
          , ji = function(e) {
            if (this.value = e,
            this.dep = new ki,
            this.vmCount = 0,
            T(e, "__ob__", this),
            Array.isArray(e)) {
                (ri ? O : P)(e, Ti, bi),
                this.observeArray(e)
            } else
                this.walk(e)
        };
        ji.prototype.walk = function(e) {
            for (var t = Object.keys(e), n = 0; n < t.length; n++)
                E(e, t[n], e[t[n]])
        }
        ,
        ji.prototype.observeArray = function(e) {
            for (var t = 0, n = e.length; t < n; t++)
                A(e[t])
        }
        ;
        var Hi = ei.optionMergeStrategies;
        Hi.data = function(e, t, n) {
            return n ? N(e, t, n) : t && "function" != typeof t ? e : N.call(this, e, t)
        }
        ,
        Xr.forEach(function(e) {
            Hi[e] = z
        }),
        Qr.forEach(function(e) {
            Hi[e + "s"] = R
        }),
        Hi.watch = function(e, t) {
            if (e === mi && (e = void 0),
            t === mi && (t = void 0),
            !t)
                return Object.create(e || null);
            if (!e)
                return t;
            var n = {};
            L(n, e);
            for (var a in t) {
                var r = n[a]
                  , i = t[a];
                r && !Array.isArray(r) && (r = [r]),
                n[a] = r ? r.concat(i) : Array.isArray(i) ? i : [i]
            }
            return n
        }
        ,
        Hi.props = Hi.methods = Hi.inject = Hi.computed = function(e, t) {
            if (!e)
                return t;
            var n = Object.create(null);
            return L(n, e),
            t && L(n, t),
            n
        }
        ,
        Hi.provide = N;
        var xi = function(e, t) {
            return void 0 === t ? e : t
        }
          , Oi = function(e, t, n, a, r, i, s, o) {
            this.tag = e,
            this.data = t,
            this.children = n,
            this.text = a,
            this.elm = r,
            this.ns = void 0,
            this.context = i,
            this.functionalContext = void 0,
            this.key = t && t.key,
            this.componentOptions = s,
            this.componentInstance = void 0,
            this.parent = void 0,
            this.raw = !1,
            this.isStatic = !1,
            this.isRootInsert = !0,
            this.isComment = !1,
            this.isCloned = !1,
            this.isOnce = !1,
            this.asyncFactory = o,
            this.asyncMeta = void 0,
            this.isAsyncPlaceholder = !1
        }
          , Pi = {
            child: {}
        };
        Pi.child.get = function() {
            return this.componentInstance
        }
        ,
        Object.defineProperties(Oi.prototype, Pi);
        var Ai, Ei = function(e) {
            void 0 === e && (e = "");
            var t = new Oi;
            return t.text = e,
            t.isComment = !0,
            t
        }, Ci = p(function(e) {
            var t = "&" === e.charAt(0);
            e = t ? e.slice(1) : e;
            var n = "~" === e.charAt(0);
            e = n ? e.slice(1) : e;
            var a = "!" === e.charAt(0);
            return e = a ? e.slice(1) : e,
            {
                name: e,
                plain: !(t || n || a),
                once: n,
                capture: a,
                passive: t
            }
        }), Wi = null, Fi = [], $i = [], Ni = {}, zi = !1, Ri = !1, Ii = 0, Ji = 0, Ui = function(e, t, n, a) {
            this.vm = e,
            e._watchers.push(this),
            a ? (this.deep = !!a.deep,
            this.user = !!a.user,
            this.lazy = !!a.lazy,
            this.sync = !!a.sync) : this.deep = this.user = this.lazy = this.sync = !1,
            this.cb = n,
            this.id = ++Ji,
            this.active = !0,
            this.dirty = this.lazy,
            this.deps = [],
            this.newDeps = [],
            this.depIds = new Mi,
            this.newDepIds = new Mi,
            this.expression = "",
            "function" == typeof t ? this.getter = t : (this.getter = b(t),
            this.getter || (this.getter = function() {}
            )),
            this.value = this.lazy ? void 0 : this.get()
        };
        Ui.prototype.get = function() {
            H(this);
            var e, t = this.vm;
            try {
                e = this.getter.call(t, t)
            } catch (e) {
                if (!this.user)
                    throw e;
                S(e, t, 'getter for watcher "' + this.expression + '"')
            } finally {
                this.deep && Ce(e),
                x(),
                this.cleanupDeps()
            }
            return e
        }
        ,
        Ui.prototype.addDep = function(e) {
            var t = e.id;
            this.newDepIds.has(t) || (this.newDepIds.add(t),
            this.newDeps.push(e),
            this.depIds.has(t) || e.addSub(this))
        }
        ,
        Ui.prototype.cleanupDeps = function() {
            for (var e = this, t = this.deps.length; t--; ) {
                var n = e.deps[t];
                e.newDepIds.has(n.id) || n.removeSub(e)
            }
            var a = this.depIds;
            this.depIds = this.newDepIds,
            this.newDepIds = a,
            this.newDepIds.clear(),
            a = this.deps,
            this.deps = this.newDeps,
            this.newDeps = a,
            this.newDeps.length = 0
        }
        ,
        Ui.prototype.update = function() {
            this.lazy ? this.dirty = !0 : this.sync ? this.run() : Ee(this)
        }
        ,
        Ui.prototype.run = function() {
            if (this.active) {
                var e = this.get();
                if (e !== this.value || o(e) || this.deep) {
                    var t = this.value;
                    if (this.value = e,
                    this.user)
                        try {
                            this.cb.call(this.vm, e, t)
                        } catch (e) {
                            S(e, this.vm, 'callback for watcher "' + this.expression + '"')
                        }
                    else
                        this.cb.call(this.vm, e, t)
                }
            }
        }
        ,
        Ui.prototype.evaluate = function() {
            this.value = this.get(),
            this.dirty = !1
        }
        ,
        Ui.prototype.depend = function() {
            for (var e = this, t = this.deps.length; t--; )
                e.deps[t].depend()
        }
        ,
        Ui.prototype.teardown = function() {
            var e = this;
            if (this.active) {
                this.vm._isBeingDestroyed || f(this.vm._watchers, this);
                for (var t = this.deps.length; t--; )
                    e.deps[t].removeSub(e);
                this.active = !1
            }
        }
        ;
        var Gi = new Mi
          , Vi = {
            enumerable: !0,
            configurable: !0,
            get: Y,
            set: Y
        }
          , Bi = {
            lazy: !0
        }
          , qi = {
            init: function(e, t, n, a) {
                if (!e.componentInstance || e.componentInstance._isDestroyed) {
                    (e.componentInstance = tt(e, Wi, n, a)).$mount(t ? e.elm : void 0, t)
                } else if (e.data.keepAlive) {
                    var r = e;
                    qi.prepatch(r, r)
                }
            },
            prepatch: function(e, t) {
                var n = t.componentOptions;
                we(t.componentInstance = e.componentInstance, n.propsData, n.listeners, t, n.children)
            },
            insert: function(e) {
                var t = e.context
                  , n = e.componentInstance;
                n._isMounted || (n._isMounted = !0,
                je(n, "mounted")),
                e.data.keepAlive && (t._isMounted ? Pe(n) : be(n, !0))
            },
            destroy: function(e) {
                var t = e.componentInstance;
                t._isDestroyed || (e.data.keepAlive ? Se(t, !0) : t.$destroy())
            }
        }
          , Ki = Object.keys(qi)
          , Zi = 1
          , Qi = 2
          , Xi = 0;
        !function(e) {
            e.prototype._init = function(e) {
                var t = this;
                t._uid = Xi++,
                t._isVue = !0,
                e && e._isComponent ? Lt(t, e) : t.$options = G(vt(t.constructor), e || {}, t),
                t._renderProxy = t,
                t._self = t,
                ke(t),
                pe(t),
                yt(t),
                je(t, "beforeCreate"),
                Ke(t),
                $e(t),
                qe(t),
                je(t, "created"),
                t.$options.el && t.$mount(t.$options.el)
            }
        }(kt),
        function(e) {
            var t = {};
            t.get = function() {
                return this._data
            }
            ;
            var n = {};
            n.get = function() {
                return this._props
            }
            ,
            Object.defineProperty(e.prototype, "$data", t),
            Object.defineProperty(e.prototype, "$props", n),
            e.prototype.$set = C,
            e.prototype.$delete = W,
            e.prototype.$watch = function(e, t, n) {
                var a = this;
                if (d(t))
                    return Be(a, e, t, n);
                n = n || {},
                n.user = !0;
                var r = new Ui(a,e,t,n);
                return n.immediate && t.call(a, r.value),
                function() {
                    r.teardown()
                }
            }
        }(kt),
        function(e) {
            var t = /^hook:/;
            e.prototype.$on = function(e, n) {
                var a = this
                  , r = this;
                if (Array.isArray(e))
                    for (var i = 0, s = e.length; i < s; i++)
                        a.$on(e[i], n);
                else
                    (r._events[e] || (r._events[e] = [])).push(n),
                    t.test(e) && (r._hasHookEvent = !0);
                return r
            }
            ,
            e.prototype.$once = function(e, t) {
                function n() {
                    a.$off(e, n),
                    t.apply(a, arguments)
                }
                var a = this;
                return n.fn = t,
                a.$on(e, n),
                a
            }
            ,
            e.prototype.$off = function(e, t) {
                var n = this
                  , a = this;
                if (!arguments.length)
                    return a._events = Object.create(null),
                    a;
                if (Array.isArray(e)) {
                    for (var r = 0, i = e.length; r < i; r++)
                        n.$off(e[r], t);
                    return a
                }
                var s = a._events[e];
                if (!s)
                    return a;
                if (1 === arguments.length)
                    return a._events[e] = null,
                    a;
                if (t)
                    for (var o, d = s.length; d--; )
                        if ((o = s[d]) === t || o.fn === t) {
                            s.splice(d, 1);
                            break
                        }
                return a
            }
            ,
            e.prototype.$emit = function(e) {
                var t = this
                  , n = t._events[e];
                if (n) {
                    n = n.length > 1 ? y(n) : n;
                    for (var a = y(arguments, 1), r = 0, i = n.length; r < i; r++)
                        try {
                            n[r].apply(t, a)
                        } catch (n) {
                            S(n, t, 'event handler for "' + e + '"')
                        }
                }
                return t
            }
        }(kt),
        function(e) {
            e.prototype._update = function(e, t) {
                var n = this;
                n._isMounted && je(n, "beforeUpdate");
                var a = n.$el
                  , r = n._vnode
                  , i = Wi;
                Wi = n,
                n._vnode = e,
                r ? n.$el = n.__patch__(r, e) : (n.$el = n.__patch__(n.$el, e, t, !1, n.$options._parentElm, n.$options._refElm),
                n.$options._parentElm = n.$options._refElm = null),
                Wi = i,
                a && (a.__vue__ = null),
                n.$el && (n.$el.__vue__ = n),
                n.$vnode && n.$parent && n.$vnode === n.$parent._vnode && (n.$parent.$el = n.$el)
            }
            ,
            e.prototype.$forceUpdate = function() {
                var e = this;
                e._watcher && e._watcher.update()
            }
            ,
            e.prototype.$destroy = function() {
                var e = this;
                if (!e._isBeingDestroyed) {
                    je(e, "beforeDestroy"),
                    e._isBeingDestroyed = !0;
                    var t = e.$parent;
                    !t || t._isBeingDestroyed || e.$options.abstract || f(t.$children, e),
                    e._watcher && e._watcher.teardown();
                    for (var n = e._watchers.length; n--; )
                        e._watchers[n].teardown();
                    e._data.__ob__ && e._data.__ob__.vmCount--,
                    e._isDestroyed = !0,
                    e.__patch__(e._vnode, null),
                    je(e, "destroyed"),
                    e.$off(),
                    e.$el && (e.$el.__vue__ = null)
                }
            }
        }(kt),
        function(e) {
            e.prototype.$nextTick = function(e) {
                return Yi(e, this)
            }
            ,
            e.prototype._render = function() {
                var e = this
                  , t = e.$options
                  , n = t.render
                  , a = t.staticRenderFns
                  , r = t._parentVnode;
                if (e._isMounted)
                    for (var i in e.$slots) {
                        var s = e.$slots[i];
                        s._rendered && (e.$slots[i] = ee(s, !0))
                    }
                e.$scopedSlots = r && r.data.scopedSlots || ti,
                a && !e._staticTrees && (e._staticTrees = []),
                e.$vnode = r;
                var o;
                try {
                    o = n.call(e._renderProxy, e.$createElement)
                } catch (t) {
                    S(t, e, "render function"),
                    o = e._vnode
                }
                return o instanceof Oi || (o = Ei()),
                o.parent = r,
                o
            }
            ,
            e.prototype._o = ft,
            e.prototype._n = c,
            e.prototype._s = l,
            e.prototype._l = dt,
            e.prototype._t = ut,
            e.prototype._q = g,
            e.prototype._i = k,
            e.prototype._m = mt,
            e.prototype._f = _t,
            e.prototype._k = lt,
            e.prototype._b = ct,
            e.prototype._v = Q,
            e.prototype._e = Ei,
            e.prototype._u = ge,
            e.prototype._g = Mt
        }(kt);
        var es = [String, RegExp, Array]
          , ts = {
            name: "keep-alive",
            abstract: !0,
            props: {
                include: es,
                exclude: es
            },
            created: function() {
                this.cache = Object.create(null)
            },
            destroyed: function() {
                var e = this;
                for (var t in e.cache)
                    Pt(e.cache[t])
            },
            watch: {
                include: function(e) {
                    Ot(this.cache, this._vnode, function(t) {
                        return xt(e, t)
                    })
                },
                exclude: function(e) {
                    Ot(this.cache, this._vnode, function(t) {
                        return !xt(e, t)
                    })
                }
            },
            render: function() {
                var e = he(this.$slots.default)
                  , t = e && e.componentOptions;
                if (t) {
                    var n = Ht(t);
                    if (n && (this.include && !xt(this.include, n) || this.exclude && xt(this.exclude, n)))
                        return e;
                    var a = null == e.key ? t.Ctor.cid + (t.tag ? "::" + t.tag : "") : e.key;
                    this.cache[a] ? e.componentInstance = this.cache[a].componentInstance : this.cache[a] = e,
                    e.data.keepAlive = !0
                }
                return e
            }
        }
          , ns = {
            KeepAlive: ts
        };
        !function(e) {
            var t = {};
            t.get = function() {
                return ei
            }
            ,
            Object.defineProperty(e, "config", t),
            e.util = {
                warn: ai,
                extend: L,
                mergeOptions: G,
                defineReactive: E
            },
            e.set = C,
            e.delete = W,
            e.nextTick = Yi,
            e.options = Object.create(null),
            Qr.forEach(function(t) {
                e.options[t + "s"] = Object.create(null)
            }),
            e.options._base = e,
            L(e.options.components, ns),
            Dt(e),
            wt(e),
            Tt(e),
            jt(e)
        }(kt),
        Object.defineProperty(kt.prototype, "$isServer", {
            get: yi
        }),
        Object.defineProperty(kt.prototype, "$ssrContext", {
            get: function() {
                return this.$vnode && this.$vnode.ssrContext
            }
        }),
        kt.version = "2.4.4";
        var as, rs, is, ss, os, ds, us, _s, ls, cs = m("style,class"), ms = m("input,textarea,option,select,progress"), fs = function(e, t, n) {
            return "value" === n && ms(e) && "button" !== t || "selected" === n && "option" === e || "checked" === n && "input" === e || "muted" === n && "video" === e
        }, hs = m("contenteditable,draggable,spellcheck"), ps = m("allowfullscreen,async,autofocus,autoplay,checked,compact,controls,declare,default,defaultchecked,defaultmuted,defaultselected,defer,disabled,enabled,formnovalidate,hidden,indeterminate,inert,ismap,itemscope,loop,multiple,muted,nohref,noresize,noshade,novalidate,nowrap,open,pauseonexit,readonly,required,reversed,scoped,seamless,selected,sortable,translate,truespeed,typemustmatch,visible"), Ms = "http://www.w3.org/1999/xlink", ys = function(e) {
            return ":" === e.charAt(5) && "xlink" === e.slice(0, 5)
        }, Ls = function(e) {
            return ys(e) ? e.slice(6, e.length) : ""
        }, vs = function(e) {
            return null == e || !1 === e
        }, Ys = {
            svg: "http://www.w3.org/2000/svg",
            math: "http://www.w3.org/1998/Math/MathML"
        }, gs = m("html,body,base,head,link,meta,style,title,address,article,aside,footer,header,h1,h2,h3,h4,h5,h6,hgroup,nav,section,div,dd,dl,dt,figcaption,figure,picture,hr,img,li,main,ol,p,pre,ul,a,b,abbr,bdi,bdo,br,cite,code,data,dfn,em,i,kbd,mark,q,rp,rt,rtc,ruby,s,samp,small,span,strong,sub,sup,time,u,var,wbr,area,audio,map,track,video,embed,object,param,source,canvas,script,noscript,del,ins,caption,col,colgroup,table,thead,tbody,td,th,tr,button,datalist,fieldset,form,input,label,legend,meter,optgroup,option,output,progress,select,textarea,details,dialog,menu,menuitem,summary,content,element,shadow,template,blockquote,iframe,tfoot"), ks = m("svg,animate,circle,clippath,cursor,defs,desc,ellipse,filter,font-face,foreignObject,g,glyph,image,line,marker,mask,missing-glyph,path,pattern,polygon,polyline,rect,switch,symbol,text,textpath,tspan,use,view", !0), Ds = function(e) {
            return "pre" === e
        }, ws = function(e) {
            return gs(e) || ks(e)
        }, Ts = Object.create(null), bs = m("text,number,password,search,email,tel,url"), Ss = Object.freeze({
            createElement: Jt,
            createElementNS: Ut,
            createTextNode: Gt,
            createComment: Vt,
            insertBefore: Bt,
            removeChild: qt,
            appendChild: Kt,
            parentNode: Zt,
            nextSibling: Qt,
            tagName: Xt,
            setTextContent: en,
            setAttribute: tn
        }), js = {
            create: function(e, t) {
                nn(t)
            },
            update: function(e, t) {
                e.data.ref !== t.data.ref && (nn(e, !0),
                nn(t))
            },
            destroy: function(e) {
                nn(e, !0)
            }
        }, Hs = new Oi("",{},[]), xs = ["create", "activate", "update", "remove", "destroy"], Os = {
            create: on,
            update: on,
            destroy: function(e) {
                on(e, Hs)
            }
        }, Ps = Object.create(null), As = [js, Os], Es = {
            create: cn,
            update: cn
        }, Cs = {
            create: fn,
            update: fn
        }, Ws = /[\w).+\-_$\]]/, Fs = "__r", $s = "__c", Ns = {
            create: zn,
            update: zn
        }, zs = {
            create: Rn,
            update: Rn
        }, Rs = p(function(e) {
            var t = {}
              , n = /;(?![^(]*\))/g
              , a = /:(.+)/;
            return e.split(n).forEach(function(e) {
                if (e) {
                    var n = e.split(a);
                    n.length > 1 && (t[n[0].trim()] = n[1].trim())
                }
            }),
            t
        }), Is = /^--/, Js = /\s*!important$/, Us = function(e, t, n) {
            if (Is.test(t))
                e.style.setProperty(t, n);
            else if (Js.test(n))
                e.style.setProperty(t, n.replace(Js, ""), "important");
            else {
                var a = Vs(t);
                if (Array.isArray(n))
                    for (var r = 0, i = n.length; r < i; r++)
                        e.style[a] = n[r];
                else
                    e.style[a] = n
            }
        }, Gs = ["Webkit", "Moz", "ms"], Vs = p(function(e) {
            if (ls = ls || document.createElement("div").style,
            "filter" !== (e = Ur(e)) && e in ls)
                return e;
            for (var t = e.charAt(0).toUpperCase() + e.slice(1), n = 0; n < Gs.length; n++) {
                var a = Gs[n] + t;
                if (a in ls)
                    return a
            }
        }), Bs = {
            create: qn,
            update: qn
        }, qs = p(function(e) {
            return {
                enterClass: e + "-enter",
                enterToClass: e + "-enter-to",
                enterActiveClass: e + "-enter-active",
                leaveClass: e + "-leave",
                leaveToClass: e + "-leave-to",
                leaveActiveClass: e + "-leave-active"
            }
        }), Ks = ii && !di, Zs = "transition", Qs = "animation", Xs = "transition", eo = "transitionend", to = "animation", no = "animationend";
        Ks && (void 0 === window.ontransitionend && void 0 !== window.onwebkittransitionend && (Xs = "WebkitTransition",
        eo = "webkitTransitionEnd"),
        void 0 === window.onanimationend && void 0 !== window.onwebkitanimationend && (to = "WebkitAnimation",
        no = "webkitAnimationEnd"));
        var ao = ii && window.requestAnimationFrame ? window.requestAnimationFrame.bind(window) : setTimeout
          , ro = /\b(transform|all)(,|$)/
          , io = ii ? {
            create: _a,
            activate: _a,
            remove: function(e, t) {
                !0 !== e.data.show ? oa(e, t) : t()
            }
        } : {}
          , so = [Es, Cs, Ns, zs, Bs, io]
          , oo = so.concat(As)
          , uo = function(e) {
            function t(e) {
                return new Oi(x.tagName(e).toLowerCase(),{},[],void 0,e)
            }
            function i(e, t) {
                function n() {
                    0 == --n.listeners && o(e)
                }
                return n.listeners = t,
                n
            }
            function o(e) {
                var t = x.parentNode(e);
                a(t) && x.removeChild(t, e)
            }
            function d(e, t, n, i, s) {
                if (e.isRootInsert = !s,
                !u(e, t, n, i)) {
                    var o = e.data
                      , d = e.children
                      , _ = e.tag;
                    a(_) ? (e.elm = e.ns ? x.createElementNS(e.ns, _) : x.createElement(_, e),
                    M(e),
                    f(e, d, t),
                    a(o) && p(e, t),
                    c(n, e.elm, i)) : r(e.isComment) ? (e.elm = x.createComment(e.text),
                    c(n, e.elm, i)) : (e.elm = x.createTextNode(e.text),
                    c(n, e.elm, i))
                }
            }
            function u(e, t, n, i) {
                var s = e.data;
                if (a(s)) {
                    var o = a(e.componentInstance) && s.keepAlive;
                    if (a(s = s.hook) && a(s = s.init) && s(e, !1, n, i),
                    a(e.componentInstance))
                        return _(e, t),
                        r(o) && l(e, t, n, i),
                        !0
                }
            }
            function _(e, t) {
                a(e.data.pendingInsert) && (t.push.apply(t, e.data.pendingInsert),
                e.data.pendingInsert = null),
                e.elm = e.componentInstance.$el,
                h(e) ? (p(e, t),
                M(e)) : (nn(e),
                t.push(e))
            }
            function l(e, t, n, r) {
                for (var i, s = e; s.componentInstance; )
                    if (s = s.componentInstance._vnode,
                    a(i = s.data) && a(i = i.transition)) {
                        for (i = 0; i < j.activate.length; ++i)
                            j.activate[i](Hs, s);
                        t.push(s);
                        break
                    }
                c(n, e.elm, r)
            }
            function c(e, t, n) {
                a(e) && (a(n) ? n.parentNode === e && x.insertBefore(e, t, n) : x.appendChild(e, t))
            }
            function f(e, t, n) {
                if (Array.isArray(t))
                    for (var a = 0; a < t.length; ++a)
                        d(t[a], n, e.elm, null, !0);
                else
                    s(e.text) && x.appendChild(e.elm, x.createTextNode(e.text))
            }
            function h(e) {
                for (; e.componentInstance; )
                    e = e.componentInstance._vnode;
                return a(e.tag)
            }
            function p(e, t) {
                for (var n = 0; n < j.create.length; ++n)
                    j.create[n](Hs, e);
                b = e.data.hook,
                a(b) && (a(b.create) && b.create(Hs, e),
                a(b.insert) && t.push(e))
            }
            function M(e) {
                for (var t, n = e; n; )
                    a(t = n.context) && a(t = t.$options._scopeId) && x.setAttribute(e.elm, t, ""),
                    n = n.parent;
                a(t = Wi) && t !== e.context && a(t = t.$options._scopeId) && x.setAttribute(e.elm, t, "")
            }
            function y(e, t, n, a, r, i) {
                for (; a <= r; ++a)
                    d(n[a], i, e, t)
            }
            function L(e) {
                var t, n, r = e.data;
                if (a(r))
                    for (a(t = r.hook) && a(t = t.destroy) && t(e),
                    t = 0; t < j.destroy.length; ++t)
                        j.destroy[t](e);
                if (a(t = e.children))
                    for (n = 0; n < e.children.length; ++n)
                        L(e.children[n])
            }
            function v(e, t, n, r) {
                for (; n <= r; ++n) {
                    var i = t[n];
                    a(i) && (a(i.tag) ? (Y(i),
                    L(i)) : o(i.elm))
                }
            }
            function Y(e, t) {
                if (a(t) || a(e.data)) {
                    var n, r = j.remove.length + 1;
                    for (a(t) ? t.listeners += r : t = i(e.elm, r),
                    a(n = e.componentInstance) && a(n = n._vnode) && a(n.data) && Y(n, t),
                    n = 0; n < j.remove.length; ++n)
                        j.remove[n](e, t);
                    a(n = e.data.hook) && a(n = n.remove) ? n(e, t) : t()
                } else
                    o(e.elm)
            }
            function g(e, t, r, i, s) {
                for (var o, u, _, l, c = 0, m = 0, f = t.length - 1, h = t[0], p = t[f], M = r.length - 1, L = r[0], Y = r[M], g = !s; c <= f && m <= M; )
                    n(h) ? h = t[++c] : n(p) ? p = t[--f] : an(h, L) ? (D(h, L, i),
                    h = t[++c],
                    L = r[++m]) : an(p, Y) ? (D(p, Y, i),
                    p = t[--f],
                    Y = r[--M]) : an(h, Y) ? (D(h, Y, i),
                    g && x.insertBefore(e, h.elm, x.nextSibling(p.elm)),
                    h = t[++c],
                    Y = r[--M]) : an(p, L) ? (D(p, L, i),
                    g && x.insertBefore(e, p.elm, h.elm),
                    p = t[--f],
                    L = r[++m]) : (n(o) && (o = sn(t, c, f)),
                    u = a(L.key) ? o[L.key] : k(L, t, c, f),
                    n(u) ? d(L, i, e, h.elm) : (_ = t[u],
                    an(_, L) ? (D(_, L, i),
                    t[u] = void 0,
                    g && x.insertBefore(e, _.elm, h.elm)) : d(L, i, e, h.elm)),
                    L = r[++m]);
                c > f ? (l = n(r[M + 1]) ? null : r[M + 1].elm,
                y(e, l, r, m, M, i)) : m > M && v(e, t, c, f)
            }
            function k(e, t, n, r) {
                for (var i = n; i < r; i++) {
                    var s = t[i];
                    if (a(s) && an(e, s))
                        return i
                }
            }
            function D(e, t, i, s) {
                if (e !== t) {
                    var o = t.elm = e.elm;
                    if (r(e.isAsyncPlaceholder))
                        return void (a(t.asyncFactory.resolved) ? T(e.elm, t, i) : t.isAsyncPlaceholder = !0);
                    if (r(t.isStatic) && r(e.isStatic) && t.key === e.key && (r(t.isCloned) || r(t.isOnce)))
                        return void (t.componentInstance = e.componentInstance);
                    var d, u = t.data;
                    a(u) && a(d = u.hook) && a(d = d.prepatch) && d(e, t);
                    var _ = e.children
                      , l = t.children;
                    if (a(u) && h(t)) {
                        for (d = 0; d < j.update.length; ++d)
                            j.update[d](e, t);
                        a(d = u.hook) && a(d = d.update) && d(e, t)
                    }
                    n(t.text) ? a(_) && a(l) ? _ !== l && g(o, _, l, i, s) : a(l) ? (a(e.text) && x.setTextContent(o, ""),
                    y(o, null, l, 0, l.length - 1, i)) : a(_) ? v(o, _, 0, _.length - 1) : a(e.text) && x.setTextContent(o, "") : e.text !== t.text && x.setTextContent(o, t.text),
                    a(u) && a(d = u.hook) && a(d = d.postpatch) && d(e, t)
                }
            }
            function w(e, t, n) {
                if (r(n) && a(e.parent))
                    e.parent.data.pendingInsert = t;
                else
                    for (var i = 0; i < t.length; ++i)
                        t[i].data.hook.insert(t[i])
            }
            function T(e, t, n) {
                if (r(t.isComment) && a(t.asyncFactory))
                    return t.elm = e,
                    t.isAsyncPlaceholder = !0,
                    !0;
                t.elm = e;
                var i = t.tag
                  , s = t.data
                  , o = t.children;
                if (a(s) && (a(b = s.hook) && a(b = b.init) && b(t, !0),
                a(b = t.componentInstance)))
                    return _(t, n),
                    !0;
                if (a(i)) {
                    if (a(o))
                        if (e.hasChildNodes())
                            if (a(b = s) && a(b = b.domProps) && a(b = b.innerHTML)) {
                                if (b !== e.innerHTML)
                                    return !1
                            } else {
                                for (var d = !0, u = e.firstChild, l = 0; l < o.length; l++) {
                                    if (!u || !T(u, o[l], n)) {
                                        d = !1;
                                        break
                                    }
                                    u = u.nextSibling
                                }
                                if (!d || u)
                                    return !1
                            }
                        else
                            f(t, o, n);
                    if (a(s))
                        for (var c in s)
                            if (!O(c)) {
                                p(t, n);
                                break
                            }
                } else
                    e.data !== t.text && (e.data = t.text);
                return !0
            }
            var b, S, j = {}, H = e.modules, x = e.nodeOps;
            for (b = 0; b < xs.length; ++b)
                for (j[xs[b]] = [],
                S = 0; S < H.length; ++S)
                    a(H[S][xs[b]]) && j[xs[b]].push(H[S][xs[b]]);
            var O = m("attrs,style,class,staticClass,staticStyle,key");
            return function(e, i, s, o, u, _) {
                if (n(i))
                    return void (a(e) && L(e));
                var l = !1
                  , c = [];
                if (n(e))
                    l = !0,
                    d(i, c, u, _);
                else {
                    var m = a(e.nodeType);
                    if (!m && an(e, i))
                        D(e, i, c, o);
                    else {
                        if (m) {
                            if (1 === e.nodeType && e.hasAttribute(Zr) && (e.removeAttribute(Zr),
                            s = !0),
                            r(s) && T(e, i, c))
                                return w(i, c, !0),
                                e;
                            e = t(e)
                        }
                        var f = e.elm
                          , p = x.parentNode(f);
                        if (d(i, c, f._leaveCb ? null : p, x.nextSibling(f)),
                        a(i.parent))
                            for (var M = i.parent, y = h(i); M; ) {
                                for (var Y = 0; Y < j.destroy.length; ++Y)
                                    j.destroy[Y](M);
                                if (M.elm = i.elm,
                                y) {
                                    for (var g = 0; g < j.create.length; ++g)
                                        j.create[g](Hs, M);
                                    var k = M.data.hook.insert;
                                    if (k.merged)
                                        for (var b = 1; b < k.fns.length; b++)
                                            k.fns[b]()
                                }
                                M = M.parent
                            }
                        a(p) ? v(p, [e], 0, 0) : a(e.tag) && L(e)
                    }
                }
                return w(i, c, l),
                i.elm
            }
        }({
            nodeOps: Ss,
            modules: oo
        });
        di && document.addEventListener("selectionchange", function() {
            var e = document.activeElement;
            e && e.vmodel && Ma(e, "input")
        });
        var _o = {
            inserted: function(e, t, n) {
                "select" === n.tag ? (la(e, t, n.context),
                e._vOptions = [].map.call(e.options, fa)) : ("textarea" === n.tag || bs(e.type)) && (e._vModifiers = t.modifiers,
                t.modifiers.lazy || (e.addEventListener("change", pa),
                _i || (e.addEventListener("compositionstart", ha),
                e.addEventListener("compositionend", pa)),
                di && (e.vmodel = !0)))
            },
            componentUpdated: function(e, t, n) {
                if ("select" === n.tag) {
                    la(e, t, n.context);
                    var a = e._vOptions
                      , r = e._vOptions = [].map.call(e.options, fa);
                    if (r.some(function(e, t) {
                        return !g(e, a[t])
                    })) {
                        (e.multiple ? t.value.some(function(e) {
                            return ma(e, r)
                        }) : t.value !== t.oldValue && ma(t.value, r)) && Ma(e, "change")
                    }
                }
            }
        }
          , lo = {
            bind: function(e, t, n) {
                var a = t.value;
                n = ya(n);
                var r = n.data && n.data.transition
                  , i = e.__vOriginalDisplay = "none" === e.style.display ? "" : e.style.display;
                a && r ? (n.data.show = !0,
                sa(n, function() {
                    e.style.display = i
                })) : e.style.display = a ? i : "none"
            },
            update: function(e, t, n) {
                var a = t.value;
                a !== t.oldValue && (n = ya(n),
                n.data && n.data.transition ? (n.data.show = !0,
                a ? sa(n, function() {
                    e.style.display = e.__vOriginalDisplay
                }) : oa(n, function() {
                    e.style.display = "none"
                })) : e.style.display = a ? e.__vOriginalDisplay : "none")
            },
            unbind: function(e, t, n, a, r) {
                r || (e.style.display = e.__vOriginalDisplay)
            }
        }
          , co = {
            model: _o,
            show: lo
        }
          , mo = {
            name: String,
            appear: Boolean,
            css: Boolean,
            mode: String,
            type: String,
            enterClass: String,
            leaveClass: String,
            enterToClass: String,
            leaveToClass: String,
            enterActiveClass: String,
            leaveActiveClass: String,
            appearClass: String,
            appearActiveClass: String,
            appearToClass: String,
            duration: [Number, String, Object]
        }
          , fo = {
            name: "transition",
            props: mo,
            abstract: !0,
            render: function(e) {
                var t = this
                  , n = this.$options._renderChildren;
                if (n && (n = n.filter(function(e) {
                    return e.tag || fe(e)
                }),
                n.length)) {
                    var a = this.mode
                      , r = n[0];
                    if (ga(this.$vnode))
                        return r;
                    var i = La(r);
                    if (!i)
                        return r;
                    if (this._leaving)
                        return Ya(e, r);
                    var o = "__transition-" + this._uid + "-";
                    i.key = null == i.key ? i.isComment ? o + "comment" : o + i.tag : s(i.key) ? 0 === String(i.key).indexOf(o) ? i.key : o + i.key : i.key;
                    var d = (i.data || (i.data = {})).transition = va(this)
                      , u = this._vnode
                      , _ = La(u);
                    if (i.data.directives && i.data.directives.some(function(e) {
                        return "show" === e.name
                    }) && (i.data.show = !0),
                    _ && _.data && !ka(i, _) && !fe(_)) {
                        var l = _ && (_.data.transition = L({}, d));
                        if ("out-in" === a)
                            return this._leaving = !0,
                            re(l, "afterLeave", function() {
                                t._leaving = !1,
                                t.$forceUpdate()
                            }),
                            Ya(e, r);
                        if ("in-out" === a) {
                            if (fe(i))
                                return u;
                            var c, m = function() {
                                c()
                            };
                            re(d, "afterEnter", m),
                            re(d, "enterCancelled", m),
                            re(l, "delayLeave", function(e) {
                                c = e
                            })
                        }
                    }
                    return r
                }
            }
        }
          , ho = L({
            tag: String,
            moveClass: String
        }, mo);
        delete ho.mode;
        var po = {
            props: ho,
            render: function(e) {
                for (var t = this.tag || this.$vnode.data.tag || "span", n = Object.create(null), a = this.prevChildren = this.children, r = this.$slots.default || [], i = this.children = [], s = va(this), o = 0; o < r.length; o++) {
                    var d = r[o];
                    if (d.tag)
                        if (null != d.key && 0 !== String(d.key).indexOf("__vlist"))
                            i.push(d),
                            n[d.key] = d,
                            (d.data || (d.data = {})).transition = s;
                        else
                            ;
                }
                if (a) {
                    for (var u = [], _ = [], l = 0; l < a.length; l++) {
                        var c = a[l];
                        c.data.transition = s,
                        c.data.pos = c.elm.getBoundingClientRect(),
                        n[c.key] ? u.push(c) : _.push(c)
                    }
                    this.kept = e(t, null, u),
                    this.removed = _
                }
                return e(t, null, i)
            },
            beforeUpdate: function() {
                this.__patch__(this._vnode, this.kept, !1, !0),
                this._vnode = this.kept
            },
            updated: function() {
                var e = this.prevChildren
                  , t = this.moveClass || (this.name || "v") + "-move";
                if (e.length && this.hasMove(e[0].elm, t)) {
                    e.forEach(Da),
                    e.forEach(wa),
                    e.forEach(Ta);
                    var n = document.body;
                    n.offsetHeight;
                    e.forEach(function(e) {
                        if (e.data.moved) {
                            var n = e.elm
                              , a = n.style;
                            ea(n, t),
                            a.transform = a.WebkitTransform = a.transitionDuration = "",
                            n.addEventListener(eo, n._moveCb = function e(a) {
                                a && !/transform$/.test(a.propertyName) || (n.removeEventListener(eo, e),
                                n._moveCb = null,
                                ta(n, t))
                            }
                            )
                        }
                    })
                }
            },
            methods: {
                hasMove: function(e, t) {
                    if (!Ks)
                        return !1;
                    if (this._hasMove)
                        return this._hasMove;
                    var n = e.cloneNode();
                    e._transitionClasses && e._transitionClasses.forEach(function(e) {
                        Zn(n, e)
                    }),
                    Kn(n, t),
                    n.style.display = "none",
                    this.$el.appendChild(n);
                    var a = aa(n);
                    return this.$el.removeChild(n),
                    this._hasMove = a.hasTransform
                }
            }
        }
          , Mo = {
            Transition: fo,
            TransitionGroup: po
        };
        kt.config.mustUseProp = fs,
        kt.config.isReservedTag = ws,
        kt.config.isReservedAttr = cs,
        kt.config.getTagNamespace = zt,
        kt.config.isUnknownElement = Rt,
        L(kt.options.directives, co),
        L(kt.options.components, Mo),
        kt.prototype.__patch__ = ii ? uo : Y,
        kt.prototype.$mount = function(e, t) {
            return e = e && ii ? It(e) : void 0,
            De(this, e, t)
        }
        ,
        setTimeout(function() {
            ei.devtools && Li && Li.emit("init", kt)
        }, 0);
        var yo, Lo = !!ii && function(e, t) {
            var n = document.createElement("div");
            return n.innerHTML = '<div a="' + e + '"/>',
            n.innerHTML.indexOf(t) > 0
        }("\n", "&#10;"), vo = /\{\{((?:.|\n)+?)\}\}/g, Yo = /[-.*+?^${}()|[\]\/\\]/g, go = p(function(e) {
            var t = e[0].replace(Yo, "\\$&")
              , n = e[1].replace(Yo, "\\$&");
            return new RegExp(t + "((?:.|\\n)+?)" + n,"g")
        }), ko = {
            staticKeys: ["staticClass"],
            transformNode: Sa,
            genData: ja
        }, Do = {
            staticKeys: ["staticStyle"],
            transformNode: Ha,
            genData: xa
        }, wo = [ko, Do], To = {
            model: Pn,
            text: Oa,
            html: Pa
        }, bo = m("area,base,br,col,embed,frame,hr,img,input,isindex,keygen,link,meta,param,source,track,wbr"), So = m("colgroup,dd,dt,li,options,p,td,tfoot,th,thead,tr,source"), jo = m("address,article,aside,base,blockquote,body,caption,col,colgroup,dd,details,dialog,div,dl,dt,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,head,header,hgroup,hr,html,legend,li,menuitem,meta,optgroup,option,param,rp,rt,source,style,summary,tbody,td,tfoot,th,thead,title,tr,track"), Ho = {
            expectHTML: !0,
            modules: wo,
            directives: To,
            isPreTag: Ds,
            isUnaryTag: bo,
            mustUseProp: fs,
            canBeLeftOpenTag: So,
            isReservedTag: ws,
            getTagNamespace: zt,
            staticKeys: function(e) {
                return e.reduce(function(e, t) {
                    return e.concat(t.staticKeys || [])
                }, []).join(",")
            }(wo)
        }, xo = {
            decode: function(e) {
                return yo = yo || document.createElement("div"),
                yo.innerHTML = e,
                yo.textContent
            }
        }, Oo = /^\s*([^\s"'<>\/=]+)(?:\s*(=)\s*(?:"([^"]*)"+|'([^']*)'+|([^\s"'=<>`]+)))?/, Po = "[a-zA-Z_][\\w\\-\\.]*", Ao = "((?:" + Po + "\\:)?" + Po + ")", Eo = new RegExp("^<" + Ao), Co = /^\s*(\/?)>/, Wo = new RegExp("^<\\/" + Ao + "[^>]*>"), Fo = /^<!DOCTYPE [^>]+>/i, $o = /^<!--/, No = /^<!\[/, zo = !1;
        "x".replace(/x(.)?/g, function(e, t) {
            zo = "" === t
        });
        var Ro, Io, Jo, Uo, Go, Vo, Bo, qo, Ko, Zo, Qo = m("script,style,textarea", !0), Xo = {}, ed = {
            "&lt;": "<",
            "&gt;": ">",
            "&quot;": '"',
            "&amp;": "&",
            "&#10;": "\n"
        }, td = /&(?:lt|gt|quot|amp);/g, nd = /&(?:lt|gt|quot|amp|#10);/g, ad = m("pre,textarea", !0), rd = function(e, t) {
            return e && ad(e) && "\n" === t[0]
        }, id = /^@|^v-on:/, sd = /^v-|^@|^:/, od = /(.*?)\s+(?:in|of)\s+(.*)/, dd = /\((\{[^}]*\}|[^,]*),([^,]*)(?:,([^,]*))?\)/, ud = /:(.*)$/, _d = /^:|^v-bind:/, ld = /\.[^.]+/g, cd = p(xo.decode), md = /^xmlns:NS\d+/, fd = /^NS\d+:/, hd = p(ar), pd = /^\s*([\w$_]+|\([^)]*?\))\s*=>|^function\s*\(/, Md = /^\s*[A-Za-z_$][\w$]*(?:\.[A-Za-z_$][\w$]*|\['.*?']|\[".*?"]|\[\d+]|\[[A-Za-z_$][\w$]*])*\s*$/, yd = {
            esc: 27,
            tab: 9,
            enter: 13,
            space: 32,
            up: 38,
            left: 37,
            right: 39,
            down: 40,
            delete: [8, 46]
        }, Ld = function(e) {
            return "if(" + e + ")return null;"
        }, vd = {
            stop: "$event.stopPropagation();",
            prevent: "$event.preventDefault();",
            self: Ld("$event.target !== $event.currentTarget"),
            ctrl: Ld("!$event.ctrlKey"),
            shift: Ld("!$event.shiftKey"),
            alt: Ld("!$event.altKey"),
            meta: Ld("!$event.metaKey"),
            left: Ld("'button' in $event && $event.button !== 0"),
            middle: Ld("'button' in $event && $event.button !== 1"),
            right: Ld("'button' in $event && $event.button !== 2")
        }, Yd = {
            on: cr,
            bind: mr,
            cloak: Y
        }, gd = function(e) {
            this.options = e,
            this.warn = e.warn || Mn,
            this.transforms = yn(e.modules, "transformCode"),
            this.dataGenFns = yn(e.modules, "genData"),
            this.directives = L(L({}, Yd), e.directives);
            var t = e.isReservedTag || qr;
            this.maybeComponent = function(e) {
                return !t(e.tag)
            }
            ,
            this.onceId = 0,
            this.staticRenderFns = []
        }, kd = (new RegExp("\\b" + "do,if,for,let,new,try,var,case,else,with,await,break,catch,class,const,super,throw,while,yield,delete,export,import,return,switch,default,extends,finally,continue,debugger,function,arguments".split(",").join("\\b|\\b") + "\\b"),
        new RegExp("\\b" + "delete,typeof,void".split(",").join("\\s*\\([^\\)]*\\)|\\b") + "\\s*\\([^\\)]*\\)"),
        function(e) {
            return function(t) {
                function n(n, a) {
                    var r = Object.create(t)
                      , i = []
                      , s = [];
                    if (r.warn = function(e, t) {
                        (t ? s : i).push(e)
                    }
                    ,
                    a) {
                        a.modules && (r.modules = (t.modules || []).concat(a.modules)),
                        a.directives && (r.directives = L(Object.create(t.directives), a.directives));
                        for (var o in a)
                            "modules" !== o && "directives" !== o && (r[o] = a[o])
                    }
                    var d = e(n, r);
                    return d.errors = i,
                    d.tips = s,
                    d
                }
                return {
                    compile: n,
                    compileToFunctions: Fr(n)
                }
            }
        }(function(e, t) {
            var n = Ca(e.trim(), t);
            nr(n, t);
            var a = fr(n, t);
            return {
                ast: n,
                render: a.render,
                staticRenderFns: a.staticRenderFns
            }
        })), Dd = kd(Ho), wd = Dd.compileToFunctions, Td = p(function(e) {
            var t = It(e);
            return t && t.innerHTML
        }), bd = kt.prototype.$mount;
        kt.prototype.$mount = function(e, t) {
            if ((e = e && It(e)) === document.body || e === document.documentElement)
                return this;
            var n = this.$options;
            if (!n.render) {
                var a = n.template;
                if (a)
                    if ("string" == typeof a)
                        "#" === a.charAt(0) && (a = Td(a));
                    else {
                        if (!a.nodeType)
                            return this;
                        a = a.innerHTML
                    }
                else
                    e && (a = $r(e));
                if (a) {
                    var r = wd(a, {
                        shouldDecodeNewlines: Lo,
                        delimiters: n.delimiters,
                        comments: n.comments
                    }, this)
                      , i = r.render
                      , s = r.staticRenderFns;
                    n.render = i,
                    n.staticRenderFns = s
                }
            }
            return bd.call(this, e, t)
        }
        ,
        kt.compile = wd,
        e.exports = kt
    }
    ).call(t, n(128))
}
, function(e, t) {
    var n;
    n = function() {
        return this
    }();
    try {
        n = n || Function("return this")() || (0,
        eval)("this")
    } catch (e) {
        "object" == typeof window && (n = window)
    }
    e.exports = n
}
, function(e, t, n) {
    e.exports = n(130)
}
, function(e, t, n) {
    "use strict";
    function a(e) {
        var t = new s(e)
          , n = i(s.prototype.request, t);
        return r.extend(n, s.prototype, t),
        r.extend(n, t),
        n
    }
    var r = n(1)
      , i = n(3)
      , s = n(132)
      , o = n(2)
      , d = a(o);
    d.Axios = s,
    d.create = function(e) {
        return a(r.merge(o, e))
    }
    ,
    d.Cancel = n(7),
    d.CancelToken = n(147),
    d.isCancel = n(6),
    d.all = function(e) {
        return Promise.all(e)
    }
    ,
    d.spread = n(148),
    e.exports = d,
    e.exports.default = d
}
, function(e, t) {
    function n(e) {
        return !!e.constructor && "function" == typeof e.constructor.isBuffer && e.constructor.isBuffer(e)
    }
    function a(e) {
        return "function" == typeof e.readFloatLE && "function" == typeof e.slice && n(e.slice(0, 0))
    }
    e.exports = function(e) {
        return null != e && (n(e) || a(e) || !!e._isBuffer)
    }
}
, function(e, t, n) {
    "use strict";
    function a(e) {
        this.defaults = e,
        this.interceptors = {
            request: new s,
            response: new s
        }
    }
    var r = n(2)
      , i = n(1)
      , s = n(142)
      , o = n(143)
      , d = n(145)
      , u = n(146);
    a.prototype.request = function(e) {
        "string" == typeof e && (e = i.merge({
            url: arguments[0]
        }, arguments[1])),
        e = i.merge(r, this.defaults, {
            method: "get"
        }, e),
        e.method = e.method.toLowerCase(),
        e.baseURL && !d(e.url) && (e.url = u(e.baseURL, e.url));
        var t = [o, void 0]
          , n = Promise.resolve(e);
        for (this.interceptors.request.forEach(function(e) {
            t.unshift(e.fulfilled, e.rejected)
        }),
        this.interceptors.response.forEach(function(e) {
            t.push(e.fulfilled, e.rejected)
        }); t.length; )
            n = n.then(t.shift(), t.shift());
        return n
    }
    ,
    i.forEach(["delete", "get", "head", "options"], function(e) {
        a.prototype[e] = function(t, n) {
            return this.request(i.merge(n || {}, {
                method: e,
                url: t
            }))
        }
    }),
    i.forEach(["post", "put", "patch"], function(e) {
        a.prototype[e] = function(t, n, a) {
            return this.request(i.merge(a || {}, {
                method: e,
                url: t,
                data: n
            }))
        }
    }),
    e.exports = a
}
, function(e, t) {
    function n() {
        throw new Error("setTimeout has not been defined")
    }
    function a() {
        throw new Error("clearTimeout has not been defined")
    }
    function r(e) {
        if (_ === setTimeout)
            return setTimeout(e, 0);
        if ((_ === n || !_) && setTimeout)
            return _ = setTimeout,
            setTimeout(e, 0);
        try {
            return _(e, 0)
        } catch (t) {
            try {
                return _.call(null, e, 0)
            } catch (t) {
                return _.call(this, e, 0)
            }
        }
    }
    function i(e) {
        if (l === clearTimeout)
            return clearTimeout(e);
        if ((l === a || !l) && clearTimeout)
            return l = clearTimeout,
            clearTimeout(e);
        try {
            return l(e)
        } catch (t) {
            try {
                return l.call(null, e)
            } catch (t) {
                return l.call(this, e)
            }
        }
    }
    function s() {
        h && m && (h = !1,
        m.length ? f = m.concat(f) : p = -1,
        f.length && o())
    }
    function o() {
        if (!h) {
            var e = r(s);
            h = !0;
            for (var t = f.length; t; ) {
                for (m = f,
                f = []; ++p < t; )
                    m && m[p].run();
                p = -1,
                t = f.length
            }
            m = null,
            h = !1,
            i(e)
        }
    }
    function d(e, t) {
        this.fun = e,
        this.array = t
    }
    function u() {}
    var _, l, c = e.exports = {};
    !function() {
        try {
            _ = "function" == typeof setTimeout ? setTimeout : n
        } catch (e) {
            _ = n
        }
        try {
            l = "function" == typeof clearTimeout ? clearTimeout : a
        } catch (e) {
            l = a
        }
    }();
    var m, f = [], h = !1, p = -1;
    c.nextTick = function(e) {
        var t = new Array(arguments.length - 1);
        if (arguments.length > 1)
            for (var n = 1; n < arguments.length; n++)
                t[n - 1] = arguments[n];
        f.push(new d(e,t)),
        1 !== f.length || h || r(o)
    }
    ,
    d.prototype.run = function() {
        this.fun.apply(null, this.array)
    }
    ,
    c.title = "browser",
    c.browser = !0,
    c.env = {},
    c.argv = [],
    c.version = "",
    c.versions = {},
    c.on = u,
    c.addListener = u,
    c.once = u,
    c.off = u,
    c.removeListener = u,
    c.removeAllListeners = u,
    c.emit = u,
    c.prependListener = u,
    c.prependOnceListener = u,
    c.listeners = function(e) {
        return []
    }
    ,
    c.binding = function(e) {
        throw new Error("process.binding is not supported")
    }
    ,
    c.cwd = function() {
        return "/"
    }
    ,
    c.chdir = function(e) {
        throw new Error("process.chdir is not supported")
    }
    ,
    c.umask = function() {
        return 0
    }
}
, function(e, t, n) {
    "use strict";
    var a = n(1);
    e.exports = function(e, t) {
        a.forEach(e, function(n, a) {
            a !== t && a.toUpperCase() === t.toUpperCase() && (e[t] = n,
            delete e[a])
        })
    }
}
, function(e, t, n) {
    "use strict";
    var a = n(5);
    e.exports = function(e, t, n) {
        var r = n.config.validateStatus;
        n.status && r && !r(n.status) ? t(a("Request failed with status code " + n.status, n.config, null, n.request, n)) : e(n)
    }
}
, function(e, t, n) {
    "use strict";
    e.exports = function(e, t, n, a, r) {
        return e.config = t,
        n && (e.code = n),
        e.request = a,
        e.response = r,
        e
    }
}
, function(e, t, n) {
    "use strict";
    function a(e) {
        return encodeURIComponent(e).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]")
    }
    var r = n(1);
    e.exports = function(e, t, n) {
        if (!t)
            return e;
        var i;
        if (n)
            i = n(t);
        else if (r.isURLSearchParams(t))
            i = t.toString();
        else {
            var s = [];
            r.forEach(t, function(e, t) {
                null !== e && void 0 !== e && (r.isArray(e) && (t += "[]"),
                r.isArray(e) || (e = [e]),
                r.forEach(e, function(e) {
                    r.isDate(e) ? e = e.toISOString() : r.isObject(e) && (e = JSON.stringify(e)),
                    s.push(a(t) + "=" + a(e))
                }))
            }),
            i = s.join("&")
        }
        return i && (e += (-1 === e.indexOf("?") ? "?" : "&") + i),
        e
    }
}
, function(e, t, n) {
    "use strict";
    var a = n(1);
    e.exports = function(e) {
        var t, n, r, i = {};
        return e ? (a.forEach(e.split("\n"), function(e) {
            r = e.indexOf(":"),
            t = a.trim(e.substr(0, r)).toLowerCase(),
            n = a.trim(e.substr(r + 1)),
            t && (i[t] = i[t] ? i[t] + ", " + n : n)
        }),
        i) : i
    }
}
, function(e, t, n) {
    "use strict";
    var a = n(1);
    e.exports = a.isStandardBrowserEnv() ? function() {
        function e(e) {
            var t = e;
            return n && (r.setAttribute("href", t),
            t = r.href),
            r.setAttribute("href", t),
            {
                href: r.href,
                protocol: r.protocol ? r.protocol.replace(/:$/, "") : "",
                host: r.host,
                search: r.search ? r.search.replace(/^\?/, "") : "",
                hash: r.hash ? r.hash.replace(/^#/, "") : "",
                hostname: r.hostname,
                port: r.port,
                pathname: "/" === r.pathname.charAt(0) ? r.pathname : "/" + r.pathname
            }
        }
        var t, n = /(msie|trident)/i.test(navigator.userAgent), r = document.createElement("a");
        return t = e(window.location.href),
        function(n) {
            var r = a.isString(n) ? e(n) : n;
            return r.protocol === t.protocol && r.host === t.host
        }
    }() : function() {
        return function() {
            return !0
        }
    }()
}
, function(e, t, n) {
    "use strict";
    function a() {
        this.message = "String contains an invalid character"
    }
    function r(e) {
        for (var t, n, r = String(e), s = "", o = 0, d = i; r.charAt(0 | o) || (d = "=",
        o % 1); s += d.charAt(63 & t >> 8 - o % 1 * 8)) {
            if ((n = r.charCodeAt(o += .75)) > 255)
                throw new a;
            t = t << 8 | n
        }
        return s
    }
    var i = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    a.prototype = new Error,
    a.prototype.code = 5,
    a.prototype.name = "InvalidCharacterError",
    e.exports = r
}
, function(e, t, n) {
    "use strict";
    var a = n(1);
    e.exports = a.isStandardBrowserEnv() ? function() {
        return {
            write: function(e, t, n, r, i, s) {
                var o = [];
                o.push(e + "=" + encodeURIComponent(t)),
                a.isNumber(n) && o.push("expires=" + new Date(n).toGMTString()),
                a.isString(r) && o.push("path=" + r),
                a.isString(i) && o.push("domain=" + i),
                !0 === s && o.push("secure"),
                document.cookie = o.join("; ")
            },
            read: function(e) {
                var t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
                return t ? decodeURIComponent(t[3]) : null
            },
            remove: function(e) {
                this.write(e, "", Date.now() - 864e5)
            }
        }
    }() : function() {
        return {
            write: function() {},
            read: function() {
                return null
            },
            remove: function() {}
        }
    }()
}
, function(e, t, n) {
    "use strict";
    function a() {
        this.handlers = []
    }
    var r = n(1);
    a.prototype.use = function(e, t) {
        return this.handlers.push({
            fulfilled: e,
            rejected: t
        }),
        this.handlers.length - 1
    }
    ,
    a.prototype.eject = function(e) {
        this.handlers[e] && (this.handlers[e] = null)
    }
    ,
    a.prototype.forEach = function(e) {
        r.forEach(this.handlers, function(t) {
            null !== t && e(t)
        })
    }
    ,
    e.exports = a
}
, function(e, t, n) {
    "use strict";
    function a(e) {
        e.cancelToken && e.cancelToken.throwIfRequested()
    }
    var r = n(1)
      , i = n(144)
      , s = n(6)
      , o = n(2);
    e.exports = function(e) {
        return a(e),
        e.headers = e.headers || {},
        e.data = i(e.data, e.headers, e.transformRequest),
        e.headers = r.merge(e.headers.common || {}, e.headers[e.method] || {}, e.headers || {}),
        r.forEach(["delete", "get", "head", "post", "put", "patch", "common"], function(t) {
            delete e.headers[t]
        }),
        (e.adapter || o.adapter)(e).then(function(t) {
            return a(e),
            t.data = i(t.data, t.headers, e.transformResponse),
            t
        }, function(t) {
            return s(t) || (a(e),
            t && t.response && (t.response.data = i(t.response.data, t.response.headers, e.transformResponse))),
            Promise.reject(t)
        })
    }
}
, function(e, t, n) {
    "use strict";
    var a = n(1);
    e.exports = function(e, t, n) {
        return a.forEach(n, function(n) {
            e = n(e, t)
        }),
        e
    }
}
, function(e, t, n) {
    "use strict";
    e.exports = function(e) {
        return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e)
    }
}
, function(e, t, n) {
    "use strict";
    e.exports = function(e, t) {
        return t ? e.replace(/\/+$/, "") + "/" + t.replace(/^\/+/, "") : e
    }
}
, function(e, t, n) {
    "use strict";
    function a(e) {
        if ("function" != typeof e)
            throw new TypeError("executor must be a function.");
        var t;
        this.promise = new Promise(function(e) {
            t = e
        }
        );
        var n = this;
        e(function(e) {
            n.reason || (n.reason = new r(e),
            t(n.reason))
        })
    }
    var r = n(7);
    a.prototype.throwIfRequested = function() {
        if (this.reason)
            throw this.reason
    }
    ,
    a.source = function() {
        var e;
        return {
            token: new a(function(t) {
                e = t
            }
            ),
            cancel: e
        }
    }
    ,
    e.exports = a
}
, function(e, t, n) {
    "use strict";
    e.exports = function(e) {
        return function(t) {
            return e.apply(null, t)
        }
    }
}
, function(e, t, n) {
    "use strict";
    var a, r, i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
        return typeof e
    }
    : function(e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
    }
    ;
    !function() {
        function n(e, t) {
            if (!n.installed) {
                if (n.installed = !0,
                !t)
                    return;
                e.axios = t,
                Object.defineProperties(e.prototype, {
                    axios: {
                        get: function() {
                            return t
                        }
                    },
                    $http: {
                        get: function() {
                            return t
                        }
                    }
                })
            }
        }
        "object" == i(t) ? e.exports = n : (a = [],
        void 0 !== (r = function() {
            return n
        }
        .apply(t, a)) && (e.exports = r))
    }()
}
, function(e, t, n) {
    "use strict";
    t.decode = t.parse = n(151),
    t.encode = t.stringify = n(152)
}
, function(e, t, n) {
    "use strict";
    function a(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }
    e.exports = function(e, t, n, i) {
        t = t || "&",
        n = n || "=";
        var s = {};
        if ("string" != typeof e || 0 === e.length)
            return s;
        var o = /\+/g;
        e = e.split(t);
        var d = 1e3;
        i && "number" == typeof i.maxKeys && (d = i.maxKeys);
        var u = e.length;
        d > 0 && u > d && (u = d);
        for (var _ = 0; _ < u; ++_) {
            var l, c, m, f, h = e[_].replace(o, "%20"), p = h.indexOf(n);
            p >= 0 ? (l = h.substr(0, p),
            c = h.substr(p + 1)) : (l = h,
            c = ""),
            m = decodeURIComponent(l),
            f = decodeURIComponent(c),
            a(s, m) ? r(s[m]) ? s[m].push(f) : s[m] = [s[m], f] : s[m] = f
        }
        return s
    }
    ;
    var r = Array.isArray || function(e) {
        return "[object Array]" === Object.prototype.toString.call(e)
    }
}
, function(e, t, n) {
    "use strict";
    function a(e, t) {
        if (e.map)
            return e.map(t);
        for (var n = [], a = 0; a < e.length; a++)
            n.push(t(e[a], a));
        return n
    }
    var r = function(e) {
        switch (typeof e) {
        case "string":
            return e;
        case "boolean":
            return e ? "true" : "false";
        case "number":
            return isFinite(e) ? e : "";
        default:
            return ""
        }
    };
    e.exports = function(e, t, n, o) {
        return t = t || "&",
        n = n || "=",
        null === e && (e = void 0),
        "object" == typeof e ? a(s(e), function(s) {
            var o = encodeURIComponent(r(s)) + n;
            return i(e[s]) ? a(e[s], function(e) {
                return o + encodeURIComponent(r(e))
            }).join(t) : o + encodeURIComponent(r(e[s]))
        }).join(t) : o ? encodeURIComponent(r(o)) + n + encodeURIComponent(r(e)) : ""
    }
    ;
    var i = Array.isArray || function(e) {
        return "[object Array]" === Object.prototype.toString.call(e)
    }
      , s = Object.keys || function(e) {
        var t = [];
        for (var n in e)
            Object.prototype.hasOwnProperty.call(e, n) && t.push(n);
        return t
    }
}
, function(e, t) {
    e.exports = function(e) {
        return e.webpackPolyfill || (e.deprecate = function() {}
        ,
        e.paths = [],
        e.children || (e.children = []),
        Object.defineProperty(e, "loaded", {
            enumerable: !0,
            get: function() {
                return e.l
            }
        }),
        Object.defineProperty(e, "id", {
            enumerable: !0,
            get: function() {
                return e.i
            }
        }),
        e.webpackPolyfill = 1),
        e
    }
}
, function(e, t, n) {
    function a(e) {
        return n(r(e))
    }
    function r(e) {
        var t = i[e];
        if (!(t + 1))
            throw new Error("Cannot find module '" + e + "'.");
        return t
    }
    var i = {
        "./af": 8,
        "./af.js": 8,
        "./ar": 9,
        "./ar-dz": 10,
        "./ar-dz.js": 10,
        "./ar-kw": 11,
        "./ar-kw.js": 11,
        "./ar-ly": 12,
        "./ar-ly.js": 12,
        "./ar-ma": 13,
        "./ar-ma.js": 13,
        "./ar-sa": 14,
        "./ar-sa.js": 14,
        "./ar-tn": 15,
        "./ar-tn.js": 15,
        "./ar.js": 9,
        "./az": 16,
        "./az.js": 16,
        "./be": 17,
        "./be.js": 17,
        "./bg": 18,
        "./bg.js": 18,
        "./bn": 19,
        "./bn.js": 19,
        "./bo": 20,
        "./bo.js": 20,
        "./br": 21,
        "./br.js": 21,
        "./bs": 22,
        "./bs.js": 22,
        "./ca": 23,
        "./ca.js": 23,
        "./cs": 24,
        "./cs.js": 24,
        "./cv": 25,
        "./cv.js": 25,
        "./cy": 26,
        "./cy.js": 26,
        "./da": 27,
        "./da.js": 27,
        "./de": 28,
        "./de-at": 29,
        "./de-at.js": 29,
        "./de-ch": 30,
        "./de-ch.js": 30,
        "./de.js": 28,
        "./dv": 31,
        "./dv.js": 31,
        "./el": 32,
        "./el.js": 32,
        "./en-au": 33,
        "./en-au.js": 33,
        "./en-ca": 34,
        "./en-ca.js": 34,
        "./en-gb": 35,
        "./en-gb.js": 35,
        "./en-ie": 36,
        "./en-ie.js": 36,
        "./en-nz": 37,
        "./en-nz.js": 37,
        "./eo": 38,
        "./eo.js": 38,
        "./es": 39,
        "./es-do": 40,
        "./es-do.js": 40,
        "./es.js": 39,
        "./et": 41,
        "./et.js": 41,
        "./eu": 42,
        "./eu.js": 42,
        "./fa": 43,
        "./fa.js": 43,
        "./fi": 44,
        "./fi.js": 44,
        "./fo": 45,
        "./fo.js": 45,
        "./fr": 46,
        "./fr-ca": 47,
        "./fr-ca.js": 47,
        "./fr-ch": 48,
        "./fr-ch.js": 48,
        "./fr.js": 46,
        "./fy": 49,
        "./fy.js": 49,
        "./gd": 50,
        "./gd.js": 50,
        "./gl": 51,
        "./gl.js": 51,
        "./gom-latn": 52,
        "./gom-latn.js": 52,
        "./he": 53,
        "./he.js": 53,
        "./hi": 54,
        "./hi.js": 54,
        "./hr": 55,
        "./hr.js": 55,
        "./hu": 56,
        "./hu.js": 56,
        "./hy-am": 57,
        "./hy-am.js": 57,
        "./id": 58,
        "./id.js": 58,
        "./is": 59,
        "./is.js": 59,
        "./it": 60,
        "./it.js": 60,
        "./ja": 61,
        "./ja.js": 61,
        "./jv": 62,
        "./jv.js": 62,
        "./ka": 63,
        "./ka.js": 63,
        "./kk": 64,
        "./kk.js": 64,
        "./km": 65,
        "./km.js": 65,
        "./kn": 66,
        "./kn.js": 66,
        "./ko": 67,
        "./ko.js": 67,
        "./ky": 68,
        "./ky.js": 68,
        "./lb": 69,
        "./lb.js": 69,
        "./lo": 70,
        "./lo.js": 70,
        "./lt": 71,
        "./lt.js": 71,
        "./lv": 72,
        "./lv.js": 72,
        "./me": 73,
        "./me.js": 73,
        "./mi": 74,
        "./mi.js": 74,
        "./mk": 75,
        "./mk.js": 75,
        "./ml": 76,
        "./ml.js": 76,
        "./mr": 77,
        "./mr.js": 77,
        "./ms": 78,
        "./ms-my": 79,
        "./ms-my.js": 79,
        "./ms.js": 78,
        "./my": 80,
        "./my.js": 80,
        "./nb": 81,
        "./nb.js": 81,
        "./ne": 82,
        "./ne.js": 82,
        "./nl": 83,
        "./nl-be": 84,
        "./nl-be.js": 84,
        "./nl.js": 83,
        "./nn": 85,
        "./nn.js": 85,
        "./pa-in": 86,
        "./pa-in.js": 86,
        "./pl": 87,
        "./pl.js": 87,
        "./pt": 88,
        "./pt-br": 89,
        "./pt-br.js": 89,
        "./pt.js": 88,
        "./ro": 90,
        "./ro.js": 90,
        "./ru": 91,
        "./ru.js": 91,
        "./sd": 92,
        "./sd.js": 92,
        "./se": 93,
        "./se.js": 93,
        "./si": 94,
        "./si.js": 94,
        "./sk": 95,
        "./sk.js": 95,
        "./sl": 96,
        "./sl.js": 96,
        "./sq": 97,
        "./sq.js": 97,
        "./sr": 98,
        "./sr-cyrl": 99,
        "./sr-cyrl.js": 99,
        "./sr.js": 98,
        "./ss": 100,
        "./ss.js": 100,
        "./sv": 101,
        "./sv.js": 101,
        "./sw": 102,
        "./sw.js": 102,
        "./ta": 103,
        "./ta.js": 103,
        "./te": 104,
        "./te.js": 104,
        "./tet": 105,
        "./tet.js": 105,
        "./th": 106,
        "./th.js": 106,
        "./tl-ph": 107,
        "./tl-ph.js": 107,
        "./tlh": 108,
        "./tlh.js": 108,
        "./tr": 109,
        "./tr.js": 109,
        "./tzl": 110,
        "./tzl.js": 110,
        "./tzm": 111,
        "./tzm-latn": 112,
        "./tzm-latn.js": 112,
        "./tzm.js": 111,
        "./uk": 113,
        "./uk.js": 113,
        "./ur": 114,
        "./ur.js": 114,
        "./uz": 115,
        "./uz-latn": 116,
        "./uz-latn.js": 116,
        "./uz.js": 115,
        "./vi": 117,
        "./vi.js": 117,
        "./x-pseudo": 118,
        "./x-pseudo.js": 118,
        "./yo": 119,
        "./yo.js": 119,
        "./zh-cn": 120,
        "./zh-cn.js": 120,
        "./zh-hk": 121,
        "./zh-hk.js": 121,
        "./zh-tw": 122,
        "./zh-tw.js": 122
    };
    a.keys = function() {
        return Object.keys(i)
    }
    ,
    a.resolve = r,
    e.exports = a,
    a.id = 154
}
, function(e, t, n) {
    var a, a;
    !function(t) {
        e.exports = t()
    }(function() {
        return function e(t, n, r) {
            function i(o, d) {
                if (!n[o]) {
                    if (!t[o]) {
                        var u = "function" == typeof a && a;
                        if (!d && u)
                            return a(o, !0);
                        if (s)
                            return s(o, !0);
                        var _ = new Error("Cannot find module '" + o + "'");
                        throw _.code = "MODULE_NOT_FOUND",
                        _
                    }
                    var l = n[o] = {
                        exports: {}
                    };
                    t[o][0].call(l.exports, function(e) {
                        return i(t[o][1][e] || e)
                    }, l, l.exports, e, t, n, r)
                }
                return n[o].exports
            }
            for (var s = "function" == typeof a && a, o = 0; o < r.length; o++)
                i(r[o]);
            return i
        }({
            1: [function(e, t, n) {
                "use strict";
                Object.defineProperty(n, "__esModule", {
                    value: !0
                }),
                n.default = {
                    errors: {
                        incompatible: "PushError: Push.js is incompatible with browser.",
                        invalid_plugin: "PushError: plugin class missing from plugin manifest (invalid plugin). Please check the documentation.",
                        invalid_title: "PushError: title of notification must be a string",
                        permission_denied: "PushError: permission request declined",
                        sw_notification_error: "PushError: could not show a ServiceWorker notification due to the following reason: ",
                        sw_registration_error: "PushError: could not register the ServiceWorker due to the following reason: ",
                        unknown_interface: "PushError: unable to create notification: unknown interface"
                    }
                }
            }
            , {}],
            2: [function(e, t, n) {
                "use strict";
                function a(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var r = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , i = function() {
                    function e(t) {
                        a(this, e),
                        this._win = t,
                        this.GRANTED = "granted",
                        this.DEFAULT = "default",
                        this.DENIED = "denied",
                        this._permissions = [this.GRANTED, this.DEFAULT, this.DENIED]
                    }
                    return r(e, [{
                        key: "request",
                        value: function(e, t) {
                            return arguments.length > 0 ? this._requestWithCallback.apply(this, arguments) : this._requestAsPromise()
                        }
                    }, {
                        key: "_requestWithCallback",
                        value: function(e, t) {
                            var n = this
                              , a = this.get()
                              , r = function() {
                                var a = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : n._win.Notification.permission;
                                void 0 === a && n._win.webkitNotifications && (a = n._win.webkitNotifications.checkPermission()),
                                a === n.GRANTED || 0 === a ? e && e() : t && t()
                            };
                            a !== this.DEFAULT ? r(a) : this._win.webkitNotifications && this._win.webkitNotifications.checkPermission ? this._win.webkitNotifications.requestPermission(r) : this._win.Notification && this._win.Notification.requestPermission ? this._win.Notification.requestPermission().then(r).catch(function() {
                                t && t()
                            }) : e && e()
                        }
                    }, {
                        key: "_requestAsPromise",
                        value: function() {
                            var e = this
                              , t = this.get()
                              , n = function(t) {
                                return t === e.GRANTED || 0 === t
                            }
                              , a = t !== this.DEFAULT
                              , r = this._win.Notification && this._win.Notification.requestPermission
                              , i = this._win.webkitNotifications && this._win.webkitNotifications.checkPermission;
                            return new Promise(function(s, o) {
                                var d = function(e) {
                                    return n(e) ? s() : o()
                                };
                                a ? d(t) : i ? e._win.webkitNotifications.requestPermission(function(e) {
                                    d(e)
                                }) : r ? e._win.Notification.requestPermission().then(function(e) {
                                    d(e)
                                }).catch(o) : s()
                            }
                            )
                        }
                    }, {
                        key: "has",
                        value: function() {
                            return this.get() === this.GRANTED
                        }
                    }, {
                        key: "get",
                        value: function() {
                            return this._win.Notification && this._win.Notification.permission ? this._win.Notification.permission : this._win.webkitNotifications && this._win.webkitNotifications.checkPermission ? this._permissions[this._win.webkitNotifications.checkPermission()] : navigator.mozNotification ? this.GRANTED : this._win.external && this._win.external.msIsSiteMode ? this._win.external.msIsSiteMode() ? this.GRANTED : this.DEFAULT : this.GRANTED
                        }
                    }]),
                    e
                }();
                n.default = i
            }
            , {}],
            3: [function(e, t, n) {
                "use strict";
                function a(e) {
                    return e && e.__esModule ? e : {
                        default: e
                    }
                }
                function r(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var i = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , s = a(e("./Messages"))
                  , o = a(e("./Permission"))
                  , d = a(e("./Util"))
                  , u = a(e("./agents/DesktopAgent"))
                  , _ = a(e("./agents/MobileChromeAgent"))
                  , l = a(e("./agents/MobileFirefoxAgent"))
                  , c = a(e("./agents/MSAgent"))
                  , m = a(e("./agents/WebKitAgent"))
                  , f = function() {
                    function e(t) {
                        r(this, e),
                        this._currentId = 0,
                        this._notifications = {},
                        this._win = t,
                        this.Permission = new o.default(t),
                        this._agents = {
                            desktop: new u.default(t),
                            chrome: new _.default(t),
                            firefox: new l.default(t),
                            ms: new c.default(t),
                            webkit: new m.default(t)
                        },
                        this._configuration = {
                            serviceWorker: "/serviceWorker.min.js",
                            fallback: function(e) {}
                        }
                    }
                    return i(e, [{
                        key: "_closeNotification",
                        value: function(e) {
                            var t = !0
                              , n = this._notifications[e];
                            if (void 0 !== n) {
                                if (t = this._removeNotification(e),
                                this._agents.desktop.isSupported())
                                    this._agents.desktop.close(n);
                                else if (this._agents.webkit.isSupported())
                                    this._agents.webkit.close(n);
                                else {
                                    if (!this._agents.ms.isSupported())
                                        throw t = !1,
                                        new Error(s.default.errors.unknown_interface);
                                    this._agents.ms.close()
                                }
                                return t
                            }
                            return !1
                        }
                    }, {
                        key: "_addNotification",
                        value: function(e) {
                            var t = this._currentId;
                            return this._notifications[t] = e,
                            this._currentId++,
                            t
                        }
                    }, {
                        key: "_removeNotification",
                        value: function(e) {
                            var t = !1;
                            return this._notifications.hasOwnProperty(e) && (delete this._notifications[e],
                            t = !0),
                            t
                        }
                    }, {
                        key: "_prepareNotification",
                        value: function(e, t) {
                            var n = this
                              , a = void 0;
                            return a = {
                                get: function() {
                                    return n._notifications[e]
                                },
                                close: function() {
                                    n._closeNotification(e)
                                }
                            },
                            t.timeout && setTimeout(function() {
                                a.close()
                            }, t.timeout),
                            a
                        }
                    }, {
                        key: "_serviceWorkerCallback",
                        value: function(e, t, n) {
                            var a = this
                              , r = this._addNotification(e[e.length - 1]);
                            navigator.serviceWorker.addEventListener("message", function(e) {
                                var t = JSON.parse(e.data);
                                "close" === t.action && Number.isInteger(t.id) && a._removeNotification(t.id)
                            }),
                            n(this._prepareNotification(r, t))
                        }
                    }, {
                        key: "_createCallback",
                        value: function(e, t, n) {
                            var a = this
                              , r = void 0
                              , i = null;
                            if (t = t || {},
                            r = function(e) {
                                a._removeNotification(e),
                                d.default.isFunction(t.onClose) && t.onClose.call(a, i)
                            }
                            ,
                            this._agents.desktop.isSupported())
                                try {
                                    i = this._agents.desktop.create(e, t)
                                } catch (r) {
                                    var s = this._currentId
                                      , o = this.config().serviceWorker
                                      , u = function(e) {
                                        return a._serviceWorkerCallback(e, t, n)
                                    };
                                    this._agents.chrome.isSupported() && this._agents.chrome.create(s, e, t, o, u)
                                }
                            else
                                this._agents.webkit.isSupported() ? i = this._agents.webkit.create(e, t) : this._agents.firefox.isSupported() ? this._agents.firefox.create(e, t) : this._agents.ms.isSupported() ? i = this._agents.ms.create(e, t) : (t.title = e,
                                this.config().fallback(t));
                            if (null !== i) {
                                var _ = this._addNotification(i)
                                  , l = this._prepareNotification(_, t);
                                d.default.isFunction(t.onShow) && i.addEventListener("show", t.onShow),
                                d.default.isFunction(t.onError) && i.addEventListener("error", t.onError),
                                d.default.isFunction(t.onClick) && i.addEventListener("click", t.onClick),
                                i.addEventListener("close", function() {
                                    r(_)
                                }),
                                i.addEventListener("cancel", function() {
                                    r(_)
                                }),
                                n(l)
                            }
                            n(null)
                        }
                    }, {
                        key: "create",
                        value: function(e, t) {
                            var n = this
                              , a = void 0;
                            if (!d.default.isString(e))
                                throw new Error(s.default.errors.invalid_title);
                            return a = this.Permission.has() ? function(a, r) {
                                try {
                                    n._createCallback(e, t, a)
                                } catch (e) {
                                    r(e)
                                }
                            }
                            : function(a, r) {
                                n.Permission.request().then(function() {
                                    n._createCallback(e, t, a)
                                }).catch(function() {
                                    r(s.default.errors.permission_denied)
                                })
                            }
                            ,
                            new Promise(a)
                        }
                    }, {
                        key: "count",
                        value: function() {
                            var e = void 0
                              , t = 0;
                            for (e in this._notifications)
                                this._notifications.hasOwnProperty(e) && t++;
                            return t
                        }
                    }, {
                        key: "close",
                        value: function(e) {
                            var t = void 0;
                            for (t in this._notifications)
                                if (this._notifications.hasOwnProperty(t) && this._notifications[t].tag === e)
                                    return this._closeNotification(t)
                        }
                    }, {
                        key: "clear",
                        value: function() {
                            var e = void 0
                              , t = !0;
                            for (e in this._notifications)
                                this._notifications.hasOwnProperty(e) && (t = t && this._closeNotification(e));
                            return t
                        }
                    }, {
                        key: "supported",
                        value: function() {
                            var e = !1;
                            for (var t in this._agents)
                                this._agents.hasOwnProperty(t) && (e = e || this._agents[t].isSupported());
                            return e
                        }
                    }, {
                        key: "config",
                        value: function(e) {
                            return (void 0 !== e || null !== e && d.default.isObject(e)) && d.default.objectMerge(this._configuration, e),
                            this._configuration
                        }
                    }, {
                        key: "extend",
                        value: function(e) {
                            var t, n = {}.hasOwnProperty;
                            if (!n.call(e, "plugin"))
                                throw new Error(s.default.errors.invalid_plugin);
                            n.call(e, "config") && d.default.isObject(e.config) && null !== e.config && this.config(e.config),
                            t = new (0,
                            e.plugin)(this.config());
                            for (var a in t)
                                n.call(t, a) && d.default.isFunction(t[a]) && (this[a] = t[a])
                        }
                    }]),
                    e
                }();
                n.default = f
            }
            , {
                "./Messages": 1,
                "./Permission": 2,
                "./Util": 4,
                "./agents/DesktopAgent": 6,
                "./agents/MSAgent": 7,
                "./agents/MobileChromeAgent": 8,
                "./agents/MobileFirefoxAgent": 9,
                "./agents/WebKitAgent": 10
            }],
            4: [function(e, t, n) {
                "use strict";
                function a(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var r = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                    return typeof e
                }
                : function(e) {
                    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                }
                  , i = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , s = function() {
                    function e() {
                        a(this, e)
                    }
                    return i(e, null, [{
                        key: "isUndefined",
                        value: function(e) {
                            return void 0 === e
                        }
                    }, {
                        key: "isString",
                        value: function(e) {
                            return "string" == typeof e
                        }
                    }, {
                        key: "isFunction",
                        value: function(e) {
                            return e && "[object Function]" === {}.toString.call(e)
                        }
                    }, {
                        key: "isObject",
                        value: function(e) {
                            return "object" == (void 0 === e ? "undefined" : r(e))
                        }
                    }, {
                        key: "objectMerge",
                        value: function(e, t) {
                            for (var n in t)
                                e.hasOwnProperty(n) && this.isObject(e[n]) && this.isObject(t[n]) ? this.objectMerge(e[n], t[n]) : e[n] = t[n]
                        }
                    }]),
                    e
                }();
                n.default = s
            }
            , {}],
            5: [function(e, t, n) {
                "use strict";
                function a(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                }),
                n.default = function e(t) {
                    a(this, e),
                    this._win = t
                }
            }
            , {}],
            6: [function(e, t, n) {
                "use strict";
                function a(e) {
                    return e && e.__esModule ? e : {
                        default: e
                    }
                }
                function r(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                function i(e, t) {
                    if (!e)
                        throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return !t || "object" != typeof t && "function" != typeof t ? e : t
                }
                function s(e, t) {
                    if ("function" != typeof t && null !== t)
                        throw new TypeError("Super expression must either be null or a function, not " + typeof t);
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            enumerable: !1,
                            writable: !0,
                            configurable: !0
                        }
                    }),
                    t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var o = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , d = a(e("./AbstractAgent"))
                  , u = a(e("../Util"))
                  , _ = function(e) {
                    function t() {
                        return r(this, t),
                        i(this, (t.__proto__ || Object.getPrototypeOf(t)).apply(this, arguments))
                    }
                    return s(t, d.default),
                    o(t, [{
                        key: "isSupported",
                        value: function() {
                            return void 0 !== this._win.Notification
                        }
                    }, {
                        key: "create",
                        value: function(e, t) {
                            return new this._win.Notification(e,{
                                icon: u.default.isString(t.icon) || u.default.isUndefined(t.icon) ? t.icon : t.icon.x32,
                                body: t.body,
                                tag: t.tag,
                                requireInteraction: t.requireInteraction
                            })
                        }
                    }, {
                        key: "close",
                        value: function(e) {
                            e.close()
                        }
                    }]),
                    t
                }();
                n.default = _
            }
            , {
                "../Util": 4,
                "./AbstractAgent": 5
            }],
            7: [function(e, t, n) {
                "use strict";
                function a(e) {
                    return e && e.__esModule ? e : {
                        default: e
                    }
                }
                function r(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                function i(e, t) {
                    if (!e)
                        throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return !t || "object" != typeof t && "function" != typeof t ? e : t
                }
                function s(e, t) {
                    if ("function" != typeof t && null !== t)
                        throw new TypeError("Super expression must either be null or a function, not " + typeof t);
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            enumerable: !1,
                            writable: !0,
                            configurable: !0
                        }
                    }),
                    t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var o = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , d = a(e("./AbstractAgent"))
                  , u = a(e("../Util"))
                  , _ = function(e) {
                    function t() {
                        return r(this, t),
                        i(this, (t.__proto__ || Object.getPrototypeOf(t)).apply(this, arguments))
                    }
                    return s(t, d.default),
                    o(t, [{
                        key: "isSupported",
                        value: function() {
                            return void 0 !== this._win.external && void 0 !== this._win.external.msIsSiteMode
                        }
                    }, {
                        key: "create",
                        value: function(e, t) {
                            return this._win.external.msSiteModeClearIconOverlay(),
                            this._win.external.msSiteModeSetIconOverlay(u.default.isString(t.icon) || u.default.isUndefined(t.icon) ? t.icon : t.icon.x16, e),
                            this._win.external.msSiteModeActivate(),
                            null
                        }
                    }, {
                        key: "close",
                        value: function() {
                            this._win.external.msSiteModeClearIconOverlay()
                        }
                    }]),
                    t
                }();
                n.default = _
            }
            , {
                "../Util": 4,
                "./AbstractAgent": 5
            }],
            8: [function(e, t, n) {
                "use strict";
                function a(e) {
                    return e && e.__esModule ? e : {
                        default: e
                    }
                }
                function r(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                function i(e, t) {
                    if (!e)
                        throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return !t || "object" != typeof t && "function" != typeof t ? e : t
                }
                function s(e, t) {
                    if ("function" != typeof t && null !== t)
                        throw new TypeError("Super expression must either be null or a function, not " + typeof t);
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            enumerable: !1,
                            writable: !0,
                            configurable: !0
                        }
                    }),
                    t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var o = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , d = a(e("./AbstractAgent"))
                  , u = a(e("../Util"))
                  , _ = a(e("../Messages"))
                  , l = function(e) {
                    function t() {
                        return r(this, t),
                        i(this, (t.__proto__ || Object.getPrototypeOf(t)).apply(this, arguments))
                    }
                    return s(t, d.default),
                    o(t, [{
                        key: "isSupported",
                        value: function() {
                            return void 0 !== this._win.navigator && void 0 !== this._win.navigator.serviceWorker
                        }
                    }, {
                        key: "getFunctionBody",
                        value: function(e) {
                            return e.toString().match(/function[^{]+{([\s\S]*)}$/)[1]
                        }
                    }, {
                        key: "create",
                        value: function(e, t, n, a, r) {
                            var i = this;
                            this._win.navigator.serviceWorker.register(a),
                            this._win.navigator.serviceWorker.ready.then(function(a) {
                                var s = {
                                    id: e,
                                    link: n.link,
                                    origin: document.location.href,
                                    onClick: u.default.isFunction(n.onClick) ? i.getFunctionBody(n.onClick) : "",
                                    onClose: u.default.isFunction(n.onClose) ? i.getFunctionBody(n.onClose) : ""
                                };
                                void 0 !== n.data && null !== n.data && (s = Object.assign(s, n.data)),
                                a.showNotification(t, {
                                    icon: n.icon,
                                    body: n.body,
                                    vibrate: n.vibrate,
                                    tag: n.tag,
                                    data: s,
                                    requireInteraction: n.requireInteraction,
                                    silent: n.silent
                                }).then(function() {
                                    a.getNotifications().then(function(e) {
                                        a.active.postMessage(""),
                                        r(e)
                                    })
                                }).catch(function(e) {
                                    throw new Error(_.default.errors.sw_notification_error + e.message)
                                })
                            }).catch(function(e) {
                                throw new Error(_.default.errors.sw_registration_error + e.message)
                            })
                        }
                    }, {
                        key: "close",
                        value: function() {}
                    }]),
                    t
                }();
                n.default = l
            }
            , {
                "../Messages": 1,
                "../Util": 4,
                "./AbstractAgent": 5
            }],
            9: [function(e, t, n) {
                "use strict";
                function a(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                function r(e, t) {
                    if (!e)
                        throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return !t || "object" != typeof t && "function" != typeof t ? e : t
                }
                function i(e, t) {
                    if ("function" != typeof t && null !== t)
                        throw new TypeError("Super expression must either be null or a function, not " + typeof t);
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            enumerable: !1,
                            writable: !0,
                            configurable: !0
                        }
                    }),
                    t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var s = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , o = function(e) {
                    return e && e.__esModule ? e : {
                        default: e
                    }
                }(e("./AbstractAgent"))
                  , d = function(e) {
                    function t() {
                        return a(this, t),
                        r(this, (t.__proto__ || Object.getPrototypeOf(t)).apply(this, arguments))
                    }
                    return i(t, o.default),
                    s(t, [{
                        key: "isSupported",
                        value: function() {
                            return void 0 !== this._win.navigator.mozNotification
                        }
                    }, {
                        key: "create",
                        value: function(e, t) {
                            var n = this._win.navigator.mozNotification.createNotification(e, t.body, t.icon);
                            return n.show(),
                            n
                        }
                    }]),
                    t
                }();
                n.default = d
            }
            , {
                "./AbstractAgent": 5
            }],
            10: [function(e, t, n) {
                "use strict";
                function a(e, t) {
                    if (!(e instanceof t))
                        throw new TypeError("Cannot call a class as a function")
                }
                function r(e, t) {
                    if (!e)
                        throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return !t || "object" != typeof t && "function" != typeof t ? e : t
                }
                function i(e, t) {
                    if ("function" != typeof t && null !== t)
                        throw new TypeError("Super expression must either be null or a function, not " + typeof t);
                    e.prototype = Object.create(t && t.prototype, {
                        constructor: {
                            value: e,
                            enumerable: !1,
                            writable: !0,
                            configurable: !0
                        }
                    }),
                    t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
                }
                Object.defineProperty(n, "__esModule", {
                    value: !0
                });
                var s = function() {
                    function e(e, t) {
                        for (var n = 0; n < t.length; n++) {
                            var a = t[n];
                            a.enumerable = a.enumerable || !1,
                            a.configurable = !0,
                            "value"in a && (a.writable = !0),
                            Object.defineProperty(e, a.key, a)
                        }
                    }
                    return function(t, n, a) {
                        return n && e(t.prototype, n),
                        a && e(t, a),
                        t
                    }
                }()
                  , o = function(e) {
                    return e && e.__esModule ? e : {
                        default: e
                    }
                }(e("./AbstractAgent"))
                  , d = function(e) {
                    function t() {
                        return a(this, t),
                        r(this, (t.__proto__ || Object.getPrototypeOf(t)).apply(this, arguments))
                    }
                    return i(t, o.default),
                    s(t, [{
                        key: "isSupported",
                        value: function() {
                            return void 0 !== this._win.webkitNotifications
                        }
                    }, {
                        key: "create",
                        value: function(e, t) {
                            var n = this._win.webkitNotifications.createNotification(t.icon, e, t.body);
                            return n.show(),
                            n
                        }
                    }, {
                        key: "close",
                        value: function(e) {
                            e.cancel()
                        }
                    }]),
                    t
                }();
                n.default = d
            }
            , {
                "./AbstractAgent": 5
            }],
            11: [function(e, t, n) {
                "use strict";
                var a = function(e) {
                    return e && e.__esModule ? e : {
                        default: e
                    }
                }(e("./classes/Push"));
                t.exports = new a.default("undefined" != typeof window ? window : void 0)
            }
            , {
                "./classes/Push": 3
            }]
        }, {}, [11])(11)
    })
}
, function(e, t, n) {
    var a = n(157)
      , r = n(158)
      , i = n(159)
      , s = a(r, i, null, null, null);
    e.exports = s.exports
}
, function(e, t) {
    e.exports = function(e, t, n, a, r) {
        var i, s = e = e || {}, o = typeof e.default;
        "object" !== o && "function" !== o || (i = e,
        s = e.default);
        var d = "function" == typeof s ? s.options : s;
        t && (d.render = t.render,
        d.staticRenderFns = t.staticRenderFns),
        a && (d._scopeId = a);
        var u;
        if (r ? (u = function(e) {
            e = e || this.$vnode && this.$vnode.ssrContext || this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext,
            e || "undefined" == typeof __VUE_SSR_CONTEXT__ || (e = __VUE_SSR_CONTEXT__),
            n && n.call(this, e),
            e && e._registeredComponents && e._registeredComponents.add(r)
        }
        ,
        d._ssrRegister = u) : n && (u = n),
        u) {
            var _ = d.functional
              , l = _ ? d.render : d.beforeCreate;
            _ ? d.render = function(e, t) {
                return u.call(t),
                l(e, t)
            }
            : d.beforeCreate = l ? [].concat(l, u) : [u]
        }
        return {
            esModule: i,
            exports: s,
            options: d
        }
    }
}
, function(e, t, n) {
    "use strict";
    Object.defineProperty(t, "__esModule", {
        value: !0
    }),
    t.default = {
        props: ["senderId", "userId","chatId", "receptorName","receptorId","senderName"],
        data: function() {
            return {
                message: {
                    text: "",
                    date: null
                },
                historyMessages: [],
                firstLoad: !1,
                firebaseMessagesLoaded: !1
            }
        },
        mounted: function() {
            var e = this;
            database.ref("/MESSAGES/" + this.chatId).on("value", function(t) {
                return e.loadMessages(t.val())
            })
        },
        methods: {
            loadMessages: function(e) {
                this.firebaseMessagesLoaded = !1,
                this.historyMessages = [];
                for (var t in e)
                    this.historyMessages.push({
                        sender_id: e[t].userId,
                        text: e[t].text,
                        date: e[t].date,
                        receiver_name:e[t].receptorName,
                        receiver_id:e[t].receptorId,
                        sender_name:e[t].senderName,
                    });
                this.showNotification(this.historyMessages.slice(-1).pop()),
                this.firstLoad = !0,
                document.querySelector("#comments-container").scrollTop = document.querySelector("#comments-container").scrollHeight - document.querySelector("#comments-container").clientHeight,
                this.firebaseMessagesLoaded = !0
            },
            sendMessage: function() {
                var e = this;
                this.message.text.length > 0 ? database.ref("/MESSAGES/" + this.chatId).push({
                    sender_id: this.userId,
                    text: this.message.text,
                    date: moment().format(),
                    receiver_name:this.receptorName,
                    receiver_id:this.receptorId,
                    sender_name:this.senderName,
                }).then(function() {
                    e.message.text = ""
                }) : alert("First you must write something before sending")
            },
            getUserName: function(e) {
                return e == this.message.userId ? "Me" : this.receptorName
            },
            isMe: function(e) {
                return e == this.userId
            },
            humanize: function(e) {
                return moment(e).format("DD-MM-YY h:mma")
            },
            showNotification: function(e) {
                this.firstLoad && e.userId != this.message.userId && !windowFocus && pushjs.create(this.getUserName(e.userId), {
                    body: e.text,
                    timeout: 4e3,
                    onClick: function() {
                        window.focus(),
                        this.close()
                    }
                })
            }
        }
    }
}
, function(e, t) {
    var n = function() {
        var e = this
          , t = e.$createElement
          , n = e._self._c || t;
        return n("div", [e.firebaseMessagesLoaded ? e._e() : n("div", {
            staticClass: "ui active centered inline text loader"
        }, [e._v("Loading conversation ...")]), e._v(" "), n("div", {
            staticStyle: {
                "max-height": "55vh",
                "overflow-y": "scroll",
                "padding-right": "10px",
                "padding-bottom": "40px"
            },
            attrs: {
                id: "comments-container"
            }
        }, e._l(e.historyMessages, function(t) {
            return e.historyMessages.length > 0 ? n("div", {}, [e.isMe(t.userId) ? n("div", {
                staticClass: "sixteen wide column"
            }, [n("div", {
                staticClass: "comment",
                staticStyle: {
                    "text-align": "right",
                }
            }, [e._m(1, !0), e._v(" "), n("div", {
                staticClass: "content",
                staticStyle: {
                    "margin-left": "0",
                    "margin-right": "3.5em"
                }
            }, [n("div", {
                staticClass: "metadata"
            }, [n("span", {
                staticClass: "date"
            }, [e._v(e._s(e.humanize(t.date)))])]), e._v(" "), n("a", {
                staticClass: "author"
            }, [e._v("Me")]), e._v(" "), n("div", {
                staticClass: "text"
            }, [n("p", [e._v(e._s(t.text))])])])])]) : n("div", {
                staticClass: "sixteen wide column"
            }, [n("div", {
                staticClass: "comment"
            }, [e._m(0, !0), e._v(" "), n("div", {
                staticClass: "content"
            }, [n("a", {
                staticClass: "author"
            }, [e._v(e._s(e.getUserName(t.userId)))]), e._v(" "), n("div", {
                staticClass: "metadata"
            }, [n("span", {
                staticClass: "date"
            }, [e._v(e._s(e.humanize(t.date)))])]), e._v(" "), n("div", {
                staticClass: "text"
            }, [n("p", [e._v(e._s(t.text))])])])])])]) : e._e()
        })), e._v(" "), e.firebaseMessagesLoaded && e.historyMessages.length < 1 ? n("div", [e._m(2)]) : e._e(), e._v(" "), n("form", {
            staticClass: "ui reply form",
            on: {
                submit: function(t) {
                    t.preventDefault(),
                    e.sendMessage()
                }
            }
        }, [n("div", {
            staticClass: "field"
        }, [n("input", {
            directives: [{
                name: "model",
                rawName: "v-model",
                value: e.message.text,
                expression: "message.text"
            }],
            attrs: {
                placeholder: "Enter the message",
                type: "text"
            },
            domProps: {
                value: e.message.text
            },
            on: {
                input: function(t) {
                    t.target.composing || (e.message.text = t.target.value)
                }
            }
        })]), e._v(" "), e._m(3)])])
    }
      , a = [function() {
        var e = this
          , t = e.$createElement
          , n = e._self._c || t;

        return n("a")
    }
    , function() {
        var e = this
          , t = e.$createElement
          , n = e._self._c || t;
        return n("a")
    }
    , function() {
        var e = this
          , t = e.$createElement
          , n = e._self._c || t;
        return n("p", [n("small", [e._v("No Messages, send the first to start the conversation.")])])
    }
    , function() {
        var e = this
          , t = e.$createElement
          , n = e._self._c || t;
        return n("button", {
            staticClass: "ui blue labeled submit icon button",
            attrs: {
                type: "submit"
            }
        }, [n("i", {
            staticClass: "send outline icon"
        }), e._v(" Send Message\n        ")])
    }
    ];
    e.exports = {
        render: n,
        staticRenderFns: a
    }
}
]);
