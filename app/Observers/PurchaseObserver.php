<?php

namespace App\Observers;

class PurchaseObserver extends TradeObserver
{
    public function adjustedProduct()
    {
        return [
            'availableQuantity' => $this->totalQuantity(),
            'buyingPrice' => $this->newBuyingPrice(),
            'sellingPrice' => $this->newSellingPrice(),
        ];
    }

    public function totalQuantity()
    {
        return $this->product->availableQuantity + $this->newQuantity;
    }

    /**
     * the new buying price of the related product.
     *
     * @return int
     */
    protected function newBuyingPrice()
    {
        return $this->adjustedPrice($this->product->buyingPrice, $this->buyingPrice);
    }

    /**
     * the adjusted price after a transaction.
     *
     * @param int $existingPrice
     * @param int $newPrice
     *
     * @return bool
     */
    protected function adjustedPrice($existingPrice, $newPrice)
    {
        //if we are creating and the prices are the same then we wont change the prices
        return $this->eventDescription == 'created_purchase' && $existingPrice == $newPrice ? $existingPrice :
        $this->aggregatedPrice($existingPrice, $newPrice);
    }

    /**
     * make an aggregate of the existing and new prices.
     *
     * @param int $existingPrice The existing price
     * @param int $newPrice      The new price
     *
     * @return int the aggregated price
     */
    protected function aggregatedPrice($existingPrice, $newPrice)
    {
        $numerator = $this->newGrandTotal($newPrice) + $this->existingGrandTotal($existingPrice);

        return $this->totalQuantity() == 0 ?: round($numerator / $this->totalQuantity(), 1);
    }

    /**
     * the new selling price of the related product.
     *
     * @return int
     */
    protected function newSellingPrice()
    {
        return $this->adjustedPrice($this->product->sellingPrice, $this->sellingPrice);
    }

    /**
     * the existing grand total of a given price .
     *
     * @param int $existingPrice The price e.g selling price or buying price
     *
     * @return int
     */
    protected function existingGrandTotal($existingPrice)
    {
        return $this->product->availableQuantity * $existingPrice;
    }

    /**
     * the new Grand total of any given price.
     *
     * @param int $newPrice
     *
     * @return int
     */
    protected function newGrandTotal($newPrice)
    {
        return $this->newQuantity * $newPrice;
    }
}
