<?php

namespace Lawma\Forms;

class Radio extends MultiOptional
{
    /**
     * The view path for the radio field.
     *
     * @return string
     */
    public function viewPath()
    {
        return 'forms::radioField';
    }
}
