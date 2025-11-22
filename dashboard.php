<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'db.php';

// Logique pour affichage, ajout, suppression, modification, recherche

$sql = "SELECT id, nom, prix FROM produits";
$result = $conn->query($sql);

if (!$result) {
    die("<p class='error'>Erreur lors de la récupération des produits : " . $conn->error . "</p>");
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            background: url(images/043F949A-D1F4-4D99-8541-AE4EF2079CB8_1_105_c.jpeg) center/cover no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 60px auto;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .logout{
            text-align:right;
        }
        .logout a{
            text-decoration: none;
            color: white;
            
            background-color:rgb(8, 11, 188);
            padding: 10px 20px;
            border-radius: 8px;
            margin: 0 10px;
            transition: background-color 0.3s;

        }

        h1 {
            text-align: center;
            color: black;
            margin-bottom: 30px;
        }

        .actions {
            text-align: center;
            margin-bottom: 30px;
        }

        .actions a {
            text-decoration: none;
            color: white;
            background-color: #74ebd5;
            padding: 10px 20px;
            border-radius: 8px;
            margin: 0 10px;
            transition: background-color 0.3s;
        }

        .actions a:hover {
            background-color: #57c5b6;
        }

        .product {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-name {
            font-weight: bold;
            color: #333;
        }

        .product-actions a {
            margin-left: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        .product-actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body> 
   
    <div class="container">

         <div class="logout">
        <a href="logout.php">Déconnexion</a>
        </div>

        <h1>Liste des produits</h1>
        <form method="GET" style="text-align:center; margin-bottom: 20px;">
    <input type="text" name="recherche" placeholder="Rechercher un produit..." style="padding: 8px; width: 60%; border-radius: 8px; border: 1px solid #ccc;">
    <button type="submit" style="padding: 8px 12px; border: none; background-color:rgb(8, 11, 188); color: white; border-radius: 6px;">Rechercher</button>
</form>
        <div class="actions">
            <a href="add_product.php">Ajouter un produit</a>
            <a href="history_product.php">historique des produits</a>  
        </div> 
       

 <?php while ($row = $result->fetch_assoc()): ?>
    <div class="product">
        <div class="product-name">
            <?= htmlspecialchars($row['nom']) ?> - <?= htmlspecialchars($row['prix']) ?> FCFA
        </div>
        <div class="product-actions">
            
            <a href="edit_product.php?id=<?= $row['id'] ?>">Modifier</a>
            <a href="delete_product.php?id=<?= $row['id'] ?>">Supprimer</a>
        </div>
        
       
    </div>

   
    
<?php endwhile; ?>