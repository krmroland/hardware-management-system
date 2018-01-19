<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasDates,InteractsWithBranches;
    /**
     * the mass assignable fields.
     *
     * @var array
     */
    protected $fillable = ['logger_id', 'logger_type', 'description', 'date', 'user_id'];

    public function logger()
    {
        return $this->morphTo();
    }
}
