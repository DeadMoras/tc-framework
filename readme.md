#Описание
<addr>
#Первая версия фреймворка tc (The Crutch ? почему бы и нет)
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
  * self::view('name');<addr>
  * self.view('dir.dir.dir.name'); <addr>
  * self.view('name', ['data' => $data]);<addr>
<addr>
Работа с данными:<addr>
  * $request = new Request();<addr>
  * $request->get('name') // $_GET;<addr>
  *  $request->input('name') // $_POST;<addr>
  * $request->getAll() // все данные<addr>
  * $request->json(['name' => $name])<addr>
  * $request->bcrypt($string, $type) // password_hash от php<addr>
<addr>
Валидация:<addr>
  * $validate = new Validate();<addr>
  * $validate->getValidate($request->getAll(), [
    'nameInput' => 'required',
    'nameInput2' => 'required|min:25|max:25'
  ]); <addr>
Вывод ошибок:<addr>
  * $validate->getErrors();<addr>
   Проверка на валидность:<addr>
   * if ( $request->correct() ) { } else {} <addr><addr>
 <addr><addr>
Работа с моделью: <addr>
  *Model::get('User', 'register', ['info']); // Имя модели, метод, данные<addr>
<addr><addr>
Работа с сессиями:<addr>
  * \Framework\Different\Cookie::getInstance()->set('name', 'value', 'time', 'domens', 'httponly') // name & value - Обязательны;<addr>
  * \Framework\Different\Cookie::getInstance()->get('name') // получение<addr>
  * \Framework\Different\Cookie::getInstance()->remove('name') // удаление<addr>
  * \Framework\Different\Cookie::getInstance()->has('name') // проверка на существование<addr>
<addr><addr>
Работа с конфигами:<addr>
  * Framework\Different\Config::get('file_name.value') // return [ 'key' => 'value' ]<addr>

Аутентификация:
  * if (Auth::attempt(['login' => $request->input('login'), 'password' => $request->input('password')])) { <addr>
            // в 'token' ячейку в таблице 'users' заносится рандомная строка при успехе <addr>
  }<addr>
<addr>
Работа с юзером:<addr>
  * \Framework\Controllers\Auth::check() // true & false<addr>
  * \Framework\Controllers\Auth::user() // вся информация о текущем юзере<addr>
  * \Framework\Controllers\Auth::user()->login // конкретнее<addr>
<addr><addr>
После скачивания нужно выполнить composer update, чтобы загрузился класс для работы с бд.