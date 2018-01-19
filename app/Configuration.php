<?php

namespace App;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Storage;

class Configuration extends Repository implements \JsonSerializable
{
    /**
     * Create a new configuration repository.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $this->readFromStorage();
    }

    /**
     * Set a given configuration value.
     *
     * @param array|string $key
     * @param mixed        $value
     */
    public function set($key, $value = null)
    {
        parent::set($key, $value);

        $this->writeToStorage($this->all());
    }

    /**
     * Reads configuration from storage.
     *
     * @return array
     */
    protected function readFromStorage()
    {
        return json_decode(Storage::get('configuration.json'), true);
    }

    /**
     * Writes to storage.
     *
     * @return bool
     */
    protected function writeToStorage($configurations)
    {
        return Storage::put(
            'configuration.json',
            json_encode($configurations),
            true
        );
    }

    public function jsonSerialize()
    {
        return $this->all();
    }

    public function reset()
    {
        return  $this->writeToStorage(config('company'));
    }

    public function push($key, $value)
    {
        parent::push($key, $value);

        $this->writeToStorage($this->all());
    }

    public function remove($key)
    {
        $data = $this->all();

        array_forget($data, $key);

        $this->writeToStorage($data);
    }
}
