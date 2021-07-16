<?php
$server = 'localhost';
// Masukkan username mysql, jika tidak ada masukkan 'root'
$username = 'root';
// Masukkan password mysql, jika tidak ada masukkan empty string ''
$password = 'Cucibaju123';
// Nama Database
$database = 'bmt';

try {
    $conn = new mysqli($server, $username, $password, $database);
} catch (Exception $e) {
    echo $e->getMessage();
}
