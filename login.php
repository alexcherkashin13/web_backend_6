<?php

header('Content-Type: text/html; charset=UTF-8');


session_start();

if (!empty($_SESSION['login'])) {
  header('Location: ./');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

<form action="" method="post">
<p><label>
 Введите логин: <br>
  <input name="login" />
  </label></p>
  <p> <label>
  Введите пароль: <br>
  <input name="pass" /></label>
  </p>
  <p> <label><input type="submit" value="Войти" /></label></p>
  
</form>

<?php
}
else {
    
    $servername = "localhost";
    $username = "u17446";
    $password = "9743779";
    $dbname = "u17446";
    $connection = mysqli_connect($servername, $username, $password, $dbname);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $tmp = $_POST['login'];
    $tmp1 = $_POST['pass']; 
    $tmp1 = md5($tmp1);
    $sql = "SELECT login, pass FROM task6";
    $result = mysqli_query( $connection, $sql);
    $bool = false;
    
    while ($row = mysqli_fetch_row($result)) {
        for ($j = 0 ; $j < 1 ; ++$j) {
        if ($row[$j] == $tmp) 
            if ($row[$j+1] == $tmp1)
               $bool = true;
        }
    }
        mysqli_free_result($result);
    if($bool) {
        $_SESSION['login'] = $_POST['login'];
        header('Location: ./');
    }
    else {
        echo "Неверный логин или пароль.";
    }
}