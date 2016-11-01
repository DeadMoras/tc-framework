#Описание

Первая версия фреймворка tc (The Crutch ? почему бы и нет)

Доступно:
  рендер вьюхи;
  работа с данными($_post, $_get);
  валидация (required, min, max);
  работа с моделью(передача данных в модель);
  работа с сессиями;
  чтение данных из конфигов;
  аутентификация + авторизация.

Рендер вьюхи : 
  self::view('name');
  self.view('dir.dir.dir.name'); 
  self.view('name', ['data' => $data]);

Работа с данными:
  $request = new Request();
  $request->get('name') // $_GET;
  $request->input('name') // $_POST;
  $request->getAll() // все данные
  $request->json(['name' => $name])
  $request->bcrypt($string, $type) // password_hash от php

Валидация:
  $validate = new Validate();
  $validate->getValidate($request->getAll(), [
    'nameInput' => 'required',
    'nameInput2' => 'required|min:25|max:25'
  ]); 
  Вывод ошибок:
  $validate->getErrors();
  Проверка на валидность:
    if ( $request->correct() ) {
    } else {}

Работа с моделью:
  Model::get('User', 'register', ['info']); // Имя модели, метод, данные

Работа с сессиями:
  \Framework\Different\Cookie::getInstance()->set('name', 'value', 'time', 'domens', 'httponly') // name & value - Обязательны;
  \Framework\Different\Cookie::getInstance()->get('name') // получение
  \Framework\Different\Cookie::getInstance()->remove('name') // удаление
  \Framework\Different\Cookie::getInstance()->has('name') // проверка на существование

Работа с конфигами:
  Framework\Different\Config::get('file_name.value') // return [ 'key' => 'value' ]

Аутентификация:
  if (Auth::attempt(['login' => $request->input('login'), 'password' => $request->input('password')])) {
            // в 'token' ячейку в таблице 'users' заносится рандомная строка при успехе
  }

Работа с юзером:
  \Framework\Controllers\Auth::check() // true & false
  \Framework\Controllers\Auth::user() // вся информация о текущем юзере
  \Framework\Controllers\Auth::user()->login // конкретнее

После скачивания нужно выполнить composer update, чтобы загрузился класс для работы с бд.