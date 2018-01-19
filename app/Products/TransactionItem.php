<?php

namespace App\Products;

class TransactionItem
{
    protected $detail;

    protected $product;

    public function __construct(Transaction $transaction, Product $product, $detail)
    {
        $this->detail = $detail;

        $this->product = $product;

        $this->detail->product_id = $product->getKey();

        $this->detail->transaction_id = $transaction->getKey();

        $this->transaction = $transaction;
    }

    public function product()
    {
        return $this->product;
    }

    public function __call($method, $args)
    {
        $this->detail->{$method}($this->product);

        return $this;
    }

    public function details()
    {
        return $this->detail;
    }
}
