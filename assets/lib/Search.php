<?php
namespace lib {

    class Search {

        public $styles_json;
        public $product_json;

        public function __construct()
        {

            $style_json_file = file_get_contents(dirname(__FILE__).'/../ajax/ShoeCategories.json');
            $this->styles_json = json_decode($style_json_file, true);

            $prod_json_file = file_get_contents(dirname(__FILE__).'/../ajax/ShoeProducts.json');
            $this->product_json = json_decode($prod_json_file, true);
        }

        /**
         *
         * Returns list of Style Types depending on the selected Style
         *
         * @param string $style  Selected Style
         * @return string
         */
        public function GenerateStyleTypes($style) {

            $return_html = "";
            foreach($this->styles_json as $obj){
                if ($style == $obj["Style"]) {

                    $return_html .= '<li onclick="javascript:FilterByType(\''.$obj["TypeID"].'\');">
                    <div class="listrap-toggle">
                        <span></span>
                        <img src="assets/images/background.png" width="60" class="img-circle" />
                    </div>
                    <strong>'.$obj["Type"].'</strong>
                    <input type="checkbox" name="ShoeType[]" id="TypeID'.$obj["TypeID"].'" value="'.$obj["TypeID"].'" style="display:none"/>
                </li>';

                }
            }

            return $return_html;

        }

        /**
         *
         * Returns Prince Range Of Products depending on the selected styles or types
         *
         * @param string $styles_array  Selected Styles
         * @param string $types_array  Selected Types
         * @return string
         */
        public function GetPriceRange($styles_array = "", $types_array = "") {


        $price_range = 0;
        $prices_array = array();

            if ($styles_array != '') {

                foreach($this->product_json as $obj){


                    if (in_array($obj["Style"], $styles_array)) {
                        array_push($prices_array, $obj["Price"]);
                    }

                }

            } else if ($types_array != "") {

                foreach($this->product_json as $obj){


                    if (in_array($obj["TypeID"], $types_array)) {
                        array_push($prices_array, $obj["Price"]);
                    }

                }

            }

            $price_range = min($prices_array)." : ".max($prices_array);

            return $price_range;

        }


        /**
         *
         * Returns total products found depending on the selected styles or types
         *
         * @param string $styles_array  Selected Styles
         * @param string $types_array  Selected Types
         * @return string
         */
        public function GetCounterByFilter($styles_array = "", $types_array = "") {


            $products_array = array();

            if ($styles_array != '') {

                foreach($this->product_json as $obj){


                    if (in_array($obj["Style"], $styles_array)) {
                        array_push($products_array, $obj["Price"]);
                    }

                }

            } else if ($types_array != "") {

                foreach($this->product_json as $obj){


                    if (in_array($obj["TypeID"], $types_array)) {
                        array_push($products_array, $obj["Price"]);
                    }

                }

            }

            return sizeof($products_array);

        }


        /**
         *
         * Returns total products found depending on the selected styles or types or min or max price
         *
         * @param string $styles  Selected Styles
         * @param string $types  Selected Types
         * @param string $min  Selected Min Price
         * @param string $max  Selected Max Price
         * @return string
         */
        public function GetResultsCounter($styles = "", $types = "", $min, $max) {

            $products_array = array();
            $style_array = $styles;
            $type_array = $types;

            $price_min = $min;
            $price_max = $max;



            // Filter through results
            foreach($this->product_json as $obj){

                //check the price before it gets pushed into the new array

                if ($obj["Price"] >= $price_min && $obj["Price"] <= $price_max) {

                    if (isset($types) && $types != "") {
                        if (in_array($obj["TypeID"], $type_array)) {
                            array_push($products_array, array("ProductID" => $obj["ProductID"], "ProductName" => $obj["ProductName"], "Style" => $obj["Style"], "Type" => $obj["Type"], "Price" => $obj["Price"]));
                        }
                    } else {
                        if (in_array($obj["Style"], $style_array)) {
                            array_push($products_array, array("ProductID" => $obj["ProductID"], "ProductName" => $obj["ProductName"], "Style" => $obj["Style"], "Type" => $obj["Type"], "Price" => $obj["Price"]));
                        }
                    }

                }

            }



            return sizeof($products_array);

        }



        /**
         *
         * Returns the results depending on the selected styles or types or min or max price
         *
         *
         * @return string
         */
        public function GetResults() {

            $products_array = array();
            $style_array = $_REQUEST["ShoeStyle"];
            $type_array = $_REQUEST["ShoeType"];
            $price_range = $_REQUEST["amount"];

            //removes characters from string and split into min and max
            $price_array = explode(" - ", str_replace("R", "", $price_range));
            $price_min = $price_array[0];
            $price_max = $price_array[1];



            // Filter through results
            foreach($this->product_json as $obj){

                //check the price before it gets pushed into the new array

                if ($obj["Price"] >= $price_min && $obj["Price"] <= $price_max) {

                    if (isset($_REQUEST["ShoeType"])) {
                        if (in_array($obj["TypeID"], $type_array)) {
                            array_push($products_array, array("ProductID" => $obj["ProductID"], "ProductName" => $obj["ProductName"], "Style" => $obj["Style"], "Type" => $obj["Type"], "Price" => $obj["Price"]));
                        }
                    } else {
                        if (in_array($obj["Style"], $style_array)) {
                            array_push($products_array, array("ProductID" => $obj["ProductID"], "ProductName" => $obj["ProductName"], "Style" => $obj["Style"], "Type" => $obj["Type"], "Price" => $obj["Price"]));
                        }
                    }

                }

            }

            $results_html = '';
            foreach($products_array as $product){
                $results_html .= '<a href="#" class="list-group-item">'.$product["ProductID"].' '.$product["ProductName"].' ('.$product["Style"].' - '.$product["Type"].')<span>Price : R'.$product["Price"].'</span></a>';
            }


            // default if none was selected

            if (sizeof($products_array) < 1) {
                foreach($this->product_json as $obj){
                    $results_html .= '<a href="#" class="list-group-item">'.$obj["ProductID"].' '.$obj["ProductName"].' ('.$obj["Style"].' - '.$obj["Type"].')<span>Price : R'.$obj["Price"].'</span></a>';
                }
            }

            echo $results_html;

        }

        /**
         *
         * Returns total products found
         *
         * @param string $product_array  list of products
         * @return number
         */
        public function GetTotalProducts($product_array = "") {
            if ($product_array != "") {
                return sizeof($product_array);
            } else {
                //default home page.
                return sizeof($this->product_json);
            }
        }

    }

}