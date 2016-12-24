<?php

namespace app\controller;


class Test extends Controller
{
    public function get()
    {
        $login = 'login';

        $this->view('main.index', ['test' => $login]);
    }
}
