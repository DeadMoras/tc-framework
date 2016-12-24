<?php

namespace framework\auth;

use framework\other\Config;
use framework\other\Cookie;
use framework\other\Csrf;

class AuthL
{
    /**
     * $in_db и $data - названия ячеек в базе данных и веденные данные из формы соответственно
     * @param array $in_db
     * @param array $data
     * @return bool
     */
    protected function userInfo($in_db, $data): bool
    {
        // Достаем пароль пользователя по условию:
        // Ячейка в базе == веденные данные из формы
        $user = \DB::table('users')->select('password')->where($in_db[0], '=', $data[0])->first();

        if ( $user == null ) {
            return false;
        } else {
            return $this->otherLogic($user, $data);
        }
    }

    /**
     * Метод проверяет пароли на соответствие
     * @param array $user
     * @param array $data
     * @return bool|void
     */
    private function otherLogic($user, $data): bool
    {
        if ( password_verify($data[1], $user->password) ) {
            return $this->takeInfo($data);
        } else {
            echo Config::get('validate_rules.notincorrectpassword');

            return false;
        }
    }

    /**
     * Метод вызывается в случае совпадения веденного пароля с паролем в базе данных
     * Он обновляет ячейку 'token' и достает id и записанный token.
     * Вызывает метод, который записывает id и token в куки.
     * @param array $data
     * @return void
     */
    private function takeInfo($data)
    {
        // Генерируем токен
        $token = $this->generateToken();

        // Для записи в базу данных
        $dataInfo = ['token' => $token];

        \DB::table('users')->where('login', '=', $data[0])->update($dataInfo);

        $userInfo = \DB::table('users')->select('id', 'token')->where('login', '=', $data[0])->first();

        return $this->setInfo($userInfo, $token);
    }

    /**
     * Метод записывает нужную информацию в куки
     * @param array $user
     * @return bool
     */
    private function setInfo($user, $token): bool
    {
        // Csrf Защита
        // При каждой авторизации генерируется csrf-ключ, используя метод класса Csrf.
        $newToken = Csrf::instance()->generate($token);

        // Записывает ключ в куки
        Cookie::instance()->set('csrf', $newToken);

        // Перебираем id и token, и записываем в свойство 'user' (Класс AuthB)
        foreach ( $user as $k => $v ) {
            $this->user[$k] = $v;

            //Записываем в куки
            Cookie::instance()->set($k, $v);
        }

        return true;
    }

    /**
     * Метод для проверки авторизован пользователь или нет
     * @return boolean
     */
    protected function checkLogic(): bool
    {
        // Достаем id и token, с условием, что они идентичны данным(токену и айди..) которые лежат в куках
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
