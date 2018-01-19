<?php

namespace App;

use App\Products\Adjustment;

abstract class Trade extends BaseModel
{
    use HasDates,InteractsWithBranches;

    protected $table = 'trades';
    /**
     * the fields to be treated as dates.
     *
     * @var array
     */
    protected $dates = ['date'];

    /**
     * gets the client type.
     *
     * @return string
     */
    abstract public function clientType();

    /**
     * a transaction detail belongs to a product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productAdjustment()
    {
        return $this->morphOne(Adjustment::class, 'adjustment')->withDefault([]);
    }

    /**
     * Gets the product id.
     *
     * @return int the product id
     */
    public function getProductID()
    {
        return $this->product->id;
    }

    public function asProduct()
    {
        return[
        'availableQuantity' => $this->quantity,
        'buyingPrice' => $this->buyingPrice,
        'sellingPrice' => $this->sellingPrice,
        ];
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'payer');
    }

    public function client()
    {
        return $this->morphTo('client');
    }

    public function isAbleToPay()
    {
        return (bool) $this->client_id;
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function getTransactableAttribute()
    {
        return new $this->transaction->type($this);
    }

    public function getTypeAttribute()
    {
        return $this->transaction->type;
    }

    public function getClientLabelAttribute()
    {
        return strtolower(class_basename($this->client_type));
    }

    public function store($item)
    {
        return tap(new static(), function ($trade) use ($item) {
            $trade->fill($item);
            $trade->type = get_class($trade);
            $trade->save();
        });
    }

    public static function summarizeAll()
    {
        $builder = Transaction::summaryFor(new static());

        return $builder->leftJoin('transaction_items', 'transactions.id', 'transaction_items.transaction_id')
                ->leftJoin('trades', 'trades.id', 'transaction_items.detail_id')
                ->selectRaw(' sum(subTotal) as grossTotal, sum(paid) as total_paid,transactions.*')
                ->groupBy('transaction_items.transaction_id')->get();
    }

    public function getActionNameAttribute()
    {
        return strtolower(class_basename($this));
    }

    public function getDescriptionAttribute()
    {
        return vsprintf(
            'Made a %s of %s each %s totaling %s ',
            [
                $this->actionName,
                $this->productAdjustment->product->name,
                $this->productAdjustment->product->name,
                nf($this->subTotal, 1),
            ]
        );
    }
}
