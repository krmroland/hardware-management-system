<?php

namespace Lawma\Forms;

class CheckboxField extends MultiOptional
{
    public function viewPath()
    {
        return 'forms::checkboxField';
    }

    public function isSelected($option)
    {
        return in_array($option, array_wrap($this->getValue()));
    }
}
