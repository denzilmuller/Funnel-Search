<?php
require "assets/lib/Search.php";
use lib\Search;

$search_obj = new Search();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>Funnel Search V1</title>
    <!-- bootstrap include -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!-- custom styles include -->
    <link rel="stylesheet" href="assets/scss/app.css" />
</head>
<body>

<!-- container node -->
<div class="container">
    <h2>Funnel Search V1</h2>

    <hr/>
    <h5>Select Your Shoe Style:</h5>
    <form action="results.php" method="post">
    <select name="ShoeStyle[]" class="selectpicker" data-style="btn-inverse" multiple>
        <option>Comfort</option>
        <option>Slippers</option>
        <option>Sports</option>
        <option>Flats</option>
        <option>Wedges</option>
        <option>Loafers</option>
    </select>

    <hr/>
    <!-- style options goes here //-->
    <div id="type-container"></div>
    <!-- style options goes here //-->

    <!-- price options goes here //-->
    <div id="price-container"></div>
    <!-- price options goes here //-->

    <!-- product counter starts -->
    <div id="counter-container">
        <p><span><?php echo $search_obj->GetTotalProducts();?></span> Products Found!</p>
    </div>
     <!-- product counter ends -->
    <button type="submit" class="btn btn-success">View Results</button>


    </form>

</div>

<!-- jquery cdn include & bootstrap includes -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!-- custom js includes-->
<script src="assets/js/app.js"></script>

</body>
</html>