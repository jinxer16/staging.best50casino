var BlackJackFunctions = function () {
    var e = {}, t = null, a = 0, r = 0, l = [], s = null;
    const n = {soft17: !0, surrender: "early", double_range: [0, 21], double_asplit: !0, nof_decks: 8, max_shands: 4};

    function o() {
        var e = l.length, a = c();
        return "early" == n.surrender && d(l, t, a, e, n) ? "surrender" : function (e, t, a, r, l) {
            var s = !1;
            if (2 != e.length || r == l.max_shands || e[0] != e[1]) return !1;
            switch (parseInt(e[0])) {
                case 1:
                case 11:
                    s = !0;
                    break;
                case 2:
                    s = t > 3 && t < 8 || (2 == t || 3 == t) && l.double_asplit, 3 == t && 1 == l.nof_decks && (s = !0);
                    break;
                case 3:
                    s = t > 3 && t < 8 || (2 == t || 3 == t) && l.double_asplit, 8 == t && 1 == l.nof_decks && l.double_asplit && (s = !0);
                    break;
                case 4:
                     s = (5 == t || 6 == t || 4 == t && 1 == l.nof_decks) && l.double_asplit;
                    break;
                case 6:
                    s = t > 2 && t < 7 || 2 == t && (l.nof_decks >= 4 && l.double_asplit || l.nof_decks <= 2), l.nof_decks <= 2 && 7 == t && l.double_asplit && (s = !0);
                    break;
                case 7:
                    s = t > 1 && t < 8, 8 == t && l.nof_decks <= 2 && (s = l.double_asplit);
                    break;
                case 8:
                    s = !d(e, t, a, r, l);
                    break;
                case 9:
                    s = t > 1 && t < 10 && 7 != t
            }
            return s
        }(l, t, a, e, n) ? "split" : function (e, t, a, r, l) {
            var s = !1;
            if (2 != e.length || r > 1 && !l.double_asplit) return !1;
            if (a.total < l.double_range[0] || a.total > l.double_range[1]) return !1;
            if (a.soft) switch (a.total) {
                case 13:
                case 14:
                    s = 5 == t || 6 == t, 4 == t && (1 == l.nof_decks || 2 == l.nof_decks && 14 == a.total && l.soft17) && (s = !0);
                    break;
                case 15:
                case 16:
                    s = t >= 4 && t <= 6;
                    break;
                case 17:
                    s = t >= 3 && t <= 6 || 2 == t && 1 == l.nof_decks;
                    break;
                case 18:
                    s = t >= 3 && t <= 6 || 2 == t && l.soft17 && l.nof_decks > 1;
                    break;
                case 19:
                    s = 6 == t && (l.soft17 || 1 == l.nof_decks)
            } else switch (a.total) {
                case 8:
                    s = t >= 5 && t <= 6 && 1 == l.nof_decks;
                    break;
                case 9:
                    s = t >= 3 && t <= 6 || 2 == t && l.nof_decks <= 2;
                    break;
                case 10:
                    s = t >= 2 && t <= 9;
                    break;
                case 11:
                    // s = !(1 == t && !l.soft17 && l.nof_decks > 2)
            }
            return s
        }(l, t, a, e, n) ? "double" : function (e, t, a, r, l) {
            var s = !1;
            a.soft ? a.total > 18 ? s = !0 : 18 == a.total && (s = t >= 2 && t <= 8 || 1 == t && 1 == l.nof_decks && !l.soft17) : a.total > 16 ? s = !0 : a.total > 12 ? s = t >= 2 && t <= 6 : 12 == a.total && (s = t >= 4 && t <= 6);
            return s
        }(0, t, a, 0, n) ? "stand" : a.total < 21 && "hit"
    }

    function c() {
        for (var e = {
            total: 0,
            soft: !1
        }, t = !1, a = 0; a < l.length; a++) 11 == l[a] ? (t = !0, e.total += 1) : e.total += parseInt(l[a]);
        return e.total <= 11 && t && (e.total += 10, e.soft = !0), e
    }

    function d(e, t, a, r, l) {
        var s = !1;
        return ("early" == l.surrender || "late" == l.surrender) && 2 == e.length && 1 == r && (!a.soft && (11 == t ? ((a.total >= 5 && a.total <= 7 || a.total >= 12 && a.total <= 17) && (s = !0), 2 == e[0] && 2 == e[1] && l.soft17 && (s = !0)) : 10 == t ? a.total >= 14 && a.total <= 16 && (s = 8 != e[0] || 8 != e[1]) : 9 == t && 16 == a.total && 8 != e[0] && (s = !0), s))
    }

    return calculate_result = function (e) {
        return 0 != l.length && (a > 21 ? ($(".player-total").html("Burned!").show(), $(".result-outer-container").hide(), $(".result-container").removeClass().addClass("result-container").html(""), !1) : (l.includes(11) && 21 == a ? $(".player-total").html("Blackjack").show() : r ? $(".player-total").html("Soft " + a).show() : $(".player-total").html("Hard " + a).show(), !!t && ((s = o()) || ($(".result-container").removeClass().addClass("result-container").html(""), $(".result-outer-container").hide()), $(".result-container").removeClass().addClass("result-container").addClass(s + "-result").html(s), void $(".result-outer-container").show())))
    }, e.init = function () {
        $(".dealer-card").click(function () {
            return t = $(this).attr("data-card-value"), $(".selected-dealer-card").html($(this).html()), calculate_result(0), !1
        }), $(".player-card").click(function () {
            if (a > 21 || "burned" == s) return !1;
            l.push(parseInt($(this).attr("data-card-value"))), 1 == l.length ? ($(".selected-player-cards .first_card").before($(this).html()), $(".selected-player-cards .first_card").remove()) : 2 == l.length ? ($(".selected-player-cards .second_card").before($(this).html()), $(".selected-player-cards .second_card").remove()) : $(".selected-player-cards").append($(this).html()), 60 + 20 * (l.length - 1) > $(".flex-cards-container").width() / 2 ? $(".flex-cards-container").addClass("flex-column") : $(".flex-cards-container").removeClass("flex-column");
            var e = c();
            return a = e.total, r = e.soft, calculate_result(0), !1
        }), $(".reset-game").click(function () {
            return t = null, l = [], a = 0, r = 0, s = null, $(".player-total").html("").hide(), $(".selected-dealer-card").html($(".original-selected-dealer-card").html()), $(".selected-player-cards").html($(".original-selected-player-cards").html()), $(".result-outer-container").hide(), $(".result-container").removeClass().addClass("result-container").html(""), $(".flex-cards-container").removeClass("flex-column"), !1
        })
    }, e.resize = function () {
        60 + 20 * (l.length - 1) > $(".flex-cards-container").width() / 2 ? $(".flex-cards-container").addClass("flex-column") : $(".flex-cards-container").removeClass("flex-column")
    }, e
}, blackJackFunctions = new BlackJackFunctions;
window.addEventListener("DOMContentLoaded", function () {
    var e, t, a;
    e = jQuery, t = window.top.location + "", -1 == (a = t.indexOf("https://www.bookmakers.bet")) && (a = t.indexOf("https://www.foxbet.gr")), -1 == a && (a = t.indexOf("https://www.bookmakers.gr")), -1 == a && (a = t.indexOf("https://www.casinowinners.gr")), -1 == a && (a = t.indexOf("http://localhost/web.bookmakers.bet")), -1 == a, blackJackFunctions.init(), e(window).on("resize", function () {
        blackJackFunctions.resize()
    })
});