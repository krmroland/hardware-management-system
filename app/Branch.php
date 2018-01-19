<?php

namespace App;

use Illuminate\Validation\Rule;

class Branch extends BaseModel
{
    /**
     * boot the application.
     */
    public static function boot()
    {
        return static::creating(function ($model) {
            cache()->flush();
        });
    }

    /**
     * Determines if it has some.
     *
     * @return bool
     */
    public static function hasSome()
    {
        return cache()->rememberForever('branches.count', function () {
            return (bool) static::count();
        });
    }

    /**
     * users that belong to a branch.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'branch_users')
        ->withPivot('isDefault')
        ->latest('isDefault')
        ->using(BranchUser::class);
    }

    /**
     * all the branches.
     *
     * @param array $columns
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function all($columns = [])
    {
        return cache()->rememberForever('brnaches.all', function () {
            return static::oldest('name')->get();
        });
    }

    /**
     * Gets the data by identifier.
     *
     * @param int $id
     *
     * @return slef
     */
    public static function getDataById($id)
    {
        return static::where(compact('id'))->summarize()
                    ->firstOrFail()->mergeProductSummary();
    }

    /**
     * add branch summary.
     *
     * @param Illuminate\Database\Query\Builder $builder
     *
     * @return Illuminate\Database\Schema\Builder
     */
    public function scopeSummarize($builder)
    {
        return $builder->withCount('products', 'customers', 'suppliers')->with('users');
    }

    /**
     * Gets the summary.
     *
     * @return Illuminate\Support\Collection
     */
    public static function getSummary()
    {
        return static::oldest('name')->summarize()->get()
                      ->map([new static(), 'mergeProductSummary']);
    }

    /**
     * merge a branch with the associated products summary.
     *
     * @param int $branch
     *
     * @return int
     */
    public function mergeProductSummary($branch = null)
    {
        $branch = $branch ?: $this;

        $products = Product::summary();
        $branch['capital'] = 0;
        $branch['expectedCash'] = 0;

        if (isset($products[$branch->id])) {
            $product = $products[$branch->id];

            $branch['capital'] = data_get($product, 'capital', 0);

            $branch['expectedCash'] = data_get($product, 'expectedCash', 0);
        }

        $branch['expectedProfit'] = $branch['expectedCash'] - $branch['capital'];

        return $branch;
    }

    /**
     * a branch has many products.
     *
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * a branch has many customers.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * a branch has many suppliers.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    /**
     * adding User rules.
     *
     * @return array
     */
    public function addingUserRules()
    {
        return  [
               'user_id' => [
                    'required',
                    'numeric',
                     Rule::unique('branch_users')->where(function ($query) {
                         return $query->where('branch_id', $this->id);
                     }),
                   ],
                ];
    }
}
