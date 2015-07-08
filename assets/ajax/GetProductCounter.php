<?php
require "../lib/Search.php";
use lib\Search;
$search_obj = new Search();
$product_count = 0;
if (isset($_REQUEST['style_values']) && $_REQUEST['min_price'] == "") {
    $styles = $_REQUEST['style_values'];
    $styles_array = explode(",", rtrim($styles, ','));
    $product_count = $search_obj->GetCounterByFilter($styles_array, '');
} else if (isset($_REQUEST['types_values']) && $_REQUEST['min_price'] == "") {
    $types = $_REQUEST['types_values'];
    $types_array = explode(",", rtrim($types, ','));
    $product_count = $search_obj->GetCounterByFilter('', $types_array);
} else {
    $min_price = $_REQUEST['min_price'];
    $max_price = $_REQUEST['max_price'];
   if ($_REQUEST['styles_values'] != "") {
     //  die("ok1");
       $styles = $_REQUEST['styles_values'];
       $styles_array = explode(",", rtrim($styles, ','));
       $product_count = $search_obj->GetResultsCounter($styles_array, "", $min_price, $max_price);
   } else {
      // die("ok2");
       $types = $_REQUEST['types_values'];
       $types_array = explode(",", rtrim($types, ','));
       $product_count = $search_obj->GetResultsCounter("", $types_array, $min_price, $max_price);
   }
}
?>
<p><span><?php echo $product_count;?></span> Products Found!</p>