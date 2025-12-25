<?php
include '../../init.php';

session_start();
session_unset();

// menghapus sesi
session_destroy();

header("Location: " . BASE_URL . "layout/auth/login_layout.php");

?>