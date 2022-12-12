<?php
// функция подключения
function Connect_dataBase()
{
  $serverName = "localhost";
  $db_user = "root";
  $db_pass = "";
  $db_name = "my_bd"; // название базы данных

  $dataBase = new mysqli($serverName, $db_user, $db_pass, $db_name);
  return $dataBase;
}

// нажатие на кнопку Авториззоваться
if (isset($_GET['autorisation'])) {
  $login = $_GET['login'];
  $password = $_GET['password'];
  if ($login != null && $password != null) {
    $dataBase = Connect_dataBase();

    $request = "SELECT login, password FROM users WHERE login = '$login' AND password = '$password'";

    $result = mysqli_fetch_assoc($dataBase->query($request));

    if($result != null){
      header("Location: site.php");
    }
    else {
      header("Location: index.php");
    }

    $dataBase->close();
  } else {
    readfile('index.php');
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
