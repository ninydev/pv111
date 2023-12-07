<?php
$foo = 'Боб';              // Присваивает $foo значение 'Боб'
$bar = &$foo;              // Ссылка на $foo через $bar.
$bar = "Меня зовут $bar";  // Изменение $bar...
echo "<hr>\n";
echo $bar;
echo "<hr>\n";
echo $foo;                 // меняет и $foo.
