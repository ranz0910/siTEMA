<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "sistemmagangdb";

// Menghubungkan php dengan database

$connect = new mysqli($host,$username,$password,$db_name);

if ($connect->connect_error) {
  die("Koneksi gagal!");
}


?>