<?php

namespace App;

trait HasDates
{
    /**
     * Gets the date attribute.
     *
     * @param string $date
     *
     * @return string the date attribute
     */
    public function getDateAttribute($date)
    {
        return !$date ?: $this->asDateTime($date)->format('D d-m-Y ');
    }

    /**
     * Gets the created at attribute.
     *
     * @param string The date
     *
     * @return string The created at attribute
     */
    public function getCreatedAtAttribute($date)
    {
        return !$date ?: $this->asDateTime($date)->diffForHumans();
    }
}
