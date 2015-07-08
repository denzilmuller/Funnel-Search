<?php
require "assets/lib/Search.php";
use lib\Search;

$search_obj = new Search();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>Results</title>
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
    <h2>Results V1</h2>

    <hr/>


    <div class="list-group">
        <a href="#" class="list-group-item active">
            Product Results
        </a>
        <?php

        $search_obj->GetResults(); ?>

    </div>

    <a href="index.php" class="btn btn-info">Back</a>
    <br/><br/>


</div>

<!-- jquery cdn include -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- bootstrap select picker-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="assets/js/app.js"></script>

</body>
</html>