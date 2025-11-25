<?php
session_start();
require "fonctions.php";
$pdo = getDB();

if (!isset($_SESSION['users']) || $_SESSION['role_id'] != 2) { //Vérifie si l'utlisateur est bien connecté et si le rôle est un adminanistrateur
    header('Location: login.php');
    exit();
}
// A la fin de ce if, on sait si l'utilisateru est connecté et est un administrateur
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql); // Execute la requête de la même manière que prepare + execute saud qu'ici nous sommes en admisnistrateur donc c'est plus sécurisé de faire comme ça
$users = $stmt -> fetchAll(PDO::FETCH_ASSOC);// récupére toutes les lignes et les mets sous forme de tableaux




?>

<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta charset="UTF-8">
		<meta name="viemport" content="width=device-width, initial-scale=1.0">
		<title>Espace Administrateur</title>
    </head>
    <body>
        <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['user_nom']) ?></h1>
        <h2>Liste des utlisateurs</h2>
        <table border="1">
          <?php foreach ($users as $user): ?>
            <tr>
                <td><?php htmlspecialchars($user['nom'])?></td>
                <td><?php htmlspecialchars($user['email'])?></td>
            </tr>
          <?php endforeach; ?>
        <a href="logout.php">Se déconnecter</a>
    </body>
<html>