<?php

namespace Lawma\Forms;

class Text extends Field
{
    public $type = 'text';

    public function viewPath()
    {
        return 'forms::textField';
    }

    public function type($type)
    {
        return $this->setProperty('type', $type);
    }
}
