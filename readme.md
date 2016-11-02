#Описание
<addr>
###Первая версия фреймворка tc

Доступно:
  * рендер вьюхи;
  * работа с данными ($_post, $_get);
  * переобразование данных в json;
  * валидация (required, min, max);
  * работа с моделью(передача данных);
  * работа с куки;
  * чтение данных из конфига:
  * аутентификация и авторизация;
  * подключение css & js файлов через массив;
  * переадресация;
  * отправление content-type.


  Работа с вьюхой:
    Подгружаются только php файлы.
    Вложеность максимальная, перечисление через . (точку)
    Передача данных:
`$this->view('name', ['data' => $data])` // 'data' - Данные, например - данные из базы данных.
    * `$this->view('name')`
    * `$this->view('dir.dir.dir.name')`


Работа с данными:
    * Объявление:
      `$request = new Request()`
    * Получить GET данные:
	`$request->get('name')`
     * Данные с формы:
	`$request->input('name')`
     * Все данные:
	`$request->getAll()`
     * Переобразование в json:
	`$request->json(['name' => $name])` // можно просто json($name)
     * Хеширование (password_hash)
	`$request->bcrypt($string, $type)` //$type не обязателен

Валидация:
    * Объявление:
	`$validate = new Validate()`
    * Валидация:
	`$validate->getValidate($request->getAll(), [`
	   `'nameInput' => 'required',`
	   `'nameInput2' => 'required|min:25|max:25`
	`])`
    * Вывод ошибок:
	`$validate->getErrors()` //Текст можно указать в app/config/errors_messages.php
    * Проверка на валидность:
	` if($request->correct())`
	`{} else {}`


Работа с моделью:
    * Данные:
	`$data = ['name1', 'name2']`
    * Передача данных:
	`Model::get('User', 'register', $data)` // Имя класса, метод, данные


Работа с куки:
    * "Положить":
	`\Framework\Different\Cookie::getInstance()->set('name', 'value', 'time', 'domens', 'httponly')` // name & value - Обязательны
	`\Framework\Different\Cookie::getInstance()->get('name')` // получение
	`\Framework\Different\Cookie::getInstance()->remove('name')`
	`\Framework\Different\Cookie::getInstance()->has('name')`


Работа с конфигом:
    * Получить значение
	`Framework\Different\Config::get('file_name.value')` // возвращает значение


Аутентификация:
    * Объявление
	`if (Auth::attempt(['login' => $request->input('login'), 'password' => $request->input('password')])) {`
	   `echo true`
	`}` // при успехе в ячейку 'token' в таблице 'users' заносится рандомная строка


Работа с пользователем:
    * Проверка на аутентификацию
       `\Framework\Controllers\Auth::check()` // возвращает true/false
    * Получение информации
	`\Framework\Controllers\Auth::user()`
    * Значение
	`\Framework\Controllers\Auth::user()->login`


Роуты:
    * Доступны все методы
	`$router->get('pattern', function() { /* ... */ })`
	`$router->post('pattern', function() { /* ... */ })`
	`$router->put('pattern', function() { /* ... */ })`
	`$router->delete('pattern', function() { /* ... */ })`
	`$router->options('pattern', function() { /* ... */ })`
	`$router->patch('pattern', function() { /* ... */ })`
    * Пример регулярных выражений
	`$router->get('/hello/(\w+)', function($name) {`
	   `echo 'Hello ' . htmlentities($name);`
	`});`
    * Мульти-роутеры:
	`$router->get('/movies/(\d+)/photos/(\d+)', function($movieId, $photoId) {`
	    `echo 'Movie #' . $movieId . ', photo #' . $photoId);`
	`});`
    * Middlewares
	`$router->before('GET|POST', '/admin/.*', function() {`
	    `if (!isset($_SESSION['user'])) {`
	         `header('location: /auth/login');`
	         `exit();`
	    `}`
	`});`
    * Custom 404
	`$router->set404(function() {`
	    `header('HTTP/1.1 404 Not Found');`
	    `// ... do something special here`
	`});`


Response
    * Объявление
	`$response = new Response()`
    * Переадресация
	`$response::responseUr('url')`
    * Отправление content-type
	`$response::headerContent('content')`

После скачивания нужно выполнить composer update, чтобы загрузился класс для работы с бд.