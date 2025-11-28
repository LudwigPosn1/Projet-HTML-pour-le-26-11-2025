<?php
session_start();
require "fonctions.php";

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === "" || $password === "") {
        die("Veuillez remplir tous les champs.");
    }

    $user = getUserByEmail($pdo, $email);

    if (!$user) {
        die("Email ou mot de passe incorrect.");
    }

    if (!password_verify($password, $user['password'])) {
        die("Email ou mot de passe incorrect.");
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nom'] = $user['nom'];
    $_SESSION['role_id'] = $user['role_id'];
    $_SESSION['role_name'] = $user['role_name'];

    header("Location: tableau.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href=".\assets\css\styles-login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="topbar">
        <div class="brand">
        </div>
        <nav class="nav-links">
            <ul>
                <li class="Home_button"><a href="index.html">Accueil</a></li>
                <li class="titre1">Accéder au compte</li>
                <li class="Register_button"><a href="register.php">Inscription</a></li>
            </ul>
        </nav>
    </header>

    <main class="page">
        <div class="grid-two">
            <section class="card">
                <form method="POST">
                    <div class="field">
                        <label class="email" for="email">Email : </label><br>
                        <input class="email_log" type="email" name="email" required>
                    </div><br>
                    <div class="field">
                        <label class="password" for="password">Mot de passe : </label><br>
                        <input class="password_log" type="password" name="password" required>
                    </div><br>
                    <div class="actions">
                        <button class="log_button" type="submit">Se connecter</button><br>
                    </div><br>
                </form>
            </section>
        </div>
    </main>
</body>
</html>