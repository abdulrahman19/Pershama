<?php

/**
 * App class
 */
class App
{
    public static $registry = [];

    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if(! array_key_exists($key, static::$registry)) {
            throw new Exception('No {$key} found!');
        }

        return static::$registry[$key];
    }
}