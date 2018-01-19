<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BranchUser extends Pivot
{
    /**
     * turn off the timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function activate($branch)
    {
        $this->branch = $branch;
        $this->isDefault = true;
        $this->save();
        $this->deactivateAllExcept($branch);
        cache()->flush();
    }

    protected function branchExists($branch)
    {
        return $this->user->hasBranch($branch);
    }

    public function setBranchAttribute($branch)
    {
        $this->attributes['branch_id'] = $branch->id;
        $this->setRelation('branch', $branch);
    }
}
