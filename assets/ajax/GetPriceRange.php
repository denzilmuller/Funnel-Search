<?php
require "../lib/Search.php";
use lib\Search;
$search_obj = new Search();
$styles = "";
$types = "";
$price_range = "";

if (isset($_REQUEST['style_values'])) {
    $styles = $_REQUEST['style_values'];
    $styles_array = explode(",", rtrim($styles, ','));
    $price_range = $search_obj->GetPriceRange($styles_array, '');
} else if ($_REQUEST['types_values']) {
    $types = $_REQUEST['types_values'];
    $types_array = explode(",", rtrim($types, ','));
    $price_range = $search_obj->GetPriceRange('', $types_array);
}

$price_array = explode(" : ", $price_range);
$min_price = $price_array[0];
$max_price = $price_array[1];

?>
<h5>Price Range:</h5>
<input type="text" id="amount" name="amount" style="border:0; color:#ed1966; font-weight:bold;text-align: center;" readonly>
<br><br>
<div id="slider-range" style="width:50%; margin: 0 auto;"></div>
<div style="clear: both"></div>
<br><br>

<script type="text/javascript">
   // Slider JS
   // TODO : Move to App.js
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 1000,
        values: [ <?php echo $min_price; ?>, <?php echo $max_price; ?> ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "R" + ui.values[ 0 ] + " - R" + ui.values[ 1 ] );

            // do ajax call here

            // get product count
            $.post("assets/ajax/GetProductCounter.php", {
                "types_values"  : '<?php echo $types; ?>',
                "styles_values"  : '<?php echo $styles; ?>',
                "min_price" : ui.values[ 0 ],
                "max_price" : ui.values[ 1 ]
            }).done(function (count_data) {
                $("#counter-container").html(count_data.trim() === "" ? "<div>No results found for your criteria.</div>" : count_data);
            });
        }
    });
    $( "#amount" ).val( "R" + $( "#slider-range" ).slider( "values", 0 ) +
    " - R" + $( "#slider-range" ).slider( "values", 1 ) );

</script>