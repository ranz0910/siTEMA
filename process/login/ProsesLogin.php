<?php
include '../../init.php';

require '../../service/connection.php';
session_start();

if (isset($_POST['identity'])) {
  $identity = $_POST['identity'];
  $pw = md5($_POST['password']);

  //ini yang uti ganti biar bisa tampil sidebar ee zaa, 
  // klo misal ee konflik program ee yang dari $query sampe $_SESSION[role] tuu jangan diganti zaa, 
  // apus aja yang gak perlu atau udah ada, 
  // atau ga salin aee yang uti ganti tuu ke kodingan zaa yang betul selebih ee apus ajaa lah lagii
  $query = "SELECT users.*, roles.nama AS role_name 
              FROM users 
              JOIN roles ON users.id_roles = roles.id 
              WHERE (users.username='$identity' OR users.email='$identity') 
              AND users.password='$pw'";
    
    $login = $connect->query($query);

  if ($login && $login->num_rows > 0) {
        $user = $login->fetch_assoc();

        // Simpan ke session
        $_SESSION['login'] = true;
        $_SESSION['identity'] = $identity;
        
        // Simpan nama role (misal: 'unit_kerja')
        $_SESSION['role'] = $user['role_name']; 

        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        echo "Login Gagal! Periksa kembali username/email dan password Anda.";
    }
} 

?>