<?php

namespace framework\auth;

use framework\auth\AuthInt;
use framework\other\Config;
use framework\other\Cookie;

class AuthB extends AuthL implements AuthInt
{
    /**
     * "Ключи" при авторизации. Т.е., названия ячеек в таблице
     * @var array
     */
    private $attemptKeys;

    /**
     * "Значения" при авторизации. Т.е., веденные данные
     * @var array
     */
    private $attemptValues;

    /**
     *
     * @var array
     */
    protected $user = [];

    /**
     * Вся информация о текущим пользователе
     * @var array
     */
    private $userAll = [];

    /**
     * Метод для авторизации
     * Принимает массив данных вида:
     * Название ячейки => веденное значение, название ячейки => веденное значение
     * @param array $data
     * @return boolean
     */
    public function attempt(array $data)
    {
        // Помещаем в свойства выше данные
        $this->attemptKeys = array_keys($data);
        $this->attemptValues = array_values($data);

        // Вызываем другой метод и помещаем результат в переменную
        $info = $this->userInfo($this->attemptKeys, $this->attemptValues);

        if ( $info !== null && $info !== false ) {
            return true;
        } else {
            echo Config::get('validate_rules.notincorrect');

            return false;
        }
    }

    /**
     * Метод для проверки авторизован ли пользователь
     * Пример: Auth::check() // true || false
     * @return boolean
     */
    public function check(): bool
    {
        // Проверка значений в куках
        if ( !Cookie::instance()->has('id') && !Cookie::instance()->has('token') ) {
            return false;
        }

        return $this->checkLogic();
    }

    /**
     * Метод возвращает данные авторизованного пользователя
     * @return boolean
     */
    public function user()
    {
        // Если авторизован
        if ( $this->check() ) {
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
        // Достаем всю информацию из базы по id пользователя, которое хранится в куках
        $all = \DB::table('users')->where('id', '=', Cookie::instance()->get('id'))->first();

        if ( $all == null && $all == false ) {
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
    private function allUserGetInfo($info): array
    {
        // в $info хранятся данные из базы данных
        // Перебираем их
        foreach ( $info as $key => $value ) {
            // Если информация идентична информации которая хранится в свойстве
            // Возвращаем это свойство
            if ( $info->$key == $this->userAll[$key] ) {
                return $this->userAll;
            } else {
                // Иначе записываем в свойство
                $this->userAll[$key] = $value;
            }
        }

        return $this->userAll;
    }
}
