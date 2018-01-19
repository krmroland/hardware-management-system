<?php

namespace App;

class Finance extends BaseModel
{
    use InsertsPolymorphicData,InteractsWithBranches;

    public static function to(Client $client)
    {
        return (new static())->setClient($client);
    }

    public function make($data)
    {
        return tap($this->fill($data))->save();
    }

    protected function setClient(Client $client)
    {
        return $this->setRelation('client', $client)->setMorphs('client', $client);
    }

    public function payableAmount()
    {
        return $this->amount;
    }

    public function client()
    {
        return $this->morphTo(Client::class)->withDefault([]);
    }

    public function getActionNameAttribute()
    {
        return strtolower(class_basename($this));
    }

    public function supposedToPay()
    {
        return $this->client->accountBalance;
    }

    public function getDescriptionAttribute()
    {
        return sprintf('Made a payment of %s', $this->amount);
    }
}
