<?php

namespace App;

class TransactionItem extends BaseModel
{
    use InteractsWithBranches;

    public $timestamps = false;

    public function detail()
    {
        return $this->morphTo('detail');
    }

    public function getActionNameAttribute()
    {
        return strtolower(class_basename($this->detail_type));
    }

    public function delete()
    {
        $this->detail->delete();

        parent::delete();
    }
}
