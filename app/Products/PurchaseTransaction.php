<?php

namespace App\Products;

use App\Purchase;

class PurchaseTransaction extends ProductTransaction
{
    protected $purchase;

    /**
     * the type of the transaction.
     *
     * @return string
     */
    public function type()
    {
        return 'purchase';
    }

    /**
     * saves the purchase.
     */
    public function processItem($transaction_id, $data)
    {
        $this->savePurchase($transaction_id, $data);
        //$purchase = Purchase::create($this->prepare($data, $transaction_id));
    }

    public function savePurchase(...$args)
    {
        $this->purchase = Purchase::create($this->preparePurchaseData(...$args));

        return $this;
    }

    protected function preparePurchaseData($transaction_id, $data)
    {
        return  [
        'product_id' => $data['data']['product_id'],
        'quantity' => $data['totalQuantity'],
        'paid' => intval($data['paid']),
        'supplier_id' => array_get($data, 'supplier.id'),
        'boughtAt' => $data['boughtAt'],
        'toSaleAt' => $data['toSaleAt'],
        'subTotal' => $data['subTotal'],
        'transaction_id' => $transaction_id,
        ];
    }

    public function updateProductsVariables()
    {
        $this->purchase->adjustProduct();
    }
}
