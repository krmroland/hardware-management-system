<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasAvatar;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phoneNumber', 'isAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['isAdmin' => 'boolean'];

    public static function boot()
    {
        static::creating(function ($user) {
            $user->password ?: $user->password = bcrypt(company()->get('defaultPassword'));
        });
    }

    public function isAdmin()
    {
        if ($this->isAdmin) {
            return true;
        }
        //if we have only one user we will make him an admin.

        $userCount = cache()->rememberForever('users.count', function () {
            return static::count();
        });

        if ($userCount == 1) {
            $this->isAdmin = true;

            return $this->save();
        }

        return false;
    }

    public function hasAtleastABranch()
    {
        return $this->isAdmin ?: cache()->rememberForever("users.$this->id", function () {
            return (bool) $this->branches()->count();
        });
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_users')
                    ->withPivot('isDefault')
                    ->latest('isDefault')
                    ->using(BranchUser::class);
    }

    public function activeBranch()
    {
        return cache()->rememberForever("user.activeBranch.$this->id", function () {
            if ($this->branches()->exists()) {
                return $this->branches->first();
            }
            if ($this->isAdmin()) {
                return Branch::first();
            }
            throw new \Exception('You have no branches');
        });
    }

    public function allBranches()
    {
        return cache()->rememberForever("user.branches.$this->id", function () {
            return $this->isAdmin() ? Branch::all() : $this->branches;
        });
    }

    public function allBranchesWithSummary()
    {
        return cache()->rememberForever("user.branchesWithSummary.$this->id", function () {
            return $this->allBranches()->map([new static(), 'mergeProductSummary']);
        });
    }

    public function activateBranch($branch)
    {
        if ($userBranch = $this->findBranch($branch)) {
            $this->branches()->updateExistingPivot($branch->id, ['isDefault' => true]);
        } else {
            $this->branches()->attach($branch, ['isDefault' => true]);
        }

        $this->deActivateAllBranchesExcept($branch);

        cache()->flush();
    }

    public function branchInstance()
    {
        return $this->branches()->make()->setRelation('user', $this);
    }

    public function findBranch(Branch $branch)
    {
        return $this->branches()->find($branch->id);
    }

    public function deActivateAllBranchesExcept($branch)
    {
        return DB::table('branch_users')->where('branch_id', '!=', $branch->id)
                          ->where(['user_id' => $this->id])
                          ->update(['isDefault' => false]);
    }

    public static function all($columns = [])
    {
        return cache()->rememberForever('users.all', function () {
            return static::latest('name')->get();
        });
    }
}
