<?php

require_once '../vendor/autoload.php';


$collection = new \App\Collections\ProductCollection();
// $collection->seed();

$view = new \App\Views\ProductViews();
echo $view->getAllHtml($collection);

//
//echo "<ul>";
//foreach ($collection->getAll() as $product) {
//    echo "<li> $product </li>";
//}
//echo "</ul>";


//$ecoFlow = new \App\Models\ProductModel("EcoFlow Delta 2", 59000);
//
//echo $ecoFlow;
//echo serialize($ecoFlow);




