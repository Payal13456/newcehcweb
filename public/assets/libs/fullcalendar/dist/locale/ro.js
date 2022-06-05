!(function (e, t) {
  "object" == typeof exports && "object" == typeof module
    ? (module.exports = t(require("moment"), require("fullcalendar")))
    : "function" == typeof define && define.amd
    ? define(["moment", "fullcalendar"], t)
    : "object" == typeof exports
    ? t(require("moment"), require("fullcalendar"))
    : t(e.moment, e.FullCalendar);
})("undefined" != typeof self ? self : this, function (e, t) {
  return (function (e) {
    function t(i) {
      if (n[i]) return n[i].exports;
      var r = (n[i] = { i: i, l: !1, exports: {} });
      return e[i].call(r.exports, r, r.exports, t), (r.l = !0), r.exports;
    }
    var n = {};
    return (
      (t.m = e),
      (t.c = n),
      (t.d = function (e, n, i) {
        t.o(e, n) ||
          Object.defineProperty(e, n, {
            configurable: !1,
            enumerable: !0,
            get: i,
          });
      }),
      (t.n = function (e) {
        var n =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return t.d(n, "a", n), n;
      }),
      (t.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
      }),
      (t.p = ""),
      t((t.s = 179))
    );
  })({
    0: function (t, n) {
      t.exports = e;
    },
    1: function (e, n) {
      e.exports = t;
    },
    179: function (e, t, n) {
      Object.defineProperty(t, "__esModule", { value: !0 }), n(180);
      var i = n(1);
      i.datepickerLocale("ro", "ro", {
        closeText: "Închide",
        prevText: "&#xAB; Luna precedentă",
        nextText: "Luna următoare &#xBB;",
        currentText: "Azi",
        monthNames: [
          "Ianuarie",
          "Februarie",
          "Martie",
          "Aprilie",
          "Mai",
          "Iunie",
          "Iulie",
          "August",
          "Septembrie",
          "Octombrie",
          "Noiembrie",
          "Decembrie",
        ],
        monthNamesShort: [
          "Ian",
          "Feb",
          "Mar",
          "Apr",
          "Mai",
          "Iun",
          "Iul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        dayNames: [
          "Duminică",
          "Luni",
          "Marţi",
          "Miercuri",
          "Joi",
          "Vineri",
          "Sâmbătă",
        ],
        dayNamesShort: ["Dum", "Lun", "Mar", "Mie", "Joi", "Vin", "Sâm"],
        dayNamesMin: ["Du", "Lu", "Ma", "Mi", "Jo", "Vi", "Sâ"],
        weekHeader: "Săpt",
        dateFormat: "dd.mm.yy",
        firstDay: 1,
        isRTL: !1,
        showMonthAfterYear: !1,
        yearSuffix: "",
      }),
        i.locale("ro", {
          buttonText: {
            prev: "precedentă",
            next: "următoare",
            month: "Lună",
            week: "Săptămână",
            day: "Zi",
            list: "Agendă",
          },
          allDayText: "Toată ziua",
          eventLimitText: function (e) {
            return "+alte " + e;
          },
          noEventsMessage: "Nu există evenimente de afișat",
        });
    },
    180: function (e, t, n) {
      !(function (e, t) {
        t(n(0));
      })(0, function (e) {
        function t(e, t, n) {
          var i = {
              ss: "secunde",
              mm: "minute",
              hh: "ore",
              dd: "zile",
              MM: "luni",
              yy: "ani",
            },
            r = " ";
          return (
            (e % 100 >= 20 || (e >= 100 && e % 100 == 0)) && (r = " de "),
            e + r + i[n]
          );
        }
        return e.defineLocale("ro", {
          months:
            "ianuarie_februarie_martie_aprilie_mai_iunie_iulie_august_septembrie_octombrie_noiembrie_decembrie".split(
              "_"
            ),
          monthsShort:
            "ian._febr._mart._apr._mai_iun._iul._aug._sept._oct._nov._dec.".split(
              "_"
            ),
          monthsParseExact: !0,
          weekdays: "duminică_luni_marți_miercuri_joi_vineri_sâmbătă".split(
            "_"
          ),
          weekdaysShort: "Dum_Lun_Mar_Mie_Joi_Vin_Sâm".split("_"),
          weekdaysMin: "Du_Lu_Ma_Mi_Jo_Vi_Sâ".split("_"),
          longDateFormat: {
            LT: "H:mm",
            LTS: "H:mm:ss",
            L: "DD.MM.YYYY",
            LL: "D MMMM YYYY",
            LLL: "D MMMM YYYY H:mm",
            LLLL: "dddd, D MMMM YYYY H:mm",
          },
          calendar: {
            sameDay: "[azi la] LT",
            nextDay: "[mâine la] LT",
            nextWeek: "dddd [la] LT",
            lastDay: "[ieri la] LT",
            lastWeek: "[fosta] dddd [la] LT",
            sameElse: "L",
          },
          relativeTime: {
            future: "peste %s",
            past: "%s în urmă",
            s: "câteva secunde",
            ss: t,
            m: "un minut",
            mm: t,
            h: "o oră",
            hh: t,
            d: "o zi",
            dd: t,
            M: "o lună",
            MM: t,
            y: "un an",
            yy: t,
          },
          week: { dow: 1, doy: 7 },
        });
      });
    },
  });
});
