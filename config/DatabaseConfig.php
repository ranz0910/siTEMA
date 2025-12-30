<?php
// Sesuaikan dengan settingan XAMPP kamu
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sistemmagangdb";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>