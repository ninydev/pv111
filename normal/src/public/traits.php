<?php

require_once '../vendor/autoload.php';


$p = new \App\Models\ProductChild("Ravon", 545);
$p->setCreatedAt();
$p->setUpdatedAt();

echo $p->getCreatedAt();
