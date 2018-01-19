<?php

namespace App\Products;

class HandlesTransactionEvents
{
    /**
     * @var string
     */
    protected $eventName;
    /**
     * @var App\TransactionItem
     */
    protected $transactionItem;
}
