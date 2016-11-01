<?php

namespace Framework\Controllers;

use \Framework\Controllers\{
    Request,
    Response,
    Validate
};
use \Framework\Different\Cookie;

class Auth
{

    private static $user;

    public static function attempt(array $data)
    {
        $authKeys = array_keys($data);
        $authData = array_values($data);

        $info = \DB::table('users')
                ->select('password')
                ->where($authKeys[0], '=', $authData[0])
                ->first();
        if ($info == NULL) {
            echo \Framework\Different\Config::get('errors_messages.no_user_attempt');
            return false;
        } else {
            foreach ($info as $key => $value) {
                if (password_verify($authData[1], $info->password)) {
                    $token = static::generateToken();

                    $data = [
                        'token' => $token
                    ];

                    \DB::table('users')->where('login', '=', $authData[0])->update($data);
                    $userInfo = \DB::table('users')
                            ->select('*')
                            ->where('login', '=', $authData[0])
                            ->first();

                    foreach ($userInfo as $k => $v) {
                        self::$user[$k] = $v;
                        Cookie::set($k, $v);
                    }
                    Response::responseUrl('/');
                    return true;
                } else {
                    echo \Framework\Different\Config::get('errors_messages.no_correct');
                    return false;
                }
            }
        }
    }

    public static function check()
    {
        if (!Cookie::has('id') && !Cookie::has('token')) {
            return false;
        }
        $result = \DB::table('users')
                ->select('id')
                ->where('id', '=', Cookie::get('id'))
                ->where('token', '=', Cookie::get('token'))
                ->first();
        if ($result == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function user()
    {
        $other = \DB::table('users')
                ->where('id', '=', Cookie::get('id'))
                ->first();
        if ($other == null) {
            return false;
        }
        foreach ($other as $key => $value) {
            if ($other->$key == Cookie::get($key)) {
                return $other;
            } else {
                $other = Cookie::set($key, $value);
                return $other;
            }
        }
    }

    public static function generateToken($length = 20)
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

}
