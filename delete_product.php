<?php
session_start();

function redirect_if_not_logged_in() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: dashboard.php');
        exit();
    }
}


redirect_if_not_logged_in();
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM produits WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>