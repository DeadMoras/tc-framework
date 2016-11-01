<?php

namespace App\Models;

use \Framework\Models\Model;

class User extends Model
{
    public $data;

    public function register($data)
    {
        foreach ($data as $key => $value) {
            echo $value . '<br>';
        }
    }
}
