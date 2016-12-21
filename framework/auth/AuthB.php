<?php

namespace framework\auth;

use framework\auth\AuthInt;
use framework\other\Config;
use framework\other\Cookie;

class AuthB extends AuthL implements AuthInt {
    /**
     *
     * @var array
     */
    private $attemptKeys;

    /**
     *
     * @var array
     */
    private $attemptValues;

    /**
     *
     * @var array
     */
    protected $user = [];

    /**
     *
     * @var array
     */
    private $userAll = [];

    /**
     *
     * @var object
     */
    private static $cookie;

    /**
     *
     * @param array $data
     * @return boolean
     */

    public function attempt(array $data)
    {
        $this->attemptKeys = array_keys($data);
        $this->attemptValues = array_values($data);
        $info = $this->userInfo($this->attemptKeys, $this->attemptValues);
        if( $info !== null && $info !== false ) {
            return true;
        } else {
            echo Config::get('validate_rules.notincorrect');

            return false;
        }
    }

    /**
     *
     * @return boolean
     */
    public function check()
    {
        if( !self::cookie()->has('id') && !self::cookie()->has('token') ) {
            return false;
        }

        return $this->checkLogic();
    }

    /**
     *
     * @return boolean
     */
    public function user()
    {
        if( $this->check() ) {
            return $this->userAllInfo();
        } else {
            return false;
        }
    }

    /**
     * @return array|bool
     */
    private function userAllInfo()
    {
        $all = \DB::table('users')
                ->where('id', '=', self::cookie()->get('id'))
                ->first();
        if( $all == null && $all == false ) {
            return false;
        } else {
            return $this->allUserGetInfo($all);
        }
    }

    /**
     *
     * @param array $info
     * @return array
     */
    private function allUserGetInfo($info)
    {
        foreach( $info as $key => $value ) {
            if( $info->$key == $this->userAll[$key] ) {
                return $this->userAll;
            } else {
                $this->userAll[$key] = $value;
            }
        }

        return $this->userAll;
    }
}
