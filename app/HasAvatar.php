<?php

namespace App;

use App\Services\Image;

trait HasAvatar
{
    /**
     * Gets the avatar attribute.
     *
     * @return ImaApp\Services\Image
     */
    public function getAvatarAttribute()
    {
        return new Image($this->getTable(), "$this->id.jpg");
    }
}
