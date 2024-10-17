<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "judul_skripsi";

$koneksi = new mysqli($servername, $username, $password, $database);

if ($koneksi->connect_errno) {
    die("Koneksi Error ".$koneksi->connect_error);
}

?>