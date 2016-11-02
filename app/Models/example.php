<?php

namespace app\models;

use \Framework\Models\Model;

class example extends Model
{
    public $all;
    
    public function register($data)
    {
        foreach ( $data as $key ) {
            $this->all[] = $key;
        }
        return $this->all;
    }
}