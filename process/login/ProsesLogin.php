<?php
// process/login/ProsesLogin.php
include '../../init.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pastikan data dikirim
if (!isset($_POST['identity'], $_POST['password'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

$identity = mysqli_real_escape_string($connect, $_POST['identity']);
$password = md5($_POST['password']); // Samakan dengan DB

$stmt = $connect->prepare("
    SELECT users.*, roles.nama AS role_name
    FROM users
    JOIN roles ON users.id_roles = roles.id
    WHERE (users.username = ? OR users.email = ?)
      AND users.password = ?
");

$stmt->bind_param("sss", $identity, $identity, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Regenerasi session (lebih aman)
    session_regenerate_id(true);

    $_SESSION['login']     = true;
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['id_roles']  = $user['id_roles'];
    $_SESSION['role_name'] = $user['role_name'];
    $_SESSION['username']  = $user['username'];

    // Redirect sukses
    header('Location: ' . BASE_URL . 'index.php');
    exit;
} else {
    // Redirect gagal
    header('Location: ' . BASE_URL . 'login.php?error=1');
    exit;
}
