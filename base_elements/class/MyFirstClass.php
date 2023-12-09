<?php

class MyFirstClass
{
    public $name;

    private $age;

    public function setAge(int $age)
    {
        $this->age = $age;
    }

    public function getAge() : int
    {
        return  $this->age;
    }



    public function __toString(): string
    {
        return " $this->name - $this->age ";
    }

}
