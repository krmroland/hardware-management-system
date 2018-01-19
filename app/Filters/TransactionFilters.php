<?php

namespace App\Filters;

class TransactionFilters extends BaseFilter
{
    protected $filters = ['type'];

    public function type($type)
    {
        return $this->$type()->groupBy("$type.transaction_id");
    }

    protected function purchases()
    {
        return $this->builder
                ->leftJoin('purchases', 'product_transactions.id', 'purchases.transaction_id')
                ->selectRaw(' sum(quantity*boughtAt) as grossTotal, product_transactions.*,sum(paid) as amountPaid');
    }

    protected function sales()
    {
        return $this->builder
                ->leftJoin('sales', 'product_transactions.id', 'sales.transaction_id')
                ->selectRaw('
                            sum(quantity*buyingPrice) as grossTotal, 
                            product_transactions.*,sum(paid) as amountPaid,
                            sum(quantity*sellingPrice) as netTotal
                        ');
    }
}
