<?php

namespace App\Products;

use App\Product;
use App\BaseModel;
use App\InteractsWithBranches;

class Adjustment extends BaseModel
{
    use InteractsWithBranches;

    protected $table = 'product_adjustments';

    protected $with = ['product'];

    /**
     * The attributes that should be cast to native types php types.
     *
     * @var array
     */
    protected $casts = ['before' => 'array', 'after' => 'array'];

    public static function adjust(...$args)
    {
        return (new static())->attemptProductChange(...$args);
    }

    protected function attemptProductChange($product_id, $adjuster, $attributes, $description)
    {
        $this->product_id = $product_id;

        $this->setAdjuster($adjuster);

        $product = $this->product;

        $before = $product->getAttributes();

        if ($changed = $product->fill($attributes)->getDirty()) {
            $this->before = array_intersect_key($before, $changed);
            $this->after = $changed;
            $this->description = $description;
            $this->user_id = auth()->id();
            $this->save();
            $product->save();
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([]);
    }

    protected function setAdjuster($model)
    {
        $this->adjustment_type = get_class($model);
        $this->adjustment_id = $model->getKey();
    }

    public function getBeforeAttribute($before)
    {
        return $this->product->fill($this->fromJson($before) ?? []);
    }

    public function getAfterAttribute($after)
    {
        return $this->product->fill($this->fromJson($after) ?? []);
    }

    public function getNewAttribute()
    {
        $data = optional($this->adjuster)->asProduct() ?? [];

        return $this->product->fill($data);
    }

    public function adjuster()
    {
        return $this->morphTo('adjustment');
    }
}
