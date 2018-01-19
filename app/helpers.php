<?php

use App\Configuration;

function company($key = null, $default = null)
{
    if (is_null($key)) {
        return resolve(Configuration::class);
    }

    if (is_array($key)) {
        return resolve(Configuration::class)->set($key);
    }

    return resolve(Configuration::class)->get($key, $default);
}

function sentence_case($str)
{
    return ucfirst(str_replace('-', ' ', kebab_case($str)));
}

/**
 * flash a message to the session.
 *
 * @param string $message
 * @param string $type
 */
function flash($message, $type = 'success')
{
    session()->flash('flash-data', json_encode(compact('message', 'type')));
}

function nf()
{
    try {
        return number_format(...func_get_args());
    } catch (\Exception $e) {
        return array_first(func_get_args());
    }
}
