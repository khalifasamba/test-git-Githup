<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $req = $conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");

    if ($req) {
        $req->bind_param('sss', $nom, $email, $password );

        if ($req->execute()) {
            echo "<p class='success'>Utilisateur enregistré.</p>";
            echo "<p><a href='login.php'>Se connecter</a></p>";
        } else {
            echo "<p class='error'>Erreur lors de l'exécution : " . $req->error . "</p>";
        }

        $req->close();
    } else {
        echo "<p class='error'>Erreur de préparation : " . $conn->error . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
             background: linear-gradient(to right, #74ebd5, #ACB6E5);
            padding: 40px;
        }
        form {
            
             background-color:white;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 16px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 0px;
            margin: 12px 0px 12px 0px;
            border: 2px solid #ccc;
            border-radius: 6px;
            background-color:rgb(240, 242, 241) ;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            max-width: 400px;
            margin: 10px auto;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            max-width: 400px;
            margin: 10px auto;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>

<h2>Inscription</h2>
<form method="POST">
    Nom: <input type="text" name="nom" required><br>
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="mot_de_passe" required><br>
    <button type="submit">S'inscrire</button>
</form>

<p style="text-align:center;">
    Vous avez déjà un compte ? <a href="login.php">Se connecter</a>
</p>

</body>
</html>
