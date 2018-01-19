<?php

namespace Lawma\Forms;

class Text extends Field
{
    /**
     * the type of the text field.
     *
     * @var string
     */
    public $type = 'text';

    /**
     * the location of the view responsible for the field.
     *
     * @return string
     */
    public function viewPath()
    {
        return 'forms::textField';
    }

    /**
     * the type of the text field.
     *
     * @param string $type
     *
     * @return self
     */
    public function type($type)
    {
        return $this->setProperty('type', $type);
    }
}
