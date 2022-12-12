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
    //проверка на ошибки
    $dataBase = Connect_dataBase();
    // соединение с бд
    $request = "SELECT login, password FROM users WHERE login = '$login' AND password = '$password'";
    // добавление логина авторизованного пользователя, и его пароль добаляется в таблицу users 
    $result = mysqli_fetch_assoc($dataBase->query($request));
    // извлекает одну строку данных из результирующего набора и возвращает ее в виде ассоциативного массива. 
    if($result != null){
      header("Location: site.php");
    }
    //если нет повторяющегося значения, то происходит переход на сайт
    else {
      header("Location: index.php");
    }
    // иначе происходит возвращение на первоначальную страницу
    $dataBase->close(); // закрытие бд
  } else {
    readfile('index.php'); // иначе вывод файла индекс.php
  }
}

// нажатие на кнопку Зарегистрироваться
if (isset($_GET['registration'])) {
  $login = $_GET['login'];
  $password = $_GET['password'];
  $repeatPassword = $_GET['repeat_password'];
  if ($login != null && $password != null && $repeatPassword != null) {
    if ($password == $repeatPassword) {
      $dataBase = Connect_dataBase();
      

      // написать проверку на существование такого аккаунта с таким же логином с использованием SELECT
      // (как использовать SELECT смотрите в нажатии на кнопку Авторизоваться)

      $request = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
      $dataBase->query($request);
      header('Location: index.php');
      $dataBase->close();
    }
    else{
      header("Location: registr.php");
    }
  } else {
    header("Location: registr.php");
  }

  
}
