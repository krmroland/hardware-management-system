<?php

namespace App\Products;

use Illuminate\Http\Request;

trait ValidatesProductTransaction
{
    public function validateData(Request $request)
    {
        $request->validate(['date' => 'required|date', 'cartItems' => 'required']);
    }
}
