var App = (function () {
  'use strict';

  App.dashboard = function () {

    //Counter
    function counter() {

      $('[data-toggle="counter"]').each(function (i, e) {
        var _el = $(this);
        var prefix = '';
        var suffix = '';
        var start = 0;
        var end = 0;
        var decimals = 0;
        var duration = 2.5;

        if (_el.data('prefix')) { prefix = _el.data('prefix'); }

        if (_el.data('suffix')) { suffix = _el.data('suffix'); }

        if (_el.data('start')) { start = _el.data('start'); }

        if (_el.data('end')) { end = _el.data('end'); }

        if (_el.data('decimals')) { decimals = _el.data('decimals'); }

        if (_el.data('duration')) { duration = _el.data('duration'); }

        var count = new CountUp(_el.get(0), start, end, decimals, duration, {
          suffix: suffix,
          prefix: prefix,
        });

        count.start();
      });
    }

    //Show loading class toggle
    function toggleLoader() {
      $('.toggle-loading').on('click', function () {
        var parent = $(this).parents('.widget, .panel');

        if (parent.length) {
          parent.addClass('be-loading-active');

          setTimeout(function () {
            parent.removeClass('be-loading-active');
          }, 3000);
        }
      });
    }

    //Top tile widgets
    function sparklines() {

      var color1 = App.color.primary;
      var color2 = App.color.warning;
      var color3 = App.color.success;
      var color4 = App.color.danger;

      fetch('http://localhost/parking/parking/api.php?act=spark1')
        .then(r => r.json())
        .then((rr) => {
          var bbb = rr.map(Number)

          $('#spark1').sparkline(bbb, {
            width: '100',
            height: '50',
            lineColor: color1,
            highlightSpotColor: color1,
            highlightLineColor: color1,
            fillColor: false,
            spotColor: false,
            minSpotColor: false,
            maxSpotColor: false,
            lineWidth: 1.15
          });


        })


<<<<<<< Updated upstream
      fetch('http://localhost/parking/api.php?act=spark2')
=======
        fetch('http://localhost/parking/parking/api.php?act=spark2')
>>>>>>> Stashed changes
        .then(dd => dd.json())
        .then((dd) => {
          var www = dd.map(Number)

          $("#spark2").sparkline(www, {
            type: 'bar',
            width: '100',
            height: '50',
            barWidth: 3,
            barSpacing: 3,
            chartRangeMin: 0,
            barColor: color2
          });


        })

<<<<<<< Updated upstream

      fetch('http://localhost/parking/api.php?act=spark3')
=======
        
        fetch('http://localhost/parking/parking/api.php?act=spark3')
>>>>>>> Stashed changes
        .then(ddd => ddd.json())
        .then((ddd) => {
          var wwww = ddd.map(Number)

          $('#spark3').sparkline(wwww, {
            type: 'discrete',
            width: '85',
            height: '35',
            lineHeight: 20,
            lineColor: color3,
            xwidth: 18
          });

        })

<<<<<<< Updated upstream
      fetch('http://localhost/parking/api.php?act=spark4')
=======
        fetch('http://localhost/parking/parking/api.php?act=spark4')
>>>>>>> Stashed changes
        .then(dddd => dddd.json())
        .then((dddd) => {
          var wwwww = dddd.map(Number)

          $('#spark4').sparkline(wwwww, {
            width: '85',
            height: '35',
            lineColor: color4,
            highlightSpotColor: color4,
            highlightLineColor: color4,
            fillColor: false,
            spotColor: false,
            minSpotColor: false,
            maxSpotColor: false,
            lineWidth: 1.15
          });

        })


      fetch('http://localhost/parking/api.php?act=spark3')
        .then(y => y.json())
        .then((yy) => {
          var yyy = yy.map(Number)

          $('#spark5').sparkline(yyy, {
            type: 'discrete',
            width: '85',
            height: '35',
            lineHeight: 20,
            lineColor: color3,
            xwidth: 18
          });

        })

      fetch('http://localhost/parking/api.php?act=spark4')
        .then(rr => rr.json())
        .then((rrrr) => {
          var rrrrrr = rrrr.map(Number)

          $('#spark6').sparkline(rrrrrr, {
            width: '85',
            height: '35',
            lineColor: color4,
            highlightSpotColor: color4,
            highlightLineColor: color4,
            fillColor: false,
            spotColor: false,
            minSpotColor: false,
            maxSpotColor: false,
            lineWidth: 1.15
          });

        })


    }

    //Main chart
    function mainChart() {

      var color1 = App.color.primary;
      var color2 = tinycolor(App.color.primary).lighten(13).toString();
      var color3 = tinycolor(App.color.primary).lighten(20).toString();

      fetch('http://localhost/parking/api.php?act=spark_all')
        .then(all => all.json())
        .then((alls) => {

          var plot_statistics = $.plot("#main-chart",
            [
              {
                data: alls,
                canvasRender: true
              }
            ], {
            series: {
              lines: {
                show: true,
                lineWidth: 0,
                fill: true,
                fillColor: { colors: [{ opacity: 1 }, { opacity: 1 }] }
              },
              fillColor: "rgba(0, 0, 0, 1)",
              shadowSize: 0,
              curvedLines: {
                apply: true,
                active: true,
                monotonicFit: true
              }
            },
            legend: {
              show: false
            },
            grid: {
              show: true,
              margin: {
                top: 20,
                bottom: 0,
                left: 0,
                right: 0,
              },
              labelMargin: 0,
              minBorderMargin: 0,
              axisMargin: 0,
              tickColor: "rgba(0,0,0,0.05)",
              borderWidth: 0,
              hoverable: true,
              clickable: true
            },
            colors: [color1, color2, color3],
            xaxis: {
              tickFormatter: function () {
                return '';
              },
              autoscaleMargin: 0,
              ticks: 11,
              tickDecimals: 0,
              tickLength: 0
            },
            yaxis: {
              tickFormatter: function () {
                return '';
              },
              //autoscaleMargin: 0.01,
              ticks: 4,
              tickDecimals: 0
            }
          });

        })


      //Chart legend color setter
      $('[data-color="main-chart-color1"]').css({ 'background-color': color1 });
      $('[data-color="main-chart-color2"]').css({ 'background-color': color2 });
      $('[data-color="main-chart-color3"]').css({ 'background-color': color3 });
    }

    //Top sales chart
    function topSales() {

      var data = [
        { label: "Services", data: 33 },
        { label: "Standard Plans", data: 33 },
        { label: "Services", data: 33 }
      ];

      var color1 = App.color.success;
      var color2 = App.color.warning;
      var color3 = App.color.primary;

      $.plot('#top-sales', data, {
        series: {
          pie: {
            radius: 0.75,
            innerRadius: 0.58,
            show: true,
            highlight: {
              opacity: 0.1
            },
            label: {
              show: false
            }
          }
        },
        grid: {
          hoverable: true,
        },
        legend: {
          show: false
        },
        colors: [color1, color2, color3]
      });

      //Chart legend color setter
      $('[data-color="top-sales-color1"]').css({ 'background-color': color1 });
      $('[data-color="top-sales-color2"]').css({ 'background-color': color2 });
      $('[data-color="top-sales-color3"]').css({ 'background-color': color3 });
    }

    //Calendar widget
    function calendar() {
      var widget = $("#calendar-widget");
      var now = new Date();
      var year = now.getFullYear();
      var month = now.getMonth();

      var events = [year + '-' + (month + 1) + '-16', year + '-' + (month + 1) + '-20'];

      function checkRows(datepicker) {
        var dp = datepicker.dpDiv;
        var rows = $("tbody tr", dp).length;

        if (rows == 6) {
          dp.addClass('ui-datepicker-6rows');
        } else {
          dp.removeClass('ui-datepicker-6rows');
        }
      }

      //Extend default datepicker to support afterShow event
      $.extend($.datepicker, {
        _updateDatepicker_original: $.datepicker._updateDatepicker,
        _updateDatepicker: function (inst) {
          this._updateDatepicker_original(inst);
          var afterShow = this._get(inst, 'afterShow');
          if (afterShow) {
            afterShow.apply(inst, [inst]);
          }
        }
      });

      if (typeof jQuery.ui != 'undefined') {
        widget.datepicker({
          showOtherMonths: true,
          selectOtherMonths: true,
          beforeShowDay: function (date) {
            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
            if ($.inArray(y + '-' + (m + 1) + '-' + d, events) != -1) {
              return [true, 'has-events', 'This day has events!'];
            } else {
              return [true, "", ""];
            }
          },
          afterShow: function (o) {
            //If datepicker has 6 rows add a class to the widget
            checkRows(o);
          }
        });
      }
    }

    //Map widget
    function map() {

      var color1 = tinycolor(App.color.primary).lighten(15).toHexString();
      var color2 = tinycolor(App.color.primary).lighten(8).toHexString();
      var color3 = tinycolor(App.color.primary).toHexString();

      //Highlight data
      var data = {
        "ru": "14",
        "us": "14",
        "ca": "10",
        "br": "10",
        "au": "11",
        "uk": "3",
        "cn": "12"
      };

      $('#map-widget').vectorMap({
        map: 'world_en',
        backgroundColor: null,
        color: color1,
        hoverOpacity: 0.7,
        selectedColor: color2,
        enableZoom: true,
        showTooltip: true,
        values: data,
        scaleColors: [color1, color2],
        normalizeFunction: 'polynomial'
      });
    }

    //CounterUp Init
    counter();

    //Loader show
    toggleLoader();

    //Row 1
    sparklines();

    //Row 2
    mainChart();

    //Row 4
    topSales();
    calendar();

    //Row 5
    map();

  };

  return App;
})(App || {});
