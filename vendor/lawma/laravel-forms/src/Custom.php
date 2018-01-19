<?php

namespace Lawma\Forms;

class Custom extends Field
{
    public $html = '';

    public function viewPath()
    {
        return 'forms::customField';
    }

    public function html($html)
    {
        $this->setProperty('html', $html);
    }
}
