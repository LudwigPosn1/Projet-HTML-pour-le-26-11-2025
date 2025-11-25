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
          <tr>
            <th> ID </th>
            <th> NOM </th>
            <th> EMAIL </th>
            <th> ROLE </th>
            <th> CHANGER DE ROLE </th>
          </tr>
            <?php foreach ($users as $user): ?>
              <tr>
                  <td> <?= $user['id']?></td>
                  <td> <?= $user['email']?></td>
                  <td> <?= $user['nom'] ?></td>
            <td>
                <form method="POST" action="update_role.php">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <select name="role_id">
                        <option value="1"> USER </option>
                        <option value="2"> ADMINISTRATEUR </option>
                    </select>
                    <button type="submit"> Modifier </button>
                </form>
            </td>
              </tr>
          <?php endforeach; ?>
        <a href="logout.php">Se déconnecter</a>
    </body>
<html>