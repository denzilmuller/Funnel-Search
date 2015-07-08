<?php
require "../lib/Search.php";
use lib\Search;

$search_obj = new Search();
$styles = $_REQUEST['style_values'];
$styles_array = explode(",", rtrim($styles, ','));
foreach ($styles_array as $style) {
    ?>

    <div class="style-container">
        <h5>Types of <?php echo $style; ?> Shoes</h5>
        <div class="row">
            <ul class="listrap">
                <?php
                    // Get Search Results
                    echo $search_obj->GenerateStyleTypes($style);
                ?>
            </ul>
        </div>
    </div>
    <?php
}
?>
<hr/>
<script type="text/javascript">
  // Custom JS for Selection and Price Range Update
 // alert('ok');
  $(".listrap").listrap();

  function FilterByType(type_id) {
      var selector = '#TypeID'+type_id;
      if ($(selector).is(':checked')) {
          //toggle off
          $(selector).prop('checked', false);
      } else {
          $(selector).prop('checked', true);
      }


      var values = "";
      $('input[name="ShoeType[]"]:checked').each(function() {
          values = values + this.value + ",";
      });
      // if value is not empty
      if (values != "") {

          $("#price-container").html("<div>Loading results</div>");
          $("#counter-container").html("<div>Loading results</div>");

          // get price range
          $.post("assets/ajax/GetPriceRange.php", {
              "types_values"  : values
          }).done(function (price_data) {
              $("#price-container").html(price_data.trim() === "" ? "<div class=\"search-results-loading\"><i class=\"fa fa-warning\"></i> No results found for your criteria.</div>" : price_data);
          });

          // get product count
          $.post("assets/ajax/GetProductCounter.php", {
              "types_values"  : values
          }).done(function (count_data) {
              $("#counter-container").html(count_data.trim() === "" ? "<div>No results found for your criteria.</div>" : count_data);
          });

      }  else {

          var style_values = $('.selectpicker').val();

          $.each(style_values, function( index, value ) {
              values = values + value + ",";

          });
          // get price range
          $.post("assets/ajax/GetPriceRange.php", {
              "style_values"  : values
          }).done(function (price_data) {
              $("#price-container").html(price_data.trim() === "" ? "<div class=\"search-results-loading\"><i class=\"fa fa-warning\"></i> No results found for your criteria.</div>" : price_data);
          });

          // get product count
          $.post("assets/ajax/GetProductCounter.php", {
              "style_values"  : values
          }).done(function (count_data) {
              $("#counter-container").html(count_data.trim() === "" ? "<div>No results found for your criteria.</div>" : count_data);
          });

      }
  }

</script>

