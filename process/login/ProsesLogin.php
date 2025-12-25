<?php
include '../../init.php';

require '../../service/connection.php';
session_start();

if (isset($_POST['identity'])) {
  $identity = $_POST['identity'];
  $pw = md5($_POST['password']);

  $login = $connect->query("SELECT * FROM users 
    WHERE (username='$identity' OR email='$identity') 
    AND password='$pw'");

  if ($login->num_rows > 0) {
    $_SESSION['identity'] = $identity;
    $_SESSION['login'] = true;
    header("Location: " . BASE_URL . "index.php");
  } else {
    echo "Login Gagal!";
  }
} 

?>