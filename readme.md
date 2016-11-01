#Описание
<addr>
###Первая версия фреймворка tc (The Crutch ? почему бы и нет)
<addr><addr>
Доступно:<addr><addr>
  * рендер вьюхи;<addr>
  * работа с данными($_post, $_get);<addr>
  * валидация (required, min, max);<addr>
  * работа с моделью(передача данных в модель);<addr>
  * работа с сессиями;<addr>
  * чтение данных из конфигов;<addr>
  * аутентификация + авторизация.<addr>


Рендер вьюхи:<addr>
  <code> * self::view('name'); <code> <addr>
  <code> * self.view('dir.dir.dir.name'); <code>  <addr>
  <code> * self.view('name', ['data' => $data]); <code> <addr>
<addr>

Работа с данными:<addr>
  <code> * $request = new Request(); <code> <addr>
  <code> * $request->get('name') // $_GET; <code> <addr>
  <code> *  $request->input('name') // $_POST; <code> <addr>
  <code> * $request->getAll() <code>  // все данные<addr>
  <code> * $request->json(['name' => $name]) <code> <addr>
  <code> * $request->bcrypt($string, $type) <code>  // password_hash от php<addr><addr>
<addr>Валидация:<addr>
  <code> * $validate = new Validate(); <code>
  <code> * $validate->getValidate($request->getAll(), [
    'nameInput' => 'required',
    'nameInput2' => 'required|min:25|max:25'
  ]); <code> <addr><addr>


<addr><addr>Вывод ошибок:<addr>
  <code> * $validate->getErrors(); <code> <addr>

<addr>Проверка на валидность:<addr>
   <code> * if ( $request->correct() ) { } else {} <code> <addr><addr>


<addr>Работа с моделью:<addr>
  <code> * $data = ['test'1, 'test2']; <code>
  <code> * Model::get('User', 'register', $data); <code> // Имя модели, метод, данные<addr>
<addr><addr>


Работа с сессиями:
  <code> * \Framework\Different\Cookie::getInstance()->set('name', 'value', 'time', 'domens', 'httponly') <code> // name & value - Обязательны;<addr>
  <code> * \Framework\Different\Cookie::getInstance()->get('name') <code> // получение<addr>
  <code> * \Framework\Different\Cookie::getInstance()->remove('name') <code> // удаление<addr>
  <code> * \Framework\Different\Cookie::getInstance()->has('name') <code> // проверка на существование<addr>


Работа с конфигами:<addr>
  <code> * Framework\Different\Config::get('file_name.value') // return value <code>


Аутентификация:
  * <code> if (Auth::attempt(['login' => $request->input('login'), 'password' => $request->input('password')])) {
            // в 'token' ячейку в таблице 'users' заносится рандомная строка при успехе
  } <code>


<addr>Работа с юзером:<addr>
  <code> * \Framework\Controllers\Auth::check() <code> // true & false<addr>
  <code> * \Framework\Controllers\Auth::user() <code> // вся информация о текущем юзере<addr>
  <code> * \Framework\Controllers\Auth::user()->login <code> // конкретнее<addr>
<addr><addr>


Роутеры:
  * /user/id(:num) // рандомные цифры


После скачивания нужно выполнить composer update, чтобы загрузился класс для работы с бд.