<?php

namespace App;

abstract class Client extends BaseModel
{
    use InteractsWithBranches,HasAvatar;

    /**
     * appends these attributes on serialization.
     *
     * @var array
     */
    protected $appends = ['avatar'];

    /**
     * explicitly set the table since both the customers and suppliers
     * use the same table.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * the route name for handling urls to the client.
     *
     * @return Image|array|bool|self
     */
    abstract public function routeName();

    /**
     * updates the clients account balance.
     *
     * @param int $amount
     *
     * @return self
     */
    public function updateAccountBalance($amount)
    {
        return  $amount == 0 ? $this : $this->saveNewBalance($amount);
    }

    /**
     * Saves a new balance.
     *
     * @param int $amount =
     *
     * @return self
     */
    public function saveNewBalance($amount)
    {
        return tap($this->fill([
            'accountBalance' => $this->accountBalance + $amount,
        ]))->save();
    }

    /**
     * a client has many payments.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function payments()
    {
        return $this->morphMany(Payment::class, 'client');
    }

    /**
     * Gets the route path attribute.
     *
     * @return string the
     */
    public function getRoutePathAttribute()
    {
        return route($this->routeName(), $this);
    }

    /**
     * gets all the clients.
     *
     * @return Illuminate\Support\Collection
     */
    public function getAll()
    {
        return cache()->rememberForever($this->getType(), function () {
            return $this->oldest('name')->get();
        });
    }

    public function scopeOfType($builder, $type = null)
    {
        $builder->where(['client_type' => $type ?: $this->getType()]);
    }

    /**
     * register events when the model is booting.
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('differentiation', function ($builder) {
            return $builder->where('client_type', (new static())->getType());
        });

        //we will clear the cache when any of these events happens to the model
        foreach (['updating', 'creating', 'deleting'] as $event) {
            static::$event(function ($client) {
                cache()->forget($client->getType());
                $client->client_type ?: $client->setType();
            });
        }
    }

    /**
     * Gets the type.
     *
     * @return string
     */
    protected function getType()
    {
        return get_class($this);
    }

    /**
     * Sets the client type.
     */
    protected function setType()
    {
        $this->client_type = $this->getType();
    }

    public function transactionDetails()
    {
        $this->loadMissing('payments.payer');

        if ($this->payments) {
            return $this;
        }
        if ($this->payments->first()->payer instanceof Trade) {
            $this->loadMissing('payments.payer.transaction', 'payments.payer.productAdjustment');
        }

        return $this;
    }

    public function handlePayment($data)
    {
        $finance = Finance::to($this)->make($data);

        app(Payment::class)
        ->to($this)
        ->by($finance)
        ->actual(0)
        ->paid($finance->amount)
        ->make();
    }

    public function getLabelAttribute()
    {
        return class_basename($this);
    }
}
