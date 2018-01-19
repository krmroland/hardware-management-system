<?php

namespace App\Observers;

class SaleObserver extends TradeObserver
{
    /**
     * The adjusted product after transaction.
     *
     * @return array
     */
    public function adjustedProduct()
    {
        return ['availableQuantity' => $this->totalQuantity()];
    }

    protected function totalQuantity()
    {
        return $this->product->availableQuantity - $this->newQuantity;
    }
}
