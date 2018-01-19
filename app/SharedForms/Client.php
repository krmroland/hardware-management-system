<?php

namespace App\SharedForms;

use Lawma\Forms\Form;

class Client extends Form
{
    public function __construct()
    {
        $this->textField()->name('name')->label('Full Name(s)');
        $this->textField()->name('phoneNumber')->label('Phone number');
    }
}
