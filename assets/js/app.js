// Listrap Plugin for Style Types Selection
jQuery.fn.extend({
    listrap: function () {
        var listrap = this;
        $(this).addClass("listrap");
        listrap.getSelection = function () {
            var selection = new Array();
            listrap.children("li.active").each(function (ix, el) {
                selection.push($(el)[0]);
            });
            return selection;
        }
        var toggle = "li .listrap-toggle ";
        var selectionChanged = function () {
            $(this).parent().parent().toggleClass("active");
            listrap.trigger("selection-changed", [listrap.getSelection()]);
        }
        $(listrap).find(toggle + "img").on("click", selectionChanged);
        $(listrap).find(toggle + "span").on("click", selectionChanged);

        return listrap;
    }
});



// Custom Js
$(function() {
    // Handler for .ready() called.

    $('.selectpicker').selectpicker();
    $('.selectpicker').on('change', function() {

        var style_values = $('.selectpicker').val();
        var values = "";
        $.each(style_values, function( index, value ) {
            values = values + value + ",";
        });


        // do ajax call
        $('div.show-tick').removeClass('open');
        $("#type-container").html("<div>Loading results</div>");
        $("#price-container").html("<div>Loading results</div>");
        $("#counter-container").html("<div>Loading results</div>");


        //get styles
        $.post("assets/ajax/GetTypeByStyle.php", {
            "style_values"  : values
        }).done(function (type_data) {
            $("#type-container").html(type_data.trim() === "" ? "<div>No results found for your criteria.</div>" : type_data);
        });

        // get price range
        $.post("assets/ajax/GetPriceRange.php", {
            "style_values"  : values
        }).done(function (price_data) {
            $("#price-container").html(price_data.trim() === "" ? "<div>No results found for your criteria.</div>" : price_data);
        });

        // get product count
        $.post("assets/ajax/GetProductCounter.php", {
            "style_values"  : values
        }).done(function (count_data) {
            $("#counter-container").html(count_data.trim() === "" ? "<div>No results found for your criteria.</div>" : count_data);
        });

    });



});