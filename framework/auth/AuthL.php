<?php

namespace framework\auth;

use framework\other\Config;
use framework\other\Cookie;
use framework\other\Csrf;

class AuthL
{
    /**
     *
     * @param array $in_db
     * @param array $data
     * @return boolean
     */
    protected function userInfo($in_db, $data)
    {
        $user = \DB::table('users')->select('password')->where($in_db[0], '=', $data[0])->first();
        if ( $user == null ) {
            return false;
        } else {
            return $this->otherLogic($user, $data);
        }
    }

    /**
     * @param array $user
     * @param array $data
     * @return bool|void
     */
    private function otherLogic($user, $data)
    {
        if ( password_verify($data[1], $user->password) ) {
            return $this->takeInfo($data);
        } else {
            echo Config::get('validate_rules.notincorrectpassword');

            return false;
        }
    }

    /**
     *
     * @param array $data
     * @return void
     */
    private function takeInfo($data)
    {
        $token = $this->generateToken();
        $dataInfo = ['token' => $token];
        \DB::table('users')->where('login', '=', $data[0])->update($dataInfo);

        $userInfo = \DB::table('users')->select('id', 'token')->where('login', '=', $data[0])->first();

        return $this->setInfo($userInfo, $token);
    }

    /**
     *
     * @param array $user
     * @return boolean
     */
    private function setInfo($user, $token)
    {
        $newToken = Csrf::instance()->generate($token);
        Cookie::instance()->set('csrf', $newToken);
        foreach ( $user as $k => $v ) {
            $this->user[$k] = $v;
            Cookie::instance()->set($k, $v);
        }

        return true;
    }

    /**
     *
     * @return boolean
     */
    protected function checkLogic()
    {
        $result = \DB::table('users')->select('id')->where('id', '=', Cookie::instance()->get('id'))->where('token', '=', Cookie::instance()->get('token'))->first();
        if ( $result == null && $result == false ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *
     * @param int|number $length
     * @return string
     */
    public function generateToken($length = 20)
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ( $i = 0; $i < $length; $i++ ) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }

        return $string;
    }
}
