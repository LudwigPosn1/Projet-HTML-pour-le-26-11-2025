<?php
session_start();
require "fonctions.php";

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $adresse = trim($_POST['adresse']);
    $password = trim($_POST['password']);
    $retapepassword = trim($_POST['retapepassword']);

    // Vérifier champs vides
    if ($nom === "" || $email === "" || $adresse === "" || $password === "" || $retapepassword === "") {
        die("Tous les champs sont obligatoires.");
    }

    // Email valide ?
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email invalide.");
    }

    // Vérification si les mots de passe correspondent
    if ($password !== $retapepassword) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Vérifier si l'email existe déjà
    if (emailExiste($pdo, $email)) {
        die("Cet email existe déjà.");
    }

    // Hash du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertion en BDD
    $sql = "INSERT INTO users (nom, email, adresse, password, role_id) VALUES (?, ?, ?, ?, ?   )";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nom, $email, $adresse, $passwordHash,1])) {
        echo "Inscription réussie. <a href='login.php'>Se connecter</a>";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<h2>Inscription</h2>

<form method="POST">
    Nom :<br>
    <input type="text" name="nom" required><br><br>

    Email :<br>
    <input type="email" name="email" required><br><br>

    Adresse :<br>
    <input type="text" name="adresse" required><br><br>

    Mot de passe :<br>
    <input type="password" name="password" required><br><br>

    Retaper le mot de passe :<br>
    <input type="password" name="retapepassword" required><br><br>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>