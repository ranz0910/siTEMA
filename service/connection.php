<?php
require_once __DIR__ . '/../config/DatabaseConfig.php';
global $connect;

$host     = "localhost";
$user     = "root";
$password = "";
$db       = "sistemmagangdb";

$connect = mysqli_connect($host, $user, $password, $db);

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>