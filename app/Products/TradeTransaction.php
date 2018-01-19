<?php

namespace App\Products;

use App\Trade;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeTransaction
{
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;
    /**
     * @var App\Transaction
     */
    protected $transaction;
    /**
     * @var App\Trade
     */
    protected $trade;

    /**
     * creates an instance of the transaction class.
     *
     * @param Request $request The request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * save the items.
     */
    protected function processAllItems()
    {
        DB::transaction(function () {
            $this->getCartItems()->map(function ($item) {
                $this->saveTransactionItem($item);
            });
        });
    }

    protected function saveTransactionItem($item)
    {
        $traded = $this->trade->store($this->extractTransactionDetailData($item));

        $this->transaction->addItem($traded);
    }

    /**
     * Gets the items.
     *
     * @return array the items
     */
    protected function getCartItems()
    {
        return collect(json_decode($this->request->cartItems, true));
    }

    /**
     * make a transaction.
     *
     * @param Transactable $trade
     */
    public function make(Transaction $transaction, Trade $trade)
    {
        $this->trade = $trade;

        $this->transaction = $transaction;

        $this->processAllItems();
    }

    protected function extractTransactionDetailData($data)
    {
        return array_only($data, ['product_id', 'paid', 'subTotal', 'sellingPrice', 'client_id', 'buyingPrice', 'receipt']) + [
            'quantity' => $data['totalQuantity'],
            'client_type' => $this->trade->clientType(),
            'date' => $this->request->date,
        ];
    }
}
