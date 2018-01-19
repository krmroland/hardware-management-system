<?php

namespace App;

use Exception;
use Illuminate\Auth\AuthenticationException;

trait InteractsWithBranches
{
    /**
     * @var int
     */
    protected static $activeBranchId;

    /**
     * boots interacts with branches.
     */
    public static function bootInteractsWithBranches()
    {
        static::creating(function ($model) {
            $model->branch_id = static::getActiveBrachId();
            cache()->flush();
        });

        static::addGlobalScope('branch', function ($builder) {
            $table = (new static())->getTable();

            return $builder->where(["$table.branch_id" => static::getActiveBrachId()]);
        });
    }

    /**
     * Gets the active brach identifier.
     *
     * @throws \Illuminate\Auth\AuthenticationException (description)
     *
     * @return int the active brach identifier
     */
    public static function getActiveBrachId()
    {
        try {
            if (isset(static::$activeBranchId)) {
                return static::$activeBranchId;
            }

            return static::$activeBranchId = auth()->user()->activeBranch()->id;
        } catch (Exception $e) {
            throw new AuthenticationException();
        }
    }
}
