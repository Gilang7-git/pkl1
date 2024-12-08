<?php
$host = 'localhost';
$port = '5432';
$dbname = 'pkl_sarastya';
$username = 'postgres';
$password = 'gilang88';

try {
    $koneksi = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>