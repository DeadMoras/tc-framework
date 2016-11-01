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

    public function getIndex()
    {
        // Model::get('User', 'register', 'something');
        return self::view('index');
    }

    public function auth()
    {
        $request = new Request();
        if (Auth::attempt(['login' => $request->input('login'), 'password' => $request->input('password')])) {
            // echo 'true';
        }
    }

}
