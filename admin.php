<html>
  <head>
  <title> Таблица данных </title>
  <link href="style.css" rel="stylesheet">
  </head>
  <body class = "table">

<?php

$servername = "localhost";
$username = "u17446";
$password = "9743779";
$dbname = "u17446";
$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
if(!empty($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_PW'])) {
$sql = "SELECT * FROM admin";
$result = mysqli_query( $connection, $sql);
$bool = false;
$tmp = $_SERVER['PHP_AUTH_USER'];
$tmp1 = $_SERVER['PHP_AUTH_PW'];
$tmp1 = md5($tmp1);
while ($row = mysqli_fetch_row($result)) {
    for ($j = 1 ; $j < 2 ; ++$j) {
        if ($row[$j] == $tmp)
            if ($row[$j+1] == $tmp1)
                $bool = true;
    }
}
}
mysqli_free_result($result);
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) || !$bool) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}
echo "<h2>";
print('Вы успешно авторизовались и видите защищенные паролем данные.');
echo "</h2>";
// *********
$sql = "SELECT * FROM task6";
$result = mysqli_query( $connection, $sql);
if($result) {
echo "<table class = 'data'>";
echo "<tr><th>id</th><th>логин</th><th>пароль</th><th>имя</th><th>email</th><th>год рождения</th><th>пол</th><th>конечности</th><th>способности</th><th>биография</th></tr>";
while ($row = mysqli_fetch_row($result)) {
    echo "<tr>";
    for ($j = 0 ; $j < 10; ++$j) echo "<td>$row[$j]</td>";
    echo "</tr>";
}
echo "</table>";
}
mysqli_free_result($result);
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********
?>
	<form class="del"action="" method="POST"> 
	<h3>Удалить</h3>
		<p><label>
           <p>Введите id строки:</p>
           <input type="number" name="num">
           </label>
        </p>
        <p><input type="submit" value="Отправить"></p>
	</form>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    $servername = "localhost";
	    $username = "u17446";
	    $password = "9743779";
	    $dbname = "u17446";
	    $connection = mysqli_connect($servername, $username, $password, $dbname);
	    if (!$connection) {
	        die("Connection failed: " . mysqli_connect_error());
	    }
	$num = $_POST['num'];
	$sql = "SELECT id FROM task6";
	$result = mysqli_query( $connection, $sql);
	$bool = false;
	if($result) {
	    while ($row = mysqli_fetch_row($result)) {
	            if ($row[0] == $num)
	                $bool = true;
	}
	}
	if($bool) {
	    $sql = "DELETE FROM task6 WHERE id='". $num . "'";
	    mysqli_query( $connection, $sql);
	}
	else {
	    echo "Такого id нет";
	}
	header("Refresh:0");
	}
	?>
</body>
</html>