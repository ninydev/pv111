<?php
class MyClass {
    private $properties = [];

    public function __construct(...$args) {
        foreach ($args as $arg) {
            $this->properties[] = $arg;
        }
    }

    public function getProperties() {
        return $this->properties;
    }
}

// Пример использования
$obj = new MyClass('Value 1', 'Value 2', 'Value 3');
$properties = $obj->getProperties();

var_dump($properties);
