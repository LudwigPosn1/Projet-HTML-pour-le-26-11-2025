<?php
session_start();
require "fonctions.php";

if (!isset($_SESSION['role_name']) || $_SESSION['role_name'] !== 'admin') {
    die('Accès refusé.');
}

$pdo = getDB();
$users = getAllUsers($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Espace administrateur</title>
    <link rel="stylesheet" href="assets\css\styles-admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<html>
<body>
    <p class="back"><a href="tableau.php">Retour à mon compte</a></p>
    <h1 class="titre1"> Accès ADMINISTRATEUR </h1>

    <table class="list_user" border="1">
        <tr class ="ligne1">
            <th class="colonne1"> ID </th>
            <th class="colonne2"> NOM </th>
            <th class="colonne3"> EMAIL </th>
            <th class="colonne4"> ROLE </th>
            <th class="colonne5"> CHANGER DE ROLE </th>
            <th class="colonne6"> SUPPRIMER </th>
        </tr>

        <?php foreach ($users as $u): ?>
        <tr class ="ligne2">
            <td class="colonne1-1"> <?= $u['id'] ?></td>
            <td class="colonne1-2"> <?= $u['nom'] ?></td>
            <td class="colonne1-3"> <?= $u['email'] ?></td>
            <td class="colonne1-4"> <?= $u['role_name'] ?></td>
            <td class="colonne1-5">
                <form method="POST" action="update_role.php">
                    <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                    <select class="choix_role" name="role_id">
                        <option class="option1" value="1"> USER </option>
                        <option class="option2" value="2"> ADMINISTRATEUR </option>
                    </select>
                    <button class="modify_button" type="submit"> Modifier </button>
                </form>
            </td>
            <td class="colonne1-6"> 
                <form method="POST" action="delete_user.php" onsubmit="return confirm('Êtes-vous certain de vouloir supprimer ce compte ? Les données seront perdues.');">
                    <input type="hidden" name="user_id" value="<?=$u['id'] ?>">
                    <button class="delete_bouton" type="submit" class="btn btn-danger">Supprimer le compte</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<h2 class="sous_titres1">Ajouter un utilisateur</h2>

<form method="POST" action="add_user.php">
    <label class="name">Nom :</label>
    <input class="name_for_create" type="text" name="nom" required>
<br>
    <label class="email">Email :</label>
    <input class="email_for_create" type="email" name="email" required>
<br>
    <label class="adress">Adresse :</label>
    <input class="adress_for_create" type="text" name="adresse" required>
<br>
    <label class="password">Mot de passe :</label>
    <input class="password_for_create" type="password" name="password" required>
<br>
    <label class="role_for_create">Rôle :</label>
    <select class="type_role" name="role_id">
        <option class="option3" value="1">Utilisateur</option>
        <option class="option4" value="2">Administrateur</option>
    </select>
<br>
    <button class="create_validation" type="submit">Créer l'utilisateur</button>
</form>

</body>
</html>