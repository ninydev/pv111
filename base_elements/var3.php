<?php

$v1 = 2;
$v2 = "2";

echo $v1 . $v2;
echo "<hr>";
echo $v1 + $v2;
echo "$v1 $v2";
echo '$v1 $v2';

echo "<hr>";
echo $v2 + $v1;

$v3 = "abc";

try {
    echo $v2 + $v3;
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
} finally {
    echo "Result ";
}

echo "finish";
