<?php

require_once '../vendor/autoload.php';


$collection = new \App\Collections\ProductCollection();
// $collection->seed();


$newProduct = \App\Requests\ProductCreateRequest::getProduct();
if ($newProduct) {
    $collection->addProduct($newProduct);
}

$view = new \App\Views\ProductViews();
echo $view->getAllHtml($collection);

$form = new \App\Forms\ProductForm();
$form->echoForm();

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




