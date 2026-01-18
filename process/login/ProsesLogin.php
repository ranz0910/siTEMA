<?php
// process/login/ProsesLogin.php
include '../../init.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tambahkan library SweetAlert2
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <body style='font-family: sans-serif;'>";

if (isset($_POST['identity'], $_POST['password'])) {
    // Gunakan $connect sesuai standar init.php
    $identity = mysqli_real_escape_string($connect, $_POST['identity']);
    
    // ENKRIPSI MD5: Samakan dengan yang ada di database kamu
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

        // Simpan data ke session dengan nama kunci yang konsisten (user_id)
        $_SESSION['login']     = true;        
        $_SESSION['user_id']   = $user['id']; // Digunakan untuk pengecekan hapus/edit data
        $_SESSION['id_roles']  = $user['id_roles'];
        $_SESSION['role_name'] = $user['role_name']; 
        $_SESSION['username']  = $user['username'];

        // Notifikasi BERHASIL Login
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: 'Selamat datang kembali, " . $user['username'] . "!',
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location.href = '" . BASE_URL . "index.php';
            });
        </script>";
        exit();
    } else {
        // Notifikasi GAGAL Login
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Username/Email atau Password salah.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Coba Lagi'
            }).then(function() {
                window.history.back();
            });
        </script>";
    }
}
echo "</body>";
?>