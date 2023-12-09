<?php

class MyMagicClass
{
    private $data = [];

    public function __get(string $name)
    {
        echo 'try get: ' . $name;
        if (isset($this->data[$name]))
            return $this->data[$name];
        return null;
    }

    public function __set(string $name, $value): void
    {
        echo 'try set: ' . $name . ' = ' . $value;
        $this->data[$name] = $value;
    }

}
