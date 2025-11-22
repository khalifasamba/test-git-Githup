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

$id_utilisateur = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM produits WHERE id_utilisateur = ? ORDER BY id DESC");
$stmt->bind_param("i", $id_utilisateur);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Historique de vos ajouts</h2>";
while ($row = $result->fetch_assoc()) {
    echo "{$row['nom']} - {$row['quantite']} piéce(s) - {$row['prix']}FCFA - {$row['categorie']} par l'utisateur *{$row['id_utilisateur']}*                 {$row['date_ajoute']} <br><br>";
}
?>

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
</style>
<body>
    
</body>
</html>