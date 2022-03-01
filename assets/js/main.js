(function ($) {
    $(function () {

      function set_price_range() {
        var values = [];
        $('.price').each(function(i){
          var price_value = $(this).html(); 
          values.push({ key: i, value: price_value }); 
        });

        price_array = [];
        $.each(values, function(i, option) {
            price_array[i] = "<option value='" + option.value + "'>" + option.value + "</option>";
        });

        $('#filter-select').append(price_array.join(''));
      }
      set_price_range();

    	// product filter by category
        $(".filter-button").click(function () {
            var value = $(this).attr('data-filter');
            if (value == "all") {

              $('.filter').show('1000');
            } else {

              $(".filter").not('.' + value).hide('3000');
              $('.filter').filter('.' + value).show('3000');

            }

            if ($(".filter-button").removeClass("active")) {
              $(this).removeClass("active");
            }
            $(this).addClass("active");

        });

        // product filter by prices

        $('#filter-select').on('change', function() {

            var value = this.value;
            if (value == "Select Price") {

              $('.filter').show('1000');
            } else {

              $(".filter").not('.' + value).hide('3000');
              $('.filter').filter('.' + value).show('3000');

            }

            if ($("#filter-select").removeAttr("selected")) {
              $(this).removeAttr("selected");
            }
            $(this).attr("selected");
        });

    });
})(jQuery);