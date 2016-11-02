<?php

namespace App\Controllers;

use \Framework\Controllers\{
    Controller,
    Validate,
    Request,
    Response,
    Auth
};
use \Framework\Models\Model;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'name',
            'name2'
        ];
        $model = Model::get('example', 'register', $data);
        return $this->view('index', [
            'name' => $model
        ]);
    }
}