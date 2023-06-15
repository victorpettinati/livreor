<?php
session_start();

$bdd = new PDO('mysql:host=localhost; dbname=livreor', 'root', 'Laplateforme.06!');


// Récupérer tous les commentaires de la table "commentaire"
$req = "SELECT commentaire.commentaire, utilisateurs.login, commentaire.date FROM utilisateurs JOIN commentaire ON commentaire.id_utilisateur = utilisateurs.id";
$commentaires = $bdd->query($req);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="livreor.css">
    <title>Livre-or</title>


</head>
<body>
    <h1>Livre d'or</h1>
    <div class="container">
    <div class="commentaires">
        <?php 

        foreach ($commentaires as $commentaire) { 
        ?>
            <div class="commentaire">
                <p class="id_utilisateur"><?php echo $commentaire['login']; ?></p>
                <p class="commentaire"><?php echo $commentaire['commentaire']; ?></p>
                <p class="date"><?php echo $commentaire['date']; ?></p>
            </div>
                            <?php } ?>
    </div>

        <div class="text-frame">
            <a href="deconnexion.php">Déconnexion</a>
            <a href="profil.php">Retour au profil</a>
        </div>
    </div>

</body>
</html>
