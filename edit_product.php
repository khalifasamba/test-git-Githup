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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $categorie = $_POST['categorie'];

    $stmt = $conn->prepare("UPDATE produits SET nom=?, description=?, prix=?, quantite=?, categorie=? WHERE id=?");
    $stmt->bind_param("ssdisi", $nom, $description, $prix, $quantite, $categorie, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM produits WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produit = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le produit</title>
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
            background-color:rgb(57, 190, 230);
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
        <h2>Modifier le produit</h2>
        <form method="POST">
            <input type="text" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>
            <textarea name="description"><?= htmlspecialchars($produit['description']) ?></textarea>
            <input name="prix" type="number" step="0.01" value="<?= htmlspecialchars($produit['prix']) ?>" required>
            <input name="quantite" type="number" value="<?= htmlspecialchars($produit['quantite']) ?>" required>
            <input type="text" name="categorie" value="<?= htmlspecialchars($produit['categorie']) ?>" required>
            <button type="submit">Modifier</button>
        </form>
    </div>
</body>
</html>
