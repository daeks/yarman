(function ($) {
    
    var charts = (function () {
      var init = function () {
        $('[data-provider="gauge"]').each(function () {
          if (typeof $(this).attr('height') == 'undefined') {
            $(this).css('height', '150px');
          } else {
            $(this).css('height', $(this).attr('height') + 'px');
          }
          
          if (typeof $(this).attr('width') == 'undefined') {
            $(this).css('width', '200px');
          } else {
            $(this).css('width', $(this).attr('width') + 'px');
          }
          
          var g = new JustGage({
            id: $(this).attr('id'),
            value: $(this).attr('data-query'),
            decimals: 2,
            height: ((typeof $(this).attr('height') == 'undefined')? 150 : $(this).attr('height')),
            width: ((typeof $(this).attr('width') == 'undefined')? 200 : $(this).attr('width')),
            min: ((typeof $(this).attr('data-query-min') == 'undefined')? 0 : $(this).attr('data-query-min')),
            max: ((typeof $(this).attr('data-query-max') == 'undefined')? 100 : $(this).attr('data-query-max')),
            title: ((typeof $(this).attr('title') == 'undefined')? '' : $(this).attr('title')),
            label: ((typeof $(this).attr('label') == 'undefined')? '' : $(this).attr('label'))
          });
        });
      };
      
      return {
        init: init
      };
    })();

    $.extend(true, window, {
      core: {
        charts: charts
      }
    });

    $(function () {
        core.charts.init();
    });

}(jQuery));
