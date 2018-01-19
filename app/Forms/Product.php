<?php

namespace App\Forms;

use App\Category;
use Lawma\Forms\Form;

class Product extends Form
{
    public function __construct()
    {
        $categories = Category::getAll();
        $selectedId = old('category_id', 0);
        $this->textField()
              ->label('The Products Name')
              ->name('name');

        // dd("<category-selector :data='$categories' :selected-id='$selectedId'></category-selector>");
        $this->customField()
              ->html("<category-selector :data='$categories' :selected-id='$selectedId'></category-selector>");

        $this->textField()
              ->name('unitName')
              ->label('Products Unit Name eg kg for nails');

        $this->textField()
             ->name('unitBundle')
             ->label('Products Unit bundle eg sack for nails');

        $this->numberField()
             ->name('unitsPerBundle')
             ->label('The number of units in a bundle eg 50 kg in a sack');

        $this->button()->text('Save Product');
    }
}
