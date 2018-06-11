<?php

namespace App\Models;

use App\Core\App;

/**
 * 
 */
class Users
{
    
    public static function getAll()
    {
        return App::get('database')->selectAll('users');
    }

    public static function insert($data)
    {
        App::get('database')->insert('users', $data);
        header('Location: /');
    }
}