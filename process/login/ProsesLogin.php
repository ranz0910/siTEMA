<?php
include '../../init.php';
require '../../service/connection.php';

if (isset($_POST['identity'])) {

  $identity = $_POST['identity'];
  $pw = md5($_POST['password']);

  $query = "SELECT users.*
            FROM users
            WHERE (username='$identity' OR email='$identity')
            AND password='$pw'";

  $login = $connect->query($query);

  if ($login && $login->num_rows > 0) {
    $user = $login->fetch_assoc();

    $_SESSION['login']   = true;
    $_SESSION['identity'] = $identity;

    // 🔥 INI YANG PENTING
    $_SESSION['role_id'] = $user['id_roles'];

    header("Location: " . BASE_URL . "index.php");
    exit;
  } else {
    echo "Login gagal!";
  }
}
