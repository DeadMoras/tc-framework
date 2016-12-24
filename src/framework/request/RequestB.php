<?php

namespace framework\request;

use framework\request\RequestL;

class RequestB extends RequestL
{
    /**
     * Используется для многомерного вывода веденных данных
     * Пример:
     * $request->input(['login', 'password', 'email']);
     *
     * @var array
     */
    protected $data;

    /**
     * Получение веденных данных
     * Если $name является массивом, то производится вызов другого метода
     * Иначе, идет обращение к родительскому методу
     *
     * @param mixed $name
     * @return string
     */
    public function input($name)
    {
        if ( is_array($name) ) {
            // Метод, который возвращает веденные данные
            $this->array_input($name);

            // Делается return ибо данные выводятся автоматически
            return $this->foreachData();
        } else {
            // Если не массив, то нужно вернуть одно свойство, и мы можем просто вызвать то, что нам нужно
            return parent::postInput($name);
        }
    }

    /**
     * Вызывается методом выше, если был передан массив (Вообще, метод должен быть приватным, так как он нигде не потребуется)
     * Он перебирает все Ваши "запросы" (login, password, email, name и т.п)
     * И вызывае родительский метод, который делает свою работу и возвращает уже веденные данные
     * Все это помещается в свойство
     *
     * @param array $object
     */
    public function array_input(array $object): void
    {
        foreach ( $object as $v ) {
            $result = parent::postInput($v);
            $this->data[] = $result;
        }
    }

    /**
     *
     * @param mixed $object
     * @return mixed
     */
    public function json($object)
    {
        return json_encode($object);
    }

    /**
     *
     * @return array
     */
    public function all(): array
    {
        return parent::getAll();
    }

    /**
     * При вызова метода $request->input(), в случае передаче ему не string(например: name), а массива(['name', 'name1')]
     * Будет вызываться этот метод, так как по умолчанию, метод input (в случае. если был передан массив)
     * Выводит результаты сам
     */
    public function foreachData()
    {
        foreach ( $this->data as $k ) {
            echo $k;
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function get(string $name): string
    {
        return parent::getInput($name);
    }
}
