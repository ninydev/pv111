<?php

namespace Lib\FormBuilder;

use Lib\FormBuilder\Inputs\Input;

class Form
{
    public function __construct(
        public $method = null,
        public $action = null
    )
    {

        if (!$this->method)
            $this->method = 'POST';
        if (!$this->action)
            $this->action =  $_SERVER['PHP_SELF'];
    }

    private $inputs = [];

    public function add(Input $input) : Form
    {
        $this->inputs[] = $input;
        return $this;
    }

    public function __toString(): string
    {
        $result = "<form method='$this->method' action='$this->action' >\n";
        foreach ($this->inputs as $input) {
            if ($input instanceof Input) {
                $result.= $input;
            }
        }
        $result.= "</form>\n";

        return $result;
    }

}
