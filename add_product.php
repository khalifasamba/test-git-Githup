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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $categorie = $_POST['categorie'];
    $id_utilisateur = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO produits (nom, description, prix, quantite, categorie, id_utilisateur) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdisi", $nom, $description, $prix, $quantite, $categorie, $id_utilisateur);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ajouterfier le produit</title>
    <style>
        body {
           background: url(images/043F949A-D1F4-4D99-8541-AE4EF2079CB8_1_105_c.jpeg) center/cover no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            background-color:rgb(137, 214, 242);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus {
            border-color: #007BFF;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter le produit</h2>
        <form method="POST">
            <input type="text" name="nom" value="" required>
            <textarea name="description">description</textarea>
            <input name="prix" type="number" step="0.01" value="" required>
            <input name="quantite" type="number" value="" required>
            <input type="text" name="categorie" value="" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>
