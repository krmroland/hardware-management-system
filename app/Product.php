<?php

namespace App;

use App\Products\Bundler;
use App\Products\Adjustment;
use App\Filters\IsFilterable;
use Illuminate\Support\Facades\DB;

class Product extends BaseModel
{
    use IsFilterable,InteractsWithBranches;

    protected static $summary;

    /**
     * @var array
     */
    protected $appends = ['bundle'];

    /**
     * search the products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $name
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($builder, $name)
    {
        if (isset(static::$summary)) {
            return static::$summary;
        }

        return static::$summary = $builder->where('name', 'like', "%$name%")
                      ->oldest('name')
                       ->limit(10);
    }

    /**
     * Gets the bundle attribute.
     *
     * @return Bundler
     */
    public function getBundleAttribute()
    {
        return new Bundler($this);
    }

    /**
     * the products summary.
     *
     * @return Summary
     */
    public static function summary()
    {
        return static::selectRaw(
            'branch_id,
            id,
            sum(buyingPrice*availableQuantity) as capital,
            count(*) as products_count,
            sum(sellingPrice*availableQuantity) as expectedCash'
        )->groupBy('branch_id')->get()->keyBy('branch_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function persist($attributes = [])
    {
        $this->create($attributes);

        return $this;
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id', 'product_id')->limit(200);
    }

    public function delete()
    {
        $this->adjustments()->delete();

        DB::transaction(function () {
            $this->variables()->delete();
            $transaction_ids = $this->transactionDetails()->pluck('transaction_id');
            DB::table('transaction_details')->whereIn('transaction_id', $transaction_ids)->delete();
            DB::table('transactions')->whereIn('id', $transaction_ids)->delete();
            parent::delete();
        });
    }

    public function adjustments()
    {
        return $this->hasMany(Adjustment::class);
    }

    public function loadDetails()
    {
        return $this->leftJoin('product_adjustments', 'product_adjustments.product_id', 'products.id')
                    ->get();
    }

    public function loadTransactions()
    {
        return DB::table('trades')->where(['product_id' => $this->id])
            ->get()->map(function ($transaction) {
                return resolve($transaction->type)
                        ->fill((array) $transaction)
                        ->loadMissing('payment', 'client', 'productAdjustment');
            });
    }

    public static function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'unitName' => 'required',
            'bundleName' => 'nullable',
            'category' => 'nullable',
            'unitsPerBundle' => 'required',
        ];
    }
}
