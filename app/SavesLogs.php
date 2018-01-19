<?php

namespace App;

trait SavesLogs
{
    public static function bootSavesLogs()
    {
        static::created(function ($model) {
            return $model->log();
        });
    }

    public function log()
    {
        Log::Create(
            [
              'date' => date('Y-m-d'),
              'logger_id' => $this->getKey(),
              'logger_type' => get_class($this),
              'user_id' => auth()->id(),
            ]
        );
    }
}
