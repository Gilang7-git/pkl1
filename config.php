<?php
$host = 'localhost';
$port = '5432';
$dbname = 'pkl_sarastya';
$username = 'postgres';
$password = 'gilang88';

try {
    $koneksi = pg_connect("host=localhost dbname=$dbname user=$username password=$password");
    echo "Koneksi Berhasil!";
} catch(PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
