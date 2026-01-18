<?php
include '../../init.php';
require '../../service/connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['identity'], $_POST['password'])) {
    $identity = $_POST['identity'];
    $pw = md5($_POST['password']);

    $stmt = $connect->prepare("SELECT users.*, roles.nama AS role_name 
                                FROM users 
                                JOIN roles ON users.id_roles = roles.id 
                                WHERE (users.username = ? OR users.email = ?) 
                                AND users.password = ?");
    
    $stmt->bind_param("sss", $identity, $identity, $pw);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['login']    = true;        
        $_SESSION['id_user']  = $user['id']; 
        $_SESSION['identity'] = $identity;
        $_SESSION['role']     = $user['role_name']; 

        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        echo "Login Gagal! Periksa kembali username/email dan password Anda.";
    }
}
?>