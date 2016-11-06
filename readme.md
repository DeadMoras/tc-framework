#Описание

###Первая версия фреймворка tc

Что нового?
* Был переписан полностью фреймворк
* Улучшена архитектура
* Пару новых фишек



Доступно:
* рендер представления
* в качестве шаблонизатора smarty
* Класс Request
* Валидация
* Работа с моделью ( передача данных с контроллера )
* Работа с куки
* Чтение данных из конфига
* Ааутентификация и авторизация
* Класс Response



[Работа с базой данных](https://github.com/usmanhalalit/pixie)
Класс \DB



Работа с представлением:
* В качестве шаблонизатора выбран smarty
* Все файлы должны быть формата .tpl и содержаться в папке view
* При вложености перечисление через . (точку) 
* Рендер представления:
```
$data = ['login' => 'DeadMoras'];
  $this->view('name', [
     'data' => $data
]);
```
* Можно указать просто

`$this->view('name');`


Работа с данными:
* Объявление:
   `$request = new Request;`
* Получить данные с конкретного инпута:
    `$request->input('name');`
* Получить все данные:
    `$request->all();`

Учтите, что данные возвращаются в своем порядке. 

И их выводить нужно командой print_r(или другой по смыслу).

Будут выводится как названия (name) инпутов, так и данные.
* Получение конкретных данных:

    `$request->input(['name', 'name1']);`

Данные будут выводится автоматически.

* Переобразование в json:

    `$request->json(['name' => 'name']);


Валидация:
* Объявление:
    `$validate = new Validate;`

* Пример валидации:
```
$validate->valid($request->all(), [
    'inputName' => 'required|min:3|max:10',
    'inputName2' => 'min:3'
]);
```

* Вывод ошибок при валидации:
`$validate->getErrors();`

* Проверка:
```
if ( $validate->correct() ) {
    //true
} else {
    //false
}
```

Работа с моделью:
* Объявление:
`$model = new Model;`

* Передача данных из контроллера в модель:
```
$data = ['something', 'here];
$model->init('User', 'register', $data);
```
Где 'User' - название класса, 'register' - название метода, 'data' - данные.


* Упрощенный синтаксис:
```
$model->ainit(['User' => 'register', $data]);
```

Модель может вернуть обработанные данные, которые можно передачать в шаблон.


Работа с куки:
 Все куки шифруются через Mcrypt и аналогично расшифровываются.

* Объявление:

`$cookie = new Cookie;`

* Запись:
`$cookie->set('name', 'value', 'time', 'domens', 'httponly');`

Значение может быть массивом.
'time', 'domens', 'httponly' - не обязательны к заполнению

* Получение:

`$cookie->get('name')`

* Удаление:

`$cookie->remove('name');`

* Проверка на существование:

`$cookie->has('name');`


Работа с конфигом:

* Получение значения

`$config->get('file_name.key');`


Аутентификация:

* Объявление:

`$auth = new Auth;`

Авторизация:

```
if ( $auth->attempt('login' => $request->input('login), 'password' => $request->input('password)) ) {
    //true
} else {
    //false
}
```

Первый параметр должен быть логином/имеилом/именем и т.п

* Авторизован или нет:

```
if ( $auth->check() ) {
    //true
} else {
    //false
}
```

* Получение данных:

`$attempt->user()['login']);`


Response класс

* Объявление:

`$response = new Response;`

Получение/Запись кода:

`$response->code();`

Для записи нужно указать цифру кода


* Заголовки:

`$response->header($what, $string);`

* Объявление content-type

`$response->setContent('string');

* Перенаправление

`$response->redirect('/');`

* Послать Json (content-type: application/json задается автоматически)

`$response->json('string');`


Роутеры:

Все роутеры задаются в app/route

* Доступны все методы:

```
$router->get('pattern', function() { /* ... */ })

$router->post('pattern', function() { /* ... */ })

$router->put('pattern', function() { /* ... */ })

$router->delete('pattern', function() { /* ... */ })

$router->options('pattern', function() { /* ... */ })

$router->patch('pattern', function() { /* ... */ })
```

* Регулярные выражения

```
$router->get('/hello/(\w+)', function($name) { 
    echo 'Hello ' . htmlentities($name); 
});
```

* Мульти-роутеры:

```
$router->get('/movies/(\d+)/photos/(\d+)', function($movieId, $photoId) { 
    echo 'Movie #' . $movieId . ', photo #' . $photoId); 
});
```

* Middlewares

```
$router->before('GET|POST', '/admin/.*', function() {
     if (!isset($_SESSION['user'])) {
         header('location: /auth/login'); exit(); 
     } 
});
```

* Custom 404

```
$router->default404(function() { 
    header('HTTP/1.1 404 Not Found'); // ... do something special here 
});
```


По всем вопросам писать сюда - [тык](http://vk.com/deadmoras)