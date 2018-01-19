<?php

namespace App;

trait InsertsPolymorphicData
{
    /**
     * Sets the morphs.
     *
     * @param string         $key
     * @param \App\BaseModel $model
     *
     * @return self
     */
    public function setMorphs($key, BaseModel $model)
    {
        return $this->setProp("{$key}_type", get_class($model))
                     ->setProp("{$key}_id", $model->getKey());
    }

    /**
     * Sets the property.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return self
     */
    public function setProp($key, $value)
    {
        $this->$key = $value;

        return $this;
    }
}
