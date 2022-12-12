<?php
// функция подключения
function Connect_dataBase()
{
  $serverName = "localhost";// сервер
  $db_user = "root";//Имя пользователя
  $db_pass = "";//Пароль пользователя
  $db_name = "my_bd"; // название базы данных

  $dataBase = new mysqli($serverName, $db_user, $db_pass, $db_name);//выполнение подключения
  return $dataBase;
}

// нажатие на кнопку Авториззоваться
if (isset($_GET['autorisation'])) {
  //определяет, объявлена ли переменная и отличается ли она от null
  // Данные храняться в массиве $_GET
  $login = $_GET['login'];
  $password = $_GET['password'];
  if ($login != null && $password != null) {
    //проверка на ошибки, если переменные логин и пароль определены
    $dataBase = Connect_dataBase();
    // соединение с бд
    $request = "SELECT login, password FROM users WHERE login = '$login' AND password = '$password'";
    // добавление логина авторизованного пользователя, и его пароль добаляется в таблицу users 
    $result = mysqli_fetch_assoc($dataBase->query($request));
    // извлекает одну строку данных из результирующего набора и возвращает ее в виде ассоциативного массива. 
    if($result != null){ 
      header("Location: site.php");
    }
    //если нет повторяющегося значения(переменная определена правильно), то происходит переход на сайт
    else {
      header("Location: index.php");
    }
    // иначе происходит возвращение на первоначальную страницу(форма авторизации)
    $dataBase->close(); // закрытие соединения с бд
  } else {
    readfile('index.php'); // иначе читает файл и записывает его в буфер вывода
  }
}

// нажатие на кнопку Зарегистрироваться
if (isset($_GET['registration'])) { //isset () вернёт false при проверке переменной которая была установлена значением null
  $login = $_GET['login'];//присваивание переменной
  $password = $_GET['password'];
  $repeatPassword = $_GET['repeat_password'];// повторение присваивания
  if ($login != null && $password != null && $repeatPassword != null) { // если логин, пароль и поторно введенный пароль совпадают со значениями из бд
    if ($password == $repeatPassword) { // если пароль совпадает с повторно введенным
      $dataBase = Connect_dataBase(); // соединение с бд
      
      // написать проверку на существование такого аккаунта с таким же логином с использованием SELECT
      // (как использовать SELECT смотрите в нажатии на кнопку Авторизоваться)
      $sql = 'SELECT count(login) as count FROM users WHERE login=?'; //записываем sql в котором считаем количество найденных id
      $query = $pdo->prepare($sql); 
      $query->execute([$login]);
      $count_users = $query->fetch(); //получаем одну строчку
      if ((int)$count_users['count'] === 0) { //Если таких пользователей больше 0
      //здесь код регистрации
      } 
      else {
        exit('Логин уже занят'); //делаем выход из скрипта. Сюда можно написать что угодно
      }

      $request = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
      $dataBase->query($request);
      header('Location: index.php');
      $dataBase->close();
    }
    else{
      header("Location: registr.php"); //иначе переход на главную страницу
    }
  } else {
    header("Location: registr.php"); // иначе переход на главную страницу
  }

  
}
