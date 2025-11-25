<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta charset="UTF-8">
		<meta name="viemport" content="width=device-width, initial-scale=1.0">
		<title>Espace Utilisateur</title>
    </head>


    <body>
        <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['user_nom']) ?></h1>
        <a href="logout.php">Se déconnecter</a>
    </body>
<html>