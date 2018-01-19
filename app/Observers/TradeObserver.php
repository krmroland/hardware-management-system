<?php

namespace App\Observers;

use App\Trade;
use App\Payment;
use App\Products\Adjustment;

abstract class TradeObserver
{
    /**
     * @var \App\Trade
     */
    protected $trade;

    /**
     * @var \App\Product
     */
    protected $product;

    /**
     * @var int
     */
    protected $newQuantity;

    /**
     * @var string
     */
    protected $eventDescription;
    /**
     * @var int
     */
    protected $payableAmmount;

    /**
     * the adjusted attributes of the product after transaction.
     *
     * @return array
     */
    abstract public function adjustedProduct();

    /**
     * listen for when trade is made.
     *
     * @param \App\Trade $trade
     */
    public function created(Trade $trade)
    {
        $this->trade = $trade;

        $this->product = $trade->product;
        $this->newQuantity = $trade->quantity;
        $this->eventDescription = $this->makeDescription('created');
        $this->payableAmmount = $trade->paid;
        $this->handleAdjustments()->handlePayments();
    }

    /**
     * listen for when a trade model is being updated.
     *
     * @param \App\Trade $trade
     */
    public function updating(Trade $trade)
    {
        $this->trade = $trade;
        $this->product = $trade->product;
        $this->newQuantity = $trade->quantity - $trade->fresh()->quantity;
        $this->eventDescription = $this->makeDescription('updated');
        $this->payableAmmount = $trade->paid;
        $this->handleAdjustments()->handlePayments();
    }

    /**
     * listen for when a trade model is being deleted.
     *
     * @param \App\Trade $trade The trade
     */
    public function deleting(Trade $trade)
    {
        $this->trade = $trade;
        $this->product = $trade->product;
        $this->newQuantity = $trade->quantity * -1;
        $this->eventDescription = $this->makeDescription('deleted');
        $this->handleAdjustments();

        if ($this->client) {
            $this->trade->payment->delete();
        }
    }

    /**
     * Makes a description.
     *
     * @param string $action
     *
     * @return string
     */
    protected function makeDescription($action)
    {
        return sprintf('%s_%s', $action, $this->trade->actionName);
    }

    /**
     * makes the product adjustments.
     *
     * @return self
     */
    public function handleAdjustments()
    {
        Adjustment::adjust(
            $this->product->id,
            $this->trade,
            $this->adjustedProduct(),
            $this->eventDescription
        );

        return $this;
    }

    /**
     * handles the client payments.
     *
     * @return self
     */
    public function handlePayments()
    {
        if ($this->client) {
            app(Payment::class)
            ->to($this->client)
            ->by($this->trade)
            ->actual($this->subTotal)
            ->paid($this->payableAmmount)
            ->make();
        }

        return $this;
    }

    /**
     * flushes the cache when the object is being destroyed.
     */
    public function __destruct()
    {
        cache()->flush();
    }

    /**
     * dynamically handle unset properties on the classq.
     *
     * @param string $prop
     *
     * @return mixed
     */
    public function __get($prop)
    {
        return $this->trade->$prop;
    }
}
