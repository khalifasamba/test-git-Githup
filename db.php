<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'gestion_stock';

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>