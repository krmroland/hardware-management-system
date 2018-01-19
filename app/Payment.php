<?php

namespace App;

class Payment extends BaseModel
{
    use InsertsPolymorphicData, InteractsWithBranches;
    /**
     * turn off the model timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $actual = 0;

    public function payer()
    {
        return $this->morphTo();
    }

    public function to(Client $client)
    {
        $this->setRelation('client', $client);

        return  $this->setMorphs('client', $client);
    }

    public function by(BaseModel $payer)
    {
        return $this->setRelation('payer', $payer)->setMorphs('payer', $payer);
    }

    public function paid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    public function actual($actual)
    {
        $this->actual = $actual;

        return $this;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->setBalances();
        });

        static::deleting(function ($payment) {
            $payment->updateClientsBalance(-1);
        });
    }

    protected function setBalances()
    {
        $this->balanceBefore = $this->client->accountBalance;
        $this->supposedToPay = $this->client->accountBalance + $this->actual;
        $this->excessPay = $this->getExcess();
        $this->balanceAfter = $this->updateClientsBalance();
    }

    public function getExcess()
    {
        return $this->paid - $this->actual;
    }

    /**
     * update the client balance.
     *
     * @param int $magnitude
     *
     * @return int new account balance
     */
    protected function updateClientsBalance($magnitude = 1)
    {
        return $this->client->updateAccountBalance($this->excessPay * $magnitude)->accountBalance;
    }

    public function make()
    {
        $this->save();
    }
}
