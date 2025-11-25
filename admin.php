<?php
session_start();
require "fonctions.php";
$pdo = getDB();

if (!isset($_SESSION['role_id']) || ($_SESSION['role_id'] !== 2))  { //Vérifie si l'utlisateur est bien connecté et si le rôle est un adminanistrateur
    die('Accès refusé.');
}

$users = getAllUsers($pdo);
?>  

<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta charset="UTF-8">
		<meta name="viemport" content="width=device-width, initial-scale=1.0">
		<title>Espace Administrateur</title>
    </head>
    <body>
        <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['nom']) ?></h1>
        <h2>Liste des utlisateurs :</h2>
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