<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

// Jika SUDAH login, lempar ke Dashboard (index.php), BUKAN ke login lagi
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: " . BASE_URL . "index.php");
    exit();
}
?>