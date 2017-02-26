(function ($) {
    
    var metadata = (function () {
      var init = function () {
        $(window).resize(function () {
          var height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0) - 150;
          var size = Math.round(height / 20);
           
          $("#nav-romlist").attr("size", size);
          $("#nav-romlist").css("height", height);
          $("#rom-data").css("height", height);
        });

        $(window).trigger('resize');
        
        $('#nav-emulator').on('change', function (e) {
          e.preventDefault();
          $('#panel-right').html('');
          return false;
        });
        $('#nav-filter').on('change', function (e) {
          e.preventDefault();
          $('#panel-right').html('');
          return false;
        });
      };
      
      var reset = function () {
        $('#nav-emulator').trigger('change');
      }
      
      return {
        init: init,
        reset: reset
      };
    })();

    $.extend(true, window, {
      core: {
        metadata: metadata
      }
    });

    $(function () {
        core.metadata.init();
    });

}(jQuery));