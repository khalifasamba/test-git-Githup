<?php
session_start();

function redirect_if_not_logged_in() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: db.php');
        exit();
    }
}


redirect_if_not_logged_in();
include 'db.php';

$search = $_GET['q'] ?? '';

$stmt = $conn->prepare("SELECT * FROM produits WHERE nom LIKE ? OR categorie LIKE ?");
$like = "%$search%";
$stmt->bind_param("ss", $like, $like);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "{$row['nom']} }<br>";
}
?>
<br>
<br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background-color:rgb(137, 214, 242);
    }
    form{
        align-items:center;
    }
</style>
<body>
    

<form method="GET">
    <input name="q" placeholder="Rechercher...">
    <button type="submit">Chercher</button>
</form>


</body>
</html>