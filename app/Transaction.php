<?php

namespace App;

use App\Filters\IsFilterable;
use App\Products\TradeTransaction;

class Transaction extends BaseModel
{
    use IsFilterable,HasDates,InteractsWithBranches;

    /**
     * the fields to be treated as dates.
     *
     * @var array
     */
    protected $dates = ['date'];

    /**
     * make a product purchase.
     *
     * @return App\Products\TradeTransaction
     */
    public static function makeAPurchase()
    {
        return ( new static())->trade(new Purchase());
    }

    /**
     * Makes a sale.
     */
    public static function makeASale()
    {
        return (new static())->trade(new Sale());
    }

    /**
     * makes a trade transaction.
     *
     * @param App\Trade $trade
     */
    public function trade(Trade $trade)
    {
        return app(TradeTransaction::class)->make($this->make(), $trade);
    }

    public function scopeDetails($builder)
    {
        return $this->{$this->type};
    }

    public function purchases($builder)
    {
        return $this->hasMany();
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function scopeSummaryFor($builder, $type)
    {
        $builder->whereHas('items', function ($query) use ($type) {
            $query->where('detail_type', get_class($type));
        });
    }

    public function delete()
    {
        $this->items->each->delete();
        parent::delete();
    }

    /**
     * the initial Data for creating a transaction.
     *
     * @return array
     */
    public static function initialData(Trade $trade)
    {
        return json_encode([
            'products' => Product::oldest('name')->get(),
            'clients' => app($trade->clientType())->getAll(),
            ]);
    }

    /**
     * Sets the transaction id.
     *
     * @return self
     */
    protected function make()
    {
        $this->date = app('request')->date ?: date('Y-m-d');

        return tap($this)->save();
    }

    public function addItem($item)
    {
        return $this->items()->create($this->processItem($item));
    }

    protected function processItem(BaseModel $item)
    {
        return ['detail_type' => get_class($item), 'detail_id' => $item->getKey()];
    }

    public function loadDetails()
    {
        $this->loadMissing('items.detail');
        if ($this->items->first()->detail instanceof Trade) {
            $this->loadMissing('items.detail.payment', 'items.detail.client', 'items.detail.productAdjustment');
        }

        //$this->load('details.client', 'details.productAdjustment', 'details.payment')
    }
}
