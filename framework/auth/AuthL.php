<?php

namespace framework\auth;

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
        $user = \DB::table('users')
                ->select('password')
                ->where($in_db[0], '=', $data[0])
                ->first();
        if ($user == null) {
            return false;
        } else {
            return $this->otherLogic($user, $data);
        }
    }
    
    /**
     * 
     * @param array $user
     * @param array $data
     * @return boolean
     */
    private function otherLogic($user, $data)
    {
        if (password_verify($data[1], $user->password)) {
            return $this->takeInfo($data);
        } else {
            echo 'Неверный пароль';
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

        $userInfo = \DB::table('users')
                ->select('id', 'token')
                ->where('login', '=', $data[0])
                ->first();
        return $this->setInfo($userInfo, $token);
    }
    
    /**
     * 
     * @param array $user
     * @return boolean
     */
    private function setInfo($user, $token)
    {
        $csrf = new \framework\other\Csrf;
        $newToken = $csrf->generate($token);
        $this->cookie()->set('csrf', $newToken);
        foreach ($user as $k => $v) {
            $this->user[$k] = $v;
            $this->cookie()->set($k, $v);
        }
        return true;
    }
    
    /**
     * 
     * @return boolean
     */
    protected function checkLogic()
    {
        $result = \DB::table('users')
                ->select('id')
                ->where('id', '=', $this->cookie()->get('id'))
                ->where('token', '=', $this->cookie()->get('token'))
                ->first();
        if ($result == null && $result == false) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * 
     * @param number $length
     * @return string
     */
    public function generateToken($length = 20)
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
