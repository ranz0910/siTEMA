<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

// Jika BELUM login, lempar ke halaman login fisik yang benar
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: " . BASE_URL . "layout/auth/login.php");
    exit();
}
?>