<?php

header('Content-Type: text/html; charset=UTF-8');
$servername = "localhost";
$username = "u17446";
$password = "9743779";
$dbname = "u17446";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 
  $messages = array();

 
  if (!empty($_COOKIE['save'])) {
  
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);
 
    $messages[] = '<p>Спасибо, результаты сохранены.</p>';
   
    if (!empty($_COOKIE['pass'])) {
      $messages[] = sprintf('<p>Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.</p>',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass']));
    }
  }
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['sex'] = !empty($_COOKIE['sex_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['Limbs'] = !empty($_COOKIE['Limbs_error']);
  $errors['field-name-2'] = !empty($_COOKIE['field-name-2_error']);
  $errors['acquainted'] = !empty($_COOKIE['acquainted_error']);
  $errors['abilities'] = !empty($_COOKIE['abilities_error']);

  
  if ($errors['fio']) {
      setcookie('fio_error', '', 100000);
      if ($_COOKIE['fio_error'] == '1') {
          $messages[] = '<div class="error">Заполните имя.</div>';
      }
      else {
          $messages[] = '<div class="error">Укажите имя на русском языке.</div>';
      }
  }
  if ($errors['year']) {
      setcookie('year_error', '', 100000);
      $messages[] = '<div class="error">Установите год.</div>';
  }
  if ($errors['sex']) {
      setcookie('sex_error', '', 100000);
      $messages[] = '<div class="error">Выберите пол.</div>';
  }
  if ($errors['Limbs']) {
      setcookie('Limbs_error', '', 100000);
      $messages[] = '<div class="error">Выберите кол-во конечностей.</div>';
  }
  if ($errors['email']) {
      setcookie('email_error', '', 100000);
      if ($_COOKIE['email_error'] == '1') {
          $messages[] = '<div class="error">Укажите адрес эл. почты.</div>';
      }
      else {
          $messages[] = '<div class="error">Укажите коректный адрес эл. почты.</div>';
      }
  }
  if ($errors['field-name-2']) {
      setcookie('field-name-2_error', '', 100000);
      $messages[] = '<div class="error">Напишите о себе.</div>';
  }
  if ($errors['acquainted']) {
      setcookie('acquainted_error', '', 100000);
      $messages[] = '<div class="error">Дайте согласие.</div>';
  }
  
   if ($errors['abilities']) {
      setcookie('abilities_error', '', 100000);
       $messages[] = '<div class="error">Укажите способность.</div>';
   }
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) || !preg_match('/^[а-яА-Я ]+$/u',$_COOKIE['fio_value'])  ? '' : strip_tags($_COOKIE['fio_value']);
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : $_COOKIE['sex_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['Limbs'] = empty($_COOKIE['Limbs_value']) ? '' : $_COOKIE['Limbs_value'];
  $values['field-name-2'] = empty($_COOKIE['field-name-2_value']) ? '' : $_COOKIE['field-name-2_value'];
  $values['acquainted'] = empty($_COOKIE['acquainted_value']) ? '' : $_COOKIE['acquainted_value'];
  $values['abilities'] = empty($_COOKIE['abilities_value']) ? '' : $_COOKIE['abilities_value'];

 
  if (empty($errors) && !empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
          
         
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }
          $tmp = $_COOKIE['email_value'];
          $sql = "SELECT * FROM task6 where login = '". $tmp . "'";
          $result = mysqli_query( $conn, $sql);
          $row = mysqli_fetch_row($result);
          $values['fio'] = $row[3];
          $values['year'] = $row[5];
          $values['sex'] = $row[6];
          $values['email'] = $row[4];
          $values['Limbs'] = $row[7];
          $values['field-name-2'] = $row[9];
          $values['abilities'] = $row[8];
          mysqli_close($conn);
          
    
    printf('Вход с логином %s',  $_SESSION['login']);
  }

  
  include('form.php');
}

else {

    $errors = FALSE;
    
    if (empty($_POST['fio'])) {
        setcookie('fio_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        if (!preg_match('/^[а-яА-Я ]+$/u', $_POST['fio'])) {
            setcookie('fio_error', '2', time() +  24 * 60 * 60);
            $errors = TRUE;
        }
        setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60);
    }
    
    $ability;
    
    if (!isset($_POST['abilities'])) {
        setcookie('abilities_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        $nAbility = count($_POST['abilities']);
        for($i=0; $i < $nAbility; ++$i)
        {
            $ability.=$_POST['abilities'][$i] . " ";
        }
        
        setcookie('abilities_value', $ability, time() +  30 * 24 * 60 * 60);
    }
    
    
    
    $year = $_POST['year'];
    if (empty($_POST['year'])) {
        setcookie('year_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60);
    }
    if(!isset($_POST['sex'])) {
        setcookie('sex_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('sex_value', $_POST['sex'], time() + 30 * 24 * 60 * 60);
    }
    $limbs = $_POST['Limbs'];
    if(!isset($_POST['Limbs'])) {
        setcookie('Limbs_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('Limbs_value', $_POST['Limbs'], time() + 30 * 24 * 60 * 60);
    }
    
    if (empty($_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        $email = $_POST['email'];
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            setcookie('email_error', '2', time() +  24 * 60 * 60);
            $errors = TRUE;
        }
        setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['field-name-2'])) {
        setcookie('field-name-2_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('field-name-2_value', $_POST['field-name-2'], time() + 30 * 24 * 60 * 60);
    }
    
    if(!(isset($_POST['acquainted']) &&
        $_POST['acquainted'] = 'Yes')) {
            setcookie('acquainted_error', '1', time() + 24 * 60 * 60);
            $errors = TRUE;
        }
        else {
            setcookie('acquainted_value', $_POST['acquainted'], time() + 30 * 24 * 60 * 60);
        }
        
        if ($errors) {
            header('Location: index.php');
            exit();
        }
        else {
            setcookie('fio_error', '', 100000);
            setcookie('abilities_error', '', 100000);
            setcookie('sex_error', '', 100000);
            setcookie('Limbs_error', '', 100000);
            setcookie('field-name-2_error', '', 100000);
            setcookie('acquainted_error', '', 100000);
            setcookie('email_error', '', 100000);
            setcookie('abilities_error', '', 100000);
            
        }
// *************

  if (!empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
          
          
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }
          $sql = "UPDATE task6 SET name ='" . $_POST['fio'] . "'" . "where login='" . $_SESSION['login'] . "'";
          mysqli_query($conn, $sql);
          $sql = "UPDATE task6 SET year ='" . $_POST['year'] . "'" . "where login='" . $_SESSION['login'] . "'";
          mysqli_query($conn, $sql);
          $sql = "UPDATE task6 SET sex ='" . $_POST['sex'] . "'" . "where login='" . $_SESSION['login'] . "'";
          mysqli_query($conn, $sql);
          $sql = "UPDATE task6 SET email ='" . $_POST['email'] . "'" . "where login='" . $_SESSION['login'] . "'";
          mysqli_query($conn, $sql);
          $sql = "UPDATE task6 SET limbs ='" . $_POST['Limbs'] . "'" . "where login='" . $_SESSION['login'] . "'";
          mysqli_query($conn, $sql);
          $sql = "UPDATE task6 SET biography ='" . $_POST['fiel-name-2'] . "'" . "where login='" . $_SESSION['login'] . "'";
          mysqli_query($conn, $sql);
          $sql = "UPDATE task6 SET abilities ='" . $ability . "'" . "where login='" . $_SESSION['login'] . "'";
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          
   
  }
  else {
      
      $pass =substr(md5(uniqid(rand(),true)), 10, 8);
      $pass1 = md5($pass);
      
    
      $login = $_POST['email'];
    
    setcookie('login', $login);
    setcookie('pass', $pass);
    
    $db = new PDO('mysql:host=localhost;dbname=u17446', $username, $password,
        array(PDO::ATTR_PERSISTENT => true));
    
    try {
        $stmt = $db->prepare("INSERT INTO task6 SET login = ?, pass = ?, name = ?, email = ?, year = ?, sex = ?, limbs = ?, abilities = ?, biography = ?");
        $stmt->execute([$login, $pass1, $_POST['fio'], $_POST['email'], intval($year) , $_POST['sex'], intval($limbs), $ability, $_POST['field-name-2']]);
    }
    catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        exit();
    }
    
  }

  
  setcookie('save', '1');

  header('Location: ./');
}